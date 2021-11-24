 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-files-o"></i> Itens da Licitação
        <small>Adicionar, Editar, Apagar</small>
      </h1>
    </section>    
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>index.php/addNewI/<?php echo $biddingid ?>"><i class="fa fa-plus"></i> Adicionar novo</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Itens</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                  <table id="itens" class="table table-striped table-bordered">

                  <thead>
                    <tr>
                      <th>Nº Item</th>
                      <th>Requisição</th>
                      <th>Descrição</th>
                      <th>Qtd.</th>
                      <th>Unid.</th>
                      <th>V. Unit.</th>
                      <th>V. Total.</th>
                      <th>CNPJ</th>
                      <th>R. Social</th>
                      <th>Ata</th>
                      <th class="text-center" style="min-width:55px">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($infoItens))
                    {
                        foreach($infoItens as $inf)
                        {
							$vunit = number_format($inf->preco_unitario,4,',','.');
							$vtotal = number_format($inf->preco_total,4,',','.')
                    ?>
                    
                    
                    <tr>
                      <td><?php echo $inf->num_item ?></td>
                      <td><?php echo $inf->requisicao ?></td>
                      <td><?php echo $inf->descricao ?></td> 
                      <td><?php echo $inf->quantidade ?></td>
                      <td><?php echo $inf->medida ?></td> 
                      <td><?php echo $vunit ?></td>  
                      <td><?php echo $vtotal ?></td>
                      <td><?php echo $inf->fornecedor_cnpj ?></td>
                      <td><?php echo $inf->fornecedor_razao ?></td>
                      <td><?php echo $inf->numeroAta ?></td>
                      <td class="text-center">

				  <a class="btn btn-sm btn-info tip-top" title="Editar" href="<?php echo base_url().'index.php/editOldI/'.$inf->idItem ?>"><i class="fa fa-pencil"></i></a>   
                   <a class="btn btn-sm btn-danger tip-top deleteItem" title="Apagar" href="#" data-itemid="<?php echo $inf->idItem; ?>"><i class="fa fa-trash"></i></a></td>           
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
			"columnDefs": [
				{
					"targets": [10],
					"orderable": false,
				},
			],
            "language": {
                "url": "<?php echo base_url(); ?>assets/extra-libs/DataTables/Portuguese-Brasil.json"
			}
        } );
    } );
</script>            