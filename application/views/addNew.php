<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Manutenção de Usuário
        <small>Adicionar  Usuário</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->             
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Informe os Dados do Usuário</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>index.php/addNewUser" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Nome </label>
                                        <input type="text" class="form-control required" placeholder="Nome completo" id="fname" name="fname" maxlength="128">
                                    </div>
                                </div>
                                 <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="lname">Login </label>
                                        <input type="text" class="form-control required" placeholder="Nome de usuário" id="lname" name="lname" maxlength="16">
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email </label>
                                        <input type="text" class="form-control required email" placeholder="Informe um Email" id="email"  name="email" maxlength="128">
                                    </div>
                                </div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="imagem">Foto </label>
										<span class="control-fileupload">
										<label for="userfile">Arquivo : </label>
                                        <input type="file" id="userfile" name="userfile" accept="image/*" /></span>
                                    </div>
                                </div>
                             </div>
                             <div class="row">
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pregoeiro">Pregoeiro? </label>
                                        <select class="form-control" name="pregoeiro" id="pregoeiro">
                                        	<option value="0">Não</option>
                                            <option value="1">Sim</option>
                                        </select>
                                    </div>
                                </div>                             
                             	<div class="col-md-6">
                             		<div class="form-group">
										<label for="preview">Pré-visualização</label>
                                    	<div align="center" id="preview" style="border-bottom-color:#2A1FFF; border:thin; border-style:solid; height:76px; width:76px">
                                    
  										<img id="foto" src="#" alt="sem imagem" style="height:64px; margin-top:5px" />
										</div>
                                    </div>
								</div>
							</div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Senha</label>
                                        <input type="password" class="form-control required" placeholder="Senha" id="password"  name="password" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Confirmar Senha</label>
                                        <input type="password" class="form-control required equalTo" placeholder="Confirmar Senha" id="cpassword" name="cpassword" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Ramal</label>
                                        <input type="text" class="form-control required digits" placeholder="Ramal de contato" id="mobile" name="mobile" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Permissão</label>
                                        <select class="form-control required" id="role" name="role">
                                            <option value="0">Selecione Permissão</option>
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->idPermissao ?>"><?php echo $rl->nome ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Enviar" />
                            <input type="reset" class="btn btn-default" value="Limpar" alt="Limpar formulário" />
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

<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript">
</script>
<script type="text/javascript">
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#foto').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  } else {
	$('#foto').attr('src', '#');
  }
}

$("#userfile").change(function() {
  readURL(this);
});


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