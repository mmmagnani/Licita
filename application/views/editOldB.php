<?php

$biddingId = '';
$modalidade = '';
$tipo = '';
$srp = '';
$numero = '';
$om = '';
$anoLicitacao = '';
$descricao = '';
$dataLicitacao = '';
$horaLicitacao = '';
$pregoeiro = '' ;
$nup = '';
$gerset = '';
$ato_nomeacao = '';

if(!empty($biddingInfo))
{
    foreach ($biddingInfo as $bf)
    {
        $biddingId = $bf->idLicitacao;
		$modalidade = $bf->modalidade_id;
		$tipo = $bf->tipo_id;
		$srp = $bf->srp;
		$numero = $bf->numero;
		$om = $bf->om;
		$anoLicitacao = $bf->anoLicitacao;
		$descricao = $bf->descricao;
		$dataLicitacao = $bf->dataLicitacao;
		$horaLicitacao = $bf->horaLicitacao;
		$pregoeiro = $bf->usuario_id;
		$nup = $bf->nup;
		$gerset = $bf->gerset;
		$ato_nomeacao = $bf->ato_nomeacao;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-gavel"></i> Cadastro de Licitações
        <small>Editar Licitação</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Atualize os Dados da Licitação</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>index.php/editBidding" method="post" id="editBidding">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="modalidade">Modalidade </label>
                                        <select class="form-control" id="modalidade" name="modalidade">
                                            <option value="0">Selecione a Modalidade</option>
                                            <?php
                                            if(!empty($modalities))
                                            {
                                                foreach ($modalities as $md)
                                                {
                                                    ?>
                                                    <option value="<?php echo $md->idModalidade; ?>" <?php if($md->idModalidade == $modalidade) {echo "selected=selected";} ?>><?php echo $md->modalidade ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" value="<?php echo $biddingId; ?>" name="biddingId" id="biddingId" />    
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="tipo">Tipo </label>
                                        <select class="form-control" id="tipo" name="tipo">
                                            <option value="0">Selecione o Tipo</option>
                                            <?php
                                            if(!empty($types))
                                            {
                                                foreach ($types as $ty)
                                                {
                                                    ?>
                                                    <option value="<?php echo $ty->idTipo; ?>" <?php if($ty->idTipo == $tipo) {echo "selected=selected";} ?>><?php echo $ty->nomeTipo ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="numero">Nº da Licitação </label>
                                        <input type="text" class="form-control" id="numero" placeholder="Número da Licitação" name="numero" value="<?php echo $numero; ?>" maxlength="3">                                    
                                  </div>
                                </div>
                                <div class="col-md-6">
									<div class="form-group">
                                        <label for="descricao">OM</label>
                                        <input type="text" class="form-control" id="om" placeholder="OM da Licitação" name="om" value="<?php echo $om ?>" maxlength="15">
                                    </div>
                                </div>								
                                <div class="col-md-6">
									<div class="form-group">
                                        <label for="descricao">Objeto</label>
                                        <input type="text" class="form-control" id="descricao" placeholder="Descrção do Objeto" name="descricao" value="<?php echo $descricao ?>">
                                    </div>
                                </div>
                              <div class="col-md-6">
									<div class="form-group">
                                    <label for="srp">SRP?</label>
                                    	<select class="form-control" id="srp" name="srp">
                                        	<option value="0" <?php if($srp == 0) {echo "selected=selected";} ?>>Não</option>
                                            <option value="1" <?php if($srp == 1) {echo "selected=selected";} ?>>Sim</option>
                                        </select>

                                    </div>
								</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="anolicita">Ano da Licitação </label>
										<div class="input-group date">
                                        <input type="text" class="form-control" id="anolicita" placeholder="Ano da Licitação" value="<?php echo $anoLicitacao ?>" name="anolicita"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="datalicita">Data da Licitação </label>
										<div class="input-group date">
                                        <input type="text" class="form-control" id="datalicita" placeholder="Data da Licitação" value=<?php echo date('d/m/Y',strtotime($dataLicitacao)) ?> name="datalicita"><span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
										</div>									
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="horalicita">Hora da Licitação </label>
                                       	<div class="input-group clockpicker">
    									<input type="text" class="form-control" id="horalicita" placeholder="Hora da Licitacão" name="horalicita" value="<?php echo date('H:i',strtotime($horaLicitacao)) ?>">          
        								<span class="input-group-addon">
        									<i class="glyphicon glyphicon-time"></i>
    									</span>      
   	 									</div>                      
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pregoeiro">Pregoeiro </label>
                                        <select class="form-control" id="pregoeiro" name="pregoeiro">
                                            <option value="0">Selecione o Pregoeiro</option>
                                            <?php
                                            if(!empty($criers))
                                            {
                                                foreach ($criers as $cr)
                                                {
                                                    ?>
                                                    <option value="<?php echo $cr->idUsuario; ?>" <?php if($cr->idUsuario == $pregoeiro) {echo "selected=selected";} ?>><?php echo $cr->nomeUsuario ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>    
                            </div>
							<div class="row">  
							    <div class="col-md-6">
									<div class="form-group">
                                        <label for="descricao">PAG</label>
                                        <input type="text" class="form-control" id="nup" placeholder="Digite o PAG" name="nup" value="<?php echo $nup ?>">
                                    </div>
                                </div>                                    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="numero">GERSET/Gerente da ATA </label>
                                        <input type="text" class="form-control" id="gerset" placeholder="Nome do GERSET/Gerente" name="gerset" value="<?php echo $gerset; ?>">                                     
                                  </div>
                                </div>
                                <div class="col-md-6">
									<div class="form-group">
                                        <label for="descricao">Ato de Nomeação</label>
                                        <input type="text" class="form-control" id="ato_nomeacao" placeholder="Ato de Nomeação" name="ato_nomeacao" value="<?php echo $ato_nomeacao ?>">
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
            <div class="col-md-4">
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
        </div>    
    </section>   
</div>

<script src="<?php echo base_url(); ?>assets/js/editBidding.js" type="text/javascript"></script>
<script type="text/javascript">
    $('#datalicita').datepicker({
    	format: "dd/mm/yyyy",
    	todayBtn: "linked",
    	clearBtn: true,
    	language: "pt-BR",
    	orientation: "top auto",
    	autoclose: true,
    	todayHighlight: true
    });

    $('#anolicita').datepicker({
        format: "yyyy",
		orientation: "top auto",
        startView: 2,
		maxViewMode:2,
		minViewMode: 2,
		defaultViewDate: "year",
        clearBtn: true,
        language: "pt-BR",
        autoclose: true,
    });

</script>
<script type="text/javascript">
$('.clockpicker').clockpicker({
    placement: 'top',
    donetext: 'Fechar'
});
</script>
