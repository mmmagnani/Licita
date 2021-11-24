<?php $process = (isset($_GET["go"])) ? $_GET["go"] : "0"; ?>
<?php $aplicar = (isset($_GET["aplicar"])) ? $_GET["aplicar"] : "0"; ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-gavel"></i> Enviar Resultado de Licitação SRP
        <small>Upload de Planilha Resultado</small>
      </h1>
    </section>
<?php

if ($process == 0 && $aplicar == 0)
{
    if (isset($feito) && $feito == true)
    {
?>    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">

    
                        <div class="box-footer">
                            <a href="?go=1&bidding_id=<?php echo $biddingid; ?>" class="btn btn-success">Processar Planilha</a>
                            <a href="<?php echo current_url() ?>" class="btn btn-danger" onclick="<?php $this->session->set_flashdata('success'); ?>"><i class="glyphicon glyphicon-arrow-left"></i> Voltar</a>
                        </div>
                </div>
            </div>            
			<div class="col-md-4">
                <?php
                    $this->load->helper('form');

                    if(isset($custom_error))
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $custom_error; ?>                    
                </div>
                <?php } ?>
                <?php  

                    if(isset($custom_success))
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $custom_success; ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
     </section>
<?php
    } 
	else
    {
?> 
    <section class="content">

        <div class="row">
            <div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Informe os dados</h3>
                </div><!-- /.box-header -->
				<div class="col-md-8">
					<label style="color:#0000CC"><strong>PLANILHA MODELO PARA DOWNLOAD - <a href="<?php echo base_url(); ?>assets/arquivos/modelo/PLANILHA_MODELO_ATAS.xls"><u>CLIQUE AQUI</u></a></strong></label>
				</div>
              <!-- form start -->
				<form action="<?php echo base_url(); ?>index.php/uploadResults" id="formArquivo" enctype="multipart/form-data" method="post" >
				<div class="box-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="biddings">Licitação </label>
								<select id="bidding_id" name="bidding_id" class="form-control" data-live-search="true">
                                <option value=""></option>

									<?php
                                            if(!empty($biddings))
                                            {
                                                foreach ($biddings as $bd)
                                                {
                                    ?>
                                                    <option value="<?php echo $bd->idLicitacao; ?>"><?php echo $bd->modalidade ?> Nº <?php echo $bd->numero ?>/<?php echo $bd->om ?>/<?php echo $bd->anoLicitacao ?> - <?php echo $bd->descricao ?></option>
                                    <?php
                                                }
                                            }
                                    ?>
								</select>  
 
							</div>
						</div>                    
						<div class="col-md-6">
							<div class="form-group">
								<label for="planilha">Planilha</label>  
                                <span class="control-fileupload">
                                <label for="userfile">Arquivo : </label>                     
								<input id="arquivo" type="file" name="userfile" accept="application/vnd.ms-excel" class="form-control" /></span>      
							</div>    
						</div>                
					</div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                	<button type="submit" class="btn btn-primary" onclick="<?php $this->session->set_flashdata('error'); ?>"><i class="glyphicon glyphicon-upload icon-white"></i> Upload</button>
                </div>
                </form>
              </div><!-- /.box-primary -->
            </div>
			<div class="col-md-4">
                <?php
                    $this->load->helper('form');
					if(isset($custom_error)){
                    	$error = $custom_error;
					}
					else
					{
						$error ='';
					}
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $custom_error; ?>                    
                </div>
                <?php } ?>
                <?php 
                    if(isset($custom_success))
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $custom_success; ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
         </div>
    </section>
<?php
    }
}

?>
<?php
if ($process == "1")
{
    if ($this->session->userdata('importado'))
    {
echo    '<section class="content">';
echo        '<div class="row">';
echo            '<div class="col-xs-12">';
echo              '<div class="box">';
echo                '<div class="box-header">';
echo                    '<h3 class="box-title">Verifique se os dados foram importados corretamente e clique em [Carregar Resultados]. Se houver algum erro clique em [Voltar].</h3>';
echo                '</div><!-- /.box-header -->';
echo                '<div class="box-body table-responsive">';
echo                  '<table id="bconfig" class="table table-striped table-bordered">';
echo                  '<thead>';
echo                    '<tr>';
echo                      '<th>Item</th>';
echo                      '<th>Requisição</th>';
echo					  '<th>Descrição</th>';
echo					  '<th>Qtd.</th>';
echo                      '<th>Unid.</th>';
echo					  '<th>V. Unit.</th>';
echo					  '<th>V. Total</th>';
echo					  '<th>CNPJ</th>';
echo                      '<th>Razão Social</th>';
echo					  '<th>Ata</th>';
echo                    '</tr>';
echo                    '</thead>';
echo                    '<tbody>';
                        foreach ($this->session->userdata('importado') as $r)
						{
							echo '<tr>';
							echo '<td>' . $r['item'] . '</td>';
							echo '<td>' . $r['requisicao'] . '</td>';
							echo '<td>' . $r['descricao'] . '</td>';
							echo '<td>' . $r['qtd'] . '</td>';
							echo '<td>' . $r['unid'] . '</td>';
							echo '<td>' . number_format(floatval($r['vunit']), 2, ',', '.') . '</td>';
							echo '<td>' . number_format(floatval($r['vtot']), 2, ',', '.') . '</td>';
							echo '<td>' . $r['cnpj'] . '</td>';
							echo '<td>' . $r['razao'] . '</td>';
							echo '<td>' . $r['ata'] . '</td>';
							echo '</tr>';
						}
						echo '</tbody>';
						echo '</table>';
						echo '</div> <!--box body -->';
						echo '<div class="box-footer">';
                        echo '<a href="?aplicar=1&bidding_id=' . $_GET['bidding_id'] . '" class="btn btn-success">Carregar Resultados</a> <a href="' . base_url() . 'index.php/uploadResults" class="btn btn-danger" onclick="' . $this->session->set_flashdata('success') . '"><i class="glyphicon glyphicon-arrow-left"></i> Voltar</a>';   
                        echo '</div> <!-- box footer -->';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</section>';
    } 
	else
	{
        redirect(base_url() . 'index.php/uploadResults');
    }
}
if ($aplicar == 1)
{
    if ($this->session->userdata('importado'))
    {
        $biddingid = $_GET['bidding_id'];
        $received = array();
        $received = $this->session->userdata('importado');
        $this->session->unset_userdata('importado');
        $data2 = array();
        foreach ($received as $r2)
        {
            $valor_unit = number_format(floatval($r2['vunit']), 2, '.', '');
            $valor_tot = number_format(floatval($r2['vtot']), 2, '.', '');			
            $data = array(
                'licitacao_id' => $biddingid,
                'requisicao' => $r2['requisicao'],
                'num_item' => $r2['item'],
                'descricao' => $r2['descricao'],
                'medida' => $r2['unid'],
                'quantidade' => $r2['qtd'],
                'preco_unitario' => $valor_unit,
				'preco_total' => $valor_tot,
				'fornecedor_cnpj' => $r2['cnpj'],
				'fornecedor_razao' => $r2['razao'],
				'numeroAta' => $r2['ata']
                );
            $this->biddings_model->add('itens', $data);
            $data2[] = $data;
        }

echo    '<section class="content">';
echo        '<div class="row">';
echo            '<div class="col-xs-12">';
echo              '<div class="box">';
echo                '<div class="box-header">';
echo                    '<h3 class="box-title">Importação realizada. Clique em [Sair] para voltar ao Painel de Controle.</h3>';
echo                '</div><!-- /.box-header -->';
echo                '<div class="box-body table-responsive">';
echo                  '<table id="bconfig" class="table table-striped table-bordered">';
echo                  '<thead>';
echo                    '<tr>';
echo                      '<th>Item</th>';
echo                      '<th>Requisição</th>';
echo					  '<th>Descrição</th>';
echo					  '<th>Qtd.</th>';
echo                      '<th>Unid.</th>';
echo					  '<th>V. Unit.</th>';
echo					  '<th>V. Total</th>';
echo					  '<th>CNPJ</th>';
echo                      '<th>Razão Social</th>';
echo					  '<th>Ata</th>';
echo                    '</tr>';
echo                    '</thead>';
echo                    '<tbody>';
                        foreach ($data2 as $d2)
						{
							echo '<tr>';
							echo '<td>' . $d2['num_item'] . '</td>';
							echo '<td>' . $d2['requisicao'] . '</td>';
							echo '<td>' . $d2['descricao'] . '</td>';
							echo '<td>' . $d2['quantidade'] . '</td>';
							echo '<td>' . $d2['medida'] . '</td>';
							echo '<td>' . number_format(floatval($d2['preco_unitario']), 2, ',', '.') . '</td>';
							echo '<td>' . number_format(floatval($d2['preco_total']), 2, ',', '.') . '</td>';
							echo '<td>' . $d2['fornecedor_cnpj'] . '</td>';
							echo '<td>' . $d2['fornecedor_razao'] . '</td>';
							echo '<td>' . $d2['numeroAta'] . '</td>';
							echo '</tr>';
						}
						echo '</tbody>';
						echo '</table>';
						echo '</div> <!--box body -->';
						echo '<div class="box-footer">';
                        echo '<a href="' . base_url() . 'index.php/dashboard" class="btn btn-info" onclick="' . $this->session->set_flashdata('success') . '"><i class="glyphicon glyphicon-arrow-left"></i> Sair</a>';   
                        echo '</div> <!-- box footer -->';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</section>';
    } 
	else
	{
        redirect(base_url() . 'index.php/uploadResults');
    }
}
?>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/custom.min.js"></script>

<script>
  $(document).on("change","input[type=file]",function(){
    var t = $(this).val();
	if (t == "")
		var labelText = 'Arquivo : ';
	else if (t.substr(0, 12) == "C:\\fakepath\\")
    	var labelText = 'Arquivo : ' + t.substr(12, t.length);
	else 
	    var labelText = 'Arquivo : ' + t;
    $(this).prev('label').text(labelText);
  });
</script>