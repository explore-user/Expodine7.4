// JavaScript Document

$(document).ready(function(){
	/*************************************** auto refresh  starts *************************************************  */
	setInterval(function() {
		var serchval=($('#search').val());
		var selected=$('#ta_loadtakbill').text();
		if(serchval=="")
		{
			
		 $('#ta_listallorders_list').load('load_takeaway.php?value=ta_loadhomedelitem&selectval='+selected);
		}else
		{
			if(selected=="")
			{
				$('#ta_listallorders_list').load('load_takeaway.php?value=ta_searcheachitem_hd&serchval='+serchval);
			}else
			{
				$('#ta_listallorders_list').load('load_takeaway.php?value=ta_searcheachitem_hd&serchval='+serchval+'&selectval='+selected);
			}
		}
		}, 600);
	/*************************************** auto refresh  ends *************************************************  */

	/*************************************** search   starts ************************************************* */ 
	$('#search').change(function (e) {
		var serchval=($(this).val());
		var dataString;
		dataString = 'value=ta_searcheachitem_hd&serchval=' + serchval;
		  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				$('#ta_listallorders_list').html(data);
			}
		});	
		return false;
	
  	});
	/*************************************** search  ends *************************************************  */


	/*************************************** Load popup   starts ************************************************* */ 
	$('.md-trigger_taload').click( function() { 
		var bilno   =  $('#ta_loadtakbill').text();
		 $('.mynewpopupload1').css("display","block"); 
			  $(".olddiv1").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/takeaway_list.php", {bilno:bilno},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload1').html(data);
				  });  
	});
	/*************************************** Load popup  ends *************************************************  */
	
	/*************************************** search   starts ************************************************* */ 
	$('#ta_assigntoadelboy').click(function (e) {
		var bilno   =  $('#ta_loadtakbill').text();
		var kotno=$('#ta_loadtakkotl').text();
		var assignedstaff=($('#asignedstaff').val());
		var assignedtime=($('#assignedtime').val());
		if(assignedstaff=="")
		{
			$('#asignedstaff').addClass('textbox_alert');
			$('#assignedtime').removeClass('textbox_alert');
			$('#asignedstaff').focus();
		}else if(assignedtime=="")
		{
			$('#assignedtime').addClass('textbox_alert');
			$('#asignedstaff').removeClass('textbox_alert');
			$('#assignedtime').focus();
		}else
		{
			if (IsNumeric($("#assignedtime").val()))
			{
				$('#assignedtime').removeClass('textbox_alert');
				$('#asignedstaff').removeClass('textbox_alert');
				$('#ta_loadtakbill').text('');
	  			$('#ta_loadtakkotl').text('');
				$('.viewall').css("display","none");
				$('#ta_loadsutomerdetails').empty();
				var dataString;
				dataString = 'value=assigntodelboy&assignedstaff=' + assignedstaff +"&assignedtime="+assignedtime+"&bilno="+bilno;
				  $.ajax({
					type: "POST",
					url: "load_takeaway.php",
					data: dataString,
					success: function(data) {
							var selected='';
		 					$('#ta_listallorders_list').load('load_takeaway.php?value=ta_loadhomedelitem&selectval='+selected);
							//alert(bilno);alert(kotno);
							dataString = 'value=ta_billhdprint&bilno='+bilno+'&kotno='+kotno;
							   $.ajax({
							  type: "POST",
							  url: "print_details_kot.php",
							  data: dataString,
							  success: function(data) {
								 
								  
								  $('.new_alert_cc').css('display','block');
								  $('.confirm_detail_con_pop').css('display','block');
								  $('.confirm_detail_con_pop').html("Bill printed");
								  
								  }
							  });	
					}
				});	
			}else
			{
				$('#assignedtime').addClass('textbox_alert');
				$('#asignedstaff').removeClass('textbox_alert');
				$('#assignedtime').focus();
			}
		}
		
		return false;
	
  	});
	/*************************************** search  ends *************************************************  */
});
function IsNumeric(strString)
{
  var strValidChars = "0123456789";
  var strChar;
  var blnResult = true;
  if (strString.length == 0) {return false;}
/* var a= strString.length;
  if(strString.length<10 || strString.length>13 )
  {
	
   return false;
  }*/

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
