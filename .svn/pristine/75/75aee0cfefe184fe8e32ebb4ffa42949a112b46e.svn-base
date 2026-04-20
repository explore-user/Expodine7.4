// JavaScript Document

 $(document).ready(function() {
	
	
	  /*************************************** registered no starts *********************************************************  */  
	  $('.registeredcancel').click(function () {
              
                            $('#loyalityid').val('');
                            var phone=$('#loyalitymob').val();
                            var name=$('#loyalityname').val();
                            var noofbillssplitted=$('#noofbillssplitted').val();
                            //alert(noofbillssplitted);
                            var bilno=$('#billnotoprint').val();//alert(bilno)
                            var printwithdiscount=$('#printwithdiscount').val();
                            var printwithloyality=$('#printwithloyality').val();
                            var staffwithdiscount=$('#staffwithdiscount').val();
                            if(printwithdiscount=='Y')
                                {
                                $('.loyalitypopup').css('display','none');
				$('.registerpopup').css('display','none');
				$('.disountenterpopup').css('display','block');
                                $('.confrmation_overlay').css('display','block');
                                }
                            else{
                                    var loyalityid=$('#loyalityid').val();
                                    $.post("load_billsplit.php", {billno:bilno,noofbillssplitted:noofbillssplitted,discamtdrop:'none',loyalityid:loyalityid,set:'proceedbill_split',mode:"withloyalty"},
                                    function(data)
                                        {
                                            data=$.trim(data);
                                            if(data.indexOf("exception") == -1)
                                            {
                                                                             /*$.post("load_billsplit.php", {set:'setwholedata'},
                                                                                    function(data)
                                                                                    {
                                                                                    data=$.trim(data);*/

                                                                                    //$('.loadsplittedlist').html(data);
                                                                                    
                                                $.post("print_details.php", {set:'billprint'},
                                                    function(data)
                                                    {
                                                        data=$.trim(data);
                                                        $(".error_feed").css("display","block");
                                                        $(".error_feed").addClass("billgenration_validate");
                                                        $(".error_feed").text("Bill Printed");
                                                        $(".error_feed").delay(2000).fadeOut('slow');
                                                        window.location='billsplited_view.php?msg=1'
                                                                                                                                                   
                                                    });	
                                                    // });	
                                                    }else
                                                    {
                                                        alert(data);
                                                    }
                                                    });
                                }
				 
			 
		}); 
	  
	  /*************************************** disount click ends ***********************************************************  */
	  
	   /*************************************** disount click starts *********************************************************  */  
	  $('.registeredok').click(function () {
		   
				  $('#loyalitymob').val('');
				  $('#loyalityname').val('');
				$('.loyalitypopup').css('display','block');
				$('.registerpopup').css('display','none');
				$('.confrmation_overlay').css('display','block');
			 
		}); 
	  
	  /*************************************** disount click ends ***********************************************************  */
	    /*************************************** loyality cancel click starts ******************************************************  */  
	  $('.loyalitycancel').click(function () {
		$('.disountenterpopup').css('display','none');
		$('.loyalitypopup').css('display','none');
		$('.registerpopup').css('display','none');
		$('.confrmation_overlay').css('display','none');
		}); 
	  
	  /*************************************** loyality cancel click ends *********************************************************  */
	  
	
	
	  
	   /*************************************** disount cancel click starts ******************************************************  */  
	  $('.canceldisount').click(function () {
		$('.disountenterpopup').css('display','none');
		$('.loyalitypopup').css('display','none');
		$('.registerpopup').css('display','none');
		$('.confrmation_overlay').css('display','none');
		}); 
	  
	  /*************************************** disount cancel click ends *********************************************************  */
	   /*************************************** disount click starts *********************************************************  */  
	  $('.loyalityok').click(function () {
		  
                                    $('#loyalityid').val('');
				  var phone=$('#loyalitymob').val();
				  var name=$('#loyalityname').val();
                                  var noofbillssplitted=$('#noofbillssplitted').val();
                                  //alert(noofbillssplitted);
                                  var bilno=$('#billnotoprint').val();//alert(bilno)
				 var printwithdiscount=$('#printwithdiscount').val();
				 var printwithloyality=$('#printwithloyality').val();
				 var staffwithdiscount=$('#staffwithdiscount').val();
                                  //alert(printwithdiscount);
                                   //alert("fbk");
//						   var id_str       =  $(this).attr("bilnosplt");
//						   //$('#billnotoprint').val(id_str);
//							  $('.disountenterpopup').css('display','none');
//							  $('.confrmation_overlay').css('display','none');
						   
				  
				  if(phone!='')
				  {
					   $.post("load_bill.php", {phone:phone,set:'checkloyalitydetailsbill'},
							function(data2)
							{
								data2=$.trim(data2);
                                                                
								if(data2=="sorry")
								{
								  $(".error_loyal").css("display","block");
								  //$(".error_loyal").addClass("billgenration_validate");
								  $(".error_loyal").text(data2);
								  $(".error_loyal").delay(2000).fadeOut('slow');
								}else 
								{   $('#loyalityid').val(data2);
                                                                    if(printwithdiscount=='Y')
                                                                        {
                                                                            $('.loyalitypopup').css('display','none');
									$('.registerpopup').css('display','none');
									$('.disountenterpopup').css('display','block');
                                                                        $('.confrmation_overlay').css('display','block');
                                                                        }
                                                                    else{
                                                                        
									
                                                                        $('.loyalitypopup').css('display','none');
									$('.registerpopup').css('display','none');
                                                                        var loyalityid=$('#loyalityid').val();
                                                                        
                                                                        $.post("load_billsplit.php", {billno:bilno,noofbillssplitted:noofbillssplitted,discamtdrop:'none',loyalityid:loyalityid,set:'proceedbill_split',mode:"withloyalty"},
                                                                        function(data)
                                                                        {

                                                                            data=$.trim(data);
                                                                            if(data.indexOf("exception") == -1)
                                                                            {
                                                                             /*$.post("load_billsplit.php", {set:'setwholedata'},
                                                                                    function(data)
                                                                                    {
                                                                                    data=$.trim(data);*/

                                                                                    //$('.loadsplittedlist').html(data);

                                                                                          $.post("print_details.php", {set:'billprint'},
                                                                                          function(data)
                                                                                          {
                                                                                          data=$.trim(data);

                                                                                           $(".error_feed").css("display","block");
                                                                                           $(".error_feed").addClass("billgenration_validate");
                                                                                           $(".error_feed").text("Bill Printed");
                                                                                           $(".error_feed").delay(2000).fadeOut('slow');

                                                                                           window.location='billsplited_view.php?msg=1'


                                                                                          });	


                                                                                   // });	

                                                                    }else
                                                                    {
                                                                            alert(data);
                                                                    }
                                                                    });
                                                                    }  
									
								}
									
							
							});	
				  }else if(name!='')
				  {
					  $.post("load_bill.php", {name:name,set:'checkloyalitydetailsbill'},
							function(data2)
							{
								data2=$.trim(data2);
								if(data2=="sorry")
								{
								  $(".error_loyal").css("display","block");
								  //$(".error_loyal").addClass("billgenration_validate");
								  $(".error_loyal").text(data2);
								  $(".error_loyal").delay(2000).fadeOut('slow');
								}else 
								{//alert(data2);
                                                                    if(printwithdiscount=='Y')
                                                                        {
                                                                         $('.loyalitypopup').css('display','none');
									$('.registerpopup').css('display','none');
									$('.disountenterpopup').css('display','block');
                                                                        $('.confrmation_overlay').css('display','block');
                                                                        
                                                                        }
                                                                        else{
									$('#loyalityid').val(data2);
									
									$('.loyalitypopup').css('display','none');
									$('.registerpopup').css('display','none');
                                                                        var loyalityid=$('#loyalityid').val();
                                                                        $.post("load_billsplit.php", {billno:bilno,noofbillssplitted:noofbillssplitted,discamtdrop:'none',loyalityid:loyalityid,set:'proceedbill_split',mode:"withloyalty"},
                                                                        function(data)
                                                                        {

                                                                            data=$.trim(data);
                                                                            if(data.indexOf("exception") == -1)
                                                                            {
                                                                             /*$.post("load_billsplit.php", {set:'setwholedata'},
                                                                                    function(data)
                                                                                    {
                                                                                    data=$.trim(data);*/

                                                                                    //$('.loadsplittedlist').html(data);

                                                                                          $.post("print_details.php", {set:'billprint'},
                                                                                          function(data)
                                                                                          {
                                                                                          data=$.trim(data);

                                                                                           $(".error_feed").css("display","block");
                                                                                           $(".error_feed").addClass("billgenration_validate");
                                                                                           $(".error_feed").text("Bill Printed");
                                                                                           $(".error_feed").delay(2000).fadeOut('slow');

                                                                                           window.location='billsplited_view.php?msg=1'


                                                                                          });	


                                                                                   // });	

                                                                    }else
                                                                    {
                                                                            alert(data);
                                                                    }
                                                                    });
									
                                                                        }
								}
									
							
							});	
				  }else
				  {
					   $(".error_loyal").css("display","block");
					  //$(".error_loyal").addClass("billgenration_validate");
					  $(".error_loyal").text("Enter Details");
					  $(".error_loyal").delay(2000).fadeOut('slow');
				  }
              
			   
			  
		}); 
	  
	  /*************************************** disount click ends ***********************************************************  */
	
	
  });