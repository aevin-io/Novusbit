<? 
//$bits_unread = $novus['num_of_bits'] - $novus['last_bit_count'];
//echo "UNREAD BITS ".$bits_unread;
?>
<?php
    if(logged()){
?>
    <script>
    
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
    </script>
<? } ?>    

<!-- =============================== End of the heading part =============================== -->
<div class="novus_sidebar">

<? $param = array( 'name'=>'novus_id', 'id'=>'novus_id', 'value'=>$novus['id'] ) ; echo form_hidden("nid",$param); ?>

<!-- Novus cover -->		
<div id="novus_cover" style="width:159px; height:200px;">
<div class="novus_image"> <div class="novus_gradient" style="width:22px;height:190px;"></div> 
<img src="<?='uploads/novus/'.$novus['cover_image']; ?>" alt="" class="cover_image">
</div>
</div>


<!-- End of Novus cover -->


	
			





		
<div id="novus_details_<?=$novus['id'];?>">
<!-- =============================== Author image and follow button ===============================  -->

<!-- Author Image -->

<div id="author_image" style="float:left; margin-right:10px;" >
<?php if(!isset($author['fb_user'])): ?>
		<?php if(isset($author['picture'])): ?>
			<img src="<?php echo (base_url().'uploads/authors/'.$author['picture']);?>" width="20" height="20" align="absbottom" />
		<?php else: ?>
			<img src="<?php echo (base_url().'images/logo.jpg');?>" width="20" height="20" align="absbottom" />
		<?php endif; ?>

		<?php else: ?>
			<img src="https://graph.facebook.com/<?php echo $author['fb_uid']; ?>/picture?type=large" width="70" height="70">
		<?php endif; ?>
</div>
<?php echo (isset($novus['author']))? anchor($novus['author'], "By <strong>".$novus['author']."</strong>",'title="View Author page"') : displayerror(); ?>
<!-- End of Author Image -->

<?php
		
if( logged() ) {
	
	$myfriend = false;
	
	foreach( $friends as $friend ){if(isset($novus['author_id'])){ if( $friend['id'] == $novus['author_id']) $myfriend = true; } else displayerror(); }

	if( ! $myfriend ){
		if( ( isset($owner) && $owner == 'power_user') || (isset($owner) && $owner != $this->uri->segment( 3 )))
		{
			if (!isset($novus['author'])){ displayerror(); }
			else if( $owner != $novus['author'] ) {
?>

<div id="follow-button" style="display:inline;">
<button id="follow_author" class="follow_author button button-gray" inject="no" auth_id="<?=$novus['author_id'];?>" style="padding:4px 18px 4px 16px;">
<!-- 
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" d="M39.363,79L16,55.49l11.347-11.419L39.694,56.49L72.983,23L84,34.085L39.363,79z"></path></svg>
-->

<span>+ Follow</span>
</button>
</div>

<?
}
}
} else { // If it is $myfriend
?>

<button id="unwatch_author" class="unwatch_author button" inject="no" author="<?=$novus['author_id']?>" style="padding:4px 18px 4px 16px;">
<svg xmlns="http://www.w3.org/2000/svg" fill="#fff" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
<path fill-rule="evenodd" clip-rule="evenodd" d="M39.363,79L16,55.49l11.347-11.419L39.694,56.49L72.983,23L84,34.085L39.363,79z"></path>
</svg>
<span>Following</span>
</button>

<?
} // End if "he IS my friend"
} // End if logged()
?>
</div>

<!-- =============================== END Author image and follow button ===============================  -->
<div class="novus_sandbox">
<? echo $novus['sandbox'];?>
</div>
<!-- =============================== Novus details, category, type, views, appreciatios, etc ===============================  -->		 
<style>
#novus_info svg path, #novus_info svg polygon { fill: #bbb; }
</style>
<div id="novus_info" style="clear:both;text-align: right; color:#888;  float:right; margin:28px 15px 0px 0px; line-height:21px;">
<div style="display:inline; color:#bbb; font-size:12px">
Category:
<?=anchor('categories/'.urlencode( $novus['category_title'] ), $novus['category_title'],'title="View this category"');?><br>
Type:
<?=anchor('types/'.urlencode( $novus['type_title'] ), $novus['type_title'],'title="View this type"');?><br><?=$novus['dateposted'];?>
</div><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 13.999 12" enable-background="new 0 0 13.999 12" xml:space="preserve"><path d="M11.941,0.33c-1.783-0.825-4.115-0.049-4.94,1.73c-0.825-1.779-3.157-2.556-4.94-1.73C0.162,1.211-0.746,3.461,0.754,6.115	 c1.065,1.889,2.953,3.312,6.247,5.863c3.294-2.551,5.182-3.975,6.247-5.863C14.748,3.461,13.84,1.211,11.941,0.33z"></path></svg>
	<?=$novus['appreciations']?>&nbsp;
	 	
	<!--
	<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="12px" height="12px" viewBox="42 42 16 16" enable-background="new 42 42 16 16" xml:space="preserve"><polygon points="42,42 42,54.037 44.444,54.037 44.444,58 50.186,54.037 57.999,54.037 57.999,42 	"/></svg>
	<? // echo $novus['num_of_comments'];?>&nbsp; -->
			
	
	<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve"><g id=""><path d="M13.32,4.991l0.824-1.166c0.284-0.406,0.163-0.98-0.276-1.285L10.49,0.185C10.052-0.12,9.466-0.039,9.18,0.366L8.357,1.531 L13.32,4.991z"/><path d="M7.598,2.553l-5.406,7.73c-0.229,1.5,3.509,4.12,4.963,3.46l5.406-7.731L7.598,2.553z"/><path d="M2.367,10.589C2.08,11.273,1.77,14.582,1.87,15.497c0.02,0.185,0.053,0.282,0.112,0.32c0.337,0.226,4.195-1.65,4.785-2.151 C5.426,14.101,2.353,11.937,2.367,10.589z"/></g></svg>
	<?=$novus['num_of_bits'];?>&nbsp;
	
	
	<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="-2 -5 16 16" enable-background="new -2 -2 16 16" xml:space="preserve"> <path d="M13.723,5.526C12.176,2.89,9.217,1.252,6,1.252c-3.218,0-6.177,1.638-7.721,4.274L-2,6l0.279,0.474 	C-0.176,9.11,2.782,10.747,6,10.747c3.217,0,6.176-1.637,7.723-4.273L14,6L13.723,5.526z M0.203,6 	C1.21,4.588,2.779,3.612,4.556,3.266C3.576,3.784,2.907,4.814,2.907,6c0,1.187,0.668,2.215,1.648,2.734 	C2.779,8.388,1.21,7.412,0.203,6z M4.911,5.521c-0.411,0-0.745-0.333-0.745-0.746c0-0.411,0.333-0.744,0.745-0.744 	s0.745,0.333,0.745,0.744C5.656,5.186,5.322,5.521,4.911,5.521z M7.444,8.734C8.423,8.215,9.093,7.187,9.093,6 	c0-1.186-0.67-2.215-1.648-2.734C9.22,3.612,10.789,4.588,11.797,6C10.789,7.412,9.22,8.388,7.444,8.734z"/> </svg>
	<?=$novus['views']+1;?><br><br>
</div>		

<!-- =============================== END OF Novus details, category, type, views, appreciatios, etc ===============================  -->	

<!-- =============================== BUTTONS ===============================  -->

<style>
#interact_buttons button {
	width: 125px;
	height: 35px;
	margin:3px;
}
#interact_buttons button svg{
height: 15px;
width: 15px;
}
</style>

<div style="float:right; display:inline; text-align: right; height:200px; width: 200px;" id="interact_buttons">

			 
<?php		
if( logged() ) {
if( $novus['end'] != 'Y' )
{ 
?>
<button id="" class="expand_novus button button-gray" inject="no" novus="<?=$novus['id'];?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 	 width="12px" height="12px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve"> <g id="Your_Icon"> 	<path  d="M13.32,4.991l0.824-1.166c0.284-0.406,0.163-0.98-0.276-1.285L10.49,0.185C10.052-0.12,9.466-0.039,9.18,0.366L8.357,1.531 		L13.32,4.991z"/> 	<path   d="M7.598,2.553l-5.406,7.73c-0.229,1.5,3.509,4.12,4.963,3.46l5.406-7.731L7.598,2.553z"/> 	<path  d="M2.367,10.589C2.08,11.273,1.77,14.582,1.87,15.497c0.02,0.185,0.053,0.282,0.112,0.32c0.337,0.226,4.195-1.65,4.785-2.151 		C5.426,14.101,2.353,11.937,2.367,10.589z"/> </g> </svg>
<span>Write a bit</span>
</button>
<?
}
?>

	
<?php
$is_appreciated = false; 
foreach( $apnovuses as $index => $apnovus ){


	if( is_array($apnovus) && $apnovus["id"] == $novus["id"] )
		$is_appreciated = true;
}

	if(!$is_appreciated) {
?>		
<button id="" class="appreciate button button-gray" inject="no" novus="<?=$novus['id'];?>">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 13.999 12" enable-background="new 0 0 13.999 12" xml:space="preserve"> <path   d="M11.941,0.33c-1.783-0.825-4.115-0.049-4.94,1.73c-0.825-1.779-3.157-2.556-4.94-1.73C0.162,1.211-0.746,3.461,0.754,6.115	 c1.065,1.889,2.953,3.312,6.247,5.863c3.294-2.551,5.182-3.975,6.247-5.863C14.748,3.461,13.84,1.211,11.941,0.33z"></path> </svg>
<span>Like</span>
</button>				
<?php
}
else
{
?>

<button id="" class="unappreciate button button-gray" inject="no" novus="<?=$novus['id'];?>">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 13.999 12" enable-background="new 0 0 13.999 12" xml:space="preserve"> <path  fill="#ce0000" d="M11.941,0.33c-1.783-0.825-4.115-0.049-4.94,1.73c-0.825-1.779-3.157-2.556-4.94-1.73C0.162,1.211-0.746,3.461,0.754,6.115	 c1.065,1.889,2.953,3.312,6.247,5.863c3.294-2.551,5.182-3.975,6.247-5.863C14.748,3.461,13.84,1.211,11.941,0.33z"></path> </svg>
<span>Liked</span>
</button>	

<? } 
// $comments = extract_beans($novus['comments']); if( logged() ){
?>	
<!--				  
<button id="" class="show_comments button button-gray" inject="no">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 	 width="12px" height="12px" viewBox="42 42 16 16" enable-background="new 42 42 16 16" xml:space="preserve"> <g id="Layer_4"> 	<polygon fill="#2e648a" points="42,42 42,54.037 44.444,54.037 44.444,58 50.186,54.037 57.999,54.037 57.999,42 	"/> </g> </svg>
<span>Comment</span>
</button>			
-->	
<? // } ?>


<?

if(!isset($novus['author'])){displayerror(); if( $owner == 'power_user') {?><div id="owner_only_buttons">
<button id="" class="remove_novus button button-gray" inject="no" novus="<?=$novus['id'];?>">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" id="Layer_1" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"> <polygon points="44,13.649 36.349,6 24.999,17.35 13.649,6 6,13.651 17.349,25 6,36.35 13.649,44 24.999,32.65	  36.35,44 44,36.35 32.649,25 "></polygon> </svg>
<span>Remove Novus</span>
</button><?
} }
else if( $owner == 'power_user' || $owner == $novus['author'] )
{
			
?>
<div id="owner_only_buttons">
<button id="" class="remove_novus button button-gray" inject="no" novus="<?=$novus['id'];?>">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" id="Layer_1" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve"> <polygon points="44,13.649 36.349,6 24.999,17.35 13.649,6 6,13.651 17.349,25 6,36.35 13.649,44 24.999,32.65	  36.35,44 44,36.35 32.649,25 "></polygon> </svg>
<span>Remove Novus</span>
</button>
				
		
<button id="" class="update_novus button button-gray" inject="no" novus="<?=$novus['id'];?>">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"> 					<path fill-rule="evenodd" clip-rule="evenodd" d="M39.363,79L16,55.49l11.347-11.419L39.694,56.49L72.983,23L84,34.085L39.363,79z"></path> 					</svg>
<span>Update Novus</span>
</button>
				
<?

if( $novus['end'] == 'N' ){
				
?>
					  
<button id="" class="end_novus button button-gray" inject="no" novus="<?=$novus['id'];?>">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 71 100" enable-background="new 0 0 71 100" xml:space="preserve"> <path d="M65.5,45V30c0-16.542-13.458-30-30-30s-30,13.458-30,30v15H0v55h71V45H65.5z M13.5,30c0-12.131,9.869-22,22-22 	s22,9.869,22,22v15h-44V30z"></path> </svg>
<span>End Novus</span>
</button>
				
<?
				  
} else if( $novus['end'] == 'Y' ){
					
?>
					  
<button id="" class="reopen_novus button button-gray" inject="no" novus="<?=$novus['id'];?>">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"> <path fill-rule="evenodd" clip-rule="evenodd" d="M39.363,79L16,55.49l11.347-11.419L39.694,56.49L72.983,23L84,34.085L39.363,79z"></path> 					</svg>
<span>Reopen Novus</span>
</button>
</div>			
<?	
} // End of if "is the novus Ended"
} // End of if "is the logged user the owner or power-user"
} // End of if "is logged in"
?>
<!-- =============================== END of BUTTONS ===============================  -->
<div class="socialshare">
<a href="#"target="_blank"  inject="no" tip="test" onclick="
    window.open(
      'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
      'facebook-share-dialog', 
      'width=626,height=436'); 
    return false;"> 
    
<svg style="fill:#3b5998;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		 width="35px" height="35px" viewBox="0 0 56.693 56.693" enable-background="new 0 0 56.693 56.693" xml:space="preserve">
<path d="M28.347,5.157c-13.6,0-24.625,11.027-24.625,24.625c0,13.6,11.025,24.623,24.625,24.623c13.6,0,24.625-11.023,24.625-24.623
	C52.972,16.184,41.946,5.157,28.347,5.157z M34.864,29.679h-4.264c0,6.814,0,15.207,0,15.207h-6.32c0,0,0-8.307,0-15.207h-3.006
	V24.31h3.006v-3.479c0-2.49,1.182-6.377,6.379-6.377l4.68,0.018v5.215c0,0-2.846,0-3.398,0c-0.555,0-1.34,0.277-1.34,1.461v3.163
	h4.818L34.864,29.679z"/>
</svg>
</a>
<a href="#"target="_blank"  inject="no" onclick="
    window.open(
      'https://twitter.com/intent/tweet?original_referer=http://www.novusbit.com&related=%23novusbit&text=Just found this on %23Novusbit '+encodeURIComponent(location.href)+'&url='+encodeURIComponent(location.href), 
      'twitter-share-dialog', 
      'width=626,height=436'); 
    return false;"> 

<svg style="fill:#00aced;" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="35px" height="35px" viewBox="0 0 56.693 56.693" enable-background="new 0 0 56.693 56.693" xml:space="preserve">
<path d="M28.348,5.157c-13.6,0-24.625,11.027-24.625,24.625c0,13.6,11.025,24.623,24.625,24.623c13.6,0,24.623-11.023,24.623-24.623
	C52.971,16.184,41.947,5.157,28.348,5.157z M40.752,24.817c0.013,0.266,0.018,0.533,0.018,0.803c0,8.201-6.242,17.656-17.656,17.656
	c-3.504,0-6.767-1.027-9.513-2.787c0.486,0.057,0.979,0.086,1.48,0.086c2.908,0,5.584-0.992,7.707-2.656
	c-2.715-0.051-5.006-1.846-5.796-4.311c0.378,0.074,0.767,0.111,1.167,0.111c0.566,0,1.114-0.074,1.635-0.217
	c-2.84-0.57-4.979-3.08-4.979-6.084c0-0.027,0-0.053,0.001-0.08c0.836,0.465,1.793,0.744,2.811,0.777
	c-1.666-1.115-2.761-3.012-2.761-5.166c0-1.137,0.306-2.204,0.84-3.12c3.061,3.754,7.634,6.225,12.792,6.483
	c-0.106-0.453-0.161-0.928-0.161-1.414c0-3.426,2.778-6.205,6.206-6.205c1.785,0,3.397,0.754,4.529,1.959
	c1.414-0.277,2.742-0.795,3.941-1.506c-0.465,1.45-1.448,2.666-2.73,3.433c1.257-0.15,2.453-0.484,3.565-0.977
	C43.018,22.849,41.965,23.942,40.752,24.817z"/>
</svg>
</a>
	<a href="#"target="_blank"  inject="no" onclick="
    window.open(
      'http://www.reddit.com/submit?url='+encodeURIComponent(location.href)+'&title=<?=$novus['title'];?>', 
      'twitter-share-dialog', 
      'width=900,height=536'); 
    return false;"> 

<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="35px" height="35px" viewBox="0 0 35 35" enable-background="new 0 0 35 35" xml:space="preserve">
<g>
	<path fill-rule="evenodd" clip-rule="evenodd" fill="#E53225" d="M23.835,16.782c-2.102-1.527-4.512-1.98-7.058-1.841
		c-2.17,0.118-4.17,0.736-5.803,2.227c-2.125,1.942-2.023,4.536,0.22,6.333c1.877,1.506,4.068,2.057,6.828,2.057
		c1.875,0.041,3.995-0.465,5.842-1.832C26.477,21.791,26.467,18.695,23.835,16.782z M12.942,19.129
		c0.036-0.697,0.626-1.221,1.362-1.211c0.701,0.014,1.239,0.532,1.246,1.206c0.009,0.742-0.524,1.252-1.299,1.24
		C13.474,20.354,12.906,19.818,12.942,19.129z M20.991,23.443c-1.095,0.512-2.238,0.816-3.458,0.805
		c-1.183-0.014-2.316-0.246-3.355-0.822c-0.355-0.197-0.829-0.439-0.489-0.99c0.296-0.475,0.683-0.258,1.04-0.051
		c1.694,0.986,3.441,0.906,5.215,0.256c0.2-0.072,0.388-0.182,0.583-0.27c0.394-0.186,0.85-0.439,1.095,0.127
		C21.849,23.031,21.388,23.26,20.991,23.443z M21.068,20.363c-0.76,0.004-1.381-0.527-1.373-1.178
		c0.008-0.639,0.59-1.248,1.211-1.266c0.611-0.018,1.339,0.641,1.362,1.235C22.293,19.844,21.781,20.359,21.068,20.363z"/>
	<path fill-rule="evenodd" clip-rule="evenodd" fill="#E53225" d="M24.573,12.733c0.674,0.022,1.323-0.575,1.345-1.235
		c0.023-0.675-0.561-1.309-1.234-1.343c-0.726-0.038-1.38,0.566-1.382,1.276C23.3,12.129,23.869,12.711,24.573,12.733z"/>
	<path fill-rule="evenodd" clip-rule="evenodd" fill="#E53225" d="M24.604,16.041c0.859,0.449,1.217,1.093,1.622,1.705
		c0.134,0.201,0.162,0.635,0.527,0.499c0.278-0.104,0.418-0.426,0.469-0.749C27.413,16.262,26.229,15.493,24.604,16.041z"/>
	<path fill-rule="evenodd" clip-rule="evenodd" fill="#E53225" d="M10.51,15.987c-1.184-0.34-1.92-0.149-2.321,0.567
		c-0.387,0.688-0.235,1.28,0.438,1.804C9.077,17.446,9.688,16.708,10.51,15.987z"/>
	<path fill-rule="evenodd" clip-rule="evenodd" fill="#E53225" d="M17.501,3.184c-8.396,0-15.203,6.808-15.203,15.203
		s6.807,15.201,15.203,15.201c8.396,0,15.201-6.806,15.201-15.201S25.896,3.184,17.501,3.184z M27.413,19.238
		c-0.255,0.199-0.427,0.348-0.408,0.721c0.111,2.078-0.938,3.584-2.526,4.738c-2.03,1.477-4.377,2.002-6.774,2.084
		c-2.599-0.117-5.006-0.617-7.075-2.182c-1.524-1.152-2.498-2.625-2.37-4.623c0.025-0.391-0.178-0.525-0.402-0.734
		c-1.168-1.084-1.375-2.313-0.601-3.435c0.824-1.193,2.457-1.592,3.756-0.823c0.471,0.279,0.808,0.232,1.241,0.023
		c1.366-0.656,2.79-1.126,4.322-1.14c0.504-0.004,0.638-0.211,0.617-0.666c-0.013-0.304,0.023-0.616,0.076-0.917
		c0.371-2.035,2.036-2.999,4.169-2.363c0.603,0.18,1.004,0.201,1.52-0.289c0.891-0.846,2.161-0.832,3.136-0.146
		c0.857,0.604,1.213,1.676,0.89,2.698c-0.319,1.017-1.337,1.687-2.503,1.647c-1.184-0.04-2.099-0.735-2.318-1.968
		c-0.156-0.882-0.858-0.758-1.374-0.91c-0.704-0.208-1.405-0.122-1.907,0.541c-0.452,0.598-0.529,1.287-0.547,2.005
		c-0.012,0.395,0.231,0.342,0.474,0.359c1.452,0.104,2.852,0.432,4.145,1.113c0.514,0.27,0.92,0.224,1.439-0.026
		c1.728-0.836,3.608,0.018,3.972,1.773C28.576,17.744,28.235,18.602,27.413,19.238z"/>
</g>
</svg>
</a>
</div>

<script type="text/javascript">	 		
$(document).ready( function() {	

// -----------------------------------
$('.unwatch_author').hover( function(){
$(this).find('span').html("Unfollow");
$(this).addClass('red_button');
},function(){$(this).find('span').html("Following");
$(this).removeClass('red_button');});
// -----------------------------------

// -----------------------------------
$('.unappreciate').hover( function(){
$(this).find('span').html("Unlike");

},function(){$(this).find('span').html("Liked");
});
// -----------------------------------
	
	$('.follow_author').click( function() {
			//$(this).val('Added!').animate({ backgroundColor:'#d8782a'}, 500);	
			$.post('author_controller/add_to_watch/'+$(this).attr('auth_id'), function(s){ window.location.reload();});		
		});
			
	$('.unwatch_author').click( function(){
			$(this).fadeOut();	
			$.post('author_controller/unwatch_author/'+$(this).attr('author'), function(s){ window.location.reload();});
		});
});
</script>
	
	
</div>
</div>
</div>
	
		

</div>