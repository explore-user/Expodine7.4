<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();

error_reporting(0);

require_once '../excel_reader.php'; 
require_once '../Classes/PHPExcel/IOFactory.php';
$_SESSION['langauage_upload']="arabic";
include('../email/km_smtp_class.php');
 require_once('../Mailer/PHPMailerAutoload.php');
function fixFilesArray(&$files)
{
        $names = array( 'name' => 1, 'type' => 1, 'tmp_name' => 1, 'error' => 1, 'size' => 1);

        foreach ($files as $key => $part) {
                // only deal with valid keys and multiple files
                $key = (string) $key;
                if (isset($names[$key]) && is_array($part)) {
                        foreach ($part as $position => $value) {
                                $files[$position][$key] = $value;
                        }
                        // remove old key reference
                        unset($files[$key]);
                }
        }
}

 



if($_SERVER['REQUEST_METHOD']=='POST'&& $_REQUEST['sms_check']=="sms"){
    
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
    
   if(isset($_REQUEST['sms_text'])&& ($_REQUEST['sms_text']!="")){
  
		
		 $message=" ".$_REQUEST['sms_text'];
                 $number=$_REQUEST['sms_hidden'];
		
               
      $print=$database->dynamic_sms_api($number,$message);
                
                
    
  }
     
     
          
 if(isset($_REQUEST['mail_text'])&& ($_REQUEST['mail_text']!="")){    
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
						 $be_mail_from			         =$result_general['be_mail_from'];
					}
		  }
                  
		$emailto= $_REQUEST['mail_hidden'];
		$string=$_REQUEST['mail_text'];
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
       
         $from_name="Expodine";      
        $mail->Host = $be_mail_server;
        $mail->SMTPAuth = true;
        $mail->Username = $be_mail_emailid;
        $mail->Password = $be_mail_password;
        $mail->Port = $be_mail_port;
        $mail->SetFrom($be_mail_from,$from_name);
        $mail->Subject = "EXPODINE ";
        $mail->Body = $mailtext;
        if (($_FILES['fileupload_sms']['name'][0] != "")){
				  fixFilesArray($_FILES['fileupload_sms']);
				  foreach ($_FILES['fileupload_sms'] as $position => $file) 
					{
					   
						   $e=explode(".",$file['name']);
						   $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
						   $unqid=uniqid();
						   move_uploaded_file($file['tmp_name'], "sms_attach/".$unqid.".".$ext);
						   $mail->addAttachment("sms_attach/".$unqid.".".$ext);
						 
						
				   }
			}
         
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
           
}
  
      }
    
  header("Location:listing.php");
}    
  
      
if(isset($_REQUEST['set_delete'])&&($_REQUEST['set_delete']=="delete_loyalty")){
    $loyalty_id=$_REQUEST['loyalty_id'];
    $database->mysqlQuery("DELETE FROM tbl_loyalty_reg WHERE ly_id = '" .$loyalty_id."'");
}

   $s2='';
  
  if($_SERVER['REQUEST_METHOD']=='POST' && $_REQUEST['typeofupload']=="upload")
    {     
         $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
        $filename=$_REQUEST['filename'];
        $sq = $database->mysqlQuery("Truncate temp_loyalty_reg");
        if ( $_FILES['excel_upload']['name'] )
		{
                        $excel = new PhpExcelReader;
                        $excel->setOutputEncoding('UTF-8');
                        $file=$_FILES["excel_upload"]["name"];
                       
                        move_uploaded_file($_FILES['excel_upload']['tmp_name'], "Loyalty_upload/".$file);
                        $file1="Loyalty_upload/".$file;
                        
                        $excel->read($file1);
                        
                        $x=2;
                            $data=array();
                            while($x<=$excel->sheets[0]['numRows']) {
                                $y=1;
                                 while($y <=$excel-> sheets[0]['numCols']) {
                                $data[]= isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
                               
                            $y++;  
                             }
                             
                             if($data[13]!=""){
                                 
                                 $d_all=explode('/',$data[13]);
                                 $_year1=explode(' ',$d_all[2]);
                                    
                            $date_entry=$_year1[0].'-'.$d_all[1].'-'.$d_all[0].' '.$_year1[1].':00';
                          
                             }
                             else{
                                
                               $date_entry =date('Y-m-d H:i:s');
                               
                             }
                             
                             if($data[6]!=""){
                                 
                                  $d_all_bday=explode('/',$data[6]);
                                 
                                 
                                $bday=$d_all_bday[2].'-'.$d_all_bday[1].'-'.$d_all_bday[0];
                             }else{
                                 $bday ='0000-00-00';
                             }
                             
                             if($data[8]!=""){
                                 $d_all_anvy =explode('/',$data[8]);
                                 
                                $anvy=$d_all_anvy[2].'-'.$d_all_anvy[1].'-'.$d_all_anvy[0];
                                 
                             }else{
                                 $anvy ='0000-00-00';
                             }
                             
                             if($data[14]!=""){
                                 $br_id="1";
                                 
                             }else{
                                 $br_id="1";
                             }
                             
                             if($data[10]!=""){
                                 $tot_visit=$data[10];
                             }else{
                                 $tot_visit=1; 
                             }
                             
                             if($data[17]!=""){
                                 $ly_point=$data[17];
                             }else{
                                $ly_point=0; 
                             }
                             
                             if($data[18]!=""){
                                 $vouch=$data[18];
                             }else{
                               $vouch=1;  
                             }
                             
                             if($data[4]!=""){
                                 $mob=$data[4];
                             }else{
                              $mob=0;   
                             }
                             
                             
//                            $sql_insert="INSERT INTO `temp_loyalty_reg` (`ly_id`, `ly_firstname`, `ly_lastname`,`ly_gender`,`ly_mobileno`, `ly_emailid`, `ly_birthdaydate`, `ly_maritalstatus`, `ly_anniversarydate`, `ly_profession`, `ly_totalvisit`, `ly_mailreceive`, `ly_smsreceive`, `ly_entrydatetime`, `ly_branchid`, `ly_status`, `ly_entry_from`,`ly_points`,`ly_voucher_count`) VALUES
//                            ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$mob', '$data[5]', '".$bday."', '$data[7]', '".$anvy."', '$data[9]', '$tot_visit', '$data[11]', '$data[12]', '".$date_entry."', '$br_id', '$data[15]', '$data[16]', '$ly_point','$vouch')"; 
//                            $result_insert = mysqli_query($localhost,$sql_insert) or die(mysqli_error($localhost));
//
//                            
                              
                            $sql_insert="INSERT INTO `tbl_loyalty_reg` (ly_firstname,ly_mobileno) VALUES
                            ('$data[1]', '$data[0]')"; 
                            $result_insert = mysqli_query($localhost,$sql_insert) or die(mysqli_error($localhost));
                            
                            
                            
                            unset($data);
                            $x++;
 
                    }
                    
                    $sq1 = $database->mysqlQuery("CALL proc_loyalty_upload(@message)");
                    $rs1 = $database->mysqlQuery("SELECT @message AS message");
                     while($row1 = mysqli_fetch_array($rs1))
                         {
                            $s2= $row1['message'];
                           
                        }
                               
        }    
        unset($_POST);
    
       header("Location:listing.php");
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

		<link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
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
        
       <script type="text/javascript" src="searcher/jquery/jquery-1.11.0.min"></script>
        <script type="text/javascript" src="searcher/jquery-autocomplete.js"></script>
        
        <script src="assets/js/modernizr.min.js"></script>

		<style>.dataTables_length{display:none;}.dataTables_filter{display:none}div.dataTables_info{padding-top:7px}div.dataTables_paginate ul.pagination{margin-top:0 !important}.card-box{margin-bottom:0}.content-page > .content{margin-bottom:0}.nav > li > a{padding:16px 15px;}.logo{padding:15px;}
	.action-btn {width: 18px;height: 23px;display: inline-block;margin-right: 5px;font-size: 17px;color: #666 !important;}
			.listting-top-filter-section{padding: 13px;border-radius: 5px;overflow: auto}
      .listting-top-filter-section_head{width: 100%;height: auto;float: left;padding: 10px 0;background-color: #f9f9f9;padding-left:10px;color: #333;text-transform: uppercase}.filter-textbox-cc{margin-bottom: 8px;width: 17%; margin-right: 2%}
      .div_loy_height{
          height: 63vh !important;
      }
     @media(max-width:1135px) {
        .div_loy_height{
          height: 59vh !important;
      } 
     }

     input[type=file]::file-selector-button {
  margin-right: 20px;
  border: none;
  padding: 6px 15px;
  border-radius: 0px;
  background-color: #a73526 !important;
  border: 1px solid #561209 !important;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
}

input[type=file]::file-selector-button:hover {
  background: #0d45a5;
}
	</style>

    </head>

    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include( 'includes/header.php') ?>
            
            <div class="content-page" >
                <!-- Start content -->
                <div class="content">
                    
                	<div class="top-head-section">
                            &nbsp;&nbsp;
                            
                    </div>
                    
                    <strong id="msg_show_grp" style="color:red;display: none;position: absolute;top: 18px;right: 19px;z-index: 9998;" ></strong>  
                    
                    
                    <div class="container">
                        
  

                  
                       <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                      <div class="page_head_detl_sec">
                        <h2> Customers </h2>
                       
                        &nbsp; <strong style="color:darkred" id="msg_show"></strong>

                             
                            <form enctype="multipart/form-data"   method="post" name="submitxmldetails" id="submitxmldetails">
                            <input type="hidden" name="typeofupload" id="typeofupload"  value="">
                            <div class="dt-buttons btn-group" style="margin-bottom:0px;">
                            	
                            <a class="btn btn-default buttons-csv buttons-html5 btn-sm" onclick="return excel1_download('download');" tabindex="0" aria-controls="datatable-buttons"><span><i class="fa fa-download" aria-hidden="true"></i>  Download</span></a>
                            <input title="Number & Name In Excel" style="float: left;margin-left: 8px;width:97px;margin-right: 10px;" type="file" name="excel_upload"  id="excel_upload"/><!--
-->                            <a  class="btn btn-default buttons-csv buttons-html5 btn-sm" onclick="return excel1_download('upload');" tabindex="0" aria-controls="datatable-buttons"><span><i class="fa fa-upload" aria-hidden="true"></i>  Upload</span></a><!--

                            <strong style="color:red;font-size: 12px;padding-left: 15px;float: left"> &nbsp;[NOTE -- Before Uploading , Change Format<br> Of File To EXCEL WORKBOOK 97-2003.xls ]</strong>-->
                            
                            
                            
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <select onchange="add_to_group();" id="check_group" style="background-color:#178098  !important;font-size: 14px" class="btn btn-default buttons-csv buttons-html5 btn-sm">
                                <option value=""> CAMPAIGN GROUP </option>
                                
                    <?php  
                    $loy_qry = $database->mysqlQuery("select * from tbl_loyalty_campaign_group where gp_status='Y' ");
                    $num_loy = $database->mysqlNumRows($loy_qry);
                    if($num_loy)
                    {
                    while($loyalty_listing = $database->mysqlFetchArray($loy_qry))
                    {
                          ?>     
                                <option value="<?=$loyalty_listing['gp_id']?>"> <?=$loyalty_listing['gp_groupname']?> </option>
                    <?php }} ?>
                            </select>
                           
                             </form>
                          
                             <a href="registration.php"><div style="width:5vw;" class="top-head-add-btn">+ADD</div></a>
                             
                            <a onclick="return reset_loy();"  href="#"><div style="background-color: #cd2c2c;" class="top-head-add-btn">RESET</div></a>
                          <a onclick="return coupon_loy();"   href="#"><div style="background-color: #a58900;" class="top-head-add-btn">COUPON</div></a>
                      </div>
                        <div class="listting-top-filter-section">
                        	
                            <div class="filter-textbox-cc" style="width:10%">
                                	<div class="table-filter-text"> Name</div>
                                        <input type="text" class="list-filter-textbox" onKeyUp="return name_search();" id="name_search">
                                </div>
                           
                            
                            
                                <div class="filter-textbox-cc" style="width:10%">
                                	<div class="table-filter-text"> Mobile No</div>
                                        <input type="text" class="list-filter-textbox"  onKeyUp="return phone_search();" id="phone_search">
                                </div>
                          
                             <div class="filter-textbox-cc">
                                	<div class="table-filter-text">Date</div>
                                        <input style="width:48%;margin-right: 4%" type="text" class="list-filter-textbox" placeholder="From " onchange="return from_search();" id="datepicker_fr">
                              <input type="text"  style="width:48%;" class="list-filter-textbox" placeholder="To" onchange="return to_search();" id="datepicker_to">
                             </div>
                            
                            <div class="filter-textbox-cc" style="width:13%">
                                	<div class="table-filter-text"> Type</div>
                                        <select class="list-filter-textbox" id="type_new" onchange="return type_search();">
                                           <option value="New">New Registrations</option>
                                            <option value="Spend">Spend</option>
                                           
                                            <option value="No">No Visit</option>
                                        </select>
                                </div>   
                                <div class="flt_show_mr" >
                                
                                <div class="filter-textbox-cc">
                                	<div class="table-filter-text"> Email ID</div>
                                    <input type="text" class="list-filter-textbox"  onkeyup="return email_search();" id="email_search">
                                </div>
                            
                             <div class="filter-textbox-cc">
                                	<div class="table-filter-text"> Birthday</div>
                                        <input type="text" class="list-filter-textbox" placeholder="" onchange="return birthday_search();" id="datepicker">
                                </div>
                             <div class="filter-textbox-cc">
                                	<div class="table-filter-text"> Anniversary Date</div>
                                        <input type="text" class="list-filter-textbox" placeholder="" onchange="return anniversary_search();" id="datepicker1">
                                </div>
                            <div class="filter-textbox-cc">
                                	<div class="table-filter-text"> Status</div>
                                        <select class="list-filter-textbox" id="status_act" onchange="return status_search();">
                                            <option value="">All</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                </div>
                           
                                    
                                 
                                    
                            <div class="filter-textbox-cc">
                                	<div class="table-filter-text"> Visits   </div>
                                        <input type="text" style="width:45%" class="list-filter-textbox" placeholder="" onKeyUp="return visit_search();" id="visit">
                                        <div id="less_visit" style="width:20%;float:left;font-weight: bold;margin-left: 6%;height: 30px;text-align: center;cursor: pointer;padding-top: 6px;box-shadow: 0px 0px 10px #bebebe;border-radius: 5px;" ><</div>
                                        <div id="more_visit" style="width:20%;float:left;font-weight: bold;margin-left: 4%;height: 30px;text-align: center;cursor: pointer;padding-top: 6px;box-shadow: 0px 0px 10px #bebebe;border-radius: 5px;" >></div>
                            </div>
                            
                             <div class="filter-textbox-cc">
                                	<div class="table-filter-text"> Spend Amount </div>
                                        <input type="text" style="width:45%" class="list-filter-textbox" placeholder="" onKeyUp="return spend_search();" id="spend">
                                        <div id="less_spend" style="width:20%;float:left;font-weight: bold;margin-left: 6%;height: 30px;text-align: center;cursor: pointer;padding-top: 6px;box-shadow: 0px 0px 10px #bebebe;border-radius: 5px;" ><</div>
                                        <div id="more_spend" style="width:20%;float:left;font-weight: bold;margin-left: 4%;height: 30px;text-align: center;cursor: pointer;padding-top: 6px;box-shadow: 0px 0px 10px #bebebe;border-radius: 5px;" >></div>
                            </div>
                        </div>

                            <a id='more_div' onclick="return more_loy();" href="#"><div style="border-radius: 7px;" class="more_flt_show_btn">MORE...</div></a>
                            <a style="display:none" id='less_div' onclick="return less_loy();" href="#"><div style="border-radius: 7px;" class="more_flt_show_btn"> LESS... </div></a> &nbsp;&nbsp;&nbsp;
                            <a style="right:10px" href="listing.php"><div style="border-radius: 7px;margin-left: 10px;" class=""><i style="margin-top:8px;margin-left: 25px" class="fa fa-refresh"></i></div></a>
                         
                        </div>
                        
                        </div>
                        <div class="row" >
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        
                            <div class="card-box table-responsive div_loy_height" style="">
                           
                           
                        	<table id="registration-fixed-col" class="table table-striped table-bordered table-listting-new">
                                <thead>
                                    <tr style="position: sticky;top: -12px;background-color: white;"> 
                                    <th style="min-width:120px;"> <input style="float:left;width: 20px;height:20px" id="check_all_cus" type="checkbox" class="check_customer22">Action</th>
                                   <th style="min-width:35px;">SL </th>
                                    <th style="min-width:150px;"> Name</th>
                                    <th style="min-width:100px;">Mobile</th>
                                    <th style="min-width:100px;">Email</th>
                                    <th style="min-width:100px;"> Spend  &nbsp;&nbsp;<i style="cursor:pointer" class="fa fa-sort-asc asc_spend">  </i>  <i style="cursor:pointer;display: none" class="fa fa-sort-desc desc_spend"> </i></th>
                                       <th style="min-width:70px;">Visit &nbsp;&nbsp;<i style="cursor:pointer" class="fa fa-sort-asc asc_visit">  </i>  <i style="cursor:pointer;display: none" class="fa fa-sort-desc desc_visit"> </i></th>
                                     <th style="min-width:70px;">Status</th>
                                      <th style="min-width:100px;">Date</th>
<!--                                    <th style="min-width:80px;">Bday</th>
                                    <th style="min-width:80px;">Anv</th>-->
                                    <th style="min-width:35px;">Id</th>
                                    
                                   
                                   
                                    
                                  
                                  
                                </tr>
                                </thead>

                                <tbody id="list_view_all" style="">
                                <?php
                                
          
          $ct=1;                      
         $loy_qry3 = $database->mysqlQuery("select ly_id from tbl_loyalty_reg ");
    
     $num_loy3 = $database->mysqlNumRows($loy_qry3);
     if($num_loy3)
     {
         while($loyalty_listing3 = $database->mysqlFetchArray($loy_qry3))
         {
         
         $count=$ct++;                       
     }}                     
                                
                               
    ?>
                                </tbody>
                            </table>
                                
                                
                                <span  style="position: absolute;bottom: -19px;left: 15px;">Total: <?=$count?></span>      
                   
            
                                
                            <div class="inv-pagination" style="position: absolute;bottom: -17px;right: 43px;" >                                         
                                        <?php 
                                        
                                        $m=0;
                                       
                                         $p=floor(($count/100)+1);
                                        ?>
                                        <a  href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                        <a href="#"  class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                        <?php $m=$m+100; } $m=$m-100;?>
                                        
                                     <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
                             </div>      
                                
                         
                        
                        </div>

                    </div> 

                </div> 

            </div>

        </div>

        </div>
        
             
            
            
        <div id="transfer-popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content ac_popup">
									<div class="modal-body" style="text-align: center;padding: 0">
										<h4> POINT TRANSFER</h4>
                                                                                <span style="height: 20px;display: inline-block;width: 100%">
                                                                                <span id="error_show" style="color:red"></span>
                                                                                </span>
									</div>
									<div class="modal-content inner-textbox-effect" style="border: 0">
										<div class="col-md-6">
											<div class="group">
                                                                                            <input id="name_point" required="" name="" type="text" value="" onkeyup="return search_name();">
                                                                                            <div id="name_load" class="customer_list_autoload" style="display:none">
                                                                                            <ul>
                                                                                                <li onclick="return name_click();" style="cursor: pointer">
                                                                                                    
                                                                                                </li>
                                                                                            </ul>
                                                                                                </div>
												<label>Name</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
										<div class="col-md-6">
											<div class="group">
												<input id="number_point" required="" name="" type="text" value="" onkeyup="return search_number();">
                                                                                                <div id="number_load" class="customer_list_autoload" style="display:none">
                                                                                            <ul>
                                                                                                <li onclick="return number_click();" style="cursor: pointer">
                                                                                                    
                                                                                                </li>
                                                                                            </ul>
                                                                                                </div>
												<label>Phone Number</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                                                            <div class="col-md-12">
											<div class="group">
                                                                                            <input id="from_point"  name="" type="text" value="" style="pointer-events:none">
                                                                                            <label>Points From - <span id="from_name"></span></label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
                                                                            <div class="col-md-12">
											<div class="group">
												<input id="to_point" required="" name="" type="text" value="">
												<label>Points To Transfer</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
										<div class="col-md-12">
											<div class="group">
												<input id="reason_point" required="" name="" type="text" value="">
												<label>Reason</label>
												<span class="highlight"></span>
												<span class="bar"></span>
											 </div>
										</div>
									</div>
									<div class="modal-footer" style="border: 0;text-align: center;">
                                                                            <button style="background-color: #209080 !important;" type="button" class="btn btn-primary waves-effect waves-light" onclick="return submit_transfer();"> Submit</button>
                                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" onclick="close_transfer_pop();" >Close</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
						
					<form role="form" action="listing.php"  enctype="multipart/form-data"   method="post" name="sms_submit" id="sms_submit">
					<div id="send-mail-popup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog sms_popup_close" >
								<div class="modal-content ac_popup" style="background-color: #f4f8fb;">
									<div class="modal-body" style="text-align: center;padding: 0">
										<h4>  SMS - MAIL</h4>
                                                                                <span style="height: 20px;display: inline-block;width: 100%"> <span id="sms_error_show" style="color:red;"></span></span>
									</div>
									<div class="modal-content inner-textbox-effect" style="border: 0;background-color: #f4f8fb;">
                                                       
                                                                   <div class="col-md-6">
                                                                       <div class="table-filter-text">SMS &nbsp;&nbsp;&nbsp; [<span style="color:red" id="charscount">160</span>] Characters Left</div>
											<div class="group" style="margin-bottom: 10px;">
                                                                                            <textarea class="sms_send_textbox" id="sms_text"  required="" placeholder="" maxlength="160" name="sms_text" type="text"></textarea>
											 </div>
										</div>
										<div class="col-md-6">
											<div class="table-filter-text">EMAIL</div>
											<div class="group" style="margin-bottom: 10px;">
                                                                                            <textarea class="sms_send_textbox"  required="" id="mail_text" name="mail_text" placeholder="" type="text"></textarea>
											 </div>
										</div>
										<div class="col-md-12">
											<div class="group">
												<input type="file" name="fileupload_sms[]" id="fileupload_sms"  >
											</div>
										</div>
                                                                            <input type="hidden" id="sms_hidden" name="sms_hidden" >
                                                                            <input type="hidden" id="mail_hidden" name="mail_hidden" >
                                                                             <input type="hidden" id="sms_check"  name="sms_check">
                                                                            
									</div>
									<div class="modal-footer" style="border: 0;text-align: center;">
									<button type="button" class="btn btn-default waves-effect" data-dismiss="modal" >Close</button>
									<button onclick="return submit_send_sms_email('sms');" style="background-color: #209080 !important;" type="button" class="btn btn-primary waves-effect waves-light"><span  class="fa fa-send"></span> SEND</button>
									</div>
                                                                    <div style="display:none" class="new_print_loading_bill_sms"  ><img src="assets/images/sending.gif"></div> 
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
                                                        
						</div><!-- /.modal -->


                                        </form>

        <script>
            var resizefunc = [];
        </script>

       
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

        
	<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
        
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>
        
        <script src="assets/pages/datatables.init.js"></script>
        <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function () {
             
           $( "#datepicker").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
             $( "#datepicker1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
           
           
            $( "#datepicker_fr").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
             $( "#datepicker_to").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
           
           
             $( "#c_from").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
             $( "#c_to").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
           
           
                $('#name_search').focus();
                $('#datatable').dataTable();
				
//           var table = $('#registration-fixed-col').DataTable({
//              "columnDefs": [
//                    { "orderable": false, "targets": [0] }
//                ],
//           scrollY: "420px",
//            scrollX: true,
//            scrollCollapse: true,
//            paging: true,
//           
//        });
        
        var table = $('#popup-table-nn').DataTable({
            scrollY: "360px",
            scrollX: false,
            scrollCollapse: true,
            paging: false,
           
        });
        
        
        var maxLength = 160;
	$('#sms_text').keyup(function() {
              var length33 = $(this).val().length;
	  var length = $(this).val().length;
	  var length = maxLength-length;
          if(length33<=160){
	  $('#charscount').text(length);
      }else{
          
           $('#charscount').text('limit 160');
      }
	});
        
        
        
   $('#check_all_cus').click(function(){

        if($("#check_all_cus").prop('checked') == true){
          $('.camp_chk_sel_cus').each(function(){
            $(this).prop('checked',true);

       })
          // $('#check_group').hide();
        }else{
            $('.camp_chk_sel_cus').each(function(){
            $(this).prop('checked',false);
       // $('#check_group').show();
       })

        }
        
  });


$('.asc_spend').click(function(){
    $('.asc_spend').hide();
    $('.desc_spend').show();
    
     var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
            var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
               var type_new=$('#type_new').val();
                var spend_type='asc';
                var visit_type='';
               
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new+"&spend_type="+spend_type+"&visit_type="+visit_type;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
       
          $('#list_view_all').html(data);
        }
    });
    
    
});



$('.desc_visit').click(function(){
    
     $('.asc_visit').show();
    $('.desc_visit').hide();
    
     var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
            var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
               var type_new=$('#type_new').val();
               var visit_type='desc';
               var spend_type='';
               
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new+"&spend_type="+spend_type+"&visit_type="+visit_type;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
       
          $('#list_view_all').html(data);
        }
    });
    
    
});



$('.asc_visit').click(function(){
    $('.asc_visit').hide();
    $('.desc_visit').show();
    
     var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
            var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
               var type_new=$('#type_new').val();
                var spend_type='';
                var visit_type='asc';
               
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new+"&spend_type="+spend_type+"&visit_type="+visit_type;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
       
          $('#list_view_all').html(data);
        }
    });
    
    
});



$('.desc_spend').click(function(){
    
     $('.asc_spend').show();
    $('.desc_spend').hide();
    
     var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
            var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
               var type_new=$('#type_new').val();
               var visit_type='';
               var spend_type='desc';
               
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new+"&spend_type="+spend_type+"&visit_type="+visit_type;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
       
          $('#list_view_all').html(data);
        }
    });
    
    
});


   pagination(0,4);     
        
        
        
        
		});
     TableManageButtons.init();             
       function more_loy(){
           
        $('.flt_show_mr').show();   
           
            $('#more_div').hide();  
              $('#less_div').show();  
              
            $('.card-box').css('height','45vh');     
              
              
       }   
       
        function less_loy(){
           
        $('.flt_show_mr').hide();   
           $('#less_div').hide();     
             $('#more_div').show(); 
             
              $('.card-box').css('height','63vh');     
       }    
       
       
       
       function pagination(p,q)
    {
        
       var s=$('#recordcount').val();

     if(q==1)
     {
     var m= q;
     var j=parseInt(q)+6;
     }
     else if(q==2)
     {
     var m= parseInt(q)-1;
     var j=parseInt(q)+5;
     }
     else if(q==3)
     {
       var m= parseInt(q)-2;
       var j= parseInt(q)+4;
     }
     else 
     {
       var m= parseInt(q)-3;
       var j= parseInt(q)+3;
     }

    
     var o=0;
     var w=0;
      var n=0;
     
    for(w=1;w<=m;w++)
     {
         
         $('#pagi'+w).hide();
     } 
     for(n=m;n<=j;n++)
     {
         
         $('#pagi'+n).show();
     } 
     for(o=j;o<=s;o++)
     {
         
         $('#pagi'+o).hide();
     } 
     
     var recordcount=parseInt(p);
      var spend_type='';
       var visit_type='';
      var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
            var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
               var type_new=$('#type_new').val();
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new+"&pagination="+p+"&recordcount="+recordcount+"&spend_type="+spend_type+"&visit_type="+visit_type;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
       
          $('#list_view_all').html(data);
        }
    });
     
     
  
 } 
       
       
       
       
       
                
    function  name_search(){
         var spend_type='';
          var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
            var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
               var type_new=$('#type_new').val();
                 var visit_type='';
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new+"&spend_type="+spend_type+"&visit_type="+visit_type;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
       
          $('#list_view_all').html(data);
        }
    });
    }           
   
    function  email_search(){
         var spend_type='';
        var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
           var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
               var type_new=$('#type_new').val();
                 var visit_type='';
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new+"&spend_type="+spend_type+"&visit_type="+visit_type;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        { 
         
          $('#list_view_all').html(data);
        }
    });
    }
    
     function  phone_search(){
          var spend_type='';
        var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
           var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
               var type_new=$('#type_new').val();
                 var visit_type='';
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new+"&spend_type="+spend_type+"&visit_type="+visit_type;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
          //alert(data);  
          $('#list_view_all').html(data);
        }
    });
    }
    
     function  birthday_search(){
          var spend_type='';
        var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
           var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
                var visit_type='';
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&spend_type="+spend_type+"&visit_type="+visit_type;
       
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
         
          $('#list_view_all').html(data);
        }
    });
    }
    
   function  anniversary_search(){
        var spend_type='';
        var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
           var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
                var visit_type='';
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&spend_type="+spend_type+"&visit_type="+visit_type;
      
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
          //alert(data);  
          $('#list_view_all').html(data);
        }
    });
    }      
    
    
    function  visit_search(){
         var spend_type='';
        var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
           var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
             var visit_range=$('.visit_color').text();
           var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
                var visit_type='';
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&spend_type="+spend_type+"&visit_type="+visit_type;
      
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
        
          $('#list_view_all').html(data);
        }
    });
    }       
    function type_search(){
         var spend_type='';
        var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
           var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
               var type_new=$('#type_new').val();
                 var visit_type='';
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new+"&spend_type="+spend_type+"&visit_type="+visit_type;
      
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
          //alert(data);  
          $('#list_view_all').html(data);
        }
    });
    }  
    
    function status_search(){
         var spend_type='';
        var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
           var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
               var type_new=$('#type_new').val();
                 var visit_type='';
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new+"&spend_type="+spend_type+"&visit_type="+visit_type;
      
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
          //alert(data);  
          $('#list_view_all').html(data);
        }
    });
    }       
    
      
  function delete_loyalty(ly){
     var check = confirm("Are you sure you want to Delete ?");
	if(check==true)
	{
            var data="set_delete=delete_loyalty&loyalty_id="+ly;
        $.ajax({
        type: "POST",
        url: "listing.php",
        data: data,
        success: function(data)
        {
         
          location.reload();
        }
    });
            
        }
  }    
 
 function excel1_download(type){
      
    if(type=='download'){
        
   var email_dwl=$('#email_search').val();
    var name_dwl=$('#name_search').val();
    var phone_dwl=$('#phone_search').val();
    
    window.location="load_loyalty_list_excel.php?type=loyalty_listing&name="+name_dwl+"&number="+phone_dwl+"&email="+email_dwl;
    
    }else if(type=='upload'){
    
    if($('#excel_upload').val()!=''){
    
       $("#typeofupload").val(type);	
      
       document.submitxmldetails.submit(); 
        $('#msg_show').show(); 
       $('#msg_show').text('Uploading');
        $('#msg_show').delay(1500).fadeOut('slow');
   }else{
        $('#msg_show').show(); 
       $('#msg_show').text('SELECT FILE'); 
        $('#msg_show').delay(1500).fadeOut('slow');
   }
   
 }
 }
 
function search_name(){
    
     var name=$('#name_point').val();
   
     var data="set=searchname&name="+name;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
             $('#name_load').show();
         
           $('#name_load').html(data);
           
        }
    });      
       
       if(name==''){
        $('#number_point').val(''); 
    }
}

function  name_click(n,i,num){
 
   $('#name_point').val(n);
   
   $('#number_point').val(num);
    
    $('#name_load').hide();
    
    $("#name_point").attr("name_id", i);
   
}


function search_number(){
     var number=$('#number_point').val();
   
     var data="set=searchnumber&number="+number;
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
           $('#number_load').show();
         
           $('#number_load').html(data);
           
        }
    });      
       
       if(number==''){
        $('#name_point').val(''); 
    }
}

function  number_click(n,i,num){
 
   $('#name_point').val(n);
   
   $('#number_point').val(num);
    
    $('#number_load').hide();
    
    $("#name_point").attr("name_id", i);
    
}


function transfer_point(id,p,n){
    
    $('#from_name').text(n);
    $('#from_point').val(p);
     $("#from_point").attr("from_id", id);
    
}


function submit_transfer(){
    
    var nm=$("#name_point").val();
    var to_id= $("#name_point").attr("name_id");
    var from_id= $("#from_point").attr("from_id");
    var from_point=parseFloat($("#from_point").val());
    
    var point=parseFloat($('#to_point').val());
    var reason=$('#reason_point').val();
 
     if(point<=from_point && nm!='' && point!=''){
     var data="set=tranfer_point&to="+to_id+"&from="+from_id+"&point="+point+"&reason="+reason+"&from_point="+from_point;
  
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        { 
             location.reload();
           
        }
    });
     }else{
                                           $('#error_show').show();
                                    var rptstatuschk112=$('#error_show');
                                
                                    rptstatuschk112.text('ENTER VALID DETAILS');	
                                    $("#error_show").delay(1000).fadeOut('slow');
     }
}



function send_popup(n,m){
   $("#sms_hidden").val(n);
    $("#mail_hidden").val(m);
   
}


 function submit_send_sms_email(type){
    
     var sms_text= $("#sms_text").val();
     var mail_text=$("#mail_text").val();
     
     var ct=sms_text.length;
     var ct1=mail_text.length;
    
      if((sms_text!="" || mail_text!="") && type=='sms' ){
          
      $('#sms_check').val(type);
    
        document.sms_submit.submit();
        $('.new_print_loading_bill_sms').show();  
    }else{
          $('.new_print_loading_bill_sms').hide();  
            $('#sms_error_show').show();
             var rptstatuschk112=$('#sms_error_show');
             rptstatuschk112.text('Enter Details');	
             $("#sms_error_show").delay(1000).fadeOut('slow');
    }
}

function list_loyalty_bill(i,n){
  
     
     var data="set=loyalty_list_bill&loy_id_list="+i+"&name="+n;
    
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

function close_list(){
    $('.redeem-bll-popup-sec').hide();
}


function close_transfer_pop(){
   location.reload();
}



function add_to_group(i){
   
    var all_id=new Array();
    $('.check_customer').each(function(){
       
    if($(this).prop('checked') == true){
   
    var all=$(this).attr('id_customer');
    
    all_id.push(all);
   
    }
   
    });
         
      var allid=all_id.join(',');   
      var groupid=$('#check_group').val();
      
  
      if(allid!=""){
          
          if(groupid!=""){
      var check = confirm("Do you want to Add Customers to this Group ?");
    
      if(check==true)
       {
      
       var data="set_group_customer_add=group_customer_add&customer="+allid+"&groupid="+groupid;
  
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
      if($.trim(data)!=''){
          $('#msg_show_grp').show();
          $('#msg_show_grp').html('Customers Added To Group ');
           $('#msg_show_grp').delay(2000).fadeOut('slow');
            $('#check_group').val('');
         setTimeout(function(){  window.location.href="listing.php"; }, 1000); 
      }else{
         $('#msg_show_grp').show();
          $('#msg_show_grp').html('Group with same customers already exists');
           $('#msg_show_grp').delay(2000).fadeOut('slow');
            $('#check_group').val('');
      }
        }
        });
        }
      
        }else{
             $('#msg_show_grp').show();
          $('#msg_show_grp').html('Select  Group To Add Customers');
           $('#msg_show_grp').delay(2000).fadeOut('slow');
          
        }
        
        }else{
            $('#msg_show_grp').show();
          $('#msg_show_grp').html('Select Customers To Add To Group');
           $('#msg_show_grp').delay(2000).fadeOut('slow');
           
            $('#check_group').val('');
        }
}


$('#less_visit').click(function(){
  $('#less_visit').toggleClass('visit_color');
   $('#more_visit').removeClass('visit_color');
   $('#visit').val('');
});

$('#more_visit').click(function(){
  $('#more_visit').toggleClass('visit_color');
   $('#less_visit').removeClass('visit_color');
   $('#visit').val('');
});


$('#less_spend').click(function(){
  $('#less_spend').toggleClass('spend_color');
   $('#more_spend').removeClass('spend_color');
   $('#spend').val('');
});

$('#more_spend').click(function(){
  $('#more_spend').toggleClass('spend_color');
   $('#less_spend').removeClass('spend_color');
   $('#spend').val('');
});

function to_search(){
    var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
           var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
              var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
               var type_new=$('#type_new').val();
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new;
      
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
           
          $('#list_view_all').html(data);
        }
    });
}


function from_search(){
    var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
           var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
              
               var type_new=$('#type_new').val();
               
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new;
      
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
        
          $('#list_view_all').html(data);
        }
    });
}

function spend_search(){
    var email=$('#email_search').val();
        var name=$('#name_search').val();
           var phone=$('#phone_search').val();
           var bday=$('#datepicker').val();
             var anvy=$('#datepicker1').val();
             var visit=$('#visit').val();
             var status=$('#status_act').val();
              var visit_range=$('.visit_color').text();
               var to=$('#datepicker_to').val();
             var from=$('#datepicker_fr').val();
             var spend=$('#spend').val();
              var spend_range=$('.spend_color').text();
               var type_new=$('#type_new').val();
         var data="set_search=search_loyalty&name="+name+"&phone="+phone+"&email="+email+"&bday="+bday+"&anvy="+anvy+"&visit="+visit+"&status="+status+"&visit_range="+visit_range+"&to="+to+"&from="+from+"&spend="+spend+"&spend_range="+spend_range+"&type_new="+type_new;
      
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
       // alert(data);
          $('#list_view_all').html(data);
        }
    });
}

function confirm_yes_new(){
     
     var data="value=reset_loy_cutomer_load";
  
        $.ajax({
        type: "POST",
        url: "load_loyalty_list.php",
        data: data,
        success: function(data)
        {
            
            location.reload();
            
        }
    });
     
     $('#confirm_pop_all').hide();
                
     $('#pop_head_com').text('');
 }

function reset_loy(){
    
    $('#confirm_pop_all').show();
                
    $('#pop_head_com').text('CLEAR CUSTOMER DETAILS ADDED IN ALL MODULES FOR BILLING ?');
    
    
}




function coupon_loy(){
   
    var all_id=new Array();
    $('.check_customer').each(function(){
       
    if($(this).prop('checked') == true){
   
    var all=$(this).attr('id_customer');
    
    all_id.push(all);
   
    }
   
    });
         
      var allid=all_id.join(',');   
      
      var groupid=$('#check_group').val();
      
  
      if(allid!=""){
          
          
        $('#coupon_pop_new').show();
              
        $('#coupon_pop_new').attr('customers', allid);
        
         
          
           $('#c_name').val('');
              $('#c_code').val('');
               $('#c_from').val('');
                $('#c_to').val('');
                 $('#c_value').val('');
                 
                $('#c_name').focus();
        }else{
            $('#msg_show_grp').show();
           $('#msg_show_grp').html('Select Customers ');
           $('#msg_show_grp').delay(2000).fadeOut('slow');
           
        }
}


function coupon_loy_close(){
    
    $('#coupon_pop_new').hide();
}



function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
}

        </script>
        
		<style>.dataTables_scrollBody{height:420px !important;}.modal .modal-dialog .modal-content{padding: 15px 7px}
			.modal .modal-dialog .modal-content .group{margin-bottom: 16px;}.modal-dialog{width:500px !important;top: 10%;}
                        .new_print_loading_bill_sms{width:100%;height:80%;position:absolute;top:0;left:0;background-color:rgba(255,255,255,0.8);text-align:center;z-index:9999999999999;top: 20%}
                        .new_print_loading_bill_sms img {width:200px;}
                        .visit_color{background-color:darkkhaki;}
                         .spend_color{background-color:darkgrey;}
.overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}


		</style>

         <!---------------- COUPON POPUP --------------------->
        
    <div class="overlay" id="coupon_pop_new" onclick="off()">
        
                  <div class="modal-dialog" style="top:30%">
                  <div class="modal-content" style="background-color: #f4f8fb;">
		  <div class="modal-body" style="text-align: center;padding: 0">
		  <h4>COUPON</h4>
                  <span style="height: 20px;display: inline-block;width: 100%"> <span id="" style="color:red;"></span></span>
                   <div style="display: flex;justify-content: center;align-items: center;gap: 25px;">
                       <div class="filter-textbox-cc" style="width:35%; text-align: left;">
                                 	<div class="table-filter-text">Coupon Name</div>
                                        <input type="text" class="list-filter-textbox"  id="c_name">
                                </div>

                                <div class="filter-textbox-cc" style="width:35%; text-align: left;">
                                	<div class="table-filter-text">Coupon Code</div>
                                        <input type="text" class="list-filter-textbox"  id="c_code">
                                </div>

                           </div>
         <div style="display: flex;justify-content: center;align-items: center;gap: 25px;">
                  <div class="filter-textbox-cc" style="width:35%; text-align: left;">
                                <div class="table-filter-text">From Date</div>
                                 <input type="text" class="list-filter-textbox" id="c_from">
                                </div>

                                <div class="filter-textbox-cc" style="width:35%; text-align: left;">
                                	<div class="table-filter-text">To Date</div>
                                        <input type="text" class="list-filter-textbox"  id="c_to">
                                </div>

        </div>
                  
            <div style="display: flex;justify-content: center;align-items: center;gap: 25px;">
                  

                                <div class="filter-textbox-cc" style="width:77%; text-align: left;">
                                	<div class="table-filter-text">Value</div>
                                        <input type="number" class="list-filter-textbox"  id="c_value">
                                </div>

        </div>      
                  
	</div>
                      


                  <div class="modal-footer" style="border: 0;text-align: center;">
									<button onclick="return coupon_loy_close();" type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
									<button style="background-color: #209080 !important;" type="button" class="btn btn-primary waves-effect waves-light"> SUBMIT</button>
									</div>

		</div>
     </div>
     </div>
<!---------------- COUPON POPUP --------------------->

  <style>
.stck_add_btn5{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec5{width:100%;height:100%;position:fixed;left:0;top:0;z-index:999999;background-color:rgba(0,0,0,0.9)}
.stok_add_popup5{width:350px;height:185px;position:absolute;left:0;right:0;top:20%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd5{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:20px 0;position:relative}
.stok_add_popup_cnt5{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx5{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:10px}
.stock_add_btn5{width:45%;float:right;height:35px;text-align:center;line-height:35px;background-color:darkred;color:#fff;border-radius:5px;margin-top: 5px;font-size: 10px;font-weight: bold}
.stok_add_popup_cls5{width:20px;height:20px;position:absolute;right:5px;top:5px}
 </style>
 <div class="stok_add_popup_sec5" style="display:none" id="confirm_pop_all">    
      <div class="stok_add_popup5" style="width:375px;height: 140px">
          <div class="stok_add_popup_cnt5">
              <span id="pop_head_com" style="margin-top: 10px;font-size:15px;font-weight: bold;color: black;width: 100% !important;position: absolute;text-align: center">CONFIRM ? </span> 
           
            <a  onclick="confirm_yes_new();" href="#"><div class="stock_add_btn5" style="width:48%;margin-top: 58px;font-size: 15px;margin-left: 12px">YES</div></a>
            <a  onclick="$('#confirm_pop_all').hide();" href="#"><div class="stock_add_btn5" style="width:48%;margin-top: 58px;font-size: 15px">NO</div></a>
        </div>
        
    </div>
   </div>


    </body>
    

</html>