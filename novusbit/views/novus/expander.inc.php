<!--
<script type="text/javascript">
	
	    var timeOutAjax,timeOutIdle;
           
            function updateBitters(){
	     //  alert("hello");
	     $('#loading').hide(); 
                $.post("novus_controller/broadcast", { story_id: <?php echo $novus['id']; ?>, user_id: <?php echo $auth_id; ?>, status: 1},
                function(data) {
                    $('#editing_status').html(data);
                });                
                clearTimeout(timeOutAjax);
                clearTimeout(timeOutIdle);
                timeOutIdle = setTimeout("updateIdleBitters()",36000);
            }
            
            function updateIdleBitters(){
                clearTimeout(timeOutAjax);
		
                $.post("novus_controller/broadcast", { story_id: <?php echo $novus['id']; ?>, user_id: <?php echo $auth_id; ?>, status: 2});
            }
            
            $(document).ready(function() {
	       
                timeOutIdle = setTimeout("updateIdleBitters()",36000);
                updateBitters();
                
                $('#body').keyup(function(event){
		    
                    var keyCode = ('which' in event) ? event.which : event.keyCode;
                    if(keyCode==8||keyCode==46||(keyCode>=48&&keyCode<=90)||(keyCode>=96&&keyCode<=105)){
                        clearTimeout(timeOutAjax);
			alert("pressed");
                        timeOutAjax = setTimeout("updateBitters()",500); 
                    }  
                });
           
                
            });
            $.address.init(function (event)
	{
		
	}).change(function (event)
	{
	   $.post("novus_controller/broadcast", { story_id: <?php echo $novus['id']; ?>, user_id: <?php echo $auth_id; ?>, status: 3}); 
	});
	    
            $(window).unload( function () { $.post("novus_controller/broadcast", { story_id: <?php echo $novus['id']; ?>, user_id: <?php echo $auth_id; ?>, status: 3}); } );
            
            
	    </script>
<div id="editing_status"></div>


   $('.new_novus_form').validationEngine('attach', {
				autoHidePrompt : true,
				scroll: true,
				promptPosition : "topRight",
				autoHideDelay: 2500,
				}
				
				);
				
				
-->

<?php if($novus['type_title'] === "Prose worm" ){ ?>
     
<script type="text/javascript">
$(document).ready(function(){
    $("#submit_button").click(function() {
    
 //if( $('#body').text().length<10 ){ alert ('Not inspired?\nPlease try to type a few words before submitting.'); return false;}
 				
	var dataString = $('#form_data').serialize();
	$.ajax({type: "POST",url: 'novus_controller/store_new_bit/<?php echo $novus['id']; ?>',data: dataString,
		success: function(s) { window.top.location="<?php echo $novus['id']; ?>"; }});
	return false;
	});
});
</script>
     
<?php } else if ($novus['type_title']==="Short sight"){ ?>
<script type="text/javascript">
$(document).ready(function(){
var editor1 =  new nicEditor({buttonList:['bold','italic','underline','left','center','right','justify','image','upload']}).panelInstance('body');
	$("#submit_button").click(function() {
	if( $('#body').text().length<10 ){ alert ('Not inspired?\nPlease try to type a few words before submitting.'); return false;}
		for( var i=0; i<editor1.nicInstances.length; i++ ){
			editor1.nicInstances[i].saveContent();
	}
	var dataString = $('#form_data').serialize();
	$.ajax({
				type: "POST",
				url: 'novus_controller/store_new_bit/<?php echo $novus['id']; ?>',
				data: dataString,
				success: function(s) {

					
					if( $('.bit_wrapper:last').length != 0 ){ // it is not the very first bit.
					   $('.all_bits_wrapper').append( $('.bit_wrapper:last').html() );
					}
					else
					{
					   $('.all_bits_wrapper').html( '<div class="bit_wrapper"><div class="bit" ></div><div class="bit_details"></div></div>' );
					}
					$('.bit:last').hide().html( s ).show('slow');
					$('.bit_wrapper:hidden').each(function(index) {
					     setTimeout(function(el) {
						 el.fadeIn();
						
					     }, index * 500, $(this));
					 });
					
					$("html, body").animate({ scrollTop: $(document).height() }, 1000);
					      
					$('.expander').hide();
					$('#body').html(''); // there should be a way to do that....
					$('#release_expander').show();
					
				    }
				    
			      });
		      
			      return false;
		    });
       });
      
     </script>
      <?php } else if ($novus['type_title']==="Irriversable"){?>
      <script type="text/javascript">
      $(document).ready(function(){
	
    var editor1 =  new nicEditor({buttonList: ['bold','italic','underline','left','center','right','justify','image','upload']}).panelInstance('body');
     
      
      $("#submit_button").click(function() {
	if( $('#body').text().length<10 ){ alert ('Not inspired?\nPlease try to type a few words before submitting.'); return false;}
		    for( var i=0; i<editor1.nicInstances.length; i++ ){
			editor1.nicInstances[i].saveContent();
			
		   }
	
		   
		    var dataString = $('#form_data').serialize();
		 
		    $.ajax({
				type: "POST",
				url: 'novus_controller/store_new_bit/<?php echo $novus['id']; ?>',
				data: dataString,
				success: function(s) {
				   // $('.bit_wrapper').show();
					//$('.bit_wrapper .bit').hide();
					 
					if( $('.bit_wrapper').length == 1 ) {
										//  location.reload();   
										//alert("first");
										
										 $('.all_bits_wrapper').append( $('.bit_wrapper:last').html() );
					
					
										 $('.bit').eq(1).hide().html( s ).show('slow');
										
										 
					}
					else
					{
					   $( '<div class="bit_wrapper"><div class="bit" >_</div><div class="bit_details"></div></div>' ).prependTo('.bit_wrapper:nth-child(2)'); 
					   $("html, body").animate({ scrollTop: 0 }, 1000, function(){$('.bit').eq(1).hide().html( s ).show(1100);});
					}
					
					
					
					      
					$('.expander').hide();
					$('#body').html(''); // there should be a way to do that....
					$('#release_expander').show();
					
				    }
				    
			      });
		      
			      return false;
		    });
       });
      
     </script>
      <?php } else {?>
            <script type="text/javascript">
      $(document).ready(function(){

      var editor1 =  new nicEditor({buttonList: ['bold','italic','underline','left','center','right','justify','image','upload']}).panelInstance('body');
     
      
      $("#submit_button").click(function() {
	//alert($('#body').text().length);      
            if( $('#body').text().length<10 ){ alert ('Not inspired?\nPlease try to type a few words before submitting.'); return false;}
				
	
	        for( var i=0; i<editor1.nicInstances.length; i++ ){
			editor1.nicInstances[i].saveContent();
			
	         }
	
		   
		    var dataString = $('#form_data').serialize();
		 
		    $.ajax({
				type: "POST",
				url: 'novus_controller/store_new_bit/<?php echo $novus['id']; ?>',
				data: dataString,
				success: function(s) {
				    <?php if ($novus['type_title']==="Laconism"){?>
				    $('.wordCount').html('<strong>0</strong> Words');
				    <?php } ?>
				    
					if( $('.bit_wrapper:last').length != 0 ){ // it is not the very first bit.
					   $('.all_bits_wrapper').append( $('.bit_wrapper:last').html() );
					}
					else
					{
					    $('.all_bits_wrapper').html( '<div class="bit_wrapper"><div class="bit" ></div><div class="bit_details"></div></div>' );
					}
					
					$('.bit:last').hide().html( s ).show('slow');
					$('.expander').hide();
					$('#body').html(''); // there should be a way to do that....
					$('#release_expander').show();
					//------------------------------------
					
					$('.nicEdit-main').attr('contenteditable','true');
				   $('.nicEdit-main').animate({'backgroundColor':'#fff'},500);
				   $('#hourglassmsg').hide(200);

				    }
				    
			      });
		      
			      return false;
		    });
       });
      
     </script>
      <?php } ?>
<?php
         
     include('novusbit/js/type_controllers/type_controller_core.php'); // javascript with php initiatives
		     
		
     switch ( $novus['type_title'] )
     {
	       default:
		    
	       break;
	       
	       case "Classic Novus":
		    
		    echo "<script src='".base_url()."novusbit/js/type_controllers/type_controller_classic.js' type='text/javascript'></script>";
		     
		   
	       break;
	       
	       case "Hourglass":
		    
		    echo '<script src="'.base_url().'novusbit/js/type_controllers/type_controller_hourglass.js" type="text/javascript"></script>';
		    
	       break;
	       
	       case "Laconism":
		    
		    echo '<link type="text/css" rel="stylesheet" href="'.base_url().'/novusbit/styles/laconism.css">';
		    echo '<script src="'.base_url().'novusbit/js/type_controllers/type_controller_laconism.js" type="text/javascript"></script>';
	       
	       break;
	       
	       case "Short sight":		// { This case does not affect the expander. }
		  
		   if( empty( $_POST['nit'] ) ) // if its not posted.
		   echo '<script src="'.base_url().'novusbit/js/type_controllers/type_controller_blurrysalad.js" type="text/javascript"></script>';
	       
	       break;
	       
	       case "Cloud Nine":
		
		    echo '<link type="text/css" rel="stylesheet" href="'.base_url().'/novusbit/styles/cloudnine.css">';
		    echo '<script src="'.base_url().'novusbit/js/libraries/jquery.highlightRegex.js" type="text/javascript"></script>';
		    include('novusbit/js/type_controllers/type_controller_cloudnine.php');
	       
	       break;
	       
	       case "Prose worm":
		
		     echo '<script src="'.base_url().'novusbit/js/type_controllers/type_controller_proseworm.js" type="text/javascript"></script>';
	       
	       break;
	       
	       case "Irriversable":		// { This case does not affect the expander. }
		    
	       break;
     }
     
  
?>
<!--
<div class="bit_expand_box_">
<h2>Feel inspired?</h2>
<button id="release_expander" class="expand_novus button button-gray" inject="no" novus="<?=$novus['id'];?>" style="width:200px; height:30px;">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" 	 width="16px" height="16px" viewBox="0 0 16 16" enable-background="new 0 0 16 16" xml:space="preserve"> <g id="Your_Icon"> 	<path d="M13.32,4.991l0.824-1.166c0.284-0.406,0.163-0.98-0.276-1.285L10.49,0.185C10.052-0.12,9.466-0.039,9.18,0.366L8.357,1.531 		L13.32,4.991z"/> 	<path d="M7.598,2.553l-5.406,7.73c-0.229,1.5,3.509,4.12,4.963,3.46l5.406-7.731L7.598,2.553z"/> 	<path d="M2.367,10.589C2.08,11.273,1.77,14.582,1.87,15.497c0.02,0.185,0.053,0.282,0.112,0.32c0.337,0.226,4.195-1.65,4.785-2.151 		C5.426,14.101,2.353,11.937,2.367,10.589z"/> </g> </svg>
<span>Im ready to write my bit!</span>
</button>
-->
<style>
<style>
.welcome_button:hover {

background: #3676a0;
color: white;
background: -moz-linear-gradient(top, #3676a0 0%, #1f577c 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#3676a0), color-stop(100%,#1f577c));
background: -webkit-linear-gradient(top, #3676a0 0%,#1f577c 100%);
background: -o-linear-gradient(top, #3676a0 0%,#1f577c 100%);
background: -ms-linear-gradient(top, #3676a0 0%,#1f577c 100%);
background: linear-gradient(top, #3676a0 0%,#1f577c 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3676a0', endColorstr='#1f577c',GradientType=0 );

}
.welcome_button {
color: white;
cursor: pointer;
margin-top: 9px;
background: #2e648a;

width: 170px;
font-size: 15px;
padding: 6px 15px 6px 15px;

	
}
</style>

<a name="bottom" style="display:none"></a>
<label for="maxWord"></label>	 
<div id="countdown" style="clear:both"></div>
<div id="hourglassmsg" style="clear:both"></div>
<?
echo form_open('', array('class' => '', 'id' => 'form_data'));
echo form_label('Write your bit body', 'body'); echo br();
echo form_textarea( array( 'id' => 'body', 'name'=> 'body', 'cols'   => '80', 'rows'   => '5', 'class' => 'validate[required]') );
?>
<input type="button" id = "submit_button" value="Post my bit!" class="welcome_button button sumbit_novus">
<div id="helpers" style="float:right;margin-right:110px">
<a href="http://thesaurus.com/" target="_blank"  inject="no" > 

<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#feb65d" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 100 81.166" enable-background="new 0 0 100 81.166" xml:space="preserve">
<path d="M87.043,0H50H12.957L0,23.557l50,57.609l50-57.609L87.043,0z M83.635,6.345l7.59,13.801h-13.64L83.635,6.345z M77.168,6.043
	l-5.537,12.636L57.792,6.043H77.168z M64.273,20.146H50H35.727L50,7.113L64.273,20.146z M42.208,6.043L28.37,18.679L22.832,6.043
	H42.208z M16.365,6.345l6.05,13.801H8.775L16.365,6.345z M10.288,26.189h14.776l15.078,34.399L10.288,26.189z M31.663,26.189H50
	h18.338L50,68.022L31.663,26.189z M59.857,60.589l15.078-34.399h14.777L59.857,60.589z"></path>
</svg>
</a>
</div>
<div id="helpers" style="float:right;margin-right:5px">
<a href="http://translate.google.com/" target="_blank"  inject="no" > 

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" fill="#2e648a" x="0px" y="0px" width="35px" height="35px" viewBox="0 0 100 75.445" enable-background="new 0 0 100 75.445" xml:space="preserve">
<g>
	<path d="M69.52,26.196c0.104,1.745,0.206,3.351,0.451,4.746c1.364-1.431,2.551-3.246,3.422-5.235   C72.903,25.636,71.09,25.776,69.52,26.196z"></path>
	<path d="M60.898,33.421c0,1.989,1.5,1.92,1.954,1.884c1.081-0.032,2.27-0.522,3.492-1.325c-0.388-1.85-0.631-4.016-0.805-6.388   C62.782,28.953,60.898,31.081,60.898,33.421z"></path>
	<path d="M99.763,29.503C101.242,16.194,89.562,3.89,73.682,2.022c-1.374-0.161-2.729-0.244-4.069-0.244   c-14.156,0-26.023,8.791-27.377,20.948C40.757,36.035,52.432,48.34,68.315,50.207c1.363,0.162,2.709,0.24,4.036,0.24   c1.465,0,2.902-0.1,4.308-0.28c5.686,6.187,11.622,7.855,14.942,7.855c2.131,0,3.184-0.688,2.409-1.298   c-4.847-3.849-5.876-7.604-5.569-10.558C94.672,42.441,98.978,36.537,99.763,29.503z M76.682,41.234l-1.654-3.531   c4.155-1.036,6.711-3.013,6.711-6.202c0-1.152-0.388-3.874-4.156-5.096c-1.535,3.49-3.873,6.736-6.597,9.075   c0.14,0.454,1.032,2.051,1.205,2.399l-3.596,2.305c-0.176-0.35-1.064-1.945-1.204-2.363c-1.746,0.977-3.667,1.605-5.623,1.605   c-3.069,0-5.093-1.957-5.093-5.201c0-4.818,3.701-8.623,8.658-10.648c-0.073-1.501-0.073-3.037-0.073-4.643   c-2.617,0.071-5.444,0.141-6.839,0.105l-0.212-4.084c1.606,0.035,4.536,0.035,7.124,0.035c0.067-1.5,0.103-3.245,0.17-4.712   l4.547,0.348c-0.067,0.348-0.182,3.108-0.286,4.225c3.806-0.175,8.586-0.628,12.463-1.466l0.381,4.224   c-3.837,0.697-8.865,1.047-13.052,1.187c-0.036,1.222-0.071,2.409-0.071,3.562c1.465-0.35,3.597-0.559,5.235-0.455   c0.14-0.523,0.245-1.048,0.278-1.57l4.296,1.082c-0.106,0.385-0.211,0.769-0.278,1.153c5.059,1.397,7.293,4.921,7.293,8.831   C86.312,36.185,83.228,39.644,76.682,41.234z"></path>
</g>
<g>
	<path d="M39.309,22.324c0.132-1.267,0.725-3.235,0.978-3.988c-2.833-0.803-6.475-1.413-9.623-1.413   c-1.346,0-2.708,0.083-4.089,0.244C10.614,19.036-1.124,31.34,0.361,44.649c0.79,7.035,5.118,12.939,11.38,16.666   c0.308,2.95-0.727,6.707-5.599,10.558c-0.778,0.607,0.281,1.296,2.423,1.296c3.336,0,9.304-1.667,15.016-7.854   c1.413,0.18,2.858,0.277,4.331,0.277c1.334,0,2.687-0.078,4.056-0.238c10.604-1.242,19.286-6.638,24.03-15.483   C45.301,44.531,38.043,34.448,39.309,22.324z M33.68,56.265l-2.15-7.937h-8.053l-2.072,7.937h-5.864l8.522-30.062h7.271   l8.405,30.062H33.68z"></path>
	<path d="M27.542,30.972h-0.117c-0.391,1.877-0.899,4.339-1.33,6.099l-1.798,6.88h6.411L28.91,37.11   C28.441,35.233,27.933,32.809,27.542,30.972z"></path>
</g>
</svg>
</a>
</div>
<?
//echo form_input( array( 'type' => 'button', 'value'=> 'Post it!', 'id'   => 'submit_button', 'class'   => 'welcome_button button button-gray sumbit_novus') );
echo form_hidden('nid', $novus['id']  );
echo form_hidden('nit', $novus['type_title']   );
echo form_close();
?>
	     

	<style>
	.nicEdit-panelContain { display: none;}
	

	</style>
	
	</div>
	<!-- 	end of middle_content -->
    