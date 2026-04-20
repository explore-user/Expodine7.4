<?php

session_start();
//include('includes/session.php');	// Check session
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
    
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
   
}

 include('email/km_smtp_class.php');
 require_once('Mailer/PHPMailerAutoload.php');
 	
 $branchname=''; $addr=''; $mail_add='';
 $sql_branch =  $database->mysqlQuery("Select be_branchname,be_address,be_email,be_phone,be_others1,be_others2,be_others3,be_footer1,be_footer2,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
		  $num_branch  = $database->mysqlNumRows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = $database->mysqlFetchArray($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
                                                 $addr=$result_branch['be_address'];
                                                  
						$mail_add=strtoupper($branchname.'-'.$addr);
					}
		  }
                  $report="";
$reports = array();
$datedayclose=$_REQUEST['datemail'];
//echo $_REQUEST['datemail'];
$left='';
if($datedayclose!="")
 {
     $sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster  where rm_dayclosemail='Y' and rm_dayclose_print_order>0 ORDER BY rm_dayclose_print_order ASC "); 
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
    

	
    if($_SESSION['s_email_on_dayclolse'] =="Y")
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
                $return.="----------------------------------------------------------------------";
                    
                    
                    
                    
                    
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
			$reporthead.="on ".$datedayclose;
				
				
			
				
				
                 
                $return.="\r\n";
                $menulist= array(
                        new report_headnew("Dine In","","","","",""),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                
                $menulist= array(
                        new report_headnew("Total Sales Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
               
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                
	
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new menulist("Slno","Date","Billno", "Final"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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
                                new menulist($i,$database->convert_date($result_login['bm_dayclosedate']),$result_login['bm_billno'], number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])),
                            );
                            foreach($menulist as $menulist) {
					$return .=$left.($menulist);
                            }
                            $return.="\r\n";
			
			}
			}
                    }
                        $return.="----------------------------------------------------------------------";
                        $return.="\r\n";
                        $menulist= array(
                        new menulist("Bills-".$i,"FINAL","", number_format($subtotal,$_SESSION['be_decimal'])),
                            );
                            foreach($menulist as $menulist) {
					$return .=$left.($menulist);
                            }
                            $return.="\r\n";
			$return.="\r\n";
                        $return.="----------------------------------------------------------------------";

	}
        
        
       else if($_SESSION['type']=="voucher_expense")
        {
       
        $string='';
        $from=$_SESSION['dateopen'];
			
	$to=$_SESSION['dateopen'];
	$string.= " vp_dayclose_date ='".$datedayclose."' ";
      
                  $return.="\r\n";
               
                $menulist= array(
                        new report_headnew("Voucher Expense Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
               
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                
	
	$return.="\r\n";
	$return.="----------------------------------------------------------------------";
	$return.="\r\n";
                  
                  
                  
            $bilno= array(
                    new expense("Slno","Head","Amount"),
                    );
                    foreach($bilno as $bilno) {
                        $return .=$left.($bilno);
                        }     
                        $return.="\r\n";
             $return .= "---------------------------------------------------------------------- \n";
     
        $i=0;
        $amount=0;
    		 $sql_login  =  $database->mysqlQuery("select * from tbl_voucherpayment left join tbl_voucherhead on vh_id=vp_vhid left join tbl_branchmaster on be_branchid=vp_branchid left join tbl_staffmaster on ser_staffid=vp_approvedby where vp_status='Approved' and  $string");
                   
                  // echo "                              select * from tbl_voucherpayment left join tbl_voucherhead on vh_id=vp_vhid left join tbl_branchmaster on be_branchid=vp_branchid left join tbl_staffmaster on ser_staffid=vp_approvedby where  vp_status='Approved' and  $string";
                   $num_login   = $database->mysqlNumRows($sql_login);
                 if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                            $i++;
                            $voucherid=$result_login['vp_id'];
                            $datetime=$result_login['vp_date'];
                            $vouchername=$result_login['vh_vouchername'];
                            $type=$result_login['vp_type'];
                            $status=$result_login['vp_status'];
                            $modeofpayment=$result_login['vp_paymentmode'];
                            $amount=$amount+$result_login['vp_amount'];
                            $paidto=$result_login['vp_paidto'];
                            $receivedby=$result_login['vp_receivedby'];
                            $chequebankname=$result_login['vp_chequebank'];
                            $chequebranchname=$result_login['vp_chequebranch'];
                            $chequeleafnumber=$result_login['vp_chequeleafno'];
                            $approvedby=$result_login['ser_firstname'];
                            $approveddatetime=$result_login['vp_approveddate'];
                            $approvedremark=$result_login['vp_remarks'];
                            $branchname=$result_login['be_branchname'];
                            $vno=$result_login['vp_voucherno'];
                            $date=date("d-m-Y",strtotime($datetime));
                            $time=date("H:i:s",strtotime($datetime));
                            $approveddate=date("d-m-Y",strtotime($approveddatetime));
                            $approvedtime=date("H:i:s",strtotime($approveddatetime));
                          $stf_name=$result_login['ser_firstname'];
                          
                              $return.="\r\n";
                            $bilno= array(
                    new expense($i,$vouchername,number_format($result_login['vp_amount'],$_SESSION['be_decimal'])),
                    );
                    foreach($bilno as $bilno) {
                        $return .=$left.($bilno);
                        }   
                         $return.="\r\n";    
       
        } } 
       
       
                        $return.="---------------------------------------------------------------------- \n";
                        $return.="\r\n";
        $bilno= array(
                    new expense("Total","",number_format($amount,$_SESSION['be_decimal'])),
                    );
                    foreach($bilno as $bilno) {
                        $return .=$left.($bilno);
                        }     
                        
                        
                       $return.="\r\n";
			
                        $return.="----------------------------------------------------------------------";
        $return.="\r\n";
          } 
        

else if( $_SESSION['type']=="summary_report_cr")
{
		$string_credit_settle='';
                    $stringvp='';
                $stringvp.= " vp_dayclose_date ='".$datedayclose."' ";
     
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
                        $reporthead="On ".$datedayclose;
		
 $string_credit_settle.=" cdp_dayclosedate ='".$datedayclose."' ";
                
		
		
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
                    
                            
                $return.="\r\n";
                $menulist= array(
                        new report_headnew("Consolidated Summary Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
        $return.="----------------------------------------------------------------------";
	$return.="\r\n";
	$bilno= array(
					new bilno("Type","Value"),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
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
					new bilno("Cash",number_format($totalcash,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
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
					new bilno("CARD",number_format($totalcredit,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n";
                                }
                                
                                
                                
     ////cardstart////
                
          $stringbnk_dt_di= " bm_dayclosedate between '".$datedayclose."' and '".$datedayclose."' ";  
          
          $stringbnk_dt_ta= " tab_dayclosedate between '".$datedayclose."' and '".$datedayclose."' ";  
                
          $sql_logincredit  =  $database->mysqlQuery("select x.bnk,sum(x.tot) as total from ( 
                                                    select  distinct (b.bm_name) as bnk,sum(bc.mc_cardamount) as tot  FROM tbl_tablebillmaster bm
                                                    left join tbl_paymentmode on bm.bm_paymode=tbl_paymentmode.pym_id  
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.bm_billno
                                                    left join tbl_bankmaster b on  b.bm_id = bc.mc_to_bank 
                                                    where  tbl_paymentmode.pym_code='credit' and  bm.bm_status='Closed' 
                                                    AND bm.bm_complimentary!='Y' AND $stringbnk_dt_di group by bnk 
                                                    union all
                                                    select distinct (b.bm_name) as bnk, sum(bc.mc_cardamount) as tot  FROM 
                                                    tbl_takeaway_billmaster bm 
                                                    left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id 
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.tab_billno
                                                    left join tbl_bankmaster b  on  b.bm_id = bc.mc_to_bank 
                                                    where tbl_paymentmode.pym_code='credit' 
                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND $stringbnk_dt_ta group by bnk
                                                    )x group by x.bnk "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{  
                        $menulist= array(
                        new bilno('* '.$result_logincredit['bnk'],number_format($result_logincredit['total'],$_SESSION['be_decimal'])),
                        );
                        foreach($menulist as $menulist) {
                        $return .=$left.($menulist);
                      }
            }}
          
             $return.="\r\n";                   
    //////cardend/////
                                
                                
                                
                  		
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
					new bilno("Coupon",number_format($totalcoupon,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
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
					new bilno("Voucher",number_format($totalvoucher,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
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
					new bilno("Cheque",number_format($totalcheque,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
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
					new bilno("CREDIT SALE",number_format($totalcp,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n";
                            }  
                            
                            
                            
            ///creditstart/////////
              
	  $st="";  $string=""; $final=0;
	  $string.= "(bm.bm_dayclosedate ='".$datedayclose."'  or  tbm.tab_dayclosedate = '".$datedayclose."' ) ";
         
 	  $sql_login  =  $database->mysqlQuery("select sum(cd.cd_amount) as tot,s.ser_firstname,r.rm_roomno,l.ly_firstname,cm.ct_corporatename,c.crd_staffid,c.crd_roomid,c.crd_corporateid,c.crd_guestid from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno WHERE $string group by cd.cd_masterid   order by cd.cd_dateofentry ASC"); 
	 
          $num_login   = $database->mysqlNumRows($sql_login);
		 if($num_login)
                         {
                            
                              
				while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                    {
				
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
				
                                            
                        $bilno= array(
					new bilno('* '.$party,number_format($result_login['tot'],$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                            
                              	
					$i++;
                         }}         
                          $return.="\r\n"; 
                            ////creditend/////
                            
                            
                            
                            
                            
                     
                            
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
					new bilno("Complimentary",number_format($totalcomp,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
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
//	 			 $bilno= array(
//					new bilno("Total Pax (Dine In)",$qtycount),
//				);
//				foreach($bilno as $bilno) {
//					$return .=$left.($bilno);
//				}
//                                $return.="\r\n";
                                
                                
                                
                            $finaltotal=$totalcash+$totalcredit+$totalcoupon+$totalvoucher+$totalcheque+$totalcp;
		  
			$return.="-----------------------------------------------------------------------";
			$return.="\r\n";
                        
                                 
                                 
                              ///taxcalc///////
                     
               $stringbnk_dt_di_tax= " bm.bm_status='Closed' AND bm.bm_complimentary!='Y' AND bm.bm_dayclosedate between '".$datedayclose."' and '".$datedayclose."' ";  
          
          $stringbnk_dt_ta_tax= " tb.tab_status='Closed' AND tb.tab_complimentary!='Y' AND  tb.tab_dayclosedate between '".$datedayclose."' and '".$datedayclose."' ";                   
                                
                                
                                
           $tax_di_all=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(te.bem_total_value) as tax_di FROM `tbl_tablebill_extra_tax_master` te left join tbl_tablebillmaster bm on te.bem_billno=bm.bm_billno WHERE $stringbnk_dt_di_tax   "); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$tax_di_all=$tax_di_all + $result_stw['tax_di'];
			}
	  }
          
          
          
          $tax_ta_all=0;
		   $sql_stw1  =  $database->mysqlQuery("SELECT sum(te.tbe_total_value) as tax_ta FROM `tbl_takeaway_bill_extra_tax_master` te left join tbl_takeaway_billmaster tb on te.tbe_billno=tb.tab_billno WHERE $stringbnk_dt_ta_tax   "); 
	  $num_stw1   = $database->mysqlNumRows($sql_stw1);
	  if($num_stw1){
		  while($result_stw1  = $database->mysqlFetchArray($sql_stw1)) 
			{
				$tax_ta_all=$tax_ta_all + $result_stw1['tax_ta'];
			}
	  }
          
          
         $tax_name_val=0; 
          $sql_stw11  =  $database->mysqlQuery("SELECT sum(amc_value) as tax_val FROM `tbl_extra_tax_master`  WHERE amc_active='Y'   "); 
	  $num_stw11   = $database->mysqlNumRows($sql_stw11);
	  if($num_stw11){
		  while($result_stw11  = $database->mysqlFetchArray($sql_stw11)) 
			{
				$tax_name_val=$tax_name_val + $result_stw11['tax_val'];
			}
	  }
          
          
          
          $all_tax_show=$tax_ta_all+$tax_di_all;      
                                 
                      $finaltotal_excl=$finaltotal-$all_tax_show;
                      
		  
			
			$return.="\r\n";
                        $bilno= array(
					new bilno("TOTAL (Exclusive Tax)",number_format($finaltotal_excl,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n";
                        $return.="-----------------------------------------------------------------------\n";
                                
				 $return.="\r\n";           
                                 
                                 
                                
   
          
	 			 $bilno= array(
					new bilno("Tax Amount", number_format($all_tax_show,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}                     
                                
              
                          $return.="-----------------------------------------------------------------------\n";
                                
				 $return.="\r\n";       
                                
                                $bilno= array(
					new bilno("TOTAL (Inclusive Tax) ",number_format($finaltotal,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n";
                        $return.="-----------------------------------------------------------------------\n";
                                
				 $return.="\r\n";
                                //////////taxend//////
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                        
		  
		
                        
                       $creditcash_settle=0;
                    $creditcard_settle=0;
                    $sql_creditsettlemt  =  $database->mysqlQuery("select sum(cdp_paid_cash - cdp_balance) as settled_cash, sum(cdp_transaction_amount) as settled_card FROM tbl_credit_details_payment
                                                                    where $string_credit_settle "); 
            //        echo "select sum(cdp_paid_cash - cdp_balance) as settled_cash, sum(cdp_transaction_amount) as settled_card FROM tbl_credit_details_payment
            //                                                        where $string_credit_settle ";
                    $num_creditsettlemt   = $database->mysqlNumRows($sql_creditsettlemt);
                      if($num_creditsettlemt){
                           //$return .= $center.$bold_on."Credit Settlement Income".$bold_off."\n\n";
                          
                           
                            $return.="\r\n";
                              $return.="\r\n";
                               
                $menulist= array(
                        new report_headnew("Credit Settlement Income"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                           
                           
                              while($result_creditsettlemt  = $database->mysqlFetchArray($sql_creditsettlemt)) 
                                    {
                                            $creditcash_settle=$result_creditsettlemt['settled_cash'];
                                            $creditcard_settle=$result_creditsettlemt['settled_card'];
                                    }}
                            if($creditcash_settle>0){
                                $bilno= array(
						new bilno("Cash Settle",number_format(str_replace(',','',$creditcash_settle),$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$return .=$left.($bilno);
					}
                                
                                }
                                if($creditcard_settle>0){
                                    
                                    $bilno= array(
						new bilno("Card Settle",number_format(str_replace(',','',$creditcard_settle),$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$return .=$left.($bilno);
					}
                             
                                }
                           $return .= "-----------------------------------------------------------------------\n";//ojin
                                
                                  $return.="\r\n";
                                
                                
                                    $bilno= array(
						new bilno("Settlement Total",number_format(str_replace(',','',($creditcard_settle+$creditcash_settle)),$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$return .=$left.($bold_on.$bilno.$bold_off);
					}
				 $return.="\r\n";
				$return .="-----------------------------------------------------------------------\n";//ojin   
                         $return.="\r\n";
                        
                        
                          
               
                           
                                
          $sql_login_loy12  =  $database->mysqlQuery("select sum(vp_amount) as expense FROM tbl_voucherpayment where vp_status='Approved' and $stringvp "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $voucher_expense=  $result_login_loy12['expense'];
                    
                      
          }
          }   
            
                 $return .= "\n";//ojin  
            
            if($voucher_expense>0){
             $bilno= array(
						new bilno("Total Expense ",number_format($voucher_expense,$_SESSION['be_decimal'])),
					);
					foreach($bilno as $bilno) {
						$return .=$left.($bold_on.$bilno.$bold_off);
					} 
            }
                                
                     $return.="\r\n";            
                 $return.="-----------------------------------------------------------------------\n";//ojin             
                                
                   $return.="\r\n";      
                        
                        
		  
}
 else if($_SESSION['type']=="item_ordered_cr")
{ 
            $string ="";
            $stringta="";
            $string_combo="";
            $string="bm.bm_status = 'Closed'";
            $stringta="tbm.tab_status = 'Closed'";
            
            $from='';
            $to='';
            $reporthead="";
            $st="";
           
	   
			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
                        $string.= "and bm.bm_dayclosedate='".$datedayclose."' ";
                        $stringta.= "and tbm.tab_dayclosedate='".$datedayclose."' ";
                        $string_combo.= " cbd.cbd_dayclosedate = '".$datedayclose."' ";
			$reporthead="On ".$datedayclose;
			$return.="\r\n";
                           $menulist= array(
                        new report_headnew("Consolidated Item Ordered Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                                    
                                
                               
	$return.="----------------------------------------------------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                new itemordered("SlNo","Main Category","Sub Category","Menu","Unit Type","Portion/Weight","Qty", "Total"),
        );
        foreach($menulist as $menulist) {
                $return .=$left.($menulist);
        }
	$return.="\r\n";
	$return.="----------------------------------------------------------------------------------------------------------------";
        $return.="\r\n";
		
        $funalta=0;
        $netfinal=0;
        $p=0;
        $final=0;
        $qty=0;
        $qty_final=0;
        $i=1; $qty1loose=0;
            $sql_combo  =  $database->mysqlQuery("select combo,comboid,combopackid, sum(qty) as qty, rate as rate, sum(total) as total from (
                                                    select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_combo_id as comboid, cbd.cbd_combo_pack_id combopackid, cbd.cbd_combo_qty as qty, cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
                                                    FROM tbl_combo_bill_details cbd 
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    LEFT JOIN tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    where $string_combo and bm.bm_status='Closed' group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno union all
                                                
                                                select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_combo_id, cbd.cbd_combo_pack_id, cbd.cbd_combo_qty as qty, cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
                                                    FROM tbl_combo_bill_details_ta cbd 
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    LEFT JOIN tbl_takeaway_billmaster bm on bm.tab_billno = cbd.cbd_billno
                                                    where $string_combo and bm.tab_status='Closed' group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno ) x group by x.comboid, x.combopackid");
                    $num_combo   = $database->mysqlNumRows($sql_combo);
                    if($num_combo){
                            $total=0;$qty=0;
                            $return .= $left."\n";
                            $return .= $left."** COMBO MENU \n";
                        while($result_combo  = $database->mysqlFetchArray($sql_combo)){ 
                            $i++;$p++;
                            $final=$final+$result_combo['total'];
                            $qty_final=$qty_final+$result_combo['qty'];

                            
                            $menulist= array(
				new itemordered($p,'','',substr(strtoupper($result_combo['combo']),0,25),'','',$result_combo['qty'],number_format($result_combo['total'],$_SESSION['be_decimal'])),
                            );
                            foreach($menulist as $menulist) {
                            $return .=$left.($menulist);
                            $return.="\r\n";
                            $j++;
                            }
                        }
                    }
                    $sql_stw  =  $database->mysqlQuery("select maincategory,subcategory,menuid,menuname, rate_type,unit_type,portionid,portionname,sum(weight)as weight,unitid,unitname,baseunitid,baseunitname,sum(qty)as qty,sum(total)as total from ( 
                                        select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.bd_menuid as menuid,mm.mr_menuname as menuname, bd.bd_rate_type as rate_type,
                                        bd.bd_unit_type as unit_type, bd.bd_portion as portionid,pm.pm_portionname as portionname,
                                        bd.bd_unit_weight as weight, bd.bd_unit_id as unitid,um.u_name as unitname,
                                        bd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.bd_rate, sum(bd.bd_qty) as qty , sum(bd.bd_rate* bd.bd_qty) as total
                                        FROM tbl_tablebilldetails bd
                                        left join tbl_tablebillmaster bm ON bm.bm_billno = bd.bd_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.bd_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.bd_portion
                                        left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                        where $string and bd.bd_count_combo_ordering IS NULL
                                        group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight

                                        union all 
                                        
                                        select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                                        bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                                        bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                                        bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate, sum(bd.tab_qty) as qty , sum(bd.tab_rate* bd.tab_qty) as total
                                        FROM tbl_takeaway_billdetails bd
                                        left join tbl_takeaway_billmaster tbm ON tbm.tab_billno = bd.tab_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                        left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                        where $stringta and bd.tab_count_combo_ordering IS NULL 
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, bd.tab_unit_weight 
                                        )x group by menuid,portionid,unitid,baseunitid,weight order by maincategory,menuid  ");
                $num_stw   = $database->mysqlNumRows($sql_stw);
                if($num_stw){ $t=0;$old="";
                                  
				$j=0;
                                $old="";
                                $subold="";
                                $qty1=0;
                                
                                $old_menu='';
				while($result_report  = mysqli_fetch_array($sql_stw)) 
				{
                                    $t=$i-1;$p++;
                                    
                                     $billhis_portion=$result_report['portionname'];
                                     $qty1=$result_report['qty'];
                                     $weight=$result_report['weight'];
                                      $total=$result_report['total'];
                                        $qty1loose=$result_report['qty'];
                                      if($result_report['rate_type']=='Portion'){
                                                $billhis_portion=$result_report['portionname'];
                                                }
                                                else if($result_report['rate_type']=='Unit'){
                                                    if($result_report['unit_type']=='Packet'){
                                                        $billhis_portion=number_format($result_report['weight'],$_SESSION['be_decimal']).$result_report['unitname'];
                                                }
                                                    else if($result_report['unit_type']=='Loose'){
                                                        $qty1='';
                                                        $billhis_portion=number_format($result_report['weight'],$_SESSION['be_decimal']).$result_report['baseunitname'];
                                                }
                                               
                                                }
                                            if($result_report['unit_type']=='Loose'){
                                                if($result_report['menuid']==$old_menu){
                                                     $t=$i-1;
                                                      
                                                    //unset($menulist[$t-1]);

                                                
                                                    if(strlen($return)>$string_length)
                                                    {
                                                    $return=substr($return,0,$string_length);

                                                    }
                                                   $weight_loose=$weight_loose+ ($result_report['weight']*$qty1loose);


                                                   $final=$final-$loose_total;
                                                   $loose_total=$loose_total+ $result_report['total'];


                                                   $p=$p-1;
                                                }else{
                                                    $old_menu=$result_report['menuid'];
                                                    $weight_loose=$result_report['weight']*$qty1loose;
                                                    $loose_total=$result_report['total'];
                                                }
                                                $billhis_portion=number_format($weight_loose,$_SESSION['be_decimal']).' '.$result_report['baseunitname'];
                                                $weight=$weight_loose;
                                                $total=$loose_total;
                                                $qty1='';
                                                $catname=$result_report['maincategory'];

                                            }
                                            
                                              
                                            
                                    
                                    
                                    $final=$final+$total;
                                    if($qty1!=''){
                                        $qty_final=$qty_final+$qty1;
                                    }
					   
                                        $maincatname = $result_report['maincategory'];
                                        if($result_report['maincategory']!=$old){
                                            $return .= $left."\n";
                                            $return .= $left."* * ".strtoupper($maincatname)."\n";
                                            
                                           
                                            $old = $result_report['maincategory'];
                                           
                                            
                                        }else{
                                            $return .= "";
                                            $old = $result_report['maincategory'];
                                        }
                                        
					
					$item=$result_report['menuname'];
                                            if(strlen($item)>20)
                                            {
                                            $item=substr($item,0,20);
                                                
                                            }
                                            
                                        $string_length=strlen($return);     
                                            
									
					$menulist= array(
						new itemordered($p,substr(strtoupper($catname),0,17),substr($result_report['subcategory'],0,17),substr($result_report['menuname'],0,13),$result_report['unit_type'],$billhis_portion,$qty1,number_format($total,$_SESSION['be_decimal'])),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$return .=$left.($menulist);
					$return.="\r\n";
                                        $j++;
                                        } 
					$i++;
				}
                        }
        	
				
				 
                        $return.="--------------------------------------------------------------------------------------------------------------------";	
			$return.="\r\n";
                        $menulist= array(
                            new itemordered("Total","","","","","",$qty_final,number_format($final,$_SESSION['be_decimal'])),
			);
			           					
                        foreach($menulist as $menulist) {
                        $return .=$left.($menulist);
                        $return.="\r\n";

                        }
                        $return.="--------------------------------------------------------------------------------------------------------------------";
                                
				
	  
	
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
       

			$from=$_SESSION['dateopen'];
			$to=$database->convert_date(date("Y-m-d"));
                        $string.= "and bm.bm_dayclosedate ='".$datedayclose."'";
                        $stringta.= "and tbm.tab_dayclosedate ='".$datedayclose."'";
			$reporthead="On ".$datedayclose;
			$return.="\r\n";
                          $menulist= array(
                        new report_headnew("Consolidated Category Wise Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                                
                                  
                                $return.="----------------------------------------------------------------------";
                                $return.="\r\n";
                                $menulist= array(
					new cat_wise("Slno"," Category ","  Qty","  Total")
				);
				foreach($menulist as $menulist) {
					$return .=$left.($menulist);
				}
                                $return.="\r\n";
                                $return.="----------------------------------------------------------------------";
                                $return.="\r\n";
		
		
	$final=0;
        $total=0;
        $totalta=0;
        $i=1;
            $sql_login_combo  =  $database->mysqlQuery(" select sum(items) as noofitems,category,sum(qty) as qty, sum(amount) as amount from (
                                                        select  distinct( count(cbd.cbd_combo_pack_id)) as items,'COMBO MENUS'as category, sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as amount  FROM tbl_combo_bill_details cbd left join  tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno where $string group by cbd.cbd_billno union all
                                                        select  distinct(count(cbd.cbd_combo_pack_id)) as items,'COMBO MENUS'as category, sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as amount  FROM tbl_combo_bill_details_ta cbd left join  tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno where $stringta group by cbd.cbd_billno)x group by x.category");

            $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
             if($num_login_combo){$t=0;
                    
                                
                            
		  while($result_login_combo  = $database->mysqlFetchArray($sql_login_combo)) 
			{$t++;
                            $total=$total+$result_login_combo['amount'];
                            //$final=$final+$result_login['Final'];
                            $menulist= array(
                                new cat_wise($i,"**".strtoupper($result_login_combo['category']),$result_login_combo['qty'],number_format($result_login_combo['amount'],$_SESSION['be_decimal']),$printer_style)
                            );
                            foreach($menulist as $menulist) {
                                    $return .=$left.($menulist);
                                    $return.="\r\n"; 
                            }
                            
                        $i++;}}
      
            $sql_login  =  $database->mysqlQuery(" SELECT mmy_maincategoryname,count(distinct(mr_menuid)) as noofitems,sum(qty + qty1) as qty,sum(Total) as Total From ( SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,sum(0) as qty1,bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where bd.bd_count_combo_ordering is NULL and $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname union all 
                     SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(0) as qty,sum(tbd.tab_qty) as qty1 ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where tbd.tab_count_combo_ordering is NULL and $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname) x group by mmy_maincategoryname ORDER BY mmy_maincategoryname ASC ");
//            echo "SELECT mmy_maincategoryname,count(distinct(mr_menuid)) as noofitems,sum(qty + qty1) as qty,sum(Total) as Total From ( SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,sum(0) as qty1,bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname union all 
//                     SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(0) as qty,sum(tbd.tab_qty) as qty1 ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname) x group by mmy_maincategoryname ORDER BY mmy_maincategoryname ASC";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$t=0;
                            
                               
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{       $total=$total + $result_report['Total'];
					
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
					new cat_wise($i,strtoupper($main_cat1),$result_report['qty'],number_format($result_report['Total'],$_SESSION['be_decimal']))
                                            );
				foreach($menulist as $menulist) {
					$return .=$left.($menulist);
                                        $return.="\r\n"; 
				}
					
										//$return .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
                     }		
	  
                                $return.="----------------------------------------------------------------------";	
                                $return.="\r\n";
                                $menulist= array(
					new cat_wise("Total","","",number_format($total,$_SESSION['be_decimal']))
                                            );
				foreach($menulist as $menulist) {
					$return .=$left.($menulist);
                                }
                                $return.="\r\n";
                                $return.="----------------------------------------------------------------------";
			
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
        $stringtax .=" tab_status='Closed'  AND ";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
			$string.= " bm_dayclosedate ='".$datedayclose."'";
                        $stringta.=" tab_dayclosedate ='".$datedayclose."' ";
                        $stringcs.=" tab_dayclosedate ='".$datedayclose."' ";
                        $stringhd.=" tab_dayclosedate ='".$datedayclose."'";
                        $stringtacshd.= " tab_dayclosedate ='".$datedayclose."' ";
                        $stringtax .=" tab_dayclosedate='".$datedayclose."'";
			$string_pax.= "bm_dayclosedate  ='".$datedayclose."'";
		
                        $reporthead="On ".$datedayclose;
              
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
         
          
           
                $flg=0;
                                
                            $return.="\r\n";
                                $menulist= array(
                        new report_headnew("Consolidated SALES SUMMARY (Inc.Tax)"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
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
   
   
   $roundof=0;
   $roundoftacshd=0;
   $tot_roundof=0;
   $taxexemptdi=0;
   $taxexemptta=0;
   $taxexempthd=0;
   $taxexemptcs=0;
   
   $uae_subtotal=0; 
   $uae_subtotal_ta=0;
   $uae_subtotal_hd=0; 
   $uae_subtotal_cs=0;
   
  $sql_login  =  $database->mysqlQuery("select sum(bm_taxable_amount) as uae_subtotal,sum(bm_finaltotal) as tot,sum(bm_tax_exempt) as taxexempt, (sum(bm_subtotal)-sum(bm_discountvalue)) as totexcl,sum(bm_roundoff_value) as totroundof FROM tbl_tablebillmaster left join tbl_floormaster tf on tf.fr_floorid=bm_floorid where  $stringstatdi $string"); 
                                        
//echo "select sum(bm_finaltotal) as tot,sum(bm_tax_exempt) as taxexempt, (sum(bm_subtotal)-sum(bm_discountvalue)) as totexcl,sum(bm_roundoff_value) as totroundof FROM tbl_tablebillmaster left join tbl_floormaster tf on tf.fr_floorid=bm_floorid where  $stringstatdi $string";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                            if($result_login['tot'] != "")	{
                            $subtotal =$subtotal + $result_login['tot'];
                            $salesinctax = $salesinctax+$result_login['tot'];
                            $salesexcltaxdi = $salesexcltaxdi+$result_login['totexcl'];
                            $taxexemptdi = $taxexemptdi+$result_login['taxexempt'];
                            $roundof=$roundof+$result_login['totroundof'];
                            
                            $uae_subtotal=$uae_subtotal+$result_login['uae_subtotal']; 
          }}}   
      $sql_loginta  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal,sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringta"); 
                                       //echo " select sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringta ";      
                                           
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
                            if($result_loginta['tot'] != "")	{
                            $subtotalta =$subtotalta + $result_loginta['tot'];
                            $salesexcltaxta =$salesexcltaxta+$result_loginta['totexcl'];
                            $taxexemptta = $taxexemptta+$result_loginta['taxexempt'];
                          
           $uae_subtotal_ta=$uae_subtotal_ta+$result_loginta['uae_subtotal'];
          }}}
          
          $sql_logincs  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal,sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringcs"); 
                                          //echo "select sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringcs";
	  $num_logincs   = $database->mysqlNumRows($sql_logincs);
	  if($num_logincs){
		  while($result_logincs  = $database->mysqlFetchArray($sql_logincs)) 
			{ 
                            if($result_logincs['tot'] != "")	{
                            $subtotalcs =$subtotalcs + $result_logincs['tot'];
                             $salesexcltaxcs =$salesexcltaxcs+$result_logincs['totexcl'];
                             $taxexemptcs = $taxexemptcs+$result_logincs['taxexempt'];
                      $uae_subtotal_cs=$uae_subtotal_cs+$result_logincs['uae_subtotal'];      
          }}}
          
           $sql_loginhd  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal,sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringhd"); 
                                            //echo "select sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringhd";
	  $num_loginhd   = $database->mysqlNumRows($sql_loginhd);
	  if($num_loginhd){
		  while($result_loginhd  = $database->mysqlFetchArray($sql_loginhd)) 
			{ 
                            if($result_loginhd['tot'] != "")	{
                            $subtotalhd =$subtotalhd + $result_loginhd['tot'];
                            $salesexcltaxhd =$salesexcltaxhd+$result_loginhd['totexcl'];
                            $taxexempthd = $taxexempthd+$result_loginhd['taxexempt'];
                         $uae_subtotal_hd=$uae_subtotal_hd+$result_loginhd['uae_subtotal'];    
          }}}
          
            $sql_logintacshd  =  $database->mysqlQuery("select sum(tab_netamt) as tot, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl ,sum(tab_roundoff_value) as totroundof FROM tbl_takeaway_billmaster where  $stringstat $stringtacshd"); 
                                                //echo "select sum(tab_netamt) as tot, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl ,sum(tab_roundoff_value) as totroundof FROM tbl_takeaway_billmaster where  $stringstat $stringtacshd";
            $num_logintacshd   = $database->mysqlNumRows($sql_logintacshd);
            if($num_logintacshd){
		while($result_logintacshd  = $database->mysqlFetchArray($sql_logintacshd)) 
                    { 
                            if($result_logintacshd['tot'] != ""){
                            
                            $roundoftacshd=$roundoftacshd+ $result_logintacshd['totroundof'];
            }}}
            
          
          $totroundofff=$roundoftacshd+$roundof;
          //takeaway taxes//
          $tataxsg="0";
          $tataxcg="0";
          $tataxtx3="0";
          $rf1="";
          $ta_tax_value=array();
          $ta_tax_valueta=0;
            $ta_tax_valuecs=0;
            $ta_tax_valuehd=0;
          $sql_logintax_ta  =  $database->mysqlQuery("select tbm.tab_mode,tketm.tbe_taxid,sum(tketm.tbe_total_value) AS sum_tax,tketm.tbe_label  FROM tbl_takeaway_bill_extra_tax_master tketm
                                left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tketm.tbe_billno where  $stringstat  $stringtax group by tbm.tab_mode,tketm.tbe_taxid"); 
         //echo "select tbm.tab_mode,tketm.tbe_taxid,sum(tketm.tbe_total_value) AS sum_tax,tketm.tbe_label  FROM tbl_takeaway_bill_extra_tax_master tketm
          //                      left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tketm.tbe_billno where  $stringstat  $stringtax group by tbm.tab_mode,tketm.tbe_taxid";
	  $num_logintax_ta   = $database->mysqlNumRows($sql_logintax_ta);
	  if($num_logintax_ta){
		  while($result_logintax_ta  = $database->mysqlFetchArray($sql_logintax_ta)) 
			{ 
                           
                           if($result_logintax_ta['tab_mode']=='TA'){
                               $ta_tax_value['TA']['value'][]=$result_logintax_ta['sum_tax'];
                               $ta_tax_value['TA']['label'][]=$result_logintax_ta['tbe_label'];
                               
                           }
                           else if($result_logintax_ta['tab_mode']=='CS'){
                              $ta_tax_value['CS']['value'][]=$result_logintax_ta['sum_tax'];
                              $ta_tax_value['CS']['label'][]=$result_logintax_ta['tbe_label'];
                           }
                           else if($result_logintax_ta['tab_mode']=='HD'){
                             $ta_tax_value['HD']['value'][]=$result_logintax_ta['sum_tax'];
                             $ta_tax_value['HD']['label'][]=$result_logintax_ta['tbe_label'];
                           }
                            
                        }
                        //print_r($ta_tax_value);
                           }
          $total=$subtotal + $subtotalta+$subtotalcs+$subtotalhd;
          $temp_tot_summary=$subtotal + $subtotalta+$subtotalcs+$subtotalhd;
                         
                        if($subtotal!=0)
                            {
                                $bilno= array(
					new bilno("Dine In",number_format($subtotal,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                    
				$return.="\r\n";
                            }
                          
                            if($subtotalta!=0)
                            {
                                $bilno= array(
					new bilno("Take Away",number_format($subtotalta,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n";
                            } 
                             if($subtotalcs!=0)
                            {   
                                $bilno= array(
					new bilno("Counter Sale",number_format($subtotalcs,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n"; 
                              
                            }
                              if($subtotalhd!=0)
                            {
                                  $bilno= array(
					new bilno("Home Delivery",number_format($subtotalhd,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n"; 
                            }
                             
                            $bilno= array(
					new bilno("Total Summary",number_format($total,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n"; 
                            
                                 $return .= "TAX SUMMARY";
                                 $return.="             ";
                                 $return.="\r\n";
				$return.="\r\n";
                                
                             if($salesexcltaxdi!=0)
                             {
                                 
                                 if($_SESSION['uae_tax_enable']=='Y'){
                                     $bilno= array(
					new bilno("Dine-In Excl.Tax",number_format($uae_subtotal,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                             }else{
                                 $bilno= array(
					new bilno("Dine-In Excl.Tax",number_format($salesexcltaxdi,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                             }
                                
                                $return.="\r\n";
                            }
                             if($taxexemptdi!=0)
                             {
                                 $bilno= array(
					new bilno("Tax Exempted Amount-DI",number_format($taxexemptdi,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n";
                            }
                            $roundof1="";
            
            $roundof12="";
            $tax_value=array();
            $di_tax_sum=0;
            $sql_login5  =  $database->mysqlQuery("select tetm.bem_taxid,sum(tetm.bem_total_value) as tax_sum,tetm.bem_label  FROM tbl_tablebill_extra_tax_master tetm 
                                                   left join tbl_tablebillmaster bm on bm.bm_billno=tetm.bem_billno
                                                   where  $stringstatdi $string group by tetm.bem_taxid "); 
             //echo "select tf.fr_floorname,sum(bm_finaltotal) as tot, (sum(bm_subtotal)-sum(bm_discountvalue)) as totexcl,sum(bm_servicetax) as totserv,sum(bm_servicecharge) as totservcharge,sum(bm_vat) as totvat,sum(bm_roundoff_value) as totroundof,tf.fr_servicetax,tf.fr_vat,tf.fr_servicecharge FROM tbl_tablebillmaster bm left join tbl_floormaster tf on tf.fr_floorid=bm.bm_floorid where  $stringstatdi $string group by fr_servicetax,fr_vat,fr_servicecharge";
            $num_login5   = $database->mysqlNumRows($sql_login5);
            if($num_login5){
                while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
			{   
			$di_tax_sum=$di_tax_sum+$result_login5['tax_sum'];
                                    
                                   
                                        $bilno= array(
                                            new bilno("Dine-In   ".$result_login5['bem_label'],number_format($result_login5['tax_sum'],$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                            $return .=$left.($bilno);
                                        }
                                             $return.="\r\n";
                                } 
                            } 

            
         
           
                    if($salesexcltaxta!=0)
                        {   
                        
                        if($_SESSION['uae_tax_enable']=='Y'){
                                     $bilno= array(
					new bilno("Take Away Excl.Tax",number_format($uae_subtotal_ta,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                             }else{
                            $bilno= array(
					new bilno("Take Away Excl.Tax",number_format($salesexcltaxta,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                             }
                                $return.="\r\n";
                            
                        }
                   if($taxexemptta!=0)
                            {
                                $bilno= array(
					new bilno("Tax Exempted Amount-TA",number_format($taxexemptta,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n";
                            }
                            for($s=0;$s<count($ta_tax_value['TA']['label']);$s++){
                           $ta_tax_valueta=$ta_tax_valueta+$ta_tax_value['TA']['value'][$s];
                            $bilno= array(
                            new bilno("Take Away   ".$ta_tax_value['TA']['label'][$s],number_format($ta_tax_value['TA']['value'][$s],$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$return .=$left.($bilno);
                            }
                            $return.="\r\n";
                       }
            
            if($salesexcltaxcs!=0)
                {   
                
                if($_SESSION['uae_tax_enable']=='Y'){
                                     $bilno= array(
					new bilno("Counter Sales Excl.Tax",number_format($uae_subtotal_cs,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                             }else{
                    $bilno= array(
				new bilno("Counter Sales Excl.Tax",number_format($salesexcltaxcs,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                             }
                                $return.="\r\n";
                }
                if($taxexemptcs!=0)
                    {
                            $bilno= array(
				new bilno("Tax Exempted Amount-CS",number_format($taxexemptcs,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n";
                    }
                for($s=0;$s<count($ta_tax_value['CS']['label']);$s++){
                           $ta_tax_valuecs=$ta_tax_valuecs+$ta_tax_value['CS']['value'][$s];
                            $bilno= array(
                            new bilno("Counter Sales   ".$ta_tax_value['CS']['label'][$s],number_format($ta_tax_value['CS']['value'][$s],$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$return .=$left.($bilno);
                            }
                            $return.="\r\n";
                       }
            
            if($salesexcltaxhd!=0)
                {   
                
                if($_SESSION['uae_tax_enable']=='Y'){
                                     $bilno= array(
					new bilno("Home Delivery Excl.Tax",number_format($uae_subtotal_hd,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                             }else{
                    $bilno= array(
				new bilno("Home Delivery Excl.Tax",number_format($salesexcltaxhd,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                             }
                                $return.="\r\n";
                    
                }  
                if($taxexempthd!=0)
                             {
                    $bilno= array(
				new bilno("Tax Exempted Amount-HD",number_format($taxexempthd,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n";
                            }
                for($s=0;$s<count($ta_tax_value['HD']['label']);$s++){
                           $ta_tax_valuehd=$ta_tax_valuehd+$ta_tax_value['HD']['value'][$s];
                            $bilno= array(
                            new bilno("Home Delivery   ".$ta_tax_value['HD']['label'][$s],number_format($ta_tax_value['HD']['value'][$s],$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$return .=$left.($bilno);
                            }
                            $return.="\r\n";
                       }
               
                             if($tot_roundof!=0)
                             {
                                 $bilno= array(
				new bilno("Round Off(Total)",number_format($tot_roundof,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                                $return.="\r\n";
                            }
                             $return.="\r\n";
                           $return.="----------------------------------------------------------------------";
                           $return.="\r\n"; 
                           
                           
                           
                           
                          
                    $del=0; 
 
$sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster  where $stringhd and tab_complimentary!='Y' "); 
$old='';$new='';	 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                        $del=	$del+$result_login['tab_delivery_charge'];
                        }
          }
          
          if($del>0){
                    $bilno= array(
				new bilno("Home Delivery Charge",number_format($del,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                    
                   
                    $return.="\r\n";
                           $return.="----------------------------------------------------------------------";
                           $return.="\r\n"; 
          } 
                           
                           
                          if($_SESSION['uae_tax_enable']=='Y'){ 
                           $bilno= array(
				new bilno("Sale Inc.Tax",number_format(str_replace(',','',$total),$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                          }else{
                               $bilno= array(
				new bilno("Sale Inc.Tax",number_format(str_replace(',','',$salesexcltaxdi+$salesexcltaxta+$salesexcltaxcs+$salesexcltaxhd+$ta_tax_valueta+$ta_tax_valuecs+$ta_tax_valuehd+$di_tax_sum+$totroundofff+$del),$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
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

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
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
			$return.=$result_login['qty'].'*'.number_format($result_login['Unit_Price'],$_SESSION['be_decimal']).'=';
			//$return.='                               ';
			//$return.='                      ';
			$return.=number_format($result_login['Total'],$_SESSION['be_decimal']);
		
			$return.="\r\n";	
			/*$return.="\r\n";	*/
			$i++;
			
			}
	  }

			$return.="\r\n";
			$return.="-----------------------------------------------------";	
			$return.="\r\n";
$return.="TOTAL -                            ".number_format($final,$_SESSION['be_decimal'])."";
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
   
			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
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
			$return.=$result_login['qty'].'*'.number_format($result_login['Unit_Price'],$_SESSION['be_decimal']).'=';
			//$return.='                               ';
			//$return.='                      ';
			$return.=number_format($result_login['Total'],$_SESSION['be_decimal']);
		
			$return.="\r\n";	
			/*$return.="\r\n";	*/
			$i++;
			
			}
	  }

			$return.="\r\n";
			$return.="-----------------------------------------------------";	
			$return.="\r\n";
$return.="TOTAL -                            ".number_format($final,$_SESSION['be_decimal'])."";
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
	


			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
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
    $return.="Cash                                          " .number_format($result_login['tot'],$_SESSION['be_decimal'])." ";
				$return.="\r\n";
	 ?>
 
  <?php } }
  
  
  
  $sql_login  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
    $return.="Credit                                        ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
					$return.="Coupons                                       ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
					$return.="Voucher                                       ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
					$return.="\r\n";
					
	 ?>
 
  <?php } }
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string5_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Cheque                                        ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  
  
  
    $sql_login  =  $database->mysqlQuery("select IFNULL($string6_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Credits                                       ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string7_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Complimentary                                 ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
					$return.="Beverage Sale                                 ".number_format($result_report['Total'],$_SESSION['be_decimal'])."";
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
					$return.="Food Sale                                     ".number_format($result_report['Total'],$_SESSION['be_decimal'])."";
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
				
				$return.="Total Discount                                ".number_format($disc,$_SESSION['be_decimal'])."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  
  
        $return.="-----------------------------------------------------";	
  
  	$return.="\r\n";
  	$return.="TOTAL -                                       ".number_format($subtotal,$_SESSION['be_decimal'])."";
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
	

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
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
    $return.="Cash                                          " .number_format($result_login['tot'],$_SESSION['be_decimal'])." ";
				$return.="\r\n";
	 ?>
 
  <?php } }
  
  
  
  $sql_login  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
    $return.="Credit                                        ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
					$return.="Coupons                                       ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
					$return.="Voucher                                       ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
					$return.="\r\n";
					
	 ?>
 
  <?php } }
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string5_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Cheque                                        ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  
  
  
    $sql_login  =  $database->mysqlQuery("select IFNULL($string6_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
				
				$return.="Credits                                       ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
						$return.="\r\n";	
							
							
	 ?>

  <?php } }
  
  
  $sql_login  =  $database->mysqlQuery("select IFNULL($string7_str,0.00) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal1 =$subtotal1 + $result_login['tot'];
				
				$return.="Complimentary                                 ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
  	$return.="TOTAL -                                       ".number_format($subtotal,$_SESSION['be_decimal'])."";
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
			$reporthead="On ".$datedayclose; 
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
    $return.="GROSS TURN OVER                               " .number_format($g,$_SESSION['be_decimal'])." ";
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
    $return.="TOTAL SERVICE TAX                             ".number_format($t,$_SESSION['be_decimal'])."";
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
					$return.="TOTAL VAT                                     ".number_format($v,$_SESSION['be_decimal'])."";
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
    $return.="TOTAL TAX                                     ".number_format($tax,$_SESSION['be_decimal'])."";
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
			$return.="NET TURN OVER                                 ".number_format($n,$_SESSION['be_decimal'])."";
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

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
			$string.= "ch.ch_dayclosedate ='".$datedayclose."' ";
			$reporthead.="On ".$datedayclose ; 
		
		$menulist= array(
                        new report_headnew("Dine In"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew("Item Cancel History Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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
					$return .=$left.($menulist);
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
					$return .=$left.($menulist);
			}
                        $return.="\r\n";
                        $menulist= array(
                        new cancel_history("","Reason - ",$chr,"","",""),
                            );
                        foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
			$string.= "b.bm_dayclosedate ='".$datedayclose."' ";
			$reporthead.="On ".$datedayclose; 
		
		
//			$return.="-----------------------------------------------------------------------------------------------------------";	
		$menulist= array(
                        new report_headnew("Dine In"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew("Bill Cancel Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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
					$return .=$left.($menulist);
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
                                new menulist($i,$result_login['bm_billno'],number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']), $result_login['ser_firstname']),
                            );
                            foreach($menulist as $menulist) {
					$return .=$left.($menulist);
                                        
                            }
                            $return.="\r\n";
                          $menulist= array(
                                new menulist("Reason - ",$cancelledreason,"",""),
                            );
                            foreach($menulist as $menulist) {
					$return .=$left.($menulist);
                                        
                            }    
                            $return.="\r\n";
			$i++;
			
			}
	  }
		$return.="\r\n";
                $return.="----------------------------------------------------------------------";
                $return.="\r\n";
                $menulist= array(
                        new menulist("Total","",number_format($subtotal,$_SESSION['be_decimal']), ""),
                    );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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
	
                        $from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
			$string.= "tab_dayclosedate ='".$datedayclose."' ";
				$reporthead.="On ".$datedayclose; 
				
                                $menulist= array(
                        new report_headnew("Counter Sale"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew("Total Sales Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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
					$return .=$left.($menulist);
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
                                new menulist($i,$database->convert_date($result_login['tab_dayclosedate']),$result_login['tab_billno'], number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])),
                            );
                            foreach($menulist as $menulist) {
					$return .=$left.($menulist);
                            }
                            $return.="\r\n";
			 }
			}
                    }

			$return.="\r\n";
			
			$return.="----------------------------------------------------------------------";
			$return.="\r\n";
                        $menulist= array(
                        new menulist("Bills-".($i),"Total","",number_format($subtotal,$_SESSION['be_decimal'])),
                            );
                                foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                        $return.="\r\n";
		        
                        $return.="----------------------------------------------------------------------";
                        $return.="\r\n";
                        
                                }

else if($_SESSION['type']=="itemordered_cs")
{
		
   $reporthead="";
 
  $string=" tbm.tab_status='Closed' AND tbm.tab_mode='CS' AND ";

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
			$string.= " tbm.tab_dayclosedate ='".$datedayclose."' ";
			$reporthead.="      On =".$datedayclose ; 
		
		
		
//			$return.="-----------------------------------------------------";	
		$return.="\r\n";
                $return.="\r\n";
                $return.="                    Counter Sale" ;
                $return.="\r\n";
		$return.="                Items Ordered Report" ;
                $return.="\r\n";
	
$return.="           ".$reporthead   ;

	$return.="\r\n";
	$return.="-----------------------------------------------------";	
	$return.="\r\n";
	
	$return.="Slno  Item                                  ";
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
			$return.=      $result_login['qty'].'*'.number_format($result_login['Unit_Price'],$_SESSION['be_decimal']).'   =   ';
			//$return.='                               ';
			//$return.='                      ';
			$return.=   number_format($result_login['Total'],$_SESSION['be_decimal']);
		
			$return.="\r\n";	
			/*$return.="\r\n";	*/
			$i++;
			
			}
	  }

			$return.="\r\n";
			$return.="-----------------------------------------------------";	
			$return.="\r\n";
$return.="TOTAL -                                 ".number_format($final,$_SESSION['be_decimal'])."";
	//$return.="TOTAL -                                      ".$final."";
		$return.="\r\n";	
		        $return.="------------------------------------------------------";	
	
                        
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
			$return.=      $result_login['qty'].'*'.number_format($result_login['Unit_Price'],$_SESSION['be_decimal']).'   =   ';
			//$return.='                               ';
			//$return.='                      ';
			$return.=   number_format($result_login['Total'],$_SESSION['be_decimal']);
		
			$return.="\r\n";	
			/*$return.="\r\n";	*/
			$i++;
			
			}
	  }

			$return.="\r\n";
			$return.="-----------------------------------------------------";	
			$return.="\r\n";
$return.="TOTAL -                               ".number_format($final,$_SESSION['be_decimal'])."";
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
  
  

  $string=" tbm.tab_status='Cancelled' AND tbm.tab_mode='CS' AND ";
                        
                        $from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
			$string.= "tbm.tab_dayclosedate ='".$datedayclose."' ";
			$reporthead.="On ".$datedayclose ; 
				
		
		
//			$return.="-----------------------------------------------------------------------------------------------------------";	
		$menulist= array(
                        new report_headnew("Counter Sale"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew("Bill Cancel Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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
					$return .=$left.($menulist);
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
                                    new menulist($i,$result_login['tab_billno'],number_format($result_login['tab_netamt'],$_SESSION['be_decimal']), $result_login['ser_firstname']),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=$left.($menulist);
                                    }
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist("Reason",$cancelledreason,"",""),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=$left.($menulist);
                                    }
                    $return.="\r\n";
                    
                 
			$i++;
			
			}
	  }
		$return.="\r\n";
                $return.="----------------------------------------------------------------------";
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist("TOTAL","",number_format($subtotal,$_SESSION['be_decimal']),""),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=$left.($menulist);
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

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
			$string.= "tab_dayclosedate ='".$datedayclose."' ";
			$reporthead.="On ".$datedayclose ; 
			$return.="\r\n";	
		$menulist= array(
                        new report_headnew("Take Away"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew("Total Sales Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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
					$return .=$left.($menulist);
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
                                new menulist($i,$database->convert_date($result_login['tab_dayclosedate']),$result_login['tab_billno'], number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])),
                            );
                            foreach($menulist as $menulist) {
					$return .=$left.($menulist);
                            }
                            $return.="\r\n";
			
                        }
			}
	  }

			$return.="\r\n";
			
			$return.="----------------------------------------------------------------------";
			$return.="\r\n";
                        $menulist= array(
                        new menulist("Bills-".($i),"Total","",number_format($subtotal,$_SESSION['be_decimal'])),
                            );
                                foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
			$string.= "tab_dayclosedate ='".$datedayclose."' ";
				$reporthead.="On ".$datedayclose ; 
				
				$menulist= array(
                        new report_headnew("Home Delivery"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew("Total Sales Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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
					$return .=$left.($menulist);
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
                                new menulist($i,$database->convert_date($result_login['tab_dayclosedate']),$result_login['tab_billno'], number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])),
                            );
                            foreach($menulist as $menulist) {
					$return .=$left.($menulist);
                            }
                            $return.="\r\n";
			
                        }
			}
	  }

			$return.="\r\n";
			
			$return.="----------------------------------------------------------------------";
			$return.="\r\n";
                        $menulist= array(
                        new menulist("Bills-".($i),"Total","",number_format($subtotal,$_SESSION['be_decimal'])),
                            );
                                foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
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
			$return.=      $result_login['qty'].'*'.number_format($result_login['Unit_Price'],$_SESSION['be_decimal']).'   =   ';
			//$return.='                               ';
			//$return.='                      ';
			$return.=   number_format($result_login['Total'],$_SESSION['be_decimal']);
		
			$return.="\r\n";	
			/*$return.="\r\n";	*/
			$i++;
			
			}
	  }

			$return.="\r\n";
			$return.="-----------------------------------------------------";	
			$return.="\r\n";
                        $return.="TOTAL -                             ".number_format($final,$_SESSION['be_decimal'])."";
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
			$return.=      $result_login['qty'].'*'.number_format($result_login['Unit_Price'],$_SESSION['be_decimal']).'   =   ';
			//$return.='                               ';
			//$return.='                      ';
			$return.=   number_format($result_login['Total'],$_SESSION['be_decimal']);
		
			$return.="\r\n";	
			/*$return.="\r\n";	*/
			$i++;
			
			}
	  }

			$return.="\r\n";
			$return.="-----------------------------------------------------";	
			$return.="\r\n";
$return.="TOTAL -                             ".number_format($final,$_SESSION['be_decimal'])."";
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
  

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
			$string.= "tbm.tab_dayclosedate ='".$datedayclose."' ";
			$reporthead.="On ".$datedayclose; 
				
		$menulist= array(
                        new report_headnew("Take Away"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew("Bill Cancel Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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
					$return .=$left.($menulist);
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
                                    new menulist($i,$result_login['tab_billno'],number_format($result_login['tab_netamt'],$_SESSION['be_decimal']), $result_login['ser_firstname']),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=$left.($menulist);
                                    }
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist("Reason",$cancelledreason,"",""),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=$left.($menulist);
                                    }
                    $return.="\r\n";
                    
                 
			$i++;
			
			}
	  }
		$return.="\r\n";
                $return.="----------------------------------------------------------------------";
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist("TOTAL","",number_format($subtotal,$_SESSION['be_decimal']),""),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=$left.($menulist);
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
  

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
			$string.= "tbm.tab_dayclosedate ='".$datedayclose."' ";
			$reporthead.="On ".$datedayclose; 
				
		$menulist= array(
                        new report_headnew("Home Delivery"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew("Bill Cancel Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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
					$return .=$left.($menulist);
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
                                    new menulist($i,$result_login['tab_billno'],number_format($result_login['tab_netamt'],$_SESSION['be_decimal']), $result_login['ser_firstname']),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=$left.($menulist);
                                    }
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist("Reason",$cancelledreason,"",""),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=$left.($menulist);
                                    }
                    $return.="\r\n";
                    
                 
			$i++;
			
			}
	  }
		$return.="\r\n";
                $return.="----------------------------------------------------------------------";
                    $return.="\r\n";
                    $menulist= array(
                                    new menulist("TOTAL","",number_format($subtotal,$_SESSION['be_decimal']),""),
                            );
                                foreach($menulist as $menulist) {
                                                    $return .=$left.($menulist);
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
	

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
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
    $return.="Cash                                          " .number_format($result_login['tot'],$_SESSION['be_decimal'])." ";
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
   
  $return.="Credit                                        ".number_format($tot_credit,$_SESSION['be_decimal'])."";
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
					$return.="Coupons                                       ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
					$return.="Voucher                                       ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
				
				$return.="Cheque                                        ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
				
				$return.="Credits                                       ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
				
				$return.="Complimentary                                 ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
						$return.="\r\n";	
						
							
	 ?>

  <?php } }
  else
  {
                    $return.="Complimetary                                  0.00";
					$return.="\r\n";
  }
  
  
  

  
  
        $return.="---------------------------------------------------------";	
  
  	$return.="\r\n";
  	$return.="TOTAL -                                       ".number_format($subtotal,$_SESSION['be_decimal'])."";
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
	

			$from=$_SESSION['dateopen'];
			$to=$_SESSION['dateopen'];
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
  $return.="Cash                                          " .number_format($total_cash,$_SESSION['be_decimal']);
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
   $return.="Credit                                        ".number_format($tot_credit,$_SESSION['be_decimal'])."";
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
					$return.="Voucher                                       ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
				
				$return.="Cheque                                        ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
				
				$return.="Credits                                       ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
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
				
				$return.="Complimentary                                 ".number_format($result_login['tot'],$_SESSION['be_decimal'])."";
						$return.="\r\n";	
						
							
	 ?>

  <?php } }
  else
  {
                    $return.="Complimetary                                  0.00";
					$return.="\r\n";
  }
  
  
  

  	
	
  
   
  
  
        $return.="---------------------------------------------------------";	
  
  	$return.="\r\n";
  	$return.="TOTAL -                                       ".number_format($subtotal,$_SESSION['be_decimal'])."";
	$return.="\r\n";
        $return.="---------------------------------------------------------";
	//$return.="\r\n";
}
 
if( $_SESSION['type']=="complimentary_cr")
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
                        
			$reporthead.="On ".$datedayclose ; 
				
				
                $return.="\r\n";
                $menulist= array(
                        new report_headnew("Consolidated Complimentary Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
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
					$return .=$left.($menulist);
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
                                            new menulist($i,$result_login['bill'],$result_login['mode'],number_format($result_login['total'],$_SESSION['be_decimal'])),
                                    );
                                        foreach($menulist as $menulist) {
                                                            $return .=$left.($menulist);
                                            }
                            $return.="\r\n";
                        }
			}
	  

			$return.="\r\n";
                        $return.="----------------------------------------------------------------------";
                        $return.="\r\n";
                        $menulist= array(
                                        new menulist("Bills-".$i,"","Total",number_format($subtotal,$_SESSION['be_decimal'])),
                                );
                                    foreach($menulist as $menulist) {
                                                        $return .=$left.($menulist);
                                        }
                        $return.="\r\n";
                        $return.="----------------------------------------------------------------------";
                        $return.="\r\n";

    }
    
else if($_SESSION['type']=="discount_report_cr")
{
     //echo "haiii";
    	
	$string="";
        $stringta="";
	$string=" bm_status='Closed' AND bm_dayclosedate = '".$datedayclose."' ";
        $stringta=" tab_status='Closed' AND tab_dayclosedate = '".$datedayclose."'";
	$reporthead="On ".$datedayclose ;
	
          $discountdine=0;
          $discounttacshd=0;
                                
                            $return.="\r\n";
                $menulist= array(
                        new report_headnew("Consolidated Discount Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                             
                            $return.="----------------------------------------------------------------------";
                            $return.="\r\n";
                            $bilno= array(
					new bilno("Mode","Value"),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
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
					new bilno("DINE IN",number_format($discountdine,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
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
					new bilno($mde,number_format($discountta,$_SESSION['be_decimal'])),
				);
				foreach($bilno as $bilno) {
					$return .=$left.($bilno);
				}
                            $return.="\r\n";
                                            
                 }  
                }
	  }

                  			$return.="----------------------------------------------------------------------";
                                        $return.="\r\n";
                                        $bilno= array(
					new bilno("Total",number_format(($discountdine+$discounttacshd),$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                        $return.="\r\n";
                                        $return.="----------------------------------------------------------------------";
                                        $return.="\r\n";
				
} 
else if($_SESSION['type']=="regenerate_logs")
{
    
    	 $reporthead="";
 
          $string=""; 

			
			$string.= "DATE(rt.re_datetime) ='".$datedayclose."' ";
			$reporthead.="On ".$datedayclose ; 
		
		
                $return.="\r\n";
                $menulist= array(
                        new report_headnew(" Regenerate Log Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}

	$return.="\r\n";
        $return.="------------------------------------------------------------------------------------------------";
	$return.="\r\n";
	$menulist= array(
                        new regenerate("Bill No","Time","Staff","Reason","First BillAmount"," New BillAmount","Login"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
        $return.="------------------------------------------------------------------------------------------------";                
	$return.="\r\n";
	
	

       $cur=date("Y-m-d");
       
       
 	  $sql_login  =  $database->mysqlQuery("Select  bm.bm_finaltotal,bm.bm_billno,rg.rr_reason,rt.re_billno,TIME(rt.re_datetime)as time,st.ser_firstname,rt.re_reason,rt.re_loginid,rt.re_amount  From tbl_regenrate_log rt left join tbl_staffmaster st on st.ser_staffid=rt.re_staffid left join tbl_regenerate_reasons rg on rg.rr_id=rt.re_reason left join tbl_tablebillmaster bm on bm.bm_billno=rt.re_billno where  $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{

                        $bill_re=$result_login['re_billno'];
                         $date_re=$result_login['time'];
                         $staff_re=$result_login['ser_firstname'];
                          $reason_re=$result_login['re_reason'].$result_login['rr_reason'];
                           $amount_re_first=number_format($result_login['re_amount'],$_SESSION['be_decimal']);
                           if($result_login['bm_finaltotal']!="" && $result_login['bm_finaltotal']>0){
                            $amount_re_new=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
                           }else{
                               $amount_re_new=number_format(0,$_SESSION['be_decimal']);
                           }
                            $login_re=$result_login['re_loginid'];
                            
                        $before_regen=$before_regen+$result_login['re_amount'];
                                $after_regen=$after_regen+$result_login['bm_finaltotal'];
                        
                        $return.="\r\n";
                        $menulist= array(
                        new regenerate($bill_re,$date_re,$staff_re,$reason_re,$amount_re_first,$amount_re_new,$login_re),
                            );
                        foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                       
                        $return.="\r\n";
                        
			
			
			}
	  }
             $return.="-----------------------------------------------------------------------------------------------";
		$return.="\r\n";
            $menulist= array(
          new regenerate("Total","","","",number_format($before_regen,$_SESSION['be_decimal']),number_format($after_regen,$_SESSION['be_decimal']),""),
                            );
                        foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
          
            $return.="------------------------------------------------------------------------------------------------";
		$return.="\r\n";	
				
} 

 else if($val=="credit_details")
 {
	   $string="";
	  $reporthead="";
	  $st="";
	  $string.= "(bm.bm_dayclosedate ='".$datedayclose."'  or  tbm.tab_dayclosedate = '".$datedayclose."' ) ";
           $reporthead="On  ".$datedayclose;
				
		
	$final=0;
/*	echo "select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id where $string order by cd.cd_dateofentry ASC";
	die();*/
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno WHERE $string  order by cd.cd_dateofentry ASC"); 
	  //echo "select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno WHERE $string  order by cd.cd_dateofentry ASC";
          $num_login   = $database->mysqlNumRows($sql_login);
		 if($num_login)
                         {
                            $final=0;$i=1;$remark="";
                             $return.="\r\n";
                $menulist= array(
                        new report_headnew(" Credit Details Report"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                $menulist= array(
                        new report_headnew($reporthead),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
                $return.="\r\n";
                         
                            
                            $return.="----------------------------------------------------------------------";
                            $return.="\r\n";
                            $menulist= array(
                                            new credit_details("Slno "," Party","Bill No","Credit"),
                                    );
                                        foreach($menulist as $menulist) {
                                                            $return .=$left.($menulist);
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
                                            new credit_details($i,$party,$result_login['cd_billno'],number_format($result_login['cd_amount'],$_SESSION['be_decimal'])),
                                    );
                                        foreach($menulist as $menulist) {
                                                            $return .=$left.($menulist);
                                            }
                                $return.="\r\n";
				
				
					$i++;
                         }}         
                         
                                $return.="----------------------------------------------------------------------";
                                $return.="\r\n";
                                $menulist= array(
                                            new credit_details("Total","","",number_format($final,$_SESSION['be_decimal']),""),
                                    );
                                        foreach($menulist as $menulist) {
                                                            $return .=$left.($menulist);
                                            }
                                $return.="----------------------------------------------------------------------";                
                                $return.="\r\n";
                         
				
  
  }      
  
  else if($_SESSION['type']=="consolidated_payment_cr")
{
  $return.="\r\n";
   $return.="\r\n";
   $menulist= array(
                        new report_headnew(" DEBIT/CREDIT CARD / UPI PAYMENTS REPORT"),
                );
                    foreach($menulist as $menulist) {
					$return .=$left.($menulist);
			}
              $return.="----------------------------------------------------------------------";
              
            $return.="\r\n";   
              
              $menulist= array(
                                            new credit_details("MODE","CARD/UPI","AMOUNT","",""),
                                    );
                                        foreach($menulist as $menulist) {
                                                            $return .=$left.($menulist);
                                            }
                                            
  $return.="----------------------------------------------------------------------";             
                $return.="\r\n";
  
               $stringbnk_dt_di=''; 
               
               
          $stringbnk_dt_di .=" bm_status='Closed' AND bm_complimentary!='Y' AND  ";     
          $stringbnk_dt_di.= " bm_dayclosedate between '".$datedayclose."' and '".$datedayclose."' ";  
          
          
          $stringbnk_dt_ta=''; 
               
               
          $stringbnk_dt_ta .=" tab_status='Closed' AND tab_complimentary!='Y' AND  ";     
          $stringbnk_dt_ta.= " tab_dayclosedate between '".$datedayclose."' and '".$datedayclose."' ";  
                
       $tot_di_bnk=0; $tot_ta_bnk  =0;     
  $sql_logincredit  =  $database->mysqlQuery("select distinct (bm_name) as bnk, sum(bm_transactionamount) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and  $stringbnk_dt_di and pym_code='credit' group by bm_name  order by bnk desc "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{  
                      
                     $tot_di_bnk=$tot_di_bnk+$result_logincredit['tot'];
                                $return.="\r\n";
                                $menulist= array(
                                            new credit_details("DINE- IN ",$result_logincredit['bnk'],number_format($result_logincredit['tot'],$_SESSION['be_decimal'])," "," "),
                                    );
                                        foreach($menulist as $menulist) {
                                                            $return .=$left.($menulist);
                                            }
                                       
                                $return.="\r\n";  
                            
          }}
          
           $return.="----------------------------------------------------------------------"; 
          
           $sql_logincreditta  =  $database->mysqlQuery("select distinct (bm_name) as bnk, sum(tab_transactionamount) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and $stringbnk_dt_ta   and pym_code='credit' group by bm_name  order by bnk desc "); 
	  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
	  if($num_logincreditta){
		  while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
			{ 
                
                      $tot_ta_bnk=$tot_ta_bnk+$result_logincreditta['tot'];
                  
                                $return.="\r\n";
                                $menulist= array(
                                            new credit_details("TA-CS-HD ",$result_logincreditta['bnk'],number_format($result_logincreditta['tot'],$_SESSION['be_decimal'])," "," "),
                                    );
                                        foreach($menulist as $menulist) {
                                                            $return .=$left.($menulist);
                                            }
                                              
                                $return.="\r\n";    
              
        
          }}
          
          
           $return.="----------------------------------------------------------------------"; 
          
        $return.="\r\n";    
        $tot_bnk_all = $tot_ta_bnk+$tot_di_bnk;
           
           
        $menulist= array(
                                            new credit_details("TOTAL ","",number_format($tot_bnk_all,$_SESSION['be_decimal']),"",""),
                                    );
                                        foreach($menulist as $menulist) {
                                                            $return .=$left.($menulist);
                                            }  
          
      $return.="----------------------------------------------------------------------";     
           $return.="\r\n"; $return.="\r\n";
}
  //card_end//////
  
  
  
  
  
  
  
  
  
  ////template queries////
  
  
   ///ta bills amount//
   
   $ta_bil_ta_tot=0;
   $sql_login  =  $database->mysqlQuery("Select sum(tab_netamt) as tot_ta  from  tbl_takeaway_billmaster where tab_mode='TA' and tab_status='Closed' and tab_complimentary='N' and tab_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq81  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                     
                      $ta_bil_ta_tot=$result_loginq81['tot_ta'];
                  }
                  }
  //cs//
  
  $ta_bil_cs_tot=0;
   $sql_login  =  $database->mysqlQuery("Select sum(tab_netamt) as tot_cs from  tbl_takeaway_billmaster where tab_mode='CS' and tab_status='Closed' and tab_complimentary='N' and tab_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq91  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                    
                      $ta_bil_cs_tot=$result_loginq91['tot_cs'];
                  }
                  }
                  
                  
          //hd//
                   $ta_bil_hd_tot=0;
   $sql_login  =  $database->mysqlQuery("Select sum(tab_netamt) as tot_hd from  tbl_takeaway_billmaster where tab_mode='HD' and tab_status='Closed' and tab_complimentary='N' and  tab_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq01  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                     
                      $ta_bil_hd_tot=$result_loginq01['tot_hd'];
                  }
                  }
  
  
   $di_ct_tot=0;
   $sql_login  =  $database->mysqlQuery("Select sum(bm_finaltotal) as di_bill_count_tot from  tbl_tablebillmaster where bm_status='Closed' and bm_complimentary='N' and bm_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $di_ct_tot=$result_loginq['di_bill_count_tot'];
                  }
                  }
                  
                  
                  
  
  ///ta bills count//
   $ta_bil_ta=0;
  
   $sql_login  =  $database->mysqlQuery("Select count(tab_billno) as ta_bill_countt  from  tbl_takeaway_billmaster where tab_mode='TA' and tab_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq81  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $ta_bil_ta=$result_loginq81['ta_bill_countt'];
                     
                  }
                  }
  //cs//
  
   $ta_bil_cs=0;
   $sql_login  =  $database->mysqlQuery("Select count(tab_billno) as ta_bill_countc  from  tbl_takeaway_billmaster where tab_mode='CS' and tab_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq91  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $ta_bil_cs=$result_loginq91['ta_bill_countc'];
                     
                  }
                  }
                  
                  
          //hd//
                   $ta_bil_hd=0;
   $sql_login  =  $database->mysqlQuery("Select count(tab_billno) as ta_bill_counth from  tbl_takeaway_billmaster where tab_mode='HD' and tab_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq01  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $ta_bil_hd=$result_loginq01['ta_bill_counth'];
                      
                  }
                  }
                  
  
  // billcount//
  
   $di_ct=0;
   $sql_login  =  $database->mysqlQuery("Select count(bm_billno) as di_bill_count from  tbl_tablebillmaster where bm_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $di_ct=$result_loginq['di_bill_count'];
                  }
                  }
  $ta_hd_cs_ct=0;
   $sql_login  =  $database->mysqlQuery("Select count(tab_billno) as ta_bill_count from  tbl_takeaway_billmaster where tab_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq1  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $ta_hd_cs_ct=$result_loginq1['ta_bill_count'];
                  }
                  }
  $temp_tot_bill=$di_ct+$ta_hd_cs_ct;
  
      // billcancel//            
           
  $di_ct_bill_cancel=0;
   $sql_login  =  $database->mysqlQuery("Select count(bm_billno) as di_bill_count1 from  tbl_tablebillmaster where bm_status='Cancelled' and bm_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq3  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $di_ct_bill_cancel=$result_loginq3['di_bill_count1'];
                  }
                  }
  $ta_hd_cs_ct_bill_cancel=0;
   $sql_login  =  $database->mysqlQuery("Select count(tab_billno) as ta_bill_count1 from  tbl_takeaway_billmaster where tab_status='Cancelled' and  tab_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq14  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $ta_hd_cs_ct_bill_cancel=$result_loginq14['ta_bill_count1'];
                  }
                  }
  $temp_tot_bill_cancel=$di_ct_bill_cancel+$ta_hd_cs_ct_bill_cancel;
  
  
  //itemcancel//
   $di_ct_item_cancel=0;
   $sql_login  =  $database->mysqlQuery("Select count(ch_kot_cancel_id) as di_bill_count11 from  tbl_tableorder_changes where ch_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq35  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $di_ct_item_cancel=$result_loginq35['di_bill_count11'];
                  }
                  }
  $ta_hd_cs_ct_item_cancel=0;
   $sql_login  =  $database->mysqlQuery("Select count(tc_cancel_id) as ta_bill_count11 from  tbl_takeaway_cancel_items where  tc_dayclosedate='".$datedayclose."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
             
		  while($result_loginq145  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $ta_hd_cs_ct_item_cancel=$result_loginq145['ta_bill_count11'];
                  }
                  }
  $temp_tot_item_cancel=$di_ct_item_cancel+$ta_hd_cs_ct_item_cancel;
                  
  
  
  ///// top selling///
  
  $sql_best_selling =  $database->mysqlQuery("select sum(x.qty) as qty, x.menu as menu, sum(x.total) as total   from( 
                                                    select bd.bd_billno as bill, sum(bd.bd_qty) as qty,sum(bd.bd_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionname,''),COALESCE(REPLACE(bd.bd_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_tablebilldetails bd
                                                    LEFT  join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = bd.bd_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=bd.bd_portion
                                                    left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                                    where bd.bd_count_combo_ordering IS NULL and bm.bm_dayclosedate='".$datedayclose."' and bm.bm_status='Closed'
                                                    group by bd.bd_menuid, bd.bd_portion, bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_dayclosedate='".$datedayclose."' and bm.bm_status='Closed'
                                                    group by cbd.cbd_combo_pack_id,cbd.cbd_billno union all

                                                    select tbd.tab_billno as bill, sum(tbd.tab_qty) as qty,sum(tbd.tab_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionname,''),COALESCE(REPLACE(tbd.tab_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_takeaway_billdetails tbd
                                                    LEFT  join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = tbd.tab_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=tbd.tab_portion
                                                    left join  tbl_unit_master um on um.u_id=tbd.tab_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
                                                    where tbd.tab_count_combo_ordering IS NULL and tbm.tab_dayclosedate='".$datedayclose."' and tbm.tab_status='Closed'
                                                    group by tbd.tab_menuid, tbd.tab_portion, tbd.tab_unit_id, tbd.tab_base_unit_id,tbd.tab_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_dayclosedate='".$datedayclose."' and tbm.tab_status='Closed'
                                                    group by cbd.cbd_combo_pack_id,cbd.cbd_billno )
                                                    x group by x.menuid order by qty desc LIMIT 0,5");
        $num_best_selling = $database->mysqlNumRows($sql_best_selling);
        if($num_best_selling){
             $analytics_values_menu=array(); $analytics_values_qty=array(); $analytics_values_tot=array();
            while($result_best_selling = $database->mysqlFetchArray($sql_best_selling)){
               
                $analytics_values_menu[]=$result_best_selling['menu'];
                $analytics_values_qty[]=$result_best_selling['qty'];
                $analytics_values_tot[]= number_format($result_best_selling['total'],$_SESSION['be_decimal']);
               
            }
        } 
  
  
        
    ///most revenue ////    
        
        
         $sql_most_revenue =  $database->mysqlQuery("select sum(x.qty) as qty, x.menu as menu, sum(x.total) as total   from( 
                                                    select bd.bd_billno as bill, sum(bd.bd_qty) as qty,sum(bd.bd_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionname,''),COALESCE(REPLACE(bd.bd_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_tablebilldetails bd
                                                    LEFT  join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = bd.bd_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=bd.bd_portion
                                                    left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                                    where bd.bd_count_combo_ordering IS NULL and bm.bm_dayclosedate='".$datedayclose."' and bm.bm_status='Closed'
                                                    group by bd.bd_menuid, bd.bd_portion, bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_dayclosedate='".$datedayclose."' and bm.bm_status='Closed'
                                                    group by cbd.cbd_combo_pack_id,cbd.cbd_billno union all

                                                    select tbd.tab_billno as bill, sum(tbd.tab_qty) as qty,sum(tbd.tab_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionname,''),COALESCE(REPLACE(tbd.tab_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_takeaway_billdetails tbd
                                                    LEFT  join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = tbd.tab_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=tbd.tab_portion
                                                    left join  tbl_unit_master um on um.u_id=tbd.tab_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
                                                    where tbd.tab_count_combo_ordering IS NULL and tbm.tab_dayclosedate='".$datedayclose."' and tbm.tab_status='Closed'
                                                    group by tbd.tab_menuid, tbd.tab_portion, tbd.tab_unit_id, tbd.tab_base_unit_id,tbd.tab_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_dayclosedate='".$datedayclose."' and tbm.tab_status='Closed'
                                                    group by cbd.cbd_combo_pack_id,cbd.cbd_billno )
                                                    x group by x.menuid order by total desc LIMIT 0,5");
        $num_most_revenue = $database->mysqlNumRows($sql_most_revenue);
        if($num_most_revenue){
              $analytics_values_menu1=array(); $analytics_values_qty1=array(); $analytics_values_tot1=array();
            while($result_most_revenue = $database->mysqlFetchArray($sql_most_revenue)){
             
                $analytics_values_menu1[]=$result_most_revenue['menu'];
                $analytics_values_qty1[]=$result_most_revenue['qty'];
                $analytics_values_tot1[]= number_format($result_most_revenue['total'],$_SESSION['be_decimal']);
              
            }
        } 
        
       ////avg cost////
         $analytics_values_avg=0;
         
//       $sql_module_wise_sales =  $database->mysqlQuery("select 'DI' as mode, sum(bm.bm_finaltotal) as final,count(bm.bm_billno) as bills FROM tbl_tablebillmaster bm where bm.bm_status='Closed' and bm.bm_dayclosedate='".$datedayclose."' and bm.bm_complimentary!='Y' AND bm.bm_paymode IS NOT NULL union all
//                                                        select  tbm.tab_mode as mode, sum(tbm.tab_netamt) as final,count(tbm.tab_billno) as bills FROM tbl_takeaway_billmaster tbm where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$datedayclose."' and tbm.tab_complimentary!='Y' AND tbm.tab_paymode IS NOT NULL group by tbm.tab_mode");

//       $total_sales=0; $total_bills=0; $analytics_values_avg=0;
//        $num_module_wise_sales = $database->mysqlNumRows($sql_module_wise_sales);
//        if($num_module_wise_sales){
//            while($result_module_wise_sales = $database->mysqlFetchArray($sql_module_wise_sales)){
//                
//               
//               $total_sales=$result_module_wise_sales['final'];
//               $total_bills=$result_module_wise_sales['bills'];
//            }
//        }
//        
//      
//       if($total_bills>0){
//            $analytics_values_avg=number_format($total_sales/$total_bills,$_SESSION['be_decimal']);
//       }else{
//           $analytics_values_avg =number_format(0,$_SESSION['be_decimal']);
//       }
  
      $analytics_values_avg= number_format($temp_tot_summary/$temp_tot_bill,$_SESSION['be_decimal']);
       
    
       
       
       
}
	
	
		
$folder = '..\util\Dayclose_emails/';
if (!is_dir($folder))
mkdir($folder, 0777, true);
chmod($folder, 0777);

$date = date('m-d-Y-H-i-s', time()); 


$filename = $folder."Reports-".$datedayclose;

$handle = fopen($filename.'.txt','w+');
fwrite($handle,$return);
fclose($handle);


$msg_temp='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report Mailer</title>
<style>
@media (max-width: 700px) {
.mob_sec{width:100% !important;float:left}
}
td{font-size:12px}
	th{font-size:13px;color:#242424}
</style>
</head>

<body style="background-color:#fff;margin:0;padding:0; text-align: center;">

<div class="mob_sec" style="height:auto;margin:auto;width:800px;display:inline-block;border:solid 1px #e2e2e2; margin-top: 20px;background-color:#f5f5f5">

<span style="width:770px;float:left;color:#908e8e;font-size:14px;margin-bottom:0px;margin-top:5px;text-align:left;padding:15px"> 
<h1 style="color:#464646;margin-bottom: 4px;float: left;width: 100%;text-align: center;text-transform: uppercase;font-size: 22px;margin: 0;">daily sales report</h1>

</span>


	<div style="width:800px;height:auto;min-height:80px;float:left;background-color:#fff;box-shadow:0px 0px 15px #666;border-bottom:3px solid #ed1e26;">
    	 <div style="width:270px;height:auto;float:left;margin:10px 5px 0 0;">
         	<a href="#"><img width="95%" src="https://www.expodine.com/images/logo.png" /></a>
         </div>
         <div style="width:250px;height:auto;float:left;text-align:center;padding:0;font-family:Arial, Helvetica, sans-serif;    padding-top: 32px;;">
         <span style="width:100%;float:left;color:black;font-size:11px;margin-bottom:0px;"> SALES SUMMARY  </span>
         <strong style="color:#464646;font-size:20px;">'.$datedayclose.'</strong>
  </div>
         <div style="width:270px;height:auto;float:right;margin:10px 0 0 5px;text-align:right">
         <span  style="color: #666; text-align: center; float: left;width: 100%;padding-top: 24px;font-size: 16px;">Branch</span>
         	<a href="#" style="color: #313131;font-size: 13px;padding-top: 0px;display: inline-block;padding-right: 10px;text-decoration: none; text-transform: uppercase;    width: 100%; text-align: center;">'.$branchname.'</a>
     <span  style="color: #666; text-align: center; float: left;width: 100%;padding-top: 2px;">'.$addr.'</span>      
</div>
    </div>	
    


 
 
 <div style="width:800px;height:auto;float:left;padding: 0;">
 
 	<div class="left" style="width:800px;height:auto;float:left;">
    
    	<div style="width:800px;height:100px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;padding-top:15px;">
        	<span style="color:#727272;font-size:18px;">TOTAL SALE</span><br />
            <strong style="color:#f5351b;font-size:48px;">'.number_format($temp_tot_summary,$_SESSION['be_decimal']).'</strong>
        </div>
        
        <div style="width:190px;height:90px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;padding-top:30px;margin:8px 0 0 0">
        	<span style="color:#727272;font-size:12px;line-height:22px;">TOTAL BILLS</span><br />
            <strong style="color:#222222;font-size:20px;">'.$temp_tot_bill.'</strong>
        </div>
        
        <div style="width:180px;height:90px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;padding-top:30px;margin:8px 0 0 2%">
        	<span style="color:#727272;font-size:12px;line-height:22px;">ITEM CANCELLED</span><br />
            <strong style="color:#222222;font-size:20px;">'.$temp_tot_item_cancel.'</strong>
        </div>
        
        <div style="width:190px;height:90px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;padding-top:30px;margin:8px 0 0 2%">
        	<span style="color:#727272;font-size:12px;line-height:22px;">BILL CANCELLED</span><br />
            <strong style="color:#222222;font-size:20px;">'.$temp_tot_bill_cancel.'</strong>
        </div>
         <div style="width:190px;height:90px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;padding-top:30px;margin:8px 0 0 2%">
        	<span style="color:#727272;font-size:12px;line-height:22px;">AVG CST/PER</span><br />
            <strong style="color:#222222;font-size:20px;">'.$analytics_values_avg.'</strong>
        </div>
    </div>
    
    <div class="right" style="width:320px;height:auto;float:left;display:none">
    	<div style="width:313px;height:253px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;margin-left:2%;">
        	<div style="width:300px;height:213px;float:left;padding:2%;text-align:center">
                
            	<div style="width: 20px;height: 213px;background-color: #4d5360;float: left;margin-left: 42px;"></div>
                
            </div>
            <div style="width:312px;height:auto;float:left;text-align:center;">
            	<div style="width:50px;display:inline-block;height:auto;">
                	<div style="width:14px;height:14px;float:left;background-color:#4d5360"></div>
                    <div style="width:auto;height:auto;float:left;font-size:14px;padding-left:5px;">DI</div>
                </div>
                <div style="width:50px;display:inline-block;height:auto;">
                	<div style="width:14px;height:14px;float:left;background-color:#fdb45c"></div>
                    <div style="width:auto;height:auto;float:left;font-size:14px;padding-left:5px;">TA</div>
                </div>
                <div style="width:50px;display:inline-block;height:auto;">
                	<div style="width:14px;height:14px;float:left;background-color:#46bfbd"></div>
                    <div style="width:auto;height:auto;float:left;font-size:14px;padding-left:5px;">HD</div>
                </div>
                <div style="width:50px;display:inline-block;height:auto;">
                	<div style="width:14px;height:14px;float:left;background-color:#f7464a"></div>
                    <div style="width:auto;height:auto;float:left;font-size:14px;padding-left:5px;">CS</div>
                </div>
            </div>
        </div>
    </div>
    
 </div>
 


<a href="https://chart.googleapis.com/chart"></a>

 <div style="width:800px;height:auto;float:left;padding:2% 0;padding-top:0px">
 	<table width="800px" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif;letter-spacing:1px;vertical-align:middle;border:1px #e5e5e5 solid;box-shadow:2px 5px 10px #ccc">
    	<thead>
        	<tr>
            	<th style="background-color:#4d5360;padding:3%;color:#fff;font-size:20px;font-size:20px;" width="33.3">PAYMENT DETAILS</th>
                <th style="background-color:#d38a32;padding:3%;color:#fff;font-size:20px;font-size:20px;" width="33.3">SALES SUMMARY</th>
                <th style="background-color:#46bfbd;padding:3%;color:#fff;font-size:20px;font-size:20px;" width="33.3">BILL SUMMARY</th>
            </tr>
        </thead>
        <tbody>
        
        	<tr>
            	<td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#ffffff" width="33.3">
                	<span style="font-size:17px;color:#949494;">Cash</span><br />
                    <strong style="font-size:20px;color:#515151;">'. number_format($totalcash,$_SESSION['be_decimal']).'</strong>
                </td>
                <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#f5f5f5" width="33.3">
                	<span style="font-size:17px;color:#949494;">Dine in</span><br />
                    <strong style="font-size:20px;color:#515151;">'. number_format($di_ct_tot,$_SESSION['be_decimal']).'</strong>
                </td>
                <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#eeeeee" width="33.3">
                	<span style="font-size:17px;color:#949494;">Dine in</span><br />
                    <strong style="font-size:20px;color:#515151;">'.$di_ct.' bills</strong>
                </td>
            </tr>
            <tr>
            	<td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#ffffff" width="33.3">
                	<span style="font-size:17px;color:#949494;">Card </span><br />
                    <strong style="font-size:20px;color:#515151;">'. number_format($totalcredit,$_SESSION['be_decimal']).'</strong>
                </td>
                <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#f5f5f5" width="33.3">
                	<span style="font-size:17px;color:#949494;">Take Away</span><br />
                    <strong style="font-size:20px;color:#515151;">'. number_format($ta_bil_ta_tot,$_SESSION['be_decimal']).'</strong>
                </td>
                <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#eeeeee" width="33.3">
                	<span style="font-size:17px;color:#949494;">Take Away</span><br />
                    <strong style="font-size:20px;color:#515151;">'.$ta_bil_ta.' bills</strong>
                </td>
            </tr>
            <tr>
            	<td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#ffffff" width="33.3">
                	<span style="font-size:17px;color:#949494;">Complimentary</span><br />
                    <strong style="font-size:20px;color:#515151;">'. number_format($totalcomp,$_SESSION['be_decimal']).'</strong>
                </td>
                <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#f5f5f5" width="33.3">
                	<span style="font-size:17px;color:#949494;">Home Delivery</span><br />
                    <strong style="font-size:20px;color:#515151;">'. number_format($ta_bil_hd_tot,$_SESSION['be_decimal']).'</strong>
                </td>
                <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#eeeeee" width="33.3">
                	<span style="font-size:17px;color:#949494;">Home Delivery</span><br />
                    <strong style="font-size:20px;color:#515151;">'.$ta_bil_hd.' bills</strong>
                </td>
            </tr>
            <tr>
            	<td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;background-color:#ffffff" width="33.3">
                	<span style="font-size:17px;color:#949494;">Credit</span><br />
                    <strong style="font-size:20px;color:#515151;">'. number_format($totalcp,$_SESSION['be_decimal']).'</strong>
                </td>
                <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;background-color:#f5f5f5" width="33.3">
                	<span style="font-size:17px;color:#949494;">Counter Sales</span><br />
                    <strong style="font-size:20px;color:#515151;">'.  number_format($ta_bil_cs_tot,$_SESSION['be_decimal']).'</strong>
                </td>
                <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;background-color:#eeeeee" width="33.3">
                	<span style="font-size:17px;color:#949494;">Counter Sales</span><br />
                    <strong style="font-size:20px;color:#515151;">'.$ta_bil_cs.' bills</strong>
                </td>
            </tr>
            
        </tbody>
    </table>
    
    <div>
    

    <h1 style="text-align: left; margin-left:25px;">Credit Summary</h1>

 <div style="float: left; margin-left: 25px;">
        <h3 style="text-align: left; text-decoration: underline;">By Company</h3>
        <table style="  border-collapse: collapse;">
  <tr>
    <th style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">Company</th>
    <th style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">Bills</th>
    <th style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">Amount</th>
  </tr>';
  

  $crd_all1=  array();  $ii=array(); 
  $sql_login  =  $database->mysqlQuery("select c.ct_corporatename as company,sum(cd.cd_amount) as amt,count(cd.cd_billno) as ct, "
                . " cd.cd_settled from tbl_credit_details cd left join tbl_credit_master cm on cd_masterid =crd_id"
                . " left join tbl_corporatemaster c on ct_corporatecode=crd_corporateid  "
                . "  left join tbl_credit_types ct on ct.ct_creditid=cm.crd_type "
                . "  where cd.cd_settled='N' and ct.ct_credit_type='By Company' and "
                . " cd.cd_dayclosedate='$datedayclose' group by company " ); 

        $num_login   = $database->mysqlNumRows($sql_login); 
        if($num_login){
        while($result_login=$database->mysqlFetchArray($sql_login))
        { 
            $ii[]=$result_login['ct'];
          
            $crd_all1[]=$result_login['amt'];
            
           $company[]=$result_login['company'];
         
        }}
        
     for($si=0;$si<count($company);$si++){ 
        
   $msg_temp.= '<tr style="background-color: #dddddd;">
    <td style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">'.$company[$si].'</td>
    <td style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">'.$ii[$si].'</td>
    <td style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">'.$crd_all1[$si].'</td>
    </tr>';
  
       }
 
  
 $msg_temp.= '</table>
</div>
</div>




    <div style="float: left; margin-left: 25px;">

        <h3 style="text-align: left; text-decoration: underline;">By Guest</h3>
      <table style="  border-collapse: collapse;">
        <tr>
          <th style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">Bills</th>
          <th style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">Amount</th>
        </tr>';
        
  $crd_all=0;  $i=0;
  $sql_login  =  $database->mysqlQuery("select lr.ly_mobileno,lr.ly_firstname, cd.cd_amount from tbl_credit_details cd "
          . " left join tbl_credit_master cm on cd_masterid =crd_id left join tbl_loyalty_reg "
          . " lr on ly_id=crd_guestid left join tbl_credit_types ct on ct.ct_creditid=cm.crd_type"
          . " where cd.cd_settled='N' and ct.ct_credit_type='By Guest' and cd.cd_dayclosedate='$datedayclose' " ); 

        $num_login   = $database->mysqlNumRows($sql_login); 
        if($num_login){
        while($result_login=$database->mysqlFetchArray($sql_login))
        {  $i++;
          
            
           
           
         
            $crd_all=$crd_all+$result_login['cd_amount'];
         } }   
            
       $msg_temp.= '<tr style="background-color: #dddddd;">
          <td style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">'.$i++.'</td>
          <td style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">'.$crd_all.'</td>
        </tr> ';
       
       
        
       $msg_temp.='</table>

    
    </div>
    



 <div style="float: left; margin-left: 25px;">

        <h3 style="text-align: left; text-decoration: underline;">By Staff</h3>
      <table style="  border-collapse: collapse;">
        <tr>
          <th style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">Bills</th>
          <th style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">Amount</th>
        </tr>';
        
  $crd_all11=0;  $i2=0;
  $sql_login  =  $database->mysqlQuery("select sm.ser_firstname as staff ,"
                . " cd.cd_amount ,"
                . " cd.cd_settled from tbl_credit_details cd left join tbl_credit_master cm on cd_masterid =crd_id left join tbl_staffmaster"
                . " sm on ser_staffid=crd_staffid  "
                . " left join tbl_credit_types ct on ct.ct_creditid=cm.crd_type "
                . "  where cd.cd_settled='N' and "
                . "  ct.ct_credit_type='By Staff' and cd.cd_dayclosedate='$datedayclose'  " ); 

        $num_login   = $database->mysqlNumRows($sql_login); 
        if($num_login){
        while($result_login=$database->mysqlFetchArray($sql_login))
        {  $i2++;
          
            
            $crd_all11=$crd_all11+$result_login['cd_amount'];
         } }   
            
       $msg_temp.= '<tr style="background-color: #dddddd;">
          <td style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">'.$i2++.'</td>
          <td style="  border: 1px solid #dddddd; text-align: left; padding: 8px;">'.$crd_all11.'</td>
        </tr> ';
       
       
        
       $msg_temp.='</table>

    
    </div>


    
   
   
    <div style="width:800px;height:auto;float:left;margin-top:2%;">
    	
        <div style="width:396px;height:auto;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;">
        	<div style="width:396px;height:40px;border-bottom:1px #ccc solid;line-height: 42px;">MOST REVENUE GENERATED 5 ITEMS</div>
            <table width="396px" border="0" style="line-height:22px;font-size:13px;color: #666;padding: 5px;">
              <tr>
                <th style="text-align:left;">ITEM</th>
                <th>QTY</th>
                <th style="text-align:right;">TOTAL</th>
              </tr>';
              

   for($s=0;$s<count($analytics_values_menu1);$s++){ 
             $msg_temp.= '<tr>
              <td width="50%" style="text-align:left;">'.$analytics_values_menu1[$s].'</td>
              <td width="20%">'.$analytics_values_qty1[$s].'</td>
              <td width="30%" style="text-align:right;">'.$analytics_values_tot1[$s].'</td>
              </tr>';
    } 

         $msg_temp.= '  </table>

        </div>
        <div style="width:396px;height:auto;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;margin-left:1%;">
        	<div style="width:396px;height:40px;border-bottom:1px #ccc solid;line-height: 42px;">TOP SELLING 5 ITEMS</div>
            <table width="396px" border="0" style="line-height:22px;font-size:13px;color: #666;padding: 5px;">
               <tr>
                <th style="text-align:left;">ITEM</th>
                <th>QTY</th>
                <th style="text-align:right;">TOTAL</th>
              </tr>';
              

   for($s=0;$s<count($analytics_values_menu);$s++){ 
             $msg_temp.= '<tr>
              <td width="50%" style="text-align:left;">'.$analytics_values_menu[$s].'</td>
              <td width="20%">'.$analytics_values_qty[$s].'</td>
              <td width="30%" style="text-align:right;">'.$analytics_values_tot[$s].'</td>
              </tr>';
    } 

         $msg_temp.= '  </table>
        </div>
        
    </div>
    
    <div style="width:800px;height:360px;float:left;margin-top:2%;background-color:#fff;box-shadow:2px 5px 10px #ccc;display:none">
    	<div style="width:800px;height:45px;line-height: 45px;font-size:17px;padding-left:20px;font-family:Arial, Helvetica, sans-serif">SALES REPORT</div>
        <div style="width:800px;height:320px;float:left;text-align:center"><img width="100%" src="" /></div>
    </div>


    <div style="width:780px;height:auto;float:left;margin-top:12px;background-color: #f9e9d0;padding: 10px 10px;background-image:url(http://explorecommunity.com/ed_report_img_dont_delete/prhp_bg.png);background-size: 100%;">
    <h4 style="font-size: 20px;color:#242424;margin: 10px;"><span style="font-size: 15px;color:#666;font-weight: lighter;">For Live Sale Tracking, Instant Notifications, Alerts on Cancellations, Live Reports and more </span><br> 
        Download ED REPORTS APP NOW !</h4>

    <span style="width:100%;float:left;margin-top: 10px;margin-bottom: 10px;text-align:center;">
        <a target="_blank" href="https://play.google.com/store/apps/details?id=com.androsolutions.jbn.expodine_reports&hl=en"><span style="disply:inline-block;margin:0 10px;"><img src="http://explorecommunity.com/ed_report_img_dont_delete/android.png"></span></a>
        <a target="_blank" href="https://apps.apple.com/in/app/ed-reports/id1499774335"><span style="disply:inline-block;margin:0 10px;"><img  src="http://explorecommunity.com/ed_report_img_dont_delete/ios.png"></span></a>
    </span>
    </div>
    
     <div style="width:780px;height:auto;float:left;margin-top:0px;background-color: #333;padding:0 10px">
     	<p style="font-family:Arial, Helvetica, sans-serif;color:#a5a5a5;line-height:25px;margin-bottom: 2px;text-align:center;  margin-top: 7px">
        
        E : <a style="color:#a5a5a5;text-decoration:none" target="_blank" href="mailto:info@expodine.com">info@expodine.com </a> |
         W : <a style="color:#a5a5a5;;text-decoration:none" target="_blank" href="http://www.expodine.com/"> www.expodine.com</a> |
         T : +91 9895 366 444
       <span style="width:780px;height:auto;float:left;padding-bottom: 7px;"> Â© Expodine. All right reserved</span>
	</p>
        
     </div>
    
    
    
 </div>
    
</div>


</body>
</html>
'; 




$mailtext_o = stripslashes($string);
$mailtext = preg_replace("|\n|","<br>","$mailtext_o");

$sql_sms1 =  $database->mysqlQuery("Select be_reportemail_list from tbl_branchmaster"); 
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
        $mail->Subject = $mail_add." - DAILY SALES SUMMARY REPORT-".$datedayclose.' [Detail]';
        $mail->Body = $msg_temp;
          $mail->addAttachment($filename.'.txt');
        // $mail->addBCC('info@expodine.com');
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
            
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            
            
      ///apache mail start ////       
            
$from_name='Expodine';
$from_mail='noreply@gmaiil.com';
$filename1 = $filename.'.txt';

$eol = "\r\n";
$mailto = $allmail;

$replyto='noreply@gmaiil.com';
$file = $filename1;
$content = file_get_contents( $file);
$content = chunk_split(base64_encode($content));
$uid = md5(uniqid(time()));
$file_name = basename($file);

// header
$header = "From: ".$from_name." <".$from_mail.">\r\n";
$header .= "Reply-To: ".$replyto."\r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";


// message & attachment
$nmessage = "--".$uid."\r\n";
$nmessage .= "Content-type:text/html; charset=iso-8859-1\r\n";
$nmessage .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$nmessage .= $msg_temp."\r\n\r\n";
$nmessage .= "--".$uid."\r\n";
$nmessage .= "Content-Type: application/octet-stream; name=\"".$filename1."\"\r\n";
$nmessage .= "Content-Transfer-Encoding: base64\r\n";
$nmessage .= "Content-Disposition: attachment; filename=\"".$file_name."\"\r\n\r\n";
$nmessage .= $content."\r\n\r\n";
$nmessage .= "--".$uid."--";
            
            $subject = $mail_add." - DAILY SALES SUMMARY REPORT-".$datedayclose.' [Detail]';
            //$message = $msg_temp; 

            if(mail($mailto,$subject,$nmessage, $header)) {
                echo "Success";
                 $sql_emailsent_updation  =  $database->mysqlQuery("Update tbl_dayclose set dc_dayclose_email_success='Y',dc_last_email_time=NOW() where dc_day='".$datedayclose."'");
       
            } else {
                echo "Error";
            }  
            
            ///apache mail end ////
            
            
            
        } else {
          echo 'Message sent.';
           $sql_emailsent_updation  =  $database->mysqlQuery("Update tbl_dayclose set dc_dayclose_email_success='Y',dc_last_email_time=NOW() where dc_day='".$datedayclose."'");
        }
        
                  
                  
                  


	
	
	}

 }
 class report_headnew{
     private $slno;
    

    public function __construct($slno='') {
        $this -> slno =$slno;
        
    }

    public function __toString() {
        $leftCols =70;
	
		
		
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
                
        return "$left\n";
    }
 }

class itemordered {
    private $main;
    private $item;
    private $unit;
    private $wdi;
    private $wta;
    private $qty;
    private $unitprice;
    private $total;
  

    public function __construct($main = '', $item = '',$unit='',$wdi='',$wta='',$qty='',$unitprice='',$total='') {
        $this -> main = $main;
        $this -> item = $item;
        $this -> unit = $unit;
        $this -> wdi = $wdi;
        $this -> wta = $wta;
        $this -> qty = $qty;
        $this -> unitprice = $unitprice;
        $this -> total = $total;
      
	
    }

    public function __toString() {
        $leftCols =5;
	$leftCols1 =15;
        $leftCols2=15;
        $leftCols3 =20;
	$leftCols4 =15;
        $rightCols2 =15;
        $rightCols3=10;
	$rightCols4=15;	
		
                $left = str_pad($this -> main, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> item, $leftCols1,' ', STR_PAD_BOTH) ;
		$left2 = str_pad($this -> unit, $leftCols2,' ', STR_PAD_BOTH) ;
                $left3 = str_pad($this -> wdi, $leftCols3,' ', STR_PAD_BOTH) ;
		$left4 = str_pad($this -> wta, $leftCols4,' ', STR_PAD_BOTH) ;
		$right2 = str_pad($this -> qty, $rightCols2,' ', STR_PAD_BOTH) ;
		$right3 = str_pad($this -> unitprice, $rightCols3,' ', STR_PAD_LEFT) ;
                $right4 = str_pad($this -> total, $rightCols4,' ', STR_PAD_LEFT) ;
		
        return "$left$left1$left2$left3$left4$right2$right3$right4\n";
    }
}
class regenerate {
    private $slno;
    private $kot;
    private $product;
    private $qty;
    private $staff;
    private $login;
    private $amt;

    public function __construct($slno='',$kot = '',$product = '', $qty = '', $staff = '',$login='',$amt='') {
        $this -> slno =$slno;
        $this -> kot = $kot;
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> staff = $staff;
        $this -> login = $login;
        $this -> amt = $amt;
    }

    public function __toString() {
        $leftCols =10;
	$leftCols1 =17;
        $leftCols2 =10;
        $rightCols =23;
	$rightCols1 =12;
        $rightCols2 =12;
          $rightCols3 =10;
		
		
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
                $left1 = str_pad($this -> kot, $rightCols1,' ', STR_PAD_LEFT) ;
		$left2 = str_pad($this -> product, $leftCols2,' ', STR_PAD_LEFT) ;
                $right = str_pad($this -> qty, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> staff, $rightCols1,' ', STR_PAD_BOTH) ;
		$right2 = str_pad($this -> login, $rightCols2,' ', STR_PAD_BOTH) ;
                $right3 = str_pad($this -> amt, $rightCols3,' ', STR_PAD_LEFT) ;
        return "$left$left1$left2$right$right1$right2$right3\n";
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
        $leftCols =10;
	$leftCols1 =35;
        $rightCols =10;
	$rightCols1 =15;
		
		
		
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
        $leftCols = 40;//32-ojin    33-bbq
        $rightCols = 30;//10-ojin   13-bbq
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
        $leftCols =10;
		$leftCols1 =20;
        $rightCols =20;
		$rightCols1 =20;
		
		
		
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
        $leftCols =5;
	$leftCols1 =5;
        $leftCols2 =25;
        $rightCols =15;
	$rightCols1 =20;
        $rightCols2 =15;
		
		
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
                $left1 = str_pad($this -> kot, $rightCols1,' ', STR_PAD_RIGHT) ;
		$left2 = str_pad($this -> product, $leftCols2,' ', STR_PAD_RIGHT) ;
                $right = str_pad($this -> qty, rightCols,' ', STR_PAD_LEFT) ;
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
        $leftCols =10;
	$leftCols2 =20;
        $rightCols =20;
	$rightCols1 =20;
        $rightCols2 =15;
		
		
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
		$left2 = str_pad($this -> product, $leftCols2,' ', STR_PAD_BOTH) ;
                $right = str_pad($this -> qty, $rightCols,' ', STR_PAD_RIGHT) ;
		$right1 = str_pad($this -> staff, $rightCols1,' ', STR_PAD_LEFT) ;
		$right2 = str_pad($this -> login, $rightCols2,' ', STR_PAD_BOTH) ;
        return "$left$left2$right$right1$right2\n";
    }
}

class expense {
    private $product;
    private $qty;
    private $rate;
 
   

    public function __construct($product = '', $qty = '', $rate = '') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
	
        
    }

  public function __toString() {
        $leftCols =5;
	$leftCols2 =28;
        $rightCols =10;
	
		
		
		
                $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left2 = str_pad($this -> qty, $leftCols2,' ', STR_PAD_RIGHT) ;
                $right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		
        return "$left$left2$right\n";
    }
}
?>
 
   