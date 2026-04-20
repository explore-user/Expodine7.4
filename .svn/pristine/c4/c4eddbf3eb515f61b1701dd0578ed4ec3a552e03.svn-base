<?php
//include('includes/session.php');		// Check session
session_start();
error_reporting(0);
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'excel_reader.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';

   if(isset($_REQUEST['value_hour'])&&($_REQUEST['value_hour']=="hour_insert")){
    
        $id_hour=$_REQUEST['hour_val'];
        
         $sql_login  =  $database->mysqlQuery("select * from tbl_sms_hourly_settings"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             $querylang1=$database->mysqlQuery("update tbl_sms_hourly_settings set sht_hour_base='".$id_hour."'"); 
          }else{
             $querylang1=$database->mysqlQuery("Insert into tbl_sms_hourly_settings(sht_id,sht_hour_base) values('1','".$id_hour."')"); 
          }
    }
    
    if(isset($_REQUEST['value_time'])&&($_REQUEST['value_time']=="time_insert")){
           $id_time=$_REQUEST['time_val'];
           
           $querylang1=$database->mysqlQuery("Insert into tbl_sms_time_settings(tsr_time) values('".$id_time."')"); 
           
    }
    
    if(isset($_REQUEST['value_time_del'])&&($_REQUEST['value_time_del']=="time_delete")){
           $id_time_del=$_REQUEST['time_val_del'];
           
           $querylang1=$database->mysqlQuery("Delete from tbl_sms_time_settings where tsr_time='".$id_time_del."' "); 
           
    }
    
    
    
    

?>

<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Sms</title>
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

.Switcher {
  position: relative;
  display: flex;
  border-radius: 5em;
  box-shadow: inset 0 0 0 1px;
  overflow: hidden;
  cursor: pointer;
  -webkit-animation: r-n .5s;
          animation: r-n .5s;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  font-size: 3vmin;
  will-change: transform;
}
.Switcher__checkbox:checked + .Switcher {
  -webkit-animation-name: r-p;
          animation-name: r-p;
}
@-webkit-keyframes r-p {
  50% {
    -webkit-transform: rotateY(45deg);
            transform: rotateY(45deg);
  }
}
@keyframes r-p {
  50% {
    -webkit-transform: rotateY(45deg);
            transform: rotateY(45deg);
  }
}
@-webkit-keyframes r-n {
  50% {
    -webkit-transform: rotateY(-45deg);
            transform: rotateY(-45deg);
  }
}
@keyframes r-n {
  50% {
    -webkit-transform: rotateY(-45deg);
            transform: rotateY(-45deg);
  }
}
.Switcher::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  width: 200%;
  border-radius: inherit;
  -webkit-transform: translateX(-75%);
          transform: translateX(-75%);
  transition: -webkit-transform .5s ease-in-out;
  transition: transform .5s ease-in-out;
  transition: transform .5s ease-in-out, -webkit-transform .5s ease-in-out;
}
.Switcher__checkbox:checked + .Switcher::before {
  -webkit-transform: translateX(25%);
          transform: translateX(25%);
}

.Switcher__trigger {
  position: relative;
  z-index: 1;
    font-size: 16px;
  padding: 15px 50px;
  background-color: #fff;
  color: #333;
}
.Switcher__trigger::after {
  content: attr(data-value);
}
.Switcher__trigger::before { 
  content: attr(data-value);
  position: absolute;

  transition: opacity .3s;

  
}
.Switcher__checkbox:checked + .Switcher .Switcher__trigger::before {
 
}
.Switcher__trigger:nth-of-type(1)::before {
 
}
.Switcher__trigger:nth-of-type(2)::before {
 
}

.sr-only {
  position: absolute;
  width: 1px;
  height: 1px;
  padding: 0;
  margin: -1px;
  overflow: hidden;
  clip: rect(0, 0, 0, 0);
  border: 0;
}

.box {
  display: flex;
  flex: 1;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  overflow: hidden;
  -webkit-perspective: 750px;
          perspective: 750px;
}

*,
*::before,
*::after {
  box-sizing: border-box;
}

html {
  height: 100%;
}

body {
  display: flex;
  flex-direction: column;
  min-height: 100%;
  margin: 0;
  line-height: 1.4;
  color: #fff;
  background-color: #00a8ff;
}

.intro {
  width: 90%;
  max-width: 50rem;
  padding-top: .5em;
  padding-bottom: 1rem;
  margin: 0 auto 1em;
  font-size: calc(1rem + 2vmin);
  text-transform: capitalize;
  text-align: center;
  font-family: serif;
}
.intro small {
  display: block;
  text-align: right;
  opacity: .5;
  font-style: italic;
  text-transform: none;
  border-top: 1px dashed rgba(255, 255, 255, 0.75);
}

.info {
  margin: 0;
  padding: 1em;
  font-size: .9em;
  font-style: italic;
  font-family: serif;
  text-align: right;
  opacity: .75;
}
.info a {
  color: inherit;
}
    .top_timely_contant_sec input {
    display: none;
}
    .printer_add_text_boxes_cc input:focus ~ label, input:valid ~ label{top: 0;    color: #8a8a8a;}
    .act_tml_clr{   background-color: #890000;  color: #fff;}
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
                                    <li class="als-item"><a href="dayclose_sms_show_settings.php" class="new_tab_btn ">Dayclose SMS Settings </a></li>
                                <li class="als-item"><a href="timely_sms_settings.php" class="new_tab_btn active_btn_1">Timely SMS/Email Settings </a></li>
                                </ul>
             
            
                    </div>
                        </div>
                   </div>
                         
                        	<div class="main_banquet_contant" style="padding-top:0">
                            		<div id="left_table_scr_cc">
                                    
                                        <div class="top_timely_toggle_sec">
                                            <div class="box">
                                                
<!--                                              <input class="Switcher__checkbox sr-only" id="io" type="checkbox" />-->
                                              <label class="Switcher" for="io">
                                                  <div style="display:none" id="hourclick" class="Switcher__trigger " data-value="Hourly"></div>
                                                  <div id="timeclick" class="Switcher__trigger act_tml_clr" data-value="Timely"></div>
                                              </label>
                                            </div>
                                        </div>
                                        
                                        <div class="top_timely_contant_sec_cc">
                                            <span style="width:100%;height: auto;left:0;    position: absolute;"><strong style="color:darkred;width: 100%;font-size: 15px;" id="show_msg"></strong></span>
                                            <div style="display:none" class="top_timely_contant_sec" id="hour_view">
                                                <?php
                                                
                    $sql_sms_show  =  $database->mysqlQuery("select * from tbl_sms_hourly_settings "); 
                    $num_sms_show  = $database->mysqlNumRows($sql_sms_show);
                    if($num_sms_show){
                        while($result_sms_show  = $database->mysqlFetchArray($sql_sms_show)) 
                        {
                          $hour_in= $result_sms_show['sht_hour_base']; 
                        }
                    }
                                                
                                                ?>
                                                 
                                                <div class="timely_selct_box_cc">
                                                  
                                                   <?php for($i=1;$i<=12;$i++) { ?> 
                                                <div  class="timely_selct_box">
                                                    <input id="chk<?=$i?>" class="hour_active" value="<?=$i?>" <?php if($hour_in==$i){ ?> checked  <?php } ?> onclick="return hour_in(<?=$i?>);" type="checkbox" /><label for="chk<?=$i?>"><?=$i?> Hour</label>
                                                </div>
                                                   <?php } ?>
                                                
                                                </div>  
                                                
                                            </div>  
                                            
                                            
                                            <div id="time_view" class="top_timely_contant_sec" style="display:block">
                                                
                                                <div class="timely_selct_box_cc">
                                                    
                                                <?php
                                                
                        $time_in=  array();                        
                       $sql_sms_show1  =  $database->mysqlQuery("select * from tbl_sms_time_settings "); 
                    $num_sms_show1  = $database->mysqlNumRows($sql_sms_show1);
                    if($num_sms_show1){
                        while($result_sms_show1  = $database->mysqlFetchArray($sql_sms_show1)) 
                        {
                          $time_in[]= $result_sms_show1['tsr_time']; 
                        }
                    }
                                             
                                                for($t=1;$t<=24;$t++) {
                                                    
                                                    if($t>9){
                                                        $a="";
                                                        
                                                    }  else {
                                                    $a=0;    
                                                    }
                                                    ?> 
                                                   
                                                <div  class="timely_selct_box">
                                                    <input id="chkt<?=$t?>" onclick="return time_in(<?=$t?>);"  <?php if( in_array($a.$t.':00:00', $time_in)){ ?> checked  <?php } ?>   value="<?=$t?>:00:00" type="checkbox" /> <label for="chkt<?=$t?>" > <?=$t?>:00  <?php if($t>11 && $t!=24){ echo 'PM'; }else if($t<12){ echo 'AM'; }else if($t==24){ echo 'AM' ;}?> </label>
                                                </div>
                                                   <?php } ?>
                                                    
                                                </div>  
                                                
                                            </div>  
                                        </div> 
                                        
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
    
    
    $('#hourclick').click(function(){
      $('#hourclick').addClass('act_tml_clr');
        $('#timeclick').removeClass('act_tml_clr');
        $('#hour_view').show();
         $('#time_view').hide();
        
    });
    
    
     $('#timeclick').click(function(){
      $('#hourclick').removeClass('act_tml_clr');
        $('#timeclick').addClass('act_tml_clr');
         $('#hour_view').hide();
         $('#time_view').show();
    });
    
  
   
  
   
});


  function hour_in(h){
       $('.hour_active').prop('checked',false); 
      $('#chk'+h).prop("checked",true);
      
      var ch_val=$('#chk'+h).val();
    
                        $.ajax({
			type: "POST",
			url: "timely_sms_settings.php",
			data: "value_hour=hour_insert&hour_val="+ch_val,
			success: function(msg)
			{            
                 $("#show_msg").show();
               var error_show=$('#show_msg');
	       error_show.text('UPDATED');	
	       $("#show_msg").delay(1000).fadeOut('slow');
		           
                        }
                       });
           
    }
    
    function time_in(t){
      
     
      if($('#chkt'+t).is(":checked")){
       
       var ct_val=$('#chkt'+t).val();
  
                        $.ajax({
			type: "POST",
			url: "timely_sms_settings.php",
			data: "value_time=time_insert&time_val="+ct_val,
			success: function(msg)
			{           
                         $("#show_msg").show();
               var error_show=$('#show_msg');
	       error_show.text('UPDATED');	
	       $("#show_msg").delay(1000).fadeOut('slow');
                        }
                       });
       
      }else{
          
           $('#chkt'+t).prop("checked",false);
           
           var ct_val1=$('#chkt'+t).val();
  
                        $.ajax({
			type: "POST",
			url: "timely_sms_settings.php",
			data: "value_time_del=time_delete&time_val_del="+ct_val1,
			success: function(msg)
			{           
                             $("#show_msg").show();
               var error_show=$('#show_msg');
	       error_show.text('UPDATED');	
	       $("#show_msg").delay(1000).fadeOut('slow');       
                        }
                       });
      }
    
      
      
           
    }

</script>


</body>
</html>