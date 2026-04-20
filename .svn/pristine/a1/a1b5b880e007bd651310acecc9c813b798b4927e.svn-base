// JavaScript Document
$(document).ready(function(){
	
	
	/*************************************  credit type change starts **********************************************************  */
	
        
                
  $('#all_check_credit').click(function(){

    if($("#all_check_credit").prop('checked') == true){
        
      $('.selectbillsck').each(function(){
        $(this).prop('checked',true);
    
   })
      var tot= $('#tot_click').val();
       $('.grandtotal').html(tot);
    }else{
        $('.selectbillsck').each(function(){
        $(this).prop('checked',false);
        //$('.grandtotal').html('0');
   })
   
    }
     
     
     var countChecked = $('.selectbillsck:checked').length;
     
    if(countChecked>1){
       
      $('.closetranscations5').css('display','block'); 
      $('.closetranscations1').css('display','none'); 
   }else{
      $('.closetranscations1').css('display','block');
      $('.closetranscations5').css('display','none');
       
   }
     
     
});
        
        
        
 $('.selectbillsck').click(function() {
      
    var countChecked = $('.selectbillsck:checked').length;
   
    if(countChecked>1){
       
      $('.closetranscations5').css('display','block'); 
      $('.closetranscations1').css('display','none'); 
    }else{
      $('.closetranscations1').css('display','block');
      $('.closetranscations5').css('display','none');
       
   }
   
   
  });
        
        
	 $('.viewbilpopup').click(function () {
		
		var bilno=$(this).attr('id');
                
                var md1=bilno.charAt(0);
               
		$('.index_popup_confrm').css('display','block');
		$('.confrmation_overlay').css('display','block');
		$('.loadbilnos').html(bilno)
		$('#grandtotal').html('');
                
                if(md1=="D"){
		 $.post("load_credit.php", {bilno:bilno,set:'loadbillcontents'},
			function(data)
			{  //alert(data);
				data=$.trim(data);
				
				
				$('.listbilnodetails').html(data);	
				
			 
			});
			
             }else
             {
                $.post("load_credit.php", {bilno:bilno,set:'loadbillcontentsta'},
			function(data)
			{  //alert(data);
				data=$.trim(data);
				
				
				$('.listbilnodetails').html(data);	
				
			 
			}); 
             }
	});
	
    
    
     $('.viewbilpopup1').click(function () {
		
		var bilno=$(this).attr('id');
		$('.index_popup_confrm').css('display','block');
		$('.confrmation_overlay').css('display','block');
		$('.loadbilnos').html(bilno)
		$('#grandtotal').html('');		
		 $.post("load_credit.php", {bilno:bilno,set:'loadbillcontents'},
			function(data)
			{  alert(data);
				data=$.trim(data);
				
				
				$('.listbilnodetails').html(data);	
				
			 
			});
			
			
	});
	/***************************************  credit type change ends **********************************************************  */
	
	
	
	/*************************************  select bills starts **********************************************************  */
	
	
        
  $("input:checkbox").on('click', function() { 
                
	var count_checked = $("[name='selectbills[]']:checked").length; 
        if(count_checked == 0) 
        {
                        $(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text("Select Bill");
			$(".error_feed").delay(2000).fadeOut('slow');
			$('.loadpay').html('0');
                        $('.viewpayment').css("display","none");
                       
                        $('.bal_pay_crd').text('0');
                        $('.paid_crd_partail').text('0')
                        $('#view_partial').hide();
                          
                        $('.loadpay').attr('billno','');
                       
            
        }else
	{
                    
                    
			var ids=new Array();
			var ratevl=0;
			var selected_activities =$("[name='selectbills[]']:checked");
			selected_activities.each(function(){
			var id_str   =  $(this).attr("bilnos");
                          
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ids.push(id_str);
				  }
                                  
			 var rate_str       =  $(this).attr("rate");
                                 
			  if(rate_str!='undefined' && rate_str!='' && rate_str!=null){
					
				ratevl=parseFloat(ratevl) +  parseFloat(rate_str);
			}  
                        
			});
                        
                      var dec=$('#decimal').val();
                         
                      var bill_in= $(this).attr("bilnos");
                  
                      //if(ids.length==1){
                      
                       $('.loadpay').attr('billno',ids);
                       
                         $('#view_partial').show();
                         
                       
                        var paymode=$("#payemntmode_sel").val() ; 
                     
                        $.post("load_credit.php", {billno:bill_in,set:'load_credit_partail',paymode:paymode,ids:ids},
			function(data)
			{ 
				data=$.trim(data);
				
				$('.paid_crd_partail').html(data);
                                
                                $('.paid_crd_partail').attr('def_paid',data);	
                                
				
			        $('.bal_pay_crd').html((ratevl-data).toFixed(dec)); 
                          
                          
                             // $('#paidamount').val((ratevl-data).toFixed(dec));
			});
                        
                        
//                    }else{
//                        
//                         $('.bal_pay_crd').text('0');
//                         $('.paid_crd_partail').text('0')
//                         $('#view_partial').hide();
//                         $('#paidamount').val('');
//                         $('.loadpay').attr('billno','');
//                         $('#paidamount').focus();
//                    }
                       
			 $('.closetranscations').css("display","none");
			
                         $('#balanceamout').val('0');
                        
                         $('#transcationid').val('');
                         $('#transbal').val('');
                         
                         var dec=$('#decimal').val();
                        
			 $('.loadpay').html(ratevl.toFixed(dec));
                         $('#paidamount').val('');
                       
			 $('.viewpayment').css("display","block");
			
			 $('#payemntmode_sel').val('cash');
                         $('.paid_amount_cc').css("display","block");
                         $('.credit_cc_normal').css("display","none");
                         $('#paidamount').focus(); 
                          
		}
                  
	});
			  
	/***************************************  select bills ends **********************************************************  */
	
	
	
}); 