<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Marcelo Magnani
 * @version : 2.0
 */
class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Atas Vigentes : Painel';
		
		$this->global['agenda_pregoes'] = $this->user_model->getAgendaPregoes();
		
		$this->global['atas_vigentes'] = $this->user_model->getAtasVigentes();	
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            
            $data['userRecords'] = $this->user_model->userListing();
            
            $this->global['pageTitle'] = 'Atas Vigentes : Listagem de Usuários';
            
            $this->loadViews("users", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();
            
            $this->global['pageTitle'] = 'Atas Vigentes : Adicionar Novo Usuário';

            $this->loadViews("addNew", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Nome','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
			$this->form_validation->set_rules('lname','Login','required|max_length[16]');
            $this->form_validation->set_rules('password','Senha','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirmar Senha','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Permissão','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Ramal','required|min_length[4]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
				$login = $this->input->post('lname');
                $email = $this->input->post('email');
				$pregoeiro = $this->input->post('pregoeiro');
				if($pregoeiro != 1) {
					$pregoeiro = 0;
				}

				if (!empty($_FILES['userfile']['name']))
				{
					$path = 'assets/dist/img/';
         			$config['upload_path'] = $path;
         			$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $login.'.jpg';
     
     			 	$this->load->library('upload', $config);
     			
     				if (!$this->upload->do_upload('userfile'))
					{
            			$this->session->set_flashdata('error', $this->upload->display_errors('<p>', '</p>'));
						$imagem = NULL;
					} 
					else 
					{
						$this->session->set_flashdata('success', 'Imagem carregada corretamente.');
						$imagem = base_url().$path.$this->upload->data('file_name');
					}
				}
				else
				{	
				$imagem = NULL;
				}
				
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');
                
                $userInfo = array('emailUsuario'=>$email, 'senha'=>getHashedPassword($password), 'login'=>$login, 'permissao_id'=>$roleId, 'nomeUsuario'=> $name, 'imagem'=>$imagem, 'ramal'=>$mobile, 'pregoeiro'=>$pregoeiro, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Novo usuário criado com sucesso'.$img);
                }
                else
                {
                    $this->session->set_flashdata('error', 'Criação de usuário falhou');
                }
                
                redirect('index.php/addNew');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if($this->isAdmin() == TRUE || $userId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('index.php/userListing');
            }
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);
            
            $this->global['pageTitle'] = 'Atas Vigentes : Editar Usuário';
            
            $this->loadViews("editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Nome','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
			$this->form_validation->set_rules('lname','Login','required|max_length[16]');
            $this->form_validation->set_rules('password','Senha','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirmar senha','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Permissão','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Ramal','required|min_length[4]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
				$login = $this->input->post('lname');
                $email = $this->input->post('email');
				$pregoeiro = $this->input->post('pregoeiro');
				if($pregoeiro != 1) {
					$pregoeiro = 0;
				}
	
				if (!empty($_FILES['userfile']['name']))
				{
					$path = 'assets/dist/img/';
         			$config['upload_path'] = $path;
         			$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $login.'.jpg';
     
     			 	$this->load->library('upload', $config);
     			
     				if (!$this->upload->do_upload('userfile'))
					{
            			$this->session->set_flashdata('error', $this->upload->display_errors('<p>', '</p>'));
						$imagem = NULL;
					} 
					else 
					{
						$this->session->set_flashdata('success', 'Imagem carregada corretamente.');
						$imagem = base_url().$path.$this->upload->data('file_name');
					}
				}
				
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');
                
                $userInfo = array();
                
			if(empty($_FILES['userfile']['name']))
			{
                if(empty($password))
                {
                    $userInfo = array('emailUsuario'=>$email, 'login'=>$login, 'permissao_id'=>$roleId, 'nomeUsuario'=>$name, 'ramal'=>$mobile, 'pregoeiro'=>$pregoeiro, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $userInfo = array('emailUsuario'=>$email, 'senha'=>getHashedPassword($password), 'permissao_id'=>$roleId, 'nomeUsuario'=>ucwords($name), 'ramal'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
			}
			else
			{
				if(empty($password))
                {
                    $userInfo = array('emailUsuario'=>$email, 'login'=>$login, 'permissao_id'=>$roleId, 'nomeUsuario'=>$name, 'imagem'=>$imagem, 'ramal'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $userInfo = array('emailUsuario'=>$email, 'senha'=>getHashedPassword($password), 'permissao_id'=>$roleId, 'imagem'=>$imagem, 'nomeUsuario'=>ucwords($name), 'ramal'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }	
			}
                
                $result = $this->user_model->editUser($userInfo, $userId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Usuário atualizado com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Atualização de usuário falhou');
                }
                
                redirect('index.php/editOld/'.$userId);
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->deleteUser($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
	/**
     * This function is used to active the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function activeUser()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>0,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->activeUser($userId, $userInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
	
    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'Atas Vigentes : Alterar Senha';
        
        $this->loadViews("changePassword", $this->global, NULL, NULL);
    }
    
    
    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirmar nova senha','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Sua senha atual não está correta');
                redirect('index.php/loadChangePass');
            }
            else
            {
                $usersData = array('senha'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Senha alterada com sucesso'); }
                else { $this->session->set_flashdata('error', 'Alteração de senha falhou'); }
                
                redirect('index.php/loadChangePass');
            }
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Atas Vigentes : 404 - Página Não Encontrada';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
	
	function verAtas2($ataId = NULL)
	{
		if($ataId != null)
		{
			$this->global['pageTitle'] = 'Atas Vigentes : Painel';
			$this->load->model('login_model');
			$this->global['atas'] = $this->login_model->getAtas($ataId);
			$this->loadViews("atas2", $this->global, NULL, NULL);
	
		}
	}
	function verItens2($idAta = NULL)
	{
		if($idAta != null)
		{
			$this->global['pageTitle'] = 'Atas Vigentes : Painel';
			$this->load->model('login_model');
			$nAta = $this->login_model->getnumAta($idAta);
			$numAta = $nAta->numeroAta;
			$this->global['itens'] = $this->login_model->getItensByAta($numAta);
			$this->global['forn'] = $this->login_model->getFornecedor($numAta);
			$this->loadViews('itens2',$this->global,NULL, NULL);
		}
	}

    /**	
	     * This function is used to load the change photo screen
     */
    function loadChangePhoto()
    {
        $this->global['pageTitle'] = 'Atas Vigentes : Alterar Foto';
        
        $this->loadViews("changePhoto", $this->global, NULL, NULL);
    }
	
    /**
     * This function is used to change the photo of the user
     */
    function changePhoto()
    {
         	if (!empty($_FILES['userfile']['name']))
				{
					$login = $this->login;
					$path = 'assets/dist/img/';
         			$config['upload_path'] = $path;
         			$config['allowed_types'] = 'jpg|png|jpeg';
					$config['file_name'] = $login.'.jpg';
     
     			 	$this->load->library('upload', $config);
     			
     				if (!$this->upload->do_upload('userfile'))
					{
            			$this->session->set_flashdata('error', $this->upload->display_errors('<p>', '</p>'));
						$imagem = NULL;
						redirect('index.php/loadChangePhoto');
					} 
					else 
					{
						$this->session->set_flashdata('success', 'Imagem carregada corretamente.');
						$imagem = base_url().$path.$this->upload->data('file_name');
					}

                	if(!empty($_FILES['userfile']['name']))
                	{
                    	$userInfo = array('imagem'=>$imagem, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                	}					
					
                	$result = $this->user_model->editUser($userInfo, $this->vendorId);
                
                	if($result == true)
                	{
                    	$this->session->set_flashdata('success', 'Foto atualizada com sucesso');
                	}
                	else
                	{
                    	$this->session->set_flashdata('error', 'Atualização da foto falhou');
                	}
                
                	redirect('index.php/loadChangePhoto');					
					
				}
		        
    }	
	
}

?>