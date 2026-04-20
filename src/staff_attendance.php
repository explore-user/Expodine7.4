<?php
//include('includes/session.php');		// Check session
session_start();
error_reporting(0);
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'excel_reader.php'; 
require_once 'Classes/PHPExcel/IOFactory.php';


   if(isset($_REQUEST['set'])&&($_REQUEST['set']=="set_att_staff")){
    
          $querylang1=$database->mysqlQuery("update tbl_attendance set status='".$_REQUEST['status']."',edit_count=(edit_count+1) where staff_id='".$_REQUEST['staff_id']."' and "
          . " month_id='".$_REQUEST['month_id']."'  and att_date='".$_REQUEST['att_date']."' "); 
            
    }
    
   
?>

<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Staff Attendance</title>
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
    
    <input type="hidden" id="staff_id" value="<?=$_REQUEST['id']?>"> 
    
    
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
  
    <div style="opacity: 0.6;pointer-events: none;">
 <?php  include "includes/topbar_master.php"; ?>
 <?php  include "includes/left_menu.php"; ?>
    </div>
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
                                      
                                    <li class="als-item"><a href="#" class="new_tab_btn" style="text-transform:uppercase"><?=$_REQUEST['name']?> ATTENDANCE &nbsp; &nbsp; (<?= date("F Y");?>)</a></li>
                                    
                                    
                     &nbsp;&nbsp;&nbsp;  <select name="month_id" id="month_id" required onchange="monthly()" style="height:25px;border: solid 2px;border-radius: 5px;">
                                        <option value="">Select Month</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                        </select>
                                    
                &nbsp;&nbsp; <select name="year_id" id="year_id" onchange="monthly()" style="height:25px;border: solid 2px;border-radius: 5px;">
                        <?php
                        $currentYear = date('Y');
                        $startYear   = 2026;           // change if needed
                        $endYear     = $currentYear+19; // future years if needed

                        for ($year = $startYear; $year <= $endYear; $year++) {
                            $selected = ($year == $currentYear) ? 'selected' : '';
                            echo "<option value='$year' $selected>$year</option>";
                        }
                        ?>
                        </select>

                     
                                    
                                  <a href="staff_master.php" style="position: fixed;top: 60px;right: 25px;
                                  padding: 8px 14px;background: darkred;color: #fff;
                                  border: none;border-radius: 4px;cursor: pointer;font-size: 14px;">BACK</a>
                                    
                                    
                                   </ul>
             
            
                   </div>
                   </div>
                   </div>
                         
                        	<div class="main_banquet_contant" style="padding-top:0">
                                    <div id="left_table_scr_cc" style="overflow: hidden;">
                                    
                                        <div class="top_timely_contant_sec_cc">
                                            <span style="width:100%;height: auto;left:0;    position: absolute;"><strong style="color:darkred;width: 100%;font-size: 15px;" id="show_msg"></strong></span>
                                            <div  class="top_timely_contant_sec" id="hour_view" style="padding:1px">
                                                <?php
                                                
                                                $month = date('m');
                                                $year  = date('Y');

                                                $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
              
           $sql_login  =  $database->mysqlQuery("select * from tbl_attendance where staff_id='".$_REQUEST['id']."' and  "
          . " month_id='$month' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
          if(!$num_login){                                  
                                                
              for($i=1;$i<=$days;$i++) {   
                  
               $querylang1=$database->mysqlQuery("INSERT INTO tbl_attendance(`staff_id`, `att_date`, `status`, `month_id`,year_id) VALUES "
               . " ('".$_REQUEST['id']."','".$year.'-'.$month.'-'.$i."','A','".$month."','$year')" ); 
               
              }                             
          }                                  
                                                
                                                
                                                $dates_in=array(); $day=''; $days_a=0; $days_p=0; $edt=array();
                                                $sql_cat_s  =  $database->mysqlQuery("select att_date,status,edit_count from tbl_attendance where staff_id='".$_REQUEST['id']."' "
                                                . " and month_id='$month' group by staff_id,att_date,month_id ORDER BY att_date DESC");
                                                $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
                                                if($num_cat_s){
                                                  while($result_cat_s  = $database->mysqlFetchArray($sql_cat_s)) 
                                                  { 
                                                       $day = substr($result_cat_s['att_date'], 8, 2);
                                                       $dates_in[$day] = $result_cat_s['status']; // store status

                                                       if($result_cat_s['status']=='P'){
                                                           
                                                           $days_p++;
                                                       }
                                                       
                                                       if($result_cat_s['status']=='A'){
                                                           
                                                           $days_a++;
                                                       }
                                                       
                                                       
                                                       $edt[$day]=$result_cat_s['edit_count'];
                                                       
                                                  }
                                                  }
                                           
                                                ?>
                                                 
                                                <div class="timely_selct_box_cc" style="width:95%">
                                                  
                                                   <?php for($i=1;$i<=$days;$i++) { $ct=str_pad($i, 2, '0', STR_PAD_LEFT); ?> 
                                                    
                                                    <div  class="timely_selct_box" style="width:17%;height: 50px; <?php if ($edt[$ct]>=2){?> border:solid 2px darkred; <?php } ?> ">
                                                    <input id="chk<?=$i?>" class="hour_active" <?php if (isset($dates_in[$ct]) && $dates_in[$ct] === 'P') { echo 'checked'; } ?> value="<?=$i?>"  onclick="att_in('<?=$year.'-'.$month.'-'.$i?>','<?=$i?>','<?=$edt[$ct]?>');" type="checkbox" />
                                                    <label style="left:30%" for="chk<?=$i?>"><?=$i?> </label>
                                                   </div>
                                                    
                                                   <?php }  ?>
                                                
                                                <div style="position: absolute;margin-top: 455px;margin-left: 30%;"> 
                                                 <strong>TOTAL DAYS: <?=$days?></strong>  &nbsp; &nbsp; | &nbsp; &nbsp;
                                                
                                                <strong>PRESENT DAYS: <?=$days_p?></strong>  &nbsp; &nbsp; | &nbsp; &nbsp;
                                                 
                                                <strong>ABSENT DAYS: <?=$days_a?></strong>
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
    
    
});


  function att_in(dt,h,edt){
      
    
     if(edt<2){
     
     
      var staff_id=$('#staff_id').val();
      var ch_val=$('#chk'+h).val();
      var month_id = new Date().getMonth() + 1;
      
      
          if ($('#chk'+h).is(':checked')) {
              
             var status='P';
             $('#chk'+h).prop("checked",true); 
             
            } else {
                
               $('#chk'+h).prop("checked",false);  
               
                var status='A';
                
            }
      
      
                        $.ajax({
			type: "POST",
			url: "staff_attendance.php",
			data: "set=set_att_staff&month_id="+month_id+"&staff_id="+staff_id+"&att_date="+dt+"&status="+status,
			success: function(msg)
			{            
                              location.reload();
		           
                        }
                       });
                       
        }else{
            
               $("#show_msg").show();
               var error_show=$('#show_msg');
	       error_show.text("CAN'T EDIT MORE THAN TWICE IN ATTENDANCE");	
	       $("#show_msg").delay(1500).fadeOut('slow');
               
               if ($('#chk'+h).is(':checked')) {
              
           
                 $('#chk'+h).prop("checked",false); 
             
               } else {
                
               $('#chk'+h).prop("checked",true);  
               
                
                
            }
               
               
        }
           
    }
    
   function monthly(){
      
      var month_id=$('#month_id').val();
      var staff_id=$('#staff_id').val();
      var year_id=$('#year_id').val();
      
      if(month_id!=''){
      
                        $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=staff_att_list&staff_id="+staff_id+"&month_id="+month_id+"&year_id="+year_id,
			success: function(msg)
			{            
                              $(".timely_selct_box_cc").html(msg);
                             
		           
                        }
                       });
                       
        }else{
            
           location.reload();
        }
           
    }

</script>


</body>
</html>