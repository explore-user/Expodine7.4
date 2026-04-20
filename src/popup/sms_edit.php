<?php
session_start();
//include('../includes/session.php');		// Check session

include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['headid']=$_REQUEST['menu'];
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
 <link href="tooltip/tooltipcss.css" rel="stylesheet" type="text/css" /> 
       <!-- MULTIPLE UPLOADING SCRIPT STARTS HERE -->
     <link rel="stylesheet" type="text/css" href="css/Ajaxfile-upload.css" />
      <script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
     <script src="tooltip/main.js" type="text/javascript"></script>
     

<div class="content md-content" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;">
	<div  class="dfineheading" style="color:#fff;">  <strong>Edit</strong><span style="font-size: 14px;padding-left:1%;"></span>
	<a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
	</div>
	
	 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_sms_report_slab where sr_id='".$_SESSION['headid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
	 <form role="form" action="sms_report.php"  method="post" name="sms_edit">
	  <input type="hidden" name="headid" id="headid" class="head" style="color:black" value="<?=$result_login['sr_id']?>"> 
    <div class="sms_pop_contant_cc">
		
    	<div class="sms_pop_textbox_lable" style="color:#000;">Head</div>
    	<div class="sms_pop_textbox_cc" id="menumaincategory_divss">
		<span id="countrystatus12345" class="load_error alertsmaster" style="color:#F00;" ></span>
		
        	<input name="head11" style="color:#000;" class="sms_pop_textbox" type="text" id="head_sms" value="<?=$result_login['sr_salevalue']?>">
        </div>
		 <div class="sms_pop_textbox_lable" style="color:#000;">Message</div>
    	<div class="sms_pop_textbox_cc" id="menumaincategory_divs">
		<span id="message_status" class="load_error alertsmaster" style="color:#F00" ></span>
		
        	<textarea style="height:auto;color:#000;" type="text" name="sms_text" id="sms_text" class="sms_pop_textbox smsess21" ><?=$result_login['sms_text']?></textarea>
        </div>
    </div>
		
	<a href= "#" onclick="update_edit();"><div class="md-save newbut" style="float:right;margin-top: 10px;">Update</div></a>
    </form>
   
  <?php }} ?>
 </div>
  
<script type="text/javascript">
function validate_sms()
{
	
	 var a=document.getElementById("head_sms").value;
			$.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkvalue1&mid="+a,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var namechk=$('#countrystatus12345');
			if(data =="sorry")
			{
			
		 namechk.text('Value Less Than Maximum Entered Value');
		   $("#menumaincategory_div").addClass("has-error");
			$("#head_sms").focus();
			return false;
		
	
			}
			else
			{
		
		namechk.text('');
		 $("#menumaincategory_div").removeClass("has-error");
	   $("#menumaincategory_div").addClass("has-success");
	
	 
	 document.sms_edit.submit();
	  return true;
			}					 
			}
			});				
}
	

				

function update_edit()
			{
				
			 if(validate_value())
				{
					
				}
			}
		function validate_value()   
			{	
				
					//alert($("#head11").val());
					if($("#head_sms").val()=="" )
				{
					
					$("#menumaincategory_divss").addClass("has-error");
						  document.sms_edit.focus();
						//return false;
				}else
					 {
						
						 var a=document.getElementById("head_sms").value;
						 
						/*$("#menumaincategory_div").removeClass("has-error");
							$(this).addClass("has-success");
							 return true;*/
						 
							$.ajax({
							type: "POST",
							url: "load_divcheckmenu.php",
							data: "value=checkvalue&mid="+a,
							success: function(data)
							{
							data=$.trim(data);
							
							var namechk=$('#countrystatus12345');
							if(data =="sorry")
							{
							//alert("data-sorry");	
						 namechk.text('Already exists');
						   $("#menumaincategory_divss").addClass("has-error");
					  $("#head_sms").focus();

					//return false;
							}
							else
							{
							
						namechk.text('');
						 $("#menumaincategory_divss").removeClass("has-error");
					   $("#menumaincategory_divss").addClass("has-success");
					//document.sms_edit.submit();
					  validate_sms();
					
							}
							}
						});  
									 }
			}
			$(function(){

  $('.head_sms').keypress(function(e) {
	if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
  })
  .on("cut copy paste",function(e){
	e.preventDefault();
  });

});
	</script>