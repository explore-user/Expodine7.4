<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['portid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_portionmaster  where pm_id='".$_SESSION['portid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['pm_portionname'];
	  }			
} 
else
{
  $searchname="";
}
	  ?>
<script>
     /*************************************** Popup function starts *************************************************  */           
		function test()
		{
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
		}
	/***************************************  Popup function starts *************************************************  */
</script>
<div class="md-content" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"><strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	$sql_login  =  $database->mysqlQuery("select * from tbl_portionmaster  where pm_id='".$_SESSION['portid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="portion_master.php"  method="post"  name="portion_masteredit">
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc"><?=$_SESSION['s_portionname']?><span style="color:#F00">*</span></div>
                                  <span id="prtnchk" class="load_error alertsmaster" style="color:#F00" ></span>
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                <input type="text" class="form-control portionnames" id="portion1" name="portion1"  placeholder="<?=$_SESSION['s_portionname']?>" tabindex="0"  data-toggle="tooltip" title="<?=$_SESSION['s_portionname']?>" value="<?=$result_login['pm_portionname']?>" onchange="valiportn1('<?=$result_login['pm_id']?>')"></div>
                               </div>
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Short Code<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="menumaincategory_divnew">
                                <input type="text" class="form-control shortcodes" id="shortcode1" name="shortcode1"  placeholder="Short Code" tabindex="0"  data-toggle="tooltip" title="<?=$_SESSION['s_portionname']?>" value="<?=$result_login['pm_portionshortcode']?>"></div>
                                   <input type="hidden" name="portionid" id="portionid" class="menuname" style="color:black" value="<?=$result_login['pm_id']?>">       
                               </div>
                                
                                  	<a  href="#"  onClick="update_portion()"><span class="md-save newbut">Update</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script type="text/javascript">

function valiportn1(id)
           {
			  $('#prtnchk').text('');
			var id1=id;
		
	        var ab=$(".portionnames").val().trim();
			if(ab!="")
			{
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprtnedit&prtnid="+ab+"&prtnidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var prtnchk=$('#prtnchk');
			if(data =="sorry")
			{
		 prtnchk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#portion1").focus();
//return false;
	
			}
			else
			{
				//alert('aa');
		prtnchk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	 // return true;
			}
			}
		});
			}
			/*else
			{
				$("#menumaincategory_divs").addClass("has-error");
	  $("#menumaincategory1").focus();
			}*/
}
	function update_portion()
			{
			 if(validate_portion1())
				{
			//	if(validate_shortcode1())
//				{
//					document.portion_masteredit.submit();
//				}
				}
			}
			
			function validate_portion1()   
			{
				var id=$("#portionid").val();
				if($(".portionnames").val()=="")
				{
					$("#menumaincategory_divs").addClass("has-error");
						  document.portion_masteredit.portion1.focus();
						  return false;
				}else
					 {
						 
						 var ab=$(".portionnames").val().trim();
						
						var id1=id;
					//alert(id1);
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprtnedit&prtnid="+ab+"&prtnidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			var catchk=$('#prtnchk');
			  dcument.portion_masteredit.submit();
			if(data =="sorry")
			{
		 catchk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#portion1").focus();

	return false;
			}
			else
			{
			
		catchk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	  //  dcument.portion_masteredit.submit();
	  if( validate_shortcode1())
	  {
		
 dcument.portion_masteredit.submit();
	  }
	  
	 
			}
			}
		}); 
					 }
			}
			function validate_shortcode1()   
			{
				
				if($("#shortcode1").val()=="")
				{
					$("#menumaincategory_divnew").addClass("has-error");
						  document.portion_masteredit.shortcode1.focus();
						  return false;
				}else
					 {
					
						 var a=document.getElementById("shortcode1").value;
					
						$("#menumaincategory_divnew").removeClass("has-error");
							$(this).addClass("has-success");
								
							 return true;
						//dcument.portion_masteredit.submit();
					 }
			}
	</script>