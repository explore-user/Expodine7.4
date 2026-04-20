<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['ingrid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_ingredientmaster  where ir_ingredientid='".$_SESSION['ingrid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['ir_ingredientname'];
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
	$sql_login  =  $database->mysqlQuery("select * from tbl_ingredientmaster  where ir_ingredientid='".$_SESSION['ingrid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="ingredient_master.php"  method="post"  name="ingredient_masteredit">
                            <input type="hidden" name="ingredientid" id="ingredientid" class="menuname" style="color:black" value="<?=$result_login['ir_ingredientid']?>">       
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Ingredient<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="ingredient_div1">
                                <input type="text" class="form-control ingredientnames" id="ingredient1" name="ingredient1"  placeholder="Ingredient" tabindex="0"  data-toggle="tooltip" title="Ingredient" value="<?=$result_login['ir_ingredientname']?>"></div>
                               </div>
                              
                                
                                  	<a  href="#"  onClick="update_ingredient()"><span class="md-save newbut">Update</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script type="text/javascript">
	function update_ingredient()
			{
			 if(validate_ingredient1())
				{
			
					document.ingredient_masteredit.submit();
			
				}
			}
			
			function validate_ingredient1()   
			{
				if($(".ingredientnames").val()=="")
				{
					$("#ingredient_div1").addClass("has-error");
						  document.ingredient_masteredit.ingredient1.focus();
						  return false;
				}else
					 {
						 var a=document.getElementById("ingredient1").value;
						
						$("#ingredient_div1").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
					 }
			}
	</script>