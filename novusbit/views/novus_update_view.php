<?php uriresolve(); if ( !logged() ) die("you must login to create a new novus"); ?>


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
font-size: 18px;
padding: 6px 15px 6px 15px;

	
}



input[type=text], textarea {
padding: 15px;
margin: 0px 0px 15px 0;
border-radius: 3px;
-webkit-border-radius: 3px;
-moz-border-radius: 3px;
-ms-border-radius: 3px;
-o-border-radius: 3px;
border-radius: 3px;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
border: 1px solid #ddd;
border-left: 6px rgba(46, 100, 138, 0.2) solid;
-webkit-transition: all 0.3s ease-out;
-moz-transition: all 0.3s ease-out;
-o-transition: all 0.3s ease-out;
transition: all 0.3s ease-out;
}
input[type=text]:focus, textarea:focus, input[type=text]:active, textarea:active {
	-webkit-box-shadow: inset 0px 0px 3px 1px rgba(0, 0, 0, 0.2);

		box-shadow: inset 0px 0px 3px 1px rgba(0, 0, 0, 0.2);
		border-left: 6px rgba(24, 68, 99, 0.3) solid;
	
}
.input_focused {
	border-left: 6px rgba(24, 68, 99, 1) solid !important;
}
input[type=text]:hover, textarea:hover {
background:#fafafa;	border-left: 6px rgba(24, 68, 99, 1) solid;
	
}

#title {
	font-size: 1.7em;
}
#description, #sandbox {
	font-size: 1.3em;
}


 #feedback { font-size: 1.4em; }
 .ui-widget-content{
	 border: 1px solid #ddd;
 }

  .selectable .ui-selecting, { background: #FECA40; }
  .selectable .ui-selected { border-bottom: 6px rgba(243, 152, 0, 1) solid;   color:#666;
-webkit-box-shadow: inset 0px 0px 2px 1px rgba(0, 0, 0, 0.2);

		box-shadow: inset 0px 0px 2px 1px rgba(0, 0, 0, 0.2);

  }
  .selectable { list-style-type: none; margin: 0; padding: 0; width: 655px; clear:both; height: 170px;}
  #selectable_types { clear:both; height: auto;}
 
  .selectable li:hover { border-bottom: 6px rgba(243, 152, 0, 1) solid;}
 .selectable li { 
  
border-bottom: 6px rgba(243, 152, 0, 0.2) solid;
  color:#acacac;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
-ms-border-radius: 10px;
-o-border-radius: 10px;
border-radius: 10px; 

-webkit-transition: all 0.3s ease-out;
-moz-transition: all 0.3s ease-out;
-o-transition: all 0.3s ease-out;
transition: all 0.3s ease-out;
vertical-align:bottom;
 line-height: 50px;
margin: 3px; padding: 1px; float: left; width: 83px;height: 50px;  font-size: 14px; text-align: center; 
  cursor: pointer;

}
 #selectable_types { clear: both; height: 90px; }
 #selectable_types .ui-selected { border-bottom-color: rgba(46, 100, 138, 1);}
 #selectable_types li:hover { border-bottom-color: rgba(46, 100, 138, 1);}
 #selectable_types li { border-bottom-color: rgba(46, 100, 138, 0.3);}
 
 .types_descriptions { clear:both; width: 650px; height: 110px;  line-height: 24px; font-size: 16px; text-align: left;}
 .types_description svg {  width: 60px;  float: left; margin-bottom: 0px; padding: 5px; margin-right: 20px; fill: rgba(46, 100, 138, 1);}
 
/*
 #selectable_types { clear: both; height: 590px; }
 #selectable_types li { float: left; width: 315px; height: 130px; line-height: 20px; border-bottom-color: rgba(24, 68, 99, 0.3);}
  
 
 #selectable_types li span {}
 
  */
.selectable li span
{
 display: inline-block;
  vertical-align: middle;
  line-height: 14px;
  border:none !important;
  cursor: pointer;
 } 
 
</style>

<? if(isset($error)) echo $error;?>


    <div class="new_novus_box">
        <?php
        if ( isset($novus)){
        	echo '<div class="novus_expand_title">' . _('Edit your novus.') . '</div>';
        	echo form_open_multipart('novus_controller/update_novus/'. $novus['id'], array('class' => 'new_novus_form') );
        	echo form_hidden('commit','yes');
        }
        else if(isset($create_in))
            echo '<div class="novus_expand_title">' . _('Create a new novus in') . ' '.$create_in . '</div>';
        else    
            echo '<div class="novus_expand_title">' . _('Create a new novus? Easy.') . '</div>';
      
       if ( !isset($novus) ){
	       $novus['title']="";
	       $novus['description']="";
	       $novus['sandbox']="";
	       $novus['cover_image']="";
	       echo form_open_multipart('novus_controller/store_new_novus', array('class' => 'new_novus_form'));
       }
       
            ?>
            
               
            <?
        
        //class="validate[required,custom[email]]"

        $data = array(
              'name'        => 'title',
              'id'          => 'title',
              'value'       => $novus['title'],
              'placeholder'       => 'Give it a title.',
              'maxlength'   => '35',
              'class'		=> 'validate[required]',
              'size'        => '60',
              'style'       => 'width:650px',
            );
        echo form_input($data);
  ?>     

<?       
        echo br();
         $data = array(
              'name'        => 'description',
              'id'          => 'description',
              'placeholder' => 'Type in the beginning of a your story!',
              'maxlength'   => '800',
              'value'       => $novus['description'],
              'style'       => 'width:650px',
                            'class'		=> 'validate[required]',
               'cols'   => '50',
               'rows'   => '5'

             
            );
        echo form_textarea( $data );
       
       
        echo br();
        $data = array(
              'name'        => 'sandbox',
              'id'          => 'sandbox',
              'placeholder' => 'Any last thoughts or advices? (optional)',
              'value'       => $novus['sandbox'],
               'maxlength'   => '600',
               'style'       => 'width:650px',
              'cols'   => '50',
               'rows'   => '1'
            
            );
        echo form_textarea($data);
        echo br(2);

	?>
 <h3><?= _('Select Type');?></h3>    
<ol id="selectable_types" class="selectable">
<?php foreach( $types as $type ){ ?>
<li class="ui-widget-content"  id="<?=$type['id'];?>" title="<?=$type['title'];?>"><span><?=$type['title'];?></span></li>
<?php }?>
	</ol>
	
	<div class="types_descriptions">
               <?php
               $counter=0;
               foreach ( $types as $type ){
                   $counter++;
                   echo nl().'<div id="typedesc_'.$counter.'" class="types_description">';
                   echo $type['description'];
                   echo '</div>';
               }
               ?>
           </div>
           
	<br>

 <h3><?= _('Select Category');?></h3>    
<span id="catid" style="display:none"></span>
<span id="typeid" style="display:none"></span>
<ol id="selectable_categories" class="selectable">
<?php foreach( $categories as $cat ){ ?>
<li class="ui-widget-content" id="<?=$cat['id'];?>" title="<?=$cat['title'];?>"><span><?=$cat['title'];?></span></li>
<?php }?>
</ol>


<?
echo form_hidden('type','1');
echo form_hidden('category','1');
?>

        
<script type="text/javascript" src="<?=base_url();?>novusbit/js/libraries/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<link rel=stylesheet href="<?=base_url();?>novusbit/js/libraries/bootstrap-fileupload/bootstrap-fileupload.css" type="text/css">

<h3 <? if ( $novus['title']!=""){ ?>style="display:none"<? } ?>><?php echo _("Choose a cover image"); ?></h3>
   

<div class="fileupload fileupload-new" data-provides="fileupload" <? if ( $novus['title']!=""){ ?>style="display:none"<? } ?>>
	<div id="novus_cover" style="width:159px; height:200px;">
		<div class="novus_image">
			<div class="novus_gradient" style="width:22px;height:190px;"></div> 
			<?php if( $novus['cover_image'] == "" ) { ?>
			<div class="fileupload-new thumbnail" ><img src="<?=base_url();?>/images/cover_noimage.png" /></div>
			<? } else { ?>
			<div class="fileupload-new thumbnail" style="height:100% !important;"><img src="<?=base_url();?>/uploads/novus/<?=$novus['cover_image'];?>" style="height:100% !important;"/></div>
			<? } ?>
			<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 159px; max-height: 200px; line-height: 20px;"></div>
		<div>
	</div>
</div>


    <span class="btn btn-file">
    <span class="fileupload-new button button-gray">Select image</span>
    <span class="fileupload-exists button button-gray">Change</span>
    <input type="file" name="userfile" class="<?php if ( $novus['title']==""){ echo "validate[required, custom[validateMIME[image/jpeg|image/png]]]"; } ?>"/></span>
    <a href="#" class="button button-gray fileupload-exists" data-dismiss="fileupload" inject="no">Remove</a>

















  </div>
  <div style="float:right">
tags: <br><textarea type="text" size="100" id="tag" name="tag" ></textarea>
<!--suggested tags:
<br><span id="suggested" class="tagInputSuggestedTagList"></span>-->
  <link rel=stylesheet href="<?=base_url();?>novusbit/js/libraries/tagInput/jquery.tagInput.css" type="text/css">
</div>
</div>


       <!-- <input type="file" name="userfile" size="10" /> -->
        <?php echo br(3);
        

        echo form_hidden('visibility','public');
        //echo form_submit('submit', 'Expand this Novus');
        
        ?>
        <input type="submit" type="submit" value="Submit" class="welcome_button button button-gray sumbit_novus">
          <script type="text/javascript" src="<?=base_url();?>novusbit/js/libraries/tagInput/jquery.timers.js"></script>
<div width="600" style="margin-left:150px">





<script type="text/javascript">
function hideAllbutThis( whichone ){
    $( whichone ).siblings().hide();
    $( whichone ).fadeIn("fast");
}


  var tags=<?=$this->novus_model->getTags();?>

  $(function(){
  
 $('#loading').hide();

				
				
  $(".sumbit_novus").click( function(){  
 
        $('.new_novus_form').validationEngine('attach', {
				autoHidePrompt : true,
				scroll: true,
				promptPosition : "topRight",
				autoHideDelay: 2500,
				}
				
				);
 
		
  
   });


	
	
$("#title").focus().addClass('input_focused');

$("#title").blur(function() {
$(this).removeClass('input_focused');
return false;
});


<?php if ( $novus['title'] == "" ) { ?>

	$( "#selectable_types li" ).first().addClass( 'ui-selected' );
	$( "#selectable_categories li" ).first().addClass( 'ui-selected' );
	$( ".types_descriptions" ).hide();


<?php } else { ?>

	var current_category 	= ('#selectable_categories li[title="<?=$novus['category_title'];?>"]');
	var current_type 		= ('#selectable_types li[title="<?=$novus['type_title'];?>"]');
	
	$( current_category )	.addClass( 'ui-selected' );
	$( current_type )		.addClass( 'ui-selected' );
	
	
	$( 'input[name="category"]' )	.val( $( current_category )	.attr('id') );
	$( 'input[name="type"]' )		.val( $( current_type )		.attr('id') );
	
	var i = $( '#selectable_types li[title="<?=$novus['type_title'];?>"]' ).index( 	 );
	hideAllbutThis( "#typedesc_" +( i + 1 ) );

<?php } ?>


   $( "#selectable_categories" ).selectable({
      stop: function() {
       // var result = $( "#select-result-category" ).empty();
       // $( ".ui-selected", this ).each(function() {
         // var index = $( "#selectable_types li" ).index( this );
          //result.append( " #" + ( index + 1 ) );
          
          
          
          $("#selectable_categories .ui-selected").map(function() {
                       //return $(this).text();
                       $("#catid").html( $(this).attr('id') );
                       $('input[name="category"]').val( $("#catid").html() );
                       // $('input[name="category"]').val( $(this).attr('id') );
                    });
                    
       //});
      }
    });
    
      $( "#selectable_types" ).selectable({
      stop: function() {
        var result = $( "#select-result-type" ).empty();
        $( ".ui-selected", this ).each(function() {
          var index = $( "#selectable_types li" ).index( this );
          result.append( " #" + ( index + 1 ) );
          $( ".types_descriptions" ).fadeIn('slow');
          hideAllbutThis( "#typedesc_" +( index + 1 ) );
                    $('input[name="type"]').val( $(this).attr('id') );
                    
                    $("#selectable_types .ui-selected").map(function() {
                       //return $(this).text();
                       $("#typeid").html( $(this).attr('id') );
                       $('input[name="type"]').val( $("#typeid").html() );
                       // $('input[name="category"]').val( $(this).attr('id') );
                    });
        });
      }
    });
  
      $("#tag").tagInput({
      tags:tags,
      //jsonUrl:"tags.json",
      sortBy:"frequency",
      suggestedTags:["tagging","tag","component","delicious","javascript"],
      tagSeparator:" ",
      autoFilter:true,
      autoStart:false,
      //suggestedTagsPlaceHolder:$("#suggested"),
      boldify:true

    });
  });

</script>

</div>
    </div>
    <br>
        


    
    </div> <!-- end of #contents -->