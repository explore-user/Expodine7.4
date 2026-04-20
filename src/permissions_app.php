<?php
session_start();

include("database.class.php"); 
$database	= new Database();

  $id = $_GET['id'];
  
  $sqlstaffname=$database->mysqlQuery("SELECT ser_designation,ser_firstname from tbl_staffmaster where ser_staffid='".$id."'");
  $num_staffname   = $database->mysqlNumRows($sqlstaffname);
  $result_staffname  = $database->mysqlFetchArray($sqlstaffname);
  
  $staffname=$result_staffname['ser_firstname'];
  $desgn=$result_staffname['ser_designation'];
  
  
  $sql_login  =  $database->mysqlQuery("select tap_staff_id from tbl_app_permissions  Where tap_staff_id='$id'"); 

  $num_login   = $database->mysqlNumRows($sql_login);

   if(!$num_login){
  
  $query5= $database->mysqlQuery("insert into tbl_app_permissions(tap_staff_id,tap_staffname) values ('$id','$staffname') "); 
  
  }
  
  
if($_SERVER['REQUEST_METHOD']=='POST' )
{ 
    
 $query5= $database->mysqlQuery("update tbl_app_permissions set tap_app_login='".$_REQUEST['tap_app_login']."' , "
 . " `tap_dinein_module`='".$_REQUEST['tap_dinein_module']."',`tap_tahd_module`='".$_REQUEST['tap_tahd_module']."',"
 . " `tap_cs_module`='".$_REQUEST['tap_cs_module']."' , "
 . " `tap_item_cancel`='".$_REQUEST['tap_item_cancel']."', `tap_bill_cancel`='".$_REQUEST['tap_bill_cancel']."' ,"
 . "  tap_table_change='".$_REQUEST['tap_table_change']."',`tap_bill_reprint`='".$_REQUEST['tap_bill_reprint']."' ,"
 . " tap_settle_dinein='".$_REQUEST['tap_settle_dinein']."', tap_settle_ta_hd='".$_REQUEST['tap_settle_ta_hd']."' ,"
 . " tap_settle_cs='".$_REQUEST['tap_settle_cs']."', tap_shift='".$_REQUEST['tap_shift']."',tap_discount='".$_REQUEST['tap_discount']."'"
         . "  where tap_staff_id='$id' "); 
  
  
 
}


?>
 


<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Permissions</title>
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
 <script src="js/jquery-2.1.3.min.js"></script><!--jquery-1.10.2.min-->
<script src="master_style/js/modernizr.custom.js"></script>
<style>
.container{background-color:transparent;}
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.contant_table_cc{height: 74vh;min-height: 474px;}
.md-content > div{overflow:auto}
.form_name_cc{font-size:13px;height:30px;line-height:30px;}
.first_form_contain{padding: 0.5%;margin-bottom: 0px;}
.md-modal{width:70%;min-width:800px;}
.md-content > div{max-height:550px;overflow:auto;padding-bottom:60px;}
.md-modal .form-control{ height: 33px;padding: 5px 12px;}
.popup_add_table tr:nth-child(even) {background: #E0E0E0;}
.popup_add_table td {height: 38px;font-size: 14px;border:solid 1px #ccc;}
.md-content .form_name_cc{text-align:left;line-height:22px;min-height:30px;height:auto}
.new{width:27px;height:27px;float:right}
.new-cl{height:auto !important;}
.toggle-menu{display:none}
#container{overflow:auto}
    .inherit_btn{float: left;margin-left: 5px;}
    .permission_top_btn{border-bottom: 3px solid #c11d00;background-color: #e83616;border-radius: 6px;}
    .change_permission_popup {width: 350px;height: 120px;margin: auto;position: fixed;left: 0;right: 0;top: 20%;background-color: #fff;z-index: 9999999;display: none;}.change_permission_popup h3 {
    margin: 0;padding: 0.4em;text-align: center;font-size:16px;font-weight: 300;opacity: 0.8;    background: rgba(0,0,0,0.2);border-bottom: 1px #9A9898 solid;border-radius: 3px 3px 0 0;color: #000;}.change_permission_content {width: 100%;height: auto;float: left;padding: 2%;}.edit_menu_label_permission {width: 100%;height: auto;float: left;margin-bottom: 10px;}.edit_menu_label_permission .label_main_member_edit {width: 15% !important;line-height: 25px !important;    font-family: 'Arimo';font-size: 14px;color: #333;padding-left: 5px;padding-top: 4px;float: left;}.edit_menu_label_permission .form-control_main {display: block;width: 83%;
    float: left;height: 34px;padding: 6px 12px;border-radius: 5px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;}
    .change_permission_popup_btn {width: 100%;height: 40px;float: left;text-align: center;margin-top: -2px;}.pop_btn_new_1 { width: 100px !important; height: 30px !important;display: inline-block;margin: auto;    background-color: #891500;color: #fff;text-align: center;line-height: 30px !important;font-size: 14px;
    border-radius: 5px;margin: 1%;cursor: pointer;transition: all 0.2s ease;}.change_permission_overlay{background-color: rgba(0,0,0,0.8);position: fixed;width: 100%;
    height: 100%;top: 0;left: 0;z-index: 999999;display: none;}
    .md-overlay{z-index:1}
.md-modal{z-index: 2}
.new_overlay{z-index:2 !important}
.md-content{z-index: 3 !important}
.change_permission_popup{z-index:3 !important}
.change_permission_overlay{z-index: 3 !important}
</style>

</head>
<body style="overflow:auto">
    
    <input type="hidden" value="<?=$id?>" id="staff_id_inherit" >
    
    
<div class="olddiv "></div> 
<div class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;left:0;width:100%;background-color: rgb(181, 181, 181);"  id="container">
			
                <div class="content-sec">
                
               
                
                	<div style="padding: 2px;" class="col-lg-12 col-md-12 main_cc">
                       <div class="branch_master_main_container" style="overflow:visible;">
                           <a  href="#" onclick="returntostaff('<?=$id?>');"><div style="width: auto;border-radius: 0  ;color: black;font-weight: bold;z-index:1;background-color: #6bbfbb;padding-right: 10px;border-radius: 5px" class="permision_top_back_btn"><img src="img/back_btn.png"> STAFF MASTER</div></a>
                           <div class="new_branch_main_setings_head permission_main_head" ><span style="text-transform: uppercase;font-weight: bold;color: darkred "><?= $staffname?> : APP PERMISSIONS</span> 
                            	
                            </div> 
                             	 <form role="form" action="permissions_app.php?id=<?=$id?>"  method="post" id="permissionset"  name="permission_new">
                                <div class="permission_content_cc">
                                	<div class="permission_left_div" style="margin-left:0">
                                        
                                    	<div class="permission_left_div_head">
                                            
                                            <?php if($id!='1'){ ?>
                                            <a style=""  href="#"><div style="background-color:#e4aea4;color:black;font-weight: bold;width: 190px" class="permission_top_btn inherit_btn inherit_btn_click">Inherit App Permissions</div></a>
                                             
                                            <?php } ?>
                                            
                                        	<a href="#"><div class="permission_top_btn permi_edit1">Edit</div></a>
                                			<a href="#"><div style="display:none" class="permission_top_btn permi_save1">Save</div></a>
                                        </div>
                                            
                                          <?php 
                                               
                                          $username='';   
                                          $sql_login  =  $database->mysqlQuery("select * from tbl_app_permissions  Where tap_staff_id='$id'"); 

                                          $num_login   = $database->mysqlNumRows($sql_login);

                                          if($num_login){
                                                  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			                       {
//                                 
                                                if($result_login['tap_app_login']=="Y")
                                                    {

                                                            $applogin="Yes";
                                                    }else 
                                                    {
                                                            $applogin="No";
                                                    }
                                                    
                                                    
                                                     if($result_login['tap_dinein_module']=="Y")
                                                    {     $tap_dinein_module="Yes";
                                                    }else 
                                                    {      $tap_dinein_module="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['tap_tahd_module']=="Y")
                                                    {   $tap_tahd_module="Yes";
                                                    }else 
                                                    {      $tap_tahd_module="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['tap_cs_module']=="Y")
                                                    {   $tap_cs_module="Yes";
                                                    }else 
                                                    {      $tap_cs_module="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['tap_item_cancel']=="Y")
                                                    {    $tap_item_cancel="Yes";
                                                    }else 
                                                    {     $tap_item_cancel="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['tap_bill_cancel']=="Y")
                                                    {     $tap_bill_cancel="Yes";
                                                    }else 
                                                    {    $tap_bill_cancel="No";
                                                    }
                                                    
                                                    
                                                    if($result_login['tap_table_change']=="Y")
                                                    {     $tap_table_change="Yes";
                                                    }else 
                                                    {    $tap_table_change="No";
                                                    }
                                                    
                                                    if($result_login['tap_bill_reprint']=="Y")
                                                    {     $tap_bill_reprint="Yes";
                                                    }else 
                                                    {    $tap_bill_reprint="No";
                                                    }
                                                    
                                                     if($result_login['tap_settle_dinein']=="Y")
                                                    {     $tap_settle_dinein="Yes";
                                                    }else 
                                                    {    $tap_settle_dinein="No";
                                                    }
                                                    
                                                     if($result_login['tap_settle_ta_hd']=="Y")
                                                    {     $tap_settle_ta_hd="Yes";
                                                    }else 
                                                    {    $tap_settle_ta_hd="No";
                                                    }
                                                    
                                                    if($result_login['tap_settle_cs']=="Y")
                                                    {     $tap_settle_cs="Yes";
                                                    }else 
                                                    {    $tap_settle_cs="No";
                                                    }
                                                    
                                                    if($result_login['tap_shift']=="Y")
                                                    {     $tap_shift="Yes";
                                                    }else 
                                                    {    $tap_shift="No";
                                                    }
                                                    
                                           
                                                    if($result_login['tap_discount']=="Y")
                                                    {     $tap_discount="Yes";
                                                    }else 
                                                    {    $tap_discount="No";
                                                    }
                                                    
                                                
                                                 } } ?>

                                        <div class="permission_contant_cc staff_permission_view1">
                                     
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">APP LOGIN PERMISSION </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$applogin?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">DINE-IN MODULE PERMISSION </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_dinein_module?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">TA-HD MODULE PERMISSION </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_tahd_module?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">CS MODULE PERMISSION </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_cs_module?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">ITEM CANCEL PERMISSION </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_item_cancel?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">BILL CANCEL PERMISSION </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_bill_cancel?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">TABLE CHANGE </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_table_change?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">BILL REPRINT </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_bill_reprint?>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">SETTLE DINE-IN  </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_settle_dinein?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">SETTLE TA-HD </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_settle_ta_hd?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">SETTLE CS </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_settle_cs?>
                                                </div>
                                            </div>
                                            
                                              <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">SHIFT OPEN </div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_shift?>
                                                </div>
                                            </div>
                                            
                                            <div class="permision_main_contant_cc">
                                            	<div class="permision_main_contant_name">DISCOUNT PERMISSION</div>
                                                <span style="float:left;line-height:30px;">:</span>
                                                 <div class="permision_main_contant">
                                                	<?=$tap_discount?>
                                                </div>
                                            </div>
                                
                                            
                                        </div>
                                        
                                        
                                            
                                            
                                            
                                            
                                            
                                             <!--   ///edit/////-->
                                            
                                            
                                            <div class="permission_contant_cc staff_permission_edit1" style="display:none">
                                                  
                                             
                                            
                                            <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">APP LOGIN PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_app_login">
                                                       <option value="Y" <?php if($applogin =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($applogin =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                            
                                                
                                               <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">DINE-IN MODULE PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_dinein_module">
                                                       <option value="Y" <?php if($tap_dinein_module =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_dinein_module =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                
                                                  <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">TA-HD MODULE PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_tahd_module">
                                                       <option value="Y" <?php if($tap_tahd_module =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_tahd_module =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                  <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">CS MODULE PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_cs_module">
                                                       <option value="Y" <?php if($tap_cs_module =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_cs_module =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                  <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">ITEM CANCEL PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_item_cancel">
                                                       <option value="Y" <?php if($tap_item_cancel =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_item_cancel =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                  <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">BILL CANCEL PERMISSION</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_bill_cancel">
                                                       <option value="Y" <?php if($tap_bill_cancel =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_bill_cancel =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                
                                            <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">TABLE CHANGE</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_table_change">
                                                       <option value="Y" <?php if($tap_table_change =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_table_change =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                              
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">BILL REPRINT CHANGE</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_bill_reprint">
                                                       <option value="Y" <?php if($tap_bill_reprint =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_bill_reprint =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">SETTLE DINE-IN</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_settle_dinein">
                                                       <option value="Y" <?php if($tap_settle_dinein =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_settle_dinein =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">SETTLE TA-HD</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_settle_ta_hd">
                                                       <option value="Y" <?php if($tap_settle_ta_hd =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_settle_ta_hd =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">SETTLE CS </div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_settle_cs">
                                                       <option value="Y" <?php if($tap_settle_cs =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_settle_cs =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">SHIFT OPEN</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_shift">
                                                       <option value="Y" <?php if($tap_shift =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_shift =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                
                                                <div class="permision_main_contant_cc edit_div">
                                            	<div class="permision_main_contant_name">SHIFT OPEN</div>
                                                <div class="permision_main_contant_dropdown">
                                                     <select class="form-control add_new_dropdown" name="tap_discount">
                                                       <option value="Y" <?php if($tap_discount =="Yes") echo "selected";?>>Yes</option>
                                                       <option value="N" <?php if($tap_discount =="No") echo "selected";?>>No</option>
                                                     </select>
                                               </div>
                                            </div>
                                                
                                                
                                            
                                           
                                        </div>
                   
                           
                                    </div>
                            
                            
                       </div>
                                 </form>
                       </div>
		</div>
	</div>
</div>
</div><!--container-->
</div>
    
 <div class="change_permission_overlay" style="display: none;"></div>   
    
<div class="change_permission_popup" style="display: none;">
 	<h3>Inherit App Permissions</h3>
    <div class="change_permission_content">
    
    	<div class="edit_menu_label_permission">
           <div class="label_main_member_edit">From : </div>
      <select class="form-control_main" placeholder="User Name" id="staff_from" name="staff_from">
		  <option value="">Select App User</option>
         <?php
		   $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster Where ser_employeestatus='Active' "); 

                                          $num_login   = $database->mysqlNumRows($sql_login);

                                          if($num_login){
                                                  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			                       {
                                                      ?>
                                                  <option value="<?=$result_login['ser_staffid']?>"> <?= $result_login['ser_firstname']?> </option>     
                                                      <?php
                                                  }
                                                  }
                                                  ?>
	</select>
         </div><!---edit_menu_label-->
    
           <div class="change_permission_popup_btn">
         		<a href="#"><div class="pop_btn_new_1 inherit_ok_bt" id="inherit_staff" onclick="validate_permisn()">OK</div></a>
                <a href="#"><div class="pop_btn_new_1" id="canc">Cancel</div></a>
         </div>
         
    </div><!--change_popup_content-->
 </div>
 


<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script>
     $(document).ready(function() {
$(".permi_edit1").click(function(){
    $(".permi_edit1").css("display","none");
	$(".permi_save1").css("display","block");
	$(".staff_permission_edit1").css("display","block");
	$(".staff_permission_view1").css("display","none");
});

$(".permi_save1").click(function(){
    $(".permi_edit1").css("display","block");
	$(".permi_save1").css("display","none");
	$(".staff_permission_edit1").css("display","none");
	$(".staff_permission_view1").css("display","block");
        document.permission_new.submit();
});
$(".permi_edit2").click(function(){
    $(".permi_edit2").css("display","none");
	$(".permi_save2").css("display","block");
	$(".staff_permission_edit2").css("display","block");
	$(".staff_permission_view2").css("display","none");
});

$(".permi_save2").click(function(){
    $(".permi_edit2").css("display","block");
	$(".permi_save2").css("display","none");
	$(".staff_permission_edit2").css("display","none");
	$(".staff_permission_view2").css("display","block");
        document.permission_new.submit();
         var data = $("form").serialize(); 
//alert(data);
                $.ajax({
                    url: "load_permission.php", // link of your "whatever" php
                    type: "POST",
                    async: true,
                    cache: false,
                    data: data, // all data will be passed here
                    success: function(data){ 
                        
                       // alert(data) // The data that is echoed from the ajax.php
                    }
                });
        
});


$(".permi_edit3").click(function(){
    $(".permi_edit3").css("display","none");
	$(".permi_save3").css("display","block");
	$(".staff_permission_edit3").css("display","block");
	$(".staff_permission_view3").css("display","none");
});

$(".permi_save3").click(function(){
    $(".permi_edit3").css("display","block");
	$(".permi_save3").css("display","none");
	$(".staff_permission_edit3").css("display","none");
	$(".staff_permission_view3").css("display","block");
        document.permission_new.submit();
});
$('.checkallchek').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.permisn').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
			 $('.permisn_sub').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.permisn').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });  
			 $('.permisn_sub').each(function() { //loop through each checkbox
                this.checked = false;  //select all checkboxes with class "checkbox1"               
            });       
        }
    });
     });
    
    $(".inherit_btn_click").click(function(){
        $(".change_permission_overlay").show();
        $(".change_permission_popup").show();
    });
    
    
    $("#canc").click(function(){
        $(".change_permission_overlay").hide();
        $(".change_permission_popup").hide();
    });
   
   
   
  $("#inherit_staff").click(function(){
       
    var main_staff_id= $("#staff_id_inherit").val();
    var from_staff = $("#staff_from").val();
    if(from_staff!=''){
    var data = "set_staff_app=staff_inherit_app&from="+from_staff+"&to="+main_staff_id; 
   
                $.ajax({
                    url: "load_permission.php", 
                    type: "POST",
                    async: true,
                    cache: false,
                    data: data, 
                    success: function(data){ 
                        
                       
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('App Permissions Inherited');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
              setInterval(function () {
                   location.reload();
              }, 500);
                       
                }
                });
                
            }else{
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Select App User');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
               
            }
   
    });
    
    
    
    
    function returntostaff(id){
      window.location='staff_master.php?staff_id='+id;
    }
    
    
   
</script>

</body>
</html>