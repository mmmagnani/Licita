<?php

$arquivoId = '';
$titulo = '';
$resultado = '';
$urlarquivo = '';

if(!empty($arquivoInfo))
{
    foreach ($arquivoInfo as $ai)
    {
        $arquivoId = $ai->idArquivo;
		$titulo = $ai->tituloArquivo;
		$resultado = $ai->resultado;
		$urlarquivo = $ai->urlArquivo;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-gavel"></i> Arquivos
        <small>Editar Arquivo</small>
      </h1>
    </section>
    
    <section class="content">
                <div class="col-md-8">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-8">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Atualize os Dados do Arquivo</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>index.php/editArquivo" method="post" id="editAta" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tituloarquivo">Nome do Arquivo </label>
									
                                        <input type="text" class="form-control" id="tituloarquivo" placeholder="Informe o nome do arquivo" value="<?php echo $titulo ?>" name="tituloarquivo">
                                        <input type="hidden" value="<?php echo $arquivoId; ?>" name="arquivoId" id="arquivoId" />
										</div>
                                    </div>

                                <div class="col-md-6">                                                										
                                	<div class="form-group">
                                        <label for="resultado">Resultado de Licitação? </label>
										<select id="resultado" name="resultado" class="form-control">
                                        	<option value="0" <?php if($resultado == 0) {echo "selected=selected";} ?>>Não</option>
                                            <option value="1" <?php if($resultado == 1) {echo "selected=selected";} ?>>Sim</option>
                                        </select>
									</div>									
                                </div>
                             </div>
                             <div class="row">
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="urlarquivo">Arquivo </label>
                                       	<span class="control-fileupload">
										<label for="userfile">Selecione o arquivo </label>
                                        <input type="file" id="userfile" name="userfile" accept="application/vnd.ms-excel" /></span>                      
                                    </div>
                                </div>
                              </div>
                              
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                              <input type="submit" class="btn btn-primary" value="Enviar" />
                              <input type="reset" class="btn btn-default" value="Reverte" alt="Descartar alterações" />
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </section>   
</div>

<script>
  $(document).on("change","input[type=file]",function(){
    var t = $(this).val();
	if (t == "")
		var labelText = 'Selecione o arquivo';
	else if (t.substr(0, 12) == "C:\\fakepath\\")
    	var labelText = t.substr(12, t.length);
	else
	    var labelText = t;
    $(this).prev('label').text(labelText);
  });
</script>
