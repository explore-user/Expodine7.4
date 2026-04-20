// JavaScript Document

$(document).ready(function(){
	/*************************************** auto refresh  starts *************************************************  */
	setInterval(function() {
		var serchval=($('#search').val());
		var selected=$('#ta_loadtakbill').text();
		if(serchval=="")
		{
		 $('#cs_listallorders').load('load_counter_sales.php?value=listallcountersale&selectval='+selected);
		}else
		{
			if(selected=="")
			{
				$('#cs_listallorders').load('load_takeaway.php?value=ta_searcheachitem&serchval='+serchval);
			}else
			{
				$('#cs_listallorders').load('load_takeaway.php?value=ta_searcheachitem&serchval='+serchval+'&selectval='+selected);
			}
		}
		}, 3000);
	/*************************************** auto refresh  ends *************************************************  */
	
	
	/*************************************** assign to pack  starts ************************************************* */ 
	$('.ta_assignpackedtotr').click(function (e) {// selecteachrowtopack//tka_kottable_selected
//            alert('cs');
//	if($('.takeawaykoteachclick').hasClass('take_active') && $('.selecteachrowtopack').hasClass('tka_kottable_selected') )
//	{  
		 var dataString;
		var assignstatus=$(this).attr("status");// alert(assignstatus)
		var selected_activities =$('.tka_kottable_selected');
		var sln = new Array();
		selected_activities.each(function(){
			
			var sol      =  $(this).attr("slno");
				if(sol!='undefined' && sol!='' && sol!=null){
					sln.push(sol);
				}
		
		});//alert(sln);
		var bilno=$('.take_active').attr("bilno");
		var kotno=($('#ta_loadtakkotl').text());
		var bilnnno=($('.tka_kottable_selected').attr("billno"));//alert(bilno);alert(kotno);
		dataString = 'value=ta_setstauspacked&bilno=' + bilno +"&sln="+sln+"&kot="+kotno+"&assign="+assignstatus;
		//dataString = 'value=ta_setstauspacked&bilno=' + bilno +"&kot="+kotno;
                
	  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				//alert(data);
				 $('.ta_errormsgkot').css("display",'block');
			  	$('.ta_errormsgkot').text("Updated...");
			  	$('.ta_errormsgkot').delay(2000).fadeOut('slow');
				
				$('#ta_listcontainer').html('<img src="img/ajax-loaders/ajax-loader.gif" height="70px" style="margin:auto"  />');
			   $('#ta_listcontainer').css("vertical-align","middle");
			  $('#ta_listcontainer').css("display","flex");
			  dataString = 'value=takotselection&bilno=' + bilnnno +"&kotno="+kotno;
			  $.ajax({
					type: "POST",
					url: "load_takeaway.php",
					data: dataString,
					success: function(data) {
						 $('#ta_listcontainer').html(data);
						 var selected="";
						 selected=$('#ta_loadtakbill').text();//$('.take_active').attr('bilno');
		 				 $('#cs_listallorders').load('load_counter_sale.php?value=listallcountersale&selectval='+selected);
						 $('#ta_listcontainer').css("text-align","left");
						 $('#ta_listcontainer').css("display","inherit");
					}
				 });
				
				
			}
	 	 });
//	}else
//	{
//		$('.ta_errormsgkot').css("display",'block');
//		$('.ta_errormsgkot').text("No items Selected...");
//		$('.ta_errormsgkot').delay(2000).fadeOut('slow');
//	}
	$('.selectallit').prop('checked', false);
	 return false;
	
  	});
	/*************************************** assign to pack  ends *************************************************  */

	/*************************************** search   starts ************************************************* */ 
	$('#search').change(function (e) {
		var serchval=($(this).val());
		var dataString;
		dataString = 'value=ta_searcheachitem&serchval=' + serchval;
		  $.ajax({
			type: "POST",
			url: "load_takeaway.php",
			data: dataString,
			success: function(data) {
				$('#cs_listallorders').html(data);
			}
		});	
		return false;
	
  	});
	/*************************************** search  ends *************************************************  */

	
});