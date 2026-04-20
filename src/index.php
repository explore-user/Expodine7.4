<!DOCTYPE html>
<link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" type="text/css" href="css/new-index.css" />
<?php
header('Content-Type: text/html; charset=utf-8');
include('includes/session.php');

include("database.class.php"); // DB Connection class
$database	= new Database(); 
include('includes/master_settings.php');
require_once("includes/title_settings.php");
require_once("includes/menu_settings.php");


 if(isset($_REQUEST['set_pole_paid'])&&($_REQUEST['set_pole_paid']=="pole_display_paid")){
     
    if($_SESSION['s_customer_display']=="Y"){
         
        $sql_desg_nos13632="select be_comport,be_pole_message from tbl_branchmaster";
        $sql_desg13632  =  $database->mysqlQuery($sql_desg_nos13632);
	$num_desg13632  = $database->mysqlNumRows($sql_desg13632);
	if($num_desg13632){
	while($result_desg136321  = $database->mysqlFetchArray($sql_desg13632)) 
	{
            $port=$result_desg136321['be_comport'];
            $msg_pole=$result_desg136321['be_pole_message'];
            
        }
        }
        

    if($_REQUEST['mode']=="cash"){
        
    $pole_paid="   CASH:".$_REQUEST['paid'];
    $pole_bal="BALANCE:".$_REQUEST['balance'];
    exec("MODE $port 9600, N, 8,1");
    exec("cls>$port");
    exec("echo $pole_paid>$port");
    exec("echo $pole_bal>$port");
    
    }else if($_REQUEST['mode']=="card"){
             
    $pole_paid="   CARD:".$_REQUEST['paid'];
    $pole_bal="BALANCE:".$_REQUEST['balance'];
    exec("MODE $port 9600, N, 8,1");
    exec("cls>$port");
    exec("echo $pole_paid>$port");
    exec("echo $pole_bal>$port");
    
    }else if($_REQUEST['mode']=="credit"){
             
    $pole_paid="  CASH:".$_REQUEST['paid'];
    $pole_bal="CREDIT:".$_REQUEST['balance'];
     exec("MODE $port 9600, N, 8,1");
    exec("cls>$port");
    exec("echo $pole_paid>$port");
    exec("echo $pole_bal>$port");
         }
    else if($_REQUEST['mode']=="complimentary"){
             
    $pole_paid="   COMPLIMENTARY   ";
    exec("MODE $port 9600, N, 8,1");
    exec("cls>$port");
    exec("echo $pole_paid>$port");
   
    }else if($_REQUEST['mode']=="upi"){
             
    $pole_paid="UPI :".$_REQUEST['paid'];
    exec("MODE $port 9600, N, 8,1");
    exec("cls>$port");
    exec("echo $pole_paid>$port");
  
    }else if($_REQUEST['mode']=="coupon"){
             
    $pole_paid=" COUPON:".$_REQUEST['paid'];
    $pole_bal="BALANCE:".$_REQUEST['balance'];
     exec("MODE $port 9600, N, 8,1");
    exec("cls>$port");
    exec("echo $pole_paid>$port");
    exec("echo $pole_bal>$port");
    
    }else if($_REQUEST['mode']=="cheque"){
             
    $pole_paid=" CHEQUE:".$_REQUEST['paid'];
    $pole_bal="BALANCE:".$_REQUEST['balance'];
    exec("MODE $port 9600, N, 8,1");
    exec("cls>$port");
    exec("echo $pole_paid>$port");
    exec("echo $pole_bal>$port");
    
    }}else{
        
     $msg2="TURNED OFF.";
     exec("MODE $port 9600, N, 8,1");
     exec("cls>$port");
     exec("echo $msg2>$port");
   
     }
     
     }


 if(isset($_REQUEST['set_pole'])&&($_REQUEST['set_pole']=="pole_display_all")){
     
     if($_SESSION['s_customer_display']=="Y"){
         
        $sql_desg_nos13632="select be_comport,be_pole_message from tbl_branchmaster";
        $sql_desg13632  =  $database->mysqlQuery($sql_desg_nos13632);
	$num_desg13632  = $database->mysqlNumRows($sql_desg13632);
	if($num_desg13632){
	while($result_desg1363212  = $database->mysqlFetchArray($sql_desg13632)) 
	{
            $port=$result_desg1363212['be_comport'];
            $msg_pole=$result_desg1363212['be_pole_message'];  
        }
        }
         
    if($_REQUEST['display']=="show"){
        
    $pole_billno="Bill-".$_REQUEST['pole_bill'];
    $pole_amount="Amount-".$_REQUEST['pole_amount'];
  
    exec("MODE $port 9600, N, 8,1");
    exec("cls>$port");
    exec("echo $pole_billno>$port");
    exec("echo $pole_amount>$port");
    
            $fp = fopen($port, "wb");
           
            fwrite($fp, chr(0x1B) . chr(0x40));
            fwrite($fp, chr(0x0C));
            fwrite(
                $fp,
                chr(0x1B) . chr(0x51) . chr(0x41) . $_REQUEST['pole_amount'] . chr(0x0D)
            );
            fclose($fp);
    
    
    
 }else if($_REQUEST['display']=="none"){
         
    
    exec("MODE $port 9600, N, 8,1");
    exec("cls>$port ");
    exec("echo $msg_pole>$port ");
    
    
    $fp = fopen($port, "wb");
           
            fwrite($fp, chr(0x1B) . chr(0x40));
            fwrite($fp, chr(0x0C));
            fwrite(
                $fp,
                chr(0x1B) . chr(0x51) . chr(0x41) . '0.000' . chr(0x0D)
            );
            fclose($fp);
    
    
          
 }else if($_REQUEST['display']=="thankyou"){
     
    $msg1="Thank You                   Visit Again ";
    exec("MODE $port 9600, N, 8,1");
    exec("cls>$port");
    exec("echo $msg1>$port");
    
    
    $fp = fopen($port, "wb");
           
            fwrite($fp, chr(0x1B) . chr(0x40));
            fwrite($fp, chr(0x0C));
            fwrite(
                $fp,
                chr(0x1B) . chr(0x51) . chr(0x41) . '0.000' . chr(0x0D)
            );
            fclose($fp);
    
          
   }
     }else{
         
      $msg2="TURNED OFF.";
      exec("MODE $port 9600, N, 8,1");
      exec("cls>$port");
      exec("echo $msg2>$port");
      
      $fp = fopen($port, "wb");
           
            fwrite($fp, chr(0x1B) . chr(0x40));
            fwrite($fp, chr(0x0C));
            fwrite(
                $fp,
                chr(0x1B) . chr(0x51) . chr(0x41) . '0.000' . chr(0x0D)
            );
            fclose($fp);
      
      
          
     }   
}






if(!isset($_SESSION['expodine_id']))
 { 
          
    header('location:logout.php');
 }


$_SESSION['host']=HOST_NAME;
$_SESSION['user']=USER_NAME;
$_SESSION['pas']=PASSWORD;
$_SESSION['db']=DATABASE_NAME;
$_SESSION['reprint_db']='normal';



    $sql_login  =  $database->mysqlQuery("Select pv_current_version From tbl_version"); 
    $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login)
    {
      while($result_login  = $database->mysqlFetchArray($sql_login)) 
              {
                    $_SESSION['version']=$result_login['pv_current_version'];
             }
    }


        $sql_loginst  =  $database->mysqlQuery("select ts.ser_shift_permission,ts.ser_dayclose_permission,tl.ls_staffid from"
        . " tbl_logindetails tl left join tbl_staffmaster ts  on ts.ser_staffid=tl.ls_staffid where  ts.ser_employeestatus='Active'"
        . " and tl.ls_username='".$_SESSION['expodine_id']."'"); 
            
             $num_loginst   = $database->mysqlNumRows($sql_loginst);
                if($num_loginst){
                    while($result_loginst  = $database->mysqlFetchArray($sql_loginst)) 
                      {
                        $shiftview=$result_loginst['ser_shift_permission'];
                        $dayopenview=$result_loginst['ser_dayclose_permission'];
                        $expoid=$result_loginst['ls_staffid'];
                       
                    }
                    }


     if(isset($_REQUEST['reload']) && ($_REQUEST['reload']=='loadopen'))
     {
       // header("Location:index.php");  
     }
                 
   
    ///staff shift open///// 
     
   if(isset($_REQUEST['setshift']) && ($_REQUEST['setshift']=='shiftopen'))
   {
     $sql_desg_nos3="select sd_id  from tbl_shift_details where sd_close is NULL and sd_open_staff='".$_REQUEST['expoid']."' and sd_day='".$_SESSION['date']."' ";
     $sql_desg3  =  $database->mysqlQuery($sql_desg_nos3); 
     $num_desg3  = $database->mysqlNumRows($sql_desg3);
     if($num_desg3)
     {
         
                    
     }else{
    
        $machineip= getHostByName(getHostName());

        if($_REQUEST['change']!=""){
            $change_open=$_REQUEST['change'];
        }else{
            $change_open=0;
        }
        
        
         if($_REQUEST['openbal']!=""){
         $op_bal=$_REQUEST['openbal'];
         }else{
         $op_bal=0;
         }

         if($_REQUEST['pettybal']!=""){
         $pet_bal=$_REQUEST['pettybal'];

         }else{
         $pet_bal=0;
         }
  
  
$database->mysqlQuery("SET @exp_shiftid = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['expoid']) . "'");
$database->mysqlQuery("SET @openbal  = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$op_bal) . "'");
$database->mysqlQuery("SET @pettybal  = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$pet_bal) . "'");
$database->mysqlQuery("SET @macid  = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$machineip) . "'");
$database->mysqlQuery("SET @change_open  = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$change_open) . "'");

$sq=$database->mysqlQuery("CALL proc_shift_open(@exp_shiftid,@openbal,@pettybal,@macid,@change_open,@slno)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
$rs = $database->mysqlQuery( 'SELECT @slno as slno' );


    while($row = mysqli_fetch_array($rs))
    {
     $mesg=$row['slno'];
     echo $mesg;
    }

   if($_SESSION['s_single_shift']=='Y'){
       
     $query3=$database->mysqlQuery("UPDATE tbl_shift_details SET sd_open_method='single' where sd_id='".$mesg."' ");
   }else{
       
     $query3=$database->mysqlQuery("UPDATE tbl_shift_details SET sd_open_method='multiple' where sd_id='".$mesg."' ");  
   }
   
   }

}

 ///staff shift Close///// 
if(isset($_REQUEST['setshift1']) && ($_REQUEST['setshift1']=='shiftopen1'))
{

 $machineip1= getHostByName(getHostName());
   
 if($_REQUEST['change1']!=""){
     $change_close=$_REQUEST['change1'];
 }else{
     $change_close=0; 
 }
 
  if($_REQUEST['openbal']!=""){
     $clos_bal=$_REQUEST['openbal'];
  }else{
    $clos_bal=0;
  }
 
  if($_REQUEST['pettybal']!=""){
     $pet_bal_clos=$_REQUEST['pettybal'];
      
  }else{
     $pet_bal_clos=0;
  }
     
    $database->mysqlQuery("SET @exp_shiftid1 = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['expoid']) . "'");
    $database->mysqlQuery("SET @closebal1  = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$clos_bal) . "'");
    $database->mysqlQuery("SET @pettybal1  = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$pet_bal_clos) . "'");
    $database->mysqlQuery("SET @machid  = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$machineip1) . "'");
    $database->mysqlQuery("SET @change_close  = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$change_close) . "'");

    $sq=$database->mysqlQuery("CALL proc_shift_close(@exp_shiftid1,@closebal1,@pettybal1,@machid,@change_close,@slno)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
    $rs = $database->mysqlQuery( 'SELECT @slno as slno' );

    while($row = mysqli_fetch_array($rs))
    {
    $mesg=$row['slno'];
    echo $mesg;
    } 
    

}       

                 /////dayopen details/////

                $sql_desg_nos35="select ls_staffid from tbl_logindetails where ls_username='".$_SESSION['expodine_id']."'";
		$sql_desg35  =  $database->mysqlQuery($sql_desg_nos35); 
		$num_desg35  = $database->mysqlNumRows($sql_desg35);
		if($num_desg35)
		{  while($result_desg35  = $database->mysqlFetchArray($sql_desg35)) 
				{
                $loginid=$result_desg35['ls_staffid'];
                }
                    
                }

                $sql_desg_nos3="select max(sd_id) as id from tbl_shift_details where sd_open_staff='".$loginid."' and sd_day='".$_SESSION['date']."'";
                $sql_desg3  =  $database->mysqlQuery($sql_desg_nos3); 
		$num_desg3  = $database->mysqlNumRows($sql_desg3);
		if($num_desg3)
		{
			while($result_desg3  = $database->mysqlFetchArray($sql_desg3)) 
			{
                            
			$dt=date("Y-m-d");
			$sql_desg_nos13="select sd_open,sd_close from tbl_shift_details where sd_id='".$result_desg3['id']."'  and sd_close IS NULL";
                        $sql_desg13  =  $database->mysqlQuery($sql_desg_nos13);
			$num_desg13  = $database->mysqlNumRows($sql_desg13);
			if($num_desg13){
			while($result_desg13  = $database->mysqlFetchArray($sql_desg13)) 
			{
			  $_SESSION['shiftday']=$result_desg13['sd_open'];
                          $_SESSION['shiftclosetime']=$result_desg13['sd_close'];
			}
			}else
			{
			  unset($_SESSION['shiftday']);
			  unset($_SESSION['shiftclosetime']);
                        
			}
			}
                }
                

////shift open details///
  if(isset($_REQUEST['setshiftdetail']) && ($_REQUEST['setshiftdetail']=='shiftopendetail'))
{
             $slno=$_REQUEST['slno'];
             $denovalue=  explode(",",$_REQUEST['denovalue']);
             $denoid= explode(",",$_REQUEST['denoid']);
             $denocount=explode(",",$_REQUEST['denocount']);
             $dayclose_deno=$_SESSION['date'];
             $shift_cardid=explode(",",$_REQUEST['cardid']);
             $shift_card_amount=explode(",",$_REQUEST['cardamount']);
             
              
        for($gg=0;$gg<count($shift_cardid);$gg++){
            
        if($shift_card_amount[$gg]!=''){
            
        $insertion['sb_shiftdate']=mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
        $insertion['sb_shiftid']=mysqli_real_escape_string($database->DatabaseLink,trim($slno));
        $insertion['sb_bankid']= mysqli_real_escape_string($database->DatabaseLink,trim($shift_cardid[$gg]));
	$insertion['sb_card_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($shift_card_amount[$gg]));
        
	
        $sql=$database->check_duplicate_entry('tbl_shift_card_detail_open',$insertion);
        if($sql!=1)
	{
	$insertid    =  $database->insert('tbl_shift_card_detail_open',$insertion);    
        
        }
        }
                  
        }  
             
        for($g=0;$g<count($denoid);$g++){
            
        if($denoid[$g]!=""){
            
        $insertion1['dod_day']=mysqli_real_escape_string($database->DatabaseLink,trim($dayclose_deno));
        $insertion1['dod_shidt_slno']=mysqli_real_escape_string($database->DatabaseLink,trim($slno));
        $insertion1['dod_deno_id']= mysqli_real_escape_string($database->DatabaseLink,trim($denoid[$g]));
	$insertion1['dod_count']= mysqli_real_escape_string($database->DatabaseLink,trim($denocount[$g]));
        $insertion1['dod_value']= mysqli_real_escape_string($database->DatabaseLink,trim($denovalue[$g]));
	
        $sql=$database->check_duplicate_entry('tbl_shift_open_denomination',$insertion1);
        if($sql!=1)
	{
	$insertid      =  $database->insert('tbl_shift_open_denomination',$insertion1);    
        }
        
        }   
            
        }
               
    }

    
////shift close details///
if(isset($_REQUEST['setshiftdetail1']) && ($_REQUEST['setshiftdetail1']=='shiftopendetail1'))
{
   
             $slno=$_REQUEST['slno'];
             $denovalue=  explode(",",$_REQUEST['denovalue']);
             $denoid= explode(",",$_REQUEST['denoid']);
             $denocount=explode(",",$_REQUEST['denocount']);
             
             
            $sql_desg_nos1="select sd_day from tbl_shift_details where sd_id='".$slno."'  ";
            $sql_desg1  =  $database->mysqlQuery($sql_desg_nos1);
            $num_desg1  = $database->mysqlNumRows($sql_desg1);
            if($num_desg1){
            while($result_desg1  = $database->mysqlFetchArray($sql_desg1)) 
            {
            $dayclose_deno		=$result_desg1['sd_day'];


            }}       
            
          
        for($g=0;$g<count($denoid);$g++){
            
        if($denoid[$g]!="" && $slno!="" && $slno!="0"){
            
        $insertion['dod_day']=mysqli_real_escape_string($database->DatabaseLink,trim($dayclose_deno));
        $insertion['dod_shidt_slno']=mysqli_real_escape_string($database->DatabaseLink,trim($slno));
        $insertion['dod_deno_id']= mysqli_real_escape_string($database->DatabaseLink,trim($denoid[$g]));
	$insertion['dod_count']= mysqli_real_escape_string($database->DatabaseLink,trim($denocount[$g]));
        $insertion['dod_value']= mysqli_real_escape_string($database->DatabaseLink,trim($denovalue[$g]));
	
         $sql=$database->check_duplicate_entry('tbl_shift_close_denomination',$insertion);
         if($sql!=1)
 	{
	$insertid              			=  $database->insert('tbl_shift_close_denomination',$insertion);    
        }
        
        }
        
        }
            
          
        $shift_cardid=explode(",",$_REQUEST['cardid']);
        $shift_card_amount=explode(",",$_REQUEST['cardamount']);
             
              
        for($gg=0;$gg<count($shift_cardid);$gg++){
            
        if($shift_card_amount[$gg]!=''){
        $insertion1['sb_shiftdate_close']=mysqli_real_escape_string($database->DatabaseLink,trim($dayclose_deno));
        $insertion1['sb_shiftid_close']=mysqli_real_escape_string($database->DatabaseLink,trim($slno));
        $insertion1['sb_bankid_close']= mysqli_real_escape_string($database->DatabaseLink,trim($shift_cardid[$gg]));
	$insertion1['sb_card_amount_close']= mysqli_real_escape_string($database->DatabaseLink,trim($shift_card_amount[$gg]));
        
	
        $sql=$database->check_duplicate_entry('tbl_shift_card_detail_close',$insertion1);
        if($sql!=1)
	{
	$insertid    =  $database->insert('tbl_shift_card_detail_close',$insertion1);    
        
        }
        
        }
                  
        }  
           
          
    }              
       
    
 ///day open details //////    
$_SESSION['s_email_on_dayclolse']='Y';
$sql_desg_nos="select max(dc_id) as id from tbl_dayclose";
$sql_desg  =  $database->mysqlQuery($sql_desg_nos); 
$num_desg  = $database->mysqlNumRows($sql_desg);
if($num_desg)
{
while($result_desg  = $database->mysqlFetchArray($sql_desg)) 
{
    
$dt=date("Y-m-d");
$sql_desg_nos1="select dc_day,dc_dateopen,dc_timeopen,dc_dateclose,dc_timeclose from tbl_dayclose where dc_id='".$result_desg['id']."'  and dc_timeclose IS NULL";//and dc_day ='$dt'
$sql_desg1  =  $database->mysqlQuery($sql_desg_nos1);
$num_desg1  = $database->mysqlNumRows($sql_desg1);
if($num_desg1){
while($result_desg1  = $database->mysqlFetchArray($sql_desg1)) 
{
$_SESSION['date']	=$result_desg1['dc_day'];
$_SESSION['dateopen']	=$result_desg1['dc_dateopen'];
$_SESSION['timeopen']	=$result_desg1['dc_timeopen'];
$_SESSION['dateclose']	=$result_desg1['dc_dateclose'];
$_SESSION['timeclose']	=$result_desg1['dc_timeclose'];
}

}else
{
unset($_SESSION['date']);
unset($_SESSION['dateopen']);
unset($_SESSION['timeopen']);
unset($_SESSION['dateclose']);
unset($_SESSION['timeclose']);
}
}
} 
    

        $date_daycclose='';
        $sq_db_archive1=$database->mysqlQuery("SELECT dc_day from tbl_dayclose where dc_dayclose_email_success='N' and dc_dateclose!='' "
        . " and dc_day between CURDATE( ) - INTERVAL 3 DAY AND CURDATE( ) order by dc_day desc limit 1  ");
        $nm_db_archive1= $database->mysqlNumRows($sq_db_archive1);
        if($nm_db_archive1){
            while($result_db_archive1  = $database->mysqlFetchArray($sq_db_archive1)){
                
                   $date_daycclose=$result_db_archive1['dc_day'];
            }
            }    
            

    $sql_desg_nos1="select rm_reportid from tbl_reportmaster where rm_daycloseprint='Y' and rm_dayclose_print_order>0"
    . " ORDER BY rm_dayclose_print_order ASC ";
    $sql_desg1  =  $database->mysqlQuery($sql_desg_nos1);
    $num_desg1  = $database->mysqlNumRows($sql_desg1);
    $i=1;$r="";$mail_rp="";
    if($num_desg1){
    while($result_desg1  = $database->mysqlFetchArray($sql_desg1)) 
    {
        
    $rpts=array();
    $rpts=$result_desg1['rm_reportid'];
    if($i==1)
    {
      $r=$rpts;
    }
    else
    {
      $r=$r.",".$result_desg1['rm_reportid'];
    }
    $i++;

  ?>
				
 <?php } ?>

 <input type="hidden" name="chkrpt" id="chkrpt" value="<?=$r?>" />
    
<?php }
	
				$sql_desg_nos11="select rm_reportid from tbl_reportmaster  where rm_dayclosemail='Y' and  "
                                . "rm_dayclose_print_order>0 order by rm_dayclose_print_order ASC  ";

				$sql_desg11  =  $database->mysqlQuery($sql_desg_nos11);
				$num_desg11  = $database->mysqlNumRows($sql_desg11);
                                
			        $i=1;$rr="";
                                
				if($num_desg11){
				while($result_desg11  = $database->mysqlFetchArray($sql_desg11)) 
				{
						
				$rpts=array();
				$rpts=$result_desg11['rm_reportid'];
						
			if($i==1)
			{
			       $rr=$rpts;
			}
			else
			{
				$rr=$rr.",".$result_desg11['rm_reportid'];
			}
				$i++;
		        } ?>

                <input type="hidden" name="chkrpts" id="chkrpts" value="<?=$rr?>" />
         
                <?php }
  
	        $sql_desg_nos11="select be_reportemail_list,be_sms_list,be_email_on_dayclose,be_time_zone from tbl_branchmaster";
                $sql_desg11  =  $database->mysqlQuery($sql_desg_nos11);
				$num_desg11  = $database->mysqlNumRows($sql_desg11);
			         $i=1;$mail_lst="";$sms_lst=""; $email_on_dayclose='N';
				if($num_desg11){
				while($result_desg11  = $database->mysqlFetchArray($sql_desg11)) 
					{
						
						$mail_lst=$result_desg11['be_reportemail_list'];
						$sms_lst=$result_desg11['be_sms_list'];
                                                $email_on_dayclose=$result_desg11['be_email_on_dayclose'];
                                                $tz=$result_desg11['be_time_zone'];
					}
                     
                                        
        $pay_date_overdue='';  $overdue_local='N';  $overdue_crm='N';  $lock_crm='N';                          
        $sql_desg_nos13="select payment_overdue_date,overdue_crm,lock_crm from tbl_generalsettings";
        $sql_desg13  =  $database->mysqlQuery($sql_desg_nos13);
	$num_desg13  = $database->mysqlNumRows($sql_desg13);
	if($num_desg13){
	while($result_desg13 = $database->mysqlFetchArray($sql_desg13)) 
	{
            $pay_date_overdue=$result_desg13['payment_overdue_date'];
            $overdue_crm=$result_desg13['overdue_crm'];
            $lock_crm=$result_desg13['lock_crm'];
            
        }
        }     
       
        
                $pay_overdue='N';
                $sql_table_pt23="SELECT payment_overdue FROM tbl_version ";
		$sql_pt23  =  $database->mysqlQuery($sql_table_pt23); 
		$num_pt23  = $database->mysqlNumRows($sql_pt23);
		if($num_pt23){
			while($result_pt23  = $database->mysqlFetchArray($sql_pt23)) 
				{
					
				   $pay_overdue	 =$result_pt23['payment_overdue'];
				}
		}
        
                                    $today = date("Y-m-d");
        
                                   if($pay_date_overdue!=''){ 
                                       
                                    if (strtotime($today) < strtotime($pay_date_overdue)) {
                                        
                                       $overdue_local='N';  
                                      
                                    }else{
                                        
                                        $overdue_local='Y'; 
                                        
                                    }
                                   }
                                    
                                    
        
   if($pay_overdue=='Y' || $overdue_local=='Y' || $overdue_crm=='Y' || $lock_crm=='Y'){
       
       include 'overdue.php';
        
   }
   
   ?>
                

 <input type="hidden" name="chkmail" id="chkmail" value="<?=$mail_lst?>" />
 
 <input type="hidden" name="chksms" id="chksms" value="<?=$sms_lst?>" />

 <input type="hidden"  id="archieve_onoff" value="<?=$_SESSION['archive_enabled']?>" >

 <input type="hidden" id="cloud_sync_onoff" value="<?=$_SESSION['cloud_enable_sync']?>" >
 
 <input type="hidden" id="accounts_section" value="<?=$_SESSION['accounts_section']?>" >

 
 
 
<?php }

   unset($_SESSION['floorid_ser']);
                
   $localIP = getHostByName(getHostName());     
     

?>
 
 <input type="hidden" value="<?=$email_on_dayclose?>" id="email_on_dayclose" >
 
  <input type="hidden" value="<?=$date_daycclose?>" id="date_daycclose" >
  
 <input type="hidden" name="hiddayclose_authorise" id="hiddayclose_authorise" value="<?=$_SESSION['dayclose_authorise']?>"  >
    
 <input type="hidden" value="<?=$localIP?>" id="local_ip" >
    
 <input type="hidden" value="<?=$_SESSION['s_daily_stock_concept']?>" id="stock_onoff" >
    
 <input type="hidden" value="<?=$_SESSION['date']?>" id="date_today_acc" >
    
 <input type="hidden" value="<?=$_SESSION['s_single_shift']?>" id="single_shift" >
     
 <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >
 
 
 <input type="hidden" value="<?=$_SESSION['be_kot_miss_check']?>" id="kot_miss_check" >

<input type="hidden" value="<?=$_SESSION['be_kot_miss_check_ta']?>" id="kot_miss_check_ta" >


<input type="hidden" value="<?=$_SESSION['be_kot_cons_miss_di']?>" id="be_kot_cons_miss_di" >

<input type="hidden" value="<?=$_SESSION['be_kot_cons_miss_ta']?>" id="be_kot_cons_miss_ta" >
 
 
<html lang="en">
    
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets1/css/custom-new.css">
</head>

<body>
    
    <!-- Header -->
    <header class="header">
        <div class="logo-section">
            <a href="#">
            <img src="assets1/images/dashbaord-logo.png" alt="">
            </a>
        </div>
        
        <div class="dashboard-title"><?=$_SESSION['home_dashboard']?></div>
        
        <div class="header-actions">
            <div class="notification-icon">
                
                <?php 
                
                if(in_array("advance", $_SESSION['menumodarray'])){
                            
                            $_SESSION['adv_count']=0;
                            $cr=date('Y-m-d');
                            $i=1; 
                            $sql_login  =  $database->mysqlQuery("select tp_delivery_date from tbl_advance_payment where tp_status='Approved' 
                            and tp_delivery_date = '$cr'  "); 

                            $num_login   = $database->mysqlNumRows($sql_login);
                            if($num_login){
                                   while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                         { 
                            
                                $_SESSION['adv_count']= $i++;
                            
                            }}
                            
                }
                
                
                
        
                $amc_on_off='Y'; $amc_to='0'; $amc_ct=0; $amc_pay=0;   $install_on=$_SESSION['version_date']; 
                $amc_id=0;  $_SESSION['amc_pay_onoff']='Y'; $amc_to1='Nil';
                
                $sql_table_pt2="SELECT * FROM tbl_amc_setup order by tmc_id desc limit 1 ";
		$sql_pt2  =  $database->mysqlQuery($sql_table_pt2); 
		$num_pt2  = $database->mysqlNumRows($sql_pt2);
		if($num_pt2){
			while($result_pt2  = $database->mysqlFetchArray($sql_pt2)) 
				{
                                      $amc_to = $result_pt2['tm_to'];
                                      
                                      $amc_to1 = $result_pt2['tm_to'];
                                      
                                      $amc_id= $result_pt2['tm_ref_id_client'];
                                      
                                      $install_on = $result_pt2['tm_install_on'];
                                      
                                      $amc_pay = $result_pt2['tm_amc_amount']+$result_pt2['tm_cloud_amount']+$result_pt2['tmc_tax'];
                                      
                                       
                                      $today = date("Y-m-d");

                                      if (strtotime($today) < strtotime($amc_to)) {
                                        
                                       $amc_on_off='Y';  
                                       $amc_ct='0';
                                       
                                      }else{
                                        $amc_on_off='N'; 
                                         $amc_ct='1';
                                     }
                                     
				}
		      }else{
                                       $amc_on_off='Y';  
                                       $amc_ct='0';
                      }
                
                $_SESSION['amc_pay_onoff']=$amc_on_off;
                
                if($amc_pay=='0' || $amc_pay==''){
                    
                    $amc_pay='NA';
                }
                
                ?>
        
                <img style="display: none " onclick="common_go()" src="img/settle-icon.png" alt="Notifications" class="icon-img" id=""> 
              
                <img src="assets1/images/notification-ico.svg" alt="Notifications" class="icon-img" id="notificationDropdown">
                
                <input type="hidden" id="notify_aud" value="<?=($_SESSION['uraban_order_count_d']+$_SESSION['inv_central_req_reject_d']+$_SESSION['qr_order_count_d']+$_SESSION['inv_central_transfer_d'])?>" >
                
                <div class="notification-badge"><?php echo  $_SESSION['adv_count']+$amc_ct+$_SESSION['uraban_order_count_d']+$_SESSION['inv_central_req_reject_d']+$_SESSION['qr_order_count_d']+$_SESSION['inv_central_transfer_d']; ?></div>
                
                <div class="notification-dropdown" id="notificationDropdownMenu">
                    
                    <div class="notification-header">
                        <h6>Notifications</h6>
                        <span class="notification-count"><?php echo  $_SESSION['adv_count']+$amc_ct+$_SESSION['inv_central_req_reject_d']+$_SESSION['uraban_order_count_d']+$_SESSION['qr_order_count_d']+$_SESSION['inv_central_transfer_d']; ?></span>
                    </div>
                    
                    <div class="notification-list">
                        
                    <?php  if($amc_on_off=='N'){ ?>
                        
                            <div class="notification-item">
                                
                            <div class="notification-icon-small">
                            <i class="fas fa-info-circle text-info"></i>
                            </div>
                            
                              <div  class="notification-content">
                                <div class="notification-title">AMC PAYMENT EXPIRED</div>
                                <div class="notification-message">Renew AMC For Support (1) </div>
                                <div class="notification-message">Contact : +919895313434 | +917994051951</div>
                                <div class="notification-time"></div>
                            </div>
                            
                            </div>
                        
                        
                        <?php } ?> 
                        
                        
                        
                        <?php if(in_array("advance", $_SESSION['menumodarray'])){ ?>     
                        
                        <div onclick="adv_go()" class="notification-item">
                            <div class="notification-icon-small">
                            <i class="fas fa-info-circle text-info"></i>
                            </div>
                               
                            <div class="notification-content">
                                <div class="notification-title">ADV PAYMENT DELIVERY &nbsp; <i class="fa fa-share"></i></div>
                               <div class="notification-message" style="font-weight:bold">Date : <?=date('Y-m-d')?></div>
                               <div class="notification-time" style="font-weight:bold;color:black;font-size: 13px;">Today's Delivery : <?php if(isset($_SESSION['adv_count'])){echo $_SESSION['adv_count'];} ?></div>
                           
                           </div>
                                
                           </div>
                       
                         <?php } ?> 
                        
                        
                           <?php if($_SESSION['qr_db_set']!='' && $_SESSION['online_order_on']=='Y'){ ?> 
                        
                            <div class="notification-item">
                            <div class="notification-icon-small">
                                <i class="fas fa-info-circle text-info"></i>
                            </div>
                        
                        
                            <div onclick="qr_go();" class="notification-content">
                                <div class="notification-title">Qr Orders</div>
                                <div class="notification-message">New Orders Received.</div>
                                <div class="notification-time"><?php if(isset($_SESSION['qr_order_count_d'])){echo $_SESSION['qr_order_count_d'];} ?></div>
                            </div>
                             
                             </div>
                        
                          <?php } ?>
                           
                            
                          
                            
                          <?php if($_SESSION['urban_db_set']!='' && $_SESSION['online_order_on']=='Y'){ ?>   
                            
                         <div class="notification-item">
                            <div class="notification-icon-small">
                                <i class="fas fa-info-circle text-info"></i>
                            </div>  
                        
                            <div onclick="urban_go();" class="notification-content">
                                <div class="notification-title">Online Orders</div>
                                <div class="notification-message">New Orders Received.</div>
                                <div class="notification-time"><?php if(isset($_SESSION['uraban_order_count_d'])){echo $_SESSION['uraban_order_count_d'];} ?></div>
                            </div>
                                </div>    
                         <?php } ?>
                               
                           
                               
                               
                               
                          <?php if($_SESSION['ser_central_accept']=='Y'){  ?>   
                               
                        <div class="notification-item">
                            <div class="notification-icon-small">
                                <i class="fas fa-info-circle text-info"></i>
                            </div>  
                        
                        
                            <div class="notification-content">
                                <div  onclick="central_go_list();" class="notification-title">Central Kitchen</div>
                                <div  onclick="central_go_list();" class="notification-message">New Transfers.</div>
                                <div class="notification-time"><?php if(isset($_SESSION['inv_central_transfer_d'])){ echo $_SESSION['inv_central_transfer_d'];} ?></div>
                            
                                <span id="load_central_transfer" style="font-size:10px"></span>
                            
                            
                            </div>
                            
                           
                            <div class="notification-content">
                                <div  onclick="load_central_req_reject();" class="notification-title">Requisition Rejected</div>
                                <div  onclick="load_central_req_reject();" class="notification-message">New Rejects .</div>
                                <div class="notification-time"><?php if(isset($_SESSION['inv_central_req_reject_d'])){ echo $_SESSION['inv_central_req_reject_d'];} ?></div>
                            
                                <span id="load_central_transfer" style="font-size:10px"></span>
                            
                            
                            </div>
                            
                              </div>      
                         <?php } ?>
                            
                           
                    </div>
                    <div class="notification-footer" style="display: none">
                        <button class="btn-view-all">View All</button>
                        <button class="btn-clear-all">Clear All</button>
                    </div>
                </div>
            </div>
            <div class="user-icon" style="margin-right: -20px;" id="userDropdown">
                <img src="assets1/images/user-ico.svg" alt="User" class="icon-img" >
                
                <span class="hidden-sm hidden-xs user-name-top" style="font-size: 13px;
                color: lightgray;text-transform: uppercase !important;"><?=$_SESSION['expodine_id']?></span> 
                <span class="caret"></span>
                
                <div class="user-dropdown" id="userDropdownMenu">
                    <div class="dropdown-header">
                        <img src="img/loyalty_icon.jpg" alt="User" class="dropdown-user-img">
                        <div class="dropdown-user-info">
                            <div class="user-name" style="text-transform: uppercase"><?=$_SESSION['expodine_id']?></div>
                            <div class="user-role"><?=$_SESSION['dr_designationname']?></div>
                        </div>
                    </div>
                    
                    <div  class="dropdown-divider"></div>
                    <a style=""  href="#" class="dropdown-item" id="lang_btn">
                        <i class="fas fa-user"></i>
                        Language
                    </a>
                     
                     <?php if(in_array("General Branch settings", $_SESSION['menumodarray'])) { ?> 
                    <a href="branch_settings.php?from=direct" class="dropdown-item settings_click">
                        <i class="fas fa-cog"></i>
                        Settings
                    </a>
                    <?php  }  ?>  
                    
                    <?php  if($linkname!="menu_order.php" && $linkname!="order_split.php"){ ?>  
                    
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item logout-item">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                    
                  <?php  }  ?>  
                    
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-grid">
            <!-- Left Card - Action Buttons -->
            <div class="card">
                <div class="action-buttons">
                    
                   <?php if(in_array("dinein", $_SESSION['menuarray'])) { ?>
                    
                    <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> table_selection.php <?php }else {  ?>index.php?msg=dayclosed<?php } ?>" class="action-btn">
                        <img src="assets1/images/dinein-ico.svg" alt="Dine In" class="icon-img">
                      <?=$_SESSION['home_headdinein']?>
                    </a>
                    
                    <?php } ?>  
                    
                    
                    <?php if(in_array("take_away_", $_SESSION['menuarray'])) { ?>
                    
                    <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> take_away_.php <?php }else {  ?>index.php?msg=dayclosed<?php } ?>" class="action-btn">
                        <img src="assets1/images/tahd-ico.svg" alt="TA/HD" class="icon-img">
                       <?=$_SESSION['ta_hd']?>
                    </a>
                    
                    <?php } ?>  
                    
                    <?php if(in_array("counter_sales", $_SESSION['menuarray'])) { ?>
                    
                    <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> counter_sales.php <?php }else {  ?>index.php?msg=dayclosed<?php } ?>" class="action-btn">
                        <img src="assets1/images/qsr-ico.svg" alt="QSR" class="icon-img">
                       <?=$_SESSION['cs_new']?>
                    </a>
                    
                     <?php } ?>  
                    
                </div>
                
                <div class="report-buttons">
                    
                     <?php if(in_array("Total Analytics", $_SESSION['menumodarray'])) { ?>
                    
                    <a href="analytics.php" class="module-btn">
                        <span class="btn-text"><?=$_SESSION['home_analyticreport']?></span>
                        <div class="icon-div">
                            <img src="assets1/images/analytics-ico.svg" alt="Analytics" class="icon-img">
                        </div>
                    </a>
                    
                     <?php } ?>  
                    
                    <?php if(in_array("Reports", $_SESSION['menumodarray']) ) { ?> 
                    
                    <a href="consolidatedreport.php" class="module-btn">
                        <span class="btn-text"> <?=$_SESSION['home_reports']?></span>
                        <div class="icon-div">
                            <img src="assets1/images/reports-ico.svg" alt="Reports" class="icon-img">
                        </div>
                    </a>
                    
                   <?php } ?>  
                    
                    </a>
                </div>
            </div>

            <!-- Right Card - Sale/Shift Section -->
            <div class="card">
                <div class="customer_details_sale_open_box">
                <div class="customer_details">
                    <div class="section-header">OUTLET DETAILS</div>
                    <div class="customer_details_cnt">
                        <div class="customer_details_cnt_row">
                            <span>Outlet Name </span>
                            <strong> <?=$_SESSION['s_branchname']?></strong>
                        </div>
                         <div class="customer_details_cnt_row">
                            <span>Address </span>
                            <strong> <?=$_SESSION['s_address']?></strong>
                        </div>
                         <div class="customer_details_cnt_row">
                            <span>Installed On :  <strong><?=$install_on?></strong></span>
                            
                            <span> Amc Expiry <strong style="margin-left:6px"> : <?=$amc_to1?>  </strong></span>
                        </div>
                        
                        
                        <?php if($amc_on_off=='N') {   $exp='Expired';   }else{   $exp='Active'; } ?>
                        
                        <div class="customer_details_cnt_row" style="border:0;">
                            <span style="display: flex;gap:5px;align-items: center;">AMC : <strong style="width:55px"> <?=$exp?>  </strong>
                                
                            <?php if($exp=='Expired'){ ?>
                                
                            <span title="AMC EXPIRED.KINDLY RENEW AMC FOR SUPPORT.CONTACT +91 9895313434 | +91 7994051951" class="check_box_round" style="cursor: pointer;background-color: red ">
                            <i style="color:#fff" class="fa fa-close"></i>
                                  
                            </span>
                         
                          <p class="dashed-blink zoom-btn" title="AMC EXPIRED.CONTACT +91 9895313434 | +91 7994051951 ( ID:<?=$amc_id?> | AMT : <?=$amc_pay?> )" onclick1="$('#qrModal').show();"
                             onclick="rz_crm('<?=$amc_id?>','<?=$amc_pay?>','<?=$_SESSION['firebase_id']?>')" style=" display: inline-block;  padding: 3px 6px;text-align: center;  font-size: 11px;margin-top: 7px;
                          font-weight: 600;  color: #ffffff;  background: #3e72b3;border-radius: 5px;width: auto;cursor: pointer">
                              Pay Now <i style="font-size:13px" class="fa fa-qrcode" aria-hidden="true"></i>  </p>
                                
                            <style>
                            .dashed-blink{
                                padding: 12px 18px;
                                border: 3px solid #ffb400;
                                display: inline-block;
                                animation: dashedBlink 1s steps(2, start) infinite;
                              }

                              @keyframes dashedBlink {
                                20%  { border-color: lightgrey; opacity: 5; }
                                50%  { border-color: transparent;  }
                                100% { border-color: white; opacity: 5; }
                              }
                              
                                .zoom-btn {
                                  display: inline-block;
                                  padding: 12px 25px;
                                  background: #3498db;
                                  color: white;
                                  border-radius: 6px;
                                  cursor: pointer;

                                  transition: transform 0.3s ease; /* smooth animation */
                                }

                                .zoom-btn:hover {
                                  transform: scale(1.2); /* zoom 10% */
                                }
                            </style>
                            
                            
                            <?php }else{ ?>
                                
                            <span class="check_box_round"><i style="color:#fff" class="fa fa-check"></i></span>
                                 
                            <?php } ?>
                                

                            </span>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="sale-shift-section">
                    <div class="sale-section">
                        <div class="section-header"><?=$_SESSION['sale_open_new']?>
                        
                        
                        <?php 
            
                 $localhost_chk=mysqli_connect('localhost', USER_NAME, PASSWORD,DATABASE_NAME);
                 $sql_gen_db =  mysqli_query($localhost_chk,"select be_saudi_format from tbl_branchmaster"); 
       
		  $num_gen_db  = mysqli_num_rows($sql_gen_db);
		  if($num_gen_db)
		  { 
                       
                    ?>

                 <span <?php if($_SESSION['expodine_id']=='admin' || $_SESSION['expodine_id']=='Manager'){ ?> onclick="set_app_ip_cloud()" <?php }else{ ?> title="ONLY ADMIN AND MANAGER LOGIN CAN CHANGE SERVER IP "  <?php } ?>    
                 style="font-size: 11px;right: -24px;position: relative;border: solid 1px;padding-bottom: 2px;border-radius: 3px;padding: 3px;cursor: pointer">
                     <i style="width:15px" class="fa fa-strikethrough" title="SERVER IP SETUP FOR APP"></i>
                 </span>

                <?php }  ?>
                        
                        </div>
                        <div class="section-content">
                            <div class="datetime-label">SALE DATE</div>
                           <div class="d-flex gap-2">
                               <input type="text" class="datetime-input" value="<?php if(isset($_SESSION['dateopen']) && !isset($_SESSION['timeclose'])) echo $_SESSION['dateopen']; ?> <?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])) echo date('h:i:s a', strtotime($_SESSION['timeopen']));?>" readonly>
                               
               <?php if(!isset($_SESSION['timeopen']) && (in_array("Day In View", $_SESSION['menumodarray']))) { ?>
               <button class="status-btn open-btn updatetimeopen"><?=$_SESSION['home_open_t']?></button>
               <?php } ?>
                                
               <?php if(!isset($_SESSION['timeclose']) && isset($_SESSION['timeopen']) && (in_array("Day Close View", $_SESSION['menumodarray']))){ ?>
               <button class="status-btn close-btn updatetimeclose"><?=$_SESSION['home_close_t']?></button>
               <?php } ?>
                                
                                
                                
                                
                           </div>
                        </div>
                    </div>
                    
                    <?php  if($shiftview=="Y" && $_SESSION['s_single_shift']=='N'){  ?>
                    
                    <div class="shift-section">
                        <div class="section-header"> <i class="fa fa-user"></i> &nbsp;<?=$_SESSION['shift_lm']?> </div>
                        <div class="section-content">
                            <div class="datetime-label">SHIFT DATE</div>
                            <div class="d-flex gap-2">
                                <input type="text" class="datetime-input" id="shtime" readonly value="<?=$_SESSION['shiftday']?>" readonly>
                                
                                 <?php if(!isset($_SESSION['shiftday'])){ ?>
                                <button class="status-btn open-btn" onclick="return shiftopen();" ><?=$_SESSION['home_open_t']?></button>
                                 <?php } ?>
                                
                                  <?php if(!isset($_SESSION['shiftclosetime']) && isset($_SESSION['shiftday'])){ ?>
                                 <button class="status-btn close-btn" onclick="return shiftclose();" ><?=$_SESSION['home_close_t']?></button>
                                 <?php } ?>
                                
                            </div>
                        </div>
                    </div>
                    
                   <?php }else{ ?>
                    
                    <div class="shift-section" style="pointer-events: none; cursor:none;filter: blur(1px); -webkit-filter: blur(1px);">
                        <div class="section-header"><?=$_SESSION['shift_lm']?> </div>
                        <div class="section-content">
                            <div class="datetime-label">NO SHIFT</div>
                            <div class="d-flex gap-2">
                                <input type="text" class="datetime-input" id="" readonly value="" readonly>
                                
                                 
                                
                                
                            </div>
                        </div>
                    </div>
                    
                    <?php } ?>
  
                </div>
                    
             </div>
                
                
                
            </div>
        </div>

        <!-- Modules Card -->
        <div class="card">
            <h3 class="card-title"><?=$_SESSION['module_new_lm']?></h3>
            <div class="modules-grid">
                
                 <?php  if($_SESSION['accounts_section']=='Y') { ?>  
                
                <?php  if(in_array("Ledger", $_SESSION['menumodarray']) ) { ?>  
                
                <a href="accounts/ledger.php" class="module-btn">
                    <span class="btn-text"><?=$_SESSION['ledger']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/modules-ico.svg" alt="Accounts" class="icon-img">
                    </div>
                </a>
                
                <?php }  } ?> 
                
                
               <?php if($_SESSION['s_inventory_staff_add']=='Y'){ ?>
                
              <input type="hidden" value="Y" id="inv_on">
                
               <?php 
                
               if(in_array("inventory", $_SESSION['menuarray'])) {  ?>
                
                <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>  inventory/index.php <?php }else {  ?> index.php?msg=1; <?php } ?>" class="module-btn">
                    <span class="btn-text"><?=$_SESSION['home_inventory'] ?> </span>
                    <div class="icon-div">
                        <img src="assets1/images/inventory-ico.svg" alt="Inventory" class="icon-img">
                    </div>
                </a>
                
                <?php } }else{ ?> 
                
                 <input type="hidden" value="N" id="inv_on">
                
                <?php } ?>
                 
                 
                 
                 <?php if(in_array("registration", $_SESSION['menuarray'])) { ?> 
                 
                <a href="loyalty/index.php" class="module-btn">
                    <span class="btn-text"><?=$_SESSION['home_loyalitypgm']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/crm-ico.svg" alt="CRM" class="icon-img">
                    </div>
                </a>
                 
                  <?php } ?>
                 
                  <?php if(in_array("Credit Settlement", $_SESSION['menumodarray'])){ ?>  
                 
                <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>credit.php  <?php }else {  ?> index.php <?php } ?>" class="module-btn">
                    <span class="btn-text"><?=$_SESSION['home_creditsettlement']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/credit-ico.svg" alt="Credit" class="icon-img">
                    </div>
                </a>
                 
                  <?php } ?>
                 
                 <?php  if(in_array("CONSOLIDATED KOT HISTORY", $_SESSION['menumodarray']) ) { ?>   
                 
                <a href="cons_kot_history.php" class="module-btn">
                    <span class="btn-text"><?=$_SESSION['cons_kot_ar_eng']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/kothistory-ico.svg" alt="KOT History" class="icon-img">
                    </div>
                </a>
                 
                <?php } ?>
                 
                 <?php if(in_array("total_ta_bill_history", $_SESSION['menusubarray'])) { ?>
                 
                <a href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> total_ta_bill_history.php <?php }else {  ?> index.php <?php } ?>" class="module-btn">
                    <span class="btn-text"><?=$_SESSION['payment_pending_billhistorybutton']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/billhistory.svg" alt="Bill History" class="icon-img">
                    </div>
                </a>
                 
                   <?php } ?>
                 
                  
                
                <a href="customer_display/Customer_display.php?mode=expodine" class="settings-btn">
                    <span class="btn-text"><?=$_SESSION['cus_1']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/customer-dsp-ico.svg" alt="Customer Display" class="icon-img">
                    </div>
                </a>
                
               
                
                <a href="troubleshoot.php" class="module-btn">
                    <span class="btn-text"><?=$_SESSION['trouble_lm']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/trobleshoot-ico.svg" alt="Troubleshoot" class="icon-img">
                    </div>
                </a>
            </div>
        </div>

        <!-- General Settings Card -->
        <div class="card">
            
             <?php if(in_array("General Branch settings", $_SESSION['menumodarray'])) { ?> 
            
            <h3 class="card-title"><?=$_SESSION['home_headsettings']?></h3>
            <div class="settings-grid">
                <a href="branch_settings.php?from=direct" class="settings-btn">
                    <span class="btn-text"> <?=$_SESSION['home_gensettings']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/setting-ico.svg" alt="Settings" class="icon-img">
                    </div>
                </a>
                
              <?php } ?> 
                
                <?php if(in_array("Menu Masters", $_SESSION['menumodarray']) && (in_array("menu", $_SESSION['menusubarray']))) { ?> 	
                
                <a href="menu.php" class="settings-btn">
                    <span class="btn-text"> <?=$_SESSION['item_master_new']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/manageitem-ico.svg" alt="Manage Items" class="icon-img">
                    </div>
                </a>
                
                  <?php } ?> 
                
                  <?php if(in_array('printer_master', $_SESSION['menufullarray'])) { ?>
                
                <a href="printer_master.php" class="settings-btn">
                    <span class="btn-text"> <?=$_SESSION['printer_master_new']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/print-ico.svg" alt="Manage Printer" class="icon-img">
                    </div>
                </a>
                
                 <?php } ?> 
                
                 <?php if(in_array("advance", $_SESSION['menumodarray'])){ ?>     
                
                <a href="advance_pay_bill.php" class="module-btn">
                    <span class="btn-text">ADVANCE PAYMENT</span>
                    <div class="icon-div">
                        <img src="assets1/images/reports-ico.svg" alt="Advance" class="icon-img">
                    </div>
                </a>
                
                 <?php } ?> 
                
                
                
                
                
                <?php if(((in_array("kod_screen", $_SESSION['menuarray'])) || (in_array("packingcounter", $_SESSION['menuarray']))) && ($_SESSION['s_kod_takeaway']=='Y' || $_SESSION['s_kod_dinein']=='Y')) { ?>
              
                    
                     <?php if(in_array("kod_screen", $_SESSION['menuarray'])) { ?>  
                
                <a <?php if(isset($_SESSION['date'])){ ?> href="kod_screen_two.php" <?php } ?> class="settings-btn">
                    <span class="btn-text"><?=$_SESSION['home_kodscreen']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/customer-dsp-ico.svg" alt="Customer Display" class="icon-img">
                    </div>
                </a>
                
                   <?php }else if($_SESSION['s_kod_takeaway']=='Y' || $_SESSION['s_kod_dinein']=='Y') { ?> 
                
                
                 <a <?php if(isset($_SESSION['date'])){ ?> href="kod_screen_two.php" <?php } ?> class="settings-btn">
                    <span class="btn-text"><?=$_SESSION['home_kodscreen']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/customer-dsp-ico.svg" alt="Customer Display" class="icon-img">
                    </div>
                </a>
                
                 <?php } ?> 
                
                
                 <?php if(in_array("packingcounter", $_SESSION['menuarray'])) { ?>
                    
                 <?php if($_SESSION['s_kod_takeaway']=='Y' && $_SESSION['s_kod_dinein']=='Y') { ?> 
                
                <a <?php if(isset($_SESSION['date'])){ ?> href="packingcounter_two.php" <?php } ?> class="settings-btn">
                    <span class="btn-text"> <?=$_SESSION['home_packingcounter']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/customer-dsp-ico.svg" alt="Customer Display" class="icon-img">
                    </div>
                </a>
                
                
                <?php }else if($_SESSION['s_kod_takeaway']=='Y' || $_SESSION['s_kod_dinein']=='Y') { ?> 
                
                <a <?php if(isset($_SESSION['date'])){ ?> href="packingcounter.php" <?php } ?> class="settings-btn">
                    <span class="btn-text"> <?=$_SESSION['home_packingcounter']?></span>
                    <div class="icon-div">
                        <img src="assets1/images/customer-dsp-ico.svg" alt="Customer Display" class="icon-img">
                    </div>
                </a>
                
                
                 <?php } ?>   
                 <?php } ?>   
                
                
                
                
               <?php } ?>   
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-left" >
            VERSION : 7.4
            
        </div>
        
    <div class="footer-right">
            
<!--    <a style="text-decoration: none;
    color: white;
    margin-right: 10px;
    border: solid 1px black;
    padding: 5px;
    border-radius: 10px;background-color: #25d366" target="_blank" href="https://wa.me/+917994051951?text= Hi , We are <?=urlencode($_SESSION['s_branchname'])?> , <?=$_SESSION['s_address']?>  (Version <?=$_SESSION['version']?>). Please Contact us on  <?=$_SESSION['fsaai']?> to resolve our issue or reply to this message.  " > WhatsApp Us</a> -->
        
    <img style="width:15px;position: relative;top:-2px" src="assets1/images/whatsapp.png" /> SUPPORT : +91 7994051951
    </div>
    </footer>

    <!-- Support Button -->
    <a class="support-btn" target="_blank" href="https://wa.me/+917994051951?text= Hi , We are <?=urlencode($_SESSION['s_branchname'])?> , <?=$_SESSION['s_address']?>  (Version <?=$_SESSION['version']?>). Please Contact us on  <?=$_SESSION['fsaai']?> to resolve our issue or reply to this message.  ">
        <i class="fas fa-headset"></i>
    </a>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    
     <script src="js/jquery-1.10.2.min.js"></script> 
    
     <script type="text/javascript">
        
  $(document).ready(function() {  
      
        $('.calculator_settle_back').click( function(event) {
            var str =$('#pin').val();
            str = str.substring(0, str.length - 1);
            $('#pin').val(str);
            input.innerHTML=$('#pin').val();
            
            $('#pin').focus();
            
        });
      
      
         //email on dayclose resend//
	 var email_on_dayclose=$('#email_on_dayclose').val();
  
         if(email_on_dayclose=='Y'){
       
         setTimeout(function(){ 
             
            var date_daycclose=$('#date_daycclose').val();
            
            if(date_daycclose!='' && date_daycclose!='undefined' && date_daycclose!=undefined ){
             
            var datastring ="datemail="+date_daycclose;
            $.ajax({
                type: "POST",
                url: "dayclose_emailnew.php",
                data: datastring,
                success: function (data)
                {
               
                    
                }
                });
            
           }

           }, 2500); 

           }
      
      
      
      //pole display code//
	   var data_pole = "set_pole=pole_display_all&display=none";
			$.ajax({
			type: "POST",
			url: "index.php",
			data: data_pole,
			success: function(data5) {
			
			}
			});
	// pole display ends//
      
      
    
      if($('#notify_aud').val()>0){
          
        $('#urbanAudio')[0].play();
        
      }else{
          
           $('#urbanAudio')[0].pause(); 
      }
     
      
      
    ///kotmissing check//// 
  
   if($('#kot_miss_check').val()=='N'){
    
    var url_check=$('#url_check').val();
     
    if(url_check.includes("index.php")){
        
    setTimeout(function(){
         
        var data1167="set=check_missed_kot_set_ok";
        $.ajax({
        type: "POST",
        url: "print_details.php",
        data: data1167,
        success: function(data2)
        {  
            
        }
       });

       }, 7000); 
       
    }
    
    }
   
   
      if($('#kot_miss_check_ta').val()=='N'){
    
    var url_check=$('#url_check').val();
     
    if(url_check.includes("index.php")){
        
    setTimeout(function(){
         
        var data1167="set=check_missed_kot_set_ta_ok";
        $.ajax({
        type: "POST",
        url: "print_details.php",
        data: data1167,
        success: function(data2)
        {  
            
        }
       });

       }, 7000); 
       
    }
    
    }
      
      
      
         
   ///enter key pressed////       
  $(document).on("keydown", function(e) {
      
     if (e.key === "Enter") {
              
     if ($(".closechrome_popup").is(":visible")) {
 
       $(".closechrome_popup").css("display","none");
	
       $('.confrmation_overlay_proce').css('display','block');
      
       $('.confrmation_overlay_proce').html('<img style="margin-top:-500px" src="img/ajax-loaders/ajax-loader.gif" />');
                                          
        window.location.href = "logout.php";  
         
       }
       }
      });  
      
         
   /////language cick////      
   $(".selectlanguagetotal").click(function(){
     
	 var lg= $("#sellang").val();
       
	  if(lg!="Change")
	 {
		   $("#hidlanguage").val(lg);
		   $.post("load_index.php", {value:'set_language',lang:lg},
                 
		  function(data)
		  {
		  data=$.trim(data);
			
		  });
		   lg = lg.charAt(0).toUpperCase() + lg.slice(1);
		   $(".langage_btn").html(lg);
                   
	 }else
	 {
            $(".langage_btn").html("Select Language"); 
	 }
	  $('.confrmation_overlay_proce').css('display','none');
	  $(".change_language_popup").css("display","none");
	  $(".language_overlay").css("display","none");
      
     $('#lgpop').show();   
     
      setTimeout(function(){
                                                
       window.location.href='index.php';
                                       
     }, 1000);
    
  });      
              
$(".language_close_btn").click(function(e){
    
	  e.preventDefault();
	  $(".change_language_popup").css("display","none");
	  $(".language_overlay").css("display","none");
           $('.confrmation_overlay_proce').css('display','none');
  });
  
  
  
  $("#lang_btn").click(function(){
      
	  $(".change_language_popup").css("display","block");
          $('.confrmation_overlay_proce').css('display','block');
	  $(".language_overlay").css("display","block");
  });
         
         
         //////shift keypad////
          $('.calculator_settle_sh').click( function(event) {
  
		event.stopImmediatePropagation();
                
		var focused=$('#focusedtext1').val();
                
		var calval=($(this).text());
		
		var org=$('#'+focused).val();
               
			if(calval>=0)
			{   
                            if(org.length < 10){
				if(org==0)
				{
					 $('#'+focused).val(calval);
				}else if(org>0)
				{
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                            }
//                            
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
                                
			}else if(calval==".")
			{
				$('#'+focused).val(org+".");
			}
                        
			$('#'+focused).change();
		        $('#'+focused).focus();
		
	});
        //keypad end///// 
         
         
         
       $(".support-btn").on("click", function () {
            $("html, body").animate({ scrollTop: $(document).height() }, "slow");
       });
         
         
      //backup db check ////  
      setTimeout(function(){   
          
         var aj_date=$('#date_today_acc').val();
        
         if(aj_date!=localStorage.ajx_date){
            
                $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=backup_db_check",
			success: function(msg)
			{ 
                           localStorage.ajx_date=$('#date_today_acc').val();
                        }
         });
         
        }
      }, 7000);
    ///backup end///  
         
        
        
    ////delete log files all ////     
    setTimeout(function(){ 
          
        $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=delete_all_log_files",
			success: function(msg)
			{
                        }
         });
    }, 15000);
    ///end/// 
         
        
   var accounts_section=$('#accounts_section').val();
       
        if(accounts_section=='Y'){
        
         var date_today_acc=$('#date_today_acc').val();
         
         setTimeout(function(){
             
             $.ajax({
			type: "POST",
			url: "accounts/load_ledger.php",
			data: "set=loss_profit_calculator&fromdt="+date_today_acc+"&todt="+date_today_acc,
			success: function(msg)
			{
                           
                            
                        }
                    });
                    
                        $.ajax({
			type: "POST",
			url: "accounts/load_ledger.php",
			data: "set=load_balance_sheet_liability&fromdt="+date_today_acc+"&todt="+date_today_acc,
			success: function(msg)
			{
                            $('#load_ledger_data_liability').html(msg);
                         }
                        });
                        
                        $.ajax({
			type: "POST",
			url: "accounts/load_ledger.php",
			data: "set=load_balance_sheet_asset&fromdt="+date_today_acc+"&todt="+date_today_acc,
			success: function(msg)
			{
                            $('#load_ledger_data_asset').html(msg);
                         }
                        });    
                    
                    
         }, 9000); 
         
    }     
   ///end accounts////    
        
        
     ///inv staff store select///   
    if($('#inv_on').val()=='Y'){
      
      var url_check=$('#url_check').val();
   
      var new_id=url_check.split('login_type=');    
 
      if(new_id[1]=='new_login'){

      $('#inv_store_pop').show();

      $('.quick_navigation_section').addClass('disablegenerate');
   
     }
               
     }
     
     //end inv////
     
     
     ///dayopen check//
     
      var url_check=$('#url_check').val();
   
      var new_id=url_check.split('msg=');    
 
      if(new_id[1]=='dayclosed'){
          
          
                                            $("#alert_popup_old").show();
                                            $('.dayclose_printer_alert').html('PLEASE OPEN SALES TO CONTINUE');
                                            $('.confrmation_overlay_proce').css('display','block');
		
                                           setTimeout(function(){
                                                
                                           window.location.href='index.php';
                                       
                                           }, 2000);
          
          
      }
     
     ///end////////
     
     
        
        
         ///Keypad click auth/////      
         $('.calculator_settle').click( function(event) {
          
		event.stopImmediatePropagation();
                $('#focusedtext').val('pin');
		var focused=$('#focusedtext').val();
                var calval=($(this).text());
		var org=$('#'+focused).val();
			if(calval>=0)
			{
                            if(org.length < 4){
				if(org==0)
				{
					 $('#'+focused).val(calval);
				}else if(org>0)
				{
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                            }
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
			}else if(calval==".")
			{
				$('#'+focused).val(org+".");
			}
			$('#'+focused).change();
		$('#'+focused).focus();
	
	});
        
        
   ///Sale open click/////      
   $('.updatetimeopen').click(function () {
	
	      $("#alert_popup_old").show();
              $('.dayclose_printer_alert').html('DAY IS OPENING...');
              $('.revert_btn').hide();
               var single_shift=$('#single_shift').val();
            
		$('.confrmation_overlay_proce').css('display','block');
		
		var dataString;
		dataString = 'value=timeopen_first';
                $.ajax({
			  type: "POST",
			  url: "load_index.php",
			  data: dataString,
			  success: function(data) {
                              
                                  var dt=data.trim().split('{');
				  data=dt[0];
                                  
					if(data=="Day-In successfull!")
					{
                                          
                                        $("#alert_popup_old").show();
                                        $('.dayclose_printer_alert').html('TODAY SALE IS OPEN');
                                        $("#alert_popup_old").fadeOut(7000); 
                                        $('.confrmation_overlay_proce').fadeOut(7000); 
					
                        setTimeout(function(){
                          
                        location.reload();
                  
                        }, 6000);
                                        
                                        
                                        
                                         if(single_shift=='Y'){
                                             
                                           var ctrlKeyDown = false;
                                           $(document).on("keydown", keydown);
       
                                           function keydown(e) { 

                                           if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
                                          
                                           e.preventDefault();
                                           } else if ((e.which || e.keyCode) == 17) {
                                          
                                           ctrlKeyDown = true;
                                            }
                                            };
                                           
                                             $('.petty_cash_denomination_popup').show();
                                             
                                             $('.petty-popup-close').hide();
                                             
                                           }
                                        
                                        
					}else if(data="ERROR!! SALE IS ALREADY CLOSED FOR THE DAY...")
					{
                                            
					
                                        $("#alert_popup_old").show();
                                        $('.dayclose_printer_alert').html('TODAYS SALE IS ALREADY CLOSED');
                                        $("#alert_popup_old").fadeOut(6000); 
		                        $('.confrmation_overlay_proce').fadeOut(6000); 
                                        
                                        $('.revert_btn').show();
                                        
					}
					
                                        if(single_shift=='N'){
					 setInterval(test,5000);
                                     }
				  }
			  }); 
	     
		
      });
        
        
       $('.updatetimeclose').click(function () { 
	
		$('.day_close_new_popup').css('display','block');
		
		$('.confrmation_overlay_proce').css('display','block');
		
                $('#pin').focus();
      });
        
        
      $('.pin_close').click(function () { 
	
		$('.day_close_new_popup').css('display','none');
		
		$('.confrmation_overlay_proce').css('display','none');
		
      });
        
       ///Enter key press click/////        
      $(document).on("keypress", function(e){
        if (e.which === 13) {
           $('.submit_dayclose').click();
        }
     });  
        
       
       ///Daty close Sale Close click/////       
      $('.submit_dayclose').click(function () {
             
             
            var dayclose_auth = $("#hiddayclose_authorise").val();
           
            if(dayclose_auth == "Y"){
                //--------------------//
                var pin =  $('#pin').val();
                if(pin !=''){
                $.post("load_index.php", {type:'authpincheck',set:'pincheck',pin:pin},
                function(data)
		{
                    data=$.trim(data);
                 
                    var chk_permision=data.split('*');
                  
                    if(data != "NO"){
                             
                        if(chk_permision[6]=='dayclose:Y')
                        {
             
                                           var ctrlKeyDown = false;
                                           $(document).on("keydown", keydown);
       
                                           function keydown(e) { 

                                           if ((e.which || e.keyCode) == 116 || ((e.which || e.keyCode) == 82 && ctrlKeyDown)) {
                                           
                                           e.preventDefault();
                                           } else if ((e.which || e.keyCode) == 17) {
                                         
                                           ctrlKeyDown = true;
                                            }
                                            };
                                      
                        var  dataString = 'value=dayclose_check';
                        $.ajax({
			type: "POST",
			url: "load_index.php",
			data: dataString,
			success: function(data) { 
                           
                if($.trim(data)=='ok'){
             
                /////////////// dayclose function starts//////
                      
                $('.day_close_new_popup').css('display','none');
		
		$('.confrmation_overlay_proce').css('display','none');
                
		var dataString;
		dataString = 'value=timeclose_first';
		var tdate = new Date();
                var dd = tdate.getDate(); 
                var MM = tdate.getMonth(); 
                var yyyy = tdate.getFullYear(); 
                var xxx = dd+ "-"+( MM+1)+ "-" +yyyy;
		var from='a';
		var to=xxx;
		var hidbydate='';
	
		
                          $.ajax({
			  type: "POST",
			  url: "load_index.php",
			  data: dataString,
			  success: function(data) {
                              
				  data=data.trim();
                                  
				  if(data=="Day close successfull!")
				  { 
                                       ////all dayclose functions start // 
                                       
                                        $("#alert_popup_old").show();
                                        $('.dayclose_printer_alert').html('DATABASE  BACKUP IS RUNNING . PLEASE DONT CLOSE SOFTWARE');
                                        $('.confrmation_overlay_proce').css('display','block');
                                       
                                        var data2="set_backup=backup_dayclose&db_select=DATABASE_NAME_REPORT";
                                  
                                        $.ajax({
                                        type: "POST",
                                        url: "export/export.php",
                                        data:data2,
                                        success: function(data22)
                                        {
                                           
                                           
                                        }
                                        });  
                                            
                                            
                                            
                                           $('#dayclose_printer_alert').css('display','none');
                                      
                                           $.post("load_index.php", {set:'clear_app_machine_details'},
					   function(data35)
					   {
					          ///delete app machiness && reset loyalty count///
					   });
                                      
					 var rpt= $('#chkrpt').val();
                                         
				         if(rpt)
					 { 
                                                var report_print_check = "dayclose_report_print_check";
                                                $.post("printercheck_1.php", {type:report_print_check},
                                                function(data)
                                                { 
                                                    
                                                var data_printercheck=$.trim(data); 

                                         if(data_printercheck =='')
                                         {
                                            
                                             var rpt1=rpt.trim();
					     $.post("print_report_new.php", {type:rpt1,hidfr:from,hidto:to},
					     function(data3)
					     { 
						 data3=$.trim(data3);
                                          
					     });
                                         }
                                         else{
                                              
                                            $("#alert_popup_old").show();
                                            $('.dayclose_printer_alert').html(data_printercheck);
                                            $('.confrmation_overlay_proce').css('display','block');
		
                                           setTimeout(function(){
                                                
                                           $('#alert_popup_old').css('display','none'); 
                                           $('.confrmation_overlay_proce').css('display','none');
                                           }, 10000);
                                           
                                         }
                                         
                                         });
                                         
				  	 }
					 	
                                                      ////mail check//////
                                                      
                                                      var snd=$('#chkrpts').val();
                                                      var chkmail=$('#chkmail').val();
                                                      var smslist=$('#chksms').val();

                                                      $.post("text1.php", {type:snd,from:from,to:to,mail:chkmail},
                                                      function(data2)
                                                      { 
                                                                    data2=$.trim(data2);
                                                                    
                                                                    data2=data2.split('**failed**');
                                                                   
                                                                    if(data2[1]=='Email disabled in General settings'){
                                                                        
                                                                     $("#alert_popup_old").show();
                                                                     $('.dayclose_printer_alert').html(data2[1]);
                                                                     $('.confrmation_overlay_proce').css('display','block');
                                                                    setTimeout(function(){
                                                                        
                                                                     $('#alert_popup_old').css('display','none'); 
                                                                     $('.confrmation_overlay_proce').css('display','none');
                                                                    },12000);
                                                                
                                                                    }
                                                      });   
                                                      
                                                      /////invmtory store stock keeping ////
                                                      
                                                      if($('#inv_on').val()=='Y'){
                                                          
                                                      $.post("load_index.php", {set:'inv_store_stock_daily'},
                                                      function(data22)
                                                      { 
                                                                    $("#alert_popup_old").show();
                                                                    $('.dayclose_printer_alert').html('DAILY INVENTORY STOCK SYNCING');
                                                                    $('.confrmation_overlay_proce').css('display','block');
                                                                    setTimeout(function(){
                                                                        
                                                                    $('#alert_popup_old').css('display','none');
                                                                    $('.confrmation_overlay_proce').css('display','none'); 
                                                                    
                                                                    }, 13000);
                                                                    
                                                                    
                                                                   });    
                                                      }
                                        
        var stock_onoff=$('#stock_onoff').val();   
          
         if(stock_onoff=='Y'){  
  
                   $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=stockupdate_daily",
			success: function(msg)
			{
                            
                        }
                    });
           
        }
                         
                     var single_shift=$('#single_shift').val();
                     
                     if(single_shift=='N'){
                         
			  setTimeout(function(){
                               
                             window.location.href='index.php';
                           
		         }, 13000);
                                        
                     }else{
                                        
                                        setTimeout(function() {
                                            
                                             $('.confrmation_overlay_proce').css('display','block');
                                             $('.petty_cash_denomination_popup').show();
                                             
                                             $('.petty-popup-close').hide();
                                             
                                         }, 10000);
                                         
                 }
		    
                    
                        
                 ////all dayclose functions end //       
                        
		}else{       
					 
                $("#alert_popup_old").show();
                 $("#alert_popup_old").css('height','187px');
                $('.dayclose_printer_alert').html(data);
                 $('.confrmation_overlay_proce').css('display','block');
                if (data.indexOf("DINE") !== -1) { 
                    $(".redirect_di").show();
                    
                    
                }

                if (data.indexOf("COUNTER") !== -1) {
                    $(".redirect_tahdcs").show();
                }
                
               
                
                                        
		}
					  
	    }
	    });
                      
            }
            else{
                
                $('.day_close_new_popup').hide();
                           
                            if($.trim(data)=='Day Closed Already'){
                                
                                
                                
                                $("#alert_popup_old").show();
                                $('.dayclose_printer_alert').html('Already Dayclosed or User logged Out');
                                $("#alert_popup_old").fadeOut(6000); 
                                $('.confrmation_overlay_proce').css('display','block');
                                
                                 setTimeout(function(){
                                                                        
                                    window.location.href='logout.php'; 
                                 
                                 }, 2500);
                               
                                
                            }else{
                                
                                $("#alert_popup_old").show();
                                $('.dayclose_printer_alert').html($.trim(data));
                                $("#alert_popup_old").fadeOut(4000); 
                                  $('.confrmation_overlay_proce').css('display','block');               
                                 setTimeout(function(){
                                                                        
                                    window.location.href='index.php'; 
                                 
                                 }, 2500);
                                 
                              }
                                
                            }
            }
            });
            
           }else{
                        $("#pin_error").css("display","block");
			$("#pin_error").text(" NO PERMISSION ");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").val('');
                        $('#pin').focus();
            }
            }else{
                       
                        $("#pin_error").css("display","block");
			$("#pin_error").text("CODE NOT REGISTERED");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").val('');
                        $('#pin').focus();
            }
            });
                
            }else{
                
                $("#pin_error").css("display","block");
                $("#pin_error").text("ENTER YOUR CODE");
		$("#pin_error").delay(2000).fadeOut('slow');
                $('#pin').focus();
            }
                
            }  
             
   });
         
        
  });  
  
  
  function rz_crm(id,amount,br){
  
  if(id>0 && amount>0){
      
    window.open("https://www.expodine.com/crm_rz/index.php?id="+id+"&amt="+amount+"&br="+br, "_blank");
    
  }else{
      
        $('.confrmation_overlay_proce').css('display','block');
        $("#alert_popup_old").show();
        
        $('.dayclose_printer_alert').html('INVALID CRM ID OR AMOUNT');
        
        $("#alert_popup_old").fadeOut(3000); 
        $('.confrmation_overlay_proce').fadeOut(3000); 
         
  }
    
  }
  
  
  
  
  
  ////server ip setup of rflutter app//
  function set_app_ip_cloud(){
        
    var local_ip=$('#local_ip').val();  
        
     var cloud_sync_onoff=$('#cloud_sync_onoff').val();   
        
      if(cloud_sync_onoff=='Y'){  
        
        
    var confirm1=confirm(" WARNING : THIS SYSTEM IP ("+local_ip+") WILL BE SET AS SERVER IP FOR SOFTWARE & APP CONNECTIONS ?");
    
    if(confirm1===true){
        
        $('.confrmation_overlay_proce').css('display','block');
        
        $("#alert_popup_old").show();
        $('.dayclose_printer_alert').html('PLEASE WAIT...');
        //$("#alert_popup_old").fadeOut(4000);                                                                    
        
        
        var datastring ="set=set_app_ip_cloud";
        
                $.ajax({
                type: "POST",
                url: "load_index.php",
                data: datastring,
                success: function (data)
                {
                    $('.dayclose_printer_alert').text("APP LOCAL SERVER IP CHANGED SUCCESFULLY. (IP : "+local_ip+")");   
                    
                      setTimeout(function(){
                          
                        $('.confrmation_overlay_proce').css('display','none');

                       
                        $("#alert_popup_old").fadeOut(2000); 

                        location.reload();
                  
                     }, 3000);
                      
                   
                    
                }
                });
        }
        
        
      }else{
          
         ////OFFLINE MERHOD APP////// 
          
        $('.confrmation_overlay_proce').css('display','block');
        
        $("#alert_popup_old").show();
        $('.dayclose_printer_alert').html('CLOUD IS DISABLED. USE OFFLINE METHOD FOR APP CONNECTION');
        $("#alert_popup_old").fadeOut(4000); 
           
                    
                      setTimeout(function(){
                          
                        $('.confrmation_overlay_proce').css('display','none');

                        $("#alert_popup_old").fadeOut(4000); 

                        location.reload();
                  
                     }, 3500);
          
      }
          
    } 
  ///app end////
  
  
  
  
  ////redirection notifications////
  
  
    function adv_go(){
        
          window.parent.location.href ="load_advance_reminder.php?set=load_today";
    }
  
       function qr_go(){
        
          window.parent.location.href ="customer_display/qr_order_screen.php";
       }


       function urban_go(){
        
          window.parent.location.href ="customer_display/online_order_screen.php";
       }
       
        function common_go(){
        
          window.parent.location.href ="index1.php";
       }
 ///notification  end////
       
      function change_denom(){
    
     $('#focusedtext1').val('change_denom');
    var decimal=$('#decimal').val();
    var change_amount=parseFloat($('#change_denom').val());
    $('#change_tot').html(change_amount.toFixed(decimal)); 
    
   if($('#change_denom').val()==""){
      $('#change_tot').html('0');
      }
   var denomsub2="0";
    var denomsub1="0";

       $('.denoclass').each(function(){
      denomsub1=$(this).html();
        if(denomsub1==""){
            denomsub1="0";
        }
      denomsub2 =parseFloat(denomsub2)+parseFloat(denomsub1);

     });
 
  var denomsub5='0';
    var denomsub6='0';
     $('.deno_card').each(function(){
      denomsub5=$(this).html();
        if(denomsub5==""){
            denomsub5="0";
        }
      denomsub6 =parseFloat(denomsub6)+parseFloat(denomsub5);

     });
 
 
 
    var petty=parseFloat($('#pettybal').val());
     
       
       if(isNaN(petty)){
           petty=0;
          
       }
       
    if(denomsub6>0){
    var subtot=denomsub6+denomsub2+ parseFloat($('#change_tot').html());
    }else{
          subtot=denomsub2+ parseFloat($('#change_tot').html());
    }
   $('#denomsubtotal').html(subtot.toFixed(decimal));
   $('#openbal').val(subtot.toFixed(decimal));
   
   var vouch_expense=parseFloat($('#vouch_expense').val());
       if(isNaN(vouch_expense)){
           vouch_expense=0;
       }else{
           vouch_expense=parseFloat($('#vouch_expense').val());
       }
    
    var totcash=(subtot+petty)-vouch_expense;
      
      $('#totcash').val(totcash.toFixed(decimal))
   
   
   
}


function card_denom(i){
     $('#focusedtext1').val('card_denom'+i);
     
       var decimal=$('#decimal').val();
     
     var card_amount=parseFloat($('#card_denom'+i).val());
   if(card_amount>=0){
    $('#card_tot'+i).html(card_amount.toFixed(decimal)); 
    }else{
          $('#card_tot'+i).html('0'); 
    }
    
   var denomsub5='0';
    var denomsub6='0';
     $('.deno_card').each(function(){
      denomsub5=$(this).html();
        if(denomsub5==""){
            denomsub5="0";
        }
      denomsub6 =parseFloat(denomsub6)+parseFloat(denomsub5);

     });
    
    
    
    
    var denomsub2="0";
    var denomsub1="0";

     $('.denoclass').each(function(){
      denomsub1=$(this).html();
        if(denomsub1==""){
            denomsub1="0";
        }
      denomsub2 =parseFloat(denomsub2)+parseFloat(denomsub1);

     });
 
    var petty=parseFloat($('#pettybal').val());
     
       
       if(isNaN(petty)){
           petty=0;
          
       }
       
    if($('#change_tot').html()>0){
    var subtot=denomsub6+denomsub2+ parseFloat($('#change_tot').html());
    }else{
        subtot=denomsub6+denomsub2; 
    }
   $('#denomsubtotal').html(subtot.toFixed(decimal));
   $('#openbal').val(subtot.toFixed(decimal));
   
   var vouch_expense=parseFloat($('#vouch_expense').val());
       if(isNaN(vouch_expense)){
           vouch_expense=0;
       }else{
           vouch_expense=parseFloat($('#vouch_expense').val());
       }
  
    var totcash=(subtot+petty)-vouch_expense;
      
      $('#totcash').val(totcash.toFixed(decimal))
    
    
} 
 
    //number only key press///
    function numonly(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

            return false;

        }
        return true;
    }
    //end////
 
 
   ////////store selection inventory///
   function go_store(){
      
    var store=$('#store_sel').val();
      
    if(store!=''){
      
    var confirm1=confirm(" WARNING : SELECTED STORE IS USED FOR ITEM REDUCTION FROM STOCK AFTER SALES ?");
    
    if(confirm1===true){
      
      $('.confrmation_overlay_proce').css('display','block');
      $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/ajax-loader.gif" />');
      
      var datarp3="set=set_store_login&store="+store;
  
        $.ajax({
        type: "POST",
        url: "index.php",
        data: datarp3,
        success: function(data)
        {
             window.location.href='index.php';
             
        }
        });   
    }  
    
   }else{
  
       alert('WARNING : SELECT YOUR STORE');
       
       
       
       
   }
           
  }
  //end inv////
  
  
  ///central kitchen///
  
  function close_central_transfer(){
  
   $('#load_central_transfer').html('');
      
  
 }
  
  
  function load_central_req_reject(){
        
     
                            
      $('#load_central_transfer').html('Loading Data...');
      
      $('#load_central').css('display','none');
         
                  $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=check_central_req_rejects",
			success: function(msg)
			{
                           $('#load_central_transfer').html($.trim(msg));
                        }
                    });
    }
  
  
  
  function central_go(id,type,req){
       
                                   
     
        $("#alert_popup_old").show();
                                $('.dayclose_printer_alert').html('FETCHING CLOUD DATA');
                                $("#alert_popup_old").fadeOut(6000); 
                                $('.confrmation_overlay_proce').css('display','block');                 
    
        var data="set=add_transfer_all_central_check";
            
        $.ajax({
        type: "POST",
        url: "inventory/load_inventory.php",
        data: data,
        success: function(data)
        { 
           
            if($.trim(data)=='yes'){

             if(type=='local'){
               window.parent.location.href ="inventory/central_accept.php?cnt_id="+id+"&type="+type;
             }

            if(type=='cloud_transfer'){
               window.parent.location.href ="inventory/central_transfer_accept.php?cnt_id="+id+"&type="+type+"&req="+req;
             }


            }else{

           
                                 $("#alert_popup_old").show();
                                $('.dayclose_printer_alert').html('CHECK INTERNET & SYNC CENTRAL KITCHEN');
                                $("#alert_popup_old").fadeOut(6000); 
                                $('.confrmation_overlay_proce').css('display','block');         
            }
    
    
    }
    
    });
   
 }
  
  function central_go_list(){
       
     
      $('#load_central_transfer').html('Loading Data...');
      
      $('#load_central').css('display','none');
         
                    $.ajax({
			type: "POST",
			url: "load_index.php",
			data: "set=check_central_transfer_accept",
			success: function(msg)
			{
                           $('#load_central_transfer').html($.trim(msg));
                        }
                    });
     
    }  
  //end///
  
  
  function shiftopen(){
  
    $( ".petty_cash_denomination_popup").css('display','block');
    $('.confrmation_overlay_proce').css('display','block');
  
  }
  
  
  function amc_go(){ 
      
           $("#alert_popup_old").show();
           $('.dayclose_printer_alert').html("OUTLET AMC IS EXPIRED . PAY AMC FOR  SUPPORT .CONTACT +91 9895313434 | +91 7994051951");
          $('#alert_popup_old').delay(3000).fadeOut('slow');  
           $('.confrmation_overlay_proce').css('display','block');
          $('.confrmation_overlay_proce').delay(3000).fadeOut('slow');  
    }
  
  
  
  function shiftclose(){
   
        var datarp2="set=shift_close_drawer";

        $.ajax({
        type: "POST",
        url: "print_details.php",
        data: datarp2,
        success: function(data)
        {
            
          if($.trim(data)=='ok'){
              
           $('.alert_error_popup_all_in_one').show();
           $('.alert_error_popup_all_in_one').css('font-size','10px' );
           $('.alert_error_popup_all_in_one').text("CASH DRAWER IS OPEN FOR MONEY COUNTING ");
           $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
           
           
            setTimeout(function(){ 
          
            $(".petty_cash_denomination_popup").css('display','block');
            $('.confrmation_overlay_proce').css('display','block');
 
         
          }, 2000);
           
           
          }else{
              
                $(".petty_cash_denomination_popup").css('display','block');
                $('.confrmation_overlay_proce').css('display','block');
 
              
          }
           
        }
        });
 
}


$('.petty-popup-close').click(function(){ 
    
     $( ".petty_cash_denomination_popup").css('display','none');
     $('.confrmation_overlay_proce').css('display','none');
    
     $('#pettybal').val('');
     $('#openbal').val('');
     $('#totcash').val('');
     $('#denomsubtotal').html('0');
     $('.text_denoclass').val('');
     $('.denoclass').html('');
     $('#change_denom').val('');
     $('#change_tot').html(''); 
    
});

function add_denom(t){
    
     $('#focusedtext1').val('text_denom'+t);
     var decimal=$('#decimal').val();
    var denomvalue1=$('#denomvalue'+t).html();
    var denomvalue=denomvalue1.replace(',','');
    var text_denom=$('#text_denom'+t).val();
    
    if(text_denom==""){
        text_denom=0;
           $('#denomtot'+t).html('');
    }
    
    var tot=parseFloat(denomvalue)*parseFloat(text_denom);
  
    
   
   $('#denomtot'+t).html(tot.toFixed(decimal));
   
    var denomsub2="0";
    var denomsub1="0";

       $('.denoclass').each(function(){
           
        denomsub1=$(this).html();
        if(denomsub1==""){
            denomsub1="0";
        }
        denomsub2 =parseFloat(denomsub2)+parseFloat(denomsub1);

     });
 
 
    if($('#change_tot').html()==""){
       var change_deno=0;
          
    }else{
        var change_deno=parseFloat($('#change_tot').html());
    }
 
 
    var all_sum=denomsub2+change_deno;
 
    $('#denomsubtotal').html(all_sum.toFixed(decimal));
    $('#openbal').val(all_sum.toFixed(decimal));

    var vouch_expense=parseFloat($('#vouch_expense').val());
       if(isNaN(vouch_expense)){
           vouch_expense=0;
       }else{
           vouch_expense=parseFloat($('#vouch_expense').val());
       }
    
    var totcash=all_sum-vouch_expense;
      
      $('#totcash').val(totcash.toFixed(decimal))
 }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

  
        
        
        
   function isNumberKey1(evt)
       { 
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;
 
          return true;
       }     
        
  
  function pettyadd(){
       $('#focusedtext1').val('pettybal');
         var decimal=$('#decimal').val();
       
      var petty= $('#pettybal').val()
       var open= $('#openbal').val()
       
       if(petty==""){
           petty=0;
           $('#totcash').val('0');
       }
       
        if(open==""){
           open=0;
           $('#totcash').val('0');
       }
       
       var vouch_expense=parseFloat($('#vouch_expense').val());
       if(isNaN(vouch_expense)){
           vouch_expense=0;
       }else{
           vouch_expense=parseFloat($('#vouch_expense').val());
       }
       
      var totcash1=parseFloat(petty)+parseFloat(open);
     
      var totcash=totcash1-vouch_expense;
      
      $('#totcash').val(totcash.toFixed(decimal))
  }
  
    function openadd(){
         var decimal=$('#decimal').val();
        // $('#focusedtext').val('openbal');
         
      var petty= $('#pettybal').val()
       var open= $('#openbal').val()
       
       if(open==""){
           open=0;
           $('#totcash').val('0');
       }
        if(petty==""){
           petty=0;
           $('#totcash').val('0');
       }
       
       
       var vouch_expense=parseFloat($('#vouch_expense').val());
       if(isNaN(vouch_expense)){
           vouch_expense=0;
       }else{
           vouch_expense=parseFloat($('#vouch_expense').val());
       }
       var totcash1=parseFloat(petty)+parseFloat(open);
     
      var totcash=totcash1-vouch_expense;
      
      
      $('#totcash').val(totcash.toFixed(decimal))
     
  }
  
  
  
  
  
  function submitshift(oc){
   
       var attclose=$('#totcash').attr('close');
       var attopen=$('#totcash').attr('open');
     
    
     if(oc=="open"){
     
      var expoid='<?=$expoid?>';
      var openbal=$('#openbal').val();
      var pettybal=$('#pettybal').val();
      var change=parseFloat($('#change_tot').text());
      if(isNaN(change)){
         change="";
      }else{
        
         change=parseFloat($('#change_tot').text());
      }
     
       var datashift="setshift=shiftopen&expoid="+expoid+"&openbal="+openbal+"&pettybal="+pettybal+"&attclose="+attclose+"&attopen="+attopen+"&change="+change;
    
        $.ajax({
        type: "POST",
        url: "index.php",
        data: datashift,
        success: function(data)
        { 
              var slno=data.trim();
              $('#hideslno').val(slno);
             
              var denocount=new Array();
              var denoid=new Array();
              var denovalue=new Array();
               var denoidcd=new Array();
             var denoidcd_val=new Array();
             
            var dv1="0";
            $('.denocount').each(function(){
            dv1=$(this).val();
             denocount.push(dv1);
             });
            var deno_countstring=denocount.join(',');
           
           
           
          var dv2="0";
          $('.denovalue').each(function(){
          dv2=$(this).html();
          denovalue.push(dv2);
          });
          var deno_valuestring=denovalue.join(',');
           
           
           
            var dv3="0";
            $('.denoid').each(function(){
            dv3=$(this).attr('addid');
            denoid.push(dv3);
           });
           var deno_idstring=denoid.join(',');
          
            var dv4="0";
            $('.cardclass').each(function(){
            dv4=$(this).attr('bankid');
            denoidcd.push(dv4);
           
           });
           var deno_cardstring_id=denoidcd.join(',');
           
           
            var dv5="0";
            $('.cardclass').each(function(){
            dv5=$(this).html();
            denoidcd_val.push(dv5);
           
           });
           
           var deno_cardstring_val=denoidcd_val.join(',');
           
           
           
         var newslno=$('#hideslno').val();
         var sl1=newslno.trim();
         var sl2=sl1.split('/>');
         var sl33=sl2[1].trim();
         sl33 = sl33.replace(/\s/g,'');  
         var nw=sl33.split('<');
         var slno_open=$.trim(nw[0]);
          
          
          
        var datashift="setshiftdetail=shiftopendetail&slno="+slno_open+"&denoid="+deno_idstring+"&denocount="+deno_countstring+"&denovalue="+deno_valuestring+"&cardid="+deno_cardstring_id+"&cardamount="+deno_cardstring_val;
        // alert(datashift);
        $.ajax({
        type: "POST",
        url: "index.php",
        data: datashift,
        success: function(data)
        {
      
                        $('.petty_cash_denomination_popup').css('z-index','9999');
                        $('.alert_error_popup_all_in_one').show();
                        
                                $("#alert_popup_old").show();
                                $('.dayclose_printer_alert').html('YOUR SHIFT IS OPEN NOW');
                                $("#alert_popup_old").fadeOut(4000); 
                                 $('.confrmation_overlay_proce').css('display','block');                
      
        }
        
       });
        }
        
    });
  
 
     $( ".petty_cash_denomination_popup").css('display','none');
     $('.confrmation_overlay_proce').css('display','none');
     
     
      setTimeout(function(){ 
          
       window.location.reload(); 
       window.location="index.php?reload=loadopen";
         
      }, 3000);
     
   
  }else{
     
      
        var expoid1='<?=$expoid?>';
        
        var datashift1="set_check=shiftopen_check&expoid="+expoid1;
 
        $.ajax({
        type: "POST",
        url: "load_index.php",
        data: datashift1,
        success: function(datash)
        { 
           
        if($.trim(datash)=='yes'){
        
        $( ".petty_cash_denomination_popup").css('display','none');
        $('.confrmation_overlay_proce').css('display','none');
        
        var openbal1=$('#openbal').val();
        var pettybal1=$('#pettybal').val();
        var change1=parseFloat($('#change_tot').text());
         
      if(isNaN(change1)){
           change1=0;
       }else{
           change1=parseFloat($('#change_tot').text());
         
      }
      
        var datashift1="setshift1=shiftopen1&expoid="+expoid1+"&openbal="+openbal1+"&pettybal="+pettybal1+"&change1="+change1;
 
        $.ajax({
        type: "POST",
        url: "index.php",
        data: datashift1,
        success: function(data)
         { 
             //$('.confrmation_overlay_proce').css('display','block');
	     //$('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/ajax-loader.gif" />');
            
             var slno1=data.trim();
         
             $('#hideslno1').val(slno1);
             
             var denocount=new Array();
             var denoid=new Array();
             var denovalue=new Array();
             var denoidcd=new Array();
             var denoidcd_val=new Array();
             
             
            var dv1="0";
            $('.denocount').each(function(){
            dv1=$(this).val();
            denocount.push(dv1);
            });
            
            var deno_countstring=denocount.join(',');
           
            var dv2="0";
            $('.denovalue').each(function(){
            dv2=$(this).html();
            denovalue.push(dv2);
             });
            var deno_valuestring=denovalue.join(',');
           
           
            var dv3="0";
            $('.denoid').each(function(){
             dv1=$(this).attr('addid');
           denoid.push(dv1);
           });
         var deno_idstring=denoid.join(',');
         
         
          var dv4="0";
            $('.cardclass').each(function(){
            dv4=$(this).attr('bankid');
            denoidcd.push(dv4);
           
           });
           var deno_cardstring_id=denoidcd.join(',');
           
           
            var dv5="0";
            $('.cardclass').each(function(){
            dv5=$(this).html();
            denoidcd_val.push(dv5);
           
           });
           
           var deno_cardstring_val=denoidcd_val.join(',');
         
         
         
         
          
         var newslno=$('#hideslno1').val();
         var sl1=newslno.trim();
         var sl2=sl1.split('/>');
         var sl331=sl2[1].trim();
    
          sl331 = sl331.replace(/\s/g,'');  
          var nw1=sl331.split('<');
          var slno_close=$.trim(nw1[0]);

         var datashift3="setshiftdetail1=shiftopendetail1&slno="+slno_close+"&denoid="+deno_idstring+"&denocount="+deno_countstring+
         "&denovalue="+deno_valuestring+"&cardid="+deno_cardstring_id+"&cardamount="+deno_cardstring_val;
  
        $.ajax({
        type: "POST",
        url: "index.php",
        data: datashift3,
        success: function(data)
        {
         
         $('.petty_cash_denomination_popup').css('z-index','9999');
         $('.alert_error_popup_all_in_one').show();
                        
       
         
          $("#alert_popup_old").show();
          $('.dayclose_printer_alert').html('YOUR SHIFT IS CLOSED');
          $("#alert_popup_old").fadeOut(6000); 
          $('.confrmation_overlay_proce').css('display','block');
         
          var newslno1=$('#hideslno1').val();
          var sl11=newslno1.trim();
          var sl21=sl11.split('/>');
          var sl3311=sl21[1].trim();
       
          sl3311 = sl3311.replace(/\s/g,'');  
          var nw11=sl3311.split('<');
          var slno_print=$.trim(nw11[0]);

            var dayclose_shift=$('#dayclose_for_shift').val();
         
            var shift_print = "shift_print";
          
            $.post("printercheck_1.php", {type:shift_print},
                                               
            function(data)
            { 
                
            data=$.trim(data); 
          
        if(data !=0)
        { 
                                            
                                            
                alert(data);

                $( ".petty_cash_denomination_popup").css('display','none');

                $('.confrmation_overlay_proce').css('display','none');

                window.location.reload();
                window.location="index.php?reload=loadopen";	                   
                                                           
        }else{
                
          

        if('<?=$_SESSION['s_printst']?>'=='Y'){
            
        var datarp="set=shift_report&slnoshift="+slno_print+"&day_shift="+dayclose_shift;

        $.ajax({
        type: "POST",
        url: "print_details.php",
        data: datarp,
        success: function(data)
        {
         
         
        }
        
       });
       
       }
   
   
        var datarp2="set=shift_email&slnoshift="+slno_print+"&day_shift="+dayclose_shift;

        $.ajax({
        type: "POST",
        url: "shift_mail.php",
        data: datarp2,
        success: function(data)
        {
          
        }
        });
       
   
            // $('.confrmation_overlay_proce').css('display','block');
            //  $('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/ajax-loader.gif" />');
      
            $( ".petty_cash_denomination_popup").css('display','none');

            setInterval(function() {

             window.location.reload();
             window.location="index.php?reload=loadopen";

            },2000);
    
    
    }
    
    });
    }
    
    
    
        
    });
        
    }
       
       
       
    });
    
    
    
    }else{
    
                        
                        $('.petty_cash_denomination_popup').css('z-index','9999');
                        $('.alert_error_popup_all_in_one').show();
                     
    
                                $("#alert_popup_old").show();
                                $('.dayclose_printer_alert').html($.trim(datash));
                                $("#alert_popup_old").fadeOut(6000); 
                                $('.confrmation_overlay_proce').css('display','block');
    
    
    }
    
    
   }
    });
  
  
    }
  }
  
  
  
  function close_pop_chrome(){
    
          $(".closechrome_popup").css("display","none");
	  $(".confrmation_overlay_proce").css("display","none");
          $('#pin').focus();
 }
  
  
  function logoutclose(){
      
      $(".closechrome_popup").css("display","none");
	
      $('.confrmation_overlay_proce').css('display','block');
      
      $('.confrmation_overlay_proce').html('<img style="margin-top:-500px" src="img/ajax-loaders/ajax-loader.gif" />');
       
       window.location.href = 'logout.php';
       
     }
  
 
/////////////////INBUILT CODES///////////////////////////////////////////
        
        // User Dropdown Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const userDropdown = document.getElementById('userDropdown');
            const userDropdownMenu = document.getElementById('userDropdownMenu');
            
            // Toggle dropdown on click
            userDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdownMenu.classList.toggle('show');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!userDropdown.contains(e.target) && !userDropdownMenu.contains(e.target)) {
                    userDropdownMenu.classList.remove('show');
                }
            });
            
            // Close dropdown on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    userDropdownMenu.classList.remove('show');
                }
            });
            
            // Handle dropdown item clicks
            const dropdownItems = document.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const action = this.textContent.trim();
                    
                    switch(action) {
                        case 'Profile':
                            console.log('Profile clicked');
                            // Add your profile action here
                            break;
                        case 'Settings':
                            console.log('Settings clicked');
                           
                                window.location.href = 'branch_settings.php';
                            
                            break;
                        case 'Logout':
                            console.log('Logout clicked');
                            
                            $('.closechrome_popup').show();
                             $('.confrmation_overlay_proce').css('display','block');
                            // Add your logout action here
                            //if (confirm('Are you sure you want to logout?')) {
                                // Redirect to logout page or perform logout action
                               // window.location.href = 'logout.php';
                                
                                
                                
                           // }
                            break;
                    }
                    
                    userDropdownMenu.classList.remove('show');
                });
            });
        });

    // Notification Dropdown Functionality
    document.addEventListener('DOMContentLoaded', function() {
            
            const notificationDropdown = document.getElementById('notificationDropdown');
            const notificationDropdownMenu = document.getElementById('notificationDropdownMenu');
            const btnViewAll = document.querySelector('.btn-view-all');
            const btnClearAll = document.querySelector('.btn-clear-all');
            const notificationItems = document.querySelectorAll('.notification-item');
            const notificationBadge = document.querySelector('.notification-badge');
            const notificationCount = document.querySelector('.notification-count');
            
            // Toggle notification dropdown on click
            notificationDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationDropdownMenu.classList.toggle('show');
            });
            
            // Close notification dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!notificationDropdown.contains(e.target) && !notificationDropdownMenu.contains(e.target)) {
                    notificationDropdownMenu.classList.remove('show');
                }
            });
            
            // Handle notification item clicks
            notificationItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const title = this.querySelector('.notification-title').textContent;
                    console.log('Notification clicked:', title);
                    // Add your notification action here
                    
                    // Mark as read (optional)
                    this.style.opacity = '0.6';
                });
            });
            
            // Handle View All button
            btnViewAll.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('View All notifications clicked');
                // Add your view all action here
                notificationDropdownMenu.classList.remove('show');
            });
            
            // Handle Clear All button
            btnClearAll.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to clear all notifications?')) {
                    console.log('Clear All notifications clicked');
                    
                    // Clear all notifications
                    notificationItems.forEach(item => {
                        item.style.display = 'none';
                    });
                    
                    // Update badge and count
                    notificationBadge.textContent = '0';
                    notificationCount.textContent = '0 new';
                    
                    // Hide dropdown
                    notificationDropdownMenu.classList.remove('show');
                }
            });
            
            
        });
  /////////////////INBUILT CODES END///////////////////////////////////////////      
        
        
        
        
    </script>
    <link href="css/bootstrap-cerulean.min.css" rel="stylesheet" type="text/css">
    
      <style>.dayalready_closed_popup{z-index: 99999 !important}
        body{float: none !important;position: inherit !important;width: inherit !important;padding: 0  !important}

    .day_close_new_popup {
    width: 370px;
    height: auto;
    position: absolute;
    z-index: 99999;
    background-color: #fff;
    left: 68px;
    right: 0;
    margin: auto;
    border-radius: 30px;
    top: 20%;
}

.confrmation_overlay_proce{
	width:100%;
	height:100%;
	position:fixed;
	z-index:9999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
		}

.panel-content{background-color:#fff}
#lanipall strong{padding-left:212px}
.backto_table_select{border-radius:60px;margin-bottom:5px}
.dayalready_closed_popup{
	width:100%;
	height:100%;
	float:left;
	position:fixed;
	background-color:rgba(0,0,0,0.8);
	top:0;
	left:0;
	z-index:99;
	}
.dayclose_printer_alert1{
    width: 425px;
    overflow: hidden;
    height: 150px;
    line-height: 160px;
    position: absolute;
    background-color: #fff;
    z-index: 999;
    left: 0;
    right: 0;
    margin: auto;
    bottom: 0;
    top: 0;
    text-align: center;
    border: solid 2px #b31700;
    color: #222;
	font-size:12px;
        border-radius: 5px;
        font-weight: bold
	}	
.dayclose_printer_alert_btn{
	width:100px;
	height:40px;
	float:none;
	display:inline-block;
	margin-top:15px;
	background-color: #B31700;
	text-align:center;
	line-height:40px;
	font-size:20px;
        font-weight: bold;
	}

    </style>
    
     <link rel="stylesheet" href="css/bootstrap.min.css">
     
     
     <div class="confrmation_overlay_proce" style="display:none"></div>
    
     
     <!-- //////// Auth popup/////////-->
     
    <div class="day_close_new_popup" style="display:none">
    <input type="hidden" name="focusedtext" id="focusedtext" />
    <div class="kotcancel_reason_popup_new_left_cc">
        <div class="kotcancel_reason_popup_new_head" style="font-size: 19px;height: 35px;font-weight: bold;margin-top: 30px"><i class="fa fa-warning" style="font-size:20px;color:red;display: none"></i> Sale Close Authorization</div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    
    	
        <div style="width: 100%;float: left;height: 13px;line-height: 10px;text-align: center"><span id="pin_error" style="color:darkred;font-weight: bold"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input style="    text-align: center;border-radius: 20px" type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="ENTER YOUR CODE" id="pin" onkeypress="return numonly(event)" autofocus maxlength="4" autocomplete="off"/>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn pin_close" >Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn kotcscancel submit_dayclose" >SUBMIT</div></a>
    </div>
  </div>
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle">1</span>
            <span class="calculator_settle">2</span>
            <span class="calculator_settle">3</span>
            <span class="calculator_settle_back">&nbsp;</span>
            <span class="calculator_settle">4</span>
            <span class="calculator_settle">5</span>
            <span class="calculator_settle">6</span>
            <span class="calculator_settle">Clear</span>
            <span class="calculator_settle">7</span>
            <span class="calculator_settle">8</span>
            <span class="calculator_settle">9</span>
            <span class="calculator_settle">0</span>
        </div>
  </div>
    
 
</div>
     
  <!-- //////// alert popup/////////-->  
    
 
    
 <style>
.stck_add_btn{width: 20px; height: 20px; display: inline-block;background-color: #738a77; border-radius: 50%; color: #fff !important; margin-left: 5px;}
.stok_add_popup_sec{width:100%;height:100%;position:fixed;left:0;top:0;z-index:8;background-color:rgba(0,0,0,0.9)}
.stok_add_popup{width:350px;height:150px;position:absolute;left:0;right:0;top:39%;background-color:#fff;margin:auto;border-radius:10px;}
.stok_add_popup_hd{width:100%;height:auto;float:left;font-size:18px;color:#242424;text-align:center;padding:10px 0;position:relative}
.stok_add_popup_cnt{width:100%;height:auto;float:left;padding:10px;}
.stock_add_txtbx{width:60%;height:35px;float:left;border:solid 1px #ccc;padding-left:10px}
.stock_add_btn{width:38%;float:right;height:35px;text-align:center;line-height:35px;background-color:#2a6434;color:#fff;border-radius:5px;}
.stok_add_popup_cls{width:20px;height:20px;position:absolute;right:5px;top:5px}
.disablegenerate
        {
            pointer-events: none;
            opacity: 0.8;
            cursor:none;

        }
 </style>
     
    <!--////////inv store popup //////////////////////////////////////// -->

    <div class="stok_add_popup_sec" style="display:none" id="inv_store_pop">    
    <div class="stok_add_popup">
        <div class="stok_add_popup_hd" style="" >  
            
        <i style="width: 15px;height: 25px;font-size: 29px "></i> 
        <span style="font-weight: bold;font-size: 24px;color: #d32b2b;"> &nbsp; &nbsp;  SELECT INVENTORY STORE</span> 
            
        <a style="display: none " href="#" onclick="$('#inv_store_pop').hide();"><div class="stok_add_popup_cls">
         <img width="100%" src="img/black_cross.png" alt=""></div></a>
        </div>
        <div class="stok_add_popup_cnt" id="cus_div" >
            
        <span style="font-size:15px;font-weight: bold;color: darkred"> Please confirm your inventory store ?</span> 
            
            
             <?php
             
                                        $stores_inv=$_SESSION['ser_stores'];
             
					$sql_kot  =  $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y'  and ti_id in ($stores_inv)");
					$num_kot   = $database->mysqlNumRows($sql_kot);
					if($num_kot){
                                        ?>
            
                                        <select class="stock_add_txtbx" id="store_sel" style="font-weight:bol;text-transform: uppercase" >
                                        <option value="">Store</option>
                                        
                                        <?php
					while($result_kot  = $database->mysqlFetchArray($sql_kot))
					{
					?>
                                        <option <?php if($_SESSION['ser_store_inv']==$result_kot['ti_id']){ ?> selected <?php } ?> value="<?=$result_kot['ti_id']?>"><?=$result_kot['ti_name']?></option>
                                        <?php } ?>
                                        
                                    	 </select>
                                        <?php } ?>
            
            <a style="font-size: 12px;font-weight: bold " onclick="go_store();" href="#"><div class="stock_add_btn">Confirm</div></a>
            
        </div>
        
    </div>
   </div>
     
     
   <!-- //////// Shift popup/////////-->
 
   <style>
       
       .petty_cash_denomination_popup{
	width:680px;
	height:auto;
	position:absolute;
	z-index:9999999999;
	background-color:#fff;
	left:0;
	right:0;
	margin:auto;
	border-radius:10px;
	overflow: hidden;
	}
.petty_cash_denomination_popup_head{
    width: 100%;
    height: 48px;
    float: left;
    line-height: 35px;
    margin-bottom: inherit;
    text-align: center;
    font-size: 23px;
    padding: 8px 0;
    color: #000;
    font-family: 'CALIBRI_0';
    background-color: #ffffff;
	border-bottom: 1px #ccc solid;
 }
.petty_cash_denomination_popup_contant{
	width: 100%;
   /* max-height:380px;*/
	overflow:auto;
    float: left;
	background-color: #f1f1f1;
	}
       .petty_cash_table{
	width:100%;
	height:auto;
	float:left;
	}
.petty_cash_table thead th{
	background-color:#333;
	text-align:center;
	padding:1%;
	color:#fff;
	font-size:17px;
	font-family: 'CALIBRIB_0';
	border:solid 1px #666;
	}		
.petty_cash_table tbody td{
	text-align:center;
	padding:1%;
	color:#000;
	font-size:15px;
	font-family: 'CALIBRIB_0';
	/* border:solid 1px #ccc; */
	}
.petty_cash_rp{
    width: 100px;
    display: inline-block;
    padding: 0% 7%;
    height: 25px;
    /* border:solid 1px #b9b9b9; */
    /* background-color: #ccc; */
    color: #000;
    font-size:18px;
    border-radius:5px;
    font-family: 'CALIBRIB_0';
 }	
.petty_cash_count{
	width:90%;
	height: 25px;
	display:inline-block;
	border:solid 1px #ccc;
	text-align:center;
	border-radius:5px;
	}	
.petty_cash_total_count_cc{
    width: 100%;
    height: 37px;
    float: left;
    border:0;
	border-bottom:0;
    background-color: #fff;
    margin-top: 1px;
    padding-top: 0px;
		}
.petty_cash_total_count{
	width:30%;
	height:30px;
	float:right;
	font-family: 'CALIBRIB_0';
	font-size:23px;
	text-align:center;
	color:#000;
	line-height:29px;
	}	
.petty_cash_close_cc{
	width:100%;
	height:50px;
	float:left;
	text-align:center;
    background-color: #ffffff;
    border-top: 1px #ccc solid;
	}	
.petty_cash_close_btn {
width: 16.3%;
    display: inline-block;
    height: 42px;
    line-height: 42px;
    background-color: #FF2306;
    text-align: center;
    margin-right: 1%;
    border-radius: 5px;
    transition: all 0.2s ease;
    color: #fff;
    font-size: 16px;
    margin-top: 4px;
}
.petty_cash_close_btn:hover{background-color:#f00}
.petty_cash_left_cc{width:65%;float:left;height:auto;}
.petty_cash_right_cc{width:35%;height:auto;float:left;}
.petty_cash_right_cc .settle_key{margin-top:5px}
.petty_cash_right_cc .kotcancel_reason_popup_new_right_cc .keys span, .top span.clear{
	    width: 30%;
    height: 59px;
    line-height: 59px;
    font-size: 17px;
    margin: 0 3% 3.5% 0;
	}
        .petty-popup-close{
	width:30px;
	height:30px;
	position:absolute;
	top:7px;
	right:5px;
	}
.petty-popup-close img{width:100%}
.petty-cash-textbox-cc{
	width:100%;
	height:210px;
	float:left;
	padding:1% 2%;
    overflow-y: auto;
	}	
.petty-cash-textbox-box{
    width: 95%;
    height: auto;
    float: left;
    margin-top: 15px;
    margin-left: 2%;
	}		
.petty-cash-textbox-box-text{
	width:100%;
	height:auto;
	float:left;
	font-size:13px;
	color:#333;
	}
.petty-cash-textbox{
width: 100%;
    height: 31px;
    float: left;
    border: 0;
    border: 1px #e2e2e2 solid;
    background-color: #f1f1f1;
    padding: 2%;
    border-radius: 5px;
    color: #000;
	font-size:15px;
	}
         .dayclose_waitting_popup{
    width: 350px;
    height: 145px;
    position: absolute;
    z-index: 9999;
    background-color: #fff;
    text-align: center;
    padding: 18px;
    color: #5d5d5d;
    font-size: 20px;
    left: 0;
    right: 0;
    margin: auto;
    border: solid 1px #ab2426;
    border-radius: 5px;
    top: 0;
    bottom: 0;
    line-height: 25px;
    text-transform: uppercase;
    font-weight: bold;
         
     }  
   </style>
   
   
    <div class="petty_cash_denomination_popup" style="display:none;top: 15px">
    	<div class="petty_cash_denomination_popup_head">Enter Cash Denomination
            <a href="index.php"><div class="petty-popup-close"><img src="img/cancel-icon.png"></div></a>
        </div>
        <div class="petty_cash_left_cc">
            <div class="petty_cash_denomination_popup_contant">
                <table class="petty_cash_table">
                    <thead>
                        <tr>
                            <th width="50%">Denomination</th>
                            <th width="20%">Count</th>
                            <th width="30%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
               $sql_login_dm  =  $database->mysqlQuery("SELECT * FROM `tbl_denomination_master` WHERE `dm_active`='Y' "); 
                $num_login_dm   = $database->mysqlNumRows($sql_login_dm);
                if($num_login_dm){$i=0;
                    while($result_login_dm  = $database->mysqlFetchArray($sql_login_dm)) 
                      { $i++;
                      ?>
                        
                        <tr>
                            <td><span class="petty_cash_rp denoid"  addid="<?=$result_login_dm['dm_id']?>"  id="denomvalue<?=$i?>"> <?=number_format($result_login_dm['dm_denomination'],$_SESSION['be_decimal'])?></span></td>
                            <td><input value="" type="text" id="text_denom<?=$i?>"  calcid="<?=$i?>" class="petty_cash_count text_denoclass denocount" onkeypress="return isNumber(event);" onkeyup="add_denom('<?=$i?>');" onclick="add_denom('<?=$i?>');" onchange="add_denom('<?=$i?>');" ></td>
                            <td id="denomtot<?=$i?>" class="denoclass denovalue"></td>
                        
                        </tr>
                        
                <?php }  } ?>
                      
                        
                        <tr ><td colspan="3" style="height: 0px ;border: solid 1.5px;padding: 0px"></td></tr>
                        
                         <tr>
                             <td><span>CHANGE</span></td>
                              <td>
                                  <input class="petty_cash_count" type="text" onkeyup="return change_denom();" onclick="return change_denom();" onchange="return change_denom();" id="change_denom"> 
                                 </td>
                                <td id="change_tot" class="deno_change"></td>
                              </tr>
                              
               <?php
               $sql_login_dm  =  $database->mysqlQuery("SELECT * FROM `tbl_bankmaster` WHERE `bm_active`='Y' "); 
                $num_login_dm   = $database->mysqlNumRows($sql_login_dm);
                if($num_login_dm){$i=0;
                    while($result_login_dm  = $database->mysqlFetchArray($sql_login_dm)) 
                      { 
                      ?>
                          <tr>
                                
                             <td><span>CARD :  <?=$result_login_dm['bm_name']?> </span></td>
                              <td>
                                  <input class="petty_cash_count" type="text" onkeyup="return card_denom('<?=$result_login_dm['bm_id']?>');" onclick="return card_denom('<?=$result_login_dm['bm_id']?>');" onchange="return card_denom('<?=$result_login_dm['bm_id']?>');" id="card_denom<?=$result_login_dm['bm_id']?>"> 
                                 </td>
                                <td id="card_tot<?=$result_login_dm['bm_id']?>" class="deno_card cardclass" bankid="<?=$result_login_dm['bm_id']?>"></td>
                         </tr>
                         <?php
                         }}
                         ?>
                    </tbody>
                </table>
            </div>
             <input type="hidden" id="hideslno" name="hideslno"> 
              <input type="hidden" id="hideslno1" name="hideslno1"> 
              <input type="hidden" id="dayclose_for_shift" value="<?= $_SESSION['date']?>" > 
             
            <input type="hidden" id="focusedtext1" name="focusedtext1"> 
            <div class="petty_cash_total_count_cc">
                
                <table class="petty_cash_table">
                    <thead>
                	<tr>
                        <td colspan="2" style="border:solid 1px #ccc" width="70%"><div style="width:100%;text-align:right;padding-right:5px" class="petty_cash_total_count">Denomination Total : </div></td>
                        
                        <td style="border:solid 1px #ccc"><div style="width:100%" class="petty_cash_total_count" id="denomsubtotal">0</div></td>
                    </tr>
                </thead>  
                </table>  
            </div>
            
        </div><!--petty_cash_left_cc-->
        <div class="petty_cash_right_cc">
        	<div class="kotcancel_reason_popup_new_right_cc">
            <div class="petty-cash-textbox-cc">
            	<div class="petty-cash-textbox-box">
                        <div class="petty-cash-textbox-box-text" style="color:#000" ><?php if ($_SESSION['shiftclosetime']=="" && $_SESSION['shiftday']=="") {?> OPENING BALANCE <?php } else {  ?> Closing Balance <?php } ?></div>
                        <input type="text" class="petty-cash-textbox" readonly  style="background-color: #fff " id="openbal" onfocus="return openadd();" placeholder=" Balance" onclick="return openadd();" onkeyup="return openadd();" onkeypress="return isNumberKey1(event);"  onchange="return openadd();">
                </div>
                <div class="petty-cash-textbox-box">
                	<div class="petty-cash-textbox-box-text">PETTY CASH IN HAND</div>
                        <input type="text" class="petty-cash-textbox"  style="background-color: #fff " id="pettybal" placeholder=" Cash" onclick="return pettyadd();" onkeyup="return pettyadd();" onkeypress="return isNumberKey1(event);"  onchange="return pettyadd();">
                </div>
                <?php if ($_SESSION['shiftday']!="") {
                    
                    
                $sql_login_dm1  =  $database->mysqlQuery("SELECT sd_open FROM tbl_shift_details WHERE sd_close_balance='0' "); 
                $num_login_dm1   = $database->mysqlNumRows($sql_login_dm1);
                if($num_login_dm1){
                    while($result_login_dm1  = $database->mysqlFetchArray($sql_login_dm1)) 
                      { 
                        
                        $from_sh=$result_login_dm1['sd_open'];
                        $to_sh= date("Y-m-d H:i:s");
                    }
                    }
                    
                  
                    
                $sql_login_dm2  =  $database->mysqlQuery("SELECT sum(vp_amount) as exp_amount FROM `tbl_voucherpayment` WHERE `vp_status`='Approved'"
                . "  and vp_type='Expense' and vp_approvedby='".$_SESSION['login_dayopen_staffid']."' and vp_approveddate between '".$from_sh."' and '".$to_sh."'   "); 
                  
                $num_login_dm2   = $database->mysqlNumRows($sql_login_dm2);
                if($num_login_dm2){
                    while($result_login_dm2  = $database->mysqlFetchArray($sql_login_dm2)) 
                      { 
                    $expense=$result_login_dm2['exp_amount'];
                    ?>
                <div class="petty-cash-textbox-box">
                        <div class="petty-cash-textbox-box-text" style="color:#000" >Expense</div>
                        <input type="text" class="petty-cash-textbox" readonly value="<?=$expense?>"  style="background-color: #fff " id="vouch_expense" placeholder=" Expense " >
                </div>
                      <?php } } } ?>
                
                
                <div class="petty-cash-textbox-box">
                	<div class="petty-cash-textbox-box-text" style="color:#000"><strong>TOTAL CASH</strong></div>
                        <input readonly type="text" class="petty-cash-textbox" id="totcash"  <?php if ($_SESSION['shiftclosetime']=="" && $_SESSION['shiftday']=="") {?> open="sopen" <?php } else {  ?> close="sclose" <?php } ?>    value="" style="font-weight:bold;color:#000 !important;font-size:16px;">
                </div>
            </div>
  		<div class="keys settle_key">
            <span class="calculator_settle_sh">1</span>
            <span class="calculator_settle_sh">2</span>
            <span class="calculator_settle_sh">3</span>
            <span class="calculator_settle_sh">4</span>
            <span class="calculator_settle_sh">5</span>
            <span class="calculator_settle_sh">6</span>
            <span class="calculator_settle_sh">7</span>
            <span class="calculator_settle_sh">8</span>
            <span class="calculator_settle_sh">9</span>
            <span class="calculator_settle_sh">0</span>
             <span class="calculator_settle_sh">.</span>
            <span  class="calculator_settle_sh">Clear</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
        </div>
        
        <div class="petty_cash_close_cc" style="text-align:right">
                
                <a href="#"   <?php if ($_SESSION['shiftclosetime']=="" && $_SESSION['shiftday']=="") {?> onclick="return submitshift('open');" <?php } else if($_SESSION['shiftclosetime']=="" && $_SESSION['shiftday']!="") {  ?>  onclick="return submitshift('close');" <?php } ?>   ><div class="petty_cash_close_btn submitshiftopen">SUBMIT</div></a>
            </div>
    </div>
 
 
<!--   ///////////LANGUAGE POPUP////-->
   
   
   <div class="change_language_popup">
    	<div class="language_close_btn"></div>
    	<div class="select_language_headiing">Change Language</div>
        <div class="select_language_headiing_text"></div>
        
        <div class="change_language_btn" style="margin-bottom: 8px;">
        	<select class="change_language_btn_select langselchng" id="sellang"  >
            	
                <?php
                
		$sql_login  =  $database->mysqlQuery("select ls_language from tbl_languages"); 
		$num_login   = $database->mysqlNumRows($sql_login);
		if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
		{
                    
		?>
                    
                <option value="<?=$result_login['ls_language']?>" <?php if($_SESSION['main_language']==$result_login['ls_language']){ ?> selected="selected" <?php } ?> > <?=ucfirst($result_login['ls_language'])?></option>
            
                <?php } } ?>
                
               </select>
            
        </div>
        
         <div class="change_language_btn"><a href="#" class="change_language_ok_btn selectlanguagetotal ">Ok</a></div>
    
    </div>
   

   <!--  ///logout/////-->
   <div class="closechrome_popup">
   
       <div  class="select_language_headiing"><strong>LOGOUT EXPODINE ?</strong></div>
        
       <div class="change_language_btn"><a href="#" class="change_language_ok_btn " onclick="return logoutclose();">YES</a>
       <a href="#" class="change_language_ok_btn " onclick="return close_pop_chrome();">NO</a></div>
          
    </div>
 
   
   <!--   /////alert////-->
   <div class="dayclose_waitting_popup dot_blink" id="alert_popup_old" style="display:none;">
     <div class="dayclose_waitting_popup_img">
     	<img src="img/alert.png">
     </div>
       
       <div class="dayclose_printer_alert_popup dayclose_printer_alert" style="font-size:18px">
        
    </div>
     
     <div class="kotcancel_reason_popup_new_textbox_btn_cc revert_btn" style="margin-top:0px;z-index: 999999;position: relative;display: none">
   <a href="troubleshoot.php?load_revert=revert_ok"><div class="kotcancel_reason_popup_new_textbox_btn kotcscancel" >REVERT</div></a>
  </div> 
  
  <div class="kotcancel_reason_popup_new_textbox_btn_cc redirect_di" style="margin-top:0px;z-index: 999999;position: relative;display: none">
      <a href="table_selection.php"><div class="kotcancel_reason_popup_new_textbox_btn kotcscancel" >DINE IN</div></a>
        <a href="index.php"><div class="kotcancel_reason_popup_new_textbox_btn kotcscancel" >CLOSE</div></a>
  </div> 
  
   <div class="kotcancel_reason_popup_new_textbox_btn_cc redirect_tahdcs" style="margin-top:0px;z-index: 999999;position: relative;display: none">
       
        <?php if(in_array("take_away_", $_SESSION['menuarray'])) { ?>
                  
       <a href="take_away_.php?settacommon=settletapopup"><div class="kotcancel_reason_popup_new_textbox_btn kotcscancel" style="width: 75px;">TA HD</div></a>
       
        <?php } ?>
       
        <?php if(in_array("counter_sales", $_SESSION['menuarray'])) { ?>
       <a href="counter_sales.php?setcscommon=settlecspopup"><div class="kotcancel_reason_popup_new_textbox_btn kotcscancel" style="width: 75px;">CS</div></a>
        <?php } ?>
       
       <a href="index.php"><div class="kotcancel_reason_popup_new_textbox_btn kotcscancel" style="width: 75px;">CLOSE</div></a>
       
  </div> 
     
     
     
   </div> 
   
  

 <audio id="urbanAudio"><source src="urban.ogg" type="audio/ogg"></audio>

 
   <!-- Centered QR Code Modal -->
   
   <div class="qr-overlay" id="qrModal" style="display:none">
   <div class="qr-box">
    <h3 style="font-weight: bold;font-family: 'FontAwesome'; ">SCAN TO PAY </h3>
    
    <h4 style="font-size: 14px;font-weight: bold;color: teal;">AMC Amount : <?=$amc_pay?> /-</h4>
    
    <h4 style="font-size: 12px;font-weight: bold;">(Ref Id: <?=$amc_id?> & Validity: 1 Year)</h4>
    
    <?php
        
        // Include QR Library
        include 'phpqrcode/qrlib.php';
        // Merchant Details
        $br_qr=$_SESSION['s_branchname'];
        $upi_id     = "explore15589@fbl";   // your UPI ID
        $name       = "EXPLORE IT SOLUTIONS";      // your shop/business name
        $note       = "AMC Payment . Branch $br_qr . ID $amc_id";    // note shown inside GPay
        $amount     = $amc_pay;     // optional e.g. 150.00 or leave empty
        // Create UPI URL
        $upi_url = "upi://pay?pa={$upi_id}&pn={$name}&tn={$note}&am={$amount}&cu=INR";
        // Output file
        $file = "gpay_custom_qr.png";
        // Generate QR image
        QRcode::png($upi_url, $file, QR_ECLEVEL_H, 10);

      if($amc_pay>0){
            
      ?>
    
      <img style=" filter: blur(6px);" src="<?=$file?>" alt="QR Code">
    
      <?php } else{ ?>
    
      <img style=" filter: blur(6px);" src="https://www.expodinereports.com/qr_company.png" alt="QR Code">
    
      <?php }  ?>
    
    <button class="close-btn66" onclick="document.getElementById('qrModal').style.display='none'">&times;</button>
    
  </div>
       
</div>

<style>
/* Overlay background */
.qr-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

/* QR box */
.qr-box {
  position: relative;
  background: #fff;
  padding: 20px 25px;
  border-radius: 12px;
  text-align: center;
  box-shadow: 0 8px 24px rgba(0,0,0,0.2);
  min-width: 240px;
}

/* Heading */
.qr-box h3 {
  margin: 0 0 15px 0;
  font-size: 18px;
  color: #333;
}

/* QR image */
.qr-box img {
  width: 150px;
  height: 150px;
  object-fit: contain;
}

/* Close button */
.close-btn66 {
  position: absolute;
  top: 8px;
  right: 8px;
  border: none;
  background: transparent;
  font-size: 20px;
  font-weight: bold;
  cursor: pointer;
  color: #888;
  transition: color 0.2s;
}


</style>
 
</body>
</html>
