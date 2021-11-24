<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{

	function __construct() {
        // Set table name
        $this->table = '(SELECT CONCAT(licitacoes.numero, "/", licitacoes.anoLicitacao) AS `pregao`, `itens`.`num_item` AS `item`, `itens`.`requisicao` AS `requisicao`, `itens`.`descricao` AS `descricao`, `itens`.`preco_unitario` AS `unitario`, `itens`.`numeroAta` AS `ata`, ADDDATE(atas.data_inicio, 365-1) AS vencimento
FROM `itens` JOIN `licitacoes` ON `itens`.`licitacao_id` = `licitacoes`.`idLicitacao` JOIN `atas` ON `itens`.`numeroAta` = `atas`.`numeroAta` WHERE SUBDATE(CURDATE(), 365-1) <= `atas`.`data_inicio`)virtual';
        // Set orderable column fields
        $this->column_order = array('pregao','item','requisicao','descricao','unitario','ata','vencimento');
        // Set searchable column fields
        $this->column_search = array('pregao','item','requisicao','descricao','unitario','ata','vencimento');
        // Set default order
        $this->order = array('pregao' => 'asc');
    }
    
    /**
     * This function used to check the login credentials of the user
     * @param string $email : This is email of the user
     * @param string $password : This is encrypted password of the user
     */
    function loginMe($login, $password)
    {
        $this->db->select('BaseTbl.idUsuario, BaseTbl.login, BaseTbl.senha, BaseTbl.nomeUsuario, BaseTbl.imagem, BaseTbl.permissao_id, Roles.nome');
        $this->db->from('usuarios as BaseTbl');
        $this->db->join('permissoes as Roles','Roles.idPermissao = BaseTbl.permissao_id');
        $this->db->where('BaseTbl.login', $login);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        $user = $query->result();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user[0]->senha)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email)
    {
        $this->db->select('idUsuario');
        $this->db->where('emailUsuario', $email);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }


    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data)
    {
        $result = $this->db->insert('reset_password', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByEmail($email)
    {
        $this->db->select('idUsuario, emailUsuario, nomeUsuario');
        $this->db->from('usuarios');
        $this->db->where('isDeleted', 0);
        $this->db->where('emailUsuario', $email);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $email : Email id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($email, $activation_id)
    {
        $this->db->select('id');
        $this->db->from('reset_password');
        $this->db->where('email', $email);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // This function used to create new password by reset link
    function createPasswordUser($email, $password)
    {
        $this->db->where('emailUsuario', $email);
        $this->db->where('isDeleted', 0);
        $this->db->update('usuarios', array('senha'=>getHashedPassword($password)));
        $this->db->delete('reset_password', array('email'=>$email));
    }
	
	function getAtasVigentes()
	{
		$where = 'SUBDATE(CURDATE(), 365) <=atas.data_inicio';
		$this->db->distinct();
		$this->db->select('licitacoes.idLicitacao, licitacoes.nup, licitacoes.numero, licitacoes.om, licitacoes.anoLicitacao, licitacoes.gerset, licitacoes.ato_nomeacao, modalidades.modalidade, licitacoes.descricao, ADDDATE(atas.data_inicio, 365) AS vencimento, arquivos.urlArquivo');
		$this->db->from('atas');
		$this->db->join('licitacoes', 'atas.licitacao_id = licitacoes.idLicitacao');
		$this->db->join('modalidades', 'licitacoes.modalidade_id = modalidades.idModalidade');
		$this->db->join('arquivos', 'arquivos.licitacao_id = licitacoes.idLicitacao', 'left');
		$this->db->where($where);
		$this->db->where('licitacoes.modalidade_id', 1)->or_where('(licitacoes.modalidade_id = 2 AND licitacoes.srp = 1)');
		$this->db->group_by('atas.licitacao_id');
		$this->db->group_by('atas.data_inicio');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getAgendaPregoes()
	{
		$date = date('y-m-d');
		$this->db->select('licitacoes.idLicitacao, licitacoes.descricao, licitacoes.numero, licitacoes.dataLicitacao, licitacoes.horaLicitacao, modalidades.modalidade, tipos.nomeTipo, usuarios.nomeUsuario');
		$this->db->from('licitacoes');
		$this->db->join('modalidades', 'licitacoes.modalidade_id = modalidades.idModalidade');
		$this->db->join('tipos', 'licitacoes.tipo_id = tipos.idTipo');
		$this->db->join('usuarios', 'licitacoes.usuario_id = usuarios.idUsuario');
		$this->db->where('licitacoes.dataLicitacao >=', $date);
		$query = $this->db->get();
		return $query->result();
	}
	
	function getAtas($id)
	{
		$this->db->where('licitacao_id',$id);
		$query = $this->db->get('atas');
		return $query->result();
	}
	
	function getnumAta($id)
	{
		$this->db->where('idAta',$id);
		$query = $this->db->get('atas');
		return $query->row();
	}
	
	function getItensByAta($numata)
	{
		$this->db->select('itens.licitacao_id, itens.num_item, itens.requisicao, itens.descricao, itens.quantidade, itens.medida, itens.marca, itens.preco_unitario, itens.preco_total');
		$this->db->where('itens.numeroAta',$numata);
		$this->db->order_by('itens.num_item','ASC');
		$query=$this->db->get('itens');
		return $query->result();
	}
	function getFornecedor($numata)
	{
		$this->db->select('itens.licitacao_id, itens.fornecedor_cnpj, itens.fornecedor_razao, itens.numeroAta');
		$this->db->where('itens.numeroAta',$numata);
		$query=$this->db->get('itens');
		return $query->row();
	}
	/*function pesquisaItens()
	{
		$where = 'SUBDATE(CURDATE(), 365-1) <= atas.data_inicio';
		$this->db->select('CONCAT(licitacoes.numero,"/",licitacoes.om,"/",licitacoes.anoLicitacao) AS pregao, itens.num_item AS item, itens.requisicao AS requisicao, itens.descricao AS descricao, itens.preco_unitario AS unitario, itens.fornecedor_cnpj AS cnpj, itens.fornecedor_razao AS razao, itens.numeroAta AS ata, ADDDATE(atas.data_inicio, 365-1) AS vencimento');
		$this->db->from('itens');
		$this->db->join('licitacoes', 'itens.licitacao_id = licitacoes.idLicitacao');
		$this->db->join('atas', 'itens.numeroAta = atas.numeroAta');
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result();
	}*/
	
	public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * Count all records
     */
    public function countAll(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData){
         
        $this->db->from($this->table);
 
        $i = 0;
        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
}

?>
