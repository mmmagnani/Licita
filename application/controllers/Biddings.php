<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Biddings (BiddingsController)
 * User Class to control all biddings.
 * @author : Marcelo Magnani
 * @version : 2.0
 */
class Biddings extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('biddings_model');
		$this->load->library('PHPExcel');
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the biddings list
     */
    function biddingListing()
    {
            $this->load->model('biddings_model');
            
            $data['biddingRecords'] = $this->biddings_model->biddingsListing();
            
            $this->global['pageTitle'] = 'Atas Vigentes : Listagem de Licitações';
            
            $this->loadViews("biddings", $this->global, $data, NULL);
    }
	
	function ArquivosB($biddingId = NULL)
	{
			if($biddingId == null)
			{
				redirect('index.php/biddingsSrp');
			}
			
			$data['arquivosRecords'] = $this->biddings_model->getArquivosByBidding($biddingId);
		
			$data['biddingid'] = $biddingId;
			
			$this->global['pageTitle'] = 'Atas Vigentes : Listas de Arquivos';
			
			$this->loadViews("arquivoslist", $this->global, $data, NULL);
	}

    /**
     * This function is used to load the add new form
     */
    function addNewB()
    {

            $this->load->model('biddings_model');
            $data['modalities'] = $this->biddings_model->getModalities();
			$data['types'] = $this->biddings_model->getTypes();
			$data['criers'] = $this->biddings_model->getCriersActive();
			
            
            $this->global['pageTitle'] = 'Atas Vigentes : Adicionar Nova Licitação';

            $this->loadViews("addNewB", $this->global, $data, NULL);

    }

   
    /**
     * This function is used to add new bidding to the system
     */
    function addNewBidding()
    {

            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('modalidade','Modalidade','required');
            $this->form_validation->set_rules('tipo','Tipo','required');
			$this->form_validation->set_rules('numero','Número','trim|required|numeric|max_length[3]');
			$this->form_validation->set_rules('om', 'OM','trim|required');
            $this->form_validation->set_rules('descricao','Objeto','required');
            $this->form_validation->set_rules('srp','SRP?','required');
            $this->form_validation->set_rules('anolicita','Ano','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewB();
            }
            else
            {
                $modalidade = $this->input->post('modalidade');
				$tipo = $this->input->post('tipo');
                $numero = $this->input->post('numero');
				$om = $this->input->post('om');
                $descricao = mb_strtoupper($this->input->post('descricao'));
                $srp = $this->input->post('srp');
                $anolicita = $this->input->post('anolicita');
				$datalicita = date("Y-m-d",strtotime(str_replace('/','-',$this->input->post('datalicita'))));  
				$horalicita = $this->input->post('horalicita');
				$pregoeiro = $this->input->post('pregoeiro');
				$nup = $this->input->post('nup');
				$gerset = $this->input->post('gerset');
				$ato_nomeacao = $this->input->post('ato_nomeacao');
                
                $biddingInfo = array();
                
                $biddingInfo = array('modalidade_id'=>$modalidade, 'tipo_id'=>$tipo, 'srp'=>$srp, 'numero'=>$numero, 'om'=>$om, 'anolicitacao'=>$anolicita, 'descricao'=>$descricao, 'dataLicitacao'=>$datalicita, 'horaLicitacao'=>$horalicita, 'usuario_id'=>$pregoeiro,'nup'=>$nup, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));
                
                $this->load->model('biddings_model');
                $result = $this->biddings_model->addNewBidding($biddingInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Nova licitação criada com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Criação de licitação falhou');
                }
                
                redirect('index.php/addNewB');
            }
    }
	    
    /**
     * This function is used load user edit information
     * @param number $biddingId : Optional : This is bidding id
     */
    function editOldB($biddingId = NULL)
    {

            if($biddingId == null)
            {
                redirect('index.php/biddingListing');
            }
            
            $data['modalities'] = $this->biddings_model->getModalities();
			$data['types'] = $this->biddings_model->getTypes();
			$data['criers'] = $this->biddings_model->getCriers();
			$data['biddingInfo'] = $this->biddings_model->getBiddingInfo($biddingId);
            
            $this->global['pageTitle'] = 'Atas Vigentes : Editar Licitação';
            
            $this->loadViews("editOldB", $this->global, $data, NULL);

    }
	
	function viewB($biddingId = NULL)
	{
     	if($biddingId == null)
        {
        	redirect('index.php/biddingListing');
        }	
		
		$this->load->model('biddings_model');
            
        $data['infoItens'] = $this->biddings_model->getItensByBiddings($biddingId);
		
		$data['biddingid'] = $biddingId;
            
        $this->global['pageTitle'] = 'Atas Vigentes : Listagem de Itens da Licitação';
            
        $this->loadViews("viewItens", $this->global, $data, NULL);
 		
	}
    
    
    /**
     * This function is used to edit the user information
     */
    function editBidding()
    {

            $this->load->library('form_validation');
            
            $biddingId = $this->input->post('biddingId');
            
            $this->form_validation->set_rules('modalidade','Modalidade','required');
            $this->form_validation->set_rules('tipo','Tipo','required');
			$this->form_validation->set_rules('numero','Número','trim|required|numeric|max_length[3]');
			$this->form_validation->set_rules('om','OM','trim|required');
            $this->form_validation->set_rules('descricao','Objeto','required');
            $this->form_validation->set_rules('srp','SRP?','required');
            $this->form_validation->set_rules('anolicita','Ano','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldB($biddingId);
            }
            else
            {
                $modalidade = $this->input->post('modalidade');
				$tipo = $this->input->post('tipo');
                $numero = $this->input->post('numero');
				$om = $this->input->post('om');
                $descricao = mb_strtoupper($this->input->post('descricao'));
                $srp = $this->input->post('srp');
                $anolicita = $this->input->post('anolicita');
				$datalicita = date("Y-m-d",strtotime(str_replace('/','-',$this->input->post('datalicita'))));  
				$horalicita = $this->input->post('horalicita');
				$pregoeiro = $this->input->post('pregoeiro');
				$nup = $this->input->post('nup');
				$gerset = $this->input->post('gerset');
				$ato_nomeacao = $this->input->post('ato_nomeacao');
                
                $biddingInfo = array();
                
                    $biddingInfo = array('modalidade_id'=>$modalidade, 'tipo_id'=>$tipo, 'srp'=>$srp, 'numero'=>$numero, 'om'=>$om, 'anolicitacao'=>$anolicita, 'descricao'=>$descricao, 'dataLicitacao'=>$datalicita, 'horaLicitacao'=>$horalicita, 'usuario_id'=>$pregoeiro, 'nup'=>$nup, 'gerset'=>$gerset, 'ato_nomeacao'=>$ato_nomeacao, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));


                
                $result = $this->biddings_model->editBidding($biddingInfo, $biddingId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Licitação atualizada com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Atualização de licitação falhou');
                }
                
                redirect('index.php/editOldB/'.$biddingId);
            }
    }


    /**
     * This function is used to delete the bidding using biddingId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteBidding()
    {

            $biddingId = $this->input->post('biddingId');
            $biddingInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->biddings_model->deleteBidding($biddingId, $biddingInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }

    }
	
	function deleteAta()
    {

            $ataId = $this->input->post('ataId');
			$path = $this->input->post('urlAta');
			if($path){
				$file = pathinfo($path, PATHINFO_BASENAME );
				$urlAta = "assets/atas/".$file;
				$apagado = $this->biddings_model->deleteArquivo($urlAta);
				if($apagado){
            		$result = $this->biddings_model->deleteAta($ataId);
            
            		if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            		else { echo(json_encode(array('status'=>FALSE))); }
				}
				else
				{
					echo(json_encode(array('status'=>FALSE)));
				}
			}
			else
			{
				$result = $this->biddings_model->deleteAta($ataId);
            
            	if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            	else { echo(json_encode(array('status'=>FALSE))); }
			}
			
    }
	
	function deleteArquivo()
    {

            $apagado = -1;
			$arqId = $this->input->post('arqId');
			$path = $this->input->post('urlArq');
			$file = pathinfo($path, PATHINFO_BASENAME );
			$urlArq = "assets/arquivos/".$file;
			try {
			  if($this->biddings_model->deleteArquivo($urlArq) === true)
			  $apagado = TRUE;
			}
			catch (Exception $e) {
				 	
			}
			if($apagado){
            	$result = $this->biddings_model->deleteArquivoTb($arqId);
            
            	if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            	else { echo(json_encode(array('status'=>FALSE))); }
			}
			else
			{
				echo(json_encode(array('status'=>"", 'erro'=>$e->getMessage())));
			}
			
    }	
	
	function deleteItem()
    {

            $itemId = $this->input->post('itemId');

            $result = $this->biddings_model->deleteItem($itemId);
            
            if ($result > 0) 
			{ 
				echo(json_encode(array('status'=>TRUE))); 
			}
            else 
			{ 
				echo(json_encode(array('status'=>FALSE))); 
			}
			
    }
	
    

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Atas Vigentes : 404 - Página Não Encontrada';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
	
	function uploadResults()
    {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        $this->form_validation->set_rules('bidding_id', 'Licitação', 'trim|required');


        if ($this->form_validation->run() == false)
        {
            $this->data['custom_error'] = (validation_errors() ?
                '<div class="alert alert-danger form_error">' . validation_errors() . '</div>' : false);
        } else
        {

            $bidding = $this->input->post('bidding_id');
            $data['biddingid'] = $bidding;
            $arquivo = $this->do_upload();

            if ($arquivo == true)
            {
				
				$data['custom_success'] = 'Carregamento da planilha executado com sucesso!';

                $file = $arquivo['file_name'];
                $path = $arquivo['full_path'];
                $tamanho = $arquivo['file_size'];
                $tipo = $arquivo['file_ext'];

                /**  Identify the type of $inputFileName  **/
                $inputFileType = PHPExcel_IOFactory::identify($path);
                /**  Create a new Reader of the type that has been identified  **/
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);

                /**  Load $inputFileName to a PHPExcel Object  **/
                $objPHPExcel = $objReader->load($path);

                foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
                {
                    $worksheetTitle = $worksheet->getTitle();
                    $highestRow = $worksheet->getHighestRow() - 1; // e.g. 10
                    $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
                    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                    $nrColumns = ord($highestColumn) - 64;

                    if ($nrColumns == 10 and $worksheetTitle == 'DADOS')
                    {
                        $linha = array();
                        for ($row = 2; $row <= $highestRow + 1; ++$row)
                        {
                            $val = array();
                            for ($col = 0; $col < $highestColumnIndex; ++$col)
                            {
                                $cell = $worksheet->getCellByColumnAndRow($col, $row);
                                $val[$col] = $cell->getValue();
                            }
                            $linha[] = array(
                                'item' => $val[0],
                                'requisicao' => $val[1],
                                'cnpj' => $val[2],
                                'razao' => $val[3],
								'qtd' => $val[4],
								'unid' => $val[5],
								'vunit' => $val[6],
								'vtot' => $val[7],
								'descricao' => $val[8],
								'ata' => $val[9]);
                        }

						if(count($linha) == 0) {
							$data['custom_success'] = null;
							$data['custom_error'] = 'Planilha carregada está vazia';
						}
						else
						{
                        	$data['feito'] = true;
                        	$this->session->set_userdata('importado', $linha);
						}
                    } 
					else
                    {
						$data['custom_success'] = null;
                        $data['custom_error'] = 'Planilha importada não é a fornecida pelo sistema!';
                    }
                }

                unlink($path);

            } else
            {
                $data['custom_error'] = 'Erro ao fazer upload do arquivo, verifique se a extensão do arquivo é permitida.';
            }
        }


		$data['biddings'] = $this->biddings_model->getBiddings();
        $data['process'] = 0;
        $data['aplicar'] = 0;
		$this->global['pageTitle'] = 'Atas Vigentes : Enviar Resultado de Licitação';
		$this->loadViews("uploadResults", $this->global, $data, NULL);
    }
	
    public function do_upload()
    {

        $date = date('d-m-Y');

        $config['upload_path'] = './assets/planilhas/';
        $config['allowed_types'] = 'xls';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = true;


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload())
        {
            $errors = array('error' => $this->upload->display_errors());
			
            $this->session->set_flashdata('error',
                'Erro ao fazer upload do arquivo, verifique se a extensão do arquivo é permitida.');

        } else
        {
            return $this->upload->data();
        }
    }
	
	function biddingsSrp()
    {
            $this->load->model('biddings_model');
            
            $data['biddingRecSrp'] = $this->biddings_model->getBiddings();
            
            $this->global['pageTitle'] = 'Atas Vigentes : Listagem de Licitações';
            
            $this->loadViews("biddingssrp", $this->global, $data, NULL);
    }	
	
	function atasB($biddingId = NULL)
	{
		if($biddingId == null)
		{
			redirect('index.php/biddingsSrp');
		}
		$data['atassrp'] = $this->biddings_model->getAtasByBidding($biddingId);

		$data['atas'] = $this->biddings_model->countAtasByBidding($biddingId)->atas;
		
		$data['biddingid'] = $biddingId;
		
		$this->global['pageTitle'] = 'Atas Vigentes : Atas SRP';
            
        $this->loadViews("listaratas", $this->global, $data, NULL);
	}
	
	function editOldA($ataId = NULL)
    {

            if($ataId == null)
            {
                redirect('index.php/atasB');
            }
            
			$data['ataInfo'] = $this->biddings_model->getAtaInfo($ataId);
            
            $this->global['pageTitle'] = 'Atas Vigentes : Editar Ata';
            
            $this->loadViews("editOldA", $this->global, $data, NULL);

    }

	function editAta()
    {
		
            $this->load->library('form_validation');
            
            $ataId = $this->input->post('ataId');
            
                $numeroata = strtoupper($this->input->post('numeroata'));
				$datainicio = date("Y-m-d",strtotime(str_replace('/','-',$this->input->post('datainicio'))));  
				
				if (!empty($_FILES['userfile']['name']))
				{
					$path = 'assets/atas/';
         			$config['upload_path'] = $path;
         			$config['allowed_types'] = 'pdf';
     
     			 	$this->load->library('upload', $config);
     			
     				if (!$this->upload->do_upload('userfile'))
					{
            			$this->session->set_flashdata('error', $this->upload->display_errors('<p>', '</p>'));
						$urlata = NULL;
					} 
					else 
					{
						$this->session->set_flashdata('success', 'Ata carregada corretamente.');
						$urlata = base_url().$path.$this->upload->data('file_name');
					}
				}
                
                $ataInfo = array();
				if(empty($_FILES['userfile']['name']))
                {
                    $ataInfo = array('numeroAta'=>$numeroata, 'data_inicio'=>$datainicio);
				}
				else
				{
					$ataInfo = array('numeroAta'=>$numeroata, 'data_inicio'=>$datainicio, 'urlAta'=>$urlata);
				}
                
                $result = $this->biddings_model->editAta($ataInfo, $ataId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Ata atualizada com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Atualização de ata falhou');
                }
                
                redirect('index.php/editOldA/'.$ataId);
    }
	
    function addNewA($biddingId)
    {

            $this->load->model('biddings_model');
            $data['atas'] = $this->biddings_model->getAtasFromItens($biddingId);		
            $data['biddingId'] = $biddingId;
			$data['qtd'] = $this->input->post('cAtas');
            $this->global['pageTitle'] = 'Atas Vigentes : Adicionar Nova Ata';

            $this->loadViews("addNewA", $this->global, $data, NULL);
    }	
	
    function addNewArq($biddingId)
    {

            $this->load->model('biddings_model');		
            $data['biddingId'] = $biddingId;
            $this->global['pageTitle'] = 'Atas Vigentes : Adicionar Novo Arquivo';

            $this->loadViews("addNewArq", $this->global, $data, NULL);
    }		
	
	function addNewAta()
    {

            $this->load->library('form_validation');
            $qtd = $this->input->post('qtd');
			$biddingId = $this->input->post('biddingId');
			$cntl = 0;
			do {
				$cntl++;
            $this->form_validation->set_rules('numeroata_'.$cntl,'Número da Ata','required');
			} while ($cntl < $qtd);
            
            if($this->form_validation->run() == FALSE)
            {
                $this->biddingsSrp();
            }
            else
            {
				$cntl = 0;
				do {
					$cntl++;
                $numeroata[$cntl] = strtoupper($this->input->post('numeroata_'.$cntl));
				$datainicio[$cntl] = date("Y-m-d",strtotime(str_replace('/','-',$this->input->post('datainicio_'.$cntl))));  
				
				if (!empty($_FILES['userfile_'.$cntl]['name']))
				{
					$path = 'assets/atas/';
         			$config['upload_path'] = $path;
         			$config['allowed_types'] = 'pdf';
     
     			 	$this->load->library('upload', $config);
     			
     				if (!$this->upload->do_upload('userfile_'.$cntl))
					{
            			$this->session->set_flashdata('error', $this->upload->display_errors('<p>', '</p>'));
						$urlata[$cntl] = NULL;
					} 
					else 
					{
						$this->session->set_flashdata('success', 'Ata carregada corretamente.');
						$urlata[$cntl] = base_url().$path.$this->upload->data('file_name');
					}
				}			
                } while ($cntl < $qtd);
				$cntl = 0;
                $ataInfo = array();
				do {
				$cntl++;
				if(empty($_FILES['userfile_'.$cntl]['name']))
                {                
                    $ataInfo[$cntl] = array('numeroAta'=>$numeroata[$cntl], 'licitacao_id'=>$biddingId, 'data_inicio'=>$datainicio[$cntl]);
				}
				else
				{
					$ataInfo[$cntl] = array('numeroAta'=>$numeroata[$cntl], 'licitacao_id'=>$biddingId, 'data_inicio'=>$datainicio[$cntl], 'urlAta'=>$urlata[$cntl]);
				}
				} while ($cntl < $qtd);
			
                $this->load->model('biddings_model');
                $result = $this->biddings_model->addNewAta($ataInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Nova ata criada com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Criação de ata falhou');
                }
                
                redirect('index.php/addNewA/'.$biddingId);
            }
    }
	
	function addNewArquivo()
    {

            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('tituloarquivo','Nome do Arquivo','required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->biddingsSrp();
            }
            else
            {
            	$tituloarquivo = strtoupper($this->input->post('tituloarquivo'));
			
				$resultado = $this->input->post('resultado');  
				
				$biddingId = $this->input->post('biddingId');

				
				if (!empty($_FILES['userfile']['name']))
				{
					$path = 'assets/arquivos/';
         			$config['upload_path'] = $path;
         			$config['allowed_types'] = 'xls';
     
     			 	$this->load->library('upload', $config);
     			
     				if (!$this->upload->do_upload('userfile'))
					{
            			$this->session->set_flashdata('error', $this->upload->display_errors('<p>', '</p>'));
						$urlarquivo = NULL;
					} 
					else 
					{
						$this->session->set_flashdata('success', 'Arquivo carregado corretamente.');
						$urlarquivo = base_url().$path.$this->upload->data('file_name');
					}
				}			
                
                $arquivoInfo = array();
				if(empty($_FILES['userfile']['name']))
                {			
                    $arquivoInfo = array('tituloArquivo'=>$tituloarquivo, 'resultado'=>$resultado, 'licitacao_id'=>$biddingId, 'usuario_id'=>$this->vendorId, 'dataArquivo'=>date('Y-m-d H:i:s'));
				}
				else
				{
					$arquivoInfo = array('tituloArquivo'=>$tituloarquivo, 'resultado'=>$resultado, 'urlArquivo'=>$urlarquivo, 'licitacao_id'=>$biddingId, 'usuario_id'=>$this->vendorId, 'dataArquivo'=>date('Y-m-d H:i:s'));
				}
                
                $this->load->model('biddings_model');
                $result = $this->biddings_model->addNewArquivo($arquivoInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Novo arquivo criado com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Criação de arquivo falhou');
                }
                
                redirect('index.php/addNewArq/'.$biddingId);
            }
    }
	
	
	function editOldArq($arquivoId = NULL)
    {

            if($arquivoId == null)
            {
                redirect('index.php/arquivosB');
            }
            
			$data['arquivoInfo'] = $this->biddings_model->getArquivoInfo($arquivoId);
            
            $this->global['pageTitle'] = 'Atas Vigentes : Editar Arquivo';
            
            $this->loadViews("editOldArq", $this->global, $data, NULL);

    }
	
	function editArquivo()
    {
		
            $this->load->library('form_validation');
			$this->form_validation->set_rules('tituloarquivo','Nome do Arquivo','required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldArq();
            }
            else
            {
            
            	$arquivoId = $this->input->post('arquivoId');
            
            	$tituloarquivo = strtoupper($this->input->post('tituloarquivo'));
			
				$resultado = $this->input->post('resultado');  
				
				if (!empty($_FILES['userfile']['name']))
				{
					$path = 'assets/arquivos/';
         			$config['upload_path'] = $path;
         			$config['allowed_types'] = 'xls';
     
     			 	$this->load->library('upload', $config);
     			
     				if (!$this->upload->do_upload('userfile'))
					{
            			$this->session->set_flashdata('error', $this->upload->display_errors('<p>', '</p>'));
						$urlArquivo = NULL;
					} 
					else 
					{
						$this->session->set_flashdata('success', 'Arquivo carregado corretamente.');
						$urlArquivo = base_url().$path.$this->upload->data('file_name');
					}
				}
                
                $arquivoInfo = array();
				if(empty($_FILES['userfile']['name']))
                {			
                    $arquivoInfo = array('tituloArquivo'=>$tituloarquivo, 'resultado'=>$resultado);
				}
				else
				{
					$arquivoInfo = array('tituloArquivo'=>$tituloarquivo, 'resultado'=>$resultado, 'urlArquivo'=>$urlArquivo);
				}
                
                $result = $this->biddings_model->editArquivo($arquivoInfo, $arquivoId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Arquivo atualizado com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Atualização de arquivo falhou');
                }
                
                redirect('index.php/editOldArq/'.$arquivoId);
			}
    }
	
	function viewI($biddingId = NULL)
	{
		if($biddingId == null)
		{
			redirect('index.php/biddingListing');
		}
		$data['infoItens'] = $this->biddings_model->getItensByBiddings($biddingId);
		
		$data['biddingid'] = $biddingId;
		
		$this->global['pageTitle'] = 'Atas Vigentes : Lista de Itens da Licitação';
            
        $this->loadViews("listaritens", $this->global, $data, NULL);
	}
	
    function addNewI($biddingId)
    {
		
            $data['biddingId'] = $biddingId;
            $this->global['pageTitle'] = 'Atas Vigentes : Adicionar Novo Item';

            $this->loadViews("addNewI", $this->global, $data, NULL);
    }		
	
	function addNewItem()
	{
		$this->load->library('form_validation');
            
			$this->form_validation->set_rules('numitem','Número do Item','trim|required|numeric|max_length[3]');
			$this->form_validation->set_rules('requisicao', 'Requisição','trim|required|max_length[11]');
            $this->form_validation->set_rules('descricao','Descrição','trim|required');
			$this->form_validation->set_rules('quantidade', 'Quantidade','trim|required|numeric');			
			$this->form_validation->set_rules('medida', 'Unid. Fornecimento','trim|required');
            $this->form_validation->set_rules('vunit','V. Unitário','trim|required');
			$this->form_validation->set_rules('vtot','V. Total','trim|required');
            $this->form_validation->set_rules('fcnpj','CNPJ','trim|required');
			$this->form_validation->set_rules('frazao','Razão Social','trim|required');
			$this->form_validation->set_rules('numata','Numero da Ata','trim|required');
			
            if($this->form_validation->run() == FALSE)
            {
                $this->viewI();
            }
            else
            {
				$biddingId = $this->input->post('biddingid');
				$numitem = $this->input->post('numitem');
				$requisicao = strtoupper($this->input->post('requisicao'));
				$descricao = $this->input->post('descricao');
				$quantidade = $this->input->post('quantidade');
				$medida = $this->input->post('medida');
				$precounit = str_replace(",", ".", str_replace(".", "",$this->input->post('vunit')));
				$precotot = str_replace(",", ".", str_replace(".", "",$this->input->post('vtot')));
				$fcnpj = $this->input->post('fcnpj');
				$frazao = mb_strtoupper($this->input->post('frazao'));
				$numata = strtoupper($this->input->post('numata'));
                
                $itemInfo = array();
                
                $itemInfo = array('licitacao_id'=>$biddingId, 'requisicao'=>$requisicao, 'num_item'=>$numitem, 'descricao'=>$descricao, 'medida'=>$medida, 'quantidade'=>$quantidade, 'preco_unitario'=>$precounit, 'preco_total'=>$precotot, 'fornecedor_cnpj'=>$fcnpj, 'fornecedor_razao'=>$frazao, 'numeroAta'=>$numata);
                
                $this->load->model('biddings_model');
                $result = $this->biddings_model->addNewItem($itemInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Novo item criado com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Criação de item falhou');
                }
                
                redirect('index.php/addNewI/'.$biddingId);
            }
	}
	
	function editOldI($itemId = NULL)
    {

            if($itemId == null)
            {
                redirect('index.php/ViewI');
            }
            
			$data['itemInfo'] = $this->biddings_model->getItemInfo($itemId);
            
            $this->global['pageTitle'] = 'Atas Vigentes : Editar Item';
            
            $this->loadViews("editOldI", $this->global, $data, NULL);

    }

	function editItem()
	{
		$this->load->library('form_validation');
		
			$itemId = $this->input->post('itemId');
            
			$this->form_validation->set_rules('numitem','Número do Item','trim|required|numeric|max_length[3]');
			$this->form_validation->set_rules('requisicao', 'Requisição','trim|required|max_length[11]');
            $this->form_validation->set_rules('descricao','Descrição','trim|required');
			$this->form_validation->set_rules('quantidade', 'Quantidade','trim|required|numeric');			
			$this->form_validation->set_rules('medida', 'Unid. Fornecimento','trim|required');
            $this->form_validation->set_rules('vunit','V. Unitário','trim|required');
			$this->form_validation->set_rules('vtot','V. Total','trim|required');
            $this->form_validation->set_rules('fcnpj','CNPJ','trim|required');
			$this->form_validation->set_rules('frazao','Razão Social','trim|required');
			$this->form_validation->set_rules('numata','Numero da Ata','trim|required');
			
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldI($itemId);
            }
            else
            {
				$biddingId = $this->input->post('biddingid');
				$numitem = $this->input->post('numitem');
				$requisicao = strtoupper($this->input->post('requisicao'));
				$descricao = $this->input->post('descricao');
				$quantidade = $this->input->post('quantidade');
				$medida = $this->input->post('medida');
				$precounit = str_replace(",", ".", str_replace(".", "",$this->input->post('vunit')));
				$precotot = str_replace(",", ".", str_replace(".", "",$this->input->post('vtot')));
				$fcnpj = $this->input->post('fcnpj');
				$frazao = mb_strtoupper($this->input->post('frazao'));
				$numata = strtoupper($this->input->post('numata'));
                
                $itemInfo = array();
                
                $itemInfo = array('licitacao_id'=>$biddingId, 'requisicao'=>$requisicao, 'num_item'=>$numitem, 'descricao'=>$descricao, 'medida'=>$medida, 'quantidade'=>$quantidade, 'preco_unitario'=>$precounit, 'preco_total'=>$precotot, 'fornecedor_cnpj'=>$fcnpj, 'fornecedor_razao'=>$frazao, 'numeroAta'=>$numata);
                
                $this->load->model('biddings_model');
                $result = $this->biddings_model->editItem($itemInfo, $itemId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Item atualizado com sucesso');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Atualização do item falhou');
                }
                
                redirect('index.php/editOldI/'.$itemId);
            }
	}
	
}

?>