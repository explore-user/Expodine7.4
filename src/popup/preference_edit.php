<?php
include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
$_SESSION['prefid']=$_REQUEST['menu'];
$sql_login  =  $database->mysqlQuery("select * from tbl_preferencemaster  where pmr_id='".$_SESSION['prefid']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			  $searchname=$result_cat_s['pmr_name'];
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
	$sql_login  =  $database->mysqlQuery("select * from tbl_preferencemaster  where pmr_id='".$_SESSION['prefid']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
                           <form role="form" action="preference_master.php"  method="post"  name="preference_masteredit">
                            <input type="hidden" name="prefrncid" id="prefrncid" class="menuname" style="color:black" value="<?=$result_login['pmr_id']?>">       
                        	 <div class="first_form_contain">
                              <span id="prefrncstatus1234" class="load_error alertsmaster" style="color:#F00" ></span> 
                             	<div class="form_name_cc">Preference<span style="color:#F00">*</span></div>
                                
                               	 <div class="form_textbox_cc" id="pref_div1">
                                <input type="text" class="form-control preferencenames" id="preference12" name="preference12"  placeholder="Preference" tabindex="0"  data-toggle="tooltip" title="Preference" value="<?=$result_login['pmr_name']?>" onchange="valiprefrnc('<?=$result_login['pmr_id']?>')"></div>
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


     		$(document).on('keydown',function(e)
	{
		if(e.keyCode == 27)
			//alert("hiiiii");
		$('.md-close_pop').click();
	});
    
    
function valiprefrnc(id)
{
	 $('#prefrncstatus1234').text('');
			var id1=id;
	 var a=$("#preference12").val().trim();
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
						  document.preference_masteredit.preference12.focus();
                                                  alert("Enter Preference");
						  return false;
				}
                                
                           var alphanumers = /^[a-zA-Z0-9 ]+$/;
                              if(!alphanumers.test($("#preference12").val())){
                              $("#pref_div1").addClass("has-error");
                                document.preference_masteredit.preference12.focus();
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
	        var ab=$("#preference12").val().trim();
	        $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=checkprefrncedit&mid="+ab+"&prefidchk="+id1,
			success: function(data)
			{
			data=$.trim(data);
			//alert(data);
			var catchk1=$('#prefrncstatus1234');
			if(data =="sorry")
			{
		 catchk1.text('Already exists');
		   $("#pref_div1").addClass("has-error");
	  $("#preference12").focus();

	return false;
			}
			else
			{
			
		catchk1.text('');
		 $("#pref_div1").removeClass("has-error");
	   $("#pref_div1").addClass("has-success");
	
	  //	alert('aa');
	  document.preference_masteredit.submit();
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