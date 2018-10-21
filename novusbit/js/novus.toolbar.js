     $(document).ready(function ()
     {
     	function hidestuff()
     	{
     		$('#options_panel').fadeOut('fast', function ()
     		{
     			$('.bit').css('width', 720);
     			$('#contents').css('width', 930);
     			$('#contents').animate(
     			{
     				marginLeft: 100
     			}, {
     				duration: "fast",
     				complete: function ()
     				{}
     			});
     		});

     		$('#unfreeview_button').show();
     		$('#freeview_button').hide();
     	}

     	function showstuff()
     	{
     		$('#unfreeview_button').hide();
     		$('#freeview_button').show();
     		$('#contents').animate(
     		{
     			marginLeft: 0
     		}, {
     			duration: "fast",
     			complete: function ()
     			{
     				$('#options_panel').fadeIn('fast');
     				$('.bit').css('width', 540);
     				$('#contents').css('width', 740);
     			}
     		});
     	}

     	$('#freeview_button').click(function ()
     	{
     		hidestuff();
     	});

     	$('#unfreeview_button').click(function ()
     	{
     		showstuff();
     	});

     	if ($('#options_panel').is(':visible'))
     	{
     		$('#unfreeview_button').hide();
     	}

     	$('#normal_font').click(function ()
     	{

     		$('.bit').css('fontSize', 14);
     		$('.bit').css('lineHeight', 1.7);

     	});

     	$('#larger_font').click(function ()
     	{

     		$('.bit').css('fontSize', 16);
     		$('.bit').css('lineHeight', 1.9);

     	});

     	$('#largest_font').click(function ()
     	{

     		$('.bit').css('fontSize', 18);
     		$('.bit').css('lineHeight', 1.9);

     	});

     	if (!$('#page_body').hasClass('nightvision'))
     	{
     		$('#normalvision_button').hide();
     	}


     	$('#nightvision_button').click(function ()
     	{
     		$('#page_body').removeClass('body_normal').addClass('nightvision', 400);
     		$('.bit').addClass('nightvision', 400);
     		$('.novus_title').css('color', 'white');
     		$('#normalvision_button').show();
     		$('#nightvision_button').hide();
     	});

     	$('#normalvision_button').click(function ()
     	{
     		$('#page_body').removeClass('nightvision', 500).addClass('body_normal');
     		$('.bit').removeClass('nightvision', 500);
     		$('.novus_title').css('color', '#573A1C');
     		$('#nightvision_button').show();
     		$('#normalvision_button').hide();

     	});
     });