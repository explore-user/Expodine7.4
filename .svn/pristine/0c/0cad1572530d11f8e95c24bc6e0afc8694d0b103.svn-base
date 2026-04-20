// JavaScript Document
$(document).ready(function(){
	 $('#pin').keypress(function(ev){
     
        if(ev.keyCode == 13){
            ev.stopImmediatePropagation();
           $('#kotcancel_reason_popup_new_proceed_btn').click(); 
           
           // $('#kotcancel_reason_popup_new_proceed_btn').trigger('click');
        }});
	/*************************************** auto refresh  starts *************************************************  */
	$('.ta_bill_history').click( function() { 
          
            var billdate=$(this).attr("billdate");
            var user=$(this).attr("user");
            var cur_date=  $(this).attr("cur_date");
      
         
            if(billdate!=cur_date && user!='Super Admin'){
            var chk="hide";
            var data1="set_check=set_check_cancel&status="+chk;
        $.ajax({
        type: "POST",
        url: "load_ta_history.php",
        data: data1,
        success: function(data)
        { 
       
        }
          }); 
          
          
            var chk="hide";
       var data1="set_check=set_check_cancel&status="+chk;
        $.ajax({
        type: "POST",
        url: "load_cs_history.php",
        data: data1,
        success: function(data)
        { 
       
        }
        
    });
       
       }else{ 
                
       var chk="show";
       var data1="set_check=set_check_cancel&status="+chk;
        $.ajax({
        type: "POST",
        url: "load_ta_history.php",
        data: data1,
        success: function(data)
        { 
       
        }
    });    
       
        var chk="show";
       var data1="set_check=set_check_cancel&status="+chk;
        $.ajax({
        type: "POST",
        url: "load_cs_history.php",
        data: data1,
        success: function(data)
        { 
     
        }
    });
       
     }
     
     
            
             $(".close_settle").click();
//	          if ($(this).hasClass('bill_history_active'))
//			{
//				$(this).removeClass("bill_history_active");
//				$('.settlementdetails').empty();
//				$('#detailsset1_ta').empty();
//				$('#billdetailsset2').empty();
//                                 
//                               
//			}else
//			{
				$('.ta_bill_history').removeClass("bill_history_active");
				$(this).addClass("bill_history_active");
				var billno   =  $(this).attr("billno");//alert(billno[0]);
                                
                                
                                 var sts       =  $(this).attr("cancelstatus");
                                
                                $('#a4_view').attr("billno",billno);
                                $('#a4_view').attr("sts",sts);
                                
                                
                                if(billno[0]=='C')
                                {
                                    var url="load_cs_history.php";
                                }
                                else{
                                     var url="load_ta_history.php";
                                }
                                //alert(url);
				var dataString = 'value=load_ta_bildetails&billno=' + billno;
				var request= $.ajax({
					  type: "POST",
					  url: url,
					  data: dataString,
					  success: function(data) {
						   $('#billdetailsset2').html(data);
						   
						   var dataString1 = 'value=load_ta_settlement&billno=' + billno;
							var request1= $.ajax({
								  type: "POST",
								  url: url,
								  data: dataString1,
								  success: function(data1) {
									  
									   $('.settlementdetails').html(data1);
									   
									   
									   var dataString2 = 'value=load_ta_bildetls&billno=' + billno;
									   var request2= $.ajax({
											type: "POST",
											url: url,
											data: dataString2,
											success: function(data2) {
												
												 $('#detailsset1_ta').html(data2);
												
											}
										 });
									  
								  }
							   });
						   
						   
						   
						   
						  
					  }
				   });
                                   
                                   
                                 var billno5   =  $(this).attr("billno");
        $.post("load_payments_takeaway.php", {billno:billno5,set:'check_urban_reorder'},
                    function(data)
                    {
                       
                        if($.trim(data)=='ok'){
                            $('#cancel_billta_history').hide();
                              $('.changesetledetils').hide();
                        }else{
                            
                              
                              $('#cancel_billta_history').show();
                              $('.changesetledetils').show();
                        }
                        
                        
                   });     
                                   
                                   
				  data = null;
				  dataString = null;
				  request.onreadystatechange = null;
				  request.abort = null;
				  request = null;	
				  
				  data1 = null;
				  dataString1 = null;
				  request1.onreadystatechange = null;
				  request1.abort = null;
				  request1 = null;
				  	
				  data2 = null;
				  dataString2 = null;
				  request2.onreadystatechange = null;
				  request2.abort = null;
				  request2 = null;
				return false;
				 
			//}
			
	
        
        
        
        
	
	});
	
	/*************************************** search  ends *************************************************  */
	
	
	
	
	});

  function numonly(evt)
     {
         evt = (evt) ? evt : window.event;
         var charCode = (evt.which) ? evt.which : evt.keyCode;
         if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

             return false;

         }
         return true;
     }    
          
          
          
            function submitcustomer(){
               
             var bilcus = $('#bilcus').val();
             
             var csname=$('#csname').val();
              var csphone=$('#csphone').val();
               var csgst=$('#csgst').val();
             
           var datastringcus="set=customerdetail&cusbillno="+bilcus+"&csphone="+csphone+"&csname="+csname+"&csgst="+csgst;
    
       $.ajax({
        type: "POST",
        url: "load_ta_history.php",
        data: datastringcus,
        success: function(data)
        {
            
     var d=data.split('<');
     var d2=d[0].trim();
  //alert(d2);
            if(d2=='ok'){
         alert("Customer details updated");
        // $("#ta_billlisttotal").load("ta_bill_history.php" + " #ta_billlisttotal");
          $('.update_billdetails').click();
          // window.location.href = "ta_bill_history.php";
              }
        }
        
    });
               
               
            }