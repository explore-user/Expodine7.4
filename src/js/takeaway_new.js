// JavaScript Document

$(document).ready(function(){
	
	/*************************************** category selection  starts *************************************************  */
	$('.ta_categorysel').click(function (e) {
		//e.preventDefault();
		$('#ta_loadbottomcontent').empty();
		$('#search').val('');
	  $(".ta_categorysel>div").removeClass("main_category_list_act");
      $(this).find("div").addClass('main_category_list_act'); 
	  var id_str   =  $(this).attr("catid");
	  var id_arr	  =	 id_str.split("_");
	  var cat_id       = id_arr[1];
	  $('#ta_catname').val(cat_id);
	  var dataString = 'value=subcatselection&category=' + cat_id;
	 var request=  $.ajax({
		type: "POST",
		url: "load_takeaway.php",
		data: dataString,
		success: function(data) {
		 $('#ta_loadsubcat').html(data);
		}
	  });
	   data = null;
		 dataString = null;
	   $('#ta_loadmenuitems').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
	   $('#ta_loadmenuitems').css("vertical-align","middle");
	  $('#ta_loadmenuitems').css("display","flex");
	  dataString = 'value=menuselection&category=' + cat_id;
	  var request= $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				 $('#ta_loadmenuitems').html(data);
				 $('#ta_loadmenuitems').css("text-align","left");
				 $('#ta_loadmenuitems').css("display","inherit");
			}
	 	 });
		 data = null;
		 dataString = null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;	
	  return false;
	
  });
	/***************************************  category selection  ends *************************************************  */
	
	
	/*************************************** Sub category selection  starts *************************************************  */
	
	$('.ta_subcatchange').change(function (e) {
		$('#ta_loadmenuitems').empty();
		$('#ta_loadbottomcontent').empty();
		$('#search').val('');
		var subcategory=$(this).val();
		var categoryid=$('#ta_catname').val();
		subcategory=subcategory.trim();
		var dataString;
		if(subcategory!="all")
		{
		    dataString = 'value=menuselection&category=' + categoryid +'&subcategory=' + subcategory;
		}else
		{
			 dataString = 'value=menuselection&category=' + categoryid;
		}
	   $('#ta_loadmenuitems').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
	   $('#ta_loadmenuitems').css("vertical-align","middle");
	   $('#ta_loadmenuitems').css("display","flex");
		var request=  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
					$('#ta_loadmenuitems').html(data);
					$('#ta_loadmenuitems').css("text-align","left");
					$('#ta_loadmenuitems').css("display","inherit");
				}
	  		});
			 data = null;
		 dataString = null;
		request.onreadystatechange = null;
		request.abort = null;
		request = null;
		 return false;
	});	
	/*************************************** Sub category selection  ends *************************************************  */

	/*************************************** Sub category selection  starts *************************************************  */
	$('.ta_submit_orders').click(function (e) {
		//ta_name ta_address ta_landmark ta_area ta_mobile ts_homed
		var name=$('#ta_name').val();
		var address=$('#ta_address').val();
		var ordaddress=$('#ta_orderaddress').val();
		var landmark=$('#ta_landmark').val();
		var area=$('#ta_area').val();
		var mobile=$('#ta_mobile').val();
                var gst=$('#ta_gst').val();
		//alert(ordaddress);
		var homed;
		if($("#ts_homed").is(':checked'))
			homed="HD";  // checked
		else
		{
			if($("#ts_take").is(':checked'))
			homed="TA"; 
			else
			homed="CS";
		}
		/*if(name=="")
		{
			//alert("Enter Name");
			$('#ta_name').addClass('textbox_alert');
			$('#ta_mobile').removeClass('textbox_alert');
			$('#ta_landmark').removeClass('textbox_alert');
			$('#ta_name').focus();
		}else if(mobile=="")
		{
			//alert("Enter Mobile");
			$('#ta_mobile').addClass('textbox_alert');
			$('#ta_name').removeClass('textbox_alert');
			$('#ta_landmark').removeClass('textbox_alert');
			$('#ta_mobile').focus();
		}else
		{*/
			if(homed=="TA" || homed=="CS")
			{
				if($("#ta_mobile").val()!='')
				{
					if(IsNumeric($("#ta_mobile").val()))
						{
							return true;
						}else
						{
							$('#ta_mobile').addClass('textbox_alert');
							$('#ta_name').removeClass('textbox_alert');
							$('#ta_landmark').removeClass('textbox_alert');
							$('#ta_mobile').focus();
							return false;
						}
				}
				
					$('#ta_mobile').removeClass('textbox_alert');
					$('#ta_name').removeClass('textbox_alert');
					$('#ta_landmark').removeClass('textbox_alert');
					var dataString;
					//dataString = 'value=submitvalues&name=' + name +'&address=' + address +'&landmark=' + landmark +'&area=' + area +'&mobile=' + mobile +'&homed=' + homed +'&ordaddress=w';//alert(dataString)
					dataString = 'value=submitvalues&name=' + name +'&address=' + address +'&landmark=' + landmark +'&area=' + area +'&mobile=' + mobile +'&homed=' + homed+'&gst='+gst;//alert(dataString)
				//dataString = 'value=submitvalues&name=' + name +'&address=' + address +'&orderaddr='+ ordaddress +'&landmark=' + landmark +'&area=' + area +'&mobile=' + mobile +'&homed=' + homed;//alert(dataString)
					
				
					 $.ajax({
					type: "POST",
					url: "load_takeaway.php",
					data: dataString,
					success: function(data) {
						//window.location="take_away.php";
						dataString = 'value=ta_kotprint';
						 $.ajax({
						type: "POST",
						url: "print_details_kot.php",
						data: dataString,
						success: function(data1) {
							
							var dataString; 
								  dataString = 'value=console_ta';
							   $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data2) {
							  }
							  });
							$('.new_alert_cc').css('display','block');
							$('.confirm_detail_con_pop').css('display','block');
							$('.confirm_detail_con_pop').html(data);
							
							
							var dataString; 
							dataString = 'value=ta_billprint&bypass=y';
							 $.ajax({
							type: "POST",
							url: "print_details_kot.php",
							data: dataString,
							success: function(data) {
								data=data.trim();
								if(data=="ok")
								{
								/*$('.new_alert_cc').css('display','block');
								$('.confirm_detail_con_pop').css('display','block');
								$('.confirm_detail_con_pop').html("Bill printed");*/
								}
								
								}
							});	
							
							}
						});	
						
						}
					});
				
			}else if(homed=="HD")
			{
				if(landmark=="")
				{
					$('#ta_landmark').addClass('textbox_alert');
					$('#ta_mobile').removeClass('textbox_alert');
					$('#ta_name').removeClass('textbox_alert');
					$('#ta_landmark').focus();
				}else
				{
					$('#ta_mobile').removeClass('textbox_alert');
					$('#ta_name').removeClass('textbox_alert');
					$('#ta_landmark').removeClass('textbox_alert');
					var dataString;
					dataString = 'value=submitvalues&name=' + name +'&address=' + address +'&orderaddr='+ ordaddress +'&landmark=' + landmark +'&area=' + area +'&mobile=' + mobile +'&homed=' + homed+'&gst='+gst;
					 $.ajax({
					type: "POST",
					url: "load_takeaway.php",
					data: dataString,
					success: function(data) {
						//window.location="take_away.php";
						dataString = 'value=ta_kotprint';
						 $.ajax({
						type: "POST",
						url: "print_details_kot.php",
						data: dataString,
						success: function(data1) {
							var dataString; 
								  dataString = 'value=console_ta';
							   $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data2) {
							  }
							  });
							  
							$('.new_alert_cc').css('display','block');
							$('.confirm_detail_con_pop').css('display','block');
							$('.confirm_detail_con_pop').html(data);
							
							dataString = 'value=ta_billhdprint&bypass=y';
							 $.ajax({
							type: "POST",
							url: "print_details_kot.php",
							data: dataString,
							success: function(data) {
								data=data.trim();
								if(data=="ok")
								{
								/*$('.new_alert_cc').css('display','block');
								$('.confirm_detail_con_pop').css('display','block');
								$('.confirm_detail_con_pop').html("Bill printed");*/
								}
								}
							});
							
							}
						});	
						
						}
					});
				}
			}
			
		//}
		return false;
	});	
	/*************************************** Sub category selection  ends *************************************************  */
	
	/*************************************** Home delvry chk box click  starts *************************************************  */
	$('.home').click(function (e) {//.home_dry_chk
	$('.take').attr('checked', false);
		if($("#ts_homed").is(':checked'))
		{
			$('.enlandmrk').css('display','block');
			$('.enname').css('display','block');
			$('.enmobile').css('display','block');
		}
		else
		{
			$('.enlandmrk').css('display','none');
			$('#ta_landmark').removeClass('textbox_alert');
			$('.enname').css('display','none');
			$('#ta_name').removeClass('textbox_alert');
			$('.enmobile').css('display','none');
			$('#ta_mobile').removeClass('textbox_alert');
		}
		
		
		
		
	});	
	/*************************************** Home delvry chk box click  ends *************************************************  */
	
	/*************************************** Take away chk box click  starts *************************************************  */
	$('.take').click(function (e) {//.home_dry_chk
		
		$('.home').attr('checked', false);
		if($("#ts_take").is(':checked'))
		{
			$('.enlandmrk').css('display','none');
			$('#ta_landmark').removeClass('textbox_alert');
			$('.enname').css('display','none');
			$('#ta_name').removeClass('textbox_alert');
			$('.enmobile').css('display','none');
			$('#ta_mobile').removeClass('textbox_alert');
		}
		else
		{
			$('.enlandmrk').css('display','none');
			$('#ta_landmark').removeClass('textbox_alert');
			$('.enname').css('display','none');
			$('#ta_name').removeClass('textbox_alert');
			$('.enmobile').css('display','none');
			$('#ta_mobile').removeClass('textbox_alert');
		}
		
		
	});	
	/*************************************** Take away chk box click  ends *************************************************  */
	
	/*************************************** search starts *************************************************  */
	
	$('.ui-corner-all').click(function (e) {
		var idstf=($('#hid_namv').val())
		
		return false;
	});	
	
	/*************************************** search  starts *************************************************  */
	
});

function IsNumeric(strString)
{
  var strValidChars = "0123456789-+(). ";
  var strChar;
  var blnResult = true;
  if (strString.length == 0) {return false;}
 var a= strString.length;
  if(strString.length<10 || strString.length>13 )
  {
	
   return false;
  }

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

