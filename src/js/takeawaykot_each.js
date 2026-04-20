// JavaScript Document
$(document).ready(function(){
	
	/*************************************** Take away kot selection starts ************************************************* */ 
	$('.takeawaykoteachclick').click(function (e) {
           // alert('du');
		e.preventDefault();
		$('#ta_listcontainer').empty();
		//$('#search').val('');
	  $('.takeawaykoteachclick').removeClass("take_active");
      $(this).addClass('take_active');
      
	  var bilno   =  $(this).attr("bilno");
	  var kotno   =  $(this).attr("kotno");
          
//          $('.take_order_item_name').removeClass('ta_prnt_act');
//          $('[bill='+bilno+']').addClass('ta_prnt_act');
          
	   var dataString;
	  $('#ta_loadtakbill').text(bilno);
	  $('#ta_loadtakkotl').text(kotno);
	   $('#ta_listcontainer').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
	   $('#ta_listcontainer').css("vertical-align","middle");
	  $('#ta_listcontainer').css("display","flex");
	  dataString = 'value=takotselection&bilno=' + bilno +"&kotno="+kotno;
	  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				 $('#ta_listcontainer').html(data);
				 $('#ta_listcontainer').css("text-align","left");
				 $('#ta_listcontainer').css("display","inherit");
			}
	 	 });
	  return false;
	
  	});
	/***************************************  Take away kot selection  ends *************************************************  */
	
	/*************************************** Take away kot selection HOme del starts ************************************************* */ 
	$('.takeawaykoteachclick_home').click(function (e) {
		e.preventDefault();
		$('#ta_listcontainer').empty();
		//$('#search').val('');
	  $('.takeawaykoteachclick_home').removeClass("take_active");
      $(this).addClass('take_active'); 
	  var bilno   =  $(this).attr("bilno");
	  var kotno   =  $(this).attr("kotno");
	   var cutomerid   =  $(this).attr("cutomerid");
	   var dataString;
	  $('#ta_loadtakbill').text(bilno);
	  $('#ta_loadtakkotl').text(kotno);
	  dataString = 'value=tafillcuromerinfrm&cutomerid=' + cutomerid;
	  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				 $('#ta_loadsutomerdetails').html(data);
				  $('.viewall').css("display","block");
			}
	 	 });
		 
	  return false;
	
  	});
	/***************************************  Take away kot selection HOme del  ends *************************************************  */
	
	/*************************************** Take away kot selection starts ************************************************* */ 
	$('.takeawaykoteachclick_search').click(function (e) {
		//e.preventDefault();
		$('#ta_listcontainer').empty();
		//$('#search').val('');
	  $('.takeawaykoteachclick_search').removeClass("take_active");
      $(this).addClass('take_active'); 
	  var bilno   =  $(this).attr("bilno");
	  var kotno   =  $(this).attr("kotno");
	   var dataString;
	  $('#ta_loadtakbill').text(bilno);
	  $('#ta_loadtakkotl').text(kotno);
	   $('#ta_listcontainer').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
	   $('#ta_listcontainer').css("vertical-align","middle");
	  $('#ta_listcontainer').css("display","flex");
	  dataString = 'value=takotselection_search&bilno=' + bilno +"&kotno="+kotno;
	  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				 $('#ta_listcontainer').html(data);
				 $('#ta_listcontainer').css("text-align","left");
				 $('#ta_listcontainer').css("display","inherit");
			}
	 	 });
	  return false;
	
  	});
	/***************************************  Take away kot selection  ends *************************************************  */


});