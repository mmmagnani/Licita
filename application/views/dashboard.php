
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
                    <h3 class="box-title">Licitações Agendadas</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="licitacoes" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="min-width:100px">Modalidade</th>
                      <th style="min-width:40px">Nº</th>
                      <th style="min-width:40px">Tipo</th>
                      <th style="min-width:40px">Objeto</th>
                      <th style="min-width:40px">Data do Certame</th>
                      <th style="min-width:80px">Horário</th>
                      <th style="min-width:100px">Pregoeiro / Presidente Comissão</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($agenda_pregoes))
                    {
                        foreach($agenda_pregoes as $agenda)
                        {
							$datalicitacao = date('d/m/Y',strtotime($agenda->dataLicitacao));
                    ?>
                    
                    
                    <tr>
                      <td><?php echo $agenda->modalidade ?></td>
                      <td><?php echo $agenda->numero ?></td>
                      <td><?php echo $agenda->nomeTipo ?></td>
                      <td><?php echo $agenda->descricao ?></td>
                      <td><?php echo $datalicitacao ?></td>
                      <td><?php echo $agenda->horaLicitacao ?></td>
                      <td><?php echo $agenda->nomeUsuario ?></td>
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
            <div class="col-xs-12">
              <div class="box">
                <div style="border-top:groove; border-top-color:#06F" class="box-header">
                    <h3 class="box-title">Atas Vigentes</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="atas" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Nº Licitação</th>
                      <th>Ano</th>
					  <th>OM</th>
                      <th>Modalidade</th>
                      <th style="max-width:250px">Objeto</th>
					  <th>GERSET/Gerente</th>
					  <th>Ato Nomeação</th>
                      <th>Vencimento</th>
                      <th style="min-width:120px">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($atas_vigentes))
                    {
                        foreach($atas_vigentes as $vigentes)
                        {
							$datavencimento = date('d/m/Y',strtotime($vigentes->vencimento));
                    ?>
                    
                    
                    <tr>
                      <td><?php echo $vigentes->numero ?></td>
                      <td><?php echo $vigentes->anoLicitacao ?></td>
					  <td><?php echo $vigentes->om ?></td>
                      <td><?php echo $vigentes->modalidade ?></td>
                      <td><?php echo $vigentes->descricao ?></td>
					  <td><?php echo $vigentes->gerset ?></td>
					  <td><?php echo $vigentes->ato_nomeacao ?></td>
                      <td><?php echo $datavencimento ?></td>
                      <td class="text-center">
                      
                      <?php if($vigentes->urlArquivo != null) 
					  { ?>
                      <a target="_blank" class="btn btn-sm btn-success tip-top" title="Download Planilha Resultado" href="<?php echo $vigentes->urlArquivo ?>"><i class="fa fa-download"></i></a>
                      <?php }
					  else { ?>
                      <a class="btn btn-success.disabled tip-top" title="Planilha Resultado Indisponível" href="#"><i class="fa fa-download"></i></a>                      
					  <?php } ?>
                      
                      <a class="btn btn-sm btn-info tip-top" title="Ver Atas" href="<?php echo base_url().'index.php/verAtas2/'.$vigentes->idLicitacao; ?>"><i class="fa fa-eye"></i></a></td>
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

<script type="text/javascript">
	    $(document).ready(function() {
        $('#licitacoes').dataTable( {
			"order": [[ 4, 'asc' ], [ 5, 'asc' ], [1, 'asc']],
            "language": {
                "url": "<?php echo base_url(); ?>assets/extra-libs/DataTables/Portuguese-Brasil.json"
			}
        } );

        $('#atas').dataTable( {
			"order": [[ 2, 'asc' ], [0, 'asc'], [ 5, 'asc' ]],
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
