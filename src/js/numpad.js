/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
    
    
     $('#pin_pay').keypress(function(ev){
             if(ev.keyCode == 13){
             ev.stopImmediatePropagation();
             $('.pin_pay_auth').trigger('click');
            }
   });
    
    
$('.calculator_settle').click( function(event) {
      
		
                
        if( $('.complimentrary_cc').css('display') == 'block'){
          
         $('#focusedtext').val('pin_pay'); 
     }
      else  if( $('.paid_amount_cc_credit').css('display') == 'block'){
         $('#focusedtext').val('pin_pay'); 
     }else{
         $('#focusedtext').val('pin');
     }
                
                event.stopImmediatePropagation();
                
                     //alert('focusedtext');
		var focused=$('#focusedtext').val();
               //alert(focused);
		var calval=($(this).text());//alert(focused);alert(calval);
		
		var org=$('#'+focused).val();
                //alert(org.length);
			if(calval>=0)
			{   
                            if(org.length < 4){
				if(org==0)
				{
					 $('#'+focused).val(calval);
				}else if(org>0)
				{
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                            }
//                            
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
			}else if(calval==".")
			{
				$('#'+focused).val(org+".");
			}
			$('#'+focused).change();
		$('#'+focused).focus();
		
		
		
	});
        
        $('.calculator_settle_back').click( function(event) {
            var str =$('#pin').val();
            str = str.substring(0, str.length - 1);
            $('#pin').val(str);
            input.innerHTML=$('#pin').val();
            $('#pin').focus();
        });
        
      $('#kotcancel_reason_popup_new_cancel_btn').click( function(event) {  
           $('.kotcancel_reason_popup_new').css('display','none');
           $('.confrmation_overlay').css('display','none');
           $('.closeoneclass2').css('display','none');
           $('#pin').val('');
           $("#payment_newcancel_confirm_overlay").css("display","none");
           $(".payment_pend_popup").css("display","none");
      });
      
      
       $('#pin').keypress(function(ev){
   
        if(ev.keyCode == 13){
            ev.stopImmediatePropagation();
            $('#kotcancel_reason_popup_new_proceed_btn55').trigger('click');
        }});
        
        
         });
         
         function numonly(evt)
        {
           
        evt = (evt) ? evt : window.event;
           var charCode = (evt.which) ? evt.which : evt.keyCode;
           if (charCode > 31 && (charCode < 48 || charCode > 57)) {

               return false;

           }
           return true;
        }
       
