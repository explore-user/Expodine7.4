<?php
session_start();
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
    //$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME_REPORT);
     $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
    $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
}

$rn=chr(13).chr(10); 
$esc=chr(27); 
$cutpaper=$esc."m";
$bold_on=$esc."E1";
$bold_off=$esc."E0";
$reset=pack('n', 0x1B30);
$right=$esc."a".chr(2);
$left=$esc."a".chr(0);
$center=$esc."a".chr(1);
$underlineon=$esc."-1";
$underlineofn=$esc."-0";
//$chewdth=$esc."GS ( Q <fn=48>";
$datedayclose=$_REQUEST['date'];
//echo $date;
$print="";
 $report=""; 
 
if($datedayclose!="")
 {
     $sql_login  =  $database->mysqlQuery("select * from tbl_reportmaster where  rm_daycloseprint='Y' and rm_dayclose_print_order>'0' ORDER BY rm_dayclose_print_order ASC"); 
                                    // echo "select * from tbl_reportmaster where rm_reportview='Y' and rm_printa4='Y' and rm_daycloseprint='Y' and rm_dayclose_print_order!='0' ORDER BY rm_dayclose_print_order ASC";
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
$reportname=explode(",",$report1);
//print_r($reportname);




date_default_timezone_set("Asia/Kolkata");

$branchname='';
$sql_branch =  $database->mysqlQuery("Select be_branchname,be_address,be_email,be_phone,be_others1,be_others2,be_others3,be_footer1,be_footer2,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
		  $num_branch  = $database->mysqlNumRows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = $database->mysqlFetchArray($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
                                                 
						
					}
		  }


    $ct=count($reportname);

    
    $from=$datedayclose;
 //$date=explode("-",$from);
//    $date1=$date[2]."-".$date[1]."-".$date[0];
    $newDate = date("d-m-Y", strtotime($from));
    //$to=$database->convert_date($_REQUEST['hidto']);
    //$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
    $sql_date=$database->mysqlQuery("Select * From tbl_dayclose  Where dc_dateopen ='".$from."'");
            
            $num_date  = mysqli_num_rows($sql_date);
            if($num_date){	
                while($result_date  = mysqli_fetch_array($sql_date)){
                        $dayopendate= $result_date['dc_dateopen'];
                        $dayopentime= $result_date['dc_timeopen'];
                        $dayclosedate= $result_date['dc_dateclose'];
                        $dayclosetime= $result_date['dc_timeclose'];
                }
                }
    $printer_style='';
    $sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_style From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
            $sql_kotss  =  mysqli_query($con,$sql_kots); 
            $num_kots  = mysqli_num_rows($sql_kotss);
            if($num_kots){	
                $result_kots  = mysqli_fetch_array($sql_kotss);
		$printer_style=$result_kots['pr_style'];
            
                    require_once("Escpos.php");
                     if($result_kots['pr_defaultusb']=='Y')
							{
							 $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
									$connector = new FilePrintConnector($printer);
									$printers = new Escpos($connector);
							}else
							{
                    $connector = new NetworkPrintConnector($result_kots['pr_printerip'],$result_kots['pr_printerport']);
                   $printers = new Escpos($connector);
                                                        }
                   $printers -> setJustification(Escpos::JUSTIFY_CENTER);
                   $logo = new EscposImage("img/print-logo/print_logo.png");
                   $printers -> bitImage($logo);//graphics($logo);
                             $printers -> feed();
                             $printers -> feed();
                             $printers->close();
//                   
//                
//                $flg =1;
            }
                
                
                //branch details
                $footer4 = "";
                $branchname="";
                $branchaddress="";
                $branchemail="";
                $branchphone = "";
                $sql_branch  =  $database->mysqlQuery("Select * from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
//                $sql_branch =  mysqli_query($localhost,"Select * from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
//                echo "Select * from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'";
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
						 $branchaddress=$result_branch['be_address'];
						 $branchemail=$result_branch['be_email'];
						 $branchphone=$result_branch['be_phone'];
//						 $branchothers1=$result_branch['be_others1'];
//						 $branchothers2=$result_branch['be_others2'];
//						 $branchothers3=$result_branch['be_others3'];
//						 $footer1=$result_branch['be_footer1'];
//						 $footer2=$result_branch['be_footer2'];
						 $footer3=$result_branch['be_footer3'];
						 $footer4=$result_branch['be_footer4'];
						 
//						
					}
		  }
//                  print_r($result_branch);
                //branch details end 
                  
//                 require_once("printer_functions.php");

                 
               
                     
                $print .= $center.$branchaddress."\n";
                $print .= $center.$branchemail."\n";
                $print .= $center.$branchphone."\n";
                $print .="\n";
//                $print .= $center."KVAT Rules,2005 FORM 8B"."\n";
//                
//                $print .= $center."TIN-32070286866 "."\n";
//                $print .= $center."FSSAI Lic. No-11316005000442"."\n";
//                $print .= $center."Ser.Tax: AACCJ7114RSD002"."\n";
//                $print .="\n";
		  $cur=date("Y-m-d");
                  if($printer_style=='1'){
                  $vv=str_pad("-",  '47%', "-");//46
                    
                  }
                  else if($printer_style=='2'){
                       $vv=str_pad("-",  '42%', "-");
                  }
                    $print .= $left."\n";//ojin
                    
                    //$print .= $center."Date:".date('d-m-Y')."\n";
                    //$print .=$left."\n";
		  $print .= $center.$bold_on."BRANCH: ".$branchname.$bold_off."\n";
                   $print .= $left."\n";
		  
				       $print .= $center.$bold_on."Day Close Report -". $newDate.$bold_off."\n";
					//$print .= $center.$reporthead."\n";
				
                                $print .= $left.$vv."\n";//ojin		
				$print .= $left."Day Open :  ".$dayopendate."   ".$dayopentime."\n";
                               $print .= $left."Day Close:  ".$dayclosedate."   ".$dayclosetime."\n";
                               $print .= $left.$vv."\n";
                               
                               
                               //And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
                                                                            $connector = new FilePrintConnector($printer);
                                                                            $printers = new Escpos($connector);
                                                          $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
                                                            	$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							        fwrite($fp,$print);
							        fclose($fp);
							}
						}
				}
				

     // HEADER AND LOGO END
    

foreach ($reportname as $val) {
		
	  // $_SESSION['type']=$val;
//printer setup


                    
if($val=="summary_report_cr")
{
		$print='';
		$from='';
		$to='';
		$typestring='';
                $string_credit_settle='';
                $stringvp='';
                $stringvp.= " vp_dayclose_date ='".$datedayclose."' ";
	$string="";
        $strings="";
        $stringtacshd="";
        $stringstacshd="";
	$reporthead="";
	$strings=" bm_status='Closed' AND bm_dayclosedate='".$datedayclose."'";
        $stringstacshd=" tab_status='Closed' AND tab_dayclosedate='".$datedayclose."'";
        $string_credit_settle.="cdp_dayclosedate ='".$datedayclose."' ";
        
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
	$string_pax=" bm_status='Closed' AND bm_dayclosedate ='".$datedayclose."' ";
	$string1 =$strings. " and ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   )  ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
	//$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string1tacshd=$stringstacshd. " and ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) ";
	
		
		
	$string2 =$strings." and pym_code='credit'  ";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string2tacshd =$stringstacshd." and pym_code='credit'  ";
        $string3 =$strings. " and pym_code='coupon' ";
        $string3tacshd =$stringstacshd. " and  pym_code='coupon'  ";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " and pym_code='voucher' ";
        $string4tacshd =$stringstacshd. " and  pym_code='voucher' ";//"voucher" bm_voucherid <>''
	$string5 =$strings. " and  pym_code='cheque' ";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string5tacshd =$stringstacshd. " and pym_code='cheque' ";
        $string6=$strings. "  and pym_code='credit_person'  ";
        $string6tacshd=$stringstacshd. " and pym_code='credit_person'  ";
	$string7=$strings. " and  pym_code='complimentary' ";
        $string7tacshd=$stringstacshd. " and pym_code='complimentary' ";
	
	//$string1 =$strings. " ";//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		//$string2 =$strings. " ";//"credit"  bm_transactionamount <>''
		//$string3 =$strings. " bm_paymode='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		//$string4 =$strings. " bm_paymode='voucher' AND";//"voucher" bm_voucherid <>''
		//$string5 =$strings. " bm_paymode='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	// $string=" bm_status='Closed' AND ";
                //$string7=$strings. " bm_paymode='complimentary' AND";
	
		
		
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
		  //$print .= $center.$bold_on.$branchname.$bold_off."\n";
                  $print .= $center.$bold_on."Consolidated".$bold_off."\n";
		  $print .= $center.$bold_on."Summary Report".$bold_off."\n";
                  $print .= $left."\n";//ojin
			
				if($printer_style=='1'){
                                $vv=str_pad("-",  '46%', "-");//46

                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '42%', "-");
                                }
				//$print .= $left.$vv."\n";//ojin
				$bilno= array(
					new bilno("Type","Value",$printer_style),
				);
				foreach($bilno as $bilno) {
					$print .=$left.($bilno);
				}
				$print .= $left.$vv."\n";//ojin
				$final=0;$i=1;
		  
		 $sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string1_str as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
  //echo "select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC";
	  $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	  if($num_logincashdi){
		  while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
			{ 
				if($result_logincashdi['tot'] != "")	{
			$subtotalcash =$subtotalcash + $result_logincashdi['tot'];
                        $roundofdi=$roundofdi+$result_logincashdi['roundofdi'];
          }}} 
     
          $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta,$string1_strtacshd as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id where $string1tacshd"."$stringtacshd order by tab_dayclosedate,tab_time ASC"); 
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
						new bilno("Cash",number_format($totalcash,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
                                }
                             $sql_logincredit  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where b.bm_id = tb.bm_transcbank and $string2 group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
                            // echo "select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and $string2  group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC  ";
                             $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{     
				$subtotalcredit =$subtotalcredit + $result_logincredit['tot'];
          }}
          
           $sql_logincreditta  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and  $string2tacshd "."$stringtacshd group by b.bm_name order by tbm.tab_dayclosedate,tbm.tab_time ASC "); 
           //echo "select bm_name as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and  $string2tacshd "."$stringtacshd group by b.bm_name order by tbm.tab_dayclosedate,tbm.tab_time ASC ";
           $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
	  if($num_logincreditta){
		  while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
			{ 
				$subtotalcreditta =$subtotalcreditta + $result_logincreditta['tot'];
          }}
          $totalcredit=$subtotalcredit+$subtotalcreditta;
                    if($totalcredit!=0)
                             {
                               $bilno= array(new bilno("Card",number_format($totalcredit,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
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
                                    $bilno= array(new bilno("Coupon",number_format($totalcoupon,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
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
                     $bilno= array(new bilno("Voucher",number_format($totalvoucher,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
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
                                    $bilno= array(new bilno("Cheque",number_format($totalcheque,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
                                }  
           
                                $sql_logincp  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
                                //echo "select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC";
                                $num_logincp   = $database->mysqlNumRows($sql_logincp);
	  if($num_logincp){
		  while($result_logincp  = $database->mysqlFetchArray($sql_logincp)) 
			{ 
			if($result_logincp['tot'] != "")
			{
			$subtotalcp =$subtotalcp + $result_logincp['tot'];
          } }} 
          
           $sql_logincpta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
	  //echo "select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC";
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
                            $bilno= array(new bilno("Credit Sale",number_format($totalcp,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
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
                 
             $sql_logincompta  =  $database->mysqlQuery("select $string3_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string7tacshd"." $stringtacshd order by tab_dayclosedate,tab_time ASC"); 
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
                            $bilno= array(new bilno("Complimentary",number_format($totalcomp,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
                                }  
                                
                  ///cpmplimentary-----------
		  
		  $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
			}
	  }
	 			
                                        
          $totpax_ta_cs_hd=0;                              
        $sql_loginchequeta  =  $database->mysqlQuery("select count(tab_billno) as billno_ta_cs_hd from tbl_takeaway_billmaster  where $stringstacshd "); 
	  $num_loginchequeta   = $database->mysqlNumRows($sql_loginchequeta);
	  if($num_loginchequeta){
		  while($result_loginchequeta  = $database->mysqlFetchArray($sql_loginchequeta)) 
			{ 
			
			$totpax_ta_cs_hd =$totpax_ta_cs_hd + $result_loginchequeta['billno_ta_cs_hd'];
			 }}                     
                                        
                                        
                            $pax_all_ct=   $qtycount+$totpax_ta_cs_hd  ;    
                                        
                        $bilno= array(
						new bilno("Total Pax (DI/TA/CS/HD)",$pax_all_ct,$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}                 
                                        
                                        
                                        
		  $finaltotal=$totalcash+$totalcredit+$totalcoupon+$totalvoucher+$totalcheque+$totalcp;
		  
				$print .= $left.$vv."\n";//ojin
                                $bilno= array(
						new bilno("Total",number_format($finaltotal,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
				

                                
                                
                                
                                $sql_login_loy12  =  $database->mysqlQuery("select sum(vp_amount) as expense FROM tbl_voucherpayment where vp_status='Approved' and $stringvp "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $voucher_expense=  $result_login_loy12['expense'];
                    
                      
          }
          }   
            
                
            
            if($voucher_expense>0){
             $bilno= array(
						new bilno("Expense ",number_format($voucher_expense,$_SESSION['be_decimal']) ,$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					} 
            }
                                
                                
                                
                   $print .= $left.$vv."\n";//ojin             
                                
                                
				$print .="\n";
                                
                    $creditcash_settle=0;
                    $creditcard_settle=0;
                    $sql_creditsettlemt  =  $database->mysqlQuery("select sum(cdp_paid_cash - cdp_balance) as settled_cash, sum(cdp_transaction_amount) as settled_card FROM tbl_credit_details_payment
                                                                    where $string_credit_settle "); 
            //        echo "select sum(cdp_paid_cash - cdp_balance) as settled_cash, sum(cdp_transaction_amount) as settled_card FROM tbl_credit_details_payment
            //                                                        where $string_credit_settle ";
                    $num_creditsettlemt   = $database->mysqlNumRows($sql_creditsettlemt);
                      if($num_creditsettlemt){
                           $print .= $center.$bold_on."Credit Settlement Income".$bold_off."\n\n";
                          
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
						$print .=$left.($bilno);
					}
                                
                                }
                                if($creditcard_settle>0){
                                    
                                    $bilno= array(
						new bilno("Card Settle",number_format(str_replace(',','',$creditcard_settle),$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
                             
                                }
                           $print .= $left.$vv."\n";//ojin
                                
                                
                                
                                
                                    $bilno= array(
						new bilno("Settlement Total",number_format(str_replace(',','',($creditcard_settle+$creditcash_settle)),$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bold_on.$bilno.$bold_off);
					}
				
				$print .= $left.$vv."\n";//ojin
                                
                                $print .= $leftl."\n";//ojin      
                                
          
                                
                                
                   $print .= $left.$vv."\n";//ojin             
                                
                                
                                
				//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
				
				
		  
	}                 

      else if($val=="summary_specified_consolidated")
{     
       	$print='';
        $stringstat=" tab_complimentary!='Y'  AND ";
        $stringstatdi=" bm_complimentary!='Y' AND ";
      
        $string_comp_ta=" tab_complimentary='Y'  AND tab_payment_settled='Y' AND  tab_status!='Cancelled'  AND  tab_dayclosedate='".$datedayclose."' ";
        $string_comp_di=" bm_complimentary='Y'  AND   bm_status!='Cancelled'  AND  bm_dayclosedate='".$datedayclose."' ";
     
        
      
	$string =" bm_status='Closed' AND bm_dayclosedate='".$datedayclose."' ";
        $stringtacshd =" tab_status='Closed' AND  tab_dayclosedate='".$datedayclose."' ";
        $stringta =" tab_status='Closed' AND tab_mode='TA'  AND tab_payment_settled='Y' AND  tab_dayclosedate='".$datedayclose."' ";
        $stringcs =" tab_status='Closed' AND tab_mode='CS'  AND tab_payment_settled='Y' AND tab_dayclosedate='".$datedayclose."'  ";
        $stringhd =" tab_status='Closed' AND tab_mode='HD'  AND tab_payment_settled='Y' AND   tab_dayclosedate='".$datedayclose."' ";
	$stringtax =" tab_status='Closed'  AND tab_payment_settled='Y' AND  tab_dayclosedate='".$datedayclose."' ";
	
	$string_pax=" bm_status='Closed' AND  bm_dayclosedate='".$datedayclose."' ";
	$string_billcancel_di =" bm_status='Cancelled' AND bm_dayclosedate='".$datedayclose."' ";
	$string_billcancel_tacshd =" tab_status='Cancelled' AND tab_dayclosedate='".$datedayclose."' ";
        $string_loy=" lob_redeem_amount!='' AND DATE(lob_date)='".$datedayclose."' ";
        $string_itemcancel_di=" ch_kot_cancel_id != '' AND ch_dayclosedate='".$datedayclose."' ";
        $string_itemcancel_ta=" tc_cancel_id !='' AND tc_dayclosedate='".$datedayclose."' ";
        $string_credit_pay=" cdp_dayclosedate !='' AND cdp_dayclosedate='".$datedayclose."' ";
        $string_expense=" vp_type ='Expense' AND  vp_status='Approved' AND  vp_dayclose_date='".$datedayclose."' ";
          
          $string_advance= " tp_dayclose !='' AND  tp_dayclose='".$datedayclose."' "  ;  
          
          
          $string_acc_exp.= " ev_date ='".$datedayclose."'";
                         $string_acc_sup.= " sv_date ='".$datedayclose."' ";
                         $string_acc_emp.= " ev_date ='".$datedayclose."' ";
          
		
      $totalcash=0;
      $subtotalcash=0;
      $subtotalcashta=0;
      $roundofdi=0;
      $roundofta=0;
      
      $uae_subtotal=0; 
   $uae_subtotal_ta=0;
   $uae_subtotal_hd=0; 
   $uae_subtotal_cs=0;
      
      
      $string_cashonly= " AND ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   )   ";	
      
      
      
      $string_cash_di=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
       $string1_cashta=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
       
        $sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string_cash_di as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where  $stringstatdi $string $string_cashonly order by bm_dayclosedate,bm_billtime ASC"); 
         $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	  if($num_logincashdi){
		  while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
			{ 
				if($result_logincashdi['tot'] != "")	{
			$subtotalcash =$result_logincashdi['tot'];
                      
          }}} 
     
          $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta,$string1_cashta as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $stringstat $stringtacshd $string_cashonly  order by tab_dayclosedate,tab_time ASC"); 
        $num_logincashta   = $database->mysqlNumRows($sql_logincashta);
	  if($num_logincashta){
		  while($result_logincashta  = $database->mysqlFetchArray($sql_logincashta)) 
			{ 
				if($result_logincashta['tot'] != "")	{
			$subtotalcashta = $result_logincashta['tot'];
                       
          }}} 
          $totalcash=$subtotalcash+$subtotalcashta+$roundofdi+$roundofta;
       
          
          
          
          
           $sql_logincomp  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string_comp_di and  pym_code='complimentary' order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincomp   = $database->mysqlNumRows($sql_logincomp);
	  if($num_logincomp){
		  while($result_logincomp  = $database->mysqlFetchArray($sql_logincomp)) 
			{ 
			if($result_logincomp['tot'] != "")
			{
			$subtotalcomp = $result_logincomp['tot'];
			} }} 
                 
             $sql_logincompta  =  $database->mysqlQuery("select sum(tab_netamt) as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string_comp_ta and  pym_code='complimentary' order by tab_dayclosedate,tab_time ASC"); 
             $num_logincompta   = $database->mysqlNumRows($sql_logincompta);
	  if($num_logincompta){
		  while($result_logincompta  = $database->mysqlFetchArray($sql_logincompta)) 
			{ 
			if($result_logincompta['tot'] != "")
			{
			$subtotalcompta = $result_logincompta['tot'];
			} }}      
                 $totalcomp= $subtotalcomp+$subtotalcompta;  
         
         $string_cr=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
        $string3_cr=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";   
                 
                $sql_logincp  =  $database->mysqlQuery("select $string_cr as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $stringstatdi $string and  pym_code='credit_person' order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincp   = $database->mysqlNumRows($sql_logincp);
	  if($num_logincp){
		  while($result_logincp  = $database->mysqlFetchArray($sql_logincp)) 
			{ 
			if($result_logincp['tot'] != "")
			{
			$subtotalcp =$result_logincp['tot'];
          } }} 
          
           $sql_logincpta  =  $database->mysqlQuery("select $string3_cr as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $stringstat $stringtacshd and  pym_code='credit_person' order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			if($result_logincpta['tot'] != "")
			{
			$subtotalcpta = $result_logincpta['tot'];
          } }} 
          
          $totalcp=$subtotalcp+$subtotalcpta;  
                 
               $subtotalcreditta=0; $subtotalcredit=0;
          $sql_logincredit  =  $database->mysqlQuery("select distinct (bm_name) as bnk,  sum(bm_transactionamount) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and $stringstatdi $string and pym_code='credit' group by bm_name  order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{      
				$subtotalcredit =$subtotalcredit+ $result_logincredit['tot'];
          }}
          
           $sql_logincreditta  =  $database->mysqlQuery("select distinct (bm_name) as bnk,   sum(tab_transactionamount) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and $stringstat  $stringtacshd and pym_code='credit' group by bm_name order by tbm.tab_dayclosedate,tbm.tab_time ASC "); 
	  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
	  if($num_logincreditta){
		  while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
			{     
				$subtotalcreditta =$subtotalcreditta+$result_logincreditta['tot'];
          }}
          $totalcredit=$subtotalcredit+$subtotalcreditta;  
                 
          
   $subtotal=0;
   $subtotalta=0;
   $subtotalcs=0;
   $subtotalhd=0;
   $roundof=0;
   $roundoftacshd=0;
   $totroundofff=0;
   $dis_di=0;
   $dis_ta=0;
   $tot_discount_all=0;
   
    $salesexltax=0;
   $salesexcltaxdi=0;
   $salesexcltaxta=0;
   $salesexcltaxcs=0;
   $salesexcltaxhd=0;
   
   
   
  $sql_login  =  $database->mysqlQuery("select sum(bm_taxable_amount) as uae_subtotal,sum(bm_discountvalue) as tot_dis_di ,sum(bm_finaltotal) as tot, (sum(bm_subtotal)-sum(bm_discountvalue)) as totexcl,sum(bm_roundoff_value) as totroundof,sum(bm_tax_exempt) as taxexempt FROM tbl_tablebillmaster bm left join tbl_floormaster tf on tf.fr_floorid=bm.bm_floorid where  $stringstatdi $string "); 
 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
         
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   
				if($result_login['tot'] != "")	{
			$subtotal =$subtotal + $result_login['tot'];
                        $roundof=$roundof+$result_login['totroundof'];
                        $dis_di=$dis_di+$result_login['tot_dis_di'];
                         $salesexcltaxdi = $salesexcltaxdi+$result_login['totexcl'];
                          $uae_subtotal=$uae_subtotal+$result_login['uae_subtotal']; 
          } } }
          $sql_loginta  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal, sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringta"); 
  
	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
	  if($num_loginta){
		  while($result_loginta  = $database->mysqlFetchArray($sql_loginta)) 
			{ 
				if($result_loginta['tot'] != "")	{
			$subtotalta =$subtotalta + $result_loginta['tot'];
                         $salesexcltaxta =$salesexcltaxta+$result_loginta['totexcl'];
                          $uae_subtotal_ta=$uae_subtotal_ta+$result_loginta['uae_subtotal']; 
          } } } 
              $sql_logincs  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal, sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringcs"); 
 
	  $num_logincs   = $database->mysqlNumRows($sql_logincs);
	  if($num_logincs){
		  while($result_logincs  = $database->mysqlFetchArray($sql_logincs)) 
			{ 
				if($result_logincs['tot'] != "")	{
			$subtotalcs =$subtotalcs + $result_logincs['tot'];
                          $salesexcltaxcs =$salesexcltaxcs+$result_logincs['totexcl'];
                           $uae_subtotal_cs=$uae_subtotal_cs+$result_logincs['uae_subtotal']; 
                       
          }}}
           $sql_loginhd  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal,  sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringhd"); 
 
	  $num_loginhd   = $database->mysqlNumRows($sql_loginhd);
	  if($num_loginhd){
		  while($result_loginhd  = $database->mysqlFetchArray($sql_loginhd)) 
			{ 
			if($result_loginhd['tot'] != ""){
			$subtotalhd =$subtotalhd + $result_loginhd['tot'];
                        $salesexcltaxhd =$salesexcltaxhd+$result_loginhd['totexcl'];
                       $uae_subtotal_hd=$uae_subtotal_hd+$result_loginhd['uae_subtotal']; 
			} } }
                         
           $sql_logintacshd  =  $database->mysqlQuery("select sum(tab_discountvalue) as tot_dis_ta , sum(tab_netamt) as tot,sum(tab_roundoff_value) as totroundof FROM tbl_takeaway_billmaster where  $stringstat $stringtacshd"); 
           $num_logintacshd   = $database->mysqlNumRows($sql_logintacshd);
	  if($num_logintacshd){
		  while($result_logintacshd  = $database->mysqlFetchArray($sql_logintacshd)) 
			{ 
                            if($result_logintacshd['tot'] != "")	{
                             $roundoftacshd=$roundoftacshd+ $result_logintacshd['totroundof'];
                             $dis_ta=$dis_ta+$result_logintacshd['tot_dis_ta'];
          }}}
          
          $totroundofff=$roundoftacshd+$roundof;
          $tot_discount_all=$dis_ta+$dis_di;
          
          if($_SESSION['uae_tax_enable']=='Y'){ 
                
                  $salesexltax=($uae_subtotal+$uae_subtotal_ta+$uae_subtotal_cs+$uae_subtotal_hd);
                  
            }else{
         $salesexltax=$salesexcltaxhd+$salesexcltaxcs+$salesexcltaxta+$salesexcltaxdi+$totroundofff;
         
            }
         
            $tot_payment=$totalcash+$totalcredit+$totalcp+$totalcomp;
     $tot_excl_in=$tot_payment-$totalcomp;

             $cur=date("Y-m-d");
		  
		  $print .= $center.$bold_on."Specified Summary Report ".$bold_off."\n";
				
				
				
				if($printer_style=='1'){
                                    $vv=str_pad("-",  '46', "-");//46

                                    }
                                    else if($printer_style=='2'){
                                         $vv=str_pad("-",  '42', "-");
                                    }
				$print .= $left.$vv."\n";//ojin
				$bilno= array(
					new bilno("Type","Value",$printer_style),
				);
				foreach($bilno as $bilno) {
					$print .=$left.($bold_on.$bilno.$bold_off);
				}
				$print .= $left.$vv."\n";//ojin
				$final=0;$i=1;



                                
                           
                    $bilno= array(
						new bilno("Cash Sale",number_format($totalcash,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}          
             
                
               $subtotalcreditta=0; $subtotalcredit=0;
          $sql_logincredit  =  $database->mysqlQuery("select distinct (bm_name) as bnk,  sum(bm_transactionamount) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and $stringstatdi $string and pym_code='credit' group by bm_name  order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{      
				$subtotalcredit =$subtotalcredit+ $result_logincredit['tot'];
          }}
          
           $sql_logincreditta  =  $database->mysqlQuery("select distinct (bm_name) as bnk,   sum(tab_transactionamount) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and $stringstat  $stringtacshd and pym_code='credit' group by bm_name order by tbm.tab_dayclosedate,tbm.tab_time ASC "); 
	  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
	  if($num_logincreditta){
		  while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
			{     
				$subtotalcreditta =$subtotalcreditta+$result_logincreditta['tot'];
          }}
          $totalcredit=$subtotalcredit+$subtotalcreditta;
                               
          $bilno= array(
						new bilno("Card Sale",number_format($totalcredit,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
                                        
                                        
                      
          $sql_logincredit  =  $database->mysqlQuery("select  distinct (b.bm_name) as bnk,sum(bc.mc_cardamount) as tot
                FROM tbl_tablebillmaster bm
                left join tbl_paymentmode on bm.bm_paymode=tbl_paymentmode.pym_id  
                left join tbl_bill_card_payments bc on bc.mc_billno=bm.bm_billno
                left join tbl_bankmaster b on  b.bm_id = bc.mc_to_bank 
                where  tbl_paymentmode.pym_code='credit' and  bm.bm_status='Closed' 
                AND bm.bm_complimentary!='Y' AND $stringstatdi $string group by bnk "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{      
                      
                      if($result_logincredit['tot']>0){
				$bilno= array(
                                                        new bilno('*DI'.$result_logincredit['bnk'],number_format($result_logincredit['tot'],$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                }
                                                
                      }
          }}
          
           $sql_logincreditta  =  $database->mysqlQuery("select distinct (b.bm_name) as bnk, sum(bc.mc_cardamount) as tot  FROM 
                                                    tbl_takeaway_billmaster bm 
                                                    left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id 
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.tab_billno
                                                    left join tbl_bankmaster b  on  b.bm_id = bc.mc_to_bank 
                                                    where tbl_paymentmode.pym_code='credit' 
                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND $stringstat $stringtacshd group by bnk "); 
	  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
	  if($num_logincreditta){
		  while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
			{    
                      
                      if($result_logincreditta['tot']>0){
				$bilno= array(
                                                        new bilno('*TA_CS_HD'.$result_logincreditta['bnk'],number_format($result_logincreditta['tot'],$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                }
                                                
                      }
          }}             
                                
                                        
                                        
               
       
           $bilno= array(
						new bilno("Credit Sale",number_format($totalcp,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}    
       
          
             
                  $bilno= array(
						new bilno("Complimentary Sale",number_format($totalcomp,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}    
          
           
          
            $print .= $left.$vv."\n";
           
                  $bilno= array(
						new bilno("Total(incl Complimentary)",number_format($tot_payment,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}    
          
          
         
          
          
           $print .= $left.$vv."\n";
           $bilno= array(
						new bilno("Total(excl Complimentary)",number_format($tot_excl_in,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}    
          
          
         
          
           $sql_login_loy12  =  $database->mysqlQuery("select sum(vp_amount) as expense FROM tbl_voucherpayment where $string_expense "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $voucher_expense=  $result_login_loy12['expense'];
                    
                      
          }
          }   
           
          
            
          ////accc////
                  
                  
                  
                  $expense_voucher=0;
          $sql_login_loy12  =  $database->mysqlQuery("select sum(ev_amount) as expense FROM tbl_expense_voucher where $string_acc_exp "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $expense_voucher=  $result_login_loy12['expense'];
                    
                      
          }
          }   
          
          
          
          $supplier_voucher=0;
          $sql_login_loy12  =  $database->mysqlQuery("select sum(sv_paid_amount) as expense1 FROM tbl_supplier_voucher where $string_acc_sup "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $supplier_voucher=  $result_login_loy12['expense1'];
                    
                      
          }
          }   
          
          
           $employee_voucher=0;
          $sql_login_loy12  =  $database->mysqlQuery("select sum(ev_amount) as expense2 FROM tbl_employee_voucher where $string_acc_emp "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $employee_voucher=  $result_login_loy12['expense2'];
                    
                      
          }
          }   
                  
                  
                  
                  
                   $print .= $left.$vv."\n"; 

                    if($expense_voucher>0){
                     $bilno= array(
                                                        new bilno("Expense Voucher ",number_format($expense_voucher,$_SESSION['be_decimal']) ,$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                } 
                    }
                    
                    
                     if($supplier_voucher>0){
                        $bilno= array(
                                                        new bilno("Supplier Voucher ",number_format($supplier_voucher,$_SESSION['be_decimal']) ,$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                } 
                    }
                    
                    
                    
                    
                     if($employee_voucher>0 ){
                        $bilno= array(
                                                        new bilno("Employee Voucher ",number_format($employee_voucher,$_SESSION['be_decimal']) ,$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                } 
                    }
                    
                     if($employee_voucher>0 || $supplier_voucher>0 || $expense_voucher>0  ){
                          $print .= $left.$vv."\n"; 
                        $bilno= array(
                                                        new bilno("Total Expense ",number_format(($employee_voucher+$expense_voucher+$supplier_voucher),$_SESSION['be_decimal']) ,$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                } 
                    }
                    
                    
                        $print .= $left.$vv."\n";   
                        
          
          
          
           
                 
	 // $print .= $left.$vv."\n";
 
          $bilno= array(
						new bilno("Dine in",number_format($subtotal,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}    
          
 
       $bilno= array(
						new bilno("Take Away",number_format($subtotalta,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}          
     
             $sql_loginta32  =  $database->mysqlQuery("select tol_discount,tol_name,sum(tab_netamt) as tot,sum(tab_food_partner_discount) as disc FROM tbl_takeaway_billmaster  left join tbl_online_order  on tol_id=tab_food_partner  where $stringstat  $stringta group by tab_food_partner "); 
  //echo "select tol_name,sum(tab_netamt) as tot FROM tbl_takeaway_billmaster  left join tbl_online_order  on tol_id=tab_food_partner  where $stringstat  $stringta goup by tab_food_partner ";
	  $num_loginta32   = $database->mysqlNumRows($sql_loginta32);
	  if($num_loginta32){
		  while($result_loginta32  = $database->mysqlFetchArray($sql_loginta32)) 
			{ 
				
			$bilno= array(
                          new bilno('*'.$result_loginta32['tol_name'],number_format($result_loginta32['tot'],$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                }    
                        
                        if($result_loginta32['disc']>0){
                         
                         $bilno= array(
                          new bilno('#'.$result_loginta32['tol_name'].'[After Disc '.number_format($result_loginta32['tol_discount'],2).'%]',number_format(($result_loginta32['tot']-$result_loginta32['disc']),$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                }    
                     }    
                        
          } }               
        
  
          
          $bilno= array(
						new bilno("Counter Sale",number_format($subtotalcs,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}    
          
        
            
           
   
            $bilno= array(
						new bilno("Home Delivery",number_format($subtotalhd,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}    
          	
		
           
    $total=($subtotal + $subtotalta+$subtotalcs+$subtotalhd);
            	
          
            
                              
                $print .= $left.$vv."\n";             

               
                
                $bilno= array(
                                                        new bilno("**FLOOR WISE** ",'',$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                } 

          $sql_login_floors  =  $database->mysqlQuery("select fr_floorname ,sum(bm_finaltotal) as fl_total from tbl_tablebillmaster  left join tbl_floormaster  on fr_floorid=bm_floorid  where  $stringstatdi $string group by fr_floorname "); 
	
         $num_login_floor  = $database->mysqlNumRows($sql_login_floors);
	  if($num_login_floor){
		  while($result_login_floor  = $database->mysqlFetchArray($sql_login_floors)) 
			{
                       $bilno= array(
                                                        new bilno($result_login_floor['fr_floorname'],number_format($result_login_floor['fl_total'],$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                } 
                      
			 }
                         } 
                
		 $print .= $left.$vv."\n";   
              
              
                $bilno= array(
						new bilno("Total Discount",number_format($tot_discount_all,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					} 
                 
      
         
     
          $bilno= array(
						new bilno("Total Roundoff",number_format($totroundofff,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					} 
           
     


     $tot_billcancel_all="";
     $total_cancel_bill_di="";
     $total_cancel_bill_tacshd="";
     $tot_count="";
     $tot_count_di="";
        $sql_login_d  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot_bill_cancel_di,count(bm_billno) as tot_count_di FROM tbl_tablebillmaster  where   $string_billcancel_di "); 
       
	  $num_login_d   = $database->mysqlNumRows($sql_login_d);
	  if($num_login_d){ 
         
		  while($result_login_d  = $database->mysqlFetchArray($sql_login_d)) 
			{   
			 
                      $total_cancel_bill_di= $result_login_d['tot_bill_cancel_di'];
                      $tot_count_di=  $result_login_d['tot_count_di'];
                    
          }
          } 
          
          $sql_login_t  =  $database->mysqlQuery("select sum(tab_netamt) as tot_bill_cancel_tacshd,count(tab_billno) as tot_count FROM tbl_takeaway_billmaster  where   $string_billcancel_tacshd "); 

          
	  $num_login_t   = $database->mysqlNumRows($sql_login_t);
	  if($num_login_t){ 
         
		  while($result_login_t  = $database->mysqlFetchArray($sql_login_t)) 
			{   
			 
                      $total_cancel_bill_tacshd= $result_login_t['tot_bill_cancel_tacshd'];
                      $ta_count=$result_login_t['tot_count'];
                    
          }
          } 
          
          
          $tot_billcancel_all=$total_cancel_bill_di+$total_cancel_bill_tacshd;
          $tot_count=$tot_count_di+$ta_count;
           
          

                

                $bilno= array(
						new bilno("Bill Cancel Count/Amount",$tot_count.'/'.number_format($tot_billcancel_all,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					} 
            
                
              
                $tot_count_di="";
                $tot_count_ta="";
               $sql_login_cd  =  $database->mysqlQuery("select count(ch_kot_cancel_id) as di_count  FROM tbl_tableorder_changes where $string_itemcancel_di "); 
              
	  $num_login_cd   = $database->mysqlNumRows($sql_login_cd);
	  if($num_login_cd){ 
         
		  while($result_login_cd  = $database->mysqlFetchArray($sql_login_cd)) 
			{   
			 
                      
                      $tot_count_di=  $result_login_cd['di_count'];
                    
          }
          }   
          
          $sql_login_td  =  $database->mysqlQuery("select count(tc_cancel_id) as ta_count  FROM tbl_takeaway_cancel_items where $string_itemcancel_ta "); 
       
	  $num_login_td   = $database->mysqlNumRows($sql_login_td);
	  if($num_login_td){ 
         
		  while($result_login_td  = $database->mysqlFetchArray($sql_login_td)) 
			{   
			 
                      
                      $tot_count_ta=  $result_login_td['ta_count'];
                    
          }
          }   
                
          
          $tot_item_cancel_count=$tot_count_di+$tot_count_ta;
  
               
                
             
                 $bilno= array(
						new bilno("Item Cancel Count",$tot_item_cancel_count." items",$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					} 
             
                
       
          
          $sql_login_loy  =  $database->mysqlQuery("select sum(lob_redeem_amount) as redeem_amount,sum(lob_point_redeem) as redeem_point, sum(lob_point_add) as add_point  FROM tbl_loyalty_pointadd_bill where $string_loy "); 
       
	  $num_login_loy   = $database->mysqlNumRows($sql_login_loy);
	  if($num_login_loy){ 
         
		  while($result_login_loy = $database->mysqlFetchArray($sql_login_loy)) 
			{   
			 
                     $redeem=$result_login_loy['redeem_amount'];
                     $redeem_point=  $result_login_loy['redeem_point'];
                    $add_point=$result_login_loy['add_point']  ;
                      
          }
          }   
          
       
         if($redeem_point>0){
                 $bilno= array(
						new bilno("Redeem Points/Amount",$redeem_point.'/'.number_format($redeem,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					} 
         }
                       
                
           
                if($add_point>0){
                $bilno= array(
						new bilno("Added Points",$add_point ,$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					} 
                }
               
                
          $pay_bal=0;      
          $sql_login_loy1  =  $database->mysqlQuery("select sum(cdp_paid_cash) as cash_pay,sum(cdp_transaction_amount) as card_pay,sum(cdp_balance) as pay_bal  FROM tbl_credit_details_payment where $string_credit_pay "); 
       
	  $num_login_loy1   = $database->mysqlNumRows($sql_login_loy1);
	  if($num_login_loy1){ 
         
		  while($result_login_loy1 = $database->mysqlFetchArray($sql_login_loy1)) 
			{   
			 
                     $cashpay=  $result_login_loy1['cash_pay'];
                      $cardpay=  $result_login_loy1['card_pay'];
                      // $pay_bal= $result_login_loy1['pay_bal'];
                      
          }
          }   
              $credit_settled_all=($cardpay+$cashpay)-$pay_bal;
                
             
              
                                
                
                $bilno= array(
						new bilno("Credit Settlement Amount ",$credit_settled_all ,$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					} 
                
             
                
               
          
          
          
           $advance_total=0;
            
            $sql_login_loy126  =  $database->mysqlQuery("select sum(tp_amount) as advance FROM tbl_advance_payment where $string_advance "); 
       
	  $num_login_loy126   = $database->mysqlNumRows($sql_login_loy126);
	  if($num_login_loy126){ 
         
		  while($result_login_loy126 = $database->mysqlFetchArray($sql_login_loy126)) 
			{   
			 
                     $advance_total=  $result_login_loy126['advance'];
                    
                      
          }
          }   
            
                
            
            
            
                $print .= $left.$vv."\n";   
                
                
                
                //avg start///    
                        
                        
                        $dibills=0;
          $sql_login_loy12  =  $database->mysqlQuery("select count(bm_billno) as di_bills FROM tbl_tablebillmaster where $string_pax "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $dibills=$dibills+$result_login_loy12['di_bills'];
                    
                      
          }
          }   
             
                    
                    
          $dipax=0;
          $sql_login_loy12  =  $database->mysqlQuery("select sum(bm_totalpax) as di_pax FROM tbl_tablebillmaster where $string_pax "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $dipax=$dipax+$result_login_loy12['di_pax'];
                    
                      
          }
          }   
       
          $tapax=0;
          $sql_login_loy12  =  $database->mysqlQuery("select count(tab_billno) as ta_pax FROM tbl_takeaway_billmaster where tab_mode='TA' and $stringtacshd "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $tapax=$tapax+$result_login_loy12['ta_pax'];
                    
                      
          }
          }   
          
          
          $hdpax=0;
          $sql_login_loy12  =  $database->mysqlQuery("select count(tab_billno) as hd_pax FROM tbl_takeaway_billmaster where tab_mode='HD' and $stringtacshd "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $hdpax=$hdpax+$result_login_loy12['hd_pax'];
                    
                      
          }
          }   
          
          
          
          $cspax=0;
          $sql_login_loy12  =  $database->mysqlQuery("select count(tab_billno) as cs_pax FROM tbl_takeaway_billmaster where tab_mode='CS' and $stringtacshd "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $cspax=$cspax+$result_login_loy12['cs_pax'];
                    
                      
          }
          }     
                        
                        
             //avg end///     
          
           $bilno= array(
                                                        new average("Avg ",'DI','TA','HD ','CS' ,$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                } 
                                                
          
          
                        
                  $bilno= array(
                                                        new average("Pax ",$dipax,$tapax,$hdpax,$cspax ,$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                } 
                                                
                                                
                                                
                                                $bilno= array(
                                                        new average("Bills ",$dibills,'0','0','0' ,$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                } 
                                                
                                                
                                                
                                                $bilno= array(
                                                        new average("Avg-Pax ",number_format(($subtotal/$dipax),$_SESSION['be_decimal']) ,'0','0','0' ,$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                } 
                                                
                                                
                                                
                                                $bilno= array(
                                                        new average("Avg-Bill ",number_format(($subtotal/$dibills),$_SESSION['be_decimal']),number_format(($subtotalta/$tapax),$_SESSION['be_decimal']),number_format(($subtotalhd/$hdpax),$_SESSION['be_decimal']),number_format(($subtotalcs/$cspax),$_SESSION['be_decimal']) ,$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                } 
                                                
                                                
                                                $bilno= array(
                                                        new average("Total ",number_format($subtotal,$_SESSION['be_decimal']),number_format($subtotal,$_SESSION['be_decimal']),number_format($subtotal,$_SESSION['be_decimal']),number_format($subtotal,$_SESSION['be_decimal']) ,$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                } 
                        
                                                
                                  $print .= $left.$vv."\n";               
                
                
                
                
                
               
                    $bilno= array(
						new bilno("Tax Summary Details ","" ,$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					} 
                      $print .= "-------------------\n";  
                      
                       $bilno= array(
						new bilno("Total Sale Excl Tax ",number_format($salesexltax,$_SESSION['be_decimal']) ,$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					} 
                      
                       $bilno= array(
						new bilno("Total Tax Amount",number_format(($total-$salesexltax),$_SESSION['be_decimal']) ,$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}   
                                        
                                   $bilno= array(
						new bilno("Total Sale Incl Tax ",number_format($total,$_SESSION['be_decimal']) ,$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}   
                                        
                                       
                                        
                                       
                                        
                                        
                                    $sql_tip  =  $database->mysqlQuery("select sum(tip) as tip,mode from(
                                                select sum( bm_tips_given) as tip,bm_tips_mode as mode FROM tbl_tablebillmaster where $string group by bm_tips_mode  union all
                                                select sum(tab_tips_given) as tip,tab_tips_mode as mode  FROM tbl_takeaway_billmaster  where $stringtax group by tab_tips_mode
                                                )x group by mode order by mode"); 
                                    $num_tip   = $database->mysqlNumRows($sql_tip);
                                    if($num_tip){$o=0;$total_tip=0;
                                        while($result_tip = $database->mysqlFetchArray($sql_tip)) 
                                        {   if($result_tip['tip']>0){
                                                $o++;
                                                if($o==1) {
                                                    $print .= $left.$vv."\n";   
                                                    $bilno= array(
                                                        new bilno("Tips Details","" ,$printer_style),
                                                    );
                                                    foreach($bilno as $bilno) {
                                                            $print .=$left.($bilno);
                                                    }
                                                    $print .= "-------------------\n"; 
                                                }
                                                $total_tip=$total_tip+$result_tip['tip'];
                                                if($result_tip['mode']=='C'){
                                                    $tip_mode='CASH';
                                                } 
                                                else if($result_tip['mode']=='D') {
                                                    $tip_mode='CARD';
                                                }
                                                $bilno= array(
                                                    new bilno($tip_mode,number_format(str_replace(',','',$result_tip['tip']),$_SESSION['be_decimal']) ,$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                    $print .=$left.($bilno);
                                                }
                                            }
                                        }
                                        if($o>0) {
                                            $bilno= array(
                                                    new bilno('TIPS TOTAL',number_format(str_replace(',','',$total_tip),$_SESSION['be_decimal']) ,$printer_style),
                                                );
                                            foreach($bilno as $bilno) {
                                                $print .=$bold_on.$left.($bilno).$bold_off;
                                            }
                                        }
                                    } 
                            
                          if($advance_total>0) {
                                            $bilno= array(
                                                    new bilno('ADVANCE PAID TOTAL',number_format(str_replace(',','',$advance_total),$_SESSION['be_decimal']) ,$printer_style),
                                                );
                                            foreach($bilno as $bilno) {
                                                $print .=$bold_on.$left.($bilno).$bold_off;
                                            }
                                        }          
                                    
                                    
                      $print .= $left.$vv."\n";

				$print .="\n\n\n\n\n";
				//$print.=$cutpaper;
				
				
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}      
                            
}     
        
   else if($val=="voucher_expense")
        {
       
        $string='';
       
        $string.=" vp_dayclose_date ='".$datedayclose."'";
        
                $branchname="";
               
                $sql_branch  =  $database->mysqlQuery("Select * from tbl_branchmaster where be_branchid='1'"); 

		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
						 
					}
		  }
   
            
                 
                  if($printer_style=='1'){
                  $vv=str_pad("-",  '46', "-");//46
                    
                  }
                  else if($printer_style=='2'){
                       $vv=str_pad("-",  '42', "-");
                  }
                  $print .= $left.$vv."\n";//ojin
                    $print .= $center."Date:".date('d-m-Y')."\n";
                    $print .="\n";
		
				if($from=='' && $to=='')
				{
					$print .= $center.$reporthead;
				}
				else
				{
                                $print .= $center."Report\n";
				$print .= $center."From ".$database->convert_date($from)."\n";
                                $print .= $center."To ".$database->convert_date($to)."\n";
				}
			
                               $print .="\n";
                                
				$print .= $left.$vv."\n";//ojin
                                
                                 $print .= $center." Expense Report \n";
                               $print .= $left.$vv."\n";
            
            
            $bilno= array(
                    new expense("Slno","Head","Amount",$printer_style),
                    );
                    foreach($bilno as $bilno) {
                        $print .=$left.($bilno);
                        }     
             $print .= $left.$vv."\n";
       
        $i=0;
        $amount=0;
    		 $sql_login  =  $database->mysqlQuery("select * from tbl_voucherpayment left join tbl_voucherhead on vh_id=vp_vhid left join tbl_branchmaster on be_branchid=vp_branchid left join tbl_staffmaster on ser_staffid=vp_approvedby where vp_status='Approved' and  $string");
                   
                   //echo "select * from tbl_voucherpayment left join tbl_voucherhead on vh_id=vp_vhid left join tbl_branchmaster on be_branchid=vp_branchid left join tbl_staffmaster on ser_staffid=vp_approvedby where $vouchername  $vouchertype $string";
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
                            
                            $bilno= array(
                    new expense($i,$vouchername,number_format($result_login['vp_amount'],$_SESSION['be_decimal']),$printer_style),
                    );
                    foreach($bilno as $bilno) {
                        $print .=$left.($bilno);
                        }   
                            
       
        } } 
         $print .= $left.$vv."\n";
        $bilno= array(
                    new expense("Total","",number_format($amount,$_SESSION['be_decimal']),$printer_style),
                    );
                    foreach($bilno as $bilno) {
                        $print .=$left.($bilno);
                        }     
                        
                        
                        $print .= $left.$vv."\n";//ojin
				 
                               
				
				$print .="\n\n\n\n\n";
				//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
                        
        
          }     
        
else if($val=="tot_sales")
{ 
		
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		 //$date=date("Y-m-d");
		 $string.=" bm_status='Closed' AND bm_dayclosedate ='".$datedayclose."'";
                 //$string.= " bm_dayclosedate = '".$date."' ";
			
	
		
		  //$cur=date("Y-m-d");
		  
		
		  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string order by bm_dayclosedate"); 
		 //echo "select * from tbl_tablebillmaster where $string order by bm_dayclosedate";
	  $num_login   = $database->mysqlNumRows($sql_login);
	
		$print='';
		  if($num_login)
		  {
			   //$print .= $center.$bold_on.$branchname.$bold_off."\n";
				$print .= $center.$bold_on."Total Sales Report".$bold_off."\n";
                                $print .= $left."\n";//ojin
                                $print .= $center.$bold_on." * Dine In *".$bold_off."\n";
				
				
				
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				if($printer_style=='1'){
                                $vv=str_pad("-",  '47%', "-");//46

                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '42%', "-");
                                }
				
				$print .= $left."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new menulist("Slno","Date","Bilno", "Final",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{       
                                        if($result_report['bm_paymode']!=7){
					$final=$final + $result_report['bm_finaltotal'];
                                        
					$dt=explode("-",$result_report['bm_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['bm_billno'], number_format($result_report['bm_finaltotal'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					
                                        }//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
                                        }$bcnt=$i;
                                        $i++;
                                }
				$print .= $left.$vv."\n";
                                $menulist= array(
					new menulist("Bill:",$bcnt,"Final",number_format($final,$_SESSION['be_decimal']),$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				$print .= $left.$vv."\n";//ojin
				$print .="\n";
				//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
		  }
		  
		  
		  $sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
			$num_kots  = mysqli_num_rows($sql_kotss);
	
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
						
							if($result_kots['pr_defaultusb']=='Y')
							{
								
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
							
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
						
						$print='';
				}
		
					
}
        
else if($val=="consolidated_cancel_report"){
	$string="";
        $stringta="";
      	$string.= "ch_dayclosedate='$datedayclose' ";
        $stringta.= "tc_dayclosedate ='$datedayclose' ";
         $print="";         
         $print .= $center.$bold_on."   Consolidated ".$bold_off."\n";
         $print .= $center.$bold_on." Item Cancel Report ".$bold_off."\n";
	                  
                         if($printer_style=='1'){
                                    $vv=str_pad("-",  '42%', "-");//46

                                    }
                                    else if($printer_style=='2'){
                                         $vv=str_pad("-",  '42%', "-");
                                    }
				$print .= $left.$vv."\n";
				$bilno= array(
					new itemcancel("Kot/Bill No","Item"," Qty",$printer_style),
				);
				foreach($bilno as $bilno) {
					$print .=$left.($bold_on.$bilno.$bold_off);
				}
				$print .= $left.$vv."\n";

            $sql_combo  =  $database->mysqlQuery("select CONCAT(cn.cn_name,' ',cp.cp_pack_name) as combo, oc.*,ts.ser_firstname,cr_reason FROM tbl_combo_ordering_details cod 
                                                    left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id
                                                    left join tbl_tableorder  o on cod.cod_count_combo_ordering=o.ter_count_combo_ordering,tbl_tableorder_changes oc 
                                                    left join tbl_staffmaster ts on ts.ser_staffid=oc.ch_cancelledby_careof 
                                                    left join tbl_cancellation_reasons tcr on tcr.cr_id=oc.ch_cancelledreason
                                                    where $string and oc.ch_orderno = o.ter_orderno and oc.ch_orderslno = o.ter_slno
                                                    group by cod.cod_count_combo_ordering,cod.cod_orderno, oc.ch_kot_cancel_id order by CAST(oc.ch_kot_cancel_id AS UNSIGNED) asc"); 
            $num_combo   = $database->mysqlNumRows($sql_combo);
            if($num_combo){
                while($result_combo= $database->mysqlFetchArray($sql_combo)){    
                    $cancelid1=$result_combo['ch_kot_cancel_id'];
                    $bill_order1=$result_combo['ch_orderno'];
                    $cancel_qty1=$result_combo['ch_combo_pack_cancelled_qty'];
                    $cancel_by1=substr($result_combo['ser_firstname'],0,8);
                    $cancel_time1=substr($result_combo['ch_entrydate'],0,10);
                    $cancel_reason1=$result_combo['cr_reason'];
                    $menu=substr($result_combo['combo'],0,20);
                    $kotno=$result_combo['ch_kotno'];
                    $log_by=$result_combo['ch_cancelledlogin'];        
                    
                    $bilno= array(
                    new itemcancel($kotno,$menu,$cancel_qty1,$printer_style),
                    );
                    foreach($bilno as $bilno) {
                        $print .=$left.($bilno);
                        }
                    
                    
                }
            }
            
            $sql_combo  =  $database->mysqlQuery("select CONCAT(cn.cn_name,' ',cp.cp_pack_name) as combo, ci.*,ts.ser_firstname,cr_reason,bm.tab_mode as mode
                                                FROM tbl_combo_bill_details_ta cbd 
                                                left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                left join tbl_takeaway_billdetails tb on tb.tab_count_combo_ordering=cbd.cbd_count_combo_ordering
                                                left join  tbl_takeaway_billmaster bm on bm.tab_billno = tb.tab_billno, tbl_takeaway_cancel_items ci 
                                                left join tbl_staffmaster ts on ts.ser_staffid=ci.tc_cancelled_by
                                                left join tbl_cancellation_reasons tcr on tcr.cr_id=ci.tc_reason
                                                where  $stringta  and ci.tc_billno=tb.tab_billno and ci.tc_bill_slno=tb.tab_slno 
                                                group by cbd.cbd_count_combo_ordering,cbd.cbd_billno, ci.tc_cancel_id order by CAST(ci.tc_cancel_id  AS UNSIGNED) asc"); 
            
            
            
            $num_combo   = $database->mysqlNumRows($sql_combo);
            if($num_combo){
                while($result_combo= $database->mysqlFetchArray($sql_combo)){    
                    
                    $cancelid1=$result_combo['tc_cancel_id'];
                    $bill_order1=$result_combo['tc_billno'];
                    $cancel_qty1=$result_combo['tc_combo_pack_cancelled_qty'];
                    $cancel_by1=substr($result_combo['ser_firstname'],0,8);
                    $cancel_time1=substr($result_combo['ch_entrydate'],0,10);
                    $cancel_reason1=$result_combo['cr_reason'];
                    $menu=substr($result_combo['combo'],0,20);
                    if($result_combo['tc_cancel_kotno']!=""){
                        $kotno=$result_combo['tc_cancel_kotno'];
                    }else{
                        $kotno=$result_combo['tc_billno']; 
                    }
                    $log_by=$result_combo['tc_cancelled_login'];        
                     
                    $bilno= array(
                    new itemcancel($kotno,$menu,$cancel_qty1,$printer_style),
                    );
                    foreach($bilno as $bilno) {
                        $print .=$left.($bilno);
                        }          
                    
                    
                }
            }                    
        
        
        
              $sql_login1  =  $database->mysqlQuery("select *,mr_menuname,ser_firstname,cr_reason from tbl_tableorder_changes tbo left join tbl_staffmaster ts on ts.ser_staffid=tbo.ch_cancelledby_careof left join tbl_cancellation_reasons tcr on tcr.cr_id=tbo.ch_cancelledreason left join tbl_tableorder to1 on to1.ter_orderno=tbo.ch_orderno and to1.ter_slno=tbo.ch_orderslno left join tbl_menumaster tm on tm.mr_menuid=to1.ter_menuid where $string and tbo.ch_combo_pack_cancelled_qty IS  NULL order by ch_entrydate asc "); 
      
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1)
	  {
              while($result_login1= $database->mysqlFetchArray($sql_login1))
              {
               
              $cancelid1=$result_login1['ch_kot_cancel_id'];
               $bill_order1=$result_login1['ch_orderno'];
                $cancel_qty1=$result_login1['ch_cancelled_qty'];
                 $cancel_by1=$result_login1['ser_firstname'];
                 $cancel_time1=$result_login1['ch_entrydate'];
                 $cancel_reason1=$result_login1['cr_reason'];
                
                  $menu=substr($result_login1['mr_menuname'],0,20);
                 $kotno=$result_login1['ch_kotno'];
                 
                 $cancel_by1=substr($result_login1['ser_firstname'],0,8);
                 $cancel_time1=substr($result_login1['ch_entrydate'],0,10);  
                 
                          $bilno= array(
                    new itemcancel($kotno,$menu,$cancel_qty1,$printer_style),
                    );
                    foreach($bilno as $bilno) {
                        $print .=$left.($bilno);
                        }
                      //  $print .= $left.$vv."\n";
               
            }
	  }
        
        
          $sql_loginta1  =  $database->mysqlQuery("select *,mr_menuname,ser_firstname,cr_reason from   tbl_takeaway_cancel_items tbc left join tbl_staffmaster ts on ts.ser_staffid=tbc.tc_cancelled_by left join tbl_cancellation_reasons tcr on tcr.cr_id=tbc.tc_reason left join tbl_takeaway_billdetails tbdw on tbdw.tab_billno=tbc.tc_billno and tbdw.tab_slno=tbc.tc_bill_slno left join tbl_menumaster tm on tm.mr_menuid=tbdw.tab_menuid where $stringta and  tbc.tc_combo_pack_cancelled_qty IS NULL order by tc_cancelled_time asc "); 
        
        $num_loginta1   = $database->mysqlNumRows($sql_loginta1);
	if($num_loginta1)
	  {
              while($result_loginta1= $database->mysqlFetchArray($sql_loginta1))
              {
                  $cancelid2=$result_loginta1['tc_cancel_id'];
                 $bill_order2=$result_loginta1['tc_billno'];
                 $cancel_qty2=$result_loginta1['tc_cancel_qty'];
              
                  $cancel_reason2=$result_loginta1['cr_reason'];
                   $menu1=substr($result_loginta1['mr_menuname'],0,20);
                  
                     
                     if($result_loginta1['tc_cancel_kotno']!=""){
                      $kotno1=$result_loginta1['tc_cancel_kotno'];
                 }else{
                      $kotno1=$result_loginta1['tc_billno'];
                 }
                  $cancel_by2=substr($result_loginta1['ser_firstname'],0,8);
                 $cancel_time2=substr($result_loginta1['tc_cancelled_time'],0,10);  
                  
                            $bilno= array(
                    new itemcancel($kotno1,$menu1,$cancel_qty2,$printer_style),
                    );
                    foreach($bilno as $bilno) {
                        $print .=$left.($bilno);
                        }
                     //   $print .= $left.$vv."\n";
                 
            }
	  }
        
              $sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}

}
        
else if($val=="complimentary_cr")
{  
		
		$string='';
                $stringta='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		 $date=date("Ymd");
		 $string.=" bm_status='Closed' AND   bm_complimentary='Y' and ";
                 $stringta.=" tab_status='Closed' AND   tab_complimentary='Y' and ";
			
				 
				$string.= " bm_dayclosedate ='".$datedayclose."' ";
                                $stringta.= " tab_dayclosedate ='".$datedayclose."' ";
			
	
		
		
		  $cur=date("Y-m-d");
		  
		
		  $sql_login  =  $database->mysqlQuery("select bm_dayclosedate as date,bm_billno as bill,bm_finaltotal as total,'DI' as mode from tbl_tablebillmaster where $string  Union select tab_dayclosedate as date,tab_billno as bill,tab_netamt as total, tab_mode as mode from tbl_takeaway_billmaster where $stringta"); 
		 //echo "select bm_dayclosedate as date,bm_billno as bill,bm_finaltotal as total,'DI' as mode from tbl_tablebillmaster where $string  Union select tab_dayclosedate as date,tab_billno as bill,tab_netamt as total, tab_mode as mode from tbl_takeaway_billmaster where $stringta";
                    $num_login   = $database->mysqlNumRows($sql_login);
	
		$print='';
		  if($num_login)
		  {
			   //$print .= $center.$bold_on.$branchname.$bold_off."\n";
				$print .= $center.$bold_on."Consolidted".$bold_off."\n";
                                $print .= $center.$bold_on."Complimentary Report".$bold_off."\n";
                                $print .= $left."\n";//ojin
//                                $print .= $center.$bold_on." * Dine In *".$bold_off."\n";
				
				
				
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				if($printer_style=='1'){
                                $vv=str_pad("-",  '47%', "-");//46

                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '42%', "-");
                                }
				
				$print .= $left."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				$print .= $left.$vv."\n";
				$menulist= array(
					new menulist("SlNo","Billno","Mode","Total",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{       
                                        
					$final=$final + $result_report['total'];
                                        
					$dt=explode("-",$result_report['date']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$result_report['bill'],$result_report['mode'], number_format($result_report['total'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					
                                        }//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					
                                        $bcnt=$i;
                                        $i++;
                                        
                                }
				$print .= $left.$vv."\n";//ojin
                                $menulist= array(
					new menulist("Bill:".$bcnt,"","Final",number_format($final,$_SESSION['be_decimal']),$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
                                $print .= $left.$vv."\n";//ojin
				$print .="\n";
				//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
		  }
		  
		  
		  $sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
			$num_kots  = mysqli_num_rows($sql_kotss);
	
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
						
							if($result_kots['pr_defaultusb']=='Y')
							{
								
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
							
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
						
						
				}
		
					
	}
else if($val=="categorywise_report_cr")
{
            $string ="";
            $string.="bm.bm_status = 'Closed' and bm.bm_dayclosedate='".$datedayclose."'";
            $stringta ="";
            $stringta="tbm.tab_status = 'Closed' and tbm.tab_dayclosedate='".$datedayclose."'";
            $from='';
            $to='';
            $reporthead="";
            $st="";
	    $print='';
            $vv='';
    
		
 
		
	$final=0;
        $total=0;
        $totalta=0;
        $i=1;
        $sql_login_combo  =  $database->mysqlQuery(" select sum(items) as noofitems,category,sum(qty) as qty, sum(amount) as amount from (
                                                        select  distinct( count(cbd.cbd_combo_pack_id)) as items,'COMBO MENUS'as category, sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as amount  FROM tbl_combo_bill_details cbd left join  tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno where $string group by cbd.cbd_billno union all
                                                        select  distinct(count(cbd.cbd_combo_pack_id)) as items,'COMBO MENUS'as category, sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as amount  FROM tbl_combo_bill_details_ta cbd left join  tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno where $stringta group by cbd.cbd_billno)x group by x.category");

            $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
             if($num_login_combo){$t=0;
                    
                    $print .= $center.$bold_on."Cosolidated".$bold_off."\n";
                    $print .= $center.$bold_on."Category Wise Report".$bold_off."\n";
                    if($from=='' && $to=='')
                    {
                            $print .= $center.$bold_on.$reporthead.$bold_off."\n";
                    }
                    else
                    {
                    $print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
                    }
                    if($printer_style=='1'){
                        $vv=str_pad("-",  '48', "-");//46
                    }
                    else if($printer_style=='2'){
                         $vv=str_pad("-",  '42', "-");
                    }
                    $print .= $left.$vv."\n";//ojin
                    
                    $menulist= array(
                            new cat_wise("Slno"," Category ","  Qty","  Total",$printer_style)
                    );
                    foreach($menulist as $menulist) {
                            $print .=$left.($bold_on.$menulist.$bold_off);
                    }
                    //$print .= $left."------------------------------------------\n";
                    $print .= $vv."\n";//ojin        
                    while($result_login_combo  = $database->mysqlFetchArray($sql_login_combo)) 
			{$t++;
                            $total=$total+$result_login_combo['amount'];
                            //$final=$final+$result_login['Final'];
                            $menulist= array(
                                new cat_wise($i,"**".strtoupper($result_login_combo['category']),$result_login_combo['qty'],number_format($result_login_combo['amount'],$_SESSION['be_decimal']),$printer_style)
                            );
                            foreach($menulist as $menulist) {
                            $print .=$left.($menulist);
                            }
                         $i++;
                        }}
        
       $sqlcatview  =  $database->mysqlQuery("CREATE VIEW category AS SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,sum(0) as qty1,bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where bd.bd_count_combo_ordering is NULL and $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname union SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(0) as qty,sum(tbd.tab_qty) as qty1 ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where tbd.tab_count_combo_ordering is NULL and $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname");
 // echo "CREATE VIEW category AS SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname union SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(tbd.tab_qty) as qty ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname";            
   $sql_login  =  $database->mysqlQuery("SELECT mmy_maincategoryname,count(distinct(mr_menuid)) as noofitems,sum(qty+qty1) as qty,sum(Total) as Total From category group by mmy_maincategoryname ORDER BY mmy_maincategoryname ASC");
    // echo "SELECT mmy_maincategoryname,count(distinct(mr_menuid)) as noofitems,sum(qty) as qty,sum(Total) as Total From category group by mmy_maincategoryname ORDER BY mmy_maincategoryname ASC";
     
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$t=0;
                        if($i==1){
                          $print .= $center.$bold_on."Cosolidated".$bold_off."\n";
				$print .= $center.$bold_on."Category Wise Report".$bold_off."\n";
				
                             
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				if($printer_style=='1'){
                                $vv=str_pad("-",  '48%', "-");//46

                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '42%', "-");
                                }
				$print .= $left."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new cat_wise("Slno"," Category ","  Qty","  Total",$printer_style)
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $vv."\n";//ojin
                        }    
	  
                              
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{       $total=$total + $result_report['Total'];
					//$final=$final + $result_report['Final'];
					//$dt=explode("-",$result_report['tab_dayclosedate']);
					//$date=$dt[2]."-".$dt[1]."-".$dt[0];
                                        $main_cat=$result_report['mmy_maincategoryname'];
                                        $main_cat1=substr($main_cat,0,24);
					$menulist= array(
						new cat_wise($i,strtoupper($main_cat1),$result_report['qty'],number_format($result_report['Total'],$_SESSION['be_decimal']),$printer_style)
                                            
					);
					 	
						
					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist
                                                );
					
					
						
					
					}
					
					
					
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
                     }		
	  
         			
				
				$print .= $left.$vv."\n";
                                $menulist= array(
					new cat_wise("Total","","",number_format($total,$_SESSION['be_decimal']),$printer_style)
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				//$print .=$center."                        Final-Total = ".$bold_on.$final.$bold_off.".00\n";
                                $print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n";
				//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
							  $fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
	  
	  $sqldrop  =  $database->mysqlQuery ("DROP VIEW category");
		
        }

else if($val=="item_ordered_cr")
{
            $string ="";
            $stringta="";
            $string_combo="";
            $string="bm.bm_status = 'Closed' and bm.bm_dayclosedate='".$datedayclose."'";
            $stringta="bm.tab_status = 'Closed' and bm.tab_dayclosedate='".$datedayclose."'";
            $string_combo.= " cbd.cbd_dayclosedate = '".$datedayclose."' ";
            
            
            $from='';
            $to='';
            $reporthead="";
            $st="";
	    $print='';
            $vv='';
            if(isset ($_REQUEST['floorvalue']))
	{
		
		$floorvalue=$_REQUEST['floorvalue'];
                if($floorvalue!="")
                {
		
		$string.=" and bm.bm_floorid='".$floorvalue."' AND ";
                }
	}
       
	
    
	
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
                        
                                $print .= $center.$bold_on."Consolidated".$bold_off."\n";
                                        $print .= $center.$bold_on."Items Ordered $addon_head Report  ".$bold_off."\n";
                                        if($from=='' && $to=='')
                                        {
                                                $print .= $center.$bold_on.$reporthead.$bold_off."\n";
                                        }
                                        else
                                        {
                                        $print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
                                        }


                                        /*$print .= "------------------------------------------------\n";
                                        $print .= "Slno    Date           Bilno               Final\n";
                                        $print .= "------------------------------------------------\n";*/


                                        if($printer_style=='1'){
                                            $vv=str_pad("-",  '47', "-");//46

                                            }
                                            else if($printer_style=='2'){
                                                 $vv=str_pad("-",  '42', "-");
                                            }
                                        $print .= $left.$vv."\n";//ojin
                                        //$print .= $left."Slno  Date        Bilno              Final\n";


                                        $menulist= array(
                                                new itemordered("Item","Qty","Total",$printer_style),
                                        );
                                        foreach($menulist as $menulist) {
                                                $print .=$left.($bold_on.$menulist.$bold_off);
                                        }
                                        $print .= $left.$vv."\n";
                                        $print .="* * ".$bold_on."COMBO MENUS".$bold_off." \n";
                        while($result_combo  = $database->mysqlFetchArray($sql_combo)){ 
                            $p++;
                            $final=$final+$result_combo['total'];
                            $qty_final=$qty_final+$result_combo['qty'];

                            $menulist= array(
                                    new itemordered(substr(strtoupper($result_combo['combo']),0,25),$result_combo['qty'],number_format($result_combo['total'],$_SESSION['be_decimal']),$printer_style),

                                );
                            foreach($menulist as $menulist) {
                                $print .=$left.($menulist);
                                $j++;
                            }
                            $i++;
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
                                        left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                        left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                        where $stringta and bd.tab_count_combo_ordering IS NULL 
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, bd.tab_unit_weight 
                                        )x group by menuid,portionid,unitid,baseunitid,weight order by maincategory,menuname asc ");
                $num_stw   = $database->mysqlNumRows($sql_stw);
                if($num_stw){ $t=0;$old="";
                                    if(!$num_combo){
                                   $print .= $center.$bold_on."Consolidated".$bold_off."\n";
				$print .= $center.$bold_on."Items Ordered Report  ".$bold_off."\n";
				if($from=='' && $to=='')
				{
					$print .= $center.$bold_on.$reporthead.$bold_off."\n";
				}
				else
				{
				$print .= $center.$bold_on.$from." To ".$to.$bold_off."\n";
				}
                                
                                
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				
                                if($printer_style=='1'){
                                    $vv=str_pad("-",  '47', "-");//46

                                    }
                                    else if($printer_style=='2'){
                                         $vv=str_pad("-",  '42', "-");
                                    }
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new itemordered("Item","Qty","Total",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
                                $print .= $left.$vv."\n";
                                    }
	  	
				$final=0;$i=1;$j=0;
                                $old="";
                                $subold="";
                                $qty1=0;
                                $p=0;
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

                                                
                                                    if(strlen($print)>$string_length)
                                                    {
                                                    $print=substr($print,0,$string_length);

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
                                            $print .= $left."\n";
                                            $print .= $left.$bold_on."* * ".strtoupper($maincatname).$bold_off."\n";
                                            
                                           
                                            $old = $result_report['maincategory'];
                                           
                                            
                                        }else{
                                            $print .= "";
                                            $old = $result_report['maincategory'];
                                        }
                                        
					
					$item=$result_report['menuname'];
                                            if(strlen($item)>20)
                                            {
                                            $item=substr($item,0,20);
                                                
                                            }
                                            
                                        $string_length=strlen($print);     
                                            
					$menulist= array(
						new itemordered(strtoupper($item)." (".$billhis_portion.")",$qty1,number_format($total,$_SESSION['be_decimal']),$printer_style),
					
                                            );
					
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($menulist);
                                        $j++;
					
					}				
					 
					$i++;
				}
				
	    
          }	
			
                                $print .= $left.$vv."\n";
                                $menulist= array(
						new itemordered("Items-".$j," ","",$printer_style),
					
                                            );
                                foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
                                       
					
					}
				$menulist= array(
						new itemordered("Total",$qty_final,number_format($final,$_SESSION['be_decimal']),$printer_style),
					
                                            );	
                                      					
					foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
                                       
					
					}
				
				$print .= $left.$vv."\n";//ojin
				//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
	  
	  
	
}	      

else if(($val=="sales_summary_report_cr"))
{
    	//echo 'hggvgg';

    
      $print="";
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
	$string .=" bm_status='Closed' AND  bm_dayclosedate='".$datedayclose."'";
        $stringtacshd .=" tab_status='Closed' AND tab_dayclosedate='".$datedayclose."'";
        $stringta .=" tab_status='Closed' AND tab_mode='TA'  AND tab_dayclosedate='".$datedayclose."'";
        $stringcs .=" tab_status='Closed' AND tab_mode='CS'  AND  tab_dayclosedate='".$datedayclose."'";
        $stringhd .=" tab_status='Closed' AND tab_mode='HD'  AND tab_dayclosedate='".$datedayclose."'";
        $stringtax .=" tab_status='Closed'   AND tab_dayclosedate='".$datedayclose."'";
        
	$string_pax="";
        $reporthead=$datedayclose;
	$string_pax=" bm_status='Closed' AND bm_dayclosedate='".$datedayclose."'";
	       
		
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
         
          
           
                $flg=0;
           
           
                                
				$print .= $left."\n";//ojin
                                 $print .= $center.$bold_on."Consolidated".$bold_off."\n";
                                 $print .= $center.$bold_on."SALES SUMMARY (Inc.Tax)".$bold_off."\n";
                                $print .="\n";
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
            
                         
                        if($subtotal!=0)
                            {
                              $bilno= array(
                            new bilno("Dine In",number_format($subtotal,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                           }
                          
                            if($subtotalta!=0)
                            {
                            
                            $bilno= array(
                            new bilno("Take Away",number_format($subtotalta,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                             } 
                             if($subtotalcs!=0)
                            {
                              $bilno= array(
                            new bilno("Counter Sale",number_format($subtotalcs,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                            }
                              if($subtotalhd!=0)
                            {
                              $bilno= array(
                            new bilno("Home Delivery",number_format($subtotalhd,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                            }
                             
                             
                            $print .= $left.$vv."\n";//ojin 
                            $bilno= array(
                            new bilno("Total Summary",number_format($total,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.$bold_on.($bilno).$bold_off;
                            }
                            
                                //----------------------
		  
				$print .= $left.$vv."\n";//ojin
				
                                
                                //tax summary
                                 
                                 $print .= $center.$bold_on."TAX SUMMARY".$bold_off."\n";
                                $print .="\n";
				
                        if($salesexcltaxdi!=0){
                            
                            if($_SESSION['uae_tax_enable']=='Y'){ 
                                $bilno= array(
                            new bilno("Dine-In Excl.Tax",number_format($uae_subtotal,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                            }else{
                            $bilno= array(
                            new bilno("Dine-In Excl.Tax",number_format($salesexcltaxdi,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                            }
                        }
                        if($taxexemptdi!=0){
                            $bilno= array(
                            new bilno("Tax Exempted Amount-DI",number_format($taxexemptdi,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                        }
                             
                        $roundof1="";
            $servtax12="";
            $servcharge12="";
            $vat12="";
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
                                            $print .=$left.($bilno);
                                        }

                                } 
                            } 
                        
                        
                        $print .="\n";
                        
                        if($salesexcltaxta!=0){
                            
                            if($_SESSION['uae_tax_enable']=='Y'){ 
                                $bilno= array(
                            new bilno("Takeaway Excl.Tax",number_format($uae_subtotal_ta,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                            }else{
                            $bilno= array(
                            new bilno("Take Away Excl.Tax",number_format($salesexcltaxta,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                            }
                        }
                        if($taxexemptta!=0){
                            $bilno= array(
                            new bilno("Tax Exempted Amount-TA",number_format($taxexemptta,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                        }
                       for($s=0;$s<count($ta_tax_value['TA']['label']);$s++){
                           $ta_tax_valueta=$ta_tax_valueta+$ta_tax_value['TA']['value'][$s];
                            $bilno= array(
                            new bilno("Take Away   ".$ta_tax_value['TA']['label'][$s],number_format($ta_tax_value['TA']['value'][$s],$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                       }
                        
                        
                        $print .="\n";
                        
                        if($salesexcltaxcs!=0){
                            
                            if($_SESSION['uae_tax_enable']=='Y'){ 
                                $bilno= array(
                            new bilno("Counter Sales Excl.Tax",number_format($uae_subtotal_cs,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                            }else{
                              $bilno= array(
                            new bilno("Counter Sale Excl.Tax",number_format($salesexcltaxcs,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                            }
                        }
                        if($taxexemptcs!=0){
                            $bilno= array(
                            new bilno("Tax Exempted Amount-CS",number_format($taxexemptcs,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                        }
                         for($s=0;$s<count($ta_tax_value['CS']['label']);$s++){
                              $ta_tax_valuecs=$ta_tax_valuecs+$ta_tax_value['CS']['value'][$s];
                            $bilno= array(
                            new bilno("Counter Sale   ".$ta_tax_value['CS']['label'][$s],number_format($ta_tax_value['CS']['value'][$s],$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                        }
                        
                        
                        
                        $print .="\n";
                        
                        if($salesexcltaxhd!=0){
                            if($_SESSION['uae_tax_enable']=='Y'){ 
                                $bilno= array(
                            new bilno("Home Delivery Excl.Tax",number_format($uae_subtotal_hd,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                            }else{
                              $bilno= array(
                            new bilno("Home Delivery Excl.Tax",number_format($salesexcltaxhd,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                            }
                        }
                        if($taxexempthd!=0){
                            $bilno= array(
                            new bilno("Tax Exempted Amount-HD",number_format($taxexempthd,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                        }
                        for($s=0;$s<count($ta_tax_value['HD']['label']);$s++){
                            $ta_tax_valuehd=$ta_tax_valuehd+$ta_tax_value['HD']['value'][$s];
                            $bilno= array(
                            new bilno("Home Delivery   ".$ta_tax_value['HD']['label'][$s],number_format($ta_tax_value['HD']['value'][$s],$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	$print .=$left.($bilno);
                            }
                        }
                        $print .= $left.$vv."\n";
                            //$print .= $center.$bold_on."TAX SUMMARY".$bold_off."\n";
                            $bilno= array(
                            new bilno("Round Off",number_format($totroundofff,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	 
                                $print .=$left.$bold_on.($bilno).$bold_off;
                            }
                        
                             
                            $print .= $left.$vv."\n";
                            
                            
                            
                           
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
                            new bilno("Home Delivery Charge",number_format($del,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	 
                                $print .=$left.$bold_on.($bilno).$bold_off;
                            }
                        
                             
                            $print .= $left.$vv."\n";
                    
                     
        } 
                            
                            
                            
                            
                            
                            //$print .= $center.$bold_on."TAX SUMMARY".$bold_off."\n";
        
         if($_SESSION['uae_tax_enable']=='Y'){ 
                            $bilno= array(
                            new bilno("Sale Inc.Tax",number_format(str_replace(',','',$total),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	 
                                $print .=$left.$bold_on.($bilno).$bold_off;
                            }
                            
         }else{
             
              $bilno= array(
                            new bilno("Sale Inc.Tax",number_format(str_replace(',','',$salesexcltaxdi+$salesexcltaxta+$salesexcltaxcs+$salesexcltaxhd+$ta_tax_valueta+$ta_tax_valuecs+$ta_tax_valuehd+$di_tax_sum+$totroundofff+$del),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                            	 
                                $print .=$left.$bold_on.($bilno).$bold_off;
                            }
         }
                          $print .= $left.$vv."\n";
                                //footer end
				$print .="\n\n\n\n\n";
				
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
                                                    
                                              
							if($result_kots['pr_defaultusb']=='Y')
							{
                                                           
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
                                                    
								
                                                        
							$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
                                                       
                                                         
						}
                                               
				}
    
          }      
        
else if($val=="tot_sales_ta")
{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		 //$date=date("Ymd");
                 
               $string.=" tab_status='closed' AND tab_mode='TA' AND tab_dayclosedate='".$datedayclose."' ";
      
    			
		  $cur=date("Y-m-d");
		  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate"); 
                  //echo "select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate";
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {             
				$print .= $center.$bold_on." * Take Away *".$bold_off."\n";
                                $print .= $left."\n";//ojin
                              
                                    //$print .= $center.$bold_on."Total Sales Report".$bold_off."\n";
                                
				
                               
                                
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				if($printer_style=='1'){
                                    $vv=str_pad("-",  '47%', "-");//46

                                    }
                                    else if($printer_style=='2'){
                                         $vv=str_pad("-",  '42%', "-");
                                    }
				
				
				$menulist= array(
					new menulist("Slno","Date","Bilno", "Final",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{       if($result_report['tab_paymode']!=7){
					$final=$final + $result_report['tab_netamt'];
					$dt=explode("-",$result_report['tab_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['tab_billno'], number_format($result_report['tab_netamt'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}
					
                                }
					
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$bcnt = $i;
                                        $i++;
				}
                                
                                       
				$print .= $left.$vv."\n";//ojin
                                $menulist= array(
					new menulist("Bill:",$bcnt,"Final",number_format($final,$_SESSION['be_decimal']),$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				
				$print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n";
				//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
				
				
		  }
                  
	} 
        
else if($val=="tot_sales_hd")
{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		// $date=date("Ymd");
                $string.=" tab_status='Closed' AND tab_mode='HD' AND tab_dayclosedate ='".$datedayclose."'";
			
		  $cur=date("Y-m-d");
		  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate"); 
                 //echo "select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate";
		  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {             
				$print .= $center.$bold_on." * Home Delivery *".$bold_off."\n";
                                $print .= $left."\n";//ojin
                               
                                    //$print .= $center.$bold_on."Total Sales Report".$bold_off."\n";
                                
				
                                
                               
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				if($printer_style=='1'){
                                    $vv=str_pad("-",  '47%', "-");//46

                                    }
                                    else if($printer_style=='2'){
                                         $vv=str_pad("-",  '42%', "-");
                                    }
				
				
				$menulist= array(
					new menulist("Slno","Date","Bilno", "Final",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{           if($result_report['tab_paymode']!=7){
					$final=$final + $result_report['tab_netamt'];
					$dt=explode("-",$result_report['tab_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['tab_billno'], number_format($result_report['tab_netamt'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}
					
                                }
					
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$bcnt = $i;
                                        $i++;
				}
                                
                                       
				$print .= $left.$vv."\n";//ojin
                                $menulist= array(
					new menulist("Bill:",$bcnt,"Final",number_format($final,$_SESSION['be_decimal']),$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				
				$print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n";
				//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
				
				
		  }
                  
	}   

else if($val=="totalsales_cs")
{
		$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		 
                 //$date=date("Ymd");
		 $string="tab_status='Closed' AND tab_mode='CS' and tab_dayclosedate ='".$datedayclose."'";
		
		  $cur=date("Y-m-d");
		  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate"); 
		  //echo "select * from tbl_takeaway_billmaster where $string order by tab_dayclosedate";
                  $num_login   = $database->mysqlNumRows($sql_login);
		  if($num_login)
		  {
			        $print .= $center.$bold_on." * Counter Sale *".$bold_off."\n";
                                $print .= $left."\n";//ojin
				//$print .= $center.$bold_on."Total Sales Report".$bold_off."\n";
				
				/*$print .= "------------------------------------------------\n";
				$print .= "Slno    Date           Bilno               Final\n";
				$print .= "------------------------------------------------\n";*/
				
				if($printer_style=='1'){
                                $vv=str_pad("-",  '47%', "-");//46

                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '42%', "-");
                                }
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new menulist("Slno","Date","Bilno", "Final",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
				
				$final=0;$i=1;
				while($result_report  = mysqli_fetch_array($sql_login)) 
				{   if($result_report['tab_paymode']!=7){
					$final=$final + $result_report['tab_netamt'];
					$dt=explode("-",$result_report['tab_dayclosedate']);
					$date=$dt[2]."-".$dt[1]."-".$dt[0];
					
					$menulist= array(
						new menulist($i,$date,$result_report['tab_billno'],number_format($result_report['tab_netamt'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}
					
                                }
					
					$bcnt = $i;
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
				}
				$print .= $left.$vv."\n";//ojin
                                $menulist= array(
					new menulist("Bill:",$bcnt,"Final",number_format($final,$_SESSION['be_decimal']),$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				$print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n";
				//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
				
				
		  }
	}

else if($val=="cash_settling_report_cr")
{
     	
        $print="";
       // $staff=$_REQUEST['staff'];
        //$department=$_REQUEST['department'];
	$string="";
        $stringta="";
	$string.=" bm_status='Closed' and bm_dayclosedate ='".$datedayclose."' ";
        $stringta.=" tab_status='Closed' and tab_dayclosedate ='".$datedayclose."' ";
        $reporthead="";
        $st="";
        $from="";
        $to="";
        $stringmodeta="";
        
	

                
$final=0;
$i=0;

  $sql_logincashier  =  $database->mysqlQuery("select login, sum(sum_1)as tot,sum(cash)as cash ,sum(card)as card from ( select distinct(bm_settlement_login) as login ,sum((bm_amountpaid)-(bm_amountbalace)) as cash,sum(bm_transactionamount) as card,sum(bm_finaltotal) as sum_1 from tbl_tablebillmaster where $string and bm_complimentary='N' and bm_settlement_login!='' group by bm_settlement_login union all
select distinct(tab_settlement_login)as login,sum((tab_amountpaid)-(tab_amountbalace)) as cash,sum(tab_transactionamount) as card,sum(tab_netamt) as sum_1 from tbl_takeaway_billmaster where $stringta and tab_complimentary='N' and tab_settlement_login!='' group by tab_settlement_login)x group by login"); 
//echo "select login, sum(sum_1)as tot,sum(cash)as cash ,sum(card)as card from ( select distinct(bm_settlement_login) as login ,sum((bm_amountpaid)-(bm_amountbalace)) as cash,sum(bm_transactionamount) as card,sum(bm_finaltotal) as sum_1 from tbl_tablebillmaster where $string and bm_complimentary='N' and bm_settlement_login!='' group by bm_settlement_login union all
//select distinct(tab_settlement_login)as login,sum((tab_amountpaid)-(tab_amountbalace)) as cash,sum(tab_transactionamount) as card,sum(tab_netamt) as sum_1 from tbl_takeaway_billmaster where $stringta and tab_complimentary='N' and tab_settlement_login!='' group by tab_settlement_login)x group by login";

  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       
            $print .= $center.$bold_on."Cosolidated".$bold_off."\n";
				$print .= $center.$bold_on."Settlement Report".$bold_off."\n";
				$print .= $left."\n";			
				if($printer_style=='1'){
                                $vv=str_pad("-",  '46%', "-");//46

                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '42%', "-");
                                }
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new cashier("Sl","Staff","Cash","Card","Total",$printer_style)
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $vv."\n";//ojin
        
	  while($result_logincashier  = $database->mysqlFetchArray($sql_logincashier))
            {$i++;
           $final= $final + $result_logincashier['tot'];
                    $menulist= array(
                             new cashier($i,$result_logincashier['login'],number_format($result_logincashier['cash'],$_SESSION['be_decimal']),number_format($result_logincashier['card'],$_SESSION['be_decimal']),number_format($result_logincashier['tot'],$_SESSION['be_decimal']),$printer_style)
               
                        );
                    foreach($menulist as $menulist) {
                        $print .=$left.($menulist);
					
                        }      
                 }
        }
                                $print .= $left.$vv."\n";
                                $menulist= array(
					new cashier("","Total","","",number_format($final,$_SESSION['be_decimal']),$printer_style)
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				//$print .=$center."                        Final-Total = ".$bold_on.$final.$bold_off.".00\n";
                                $print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
							  $fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}


}    
 




else if($val=="kitchen_wise_report_cr")
{
     	
        
	$string="";
        $stringta="";
	$string.=" bm.bm_status='Closed' AND bm.bm_dayclosedate ='".$datedayclose."' ";
        $stringta.=" tbm.tab_status='Closed' AND tbm.tab_dayclosedate = '".$datedayclose."' ";
        $from="";
        $to="";
        $quantity=""; 
	$final=0;	
		 $cur=date("Y-m-d");
	
$sql_login  =  $database->mysqlQuery("select kitchen,sum(qty) as qty, sum(amount) as tot from( SELECT km.kr_kotname as kitchen,mm.mr_menuname menu,mm.mr_kotcounter,bd.bd_menuid as menuid,sum(bd_qty)as qty,sum(bd_rate*bd_qty)as amount from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno LEFT JOIN tbl_menumaster mm on mm.mr_menuid= bd.bd_menuid
                                          LEFT JOIN tbl_kotcountermaster km on km.kr_kotcode=mm.mr_kotcounter where $string group by bd_menuid union all SELECT km.kr_kotname as kitchen,mm.mr_menuname menu,mm.mr_kotcounter,tbd.tab_menuid as menuid,sum(tab_qty)as qty,sum(tab_rate*tab_qty)as amount from tbl_takeaway_billdetails tbd 
                                           left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno LEFT JOIN tbl_menumaster mm on mm.mr_menuid= tbd.tab_menuid LEFT JOIN tbl_kotcountermaster km on km.kr_kotcode=mm.mr_kotcounter where $stringta  group by tbd.tab_menuid)x group by kitchen"); 
//  echo"select kitchen,sum(qty) as qty, sum(amount) as tot from( SELECT km.kr_kotname as kitchen,mm.mr_menuname menu,mm.mr_kotcounter,bd.bd_menuid as menuid,sum(bd_qty)as qty,sum(bd_rate*bd_qty)as amount from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno LEFT JOIN tbl_menumaster mm on mm.mr_menuid= bd.bd_menuid
//                                          LEFT JOIN tbl_kotcountermaster km on km.kr_kotcode=mm.mr_kotcounter where $string group by bd_menuid union SELECT km.kr_kotname as kitchen,mm.mr_menuname menu,mm.mr_kotcounter,tbd.tab_menuid as menuid,sum(tab_qty)as qty,sum(tab_rate*tab_qty)as amount from tbl_takeaway_billdetails tbd 
//                                           left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno LEFT JOIN tbl_menumaster mm on mm.mr_menuid= tbd.tab_menuid LEFT JOIN tbl_kotcountermaster km on km.kr_kotcode=mm.mr_kotcounter where $stringta  group by tbd.tab_menuid)x group by kitchen";
  $num_login   = $database->mysqlNumRows($sql_login);
  
	
	  if($num_login)
	  {
            $print .= $center.$bold_on."Cosolidated".$bold_off."\n";
				$print .= $center.$bold_on."Kitchen Wise Report".$bold_off."\n";
				$print .= $left."\n";	
				if($printer_style=='1'){
                                $vv=str_pad("-",  '46%', "-");//46

                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '42%', "-");
                                }
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new cat_wise("Sl","Kitchen","Quantity","Total",$printer_style)
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $vv."\n";//ojin
        
	  while($result_login  = $database->mysqlFetchArray($sql_login))
            {$i++;
                    $final=$final + $result_login['tot'];
                    $quantity= $quantity + $result_login['qty'];
                    $menulist= array(
                             new cat_wise($i,$result_login['kitchen'],$result_login['qty'],number_format($result_login['tot'],$_SESSION['be_decimal']),$printer_style)
               
                        );
                    foreach($menulist as $menulist) {
                        $print .=$left.($menulist);
					
                        }      
                 }
        }
                                $print .= $left.$vv."\n";
                                $menulist= array(
					new cat_wise("Total","","",number_format($final,$_SESSION['be_decimal']),$printer_style)
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				
				//$print .=$center."                        Final-Total = ".$bold_on.$final.$bold_off.".00\n";
                                $print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
							  $fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}


}  
   


else if($val=="consolidated_shift_report")
{
     	
           
	$string="";
       
	$string.=" sd_day ='".$datedayclose."' ";
       
        $from="";
        $to="";
        $quantity=""; 
	$final=0;	
	$cur=date("Y-m-d");
	
$sql_login  =  $database->mysqlQuery("SELECT *,st.ser_firstname FROM tbl_shift_details ts left join tbl_staffmaster st on st.ser_staffid=ts.sd_open_staff  where $string order by sd_day,sd_open ASC "); 

  $num_login   = $database->mysqlNumRows($sql_login);
  
	
	  if($num_login)
	  {
            $print .= $center.$bold_on."Consolidated".$bold_off."\n";
				$print .= $center.$bold_on."Shift  Login Report".$bold_off."\n";
				$print .= $left."\n";	
				if($printer_style=='1'){
                                $vv=str_pad("-",  '45%', "-");//46

                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '45%', "-");
                                }
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new shiftlogin("Login","OpenTime","CloseTime ","Open Bal","Close Bal",$printer_style)
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $vv."\n";//ojin
        
	  while($result_loginall_shift  = $database->mysqlFetchArray($sql_login))
            {$i++;
                    $sh_login=$result_loginall_shift['ser_firstname'];  
                    $sh_open=date('h:i:s',  strtotime($result_loginall_shift['sd_open']));  
                    $sh_close=date('h:i:s',  strtotime($result_loginall_shift['sd_close']));  
                 
                    $sh_open_bal=$result_loginall_shift['sd_total_value'];  
                    $sh_open_bal1=$sh_open_bal1+$result_loginall_shift['sd_total_value'];  
                    $sh_close_bal=$result_loginall_shift['sd_total_value_close']; 
                    $sh_close_bal1=$sh_close_bal1+$result_loginall_shift['sd_total_value_close']; 
                    
                    
                    
                    
                    $menulist= array(
                             new shiftlogin(substr($sh_login,0,7),$sh_open,$sh_close,  number_format($sh_open_bal,$_SESSION['be_decimal']),number_format($sh_close_bal,$_SESSION['be_decimal']),$printer_style)
               
                        );
                    foreach($menulist as $menulist) {
                        $print .=$left.($menulist);
					
                        }      
                 }
        }
                               
                                $print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
							  $fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}



}

else if($val=="consolidated_game_report")
{

  
 
  
	$string="";
       
	$string.=" DATE(bi_billtime) ='".$datedayclose."' ";
       
        $from="";
        $to="";
        $quantity=""; 
	$final=0;	
	$cur=date("Y-m-d");
	
     $con_game=mysqli_connect(GAME_HOST_NAME, GAME_USER_NAME, GAME_PASSWORD, GAME_DATABASE_NAME);
     
     
                   $sql_kots="select distinct(bd.bd_game_id),DATE(bi_billtime) as date,sum(bd.bd_rate) as totalrate,SEC_TO_TIME(SUM(TIME_TO_SEC(bd.bd_time))) as totaltime ,gm.gm_name from tbl_bill_details bd left join tbl_game_master gm on gm.gm_id=bd.bd_game_id left join tbl_billmaster bm on bm.bi_id=bd.bd_id where $string  AND bi_status='Closed'  group by bd.bd_game_id  ";
                   //echo "select distinct(bd.bd_game_id),DATE(bi_billtime) as date,sum(bd.bd_rate) as totalrate,SEC_TO_TIME(SUM(TIME_TO_SEC(bd.bd_time))) as totaltime ,gm.gm_name from tbl_bill_details bd left join tbl_game_master gm on gm.gm_id=bd.bd_game_id left join tbl_billmaster bm on bm.bi_id=bd.bd_id where $string  AND bi_status='Closed'  group by bd.bd_game_id  ";
            $sql_kotss  =  mysqli_query($con_game,$sql_kots); 
            $num_kots  = mysqli_num_rows($sql_kotss);
            if($num_kots){ $i=0;
               
            $print .= $center.$bold_on."Consolidated".$bold_off."\n";
				$print .= $center.$bold_on."Game Report".$bold_off."\n";
				$print .= $left."\n";	
				if($printer_style=='1'){
                                $vv=str_pad("-",  '45%', "-");//46

                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '42%', "-");
                                }
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
				
				
				$menulist= array(
					new gamebill("Game Name","Date","Time ","Total",$printer_style)
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $vv."\n";//ojin
        $gamefinaltotal=0;
	 while($result_desg136  = $database->mysqlFetchArray($sql_kotss))    
               {$i++;
                    $sl=$i;
                    $gamename=$result_desg136['gm_name'];  
                    $gamedate=$result_desg136['date'];  
                    $gametotaltime=date('h:i:s',  strtotime($result_desg136['totaltime']));  
                 
                    $gametotalrate=$result_desg136['totalrate'];  
                    
                   $gamefinaltotal=$gamefinaltotal+$result_desg136['totalrate'];  
                    
                    
                    
                    
                    $menulist= array(
                             new gamebill(substr($gamename,0,13),$gamedate,$gametotaltime,  number_format($gametotalrate,$_SESSION['be_decimal']),$printer_style)
               
                        );
                    foreach($menulist as $menulist) {
                        $print .=$left.($menulist);
					
                        }      
                 }
                 $print .= $left.$vv."\n";//ojin
                  $menulist= array(
                             new gamebill("Total","","",  number_format($gamefinaltotal,$_SESSION['be_decimal']),$printer_style)
               
                        );
                    foreach($menulist as $menulist) {
                        $print .=$left.($menulist);
					
                        } 
                 
                 
        }
        
                         
                                $print .= $left.$vv."\n";//ojin
				
				
				
				$print .="\n\n\n\n\n";
				
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
							  $fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}



}

else if($val=="discount_report_cr")
{
     //echo "haiii";
    	$print='';
	$string="";
        $stringta="";
	$string=" bm_status='Closed' AND  bm_dayclosedate ='".$datedayclose."' ";
        $stringta=" tab_status='Closed' AND  tab_dayclosedate ='".$datedayclose."' ";
	$reporthead="";
	

		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		
	


    $discountdine=0;
    $discounttacshd=0;
                
                        
                                $print .= $center.$bold_on."Consolidated".$bold_off."\n";
		                $print .= $center.$bold_on."Discount Report".$bold_off."\n";
				
			
				if($printer_style=='1'){
                                $vv=str_pad("-",  '46%', "-");//46

                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '42%', "-");
                                }
				$print .= $left.$vv."\n";//ojin
				$bilno= array(
					new bilno("MODE","VALUE",$printer_style),
				);
				foreach($bilno as $bilno) {
					$print .=$left.($bilno);
				}
				$print .= $left.$vv."\n";//ojin
                                
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
              				
					$bilno= array(
						new bilno("DINE IN",number_format($discountdine,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
                                
         
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
                                            new bilno($mde,number_format($discountta,$_SESSION['be_decimal']),$printer_style),
					);
					foreach($bilno as $bilno) {
						$print .=$left.($bilno);
					}
                                        
                 }  
                }
	  }

                  				$print .= $left.$vv."\n";//ojin
                                                $bilno= array(
                                                     new bilno("Total",number_format(($discountdine+$discounttacshd),$_SESSION['be_decimal']),$printer_style),
                                                    );
                                                    foreach($bilno as $bilno) {
                                                            $print .=$left.($bold_on.$bilno.$bold_off);
                                                    }
				
				$print .= $left.$vv."\n";//ojin

				$print .="\n\n";
				//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
                  
}         

else if($val=="credit_details")
 {
	   $string="";
	  $reporthead="";
	  $st="";
	  	
			
			$string.= "(bm.bm_dayclosedate ='".$datedayclose."'  or  tbm.tab_dayclosedate = '".$datedayclose."' ) ";
			$reporthead="on ".$datedayclose;
				
		
	
		
		
	
	
	

	$print="";
	$final=0;
/*	echo "select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id where $string order by cd.cd_dateofentry ASC";
	die();*/
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno WHERE $string  order by cd.cd_dateofentry ASC"); 
	  //echo "select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno WHERE $string  order by cd.cd_dateofentry ASC";
          $num_login   = $database->mysqlNumRows($sql_login);
		 if($num_login)
                         {
                            $final=0;$i=1;
                            $print .= $center.$bold_on."Consolidated".$bold_off."\n";
                         $print .= $center.$bold_on."Credit Sale  Report".$bold_off."\n";
				
				
				if($printer_style=='1'){
                                $vv=str_pad("-",  '46%', "-");//46

                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '42%', "-");
                                }
				$print .= $left.$vv."\n";//ojin
				//$print .= $left."Slno  Date        Bilno              Final\n";
                                
                                $menulist= array(
					new menulist("Slno","Party","Bilno", "Credit",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
                                $print .= $left.$vv."\n";//ojin
				while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                    {
				$final=$final + $result_login['cd_amount'];
				
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
				
				
				//$print .= $left."------------------------------------------\n";
                                 
				
				
				
				
					
					$menulist= array(
						new menulist($i,$party,$result_login['cd_billno'], number_format($result_login['cd_amount'],$_SESSION['be_decimal']),$printer_style),
					);
					foreach($menulist as $menulist) {
						$print .=$left.($menulist);
					}
					
					//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
					$i++;
                         }
				$print .= $left.$vv."\n";//ojin
                                $menulist= array(
					new menulist("Total","","",number_format($final,$_SESSION['be_decimal']),$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($bold_on.$menulist.$bold_off);
				}
				$print .= $left.$vv."\n";//ojin
                               
                            $print .="\n\n";
                         }	//$print.=$cutpaper;
				
				//And pr_floorid='".$florrid."'
				$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
						}
				}
  
  
  } 
else if($val=="consolidated_timely_report")
{
       $final=0; 
       $time2=0;
       $time1=0;
       
      $print="";
      $from='';
      $to='';
      
        $string="";
        //$tot_roundof=$roundof+$roundoftacshd;
                $cur=date("Y-m-d");
		  $print .= $center.$bold_on."Consolidated".$bold_off."\n";
		  $print .= $center.$bold_on."Hourly Report ".$bold_off."\n";
                  
                   
                                if($printer_style=='1'){
                                $vv=str_pad("-",  '46%', "-");//46

                                }
                                else if($printer_style=='2'){
                                     $vv=str_pad("-",  '42%', "-");
                                }
				$print .= $left."\n";//ojin
                    		$menulist= array(
				new hourly("Slno","Hour Between","Final",$printer_style),
				);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				//$print .= $left."------------------------------------------\n";
				$print .= $left.$vv."\n";//ojin
                        $p=0;
                        
                            
                            
                        
                            $sql_hourly_wise =  $database->mysqlQuery("select sum(x.total) as total, x.hour1 as hour1 from( 
                                                    select  SUM(bm.bm_finaltotal) AS total, HOUR(bm.bm_billtime ) as hour1 FROM tbl_tablebillmaster bm
                                                    where bm.bm_dayclosedate='".$datedayclose."' and bm.bm_status='Closed' and bm.bm_complimentary!='Y' group by HOUR(bm.bm_billtime ) union all
                                                    SELECT  SUM(tbm.tab_netamt) as total, HOUR(tbm.tab_time) as hour1  FROM tbl_takeaway_billmaster tbm
                                                    WHERE tbm.tab_dayclosedate='".$datedayclose."' and tbm.tab_status='Closed' and tbm.tab_complimentary!='Y' group by HOUR(tbm.tab_time)
                                                    )x group by  x.hour1");
                            $num_hourly_wise = $database->mysqlNumRows($sql_hourly_wise);
                            if($num_hourly_wise){
                                while($result_hourly_wise = $database->mysqlFetchArray($sql_hourly_wise)){
                                $p++;
                                $final=$final+$result_hourly_wise['total'];
                                $time1=date('h',strtotime($result_hourly_wise['hour1'].':0:0'));
                                $time2=$result_hourly_wise['hour1']+1;
                                $time2=date('h a',strtotime($time2.':0:0'));
                                
                                $menulist= array(
				new hourly($p,$time1.'-'.$time2,number_format($result_hourly_wise['total'],$_SESSION['be_decimal']),$printer_style));
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
				$print .="\n";
                        }           
                            }         //$print .= $center.$bold_on."TAX SUMMARY".$bold_off."\n";
                         $print .= $left.$vv."\n";//ojin
                                $menulist= array(
				new hourly("","Total",number_format($final,$_SESSION['be_decimal']),$printer_style),);
				foreach($menulist as $menulist) {
					$print .=$left.($menulist);
				}
                               
				$print .="\n";
                                //$print .=$cutpaper;
                                $sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				//echo "Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
                                $sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print);
							  fclose($fp);
							}else
							{
								$fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print);
							  fclose($fp);
							}
                                                        //echo $result_kots['pr_printerip'];
						}
				}
}


	}
        
 }
    
    if($footer4!="")
                                {
                                    
                                     //$print .= $center.$footer3."\n";
                                    $print1 .= $left.$vv."\n";//ojin
				}
                                
                                if($footer4!="")
                                {
                                     $print1 .= $center.$footer4."\n";
                                    
				}
            
				
				$print1 .="\n\n\n\n\n";
                                $print1 .=$cutpaper;

$sql_kots="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."'";
				$sql_kotss  =  mysqli_query($con,$sql_kots); 
				$num_kots  = mysqli_num_rows($sql_kotss);
				if($num_kots){	
				while($result_kots  = mysqli_fetch_array($sql_kotss)) 
						{
							if($result_kots['pr_defaultusb']=='Y')
							{
							  $printer="\\\\".$result_kots['pr_usbprinterip']."\\".$result_kots['pr_usbprinter'];
							  $fp=fopen($printer, 'w');
							  fwrite($fp,$print1);
							  fclose($fp);
							}else
							{
							  $fp = fsockopen($result_kots['pr_printerip'], $result_kots['pr_printerport'], $errno, $errstr, 10);
							  fwrite($fp,$print1);
							  fclose($fp);
							}
						}
				}
    
   class gamebill {
    private $product;
    private $qty;
    private $rate;
    private $amount;
    private $style;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '', $style='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
	$this -> amount = $amount;
        $this -> style = $style;
    }

    public function __toString() {
        if($this -> style=='1'){
        $leftCols ="15%";
	$leftCols1 ="10%";
        $rightCols ="10%";
	$rightCols1 ="10%";
        }
        else if($this -> style=='2'){
           $leftCols ="12%";
	$leftCols1 ="11%";
        $rightCols ="9%";
	$rightCols1 ="10%"; 
        }
		/*$leftCols ="5%";
		$leftCols1 ="12%";
        $rightCols ="14%";
		$rightCols1 ="12%";*/
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
    }
}     
        
class menulist {
    private $product;
    private $qty;
    private $rate;
    private $amount;
    private $style;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '', $style='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
	$this -> amount = $amount;
        $this -> style = $style;
    }

    public function __toString() {
        if($this -> style=='1'){
        $leftCols ="5%";
	$leftCols1 ="12%";
        $rightCols ="15%";
	$rightCols1 ="14%";
        }
        else if($this -> style=='2'){
           $leftCols ="5%";
	$leftCols1 ="13%";
        $rightCols ="13%";
	$rightCols1 ="10%"; 
        }
		/*$leftCols ="5%";
		$leftCols1 ="12%";
        $rightCols ="14%";
		$rightCols1 ="12%";*/
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
    }
}
class bilno {
    private $name;
    private $price;
    private $style;

    public function __construct($name = '', $price = '',$style='') {
        $this -> name = $name;
        $this -> price = $price;
        $this -> style = $style;
    }

    public function __toString() {
        if($this -> style =="1")
            {
            $leftCols = '33%';//32-ojin    33-bbq
            $rightCols = '13%';//10-ojin   13-bbq
            }
        if($this -> style =="2")
            {
            $leftCols = '27%';//32-ojin    33-bbq
            $rightCols = '15%';
            }
                
        $left = str_pad($this -> name, $leftCols) ;
		//$center = str_pad(":", $centerCols) ;
        $right = str_pad($this -> price, $rightCols,' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}
class menulist1 {
    private $product;
    private $qty;
  

    public function __construct($product = '', $qty = '') {
        $this -> product = $product;
        $this -> qty = $qty;
      
	
    }

    public function __toString() {
        $leftCols ="5%";
		$leftCols1 ="40%";
        
		/*$leftCols ="5%";
		$leftCols1 ="12%";
        $rightCols ="14%";
		$rightCols1 ="12%";*/
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_RIGHT) ;
		/*$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_BOTH) ;
			$right12 = str_pad($this -> total, $rightCols2,' ', STR_PAD_BOTH) ;*/
        return "$left$left1\n";
    }
}
class menulist2 {
	private $flr;
	  private $itm;
    private $qty;
    private $tot;



    public function __construct($flr='',$itm ='', $qty = '', $tot = '') {
		$this ->flr=$flr;
       $this -> itm = $itm;
        $this -> qty = $qty;
       $this -> tot = $tot;
    }

    public function __toString() {
		
		
	$leftCols ="5%";
		$leftCols1= "20";
		$leftCols2 ="10%";
        $rightCols ="10%";

      
		
		/*$leftCols ="5%";
		$leftCols1 ="12%";
        $rightCols ="14%";
		$rightCols1 ="12%";*/
		   $left = str_pad($this -> flr, $leftCols,' ', STR_PAD_BOTH) ;
		
        $left1 = str_pad($this -> itm, $leftCols1,' ', STR_PAD_BOTH) ;
		
		$left2 = str_pad($this -> qty, $leftCols2,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> tot, $rightCols,' ', STR_PAD_BOTH) ;
	
        return "$left$left1$left2$right\n";
    }
}
class cat_wise {
    private $product;
    private $qty;
    private $rate;
    private $amount;
    private $style;

    public function __construct($product = '', $qty = '', $rate = '', $amount = '',$style='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
        $this -> amount = $amount;
         $this -> style = $style;
    }

    public function __toString() {
        if($this -> style=='1'){
        $leftCols ="4%";
	$leftCols1 ="21%";
        $rightCols ="8%";
	$rightCols1 ="14%";
        }
        else if($this -> style=='2'){
        $leftCols ="5%";
	$leftCols1 ="16%";
        $rightCols ="8%";
	$rightCols1 ="12%"; 
        }
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_RIGHT) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
    }
}
class itemordered {
    private $product;
    private $qty;
    private $rate;
    private $style;
  

    public function __construct($product = '', $qty = '',$rate='',$style='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
        $this -> style = $style;
      
	
    }

    public function __toString() {
        if($this -> style =='1'){
        $leftCols ="30%";
	$leftCols1 ="5%";
        $rightCols="12%";
        }
        else if($this -> style =='2'){
         $leftCols ="25%";
	$leftCols1 ="5%";
        $rightCols="11%";   
        }
		
		
                $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_LEFT) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		
        return "$left$left1$right\n";
    }
}

class shiftlogin {
   
    private $no;
     private $staff;
    private $cash;
    private $card;
    private $total;
     private $style;

    public function __construct($no='',$staff = '', $cash = '', $card = '', $total = '',$style) {
        $this -> no = $no;
        $this -> staff = $staff;
        $this -> cash = $cash;
        $this -> card = $card;
        $this -> total = $total;
        $this -> style = $style;
    }

    public function __toString() {
        if( $this -> style =='1'){
        $leftCols0 ="9%";
        $leftCols ="9%";
	$leftCols1 ="9%";
        $rightCols ="9";
	$rightCols1 ="9%";
        }
        else if( $this -> style =='2'){
        $leftCols0 ="9%";
        $leftCols ="10%";
	$leftCols1 ="10%";
        $rightCols ="10";
	$rightCols1 ="9%";
        }
		
		
        $left = str_pad($this -> no, $leftCols0,' ', STR_PAD_RIGHT) ;
        $left0 = str_pad($this -> staff, $leftCols,' ', STR_PAD_BOTH) ;
	$left1 = str_pad($this -> cash, $leftCols1,' ', STR_PAD_BOTH) ;
	$right = str_pad($this -> card, $rightCols,' ', STR_PAD_BOTH) ;
	$right1 = str_pad($this -> total, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left0$left1$right$right1\n";
    }
} 


class cashier {
   
    private $no;
     private $staff;
    private $cash;
    private $card;
    private $total;
     private $style;

    public function __construct($no='',$staff = '', $cash = '', $card = '', $total = '',$style) {
        $this -> no = $no;
        $this -> staff = $staff;
        $this -> cash = $cash;
        $this -> card = $card;
        $this -> total = $total;
        $this -> style = $style;
    }

    public function __toString() {
        if( $this -> style =='1'){
        $leftCols0 ="3%";
        $leftCols ="12%";
	$leftCols1 ="10%";
        $rightCols ="10";
	$rightCols1 ="10%";
        }
        else if( $this -> style =='2'){
        $leftCols0 ="2%";
        $leftCols ="10%";
	$leftCols1 ="10%";
        $rightCols ="10";
	$rightCols1 ="10%";
        }
		
		
        $left = str_pad($this -> no, $leftCols0,' ', STR_PAD_BOTH) ;
        $left0 = str_pad($this -> staff, $leftCols,' ', STR_PAD_BOTH) ;
	$left1 = str_pad($this -> cash, $leftCols1,' ', STR_PAD_LEFT) ;
	$right = str_pad($this -> card, $rightCols,' ', STR_PAD_LEFT) ;
	$right1 = str_pad($this -> total, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left0$left1$right$right1\n";
    }
}  
class complimentary {
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
        $leftCols ="12%";
		$leftCols1 ="13%";
        $rightCols ="7%";
		$rightCols1 ="15%";
		
		/*$leftCols ="5%";
		$leftCols1 ="12%";
        $rightCols ="14%";
		$rightCols1 ="12%";*/
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
    }
} 
class hourly {
    private $product;
    private $qty;
    private $rate;
    private $style;
  

    public function __construct($product = '', $qty = '',$rate='',$style='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
        $this -> style = $style;
      
	
    }

    public function __toString() {
        if($this -> style =='1'){
        $leftCols ="15%";
	$leftCols1 ="15%";
        $rightCols="15%";
        }
        else if($this -> style =='2'){
         $leftCols ="13%";
	$leftCols1 ="13%";
        $rightCols="13%";   
        }
		
		
                $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		
        return "$left$left1$right\n";
    }
}

class itemcancel {
   
    private $bill;
     private $qty;
    private $staff;
   
    private $style;
   

    public function __construct($bill='',$qty = '', $staff = '', $style) {
        $this -> bill = $bill;
        $this -> qty = $qty;
        $this -> staff = $staff;
        
        $this -> style = $style;
        
     
    }

    public function __toString() {
        if( $this -> style =='1'){
        $leftCols0 ="14%";
        $leftCols ="23%";
	$leftCols1 ="7%";
      
	
        }
        else if( $this -> style =='2'){
         $leftCols0 ="14%";
        $leftCols ="23%";
	$leftCols1 ="7%";
       
	
        }
		
		
        $left = str_pad($this -> bill, $leftCols0,' ', STR_PAD_RIGHT) ;
        $left0 = str_pad($this -> qty, $leftCols,' ', STR_PAD_RIGHT) ;
	$left1 = str_pad($this -> staff, $leftCols1,' ', STR_PAD_LEFT) ;
	
	
        return "$left$left0$left1\n";
    }
}

class expense {
    private $product;
    private $qty;
    private $rate;
 
    private $style;

    public function __construct($product = '', $qty = '', $rate = '',  $style='') {
        $this -> product = $product;
        $this -> qty = $qty;
        $this -> rate = $rate;
	
        $this -> style = $style;
    }

    public function __toString() {
        if($this -> style=='1'){
        $leftCols ="10";
	$leftCols1 ="20";
        $rightCols ="12";
	
        }
        else if($this -> style=='2'){
           $leftCols ="10";
	$leftCols1 ="20";
        $rightCols ="11";
	
        }
		
		
              $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		
        return "$left$left1$right\n";
    }
}
 class average {
   
    private $no;
     private $staff;
    private $cash;
    private $card;
    private $total;
    

    public function __construct($no='',$staff = '', $cash = '', $card = '', $total = '',$style) {
        $this -> no = $no;
        $this -> staff = $staff;
        $this -> cash = $cash;
        $this -> card = $card;
        $this -> total = $total;
        $this -> style = $style;
    }

    public function __toString() {
        if( $this -> style =='1'){
        $leftCols0 ="10";
        $leftCols ="10";
	$leftCols1 ="8";
        $rightCols ="8";
	$rightCols1 ="8";
        }
        else if( $this -> style =='2'){
        $leftCols0 ="10";
        $leftCols ="10";
	$leftCols1 ="8";
        $rightCols ="8";
	$rightCols1 ="8";
        }
		
		
        $left = str_pad($this -> no, $leftCols0,' ', STR_PAD_RIGHT) ;
        $left0 = str_pad($this -> staff, $leftCols,' ', STR_PAD_RIGHT) ;
	$left1 = str_pad($this -> cash, $leftCols1,' ', STR_PAD_BOTH) ;
	$right = str_pad($this -> card, $rightCols,' ', STR_PAD_BOTH) ;
	$right1 = str_pad($this -> total, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left0$left1$right$right1\n";
    }
}
?>

