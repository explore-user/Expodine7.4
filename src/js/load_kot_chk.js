// JavaScript Document

$(document).ready(function() {
	
	/*****************************************  Select each kot starts ******************************************************************  */
	 $('.each_order_sel').click(function () {
			var orderid_chek   =  $(this).attr("myorder");
			var orderid_arr	  =	 orderid_chek.split("_");
			var orderid       =  orderid_arr[1];
			var kotid_chek   =  $(this).attr("mykot");
			var kotid_arr	  =	 kotid_chek.split("_");
			var kotid       =  kotid_arr[1];
			$('#order_number_view').text("-"+kotid);
			var floorid       =  $('#setfloor_'+orderid).text();
			$('#floor_number_view').text("-"+floorid);
			var tableid       =  $('#settable_'+orderid).text();
			$('#tablenumber_view').text("-"+tableid);
			$('.each_order_sel').find('.kot_list_item').removeClass('order_active');
			$(this).find('.myid'+orderid).addClass('order_active');
			$.post("load_div.php", {kot:kotid,set:'setmykot'},
			function(data)
				{
				data=$.trim(data);
				$('#setallkot').html(data);									  
				});	
			 });
	/*****************************************  Select each kot ends ******************************************************************  */
	
	});