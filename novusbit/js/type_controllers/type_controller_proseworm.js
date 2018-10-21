function insertAtCursor(myField, myValue) {

  //IE support

  if (document.selection) {

    myField.focus();

    sel = document.selection.createRange();

    sel.text = myValue;

  }

  //MOZILLA/NETSCAPE support

  else if (myField.selectionStart || myField.selectionStart == '0') {

    var startPos = myField.selectionStart;

    var endPos = myField.selectionEnd;
    /*
    myField.value = myField.value.substring(0, startPos)

                  + myValue

                  + myField.value.substring(endPos, myField.value.length);
    */
    myField.value = myValue;

  } else {

    myField.value = myValue;

  }

}




function getCaret(nBox) { 
		var cursorPos = 0;
         	if (document.selection)
		{ 
		     nBox.focus();
		     var tmpRange = document.selection.createRange();
		     tmpRange.moveStart('character',-nBox.value.length);
		     cursorPos = tmpRange.text.length;
     		}
        	else
		{
		    if (nBox.selectionStart || nBox.selectionStart == '0')
		    {
		       cursorPos = nBox.selectionStart;
		    }
		}

		return cursorPos;
}


$(document).ready(function() {
    
      String.prototype.capitalize = function() {
	return this.charAt(0).toUpperCase() + this.slice(1);
      }
      
      var lastbit = $('.bit').last().html();
      lastbit = lastbit.replace(/^\s*|\s*$/g,'');
      lastbit = lastbit.replace(/[^A-ZA-zΑ-Ωα-ωίϊΐόάέύϋΰήώ 0-9]+/g,'');
	
      var words_array = lastbit.split(' ');
      var howmany = words_array.length - 1;
      var lastword = words_array[ howmany ];
      lastword = lastword.capitalize();

      $('#body').html( lastword + ' ' );
	    
      $(this).bind('keyup click blur focus change paste', function() {
	

		 // if( getCaret( document.getElementById("body") ) <= lastword.length )
	        //  {
		         
		          if( $('#body').val().length < lastword.length ) {
		          	insertAtCursor(document.getElementById("body"), $('#body').html() );
		          	}
	       //   }
      });
});