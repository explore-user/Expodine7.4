<?php
session_start();
//include('../includes/session.php');		// Check session
include("../database.class.php"); // DB Connection class
$database	= new Database();
  $_SESSION['report_master_id']=$_REQUEST['rm_id'];

$sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster where rm_id='".$_SESSION['report_master_id']."'"); 
$num_cat_s  = $database->mysqlNumRows($sql_login);
if($num_cat_s){
  while($result_cat_s  = $database->mysqlFetchArray($sql_login)) 
	  {
			   $searchname=$result_cat_s['rm_reportname'];
	
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
<div class="md-content" style="position:fixed;width: 700px;left:30%;top:5%;z-index:99999;"><!--1sttab-->
<div  class="dfineheading"><strong>Edit</strong>  - <span style="font-size: 14px;padding-left:1%;"> <?=$searchname ?></span></div> 
 <a href="#" onclick="test()"><button class="md-close_pop">x</button></a>
   <?php
	$sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster  where rm_id='".$_SESSION['report_master_id']."'"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
	 ?>
               <form role="form" action="report_master.php"  method="post"  name="report_masteredit">
                <table class="popup_add_table" width="100%" border="0" cellspacing="5">

                    <tbody>
                        <tr>
                            <td>
                               <span id="tableeditchk" class="load_error alertsmaster" style="color:#F00" ></span>
                             	<div class="popup_txt">Report ID<span style="color:#F00">*</span></div>
                               	 <div class="" id="reportid_divs">
                                <input type="text" class="form-control pop_wdth reportids" id="reportid" name="reportid"  placeholder="Report ID" tabindex="0"  data-toggle="tooltip" title="Report ID" value="<?=$result_login['rm_reportid']?>" ></div>
                               </td>
                                <td>
                             	<div class="popup_txt">Report Name<span style="color:#F00">*</span></div>
                               	 <div class="" id="reportname_divs">
                                <input type="text" class="form-control pop_wdth reportnamez" id="reportnamez" name="reportnamez"  placeholder="Report Name" tabindex="0"  data-toggle="tooltip" title="Report Name" value="<?=$result_login['rm_reportname']?>"></div>
                                </td>  
                                <td>
                             	<div class="popup_txt">To Print<span style="color:#F00">*</span></div>
                               	 <div class="" id="toprint_divs">
                                <input type="text" class="form-control pop_wdth toprints" id="toprintreport" name="toprintreport"  placeholder="To Print" tabindex="0"  data-toggle="tooltip" title="To Print" value="<?=$result_login['rm_posprintofanother']?>"></div>
                               </td>
                                  
                                  
                                </tr>
                                <tr>
                                <td colspan="3">
                                  <div class="chk_lable_pop_edit" style="padding-left:0">Active</div>
                               	 <div class="chkbox_cc_edit_report_master" id="active_divs">
 <input type="checkbox" value="<?=$result_login['rm_reportview']?>" tabindex="5" name="active1"  id="active1" data-toggle="tooltip" title="Status" <?php if($result_login['rm_reportview']=="Y") { ?> checked <?php } ?>  class="popup_chk_bx"></div>
   	<div class="chk_lable_pop_edit">Print A4</div>
                               	 <div class="chkbox_cc_edit_report_master" id="print_a4divs">
 <input type="checkbox" value="<?=$result_login['rm_printa4']?>" tabindex="5" name="printa4s"  id="printa4s" data-toggle="tooltip" title="Print A4" <?php if($result_login['rm_printa4']=="Y") { ?> checked <?php } ?>  class="popup_chk_bx"></div>
                               
                                 	<div class="chk_lable_pop_edit">Email</div>
                               	 <div class="chkbox_cc_edit_report_master" id="email_divs">
 <input type="checkbox" value="<?=$result_login['rm_email']?>" tabindex="5" name="emails"  id="emails" data-toggle="tooltip" title="Email" <?php if($result_login['rm_email']=="Y") { ?> checked <?php } ?> class="popup_chk_bx"></div>
                               
                                 	<div class="chk_lable_pop_edit">Dayclose mail</div>
                               	 <div class="chkbox_cc_edit_report_master" id="dayclosemail_divs">
 <input type="checkbox" value="<?=$result_login['rm_dayclosemail']?>" tabindex="5" name="dayclosemail1"  id="dayclosemail1" data-toggle="tooltip" title="Dayclose mail" <?php if($result_login['rm_dayclosemail']=="Y") { ?> checked <?php } ?> class="popup_chk_bx"></div>
                               
                                 	<div class="chk_lable_pop_edit">Dayclose print</div>
                               	 <div class="chkbox_cc_edit_report_master" id="daycloseprint_divs">
 <input type="checkbox" value="<?=$result_login['rm_daycloseprint']?>" tabindex="5" name="daycloseprint1"  id="daycloseprint1" data-toggle="tooltip" title="Dayclose print" <?php if($result_login['rm_daycloseprint']=="Y") { ?> checked <?php } ?> class="popup_chk_bx"></div>
                               
                         </td>      
                         </tr>
                         
                         </tbody>
                         </table>   
                          <input type="hidden" name="reptid" id="reptid" class="menuname" style="color:black" value="<?=$result_login['rm_id']?>"> 
                              
                                  	<div class="full_width_new">
                                   	 <a  href="#"  onClick="update_reportval()"><span class="md-save newbut">Update</span></a>
                                    </div>
                                  </form>  
 <?php }} ?>
                                            </div>
<script type="text/javascript">

function update_reportval()
			{
			 if(validate_reportid1())
				{
					if(validate_reportname1())
					{
						
						if(validate_toprint1())
						{
						document.report_masteredit.submit();
						}
					}
				}
			}
			
			
			function validate_reportid1()
			{
				
				if($("#reportid").val()=="")
				{
					$("#reportid_divs").addClass("has-error");
						  document.report_masteredit.reportid.focus();
						  return false;
				}else
					 {
						
						 $("#reportid_divs").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
				
				
				
			}
			
			function validate_reportname1()
			{
				if($("#reportnamez").val()=="")
				{
					$("#reportname_divs").addClass("has-error");
						  document.report_masteredit.reportname.focus();
						  return false;
				}else
					 {
						
						 $("#reportname_divs").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
				
			}
			
			function validate_toprint1()
			{
				if($("#toprintreport").val()=="")
				{
					$("#toprint_divs").addClass("has-error");
						  document.report_masteredit.toprintreport.focus();
						  return false;
				}else
					 {
						
						 $("#toprint_divs").removeClass("has-error");
					     $(this).addClass("has-success");
						 return true;
					 }
				
				
			}
			
			


            
            </script>