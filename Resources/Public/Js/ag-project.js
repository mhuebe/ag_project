

jQuery(function(){
	/*jQuery(".portfolio-grid .btn-porto").click(function(){
		jQuery(".portfolio-grid .btn-porto").removeClass('btn-primary').addClass('btn-default');
		jQuery(this).addClass('btn-primary').removeClass('btn-default');
		var _data_target = jQuery(this).attr('data-tg');			
		if(_data_target == 'all'){
			jQuery(".product-listing").fadeIn();
		}else{
			jQuery(".product-listing").fadeOut();
		}	
		jQuery(".product-listing").each(function(){
			var _data_tar = jQuery(this).attr('data-show');
			if(_data_tar.indexOf(_data_target) != -1){
			   jQuery(this).fadeIn();
			}
		});
	});*/

	$(".portfolio-grid .btn-porto").click(function(){
		$(".portfolio-grid .btn-porto").removeClass('btn-default').addClass('btn-small');
		$(this).addClass('btn-default').removeClass('btn-small');
		var _data_target = $(this).attr('data-tg');			
		if(_data_target == 'all'){
			$(".product-listing").fadeIn();
		}else{
			$(".product-listing").fadeOut();
		}	
		$(".product-listing").each(function(){
			var _data_tar = $(this).attr('data-show');
			if(_data_tar.indexOf(_data_target) != -1){
			    $(this).fadeIn();
			}
		});
	});
	
	// Magnific popup
	jQuery('.tx-ag-project .zoom-gallery .item').magnificPopup({
	  delegate: 'a',
	  type: 'image',
	  closeOnContentClick: false,
	  closeBtnInside: false,
	  mainClass: 'mfp-with-zoom mfp-img-mobile',
	  image: {
	    verticalFit: true,
	    titleSrc: function(item) {
	      return item.el.attr('title');
	    }
	  },
	  gallery: {
	    enabled: true
	  },
	  zoom: {
	    enabled: true,
	    duration: 300, // don't foget to change the duration also in CSS
	    opener: function(element) {
	      return element.find('img');
	    }
	  }
	  
	});

    // remove for maintain layout.. need not for other site.
	jQuery(".main-container").removeClass('col-xs-push-2');

	
});

