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
    .filte_new_box{height: 29px !important;}.search_btn_member_invoice a{line-height: 29px;}.table_report td strong{font-size: 16px}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.ui-autocomplete{z-index:999999 !important;max-height: 400px;    height: auto; overflow: scroll;}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
<link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<style>
    .back_combo_mn_btn{width: 50px; height: 49px; line-height: 49px; float: left; padding-left: 11px;}
    .tabs li a { float: left; display: block;  padding: 10px; color: #fff;
    font-family: 'yu_gothicregular' !important;     background-color: rgba(0, 0, 0, 0.8);
    width: 32.5%; border-raduis: 5px; margin: 0 1px 0 1px; text-decoration: none;  text-align: center;
    font-size: 14px;
}
.tabs li.current a {
    background-color: rgb(163, 68, 0);
}
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
    }
    .contant_table_cc{height: 71vh;}
    .tablesorter tbody{min-height: 401px; height: 63vh;overflow: auto;  overflow-x: hidden !important;}
    .table_report td strong {  font-size: 14px;}
    .first_form_contain{padding: 8px;background-color: #ececec}
    .table_report thead td {border: solid 1px #656565;font-size: 13px;height: 24px;}
    .md-modal .tablesorter tbody { min-height: 277px; height: 41vh;}
    .md-trigger_prfrnc{opacity: 0.7;}
    .md-trigger_prfrnc img{width: 18px}.md-trigger_rate img{width: 23px}
    .tbl_del_combo i{font-size: 17px}
    .icontick{top: 0px}
</style>

</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php";
  include "includes/left_menu.php";
    $combo_name="";
    $combo_type="";
    $combo_status="";
    $combo_id='';
    $combo_pack_name='';
    $combo_pack_delete_id='';
    $combo_menuid='';
    $combo_pack_id='';
    $menu_sale_type='';
    $menu_option_label='';
    $menu_option_label_id='';
    $menu_combo_qty='';
    $combo_menu_delete_id='';
    $combo_pack_menu_entry_id='';
    $status_to='';
    $floor_id='';
    $department='';
    $combo_rate='';
    $combo_pack_rate_id='';
    $apply_all='';
    $mode_array=array('DI','TA','CS');
    if(isset($_REQUEST['set']) && $_REQUEST['set']=='combodetails'){
        $combo_name=$_REQUEST['combo_name'];
        $combo_type=$_REQUEST['combo_type'];
        $combo_id=$_REQUEST['combo_id'];
  }
  
    else if(isset($_REQUEST['set']) && $_REQUEST['set']=='combo_pack_add'){
        $combo_pack_name=$_REQUEST['combo_pack_name'];
        $combo_pack_qty=$_REQUEST['combo_pack_qty'];
        $combo_id=$_REQUEST['combo_id'];
        $combo_pack_edit_id=$_REQUEST['combo_pack_edit_id'];
        if($combo_pack_edit_id==''){
            $sql_combo_pack_duplicate_check =  $database->mysqlQuery("select * from tbl_combo_packs where cp_pack_name='".$combo_pack_name."' and cp_combo='".$combo_id."' and cp_pack_qty='".$combo_pack_qty."' "); 
            //echo "select * from tbl_combo_name where cn_name='".$_REQUEST['combo_name']."'";
            $num_combo_pack_duplicate_check  = $database->mysqlNumRows($sql_combo_pack_duplicate_check);
            if($num_combo_pack_duplicate_check){
                echo "@@@Pack Already Exist...@@@";
            }
            else{
                $sql_combo_pack_add =  $database->mysqlQuery("INSERT INTO `tbl_combo_packs`(`cp_pack_name`, `cp_combo`, `cp_pack_qty`) VALUES ('".$combo_pack_name."','".$combo_id."','".$combo_pack_qty."')");
                $sql_combo_pack_last_added =  $database->mysqlQuery("select max(cp_id) as cp_id from tbl_combo_packs "); 
                //echo "select * from tbl_combo_name where cn_name='".$_REQUEST['combo_name']."'";
                $num_combo_pack_last_added  = $database->mysqlNumRows($sql_combo_pack_last_added);
                $result_combo_pack_last_added=$database->mysqlFetchArray($sql_combo_pack_last_added);
                $sql_combo_pack_stock =  $database->mysqlQuery("Insert into tbl_combo_stock (cs_pack_id,cs_combo_id,cs_stock_date,cs_last_updated) values('".$result_combo_pack_last_added['cp_id']."','".$combo_id."','".$_SESSION['date']."',NOW())");
                echo "@@@Pack Successfully Added...@@@";

            }
        }
        else{
           $sql_combo_pack_update =  $database->mysqlQuery(" UPDATE `tbl_combo_packs` set `cp_pack_name`='".$combo_pack_name."',`cp_pack_qty`='".$combo_pack_qty."' where `cp_id`='".$combo_pack_edit_id."' ") ;
        
           echo "@@@Pack Successfully Updated...@@@";
        }
  }
  
    else if(isset($_REQUEST['set']) && $_REQUEST['set']=='combo_pack_delete'){
        $combo_pack_delete_id=$_REQUEST['combo_pack_delete_id'];
        //$combo_id=$_REQUEST['combo_id'];
        $sql_pack_menu_delete =  $database->mysqlQuery("DELETE FROM `tbl_combo_pack_menus` WHERE `cpm_combo_pack_id`='".$combo_pack_delete_id."' ");
        $sql_pack_rate_delete =  $database->mysqlQuery("DELETE FROM `tbl_combo_pack_rates` WHERE `cpr_combo_pack_id`='".$combo_pack_delete_id."' ");
        $sql_pack_stock_delete = $database->mysqlQuery("DELETE FROM `tbl_combo_stock` WHERE `cs_pack_id`='".$combo_pack_delete_id."'");
        $sql_combo_pack_delete = $database->mysqlQuery("DELETE FROM `tbl_combo_packs` WHERE `cp_id`='".$combo_pack_delete_id."'");
    }
    
    else if(isset($_REQUEST['set']) && $_REQUEST['set']=='combo_pack_status_change'){
     $combo_pack_edit_id=$_REQUEST['combo_pack_edit_id'];
     $status_to=$_REQUEST['status_to'];
     $sql_combo_pack_update =  $database->mysqlQuery(" UPDATE `tbl_combo_packs` set `cp_pack_active`='".$status_to."' where `cp_id`='".$combo_pack_edit_id."' ") ;
        
        echo "@@@Pack Status Successfully Cahnged...@@@";
 }
 
    else if(isset($_REQUEST['set']) && $_REQUEST['set']=='combo_pack_menu_add'){
      
        $combo_menuid=$_REQUEST['combo_menuid'];
        $combo_id=$_REQUEST['combo_id'];
        $combo_pack_id=$_REQUEST['combo_pack_id'];
        $menu_sale_type=$_REQUEST['menu_sale_type'];
        $menu_option_label=$_REQUEST['menu_option_label'];
        $menu_combo_qty=$_REQUEST['menu_combo_qty'];
        $combo_pack_menu_entry_id=$_REQUEST['combo_pack_menu_entry_id'];
        
            if($menu_option_label==''){
                $menu_option_label=0;
            }
            if($menu_combo_qty==''){
               $menu_combo_qty=0; 
            }
            if($menu_sale_type==''){
                $menu_sale_type=NULL;
            }
        if($combo_pack_menu_entry_id==''){
            $sql_combo_menu_duplicate_check =  $database->mysqlQuery(" select * from `tbl_combo_pack_menus` where `cpm_menu_id`='".$combo_menuid."' and `cpm_combo_pack_id`='".$combo_pack_id."' and `cpm_combo_id`='".$combo_id."'  ");
            $num_combo_menu_duplicate_check  = $database->mysqlNumRows($sql_combo_menu_duplicate_check);
            if($num_combo_menu_duplicate_check){
                echo "@@@Menu Already Added...@@@";
            }
            else{
            $sql_combo_menu_add =  $database->mysqlQuery(" INSERT INTO `tbl_combo_pack_menus`(`cpm_menu_id`, `cpm_combo_pack_id`, `cpm_combo_id`, `cpm_menu_sale_type`, `cpm_menu_type_label_id`, `cpm_menu_qty`)
                     VALUES ('".$combo_menuid."','".$combo_pack_id."','".$combo_id."','".$menu_sale_type."','".$menu_option_label."','".$menu_combo_qty."') ");

    //        echo "INSERT INTO `tbl_combo_pack_menus`(`cpm_menu_id`, `cpm_combo_pack_id`, `cpm_combo_id`, `cpm_menu_sale_type`, `cpm_menu_type_label_id`, `cpm_menu_qty`)
    //                 VALUES ('".$combo_menuid."','".$combo_id."','".$combo_pack_id."','".$menu_sale_type."','".$menu_option_label."','".$menu_combo_qty."')";
    //  
    //        exit();
            echo "@@@Menu Successfully Added...@@@";
        
            }
        }
        else{
          $sql_combo_menu_update =  $database->mysqlQuery(" UPDATE `tbl_combo_pack_menus` SET `cpm_menu_id`='".$combo_menuid."',`cpm_menu_sale_type`='".$menu_sale_type."',`cpm_menu_type_label_id`='".$menu_option_label."',`cpm_menu_qty`='".$menu_combo_qty."'  WHERE `cpm_id`='".$combo_pack_menu_entry_id."'") ;  
          //echo "UPDATE `tbl_combo_pack_menus` SET `cpm_menu_id`='".$combo_menuid."',`cpm_menu_sale_type`='".$menu_sale_type."',`cpm_menu_type_label_id`='".$menu_option_label."',`cpm_menu_qty`='".$menu_combo_qty."'  WHERE `cpm_id`='".$combo_pack_menu_entry_id."'";
          echo "@@@Menu Successfully Updated...@@@";
        }
  }  
  
    else if(isset($_REQUEST['set']) && $_REQUEST['set']=='menu_label_add'){
        $menu_option_label=$_REQUEST['menu_label'];
        $sql_label_add =  $database->mysqlQuery("INSERT INTO `tbl_combo_menu_labels`(cml_label) VALUES ('".$menu_option_label."')");
        echo "@@@Label Successfully Added...@@@";    
    }
    
    else if(isset($_REQUEST['set']) && $_REQUEST['set']=='menu_label_delete'){
      $menu_option_label_id=$_REQUEST['label_id'];
      $sql_label_delete =  $database->mysqlQuery("DELETE FROM `tbl_combo_menu_labels` WHERE `cml_id`='".$menu_option_label_id."'");
      echo "@@@Label Successfully Deleted...@@@";    
    }
    
    else if(isset($_REQUEST['set']) && $_REQUEST['set']=='combo_menu_delete'){
      $combo_menu_delete_id=$_REQUEST['combo_menu_delete_id'];
      $sql_menu_delete =  $database->mysqlQuery("DELETE FROM `tbl_combo_pack_menus` WHERE `cpm_id`='".$combo_menu_delete_id."'");
      echo "@@@Menu Successfully Deleted...@@@";    
    }
    
    else if(isset($_REQUEST['set']) && $_REQUEST['set']=='combo_menu_status_change'){
        $combo_pack_menu_entry_id=$_REQUEST['combo_pack_menu_entry_id'];
        $status_to=$_REQUEST['status_to'];
        $sql_menu_status_change =  $database->mysqlQuery("UPDATE `tbl_combo_pack_menus` SET cpm_menu_active='".$status_to."'  WHERE `cpm_id`='".$combo_pack_menu_entry_id."'");
        echo "@@@Menu Satus Successfully Changed...@@@";    
    }
    
    else if(isset($_REQUEST['set']) && $_REQUEST['set']=='combo_rate_add'){
        $combo_pack_id=$_REQUEST['combo_pack_id'];
        $combo_pack_rate_id=$_REQUEST['combo_pack_rate_id'];
        $floor_id=$_REQUEST['floor_id'];
        $combo_id=$_REQUEST['combo_id'];
        $department=$_REQUEST['department'];
        $combo_rate=$_REQUEST['combo_rate'];
        $apply_all=$_REQUEST['apply_all'];
        
        $online=$_REQUEST['online'];
        
        if($combo_pack_rate_id==''){
            if($apply_all=='false'){
                    if($department=='DI'){
                        $sql_combo_rate_duplicate_check =  $database->mysqlQuery(" SELECT * FROM `tbl_combo_pack_rates` WHERE `cpr_combo_pack_id`='".$combo_pack_id."' and `cpr_combo_id`='".$combo_id."' and `cpr_floor_id`='".$floor_id."' and `cpr_mode`='".$department."' "); 
                        //echo "SELECT * FROM `tbl_combo_pack_rates` WHERE `cpr_combo_pack_id`='".$combo_pack_id."' and `cpr_combo_id`='".$combo_id."' and `cpr_floor_id`='".$floor_id."' and `cpr_mode`='".$department."'";
                        $num_combo_rate_duplicate_check  = $database->mysqlNumRows($sql_combo_rate_duplicate_check);
                        if($num_combo_rate_duplicate_check){
                        echo "@@@Pack  Rate Already Added...@@@";
                        }
                        else{
                            $sql_combo_pack_rate_add =  $database->mysqlQuery("INSERT INTO `tbl_combo_pack_rates`(`cpr_combo_pack_id`,`cpr_combo_id`, `cpr_floor_id`, `cpr_mode`, `cpr_rate`)
                                                                 VALUES ('".$combo_pack_id."','".$combo_id."','".$floor_id."','".$department."','".$combo_rate."')");
                            echo "@@@Pack Rate Successfully Added...@@@";
                        }
                    }else if($department=='TA'){
                        $sql_combo_rate_duplicate_check =  $database->mysqlQuery(" SELECT * FROM `tbl_combo_pack_rates` WHERE `cpr_combo_pack_id`='".$combo_pack_id."' and `cpr_combo_id`='".$combo_id."' and `cpr_online_id`='".$online."' and `cpr_mode`='".$department."' "); 
                        //echo "SELECT * FROM `tbl_combo_pack_rates` WHERE `cpr_combo_pack_id`='".$combo_pack_id."' and `cpr_combo_id`='".$combo_id."' and `cpr_floor_id`='".$floor_id."' and `cpr_mode`='".$department."'";
                        $num_combo_rate_duplicate_check  = $database->mysqlNumRows($sql_combo_rate_duplicate_check);
                        if($num_combo_rate_duplicate_check){
                        echo "@@@Pack  Rate Already Added...@@@";
                        }
                        else{
                            $sql_combo_pack_rate_add =  $database->mysqlQuery("INSERT INTO `tbl_combo_pack_rates`(`cpr_combo_pack_id`,`cpr_combo_id`, `cpr_online_id`, `cpr_mode`, `cpr_rate`)
                                                                 VALUES ('".$combo_pack_id."','".$combo_id."','".$online."','".$department."','".$combo_rate."')");
                            echo "@@@Pack Rate Successfully Added...@@@";
                            
                            
                            
                        }
                    }else{
                        $sql_combo_rate_duplicate_check =  $database->mysqlQuery(" SELECT * FROM `tbl_combo_pack_rates` WHERE `cpr_combo_pack_id`='".$combo_pack_id."' and `cpr_combo_id`='".$combo_id."'  and `cpr_mode`='".$department."' "); 
                        //echo "SELECT * FROM `tbl_combo_pack_rates` WHERE `cpr_combo_pack_id`='".$combo_pack_id."' and `cpr_combo_id`='".$combo_id."' and `cpr_floor_id`='".$floor_id."' and `cpr_mode`='".$department."'";
                        $num_combo_rate_duplicate_check  = $database->mysqlNumRows($sql_combo_rate_duplicate_check);
                        if($num_combo_rate_duplicate_check){
                            echo "@@@Pack  Rate Already Added...@@@";
                            exit();
                        }
                        else{
                            $sql_combo_pack_rate_add =  $database->mysqlQuery("INSERT INTO `tbl_combo_pack_rates`(`cpr_combo_pack_id`,`cpr_combo_id`, `cpr_mode`, `cpr_rate`)
                                                                                VALUES ('".$combo_pack_id."','".$combo_id."','".$department."','".$combo_rate."')");
                        
                             echo "@@@Pack Rate Successfully Added...@@@";
                        }
                    }
            } 
            else if($apply_all=='true'){
                for($i=0;$i<count($mode_array);$i++){
                    if($mode_array[$i]=='DI'){
                        $sql_floors =  $database->mysqlQuery("SELECT `fr_floorid`,`fr_floorname` FROM `tbl_floormaster` WHERE `fr_status`='Active' order by fr_floorid asc "); 
                        $num_floors  = $database->mysqlNumRows($sql_floors);
                        if($num_floors){//$i=0;
                            while($result_floors=$database->mysqlFetchArray($sql_floors)){
                                $floor_id=$result_floors['fr_floorid'];
                                $sql_combo_pack_rate_add =  $database->mysqlQuery("INSERT INTO `tbl_combo_pack_rates`(`cpr_combo_pack_id`,`cpr_combo_id`, `cpr_floor_id`, `cpr_mode`, `cpr_rate`)
                                                                 VALUES ('".$combo_pack_id."','".$combo_id."','".$floor_id."','".$mode_array[$i]."','".$combo_rate."')");
                            }
                       }
                    }else if($mode_array[$i]=='TA'){ 
                       
                        $sql_floors2 =  $database->mysqlQuery("SELECT `tol_id`,`tol_name` FROM `tbl_online_order` WHERE `tol_status`='Y' order by tol_id asc "); 
                        $num_floors2  = $database->mysqlNumRows($sql_floors2);
                        if($num_floors2){//$i=0;
                            while($result_floors2=$database->mysqlFetchArray($sql_floors2)){
                                $online_id=$result_floors2['tol_id'];
                                $sql_combo_pack_rate_add =  $database->mysqlQuery("INSERT INTO `tbl_combo_pack_rates`(`cpr_combo_pack_id`,`cpr_combo_id`, `cpr_online_id`, `cpr_mode`, `cpr_rate`)
                                                                 VALUES ('".$combo_pack_id."','".$combo_id."','".$online_id."','".$mode_array[$i]."','".$combo_rate."')");
                            
                              
                                
                            }
                       }
                    }
                    else{
                       $sql_combo_pack_rate_add =  $database->mysqlQuery("INSERT INTO `tbl_combo_pack_rates`(`cpr_combo_pack_id`,`cpr_combo_id`, `cpr_mode`, `cpr_rate`)
                                                                 VALUES ('".$combo_pack_id."','".$combo_id."','".$mode_array[$i]."','".$combo_rate."')"); 
                    }
                } 
                echo "@@@Pack Rate Aplied To All...@@@";
            }
        }
        else{
           $sql_combo_pack_update =  $database->mysqlQuery(" UPDATE `tbl_combo_pack_rates` SET `cpr_rate`='".$combo_rate."' WHERE `cpr_id`='".$combo_pack_rate_id."' ") ;
            echo "@@@Pack Rate Successfully Updated...@@@";
        }
  }
  
    else if(isset($_REQUEST['set']) && $_REQUEST['set']=='combo_pack_rate_delete'){
        $combo_pack_rate_id=$_REQUEST['combo_pack_rate_id'];
        //$combo_id=$_REQUEST['combo_id'];
        $sql_pack_rate_delete =  $database->mysqlQuery("DELETE FROM `tbl_combo_pack_rates` WHERE `cpr_id`='".$combo_pack_rate_id."' ");
        echo "@@@Pack Rate Successfully Deleted...@@@";
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
                   
              <div class="col-sm-12 main_combo-head-add" id="combo_name_pack_add" ><?=$combo_name?></div>    
                   
                   <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                        
                             <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                                 <input type="hidden" class="form-control filte_new_box" id="combo_id_field" value="<?=$combo_id?>">
                                 <input type="hidden" class="form-control filte_new_box" id="combo_pack_id_field" >
                                 <a href="combo.php"><div class="back_combo_mn_btn"><img src="images/thin_left_arrow_333.png"> </div></a>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:20%">
                           		<span class="filte_new_text">Combo Pack</span>
                                <input type="text" class="form-control filte_new_box" placeholder="Combo Pack" id="combo_pack">
                            </div>
                             <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%;display:none" id="combo_qty_div">
                           		<span class="filte_new_text">Qty</span>
                                <input type="text" class="form-control filte_new_box" placeholder="Qty" id="combo_qty">
                            </div>
                              
                            <div class="col-sm-2 nopadding" style="width: 8% !important;">
                                <div style="margin-left:2%;width: 100%;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" style="cursor: pointer" id="combo_pack_add" >ADD</a></div>
                            </div>
                             <div class="col-sm-2 nopadding" style="width: auto !important;float:right">
                              <span class="alert_in_combo" id="combo_pack_alert_span" style="color:#f00;display:none"></span>
                          </div>     
                          
                        </div><!--form_group-->
                    	
                    </div>
                   
                   
                   <!--<div class="col-md-12 add_btn_cc_2">
                      <div class="btn_cc_2">
                   		<a tittle="Add" href="#" class="md-trigger add_btn_2" data-modal="modal-17" onClick="testpref()" ></a>
                      </div>  
                   </div>-->
                           
                   <div class="col-md-6 contant_table_cc" style="width:36.8%;">
                       <div class="combo_pack_bx_head">Combo Pack</div>
                        <table class="table_report scroll tablesorter combo_pack_table" width="100%" border="0" cellspacing="5" id="">
                            <thead>
                                <tr>
                                    <td width="10%">#</td>
                                    <td>Name</td>
                                    <td width="10%" class="pack_qty_display_head">Qty</td>
                                    <td width="10%" class="pack_status_display_head">Active</td>
                                    <td width="30%">Action</td>
                                </tr>
                            </thead>
                             <tbody>
                        <?php 
                        $sql_combo_packs =  $database->mysqlQuery("select * from tbl_combo_packs where cp_combo='".$combo_id."' order by cp_id asc "); 
                        //echo "select * from tbl_combo_name where cn_name='".$_REQUEST['combo_name']."'";
                        $num_combo_packs  = $database->mysqlNumRows($sql_combo_packs);
                        if($num_combo_packs){$i=0;
                            while($result_combo_packs=$database->mysqlFetchArray($sql_combo_packs)){
                                $i++;
                                ?>
                                                         
                             <tr class="pack_rows" id='<?=$result_combo_packs['cp_id']?>'>
                                 <input type="hidden" class='combopack_row_id' id1='<?=$result_combo_packs['cp_id']?>' id="combopack<?=$result_combo_packs['cp_id']?>">
                                <td width="10%"><?=$i?></td>
                                <td ><strong class='combo_pack_name_display' id="combo_pack_name_display<?=$result_combo_packs['cp_id']?>"><?=$result_combo_packs['cp_pack_name']?></strong></td>
                                  <td width="10%" id="pack_qty_display<?=$result_combo_packs['cp_id']?>" class="pack_qty_display"><?=$result_combo_packs['cp_pack_qty']?></td>
                                  <td width="10%" id="pack_status_display<?=$result_combo_packs['cp_id']?>" class="pack_status_display"><?php if($result_combo_packs['cp_pack_active']=='Y'){ echo 'YES';}else { echo 'NO';}?></td>
                                 <td width="30%"><a href='#' class="md-trigger_prfrnc combo_pack_edit_btn" id="<?=$result_combo_packs['cp_id']?>" ><img src="images/edit_page.PNG"></a>
                                 <a href class="tbl_del_combo combo_pack_delete_btn" id="<?=$result_combo_packs['cp_id']?>"  ><i class="glyphicon glyphicon-trash"></i></a>
                                 <a class="md-trigger_rate combo_pack_rate_add" combo_pack_id="<?=$result_combo_packs['cp_id']?>" combo_pack_name="<?=$result_combo_packs['cp_pack_name']?>"><img src="img/rate.png"></a>
                                <?php if($result_combo_packs['cp_pack_active']=='Y'){ ?>
                                     <a class="tab_edt_btn combo_pack_status_change" status_to="N" id1="<?=$result_combo_packs['cp_id']?>" href ><i class="icontick"><img src="img/red_cross.png" width="23px" height="23px"></i></a>
                                     <?php } if($result_combo_packs['cp_pack_active']=='N'){ ?>
                                     <a class="tab_edt_btn combo_pack_status_change" status_to="Y" id1="<?=$result_combo_packs['cp_id']?>" href ><i class="icontick"><img src="img/green_tick.png" width="23px" height="23px"></i></a>
                                     <?php }?>
                                 </td>
                              </tr>
                            <?php 
                            
                                }
                            }
                        ?>
                            
                            </tbody>
                       </table>
                   </div>
                           
                   <div class="col-md-6 contant_table_cc" style="width:62.8%;float:right">
                        <div class="combo_pack_bx_head" id='pack_item_head'></div>
                        <div class="combo-right-menu-add">
                            <input type="hidden" name="combo_pack_menu_entry_id" id="combo_pack_menu_entry_id"  />
                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:35%">
                           		<span class="filte_new_text">Menu Name</span>
                                <input type="text" class="form-control filte_new_box" placeholder="Menu Name" id="search_menu_combo">
                                <input type="hidden" name="valueofsearch_menu" id="valueofsearch_menu"  />
<!--                                <input type="hidden" name="valueofsearch_portion" id="valueofsearch_portion"  />-->
<!--                                <input type="hidden" name="valueofsearch_qty" id="valueofsearch_qty"  />-->
                            </div>
                            <div class="col-sm-2" id="optional_menu_type_div" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:20%;display:none">
                           		<span class="filte_new_text">Select</span>
                                <select class="form-control filte_new_box" id="menu_sale_type">
                                    <option value=''>Select Type</option>
                                    <option value='Fixed'>Fixed</option>
                                    <option value='Option'>Option</option>
                               </select>
                            </div>
                            
                            <div class="col-sm-2" id="menu_option_selection_div" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:25%;display:none">
                           		<span  class="filte_new_text">Option</span>
                                <select style="width:76%" class="form-control filte_new_box" id="menu_option_label">
                                    <option value=''>Select option Label</option>
                                    <?php
                                    $sql_combo_menu_labels =  $database->mysqlQuery("select * from tbl_combo_menu_labels where cml_active='Y' order by cml_id asc "); 
                                    //echo "select * from tbl_combo_name where cn_name='".$_REQUEST['combo_name']."'";
                                    $num_combo_menu_labels  = $database->mysqlNumRows($sql_combo_menu_labels);
                                    if($num_combo_menu_labels){$i=0;
                                        while($result_combo_menu_labels=$database->mysqlFetchArray($sql_combo_menu_labels)){
                                        ?>
                                            <option value="<?=$result_combo_menu_labels['cml_id']?>"><?=$result_combo_menu_labels['cml_label']?></option>
                                        <?php
                                        }
                                    }
                                    ?>
                               </select>
                                <div style="margin-left:0;width: 22%;margin-top:0;" class="search_btn_member_invoice filte_new_box_btn"><a style="background-color: #d26405;margin-top: 0;border-radius: 0;" href="#"  class="md-trigger" id="label_add_popup_call">+</a></div>
                            </div>
                            
                            
                            <div class="col-sm-2" id="menu_qty_div" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:10%;display:none">
                           		<span class="filte_new_text">Qty</span>
                                <input type="text" class="form-control filte_new_box" placeholder="Qty" id="combo_pack_menuqty">
                            </div>
                            <div class="col-sm-2 nopadding" style="width: 10% !important;">
                                <div style="margin-left:2%;width: 100%;" class="search_btn_member_invoice filte_new_box_btn"><a href='#' id="compo_pack_menu_add"> ADD</a></div>
                            </div>
                        </div>
                       <div class="combo-right-menu-added_list">
                           <table class="table_report scroll tablesorter" width="100%" border="0" cellspacing="5" id="">
                               <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Menu</td>
                                    <?php if($combo_type==3){
                                    ?>
                                    <td class="combo_menu_type_head">Type</td>
                                    <td class="combo_menu_label_head">Option</td>
                                    <?php } if($combo_type==2 || $combo_type==3){
                                    ?>
                                    <td class="combo_menu_qty_head">Qty</td>
                                    <?php } ?>
                                    <td >Active</td>
                                    <td >Action</td>
                                </tr>
                            </thead>
                             <tbody class="combo_menu_load_table">
                             
                                    
                            
                            
                            </tbody>
                       </table>
                       </div>       
                   </div>
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>
 <div style="width:750px;" class="md-modal md-effect-16 label_add_popup" id="modal-17">
			<div class="md-content">
				<h3 style="padding: 9px;font-size: 19px;">Add Option</h3>
				<div style="padding:0">
                    <div class="col-sm-12 no-padding">
                        
                        <form role="form">
                        	 <div class="first_form_contain">
                                 <div class="col-sm-6 no-padding">
                                <span class="load_error alertsmaster" style="color:#F00" ></span> 
                             	<div class="form_name_cc">Option Name<span style="color:#F00">*</span></div>
                               	 <div class="form_textbox_cc" id="preference_div">
                                     <input type="text" class="form-control"  placeholder="Option Name" id="menu_label_add_feild" >
                                 </div>
                                 </div>
                                     <div class="col-sm-2 nopadding" style="width: auto !important;float:right">
                                    <span class="alert_in_combo" id="label_alert_span" style="color:#f00;padding: 5px;;display:none"></span>
                                </div> 
                                 <span class="col-sm-1 nopadding" style="  margin:0px 0 -6px 0;display: inline-block;float: left;">
                                    <span class="search_btn_member_invoice" style="margin-left:0"><a href="#" style="display:block;" id="menu_label_add_btn">ADD</a></span>
                                 </span> 
                               </div>
                                  </form> 
                        
                        <div class="pop_table_lsit_sec">
                            <table class="table_report scroll tablesorter" width="100%" border="0" cellspacing="5" id="">
                                <thead>
                                <tr>
                                    <td width="5%">#</td>
                                    <td>Option</td>
                                    <td width="12%">Delete</td>
                                </tr>
                            </thead>
                             <tbody id="label_table_data">
                                 <?php
                                    $sql_menu_labels_display =  $database->mysqlQuery("select * from tbl_combo_menu_labels order by cml_id asc "); 
                                    //echo "select * from tbl_combo_name where cn_name='".$_REQUEST['combo_name']."'";
                                    $num_menu_labels_display  = $database->mysqlNumRows($sql_menu_labels_display);
                                    if($num_menu_labels_display){$i=0;
                                        while($result_menu_labels_display=$database->mysqlFetchArray($sql_menu_labels_display)){
                                            $i++;
                                            ?>
                                <tr id="" class="">
                                    <td width="5%"><?=$i?></td>
                                    <td><?=$result_menu_labels_display['cml_label']?></td>
                                    <td width="13%">
                                    <a class="tbl_del_combo" onclick="return label_delete(<?=$result_menu_labels_display['cml_id']?>)" id="<?=$result_menu_labels_display['cml_id']?>" href="#"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                                    <?php
                                    }}
                                    ?>
                            </tbody>
                            </table>
                        </div>
                        
                    </div>
                            
                        <div class="pop_footer_btn_sec">
<!--                            <a  href="#" class=""><button class="md-save">Save</button></a>-->
                            <a href="#"><button id="label_add_popup_close" class="md-close" tabindex="3">Close</button></a>
                         </div>
				</div>
                </div>
		</div>
<div  class="md-overlay"></div><!-- the overlay element -->

<div style="top:0;display:none" class="new_overlay"></div>


<div class="md-content" id="combo_rate_popup" style="position:fixed;width:600px;left:30%;top:5%;z-index:99999;display:none">
  
   <div class="dfineheading"> <strong id="combo_name_rate_add">Combo Rate</strong>  - <span style="font-size: 14px;padding-left:1%;" class="comb_pack_name_display"> Mix 159</span></div>
   <input type="hidden" id="comb_pack_id_display">
   <input type="hidden" id="comb_pack_rate_id_display">
   <a href="#" ><button class="md-close_pop" id="rate_popup_close">x</button></a>
   <span id="tabwrap">
      <ul style="margin:0px;" class="tabs departments_selection">
         <li class="current" id1="DI"><a href="#" onclick="return departmentselect('DI')">Dine In</a></li>
         <li class="" id1="TA"><a href="#" onclick="return departmentselect('TA')">Take Away</a></li>
         <li class="" id1="CS"><a href="#" onclick="return departmentselect('CS')">Counter Sale</a></li>
      </ul>
      <span class="tab_content">
        
      </span>
      <!--about-->
   </span>
</div>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>

<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/combo_add.js"></script>
</body>
</html>