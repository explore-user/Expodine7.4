// JavaScript Document
$(document).ready(function(){
	
	/***************************************** cancel button click starts ******************************************************************  */
 	$('#cancelbill').click(function () {
          
        
                $('.kotconfirmpopup_reprint_hisory').css('display','none');   
                
               $(".confrmation_overlay").css("display","none");
     
        
            $('#reasontext').show();
         $('#rsntxt').css('display','block');
         $('#authcodersn').css('display','block');
           $('#rprntmode').val('');
            var billhistorymsg2 = ($("#billhistorymsg2").val());
      if($('.bill_history_number').hasClass('bill_history_active'))
	  {
                 var split_chk=$('.bill_history_active').attr("split_check");
                  var cancel_key=$('.bill_history_active').attr("cancelkey");
                if(cancel_key!="Cancelled" && cancel_key!="Cancelled for Split"){
           
                    if(split_chk=="N"){
		  $('.closeoneclass').css('display','block');
		  $('.confrmation_overlay').css('display','block');
              }else{
         $(".loaderror").css("display","block");
	  $(".loaderror").addClass("billgenration_validate");
	  $(".loaderror").text("Spliited Bill Cant be cancelled");
	  $(".loaderror").delay(2000).fadeOut('slow');
              }
                  
              }else{
                    $(".loaderror").css("display","block");
	  $(".loaderror").addClass("billgenration_validate");
	  $(".loaderror").text("Already Cancelled !");
	  $(".loaderror").delay(2000).fadeOut('slow');
              }	 
	  }else
	  {
	  $(".loaderror").css("display","block");
	  $(".loaderror").addClass("billgenration_validate");
	  $(".loaderror").text(billhistorymsg2);
	  $(".loaderror").delay(2000).fadeOut('slow');
	  }
   
   }); 

   /*************************************** cancel button click ends ******************************************************************  */
   
   
});