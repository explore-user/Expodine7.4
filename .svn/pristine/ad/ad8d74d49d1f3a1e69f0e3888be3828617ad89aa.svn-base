// JavaScript Document
$(document).ready(function(){
	
	/*****************************************  click row starts ******************************************************************  */
	  $('.clicktoselect').click(function () {  
	  		$('.clicktoselect').removeClass('food_table_active');
			$(this).addClass('food_table_active');
	 
	  });
	/***************************************  click row ends ******************************************************************  */ 
	
	/*****************************************  sotrtable starts ******************************************************************  */
	 $(".tablesorter").tablesorter();
	 /***************************************  sotrtable ends ******************************************************************  */
	
	
	
	
	}); 
/* **************************************** Search each starts *********************************************** */	
function validateSearch()
{
  var mname=$("#mname").val();
  if(mname=="")
  {
	  mname="null";
  }
  var mcate=$("#mcate").val();
  if(mcate=="")
  {
	  mcate="null";
  }

   var msubc=$("#msubc").val();
  if(msubc=="")
  {
	  msubc="null";
  }
   var mdiet=$("#mdiet").val();
  if(mdiet=="")
  {
	  mdiet="null";
  }

	  $.ajax({
			type: "POST",
			url: "load_foodcosting.php",
			data: "value=searchmenu&mname="+mname+"&mcate="+mcate+"&msubc="+msubc+"&mdiet="+mdiet,
			success: function(msg)
			{
				$('#listmenuitems').html(msg);
			}
		});  
}
/* **************************************** Search each ends *********************************************** */
/* **************************************** reload starts *********************************************** */
function reloadall()
{
	
	$("#mname").val('');
	$('#mcate').find('option:first').attr('selected', 'selected');
	$('#msubc').find('option:first').attr('selected', 'selected');
	$('#mdiet').find('option:first').attr('selected', 'selected');
	$('#listmenuitems').load('load_foodcosting.php?value=loadfulllist');
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
