// JavaScript Document
$(document).ready(function(){
	
	/*****************************************  click floor starts ******************************************************************  */
	  $('.table_floor_select_btn').click(function () { 
	  var title=$(this).attr('title');//alert(title)
	   var screentyp=$('#screentype').val();
	  
	  if ($(this).hasClass('table_floor_select_btn_act'))
			  {
				  if(title!="ALL")
				  {
					  $('.table_floor_select_btn').filter('[tile="ALL"]').removeClass('table_floor_select_btn_act');
				  }
				  $(this).removeClass('table_floor_select_btn_act');
			  }else
			  {
				  if(title=="ALL")
				  {
					  $('.table_floor_select_btn').removeClass('table_floor_select_btn_act');
				  }else
				  {
					  $('.table_floor_select_btn').filter('[title="ALL"]').removeClass('table_floor_select_btn_act');
				  }
				  $(this).addClass('table_floor_select_btn_act');
			  }
		 var selected_activities =$('.table_floor_select_btn_act');
		  var ids = new Array();
		  selected_activities.each(function(){
			  var id_str       =  $(this).attr("title");
				  if(id_str!='undefined' && id_str!='' && id_str!=null){
					  ids.push(id_str);
				  }
			  
		  });
		  if(screentyp=="screen_multi")
		  {
		   $('.load_colum_dinein').load('load_kod_screen.php?value=loadkodscreen&set=dine&counter='+ids+'&pagename=packing');
		   $('.load_colum_takeaway').load('load_kod_screen.php?value=loadkodscreen&set=ta&counter='+ids+'&pagename=packing');	
		  }else if(screentyp=="screen_single")
		  {
			   var setnm=$('#setname').val();
 				$('#columns').load('load_kod_screen.php?value=loadkodscreen&set='+setnm+'&counter='+ids+'&pagename=packing');
		  }
	   
	 // alert(ids);
			  });
	/***************************************     click floor  ends ********************************************************  */
	
}); 