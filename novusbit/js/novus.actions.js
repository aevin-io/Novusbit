$(document).ready(function ()
		{
			
			// $(".spam").hide(6000);
			$(".spam").html("This bit has been flagged as spam too many times.");
			
			function scrollWin()
			{
				//alert("called");
				$('html,body').animate(
				{
					scrollTop: $("body").offset().top
				}, 400);
			}
			scrollWin();
			
			$('.bit_wrapper').hover(
		   
					   function ()
					   {
						   $(this).find('.bit').animate({
               
                borderRightColor: '#2e648a', 
                borderRightWidth: '6px'
                }, 200);

						   $(this).find('.bit_details').fadeIn(220 );
					   }, function ()
					   {
						   $(this).find('.bit').animate({
               
                borderRightColor: 'transparent',
                borderRightWidth: '0px'
                }, 300);

						   $(this).find('.bit_details').fadeOut( 80);
					   });
			$('.expand_novus').click(function ()
			{
				//$( '.expander' ).show('slow');
				//var ofs = $('#form_data').offset().top;
				//$('html,body').animate({scrollTop:  ofs  -70 },1000);
				
				if($("#form_data").position()){
    if($("#form_data").position().top < $(window).scrollTop()){
        //scroll up
        $('html,body').animate({scrollTop:$("#form_data").position().top}, 1000);
    }
    else if($("#form_data").position().top + $("#form_data").height() > $(window).scrollTop() + (window.innerHeight || document.documentElement.clientHeight)){
        //scroll down
        $('html,body').animate({scrollTop:$("#form_data").position().top - (window.innerHeight || document.documentElement.clientHeight) + $("#form_data").height() + 15}, 1000);
    }
}



				//$( '#release_expander' ).hide();
			});
			
			// should add a "are you sure?" dialog
			$('.remove_bit').click(function ()
			{
				$(this).parent().parent(".bit_wrapper").slideUp('blind');
				$.post('bit_controller/remove_bit/' + $(this).attr('novus') + '/' + $(this).attr('bit'));
			});
			
			$('.like').click(function ()
			{
				$(this).attr("disabled", "disabled");
				//$(this).val('Thanks!').fadeOut(1200);
				// $(this)
				//$(this).parent().parent(".bit_wrapper").slideUp('blind');	
								$(this).addClass('green_button');		
				$.post('bit_controller/appreciate/' + $(this).attr('novus') + '/' + $(this).attr('bit'), function (s)
				{
					//$('#contents').html( s );
				});
			});
			$('.flag_spam').click(function ()
			{
				$(this).attr("disabled", "disabled");
				$(this).addClass('yellow_button');
				//$(this).parent().parent(".bit_wrapper").slideUp('blind');			
				$.post('bit_controller/spam/' + $(this).attr('novus') + '/' + $(this).attr('bit'), function (s)
				{
					// $('#contents').html( s );
				});
			});
			$('.appreciate').click(function ()
			{
				$(this).attr("disabled", "disabled");
				//$(this).css('background', '#ed6b14');
				$(this).html('Thanks!');//.fadeOut(2200);
				//$(this).parent().parent(".bit_wrapper").slideUp('blind');			
				$.post('novus_controller/appreciate/' + $(this).attr('novus'), function (s)
				{
					//$('#contents').html( s );
				});
			});
			$('.unappreciate').click(function ()
			{
				$(this).attr("disabled", "disabled");
				//$(this).css('background', '#ed6b14');
				$(this).html('Removed');//.fadeOut(1200);
				//$(this).parent().parent(".bit_wrapper").slideUp('blind');			
				$.post('novus_controller/unappreciate/' + $(this).attr('novus'), function (s)
				{
					//$('#contents').html( s );
				});
			});
			
			// should add a "are you sure?" dialog
			$('.remove_novus').click(function () 
			{
				$(this).attr("disabled", "disabled");
				//$(this).parent().parent(".bit_wrapper").slideUp('blind');			
				$.post('novus_controller/remove_novus/' + $(this).attr('novus'), function (s)
				{
					window.top.location = "#/";
				});
			});
			$('.update_novus').click(function ()
			{
				$(this).attr("disabled", "disabled");
				//$(this).parent().parent(".bit_wrapper").slideUp('blind');			
				$.post('novus_controller/update_novus/' + $(this).attr('novus'), function (s)
				{
					$('#contents').fadeOut("fast", function ()
					{
						$('#contents').html(s);
						$('#contents').fadeIn("fast");
					})
				});
			});
			
			// should add a "are you sure?" dialog
			$('.end_novus').click(function ()
			{
				$(this).attr("disabled", "disabled");
				//$(this).parent().parent(".bit_wrapper").slideUp('blind');			
				$.post('novus_controller/end_novus/' + $(this).attr('novus'), function (s)
				{
					$('#contents').html(s);
				});
			});
			
			$('.reopen_novus').click(function ()
			{
				$(this).attr("disabled", "disabled");
				//$(this).parent().parent(".bit_wrapper").slideUp('blind');			
				$.post('novus_controller/reopen_novus/' + $(this).attr('novus'), function (s)
				{
					$('#contents').html(s);
				});
			});
		});