<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['dptid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_departmentmaster where der_departmentid='".$_SESSION['dptid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['der_departmentname'];
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
	$sql_login  =  $database->mysqlQuery("select * from tbl_departmentmaster where der_departmentid='".$_SESSION['dptid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="department_master.php"  method="post"  name="department_masteredit">
                        	 <div class="first_form_contain">
                             <span id="depteditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="form_name_cc">Department<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="menumaincategory_divs">
                                <input type="text" class="form-control departmentnames" id="department1" name="department1"  placeholder="Department" tabindex="0"  data-toggle="tooltip" title="Department" value="<?=$result_login['der_departmentname']?>"></div>
                                   <input type="hidden" name="departmentid" id="departmentid" class="menuname" style="color:black" value="<?=$result_login['der_departmentid']?>">       
                               </div>
                                
                               <a  href="#" class="entersubmit" onClick="update_deptval()"><span class="md-save newbut">Update</span></a>
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
function validate_deptall()
{
	var deptid=$("#departmentid").val();
	var deptname=$("#department1").val().trim();
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkdeptedit&deptid="+deptid+"&deptname="+deptname,
			success: function(data)
			{
			data=$.trim(data);
	
			var namechk=$('#depteditchk');
			if(data =="sorry")
			{
		 namechk.text('Already exists');
		   $("#menumaincategory_divs").addClass("has-error");
	  $("#department1").focus();

	return false;
			}
			else
			{
			
		namechk.text('');
		 $("#menumaincategory_divs").removeClass("has-error");
	   $("#menumaincategory_divs").addClass("has-success");
	  // return true;
document.department_masteredit.submit();
			}
			}
		});
}
function update_deptval()
			{
			 if(validate_department1())
				{
					if(validate_deptall())
					{
					}
					//document.department_masteredit.submit();
				}
			}
			
			function validate_department1()   
			{
				if($(".departmentnames").val()=="")
				{
					$("#menumaincategory_divs").addClass("has-error");
						  document.department_masteredit.department1.focus();
                                                  alert("Enter Department");
						  return false;
				}
                                var alphanumers = /^[a-zA-Z0-9 ]+$/;
                                if(!alphanumers.test($("#department1").val())){
                                $("#menumaincategory_divs").addClass("has-error");
                                document.department_masteredit.department1.focus();
                            alert("Special charecter Not Allowed.");
                             }   
                                  else
					 {
						 var a=document.getElementById("department").value;
						$("#menumaincategory_divs").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;
					 }
			}
            
            </script>