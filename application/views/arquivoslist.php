<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-files-o"></i> Arquivos
        <small>Adicionar, Editar, Apagar</small>
      </h1>
    </section>    
    <section class="content">
        <div class="row">
            <div class="col-xs-8 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/addNewArq/<?php echo $biddingid ?>"><i class="fa fa-plus"></i> Adicionar novo</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-8">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Arquivos</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                  <table id="arquiv" class="table table-striped table-bordered">

                  <thead>
                    <tr>
                      <th>Nome do Arquivo</th>
                      <th class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($arquivosRecords))
                    {
                        foreach($arquivosRecords as $ar)
                        {
                    ?>
                    <tr>
                      <td><?php echo $ar->tituloArquivo ?></td>
                      <td class="text-center"><?php if($ar->urlArquivo != null) 
					  { ?>
                        <a target="_blank" class="btn btn-sm btn-success tip-top" title="Download Arquivo" href="<?php echo $ar->urlArquivo ?>"><i class="fa fa-download"></i></a>
                      <?php }
					  else { ?>
                      <a class="btn btn-success.disabled tip-top" title="Download Indisponível" href="#"><i class="fa fa-download"></i></a>
                      <?php } ?> <a class="btn btn-sm btn-info tip-top" title="Editar" href="<?php echo base_url().'index.php/editOldArq/'.$ar->idArquivo ?>"><i class="fa fa-pencil"></i></a>   
                   <a class="btn btn-sm btn-danger tip-top deleteArquivo" title="Apagar" href="#" data-arqid="<?php echo $ar->idArquivo; ?>" data-urlarq=<?php echo $ar->urlArquivo; ?>><i class="fa fa-trash"></i></a></td>           
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">

                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/custom.min.js"></script>

<script src="<?php echo base_url(); ?>assets/extra-libs/DataTables/datatables.min.js"></script>

<script>
    $(document).ready(function() {
		$('.tip-top').tooltip({ placement: 'top' });
     
		$('#arquiv').dataTable( {
			"columnDefs": [
				{
					"targets": [1],
					"orderable": false,
				},
			],
            "language": {
                "url": "<?php echo base_url(); ?>assets/extra-libs/DataTables/Portuguese-Brasil.json"
			}
        } );
    } );
</script>            