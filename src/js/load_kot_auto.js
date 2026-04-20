// JavaScript Document

$(document).ready(function() {
	
	/*****************************************  Select all click starts ******************************************************************  */
	$('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"  
				 
            });
			$(".toserve").addClass("tr_color_3");
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1" 
				                  
            }); 
			$(".toserve").removeClass("tr_color_3");            
        }
    });
	/***************************************** Select all click ends ******************************************************************  */
	
	/*****************************************  Serve  each starts ******************************************************************  */
   $('.toserve').click(function () {
			 var kot   =  $(this).attr("kot");
			  var kotval	  =	 kot.split("_");
			  var kotvalue       =  kotval[1];
			  var sl   =  $(this).attr("slno");
			  var slval	  =	 sl.split("_");
			  var slvalue       =  slval[1];
			   if($(this).hasClass("serv"))
				 {
					$(this).addClass("tr_color_4"); 
					$(this).find('.sl'+slvalue).attr('checked',false);
					$(this).removeClass("serv");
				 }
			 if($(this).hasClass("tr_color_3"))
			 {
			 	$(this).removeClass("tr_color_3");
				 $(this).find('.sl'+slvalue).attr('checked',false);
			 }else if($(this).hasClass("tr_color_4"))
			 {
				 $(this).removeClass("tr_color_4");
			 	$(this).addClass("tr_color_3");
				$(this).addClass("serv");
				 $(this).find('.sl'+slvalue).attr('checked',true);
			 }else if($(this).hasClass("tr_color_2"))
			 {
				 $(this).removeClass("tr_color_4");
			 	$(this).removeClass("tr_color_3");
			 }else
				 {
				  $(this).addClass("tr_color_3");
				  $(this).find('.sl'+slvalue).attr('checked',true);
				 }
			 
			 
			 
 			});
	/*****************************************  Serve  each ends ******************************************************************  */

	
	});