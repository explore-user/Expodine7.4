<?php
include('includes/session.php');  // Check session
include("database.class.php"); // DB Connection class
$database = new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid'] = 1;

$localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
         
if (isset($_REQUEST['delete'])) {
    
    $id = $_REQUEST['id'];
    $database->mysqlQuery("DELETE FROM tbl_floormaster WHERE fr_floorid = '" . $_REQUEST['id'] . "'");
    //header("location:floor_master.php?msg=1");
    if (!headers_sent()) {
        header('Location: floor_master.php?msg=1');
        exit;
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="floor_master.php?msg=1";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=floor_master.php?msg=1" />';
        echo '</noscript>';
        exit;
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['floor'])) { 
    
    
     $br="1";
     $insertion['fr_floorname'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['floor']));
     $insertion['fr_branchid'] = mysqli_real_escape_string($database->DatabaseLink, trim($br));
     $insertion['fr_order_display'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['floor_order']));
     $insertion['fr_qr_order'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['qr_code']));
    
    //	$insertion['fr_printerid']  =  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['printer']));
    if (isset($_REQUEST['active'])) {
        $insertion['fr_status'] = 'Active';
    } else {
        $insertion['fr_status'] = 'Non Active';
    }
    if($_REQUEST['extax']=='No'){
        $insertion['fr_enable_extra_tax'] = mysqli_real_escape_string($database->DatabaseLink,'N');
    }
    else if($_REQUEST['extax1']=='Yes'){
        $insertion['fr_enable_extra_tax'] = mysqli_real_escape_string($database->DatabaseLink,'Y');
    }
    
    $sql = $database->check_duplicate_entry('tbl_floormaster', $insertion);
    if ($sql != 1) {
        
        $insertid = $database->insert('tbl_floormaster', $insertion);
        $database->updateexpodine_machines(); 
        
        $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
       
        $lastid = '';
        $sql_login = $database->mysqlQuery("select fr_floorid from tbl_floormaster where fr_floorname='" . $insertion['fr_floorname'] . "'  AND fr_branchid='" . $insertion['fr_branchid'] . "'");
        $num_login = $database->mysqlNumRows($sql_login);
        while ($result_login = $database->mysqlFetchArray($sql_login)) {
            $lastid = $result_login['fr_floorid'];
        }

		
    }
    
    if (!headers_sent()) {
        header('Location: floor_master.php?msg=2');
        exit;
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="floor_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=floor_master.php?msg=2" />';
        echo '</noscript>';
        exit;
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['floor1'])) {
    
    if (isset($_REQUEST['active1'])) {
        $active = 'Active';
    } else {
        $active = 'Non Active';
    }
    if($_REQUEST['extax1']=='No'){
    $extax1 = 'N';
    }
    else if($_REQUEST['extax1']=='Yes'){
    $extax1 = 'Y';
    }
    $id = $_REQUEST['floorid'];
    $floor = trim($_REQUEST['floor1']);
    $branch = "1";
    
     $floor_order1 = trim($_REQUEST['floor_order1']);
    
     $qrcode1=trim($_REQUEST['qr_code1']);
  
   
    $query3 = $database->mysqlQuery("update tbl_floormaster set fr_qr_order='$qrcode1', fr_order_display='$floor_order1', "
    . " fr_floorname='$floor', fr_branchid='$branch',fr_status='$active',fr_enable_extra_tax='$extax1' where fr_floorid='$id'");
    
    $database->updateexpodine_machines(); 
    
     $sql_general_sync =  $database->mysqlQuery("update  tbl_staffmaster set ser_app_change='Y' ");
 
    if (!headers_sent()) {
        header('Location: floor_master.php?msg=3');
        exit;
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="floor_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=floor_master.php?msg=3" />';
        echo '</noscript>';
        exit;
    }
}

$alert = "";
if (isset($_REQUEST['msg'])) {
    if ($_REQUEST['msg'] == "1") {
        $alert = "Deleted...";
    } else if ($_REQUEST['msg'] == "2") {
        $alert = "Added...";
    } else if ($_REQUEST['msg'] == "3") {
        $alert = "Updated...";
    }
}
?>
<!doctype html>
<html ng-app="website">
    <head>
        <meta charset="utf-8">
        <title>Floor</title>
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
            .tablesorter tbody{float:left;}
            .md-overlay{z-index:1}
.md-modal{z-index: 2}
.new_overlay{z-index:2 !important}
.md-content{z-index: 3 !important}
.navbar-inner{z-index: 999999 !important;}
        </style>
        <script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
        <script type="text/javascript">
            jQuery(document).ready(function () {
                $('#floors').autocomplete({source: 'autocomplete/find_keywords.php?type=floors_s', minLength: 1});
                $('#branchs').autocomplete({source: 'autocomplete/find_keywords.php?type=branchs_s', minLength: 1});
                $('#servtxs').autocomplete({source: 'autocomplete/find_keywords.php?type=servtxs_s', minLength: 1});
                $('#vats').autocomplete({source: 'autocomplete/find_keywords.php?type=vats_s', minLength: 1});
                $('#servchs').autocomplete({source: 'autocomplete/find_keywords.php?type=servchs_s', minLength: 1});
                $('#statuss').autocomplete({source: 'autocomplete/find_keywords.php?type=statuss_s', minLength: 1});
            });
        </script>
        <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" /> 

        <script>

           // $('#floor').focus();

           $(document).on('keydown',function(e)
    {
        if(e.keyCode == 27)
            
       $("#modal-17").removeClass('md-show');
    });

            $(document).ready(function () {
                $('.table_report tr').click(function () {
                    var id_str = $(this).attr("id");
                    var id_arr = id_str.split("_");
                    var selval = id_arr[1];
                    $('.table_report tr').removeClass('table_active');
                    $(this).addClass('table_active');
                    $('#hiddenmenuid').val(selval);
                });
                $('.md-trigger_flr').click(function () {
                    var id_str = $(this).attr("id");
                    var id_arr = id_str.split("_");
                    var selval = id_arr[1];
                    $('.table_report tr').removeClass('table_active');
                    $(this).parent().parent().addClass('table_active');
                    $('#hiddenmenuid').val(selval);
                    $('.mynewpopupload').css("display", "block");
                    $(".olddiv").addClass("new_overlay");
                    var menuid = $('#hiddenmenuid').val();
                    $.post("popup/floor_edit.php", {floor: menuid},
                            function (data)
                            {
                                data = $.trim(data);

                                $('.mynewpopupload').html(data);
                                 $('#floor1').attr('qr_id_flr',menuid);
                                
                                
                            });
                });
                $('.ui-corner-all').click(function () {
                    validateSearch();
                });
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
        </style>
    </head>
    <body>
        <div class="olddiv "></div> 
        <div id="blr" class="container nopaddding">
<?php include "includes/topbar_master.php"; ?>
            <?php include "includes/left_menu.php"; ?>
            <div class="mian">
                <div class="view-container">
                    <div style=" top: 58px;"  id="container">
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
                                <li><a style="cursor:pointer">Floor - Section Master</a></li>
<?php if (isset($_REQUEST['msg'])) { ?>
                                    <div class="load_error alertsmasters"><?= $alert ?></div>
                                    <script >
                                        $(".load_error").delay(2000).fadeOut('slow');
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
<?php include "includes/page_top.php"; ?>
                                                <span id="ratechng" class="load_error alertsmaster" style="color:#F00;float:right;padding-right: 131px;" ></span>   
                                            </div>


                                        </div>

                                    </div><!--cc_new-->
                                    <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                                        <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                                                <span class="filte_new_text">Floor - Section Name</span>
                                                <input type="text" class="form-control filte_new_box" id="floors" name="floors" placeholder="Name" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">

                                            </div>
                                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                                                <span class="filte_new_text">Select Branch</span>
                                                <select  class="add_text_box filte_new_box"  id="branchs" name="branchs" onChange="validateSearch()">
                                                    <option value="null" default>All</option>

<?php
$sql_login = $database->mysqlQuery("select distinct(be_branchname) from tbl_floormaster LEFT JOIN tbl_branchmaster ON tbl_floormaster.fr_branchid=tbl_branchmaster.be_branchid");
$num_login = $database->mysqlNumRows($sql_login);
if ($num_login) {
    while ($result_login = $database->mysqlFetchArray($sql_login)) {
        ?>
                                                            <option value="<?= $result_login['be_branchname'] ?>"><?= $result_login['be_branchname'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>	
                                                </select>
                                            </div>
                                            <!-- <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:12%">
                                                 <input type="text" class="form-control" id="servtxs" name="servtxs" placeholder="Service Tax" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                                             </div>
                                              <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:12%">
                                                 <input type="text" class="form-control" id="vats" name="vats" placeholder="VAT" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                                             </div>
                                              <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:12%">
                                                 <input type="text" class="form-control" id="servchs" name="servchs" placeholder="Service Charge" onKeyPress="validateSearch()" onKeyDown="validateSearch()" onKeyUp="validateSearch()">
                                             </div>-->
                                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%">
                                                <span class="filte_new_text">Select Status</span>
                                                <select  class="add_text_box filte_new_box"  id="statuss" name="statuss" onChange="validateSearch()">
                                                    <option value="null">All</option>
                                                    <option value="Active">Active</option>
                                                    <option value="Non Active">Non-Active</option>
                                                </select>
                                            </div>


                                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
<!--                                                <div style="margin-left:2%; width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" onClick="validateSearch();">Search</a></div>-->
                                                <div style="margin-left:2%;width: 47%;" class="search_btn_member_invoice filte_new_box_btn"><a href="floor_master.php" >Reset</a></div>
                                            </div>
                                        </div><!--form_group-->
                                    </div>
                                    <div class="col-md-12 add_btn_cc_2">
                                        <div class="btn_cc_2">
                                            <a tittle="Add" href="#" id="add_floor" class="md-trigger add_btn_2" data-modal="modal-17" onClick="floorclr()" ></a>
                                        </div>  
                                    </div>
                                    <div class="col-md-12 contant_table_cc">
                                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                                            <thead>
                                                <tr>
                                                    <td>Floor / Section</td>
                                                     <td>Display Order</td>
                                                    <td>Branch</td>
                                                    <td>Qr Order</td>
                                                    <td>Status</td>
                                                  
                                                    <td>Action</td>
                                                </tr>
                                            </thead>
<?php
$sql_login = $database->mysqlQuery("select * from tbl_floormaster LEFT JOIN tbl_branchmaster ON tbl_floormaster.fr_branchid=tbl_branchmaster.be_branchid ");
$num_login = $database->mysqlNumRows($sql_login);
if ($num_login) {
    while ($result_login = $database->mysqlFetchArray($sql_login)) {
        /* if($result_login['fr_status']=="Active")
          {
          $active="Yes";
          }else
          {
          $active="No";
          } */
        
        if($result_login['fr_enable_extra_tax']=="Y")
				{
				
					$extax="Yes";
				}else 
				{
					$extax="No";
				}
                                
                                
                                
                                if($result_login['fr_qr_order']=="Y")
				{
				
					$qr_code="Yes";
				}else 
				{
					$qr_code="No";
				}
        ?>
                                                    <tr id="ids_<?= $result_login['fr_floorid'] ?>"  class="select">
                                                        <td><?= $result_login['fr_floorname'] ?></td>
                                                        <td><?= $result_login['fr_order_display'] ?></td>
                                                        <td><?= $result_login['be_branchname'] ?></td>
                                                        <td><?= $qr_code ?></td>

                                                        <td><?= $result_login['fr_status'] ?></td>
                                                       
                                                        <td>
                                                            <a title="Edit" href="#" class="md-trigger_flr" id="ids_<?= $result_login['fr_floorid'] ?>" ><div class="action_button"> <img src="images/edit_page.PNG"></div></a>
                                                            <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?= $result_login['fr_floorid'] ?>">
                                                      <!--  <a title="Delete" href="#" onClick="delete_confirm('<?= $result_login['fr_floorid'] ?>')"> <div class="action_button"><img src="images/delete-table.png"></div></a>-->
                                                            <a class="flor_copy_btn" style="position:relative" title="Copy" href="#" id="ids_<?= $result_login['fr_floorid'] ?>"><div   class="action_button"><img src="img/copy_ico.png"></div>  </a> 
                                                            
                                                            <a onclick="return floor_popup('<?=$result_login['fr_floorid']?>','<?= $result_login['fr_floorname'] ?>');" class="md-trigger" id="tax_popup_floor" href="#"><div class="action_button"><img width="25px" src="img/tax_icon.png"></div></a>
                                                            
                                                            <div  class="floor_copy florrval<?= $result_login['fr_floorid'] ?>" >
                                                           
                                                            
        <?php /* ?>  <select style="width:70%;float:left;margin:3px 0 0 3px;" class="filte_new_box">
          <option>Floor</option>
          <option>Floor</option>
          </select><?php */ ?>
                                                               
                                                               
                                                               
                                                                <div class="form_textbox_cc"  > 
                                                                    <div class="form-group" id="floorrate_div">
        <?php
        $sql_kot = $database->mysqlQuery("select * from tbl_floormaster where fr_floorid<>'" . $result_login['fr_floorid'] . "'");
        $num_kot = $database->mysqlNumRows($sql_kot);
        if ($num_kot) {
            ?>
                                                                            <select data-placeholder="Enter Floor" id="floorrate<?= $result_login['fr_floorid'] ?>" name="floorrate" data-rel="chosen" title="Floor" left"." data-toggle="tooltip" style="margin:3px 0 0 3px;" class="filte_new_box">
                                                                                    <option value="">--From Floor--</option>

            <?php
            while ($result_kot = $database->mysqlFetchArray($sql_kot)) {
                ?>
                                                                                    <?php /* ?> <option value="<?=$result_kot['fr_floorid']?>" ><?=$result_kot['fr_floorname']?></option><?php */ ?>
                                                                                    <option value="<?= $result_kot['fr_floorid'] ?>" id="<?= $result_kot['fr_floorid'] ?>"><?= $result_kot['fr_floorname'] ?></option>
                                                                                <?php } ?> 

                                                                            </select>
        <?php } ?>
                                                                    </div>
                                                                </div><!--form_textbox_cc-->

                                                                <a href="#"> <span class="ok_btn" id="ids_<?= $result_login['fr_floorid'] ?>" > OK </span> </a>      
                                                            </div><!--floor_copy-->



                                                        </td>
                                                    </tr>
        <?php
    }
}
?>
                                        </table>
                                    </div>
                                </div><!--main_cc-->
                            </div><!--main content-sec-->
                        </div>
                    </div>
                </div>
            </div><!--container-->
        </div>
        
           
           <div class="md-modal md-effect-16" id="modal-17">
            <div class="md-content">
                <h3>ADD NEW</h3>
                <div class="md-close close_staff_pop" onClick="clearall()" tabindex="34"><img src="img/close_ico.png"></div>
                <div>
                    <div class="col-lg-12 col-md-12 no-padding">
                        <form role="form" action="floor_master.php"  method="post"  name="floor_master">
                            <span id="floorchk" class="load_error alertsmaster" style="color:#F00" ></span>   
                            <div class="first_form_contain">
                                <div class="form_name_cc">Floor - Section<span style="color:#F00">*</span></div>
                                <div class="form_textbox_cc" id="floor_div">
                                    <input type="text" class="form-control floorname" id="floor" name="floor"  placeholder="Floor" tabindex="1" autofocus  data-toggle="tooltip" title="Floor Name"  ></div>
                            </div>
                            
                            
                             <div class="first_form_contain">
                                <div class="form_name_cc">Display Order<span style="color:#F00">*</span></div>
                                <div class="form_textbox_cc" id="floor_div">
                                    <input required type="text" maxlength="3" class="form-control floorname" onkeypress="return numonly();" id="floor_order" name="floor_order"  placeholder="Order" tabindex="2"   data-toggle="tooltip" title="Floor Order"  ></div>
                            </div>
                            
                            
                            <div style="display:none" class="first_form_contain">
                                <div class="form_name_cc">Branch<span style="color:#F00">*</span></div>
                                <div class="form_textbox_cc"  > <div class="form-group" id="branch_div">
<?php
$sql_kot = $database->mysqlQuery("select be_branchid,be_branchname from tbl_branchmaster");
$num_kot = $database->mysqlNumRows($sql_kot);
if ($num_kot) {
    ?>
                                            <select data-placeholder="Enter Branch Name" id="branch" name="branch" data-rel="chosen" tabindex="2" title="Branch Name" left"." data-toggle="tooltip" class="form-control add_new_dropdown">
                                                    <option value=""></option>
                                                <optgroup label="BRANCH">
    <?php
    while ($result_kot = $database->mysqlFetchArray($sql_kot)) {
        ?>
                                                        <option value="<?= $result_kot['be_branchid'] ?>"  ><?= $result_kot['be_branchname'] ?></option>
                                                    <?php } ?> 
                                                </optgroup>
                                            </select>
<?php } ?>
                                    </div>
                                </div><!--form_textbox_cc-->
                            </div><!--first_form_contain-->

                            
                            
                            <div class="first_form_contain" style="display:none">
                                <div class="form_name_cc">Enable Extra Tax</div>
                                <div class="form_textbox_cc">
                                	<select class="form-control add_new_dropdown" name="extax" tabindex="3">
                                    	<option value="Yes" >YES</option>
                                        <option value="No">NO</option>
                                    </select>
                                 </div>
                            </div>
<?php  ?>

                              <div class="first_form_contain">
                                <div class="form_name_cc">Qr Code</div>
                                <div class="form_textbox_cc" id="active_div">
                                    <div class="form_textbox_cc">
                                        <select class="form-control add_new_dropdown" tabindex="4" name="qr_code" id="qr_code" onchange="qr_check();">
                                    	
                                        <option value="N">NO</option>
                                        <option value="Y" >YES</option>
                                    </select>
                                    </div>              
                                </div>
                            </div>



                            <div class="first_form_contain">
                                <div class="form_name_cc">Active</div>
                                <div class="form_textbox_cc" id="active_div">
                                    <div class="checkbox">
                                        <label>
                                            <input checked type="checkbox" value="1" tabindex="5" name="active"  id="active" data-toggle="tooltip" title="Active">
                                        </label>
                                    </div>              
                                </div>
                            </div>
                        </form> 
                    </div>
                   

                    
                     <a  href="#" class="entersubmit" onClick="validate_floor()" tabindex="6"><button class="md-save">Save</button></a>
                </div>
            </div>
        </div>
        <div class="md-overlay"></div><!-- the overlay element -->
        
        
        
        
      
        <div id="load_floor_tax_add">
            
            
        </div>
        
        
        
        
        
        
        
        
        
        
        <script src="master_style/js/classie.js"></script>
        <script src="master_style/js/modalEffects.js"></script>
        <!--<script type="text/javascript" src="js/jquery.als-1.4.min.js"></script>-->
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="js/jquery.cookie.js"></script>
        <!--<script type="text/javascript">
                                $(document).ready(function() 
                                {
                                        $("#lista1").als({
                                                visible_items: 8,
                                                scrolling_items: 2,
                                                orientation: "horizontal",
                                                circular: "no",
                                                autoscroll: "no",
                                                interval: 5000,
                                                speed: 500,
                                                easing: "linear",
                                                direction: "left",
                                                start_from: 9
                                        });
                                });
                        </script>-->
        <script type="text/javascript">


            $(".form-control floorname").focus();
$('.entersubmit').ready(function () {
    
        $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        });
        
        function numonly(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

            return false;

        }
        return true;
    }
        
        
        function qr_check(){
            
            $.ajax({
                                type: "POST",
                                url: "load_divcheckmenu.php",
                                data: "value=check_qr&flr=",
                                success: function (msg)
                                {
                                  if($.trim(msg)=='sorry'){
                                 $("#qr_code").val('N');     
                                      $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Qr Order Already Exist .Keep It No');
                        $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
                                  }
                                    
                                }
                            });
            
            
        }
                        function validate_all()
                        {
                            //var a = document.getElementById("floor").value;
                               var a = $("#floor").val().trim();
                            // var b=document.getElementById("floorname").value;
                           // var cb = $("#branch").find('option:selected').attr('id');
                              var cb = $("#branch").val().trim();
                            $.ajax({
                                type: "POST",
                                url: "load_divcheckmenu.php",
                                data: "value=checkfloor&mid=" + a + "&brch=" + cb,
                                success: function (msg)
                                {
                                    msg = $.trim(msg);
                                    //alert(data);
                                    var namechk = $('#floorchk');
                                    if (msg== "sorry")
                                    {
                                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Already Exist');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                       // namechk.text('Already exists');
                                        $("#floor_div").addClass("has-error");
                                        $("#floor").focus();
                                        return false;
                                    } else
                                    {
                                        namechk.text('');
                                        $("#floor_div").removeClass("has-error");
                                        $("#floor_div").addClass("has-success");
                                        document.floor_master.submit();

                                    }
                                }
                            });
                        }
                        
                        
//                      function validate_all()
//                        {
//                            //var a = document.getElementById("floor").value;
//                               var a = $("#floor").val().trim();
//                            // var b=document.getElementById("floorname").value;
//                            //var cb = $("#branch").find('option:selected').attr('id');
//
//                            $.ajax({
//                                type: "POST",
//                                url: "load_divcheckmenu.php",
//                                data: "value=checkfloor&mid=" + a,
//                                success: function (msg)
//                                {
//                                    msg = $.trim(msg);
//                                    //alert(data);
//                                    var namechk = $('#floorchk');
//                                    if (msg== "sorry")
//                                    {
//                                        namechk.text('Already exists');
//                                        $("#floor_div").addClass("has-error");
//                                        $("#floor").focus();
//                                        return false;
//                                    } else
//                                    {
//                                        namechk.text('');
//                                        $("#floor_div").removeClass("has-error");
//                                        $("#floor_div").addClass("has-success");
//                                        document.floor_master.submit();
//
//                                    }
//                                }
//                            });
//                        }      
//                        


                        function floorclr()
                        { 
                            document.getElementById('floor').value = '';
                            document.getElementById('branch').value = '';
                            document.getElementById('servicetx').value = '';
                            document.getElementById('servicechr').value = '';
                            document.getElementById('vat').value = '';
                            $("input[type=checkbox]").each(function () {
                                this.checked = false;
                            });
                            $('#floorchk').text('');
                            $("#floor_div").removeClass("has-error");
                            //   $("#menumaincategory_div").addClass("has-success");
                            $("#branch_div").removeClass("has-error");
                            // $("#country_div").addClass("has-success");
                            $("#servt_div").removeClass("has-error");
                            $("#vat_div").removeClass("has-error");
                            $("#servch_div").removeClass("has-error");
                        }
//                        function valifloor()
//                        {
//                            var a = $("#floor").val().trim();
//                            $.ajax({
//                                type: "POST",
//                                url: "load_divcheckmenu.php",
//                                data: "value=checkfloor&mid=" + a,
//                                success: function (msg)
//                                {
//                                    msg = $.trim(msg);
//                                    var namechk = $('#floorchk');
//                                    if (msg == "sorry")
//                                    {
//                                        namechk.text('Already exists');
//                                        $("#floor_div").addClass("has-error");
//                                        $("#floor").focus();
//                                    } else
//                                    {
//                                        namechk.text('');
//                                        $("#floor_div").removeClass("has-error");
//                                        $("#floor_div").addClass("has-success");
//                                    }
//                                }
//                            });
//                        }




                        function validate_floor()
                        {
                            if (validate_floorname())
                            {
                                
                            if(validate_floor_order()){
                                
                                    if (validate_all())
                                    {
                                        //	document.floor_master.submit();
                                    }
                                
                             }
                            }
                        }
                        
                        
                    function validate_floor_order()
                        {
                            
                        if ($("#floor_order").val() == "")
                            {
                                //$("#floor_div").addClass("has-error");
                                //document.floor_master.floor.focus();
                              //  alert("Enter Floor Name");
                              $("#floor_order").focus();
                              $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Floor Order');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                return false;
                            }   else{
                                  return true;
                            }     
                        
                        }
                        
                        function validate_floorname()
                        {
                        if ($(".floorname").val() == "")
                            {
                                $("#floor_div").addClass("has-error");
                                document.floor_master.floor.focus();
                              //  alert("Enter Floor Name");
                              $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Enter Floor Name');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                                return false;
                            }      
                            
                          var alphanumers = /^[a-zA-Z0-9 ]+$/;
                          if(!alphanumers.test($("#floor").val())){
                       $("#floor_div").addClass("has-error");
                        document.floor_master.floor.focus();
                //  alert("Special charecter Not Allowed.");
                $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('Special Charecter Not Allowed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                   }       
                            
                        else
                            {
                                var a = document.getElementById("floor").value;
                                $("#floor_div").removeClass("has-error");
                                $(this).addClass("has-success");
                                return true;

                            }    
            
                        }
                        
                        
                        function delete_confirm(id)
                        {
                            var check = confirm("Are you sure you want to Delete record?");
                            if (check == true)
                            {
                                window.location = "floor_master.php?id=" + id + "&delete=yes";
                            }
                        }
        </script>
        <script type="text/javascript">
            function validateSearch()
            {
                var floors = $("#floors").val();
                if (floors == "")
                {
                    floors = "null";
                }
                var branch = $("#branchs").val();
                if (branch == "")
                {
                    branch = "null";
                }
                servtxs = "null";
                vats = "null";
                servchs = "null";
                /*var servtxs=$("#servtxs").val();
                 if(servtxs=="")
                 {
                 servtxs="null";
                 }
                 var vats=$("#vats").val();
                 if(vats=="")
                 {
                 vats="null";
                 }
                 var servchs=$("#servchs").val();
                 if(servchs=="")
                 {
                 servchs="null";
                 }*/
                var statuss = $("#statuss").val();
                if (statuss == "")
                {
                    statuss = "null";
                }
               
                $.ajax({
                    type: "POST",
                    url: "load_divmaster.php",
                    data: "value=searchfloor&floorid=" + floors + "&branchid=" + branch + "&statuss=" + statuss,
                    success: function (msg)
                    {
                        $('#listall').html(msg);
                    }
                });
            }
        </script>

        <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
        <script type="text/javascript" id="js">
            $(document).ready(function () {
                $("#listall").tablesorter();
            });
        </script>
        <script type="text/javascript">
            
              $("#floors").focus();

               $("#add_floor").click(function()
               {
                $("#floor").focus();
                
                  dis_order_check();
                
            });   
                

            
            $('.disc_close').click(function () {
                $('.floor_tax').hide();
            });
            

            $(".flor_copy_btn").click(function () {
                var id_str = $(this).attr("id");
                var id_arr = id_str.split("_");
                var selval = id_arr[1];

                $(".floor_copy").removeClass("copy_flor_cc");
                //$(".florrval"+selval).css('display','block');
                $(".florrval" + selval).addClass("copy_flor_cc");
                //$(".flor_copy_btn").show();
            });

            $(".ok_btn").click(function () {
                var id_str = $(this).attr("id");
                var id_arr = id_str.split("_");
                var selval = id_arr[1];
                //	 alert(selval);
                var floorrate = $("#floorrate" + selval).val();
                //alert(floorrate);
                if (floorrate != "")
                {


                    $(".florrval" + selval).removeClass("copy_flor_cc");
                    //$(".florrval"+selval).css('display','none');

                    $.ajax({
                        type: "POST",
                        url: "load_divcheckmenu.php",
                        data: "value=addfloorrate&new_floorid=" + selval + "&floorid=" + floorrate,
                        success: function (msg)
                        {
                            msg = msg.trim();
                            //alert(msg);
                            $('#ratechng').css("display", "block");
                            var ratechng1 = $('#ratechng');
                            ratechng1.text('Rate Changed successfully');
                            $(".load_error").delay(2000).fadeOut('slow');
                        }
                    });
                } else
                {
                    //	alert("select floor");
                    $('#ratechng').css("display", "block");
                    var ratechng = $('#ratechng');
                    ratechng.text('Select Floor');
                    $(".load_error").delay(2000).fadeOut('slow');
                }
            });



function floor_popup(fid,fn){
     
      $('#hidden_floorid').val(fid);
     var data="set_floor_list=floor_list&floor_id="+fid+"&floor_name="+fn;
     
        $.ajax({
        type: "POST",
        url: "load_floor_tax_add.php",
        data: data,
        success: function(data)
        {
            
            $('#load_floor_tax_add').html(data);    
        }
    }); 
      
      
}


function dis_order_check()
{
     
     $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=flr_order_dis",
			success: function(msg)
			{
                            
                            //alert(msg);
                          $('#floor_order').val(parseInt($.trim(msg))+1);
                          
                        }
                        });
    
    
}


        </script>	
        <div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
        <style>
			.discount_popup{height: 330px;}
			.tab_table_cont_cc {  height: 26vh;min-height: 200px;}
		</style>
    </body>
</html>