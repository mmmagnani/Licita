<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListing()
    {
        $this->db->select('BaseTbl.idUsuario, BaseTbl.emailUsuario, BaseTbl.nomeUsuario, BaseTbl.login, BaseTbl.ramal, BaseTbl.isDeleted, Role.nome');
        $this->db->from('usuarios as BaseTbl');
        $this->db->join('permissoes as Role', 'Role.idPermissao = BaseTbl.permissao_id','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.permissao_id !=', 1);

        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('idPermissao, nome');
        $this->db->from('permissoes');
        $this->db->where('idPermissao !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("emailUsuario");
        $this->db->from("usuarios");
        $this->db->where("emailUsuario", $email);   
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("idUsuario !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }
    
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('usuarios', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db->select('idUsuario, nomeUsuario, emailUsuario, login, imagem, ramal, pregoeiro, permissao_id');
        $this->db->from('usuarios');
        $this->db->where('isDeleted', 0);
		$this->db->where('permissao_id !=', 1);
        $this->db->where('idUsuario', $userId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('idUsuario', $userId);
        $this->db->update('usuarios', $userInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('idUsuario', $userId);
        $this->db->update('usuarios', $userInfo);
        
        return $this->db->affected_rows();
    }

	/**
     * This function is used to active the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function activeUser($userId, $userInfo)
    {
        $this->db->where('idUsuario', $userId);
        $this->db->update('usuarios', $userInfo);
        
        return $this->db->affected_rows();
    }

    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('idUsuario, senha');
        $this->db->where('idUsuario', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('usuarios');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->senha)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('idUsuarios', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('usuarios', $userInfo);
        
        return $this->db->affected_rows();
    }
	
	
	function getAtasVigentes()
	{
		$where = 'SUBDATE(CURDATE(), 365) <=atas.data_inicio';
		$this->db->distinct();
		$this->db->select('licitacoes.idLicitacao, licitacoes.nup, licitacoes.numero, licitacoes.om, licitacoes.anoLicitacao, modalidades.modalidade, licitacoes.gerset, licitacoes.ato_nomeacao, licitacoes.descricao, ADDDATE(atas.data_inicio, 365) AS vencimento, arquivos.urlArquivo');
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
}

  