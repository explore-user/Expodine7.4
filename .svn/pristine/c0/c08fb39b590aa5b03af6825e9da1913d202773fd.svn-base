// JavaScript Document

$(document).ready(function(){
	
  
	
	/***************************************  print splitted starts ******************************************************************  */
 
    $('.printsplittedbill').click(function (event) {
		//alert("print");
                //$(this).unbind('click');
		var noofbillssplitted=$('#noofbillssplitted').val();
			if($('#printconfirmation').val()=="Y")
			{
				
				  $('.confrimprint').css('display','block');
				  $('.confrmation_overlay').css('display','block');
			}else
			{
				 var bilno=$(this).attr('bilnosplt');//alert(bilno)
				 var printwithdiscount=$('#printwithdiscount').val();
				 var printwithloyality=$('#printwithloyality').val();
				 var staffwithdiscount=$('#staffwithdiscount').val();
				$('#billnotoprint').val(bilno);
				   $("#loyalityid").val('');
				   if(printwithloyality=='N')
				   {
					   if(printwithdiscount=='Y' && staffwithdiscount =='Y' )
					   {
						   var id_str       =  $(this).attr("bilnosplt");
						   //$('#billnotoprint').val(id_str);
							  $('.disountenterpopup').css('display','block');
							  $('.confrmation_overlay').css('display','block');
						   }
						else 
					   {// without discount
					   
								  $.post("load_billsplit.php", {billno:bilno,noofbillssplitted:noofbillssplitted,set:'proceedbill_split'},
										function(data)
										{
											
											data=$.trim(data);
										  if(data.indexOf("exception") == -1)
											{
												/* $.post("load_billsplit.php", {set:'setwholedata'},
													function(data)
													{
													data=$.trim(data);
													
													$('.loadsplittedlist').html(data);*/
													
													  $.post("print_details.php", {set:'billprint'},
													  function(data)
													  {
													  data=$.trim(data);
													  
													   $(".error_feed").css("display","block");
													   $(".error_feed").addClass("billgenration_validate");
													   $(".error_feed").text("Bill Printed");
													   $(".error_feed").delay(2000).fadeOut('slow');
                                                                                                           //$(this).bind('click');
													    window.location='billsplited_view.php?msg=1'
													   
													  });	
													
													
													//});	
												
											}else
											{
												alert(data);
											}
											});
							
						
					   }
				   }else
				   {
					   
						  $('.registerpopup').css('display','block');
						  $('.confrmation_overlay').css('display','block');
						
				   }
			}
                        $('#disountamount_drop').val('none').attr('selected','selected');
             
                        $('#disountamount').val(''); 
                        $("#disountamount").prop("readonly",false);
                        $("#disountamount_drop").prop("disabled",false);
                         $('#P').prop('checked', true);
		 
			  
	});
        

	/*************************************** print splitted ends ******************************************************************  */

/*************************************** disount close click starts ******************************************************  */  
	  $('.closedisount').click(function () {//alert("close");
	   var discamtdrop=$("#disountamount_drop").val();
	   var discamt=$("#disountamount").val();
	  var loyalityid=$("#loyalityid").val();
	  var bilno=$('#billnotoprint').val();//alert(bilno)
	   var staffwithdiscountmanual=$("#staffwithdiscountmanual").val();
	  var noofbillssplitted=$('#noofbillssplitted').val();//alert(noofbillssplitted);
	  if(loyalityid=='')
	  {
		 loyalityid=0; 
	  }//alert(loyalityid);
	  if(staffwithdiscountmanual=="N" )
	  {
		  discamt=0;
		 // disctype="V";
	  }
	   if(discamtdrop!="none")
	   {//alert("notdisc");
		  $('.disountenterpopup').css('display','none');
		  $('.confrmation_overlay').css('display','none');
		  $("#disountamount").css("border","1px solid #847D7D");
		  $("#disountamount").val('0');
		  $('#disountamount_drop').find('option:first').attr('selected', 'selected');
		 // alert("hh");
		  //alert(bilno)
		  $.post("load_billsplit.php", {billno:bilno,noofbillssplitted:noofbillssplitted,discamtdrop:discamtdrop,loyalityid:loyalityid,set:'proceedbill_split',mode:"withdiscountdrop"},
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
			  // no need of closedirectfuncion
		  
			
	   }else
	   {// text box discount
	// alert("hh");
		//  alert(bilno)
	    // var disctype=$("input[name='typesel']:checked").val();//alert(disctype)
		  var disctype;
	   if(staffwithdiscountmanual=="N" )
	  {
		 // discamt=0;
		  disctype="V";
	  }else
	  {
	      disctype=$("input[name='typesel']:checked").val();//alert(disctype)
	  }
		 if((disctype=="P" && discamt<=100) || (disctype=="V"))
		 {
		   if(discamt>=0)
		  {
				$('.disountenterpopup').css('display','none');
				$('.confrmation_overlay').css('display','none');
				$("#disountamount").css("border","1px solid #847D7D");
				$("#disountamount").val('0');
				$('#disountamount_drop').find('option:first').attr('selected', 'selected');
				 
						//$.post("load_completedorder.php", {tabname:tablename,tableid:tabname,prefx:pref,discount:discamt,loyalityid:loyalityid,type:"text",disctype:disctype,ord:ordno,set:'proceedbill'},
						$.post("load_billsplit.php", {billno:bilno,noofbillssplitted:noofbillssplitted,discount:discamt,loyalityid:loyalityid,discamtdrop:discamtdrop,disctype:disctype,set:'proceedbill_split',mode:"withdiscounttext"}, 
						  function(data)
						  {
			  
						  data=$.trim(data);//alert(data);
						if(data.indexOf("exception") == -1)
						  {
							  /*$.post("load_billsplit.php", {set:'setwholedata'},
									  function(data)
									  {
									  data=$.trim(data);
									  
									  $('.loadsplittedlist').html(data);*/
									  
									    $.post("print_details.php", {set:'billprint'},
										function(data)
										{
										data=$.trim(data);
										
										 $(".error_feed").css("display","block");
										 $(".error_feed").addClass("billgenration_validate");
										 $(".error_feed").text("Bill Printed");
										 $(".error_feed").delay(2000).fadeOut('slow');
										  window.location='billsplited_view.php?msg=1'
										 
									//	});	
									  
									  
									  });	
							 
				  
			  }else
			  {
				  alert(data);
			  }
			  });
				
				
				
		  }else
		  {
			  $("#disountamount").css("border","1px solid #F00");
		  }
		 }else
		 {
			 $("#disountamount").css("border","1px solid #F00");
		 }
	   }
             
		}); 
	  
	  /*************************************** disount close click ends *********************************************************  */
	  });