<?php

$userId = '';
$name = '';
$email = '';
$imagem = '';
$mobile = '';
$roleId = '';
$pregoeiro = '';

if(!empty($userInfo))
{
    foreach ($userInfo as $uf)
    {
        $userId = $uf->idUsuario;
        $name = $uf->nomeUsuario;
        $email = $uf->emailUsuario;
        $mobile = $uf->ramal;
		$imagem = $uf->imagem;
        $roleId = $uf->permissao_id;
		$login = $uf->login;
		$pregoeiro = $uf->pregoeiro;
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Manutenção de Usuário
        <small>Editar Usuário</small>
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
                    
                    <form role="form" action="<?php echo base_url() ?>index.php/editUser" method="post" id="editUser" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                       <label for="fname">Nome </label>
                                       <input type="text" class="form-control" id="fname" placeholder="Nome completo" name="fname" value="<?php echo $name; ?>" maxlength="128">
                                       <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />
                                    </div>
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="lname">Login </label>
                                        <input type="text" class="form-control" id="lname" placeholder="Nome de usuário" name="lname" value="<?php echo $login; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email </label>
                                        <input type="email" class="form-control" id="email" placeholder="Informe um email" name="email" value="<?php echo $email; ?>" maxlength="128">
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
                                        	<option value="0" <?php if($pregoeiro == 0) {echo "selected=selected";} ?>>Não</option>
                                            <option value="1" <?php if($pregoeiro == 1) {echo "selected=selected";} ?> >Sim</option>
                                        </select>
                              		</div>
                            	</div>
                            	<div class="col-md-6">
                                	<div class="form-group">
										<label for="preview">Pré-visualização</label>
                                    	<div align="center" id="preview" style="border-bottom-color:#2A1FFF; border:thin; border-style:solid; height:76px; width:76px">
  										<img id="foto" src="<?php echo $imagem ?>" alt="sem imagem" style="height:64px; margin-top:5px" />
										</div>
                                  	</div>
								</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Senha </label>
                                        <input type="password" class="form-control" id="password" placeholder="Senha" name="password" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Confirmar Senha </label>
                                        <input type="password" class="form-control" id="cpassword" placeholder="Confirmar Senha" name="cpassword" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Ramal </label>
                                        <input type="text" class="form-control" id="mobile" placeholder="Ramal de contato" name="mobile" value="<?php echo $mobile; ?>" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                        <label for="role">Permissão </label>
                                    <select class="form-control" id="role" name="role">
                                            <option value="0">Selecione a Permissão</option>
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->idPermissao; ?>" <?php if($rl->idPermissao == $roleId) {echo "selected=selected";} ?>><?php echo $rl->nome ?></option>
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

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>
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