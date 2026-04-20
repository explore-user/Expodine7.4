// JavaScript Document
$(document).ready(function(){

	/*************************************** Take away kot Print starts ************************************************* */ 
	$('.cs_printkoteach').click(function (e) {
            //alert('gu');
		e.preventDefault();
		/*if($(this).parent().find('.takeawaykoteachclick').length>0)
		{*/
			//$(this).parent().find('.takeawaykoteachclick').click();
		/*}else
		{
			$(this).parent().find('.takeawayeachclick').click();
		}*/
		//var bilno=$('#ta_loadtakbill').text();
		//var kotno=$('#ta_loadtakkotl').text();
                var bilno=$(this).attr('billno');
		var kotno=$(this).attr('kotno');
		var dataString; 
		dataString = 'value=ta_kotprint&bilno='+bilno+'&kotno='+kotno;
					 $.ajax({
					type: "POST",
					url: "print_details_kot.php",
					data: dataString,
					success: function(data) {
						var dataString; 
								  dataString = 'value=console_ta&bilno='+bilno+'&kotno='+kotno;
							   $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data2) {
							  }
							  });
						
						$('.new_alert_cc').css('display','block');
						$('.confirm_detail_con_pop').css('display','block');
						$('.confirm_detail_con_pop').html("KOT printed");
						window.location="counter_sale_kot.php";
						}
					});	
		
	  return false;
	
  	});
	/***************************************  Take away kot Print ends *************************************************  */
	/*************************************** Take away bill Print starts ************************************************* */ 
	$('.ta_printbilleach').click(function (e) {
		e.preventDefault();
		/*if($(this).parent().find('.takeawaykoteachclick').length>0)
		{
			$(this).parent().find('.takeawaykoteachclick').click();
		}else
		{*/
			$(this).parent().find('.takeawayeachclick').click();
		//}
		
		var bilno=$('#ta_loadtakbill').text();
		var kotno=$('#ta_loadtakkotl').text();
		var dataString; 
		dataString = 'value=ta_billprint&bilno='+bilno+'&kotno='+kotno;
					 $.ajax({
					type: "POST",
					url: "print_details_kot.php",
					data: dataString,
					success: function(data) { 
						
						$('.new_alert_cc').css('display','block');
						$('.confirm_detail_con_pop').css('display','block');
						$('.confirm_detail_con_pop').html("Bill printed");
						
						}
					});	
		
	  return false;
	
  	});
	/***************************************  Take away bill Print ends *************************************************  */
	
	/*************************************** Take away bill Print HD starts ************************************************* */ 
	$('.ta_printbillhdeach').click(function (e) {
		e.preventDefault();
		/*if($(this).parent().find('.takeawaykoteachclick').length>0)
		{
			$(this).parent().find('.takeawaykoteachclick').click();
		}else
		{*/
			$(this).parent().find('.takeawaykoteachclick_home').click();
		//}
		var bilno=$('#ta_loadtakbill').text();
		var kotno=$('#ta_loadtakkotl').text();
		var dataString; 
		dataString = 'value=ta_billhdprint&bilno='+bilno+'&kotno='+kotno;
					 $.ajax({
					type: "POST",
					url: "print_details_kot.php",
					data: dataString,
					success: function(data) {
						
						$('.new_alert_cc').css('display','block');
						$('.confirm_detail_con_pop').css('display','block');
						$('.confirm_detail_con_pop').html("Bill printed");
						
						}
					});	
		
	  return false;
	
  	});
	/***************************************  Take away bill Print HD ends *************************************************  */


});