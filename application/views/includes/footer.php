

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Atas Vigentes</b> Administração do Sistema | Versão 2.0
        </div>
    <strong><a href="<?php echo base_url(); ?>">BANT</a></strong> &copy; 2020</footer>
    
    <!-- jQuery UI 1.11.2 -->
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
	
    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parents().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parents().addClass('active');
    </script>
    
    <script>
    $(document).ready(function() {
		$('.tip-top').tooltip({ placement: 'top' });
	});
	</script>
	
  </body>
</html>