<?php
//include('includes/session.php');		// Check session
session_start();
error_reporting(0);
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'excel_reader.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';

   if(isset($_REQUEST['set'])&&($_REQUEST['set']=="show_on_off")){
    
        $id=$_REQUEST['id'];
        $status=$_REQUEST['status'];
        $querylang1=$database->mysqlQuery("update tbl_sms_report_settings  set ss_show='".$status."',ss_last_updated=NOW(),ss_updated_login='".$_SESSION['expodine_id']."' where ss_id='".$id."'");
   
    }
    if(isset($_REQUEST['set'])&&($_REQUEST['set']=="show_on_off_timely")){
    
        $id1=$_REQUEST['id_timely'];
        $status1=$_REQUEST['status_timely'];
        $querylang1=$database->mysqlQuery("update tbl_sms_report_settings  set ss_timely_report_show='".$status1."', ss_last_updated_timely=NOW(),ss_timely_update_login='".$_SESSION['expodine_id']."' where ss_id='".$id1."'");
   
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
                                      
                                    <li class="als-item"><a href="dayclose_report_settings.php" class="new_tab_btn">Dayclose Report Settings </a></li>
                                    <li class="als-item"><a href="dayclose_sms_show_settings.php" class="new_tab_btn active_btn_1">Dayclose SMS Settings </a></li>
                                <li class="als-item"><a href="timely_sms_settings.php" class="new_tab_btn">Timely SMS/Email Settings </a></li>
                                </ul>
             
            
                    </div>
                        </div>
                   </div>
                        
                   
                   		
                             
                        	<div class="main_banquet_contant" style="padding-top:0">
                            		<div id="left_table_scr_cc">
                                    <table class="responstable">  
                                        <thead>
                                         <tr>
                                         	
                                         	<th>Sl No</th>
                                                <th>Data In SMS</th>
                                                <th>Show in Dayclose</th>
                                                 <th>Show in Timely</th>
                                                
                                               
                                             
                                              </tr>
                                        </thead>
                                        <tbody>
                                 
                                                   
                                           <?php        
                                                $sql_login1  =  $database->mysqlQuery("select * from tbl_sms_report_settings "); 
                                                $num_login1  = $database->mysqlNumRows($sql_login1);
                                                if($num_login1){ $i=0;
                                                        while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
                                                          {
                                                                $i++;
                                        
                                               ?>   
                                                    <tr>
                                                        <td width="5%"><?=$i?></td>
                                                        <td width="30%"><?=$result_login1['ss_label']?></td>
                                                        <td width="20%" style="position: relative"><input type="checkbox" class="show_off_on"  id="<?=$result_login1['ss_id']?>" <?php if($result_login1['ss_show']=='Y') { ?> checked <?php } ?>><span id="updated_status_<?=$result_login1['ss_id']?>" style="position:absolute;right:20px;top:5px; color:red;">&nbsp; </span></td>
                                                    <td width="20%" style="position: relative"><input type="checkbox" class="timely_off_on"  id="<?=$result_login1['ss_id']?>" <?php if($result_login1['ss_timely_report_show']=='Y') { ?> checked <?php } ?>><span id="updated_status_timely<?=$result_login1['ss_id']?>" style="position:absolute;right:20px;top:5px; color:red;">&nbsp; </span></td>
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
$(document).ready(function(){
   $(".show_off_on").click(function(){
        var id=$(this).attr('id');
        if($(this).prop('checked')==true){
            var status='Y';
        }
        else{
            var status='N'
        }
        var dataString = 'set=show_on_off&id='+id+'&status='+status;
        $.ajax({
            type: "POST",
            url: "dayclose_sms_show_settings.php",
            data: dataString,
            success: function(data) {
                $('#updated_status_'+id).css('display','block');
                var rptstatuschk=$('#updated_status_'+id);
                rptstatuschk.text('Status Updated..');	
                $('#updated_status_'+id).delay(2000).fadeOut('slow');
            }
        });
         
        
   });
   
   
      $(".timely_off_on").click(function(){
        var id1=$(this).attr('id');
        if($(this).prop('checked')==true){
            var status1='Y';
        }
        else{
            var status1='N'
        }
        var dataString = 'set=show_on_off_timely&id_timely='+id1+'&status_timely='+status1;
       
        $.ajax({
            type: "POST",
            url: "dayclose_sms_show_settings.php",
            data: dataString,
            success: function(data) {
                $('#updated_status_timely'+id1).css('display','block');
                var rptstatuschk=$('#updated_status_timely'+id1);
                rptstatuschk.text('Status Updated..');	
                $('#updated_status_timely'+id1).delay(2000).fadeOut('slow');
            }
        });
         
        
   });
   
   
   
});


  
   

</script>


</body>
</html>