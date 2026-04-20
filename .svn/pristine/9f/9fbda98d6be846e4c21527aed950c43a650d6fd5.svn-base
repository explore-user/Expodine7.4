// JavaScript Document
$(document).ready(function(){
 
    
// window.onload = function() {
//     $('#verifycompletedorder123').hide();
//$('.clickeachrowcompld:first').addClass('tr_bill_gen_active');
//$('.verifycompletedorder').click();
// }
/*************************************  floor selection starts **********************************************************  */
    $('.clickeachrowcompld').click(function () {
      
		 if($(this).hasClass('tr_bill_gen_active'))
		 {
			var id_str       =  $(this).attr("ordno");
			$('.loadcancel').css("display","none");
			$('.loadtotal').css("display","none");
			$('#listwholedetailslist').empty();
			$('.loadproceedbutton').css("display","none");
                        $('#billname').css('display','none');
                        $('#billnum').css('display','none');
                        $('#billgst').css('display','none');
                        var n = $( ".tr_bill_gen_active" ).length-1;
                        $( ".selectedtables" ).text( "No of Selected Table (" + n + ")");
			$('.clickeachrowcompld').filter('[ordno="'+id_str+'"]').removeClass('tr_bill_gen_active');
		 }else
		 {
			$('.loadcancel').css("display","none");
			$('.loadtotal').css("display","none");
			$('#listwholedetailslist').empty();
			$('.loadproceedbutton').css("display","none");
                        $('#billname').css('display','block');
                        $('#billnum').css('display','block');
                        $('#billgst').css('display','block');
			var id_str       =  $(this).attr("ordno");
                        if(document.getElementById('button1').disabled  == true){
                            $('.clickeachrowcompld').filter('[ordno="'+id_str+'"]').addClass('tr_bill_gen_active');
                            var n = $( ".tr_bill_gen_active" ).length;
                            $( ".selectedtables" ).text( "No of Selected Table (" + n + ")");
                        }else{
                            $('.clickeachrowcompld').removeClass('tr_bill_gen_active'); 
                            $('.clickeachrowcompld').filter('[ordno="'+id_str+'"]').addClass('tr_bill_gen_active');
                            $(".tr_bill_gen_active").parent('.clickeachrowcompld').remove();
                         
                    }
             }
	    
    });

    $('.camp').click(function(){
       $(".no_of_table").css("display","block");
//       var n = $( ".tr_bill_gen_active" ).length;
       $( ".selectedtables" ).text( "No of Selected Table (" + 0 + ")");
       $('.clickeachrowcompld').removeClass('tr_bill_gen_active'); 
       $(".camp1").css("display","block");
       $(".camp").css("display","none");

    });

    $('.camp1').click(function(){
       $(".no_of_table").css("display","none");
//       var n = $( ".tr_bill_gen_active" ).length;
       $( ".selectedtables" ).text( "No of Selected Table (" + 0 + ")");
       $('.clickeachrowcompld').removeClass('tr_bill_gen_active');
       $(".camp").css("display","block");
       $(".camp1").css("display","none");
   
      });
      
      $('.campaign').click(function(){
           
        $(".camp1").css("display","none");
        $(".camp").css("display","block");
        $(".no_of_table").css("display","none");
        document.getElementById("button2").disabled = true;
        document.getElementById("button1").disabled = false;
        
      });

}); 

    function enableButton1() {
        document.getElementById("button2").disabled = false;
        document.getElementById("button1").disabled = true;
    }


    function enableButton2() {
        document.getElementById("button2").disabled = true;
        document.getElementById("button1").disabled = false;
         $('.listorderlist').load("load_completedorder.php?set=loadbillwholelist_co&ordno=''");
        $('.deletetablefromlist').click();
    }
