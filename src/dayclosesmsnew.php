<?php
session_start();
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
    
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
    
}
//$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
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
                  $sms_show_onoff=array();
                    $sql_sms_show  =  $database->mysqlQuery("select * from tbl_sms_report_settings "); 
                    $num_sms_show  = $database->mysqlNumRows($sql_sms_show);
                    if($num_sms_show){ $i=0;
                        while($result_sms_show  = $database->mysqlFetchArray($sql_sms_show)) 
                        {
                          $sms_show_onoff[$result_sms_show['ss_id']]= $result_sms_show['ss_show']; 
                        }
                    } 
                    //print_r($sms_show_onoff[1]);
// $branch=(strlen($branchname) > 10) ? substr($branchname,0,10).'..' : $branchname;
   $branch=   $branchname;            
$data=$_REQUEST['datesms'];
//echo $data;
$sql_sms1 =  $database->mysqlQuery("Select * from tbl_branchmaster"); 
		  $num_sms1  = $database->mysqlNumRows($sql_sms1);
		  if($num_sms1)
		  {
		         while($result_sms1  = $database->mysqlFetchArray($sql_sms1)) 
					{
                                  $allnum1=$result_sms1['be_sms_list'];
                                        }
                         } 
if($_SESSION['s_sms_on_dayclose']=="Y") // sms yes or no
{
	
	$sms_list=$allnum1;
                 
        $string="";
        $strings="";
        $stringtacshd="";
        $stringstacshd="";
	$reporthead="";
        $strings_exclusive='';
        $stringsta_exclusive='';
	$strings=" bm_status='Closed' AND ";
        $strings_exclusive=" bm_status='Closed' and bm_complimentary!='Y' AND ";
        $stringsta_exclusive=" tab_status='Closed' and tab_complimentary!='Y' AND ";
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
        $string_ter=" ter_status='Closed' ";
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND  ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
	//$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string1tacshd=$stringstacshd. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND  ";	
		
		
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
	


			$string.= " bm_dayclosedate ='".$data."' ";
                        $string_pax.= " bm_dayclosedate ='".$data."' ";
                        $stringtacshd.=" tab_dayclosedate ='".$data."' ";
                        $reporthead="On -".$data;
                        $string_ter.= "and ter_dayclosedate ='".$data."'";
		
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	

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
    $exclusive_di=0;
    $exclusive_ta=0;
    $total_exclusive=0;
    
    $sql_exclusive_di  =  $database->mysqlQuery(" select sum(bm_subtotal_final) as exclusive_di from tbl_tablebillmaster  where $strings_exclusive $string "); 
    //echo "select sum(bm_subtotal_final) as exclusive_di from tbl_tablebillmaster  where $strings_exclusive $string ";
	  $num_exclusive_di   = $database->mysqlNumRows($sql_exclusive_di);
	  if($num_exclusive_di){
		  while($result_exclusive_di  = $database->mysqlFetchArray($sql_exclusive_di)) 
			{ 
			$exclusive_di=	$result_exclusive_di['exclusive_di'];
          }}
            
    $sql_exclusive_ta  =  $database->mysqlQuery(" select sum(tab_subtotal_final) as exclusive_ta from tbl_takeaway_billmaster  where $stringsta_exclusive $stringtacshd "); 
    //echo "select sum(bm_subtotal_final) as exclusive_di from tbl_tablebillmaster  where $strings_exclusive $string ";
	  $num_exclusive_ta   = $database->mysqlNumRows($sql_exclusive_ta);
	  if($num_exclusive_ta){
		  while($result_exclusive_ta  = $database->mysqlFetchArray($sql_exclusive_ta)) 
			{ 
			$exclusive_ta=	$result_exclusive_ta['exclusive_ta'];
          }}

          $total_exclusive=$exclusive_di+$exclusive_ta;


  $sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
 //echo "select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings"."$string order by bm_dayclosedate,bm_billtime ASC";
	  $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	  if($num_logincashdi){
		  while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
			{ 
				if($result_logincashdi['tot'] != "")	{
			$subtotalcash =$subtotalcash + $result_logincashdi['tot'];
                        $roundofdi=$roundofdi+$result_logincashdi['roundofdi'];
          }}} 
          $totalcashdi=$subtotalcash+$roundofdi;
          //echo $totalcashdi;
     $subtotalcashcs=0;
     $subtotalcashhd=0;
     $roundofcs=0;
     $roundofhd=0;
          $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta,tab_mode as mode,$string1_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string1tacshd"."$stringtacshd group by tab_mode order by tab_dayclosedate,tab_time ASC"); 
   //echo "select sum(tab_roundoff_value) as roundofta,tab_mode as mode,$string1_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $stringstacshd"."$stringtacshd group by tab_mode order by tab_dayclosedate,tab_time ASC";
	  $num_logincashta   = $database->mysqlNumRows($sql_logincashta);
	  if($num_logincashta){
		  while($result_logincashta  = $database->mysqlFetchArray($sql_logincashta)) 
			{ 
				
                                    if($result_logincashta['mode']== 'TA'){
			$subtotalcashta =$subtotalcashta + $result_logincashta['tot'];
                        $roundofta=$roundofta+$result_logincashta['roundofta'];
                                    }
                                    if($result_logincashta['mode']== 'CS'){
			$subtotalcashcs =$subtotalcashcs + $result_logincashta['tot'];
                        $roundofcs=$roundofcs+$result_logincashta['roundofta'];
                        
                                    }
                                    if($result_logincashta['mode']== 'HD'){
			$subtotalcashhd =$subtotalcashhd + $result_logincashta['tot'];
                        $roundofhd=$roundofhd+$result_logincashta['roundofta'];
                                    }
                        
          }} 
         
          $totalcashta=$subtotalcashta+$roundofta;
          $totalcashhd=$subtotalcashhd+$roundofhd;
          $totalcashcs=$subtotalcashcs+$roundofcs;
           //echo $totalcashta.',';
           //echo $totalcashhd.',';
           //echo $totalcashcs;
          
          $totalcash=$subtotalcash+$subtotalcashta+$subtotalcashcs+$subtotalcashhd+$roundofdi+$roundofta+$roundofhd+$roundofcs;
          
          


	 $sql_logincredit  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{     
				$subtotalcredit =$subtotalcredit + $result_logincredit['tot'];
          }}
          //echo $subtotalcredit;
          $subtotalcreditcs=0;
          $subtotalcredithd=0;
          $sql_logincreditta  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot,tab_mode as mode from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and  $string2tacshd "."$stringtacshd group by tbm.tab_mode order by tbm.tab_dayclosedate,tbm.tab_time ASC "); 
	  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
	  if($num_logincreditta){
		  while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
			{       if($result_logincreditta['tot'] != "")	{
                                if($result_logincreditta['mode']== 'TA'){
				$subtotalcreditta =$subtotalcreditta + $result_logincreditta['tot'];
                                }
                                if($result_logincreditta['mode']== 'CS'){
                                $subtotalcreditcs =$subtotalcreditcs + $result_logincreditta['tot'];
                                }
                                if($result_logincreditta['mode']== 'HD'){
                                $subtotalcredithd =$subtotalcredithd + $result_logincreditta['tot'];
                                }
          }}}
          //echo $subtotalcreditta;
          //echo $subtotalcredithd;
         // echo $subtotalcreditcs;
          $totalcredit=$subtotalcredit+$subtotalcreditta+$subtotalcreditcs+$subtotalcredithd;
     
			
			
			
	$sql_logincoupon  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
			
	  $num_logincoupon   = $database->mysqlNumRows($sql_logincoupon);

	  if($num_logincoupon){
		  while($result_logincoupon  = $database->mysqlFetchArray($sql_logincoupon)) 
			{
				
			if($result_logincoupon['tot'] != "")	{
				
				$subtotalcoupon =$subtotalcoupon + $result_logincoupon['tot'];
          }}}
          $subtotalcouponcs=0;
          $subtotalcouponhd=0;
          $sql_logincouponta  =  $database->mysqlQuery("select $string3_strtacshd as tot,tab_mode as mode from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3tacshd"." $stringtacshd group by tab_mode order by tab_dayclosedate,tab_time ASC"); 
			
	  $num_logincouponta   = $database->mysqlNumRows($sql_logincouponta);

	  if($num_logincouponta){
		  while($result_logincouponta  = $database->mysqlFetchArray($sql_logincouponta)) 
			{
				
			if($result_logincouponta['tot'] != "")	{
                            
                      if($result_logincouponta['mode']== 'TA'){       
                        $subtotalcouponta =$subtotalcouponta + $result_logincouponta['tot'];
                      }
                       if($result_logincouponta['mode']== 'CS'){
                            $subtotalcouponcs =$subtotalcouponcs + $result_logincouponta['tot'];
                       }
                        if($result_logincouponta['mode']== 'HD'){
                            $subtotalcouponhd =$subtotalcouponhd + $result_logincouponta['tot'];
                        }
          
                
                        }}}
          
                    $totalcoupon=$subtotalcoupon+$subtotalcouponta+$subtotalcouponhd+$subtotalcouponcs;
          
	
			
		$sql_loginvoucher  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string  order by bm_dayclosedate,bm_billtime ASC"); 
		$num_loginvoucher   = $database->mysqlNumRows($sql_loginvoucher);
                 if($num_loginvoucher){
		  while($result_loginvoucher  = $database->mysqlFetchArray($sql_loginvoucher)) 
			{ 
				if($result_loginvoucher['tot'] != "")
			{
                                $subtotalvoucher =$subtotalvoucher + $result_loginvoucher['tot'];
                        
			} }}
                  
                       $subtotalvoucherhd=0;
                       $subtotalvouchercs=0;
                        $sql_loginvoucherta  =  $database->mysqlQuery("select $string3_strtacshd as tot,tab_mode as mode from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4tacshd"." $stringtacshd group by tab_mode  order by tab_dayclosedate,tab_time ASC"); 
			$num_loginvoucherta   = $database->mysqlNumRows($sql_loginvoucherta);
                        if($num_loginvoucherta){
                         while($result_loginvoucherta  = $database->mysqlFetchArray($sql_loginvoucherta)) 
                            { 
				if($result_loginvoucherta['tot'] != "")
                            {
                                if($result_loginvoucherta['mode']== 'TA'){   
                                $subtotalvoucherta =$subtotalvoucherta + $result_loginvoucherta['tot'];
                            }
                            if($result_loginvoucherta['mode']== 'CS'){   
                                $subtotalvouchercs =$subtotalvouchercs + $result_loginvoucherta['tot'];
                            }
                            if($result_loginvoucherta['mode']== 'HD'){   
                                $subtotalvoucherhd =$subtotalvoucherhd + $result_loginvoucherta['tot'];
                            }
			} }}
                        
                        
                       $totalvoucher=$subtotalvoucher+$subtotalvoucherta+$subtotalvouchercs+$subtotalvoucherhd;
                        
	
            $sql_logincheque  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincheque   = $database->mysqlNumRows($sql_logincheque);
	  if($num_logincheque){
		  while($result_logincheque  = $database->mysqlFetchArray($sql_logincheque)) 
			{ 
			if($result_logincheque['tot'] != "")
			{
			$subtotalcheque =$subtotalcheque + $result_logincheque['tot'];
			} }} 
                        
                   $subtotalchequehd=0;
                   $subtotalchequecs=0;
               $sql_loginchequeta  =  $database->mysqlQuery("select $string3_strtacshd as tot,tab_mode as mode from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5tacshd"." $stringtacshd group by tab_mode order by tab_dayclosedate,tab_time ASC"); 
	  $num_loginchequeta   = $database->mysqlNumRows($sql_loginchequeta);
	  if($num_loginchequeta){
		  while($result_loginchequeta  = $database->mysqlFetchArray($sql_loginchequeta)) 
			{ 
			if($result_loginchequeta['tot'] != "")
			{
                            if($result_loginchequeta['mode']== 'TA'){ 
                                $subtotalchequeta =$subtotalchequeta + $result_loginchequeta['tot'];
                            }
                            if($result_loginchequeta['mode']== 'CS'){ 
                                $subtotalchequecs =$subtotalchequecs + $result_loginchequeta['tot'];
                            }
                            if($result_loginchequeta['mode']== 'HD'){ 
                                $subtotalchequehd =$subtotalchequehd + $result_loginchequeta['tot'];
                            }
			} }}           
                        
                  $totalcheque= $subtotalcheque+$subtotalchequeta+$subtotalchequecs+$subtotalchequehd;     
           
 	
			
				
            $sql_logincp  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincp   = $database->mysqlNumRows($sql_logincp);
	  if($num_logincp){
		  while($result_logincp  = $database->mysqlFetchArray($sql_logincp)) 
			{ 
			if($result_logincp['tot'] != "")
			{
			$subtotalcp =$subtotalcp + $result_logincp['tot'];
          } }} 
          //echo $subtotalcp;
          $subtotalcpcs=0;
          $subtotalcphd=0;
           $sql_logincpta  =  $database->mysqlQuery("select $string3_strtacshd as tot,tab_mode as mode from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6tacshd"." $stringtacshd group by tab_mode order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
	  if($num_logincpta){
		  while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
			{ 
			if($result_logincpta['tot'] != "")
			{
                            if($result_logincpta['mode']== 'TA'){
			$subtotalcpta =$subtotalcpta + $result_logincpta['tot'];
                            }
                            if($result_logincpta['mode']== 'CS'){
                        $subtotalcpcs =$subtotalcpcs + $result_logincpta['tot'];
                            }
                            if($result_logincpta['mode']== 'HD'){
                        $subtotalcphd =$subtotalcphd + $result_logincpta['tot'];
                            }
          } }} 
          //echo $subtotalcpta;
          //echo $subtotalcphd;
          //echo $subtotalcpcs;
          
          $totalcp=$subtotalcp+$subtotalcpta+$subtotalcphd+$subtotalcpcs;
		
		
                $sql_logincomp  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_logincomp   = $database->mysqlNumRows($sql_logincomp);
	  if($num_logincomp){
		  while($result_logincomp  = $database->mysqlFetchArray($sql_logincomp)) 
			{ 
			if($result_logincomp['tot'] != "")
			{
			$subtotalcomp =$subtotalcomp + $result_logincomp['tot'];
			} }} 
                 $subtotalcompcs=0;
                 $subtotalcomphd=0;
             $sql_logincompta  =  $database->mysqlQuery("select $string7_strtacshd as tot,tab_mode as mode from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string7tacshd"." $stringtacshd group by tab_mode order by tab_dayclosedate,tab_time ASC"); 
	  $num_logincompta   = $database->mysqlNumRows($sql_logincompta);
	  if($num_logincompta){
		  while($result_logincompta  = $database->mysqlFetchArray($sql_logincompta)) 
			{ 
			if($result_logincompta['tot'] != "")
			{   if($result_logincompta['mode']== 'TA'){
			$subtotalcompta =$subtotalcompta + $result_logincompta['tot'];
                        }
                        if($result_logincompta['mode']== 'CS'){
                        $subtotalcompcs =$subtotalcompcs + $result_logincompta['tot'];
                        }
                        if($result_logincompta['mode']== 'HD'){
                        $subtotalcomphd =$subtotalcomphd + $result_logincompta['tot'];
                        }
			} }}      
                 $totalcomp= $subtotalcomp+$subtotalcompta+$subtotalcomphd+$subtotalcompcs;      
                        
	
                $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		   
		//Select sum(ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid  Where   $string_pax Group By tbl_menumaster.mr_menuname order by ct DESC  
		   
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
  
                    }} 
                  $finaltotal=$totalcash+$totalcredit+$totalcoupon+$totalvoucher+$totalcheque+$totalcp;
                  
               $sql_totbill = $database->mysqlQuery("select count(*) as ct,sum(bm_finaltotal ) as tot FROM tbl_tablebillmaster where bm_status='Closed' and bm_dayclosedate='".$data."'");
               //echo "select count(*) as ct,sum(bm_finaltotal ) as tot FROM tbl_tablebillmaster where bm_status='Closed' and bm_dayclosedate='".$data."'";
               while($result_totbill  = $database->mysqlFetchArray($sql_totbill)){   
               $totalbill= $result_totbill['ct']; 
               $totalbillamount= $result_totbill['tot']; 
               }
               //echo $totalbillamount;
               $sql_bill = $database->mysqlQuery("select count(*) as ct, sum( bm_finaltotal ) as tot FROM tbl_tablebillmaster where bm_status = 'Cancelled'  and bm_dayclosedate='".$data."'");
               while($result_bill  = $database->mysqlFetchArray($sql_bill)){
               $totalbillcancel= $result_bill['ct'];
                $totalbillcancelamount= $result_bill['tot'];
               }
               //echo $totalbillcancelamount;
                   $kotsum=0;
                   $ordersum=0;
                   $cancelordersum=0;
                   
                   $sqlkot = $database-> mysqlQuery("select sum((o.ter_rate*o.ter_qty)) as Total from tbl_tableorder o where o.ter_dayclosedate='".$data."' and o.ter_qty > 0 and o.ter_status='Closed'");
                    
                   //echo"select sum((o.ter_rate*o.ter_qty)) as Total from tbl_tableorder o where $stringkot";
                   $num_kot   = $database->mysqlNumRows($sqlkot);
                   if($num_kot){
                     while($result_kot  = $database->mysqlFetchArray($sqlkot))
                      {
                            $ordersum=$result_kot['Total'];
                           
                   
                     }
                     
                      }
                      

                    $kotsumta=0;
                   
                   
                     $sqlkotta = $database-> mysqlQuery("select sum((tbd.tab_rate*tbd.tab_qty)) as Total from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where tbm.tab_dayclosedate ='".$data."'  and tbd.tab_status='Closed'");
                     $num_kotta   = $database->mysqlNumRows($sqlkotta);
                     if($num_kotta){
                     while($result_kotta  = $database->mysqlFetchArray($sqlkotta))
                      {
                            $kotsumta=$result_kotta['Total'];
                           
                   
                     }
                     
                      }
                      
                        //echo $ordersum;
                         //echo $kotsumta;
                        //echo $kotsum;
                      
                      $kotsum=$ordersum+$kotsumta;
               
               
                 
	$date_data='';
                $date_data=explode('-',$data);
            $smstext=" Sales Summary  (".$branch.") -".$date_data[2].'-'.$date_data[1].'-'.$date_data[0]."\n";
            
            if($sms_show_onoff[2]=='Y'){
                if($total_exclusive > 0){
                   $smstext.= "\nTotal(Excl Tax)  :".number_format($total_exclusive,$_SESSION['be_decimal']);
                }
            }
            
            
          if($sms_show_onoff[1]=='Y'){
            if($finaltotal > 0){
               $smstext.= "\nTotal(Incl Tax)  :".number_format($finaltotal,$_SESSION['be_decimal']);
            }
          }
          if($sms_show_onoff[3]=='Y'){
            if($kotsum > 0){
               $smstext.= "\nTotal KOT :".number_format($kotsum,$_SESSION['be_decimal']);
            }
          }
          if($sms_show_onoff[7]=='Y'){
              
          
                if($totalcashdi > 0||$subtotalcredit > 0||$subtotalvoucher > 0||$subtotalcoupon > 0||$subtotalcoupon > 0||$subtotalcheque > 0||$subtotalcp > 0||$subtotalcomp > 0){
                    $smstext.= "\n* DI *";
                 }
                    if($totalcashdi > 0){
                    $smstext.= "\nCash :".number_format($totalcashdi,$_SESSION['be_decimal']);
                 }
                 if($subtotalcredit > 0){

                    $smstext.= "\nCard -".number_format($subtotalcredit,$_SESSION['be_decimal']);
                 }
                 if($subtotalvoucher > 0){

                    $smstext.= "\nVoucher :".number_format($subtotalvoucher,$_SESSION['be_decimal']);
                 }
                 if($subtotalcoupon > 0){

                    $smstext.= "\nCoupons :".number_format($subtotalcoupon,$_SESSION['be_decimal']);
                 }
                 if($subtotalcheque > 0){

                    $smstext.= "\nCheque :".number_format($subtotalcheque,$_SESSION['be_decimal']);
                 }
                 if($subtotalcp > 0){

                    $smstext.= "\nCredits :".number_format($subtotalcp,$_SESSION['be_decimal']);
                 }
                 if($subtotalcomp > 0){

                    $smstext.= "\nComplimentary :".number_format($subtotalcomp,$_SESSION['be_decimal']);
                 }
            }
            if($sms_show_onoff[5]=='Y'){
                if($totalbill > 0){
                $smstext.= "\nTotal Bill :".$totalbill." (".number_format($totalbillamount,$_SESSION['be_decimal']).")" ;
                }
            }
            if($sms_show_onoff[11]=='Y'){
                if($totalbillcancel > 0){
                $smstext.= "\nBill Cancel :".$totalbillcancel." (".number_format($totalbillcancelamount,$_SESSION['be_decimal']).")" ;
                }
             }
            if($sms_show_onoff[6]=='Y'){
                if($qtycount > 0){
                $smstext.= "\nTotal Pax :".$qtycount; 

                }
            }
           $qtycount=0;
           $t="as";
           $data = array();
           if($sms_show_onoff[4]=='Y'){
           $sql_stw = $database->mysqlQuery("Select t.ter_staff, s.ser_firstname as name From tbl_tableorder t Inner Join tbl_staffmaster s On t.ter_staff = s.ser_staffid Inner Join tbl_tablebillmaster bm On t.ter_billnumber = bm.bm_billno where $string group by t.ter_staff");
            $num_stw   = $database->mysqlNumRows($sql_stw);
            if($num_stw){
                $smstext.= "\nStewards:";
                while($result_stw  = $database->mysqlFetchArray($sql_stw)){
                $amnt=0;    
                                
                $sql_bill = $database->mysqlQuery("SELECT bm.bm_billno, bm.bm_finaltotal FROM tbl_tablebillmaster bm WHERE $string order by bm.bm_billno desc");
                $num_bill   = $database->mysqlNumRows($sql_bill);
                if($num_bill){
                                
                                while($result_bill  = $database->mysqlFetchArray($sql_bill)){
                                        $sql_final = $database->mysqlQuery("SELECT DISTINCT(ter_billnumber), ter_staff FROM tbl_tableorder WHERE ter_billnumber='".$result_bill['bm_billno']."' AND $string_ter");
                                        $num_final   = $database->mysqlNumRows($sql_final);
                                        if($num_final){
                                            
                                            $result_final  = $database->mysqlFetchArray($sql_final);
                                                
                                                $steward = $result_final['ter_staff'];
                                                if($result_stw['ter_staff'] == $steward){
                                                    $amnt = $amnt + $result_bill['bm_finaltotal'];
                                                
                                                }
//                                          
                                        }
                                        
                                    }
                                  
                                }
                                if($amnt>0)
                                {
                                 $smstext.= "\n".$result_stw['name']."-".number_format($amnt,$_SESSION['be_decimal']);  
                                 }
                                    }
                             }
                    } 
            if($sms_show_onoff[8]=='Y'){        
                    if($totalcashta > 0||$subtotalcreditta > 0||$subtotalvoucherta > 0||$subtotalcouponta > 0||$subtotalcouponta > 0||$subtotalchequeta > 0||$subtotalcpta > 0||$subtotalcompta > 0){
                    $smstext.= "\n* TA *";
                    }
                    if($totalcashta > 0){
                    $smstext.= "\nCash :".number_format($totalcashta,$_SESSION['be_decimal']);
                 }
                 if($subtotalcreditta > 0){

                    $smstext.= "\nCard :".number_format($subtotalcreditta,$_SESSION['be_decimal']);
                 }
                 if($subtotalvoucherta > 0){

                    $smstext.= "\n Voucher :".number_format($subtotalvoucherta,$_SESSION['be_decimal']);
                 }
                 if($subtotalcouponta > 0){

                    $smstext.= "\nCoupons -".number_format($subtotalcouponta,$_SESSION['be_decimal']);
                 }
                 if($subtotalchequeta > 0){

                    $smstext.= "\nCheque :".number_format($subtotalchequeta,$_SESSION['be_decimal']);
                 }
                 if($subtotalcpta > 0){

                    $smstext.= "\nCredits :".number_format($subtotalcpta,$_SESSION['be_decimal']);
                 }
                 if($subtotalcompta > 0){

                    $smstext.= "\nComplimentary :".number_format($subtotalcompta,$_SESSION['be_decimal']);
                 }      
            }
            if($sms_show_onoff[10]=='Y'){
          if($totalcashcs > 0||$subtotalcreditcs > 0||$subtotalvouchercs > 0||$subtotalcouponcs > 0||$subtotalcouponcs > 0||$subtotalchequecs > 0||$subtotalcpcs > 0||$subtotalcompcs > 0){
              $smstext.= "\n* CS *";
           }
              if($totalcashcs > 0){
              $smstext.= "\nCash :".number_format($totalcashcs,$_SESSION['be_decimal']);
           }
           if($subtotalcreditcs > 0){
              
              $smstext.= "\nCard :".number_format($subtotalcreditcs,$_SESSION['be_decimal']);
           }
           if($subtotalvouchercs > 0){
              
              $smstext.= "\n Voucher :".number_format($subtotalvouchercs,$_SESSION['be_decimal']);
           }
           if($subtotalcouponcs > 0){
              
              $smstext.= "\nCoupons :".number_format($subtotalcouponcs,$_SESSION['be_decimal']);
           }
           if($subtotalchequecs > 0){
              
              $smstext.= "\nCheque :".number_format($subtotalchequecs,$_SESSION['be_decimal']);
           }
           if($subtotalcpcs > 0){
              
              $smstext.= "\nCredits -".number_format($subtotalcpcs,$_SESSION['be_decimal']);
           }
           if($subtotalcompcs > 0){
              
              $smstext.= "\nComplimentary :".number_format($subtotalcompcs,$_SESSION['be_decimal']);
           }
        }
        if($sms_show_onoff[9]=='Y'){
            
           if($totalcashhd > 0||$subtotalcredithd > 0||$subtotalvoucherhd > 0||$subtotalcouponhd > 0||$subtotalcouponhd > 0||$subtotalchequehd > 0||$subtotalcphd > 0||$subtotalcomphd > 0){
               
              $smstext.= "\n* HD *";
           }
              if($totalcashhd > 0){
              $smstext.= "\nCash :".number_format($totalcashhd,$_SESSION['be_decimal']);
           }
           if($subtotalcredithd > 0){
              
              $smstext.= "\nCard :".number_format($subtotalcredithd,$_SESSION['be_decimal']);
           }
           if($subtotalvoucherhd > 0){
              
              $smstext.= "\nVoucher :".number_format($subtotalvoucherhd,$_SESSION['be_decimal']);
           }
           if($subtotalcouponhd > 0){
              
              $smstext.= "\nCoupons :".number_format($subtotalcouponhd,$_SESSION['be_decimal']);
           }
           if($subtotalchequehd > 0){
              
              $smstext.= "\nCheque :".number_format($subtotalchequehd,$_SESSION['be_decimal']);
           }
           if($subtotalcphd > 0){
              
              $smstext.= "\nCredits :".number_format($subtotalcphd,$_SESSION['be_decimal']);
           }
           if($subtotalcomphd > 0){
              
              $smstext.= "\nComplimentary :".number_format($subtotalcomphd,$_SESSION['be_decimal']);
           }
        }   
          //-------------------------
          
         if (!in_array("Y", $sms_show_onoff))
        {
            $smstext.='No data to show !!! Please check dayclose report settings in reports.';
        }                       
	 			
 

	$be_sms_username		="";
		$be_sms_apipassword	="";
		$be_sms_senderid		="";
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
                                                 $be_sms_priority			=$result_general['be_sms_priority'];
                                                 $be_sms_method			        =$result_general['be_sms_method'];
                                                 
                                        }
		  }
		//http://www.webqua.net/pushsms.php?username=exploreit&api_password=f8386edkhhzkcsaqt&sender=websms&to=9895366444&message=thank%20you%20for%20contacting%20us&priority=11
		$username=$be_sms_username;
		$api_password=$be_sms_apipassword;
		$sender=$be_sms_senderid;
		$domain=$be_sms_domainid;
                $priority=$be_sms_priority;
                $smstype = $be_sms_method; 
		$username=urlencode($username);
		$sender=urlencode($sender);
		$message=urlencode($smstext);
                $domain=urlencode($domain);
                $route=urlencode($priority);
		
                                
                 $parameters="username=$username&api_password=$api_password&sender=$sender&to=$sms_list&priority=$route&message=$message";
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
	  $response['messages'] = stream_get_contents($fp);
		 $res=explode("Trackid",$response['messages']);
             $res1=explode("alert_",$res[0]);
             $dl=trim($res1[1]);

                
                
                $b1=fopen("http://$domain/fetchdlr.php?username=$username&msgid=$dl","r");
    $response12['messages'] = stream_get_contents($b1);
    $resu1=explode("Dlr Status: ",$response12['messages']);
    
    //echo  $resu1[1];
                
                
                
                if($resu1[1]=="Sent" || $resu1[1]=="Delivered"  ){
                $sql_smssent_updation  =  $database->mysqlQuery("Update tbl_dayclose set dc_dayclose_sms_success='Y',dc_last_sms_time=NOW() where dc_day='".$_REQUEST['datesms']."'");
                }
		fpassthru($fp);
		fclose($fp);
                
                
                $locationsms='..\util\Dayclose_sms_details/';
                
                 if(!is_dir($locationsms)){
                     
            mkdir($locationsms , 0777,TRUE);   
                 }
          if(!file_exists("..\util\Dayclose_sms_details/".$_REQUEST['datesms'].".txt")) 
         {
          $myfile = fopen("..\util\Dayclose_sms_details/".$_REQUEST['datesms'].".txt", "w") or die("Unable to open file!");
             
             fwrite($myfile, $response1['messages']);
         
              fclose($myfile);
          }
	
}




?>