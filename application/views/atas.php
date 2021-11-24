<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="pt-br" dir="ltr"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="pt-br" dir="ltr"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="pt-br" dir="ltr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="pt-br" dir="ltr"> <!--<![endif]-->
    <head>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/padraogoverno01/bootstrap/css/bootstrap.min.css" type='text/css'/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/padraogoverno01/css/template-azul.css" type='text/css'/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/padraogoverno01/font-awesome/css/font-awesome.min.css" type='text/css'/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/padraogoverno01/font-awesome-more-icons/css/admin/editor_styles.css" type='text/css'/>
        <link href="<?php echo base_url(); ?>assets/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />


    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="BANT - Base Aérea de Natal" />
	<title>BANT - Atas Vigentes</title>
	<link href="<?php echo base_url(); ?>assets/images/DOMBANT2.png" rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/extra-libs/DataTables/datatables.css">
	<script src="<?php echo base_url(); ?>assets/padraogoverno01/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/padraogoverno01/js/jquery-migrate.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/padraogoverno01/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	
		
	<!--[if lt IE 9]><link rel="stylesheet" href="<?php echo base_url(); ?>assets/mod_barradogoverno/assets/default/css/ie8.css" /><![endif]-->


    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/padraogoverno01/css/estilo.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/padraogoverno01/css/estilo-contraste.css" />
    <link href="<?php echo base_url(); ?>assets/padraogoverno01/css/fontes.css"  rel="stylesheet" type="text/css">
	

		
</head>
<body>
<span id="topo_principal"></span>
<div class="layout">
    <header>
        <div class="container">
            <div class="row-fluid">
                <div id="logo" class="span8 small">
                    <a href="http://www.bant.intraer/" title="Base Aérea de Natal">
                            <div class="span2">
                                <img src="<?php echo base_url(); ?>assets/images/DOMBANT2.png" alt="Grupamento de Apoio de Natal" />
                            </div>
                        <div class="span10">
                            <span class="portal-title-1">Força Aérea Brasileira</span>
                            <h1 class="portal-title corto">Base Aérea de Natal</h1>
                            <span class="portal-description">COMANDO AÉREO NORDESTE</span>
                        </div>
                    </a>
                </div>
                <!-- fim .span8 -->
                
                
            </div>
            <!-- fim .row-fluid -->
        </div>
        <!-- fim div.container -->

    </header>
    <main>
        <div class="container">
                    <div class="row-fluid">
            <section id="em-destaque" 
	>
                                
<div class="rastro-navegacao row-flutuante">
<a href="http://www.bant.intraer/index.php?option=com_blankcomponent&amp;view=default&amp;Itemid=101" class="pathway">Página inicial</a> <span class="separator"> &gt; </span> <a href="<?php echo base_url(); ?>" class="pathway">Licitações Agendadas e Atas Vigentes</a><span class="separator"> &gt; </span><span>Atas</span></div>
            </section>
        </div>
        
<div class="row-fluid">
                                    <div id="navigation" class="span3">
                        <a href="#" class="visible-phone visible-tablet mainmenu-toggle btn"><i class="icon-list"></i>&nbsp;Menu</a>
                        <section id="navigation-section">

                
        <nav class="span10 ">
            <h2 >Login <i class="icon-chevron-up visible-phone visible-tablet pull-right"></i></h2>
            <?php $this->load->helper('form'); ?>
            <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
                <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>                    
            </div>
        <?php }
        $success = $this->session->flashdata('success');
        if($success)
        {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $success; ?>                    
            </div>
        <?php } ?>
            <!-- visible-phone visible-tablet -->
            <form method="post" action="<?php echo base_url(); ?>index.php/loginMe" class="form-inline">
		<div class="userdata">
		<div id="form-login-username" class="control-group">
			<div class="controls">
									<div class="input-prepend">
						<span class="add-on">
							<span class="icon-user hasTooltip" title="Nome"></span>
							<label for="modlgn-username" class="element-invisible">Nome</label>
						</span>

						<input id="username" name="username" type="text" class="input-small" tabindex="0" size="18" placeholder="Login" />
					</div>
							</div>
		</div>
		<div id="form-login-password" class="control-group">
			<div class="controls">
									<div class="input-prepend">
						<span class="add-on">
							<span class="icon-lock hasTooltip" title="Senha">
							</span>
								<label for="modlgn-passwd" class="element-invisible">Senha							</label>
						</span>
						<input id="senha" type="password" name="senha" class="input-small" tabindex="0" size="18" placeholder="Senha" />
					</div>
							</div>
		</div>
						
				<div id="form-login-submit" class="control-group">
			<div class="controls">
				<button id="btn-acessar" type="submit" tabindex="0" name="Submit" class="btn btn-primary login-button">Entrar</button>
			</div>
		</div>
        <a href="<?php echo base_url() ?>index.php/forgotPassword">Esqueceu sua senha?</a><br>
		</div>
	</form>
        </nav>
        
                            <span class="hide">Fim do menu principal</span>
                        </section>
                    </div>
                    <!-- fim #navigation.span3 -->
                                <div id="content" class="span9 internas">
                    <section id="content-section">
                        <span class="hide">Início do conteúdo da página</span>

                        
                        
                            
           <div class="row-fluid">
            <div class="col-xs-12">
              <div class="box">
                <div style="border-top:groove; border-top-color:#06F" class="box-header">
                    <h3 class="box-title">Atas</h3>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
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
                      <?php } ?> <a class="btn btn-sm btn-info tip-top" title="Ver Itens" href="<?php echo base_url().'index.php/verItens/'.$a->idAta ?>"><i class="fa fa-eye"></i></a></td>              
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
                            
                            
                        
                        <span class="hide">Fim do conteúdo da página</span>
                    </section>
                </div>
                <!-- fim #content.span9 -->
            </div>
            <!-- fim .row-fluid -->
        </div>
        <!-- fim .container -->
    </main>
    <footer>
        <div class="footer-atalhos">
            <div class="container">
                <div class="pull-right voltar-ao-topo"><a href="#topo_principal"><i class="icon-chevron-up"></i>&nbsp;Voltar para o topo</a></div>
            </div>
        </div>
        <div class="container container-menus">
            <div id="footer" class="row footer-menus">
                <span class="hide">Início da navegação de rodapé</span>
                
        <div class="">		
            <nav class="row rodape-intraer nav">
                                <div style="text-align: center;">© BANT - Base Aérea de Natal - Rua do Especialista s/n° - Emaús</div>
<div style="text-align: center;">CEP 59148-900 - Parnamirim - RN</div>
<div style="text-align: center;">PABX: (84) 3644-7100 / FAX (84) 3643-1619<br />E-mail: protocolo.bant@fab.mil.br<br /><br /><br />
</div>
<div class="create" style="text-align: right;"><span style="font-size: 8pt;"></span>
</div>            </nav>					
        </div>

        
                <span class="hide">Fim da navegação de rodapé</span>
            </div>
            <!-- fim .row -->
        </div>
        <!-- fim .container -->
                <div class="footer-ferramenta">
            <div class="container">
                BANT - Base Aérea de Natal - Rua do Especialista s/n° - Emaús
CEP 59148-900 - Parnamirim - RN
PABX: (84) 3644-7100 / FAX (84) 3643-1619
E-mail: protocolo.bant@fab.mil.br            </div>
        </div>
        <div class="footer-atalhos visible-phone">
            <div class="container">
                <span class="hide">Fim do conteúdo da página</span>
                <div class="pull-right voltar-ao-topo"><a href="#topo_principal"><i class="icon-chevron-up"></i>&nbsp;Voltar para o topo</a></div>
            </div>
        </div>
    </footer>
</div>
<!-- fim div#wrapper -->
<!-- scripts principais do template -->
		
	    <script src="<?php echo base_url(); ?>assets/padraogoverno01/js/jquery.cookie.js" type="text/javascript"></script><noscript>&nbsp;<!-- item para fins de acessibilidade --></noscript>
	    <script src="<?php echo base_url(); ?>assets/padraogoverno01/js/template.js" type="text/javascript"></script><noscript>&nbsp;<!-- item para fins de acessibilidade --></noscript>

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
                
		<!-- debug -->
        
        
</body>
</html>



