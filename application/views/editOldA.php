<?php

$ataId = '';
$numeroata = '';
$datainicio = '';
$urlata = '';

if(!empty($ataInfo))
{
    foreach ($ataInfo as $af)
    {
        $ataId = $af->idAta;
		$numeroata = $af->numeroAta;
		$datainicio = $af->data_inicio;
		$urlata = $af->urlAta;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-gavel"></i> Atas SRP
        <small>Editar Ata</small>
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
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Atualize os Dados da Ata</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>index.php/editAta" method="post" id="editAta" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="numeroata">Número da Ata </label>
									
                                        <input type="text" class="form-control" id="numeroata" placeholder="Número da Ata" value="<?php echo $numeroata ?>" name="numeroata" readonly="readonly">
                                        <input type="hidden" value="<?php echo $ataId; ?>" name="ataId" id="ataId" />
										</div>
                                    </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="datainicio">Data Início da Validade </label>
										<div class="input-group date">
                                        <input type="text" class="form-control" id="datainicio" placeholder="Data Início da Validade" value=<?php echo date('d/m/Y',strtotime($datainicio)) ?> name="datainicio"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										</div>									
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="urlata">Arquivo da Ata </label>
                                       	<span class="control-fileupload">
										<label for="userfile">Arquivo : </label>
                                        <input type="file" id="userfile" name="userfile" accept="application/pdf" /></span>                      
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

<script type="text/javascript">
    $('#datainicio').datepicker({
    	format: "dd/mm/yyyy",
    	todayBtn: "linked",
    	clearBtn: true,
    	language: "pt-BR",
    	orientation: "auto",
    	autoclose: true,
    	todayHighlight: true
    });

</script>
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
