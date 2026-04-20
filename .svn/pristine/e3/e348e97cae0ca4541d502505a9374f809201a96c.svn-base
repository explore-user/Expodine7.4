// JavaScript Document
$(document).ready(function(){
	/*************************************** auto refresh  starts *************************************************  */
	setInterval(function() {
		var serchval=($('#search').val());
		var selected=$('#ta_loadtakbill').text();
		if(serchval=="")
		{
			//$('.take_active').attr('bilno');
		 $('#ta_listallorders_list_bill').load('load_takeaway.php?value=listalltakeaways_bill&selectval='+selected);
		}else
		{
			if(selected=="")
			{
				$('#ta_listallorders_list_bill').load('load_takeaway.php?value=ta_searcheachitem_bill&serchval='+serchval);
			}else
			{
				$('#ta_listallorders_list_bill').load('load_takeaway.php?value=ta_searcheachitem_bill&serchval='+serchval+'&selectval='+selected);
			}
			//$('#ta_listallorders').load('load_takeaway.php?value=ta_searcheachitem&serchval='+serchval);
		}
		}, 6000);
	/*************************************** auto refresh  ends *************************************************  */
	
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
	$('#search').change(function (e) {
		var serchval=($(this).val());
		var dataString;
		dataString = 'value=ta_searcheachitem_bill&serchval=' + serchval;
		  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				$('#ta_listallorders_list_bill').html(data);
			}
		});	
		return false;
	
  	});
	/*************************************** search  ends *************************************************  */
	
	
	});
