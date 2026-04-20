// JavaScript Document
$(document).ready(function(){
	var portionnamedef="Day";
	/*************************************** Menu selection  starts *************************************************  */
	
	$('.ta_menuitem').click(function (event) { 
		// event.preventDefault();
		 event.stopImmediatePropagation();
		$('#ta_loadbottomcontent').empty();
		//alert("h");
		/*if($(this).find("div").hasClass('take_item_active'))
		{
			$(this).find("div").removeClass('take_item_active'); 
		}else
		{*/	
			$('.ta_menuitem').find("div").removeClass('take_item_active'); 
			$(this).find("div").addClass('take_item_active'); 
		//}
		
		var menuid   =  $(this).attr("menuid");
		menuid=menuid.trim();
		var bchid=$('#bchid').val();
		var dataString;alert(menuid+"--"+bchid)
		dataString = 'value=menubottom&menuid=' + menuid +"&bchid="+bchid;
		$('#ta_loadbottomcontent').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
	   $('#ta_loadbottomcontent').css("vertical-align","middle");
	   $('#ta_loadbottomcontent').css("display","flex");
		var request=  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {alert(data);
					$('#ta_loadbottomcontent').html(data);
					$('#ta_loadbottomcontent').css("text-align","left");
					$('#ta_loadbottomcontent').css("display","inherit");
				}
	  		});
			$.ajaxSetup({cache: false});
			dataString=null;
			data = null;
			request.onreadystatechange = null;
			request.abort = null;
			request = null;
		return true;
	});	
	/***************************************  Menu selection  ends *************************************************  */
	
	/*************************************** Take order  starts *************************************************  */
	$('#ta_addnewtakeaway').click(function (e) {
		var menuid   =  $('.take_item_active').parent().attr("menuid");
		var portion=$('input:radio[name=ta_portion]:checked').val();
		var rate='';
		if($('#manualrate').val()=="Y")
		{
			if($('#rate_value').val()=="" || $('#rate_value').val()=="0")
			{//alert("1")
				rate=$('input:radio[name=ta_portion]:checked').attr('rate');
			}else
			{//alert("2")
				if (IsNumeric_rate($('#rate_value').val()))
				{//alert("3")
					rate=$('#rate_value').val();
				}else
				{//alert("4")
					 $('.ta_errormsg').css("display",'block');
					 $('.ta_errormsg').text("Check Rate...");
					 $('.ta_errormsg').delay(2000).fadeOut('slow');
				}
			}
		}
		else
		{//alert("5")
		 	rate=$('input:radio[name=ta_portion]:checked').attr('rate');
		}//alert(rate);
		//var prefernce=$('#ta_portionhid').val();
		var qty=$('#ta_qty').val();
		var preferncetext=$('#ta_preferencetext').val();
		//alert(preferncetext);
		if(portion==undefined)
		{
			  $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("Select "+portionnamedef+"...");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
		}else if(qty=="")
		{
			
			  $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("Select Quantity...");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
			  
		}
		else
		{
			if (IsNumeric(qty))
			{                            
                            if(qty==0)
                            {
                                 $('.ta_errormsg').css("display",'block');
			  	 $('.ta_errormsg').text("Check Quantity...");
			 	 $('.ta_errormsg').delay(2000).fadeOut('slow');
                            }
                            else
                            {
				var dataString;
				dataString = 'value=menusubmission&menuid='+menuid+"&portion="+portion+"&rate="+rate+"&qty="+qty+"&preferncetext="+preferncetext+"&mode=Add";//alert(dataString);
				$.ajax({
				type: "POST",
				url: "load_takeaway.php",
				data: dataString,
				success: function(data) {
					data=$.trim(data);
					if(data=="ok")
					{
						$('#ta_orderlist').empty();
						$('.ta_errormsg').css("display",'block');
						$('.ta_errormsg').text("Inserted...");
						$('.ta_errormsg').delay(2000).fadeOut('slow');
						dataString = 'value=orderlistload';
						$.ajax({
						type: "POST",
						url: "load_takeaway.php",
						data: dataString,
						success: function(data) {
							
								$('#ta_orderlist').html(data);
								$('.ta_menuitem').find("div").removeClass('take_item_active'); 
								$('#ta_loadbottomcontent').empty();
								
							}
						});
						var dataString1;
						dataString1 = 'value=orderlistload_rate';
						$.ajax({
						type: "POST",
						url: "load_takeaway.php",
						data: dataString1,
						success: function(data1) {
							$('.tal_viewtotal').text(data1.trim());
							}
						});
						
					}
						//$('#ta_orderlist').html(data);
					}
				});
                            }
                            
			}else
			{
				 $('.ta_errormsg').css("display",'block');
			  	 $('.ta_errormsg').text("Check Quantity...");
			 	 $('.ta_errormsg').delay(2000).fadeOut('slow');
			}
		}
		return false;
	});
	/***************************************  Take order  ends *************************************************  */
	/*************************************** Take order update  starts *************************************************  */
	$('#ta_updatetakeaway').click(function (e) {
		
		var menuid   =   $('.ordered_selected').attr("menuid");
		var portion=$('#ta_radiobuton').val();
		
		var rate='';
		if($('#manualrate').val()=="Y")
		{
			if($('#rate_value_edt').val()=="" || $('#rate_value_edt').val()=="0")
			{//alert("1")
				rate=$('.ta_viewrate').text();//$('input:radio[name=ta_portion]:checked').attr('rate');
			}else
			{//alert("2")
				if (IsNumeric_rate($('#rate_value_edt').val()))
				{//alert("3")
					rate=$('#rate_value_edt').val();
				}else
				{//alert("4")
					 $('.ta_errormsg').css("display",'block');
					 $('.ta_errormsg').text("Check Rate...");
					 $('.ta_errormsg').delay(2000).fadeOut('slow');
				}
			}
		}
		else
		{//alert("5")
		 	rate=$('.ta_viewrate').text();//$('input:radio[name=ta_portion]:checked').attr('rate');
		}//alert(rate);
		
		//var rate=$('input:radio[name=ta_portion]:checked').attr('rate');
		//var prefernce=$('#ta_portionhid').val();
		var qty=$('#ta_qty').val();
		var preferncetext=$('#ta_preferencetext').val();
		//alert(menuid+portion+rate+qty+preferncetext);
		if(portion==undefined)
		{
			  $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("Select "+portionnamedef+"...");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
		}else if(qty=="")
		{
			
			  $('.ta_errormsg').css("display",'block');
			  $('.ta_errormsg').text("Select Quantity...");
			  $('.ta_errormsg').delay(2000).fadeOut('slow');
			
		}
		else
		{
			if (IsNumeric(qty))
			{
				var dataString;
				dataString = 'value=menusubmission&menuid='+menuid+"&portion="+portion+"&rate="+rate+"&qty="+qty+"&preferncetext="+preferncetext+"&mode=Edit";//alert(dataString);
				$.ajax({
				type: "POST",
				url: "load_takeaway.php",
				data: dataString,
				success: function(data) {
					data=$.trim(data);//alert(data);
					if(data=="ok")
					{
						$('#ta_orderlist').empty();
						$('.ta_errormsg').css("display",'block');
						$('.ta_errormsg').text("Inserted...");
						$('.ta_errormsg').delay(2000).fadeOut('slow');
						dataString = 'value=orderlistload';
						$.ajax({
						type: "POST",
						url: "load_takeaway.php",
						data: dataString,
						success: function(data) {
							
								$('#ta_orderlist').html(data);
								$('.ta_menuitem').find("div").removeClass('take_item_active');
								$('.ta_diableforedit').removeClass('takeaway_disable'); 
								$('#ta_loadbottomcontent').empty();
								
							}
						});
						var dataString1;
						dataString1 = 'value=orderlistload_rate';
						$.ajax({
						type: "POST",
						url: "load_takeaway.php",
						data: dataString1,
						success: function(data1) {
							$('.tal_viewtotal').text(data1.trim());
							}
						});
						
					}
						//$('#ta_orderlist').html(data);
					}
				});
			}else
			{
				 $('.ta_errormsg').css("display",'block');
			  	 $('.ta_errormsg').text("Check Quantity...");
			 	 $('.ta_errormsg').delay(2000).fadeOut('slow');
			}
		}
		return false;
	});
	/***************************************  Take order update ends *************************************************  */
	/*************************************** Radio button  starts *************************************************  */
	$('.ta_radiobuton').change(function (e) {
		var ratev=($('input:radio[name=ta_portion]:checked').attr('rate'));
		$('.ta_viewrate').text(ratev);
		return false;
	});
	/*************************************** Radio button ends *************************************************  */
	
});

function IsNumeric(strString)
{
  var strValidChars = "0123456789 ";
  var strChar;
  var blnResult = true;
  if (strString.length == 0) {return false;}
 /*var a= strString.length;
  if(strString.length<10 || strString.length>13 )
  {
	
   return false;
  }
*/
  for (i = 0; i < strString.length && blnResult == true; i++)
     {
     strChar = strString.charAt(i);
     if (strValidChars.indexOf(strChar) == -1)
        {
       	blnResult = false;
        }
     }
  return blnResult;
  
}

function IsNumeric_rate(strString)
{
  var strValidChars = "0123456789 .";
  var strChar;
  var blnResult = true;
  if (strString.length == 0) {return false;}
 /*var a= strString.length;
  if(strString.length<10 || strString.length>13 )
  {
	
   return false;
  }
*/
  for (i = 0; i < strString.length && blnResult == true; i++)
     {
     strChar = strString.charAt(i);
     if (strValidChars.indexOf(strChar) == -1)
        {
       	blnResult = false;
        }
     }
  return blnResult;
  
}

