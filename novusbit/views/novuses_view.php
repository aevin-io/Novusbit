<?php uriresolve(); ?>

<? if ( $this->uri->segment( 2 ) != 'author_contents_page' && $this->uri->segment( 2 ) != 'welcome_novus' && $this->uri->segment( 2 ) != 'welcome_novus_recentbits' ) { ?>
<div id="current_type" style="">Latest Submissions</div> 
<? } ?>
     

     


<?php if(empty($novuses[0])): ?>


						  
					
<strong>We couldn't find any novus in here :(</strong><br>You can always start your novus!  

<?  $location = $this->uri->segment( 4 ); if( ( $location == 'novus' || $location == 'author_contents_page' || $location == 'undefined')  && logged() && isset($owner) ): ?>
<br><br><strong>Take a moment and start your </strong>
    <a href="new" id="newnovus-button" class="button">New Novus</a>
  <?php endif; ?>
<script>	$('#loading').hide(); </script>
<?php else: ?>
<?php

	$location = $this->uri->segment( 4 );
	$author_username = $this->uri->segment( 3 );
	
	if( $location == "" )  $location = $this->uri->segment( 2 );
	 
	$i=0;
	
	if( $location != 'welcome_novus' && $location != 'welcome_novus_recentbits')
	    include('novus/sortingbar.inc.php');
	
	?>
	<!-- container -->
	<div id="container"  <?php if( $location == 'welcome_novus' || $location == 'welcome_novus_recentbits' ){ ?> class="slideshow" <?php } else { echo 'style="min-height:570px"'; }?>>
	
	<?php
	foreach( $novuses as $index => $novus ):
	    if( is_array($novus)){
	    if( array_key_exists( 'title', $novus ))
	    {
	    
		if( !($i % 4) ){
		    if( $location != 'welcome_novus' && $location != 'welcome_novus_recentbits' )
		    echo '<div  class="oneshelf shelf">';   	
		}
		}
		$i++;
	?>
    
	    <div id="" class="novus <?php if ($novus['end']=='Y') echo _('closed'); else echo _('open'); ?> <?php if ($novus[ 'num_of_bits' ]==0) echo _('virgin'); ?>" appr="<?= $novus[ 'appreciations' ]; ?>" comm="<? // echo $novus[ 'num_of_comments' ]; ?>" bits="<?= $novus[ 'num_of_bits' ]; ?>" >
			
			
		<!-- 
		START of DESCRIPTION div
		appears ONLY when changing the view from grid to list ! 
		-->
			
		<div class="desc" style="width:400px; height:200px; float:right; overflow:hidden;">
		    
		    <h3><?= $novus['title'];?></h3>
		    <?= $novus[ 'description' ]; ?><br /><br />
	     
		    <span style="font-size:10px;">
			Appreciations <?= $novus[ 'appreciations' ]; ?> 
			<!-- Comments <? // echo $novus[ 'num_of_comments' ]; ?> &#183;	-->
			Bits <?= $novus[ 'num_of_bits' ]; ?>
		    </span>
	    
		</div> 
		
		<!-- end of DESCRIPTION div -->
		
			   <div id="novus_cover" style="width:159px; float:left ">
			    
			    <div class="novus_image">
				
				<div class="novus_gradient" style="width:22px;height:190px;">   </div>
				  <div class="novus_cover_title">
				    <?php echo $novus['title'];?>
			       </div>
				    
		<!-- 
		START of NOVUS_DETAILS div
		appears on hover !
		-->
		
				    <a id="novus_details_<?=$novus['id'];?>" class="novus_details" href="<?=$novus['id'];?>">
					
					
					     
			<span style="font-size:9px; text-align:center; margin-top:0px">
			<strong style="overflow:hidden"><?= $novus['title'];?></strong>
		    <div style="text-align:left;"><?= substr($novus[ 'description' ],0,100); ?></div>
		    <br>
		    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 	 width="12px" height="12px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve"> <g id="Your_Icon"> 	<path d="M13.32,4.991l0.824-1.166c0.284-0.406,0.163-0.98-0.276-1.285L10.49,0.185C10.052-0.12,9.466-0.039,9.18,0.366L8.357,1.531 		L13.32,4.991z"/> 	<path d="M7.598,2.553l-5.406,7.73c-0.229,1.5,3.509,4.12,4.963,3.46l5.406-7.731L7.598,2.553z"/> 	<path d="M2.367,10.589C2.08,11.273,1.77,14.582,1.87,15.497c0.02,0.185,0.053,0.282,0.112,0.32c0.337,0.226,4.195-1.65,4.785-2.151 		C5.426,14.101,2.353,11.937,2.367,10.589z"/> </g> </svg>
		    <?= $novus[ 'num_of_bits' ]; ?> &#183;
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 13.999 12" enable-background="new 0 0 13.999 12" xml:space="preserve"> <path d="M11.941,0.33c-1.783-0.825-4.115-0.049-4.94,1.73c-0.825-1.779-3.157-2.556-4.94-1.73C0.162,1.211-0.746,3.461,0.754,6.115  c1.065,1.889,2.953,3.312,6.247,5.863c3.294-2.551,5.182-3.975,6.247-5.863C14.748,3.461,13.84,1.211,11.941,0.33z"></path> </svg>
			<?= $novus[ 'appreciations' ]; ?>
			<!-- <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 	 width="12px" height="12px" viewBox="42 42 16 16" enable-background="new 42 42 16 16" xml:space="preserve"> <g id="Layer_4"> 	<polygon points="42,42 42,54.037 44.444,54.037 44.444,58 50.186,54.037 57.999,54.037 57.999,42 	"/> </g> </svg>
			<? //echo $novus[ 'num_of_comments' ]; ?> -->
			<br>
					    
			<span class="novus_cat" style="text-align:center">
			<strong>Category: </strong><?=$novus['category_title']?><br>
			<Strong> Type: </strong><?=$novus['type_title']?><br>
						
			</span>
			<br>
			   
					    <?php
						if( $location == 'appreciations' && logged() && isset($owner) ){
						if( ( $owner == 'power_user') || $owner == $author_username  ){
								$bits_unread = $novus['num_of_bits'] - $novus['last_bit_count'];
							}
						  }
					    ?>
					  	    <?php if ($novus['end']=='Y') { ?>
						    </br><strong><?php echo _("Closed"); ?></strong>
						    <?php } ?>
					</span>
						    
					
					
			</a>
			    
			<!-- 
			end of NOVUS_DETAILS div !!!  
			-->     
			       
			<?php 
			if( ( $location == 'novus' || $location == 'author_contents_page' || $location == 'undefined')  && logged() && isset($owner) ){			      
			if( ( $owner == 'power_user') || $owner == $author_username  ) {
			$bits_unread = $novus['num_of_bits'] - $novus['last_bit_count'];
			if( $bits_unread > 0 ) { 
			?>		  
						<div class="unread_marker marker_green">
						<?=$bits_unread;?><br><br>
						<div onclick="$(this).parent('div').slideUp(330);" class="hideme" title="<?php echo _("Some unread bits.<br>Click to hide this marker or you can simply view the novus and we'll remove it for you."); ?>" novus_id="<?=$novus['id'];?>">
						</div>			      
						</div>
			<?php }}} ?>
					  
					  
			<?php
			if( $location == 'appreciations' && logged() && isset($owner) ) {		      
			if( ( $owner == 'power_user') || $owner == $author_username  ) {
			$bits_unread = $novus['num_of_bits'] - $novus['last_bit_count'];
			if( $bits_unread > 0 ) {
			?>				  
					<div class="unread_marker">
					<?=$bits_unread;?><br>
					<div onclick="$(this).parent('div').slideUp(330);" class="hideme" title="<?php echo _("Some unread bits."); ?><br><?php echo _("Click to hide this marker or you can simply view the novus and we'll remove it for you."); ?>" novus_id="<?=$novus['id'];?>"></div>
					</div>
								  
			<?php }}} ?>
					 
			<?php
			$image_properties = array(
				    'class' 	=> 'cover_image',
					'src' 		=> 'uploads/novus/'.$novus['cover_image'],
					'alt' 		=> $novus['title'],
					'border' 	=> '0',
					'title' 	=> $novus['title']	
			);
			echo anchor( $novus['id'] ,img($image_properties),'title="' . _("View Novus") . '"');  
			?>
			    
				    
			</div> <!-- END of novus_image -->
    
	    </div> <!-- END of novus_cover -->
	    
		<div class='novus_title'><?php echo anchor($novus['author'], "by <strong>".$novus['author']."</strong>",'title="View Author page"');?></div> <!-- ο titlos pou fenetai pano sto rafi -->
		

	    </div> <!-- end of NOVUS div -->
	    
        <?php
	   
		 if( !($i % 4) ){
		     if( $location != 'welcome_novus'  && $location != 'welcome_novus_recentbits')
		    echo '</div>';   	
		 }
	    
	} // if key exists.
	
	endforeach;
	
	?>
	

	
	</div><!-- end of container ss-->
<?php  if( $location != 'welcome_novus'  && $location != 'welcome_novus_recentbits') { ?>


<? if( $pageno != $novuses['how_many_pages'] ) {?>
<input type="button" class="button button-gray" id="older" value="&larr; Previous">
<?} ?>

<? if( $pageno != "1" ) {?>
<input type="button" class="button button-gray" id="newer" value="  Next &rarr;">
<? } ?>
<? 
//echo "how_many_pages:".$novuses['how_many_pages'];
//echo  "how_many_records:".$novuses['how_many_records']; ?>
<script>
function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}
//alert("<?=base_url();?>"+"<?=$this->uri->uri_string();?>?page=" + <?=$pageno+1;?>);
   
    $('#older').click( function() {
	$('#contents').fadeOut(50, function(){});
	$.post( "<?=base_url();?>"+"<?=$this->uri->uri_string();?>?page=" + <?=$pageno+1;?>, function (htmlcode){$('#contents').fadeIn(100).html(htmlcode);});
    });
    $('#newer').click( function() {
	$('#contents').fadeOut(50, function(){});
	$.post( "<?=base_url();?>"+"<?=$this->uri->uri_string();?>?page=" + <?=$pageno-1;?>, function (htmlcode){$('#contents').fadeIn(100).html(htmlcode);});
    });

</script>

	  <?php } ?>
  <script type="text/javascript" src="<?=base_url();?>novusbit/js/novuses_view.js"></script>
<script>
try{
var us = $.address.path().substr(1);

		var loc = us.split("/")[0];
		var loc_args = us.split("/")[1];
		if( loc == "types" ) loc = "type"; else loc = "category";
     $("#current_type").html( "<strong><?=$novuses['how_many_records']; ?></strong>" + "in "+ capitaliseFirstLetter( loc_args.replace("+", " ") )  + " "  );
} catch( err ){}
</script>
<?php endif; ?>
  