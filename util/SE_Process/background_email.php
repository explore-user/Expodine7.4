<?php
error_reporting(0);
session_start();

include("..\..\src\database.class.php"); // DB Connection class
include('..\..\src\email\km_smtp_class.php');
 require_once('..\..\src\Mailer/PHPMailerAutoload.php');
$database	= new Database();
$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);

$sql_mailpermission  =  $database->mysqlQuery("select be_decimal,be_email_on_dayclose,be_branchid from tbl_branchmaster ");
//echo "select dc_dayclose_sms_success,dc_dayclose_sms_success from tbl_dayclose where dc_day between CURDATE( ) - INTERVAL 3 DAY AND CURDATE( )";
 $num_mailpermission  = $database->mysqlNumRows($sql_mailpermission);
if($num_mailpermission) {$j=0;
while($result_mailpermission  = mysqli_fetch_array($sql_mailpermission)) 
 {
    $dayclose_email_permission=$result_mailpermission['be_email_on_dayclose'];
    $branchid=$result_mailpermission['be_branchid'];
    $decimal=$result_mailpermission['be_decimal'];
 }
}
$sql_login  =  $database->mysqlQuery("select dc_dayclose_email_attempts,dc_day,dc_dayclose_email_success from tbl_dayclose where dc_dayclose_email_success='N'  and dc_dateclose is not NULL and dc_dayclose_email_attempts<5 and  dc_day between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ");
//echo "select dc_dayclose_email_attempts,dc_day,dc_dayclose_email_success from tbl_dayclose where dc_dayclose_email_success='N'  and dc_dateclose is not NULL and dc_dayclose_email_attempts<5 and  dc_day between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
 $num_login  = $database->mysqlNumRows($sql_login);
if($num_login) {$j=0;
while($result_login  = mysqli_fetch_array($sql_login)) 
 {
 $j++;
 //print_r( $output);
//print_r( $result);
 $dayclosedatemail=$result_login["dc_day"];
 $email_attemt=$result_login["dc_dayclose_email_attempts"]+1;
 //echo $dayclosedatemail;
 
 

   if($result_login["dc_dayclose_email_success"]=='N'&& $dayclose_email_permission =="Y"){
       //echo $dayclosedate;
       $a="8.8.8.8";
 exec("ping -n 1 -w 1 ".$a, $output, $result);
 if($result==0)
 {
     

$database	= new Database(); 	
$branchname='';
$sql_branch =  $database->mysqlQuery("Select be_branchname,be_address,be_email,be_phone,be_others1,be_others2,be_others3,be_footer1,be_footer2,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$branchid."'"); 
		  $num_branch  = $database->mysqlNumRows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = $database->mysqlFetchArray($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
                                                  
						
					}
		  }
   $taxname1=0;
   $taxname2=0;
   $taxname3=0;
                  $report="";
$reports = array();
$datedayclose=$dayclosedatemail;
//echo $dayclosedatemail;
if($datedayclose!="")
 {
     $sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster  where rm_dayclosemail='Y' ORDER BY rm_dayclose_print_order ASC "); 
    //echo "select * from tbl_reportmaster where rm_reportview='Y' and rm_printa4='Y' and rm_daycloseprint='Y' and rm_dayclose_print_order!='0' ORDER BY rm_dayclose_print_order ASC";
     $num_login   = $database->mysqlNumRows($sql_login);
     if($num_login){
        while($result_login  = $database->mysqlFetchArray($sql_login)) 
            { 
              $report.=$result_login['rm_reportid'].",";
              
            }
        }

$reportname=array();   
$report1=trim($report,',');
//echo $report1;
$reports=explode(",",$report1);
//echo $reports;
   //$reports=explode(",",$_REQUEST['type']);
   
  
   $ct=count($reports);
    $return="";

	
		if($dayclose_email_permission =="Y")
			{	
                                $sql_date=$database->mysqlQuery("Select * From tbl_dayclose  Where dc_day ='".$datedayclose."'");
            
            $num_date  = mysqli_num_rows($sql_date);
            if($num_date){	
                while($result_date  = mysqli_fetch_array($sql_date)){
                        $dayopendate= $result_date['dc_dateopen'];
                        $dayopentime= $result_date['dc_timeopen'];
                        $dayclosedate= $result_date['dc_dateclose'];
                        $dayclosetime= $result_date['dc_timeclose'];
                }
                }	
		$return.="Day Open :  ".$dayopendate."   ".$dayopentime."\r\n" ;
	        $return.="Day Close:  ".$dayclosedate."   ".$dayclosetime."\r\n";
                $return.="-----------------------------------------------------";
                    
                    
                    
                    
                    
	foreach ($reports as $val) {
		
	    $_SESSION['type']=$val;
		
		
	
if( $_SESSION['type']=="tot_sales")
{
		
		
		
   $reporthead="";
 
  
 
 $servicetax_stats='N';
	 $sql_login  =   $database->mysqlQuery("SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''" ); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
 ?> 
   
      <?php
  $string=" bm_status='Closed' AND ";
   
			
			$string.= "bm_dayclosedate='".$datedayclose."'";
			$reporthead.="on ".date('Y-m-d',strtotime($datedayclose));
				
				
			
				
				
	
		
			
		
		
		$return.="\r\n";
                $menulist= array(
                        new report_head("Dine In"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                
                $menulist= array(
                        new report_head("Total Sales Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
               
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                
	
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new menulist("Slno","Date","Billno", "Final"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
        $return.="\r\n";
    ?>

<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $i=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
                        
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			$dsc=$dsc + $result_login['bm_discountvalue'];
			$srvtx=$srvtx + $result_login['bm_servicetax'];
			if($result_login['bm_paymode']!=7){
                            $i++;
                            $subtotal=$subtotal + $result_login['bm_finaltotal'];
                           
			//$return.=$i.'    ';
			
			// $sl=strlen($i);
			 $sl=$i;
                         $menulist= array(
                                new menulist($i,$database->convert_date($result_login['bm_dayclosedate']),$result_login['bm_billno'], number_format($result_login['bm_finaltotal'],$decimal)),
                            );
                            foreach($menulist as $menulist) {
					$return .=($menulist);
                            }
                            $return.="\r\n";
			
			}
			}
                    }
                        $return.="----------------------------------------------------------------------";
                        $return.="\r\n";
                        $menulist= array(
                        new menulist("Bills-".$i,"FINAL","", number_format($subtotal,$decimal)),
                            );
                            foreach($menulist as $menulist) {
					$return .=($menulist);
                            }
                            $return.="\r\n";
			$return.="\r\n";
                        $return.="----------------------------------------------------------------------";

	}

else if( $_SESSION['type']=="summary_report_cr")
{
		

     
	$string="";
        $strings="";
        $stringtacshd="";
        $stringstacshd="";
	$reporthead="";
	$strings=" bm_status='Closed' AND ";
        $stringstacshd=" tab_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - (sum(bm_amountbalace) + sum(bm_roundoff_value))) ";
        $string1_strtacshd=" (sum(tab_amountpaid) - (sum(tab_amountbalace) + sum(tab_roundoff_value))) ";
        $string2_str=" sum(bm_transactionamount) ";
	$string3_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
        $string3_strtacshd=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string4_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
	$string5_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string6_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string7_str=" sum(bm_finaltotal)";
        $string7_strtacshd=" sum(tab_netamt) ";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND  ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
	//$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string1tacshd=$stringstacshd. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	
		
		
	$string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string2tacshd =$stringstacshd." pym_code='credit'  AND";
        $string3 =$strings. " pym_code='coupon'  AND";
        $string3tacshd =$stringstacshd. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";
        $string4tacshd =$stringstacshd. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string5tacshd =$stringstacshd. " pym_code='cheque' AND";
        $string6=$strings. " pym_code='credit_person' AND ";
        $string6tacshd=$stringstacshd. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
        $string7tacshd=$stringstacshd. " pym_code='complimentary' AND";
	
//	$string1 =$strings. " ";//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
//		$string2 =$strings. " ";//"credit"  bm_transactionamount <>''
//		$string3 =$strings. " bm_paymode='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
//		$string4 =$strings. " bm_paymode='voucher' AND";//"voucher" bm_voucherid <>''
//		$string5 =$strings. " bm_paymode='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
//	// $string=" bm_status='Closed' AND ";
//                $string7=$strings. " bm_paymode='complimentary' AND";
//	
			
			$string.= " bm_dayclosedate = '".$datedayclose."' ";
                        $string_pax.= "bm_dayclosedate ='".$datedayclose."'";
                        $stringtacshd.=" tab_dayclosedate ='".$datedayclose."'";
                        $reporthead="On ".date('Y-m-d',strtotime($datedayclose));
		

                
		
		
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
  $subtotalcash=0;
  $subtotalcashta=0;
  $totalcash=0;
  $subtotalcredit=0;
    $subtotalcreditta=0;
    $totalcredit=0;
    $totalcoupon=0;
    $subtotalcoupon=0;
    $subtotalcouponta=0;
    $totalvoucher=0;
    $subtotalvoucher=0;
    $subtotalvoucherta=0;
    $totalcheque=0;
    $subtotalcheque=0;
    $subtotalchequeta=0;
    $totalcp=0;
    $subtotalcp=0;
    $subtotalcpta=0;
    $totalcomp=0;
    $subtotalcomp=0;
    $subtotalcompta=0;
    $finaltotal=0;
    $roundofdi=0;
    $roundofta=0;
        
        
	
		 
          
                  $cur=date("Y-m-d");
                  $return.="\r\n";
                $menulist= array(
                        new report_head("Consolidated Summary Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
        $return.="----------------------------------------------------------------------";
	$return.="\r\n";
	$bilno= array(
					new bilno("Type","Value"),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
        $return.="\r\n";
	$final=0;$i=1;
		  
		 $sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings"."$string order by bm_dayclosedate,bm_billtime ASC"); 
  
	  $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	  if($num_logincashdi){
		  while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
			{ 
				if($result_logincashdi['tot'] != "")	{
			$subtotalcash =$subtotalcash + $result_logincashdi['tot'];
                        $roundofdi=$roundofdi+$result_logincashdi['roundofdi'];
          }}} 
     
          $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta,$string1_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $stringstacshd"."$stringtacshd order by tab_dayclosedate,tab_time ASC"); 
   //echo "select $string1_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string1tacshd"."$stringtacshd order by tab_dayclosedate,tab_time ASC";
	  $num_logincashta   = $database->mysqlNumRows($sql_logincashta);
	  if($num_logincashta){
		  while($result_logincashta  = $database->mysqlFetchArray($sql_logincashta)) 
			{ 
				if($result_logincashta['tot'] != "")	{
			$subtotalcashta =$subtotalcashta + $result_logincashta['tot'];
                        $roundofta=$roundofta+$result_logincashta['roundofta'];
          }}} 
          $totalcash=$subtotalcash+$subtotalcashta+$roundofdi+$roundofta;	
					
				if($totalcash!=0)
                                {   
                                    $bilno= array(
					new bilno("Cash",number_format($totalcash,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                    
					$return.="\r\n";
                                }
                             $sql_logincredit  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{     
				$subtotalcredit =$subtotalcredit + $result_logincredit['tot'];
          }}
          
           $sql_logincreditta  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and  $string2tacshd "."$stringtacshd group by b.bm_name order by tbm.tab_dayclosedate,tbm.tab_time ASC "); 
	  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
	  if($num_logincreditta){
		  while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
			{ 
				$subtotalcreditta =$subtotalcreditta + $result_logincreditta['tot'];
          }}
          $totalcredit=$subtotalcredit+$subtotalcreditta;
                    if($totalcredit!=0)
                             {      
                                    $bilno= array(
					new bilno("Card",number_format($totalcredit,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                                }
                 		
	$sql_logincoupon  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
			
	  $num_logincoupon   = $database->mysqlNumRows($sql_logincoupon);

	  if($num_logincoupon){
		  while($result_logincoupon  = $database->mysqlFetchArray($sql_logincoupon)) 
			{
				
			if($result_logincoupon['tot'] != "")	{
				
				$subtotalcoupon =$subtotalcoupon + $result_logincoupon['tot'];
          }}}
          
          $sql_logincouponta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
			
	  $num_logincouponta   = $database->mysqlNumRows($sql_logincouponta);

	  if($num_logincouponta){
		  while($result_logincouponta  = $database->mysqlFetchArray($sql_logincouponta)) 
			{
				
			if($result_logincouponta['tot'] != "")	{
		$subtotalcouponta =$subtotalcouponta + $result_logincouponta['tot'];
          
                
                        }}}
          
          $totalcoupon=$subtotalcoupon+$subtotalcouponta;
          
                            if($totalcoupon!=0)
                                {               
                                    $bilno= array(
					new bilno("Coupon",number_format($totalcoupon,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                                }
		  $sql_loginvoucher  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
		$num_loginvoucher   = $database->mysqlNumRows($sql_loginvoucher);
                 if($num_loginvoucher){
		  while($result_loginvoucher  = $database->mysqlFetchArray($sql_loginvoucher)) 
			{ 
				if($result_loginvoucher['tot'] != "")
			{
			$subtotalvoucher =$subtotalvoucher + $result_loginvoucher['tot'];
			} }}
                  
                       
                        $sql_loginvoucherta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
			$num_loginvoucherta   = $database->mysqlNumRows($sql_loginvoucherta);
                        if($num_loginvoucherta){
                         while($result_loginvoucherta  = $database->mysqlFetchArray($sql_loginvoucherta)) 
                            { 
				if($result_loginvoucherta['tot'] != "")
                            {
			$subtotalvoucherta =$subtotalvoucherta + $result_loginvoucherta['tot'];
			} }}
                        
                        
                       $totalvoucher=$subtotalvoucher+$subtotalvoucherta;
                        
                        if($totalvoucher!=0)
                        {
                            $bilno= array(
					new bilno("Voucher",number_format($totalvoucher,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";    
                        }       
		  
		  $sql_logincheque  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincheque   = $database->mysqlNumRows($sql_logincheque);
	  if($num_logincheque){
		  while($result_logincheque  = $database->mysqlFetchArray($sql_logincheque)) 
			{ 
			if($result_logincheque['tot'] != "")
			{
			$subtotalcheque =$subtotalcheque + $result_logincheque['tot'];
			} }} 
                        
                        
               $sql_loginchequeta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
	  $num_loginchequeta   = $database->mysqlNumRows($sql_loginchequeta);
	  if($num_loginchequeta){
		  while($result_loginchequeta  = $database->mysqlFetchArray($sql_loginchequeta)) 
			{ 
			if($result_loginchequeta['tot'] != "")
			{
			$subtotalchequeta =$subtotalchequeta + $result_loginchequeta['tot'];
			} }}           
                        
                  $totalcheque= $subtotalcheque+$subtotalchequeta;     
           
                  
                            if($totalcheque!=0)
                                {
                                    $bilno= array(
					new bilno("Cheque",number_format($totalcheque,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                                }  
           
                                $sql_logincp  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincp   = $database->mysqlNumRows($sql_logincp);
	  if($num_logincp){
		  while($result_logincp  = $database->mysqlFetchArray($sql_logincp)) 
			{ 
			if($result_logincp['tot'] != "")
			{
			$subtotalcp =$subtotalcp + $result_logincp['tot'];
          } }} 
          
           $sql_logincpta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			if($result_logincpta['tot'] != "")
			{
			$subtotalcpta =$subtotalcpta + $result_logincpta['tot'];
          } }} 
          
                $totalcp=$subtotalcp+$subtotalcpta;
                        if($totalcp!=0)
                          {     
                            $bilno= array(
					new bilno("Credit Sale",number_format($totalcp,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                            }  
                                 $sql_logincomp  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincomp   = $database->mysqlNumRows($sql_logincomp);
	  if($num_logincomp){
		  while($result_logincomp  = $database->mysqlFetchArray($sql_logincomp)) 
			{ 
			if($result_logincomp['tot'] != "")
			{
			$subtotalcomp =$subtotalcomp + $result_logincomp['tot'];
			} }} 
                 
             $sql_logincompta  =  $database->mysqlQuery("select $string7_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string7tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincompta   = $database->mysqlNumRows($sql_logincompta);
	  if($num_logincompta){
		  while($result_logincompta  = $database->mysqlFetchArray($sql_logincompta)) 
			{ 
			if($result_logincompta['tot'] != "")
			{
			$subtotalcompta =$subtotalcompta + $result_logincompta['tot'];
			} }}      
                 $totalcomp= $subtotalcomp+$subtotalcompta;      
                        
                    if($totalcomp!=0)
                            {
                                
                                    $bilno= array(
					new bilno("Complimentary",number_format($totalcomp,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                                        
                                }  
                                
                 
		  
		  $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
			}
	  }
	 			 $bilno= array(
					new bilno("Total Pax (Dine In)",$qtycount),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                                        
		  $finaltotal=$totalcash+$totalcredit+$totalcoupon+$totalvoucher+$totalcheque+$totalcp;
		  
			$return.="-----------------------------------------------------------------------";
			$return.="\r\n";
                        $bilno= array(
					new bilno("TOTAL",number_format($finaltotal,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                        $return.="-----------------------------------------------------------------------";
                                
		              
				
				
		  
}
 else if($_SESSION['type']=="item_ordered_cr")
{ //echo "deyhfgj";
             
 
     
            $string ="";
            $stringta="";
            $string="bm.bm_status = 'Closed'";
            $stringta="tbm.tab_status = 'Closed'";
            $from='';
            $to='';
            $reporthead="";
            $st="";
           
	   
          
//            if(isset ($_REQUEST['floorvalue']))
//	{
//		
//		$floorvalue=$_REQUEST['floorvalue'];
//                if($floorvalue!="")
//                {
//		
//		$string.=" and bm.bm_floorid='".$floorvalue."' AND ";
//                }
//	}
       
 
			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
                        $string.= "and bm.bm_dayclosedate='".$datedayclose."' ";
                        $stringta.= "and tbm.tab_dayclosedate='".$datedayclose."' ";
			$reporthead="On ".date('Y-m-d',strtotime($datedayclose));
			$return.="\r\n";
                        $menulist= array(
                        new report_head("Consolidated Itemordered Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                                    
                                
                               
	$return.="-----------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
					new itemordered("Item","Qty", "Total"),
				);
				foreach($menulist as $menulist) {
					$return .=($menulist);
				}
	$return.="\r\n";
	$return.="-----------------------------------------------------------------------";
        $return.="\r\n";
		
    
	$final=0;
        $funalta=0;
        $netfinal=0;
        
        
     
        
        $final=0;
        $qty=0;
        $i=0;
        //$finalta=0;
        //$netfinal=0;
      
          $sqlitem  =  $database->mysqlQuery("CREATE VIEW item AS SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionshortcode,p.pm_portionname,sum(bd.bd_qty) as qty,sum(0) as qty1, bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname
               union SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionshortcode,p.pm_portionname,sum(0) as qty,sum(tbd.tab_qty) as qty1 ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname");
//echo "CREATE VIEW item AS SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionshortcode,p.pm_portionname,sum(bd.bd_qty) as qty,bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname
//               union SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionshortcode,p.pm_portionname,sum(tbd.tab_qty) as qty ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname";


          $sql_stw  =  $database->mysqlQuery("SELECT mr_menuid,mmy_maincategoryname,msy_subcategoryname,mr_menuname,pm_portionshortcode,pm_portionname,sum(qty + qty1) as qty ,Unit_Price,sum(Total)as Total FROM item group by mmy_maincategoryname ,msy_subcategoryname,mr_menuid ORDER BY mmy_maincategoryname,mr_menuid ASC"); 
	 // echo "SELECT mr_menuid,mmy_maincategoryname,msy_subcategoryname,mr_menuname,pm_portionname,sum(qty) as qty ,Unit_Price,sum(Total)as Total FROM item group by mmy_maincategoryname ,msy_subcategoryname,mr_menuid ORDER BY mmy_maincategoryname,mr_menuid ASC";
        

 	  
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;$t=0;$old="";
	  
                                
                                    
                                
                                
	  	
				$final=0;$j=0;
                                $old="";
                                $subold="";
				while($result_report  = mysqli_fetch_array($sql_stw)) 
				{
					
					$final=$final + $result_report['Total'];
//                                        $ln="";
                                        $maincatname = $result_report['mmy_maincategoryname'];
                                        if($result_report['mmy_maincategoryname']!=$old){
                                            $return.="\r\n";
                                            $return .= "* * ".strtoupper($maincatname)."\n";
                                            
                                            $return.="\r\n";
                                            $old = $result_report['mmy_maincategoryname'];
//                                            
                                            //-------------
//                                            
                                            //----------
                                            
                                            
                                        }else{
                                            $return .= "";
                                            
                                            $return.="\r\n";
                                            $old = $result_report['mmy_maincategoryname'];
                                        }
                                        
					
					$item=$result_report['mr_menuname']."(".$result_report['pm_portionshortcode'].")";
                                            if(strlen($item)>25)
                                            {
                                            $item=substr($item,0,25);
                                                
                                            }
                                            if(strlen($item)>12)
                                        {
                                            $spc="                  ";
                                        }
                                        else {
                                             $spc="                                 ";
                                        }
				//$result_report['qty'],$result_report['total']
					$menulist= array(
						new itemordered(strtoupper($item),$result_report['qty'],number_format($result_report['Total'],$decimal)),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$return .=($menulist);
					$return.="\r\n";
                                        $j++;
                                        }
									
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
				
	    
          }	
				
				 
                        $return.="-----------------------------------------------------------------------";	
			$return.="\r\n";
                        $menulist= array(
						new itemordered("Items-".$i,"Total",number_format($final,$decimal)),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$return .=($menulist);
					$return.="\r\n";
                                        
                                        }
                        $return.="-----------------------------------------------------------------------";
                
				
	  
	$sqldrop  =  $database->mysqlQuery ("DROP VIEW item");  
}	 
else if($_SESSION['type']=="categorywise_report_cr")
{

            $string ="";
            $string.="bm.bm_status = 'Closed'";
            $stringta ="";
            $stringta="tbm.tab_status = 'Closed'";
            $from='';
            $to='';
            $reporthead="";
            $st="";

//            if(isset ($_REQUEST['floorz']))
//	{
//		
//		$floorvalue=$_REQUEST['floorz'];
//                if($floorvalue!="")
//                {
//		
//		$string.=" and bm.bm_floorid='".$floorvalue."' AND ";
//                }
//	}
       

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
                        $string.= "and bm.bm_dayclosedate ='".$datedayclose."'";
                        $stringta.= "and tbm.tab_dayclosedate ='".$datedayclose."'";
			$reporthead="On ".date('Y-m-d',strtotime($datedayclose));
                        $return.="\r\n";
                          $menulist= array(
                        new report_head("Consolidated Category Wise Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                                
                                  
                                $return.="----------------------------------------------------------------------";
                                $return.="\r\n";
                                $menulist= array(
					new cat_wise("Slno"," Category ","  Qty","  Total")
				);
				foreach($menulist as $menulist) {
					$return .=($menulist);
				}
                                $return.="\r\n";
                                $return.="----------------------------------------------------------------------";
                                $return.="\r\n";
			
		
		
	$final=0;
        $total=0;
        $totalta=0;
        
        
       $sqlcatview  =  $database->mysqlQuery("CREATE VIEW category AS SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,sum(0) as qty1,bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname union SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(0) as qty,sum(tbd.tab_qty) as qty1 ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname");
  //echo "CREATE VIEW category AS SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname union SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tbd.tab_qty) as qty ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname";            
   $sql_login  =  $database->mysqlQuery("SELECT mmy_maincategoryname,count(distinct(mr_menuid)) as noofitems,sum(qty+qty1) as qty,sum(Total) as Total From category group by mmy_maincategoryname ORDER BY mmy_maincategoryname ASC");
     //echo "SELECT mmy_maincategoryname,count(distinct(mr_menuid)) as noofitems,sum(qty) as qty,sum(Total) as Total From category group by mmy_maincategoryname ORDER BY mmy_maincategoryname ASC";
     
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$t=0;
	  
                          
                                
                                  
	  
                                
				
				$i=1;
                               
                               
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{       $total=$total + $result_report['Total'];
					//$final=$final + $result_report['Final'];
					//$dt=explode("-",$result_report['tab_dayclosedate']);
					//$date=$dt[2]."-".$dt[1]."-".$dt[0];
                                        $main_cat=$result_report['mmy_maincategoryname'];
                                        $main_cat1=substr($main_cat,0,20);
                                        if(strlen($main_cat1)>12)
                                        {
                                            $spc="                  ";
                                        }
                                        else {
                                             $spc="                             ";
                                        }
                                        $menulist= array(
					new cat_wise($i,strtoupper($main_cat1),$result_report['qty'],number_format($result_report['Total'],$decimal))
                                            );
				foreach($menulist as $menulist) {
					$return .=($menulist);
                                        $return.="\r\n"; 
				}
					
										//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
                     }		
	  
         			

                                
                                $return.="----------------------------------------------------------------------";	
                                $return.="\r\n";
                                $menulist= array(
					new cat_wise("","","Total",number_format($total,$decimal))
                                            );
				foreach($menulist as $menulist) {
					$return .=($menulist);
                                }
                                $return.="\r\n";
                                $return.="----------------------------------------------------------------------";
				

	  
	  $sqldrop  =  $database->mysqlQuery ("DROP VIEW category");
		
}
else if($_SESSION['type']=="sales_summary_report_cr")
{
    
     
      $from='';
      $to='';
        $string="";
        $stringstat="tab_complimentary!='Y'  AND";
        $stringstatdi="bm_complimentary!='Y' AND ";
        $stringta="";
        $stringcs="";
        $stringhd="";
        $stringtacshd='';
       	$reporthead="";
	$string .=" bm_status='Closed' AND ";
        $stringtacshd .=" tab_status='Closed' AND ";
        $stringta .=" tab_status='Closed' AND tab_mode='TA'  AND ";
        $stringcs .=" tab_status='Closed' AND tab_mode='CS'  AND ";
        $stringhd .=" tab_status='Closed' AND tab_mode='HD'  AND ";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= " bm_dayclosedate ='".$datedayclose."'";
                        $stringta.=" tab_dayclosedate ='".$datedayclose."' ";
                        $stringcs.=" tab_dayclosedate ='".$datedayclose."' ";
                        $stringhd.=" tab_dayclosedate ='".$datedayclose."'";
                        $stringtacshd.= " tab_dayclosedate ='".$datedayclose."' ";
			$string_pax.= "bm_dayclosedate  ='".$datedayclose."'";
		
                        $reporthead="On ".date('Y-m-d',strtotime($datedayclose));
              
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
         
          
           
                $flg=0;
           
           
                                
				
                                $return.="\r\n";
                                $menulist= array(
                        new report_head("Consolidated SALES SUMMARY (Inc.Tax)"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
//                $menulist= array(
//                        new report_head($reporthead),
//                );
//                    foreach($menulist as $menulist) {
//					$return .=($menulist);
//			}
                $return.="\r\n";
				
                                
                                $return.="----------------------------------------------------------------------";
                                 $return.="\r\n";
				$final=0;$i=1;
                                
                                //-----------------------
 $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotalta=0;
  $subtotalcs=0;
  $subtotalhd=0;
  $salesinctaxtacshd=0;
  $tot_inctax=0;
  $salesinctax=0;
  $salesexcltaxdi=0;
   $salesexcltaxta=0;
   $salesexcltaxcs=0;
   $salesexcltaxhd=0;
   $servtax=0;
   $servtaxtacshd=0;
   $tot_servtax=0;
   $servcharge=0;
   $servchargetacshd=0;
   $vat=0;
   $vattacshd=0;
   $tot_vat=0;
   $roundof=0;
   $roundoftacshd=0;
   $tot_roundof=0;
   $taxexemptdi=0;
   $taxexemptta=0;
   $taxexempthd=0;
   $taxexemptcs=0;
   
    $sql_login  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot,sum(bm_tax_exempt) as taxexempt, (sum(bm_subtotal)-sum(bm_discountvalue)) as totexcl,sum(bm_servicetax) as totserv,sum(bm_servicecharge) as totservcharge,sum(bm_vat) as totvat,sum(bm_roundoff_value) as totroundof FROM tbl_tablebillmaster where  $stringstatdi $string"); 
  //echo "select sum(bm_finaltotal) as tot, (sum(bm_subtotal)-sum(bm_discountvalue)) as totexcl,sum(bm_servicetax) as totserv,sum(bm_servicecharge) as totservcharge,sum(bm_vat) as totvat,sum(bm_roundoff_value) as totroundof FROM tbl_tablebillmaster where  $stringstatdi $string";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                            if($result_login['tot'] != "")	{
                            $subtotal =$subtotal + $result_login['tot'];
                            $salesinctax = $salesinctax+$result_login['tot'];
                            $salesexcltaxdi = $salesexcltaxdi+$result_login['totexcl'];
                            $taxexemptdi = $taxexemptdi+$result_login['taxexempt'];
                            $servtax    =$servtax+$result_login['totserv'];
                            $servcharge    =$servcharge+$result_login['totservcharge'];
                            $vat    =$vat+$result_login['totvat'];
                            $roundof=$roundof+$result_login['totroundof'];
          }}}   
      $sql_loginta  =  $database->mysqlQuery("select sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl,sum(tab_servicetax) as totserv,sum(tab_servicecharge) as totservcharge,sum(tab_vat) as totvat FROM tbl_takeaway_billmaster where $stringstat  $stringta"); 
                //echo "select sum(tab_netamt) as tot, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl,sum(tab_servicetax) as totserv,sum(tab_servicecharge) as totservcharge,sum(tab_vat) as totvat FROM tbl_takeaway_billmaster where $stringstat  $stringta";
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
                            if($result_loginta['tot'] != "")	{
                            $subtotalta =$subtotalta + $result_loginta['tot'];
                            $salesexcltaxta =$salesexcltaxta+$result_loginta['totexcl'];
                            $taxexemptta = $taxexemptta+$result_loginta['taxexempt'];
                          
          
          }}}
          
          $sql_logincs  =  $database->mysqlQuery("select sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl,sum(tab_servicetax) as totserv,sum(tab_servicecharge) as totservcharge,sum(tab_vat) as totvat FROM tbl_takeaway_billmaster where $stringstat  $stringcs"); 
                //echo "select sum(tab_netamt) as tot, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl,sum(tab_servicetax) as totserv,sum(tab_servicecharge) as totservcharge,sum(tab_vat) as totvat FROM tbl_takeaway_billmaster where $stringstat  $stringcs";
	  $num_logincs   = $database->mysqlNumRows($sql_logincs);
	  if($num_logincs){
		  while($result_logincs  = $database->mysqlFetchArray($sql_logincs)) 
			{ 
                            if($result_logincs['tot'] != "")	{
                            $subtotalcs =$subtotalcs + $result_logincs['tot'];
                             $salesexcltaxcs =$salesexcltaxcs+$result_logincs['totexcl'];
                             $taxexemptcs = $taxexemptcs+$result_logincs['taxexempt'];
                           
          }}}
          
           $sql_loginhd  =  $database->mysqlQuery("select sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl,sum(tab_servicetax) as totserv,sum(tab_servicecharge) as totservcharge,sum(tab_vat) as totvat FROM tbl_takeaway_billmaster where $stringstat  $stringhd"); 
                //echo "select sum(tab_netamt) as tot, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl,sum(tab_servicetax) as totserv,sum(tab_servicecharge) as totservcharge,sum(tab_vat) as totvat FROM tbl_takeaway_billmaster where $stringstat  $stringhd";
	  $num_loginhd   = $database->mysqlNumRows($sql_loginhd);
	  if($num_loginhd){
		  while($result_loginhd  = $database->mysqlFetchArray($sql_loginhd)) 
			{ 
                            if($result_loginhd['tot'] != "")	{
                            $subtotalhd =$subtotalhd + $result_loginhd['tot'];
                            $salesexcltaxhd =$salesexcltaxhd+$result_loginhd['totexcl'];
                            $taxexempthd = $taxexempthd+$result_loginhd['taxexempt'];
                            
          }}}
          
           $sql_logintacshd  =  $database->mysqlQuery("select sum(tab_netamt) as tot, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl,sum(tab_servicetax) as totserv,sum(tab_servicecharge) as totservcharge,sum(tab_vat) as totvat,sum(tab_roundoff_value) as totroundof FROM tbl_takeaway_billmaster where  $stringstat $stringtacshd"); 
                //echo "select sum(tab_netamt) as tot, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl,sum(tab_servicetax) as totserv,sum(tab_servicecharge) as totservcharge,sum(tab_vat) as totvat,sum(tab_roundoff_value) as totroundof FROM tbl_takeaway_billmaster where  $stringstat $stringtacshd";
	  $num_logintacshd   = $database->mysqlNumRows($sql_logintacshd);
	  if($num_logintacshd){
		  while($result_logintacshd  = $database->mysqlFetchArray($sql_logintacshd)) 
			{ 
                            if($result_logintacshd['tot'] != "")	{
                            
                            $servtaxtacshd=$servtaxtacshd+$result_logintacshd['totserv'];
                            $servchargetacshd=$servchargetacshd+ $result_logintacshd['totservcharge'];
                            $vattacshd=$vattacshd+ $result_logintacshd['totvat'];
                            $roundoftacshd=$roundoftacshd+ $result_logintacshd['totroundof'];
          }}}
          $sql_logintacshd15  =  $database->mysqlQuery("SELECT * FROM tbl_branch_settings_counter "); 
                
	  $num_logintacshd15   = $database->mysqlNumRows($sql_logintacshd15);
	  if($num_logintacshd15){
		  while($result_logintacshd15  = $database->mysqlFetchArray($sql_logintacshd15)) 
			{ 
                           
                            
                            $percent31=$result_logintacshd15['bsc_servicetax'];
                            $percent32= $result_logintacshd15['bsc_vat'];
                            $percent33= $result_logintacshd15['bsc_servicecharge'];
                           
          }}
          
          
          
          
           $sql_logintacshd1  =  $database->mysqlQuery("SELECT * FROM tbl_branch_settings_ta_hd "); 
                
	  $num_logintacshd1   = $database->mysqlNumRows($sql_logintacshd1);
	  if($num_logintacshd1){
		  while($result_logintacshd1  = $database->mysqlFetchArray($sql_logintacshd1)) 
			{ 
                           
                            
                            $percent1=$result_logintacshd1['bsth_servicetax'];
                            $percent2= $result_logintacshd1['bsth_vat'];
                            $percent3= $result_logintacshd1['bsth_servicecharge'];
                           
          }}
          $totroundofff=$roundoftacshd+$roundof;
          //takeaway taxes//
          $tataxsg="0";
          $tataxcg="0";
          $tataxtx3="0";
          $rf1="";
          $sql_logintacshd11  =  $database->mysqlQuery("SELECT tab_servicetax,tab_vat,tab_servicecharge,tab_roundoff_value FROM tbl_takeaway_billmaster where  $stringstat  $stringta"); 
         
	  $num_logintacshd11   = $database->mysqlNumRows($sql_logintacshd11);
	  if($num_logintacshd11){
		  while($result_logintacshd11  = $database->mysqlFetchArray($sql_logintacshd11)) 
			{ 
                           
                            $rf1=$rf1+$result_logintacshd11['tab_roundoff_value'];
                            $tataxsg=$tataxsg+$result_logintacshd11['tab_servicetax'];
                            
                            $tataxcg=$tataxcg+$result_logintacshd11['tab_vat'];
                            $tataxtx3=$tataxtx3+$result_logintacshd11['tab_servicecharge'];
                           
                           
          }}

          $hdtaxsg="0";
          $hdtaxcg="0";
          $hdtaxtx3="0";
          $rf2="";
          $sql_logintacshd12  =  $database->mysqlQuery("SELECT tab_servicetax,tab_vat,tab_servicecharge,tab_roundoff_value FROM tbl_takeaway_billmaster where  $stringstat  $stringhd"); 
         
	  $num_logintacshd12   = $database->mysqlNumRows($sql_logintacshd12);
	  if($num_logintacshd12){
		  while($result_logintacshd12  = $database->mysqlFetchArray($sql_logintacshd12)) 
			{ 
                           
                             $rf2=$rf2+$result_logintacshd11['tab_roundoff_value'];
                            $hdtaxsg=$hdtaxsg+$result_logintacshd12['tab_servicetax'];
                            $hdtaxcg=$hdtaxcg+$result_logintacshd12['tab_vat'];
                            $hdtaxtx3=$hdtaxtx3+$result_logintacshd12['tab_servicecharge'];
                           
                           
          }}
          $cstaxsg="0";
          $cstaxcg="0";
          $cstaxtx3="0";
          $rf3="";
          $sql_logintacshd13  =  $database->mysqlQuery("SELECT tab_servicetax,tab_vat,tab_servicecharge,tab_roundoff_value FROM tbl_takeaway_billmaster where  $stringstat  $stringcs "); 
         
	  $num_logintacshd13   = $database->mysqlNumRows($sql_logintacshd13);
	  if($num_logintacshd13){
		  while($result_logintacshd13  = $database->mysqlFetchArray($sql_logintacshd13)) 
			{ 
                           
                            
                         $rf3=$rf3+$result_logintacshd11['tab_roundoff_value'];  
                      $cstaxsg=$cstaxsg+$result_logintacshd13['tab_servicetax'];
                      $cstaxcg=$cstaxcg+$result_logintacshd13['tab_vat'];
                      $cstaxtx3=$cstaxtx3+$result_logintacshd13['tab_servicecharge'];
                            
                           
          }}
          
          $rfall=$rf1+$rf2+$rf3;
          
          $total=$subtotal + $subtotalta+$subtotalcs+$subtotalhd;
//            $tot_servtax=$servtax+$servtaxtacshd;
//            $tot_servcharge=$servcharge+$servchargetacshd;
//            $tot_vat=$vat+$vattacshd;
            $tot_roundof=$roundof+$roundoftacshd;
//            $total_taxsummary=$salesexcltaxdi+$salesexcltaxta+$salesexcltaxcs+$salesexcltaxhd+$tot_servtax+$tot_servcharge+$tot_vat+$tot_roundof;
                         
                        if($subtotal!=0)
                            {
                                $bilno= array(
					new bilno("Dine In",number_format($subtotal,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                    
				$return.="\r\n";
                            }
                          
                            if($subtotalta!=0)
                            {
                                $bilno= array(
					new bilno("Take Away",number_format($subtotalta,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                            } 
                             if($subtotalcs!=0)
                            {   
                                $bilno= array(
					new bilno("Counter Sale",number_format($subtotalcs,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n"; 
                              
                            }
                              if($subtotalhd!=0)
                            {
                                  $bilno= array(
					new bilno("Home Delivery",number_format($subtotalhd,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n"; 
                            }
                             
                            $bilno= array(
					new bilno("Total Summary",number_format($total,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n"; 
                            
                                 $return .= "TAX SUMMARY";
                                 $return.="             ";
                                 $return.="\r\n";
				$return.="\r\n";
                             if($salesexcltaxdi!=0)
                             {
                                 $bilno= array(
					new bilno("Dine-In Excl.Tax",number_format($salesexcltaxdi,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                            }
                             if($taxexemptdi!=0)
                             {
                                 $bilno= array(
					new bilno("Tax Exempted Amount-DI",number_format($taxexemptdi,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                            }
                            $servtax1="";
                            $servcharge1="";
                            $vat1="";
                            $roundof1="";
                            $servtax12="";
                            $servcharge12="";
                            $vat12="";
                  
             $roundof12="";
             $sql_login5  =  $database->mysqlQuery("select tf.fr_floorname,sum(bm_finaltotal) as tot, (sum(bm_subtotal)-sum(bm_discountvalue)) as totexcl,sum(bm_servicetax) as totserv,0 as totvat,0 as totservcharge,sum(bm_roundoff_value) as totroundof,tf.fr_servicetax,0 as fr_vat,0 as fr_servicecharge FROM tbl_tablebillmaster bm left join tbl_floormaster tf on tf.fr_floorid=bm.bm_floorid where  $stringstatdi $string group by fr_servicetax  Union            
              select tf.fr_floorname,sum(bm_finaltotal) as tot, (sum(bm_subtotal)-sum(bm_discountvalue)) as totexcl,0 as totserv, sum(bm_vat) as totvat,0 as totservcharge,sum(bm_roundoff_value) as totroundof,0 as fr_servicetax,tf.fr_vat,0 as fr_servicecharge FROM tbl_tablebillmaster bm left join tbl_floormaster tf on tf.fr_floorid=bm.bm_floorid where  $stringstatdi $string group by fr_vat union
              select tf.fr_floorname,sum(bm_finaltotal) as tot, (sum(bm_subtotal)-sum(bm_discountvalue)) as totexcl,0 as totserv,0 as totvat,sum(bm_servicecharge) as totservcharge, sum(bm_roundoff_value) as totroundof,0 as fr_servicetax,0 as fr_vat,tf.fr_servicecharge FROM tbl_tablebillmaster bm left join tbl_floormaster tf on tf.fr_floorid=bm.bm_floorid where  $stringstatdi $string group by fr_servicecharge"); 
             //echo "select tf.fr_floorname,sum(bm_finaltotal) as tot, (sum(bm_subtotal)-sum(bm_discountvalue)) as totexcl,sum(bm_servicetax) as totserv,sum(bm_servicecharge) as totservcharge,sum(bm_vat) as totvat,sum(bm_roundoff_value) as totroundof,tf.fr_servicetax,tf.fr_vat,tf.fr_servicecharge FROM tbl_tablebillmaster bm left join tbl_floormaster tf on tf.fr_floorid=bm.bm_floorid where  $stringstatdi $string group by fr_servicetax,fr_vat,fr_servicecharge";
	  	
             
             $num_login5   = $database->mysqlNumRows($sql_login5);
             if($num_login5){
         
		  while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
			{   
				if($result_login5['tot'] != "")	{
                                $s=$result_login5['fr_servicetax'];
                                $c=$result_login5['fr_vat'];
                                $t=$result_login5['fr_servicecharge'];
                                $flr=$result_login5['fr_floorname'];
                                    $servtax1    =$result_login5['totserv'];
                                    $servcharge1    =$result_login5['totservcharge'];
                                    $vat1    =$result_login5['totvat'];
                                    $roundof1=$result_login5['totroundof'];
                                    $servtax12    =$servtax12+$result_login5['totserv'];
                                    $servcharge12    =$servcharge12+$result_login5['totservcharge'];
                                    $vat12    =$vat12+$result_login5['totvat'];
                                    $roundof12=$roundof12+$result_login5['totroundof'];
                    if($servtax1!=0)
                    {    
                        $bilno= array(
					new bilno("Dine-In      ".$taxname1."(".$s.")%",number_format($servtax1,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                   }
                    if($servcharge1!=0)
                    {   
                        $bilno= array(
					new bilno("Dine-In      ".$taxname3."(".$t.")%",number_format($servcharge1,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                    }
                      if($vat1!=0)
                    {   
                          $bilno= array(
					new bilno("Dine-In      ".$taxname2."(".$c.")%",number_format($vat1,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                    } 

            
          } } }
           
                    if($salesexcltaxta!=0)
                        {   
                            $bilno= array(
					new bilno("Take Away Excl.Tax",number_format($salesexcltaxta,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                            
                        }
                   if($taxexemptta!=0)
                            {
                                $bilno= array(
					new bilno("Tax Exempted Amount-TA",number_format($taxexemptta,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                            }
            if($tataxsg!=0){
                                $bilno= array(
				new bilno("Takeaway      ".$taxname1."(".$percent1.")",number_format($tataxsg,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                                
                }
            
            if($tataxcg!=0){
                                $bilno= array(
				new bilno("Takeaway      ".$taxname2."(".$percent2.")",number_format($tataxcg,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                }
           
            if($tataxtx3!=0){
                                $bilno= array(
				new bilno("Takeaway      ".$taxname3."(".$percent3.")",number_format($tataxtx3,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                }
            
            if($salesexcltaxcs!=0)
                {   
                    $bilno= array(
				new bilno("Counter Sale Excl.Tax",number_format($salesexcltaxcs,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                }
                if($taxexemptcs!=0)
                    {
                            $bilno= array(
				new bilno("Tax Exempted Amount-CS",number_format($taxexemptcs,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                    }
                if($cstaxsg!=0){
                    
                    $bilno= array(
				new bilno("Countersale      ".$taxname1."(".$percent31.")",number_format($cstaxsg,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                }
            
            if($cstaxcg!=0){
                
                $bilno= array(
				new bilno("Countersale      ".$taxname2."(".$percent32.")%",number_format($cstaxcg,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
            }
            
            if($cstaxtx3!=0){
                $bilno= array(
				new bilno("Countersale      ".$taxname3."(".$percent33.")%",number_format($cstaxtx3,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
            }
            
            if($salesexcltaxhd!=0)
                {   
                    $bilno= array(
				new bilno("Home Delivery Excl.Tax",number_format($salesexcltaxhd,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                    
                }  
                if($taxexempthd!=0)
                             {
                    $bilno= array(
				new bilno("Tax Exempted Amount-HD",number_format($taxexempthd,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                            }
                if($hdtaxsg!=0){
                    $bilno= array(
				new bilno("Home Delivery      ".$taxname1."(".$percent1.")%",number_format($hdtaxsg,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                    }

                if($hdtaxcg!=0){
                    $bilno= array(
				new bilno("Home Delivery      ".$taxname2."(".$percent2.")%",number_format($hdtaxsg,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                    }

            if($hdtaxtx3!=0){
                $bilno= array(
				new bilno("Home Delivery      ".$taxname3."(".$percent3.")%",number_format($hdtaxtx3,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                }
               
                             if($tot_roundof!=0)
                             {
                                 $bilno= array(
				new bilno("Round Off(Total)",number_format($tot_roundof,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                            }
                             $return.="\r\n";
                           $return.="----------------------------------------------------------------------";
                           $return.="\r\n"; 
                           $bilno= array(
				new bilno("Sale Inc.Tax",number_format(($salesexcltaxdi+$salesexcltaxta+$salesexcltaxcs+$salesexcltaxhd+$tataxsg+$tataxcg+$tataxtx3+$hdtaxsg+$hdtaxcg+$hdtaxtx3+$cstaxsg+$cstaxcg+$cstaxtx3+$servtax12+$servcharge12+$vat12+$tot_roundof),$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                                $return.="\r\n";
                           $return.="----------------------------------------------------------------------";
                           $return.="\r\n";
                                               
    
          } 
else if($_SESSION['type']=="order")
{
		
		
   $reporthead="";
  
  
 

 ?> 
   
      <?php
  $string=" bm_status='Closed' AND ";

			
			$string.= " bm_dayclosedate ='".$datedayclose."' ";
			$reporthead.="      On =".$datedayclose; 
		
		
//			$return.="-----------------------------------------------------";	
		$return.="\r\n";
                $return.="\r\n";
                $return.="\r\n";
		$return.="                Items Ordered Report" ;
	$return.="\r\n";
	
$return.="           ".$reporthead   ;


?>
  
	<?php
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
	$return.="\r\n";
	/*$return.="Slno  Date       BillNo    Final     ";*/
	/*$return.="Slno  Date        BillNo                      Final     ";*/
	$return.="Slno  Item                                  ";
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
$return.="\r\n";



	
    ?>

<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,ROUND(avg(bd.bd_rate), 1) as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string group by m.mr_maincatid ,m.mr_subcatid,bd.bd_menuid ORDER BY mc.mmy_maincategoryname,m.mr_menuname ASC"); 
                                                
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['Total'];
			
			//$return.=$i.'    ';
			
			 $sl=$i;
			if($sl < '10')
			{
				$return.=$i.'    ';
				//$return.=$i.'    ';
				
			}
			elseif($sl <'100')
			{
				$return.=$i.'   ';
				
			}
			else
			{
				$return.=$i.'  ';
			}
			
			
			
			
			
			
			
	$return.=$result_login['mr_menuname']."(".$result_login['pm_portionname'].")";
		//$return.='                        ';
		
	//	$return.=$result_login['fr_floorname'];
		
		
	//	$return.='           ';
	$return.="\r\n";
	
			//$return.='                                  ';	
			//$return.='                                  ';	
			
			if($sl < '10')
			{
				$return.='     ';
				//$return.=$i.'    ';
				
			}
			elseif($sl <'100')
			{
				$return.='     ';
				
			}
			else
			{
				$return.='     ';
			}
			
			
			
			//$return.=$result_login['fr_floorname'];
			//	$return.='     ';
			$return.='                 ';
			$return.=$result_login['qty'].'*'.number_format($result_login['Unit_Price'],$decimal).'=';
			//$return.='                               ';
			//$return.='                      ';
			$return.=number_format($result_login['Total'],$decimal);
		
			$return.="\r\n";	
			/*$return.="\r\n";	*/
			$i++;
			
			}
	  }

			$return.="\r\n";
			$return.="-----------------------------------------------------";	
			$return.="\r\n";
$return.="TOTAL -                            ".number_format($final,$decimal)."";
	//$return.="TOTAL -                                      ".$final."";
		$return.="\r\n";	
		        $return.="------------------------------------------------------";	
	//$return.="\r\n";
  //$return.="\r\n";
	
	}
 ////////////////////////////Item order Report////////////////////////////////////////
else if($_SESSION['type']=="order")
{
		
		
   $reporthead="";

  
 

 ?> 
   
      <?php
  $string=" ter_status='Closed' AND ";
   
			
			$string.= " ter_dayclosedate ='".$datedayclose."' ";
			$reporthead.="      On =".$datedayclose; 
		
		
//			$return.="-----------------------------------------------------";	
		$return.="\r\n";
                $return.="\r\n";
                $return.="\r\n";
		$return.="             Dynamic Rate Items Ordered Report" ;
	$return.="\r\n";
	
$return.="           ".$reporthead   ;


?>
  
	<?php
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
	$return.="\r\n";
	/*$return.="Slno  Date       BillNo    Final     ";*/
	/*$return.="Slno  Date        BillNo                      Final     ";*/
	$return.="Slno  Item                                  ";
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
$return.="\r\n";



	
    ?>

<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,f.fr_floorname,sum(o.ter_qty) as qty,ROUND(avg(o.ter_rate), 1) as Unit_Price, ((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where (m.mr_manualrateentry = 'Y') and $string group by m.mr_maincatid ,m.mr_subcatid,o.ter_menuid,o.ter_portion,o.ter_floorid,o.ter_rate ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['Total'];
			
			//$return.=$i.'    ';
			
			 $sl=$i;
			if($sl < '10')
			{
				$return.=$i.'    ';
				//$return.=$i.'    ';
				
			}
			elseif($sl <'100')
			{
				$return.=$i.'   ';
				
			}
			else
			{
				$return.=$i.'  ';
			}
			
			
			
			
			
			
			
	$return.=$result_login['mr_menuname']."(".$result_login['pm_portionname'].")";
		//$return.='                        ';
		
	//	$return.=$result_login['fr_floorname'];
		
		
	//	$return.='           ';
	$return.="\r\n";
	
			//$return.='                                  ';	
			//$return.='                                  ';	
			
			if($sl < '10')
			{
				$return.='     ';
				//$return.=$i.'    ';
				
			}
			elseif($sl <'100')
			{
				$return.='     ';
				
			}
			else
			{
				$return.='     ';
			}
			
			
			
			$return.=$result_login['fr_floorname'];
			//	$return.='     ';
			$return.='                 ';
			$return.=$result_login['qty'].'*'.number_format($result_login['Unit_Price'],$decimal).'=';
			//$return.='                               ';
			//$return.='                      ';
			$return.=number_format($result_login['Total'],$decimal);
		
			$return.="\r\n";	
			/*$return.="\r\n";	*/
			$i++;
			
			}
	  }

			$return.="\r\n";
			$return.="-----------------------------------------------------";	
			$return.="\r\n";
$return.="TOTAL -                            ".number_format($final,$decimal)."";
	//$return.="TOTAL -                                      ".$final."";
		$return.="\r\n";	
		        $return.="-----------------------------------------------------";	
	//$return.="\r\n";
//  $return.="\r\n";
	
	}
 ///////////////////////////////////item order Report end/////////////////////////////////////////////
else if( $_SESSION['type']=="summary_ham")
{
/* ******************************************** Category master ******************************************************* */

 
 ?> 
  

  
   
  <?php
  $strin="";
	$strngs=" ter_status='Closed' AND ";
  $string='';
  $reporthead="";
	$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_finaltotal) ";
	
	$string6_str=" sum(bm_finaltotal)";
		$string7_str=" sum(bm_finaltotal)";
		$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
$string1 =$strings. " pym_code='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	


			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= " bm_dayclosedate ='".$datedayclose."' ";
			$reporthead="       On =".$datedayclose ; 
				$string_pax.= " bm_dayclosedate ='".$datedayclose."' ";
				
					$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";	
		
	
	
	?>
    <?php 
	
		
//			$return.="-----------------------------------------------------";	
		    $return.="\r\n"	;
                    $return.="\r\n";
                    $return.="\r\n";

	$return.="               Summary Report" ;
	$return.="\r\n";
	$return.="          ".$reporthead;
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
	$return.="\r\n";
	$return.="Type                                          Value";
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
    $return.="\r\n";
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
	// echo "select $string1_str as tot from tbl_tablebillmaster where $string1"."$string order by bm_dayclosedate,bm_billtime ASC";
 	  $sql_login  =  $database->mysqlQuery("select IFNULL($string1_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
    $return.="Cash                                          " .number_format($result_login['tot'],$decimal)." ";
				$return.="\r\n";
	 ?>
 
  <?php } }
  
  
  
  $sql_login  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
    $return.="Credit                                        ".number_format($result_login['tot'],$decimal)."";
					$return.="\r\n";
					//$return.=round($result_login['tot']);
	 ?>
  
   
  <?php } }
  
  else
  {
	  	$return.="Credit                                        0.00";
					$return.="\r\n";
  }
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string3_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				//$subtotal =$subtotal + $result_login['tot'];
					$return.="Coupons                                       ".number_format($result_login['tot'],$decimal)."";
					//$return.=round($result_login['tot']);
					$return.="\r\n";
	 ?>
 
  <?php } }
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string4_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
					$return.="Voucher                                       ".number_format($result_login['tot'],$decimal)."";
					$return.="\r\n";
					
	 ?>
 
  <?php } }
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string5_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Cheque                                        ".number_format($result_login['tot'],$decimal)."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  
  
  
    $sql_login  =  $database->mysqlQuery("select IFNULL($string6_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Credits                                       ".number_format($result_login['tot'],$decimal)."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string7_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Complimentary                                 ".number_format($result_login['tot'],$decimal)."";
						$return.="\r\n";	
						
							
	 ?>

  <?php } }
  
  
  
  $bev_tot =0;
		    $sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) = 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) = 'COLD BEVERAGES' ))ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = $database->mysqlFetchArray($sql_login)) 
				{
						/*if($result_report['tot'] != "")
						{*/
						$bev_tot=$bev_tot+$result_report['Total'];
					//$subtotal =$subtotal + $result_report['Total'];
					
						if($result_report['Total'] != "")
						{
					$return.="Beverage Sale                                 ".number_format($result_report['Total'],$decimal)."";
						$return.="\r\n";	
						}
						else
						{
							$return.="Beverage Sale                                 0.00";
						$return.="\r\n";	
						}
					
					
					
			/*	}*/
		  }}
		  
		  
		  
		  
		  $food_tot=0;
		   $sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) != 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) != 'COLD BEVERAGES' ))ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = $database->mysqlFetchArray($sql_login)) 
				{
						
					//$subtotal =$subtotal + $result_report['Total'];
					$food_tot=$food_tot+$result_report['Total'];
					if($result_report['Total'] != "")
						{
					$return.="Food Sale                                     ".number_format($result_report['Total'],$decimal)."";
						$return.="\r\n";	
						}
						else
						{
							$return.="Food Sale                                     0.00";
						$return.="\r\n";	
						}
					
		  }}
		  
		  
		  
		  
		  
		  
		  
		  	$tot_per=$food_tot+$bev_tot;
			
			$food_per=$food_tot/$tot_per*100;
			$bev_per=$bev_tot/$tot_per*100;
			
				$return.="Food Sale(%)                                  ".round($food_per,2)."";
						$return.="\r\n";	
							
			
			
				$return.="Beverages Sale(%)                             ".round($bev_per,2)."";
						$return.="\r\n";	
							
			
  
  
  	 $qtycount=0;
  $sql_login  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$qtycount=$qtycount + $result_login['ct'];
				
				$return.="Total Pax                                     ".$qtycount."";
						$return.="\r\n";	
						
							
	 ?>

  <?php } }
  
  
  
   $bilcount=0;
  $sql_login  =  $database->mysqlQuery("SELECT count(bm_billno) as bills FROM `tbl_tablebillmaster` WHERE $string_pax"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$bilcount=$bilcount + $result_login['bills'];
				
				$return.="No.Of Invoices                                ".$bilcount."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  
   $disc=0;
  $sql_login  =  $database->mysqlQuery("SELECT sum(bm_discountvalue) as bills FROM `tbl_tablebillmaster` WHERE $string_pax"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$disc=$disc + $result_login['bills'];
				
				$return.="Total Discount                                ".number_format($disc,$decimal)."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  
  
        $return.="-----------------------------------------------------";	
  
  	$return.="\r\n";
  	$return.="TOTAL -                                       ".number_format($subtotal,$decimal)."";
	$return.="\r\n";
        $return.="-----------------------------------------------------";	
        //$return.="\r\n";
                        }
else if($_SESSION['type']=="summary")
{
	
	
		
		
		
	/* ******************************************** Category master ******************************************************* */

 
 ?> 
  

  
   
  <?php
  $strin="";
	$strngs=" ter_status='Closed' AND ";
  $string='';
  $reporthead="";
	$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_finaltotal) ";
	
	$string6_str=" sum(bm_finaltotal)";
		$string7_str=" sum(bm_finaltotal)";
		$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary'))  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= " bm_dayclosedate ='".$datedayclose."' ";
			$reporthead="       On =".$datedayclose; 
			$string_pax.= "bm_dayclosedate ='".$datedayclose."'";
			$strin.=" ter_dayclosedate ='".$datedayclose."'";	
		
	
	?>
    <?php 
	
		
//			$return.="-----------------------------------------------------";	
				$return.="\r\n";
                                $return.="\r\n";
                                $return.="\r\n";

	$return.="               Summary Report" ;
	$return.="\r\n";
	$return.="          ".$reporthead;
	$return.="\r\n";
	$return.="---------------------------------------------------------";	
	$return.="\r\n";
	$return.="Type                                          Value";
	$return.="\r\n";
	$return.="---------------------------------------------------------";	
    $return.="\r\n";
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
       $cur=date("Y-m-d");
	// echo "select $string1_str as tot from tbl_tablebillmaster where $string1"."$string order by bm_dayclosedate,bm_billtime ASC";
 	  $sql_login  =  $database->mysqlQuery("select IFNULL($string1_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
    $return.="Cash                                          " .number_format($result_login['tot'],$decimal)." ";
				$return.="\r\n";
	 ?>
 
  <?php } }
  
  
  
  $sql_login  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
    $return.="Credit                                        ".number_format($result_login['tot'],$decimal)."";
					$return.="\r\n";
					//$return.=round($result_login['tot']);
	 ?>
  
   
  <?php } }
  
  else
  {
	  	$return.="Credit                                        0.00";
					$return.="\r\n";
  }
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string3_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				$subtotal =$subtotal + $result_login['tot'];
					$return.="Coupons                                       ".number_format($result_login['tot'],$decimal)."";
					//$return.=round($result_login['tot']);
					$return.="\r\n";
	 ?>
 
  <?php } }
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string4_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
					$return.="Voucher                                       ".number_format($result_login['tot'],$decimal)."";
					$return.="\r\n";
					
	 ?>
 
  <?php } }
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string5_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Cheque                                        ".number_format($result_login['tot'],$decimal)."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  
  
  
    $sql_login  =  $database->mysqlQuery("select IFNULL($string6_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Credits                                       ".number_format($result_login['tot'],$decimal)."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string7_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal1 =$subtotal1 + $result_login['tot'];
				
				$return.="Complimentary                                 ".number_format($result_login['tot'],$decimal)."";
						$return.="\r\n";	
						
							
	 ?>

  <?php } }
  
  
  
/*  $bev_tot =0;
		    $sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) = 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) = 'COLD BEVERAGES' ))ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = $database->mysqlFetchArray($sql_login)) 
				{
						/*if($result_report['tot'] != "")
						{*/
					/*	$bev_tot=$bev_tot+$result_report['Total'];
					$subtotal =$subtotal + $result_report['Total'];
					
						if($result_report['Total'] != "")
						{
					$return.="Beverage Sale                                 ".$result_report['Total']."";
						$return.="\r\n";	
						}
						else
						{
							$return.="Beverage Sale                                 0.00";
						$return.="\r\n";	
						}
					*/
					
					
			/*	}*/
/*		  }}
		  
		  
		  
		  
		  $food_tot=0;
		   $sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) != 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) != 'COLD BEVERAGES' ))ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = $database->mysqlFetchArray($sql_login)) 
				{
						
					$subtotal =$subtotal + $result_report['Total'];
					$food_tot=$food_tot+$result_report['Total'];
					if($result_report['Total'] != "")
						{
					$return.="Food Sale                                     ".$result_report['Total']."";
						$return.="\r\n";	
						}
						else
						{
							$return.="Food Sale                                     0.00";
						$return.="\r\n";	
						}
					
		  }}
		  */
		  
		  
		  
		  
		  
		  
		 /* 	$tot_per=$food_tot+$bev_tot;
			
			$food_per=$food_tot/$tot_per*100;
			$bev_per=$bev_tot/$tot_per*100;
			
				$return.="Food Sale(%)                                  ".round($food_per,2)."";
						$return.="\r\n";	
							
			
			
				$return.="Beverages Sale(%)                             ".round($bev_per,2)."";
						$return.="\r\n";	
							*/
			
  
  
  	 $qtycount=0;
  $sql_login  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$qtycount=$qtycount + $result_login['ct'];
				
				$return.="Total Pax                                     ".$qtycount."";
						$return.="\r\n";	
						
							
	 ?>

  <?php } }
  
  
  
   /*$bilcount=0;
  $sql_login  =  $database->mysqlQuery("SELECT count(bm_billno) as bills FROM `tbl_tablebillmaster` WHERE $string_pax"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$bilcount=$bilcount + $result_login['bills'];
				
				$return.="No.Of Invoices                                ".$bilcount."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }*/
  
  
        $return.="---------------------------------------------------------";	
  
  	$return.="\r\n";
  	$return.="TOTAL -                                       ".number_format($subtotal,$decimal)."";
	$return.="\r\n";
        $return.="---------------------------------------------------------";
	//$return.="\r\n";
}
////////////////////////Turn over Report start_new////////////////////////////
else if($_SESSION['type']=="turnover_report")
{
	
	
		
		
		
	/* ******************************************** Category master ******************************************************* */

 
 ?> 
  

  
   
  <?php
  $strin="";
	$strngs=" ter_status='Closed' AND ";
  $string='';
  $reporthead="";
$string12='';
$string13='';
//	$strings=" bm_status='Closed' AND ";
//	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
//	$string2_str=" sum(bm_transactionamount) ";
//	$string3_str=" sum(bm_finaltotal) ";
//	$string4_str=" sum(bm_finaltotal) ";
//	$string5_str=" sum(bm_finaltotal) ";
//	
//	$string6_str=" sum(bm_finaltotal)";
//		$string7_str=" sum(bm_finaltotal)";
//		$string_pax="";
//	$string_pax=" bm_status='Closed' AND ";
//$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary'))  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
//		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
//		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
//		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
//		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
//	$string6=$strings. " pym_code='credit_person' AND ";
//	$string7=$strings. " pym_code='complimentary' AND";
	

			
                        
                         $string12= $datedayclose;
                         $string13=$datedayclose;
                        
                        
			//$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="       On =".$datedayclose; 
				//$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
				
					//$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";	
			
	
	?>
    <?php 
	
		
//			$return.="-----------------------------------------------------";	
				$return.="\r\n";
                                $return.="\r\n";
                                $return.="\r\n";

	$return.="               Turnover Report" ;
	$return.="\r\n";
	$return.="          ".$reporthead;
	$return.="\r\n";
	$return.="---------------------------------------------------------";	
	$return.="\r\n";
	$return.="Type                                          Value";
	$return.="\r\n";
	$return.="---------------------------------------------------------";	
    $return.="\r\n";
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
       $cur=date("d-m-Y");
	// echo "select $string1_str as tot from tbl_tablebillmaster where $string1"."$string order by bm_dayclosedate,bm_billtime ASC";
 	   $database->mysqlQuery("SET @fromdate = " . "'" . $string12 . "'");
		$database->mysqlQuery("SET @todate = " . "'" . $string13 . "'");
		//$database->mysqlQuery("SET @total_vat = " . "'" . $total_vat . "'");
		//$database->mysqlQuery("SET @net_turnover = " . "'" . $net_turnover . "'");   
		  $gross_turnover='';
        $total_ser_tax='';
        $total_vat='';
        $net_turnover='';
      	$sq=$database->mysqlQuery("CALL proc_total_turnover(@fromdate,@todate,@gross_turnover,@total_ser_tax,@total_vat,@total_tax,@net_turnover)");
	$rs = $database->mysqlQuery( 'SELECT @gross_turnover AS gross_turnover');
        $rs1 = $database->mysqlQuery( 'SELECT  @total_ser_tax AS total_ser_tax ');
        $rs2 = $database->mysqlQuery( 'SELECT  @net_turnover AS net_turnover');
	while($row = mysqli_fetch_array($rs))
	{
	$g= $row['gross_turnover'];
				//$subtotal =$subtotal + $result_login['tot'];
    $return.="GROSS TURN OVER                               " .number_format($g,$decimal)." ";
				$return.="\r\n";
	 ?>
 
  <?php //} 
  
        }
  
  
  
  $database->mysqlQuery("SET @fromdate = " . "'" . $string12 . "'");
		$database->mysqlQuery("SET @todate = " . "'" . $string13 . "'");
		//$database->mysqlQuery("SET @total_vat = " . "'" . $total_vat . "'");
		//$database->mysqlQuery("SET @net_turnover = " . "'" . $net_turnover . "'"); 
          
        $gross_turnover='';
        $total_ser_tax='';
        $total_vat='';
        $net_turnover='';
      	$sq=$database->mysqlQuery("CALL proc_total_turnover(@fromdate,@todate,@gross_turnover,@total_ser_tax,@total_vat,@total_tax,@net_turnover)");
	$rs = $database->mysqlQuery( 'SELECT @gross_turnover AS gross_turnover');
        $rs1 = $database->mysqlQuery( 'SELECT  @total_ser_tax AS total_ser_tax ');
        $rs2 = $database->mysqlQuery( 'SELECT  @net_turnover AS net_turnover');
	
        while($row = mysqli_fetch_array($rs1))
	{
        $t= $row['total_ser_tax'];
				//$subtotal =$subtotal + $result_login['tot'];
    $return.="TOTAL SERVICE TAX                             ".number_format($t,$decimal)."";
					$return.="\r\n";
					//$return.=round($result_login['tot']);
	 ?>
  
   
  <?php //} 
  
        }
  
  
  $database->mysqlQuery("SET @fromdate = " . "'" . $string12 . "'");
		$database->mysqlQuery("SET @todate = " . "'" . $string13 . "'");
		//$database->mysqlQuery("SET @total_vat = " . "'" . $total_vat . "'");
		//$database->mysqlQuery("SET @net_turnover = " . "'" . $net_turnover . "'"); 
          
        $gross_turnover='';
        $total_ser_tax='';
        $total_vat='';
        $net_turnover='';
      	$sq=$database->mysqlQuery("CALL proc_total_turnover(@fromdate,@todate,@gross_turnover,@total_ser_tax,@total_vat,@total_tax,@net_turnover)");
	$rs = $database->mysqlQuery( 'SELECT @gross_turnover AS gross_turnover');
        $rs1 = $database->mysqlQuery( 'SELECT  @total_ser_tax AS total_ser_tax ');
        $rs2 = $database->mysqlQuery( 'SELECT  @net_turnover AS net_turnover');
        $rs3 = $database->mysqlQuery( 'SELECT  @total_vat AS total_vat');
	
while($row = mysqli_fetch_array($rs3))
	{

       $v= $row['total_vat'];
				//$subtotal =$subtotal + $result_login['tot'];
				//$subtotal =$subtotal + $result_login['tot'];
					$return.="TOTAL VAT                                     ".number_format($v,$decimal)."";
					//$return.=round($result_login['tot']);
					$return.="\r\n";
	 ?>
 
  <?php //} 
  
        }
        
        
         $database->mysqlQuery("SET @fromdate = " . "'" . $string12 . "'");
		$database->mysqlQuery("SET @todate = " . "'" . $string13 . "'");
		//$database->mysqlQuery("SET @total_vat = " . "'" . $total_vat . "'");
		//$database->mysqlQuery("SET @net_turnover = " . "'" . $net_turnover . "'"); 
          
        $gross_turnover='';
        $total_ser_tax='';
        $total_vat='';
        $net_turnover='';
      	$sq=$database->mysqlQuery("CALL proc_total_turnover(@fromdate,@todate,@gross_turnover,@total_ser_tax,@total_vat,@total_tax,@net_turnover)");
	$rs = $database->mysqlQuery( 'SELECT @gross_turnover AS gross_turnover');
        $rs1 = $database->mysqlQuery( 'SELECT  @total_ser_tax AS total_ser_tax ');
        $rs2 = $database->mysqlQuery( 'SELECT  @net_turnover AS net_turnover');
        $rs5= $database->mysqlQuery( 'SELECT  @total_tax AS total_tax');
	
        while($row = mysqli_fetch_array($rs5))
	{
        $tax= $row['total_tax'];
				//$subtotal =$subtotal + $result_login['tot'];
    $return.="TOTAL TAX                                     ".number_format($tax,$decimal)."";
					$return.="\r\n";
					//$return.=round($result_login['tot']);
	 ?>
  
   
  <?php //} 
  
        }
        
  
  $database->mysqlQuery("SET @fromdate = " . "'" . $string12 . "'");
		$database->mysqlQuery("SET @todate = " . "'" . $string13 . "'");
		//$database->mysqlQuery("SET @total_vat = " . "'" . $total_vat . "'");
		//$database->mysqlQuery("SET @net_turnover = " . "'" . $net_turnover . "'"); 
          
        $gross_turnover='';
        $total_ser_tax='';
        $total_vat='';
        $net_turnover='';
      	$sq=$database->mysqlQuery("CALL proc_total_turnover(@fromdate,@todate,@gross_turnover,@total_ser_tax,@total_vat,@total_tax,@net_turnover)");
	$rs = $database->mysqlQuery( 'SELECT @gross_turnover AS gross_turnover');
        $rs1 = $database->mysqlQuery( 'SELECT  @total_ser_tax AS total_ser_tax ');
        $rs2 = $database->mysqlQuery( 'SELECT  @net_turnover AS net_turnover');
	
        while($row = mysqli_fetch_array($rs2))
	{

       $n= $row['net_turnover'];
				//$subtotal =$subtotal + $result_login['tot'];
			$return.="NET TURN OVER                                 ".number_format($n,$decimal)."";
				$return.="\r\n";
					
	 ?>
 
  <?php }
  //}
  
 
  
        $return.="---------------------------------------------------------";	
  
  	$return.="\r\n";
//  	$return.="TOTAL -                                       ".round($subtotal)."";
//	$return.="\r\n";
//        $return.="-----------------------------------------------------";
	//$return.="\r\n";
}
//////////////////////////Turn over Report end_new/////////////////////////////
/////////////////////////////////////Cancel History Report Start////////////////////////////////////////////////
else if($_SESSION['type']=="cancel_history")
	{
		
		
   $reporthead="";
 
  
 

 ?> 
   
      <?php
     $string=""; 

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= "ch.ch_dayclosedate ='".$datedayclose."' ";
			$reporthead.="On ".date('Y-m-d',strtotime($datedayclose)) ; 
		
		
//			$return.="-----------------------------------------------------";	
		$menulist= array(
                        new report_head("Dine In"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head("Cancel History Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
               
//			


?>
  
	<?php
	$return.="\r\n";
        $return.="----------------------------------------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new cancel_history("Slno","KOT No","Menu","Qty","Staff Name","Login"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
        $return.="----------------------------------------------------------------------------------------------------";                
	$return.="\r\n";
	
	
	
  $fuldet1=0;
  $kot=0;
  $cancel=0;
  $ser=0;
  $user=0;
  $chr=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("Select  ch.ch_dayclosedate,ch_kotno,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,ld.ls_username,m.mr_menuname From tbl_tableorder_changes as ch LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_cancelledby_careof left join tbl_logindetails as ld on ld.ls_username=ch.ch_cancelledlogin left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid where  $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
              $i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{

                        $kot=$kot + $result_login['ch_kotno'];
                        $fuldet1=$fuldet1 + $result_login['mr_menuname'];
			$cancel=$cancel +$result_login['ch_cancelled_qty'];
			$ser=$ser + $result_login['ser_firstname'];
                        $user=$user +$result_login['ls_username'];
			$chr=$result_login['ch_cancelledreason'];
                        
                              if(is_numeric($chr)){
                              $sql_loginreason  =  $database->mysqlQuery("select cr_id,cr_reason from tbl_cancellation_reasons where cr_id='".$chr."'");  
                              $num_loginreason=$database->mysqlNumRows($sql_loginreason);
                              if($num_loginreason){
                                   $result_loginreason  = $database->mysqlFetchArray($sql_loginreason);
                                   $chr=$result_loginreason['cr_reason'];
                              }
                              }
                        
                        
                        $return.="\r\n";
                        $menulist= array(
                        new cancel_history($i,$result_login['ch_kotno'],$result_login['mr_menuname'],$result_login['ch_cancelled_qty'],$result_login['ser_firstname'],$result_login['ls_username']),
                            );
                        foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                        $return.="\r\n";
                        $menulist= array(
                        new cancel_history("","Reason - ",$chr,"","",""),
                            );
                        foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                        $return.="\r\n";
                        
			$i++;
			
			}
	  }
            
            $return.="----------------------------------------------------------------------------------------------------";
		$return.="\r\n";	
	}
/////////////////////////////////Cancel History Report End//////////////////////////////////////////////////
	
 /////////////////////////Bill Cancel Report start///////////////////////////////////////////////////////////
else if($_SESSION['type']=="bill_cancel")
{
		
		
   $reporthead="";
  
  
 

 ?> 
   
      <?php
  $string="bm_status='Cancelled' AND  ";
    // $string=""; 

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= "b.bm_dayclosedate ='".$datedayclose."' ";
			$reporthead.="On ".date('Y-m-d',strtotime($datedayclose)); 
		
		
//			$return.="-----------------------------------------------------------------------------------------------------------";	
		$menulist= array(
                        new report_head("Dine In"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head("Bill Cancel Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
               
                        
                        
                        
                        


?>
  
	<?php
	$return.="\r\n";
        $return.="----------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new menulist("Slno","Billno","Bill Total", "Cancelled By"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
	$return.="\r\n";

  $bill=0;
  $final=0;
  $ser=0;
  $chr=0;
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select DISTINCT b.bm_dayclosedate,b.bm_billno,b.ter_cancelledreason,b.bm_finaltotal,b.ter_cancelledlogin,s.ser_firstname,s.ser_lastname from tbl_tablebillmaster b left join tbl_staffmaster s on b.ter_cancelledby_careof=s.ser_staffid where $string order by b.bm_dayclosedate"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
              $i=1; $cancelledreason="";
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   
                      
                            $cancelledreason= $result_login['ter_cancelledreason'];
                              if(is_numeric($cancelledreason)){
                              $sql_loginreason  =  $database->mysqlQuery("select cr_id,cr_reason from tbl_cancellation_reasons where cr_id='".$cancelledreason."'");  
                              $num_loginreason=$database->mysqlNumRows($sql_loginreason);
                              if($num_loginreason){
                                   $result_loginreason  = $database->mysqlFetchArray($sql_loginreason);
                                   $cancelledreason=$result_loginreason['cr_reason'];
                              }
                        }
                        $bill=$bill + $result_login['bm_billno'];
                        $final=$final + $result_login['bm_finaltotal'];
			$ser=$ser + $result_login['ser_firstname'];
                        $chr=$chr + $result_login['ter_cancelledreason'];	
                        $subtotal=$subtotal + $result_login['bm_finaltotal'];
                        $menulist= array(
                                new menulist($i,$result_login['bm_billno'],number_format($result_login['bm_finaltotal'],$decimal), $result_login['ser_firstname']),
                            );
                            foreach($menulist as $menulist) {
					$return .=($menulist);
                                        
                            }
                            $return.="\r\n";
                          $menulist= array(
                                new menulist("Reason - ",$cancelledreason,"",""),
                            );
                            foreach($menulist as $menulist) {
					$return .=($menulist);
                                        
                            }    
                            $return.="\r\n";
			$i++;
			
			}
	  }
		$return.="\r\n";
                $return.="----------------------------------------------------------------------";
                $return.="\r\n";
                $menulist= array(
                        new menulist("Total","",number_format($subtotal,$decimal), ""),
                    );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
	$return.="\r\n";	
	}
 /////////////////////////////////Bill Cancel Report End///////////////////////////////////////////////////////        
else if( $_SESSION['type']=="totalsales_cs")
{
		
		
		
   $reporthead="";
  
 
 ?> 
   
      <?php
  $string=" tab_status='Closed' AND tab_mode='CS' AND ";
	
                        $from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= "tab_dayclosedate ='".$datedayclose."' ";
				$reporthead.="On ".date('Y-m-d',strtotime($datedayclose)); 
				

		
		 $menulist= array(
                        new report_head("Counter Sale"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head("Total Sales Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
               
		
		 


?>
  
	<?php
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new menulist("Slno","Date","Billno", "Final"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
        $return.="\r\n";
    ?>

<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $i=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate ASC"); 
	  
          //echo "select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate ASC";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
                      
			$final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$bal=$bal + $result_login['tab_amountbalace'];
			$dsc=$dsc + $result_login['tab_discountvalue'];
			$srvtx=$srvtx + $result_login['tab_servicetax'];
                        if($result_login['tab_paymode']!=7){
                            $i++;
			$subtotal=$subtotal + $result_login['tab_netamt'];
			
                        $menulist= array(
                                new menulist($i,$database->convert_date($result_login['tab_dayclosedate']),$result_login['tab_billno'], number_format($result_login['tab_netamt'],$decimal)),
                            );
                            foreach($menulist as $menulist) {
					$return .=($menulist);
                            }
                            $return.="\r\n";
			 }
			}
                    }

			$return.="\r\n";
			
			$return.="----------------------------------------------------------------------";
			$return.="\r\n";
                        $menulist= array(
                        new menulist("Bills-".($i),"Total","",number_format($subtotal,$decimal)),
                            );
                                foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                        $return.="\r\n";
		        
                        $return.="----------------------------------------------------------------------";
                        $return.="\r\n";
                        
	}
else if($_SESSION['type']=="itemordered_cs")
{
		
		
   $reporthead="";
 
  
 

 ?> 
   
      <?php
  $string=" tbm.tab_status='Closed' AND tbm.tab_mode='CS' AND ";

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= " tbm.tab_dayclosedate ='".$datedayclose."' ";
			$reporthead.="      On =".date('Y-m-d',strtotime($datedayclose)) ; 
		
		
		
//			$return.="-----------------------------------------------------";	
		$return.="\r\n";
                $return.="\r\n";
                $return.="                    Counter Sale" ;
                $return.="\r\n";
		$return.="                Items Ordered Report" ;
                $return.="\r\n";
	
$return.="           ".$reporthead   ;


?>
  
	<?php
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
	$return.="\r\n";
	/*$return.="Slno  Date       BillNo    Final     ";*/
	/*$return.="Slno  Date        BillNo                      Final     ";*/
	$return.="Slno  Item                                  ";
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
        $return.="\r\n";



	
    ?>

<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tbd.tab_qty) as qty,ROUND(avg(tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND(avg(tbd.tab_rate), 1)))  as Total from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno  left join tbl_menumaster m on m.mr_menuid = tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tab_portion where (m.mr_manualrateentry != 'Y') and $string group by m.mr_maincatid ,m.mr_subcatid,tab_menuid,tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 
	  
          //echo"SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tbd.tab_qty) as qty,ROUND(avg(tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND(avg(tbd.tab_rate), 1)))  as Total from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno  left join tbl_menumaster m on m.mr_menuid = tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tab_portion where (m.mr_manualrateentry != 'Y') and $string group by m.mr_maincatid ,m.mr_subcatid,tab_menuid,tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['Total'];
			
			//$return.=$i.'    ';
			
			 $sl=$i;
			if($sl < '10')
			{
				$return.=$i.'    ';
				//$return.=$i.'    ';
				
			}
			elseif($sl <'100')
			{
				$return.=$i.'   ';
				
			}
			else
			{
				$return.=$i.'  ';
			}
			
			
			
			
			
			
			
	$return.=$result_login['mr_menuname']."(".$result_login['pm_portionname'].")";
		//$return.='                        ';
		
	//	$return.=$result_login['fr_floorname'];
		
		
	//	$return.='           ';
	$return.="\r\n";
	
			//$return.='                                  ';	
			//$return.='                                  ';	
			
			if($sl < '10')
			{
				$return.='     ';
				//$return.=$i.'    ';
				
			}
			elseif($sl <'100')
			{
				$return.='     ';
				
			}
			else
			{
				$return.='     ';
			}
			
			
			
			//$return.=$result_login['fr_floorname'];
			//	$return.='     ';
			$return.='                 ';
			$return.=      $result_login['qty'].'*'.number_format($result_login['Unit_Price'],$decimal).'   =   ';
			//$return.='                               ';
			//$return.='                      ';
			$return.=   number_format($result_login['Total'],$decimal);
		
			$return.="\r\n";	
			/*$return.="\r\n";	*/
			$i++;
			
			}
	  }

			$return.="\r\n";
			$return.="-----------------------------------------------------";	
			$return.="\r\n";
$return.="TOTAL -                                 ".number_format($final,$decimal)."";
	//$return.="TOTAL -                                      ".$final."";
		$return.="\r\n";	
		        $return.="------------------------------------------------------";	
	//$return.="\r\n";
  //$return.="\r\n";
                        
                        
                        ////////////dynamic reportt itemoredered/////////
                       //$return.="-----------------------------------------------------";	
		$return.="\r\n";
                $return.="\r\n";
                $return.="                      Counter Sale" ;
                $return.="\r\n";
		$return.="            Items Ordered Report (Dynamic Rates)" ;
	        $return.="\r\n";
	
                $return.="           ".$reporthead   ;


?>
  
	<?php
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
	$return.="\r\n";
	/*$return.="Slno  Date       BillNo    Final     ";*/
	/*$return.="Slno  Date        BillNo                      Final     ";*/
	$return.="Slno  Item                                  ";
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
$return.="\r\n";



	
    ?>

<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tbd.tab_qty) as qty,ROUND((tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND((tbd.tab_rate), 1)))  as Total from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno  left join tbl_menumaster m on m.mr_menuid = tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tab_portion where (m.mr_manualrateentry ='Y') and $string group by m.mr_maincatid ,m.mr_subcatid,tab_menuid,tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 
	  
          //echo"SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tbd.tab_qty) as qty,ROUND((tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND((tbd.tab_rate), 1)))  as Total from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno  left join tbl_menumaster m on m.mr_menuid = tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tab_portion where (m.mr_manualrateentry ='Y') and $string group by m.mr_maincatid ,m.mr_subcatid,tab_menuid,tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['Total'];
			
			//$return.=$i.'    ';
			
			 $sl=$i;
			if($sl < '10')
			{
				$return.=$i.'    ';
				//$return.=$i.'    ';
				
			}
			elseif($sl <'100')
			{
				$return.=$i.'   ';
				
			}
			else
			{
				$return.=$i.'  ';
			}
			
			
			
			
			
			
			
	$return.=$result_login['mr_menuname']."(".$result_login['pm_portionname'].")";
		//$return.='                        ';
		
	//	$return.=$result_login['fr_floorname'];
		
		
	//	$return.='           ';
	$return.="\r\n";
	
			//$return.='                                  ';	
			//$return.='                                  ';	
			
			if($sl < '10')
			{
				$return.='     ';
				//$return.=$i.'    ';
				
			}
			elseif($sl <'100')
			{
				$return.='     ';
				
			}
			else
			{
				$return.='     ';
			}
			
			
			
			//$return.=$result_login['fr_floorname'];
			//	$return.='     ';
			$return.='                 ';
			$return.=      $result_login['qty'].'*'.number_format($result_login['Unit_Price'],$decimal).'   =   ';
			//$return.='                               ';
			//$return.='                      ';
			$return.=   number_format($result_login['Total'],$decimal);
		
			$return.="\r\n";	
			/*$return.="\r\n";	*/
			$i++;
			
			}
	  }

			$return.="\r\n";
			$return.="-----------------------------------------------------";	
			$return.="\r\n";
$return.="TOTAL -                               ".number_format($final,$decimal)."";
	//$return.="TOTAL -                                      ".$final."";
		$return.="\r\n";	
		        $return.="------------------------------------------------------";	
	//$return.="\r\n";
  //$return.="\r\n";
	
                     
                        ////////////////dynamic reportt itemorederedends//////////
  	}
else if($_SESSION['type']=="billcancel_cs")
{
		
		
   $reporthead="";
  
  
 
 ?> 
   
      <?php
  $string=" tbm.tab_status='Cancelled' AND tbm.tab_mode='CS' AND ";
                        
                        $from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= "tbm.tab_dayclosedate ='".$datedayclose."' ";
			$reporthead.="On ".date('Y-m-d',strtotime($datedayclose)) ; 
				
		
		
//			$return.="-----------------------------------------------------------------------------------------------------------";	
		$menulist= array(
                        new report_head("Counter Sale"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head("Bill Cancel Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                
                        
                        
                        
                        


?>
  
	<?php
	$return.="\r\n";
        $return.="----------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new menulist("Slno","BillNo","Bill Total", "Cancelled By"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
        $return.="\r\n";
	



	
    ?>

<?php
	
	
//  $fuldet1=0;
//  $fuldet=0;
  $bill=0;
  $final=0;
  $ser=0;
  $chr=0;
 
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_staffmaster s on tbd.tab_cancelledby_careof=s.ser_staffid where $string group by tbd.tab_billno order by tbm.tab_dayclosedate ASC"); 
	  
          //echo "select * from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_staffmaster s on tbd.tab_cancelledby_careof=s.ser_staffid where $string group by tbd.tab_billno order by tbm.tab_dayclosedate ASC";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$bal=$bal + $result_login['tab_amountbalace'];
			$dsc=$dsc + $result_login['tab_discountvalue'];
			$srvtx=$srvtx + $result_login['tab_servicetax'];
			$subtotal=$subtotal + $result_login['tab_netamt'];
			//$return.=$i.'    ';
			$cancelledreason= $result_login['tab_cancelledreason'];
                              if(is_numeric($cancelledreason)){
                              $sql_loginreason  =  $database->mysqlQuery("select cr_id,cr_reason from tbl_cancellation_reasons where cr_id='".$cancelledreason."'");  
                              $num_loginreason=$database->mysqlNumRows($sql_loginreason);
                              if($num_loginreason){
                                   $result_loginreason  = $database->mysqlFetchArray($sql_loginreason);
                                   $cancelledreason=$result_loginreason['cr_reason'];
                              }
                              }
                    
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist($i,$result_login['tab_billno'],number_format($result_login['tab_netamt'],$decimal), $result_login['ser_firstname']),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=($menulist);
                                    }
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist("Reason",$cancelledreason,"",""),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=($menulist);
                                    }
                    $return.="\r\n";
                    
                 
			$i++;
			
			}
	  }
		$return.="\r\n";
                $return.="----------------------------------------------------------------------";
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist("TOTAL","",number_format($subtotal,$decimal),""),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=($menulist);
                                    }
                    $return.="\r\n";
                    $return.="----------------------------------------------------------------------";
                    $return.="\r\n";	
	}
else if( $_SESSION['type']=="tot_sales_ta")
{
		
		
		
   $reporthead="";
  
  
 
 ?> 
   
      <?php
  $string=" tab_status='Closed' AND tab_mode='TA' AND ";

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= "tab_dayclosedate ='".$datedayclose."' ";
			$reporthead.="On ".date('Y-m-d',strtotime($datedayclose)) ; 
				
		
		
		 $return.="\r\n";	
		$menulist= array(
                        new report_head("Take Away"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head("Total Sales Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
               
		
		 


?>
  
	<?php
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new menulist("Slno","Date","Billno", "Final"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
        $return.="\r\n";
    ?>

<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $i=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate ASC"); 
	  
          //echo "select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate ASC";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
                     
			$final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$bal=$bal + $result_login['tab_amountbalace'];
			$dsc=$dsc + $result_login['tab_discountvalue'];
			$srvtx=$srvtx + $result_login['tab_servicetax'];
                        if($result_login['tab_paymode']!=7){
                             $i++;
			$subtotal=$subtotal + $result_login['tab_netamt'];
			
                        $menulist= array(
                                new menulist($i,$database->convert_date($result_login['tab_dayclosedate']),$result_login['tab_billno'], number_format($result_login['tab_netamt'],$decimal)),
                            );
                            foreach($menulist as $menulist) {
					$return .=($menulist);
                            }
                            $return.="\r\n";
			
                        }
			}
	  }

			$return.="\r\n";
			
			$return.="----------------------------------------------------------------------";
			$return.="\r\n";
                        $menulist= array(
                        new menulist("Bills-".($i),"Total","",number_format($subtotal,$decimal)),
                            );
                                foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                        $return.="\r\n";
		        
                        $return.="----------------------------------------------------------------------";
			
                       $return.="\r\n";
//  $return.="\r\n";
	}
else if( $_SESSION['type']=="tot_sales_hd")
{
		
		
		
   $reporthead="";
  
 
 ?> 
   
      <?php
  $string=" tab_status='Closed' AND tab_mode='HD' AND ";

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= "tab_dayclosedate ='".$datedayclose."' ";
				$reporthead.="On ".date('Y-m-d',strtotime($datedayclose)) ; 
				
				
			
				
		
		 $menulist= array(
                        new report_head("Home Delivery"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head("Total Sales Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
//                
			
				
		
		 


?>
  
	<?php
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new menulist("Slno","Date","Billno", "Final"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
        $return.="\r\n";
    ?>

<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $i=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate ASC"); 
	  
          //echo "select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate ASC";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
                     
			$final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$bal=$bal + $result_login['tab_amountbalace'];
			$dsc=$dsc + $result_login['tab_discountvalue'];
			$srvtx=$srvtx + $result_login['tab_servicetax'];
                        if($result_login['tab_paymode']!=7){
                             $i++;
			$subtotal=$subtotal + $result_login['tab_netamt'];
			$menulist= array(
                                new menulist($i,$database->convert_date($result_login['tab_dayclosedate']),$result_login['tab_billno'], number_format($result_login['tab_netamt'],$decimal)),
                            );
                            foreach($menulist as $menulist) {
					$return .=($menulist);
                            }
                            $return.="\r\n";
			
                        }
			}
	  }

			$return.="\r\n";
			
			$return.="----------------------------------------------------------------------";
			$return.="\r\n";
                        $menulist= array(
                        new menulist("Bills-".($i),"Total","",number_format($subtotal,$decimal)),
                            );
                                foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                        $return.="\r\n";
		        
                        $return.="----------------------------------------------------------------------";
			
                        $return.="\r\n";

	}        
else if($_SESSION['type']=="order_ta")
{
		
		
   $reporthead="";
  
 

 ?> 
   
      <?php
  $string=" tbm.tab_status='Closed' AND tbm.tab_mode='TA' AND ";

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= " tbm.tab_dayclosedate ='".$datedayclose."' ";
			$reporthead.="      On =".$datedayclose ; 
		
		
//			$return.="-----------------------------------------------------";	
		$return.="\r\n";
                $return.="\r\n";
                $return.="                    Take Away" ;
                $return.="\r\n";
		$return.="                Items Ordered Report" ;
	$return.="\r\n";
	
$return.="           ".$reporthead   ;


?>
  
	<?php
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
	$return.="\r\n";
	/*$return.="Slno  Date       BillNo    Final     ";*/
	/*$return.="Slno  Date        BillNo                      Final     ";*/
	$return.="Slno  Item                                  ";
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
$return.="\r\n";



	
    ?>

<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tbd.tab_qty) as qty,ROUND(avg(tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND(avg(tbd.tab_rate), 1)))  as Total from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno  left join tbl_menumaster m on m.mr_menuid = tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tab_portion where (m.mr_manualrateentry != 'Y') and $string group by m.mr_maincatid ,m.mr_subcatid,tab_menuid,tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 
	  
          //echo"SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tbd.tab_qty) as qty,ROUND(avg(tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND(avg(tbd.tab_rate), 1)))  as Total from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno  left join tbl_menumaster m on m.mr_menuid = tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tab_portion where (m.mr_manualrateentry != 'Y') and $string group by m.mr_maincatid ,m.mr_subcatid,tab_menuid,tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['Total'];
			
			//$return.=$i.'    ';
			
			 $sl=$i;
			if($sl < '10')
			{
				$return.=$i.'    ';
				//$return.=$i.'    ';
				
			}
			elseif($sl <'100')
			{
				$return.=$i.'   ';
				
			}
			else
			{
				$return.=$i.'  ';
			}
			
			
			
			
			
			
			
	$return.=$result_login['mr_menuname']."(".$result_login['pm_portionname'].")";
		//$return.='                        ';
		
	//	$return.=$result_login['fr_floorname'];
		
		
	//	$return.='           ';
	$return.="\r\n";
	
			//$return.='                                  ';	
			//$return.='                                  ';	
			
			if($sl < '10')
			{
				$return.='     ';
				//$return.=$i.'    ';
				
			}
			elseif($sl <'100')
			{
				$return.='     ';
				
			}
			else
			{
				$return.='     ';
			}
			
			
			
			//$return.=$result_login['fr_floorname'];
			//	$return.='     ';
			$return.='                 ';
			$return.=      $result_login['qty'].'*'.number_format($result_login['Unit_Price'],$decimal).'   =   ';
			//$return.='                               ';
			//$return.='                      ';
			$return.=   number_format($result_login['Total'],$decimal);
		
			$return.="\r\n";	
			/*$return.="\r\n";	*/
			$i++;
			
			}
	  }

			$return.="\r\n";
			$return.="-----------------------------------------------------";	
			$return.="\r\n";
                        $return.="TOTAL -                             ".number_format($final,$decimal)."";
	//$return.="TOTAL -                                      ".$final."";
		$return.="\r\n";	
		        $return.="------------------------------------------------------";	
	//$return.="\r\n";
  //$return.="\r\n";
                        
                        
                        ////////////dynamic reportt itemoredered/////////
                       //$return.="-----------------------------------------------------";	
		$return.="\r\n";
                $return.="\r\n";
                $return.="                     Take Away" ;
                $return.="\r\n";
		$return.="            Items Ordered Report (Dynamic Rates)" ;
	        $return.="\r\n";
	
                $return.="           ".$reporthead   ;


?>
  
	<?php
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
	$return.="\r\n";
	/*$return.="Slno  Date       BillNo    Final     ";*/
	/*$return.="Slno  Date        BillNo                      Final     ";*/
	$return.="Slno  Item                                  ";
	$return.="\r\n";
	$return.="-----------------------------------------------------";	
$return.="\r\n";



	
    ?>

<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tbd.tab_qty) as qty,ROUND((tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND((tbd.tab_rate), 1)))  as Total from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno  left join tbl_menumaster m on m.mr_menuid = tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tab_portion where (m.mr_manualrateentry ='Y') and $string group by m.mr_maincatid ,m.mr_subcatid,tab_menuid,tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 
	  
          //echo"SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tbd.tab_qty) as qty,ROUND((tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND((tbd.tab_rate), 1)))  as Total from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno  left join tbl_menumaster m on m.mr_menuid = tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tab_portion where (m.mr_manualrateentry ='Y') and $string group by m.mr_maincatid ,m.mr_subcatid,tab_menuid,tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['Total'];
			
			//$return.=$i.'    ';
			
			 $sl=$i;
			if($sl < '10')
			{
				$return.=$i.'    ';
				//$return.=$i.'    ';
				
			}
			elseif($sl <'100')
			{
				$return.=$i.'   ';
				
			}
			else
			{
				$return.=$i.'  ';
			}
			
			
			
			
			
			
			
	$return.=$result_login['mr_menuname']."(".$result_login['pm_portionname'].")";
		//$return.='                        ';
		
	//	$return.=$result_login['fr_floorname'];
		
		
	//	$return.='           ';
	$return.="\r\n";
	
			//$return.='                                  ';	
			//$return.='                                  ';	
			
			if($sl < '10')
			{
				$return.='     ';
				//$return.=$i.'    ';
				
			}
			elseif($sl <'100')
			{
				$return.='     ';
				
			}
			else
			{
				$return.='     ';
			}
			
			
			
			//$return.=$result_login['fr_floorname'];
			//	$return.='     ';
			$return.='                 ';
			$return.=      $result_login['qty'].'*'.number_format($result_login['Unit_Price'],$decimal).'   =   ';
			//$return.='                               ';
			//$return.='                      ';
			$return.=   number_format($result_login['Total'],$decimal);
		
			$return.="\r\n";	
			/*$return.="\r\n";	*/
			$i++;
			
			}
	  }

			$return.="\r\n";
			$return.="-----------------------------------------------------";	
			$return.="\r\n";
$return.="TOTAL -                             ".number_format($final,$decimal)."";
	//$return.="TOTAL -                                      ".$final."";
		$return.="\r\n";	
		        $return.="------------------------------------------------------";	
	//$return.="\r\n";
  //$return.="\r\n";
	
                     
                        ////////////////dynamic reportt itemorederedends//////////
  	}
else if($_SESSION['type']=="cancel_history_ta")
{
		
		
   $reporthead="";
  
  
 
 ?> 
   
      <?php
  $string=" tbm.tab_status='Cancelled' AND tbm.tab_mode='TA' AND ";
  

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= "tbm.tab_dayclosedate ='".$datedayclose."' ";
			$reporthead.="On ".date('Y-m-d',strtotime($datedayclose)); 
				
		
		
		
//			$return.="-----------------------------------------------------------------------------------------------------------";	
		$menulist= array(
                        new report_head("Take Away"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head("Bill Cancel Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                
		
		

?>
  
	<?php
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new menulist("Slno","BillNo","Bill Total", "Cancelled By"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
        $return.="\r\n";
	



	
    ?>

<?php
	
	
//  $fuldet1=0;
//  $fuldet=0;
  $bill=0;
  $final=0;
  $ser=0;
  $chr=0;
 
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_staffmaster s on tbd.tab_cancelledby_careof=s.ser_staffid where $string group by tbd.tab_billno order by tbm.tab_dayclosedate ASC"); 
	  
          //echo "select * from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_staffmaster s on tbd.tab_cancelledby_careof=s.ser_staffid where $string group by tbd.tab_billno order by tbm.tab_dayclosedate ASC";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$bal=$bal + $result_login['tab_amountbalace'];
			$dsc=$dsc + $result_login['tab_discountvalue'];
			$srvtx=$srvtx + $result_login['tab_servicetax'];
			$subtotal=$subtotal + $result_login['tab_netamt'];
			//$return.=$i.'    ';
			$cancelledreason= $result_login['tab_cancelledreason'];
                              if(is_numeric($cancelledreason)){
                              $sql_loginreason  =  $database->mysqlQuery("select cr_id,cr_reason from tbl_cancellation_reasons where cr_id='".$cancelledreason."'");  
                              $num_loginreason=$database->mysqlNumRows($sql_loginreason);
                              if($num_loginreason){
                                   $result_loginreason  = $database->mysqlFetchArray($sql_loginreason);
                                   $cancelledreason=$result_loginreason['cr_reason'];
                              }
                              }
                    
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist($i,$result_login['tab_billno'],number_format($result_login['tab_netamt'],$decimal), $result_login['ser_firstname']),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=($menulist);
                                    }
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist("Reason",$cancelledreason,"",""),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=($menulist);
                                    }
                    $return.="\r\n";
                    
                 
			$i++;
			
			}
	  }
		$return.="\r\n";
                $return.="----------------------------------------------------------------------";
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist("TOTAL","",number_format($subtotal,$decimal),""),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=($menulist);
                                    }
                    $return.="\r\n";
                    $return.="----------------------------------------------------------------------";
                    $return.="\r\n";
	
	}

else if($_SESSION['type']=="cancel_history_hd")
{
		
		
   $reporthead="";
  
  
 
 ?> 
   
      <?php
  $string=" tbm.tab_status='Cancelled' AND tbm.tab_mode='HD' AND ";
  

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= "tbm.tab_dayclosedate ='".$datedayclose."' ";
			$reporthead.="On ".date('Y-m-d',strtotime($datedayclose)); 
				
		$menulist= array(
                        new report_head("Home Delivery"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head("Bill Cancel Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
               
		
		
//		


?>
  
	<?php
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new menulist("Slno","BillNo","Bill Total", "Cancelled By"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
        $return.="\r\n";
	



	
    ?>

<?php
	
	
//  $fuldet1=0;
//  $fuldet=0;
  $bill=0;
  $final=0;
  $ser=0;
  $chr=0;
 
  $subtotal=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_staffmaster s on tbd.tab_cancelledby_careof=s.ser_staffid where $string group by tbd.tab_billno order by tbm.tab_dayclosedate ASC"); 
	  
          //echo "select * from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_staffmaster s on tbd.tab_cancelledby_careof=s.ser_staffid where $string group by tbd.tab_billno order by tbm.tab_dayclosedate ASC";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$bal=$bal + $result_login['tab_amountbalace'];
			$dsc=$dsc + $result_login['tab_discountvalue'];
			$srvtx=$srvtx + $result_login['tab_servicetax'];
			$subtotal=$subtotal + $result_login['tab_netamt'];
			//$return.=$i.'    ';
			$cancelledreason= $result_login['tab_cancelledreason'];
                              if(is_numeric($cancelledreason)){
                              $sql_loginreason  =  $database->mysqlQuery("select cr_id,cr_reason from tbl_cancellation_reasons where cr_id='".$cancelledreason."'");  
                              $num_loginreason=$database->mysqlNumRows($sql_loginreason);
                              if($num_loginreason){
                                   $result_loginreason  = $database->mysqlFetchArray($sql_loginreason);
                                   $cancelledreason=$result_loginreason['cr_reason'];
                              }
                              }
                    
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist($i,$result_login['tab_billno'],number_format($result_login['tab_netamt'],$decimal), $result_login['ser_firstname']),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=($menulist);
                                    }
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist("Reason",$cancelledreason,"",""),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=($menulist);
                                    }
                    $return.="\r\n";
                    
                 
			$i++;
			
			}
	  }
		$return.="\r\n";
                $return.="----------------------------------------------------------------------";
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist("TOTAL","",number_format($subtotal,$decimal),""),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=($menulist);
                                    }
                    $return.="\r\n";
                    $return.="----------------------------------------------------------------------";
                    $return.="\r\n";
			
	}        
        
        
else if($_SESSION['type']=="summary_cs")
{
	
	
		
		
		
	/* ******************************************** Category master ******************************************************* */
	  

 
 
 ?> 
  

  
   
  <?php
  $strin="";
	$strngs=" tbm.tab_status='Closed' AND tbm.tab_mode='CS' AND ";
  $string='';
  $reporthead="";
	$strings=" tbm.tab_status='Closed' AND tbm.tab_mode='CS' AND ";
	$string1_str=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(tab_transactionamount) ";
	$string3_str=" sum(tab_netamt) ";
	$string4_str=" sum(tab_netamt) ";
	$string5_str=" sum(tab_netamt) ";
	
	$string6_str=" sum(tab_netamt)";
		$string7_str=" sum(tab_netamt)";
		$string_pax="";
	$string_pax=" tbm.tab_status='Closed' AND tbm.tab_mode='CS' AND ";
                $string1 =$strings." pym_code='cash' AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= " tbm.tab_dayclosedate ='".$datedayclose."' ";
			$reporthead="       On =".$datedayclose ; 
			$string_pax.= "tbm.tab_dayclosedate  ='".$datedayclose."' ";
			$strin.=" tbm.tab_dayclosedate ='".$datedayclose."' ";	
		
	
	
	?>
    <?php 
	
		
//			$return.="-----------------------------------------------------";	
				$return.="\r\n";
                                $return.="\r\n";
                                $return.="\r\n";
         $return.="                   Counter Sale" ;
	$return.="\r\n";                       
	$return.="                  Summary Report" ;
	$return.="\r\n";
	$return.="          ".$reporthead;
	$return.="\r\n";
	$return.="---------------------------------------------------------";	
	$return.="\r\n";
	$return.="Type                                          Value";
	$return.="\r\n";
	$return.="---------------------------------------------------------";	
    $return.="\r\n";
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
       $cur=date("Y-m-d");
	// echo "select $string1_str as tot from tbl_tablebillmaster where $string1"."$string order by bm_dayclosedate,bm_billtime ASC";
 	  $sql_login  =  $database->mysqlQuery("select IFNULL($string1_str,0.00) as tot from tbl_takeaway_billmaster  tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string1"."$string order by tbm.tab_dayclosedate,tbm.tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
    $return.="Cash                                          " .number_format($result_login['tot'],$decimal)." ";
				$return.="\r\n";
	 ?>
 
  <?php } }
  
  
  
  $sql_login  =  $database->mysqlQuery("select (sum(tbm.tab_transactionamount)) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  where  $string2 "."$string  order by tbm.tab_dayclosedate,tbm.tab_time ASC"); 
 //echo "select (sum(tbm.tab_transactionamount)) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  where  $string2 "."$string  order by tbm.tab_dayclosedate,tbm.tab_time ASC";	  
  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      $tot_credit = $result_login['tot'];
			$subtotal =$subtotal + $result_login['tot'];	
    
					//$return.=round($result_login['tot']);
	 ?>
  
   
  <?php } 
 // $subtotal =$subtotal + $tot_credit;
   
  $return.="Credit                                        ".number_format($tot_credit,$decimal)."";
					$return.="\r\n";
                        }
   
  else
  {
	  	$return.="Credit                                        0.00";
					$return.="\r\n";
  }
  //echo "credit tot  ".$tot_credit;
  $sql_login  =  $database->mysqlQuery("select IFNULL($string3_str,0.00) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string3"." $string  group by tbm.tab_billno order by tab_dayclosedate,tab_time ASC "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				//$subtotal =$subtotal + $result_login['tot'];
					$return.="Coupons                                       ".number_format($result_login['tot'],$decimal)."";
					//$return.=round($result_login['tot']);
					$return.="\r\n";
	 ?>
 
  <?php } }
    else
  {
	  	$return.="Coupons                                       0.00";
					$return.="\r\n";
  }
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string4_str,0.00) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string4"." $string group by tbm.tab_billno order by tbm.tab_dayclosedate,tbm.tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
					$return.="Voucher                                       ".number_format($result_login['tot'],$decimal)."";
					$return.="\r\n";
					
	 ?>
 
  <?php } }
  
  else
  {
	  	$return.="Voucher                                       0.00";
					$return.="\r\n";
  }
  
  $sql_login  =  $database->mysqlQuery("$string5_str,0.00) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string5"." $string  group by tbm.tab_billno order by tbm.tab_dayclosedate,tbm.tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Cheque                                        ".number_format($result_login['tot'],$decimal)."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
    
  else
  {
	  	$return.="Cheque                                        0.00";
					$return.="\r\n";
  }
  
  
    $sql_login  =  $database->mysqlQuery("$string6_str,0.00) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string6"." $string  group by tbm.tab_billno order by tbm.tab_dayclosedate,tbm.tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Credits                                       ".number_format($result_login['tot'],$decimal)."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  else
  {
	  	$return.="Credits                                       0.00";
					$return.="\r\n";
  }
  
  
  $sql_login  =  $database->mysqlQuery("$string5_str,0.00) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string5"." $string  group by tbm.tab_billno order by tbm.tab_dayclosedate,tbm.tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal1 =$subtotal1 + $result_login['tot'];
				
				$return.="Complimentary                                 ".number_format($result_login['tot'],$decimal)."";
						$return.="\r\n";	
						
							
	 ?>

  <?php } }
  else
  {
                    $return.="Complimetary                                  0.00";
					$return.="\r\n";
  }
  
  
  
/*  $bev_tot =0;
		    $sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) = 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) = 'COLD BEVERAGES' ))ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = $database->mysqlFetchArray($sql_login)) 
				{
						/*if($result_report['tot'] != "")
						{*/
					/*	$bev_tot=$bev_tot+$result_report['Total'];
					$subtotal =$subtotal + $result_report['Total'];
					
						if($result_report['Total'] != "")
						{
					$return.="Beverage Sale                                 ".$result_report['Total']."";
						$return.="\r\n";	
						}
						else
						{
							$return.="Beverage Sale                                 0.00";
						$return.="\r\n";	
						}
					*/
					
					
			/*	}*/
/*		  }}
		  
		  
		  
		  
		  $food_tot=0;
		   $sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) != 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) != 'COLD BEVERAGES' ))ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = $database->mysqlFetchArray($sql_login)) 
				{
						
					$subtotal =$subtotal + $result_report['Total'];
					$food_tot=$food_tot+$result_report['Total'];
					if($result_report['Total'] != "")
						{
					$return.="Food Sale                                     ".$result_report['Total']."";
						$return.="\r\n";	
						}
						else
						{
							$return.="Food Sale                                     0.00";
						$return.="\r\n";	
						}
					
		  }}
		  */
		  
		  
		  
		  
		  
		  
		 /* 	$tot_per=$food_tot+$bev_tot;
			
			$food_per=$food_tot/$tot_per*100;
			$bev_per=$bev_tot/$tot_per*100;
			
				$return.="Food Sale(%)                                  ".round($food_per,2)."";
						$return.="\r\n";	
							
			
			
				$return.="Beverages Sale(%)                             ".round($bev_per,2)."";
						$return.="\r\n";	
							*/
			
  
  
  	
							
	 ?>

  
  <?php
  
   /*$bilcount=0;
  $sql_login  =  $database->mysqlQuery("SELECT count(bm_billno) as bills FROM `tbl_tablebillmaster` WHERE $string_pax"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$bilcount=$bilcount + $result_login['bills'];
				
				$return.="No.Of Invoices                                ".$bilcount."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }*/
  
  
        $return.="---------------------------------------------------------";	
  
  	$return.="\r\n";
  	$return.="TOTAL -                                       ".number_format($subtotal,$decimal)."";
	$return.="\r\n";
        $return.="---------------------------------------------------------";
	//$return.="\r\n";
}
else if($_SESSION['type']=="summary_ta")
{
    /* ******************************************** Category master ******************************************************* */
	  
 
 ?> 
  

  
   
  <?php
  $strin="";
	$strngs=" tbm.tab_status='Closed' AND tbm.tab_mode='TA' AND ";
  $string='';
  $reporthead="";
	$strings=" tbm.tab_status='Closed' AND tbm.tab_mode='TA' AND ";
	$string1_str=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(tab_transactionamount) ";
	$string3_str=" sum(tab_netamt) ";
	$string4_str=" sum(tab_netamt) ";
	$string5_str=" sum(tab_netamt) ";
	
	$string6_str=" sum(tab_netamt)";
		$string7_str=" sum(tab_netamt)";
		$string_pax="";
	$string_pax=" tbm.tab_status='Closed' AND tbm.tab_mode='TA' AND ";
                $string1 =$strings. " pym_code='cash' AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	

			$from=$datedayclose;
			$to=$database->convert_date($datedayclose);
			$string.= " tbm.tab_dayclosedate ='".$datedayclose."' ";
			$reporthead="       On =".$datedayclose; 
			$string_pax.= "tbm.tab_dayclosedate ='".$datedayclose."' ";
			$strin.=" tbm.tab_dayclosedate ='".$datedayclose."' ";	
		
	
	?>
    <?php 
	
		
//			$return.="-----------------------------------------------------";	
				$return.="\r\n";
                                $return.="\r\n";
                                $return.="\r\n";
         $return.="                     Take Away" ;
	$return.="\r\n";                       
	$return.="                  Summary Report" ;
	$return.="\r\n";
	$return.="          ".$reporthead;
	$return.="\r\n";
	$return.="---------------------------------------------------------";	
	$return.="\r\n";
	$return.="Type                                          Value";
	$return.="\r\n";
	$return.="---------------------------------------------------------";	
    $return.="\r\n";
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
  $tot_credit=0;
  $total_cash=0;
       $cur=date("Y-m-d");
	// echo "select $string1_str as tot from tbl_tablebillmaster where $string1"."$string order by bm_dayclosedate,bm_billtime ASC";
 	  $sql_login  =  $database->mysqlQuery("select IFNULL($string1_str,0.00) as tot from tbl_takeaway_billmaster  tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string1"."$string order by tbm.tab_dayclosedate,tbm.tab_time ASC"); 
	// echo "select IFNULL($string1_str,0.00) as tot from tbl_takeaway_billmaster  tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string1"."$string order by tbm.tab_dayclosedate,tbm.tab_time ASC";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{       $total_cash =$total_cash + $result_login['tot'];
				$subtotal =$subtotal + $result_login['tot'];
    
	 ?>
 
  <?php }
  $return.="Cash                                          " .number_format($total_cash,$decimal);
				$return.="\r\n"; 
                                
                        }
  
  
  
  $sql_login  =  $database->mysqlQuery("select (sum(tbm.tab_transactionamount)) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  left join tbl_bankmaster b  on  b.bm_id = tbm.tab_transcbank where  $string2 "."$string order by tbm.tab_dayclosedate,tbm.tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{       $tot_credit = $result_login['tot'];
				$subtotal =$subtotal + $result_login['tot'];
   
					//$return.=round($result_login['tot']);
	 ?>
  
   
  <?php } 
   $return.="Credit                                        ".number_format($tot_credit,$decimal)."";
					$return.="\r\n";
                        }
  
  else
  {
	  	$return.="Credit                                        0.00";
					$return.="\r\n";
  }
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string3_str,0.00) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string3"." $string  group by tbm.tab_billno order by tab_dayclosedate,tab_time ASC "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				$subtotal =$subtotal + $result_login['tot'];
					$return.="Coupons                                       ".$result_login['tot']."";
					//$return.=round($result_login['tot']);
					$return.="\r\n";
	 ?>
 
  <?php } }
    else
  {
	  	$return.="Coupons                                       0.00";
					$return.="\r\n";
  }
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string4_str,0.00) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string4"." $string group by tbm.tab_billno order by tbm.tab_dayclosedate,tbm.tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
					$return.="Voucher                                       ".number_format($result_login['tot'],$decimal)."";
					$return.="\r\n";
					
	 ?>
 
  <?php } }
  
  else
  {
	  	$return.="Voucher                                       0.00";
					$return.="\r\n";
  }
  
  $sql_login  =  $database->mysqlQuery("$string5_str,0.00) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string5"." $string  group by tbm.tab_billno order by tbm.tab_dayclosedate,tbm.tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Cheque                                        ".number_format($result_login['tot'],$decimal)."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
    
  else
  {
	  	$return.="Cheque                                        0.00";
					$return.="\r\n";
  }
  
  
    $sql_login  =  $database->mysqlQuery("$string6_str,0.00) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string6"." $string  group by tbm.tab_billno order by tbm.tab_dayclosedate,tbm.tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Credits                                       ".number_format($result_login['tot'],$decimal)."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  else
  {
	  	$return.="Credits                                       0.00";
					$return.="\r\n";
  }
  
  
  $sql_login  =  $database->mysqlQuery("$string5_str,0.00) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string5"." $string  group by tbm.tab_billno order by tbm.tab_dayclosedate,tbm.tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal1 =$subtotal1 + $result_login['tot'];
				
				$return.="Complimentary                                 ".number_format($result_login['tot'],$decimal)."";
						$return.="\r\n";	
						
							
	 ?>

  <?php } }
  else
  {
                    $return.="Complimetary                                  0.00";
					$return.="\r\n";
  }
  
  
  
/*  $bev_tot =0;
		    $sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) = 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) = 'COLD BEVERAGES' ))ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = $database->mysqlFetchArray($sql_login)) 
				{
						/*if($result_report['tot'] != "")
						{*/
					/*	$bev_tot=$bev_tot+$result_report['Total'];
					$subtotal =$subtotal + $result_report['Total'];
					
						if($result_report['Total'] != "")
						{
					$return.="Beverage Sale                                 ".$result_report['Total']."";
						$return.="\r\n";	
						}
						else
						{
							$return.="Beverage Sale                                 0.00";
						$return.="\r\n";	
						}
					*/
					
					
			/*	}*/
/*		  }}
		  
		  
		  
		  
		  $food_tot=0;
		   $sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) != 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) != 'COLD BEVERAGES' ))ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
				
				while($result_report  = $database->mysqlFetchArray($sql_login)) 
				{
						
					$subtotal =$subtotal + $result_report['Total'];
					$food_tot=$food_tot+$result_report['Total'];
					if($result_report['Total'] != "")
						{
					$return.="Food Sale                                     ".$result_report['Total']."";
						$return.="\r\n";	
						}
						else
						{
							$return.="Food Sale                                     0.00";
						$return.="\r\n";	
						}
					
		  }}
		  */
		  
		  
		  
		  
		  
		  
		 /* 	$tot_per=$food_tot+$bev_tot;
			
			$food_per=$food_tot/$tot_per*100;
			$bev_per=$bev_tot/$tot_per*100;
			
				$return.="Food Sale(%)                                  ".round($food_per,2)."";
						$return.="\r\n";	
							
			
			
				$return.="Beverages Sale(%)                             ".round($bev_per,2)."";
						$return.="\r\n";	
							*/
			
  
  
  	
							
	 ?>

  
  <?php
  
   /*$bilcount=0;
  $sql_login  =  $database->mysqlQuery("SELECT count(bm_billno) as bills FROM `tbl_tablebillmaster` WHERE $string_pax"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$bilcount=$bilcount + $result_login['bills'];
				
				$return.="No.Of Invoices                                ".$bilcount."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }*/
  
  
        $return.="---------------------------------------------------------";	
  
  	$return.="\r\n";
  	$return.="TOTAL -                                       ".number_format($subtotal,$decimal)."";
	$return.="\r\n";
        $return.="---------------------------------------------------------";
	//$return.="\r\n";
}
 
else if( $_SESSION['type']=="complimentary_cr")
{
		//echo "dghj";
		
		
   $reporthead="";
  
  
 
 $servicetax_stats='N';
	 $sql_login  =   $database->mysqlQuery("SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''" ); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
          
          
 ?> 
   
      <?php
  $string=" bm_status='Closed' AND   bm_complimentary='Y' and ";
  $stringta=" tab_status='Closed' AND   tab_complimentary='Y' and ";
             
                        
			
			$string.= " bm_dayclosedate = '".$datedayclose."' ";
                        $stringta.= " tab_dayclosedate = '".$datedayclose."' ";
                        
			$reporthead.="On ".date('Y-m-d',strtotime($datedayclose)) ; 
				
				
			
		$return.="\r\n";
                $menulist= array(
                        new report_head("Consolidated Complimentary Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                
			
				
		

?>
  
	<?php
	$return.="\r\n";
        $return.="----------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new menulist("Slno","BillNo","Mode", "Final"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
        $return.="\r\n";
        
    ?>

<?php
	
	
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $i=0;
       $cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select bm_dayclosedate as date,bm_billno as bill,bm_finaltotal as total,'DI' as mode from tbl_tablebillmaster where $string  Union select tab_dayclosedate as date,tab_billno as bill,tab_netamt as total, tab_mode as mode from tbl_takeaway_billmaster where $stringta"); 
	  //echo "select bm_dayclosedate as date,bm_billno as bill,bm_finaltotal as total,'DI' as mode from tbl_tablebillmaster where $string  Union select tab_dayclosedate as date,tab_billno as bill,tab_netamt as total, tab_mode as mode from tbl_takeaway_billmaster where $stringta";
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{// bm_finaltotal  bm_amountpaid bm_amountbalace
			$i++;
                            $subtotal=$subtotal + $result_login['total'];
                           
                            $return.="\r\n";
                            $menulist= array(
                                            new menulist($i,$result_login['bill'],$result_login['mode'],number_format($result_login['total'],$decimal)),
                                    );
                                        foreach($menulist as $menulist) {
                                                            $return .=($menulist);
                                            }
                            $return.="\r\n";
                        }
			}
	  

			$return.="\r\n";
                        $return.="----------------------------------------------------------------------";
                        $return.="\r\n";
                        $menulist= array(
                                        new menulist("Bills-".$i,"","Total",number_format($subtotal,$decimal)),
                                );
                                    foreach($menulist as $menulist) {
                                                        $return .=($menulist);
                                        }
                        $return.="\r\n";
                        $return.="----------------------------------------------------------------------";
                        $return.="\r\n";

	}
else if($_SESSION['type']=="discount_report_cr")
{
     //echo "haiii";
    	$print='';
	$string="";
        $stringta="";
	$string=" bm_status='Closed' AND bm_dayclosedate = '".$datedayclose."' ";
        $stringta=" tab_status='Closed' AND tab_dayclosedate = '".$datedayclose."'";
	$reporthead="On ".date('Y-m-d',strtotime($datedayclose)) ;
	
          $discountdine=0;
          $discounttacshd=0;
          
                            $return.="\r\n";
                $menulist= array(
                        new report_head("Consolidated Discount Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                             
                            $return.="----------------------------------------------------------------------";
                            $return.="\r\n";
                            $bilno= array(
					new bilno("Mode","Value"),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                            $return.="\r\n";
                            $return.="----------------------------------------------------------------------";
                            $return.="\r\n";
                            
       $sql_logindisc  =  $database->mysqlQuery("select sum(bm_discountvalue) as discdine from tbl_tablebillmaster where $string"); 
//echo "select * from tbl_tablebillmaster where $string";
  //echo "select sum(bm_discountvalue) as discdine from tbl_tablebillmaster where $string";
	  $num_logindisc   = $database->mysqlNumRows($sql_logindisc);
          if($num_logindisc)
          {
              while($result_logindisc  = $database->mysqlFetchArray($sql_logindisc)){
                  $discountdine=$result_logindisc['discdine'];
                  
              }
              
          }
          if($discountdine!=0){
              
                            $return.="\r\n";
                            $bilno= array(
					new bilno("DINE IN",number_format($discountdine,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                            $return.="\r\n";
                            
                            
            }
           $discountta=0;
            $sql_logindiscta  =  $database->mysqlQuery("select sum(tab_discountvalue)as discta,tab_mode from tbl_takeaway_billmaster where $stringta group by tab_mode order by tab_dayclosedate"); 
//echo "select * from tbl_tablebillmaster where $string";
  //echo "select sum(tab_discountvalue)as discta,tab_mode from tbl_takeaway_billmaster where $stringta group by tab_mode order by tab_dayclosedate";
	  $num_logindiscta   = $database->mysqlNumRows($sql_logindiscta);
	
	  if($num_logindiscta)
	  {
		while($result_logindicta  = $database->mysqlFetchArray($sql_logindiscta)){
                    $mode=$result_logindicta['tab_mode'];
                    $discountta=$result_logindicta['discta'];
                    $discounttacshd=$discounttacshd+$result_logindicta['discta'];
                    
                 if($discountta!=0){ 
                     if($mode=='TA'){ $mde="TAKE AWAY"; }
                        else if($mode=='CS'){ $mde="COUNTER SALE";  }
                        else if($mode=='HD'){ $mde="HOME DELIVERY";}
                        
                                      
                            $bilno= array(
					new bilno($mde,number_format($discountta,$decimal)),
				);
				foreach($bilno as $bilno) {
					$return .=($bilno);
				}
                            $return.="\r\n";
                                            
                 }  
                }
	  }

                  			$return.="----------------------------------------------------------------------";
                                        $return.="\r\n";
                                        $bilno= array(
					new bilno("Total",number_format(($discountdine+$discounttacshd),$decimal)),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=($bilno);
                                            }
                                        $return.="\r\n";
                                        $return.="----------------------------------------------------------------------";
                                        $return.="\r\n";
				            
				
} 
 else if($val=="credit_details")
 {
	   $string="";
	  $reporthead="";
	  $st="";
	  $string.= "date(cd.cd_dateofentry) = '".$datedayclose."' ";
           $reporthead="On ".date('Y-m-d',strtotime($datedayclose));
				
		
	
		
		
	
	
	

	$print="";
	$final=0;
/*	echo "select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id where $string order by cd.cd_dateofentry ASC";
	die();*/
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id where $string order by cd.cd_dateofentry ASC"); 
	  //echo "select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id where $string order by cd.cd_dateofentry ASC";
          $num_login   = $database->mysqlNumRows($sql_login);
		 if($num_login)
                         {
                            $final=0;$i=1;
                            
                         
                            $return.="\r\n";
                $menulist= array(
                        new report_head("Consolidated Credit Details Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_head($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=($menulist);
			}
                $return.="\r\n";
                         
                            
                            $return.="----------------------------------------------------------------------";
                            $return.="\r\n";
                            $menulist= array(
                                            new credit_details("Slno","Party","Billno","Credit","Remark"),
                                    );
                                        foreach($menulist as $menulist) {
                                                            $return .=($menulist);
                                            }
                            $return.="----------------------------------------------------------------------";                
                            $return.="\r\n";
                            
				
				
				
				while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                    {
				$final=$final + $result_login['cd_amount'];
                                $billno=$result_login['cd_billno'];
                                if($billno[0]=='D'){
                                    $sql_login1  =  $database->mysqlQuery("select bm_creditremark from tbl_tablebillmaster where bm_billno='".$result_login['cd_billno']."'"); 
                                    //echo "select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id where $string order by cd.cd_dateofentry ASC";
                                    $num_login1   = $database->mysqlNumRows($sql_login1);
                                           if($num_login1)
                                            {   
                                               $result_login1  = $database->mysqlFetchArray($sql_login1);
                                               $remark= $result_login1['bm_creditremark'];    
                                               
                                            }
                                        }
                                        else{
                                            $sql_login2  =  $database->mysqlQuery("select tab_creditremark from tbl_takeaway_billmaster where tab_billno='".$result_login['cd_billno']."'"); 
                                    //echo "select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id where $string order by cd.cd_dateofentry ASC";
                                    $num_login2   = $database->mysqlNumRows($sql_login2);
                                           if($num_login2)
                                            {   
                                               $result_login2  = $database->mysqlFetchArray($sql_login2);
                                               $remark= $result_login2['tab_creditremark'];    
                                               
                                            }
                                        }
				
				if($result_login['crd_staffid']!="")
				
				{
					$party=$result_login['ser_firstname'];
					
					$cat='Staff';
				}
				else if($result_login['crd_roomid']!="")
				{
					$party=$result_login['rm_roomno'];
					$cat="Room";
				}
				
				else if($result_login['crd_corporateid']!="")
				{
					$party=$result_login['ct_corporatename'];
					$cat="Corporate";
				}
				else if($result_login['crd_guestid']!="")
				{
					$party=$result_login['ly_firstname'];
					$cat="Guest";
				}
				
                                
                                $return.="\r\n";
                                $menulist= array(
                                            new credit_details($i,$party,$result_login['cd_billno'],number_format($result_login['cd_amount'],$decimal),$remark),
                                    );
                                        foreach($menulist as $menulist) {
                                                            $return .=($menulist);
                                            }
                                $return.="\r\n";
				
				
					$i++;
                         }}         
                         
                                $return.="----------------------------------------------------------------------";
                                $return.="\r\n";
                                $menulist= array(
                                            new credit_details("Total","","",number_format($final,$decimal),""),
                                    );
                                        foreach($menulist as $menulist) {
                                                            $return .=($menulist);
                                            }
                                $return.="----------------------------------------------------------------------";                
                                $return.="\r\n";	
  
  }       
}
	
	
		
		 $folder = '..\Dayclose_emails/';

if (!is_dir($folder))
mkdir($folder, 0777, true);
chmod($folder, 0777);

$date = date('m-d-Y-H-i-s', time()); 


$filename = $folder."Reports-".$datedayclose;


$handle = fopen($filename.'.txt','w+');
fwrite($handle,$return);
fclose($handle);


$sql_sms1 =  $database->mysqlQuery("Select * from tbl_branchmaster"); 
		  $num_sms1  = $database->mysqlNumRows($sql_sms1);
		  if($num_sms1)
		  {
		         while($result_sms1  = $database->mysqlFetchArray($sql_sms1)) 
					{
                                  $allmail=$result_sms1['be_reportemail_list'];
                                        }
                         } 

	 $sql_general = $database->mysqlQuery("Select * from tbl_generalsettings"); 
		  $num_general  = $database-> mysqlNumRows($sql_general);
		  if($num_general)
		  {
				while($result_general  =$database->mysqlFetchArray($sql_general)) 
					{
						 $be_mail_server			=$result_general['be_mail_server'];
						 $be_mail_port				=$result_general['be_mail_port'];
						 $be_mail_emailid			=$result_general['be_mail_emailid'];
						 $be_mail_password			=$result_general['be_mail_password'];
						 $be_mail_secure			=$result_general['be_mail_secure'];
						 $be_mail_from			    =$result_general['be_mail_from'];
					}
		  }
                  
		$string="Dear Customer, 

Thanks for using our service.We are happy to serve you with our automated e-report facility of daily sales summary of your $branchname outlet. 

Please check the attached file along with this email, view in the browser itself or download the file to open it using any text editor. 

Best Regards 

TEAM EXPODINE,
Explore IT Solutions,
Web: www.expodine.com , E-Mail: info@expodine.com

For Support Ring us at  : +91 9895366444

";
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
        $mail->Subject = "EXPODINE -". $branchname;
        $mail->Body = $mailtext;
          $mail->addAttachment($filename.'.txt');
        
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        
        $emls=explode(",",$allmail);
		  $ctem=count($emls);
		  if($ctem==0)
		  {
		  		 $mail->AddAddress($allmail);
		  }else
		  {
			  for($k=0;$k<$ctem;$k++)
			  {
				 
                                   $mail->AddAddress($emls[$k]);
			  }
		  }   
        
        if (!$mail->send()) {
             $sql_emailsent_updation1  =  $database->mysqlQuery("Update tbl_dayclose set dc_dayclose_email_attempts='".$email_attemt."' where dc_day='".$datedayclose."'");
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
          echo 'Message sent.';
            $sql_emailsent_updation  =  $database->mysqlQuery("Update tbl_dayclose set dc_dayclose_email_success='Y',dc_last_email_time=NOW(),dc_dayclose_email_attempts='".$email_attemt."' where dc_day='".$datedayclose."'");
        }   
                  
                  
                  
                  
	
	
	
	}

 }	
	
}
 }
 }
}

class report_head {
    private $head;
    
  

    public function __construct($head = '') {
        $this -> head = $head;
        
      
	
    }

    public function __toString() {
        $centerCols ="70%";
	
        
		
		
                $centercol = str_pad($this -> head, $centerCols, STR_PAD_BOTH) ;
		
		
        return "$centercol\n";
    }
} 
class itemordered {
    private $product;
    private $qty;
    private $rate;
  

    public function __construct($product = '', $qty = '',$rate='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
      
	
    }

    public function __toString() {
        $leftCols ="35%";
	$leftCols1 ="15%";
        $rightCols="20%";
        
		
		
                $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_LEFT) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		
        return "$left$left1$right\n";
    }
}
class cat_wise {
    private $product;
    private $qty;
    private $rate;
    private $amount;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
        $this -> amount = $amount;
    }

    public function __toString() {
        $leftCols ="10%";
	$leftCols1 ="35%";
        $rightCols ="10%";
	$rightCols1 ="15%";
		
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_RIGHT) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
    }
}

class bilno {
    private $name;
    private $price;

    public function __construct($name = '', $price = '') {
        $this -> name = $name;
        $this -> price = $price;
    }

    public function __toString() {
        $leftCols = "40%";//32-ojin    33-bbq
        $rightCols = '30%';//10-ojin   13-bbq
        $left = str_pad($this -> name, $leftCols) ;
		//$center = str_pad(":", $centerCols) ;
        $right = str_pad($this -> price, $rightCols,' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}
class menulist {
    private $product;
    private $qty;
    private $rate;
	private $amount;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
		$this -> amount = $amount;
    }

    public function __toString() {
        $leftCols ="10%";
		$leftCols1 ="20%";
        $rightCols ="20%";
		$rightCols1 ="20%";
		
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
    }
}

class cancel_history {
    private $slno;
    private $kot;
    private $product;
    private $qty;
    private $staff;
    private $login;

    public function __construct($slno='',$kot = '',$product = '', $qty = '', $staff = '',$login='') {
        $this -> slno =$slno;
        $this -> kot = $kot;
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> staff = $staff;
        $this -> login = $login;
    }

    public function __toString() {
        $leftCols ="5%";
	$leftCols1 ="5%";
        $leftCols2 ="25%";
        $rightCols ="15%";
	$rightCols1 ="20%";
        $rightCols2 ="15%";
		
		
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
                $left1 = str_pad($this -> kot, $rightCols1,' ', STR_PAD_RIGHT) ;
		$left2 = str_pad($this -> product, $leftCols2,' ', STR_PAD_RIGHT) ;
                $right = str_pad($this -> qty, $rightCols,' ', STR_PAD_LEFT) ;
		$right1 = str_pad($this -> staff, $rightCols1,' ', STR_PAD_BOTH) ;
		$right2 = str_pad($this -> login, $rightCols2,' ', STR_PAD_BOTH) ;
        return "$left$left1$left2$right$right1$right2\n";
    }
}
class credit_details {
    private $slno;
    private $product;
    private $qty;
    private $staff;
    private $login;

    public function __construct($slno='',$product = '', $qty = '', $staff = '',$login='') {
        $this -> slno =$slno;
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> staff = $staff;
        $this -> login = $login;
    }

    public function __toString() {
        $leftCols ="5%";
	$leftCols2 ="20%";
        $rightCols ="15%";
	$rightCols1 ="15%";
        $rightCols2 ="15%";
		
		
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
		$left2 = str_pad($this -> product, $leftCols2,' ', STR_PAD_RIGHT) ;
                $right = str_pad($this -> qty, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> staff, $rightCols1,' ', STR_PAD_LEFT) ;
		$right2 = str_pad($this -> login, $rightCols2,' ', STR_PAD_BOTH) ;
        return "$left$left2$right$right1$right2\n";
    }
}
?>