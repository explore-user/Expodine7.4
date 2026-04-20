// JavaScript Document
$(document).ready(function(){
	
	/*****************************************  click row starts ******************************************************************  */
	  $('.clicktoselect_ing').click(function () {  
	  		$('.clicktoselect_ing').removeClass('food_table_active_ing');
			$(this).addClass('food_table_active_ing');
	 
	  });
	/***************************************  click row ends ******************************************************************  */ 
	
	/*****************************************  sotrtable starts ******************************************************************  */
	 $(".tablesorter").tablesorter();
	 /***************************************  sotrtable ends ******************************************************************  */
	
	
	
	
	}); 
/* **************************************** Search each starts *********************************************** */	
function validateSearch_ing()
{//ing_name ing_cat ing_sub ing_bd ing_st
//alert("h");
  var ing_name=$("#ing_name").val();
  if(ing_name=="")
  {
	  ing_name="null";
  }
  var ing_cat=$("#ing_cat").val();
  if(ing_cat=="")
  {
	  ing_cat="null";
  }

   var ing_sub=$("#ing_sub").val();
  if(ing_sub=="")
  {
	  ing_sub="null";
  }
   var ing_bd=$("#ing_bd").val();
  if(ing_bd=="")
  {
	  ing_bd="null";
  }
  var ing_st=$("#ing_st").val();
  if(ing_st=="")
  {
	  ing_st="null";
  }

	  $.ajax({
			type: "POST",
			url: "load_foodcosting.php",
			data: "value=searchmenu_ing&ing_name="+ing_name+"&ing_cat="+ing_cat+"&ing_sub="+ing_sub+"&ing_bd="+ing_bd+"&ing_st="+ing_st,
			success: function(msg)
			{
				$('#listingredientss').html(msg);
			}
		});  
}
/* **************************************** Search each ends *********************************************** */
/* **************************************** reload starts *********************************************** */
function reloadall_ing()
{
	//ing_name ing_cat ing_sub ing_bd ing_st
	$("#ing_name").val('');
	$('#ing_cat').find('option:first').attr('selected', 'selected');
	$('#ing_sub').find('option:first').attr('selected', 'selected');
	$('#ing_bd').find('option:first').attr('selected', 'selected');
	$('#ing_st').find('option:first').attr('selected', 'selected');
	$('#listingredientss').load('load_foodcosting.php?value=loadfulllist_ing');
	 /*$.ajax({
			type: "POST",
			url: "load_foodcosting.php",
			data: "value=loadfulllist",
			success: function(msg)
			{
				$('#listmenuitems').html(msg);
			}
		});  */
}
/* ****************************************reload  ends *********************************************** */