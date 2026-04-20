<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['dsgid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_designationmaster INNER JOIN tbl_headoffice ON tbl_designationmaster.dr_headofficeid=tbl_headoffice.he_officeid and dr_designationid='".$_SESSION['dsgid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['dr_designationname'];
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
	$sql_login  =  $database->mysqlQuery("select * from tbl_designationmaster INNER JOIN tbl_headoffice ON tbl_designationmaster.dr_headofficeid=tbl_headoffice.he_officeid and dr_designationid='".$_SESSION['dsgid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="designation_master.php"  method="post"  name="designation_masteredit">
                        	 <div class="first_form_contain">
                              <span id="desigeditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Designation<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                <input type="text" class="form-control designationnames" id="designation1" name="designation1"  placeholder="Designation" tabindex="0"  data-toggle="tooltip" title="Designation" value="<?=$result_login['dr_designationname']?>"></div>
                                   <input type="hidden" name="designationid" id="designationid" class="menuname" style="color:black" value="<?=$result_login['dr_designationid']?>">       
                               </div>
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Login</div>
                               	 <div class="form_textbox_cc" id="login_divs">
                                <input type="checkbox" value="<?=$result_login['dr_login']?>" tabindex="5" name="active1"  id="active1" data-toggle="tooltip" title="Status" <?php if($result_login['dr_login']=="Yes") { ?> checked <?php } ?> ></div>
                               </div>
                                 
                               <a  href="#" class="entersubmit"  onClick="update_desgval()"><span class="md-save newbut">Update</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script type="text/javascript">
    $('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });

function validate_desigall()
{
	var desigid=$("#designationid").val();
	var designame=$("#designation1").val().trim();
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkdesigedit&desigid="+desigid+"&designame="+designame,
			success: function(data)
			{
			data=$.trim(data);
	
			var namechk=$('#desigeditchk');
			if(data =="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#designation1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	  // return true;
document.designation_masteredit.submit();
			}
			}
		});
}

function update_desgval()
			{
			 if(validate_designation1())
				{
					if(validate_desigall())
					{
					}
				//	document.designation_masteredit.submit();
				}
			}
			function validate_designation1()   
			{
				if($(".designationnames").val()=="")
				{
					$("#menumaincategory_divs").addClass("has-error");
						  document.designation_masteredit.designation1.focus();
                                                  alert("Enter designation");
						  return false;
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                if(!alphanumers.test($("#designation1").val())){
                                $("#menumaincategory_divs").addClass("has-error");
                                document.designation_masteredit.designation1.focus();
                            alert("Special charecter Not Allowed.");
                              }
                             else
					 {
						 var a=document.getElementById("designation1").value;
						$("#menumaincategory_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
					 }
			}            
            </script>