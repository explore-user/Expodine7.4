<?php
//include('includes/session.php');	// Check session
session_start();

include("database.class.php"); // DB Connection class
$database	= new Database();
$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);

$_SESSION['pagid']=21;

if(isset($_REQUEST['stockupdate'])){
    $sq=mysqli_query($con,"CALL proc_dailymenustock");
}




if(isset($_REQUEST['stock_add_menuid']))
{
    $stockmenuid=$_REQUEST['stock_add_menuid'];
    $stockstatus=$_REQUEST['stockstatus'];
    $stockvalue=$_REQUEST['stockvalue'];
    $portion=$_REQUEST['portion'];
    $unittype=$_REQUEST['unittype'];
    $unitid=$_REQUEST['unitid'];
    $baseunitid=$_REQUEST['baseunitid'];
    $unitweight=$_REQUEST['unitweight'];
    if($portion==''){
      $portion='IS NULL';  
    }
    else{
       $portion='="'.$portion.'"'; 
    }
    if($unittype==''){
      $unittype='IS NULL';  
    }
    else{
       $unittype='="'.$unittype.'"'; 
    }
    if($unitid==''){
      $unitid='IS NULL';  
    }
    else{
       $unitid='="'.$unitid.'"'; 
    }

    
    if($baseunitid==''){
      $baseunitid='IS NULL';  
    }
    else{
       $baseunitid='="'.$baseunitid.'"'; 
    }
    if($stockvalue==''){
        $stockvalue=0;
    }
    
    if($_REQUEST['stockvalue_open']!=''){
        $open=$_REQUEST['stockvalue_open'];
    }else{
        $open=0;
    }
    
   if($_REQUEST['stock_add']!=''){
       
       $stockvalue_add=$_REQUEST['stock_add'];
       
   }else{
       $stockvalue_add=0;
   }
    
    
    
    
    $sql_menus  =  $database->mysqlQuery("Update tbl_menustock set mk_added_stock_total=(mk_added_stock_total+'".$stockvalue_add."'),mk_stock_number=(mk_stock_number+'".$stockvalue_add."') where mk_menuid='".$stockmenuid."' and mk_portion $portion and mk_unit_type $unittype and mk_unit_id $unitid and mk_base_unit_id $baseunitid and mk_unit_weight='".$unitweight."'  "); 
    
}

if(isset($_REQUEST['stockmenuid']))
{
    $stockmenuid=$_REQUEST['stockmenuid'];
    $stockstatus=$_REQUEST['stockstatus'];
    $stockvalue=$_REQUEST['stockvalue'];
    $portion=$_REQUEST['portion'];
    $unittype=$_REQUEST['unittype'];
    $unitid=$_REQUEST['unitid'];
    $baseunitid=$_REQUEST['baseunitid'];
    $unitweight=$_REQUEST['unitweight'];
    if($portion==''){
      $portion='IS NULL';  
    }
    else{
       $portion='="'.$portion.'"'; 
    }
    if($unittype==''){
      $unittype='IS NULL';  
    }
    else{
       $unittype='="'.$unittype.'"'; 
    }
    if($unitid==''){
      $unitid='IS NULL';  
    }
    else{
       $unitid='="'.$unitid.'"'; 
    }

    
    if($baseunitid==''){
      $baseunitid='IS NULL';  
    }
    else{
       $baseunitid='="'.$baseunitid.'"'; 
    }
    if($stockvalue==''){
        $stockvalue=0;
    }
    
    if($_REQUEST['stockvalue_open']!=''){
        $open=$_REQUEST['stockvalue_open'];
    }else{
        $open=0;
    }
    
    //echo $stockmenuid;
    // echo $stockstatus;
      //echo $stockvalue;
    $sql_menus  =  $database->mysqlQuery("Update tbl_menustock set mk_added_stock_total='0',mk_open_stock_date='".$_SESSION['date']."',mk_opening_stock='".$open."',mk_stock='".$stockstatus."',mk_stock_number='".$open."' where mk_menuid='".$stockmenuid."' and mk_portion $portion and mk_unit_type $unittype and mk_unit_id $unitid and mk_base_unit_id $baseunitid and mk_unit_weight='".$unitweight."'  "); 
    //echo "Update tbl_menustock set mk_stock='".$stockstatus."',mk_stock_number='".$stockvalue."' where mk_menuid='".$stockmenuid."' and mk_portion $portion and mk_unit_type $unittype and mk_unit_id $unitid and mk_base_unit_id $baseunitid and mk_unit_weight='".$unitweight."' and mk_opening_stock='".$_REQUEST['stockvalue_open']."' ";


//echo "Update tbl_menustock set mk_stock='".$stockstatus."',mk_stock_number='".$stockvalue."' where mk_menuid='".$stockmenuid."' and mk_portion $portion and mk_unit_type $unittype and mk_unit_id $unitid and mk_base_unit_id $baseunitid and mk_unit_weight='".$unitweight."'";
   //exit(); 
}
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Stock</title>
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
 
 <script>
$(document).ready(function(){

    $("#reportname").focus();
    
    var url_check=$('#url_check').val();
    
   var new_id=url_check.split('load_id=');
   
   var count=new_id[1].split('&menu=');
   
  
  var menu_id=count[1].split('&menu_name=');
   
 
   if(count[1]=='' || count[1]=='undefined' || count[1]==undefined ){
                localStorage.reportname_ld = menu_id[1];
                localStorage.maincat_ld = 'null';
                localStorage.subcat_ld = 'null';
                localStorage.mstatus_ld = 'Y';
                
   }
   
  
 
  $('#ids_'+count[0]+'_'+menu_id[0]).addClass('active_stock');
    
    
     if(localStorage.reportname_ld !='' && localStorage.reportname_ld !='null' )  {   
                    $('#reportname').val(localStorage.reportname_ld);
                
                 }else{
                    $('#reportname').val('');  
                 }
                 
                
                   $('#maincat').val(localStorage.maincat_ld);
                   $('#subcat').val(localStorage.subcat_ld);
                   $('#mstatus').val(localStorage.mstatus_ld);
                 
                  $('#menu_stock_no').val(localStorage.stock_no);
                
                 
       if(localStorage.reportname_ld !='null'  || localStorage.maincat_ld !='null' || localStorage.subcat_ld !='null' ||  localStorage.mstatus_ld !='null' || localStorage.stock_no !='null')      
         {
             
           validateSearch();
           
            
         }
    
    
	$('.tablesorter tr').click(function() { 
           
     	
		$('.tablesorter tr').removeClass('active_stock');
		$(this).addClass('active_stock');
		
         });
    


});



</script>

 
<style>
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
 .ui-autocomplete{z-index:999999 !important;}
.tablesorter tbody{float:left;min-height:400px;}
.menu_filter_txt{line-height:11px;color:#000;padding-top: 0;height: 15px;}
.filter_main_head{color: #fff;text-align: center;float:left;width:100%;line-height: 25px;}
.responstable th, .responstable td { padding: 0 !important;height: 30px;font-size: 12.5px;line-height: 18px;color: #000;    min-width: 80px;}
.responstable th{color:#fff;}
.master_page_tab_cc {min-height:490px;height:87vh;}
.menu_top_filter_left .form-control { height:30px;line-height:30px;border-radius: 5px;}
.add_text_box {height: 30px;line-height: 30px;padding: 0;padding-left: 5px;}
.search_btn_member_invoice a{line-height:29px;}
.tab_edt_btn{top: 4px;position: relative;}
.md-content .form-control{height: 30px;border-radius:3px;padding: 0;padding-left: 10px;border:solid 1px #ccc;box-shadow:none}
.pop_wdth{width:95%;}
.md-content a .newbut{padding: 0.3em 2.2em;margin: 3px -7px;text-transform:capitalize}
	#left_table_scr_cc{height: 72vh;}
.disablegenerate { pointer-events: none; opacity: 0.4; cursor:none;}

 .confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
	display:none;
		}
.active_stock{
background-color: lightcoral;    
}
.stck_add_btn{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec{width:100%;height:100%;position:fixed;left:0;top:0;z-index:8;background-color:rgba(0,0,0,0.7)}
.stok_add_popup{width:250px;height:150px;position:absolute;left:0;right:0;top:20%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:20px 0;position:relative}
.stok_add_popup_cnt{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:10px}
.stock_add_btn{width:38%;float:right;height:35px;text-align:center;line-height:35px;background-color:#738a77;color:#fff;border-radius:5px;}
.stok_add_popup_cls{width:20px;height:20px;position:absolute;right:5px;top:5px}
 </style>

</head>
<body>

    <div class="stok_add_popup_sec" style="display:none" id="add_stock_pop">    
    <div class="stok_add_popup">
        <div class="stok_add_popup_hd"><span id="menu_name_add"> </span>  <br> <span style="color:darkred;font-weight: bold;font-size: 15px" id="menu_por_add"> </span> <a href="#" onclick="$('#add_stock_pop').hide();" ><div class="stok_add_popup_cls"><img width="100%" src="img/black_cross.png" alt=""></div></a></div>
        <div class="stok_add_popup_cnt">
            <input onkeypress="return numonly()" maxlength="5" type="text" class="stock_add_txtbx" id="stock_add" placeholder="Enter Stock ">
            <a id="add_btn_stock"  onclick="add_stock();" href="#"><div class="stock_add_btn">ADD</div></a>
            
            <a id="full_stock_btn" style="display:none;text-align: center;width: 100%;float: left;    margin-top: -20px; " onclick="update_full_stock();" href="#"><div style="float:none;display: inline-block;background-color: darkred" class="stock_add_btn">UPDATE STOCK </div></a>
             
        </div>
    </div>
   </div>

    
    
     <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >
    <div class=" confrmation_overlay_proce" id="sms_email_loader">
        
    </div>
    
    
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar_master.php"; ?>
 <?php include "includes/left_menu.php"; ?>
<div class="mian">
    <div class="view-container">
        <div style="top: 58px;" id="container">

            <div class="breadcrumbs">
				
                <ul>
                    <li><a href="index.php" style="cursor:pointer"><i class="ti-home"></i></a>/</li>
                    <li><a style="cursor:pointer">Stock Master</a> <span style="color:red" id="stock_update"> </span>
                    </li>
                    <span id="ratechange" class="load_error alertsmaster" style="color:#F00"></span>
                </ul>

            </div>
            <!-- breadcrumbs -->
            <div class="content-sec">


                <!-- box head -->
                
                <div class="col-lg-12 col-md-12 middle_container nopadding">
                    <div style="padding:0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!--left_container-->
                        <div class="col-lg-12 col-md-12 min-height nopadding">
                            <div class="text_displaying_contain" style="padding: 0.4%;padding-bottom:0">
                                <div class="filter_main_head">
                                <div class="col-sm-2 nopadding" style="width:10%">

                                </div>
                                    <strong style="font-size: 15px;color: #56b39e"> <?=$_SESSION['date']?> : DAILY STOCK UPDATES  </strong>
                                
                                </div>
                                
                                <div class="master_page_tab_cc">
                                    <div class="menu_top_filter_left" style="width:100%">
                                        <div class="form-group" style=" margin-top: 5px; margin-left:5px;width:99% !important;">
                                            <div class="col-sm-2" style="padding-right: 5px;padding-left: 0px;margin-bottom:5px;width:17%">
                                                <p class="menu_filter_txt">Item Name</p>
                                                <input type="text" class="form-control" id="reportname" name="reportname" onKeyUp=" return validateSearch();" placeholder=" Name" >
                                            </div>
                                             <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px;width:14%">
                                                <p class="menu_filter_txt">Main Category</p>
                                                <select class="add_text_box" id="maincat" name="maincat" onChange=" return validateSearch();" >
                                                    <option value="null">Select</option>
                                                    <?php 
                                                    $sql_cat = $database->mysqlQuery("select mmy_maincategoryid,mmy_maincategoryname from tbl_menumaincategory where mmy_active='Y'");
                                                      
                                                        $num_cat = $database->mysqlNumRows($sql_cat);
                                                             if ($num_cat) {
                                                                 $j =0;
                                                                 while ($result_cat = $database->mysqlFetchArray($sql_cat)) {
                                                     ?>
                                                                <option value="<?=$result_cat['mmy_maincategoryid']?>"><?=$result_cat['mmy_maincategoryname']?></option>
                                                    <?php
                                                             }}
                                                             ?>
                                                    
                                                </select>
                                            </div>
                                            
                                            <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px;width:14%">
                                                <p class="menu_filter_txt">Sub Category</p>
                                                <select class="add_text_box" id="subcat" name="subcat" onChange=" return validateSearch();" >
                                                    <option value="null">Select</option>
                                                    <?php 
                                                    $sql_subcat = $database->mysqlQuery("select msy_subcategoryid,msy_subcategoryname from tbl_menusubcategory where msy_active='Y'");
                                                      
                                                        $num_subcat = $database->mysqlNumRows($sql_subcat);
                                                             if ($num_subcat) {
                                                                 $j =0;
                                                                 while ($result_subcat = $database->mysqlFetchArray($sql_subcat)) {
                                                     ?>
                                                                <option value="<?=$result_subcat['msy_subcategoryid']?>"><?=$result_subcat['msy_subcategoryname']?></option>
                                                    <?php
                                                             }}
                                                             ?>
                                                    
                                                </select>
                                            </div>
                                       
                                            <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px;width:10%">
                                                <p class="menu_filter_txt">Stock Status</p>
                                                <select class="add_text_box" id="mstatus" name="mstatus" onChange=" return validateSearch();" >
                                                    <option value="">All</option>
                                                    <option value="Y">Yes</option>
                                                    <option value="N">No</option>
                                                    
                                                </select>
                                            </div>
                                            
                                            <div class="col-sm-2" style="padding-right: 0px;padding-left:5px;margin-bottom:5px;width:12%">
                                                <p class="menu_filter_txt">Stock In Nos</p>
                                                <select class="add_text_box" id="menu_stock_no" name="menu_stock_no" onChange=" return validateSearch();" >
                                                       <option value="">All</option>
                                                    <option value="Y">Yes</option>
                                                    <option value="N">No</option>
                                                   
                                                </select>
                                            </div>
                                            
                                            <div class="col-sm-2 nopadding" style="width:8%">
                                                <p class="menu_filter_txt">&nbsp;</p>
                                                <div style="margin-left:2%;" class="search_btn_member_invoice"><a href="#" onClick="validateSearch()">Search</a>
                                                </div>
                                            </div>
                                            
                                            <?php if($_SESSION['expodine_id']=='admin'){ ?>
                                            <div class="col-sm-2 nopadding" style="width:10%;float:right;font-size: 10px">
                                                <p class="menu_filter_txt">&nbsp;</p>
                                                <div style="margin-left:2%;" class="search_btn_member_invoice"><a style="background-color: #1f6f68 !important" href="#" onClick="stockupdate()">STOCK UPDATE</a>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            
                                            
                                             <div class="col-sm-2 nopadding" style="width:15%;float:right;font-size: 10px;display: none">
                                                <p class="menu_filter_txt">&nbsp;</p>
                                                <div style="margin-left:2%;" class="search_btn_member_invoice"><a style="background-color: #1f6f68 !important" href="#" onClick="stock_excel()">DAILY STOCK DOWNLOAD</a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                       


                                    </div>
                                 
                                    <div class="col-md-12 add_btn_cc_2">
                                    
                                    </div>
                                    <div id="left_table_scr_cc" style="overflow:auto">
                                        <table class="responstable " id="listall"> <!--tablesorter-->
                                        
                                        
                                            <thead>
                                                <tr>
                                                    <th style="min-width:40px" width="5%" class="header">Action</th>
                                                    <th style="min-width:30px" width="5%" class="header">Sl</th>
                                                     <th style="min-width: 100px;display: none" width="7%" class="header">Date</th>
                                                    <th width="18%" class="header">Item</th>
                                                    <th width="15%" class="header">Unit</th>
                                                    <th width="12%" class="header">Main Category </th>
                                                    <th width="12%" class="header">Ref ID</th>
                                                     <th width="8%" class="header">Opening Stock</th>
                                                     <th width="8%" class="header">Added Stock</th>
                                                    <th width="8%" class="header">Stock Number</th>
                                                      <th style="min-width:60px" width="8%" class="header">Sold </th>
                                                    <th style="min-width:30px" width="8%" >Stock</th>
                                                    <th width="15%" style="display:none" class="header">Stock Time</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                        <?php
                        $sql_logincount  =  $database->mysqlQuery("select count(mk_menuid) as records from tbl_menustock "); 
                        
                        $num_logincount   = $database->mysqlNumRows($sql_logincount);
                        if($num_logincount){$i=1; $t=0;
                            $result_logincount  = $database->mysqlFetchArray($sql_logincount); 
                            {  
                                $t=$result_logincount['records'];
                            }              
                        }                
                                            
                                            
                        $sql_login  =  $database->mysqlQuery("select mk_added_stock_total,mk_open_stock_date,mk_opening_stock,bu_name,u_name,"
                                . " pm_portionname,mk_menuid,msc.msy_subcategoryname,mmc.mmy_maincategoryname,mk_stock,mk_stocktime,mk_stock_number,"
                                . " mk_date,mr.mr_menuname,mr_dailystock_in_number,mk_portion,mk_unit_type,mk_base_unit_id,mk_unit_id,mk_unit_weight"
                                . " from tbl_menustock left join tbl_portionmaster tp on tp.pm_id=mk_portion left join tbl_base_unit_master "
                                . " on bu_id=mk_base_unit_id left join tbl_unit_master on u_id=mk_unit_id LEFT JOIN tbl_menumaster mr "
                                . " on mr.mr_menuid=mk_menuid left join tbl_menumaincategory as mmc on mmc.mmy_maincategoryid=mr.mr_maincatid left join"
                                . " tbl_menusubcategory as msc on msc.msy_subcategoryid=mr.mr_subcatid  where mr.mr_delete_mode='N' "
                                . " order by mr.mr_menuname ASC LIMIT 0,75"); 
                       
                        $num_login   = $database->mysqlNumRows($sql_login);
                        if($num_login){$i=1; 
                        while($result_login  = $database->mysqlFetchArray($sql_login)) 
                            {  
                                $ordered_portion='';
                                $portion_check='';
                                $portion_id='';
                                
                                if($result_login['mk_unit_type']==''){
                                    
                                    $portion_id=$result_login['mk_portion'];
                                    $ordered_portion=$result_login['pm_portionname'];
                                    $portion_check='single';
                                }
                                else if($result_login['mk_unit_type']=='Packet'){
                                    
                                    $portion_id=$result_login['mk_unit_id'];
                                    $ordered_portion=$result_login['mk_unit_type'].' : '.number_format($result_login['mk_unit_weight'],$_SESSION['be_decimal']).' '.$result_login['u_name'];
                                    $portion_check='pack';
                                    
                                }
                                else if($result_login['mk_unit_type']=='Loose'){
                                    
                                        $portion_id=$result_login['mk_base_unit_id'];
                                        $ordered_portion=$result_login['mk_unit_type'].' : '.number_format($result_login['mk_unit_weight'],$_SESSION['be_decimal']).' '.$result_login['bu_name'];
                                        $portion_check='loose';
                                        
                               }
				
                              ?>
                                                
                               <tr id="ids_<?=$i?>_<?=$result_login['mk_menuid']?>"  class="clicktoview"  >
                                   
                                <?php if(($result_login['mk_open_stock_date']==$_SESSION['date'] && $result_login['mk_opening_stock']>0) || $portion_check!='single' ) { ?>
                                   
                                <td style="min-width:42px" title="Edit Not Possible"  width="5%" ><div style="display:block"  > <a class="tab_edt_btn md-trigger_edit"   ><i class="fa fa-lock"  ></i></a></div>     
                                 
                               <?php } else{ ?>
                               
                                <td style="min-width:42px"  width="5%" ><div style="display:block" id="editbutton<?=$result_login['mk_menuid']?><?=$i?>" > <a class="tab_edt_btn md-trigger_edit stockedit" id="<?=$i?>"  ><i class="fa fa-edit" onClick=" return editstock('<?=$result_login['mk_menuid']?>','<?=$result_login['mk_portion']?>','<?=$i?>','<?=$result_login['mr_dailystock_in_number']?>');" ></i></a></div>
                                 
                               <?php }  ?>
                                    
                                <div style="display:none" id="savebutton<?=$result_login['mk_menuid']?><?=$i?>"><a class="tab_edt_btn md-trigger_edit stocksave " id="<?=$i?>" onClick="return savestock('<?=$result_login['mk_menuid']?>','<?=$result_login['mk_portion']?>','<?=$result_login['mk_unit_type']?>','<?=$result_login['mk_unit_id']?>','<?=$result_login['mk_base_unit_id']?>','<?=$result_login['mk_unit_weight']?>','<?=$i?>');"><i class="fa fa-save"></i></a></div></td>
                              
                                <td style="min-width:32px" width="5%"><?=$i?></td>
                                <td style="display:none" width="9%"><?=$result_login['mk_date']?></td>
                                <td width="25%"><?=$result_login['mr_menuname']?></td>
                                 <td width="10%"><?=$ordered_portion?></td>
                                <td width="15%"><?=$result_login['mmy_maincategoryname']?></td>
                                <td width="15%"><?=$result_login['mk_menuid']?></td>
                                 
                                 
                                <td  width="10%"><div  style="display:block" id="stockquant_open<?=$result_login['mk_menuid']?><?=$i?>"><?=$result_login['mk_opening_stock']?></div><div style="display:none" id="stockquantedit_open<?=$result_login['mk_menuid']?><?=$i?>"><input style="width:50%" <?php if($result_login['mk_open_stock_date']==$_SESSION['date'] && $result_login['mk_opening_stock']>0 ) { ?> readonly  <?php } ?>  type="text"  id="stockchangebox_open<?=$result_login['mk_menuid']?><?=$i?>" onkeypress="return numonly()"></div></td>
                                 
                                <td style="text-align: left !important;padding-left: 3px !important" width="10%"><?=$result_login['mk_added_stock_total']?>  <?php if($result_login['mk_opening_stock']>0) { ?> <a onclick="add_stock_click('<?=$result_login['mk_menuid']?>','<?=$result_login['mk_portion']?>','<?=$result_login['mk_unit_type']?>','<?=$result_login['mk_unit_id']?>','<?=$result_login['mk_base_unit_id']?>','<?=$result_login['mk_unit_weight']?>','<?=$i?>','<?=$result_login['mr_menuname']?>','<?=$ordered_portion?>');" style="float:right;margin-right: 5px;text-align: center"   class="stck_add_btn" href="#">+</a> <?php } ?> </td>

                                <td width="12%"><div style="display:block" id="stockquant<?=$result_login['mk_menuid']?><?=$i?>"><?=$result_login['mk_stock_number']?></div><div style="display:none" id="stockquantedit<?=$result_login['mk_menuid']?><?=$i?>"><input style="width:10%" readonly type="text"  id="stockchangebox<?=$result_login['mk_menuid']?><?=$i?>" onKeyPress="return numonly()"></div></td>
                               
                                 <td style="min-width:60px" width="8%"><?= (($result_login['mk_opening_stock']+$result_login['mk_added_stock_total'])-$result_login['mk_stock_number'])  ?></td>
                                
                                
                            <td width="8%"><div style="display:block" id="stockstatusdispaly<?=$result_login['mk_menuid']?><?=$i?>"><?php if($result_login['mk_stock']=='Y'){ ?>Yes<?php } else { ?> No <?php }?></div><div style="display:none" id="stockstatusedit<?=$result_login['mk_menuid']?><?=$i?>"><select class="add_text_box" id="status<?=$result_login['mk_menuid']?><?=$i?>"><option  value="Y">Yes</option><option value="N">No</option></select></div></td>
                                <td style="display:none"  width="15%"><?=$result_login['mk_stocktime']?></td>
                                
                            </tr>
                            
                                <?php  $i++; } } ?>

                                        </tbody>
                                        </table>
                                        
                                    </div>
                                    <div class="page-nation pull-right bqlist_pagination" style="margin-right: 14px;margin-top: 3px;
}">
                                         
                                        <?php 
                                        $m=0;
                                       
                                        $p=floor(($t/75)+1);
                                        ?>
                                        <a href="#" style="padding:2px;border:1px solid black;color: black" value="$m" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong style="font-size:18px"><<</strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                        <a href="#"  style="padding:2px;border:1px solid black;color: black" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong style="font-size:18px"><?=$j?></strong></a>
                                        <?php $m=$m+75; } $m=$m-75;?>
                                     <a href="#" style="padding:2px;border:1px solid black;color: black" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong style="font-size:18px">>></strong></a>
                                    </div> 
                                </div>
                            </div>
                            <!--form_contain_cc-->
                        </div>
                    </div>
                    <!--left_container-->
                </div>
            </div>
        </div>
    </div>
    <!--container-->
</div><!--container-->
</div>



<div class="md-overlay"></div><!-- the overlay element -->
<script type="text/javascript" src="master_style/js/jquery-2.1.1.js"></script>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>



 <script>       
 validateSearch();
 function stock_excel(){
      
 }
 
 
 
function editstock(a,p,m,stock_in_number) { 
    
    var quant=$('#stockquant'+a+m).html();
    var stat=$('#stockstatusdispaly'+a+m).text();
    var quant_open=$('#stockquant_open'+a+m).html();
      
    if(stat.trim()=='Yes'){
        stat='Y';
    }
    else if(stat.trim()=='No'){
        stat='N';
    }
   
    $('.stockedit').addClass("disablegenerate");
    $('#savebutton'+a+m).css('display','block');
    $('#editbutton'+a+m).css('display','none');
    
    if(stock_in_number=='Y') {
        $('#stockquantedit'+a+m).css('display','block');
        $('#stockquant'+a+m).css('display','none');
        $('#stockchangebox'+a+m).val(quant);
        $('#stockchangebox_open'+a+m).val(quant_open);
        
        
         $('#stockquantedit_open'+a+m).css('display','block');
          $('#stockquant_open'+a+m).css('display','none');
        
    }
    else if(stock_in_number=='N'){
        $('#stockstatusdispaly'+a+m).css('display','none');
        $('#stockstatusedit'+a+m).css('display','block');
        $('#status'+a+m).val(stat);
    }
    return true;
    
    };
    
    
    
 function savestock(b,por,unittype,unitid,baseunitid,unitweight,n) {
    
     var serach_menu=$('#reportname').val();
   
     var stockstatus=$('#status'+b+n).val();
     var stockvalue=$('#stockchangebox'+b+n).val();
     var stockvalue_open=$('#stockchangebox_open'+b+n).val();
     
      var datastring = 'stockmenuid='+b+'&stockstatus='+stockstatus+'&stockvalue='+stockvalue+'&portion='+por+'&unittype='+unittype+'&unitid='+unitid+'&baseunitid='+baseunitid+'&unitweight='+unitweight+"&stockvalue_open="+stockvalue_open;
       $.ajax({
                type: "POST",
                url: "stock_master.php",
                data: datastring,
                success: function (data)
                {
                 
                         $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('STOCK UPDATED ');
                        $('.alert_error_popup_all_in_one').delay(500).fadeOut('slow');
                        
                 setInterval(function () {
                     window.location.href='stock_master.php?load_id='+n+"&menu="+b+"&menu_name="+serach_menu;
                 }, 500);
            

               }
            });
        
    }
 
 
 function numonly(evt)
 {
   evt = (evt) ? evt : window.event;
   var charCode = (evt.which) ? evt.which : evt.keyCode;
   if (charCode > 31 && (charCode < 48 || charCode > 57)) {
  
       return false;
     
   }
       return true;
 }
 
 
 
function stockupdate(){
    
     $('#add_stock_pop').show();
     $('#full_stock_btn').show();
     $('#add_btn_stock').hide();
    
     $('#menu_name_add').text('CONFIRM UPDATE ?');
     $('#menu_por_add').text('* STOCK WILL BE RESET TO ZERO *');
  
     $('#stock_add').hide();
    
}

function update_full_stock(){
    
      $('#add_stock_pop').hide();
      $('.alert_error_popup_all_in_one').show();
                                    
       $('.alert_error_popup_all_in_one').text('UPDATING STOCK ');
       $('.alert_error_popup_all_in_one').delay(50000).fadeOut('slow');
                        
        var datastring = 'stockupdate=';
        $.ajax({
                type: "POST",
                url: "stock_master.php",
                data: datastring,
                success: function (data)
                {
                    
                        $('#add_stock_pop').hide();
   
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('UPDATED STOCK TO ZERO QUANTITY');
                        $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
                        
                setInterval(function () {
                    window.location.href='stock_master.php';
                }, 2000);
               
               }
            });
    }
	 
	 
 function validateSearch()
 {    
	var menusearch_word=$('.form-control').val();
        var menusearch_status=$('#mstatus').val();
        var menusearch_maincat=$('#maincat').val(); 
        var menusearch_subcat=$('#subcat').val(); 
        
        var menu_stock_no=$('#menu_stock_no').val();

         var datastring= "menusearch_word="+menusearch_word+"&menusearch_status="+menusearch_status+"&menusearch_maincat="+menusearch_maincat+
         "&menusearch_subcat="+menusearch_subcat+"&menu_stock_no="+menu_stock_no;
	  $.ajax({
			type: "POST",
			url: "load_stock_master.php",
			data: datastring,
			success: function(data)
			{
				$('#left_table_scr_cc').html(data);
                                 
			}
		});  
               
   
 
   
                localStorage.stock_no = menu_stock_no;
                
                localStorage.reportname_ld = menusearch_word;
                localStorage.maincat_ld = menusearch_maincat;
                localStorage.subcat_ld = menusearch_subcat;
                localStorage.mstatus_ld = menusearch_status;  
                
}


 function pagination(p,q)
 {
     var s=$('#recordcount').val();

     if(q==1)
     {
     var m= q;
     var j=parseInt(q)+6;
     }
     else if(q==2)
     {
     var m= parseInt(q)-1;
     var j=parseInt(q)+5;
     }
     else if(q==3)
     {
       var m= parseInt(q)-2;
       var j= parseInt(q)+4;
     }
     else 
     {
       var m= parseInt(q)-3;
       var j= parseInt(q)+3;
     }

    
     var o=0;
     var w=0;
      var n=0;
     
    for(w=1;w<=m;w++)
     {
         
         $('#pagi'+w).hide();
     } 
     for(n=m;n<=j;n++)
     {
         
         $('#pagi'+n).show();
     } 
     for(o=j;o<=s;o++)
     {
         
         $('#pagi'+o).hide();
     } 
     
        var menusearch_word=$('.form-control').val();
        var menusearch_status=$('#mstatus').val();
        var menusearch_maincat=$('#maincat').val(); 
        var menusearch_subcat=$('#subcat').val();
        var recordcount=parseInt(p)+1;
  
          var datastring= "pagination="+p+"&recordcount="+recordcount+"&menusearch_word="+menusearch_word+"&menusearch_status="+menusearch_status+
                  "&menusearch_maincat="+menusearch_maincat+"&menusearch_subcat="+menusearch_subcat;
	  $.ajax({
			type: "POST",
			url: "load_stock_master.php",
			data: datastring,
			success: function(data)
			{ 
				$('#left_table_scr_cc').html(data);
			}
		}); 
                
                localStorage.reportname_ld = menusearch_word;
                localStorage.maincat_ld = menusearch_maincat;
                localStorage.subcat_ld = menusearch_subcat;
                localStorage.mstatus_ld = menusearch_status;  
 }


function add_stock_click(mid,por,utype,u_id,base_id,u_wt,id,name,por_show){
    
     $('#add_stock_pop').show();
     $('#menu_name_add').text(name);
     $('#menu_por_add').text('['+por_show+']');
    
     $('#add_btn_stock').attr('menuid',mid);
     $('#add_btn_stock').attr('portion',por);
     $('#add_btn_stock').attr('unittype',utype);
     $('#add_btn_stock').attr('unitid',u_id);
     $('#add_btn_stock').attr('baseunitid',base_id);
     $('#add_btn_stock').attr('unitweight',u_wt);
     $('#add_btn_stock').attr('loopid',id);
     $('#stock_add').val('');
     $('#stock_add').focus();
}



function add_stock(b,por,unittype,unitid,baseunitid,unitweight,n) {
    
    
    var b=  $('#add_btn_stock').attr('menuid');
    var por=  $('#add_btn_stock').attr('portion');
    var unittype=  $('#add_btn_stock').attr('unittype');
    var unitid=  $('#add_btn_stock').attr('unitid');
    var baseunitid=  $('#add_btn_stock').attr('baseunitid');
    var unitweight=  $('#add_btn_stock').attr('unitweight');
    var n=  $('#add_btn_stock').attr('loopid');
   
     var serach_menu=$('#reportname').val();
     var stockstatus=$('#status'+b+n).val();
     var stockvalue=$('#stockchangebox'+b+n).val();
     var stockvalue_open=$('#stockchangebox_open'+b+n).val();
      
      var stock_add=$('#stock_add').val();
      
      if(stock_add>0){
      
      var datastring = 'stock_add_menuid='+b+'&stockstatus='+stockstatus+'&stockvalue='+stockvalue+'&portion='+por+'&unittype='+unittype+
      '&unitid='+unitid+'&baseunitid='+baseunitid+'&unitweight='+unitweight+"&stockvalue_open="+stockvalue_open+"&stock_add="+stock_add;
       $.ajax({
                type: "POST",
                url: "stock_master.php",
                data: datastring,
                success: function (data)
                {
             
                 $('#add_stock_pop').hide();
                 $('#menu_name_add').text('');
                 $('#menu_por_add').text('');
               
                $('.alert_error_popup_all_in_one').show();
                                    
                $('.alert_error_popup_all_in_one').text('STOCK ADDED ');
                $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                
                validateSearch();

               }
            });
            
        }else{
            
                        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('ENTER VALID STOCK');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        }
    
    
    
    }

$(document).ready(function()
{
    var count=$('#recordcount').val();
    var i;
    
    for(i=7;i<=count;i++){
    $('#pagi'+i).hide();
    }

});


</script>

</body>
</html>