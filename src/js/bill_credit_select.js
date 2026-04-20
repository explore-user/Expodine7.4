// JavaScript Document
$(document).ready(function(){

	/*************************************  floor selection starts **********************************************************  */
	$('.clickeachcredit').click(function () {	
            
	var id_str       =  $(this).attr("crdit");
	$('.clickeachcredit').removeClass('tr_bill_gen_active');
	$(this).addClass('tr_bill_gen_active');
        
        $('.loadpay').attr("credino",id_str);
	
	$.post("load_credit.php", {id:id_str,set:'loadbilldetails'},
				function(datas)
				{
				datas=$.trim(datas);
				$('.loadeachcreditbildetails').html(datas)
				$('#payemntmode_sel').find('option:first').attr('selected', 'selected');
                                $('.loadpay').html('0');
                                $('.viewpayment').css("display","none");
				 
				}); 
				
	
	
	});
	/*****************************************  voucher ends ******************************************************************  */
});  
