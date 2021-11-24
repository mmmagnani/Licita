<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-gavel"></i> Itens da Licitação
        <small>Inserir Item</small>
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
                        <h3 class="box-title">Informe os Dados do Item</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>index.php/addNewItem" method="post" id="addNewItem">
                        <div class="box-body">
                            <div class="row">
                            	<div class="col-md-4">
                                    <div class="form-group">
                                        <label for="numitem">Número do Item </label>
									
                                        <input type="text" class="form-control" id="numitem" placeholder="Número do Item" name="numitem">
                                        <input type="hidden" value="<?php echo $biddingId; ?>" name="biddingid" id="biddingid" />
									</div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="requisicao">Requisição </label>
                                        <input type="text" class="form-control" id="requisicao" placeholder="Código da Requisição" name="requisicao" style="text-transform:uppercase">																		
                                    </div>
                                </div>
                                <div class="col-md-4">
                                	<div class="form-group">
                                        <label for="descricao">Descrição </label>                                       	                                        <textarea class="form-control" id="descricao" placeholder="Descrição do Item" name="descricao" rows="3"></textarea>
                              		</div>
                              	</div>
                              	<div class="col-md-4">
                              		<div class="form-group">
                                        <label for="quantidade">Quantidade </label>                                       	                                        <input type="text" class="form-control" id="quantidade" placeholder="Quantidade do Item" name="quantidade">
                                	</div>
                              	</div>
                              	<div class="col-md-4">
                              		<div class="form-group">
                                        <label for="medida">Unid. </label>                                       	                                        <input type="text" class="form-control" id="medida" placeholder="Unidade de Fornecimento do Item" name="medida">
                                	</div>
                              	</div>                                
                              	<div class="col-md-4">
                              		<div class="form-group">
                                        <label for="vunit">Valor Unitário </label>                                       	                                        <input type="text" class="form-control money" id="vunit" placeholder="Valor Unitário do Item" name="vunit">
                                	</div>
                              	</div>
                                <div class="col-md-4">
                              		<div class="form-group">
                                        <label for="vtot">Valor Total </label>                                       	                                        <input type="text" class="form-control money" id="vtot" placeholder="Valor Total do Item" name="vtot">
                                	</div>
                              	</div>
                                <div class="col-md-4">
                              		<div class="form-group">
                                        <label for="fcnpj">CNPJ Fornecedor </label>                                       	                                        <input type="text" class="form-control cnpj" id="fcnpj" placeholder="CNPJ do Fornecedor" name="fcnpj">
                                	</div>
                              	</div>
                                <div class="col-md-4">
                              		<div class="form-group">
                                        <label for="frazao">Razão Social Fornecedor </label>                                       	                                        <input type="text" class="form-control" id="frazao" placeholder="Razão Social do Fornecedor" name="frazao" style="text-transform:uppercase">
                                	</div>
                              	</div>
                                <div class="col-md-4">
                              		<div class="form-group">
                                        <label for="numata">Número da Ata </label>                                       	                                        <input type="text" class="form-control" id="numata" placeholder="Número da Ata" name="numata" style="text-transform:uppercase">
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
<script src="<?php echo base_url(); ?>assets/js/addItem.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.maskMoney.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
		$('.cnpj').mask('00.000.000/0000-00', {reverse: true});
		$('.money').maskMoney({thousands:'.',decimal:',',precision:4});
	});
</script>