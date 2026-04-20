// JavaScript Document
$(document).ready(function(){
	
	/*************************************** Take away staff each item selection starts ************************************************* */ 
	$('.ta_stafeachitemselection').click(function (e) {
		e.preventDefault();
		$('.ta_stafeachitemselection').removeClass("order_detail_active");
		$(this).addClass('order_detail_active'); 
		/*if($(this).hasClass('order_detail_active'))
		{
			$(this).removeClass("order_detail_active");
		}else
		{
			$(this).addClass('order_detail_active'); 
		}*/
		var totalrate=0;
		var selected_activities =$('.order_detail_active').find('.staf_rate');
		selected_activities.each(function(){
			 totalrate= parseFloat(totalrate) + parseFloat($(this).text());
		});
		$('.ta_totalcashtopay').text(totalrate);
		/*var stafbill=new Array();
		var selected_activities_st =$('.order_detail_active').find('.staf_code');
		selected_activities_st.each(function(){
			var st       =  $(this).text();
				if(st!='undefined' && st!='' && st!=null){
					stafbill.push(st);
				}
		});*/
		if($('.ta_stafeachitemselection').hasClass('order_detail_active'))
		{
			$('#ta_bildeatils').css("display","block");
			$("#paidamount").focus();
			$('#ta_submitbutton').css("display","block");
		}else
		{
			$('#ta_bildeatils').css("display","none");
			$("#paidamount").focus();
			$('#ta_submitbutton').css("display","none");
		}
	 
	  return false;
	
  	});
	/***************************************  Take away staff each item selection  ends *************************************************  */
	
	


});