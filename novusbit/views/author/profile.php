<?php uriresolve();?>


<div id="author_profile">
	<div id="author_image">
		<?php if(!isset($author['fb_user'])): ?>
		<?php if(isset($author['picture'])): ?>
			<img src="<?php echo (base_url().'uploads/authors/'.$author['picture']);?>" width="70" height="70" align="absbottom" />
		<?php else: ?>
			<img src="<?php echo (base_url().'images/logo.jpg');?>" width="70" height="70" align="absbottom" />
		<?php endif; ?>

		<?php else: ?>
			<img src="https://graph.facebook.com/<?php echo $author['fb_uid']; ?>/picture?type=large" width="70" height="70">
		<?php endif; ?>
	</div> <!-- author_image -->

	<div id="author_alias"><?=$author['username'];?></div>
	
	<?=$author['date_registered'];?>
						  <?php
 if(isset($friends)){
 $myfriend = false;
 foreach( $friends as $friend ){
	if( $friend['id'] == $author['id']){
		$myfriend = true;
	}


 }?>
<div id="follow-button" style="float:right">
<?php
if(!$myfriend){
	if( ( isset( $owner ) && $owner == 'power_user') || ( isset( $owner ) && $owner != $this->uri->segment( 3 ) ) )
	{ ?>


				<button id="follow_author" class="follow_btns button button-gray" inject="no" auth_id="<?=$author['id'];?>">
					<!--
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="23px" height="23px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M39.363,79L16,55.49l11.347-11.419L39.694,56.49L72.983,23L84,34.085L39.363,79z"></path>
					</svg>
					-->
					<span>+ Follow</span>
				</button>
<? } }else{?>

				<button id="unwatch_author" class="follow_btns button" inject="no" author="<?=$friend['id'];?>">
					<svg xmlns="http://www.w3.org/2000/svg" fill="#fff" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="23px" height="23px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M39.363,79L16,55.49l11.347-11.419L39.694,56.49L72.983,23L84,34.085L39.363,79z"></path>
					</svg>
					<span>Following</span>
				</button>

	<? } }?>
			
</div>	
		
		
		
	</div><!-- #header-->
	

		<div id="auth_container">
			
	<div class="sidebar" id="author_sidebar">
	
	
				<div id="total_appreciations">
				Total received appreciations:
				<?=$author['received_appreciations'];?>

			</div>

			<div id="total_likes">
				Total received bit likes:
			   <?=$author['received_likes'];?>
			</div>

		</div><!-- .sidebar#sideLeft -->
		


			 <div id="account_menu">
				 <?php
			
			$user = $this->uri->segment( 3 );

			echo anchor( $user.'/novus','<strong>'.$author['novus_count'].'</strong> Novus', array('class' => 'profile_links nvs') );
			echo anchor( $user.'/bits',	'<strong>'.$author['bits_count'].'</strong> Bits', array('class' => 'profile_links bts') );
			echo anchor( $user.'/likes','<strong>'.$author['appreciations_count'].'</strong> Likes', array('class' => 'profile_links lks') );
			
		


		?>
		<div style="float:right">
		<?
	
		$user = $this->uri->segment( 3 );
			echo anchor( $user.'/watching',		'<strong>'.$author['watching_who_count'].'</strong> Following', array('class' => 'profile_links wtch'));
			echo anchor( $user.'/watchedby',	'<strong>'.$author['watched_by_count'].'</strong> Followers',  array('class' => 'profile_links wtchby'));
			?>		
		</div>
		</div><!-- End of account_menu -->
		
		
				<div id="author_contents" >
							</div><!-- #content-->
		
		
	
		</div><!-- #container-->

	
	

</div>







	<script>


$(document).ready(function()
{

	  

// $('.profile_links').removeClass('selected');
	  
	   $('#loading').hide();
	   
	   $('.profile_links').click( function() {
	    $('.profile_links').removeClass('selected');
		   $(this).addClass('selected');
		  		   //alert('clicked');
	   });

	   $('#follow_author').click( function(){
			// $(this).val('Added!').css('background','#d8782a');

						  //$(this).val('Added!').animate({ backgroundColor:'#d8782a'}, 100);
			//$(this).parent().parent(".bit_wrapper").slideUp('blind');
			$.post('author_controller/add_to_watch/'+$(this).attr('auth_id'), function(s){
				 window.location.reload();
				  });

			  });
			  
// -----------------------------------
$('#unwatch_author').hover( function(){
$(this).find('span').html("Unfollow");
$(this).addClass('red_button');
},function(){$(this).find('span').html("Following");
$(this).removeClass('red_button');});
// -----------------------------------

		 $('#unwatch_author').click( function(){

			 $(this).fadeOut();
			//$(this).parent().parent(".bit_wrapper").slideUp('blind');
			$.post('author_controller/unwatch_author/'+$(this).attr('author'), function(s){
			 window.location.reload();
				 });

			  });
		});
	</script>


