// JavaScript Document
$(document).ready(function(){

	/*************************************** Confirm starts *************************************************  */
	$(".kot_history_number").click(function(){
	var billno       =  $(this).attr("billno");
        var kot_new       =  $(this).attr("kotno");
	var status       =  $(this).attr("status");
	var dateval= $('#datepicker').val();
	var res = dateval.split("-");
	var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	 $('.kot_history_number').removeClass('tr_bill_gen_active');
	  $(this).addClass('tr_bill_gen_active');
	 var request = $.ajax({
			type: "POST",
			url: "load_takothistory.php",
			data: "value=loadkotdetails&dateval="+dateset+"&billno="+billno+"&kot_new="+kot_new,
			success: function(msg)
			{
			
				$('#loadkotdeatils').html(msg);
				if(status=='Closed')
				{
					$('#printkot').css("display","none");
				}else
				{
					//$('#printkot').css("display","block");
				}
			   
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
