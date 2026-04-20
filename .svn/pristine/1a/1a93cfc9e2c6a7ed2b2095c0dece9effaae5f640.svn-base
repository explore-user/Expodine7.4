// JavaScript Document
$(document).ready(function(){
    
//	  var oTable = $(document).ready(function() {
//    var dataTable = $('#autoselecttablepymt').dataTable();
//});
//oTable.find('tbody tr:first').addClass('tr_bill_gen_active'); 
//oTable.find('tbody tr').click(function() {
//    oTable.find('tbody tr').removeClass('tr_bill_gen_active');
//    $(this).addClass('tr_bill_gen_active');
//});
//	$("table .clickeachrowpaymnt:first-child").addClass('tr_bill_gen_active');
window.onload = function() {
  //var tblnolist1=new Array();
  var tblnolist=new Array();
  var billedno=$('#billedno').val();
  //var billedtblno1=(billedno[0]+billedtblno[1]);
  $('.clickeachrowpaymnt').each(function(){ 
     var billnolist1=$(this).attr('billno');
    // billnolist.push(billnolist1);
     if(billnolist1==billedno)
      {
          //alert(tblnolist3[i]);
          $('.clickeachrowpaymnt').removeClass('tr_bill_gen_active');
         $(this).addClass('tr_bill_gen_active');
         var billno = $('.tr_bill_gen_active').attr('billno');
        $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total&billno="+billno);
		 $('.settlethetables').click(); 
	  }
  });
  if($('.clickeachrowpaymnt').hasClass('tr_bill_gen_active'))
  {
      
  }
  else{
          $('.clickeachrowpaymnt:first').addClass('tr_bill_gen_active');
var billno = $('.tr_bill_gen_active').attr('billno');
$('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total&billno="+billno);    
  }

 }
 
	/*************************************  floor selection starts **********************************************************  */
	
	 $('.clickeachrowpaymnt').click(function (event) { //alert("hiii");
             event.stopImmediatePropagation();
             
             $('.clickeachrowpaymnt').removeClass('tr_bill_gen_active');
             $(this).addClass('tr_bill_gen_active');
		

                
		 if($(this).hasClass('tr_bill_gen_active'))
		 {
                     var billno = $('.tr_bill_gen_active').attr('billno');
                     //alert( $('#totamnt').val());
                     $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total&billno="+billno);
                      
			 //$('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
			 //$('#payemntmode_sel').find('option:first').attr('selected', 'selected');
			 $('#payemntmode_sel option').first().prop('selected', true);
			 $('.paymentclose').css("display","none");
			 $('.paid_amount_cc').css("display","none");
			 $('.paid_amount_cc_credit').css("display","none");
			// $('#paidamount_credit').css("display","none");
			 // $('#balanceamout_credit').css("display","none");	
			//var id_str       =  $(this).attr("billno");
			//$('.clickeachrowpaymnt').filter('[billno="'+id_str+'"]').removeClass('tr_bill_gen_active');
			$(".cash_cc").hide();
			$(".credit_cc_normal").hide();
			$(".credit_cc").hide();
			$(".coupon_cc").hide();
			$(".voucher_cc").hide();
			$(".cheque_cc").hide();
			$(".auto1").hide();
			$(".auto").hide();
			$('#amount_credit').val('');
			$('#selectcreditypes').find('option:first').attr('selected', 'selected');
			$('#selectcreditdetails').find('option:first').attr('selected', 'selected');
			//$('#payemntmode_sel').find('option:first').attr('selected', 'selected');
		 }else
		 {
			 $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
			// $('#payemntmode_sel').find('option:first').attr('selected', 'selected');
			$('#payemntmode_sel option').first().prop('selected', true);
			 $('.paymentclose').css("display","none");	
			 $('.paid_amount_cc').css("display","none");
			 $('.paid_amount_cc_credit').css("display","none");
			  var id_str       =  $(this).attr("billno");
			  $('.clickeachrowpaymnt').removeClass('tr_bill_gen_active');
			  $('.clickeachrowpaymnt').filter('[billno="'+id_str+'"]').addClass('tr_bill_gen_active');
			  
			   var regn       =  $(this).attr("regen");
			   if(regn=='N')
			   {
				   $('.regenratethetables').css("display","none");	
				    $('.bilsplitthetables').css("display","none");	
			   }else
			   {
				   $('.regenratethetables').css("display","block");	
				   if($('#namesplitview').val()=="Y")
				   {
				    $('.bilsplitthetables').css("display","block");	
				   }
			   }
			  $(".cash_cc").hide();
			  $(".credit_cc_normal").hide();
			  $(".credit_cc").hide();
			  $(".coupon_cc").hide();
			  $(".voucher_cc").hide();
			  $(".cheque_cc").hide();
			  $(".auto1").hide();
			  $(".auto").hide();
			  $('#amount_credit').val('');
			  $('#selectcreditypes').find('option:first').attr('selected', 'selected');
			$('#selectcreditdetails').find('option:first').attr('selected', 'selected');
			
			 // $('#paidamount_credit').css("display","none");
			 // $('#balanceamout_credit').css("display","none");
						
		 }
		
	    
	});
			  
	/***************************************  floor selection ends **********************************************************  */
	
	
	}); 
       