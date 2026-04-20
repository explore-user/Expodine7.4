// JavaScript Document
$(document).ready(function(){
/***************************************** sel  pp change starts **********************************************************  */
	$('.setservingcount').click(function () { 
	 var menuidselected	=	$('#menuidselected').val();
	 var servingfirst			=parseFloat($('#servingfirst').val());
	 if(!isNaN(servingfirst))
	  {
		  var data = {
			  "value"				: "submitservingcount",
			  "menuidselected"	    : menuidselected,
			  "servingfirst"		: servingfirst
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
						  $('.servingcoutset').load('load_foodcosting.php?value=servingcoutsetcalc&menuid='+menuidselected);
						  
						  $("#errortotally").css("display","block");
						  $("#errortotally").text("Serving Count Added");
						  $("#errortotally").delay(2000).fadeOut('slow');
					
					}else
					{
						$('.servingcoutset').load('load_foodcosting.php?value=servingcoutsetcalc&menuid='+menuidselected);
						  
						  $("#errortotally").css("display","block");
						  $("#errortotally").text("Serving Count Updated");
						  $("#errortotally").delay(2000).fadeOut('slow');
					
					}
					
				}
			});
		 
	  }else
	  {
		  $("#errortotally").css("display","block");
		  $("#errortotally").text("Check Serving Count");
		  $("#errortotally").delay(2000).fadeOut('slow');
	  }
	});
	/***************************************  sel  pp change  ends ******************************************************************  */
	/***************************************** export to pdf starts **********************************************************  */
	  $('.exporttopdf').click(function () { 
	    var exportingnos	=	$('#exportingnos').val();
	   var letterNumber = /^[1-9]+$/;  
	   if(exportingnos!='' )
	  {
		  if(($('#exportingnos').val().match(letterNumber)) )
		  {
				var check = confirm("Are you sure you want to create pdf?");
				if(check==true)
				{
					 var menuidselected	=	$('#menuidselected').val();
					//window.location="load_foodcosting.php?value=exporttopdf&menuid="+menuidselected+"&exportingnos="+exportingnos;
					window.open("print_foodcosting.php?value=exporttopdf&menuid="+menuidselected+"&exportingnos="+exportingnos, '_blank');			
				}
		  }else
		  {
			  $("#errortotally").css("display","block");
			  $("#errortotally").text("Check Export Numbers");
			  $("#errortotally").delay(2000).fadeOut('slow');
		  }
	  }
	
	 });
	/***************************************  export to pdf ends ******************************************************************  */
	
	/***************************************** export to excel starts **********************************************************  */
	  $('.exporttoexcel').click(function () { 
	  
	  var exportingnos	=	$('#exportingnos').val();
	   var letterNumber = /^[1-9]+$/;  
	   if(exportingnos!='' )
	  {
		  if(($('#exportingnos').val().match(letterNumber)) )
		  {
				var check = confirm("Are you sure you want to create excel?");
				if(check==true)
				{
					 var menuidselected	=	$('#menuidselected').val();
					window.location="load_foodcosting.php?value=exporttoexcel&menuid="+menuidselected+"&exportingnos="+exportingnos;			
				}
		  }else
		  {
			  $("#errortotally").css("display","block");
			  $("#errortotally").text("Check Export Numbers");
			  $("#errortotally").delay(2000).fadeOut('slow');
		  }
	  }
	 });
	/***************************************  export to excel ends ******************************************************************  */
}); 
