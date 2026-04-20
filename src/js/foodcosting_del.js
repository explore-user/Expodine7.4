// JavaScript Document
$(document).ready(function(){
	
	/*****************************************  click row starts *********************************************************  */
	$('.food_item_del').click(function () { 
	
	$(".index_popup_1").show();
	$(".confrmation_overlay").show();
	
	var menu       =  $(this).attr("menu");
	var slno       =  $(this).attr("slno");
	var ingr       =  $(this).attr("ingr");
	//alert(menu+slno+ingr)
	//hidmenuingr_ck hidslnoingr_ck hidingringr_ck
	$('#hidmenuingr_ck').val(menu);
	$('#hidslnoingr_ck').val(slno);
	$('#hidingringr_ck').val(ingr);
		}); 
	
	/***************************************  submit  ends ******************************************************************  */
	

	  $(".btn_index_popup").click(function() {
		$(".index_popup_2").hide();
		$(".index_popup_1").hide();
		$(".confrmation_overlay").hide();
		$('#hidmenuingr_ck').val('');
		$('#hidslnoingr_ck').val('');
		$('#hidingringr_ck').val('');
	 });
	 
	 
	/*****************************************  delete row starts *********************************************************  */
	$('.closeok').click(function () { 
	
	var menu=$('#hidmenuingr_ck').val();
	var slno=$('#hidslnoingr_ck').val();
	var ingr=$('#hidingringr_ck').val();
	//alert(menu+slno+ingr)
	
	$.ajax({
			type: "POST",
			url: "load_foodcosting.php",
			data: "value=deleteeachitemingr&menu="+menu+"&slno="+slno+"&ingr="+ingr,
			success: function(msg)
			{//alert(msg.trim());
			msg=msg.trim();//alert(msg);
				if(msg=="ok")
				{
					$("#errortotally").css("display","block");
					$("#errortotally").text("Deleted");
					$("#errortotally").delay(2000).fadeOut('slow');
					//$('.food_increant_table_container').load('load_foodcosting.php?value=listallingredients&menuid='+menu);
					
					 
					
				}else
				{
					$("#errortotally").css("display","block");
					$("#errortotally").text("Sorry....");
					$("#errortotally").delay(2000).fadeOut('slow');
				}
				
			}
		});
	
	
	
	
	//$('.food_increant_table_container').load('load_foodcosting.php?value=listallingredients&menuid='+menu);
	$('.food_increant_table_container').load('load_foodcosting.php?value=listallingredients&menuid='+menu);
   $('#loadprepmeth').load('load_foodcosting.php?value=listprepmethod&menuid='+menu);
   $('.totalcostloading').load('load_foodcosting.php?value=totalcostlisting&menuid='+menu);
   $('.projectcaltotal').load('load_foodcosting.php?value=projectcalculator&menuid='+menu); 
   $('.servingcoutset').load('load_foodcosting.php?value=servingcoutsetcalc&menuid='+menu);
   $('#loadfullimages').load('load_foodcosting.php?value=loadimagestotal&menuid='+menu);
	
	$.ajax({
			type: "POST",
			url: "load_foodcosting.php",
			data: "value=projectcalculator&menuid="+menu,
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
				  var data = {
				  "value"				: "submitsellpp",
				  "menuidselected"	    : menu,
				  "sellpp"				: sellpp,
				  "basedpccost"			: basedpccost
				};
				 $.ajax({
					type: "POST",
					url: "load_foodcosting.php",
					data: data,
					success: function(msg)
					{
						msg=msg.trim();
						//$('.projectcaltotal').load('load_foodcosting.php?value=projectcalculator&menuid='+menu); 
						$.ajax({
							  type: "POST",
							  url: "load_foodcosting.php",
							  data: "value=projectcalculator&menuid="+menu,
							  success: function(msg)
							  {
								  $('.projectcaltotal').html(msg);
								  if(pc_cost=='' || pc_cost=='0.00')
								  {
									  $('#sellpp').val('');
								  }
							  }
							});
						
						
						
					}
				});
			  }
			 }
			
			 
			 	
				
			}
		});
	
	
	
	
				   
	//$('#hidmenuingr_ck').val('');
	//$('#hidslnoingr_ck').val('');
	//$('#hidingringr_ck').val('');
	
	});
	/***************************************  delete ok  ends ******************************************************************  */
	
	
	/*****************************************  delete row starts *********************************************************  */
	$('.editeachbuttoncheck').click(function () { 
		  var menu       =  $(this).attr("menu");
		  var slno       =  $(this).attr("slno");
		  var ingr       =  $(this).attr("ingr");
		  //alert(menu+slno+ingr)
		 
		  $("#editingredientswholediv").css("display","block"); 
		  $("#addingredientswholediv").css("display","none");
		  //ingname_edit ingidselected_edit uniting_edit unitcost_edit costingr_edit wastingr_edit wastcostingr_edit totalcostingr_edit
		  /*$.ajax({
			type: "POST",
			url: "load_foodcosting.php",
			data: "value=editeachitemingr&menu="+menu+"&slno="+slno+"&ingr="+ingr,
			success: function(msg)
			{
				msg=msg.trim();*/
			$('#editingredientswholediv').load('load_foodcosting.php?value=editeachitemingr&menu='+menu+'&slno='+slno+'&ingr='+ingr);
					
				
				
			/*}
		});*/
		  
		  
	});
	/***************************************  delete ok  ends ******************************************************************  */
	
	
	
		}); 