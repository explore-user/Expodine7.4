
<?php
error_reporting(0);
session_start();
include("database.class.php"); 
$database	= new Database();

?>
<html> 

<head>
   <link rel="shortcut icon" href="img/favicon.ico">
    <title>TROUBLESHOOT</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>.dayalready_closed_popup{z-index: 99999 !important}
        body{float: none !important;position: inherit !important;width: inherit !important;padding: 0  !important}
        .reset_popup {
    width: 370px;
    height: auto;
    position: absolute;
    z-index: 99999;
    background-color: #fff;
    left: 0;
    right: 0;
    margin: auto;
    border-radius: 8px;
    top: 15%;
}

     .reset_acc_popup {
    width: 370px;
    height: auto;
    position: absolute;
    z-index: 99999;
    background-color: #fff;
    left: 0;
    right: 0;
    margin: auto;
    border-radius: 8px;
    top: 15%;
}

.confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
		}
.confrmation_overlay_proce img{width:100px;height:100px;}	
.db_size_view_popup_cc{
    width:100%;
    height:100%;
    position:fixed;
    left:0;
    right:0;
    background-color: rgba(0,0,0,0.7);
    z-index:999;
}
.db_size_view_popup{
    width:600px;
    height:400px;
    position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    top: 15%;
    background-color: #fff;
    border-radius: 10px;
}
.db_size_view_popup_head{
    width: 100%;
    height: auto;
    float: left;
    padding: 10px 0;
    text-align: center;
    color: #242424;
    font-size: 20px;
    font-family: sans-serif;
    position:relative;
    padding-right:30px;
}
.db_size_view_popup_head_close{
    width:25px;
    height:25px;
    position:absolute;
    right:8px;
    top:10px;
    cursor:pointer;

}
.db_size_view_popup_contant{
    width: 100%;
    height: 340px;
    float: left;
    overflow: auto;
    padding:10px 20px;
}

.db_size_view_popup_contant table{
    width: 100%;
    height: auto;
    float: left;
}
.db_size_view_popup_contant thead td{
    padding: 5px;
    color: #242424;
    background-color: #e4e4e4;
    text-align: left;
    font-size: 15px;;
    border:solid 1px #e5e5e5;
}
.db_size_view_popup_contant tbody td{
    padding: 8px;
    color: #242424;
    background-color: #fff;
    text-align: left;
    font-size: 12px;
    font-family: sans-serif;
    border:solid 1px #e5e5e5;
}

.app_download_pop_sec{	
     width:100%;
	height:100%;
	position:fixed;
	z-index:999;
    left:0;
	background-color:rgba(0,0,0,0.8);
	top:0;}
    .app_download_pop{
        width:500px;
        height:380px;
        background-color:#fff;
        position:absolute;
        left:0;
        right:0;
        bottom:0;
        top:0;
        margin:auto;
        border-radius:10px;
        overflow:hidden;
    }
    .app_download_pop_cls{
        width:30px;height:30px;position:absolute;right:10px;top:10px;cursor:pointer;
    }
    .app_download_pop_cnt{
        width:100%;height:auto;float:left;
    }
.panel-content{background-color:#fff}
#lanipall strong{padding-left:10px}
.backto_table_select{border-radius:60px;margin-bottom:5px}
    </style>
   

<link href="css/take_away.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/require_status_style.css">
    <link rel="stylesheet" href="css/responsive.css">
<script src="js/jquery-2.1.3.min.js"></script>
 <script>             
   window.onload = function() {
    
    var auto_refresh = setInterval(
    function ()
    {
    var dataString = 'value=full_load';
        $.ajax({
            type: "POST",
            url: "load_printerstatus.php",
            data: dataString,
            success: function(data) {
                $('#printertbl').html(data);

            }
        });
        }, 1000);
    
    
}
</script>
</head>
<body>
<div style="display:none" class="confrmation_overlay_proce"></div>
    <input type="hidden" id="focusedtext" >

    <div class="main-content ng-scope" > 

<div class="heading-sec ng-scope">
	<div class="row">
		<div class="col-md-12 column">
			<div class="heading-profile">



             
            <div class="col-md-6">

            <h2 style="width:100%;text-align: left;font-weight:bold;padding-top: 00; margin-top: 0; font-size: 18px;">
                <a  href="troubleshoot.php">BACK</a>

</div>

            <div class="col-md-6">
            <span >
                         
           
                                  
                              
                                    
                            
                                    
                                
                                </span> 

                                </div>



                               
                           
                            
			</div>
		</div>
		
	</div>
</div><!-- Top Bar Chart -->

    </div>

    
    
<div class="col-md-12">
<div class="">


<div class="panel-content ng-scope">


		
		<div class="col-md-6">
        
                    <div id="statusreq">
                        
                      
                    </div>
                   
                  
                   
    
                    
        </div><!--col-md-6-->
        SYSTEM IP :  <?php echo  $localIP = getHostByName(getHostName()); ?>
       
       <div class="col-md-6">
         
           
            
           
           <div id="printertbl" style="font-weight:bold ">
             PRINTER DETAILS
           </div>
         
           
           <div class="col-md-12">
           
           <div class="float_widget_cc">
						
                        
                    </div>
                    
                                      </div>
                                      
        
	
 </div>  

 
</div>



<div id="dayrevertpopup" class="dayalready_closed_popup" style="display: none">
    <span class="dayalready_closed_popup_text">
    </span>
</div> 


<div class="change_pass_overlay"></div>

</div>
</div>




<style>
     .change_pass_overlay{
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 width:100%;
	 height:100%;
	 top:0;
	 left:0;
	 z-index:9;
	 display:none;
	 }
    </style>
    

</body>

</html>