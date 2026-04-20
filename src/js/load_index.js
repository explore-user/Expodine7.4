// JavaScript Document
$(document).ready(function(){
 /***************************************  ok click starts ******************************************************************  */
   $('#stafflist').change(function () {
		var stafflist       = $("#stafflist").find('option:selected').attr('cancelkey');//alert(stafflist);
		//alert(stafflist)
		if(stafflist=='Y')
		{
			$(' #typeentery ').text('OTP');
			$(' .btn_index_popup_send ').css('display','block');
			$(' .btn_index_popup_send a').css('display','block');
		}else
		{
			$(' #typeentery ').text('Password');
			$(' .btn_index_popup_send').css('display','none');
			$(' .btn_index_popup_send a').css('display','block');
		}
		/*$.post("load_bill_history.php", {stafflist:stafflist,set:'sendotp'},
			function(data)
			{
			data=$.trim(data);
			//alert(data);
			});*/
	 
	 
	 });
	 /***************************************  ok click ends ******************************************************************  */

/***************************************  ok click starts ******************************************************************  */
   $('.closeok2').click(function () {
	   
	   $('.closeoneclass').css('display','none');
		$('.index_popup_otp').css('display','none');
		$('.confrmation_overlay').css('display','none');
		var hiddayend_closeok=$('#hiddayend_closeok').val();
		var hiddayend_error=$('#hiddayend_error').val();
		
		var dataString;
		dataString = 'value=timeclose_first';
         $.ajax({
			  type: "POST",
			  url: "load_index.php",
			  data: dataString,
			  success: function(data) {
				  data=data.trim();
				  if(data=="Day close successfull!")
				  {
					  $('.index_popup_2').css('display','block');
					  $('.confrmation_overlay').css('display','block');
					  $('.index_popup_contant span').html(hiddayend_closeok);
				  }else if(data=="Please close pending orders for proceeding.")
				  {
					  $('.index_popup_2').css('display','block');
					  $('.confrmation_overlay').css('display','block');
					  $('.index_popup_contant span').html(hiddayend_error);
				  }
					  
				  }
			  });
		
	   });
	 /***************************************  ok click ends ******************************************************************  */
	 
	 /***************************************  ok click starts ******************************************************************  */
   $('.closecancel2').click(function () {
	   
	   $('.closeoneclass').css('display','none');
		$('.index_popup_otp').css('display','none');
		$('.confrmation_overlay').css('display','none');
	   });
	 /***************************************  ok click ends ******************************************************************  */

}); 