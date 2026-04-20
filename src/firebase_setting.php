<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
require_once 'Classes/PHPExcel/IOFactory.php';
$_SESSION['pagid']=4;
use Google\Client;


if(isset($_REQUEST['set']) && $_REQUEST['set']=="test_whatsapp"){
    
    $num=$_SESSION['sms_whatsapp_list'];
   
     $var2= "Click: https://www.expodinereports.com/ebill/ebill.php?b_id=sgdf";
    
    $data = file_get_contents("https://bhashsms.com/api/sendmsg.php?user=ExploreITBW&pass=123456&sender=BUZWAP&phone=$num"
    . "&text=day_open_close12&priority=wa&"
    . "stype=normal&Params=Tested,Admin,Expodine");
      
      if (strpos($data, 'S.') !== false) {
        $msg5 = 'SENT';
      }else{
        $msg5 = 'ERROR';
      }
      
   
      
}



 if(isset($_REQUEST['set']) && $_REQUEST['set']=="test_firebase"){
 
     
     
    $a="8.8.8.8";
    exec("ping -n 1 -w 1 ".$a, $output, $result);
    if($result==0)
    {
       
        
     ///pushing msg///
    $branch_id_fire=$_SESSION['firebase_id'];
   
    require 'vendor/autoload.php';
   
    $client = new Client();
    $client->setAuthConfig('service_google.json'); // Replace with your file path
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

    $url = "https://fcm.googleapis.com/v1/projects/ed-reports-b5f94/messages:send";

    $projectId = 'ed-reports-b5f94'; 
 
    $data = [
    'message' => [
        
       "topic"=> $branch_id_fire,
        'notification' => [
            'title' => $_SESSION['s_branchname'].' : Test Notification',
            'body' => 'This is a test notification'
           
        ],
        'data' => [
            'key1' => 'value1',
            'key2' => 'value2'
        ],
        "android" =>[
      "ttl"=> "3600s" , // TTL in seconds (1 hour)
       "priority"=> "HIGH"     
    ],
        'apns' => [
        "headers"=>[
        "apns-expiration" => "2" ,// TTL for iOS
         "apns-priority"=> "10"         
      ],
            'payload' => [
                'aps' => [
                    'sound' => 'default', // Notification sound for iOS
                ],
            ],
        ],
    ]
   ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    if(curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo 'Response: ' . $response;
    }
    curl_close($ch);
   // echo $response;
   
    
    $body='TEST NOTIFICATION';
    //to database storage of msg//
    $data_to_firebase=urlencode($body);
    $url = $_SESSION['firebase_url']."api/post_notification?branhcid=$branch_id_fire&notification=$data_to_firebase";
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    //var_dump($result);
    
    }
        
}



if(isset($_REQUEST['delete']))
{
   $id=$_REQUEST['id'];
if($_REQUEST['delete']=="yes")
	{
		$result=$database->mysqlQuery("UPDATE  tbl_firebase_notification_report SET  tf_active='Y' WHERE tf_id = '" .$_REQUEST['id']."'");
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_firebase_notification_report SET  tf_active='N' WHERE tf_id = '" .$_REQUEST['id']."'");
	}
	// header("location:feedback.php?msg=3");
		 if (!headers_sent())
    {    
        header('Location: firebase_setting.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="firebase_setting.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=firebase_setting.php?msg=3" />';
        echo '</noscript>'; exit;
    }
}


$alert="";
if(isset($_REQUEST['msg']))
{
	if($_REQUEST['msg']=="1")
	{
	$alert="Deleted...";
	}else if($_REQUEST['msg']=="2")
	{
	$alert="Added...";
	}else if($_REQUEST['msg']=="3")
	{
	$alert="Updated...";
	}
}
?>
<!doctype html>
<html ng-app="website">
<head>
<meta charset="utf-8">
<title>Firebase</title>
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
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.table_report thead th, td{padding-left:20px !important;}
.table_report td{text-align:left !important;padding-left:20px !important;}
.table_report td.feedbackdisplay{text-align:center !important;}
</style>
<script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
		jQuery(document).ready(function(){//portionams shtcds portionams_p shtcds_p
			$('#feedbackqstn').autocomplete({source:'autocomplete/find_keywords.php?type=feedbackqstn_q', minLength:1});
			$('#activesrch').autocomplete({source:'autocomplete/find_keywords.php?type=feedbackstatus_s', minLength:1});
		});
	</script>
    <link rel="stylesheet" href="css/jquery-ui-1.8.2.custom.css" />
<script>
$(document).ready(function(){
	$('.table_report tr').click(function() {
     	var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		$('.table_report tr').removeClass('table_active');
		$(this).addClass('table_active');
		$('#hiddenmenuid').val(selval);
    });
	$('.md-trigger_ing').click( function() { 
		var id_str   =  $(this).attr("id");
		 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		 $('.table_report tr').removeClass('table_active');
		$(this).parent().parent().addClass('table_active');
		$('#hiddenmenuid').val(selval);
		 $('.mynewpopupload').css("display","block"); 
			  $(".olddiv").addClass("new_overlay");
			  var menuid=$('#hiddenmenuid').val();
			  $.post("popup/ingredient_edit.php", {menu:menuid},
				  function(data)
				  {
				  data=$.trim(data);
				  
				  $('.mynewpopupload').html(data);
				  });  
	});
	$('.ui-corner-all').click( function() {
	validateSearch();
	});
	
$('.status_sel').click( function() { 

			var statuss="";
		  var ss=($(this).val());
		  if(ss=="Yes")
		  {
			  statuss="Y";
		  }else
		  {
			  statuss="null";
		  }
			 /*$('.status_sel:checked').prop("checked", false);
			 $(this).prop("checked", true);*/
			validateSearch();

	});	
	
});
</script>
<style>
.new_overlay{
	 width:100%;
	 height:100%;
	 background-color:rgba(0,0,0,0.8);
	 position:fixed;
	 z-index:999;
	 height: 100%;
	 }
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
					<li><a style="cursor:pointer">Firebase</a></li>
            <?php if(isset($_REQUEST['msg'])){ ?>
            <div class="load_error alertsmasters"><?=$alert?></div>
			<script >
           $(".load_error").delay(2000).fadeOut('slow');
            </script>
            <?php } ?>
				</ul>
            
			</div><!-- breadcrumbs -->
            
                <div class="content-sec">
                
                	<div style="  padding: 2px;" class="col-lg-12 col-md-12 main_cc">

                       <div class="cc_new_main">

                       <div style="  border: 1px #B6B6B6 solid;" class="cc_new">

                   </div><!--cc_new-->
                   
                 <div style="background:#fff; width:100%; height:auto; margin:0 0 5px 1px;padding-right:4px; border:1px #B6B6B6  solid;float:left">
                        
                            <div class="col-sm-2 nopadding" style="width: 24.666667% !important;">
                               
                                <div style="margin-left:2%;width: 300px;margin-top: -10px;margin-bottom: 5px;font-size: 20px;" class="search_btn_member_invoice filte_new_box_btn"><a href="#" >NOTIFICATION SETTINGS : <?=$_SESSION['firebase_id']?></a></div>
                                
                             
                                
                                <div onclick="test_notify();" style="margin-left:2%;width: 60%;margin-top: -10px;margin-bottom: 5px;font-size: 15px" class="search_btn_member_invoice filte_new_box_btn"><a style="background-color: #5a8b5a;" href="#" >SEND FIREBASE</a></div>
                               
                                
                                
                                <div onclick="test_whatsapp();" style="margin-left:2%;width: 60%;margin-top: -10px;margin-bottom: 5px;font-size: 15px" class="search_btn_member_invoice filte_new_box_btn"><a style="background-color: #5a8b5a;" href="#" >SEND WHATSAPP</a></div>
                               
                            </div>
                     <strong id="error_fire" style="float:right;color:red;font-size: 20px;display: none"></strong>
                        </div><!--form_group-->
                    	
                   <div class="col-md-12 add_btn_cc_2">
                       
                   </div>
                   <div class="col-md-12 contant_table_cc">
                        <table class="table_report scroll tablesorter"  width="100%" border="0" cellspacing="5" id="listall">
                            <thead>
                              <tr>
                                  <th style="width:10%">SL NO</th>
                                <th style="width:80%">N O T I F I C A T I O N</th>
                               
                                 <td style="width:10%">STATUS</td>
                              </tr>
                             </thead>
                                 <?php
	 $sql_login  =  $database->mysqlQuery("select * from tbl_firebase_notification_report"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ $i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ $i++;
			if($result_login['tf_active']=="Y")
				{
					$active="Yes";
				}else 
				{
					$active="No";
				}		
				
	 ?>
    				<tr id="ids_<?=$result_login['tf_id']?>"  class="select">
                                     <td style="width:10%"><?=$i?></td>
                                <td style="width:80%" ><?=$result_login['tf_report_head']?></td>
                               
                                  <td style="width:10%">
                               <?php if($result_login['tf_active']=="Y"){ ?>  
                                      <a  onClick="delete_confirm('ToNo','<?=$result_login['tf_id']?>')"  > <img src="img/black_tick.png" style="border:solid 3px lightgreen;cursor: pointer" width="25px" height="25px"></a>
                                 <?php } else{ ?>
                                      <a  onClick="delete_confirm('ToYes','<?=$result_login['tf_id']?>')"  > <img src="img/black_cross.png" style="border:solid 3px red;cursor: pointer" width="25px" height="25px"></a>
                                 <?php } ?>
                                 </td>
                              
                              </tr>
                               
                              <?php } } ?>
                        </table>
                   </div>
                     
                    </div><!--main_cc-->
                </div><!--main content-sec-->
		</div>
	</div>
</div>
</div><!--container-->
</div>
 
<div class="md-overlay"></div><!-- the overlay element -->
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/javascript">
    
    function test_whatsapp(){
     $("#error_fire").css("display","block");
                              $("#error_fire").text(" SENDING...");
                              $("#error_fire").css('color', 'black');
     var datastringnewcard="set=test_whatsapp";
      // alert(datastringnewcard);
        $.ajax({
        type: "POST",
        url: "firebase_setting.php",
        data: datastringnewcard,
        success: function(data)
        {      
        
                              $("#error_fire").css("display","block");
                              $("#error_fire").text('WHATSAPP NOTIFICATION SEND');
                              $("#error_fire").css('color', 'green');
                              $("#error_fire").delay(2000).fadeOut('slow');
        }  
       });    
}
    
    
function test_notify(){
    
                              $("#error_fire").css("display","block");
                              $("#error_fire").text(" SENDING...");
                              $("#error_fire").css('color', 'black');
                              
    
        var datastringnewcard="set=test_firebase";
        // alert(datastringnewcard);
        $.ajax({
        type: "POST",
        url: "firebase_setting.php",
        data: datastringnewcard,
        success: function(data)
        {      
         
                              $("#error_fire").css("display","block");
                              $("#error_fire").text("NOTIFICATION SEND");
                              $("#error_fire").css('color', 'green');
                              $("#error_fire").delay(2000).fadeOut('slow');
        }  
       });    
}


 function confirm_yes_new(){
     
    var status=  $('#confirm_pop_all').attr('status');
    
    var id=     $('#confirm_pop_all').attr('id1');
    
     if(status=="ToYes")
		{
                    
                              $("#error_fire").css("display","block");
                              $("#error_fire").text("NOTIFICATION ENABLED");
                              $("#error_fire").css('color', 'lightgreen');
                              $("#error_fire").delay(2000).fadeOut('slow');
                    
                   setTimeout(function(){
                   window.location="firebase_setting.php?id="+id+"&delete=yes";
               }, 1000); 
                    
		
                
                
                
		}else
		{
                  
                              $("#error_fire").css("display","block");
                              $("#error_fire").text("NOTIFICATION DISABLED");
                              $("#error_fire").css('color', 'red');
                              $("#error_fire").delay(2000).fadeOut('slow');
                  
                    setTimeout(function(){
                   window.location="firebase_setting.php?id="+id+"&delete=no";
               }, 1000);  
                    
               
		}
     
     
 }
			
  function delete_confirm(status,id)
  {
      
         $('#confirm_pop_all').show();
                
         $('#pop_head_com').text('CONFIRM STATUS CHANGE ?');
         
         $('#confirm_pop_all').attr('status',status);
         $('#confirm_pop_all').attr('id1',id);
      	
}	
			
			

</script>


<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
<script type="text/javascript" id="js">
$(document).ready(function() {
   $("#listall").tablesorter();
}); 
</script>

<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>