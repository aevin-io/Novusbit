<script>
 //$(".wtchby").addClass('selected');
 </script>  
    <?php if(empty($friends)): ?>
    <strong>Seems like you dont follow anyone.</strong><br>You may do so by clicking on the <strong>+Watch</strong> link next to any author's username.
    <?php endif; ?>
    
   <?php foreach( $friends as $friend ): ?>
                   
                
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
                    </div>
                    
                    
                    
                   
   <?php
              
                    
            
           
        endforeach;       
    ?>
    <script>
 $(document).ready(function () {$('#loading').hide();});
 </script>
    </div> <!-- end of #contents -->