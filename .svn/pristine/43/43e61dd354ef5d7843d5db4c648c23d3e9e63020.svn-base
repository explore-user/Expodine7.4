jQuery(document).ready(function($){
	//open the lateral panel
	$('.cd-btn').on('click', function(event){
		event.preventDefault();
		$('.cd-panel').addClass('is-visible');
	});
	//clode the lateral panel
	$('.cd-panel').on('click', function(event){
		if( $(event.target).is('.cd-panel') || $(event.target).is('.cd-panel-close') ) { 
			$('.cd-panel').removeClass('is-visible');
			event.preventDefault();
		}
	});
	
	$('.menu_order_dish_name').on('click', function(event){
		
			
		if(	$('#disable').hasClass('disable_cls'))
		{
			//alert("hs");.
			/*$('.cd-panel').addClass('is-visible');//panel visible
			$('#disable').removeClass('disable_cls');
			$('#disable1').removeClass('disable_cls1');
			$('#disable2').removeClass('disable_cls');*/
		}else
		{
			//alert("no");
			/*$('.cd-panel').removeClass('is-visible'); //panel invisible
			$('#disable').addClass('disable_cls');
			$('#disable1').addClass('disable_cls1');
			$('#disable2').addClass('disable_cls');
			*/
		}
	});
	
});