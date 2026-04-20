// JavaScript Document
$(document).ready(function(){
	
	/*************************************** Take away staff selection starts ************************************************* */ 
	$('.ta_staffeachselect').click(function (e) {
		//e.preventDefault();
		$('#ta_listorderdetails').empty();
		$('.ta_totalcash').empty();
		$('.ta_totalcashtopay').empty();
		//$('#search').val('');
		$('#ta_bildeatils').css("display",'none');
			$('#ta_submitbutton').css("display",'none');
	  $('.ta_staffeachselect').removeClass("staf_view_act");
      $(this).addClass('staf_view_act'); 
	  var staffid   =  $(this).attr("staffid");
	   var dataString;
	   $('#ta_listorderdetails').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
	   $('#ta_listorderdetails').css("vertical-align","middle");
	  $('#ta_listorderdetails').css("display","flex");
	  dataString = 'value=ta_staffselection&staffid=' + staffid;
	  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				 $('#ta_listorderdetails').html(data);
				 $('#ta_listorderdetails').css("text-align","left");
				 $('#ta_listorderdetails').css("display","inherit");
			}
	 	 });
	  return false;
	
  	});
	/***************************************  Take away staff selection  ends *************************************************  */
	
	

});
