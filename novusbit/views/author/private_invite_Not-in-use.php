    <h3>Visible by who?</h3>
    
        
    <?php if(empty($friends)): ?>
    <strong>Seems like you dont follow anyone.</strong><br>You may do so by clicking on the <strong>+Watch</strong> link next to any author's username.
    <?php endif; ?>
    
   <?php foreach( $friends as $friend ): ?>
                   
         <div class="author_wrapper" author="<?=$friend['username'];?>">
                    
                    <strong>
                      
                        <div id="author_image" style="border-width:1px ;">
                         <img src="<?php echo (base_url().'uploads/authors/'.$friend['picture']);?>" height="40" width="40" />
			  
                        </div>
			 <? echo anchor($friend['username'], $friend['username'],'title="View Author page"');?>
                    </strong>

                    
             
           </div>
	 

            
    <?php endforeach; ?>
    
    <style>
     .author_wrapper {
	width:60px;
	margin:6px;
	padding:10px;
	float:left;
	border: 1px solid #ddd;
     }
    
    .author_wrapper:hover {
	border: 1px solid #999;
    }
    
    .selected {
	border: 1px solid #888;
	background: #ededed;
    }
    
    </style>
    
<script type="text/javascript" >
$(document).ready(function(){
    
    $('.author_wrapper').click(
				    function(){ $
					$(this).toggleClass( 'selected' );
					getSelected();
				    }
				);
    function getSelected(){
	var visibility_list = [];
	$('.author_wrapper.selected').each( function (i){ visibility_list.push( $(this).attr('author') ); });
	$('input[name="visibility"]').val(visibility_list);
	return visibility_list;
    }
});
</script>

    
     
 