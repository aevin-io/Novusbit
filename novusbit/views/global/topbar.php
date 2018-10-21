
<div id="top-bar">
    <div id="top-bar-wrap">
	   <div id="logo">		
		<a href="<?=base_url();?>" inject="no"><div id="logo_text_top" class="logo_text">Novus<font color="#2e648a">bit</font></div></a>
	   </div>
<!-- ============ TYPES ============ --> 
<style type="text/css">		  
</style>

<div id="types_navigation_wrap">
	
     <div id="types_menu_trigger" class="button-gray"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" fill="#184463">
<g id="Captions">
</g>
<g id="Your_Icon">
	<path fill="#184463" id="velaki" d="M93.144,24.877C90.647,22.375,87.324,21,83.793,21c-3.528,0-6.845,1.37-9.342,3.866L50.089,49.231   L25.724,24.866C23.229,22.375,19.91,21,16.384,21s-6.845,1.375-9.337,3.866c-5.153,5.149-5.153,13.534,0,18.687l33.542,33.536   c2.486,2.503,5.807,3.878,9.349,3.878h0.301c3.529,0,6.842-1.369,9.329-3.86l33.556-33.55C95.623,41.061,97,37.74,97,34.208   C97,30.675,95.623,27.356,93.144,24.877z"></path>
</g>
</svg> Browse by Type      
     
             <div id="types_navigation_menu">
           <div id="type_description">  
             <div id="0" class="description"></div>
               <?php
               $counter=1;
               foreach ( $types as $type ){
                   $counter++;
                   echo nl().'<div id="'.$counter.'" class="description">';
                   echo $type['description'];
                   echo '</div>';
               }
               ?>
           </div>
           <ul class="level2">
            <?php
                if( $current_type != 'all' )
                    echo '<li id="0">'.anchor('types/All' , 'All' ,array('id' => 'all')).'</li>';
                else
                    echo '<li id="0">'.anchor('types/All' , 'All' ,array('id' => 'all')).'</li>';

                $counter=1;
                foreach ( $types as $type ){
                    $counter++;
                    echo nl().'<li id="'.$counter.'">';
                    if( $type['how_many']!=0){
                        if( $current_type != $type['title'] )
                            echo anchor('types/'.urlencode($type['title'] ), $type['title']."<span>".$type['how_many']."</span>",'title="View this category"');
                        else
                            echo anchor('types/'.urlencode($type['title'] ), $type['title'],array('class' => 'selected', 'style' => 'background:#99a637; color:white; font-weight:bold;') );
                    }
                    else
                        echo anchor('new/'.urlencode($type['title']) ,$type['title'],'title="Start a novus"');

                    echo '</li>';
                }
            ?>

           </ul>

       </div>
    </div>  
</div> 
<script>
function hideAllbutThis( whichone ){
    $( whichone ).siblings().hide();
    $( whichone ).fadeIn("fast");
}

hideAllbutThis( "#0" );

$('#types_navigation_menu a').click( function(){$('#types_navigation_menu').hide();} );
$('#types_navigation_wrap').hover(function(){
    $('#types_navigation_menu').fadeIn(220);
},function(){
    $('#types_navigation_menu').fadeOut(140);
});

$('#types_navigation_wrap .level2 li').hover(function(){
    //alert($(this).attr('id'));
     hideAllbutThis( "#"+$(this).attr('id') );
},
function(){
     //$('#types_navigation_menu').hide();
});
</script>
<div id="loading" style="display:inline-block;">
     <img src="<?=base_url();?>/images/ajaxloader.gif">
</div>

<!-- ============ End of TYPES ============ -->
<?php
    if(logged()){
?>
    <div id="nav"  style="float:right; line-height:0px;">
    <?php
     $logged_author = $this->author_model->get_author_by_username( $this->session->userdata( 'username' ) );
   // echo("lala: ".$this->session->userdata( 'username' ));
     $logged_author = $logged_author->export();
    ?>
	    
    <ul id="navigation" >        
        <li class="level1">
            <div id="loggeduser">

                <A href="<?=$this->session->userdata( 'username' ).'/novus';?>" inject="no">
                 <span id="author_image" style="border-width:0px; margin-top:3px">
		<?php if(!isset($logged_author['fb_user'])): ?>
		<?php if(isset($logged_author['picture'])): ?>
			<img src="<?php echo (base_url().'uploads/authors/'.$logged_author['picture']);?>" width="34" height="34" align="absbottom" />
		<?php else: ?>
			<img src="<?php echo (base_url().'images/logo.jpg');?>" width="34" height="34" align="absbottom" />
		<?php endif; ?>

		<?php else: ?>
			<img src="https://graph.facebook.com/<?php echo $logged_author['fb_uid']; ?>/picture?type=large" width="34" height="34">
		<?php endif; ?>
	</span> <!-- author_image -->
                </A>
            <strong><?php echo $this->session->userdata( 'username' ); ?></strong>
            </div>                              
            <ul class="level2">
             
                <li class="seperate"><?=anchor( $this->session->userdata( 'username' ).'/novus','Your Novus');?></li>
                <li><?=anchor( $this->session->userdata( 'username' ).'/bits','Your Bits');?></li>
                <li><?=anchor( $this->session->userdata( 'username' ).'/likes','Your Likes');?></li>
                <li><?=anchor( $this->session->userdata( 'username' ).'/watching','Your Friends');?></li>
                <li class="seperate"><?=anchor( 'profile','Settings');?></li>
                <?php if(isset($logged_author['fb_user'])){ ?>
                <li><?=anchor( 'friendinvites','Invite Friends');?></li>
<?php }else{ ?>
 <li><a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fnovusbit.com" target="_blank" inject="no">
  Share on Facebook
</a></li>
   <?php } ?>
                <li><?=anchor( 'signout', 'Sign out', array( 'inject' => 'no' ) );?></li>
             
            </ul>
        </li>                              
        <li class="level1" id="notdrp">
        Notices
        </li>
	
        <li class="level1">About
          <ul class="level2">
                 
                  <li><a href="/about/novus">What's a Novus?</a></li> 
                  <li><a href="/about/types">Novus Types</a></li>
                  <li><a href="/about/bits">Guidelines</a></li>
                  <li class="seperate"><a href="https://www.facebook.com/novusbit" target="_blank" inject="no">Facebook</a></li>
                   <li><a href="/about/help">Help</a></li>
                  </ul>
        </li>	      
    </ul>
    <a href="new" id="newnovus-button" class="button">New Novus</a>

    <script>
    <?php
    if(logged()){
?>
$.ajax(
	{
		url: base_url + 'home_controller/notices_drop/',
		type: 'GET',
		success: function (htmlcode)
		{
			$('#notdrp').html(htmlcode);

		},
		complete: function (jqXHR, textStatus)
		{
			return true;
		}
	});
    
    <? } ?>  
      
      $('#navigation a').click( function(){$(this).fadeOut(100, function(){$(this).show();$(this).parent().parent().hide();});} );

    </script>
    <?php }else{ ?>
   <!-- 
<div class="showlogin" style="float:right">

		<a href="/" inject="no">Login</a>
	</div>
	
	-->
<? } ?>
    </div> <! --- fggdfgfd -->

   </div>
   
</div>