<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['printertypeid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_printertype where pt_id='".$_SESSION['printertypeid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['pt_typename'];
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
	$sql_login  =  $database->mysqlQuery("select * from tbl_printertype  where pt_id='".$_SESSION['printertypeid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="printer_type_master.php"  method="post"  name="printer_type_masteredit">
                            <input type="hidden" name="printertypeid" id="printertypeid" class="menuname" style="color:black" value="<?=$result_login['pt_id']?>">       
                        	 <div class="first_form_contain">
                              <span id="printtypestatus" class="load_error alertsmaster" style="color:#F00" ></span> 
                             	<div class="form_name_cc">Printer Type<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="prnt_div1">
                                <input type="text" class="form-control printertypes" id="printertype1" name="printertype1"  placeholder="Printer Type" tabindex="0"  data-toggle="tooltip" title="printer Type" value="<?=$result_login['pt_typename']?>" onchange="valiprintertype('<?=$result_login['pt_id']?>')"></div>
                               </div>
                              
                                
                            <a  href="#" class="entersubmit" onClick="update_printer_type()"><span class="md-save newbut">Update</span></a>
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
function valiprintertype(id)
{
	 $('#printtypestatus').text('');
			var id1=id;
	 var a=$("#printertype1").val().trim();
	if(a!="")
			{
	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprinttypeedit&mid="+a+"&printtypeid="+id1,
			success: function(msg)
			{
			msg=$.trim(msg);
			//alert(msg);
			 var namechk1=$('#printtypestatus');
			if(msg =="sorry")
			{
			  namechk1.text('Already exists');
			  $("#prnt_div1").addClass("has-error");
	          $("#printertype1").focus();
			}
			else
			{
					namechk1.text('');
					 $("#prnt_div1").removeClass("has-error");
	                 $("#prnt_div1").addClass("has-success");
					}
			}
		});
			}
			
}
//prefrncstatus1234
	function update_printer_type()
			{
			 if(validate_printtypez())
				{
			
				//	document.preference_masteredit.submit();
			
				}
			}
			
			function validate_printtypez()   
			{
				var id=$("#printertypeid").val();
				if($(".printertypes").val()=="")
				{
					$("#prnt_div1").addClass("has-error");
						  document.printer_type_masteredit.printertype1.focus();
                                                  alert("Enter Printer Type");
						  return false;
				}
                                 var alphanumers = /^[a-zA-Z0-9- ]+$/;
                                 if(!alphanumers.test($("#printertype1").val())){
                                 $("#prnt_div1").addClass("has-error");
                                  document.printer_type_masteredit.printertype1.focus();
                                           alert("Special charecter Not Allowed.");
                              }
                                   else
					 {
						// var a=document.getElementById("preference12").value;
						//$("#pref_div1").removeClass("has-error");
//							$(this).addClass("has-success");
//							 return true;


					var id1=id;
					//alert(id1);
	        var ab=$("#printertype1").val().trim();
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprinttypeedit&mid="+ab+"&printtypeid="+id1,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var catchk1=$('#printtypestatus');
			if(data =="sorry")
			{
		 catchk1.text('Already exists');
		   $("#prnt_div1").addClass("has-error");
	  $("#printertype1").focus();

	return false;
			}
			else
			{
			
		catchk1.text('');
		 $("#prnt_div1").removeClass("has-error");
	   $("#prnt_div1").addClass("has-success");
	
	  //	alert('aa');
	  document.printer_type_masteredit.submit();
			}
			}
		}); 
				 
				 
				 
				 
				 
				 
				 
				 
				/* 
				 var a=document.getElementById("menumaincategory1").value;
				 //alert(a);
				$("#menumaincategory_divs").removeClass("has-error");
					$(this).addClass("has-success");
					 return true;*/
			 


                                         }
				
                                   }
			   
	</script>