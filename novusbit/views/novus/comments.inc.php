
    
    <div class="comments novus_comments">
	
	<?php foreach( $comments as $com): ?>
	
		    <div id="comment_<?=$com['id'];?>" class="comment">
			
		       <?=$com['body'];?><br><br>
		       
		       <?=$com['dateposted'];?>
		       
		       <? echo anchor($com['author']['username'], $com['author']['username'],'title="View Author page"');?>
		    
		    </div>
	
	<?php endforeach; ?>
    
    </div>
        <?php if( logged() ):
    
				
    
    
    ?>
    
	    <div class="comment_form novus_comments">
		
		<?php
			
			echo form_open('novus_controller/store_comment/'. $novus['id']  );
			$data = array(
              'name'        => 'comment',
              'id'          => 'comment',
              'placeholder'       => 'Any thoughts?',
              'maxlength'   => '100',
              'size'        => '10',
	      'rows'	    => '2',
              'style'       => 'width:50%',
            );
			echo form_label('Any thoughts?', 'comment');
			echo br();
			echo form_textarea($data);
			echo br();
		    $attr = array('type'=>'submit', 'class' => 'button button-gray', 'value' => 'Post your comment');
			echo form_submit( $attr );
			echo form_hidden('nid', $novus['id'] );
			echo form_close();
		?>
	    </div>
    
    <?php endif; ?>
    
    
    <script>
	$('.novus_comments').hide();
	
	$('.show_comments').click(
				function(){
					$(this).hide();
					$('.comments').slideDown(150);
					$('.comment_form').show('blind');
				});
    </script>
    	    
    <!-- <div style="clear: both"></div> -->
    