<?php uriresolve(); ?>

<style>
#friendlist ul {
   -webkit-padding-start: 0px;
   padding-right:40px;
}
#friendlist li {
clear: both;
display: block;
margin: 0;
padding: 3px 0 4px;
list-style: none;
border-top: 1px solid 
#FCFBFB /*
rgba(255, 255, 255, 0.7)*/;
border-bottom: 1px solid 
#DFDEDF /*
rgba(34, 25, 25, 0.1)*/;
overflow: hidden;

}
.invitebtn {
    width:70px;
    float:right;
    margin-top:8px;
}
.friendname {
    display: block;
margin-top: 7px;
font-size: 14px;
line-height: 21px
width:200px;
float: left;
font-size:15px;
}
.frimage {
float: left;
width: 40px;
height: 40px;
margin-right: 12px;
background:url(<?=base_url();?>/images/ajaxloader.gif) no-repeat;
}
</style>

 <div id="current_type" style=""><strong>Novusbit</strong> is fun with friends!</div> 
 <strong>Take a moment to invite a few friends on novusbit.</strong> <br>All invites are written by you and sent as a personal message by you!
  <br><br>	
<div id="" style="clear:both">  
<label for="search">Search for a friend</label><br>
    <input type="text" id="search" name="searchword" value="" placeholder="Your friend's name"/>
    <input type="button" class="refresh_friends button button-gray"  value="Refresh the list" />
</div>
<br>
  <div id="friendlist" style="float:left;">
   
    <ul class="search-list" >
         <? foreach($friends as $friend) : ?>
         <? if( $friend[ 'invited' ] == 'N' ) { ?>
         <li>
           <img class="frimage" src="https://graph.facebook.com/<?= $friend['id'] ?>/picture?type=square"></td>
                   <div class="friendname"><?= $friend['name'] ?></div>
                    <input type="button" class="invitebtn button button-gray" fid="<?= $friend['id'] ?>" value="Invite" />
                
         </li>
         <? } ?>
         <? endforeach; ?>
    </ul>
</div>
 <div id="friendlist" style="float:left;">
    <h2>Already Invited</h2>
    <ul class="search-list" >
         <? foreach($friends as $friend) : ?>
          <? if( $friend[ 'invited' ] == 'Y' ) { ?>
         <li>
           <img class="frimage" src="https://graph.facebook.com/<?= $friend['id'] ?>/picture?type=square"></td>
                   <div class="friendname"><?= $friend['name'] ?></div>
                    <input type="button" class="invitebtn button button-gray" fid="<?= $friend['id'] ?>" value="Reinvite" />
                
         </li>
         <? } ?>
         <? endforeach; ?>
    </ul>

<script type="text/javascript">

  window.fbAsyncInit = function() {

    FB.init({
      appId      : '135925676477012', // App ID
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });
    jQuery(document).trigger('FBSDKLoaded'); //This is the most important line to solving the issue
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1&appId=135925676477012 	";
     ref.parentNode.insertBefore(js, ref);
   }(document));

(function($) {
    $(document).bind('FBSDKLoaded', function() {
        //alert("all system's ready");
    });

})(jQuery);


</script>

<script>





	
$(document).ready(function(){


    
    
    $('#loading').hide();
$('#search').bind("change keyup", function() {
    searchWord = $(this).val();
    if (searchWord.length >= 3) {
 
       
            $('ul.search-list li').each(function(i, data) {
            text = $(this).text();
            if (text.match(RegExp(searchWord, 'i'))) {
               // $(this).css('background-color', 'yellow');
                
                
                $( this ).siblings().hide();
		
		$( this ).fadeIn("300");
                
                
            }
        });
    }
    else
    {
        $('ul.search-list li').show();
    }
});
     
    $('input.invitebtn').on('click', function(){
        var fid = $(this).attr('fid');
        invite_fb_friend(fid);
    });
    
    $('input.refresh_friends').on('click', function(){
      // window.location = 'friendinvites/refresh_fb_friendlist';
       $.post( 'friendinvites/refresh_fb_friendlist', function(htmlcode){$('#contents').html(htmlcode);} );
    });
    
    function invite_fb_friend(fid) {
         FB.ui({
            method: 'send',
            name: 'Novusbit',
            link: '<?=base_url();?>',
            redirect_uri: '<?=base_url();?>',
            to: fid,
            display: 'popup',
            show_error : 'true',
            picture: '<?=base_url();?>/images/logo.jpg',
            name: 'Novusbit',
            description: 'Twist your story!	'
          },function(response){
          
           if(response != null){
                $.post( 'friendinvites/store_invite/'+fid, function(htmlcode){$('#contents').html(htmlcode);} );
           }else{
               // alert('user clicked cancel');
           }
          });
         
    }
});
</script>
