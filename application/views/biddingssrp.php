<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-files-o"></i> Atas e Arquivos SRP
        <small>Adicionar, Editar, Apagar</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Licitações SRP</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="bsrpconfig" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Modalidade</th>
                      <th>Número</th>
					  <th>OM</th>
                      <th>Ano</th>
                      <th>Objeto</th>
                      <th style="min-width:120px" class="text-center">Atas | Arquivos</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($biddingRecSrp))
                    {
                        foreach($biddingRecSrp as $rs)
                        {
                    ?>
                    
                    
                    <tr>
                      <td><?php echo $rs->modalidade ?></td>
                      <td><?php echo $rs->numero ?></td>
					  <td><?php echo $rs->om ?></td>
                      <td><?php echo $rs->anoLicitacao ?></td>
                      <td><?php echo $rs->descricao ?></td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-info tip-top" title="Atas" href="<?php echo base_url().'index.php/atasB/'.$rs->idLicitacao; ?>"><i class="fa fa-file-pdf-o"></i></a>
                          <a class="btn btn-sm btn-success tip-top" title="Arquivos" href="<?php echo base_url().'index.php/arquivosB/'.$rs->idLicitacao; ?>"><i class="fa fa-file-excel-o"></i></a>
                      </td>
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
		
        $('#bsrpconfig').dataTable( {
			"order": [[ 3, 'asc' ], [ 2, 'asc' ]],
			"columnDefs": [
				{
					"targets": [5],
					"orderable": false,
				},
			],
            "language": {
                "url": "<?php echo base_url(); ?>assets/extra-libs/DataTables/Portuguese-Brasil.json"
			}
        } );
    } );
</script>
