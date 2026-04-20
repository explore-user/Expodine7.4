 <?php
error_reporting(0);
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();


if(isset($_REQUEST['value']) && $_REQUEST['value']=='delete_app' )   
{
   
$result=$database->mysqlQuery("delete from  tbl_appmachinedetails where  as_appmachineid='" .$_REQUEST['id']."'");
     
}

if(isset($_REQUEST['value']) && $_REQUEST['value']=='delete_all' )   
{
   
$result=$database->mysqlQuery("delete from  tbl_appmachinedetails where  as_appmachineid!='' ");
     
}


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
<title>App</title>
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
.md-overlay{z-index:1}
.md-modal{z-index: 2}
.new_overlay{z-index:2 !important}
.md-content{z-index: 3 !important}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 

    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />

<style>
	.form_name_cc{width: 30%;}
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
					<li><a style="cursor:pointer">Machines</a></li>
          
				</ul>
            
                
			</div><!-- breadcrumbs -->
            
  
                <div class="content-sec">
                
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                            <h3 style="background: #fff;margin-bottom: 0;padding: 13px;">APP MACHINES 
                                <a style="float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold;margin-right: -7px;border-radius: 3px " href="app_tab_details.php?value=delete_all">DELETE ALL </a>
                                <a style="float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold;margin-right: 15px;border-radius: 3px;color: black  " href="expodine_machines.php">Back</a>
                                <a style="float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold;margin-right: 15px;border-radius: 3px;color: darkolivegreen  " href="index.php">Home</a></h3>
                       <div class="cc_new_main">

                                           <div class="col-md-12 add_btn_cc_2">
                                               <div class="btn_cc_2" style="display:none">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll "  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                   <th > . </th>
                                    
                                 <th > Slno</th>
                              
                                <th >Machine Type</th>
                                <th >Machine Id</th>
                              
                                 <th >Last Updated</th>
                                 <th >Added Date</th>
                                 <th>Status</th>
                                 
                              </tr>
                             </thead>
                                 <?php
                                 $sl=1;
                          
                                 $drawerenb="N";
                                 $server="N";
	 $sql_login  =  $database->mysqlQuery("select * from tbl_appmachinedetails"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ $sl=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$sl++;		
				
	 ?>
    						<tr >
                                                    <td style="text-decoration: underline;cursor: pointer ;font-weight:bold;" onclick="return check_drawer('<?=$result_login['as_appmachineid']?>');">DELETE</td>
                                              
                              <td><?=$sl?></td>
                              
                                <td >App</td>
                                  <td ><?=$result_login['as_appmachineid']?></td>
                              
                                <td ><?=$result_login['as_lastupdated']?></td>
                                <td ><?=$result_login['as_em_lastupdated']?></td>
                                <td ><?=$result_login['as_appmachiesych']?></td>
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
<div class="md-modal md-effect-16" id="modal-17"  style="width:55%">
			<div class="md-content"  >
				<h3>ADD NEW</h3>
        <div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>
				<div>
                    <div class="col-lg-12 col-md-12 no-padding">
                        <form role="form" action="expodine_machines.php"  method="post"  name="machineform"  >
                           
                                <div class="col-lg-6 col-md-6">
                               <span id="feedbkchk" class="load_error alertsmaster" style="color:#F00" ></span> 
                        	 <div class="first_form_contain">
                             	<div class="form_name_cc">Ip address<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="ipaddress3">
                                     <input type="text" class="form-control cancellation" id="ipaddress" name="ipaddress" tabindex="1"  ></div>
                                         </div>                        	
                                     <div class="first_form_contain">
                             	<div class="form_name_cc">Machine Name<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="2" class="form-control cancellation" id="remark" name="remark"  ></div>
                                           </div>
                              
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Port<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="3" class="form-control cancellation" id="port" name="port"  ></div>
                                           </div>                         	
                                     	 
                              <div class="first_form_contain">
                             	<div class="form_name_cc">Folder<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="4" class="form-control cancellation" id="folder" name="folder"  ></div>
                                           </div>                         	
                                     	 
                                  
                               
                               <div class="first_form_contain" id="machinetype_div" style="display:block">
                             	<div class="form_name_cc">Machine Type<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <select tabindex="5"  class="form-control cancellation" id="machinetype" name="machinetype"  >
                                    <option value="" <?php if($server =="") echo "selected";?>>Please Select</option>
                                     <option value="counter" <?php if($server =="counter") echo "selected";?>>Counter</option>
                                    <option value="client" <?php if($server =="client") echo "selected";?>>Client</option>
                                    </select>
                               </div>  
                                </div>
                               
                                 </div>
                              <div class="col-lg-6 col-md-6 no-padding">
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Drawer Ip<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="6" class="form-control cancellation" id="drawerip" name="drawerip"  ></div>
                                           </div>     
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Drawer port<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="7" class="form-control cancellation" id="drawerport" name="drawerport"  ></div>
                                           </div> 
                               
                               
                               <div class="first_form_contain">
                             	<div class="form_name_cc">Drawer Enable<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                               <select class="form-control add_new_dropdown" tabindex="8" name="drawerenable">
                                            <option value="Y" <?php if($drawerenb =="Y") echo "selected";?>>Yes</option>
                                            <option value="N" <?php if($drawerenb =="N") echo "selected";?>>No</option>
                                        </select>
                                </div> 
                                 </div> 
                                <div class="first_form_contain">
                             	<div class="form_name_cc">Server<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                               <select class="form-control add_new_dropdown" tabindex="9" name="server" id="server">
                                            <option value="Y" <?php if($server =="Y") echo "selected";?>>Yes</option>
                                            <option value="N" <?php if($server =="N") echo "selected";?>>No</option>
                                        </select>
                                </div> 
                                 </div> 
                                  <div class="first_form_contain">
                             	<div class="form_name_cc">Drawer Usb<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                               <select class="form-control add_new_dropdown" tabindex="10" name="usbenable" id="usbenable">
                                            
                                            <option value="N">No</option>
                                            <option value="Y" >Yes</option>
                                        </select>
                                </div> 
                                 </div> 
                               
                              </div>
                                  </form> 
                    </div>
                                    
                                  

                             
                               <a  href="#" onClick="validate_cancel()" tabindex="11"><button class="md-save" >Save</button></a>
                             
				</div>
                </div>
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
                // alert('Enter Ip Address ');
                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Ip Address');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
      
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
                                                                                          // alert("IP Address Already exists !");
                                                                                          
                                                                                           $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('IP Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
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
                // alert('Enter the ip !');
                 $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter IP Address');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
      
                 document.machineformedit.ipaddress1.focus();
        }else
        {
        document.machineformedit.submit();
    }
    }
    
    function check_drawer(id){
        
			$.ajax({
			type: "POST",
			url: "app_tab_details.php",
			data: "value=delete_app&id="+id,
                        
			success: function(data){
                             $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('DELETED');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
                           
                   setInterval(function () {
                     location.reload();
                }, 1000);
           
                           
                        }
                             });
			
        
     }
    </script>
    
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">


</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>