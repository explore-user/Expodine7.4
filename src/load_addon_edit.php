<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['prefid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_menu_addon_master  where ma_id='".$_SESSION['prefid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['ma_name'];
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
	$sql_login  =  $database->mysqlQuery("select * from tbl_menu_addon_master  where ma_id='".$_SESSION['prefid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                                 if($result_login['ma_active']=="Y"){
        $chk="Checked";
    }
 else {
        $chk="";
    }     
                      
	 ?>
                 <form role="form" action="addons_master.php"  method="post"  name="preference_masteredit">
                            <input type="hidden" name="addonid" id="addonid" class="menuname" style="color:black" value="<?=$result_login['ma_id']?>">       
                        	 <div class="first_form_contain">
                              <span id="prefrncstatus1234" class="load_error alertsmaster" style="color:#F00" ></span> 
                             	<div class="form_name_cc">Addons<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="pref_div1">
                                <input type="text" class="form-control preferencenames" id="addon2" name="addon2"  placeholder="Addon" tabindex="0"  data-toggle="tooltip" title="Preference" value="<?=$result_login['ma_name']?>" onchange="valiprefrnc('<?=$result_login['ma_id']?>')"></div>
                               </div>
                                        <div class="first_form_contain">
                             	<div class="form_name_cc">Active</div>
                               	 <div class="form_textbox_cc" id="active_div">
                                 	<div class="checkbox">
                    <label>
                        
                        <input type="checkbox"    tabindex="2" name="addactive"  id="addactive" data-toggle="tooltip" <?=$chk?>  title="Active" value="<?=$result_login['ma_active']?>">
                       
                    </label>
                </div>              
                       </div>
                                </div>
                                
                            <a  href="#" class="entersubmit"  onClick="update_preference()"><span class="md-save newbut">Update</span></a>
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
    
function valiprefrnc(id)
{
	 $('#prefrncstatus1234').text('');
			var id1=id;
	 var a=$("#addon2").val().trim();
	if(a!="")
			{
	  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprefrncedit&mid="+a+"&prefidchk="+id1,
			success: function(msg)
			{
			msg=$.trim(msg);
			//alert(msg);
			 var namechk1=$('#prefrncstatus1234');
			if(msg =="sorry")
			{
			  namechk1.text('Already exists');
			  $("#pref_div1").addClass("has-error");
	          $("#preference12").focus();
			}
			else
			{
					namechk1.text('');
					 $("#pref_div1").removeClass("has-error");
	                 $("#pref_div1").addClass("has-success");
					}
			}
		});
			}
			
}
//prefrncstatus1234
	function update_preference()
			{
			 if(validate_pref11())
				{
			
				//	document.preference_masteredit.submit();
			
				}
			}
			
			function validate_pref11()   
			{
				var id=$("#prefrncid").val();
				if($(".preferencenames").val()=="")
				{
					$("#pref_div1").addClass("has-error");
						  document.preference_masteredit.addon2.focus();
                                                  alert("Enter Preference");
						  return false;
				}
                                
                           var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#preference12").val())){
                              $("#pref_div1").addClass("has-error");
                                document.preference_masteredit.addon2.focus();
                                alert("Special charecter Not Allowed.");
                   }  
        
        
                                    else
					 {
				
	  document.preference_masteredit.submit();
				 
		


					 }
                                     }
                                 
                                  
	</script>