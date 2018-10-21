<script>
 //$(".wtch").addClass('selected');
 </script>  
    <?php if(empty($friends)): ?>
    <strong>Seems like you dont follow anyone.</strong><br>You may do so by clicking on the <strong>+Watch</strong> link next to any author's username.
    <?php endif; ?>
    
   <?php foreach( $friends as $friend ): ?>
                   
                   <div id="author_wrapper" style="padding-bottom:20px; clear: both;	">
                    
                    <div id="follower" style="width: 80px; float:left; text-align:center; padding:20px;">
                      <a href="<?php echo (base_url());?><?=$friend['username'];?>" title="View Author page"> 
                    <div id="author_image">
       <?php if(!isset($friend['fb_user'])): ?>
		<?php if(isset($friend['picture'])): ?>
			<img src="<?php echo (base_url().'uploads/authors/'.$friend['picture']);?>" width="70" height="70" align="absbottom" />
		<?php else: ?>
			<img src="<?php echo (base_url().'images/logo.jpg');?>" width="70" height="70" align="absbottom" />
		<?php endif; ?>

		<?php else: ?>
			<img src="https://graph.facebook.com/<?php echo $friend['fb_uid']; ?>/picture?type=large" width="70" height="70">
		<?php endif; ?>
                         </div>  
                       <br> <strong><?=$friend['username'];?></strong>
                       </a> 
                        <?
                                if( ( isset($owner) && $owner == 'power_user') || (isset($owner) && $owner == $this->uri->segment( 3 )))
                             { 
                        ?>    
                         <button id="follow_author" class="follow_btns button button-gray unwatch_author" inject="no" author="<?=$friend['id'];?>">
					<svg xmlns="http://www.w3.org/2000/svg" fill="#fff" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="23px" height="23px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M39.363,79L16,55.49l11.347-11.419L39.694,56.49L72.983,23L84,34.085L39.363,79z"></path>
					</svg>
					<span>unfollow</span>
				</button>
                        <?
                             } 
                        ?>
                    </div>
                   
                    	
                   
                   
<?php
if( isset( $friend['novuses'] ) ){
?>
<div class="notices_wrapper">
<?
foreach( $friend['novuses'] as $fr_novus ){
?>
<div id="novus_notice" >
<?php
if( ( isset($owner) && $owner == 'power_user') || (isset($owner) && $owner == $this->uri->segment( 3 ))){ ?>               
<div id="novus_cover" style="width:59px; height:100px; margin:0 auto;">
<div class="novus_image" style="width:59px; height:100px; ">
<div class="novus_gradient" style="width:22px;height:100px;"></div> 
<?
$image_properties = array( 'src' => base_url().'uploads/novus/'.$fr_novus['cover_image'], 'width' => 89,'height' => 100,'border' => '0');
echo anchor( $fr_novus['novus_id'],img($image_properties),'title="View Novus"');  
?>	    
</div>
</div> <!-- END of novus_cover -->

<div class='novus_title' style="width: 130px; overflow:visible;">
<?=$fr_novus['novus_title']; ?>
<br>
<?
$data = array(	'type'	=> 'button',
				'class' => 'hide_notice button button-gray',
				'value' => 'Hide',
				'novus' => $fr_novus['novus_id']);
echo form_input($data);?>
</div> <!-- END of novus_title -->
<? } ?>
</div> <!-- END of novus_notice -->
                           
<?php
} // End of for_each friend['novuses']
}  
?>
</div> <!-- END of notices_wrapper -->
</div> <!-- END of author_wrapper -->

<?php  endforeach;     // for each FRIEND (not for each novus!) ?>
    
</div> <!-- end of #contents -->
    
<script type="text/javascript" src="<?=base_url();?>novusbit/js/friends.js"></script>