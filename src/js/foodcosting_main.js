// JavaScript Document
$(document).ready(function(){
	
	 $('#viewrecipemaking').css("display","none");
    $('#viewimagegallery').css("display","none");
	/***************************************** select menu starts ******************************************************************  */
	  $('.selectmenuitemcheck').click(function () { 
	  	if ($('.clicktoselect').hasClass('food_table_active')) 
		{
	  		var id_str       =  $('.food_table_active').attr("id");
			var id_arr	     =	id_str.split("_");
		  	var idvalue      =  id_arr[1];
			
			var namevalue       =  $('.food_table_active').attr("name");
			
			$('#menuidselected').val(idvalue);
			$('#menuname').val(namevalue);
			//reloadall();
			$("#mname").val('');
			$('#mcate').find('option:first').attr('selected', 'selected');
			$('#msubc').find('option:first').attr('selected', 'selected');
			$('#mdiet').find('option:first').attr('selected', 'selected');
			
			$(".checkenable").removeClass('incread_disable');
			
			$('.md-close').click();
			
			 $('.food_increant_table_container').load('load_foodcosting.php?value=listallingredients&menuid='+idvalue);
			 $('#loadprepmeth').load('load_foodcosting.php?value=listprepmethod&menuid='+idvalue);
			 $('.totalcostloading').load('load_foodcosting.php?value=totalcostlisting&menuid='+idvalue);
			 $('.projectcaltotal').load('load_foodcosting.php?value=projectcalculator&menuid='+idvalue); 
			 $('.servingcoutset').load('load_foodcosting.php?value=servingcoutsetcalc&menuid='+idvalue);
			 $('#loadfullimages').load('load_foodcosting.php?value=loadimagestotal&menuid='+idvalue);
			 
			 $('#qtyingr').val('');
			$('#wastingr').val('');
			$('#uniting').find('option:first').attr('selected', 'selected');
			$('#unitcost').val('');
			$('#costingr').val('');
			$('#wastcostingr').val('');
			$('#totalcostingr').val('');
			//$('#menuidselected').val('');
			//$('#menuname').val('');
			$('#ingidselected').val('');
			$('#ingname').val('');
			$("#editingredientswholediv").css("display","none"); 	
			$("#addingredientswholediv").css("display","block");
			
			
	    var menu=idvalue;//'KBP-MENU1';//$('#menuidselected').val();
		var upload_id=$('#upload_id').val();//$('#upload_id').val();
		var btnUpload=$('#me');
		var mestatus=$('#mestatus');
		var files=$('#preview');
		new AjaxUpload(btnUpload, {
				action: 'uploadGalFile.php?upid='+upload_id+'&menuid='+menu,
			name: 'uploadfile',
			onSubmit: function(file, ext){
				if (!(/\.(gif|jpg|jpeg|tiff|png)$/i).test(file)) {              
    				mestatus.html('<font color="#ff0000">Only JPG, PNG or GIF files are allowed</font>');
					$("#mestatus").delay(2000).fadeOut('slow');
					return false;            
    			}
				/* if (! (ext && /^(jpg|png|jpeg|gif|bmp|tif)$/.test())){ 
                    // extension is not allowed 
					//mestatus.text('Only JPG, PNG or GIF files are allowed');
					mestatus.html('<font color="#ff0000">Only JPG, PNG or GIF files are allowed</font>');
					return false;
				}*/
				mestatus.html('<font color="#ff0000">Please wait...</font> <img src="img/ajax-loaders/ajax-loader-7.gif" height="16" width="16">');
			},
			onComplete: function(file, response){
				//On completion clear the status
				//mestatus.text('File Uploaded Sucessfully!');
				//On completion clear the status
				files.html('');
				//Add uploaded file to list
				//alert(response);
				var details	= response.split("|");
				if(details[0]==="success"){
					mestatus.text('Image uploaded successfully!');
					$("#mestatus").delay(2000).fadeOut('slow');
				} else{
					mestatus.text('Photo Uploaded Error!');
					alert("File Uploaded Error!");
					$("#mestatus").delay(2000).fadeOut('slow');
					//mestatus.text('Image uploaded successfully!');
				}
		$.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=addimage&mid="+menu,
			success: function(msg)
			{
				$('#menuimage1').html(msg);
				$('#loadfullimages').load('load_foodcosting.php?value=loadimagestotal&menuid='+menu);
				
			}
		});
			}
		});
	
		
			
			
			 
			
		}else
		{
			//$(".checkenable").addClass('incread_disable');
			$(".loaderrormenu").css("display","block");
			$(".loaderrormenu").text("Select Any Menu First");
			$(".loaderrormenu").delay(2000).fadeOut('slow');
		}
	 
	  });
	/***************************************  select menu  ends ******************************************************************  */ 
	
	/***************************************** select ing starts ******************************************************************  */
	  $('.selectitemname').click(function () { 
	  	if ($('.clicktoselect_ing').hasClass('food_table_active_ing')) 
		{
			var rate_s       =  $('.food_table_active_ing').attr("rate");
			
			if(rate_s!='0' && rate_s!='0.00' && rate_s!='')
			{
				  var id_str       =  $('.food_table_active_ing').attr("id");
				  var id_arr	     =	id_str.split("_");
				  var idvalue      =  id_arr[1];
				  
				  var namevalue       =  $('.food_table_active_ing').attr("name");
				  
				  var unitvalue       =  $('.food_table_active_ing').attr("unit");
				  
				  var unitcostvalue       =  $('.food_table_active_ing').attr("unitcost");
				  
				  if( $("#editingredientswholediv").css('display') == 'block') 
				  { 
					  $('#ingidselected_edit').val(idvalue);
					  $('#ingname_edit').val(namevalue);
					  $('#hiduniting_edit').val(unitvalue);
					  $('#unitcost_edit').val(unitcostvalue);
					  $('#qtyingr_edit').val('');
					  $('#wastingr_edit').val('');
					  $('#wastcostingr_edit').val('');
					  $('#totalcostingr_edit').val('');
					  $('#costingr_edit').val('');
					  $('#uniting_edit  option[value="'+unitvalue+'"').prop("selected", true);
					  $('#qtyingr_edit').focus();
				  }else
				  {
					  $('#ingidselected').val(idvalue);
					  $('#ingname').val(namevalue);
					  $('#hiduniting').val(unitvalue);
					  $('#unitcost').val(unitcostvalue);
					  $('#uniting  option[value="'+unitvalue+'"').prop("selected", true);
					  $('#qtyingr').focus();
				  }
				  
				  
				  //reloadall();
				  $('.md-close').click();
			
			}else
			{
				//$(".checkenable").addClass('incread_disable');
				$(".loaderrormenu_ing").css("display","block");
				$(".loaderrormenu_ing").text("Product Rate Not Found");
				$(".loaderrormenu_ing").delay(2000).fadeOut('slow');
			}
		}else
		{
			//$(".checkenable").addClass('incread_disable');
			$(".loaderrormenu_ing").css("display","block");
			$(".loaderrormenu_ing").text("Select Any Menu First");
			$(".loaderrormenu_ing").delay(2000).fadeOut('slow');
		}
	 
	  });
	/***************************************  select ing  ends ******************************************************************  */
	
	/***************************************** select tabs starts **********************************************************  */
	  $('.incread_disable').click(function () { 
	 
			$("#errortotally").css("display","block");
			$("#errortotally").text("Select Any Menu First");
			$("#errortotally").delay(2000).fadeOut('slow');
	
	 });
	/***************************************  select ing  ends ******************************************************************  */
	/***************************************** select tabs starts **********************************************************  */
	  $('#recipeingredient').click(function () { 
	 		 $('#viewrecipeingredient').css("display","block");
			  $('#viewrecipemaking').css("display","none");
			  $('#viewimagegallery').css("display","none");
			  
			  $('.food_tab_btn').removeClass('food_tab_act');
			  $(this).addClass('food_tab_act');
			  
			  
	   });
	    $('#recipemaking').click(function () { 
		
	 		 $('#viewrecipemaking').css("display","block");
			 $('#viewrecipeingredient').css("display","none");
			 $('#viewimagegallery').css("display","none");
			 
			 $('.food_tab_btn').removeClass('food_tab_act');
			  $(this).addClass('food_tab_act');
	   });
	    $('#imagegalley').click(function () { 
	 		 $('#viewimagegallery').css("display","block");
			 $('#viewrecipeingredient').css("display","none");
			 $('#viewrecipemaking').css("display","none");
			 
			 $('.food_tab_btn').removeClass('food_tab_act');
			  $(this).addClass('food_tab_act');
			 
	   });
	/***************************************  select tabs  ends ******************************************************************  */ 
	/***************************************** qty change starts **********************************************************  */
	  $('#qtyingr').change(function () { 
	  var qtyingr=parseFloat($('#qtyingr').val());
	  var unitcost=parseFloat($('#unitcost').val());
	  var letterNumber = /^[0-9]+$/;  
 		//if(isFloat(qtyingr)){alert(qtyingr)}
	  //if(!ctype_alpha(qtyingr))//isNaN
	  if(qtyingr!='' )
	  {
		  if(($('#qtyingr').val().match(letterNumber)) || (isFloat(qtyingr)))
		  {
			  var total=qtyingr *  unitcost;
			  $('#costingr').val(total.toFixed(2));
			  $('#wastingr').focus();
			  $('#totalcostingr').val(total.toFixed(2));
			  
		  }else
		  {
			  $("#errortotally").css("display","block");
			  $("#errortotally").text("Check Quantity");
			  $("#errortotally").delay(2000).fadeOut('slow');
		  }
	  }
	  
	   
	 });
	/***************************************  qty change  ends ******************************************************************  */
	/***************************************** qty change starts **********************************************************  */
	  $('#qtyingr').keyup(function () { 
	  var qtyingr=parseFloat($('#qtyingr').val());
	  var unitcost=parseFloat($('#unitcost').val());
	  var letterNumber = /^[0-9]+$/;  
 		//if(isFloat(qtyingr)){alert(qtyingr)}else{alert("not")}
	  //if(!ctype_alpha(qtyingr))//isNaN
	  if(qtyingr!='' )
	  {
		  if(($('#qtyingr').val().match(letterNumber)) || (isFloat(qtyingr)))
		  {
			 /* var total=qtyingr *  unitcost;
			  $('#costingr').val(total.toFixed(2));
			  $('#wastingr').focus();*/
		  }else
		  {
			  $("#errortotally").css("display","block");
			  $("#errortotally").text("Check Quantity");
			  $("#errortotally").delay(2000).fadeOut('slow');
		  }
	  }
	   
	 });
	/***************************************  qty change  ends ******************************************************************  */   
	/***************************************** qty change starts **********************************************************  */
	  $('#wastingr').change(function () { 
	  var qtyingr=parseFloat($('#qtyingr').val());
	  var wastingr=parseFloat($('#wastingr').val());
	  var unitcost=parseFloat($('#unitcost').val());
	 if(!isNaN(wastingr))
	  {
		  var total=((qtyingr * wastingr)/100) * unitcost;
		  $('#wastcostingr').val(total.toFixed(2));
		  //total calculation
		  var costingr=parseFloat($('#costingr').val());
		  var wastcostingr=parseFloat($('#wastcostingr').val());
		  
		  //var totalcost=costingr - wastcostingr;
		  //$('#totalcostingr').val(totalcost.toFixed(2));
	  }else
	  {
		  $("#errortotally").css("display","block");
		  $("#errortotally").text("Check Wastage");
		  $("#errortotally").delay(2000).fadeOut('slow');
	  }
	   
	 });
	/***************************************  qty change  ends ******************************************************************  */
	
	
	
	  
	 /***************************************** submit starts **********************************************************  */
	  $('#submitingrvalues').click(function () { 
	  	var menuidselected	=	$('#menuidselected').val();
		var menuname		=	$('#menuname').val();
	  	var ingidselected	=	$('#ingidselected').val();
		var ingname			=	$('#ingname').val();
		var qtyingr			=	$('#qtyingr').val();
		var wastingr		=	$('#wastingr').val();
		
		var uniting			=	$('#uniting').val();
		var unitcost		=	$('#unitcost').val();
		var costingr		=	$('#costingr').val();
		var wastcostingr	=	$('#wastcostingr').val();
		var totalcostingr	=	$('#totalcostingr').val();
	  //qtyingr uniting unitcost costingr wastingr wastcostingr totalcostingr
	  
	    
		var wastcostingr	=	$('#wastcostingr').val();
		var totalcostingr	=	$('#totalcostingr').val();
	    
	  
	  if(menuname!='' &&  menuidselected!='')
	  {
			if(ingname!='' &&  ingidselected!='')
			{
				if(qtyingr!='')
				{
				  if(!isNaN(qtyingr))
				  {
					  if(wastingr!='')
						{
						  if(!isNaN(wastingr))
						  {
							   var data = {
								"value"				: "submitingredients",
								"menuidselected"	: menuidselected,
								"ingidselected"		: ingidselected,
								"qtyingr"			: qtyingr,
								"uniting"			: uniting,
								"unitcost" 			: unitcost,
								"costingr" 			: costingr,
								"wastingr" 			: wastingr,
								"wastcostingr" 		: wastcostingr,
								"totalcostingr" 	: totalcostingr
							  };
							   data = $(this).serialize() + "&" + $.param(data);
							   alert(data)
							   //$('#rr').html(data)
							   $.ajax({
									  type: "POST",
									  url: "load_foodcosting.php",
									  data: data,
									  success: function(msg)
									  {//alert(msg.trim());
									  msg=msg.trim();//alert(msg);
										  if(msg=="ok")
										  {
											  $("#errortotally").css("display","block");
											   $("#errortotally").text("Added Successfully");
											   $("#errortotally").delay(2000).fadeOut('slow');
			   
										  		$('.food_increant_table_container').load('load_foodcosting.php?value=listallingredients&menuid='+menuidselected);
												
												$('#loadprepmeth').load('load_foodcosting.php?value=listprepmethod&menuid='+menuidselected);
												 $('.totalcostloading').load('load_foodcosting.php?value=totalcostlisting&menuid='+menuidselected);
												 $('.projectcaltotal').load('load_foodcosting.php?value=projectcalculator&menuid='+menuidselected); 
												 $('.servingcoutset').load('load_foodcosting.php?value=servingcoutsetcalc&menuid='+menuidselected);
												 $('#loadfullimages').load('load_foodcosting.php?value=loadimagestotal&menuid='+menuidselected);
												
												
												
												$.ajax({
												  type: "POST",
												  url: "load_foodcosting.php",
												  data: "value=projectcalculator&menuid="+menuidselected,
												  success: function(msg)
												  {
												  msg=msg.trim();//alert(msg);
												  $('.projectcaltotal').html(msg);
												   var sellpp			=parseFloat($('#sellpp').val());
												   var pc_cost	=parseFloat($('#pc_cost').val());
												   var total='';//alert(sellpp)
												  // alert(pc_cost)
												   if(sellpp!='' && sellpp!='0.00')
												   {
												   if(!isNaN(sellpp))
													{
													   total= (((sellpp *  pc_cost) /100) + pc_cost);
													   $('#basedpccost').val(total.toFixed(2))
													    var basedpccost= $('#basedpccost').val();
														  var datad = {
														  "value"				: "submitsellpp",
														  "menuidselected"	    : menuidselected,
														  "sellpp"				: sellpp,
														  "basedpccost"			: basedpccost
														};
														 $.ajax({
															type: "POST",
															url: "load_foodcosting.php",
															data: datad,
															success: function(msg)
															{
																msg=msg.trim();
																$('.projectcaltotal').load('load_foodcosting.php?value=projectcalculator&menuid='+menuidselected);
																
															}
														});
													}
												   }
												 
												   
													  
													  
												  }
											  });
												
												
												
												
										  		$('#qtyingr').val('');
												$('#wastingr').val('');
												$('#uniting').find('option:first').attr('selected', 'selected');
												$('#unitcost').val('');
												$('#costingr').val('');
												$('#wastcostingr').val('');
	   											$('#totalcostingr').val('');
												//$('#menuidselected').val('');
												//$('#menuname').val('');
												$('#ingidselected').val('');
												$('#ingname').val('');
										  
										  }else
										  {
											  $("#errortotally").css("display","block");
											  $("#errortotally").text("Duplicate Entry");
											  $("#errortotally").delay(2000).fadeOut('slow');
										  }
										  
									  }
								  });
							  
						  }else
						  {
							  $("#errortotally").css("display","block");
							  $("#errortotally").text("Check Wastage");
							  $("#errortotally").delay(2000).fadeOut('slow');
						  }
						}else
						{
							$("#errortotally").css("display","block");
							$("#errortotally").text("Add Wastage");
							$("#errortotally").delay(2000).fadeOut('slow');
						}
				  }else
				  {
					  $("#errortotally").css("display","block");
					  $("#errortotally").text("Check Quantity");
					  $("#errortotally").delay(2000).fadeOut('slow');
				  }
				}else
				{
					$("#errortotally").css("display","block");
					$("#errortotally").text("Add Quantity");
					$("#errortotally").delay(2000).fadeOut('slow');
				}
			}else
			{
				
				$("#errortotally").css("display","block");
				$("#errortotally").text("Select Ingredient Name");
				$("#errortotally").delay(2000).fadeOut('slow');
			}
	  }else
	  {
		  $("#errortotally").css("display","block");
		  $("#errortotally").text("Select Menu Name");
		  $("#errortotally").delay(2000).fadeOut('slow');
	  }
	   });
	/***************************************  submit  ends ******************************************************************  */
	
	/***************************************** preparation method starts **********************************************************  */
	  $('.savepreparationmethod').click(function () { 
	  var menuidselected	=	$('#menuidselected').val();
	  var menuname			=	$('#menuname').val();
	  var prepmethod		=	$('#prepmethod').val();
	  
	  if(menuname!='' &&  menuidselected!='')
	  {
		  if(prepmethod!='')
			{
				//alert(menuidselected+prepmethod)
				//$('#loadprepmeth').load('load_foodcosting.php?value=listprepmethod');
				
				var data = {
				  "value"				: "submitpreparationmeth",
				  "menuidselected"	: menuidselected,
				  "prepmethod"		: prepmethod
				};
				 data = $(this).serialize() + "&" + $.param(data);
				 $.ajax({
						type: "POST",
						url: "load_foodcosting.php",
						data: data,
						success: function(msg)
						{//alert(msg.trim());
						msg=msg.trim();//alert(msg);
							if(msg=="added")
							{
								  $('#loadprepmeth').load('load_foodcosting.php?value=listprepmethod&menuid='+menuidselected);
								  $('#qtyingr').val('');
								  $('#wastingr').val('');
								  $('#uniting').find('option:first').attr('selected', 'selected');
								  $('#unitcost').val('');
								  $('#costingr').val('');
								  $('#wastcostingr').val('');
								  $('#totalcostingr').val('');
								  $('#ingidselected').val('');
								  $('#ingname').val('');
								  
								  $("#errortotally").css("display","block");
								  $("#errortotally").text("Added");
								  $("#errortotally").delay(2000).fadeOut('slow');
							
							}else
							{
								$('#loadprepmeth').load('load_foodcosting.php?value=listprepmethod&menuid='+menuidselected);
								  $('#qtyingr').val('');
								  $('#wastingr').val('');
								  $('#uniting').find('option:first').attr('selected', 'selected');
								  $('#unitcost').val('');
								  $('#costingr').val('');
								  $('#wastcostingr').val('');
								  $('#totalcostingr').val('');
								  $('#ingidselected').val('');
								  $('#ingname').val('');
								  
								$("#errortotally").css("display","block");
								$("#errortotally").text("Updated");
								$("#errortotally").delay(2000).fadeOut('slow');
							}
							
						}
					});
			}else
			{
				 $("#errortotally").css("display","block");
		 		 $("#errortotally").text("Add Preparation Method");
		  		 $("#errortotally").delay(2000).fadeOut('slow');
			}
	  }else
	  {
		  $("#errortotally").css("display","block");
		  $("#errortotally").text("Select Menu Name");
		  $("#errortotally").delay(2000).fadeOut('slow');
	  }
	  
	
	 });
	/***************************************  preparation method  ends ******************************************************************  */
	
	
	
		}); 
		
function isFloat(val) {
    var floatRegex = /^-?\d+(?:[.,]\d*?)?$/;
    if (!floatRegex.test(val))
        return false;

    val = parseFloat(val);
    if (isNaN(val))
        return false;
    return true;
}

function isInt(val) {
    var intRegex = /^-?\d+$/;
    if (!intRegex.test(val))
        return false;

    var intVal = parseInt(val, 10);
    return parseFloat(val) == intVal && !isNaN(intVal);
}