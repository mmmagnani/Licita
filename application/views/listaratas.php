<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-files-o"></i> Atas SRP
        <small>Adicionar, Editar, Apagar</small>
      </h1>
    </section>    
    <section class="content">
        <div class="row">
            <div class="col-xs-8 text-right">
                <div class="form-group">
                <form method="post" id="add" name="add" action="<?php echo base_url(); ?>index.php/addNewA/<?php echo $biddingid ?>">
                	<label style="vertical-align:baseline; padding-top:1px"><i class="fa fa-plus"></i> Adicionar </label>
                	<select style="max-width:60px; vertical-align:baseline; padding-top:1px" id="cAtas" name="cAtas">
                    <?php 
					
						for($i = 1; $i <= $atas; $i++){
					?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                    </select>
                    <input name="Enviar" type="submit" class="btn btn-primary" value="Ata(s)">
                </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-8">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Atas</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                  <table id="atasrp" class="table table-striped table-bordered">

                  <thead>
                    <tr>
                      <th>Nº Ata</th>
                      <th>Início Vigência</th>
                      <th class="text-center">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($atassrp))
                    {
                        foreach($atassrp as $a)
                        {
							$datainicio = date('d/m/Y',strtotime($a->data_inicio));
                    ?>
                    
                    
                    <tr>
                      <td><?php echo $a->numeroAta ?></td>
                      <td><?php echo $datainicio ?></td>
                      <td class="text-center">
                      <?php if($a->urlAta != null) 
					  { ?>
                      <a target="_blank" class="btn btn-sm btn-success tip-top" title="Download Ata" href="<?php echo $a->urlAta ?>"><i class="fa fa-download"></i></a>
                      <?php }
					  else { ?>
                      <a class="btn btn-success.disabled tip-top" title="Download Indisponível" href="#"><i class="fa fa-download"></i></a>
                      <?php } ?> <a class="btn btn-sm btn-info tip-top" title="Editar" href="<?php echo base_url().'index.php/editOldA/'.$a->idAta ?>"><i class="fa fa-pencil"></i></a>   
                   <a class="btn btn-sm btn-danger tip-top deleteAta" title="Apagar" href="#" data-ataid="<?php echo $a->idAta; ?>" data-urlata=<?php echo $a->urlAta; ?>><i class="fa fa-trash"></i></a></td>           
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
     
		$('#atasrp').dataTable( {
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