// JavaScript Document
$(document).ready(function(){
	
	 /***************************************** reprint starts ******************************************************************  */
         
         $('.confirmkotok_reprint_history').click(function () {
             $('.kotconfirmpopup_reprint_hisory').css('display','none');   
            
               $(".confrmation_overlay").css("display","none");
               
               
                $('#rprntmode').val('rprnt');
         $('#reasontext').hide();
         $('#rsntxt').css('display','none');
         $('#authcodersn').css('display','none');
      if($('.bill_history_number').hasClass('bill_history_active'))
	  {
                                        var cancel_key=$('.bill_history_active').attr("cancelkey");
                                        if(cancel_key!="Cancelled" && cancel_key!="Cancelled for Split"){
                                            
                    //---------
                    var rprnt_auth = $('#reprint_with_permission').val();
                    if(rprnt_auth == 'Y'){
                       // alert('perm');
                        var auth =$('#authorise_with_code').val();
                        if(auth!='Y'){
                            $('.closeoneclass3').css('display','block');
                            $('.confrmation_overlay').css('display','block');
                        }else{
                           
                            $('.kotcancel_reason_popup_new').css('display','block');
                            $('.confrmation_overlay').css('display','block');
                              $('#pin').focus();
                        }
                    }else{
                        
		 var hidbilprint= $('#hidbilprint').val();
		  var billno       =  $('.bill_history_active').attr("billno");
		  $.post("print_details.php", {bilno:billno,set:'billprint'},
			  function(data)
			  {
			  data=$.trim(data);
			  $(".loaderror").css("display","block");
			  $(".loaderror").addClass("billgenration_validate");
			  $(".loaderror").text(hidbilprint);
			  $(".loaderror").delay(2000).fadeOut('slow');
			  });
			  $.post("load_bill_history.php", {billno:billno,set:'billdetailsset1'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	$('#detailsset1').html(data);
				  });
                                  
                    }
                                  //-----------
                              }else
                              {
                                    $(".loaderror").css("display","block");
	  $(".loaderror").addClass("billgenration_validate");
	  $(".loaderror").text("Reprint Not Possible");
	  $(".loaderror").delay(2000).fadeOut('slow');
                              }
	  }else
	  { var hidnothngtoprint= $('#hidnothngtoprint').val();
	  //alert("sorry");
	  $(".loaderror").css("display","block");
	  $(".loaderror").addClass("billgenration_validate");
	  $(".loaderror").text(hidnothngtoprint);
	  $(".loaderror").delay(2000).fadeOut('slow');
	  }
         });
                   
          $('.confirmkotclose_reprint_history').click(function () {
             $('.kotconfirmpopup_reprint_hisory').css('display','none');   
             
               $(".confrmation_overlay").css("display","none");
         }); 
         
         
        /////bill reprint click starts///// 
 	$('#reprintbill').click(function () {
           $('#pin').val('');
            var floor=$('#floorid_new').val();
           
            var KOT_print = "Bill_reprint";
            //------------
            $.post("printercheck_1.php", {type:KOT_print,floor:floor},
                                               
            function(data)
            { 
            data=$.trim(data); 
           
           
            if(data !=0)
            { 
                                            
              $('.kotconfirmpopup_reprint_hisory').css('display','block');   
              $('#kotfailmsg_reprint_history').html(data);
               $(".confrmation_overlay").css("display","block");
                                  
                                                           
            }else{ 
            
   
         $('#rprntmode').val('rprnt');
         $('#reasontext').hide();
         $('#rsntxt').css('display','none');
         $('#authcodersn').css('display','none');
       if($('.bill_history_number').hasClass('bill_history_active'))
	  {
                                        var cancel_key=$('.bill_history_active').attr("cancelkey");
                                        if(cancel_key!="Cancelled" && cancel_key!="Cancelled for Split"){
                                            
                    //---------
                    var rprnt_auth = $('#reprint_with_permission').val();
                    if(rprnt_auth == 'Y'){
                       // alert('perm');
                        var auth =$('#authorise_with_code').val();
                        if(auth!='Y'){
                            $('.closeoneclass3').css('display','block');
                            $('.confrmation_overlay').css('display','block');
                        }else{
                           
                            $('.kotcancel_reason_popup_new').css('display','block');
                            $('.confrmation_overlay').css('display','block');
                              $('#pin').focus();
                        }
                    }else{
                        
		 var hidbilprint= $('#hidbilprint').val();
		  var billno       =  $('.bill_history_active').attr("billno");
                  
                   var dataString_log ='set_log_reprint_bill=log_reprint_bill&billno_reprint='+billno;
                            $.ajax({
                            type: "POST",
                            url: "printercheck_1.php",
                            data: dataString_log,
                            success: function(data) {

                            }
                            });
                  
                  
                  
                  
		  $.post("print_details.php", {bilno:billno,set:'billprint'},
			  function(data)
			  {
			  data=$.trim(data);
			  $(".loaderror").css("display","block");
			  $(".loaderror").addClass("billgenration_validate");
			  $(".loaderror").text(hidbilprint);
			  $(".loaderror").delay(2000).fadeOut('slow');
			  });
			  $.post("load_bill_history.php", {billno:billno,set:'billdetailsset1'},
				  function(data)
				  {
				  	data=$.trim(data);
				  	$('#detailsset1').html(data);
				  });
                                  
                    }
                                  //-----------
                              }else
                              {
                                    $(".loaderror").css("display","block");
	  $(".loaderror").addClass("billgenration_validate");
	  $(".loaderror").text("Reprint Not Possible");
	  $(".loaderror").delay(2000).fadeOut('slow');
                              }
	  }else
	  { var hidnothngtoprint= $('#hidnothngtoprint').val();
	  //alert("sorry");
	  $(".loaderror").css("display","block");
	  $(".loaderror").addClass("billgenration_validate");
	  $(".loaderror").text(hidnothngtoprint);
	  $(".loaderror").delay(2000).fadeOut('slow');
	  }
      }
  });
   
   }); 

   /*************************************** reprint ends ******************************************************************  */
   
   
});