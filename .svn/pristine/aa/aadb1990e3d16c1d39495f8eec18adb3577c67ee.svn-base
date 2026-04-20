<?php
 
 include('includes/session.php'); // Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
$msg = "";
//error_reporting(0);
error_reporting(E_ALL & ~E_DEPRECATED);
$loc_in='';

if(isset($_REQUEST['set_loc']) && ($_REQUEST['set_loc']=="loc_manual")){
    
    $loc_in=$_REQUEST['loc'];
    
    $sql_smsattemt_updation  =  $database->mysqlQuery("update tbl_branchmaster set be_dbbackuplocation='".$loc_in."'");
            
}

$location_in_date='..\util\Dayclose_DB_Backup\Full_db_normal';

$files = scandir($location_in_date, SCANDIR_SORT_DESCENDING);

$newest_file = $files[0];

/////databasebackup////

if(isset($_REQUEST['set_backup']) && ($_REQUEST['set_backup']=="backup_manual")) {
    
        $locationdb="";
        $location=getcwd();
        $loc1=explode("www",$location);
        $bckname='\backup'.date("Y-m-d").'.sql';
        $bckname_arch='\backup_archive'.date("Y-m-d").'.sql';
        
        $wloc=$_SERVER['DOCUMENT_ROOT'];
        $wloc1=explode("www",$wloc);
        $wloc2= str_replace("/","\\", $wloc1[0]);
          
        $sql_db  =  $database->mysqlQuery("select be_dbbackuplocation  from tbl_branchmaster"); 
        $num_db   = $database->mysqlNumRows($sql_db);
        if($num_db){
            $result_dbloc  = $database->mysqlFetchArray($sql_db);
            $locationdb= $result_dbloc['be_dbbackuplocation'];										  
        }
        if(!is_dir($locationdb)){
         mkdir($locationdb , 0777,TRUE);   
        }
    
    }
   
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="img/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Backup</title>
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">
<!--<link href="css/app.css" rel="stylesheet" type="text/css">-->
<link href="bower_components/chosen/chosen.min.css" rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="mn/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="mn/css/demo.css" />
<link rel="stylesheet" type="text/css" href="mn/css/icons.css" />
<link rel="stylesheet" type="text/css" href="mn/css/component.css" />
<link rel="stylesheet" href="css/tabs_mn_master.css">
<link rel="stylesheet" type="text/css" href="css/turbotabs.css" />
<link rel="stylesheet" type="text/css" href="css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="css/report_styl.css" />
<style>.left_list_cc{height: 71vh;min-height: 498px !important}#container{top:54px !important}.backup_min_hieght{height: 86.5vh;}
.manual_db_bc_cc{width: 100%;height: auto;float: left;text-align: center}.manual_db_bc_head{width: 100%;height: auto;float: left;text-align: center;font-size: 18px;color: #333;padding-top: 30px;margin-bottom: 15px}
.manual_db_bc_input{width:300px;height: 35px;border: 0;border-bottom: 1px #ccc solid;font-size: 14px;background-color: transparent;display: inline-block}.manual_db_bc_btn{width: 100px;height: 35px;background-color: #c3633d;text-align: center;line-height: 35px;color: #fff;font-size: 14px;display: inline-block;cursor: pointer}
.manual_db_bc_input:focus{outline: none !important;}
</style>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="mn/js/modernizr.custom.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>

<script src="js/turbotabs.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#myTab').turbotabs({
        animation : 'ScrollUp',
        mode : 'vertical'
    }); 
}); 
</script>

 <link rel="stylesheet" href="css/jquery-ui.css">
 <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/style_date.css">

</head>
<body>

 <?php  include "includes/topbar.php"; ?>

 <?php include "includes/left_menu.php"; ?>
						
 <div  class="sitemap_cc">Database Backup</div>
    
<div id="container">  
<div class="col-md-12 main_contant_container nopaddding">
    <div class="col-lg-12 col-md-12 " style="padding-top:10px; padding-bottom:10px; background-color:rgb(208, 208, 208);">
        <div class="col-lg-12 col-md-12 nopadding" style="background-color:#FCFCFC;  margin-bottom: 10px; ">
            
            <div class="col-lg-12 col-md-12 backup_min_hieght" style="background-color:#f4f4f4;  border: 1px solid #BDBDBD;  " id="reportload">
                
                <div class="manual_db_bc_cc" style="display:none">
                    <div class="manual_db_bc_head">MANUAL DB BACKUP</div>
                    <?php
                    $sql_db1  =  $database->mysqlQuery("select be_dbbackuplocation  from tbl_branchmaster"); 
        $num_db1   = $database->mysqlNumRows($sql_db1);
        if($num_db1){
            $result_dbloc1  = $database->mysqlFetchArray($sql_db1);
            $loc_manual= $result_dbloc1['be_dbbackuplocation'];										  
        }
                    ?>
                    <input class="manual_db_bc_input" id="db_loc_manual" placeholder="D:/Location/Mybackup" value="<?=$loc_manual?>" type="text" autofocus >
                    <div class="manual_db_bc_btn" onclick="return submit_loc();">SUBMIT</div>
                </div>
                
                <form name="f_export" method="post">
            		<div class="creat_backup_to_cc">
                    	
                            <div style="display:block" class="creat_backup_sub_btn_cc">
                            
                                <a href="#" id="btn_export"><div style="width:450px;height: 100px;line-height: 100px;font-size: 35px;background-color: #619d6b" class="creat_backup_sub_btn">Click Me For Backup !</div></a> <br>
                                
                                <span style="margin-top:22px;display:none;font-size: 18px" class="blink-box" id="fad"></span>
                        </div>
                        
                        
                    </div>
                    </form>
            </div>
        
        </div>
    </div>
</div>
</div>
 
 
 
 <div id="overlay"></div>

<style>
#overlay {
    position: fixed;
    display: none;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.2); /* light overlay */
    z-index: 9999;
    pointer-events: all; /* block clicks */
}
</style>
 	
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<!--<script src="js/jquery.noty.js"></script>-->
<!-- library for making tables responsive -->
<!--<script src="bower_components/responsive-tables/responsive-tables.js"></script>-->
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>

<script src="mn/js/classie.js"></script>

<script src="mn/js/mlpushmenu.js"></script>

 <script>
	new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {
	type : 'cover'
	} );
                  
 </script>
        
 <script type="text/javascript">
	
    function submit_loc(){
        
          var loc=$('#db_loc_manual').val();
          var data="set_loc=loc_manual&loc="+loc;
     
        $.ajax({
        type: "POST",
        url: "database_backup.php",
        data: data,
        success: function(data1)
        {
           location.reload();
            
        }
       });      
         
  }             
                           
  $("#btn_export").click(function(){
      
        $("#fad").show();
        $("#fad").text('* Backup Saving in Util - Dayclose_DB_Backup - Folder. Please wait... *');
        $("#fad").delay(50000).fadeOut(600); 
        
        $("#overlay").show(); 
        
        var data="set_backup=backup_dayclose";
     
        $.ajax({
        type: "POST",
        url: "export/export.php",
        data:data,
        success: function(data1)
        {
            
            alert(data1);
            location.reload();
        }
    }); 
    
    
  });
               
            
        </script>
        
        
 <style>
.blink-box {
    width: 800px;
    height: 100px;
    background: red;
    color: white;
    text-align: center;
    line-height: 100px;
    font-weight: bold;
    animation: blink 1s infinite;
}

@keyframes blink {
    0%   { opacity: 1; }
    50%  { opacity: 0; }
    100% { opacity: 1; }
}  
        
 </style>
     
     
</body>
</html>

