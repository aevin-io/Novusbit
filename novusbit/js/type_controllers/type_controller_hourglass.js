jQuery.fn.countDown = function(settings,to) {
  settings = jQuery.extend({
    startFontSize: '36px',
    endFontSize: '22px',
    duration: 1000,
    startNumber: 60,
    endNumber: 0,
    callBack: function() { }
  }, settings);
  return this.each(function() {
    
    //where do we start?
    if(!to && to != settings.endNumber) { to = settings.startNumber; }
    
    //set the countdown to the starting number
    $(this).text(to).css('fontSize',settings.startFontSize);
    
    //loopage
    $(this).animate({
      'fontSize': settings.endFontSize
    },settings.duration,'',function() {
      if(to > settings.endNumber + 1) {
      
        $(this).css('fontSize',settings.startFontSize).text(to - 1).countDown(settings,to - 1);
        if(to < 15){
       		 $(this).css('color',"red");
        }
      }
      else
      {
        settings.callBack(this);
      }
    });
        
  });
};



$(document).ready(function() {
 
    //$( '.expander' ).hide();
    $( '#body' ).bind('focus', function() {
    $('#countdown').show();
	 $('#countdown').css('height','30px');
	  $('#countdown').css('color',"#444444");
	 $('#countdown').countDown({
	    startNumber: 60,
	    callBack: function(me) {
			//$( '#form_data' ).fadeOut('slow');
		  //$( '#release_expander' ).show();
		  //$( '#release_expander' ).html('let me try again!');
		  $('#countdown').hide();
		  $('.nicEdit-main').attr('contenteditable','false');
		   $('.nicEdit-main').animate({'backgroundColor':'#ddd'},500);
		  $('#hourglassmsg').hide().html('<font color="#090" size="10" style="letter-spacing:-2pt;">Time is up!</font><br><strong>You can either post your bit as it is or you can try again.</strong><br><br>').show(600);
		  
		//  var editor1 =  new nicEditor({buttonList: ['bold','italic','underline','left','center','right','justify','image','upload']}).panelInstance('body');
		  // editor1.setContent("");
	    }
	  });
	 
    });
});
