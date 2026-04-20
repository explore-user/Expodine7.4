<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['corpid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_corporatemaster WHERE ct_corporatecode='".$_SESSION['corpid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['ct_corporatename'];
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
	$sql_login  =  $database->mysqlQuery("select * from tbl_corporatemaster WHERE ct_corporatecode='".$_SESSION['corpid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="corporate_discount.php"  method="post"  name="corporate_discountedit">
                        	 <div class="first_form_contain">
                              <span id="corpeditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Corporate Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                <input type="text" class="form-control corporatenames" id="corporatename1" name="corporatename1"  placeholder="Corporate Name" tabindex="0"  data-toggle="tooltip" title="Corporate Name" value="<?=$result_login['ct_corporatename']?>"></div>
                               </div>
                             
                               <input type="hidden" name="corporatecode" id="corporatecode" class="menuname" style="color:black" value="<?=$result_login['ct_corporatecode']?>">               
                                  	<a  href="#"  onClick="update_corpval()"><span class="md-save newbut">Update</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script type="text/javascript">
function validate_corpall()
{
	var corpid=$("#corporatecode").val();
	var corpname=$("#corporatename1").val().trim();
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkcorpedit&corpid="+corpid+"&corpname="+corpname,
			success: function(data)
			{
			data=$.trim(data);
	
			var namechk=$('#corpeditchk');
			if(data =="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#corporatename1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	  // return true;
document.corporate_discountedit.submit();
			}
			}
		});
}
function update_corpval()
			{
			 if(validate_corporatename1())
				{
					
						if(validate_corpall())
					{
					}
					//document..submit();
					
				}
			}
			
			function validate_corporatename1()   
			{
				if($(".corporatenames").val()=="")
				{
					$("#menumaincategory_divs").addClass("has-error");
						  document.corporate_discountedit.corporatename1.focus();
                                                  alert("Enter Corporate Name");
						  return false;
				}
                                   var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                   if(!alphanumers.test($("#corporatename1").val())){
                                   $("#menumaincategory_divs").addClass("has-error");
                                   document.corporate_discountedit.corporatename1.focus();
                            alert("Special charecter Not Allowed.");
              }
                                else
					 {
						 var a=document.getElementById("corporatename1").value;
						 
					
						$("#menumaincategory_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
						
					 }
			}
			
            
            </script>