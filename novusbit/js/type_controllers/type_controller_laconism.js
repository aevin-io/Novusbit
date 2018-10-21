$(document).ready(function() {
     
    $('#body').addClass('count[100]');
    
    
	$('#body').each(function() {
		var elClass = $(this).attr('class');
		var minWords = 0;
		var maxWords = 100;
		var countControl = elClass.substring((elClass.indexOf('['))+1, elClass.lastIndexOf(']')).split(',');
		//alert( countControl);
		if(countControl.length > 1) {
			minWords = countControl[0];
			maxWords = countControl[1];
		} else {
			maxWords = countControl[0];
		}	
		
		$(this).after('<div class="wordCount"><strong>0</strong> Words</div>');
		if(minWords > 0) {
			$(this).siblings('.wordCount').addClass('error');
		}	
		
		$(this).bind('keyup click blur focus change paste', function() {

			var numWords = jQuery.trim($(this).text()).split(' ').length;
			if($(this).text() === '') {
				numWords = 0;
			}	
			$(this).siblings('.wordCount').children('strong').text(numWords);
			
			if(numWords < minWords || (numWords > maxWords && maxWords != 0)) {
				$(this).siblings('.wordCount').addClass('error');
				$('#submit_button').hide('100');
			} else {
				$(this).siblings('.wordCount').removeClass('error');
				$('#submit_button').show('100');
			}
		});
	});
});