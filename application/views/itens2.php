
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
                    <h3 class="box-title">ATA <?php echo $forn->numeroAta.' | Empresa: CNPJ '.$forn->fornecedor_cnpj.' | '.$forn->fornecedor_razao ?></h3>
                </div><!-- /.box-header -->
				<div style="margin-left:10px; margin-right:10px; margin-top:20px" class="alert alert-info alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<label>Saldos devem ser verificados no Sistema SILOMS, módulo Aquisição e Contratos.</label>
				</div>
                <div class="box-body table-responsive">
                  <table id="itens" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Item</th>
                      <th>Requisição</th>
                      <th>Descrição</th>
                      <th>Qtd.</th>
                      <th>Unid.</th>
                      <th>Valor Unit. (R$)</th>
                      <th>Valor Total (R$)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($itens))
                    {
                        foreach($itens as $it)
                        {	
							$vunit = number_format($it->preco_unitario,4,',','.');
							$vtotal = number_format($it->preco_total,4,',','.');	
                    ?>
                    <tr>
                      <td><?php echo $it->num_item ?></td>
                      <td><?php echo $it->requisicao ?></td>
                      <td><?php echo $it->descricao ?></td> 
                      <td><?php echo $it->quantidade ?></td>
                      <td><?php echo $it->medida ?></td> 
                      <td><?php echo $vunit ?></td>  
                      <td><?php echo $vtotal ?></td>         
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
     
		$('#itens').dataTable( {
            "language": {
                "url": "<?php echo base_url(); ?>assets/extra-libs/DataTables/Portuguese-Brasil.json"
			}
        } );
    } );
</script>            

