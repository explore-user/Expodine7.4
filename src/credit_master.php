<?php //session_start();
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
require_once("includes/title_settings.php");
//include('includes/menu_settings.php');
include("api_multiplelanguage_link.php");
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
if($_SERVER['REQUEST_METHOD']=='POST')
{
 
   	$insertion['crd_branchid'] 		=  $_SESSION['branchofid'];
		 	
			
	if(isset($_REQUEST['chkactive']))
	{
	 $insertion['crd_active'] 		=  'Y';
	}else
	{
	 $insertion['crd_active'] 		=  'N';
	}
			$insertion['crd_type'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['type']));	
			$insertion['crd_totalamount'] =		0;
			
			if($_REQUEST['room']!="")
			{
			$insertion['crd_roomid'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['room']));	
			}
			else if($_REQUEST['staff']!="")
			{
				$insertion['crd_staffid'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['staff']));	
			}
                        else if($_REQUEST['company']!="")
                        {        
                                $insertion['crd_corporateid'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['company']));	
                        }
                        else if($_REQUEST['guest']!="")
                        { 
                                $insertion['crd_guestid'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['guest_hid']));	
                        }

				
			
			
			
			
    $sql=$database->check_duplicate_entry('tbl_credit_master',$insertion);
    echo $sql;
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_credit_master',$insertion);
	
        
        
        /////company/////
        if($_REQUEST['company']!="")
        {
           $cr='20';
           $company_acc='';
           $sql_kot  =  $database->mysqlQuery("select ct_corporatename from tbl_corporatemaster where ct_corporatecode='".$_REQUEST['company']."'"); 
	   $num_kot   = $database->mysqlNumRows($sql_kot);
	   if($num_kot){
	   while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
	   {
               $company_acc=$result_kot['ct_corporatename'];
           }}
           
      $insertion1['tlm_company_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['company']));
      $insertion1['tlm_ledger_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($company_acc));
      $insertion1['tlm_group'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($cr));
      
      
              	
       $sql1=$database->check_duplicate_entry('tbl_ledger_master',$insertion1);
  
	 if($sql1!=1)
	{
	$insertid1              			=  $database->insert('tbl_ledger_master',$insertion1);
        } 
            
        }  
        
        
         /////staff/////
        if($_REQUEST['staff']!="")
        {
           $cr='20';
           $staff_acc='';
           $sql_kot  =  $database->mysqlQuery("select ser_firstname from tbl_staffmaster where ser_staffid='".$_REQUEST['staff']."'"); 
	   $num_kot   = $database->mysqlNumRows($sql_kot);
	   if($num_kot){
	   while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
	   {
               $staff_acc=$result_kot['ser_firstname'];
           }}
           
      $insertion11['tlm_staff_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['staff']));
      $insertion11['tlm_ledger_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($staff_acc));
      $insertion11['tlm_group'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($cr));
      
      
              	
       $sql1=$database->check_duplicate_entry('tbl_ledger_master',$insertion11);
  
	 if($sql1!=1)
	{
	$insertid11              			=  $database->insert('tbl_ledger_master',$insertion11);
        } 
            
        }  
        
        
        /////guest/////
        if($_REQUEST['guest']!="")
        {
           $cr='20';
           $guest_acc='';
           $sql_kot  =  $database->mysqlQuery("select ly_firstname from tbl_loyalty_reg where ly_id='".$_REQUEST['guest_hid']."'"); 
	   $num_kot   = $database->mysqlNumRows($sql_kot);
	   if($num_kot){
	   while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
	   {
               $guest_acc=$result_kot['ly_firstname'];
           }}
           
      $insertion111['tlm_guest_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['guest_hid']));
      $insertion111['tlm_ledger_name'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($guest_acc));
      $insertion111['tlm_group'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($cr));
      
      
              	
       $sql11=$database->check_duplicate_entry('tbl_ledger_master',$insertion111);
  
	 if($sql11!=1)
	{
	$insertid111              			=  $database->insert('tbl_ledger_master',$insertion111);
        } 
            
        }  
        
        
        
        //echo $insertid;
	 }
	header("location:state_master.php?msg=2");
	 if (!headers_sent())
    {    
        header('Location:credit_master.php?msg=2');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="credit_master.php?msg=2";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=credit_master.php?msg=2" />';
        echo '</noscript>'; exit;
    }
}




if(isset($_REQUEST['delete']))
{
    $id=$_REQUEST['id'];
  
if($_REQUEST['delete']=="yes")
	{
		
		$result=$database->mysqlQuery("UPDATE  tbl_credit_master SET  crd_active='Y' WHERE crd_id = '" .$_REQUEST['id']."'");
	}else
	{
		$result=$database->mysqlQuery("UPDATE  tbl_credit_master SET  crd_active='N' WHERE crd_id = '" .$_REQUEST['id']."'");
	}
	 //header("location:category_master.php?msg=3");
	 	 if (!headers_sent())
    {    
        header('Location: credit_master.php?msg=3');
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="credit_master.php?msg=3";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=credit_master.php?msg=3" />';
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
<title>Credit</title>
<meta name="description" content="">
<link href="images/favicon.png" rel="shortcut icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="img/favicon.ico">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/normal.css" type="text/css" /><!-- Responsive -->
<link rel="stylesheet" href="master_style/table_style.css">	
<!--<link href="css/credit_style.css" rel="stylesheet" type="text/css">-->
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="master_style/popup/default.css" />
<link rel="stylesheet" type="text/css" href="master_style/popup/component.css" />
<link href="css/billgeneration_new.css" rel="stylesheet" type="text/css">

 <script src="js/jquery-1.10.2.min.js"></script>
<script src="master_style/js/modernizr.custom.js"></script>
<style>
::-webkit-scrollbar {width: 12px;height: 10px;}
#ascrail2002{z-index: 9999999999999999999 !important;left:2px !important }
aside { width: 238px !important}
.min-nav aside {width: 60px !important;}
.ui-autocomplete{z-index:999999 !important;}
.tablesorter tbody{min-height: 420px;height:69vh;}
.contant_table_cc{height: 65vh;min-height:460px;}
.new_overlay{width:100%;height:100%;background-color:rgba(0,0,0,0.8);position:fixed;z-index:999;height: 100%;}
	.responstable th, .responstable td{padding: 0.3em !important;} 
	.filte_new_text{overflow:hidden}
	.menu_top_filter_left{border:0;margin:0}
	.filte_new_text{text-align:left;float:left}
	.food_increant_table_container{margin-top:0;border-top: 7px solid #D0D0D0;padding-bottom:0px;height:75vh;min-height:380px;overflow:auto;padding-bottom:15px;}
	.responstable th{border:0;}
	.kot_dis_table th, td{height: 30px;font-size:13px;}
	.food_incrient_add_contain{text-align:center;line-height:23px;color:#fff;font-size:18px;height:30px;border-top:0px;margin-top:0;}
	.filte_new_text {width:auto;height:28px;line-height:28px;font-size: 14px;padding-right: 2%;}
	.food_increant_txtbox{float:left;width: 65%;height:26px;}
	.food_incread_add_btn{height: 21px;line-height: 20px;margin-top: 3px;margin-left: 2px;border-radius: 10px;background-color: #F5801B;
	box-shadow:0px 0px 5px #000;width: 130px;padding:0;}
	.food_incread_add_btn:hover{background-color:#f00}
	.food_incread_add_btn::before{margin-top: 3px;display:none}
	.food_incrient_add_form_cc{min-height: 33px;}
	.food_incread_add_ico {height: 28px;margin-top: -1px;}
	.billgeneration_head{border:0}
        #suggession_name{background-color: #fff;z-index: 9999;    top: 27px;}
</style>
</head>
<body>
<div class="olddiv "></div> 
<div id="blr" class="container nopaddding">
 <?php  include "includes/topbar.php"; ?>
<div class="mian">
	<div class="view-container">
		<div style=" top: 58px;"  id="container">
        
        <div style="width:100%;margin-bottom: 7px;border-bottom: 2px #FB740D solid;" class="top_site_map_cc ">
      			 <?php if(in_array("Credit Settlement", $_SESSION['menumodarray'])){ ?>
              <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>credit.php  <?php }else {  ?>#<?php } ?>"><div class="new_tab_btn_credit "><?=$_SESSION['credit_settlement_settlement']?></div></a> 
              <?php } ?> 
              
               <?php if(in_array("Credit Master", $_SESSION['menumodarray'])){ ?>
              <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>credit_master.php  <?php }else {  ?>#<?php } ?>"><div class="new_tab_btn_credit new_tab_btn_credit_act"><?=$_SESSION['credit_settlement_creditmaster']?></div> </a>
              <?php } ?> 
              
        <?php include"includes/new_right_menu.php"; ?> 
            	<div class="billgeneration_head"><?=$_SESSION['credit_settlement_creditmaster']?></div>
                <div class="error_feed" style="color:#F00"></div>
                
              
                <div class="top_al_search_cc loaderror" ></div>
            </div>
			
                <div style="padding:0px;" class="content-sec">
                
                  <div style="padding:0px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main_cc">
                    <div class="food_recipe_content_cc">
                      
                     <div class="credit_add_container"> 
                      <div class="food_incrient_add_contain">
                      	<!--<div class="food_incread_add_btn"><a id="add" href="#">Filter</a></div>-->
                        	<!--Credit Master-->
                        </div><!---food_incrient_add_contain--->
                        
          <form role="form" action="credit_master.php"  method="post"  name="credit_master">               
                        <div style="padding-top: 3px;" class="food_incrient_add_form_cc">
                        		
                              <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:20%" id="type_div">
                            <span class="filte_new_text"><?=$_SESSION['credit_settlement_type']?></span>
                            <!--    <select type="text" class="form-control food_increant_txtbox"  placeholder="QTY" >-->
                                	<!--<option>Staff</option>
                                    <option>Credit</option>-->
                                    
                                     <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_credit_types where ct_active='Y'"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											
                     ?>
                         <select type="text" class="form-control food_increant_txtbox"  placeholder="Type" id="type" name="type" onChange="credittype(this.value)" >
                                     <!--   <select data-placeholder="Enter Country Name" id="country" name="country" data-rel="chosen" title="Country Name" left"." data-toggle="tooltip" class="form-control country">-->
                                        <option value=""><?=$_SESSION['credit_settlement_select']?></option>
                                         <!--<optgroup label="Type">-->
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['ct_creditid']?>" id="<?=$result_kot['ct_credit_type']?>"  title=""><?=$result_kot['ct_credit_type']// $result_kot['ct_credit_type']?></option>
                                    <?php } ?> 
                                        <!-- </optgroup>-->
                                    	 </select>
                                         <?php } ?>
                              <!--  </select>-->
                            </div><!---col-sm-2--->
                            
                            <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:20%;display:none" id="room_div" >
                            <span class="filte_new_text"><?=$_SESSION['credit_settlement_room']?></span>
                               <?php
										
                     ?>
                                <select type="text" class="form-control food_increant_txtbox"  placeholder="Enter rooom" id="room" name="room" >
                                	 <option value=""><?=$_SESSION['credit_settlement_select']?></option>
                                         <!--<optgroup label="Enter room">-->
                                         <?php   
                                                            $sql_kot  =  $database->mysqlQuery("select * from tbl_roommaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['rm_roomid']?>" id="<?=$result_kot['rm_roomid']?>"  ><?=$result_kot['rm_roomno']?></option>
                                                                                  <?php }} ?> 
                                         <!--</optgroup>-->
                                </select>
                                   
                            </div><!---col-sm-2--->
                            
                            
                            <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:20%;display:none" id="staff_div" >
                            <span class="filte_new_text"><?=$_SESSION['credit_settlement_staf']?></span>
                               <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_staffmaster WHERE  ser_employeestatus='Active'"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											
                     ?>
                            
                                <select type="text" class="form-control food_increant_txtbox"  placeholder="Enter staff" id="staff" name="staff" >
                                	 <option value=""><?=$_SESSION['credit_settlement_select']?></option>
                                        <!-- <optgroup label="Enter staff">-->
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
                                                                            //$credit_staffid=  trim(json_encode($result_kot['ser_staffid']),'""');
                                                                            $credit_staffid=  $result_kot['ser_staffid'];
                                                                            $credit_staff_name=$result_kot['ser_firstname'].' '.$result_kot['ser_lastname']  ; 
//                                                                            $fpstaff=fopen($apilink."/src/main_menu_display.php?set=staff_ordertake&staffid=$credit_staffid&dat=$other_lang","r");
//                                                                            //echo $apilink."/src/main_menu_display.php?set=staff_ordertake&staffid=$credit_staffid&dat=$other_lang";
//                                                                            $response_staff['messages'] = stream_get_contents($fpstaff);
//                                                                            //var_dump($response_staff['messages']);
//                                                                            $resu_staff= json_decode($response_staff['messages'],true);
//                                                                            //var_dump($resu_staff['staff_id']);
//                                                                            $staff_count=count($resu_staff['staff_id']);
                                                                           
                                                                                
                                                                            
                                                                            
                                                                            
                                                                            
                                                                            
									?>
                                            <option value="<?=$credit_staffid?>" id="<?=$credit_staffid?>"  ><?=$credit_staff_name//$result_kot['ser_firstname']?></option>
                                    <?php } ?> 
                                        <!-- </optgroup>-->
                                </select>
                                   <?php } ?> 
                            </div><!---col-sm-2--->
                            
                            
                            
                          <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:20%;display:none" id="company_div" >
                            <span class="filte_new_text"><?=$_SESSION['credit_settlement_company']?></span>
                               <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_corporatemaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											
                     ?>
                            
                                <select type="text" class="form-control food_increant_txtbox"  placeholder="Enter company" id="company" name="company" >
                                	 <option value=""><?=$_SESSION['credit_settlement_select']?></option>
                                        <!-- <optgroup label="Enter company">-->
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['ct_corporatecode']?>" id="<?=$result_kot['ct_corporatecode']?>"  ><?=$result_kot['ct_corporatename']?></option>
                                    <?php } ?> 
                                         <!--</optgroup>-->
                                </select>
                                   <?php } ?> 
                            </div><!---col-sm-2--->
                            
                            <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:20%;display:none" id="guest_div" >
                            <span class="filte_new_text"><?=$_SESSION['credit_settlement_guest']?></span>
                            
                            <span class="room_text_box_cc" style="width: 80%;margin-bottom:0">
                        <input type="text" class="form-control food_increant_txtbox"  placeholder="Enter guest" id="guest" name="guest" onclick=" return name_search_click();" onchange=" return name_search(this.value)" onkeyup=" return name_search(this.value)" autocomplete="off">
                        <input type="hidden" id="guest_hid" name="guest_hid">
                        <div id="suggession_name" style="display:none"></div>
                    </span>
                            
                            
                         
                            </div><!---col-sm-2--->
                            
                            
                            
                            
                            <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:10%">
                            <span class="filte_new_text"><?=$_SESSION['credit_settlement_status']?></span>
                               <input class="chk_12" name="chkactive" type="checkbox" value="y" id="chkactive" checked>
                            </div><!---col-sm-2--->
                            
                        
                             <div class="col-sm-5" style="width:10%;padding:0">
                             	<div class="food_incread_add_ico"><a href="#"  onClick="validate_registration()"><?=$_SESSION['credit_settlement_submit_button']?></a></div>
                             </div><!---col-sm-2--->
                             
                             <div class="col-sm-5" style="width:10%;padding:0;margin-left:1%;">
                             	<div class="food_incread_add_ico"><a id="add"  href="#"><?=$_SESSION['credit_settlement_cancel_button']?></a></div>
                             </div><!---col-sm-2--->
                        </div><!--food_incrient_add_form_cc-->
                        </form>
                        </div><!--credit_add_container-->
                       
                       <div class="credit_filter_container"> 
                        <div  class="food_incrient_add_contain">
                            <div class="food_incread_add_btn" ><a id="filter" style="font-size:18px" href="#"><?=$_SESSION['credit_settlement_add_button']?></a></div>
                               <!-- Credit Master-->
                        </div><!---food_incrient_add_contain--->
                        
                        <div style="padding-top: 3px;" class="food_incrient_add_form_cc">
                        
                        	<div class="credit_master_filter_left_txt"><?=$_SESSION['credit_settlement_filter']?></div>
                        
                              <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:20%">
                            <span class="filte_new_text"><?=$_SESSION['credit_settlement_type']?></span>
                                     <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_credit_types where ct_active='Y'"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											
                     ?>
                     
                      <select type="text" class="form-control food_increant_txtbox"  placeholder="Type" id="typesrch" name="typesrch" onChange="credittypesrcch(this.value)" >
                                     <!--   <select data-placeholder="Enter Country Name" id="country" name="country" data-rel="chosen" title="Country Name" left"." data-toggle="tooltip" class="form-control country">-->
                                        <option value="">All</option>
                                       <!--  <optgroup label="Type">-->
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['ct_creditid']?>" id="<?=$result_kot['ct_credit_type']?>"  title=""><?=$result_kot['ct_credit_type']//$result_kot['ct_credit_type']?></option>
                                    <?php } ?> 
                                       <!--  </optgroup>-->
                                    	 </select>
                                         <?php } ?>
                          
                            </div><!---col-sm-2--->
                            
                              
                            <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:20%;display:none" id="roomsr_div" >
                            <span class="filte_new_text"><?=$_SESSION['credit_settlement_room']?></span>
                               <?php
										 
											
                     ?>
                            
                                <select type="text" class="form-control food_increant_txtbox"  placeholder="Enter rooom" id="roomsr" name="roomsr" onChange="validateSearch()"  >
                                	 <option value=""><?=$_SESSION['credit_settlement_select']?></option>
                                      <!--   <optgroup label="Enter room">-->
                                         <?php                      
                                                                $sql_kot  =  $database->mysqlQuery("select * from tbl_roommaster"); 
                                                                                
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['rm_roomid']?>" id="<?=$result_kot['rm_roomid']?>"  ><?=$result_kot['rm_roomno']?></option>
                                                                                  <?php }} ?> 
                                         <!--</optgroup>-->
                                </select>
                                   
                            </div><!---col-sm-2--->
                            
                            
                            <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:20%;display:none" id="staffsr_div" >
                            <span class="filte_new_text"><?=$_SESSION['credit_settlement_staf']?></span>
                               <?php
					$sql_kot  =  $database->mysqlQuery("select * from tbl_staffmaster WHERE ser_employeestatus='Active'"); 
					$num_kot   = $database->mysqlNumRows($sql_kot);
					if($num_kot){
											
                     ?>
                            
                                <select type="text" class="form-control food_increant_txtbox"  placeholder="Enter staff" id="staffsr" name="staffsr" onChange="validateSearch()" >
                                	 <option value="">All</option>
                                        <!-- <optgroup label="Enter staff">-->
                                         <?php 
                                            while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
                                            {   
                                                $credit_staffid1= $result_kot['ser_staffid'];
                                                $credit_staff_name1=$result_kot['ser_firstname'].' '.$result_kot['ser_lastname'] ;
//                                                $fpstaff=fopen($apilink."/src/main_menu_display.php?set=staff_ordertake&staffid=$credit_staffid1&dat=$other_lang","r");
//                                                $response_staff['messages'] = stream_get_contents($fpstaff);
//                                                //var_dump($response_staff['messages']);
//                                                $resu_staff= json_decode($response_staff['messages'],true);
//                                                $staff_count=count($resu_staff['staff_id']);
                                               
                                                //$credit_staff_name1=$resu_staff['staff_name'][0]  ; 
                                                
                                                
                                                ?>
                                            <option value="<?=$credit_staffid1?>" id="<?=$credit_staffid1?>"  ><?=$credit_staff_name1//$result_kot['ser_firstname']?></option>
                                    <?php } ?> 
                                     <!--    </optgroup>-->
                                </select>
                                   <?php } ?> 
                            </div><!---col-sm-2--->
                            
                            
                            
                          <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:20%;display:none" id="companysr_div" >
                            <span class="filte_new_text"><?=$_SESSION['credit_settlement_company']?></span>
                               <?php
										 $sql_kot  =  $database->mysqlQuery("select * from tbl_corporatemaster"); 
										  $num_kot   = $database->mysqlNumRows($sql_kot);
										  if($num_kot){
											
                     ?>
                            
                                <select type="text" class="form-control food_increant_txtbox"  placeholder="Enter company" id="companysr" name="companysr" onChange="validateSearch()" >
                                	 <option value="">All</option>
                                       <!--  <optgroup label="Enter company">-->
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['ct_corporatecode']?>" id="<?=$result_kot['ct_corporatecode']?>"  ><?=$result_kot['ct_corporatename']?></option>
                                    <?php } ?> 
                                         <!--</optgroup>-->
                                </select>
                                   <?php } ?> 
                            </div><!---col-sm-2--->
                            
                            
                            
                            
                            <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:20%;display:none" id="guestsr_div" >
                            <span class="filte_new_text"><?=$_SESSION['credit_settlement_guest']?></span>
                               <?php
						$sql_kot  =  $database->mysqlQuery("select ly_id,ly_firstname from tbl_loyalty_reg order by ly_firstname asc "); 
						$num_kot   = $database->mysqlNumRows($sql_kot);
						if($num_kot){
											
                     ?>
                            
                                <select type="text" class="form-control food_increant_txtbox"  placeholder="Enter guest" id="guestsr" name="guestsr" onChange="validateSearch()" >
                                	 <option value="">All</option>
                                        <!-- <optgroup label="Enter guest">-->
                                         <?php 
									while($result_kot  = $database->mysqlFetchArray($sql_kot)) 
										{
									?>
                                            <option value="<?=$result_kot['ly_id']?>" id="<?=$result_kot['ly_id']?>"  ><?=$result_kot['ly_firstname']?></option>
                                    <?php } ?> 
                                        <!-- </optgroup>-->
                                </select>
                                   <?php } ?> 
                            </div><!---col-sm-2--->
                            
                            
                            
                            
                                
                            <div class="col-sm-6" style="padding-right: 5px;padding-left: 0px;width:20%"  >
                            <span class="filte_new_text"><?=$_SESSION['credit_settlement_status']?></span>
                          
                             <select  class="form-control food_increant_txtbox"  id="statuss" name="statuss" onChange="validateSearch()">
                                   <option value="null"><?=$_SESSION['credit_settlement_all']?></option>	
                                    <option value="Y"><?=$_SESSION['credit_settlement_active']?></option>
                                    <option value="N"><?=$_SESSION['credit_settlement_inactive']?></option>
                          
                               
                                	
                                </select>
                                
                            </div><!---col-sm-2--->
                            
                            
                            
                            
                            
                            
                            
                            
                       
                            
                            
                             <!--<div class="col-sm-5" style="width:10%;padding:0">
                             	<div class="food_incread_add_ico"><a href="#">Submit</a></div>
                             </div>--><!---col-sm-2--->
                        </div><!--food_incrient_add_form_cc-->
                        </div><!--credit_filter_container-->
                         
                        
                        <div class="food_increant_table_container">
                     <table class="responstable tablesorter" id="listall">
                        <thead>
                         	 <tr>
                           
                                <th  width="10%"  class="header"><?=$_SESSION['credit_settlement_type']?></th>
       				<th width="10%" class="header"><?=$_SESSION['credit_settlement_credit_to']?></th>
                                <th width="10%" class="header"><?=$_SESSION['credit_settlement_amount']?></th>
                                 <th width="10%" class="header"><?=$_SESSION['credit_settlement_active']?></th>
                               </tr>
                            </thead>
                            <tbody style="height:7vh">
                             <?php
	// $sql_login  =  $database->mysqlQuery("select * from tbl_credit_master left join tbl_credit_types on tbl_credit_master.crd_type=tbl_credit_types.ct_creditid left join tbl_roommaster on tbl_credit_master.crd_roomid=tbl_roommaster.rm_roomid left join tbl_staffmaster on tbl_credit_master.crd_staffid=tbl_staffmaster.ser_staffid left join tbl_corporatemaster on  tbl_credit_master.crd_corporateid=tbl_corporatemaster.ct_corporatecode left join tbl_loyalty_reg on tbl_credit_master.crd_guestid=tbl_loyalty_reg.ly_id  WHERE  tbl_staffmaster.ser_employeestatus='Active'"); 
	$sql_login  =  $database->mysqlQuery("select ct.ct_credit_type as type,cm.ct_corporatename as company_name,l.ly_mobileno,l.ly_firstname as guest_name,COALESCE(s.ser_firstname,'',s.ser_lastname) as staff_name,
r.rm_roomno as room_name,c.crd_totalamount as total_amount,c.crd_active as active,crd_roomid,crd_staffid,crd_corporateid,crd_guestid,crd_id from tbl_credit_master c 
left join tbl_credit_types ct ON ct.ct_creditid = c.crd_type
left join tbl_corporatemaster cm ON cm.ct_corporatecode = c.crd_corporateid
left join tbl_loyalty_reg l ON l.ly_id = c.crd_guestid
left join tbl_staffmaster s ON s.ser_staffid = c.crd_staffid
left join tbl_roommaster r ON r.rm_roomid = c.crd_roomid where c.crd_totalamount>=0 "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['active']=="Y")
				{
					$active=$_SESSION['credit_settlement_active_yes'];
					
				}else 
				{
					$active=$_SESSION['credit_settlement_active_no'];
				}	
				if($result_login['crd_roomid'] !="")
				{
					$party= $result_login['room_name'];//$result_login['room_name'];
				}
				else if($result_login['crd_staffid']!="")
				{
					$party=$result_login['staff_name'];//$result_login['staff_name'];
				}
				else if($result_login['crd_corporateid']!="")
				{
					$party=$result_login['company_name'];//$result_login['company_name'];
				}
				else
				{
					$party=$result_login['guest_name'].' - '.$result_login['ly_mobileno'];
				}
                                
				$name='';
				if(($result_login['type'])=="By Staff")
				{
					$name=$_SESSION['credit_settlement_by_staff'];//$staff['ser_firstname'];
				}else if($result_login['type']=="By Room")
				{
					$name=$_SESSION['credit_settlement_by_room'];//$staff['rm_roomno'];
				}else if($result_login['type']=="By Company")
				{
					$name=$_SESSION['credit_settlement_by_company'];//$staff['ct_corporatename'];
				}else if($result_login['type']=="By Guest")
				{
					//$staff=$database->show_masterloyality_details($result_login['crd_guestid']);
					$name=$_SESSION['credit_settlement_by_guest'];
				}
	  
	 ?>
    						<tr id="ids_<?=$result_login['crd_id']?>"  class="select">
                         <!--      	<td width="5%"><a href="#" class="tab_edt_btn md-trigger_edit" id="ids_<?=$result_login['crd_id']?>"><i class="fa fa-edit"></i></a>    <input type="hidden" name="hiddenmenuid" id="hiddenmenuid" value="<?=$result_login['crd_id']?>"></td>-->
                                                    <td style="height:10px !important" width="10%"  ><?=$name?></td>
                                <td width="10%" ><?=$party?></td>
                                <td width="10%" ><?=$result_login['total_amount']?></td>
                                 <td width="10%" >
                
                                 <?php if($result_login['active']=="Y"){ ?>  
                                 <a   data-modal-id="popup1"  class="active_btn_pop" href="#" id="ids_<?=$result_login['crd_id']?>" title="ToNo" > <?=$active?></a>
                                 <?php } else{ ?>
                                  <a   data-modal-id="popup11"  class="active_btn_pop" href="#" id="ids_<?=$result_login['crd_id']?>" title="ToYes" ><?=$active?></a>
                                 <?php } ?>  
                                 </td>
                                <!-- <a data-modal-id="popup1"  class="active_btn_pop" href="#"><?=$active?></a></td>-->
                                                
                              </tr>
                               
                              <?php } } ?>
                            </tbody>
                        </table>      
                            
                            
                            
                            
                      <!--    <tbody>
                       		 <tr>
                              	<td width="5%"><a class="tab_edt_btn md-trigger_edit"><i class="fa fa-edit"></i></a></td>
                                <td width="20%">Staff</td>
                                <td width="10%">Staff</td>
                                <td width="10%">200</td>
                                <td width="10%"><a data-modal-id="popup1"  class="active_btn_pop" href="#">Yes</a></td>
                                
                            </tr>
                        
                        </tbody>-->
                      </table>
                        </div><!---food_increant_table_container--->
                        
                   </div><!--food_recipe_content_cc---> 
                       
               	    </div><!--main_cc-->
                 
		</div><!---content-sec--->
	</div><!--#container-->
</div><!---view-container--->
</div><!--mian-->
</div><!---container nopaddding--->

  
  
  
  
    
        
  
   
   
   
   	 
		 <div id="popup1" class="modal-box">
  <header> <a href="#" class="js-modal-close close">×</a>
    <h3>CONFIRM</h3>
  </header>
  <input type="hidden" id="hidcancel" name="hidcancel">
    <input type="hidden" id="hidcanc" name="hidcanc">
  <div class="modal-body">
    <h2>Change Status to Inactive ?</h2>
  </div>
 

    <footer> 
  	<a href="#" class="btn btn-small  btn_md_pop" onClick="validate_sv()"><?=$_SESSION['credit_settlement_popup_save_button']?></a> 
    <a href="#" class="btn btn-small js-modal-close btn_md_pop"><?=$_SESSION['credit_settlement_popup_close_button']?></a> 
  </footer>
</div>     
		 
<div id="popup11" class="modal-box">
  <header> <a href="#" class="js-modal-close close">×</a>
    <h3>CONFIRM</h3>
  </header>
  <input type="hidden" id="hidcancel" name="hidcancel">
    <input type="hidden" id="hidcanc" name="hidcanc">
  <div class="modal-body">
    <h2><?=$_SESSION['credit_settlement_popup_credit_cancel']?></h2>
  </div>
 

    <footer> 
  	<a href="#" class="btn btn-small  btn_md_pop" onClick="validate_sv()"><?=$_SESSION['credit_settlement_popup_save_button']?></a> 
    <a href="#" class="btn btn-small js-modal-close btn_md_pop"><?=$_SESSION['credit_settlement_popup_close_button']?></a> 
  </footer>
</div>     
  
  
  
   
   
   
   
   
   
    
        
<div class="md-overlay"></div><!-- the overlay element -->
 <div style="display:none" class="index_popup_1 closeoneclass">
 	<div class="index_popup_contant">Are you Sure you Want to Delete</div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="closeok">Ok</a></div>
        <div class="btn_index_popup"><a href="#" class="closecancel">Cancel</a></div>
    </div>
 </div>
 
 <div style="display:none" class="confrmation_overlay"></div>

<style>
.food_recipe_content_cc {height: 83.5vh;min-height: 510px;margin: 0 0 0 0.5%;}
.modal-body h2{
	    font-size: 24px;
    padding-top:0px;
    margin-bottom: 0;
	}
.modal-box {
  display: none;
  position: absolute;
  z-index: 1000;
  width: 98%;
  background: white;
  border-bottom: 1px solid #aaa;
  border-radius: 4px;
  box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  border: 1px solid rgba(0, 0, 0, 0.1);
  background-clip: padding-box;
}
@media (min-width: 32em) {

.modal-box { width: 30%; }
}

.modal-box header,
.modal-box .modal-header {
  padding: 0.8em 1.5em;
  border-bottom: 1px solid #ddd;
      float: left;
    position: relative;
    width: 100%;
	    background-color: #EFEFEF;
}

.modal-box header h3,
.modal-box header h4,
.modal-box .modal-header h3,
.modal-box .modal-header h4 { margin: 0; font-family: 'RobotoRegular';font-size: 18px;}

.modal-box .modal-body {padding: 0em 0 10px 1.5em;display: inline-block;width: 100%;}

.modal-box footer,
.modal-box .modal-footer {
padding: 0.4em;
  /*border-top: 1px solid #ddd;*/
  background: rgba(0, 0, 0, 0.02);
  text-align: right;
  padding-top:0;
}

.modal-overlay {
  opacity: 0;
  filter: alpha(opacity=0);
  position: absolute;
  top: 0;
  left: 0;
  z-index: 900;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.9) !important;
}

a.close {
  line-height: 1;
  font-size: 1.5em;
  position: absolute;
    top: 10px;
  right: 2%;
  text-decoration: none;
  color: #272727;
}

a.close:hover {
  color: #222;
  -webkit-transition: color 1s ease;
  -moz-transition: color 1s ease;
  transition: color 1s ease;
}
.btn_md_pop{
	padding: 6px 12px !important;
	background-color: brown;
    color: #fff;
	}

</style>

<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="master_style/js/classie.js"></script>
<script src="master_style/js/modalEffects.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script type="text/ecmascript">
	$(document).ready(function() { 
$(".food_item_del").click(function() {
    $(".index_popup_1").show();
	$(".confrmation_overlay").show();
 });
 
  $(".btn_index_popup").click(function() {
    $(".index_popup_2").hide();
	$(".index_popup_1").hide();
	$(".confrmation_overlay").hide();
 });
 
  $("#add").click(function() {
    $(".credit_add_container").hide();
	$(".credit_filter_container").show();
 });
  $("#filter").click(function() {
    $(".credit_add_container").show();
	$(".credit_filter_container").hide();
 });
 
	});
</script>
<script>
function validate_registration()
			{
                            
			 if(validate_credit())
				{
                         document.credit_master.submit();
				}
			}
			function  validate_credit()
			{
				if($("#type").val()=="")
				{
					$("#type_div").addClass("has-error");
						  document.credit_master.type.focus();
						  return false;
                                                  
				}
                               
				else{           
                                    
                                        if($("#staff").val()=="" && $("#type").val()=='2' )
                                        { //alert('1');
                                            $("#staff_div").addClass("has-error");
                                            document.credit_master.staff.focus();
                                            return false;
                                        }
                                        else if($("#company").val()=="" && $("#type").val()=='3')
                                        { //alert('2');
                                            $("#company_div").addClass("has-error");
                                            document.credit_master.company.focus();
                                            return false;
                                        }
                                        else if($("#guest").val()=="" && $("#type").val()=='4')
                                        { //alert('3');
                                            $("#guest_div").addClass("has-error");
                                            document.credit_master.guest.focus();
                                            return false;
                                        }
                                        
                                        else{
                                            
                                            if($("#staff").val()!=""){
                                                
                                                $("#staff_div").removeClass("has-error");
                                                $(this).addClass("has-success");
                                                return true;
                                            }
                                            else if($("#company").val()!=""){
                                                
                                                $("#company_div").removeClass("has-error");
                                                $(this).addClass("has-success");
                                                return true;
                                            }
                                            else if($("#guest").val()!=""){
                                                
                                                $("#guest_div").removeClass("has-error");
                                                $(this).addClass("has-success");
                                                return true;
                                            }
                                        }
                                         
                                                
						$("#type_div").removeClass("has-error");
						$(this).addClass("has-success");
						return true;
                                    }
			}


function credittype(rpt)
{
	var type=rpt;//summarydiv  datepickerfromsummary datepickertosummary bydatesummary summary

	if(type=="1")
	{
		$('#room_div').css("display","block");
		$('#staff_div').css("display","none");
		$('#company_div').css("display","none");
		$('#guest_div').css("display","none");
		
	}
	else if(type =="2")
	{
		$('#room_div').css("display","none");
		$('#staff_div').css("display","block");
		$('#company_div').css("display","none");
		$('#guest_div').css("display","none");
		
	}
	else if(type=="3")
	{ $('#room_div').css("display","none");
	  $('#staff_div').css("display","none");
	  $('#company_div').css("display","block");
	  $('#guest_div').css("display","none");
	}
	else if(type =="4")
	{
		$('#room_div').css("display","none");
		$('#staff_div').css("display","none");
		$('#company_div').css("display","none");
		$('#guest_div').css("display","block");
	}
	
}

function credittypesrcch(rpt)
{
	var typesr=rpt;
	if(typesr =="1")
	{
		$('#roomsr_div').css("display","block");
		$('#staffsr_div').css("display","none");
		$('#companysr_div').css("display","none");
		$('#guestsr_div').css("display","none");
		
$('#staffsr').find('option:first').attr('selected', 'selected');
$('#companysr').find('option:first').attr('selected', 'selected');
$('#guestsr').find('option:first').attr('selected', 'selected');
		validateSearch();
	}
	else if(typesr =="2")
	{ $('#roomsr_div').css("display","none");
		$('#staffsr_div').css("display","block");
		$('#companysr_div').css("display","none");
		$('#guestsr_div').css("display","none");
				
$('#roomsr').find('option:first').attr('selected', 'selected');
$('#companysr').find('option:first').attr('selected', 'selected');
$('#guestsr').find('option:first').attr('selected', 'selected');
		validateSearch();
	}
	else if(typesr =="3")
	{
		$('#roomsr_div').css("display","none");
	  $('#staffsr_div').css("display","none");
	  $('#companysr_div').css("display","block");
	  $('#guestsr_div').css("display","none");
	  $('#roomsr').find('option:first').attr('selected', 'selected');
$('#staffsr').find('option:first').attr('selected', 'selected');
$('#guestsr').find('option:first').attr('selected', 'selected');
	  validateSearch();
	}
	else 
	{ 
		$('#roomsr_div').css("display","none");
		$('#staffsr_div').css("display","none");
		$('#companysr_div').css("display","none");
		$('#guestsr_div').css("display","block");
		 $('#roomsr').find('option:first').attr('selected', 'selected');
$('#staffsr').find('option:first').attr('selected', 'selected');
$('#companysr').find('option:first').attr('selected', 'selected');

		validateSearch();
	}
}
function validateSearch()
{
	
	 var type=$("#typesrch").val();
  if(type=="")
  {
	  type="null";
  }
 // alert(type);
  var rum=$("#roomsr").val();
  if(rum=="")
  {
	  rum="null";
  }
 // alert(rum);
  var stf=$('#staffsr').val();
  if(stf =="")
  {
	  stf="null";
  }
  //alert(stf);
  var cmp=$('#companysr').val(); 
  if(cmp =="")
  {
	  cmp="null";
}
//alert(cmp);
   var gst=$('#guestsr').val();
   if(gst=='' || gst=="undefined") 
   {
	   gst="null";
   }
 
   var statuss=$("#statuss").val();
  if(statuss=="")
  {
	  statuss="null";
  }
 // alert(statuss);
// alert(type);
// 
//  alert(rum);
//   alert(stf);
//     alert(cmp);
//       alert(gst);
//         alert(statuss);
   
	  $.ajax({
			type: "POST",
			url: "load_divmaster.php",
			data: "value=searchcredit&type="+type+"&rum="+rum+"&stf="+stf+"&cmp="+cmp+"&gst="+gst+"&status="+statuss,
			success: function(msg)
			{
				//alert(msg);
			$('#listall').html(msg);
			}
		});  
	
	
	
	
}

</script>

<script>
function validate_sv(id,status)
{
var a=	$('#hidcancel').val();
	var b=$('#hidcanc').val();
	 	if(b=="ToYes")
		{
		window.location="credit_master.php?id="+a+"&delete=yes";
		}else
		{window.location="credit_master.php?id="+a+"&delete=no";
		}
		
		
		$('#hidcancel').val("");
		$('#hidcanc').val("");
}

/*$('.btn btn-small  btn_md_pop').click(function() {
	alert('a');

});
*/

</script>
<script>

function name_search_click() {
     $("#suggession_name").hide();
}

function name_search(name) {
    
    if(name.length>2){
        
        var data_number='';
        var data_name='';
        var data1="set=guest_search_credit&number=&name="+name+"&credit_type=4";
     
        $.ajax({
        type: "POST",
        url: "load_paymentpending.php",
        data: data1,
        success: function(data)
        {    $("#suggession_name").show();
            $("#suggession_name").html('');
         
            data1=JSON.parse(data);
           var data_number=data1.mobile;
           var data_name=data1.name;
           var data_name_id=data1.name_id;
         
        for(var j=0;j<data_name.length;j++)
                {
                   $("#suggession_name").append('<div id="'+data_name[j]+'"  onclick="return name_select(this.id,'+data_number[j]+','+data_name_id[j]+')">'+data_name[j]+' - '+data_number[j]+' </div>') ;
                   
                }
        }
    });
    
    
       
         
        }
       
    }

function name_select(name,number,id){
  
        $('#guest').val(name+' - '+number);
         $('#guest_hid').val(id);
    
    $("#suggession_name").html('');
     $("#suggession_name").hide();
    
}

	


$(function(){

var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

	$('.active_btn_pop').click(function(e) {
		e.preventDefault();
    $("body").append(appendthis);
    $(".modal-overlay").fadeTo(500, 0.7);
    //$(".js-modalbox").fadeIn(500);
		var modalBox = $(this).attr('data-modal-id');
		$('#'+modalBox).fadeIn($(this).data());
		
			var id_str   =  $(this).attr("id");
	 var id_arr	  =	 id_str.split("_");
		 var selval       =  id_arr[1];
		
		var title=$(this).attr("title");
		
		
		$('#hidcancel').val(selval);
$('#hidcanc').val(title);
	
	/*	if(title=="ToYes")
		{
		window.location="credit_master.php?id="+selval+"&delete=yes";
		}else
		{window.location="credit_master.php?id="+selval+"&delete=no";
		}*/
		  //$("#popup1").attr("id", selval);

		
	});  
	
	
	
	
	
	
	
  
  
$(".js-modal-close, .modal-overlay").click(function() {
    $(".modal-box, .modal-overlay").fadeOut(500, function() {
        $(".modal-overlay").remove();
    });
 
});
 
$(window).resize(function() {
    $(".modal-box").css({
        top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
        left: ($(window).width() - $(".modal-box").outerWidth()) / 2
    });
});
 
$(window).resize();









 
});








</script>


<div style="position:fixed;width:100%;left:30%;top:0%;z-index:99999;" class="mynewpopupload"  ></div>
</body>
</html>