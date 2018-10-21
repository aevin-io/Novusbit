jQuery.fn.slideLeftHide = function(speed, callback) { 
  this.animate({ 
    width: "hide", 
    opacity : 0,
    paddingLeft: "hide", 
    paddingRight: "hide", 
    marginLeft: "hide", 
    marginRight: "hide" 
  }, speed, callback);
}

jQuery.fn.slideLeftShow = function(speed, callback) { 
  this.animate({ 
    width: "show", 
    opacity : 1,
    paddingLeft: "show", 
    paddingRight: "show", 
    marginLeft: "show", 
    marginRight: "show" 
  }, speed, callback);
}

onAnimationFinished = function(){
  // code to be executed after the animation finishes
  alert("anim finished");
};
 
	$('#loading').hide();

	
	$('#sort li').tipTip({
		defaultPosition: 'top',
		edgeOffset: 10
	});
	$('#filter li').tipTip({
		defaultPosition: 'top',
		edgeOffset: 10
	});
	$('.hideme').tipTip({
		defaultPosition: 'top',
		edgeOffset: 30
	});
	$('.hideme').click(function () {
	$.ajax(
	{
		url: base_url + 'home_controller/notices_drop/',
		type: 'GET',
		success: function (htmlcode)
		{
			$('#notdrp').html(htmlcode);

		},
		complete: function (jqXHR, textStatus)
		{
			return true;
		}
	});
		$.post('novus_controller/reset_lastbit_count/' + $(this).attr('novus_id'));
	});

	//$('.novus_details').hide();
	$('.novus').hover(

	function () {
		$(this).find('.novus_details').slideLeftShow(150);
	}, function () {
		$(this).find('.novus_details').slideLeftHide(100);
	})


	function getFileName(path) {
		return path.match(/[-_\w]+[.][\w]+$/i)[0];
	}

	function getPath(path) {
		return path.replace(/^.*[\\\/]/, '');
	}


	function scrollWin() {
		//alert("called");
		$('html,body').animate({
			scrollTop: $("body").offset().top
		}, 600);
	}
	scrollWin(); 
	
	
$(function () {
 
 
    // options...
    // ===============================================================
    $list = $('#container');

	$list.isotope({
		// options
		itemSelector: '.novus',

		animationEngine: 'css',
		sortAscending: false,
		getSortData: {
			name: function ($elem) {
				return $elem.find('.novus_cover_title').html();
			},
			love: function ($elem) {
				return parseInt($elem.attr('appr'));
			},
			bits: function ($elem) {
				return parseInt($elem.attr('bits'));
			}
		}
	});



	$('#filter a').click(function () {
		var filterName = $(this).attr('data-filter');



		$list.isotope({
			filter: filterName
		});
		return false;
	});


	$('#sort a').click(function () {
		var sortName = $(this).attr('data-sort');

		$list.isotope({
			sortBy: sortName
		});
		return false;
	});


	var currentLayout = 'fitRows';

	$('#layouts a').click(function () {

		var layoutName = $(this).attr('href').slice(1);
		testMe(layoutName);
		$list.removeClass(currentLayout).addClass(layoutName);
		currentLayout = layoutName;
		$list.isotope({
			layoutMode: layoutName
		});

		return false;
	});


	// switches selected class on buttons
	$('#options').find('.option-set a').click(function () {
		var $this = $(this);

		// don't proceed if already selected
		if (!$this.hasClass('selected')) {
			$this.parents('.option-set').find('.selected').removeClass('selected');
			$this.addClass('selected');
		}

	});

	function testMe(layoutName) {
		if (layoutName == "fitRows") {
			$('.desc').hide();
			$('.novus').css('width', 150);
			$('.oneshelf').addClass('shelf');
		} else {
			setTimeout(makeitbigger, 600)


		}
	}
	
				function makeitbigger() {
				$('.desc').delay(0).fadeIn(100, function () {});
				$('.novus').css('width', 600);
				// $('.oneshelf').removeClass('shelf');
			}


    // ----------------------------------------------

});	
	
	
		//$('.desc').hide();

	$(function () {

		$list.isotope({
			layoutMode: 'fitRows',
			masonry: {
				columnWidth: 320,
				columnHeight: 20
			},
			getSortData: {

				related: function ($elem) {
					return $elem.attr('data-related');
				},
				width: function ($elem) {
					return $elem.width();
				}
			}
		});
    
     
 

	});
	   
   	