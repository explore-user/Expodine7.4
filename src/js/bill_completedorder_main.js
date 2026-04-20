// JavaScript Document
$(document).ready(function(){
    
	/*************************************  floor selection starts **********************************************************  */
	$('#co_areachnage').change(function () { //alert("hi");	 
			  var flr_id=	$(this).val();
			 $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
			  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
				  function(data)
				  {
                                      //alert(data);
				  $('#load_listcompletedorders').html(data);
				  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
				  $('#listwholedetailslist').empty();
					$('.loadproceedbutton').css("display","none");		  
				  });
	});
			  
	/***************************************  floor selection ends **********************************************************  */
	 /*************************************** close verify starts *********************************************************  */  
	  $('.closeprintverify').click(function () {
		  
		  $('.confrimverify').css('display','none');
		  $('.confrimcancel').css('display','none');
		   $('.confrimenable').css('display','none');
		   $('.confrimeachcancel').css('display','none');
		   $('.loadcanceldetails').css('display','none');
		  $('.confrmation_overlay').css('display','none');
		  
	 }); 
	  
	  /***************************************  close verify ends ***********************************************************  */	
	  
	  /*************************************** ok verify starts *********************************************************  */  
	  $('.printverify').click(function () {
		  
		
		  var selected_activities =$('.tr_bill_gen_active');
			 var ordno = new Array(); 
			
			 selected_activities.each(function(){
			  var id_str       =  $(this).attr("ordno");
				  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ordno.push(id_str);
				  }
		
			});
			ordno=unique(ordno) 
			//alert(ordno)
		  $('.loadcancel').css("display","block");
		  $('.loadtotal').css("display","block");
		  $('#listwholedetailslist').load("load_completedorder.php?set=loadbillwholelist_co&ordno="+ordno);	
		  $('.loadproceedbutton').css("display","block");
		  
		  $('.confrimverify').css('display','none');
		  $('.confrimcancel').css('display','none');
		  $('.confrimenable').css('display','none');
		  $('.confrimeachcancel').css('display','none');
		  $('.loadcanceldetails').css('display','none');
		  $('.confrmation_overlay').css('display','none');
		  
		  
	 }); 
	  
	  /***************************************  ok verify ends ***********************************************************  */	
	/*************************************  verify starts **********************************************************  */
	
	 $('.verifycompletedorder').click(function (event) {
            
             var compordermsg2 = ($("#compordermsg1").val());
		if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
		{
			if($('#verifyconfirmation').val()=="Y")
			{
				$('.confrimverify').css('display','block');
				$('.confrmation_overlay').css('display','block');
			}else
			{
				 var selected_activities =$('.tr_bill_gen_active');
				 var ordno = new Array(); 
				
				 selected_activities.each(function(){
				  var id_str       =  $(this).attr("ordno");
					  if(id_str!='undefined' && id_str!='' && id_str!=null){
						  ordno.push(id_str);
					  }
			
				});
				ordno=unique(ordno) 
				//alert(ordno)
				$('.loadcancel').css("display","block");
				 $('.loadtotal').css("display","block");
				$('#listwholedetailslist').load("load_completedorder.php?set=loadbillwholelist_co&ordno="+ordno);	
				$('.loadproceedbutton').css("display","block");
			
			}
		
		}else
		{
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(compordermsg2);
			$(".error_feed").delay(2000).fadeOut('slow');
		}
	});
			  
	/***************************************  verify ends **********************************************************  */
	
	/*************************************  verify starts **********************************************************  */
	
	 $('.loadproceedbutton').click(function (event) {
	
	});
			  
	/***************************************  verify ends **********************************************************  */
	
	 /*************************************** close print confirm starts *********************************************************  */  
	  $('.closeprintconfirm').click(function () {
		  
		  $('.confrimprint').css('display','none');
		  $('.confrimcancel').css('display','none');
		   $('.confrimenable').css('display','none');
		   $('.confrimeachcancel').css('display','none');
		   $('.loadcanceldetails').css('display','none');
		  $('.confrmation_overlay').css('display','none');
		  
	 }); 
	  
	  /***************************************  close print confirm ends ***********************************************************  */
	  
	  /*************************************** ok print confirm  starts *********************************************************  */  
	  $('.printconfirm').click(function () {
		  var compordermsg3 = ($("#compordermsg1").val());
		 $('.confrimprint').css('display','none');
		$('.confrimcancel').css('display','none');
		 $('.confrimenable').css('display','none');
		 $('.confrimeachcancel').css('display','none');
		 $('.loadcanceldetails').css('display','none');
		$('.confrmation_overlay').css('display','none');
		  
		  
		  
		  var printwithdiscount=$('#printwithdiscount').val();
			 var printwithloyality=$('#printwithloyality').val();
			 $("#loyalityid").val('');
			 if(printwithloyality=='N')
			 {
				 if(printwithdiscount=='N')
				 {
					 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
					  {
							 var selected_activities =$('.tr_bill_gen_active');
							 var ordno = new Array(); 
							 var tablename=new Array();
							 selected_activities.each(function(){
							  var id_str       =  $(this).attr("ordno");
								  if(id_str!='undefined' && id_str!='' && id_str!=null){
									  ordno.push(id_str);
								  }
								   var tablename_str       =  $(this).attr("tablename");
								  if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
									  tablename.push(tablename_str);
								  }
						
							});
							ordno=unique(ordno) 
							
							$.post("load_completedorder.php", {tabname:tablename,ord:ordno,set:'proceedbill'},
								  function(data)
								  {
								  data=$.trim(data);
								  
								  if(data=='')
								  {
								   $.post("print_details.php", {set:'billprint'},
								  function(data)
								  {
								  data=$.trim(data);
								  
								   
		  						var bilpt=$('#bilprintmsg').val();
								   $(".error_feed").css("display","block");
								   $(".error_feed").addClass("billgenration_validate");
								   $(".error_feed").text(bilpt);
								   $(".error_feed").delay(2000).fadeOut('slow');
								  });	
								  }else
								  {
									  alert(data);
								  }
							 });
					  }else
					  {
						  $(".error_feed").css("display","block");
						  $(".error_feed").addClass("billgenration_validate");
						  $(".error_feed").text(copmordermsg3);
						  $(".error_feed").delay(2000).fadeOut('slow');
					  }
				  
				
				 }else
				 {
					 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
					  {
						$('.disountenterpopup').css('display','block');
						$('.confrmation_overlay').css('display','block');
					  }else
					  {
						  $(".error_feed").css("display","block");
						  $(".error_feed").addClass("billgenration_validate");
						  $(".error_feed").text(compordermsg3);
						  $(".error_feed").delay(2000).fadeOut('slow');
					  }
				 }
			 }else
			 {
				 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
					{
					$('.registerpopup').css('display','block');
					$('.confrmation_overlay').css('display','block');
				  }else
				  {
					  $(".error_feed").css("display","block");
					  $(".error_feed").addClass("billgenration_validate");
					  $(".error_feed").text("Select tables to Proceed");
					  $(".error_feed").delay(2000).fadeOut('slow');
				  }
			 }
		  
	 }); 
	  
	  /***************************************  ok print confirm  ends ***********************************************************  */	
	
	/***************************************  print page starts ******************************************************************  */
	 $('.printcompletedorder').click(function () {
            
		 var compordermsg1 = ($("#compordermsg1").val());
		 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
		{
			
			if($('#printconfirmation').val()=="Y")
			{
				
				  $('.confrimprint').css('display','block');
				  $('.confrmation_overlay').css('display','block');
			}else
			{
			
				   var printwithdiscount=$('#printwithdiscount').val();
				
			
				   var printwithloyality=$('#printwithloyality').val();
				 var staffwithdiscount=$('#staffwithdiscount').val();
				
				   $("#loyalityid").val('');
				   if(printwithloyality=='N')
				   {
					   if(printwithdiscount=='Y' && staffwithdiscount =='Y' )
					   {
						 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
							{
								
							  $('.disountenterpopup').css('display','block');
							  $('.confrmation_overlay').css('display','block');
							}else
							{
								$(".error_feed").css("display","block");
								$(".error_feed").addClass("billgenration_validate");
								$(".error_feed").text(compordermsg1);
								$(".error_feed").delay(2000).fadeOut('slow');
							}
						   
						   }
						else 
					   {
//                                               alert('2');
//                                               $('.printcompletedorder').addClass('bill_print_btn_disable');
                                                $('.new_print_loading_bill').show();

						   if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
							{
								var bilpt=$('#bilprintmsg').val();
								   var selected_activities =$('.tr_bill_gen_active');
								   var ordno = new Array(); 
								   var tablename=new Array();
								   selected_activities.each(function(){
									var id_str       =  $(this).attr("ordno");
										if(id_str!='undefined' && id_str!='' && id_str!=null){
											ordno.push(id_str);
										}
										 var tablename_str       =  $(this).attr("tablename");
										if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
											tablename.push(tablename_str);
										}
							  
								  });
								  ordno=unique(ordno) ;
								  
								  $.post("load_completedorder.php", {tabname:tablename,ord:ordno,set:'proceedbill'},
										function(data)
										{
										data=$.trim(data);
										//alert(data);
										if(data.indexOf("exception") == -1)
										{
										 $.post("print_details.php", {set:'billprint'},
										function(data2)
										{
										data2=$.trim(data2);
										
										
										
										var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data1)
											  {
                                                                                              
											  $('#load_listcompletedorders').html(data1);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");
												$('#totalrate').text('');
                                                                                                
                                                                                                //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
											  });
										
										
										 $(".error_feed").css("display","block");
										 $(".error_feed").addClass("billgenration_validate");
										 
										 if(data=="Error..In Bill Generatation")
								  {
									  var hidbillgenerate_error=$('#hidbillgenerate_error').val();
									   $(".error_feed").text(hidbillgenerate_error);
								  }else if(data=="Orders pending to be served")
								  {
									  var hidbillgenerate_pend=$('#hidbillgenerate_pend').val();
									   $(".error_feed").text(hidbillgenerate_pend);
								  }else if(data=="Bill generated sucessfully")
								  {
									  var hidbillgenerate_bill=$('#hidbillgenerate_bill').val();
									   $(".error_feed").text(hidbillgenerate_bill);
								  }
										 
										 
										// $(".error_feed").text(bilpt);
										 $(".error_feed").delay(2000).fadeOut('slow');
										});	
										}else
										{
											alert(data);
										}
								   });
							}else
							{
								$(".error_feed").css("display","block");
								$(".error_feed").addClass("billgenration_validate");
								$(".error_feed").text(compordermsg1);
								$(".error_feed").delay(2000).fadeOut('slow');
							}
						
						 /*  if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
							{
								
							  $('.disountenterpopup').css('display','block');
							  $('.confrmation_overlay').css('display','block');
							}else
							{
								$(".error_feed").css("display","block");
								$(".error_feed").addClass("billgenration_validate");
								$(".error_feed").text("Select tables to Proceed");
								$(".error_feed").delay(2000).fadeOut('slow');
							}*/
					   }
				   }else
				   {
					   if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
						  {
						  $('.registerpopup').css('display','block');
						  $('.confrmation_overlay').css('display','block');
						}else
						{
							$(".error_feed").css("display","block");
							$(".error_feed").addClass("billgenration_validate");
							$(".error_feed").text(compordermsg1);
							$(".error_feed").delay(2000).fadeOut('slow');
						}
				   }
			}
		 }else
		{
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(compordermsg1);
			$(".error_feed").delay(2000).fadeOut('slow');
		}
			  
	});
	/***************************************  proceed to 3rd page ends ******************************************************************  */
	
	  /*************************************** registered no starts *********************************************************  */  
	  $('.registeredcancel').click(function () {
               var compordermsg4 = ($("#compordermsg1").val());
		  if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
					{
                                            
                                         var staffwithdiscount12=$('#staffwithdiscount').val();
                                                                        var printwithdiscount12=$('#printwithdiscount').val();
                                                                        if(printwithdiscount12=="Y" && staffwithdiscount12=="Y"){   
                                            
				  $('.disountenterpopup').css('display','block');
                                                                        }else{
                                                                            $('.disountenterpopup').css('display','none'); 
                                                                        }
				$('.loyalitypopup').css('display','none');
				$('.registerpopup').css('display','none');
                                if(printwithdiscount12=="Y" && staffwithdiscount12=="Y"){  
				$('.confrmation_overlay').css('display','block');
                            }else{
                               $('.confrmation_overlay').css('display','none'); 
                            }
			  }else
			  {
				  $(".error_feed").css("display","block");
				  $(".error_feed").addClass("billgenration_validate");
			 	  $(".error_feed").text(compordermsg4);
				  $(".error_feed").delay(2000).fadeOut('slow');
			  }
                       
         var staffwithdiscount181=$('#staffwithdiscount').val();
                   var printwithdiscount181=$('#printwithdiscount').val();
                       if(printwithdiscount181=="N"){
                  // $('.closedisount').click();
                   $('.new_print_loading_bill').show();
              //$('.printcompletedorder').addClass('bill_print_btn_disable');
             
              //alert('hi');
	   var discamtdrop=$("#disountamount_drop").val();
	   var discamt=$("#disountamount").val();
	  var loyalityid=$("#loyalityid").val();
	  var staffwithdiscountmanual=$("#staffwithdiscountmanual").val();
	  if(loyalityid=='')
	  {
		 loyalityid=0; 
	  }
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
		  var selected_activities =$('.tr_bill_gen_active');
						 var ordno = new Array(); 
						 var tabname= new Array();
						 var pref= new Array();
						 var tablename=new Array();
						 selected_activities.each(function(){
						  var id_str       =  $(this).attr("ordno");
							  if(id_str!='undefined' && id_str!='' && id_str!=null){
								  ordno.push(id_str);
							  }
						 var tabname_str       =  $(this).attr("tabname");
							  if(tabname_str!='undefined' && tabname_str!='' && tabname_str!=null){
								  tabname.push(id_str);
							  }	  
					 	var pref_str       =  $(this).attr("pref");
							  if(pref_str!='undefined' && pref_str!='' && pref_str!=null){
								  pref.push(pref_str);
							  }
							  var tablename_str       =  $(this).attr("tablename");
							  if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
								  tablename.push(tablename_str);
							  }
							  
							  
						});
						ordno=unique(ordno) 
						//alert(ordno)	
						$.post("load_completedorder.php", {tabname:tablename,tableid:tabname,prefx:pref,discount:discamtdrop,loyalityid:loyalityid,type:"drop",ord:ordno,set:'proceedbill'},
						  function(data)
						  {
                                                     //alert(data);
						  data=$.trim(data);
                                                  
						  $.post("print_details.php", {set:'billprint'},
						  function(data1)
						  {
                                                                    //alert(data1); 
						  data1=$.trim(data1);
                                   
						  if(data.indexOf("exception") == -1)
							{
								
								if($('#discstatus').val()=="Y")
								{
								
							var hidbillclose_null=$('#hidbillclose_null').val();
								var proc_billgenerate_split=$('#proc_billgenerate_split').val();	
						   $.post("load_bill.php", {set:'closedirectfuncion'},
							function(data2)
							{
								data2=$.trim(data2);
								
								if(data2.indexOf("exception") == -1)
										{
											 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");
                                                                                                 //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
                                                                                                
											  });
											//alert(data2);  
										   $(".error_feed").css("display","block");
										  $(".error_feed").addClass("billgenration_validate");
										  if(data2=="Bill Number is Null")
												{
												$(".error_feed").text(hidbillclose_null);
												}else if(data2=="Bill Closed without Payment")
												{
													$(".error_feed").text(proc_billgenerate_split);
												}
										  $(".error_feed").delay(2000).fadeOut('slow');
										  $('#discstatus').val('');
										}else
										{
											alert(data2)
										}
										
								
							
							});	
								}else
								{
									 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");	
                                                                                                 //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
											  });
										//alert(data);	  
										   $(".error_feed").css("display","block");
										  $(".error_feed").addClass("billgenration_validate");
										  $(".error_feed").text(data);
										  $(".error_feed").delay(2000).fadeOut('slow');
										  $('#discstatus').val('');
								}
						  }else {
							alert(data);  
						  }
						 });	
                                                 
				 	 });
			
			
	   }else  
	   {// text box discount
	  // alert("jj");
	  //alert("disc");
	  var disctype;
	   if(staffwithdiscountmanual=="N" )
	  {
		 // discamt=0;
		  disctype="V";
	  }else
	  {
	      disctype=$("input[name='typesel']:checked").val();//alert(disctype)
	  }//alert(disctype) ; alert(discamt)
		 if((disctype=="P" && discamt<=100) || (disctype=="V"))
		 {
		   if(discamt>=0)
		  {//alert("j");
				$('.disountenterpopup').css('display','none');
				$('.confrmation_overlay').css('display','none');
				//("#disountamount").css("border","1px solid #847D7D");
				//$("#disountamount").val('0');
				//$('#disountamount_drop').find('option:first').attr('selected', 'selected');
				 var selected_activities =$('.tr_bill_gen_active');
						 var ordno = new Array(); 
						 var tabname= new Array();
						 var pref= new Array();
						 var tablename=new Array();
						 selected_activities.each(function(){
						  var id_str       =  $(this).attr("ordno");
							  if(id_str!='undefined' && id_str!='' && id_str!=null){
								  ordno.push(id_str);
							  }
						 var tabname_str       =  $(this).attr("tabname");
							  if(tabname_str!='undefined' && tabname_str!='' && tabname_str!=null){
								  tabname.push(id_str);
							  }	  
					 	var pref_str       =  $(this).attr("pref");
							  if(pref_str!='undefined' && pref_str!='' && pref_str!=null){
								  pref.push(pref_str);
							  }
							  var tablename_str       =  $(this).attr("tablename");
							  if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
								  tablename.push(tablename_str);
							  }
							  
							  
						});
						ordno=unique(ordno) 
						//alert("tabname="+tablename +" tabname="+ tabname + " pref=" + pref +" discamt=" +discamt +" loyalityid="+loyalityid + " disctype="+disctype +" ordno="+ordno );
						var hidbillclose_null=$('#hidbillclose_null').val();
								var proc_billgenerate_split=$('#proc_billgenerate_split').val();
						//alert(tabname+pref)	
						$.post("load_completedorder.php", {tabname:tablename,tableid:tabname,prefx:pref,discount:discamt,loyalityid:loyalityid,type:"text",disctype:disctype,ord:ordno,set:'proceedbill'},
						  function(data)
						  {
                                                      
						  data=$.trim(data);
                                                  
						  $.post("print_details.php", {set:'billprint'},
						  function(data1)
						  {
						  data1=$.trim(data1);//alert(data);
						  if(data.indexOf("exception") == -1)
							{
								
								if($('#discstatus').val()=="Y")
								{		
						   $.post("load_bill.php", {set:'closedirectfuncion'},
							function(data2)
							{
								data2=$.trim(data2);
//								
								if(data2.indexOf("exception") == -1)
										{
											
											 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");	
                                                                                                 //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
											  });
											
											//alert(data2);
											$('#discstatus').val('');
											$(".error_feed").css("display","block");
											$(".error_feed").addClass("billgenration_validate");
											if(data2==hidbillclose_null)
												{
												$(".error_feed").text(hidbillclose_null);
												}else if(data2==proc_billgenerate_split)
												{
													$(".error_feed").text(proc_billgenerate_split);
												}
											$(".error_feed").delay(2000).fadeOut('slow');
										}else {
											alert(data2)
										}
								
							
							});	
							
								}else
								{
									 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
                                                                                             
                                                                                              
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");	
                                                                                                //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
											  });
											
											$('#discstatus').val('');
											//alert(data);
											$(".error_feed").css("display","block");
											$(".error_feed").addClass("billgenration_validate");
											$(".error_feed").text(data);
											$(".error_feed").delay(2000).fadeOut('slow');
								}
						  }else
						  {alert(data);
						  }
							
						 });	
                                                 
				 	 });
				
				
				
		  }else
		  {//alert("h");
			  $("#disountamount").css("border","1px solid #F00");
		  }
		 }else
		 {
			 $("#disountamount").css("border","1px solid #F00");
		 }
	   }
              location.reload();
          }
              
		}); 
	  
	  /*************************************** disount click ends ***********************************************************  */
	  
	   /*************************************** disount click starts *********************************************************  */  
	  $('.registeredok').click(function () {
           var compordermsg5 = ($("#compordermsg1").val());
		  if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
					{
				  $('#loyalitymob').val('');
				  $('#loyalityname').val('');
				$('.loyalitypopup').css('display','block');
				$('.registerpopup').css('display','none');
				$('.confrmation_overlay').css('display','block');
			  }else
			  {
				  $(".error_feed").css("display","block");
				  $(".error_feed").addClass("billgenration_validate");
			 	  $(".error_feed").text(compordermsg5);
				  $(".error_feed").delay(2000).fadeOut('slow');
			  }
                          
		}); 
	  
	  /*************************************** disount click ends ***********************************************************  */
	  
	   /*************************************** disount close click starts ******************************************************  */  
	  $('.closedisount').click(function (event) {
            
             event.stopImmediatePropagation();
                var billname='';
                var billnum='';
                var billgst='';
                
               
                                                                     var billname=$('#billname').val();
                                                                   var billnum=$('#billnum').val();
                                                                    var billgst=$('#billgst').val();
                                                                    
                                                                    if(!$('#billname').length){
                                                                        
                                                                        var billname='';
                                                                    }
                                                                    if(!$('#billnum').length){
                                                                        var billnum='';
                                                                    }
                                                                    if(!$('#billgst').length){
                                                                        var billgst='';
                                                                    }
                                                                  
//$('.new_print_loading_bill').show();
              //$('.printcompletedorder').addClass('bill_print_btn_disable');
             
              //alert('hi');
	   var discamtdrop=$("#disountamount_drop").val();
           
	   var discamt=$("#disountamount").val();
	  var loyalityid=$("#loyalityid").val();
	  var staffwithdiscountmanual=$("#staffwithdiscountmanual").val();
	  if(loyalityid=='')
	  {
		 loyalityid=0; 
	  }
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
		  var selected_activities =$('.tr_bill_gen_active');
						 var ordno = new Array(); 
						 var tabname= new Array();
						 var pref= new Array();
						 var tablename=new Array();
						 selected_activities.each(function(){
						  var id_str       =  $(this).attr("ordno");
							  if(id_str!='undefined' && id_str!='' && id_str!=null){
								  ordno.push(id_str);
							  }
						 var tabname_str       =  $(this).attr("tabname");
							  if(tabname_str!='undefined' && tabname_str!='' && tabname_str!=null){
								  tabname.push(id_str);
							  }	  
					 	var pref_str       =  $(this).attr("pref");
							  if(pref_str!='undefined' && pref_str!='' && pref_str!=null){
								  pref.push(pref_str);
							  }
							  var tablename_str       =  $(this).attr("tablename");
							  if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
								  tablename.push(tablename_str);
							  }
							  
							  
						});
						ordno=unique(ordno) 
						
						$.post("load_completedorder.php", {tabname:tablename,tableid:tabname,prefx:pref,discount:discamtdrop,loyalityid:loyalityid,type:"drop",ord:ordno,billname:billname,billnum:billnum,billgst:billgst,set:'proceedbill'},
						  function(data)
						  { 
                                                     $('.new_print_loading_bill').show();
						  data=$.trim(data);
                                                  
						  $.post("print_details.php", {set:'billprint'},
						  function(data1)
						  {     
                                                                    //alert(data1); 
						  data1=$.trim(data1);
                                   
						  if(data.indexOf("exception") == -1)
							{
								
								if($('#discstatus').val()=="Y")
								{
								
							var hidbillclose_null=$('#hidbillclose_null').val();
								var proc_billgenerate_split=$('#proc_billgenerate_split').val();	
						   $.post("load_bill.php", {set:'closedirectfuncion'},
							function(data2)
							{
								data2=$.trim(data2);
								
								if(data2.indexOf("exception") == -1)
										{
											 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");
                                                                                                 //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
                                                                                                
											  });
											//alert(data2);  
										   $(".error_feed").css("display","block");
										  $(".error_feed").addClass("billgenration_validate");
										  if(data2=="Bill Number is Null")
												{
												$(".error_feed").text(hidbillclose_null);
												}else if(data2=="Bill Closed without Payment")
												{
													$(".error_feed").text(proc_billgenerate_split);
												}
										  $(".error_feed").delay(2000).fadeOut('slow');
										  $('#discstatus').val('');
										}else
										{
											alert(data2)
										}
										
								
							
							});	
								}else
								{
									 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");	
                                                                                                 //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
											  });
										//alert(data);	  
										   $(".error_feed").css("display","block");
										  $(".error_feed").addClass("billgenration_validate");
										  $(".error_feed").text(data);
										  $(".error_feed").delay(2000).fadeOut('slow');
										  $('#discstatus').val('');
								}
						  }else {
							alert(data);  
						  }
						 });	
                                                 
				 	 });
			
			
	   }
           else  
	   {// text box discount
	  // alert("jj");
	  //alert("disc");
	  var disctype='';
          var type='';
	   if(staffwithdiscountmanual=="N" )
	  {
		 // discamt=0;
		  disctype="V";
	  }else
	  {     if(discamt!=''){
	      disctype=$("input[name='typesel']:checked").val();//alert(disctype)
                var type='text';
                }
	  }//alert(disctype) ; alert(discamt)
		 if((disctype=="P" && discamt<=100) || (disctype=="V") ||disctype=='')
		 {
		   if(discamt>=0)
		  {//alert("j");
				$('.disountenterpopup').css('display','none');
				$('.confrmation_overlay').css('display','none');
				//("#disountamount").css("border","1px solid #847D7D");
				//$("#disountamount").val('0');
				//$('#disountamount_drop').find('option:first').attr('selected', 'selected');
				 var selected_activities =$('.tr_bill_gen_active');
						 var ordno = new Array(); 
						 var tabname= new Array();
						 var pref= new Array();
						 var tablename=new Array();
						 selected_activities.each(function(){
						  var id_str       =  $(this).attr("ordno");
							  if(id_str!='undefined' && id_str!='' && id_str!=null){
								  ordno.push(id_str);
							  }
						 var tabname_str       =  $(this).attr("tabname");
							  if(tabname_str!='undefined' && tabname_str!='' && tabname_str!=null){
								  tabname.push(id_str);
							  }	  
					 	var pref_str       =  $(this).attr("pref");
							  if(pref_str!='undefined' && pref_str!='' && pref_str!=null){
								  pref.push(pref_str);
							  }
							  var tablename_str       =  $(this).attr("tablename");
							  if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
								  tablename.push(tablename_str);
							  }
							  
							  
						});
						ordno=unique(ordno) 
                                                
						//alert("tabname="+tablename +" tabname="+ tabname + " pref=" + pref +" discamt=" +discamt +" loyalityid="+loyalityid + " disctype="+disctype +" ordno="+ordno );
						var hidbillclose_null=$('#hidbillclose_null').val();
								var proc_billgenerate_split=$('#proc_billgenerate_split').val();
						//alert(tabname+pref)	
						$.post("load_completedorder.php", {tabname:tablename,tableid:tabname,prefx:pref,discount:discamt,loyalityid:loyalityid,type:type,disctype:disctype,ord:ordno,billname:billname,billnum:billnum,billgst:billgst,set:'proceedbill'},
						  function(data)
						  {
                                                      $('.new_print_loading_bill').show();
						  data=$.trim(data);
                                                  
						  $.post("print_details.php", {set:'billprint'},
						  function(data1)
						  {
						  data1=$.trim(data1);//alert(data);
						  if(data.indexOf("exception") == -1)
							{
								
								if($('#discstatus').val()=="Y")
								{		
						   $.post("load_bill.php", {set:'closedirectfuncion'},
							function(data2)
							{
								data2=$.trim(data2);
//								
								if(data2.indexOf("exception") == -1)
										{
											
											 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");	
                                                                                                 //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
											  });
											
											//alert(data2);
											$('#discstatus').val('');
											$(".error_feed").css("display","block");
											$(".error_feed").addClass("billgenration_validate");
											if(data2==hidbillclose_null)
												{
												$(".error_feed").text(hidbillclose_null);
												}else if(data2==proc_billgenerate_split)
												{
													$(".error_feed").text(proc_billgenerate_split);
												}
											$(".error_feed").delay(2000).fadeOut('slow');
										}else {
											alert(data2)
										}
								
							
							});	
							
								}else
								{
									 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
                                                                                             
                                                                                              
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");	
                                                                                                //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
											  });
											
											$('#discstatus').val('');
											//alert(data);
											$(".error_feed").css("display","block");
											$(".error_feed").addClass("billgenration_validate");
											$(".error_feed").text(data);
											$(".error_feed").delay(2000).fadeOut('slow');
								}
						  }else
						  {alert(data);
						  }
							
						 });	
                                                 
				 	 });
				
				
				
		  }else
		  {//alert("h");
			  $("#disountamount").css("border","1px solid #F00");
		  }
		 }else
		 {  alert("Invalid Discount Percentage");
			 $("#disountamount").css("border","1px solid #F00");
		 }
	   }
             
             $('#disountamount_drop').val('none').attr('selected','selected');
             
             $('#disountamount').val(''); 
             $("#disountamount").prop("readonly",false);
             $("#disountamount_drop").prop("disabled",false);
             $('#P').prop('checked', true);
                $('#billname').val('');
                $('#billnum').val('');
                $('#billgst').val('');
     
                }); 
	  
	  /*************************************** disount close click ends *********************************************************  */
	  
	  
	   /*************************************** disount cancel click starts ******************************************************  */  
	  $('.canceldisount').click(function () {
            $('#disountamount').val('');
             
            location.reload();  
              
		$('.disountenterpopup').css('display','none');
		$('.loyalitypopup').css('display','none');
		$('.registerpopup').css('display','none');
		$('.confrmation_overlay').css('display','none');
                
//                $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
		}); 
	  
	  /*************************************** disount cancel click ends *********************************************************  */
	  
	  
	   
	   /*************************************** loyality cancel click starts ******************************************************  */  
	  $('.loyalitycancel').click(function () {
		$('.disountenterpopup').css('display','none');
		$('.loyalitypopup').css('display','none');
		$('.registerpopup').css('display','none');
		$('.confrmation_overlay').css('display','none');
                
//                $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                
		}); 
	  
	  /*************************************** loyality cancel click ends *********************************************************  */
	  
	  
	  /*************************************** disount click starts *********************************************************  */  
	  $('.loyalityok').click(function () {
             
 
                 
                
              var compordermsg6 = ($("#compordermsg1").val());
		  if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
			  {
			  		$('#loyalityid').val('');
				  var phone=$('#loyalitymob').val();
				  var name=$('#loyalityname').val();
				  
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
								{
									$('#loyalityid').val(data2);
                                                                         var staffwithdiscount13=$('#staffwithdiscount').val();
                                                                        var printwithdiscount13=$('#printwithdiscount').val();
                                                                        if(printwithdiscount13=="Y" && staffwithdiscount13=="Y"){
									$('.disountenterpopup').css('display','block');
                                                                    }else{
                                                                        $('.disountenterpopup').css('display','none');
                                                                    }
									$('.loyalitypopup').css('display','none');
									$('.registerpopup').css('display','none');
                                                                        if(printwithdiscount13=="Y" && staffwithdiscount13=="Y"){
									$('.confrmation_overlay').css('display','block');
                                                                    }else{
                                                                        $('.confrmation_overlay').css('display','none');
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
								{
                                                                    
									$('#loyalityid').val(data2);
                                                                         var staffwithdiscount1=$('#staffwithdiscount').val();
                                                                        var printwithdiscount1=$('#printwithdiscount').val();
                                                                        if(printwithdiscount1=="Y" && staffwithdiscount1=="Y"){
									$('.disountenterpopup').css('display','block');
                                                                }else{
                                                                    
                                                                  $('.disountenterpopup').css('display','none');  
                                                                }
									$('.loyalitypopup').css('display','none');
									$('.registerpopup').css('display','none');
                                                                        if(printwithdiscount1=="Y" && staffwithdiscount1=="Y" ){
									$('.confrmation_overlay').css('display','block');
								}else{
                                                                    $('.confrmation_overlay').css('display','none');
                                                                }
                                                            }
									
							
							});	
				  }
				  
			   
			  }else
			  {
				  $(".error_feed").css("display","block");
				  $(".error_feed").addClass("billgenration_validate");
			 	  $(".error_feed").text(compordermsg6);
				  $(".error_feed").delay(2000).fadeOut('slow');
			  }
                           
//                      }
//                  });
                  
                var staffwithdiscount18=$('#staffwithdiscount').val();
                   var printwithdiscount18=$('#printwithdiscount').val();
                       if(printwithdiscount18=="N"){
                  // $('.closedisount').click();
                   $('.new_print_loading_bill').show();
              //$('.printcompletedorder').addClass('bill_print_btn_disable');
             
              //alert('hi');
	   var discamtdrop=$("#disountamount_drop").val();
	   var discamt=$("#disountamount").val();
	  var loyalityid=$("#loyalityid").val();
	  var staffwithdiscountmanual=$("#staffwithdiscountmanual").val();
	  if(loyalityid=='')
	  {
		 loyalityid=0; 
	  }
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
		  var selected_activities =$('.tr_bill_gen_active');
						 var ordno = new Array(); 
						 var tabname= new Array();
						 var pref= new Array();
						 var tablename=new Array();
						 selected_activities.each(function(){
						  var id_str       =  $(this).attr("ordno");
							  if(id_str!='undefined' && id_str!='' && id_str!=null){
								  ordno.push(id_str);
							  }
						 var tabname_str       =  $(this).attr("tabname");
							  if(tabname_str!='undefined' && tabname_str!='' && tabname_str!=null){
								  tabname.push(id_str);
							  }	  
					 	var pref_str       =  $(this).attr("pref");
							  if(pref_str!='undefined' && pref_str!='' && pref_str!=null){
								  pref.push(pref_str);
							  }
							  var tablename_str       =  $(this).attr("tablename");
							  if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
								  tablename.push(tablename_str);
							  }
							  
							  
						});
						ordno=unique(ordno) 
						//alert(ordno)	
                                                
                                                                var billname=$('#billname').val();
                                                                   var billnum=$('#billnum').val();
                                                                    var billgst=$('#billgst').val();
                                              
						$.post("load_completedorder.php", {tabname:tablename,tableid:tabname,prefx:pref,discount:discamtdrop,loyalityid:loyalityid,type:"drop",ord:ordno,billname:billname,billnum:billnum,billgst:billgst,set:'proceedbill'},
						  function(data)
						  {
                                                     //alert(data);
						  data=$.trim(data);
                                                  
						  $.post("print_details.php", {set:'billprint'},
						  function(data1)
						  {
                                                                    //alert(data1); 
						  data1=$.trim(data1);
                                   
						  if(data.indexOf("exception") == -1)
							{
								
								if($('#discstatus').val()=="Y")
								{
								
							var hidbillclose_null=$('#hidbillclose_null').val();
								var proc_billgenerate_split=$('#proc_billgenerate_split').val();	
						   $.post("load_bill.php", {set:'closedirectfuncion'},
							function(data2)
							{
								data2=$.trim(data2);
								
								if(data2.indexOf("exception") == -1)
										{
											 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");
                                                                                                 //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
                                                                                                
											  });
											//alert(data2);  
										   $(".error_feed").css("display","block");
										  $(".error_feed").addClass("billgenration_validate");
										  if(data2=="Bill Number is Null")
												{
												$(".error_feed").text(hidbillclose_null);
												}else if(data2=="Bill Closed without Payment")
												{
													$(".error_feed").text(proc_billgenerate_split);
												}
										  $(".error_feed").delay(2000).fadeOut('slow');
										  $('#discstatus').val('');
										}else
										{
											alert(data2)
										}
										
								
							
							});	
								}else
								{
									 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");	
                                                                                                 //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
											  });
										//alert(data);	  
										   $(".error_feed").css("display","block");
										  $(".error_feed").addClass("billgenration_validate");
										  $(".error_feed").text(data);
										  $(".error_feed").delay(2000).fadeOut('slow');
										  $('#discstatus').val('');
								}
						  }else {
							alert(data);  
						  }
						 });	
                                                 
				 	 });
			
			
	   }else  
	   {// text box discount
	  // alert("jj");
	  //alert("disc");
	  var disctype;
	   if(staffwithdiscountmanual=="N" )
	  {
		 // discamt=0;
		  disctype="V";
	  }else
	  {
	      disctype=$("input[name='typesel']:checked").val();//alert(disctype)
	  }//alert(disctype) ; alert(discamt)
		 if((disctype=="P" && discamt<=100) || (disctype=="V"))
		 {
		   if(discamt>=0)
		  {//alert("j");
				$('.disountenterpopup').css('display','none');
				$('.confrmation_overlay').css('display','none');
				//("#disountamount").css("border","1px solid #847D7D");
				//$("#disountamount").val('0');
				//$('#disountamount_drop').find('option:first').attr('selected', 'selected');
				 var selected_activities =$('.tr_bill_gen_active');
						 var ordno = new Array(); 
						 var tabname= new Array();
						 var pref= new Array();
						 var tablename=new Array();
						 selected_activities.each(function(){
						  var id_str       =  $(this).attr("ordno");
							  if(id_str!='undefined' && id_str!='' && id_str!=null){
								  ordno.push(id_str);
							  }
						 var tabname_str       =  $(this).attr("tabname");
							  if(tabname_str!='undefined' && tabname_str!='' && tabname_str!=null){
								  tabname.push(id_str);
							  }	  
					 	var pref_str       =  $(this).attr("pref");
							  if(pref_str!='undefined' && pref_str!='' && pref_str!=null){
								  pref.push(pref_str);
							  }
							  var tablename_str       =  $(this).attr("tablename");
							  if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
								  tablename.push(tablename_str);
							  }
							  
							  
						});
						ordno=unique(ordno) 
						//alert("tabname="+tablename +" tabname="+ tabname + " pref=" + pref +" discamt=" +discamt +" loyalityid="+loyalityid + " disctype="+disctype +" ordno="+ordno );
						var hidbillclose_null=$('#hidbillclose_null').val();
								var proc_billgenerate_split=$('#proc_billgenerate_split').val();
						//alert(tabname+pref)	
                                             billname=$('#billname').val();
                                                                 billnum=$('#billnum').val();
                                                               billgst=$('#billgst').val();
						$.post("load_completedorder.php", {tabname:tablename,tableid:tabname,prefx:pref,discount:discamt,loyalityid:loyalityid,type:"text",disctype:disctype,ord:ordno,billname:billname,billnum:billnum,billgst:billgst,set:'proceedbill'},
						  function(data)
						  {
                                                      
						  data=$.trim(data);
                                                  
						  $.post("print_details.php", {set:'billprint'},
						  function(data1)
						  {
						  data1=$.trim(data1);//alert(data);
						  if(data.indexOf("exception") == -1)
							{
								
								if($('#discstatus').val()=="Y")
								{		
						   $.post("load_bill.php", {set:'closedirectfuncion'},
							function(data2)
							{
								data2=$.trim(data2);
//								
								if(data2.indexOf("exception") == -1)
										{
											
											 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");	
                                                                                                 //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
											  });
											
											//alert(data2);
											$('#discstatus').val('');
											$(".error_feed").css("display","block");
											$(".error_feed").addClass("billgenration_validate");
											if(data2==hidbillclose_null)
												{
												$(".error_feed").text(hidbillclose_null);
												}else if(data2==proc_billgenerate_split)
												{
													$(".error_feed").text(proc_billgenerate_split);
												}
											$(".error_feed").delay(2000).fadeOut('slow');
										}else {
											alert(data2)
										}
								
							
							});	
							
								}else
								{
									 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
                                                                                             
                                                                                              
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");	
                                                                                                //----------
                                                                                                if(data !=''){
                                                                                                    $('.new_print_loading_bill').hide();
//                                                                                                    $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                    $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                                }
                                                                                                //-----------
											  });
											
											$('#discstatus').val('');
											//alert(data);
											$(".error_feed").css("display","block");
											$(".error_feed").addClass("billgenration_validate");
											$(".error_feed").text(data);
											$(".error_feed").delay(2000).fadeOut('slow');
								}
						  }else
						  {alert(data);
						  }
							
						 });	
                                                 
				 	 });
				
				
				
		  }else
		  {//alert("h");
			  $("#disountamount").css("border","1px solid #F00");
		  }
		 }else
		 {
			 $("#disountamount").css("border","1px solid #F00");
		 }
	   }
              location.reload();
          }
		}); 
	  
	  /*************************************** disount click ends ***********************************************************  */
	  
	  /*************************************** proceed cancel starts ******************************************************  */  
	  $('.closeproceed').click(function () {
		
		$('.confrimproceed').css('display','none');
		$('.confrmation_overlay').css('display','none');
		}); 
	  
	  /*************************************** proceed cancel ends *********************************************************  */
	  /*************************************** proceed ok starts ******************************************************  */  
	  $('.okproceed').click(function () {
		
		$('.confrimproceed').css('display','none');
		$('.confrmation_overlay').css('display','none');
		var selected_activities =$('.tr_bill_gen_active');
	   var ordno = new Array(); 
	   var tabname= new Array();
	   var pref= new Array();
	   var tablename=new Array();
	   selected_activities.each(function(){
		var id_str       =  $(this).attr("ordno");
			if(id_str!='undefined' && id_str!='' && id_str!=null){
				ordno.push(id_str);
			}
	   var tabname_str       =  $(this).attr("tabname");
			if(tabname_str!='undefined' && tabname_str!='' && tabname_str!=null){
				tabname.push(id_str);
			}	  
	  var pref_str       =  $(this).attr("pref");
			if(pref_str!='undefined' && pref_str!='' && pref_str!=null){
				pref.push(pref_str);
			}
			var tablename_str       =  $(this).attr("tablename");
			if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
				tablename.push(tablename_str);
			}
			
			
	  });
	  ordno=unique(ordno) 
	  /*hidbillgenerate_error - Error..In Bill Generatation
  hidbillgenerate_pend -Orders pending to be served
   hidbillgenerate_bill -Bill generated sucessfully*/
	   $.post("load_bill.php", {finalorder:ordno,tabno:tabname,pref:pref,totname:tablename,set:'proceedbilling'},
			function(data)
			{
			data=$.trim(data);
			if(data.indexOf("exception") == -1){
					$('#hidchk').val("billno");
					
					
					$.post("print_details.php", {set:'billprint'},
					function(data1)
					{
						var bilpt=$('#bilprintmsg').val();
						 var flr_id=	$('#co_areachnage').val();
						  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
						  function(data1)
						  {
							$('#load_listcompletedorders').html(data1);
							$('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
							$('#listwholedetailslist').empty();
							$('.loadproceedbutton').css("display","none");
							
							/*$(".error_feed").css("display","block");
							$(".error_feed").addClass("billgenration_validate");
							$(".error_feed").text(bilpt);
							$(".error_feed").delay(2000).fadeOut('slow');*/	
							
							$(".error_feed").css("display","block");
					$(".error_feed").addClass("billgenration_validate");
					
					//alert(data);
					if(data=="Error..In Bill Generatation")
					{
						var hidbillgenerate_error=$('#hidbillgenerate_error').val();
						//$('#bill_scr').html(hidbillgenerate_error);
						$(".error_feed").text(hidbillgenerate_error);
					}else if(data=="Orders pending to be served")
					{
						var hidbillgenerate_pend=$('#hidbillgenerate_pend').val();
						$(".error_feed").text(hidbillgenerate_pend);
					}else if(data=="Bill generated sucessfully")
					{
						var hidbillgenerate_bill=$('#hidbillgenerate_bill').val();
						$(".error_feed").text(hidbillgenerate_bill);
					}
					//$(".error_feed").text(bilpt);
					$(".error_feed").delay(2000).fadeOut('slow');
								  
						  });
						$("#cancelrate").text('');
						$("#totalrate").text('');
						$(".a_demo_four").css("display", "none");
						$(".prcdbillbtn").css("display", "none");
						 $(".gotfirstprev").css("display", "none");
						
					});
					
			}else
			{
				//alert(data)
				$(".a_demo_four").css("display", "block");
				$(".prcdbillbtn").css("display", "block");
				$(".gotfirstprev").css("display", "block");
			}
			  
			});
		}); 
	  
	  /*************************************** proceed ok ends *********************************************************  */
	  
	  /*************************************** proceed starts *********************************************************  */  
              $('.confirmbillclose').click(function(){
              $('.kotconfirmpopup').css('display','none');    
               $(".confrmation_overlay").css("display","none");
  });  
        
        
        $('.confirmbillok').click(function(){ 
            
            
            var msg=$('#kotfailmsg').html();
          
        //  alert(msg);
             var dataString_log ='set_log=kotconfirmbylogin&failmsg='+msg;
             $.ajax({
             type: "POST",
             url: "menu_order.php",
             data: dataString_log,
             success: function(data) {
             
             }
             });
             
         $('.kotconfirmpopup').css('display','none');    
               $(".confrmation_overlay").css("display","none");
              var billname=$('#billname').val();
              var billnum=$('#billnum').val();
              var billgst=$('#billgst').val();

              var compordermsg1 = ($("#compordermsg1").val());
		 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
		{
                    
			if($('#printconfirmation').val()=="Y")
			{
                           
				  $('.confrimprint').css('display','block');
				  $('.confrmation_overlay').css('display','block');
                                 
			}else
			{
                           
				   var printwithdiscount=$('#printwithdiscount').val();
				
			
				   var printwithloyality=$('#printwithloyality').val();
				 var staffwithdiscount=$('#staffwithdiscount').val();
				
				   $("#loyalityid").val('');
				   if(printwithloyality=='N')
				   {
                                       
					   if(printwithdiscount=='Y' && staffwithdiscount =='Y' )
					   {
                                               
                                               
						 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
							{
								
							  $('.disountenterpopup').css('display','block');
							  $('.confrmation_overlay').css('display','block');
                                                          
							}else
							{
                                                          
								$(".error_feed").css("display","block");
								$(".error_feed").addClass("billgenration_validate");
								$(".error_feed").text(compordermsg1);
								$(".error_feed").delay(2000).fadeOut('slow');
							}
						   
						   }
						else 
					   {
                                               
                                               
						   if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
							{
//                                                            alert('1');
                                                             
                                                             $('.new_print_loading_bill').show();
                                                             
								var bilpt=$('#bilprintmsg').val();
								   var selected_activities =$('.tr_bill_gen_active');
								   var ordno = new Array(); 
								   var tablename=new Array();
								   selected_activities.each(function(){
									var id_str       =  $(this).attr("ordno");
										if(id_str!='undefined' && id_str!='' && id_str!=null){
											ordno.push(id_str);
										}
										 var tablename_str       =  $(this).attr("tablename");
										if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
											tablename.push(tablename_str);
										}
							  
								  });
								  ordno=unique(ordno) 
								
                                                                    
								  $.post("load_completedorder.php", {tabname:tablename,ord:ordno,billname:billname,billnum:billnum,billgst:billgst,set:'proceedbill'},
										function(data)
										{
										data=$.trim(data);
										//alert(data);
										if(data.indexOf("exception") == -1)
										{
										 $.post("print_details.php", {set:'billprint'},
										function(data2)
										{
                                                                                    //alert(data2);
										data2=$.trim(data2);
										
										
										
										var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data1)
											  {
											  $('#load_listcompletedorders').html(data1);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");
												$('#totalrate').text('');
                                                                                                if(data1!=''){
                                                                                                $('.new_print_loading_bill').hide();
//                                                                                                $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                            }
											  });
										
										
										 $(".error_feed").css("display","block");
										 $(".error_feed").addClass("billgenration_validate");
										 
										 if(data=="Error..In Bill Generatation")
								  {
									  var hidbillgenerate_error=$('#hidbillgenerate_error').val();
									   $(".error_feed").text(hidbillgenerate_error);
								  }else if(data=="Orders pending to be served")
								  {
									  var hidbillgenerate_pend=$('#hidbillgenerate_pend').val();
									   $(".error_feed").text(hidbillgenerate_pend);
								  }else if(data=="Bill generated sucessfully")
								  {
									  var hidbillgenerate_bill=$('#hidbillgenerate_bill').val();
									   $(".error_feed").text(hidbillgenerate_bill);
								  }
									
										 $(".error_feed").delay(2000).fadeOut('slow');
										});	
										}else
										{
											alert(data);
										}
								   });
							}else
							{
                                                             
								$(".error_feed").css("display","block");
								$(".error_feed").addClass("billgenration_validate");
								$(".error_feed").text(compordermsg1);
								$(".error_feed").delay(2000).fadeOut('slow');
							}
						
						 
					   }
				   }else
				   {
                                       
					   if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
						  {
                                                      
						  $('.registerpopup').css('display','block');
						  $('.confrmation_overlay').css('display','block');
						}else
						{
                                                    
							$(".error_feed").css("display","block");
							$(".error_feed").addClass("billgenration_validate");
							$(".error_feed").text(compordermsg1);
							$(".error_feed").delay(2000).fadeOut('slow');
						}
				   }
			}
		 }else
		{
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(compordermsg1);
			$(".error_feed").delay(2000).fadeOut('slow');
		}
          });       
      
          
          
          
          
	  $('.proceedbuttonclick').click(function () { 
            
            var flr_id=	$('#co_areachnage').val();
          
            var Bill_print = "Bill_print";
            $.post("printercheck_1.php", {type:Bill_print,floor:flr_id},
                                               
            function(data)
            { 
            data=$.trim(data); 
           
            
            if(data !=0)
            { 
                                            
               $('.kotconfirmpopup').css('display','block');   
              $('#kotfailmsg').html(data);
               $(".confrmation_overlay").css("display","block");                              
            //alert(data);
   			                   
                                                      
            }else{  
                    var billname='';
                    var billnum='';
                    var billgst='';
                                                                     var billname=$('#billname').val();
                                                                   var billnum=$('#billnum').val();
                                                                    var billgst=$('#billgst').val();
                                                                    //alert(billname);
                                                                    if(!$('#billname').length){
                                                                        
                                                                        var billname='';
                                                                    }
                                                                    if(!$('#billnum').length){
                                                                        var billnum='';
                                                                    }
                                                                    if(!$('#billgst').length){
                                                                        var billgst='';
                                                                    }

//$('.proceedbuttonclick').addClass('bill_print_btn_disable');
var compordermsg1 = ($("#compordermsg1").val());
		 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
		{
                    
			
			if($('#printconfirmation').val()=="Y")
			{
                           
				
				  $('.confrimprint').css('display','block');
				  $('.confrmation_overlay').css('display','block');
                                 
			}else
			{
                           
			
				   var printwithdiscount=$('#printwithdiscount').val();
				
			
				   var printwithloyality=$('#printwithloyality').val();
				 var staffwithdiscount=$('#staffwithdiscount').val();
				
				   $("#loyalityid").val('');
				   if(printwithloyality=='N')
				   {
                                       
					   if(printwithdiscount=='Y' && staffwithdiscount =='Y' )
					   {
                                               
                                               
						 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
							{
								
							  $('.disountenterpopup').css('display','block');
							  $('.confrmation_overlay').css('display','block');
                                                          
							}else
							{
                                                          
								$(".error_feed").css("display","block");
								$(".error_feed").addClass("billgenration_validate");
								$(".error_feed").text(compordermsg1);
								$(".error_feed").delay(2000).fadeOut('slow');
							}
						   
						   }
						else 
					   {
                                               
                                               
						   if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
							{
//                                                            alert('1');
                                                             
                                                             $('.new_print_loading_bill').show();
                                                             
								var bilpt=$('#bilprintmsg').val();
								   var selected_activities =$('.tr_bill_gen_active');
								   var ordno = new Array(); 
								   var tablename=new Array();
								   selected_activities.each(function(){
									var id_str       =  $(this).attr("ordno");
										if(id_str!='undefined' && id_str!='' && id_str!=null){
											ordno.push(id_str);
										}
										 var tablename_str       =  $(this).attr("tablename");
										if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
											tablename.push(tablename_str);
										}
							  
								  });
								  ordno=unique(ordno) 
								
                                                                    
								  $.post("load_completedorder.php", {tabname:tablename,ord:ordno,billname:billname,billnum:billnum,billgst:billgst,set:'proceedbill'},
										function(data)
										{
										data=$.trim(data);
										//alert(data);
										if(data.indexOf("exception") == -1)
										{
										 $.post("print_details.php", {set:'billprint'},
										function(data2)
										{
                                                                                    //alert(data2);
                                                                                $('#billname').val('');
                                                                                $('#billnum').val('');
                                                                                $('#billgst').val('');
										data2=$.trim(data2);
										
										
										
										var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data1)
											  {
											  $('#load_listcompletedorders').html(data1);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");
												$('#totalrate').text('');
                                                                                                if(data1!=''){
                                                                                                $('.new_print_loading_bill').hide();
//                                                                                                $('.printcompletedorder').removeClass('bill_print_btn_disable');
//                                                                                                $('.proceedbuttonclick').removeClass('bill_print_btn_disable');
                                                                                            }
											  });
										
										
										 $(".error_feed").css("display","block");
										 $(".error_feed").addClass("billgenration_validate");
										 
										 if(data=="Error..In Bill Generatation")
								  {
									  var hidbillgenerate_error=$('#hidbillgenerate_error').val();
									   $(".error_feed").text(hidbillgenerate_error);
								  }else if(data=="Orders pending to be served")
								  {
									  var hidbillgenerate_pend=$('#hidbillgenerate_pend').val();
									   $(".error_feed").text(hidbillgenerate_pend);
								  }else if(data=="Bill generated sucessfully")
								  {             
									  var hidbillgenerate_bill=$('#hidbillgenerate_bill').val();
									   $(".error_feed").text(hidbillgenerate_bill);
								  }
										 
										 
										// $(".error_feed").text(bilpt);
										 $(".error_feed").delay(2000).fadeOut('slow');
										});	
										}else
										{
											alert(data);
										}
								   });
							}else
							{
                                                             
								$(".error_feed").css("display","block");
								$(".error_feed").addClass("billgenration_validate");
								$(".error_feed").text(compordermsg1);
								$(".error_feed").delay(2000).fadeOut('slow');
							}
						
						 /*  if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
							{
								
							  $('.disountenterpopup').css('display','block');
							  $('.confrmation_overlay').css('display','block');
							}else
							{
								$(".error_feed").css("display","block");
								$(".error_feed").addClass("billgenration_validate");
								$(".error_feed").text("Select tables to Proceed");
								$(".error_feed").delay(2000).fadeOut('slow');
							}*/
					   }
				   }else
				   {
                                       
					   if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
						  {
                                                      
						  $('.registerpopup').css('display','block');
						  $('.confrmation_overlay').css('display','block');
						}else
						{
                                                    
							$(".error_feed").css("display","block");
							$(".error_feed").addClass("billgenration_validate");
							$(".error_feed").text(compordermsg1);
							$(".error_feed").delay(2000).fadeOut('slow');
						}
				   }
			}
		 }else
		{
			$(".error_feed").css("display","block");
			$(".error_feed").addClass("billgenration_validate");
			$(".error_feed").text(compordermsg1);
			$(".error_feed").delay(2000).fadeOut('slow');
		}

            }
	 }); 
	   }); 
	  /*************************************** proceed ends ***********************************************************  */
	  
	  /***************************************  auto refresh starts **********************************************************  */
	 setInterval(function() { 
            
	 
	
	 var flr_id=	$('#co_areachnage').val();
	  var selected_activities =$('.tr_bill_gen_active');
	   var ordno = new Array(); 
	   var tabname= new Array();
	   var pref= new Array();
	   var tablename=new Array();
	   selected_activities.each(function(){
		var id_str       =  $(this).attr("ordno");
			if(id_str!='undefined' && id_str!='' && id_str!=null){
				ordno.push(id_str);
			}
			
	  });
	  ordno=unique(ordno) 
	 
	// alert(ordno)
	 //$('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
	  $.post("load_completedorder.php", {floorid:flr_id,ordno:ordno,set:'loadbilldetails_co'},
	  function(data)
	  {
	  $('#load_listcompletedorders').html(data);
	  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
	  //$('#listwholedetailslist').empty();
		//$('.loadproceedbutton').css("display","none");		  
	  });
	//$("#cancelrate").text('');
	//$("#totalrate").text('');
  
	 
	  }, 6000); 
	/***************************************  auto refresh ends **********************************************************  */
	
	 /***************************************  staff starts ******************************************************************  */
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
		/*$.post("load_bill_history.php", {stafflist:stafflist,set:'sendotp'},
			function(data)
			{
			data=$.trim(data);
			//alert(data);
			});*/
	 
	 
	 });
	 /***************************************  staff ends ******************************************************************  */
	 
	  /*************************************** cancel close starts *********************************************************  */  
	  $('.canc_closedirect').click(function () { 
	 		$('.confrimclosedirect').css('display','none');
			$('.confrmation_overlay').css('display','none');
	  });
	 /***************************************  cancel close  ends ******************************************************************  */
	  /*************************************** ok close starts *********************************************************  */  
	  $('.closedirect').click(function () {
               var compordermsg8 = ($("#compordermsg1").val());
	  if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
			  {
			  
				   var selected_activities =$('.tr_bill_gen_active');
						 var ordno = new Array(); 
						 var tabname= new Array();
						 var pref= new Array();
						 var tablename=new Array();
						 selected_activities.each(function(){
						  var id_str       =  $(this).attr("ordno");
							  if(id_str!='undefined' && id_str!='' && id_str!=null){
								  ordno.push(id_str);
							  }
						 var tabname_str       =  $(this).attr("tabname");
							  if(tabname_str!='undefined' && tabname_str!='' && tabname_str!=null){
								  tabname.push(id_str);
							  }	  
					 	var pref_str       =  $(this).attr("pref");
							  if(pref_str!='undefined' && pref_str!='' && pref_str!=null){
								  pref.push(pref_str);
							  }
							  var tablename_str       =  $(this).attr("tablename");
							  if(tablename_str!='undefined' && tablename_str!='' && tablename_str!=null){
								  tablename.push(tablename_str);
							  }
							  
							  
						});
						ordno=unique(ordno) 
				  
				   $.post("load_bill.php", {finalorder:ordno,tabno:tabname,pref:pref,totname:tablename,set:'proceedbilling'},
						function(data)
						{
						data=$.trim(data);
						//alert(data);
						if(data.indexOf("exception") == -1){
								$('#hidchk').val("billno");
								if(data=="Error..In Bill Generatation")
								  {
									  var hidbillgenerate_error=$('#hidbillgenerate_error').val();
									  $('#bill_scr').html(hidbillgenerate_error);
								  }else if(data=="Orders pending to be served")
								  {
									  var hidbillgenerate_pend=$('#hidbillgenerate_pend').val();
									  $('#bill_scr').html(hidbillgenerate_pend);
								  }else if(data=="Bill generated sucessfully")
								  {
									  var hidbillgenerate_bill=$('#hidbillgenerate_bill').val();
									  $('#bill_scr').html(hidbillgenerate_bill);
								  }
								//window.location="print_details.php?set=billprint";
								$.post("print_details.php", {set:'billprint'},
								function(data)
								{
								//data=$.trim(data);
								//var data2='';
								var hidbillclose_null=$('#hidbillclose_null').val();
								var proc_billgenerate_split=$('#proc_billgenerate_split').val();
								   $.post("load_completedorder.php", {set:'closedirectfuncion_co'},
									function(data2)
									{
										
									data2=$.trim(data2);
									//alert("11"+data2);
					  				if(data2.indexOf("exception") == -1)
										{
											 var flr_id=	$('#co_areachnage').val();
											// $('#load_listcompletedorders').html('<img src="img/ajax-loaders/ajax-loader-6.gif" />');
											  $.post("load_completedorder.php", {floorid:flr_id,set:'loadbilldetails_co'},
											  function(data)
											  {
											  $('#load_listcompletedorders').html(data);
											  $('#listheadsection').load("load_completedorder.php?set=loadlisthead_co");	
											  $('#listwholedetailslist').empty();
												$('.loadproceedbutton').css("display","none");	
												
												$(".error_feed").css("display","block");
												$(".error_feed").addClass("billgenration_validate");
												if(data2==hidbillclose_null)
												{
												$(".error_feed").text(hidbillclose_null);
												}else if(data2==proc_billgenerate_split)
												{
													$(".error_feed").text(proc_billgenerate_split);
												}
												$(".error_feed").delay(2000).fadeOut('slow');
				  	  
											  });
											$("#cancelrate").text('');
											$("#totalrate").text('');
											$(".a_demo_four").css("display", "none");
					  						$(".prcdbillbtn").css("display", "none");
					 						 $(".gotfirstprev").css("display", "none");
											 
											 $('.confrimclosedirect').css('display','none');
											$('.confrmation_overlay').css('display','none');
										}else
										{alert(data2);}
									
									});	
									
								});
								
						}else
						{
							alert(data)
							$(".a_demo_four").css("display", "block");
					  		$(".prcdbillbtn").css("display", "block");
					  		$(".gotfirstprev").css("display", "block");
						}
						  
						});
				  
				  
				   
				   }else
			  {
				  $(".error_feed").css("display","block");
				  $(".error_feed").addClass("billgenration_validate");
			 	  $(".error_feed").text(compordermsg8);
				  $(".error_feed").delay(2000).fadeOut('slow');
			  }
	 
	  });
	 /***************************************  ok close ends ******************************************************************  */
	 
	  /*************************************** close starts *********************************************************  */  
	  $('.closecompletedorder').click(function () { 
              var compordermsg9 = ($("#compordermsg1").val());
	 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
			  {
			  $('.confrimclosedirect').css('display','block');
				$('.confrmation_overlay').css('display','block');
				 
				   }else
			  {
				  $(".error_feed").css("display","block");
				  $(".error_feed").addClass("billgenration_validate");
			 	  $(".error_feed").text(compordermsg9);
				  $(".error_feed").delay(2000).fadeOut('slow');
			  }
	  
	 }); 
	  
	  /*************************************** close ends ***********************************************************  */
	   
	  /*************************************** cancel close disc starts *********************************************************  */  
	  $('.canc_closedirectdisc').click(function () { 
	 		$('.confrimclosedirectdiscount').css('display','none');
			$('.confrmation_overlay').css('display','none');
			$('#discstatus').val("");
	  });
	 /***************************************  cancel close disc  ends ******************************************************************  */
	  /*************************************** ok close disc starts *********************************************************  */  
	  $('.closedirectdisc').click(function () { 
              var compordermsg10 = ($("#compordermsg1").val());
	  if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
			  {
			  $('.confrimclosedirectdiscount').css('display','none');
				 $('.disountenterpopup').css('display','block');
					$('.confrmation_overlay').css('display','block'); 
					$('#discstatus').val("Y");
			  }else
			  {
				  $(".error_feed").css("display","block");
				  $(".error_feed").addClass("billgenration_validate");
			 	  $(".error_feed").text(compordermsg10);
				  $(".error_feed").delay(2000).fadeOut('slow');
			  }
	 
	  });
	 /***************************************  ok close disc ends ******************************************************************  */
	  
	  /*************************************** discount close starts *********************************************************  */  
	  $('.discclosecompletedorder').click(function () { 
              var compordermsg11 = ($("#compordermsg1").val());
	 if($('.clickeachrowcompld').hasClass('tr_bill_gen_active') )
			  {
				   $('.confrimclosedirectdiscount').css('display','block');
					$('.confrmation_overlay').css('display','block');
 				   
				   }else
			  {
				  $(".error_feed").css("display","block");
				  $(".error_feed").addClass("billgenration_validate");
			 	  $(".error_feed").text(compordermsg11);
				  $(".error_feed").delay(2000).fadeOut('slow');
			  }
	  
	 }); 
	  
	  /*************************************** discount close ends ***********************************************************  */
	  
	  /*************************************** submit cancelltaion starts *********************************************************  */  
	  $('.submitcancelation').click(function () { 
              
              //alert("hi");
              //hello
		  var menuchange		= $('#hid_menuchange').val();
		  var portchange		=  $('#hid_portchange').val();
		  var kotchange			=  $('#hid_kotchange').val();
		  var ordchange			=  $('#hid_ordchange').val();
		  var final				=  $('#hid_final').val();
		  var slno				=  $('#hid_slno').val();
		  var qtychange			=  $('#hid_qtychange').val();
	 if($('#hidcancelsecret').val()=="Y")
		  {
                      
				var reasontext       =  $('#reasontext').val();
				var secretkey        =  $('#secretkey').val();
				var stafflist        =  $('#stafflist').val();
				
				
				 $.post("load_bill_history.php", {secretkey:secretkey,stafflist:stafflist,set:'secretkeycheck'},
					function(data)
					{
					data=$.trim(data);
					if(data=="ok")
					 {  
						 var staff=($('#stafflist').val())
						 
						  $.post("load_completedorder.php", {reasontext:reasontext,secretkey:secretkey,stafflist:staff,menuchange:menuchange,portchange:portchange,kotchange:kotchange,ordchange:ordchange,qtychange:qtychange,final:final,slno:slno,set:'canceleacitemqty'},
						  function(data)
						  {
						  data=$.trim(data);
						  //alert(data);
						  });
						   $('.loadcanceldetails').css('display','none');
						 $('.confrmation_overlay').css('display','none');
					}else
					{
                                            
						var tp='';
						var stafflist       = $("#stafflist").find('option:selected').attr('cancelkey');//alert(stafflist);
						var psd=$("#hidenterpaswd").val();
						var otp=$("#hidenterotp").val();
						var err=$("#hiderrormg").val();
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
					}
				 }); 
		  }else
		  {
			  //alert(menuchange+"*"+portchange+"*"+kotchange+"*"+ordchange+"*"+qtychange+"*"+final+"*"+slno)
			   $.post("load_completedorder.php", {menuchange:menuchange,portchange:portchange,kotchange:kotchange,ordchange:ordchange,qtychange:qtychange,final:final,slno:slno,set:'canceleacitemqty'},
						  function(data)
						  {
						  data=$.trim(data);
						 // alert(data);
						  });
						   $('.loadcanceldetails').css('display','none');
						 $('.confrmation_overlay').css('display','none');
			  
		  }
		  	  
	 }); 
	  
	  /***************************************  submit cancelltaion ends ***********************************************************  */
});

$(document).unbind().keyup(function(e){
     e.preventDefault();
    if (e.keyCode == 27) {
        if($('.disountenterpopup:visible').length == 1)
            {   
                 $('.disountenterpopup').css("display","none");
                $(".confrmation_overlay").css("display","none");
            }
        if($('.kotcancel_reason_popup_new:visible').length == 1)
            {   
                 $('.kotcancel_reason_popup_new').css("display","none");
                $(".confrmation_overlay").css("display","none");
               
            }     
    }
});    
function unique(list) {
    var result = [];
    $.each(list, function(i, e) {
        if ($.inArray(e, result) == -1) result.push(e);
    });
    return result;
}