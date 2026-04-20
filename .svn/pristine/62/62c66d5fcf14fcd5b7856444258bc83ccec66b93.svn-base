<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Combo</title>
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
    .filte_new_box{height: 30px !important;}.search_btn_member_invoice a{line-height: 31px;}.table_report td strong{font-size: 16px}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
<link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<script>
$(document).ready(function()
{
    $("#combo_name").focus();
});


$(".enter").keypress(function(event){
    if(event.keyCode==13){
        alert("hii");
 add_combo();
    }
});

</script>
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
         .tbl_del_combo i {
    color: #000000;
    font-size: 20px;
    top: 6px;
    margin-left: 3%;
}
.icontick{top: -3px;}
.tab_edt_btn {padding: 3px 4px !important;}
    .combo_stock_check_act{background-color: #4a904a !important;color: #fff !important;border-radius: 4px;    width: 70px;}
    .combo_stock_check_dec{background-color: #838a83 !important;color: #fff !important;border-radius: 4px;    width: 70px;}
    .main_logout_popup_cc{z-index:8 !important}
</style>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/combo.js"></script>
</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; 
  include "includes/left_menu.php";
    $combo_name="";
    $combo_type="";
    $combo_status="";
    $combo_edit_id='';
    $status_to='';
    $stock_check='';
  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_REQUEST['combo_name'])){
            $combo_name=$_REQUEST['combo_name'];
            
            //$combo_status=$_REQUEST['combo_status'];
            $combo_id=$_REQUEST['combo_edit_id1'];
        if($combo_id==''){
            $combo_type=$_REQUEST['combo_type'];
        $sql_combo_duplicate_check =  $database->mysqlQuery("select * from tbl_combo_name where cn_name='".$_REQUEST['combo_name']."' "); 
        //echo "select * from tbl_combo_name where cn_name='".$_REQUEST['combo_name']."'";
        $num_combo_duplicate_check  = $database->mysqlNumRows($sql_combo_duplicate_check);
        
        if($num_combo_duplicate_check){
           echo '<script type="text/javascript">';
           echo 'alert("Combo Name Already Exist")';
           echo '</script>';
           
        }
        else{
           
            $sql_combo_add =  $database->mysqlQuery("INSERT INTO `tbl_combo_name`(`cn_name`, `cn_type`) VALUES ('".$combo_name."','".$combo_type."')");
            // echo "INSERT INTO `tbl_combo_name`(`cn_name`, `cn_type`, `cn_active`) VALUES ('".$combo_name."','".$combo_type."')";
            echo '<script type="text/javascript">';
            echo 'window.location.href="combo.php";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=combo.php" />';
            echo '</noscript>'; 
            }
        }
            else{
                $sql_combo_update =  $database->mysqlQuery(" Update  tbl_combo_name set cn_name='".$combo_name."' where cn_id='".$combo_id."'");
//                echo "Update  tbl_combo_name set cn_name='".$combo_name."', cn_type='".$combo_type."',cn_active='".$combo_status."' where cn_id='".$combo_id."' ";
//               exit();
                echo '<script type="text/javascript">';
                echo 'window.location.href="combo.php";';
                echo '</script>';
                echo '<noscript>';
                echo '<meta http-equiv="refresh" content="0;url=combo.php" />';
                echo '</noscript>'; 
            }
        }
        
  else if(isset($_REQUEST['set']) && $_REQUEST['set']=='combo_name_delete'){
    $combo_id=$_REQUEST['combo_id'];
    $sql_menu_delete =  $database->mysqlQuery("DELETE FROM `tbl_combo_pack_menus` WHERE `cpm_combo_id`='".$combo_id."'");
    $sql_pack_rate_delete =  $database->mysqlQuery("DELETE FROM `tbl_combo_pack_rates` WHERE `cpr_combo_id`='".$combo_id."' ");
    $sql_combo_pack_delete =  $database->mysqlQuery(" DELETE FROM `tbl_combo_packs` WHERE `cp_combo`='".$combo_id."'");
    $sql_combo_stock_delete = $database->mysqlQuery("DELETE FROM `tbl_combo_stock` WHERE `cs_combo_id`=='".$combo_id."'");
    $sql_combo_delete =  $database->mysqlQuery("DELETE FROM `tbl_combo_name` WHERE `cn_id`='".$combo_id."'");
    echo "@@@Combo Successfully Deleted...@@@";    
  }
  else if(isset($_REQUEST['set']) && $_REQUEST['set']=='combo_name_status_change'){
    $combo_id=$_REQUEST['combo_id'];
    $status_to=$_REQUEST['status_to'];
    $sql_combo_status_update =  $database->mysqlQuery(" Update  tbl_combo_name set cn_active='".$status_to."' where cn_id='".$combo_id."'");
    
    echo "@@@Combo Status Successfully Changed...@@@";    
  }
  else if(isset($_REQUEST['set']) && $_REQUEST['set']=='stock_check_change'){
    $combo_id=$_REQUEST['combo_id'];
    $stock_check=$_REQUEST['stock_check'];
    $sql_combo_stock_check_update =  $database->mysqlQuery(" Update  tbl_combo_name set cn_stock_check='".$stock_check."' where cn_id='".$combo_id."'");
    
    echo "@@@Combo Stock Check Successfully Changed...@@@";    
  }
  ?>
    
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
			<div class="breadcrumbs">
				<ul>
					<li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
					<li><a style="cursor:pointer">Base Unit Master</a></li>
            <?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(1000).fadeOut('slow');
            </script>
            <?php } ?>
				</ul>
            
                
			</div><!-- breadcrumbs -->
            
  
                <div class="content-sec">
                
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">

                       <div class="cc_new_main">

                        
                       <div style="  border: 1px #B6B6B6 solid;" class="cc_new">

                       	<div id="lista1" class="als-container">
                            <div class="als-viewport" style="width:100% !important">
                                <?php  include "includes/page_top.php"; ?>
                            </div>
                        </div>
                   </div><!--cc_new-->
                  
                   
                   <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                                
                             <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                           
                                 <form name="combo_name"    method="POST">
                                      
                                <input type="hidden" value="<?=$combo_edit_id?>" name="combo_edit_id1" id="combo_edit_id1">   
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:20%">
                           		<span class="filte_new_text">Combo Name</span>
                                        <input type="text" class="form-control filte_new_box enter " tabindex="1" placeholder="Combo Name" name="combo_name" id="combo_name" autocomplete="off">
                            </div>
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:20%">
                           		<span class="filte_new_text">Combo Type</span>
                                        <select class="form-control filte_new_box enter" id="combo_type" name="combo_type" tabindex="2">
                                    <option value=''>Select Combo Type</option>
                                    <?php 
                                    $sql_combo_add =  $database->mysqlQuery("select * from tbl_combo_type "); 
                                    $num_combo_add  = $database->mysqlNumRows($sql_combo_add);
                                        if($num_combo_add){
                                            while($result_combo_add  = $database->mysqlFetchArray($sql_combo_add)){
                                    ?>
                                                <option value="<?=$result_combo_add['ct_id']?>"><?=$result_combo_add['ct_type']?></option>
                                    <?php 
                                       }
                                        }
                                    ?>
                               </select>
                            </div> 
<!--                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%">
                           		<span class="filte_new_text">Status</span>
                                <select class="form-control filte_new_box" id="combo_status" name="combo_status">
                                    <option value="Y">Active</option>
                                    <option value="N">Inactive</option>
                                   
                               </select>
                            </div> -->
                              
                            <div class="col-sm-2 nopadding" style="width: 8% !important;">
                                <div style="margin-left:2%;width: 100%; cursor:pointer" class="search_btn_member_invoice filte_new_box_btn "><a class="enter" type="submit" name="combo_add_btn" id="combo_add_btn" tabindex="3" >ADD</a></div>
                            </div>
                                 </form>
                            <div class="col-sm-2 nopadding" style="width: 8% !important;float:right;margin-right:50px">
                                <div style="margin-left:50%;width: 100%;cursor:pointer" class="search_btn_member_invoice filte_new_box_btn" ><a href="combo_stock.php" type="submit" name="combo_stock_btn">Combo Stock</a></div>
                            </div>
                          <div class="col-sm-2 nopadding" style="width: auto !important;float:right">
                              <span class="alert_in_combo" id="combo_alert_span" style="color:#f00;display:none"></span>
                          </div>      
                        </div><!--form_group-->
                       
                    </div>
                   
                   
                   <!--<div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="testpref()" ></a>
                      </div>  
                   </div>-->
                           
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter" width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                <td width="6.5%">Sl No</td>
                                <th width="10%" height="35px" class="header">Combo Name</th>
                                <th width="10%" height="35px" class="header">Combo Type</th>
                                <th width="10%" height="35px" class="header">Combo Status</th>
                                <td width="10%">Packs</td>
                                <td width="10%">Action</td>
                                <td width="10%">Stock Check</td>
                              </tr>
                             </thead>
                             <tbody>
                                 <?php 
                                    $sql_combo_name =  $database->mysqlQuery("select * from tbl_combo_name left join tbl_combo_type on ct_id=cn_type order by cn_id asc "); 
                                    $num_combo_name  = $database->mysqlNumRows($sql_combo_add);
                                        if($num_combo_name){$i=0;
                                            while($result_combo_name  = $database->mysqlFetchArray($sql_combo_name)){
                                                $i++;
                                    ?>
                             <tr id="" class="select" combo_id>
                                <td width="10%"><?=$i?></td>
                                <td><strong id="combo_name<?=$result_combo_name['cn_id']?>"><?=$result_combo_name['cn_name']?></strong></td>
                                <td id="combo_type<?=$result_combo_name['cn_id']?>" id1="<?=$result_combo_name['ct_id']?>"><?=$result_combo_name['ct_type']?></td>
                                <td id="combo_status<?=$result_combo_name['cn_id']?>" id1="<?=$result_combo_name['cn_active']?>"><?php if($result_combo_name['cn_active']=='Y'){ echo 'YES';}else { echo 'NO';}?></td>
                                <td>
                                 <a href="#" ><span class="pack_add_btn" id="<?=$result_combo_name['cn_id']?>">Add/Edit Packs</span></a>
                                </td>
                                 <td>
                                     <a href="#"  class="md-trigger_prfrnc combo_name_edit" id="<?=$result_combo_name['cn_id']?>" ><img src="images/edit_page.PNG"></a>
                                     <a href="#" class="tbl_del_combo" onclick="return combo_name_delete(<?=$result_combo_name['cn_id']?>)"><i class="glyphicon glyphicon-trash"></i></a>
                                     <?php if($result_combo_name['cn_active']=='Y'){ ?>
                                     <a class="tab_edt_btn combo_status_change" status_to="N" id1="<?=$result_combo_name['cn_id']?>" href="#" ><i class="icontick"><img src="img/red_cross.png" width="25px" height="25px"></i></a>
                                     <?php } if($result_combo_name['cn_active']=='N'){ ?>
                                     <a class="tab_edt_btn combo_status_change" status_to="Y" id1="<?=$result_combo_name['cn_id']?>" href="#" ><i class="icontick"><img src="img/green_tick.png" width="25px" height="25px"></i></a>
                                     <?php }?>
                                 </td>
                                 <td>
                                     <?php if($result_combo_name['cn_stock_check']=='N'){ ?>
                                        <a class="tab_edt_btn combo_stock_check combo_stock_check_dec" stock_check="Y" id1="<?=$result_combo_name['cn_id']?>" href >Activate</a>
                                     <?php } if($result_combo_name['cn_stock_check']=='Y'){ ?>
                                        <a class="tab_edt_btn combo_stock_check combo_stock_check_act" stock_check="N" id1="<?=$result_combo_name['cn_id']?>" href >Inactivate</a>
                                     <?php }?>
                                 </td>
                              </tr>
                                <?php
                                    }}
                                ?>
                             
                            </tbody>
                       </table>
                   </div>
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>
 
<div class="md-overlay"></div><!-- the overlay element -->



<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>


<div class="main_logout_popup_cc common_popup_all combo_delete_pop_new" style="display:none">
        <div class="main_logout_popup">
                <div>
                <h1 class="logout_contant_txt" style="margin-bottom: 30px;font-size: 18px !important;">CONFIRM DELETE ?</h1>
                
                <div class="btn_logout_yes_no" style="background-color: #fff;  border: solid 2px #AB2426;  position: relative;  top: 2px;"><a onclick="$('.common_popup_all').hide();" style="color:#AB2426 !important" href="#" class="">NO</a></div>
                <div class="btn_logout_yes_no"><a onclick="return delete_combo_new();" href="#" class="">YES</a></div>
            </div>
       </div>
     </div>



</body>
</html>