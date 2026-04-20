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

    include('email/km_smtp_class.php');
    require_once('Mailer/PHPMailerAutoload.php');

$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);

$branchname='';

if(isset($_REQUEST['set_msg'])&& $_REQUEST['set_msg']=="timely_msg" ){
    
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
          $sql_login  =  $database->mysqlQuery("select bm_dayclosedate from tbl_tablebillmaster where bm_dayclosedate='".$_SESSION['date']."' and "
          . " bm_status='Closed' "); 

	  $num_login   = $database->mysqlNumRows($sql_login);
          
	  $sql_loginta  =  $database->mysqlQuery("select tab_dayclosedate from tbl_takeaway_billmaster where tab_dayclosedate='".$_SESSION['date']."' and "
          . " tab_status='Closed' "); 

	  $num_loginta   = $database->mysqlNumRows($sql_loginta);
          
	  if($num_login || $num_loginta)
	  {
            
         
     $time_to_send=$_REQUEST['msg_time'].":00";
               
     $sql_branch1 =  $database->mysqlQuery("Select tml_time  from tbl_timely_sms_entry where tml_time ='".$time_to_send."' and "
             . " tml_dayclose='".$_SESSION['date']."' and tml_email='Y' "); 
		  $num_branch1  = $database->mysqlNumRows($sql_branch1);
		  if($num_branch1)
		  {      
                    
                  } else{
                 
                 $sql_sms_updation  =  $database->mysqlQuery("Update  tbl_timely_sms_entry set tml_email='Y' where "
                 . " tml_time='".$time_to_send."' and tml_dayclose='".$_SESSION['date']."' ");
             
                  $sql_branch =  $database->mysqlQuery("Select be_branchname,be_sms_list from tbl_branchmaster"); 
		  $num_branch  = $database->mysqlNumRows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = $database->mysqlFetchArray($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
                                                 $sms_list=$result_branch['be_sms_list'];
						
					}
		  }
                  
                    $sms_show_onoff=array();
                    $sql_sms_show  =  $database->mysqlQuery("select * from tbl_sms_report_settings "); 
                    $num_sms_show  = $database->mysqlNumRows($sql_sms_show);
                    if($num_sms_show){ $i=0;
                        while($result_sms_show  = $database->mysqlFetchArray($sql_sms_show)) 
                        {
                             $sms_show_onoff[$result_sms_show['ss_id']]= $result_sms_show['ss_timely_report_show']; 
                        }
                    } 
                    
                    
                    $sql_sms_show1  =  $database->mysqlQuery("select dc_timeopen from tbl_dayclose where dc_day='".$_SESSION['date']."'"); 
                    $num_sms_show1  = $database->mysqlNumRows($sql_sms_show1);
                    if($num_sms_show1){
                        while($result_sms_show1  = $database->mysqlFetchArray($sql_sms_show1)) 
                        {
                             $dayopentime= $result_sms_show1['dc_timeopen']; 
                        }
                    } 
                    
        $branch= $branchname;    
        $data=$_SESSION['date']; 
        $string="";
        $strings="";
        $stringtacshd="";
        $stringstacshd="";
	$reporthead="";
        $strings_exclusive='';
        $stringsta_exclusive='';
        $stringsta_exclusive=" tab_status='Closed' and tab_complimentary!='Y' AND ";
        $strings_exclusive=" bm_status='Closed' and bm_complimentary!='Y' AND ";
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
        $string_ter=" ter_status='Closed' ";
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND  ";
	
	$string1tacshd=$stringstacshd. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND  ";	
		
		
	$string2 =$strings." pym_code='credit'  AND";
	$string2tacshd =$stringstacshd." pym_code='credit'  AND";
        $string3 =$strings. " pym_code='coupon'  AND";
        $string3tacshd =$stringstacshd. " pym_code='coupon'  AND";
	$string4 =$strings. " pym_code='voucher' AND";
        $string4tacshd =$stringstacshd. " pym_code='voucher' AND";
	$string5 =$strings. " pym_code='cheque' AND";
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
    
    $sql_exclusive_di  =  $database->mysqlQuery(" select sum(bm_subtotal_final) as exclusive_di from tbl_tablebillmaster  "
    . " where $strings_exclusive $string "); 
    
	  $num_exclusive_di   = $database->mysqlNumRows($sql_exclusive_di);
	  if($num_exclusive_di){
		  while($result_exclusive_di  = $database->mysqlFetchArray($sql_exclusive_di)) 
			{ 
                      
			$exclusive_di=	$result_exclusive_di['exclusive_di'];
          }}
            
         $sql_exclusive_ta  =  $database->mysqlQuery(" select sum(tab_subtotal_final) as exclusive_ta from tbl_takeaway_billmaster "
         . " where $stringsta_exclusive $stringtacshd "); 
  
	  $num_exclusive_ta   = $database->mysqlNumRows($sql_exclusive_ta);
	  if($num_exclusive_ta){
		  while($result_exclusive_ta  = $database->mysqlFetchArray($sql_exclusive_ta)) 
			{ 
			$exclusive_ta=	$result_exclusive_ta['exclusive_ta'];
          }}

          $total_exclusive=$exclusive_di+$exclusive_ta;

  $sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
  
	  $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
	  if($num_logincashdi){
		  while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
			{ 
				if($result_logincashdi['tot'] != "")	{
			$subtotalcash =$subtotalcash + $result_logincashdi['tot'];
                        $roundofdi=$roundofdi+$result_logincashdi['roundofdi'];
          }}} 
          $totalcashdi=$subtotalcash+$roundofdi;
         
     $subtotalcashcs=0;
     $subtotalcashhd=0;
     $roundofcs=0;
     $roundofhd=0;
          $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta,tab_mode as mode,$string1_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string1tacshd"."$stringtacshd group by tab_mode order by tab_dayclosedate,tab_time ASC"); 
 
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
           
          $totalcash=$subtotalcash+$subtotalcashta+$subtotalcashcs+$subtotalcashhd+$roundofdi+$roundofta+$roundofhd+$roundofcs;
          
	 $sql_logincredit  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{     
				$subtotalcredit =$subtotalcredit + $result_logincredit['tot'];
          }}
         
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
		   
		
		   
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
  
                    }} 
                  $finaltotal=$totalcash+$totalcredit+$totalcoupon+$totalvoucher+$totalcheque+$totalcp;
                  
               $sql_totbill = $database->mysqlQuery("select count(*) as ct,sum(bm_finaltotal ) as tot FROM tbl_tablebillmaster where bm_status='Closed' and bm_dayclosedate='".$data."'");
             
               while($result_totbill  = $database->mysqlFetchArray($sql_totbill)){   
               $totalbill= $result_totbill['ct']; 
               $totalbillamount= $result_totbill['tot']; 
               }
              
               $sql_bill = $database->mysqlQuery("select count(*) as ct, sum( bm_finaltotal ) as tot FROM tbl_tablebillmaster where bm_status = 'Cancelled'  and bm_dayclosedate='".$data."'");
               while($result_bill  = $database->mysqlFetchArray($sql_bill)){
               $totalbillcancel= $result_bill['ct'];
                $totalbillcancelamount= $result_bill['tot'];
               }
              
                   $kotsum=0;
                   $ordersum=0;
                   $cancelordersum=0;
                   
                   $sqlkot = $database-> mysqlQuery("select sum((o.ter_rate*o.ter_qty)) as Total from tbl_tableorder o where o.ter_dayclosedate='".$data."' and o.ter_qty > 0 and  o.ter_status='Closed' ");
                    
                   $num_kot   = $database->mysqlNumRows($sqlkot);
                   if($num_kot){
                     while($result_kot  = $database->mysqlFetchArray($sqlkot))
                      {
                            $ordersum=$result_kot['Total'];
                           
                   
                     }
                     
                      }
                      

                    $kotsumta=0;
                   
                   
                     $sqlkotta = $database-> mysqlQuery("select sum((tbd.tab_rate*tbd.tab_qty)) as Total from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where tbm.tab_dayclosedate ='".$data."' and tbd.tab_status='Closed' ");
                     $num_kotta   = $database->mysqlNumRows($sqlkotta);
                     if($num_kotta){
                     while($result_kotta  = $database->mysqlFetchArray($sqlkotta))
                      {
                            $kotsumta=$result_kotta['Total'];
                           
                   
                     }
                     
                      }
                      
                      
                      
                      $ordersum_cb_ta=0;
                      $sqlkot21 = $database-> mysqlQuery("select distinct(o.cbd_count_combo_ordering),(o.cbd_combo_pack_rate*o.cbd_combo_qty) as Total from tbl_combo_bill_details_ta o where o.cbd_dayclosedate='".$data."' and o.cbd_combo_qty > 0 and  o.cbd_order_status='Closed' ");
                    
                   //echo"select sum((o.ter_rate*o.ter_qty)) as Total from tbl_tableorder o where $stringkot";
                   $num_kot21   = $database->mysqlNumRows($sqlkot21);
                   if($num_kot21){
                     while($result_kot21  = $database->mysqlFetchArray($sqlkot21))
                      {
                            $ordersum_cb_ta=$ordersum_cb_ta+$result_kot21['Total'];
                           
                   
                     }
                     
                      }
                      
                       $ordersum_cb=0;
                      $sqlkot2 = $database-> mysqlQuery("select distinct(o.cod_count_combo_ordering),(o.cod_combo_pack_rate*o.cod_combo_qty) as Total from tbl_combo_ordering_details o where o.cod_dayclosedate='".$data."' and o.cod_combo_qty > 0 and  o.cod_order_status='Served' ");
                    
                   //echo"select sum((o.ter_rate*o.ter_qty)) as Total from tbl_tableorder o where $stringkot";
                   $num_kot2   = $database->mysqlNumRows($sqlkot2);
                   if($num_kot2){
                     while($result_kot2  = $database->mysqlFetchArray($sqlkot2))
                      {
                            $ordersum_cb=$ordersum_cb+$result_kot2['Total'];
                           
                   
                     }
                     
                      }
                      
                      
                      $kotsum=$ordersum+$kotsumta+$ordersum_cb+$ordersum_cb_ta;
               
		$date_data='';
                $date_data=explode('-',$data);
                
                $return='';
                $left='';
                  //  $return.="  Timely Email  Report   \r\n" ;                   
                
              //  $return.="----------------------------------------------------------------------";
                                       // $return.="\r\n";
            $smstext1= "Date : ".$date_data[2].'-'.$date_data[1].'-'.$date_data[0]." [ From ". $dayopentime ." To ". $time_to_send." ]";
           
            
            
                                        $bilno= array(
					new bilno($smstext1,''),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                           // $return.="----------------------------------------------------------------------";
                                        $return.="<br />";
            
            
            
            if($sms_show_onoff[2]=='Y'){
                 $tot_exc="0";
                if($total_exclusive > 0){
                    
                    
                 
                   $tot_exc=number_format($total_exclusive,$_SESSION['be_decimal']);
                   
                                        $bilno= array(
					new bilno("Total(Excl Tax)  : ",number_format($total_exclusive,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
                   
                   
                }
            }
            if($sms_show_onoff[1]=='Y'){
                  $tot_fin="0";
                if($finaltotal > 0){
                 
                  
                   $tot_fin=number_format($finaltotal,$_SESSION['be_decimal']);
                   
                   $bilno= array(
					new bilno("Total Sale  : ",number_format($finaltotal,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
                }
            }
            if($sms_show_onoff[3]=='Y'){
                   $tot_kot_sale="0";
                if($kotsum > 0){
                 
                   $tot_kot_sale=number_format($kotsum,$_SESSION['be_decimal']);
                  
                   $bilno= array(
					new bilno("Total KOT  : ",number_format($kotsum,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
                }
            }
            if($sms_show_onoff[7]=='Y'){
                if($totalcashdi > 0||$subtotalcredit > 0||$subtotalvoucher > 0||$subtotalcoupon > 0||$subtotalcoupon > 0||$subtotalcheque > 0||$subtotalcp > 0||$subtotalcomp > 0){
                   
                    
                    $bilno= array(
					new bilno(" ",''),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                       $return.='<br /><strong style="color:#000;font-size:16px;">Dine In</strong><br />';
                    
                    
                    
                 }
                  $cash_di="0";
                    if($totalcashdi > 0){
                    
                   $cash_di=number_format($totalcashdi,$_SESSION['be_decimal']);
                    
                    $bilno= array(
					new bilno(" Cash -  ",number_format($totalcashdi,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
                    
                    
                 }
                  $card_di="0";
                 if($subtotalcredit > 0){

                  
                   $card_di=number_format($subtotalcredit,$_SESSION['be_decimal']);
                    $bilno= array(
					new bilno(" Card -  ",number_format($subtotalcredit,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
                 }
                 if($subtotalvoucher > 0){

                    
                    
                     $bilno= array(
					new bilno(" Voucher -  ",number_format($subtotalvoucher,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                         $return.="<br />";
                 }
                 if($subtotalcoupon > 0){

                   
                    
                    $bilno= array(
					new bilno(" Coupons -  ",number_format($subtotalcoupon,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
                 }
                 if($subtotalcheque > 0){

                     
                   
                     $bilno= array(
					new bilno(" Cheque -  ",number_format($subtotalcheque,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
                 }
                   $credit_di="0";
                 if($subtotalcp > 0){

                  
                   $credit_di=number_format($subtotalcp,$_SESSION['be_decimal']);
                    $bilno= array(
					new bilno(" Credits -  ",number_format($subtotalcp,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
                 }
                   $comp_di="0";
                 if($subtotalcomp > 0){

                    
                  
                   $comp_di=number_format($subtotalcomp,$_SESSION['be_decimal']);
                    $bilno= array(
					new bilno(" Complimentary -  ",number_format($subtotalcomp,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
                 }
            }
            if($sms_show_onoff[5]=='Y'){
                  $tot_bill_amt="0";
                if($totalbill > 0){
                    
                   
                   $tot_bill_amt=number_format($totalbillamount,$_SESSION['be_decimal']);
             
                $bilno= array(
					new bilno("<br /> Total Bill  -  ",$totalbill.'( '.number_format($totalbillamount,$_SESSION['be_decimal']).' )'),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
               
                }
            }
            if($sms_show_onoff[11]=='Y'){
                  $tot_bill_amt_cancel="0";
                if($totalbillcancel > 0){
              
                   $tot_bill_amt_cancel=number_format($totalbillcancelamount,$_SESSION['be_decimal']);
                
                $bilno= array(
					new bilno(" Bill Cancel -  ",$totalbillcancel.'( '.number_format($totalbillcancelamount,$_SESSION['be_decimal']).' )'),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                       $return.="<br />";
                
                
                }
            }    
             
            if($sms_show_onoff[6]=='Y'){
                $tot_pax_di="0";
                if($qtycount > 0){
              
                   $tot_pax_di=$qtycount;
                                  $bilno= array(
					new bilno(" Total Pax -  ",$qtycount),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
                }
            }
           
           $qtycount=0;
           $t="as";
           //$data = array();
           if($sms_show_onoff[4]=='Y'){
           $sql_stw = $database->mysqlQuery("Select t.ter_staff, s.ser_firstname as name From tbl_tableorder t Inner Join tbl_staffmaster s On t.ter_staff = s.ser_staffid Inner Join tbl_tablebillmaster bm On t.ter_billnumber = bm.bm_billno where $string group by t.ter_staff");
            $num_stw   = $database->mysqlNumRows($sql_stw);
            if($num_stw){
                
                $bilno= array(
					new bilno("",''),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                         $return.='<br /><strong style="color:#000;font-size:16px;">Stewards</strong><br />';
                                        
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
                               $stw_div='';  
                       $stw_div='          <tr>
                      <th style="text-align:left;">'.$result_stw['name'].'</th>
                      <td width="50%" style="text-align:left;">'.number_format($amnt,$_SESSION['be_decimal']).'</td>
                    </tr>';
                                 $bilno= array(
					new bilno($result_stw['name'],number_format($amnt,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                       $return.="<br />";
                                 
                                 }
                                    }
                             }
                        }
        if($sms_show_onoff[8]=='Y'){                
              if($totalcashta > 0||$subtotalcreditta > 0||$subtotalvoucherta > 0||$subtotalcouponta > 0||$subtotalcouponta > 0||$subtotalchequeta > 0||$subtotalcpta > 0||$subtotalcompta > 0){
              
              
              $bilno= array(
					new bilno(' ',''),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                          $return.='<br /><strong style="color:#000;font-size:16px;">Take Away</strong><br />';
              
              
              }
               $cash_ta="0";
              if($totalcashta > 0){
                 
                   $cash_ta=number_format($totalcashta,$_SESSION['be_decimal']);
           
              $bilno= array(
					new bilno('Cash - ',number_format($totalcashta,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
            $card_ta="0";
           if($subtotalcreditta > 0){
              
              
                   $card_ta=number_format($subtotalcreditta,$_SESSION['be_decimal']);
              
              $bilno= array(
					new bilno('Card - ',number_format($subtotalcreditta,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
              
           }
           if($subtotalvoucherta > 0){
              
            
              
              $bilno= array(
					new bilno('Voucher - ',number_format($subtotalvoucherta,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
           if($subtotalcouponta > 0){
              
             
              $bilno= array(
					new bilno('Coupons - ',number_format($subtotalcouponta,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
           if($subtotalchequeta > 0){
              
           
              $bilno= array(
					new bilno('Cheque - ',number_format($subtotalchequeta,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                         $return.="<br />";
           }
              $credit_ta="0";
           if($subtotalcpta > 0){
              
          
                   $credit_ta=number_format($subtotalcpta,$_SESSION['be_decimal']);
              
              $bilno= array(
					new bilno('Credits - ',number_format($subtotalcpta,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
             $comp_ta="0";
           if($subtotalcompta > 0){
              
             
                   $comp_ta=number_format($subtotalcompta,$_SESSION['be_decimal']);
              $bilno= array(
					new bilno('Complimentary - ',number_format($subtotalcompta,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }      
        }
        if($sms_show_onoff[10]=='Y'){
          if($totalcashcs > 0||$subtotalcreditcs > 0||$subtotalvouchercs > 0||$subtotalcouponcs > 0||$subtotalcouponcs > 0||$subtotalchequecs > 0||$subtotalcpcs > 0||$subtotalcompcs > 0){
             
              
              $bilno= array(
					new bilno(' ',''),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                         $return.='<br /><strong style="color:#000;font-size:16px;">Counter Sale</strong><br />';
           }
             $cash_cs="0";
              if($totalcashcs > 0){
           
                   $cash_cs=number_format($totalcashcs,$_SESSION['be_decimal']);
              $bilno= array(
					new bilno('Cash -  ',number_format($totalcashcs,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
             $card_cs="0";
           if($subtotalcreditcs > 0){
              
            
                   $card_cs=number_format($subtotalcreditcs,$_SESSION['be_decimal']);
              $bilno= array(
					new bilno('Card -  ',number_format($subtotalcreditcs,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
           if($subtotalvouchercs > 0){
              
              
              $bilno= array(
					new bilno('Voucher -  ',number_format($subtotalvouchercs,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
           if($subtotalcouponcs > 0){
              
              
              $bilno= array(
					new bilno('Coupons -  ',number_format($subtotalcouponcs,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
           if($subtotalchequecs > 0){
              
             
              $bilno= array(
					new bilno('Cheque -  ',number_format($subtotalchequecs,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
            $credit_cs="0";
           if($subtotalcpcs > 0){
             
                   $credit_cs=number_format($subtotalcpcs,$_SESSION['be_decimal']);
           
              $bilno= array(
					new bilno('Credits -  ',number_format($subtotalcpcs,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
               $comp_cs="0";
           if($subtotalcompcs > 0){
              
           
                   $comp_cs=number_format($subtotalcompcs,$_SESSION['be_decimal']);
               $bilno= array(
					new bilno('Complimentary -  ',number_format($subtotalcompcs,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
        }
        if($sms_show_onoff[9]=='Y'){
           if($totalcashhd > 0||$subtotalcredithd > 0||$subtotalvoucherhd > 0||$subtotalcouponhd > 0||$subtotalcouponhd > 0||$subtotalchequehd > 0||$subtotalcphd > 0||$subtotalcomphd > 0){
              
              
           $bilno= array(
					new bilno('',''),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                       $return.='<br /><strong style="color:#000;font-size:16px;">Home Delivery</strong><br />';
           }
             $cash_hd="0";
              if($totalcashhd > 0){
           
                   $cash_hd=number_format($totalcashhd,$_SESSION['be_decimal']);
               $bilno= array(
					new bilno('Cash -  ',number_format($totalcashhd,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
              $card_hd="0";
           if($subtotalcredithd > 0){
            
                   $card_hd=number_format($subtotalcredithd,$_SESSION['be_decimal']);
            
              $bilno= array(
					new bilno('Card -  ',number_format($subtotalcredithd,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
           
           if($subtotalvoucherhd > 0){
              
            
               $bilno= array(
					new bilno('Voucher -  ',number_format($subtotalvoucherhd,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
           if($subtotalcouponhd > 0){
              
             
              $bilno= array(
					new bilno('Coupons -  ',number_format($subtotalcouponhd,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                         $return.="<br />";
           }
           if($subtotalchequehd > 0){
              
             
              $bilno= array(
					new bilno('Cheque -  ',number_format($subtotalchequehd,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
            $credit_hd="0";
           if($subtotalcphd > 0){
              
           
                   $credit_hd=number_format($subtotalcphd,$_SESSION['be_decimal']);
               $bilno= array(
					new bilno('Credits -  ',number_format($subtotalcphd,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                         $return.="<br />";
           }
             $comp_hd="0";
           if($subtotalcomphd > 0){
              
           
                   $comp_hd=number_format($subtotalcomphd,$_SESSION['be_decimal']);
              $bilno= array(
					new bilno('Complimentary -  ',number_format($subtotalcomphd,$_SESSION['be_decimal'])),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
           }
        }   
          //-------------------------
        if (!in_array("Y", $sms_show_onoff))
        {
            
            
            
             $bilno= array(
					new bilno(' <br /> No data to show !!! Please check dayclose report  settings in reports  ',''),
                                            );
                                        foreach($bilno as $bilno) {
					$return .=$left.($bilno);
                                            }
                                         
                                        $return.="<br />";
        } 
                 
	      
		// $return.="----------------------------------------------------------------------";                
                                $return.="\r\n";
	
		
            
              $folder = '..\util\Timely_Email/';
if (!is_dir($folder))
mkdir($folder, 0777, true);
chmod($folder, 0777);

$date = date('m-d-Y-H-i-s', time()); 


$filename =$folder."Report ".$_SESSION['date'];

$handle = fopen($filename.'.txt','w+');
fwrite($handle,$return);
fclose($handle);


$msg_temp='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report Mailer</title>
<style>
@media (max-width: 500px) {

}
</style>
</head>

<body style="background-color:#fff;margin:0;padding:0; text-align: center;">

<div style="height:auto;margin:auto;width:800px;display:inline-block;border:solid 1px #e2e2e2; margin-top: 20px;background-color:#f5f5f5">

<span style="width:770px;float:left;color:#908e8e;font-size:14px;margin-bottom:0px;margin-top:5px;text-align:left;padding:15px;font-family: sans-serif;line-height:22px;"> 
  <strong style="color:#333;margin-bottom: 4px;float: left; width: 100%">Dear Customer,</strong><br>
     We are happy to serve you with our automated e-report facility of Timely sales summary of your outlet. 
 
</span>


	<div style="width:800px;height:auto;min-height:80px;float:left;background-color:#fff;box-shadow:0px 0px 15px #666;border-bottom:3px solid #ed1e26;">
    	 <div style="width:270px;height:auto;float:left;margin:10px 5px 0 0;">
         	<a href="#"><img src="https://www.expodine.com/images/logo.png" /></a>
         </div>
         <div style="width:300px;height:auto;float:right;margin:10px 0 0 5px;text-align:right">
         <span  style="color: #666; text-align: center; float: left;width: 100%;padding-top: 24px;">Branch</span>
         	<a href="#" style="color: #313131;font-size: 17px;padding-top: 0px;display: inline-block;padding-right: 10px;text-decoration: none; text-transform: uppercase;    width: 100%; text-align: center;font-family: sans-serif;">'.$branchname.'</a>
     <!-- <span  style="color: #666; text-align: center; float: left;width: 100%;padding-top: 2px;">'.$addr.'</span>       -->
</div>
    </div>	
    


  <div style="width:800px;height:auto;float:left;text-align:center;padding:2% 0;font-family:Arial, Helvetica, sans-serif;padding-top:3%;">
  
  

    	<span style="width:800px;float:left;color:rgb(82, 82, 82);font-size:17px;margin-bottom:5px;"> TIMELY EMAIL REPORT </span>
        <strong style="color:#464646;font-size:18px;">'.$smstext1.'</span></strong>
 </div>
 
 <div style="width:800px;height:auto;float:left;padding:2% 0;">
 
 	<div class="left" style="width:800px;height:auto;float:left;">
    
        
        <div style="width:255px;height:90px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;padding-top:30px;margin:8px 0 0 0">
        	<span style="color:#727272;font-size:14px;line-height:26px;">TOTAL [ Excl Tax ]</span><br />
            <strong style="color:#222222;font-size:20px;">'.$tot_exc.' </strong>
        </div>
        
        <div style="width:255px;height:90px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;padding-top:30px;margin:8px 0 0 2%">
        	<span style="color:#727272;font-size:14px;line-height:26px;">TOTAL SALE</span><br />
            <strong style="color:#222222;font-size:20px;">'.$tot_fin.'</strong>
        </div>
        
        <div style="width:255px;height:90px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;padding-top:30px;margin:8px 0 0 2%">
        	<span style="color:#727272;font-size:14px;line-height:26px;">TOTAL KOT  </span><br />
            <strong style="color:#222222;font-size:20px;">'.$tot_kot_sale.'</strong>
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
            	<th style="background-color:#4d5360;padding:3% 0;color:#fff;font-size:16px;width: 25%" width="25">Dine In</th>
                <th style="background-color:#d38a32;padding:3% 0;color:#fff;font-size:16px;width: 25%" width="25">Take Away</th>
                <th style="background-color:#46bfbd;padding:3% 0;color:#fff;font-size:16px;width: 25%" width="25">Counter Sale</th>
                <th style="background-color:#536b33;padding:3% 0;color:#fff;font-size:16px;width: 25%" width="25">Home Delivery</th>
            </tr>
        </thead>
        <tbody>
        
        	<tr>
            	<td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#ffffff" width="25">
                	<span style="font-size:17px;color:#949494;">Cash</span><br />
                    <strong style="font-size:20px;color:#515151;">'.$cash_di.'</strong>
                </td>
                <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#f5f5f5" width="25">
                	<span style="font-size:17px;color:#949494;">Cash</span><br />
                    <strong style="font-size:20px;color:#515151;">'.$cash_ta.'</strong>
                </td>
                <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#eeeeee" width="25">
                	<span style="font-size:17px;color:#949494;">Cash</span><br />
                    <strong style="font-size:20px;color:#515151;">'.$cash_cs.'</strong>
                </td>
                <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#f5f5f5" width="25">
                        <span style="font-size:17px;color:#949494;">Cash</span><br />
                        <strong style="font-size:20px;color:#515151;">'.$cash_hd.'</strong>
                    </td>
            </tr>

            <tr>
                    <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#ffffff" width="25">
                        <span style="font-size:17px;color:#6b6b6b;">Card  </span><br />
                        <strong style="font-size:20px;color:#515151;">'.$card_di.'</strong>
                    </td>
                    <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#f5f5f5" width="25">
                        <span style="font-size:17px;color:#6b6b6b;">Card </span><br />
                        <strong style="font-size:20px;color:#515151;">'.$card_ta.'</strong>
                    </td>
                    <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#eeeeee" width="25">
                        <span style="font-size:17px;color:#6b6b6b;">Card </span><br />
                        <strong style="font-size:20px;color:#515151;">'.$card_cs.'</strong>
                    </td>
                    <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#f5f5f5" width="25">
                            <span style="font-size:17px;color:#6b6b6b;">Card </span><br />
                            <strong style="font-size:20px;color:#515151;">'.$card_hd.'</strong>
                        </td>
                </tr>
           
            <tr>
                    <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#ffffff" width="25">
                        <span style="font-size:17px;color:#6b6b6b;">Credit  </span><br />
                        <strong style="font-size:20px;color:#515151;">'.$credit_di.'</strong>
                    </td>
                    <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#f5f5f5" width="25">
                        <span style="font-size:17px;color:#6b6b6b;">Credit </span><br />
                        <strong style="font-size:20px;color:#515151;">'.$credit_ta.'</strong>
                    </td>
                    <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#eeeeee" width="25">
                        <span style="font-size:17px;color:#6b6b6b;">Credit </span><br />
                        <strong style="font-size:20px;color:#515151;">'.$credit_cs.'</strong>
                    </td>
                    <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#f5f5f5" width="25">
                            <span style="font-size:17px;color:#6b6b6b;">Credit </span><br />
                            <strong style="font-size:20px;color:#515151;">'.$credit_hd.'</strong>
                        </td>
                </tr>
            
<tr>
                    <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#ffffff" width="25">
                        <span style="font-size:17px;color:#6b6b6b;">Complimentary  </span><br />
                        <strong style="font-size:20px;color:#515151;">'.$comp_di.'</strong>
                    </td>
                    <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#f5f5f5" width="25">
                        <span style="font-size:17px;color:#6b6b6b;">Complimentary </span><br />
                        <strong style="font-size:20px;color:#515151;">'.$comp_ta.'</strong>
                    </td>
                    <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#eeeeee" width="25">
                        <span style="font-size:17px;color:#6b6b6b;">Complimentary </span><br />
                        <strong style="font-size:20px;color:#515151;">'.$comp_cs.'</strong>
                    </td>
                    <td style="padding:2%;text-align:center;border-right:1px #e5e5e5 solid;border-bottom:1px #e5e5e5 solid;background-color:#f5f5f5" width="25">
                            <span style="font-size:17px;color:#6b6b6b;">Complimentary </span><br />
                            <strong style="font-size:20px;color:#515151;">'.$comp_hd.'</strong>
                        </td>
                </tr>
                
        </tbody>
    </table>
    
    <div style="width:800px;height:auto;float:left;margin-top:2%;">
    	
        <div style="width:396px;height:140px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;">
        	<div style="width:396px;height:40px;border-bottom:1px #ccc solid;line-height: 42px;">DETAILS</div>
            <table width="396px" border="0" style="line-height:22px;font-size:13px;color: #666;padding: 5px;">
              <tr>
                <th style="text-align:left;">Total Bill</th>
                <td width="50%" style="text-align:left;">'.$tot_bill_amt.'</td>
              </tr>
              <tr>
                <th style="text-align:left;">Bill Cancel</th>
                <td style="text-align:left;" width="20%">'.$tot_bill_amt_cancel.'</td>
            </tr>
            <tr>
                <th style="text-align:left;">Total Pax</th>
                <td width="30%" style="text-align:left;"> '.$tot_pax_di.'</td>
              </tr>
              
    </table>

        </div>
        <div style="width:396px;height:140px;float:left;background-color:#fff;box-shadow:2px 5px 10px #ccc;text-align:center;font-family:Arial, Helvetica, sans-serif;margin-left:1%;">
        	<div style="width:396px;height:40px;border-bottom:1px #ccc solid;line-height: 42px;">STEWARDS</div>
            <table width="396px" border="0" style="line-height:22px;font-size:13px;color: #666;padding: 5px;">
                    '.$stw_div.'
                     
                    
          </table>
        </div>
        
    </div>
    
    <div style="width:800px;height:360px;float:left;margin-top:2%;background-color:#fff;box-shadow:2px 5px 10px #ccc;display:none">
    	<div style="width:800px;height:45px;line-height: 45px;font-size:17px;padding-left:20px;font-family:Arial, Helvetica, sans-serif">SALES REPORT</div>
        <div style="width:800px;height:320px;float:left;text-align:center"><img width="100%" src="" /></div>
    </div>
    
     <div style="width:780px;height:auto;float:left;margin-top:12px;background-color: #333;padding:0 10px">
     	<p style="font-family:Arial, Helvetica, sans-serif;color:#a5a5a5;line-height:25px;margin-bottom: 2px;text-align:center;  margin-top: 7px">
        
        E : <a style="color:#a5a5a5;text-decoration:none" target="_blank" href="mailto:info@expodine.com">info@expodine.com </a> |
         W : <a style="color:#a5a5a5;;text-decoration:none" target="_blank" href="http://www.expodine.com/"> www.expodine.com</a> |
         T : +91 9895 31 3434
       <span style="width:780px;height:auto;float:left;padding-bottom: 7px;"> © Expodine. All right reserved</span>
	</p>
        
     </div>
    
    
    
 </div>
    
</div>


</body>
</html>
';




$sql_sms1 =  $database->mysqlQuery("Select be_reportemail_list,be_branchname from tbl_branchmaster"); 
		  $num_sms1  = $database->mysqlNumRows($sql_sms1);
		  if($num_sms1)
		  {
		         while($result_sms1  = $database->mysqlFetchArray($sql_sms1)) 
					{
                                  $allmail=$result_sms1['be_reportemail_list'];
                                  
                                   $branchname=$result_branch['be_branchname'];
                                  
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
        $mail->Subject =$branchname."  - Timely Email Report ".$_SESSION['date'];
        $mail->Body = $msg_temp;
        $mail->addAttachment($filename.'.txt');
        $mail->addBCC('info@expodine.com');
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
            
            $subject = $branchname." - TIMELY SALES REPORT-".$_SESSION['date'];
            //$message = $msg_temp; 

            if(mail($mailto,$subject,$nmessage, $header)) {
                
                echo "Success";
                
            } else {
                
                echo "Error";
            }  
            
    ///apache mail end ////
             
    } else {
        
          echo 'Message sent.';
          
    }           
	
    }
        
        
    } }	
    
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
        $leftCols =5;
	$leftCols2 =20;
        $rightCols =15;
	$rightCols1 =15;
        $rightCols2 =15;
		
		
		
                $left = str_pad($this -> slno, $leftCols,' ', STR_PAD_BOTH) ;
		$left2 = str_pad($this -> product, $leftCols2,' ', STR_PAD_RIGHT) ;
                $right = str_pad($this -> qty, $rightCols,' ', STR_PAD_BOTH) ;
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
        $leftCols =20;
	$leftCols2 =10;
        $rightCols =15;
	
		
		
		
                $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left2 = str_pad($this -> qty, $leftCols2,' ', STR_PAD_RIGHT) ;
                $right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		
        return "$left$left2$right\n";
    }
}
?>
