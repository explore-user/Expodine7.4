// JavaScript Document
$(document).ready(function(){
	
	/*************************************** category selection  starts *************************************************  */
	$('.staff_ass_left_detail_main_select').click(function (event) {//load_counter_sales.php
           event.stopImmediatePropagation(); 
//           $('.staff_sign_right_staff_name_box').removeClass('staff_sign_right_staff_name_box_act');
        if($(this).hasClass('staff_ass_left_detail_cc_act'))
		{
                    $(this).removeClass('staff_ass_left_detail_cc_act');
		}else
		{
                    $(this).addClass('staff_ass_left_detail_cc_act');	
		}
		var itemsact = $('.staff_ass_left_detail_cc_act');	
	var actlenght=(itemsact.length);
	
	var totalleng = $('.staff_ass_left_detail_main_select');	
	var totalct=(totalleng.length);
	if(totalct==actlenght)
	{
		$("input:checkbox").prop("checked", true);
	}else
	{
		$("input:checkbox").prop("checked", false);
	}
	
	});	
	/*************************************** Sub category selection  ends *************************************************  */
     
        //load popup starts
        $(".staff_order_detail_pop").click(function(event){
            event.stopImmediatePropagation();
//            $(this).addClass('staff_detail_bill_no_act')
            $(".staff_asign__odr_details_pop").css("display","block");
            $(".confrmation_overlay").css("display","block");
            var billno = $(this).attr('billno');
            //alert(billno);
            var dataString = 'value=load_popup&billno='+billno ;
            $.ajax({
                type: "POST",
                url: "load_staff_assign.php",
                data: dataString,
                success: function(data) {
                    $('#bill_details_popup').html(data);
                }
            });
        });
        //load popup end
        //popup close starts
        $("#time_pop_close").click(function(){
		$(".staff_ass_confirm_pop_time_cc").css("display","none");
		$(".confrmation_overlay").css("display","none");
	});
	////popup close ends
        
        
});