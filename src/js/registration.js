// JavaScript Document
$(document).ready(function(){
	
	/***************************************** each click starts ******************************************************************  */
 	$('.registratneachclick').click(function () {
            //registration_active
      if($(this).hasClass('registration_active'))
	  {
		  $(this).removeClass('registration_active')
		  $('#register').css('display','block');
		  $('#user_detail').css('display','none');
		  $('#register_edit').css('display','none');
		  $('#send_message').css('display','none');
	  }else
	  {
		  $('#register').css('display','none');
		  $('#user_detail').css('display','block');
		  $('#register_edit').css('display','none');
		  $('#send_message').css('display','none');
		  $('.registratneachclick').removeClass("registration_active");
	  	  $(this).addClass("registration_active");
		  var regstrno       =  $(this).attr("regno");
		  $.post("load_loyalityreg.php", {value:'loaddetails',regno:regstrno},
			function(data)
			{
			data=$.trim(data);
			$('#loadwhole').html(data);
			  
			});
		  
	  }
   }); 

   /*************************************** each click ends ******************************************************************  */
   
   
   /***************************************** update click starts ******************************************************************  */
 	$('.update_loyalitydetails').click(function () {//registration_active
     	var regstrno ;
		 if($('.registration_active').hasClass('registration_active'))
		  	{
		   		regstrno       =  $('.registration_active').attr("regno");
	  		}
			else
			{
				regstrno ='';
			}
		  //alert(regstrno)
		  $.post("load_loyalityreg.php", {value:'loadlisteach',regno:regstrno},
			function(data)
			{
			data=$.trim(data);
			$('#loadeach').html(data);
			  
			});
		  
	  
   }); 

   /*************************************** update click ends ******************************************************************  */
   
   
   
   /***************************************** search starts ******************************************************************  */
 	$('.search_registration').click(function () {
		
		var filtername=$('#filtername').val(); 
		var filterno=$('#filterno').val(); 
		if(filtername!='' || filterno!='')
		{
//			$('#register').css('display','block');
//		  $('#user_detail').css('display','none');
//		  $('#register_edit').css('display','none');
//                   $('#send_message').css('display','none');
			
			$.post("load_loyalityreg.php", {value:'loadlistall_search',filtername:filtername,filterno:filterno},
			function(data)
			{
			data=$.trim(data);
			$('#listtbl').html(data);
                       
			  
			});
		}
		  
		  
	  
   }); 

   /*************************************** search ends ******************************************************************  */
   
   
});