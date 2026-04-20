<?php
//include('../includes/session.php');		// Check session
session_start();
include("../database.class.php"); // DB Connection class
$database	= new Database();

	  ?>
<script type="text/javascript">
     /*************************************** Popup function starts *************************************************  */           
		function test()
		{
			  $(".olddiv").removeClass("new_overlay"); 
			  $('.mynewpopupload').css("display","none");
		}
	/***************************************  Popup function starts *************************************************  */
	
	
		
	
	function validate_modules()
{
	var mainmodname='';
	var mainlinkname='';
	var submainnid='';
	var submodname='';
	var submodlink='';
	var type1="";
	if($('#modtype').val()=="")
	{
		$("#errorlist").css("display","block");
		$("#errorlist").text("Select Type");
		$("#errorlist").delay(2000).fadeOut('slow');
		$("#modtype").focus();
		return false;
	}else 
	{
		 type1=($('#modtype').val());
		if(type1=="main1")
		{
			if($('#mainmoduletext').val()=="")
			{
				$("#errorlist").css("display","block");
				$("#errorlist").text("Add Module name");
				$("#mainmoduletext").focus();
				$("#errorlist").delay(2000).fadeOut('slow');
				
				return false;
			}else  if($('#linkname').val()=="")
			{
				$("#errorlist").css("display","block");
				$("#errorlist").text("Add Link name");
				$("#linkname").focus();
				$("#errorlist").delay(2000).fadeOut('slow');
				
				return false;
			}
			 mainmodname=$('#mainmoduletext').val();
			 mainlinkname=$('#linkname').val();
			
			var modtype=($('#modtype').val());
			 $.ajax({
				type: "POST",
				url: "load_divcheckmenu.php",
				data: "value=chkpermissionvlaue&modtype="+modtype+"&mainmodname="+mainmodname+"&mainlinkname="+mainlinkname,
				success: function(msg)
				{
					msg=msg.trim();
					if(msg!="ok")
					{
						//alert(msg);
						$("#errorlist").css("display","block");
						$("#errorlist").text(msg);
						$("#errorlist").delay(2000).fadeOut('slow');
						
					}else
					{
						//alert("ok");
						document.userpermission.submit();
					}
					
			   }
			}); 
			
			
		}else if(type1=="sub1")
		{
			if($('#mainmodule').val()=="")
			{
				$("#errorlist").css("display","block");
				$("#errorlist").text("Select Module name");
				$("#mainmodule").focus();
				$("#errorlist").delay(2000).fadeOut('slow');
				
				return false;
			}else  if($('#submodule').val()=="")
			{
				$("#errorlist").css("display","block");
				$("#errorlist").text("Add SubModule name");
				$("#submodule").focus();
				$("#errorlist").delay(2000).fadeOut('slow');
				
				return false;
			}else  if($('#sublinkname').val()=="")
			{
				$("#errorlist").css("display","block");
				$("#errorlist").text("Add SubLink name");
				$("#sublinkname").focus();
				$("#errorlist").delay(2000).fadeOut('slow');
				
				return false;
			}
			 submainnid=$('#mainmodule').val();
			 submodname=$('#submodule').val();
			 submodlink=$('#sublinkname').val();
			var modtype=($('#modtype').val());
			 $.ajax({
				type: "POST",
				url: "load_divcheckmenu.php",
				data: "value=chkpermissionvlaue&modtype="+modtype+"&submainnid="+submainnid+"&submodname="+submodname+"&submodlink="+submodlink,
				success: function(msg)
				{
					msg=msg.trim();
					if(msg!="ok")
					{
						$("#errorlist").css("display","block");
						$("#errorlist").text(msg);
						$("#errorlist").delay(2000).fadeOut('slow');
						
					}else
					{
						//alert("ok");
						document.userpermission.submit();
					}
			   }
			}); 
		}
		
		
	
		
	}
	
		
	
	
	
	/*$('.updatestock').click( function() {  	
			  $.ajax({
			type: "POST",
			url: "load_divstock.php",
			data: "value=updatestock",
			success: function(msg)
			{
				$('#stock').html(msg);
				$(".updatestock").css("display","none")
		   }
		}); 
			 
	});
	document.userpermission.submit();*/
}


</script>
<div class="md-content" style="position:fixed;width:40%;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"><strong>Add-permission</strong><span style="font-size: 14px;padding-left:1%;color:#F00; float:right;display:none" id="errorlist"> </span>
<!--<a style="position:absolute;right:0;top:1px;" href="#" onclick="test()"><button class="md-close ">x</button></a>--><!--action="<?$_SERVER['PHP_SELF']?>"-->
</div> 
 
   <form role="form"   name="userpermission" method="post"  action="user_permission.php"  >
				
                    <div class="col-lg-12 col-md-12 no-padding">
                    	<table class="popup_add_table" width="100%" border="0" cellspacing="5">
                       		 <tr>
                                <td>Module Type</td>
                                <td><Select name="modtype" id="modtype" class="add_text_box" onchange="chagedrop(this.value)">
                                		<option value="">Select Module Type</option>
                                        <option value="main1">Main Module</option>
                                        <option value="sub1">Sub Module</option>
                                	</Select></td>
                                </tr>
                                </table>
                                <span id="maintable1s" >
                           <table  class="popup_add_table" width="100%" border="0" cellspacing="5">
                              <tr>
                                <td>Main Module</td>
                                <!--`tbl_modulemaster`(`mer_moduleid`, `mer_modulename`, `mer_modulelink`)-->
                                <td><input type="text" class="add_text_box" id="mainmoduletext" name="mainmoduletext"  placeholder="Main Module" tabindex="0"  data-toggle="tooltip" title="Main Module" ></td>
                               
                              </tr>
                              <tr>
                                <td>MainLink Name</td>
                                <td> <input type="text" class="add_text_box" id="linkname" name="linkname"  placeholder="Link Name" tabindex="0"  data-toggle="tooltip" title="Link Name" ></td>
                                
                              </tr>
                               
                              </table>
                              </span>
                              <div id="subtable1s" >
                              <table  class="popup_add_table" width="100%" border="0" cellspacing="5">
                               <tr>
                                <td>Main Module</td>
                                <td>
                                <Select name="mainmodule" class="add_text_box" id="mainmodule">
                                		<option value="">Main Module</option>
										<?php
                                         $sql_mainmod  =  $database->mysqlQuery("select * from tbl_modulemaster"); 
                                          $num_mainmod   = $database->mysqlNumRows($sql_mainmod);
                                          if($num_mainmod){
											  while($result_mainmod  = $database->mysqlFetchArray($sql_mainmod)) 
												{
                                         ?>
                                        <option value="<?=$result_mainmod['mer_moduleid']?>"><?=$result_mainmod['mer_modulename']?></option>
                                        <?php } } ?>
                                	</Select>
                                </td>
                               
                              </tr>
                              <tr>
                                <td>Sub Module</td>
                                 <!--`tbl_modulesubmaster`(`mser_submoduleid`, `mser_moduleid`, `mser_subname`, `mser_submodulelink`)-->
                                <td>
                                <input type="text" class="add_text_box" id="submodule" name="submodule"  placeholder="Sub Module" tabindex="0"  data-toggle="tooltip" title="Sub Module" >
                                </td>
                                
                              </tr>
                              <tr>
                                <td>Sub-Link Name</td>
                                <td> <input type="text" class="add_text_box" id="sublinkname" name="sublinkname"  placeholder="Sub Link Name" tabindex="0"  data-toggle="tooltip" title="Sub Link Name" ></td>
                                
                              </tr>
                            </table>
                            </div>

                    </div>
				
					<a href="#" style="margin-right:2%;" onClick="validate_modules()"><span class="md-save newbut">Save</span></a>
                    <a href="#"><button style="top:0;" class="md-close newbut">Close me!</button></a>
                    	<!--<a  href="#"  onClick="update_registration()"><span class="md-save newbut">Update</span></a>-->
                    </form>
                             
                               

                                            </div>
<!--  Module Type starts -->
<script type="text/javascript">
document.getElementById('maintable1s').style.display="none";
document.getElementById('subtable1s').style.display="none";
function chagedrop(type)
	{
	var type1=(type.trim());
	
	  if(type1=="main1")
	  {
		  document.getElementById('maintable1s').style.display="block";
		  document.getElementById('subtable1s').style.display="none";
		
	 }else if(type=="sub1")
	  {
		   document.getElementById('maintable1s').style.display="none";
		  document.getElementById('subtable1s').style.display="block";
		
	 }
	}
</script>

<!--   Module Type ends   -->