<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Biddings_model extends CI_Model
{
    /**
     * This function is used to add new bidding to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewBidding($biddingInfo)
    {
        $this->db->trans_start();
        $this->db->insert('licitacoes', $biddingInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
	
	function addNewItem($itemInfo)
    {
        $this->db->trans_start();
        $this->db->insert('itens', $itemInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
	
    /**
     * This function is used to get the biddings listing
     * @return array $result : This is result
     */
    function biddingsListing()
    {
        $this->db->select('licitacoes.idLicitacao, modalidades.modalidade, tipos.nomeTipo, licitacoes.srp, licitacoes.numero,licitacoes.om, licitacoes.anoLicitacao, licitacoes.descricao, licitacoes.dataLicitacao, licitacoes.horaLicitacao, usuarios.nomeUsuario');
        $this->db->from('licitacoes');
		$this->db->join('modalidades', 'licitacoes.modalidade_id = modalidades.idModalidade');
		$this->db->join('tipos', 'licitacoes.tipo_id = tipos.idTipo');
		$this->db->join('usuarios', 'licitacoes.usuario_id = usuarios.idUsuario','left');
		$this->db->where('licitacoes.isDeleted', 0);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function used to get bidding information by id
     * @param number $biddingId : This is bidding id
     * @return array $result : This is bidding information
     */
    function getBiddingInfo($biddingId)
    {
		$this->db->where('isDeleted', 0);
        $this->db->where('idLicitacao', $biddingId);
        $query = $this->db->get('licitacoes');
        
        return $query->result();
    }
    
    
    /**
     * This function is used to update the bidding information
     * @param array biddingInfo : This is bidding updated information
     * @param number $biddingId : This is bidding id
     */
    function editBidding($biddingInfo, $biddingId)
    {
        $this->db->where('idlicitacao', $biddingId);
        $this->db->update('licitacoes', $biddingInfo);
        
        return TRUE;
    }
    
    function editAta($ataInfo, $ataId)
    {
        $this->db->where('idAta', $ataId);
        $this->db->update('atas', $ataInfo);
        
        return TRUE;
    }  
	
    function editArquivo($arquivoInfo, $arquivoId)
    {
        $this->db->where('idArquivo', $arquivoId);
        $this->db->update('arquivos', $arquivoInfo);
        
        return TRUE;
    } 	  
	
	function editItem($itemInfo, $itemId)
    {
        $this->db->where('idItem', $itemId);
        $this->db->update('itens', $itemInfo);
        
        return TRUE;
    }
    
    /**
     * This function is used to delete the user information
     * @param number $biddingId : This is bidding id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteBidding($biddingId, $biddingInfo)
    {
        $this->db->where('idlicitacao', $biddingId);
        $this->db->update('licitacoes', $biddingInfo);
        
        return $this->db->affected_rows();
    }
	
	function deleteAta($ataId)
	{
		$this->db->where('idAta', $ataId);
		$this->db->delete('atas');
		
		return $this->db->affected_rows();
	}
	
	function deleteArquivo($url)
	{
	    if(file_exists($url)){
		if(@unlink($url)!==true)
		throw new Exception('Não é possível apagar o arquivo ' . $url . ' Verifique se o arquivo existe ou está em uso por outra aplicação.');
		}
		return true;
		
	}
	
	function deleteItem($itemId)
	{
		$this->db->where('idItem', $itemId);
		$this->db->delete('itens');
		
		return $this->db->affected_rows();
	}

	function getModalities()
	{
		return $this->db->get('modalidades')->result();
	}
	
	function getTypes()
	{
		return $this->db->get('tipos')->result();
	}	
	
	function getCriers()
	{
		$this->db->where('pregoeiro', 1);
		return $this->db->get('usuarios')->result();
	}		
	
	function getCriersActive()
	{
		$this->db->where('pregoeiro', 1);
		$this->db->where('isDeleted', 0);
		$this->db->order_by('nomeusuario', 'ASC');
		return $this->db->get('usuarios')->result();
	}
		
	function getBiddings()
	{
		$where = '(licitacoes.modalidade_id = 1 OR licitacoes.modalidade_id = 2) AND licitacoes.srp = 1 AND licitacoes.isDeleted = 0';
		$this->db->select('licitacoes.*, modalidades.modalidade');
		$this->db->from('licitacoes');
		$this->db->join('modalidades', 'licitacoes.modalidade_id = modalidades.idModalidade');
		$this->db->where($where);
		$this->db->order_by('licitacoes.anoLicitacao', 'asc');
		$this->db->order_by('licitacoes.numero', 'asc');
		$this->db->order_by('licitacoes.om', 'asc');
		return $this->db->get()->result();
	}	
	
	function add($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1')
        {
            return true;
        }

        return false;
    }
	
	function getAtasByBidding($biddingId)
	{
		$this->db->where('licitacao_id', $biddingId);
		return $this->db->get('atas')->result();
	}
	
	function getAtaInfo($ataId)
	{
		$this->db->where('idAta', $ataId);
		return $this->db->get('atas')->result();
	}
	
	function getItemInfo($itemId)
	{
		$this->db->where('idItem', $itemId);
		return $this->db->get('itens')->result();
	}	
	
	function getArquivoInfo($arquivoId)
	{
		$this->db->where('idArquivo', $arquivoId);
		return $this->db->get('arquivos')->result();
	}
	
	function getAtasFromItens($biddingId)
	{
		$this->db->distinct();
		$this->db->select('numeroAta');
		$this->db->where('licitacao_id', $biddingId);
		$this->db->order_by('numeroAta', 'ASC');
		return $this->db->get('itens')->result();
	}
	
    function addNewAta($ataInfo)
    {
        $this->db->trans_start();
        $this->db->insert_batch('atas', $ataInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }	
	
	 function addNewArquivo($arquivoInfo)
    {
        $this->db->trans_start();
        $this->db->insert('arquivos', $arquivoInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }	
	
	function getArquivosByBidding($biddingid)
	{
		$this->db->where('licitacao_id', $biddingid);
		return $this->db->get('arquivos')->result();
	}
		
	function deleteArquivoTb($arqId)
	{
		$this->db->where('idArquivo', $arqId);
		$this->db->delete('arquivos');
		
		return $this->db->affected_rows();
	}
	function getItensByBiddings($biddingId)
	{
		$this->db->where('licitacao_id',$biddingId);
		return $this->db->get('itens')->result();
	
	}
	
	function countAtasByBidding($biddingId)
	{
		$query = $this->db->query('SELECT COUNT(DISTINCT itens.numeroAta) AS atas FROM itens WHERE itens.licitacao_id ='.$biddingId);
		return $query->row();
	}

}

  