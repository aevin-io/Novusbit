<script>
 //$(".bts").addClass('selected');
 </script>
    <div class="all_bits_wrapper__off">
        
      <?php if(empty($bits)): ?>
         <strong>You haven't post a bit yet.</strong><br>Bits is the fun part of novus..bit! Select a novus, any novus really.<br>Read it and then expand it by typing in your own bit!
      <?php endif; ?>
     
      <?php
            $all_likes = 0;
            
            foreach( $bits as $index => $bit )
            {
              if( array_key_exists( 'novus_title', $bit ) ) {
        ?>
                   
     

                    <div class='bit_wrapper_off'>
                        
                      <div id="bit_<?=$index;?>" class="bit" style="color: #666; margin-bottom: 15px; margin-left:10px; background: url('<?=base_url();?>images/bitpaper.png') no-repeat bottom right; width:590px; padding:10px 5px 50px; font-size:90%;  float: left;">
                        <div style="width:470px; padding-left:60px"><?=$bit['body'];?> </div>
                        
                      </div>
                    
                         
    
    
    
    
                    <div id="bit_details_<?=$index;?>" class="bit_detais" > 
                        
                                    

    
    
    
    
    <div id="novus" class="novus" style="height:150px; width: 130px; float: left; padding:0;">
			
		
		
			   <div id="novus_cover" style="width:59px; height:100px; margin:0 auto;">
			    <div class="novus_image" style="width:59px; height:100px; ">
				<div class="novus_gradient" style="width:22px;height:100px;"></div> 
					<? $image_properties = array('src' => 'uploads/novus/'.$bit['novus_image'],'width' => 89, 'height' => 100,'border' => '0'  );
						echo anchor( $bit['parent_novus_id'] ,img($image_properties),'title="View Novus"'); ?>
			    </div>
			    </div>
		
		<div class='novus_title' style="width: 130px; overflow:visible;"><?=$bit['novus_title']; ?></div>
		         
</div>
    
    
                       
                        <?
                        
                     
                          
                           if( ( isset($owner) && $owner == 'power_user') ){
                                echo anchor('novus_controller/remove_bit/'.$bit['parent_novus_id'].'/'.$bit['id'],'Remove bit','title="Remove bit"');
                           }
                                  
       ?>
                      </div>
    
                    </div>
      <?php
            
            $all_likes += $bit['likes']; // Value will be used later in jQuery script.
            } // if key exists
            } // End of foreach $bits
            
            echo br(3);

            ?>
    </div>
     <script>
 $(document).ready(function () {$('#loading').hide();});
 </script>
</div> <!-- end of #contents -->