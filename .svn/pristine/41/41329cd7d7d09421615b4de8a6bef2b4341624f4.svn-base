<?php
//include('includes/session.php');		// Check session
session_start();
error_reporting(0);
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'excel_reader.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';

if($_SERVER['REQUEST_METHOD'] =='POST'){
    
    if ($_FILES['category_file']['name'])
	{
            $excel = new PhpExcelReader;
            $excel->setOutputEncoding('UTF-8');

        $target_dir = "../util/";
        $target_file = $target_dir . basename($_FILES["category_file"]["name"]);
 
        move_uploaded_file($_FILES['category_file']['tmp_name'], $target_file);
        $excel->read($target_file);

        
        }
        $sheet=$excel->sheets[0];
	$x = 5;
        
	while($x <= $sheet['numRows']) {
            if($sheet['cells'][$x][1]!=''){
 
                $insertion['CATEGORY'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][2]));
                $insertion['mm_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($sheet['cells'][$x][3]));
                
                $check_query=$database->mysqlQuery("select lmc.mm_categoryid FROM tbl_language_menu_main lmc 
                                                    left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = lmc.mm_categoryid where lmc.mm_lang_id='".$_SESSION['idrr']."' and mc.mmy_maincategoryname=TRIM('".$insertion['CATEGORY']."')");  
                $num_check_query  = mysqli_num_rows($check_query);
		if($num_check_query)
		{
                    $update_query=$database->mysqlQuery("update tbl_language_menu_main lmc, tbl_menumaincategory mc set lmc.mm_name='".$insertion['mm_name']."' where lmc.mm_lang_id='".$_SESSION['idrr']."' and lmc.mm_categoryid = mc.mmy_maincategoryid and   mc.mmy_maincategoryname =TRIM('".$insertion['CATEGORY']."')");
                    //echo "update tbl_language_menu_main lmc, tbl_menumaincategory mc set lmc.mm_name='".$insertion['mm_name']."' where lmc.mm_lang_id='".$_SESSION['idrr']."' and lmc.mm_categoryid = mc.mmy_maincategoryid and  mc.mmy_maincategoryname =TRIM('".$insertion['CATEGORY']."')";
                }
                else{
                $querylang1=$database->mysqlQuery(" INSERT INTO  tbl_language_menu_main  (mm_lang_id,mm_categoryid, mm_name)
                                                   SELECT '".$_SESSION['idrr']."',mc.mmy_maincategoryid,'".$insertion['mm_name']."' FROM tbl_menumaincategory mc where mc.mmy_maincategoryname=TRIM('".$insertion['CATEGORY']."')");    
//                                echo "INSERT INTO  tbl_language_menu_main  (mm_lang_id,mm_categoryid, mm_name)
//                                                   SELECT '".$_SESSION['idrr']."',mc.mmy_maincategoryid,'".$insertion['mm_name']."' FROM tbl_menumaincategory mc where mc.mmy_maincategoryname=TRIM('".$insertion['CATEGORY']."')";                                                                                           
            
                }
                //print_r($insertion);
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
    //echo $cat1,$catid1,$catid4;
    
    
    
    
    $querylang=$database->mysqlQuery("select mm_categoryid from tbl_language_menu_main where mm_categoryid='".$catid1."' and mm_lang_id='". $_SESSION['idrr']."'");
    $num_gen9  = mysqli_num_rows($querylang);
		  if($num_gen9)
		  {
    
   
    $querylang1=$database->mysqlQuery("update tbl_language_menu_main set mm_name='".$cat1."' where mm_categoryid='".$catid1."' and mm_lang_id='".$_SESSION['idrr']."'");
        }else
    {
         $insertion['mm_lang_id'] =  $_SESSION['idrr'];
         $insertion['mm_name'] = $cat1;
          $insertion['mm_categoryid'] = $catid1;
          $insertid = $database->insert('tbl_language_menu_main', $insertion);
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
<title>Category</title>
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
                                      
                                    <li class="als-item"><a href="multi_language.php" class="new_tab_btn">Menu Name</a></li>
                                  
                                    <li class="als-item"><a href="menucategory_language.php" class="new_tab_btn active_btn_1">Menu Category</a></li>
                                       
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
                   
                   		<div class="main_banquet_contant_head" style="line-height: 20px;">
                        	
                            <div class="main_banquet_form_box" style="width: 100%">
                                    <div class="main_banquet_form_textbox" style="width: 50%;padding-left: 0" >
                                        <span style="width: 100%">Select Language</span>
                                        <select id="selectedlang" name="selectedlang" onchange="changeof()" class="main_banquet_form_textbox_input" style="border-radius: 5px;height:35px;font-size:15px;width: 45%;">                  
                                            <option hidden="" id="dft"><?=$lang?></option>
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
                                    <button style="width: 160px;padding: 7px 7px;font-size: 13px;float: left;margin-left: 2%" id="category_to_excel">CATEGORY DOWNLOAD</button>
                                    </div>
                                <form method="post" name="multilanguage_category_upload" enctype='multipart/form-data'>
                                    <div style="width: 50%;padding-left: 0;" class="main_banquet_form_textbox">
                                         <span style="width: 100%;">Upload Category</span>
                                    <input type="file" id="category_file" name="category_file"  class="main_banquet_form_textbox_input" style="border-radius: 5px;height:35px;font-size:15px;width:45%;padding: 4px">
                                
                                    <button style="width: 160px;padding: 7px 7px;font-size: 13px;float: left;margin-left: 2%" type="submit" id="category_to_db">CATEGORY UPLOAD</button>
                                </div>
                                
                                 </form>
                                </div>
<!--                              <div style="margin-left:1%;width:10%;margin-top: 4px;" class="search_btn_member_invoice"><a href="#" id='submitlang'>Submit</a></div>  -->
                        </div>
                             
                        	<div class="main_banquet_contant" style="padding-top:0">
                            		<div id="left_table_scr_cc">
                                    <table class="responstable">  
                                        <thead>
                                         <tr>
                                         	<th style="min-width:50px;">Edit</th>
                                         	<th>Category Name-English</th>
                                                <th>Category Name-<span id="newlang"><?=$lang?> </span></th>
                                             
                                             
                                              </tr>
                                        </thead>
                                        <tbody>
                                 
                                                   
                                           <?php        
                                                     $sql_login1  =  $database->mysqlQuery("select c.mmy_maincategoryid,c.mmy_maincategoryname,
(select m.mm_name from tbl_language_menu_main m  where m.mm_categoryid = c.mmy_maincategoryid and m.mm_lang_id ='".$_SESSION['idrr']."' )as name_lang  
from tbl_menumaincategory c order by c.mmy_maincategoryname"); 
				$num_login1  = $database->mysqlNumRows($sql_login1);
				if($num_login1){
					while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
					  {
                                            
                                        
                                               ?>   
                                                 <tr>
                                                     <td style="min-width:50px;">
                                                         <a href="#" style="display:block" class="edit_list text1" id="edtbtn<?=$result_login1['mmy_maincategoryid']?>" onclick="edit_click('<?=$result_login1['mmy_maincategoryid']?>')"  ><img src="images/edit_page.PNG"></a>
                                                         <a href="#" style="display:none" class="edit_list" id="savebtn<?=$result_login1['mmy_maincategoryid']?>" onclick="save_click('<?=$result_login1['mmy_maincategoryid']?>')"  ><img src="img/save_ico.png"></a>
                                                   </td>

                                                   <td ><?=$result_login1['mmy_maincategoryname']?></td>
                                                   
                                               <td ><div style="display:block" id="catnameshow<?=$result_login1['mmy_maincategoryid']?>"><?=$result_login1['name_lang']?></div>
                                                   <div id="catnameedit<?=$result_login1['mmy_maincategoryid']?>" style="display:none"> <input type="text" style="text-align:left;padding-left:10px" class="language_textbx txt1" name="catnamefield" id="catnamefield<?=$result_login1['mmy_maincategoryid']?>"  > </div></td>
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

<!---banquet_listting_edit_popup-->
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script>
 $('#category_to_excel').click(function(){
    
    window.location="multi_language_menu_download.php?category_to_excel=";
    
});
$('#category_to_db').click(function(){
    
    if($('#category_file').val()==''){
        $('.alert_error_popup_all_in_one').show();
                                    
                        $('.alert_error_popup_all_in_one').text('PLEASE CHOOSE FILE');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
        $('#category_file').css('border','2px solid red');
        return false;
        
        
        
    }
    else{
        
        
        if($('#category_file').val().includes(".xls")){
          $('#category_file').removeAttr('border');  
            return true;
        }
        else{
            alert('Incorrect File Format');
            $('#category_file').css('border', '2px solid red');
            return false;
            $('#category_file').focus();
             
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
        url: "menucategory_language.php",
        data: datastringnew1,
        success: function(data)
        {
        

         //alert(data);
        }
    });
    location.reload();
   }
  
 
    
  
  
  function edit_click(a){
      
     var show123=$('#catnameshow'+a).html();
      $(".text1").addClass("disablegenerate");
          $('#catnameshow'+a).hide();
       $('#catnameedit'+a).show();
        $('#savebtn'+a).show();
         $('#edtbtn'+a).hide();
        $('#catnamefield'+a).val(show123);
       $('#catnamefield'+a).focus();
       
     
    }



   function save_click(b){
    
     var itemname=$('#catnamefield'+b).val();
     var fitem= itemname.trim( );
   //alert(fitem);
     var catsh=$('#catnameshow'+b).html();
  //     var hid=$('#selectedlang').val();
//     var hid1=hid.split("_");
        $('#catnameshow'+b).show();
       $('#catnameedit'+b).hide();
        $('#savebtn'+b).hide();
         $('#edtbtn'+b).show();
       
       var datastringnew="set=cat1&item1="+fitem+"&idofcat="+b+"&catsh="+catsh;
       
       $.ajax({
        type: "POST",
        url: "menucategory_language.php",
        data: datastringnew,
        success: function(data)
        {
        

         //alert(data);
        }
    });
       
      location.reload();
       
   }
   
   
   
   
   

</script>


</body>
</html>