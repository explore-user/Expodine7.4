// JavaScript Document

$(document).ready(function(){
	
	/*************************************** Each row selection starts ************************************************* */ 
	$('.selecteachrowtopack').click(function (e) {
		
	if($(this).hasClass('tka_kottable_selected'))
	{
		$(this).removeClass('tka_kottable_selected'); 
	}else
	{
		$(this).addClass('tka_kottable_selected'); 
	}
	 return false;
	
  	});
	/***************************************  Each row selection  ends *************************************************  */
	
	/*************************************** Take away bill selection starts ************************************************* */ 
	$('.takeawayeachclick').click(function (e) {
		e.preventDefault();
		$('#ta_listpayemnt').css('display','block');
		$('#ta_divview').css('display','block');
		$('#ta_vieword').css('display','block');
		$('#ta_orl').css('display','block'); 
		$('#ta_divsub').css('display','block');
		$('#ta_staffsubmit').css('display','block');
	  $('.takeawayeachclick').removeClass("take_active");
      $(this).addClass('take_active'); 
	  var bilno   =  $(this).attr("bilno");
	  var kotno   =  $(this).attr("kotno");
	  var netamount   =  $(this).attr("netamount");
	   var dataString;
	  $('#ta_loadtakbill').text(bilno);
	   $('#ta_loadtakkotl').text(kotno);
	   $('#ta_loadtakbillamount').text(netamount);
	  return false;
	
  	});
	/***************************************  Take away bill selection  ends *************************************************  */
	
	
	
	
});