    
    <?php
 
    error_reporting(0);
    include('includes/session.php'); // Check session
    include("database.class.php"); // DB Connection class
    $database	= new Database();
    $_SESSION['pagid']=15;
    $de="";


                $sql_table_pt23="SELECT cm_ip_address FROM tbl_expodine_machines limit 1 ";
		$sql_pt23  =  $database->mysqlQuery($sql_table_pt23); 
		$num_pt23  = $database->mysqlNumRows($sql_pt23);
		if($num_pt23){
                    
                }else{
                    
                $insertion['cm_ip_address'] 		=  mysqli_real_escape_string($database->DatabaseLink,'192.168.1.100');
                $insertion['cm_ip_port'] 		=  mysqli_real_escape_string($database->DatabaseLink,'8021');
                $insertion['cm_ip_folder'] 		=  mysqli_real_escape_string($database->DatabaseLink,'Software');
                $insertion['cm_is_server'] 		=  mysqli_real_escape_string($database->DatabaseLink,'Y');
                $insertion['cm_ip_remarks'] 		=  mysqli_real_escape_string($database->DatabaseLink,'Cash Drawer');
                $insertion['cm_enable_cash_drawer'] 	=  mysqli_real_escape_string($database->DatabaseLink,'N');
                $insertion['cm_cash_drawer_ip'] 	=  mysqli_real_escape_string($database->DatabaseLink,'192.168.1.101');
                $insertion['cm_cash_drawer_port'] 	=  mysqli_real_escape_string($database->DatabaseLink,'9100');
                $insertion['cm_machine_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,'counter');
                $insertion['cm_cash_drawer_usb'] 	=  mysqli_real_escape_string($database->DatabaseLink,'N');
       
             $sql=$database->check_duplicate_entry('tbl_expodine_machines',$insertion);
             if($sql!=1)
	     {
	         $insertid   =  $database->insert('tbl_expodine_machines',$insertion);
	     }
                    
                    
                    
                    
  }




if(isset($_REQUEST['value'])&& ($_REQUEST['value']=="cash_drawer_check")){
    
    
   if($_REQUEST['ip']!='all'){
        
   $ip=$_REQUEST['ip'];
   $port=$_REQUEST['port'];
   $usb=$_REQUEST['usb'];
   
   }else{
        
        
       
                $sql_table_pt23="SELECT * FROM tbl_expodine_machines limit 1 ";
		$sql_pt23  =  $database->mysqlQuery($sql_table_pt23); 
		$num_pt23  = $database->mysqlNumRows($sql_pt23);
		if($num_pt23){
			while($result_pt23  = $database->mysqlFetchArray($sql_pt23)) 
				{
					$ip=$result_pt23['cm_cash_drawer_ip'];
                                        $port=$result_pt23['cm_cash_drawer_port'];
                                        $usb=$result_pt23['cm_cash_drawer_usb'];
				   
				}
		}
   }
    
    
    
   
    
    require_once("Escpos.php");
    
    if($usb!="Y"){
         exec("ping -n 1 -w 1 ".$ip, $output, $result);
             
         if ($result == 0)
         {
             $connector = new NetworkPrintConnector($ip,$port);
	     $printers = new Escpos($connector);
                                                           
	     $printers -> pulse(0);
	     $printers -> close();
         }
         
    }else{
        
         exec("ping -n 1 -w 1 ".$ip, $output, $result);
             
         if ($result == 0)
         {
            $printers="\\\\".$ip."\\".$port;
            $connector = new FilePrintConnector($printers);
            $printers = new Escpos($connector);
            $printers -> pulse(0);
	    $printers -> close();
         }
       
    }
}


if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['ipaddress'])   )
{
//    if(isset($_REQUEST['activereg'])){
//        $act="Y";
//    }
// else {
//        $act="N";
//        
//    }
    $machinetype='';
    $machinetype=$_REQUEST['machinetype'];
    
	
                $insertion['cm_ip_address'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['ipaddress']));
                $insertion['cm_ip_port'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['port']));
                  $insertion['cm_ip_folder'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['folder']));
                    $insertion['cm_is_server'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['server']));
                       $insertion['cm_ip_remarks'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['remark']));
                   $insertion['cm_enable_cash_drawer'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['drawerenable']));
                    $insertion['cm_cash_drawer_ip'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['drawerip']));
                     $insertion['cm_cash_drawer_port'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['drawerport']));
                      $insertion['cm_machine_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($machinetype));
                      $insertion['cm_cash_drawer_usb'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['usbenable']));
       
	
         
$sql=$database->check_duplicate_entry('tbl_expodine_machines',$insertion);
 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_expodine_machines',$insertion);
	}
}	

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['ipaddress1'])   )
{
    $machinetype1='';
//    if($_REQUEST['server1']=='Y'){
//        $machinetype1='';
//    }else if($_REQUEST['server1']=='N'){
        $machinetype1=$_REQUEST['machinetype1'];
    //}


$result=$database->mysqlQuery("UPDATE  tbl_expodine_machines SET  cm_ip_address='" .$_REQUEST['ipaddress1']."', cm_ip_port='" .$_REQUEST['port1']."',cm_ip_folder='" .$_REQUEST['folder1']."',cm_is_server='" .$_REQUEST['server1']."',cm_ip_remarks='" .$_REQUEST['remark1']."',cm_enable_cash_drawer='" .$_REQUEST['drawerenable1']."',cm_cash_drawer_ip='" .$_REQUEST['drawerip1']."',cm_cash_drawer_port='" .$_REQUEST['drawerport1']."',cm_cash_drawer_usb='" .$_REQUEST['usbenable1']."',cm_machine_type='" .$machinetype1."' where cm_id='".$_REQUEST['hideditreg']."'");
     
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
<title>Machines</title>
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
.contant_table_cc{height: 81vh}	
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
					<li><a style="cursor:pointer"> Machines</a></li>
          
				</ul>
            
                
			</div><!-- breadcrumbs -->
            
  
                <div class="content-sec">
                
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                            <h3 style="background: #fff;margin-bottom: 0;padding: 13px;">MACHINES
                                <a style="float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold ;margin-right: -7px;border-radius: 3px;" href="app_tab_details.php">APP MACHINES</a>
                                <a style="float:right;border: solid 1px;font-size: 15px;padding: 3px;font-weight: bold ;margin-right: 15px;border-radius: 3px;" href="expodine_machines.php">REFRESH</a>
                            
                           <?php  $localIP = getHostByName(getHostName());
         $det='';                  
         $con=mysqli_connect(HOST_NAME,USER_NAME, PASSWORD, DATABASE_NAME);
         $a="select pr_printername,pr_printerip,pr_usbprinter,pr_printerport,pr_usbprinterip,pr_defaultusb from "
          . "tbl_printersettings where pr_enable='Y' group by pr_printerip,pr_defaultusb" ;
         $q=mysqli_query($con,$a);
         $slno=1;
         while( $row=mysqli_fetch_array($q))
        {
             
             
              if($row['pr_defaultusb']!="Y"){ 
          
                $prip= $row['pr_printerip'];
                $pr="Lan";
                $prip_port='9100';
                
            }  
            else
            {   $prip= $row['pr_usbprinterip']; 
                $pr="Usb";
                $prip_port=$row['pr_usbprinter']; 
            }
             
             
             $det.=' '.$pr.' IP : '.$prip.' PORT : '.$prip_port.' * ';
             
         }
                           
                           
                           
                           ?>
                                <a style="font-weight: bold;font-size: 13px;margin-left: 10px;color: black  ">     SYSTEM IP  : </span><?=$localIP?>   </a> 
                            
                                
                                <a title="<?=$det?>" style="cursor: pointer;font-weight: bold;font-size: 10px;margin-left: 10px;color: black  "> <i style="font-size:15px" class="fa fa-info-circle"></i>  DRAWER IP AND DARWER PORT SHOULD BE THE PRINTER IP AND PORT CONNECTED TO CASH DRAWER </a>   
                                
                            </h3>
                       
                                
                                
                                
                                <div class="cc_new_main">
                           
                           

                                           <div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" ></a>
                      </div>  
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll "  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                   <th style="min-width:10px" > Sl</th>
                                   <th > Checker </th>
                                    <th style="min-width:30px">Action</th>
                                   
                                <th >System Ip</th>
                                <th > Type</th>
                                <th > Name</th>
                                 <th style="min-width:20px" >Pc Port</th>
                                 <th style="min-width:20px" >Folder</th>
                                 <th style="min-width:20px" >Server</th>
                                 <th style="min-width:20px">Status</th>
                                 
                                 <th style="min-width:20px" >Enable</th>
                                  <th >  Drawer Ip</th>
                                   <th style="min-width:20px">   Port</th>
                                    <th style="min-width:20px"> Usb</th>
                                    
                              </tr>
                             </thead>
                                 <?php
                                 $sl=1;
                          
                                 $drawerenb="N";
                                 $server="N";
	 $sql_login  =  $database->mysqlQuery("select * from tbl_expodine_machines"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ $sl=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$sl++;		
				
	 ?>
    				<tr>
                                    <td style="min-width:10px"><?=$sl?></td> 
                                    
                                    <td>
                                    
                                    <span style="color: black;border:solid 1px; border-radius: 4px;border: solid 1px;   padding: 3px; cursor: pointer ;font-weight:bold;" onclick="return check_drawer(<?=$sl?>);">
                                    Cash Drawer Open
                                </span>
                                </td>
                              
                                <td style="min-width:30px">
    
                               <a  href="#" class="md-trigger editclick"    rsnid="<?=$result_login['cm_id']?>"><img src="images/edit_page.PNG"></a>
                               
                               
                               <a style="display:none"  href="expodine_machines.php?id1=<?=$result_login['cm_id']?>" class="md-trigger" name="delete"  ><img src="img/red_cross.png" width="25px" height="25px"></a>
     
                               
                               </td> 
                             
                                <td ><?=$result_login['cm_ip_address']?></td>
                                <td ><?=$result_login['cm_machine_type']?></td>
                                  <td ><?=$result_login['cm_ip_remarks']?></td>
                                <td style="min-width:20px"><?=$result_login['cm_ip_port']?></td>
                                <td style="min-width:20px"><?=$result_login['cm_ip_folder']?></td>
                                <td style="min-width:20px"><?=$result_login['cm_is_server']?></td>
                                <td style="min-width:20px" ><?=$result_login['cm_status']?></td>
                                
                                
                                <td style="min-width:20px" ><?=$result_login['cm_enable_cash_drawer']?></td>
                                <td ><?=$result_login['cm_cash_drawer_ip']?></td>
                                 <td style="min-width:20px"><?=$result_login['cm_cash_drawer_port']?></td>
                                  <td style="min-width:20px"><?=$result_login['cm_cash_drawer_usb']?></td>
                                             
                                             
                                   
                                                                                           
                               
<!--                                      editclick-->
   
     
              
                                
                              </tr>
                               <input type="hidden" id="caship_<?=$sl?>" value="<?=$result_login['cm_cash_drawer_ip']?>">
                              <input type="hidden" id="cashport_<?=$sl?>" value="<?=$result_login['cm_cash_drawer_port']?>">
                              <input type="hidden" id="cashusb_<?=$sl?>" value="<?=$result_login['cm_cash_drawer_usb']?>">
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
                                     <div style="font-size: 11px;" class="form_name_cc">System Ip<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="ipaddress3">
                                     <input type="text" class="form-control cancellation" id="ipaddress" name="ipaddress" tabindex="1"  ></div>
                                         </div>                        	
                                     <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Machine Name<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="2" class="form-control cancellation" id="remark" name="remark"  ></div>
                                           </div>
                              
                               <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Port<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="3" class="form-control cancellation" id="port" name="port"  ></div>
                                           </div>                         	
                                     	 
                              <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Folder<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="4" class="form-control cancellation" id="folder" name="folder"  ></div>
                                           </div>                         	
                                     	 
                                  
                               
                               <div class="first_form_contain" id="machinetype_div" style="display:block">
                             	<div class="form_name_cc" style="font-size: 11px;">Machine Type<span style="color:#000">  :</span></div>
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
                             	<div class="form_name_cc" style="font-size: 11px;">Drawer Ip<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="6" class="form-control cancellation" id="drawerip" name="drawerip"  ></div>
                                           </div>     
                               <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Drawer port<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                                     <input type="text" tabindex="7" class="form-control cancellation" id="drawerport" name="drawerport"  ></div>
                                           </div> 
                               
                               
                               <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Drawer Enable<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                               <select class="form-control add_new_dropdown" tabindex="8" name="drawerenable">
                                            <option value="Y" <?php if($drawerenb =="Y") echo "selected";?>>Yes</option>
                                            <option value="N" <?php if($drawerenb =="N") echo "selected";?>>No</option>
                                        </select>
                                </div> 
                                 </div> 
                                <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Server<span style="color:#000">  :</span></div>
                               	 <div class="form_textbox_cc" id="feedback_div">
                               <select class="form-control add_new_dropdown" tabindex="9" name="server" id="server">
                                            <option value="Y" <?php if($server =="Y") echo "selected";?>>Yes</option>
                                            <option value="N" <?php if($server =="N") echo "selected";?>>No</option>
                                        </select>
                                </div> 
                                 </div> 
                                  <div class="first_form_contain">
                             	<div class="form_name_cc" style="font-size: 11px;">Drawer Usb<span style="color:#000">  :</span></div>
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
    
    function check_drawer(i){
       var ip=$('#caship_'+i).val();
       var port=$('#cashport_'+i).val();
      	var usb=$('#cashusb_'+i).val();	
        
        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('CHECKING DRAWER ');
                        $('.alert_error_popup_all_in_one').delay(5000).fadeOut('slow');
        
        
        
			$.ajax({
			type: "POST",
			url: "expodine_machines.php",
			data: "value=cash_drawer_check&ip="+ip+"&port="+port+"&usb="+usb,
                        
			success: function(data){
                            
                        
                        
                           //alert('Drawer checking . . . . . .')
              setInterval(function () {
               location.reload();
                }, 1000);
           
                           
                        }
                             });
			
        
    }
    </script>
    
<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">

$(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
        
          $("#modal-17").removeClass('md-show');
    });

$(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
        
          $("#modal-18").removeClass('md-show');
    });


$(document).ready(function() {
   $("#listall").tablesorter();
}); 

 $('.btn_cc_2').click(function(){
     //alert( "clicked" );
    $('#ipaddress').focus();
});
//if($('#server').val()=='Y'){
//    $('#machinetype_div').css('display','none');
//}
//else if($('#server').val()=='N'){
//    $('#machinetype_div').css('display','block');
//}
//$('#server').change(function(){
//    
//  if($('#server').val()=='Y'){
//    $('#machinetype_div').css('display','none');
//}
//else if($('#server').val()=='N'){
//    $('#machinetype_div').css('display','block');
//}  
//});

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