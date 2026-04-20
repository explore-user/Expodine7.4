// JavaScript Document

$(document).ready(function(){
	/***************************************  delete image  starts ***********************************************  */
 $(".tab_edt_btn11").click(function(e){
	 $(".index_popup_del").show();
	$(".confrmation_overlay").show();
	
	
	var id_str   =  $(this).attr("imgid");
	var id_arr	  =	 id_str.split("_");
	var idval       =  id_arr[1];
				  
	 $('#hidimagedel').val(idval);
	 
	});

/***************************************  delete image  ends ***********************************************  */


	/***************************************  delete cancel  starts ***********************************************  */
 	$(".closecancel_del").click(function(e){
 		 $(".index_popup_del").hide();
	     $(".confrmation_overlay").hide();
		  $('#hidimagedel').val('');

	});
    /***************************************  delete cancel  ends ***********************************************  */

	/***************************************  delete cancel  starts ***********************************************  */
 	$(".closeok_del").click(function(e){
 		 $(".index_popup_del").hide();
	     $(".confrmation_overlay").hide();
		 var idval       =  $('#hidimagedel').val();
		 var mdval		 =$('#menuidselected').val();
		 
		 $.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=delimage&mid="+idval+"&mimg="+mdval,
			success: function(msg)
			{
			$.ajax({
			type: "POST",
			url: "load_divimage.php",
			data: "value=loadbranch&mid="+mdval,
			success: function(msg)
			{
				$("#errortotally").css("display","block");
			   $("#errortotally").text("Image deleted Successfully");
			   $("#errortotally").delay(2000).fadeOut('slow');
				$('#loadfullimages').load('load_foodcosting.php?value=loadimagestotal&menuid='+mdval);
			}
		});
			}
		});
		 
		 

	});
    /***************************************  delete cancel  ends ***********************************************  */
	
	   }); 
		