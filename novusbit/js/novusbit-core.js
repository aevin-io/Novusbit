$(function() 
{
$(".showlogin")			.click(	function(){ $(".loginbox").toggle(140); });
	$(".toplogin-submit").click(function(){	
		//attachvalidation( ".front_login" );
		
		$(".front_login").validationEngine('attach', {
					autoHidePrompt : true,
					autoHideDelay: 2500,
					ajaxFormValidation: true,
					scroll: false,
					ajaxFormValidationMethod: 'post',
					promptPosition : "bottomRight",
					onAjaxFormComplete: ajaxValidationLoginCallback,
					onValidationComplete: function(form, status){ } });	
});
    
	$(window).bind('resize', function(){

	 if ($(window).width() < 980) {
	       $('#options_panel').hide();
	       $('.middle_content').css( {"float": 'right', 'marginLeft': '0px'});
	        $('.bit').css( { 'width': ($(window).width()-200)+"px	" });
	        $('.all_bits_wrapper').css( { 'overflow': 'visible' });
			$('.novus_sidebar').show();  
	       $('#next_prev_target').hide();	       
	        $('#nav').css( {"float": 'left' });
	         //$('.bit').css( {"fontSize": '14px' });
	  }
	  
	 if ($(window).width() < 760) {
	       $('.novus_sidebar').hide();
	       $('.middle_content').css( {"float": 'left', 'marginLeft': '20px' });
	   //    alert($(window).width());
	   $('.bit').css( {"fontSize": '16px' });
	
	  }
	  
	  	  if ($(window).width() < 620) {
	  	
		  $('.bit').css( {"fontSize": '20px' });
	  }
	  
	  if ($(window).width() > 980) {
	  	$('#options_panel').show();
		  $('#next_prev_target').show();	
		  $('.novus_sidebar').show();   
		  $('.middle_content').css( {"float": 'right', 'marginLeft': '0px' });
		  $('#nav').css( {"float": 'right' });
		  $('.bit').css( {"fontSize": '14px' });
		  $('.bit').css( { 'width':"560px" });
		   $('.all_bits_wrapper').css( { 'overflow': 'hidden' });
	  }
	  
	  
	
	});
	
	
	$.address.init(function (event) {
		treat_injects();
		if (event.value != '/' || logged) { $('#top-bar').show(); }
	}).change(function (event)
	{
		$('#loading').show();
		$('#next_prev_target').hide();
		load_categories( location_args );
		wireframing( event );
		
		var uri_string 		= event.value.substr(1);
		var location 		= uri_string.split("/")[0];
		var location_args	= uri_string.split("/")[1];
		var options_0_uris 	= ["","home_controller","home","page","login","sort","types","categories","new","account","password",
								"profile","settings","signout","signup","friendinvites","about"];

		/* Viewing any page except a novus or author's page
		*********************************************************************/
	 
		if (include(options_0_uris, location))
		{	 								
			if (event.value != '/') {											// Viewing any page - not the front or home
				ajaxInclude( base_url + uri_string, '#contents');
			}
	
			if (event.value == '/') {											// Viewing the front page (either the welcome or the home page) 
				if (logged) {
					ajaxInclude(base_url+'home', '#contents');
				} else {
					welcome_page();
					
					
					
				}
			}			
		} 
		/* Viewing a novus
		*********************************************************************/
			 
		else if ( location == "greetings" )
		{	  								 
			$("#dialog").dialog(	{bgiframe: true,
									position: ['top', 21],
									title: '<span id="fb-alias-title">Novusbit is fun with friends!</span>',
									autoOpen: true,
								
									modal: true,
								
									width: 550,
									
									height: 600,
								
									resizable: true,
								
									open: function ()
									{
										closedialog = 1;
								
										$(document).bind('click', overlayclickclose);
									},
								
									focus: function ()
									{
										closedialog = 0;
									},
								
									close: function ()
									{
										top.location = base_url;
										//$(document).unbind('click');
									}});
			$('.ui-widget-overlay').click(function (){ $("#dialog").dialog("close"); });
			ajaxInclude(base_url + 'friendinvites', '#dialog');
		}
		/* Viewing a novus
		*********************************************************************/
			 
		else if ( !isNaN(location) )
		{	  								 
			ajaxInclude(base_url + (event.value.substr(1)), '#contents');
			next_prev(location);
		}
		
		/* Viewing an author's page
		*********************************************************************/
		
		else
		{			
			if ($('#account_menu').length == 0) {								// If the author menu is NOT in display					
				author_page( location, location_args );
			} 
			else if ($('#author_alias').html() != location)	{					// jumping from author to author 
				author_page( location, location_args );
			}
			else { 																// navigating the same author 					
				author_content( location, location_args );
			}
		}
		
										
		/* Facebook registration
		*********************************************************************/
	 
		if (uri_string.split("/")[0] == "login" && uri_string.split("/")[1] == "newuser")
		{
			$("#dialog").dialog("open");
			$('.ui-widget-overlay').click(function (){ $("#dialog").dialog("close"); });
			ajaxInclude(base_url + 'login/new_fb_user', '#dialog');
			ajaxInclude(base_url + 'home_controller/home', '#contents');
		}
		
		
	}); // End of $.address.init & .change()






$("#navigation .level1").hover(function(){$(this).find(".level2").fadeIn(170)},function(){$(this).find(".level2").hide()});

	function treat_injects(){
	$("a:not([inject='no'])").address(function (){ return $(this).attr('href').replace(base_url, ''); });
}

function wireframing( event ){ 
	if (event.value != '/' || logged ) { $('#top-bar').show();}
	if (event.value == '/' && !logged) { $('#contents_wrap').html('<div id="welcome_contents"></div>'); }
	else {
		if ($('#options_panel').length <= 0) {
			$('#contents_wrap').html('<div id="contents" class="contents"></div><div id="options_panel"></div>');
		}
	}
}

function next_prev(location){
	ajaxInclude(base_url + 'novus_controller/next_previous_novus/' + location, '#next_prev_target');
	$('#next_prev_target').show();
}

function load_categories( larg ){
	$('#options_panel').show();
	if ($('#categories').length == 0) {
		ajaxInclude(base_url + 'home_controller/options_panel/categories/' + larg, '#options_panel');	
	}
}

function author_page( l, larg ){
	$.post(base_url + 'author_controller/view_author/' + l, function (htmlcode) {
		$('#contents').html(htmlcode);
		author_content( l, larg );
	}); 
	return true;
}

function author_content( l, larg ){
	$('#options_panel').hide();
	$('#next_prev_target').hide();
	ajaxInclude(base_url + 'author_controller/author_contents_page/' + l + '/' + larg, '#author_contents');
	$('.profile_links').removeClass('selected');
	switch ( larg ){
		case "novus":
			$(".nvs").addClass('selected');
		break;
		case "bits":
			$(".bts").addClass('selected');
		break;
		case "likes":
		case "appreciations":
			$(".lks").addClass('selected');
		break;
		case "watching":
			$(".wtch").addClass('selected');
		break;
	}
	return true;
}

function include(arr, obj)
{
	for (var i = 0; i < arr.length; i++)
	{
		if (arr[i] == obj) return true;
	}
	return false;
} // End of include

function ajaxInclude(inurl, div)
{
	$.ajax(
	{
		url: inurl,
		type: 'GET',
		success: function (htmlcode)
		{
			$(div).html(htmlcode);

		},
		complete: function (jqXHR, textStatus)
		{
			return true;
		}
	});
	
	return false;

} // End of ajaxInclude
// -------

$('#feedback').click(function ()
{
	$("#feedback_dialog").dialog("open");
	$('.ui-widget-overlay').click(function ()
	{
		$("#feedback_dialog").dialog("close");
	});
	try
	{
		var pathname = $(location).attr('href');

		pathname = encodeURIComponent(location.href);

		$.post(base_url + 'feedback_controller/index/', {
			uri: pathname
		}, function (htmlcode)
		{
			$('#feedback_dialog').html(htmlcode);
		});
	}
	catch (err)
	{

		}
});






var closedialog;

function overlayclickclose()
{

	if (closedialog)
	{

		// $('#mydialog').dialog('close');

	}

	//set to one because click on dialog box sets to zero
	closedialog = 1;

}

$("#dialog").dialog(
{

	bgiframe: true,
	position: ['center', 210],
	title: '<span id="fb-alias-title">Choose your nickname</span>',
	autoOpen: false,

	modal: true,

	width: 550,

	resizable: false,

	open: function ()
	{
		closedialog = 1;

		$(document).bind('click', overlayclickclose);
	},

	focus: function ()
	{
		closedialog = 0;
	},

	close: function ()
	{
		top.location = base_url;
		//$(document).unbind('click');
	}


});

$("#feedback_dialog").dialog(
{

	bgiframe: true,
	position: ['center', 110],
	title: ' Provide your feedback',
	autoOpen: false,

	modal: true,

	width: 500,

	resizable: true,

	open: function ()
	{
		$(".ui-dialog-titlebar-close").hide();
		closedialog = 1;

		$(document).bind('click', overlayclickclose);
	},

	focus: function ()
	{
		closedialog = 0;
	},

	close: function ()
	{
		top.location = location.href;
		//$("#feedback_dialog").dialog("close");
	},

	buttons: {

		Cancel: function ()
		{
			$(this).dialog('close');
		},
		Submit: function ()
		{

			$('#feedback_form').submit();

		}

	}


});
});


function welcome_page()
{
		$('#top-bar').hide();
		$.post(base_url + 'home_controller/welcome', function (htmlcode)
		{
			$('#welcome_contents').hide();
			$('#welcome_contents').html(htmlcode);
			
			$.post(base_url + 'home_controller/welcome_novus/', function (htmlcode) {
				welcomeInit( htmlcode );
			});	
		});
}
			
function welcomeInit( htmlcode ) {
 //$('#blanker').toggle();
									
	$('#welcome_novus').hide();
	$('#fb_registration').hide();
	$('#welcome_novus').html(htmlcode);
	$('#fb_registration').show();
	$.post(base_url + 'login', function (htmlcode) { $('#fb_panel_welcome').html(htmlcode); $('#fb_registration').show();});
	


		
	function attachvalidation( where ){
		$(where).validationEngine('attach', {
					autoHidePrompt : true,
					autoHideDelay: 2500,
					ajaxFormValidation: true,
					scroll: false,
					ajaxFormValidationMethod: 'post',
					promptPosition : "bottomLeft",
					onAjaxFormComplete: ajaxValidationLoginCallback,
					onValidationComplete: function(form, status){ $(where).validationEngine('detach'); }
					});
	}
	
	var targ=0;
	$('#prev').css('opacity', 0.5);
	
	$('#next').click(function () {

	targ -= 190;
	
		var gt = $('#container').css('left');
		var str = 0;
		if(gt != 'auto')
			str = parseInt ( gt.replace("px", "") );
		
			
		//alert(str);
		if ( targ >= -760 ) {
			$('#container').animate({ left: '-=190' }, 400, function () {
				if ($('#container').css('left') == '-760px') {
					$('#next').attr('title','Sign up to twist your story!');
					$('#next').tipTip({activation:"hover"});
					$('#next').css('opacity', 0.5);
				} else {
					$('#next').attr('title','');
					$('#prev').css('opacity', 1);
				}
			});
		} else {
			$(this).css('opacity', 0.5);
			//alert(str);
		}
	});
	
	$('#prev').click(function ()
	{
		targ += 190;
		
		//alert(targ);
		if ($('#container').css('left') == '-190px') $('#prev').css('opacity', 0.5);
		$('#next').attr('title','');
		$('#next').unbind('hover');  

		if ($('#container').css('left') != 'auto' && $('#container').css('left') != '0px') {
			$('#container').animate({ left: '+=190' }, 400, function () {$('#next').css('opacity', 1); });
		} else {
			$(this).css('opacity', 0.5);
			
		}

	});

	$('#switch').click(function ()
	{
		$('#switch').toggleClass("on");
		if ($('#switch').hasClass('on'))
			{$.post(base_url + 'home_controller/welcome_novus_recentbits/', function (htmlcode) { $('#welcome_novus').html(htmlcode)});}
		else
			{$.post(base_url + 'home_controller/welcome_novus/', function (htmlcode) { $('#welcome_novus').html(htmlcode); });}
	});
	
	
	//$('.logo_text').animate( { marginLeft: '-=50' },900);
	$('#welcome_quote').delay(300).fadeIn(300).animate( { marginLeft: '+=100' },900);
	
	
	$('#welcome_novus').show();
	$('#welcome_contents').show();
	$("#email_registration").hide();
	$('#forgot_pass')		.click ( function(){ $('.loginbox').animate({'width':'270px'},600).html('<iframe src="'+base_url + 'auth/forgot_password/" width="270" height="200"></iframe>');});
	$("#register_by_email")	.click( function(){ $("#email_registration").slideToggle(300,'easeOutQuad'); $("#fb_registration").slideToggle(300,'easeOutQuad');});
	$("#register_with_fb")	.click( function(){ $("#fb_registration").slideToggle(300,'easeOutQuad'); $("#email_registration").slideToggle(300,'easeOutQuad');});
	$("#whatis")			.click(	function(){ $('#whatsanovus-wrap').toggle(); $('#blanker').toggle(); });
	$("#close_whatsnovus")	.click(	function(){ $('#blanker').hide(); $('#whatsanovus-wrap').hide(); });
	
	//$("#novusup")			.click( function(){ 
	
	$(".front_registration").validationEngine('attach', {
					autoHidePrompt : true,
					autoHideDelay: 2500,
					ajaxFormValidation: true,
					scroll: false,
					ajaxFormValidationMethod: 'post',
					promptPosition : "bottomLeft",
					onAjaxFormComplete: ajaxValidationCallback,
					onValidationComplete: function(form, status){  } });	 
					
					//});
	//$("#front_registration").change(function(){ attachvalidation( this ); });
	
} // <- End of welcomeInit()



/**
		*
		* @param {jqObject} the field where the validation applies
		* @param {Array[String]} validation rules for this field
		* @param {int} rule index
		* @param {Map} form options
		* @return an error string if validation failed
		*/
		
		function checkPassword(field, rules, i, options) {
				  //initial strength
			var strength = 0
			var password = field.val();
			
			if (field.val() == "password") {
				return options.allrules.passwordneed.alertText;
			}
			//if the password length is less than 6, return message.
			if (password.length < 6) {
				  
				  return options.allrules.passwordtooshort.alertText;
			}
				  
			//length is ok, lets continue.
				  
			//if length is 8 characters or more, increase strength value
			if (password.length > 7) strength += 1
				  
			//if password contains both lower and uppercase characters, increase strength value
			if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))	 strength += 1
				  
			//if it has numbers and characters, increase strength value
			if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
				  
			//if it has one special character, increase strength value
			if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))	 strength += 1
				  
			//if it has two special characters, increase strength value
			if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) strength += 1
				  
			//now we have calculated strength value, we can return messages
				  
			//if value is less than 2
			if (strength < 2 ) {
				  return options.allrules.passwordweak.alertText;
			} else if (strength == 2 ) {
				   //return options.allrules.passwordgood.alertText;
				   return true;	
			} else {
				return true;
				   //return options.allrules.passwordstrong.alertTextOk;
			}
		}
		
					  
		// This method is called right before the ajax form validation request
		// it is typically used to setup some visuals ("Please wait...");
		// you may return a false to stop the request 
		function beforeCall(form, options){
			if (window.console) 
			console.log("Right before the AJAX form validation call");
			return true;
		}
			
		// Called once the server replies to the ajax form validation request
		
		function ajaxValidationLoginCallback(status, form, json, options)
		{	
			if (window.console) console.log(status);
			$(".formmessage").html( "" );
			if (status === true) {
				console.log(json[0][0]);
				var obj = jQuery.parseJSON( json );
				if(json[0]=="ola kala") {	
					location.reload();
				}
				else if(json[0]=="resend") {	
				$('.loginbox').animate({'width':'300px'},600).html('<iframe src="'+base_url + 'auth/send_again/" width="300" height="200"></iframe>');
						//$.post(base_url + 'auth/send_again/'	, function (htmlcode) {
						//	$('.loginbox').html(htmlcode);
							
						//}); 
				}
				else { 
				$('#password').attr('title',json[0]);
					$('#password').tipTip({activation:"focus"});
					$("#password").focus(); // triggers display of tipTip on page load.
					setTimeout("$('#tiptip_holder').hide();", 3000); //auto-hide tipTip after 8 seconds.
				//$(".formmessage").show().html( json[0] ).delay(3000).fadeOut(200); 
				}
			}
		}
		
		
		
		function ajaxValidationCallback(status, form, json, options)
		{
			if (window.console) console.log(status);
			
			$(".formmessage").html( "" );
			if (status === true) {

				console.log(json[0][0]);
				var obj = jQuery.parseJSON( json );
				
				if(json[0]=="registeredok"){
				
					//$("#email_registration").fadeOut(700);
					$('#registration_area').hide(300);
					$(".formmessage_register").hide().html( '<div class="success"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="-9.475 -7.462 95.333 100" enable-background="new -9.475 -7.462 95.333 100" xml:space="preserve"> <path d="M79.126,73.432c8.933,27.89-51.466,12.787-56.245,8.321v7.088c0,2.002-1.692,3.697-3.54,3.697H-5.929 	c-1.848,0-3.546-1.695-3.546-3.697V29.518c0-1.85,1.692-3.545,3.546-3.545h25.271c1.847,0,3.54,1.695,3.54,3.545v4.004 	C34.9,25.663,41.067,5.942,41.222,5.171c1.847-8.012,6.471-12.633,13.097-12.633c6.931,0,15.1,6.778,15.1,21.109 	c0,3.542-1.388,9.09-3.545,13.25h2.157c9.093,0,19.413,4.317,16.022,17.415c3.546,6.009,1.233,12.632-1.537,15.099 	C85.287,64.955,82.975,70.657,79.126,73.432z M68.954,57.25c8.783,0,9.094-9.242,1.079-9.552c-1.698-0.155-1.698-1.847,0-1.847 	c8.008,0,6.626-10.171-2.002-10.171h-9.094c-3.235,0-4.778-2.002-4.778-4.004c0-3.701,6.471-11.712,6.471-17.876 	c0-7.856-3.85-12.48-6.316-12.48c-2.615,0-4.004,2.157-4.313,4.776c-1.848,12.329-15.41,32.821-27.119,37.907v27.89 	c16.488,8.167,30.973,8.783,37.904,9.091c10.481,0.307,15.719-8.012,4.934-10.324c-2.312-0.31-2.157-2.312-0.465-2.312 	c10.94,0,11.709-8.167,3.7-9.09C66.952,58.948,66.952,57.25,68.954,57.25z"></path> </svg>&nbsp;<strong>We have sent you an activation link, check your e-mail!<strong></div>' ).fadeIn(1200);	

					return;
				}
				else { 
				
				$(".formmessage_register").show().html( '<div class="warning"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"> <path d="M98.692,80.351L58.485,8.793c-1.73-3.077-4.984-4.981-8.515-4.981c-3.527,0-6.783,1.904-8.512,4.981L1.252,80.351	c-1.698,3.024-1.669,6.721,0.085,9.717c1.751,2.992,4.958,4.831,8.428,4.831h80.413c3.468,0,6.674-1.839,8.426-4.831  c0.893-1.525,1.337-3.228,1.337-4.933C99.941,83.484,99.524,81.837,98.692,80.351z M44.045,59.222V34.75v-1.363  c0.085-4.008,2.388-6.652,5.97-6.652c3.58,0,5.968,2.729,5.968,6.652v1.363v24.472v1.281c-0.085,4.092-2.388,6.649-5.968,6.649  c-3.582,0-5.97-2.643-5.97-6.649V59.222z M50.01,84.744c-3.775,0-6.844-3.068-6.844-6.845s3.068-6.765,6.844-6.765  c3.776,0,6.764,2.988,6.764,6.765S53.786,84.744,50.01,84.744z"></path> </svg>&nbsp;<strong>' +json[0]+"</strong></div>" ).delay(4000).fadeOut(200);}
				


				// form.submit();
				// or you may use AJAX again to submit the data
			}
		}
		
		
		function checkUsername(field, rules, i, options){ 
  
			//get the username  
			var username = field.val();
			
			if (username == "username") {
				// this allows to use i18 for the error msgs
				
				return options.allrules.validateusername.alertText;
			}
		}	 