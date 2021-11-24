<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Marcelo Magqnani
 * @version : 2.0
 */
class Login extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {		

        $this->isLoggedIn();
		
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn()
    {
		$isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
			$this->global['agenda_pregoes'] = $this->login_model->getAgendaPregoes();
		
			$this->global['atas_vigentes'] = $this->login_model->getAtasVigentes();
			
            $this->load->view('obtencoes', $this->global);
        }
        else
        {	
            redirect('index.php/dashboard');
        }
    }
    
    
    /**
     * This function used to logged in user
     */
    public function loginMe()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Login', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('senha', 'Senha', 'required|max_length[32]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
            $login = $this->input->post('username');
            $password = $this->input->post('senha');
            $passencrypt = getHashedPassword($password);
            $result = $this->login_model->loginMe($login, $password);
            
            if(count($result) > 0)
            {
                foreach ($result as $res)
                {
					if($res->imagem == NULL)
					{
						$img = base_url().'assets/dist/img/user-default.png';
					} else {
						$img = $res->imagem;
					}
                    $sessionArray = array('userId'=>$res->idUsuario,
											'login'=>$res->login,                    
                                            'role'=>$res->permissao_id,
                                            'roleText'=>$res->nome,
                                            'name'=>$res->nomeUsuario,
											'imagem'=>$img,
                                            'isLoggedIn' => TRUE
                                    );
                                    
                    $this->session->set_userdata($sessionArray);
                    
                    redirect('index.php/dashboard');
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Login ou senha incorreta');
                
                redirect('index.php/login');
            }
        }
    }

    /**
     * This function used to load forgot password view
     */
    public function forgotPassword()
    {
        $this->load->view('forgotPassword');
    }
    
    /**
     * This function used to generate reset password request link
     */
    function resetPasswordUser()
    {
        $status = '';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('login_email','Email','trim|required|valid_email|xss_clean');
                
        if($this->form_validation->run() == FALSE)
        {
            $this->forgotPassword();
        }
        else 
        {
            $email = $this->input->post('login_email');
            
            if($this->login_model->checkEmailExist($email))
            {
                $encoded_email = urlencode($email);
                
                $this->load->helper('string');
                $data['email'] = $email;
                $data['activation_id'] = random_string('alnum',15);
                $data['createdDtm'] = date('Y-m-d H:i:s');
                $data['agent'] = getBrowserAgent();
                $data['client_ip'] = $this->input->ip_address();
                
                $save = $this->login_model->resetPasswordUser($data);                
                
                if($save)
                {
                    $data1['reset_link'] = base_url() . "index.php/resetPasswordConfirmUser/" . $data['activation_id'] . "/" . $encoded_email;
                    $userInfo = $this->login_model->getCustomerInfoByEmail($email);

                    if(!empty($userInfo)){
                        $data1["name"] = $userInfo[0]->nomeUsuario;
                        $data1["email"] = $userInfo[0]->emailUsuario;
                        $data1["message"] = "Redefinir sua senha";
                    }

                    $sendStatus = resetPasswordEmail($data1);

                    if($sendStatus){
                        $status = "send";
                        setFlashData($status, "O link para redefinir a sua senha foi enviado com sucesso, verifique sua caixa de correio.");
                    } else {
                        $status = "notsend";
                        setFlashData($status, "Email falhou, tente novamente.");
                    }
                }
                else
                {
                    $status = 'unable';
                    setFlashData($status, "Parece haver um erro quando estamos enviando seus dados, tente novamente.");
                }
            }
            else
            {
                $status = 'invalid';
                setFlashData($status, "Este email não está registrado no sistema.");
            }
            redirect('index.php/forgotPassword');
        }
    }

    // This function used to reset the password 
    function resetPasswordConfirmUser($activation_id, $email)
    {
        // Get email and activation code from URL values at index 3-4
        $email = urldecode($email);
        
        // Check activation id in database
        $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
        
        $data['email'] = $email;
        $data['activation_code'] = $activation_id;
        
        if ($is_correct == 1)
        {
            $this->load->view('newPassword', $data);
        }
        else
        {
            redirect('index.php/login');
        }
    }
    
    // This function used to create new password
    function createPasswordUser()
    {
        $status = '';
        $message = '';
        $email = $this->input->post("email");
        $activation_id = $this->input->post("activation_code");
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('password','Senha','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirme a Senha','trim|required|matches[password]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->resetPasswordConfirmUser($activation_id, urlencode($email));
        }
        else
        {
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            // Check activation id in database
            $is_correct = $this->login_model->checkActivationDetails($email, $activation_id);
            
            if($is_correct == 1)
            {                
                $this->login_model->createPasswordUser($email, $password);
                
                $status = 'success';
                $message = 'Senha alterada com sucesso';
            }
            else
            {
                $status = 'error';
                $message = 'Falha a alterar senha';
            }
            
            setFlashData($status, $message);

            redirect('index.php/login');
        }
    }
	function verAtas($ataId = NULL)
	{
		if($ataId != null)
		{
			$this->global['atas'] = $this->login_model->getAtas($ataId);
			$this->load->view('atas',$this->global);	
		}
	}
	function verItens($idAta = NULL)
	{
		if($idAta != null)
		{
			$nAta = $this->login_model->getnumAta($idAta);
			$numAta = $nAta->numeroAta;
			$this->global['itens'] = $this->login_model->getItensByAta($numAta);
			$this->global['forn'] = $this->login_model->getFornecedor($numAta);
			$this->load->view('itens',$this->global);
		}
	}
	
	function getLists(){
        $data = $row = array();
        

        $pesquisa_itens = $this->login_model->getRows($_POST);
        
        $i = $_POST['start'];
        foreach($pesquisa_itens as $pesq){
            $i++;
            $vunit = number_format($pesq->unitario,4,',','.');
			$datavencimento = date('d/m/Y',strtotime($pesq->vencimento));
            $data[] = array($pesq->pregao, $pesq->item, $pesq->requisicao, $pesq->descricao, $vunit, $pesq->ata, $datavencimento);
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->login_model->countAll(),
            "recordsFiltered" => $this->login_model->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }

}

?>