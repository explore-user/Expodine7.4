// JavaScript Document
$(document).ready(function(){
	
	/*************************************** each click  starts *************************************************  */
	$('.custhistory_eachs').click( function() {  
          
	if ($(this).hasClass('bill_history_active'))
			{
				$(this).removeClass("bill_history_active");
				$('.loadcustdetails').empty();
				$('.load_ta_billdetails').empty();
				$('.load_ta_billeach_det').empty();
                               
			}else
			{
                                $(".refload").load(location.href + " .refload");
				$('.custhistory_eachs').removeClass("bill_history_active");
				$(this).addClass("bill_history_active");
				var cname=$(this).attr('cname');
				var cmob=$(this).attr('cmob');
				var cmode=$(this).attr('mode');
				//alert(cmode);//alert(cmob);
				
				var dataString = 'value=load_ta_custhis_det&name=' + cname + '&mob='+ cmob +'&mode='+ cmode;
				var request= $.ajax({
					  type: "POST",
					  url: "load_ta_cust_history.php",
					  data: dataString,
					  success: function(data) {
						   $('.loadcustdetails').html(data);
						   
						   var dataString1 = 'value=load_ta_bill_det&name=' + cname + '&mob='+ cmob +'&mode='+ cmode;
							var request1= $.ajax({
								  type: "POST",
								  url: "load_ta_cust_history.php",
								  data: dataString1,
								  success: function(data1) {
									  
									   $('.load_ta_billdetails').html(data1);
									   
									   
									 
									  
								  }
							   });
						   
						   
						   
						   
						  
					  }
				   });
				  data = null;
				  dataString = null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;	
				  
				  data1 = null;
				  dataString1 = null;
				  request1.onreadystatechange = null;
				  request1.abort = null;
				  request1 = null;
				  
				  
				return false;
			}
	
	});
	
	/*************************************** each click  ends *************************************************  */
	
	
	
	
	});
