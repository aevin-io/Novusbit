$(document).ready(function ()
{
	$('.hide_notice').click(function ()
	{
		//alert('hide clicked');
		$(this).parent().parent().fadeOut();
		//$(this).parent().parent(".bit_wrapper").slideUp('blind');			
		$.post('author_controller/hide_notice/' + $(this).attr('novus'), function (s)
		{
			//  $('#contents').html( s );
		});

	});


	$('.unwatch_author').click(function ()
	{

		$(this).parent().parent().fadeOut();
		//$(this).parent().parent(".bit_wrapper").slideUp('blind');			
		$.post('author_controller/unwatch_author/' + $(this).attr('author'), function (s)
		{
			//$('#contents').html( s );
		});

	});

	$('#loading').hide();

});