<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['userid']=$_REQUEST['menu'];
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
<div  class="dfineheading"><strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$_SESSION['userid'] ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	$sql_login  =  $database->mysqlQuery("select * from tbl_logindetails where ls_username='".$_SESSION['userid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="chng_password.php"  method="post"  name="chng_passwordedit">
                        	 <!--<div class="first_form_contain">
                             	<div class="form_name_cc">Old Password<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="old_password_div">
                                <input type="password" class="form-control oldpassword" id="oldpassword" name="oldpassword"  placeholder="Old Password" tabindex="0"  data-toggle="tooltip" title="Old Password" onchange="check_change('old_password_div','oldpassword')" ></div>
                               </div>-->
                                <div class="first_form_contain">
                             	<div class="form_name_cc">New Password<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="new_password_div">
                                <input type="password" class="form-control newpassword" id="newpassword" name="newpassword"  placeholder="New password" tabindex="0"  data-toggle="tooltip" title="New password" onChange="checkn_change('new_password_div','newpassword')">  
<!--                                <span class="glyphicon glyphicon-ok form-control-feedback"  style="display:none;top:1px !important" id="sp_pas"></span>   <span  style="display:none;top:1px !important" id="sp_pas"></span>-->
                                
                                </div>
                               </div>
                                                      <div class="first_form_contain">
                             	<div class="form_name_cc">Confirm Password<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="confpassword_div">
                                <input type="password" class="form-control confirmpassword" id="confirmpassword" name="confirmpassword"  placeholder="Confirm password" tabindex="0"  data-toggle="tooltip" title="Confirm password" onChange="checkn_change('confpassword_div','confirmpassword')" > 
<!--                                <span class="glyphicon glyphicon-ok form-control-feedback"  style="display:none;top:1px !important" id="sp_pas"></span>   <span  style="display:none;top:1px !important" id="sp_confp"></span>  -->
                         <input type="hidden" name="oldpass" id="oldpass" class="menuname" style="color:black" value="<?=$result_login['ls_password']?>">
                         
                             <input type="hidden" name="userid" id="userid" class="menuname" style="color:black" value="<?=$result_login['ls_username']?>">        
                        
                                </div>
                               </div>
                                  	<a  href="#"  onClick="update_registration()"><span class="md-save newbut">Save</span></a>
                                  </form>  
 <?php }} ?>
                                            </div>
<script type="text/javascript">
	function update_registration()
			{
			/*	if(validate_oldpassword())
				{*/
				if(validate_password())
	             {
			    if(validate_confpassword())
			        {
						
					document.chng_passwordedit.submit();
				     }
				 }
			    <!--  }-->
			}
			
/*function validate_oldpassword()   
{
	if(document.getElementById("oldpassword").value=="")
	{
		$("#old_password_div").addClass("has-error");
			  document.chng_passwordedit.oldpassword.focus();
			  return false;
	}else
		 {
			$("#old_password_div").removeClass("has-error");
				$(this).addClass("has-success");
				 return true;
		 }
}*/		
	function validate_password()   
{
	
	if(document.getElementById("newpassword").value=="")
	{
		$("#new_password_div").addClass("has-error");
			  document.chng_passwordedit.newpassword.focus();
			  return false;
	}else
		 {
			$("#new_password_div").removeClass("has-error");
				$(this).addClass("has-success");
				 return true;
		 }
}
function validate_confpassword()   
{
	if(document.getElementById("confirmpassword").value=="")
	{
		$("#confpassword_div").removeClass("has-success");
		$("#confpassword_div").addClass("has-error");
			  document.chng_passwordedit.confirmpassword.focus();
			  return false;
	}else
		 {
				 if(document.getElementById("newpassword").value!=document.getElementById("confirmpassword").value)
			  {
				   $("#confpassword_div").addClass("has-error");
				  $("#confpassword_div").addClass("has-feedback");
			
			  		document.chng_passwordedit.confirmpassword.focus();
			  		return false;
			  }else
			  {
				  $("#confpassword_div").removeClass("has-error");
				  $("#confpassword_div").addClass("has-success");
				  $("#confpassword_div").addClass("has-feedback");
				  $("#new_password_div").addClass("has-success");
				  $("#new_password_div").addClass("has-feedback");
			  		return true;
			  }
			
		 }
}
/*function check_change(divid,controlid)
{
var b=document.getElementById("oldpass").value;
var ab=CryptoJS.MD5($("#oldpassword").val());
	if(ab != b)
            {
				   $("#old_password_div").addClass("has-error");
				  $("#old_password_div").addClass("has-feedback");
				  $("#sp_confp").css("display", "block");
				  $("#sp_confp").removeClass("glyphicon-ok");
				  $("#sp_confp").addClass("glyphicon-remove");
				     document.chng_passwordedit.oldpassword.focus();
			  		return false;
			  }
			  else
			{
				 $("#old_password_div").removeClass("has-error");
				  $("#old_password_div").addClass("has-success");
				  $("#old_password_div").addClass("has-feedback");
				  $("#sp_confp").css("display", "block");
				  $("#sp_confp").removeClass("glyphicon-remove");
				  $("#sp_confp").addClass("glyphicon-ok");
			  		return true;
			  }
}*/
function checkn_change(divid,controlid)
{
	
	if(document.getElementById(controlid).value=="")
	{
		
		//alert('Pls fill the details');
		$("#"+divid).addClass("has-error");
		$("#"+divid).removeClass("has-success");
	}else
	{
		
	$("#"+divid).removeClass("has-error");
	$("#"+divid).addClass("has-success");
	}
	if(divid=='confpassword_div')
	{
		
		
	
		if(document.getElementById("newpassword").value!="")
		  {
			  if(document.getElementById("newpassword").value!=document.getElementById("confirmpassword").value)
			  {
				   $("#confpassword_div").addClass("has-error");
				
				
			  		document.chng_passwordedit.confirmpassword.focus();
			  		return false;
			  }else
			  {
				  $("#confpassword_div").removeClass("has-error");
				  $("#confpassword_div").addClass("has-success");
			  		return true;
			  }
			  
		  }else
		  {
			  $("#new_password_div").addClass("has-error");
			  document.chng_passwordedit.newpassword.focus();
			  return false;
		  }
	}
	
	else
	
	{
		
		

		if(document.getElementById("newpassword").value!="")
		  {
			  
			  if(document.getElementById("confirmpassword").value!="")
		  {
			  
			  if(document.getElementById("newpassword").value!=document.getElementById("confirmpassword").value)
			  {
				   $("#new_password_div").addClass("has-error");
			  		document.chng_passwordedit.newpassword.focus();
			  	    return false;
			  }else
			  {
				  $("#confpassword_div").removeClass("has-error");
				  $("#confpassword_div").addClass("has-success");
				  if(("#new_password_div").hasClass("has-error"))
			       {
			      $("#new_password_div").removeClass("has-error");
			       }
				  $("#new_password_div").addClass("has-success");
			
			  		return true;
			  }
			  
		  }
		  else
		  {
			   $("#confpassword_div").addClass("has-error");
			  		document.chng_passwordedit.confirmpassword.focus();
		  }
			  
			  
			  
		  }else
		  {
			  $("#new_password_div").addClass("has-error");
			  document.chng_passwordedit.newpassword.focus();
			
		  }
		
		
		
		
		
	
		
	}
}
	</script>