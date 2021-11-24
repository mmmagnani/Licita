<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Manutenção de Usuários
        <small>Adicionar, Editar, Apagar</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/addNew"><i class="fa fa-plus"></i> Adicionar novo</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Usuários</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="zero_config" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nome</th>
                      <th>Login</th>
                      <th>Email</th>
                      <th>Ramal</th>
                      <th>Permissão</th>
                      <th class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    
                    
                    <tr>
                      <td><?php echo $record->idUsuario ?></td>
                      <td><?php echo $record->nomeUsuario ?></td>
                      <td><?php echo $record->login ?></td>
                      <td><?php echo $record->emailUsuario ?></td>
                      <td><?php echo $record->ramal ?></td>
                      <td><?php echo $record->nome ?></td>
                      <td class="text-center">
                          <a class="btn btn-sm btn-info tip-top" title="Editar" href="<?php echo base_url().'index.php/editOld/'.$record->idUsuario; ?>"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger deleteUser tip-top" title="Desativar" href="#" data-userid="<?php echo $record->idUsuario; ?>"><i class="fa fa-close"></i></a>
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
        $('#zero_config').dataTable( {
			"order": [[ 1, 'asc' ]],
			"columnDefs": [
				{
					"targets": [6],
					"orderable": false,
				},
			],
            "language": {
                "url": "<?php echo base_url(); ?>assets/extra-libs/DataTables/Portuguese-Brasil.json"
			}
        } );
    } );

</script>
