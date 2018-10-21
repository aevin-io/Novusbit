 <div class="middle_content" style="width: 610px; float:right;">
 
 
	 <div class="novus_expand_title"><?=$novus['title']; ?></div>
	 
	 <div class="all_bits_wrapper" id="all_bits_wrapper">
	

<div class='bit_wrapper'>
 <div class="bit_details" >
This is the first bit of this novus and acts like an intro to the rest of the story.
 </div>
	<div class="bit novus_description"><?=$novus['description'];?></div>
		
</div>
		<?php foreach( $bits as $index => $bit ): ?>
	
	
				
					
		 <div class='bit_wrapper'>
			  <div id="bit_<?=$index;?>" class="bit <?
					if($bit['likes']=="")$bit['likes']=0;
					if($bit['spamflags']=="")$bit['spamflags']=0;
					$rating = $bit['likes'] - $bit['spamflags'];
					if ( $rating <= -2 ) {
					echo "spam"; } ?>">
				   
				   <?=$bit['body'];?>		 
				
			  </div>
		 
		 <div id="bit_details_<?=$index;?>" class="bit_details" >
		 
							   
					 
				   <div class="bit_author">			
				<strong><?  if ( isset( $bit['author']['username'] ) &&  $owner == $bit['author']['username'] )
					echo "Written by ".anchor($bit['author']['username'], "<strong>you</strong>",'title="View Author page"');
					else if  ( isset( $bit['author']['username'] ))
					echo "Written by ".anchor($bit['author']['username'], "<strong>".$bit['author']['username']."</strong>",'title="View Author page"');
					else
					echo '<svg fill="#f1d200" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
<path d="M98.692,80.351L58.485,8.793c-1.73-3.077-4.984-4.981-8.515-4.981c-3.527,0-6.783,1.904-8.512,4.981L1.252,80.351	c-1.698,3.024-1.669,6.721,0.085,9.717c1.751,2.992,4.958,4.831,8.428,4.831h80.413c3.468,0,6.674-1.839,8.426-4.831  c0.893-1.525,1.337-3.228,1.337-4.933C99.941,83.484,99.524,81.837,98.692,80.351z M44.045,59.222V34.75v-1.363  c0.085-4.008,2.388-6.652,5.97-6.652c3.58,0,5.968,2.729,5.968,6.652v1.363v24.472v1.281c-0.085,4.092-2.388,6.649-5.968,6.649  c-3.582,0-5.97-2.643-5.97-6.649V59.222z M50.01,84.744c-3.775,0-6.844-3.068-6.844-6.845s3.068-6.765,6.844-6.765  c3.776,0,6.764,2.988,6.764,6.765S53.786,84.744,50.01,84.744z"></path>
</svg> Posted by removed member.';
					 ?></strong>
				<? //if( logged() ) {
				   // echo anchor('author_controller/add_to_watch/'.$bit['author']['id'], '+watch','title="View Author page"');
				//}?>
				
						 <?php
		
		 if( logged() )
		{
			 
		
 $myfriend = false;
 foreach( $friends as $friend ){
 if(!isset($bit['author']['id'])){
	
 }
	else if( $friend['id'] == $bit['author']['id']){
		$myfriend = true;
	}
	

 }


							if(!$myfriend){
							if( ( isset($owner) && $owner == 'power_user') || (isset($owner) && $owner != $this->uri->segment( 3 )))
							 {
				 if(!isset($bit['author']['username'])){
	
 }
				else if($owner != $bit['author']['username']){
				?>
				
<div id="follow-button" >
	

					<button id="follow_author" class="follow_author button button-gray" inject="no" auth_id="<?=$bit['author']['id'];?>" style="padding:4px 18px 4px 16px;">
					<!--
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M39.363,79L16,55.49l11.347-11.419L39.694,56.49L72.983,23L84,34.085L39.363,79z"></path>
					</svg>
					-->
					<span>+ Follow</span>
				</button>
					
</div>
<? } }

}else{?>
	 <button id="unwatch_author" class="unwatch_author button" inject="no" author="<?=$friend['id'];?>">
					<svg xmlns="http://www.w3.org/2000/svg" fill="#fff" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M39.363,79L16,55.49l11.347-11.419L39.694,56.49L72.983,23L84,34.085L39.363,79z"></path>
					</svg>
					<span>Following</span>
				</button>
				 
							  
						
	<? } 
		
		}
		 ?>
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
				   </div>
				   <br>
		
				
				<?php 			
			
			if( logged() )
			{
				 if( $owner != $bit['author']['username']  )
							 {
				 ?>
					<button id="" class="like button button-gray" inject="no" novus="<?=$novus['id'];?>" bit="<?=$bit['id'];?>" value="Like">
					<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="-9.475 -7.462 95.333 100" enable-background="new -9.475 -7.462 95.333 100" xml:space="preserve">
<path d="M79.126,73.432c8.933,27.89-51.466,12.787-56.245,8.321v7.088c0,2.002-1.692,3.697-3.54,3.697H-5.929
	c-1.848,0-3.546-1.695-3.546-3.697V29.518c0-1.85,1.692-3.545,3.546-3.545h25.271c1.847,0,3.54,1.695,3.54,3.545v4.004
	C34.9,25.663,41.067,5.942,41.222,5.171c1.847-8.012,6.471-12.633,13.097-12.633c6.931,0,15.1,6.778,15.1,21.109
	c0,3.542-1.388,9.09-3.545,13.25h2.157c9.093,0,19.413,4.317,16.022,17.415c3.546,6.009,1.233,12.632-1.537,15.099
	C85.287,64.955,82.975,70.657,79.126,73.432z M68.954,57.25c8.783,0,9.094-9.242,1.079-9.552c-1.698-0.155-1.698-1.847,0-1.847
	c8.008,0,6.626-10.171-2.002-10.171h-9.094c-3.235,0-4.778-2.002-4.778-4.004c0-3.701,6.471-11.712,6.471-17.876
	c0-7.856-3.85-12.48-6.316-12.48c-2.615,0-4.004,2.157-4.313,4.776c-1.848,12.329-15.41,32.821-27.119,37.907v27.89
	c16.488,8.167,30.973,8.783,37.904,9.091c10.481,0.307,15.719-8.012,4.934-10.324c-2.312-0.31-2.157-2.312-0.465-2.312
	c10.94,0,11.709-8.167,3.7-9.09C66.952,58.948,66.952,57.25,68.954,57.25z"></path>
</svg>
					<span></span>
				</button>
				
					<button id="" class="flag_spam button button-gray" inject="no" novus="<?=$novus['id'];?>" bit="<?=$bit['id'];?>" value="Like">
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
<path d="M98.692,80.351L58.485,8.793c-1.73-3.077-4.984-4.981-8.515-4.981c-3.527,0-6.783,1.904-8.512,4.981L1.252,80.351	c-1.698,3.024-1.669,6.721,0.085,9.717c1.751,2.992,4.958,4.831,8.428,4.831h80.413c3.468,0,6.674-1.839,8.426-4.831  c0.893-1.525,1.337-3.228,1.337-4.933C99.941,83.484,99.524,81.837,98.692,80.351z M44.045,59.222V34.75v-1.363  c0.085-4.008,2.388-6.652,5.97-6.652c3.58,0,5.968,2.729,5.968,6.652v1.363v24.472v1.281c-0.085,4.092-2.388,6.649-5.968,6.649  c-3.582,0-5.97-2.643-5.97-6.649V59.222z M50.01,84.744c-3.775,0-6.844-3.068-6.844-6.845s3.068-6.765,6.844-6.765  c3.776,0,6.764,2.988,6.764,6.765S53.786,84.744,50.01,84.744z"></path>
</svg>
					<span></span>
				</button>
				  <?
				  
				  }	
							 
				 if(!isset($bit['author']['username'])){ }
				else if( ( $owner == 'power_user') || $owner == $bit['author']['username'] && $index+1 == sizeof($bits) )
				   {
				
				$data = array(
						'type'	=> 'button',
						'class' => 'remove_bit button button-gray',
						'value' => 'remove bit',
						'novus' => $novus['id'],
						'bit'	  => $bit['id']
						   );
				 
				  echo form_input($data);
				  

				//echo anchor('bit_controller/remove_bit/'.$novus['id'].'/'.$bit['id'],'Remove bit','id="remove_bit"');
				   }		
			}	
			
			?>
			
					
					
			
			
		</div> <!-- End of bit_details_ -->
			 
				
		 </div> <!-- End of bit_wrapper -->
		
		<?php endforeach; // end foreach $bits ?>


</div>