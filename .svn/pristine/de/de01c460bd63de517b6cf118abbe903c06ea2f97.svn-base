<?php
//include('includes/session.php');		// Check session
session_start();
error_reporting(0);
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'excel_reader.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';

   if(isset($_REQUEST['set'])&&($_REQUEST['set']=="cat1")){
    
    $id=$_REQUEST['id'];
    $print=$_REQUEST['print'];
    $email=$_REQUEST['email'];
    
    $querylang1=$database->mysqlQuery("update tbl_reportmaster  set rm_printa4='".$_REQUEST['a4_mode']."', rm_daycloseprint='".$print."',rm_dayclosemail='".$email."' where rm_id='".$id."'");
   
}

?>

<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Dayclose</title>
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
    height: 84vh;}
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
					<li><a style="cursor:pointer"> </a></li>
            		
				</ul>
			</div><!-- breadcrumbs -->
                <div class="content-sec">
                
                	<div class="mlt_language_contant_cc">
                    
                    	<div style="  border: 1px #B6B6B6 solid;" class="cc_new">
                       	<div id="lista1" class="als-container">
                            <div class="als-viewport" style="width:100% !important">
                                
                                <ul class="als-wrapper">
                                      
                                    <li class="als-item"><a href="dayclose_report_settings.php" class="new_tab_btn active_btn_1">Dayclose Report Settings </a></li>
                                    <li class="als-item"><a href="dayclose_sms_show_settings.php" class="new_tab_btn">Dayclose SMS Settings </a></li>
                                     <li class="als-item"><a href="timely_sms_settings.php" class="new_tab_btn">Timely SMS/Email Settings </a></li>
                                     
                                     <span style="color:#cd0000;font-weight: bold;font-size: 13px"> &nbsp;&nbsp; ** Thermal Print is ON if A4 print is OFF **</span>
                                     
                                </ul>
             
            
                    </div>
                        </div>
                   </div>
                        
                   
                   		
                             
                        	<div class="main_banquet_contant" style="padding-top:0">
                            		<div id="left_table_scr_cc">
                                    <table class="responstable">  
                                        <thead style="position:fixed;margin-top: -27px">
                                         <tr>
                                         	<th style="min-width:50px;">Edit</th>
                                                <th>Sl</th>
                                         	<th>Report Name</th>
                                                <th>Report Type</th>
                                                <th>Dayclose Print </span></th>
                                                  <th>A4 Print </span></th>
                                                <th>Email</th>
                                                
                                               
                                             
                                              </tr>
                                        </thead>
                                        <tbody>
                                 
                                                   
                                           <?php   $i=1;     
                                                     $sql_login1  =  $database->mysqlQuery("select * from tbl_reportmaster order by rm_reporttype asc "); 
				$num_login1  = $database->mysqlNumRows($sql_login1);
				if($num_login1){
					while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
					  {
                                            
                                        
                                               ?>   
                                                 <tr>
                                                     <td style="min-width:50px;">
                                                         <a href="#" style="display:block" class="edit_list text1" id="edtbtn<?=$result_login1['rm_id']?>" onclick="edit_click('<?=$result_login1['rm_id']?>')"  ><img src="images/edit_page.PNG"></a>
                                                         <a href="#" style="display:none" class="edit_list" id="savebtn<?=$result_login1['rm_id']?>" onclick="save_click('<?=$result_login1['rm_id']?>')"  ><img src="img/save_ico.png"></a>
                                                   </td>
                                                   
                                                     <td><?=$i++?></td>
                                                     <td><?=$result_login1['rm_reportname']?></td>
                                                   
                                                     <td><?=$result_login1['rm_reporttype']?></td>
                                                   
                                               <td >
                                                   <div style="display:block" id="printname<?=$result_login1['rm_id']?>"><?=$result_login1['rm_daycloseprint']?></div>
                                                   <div id="printnameedit<?=$result_login1['rm_id']?>" style="display:none"> 
<!--                                                       <input type="text" style="text-align:left;padding-left:10px" class="language_textbx txt1" name="daycloseprint" id="daycloseprint<?=$result_login1['rm_id']?>"  >-->
                                                       <select name="daycloseprint" id="daycloseprint<?=$result_login1['rm_id']?>" >
                                                           <option value="Y">Yes</option>
                                                            <option value="N">No</option>
                                                           
                                                       </select>
                                                   </div>
                                               </td>
                                               
                                               <?php 
                                                 
                                               if($result_login1['rm_printa4']=='N'){
                                                   
                                                   $a4print='Y';
                                               }else{
                                                   
                                                     
                                                   $a4print='N';
                                                   
                                               }
                                               
                                               ?>
                                               
                                              <td ><div style="display:block" id="a4<?=$result_login1['rm_id']?>"><?=$a4print?></div>
                                                <div id="a4_edit<?=$result_login1['rm_id']?>" style="display:none"> 
                                      
                                                <select name="a4_mode" id="a4_mode<?=$result_login1['rm_id']?>" >
                                                    
                                                   <option value="Y">Yes</option>
                                                   <option value="N">No</option>
                                                          
                                                </select>
                                                </div>
                                               
                                              </td>
                                              
                                              
                                              <td ><div style="display:block" id="emailname<?=$result_login1['rm_id']?>"><?=$result_login1['rm_dayclosemail']?></div>
                                                   <div id="emailnameedit<?=$result_login1['rm_id']?>" style="display:none"> 
<!--                                                       <input type="text" style="text-align:left;padding-left:10px" class="language_textbx txt1" name="daycloseemail" id="daycloseemail<?=$result_login1['rm_id']?>"  > -->
                                                   <select name="daycloseemail" id="daycloseemail<?=$result_login1['rm_id']?>" >
                                                       
                                                            <option value="Y">Yes</option>
                                                            <option value="N">No</option>
                                                               
                                                           
                                                   </select>
                                                   </div>
                                               
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
</div>
</div>


<div class="md-overlay"></div>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script>



  
  function edit_click(a){
      
     var show123=$('#printname'+a).html();
     $('#daycloseprint'+a).val(show123);
     
       
       
       
      $(".text1").addClass("disablegenerate");
      
          $('#printname'+a).hide();
       $('#printnameedit'+a).show();
       
       
        var show1=$('#emailname'+a).html();
        
        $('#daycloseemail'+a).val(show1);
       
       
        $('#emailname'+a).hide();
       $('#emailnameedit'+a).show();
       
       
        var a41=$('#a4'+a).html();
      
       $('#a4_mode'+a).val(a41);
      
      
      $('#a4'+a).hide();
       $('#a4_edit'+a).show();
      
       
       $('#daycloseprint'+a).focus();
        $('#savebtn'+a).show();
         $('#edtbtn'+a).hide();
         
    }

   function save_click(b){
     
      
     var itemname=$('#daycloseprint'+b).val();
     var print= itemname.trim( );
     
     var itemname1=$('#daycloseemail'+b).val();
     var email= itemname1.trim( );
     
        $('#printname'+b).show();
       $('#printnameedit'+b).hide();
       
       $('#emailname'+b).show();
       $('#emailnameedit'+b).hide();
       
        $('#a4'+b).show();
       $('#a4_edit'+b).hide();
      
       
        $('#savebtn'+b).hide();
         $('#edtbtn'+b).show();
       
       var a4_mode1=$('#a4_mode'+b).val();
       var a4_mode= a4_mode1.trim( );
       
      if(a4_mode=='Y'){
          
          a4_mode='N';
      }else{
          a4_mode='Y';  
          
      }
      
      
       var datastringnew="set=cat1&print="+print+"&id="+b+"&email="+email+"&a4_mode="+a4_mode;
      
       $.ajax({
        type: "POST",
        url: "dayclose_report_settings.php",
        data: datastringnew,
        success: function(data)
        {
     //   alert(data);
        }
    });
        
      location.reload();
       
   }
   

</script>


</body>
</html>