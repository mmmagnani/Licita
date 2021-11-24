<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alterar Foto
        <small>Defina uma nova foto para sua conta</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Selecione o arquivo</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?php echo base_url() ?>index.php/changePhoto" method="post" id="changePhoto" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
										<label for="imagem">Foto </label>
                                        <span class="control-fileupload">
										<label for="userfile">Arquivo : </label>
                                        <input type="file" id="userfile" name="userfile" accept="image/*" /></span>
                                        <p style="margin-top:5px">pré-visualização</p>
                                    <div align="center" id="preview" style="border-bottom-color:#2A1FFF; border:thin; border-style:solid; height:76px; width:76px">
                                    
  										<img id="foto" src="<?php echo $imagem; ?>" alt="sem imagem" style="height:64px; margin-top:5px" />
									</div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Enviar" />
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