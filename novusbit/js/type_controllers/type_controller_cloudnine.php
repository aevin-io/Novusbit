
 
  <h3> Cloud Nine </h3>
  <div id='note'>Write your bit using the following keywords!<br>Once, all keywords appear in your text, you will be able to post it.<br> The used words will be highlighted; Try to type in one of them to see. <br><strong>Take the challenge!</strong></div>
 
  <div id='fancy-text'></div><br>

<script type="text/javascript">

$(document).ready(function() {
   var foundkeywords = 0;
   $('#submit_button').hide();	

         $('#body').bind('keyup click blur focus change paste', function() 
                          {
                        //  alert( foundkeywords );	
                              var regex;
                              
                              $('#fancy-text').highlightRegex(undefined, foundkeywords );
                              
                              var or_val = $(this).html();
                              var new_str = or_val.replace(/\s/g , "|"); // turn spaces into OR.

                              $('#cloudnine').val( new_str );
                              
                              try {
                                 regex = new RegExp( new_str+"\b" , 'gim');
                                
                              }
                              catch (e) {
                                 $('#body').addClass('error');
                              }
                   
                              if (typeof regex !== 'undefined')
                              {
                                    $(this).removeClass('error');
                                    if ($(this).html() != '')
                                          $('#fancy-text').highlightRegex(regex, foundkeywords);
                               }
                         });
      
			
	 var keywords = [];
			
	       <?php
                     // Reading the keywords
                     // and echo them into js.
                     
		     foreach($keywords as $keyword => $num_of_occurancies) {
			echo "keywords.push('".$keyword."');";
		     }
	       ?>

	 var i=0
	 
         for( word in keywords )
	 {
	       $('#fancy-text').append( keywords[ word ]+ ' ');
	       foundkeywords++;
	       if(foundkeywords>5) return;
	 }
		 if ( foundkeywords == 0){
                $('#fancy-text').hide();
                 $('#note').html('Not enough bits yet to collect the keywords... :(<br>');
                                    $('#submit_button').show(100);
                                    }
       
		     
});

</script>


