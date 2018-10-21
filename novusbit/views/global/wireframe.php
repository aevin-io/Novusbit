<?=doctype('html5');?>

<html lang="en" prefix="fb: http://www.facebook.com/2008/fbml">
<head>
	<?php  $this->load->view( 'global/header'); ?>
	<?php  $this->load->view( 'global/javascripts'); ?>
</head>

<body>
      
	<div class="body_normal" id="page_body">
	<?php
    if(!logged()){
?>
		<?php // $this->load->view( 'global/toolbar'); ?>
		<div class="showlogin" style="z-index:9000; right:50px; position: absolute; top:10px;">

		<?php echo _("Login"); ?>
	</div>

<div class="loginbox">

<? $this->load->view( 'global/signin.inc.php'); ?>

</div>	
<? } ?>
		<?php
		
		$types = $this->novus_model->get_types();
		$data['types'] =  $types ;
		$data['current_type'] =  urldecode( $this->uri->segment( 1 ) );
		
		$this->load->view( 'global/topbar', $data); 
		
		?>
		
		<div id="dialog" title="Choose your alias"></div>
		<div id="next_prev_target"></div>
		<div id="feedback">
			<div style="">
						</div>
		</div>
		<div id="feedback_dialog"></div>
		<Div id="blanker"></Div>
		
	
		
		
		<div id="contents_wrap" class="contents_wrap wrapper">   
		
			<div id="contents" class="contents">
			    
			</div> <!-- end of #contents div -->
	    
			<div id="options_panel">	    
			
			</div> <!-- end of #options div -->
	
		</div> <!-- end of #contents_wrap div -->
	
		<div id="footer">
	
			 <?php  $this->load->view( 'global/footer'); ?>
			 
		</div> <!-- end of #footer div -->
    
	</div> <!-- end of #page_body div -->
	
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-44275948-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html> 
