 <?php
error_reporting(0);
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
 $_SESSION['pagid']=16;
$de="";
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['ipaddress'])   )
{
//    if(isset($_REQUEST['activereg'])){
//        $act="Y";
//    }
// else {
//        $act="N";
//    }
	
                $insertion['cm_ip_address'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['ipaddress']));
                $insertion['cm_ip_port'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['port']));
                  $insertion['cm_ip_folder'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['folder']));
                    $insertion['cm_is_server'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['server']));
                       $insertion['cm_ip_remarks'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['remark']));
                   $insertion['cm_enable_cash_drawer'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['drawerenable']));
                    $insertion['cm_cash_drawer_ip'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['drawerip']));
                     $insertion['cm_cash_drawer_port'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['drawerport']));
       
	
         
$sql=$database->check_duplicate_entry('tbl_expodine_machines',$insertion);
 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_expodine_machines',$insertion);
	}
}	

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['ipaddress1'])   )
{


$result=$database->mysqlQuery("UPDATE  tbl_expodine_machines SET  cm_ip_address='" .$_REQUEST['ipaddress1']."', cm_ip_port='" .$_REQUEST['port1']."',cm_ip_folder='" .$_REQUEST['folder1']."',cm_is_server='" .$_REQUEST['server1']."',cm_ip_remarks='" .$_REQUEST['remark1']."',cm_enable_cash_drawer='" .$_REQUEST['drawerenable1']."',cm_cash_drawer_ip='" .$_REQUEST['drawerip1']."',cm_cash_drawer_port='" .$_REQUEST['drawerport1']."' where cm_id='".$_REQUEST['hideditreg']."'");
     
}


//delete//

$a=$_REQUEST['id1'];

   $result=$database->mysqlQuery("DELETE FROM tbl_expodine_machines WHERE cm_id='$a'");  



 


$alert="";
if(isset($_REQUEST['msg']))
{
	if($_REQUEST['msg']=="1")
	{
	$alert="Deleted...";
	}else if($_REQUEST['msg']=="2")
	{
	$alert="Added...";
	}else if($_REQUEST['msg']=="3")
	{
	$alert="Updated...";
	}
}
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Reports</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="master_style/themify-icons.css" type="text/css" /><!-- Icons -->
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="master_style/website.css" type="text/css">
<link rel="stylesheet" href="master_style/responsive.css" type="text/css" /><!-- Responsive -->	
<link rel="stylesheet" href="css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="master_style/demo.css">	
<link rel="stylesheet" href="master_style/table_style.css">	
<link rel="stylesheet" type="text/css" href="master_style/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/component.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/component.css" />
 <link href="master_style/app.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" type="text/css" media="screen" href="css/als_demo.css" />
 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important }
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.table_report thead th, td{padding-left:10px !important;padding-right:10px !important;min-width: 100px;white-space: nowrap;}
.table_report td{padding:10px !important;}
.table_report td.feedbackdisplay{text-align:center !important;}
.table_report thead th{height: 35px;}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 

    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />

<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
.contant_table_cc{height: 92vh}	
	.tablesorter tbody{height: 86vh}	
</style>
</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Report Master</a></li>
          
				</ul>
            
                
			</div><!-- breadcrumbs -->
            
  
                <div class="content-sec">
                
                    <div style="  padding: 2px" class="col-lg-12 col-md-12 main_cc">
                        <h3 style="background: #fff;margin-bottom: 0;padding: 13px;">REPORT MASTER<a style="float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold " href="report_masternew.php">RESET</a></h3>

                       <div class="cc_new_main">

                                           <div class="col-md-12 add_btn_cc_2">
<!--                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" ></a>
                      </div>  -->
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll "  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                  <th > Slno</th>
                                   <th >Report Type</th>
                                <th >Report Id</th>
                                
                                 <th >Report Name</th>
                                 <th >Report View</th>
                                 <th >A4 Print</th>
                                 <th>POS Print of Another</th>
                                 <th >Email</th>
                                 <th >Predefined Emails</th>
                                 <th >Email List </th>
                                 <th >Dayclose Print</th>
                                 <th >Dayclose Email</th>
                                
                                  <th >Dayclose Print Order</th>
                                   
                              </tr>
                             </thead>
                                 <?php
                                 $sl=1;
                          
                                 $drawerenb="N";
                                 $server="N";
	 $sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
					
				
	 ?>
    						<tr >
                                <td><?=$sl++?></td>
                                 <td ><?=$result_login['rm_reporttype']?></td>
                                <td ><?=$result_login['rm_reportid']?></td>
                                <td ><?=$result_login['rm_reportname']?></td>
                                <td ><?=$result_login['rm_reportview']?></td>
                        <td ><?php if($result_login['rm_printa4']=='Y'){  echo "No" ; }else{ echo "Yes" ;  } ?></td>
                                <td ><?=$result_login['rm_posprintofanother']?></td>
                                <td ><?=$result_login['rm_email']?></td>
                                <td ><?=$result_login['rm_predifinedemails']?></td>
                                <td ><?=$result_login['rm_emaillist']?></td>
                                <td ><?=$result_login['rm_daycloseprint']?></td>
                                  <td ><?=$result_login['rm_dayclosemail']?></td>
                               
                                <td ><?=$result_login['rm_dayclose_print_order']?></td>
                                
                                             
                                             
                                   
                                                                                           
                               
<!--                                      editclick-->
<!--<td>
<a  href="#" class="md-trigger editclick"    rsnid="<?//=$result_login['cm_id']?>"><img src="images/edit_page.PNG"></a>
      </td>    
      <td>
          <a  href="expodine_machines.php?id1=<?//=$result_login['cm_id']?>" class="md-trigger" name="delete"  ><img src="img/red_cross.png" width="25px" height="25px"></a>
      </td>-->
              
                                
                              </tr>
                               
                              <?php } } ?>
                        </table>
                   </div>
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>
<!--<div class="md-modal md-effect-16" id="modal-17"  style="width:55%">-->
<!--			<div class="md-content"  >
				<h3>Add New</h3>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                        <form role="form" action="expodine_machines.php"  method="post"  name="machineform"  >
                           
                                <div class="col-lg-6 col-md-6">
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Ip address<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="ipaddress3">
                                     <input type="text" class="form-control cancellation" id="ipaddress" name="ipaddress"  ></div>
                                         </div>                        	
                                     
                              
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Port<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" class="form-control cancellation" id="port" name="port"  ></div>
                                           </div>                         	
                                     	 
                              <div class="first_form_contain">
                             	<div class="form_name_cc">Folder<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" class="form-control cancellation" id="folder" name="folder"  ></div>
                                           </div>                         	
                                     	 
                                  
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Ip remarks<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" class="form-control cancellation" id="remark" name="remark"  ></div>
                                           </div>     
                                 </div>
                              <div class="col-lg-6 col-md-6 no-padding">
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Drawer Ip<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" class="form-control cancellation" id="drawerip" name="drawerip"  ></div>
                                           </div>     
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Drawer port<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" class="form-control cancellation" id="drawerport" name="drawerport"  ></div>
                                           </div> 
                               
                               
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Drawer Enable<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                               <select class="form-control add_new_dropdown" name="drawerenable">
                                            <option value="Y" <?//php if($drawerenb =="Y") echo "selected";?>>Yes</option>
                                            <option value="N" <?//php if($drawerenb =="N") echo "selected";?>>No</option>
                                        </select>
                                </div> 
                                 </div> 
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Server<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                               <select class="form-control add_new_dropdown" name="server">
                                            <option value="Y" <?//php if($server =="Y") echo "selected";?>>Yes</option>
                                            <option value="N" <?//php if($server =="N") echo "selected";?>>No</option>
                                        </select>
                                </div> 
                                 </div> 
                               
                              </div>
                                  </form> 
                    </div>
                                    
                                    <a  href="#" onClick="validate_cancel()" tabindex="3"><button class="md-save" >Save</button></a>
                             <a href="#"><button class="md-close" tabindex="4">Close me!</button></a>
                             
				</div>
                </div>-->
		</div>
<!--//editdiv////-->

                <div class="md-modal md-effect-16" id="modal-18">
<div class="md-content edit_comp"  >
				
</div>
		</div>
<?php

?>
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>


<script>
    function     validate_cancel (){
        if($("#ipaddress").val()=="")
        {
                 alert('Enter the ipadress !');
      
                 document.machineform.ipaddress.focus();
        }else
        {
             
             var ay=document.getElementById("ipaddress").value;
					 
	                               $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=ipaddress&mid="+ay,
			success: function(data)
			{
			data=$.trim(data);
	
			if(data =="yes")
			{
                                                                                           alert("IP address already exists !");
                                                                                           $("#ipaddress3").addClass("has-error");
                                                       $("#ipaddress3").focus();   
                                                           return  false;
                                                                      }
                                                                      else
                                                                      {
                                                                           $("#ipaddress3").removeClass("has-error");
	   $("#ipaddress3").addClass("has-success");
                                                                             document.machineform.submit();
                                                                      }
                                                       }

                                    });
             
     
    }
    }
    
    //edit//
function     validate_editcancel (){
        if($("#ipaddress1").val()=="")
        {
                 alert('Enter the ip !');
      
                 document.machineformedit.ipaddress1.focus();
        }else
        {
        document.machineformedit.submit();
    }
    }
    
    
    </script>
    
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter();
}); 


$(".editclick").click(function(){
    
    $("#modal-18").addClass('md-show');
var as=$(this).attr('rsnid');


                        var dataString = 'id='+as;
                        $.ajax({
                        type: "POST",
                        url: "machines_edit.php",
                        data: dataString,
                        success: function(data) {
                        $('.edit_comp').html(data);

                        }
                        });

                        });
    
    
    
   


</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>