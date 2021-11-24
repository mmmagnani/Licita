<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-gavel"></i> Cadastro de Licitações
        <small>Adicionar, Editar, Apagar</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/addNewB"><i class="fa fa-plus"></i> Adicionar nova</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Licitações</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="bconfig" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Modalidade</th>
                      <th>Tipo</th>
					  <th>SRP</th>
                      <th>Número</th>
					  <th>OM</th>
                      <th>Ano</th>
                      <th style="max-width:250px">Objeto</th>
					  <th>Data Licitação</th>
                      <th style="min-width:120px"  class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($biddingRecords))
                    {
                        foreach($biddingRecords as $record)
                        {
						if($record->srp == 0) 
						{
							$srp = 'Não';
						}
						else
						{
							$srp = 'Sim';
						}
						$datalicitacao = date('d/m/Y',strtotime($record->dataLicitacao));
                    ?>
                    
                    
                    <tr>
                      <td><?php echo $record->modalidade ?></td>
                      <td><?php echo $record->nomeTipo ?></td>
					  <td><?php echo $srp ?></td>
                      <td><?php echo $record->numero ?></td>
					  <td><?php echo $record->om ?></td>
                      <td><?php echo $record->anoLicitacao ?></td>
                      <td><?php echo $record->descricao ?></td>
                      <td><?php echo $datalicitacao ?></td>
                      <td class="text-center">
                      	  <a class="btn btn-sm btn-success tip-top" title="Visualizar" href="<?php echo base_url().'index.php/viewI/'.$record->idLicitacao; ?>"><i class="fa fa-eye"></i></a>
                          <a class="btn btn-sm btn-info tip-top" title="Editar" href="<?php echo base_url().'index.php/editOldB/'.$record->idLicitacao; ?>"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger deleteBidding tip-top" title="Apagar" href="#" data-biddingid="<?php echo $record->idLicitacao; ?>"><i class="fa fa-trash"></i></a>
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
        $('#bconfig').dataTable( {
			"order": [[ 5, 'asc' ], [ 3, 'asc' ], [ 4, 'asc' ]],
			"columnDefs": [
				{
					"targets": [8],
					"orderable": false,
				},
			],
            "language": {
                "url": "<?php echo base_url(); ?>assets/extra-libs/DataTables/Portuguese-Brasil.json"
			}
        } );
    } );
</script>