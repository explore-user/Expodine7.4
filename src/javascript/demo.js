$(document).ready(function() {
	
	//Initialize variable
	item 			= $('.item a');
	itemReverse	= item.get().reverse();
	
	//Arrow up clicked
	$('#arrow-up').on('click', function() { //active_class
		$("#load_tables *").attr('disabled', 'disabled');
		//$('#load_tables a').off('click');
		$("#load_tables a").unbind("click");
		//$('#load_tables a').click(function(event) { event.preventDefault();return false; }); 
		$('.dock').addClass('dock-show');
		//$('body').addClass('active_class');
		$('#arrow').hide();
		
		$.each(item, function() {
			
			var i 	 = $(this).index();
			var delay = i * 100;

			window.setTimeout(function (index) {
				return function () {
					item.eq(index).stop().animate({ 'top' : '-8.1em' });
				};
			} (i), delay);
		});
	});
	
	//Arrow down clicked
	$('#arrow-down').on('click', function() {
		$("#load_tables *").removeAttr('disabled');
		$('#load_tables a').click(function(event) { $(this).toggleClass('table_select'); }); 
		//$("#load_tables a").bind("click");
		$('.dock').removeClass('dock-show');
		//$('body').removeClass('active_class');
		$('#arrow').show();
		
		$.each(itemReverse, function() {
			
			var i 	 = $(this).index();
			var delay = i * 100;

			window.setTimeout(function (index) {
				return function () {
					$(itemReverse).eq(index).stop().animate({ 'top' : '0' });
				};
			} (i), delay);
		});
	});
	
	//Item hovered
	//$('.item a').click(function() {
//		$(this).stop().animate({ 'top' : '-6.4em' }, 'fast');
//	}, function() {
//		$(this).stop().animate({ 'top' : '-5.4em' }, 'fast');
//	});
	
});