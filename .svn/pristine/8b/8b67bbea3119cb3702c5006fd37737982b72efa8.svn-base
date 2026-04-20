// JavaScript Document
$(document).ready(function(){

/***************************************** qty change edit starts **********************************************************  */
	  $('#qtyingr_edit').change(function () { 
	  var qtyingr=parseFloat($('#qtyingr_edit').val());
	  var unitcost=parseFloat($('#unitcost_edit').val());
	  if(!isNaN(qtyingr))
	  {
		  var total=qtyingr *  unitcost;
		  $('#costingr_edit').val(total.toFixed(2));
		  $('#totalcostingr_edit').val(total.toFixed(2));
		  $('#wastingr_edit').focus();
		  
		  //wastage and total calculation
		  var qtyingr=parseFloat($('#qtyingr_edit').val());
	  	  var wastingr=parseFloat($('#wastingr_edit').val());
	  	  var unitcost=parseFloat($('#unitcost_edit').val());
	  
	  if(qtyingr1='' && wastingr!='' &&  unitcost!='')
	  {
	   	  var totals=((qtyingr * wastingr)/100) * unitcost;
		  $('#wastcostingr_edit').val(totals.toFixed(2));
		  
		 // var costingr=parseFloat($('#costingr_edit').val());
		 // var wastcostingr=parseFloat($('#wastcostingr_edit').val());
		  
		  //var totalcost=costingr - wastcostingr;
		  //$('#totalcostingr_edit').val(totalcost.toFixed(2));
	  }
		  
		  
	  }else
	  {
		  $("#errortotally").css("display","block");
		  $("#errortotally").text("Check Quantity");
		  $("#errortotally").delay(2000).fadeOut('slow');
	  }
	  
	   
	 });
	/***************************************  qty change edit  ends *************************************************************  */   
	/***************************************** qty change starts **********************************************************  */
	  $('#wastingr_edit').change(function () { 
	  var qtyingr=parseFloat($('#qtyingr_edit').val());
	  var wastingr=parseFloat($('#wastingr_edit').val());
	  var unitcost=parseFloat($('#unitcost_edit').val());
	 if(!isNaN(wastingr))
	  {
		  var total=((qtyingr * wastingr)/100) * unitcost;
		  $('#wastcostingr_edit').val(total.toFixed(2));
		  //total calculation
		  var costingr=parseFloat($('#costingr_edit').val());
		  var wastcostingr=parseFloat($('#wastcostingr_edit').val());
		  
		 // var totalcost=costingr - wastcostingr;
		 // $('#totalcostingr_edit').val(totalcost.toFixed(2));
	  }else
	  {
		  $("#errortotally").css("display","block");
		  $("#errortotally").text("Check Wastage");
		  $("#errortotally").delay(2000).fadeOut('slow');
	  }
	   
	 });
	/***************************************  qty change  ends ******************************************************************  */
	/***************************************** close edit starts **********************************************************  */
	 $('.closeeditingr').click(function () { 
		  $("#editingredientswholediv").css("display","none"); 
		  $("#addingredientswholediv").css("display","block");
	
	 });
	/***************************************   close edit  ends ******************************************************************  */
	
	
	/***************************************** close edit starts **********************************************************  */
	 $('#editingrvalues').click(function () {
		var menuidselected	=	$('#menuidselected').val();
		var menuname		=	$('#menuname').val();
	  	var ingidselected	=	$('#ingidselected_edit').val();
		var ingname			=	$('#ingname_edit').val();
		var qtyingr			=	$('#qtyingr_edit').val();
		var wastingr		=	$('#wastingr_edit').val();
		
		var uniting			=	$('#uniting_edit').val();
		var unitcost		=	$('#unitcost_edit').val();
		var costingr		=	$('#costingr_edit').val();
		var wastcostingr	=	$('#wastcostingr_edit').val();
		var totalcostingr	=	$('#totalcostingr_edit').val();
	  //qtyingr uniting unitcost costingr wastingr wastcostingr totalcostingr
	  
	   var ingidslno_edit	=	$('#ingidslno_edit').val();
	    
		var wastcostingr	=	$('#wastcostingr_edit').val();
		var totalcostingr	=	$('#totalcostingr_edit').val();
	    
	  
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
								"value"				: "editingredients",
								"menuidselected"	: menuidselected,
								"ingidselected"		: ingidselected,
								"qtyingr"			: qtyingr,
								"uniting"			: uniting,
								"unitcost" 			: unitcost,
								"costingr" 			: costingr,
								"wastingr" 			: wastingr,
								"wastcostingr" 		: wastcostingr,
								"totalcostingr" 	: totalcostingr,
								"ingidslno_edit" 	: ingidslno_edit
							  };
							   data = $(this).serialize() + "&" + $.param(data);
							   //alert(data)
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
										  		$('.food_increant_table_container').load('load_foodcosting.php?value=listallingredients&menuid='+menuidselected);
										  		$('#qtyingr_edit').val('');
												$('#wastingr_edit').val('');
												$('#uniting_edit').find('option:first').attr('selected', 'selected');
												$('#unitcost_edit').val('');
												$('#costingr_edit').val('');
												$('#wastcostingr_edit').val('');
	   											$('#totalcostingr_edit').val('');
												//$('#menuidselected').val('');
												//$('#menuname').val('');
												$('#ingidselected_edit').val('');
												$('#ingname_edit').val('');
												
												$("#editingredientswholediv").css("display","none"); 
												$("#addingredientswholediv").css("display","block");
										  
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
	/***************************************   close edit  ends ******************************************************************  */
	
		}); 