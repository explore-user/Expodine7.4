<!DOCTYPE html>
<?php
session_start();
include("..\database.class.php"); 
$database	= new Database();
error_reporting(0);
   include('../email/km_smtp_class.php');
 require_once('../Mailer/PHPMailerAutoload.php');
    
   if(isset($_REQUEST['sms_text_bday']) && ($_REQUEST['sms_text_bday']=="sms_bday")){
  
       
       
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
                $sms_number='';
		$sms_text="";
		$be_sms_username="";
		$be_sms_apipassword="";
		$be_sms_senderid="";
                $be_sms_domainid="";
                $be_sms_method='';
                $be_sms_priority='';
	         $sql_general =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
		  $num_general  = $database->mysqlNumRows($sql_general);
		  if($num_general)
		  {
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
					     $be_sms_username			=$result_general['be_sms_username'];
					     $be_sms_apipassword		=$result_general['be_sms_apipassword'];
				             $be_sms_senderid			=$result_general['be_sms_senderid'];
		                              $be_sms_domainid			=$result_general['be_sms_domainid'];
                                              $be_sms_priority                 =$result_general['be_sms_priority'];                                                                                                           $be_sms_priority			=$result_general['be_sms_priority'];
                                              $be_sms_method                  =$result_general['be_sms_method'];                                                                                                              $be_sms_method			        =$result_general['be_sms_method'];
                                                 
                                        }
		  }
                  
     $loy_qry1 = $database->mysqlQuery("select be_loyalty_greetings_anvy,be_loyalty_greetings_bday from  tbl_branchmaster");
          
    $num_loy1 = $database->mysqlNumRows($loy_qry1);
     if($num_loy1)
     {
         while($loyalty_listing1 = $database->mysqlFetchArray($loy_qry1))
         {
             $bday_msg=$loyalty_listing1['be_loyalty_greetings_bday'];
             $anvy_msg=$loyalty_listing1['be_loyalty_greetings_anvy'];
             
         }
         }
                  
                  
		
		if($_REQUEST['type']=="bday"){
		 $sms_text=$bday_msg."\n (".$_SESSION['s_branchname'].")";
                }
                else{
                     $sms_text=$anvy_msg."\n (".$_SESSION['s_branchname'].")";
                }
                 $sms_number=$_REQUEST['b_number'];
		
		$api_password=$be_sms_apipassword;
		$smstype = $be_sms_method; 
                $username=urlencode($be_sms_username);
		$sender=urlencode($be_sms_senderid);
		$message=urlencode($sms_text);
		$domain=urlencode($be_sms_domainid);
                $route=urlencode($be_sms_priority);
		
             
                
                $parameters="username=$username&api_password=$api_password&sender=$sender&to=$sms_number&priority=$route&message=$message";
		if($method=="POST")
		{
			$opts = array(
			  'http'=>array(
				'method'=>"$method",
				'content' => "$parameters",
				'header'=>"Accept-language: en\r\n" .
						  "Cookie: foo=bar\r\n"
			  )
			);
	
			$context = stream_context_create($opts);
	
			
		}
		else
		{
			$fp = fopen("http://$domain/pushsms.php?$parameters", "r");
		}
	
		$response = stream_get_contents($fp);
		fpassthru($fp);
		fclose($fp);
              
    
  }else{
      echo 'No Internet Connection';
  }

   }


 if(isset($_REQUEST['mail_text_bday'])&& ($_REQUEST['mail_text_bday']="mail_bday")){   
       
       $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
       
                $sql_general =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
		  $num_general  = $database->mysqlNumRows($sql_general);
		  if($num_general)
		  {
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
						 $be_mail_server			=$result_general['be_mail_server'];
						 $be_mail_port				=$result_general['be_mail_port'];
						 $be_mail_emailid			=$result_general['be_mail_emailid'];
						 $be_mail_password			=$result_general['be_mail_password'];
						 $be_mail_secure			=$result_general['be_mail_secure'];
						 $be_mail_from			        =$result_general['be_mail_from'];
					}
		  }
                  
		$emailto= $_REQUEST['b_mail'];
                
                
                
    $loy_qry11 = $database->mysqlQuery("select be_loyalty_greetings_anvy,be_loyalty_greetings_bday from  tbl_branchmaster");
          
    $num_loy11 = $database->mysqlNumRows($loy_qry11);
     if($num_loy11)
     {
         while($loyalty_listing11 = $database->mysqlFetchArray($loy_qry11))
         {
             $bday_msg1=$loyalty_listing11['be_loyalty_greetings_bday'];
             $anvy_msg1=$loyalty_listing11['be_loyalty_greetings_anvy'];
             
         }
         }
                
                
		if($_REQUEST['type']=="bday"){
                   $string=$bday_msg1."\n (".$_SESSION['s_branchname'].")";
                }else{
                   $string=$anvy_msg1."\n (".$_SESSION['s_branchname'].")";  
                }
                
		$mailtext_o = stripslashes($string);
		$mailtext = preg_replace("|\n|","<br>","$mailtext_o");
		$mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->SMTPSecure = $be_mail_secure;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );        
       
         $frompaidamount_credit_name="Expodine";      
        $mail->Host = $be_mail_server;
        $mail->SMTPAuth = true;
        $mail->Username = $be_mail_emailid;
        $mail->Password = $be_mail_password;
        $mail->Port = $be_mail_port;
        $mail->SetFrom($be_mail_from,$from_name);
        $mail->Subject = "EXPODINE ";
        $mail->Body = $mailtext;
        
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
        $emls=explode(",",$emailto);
		  $ctem=count($emls);
		  if($ctem==0)
		  {
		  		 $mail->AddAddress($emailto);
		  }else
		  {
			  for($k=0;$k<$ctem;$k++)
			  {
				 
                                   $mail->AddAddress($emls[$k]);
			  }
		  }   
        
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
          echo 'Message sent.';
           
        }
        
      }else{
      echo 'No Internet Connection';
  }    
}
   
   
?>
<html>
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon.png">

        <title> Loyalty</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="assets/plugins/morris/morris.css">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.min.js"></script>
        <style>
            .widget-style-2 i{padding: 20px 20px;}
            .bx-clr1 i{background: #ff8761 !important;color: #fff !important}
            .bx-clr2 i{background: #57bdde !important;color: #fff !important}
            .bx-clr3 i{background: #b198dc !important;color: #fff !important}
            .bx-clr4 i{background: #6dc7be !important;color: #fff !important}
            .widget-panel{padding: 20px 20px;}.widget-chart ul li { width: 24%;}
            .content-page > .content{margin-bottom: 8px}
            .inner-textbox-effect .checkbox-primary input:focus ~ label, input:valid ~ label{top: 0;font-size: 12px;}
            .send_greeting_btn{    background-color: #57bdde ; font-weight: 600;letter-spacing: 0.05em;padding:0.5% 2%;color: #fff;border-radius: 3px;font-size: 13px;}
            .card-box .nicescroll{overflow: hidden}
            .widget-panel{min-height: 100px}
            .loyalty_mgmt_head{width:350px;position:absolute;left:0;right:0;margin:auto;top: 13px;z-index: 9999;color: #000; font-size: 18px;}
        </style>


    </head>


    <body class="fixed-left">


        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
           <?php include( 'includes/header.php') ?>
            <!-- Top Bar End -->


            <div class="loyalty_mgmt_head" style="    font-size: 16px;">LOYALTY MANAGEMENT
                
                <div style="margin-top: -25px;    margin-left: 205px;">
                   <?php if(in_array("dinein", $_SESSION['menuarray'])) {    ?>
             
                    <a style="border: solid 1px ;padding: 3px;    border-radius: 5px; " href="../table_selection.php">DI </a>  &nbsp;  &nbsp;
                
                   <?php } if(in_array("take_away_", $_SESSION['menuarray'])) { ?>  
                
                     <a style="border: solid 1px ;padding: 3px;    border-radius: 5px; " href="../take_away_.php">TA </a>  &nbsp; &nbsp;
             
          <?php } if(in_array("counter_sales", $_SESSION['menuarray'])) { ?>
             
                     <a style="border: solid 1px ;padding: 3px ;    border-radius: 5px;" href="../counter_sales.php">CS </a> 
              
            <?php } ?>
                </div>   
                     
            </div>

           
                

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        <?php
                         $tot_visit="0";
                         $customer_no="0";
    $loy_qry12 = $database->mysqlQuery("select count(ly_id) as count,sum(ly_totalvisit) as totalvisit from tbl_loyalty_reg ");
    $num_loy2 = $database->mysqlNumRows($loy_qry12);
     if($num_loy2)
     {
         while($loyalty_listing2 = $database->mysqlFetchArray($loy_qry12))
         { 
           $customer_no=$loyalty_listing2['count'];
            $tot_visit=$loyalty_listing2['totalvisit'];
         }
         }
         
         $new_register="0";
         $cur_date=date('Y-m-d');
         
         $loy_qry112 = $database->mysqlQuery("select count(ly_id) as count from tbl_loyalty_reg where date(ly_entrydatetime)='".$cur_date."' ");
    $num_loy12 = $database->mysqlNumRows($loy_qry112);
     if($num_loy12)
     {
         while($loyalty_listing12 = $database->mysqlFetchArray($loy_qry112))
         { 
           $new_register=$loyalty_listing12['count'];
         }
         }  
         
         
         
        
        
         $loy_qry121 = $database->mysqlQuery("select sum(lob_redeem_amount) as total_redeem  from tbl_loyalty_pointadd_bill ");
    $num_loy21 = $database->mysqlNumRows($loy_qry121);
     if($num_loy21)
     {
         while($loyalty_listing21 = $database->mysqlFetchArray($loy_qry121))
         { 
             if($loyalty_listing21['total_redeem']>0){
           $tot_redeem=$loyalty_listing21['total_redeem'];
             }else{
                  $tot_redeem="0";
             }
          
         }
         }  
         
         
         ?>
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="widget-panel widget-style-2 bg-white bx-clr1">
                                    <i class="md md-attach-money text-primary"></i>
                                    <h2 class="m-0 text-dark counter font-600"><?=$customer_no?></h2>
                                    <div class="text-muted m-t-5">Total Customers</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="widget-panel widget-style-2 bg-white bx-clr2">
                                    <i class="fa fa-plus  text-pink"></i>
                                    <h2 class="m-0 text-dark counter font-600"><?=$new_register?></h2>
                                    <div class="text-muted m-t-5"> Registered Today</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="widget-panel widget-style-2 bg-white bx-clr3">
                                    <i class="md md-store-mall-directory text-info"></i>
                                    <h2 class="m-0 text-dark counter font-600"><?=$tot_redeem?></h2>
                                    <div class="text-muted m-t-5">Total Redeemed</div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="widget-panel widget-style-2 bg-white bx-clr4">
                                    <i class="md md-account-child text-custom"></i>
                                    <h2 class="m-0 text-dark counter font-600"><?=$tot_visit?></h2>
                                    <div class="text-muted m-t-5">Total Visits</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-5">
                        		<div class="card-box">
                        			<h4 class="text-dark header-title m-t-0">New Registered Users</h4>
                        			<p class="text-muted m-b-30 font-13">
							Last 10 Members			
									</p>
                        			
                        			<div class="nicescroll" style="height: 220px;">
	                        			<div class="table-responsive">
	                                        <table class="table table-actions-bar">	
												<thead>
													<tr>
														<th style="text-align:center">Name</th>
														<th style="text-align:center">Phone</th>
														<th style="text-align:center">Status</th>
														<th style="text-align:center">Entry Date</th>
													</tr>
												</thead>
												<tbody>
                                            <?php											
                                    $loy_qry1123 = $database->mysqlQuery("select * from tbl_loyalty_reg order by ly_entrydatetime desc limit 10");
                                $num_loy123 = $database->mysqlNumRows($loy_qry1123);
                                 if($num_loy123)
                                 {
                                     while($loyalty_listing123 = $database->mysqlFetchArray($loy_qry1123))
                                     { 
                                       $name=$loyalty_listing123['ly_firstname'].' '.$loyalty_listing123['ly_lastname'];
                                       $phone=$loyalty_listing123['ly_mobileno'];
                                     $mail=$loyalty_listing123['ly_emailid'];
                                      $status=$loyalty_listing123['ly_status'];
                                      $entry=$loyalty_listing123['ly_entrydatetime'];
                                     ?>
													
								<tr>
								<td><?=$name?></td>
								<td><?=$phone?></td>
                                                                <td><span  <?php if($status=="Active"){ ?> class="label label-success" <?php } else { ?>  class="label label-non_success"  <?php } ?> > <?=$status?></span></td> 
                                                                <td style="width:100px">
                                                                    <?=$entry?>
<!--                                                            <a href="#" class="table-action-btn"><i class="md md-edit"></i></a>
                                                            <a href="#" class="table-action-btn"><i class="md md-close"></i></a>-->
                                                        </td>
													</tr>
                                                                                                        
                                                                                                        
                                 <?php } } ?>
												</tbody>
											</table>
	                                    </div>
                                    </div>
                        		</div>
                        	</div>
                            
                            <div class="col-lg-4">
                        		<div class="card-box">
                        			<h4 class="text-dark header-title m-t-0 m-b-0">Alerts  
                                        
                                        
                                        
                                        <div class="checkbox checkbox-primary" style="margin:0;display:inline-block">
	                                        <input id="bday1" type="checkbox" checked>
	                                         <label for="checkbox2">
	                                              Birthday
	                                          </label>
	                                     </div>
                                                    <div class="checkbox checkbox-primary" style="margin:0;display:inline-block;margin-right:2%;">
                                            <input id="anvy1" type="checkbox" >
	                                         <label for="checkbox1">
	                                              Anniversary
	                                          </label>
	                                     </div>
                                        
                                    </h4>
                        			<span class="text-muted m-b-30 font-13">
                                                    This Week <span id="error_grt" style="color:darkred"></span>
                                                </span><br>
                                                <a onclick="return greetings();" style="text-align: center;width: 100%;display: inline-block;" href="#"><div class="send_greeting_btn" style="margin:5px 0;display:inline-block;margin-right:2%;">Send Greetings</div></a>
                        			
                        			<div id="birthday" class="nicescroll" style="height: 220px;">
	                        			<div class="table-responsive">
	                                        <table class="table table-actions-bar">	
						<thead>
						<tr>
							<th style="text-align:center">Name</th>
						<th style="text-align:center">Phone</th>
						<th style="text-align:center">Birthday</th>
						</tr>
						</thead>
						<tbody>
                                            	<?php
                                                $phone_ar=  array();
                                                $mail_ar=  array();
                                                $cr=date('Y-m-d');
                                              
                                           $cr_new =date("d",  strtotime($cr));     
                                                
                                 $cr7=date('Y-m-d', strtotime(' + 6 days'));
                                 
                                 $cr7_new= date("d",  strtotime($cr7));
                               
                                $loy_qry_b = $database->mysqlQuery("select  * from tbl_loyalty_reg where month(ly_birthdaydate)=month(now()) and DAY(ly_birthdaydate) between '".$cr_new."' and '".$cr7_new."'  order by ly_birthdaydate desc ");
                              
                                
                                $num_loy_b = $database->mysqlNumRows($loy_qry_b);
                                 if($num_loy_b)
                                 {
                                     while($loyalty_listing_b = $database->mysqlFetchArray($loy_qry_b))
                                     { 
                                         
                                         $name_b=$loyalty_listing_b['ly_firstname'].' '.$loyalty_listing_b['ly_lastname'];
                                         $phone_b=$loyalty_listing_b['ly_mobileno'];
                                         $bday_b=$loyalty_listing_b['ly_birthdaydate'];
                                         
                                         if($loyalty_listing_b['ly_mobileno']!=""){
                                         $phone_ar[]=$loyalty_listing_b['ly_mobileno'];
                                         }
                                         
                                         if($loyalty_listing_b['ly_emailid']!=""){
                                         $mail_ar[]=$loyalty_listing_b['ly_emailid'];
                                         }
                                           ?>         
                                                    <tr>
                                                        <td><?=$name_b?></td>
                                                        <td ><?=$phone_b?></td>
                                                        <td><span class="label label-danger"><?=$bday_b?></span></td> 
							</tr>
                                                                                                        
                                 <?php } }
                              
                                 $phone_str=implode(',',$phone_ar);
                                
                                 $mail_str=implode(',',$mail_ar);
                                 
                                 
                                 ?>    
                                 <input type="hidden" id="number_b" num_b="<?=$phone_str?>" mail_b="<?=$mail_str?>" >
                                
												</tbody>
											</table>
	                                    </div>
                                    </div>
                                    
                                    <div id="anniversary" class="nicescroll" style="height: 220px;display:none">
	                        			<div class="table-responsive">
	                                        <table class="table table-actions-bar">	
												<thead>
													<tr>
						<th style="text-align:center">Name</th>
						<th style="text-align:center">Phone</th>
						<th style="text-align:center">Anniversary</th>
													</tr>
												</thead>
												<tbody>
                                            	
                                                    
                                                    <?php
                                      $phone_ar_a=  array();
                                       $mail_ar_a=  array();              
                                                    
                                $cr_a=date('Y-m-d');
                                              
                                           $cr_new_a =date("d",  strtotime($cr_a));     
                                                
                                 $cr7_a=date('Y-m-d', strtotime(' + 6 days'));
                                 
                                 $cr7_new_a= date("d",  strtotime($cr7_a));
                                 
                                $loy_qry_a = $database->mysqlQuery("select  * from tbl_loyalty_reg where month(ly_anniversarydate)=month(now()) and DAY(ly_anniversarydate) between '".$cr_new."' and '".$cr7_new."'  order by ly_anniversarydate desc ");
                                $num_loy_a = $database->mysqlNumRows($loy_qry_a);
                                 if($num_loy_a)
                                 {
                                     while($loyalty_listing_a = $database->mysqlFetchArray($loy_qry_a))
                                     { 
                                         
                                         $name_a=$loyalty_listing_a['ly_firstname'].' '.$loyalty_listing_a['ly_lastname'];
                                         $phone_a=$loyalty_listing_a['ly_mobileno'];
                                         $bday_a=$loyalty_listing_a['ly_anniversarydate'];
                                         
                                          if($loyalty_listing_a['ly_mobileno']!=""){
                                          $phone_ar_a[]=$loyalty_listing_a['ly_mobileno'];
                                          }
                                          
                                          if($loyalty_listing_a['ly_emailid']!=""){
                                          $mail_ar_a[]=$loyalty_listing_a['ly_emailid'];
                                          
                                          }
                                           ?>         
                                                    <tr>
                                                        <td><?=$name_a?></td>
                                                        <td> <?=$phone_a?> </td>
                                                        <td><span class="label label-danger"><?=$bday_a?></span></td> 
							</tr>
                                                                                                                                           
                                 <?php } }
                                 
                                 $phone_str_a=implode(',',$phone_ar_a);
                                
                                 $mail_str_a=implode(',',$mail_ar_a);
                                 ?>                                                           
                                
                                             <input type="hidden" id="number_a" num_a="<?=$phone_str_a?>" mail_a="<?=$mail_str_a?>" >                                                            
                                                                                                        
                                
												</tbody>
											</table>
	                                    </div>
                                    </div>
                        		</div>
                                
                                
                        	</div>
                        	<!-- end col -->
                        	
                        	<div class="col-lg-3">
                        		<div class="card-box">
                        			<h4 class="text-dark header-title m-t-0">Activities</h4>
                        			<p class="text-muted font-13">
										Points Add - Redeem Details.
									</p>
                        			
                        			<div id="point_show" class="nicescroll p-20" style="height: 240px;">
                        				
                        			</div>
                                    
                        		</div>
                        	</div>
                        	<!-- end col -->
                        </div>
                        
                        		<div class="card-box">
                        			<h4 class="text-dark text-center header-title m-t-0"> Registered Details </h4>

                        			<div class="widget-chart text-center">
	                                	<ul class="list-inline m-t-15">
	                                		
                                                            <?php 
                                
                                $seven="";
                                $loy_qry11234 = $database->mysqlQuery("select count(ly_id) as sevenday from tbl_loyalty_reg where CAST(ly_entrydatetime AS DATE) between CURDATE( ) - INTERVAL 7  DAY AND CURDATE( )  ");
                                $num_loy1234 = $database->mysqlNumRows($loy_qry11234);
                                 if($num_loy1234)
                                 {
                                     while($loyalty_listing1234 = $database->mysqlFetchArray($loy_qry11234))
                                     { 
                                         $seven=$loyalty_listing1234['sevenday'];
                                     }
                                     }
                                     
                                     $month="";
                                $loy_qry112345 = $database->mysqlQuery("select count(ly_id) as month from tbl_loyalty_reg where CAST(ly_entrydatetime AS DATE) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )  ");
                                $num_loy12345 = $database->mysqlNumRows($loy_qry112345);
                                 if($num_loy12345)
                                 {
                                     while($loyalty_listing12345 = $database->mysqlFetchArray($loy_qry112345))
                                     { 
                                         $month=$loyalty_listing12345['month'];
                                     }
                                     }
                                     
                                         $sixmonth="";
                                $loy_qry1123456 = $database->mysqlQuery("select count(ly_id) as sixmonth from tbl_loyalty_reg where CAST(ly_entrydatetime AS DATE) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )  ");
                                $num_loy123456 = $database->mysqlNumRows($loy_qry1123456);
                                 if($num_loy123456)
                                 {
                                     while($loyalty_listing123456 = $database->mysqlFetchArray($loy_qry1123456))
                                     { 
                                         $sixmonth=$loyalty_listing123456['sixmonth'];
                                     }
                                     }
                                     
                                $oneyear="";
                                $loy_qry112347 = $database->mysqlQuery("select count(ly_id) as oneyear from tbl_loyalty_reg where CAST(ly_entrydatetime AS DATE) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) ");
                                $num_loy12347 = $database->mysqlNumRows($loy_qry112347);
                                 if($num_loy12347)
                                 {
                                     while($loyalty_listing12347 = $database->mysqlFetchArray($loy_qry112347))
                                     { 
                                         $oneyear=$loyalty_listing12347['oneyear'];
                                     }
                                     }
                                     
                                     
                                     
                                     ?>
                                                    <li>
	                                			<h5 class="text-muted m-t-20">Last Week</h5>
	                                			<h4 class="m-b-0"><?=$seven?></h4>
	                                		</li>
	                                		<li style="border-left: 3px #ebeff2 solid;border-right: 3px #ebeff2 solid;">
	                                			<h5 class="text-muted m-t-20">Last Month</h5>
	                                			<h4 class="m-b-0"><?=$month?></h4>
	                                		</li>
	                                		<li>
                                                            
	                                			<h5 class="text-muted m-t-20">Last 6 Month</h5>
	                                			<h4 class="m-b-0"><?=$sixmonth?></h4>
	                                		</li>
                                                        <li style="border-left: 3px #ebeff2 solid">
	                                			<h5 class="text-muted m-t-20">Last 1 year</h5>
	                                			<h4 class="m-b-0"><?=$oneyear?></h4>
	                                		</li>
                                                        
	                                	</ul>
                                	</div>
                        		</div>

                            
                        
                        
                       
                    </div> 

                </div> 

                
            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->

        <script>
            
    var resizefunc = [];
    
    window.onload = function() {
        
     var dataString = 'set_point_dashboard=dashboard_show';
        $.ajax({
            type: "POST",
            url: "load_loyalty_list.php",
            data: dataString,
            success: function(data) {
               $('#point_show').html(data);

            }
        });
         
         
     $('#bday1').click(function() {
               
            var checkedBox = $(this).attr("checked");
                if (checkedBox === true) {
                    
                    
                    
                    $("#anvy1").attr('checked', false);
                } else {
                    $('#anniversary').hide();
                      $('#birthday').show();
                    $("#anvy1").removeAttr('checked');                    
                }
            });
       
            $('#anvy1').click(function() {
               
            var checkedBox = $(this).attr("checked");
                if (checkedBox === true) {
                   
                     
                    $("#bday1").attr('checked', false);                     
                } else {
                    $('#anniversary').show();
                      $('#birthday').hide();
                    $("#bday1").removeAttr('checked');                       
                }
            });
         
         
         
    }
     var auto_refresh = setInterval(
    function ()
    {
    var dataString = 'set_point_dashboard=dashboard_show';
        $.ajax({
            type: "POST",
            url: "load_loyalty_list.php",
            data: dataString,
            success: function(data) {
                $('#point_show').html(data);

            }
        });
        }, 2000);
        
        
        
  function list_loyalty_bill(i){
  
     
     var data="set=loyalty_list_bill&loy_id_list="+i;
    
        $.ajax({
        type: "POST",
        url: "customer_detail.php",
        data: data,
        success: function(data)
        {
          window.location.href="customer_detail.php";
       
        }
    });
  
}      
    
  function greetings(){
      
     if(document.getElementById('bday1').checked) {
         
          var b_number=$('#number_b').attr('num_b');
          var b_mail=$('#number_b').attr('mail_b');
          
         if(b_number!="" || b_mail!=""){
          
         var data="sms_text_bday=sms_bday&b_number="+b_number+"&type=bday";
   
        $.ajax({
        type: "POST",
        url: "index.php",
        data: data,
        success: function(data)
        {
          //alert('Message sent');
       
                        $('#error_grt').show();
                                    
                        $('#error_grt').text('Message Sent  ');
                        $('#error_grt').delay(500).fadeOut('slow');
       
        }
    }); 
    
    var data="mail_text_bday=mail_bday&b_mail="+b_mail+"&type=bday";
   
        $.ajax({
        type: "POST",
        url: "index.php",
        data: data,
        success: function(data)
        {
          
        // alert('Mail sent');
        $('#error_grt').show();
                                    
                        $('#error_grt').text('Message Sent  ');
                        $('#error_grt').delay(500).fadeOut('slow');
        }
    });
    
    }else{
        //alert('No Data Found');
        $('#error_grt').show();
                                    
                        $('#error_grt').text('NO DATA ');
                        $('#error_grt').delay(500).fadeOut('slow');
    }
}

   if(document.getElementById('anvy1').checked) {
       
   var a_number=$('#number_a').attr('num_a');
   var a_mail=$('#number_a').attr('mail_a');
    if(a_number!="" || a_mail!=""){
  var data="sms_text_bday=sms_bday&b_number="+a_number+"&type=anvy";
   
        $.ajax({
        type: "POST",
        url: "index.php",
        data: data,
        success: function(data)
        {
        
       alert('Mesaage sent');
        }
    }); 
    
     var data="mail_text_bday=mail_bday&b_mail="+a_mail+"&type=anvy";
   
        $.ajax({
        type: "POST",
        url: "index.php",
        data: data,
        success: function(data)
        {
         
        alert('Mail sent');
        }
    }); 
    

}else{
      alert('No Data Found') ;
   }
   }
     
  }  
            
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>

        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>


        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>





    </body>

</html>