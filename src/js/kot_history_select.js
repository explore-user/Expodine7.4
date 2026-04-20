// JavaScript Document
$(document).ready(function(){

	/*************************************** Confirm starts *************************************************  */
	$(".kot_history_number").click(function(){ 
	var kotno       =  $(this).attr("kotno");
	var status       =  $(this).attr("status");
	var dateval= $('#datepicker').val();
	var res = dateval.split("-");
	var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	 $('.kot_history_number').removeClass('tr_bill_gen_active');
	  $(this).addClass('tr_bill_gen_active');
	 var request = $.ajax({
			type: "POST",
			url: "load_kothistory.php",
			data: "value=loadkotdetails&dateval="+dateset+"&kotno="+kotno,
			success: function(msg)
			{
			
				$('#loadkotdeatils').html(msg);
                                
                                $('#printkot').css("display","block");
                                
				//if(status!='Closed' && status!='Billed' )
//				{
//					$('#printkot').css("display","block");
//				}else
//				{
//					$('#printkot').css("display","none");
//				}
			   
			}
		});  
	 	data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
	 
	
		});	
	/***************************************  Confirm ends *************************************************  */
	
});
