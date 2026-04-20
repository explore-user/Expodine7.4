// JavaScript Document

$(document).ready(function(){
    $('.staff_sign_right_staff_name_box').click(function (event){
        event.stopImmediatePropagation();
        $('.staff_sign_right_staff_name_box').removeClass('staff_sign_right_staff_name_box_act');
        $(this).addClass('staff_sign_right_staff_name_box_act');
        var staffid = $(this).attr('staffid');
        var selected_orders = $('.staff_ass_left_detail_cc_act');
        var bills = new Array();
        var billno;
        selected_orders.each(function(){
            billno   =  $(this).attr("billno");
            if(billno!='undefined' && billno!='' && billno!=null){
                bills.push(billno);
            }
         });
//         alert(billno);
        if(billno!='undefined' && billno!='' && billno!=null){ 
            var dataString = 'value=staff_assign&bills='+bills+'&staffid='+staffid ;
            $.ajax({
                type: "POST",
                url: "staff_assign_quaries.php",
                data: dataString,
                success: function(data) {
                    //load order
                    var bills = "";
                    var dataString = 'value=hdbill&bills='+bills
                    $.ajax({
                        type: "POST",
                        url: "load_staff_assign.php",
                        data: dataString,
                        success: function(data) {
                            $('#hdbill').html(data);
                        }
                    });
                    //--------
                    //load staff

                        var dataString = 'value=load_staff&staff='+staffid ;
                        $.ajax({
                            type: "POST",
                            url: "load_staff_assign.php",
                            data: dataString,
                            success: function(data) {
                                $('#staffs').html(data);
                                var staff = $("#staff").val();
                                $("#"+staff+"").addClass('staff_sign_right_staff_name_box_act');
                                $("#assign_confirm").removeClass('confirm_desable_btn');
                            }
                        });

                    //---------

                }
            });
           
        }
        //load bill by staff
        var dataString = 'value=load_billby_staff&staffid='+staffid ;
            $.ajax({
                type: "POST",
                url: "load_staff_assign.php",
                data: dataString,
                success: function(data) {
                    $('#billby_staff').html(data);
//                    alert(data)
                    var flag = $('#asgndbill').val();
//                    alert(flag);
                    if(flag=='No' ){
                        $("#assign_confirm").addClass('confirm_desable_btn');
                    }else{
                        $("#assign_confirm").removeClass('confirm_desable_btn');
                    }
                }
            });
        //---------------
    });
    //delete bill by staff starts
     $('.staff_detail_bill_cancel').click(function (event){
         event.stopImmediatePropagation();
         var $billno = $(this).attr('billno');
         var staffid = $(this).attr('staffid');
         //alert($billno);
         var dataString = 'value=del_billby_staff&staffid='+staffid+'&billno='+$billno ;
            $.ajax({
                type: "POST",
                url: "staff_assign_quaries.php",
                data: dataString,
                success: function(data) {
                     //load bill by staff
                        var dataString = 'value=load_billby_staff&staffid='+staffid ;
                            $.ajax({
                                type: "POST",
                                url: "load_staff_assign.php",
                                data: dataString,
                                success: function(data) {
                                    $('#billby_staff').html(data);
                                    var flag = $('#asgndbill').val();
                                    if(flag=='No' ){
                                        $("#assign_confirm").addClass('confirm_desable_btn');
                                    }else{
                                        $("#assign_confirm").removeClass('confirm_desable_btn');
                                    }
                                }
                            });
                    //---------------
                    //load staff
                        var dataString = 'value=load_staff&staff='+staffid ;
                        $.ajax({
                            type: "POST",
                            url: "load_staff_assign.php",
                            data: dataString,
                            success: function(data) {
                                $('#staffs').html(data);
                                var staff = $("#staff").val();
                                $("#"+staff+"").addClass('staff_sign_right_staff_name_box_act');
                            }
                        });

                    //---------
                    //load order
                    var bills = "";
                    var dataString = 'value=hdbill&bills='+bills
                    $.ajax({
                        type: "POST",
                        url: "load_staff_assign.php",
                        data: dataString,
                        success: function(data) {
                            $('#hdbill').html(data);
                        }
                    });
                    //--------

                }
            });
         
     });
     
    //delete bill by staff end 
    //time alot starts
    $(".staf_delvr_time_box").click(function(){
        $(".staf_delvr_time_box").removeClass('staf_delvr_time_box_act');
        $(this).addClass('staf_delvr_time_box_act');
    });
    
    $("#assign_confirm").click(function(event){
        
       $(".confrmation_overlay").css("display","none");
        
       $('.alert_error_popup_all_in_one').show();
       
       $('.alert_error_popup_all_in_one').css('z-index','99999');
                                    
       $('.alert_error_popup_all_in_one').text('ORDERS ASSIGNED TO DELIVERY BOY');
       
       $('.alert_error_popup_all_in_one').delay(7000).fadeOut('slow');  
        
         
        event.stopImmediatePropagation();

        $(".staff_ass_confirm_pop_time_cc").css("display","block");
        
	//$(".confrmation_overlay").css("display","block");
        
         $("#assign_confirm_time_popup").click();
        
         setTimeout(function(){
          
          location.reload();
     
         }, 2000); 
        
        
    });
    
    
    $("#assign_confirm_time_popup").click(function(event){ 
        
        if($('.staf_delvr_time_box').hasClass('staf_delvr_time_box_act')){
//            ('.staf_delvr_time_box').removeClass('staf_delvr_time_box_act')
            event.stopImmediatePropagation();
            $(".staff_ass_confirm_pop_time_cc").css("display","none");
            
            var staffid = $('.staff_sign_right_staff_name_box_act').attr('staffid');
            var aloted_time = $('.staf_delvr_time_box_act').attr('time');
            
         // alert (aloted_time);
            var dataString = 'value=timealot&staffid='+staffid+'&alotted_time='+aloted_time
                $.ajax({
                    type: "POST",
                    url: "staff_assign_quaries.php",
                    data: dataString,
                    success: function(data) {
                        
                        //load bill by staff
                            var dataString = 'value=load_billby_staff&staffid='+staffid ;
                                $.ajax({
                                    type: "POST",
                                    url: "load_staff_assign.php",
                                    data: dataString,
                                    success: function(data) {
                                        $('#billby_staff').html(data);
                                        var flag = $('#asgndbill').val();
                                        if(flag=='No' ){
                                            $("#assign_confirm").addClass('confirm_desable_btn');
                                        }else{
                                            $("#assign_confirm").removeClass('confirm_desable_btn');
                                        }
                                        
                                        //load staff
                                        var dataString = 'value=load_staff&staff='+staffid ;
                                        $.ajax({
                                            type: "POST",
                                            url: "load_staff_assign.php",
                                            data: dataString,
                                            success: function(data) {
                                                $('#staffs').html(data);
                                                var staff = $("#staff").val();
                                                $("#"+staff+"").addClass('staff_sign_right_staff_name_box_act');
                                                $(".confrmation_overlay").css("display","none");
                                                 //send sms
                                                if(data!=''){ 
                                                var dataString = 'value=sendsms&staffid='+staffid+'&alotted_time='+aloted_time
                                                $.ajax({
                                                    type: "POST",
                                                    url: "staff_assign_quaries.php",
                                                    data: dataString,
                                                    success: function(data) {
                                                    }
                                                });
                                            }
                                            }
                                        });
                            

                                        //---------
                                        
                                    }
                                });
                        //---------------
                                          
                    }
                 
                    
                });
                
                
               
               
        }
    });
    //time alot end
    
    
});
      
                   




