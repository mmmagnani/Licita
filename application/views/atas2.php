
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Administração
        <small>Painel de controle</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">

            <div class="col-xs-12">
              <div class="box">
                <div style="border-top:groove; border-top-color:#06F" class="box-header">
                    <h3 class="box-title">Atas</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="ata" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nº Ata</th>
                      <th>Início Vigência</th>
                      <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($atas))
                    {
                        foreach($atas as $a)
                        {
							$datainicio = date('d/m/Y',strtotime($a->data_inicio));
                    ?>
                    
                    
                    <tr>
                      <td><?php echo $a->numeroAta ?></td>
                      <td><?php echo $datainicio ?></td>
                      <td class="text-center">
                      <?php if($a->urlAta != null) 
					  { ?>
                      <a class="btn btn-sm btn-success tip-top" title="Download da Ata" href="<?php echo $a->urlAta ?>"><i class="fa fa-download"></i></a>
                      <?php }
					  else { ?>
                      <a class="btn btn-success.disabled tip-top" title="Download Indisponível" href="#"><i class="fa fa-download"></i></a>
                      <?php } ?> <a class="btn btn-sm btn-info tip-top" title="Ver Itens" href="<?php echo base_url().'index.php/verItens2/'.$a->idAta ?>"><i class="fa fa-eye"></i></a></td>              
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
     
		$('#ata').dataTable( {
			"columnDefs": [
				{
					"targets": [2],
					"orderable": false,
				},
			],
            "language": {
                "url": "<?php echo base_url(); ?>assets/extra-libs/DataTables/Portuguese-Brasil.json"
			}
        } );
    } );
</script>            

