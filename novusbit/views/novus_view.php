<?php uriresolve(); ?>
<script>

		$( window ).scroll( function( ){ 
		

			var scroller_object = $( ".novus_sidebar" );

			if( document.documentElement.scrollTop >= 10 || window.pageYOffset >= 10 )
			{
				//alert("2");
				if( $.browser.msie && $.browser.version == "6.0" )
				{
					scroller_object.css( "top", ( document.documentElement.scrollTop ) + "px" );
				}
				else
				{
					scroller_object.css( { position: "fixed", top: "60px" } );
				}
			}
			console.clear();
			
			//console.log("documentElement.scrollTop: "+window.pageYOffset);
			//console.log("document.getElementById('all_bits_wrapper').offsetHeight: 	"+( document.getElementById("all_bits_wrapper").offsetHeight-400));
			
			if( window.pageYOffset > ( document.getElementById("all_bits_wrapper").offsetHeight-400) )
			{
				//scroller_object.css( { position: "absolute", top: window.pageYOffset } );
				scroller_object.css( { position: "absolute", "top": ( document.getElementById("all_bits_wrapper").offsetHeight-350) + "px"} );
				console.log(window.pageYOffset);
				//alert("100");
				
			}
		} );
	
</script>

<script src="<?=base_url();?>novusbit/js/novus.actions.js" type="text/javascript"></script>
    
     <?php

	include('novus/novus.inc.php'); 

	// include('novus/comments.inc.php');  

	include('novus/bits.inc.php');    
    	
	if( $novus['end'] != 'Y' )
	{ 
	    if ( logged() )
	    {
		include('novus/expander.inc.php');
	    }

	   //  include('novus/keywords.inc.php');
	}
	else
	{
	    echo '<h3>This novus has been ended by its author.</h3>';
	}

    ?>   
   <script>
   $(function(){
  
 $('#loading').hide();
 });
 </script>
</div> <!-- end of #contents -->