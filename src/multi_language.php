<?php
//include('includes/session.php'); // Check session
session_start();
error_reporting(0);
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'excel_reader.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';

if($_SERVER['REQUEST_METHOD'] =='POST'){
    
    if ($_FILES['menu_file']['name'])
	{
            $excel = new PhpExcelReader;
            $excel->setOutputEncoding('UTF-8');

        $target_dir = "../util/";
        $target_file = $target_dir . basename($_FILES["menu_file"]["name"]);
 
        move_uploaded_file($_FILES['menu_file']['tmp_name'], $target_file);
        $excel->read($target_file);

        
        }
        $sheet=$excel->sheets[0];
	$x = 1;
        
	while($x <= $sheet['numRows']) {
            if($sheet['cells'][$x][1]!=''){
 
                $insertion['MENU'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][2]));
                $insertion['lm_menu_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][3]));
                $insertion['lm_menu_print'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][5]));
                $insertion['lm_menu_description'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][7]));
                $insertion['lm_menu_diet'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][9]));
                $insertion['lm_menu_prepmode']		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][11]));
                $check_query=$database->mysqlQuery("select lm.lm_menu_id FROM tbl_language_menu_master lm 
                                                    left join tbl_menumaster mm ON mm.mr_menuid = lm.lm_menu_id where lm.lm_language_id='".$_SESSION['idrr']."' and mm.mr_menuname=TRIM('".$insertion['MENU']."')");  
                $num_check_query  = mysqli_num_rows($check_query);
		if($num_check_query)
		{
                    $update_query=$database->mysqlQuery("update tbl_language_menu_master lm, tbl_menumaster mm set lm.lm_menu_name='".$insertion['lm_menu_name']."', lm.lm_menu_print='".$insertion['lm_menu_print']."', lm.lm_menu_description='".$insertion['lm_menu_description']."', lm.lm_menu_diet='".$insertion['lm_menu_diet']."', lm.lm_menu_prepmode='".$insertion['lm_menu_prepmode']."' where lm.lm_language_id='".$_SESSION['idrr']."' and lm.lm_menu_id = mm.mr_menuid and mm.mr_menuname =TRIM('".$insertion['MENU']."')");
                    //echo "update tbl_language_menu_master lm, tbl_menumaster mm set lm.lm_menu_name='".$insertion['lm_menu_name']."', lm.lm_menu_print='".$insertion['lm_menu_print']."', lm.lm_menu_description='".$insertion['lm_menu_description']."', lm.lm_menu_diet='".$insertion['lm_menu_diet']."', lm.lm_menu_prepmode='".$insertion['lm_menu_prepmode']."' where lm.lm_language_id='".$_SESSION['idrr']."' and lm.lm_menu_id = mm.mr_menuid and mm.mr_menuname =TRIM('".$insertion['MENU']."')";
                }
                else{
                $querylang1=$database->mysqlQuery(" INSERT INTO  tbl_language_menu_master (lm_language_id,lm_menu_id, lm_menu_name, lm_menu_print, lm_menu_description, lm_menu_diet, lm_menu_prepmode)
                                                   SELECT '".$_SESSION['idrr']."',m.mr_menuid,'".$insertion['lm_menu_name']."','".$insertion['lm_menu_print']."','".$insertion['lm_menu_description']."','".$insertion['lm_menu_diet']."','".$insertion['lm_menu_prepmode']."' FROM tbl_menumaster m where m.mr_menuname=TRIM('".$insertion['MENU']."')");    
//                                echo "INSERT INTO  tbl_language_menu_master (lm_language_id,lm_menu_id, lm_menu_name, lm_menu_print, lm_menu_description, lm_menu_diet, lm_menu_prepmode)
//                                                SELECT '".$_SESSION['idrr']."',m.mr_menuid,'".$insertion['lm_menu_name']."','".$insertion['lm_menu_print']."','".$insertion['lm_menu_description']."','".$insertion['lm_menu_diet']."','".$insertion['lm_menu_prepmode']."' FROM tbl_menumaster m where m.mr_menuname=TRIM('".$insertion['MENU']."')";                                                                                           
            
                }
            }
            $x++;
        } 
        //print_r($insertion);
        //exit();
    }

   if(isset($_REQUEST['set'])&&($_REQUEST['set']=="cat1")){
    $cat1=$_REQUEST['item1'];
    $catid1=$_REQUEST['idofcat'];
    $catid4=$_REQUEST['hiddf'];
    
    
    $itemcode=$_REQUEST['itemcode'];
    $diet=$_REQUEST['diet'];
    $description=$_REQUEST['description'];
    $prepmode=$_REQUEST['prepmode'];
    
    
    //echo $cat1,$catid1,$catid4;
    
    
    
    
    $querylang=$database->mysqlQuery("select lm_menu_id from  tbl_language_menu_master where lm_menu_id='".$catid1."' and lm_language_id='". $_SESSION['idrr']."'");
    $num_gen9  = mysqli_num_rows($querylang);
		  if($num_gen9)
		  {
    
   
    $querylang1=$database->mysqlQuery("update  tbl_language_menu_master set lm_menu_name='".$cat1."',lm_menu_print='".$itemcode."',lm_menu_description='".$description."',lm_menu_diet='".$diet."',lm_menu_prepmode='".$prepmode."'  where lm_menu_id='".$catid1."' and lm_language_id='".$_SESSION['idrr']."'");
        }else
    {
         $insertion['lm_language_id'] =  $_SESSION['idrr'];
         $insertion['lm_menu_name'] = $cat1;
          $insertion['lm_menu_id'] = $catid1;
          
          $insertion['lm_menu_print'] = $itemcode;
         $insertion['lm_menu_description'] = $description;
          $insertion['lm_menu_diet'] = $diet;
          $insertion['lm_menu_prepmode'] = $prepmode;
          
          
          
          $insertid = $database->insert('tbl_language_menu_master', $insertion);
    }
    
    
}


if ( !isset($_SESSION['idrr']) ) {
    
    $_SESSION['idrr'] = 1;
} else {
   if(isset($_REQUEST['set1'])&&($_REQUEST['set1']=="cat11")){
     
  $_SESSION['idrr']= $_REQUEST['hiddf12'];
  //echo $_REQUEST['hiddf12'] ;
 
}
}


$lang="";
$sql_login  =  $database->mysqlQuery("select * from tbl_languages where ls_id='". $_SESSION['idrr']."'"); 
				$num_login   = $database->mysqlNumRows($sql_login);
				if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					  {
                                          
                                          $lang= $result_login['ls_language'];
                                            
                                }
                                        }







?>






<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Multi Language</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/default.date.css">
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
.tablesorter tbody{min-height:420px;}
.contant_table_cc{
	  height: 65vh;
  min-height:460px;
	}
.searchlist{
	width: 96% !important;background: #f2f2f2  !important; position: absolute !important;top: 55px;z-index: 9999;padding-left: 1%;max-height:350px;overflow:auto}
</style>
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
#left_table_scr_cc {
    width: 100%;
        min-height: 330px;
    height: 66vh;}
	.main_banquet_contant_head{background-color:#fff}
	.responstable th, .responstable td{padding:5px;}
	.main_banquet_form_name{padding-top:0}
	.main_banquet_form_textbox_input{height:33px;border: solid 1px #ccc;}
	.menut_add_bq_btn{font-size:15px;height:34px;line-height:34px;margin-top:21px}
	::-webkit-scrollbar{height:20px;}
	.bnq_dtail_table td{
	line-height:25px !important;
	font-size:14px !important;
	color:#333;
	padding:5px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit !important;
	}
.bnq_dtail_table th{
	line-height:25px !important;
	font-size:14px !important;
	color:#333;
	padding:5px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit !important;
	background-color:#000;
	color:#fff;
	border:0;
	font-family:Arial, Helvetica, sans-serif
	}
.banq_inv_right_table td{
	line-height:17px;
	font-size:13px;
	color:#333;
	padding:3px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit;
	}
.main_banquet_contant table td{min-height:40px !important;}
.banq_inv_right_table th{
	line-height:17px;
	font-size:13px;
	color:#333;
	padding:3px;
	border:solid 1px #ccc;
	text-align:center;
	min-width:inherit;
	background-color: #b25c03;
	color:#fff;
	border:0;
	}
	.main_banquet_contant_left_main .main_banquet_form_box{margin-bottom:15px;}
	.main_banquet_form_box{margin-bottom:7px}
	.als-item a{padding: 0 10px;}
        .disablegenerate
        {
            pointer-events: none;
            opacity: 0.4;
            cursor:none;

        }
        .als-wrapper{
         overflow-y: hidden;
         margin: 0px auto;
        height: 50px;
        white-space: nowrap;
        }
        #lista1 .als-item{    display: inline-block;float: none; height: 30px;}
        .als-wrapper::-webkit-scrollbar {
            height: 14px;
        }
        .als-container{border-bottom: 3px solid #191919 !important;}
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
					<li><a style="cursor:pointer">Multi Language</a></li>
            		
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                
                	<div class="mlt_language_contant_cc">
                    
                    	
                        <div style="  border: 1px #B6B6B6 solid;" class="cc_new">
                       	<div id="lista1" class="als-container">
                            <div class="als-viewport" style="width:100% !important">
                                
                                <ul class="als-wrapper">
                                      
                                    <li class="als-item"><a href="multi_language.php" class="new_tab_btn active_btn_1">Item Name</a></li>
                                  
                                    <li class="als-item"><a href="menucategory_language.php" class="new_tab_btn ">Main Category</a></li>
                                       
                                    <li class="als-item"><a href="subcategory_lang.php" class="new_tab_btn ">Sub Category</a></li>
                                 
                                    <li class="als-item"><a href="floor_lang_change.php" class="new_tab_btn ">Floor</a></li>
                                 
                                    <li class="als-item"><a href="table_lang.php" class="new_tab_btn ">Table</a></li>
                                    
                                    <li class="als-item"><a href="portion_lang.php" class="new_tab_btn ">Portion</a></li>
                                 
                                    <li class="als-item"><a href="preference_lang.php" class="new_tab_btn ">Preference</a></li>
                                    
                                      <li class="als-item"><a href="staff_lang.php" class="new_tab_btn ">Staff Master</a></li>
                                      
                                       <li class="als-item"><a href="feedback_lang.php" class="new_tab_btn ">Feedback</a></li>
                                       
                                     
                                    
                                </ul>
             
            
                    </div>
                        </div>
                   </div>
                   
                   		<div class="main_banquet_contant_head" style="line-height: 13px;">
                        	
                            <div class="main_banquet_form_box" style="width: 100%">
                                <div class="main_banquet_form_textbox" style="width: 50%;padding-left: 0">
                                <span style="width: 100%;">Select Language <span style="font-size: 12px;float: right;margin-right: 45px;color: darkred;font-weight: bold ">(Arabic conversion is approximate only)</span></span>
                                <select id="selectedlang" name="selectedlang" onchange="changeof()" class="main_banquet_form_textbox_input" style="border-radius: 5px;height:35px;font-size:15px;width: 30%;">                  
                                <option hidden="" id="dft"><?=ucfirst($lang)?></option>
                                <?php
			        $sql_login  =  $database->mysqlQuery("select * from tbl_languages where ls_language<>'english'"); 
				$num_login   = $database->mysqlNumRows($sql_login);
				if($num_login){
					while($result_login  = $database->mysqlFetchArray($sql_login)) 
					  {
                                            $idd1=$result_login['ls_id'];
					    ?>
                                           
                <option value="<?=$idd1?>_<?=$result_login['ls_language']?>" <?php if($_SESSION['main_language']==$result_login['ls_language']){ ?> selected="selected" <?php } ?>><?=ucfirst($result_login['ls_language'])?></option>
                  
                      
                                    <?php } } ?>
                                     
                </select>
                                    
                                    
                                    <button style="width: 105px;padding: 10px 0px;font-size: 12px;float: left;margin-left: 2%" id="menu_to_excel">ITEM DOWNLOAD</button>
                                     
                                    
                                    </div>
                               
                                <form method="post" name="multilanguage_menu_upload" enctype='multipart/form-data'>
                                    <div style="width: 49%;padding-left: 0;" class="main_banquet_form_textbox">
                                         <span style="width: 100%;">Upload Item</span>
                                    <input type="file" id="menu_file" name="menu_file"  class="main_banquet_form_textbox_input" style="padding: 4px;border-radius: 5px;height:35px;font-size:15px;width: 35%">
                                
                                    <button style="width: 105px;padding: 10px 7px;font-size: 13px;float: left;margin-left: 2%" type="submit" id="menu_to_db">ITEM UPLOAD</button>
                                
                                    &nbsp; <input autofocus type="text" id="searchBox" placeholder="Search Item" style="width:99px;margin-top: 6px;">
                                    </div>
                                
                                 </form>
                                </div>
<!--                              <div style="margin-left:1%;width:10%;margin-top: 4px;" class="search_btn_member_invoice"><a href="#" id='submitlang'>Submit</a></div>  -->
                        </div>
                             
                        	<div class="main_banquet_contant" style="padding-top:0">
                            		<div id="left_table_scr_cc">
                                        <table class="responstable" id="mytb">  
                                        <thead>
                                        <tr>
                                         	<th style="min-width:50px;">Edit</th>
                                         	<th>Item Name-English</th>
                                                <th>Item Name-<span id="newlang"><?=ucfirst($lang)?> </span></th>
                                                <th>Item Print-English</th>
                                                <th>Item Print-<span id="newlang"><?=ucfirst($lang)?> </span></th>
                                                <th>Item Description-English</th>
                                                <th>Item Description-<span id="newlang"><?=ucfirst($lang)?> </span></th>
                                                <th>Item Diet-English</th>
                                                <th>Item Diet-<span id="newlang"><?=ucfirst($lang)?> </span></th>
                                                <th>Item Prepmode-English</th>
                                                <th>Item Prepmode-<span id="newlang"><?=ucfirst($lang)?> </span></th>
                                             
                                        </tr>
                                        </thead>
                                        <tbody>
                                 
                                                   
                    <?php        
                    $sql_login1  =  $database->mysqlQuery("select c.mr_menuid,c.mr_menuname,c.mr_diet,c.mr_prepmode,c.mr_description,c.mr_itemshortcode,
                    (select m.lm_menu_name from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as name_lang,
                    (select m.lm_menu_print from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as print_lang,
                    (select m.lm_menu_description from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as desc_lang,
                    (select m.lm_menu_diet from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as diet_lang,
                    (select m.lm_menu_prepmode from  tbl_language_menu_master m  where m.lm_menu_id = c.mr_menuid and m.lm_language_id ='".$_SESSION['idrr']."' )as prep_lang
                    from  tbl_menumaster c order by c.mr_menuname"); 
				$num_login1  = $database->mysqlNumRows($sql_login1);
				if($num_login1){
					while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
					  {
                                            
                                        
                                               ?>   
                                                 <tr>
                                                     <td style="min-width:50px;">
                                                         <a href="#" style="display:block" class="edit_list text1" id="edtbtn<?=$result_login1['mr_menuid']?>" onclick="edit_click('<?=$result_login1['mr_menuid']?>')"  ><img src="images/edit_page.PNG"></a>
                                                         <a href="#" style="display:none" class="edit_list" id="savebtn<?=$result_login1['mr_menuid']?>" onclick="save_click('<?=$result_login1['mr_menuid']?>')"  ><img src="img/save_ico.png"></a>
                                                   </td>

                                                   <td id="mn_name<?=$result_login1['mr_menuid']?>"><?=$result_login1['mr_menuname']?></td>
                                                    
                                                   
                                               <td ><div style="display:block" id="menuname<?=$result_login1['mr_menuid']?>"><?=$result_login1['name_lang']?></div>
                                                   <div id="menunameedit<?=$result_login1['mr_menuid']?>" style="display:none"> <input type="text" style="text-align:left;padding-left:10px" class="language_textbx txt1" name="menunamefield" id="menunamefield<?=$result_login1['mr_menuid']?>"  > </div>
                                               </td>
                                               
                                               
                                               <td ><?=$result_login1['mr_itemshortcode']?></td>
                                                    
                                                   
                                               <td ><div style="display:block" id="itemcode<?=$result_login1['mr_menuid']?>"><?=$result_login1['print_lang']?></div>
                                                   <div id="itemcodeedit<?=$result_login1['mr_menuid']?>" style="display:none"> <input type="text" style="text-align:left;padding-left:10px" class="language_textbx txt1" name="itemcodefield" id="itemcodefield<?=$result_login1['mr_menuid']?>"  > </div>
                                               </td>
                                               
                                               
                                               <td ><?=$result_login1['mr_description']?></td>
                                                    
                                                   
                                               <td ><div style="display:block" id="description<?=$result_login1['mr_menuid']?>"><?=$result_login1['desc_lang']?></div>
                                                   <div id="descriptionedit<?=$result_login1['mr_menuid']?>" style="display:none"> <input type="text" style="text-align:left;padding-left:10px" class="language_textbx txt1" name="descriptionfield" id="descriptionfield<?=$result_login1['mr_menuid']?>"  > </div>
                                               </td>
                                               
                                               
                                               <td ><?=$result_login1['mr_diet']?></td>
                                                    
                                                   
                                               <td ><div style="display:block" id="dietshow<?=$result_login1['mr_menuid']?>"><?=$result_login1['diet_lang']?></div>
                                                   <div id="dietedit<?=$result_login1['mr_menuid']?>" style="display:none"> <input type="text" style="text-align:left;padding-left:10px" class="language_textbx txt1" name="dietfield" id="dietfield<?=$result_login1['mr_menuid']?>"  > </div>
                                               </td>
                                               
                                               
                                               
                                               <td ><?=$result_login1['mr_prepmode']?></td>
                                                    
                                                   
                                               <td><div style="display:block" id="prepmodeshow<?=$result_login1['mr_menuid']?>"><?=$result_login1['prep_lang']?></div>
                                                   <div id="prepmodeedit<?=$result_login1['mr_menuid']?>" style="display:none"> <input type="text" style="text-align:left;padding-left:10px" class="language_textbx txt1" name="prepmodefield" id="prepmodefield<?=$result_login1['mr_menuid']?>"  > </div>
                                               </td>
                                               
                                               
                                               
                                                 </tr>
                                <?php } } ?>
                                                   
                                                    
                                      

                                         </tbody>
                                      </table>
                                    </div>

                                   

                                    

                            </div>

                            
                        </div>
                    </div>
		</div>
	</div>
</div>
</div><!--container-->
</div>

   <style>
.highlight1 {
    background-color: #ddb876;
    font-weight: bold;
}
</style>


<!---banquet_listting_edit_popup-->
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>





<script>
    
  $(document).ready(function(){  
      
      
   var path = window.location.pathname; 
   if (window.location.href.includes("menu")) { 
    
       setTimeout(function(){
       
       var menu = getUrlParam("menu");  
      
    let value = menu.toLowerCase();
    let container = $("#left_table_scr_cc");
    // remove old highlight
    $("#mytb tbody tr").removeClass("highlight1");

    if (!value) return;

    $("#mytb tbody tr").each(function () {  
        // search only Item Name-English column (2nd td)
        let text = $(this).find("td:eq(1)").text().toLowerCase();

        if (text.includes(value)) {

            // highlight row
            $(this).addClass("highlight1");

             this.scrollIntoView({
                behavior: "smooth",
                block: "center"   // center row in container
            });


            return false; // stop at first match
        }
       });
       
       
       },500); 
       
    }
 });
    
    
 $("#searchBox").on("keyup", function () {
    
    let value = $(this).val().toLowerCase();
    let container = $("#left_table_scr_cc");
    // remove old highlight
    $("#mytb tbody tr").removeClass("highlight1");

    if (!value) return;

    $("#mytb tbody tr").each(function () {  
        // search only Item Name-English column (2nd td)
        let text = $(this).find("td:eq(1)").text().toLowerCase();

        if (text.includes(value)) {

            // highlight row
            $(this).addClass("highlight1");

             this.scrollIntoView({
                behavior: "smooth",
                block: "center"   // center row in container
            });


            return false; // stop at first match
        }
    });
});


    function getUrlParam(name) {
        var query = window.location.search.substring(1).split("&");
        for (var i = 0; i < query.length; i++) {
            var pair = query[i].split("=");
            if (pair[0] === name) {
                return decodeURIComponent(pair[1] || "");
            }
        }
        return "";
    }



</script>





<script>
$('#menu_to_excel').click(function(){
    
    window.location="multi_language_menu_download.php?menu_to_excel=";
    
});
$('#menu_to_db').click(function(){
    
    if($('#menu_file').val()==''){
        
        //alert('Please Select A File');
         $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('PLEASE CHOOSE FILE');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        $('#menu_file').css('border','2px solid red');
        return false;
        
        
        
    }
    else{
        
        
        if($('#menu_file').val().includes(".xls")){
          $('#menu_file').removeAttr('border');  
            return true;
        }
        else{
            alert('Incorrect File Format');
            $('#menu_file').css('border', '2px solid red');
            return false;
            $('#menu_file').focus();
             
        }
        
    }
    
});



function changeof(){
   
  var sl=$('#selectedlang').val();
    var hid99=sl.split("_");
   $('#newlang').html(hid99[1]);
   
   var datastringnew1="set1=cat11&hiddf12="+hid99[0];
      
       $.ajax({
        type: "POST",
        url: "multi_language.php",
        data: datastringnew1,
        success: function(data)
        {
        

         //alert(data);
        }
    });
    location.reload();
   }
  
 
    
  
  
  function edit_click(a){
      
     var show123=$('#menuname'+a).html();
     $('#menunamefield'+a).val(show123);
     
      $(".text1").addClass("disablegenerate");
      
       $('#menuname'+a).hide();
       $('#menunameedit'+a).show();
       
       
       var show1=$('#itemcode'+a).html();
       $('#itemcodefield'+a).val(show1);
       
       
       $('#itemcode'+a).hide();
       $('#itemcodeedit'+a).show();
       
       var show12=$('#description'+a).html();
       $('#descriptionfield'+a).val(show12);
     
       $('#description'+a).hide();
       $('#descriptionedit'+a).show();
       
       var show11=$('#dietshow'+a).html();
       $('#dietfield'+a).val(show11);
       
       $('#dietshow'+a).hide();
       $('#dietedit'+a).show();
       
       
       
        var show111=$('#prepmodeshow'+a).html();
        $('#prepmodefield'+a).val(show111);
       
        $('#prepmodeshow'+a).hide();
        $('#prepmodeedit'+a).show();
       
        $('#menunamefield'+a).focus();
        $('#savebtn'+a).show();
        $('#edtbtn'+a).hide();
         
        
        var sl=$('#selectedlang').val(); 

        if(sl=='Arabic'){
           convert(a);
         }
   }

    const map = {
    a:"ا", b:"ب", c:"ك", d:"د", e:"ي", f:"ف", g:"ج",
    h:"ه", i:"ي", j:"ج", k:"ك", l:"ل", m:"م", n:"ن",
    o:"و", p:"ب", q:"ق", r:"ر", s:"س", t:"ت", u:"و",
    v:"ف", w:"و", x:"كس", y:"ي", z:"ز",
    " ":" ",

    // numbers
    "1":"١", "2":"٢", "3":"٣", "4":"٤", "5":"٥",
    "6":"٦", "7":"٧", "8":"٨", "9":"٩", "0":"٠"
    };

   function convert(id) {
        let text = document.getElementById("mn_name"+id).textContent.toLowerCase(); 
        let out = "";

        for (let ch of text) {
            out += map[ch] ?? ch;
        }

        if($('#menunamefield'+id).val()==''){
        
        document.getElementById("menunamefield"+id).value=out ;
        document.getElementById("itemcodefield"+id).value=out ;
        
        }
    }


  function save_click(b){
       
     var catsh=$('#menuname'+b).html();
      
     var itemname=$('#menunamefield'+b).val();
     var fitem= itemname.trim( );
     
     var itemname1=$('#itemcodefield'+b).val();
     var itemcode= itemname1.trim( );
     
     var itemname11=$('#dietfield'+b).val();
     var diet= itemname11.trim( );
  
     var itemname12=$('#descriptionfield'+b).val();
     var description= itemname12.trim( );
   
     var itemname13=$('#prepmodefield'+b).val();
     var prepmode= itemname13.trim( );
  
       $('#menuname'+b).show();
       $('#menunameedit'+b).hide();
       
       $('#itemcode'+b).show();
       $('#itemcodeedit'+b).hide();
       
       $('#dietshow'+b).show();
       $('#dietedit'+b).hide();
       
       $('#description'+b).show();
       $('#descriptionedit'+b).hide();
       
       $('#prepmodeshow'+b).show();
       $('#prepmodeedit'+b).hide();
       
       $('#savebtn'+b).hide();
       $('#edtbtn'+b).show();
       
       var datastringnew="set=cat1&item1="+fitem+"&idofcat="+b+"&itemcode="+itemcode+"&diet="+diet+"&description="+description+"&prepmode="+prepmode;
       
       $.ajax({
        type: "POST",
        url: "multi_language.php",
        data: datastringnew,
        success: function(data)
        {
         //alert(data);
        }
        });
        
        var mn_new=$('#mn_name'+b).text();
       
       window.location.href='multi_language.php?menu='+mn_new;
      //location.reload();
            
   }
   
</script>


</body>
</html>