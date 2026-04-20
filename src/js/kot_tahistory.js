// JavaScript Document
$(document).ready(function(){

	/*************************************** Confirm starts *************************************************  */
	$("#printkot").click(function(){ 
	if($(".kot_history_number").hasClass('tr_bill_gen_active'))
	{
	var hidkotprinted=$('#hidkotprinted').val();
			var kotno       = $(".tr_bill_gen_active").attr("kotno");//alert(kotno)
			 $.post("print_details.php", {kot:kotno,set:'kotprint',check:'kotmissed'},
			  function(data1)
			  {
			  data1=$.trim(data1);
			  $(".loaderror").css("display","block");
		  $(".loaderror").addClass("popup_validate");
		  $(".loaderror").text(hidkotprinted);
		  $('.loaderror').delay(2000).fadeOut('slow');
			  //alert(data1)
			  });
	}else
	{
		 $(".loaderror").css("display","block");
		  $(".loaderror").addClass("popup_validate");
		  $(".loaderror").text("Select KOT");
		  $('.loaderror').delay(2000).fadeOut('slow');
	}
	
		});	
	/***************************************  Confirm ends *************************************************  */
	/***************************************  KOT refresh   starts ******************************************************************  */
	
		 $('#refreshkot').click(function () {
		  $.post("autoload_menu.php", {set:'korprintrefresh'},
			  function(data)
			  {
				  data=$.trim(data);
				  
				  var kot=data.split(',');
				  var legth=kot.length;
				  for(var i=0;i<legth;i++)
				  {
				  var kt=kot[i];
				  $.post("print_details.php", {kot:kt,set:'kotprint',check:'kotmissed'},
					  function(data1)
					  {
					  data1=$.trim(data1);
					  
					  });	
			  }
			  });	
		}); 
	
	
	/***************************************   KOT refresh ends ******************************************************************  */
	
});
function searchkot_history(mode)
{ 
	var dateval= $('#datepicker').val();
	var res = dateval.split("-");
	var dateset=res[2] +"-"+ res[1] +"-"+ res[0] ;
	 
	 var kotno= $('#kotno').val();
	 var bilno= $('#bilno').val();
	 var statuss= $('#statuss').val();
	 //var bilsts= $('#bilsts').val();
	 
	 if(kotno=="")
	 {
		 kotno=null;
	 }
	 if(bilno=="")
	 {
		 bilno=null;
	 }
	 if(statuss=="null")
	 {
		 statuss=null;
	 }
//	 if(bilsts=="null")
//	 {
//		 bilsts=null;
//	 }
	 
	  var request = $.ajax({
			type: "POST",
			url: "load_takothistory.php",
			data: "value=searchkothistory&dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss+"&mode="+mode,
			success: function(msg)
			{
			
				$('#kotlisttotal').html(msg);
				$('#loadkotdeatils').empty();
			   
			}
		});  
	 data=null;
		response=null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
	 
	 
	 
}

