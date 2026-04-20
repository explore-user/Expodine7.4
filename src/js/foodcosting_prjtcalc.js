// JavaScript Document
$(document).ready(function(){
    /***************************************** sel  pp change starts **********************************************************  */
	$('#sellpp').change(function () { 
	 var sellpp			=parseFloat($('#sellpp').val());
	 var pc_cost	=parseFloat($('#pc_cost').val());
	 var total='';
	 if(sellpp!='' && sellpp!='0.00')
	 {
	 if(!isNaN(sellpp))
	  {
		 total= (((sellpp *  pc_cost) /100) + pc_cost);
		 $('#basedpccost').val(total.toFixed(2))
	  }else
	  {
		  $("#errortotally").css("display","block");
		  $("#errortotally").text("Check Sell PP");
		  $("#errortotally").delay(2000).fadeOut('slow');
	  }
	 }
	});
	/***************************************  sel  pp change  ends *************************************************************  */
	
	/***************************************** sel  pp save starts **********************************************************  */
	$('.sellppsave').click(function () { 
	 var sellpp			=($('#sellpp').val());
	 var basedpccost	=parseFloat($('#basedpccost').val());
	 var menuidselected	=	$('#menuidselected').val();
	// alert(sellpp+basedpccost)
	 if(!isNaN(sellpp) && sellpp!='')
	  {
		  var data = {
			  "value"				: "submitsellpp",
			  "menuidselected"	    : menuidselected,
			  "sellpp"				: sellpp,
			  "basedpccost"			: basedpccost
			};
			 $.ajax({
				type: "POST",
				url: "load_foodcosting.php",
				data: data,
				success: function(msg)
				{//alert(msg.trim());
					msg=msg.trim();//alert(msg);
					if(msg=="added")
					{
						  $('.projectcaltotal').load('load_foodcosting.php?value=projectcalculator&menuid='+menuidselected); 
						  
						  $("#errortotally").css("display","block");
						  $("#errortotally").text("Sell PP Added");
						  $("#errortotally").delay(2000).fadeOut('slow');
					
					}else
					{
						$('.projectcaltotal').load('load_foodcosting.php?value=projectcalculator&menuid='+menuidselected); 
						  
						  $("#errortotally").css("display","block");
						  $("#errortotally").text("Sell PP Updated");
						  $("#errortotally").delay(2000).fadeOut('slow');
					
					}
					
				}
			});
		 
	  }else
	  {
		  $("#errortotally").css("display","block");
		  $("#errortotally").text("Add Sell PP");
		  $("#errortotally").delay(2000).fadeOut('slow');
	  }
	});
	/***************************************  sel  pp save  ends *************************************************************  */
	
}); 