// JavaScript Document
$(document).ready(function(){
	
	
	
	
	/*****************************************  sort starts ******************************************************************  */
	 $('.sortbybill').click(function (e) {
              //alert("dbgb");
		 e.preventDefault();
		 
		 var flr_id=	$('#areachnage').val();	
		var selected_activities =$('.tr_bill_gen_active');
		var billno = new Array(); 
		var tableid = new Array();
		var prefid = new Array();
		selected_activities.each(function(){
			  var id_str       =  $(this).attr("billno");
				if(id_str!='undefined' && id_str!='' && id_str!=null){
					billno.push(id_str);
				}
		}); 
		billno=unique(billno)
		  
		if($('.sortbybill').hasClass('sortbydesc'))
		{//alert("sortbydesc")
			$('.sortbybill').removeClass('sortbydesc');
			$(this).addClass('sortbyasc');
			
			$.post("load_paymentpending.php", {floorid:flr_id,bilno:billno[0],order:"asc",set:'loadbilldetails'},
			function(data)
			{
			data=$.trim(data);
			$('#load_billfullist').html(data);		  
			});
  
			e.stopPropagation();
			return false;
			
		}else  if($('.sortbybill').hasClass('sortbyasc'))
		{//alert("sortbyasc")
			$('.sortbybill').removeClass('sortbyasc');
			$(this).addClass('sortbydesc');
			$.post("load_paymentpending.php", {floorid:flr_id,bilno:billno[0],order:"desc",set:'loadbilldetails'},
			function(data)
			{
			data=$.trim(data);
			$('#load_billfullist').html(data);		  
			});
			
			e.stopPropagation();
			return false;
			
		}else
		{//alert("else")
			$(this).addClass('sortbyasc');
			$.post("load_paymentpending.php", {floorid:flr_id,bilno:billno[0],order:"asc",set:'loadbilldetails'},
			function(data)
			{
			data=$.trim(data);
			$('#load_billfullist').html(data);		  
			});

			e.stopPropagation();
			return false;
		}
		
		
	
	});
	/*****************************************  sort ends ******************************************************************  */
	
	}); 