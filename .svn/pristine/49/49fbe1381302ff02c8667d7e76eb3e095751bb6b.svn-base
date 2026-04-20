
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

$_SESSION['host']=HOST_NAME;
$_SESSION['user']=USER_NAME;
$_SESSION['pas']=PASSWORD;
$_SESSION['db']=DATABASE_NAME;
$_SESSION['reprint_db']='normal';


if(isset($_REQUEST['set'])&&($_REQUEST['set']=="set_store_login")){
    
    
     $sql_kotlist55  =  $database->mysqlQuery(" update tbl_staffmaster set ser_store_inv='".$_REQUEST['store']."'"
     . "  where ser_staffid='".$_SESSION['login_dayopen_staffid']."' ");
}

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
    
    
 }else if($_REQUEST['display']=="none"){
         
    
    exec("MODE $port 9600, N, 8,1");
    exec("cls>$port ");
    exec("echo $msg_pole>$port ");
    
          
 }else if($_REQUEST['display']=="thankyou"){
     
    $msg1="Thank You                   Visit Again ";
    exec("MODE $port 9600, N, 8,1");
    exec("cls>$port");
    exec("echo $msg1>$port");
          
   }
     }else{
         
      $msg2="TURNED OFF.";
      exec("MODE $port 9600, N, 8,1");
      exec("cls>$port");
      exec("echo $msg2>$port");
          
     }   
}


if(isset($_REQUEST['reload']) && ($_REQUEST['reload']=='loadopen'))
{
   header("Location:index.php");  
}

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
  
	        $sql_desg_nos11="select be_reportemail_list,be_sms_list from tbl_branchmaster";
                $sql_desg11  =  $database->mysqlQuery($sql_desg_nos11);
				$num_desg11  = $database->mysqlNumRows($sql_desg11);
			         $i=1;$mail_lst="";$sms_lst="";
				if($num_desg11){
				while($result_desg11  = $database->mysqlFetchArray($sql_desg11)) 
					{
						
						$mail_lst=$result_desg11['be_reportemail_list'];
						$sms_lst=$result_desg11['be_sms_list'];
					} ?>
                

 <input type="hidden" name="chkmail" id="chkmail" value="<?=$mail_lst?>" />
 
 <input type="hidden" name="chksms" id="chksms" value="<?=$sms_lst?>" />

 <input type="hidden"  id="archieve_onoff" value="<?=$_SESSION['archive_enabled']?>" >

 <input type="hidden" id="cloud_sync_onoff" value="<?=$_SESSION['cloud_enable_sync']?>" >
 
 <input type="hidden" id="accounts_section" value="<?=$_SESSION['accounts_section']?>" >

 
<?php }

unset($_SESSION['floorid_ser']);

?>		

<!DOCTYPE HTML>
<html>
<head>

<title>Dashboard</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="css/table_new.css">
    <link rel="stylesheet" href="css/bootstrap-3.3.2.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles_drop.css" />
    <link rel="stylesheet" type="text/css" href="css/new-index.css" />
    <link id="main-css" href="css/accord/accordion.css" rel="stylesheet"/>
    <link id="main-css" href="css/accord/font-awesome.css" rel="stylesheet"/>
         
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/require_status_style.css">
    <link rel="stylesheet" href="css/responsive.css">
        
    <script src="js/jquery-1.10.2.min.js"></script> 
    <script type="text/javascript">
   
 $(function(){
     
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
     
     
    setTimeout(function(){ 
          
    ////delete log files all ////  
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
    
    
         ///lukado setup loop///
       
          // $.post("lukado.php", {set:'lukado_bill_loop_ta_hd_cs'},function(data){  });
           
         // $.post("lukado.php", {set:'lukado_bill_loop_dine'},function(data){  });
        
         ///lukado setup end///  
          
          
  
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
        
        
  if($('#inv_on').val()=='Y'){
      
    
      var url_check=$('#url_check').val();
   
      var new_id=url_check.split('login_type=');    
 
      if(new_id[1]=='new_login'){

      $('#inv_store_pop').show();

     }
               
 }
    
    
  
    if($('.shift_open_div').is(':visible')){
  
        $('.right_accord_menu_container').css('height','58.5vh');
  
    }else{
   
        $('.right_accord_menu_container').css('height','71.5vh');
   
    }
    
        localStorage.shiftlogintime=$('#shtime').val();
     
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
	
   $('.updatetimeopen').click(function () {
	
		$('.openoneclass').css('display','block');
		$('.closeoneclass').css('display','none');
		$('.confrmation_overlay').css('display','block');
		
    });
	
    $('.updatetimeclose').click(function () {
		$('.closeoneclass').css('display','block');
		$('.confrmation_overlay').css('display','block');
		    
    });
	
	
   $('.openok').click(function () {
            
               var single_shift=$('#single_shift').val();
            
		$('.openoneclass').css('display','none');
		$('.confrmation_overlay').css('display','none');
		
		$('.confrmation_overlay_proce').css('display','block');
		$('.confrmation_overlay_proce').html('<img src="img/ajax-loaders/ajax-loader.gif" />');
		
		var procedures_proc_daystart_inok=$('#procedures_proc_daystart_inok').val();
		var procedures_proc_daystart_error=$('#procedures_proc_daystart_error').val();
		var dataString;
		dataString = 'value=timeopen_first';
                $.ajax({
			  type: "POST",
			  url: "load_index.php",
			  data: dataString,
			  success: function(data) {
                            var dt=data.trim().split('{');
				  data=dt[0];
				 $('.confrmation_overlay_proce').css('display','none');
					  $('.index_popup_2').css('display','block');
					$('.confrmation_overlay').css('display','block');
					
					if(data=="Day-In successfull!")
					{
                                            
                                            
					$('.index_popup_contant span').html(procedures_proc_daystart_inok);
                                        
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
                                            
					$('.index_popup_contant span').html("TODAY'S SALE IS ALREADY CLOSED");	
                                        $('.revert_btn').show();
                                        
					}
					
                                        if(single_shift=='N'){
					 setInterval(test,5000);
                                     }
				  }
			  }); 
	
	});
	
	
	$('.opencancel').click(function () {
		$('.openoneclass').css('display','none');
		$('.confrmation_overlay').css('display','none');
	
	});
        
        
         $("#kotcancel_reason_popup_new_cancel_btn").click(function(){
                        $('#pin').val('');
			$('.confrmation_overlay').css('display','none');
			$(".kotcancel_reason_popup_new").css("display","none");
                        
	});
               
               
       $('#pin').keypress(function(ev){
     
            if(ev.keyCode == 13){
                ev.stopImmediatePropagation();
                $('#kotcancel_reason_popup_new_proceed_btn').trigger('click');
       }});
   
   
	
       $('.closeok').click(function () {
           
             var dayclose_auth = $("#hiddayclose_authorise").val();

             var dayclose_auth_code = $("#hiddayclose_authorise_code").val();
                          
             if(dayclose_auth == "Y"){
                 if(dayclose_auth_code == "Y"){
                    $('.confrmation_overlay_proce').css('display','none');
                    $('.index_popup_1').css('display','none');
                    $(".kotcancel_reason_popup_new").css("display","block");
                    $('#pin').focus();
                }
                else
                { 
                     $('#hdnkotcancel_reason_popup_new_proceed_btn').trigger('click');
             }
         }else{
                 
               $('#hdnkotcancel_reason_popup_new_proceed_btn').trigger('click');
             }
           
    });
        
        
        
    $('#kotcancel_reason_popup_new_proceed_btn').click(function () { 
        
         var dayclose_auth = $("#hiddayclose_authorise").val();
           
            if(dayclose_auth == "Y"){
                //--------------------
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
                        
                        $('#hdnkotcancel_reason_popup_new_proceed_btn').trigger('click');
                        
                        
            }else{
                 $("#pin_error").css("display","block");
			$("#pin_error").text(" NO PERMISSION ");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").val('');
                $('#pin').focus();
            }
                    }else{
                       
                        $("#pin_error").css("display","block");
			$("#pin_error").text("CODE NOT REGISTERED!");
			$("#pin_error").delay(2000).fadeOut('slow');
                        $("#pin").val('');
                        $('#pin').focus();
                    }
                });
            }else{
                $("#pin_error").css("display","block");
                $("#pin_error").text("ENTER PIN");
		$("#pin_error").delay(2000).fadeOut('slow');
                        $('#pin').focus();
            }
                
            }
              
        });
        
        jQuery('#pin').keyup(function (e) { 
            this.value = this.value.replace(/[^0-9\.]/g,'');
            if(!Number(this.value)||($(this).val().length <4)){
                
                    $('#pin_error').css("display",'block');
                    $('#pin_error').text('CODE NOT REGISTERED');
                    $('#pin_error').delay(2000).fadeOut('slow');
               
               
            }
        });
        
        
        
        
  /////real daycloseclick popup code///
  
  $('#hdnkotcancel_reason_popup_new_proceed_btn').click(function () {
      
         
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
                      
                $(".kotcancel_reason_popup_new").css("display","none");
		$('.closeoneclass').css('display','none');
		$('.index_popup_1').css('display','none');
		$('.confrmation_overlay').css('display','none');
		$('.confrmation_overlay_proce').css('display','block');
                $('.dayclose_waitting_popup').css('display','block');
                
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
                                       
                                         $('#dayclose_printer_alert').css('display','block');
                                       
                                         $('#dayclose_printer_alert').css('font-weight','bold');
                                         
                                         $('#dayclose_printer_alert').css('color','darkred');
                                         
                                         $('#dayclose_printer_alert').text('DATABASE  BACKUP IS RUNNING . PLEASE DONT CLOSE ');
                                       
                                         var data2="set_backup=backup_dayclose&db_select=DATABASE_NAME_REPORT";
                                  
                                        $.ajax({
                                        type: "POST",
                                        url: "export/export.php",
                                        data:data2,
                                        success: function(data22)
                                        {
                                            
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
                                              
                                           $('#dayclose_printer_alert').css('display','block');
                                           $('#dayclose_printer_alert').text(data_printercheck)
                                           
                                           setTimeout(function(){
                                                
                                           $('#dayclose_printer_alert').css('display','none'); 
                                       
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
                                                                        
                                                                    $('#dayclose_printer_alert').css('display','block');
                                                                    $('#dayclose_printer_alert').text(data2[1]);
                                                                    
                                                                    setTimeout(function(){
                                                                        
                                                                     $('#dayclose_printer_alert').css('display','none'); 
                                                                    
                                                                    },12000);
                                                                
                                                                    }
                                                      });   
                                                      
                                                      

                                                      /////invmtory store stock keeping ////
                                                      
                                                      if($('#inv_on').val()=='Y'){
                                                          
                                                      $.post("load_index.php", {set:'inv_store_stock_daily'},
                                                      function(data22)
                                                      { 
                                                                   
                                                                    $('#dayclose_printer_alert_inv').css('display','block');
                                                                    
                                                                    $('#dayclose_printer_alert_inv').text('DAILY INVENTORY STOCK SYNCING');
                                                                    
                                                                    setTimeout(function(){
                                                                        
                                                                    $('#dayclose_printer_alert_inv').css('display','none'); }, 9000);
                                                            
                                                                   });    
                                                     }
                                                     
                                            
                                            
                            if(smslist!=''){   

                            $.post("dayclose_sms.php", {type:"summary",hidfr:from,hidto:to,list:smslist},
                            function(data1)
                            { 


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
                            
                            
     //day cloud archive  checks////
      
     var cloud_sync_onoff=$('#cloud_sync_onoff').val();
 
     var archieve_onoff=$('#archieve_onoff').val();
    
     if(cloud_sync_onoff=='Y'){
        //$.post("test2.php", {set:'test_api_service'},function(data){  });   
     }
   
     if(archieve_onoff=='Y'){
        //$.post("test2.php", {set:'test_api_archive'},function(data){  });
     }
     
     //////checks end ///////        
                            
                            

                     var single_shift=$('#single_shift').val();
                     
                     if(single_shift=='N'){
                         
			  setTimeout(function(){
                               
                             window.location.href='index.php';
                           
		         }, 30000);
                                        
                     }else{
                                        
                                        setTimeout(function() {
                                            
                                             $('.confrmation_overlay_proce').css('display','block');
                                             $('.petty_cash_denomination_popup').show();
                                             
                                             $('.petty-popup-close').hide();
                                             
                                         }, 10000);
                                         
                     }
			
                        
                         }
                         });   
                        
                        
                 ////all dayclose functions end //       
                        
                        
				  }else
				  {       
					  $('.confrmation_overlay_proce').css('display','none');
					  $('.index_popup_2').css('display','block');
					  $('.index_popup_1').css('display','none');
					  $('.confrmation_overlay').css('display','block');
					  $('.okbutnew').css('display','block');
					  $('.index_popup_contant span').html(data);
				  }
					  
	    }
	    });
                      
                            }
                            else{
                           
                               
                                
                            if($.trim(data)=='Day Closed Already'){
                                
                                alert("Already dayclosed or User logged Out");
                                
                                window.location.href='logout.php';
                                
                            }else{
                                
                                  // alert($.trim(data));
                                 
                $(".kotcancel_reason_popup_new").css("display","none");
		$('.closeoneclass').css('display','none');
		$('.index_popup_1').css('display','none');
		$('.confrmation_overlay').css('display','none');
                                 
                $('.confrmation_overlay_proce').css('display','block');
                $('.dayclose_waitting_popup').css('display','block');
                                 
                                 
                                         $('#dayclose_printer_alert').css('display','block');
                                       
                                         $('#dayclose_printer_alert').css('font-weight','bold');
                                         
                                         $('#dayclose_printer_alert').css('color','darkred');
                                         
                                       $('#dayclose_printer_alert').text($.trim(data));
                                       
                                     setTimeout(function(){
                                                                        
                                    window.location.href='index.php'; 
                                 
                                 }, 2500);
                                 
                              }
                                
                            }
            }
            });
});
        
        
        
        
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
        
        
    $('.calculator_settle_back').click( function(event) {
            var str =$('#pin').val();
            str = str.substring(0, str.length - 1);
            $('#pin').val(str);
            input.innerHTML=$('#pin').val();
            $('#pin').focus();
     });
       
        //number pad end
	
	$('.closecancel').click(function () {
		$('.closeoneclass').css('display','none');
		$('.confrmation_overlay').css('display','none');
	
	});
	
	
	$('.successmessage').click(function () {
		$('.index_popup_2').css('display','none');
		$('.confrmation_overlay').css('display','none');
		
	setInterval(test,18000);
        
	});
	


});


function test()
{
   window.location="index.php";
}

 
       
</script>
    <style>/*body{overflow:auto !important}*/  .index_popup_2{z-index:9999999999 !important}.navbar-default .manage {display: none;}
</style>   
</head>

<body>
    
      <?php
                  
        $localIP = getHostByName(getHostName());     
        
      ?>  
    
    
    <input type="hidden" value="<?=$localIP?>" id="local_ip" >
    
    <input type="hidden" value="<?=$_SESSION['s_daily_stock_concept']?>" id="stock_onoff" >
    
      <input type="hidden" value="<?=$_SESSION['date']?>" id="date_today_acc" >
    
     <input type="hidden" value="<?=$_SESSION['s_single_shift']?>" id="single_shift" >
     
     <input type="hidden" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" id="url_check" >
    
   <div id="container">
     
	  <?php include "includes/topbar.php"; ?>
     
   </div> 
  <div style="width:100%;border-bottom: 2px rgba(255, 255, 255, 0.17) solid;" class="top_site_map_cc"><div class="billgeneration_head"><?//=$_SESSION['home_dashboard']?> COMMON SECTION</div></div>
  
  <div class="new_main_page_container">
  		<div class="main_page_left_contant">
        <?php if(in_array("dinein", $_SESSION['menuarray'])) { ?>
        	<div style="margin-top:0;display: none" class="main_page_left_cc_first" >
            	<div class="main_page_left_head"><span style="left: 4px;"><?=$_SESSION['home_headdinein']?></span></div>
                <div class="left_menu_scr_cc">
               
               <?php if(in_array("table_selection", $_SESSION['menuarray'])) { ?>  
                <a title="<?=$_SESSION['home_order']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> table_selection.php <?php }else {  ?>index.php?msg=1;<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/01-order-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_order']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                <?php if(in_array("kot_checklist", $_SESSION['menuarray'])) { ?> 
                 <a title="<?=$_SESSION['home_kot']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> kot_checklist.php <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/kot-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_kot']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
               
               <?php if((in_array("Completed Order", $_SESSION['menumodarray']))){ ?>  
                <a style="display:none" title="<?=$_SESSION['home_generatebill']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> completed_order.php <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/generate-bill-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_generatebill']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                <?php if(in_array("Payment Pending", $_SESSION['menumodarray'])){ ?>
                <a style="display:none"  title="<?=$_SESSION['home_settlebill']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>payment_pending.php  <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/settle-bill-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_settlebill']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                <?php if(in_array('bill_history', $_SESSION['menufullarray'])) { ?>
                <a title="<?=$_SESSION['home_billhistory']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>bill_history.php  <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/bill-history-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_billhistory']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                <?php if(in_array("kot_history", $_SESSION['menuarray'])) { ?> 
                <a style="display:none" title="<?=$_SESSION['home_kothistory']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>kot_history.php  <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/kot-history-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_kothistory']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
               </div><!--left_menu_scr_cc--> 
               
            </div><!---main_page_left_cc_first--->
            <?php } ?>
            
            <?php if(in_array("take_away_", $_SESSION['menuarray'])) { ?>
            <div class="main_page_left_cc_first" style="display:none">
            	<div class="main_page_left_head"><span style="left:-4px;"><?=$_SESSION['home_headtakeaway']?></span></div>
                <div class="left_menu_scr_cc">
                
                <?php if(in_array("take_away_", $_SESSION['menuarray'])) { ?>
                <a title="<?=$_SESSION['home_order']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> take_away_.php <?php }else {  ?>index.php?msg=1;<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/take-order-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_order']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                <?php if(in_array("take_away_kot", $_SESSION['menusubarray']) && $_SESSION['kotbypass_ta_in']=='Y') { ?>
                 <a title="<?=$_SESSION['home_kot']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> take_away_kot.php <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/kot-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_kot']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                 <?php if(in_array("payments_takeaway", $_SESSION['menusubarray'])) { ?>
                <a  title="<?=$_SESSION['home_settlebill']?>"  <?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>  onclick="settlepopupcommonta();" <?php } ?>><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/settle-bill-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_settlebill']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                <?php if(in_array("ta_bill_history", $_SESSION['menusubarray'])) { ?>
                <a title="<?=$_SESSION['home_billhistory']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> ta_bill_history.php <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/bill-history-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_billhistory']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                                
               
                
                <?php if(in_array("ta_customer_history", $_SESSION['menusubarray'])) { ?>
                 <a style="display:none" title="<?=$_SESSION['home_custtrack']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> ta_customer_history.php <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/customer-track-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_custtrack']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                <?php if(in_array("take_away_list", $_SESSION['menusubarray'])) { ?>
                <a title="<?=$_SESSION['home_hdstaffassign']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> take_away_list.php <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/staff-assign-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_hdstaffassign']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                <?php if(in_array("staff_assign_detail", $_SESSION['menusubarray']) &&  $_SESSION['staff_assign_bypass_hd']=='N'){ ?>
                <a title="<?=$_SESSION['home_hdstaffsettle']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> staff_assign_detail.php <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/staff-settle-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_hdstaffsettle']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                <?php if(in_array("kot_history", $_SESSION['menuarray'])) { ?> 
                <a style="display:none" title="<?=$_SESSION['home_kothistory']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>kot_tahd_history.php  <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/kot-history-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_kothistory']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                 
                
               </div><!--left_menu_scr_cc--> 
                
            </div><!---main_page_left_cc_first--->
            <?php } ?>
             <?php if(in_array("counter_sales", $_SESSION['menuarray'])) { ?>
            <div class="main_page_left_cc_first" style="display:none">
            	<div class="main_page_left_head"><span style="left: -4px;"><?=$_SESSION['home_headcounter']?></span></div>
                <div class="left_menu_scr_cc">
                
                <a title="<?=$_SESSION['home_order']?>" href="counter_sales.php"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/counter-sale-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_order']?></div>
                </div></a><!--main_page_icons_cc-->
                
                <?php if(in_array("counter_sale_kot", $_SESSION['menusubarray'])) { ?>
                <a style="display:none" title="<?=$_SESSION['home_kot']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> counter_sale_kot.php <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/kot-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_kot']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                
                <?php if(in_array("payments_ta_cs", $_SESSION['menusubarray'])) { ?>
                 <a  title="<?=$_SESSION['home_settlebill']?>" <?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> onclick="settlepopupcommoncs();"  <?php } ?>><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/settle-bill-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_settlebill']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
               
               <?php if(in_array("cs_bill_history", $_SESSION['menusubarray'])) { ?> 
                <a  title="<?=$_SESSION['home_billhistory']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> cs_bill_history.php <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/bill-history-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_billhistory']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                <?php if(in_array("kot_history", $_SESSION['menuarray'])) { ?> 
                <a style="display:none" title="<?=$_SESSION['home_kothistory']?>" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>kot_cs_history.php  <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/kot-history-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_kothistory']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                </div><!--left_menu_scr_cc-->
                
            </div><!---main_page_left_cc_first--->
            <?php } ?>
            
            <?php //if(in_array("admin_home", $_SESSION['menuarray'])) { ?>
            
            <div class="main_page_left_cc_first" style="    min-height: 140px;margin-top: 190px">
                
            	<div class="main_page_left_head"><span style="left: 4px;"><?=$_SESSION['home_headsettings']?></span></div>
                 <div class="left_menu_scr_cc">
                
                <?php if(in_array("General Branch settings", $_SESSION['menumodarray'])) { ?> 
                <a title="<?=$_SESSION['home_gensettings']?>" href="branch_settings.php?from=direct"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/general-setting-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_gensettings']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?> 
                
                <?php if(in_array("Menu Masters", $_SESSION['menumodarray']) && (in_array("menu", $_SESSION['menusubarray']))) { ?> 	
                <a title="<?=$_SESSION['home_menumaster']?>" href="menu.php"><div class="main_page_icons_cc">
                    <div class="main_page_icon_img"><img src="images/menu-master-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_menumaster']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?> 
                
                <?php if(in_array("Reports", $_SESSION['menumodarray']) ) { ?> 
                <a title="<?=$_SESSION['home_reports']?>" href="consolidatedreport.php"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/report-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_reports']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
               
                 
                 <?php if(in_array('printer_master', $_SESSION['menufullarray'])) { ?>
                <a title="<?=$_SESSION['printer_master']?>" href="printer_master.php"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/print-master-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['printer_master1']?></div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                <?php if(in_array("Stock Master", $_SESSION['menumodarray'])) { ?> 	
                <a style="display:none" title="" class="" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> stock_master.php <?php }else {  ?> index.php?msg=1; <?php } ?>" > <div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/stock-index-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['stock1']?></div>
                </div></a><!--main_page_icons_cc-->
                
                 <?php } ?>
                
                
                <?php if(in_array("total_ta_bill_history", $_SESSION['menusubarray'])) { ?>
                <a  title="ALL MODULES BILL HISTORY" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?> total_ta_bill_history.php <?php }else {  ?>#<?php } ?>"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/live-track-ico.png"></div>
                    <div class="main_page_icon_head"><?php //echo $_SESSION['home_livetrack']?>CONSOLIDATED BILL HISTORY</div>
                </div></a><!--main_page_icons_cc-->
                <?php } ?>
                
                
                <a style="display:none" title="" class="" href="customer_display/Customer_display.php?mode=expodine"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/staff-settle-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['cus_1']?></div>
                </div></a>
                
                 
                <?php 
                    
                if($_SESSION['s_inventory_staff_add']=='Y'){ ?>
                    
                     <input type="hidden" value="Y" id="inv_on">
                     
                     
                     <?php
                     
                    if(in_array("inventory", $_SESSION['menuarray'])) {  
                         
                    ?>
               
                <a title="<?=$_SESSION['home_inventory']?>" class="" href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>  inventory/index.php <?php }else {  ?> index.php?msg=1; <?php } ?>" ><div class="main_page_icons_cc">
                          <div class="main_page_icon_img"><img src="images/inventory-ico.png"></div>
                    <div class="main_page_icon_head"><?=$_SESSION['home_inventory'] ?></div>
                </div></a>
                
                     
                <?php } }else{ ?> 
                
                 <input type="hidden" value="N" id="inv_on">
                
                <?php } ?>
                
                
  <?php   
  
 $online_on='N'; $qr_db=''; $db_urban='';
                
 $sql_desg_nos1="select be_online_order_enable,be_qrcode_db ,be_store_db from tbl_branchmaster   ";
 $sql_desg1  =  $database->mysqlQuery($sql_desg_nos1);
 $num_desg1  = $database->mysqlNumRows($sql_desg1);
 if($num_desg1){
 while($result_desg1  = $database->mysqlFetchArray($sql_desg1)) 
 {
        $online_on	=$result_desg1['be_online_order_enable'];
        $qr_db=$result_desg1['be_qrcode_db'];
        $db_urban=$result_desg1['be_store_db'];      
             
 }}



if($online_on=='Y' && $_SESSION['staff_online_order_permission']=='Y'){ ?>

                <?php if($db_urban!=''){ ?>
                
                <a onclick="go_urban();" style="display:block" title="" class="" href="#"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/urban.png"></div>
                    <div class="main_page_icon_head">ONLINE ORDERS</div>
                </div></a>
                        
                <?php } ?>           
                        
                <?php if($qr_db!=''){ ?>
                <a onclick="go_qr();" style="display:block" title="" class="" href="#"><div class="main_page_icons_cc">
                	<div class="main_page_icon_img"><img src="images/generate-bill-ico.png"></div>
                    <div class="main_page_icon_head">QR ORDERS</div>
                </div></a>
                
                <?php } } ?>   
           
                </div>
                
            </div>
         
            
        </div><!--main_page_left_contant-->
        
        
        <div class="main_page_right_contant">
            
            <?php
           
           
             $sql_loginst  =  $database->mysqlQuery("select ts.ser_shift_permission,ts.ser_dayclose_permission,tl.ls_staffid from tbl_logindetails tl left join tbl_staffmaster ts  on ts.ser_staffid=tl.ls_staffid where  ts.ser_employeestatus='Active' and tl.ls_username='".$_SESSION['expodine_id']."'"); 
            
             $num_loginst   = $database->mysqlNumRows($sql_loginst);
                if($num_loginst){
                    while($result_loginst  = $database->mysqlFetchArray($sql_loginst)) 
                      {
                        $shiftview=$result_loginst['ser_shift_permission'];
                        $dayopenview=$result_loginst['ser_dayclose_permission'];
                        $expoid=$result_loginst['ls_staffid'];
                       
                    }
                    }
            
          
            
            ?>
            <input type="hidden" id="expoid" value="<?=$expoid?>">
            <input type="hidden" id="be_db_archive_api" value="<?=$_SESSION['be_db_archive_api']?>"> 
            
            <input type="hidden" id="be_inv_stock_api" value="<?=$_SESSION['be_inv_stock_api']?>"> 
            
            <div class="right_day_open_cc">
            <div class="right_day_open_head" style="display: none;position: relative "><?=$_SESSION['home_day_open']?>
                
         
            <?php 
            
                 $localhost_chk=mysqli_connect('localhost', USER_NAME, PASSWORD,DATABASE_NAME);
                 $sql_gen_db =  mysqli_query($localhost_chk,"select be_saudi_format from tbl_branchmaster"); 
       
		  $num_gen_db  = mysqli_num_rows($sql_gen_db);
		  if($num_gen_db)
		  { 
                       
            ?>
                
         <span <?php if($_SESSION['expodine_id']=='admin' || $_SESSION['expodine_id']=='Manager'){ ?> onclick="set_app_ip_cloud()" <?php }else{ ?> title="ONLY ADMIN AND MANAGER LOGIN CAN CHANGE SERVER IP "  <?php } ?>    
         style="font-size: 11px;right: -24px;position: relative;border: solid 1px;padding-bottom: 2px;border-radius: 3px;padding: 3px;cursor: pointer">
         <i style="width:15px" class="fa fa-scribd"></i>
         </span>
         
        <?php }  ?>
           
        
                
                </div>
                <div class="right_day_open_contant" style="display:none">
                    
                	<div class="right_day_open_textbox_cc">
                    	<div class="right_day_open_textbox_text"><?=$_SESSION['home_open_date']?></div>
                        <input class="right_day_open_textbox_textbox" name="date" readonly type="text" value="<?php if(isset($_SESSION['dateopen']) && !isset($_SESSION['timeclose'])) echo $_SESSION['dateopen']; ?>">
                        </div>
                    
                    <div class="right_day_open_textbox_cc">
                    	<div class="right_day_open_textbox_text"><?=$_SESSION['home_open_time']?></div>
                        <input class="right_day_open_textbox_textbox" name="date" readonly type="text"  value="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])) echo date('h:i:s a', strtotime($_SESSION['timeopen']));?>">
                    </div>
                    
                    <?php if(!isset($_SESSION['timeopen']) && (in_array("Day In View", $_SESSION['menumodarray']))) { ?>
                    <a  class="day_start updatetimeopen" href="#"><div class="day_close_btn_new"><?=$_SESSION['home_open_t']?></div></a>
                    <?php } ?>
                    
                    <?php if(!isset($_SESSION['timeclose']) && isset($_SESSION['timeopen'])  && (in_array("Day Close View", $_SESSION['menumodarray']))) { ?>
                    <a class="day_start updatetimeclose" href="#"><div class="day_close_btn_new"><?=$_SESSION['home_close_t']?></div></a>
                    <?php } ?>
                    
               </div>
            </div><!--right_day_open_cc-->
            
            
            <?php 
            
            
            if($shiftview=="Y" && $_SESSION['s_single_shift']=='N'){
            ?>
             <input type="hidden" name="decimal" id="decimal" value="<?= $_SESSION['be_decimal'] ?>">
            
            <div class="right_day_open_cc shift_open_div" style="display:none">
            	<div style="background-color: #0a4984;font-size: 13px;font-weight: bold" class="right_day_open_head"><?=$_SESSION['shift_lm']?> <?=$_SESSION['home_open_t']?> - <?=$_SESSION['home_close_t']?></div>
                <div class="right_day_open_contant" id="refshift">
                	<div class="right_day_open_textbox_cc" style="width:79%">
                    	<div  class="right_day_open_textbox_text"><?=$_SESSION['home_open_date']?> - <?=$_SESSION['home_open_time']?> 
                        
                            <a title="SHIFT HISTORY" href="shiftdetails.php"  style="float:right;margin-right: -50px;margin-top: -26px"><i class="fa fa-user-plus"></i><img style="display:none" src="img/user_per_mn_ico.png"></a>
                                   
                            
                            <?php
                            
                    $open_id_shft=$_SESSION['login_dayopen_staffid'];  
                    
                    $localIP = getHostByName(getHostName());     
        
                        if( $_SESSION['ser_force_close']=='Y'){ ?>  
                            
    <a title="SHIFT FORCE CLOSE" href="#" onclick="shift_force_close('<?=$open_id_shft?>','<?=$localIP?>','<?=$_SESSION['date']?>')"
    style="   
    float: right;
    margin-right: -13px;
    margin-top: -27px;
    padding: 1px;
    border-radius: 4px;"><i class="fa fa-times-circle"></i><img style="display:none" src="img/back_ico_1.png"></a>
                               
                         <?php  } ?>
                        
                        </div>
                        <input class="right_day_open_textbox_textbox dateshift" name="date" id="shtime" readonly="" type="text" value="<?=$_SESSION['shiftday']?>">
                    </div>
                    <?php if(!isset($_SESSION['shiftday'])){ ?>
                    <a class="shiftlog" href="#" onclick="return shiftopen();"  id="shiftbtn_open"><div style="background-color: #0a4984" class="day_close_btn_new"><?=$_SESSION['home_open_t']?></div></a>
                    <?php } ?>
                     <?php if(!isset($_SESSION['shiftclosetime']) && isset($_SESSION['shiftday'])){ ?>
                    <a class="shiftlog" href="#" onclick="return shiftclose();" id="shiftbtn_close" style="display:block"><div style="background-color: #0a4984" class="day_close_btn_new"><?=$_SESSION['home_close_t']?></div></a>
                <?php } ?>
                	</div>
            </div>
            
            <?php } ?>
            
            <div class="right_accord_menu_container">
            	
                <div id="accordion" class="accordion">
                <?php if(((in_array("kod_screen", $_SESSION['menuarray'])) || (in_array("packingcounter", $_SESSION['menuarray']))) && ($_SESSION['s_kod_takeaway']=='Y' || $_SESSION['s_kod_dinein']=='Y')) { ?>
				<div class="accordion-item active" style="display:none">
					<div class="accordion-header">
                    <i style="position: relative;top: -3px;" class="fa"><img src="images/right_orderdisplay_ico.png"></i>
						<?=$_SESSION['home_orderdisplay']?>
						<span class="accordion-item-arrow"></span>
					</div>
                                    
			<div class="accordion-content" style="display:none">
			<div class="right_menu_accord_cc">
                                                    
                        <?php if(in_array("kod_screen", $_SESSION['menuarray'])) { ?> 
                        	<?php if($_SESSION['s_kod_takeaway']=='Y' && $_SESSION['s_kod_dinein']=='Y') { ?> 
                                <a title="<?=$_SESSION['home_kodscreen']?>" <?php if(isset($_SESSION['date'])){ ?> href="kod_screen_two.php" <?php } ?>><div class="right_menu_accord_first">
                            	<div class="right_menu_accord_icon"><img src="images/kitchen-display-ico.png"></div>
                                <div class="right_menu_accord_text"><?=$_SESSION['home_kodscreen']?></div>
                            </div></a>
                            <?php }else if($_SESSION['s_kod_takeaway']=='Y' || $_SESSION['s_kod_dinein']=='Y') { ?> 
                            <a title="<?=$_SESSION['home_kodscreen']?>" <?php if(isset($_SESSION['date'])){ ?> href="kod_screen_two.php" <?php } ?>><div class="right_menu_accord_first">
                            	<div class="right_menu_accord_icon"><img src="images/kitchen-display-ico.png"></div>
                                <div class="right_menu_accord_text"><?=$_SESSION['home_kodscreen']?></div>
                            </div></a>
                            <?php } ?>
                            <?php } ?>
                            
                             <?php if(in_array("packingcounter", $_SESSION['menuarray'])) { ?>
                             	<?php if($_SESSION['s_kod_takeaway']=='Y' && $_SESSION['s_kod_dinein']=='Y') { ?> 
                            <a title="<?=$_SESSION['home_packingcounter']?>" <?php if(isset($_SESSION['date'])){ ?> href="packingcounter_two.php" <?php } ?>><div class="right_menu_accord_first">
                            	<div class="right_menu_accord_icon"><img src="images/packing-counter-ico.png"></div>
                                <div class="right_menu_accord_text"><?=$_SESSION['home_packingcounter']?></div>
                            </div></a>
                            <?php }else if($_SESSION['s_kod_takeaway']=='Y' || $_SESSION['s_kod_dinein']=='Y') { ?> 
                             <a title="<?=$_SESSION['home_packingcounter']?>" <?php if(isset($_SESSION['date'])){ ?> href="packingcounter.php" <?php } ?>><div class="right_menu_accord_first">
                            	<div class="right_menu_accord_icon"><img src="images/packing-counter-ico.png"></div>
                                <div class="right_menu_accord_text"><?=$_SESSION['home_packingcounter']?></div>
                            </div></a>
                             <?php } ?>
       						 <?php } ?>
        
                        </div><!--right_menu_accord_cc-->
					</div>
                </div>
               
                <?php } ?>

                     
                            

   <?php if(((in_array("kod_screen", $_SESSION['menuarray'])) || (in_array("packingcounter", $_SESSION['menuarray']))) && ($_SESSION['s_kod_takeaway']=='Y' || $_SESSION['s_kod_dinein']=='Y')) { ?>
              
                    
                     <?php if(in_array("kod_screen", $_SESSION['menuarray'])) { ?>  
                  
                    <div class="accordion-item-no-data">
                        
                   
                                    <a   title="<?=$_SESSION['home_kodscreen']?>" <?php if(isset($_SESSION['date'])){ ?> href="kod_screen_two.php" <?php } ?>  ><div class="accordion-header">
                                            <i style="position: relative;top: -3px;" class="fa"><img src="images/right_orderdisplay_ico.png"></i>
                                         <?=$_SESSION['home_kodscreen']?>
                                            
                                            
						<span class="arrow-right"></span>
					</div>
                                    </a>
			
				</div>
                               
                    <?php }else if($_SESSION['s_kod_takeaway']=='Y' || $_SESSION['s_kod_dinein']=='Y') { ?> 
                    
                      
                     <div class="accordion-item-no-data">
                                    <a title="<?=$_SESSION['home_kodscreen']?>" <?php if(isset($_SESSION['date'])){ ?> href="kod_screen_two.php" <?php } ?>   ><div class="accordion-header">
                                            <i style="position: relative;top: -3px;" class="fa"><img src="images/right_orderdisplay_ico.png"></i>
                                         <?=$_SESSION['home_kodscreen']?>
						<span class="arrow-right"></span>
					</div>
                                    </a>
			
				</div>
                    
                       <?php } ?>
                    
                    
                <?php if(in_array("packingcounter", $_SESSION['menuarray'])) { ?>
                    
                    	<?php if($_SESSION['s_kod_takeaway']=='Y' && $_SESSION['s_kod_dinein']=='Y') { ?> 
                <div class="accordion-item-no-data">
                                    <a title="<?=$_SESSION['home_packingcounter']?>" <?php if(isset($_SESSION['date'])){ ?> href="packingcounter_two.php" <?php } ?> ><div class="accordion-header">
                                            <i style="position: relative;top: -3px;" class="fa"><img src="img/packing_ico.png"></i>
                                            <?=$_SESSION['home_packingcounter']?>
						<span class="arrow-right"></span>
					</div>
                                    </a>
			
				</div>
                     
                      
                    <?php }else if($_SESSION['s_kod_takeaway']=='Y' || $_SESSION['s_kod_dinein']=='Y') { ?> 
                    
                    
                    <div class="accordion-item-no-data">
                                    <a title="<?=$_SESSION['home_packingcounter']?>" <?php if(isset($_SESSION['date'])){ ?> href="packingcounter.php" <?php } ?>><div class="accordion-header">
                                            <i style="position: relative;top: -3px;" class="fa"><img src="img/packing_ico.png"></i>
                                            <?=$_SESSION['home_packingcounter']?>
						<span class="arrow-right"></span>
					</div>
                                    </a>
			
				</div>
                    
                    
                     <?php } ?>
                    
                   <?php } ?>
                    
                    
                       <?php } ?>
                    
				<div class="accordion-item-no-data">
                                    <a title="Trouble shooting Page" href="troubleshoot.php"><div class="accordion-header">
                                            <i style="position: relative;top: -3px;" class="fa"><img src="img/user_per_mn_ico.png"></i>
						<?=$_SESSION['trouble_lm']?>
						<span class="arrow-right"></span>
					</div>
                                    </a>
					<!--<div class="accordion-content">
					</div>-->
				</div>
                    
                    <?php if(in_array("Total Analytics", $_SESSION['menumodarray'])) { ?>
				<div class="accordion-item-no-data">
					<a title="Today's <?=$_SESSION['home_analyticreport']?>" href="analytics.php"><div class="accordion-header">
                    <i style="position: relative;top: -3px;" class="fa"><img src="images/analytics_ico.png"></i>
						<?=$_SESSION['home_analyticreport']?>
						<span class="arrow-right"></span>
					</div></a>
					<!--<div class="accordion-content">
					</div>-->
				</div>
                <?php } ?>
                    
                    
                     <?php  if(in_array("CONSOLIDATED KOT HISTORY", $_SESSION['menumodarray']) ) { ?>  
                               <div class="accordion-item-no-data">
                                    <a title="All Module Kot History" href="cons_kot_history.php"><div class="accordion-header">
                                            <i style="position: relative;top: -3px;" class="fa"><img src="img/voucher_ico.png"></i>
						<?=$_SESSION['cons_kot_ar_eng']?>
						<span class="arrow-right"></span>
					</div>
                                    </a>
					<!--<div class="accordion-content">
					</div>-->
				</div>
                     <?php } ?>
                    
                    
                     <?php if(in_array("registration", $_SESSION['menuarray'])) { ?> 
				<div class="accordion-item-no-data">
                                    <a title="Loyalty programs and registration" href="loyalty/index.php"><div class="accordion-header">
                    <i style="position: relative;top: -3px;" class="fa"><img src="images/loyalty_icon.png"></i>
						<?=$_SESSION['home_loyalitypgm']?>
						<span class="arrow-right"></span>
					</div></a>
					<!--<div class="accordion-content">
					</div>-->
				</div>
                 <?php } ?>
                    
                  <?php  if($_SESSION['accounts_section']=='Y') { ?>  
				<div class="accordion-item-no-data">
					<a title="Accounts module" href="accounts/ledger.php"> <div class="accordion-header">
                    <i style="position: relative;top: -3px;" class="fa"><img src="images/voucher_ico.png"></i>
						<?=$_SESSION['ledger']?>
						<span class="arrow-right"></span>
					</div></a>
					<!--<div class="accordion-content">
					</div>-->
				</div>
                  <?php } ?>
                    
                    
                    <?php if(in_array("Credit Settlement", $_SESSION['menumodarray'])){ ?> 
				<div class="accordion-item-no-data">
					<a title="Credit management section"  href="<?php if(isset($_SESSION['timeopen']) && !isset($_SESSION['timeclose'])){ ?>credit.php  <?php }else {  ?>#<?php } ?>"><div class="accordion-header">
                    <i style="position: relative;top: -3px;" class="fa"><img src="images/credit_settle_ico.png"></i>
						<?=$_SESSION['home_creditsettlement']?>
						<span class="arrow-right"></span>
					</div></a>
					<!--<div class="accordion-content">
					</div>-->
				</div>
                <?php } ?>
                    
                     <?php if(in_array("advance", $_SESSION['menumodarray'])){ ?> 
                               <div class="accordion-item-no-data">
                                    <a title="Advance payment section" <?php if(isset($_SESSION['date'])){ ?> href="advance_pay_bill.php" <?php } ?> ><div class="accordion-header">
                                            <i style="position: relative;top: -3px;" class="fa"><img src="img/bill-icon.png"></i>
						<?=$_SESSION['advance']?>
						<span class="arrow-right"></span>
					</div>
                                    </a>
					<!--<div class="accordion-content">
					</div>-->
				</div>
                 <?php } ?>
               
                 
                 
                
                
                
                
                 <?php if(in_array("Banquet", $_SESSION['menumodarray']) && (in_array("banquet_list", $_SESSION['menusubarray']))) {?>
                <div class="accordion-item-no-data" style="display:none" >
					<a title="Banquet Hall Booking"  href="banquet_list.php"><div class="accordion-header">
                    <i style="position: relative;top: -3px;opacity:0.5" class="fa"><img width="27px" src="img/banquet-icon.png"></i>
						<?=$_SESSION['banquet_list']?>
						<span class="arrow-right"></span>
<!--                        <span class="ind_banq_count">2</span>-->
					</div></a>
					<!--<div class="accordion-content">
					</div>-->
				</div>
                  <?php } ?>
                    
                    
                    
                    
                     <?php if(in_array('game_station', $_SESSION['menufullarray'])) { ?>
                    
                    <div class="accordion-item-no-data" style="display:none">
					<a onclick="return game_login();" title="Gaming Module "  href="#"><div class="accordion-header">
                    <i style="position: relative;top: -3px;opacity:0.5" class="fa"><img width="27px" src="img/floors_icon.png"></i>
						<?=$_SESSION['game_1']?>
						<span class="arrow-right"></span>
<!--                        <span class="ind_banq_count">2</span>-->
					</div></a>
					<!--<div class="accordion-content">
					</div>-->
				</div>
                    
                      <?php } ?>
                    
                    
                    <div class="accordion-item-no-data" >
					<a  title="FAQ - Tutorial"  href="faq/"><div class="accordion-header" style="">
                       <i style="position: relative;top: -3px;opacity:0.5" class="fa"><img width="27px" src="img/faq_icon.png"></i>
						<?=$_SESSION['faq_ar_eng']?>
				<span class="arrow-right"></span>

				</div></a>
					
		   </div>
                    
                    
                    
                    <div class="accordion-item-no-data" >
					<a  title="Customer Token Display Module "  href="customer_display/Customer_display.php?mode=expodine"><div class="accordion-header">
                    <i style="position: relative;top: -3px;opacity:0.5" class="fa"><img width="27px" src="img/floors_icon.png"></i>
						<?=$_SESSION['cus_dis_ar_eng']?>
						<span class="arrow-right"></span>
<!--                        <span class="ind_banq_count">2</span>-->
					</div></a>
					<!--<div class="accordion-content">
					</div>-->
				</div>
                    
                    
			</div>
                
            </div><!---right_accord_menu_container-->
        </div><!--main_page_right_contant-->
              
        
  </div><!--new_main_page_container-->
<?php
$sql_login  =  $database->mysqlQuery("Select pv_current_version From tbl_version"); 
$num_login   = $database->mysqlNumRows($sql_login);
if($num_login)
{
  while($result_login  = $database->mysqlFetchArray($sql_login)) 
	  {
		   $_SESSION['version']=$result_login['pv_current_version'];
		  
	  }
}

?>  
<div style="width:100%;" class="top_site_map_cc">
	<div class="bottom_expo_version_cc"> VERSION <?=$_SESSION['version']?></div>
	<div class="billgeneration_head"><span  class="time_sp" id="time"></span></div>
        <div style="float:right;padding-right:5px;width: 185px;font-size: 11px" class="bottom_expo_version_cc">
            <a target="_blank" href="https://wa.me/+917994051951?text= Hi , Support Team. This is from <?=urlencode($_SESSION['s_branchname'])?> With Version <?=$_SESSION['version']?> . Please Contact on  <?=$_SESSION['fsaai']?> to resolve our issue or reply to this message.  " >  <i class="fa fa-whatsapp ">&nbsp;</i> </a> 
            <i class="fa fa-phone-square"></i> SUPPORT : +91 7994051951  </div>
</div>  

<!----start popups----->
<div class="confrmation_overlay"></div>

<div style="" class="index_popup_1 closeoneclass">
 	<div class="index_popup_contant">Are you Sure you Want to Add Day close</div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="closeok">Ok</a></div>
        <div class="btn_index_popup"><a href="#" class="closecancel">Cancel</a></div>
    </div>
 </div>


<!----popup end----> 

<div style="display:none" class="index_popup_1 openoneclass">
 	<div class="index_popup_contant welocme_no"><?=$_SESSION['home_error_confirm_dayopen']?></div>
    <div class="index_popup_contant welocme_msg">
    	<div class="btn_index_popup"><a href="#" class="openok">Ok</a></div>
        <div class="btn_index_popup"><a href="#" class="opencancel">Cancel</a></div>
    </div>
 </div><!--index_popup_1-->
 
 <div style="display:none" class="index_popup_1 closeoneclass">
 	<div class="index_popup_contant"><?=$_SESSION['home_error_confirm_dayclose']?></div>
    <div class="index_popup_contant">
    	<div class="btn_index_popup"><a href="#" class="closeok">Ok</a></div>
        <div class="btn_index_popup"><a href="#" class="closecancel">Cancel</a></div>
    </div>
 </div>
 
 <div style="display:none;width: 430px !important;height:220px;border:solid 1px #ab2426" class="index_popup_2">
    <div class="index_popup_contant" style="height:auto;">
   		 <div class="green-skin popup_green_tick_tp"><i class="fa fa-check"></i></div>
        <span class="text_popup_n" style="font-size:23px"></span>
        
        <div style="margin-top:10px;height: 33px;line-height: 33px;display: inline-block !important" class="btn_index_popup daycloseok">
            <a href="index.php" class="pendingordersok">OK</a>
            
            
            
        </div>
        
        <div style="margin-top:10px;height: 33px;line-height: 33px;display: none !important;background-color: #628362" class="btn_index_popup revert_btn">
           
            <a  href="troubleshoot.php?load_revert=revert_ok" class="pendingordersok">REVERT</a>
            
        </div>
        
        
    </div>
 </div><!--index_popup_2-->
 
 
 
 
 
 
 <div style="display:none;height: auto;bottom: auto;top: 30%;width:500px;" class="index_popup_otp closeoneclass3">
 	<div class="index_popup_contant textcontent"><h3 class="sm_pop_head">Cancellation
    <div style="width: 35%;height: 30px;float: right;"><span style="color:#F00;font-size:15px; text-align:center !important;display:none" id="deatilserror"></span></div>
    </h3></div>
    	
    <div class="index_popup_contant contenttext" style="display:inline-block;margin-left:10%;text-align:left;width:100%;height:auto">
    	<!--<span style="line-height: 60px;">Reason</span><div style="background-color: #fff !important;width: 60%;height:auto" class="btn_index_popup"><input type="text" class="popup_conform_his" style="margin-left:12%;" name="reasontext" id="reasontext"></div><br>-->
        <span style="line-height: 40px; width: 26%;float: left;margin-top:5px;">Staff name</span><div style="background-color: #fff !important;width: 60%;height:auto;" class="btn_index_popup" >
         <select style="margin-top:5px;float: left;width: 51%;" class="popup_conform_his"  id="stafflist" name="stafflist" >
           <option value="null" default><?=$_SESSION['table_selection_selectstaff']?></option>
           <?php
               $sql_login  =  $database->mysqlQuery("select * from tbl_staffmaster WHERE ser_cancelpermission='Y'  AND  ser_employeestatus='Active'"); 
                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login){
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
                      {
                      ?>
          <option class="popup_conform_his" value="<?=$result_login['ser_staffid']?>" cancelkey="<?=$result_login['ser_cancelwithkey']?>"><?=$result_login['ser_firstname']?></option>
         <?php } } ?>	
          </select>
          <div style="margin-top: 5px !important;" class="btn_index_popup_send otp_gent_btn"><a href="#" class="sendotp">Send OTP</a></div>
        
        </div><br>
        <span style="margin-top: 0;float: left;line-height: 40px;width: 26%;">Enter <span style="width:auto;float:none;" id="typeentery"> </span></span><div style="background-color: #fff !important;width: 60%;" class="btn_index_popup"><input class="popup_conform_his" style="float: left;" type="password" name="secretkey" id="secretkey"></div>
    </div>   
    <div class="index_popup_contant" style="margin-top:-6px;height: 40px;">
    	<div style="width: 95px;" class="btn_index_popup"><a href="#" class="closeok2">Submit</a></div>
        <div style="width: 95px;" class="btn_index_popup"><a href="#" class="closecancel2">Cancel</a></div>
    </div>      
 </div>
 
 <!-----------auth popup--------------->
 <div class="kotcancel_reason_popup_new" style="display:none" OnLoad="document.myform.mytextfield.focus();">
     <?php
      $sql_desg_nos1363="select be_game_active from tbl_branchmaster";
                                      
					$sql_desg1363  =  $database->mysqlQuery($sql_desg_nos1363);
					$num_desg1363  = $database->mysqlNumRows($sql_desg1363);
					if($num_desg1363){
					while($result_desg1363  = $database->mysqlFetchArray($sql_desg1363)) 
						{
                                           
                                            $gameactive1=$result_desg1363['be_game_active'];
                                                }
                                        }
                                        ?>
    <input type="hidden" name="focusedtext" id="focusedtext" />
    <div class="kotcancel_reason_popup_new_left_cc">
     <div class="kotcancel_reason_popup_new_head"><img style="margin-top:-16px" class="auth_head_ico" src="img/alert.png" /> Authorisation <span id="gameact" style="display:none"><?=$gameactive1?></span></div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    
    	<!--<div class="kotcancel_reason_popup_new_textbox_cc">
            <select class="kotcancel_reason_popup_new_textbox_input">
            	<option>Select Reason</option>
                <option>Reason 1</option>
            </select>
        </div>-->
        <div style="width: 100%;float: left;height: 10px;line-height: 0px;text-align: center"><span id="pin_error" style="color:red;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin" maxlength="4" autofocus="autofocus"/>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_cancel_btn">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_proceed_btn">Proceed</div></a>
        <input type="hidden" value="" id="hdnkotcancel_reason_popup_new_proceed_btn">
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
  		<div class="keys settle_key">
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
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div>

 <div class="dayclose_waitting_popup dot_blink" style="display:none">
     <div class="dayclose_waitting_popup_img">
     	<img src="img/alert.png">
     </div>
     Day Close In Progress<br>Please Wait <span>.</span><span>.</span><span>.</span>
     <div class="dayclose_printer_alert_popup" id="dayclose_printer_alert" style="display:none" >
        
    </div>
     
     <div class="dayclose_printer_alert_popup" id="dayclose_printer_alert_inv" style="display:none" >
        
    </div>
     
     <div class="dayclose_printer_alert_popup" id="dayclose_printer_alert_cloud" style="display:none" >
        
    </div>
     
 </div> 
 <!-----------auth popup--------------->

 
 <!-----------Petty cash popup--------------->
 
 	<div class="petty_cash_denomination_popup" style="display:none">
    	<div class="petty_cash_denomination_popup_head">Enter Cash Denomination
        	<a href="#"><div class="petty-popup-close"><img src="img/cancel-icon.png"></div></a>
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
             
            <input type="hidden" id="focusedtext" name="focusedtext"> 
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
 
 <!-----------Petty cash popup--------------->
  
  <input type="hidden" name="procedures_proc_daystart_inok" id="procedures_proc_daystart_inok" value="<?=$_SESSION['procedures_proc_daystart_inok']?>"  >
 <input type="hidden" name="procedures_proc_daystart_error" id="procedures_proc_daystart_error" value="<?=$_SESSION['procedures_proc_daystart_error']?>"  >


 <input type="hidden" name="hiddayend_closeok" id="hiddayend_closeok" value="<?=$_SESSION['procedures_proc_dayend_closeok']?>"  >
 <input type="hidden" name="hiddayend_error" id="hiddayend_error" value="<?=$_SESSION['procedures_proc_dayend_error']?>"  >

 <input type="hidden" name="hiddayopen" id="hiddayopen" value="<?=$_SESSION['home_error_confirm_dayopenmsg']?>"  >
 
  <input type="hidden" name="hiddayclose_authorise" id="hiddayclose_authorise" value="<?=$_SESSION['dayclose_authorise']?>"  >
  <input type="hidden" name="hiddayclose_authorise_code" id="hiddayclose_authorise_code" value="<?=$_SESSION['be_authorise_with_code']?>"  >

 <div style="display:none" class="confrmation_overlay"></div>
 <div style="display:none" class="confrmation_overlay_proce"></div>
 <div style="display:none" class="confrmation_inventory_overlay"></div>
 


<?php if(isset($_REQUEST['msg'])){ 
	if($_REQUEST['msg']==1) {
	?>
	<script type="text/ecmascript">
        $(document).ready(function() { 
        $(".index_popup_2").show();
        $(".index_popup_1").hide();
        $(".confrmation_overlay").show();
		var openmsg=$('#hiddayopen').val();//alert(openmsg)
        $('.index_popup_contant span').html(openmsg);
        });
        </script> 
	<?php }else { ?>
		<script type="text/ecmascript">
        $(document).ready(function() { 
        $(".index_popup_2").show();
        $(".index_popup_1").hide();
        $(".confrmation_overlay").show();
		var nopermsn=$('#hidnopermsn').val();
        $('.index_popup_contant span').html(nopermsn);
        });
        </script>
<?php }} ?>
 <style>
     .dayclose_printer_alert_popup{
             width: 100%;
    height: 100%;
    position: absolute;
    background-color: #fff;
    left: 0;
    top: 0;
    color: #f00;
    font-size: 18px;
    line-height: 31px;
    padding: 10px;
    padding-top: 50px;
    text-align: center;
    font-family: inherit;
    border-radius: 10px;
         
     }
 .petty_cash_right_cc .kotcancel_reason_popup_new_right_cc span:hover{background-color:#ab2426 !important;color:#fff}
   .dayclose_waitting_popup{
    width: 350px;
    height: 170px;
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

  .confrmation_inventory_overlay{
	width:100%;
	height:100%;
	position:fixed;
	z-index:999;
	background-color:rgba(0,0,0,0.8);
	top:0;
	text-align:center;
	line-height: 40;
        padding-top: 20%;
		}
.confrmation_inventory_overlay img{width:180px;height:180px;}

	.index_popup_otp{
	width:35%;
	height:270px;
	position:absolute;
	margin:auto;
	background-color:#fff;
	border-radius:5px;
	box-shadow:0 0 5px #ccc;
	right:0;
	left:0;
	top:0;
	bottom:0;
	z-index:99999999;
	overflow:hidden;
	}
.index_popup_contant{
	width:100%;
	height:30px;
	float:left;
	text-align:center;
	line-height:40px;
	font-size: 16px;
	}		
.btn_index_popup{
    width: 24%;
    display: inline-block;
    height: 34px;
    line-height: 34px;
    background-color: #FF2306;
    text-align: center;
    margin-right: 1%;
    border-radius: 5px;
    transition: all 0.2s ease;
	}
.btn_index_popup a{
	color:#fff !important;
	font-size:15px;	
	text-decoration:none;
	display:block;
	}		
.btn_index_popup:hover{background-color:#333;}	
.btn_index_popup a:hover{color:#fff;}

.btn_index_popup_send{
	width:15%;
	display:inline-block;
	height:25px;
	line-height:25px;
	background-color: #FF2306;
	text-align:center;
	margin-right:1%;
	border-radius:5px;
	transition:all 0.2s ease;
	display:none;
	margin-top: 38px;
    margin-left: 121px;
	}
.btn_index_popup_send a{
	color:#fff !important;
	font-size:15px;	
	text-decoration:none;
	display:none;
	}		
.btn_index_popup_send:hover{background-color:#333;}	
.btn_index_popup_send a:hover{color:#fff;}

.sm_pop_head{
	width:100%;
	height:30px;
	float:left;
	text-align: left;
	padding-left:20px;
	color: #000;
    background-color: #E4E4E4;
    line-height: 30px;
    border-bottom: 1px #ccc solid;
	font-size:19px;
	margin:0px;
	}
.contenttext{
	 font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    letter-spacing: 1px;
	  font-size: 14px;
    color: #000;
	}
.otp_gent_btn{
	     width: 45% !important;
    float: right;
     height: 32px !important;
    line-height: 31px !important;
    background-color: #FF2306;
    text-align: center !important;
    border-radius: 5px !important;
    transition: all 0.2s ease;
    display: none;
    margin-top: -4px !important;
    margin-left: 0px !important;
	}
.bill_his_back_btn{
	width:120px;
	height:30px;
	float:left;
	text-align:center;
	color:#fff;
	 font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	 font-size:14px;
	 line-height:30px;
	 margin-top:7px;
	 background-color:#F5351B;
	 border-radius:7px;
	 background-image:url(../img/arrow-bt.png);
	 background-position:10px 50%;
	 background-repeat:no-repeat;
	 padding-left:10px;
	}	
.bill_history_head{
	width:48%;
	height:40px;
	float:left;
	text-align:right;
	line-height:40px;
	color:#fff;
	 font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
	 font-weight:bold;
	 font-size:18px;
	}
.popup_conform_his {
    display: block;
    width: 100%;
    height: 33px;
    padding: 8px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555555;
    background-color: #ffffff;
    background-image: none;
    border: 1px solid #cccccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
    -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    border: 1px solid #C1C1C1;
    display: inline-block;
}	

	</style>

  
<script type="text/javascript" src="js/accordion.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="js/jquery.cookie.js"></script> 
<script type="text/ecmascript">
	$(document).ready(function() { 
	/*$(".day_start").click(function() {
		$(".index_popup_1").css("display","block");
		$(".confrmation_overlay").css("display","block");
	 });*/
	 $(".closecancel").click(function() {
		$(".index_popup_1").css("display","none");
		$(".confrmation_overlay").css("display","none");
	 });
});
 
</script>
<script type="text/javascript">
$(function() {     
	$( "#accordion" ).accordion({
		collapsible: true,
		active: false
	});
});
</script>
 <script>
    function set_app_ip_cloud(){
        
    var local_ip=$('#local_ip').val();  
        
     var cloud_sync_onoff=$('#cloud_sync_onoff').val();   
        
      if(cloud_sync_onoff=='Y'){  
        
        
    var confirm1=confirm(" WARNING : THIS SYSTEM IP ("+local_ip+") WILL BE SET AS SERVER IP FOR SOFTWARE & APP CONNECTIONS ?");
    
    if(confirm1===true){
        
        $('.confrmation_overlay_proce').css('display','block');
        
        $('.dayclose_waitting_popup').css('display','block');
        
        $('#dayclose_printer_alert_inv').css('display','block');
                                                                    
        
          $('#dayclose_printer_alert_inv').text('PLEASE WAIT');                                                                     
        
        
        var datastring ="set=set_app_ip_cloud";
        
                $.ajax({
                type: "POST",
                url: "load_index.php",
                data: datastring,
                success: function (data)
                {
                    $('#dayclose_printer_alert_inv').text("LOCAL SERVER IP CHANGED SUCCESFULLY. (IP : "+local_ip+")");   
                    
                      setTimeout(function(){
                          
                        $('.confrmation_overlay_proce').css('display','none');

                        $('.dayclose_waitting_popup').css('display','none');

                        location.reload();
                  
                     }, 3000);
                      
                    //alert('LOCAL SERVER IP CHANGED SUCCESFULLY');
                    
                }
                });
        }
        
        
      }else{
          $('.confrmation_overlay_proce').css('display','block');
        
        $('.dayclose_waitting_popup').css('display','block');
        
        $('#dayclose_printer_alert_inv').css('display','block');
           $('#dayclose_printer_alert_inv').text('CLOUD IS NOT ENABLED. PLEASE USE OFFLINE METHOD FOR APP CONNECTION');   
                    
                      setTimeout(function(){
                          
                        $('.confrmation_overlay_proce').css('display','none');

                        $('.dayclose_waitting_popup').css('display','none');

                        location.reload();
                  
                     }, 3500);
          
      }
          
    } 
     
     
     function shift_force_close(staff,ip,date){
      
      var shtime=$('#shtime').val();
      
      if(shtime!=''){
      
      var check = confirm("WARNING : FORCE CLOSE SHIFT?");
        if(check==true)
        {
            var datastring ="set=shift_force_close_direct&staff="+staff+"&ip="+ip;
            $.ajax({
                type: "POST",
                url: "load_index.php",
                data: datastring,
                success: function (data)
                {
                    
                    $.ajax({
                type: "POST",
                url: "print_details.php",
                data: "set=shift_detail&slno="+staff+"&date="+date,
               
                success: function(data)
                {
           
           
           
                }
                });
                    
                  location.reload();
                  
                  
                }
            });
        }
      
      
      
        }else{
            alert('NO SHIFT IS OPEN');
        }
    }
     
     
     
     
     
     
     function go_qr(){
         
        window.parent.location.href ="customer_display/qr_order_screen.php";
         
     }
     
     
         function go_urban(){
         
        window.parent.location.href ="customer_display/online_order_screen.php";
         
     }
     
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function startTime() {
	
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    
    
     var ampm = h >= 12 ? 'pm' : 'am';
  h = h % 12;
  h = h ? h : 12; 
  
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML = h + ":" + m + ":" + s + ' ' + ampm;
	
    t = setTimeout(function () {
        startTime();
    }, 500);
}
startTime();


function change_denom(){
    
     $('#focusedtext').val('change_denom');
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
     $('#focusedtext').val('card_denom'+i);
     
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



function settlepopupcommonta(){
   
     window.location.href = "take_away_.php?settacommon=settletapopup";

   }


function settlepopupcommoncs(){
  window.location.href = "counter_sales.php?setcscommon=settlecspopup";  
    
}


function shiftopen(){
    $( ".petty_cash_denomination_popup").css('display','block');
    $('.confrmation_overlay_proce').css('display','block');
  
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
    
     $('#focusedtext').val('text_denom'+t);
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

  $('.calculator_settle_sh').click( function(event) {
  
     
		event.stopImmediatePropagation();
                
		var focused=$('#focusedtext').val();
               //alert(focused);
		var calval=($(this).text());//alert(focused);alert(calval);
		
		var org=$('#'+focused).val();
                //alert(org.length);
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
        
        
        
   function isNumberKey1(evt)
       { 
          var charCode = (evt.which) ? evt.which : event.keyCode
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;
 
          return true;
       }     
        
  
  function pettyadd(){
       $('#focusedtext').val('pettybal');
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
                        
                        $('.alert_error_popup_all_in_one').css('font-size','10px' );
                        $('.alert_error_popup_all_in_one').text("YOUR SHIFT IS OPEN NOW");
                        $('.alert_error_popup_all_in_one').delay(4000).fadeOut('slow');
      
      
      
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
                        
         $('.alert_error_popup_all_in_one').css('font-size','10px' );
         $('.alert_error_popup_all_in_one').text('YOUR SHIFT IS CLOSED');
         $('.alert_error_popup_all_in_one').delay(6000).fadeOut('slow');
         
         
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
    
                        //alert('PLEASE CLOSE PENDING BILLS IN YOUR SHIFT ');
                        $('.petty_cash_denomination_popup').css('z-index','9999');
                        $('.alert_error_popup_all_in_one').show();
                        
                        $('.alert_error_popup_all_in_one').css('font-size','10px' );
                        $('.alert_error_popup_all_in_one').text($.trim(datash));
                        $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
    
    
    }
    
    
   }
    });
  
  
    }
  }
  
  
 function game_login(){
  
        var datarp3="setgame=gamelogin";
  
        $.ajax({
        type: "POST",
        url: "index.php",
        data: datarp3,
        success: function(data)
        {
       var data1=data.trim();
       var data2=data1.split('>');
       var data3=data2[1].split('<');
       var all=data3[0].split('*');
   
       if(all[0].trim()=='login_game'){
        
      window.open(all[1].trim()+'?game_login_userpin='+all[2].trim()+'&game_login_username='+all[3].trim(), '_blank');
       
      }else{
       $('.kotcancel_reason_popup_new').css('display','none');
          $('.confrmation_overlay_proce').css('display','none');
					  $('.index_popup_2').css('display','block');
					  $('.index_popup_1').css('display','none');
					  $('.confrmation_overlay').css('display','block');
					  $('.okbutnew').css('display','block');
					  $('.index_popup_contant span').html('No Permission For Game Station'); 
    }
      
    } 
    });
  }
  
  
  function inventory_click(link,s,c){
   
          
        if(link!=''){
        
           window.location.href=link+'/login?permission=expodine&user_exp='+s+'&passcode='+c;
            
         }else{
                                           $('.index_popup_2').css('display','block');
					  $('.index_popup_1').css('display','none');
					  $('.confrmation_overlay').css('display','block');
					  $('.okbutnew').css('display','block');
					  $('.index_popup_contant span').html('ADD Inventory Link To Connect'); 
       
      }
           
 }
  
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
  
  
</script>
<audio id="welcome_audio"><source src="welcome.ogg" type="audio/ogg"></audio>


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
      
    <div class="stok_add_popup_sec" style="display:none" id="inv_store_pop">    
    <div class="stok_add_popup">
        <div class="stok_add_popup_hd" style="" >  
            
            <i style="width: 15px;height: 25px;font-size: 29px " class="fa fa-warning"></i> 
            <span style="font-weight: bold;font-size: 24px;color: #d32b2b;"> &nbsp; &nbsp;  SELECT INVENTORY STORE</span> 
            
        <a style="display: none " href="#" onclick="$('#inv_store_pop').hide();"><div class="stok_add_popup_cls">
         <img width="100%" src="img/black_cross.png" alt=""></div></a>
        </div>
        <div class="stok_add_popup_cnt" id="cus_div" >
            
            
            
            <span style="font-size:15px;font-weight: bold;color: darkred"> Please confirm your inventory store ! </span> 
            
            
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



</body>
</html>
