$(document).ready(function(){
    
   var url      = window.location.href; 
    
    var cls=url.split('*');
    //alert(cls[1]);
   if(cls[1]!='' && cls[1]!=undefined ){
     
       $('.high_class'+cls[1]).addClass('payment_pend_bill_cc_act');
       
      // $('.payment_pend_bill_cc').click();
       
         
   }
    
    


	/*************************************  floor selection starts **********************************************************  */
	$('#typesele').change(function (event) {	
	event.stopImmediatePropagation(); 
			  var modeval=	$(this).val();
			  $('#billdetails').load("load_paymentpending.php?set=loadbilldetails_total");
			 $('.paymentclose').css("display","none");
			 $('.paid_amount_cc').css("display","none");
			  $('#loadtotalrate').text('');
			  $('#grandtotal').text('');  
			  $('.closetranscations').css("display","none");
			 $('.closetranscations_whole').css("display","none");
			 
			 $('#coupbal').val("");
			 $('#vouchbal').val("");
			 $('#coupamount').val(""); 
			 $('#vouchid').val("");
			 $('#vocamount').val(""); 
			  $('#paidamount').val("0");
			   $('#balanceamout').val("0");
			   $('#cheqamount').val("");
			  $('#cheqname').val("");
			  $('#cheqbank').val("");
			  $('#cheqbal').val("");
			   
			   
			   
			   $(".cash_cc").hide();
                    $(".credit_cc").hide();
					$(".credit_cc_normal").hide();
                    $(".coupon_cc").hide();
					$(".voucher_cc").hide();
					$(".cheque_cc").hide();
					$(".auto1").hide();
					$(".auto").hide();
					
			 
			
			 $('#load_billfullist').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			  $.post("load_payments_ta_cs.php", {modeval:modeval,set:'loadta_billdetails'},
				  function(data)
				  {
				  $('#load_billfullist').html(data);
				   $('.loadallhead').load("load_payments_ta_cs.php?set=loadtablehead");		  
				  });
	});
			  
	/***************************************  floor selection ends **********************************************************  */
        //----------------------------------payment pending stars--------------------------
        	
//                $("#payment_pend_pop_btn").click(function(e){ //alert("HIII");
//                    e.stopImmediatePropagation(); 
//                    $("#update_btn").hide()
//                        $( ".paymnet_pop_mode_chnge" ).addClass( "mode_chg" );
//                        $( ".paymnet_pop_mode_chnge_1" ).removeClass( "mode_chg" );
//			$(".paymnet_pop_mode_chnge").css("display","block");
//			$(".paymnet_pop_mode_chnge_1").css("display","none");
//                        
//                        $(".payment_pend_popup").css("display","block");
//			$(".confrmation_overlay").css("display","block");
//                        
//                        $("#payment_pending_all").addClass("take_away_payment_pend_sort_btn_act");
//                        var modeval="ALL";
//                        bill_by_mode(modeval);
//                        
//		});
        //----------------------------------payment pending end--------------------------
        //--------------------------------payment pending startd-----------------------------
        	$('.payment_pend_bill_cc').click(function (e) { 
                    e.stopImmediatePropagation();
                    
                 //var billno = $('.payment_pend_bill_cc_act').attr('bill');
                  var billno = $(this).attr('bill');
                      
                 var bill_sts=$(this).attr('status_billed');
                      
                 if(billno.substr(0, 4) !='HOLD'){
                 
                      var dataString = "billno="+billno+"&set=loadta_billitems";
                                                $.ajax({
                                                    type: "POST",
                                                    url: "load_payments_takeaway.php",
                                                    data: dataString,
                                                    success: function(data) {
                     $('.payment_pend_popup_right_tbl_cc').html(data);
                     
                      var total = $('.payment_pend_bill_cc_act').attr('total');
                        
                        var tot_new=total.replace(',','');
                        
                        $("#total").text(tot_new);
                         $("#tot_org_bill").val(tot_new);

			
                        
                                                    }
                       });
                     
                   
                    $("#update_btn").hide();
                    
                    
                    $(".payment_pend_bill_cc").removeClass('payment_pend_bill_cc_act');
                    $("#settle_btn").addClass('enable');
                if($(this).hasClass('payment_pend_bill_cc_act'))
                        {
                                $(this).removeClass('payment_pend_bill_cc_act');
                        }else
                        {
			$(this).addClass('payment_pend_bill_cc_act');
                        var mode = $('.payment_pend_bill_cc_act').attr('mode');
                       
                       
                        if(mode=="TA"){ 
                            $(".paymnet_pop_mode_chnge").css("display","none");
                           $(".paymnet_pop_mode_chnge_1").css("display","block");
                           
                           $('.delivery_boy_sec').hide();
                           
                        }else if(mode=='HD'){
                          $(".paymnet_pop_mode_chnge").css("display","block");
                           $(".paymnet_pop_mode_chnge_1").css("display","none");
                           
                           $('.delivery_boy_sec').show();
                           
                        }
                          
		}
                     
          $.post("load_payments_takeaway.php", {billno:billno,set:'check_urban_reorder'},
                    function(data)
                    {
                        
                        if($.trim(data)=='ok'){
                            $('#reg_new_btn').hide();
                              $('#kot_cancel_ta').hide();
                        }else{
                            
                              
                              $('#reg_new_btn').show();
                              $('#kot_cancel_ta').show();
                        }
                        
                var partner=$('#online_partner_filter').val();
                if(partner !=''){
                    
                               $('#settle_btn').hide();
                              $('#kot_cancel_ta').hide();
                               $("#reprint_new_btn").hide();
                                 $("#reg_new_btn").hide();
                                 
                                $("#credit_settle_all").show();         
                                 
                }else{
                    
                               $("#reg_new_btn").show();
                                 $('#settle_btn').show();
                              $('#kot_cancel_ta').show();
                               $("#reprint_new_btn").show();
                            $("#credit_settle_all").hide();            
                }
                        
               if(bill_sts=="N"){
                           
                        $('#bill_printta').css("display","block");
                           
                       $('#settle_div_hider').css("display","none");
                             
                 }else{
                     
                     $('#settle_div_hider').css("display","block");
                            $('#bill_printta').css("display","none");
                             
                   }   
                        
                   });
                    
               }else{
                   
                    alert('BILL IS ON HOLD ');
                    window.location.href = "take_away_.php?settacommon=settletapopup";	
                   
               }
              
	});
        //--------------------------------payment pending end-----------------------------
        //---------change mode starts------------------------------------------
        
        $(".paymnet_pop_mode_chnge").click(function(e){ 
            
            e.stopImmediatePropagation(); 
            
              $(".order_before").css("display","none");
              
            if($(".payment_pend_bill_cc").hasClass("payment_pend_bill_cc_act")){
                        var mode = "TA";
                        var billno = $('.payment_pend_bill_cc_act').attr('bill');
                        $.post("load_payments_takeaway.php", {billno:billno,mode:mode,set:'loadta_chgmode'},
                        function(data)
                        {
                          
                        });
                        $(".paymnet_pop_mode_chnge").css("display","none");
                        $(".paymnet_pop_mode_chnge_1").css("display","block");
                        var modeval="ALL";
                        $('.payment_pend_popup_left_cc').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			$.post("load_payments_takeaway.php", {modeval:modeval,set:'loadta_billdetails'},
                            function(data)
                            {
				$('.payment_pend_popup_left_cc').html(data);
                                $("#"+billno+"").addClass("payment_pend_bill_cc_act");
                            });
                       
                     }   
		});
            
		$(".paymnet_pop_mode_chnge_1").click(function(e){
                    e.stopImmediatePropagation(); 
			  $(".order_before").css("display","none");
                        //-----------------
                        $(".home_delevery_address_popup").css("display","block");
                        $(".confrmation_overlay").css("display","block");
                        $(".payment_pend_popup").css("display","none");
			//$(".confrmation_overlay").css("display","block");
                        $(".skip").hide();
                        $(".ta_submit_orders").addClass("payment_pend_enable");
                        //$(".chg_cls").removeClass("ta_submit_orders");
                        var cusid = $(".payment_pend_bill_cc_act").attr("custid");
                        //var ph = $(".payment_pend_bill_cc_act").attr("ph");
                        var dataString = 'set=getadrs&cusid='+cusid;
                                                $.ajax({
                                                    type: "POST",
                                                    url: "load_payments_takeaway.php",
                                                    data: dataString,
                                                    success: function(datax) {
                                                       datax=datax.trim();
                                                       var det=datax.split(",");
                                                       $("#ta_mobile").val(det[0]);
                                                      // $("#ta_id").val(det[1]);
                                                       $("#ta_name").val(det[2]);
                                                       $("#ta_address").val(det[3]);
                                                       $("#ta_orderaddress").val(det[4]);
                                                       $("#ta_landmark").val(det[5]);
                                                       $("#ta_area").val(det[6]);
                                                       $("#ta_remarks").val(det[7]);
                                                
                                                    }
                                                });
                        //---------------
                        var mode = "HD";
                        var billno = $('.payment_pend_bill_cc_act').attr('bill');
                        
                        $(".paymnet_pop_mode_chnge").css("display","block");
                        $(".paymnet_pop_mode_chnge_1").css("display","none");
                        var modeval="ALL";
                        $('.payment_pend_popup_left_cc').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			$.post("load_payments_takeaway.php", {modeval:modeval,set:'loadta_billdetails'},
                            function(data)
                            {
				$('.payment_pend_popup_left_cc').html(data);
                                $("#"+billno+"").addClass("payment_pend_bill_cc_act");
                            });
                            
                        
		});
        //---------change mode end------------------------------------------
        
        $(".payment_dlt_item").click(function(){
//            e.stopImmediatePropagation(); 
           $("#payment_pending_itemccl").css("display","block");
           
        });
        
        $(".delete_payment_pending_ccl").click(function(){
		$("#payment_pending_itemccl").css("display","none");	
	});	
        
        
        $("#payment_pending_all").click(function(e){
             e.stopImmediatePropagation(); 
             $(this).addClass("take_away_payment_pend_sort_btn_act");
             $("#payment_pending_ta").removeClass("take_away_payment_pend_sort_btn_act");
             $("#payment_pending_hd").removeClass("take_away_payment_pend_sort_btn_act");
             var mode = "ALL";
             bill_by_mode(mode)
//		alert('1');
	});
        $("#payment_pending_ta").click(function(e){
             e.stopImmediatePropagation(); 
             $(this).addClass("take_away_payment_pend_sort_btn_act");
              $("#payment_pending_all").removeClass("take_away_payment_pend_sort_btn_act");
             $("#payment_pending_hd").removeClass("take_away_payment_pend_sort_btn_act");
             var mode = "TA";
             bill_by_mode(mode)
//		alert('2');
	});
        $("#payment_pending_hd").click(function(e){
             e.stopImmediatePropagation(); 
             $(this).addClass("take_away_payment_pend_sort_btn_act");
              $("#payment_pending_ta").removeClass("take_away_payment_pend_sort_btn_act");
             $("#payment_pending_all").removeClass("take_away_payment_pend_sort_btn_act");
             var mode = "HD";
             bill_by_mode(mode)
//		alert('3');
	});
        
        
   //-------------------payment settle starts-------------------//
   
   
  $("#settle_btn").click(function(e){ 
            
          $(".payment_pend_popup").css("display","none");
          $(".confrmation_overlay").css("display","none");
            
          var crd_view= $('#credit_view_per').val();
          var comp_view= $('#comp_view_per').val();
          
            if(crd_view=="N"){
                $('#credit_person').hide();
            }
            if(comp_view=="N"){
                $('#complimentary').hide();
            }
            
            var decimal = $('#decimal').val();
            
            e.stopImmediatePropagation(); 
            
            if($(this).hasClass("enable")){
            
             dataString = 'value=getbill_amt';
                                                $.ajax({
                                                    type: "POST",
                                                    url: "load_takeaway.php",
                                                    data: dataString,
                                                    success: function(datax) {
                                                       datax=datax.trim();
                                                 
                                                var det=datax.split(",");   
                                                if(det[1]==''){
                                                    det[1]=0;
                                                }
                                                 if(det[3]==''){
                                                    det[3]=0;
                                                }
                                         
                                                $(".settle_popup_in_take_away").css("display","block");
                                                $(".confrmation_overlay").css("display","block");
                                                $('.pop_payment_mode_sel_btn').removeClass('mode_sel_btn_act');
                                                $('.pop_payment_mode_sel_btn:first').addClass('mode_sel_btn_act');
                                                $('#transbal').val('');
                                                
                            var loy_on=$('#loyalty_settle_on').val();
                    
                             if(det[8]=='Y'){
                                 
                                    $('#credit_person').click();
                                   
                                     $('#selectcreditypes').attr("style", "pointer-events: none;");
                                }else{
                                    
                                      $('#cash').click();
                                      $('#selectcreditypes').attr("style", "pointer-events: inherit;");
                                }
                                
                                
                                
            $('#paidamount').val(parseFloat(det[1]).toFixed(decimal).replace(",",''));
            $('#balanceamout').val('0.000');  
            $('#paidamount').select() ;                    
                                
                                                $('#paidamount').focus();
                                                $('#paidamount').select();
                                                $('#focusedtext').val('paidamount');
                                
                                                $('#billdetails').text(det[0]);
						$('#final').text(parseFloat(det[3]).toFixed(decimal));
						$('#grandtotal').text(parseFloat(det[1]).toFixed(decimal));
                                                $('#grand_org').val(parseFloat(det[1]).toFixed(decimal));
                                                
						if(det[2]=="")
						{
                                                    det[2]=0;
						}
                                                
						$('#totaldisc').text(parseFloat(det[2]).toFixed(decimal));
                                                
                                                
                                          if(parseFloat(det[2])>0){
                                              
                                                    var  dataString77 = 'set=discount_bill_format&billno='+det[0]+"&mode=TA";
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "load_index.php",
                                                        data: dataString77,
                                                        success: function(data3) {
                                                     
                                                      var dis_ld= data3.trim().split(","); 
                                                        
                                              if(dis_ld[2]!=''){
                                                            
                                                  $('#dis_details_new').text(dis_ld[0]+' ['+dis_ld[2]+' : '+dis_ld[1]+']');
                                              }else{
                                                     $('#dis_details_new').text('')  ;
                                              }
                                                        
                                                }
                                                });
                                                
                                            }else{
                                                
                                                 $('#dis_details_new').text('')  ;
                                            }
                                              
                                              
                                                var taxnames=det[4].split('<>');
                                                var taxvalues=det[5].split('<>');
                                                if(taxnames!=''){
                                                for(var j=0;j<taxnames.length;j++){
                                                                                 
                                                    $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id='+taxnames[j]+'>'+taxnames[j]+':<span >'+parseFloat(taxvalues[j]).toFixed(decimal)+'</span></div>') ;
                                                }
                                                 
                                                }
                                                $('#tip_amount').val(det[6]);
                         
                                               
                         if($('#pole_on').val()=='Y'){                                 
                                                        
                        var data_pole = 'set_pole=pole_display_all&pole_bill='+det[0]+"&pole_amount="+det[1]+"&display=show";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
                        
                      } 
                      
        var dataString_log5 ='set=check_discount_after&billno='+det[0];
       
        $.ajax({
            type: "POST",
            url: "load_takeaway.php",
            data: dataString_log5,
            success: function(billamount5) {
                
           
                var ds=$.trim(billamount5).split('*');
              
                if(ds[0]=='yes'){
                    
                    $('#discount_after_bill_btn').hide();
                }else{
                     $('#discount_after_bill_btn').show();
                }
               
               
                if(ds[1]>0){
                    
                 $('#dis_item_new').text(parseFloat(ds[1]).toFixed(decimal));
                 
                }else{
                 
                var tt_new=0;
                $('#dis_item_new').text(tt_new.toFixed(decimal)); 
                
                 }
            }
        });             
                                                
                                                
                                                
                                                }
                                                
                                                });
                                                  
                                               
                                                //$(".settle_popup_in_take_away").css("display","block");
                                                //$(".confrmation_overlay").css("display","block");
                                               
                                               
                        var dataString; 
			dataString = 'set=drawer_ta_open_settlepopup';
			$.ajax({
                            type: "POST",
                            url: "cashdrawer_details.php",
                            data: dataString,
                            success: function(data3) {
                                data3=data3.trim();
                            }
			});                               
            }
                                           
                                     
                                           
 });
//-------------------//
//                        
            
            $("#update_btn").click(function(e){
                
                e.stopImmediatePropagation(); 
                $("#payment_newcancel_confirm").css("display","block");
		$("#payment_newcancel_confirm_overlay").css("display","block"); 
            });
            
            $(".closepopup_noeach").click(function(e){
                $("#payment_newcancel_confirm").css("display","none");
		$("#payment_newcancel_confirm_overlay").css("display","none"); 
            });
            
            $(".paymnet_verfy_pop").click(function(e){
                e.stopImmediatePropagation(); 
                var auth_with_code = $('#authorise_with_code').val();
                
                if(auth_with_code=='Y'){
                    $('.kotcancel_reason_popup_new').css('display','block');
                    //$('.confrmation_overlay').css('display','block');
                    $('#payment_newcancel_confirm').css('display','none');
                    //$("#payment_newcancel_confirm_overlay").css("display","none"); 
                }else{
                    $(".payment_newcancel").css("display","block");
                    //---------send otp btn
                    $(' .btn_index_popup_send ').css('display','none');
                    $(' .btn_index_popup_send a').css('display','none');
                    //------------
                }
		
            });
            
            
           
                
            
            $(".closepopup").click(function(){
		$(".payment_newcancel").css("display","none");
                $("#payment_newcancel_confirm").css("display","none");
		$("#payment_newcancel_confirm_overlay").css("display","none");
            });
              /*************************************** submit cancelltaion starts *********************************************************  */
              
	  $('#submitcancelation_ta').click(function (e) { alert("hiii");
              
              e.stopImmediatePropagation();
              var genset=$('#genset').val();
              var billno = $('.payment_pend_bill_cc_act').attr('bill');
              var billitem = $('.payment_pending_pop_quantity_txt_box');
              var qty = '';
              var quantity = new Array();
              billitem.each(function(){
                    qty   =  $(this).val();
                    if(qty!='undefined' && qty!='' && qty!=null){
                        quantity.push(qty);
                    }
                 });
                 var as = $('#hidcancelsecret').val();
                 
	 if($('#hidcancelsecret').val()=="Y")
		  {
                    
                                var reasontext       =  $('#reasontext').val();
				var secretkey        =  $('#secretkey_sca').val();
				var stafflist        =  $('#stafflist').val();
				$.post("load_payments_takeaway.php", {secretkey:secretkey,stafflist:stafflist,set:'secretkeycheck'},
					function(data)
					{
                                           
                                        if($('#reasontext').val() !=''){    
					data=$.trim(data);
					if(data=="ok")
					{
                                                var staff=($('#stafflist').val())
                                                var type = $('#stafflist').find('option:selected').attr("cancelkey");
                                                
//                                                alert(type);
						var dataString;
                                                var datamsg;
                                    		dataString = 'set=menusubmission_pending_pay&reasontext='+reasontext+'&secretkey='+secretkey+'&stafflist='+staff+'&billno='+billno+'&qty='+quantity+'&type='+type;//alert(dataString);
                                    		$.ajax({
                                                        type: "POST",
                                                        url: "load_payments_takeaway.php",
                                    			data: dataString,
                                    			success: function(data) {
                                                           datamsg = data.trim();
//                                                            alert(datamsg);
                                                            if($('#hidprinter').val()=="Y" && genset=="Y")
                                                            {
                                                                        
                                                                      //kot cancel
                                                                      dataString = 'value=ta_kotprint_cancel';
                                                                      $.ajax({
                                                                      type: "POST",
                                                                      url: "print_details_kot.php",
                                                                      data: dataString,
                                                                      success: function(data1) {
                                                                             

                                                                              }
                                                                      });
                                                                      //--
                                                                     
                                                                       var dataString; 
                                                                      dataString = 'value=console_ta_cancel';
                                                                      $.ajax({
                                                                        type: "POST",
                                                                        url: "print_details_kot.php",
                                                                        data: dataString,
                                                                        success: function(data2) {
                                                                        }
                                                                      });
                                                                      //--
                                                                        
//                                                                    //kot cancel end  
                                                                      dataString = 'value=ta_kotprint';
                                                                       $.ajax({
                                                                      type: "POST",
                                                                      url: "print_details_kot.php",
                                                                      data: dataString,
                                                                      success: function(data3) {
                                                                          
                                                                             

                                                                              }
                                                                      });
                                                                      //--
                                                                     
                                                                       var dataString; 
                                                                      dataString = 'value=console_ta';
                                                                      $.ajax({
                                                                        type: "POST",
                                                                        url: "print_details_kot.php",
                                                                        data: dataString,
                                                                        success: function(data4) {
                                                                        }
                                                                      });
                                                                      //--
                                                                      
                                                                      if(datamsg!='no'){
                                                                      var homed = $('.payment_pend_bill_cc_act').attr('mode');
//                                                                      alert(homed);
                                                                      var dataString; 
                                                                      dataString = 'value=ta_billprint&bypass=y&homed='+homed;
                                                                      $.ajax({
                                                                        type: "POST",
                                                                        url: "print_details_kot.php",
                                                                        data: dataString,
                                                                        success: function(data4) {
                                                                        data2=data2.trim();
                                                                        if(data2=="ok")
                                                                            {
                                                                            }

                                                                        }
                                                                        });
                                                                    }


                                                            }
                                                                $(".payment_newcancel").css("display","none");
                                                                $("#payment_newcancel_confirm").css("display","none");
                                                                $("#payment_newcancel_confirm_overlay").css("display","none");
                                                                $(".payment_pend_popup").css("display","none");
                                                                $(".confrmation_overlay").css("display","block");
                                                                $('#payment_pend_pop_btn').trigger('click');
                                                                $('#total').text('0.00');
                                                            }
                                                    });
                                                 						  
                                                
                                                 
                                                 
                                                 
					}else
					{
                                                var tp ='';
                                                var psd=$("#hidenterpaswd").val();
                                                var otp=$("#hidenterotp").val();
                                                var err=$("#hiderrormg").val();
                                                var stafflist = $("#stafflist").find('option:selected').attr('cancelkey');//alert(stafflist);
                                                if(stafflist=='Y')
                                                {
                                                    tp=otp;
                                                }else
                                                {
                                                    tp=psd;
                                                }
                                                $("#deatilserror").css("display","block");
                                                $("#deatilserror").text(tp+" "+ err+"!!");
                                                $("#deatilserror").delay(4000).fadeOut('slow');	
                                                }
                                            }else{
                                                $("#deatilserror").css("display","block");
                                                $("#deatilserror").text("Reason for Cancellation?");
                                                $("#deatilserror").delay(4000).fadeOut('slow');
                                            }
                                        }); 
		  }else
		  {
                    
                    
//			var staff=($('#stafflist').val())
//			var dataString;
//                        dataString = 'set=menusubmission_pending_pay&reasontext='+reasontext+'&secretkey='+secretkey+'&stafflist='+staff+'&billno='+billno+'&qty='+quantity;//alert(dataString);
//                        $.ajax({
//                            type: "POST",
//                            url: "load_payments_takeaway.php",
//                            data: dataString,
//                            success: function(data) {
//                                  $(".payment_newcancel").css("display","none");
//                                  $("#payment_newcancel_confirm").css("display","none");
//                                  $("#payment_newcancel_confirm_overlay").css("display","none");
//                                  $(".payment_pend_popup").css("display","none");
//                                  $(".confrmation_overlay").css("display","block");
//                                  $('#payment_pend_pop_btn').trigger('click');
//                                  $('#total').text('0.00');
//                            }
//                        });
                  alert('No Quantity change feature added');
                        
                        
                     
		  }
		  	  
	 }); 
         //--send OTP starts
        
        $('.sendotp').click(function (e) {//alert("j");
             e.stopImmediatePropagation();
   
  
		var stafflist       =  $('#stafflist').val();//alert(stafflist);
		stafflist=$.trim(stafflist);
                $.post("load_payments_takeaway.php", {stafflist:stafflist,set:'sendotp'},
			function(data)
			{
			data=$.trim(data);
			$("#deatilserror").css("display","block");
			$("#deatilserror").text("OTP Sent..");
			$("#deatilserror").delay(5000).fadeOut('slow');
			//alert(data);
			});
//	 
	 
	 });
         //--send OTP end
	  
	  /***************************************  submit cancelltaion ends ***********************************************************  */
            
            $("#submitcancelation_ta1").click(function(e){
                e.stopImmediatePropagation(); 
                
                var reasontext       =  $('#reasontext').val();
		var secretkey        =  $('#secretkey').val();
//		var stafflist        =  $('#stafflist').val();
                
                var tp ='';
                var psd=$("#hidenterpaswd").val();
		var otp=$("#hidenterotp").val();
		var err=$("#hiderrormg").val();
                var stafflist = $("#stafflist").find('option:selected').attr('cancelkey');//alert(stafflist);
//                var stafflist       = 'Y';
		if(stafflist=='Y')
		{
                    tp=otp;
		}else
		{
                    tp=psd;
		}
		$("#deatilserror").css("display","block");
		$("#deatilserror").text(tp+" "+ err+"!!");
		$("#deatilserror").delay(2000).fadeOut('slow');				
//                alert('hi');
            });
        //paymnet_verfy_pop
//            
//             $("#update_btn").click(function(e){
//                 e.stopImmediatePropagation();
//                 var billno = $('.payment_pend_bill_cc_act').attr('bill');
//                 var billitem = $('.payment_pending_pop_quantity_txt_box');
//                 var qty = '';
//                 var quantity = new Array();
//                 billitem.each(function(){
//                    qty   =  $(this).val();
//                    if(qty!='undefined' && qty!='' && qty!=null){
//                        quantity.push(qty);
//                    }
//                 });
//                alert('hi'+quantity) ;
//                var dataString;
//		dataString = 'set=menusubmission_pending_pay&billno='+billno+'&qty='+quantity;//alert(dataString);
//		$.ajax({
//                    type: "POST",
//                    url: "load_payments_takeaway.php",
//			data: dataString,
//			success: function(data) {
//                        }
//                });
//				
//				
//				 
//				 
//             });              
            //update quantity end
            //-------------------
            $('#stafflist').change(function () {
		var stafflist       = $("#stafflist").find('option:selected').attr('cancelkey');//alert(stafflist);
		//alert(stafflist) 
		var psd=$("#hidenterpaswd").val();
		var otp=$("#hidenterotp").val();
		if(stafflist=='Y')
		{
			$(' #typeentery ').text(otp);
			$(' .btn_index_popup_send ').css('display','block');
			$(' .btn_index_popup_send a').css('display','block');
		}else
		{
			$(' #typeentery ').text(psd);
			$(' .btn_index_popup_send').css('display','none');
			$(' .btn_index_popup_send a').css('display','block');
		}
		
	 
	 
	 });
       
            
            //-------------------
                             
      
        });
		
        
        
        function bill_by_mode(modeval)
        {
            //var modeval="HD";
                        //$('.payment_pend_popup_left_cc').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			$.post("load_payments_takeaway.php", {modeval:modeval,set:'loadta_billdetails'},
                            function(data)
                            {
				$('.payment_pend_popup_left_cc').html(data);
				//$('.loadallhead').load("load_payments_ta_cs.php?set=loadtablehead");
                                $.post("load_payments_takeaway.php", {billno:'',set:'loadta_billitems'},
                                function(data)
                                {
                                    $('.payment_pend_popup_right_tbl_cc').html(data);
                                    //$('.loadallhead').load("load_payments_ta_cs.php?set=loadtablehead");		  
                                });
                               
                            });
        }
        
        function fillbyno(ph){
            
              $( "#ta_mobile" ).autocomplete({
				minLength: 0,
				source:"load_takeaway.php?value=searchmobile",
				focus: function( event, ui ) {
				  $( "#ta_mobile" ).val( ph );
				  return false;
				},
				select: function( event, ui ) {
				  $( "#ta_name" ).val( ui.item.name );
				  $( "#ta_mobile" ).val( ui.item.phn );
                                  $( "#ta_id" ).val( ui.item.id );
				  $( "#ta_orderaddress" ).val( ui.item.addr );
				  $( "#ta_landmark" ).val( ui.item.lndm );
				  $( "#ta_area" ).val( ui.item.are );
				  $( "#ta_address" ).val( ui.item.peraddr );
				  return false;
				}
			  });
        }
        
        //--------------change item count starts-----------------
        function chg_item_cnt_inc(sl){
            if($("#txt_"+sl).val()<999){
                $("#txt_"+sl).val(parseFloat($("#txt_"+sl).val())+1);
                $("#update_btn").show();
                $("#settle_btn").hide();
                 $("#reprint_new_btn").hide();
                
                var qty = $("#hdn_qty_item_"+sl).val();
                var amnt = $("#hdn_amnt_item_"+sl).val();
                var oneitem = amnt/qty;
                var res = oneitem * parseFloat($("#txt_"+sl).val());
                $("#amnt_"+sl).text(res.toFixed(2));
            }
        }
        function chg_item_cnt_dcr(sl){
            if($("#txt_"+sl).val()>0){
                $("#txt_"+sl).val(parseFloat($("#txt_"+sl).val())-1);
                $("#update_btn").show();
                $("#settle_btn").hide();
                 $("#reprint_new_btn").hide();
                
                var qty = $("#hdn_qty_item_"+sl).val();
                var amnt = $("#hdn_amnt_item_"+sl).val();
                var oneitem = amnt/qty;
                var res = oneitem * parseFloat($("#txt_"+sl).val());
                
                $("#amnt_"+sl).text(res.toFixed(2));
                
//                $("#total").text(parseFloat($("#total").text())- oneitem);
                
            }
        }
        
        
    $('.confirmkot_ta_lastbill').click(function(event){
         event.stopImmediatePropagation();
         var msg=$('#kotfailmsg_ta_lastbill').html();
          
          
             var dataString_log ='set_log=kotconfirmbylogin&failmsg='+msg;
             $.ajax({
             type: "POST",
             url: "menu_order.php",
             data: dataString_log,
             success: function(data) {
             
             }
             });
        
        // $('.disountenterpopup').css('display','none');  
                 $('.kotconfirmpopup_ta_lastbill').css('display','none');   
               $("#payment_newcancel_confirm_overlay").css("display","none");
            $('.disountenterpopup').css('display','none');
            
             var subt=$('#total').text();
             if(subt){
             $('#subtotal_d1').text(subt);
             $('#subtotal_l1').text(subt);
             }   
       
          var staffwithdiscountta1=$('#staffwithdiscountta').val();
          var staffdiscount_manual=$('#staffwithdiscount-manual').val();
       
            var disc=$('#counter_discount_popup').val();
           
            var loyalty_status=$('#loyalty_status').val();
          
            if(disc=="Y" )
            {
               
                    $(".home_delevery_address_popup").css("display","none");
                     $(".payment_pend_popup").css("display","none");
                    $('.confrmation_overlay').css('display','block');
                    $('.disountenterpopup').css('display','block');
                    $('.closedisount').addClass('skip');
                    $('.closedisount').addClass('bill-print-new-procedure');
                    $('.canceldisount').addClass('back-to-payment-pending');
                    $(".discount_click").click();
                     $('#disountamount').focus();
                
                 
            }else if(loyalty_status=="Y"){
     
             $('.loyalty_main_popup').css('display','block'); 
             if(disc!="Y" ){
                  $(".confrmation_overlay").css("display","block");
              $(".loyalty_click").click();
             
             }
          
            }
            else
            {
       
       
        var homed=$('.payment_pend_bill_cc_act'). attr('mode');
        var bil=$('.payment_pend_bill_cc_act'). attr('bill');
        $('.closedisount').removeClass('bill-print-new-procedure');
      var dataString; 
		dataString = 'value=ta_billprint&bypass=y&homed='+homed+"&billno="+bil+"&reprintok=N";
                //alert(dataString);
		$.ajax({
		type: "POST",
		url: "print_details_kot.php",
		data: dataString,
		success: function(data2) {
                 $('#bill_printta').hide();
		$.post("load_payments_takeaway.php", {modeval:"ALL",set:'loadta_billdetails'},
                                                        function(data)
                                                        {
                                                            $('.payment_pend_popup_left_cc').html(data);
                                                        
                                                            $(".payment_pending_botm_btn ").removeClass("enable")
                                                        });
		}
		});
             }
    });

$('.confirmkot_ta_no_lastbill').click(function(event){
    
                    $('.disountenterpopup').css('display','none');  
                 $('.kotconfirmpopup_ta_lastbill').css('display','none');   
               $("#payment_newcancel_confirm_overlay").css("display","none");
               // $(".confrmation_overlay").css("display","block");
                //$('#kotfailmsg_ta_lastbill').html(data);
        
    });
    
    
    $('#kotcancel_reason_popup_new_cancel_btnbh_cs').click(function(event){
        $('.kotcancel_reason_popup_reprint_cs').hide(); 
        
        $('.confrmation_overlay_kot').hide();
        
    });
    
    $('#pinbh').keypress(function(ev){
             if(ev.keyCode == 13){
             ev.stopImmediatePropagation();
             $('#kotcancel_reason_popup_new_proceed_btnbh_cs').trigger('click');
            }
   });  
    
     $('#kotcancel_reason_popup_new_proceed_btnbh_cs').click(function(event){
         
         
         
       
        event.stopImmediatePropagation();
        
        var pin=$("#pinbh").val();
        
        if(pin !=''){
                  
              $.post("load_takeaway.php", {pin:pin,value:'authpincheck',set:'pincheck'},
		function(data)
		{ //alert(data);
                    data=$.trim(data);
                    if(data!="NO")
                    {
                        
                        var spl=data.split('*');
                        
                             if(spl[1]=='reprint:Y'){     
        
         $('.confrmation_overlay_kot').hide();
                   $('.kotcancel_reason_popup_reprint_cs').hide();
        
           var dataString5 = 'value=getbill_amt';
                                                $.ajax({
                                                    type: "POST",
                                                    url: "load_takeaway.php",
                                                    data: dataString5,
                                                    success: function(datax) {
                                                       datax=datax.trim();
                                                  // alert(datax);
                                                var det=datax.split(",");   
         
         
         var homed1=det[0].charAt(0);   
         
         if(homed1=='T'){
            var  homed='TA'; 
            
         }else if(homed1=='H'){
             
             homed='HD';
         }else{
             homed='CS';
         }
         
         
         
         var dataString; 
		dataString = 'set=reprint_ta_new&homed='+homed+"&billno="+det[0];
                //alert(dataString);
		$.ajax({
		type: "POST",
		url: "print_details.php",
		data: dataString,
		success: function(data2) {
                  //alert(data2);  
                  
                 
                  
                }
            });
            }
            });
            
            
            
            
            }else{
                         $("#pin_errorbh").css("display","block");
			$("#pin_errorbh").text(" NO Permission");
			$("#pin_errorbh").delay(2000).fadeOut('slow');
                        $("#pinbh").val('');
                         $("#pinbh").focus();
                    }
                    }else{
                        $("#pin_errorbh").css("display","block");
			$("#pin_errorbh").text("CODE NOT REGISTERED");
			$("#pin_errorbh").delay(2000).fadeOut('slow');
                        $("#pinbh").val('');
                         $("#pinbh").focus();
                    }
                });
                
                
            }else{
                $("#pin_errorbh").css("display","block");
		$("#pin_errorbh").text("ENTER PIN");
		$("#pin_errorbh").delay(2000).fadeOut('slow');
                $("#pinbh").val('');
                  $("#pinbh").focus();

            }
            
            
            
        
    });
    
    $('.calculator_settle2').click( function(event) {
        
        
        if ($('.kotcancel_reason_popup_reprint_cs').css('display') == 'block') {
         
		event.stopImmediatePropagation();
                $('#focusedtext').val('pinbh');
		var focused=$('#focusedtext').val();
               
		var calval=($(this).text());//alert(focused);alert(calval);
		
		var org=$('#'+focused).val();
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
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
			}else if(calval==".")
			{
				$('#'+focused).val(org+".");
			}
			$('#'+focused).change();
		$('#'+focused).focus();
		
        }else{
            
            event.stopImmediatePropagation();
                $('#focusedtext').val('pin_reg');
		var focused=$('#focusedtext').val();
               
		var calval=($(this).text());//alert(focused);alert(calval);
		
		var org=$('#'+focused).val();
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
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
			}else if(calval==".")
			{
				$('#'+focused).val(org+".");
			}
			$('#'+focused).change();
		$('#'+focused).focus();
            
        }
		
	});
    
    
    
    $('#reprint_new_btn').click(function(event){
        event.stopImmediatePropagation();
        $('.kotcancel_reason_popup_reprint_cs').show();
        
        
       $('.confrmation_overlay_kot').show();
        $("#pinbh").val('');
        $("#pinbh").focus();
    });
    
    
    $('#credit_settle_all').click(function(event){
        event.stopImmediatePropagation();
        
        var tot_credit_amt=parseFloat($('#total').text());
        
       
     if(tot_credit_amt>'0'){
        
          var confirm1=confirm("CONFIRM BILL SETTLE TO CREDIT ?");
       if(confirm1===true){
        
                 var bills=new Array();
			var selected_activities =$("[name='all_credit_bill[]']:checked");
			selected_activities.each(function(){
			  var id_str       =  $(this).attr("billno_credit");
			  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  bills.push(id_str);
				  }
	
			});
        
      
        
         var billamounts=new Array();
			var selected_activities1 =$("[name='all_credit_bill[]']:checked");
			selected_activities1.each(function(){
			  var id_str1       =  $(this).attr("billamount_credit");
			  if(id_str1!='undefined' && id_str1!='' && id_str1!=null){
					  billamounts.push(id_str1);
				  }
	
			});
       
        // alert(bills);
      // alert(billamounts);
      
      
        $('.confrmation_overlay').hide();
        $('.payment_pend_popup').hide();
      $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('BILL SETTLING');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
       
       var m;
   
       for(m=0;m<bills.length;m++){
             
            
          var bill_partner=$('#bill_partner').val();
                   var urb_channel=$('#urb_channel').val();
                                                     var  data_cr = {
								  "set"				: "bill_settle_ta",
								  "type"			: 'credit_person',
								  "typenam"			: "6",
								  "creditype"			: '3',
								  "creditdeatils"		: '',
								  "paidamount_credit"	        : '0',
								  "amount_credit"		: billamounts[m],
								  "bal"				: '0',
				                                   "stl" 		        : 'drct5',
                                                                   "credit_remarks_ta"          :'',
                                                                   "guestnumber"                :'',
                                                                  "guestname"                   :bill_partner,
                                                                  "room"                        :'' ,
                                                                  "billno"                      :bills[m]
								};
                      
                   
                      
    data_cr = $(this).serialize() + "&" + $.param(data_cr)+"&tip_amount=0&tip_mode=C&auth_staff=&coupon_code=&bill_final_amount_new="+billamounts[m]; 
              
			 $.ajax({
					type: "POST",
					url: "load_payments_ta_cs.php",
					data: data_cr,
					success: function(msg)
					{ 
                                           
                                            pay_pending('ALL');  
                                            
                                            $('.alert_error_popup_all_in_one').hide();
                                             $('.payment_pend_popup_left_cc').removeClass('disablegenerate');
                                        }
                                        });
                      
                      
                      
                        } 
        
        }
    }else{
        
        alert('No Bills To Settle');
        
    }
        
    }); 
    
    
    
    
    $('#reg_new_btn').click(function(event){
        event.stopImmediatePropagation();
        
        
          var dataString5 = 'value=getbill_amt';
                                                $.ajax({
                                                    type: "POST",
                                                    url: "load_takeaway.php",
                                                    data: dataString5,
                                                    success: function(datax) {
                                                       datax=datax.trim();
                                                  // alert(datax);
                                                var det=datax.split(",");   
         
         
         var dataString5 = 'set=check_reorder_status&billno='+det[0];
                                                $.ajax({
                                                    type: "POST",
                                                    url: "load_takeaway.php",
                                                    data: dataString5,
                                                    success: function(data4) {
         
        
           if($.trim(data4)!='yes'){
               
                  var bill_check=$('.payment_pend_bill_cc_act').attr('bill');
                  var loy_id=$('.payment_pend_bill_cc_act').attr('loy_id');
            
             var datastringnew223="set=check_reorder_settle&bill_check="+bill_check;
      
        $.ajax({
        type: "POST",
        url: "load_takeaway.php",
        data: datastringnew223,
        success: function(data3)
        { 
         if($.trim(data3)!='yes'){
                             
         
                var dataString; 
		dataString = "set=regen_ta_cs&bill="+det[0]+"&loy_id="+loy_id;
                //alert(dataString);
		$.ajax({
		type: "POST",
		url: "load_takeaway.php",
		data: dataString,
		success: function(data2) {
                 
                 
                 window.location.href='take_away_.php';
                 
                  
                }
            });
                                                      }else{
                                                            alert('CLEAR CART OF REORDER')
                        
                                                        }
                                                    
                                                    }
                                                });
                                                
                                                
                                                
                                                        }else{
                                                            alert('Reorder Not Possible. Bill Already settled')
                        
                                                        }
                                                    
                                                    }
                                                });
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
           }
            });
        
        
        //$('.kotcancel_reason_popup_regen_cs').show();
        
      // $('.confrmation_overlay_kot').show();
        //$("#pin_reg").val('');
       // $("#pin_reg").focus();
    });
     
     
   $('#reg_cancel').click(function(event){  
     
     $('.kotcancel_reason_popup_regen_cs').hide();
        
       $('.confrmation_overlay_kot').hide();
        $("#pin_reg").val('');
        $("#pinbh").focus();
        
      });
           


$('#pin_reg').keypress(function(ev){
             if(ev.keyCode == 13){
             ev.stopImmediatePropagation();
             $('#reg_proceed').trigger('click');
            }
   });

        
        $('#reg_proceed').click(function(event){  
            
            
        event.stopImmediatePropagation();
        
        var pin=$("#pin_reg").val();
        
        if(pin !=''){
                  
              $.post("load_takeaway.php", {pin:pin,value:'authpincheck',set:'pincheck'},
		function(data)
		{ //alert(data);
                    data=$.trim(data);
                    if(data!="NO")
                    {
                        
                        var spl=data.split('*');
                        //alert(spl[2]);
                             if(spl[2]=='regen:Y'){     
        
                    $('.confrmation_overlay_kot').hide();
                   $('.kotcancel_reason_popup_regen_cs').hide();
        
           var dataString5 = 'value=getbill_amt';
                                                $.ajax({
                                                    type: "POST",
                                                    url: "load_takeaway.php",
                                                    data: dataString5,
                                                    success: function(datax) {
                                                       datax=datax.trim();
                                                  // alert(datax);
                                                var det=datax.split(",");   
         
                    var dataString; 
		dataString = "set=regen_ta_cs&bill="+det[0];
                //alert(dataString);
		$.ajax({
		type: "POST",
		url: "load_takeaway.php",
		data: dataString,
		success: function(data2) {
                 
                 
                 window.location.href='take_away_.php';
                 
                  
                }
            });
     }
            });
            
            
            
            
            }else{
                         $("#pin_error_reg").css("display","block");
			$("#pin_error_reg").text(" NO Permission");
			$("#pin_error_reg").delay(2000).fadeOut('slow');
                        $("#pin_reg").val('');
                         $("#pin_reg").focus();
                    }
                    }else{
                        $("#pin_error_reg").css("display","block");
			$("#pin_error_reg").text("CODE NOT REGISTERED");
			$("#pin_error_reg").delay(2000).fadeOut('slow');
                        $("#pin_reg").val('');
                         $("#pin_reg").focus();
                    }
                });
                
                
            }else{
                $("#pin_error_reg").css("display","block");
		$("#pin_error_reg").text("ENTER PIN");
		$("#pin_error_reg").delay(2000).fadeOut('slow');
                $("#pin_reg").val('');
                  $("#pin_reg").focus();

            }
            
            
            
            
        });
        
        
        
        
  $('#bill_printta').one('click',function(event){
      
               $('#bill_printta').hide();
               event.stopImmediatePropagation();
      
               var KOT_print = "TA_bill_print";
                //------------
                $.post("printercheck_1.php", {type:KOT_print},

                function(data)
                { 
                data=$.trim(data); 
                //alert(data);
                //$(".olddiv").removeClass("new_overlay");
                if(data !=0)
                { 

                 $('.disountenterpopup').css('display','none');  
                 $('.kotconfirmpopup_ta_lastbill').css('display','block');   
                 $("#payment_newcancel_confirm_overlay").css("display","block");
                 // $(".confrmation_overlay").css("display","block");
                 $('#kotfailmsg_ta_lastbill').html(data);


                }else  {
                    
                    
               var subt=$('#total').text();
             
               if(subt){
                   
                  $('#subtotal_d1').text(subt.replace(',',''));
                  $('#subtotal_l1').text(subt.replace(',',''));
               }   
                    
                    
      
          event.stopImmediatePropagation();
           
          var staffwithdiscountta1=$('#staffwithdiscountta').val();
          var staffdiscount_manual=$('#staffwithdiscount-manual').val();
        
        //alert(staffwithdiscountta1);
	
            var disc=$('#counter_discount_popup').val();
            
           var loyalty_status=$('#loyalty_status').val();
         
            if(disc=="Y" )
            {
               
                    $(".home_delevery_address_popup").css("display","none");
                    if(loyalty_status=="N"){
                     //$(".payment_pend_popup").css("display","none");
                    $('.confrmation_overlay_2').css('display','block');
                         }else{
                             
                              $(".confrmation_overlay_2").css("display","block"); 
                         }
                    $('.confrmation_overlay').css('display','block');
                    $('.disountenterpopup').css('display','block');
                    $('.closedisount').addClass('skip');
                    $('.closedisount').addClass('bill-print-new-procedure');
                    $('.canceldisount').addClass('back-to-payment-pending');
                    $(".discount_click").click();
                     $('#disountamount').focus();
                
                 
            }else if(loyalty_status=="Y"){
                
             $('.loyalty_main_popup').css('display','block'); 
             
             if(disc!="Y" ){
              $(".loyalty_click").click();
              $(".confrmation_overlay_2").css("display","block");
             
             }
          
            }
            else
            {
       
         var homed=$('.payment_pend_bill_cc_act'). attr('mode');
         var bil=$('.payment_pend_bill_cc_act'). attr('bill');
       
        $('.closedisount').removeClass('bill-print-new-procedure');
     
		var dataString = 'value=ta_billprint&bypass=y&homed='+homed+"&billno="+bil+"&reprintok=N";
               // alert(dataString);
		$.ajax({
		type: "POST",
		url: "print_details_kot.php",
		data: dataString,
		success: function(data2) {
                 $('#bill_printta').hide();
		$.post("load_payments_takeaway.php", {modeval:"ALL",set:'loadta_billdetails'},
                                                        function(data)
                                                        {
                                                            $('.payment_pend_popup_left_cc').html(data);
                                                        
                                                            $(".payment_pending_botm_btn ").removeClass("enable")
                                                        });
		}
		});
                 window.location.href = "take_away_.php?settacommon=settletapopup";  
             }  
           
         }
         });
       
});    


 $('#go_item_cancel').click(function (event) {
         
         event.stopImmediatePropagation();
    
         var billno=  $('#otp_pop').attr('billno');
    
           var data1234="set=check_otp_item_cancel&billno="+billno;
           $.ajax({
            type: "POST",
            url: "load_index.php",
            data: data1234,
            success: function(data) {
                
             if($('#code_otp').val()==$.trim(data)){
             
              $('#otp_pop').hide();
      $('#otp_pop').attr('billno',' ');
                              
       $('#code_otp').val('');
       
       $('#code_otp').focus();
             
             
                         $('.alert_error_popup_all_in_one').show();
                         $('.alert_error_popup_all_in_one').text('ITEM CANCELLED');
                         $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
                        
                        
                          
                    var hidsl=$('#hiddenslno').val();   
                        
                        var billno = $('.payment_pend_bill_cc_act').attr('bill');
                        var billitem = $('.payment_pending_pop_quantity_txt_box');
                        var qty = '';
                        var combo_name=new Array();
                        var combo_count='';
                        var stock_check='';
                        var quantity = new Array();
                        var combo_name_string='';
                        billitem.each(function(){
                            if($(this).hasClass('combo_menu')){
                                combo_count=$(this).attr('id').split('txt_combo_');
                                stock_check=$(this).attr('stock_check');
                                //alert($(this).val())
                                //alert($('#reasontxt_'+combo_count[1]));
                                combo_name.push({
                                    combo_qty:$(this).val(),
                                    combo_count:combo_count[1],
                                    stock_check:stock_check
                                    
                                });
                             combo_name_string=JSON.stringify(combo_name);  
                            }else{
                                qty   =  $(this).val();
                                if(qty!='undefined' && qty!='' && qty!=null){
                                    quantity.push(qty);
                                }
                            }
                           });
                           
                         
						var dataString;
                                                var datamsg;
                                    		dataString = 'set=cancel_ta_itemqty&itemslno='+hidsl+'&itemqty='+quantity+'&billno='+billno+"&reason=&staff=&combo_name="+combo_name_string;
                                                
                                    		$.ajax({
                                                        type: "POST",
                                                        url: "load_payments_takeaway.php",
                                    			data: dataString,
                                    			success: function(data) {
                                                           datamsg = data.trim();
                                                            
                                                            window.location.href = "take_away_.php?settacommon=settletapopup";	
                                                            }
                                                    });
                    
                    
                    
              
     
       
       
                }else{
                    
                       alert('INVALID OTP');
                     
                       $('#code_otp').val('');
       
                        $('#code_otp').focus();   
                        
                }
                
            }
            
          });
          
      });




$('#kot_cancel_ta').click(function(event){
    
    
    event.stopImmediatePropagation();
          
                        var totqty = 0;
                         $('.cnclqty').each(function(){
                              totqty += Number($(this).val());
                        });
                        
                        var totqty2 = $('#totqty').val();
                          
                        
                        if(totqty==totqty2){
                            
                        alert("Quantity Not Changed");
                           
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Quantity Not Changed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
                        }else{
                            
                            
                        if($('#otp_item_cancel').val()=='Y'){ 
                               
                               
                            $('#otp_pop').show();
                               
                            $('#code_otp').val('');
                               
                            $('#code_otp').focus();
                               
                            var billno = $('.payment_pend_bill_cc_act').attr('bill');
                           var staff= $('#otp_login').val();
                           
                            $('#otp_pop').attr('billno',billno);
                            
                          $.post("load_index.php", {billno:billno,staff:staff,set:'otp_item_cancel'},
			  function(data)
			  {
                           
                          });
                               
                               
                           }else{
                            
                            
                            
                            if($('#hidcancelsecret').val()=="Y"){
                                
                                $('.kotcancel_reason_popup_new').css('display','block');

                                $("#payment_newcancel_confirm_overlay").css("display","block"); 
                                $("#payment_newcancel_confirm").css("display","none");
                                $("#pin").focus();
                                
                            }else{
                        
                       
              
                        var hidsl=$('#hiddenslno').val();   
                        
                        var billno = $('.payment_pend_bill_cc_act').attr('bill');
                        var billitem = $('.payment_pending_pop_quantity_txt_box');
                        var qty = '';
                        var combo_name=new Array();
                        var combo_count='';
                        var stock_check='';
                        var quantity = new Array();
                        var combo_name_string='';
                        billitem.each(function(){
                            if($(this).hasClass('combo_menu')){
                                combo_count=$(this).attr('id').split('txt_combo_');
                                stock_check=$(this).attr('stock_check');
                                //alert($(this).val())
                                //alert($('#reasontxt_'+combo_count[1]));
                                combo_name.push({
                                    combo_qty:$(this).val(),
                                    combo_count:combo_count[1],
                                    stock_check:stock_check
                                    
                                });
                             combo_name_string=JSON.stringify(combo_name);  
                            }else{
                                qty   =  $(this).val();
                                if(qty!='undefined' && qty!='' && qty!=null){
                                    quantity.push(qty);
                                }
                            }
                           });
                           
                         
						var dataString;
                                                var datamsg;
                                    		dataString = 'set=cancel_ta_itemqty&itemslno='+hidsl+'&itemqty='+quantity+'&billno='+billno+"&reason=&staff=&combo_name="+combo_name_string;
                                                
                                    		$.ajax({
                                                        type: "POST",
                                                        url: "load_payments_takeaway.php",
                                    			data: dataString,
                                    			success: function(data) {
                                                           datamsg = data.trim();
                                                            
                                                            window.location.href = "take_away_.php?settacommon=settletapopup";	
                                                            }
                                                    });
                                                 
                                            }
                                            
                        }   
                                            
                        }
});

$('.pin_close').click(function(event){
    	window.location.href = "take_away_.php?settacommon=settletapopup";	
});

 function plus_kot(sl,qty,menutype){
    
           if(menutype==''){
                if($("#txt_"+sl).val()<qty){
                    $("#txt_"+sl).val(parseInt($("#txt_"+sl).val())+1);

                }
            }
            else if(menutype=='combo'){
                if($("#txt_combo_"+sl).val()<qty){
                    $("#txt_combo_"+sl).val(parseInt($("#txt_combo_"+sl).val())+1);

                }
            }
        }
        function minus_kot(sl,menutype){
            if(menutype==''){
                if($("#txt_"+sl).val()>0){
                    $("#txt_"+sl).val(parseInt($("#txt_"+sl).val())-1);

                }
            }
            else if(menutype=='combo'){
                if($("#txt_combo_"+sl).val()>0){
                    $("#txt_combo_"+sl).val(parseInt($("#txt_combo_"+sl).val())-1);

                }
            }
        }


 $('#kotcancel_reason_popup_new_proceed_btn55').click(function (event) { 
     
             event.stopImmediatePropagation();
          
      
            
              var pin =  $('#pin').val();
              var hidsl=$('#hiddenslno').val(); 
              
              if(pin !=''){
              $.post("load_takeaway.php", {pin:pin,value:'authpincheck',set:'pincheck'},
		function(data)
		{ 
                   
                    data=$.trim(data);
                    
                  
                  var staff_sl=data.split('*');
                  var staff=staff_sl[0];
                
                    if(data!="NO")
                    { 
                       if($.trim(staff_sl[4])=='kotcancel:Y'){
                        $('.kotcancel_reason_popup_new').css('display','none');
                        $('#pin').val('');
                       
                        var billno = $('.payment_pend_bill_cc_act').attr('bill');
                        var billitem = $('.payment_pending_pop_quantity_txt_box');
                        var qty = '';
                        var combo_name=new Array();
                        var combo_count='';
                        var stock_check='';
                        var quantity = new Array();
                        var combo_name_string='';
                        billitem.each(function(){
                            if($(this).hasClass('combo_menu')){
                                combo_count=$(this).attr('id').split('txt_combo_');
                                stock_check=$(this).attr('stock_check');
                                //alert($(this).val())
                                //alert($('#reasontxt_'+combo_count[1]));
                                combo_name.push({
                                    combo_qty:$(this).val(),
                                    combo_count:combo_count[1],
                                    stock_check:stock_check
                                    
                                });
                             combo_name_string=JSON.stringify(combo_name);  
                            }else{
                                qty   =  $(this).val();
                                if(qty!='undefined' && qty!='' && qty!=null){
                                    quantity.push(qty);
                                }
                            }
                           });
                           //alert(combo_name_string);
                         
                                                 var secretkey ='';
                                                var reasontext = $('#authcodersn').val();
                                                var staff1=($('#stafflist').val())
                                                var type = $('#stafflist').find('option:selected').attr("cancelkey");
                                                
//                                               
						var dataString;
                                                var datamsg;
                                    		dataString = 'set=cancel_ta_itemqty&itemslno='+hidsl+'&itemqty='+quantity+'&billno='+billno+"&reason="+reasontext+"&staff="+staff+"&combo_name="+combo_name_string;
                                                
                                    		$.ajax({
                                                        type: "POST",
                                                        url: "load_payments_takeaway.php",
                                    			data: dataString,
                                    			success: function(data) {
                                                           datamsg = data.trim();
                                                            //alert(datamsg);
                                                              window.location.href = "take_away_.php?settacommon=settletapopup";	
                                                            }
                                                    });
                                                }else{
                                                    $("#pin_error").css("display","block");
                                                    $("#pin_error").text("NO PERMISSION ");
                                                    $("#pin_error").delay(2000).fadeOut('slow');
                                                    $("#pin").val('');
                                                     $("#pin").focus();
                                                    
                                                }
                                                           
					
                    }else{
                        
                        $("#pin_error").css("display","block");
			$("#pin_error").text("CODE NOT REGISTERED!");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").val('');
                        $("#pin").focus();
                    }
                });
            }else{
               
                        $("#pin_error").css("display","block");
			$("#pin_error").text("ENTER PIN");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").focus();
                         
            }
       
             });
 
function charlimit(evt,value)
{   
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    
    if ((charCode<48 ||charCode>57) && charCode!=46)
    {
        return false;
    }else if(charCode==46 && value.includes('.')){
       return false; 
    }
    else if(value.length>13){
        return false;
    }
    return true;
}