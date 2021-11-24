<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
	
    <link href="<?php echo base_url(); ?>assets/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo base_url(); ?>assets/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/extra-libs/DataTables/datatables.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assets/plugins/datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/jQuery-Time-Picker/dist/jquery-clockpicker.css" rel="stylesheet" type="text/css" />  
    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
    </style>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
	<script src="<?php echo base_url(); ?>assets/plugins/datepicker/js/bootstrap-datepicker.js" /></script>
	<script src="<?php echo base_url(); ?>assets/plugins/datepicker/locales/bootstrap-datepicker.pt-BR.min.js" charset="UTF-8" /></script>
<script src="<?php echo base_url(); ?>assets/plugins/jQuery-Time-Picker/dist/jquery-clockpicker.js" /></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- <body class="sidebar-mini skin-black-light"> -->
  <body class="skin-blue sidebar-mini sidebar-collapse">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>ATAS</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Atas Vigentes</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Alterar navegação</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo $imagem; ?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo $imagem; ?>" class="img-circle" alt="User Image" />
                    
                      <div align="center">
					  <a href="<?php echo base_url(); ?>index.php/loadChangePhoto"; class="btn btn-default btn-flat"><i class="fa fa-file-image-o"></i> Alterar Foto</a>
					</div>
                    <p>
                      <?php echo $name; ?>
                      <small><?php echo $role_text; ?></small>
                    </p>
                    
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>index.php/loadChangePass" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Alterar Senha</a>
                    </div>
					
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>index.php/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sair</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>index.php/dashboard">
                <i class="fa fa-dashboard"></i> <span>Painel de controle</span></i>
              </a>
            </li>
            <li class="treeview">
              <a href="#" >
                <i class="fa fa-gavel"></i>
                <span>Licitações</span>
				<span class="fa fa-angle-left pull-right"></span>
              </a>
			  	<ul class="treeview-menu">
					<li class="treview"><a href="<?php echo base_url(); ?>index.php/biddingListing"><i class="fa fa-circle-o"></i> <span> Cadastro</span></a></li>
					<li class="treview"><a href="<?php echo base_url(); ?>index.php/uploadResults"><i class="fa fa-circle-o"></i> <span> Enviar Resultado (SRP)</span></a></li>
				</ul>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>index.php/biddingsSrp" >
                <i class="fa fa-files-o"></i>
				<span>Atas e Arquivos</span>
			  </a>
            </li>
            <?php
            if($role == ROLE_MANAGER)
            {
            ?>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>index.php/userListing">
                <i class="fa fa-users"></i>
                <span>Usuários</span>
              </a>
            </li>
            <?php
            }
            ?>
          </ul>
        </section>
        <!-- /.sidebar -->
</aside>