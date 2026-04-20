// JavaScript Document
$(document).ready(function(){
	
	/***************************************** each click starts ******************************************************************  */
 	$('.clickediteach').click(function () {
            //registration_active
		  var regstrno       =  $(this).attr("regno");
		  
		  $('#register_edit').css('display','block');
		  $('#register').css('display','none');
		  $('#user_detail').css('display','none');
		  $.post("load_loyalityreg.php", {value:'useredit',regno:regstrno},
			function(data)
			{
			data=$.trim(data);
			$('#usereditload').html(data);
			  
			});
   }); 

   /*************************************** each click ends ******************************************************************  */
   
   
});