<?php
 session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
include('includes/master_settings.php');
require_once("Escpos.php");
mysqli_set_charset($con,"utf8");
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
require_once("cashdrawer_functions.php");
$opendrawer=new CashDrawerCommonSettings();

if($_SESSION['s_cash_drawer']=="Y" && $_SESSION['s_permit_cash_drawer_open']=='Y')
{
	if(($_REQUEST['set']=="drawer_open") && $_SESSION['s_cash_drawer_settle_btn']=='Y')
		{
			$result=$opendrawer->opendrawer($_SESSION['date'],$_SESSION['branchofid'],$_SESSION['expodine_id'],$_SESSION['hostname'],"web");
			echo $result;
		}
            if(($_REQUEST['set']=="drawer_open_on_settle") && $_SESSION['s_cash_drawer_settle_btn']=='N')
		{
			$result=$opendrawer->opendrawer($_SESSION['date'],$_SESSION['branchofid'],$_SESSION['expodine_id'],$_SESSION['hostname'],"web");
			echo $result;
		}    
                
           if(($_REQUEST['set']=="drawer_ta_open_settlepopup"))
	     {
                   
                   if( $_SESSION['s_cash_drawer_settle_btn_tahd']=='Y'){
			$result=$opendrawer->opendrawer($_SESSION['date'],$_SESSION['branchofid'],$_SESSION['expodine_id'],$_SESSION['hostname'],"web");
			echo $result;
                   }
	      } 
                
                
                   if(($_REQUEST['set']=="drawer_open_after_settlement_ta"))
		{
                   
                   if( $_SESSION['s_cash_drawer_settle_btn_tahd']=='N'){
                       
			$result=$opendrawer->opendrawer($_SESSION['date'],$_SESSION['branchofid'],$_SESSION['expodine_id'],$_SESSION['hostname'],"web");
			echo $result;
                   }
                    
		}
                
                
                
                
           if(($_REQUEST['set']=="drawer_cs_open_settlepopup"))
		{
                   
                   if( $_SESSION['s_cash_drawer_settle_btn_cs']=='Y'){
			$result=$opendrawer->opendrawer($_SESSION['date'],$_SESSION['branchofid'],$_SESSION['expodine_id'],$_SESSION['hostname'],"web");
			echo $result;
                   }
                    
		} 
                
                 if(($_REQUEST['set']=="drawer_cs_open_after_settlement"))
		{
                   
                   if( $_SESSION['s_cash_drawer_settle_btn_cs']=='N'){
			$result=$opendrawer->opendrawer($_SESSION['date'],$_SESSION['branchofid'],$_SESSION['expodine_id'],$_SESSION['hostname'],"web");
			echo $result;
                   }
                    
		} 
                
                
                
}
