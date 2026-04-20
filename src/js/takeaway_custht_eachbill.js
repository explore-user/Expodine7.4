// JavaScript Document
$(document).ready(function(){
	
	/*************************************** each click  starts *************************************************  */
	$('.eachbilno_click').click( function() {  
	if ($(this).hasClass('bill_history_active'))
			{
				$(this).removeClass("bill_history_active");
				if ($('.eachbilno_click').hasClass('bill_history_active'))
				{
					var selected_activities =$('.bill_history_active');
					var bilno = new Array();
					selected_activities.each(function(){
						var selval       =  $(this).attr("bilno");
						
							if(selval!='undefined' && selval!='' && selval!=null){
								bilno.push(selval);
							}
					
					});
					 var dataString2 = 'value=load_ta_billeach&bilno=' + bilno;
				   var request2= $.ajax({
						type: "POST",
						url: "load_ta_cust_history.php",
						data: dataString2,
						success: function(data2) {
							
							 $('.load_ta_billeach_det').html(data2);
							
						}
					 });
					   
			      data2 = null;
				  dataString2 = null;
				  request2.onreadystatechange = null;
				  request2.abort = null;
				  request2 = null;
				
				}else
				{
					$('.load_ta_billeach_det').empty();
				}
			}else
			{
				//$('.eachbilno_click').removeClass("bill_history_active");
				$(this).addClass("bill_history_active");
				var selected_activities =$('.bill_history_active');
				var bilno = new Array();
				selected_activities.each(function(){
					var selval       =  $(this).attr("bilno");
					
						if(selval!='undefined' && selval!='' && selval!=null){
							bilno.push(selval);
						}
				
				});
				//var bilno=$(this).attr('bilno');
				//alert(bilno);
				  var dataString2 = 'value=load_ta_billeach&bilno=' + bilno;
				   var request2= $.ajax({
						type: "POST",
						url: "load_ta_cust_history.php",
						data: dataString2,
						success: function(data2) {
							
							 $('.load_ta_billeach_det').html(data2);
							
						}
					 });
					   
			      data2 = null;
				  dataString2 = null;
				  request2.onreadystatechange = null;
				  request2.abort = null;
				  request2 = null;
			}
	});
	
	/*************************************** each click  ends *************************************************  */
	
	
	
	
	});
