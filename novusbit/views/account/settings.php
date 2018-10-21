<style>
#switch-wrap {
    height:26px;
    width: 600px;
    clear: both;
}

#switch-wrap .switch {

    height:26px;
    cursor:pointer;
}
#switch-wrap  .switch:hover { 
	opacity: 1;
}
#switch-wrap  .switch { 
    background: url(<?=base_url();?>/images/switch.png) 0px 0px no-repeat;
        opacity: 0.8;
}
#switch-wrap  .switch.on { 
    background: url(<?=base_url();?>/images/switch.png) 0px -33px no-repeat;
    opacity: 1;
}
#switch-wrap .switch label {
margin-left: 70px;
line-height: 24px;
}
</style>
<h3>Mail notifications</h3>

<div id="switch-wrap">
	<div id="new_novus" class="switch on"><label>Mail me when my followers post new novus. </label></div>
	<div id="bits" class="switch on"><label>Mail me when i got unread bits on my novus. </label></div>
	<div id="bits_my" class="switch on"><label>Mail me when i got unread bits on my liked novus. </label></div>
	<br>
	<div id="new_follower" class="switch"><label>Mail me when i got new followers. (soon)</label></div>
	<div id="new_likes" class="switch"><label>Mail me when i got new likes. (soon)</label></div>
	<div id="my_return"></div>
</div>


<script>

	$('.switch').click(function ()
	{
		$(this).toggleClass("on");
		if ($(this).hasClass('on'))
			{
				
				$.post(base_url + 'author_controller/email_notification/'+$(this).attr("id")+'/on', function (htmlcode) { $('#my_return').html(htmlcode)});
			}
		else
			{
				$.post(base_url + 'author_controller/email_notification/'+$(this).attr("id")+'/off', function (htmlcode) { $('#my_return').html(htmlcode)});
			}
	});
	
</script>

</div>