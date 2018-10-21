

    <?php
    //if ( !logged() )
	 //   {
    ?>
    <!--
	<div id="signup_wrap">

	    <div class="novus_title" style="font-size:24px; height:34px"><?php echo _("Join now!"); ?></div>
	    <?php echo _("All of us have a great story to tell. Sometimes it's just a blurry idea, a seed, or you've nailed the perfect plot but without much of an ending. <br>Novusbit is the place to see your stories flurish.") ?>;
	    <input type="button" value="<?php echo _("I want to be great author"); ?>" id="sign_up" class="button" style="height:30px;width:200px;margin-top:10px"/>
	    
	    <div id="signup_form" style="width:200px; margin-bottom:14px;margin-top:24px">
	    ....
	    </div>
		    </div>
	    <script>
	    $('#signup_form').hide();
	    $('#sign_up').click( function() {$('#sign_up').hide();$('#signup_form').show('fast');} );
	    </script>
	    -->
    <?php
   // }
    ?>
<div id="ff" style="font-size: 16px;border-bottom: 1px solid #bbb; margin-bottom:20px; line-height:37px;">Categories</div>
     

	<div id="categories">
	    
		
		<!-- <div style="height:1px; border-top: 1px #888 dotted; margin-bottom:10px;margin-top:5px"></div> -->
		
		<ul id="categories-list">

		    <?php
		    
		    if( $current != 'undefined' )    
		        echo '<li>'.anchor('categories/All' , 'All' ,array('class' => ' button-gray')).'</li>';
		    else
		        echo '<li>'.anchor('categories/All' , 'All' ,array('class' => ' selected button-gray')).'</li>';
			
						
			    foreach ( $categories as $category ){
				
				echo nl().'<li>';
				
				    if( $category['how_many']!=0){
					if( $current != $category['title'] )
					    echo anchor('categories/'.urlencode($category['title'] ), $category['title']."<span>".$category['how_many']."</span> ",array('class' => ' button-gray'));
					else
					    echo anchor('categories/'.urlencode($category['title'] ), $category['title']."<span>".$category['how_many']."</span> " ,array('class' => ' selected button-gray') );
				    }
				    else
					echo anchor('new/'.urlencode($category['title']) ,$category['title']."<span>".$category['how_many']."</span> ",array('class' => 'empty button-gray')); 
					
				  
				
				echo '</li>';
			    }
			    
			    
		    ?>
		    
		</ul>	    
	</div>
<!-- <script type="text/javascript" src="<? // echo base_url();?>novusbit/js/types_and_categories.js"></script>	-->
