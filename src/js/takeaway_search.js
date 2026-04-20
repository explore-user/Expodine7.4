// JavaScript Document

$(document).ready(function(){
	/*************************************** auto refresh  starts *************************************************  */
	setInterval(function() {
		var serchval=($('#search').val());
		var selected=$('#ta_loadtakbill').text();
		if(serchval=="")
		{
		 $('#ta_listallorders_search').load('load_takeaway.php?value=listalltakeaways_search&selectval='+selected);
		}else
		{
			if(selected=="")
			{
				$('#ta_listallorders_search').load('load_takeaway.php?value=ta_searcheachitem_search&serchval='+serchval);
			}else
			{
				$('#ta_listallorders_search').load('load_takeaway.php?value=ta_searcheachitem_search&serchval='+serchval+'&selectval='+selected);
			}
		}
		}, 3000);
	/*************************************** auto refresh  ends *************************************************  */
	
	/*************************************** search   starts ************************************************* */ 
	$('#search').change(function (e) {
           
		var serchval=($(this).val());
		var dataString;
		dataString = 'value=ta_searcheachitem_search&serchval=' + serchval;
		  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				$('#ta_listallorders_search').html(data);
			}
		});	
		return false;
	
  	});
	/*************************************** search  ends *************************************************  */

	
});