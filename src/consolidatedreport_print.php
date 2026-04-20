<?php

session_start();
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
    $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME_REPORT);
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


date_default_timezone_set("Asia/Kolkata");

            $printer_style='';
            $sql_kots1="Select distinct(pr_printerip),pr_printerport,pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_style "
            . " From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
            $sql_kotss1  =  mysqli_query($con,$sql_kots1); 
            $num_kots1  = mysqli_num_rows($sql_kotss1);
            if($num_kots1){	
                $result_kots1  = mysqli_fetch_array($sql_kotss1);
		$printer_style=$result_kots1['pr_style'];
            }




        $branchname='';
        $sql_branch =  $database->mysqlQuery("Select be_branchname,be_address,be_email,be_phone,be_others1,be_others2,be_others3,be_footer1,"
        . "be_footer2,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
		  $num_branch  = $database->mysqlNumRows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = $database->mysqlFetchArray($sql_branch)) 
					{
					   $branchname=$result_branch['be_branchname'];
                                             
					}
		  }

//printer setup
if($_SESSION['s_printst']=="Y") 
{    
    
    
    
        $printer_kotip_bill=array();
	$printer_kotport_bill=array(); 
	$bill_ok=0;
	$bill_sorry=1;
	$sql_kots="Select pr_defaultusb,pr_printerip,pr_printerport,pr_printername From tbl_printersettings  Where "
        . " pr_branchid ='1' and pr_printertype= '3' and  pr_enable='Y' group by pr_printerip ";
        $sql_kotss  =  mysqli_query($con,$sql_kots); 
	$num_kots  = mysqli_num_rows($sql_kotss);
	if($num_kots)
	{	
	while($result_kots  = mysqli_fetch_array($sql_kotss)) 
        {
                $printer_kotname_bill[]=$result_kots['pr_printername'];
                $printer_kotip_bill[]=$result_kots['pr_printerip'];
                $printer_kotport_bill[]=$result_kots['pr_printerport'];
                $printer_kotusb_bill[]=$result_kots['pr_defaultusb'];
        }
        foreach ($printer_kotport_bill as $key=>$port)
        {
             if($printer_kotusb_bill[$key]=='N'){
          if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            exec("ping -n 1 -w 1 ".$printer_kotip_bill[$key], $output, $result);               


          } else if (strtoupper(substr(PHP_OS, 0, 3)) === 'LIN')
                {
              
                  exec("ping -c 1 -w 1 ".$printer_kotip_bill[$key], $output, $result);

                }

             }else{
                 $result=0;
             }
             
             
                                
if ($result == 0){
    
       
    
 //////////REPORTS STARTING///////////////////////   
    
    
if(($_REQUEST['type']=="sales_summary_report_cr"))
  {


                $print="";
                $from='';
                $to='';
                $string="";
                $stringstat=" tab_complimentary!='Y'  AND ";
                $stringstatdi=" bm_complimentary!='Y' AND ";
                $stringta="";
                $stringcs="";
                $stringhd="";
                $stringtacshd='';
                $reporthead="";
                $stringtax='';
                $string .=" bm_status='Closed' AND ";
                $stringtacshd .=" tab_status='Closed' AND ";
                $stringta .=" tab_status='Closed' AND tab_mode='TA'  AND ";
                $stringcs .=" tab_status='Closed' AND tab_mode='CS'  AND ";
                $stringhd .=" tab_status='Closed' AND tab_mode='HD'  AND ";
                $stringtax .=" tab_status='Closed'  AND ";
                $string_pax="";
                $string_pax=" bm_status='Closed' AND ";
                       if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                $string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";

                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=date("Y-m-d");
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                        $string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) "; 

                                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";

                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        }




                else {
                        $bydatz=$_REQUEST['bydate'];
                        $st='';

                if($bydatz!="null" && $bydatz!="")
                {


                if($bydatz=="Last5days")
                {

                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        //$st= " Last 5 days ";
                        
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                        
                        
                        $string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                }elseif($bydatz=="Last10days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";

                        $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        //$st= " Last 10 days ";
                        
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                        
                }
                elseif($bydatz=="Last15days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";

                        $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $st= " Last 15 days ";
                }
                else if($bydatz=="Last20days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";

                        $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $st= " Last 20 days ";
                }
                else if($bydatz=="Last25days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";

                        $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $st= " Last 25 days ";
                }
                else if($bydatz=="Last30days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                       $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";

                        $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $st= " Last 30 days ";
                }
                else if($bydatz=="Today")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                        $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        //$st= " Today ";
                         $st .= date("Y-m-d");
                }
                else if($bydatz=="Yesterday")
                {
                        $string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 DAY";
                        $stringtacshd.=" tab_dayclosedate = CURDATE() - INTERVAL 1 DAY";
                        $stringta.=" tab_dayclosedate =CURDATE( ) - INTERVAL 1 DAY";
                        $stringcs.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY";
                        $stringhd.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY";
                        $stringtax.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY";

                        $string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 DAY";
                        //$st= " Yesterday ";
                         $st .= date("Y-m-d", strtotime("-1 day"));
                }
                else if($bydatz=="Last1month")
                {
                        $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $stringtacshd.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";

                        $string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                        $st= " Last 1 month ";
                }
                else if($bydatz=="Last90days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";

                        $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $st= " Last 3 months ";
                }
                else if($bydatz=="Last180days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $st= " Last 6 months "; 
                }
                else if($bydatz=="Last365days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $st= " Last 1 year "; 



                }
        $reporthead=$st;
                }
                else
                {


                        $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                              $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                               $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                              $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                              $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                                        $string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
                }
                }


                $servicetax_stats='N';
                 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
                  $num_login   = $database->mysqlNumRows($sql_login);
                  if($num_login){
                         $servicetax_stats='Y';
                  }



                        $flg=0;




                        //branch details
                        $footer4 = "";
                        $branchname="";
                        $branchaddress="";
                        $branchemail="";
                        $branchphone = "";
                        $sql_branch  =  $database->mysqlQuery("Select be_branchname,be_address,be_email,be_phone,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
                          $num_branch  = mysqli_num_rows($sql_branch);
                          if($num_branch)
                          {
                        while($result_branch  = mysqli_fetch_array($sql_branch)) 
                                {
                                 $branchname=$result_branch['be_branchname'];
                                 $branchaddress=$result_branch['be_address'];
                                 $branchemail=$result_branch['be_email'];
                                 $branchphone=$result_branch['be_phone'];
                                 $footer3=$result_branch['be_footer3'];
                                 $footer4=$result_branch['be_footer4'];		
                                }
                          }

                          $cur=date("Y-m-d");
                          if($printer_style=='1'){
                          $vv=str_pad("-",  '46', "-");//46

                          }
                          else if($printer_style=='2'){
                               $vv=str_pad("-",  '42', "-");
                          }
                          //$print .= $left.$vv."\n";//ojin
                            $print .= $center."Date:".date('d-m-Y')."\n";
                            $print .="\n";
                            $print .= $center.$bold_on."BRANCH: ".$branchname.$bold_off."\n";


                                        if($from=='' && $to=='')
                                        {
                                                $print .= $center.$reporthead."\n";
                                        }
                                        else
                                        {
                                        $print .= $center."Report\n";
                                        $print .= $center."From ".$database->convert_date($from)."\n";
                                        $print .= $center."To ".$database->convert_date($to)."\n";
                                        }



                                       $print .="\n";

                                        $print .= $left.$vv."\n";//ojin

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
           
          $sql_login  =  $database->mysqlQuery("select sum(bm_taxable_amount) as uae_subtotal,sum(bm_finaltotal) as tot,sum(bm_tax_exempt) as taxexempt, (sum(bm_subtotal)-(sum(bm_discountvalue)+sum(bm_redeem_amount))) as totexcl,sum(bm_roundoff_value) as totroundof FROM tbl_tablebillmaster left join tbl_floormaster tf on tf.fr_floorid=bm_floorid where  $stringstatdi $string"); 
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
              $sql_loginta  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal,sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-(sum(tab_discountvalue)+sum(tab_redeem_amount))) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringta"); 
                                           

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

                  $sql_logincs  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal, sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-(sum(tab_discountvalue)+sum(tab_redeem_amount))) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringcs");                                             
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

                  $sql_loginhd  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal,sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-(sum(tab_discountvalue)+sum(tab_redeem_amount))) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringhd");                                                   
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
                  $sql_logintax_ta  =  $database->mysqlQuery("select tbm.tab_mode,tketm.tbe_taxid,sum(tketm.tbe_total_value) AS sum_tax,tketm.tbe_label  FROM tbl_takeaway_bill_extra_tax_master tketm
                                        left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tketm.tbe_billno where  $stringstat  $stringtax group by tbm.tab_mode,tketm.tbe_taxid"); 
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
                    $ta_tax_valueta=0;
                    $ta_tax_valucs=0;
                    $ta_tax_valuehd=0;
                    $di_tax_sum=0;
                    $ta_tax_valueta=0;
                    $ta_tax_valuecs=0;
                    $ta_tax_valuehd=0;
                    $sql_login5  =  $database->mysqlQuery("select tetm.bem_taxid,sum(tetm.bem_total_value) as tax_sum,tetm.bem_label  FROM tbl_tablebill_extra_tax_master tetm 
                                                           left join tbl_tablebillmaster bm on bm.bm_billno=tetm.bem_billno
                                                           where  $stringstatdi $string group by tetm.bem_taxid "); 
                    
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
                                    new bilno("Take Away Excl.Tax",number_format($uae_subtotal_ta,$_SESSION['be_decimal']),$printer_style),
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
                                if (array_key_exists("TA",$ta_tax_value)){
                                    for($s=0;$s<count($ta_tax_value['TA']['label']);$s++){
                                        $ta_tax_valueta=$ta_tax_valueta+$ta_tax_value['TA']['value'][$s];
                                         $bilno= array(
                                         new bilno("Take Away   ".$ta_tax_value['TA']['label'][$s],number_format($ta_tax_value['TA']['value'][$s],$_SESSION['be_decimal']),$printer_style),
                                         );
                                         foreach($bilno as $bilno) {
                                             $print .=$left.($bilno);
                                         }
                                    }
                                }

                                $print .="\n";

                                if($salesexcltaxcs!=0){
                                    
                                    if($_SESSION['uae_tax_enable']=='Y'){
                                        
                                        $bilno= array(
                                    new bilno("Counter Sale Excl.Tax",number_format($uae_subtotal_cs,$_SESSION['be_decimal']),$printer_style),
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
                                if (array_key_exists("CS",$ta_tax_value)){
                                    for($s=0;$s<count($ta_tax_value['CS']['label']);$s++){
                                        $ta_tax_valuecs=$ta_tax_valuecs+$ta_tax_value['CS']['value'][$s];
                                       $bilno= array(
                                       new bilno("Counter Sale   ".$ta_tax_value['CS']['label'][$s],number_format($ta_tax_value['CS']['value'][$s],$_SESSION['be_decimal']),$printer_style),
                                       );
                                       foreach($bilno as $bilno) {
                                           $print .=$left.($bilno);
                                       }
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
                                if (array_key_exists("HD",$ta_tax_value)){
                                    for($s=0;$s<count($ta_tax_value['HD']['label']);$s++){
                                        $ta_tax_valuehd=$ta_tax_valuehd+$ta_tax_value['HD']['value'][$s];
                                        $bilno= array(
                                        new bilno("Home Delivery   ".$ta_tax_value['HD']['label'][$s],number_format($ta_tax_value['HD']['value'][$s],$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                            $print .=$left.($bilno);
                                        }
                                    }
                                }
                                $print .= $left.$vv."\n";
                                    //$print .= $center.$bold_on."TAX SUMMARY".$bold_off."\n";
                                
                                if($totroundofff>0){
                                    $bilno= array(
                                    new bilno("Round Off",number_format($totroundofff,$_SESSION['be_decimal']),$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                    
              
                                    $print .= $left.$vv."\n";
                                }
                                 
                    $del=0; 
 
$sql_login  =  $database->mysqlQuery("select tab_delivery_charge from tbl_takeaway_billmaster  where $stringhd and tab_complimentary!='Y' "); 
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
                                    
           }else{
                                    $bilno= array(
                                    new bilno("Sale Inc.Tax",number_format(str_replace(',','',$salesexcltaxdi+$salesexcltaxta+$salesexcltaxcs+$salesexcltaxhd+$ta_tax_valueta+$ta_tax_valuecs+$ta_tax_valuehd+$di_tax_sum+$totroundofff+$del),$_SESSION['be_decimal']),$printer_style),
                                    );
                                    
           }                   
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                    
                                        $print .= $left.$vv."\n";
                                        
                                        
                                    $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                        
                                        //footer end
                                        $print .="\n\n\n\n\n";
                                        $print.=$cutpaper;

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

                  
                  
 else if(($_REQUEST['type']=="consolidated_timely_report"))
{
     	
        
	$string="";
        $stringta="";
	
        $reporthead="";
        $st="";
        $from="";
        
        $stringmodeta="";
        
        
        $from=$database->convert_date($_REQUEST['fromdt']);
        
        $string.= " bm.bm_dayclosedate = '".$from."'  ";
        $stringta.= " tbm.tab_dayclosedate = '".$from."' ";
         
	$print .= $center.$bold_on.$branchname.$bold_off."\n";
                          $print .= $center.$bold_on." Hourly Report ".$bold_off."\n";
                                        if($from=='' && $to=='')
                                        {
                                                $print .= $center.$bold_on.$st.$bold_off."\n";
                                        }
                                        else
                                        {
                                        $print .= $center.$bold_on.$database->convert_date($from).$bold_off."\n";
                                        }

                                        if($printer_style=='1'){
                                            $vv=str_pad("-",  '46', "-");//46

                                            }
                                            else if($printer_style=='2'){
                                                 $vv=str_pad("-",  '42', "-");
                                            }
                                        $print .= $left.$vv."\n";//ojin
                                        $bilno= array(
                                                new hourly("Sl","Hour Between","Final",$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bold_on.$bilno.$bold_off);
                                        }
                                        $print .= $left.$vv."\n";//ojin
                                        $final=0;$i=1;



$final=0;

$p=0;
  $sql_logincashier  =  $database->mysqlQuery("select sum(x.total) as total, x.hour1 as hour1 from( 
                                                    select  SUM(bm.bm_finaltotal) AS total, HOUR(bm.bm_billtime ) as hour1 FROM tbl_tablebillmaster bm
                                                    where $string and bm.bm_status='Closed' and bm.bm_complimentary!='Y' group by HOUR(bm.bm_billtime ) union all
                                                    SELECT  SUM(tbm.tab_netamt) as total, HOUR(tbm.tab_time) as hour1  FROM tbl_takeaway_billmaster tbm
                                                    WHERE $stringta and tbm.tab_status='Closed' and tbm.tab_complimentary!='Y' group by HOUR(tbm.tab_time)
                                                    )x group by  x.hour1"); 


  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                                $final=$final+$result_hourly_wise['total'];
                                $time1=date('h',strtotime($result_hourly_wise['hour1'].':0:0'));
                                $time2=$result_hourly_wise['hour1']+1;
                                $time2=date('h a',strtotime($time2.':0:0'));
          
          $bilno= array(
                                                        new hourly($p,$time1.'-'.$time2,number_format($result_hourly_wise['total'],$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                }
                         
           
     
        }}
        $print .= $left.$vv."\n";
        $bilno= array(
                                                        new hourly("Total","",number_format($final,$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                }
                     $print .= $left.$vv."\n";

                     
                     
                     $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                     
                                        $print .="\n\n\n\n\n";
                                        $print.=$cutpaper;


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
                  
                  
                  
         else if(($_REQUEST['type']=="credit_summary_client"))
{   
     	
        $string="";
       
	$creditsataff='';
        
        if($_REQUEST['creditstaff']!=''){
	$creditstaff= " and  cm.crd_type ='".$_REQUEST['creditstaff']."' ";
        }
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " cd.cd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " cd.cd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  cd.cd_dayclosedate between '".$from."' and '".$to."' ";
                       $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}

	
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		$st='';
		
		
	if($bydatz!=null && $bydatz!="")
	{
		
	
	if($bydatz=="Last5days")
	{
          
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                
		//$st= " Last 5 days ";
                
                $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
		
	}elseif($bydatz=="Last10days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
               
		//$st= " Last 10 days ";
                
                $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
               
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
               
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
               
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                
		//$st= " Today ";
                
                 $st .= date("Y-m-d");
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" cd.cd_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                
		//$st= " Yesterday ";
                 $st .= date("Y-m-d", strtotime("-1 day"));
	}
	else if($bydatz=="Last1month")
	{
		$string.="  cd.cd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= " cd.cd_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			
	}
	
	}
        $credit_amount=0;
        $credit_amount1=0;
        $received_amount=0;
        $received_amount1=0;
        $creditperson='';
        $settled_status='';
        $billamount=0;
        $balance1=0;
        $balance=0;
        $remark='';
        //$received_amount=array();
       
        
        $print .= $center.$bold_on.$branchname.$bold_off."\n";
                          $print .= $center.$bold_on." Credit Report ".$bold_off."\n";
                                        if($from=='' && $to=='')
                                        {
                                                $print .= $center.$bold_on.$st.$bold_off."\n";
                                        }
                                        else
                                        {
                                        $print .= $center.$bold_on.$database->convert_date($from).$bold_off."\n";
                                        }

                                        if($printer_style=='1'){
                                            $vv=str_pad("-",  '46', "-");

                                            }
                                            else if($printer_style=='2'){
                                                 $vv=str_pad("-",  '42', "-");
                                            }
                                        $print .= $left.$vv."\n";
                                        
                                        
        $bilno= array(
                                 new tip('Type','Party','Number','Credit',$printer_style),
                                 );
                                 foreach($bilno as $bilno) {
                                     $print .=$left.($bilno);
                                    // $print .= $left."\n";//ojin
                                 }
        
        $print .= $left.$vv."\n";
        
	$sql_login  =  $database->mysqlQuery("select cm.crd_totalamount,cd.cd_billno,ct.ct_credit_type,sm.ser_firstname as staff,lr.ly_mobileno,lr.ly_firstname as guest,"
                . "c.ct_corporatename as company,sum(tb.bm_finaltotal) as dine_bill_total, sum(tbm.tab_netamt) as ta_bill_total,sum(cd.cd_amount) as credit,"
                . "cd.cd_settled from tbl_credit_details cd left join tbl_credit_master cm on cd_masterid =crd_id left join tbl_staffmaster"
                . " sm on ser_staffid=crd_staffid left join tbl_corporatemaster c on ct_corporatecode=crd_corporateid left join tbl_loyalty_reg lr "
                . "on ly_id=crd_guestid left join tbl_credit_types ct on ct.ct_creditid=cm.crd_type left join tbl_tablebillmaster tb on bm_billno =cd_billno left join"
                . " tbl_takeaway_billmaster tbm on tab_billno=cd_billno where cd.cd_settled='N' and "
                . " $string $creditstaff group by guest,company,staff,lr.ly_mobileno  order by ct_credit_type,guest,company,staff,lr.ly_mobileno asc  " ); 

        
        
    
        $num_login   = $database->mysqlNumRows($sql_login); 
    if($num_login){$i=0;$credit_amount=0;$received_amount=0;$crd_all=0; $bal_all=0;$rec_all=0;
        while($result_login=$database->mysqlFetchArray($sql_login))
        {   $i++;
          
            
           
            $credit_amount=$result_login['credit'];
           
            
            
            if($result_login['staff']!=''){
             $creditperson=$result_login['staff'];   
            }
            else if($result_login['company']!=''){
             $creditperson=$result_login['company'];   
            }
            else if($result_login['guest']!=''){
             $creditperson=$result_login['guest'] ;   
            }
            
           
            
                
            $crd_all=$crd_all+$result_login['credit'];
            
            
            $bal_all=$bal_all+$result_login['crd_totalamount'];
            
            
            $rec_all=$rec_all+($result_login['credit']-$result_login['crd_totalamount']);
          
            
            
            $bilno= array(
                                 new tip($result_login['ct_credit_type'],substr($creditperson,0,10),$result_login['ly_mobileno'],number_format($credit_amount,$_SESSION['be_decimal']),$printer_style),
                                 );
                                 foreach($bilno as $bilno) {
                                     $print .=$left.($bilno);
                                    // $print .= $left."\n";//ojin
                                 }
        
       
            
       
        }
        
         $print .= $left.$vv."\n";
        $bilno= array(
                                 new tip('Total','','',number_format($crd_all,$_SESSION['be_decimal']),$printer_style),
                                 );
                                 foreach($bilno as $bilno) {
                                     $print .=$left.($bilno);
                                     //$print .= $left."\n";//ojin
                                 }
        
        $print .= $left.$vv."\n";
        
        $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                    
                                    
                             $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }       
                                    
        $print .="\n\n\n\n\n";
                                        $print.=$cutpaper;


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
                  
else if(($_REQUEST['type']=="summary_specified_consolidated"))
 {     
    
                $string_expense="";
                $string_advance="";
                $string_loy="";
                $string="";
                $stringtax='';
                $stringstat=" tab_complimentary!='Y'  AND tab_payment_settled='Y' AND ";
                $stringstatdi=" bm_complimentary!='Y' AND ";
                $string_comp_ta="";
                $string_comp_di="";
                $string_credit_pay="";
               $string_comp_ta.=" tab_complimentary='Y'  AND tab_payment_settled='Y' AND tab_status!='Cancelled'  AND ";
                $string_comp_di.=" bm_complimentary='Y'  AND bm_status!='Cancelled'  AND ";
                $stringta="";
                $stringcs="";
                $stringhd="";
                $string_itemcancel_di="";
                $string_itemcancel_ta="";
                $stringtacshd='';
                $string_billcancel_di="";
                $string_billcancel_tacshd="";
                $reporthead="";
                $string .=" bm_status='Closed' AND ";
                $stringtacshd .=" tab_status='Closed' AND ";
                $stringta .=" tab_status='Closed' AND tab_mode='TA'  AND tab_payment_settled='Y' AND ";
                $stringcs .=" tab_status='Closed' AND tab_mode='CS'  AND tab_payment_settled='Y' AND ";
                $stringhd .=" tab_status='Closed' AND tab_mode='HD'  AND tab_payment_settled='Y' AND ";
                $stringtax .=" tab_status='Closed'  AND tab_payment_settled='Y' AND ";
                $string_pax="";
                $string_pax=" bm_status='Closed' AND ";
                $string_billcancel_di .=" bm_status='Cancelled' AND ";
                $string_billcancel_tacshd .=" tab_status='Cancelled' AND ";
                $string_loy.=" lob_redeem_amount!='' AND ";
                $string_itemcancel_di.=" ch_kot_cancel_id != '' AND ";
                $string_itemcancel_ta.=" tc_cancel_id !='' AND ";
                $string_credit_pay.=" cdp_dayclosedate !='' AND ";
                $string_expense.=" vp_type ='Expense' AND vp_status='Approved' AND ";
                   $string_advance.= " tp_dayclose !='' AND "  ;     
                   
                    $string_acc_exp= "  ";
                         $string_acc_sup= " ";
                         $string_acc_emp= " ";
                   
                        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                $string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                                $string_billcancel_di .=" bm_dayclosedate between '".$from."' and '".$to."' ";
                                $string_billcancel_tacshd .=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                  $string_itemcancel_di.=" ch_dayclosedate between '".$from."' and '".$to."' ";
                                  $string_itemcancel_ta.=" tc_dayclosedate between '".$from."' and '".$to."' ";
                                   $string_loy.=" DATE(lob_date) between '".$from."' and '".$to."' ";
                                   $string_comp_ta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                   $string_comp_di.=" bm_dayclosedate between '".$from."' and '".$to."' ";
                                   $string_credit_pay.=" cdp_dayclosedate between '".$from."' and '".$to."' ";
                                   $string_expense.=" vp_dayclose_date between '".$from."' and '".$to."' ";
                                    $string_advance.= " tp_dayclose between '".$from."' and '".$to."' ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                                
                                $string_acc_exp.= " ev_date between '".$from."' and '".$to."' ";
                         $string_acc_sup.= " sv_date between '".$from."' and '".$to."' ";
                         $string_acc_emp.= " ev_date between'".$from."' and '".$to."' ";
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=date("Y-m-d");
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                        $string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                                         $string_billcancel_di .=" bm_dayclosedate between '".$from."' and '".$to."' ";
                                $string_billcancel_tacshd .=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                 $string_itemcancel_di.=" ch_dayclosedate between '".$from."' and '".$to."' ";
                                  $string_itemcancel_ta.=" tc_dayclosedate between '".$from."' and '".$to."' ";
                                   $string_loy.=" DATE(lob_date) between '".$from."' and '".$to."' ";
                                   $string_comp_ta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                   $string_comp_di.=" bm_dayclosedate between '".$from."' and '".$to."' ";
                                    $string_credit_pay.=" cdp_dayclosedate between '".$from."' and '".$to."' ";
                                     $string_expense.=" vp_dayclose_date between '".$from."' and '".$to."' ";
                                      $string_advance.= " tp_dayclose between '".$from."' and '".$to."' ";
                                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                                        
                                        $string_acc_exp.= " ev_date between '".$from."' and '".$to."' ";
                         $string_acc_sup.= " sv_date between '".$from."' and '".$to."' ";
                         $string_acc_emp.= " ev_date between'".$from."' and '".$to."' ";
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                $string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                                 $string_billcancel_di.=" bm_dayclosedate between '".$from."' and '".$to."' ";
                                $string_billcancel_tacshd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                 $string_itemcancel_di.=" ch_dayclosedate between '".$from."' and '".$to."' ";
                                  $string_itemcancel_ta.=" tc_dayclosedate between '".$from."' and '".$to."' ";
                                   $string_loy.=" DATE(lob_date) between '".$from."' and '".$to."' ";
                                   $string_comp_ta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                   $string_comp_di.=" bm_dayclosedate between '".$from."' and '".$to."' ";
                                    $string_credit_pay.=" cdp_dayclosedate between '".$from."' and '".$to."' ";
                                     $string_expense.=" vp_dayclose_date between '".$from."' and '".$to."' ";
                                      $string_advance.= " tp_dayclose between '".$from."' and '".$to."' ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                                
                                $string_acc_exp.= " ev_date between '".$from."' and '".$to."' ";
                         $string_acc_sup.= " sv_date between '".$from."' and '".$to."' ";
                         $string_acc_emp.= " ev_date between'".$from."' and '".$to."' ";
                        }


                else 
                {
                        $bydatz=$_REQUEST['bydate'];
                        $st='';


                                if($bydatz!="null" && $bydatz!="")
                {


                if($bydatz=="Last5days")
                {

                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        //$st= " Last 5 days ";
                        
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                        
                        $string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                         $string_billcancel_di.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                        $string_billcancel_tacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                         $string_itemcancel_di.=" ch_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                  $string_itemcancel_ta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                   $string_loy.=" DATE(lob_date) between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                   $string_comp_ta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                   $string_comp_di.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                    $string_credit_pay.=" cdp_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                     $string_expense.=" vp_dayclose_date  between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                       $string_advance.= " tp_dayclose between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                       
                                       
                                        $string_acc_exp.= " ev_date between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";
                         $string_acc_sup.= " sv_date between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";
                         $string_acc_emp.= " ev_date between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";
                         
                }elseif($bydatz=="Last10days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $string_itemcancel_di.=" ch_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $string_itemcancel_ta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $string_billcancel_di.=" bm_dayclosedate between CURDATE( )  - INTERVAL 10 DAY AND CURDATE( )";
                        $string_billcancel_tacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $string_loy.=" DATE(lob_date) between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                        $string_comp_ta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                                   $string_comp_di.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                                   $string_credit_pay.=" cdp_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                                   $string_expense.=" vp_dayclose_date  between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                                   $string_advance.= " tp_dayclose between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                                     
                         $string_acc_exp.= " ev_date between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) ";
                         $string_acc_sup.= " sv_date between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) ";
                         $string_acc_emp.= " ev_date between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) ";
                         
                       // $st= " Last 10 days ";
                        
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                        
                }
                elseif($bydatz=="Last15days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                        $string_itemcancel_di.=" ch_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                                  $string_itemcancel_ta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                        $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $string_billcancel_di.=" bm_dayclosedate between CURDATE( )  - INTERVAL 15 DAY AND CURDATE( )";
                        $string_billcancel_tacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                         $string_loy.=" DATE(lob_date) between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                         $string_comp_ta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                                   $string_comp_di.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                                   $string_credit_pay.=" cdp_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                                   $string_expense.=" vp_dayclose_date  between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                                     $string_advance.= " tp_dayclose between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                                     
                                      $string_acc_exp.= " ev_date between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) ";
                         $string_acc_sup.= " sv_date between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) ";
                         $string_acc_emp.= " ev_date between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) ";
                         
                        $st= " Last 15 days ";
                }
                else if($bydatz=="Last20days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                        $string_billcancel_di.=" bm_dayclosedate between CURDATE( )  - INTERVAL 20 DAY AND CURDATE( )";
                        $string_billcancel_tacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $string_itemcancel_di.=" ch_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                                  $string_itemcancel_ta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                        $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                         $string_loy.=" DATE(lob_date) between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                         $string_comp_ta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                                   $string_comp_di.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                                   $string_credit_pay.=" cdp_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                                   $string_expense.=" vp_dayclose_date  between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                                     $string_advance.= " tp_dayclose between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                                     
                                      $string_acc_exp.= " ev_date between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) ";
                         $string_acc_sup.= " sv_date between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) ";
                         $string_acc_emp.= " ev_date between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) ";
                         
                        $st= " Last 20 days ";
                }
                else if($bydatz=="Last25days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                        $string_billcancel_di.=" bm_dayclosedate between CURDATE( )  - INTERVAL 25 DAY AND CURDATE( )";
                        $string_billcancel_tacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $string_itemcancel_di.=" ch_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                                  $string_itemcancel_ta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                                   $string_loy.=" DATE(lob_date) between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                                   $string_comp_ta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                                   $string_comp_di.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                                   $string_credit_pay.=" cdp_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                                   $string_expense.=" vp_dayclose_date  between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                                     $string_advance.= " tp_dayclose between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                        $st= " Last 25 days ";
                        
                         $string_acc_exp.= " ev_date between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ";
                         $string_acc_sup.= " sv_date between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ";
                         $string_acc_emp.= " ev_date between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ";
                         
                }
                else if($bydatz=="Last30days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                       $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                        $string_billcancel_di.=" bm_dayclosedate between CURDATE( )  - INTERVAL 30 DAY AND CURDATE( )";
                        $string_billcancel_tacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $string_itemcancel_di.=" ch_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                                  $string_itemcancel_ta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                                   $string_loy.=" DATE(lob_date) between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                                   $string_comp_ta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                                   $string_comp_di.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                                   $string_credit_pay.=" cdp_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                                   $string_expense.=" vp_dayclose_date  between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                                     $string_advance.= " tp_dayclose between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                        $st= " Last 30 days ";
                        
                         $string_acc_exp.= " ev_date between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";
                         $string_acc_sup.= " sv_date between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";
                         $string_acc_emp.= " ev_date between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";
                }
                else if($bydatz=="Today")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                        $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        $string_billcancel_di.=" bm_dayclosedate between CURDATE( )  - INTERVAL 0 DAY AND CURDATE( )";
                        $string_billcancel_tacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        $string_itemcancel_di.=" ch_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                                  $string_itemcancel_ta.=" tc_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                                   $string_loy.=" DATE(lob_date) between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                                   $string_comp_ta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                                   $string_comp_di.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                                   $string_credit_pay.=" cdp_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                                   $string_expense.=" vp_dayclose_date  between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                                     $string_advance.= " tp_dayclose between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                       // $st= " Today ";
                         $st .= date("Y-m-d");
                         $string_acc_exp.= " ev_date between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) ";
                         $string_acc_sup.= " sv_date between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) ";
                         $string_acc_emp.= " ev_date between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) ";

                }
                else if($bydatz=="Yesterday")
                {
                        $string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 DAY";
                        $stringtacshd.=" tab_dayclosedate = CURDATE() - INTERVAL 1 DAY";
                        $stringta.=" tab_dayclosedate =CURDATE( ) - INTERVAL 1 DAY";
                        $stringtax.=" tab_dayclosedate =CURDATE( ) - INTERVAL 1 DAY";
                        $stringcs.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY";
                        $stringhd.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY";

                        $string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 DAY";
                        $string_billcancel_di.=" bm_dayclosedate = CURDATE( )  - INTERVAL 1 DAY";
                        $string_billcancel_tacshd.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY";
                        $string_itemcancel_di.=" ch_dayclosedate = CURDATE( ) - INTERVAL 1  DAY ";
                        $string_itemcancel_ta.=" tc_dayclosedate = CURDATE( ) - INTERVAL 1  DAY ";
                        $string_loy.=" DATE(lob_date) = CURDATE( ) - INTERVAL 1  DAY ";
                        $string_comp_ta.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1  DAY ";
                         $string_comp_di.=" bm_dayclosedate = CURDATE( ) - INTERVAL 1 DAY";
                        $string_credit_pay.=" cdp_dayclosedate = CURDATE( ) - INTERVAL 1  DAY";
                        $string_expense.=" vp_dayclose_date = CURDATE( ) - INTERVAL 1  DAY";
                        $string_advance.= " tp_dayclose = CURDATE( ) - INTERVAL 1  DAY ";
                        //$st= " Yesterday ";
                         $st .= date("Y-m-d", strtotime("-1 day"));
                        
                         $string_acc_exp.= " ev_date  = CURDATE( ) - INTERVAL 1  DAY ";
                         $string_acc_sup.= " sv_date  = CURDATE( ) - INTERVAL 1  DAY ";
                         $string_acc_emp.= " ev_date  = CURDATE( ) - INTERVAL 1  DAY ";
                }
                else if($bydatz=="Last1month")
                {
                        $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $stringtacshd.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $string_billcancel_di.=" bm_dayclosedate between CURDATE( )  - INTERVAL 1 MONTH AND CURDATE( )";
                        $string_billcancel_tacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                        $string_itemcancel_di.=" ch_dayclosedate between CURDATE( ) - INTERVAL  1 MONTH  AND CURDATE( )";
                         $string_itemcancel_ta.=" tc_dayclosedate between CURDATE( ) - INTERVAL  1 MONTH  AND CURDATE( )";
                          $string_loy.=" DATE(lob_date) between CURDATE( ) - INTERVAL 1 month AND CURDATE( )";
                          $string_comp_ta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 month AND CURDATE( )";
                           $string_comp_di.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 month AND CURDATE( )";
                           $string_credit_pay.=" cdp_dayclosedate between CURDATE( ) - INTERVAL 1  month AND CURDATE( )";
                           $string_expense.=" vp_dayclose_date between CURDATE( ) - INTERVAL 1  month AND CURDATE( )";
                             $string_advance.= " tp_dayclose between CURDATE( ) - INTERVAL 1  month AND CURDATE( )";
                        $st= " Last 1 month ";
                        
                         $string_acc_exp.= " ev_date between CURDATE( ) - INTERVAL 1  month AND CURDATE( ) ";
                         $string_acc_sup.= " sv_date between CURDATE( ) - INTERVAL 1  month AND CURDATE( ) ";
                         $string_acc_emp.= " ev_date between CURDATE( ) - INTERVAL 1  month AND CURDATE( )";
                }
                else if($bydatz=="Last90days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                          $string_loy.=" DATE(lob_date) between CURDATE( ) - INTERVAL 3 month AND CURDATE( )";
                        $string_billcancel_di.=" bm_dayclosedate between CURDATE( )  - INTERVAL 3 MONTH AND CURDATE( )";
                        $string_billcancel_tacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $string_itemcancel_di.=" ch_dayclosedate between CURDATE( ) - INTERVAL  3 MONTH  AND CURDATE( )";
                         $string_itemcancel_ta.=" tc_dayclosedate between CURDATE( ) - INTERVAL  3 MONTH  AND CURDATE( )";
                        $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                         $string_comp_ta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 month AND CURDATE( )";
                           $string_comp_di.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 month AND CURDATE( )";
                           $string_credit_pay.=" cdp_dayclosedate between CURDATE( ) - INTERVAL 3  month AND CURDATE( )";
                           $string_expense.=" vp_dayclose_date  between CURDATE( ) - INTERVAL 3  month AND CURDATE( )";
                            $string_advance.= " tp_dayclose between CURDATE( ) - INTERVAL 3  month AND CURDATE( )";
                        $st= " Last 3 months ";
                        
                         $string_acc_exp.= " ev_date between CURDATE( ) - INTERVAL 3  month AND CURDATE( ) ";
                         $string_acc_sup.= " sv_date between CURDATE( ) - INTERVAL 3  month AND CURDATE( ) ";
                         $string_acc_emp.= " ev_date between CURDATE( ) - INTERVAL 3  month AND CURDATE( )";
                }
                else if($bydatz=="Last180days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                         $string_itemcancel_di.=" ch_dayclosedate between CURDATE( ) - INTERVAL  6 MONTH  AND CURDATE( )";
                         $string_itemcancel_ta.=" tc_dayclosedate between CURDATE( ) - INTERVAL  6 MONTH  AND CURDATE( )";
                        $string_billcancel_di.=" bm_dayclosedate between CURDATE( )  - INTERVAL 6 MONTH AND CURDATE( )";
                        $string_billcancel_tacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                         $string_loy.=" DATE(lob_date) between CURDATE( ) - INTERVAL 6 month AND CURDATE( )";
                         $string_comp_ta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 month AND CURDATE( )";
                         $string_comp_di.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 month AND CURDATE( )";
                         $string_credit_pay.=" cdp_dayclosedate between CURDATE( ) - INTERVAL 6  month AND CURDATE( )";
                         $string_expense.=" vp_dayclose_date  between CURDATE( ) - INTERVAL 6  month AND CURDATE( )";
                          $string_advance.= " tp_dayclose between CURDATE( ) - INTERVAL 6  month AND CURDATE( )";
                         $st= " Last 6 months "; 
                         
                          $string_acc_exp.= " ev_date between CURDATE( ) - INTERVAL 6  month AND CURDATE( ) ";
                         $string_acc_sup.= " sv_date between CURDATE( ) - INTERVAL 6  month AND CURDATE( ) ";
                         $string_acc_emp.= " ev_date between CURDATE( ) - INTERVAL 6  month AND CURDATE( )";
                }
                else if($bydatz=="Last365days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $string_billcancel_di.=" bm_dayclosedate between CURDATE( )  - INTERVAL 1 YEAR AND CURDATE( )";
                        $string_billcancel_tacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                         $string_itemcancel_di.=" ch_dayclosedate between CURDATE( ) - INTERVAL   1 YEAR  AND CURDATE( )";
                         $string_itemcancel_ta.=" tc_dayclosedate between CURDATE( ) - INTERVAL   1 YEAR AND CURDATE( )";
                         $string_loy.=" DATE(lob_date) between CURDATE( ) - INTERVAL  1 YEAR  AND CURDATE( )";
                         $string_comp_ta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                         $string_comp_di.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                         $string_credit_pay.=" cdp_dayclosedate between CURDATE( ) - INTERVAL 1  YEAR AND CURDATE( )";
                         $string_expense.=" vp_dayclose_date  between CURDATE( ) - INTERVAL 1  YEAR AND CURDATE( )";
                          $string_advance.= " tp_dayclose between CURDATE( ) - INTERVAL 1  YEAR AND CURDATE( )";
                         $st= " Last 1 year "; 

                            $string_acc_exp.= " ev_date between CURDATE( ) - INTERVAL 1  YEAR AND CURDATE( ) ";
                         $string_acc_sup.= " sv_date between CURDATE( ) - INTERVAL 1  YEAR AND CURDATE( ) ";
                         $string_acc_emp.= " ev_date between CURDATE( ) - INTERVAL 1  YEAR AND CURDATE( )";

                }
        $reporthead=$st;
                }
                else
                {

                        $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                $string_billcancel_di.=" bm_dayclosedate between '".$from."' and '".$to."' ";
                                $string_billcancel_tacshd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                                 $string_itemcancel_di.=" ch_dayclosedate between  '".$from."' and '".$to."' ";
                                 $string_itemcancel_ta.=" tc_dayclosedate between  '".$from."' and '".$to."' ";
                                   $string_loy.=" DATE(lob_date) between  '".$from."' and '".$to."' ";
                                   $string_comp_ta.=" tab_dayclosedate between  '".$from."' and '".$to."' ";
                                 $string_comp_di.=" bm_dayclosedate between  '".$from."' and '".$to."' ";
                                  $string_credit_pay.=" cdp_dayclosedate between  '".$from."' and '".$to."' ";
                                   $string_expense.=" vp_dayclose_date  between  '".$from."' and '".$to."' ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                                $string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
                                 $string_advance.= " tp_dayclose between  between  '".$from."' and '".$to."' ";
                                 
                                 $string_acc_exp.= " ev_date between '".$from."' and '".$to."' ";
                         $string_acc_sup.= " sv_date between '".$from."' and '".$to."' ";
                         $string_acc_emp.= " ev_date between '".$from."' and '".$to."' ";
                }

                }


              $totalcash=0;
              $subtotalcash=0;
              $subtotalcashta=0;
              $roundofdi=0;
              $roundofta=0;

              $string_cashonly= " AND ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   )   ";	



              $string_cash_di=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
               $string1_cashta=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";

                $sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string_cash_di as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where  $stringstatdi $string $string_cashonly order by bm_dayclosedate,bm_billtime ASC"); 
                 $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
                  if($num_logincashdi){
                          while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
                                { 
                                        if($result_logincashdi['tot'] != "")	{
                                $subtotalcash =$subtotalcash + $result_logincashdi['tot'];

                  }}} 

                  $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta,$string1_cashta as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $stringstat $stringtacshd $string_cashonly  order by tab_dayclosedate,tab_time ASC"); 
                $num_logincashta   = $database->mysqlNumRows($sql_logincashta);
                  if($num_logincashta){
                          while($result_logincashta  = $database->mysqlFetchArray($sql_logincashta)) 
                                { 
                                        if($result_logincashta['tot'] != "")	{
                                $subtotalcashta =$subtotalcashta + $result_logincashta['tot'];

                  }}} 
                  $totalcash=$subtotalcash+$subtotalcashta+$roundofdi+$roundofta;


                   $nn=  array();
          $sql_logincredit1  =  $database->mysqlQuery("select distinct (bm_name) as bnk from tbl_bankmaster where bm_active='Y' "); 
	  $num_logincredit1   = $database->mysqlNumRows($sql_logincredit1);
	  if($num_logincredit1){
		  while($result_logincredit1  = $database->mysqlFetchArray($sql_logincredit1)) 
			{     
                      
                        $nn[]=$result_logincredit1['bnk'];
                        }
          }
          
          
        
                  
                  
                  

                   $sql_logincomp  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string_comp_di and  pym_code='complimentary' order by bm_dayclosedate,bm_billtime ASC"); 
                  $num_logincomp   = $database->mysqlNumRows($sql_logincomp);
                  if($num_logincomp){
                          while($result_logincomp  = $database->mysqlFetchArray($sql_logincomp)) 
                                { 
                                if($result_logincomp['tot'] != "")
                                {
                                $subtotalcomp =$subtotalcomp + $result_logincomp['tot'];
                                } }} 

                     $sql_logincompta  =  $database->mysqlQuery("select sum(tab_netamt) as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string_comp_ta and  pym_code='complimentary' order by tab_dayclosedate,tab_time ASC"); 
                     $num_logincompta   = $database->mysqlNumRows($sql_logincompta);
                  if($num_logincompta){
                          while($result_logincompta  = $database->mysqlFetchArray($sql_logincompta)) 
                                { 
                                if($result_logincompta['tot'] != "")
                                {
                                $subtotalcompta =$subtotalcompta + $result_logincompta['tot'];
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
                                $subtotalcp =$subtotalcp + $result_logincp['tot'];
                  } }} 

                   $sql_logincpta  =  $database->mysqlQuery("select $string3_cr as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $stringstat $stringtacshd and  pym_code='credit_person' order by tab_dayclosedate,tab_time ASC"); 
                  $num_logincpta   = $database->mysqlNumRows($sql_logincpta);
                  if($num_logincpta){
                          while($result_logincpta  = $database->mysqlFetchArray($sql_logincpta)) 
                                { 
                                if($result_logincpta['tot'] != "")
                                {
                                $subtotalcpta =$subtotalcpta + $result_logincpta['tot'];
                  } }} 

                  $totalcp=$subtotalcp+$subtotalcpta;  




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

   $uae_subtotal=0; 
   $uae_subtotal_ta=0;
   $uae_subtotal_hd=0; 
   $uae_subtotal_cs=0;

          $sql_login  =  $database->mysqlQuery("select sum(bm_taxable_amount) as uae_subtotal, sum(bm_discountvalue) as tot_dis_di ,sum(bm_finaltotal) as tot, (sum(bm_subtotal)-sum(bm_discountvalue)) as totexcl,sum(bm_roundoff_value) as totroundof,sum(bm_tax_exempt) as taxexempt FROM tbl_tablebillmaster bm left join tbl_floormaster tf on tf.fr_floorid=bm.bm_floorid where  $stringstatdi $string "); 

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
                  
                  
                   $sql_loginhd  =  $database->mysqlQuery("select  sum(tab_taxable_amount) as uae_subtotal, sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-sum(tab_discountvalue)) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringhd"); 

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

                     $cur=date("Y-m-d");
                          $print .= $center.$bold_on.$branchname.$bold_off."\n";
                          $print .= $center.$bold_on."Specified Summary Report ".$bold_off."\n";
                                        if($from=='' && $to=='')
                                        {
                                                $print .= $center.$bold_on.$st.$bold_off."\n";
                                        }
                                        else
                                        {
                                        $print .= $center.$bold_on.$database->convert_date($from)." To ".$database->convert_date($to).$bold_off."\n";
                                        }

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
                  
                  
                  $sql_logincredit  =  $database->mysqlQuery("select distinct (bm_name) as bnk, sum(bm_transactionamount) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and $stringstatdi $string and pym_code='credit' group by bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
                  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
                  if($num_logincredit){
                          while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
                                {      
                                        $subtotalcredit =$subtotalcredit + $result_logincredit['tot'];
                  }}

                   $sql_logincreditta  =  $database->mysqlQuery("select distinct (bm_name) as bnk, sum(tab_transactionamount) as tot from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.tab_transcbank and $stringstat  $stringtacshd and pym_code='credit' group by bm_name order by tbm.tab_dayclosedate,tbm.tab_time ASC "); 
                  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
                  if($num_logincreditta){
                          while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
                                {    
                                        $subtotalcreditta =$subtotalcreditta + $result_logincreditta['tot'];
                  }}
                  $totalcredit=$subtotalcredit+$subtotalcreditta;

                 

                  $bilno= array(
                                                        new bilno("Card Sale",number_format($totalcredit,$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                }
                $sql_logincredit  =  $database->mysqlQuery(" select  distinct (b.bm_name) as bnk,sum(bc.mc_cardamount) as tot
                FROM tbl_tablebillmaster bm
                left join tbl_paymentmode on bm.bm_paymode=tbl_paymentmode.pym_id  
                left join tbl_bill_card_payments bc on bc.mc_billno=bm.bm_billno
                left join tbl_bankmaster b on  b.bm_id = bc.mc_to_bank 
                where  tbl_paymentmode.pym_code='credit' and  bm.bm_status='Closed' 
                AND bm.bm_complimentary!='Y' AND $stringstatdi $string group by bnk ") ;                          
                                                
//                $sql_logincredit  =  $database->mysqlQuery("select distinct (bm_name) as bnk, sum(bm_transactionamount) as tot from tbl_tablebillmaster"
//                . " tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where "
//                . " b.bm_id = tb.bm_transcbank and $stringstatdi $string and pym_code='credit' group by bm_name "
//                . " order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
                    
                  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
                  if($num_logincredit){
                          while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
                                {   
                              
                          if($result_logincredit['tot']>0){    
                               $bilno= array(
                                                        new bilno('*DI - '.$result_logincredit['bnk'],number_format($result_logincredit['tot'],$_SESSION['be_decimal']),$printer_style),
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
                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND $stringstat $stringtacshd group by bnk");
                      


//                  $sql_logincreditta  =  $database->mysqlQuery("select distinct (bm_name) as bnk, sum(tab_transactionamount) as tot "
//                          . " from tbl_takeaway_billmaster tbm left join tbl_paymentmode on tbm.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b"
//                          . "  where  b.bm_id = tbm.tab_transcbank and $stringstat  $stringtacshd and pym_code='credit' "
//                          . " group by bm_name order by tbm.tab_dayclosedate,tbm.tab_time ASC "); 
                  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
                  if($num_logincreditta){
                          while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
                                {  
                              
                               if($result_logincreditta['tot']>0){    
                                      $bilno= array(
                                                        new bilno('*TA_CS_HD - '.$result_logincreditta['bnk'],number_format($result_logincreditta['tot'],$_SESSION['be_decimal']),$printer_style),
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


                   $tot_payment=$totalcash+$totalcredit+$totalcp+$totalcomp;
                     $print .= $left.$vv."\n";

                          $bilno= array(
                                                        new bilno("Total(incl Complimentary)",number_format($tot_payment,$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                }    










                   $tot_excl_in=$tot_payment-$totalcomp;

                   $print .= $left.$vv."\n";

                   $bilno= array(
                                                        new bilno("Total(excl Complimentary)",number_format($tot_excl_in,$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                }    




                   $print .= $left.$vv."\n";




                  $bilno= array(
                                                        new bilno("Dine in",number_format($subtotal,$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                }    


           if($subtotalta!=0)
                  {
               $bilno= array(
                                                        new bilno("Take Away",number_format($subtotalta,$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($bilno as $bilno) {
                                                        $print .=$left.($bilno);
                                                }    
                                                
                                                
                                                
                                                
           
         $sql_loginta32  =  $database->mysqlQuery("select tol_discount,tol_name,sum(tab_netamt) as tot ,sum(tab_food_partner_discount) as disc FROM tbl_takeaway_billmaster  left join tbl_online_order  on tol_id=tab_food_partner  where $stringstat  $stringta group by tab_food_partner "); 
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
                                                
                                                
                                                
                                                
               }



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
                  
                  
                  
                    if($expense_voucher>0 || $supplier_voucher>0 || $employee_voucher>0 ){
                   $print .= $left.$vv."\n"; 
                    }
                    
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
                                                        new average("Pax",$dipax,$tapax,$hdpax,$cspax ,$printer_style),
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
                                                        new average("Total ",number_format($subtotal,$_SESSION['be_decimal']),number_format($subtotalta,$_SESSION['be_decimal']),number_format($subtotalhd,$_SESSION['be_decimal']),number_format($subtotalcs,$_SESSION['be_decimal']),$printer_style),
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
                                            if($num_tip){ $o=0;$total_tip=0;
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

                                           $advance_total=0;
            
            $sql_login_loy126  =  $database->mysqlQuery("select sum(tp_amount) as advance FROM tbl_advance_payment where $string_advance "); 
       
	  $num_login_loy126   = $database->mysqlNumRows($sql_login_loy126);
	  if($num_login_loy126){ 
         
		  while($result_login_loy126 = $database->mysqlFetchArray($sql_login_loy126)) 
			{   
			 
                     $advance_total=  $result_login_loy126['advance'];
                    
                      
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

                              
                              $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                              
                                        $print .="\n\n\n\n\n";
                                        $print.=$cutpaper;


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

        else if($_REQUEST['type']=="summary_report_cr")
        {
                 //echo "haiiiii";
                $print='';
                $from='';
                $to='';
                $typestring='';
                 $stringbnk_dt_di='';
        $stringbnk_dt_ta='';
        $string="";
        $strings="";
        $stringtacshd="";
        $stringstacshd="";
        $reporthead="";
        $string_credit_settle='';
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
        $string1tacshd=$stringstacshd." ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
        $stringvp='';


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
$stringcrd='';

                if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                {
                        $from=$database->convert_date($_REQUEST['fromdt']);
                        $to=$database->convert_date($_REQUEST['todt']);
                        $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $stringtacshd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_credit_settle.="cdp_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                         $stringvp.= " vp_dayclose_date between '".$from."' and '".$to."'";
                         $stringbnk_dt_di.= " bm_dayclosedate between '".$from."' and '".$to."' ";  
          
                           $stringbnk_dt_ta.= " tab_dayclosedate between '".$from."' and '".$to."' "; 
                            $stringcrd.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'  or  tbm.tab_dayclosedate between '".$from."' and '".$to."' ) ";
                }
                else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                {
                        $from=$database->convert_date($_REQUEST['fromdt']);
                        $to=date("Y-m-d");
                        $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $stringtacshd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_credit_settle.="cdp_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                         $stringvp.= " vp_dayclose_date between '".$from."' and '".$to."'";
                         $stringbnk_dt_di.= " bm_dayclosedate between '".$from."' and '".$to."' ";  
          
                           $stringbnk_dt_ta.= " tab_dayclosedate between '".$from."' and '".$to."' "; 
                            $stringcrd.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'  or  tbm.tab_dayclosedate between '".$from."' and '".$to."' ) ";
                }
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                        $from=date("Y-m-d");
                        $to=$database->convert_date($_REQUEST['todt']);
                        $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                         $stringtacshd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                         $string_credit_settle.="cdp_dayclosedate between '".$from."' and '".$to."'";
                         $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                          $stringvp.= " vp_dayclose_date between '".$from."' and '".$to."'";
                          $stringbnk_dt_di.= " bm_dayclosedate between '".$from."' and '".$to."' ";  
          
                           $stringbnk_dt_ta.= " tab_dayclosedate between '".$from."' and '".$to."' "; 
                            $stringcrd.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'  or  tbm.tab_dayclosedate between '".$from."' and '".$to."' ) ";
                }


        else 
        {
                $bydatz=$_REQUEST['bydate'];
                $st='';


        if($bydatz!="null" && $bydatz!="")
        {
                //$search="";

        if($bydatz=="Last5days")
        {

                $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                //$st= " Last 5 days ";
                
                $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  5  DAY AND CURDATE( )";
                 
                 $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ";  
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( ) ) ";
        }elseif($bydatz=="Last10days")
        {
                $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  10  DAY AND CURDATE( )";
                // $st= " Last 10 days ";
                 $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                 
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) ) ";
        }
        elseif($bydatz=="Last15days")
        {
                $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  15  DAY AND CURDATE( )";
                 $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) ) ";
                $st= " Last 15 days ";
        }
        else if($bydatz=="Last20days")
        {
                $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  20  DAY AND CURDATE( )";
                $st= " Last 20 days ";
                 $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) ) ";
        }
        else if($bydatz=="Last25days")
        {
                $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  25  DAY AND CURDATE( )";
                 $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ";
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ) ";
                $st= " Last 25 days ";
        }
        else if($bydatz=="Last30days")
        {
                $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  30  DAY AND CURDATE( )";
                 $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";  
           $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ) ";
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) "; 
                $st= " Last 30 days ";
        }
        else if($bydatz=="Today")
        {
                $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  0  DAY AND CURDATE( )";
                 $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) ) ";
                //$st= " Today ";
                  $st .= date("Y-m-d");
        }
        else if($bydatz=="Yesterday")
        {
                $string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day ";
                $stringtacshd.=" tab_dayclosedate = CURDATE() - INTERVAL 1 day ";
                $string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
                $string_credit_settle.="cdp_dayclosedate = CURDATE( ) - INTERVAL 1  DAY ";
                 $stringvp.= " vp_dayclose_date = CURDATE( ) - INTERVAL  1  DAY ";
                 $stringbnk_dt_di.= " bm_dayclosedate = CURDATE() - INTERVAL 1 DAY ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                 $stringcrd.= "(bm.bm_dayclosedate = CURDATE( ) - INTERVAL 1    or  tbm.tab_dayclosedate = CURDATE( ) - INTERVAL 1  DAY ) ";
                //$st= " Yesterday ";
                  $st .= date("Y-m-d", strtotime("-1 day"));
        }
        else if($bydatz=="Last1month")
        {
                $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringtacshd.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                 $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  1 MONTH AND CURDATE( )";
                 $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH   AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH   AND CURDATE( ) ";
                 
                  $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH   AND CURDATE( )   or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  1 MONTH   AND CURDATE( ) ) ";
                $st= " Last 1 month ";
        }
        else if($bydatz=="Last90days")
        {
                $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                  $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )";
                  $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH   AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH   AND CURDATE( ) ";
                  $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH   AND CURDATE( )   or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  3 MONTH   AND CURDATE( ) ) ";
                $st= " Last 3 months ";
        }
        else if($bydatz=="Last180days")
        {
                $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                  $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )";
                  $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH   AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH   AND CURDATE( ) ";
                  $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH   AND CURDATE( )   or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  6 MONTH   AND CURDATE( ) ) ";
                $st= " Last 6 months "; 
        }
        else if($bydatz=="Last365days")
        {
                $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringtcshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  1 YEAR AND CURDATE( )";
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 1  YEAR   AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 1  YEAR   AND CURDATE( ) ";
                  $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR   AND CURDATE( )   or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  1 YEAR   AND CURDATE( ) ) ";
                $st= " Last 1 year "; 



        }
        $reporthead=$st;
        }
        else
        {


                $from=date("Y-m-d");
                        $to=date("Y-m-d");
                        $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";

                        $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                        $string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
                        $string_credit_settle.="cdp_dayclosedate between '".$from."' and '".$to."'";
                         $stringvp.= " vp_dayclose_date between '".$from."' and '".$to."'";
                         $stringbnk_dt_di.= " bm_dayclosedate between '".$from."' and '".$to."' ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                  $stringcrd.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'   or  tbm.tab_dayclosedate between '".$from."' and '".$to."'  ) ";
        }

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





                  $cur=date("Y-m-d");
                  $print .= $center.$bold_on.$branchname.$bold_off."\n";
                  $print .= $center.$bold_on."Summary Report Consolidated".$bold_off."\n";
                                if($from=='' && $to=='')
                                {
                                        $print .= $center.$bold_on.$st.$bold_off."\n";
                                }
                                else
                                {
                                $print .= $center.$bold_on.$database->convert_date($from)." To ".$database->convert_date($to).$bold_off."\n";
                                }

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

                 $sql_logincashdi  =  $database->mysqlQuery("select sum(bm_roundoff_value) as roundofdi,$string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings"."$string order by bm_dayclosedate,bm_billtime ASC"); 
        
          $num_logincashdi   = $database->mysqlNumRows($sql_logincashdi);
          if($num_logincashdi){
                  while($result_logincashdi  = $database->mysqlFetchArray($sql_logincashdi)) 
                        { 
                                if($result_logincashdi['tot'] != "")	{
                        $subtotalcash =$subtotalcash + $result_logincashdi['tot'];
                        $roundofdi=$roundofdi+$result_logincashdi['roundofdi'];
          }}} 

          $sql_logincashta  =  $database->mysqlQuery("select sum(tab_roundoff_value) as roundofta, $string1_strtacshd as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $stringstacshd"."$stringtacshd order by tab_dayclosedate,tab_time ASC"); 
       
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
                               $bilno= array(new bilno("Card",number_format($totalcredit,$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bilno);
                                        }
                                        
                                        
                                        
                                    ////cardstart////
                
           
                
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
                                                    )x where x.bnk !=''  group by x.bnk "); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{
                      $bilno= array(new bilno('* '.$result_logincredit['bnk'],number_format($result_logincredit['total'],$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bilno);
                                        }
                      
                      
                      
            }}
          
                $print .= "\n";        
    //////cardend/////     
                                        
                                        
                                        
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
                            $bilno= array(new bilno("Credit Sale",number_format($totalcp,$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bilno);
                                        }
                                        
                                        
                                   ///creditstart/////////
              
	  $st="";  $string=""; $final=0;
	 
         
 	  $sql_login  =  $database->mysqlQuery("select sum(cd.cd_amount) as tot,s.ser_firstname,r.rm_roomno,l.ly_firstname,cm.ct_corporatename,c.crd_staffid,c.crd_roomid,c.crd_corporateid,c.crd_guestid from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno WHERE $stringcrd group by cd.cd_masterid   order by cd.cd_dateofentry ASC"); 
	 
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
				
                                    $bilno= array(new bilno('* '.$party,number_format($result_login['tot'],$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bilno);
                                        }
                              
            
          
					$i++;
                         }}         
                          $print .= "\n";        
                            ////creditend/////      
                                        
                                        
                                        
                                        
                                        
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
//                                        $bilno= array(
//                                                new bilno("Total Pax",number_format($qtycount,$_SESSION['be_decimal']),$printer_style),
//                                        );
//                                        foreach($bilno as $bilno) {
//                                                $print .=$left.($bilno);
//                                        }
                    $finaltotal=$totalcash+$totalcredit+$totalcoupon+$totalvoucher+$totalcheque+$totalcp;

                    
                    
                    
                    ///taxcalc///////
                     
               //$stringbnk_dt_di_tax= "  bm.bm_dayclosedate between '".$datedayclose."' and '".$datedayclose."' ";  
          
         // $stringbnk_dt_ta_tax= "   tb.tab_dayclosedate between '".$datedayclose."' and '".$datedayclose."' ";                   
                                
                                
                                
           $tax_di_all=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(te.bem_total_value) as tax_di FROM `tbl_tablebill_extra_tax_master` te left join tbl_tablebillmaster bm on te.bem_billno=bm.bm_billno WHERE bm.bm_status='Closed' AND bm.bm_complimentary!='Y' AND $stringbnk_dt_di   "); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$tax_di_all=$tax_di_all + $result_stw['tax_di'];
			}
	  }
          
          
          
          $tax_ta_all=0;
		   $sql_stw1  =  $database->mysqlQuery("SELECT sum(te.tbe_total_value) as tax_ta FROM `tbl_takeaway_bill_extra_tax_master` te left join tbl_takeaway_billmaster tb on te.tbe_billno=tb.tab_billno WHERE tb.tab_status='Closed' AND tb.tab_complimentary!='Y' AND $stringbnk_dt_ta  "); 
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
                     
    $print .= $left.$vv."\n";
           $bilno= array(
                                                new bilno("TOTAL (exclusive Tax)",number_format(str_replace(',','',$finaltotal_excl),$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bold_on.$bilno.$bold_off);
                                        }
	 			 
              $bilno= array(
                                                new bilno("Tax Amount",number_format(str_replace(',','',$all_tax_show),$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bold_on.$bilno.$bold_off);
                                        }
                         
                    
                    
                    
                                $print .= $left.$vv."\n";//ojin
                                $bilno= array(
                                                new bilno("Total (inclusive Tax)",number_format(str_replace(',','',$finaltotal),$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bold_on.$bilno.$bold_off);
                                        }
                                $print .= $left.$vv."\n";//ojin
                    $creditcash_settle=0;
                    $creditcard_settle=0;
                    $sql_creditsettlemt  =  $database->mysqlQuery("select sum(cdp_paid_cash - cdp_balance) as settled_cash, sum(cdp_transaction_amount) as settled_card FROM tbl_credit_details_payment
                                                                    where $string_credit_settle "); 

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


                               $sql_login_loy12  =  $database->mysqlQuery("select sum(vp_amount) as expense FROM tbl_voucherpayment where vp_status='Approved' and $stringvp "); 

          $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
          if($num_login_loy12){ 

                  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
                        {   

                     $voucher_expense=  $result_login_loy12['expense'];


          }
          }    
          $print .= $left."\n";
                              if($voucher_expense>0){
                            $bilno= array(
                                                new bilno(" Total Expense",number_format(str_replace(',','',($voucher_expense)),$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bold_on.$bilno.$bold_off);
                                        }

                                $print .= $left.$vv."\n";//ojin

                              }


$bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                    
                                    
                                    

                                $print .="\n\n\n\n\n";
                                $print.=$cutpaper;

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
        else if(($_REQUEST['type']=="voucher_expense"))
        {
        //$from="";
        //$to='';
        $string='';
        $voucher=$_REQUEST['voucher'];
         $voucher1=$_REQUEST['voucher1'];
         $vouch_login=$_REQUEST['voucher_login'];
         if($voucher1!="")
        {

            $vouchertype=" vp_type='".$voucher1."' AND ";
        } 
        else
        {
          $vouchertype="";  
        }
        if($voucher!="")
        {

            $vouchername=" vh_vouchername='".$voucher."' AND  ";
        }
        else
        {
          $vouchername="";  
        }


        if($vouch_login!=""){
           $vp_approve= " vp_approvedby='".$vouch_login."' AND  ";
        }else{
            $vp_approve='';

        }

                if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                {
                        $from=$database->convert_date($_REQUEST['fromdt']);
                        $to=$database->convert_date($_REQUEST['todt']);
                        $string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

                }
                else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                {
                        $from=$database->convert_date($_REQUEST['fromdt']);
                        $to=date("Y-m-d");
                        $string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

                }
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                        $from=date("Y-m-d");
                        $to=$database->convert_date($_REQUEST['todt']);
                        $string.= " vp_dayclose_date between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

                }

        else 
        {                   
                $bydatz=$_REQUEST['bydate'];
                $st='';


                        if($bydatz!="null" && $bydatz!="")
        {
                //$search="";

        if($bydatz=="Last5days")
        {

                $string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";

                //$st= " Last 5 days ";
                
                $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";

        }elseif($bydatz=="Last10days")
        {
                $string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";

                //$st= " Last 10 days ";
                
                $toDate = date("Y-m-d"); // today
                $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                $st .= "From $fromDate To $toDate";
                
                
        }
        elseif($bydatz=="Last15days")
        {
                $string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";


                $st= " Last 15 days ";
        }
        else if($bydatz=="Last20days")
        {
                $string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";


                $st= " Last 20 days ";
        }
        else if($bydatz=="Last25days")
        {
                $string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";


                $st= " Last 25 days ";
        }
        else if($bydatz=="Last30days")
        {
                $string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";


                $st= " Last 30 days ";
        }
        else if($bydatz=="Today")
        {
                $string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 

                  $st .= date("Y-m-d");
                //$st= " Today ";
        }
        else if($bydatz=="Yesterday")
        {
                $string.=" vp_dayclose_date = CURDATE() - INTERVAL 1 day";

                $st .= date("Y-m-d", strtotime("-1 day"));
                //$st= " Yesterday ";
        }
        else if($bydatz=="Last1month")
        {
                $string.="  vp_dayclose_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";


                $st= " Last 1 month ";
        }
        else if($bydatz=="Last90days")
        {
                $string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 


                $st= " Last 3 months ";
        }
        else if($bydatz=="Last180days")
        {
                $string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";


                $st= " Last 6 months "; 
        }
        else if($bydatz=="Last365days")
        {
                $string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";


                $st= " Last 1 year "; 



        }
        $reporthead=$st;
        }
        else
        {


                        $from=date("Y-m-d");
                        $to=date("Y-m-d");
                        $string.= " vp_dayclose_date between '".$from."' and '".$to."' ";

                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	

        }

        }


                $branchname="";

                $sql_branch  =  $database->mysqlQuery("Select be_branchname from tbl_branchmaster where be_branchid='1'"); 

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
                 $sql_login  =  $database->mysqlQuery("select vp_id,vp_date,vh_vouchername,vp_type,
                 vp_status,vp_paymentmode,vp_amount,vp_paidto,vp_receivedby,vp_chequebank,vp_chequebranch,
                 vp_chequeleafno,ser_firstname,vp_approveddate,vp_remarks,be_branchname,vp_voucherno from tbl_voucherpayment left join tbl_voucherhead on vh_id=vp_vhid left join tbl_branchmaster on be_branchid=vp_branchid left join tbl_staffmaster on ser_staffid=vp_approvedby where vp_status='Approved' and $vouchername  $vouchertype $vp_approve $string");

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

                                 $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }

                                $print .="\n\n\n\n\n";
                                $print.=$cutpaper;

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
else if(($_REQUEST['type']=="stock_daywise_report"))
{
    
    	
	$string="";
        $reporthead='';
        
        $string.=" where ts_dayclose !=''  ";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ts_dayclose between '".$from."' and '".$to."' ";
                      $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and ts_dayclose between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ts_dayclose between '".$from."' and '".$to."' ";
                         $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}

	
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		
	
	if($bydatz=="Last5days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
              //$reporthead="Last 5 days"; 
              
              $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
              
                
	}elseif($bydatz=="Last10days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
           //$reporthead="Last 10 days";     
                
                $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" and ts_dayclose = CURDATE() - INTERVAL 1 day";
                             // $reporthead="Yesterday";    
                              
                               $reporthead .= date("Y-m-d", strtotime("-1 day"));
                              
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $reporthead="Last 15 days";     
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
               $reporthead="Last 20 days";     
	}
	else if($bydatz=="Last25days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
               $reporthead="Last 25 days";     
	}
	else if($bydatz=="Last30days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
               $reporthead="Last 30 days";      
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" and ts_dayclose between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                $reporthead="Last 1 month";      
			  }
	else if($bydatz=="Today")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                //$reporthead="Today";     
                 $reporthead .= date("Y-m-d");
	}
else if($bydatz=="Last90days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
               $reporthead="Last 90 days";     
	}
else if($bydatz=="Last180days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $reporthead="Last 180 days";     
	}
else if($bydatz=="Last365days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
               $reporthead="Last 365 days";     
	}

	}
	else
	{
		
		
		         $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ts_dayclose between '".$from."' and '".$to."' ";
                    // $reporthead="Today";     
                       $reporthead .= date("Y-m-d");
	}
		
	
	}
	
	
	if(isset($_REQUEST['menu_search']) && $_REQUEST['menu_search']!="" ){
            
            $string.= " and mr_menuname LIKE '%".$_REQUEST['menu_search']."%'";
            
        }
        
                                     $print .= $center.$bold_on."Stock Report".$bold_off."\n";
                                    $print .= $center.$bold_on."  ".$bold_off."\n";
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
            
                   $bilno= array(
                             new stock("Date","Menu","Open","Balance",$printer_style),
                        );
                        foreach($bilno as $bilno) {
                            $print .=$left.($bold_on.$bilno.$bold_off);
                            $print .= $left.$vv."\n";//ojin
                        }  
	
  $clr=''; $open=0;$added=0;$balance=0;$sold=0;
  $sql_login  =  $database->mysqlQuery("select ts_open_stock,ts_added_stock,ts_balance_stock,ts_dayclose,mr_menuname from tbl_daily_stock_detail left join tbl_menumaster on mr_menuid=ts_menuid left join tbl_portionmaster on pm_id=ts_portion   $string order by ts_dayclose desc "); 
                          
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ $i=1;
	  while($result_login  = $database->mysqlFetchArray($sql_login)) 
	{ 
              $open=$open+$result_login['ts_open_stock'];
              $added=$added+$result_login['ts_added_stock'];
              $balance=$balance+$result_login['ts_balance_stock'];
              $sold=$sold+(($result_login['ts_open_stock']+$result_login['ts_added_stock'])-$result_login['ts_balance_stock'] );
              if($clr!=$result_login['ts_dayclose']){
              $clr=$result_login['ts_dayclose'];
              }
              $bilno= array(
                        new stock($result_login['ts_dayclose'],substr($result_login['mr_menuname'],0,13),$result_login['ts_open_stock'],$result_login['ts_balance_stock'],$printer_style),
                        );
                        foreach($bilno as $bilno) {
                            $print .=$left.($bold_on.$bilno.$bold_off);
                            $print .= $left.$vv."\n";//ojin
                        }  
          }}
            

                 $bilno= array(
                             new stock("Total"," ",$open,$balance,$printer_style),
                        );
                        foreach($bilno as $bilno) {
                            $print .=$left.($bold_on.$bilno.$bold_off);
                            $print .= $left.$vv."\n";//ojin
                        }  

                        
                        $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                        
                                    $print .="\n\n\n\n\n";
                                    $print.=$cutpaper;

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
  else if($_REQUEST['type']=="item_ordered_cr")
  {
            
            
            $string="";
            $stringta="";
            $string_combo="";
            $string.="bm.bm_status = 'Closed'";
            $stringta.="bm.tab_status = 'Closed'";
            $string_addon="";
            $stringta_addon="";
            $addon_head='';

            if($_REQUEST['addon']=='N')
            {
                $string_addon.=" and bd.bd_bill_addon_slno IS NULL ";
                $stringta_addon.=" and bd.tab_bill_addon_slno IS NULL ";
            }
            else if($_REQUEST['addon']=='Y')
            {
                $string_addon.=" and bd.bd_bill_addon_slno IS NOT NULL";
                $stringta_addon.=" and bd.tab_bill_addon_slno IS NOT NULL ";
                 $addon_head='-Addons ';
            }
            else if($_REQUEST['addon']=='combo')
            {

                 $addon_head='-Combos ';
            }

            if($_REQUEST['category_menu']!="" ){
                $string.= " and mm.mr_maincatid='".$_REQUEST['category_menu']."'";
                 $stringta.= " and mm.mr_maincatid='".$_REQUEST['category_menu']."'";
            }


             if($_REQUEST['subcategory']!="" ){
            $string.= " and sc.msy_subcategoryid='".$_REQUEST['subcategory']."'";
             $stringta.= " and sc.msy_subcategoryid='".$_REQUEST['subcategory']."'";
        }
            
            if(isset($_REQUEST['menu_search']) && $_REQUEST['menu_search']!="" ){
                $string.= " and mm.mr_menuname LIKE '%".$_REQUEST['menu_search']."%'";
                $stringta.= " and mm.mr_menuname LIKE '%".$_REQUEST['menu_search']."%'";
                $string_combo.= " cn.cn_name LIKE '%".$_REQUEST['menu_search']."%' and ";
            }




            if(isset ($_REQUEST['floorz']))
            {

                    $floorvalue=$_REQUEST['floorz'];
                    if($floorvalue!="")
                    {

                    $string.="and bm.bm_floorid='".$floorvalue."'";
                    }
            }



                    if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                    {
                        $from=$database->convert_date($_REQUEST['fromdt']);
                        $to=$database->convert_date($_REQUEST['todt']);
                        $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                        $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."'  ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                    }
                    else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                    {
                         $from=$database->convert_date($_REQUEST['fromdt']);
                         $to=date("Y-m-d");
                         $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                         $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."' ";
                         $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."'  ";
                         $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                    }
                    else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                    {
                         $from=date("Y-m-d");
                         $to=$database->convert_date($_REQUEST['todt']);
                         $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                         $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                         $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."'  ";
                         $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                    }



            else 
            {
                    $bydatz=$_REQUEST['bydate'];

                    if($bydatz!="null" && $bydatz!="")
                    {

                    if($bydatz=="Last5days")
                    {
                        $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        //$st="Last 5 days";
                        
                         $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                        
                        
                    }
                    elseif($bydatz=="Last10days")
                    {
                        $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                         $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        //$st="Last 10 days";
                        
                         $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                        
                        
                    }
                    else if($bydatz=="Yesterday")
                    {
                        $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                        $stringta.=" and bm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                        $string_combo.= " cbd.cbd_dayclosedate = CURDATE() - INTERVAL 1 day";
                        //$st="Yesterday";
                        $st .= date("Y-m-d", strtotime("-1 day"));
                    }
                    elseif($bydatz=="Last15days")
                    {
                        $string.="  and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $stringta.="  and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $st="Last 15 days";
                    }
                    else if($bydatz=="Last20days")
                    {
                        $string.=" and  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $stringta.=" and  bm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                         $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $st="Last 20 days";
                    }
                    else if($bydatz=="Last25days")
                    {
                        $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $st="Last 25 days";
                    }
                    else if($bydatz=="Last30days")
                    {
                        $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $st="Last 30 days";
                    }
                    else if($bydatz=="Last1month")
                    {
                        $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                        $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                        $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                        $st="Last 1 Month";
                    }
                    else if($bydatz=="Today")
                    {
                        $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                       // $st="Today";
                        $st .= date("Y-m-d");
                    }
                    else if($bydatz=="Last90days")
                    {
                        $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $st="Last 90 days";
                    }
                    else if($bydatz=="Last180days")
                    {
                        $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $st="Last 180 days";
                    }
                    else if($bydatz=="Last365days")
                    {
                        $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $st="Last 365 days";
                    }
                    }
                    else
                    {
                    $from=date("Y-m-d");
                    $to=date("Y-m-d");
                    $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                    $stringta.= " and bm.tab_dayclosedate between '".$from."' and '".$to."' ";
                    $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

                    }
                    $reporthead=$st;
            }  
            
            
   if($_REQUEST['modeofview']!='summary'){

            $final=0;
            $funalta=0;
            $netfinal=0;

             $qty=0;
             $qty_final=0;$p=0;$i=1; $qty1loose=0;
             
             if(($_REQUEST['addon']=='' ||$_REQUEST['addon']=='combo') &&($_REQUEST['category_menu']=="")){
                 
                 
            $sql_combo  =  $database->mysqlQuery("select combo,comboid,combopackid, sum(qty) as qty, rate as rate, sum(total) as total from (
            select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_combo_id as comboid, cbd.cbd_combo_pack_id combopackid, 
            cbd.cbd_combo_qty as qty, cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
                                                        FROM tbl_combo_bill_details cbd 
                                                        left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                        left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                        LEFT JOIN tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                        where $string_combo and bm.bm_status='Closed' group by cbd.cbd_combo_id, 
                                                        cbd.cbd_combo_pack_id,cbd.cbd_billno union all

                                                        select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_combo_id, 
                                                        cbd.cbd_combo_pack_id, cbd.cbd_combo_qty as qty, cbd.cbd_combo_pack_rate as rate,
                                                        cbd.cbd_combo_total_rate as total 
                                                        FROM tbl_combo_bill_details_ta cbd 
                                                        left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                        left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                        LEFT JOIN tbl_takeaway_billmaster bm on bm.tab_billno = cbd.cbd_billno
                                                        where $string_combo and bm.tab_status='Closed' group by cbd.cbd_combo_id,"
                                                        . " cbd.cbd_combo_pack_id,cbd.cbd_billno ) x group by x.comboid, x.combopackid");
            
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

                                    if($printer_style=='1'){
                                        
                                        $vv=str_pad("-",  '47', "-");

                                        }
                                        else if($printer_style=='2'){
                                             $vv=str_pad("-",  '42', "-");
                                        }
                                    $print .= $left.$vv."\n";
                                    
                                    $menulist= array(
                                            new itemordered("Item","Qty","Total",$printer_style),
                                    );
                                    foreach($menulist as $menulist) {
                                            $print .=$left.($bold_on.$menulist.$bold_off);
                                    }
                                    $print .= $left.$vv."\n";
                                    $print .="* * ".$bold_on."COMBO MENUS".$bold_off." \n";
                                    
                        while($result_combo  = $database->mysqlFetchArray($sql_combo)){ 
                            
                        $i++;$p++;
                        $final=$final+$result_combo['total'];
                        $qty_final=$qty_final+$result_combo['qty'];

                        $menulist= array(
                        new itemordered(substr(strtoupper($result_combo['combo']),0,25),$result_combo['qty'],number_format($result_combo['total'],$_SESSION['be_decimal']),$printer_style),

                            );
                        foreach($menulist as $menulist) {
                            $print .=$left.($menulist);
                            $j++;
                        }

                    }
                } }
                
    //////normal menu//////            
   if($_REQUEST['addon']=='' || $_REQUEST['addon']=='N'|| $_REQUEST['addon']=='Y'){

        $sql_stw  =  $database->mysqlQuery("select maincategory,subcategory,menuid,menuname, rate_type,unit_type,portionid,portionname,
            sum(weight)as weight,unitid,unitname,baseunitid,baseunitname,sum(qty)as qty,sum(total)as total from ( 
                                            select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,
                                            bd.bd_menuid as menuid,mm.mr_menuname as menuname, bd.bd_rate_type as rate_type,
                                            bd.bd_unit_type as unit_type, bd.bd_portion as portionid,pm.pm_portionname as portionname,
                                            bd.bd_unit_weight as weight, bd.bd_unit_id as unitid,um.u_name as unitname,
                                            bd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.bd_rate, sum(bd.bd_qty) as qty ,
                                            sum(bd.bd_rate* bd.bd_qty) as total, bm.bm_dayclosedate as dayclose
                                            FROM tbl_tablebilldetails bd
                                            left join tbl_tablebillmaster bm ON bm.bm_billno = bd.bd_billno
                                            left join tbl_menumaster mm ON mm.mr_menuid = bd.bd_menuid
                                            left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                            left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                            left join tbl_portionmaster pm ON pm.pm_id = bd.bd_portion
                                            left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                            left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                            where bd.bd_count_combo_ordering is NULL and $string $string_addon
                                            group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight,bm.bm_dayclosedate

                                            union all 

                                            select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,
                                            bd.tab_menuid as menuid,mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                                            bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                                            bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                                            bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate, sum(bd.tab_qty) as qty ,
                                            sum(bd.tab_rate* bd.tab_qty) as total,bm.tab_dayclosedate as dayclose
                                            FROM tbl_takeaway_billdetails bd
                                            left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                                            left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                            left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                            left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                            left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                            left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                            left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                            where bd.tab_count_combo_ordering is NULL and $stringta $stringta_addon
                                            group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id,
                                            bd.tab_unit_weight ,bm.tab_dayclosedate
                                            )x group by menuid,portionid,unitid,baseunitid,weight ,dayclose
                                            order by dayclose,maincategory,menuid ");
                    $num_stw   = $database->mysqlNumRows($sql_stw);
                    if($num_stw){ $t=0;$old="";
                                     if(!$num_combo){
                                         
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

                                    $j=0;
                                    $old="";
                                    $subold="";
                                    $qty1=0;

                                    $old_menu='';
                                    while($result_report  = mysqli_fetch_array($sql_stw)) 
                                    {
                                         $t=$i-1;$p++;
                                         $qty1loose=$result_report['qty'];
                                         $billhis_portion=$result_report['portionname'];
                                         $qty1=$result_report['qty'];
                                         $weight=$result_report['weight'];
                                          $total=$result_report['total'];
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
                                                    
                                                    
                                                // $loose_total=0;   
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


                }}	

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

   }else{
                
                
    ///////////summary////////
    
        $xlsRow=1;
        
        $final=0;
        $qty=0;
        $qty_final=0;
        $qty_final_ta=0;
        $qty_final_cs=0;
        $p=0;$i=0;
        
    if(($_REQUEST['addon']=='' || $_REQUEST['addon']=='combo') &&($_REQUEST['category_menu']=="")){
            
            $sql_combo  =  $database->mysqlQuery("select combo,comboid,combopackid, sum(qty_all) as qty_all, rate as rate, sum(total) as total,
            dayclose as dateofsale
            from (select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_dayclosedate  as dayclose,cbd.cbd_combo_id as comboid, 
            cbd.cbd_combo_pack_id combopackid, cbd.cbd_combo_qty as qty_all,
            cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
            FROM tbl_combo_bill_details cbd 
            left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id 
            left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id 
            LEFT JOIN tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno 
            where $string_combo  and bm.bm_status='Closed' 
            group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno 
            union all 
            select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_dayclosedate  as dayclose,cbd.cbd_combo_id, cbd.cbd_combo_pack_id,
            cbd.cbd_combo_qty as qty_all,
            cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
            FROM tbl_combo_bill_details_ta cbd 
            left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id 
            left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id 
            LEFT JOIN tbl_takeaway_billmaster bm on bm.tab_billno = cbd.cbd_billno 
            where $string_combo  and bm.tab_status='Closed'   and bm.tab_mode IN ('TA','HD','CS')
            group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno
            ) x 
            group by x.comboid, x.combopackid order by dateofsale  ");
            $num_combo   = $database->mysqlNumRows($sql_combo);
            if($num_combo){
                
                $total=0;$qty=0;
                while($result_combo  = $database->mysqlFetchArray($sql_combo)){ 
                    
                    $i++;$p++;
//                    $final=$final+$result_combo['total'];
//                    $qty_final=$qty_final+$result_combo['qty_all'];
//                    
//                    $data['Sl No']=$p;
//                     $data['Date']=$result_combo['dateofsale'];
//                    if($i==1) {
//                    $data['Main Category']='** COMBO MENU';
//                    }else{
//                        $data['Main Category']='';
//                    }
//                    $data['Sub Categroy']='';
//                    $data['Item']=substr(strtoupper($result_combo['combo']),0,25);
//                    $data['Unit Type']='';
//                    $data['Portion/Weight']= '';
//                    $data['Qty']=$result_combo['qty_all'];
//                       
//                    $data['Total']=number_format(str_replace(',','',$result_combo['total']),$_SESSION['be_decimal']);
//                    array_push($data1,$data);
//                    unset($data);
                   
                }
            } }
            
            
        if($_REQUEST['addon']=='' || $_REQUEST['addon']=='N'|| $_REQUEST['addon']=='Y'){
            
        $item_nm5='';      
        $sql_stw  =  $database->mysqlQuery("select maincategory,subcategory,menuid,menuname, rate_type,unit_type,portionid,portionname,weight,
        unitid,unitname,baseunitid,baseunitname,sum(qty_all)as qty_all,sum(total)as total , dayclose,rt
        from (select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.bd_menuid as menuid,mm.mr_menuname as menuname,
        bd.bd_rate_type as rate_type,bd.bd_unit_type as unit_type, bd.bd_portion as portionid,pm.pm_portionname as portionname,
                                        bd.bd_unit_weight as weight, bd.bd_unit_id as unitid,um.u_name as unitname,
                                        bd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.bd_rate as rt, sum(bd.bd_qty) as qty_all ,
                                        sum(bd.bd_rate* bd.bd_qty) as total, bm.bm_dayclosedate as dayclose
                                        FROM tbl_tablebilldetails bd
                                        left join tbl_tablebillmaster bm ON bm.bm_billno = bd.bd_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.bd_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.bd_portion
                                        left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                        where  bd.bd_count_combo_ordering is NULL and $string $string_addon 
                                        group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,weight
                                            
                                        union all 
                                        
                                        select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,
                                        mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                                        bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                                        bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                                        bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate as rt,  sum(bd.tab_qty) as qty_all ,
                                        sum(bd.tab_rate* bd.tab_qty) as total , bm.tab_dayclosedate as dayclose
                                        FROM tbl_takeaway_billdetails bd
                                        left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                        left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                        where bd.tab_count_combo_ordering is NULL  and bm.tab_mode IN ('TA','HD','CS') and $stringta $stringta_addon
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id,weight
                                        
                                        )x group by menuid,portionid,unitid,baseunitid,weight order by maincategory,menuid ");
          
                $num_stw   = $database->mysqlNumRows($sql_stw);
                if($num_stw){
                    
                $t=0;$old_cat=""; $old_menu='';$unit_type='';
                $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;$qty_ta=0;$qty_cs=0;
                $weight=0;$unit='';$weight_loose=0;$loose_total=0; $qty5=0; $qty_all=0;
                
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


                                    if($printer_style=='1'){
                                        $vv=str_pad("-",  '47', "-");//46

                                        }
                                        else if($printer_style=='2'){
                                             $vv=str_pad("-",  '42', "-");
                                        }
                                        
                                    $print .= $left.$vv."\n";
                                   
                                    $menulist= array(
                                            new itemordered("Item","Qty/Wg","Total",$printer_style),
                                    );
                                    foreach($menulist as $menulist) {
                                            $print .=$left.($bold_on.$menulist.$bold_off);
                                    }
                                    $print .= $left.$vv."\n";
                                    
		       while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
                       {  
                            $i++;$p++;
                            if($result_stw['maincategory']!=$old_cat){
                                
                                $old_cat=$result_stw['maincategory'];
                                $catname=$result_stw['maincategory'];
                            }
                            else{
                                
                               $catname=''; 
                            }
                            
                            $subcatname=$result_stw['subcategory'];
                            $menuname=$result_stw['menuname'];
                            $total=$result_stw['total'];
                            $qty=$result_stw['qty_all'];
                             
                            $qty_all=$qty;
                            
                            $weight=$result_stw['weight'];
                            
                             if($weight>0 && $result_stw['unit_type']=='Loose'){
                               $qty='';
                             
                            }else{
                                
                               $qty=$result_stw['qty_all'];
                            
                            }
                            
                            
                            if($result_stw['portionid']!=''){
                                
                              $weight='';
                              $unit=$result_stw['portionname'] ;
                              $unit_type=$result_stw['rate_type'] ;
                            }
                            else{
                                
                                  $unit_type=$result_stw['unit_type'] ;
                                  if($result_stw['unitid']!=''){
                                      
                                    $unit=$result_stw['unitname'] ;
                                  
                                }
                                else{
                                    
                                    $unit=$result_stw['baseunitname'] ;
                                }
                           }
                            
                            if($unit_type=='Loose'){
                                
                                $catname=$result_stw['maincategory'];  
                                
                                if($result_stw['menuid']==$old_menu){
                                    
                                    $t=$i-1;
                                    
                                    if(strlen($print)>$string_length)
                                    {
                                        $print=substr($print,0,$string_length);

                                    }
                                    
                                    
                                   $weight_loose=$weight_loose+ ($result_stw['weight']*$qty_all);
                                  
                                   $final=$final-$loose_total;
                                   $loose_total=$loose_total+ $result_stw['total'];
                                   
                                   $p=$p-1;
                                   
                                }else{
                                    
                                    $old_menu=$result_stw['menuid'];
                                   
                                    $weight_loose=$result_stw['weight']*$qty_all;
                                    $loose_total=$result_stw['total'];
                                }
                                
                                $weight=$weight_loose;
                                $total=$loose_total;
                                $qty='';
                                $catname=$result_stw['maincategory'];
                                 
                            }
                            
                            $t++;
                        
                            
                             if($result_stw['unit_type']=='Loose'){
                                 
                                $qty5 =$weight;
                             }else{
                                 
                                $qty5=$qty; 
                                 
                             }
                            
                            if($result_stw['maincategory']!=$old){
                                
                                                $maincatname= $result_stw['maincategory'];   
                                                $print .= $left."\n";
                                                $print .= $left.$bold_on."* * ".strtoupper($maincatname).$bold_off."\n";


                                                $old = $result_stw['maincategory'];
                                                $print .= $left.$vv."\n";

                            }else{
                                                $print .= "";
                                                $old = $result_stw['maincategory'];
                            }
                          
                                            
                          $item_nm=substr(strtoupper($menuname),0,25);
                            $string_length=strlen($print); 
                         // if($item_nm5!=$result_stw['menuname']){
                            
                                    $menulist= array(
                                            new itemordered($item_nm,$qty5,$total,$printer_style),
                                    );
                                    foreach($menulist as $menulist) {
                                            $print .=$left.($bold_on.$menulist.$bold_off);
                                    }
                                    
                           //  $item_nm5=$result_stw['menuname']; 
                             
                         // } 
                                    
                                    
                     $xlsRow++;   
                     
                     $final=$final+$total;
                    
                         
            }} }      
            
              $print .= $left.$vv."\n";
            
                            $menulist= array(
                                            new itemordered('Total','',$final,$printer_style),
                                    );
                                    foreach($menulist as $menulist) {
                                            $print .=$left.($bold_on.$menulist.$bold_off);
                                    }
                                    $print .= $left.$vv."\n";
            
                
            }
            
            
            
                                    $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                    $print .="\n\n\n\n\n";
                                    $print.=$cutpaper;

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


            $sqldrop  =  $database->mysqlQuery ("DROP VIEW item"); 
            
            
            
    }else if($_REQUEST['type']=="categorywise_report_cr")
    {
        
        
                    $string ="";
                    $string.="bm.bm_status = 'Closed'";
                    $stringta ="";
                    $stringta="tbm.tab_status = 'Closed'";
                    $from='';
                    $to='';
                    $reporthead="";
                    $st="";
                    $print='';
                    $vv='';
                    if(isset ($_REQUEST['floorz']))
                {

                        $floorvalue=$_REQUEST['floorz'];
                        if($floorvalue!="")
                        {

                        $string.=" and bm.bm_floorid='".$floorvalue."' AND ";
                        }
                }


                if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {

                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=date("Y-m-d");
                                $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= "and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

                        }

                        else{

                            $bydatz=$_REQUEST['bydate'];

                            if($bydatz!="null" && $bydatz!="")
                            {
                                if($bydatz=="Last5days")
                                {
                                    $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                                    $stringta.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                                    //$st="Last5days";
                                    
                                     $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                                }    
                                elseif($bydatz=="Last10days")
                                {   
                                    $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                                    $stringta.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";

                                    //$st="Last 10 days";
                                    
                                    $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                                    
                                    
                                }
                                elseif($bydatz=="Last15days")
                                {
                                    $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                    $stringta.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                    $st="Last 15 days";
                                }
                                else if($bydatz=="Last20days")
                                {
                                    $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                    $stringta.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";

                                    $st="Last 20 days";
                                }
                                else if($bydatz=="Last25days")
                                {
                                    $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                    $stringta.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                    $st="Last 25 days";
                                }
                                else if($bydatz=="Last30days")
                                {
                                    $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                    $stringta.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                    $st="Last 30 days";
                                }
                                else if($bydatz=="Today")
                                {
                                    $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                                    $stringta.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                                  //  $st="Today";
                                     $st .= date("Y-m-d");
                                }

                                else if($bydatz=="Yesterday")
                                {
                                    $string.="and bm.bm_dayclosedate = CURDATE( ) - INTERVAL 1 DAY  AND CURDATE( )";
                                    $stringta.="and tbm.tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY  AND CURDATE( )";
                                    //$st="Yesterday";
                                     $st .= date("Y-m-d", strtotime("-1 day"));
                                }
                                else if($bydatz=="Last1month")
                                {
                                   $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                                   $stringta.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                                   $st="Last 1 Month"; 
                                }
                                else if($bydatz=="Last90days")
                                {
                                    $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                                    $stringta.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                                    $st="Last 90 months";
                                }
                                else if($bydatz=="Last180days")
                                {
                                    $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                                    $stringta.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                                    $st="Last 180 days";
                                }
                                else if($bydatz=="Last365days")
                                {
                                    $string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                                    $st="Last 365 days";
                                }
                                $reporthead=$st;
                            }
                            else
                            {
                                $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";

                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                            }        

                        }
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
                         $i++;}}
             $sql_login  =  $database->mysqlQuery(" SELECT mmy_maincategoryname,count(distinct(mr_menuid)) as noofitems,sum(qty + qty1) as qty,sum(Total) as Total From ( SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,sum(0) as qty1,bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where bd.bd_count_combo_ordering is NULL and $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname union all 
                             SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(0) as qty,sum(tbd.tab_qty) as qty1 ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where tbd.tab_count_combo_ordering is NULL and $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname) x group by mmy_maincategoryname ORDER BY mmy_maincategoryname ASC ");

                  $num_login   = $database->mysqlNumRows($sql_login);
                  if($num_login){$t=0;
                                    if($i==1){
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
                                           
                                        /*$print .= "------------------------------------------------\n";
                                        $print .= "Slno    Date           Bilno               Final\n";
                                        $print .= "------------------------------------------------\n";*/


                                        if($printer_style=='1'){
                                            $vv=str_pad("-",  '48', "-");//46

                                            }
                                            else if($printer_style=='2'){
                                                 $vv=str_pad("-",  '42', "-");
                                            }
                                        $print .= $left.$vv."\n";//ojin
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
                                                $print .=$left.($menulist);
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

                                            $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }

                                        $print .="\n\n\n\n\n";
                                        $print.=$cutpaper;

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

        else if($_REQUEST['type']=="cash_settling_report_cr")
        {



                $print="";
                $staff=$_REQUEST['staff'];
                $department=$_REQUEST['department'];
                $string="";
                $stringta="";
                $string.=" bm_status='Closed' AND ";
                $stringta.=" tab_status='Closed' AND ";
                $reporthead="";
                $st="";
                $from="";
                $to="";
                $stringmodeta="";
                 if($staff!="")
                {
                   $string.=" bm_settlement_login='".$staff."' AND ";
                   $stringta.=" tab_settlement_login='".$staff."' AND ";

                }
                if($department!=""&&$department!='DI')
                {
                    $stringta.=" tab_mode='".$department."' AND  ";


                }

                        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=date("Y-m-d");
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tab_dayclosedate between '".$from."' and '".$to."'";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        }



                else 
                {

                        $bydatz=$_REQUEST['bydate'];
                        if($bydatz!="" && $bydatz!="null")
                        {

                if($bydatz=="Last5days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        //$st="Last 5 days";
                        
                         $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                        
                }elseif($bydatz=="Last10days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                       // $st="Last 10 days";
                        
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                }
                else if($bydatz=="Yesterday")
                                  {
                                          $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                          $stringta.=" tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                         // $st="Yesterday";
                                           $st .= date("Y-m-d", strtotime("-1 day"));
                                  }
                elseif($bydatz=="Last15days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
        DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
        DAY AND CURDATE( )";
                        $st="Last 15 days";
                }
                else if($bydatz=="Last20days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
        DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
        DAY AND CURDATE( )";
                        $st="Last 20 days";
                }
                else if($bydatz=="Last25days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 
        DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 
        DAY AND CURDATE( )";
                        $st="Last 25 days";
                }
                else if($bydatz=="Last30days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 
        DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 
        DAY AND CURDATE( )";
                        $st="Last 30 days";
                }
                 else if($bydatz=="Last1month")
                                  {
                                          $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                          $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                          $st="Last 1 MONTH";
                                  }
                else if($bydatz=="Today")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                        //$st="TODAY";
                         $st .= date("Y-m-d");
                }
        else if($bydatz=="Last90days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $st="Last 90 days";
                }
        else if($bydatz=="Last180days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $st="Last 180 days";
                }
        else if($bydatz=="Last365days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $st="Last  1 Year";
                }



                $reporthead=$st;
                }
                else
                {


                        $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= " bm_dayclosedate ='".$from."'";
                                $stringta.= " tab_dayclosedate='".$from."'";
                                $reporthead="On ".$database->convert_date($from);
                }

                }




        $final=0;
        $i=0;
        if($staff=='' && $department==''){
          $sql_logincashier  =  $database->mysqlQuery("select login, sum(sum_1)as tot,sum(cash)as cash ,sum(card)as card from ( select distinct(bm_settlement_login) as login ,sum((bm_amountpaid)-(bm_amountbalace)) as cash,sum(bm_transactionamount) as card,sum(bm_finaltotal) as sum_1 from tbl_tablebillmaster where $string and bm_complimentary!='Y' and bm_settlement_login!='' group by bm_settlement_login union all
        select distinct(tab_settlement_login)as login,sum((tab_amountpaid)-(tab_amountbalace)) as cash,sum(tab_transactionamount) as card,sum(tab_netamt) as sum_1 from tbl_takeaway_billmaster where $stringta and tab_complimentary='N' and tab_settlement_login!='' group by tab_settlement_login)x group by login"); 

          $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
           if($num_logincashier)
                {

                    $print .= $center.$bold_on."Cosolidated".$bold_off."\n";
                                        $print .= $center.$bold_on."Settlement Report".$bold_off."\n";
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
                                            $vv=str_pad("-",  '48', "-");//46

                                            }
                                            else if($printer_style=='2'){
                                                 $vv=str_pad("-",  '42', "-");
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

 $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }

                                        $print .="\n\n\n\n\n";
                                        $print.=$cutpaper;

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
            else{
                echo 'a4print';
            }

        }    

        else if(($_REQUEST['type']=="kitchen_wise_report_cr"))
        {


                $string="";
                $stringta="";
                $kitchen=$_REQUEST['kitchen'];
                $string.=" bm.bm_status='Closed' AND ";
                $stringta.=" tbm.tab_status='Closed' AND ";
                if($kitchen!=''){
                    $string.=" km.kr_kotcode='".$kitchen."' AND ";
                    $stringta.=" km.kr_kotcode='".$kitchen."' AND ";
                }
                $from="";
                $to="";

                        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=date("Y-m-d");
                                $string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        }
                        else
                        {
                            $bydatz=$_REQUEST['bydate'];
        //$search="";


                if($bydatz=="Last5days")
                {
                        $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        
                        
                        
                }elseif($bydatz=="Last10days")
                {
                        $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                }
                else if($bydatz=="Yesterday")
                                  {
                                          $string.="bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                          $stringta.=" tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  }
                elseif($bydatz=="Last15days")
                {
                        $string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
        DAY AND CURDATE( )";
                        $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
        DAY AND CURDATE( )";
                }
                else if($bydatz=="Last20days")
                {
                        $string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
        DAY AND CURDATE( )";
                        $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
        DAY AND CURDATE( )";
                }
                else if($bydatz=="Last25days")
                {
                        $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
        DAY AND CURDATE( )";
                        $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
        DAY AND CURDATE( )";
                }
                else if($bydatz=="Last30days")
                {
                        $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
        DAY AND CURDATE( )";
                        $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
        DAY AND CURDATE( )";
                }
                 else if($bydatz=="Last1month")
                                  {
                                          $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                          $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  }
                else if($bydatz=="Today")
                {
                        $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                }
        else if($bydatz=="Last90days")
                {
                        $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                }
        else if($bydatz=="Last180days")
                {
                        $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                }
        else if($bydatz=="Last365days")
                {
                        $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                }
                else
                {


                        $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                }

                }

                $oldkitchen='';
                $oldcat='';
        $sql_login  =  $database->mysqlQuery("select kitchen,sum(qty) as qty,menu,category,sum(amount) as tot from( SELECT mc.mmy_maincategoryname as category,km.kr_kotname as kitchen,mm.mr_menuname menu,mm.mr_kotcounter,bd.bd_menuid as menuid,sum(bd_qty)as qty,sum(bd_rate*bd_qty)as amount from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno LEFT JOIN tbl_menumaster mm on mm.mr_menuid= bd.bd_menuid
                                                  LEFT JOIN tbl_kotcountermaster km on km.kr_kotcode=mm.mr_kotcounter left join tbl_menumaincategory mc on mc.mmy_maincategoryid=mm.mr_maincatid where bd.bd_count_combo_ordering is NULL and $string group by bd_menuid union all SELECT mc.mmy_maincategoryname as category,km.kr_kotname as kitchen,mm.mr_menuname menu,mm.mr_kotcounter,tbd.tab_menuid as menuid,sum(tab_qty)as qty,sum(tab_rate*tab_qty)as amount from tbl_takeaway_billdetails tbd 
                                                   left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno LEFT JOIN tbl_menumaster mm on mm.mr_menuid= tbd.tab_menuid LEFT JOIN tbl_kotcountermaster km on km.kr_kotcode=mm.mr_kotcounter left join tbl_menumaincategory mc on mc.mmy_maincategoryid=mm.mr_maincatid where tbd.tab_count_combo_ordering is NULL and $stringta  group by tbd.tab_menuid)x group by kitchen,menu,category order by kitchen, category"); 

           $num_login   = $database->mysqlNumRows($sql_login);


                  if($num_login)
                  {
                    $print .= $center.$bold_on."Cosolidated".$bold_off."\n";
                                        $print .= $center.$bold_on."Kitchen Wise Report".$bold_off."\n";
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
                                            $vv=str_pad("-",  '46', "-");//46

                                            }
                                            else if($printer_style=='2'){
                                                 $vv=str_pad("-",  '42', "-");
                                            }
                                        $print .= $left.$vv."\n";//ojin
                                        //$print .= $left."Slno  Date        Bilno              Final\n";


                                        $menulist= array(
                                                new cat_wise("Sl","Item","Quantity","Total",$printer_style)
                                        );
                                        foreach($menulist as $menulist) {
                                                $print .=$left.($bold_on.$menulist.$bold_off);
                                        }
                                        //$print .= $left."------------------------------------------\n";
        //				$print .= $vv."\n";//ojin

                  while($result_login  = $database->mysqlFetchArray($sql_login))
                    {
                            $final= $final + $result_login['tot'];
                            $quantity= $quantity + $result_login['qty'];
                            if($oldkitchen!=$result_login['kitchen']){
                                $oldkitchen=$result_login['kitchen'];

                                $print .= $left.$vv."\n";
                                 $print .=$left.$bold_on.($oldkitchen." Kitchen" ).$bold_off;
                                 $print .= $left."\n";
                                 $print .= $left.$vv."\n";
                             }
                            $i++;

                                if($oldcat!=$result_login['category']){
                                $oldcat=$result_login['category'];
                                  $print .=$left."\n";//ojin
                                  $print .=$left.$bold_on.("Category : ". $oldcat).$bold_off;
                                  $print .= $left."\n";

                           }




                            $menulist= array(
                                     new cat_wise($i,$result_login['menu'],$result_login['qty'],number_format($result_login['tot'],$_SESSION['be_decimal']),$printer_style)

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


 $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        $print .="\n\n\n\n\n";
                                        $print.=$cutpaper;

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
        else if(($_REQUEST['type']=="discount_report_cr"))
        {
             //echo "haiii";
                $print='';
                $string="";
                $stringta="";
                $mode=$_REQUEST['department'];
                $string=" bm_status='Closed' AND bm.bm_discountvalue>0 and  ";
                $stringta=" tab_status='Closed' AND  tbm.tab_discountvalue>0 and ";
                $reporthead="";


                        //echo $_REQUEST['fromdt'] ."--";
                        //echo $_REQUEST['todt'] ."<br>";
                        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                 $reporthead.= " From".$from."- To".$to."' ";
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=date("Y-m-d");
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                 $reporthead.= " From".$from."- To".$to."' ";
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                 $reporthead.= " From".$from."- To".$to."' ";
                        }


                else 
                {

                        $bydatz=$_REQUEST['bydate'];



                                if($bydatz!="null" && $bydatz!="")
                {
                        //$search="";

                if($bydatz=="Last5days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        //$reporthead="Last 5 days";
                         $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                        
                }elseif($bydatz=="Last10days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        //$reporthead="Last 10 days";
                        
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                }
                else if($bydatz=="Yesterday")
                                  {
                                          $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                          $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                          //$reporthead="Yester Day";
                                           $reporthead .= date("Y-m-d", strtotime("-1 day"));
                                  }
                elseif($bydatz=="Last15days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
        DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
        DAY AND CURDATE( )";
                        $reporthead="Last 15 days";
                }
                else if($bydatz=="Last20days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
        DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
        DAY AND CURDATE( )";
                        $reporthead="Last 20 days";
                }
                else if($bydatz=="Last25days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
        DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
        DAY AND CURDATE( )";
                        $reporthead="Last 25 days";
                }
                else if($bydatz=="Last30days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
        DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
        DAY AND CURDATE( )";
                        $reporthead="Last 30 days";
                }
                 else if($bydatz=="Last1month")
                                  {
                                          $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                          $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                          $reporthead="Last 1 Month";
                                  }
                else if($bydatz=="Today")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        //$reporthead="Today";
                         $reporthead .= date("Y-m-d");
                }
        else if($bydatz=="Last90days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                        $reporthead="Last 3 Months";
                }
        else if($bydatz=="Last180days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $reporthead="Last 6 Months";
                }
        else if($bydatz=="Last365days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $reporthead="Last ! Year";
                }

                }
                else
                {


                        $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead=" on--".$from;
                }


                }







                                        $print .= $center.$bold_on.$branchname.$bold_off."\n";
                          $print .= $center.$bold_on."Consolidated Discount Report".$bold_off."\n";
                                        if($from=='' && $to=='')
                                        {
                                                $print .= $center.$bold_on.$reporthead.$bold_off."\n";
                                        }
                                        else
                                        {
                                        $print .= $center.$bold_on.$database->convert_date($from)." To ".$database->convert_date($to).$bold_off."\n";
                                        }

                                        if($printer_style=='1'){
                                            $vv=str_pad("-",  '46', "-");//46

                                            }
                                            else if($printer_style=='2'){
                                                 $vv=str_pad("-",  '42', "-");
                                            }
                                        $print .= $left.$vv."\n";//ojin
                                        $menulist= array(
                                                new discount("SlNo","Billno","Bill Total","Discount",$printer_style),
                                        );
                                        foreach($menulist as $menulist) {
                                                $print .=$left.($menulist);
                                        }
                                        $print .= $left.$vv."\n";//ojin

            if($mode==''){
                    $sql_login  =  $database->mysqlQuery("select * from ( select  bm.bm_billno as bill,bm.bm_discountvalue as discount, bm.bm_finaltotal as amount,'DI' AS mode FROM tbl_tablebillmaster bm
                                                                where $string union all
                                                                select tbm.tab_billno as bill, tbm.tab_discountvalue as discount, tbm.tab_netamt as amount, tbm.tab_mode as mode FROM tbl_takeaway_billmaster tbm
                                                                where $stringta ) x order by   mode"); 
                    }
                    else if($mode=='DI'){
                    $sql_login  =  $database->mysqlQuery(" select  bm.bm_billno as bill,bm.bm_discountvalue as discount, bm.bm_finaltotal as amount,'DI' AS mode FROM tbl_tablebillmaster bm
                                                                where $string "); 
                    }
                    else if($mode=='TA'||$mode=='CS'||$mode=='HD'){
                    $sql_login  =  $database->mysqlQuery("
                                                                select tbm.tab_billno as bill, tbm.tab_discountvalue as discount, tbm.tab_netamt as amount, tbm.tab_mode as mode FROM tbl_takeaway_billmaster tbm
                                                                where $stringta and tab_mode='".$mode."' order by  tbm.tab_mode"); 
                    }
                  $num_login   = $database->mysqlNumRows($sql_login);
                    $i=1; 
                    $total=0;
                    $discount=0;
                  if($num_login)
                  {
                        while($result_login  = $database->mysqlFetchArray($sql_login)){

                            $total=$total+$result_login['amount'];
                            $discount=$discount+$result_login['discount'];        
                                $menulist= array(
                                    new discount($i,$result_login['bill'],number_format($result_login['amount'],$_SESSION['be_decimal']), number_format($result_login['discount'],$_SESSION['be_decimal']),$printer_style),
                                );
                                foreach($menulist as $menulist) {
                                    $print .=$left.($menulist);
                                }//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";
                                $bcnt=$i;
                                $i++;

                         }  
                                        $print .= $left.$vv."\n";//ojin
                                        $menulist= array(
                                                new discount("Bill:".$bcnt,"",number_format($total,$_SESSION['be_decimal']),number_format($discount,$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($menulist as $menulist) {
                                                $print .=$left.($bold_on.$menulist.$bold_off);
                                        }

                                        $print .= $left.$vv."\n";//ojin
                                        
                                         $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                        
                                        
                                        $print .="\n\n\n\n\n";
                                        $print.=$cutpaper;
                  }		
                                        //And pr_floorid='".$florrid."'
                                        $sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerip,pr_printerport From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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
        else if(($_REQUEST['type']=="complimentary_cr"))
        {
             //echo "haiii";
                $print='';
                $string="";
                $stringta="";
                $mode=$_REQUEST['department'];

                $string.=" bm.bm_status='Closed' AND bm.bm_complimentary='Y' and   ";
                $stringta.=" tbm.tab_status='Closed' AND tbm.tab_complimentary='Y' and  ";
                $reporthead="";


                        //echo $_REQUEST['fromdt'] ."--";
                        //echo $_REQUEST['todt'] ."<br>";
                        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                 $reporthead.= " From".$from."- To".$to."' ";
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=date("Y-m-d");
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                 $reporthead.= " From".$from."- To".$to."' ";
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                 $reporthead.= " From".$from."- To".$to."' ";
                        }


                else 
                {

                        $bydatz=$_REQUEST['bydate'];



                                if($bydatz!="null" && $bydatz!="")
                {
                        //$search="";

                if($bydatz=="Last5days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        //$reporthead="Last 5 days";
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                        
                }elseif($bydatz=="Last10days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        //$reporthead="Last 10 days";
                        
                         $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                }
                else if($bydatz=="Yesterday")
                                  {
                                          $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                          $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                         // $reporthead="Yester Day";
                                           $reporthead .= date("Y-m-d", strtotime("-1 day"));
                                  }
                elseif($bydatz=="Last15days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
        DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
        DAY AND CURDATE( )";
                        $reporthead="Last 15 days";
                }
                else if($bydatz=="Last20days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
        DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
        DAY AND CURDATE( )";
                        $reporthead="Last 20 days";
                }
                else if($bydatz=="Last25days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
        DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
        DAY AND CURDATE( )";
                        $reporthead="Last 25 days";
                }
                else if($bydatz=="Last30days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
        DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
        DAY AND CURDATE( )";
                        $reporthead="Last 30 days";
                }
                 else if($bydatz=="Last1month")
                                  {
                                          $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                          $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                          $reporthead="Last 1 Month";
                                  }
                else if($bydatz=="Today")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                       // $reporthead="Today";
                        $reporthead .= date("Y-m-d");
                }
        else if($bydatz=="Last90days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                        $reporthead="Last 3 Months";
                }
        else if($bydatz=="Last180days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $reporthead="Last 6 Months";
                }
        else if($bydatz=="Last365days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $reporthead="Last ! Year";
                }

                }
                else
                {


                        $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead=" on--".$from;
                }


                }


        if($mode==''){
                $sql_login  =  $database->mysqlQuery("select * from (select tbm.tab_billno as bill ,tbm.tab_date as billdate,tbm.tab_mode as mode,tbm.tab_netamt as amount FROM tbl_takeaway_billmaster tbm where $stringta union all
                                                select bm.bm_billno as bill,bm.bm_billdate as billdate,'DI' AS mode,bm.bm_finaltotal as amount FROM tbl_tablebillmaster bm where $string )x order by x.mode asc "); 
                }
                else if($mode=='DI'){
                    $sql_login  =  $database->mysqlQuery(" select bm.bm_billno as bill,bm.bm_billdate as billdate,'DI' AS mode,bm.bm_finaltotal as amount FROM tbl_tablebillmaster bm where $string "); 
                }
                else if($mode=='TA'||$mode=='CS'||$mode=='HD'){
                  $sql_login  =  $database->mysqlQuery(" select tbm.tab_billno as bill ,tbm.tab_date as billdate,tbm.tab_mode as mode,tbm.tab_netamt as amount FROM tbl_takeaway_billmaster tbm where $stringta and tbm.tab_mode='".$mode."' ");   
                }
                $num_login   = $database->mysqlNumRows($sql_login);

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
                                        $vv=str_pad("-",  '47', "-");//46

                                        }
                                        else if($printer_style=='2'){
                                             $vv=str_pad("-",  '42', "-");
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
                                        while($result_login  = mysqli_fetch_array($sql_login)) 
                                        {       

                                                $amount=$amount+$result_login['amount'];

                                                $dt=explode("-",$result_report['date']);
                                                $date=$dt[2]."-".$dt[1]."-".$dt[0];

                                                $menulist= array(
                                                        new menulist($i,$result_login['bill'],$result_login['mode'], number_format($result_login['amount'],$_SESSION['be_decimal']),$printer_style),
                                                );
                                                foreach($menulist as $menulist) {
                                                        $print .=$left.($menulist);

                                                }//$print .= $left.$i."    ".$date."     ".$result_report['bm_billno']."   ".$result_report['bm_finaltotal']."\n";

                                                $bcnt=$i;
                                                $i++;

                                        }
                            }
                                        $print .= $left.$vv."\n";//ojin
                                        $menulist= array(
                                                new menulist("Bill:".$bcnt,"","Final",number_format($amount,$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($menulist as $menulist) {
                                                $print .=$left.($bold_on.$menulist.$bold_off);
                                        }

                                        $print .= $left.$vv."\n";//ojin
                                        
                                        
                                         $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                        
                                        $print .="\n\n\n\n\n";
                                        $print.=$cutpaper;

                                //And pr_floorid='".$florrid."'
                                        $sql_kots="Select pr_defaultusb,pr_usbprinterip,pr_usbprinter,pr_printerport,pr_printerip From tbl_printersettings  Where pr_branchid ='".$_SESSION['branchofid']."' and pr_printertype='".$_SESSION['reportprint_tp']."' ";
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

        else if(($_REQUEST['type']=="consolidated_payment_cr"))
        {
                $string="";
                $stringta="";
                $mode="";
                $reporthead="";
                $mode=$_REQUEST['department'];
                if($mode==""){
                    $mode1="Consolidated";
                }
                else{
                   $mode1=$mode;
                }

                   if($_REQUEST['payment']=="1")
                    {
                            $string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and b.bm_status='closed' and ((b.bm_amountpaid-b.bm_amountbalace) > 0)  and";
                            $stringta=" ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and t.tab_status='closed' and ((t.tab_amountpaid-t.tab_amountbalace) > 0) and ";
                            $fields="<th class='sortable'>Cash Amount</th>";
                            $fields_dummy="<td></td>";
                   }else if($_REQUEST['payment']=="2")
                  {
                        $string = " pym_code='credit'  and bm_status='closed' and   ";
                        $stringta = " pym_code='credit' and tab_status='closed' and   ";
                        $fields="<th class='sortable'>Bank</th>";
                        $fields.="<th class='sortable'>Card Amount</th>";
                          $fields_dummy="<td></td>";
                            $fields_dummy.="<td></td>";
                            
                            
             if($_REQUEST['bank_name']!=''){
            
             $string.= "   bm_transcbank ='".$_REQUEST['bank_name']."' and  ";
            
             $stringta.="   tab_transcbank ='".$_REQUEST['bank_name']."' and ";
            }
                            
                            
                            
                  }else if($_REQUEST['payment']=="3")
                {
                        $string = " pym_code='coupon' and bm_status='closed' and ";
                        $stringta = " pym_code='coupon' and tab_status='closed' and ";
                        $fields="<th class='sortable'>Coupon Company</th>";
                        $fields.="<th class='sortable'>Coupon Amount</th>";
                        $fields.="<th class='sortable'>Paid</th>";
                          $fields_dummy="<td></td>";
                            $fields_dummy.="<td></td>";
                              $fields_dummy.="<td></td>";
                }else if($_REQUEST['payment']=="4")
                {
                        $string = " pym_code='voucher' and bm_status='closed' and";
                        $stringta= " pym_code='voucher' and tab_status='closed' and";
                        $fields="<th class='sortable'>Voucher</th>";
                        $fields.="<th class='sortable'>Paid</th>";
                }else if($_REQUEST['payment']=="5")
                {

                        $string = " pym_code='cheque' and bm_status='closed' and";
                        $stringta = " pym_code='cheque' and tab_status='closed' and";
                        $fields="<th class='sortable'>Cheque No</th>";
                        $fields.="<th class='sortable'>Bank Name</th>";
                        $fields.="<th class='sortable'>Paid</th>";
                        $fields_dummy="<td></td>";
                  $fields_dummy.="<td></td>";
                    $fields_dummy.="<td></td>";
                }  
                else if($_REQUEST['payment'] =="6")
                {
                        $string = " bm_paymode='6' and bm_status='closed' and";
                        $stringta = " tab_paymode='6' and  tab_status='closed' and";
                        $fields="<th class='sortable'>Credit Amount</th>";
                        $fields_dummy="<td></td>";

                } 
                else if($_REQUEST['payment'] =="7")
                {
                        $string = " bm_complimentary='Y' and bm_status='closed' and";
                        $stringta = " tab_complimentary='Y' and tab_status='closed' and";
                        $fields="<th class='sortable'>Complimentary Amount </th>";
                        $fields_dummy="<td></td>";

                }
                 else if($_REQUEST['payment'] =="8")
                {
                        $string = " bm_paymode='8' and bm_status='closed' and";
                        $stringta = " tab_paymode='8' and  tab_status='closed' and";
                        $fields="<th class='sortable'>Upi Amount</th>";
                        $fields_dummy="<td></td>";


                }
              else if($_REQUEST['payment'] =="all")
                {
                        $string = "  bm_status='closed' and ";
                        $stringta = " tab_status='closed' and ";
                        $fields="<th class='sortable'>Upi Amount</th>";
                        $fields_dummy="<td></td>";


                }
                        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                                $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                                $reporthead.= " From-".$from."- To-".$to." ";
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=date("Y-m-d");
                                $string.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                                $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                                $reporthead.= " From".$from."- To-".$to." ";
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                                $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                                $reporthead.= " From".$from."- To-".$to." ";
                        }

                  else
                   {
                        $bydatz=$_REQUEST['bydate'];

                        if($bydatz!="null" && $bydatz!="")
                        {

                        if($bydatz=="Last5days")
                        {
                            $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                            $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                            //$reporthead.="Last5days";
                            
                            $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                        }
                        elseif($bydatz=="Last10days")
                        {
                            $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                            $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                            //$reporthead.="Last10days";
                            
                             $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                        
                        }
                        else if($bydatz=="Yesterday")
                        {
                            $string.="  bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                            $stringta.="  tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                            // $reporthead.="Yesterday";
                             $reporthead .= date("Y-m-d", strtotime("-1 day"));
                        }
                        elseif($bydatz=="Last15days")
                        {
                            $string.="   bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                            $stringta.="   tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                             $reporthead.="Last15days";
                        }
                        else if($bydatz=="Last20days")
                        {
                            $string.="   bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                            $stringta.="   tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                            $reporthead.="Last20days";
                        }   
                        else if($bydatz=="Last25days")
                        {
                            $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                            $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                              $reporthead.="Last25days";
                        }
                        else if($bydatz=="Last30days")
                        {
                            $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                            $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                              $reporthead.="Last30days";
                        }
                        else if($bydatz=="Last1month")
                        {
                            $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                            $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                             $reporthead.="Last1month";
                        }
                        else if($bydatz=="Today")
                        {
                            $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                            $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                            // $reporthead.="Today";
                            $reporthead .= date("Y-m-d");
                        }
                        else if($bydatz=="Last90days")
                        {
                            $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                            $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                             $reporthead.="Last90days";
                        }
                        else if($bydatz=="Last180days")
                        {
                            $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                            $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                            $reporthead.="Last180days";
                        }
                        else if($bydatz=="Last365days")
                        {
                            $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                            $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                            $reporthead.="Last365days";
                        }
                        }
                else
                {
                        $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead.= " On -".$from;
                }
                }

                $print .= $center.$bold_on."Payment Report ".$bold_off."\n";
                 if($mode==""){
                                        $print .= $center.$bold_on."Consolidated ".$bold_off."\n";
                                        $print.=$center.$reporthead."\n";
                                        }
                                        else{
                                            $print .= $center.$bold_on.$mode.$bold_off."\n";
                                              $print.=$center.$reporthead."\n";
                                        }

                                 if($printer_style=='1'){
                                            $vv=str_pad("-",  '47', "-");//46

                                            }
                                            else if($printer_style=='2'){
                                                 $vv=str_pad("-",  '42', "-");
                                            }
                                        $print .= $left.$vv."\n";
                                         if($_REQUEST['payment'] !="all"){
                                        $bilno= array(
                                                new payment("Bill No","Date","Amount","Total",$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bold_on.$bilno.$bold_off);
                                        }
                                         }else{
                                            $bilno= array(
                                                new payment("Bill No","Date","","Total",$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bold_on.$bilno.$bold_off);
                                        } 
                                         }
                                        $print .= $left.$vv."\n";//ojin


                                       $all_total="";
                                       $cash1="";
                                       $card1="";
                                       $coup1="";
                                       $voucher1="";
                                       $cheq1="";
                                       $credit1="";
                                       $complimentary1="";
                                       $upi1="";

                                       $all_total1="";
                                       $cash2="";
                                       $card2="";
                                       $coup2="";
                                       $voucher2="";
                                       $cheq2="";
                                       $credit2="";
                                       $complimentary2="";
                                       $upi2="";

                        $billno=array();
                        $day=array();
                        $cash= array();
                        $bank=array();
                        $card=array();
                        $coupon=array();
                        $coupon_company=array();
                        $coupon_paid=array();
                        $voucherid=array();
                        $voucher=array();		
                        $cheqno=array();
                        $cheq_bank=array();
                        $cheqamount=array();
                        $credit_person=array();
                        $complimentary=array();
                        $upi=array();
                        $final=array();
                        $all_total_mode=  array();
                  if($mode==''){

                      $sql_login1  =  $database->mysqlQuery("select bm_billno,bm_billdate,bm_amountpaid
                      ,bm_amountbalace,bm_transactionamount,bm_couponamt,bm_finaltotal,bm_upi_amount from 
                      tbl_tablebillmaster b LEFT JOIN tbl_bankmaster ON b.bm_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON b.bm_paymode= p.pym_id where $string order by b.bm_billdate,b.bm_billtime asc "); 
                  
                      $num_login1   = $database->mysqlNumRows($sql_login1);
                if($num_login1)
                  { 
                      while($result_login= $database->mysqlFetchArray($sql_login1))
                      {

                                  $bill_=$result_login['bm_billno'];
                                    $date_=$database->convert_date($result_login['bm_billdate']);


                                        if($_REQUEST['payment']=="1")
                                        {

                                        $amt=number_format(($result_login['bm_amountpaid']-$result_login['bm_amountbalace']),$_SESSION['be_decimal']);

                                        }else if($_REQUEST['payment']=="2")
                                        {

                                       $amt =number_format($result_login['bm_transactionamount'],$_SESSION['be_decimal']);

                                        }else if($_REQUEST['payment']=="3")
                                        {
                                       $amt=number_format($result_login['bm_couponamt'],$_SESSION['be_decimal']);


                                        }else if($_REQUEST['payment']=="4")
                                        {


                                   $amt=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);

                                        }else if($_REQUEST['payment']=="5")
                                        {


                                        $amt=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);

                                        }

                                        else if($_REQUEST['payment']=="6")
                                        {


                                       $amt=number_format(($result_login['bm_finaltotal']-($result_login['bm_amountpaid']-$result_login['bm_amountbalace'])),$_SESSION['be_decimal']);

                                        }else if($_REQUEST['payment']=="7")
                                        {


                                      $amt=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);

                                        }else if($_REQUEST['payment']=="8")
                                        {


                                       $amt=number_format($result_login['bm_upi_amount'],$_SESSION['be_decimal']);

                                        }

                                       $final_=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);

                                            $bilno= array(
                            new payment($bill_,$date_,$amt,$final_,$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

                                       $all_total=$all_total+$result_login['bm_finaltotal'];
                                       $cash1=$cash1+($result_login['bm_amountpaid']-$result_login['bm_amountbalace']);
                                       $card1=$card1+$result_login['bm_transactionamount'];
                                       $coup1=$coup1+$result_login['bm_couponamt'];
                                       $voucher1=$voucher1+$result_login['bm_amountpaid'];
                                       $cheq1=$cheq1+$result_login['bm_amountpaid'];
                                       $credit1=$credit1+($result_login['bm_finaltotal']-($result_login['bm_amountpaid']-$result_login['bm_amountbalace']));
                                       $complimentary1=$complimentary1+$result_login['bm_finaltotal'];
                                       $upi1=$upi1+$result_login['bm_upi_amount'];



                    }
                  }

                $sql_loginta1  =  $database->mysqlQuery("select tab_billno,tab_date,tab_amountpaid,
                tab_transactionamount,tab_couponamt,tab_netamt,tab_upi_amount,tab_amountbalace from tbl_takeaway_billmaster t LEFT JOIN tbl_bankmaster ON t.tab_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON t.tab_paymode= p.pym_id where $stringta order by t.tab_date,t.tab_time asc "); 
              
                $num_loginta1   = $database->mysqlNumRows($sql_loginta1);
                if($num_loginta1)
                  {
                      while($result_loginta1= $database->mysqlFetchArray($sql_loginta1))
                      {
                               $bill_ta  =$result_loginta1['tab_billno'];
                                $date_ta =$database->convert_date($result_loginta1['tab_date']);
                                        if($_REQUEST['payment']=="1")
                                        {
                                        $amt_ta=number_format(($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace']),$_SESSION['be_decimal']);
                                        }else if($_REQUEST['payment']=="2")
                                        {
                                       $amt_ta=number_format($result_loginta1['tab_transactionamount'],$_SESSION['be_decimal']);
                                        }else if($_REQUEST['payment']=="3")
                                        {
                                      $amt_ta =number_format($result_loginta1['tab_couponamt'],$_SESSION['be_decimal']);
                                        }else if($_REQUEST['payment']=="4")
                                        {
                                       $amt_ta=number_format($result_loginta1['tab_amountpaid'],$_SESSION['be_decimal']);
                                        }else if($_REQUEST['payment']=="5")
                                        {
                                      $amt_ta=number_format($result_loginta1['tab_amountpaid'],$_SESSION['be_decimal']);
                                        } else if($_REQUEST['payment']=="6")
                                        {
                                      $amt_ta  =number_format(($result_loginta1['tab_netamt']-($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace'])),$_SESSION['be_decimal']);
                                        }else if($_REQUEST['payment']=="7")
                                        {
                                     $amt_ta=number_format($result_loginta1['tab_netamt'],$_SESSION['be_decimal']);

                                        }else if($_REQUEST['payment']=="8")
                                        {

                                       $amt_ta=number_format($result_loginta1['tab_upi_amount'],$_SESSION['be_decimal']);

                                        }

                                    $final_ta =number_format($result_loginta1['tab_netamt'],$_SESSION['be_decimal']);

                                    $bilno= array(
                            new payment($bill_ta,$date_ta,$amt_ta,$final_ta,$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }


                       $all_total1=$all_total1+$result_loginta1['tab_netamt'];
                       $cash2=$cash2+($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace']);
                       $card2=$card2+$result_loginta1['tab_transactionamount'];
                       $coup2=$coup2+$result_loginta1['tab_couponamt'];
                       $voucher2= $voucher2+$result_loginta1['tab_amountpaid'];
                       $cheq2=$cheq2+$result_loginta1['tab_amountpaid'];
                       $credit2=$credit2+($result_loginta1['tab_netamt']-($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace']));
                       $complimentary2= $complimentary2+$result_loginta1['tab_netamt'];
                       $upi2=$upi2+$result_loginta1['tab_upi_amount'];
           } }

           $alltotal_sum=$all_total1+$all_total;
           $cash_sum=$cash1+$cash2;
           $card_sum=$card1+$card2;
           $coupon_sum=$coup1+$coup2;
           $voucher_sum=$voucher2+$voucher1;
           $cheq_sum=$cheq2+$cheq1;
           $creditsum=$credit1+$credit2;
           $compli_sum=$complimentary2+$complimentary1;
           $upi_sum=$upi1+$upi2;


            $print .= $left.$vv."\n";//ojin
           if($_REQUEST['payment']=="1")
                                        {


                                     $bilno= array(
                            new payment("Total","",number_format($cash_sum,$_SESSION['be_decimal']),number_format($alltotal_sum,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);

                                }

          }else if($_REQUEST['payment']=="2")
                {

               $bilno= array(
                            new payment("Total","",number_format($card_sum,$_SESSION['be_decimal']),number_format($alltotal_sum,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

          } else if($_REQUEST['payment']=="3")
                {

              $bilno= array(
                            new payment("Total","",number_format($coupon_sum,$_SESSION['be_decimal']),number_format($alltotal_sum,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

          } else if($_REQUEST['payment']=="4")
                {
              $bilno= array(
                            new payment("Total","",number_format($voucher_sum,$_SESSION['be_decimal']),number_format($alltotal_sum,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

          } else if($_REQUEST['payment']=="5")
                {
              $bilno= array(
                            new payment("Total","",number_format($cheq_sum,$_SESSION['be_decimal']),number_format($alltotal_sum,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

          } else if($_REQUEST['payment']=="6")
                {
              $bilno= array(
                            new payment("Total","",number_format($creditsum,$_SESSION['be_decimal']),number_format($alltotal_sum,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

          }
          else if($_REQUEST['payment']=="7")
                {
               $bilno= array(
                            new payment("Total","",number_format($compli_sum,$_SESSION['be_decimal']),number_format($alltotal_sum,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }


          }else if($_REQUEST['payment']=="8")
                {
              $bilno= array(
                            new payment("Total","",number_format($upi_sum,$_SESSION['be_decimal']),number_format($alltotal_sum,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

          }
else if($_REQUEST['payment']=="all")
                {
              $bilno= array(
                            new payment("Total","","",number_format($alltotal_sum,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

          }


          $print .= $left.$vv."\n";//ojin


                  }






                if($mode=='DI'){
                $sql_login  =  $database->mysqlQuery("select bm_billno,bm_billdate,bm_amountpaid
                ,bm_amountbalace,bm_name,bm_transactionamount,bm_couponamt,bm_couponcompany,
                bm_chequeno,bm_chequebankname,bm_finaltotal,bm_upi_amount from tbl_tablebillmaster b LEFT JOIN tbl_bankmaster ON b.bm_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON b.bm_paymode= p.pym_id where $string order by b.bm_billdate,b.bm_billtime asc"); 

                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login)
                  {
                      while($result_login= $database->mysqlFetchArray($sql_login))
                      {
                        $billno[]=$result_login['bm_billno'];
                        $day[]=$database->convert_date($result_login['bm_billdate']);
                        $cash[]= number_format(($result_login['bm_amountpaid']-$result_login['bm_amountbalace']),$_SESSION['be_decimal']);             
                        $bank[]=$result_login['bm_name'];
                        $card[]=number_format($result_login['bm_transactionamount'],$_SESSION['be_decimal']);
                        $coupon[]=number_format($result_login['bm_couponamt'],$_SESSION['be_decimal']);       
                        $coupon_company[]=$result_login['bm_couponcompany'];
                        $coupon_paid[]=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
                        $voucherid[]=$result_login['bm_voucherid'];
                        $voucher[]=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);		
                        $cheqno[]=$result_login['bm_chequeno'];	
                        $cheq_bank[]=$result_login['bm_chequebankname'];
                        $cheqamount[]=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
                        $credit_person[]=number_format(($result_login['bm_finaltotal']-($result_login['bm_amountpaid']-$result_login['bm_amountbalace'])),$_SESSION['be_decimal']);
                        $complimentary[]=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
                        $upi[]=number_format($result_login['bm_upi_amount'],$_SESSION['be_decimal'])	;
                        $final[]=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);		

                    }
                  }
                }

                  if($mode=='TA'||$mode=='HD'||$mode=='CS'){
                     $sql_loginta  =  $database->mysqlQuery("select tab_billno,tab_date,tab_amountpaid,tab_amountbalace,bm_name,tab_transactionamount,tab_couponamt,
                     tab_couponcompany,tab_voucherid,tab_chequeno,tab_chequebankname,tab_netamt,tab_upi_amount from tbl_takeaway_billmaster t LEFT JOIN tbl_bankmaster ON t.tab_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON t.tab_paymode= p.pym_id where tab_mode='$mode' and $stringta order by t.tab_date,t.tab_time asc "); 

                     $num_loginta   = $database->mysqlNumRows($sql_loginta);
                     if($num_loginta)
                      {
                      while($result_loginta= $database->mysqlFetchArray($sql_loginta))
                      {

                        $billno[]=$result_loginta['tab_billno'];
                        $day[]=$database->convert_date($result_loginta['tab_date']);
                        $cash[]= number_format(($result_loginta['tab_amountpaid']-$result_loginta['tab_amountbalace']),$_SESSION['be_decimal']);             
                        $bank[]=$result_loginta['bm_name'];
                        $card[]=number_format($result_loginta['tab_transactionamount'],$_SESSION['be_decimal']);
                        $coupon[]=number_format($result_loginta['tab_couponamt'],$_SESSION['be_decimal']);       
                        $coupon_company[]=$result_loginta['tab_couponcompany'];
                        $coupon_paid[]=number_format($result_loginta['tab_amountpaid'],$_SESSION['be_decimal']);
                        $voucherid[]=$result_loginta['tab_voucherid'];
                        $voucher[]=number_format($result_loginta['tab_amountpaid'],$_SESSION['be_decimal']);		
                        $cheqno[]=$result_loginta['tab_chequeno'];	
                        $cheq_bank[]=$result_loginta['tab_chequebankname'];
                        $cheqamount[]=number_format($result_loginta['tab_amountpaid'],$_SESSION['be_decimal']);
                        $credit_person[]=number_format(($result_loginta['tab_netamt']-($result_loginta['tab_amountpaid']-$result_loginta['tab_amountbalace'])),$_SESSION['be_decimal']);
                        $complimentary[]=number_format($result_loginta['tab_netamt'],$_SESSION['be_decimal']);
                        $upi[]=number_format($result_loginta['tab_upi_amount'],$_SESSION['be_decimal'])	;
                        $final[]=number_format($result_loginta['tab_netamt'],$_SESSION['be_decimal']);		

                    }
                  }
                }

                for ($i=0;$i<count($billno);$i++){

                                    $bill_all=  $billno[$i];
                                    $date_all=$database->convert_date($day[$i]);


                                        if($_REQUEST['payment']=="1")
                                        {

                                        $amtall= $cash[$i];

                                        }else if($_REQUEST['payment']=="2"){

                                      $amtall= $card[$i];

                                        }else if($_REQUEST['payment']=="3")
                                        {


                                      $amtall= $coupon[$i];


                                        }else if($_REQUEST['payment']=="4")
                                        {

                                      $amtall=$voucher[$i];

                                        }else if($_REQUEST['payment']=="5")
                                        {

                                       $amtall= $cheqamount[$i];

                                        } else if($_REQUEST['payment']=="6")
                                        {


                                        $amtall= $credit_person[$i];

                                        }else if($_REQUEST['payment']=="7")
                                        {


                                        $amtall= $complimentary[$i];

                                        }else if($_REQUEST['payment']=="8")
                                        {


                                       $amtall=$upi[$i];

                                        }

                                     $final_all=$final[$i];

                                   $bilno= array(
                            new payment($bill_all,$date_all,$amtall,$final_all,$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }     

                }
                      if($mode!=""){   

                          $total_final=str_replace(",","",$final);
                          $cash_final=str_replace(",","",$cash);
                          $card_final=str_replace(",","",$card);
                          $coupon_final=str_replace(",","",$coupon_paid);
                          $voucher_final= str_replace(",","",$voucher);
                          $cheq_final= str_replace(",","",$cheqamount);
                          $credit_final= str_replace(",","",$credit_person);
                          $compli_final= str_replace(",","",$complimentary);
                          $upi_final=str_replace(",","",$upi);

                     $print .= $left.$vv."\n";//ojin      

                          if($_REQUEST['payment']=="1")
                                        {
                              $bilno= array(
                            new payment("Total","",number_format(array_sum($cash_final),$_SESSION['be_decimal']),number_format(array_sum($total_final),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

          }else if($_REQUEST['payment']=="2")
                {
              $bilno= array(
                            new payment("Total","",number_format(array_sum($card_final),$_SESSION['be_decimal']),number_format(array_sum($total_final),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

          } else if($_REQUEST['payment']=="3")
                {
               $bilno= array(
                            new payment("Total","",number_format(array_sum($coupon_final),$_SESSION['be_decimal']),number_format(array_sum($total_final),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }


          } else if($_REQUEST['payment']=="4")
                {
              $bilno= array(
                            new payment("Total","",number_format(array_sum($voucher_final),$_SESSION['be_decimal']),number_format(array_sum($total_final),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

          } else if($_REQUEST['payment']=="5")
                {
              $bilno= array(
                            new payment("Total","",number_format(array_sum($cheq_final),$_SESSION['be_decimal']),number_format(array_sum($total_final),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

          } else if($_REQUEST['payment']=="6")
                {
               $bilno= array(
                            new payment("Total","",number_format(array_sum($credit_final),$_SESSION['be_decimal']),number_format(array_sum($total_final),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }

          }
          else if($_REQUEST['payment']=="7")
                {
               $bilno= array(
                            new payment("Total","",number_format(array_sum($compli_final),$_SESSION['be_decimal']),number_format(array_sum($total_final),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }
 
          }else if($_REQUEST['payment']=="8")
                {
              $bilno= array(
                            new payment("Total","",number_format(array_sum($upi_final),$_SESSION['be_decimal']),number_format(array_sum($total_final),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }




                } 
                else if($_REQUEST['payment']=="all")
                {
              $bilno= array(
                            new payment("Total","","",number_format(array_sum($total_final),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }




                } 
                 $print .= $left.$vv."\n";//ojin
                            }
                            
                            
                            
                             $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }

                                    
                                    
                                     $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                $print .="\n\n\n\n\n";         
                        $print.=$cutpaper;              

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

        else if(($_REQUEST['type']=="expense_acc_report"))
        {
                $string="";
                $stringev="";
                $stringsu="";
                $reporthead="";
                $stringln="";
                $stringasp="";
        
                        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " ev_date between '".$from."' and '".$to."' ";                      
                                $stringev.= " ev_date between '".$from."' and '".$to."' ";
                                $stringsu.= " sv_date between '".$from."' and '".$to."' ";
                                $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
                                $stringln.= "tla_date between '".$from."' and '".$to."' ";
                                $reporthead.= $from.' - '.$to;
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=date("Y-m-d");
                                $string.= " ev_date between '".$from."' and '".$to."' ";                    
                                $stringev.= " ev_date between '".$from."' and '".$to."' ";
                                $stringsu.= " sv_date between '".$from."' and '".$to."' ";
                                $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
                                $stringln.= "tla_date between '".$from."' and '".$to."' ";
                                $reporthead.= $from.' - '.$to; 
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " ev_date between '".$from."' and '".$to."' ";
                                $stringev.= " ev_date between '".$from."' and '".$to."' ";
                                $stringsu.= " sv_date between '".$from."' and '".$to."' ";
                                $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
                                $stringln.= "tla_date between '".$from."' and '".$to."' ";
                                 $reporthead.= $from.' - '.$to;
                        }
                else 
                {		
                        $bydatz=$_REQUEST['bydate'];
                if($bydatz!="null" && $bydatz!="")
                {
                        //$search="";
                if($bydatz=="Last5days")
                {
                        $string.=" ev_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";              
                        $stringev.=" ev_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";                
                        $stringsu.=" sv_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        $stringln.= "tla_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        //$reporthead.= "Last 5 days";
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                        
                }elseif($bydatz=="Last10days")
                {
                        $string.=" ev_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";                
                        $stringev.=" ev_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";                              
                        $stringsu.=" ev_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $stringln.= "tla_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                       // $reporthead.= "Last 10 days";
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                        
                }
                else if($bydatz=="Yesterday")
                                  {
                                          $string.=" ev_date = CURDATE() - INTERVAL 1 day";
                                           $stringev.=" ev_date = CURDATE() - INTERVAL 1 day";
                                            $stringsu.=" sv_date = CURDATE() - INTERVAL 1 day";
                                            $stringasp.=" tpd_date = CURDATE() - INTERVAL 1 day";
                                                $stringln.=" tla_date = CURDATE() - INTERVAL 1 day";
                                           //$reporthead.= "Yesterday ";
                                           $reporthead .= date("Y-m-d", strtotime("-1 day"));
                                  }
                elseif($bydatz=="Last15days")
                {
                        $string.=" ev_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $stringev.=" ev_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $stringsu.=" sv_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $stringln.= "tla_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                       //$reporthead.= "Last 15 days"; 
                       
                       $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-14 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                       
                }
                else if($bydatz=="Last20days")
                {
                        $string.=" ev_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";                
                        $stringev.=" ev_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";               
                        $stringsu.=" sv_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )"; 
                        $stringln.= "tla_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )"; 
                       //$reporthead.= "Last 20 days";
                       $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-19 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                }
                else if($bydatz=="Last25days")
                {
                        $string.="ev_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $stringev.="ev_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $stringsu.="sv_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $stringasp.="tpd_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )"; 
                        $stringln.= "tla_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )"; 
                        //$reporthead.= "Last 25 days";
                       
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-24 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                }
                else if($bydatz=="Last30days")
                {
                        $string.="ev_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $stringev.="ev_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $stringsu.="sv_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $stringasp.="tpd_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )"; 
                        $stringln.= "tla_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )"; 
                        //$reporthead.= "Last 30 days";
                        
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-29 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                        
                        
                }
                 else if($bydatz=="Last1month")
                                  {
                                          $string.="ev_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                          $stringev.="ev_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                          $stringsu.=" sv_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                          $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                          $stringln.= "tla_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )"; 
                                       // $reporthead.= "Last 1 month"; 
                                        
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-1 month")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                                        
                                        
                                  }
                else if($bydatz=="Today")
                {
                        $string.="ev_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                        $stringev.="ev_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                        $stringsu.="sv_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                        $stringasp.="tpd_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                        $stringln.= "tla_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                        
                       //  $reporthead.= "Today"; 
                        
                       
                        $reporthead .= date("Y-m-d");
                         
                         
                }
        else if($bydatz=="Last90days")
                {
                        $string.="ev_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                        $stringev.="ev_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                       $stringsu.="sv_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                       $stringasp.="tpd_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";  
                        $stringln.= "tla_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";  
                       // $reporthead.= "Last 3 month"; 
                        
                        
                          $toDate = date("Y-m-d"); // today
                          $fromDate = date("Y-m-d", strtotime("-3 months"));
                          $reporthead .= "From $fromDate To $toDate";
                        
                }
        else if($bydatz=="Last180days")
                {
                        $string.="ev_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                        $stringev.="ev_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                        $stringsu.="sv_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringasp.="tpd_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                        $stringln.= "tla_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                        // $reporthead.= "Last 6 month"; 
                         
                           $toDate = date("Y-m-d"); // today
                          $fromDate = date("Y-m-d", strtotime("-6 months"));
                        $reporthead .= "From $fromDate To $toDate";
                         
                }
        else if($bydatz=="Last365days")
                {
                        $string.="ev_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                        $stringev.="ev_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                        $stringsu.="sv_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                        $stringasp.="tpd_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";  
                        $stringln.= "tla_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                        //$reporthead.= "Last 1 Year"; 
                        
                        
                          $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-364 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                }
        
                }
                else
                {
                        
                        
                        $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= "ev_date between '".$from."' and '".$to."' ";
                                $stringev.= "ev_date between '".$from."' and '".$to."' ";
                                $stringsu.= "sv_date between '".$from."' and '".$to."' ";
                                $stringasp.= "tpd_date between '".$from."' and '".$to."' ";
                                $stringln.= "tla_date between '".$from."' and '".$to."' ";
                               $reporthead.= $from.' - '.$to;
                }
                        
                
                }
                
                
                
                
               
                if($_REQUEST['from_ledger']!=''){
                    
                    $string.=    " and ev_from_acc = '".$_REQUEST['from_ledger']."'   " ;
                    
                    $stringsu.=     " and sv_from = '".$_REQUEST['from_ledger']."'   " ;
                     
                    $stringev.=    " and ev_from = '".$_REQUEST['from_ledger']."'   " ;
                    $stringasp.=     " and tpd_from_acc = '".$_REQUEST['from_ledger']."'   " ;
            
                    $stringln.=   " and tla_from = '".$_REQUEST['from_ledger']."'   " ; 
                    
                }
                
                
               
                if($_REQUEST['to_ledger']!=''){
                    
                    $string.=  " and ev_to_acc = '".$_REQUEST['to_ledger']."'   " ;
                    
                    $stringsu.=     " and sv_vendor_id = '".$_REQUEST['to_vendor']."'   " ;
                     
                    $stringev.=     " and ev_employee_id = '".$_REQUEST['to_staff']."'   " ;
                    $stringln.=   " and tla_to = '".$_REQUEST['to_ledger']."'   " ;
                    $stringasp.=     " and tpd_vendor = '".$_REQUEST['to_vendor']."'   " ;
                    
                }
                
                $print='';
                
                 $print .= $center.$bold_on." Expense  Report ".$bold_off."\n";
                 
                 
                  $print .= $center.$reporthead."\n";
                 
                  $print .= $left.$vv."\n";
                  
                  
                if($printer_style=='1'){
                                                    $vv=str_pad("-",  '47', "-");//46
        
                                                    }
                                                    else if($printer_style=='2'){
                                                         $vv=str_pad("-",  '42', "-");
                                                    }
                
                
                $bilno= array(
                                    new payment('Date','Acc(To)','Acc(From)','Amount',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
                
                
                  $print .= $left.$vv."\n";
                                    
        
                                          
                                        
                
                $final=0; $final1=0 ; $final2=0; $final3=0; $final4=0;
                
                if($_REQUEST['acc_type']==''){
                    
           /////////expense voucher////
                    
         $sql_logincashier  =  $database->mysqlQuery("select ev_date,ev_amount,ev_from_acc,ev_to_acc from tbl_expense_voucher  where $string"); 
          $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
           if($num_logincashier)
                {
               $bilno= array(
                                    new payment('Expense ','','','',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
        
               while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
               {
                   $final=$final+$result_hourly_wise['ev_amount'];
              
                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_from_acc']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                   
                                $from_acc=$result_login88['tlm_ledger_name'];
                                
                                               }}else{ 
                                                    
                                                    
                                                  $from_acc='';
                                                    
                                             } 
                                                    
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_to_acc']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                    $to_acc=$result_login88['tlm_ledger_name'];
                                                    
                                                   
                                                     
                                                }}  else{ 
                                                    
                                                 $to_acc='';
                                                    
                                               } 
                                                      
                              
                          $bilno= array(
                               new payment($result_hourly_wise['ev_date'],substr($to_acc,0,6),substr($from_acc,0,6),number_format($result_hourly_wise['ev_amount'],$_SESSION['be_decimal']),$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
               
               
               
                }}
                
                
                
                
                $final1=0;
                ///////supplier voucher///
                $sql_logincashier  =  $database->mysqlQuery("select sv_paid_amount,sv_from,sv_vendor_id,sv_date from tbl_supplier_voucher where sv_paid_amount>'0' and  $stringsu"); 
          $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
           if($num_logincashier)
                {
                 $print .= $left."\n";
               $bilno= array(
                                    new payment('Supplier ','','','',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
               while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
               {
                   $p++;
                                        $final1=$final1+$result_hourly_wise['sv_paid_amount'];
                
                                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['sv_from']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                   
                              $from_acc=$result_login88['tlm_ledger_name'];
                                                }}else{ 
                                                 $from_acc='';
                                                    
                                                }   
                       
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['sv_vendor_id']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                {                                           
                                                    $to_acc=$result_login88['tlm_ledger_name'];
                                                }} else{ 
        
                                                 $to_acc='';
                                                    
                                              } 
        
            $bilno= array(
                               new payment($result_hourly_wise['sv_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['sv_paid_amount'],$_SESSION['be_decimal']),$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
            
                }}
                
                 
                
                
                $final2=0;
            ///////employee voucher///
          $sql_logincashier  =  $database->mysqlQuery("select ev_date,ev_amount,ev_from,ev_employee_id from tbl_employee_voucher where $stringev"); 
          $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
           if($num_logincashier)
                {
               $print .= $left."\n";
               $bilno= array(
                                    new payment('Employee ','','','',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }  
               while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
               {
                   $p++;
                                        $final2=$final2+$result_hourly_wise['ev_amount'];
                                       
                  
                                                      
                                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_from']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                   
                             $from_acc=$result_login88['tlm_ledger_name'];
                                               }}else{ 
                                                    
                                                    
                                                $from_acc='';
                                                    
                                               }   
                                                
                                                
                                                      
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_staff_id='".$result_hourly_wise['ev_employee_id']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                   $to_acc=$result_login88['tlm_ledger_name'];
                                                 }}  else{ 
                                                    
                                                    
                                                 $to_acc='';   
                                                    
                                                }  
            
            $bilno= array(
                               new payment($result_hourly_wise['ev_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['ev_amount'],$_SESSION['be_decimal']),$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
            
            
                }}
        
        
                $final3=0;
                ///////loan voucher///
              $sql_logincashier  =  $database->mysqlQuery("select tla_date,tla_amount,tla_from,tla_to from tbl_loan_advance where tla_amount!='' and $stringln"); 
              $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
               if($num_logincashier)
                    {
                   $print .= $left."\n";
                   $bilno= array(
                                        new payment('Loan ','','','',$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                            $print .=$left.($bilno);
                                            }  
                   while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
                   {
                       $p++;
                     $final3=$final3+$result_hourly_wise['tla_amount'];
                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tla_from']."'  "); 
                    
                                                      $num_login88   = $database->mysqlNumRows($sql_login88);
                                                    if($num_login88){
                                                       
                                                    while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                    { 
                                                       
                                 $from_acc=$result_login88['tlm_ledger_name'];
                                                   }}else{ 
                                                        
                                                        
                                                    $from_acc='';
                                                        
                                                   }   
                                                    
                                                    
                                                          
                                       $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tla_to']."'  "); 
                    
                                                      $num_login88   = $database->mysqlNumRows($sql_login88);
                                                    if($num_login88){
                                                       
                                                    while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                    { 
                                                       $to_acc=$result_login88['tlm_ledger_name'];
                                                     }}  else{ 
                                                        
                                                        
                                                     $to_acc='';   
                                                        
                                                    }  
                
                $bilno= array(
                                   new payment($result_hourly_wise['tla_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['tla_amount'],$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                            $print .=$left.($bilno);
                                            }
                
                
                    }}
                
                    $final4=0;
                    ///////asset purchase voucher///
                  $sql_logincashier  =  $database->mysqlQuery("select  tpd_vendor,tpd_paid_amount,tpd_date,tpd_from_acc from tbl_asset_purchase_invoice_detail  where  tpd_paid_amount>'0' and $stringasp"); 
                  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
                   if($num_logincashier)
                        {
                       $print .= $left."\n";
                       $bilno= array(
                                            new payment('Asset Sup ','','','',$printer_style),
                                            );
                                            foreach($bilno as $bilno) {
                                                $print .=$left.($bilno);
                                                }  
                       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
                       {
                           $p++;
                         $final4=$final4+$result_hourly_wise['tpd_paid_amount'];
                       $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tpd_from_acc']."'  "); 
                        
                                                          $num_login88   = $database->mysqlNumRows($sql_login88);
                                                        if($num_login88){
                                                           
                                                        while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                        { 
                                                           
                                     $from_acc=$result_login88['tlm_ledger_name'];
                                                       }}else{ 
                                                            
                                                            
                                                        $from_acc='';
                                                            
                                                       }   
                                                        
                                                        
                                                              
                                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['tpd_vendor']."'  "); 
                        
                                                          $num_login88   = $database->mysqlNumRows($sql_login88);
                                                        if($num_login88){
                                                           
                                                        while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                        { 
                                                           $to_acc=$result_login88['tlm_ledger_name'];
                                                         }}  else{ 
                                                            
                                                            
                                                         $to_acc='';   
                                                            
                                                        }  
                    
                    $bilno= array(
                                       new payment($result_hourly_wise['tpd_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['tpd_paid_amount'],$_SESSION['be_decimal']),$printer_style),
                                            );
                                            foreach($bilno as $bilno) {
                                                $print .=$left.($bilno);
                                                }
                    
                    
                        }}
                
                }else if($_REQUEST['acc_type']=='exp_acc'){
                
               
                
           /////////expense voucher////
          $sql_logincashier  =  $database->mysqlQuery("select ev_amount,ev_from_acc,ev_to_acc,ev_date from tbl_expense_voucher  where $string"); 
          $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
           if($num_logincashier)
                {  $print .= $left."\n";
               $bilno= array(
                                    new payment('Expense','','','',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
               while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
               {
                  
                                        $final=$final+$result_hourly_wise['ev_amount'];
                  
                                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_from_acc']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                   
                                 $from_acc=$result_login88['tlm_ledger_name'];
                                               }}else{ 
                                                    
                                                    
                                                 $from_acc='';
                                                    
                                                }   
                                                
                                                
                                                      
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_to_acc']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                    
                                                    $to_acc=$result_login88['tlm_ledger_name'];
                                               }} else{
                                                    
                                                    
                                                 $to_acc='';
                                                    
                                            }  
             $bilno= array(
                               new payment($result_hourly_wise['ev_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['ev_amount'],$_SESSION['be_decimal']),$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
            
            
                }}
                
                
                }else if($_REQUEST['acc_type']=='sup_acc'){
                    
                     $print .= $left."\n";
                    
                      ///////supplier voucher///
                $sql_logincashier  =  $database->mysqlQuery("select sv_paid_amount,sv_from,sv_vendor_id,sv_date from tbl_supplier_voucher where  sv_paid_amount>'0' and $stringsu"); 
        
        
          $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
           if($num_logincashier)
                {  $bilno= array(
                                    new payment('Supplier ','','','',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
               while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
               {
                   $p++;
                                        $final1=$final1+$result_hourly_wise['sv_paid_amount'];
                                       
                  
                  
                                                      
                                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['sv_from']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                    
                               $from_acc=$result_login88['tlm_ledger_name'];
                                               }} else{ 
                                                    
                                                    
                                                 $from_acc='';
                                                    
                                                }  
                                                
                                                
                                                      
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['sv_vendor_id']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                   $to_acc=$result_login88['tlm_ledger_name'];
                                                }} else{ 
                                                    
                                                    
                                                 $to_acc='';
                                                    
                                               }  
            
             $bilno= array(
                               new payment($result_hourly_wise['sv_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['sv_paid_amount'],$_SESSION['be_decimal']),$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
            
                }}
                    
                    
                    
                }else if($_REQUEST['acc_type']=='emp_acc'){
                     $print .= $left."\n";
                    ///////employee voucher///
                $sql_logincashier  =  $database->mysqlQuery("select ev_amount,ev_from,ev_employee_id,ev_date from tbl_employee_voucher where $stringev"); 
        
        
          $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
           if($num_logincashier)
                {$bilno= array(
                                    new payment('Employee ','','','',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
               while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
               {
                   $p++;
                                        $final2=$final2+$result_hourly_wise['ev_amount'];
             
                                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_from']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                    
                                $from_acc=$result_login88['tlm_ledger_name'];
                                                }}else{ 
                                                    
                                                    
                                                 $from_acc='';
                                                    
                                                }   
                                                
                                                
                                                      
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_staff_id='".$result_hourly_wise['ev_employee_id']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                   
                                                    $to_acc=$result_login88['tlm_ledger_name'];
                                                }}  else{
                                                    
                                                    
                                                $to_acc='';
                                                    
                                               } 
                                
            $bilno= array(
                               new payment($result_hourly_wise['ev_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['ev_amount'],$_SESSION['be_decimal']),$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
            
                }}
                    
                }
        
                else if($_REQUEST['acc_type']=='loan_acc'){
                        $final3=0;
                        $print .= $left."\n";
                       ///////loan voucher///
                   $sql_logincashier  =  $database->mysqlQuery("select tla_date,tla_from,tla_to,tla_amount,tla_particulars  FROM `tbl_loan_advance` where tla_amount!='' and $stringln"); 
           
           
             $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
              if($num_logincashier)
                   { $bilno= array(
                                       new payment('Loan ','','','',$printer_style),
                                       );
                                       foreach($bilno as $bilno) {
                                           $print .=$left.($bilno);
                                           }
                  while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
                  {
                      $p++;
                     $final3=$final3+$result_hourly_wise['tla_amount'];
                
                                              $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tla_from']."'  "); 
                   
                                                     $num_login88   = $database->mysqlNumRows($sql_login88);
                                                   if($num_login88){
                                                      
                                                   while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                   { 
                                                       
                                   $from_acc=$result_login88['tlm_ledger_name'];
                                                   }}else{ 
                                                       
                                                       
                                                    $from_acc='';
                                                       
                                                   }   
                                                   
                                                   
                                                         
                                      $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tla_to']."'  "); 
                   
                                                     $num_login88   = $database->mysqlNumRows($sql_login88);
                                                   if($num_login88){
                                                      
                                                   while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                   { 
                                                      
                                                       $to_acc=$result_login88['tlm_ledger_name'];
                                                   }}  else{
                                                       
                                                       
                                                   $to_acc='';
                                                       
                                                  } 
                                   
               $bilno= array(
                                  new payment($result_hourly_wise['tla_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['tla_amount'],$_SESSION['be_decimal']),$printer_style),
                                       );
                                       foreach($bilno as $bilno) {
                                           $print .=$left.($bilno);
                                           }
               
                   }}
                       
                   }
        
                   else if($_REQUEST['acc_type']=='asset_acc'){
                        $final4=0;
                        $print .= $left."\n";
                       ///////loan voucher///
                   $sql_logincashier  =  $database->mysqlQuery("select tpd_vendor,tpd_paid_amount,tpd_date,tpd_from_acc,tpd_remarks from tbl_asset_purchase_invoice_detail  where  tpd_paid_amount>'0' and $stringasp"); 
           
           
             $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
              if($num_logincashier)
                   { $bilno= array(
                                       new payment('Asset Sup ','','','',$printer_style),
                                       );
                                       foreach($bilno as $bilno) {
                                           $print .=$left.($bilno);
                                           }
                  while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
                  {
                      $p++;
                     $final4=$final4+$result_hourly_wise['tla_amount'];
                
                                              $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tpd_from_acc']."'  "); 
                   
                                                     $num_login88   = $database->mysqlNumRows($sql_login88);
                                                   if($num_login88){
                                                      
                                                   while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                   { 
                                                       
                                   $from_acc=$result_login88['tlm_ledger_name'];
                                                   }}else{ 
                                                       
                                                       
                                                    $from_acc='';
                                                       
                                                   }   
                                                   
                                                   
                                                         
                                      $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['tpd_vendor']."'  "); 
                   
                                                     $num_login88   = $database->mysqlNumRows($sql_login88);
                                                   if($num_login88){
                                                      
                                                   while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                   { 
                                                      
                                                       $to_acc=$result_login88['tlm_ledger_name'];
                                                   }}  else{
                                                       
                                                       
                                                   $to_acc='';
                                                       
                                                  } 
                                   
               $bilno= array(
                                  new payment($result_hourly_wise['tpd_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['tpd_paid_amount'],$_SESSION['be_decimal']),$printer_style),
                                       );
                                       foreach($bilno as $bilno) {
                                           $print .=$left.($bilno);
                                           }
               
                   }}
                       
                   }
            
         $print .= $left.$vv."\n";
        $bilno= array(
                                    new payment('Total','','',number_format(($final+$final1+$final2+$final3+$final4),$_SESSION['be_decimal']),$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
                                        
                                        
        $print .= $left.$vv."\n";
                           
        
         $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
        
                        $print .="\n\n\n\n\n";         
                                $print.=$cutpaper;              
        
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

        
else if(($_REQUEST['type']=="purchase_acc_report"))
{
        $stringsu="";
        $reporthead="";
        $stringasp="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
                        $stringsu.= " sv_date between '".$from."' and '".$to."' ";
                        $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
                        $reporthead.= $from.' - '.$to;
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");

                        $stringsu.= " sv_date between '".$from."' and '".$to."' ";
                        $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
                        $reporthead.= $from.' - '.$to; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);

                        $stringsu.= " sv_date between '".$from."' and '".$to."' ";
                        $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
                        $reporthead.= $from.' - '.$to;
		}
	else 
	{		
		$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	if($bydatz=="Last5days")
	{               
                $stringsu.=" sv_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                //$reporthead.= "Last 5 days";
                $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                
	}elseif($bydatz=="Last10days")
	{                             
                $stringsu.=" ev_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
               // $reporthead.= "Last 10 days";
                $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                
	}
	else if($bydatz=="Yesterday")
        {
                $stringsu.=" sv_date = CURDATE() - INTERVAL 1 day";
                $stringasp.=" tpd_date = CURDATE() - INTERVAL 1 day";
                //$reporthead.= "Yesterday";
                 $reporthead .= date("Y-m-d", strtotime("-1 day"));
	}
	elseif($bydatz=="Last15days")
	{
                $stringsu.=" sv_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
               $reporthead.= "Last 15 days"; 
	}
	else if($bydatz=="Last20days")
	{              
                $stringsu.=" sv_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )"; 
               $reporthead.= "Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringasp.="tpd_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )"; 
               $reporthead.= "Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringasp.="tpd_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )"; 
                $reporthead.= "Last 30 days";
	}
	 else if($bydatz=="Last1month")
	{
                $stringsu.=" sv_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) "; 
                $reporthead.= "Last 1 month"; 
	}
	else if($bydatz=="Today")
	{
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringasp.="tpd_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                //$reporthead.= "Today";    
                 $reporthead .= date("Y-m-d");
	}
        else if($bydatz=="Last90days")
	{
               $stringsu.="sv_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
               $stringasp.="tpd_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";  
               $reporthead.= "Last 3 month"; 
	}
        else if($bydatz=="Last180days")
	{
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringasp.="tpd_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $reporthead.= "Last 6 month"; 
	}
        else if($bydatz=="Last365days")
	{
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringasp.="tpd_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";  
                $reporthead.= "Last 1 Year"; 
	}
	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
                $stringsu.= "sv_date between '".$from."' and '".$to."' ";
                $stringasp.= "tpd_date between '".$from."' and '".$to."' ";
                $reporthead.= $from.' - '.$to;
	}

	}

        if($_REQUEST['from_ledger']!=''){           
            $stringsu.=     " and sv_from = '".$_REQUEST['from_ledger']."'   " ;
            $stringasp.=     " and tpd_from_acc = '".$_REQUEST['from_ledger']."'   " ;
        }

        if($_REQUEST['to_ledger']!='')
        {
            $stringsu.=     " and sv_vendor_id = '".$_REQUEST['to_vendor']."'   " ;
            $stringasp.=     " and tpd_vendor = '".$_REQUEST['to_vendor']."'   " ;
        }
        
        $print='';
        
         $print .= $center.$bold_on." Purchase  Report ".$bold_off."\n";
         
          $print .= $center.$reporthead."\n";
        if($printer_style=='1'){
                                            $vv=str_pad("-",  '47', "-");//46

                                            }
                                            else if($printer_style=='2'){
                                                 $vv=str_pad("-",  '42', "-");
                                            }
        
        
        $bilno= array(
                            new payment('Date','Acc(To)','(From)','Amount',$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }
        
        
          $print .= $left.$vv."\n";
                            

                                  
                                
        
         $final1=0 ; $final2=0; 
        
if($_REQUEST['pur_acc_type']==''){
            
        $final1=0;
        ///////supplier voucher///
        $sql_logincashier  =  $database->mysqlQuery("select sv_paid_amount,sv_from,sv_vendor_id,sv_date from tbl_supplier_voucher where sv_paid_amount>'0' and  $stringsu"); 
  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
         $print .= $left."\n";
       $bilno= array(
                            new payment('Supplier ','','','',$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                                $final1=$final1+$result_hourly_wise['sv_paid_amount'];
        
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['sv_from']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                           
                      $from_acc=$result_login88['tlm_ledger_name'];
                                        }}else{ 
                                         $from_acc='';
                                            
                                        }   
               
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['sv_vendor_id']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{                                           
                                            $to_acc=$result_login88['tlm_ledger_name'];
                                        }} else{ 

                                         $to_acc='';
                                            
                                      } 

    $bilno= array(
                       new payment($result_hourly_wise['sv_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['sv_paid_amount'],$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }
    
        }}
        

            $final2=0;
            ///////asset purchase voucher///
          $sql_logincashier  =  $database->mysqlQuery("select  tpd_vendor,tpd_paid_amount,tpd_date,tpd_from_acc from tbl_asset_purchase_invoice_detail  where  tpd_paid_amount>'0' and $stringasp"); 
          $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
           if($num_logincashier)
                {
               $print .= $left."\n";
               $bilno= array(
                                    new payment('Asset Sup ','','','',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }  
               while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
               {
                   $p++;
                $final2=$final2+$result_hourly_wise['tpd_paid_amount'];
               $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tpd_from_acc']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                   
                             $from_acc=$result_login88['tlm_ledger_name'];
                                               }}else{ 
                                                    
                                                    
                                                $from_acc='';
                                                    
                                               }   
                                                
                                                
                                                      
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['tpd_vendor']."'  "); 
                
                                                  $num_login88   = $database->mysqlNumRows($sql_login88);
                                                if($num_login88){
                                                   
                                                while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                                { 
                                                   $to_acc=$result_login88['tlm_ledger_name'];
                                                 }}  else{ 
                                                    
                                                    
                                                 $to_acc='';   
                                                    
                                                }  
            
            $bilno= array(
                               new payment($result_hourly_wise['tpd_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['tpd_paid_amount'],$_SESSION['be_decimal']),$printer_style),
                                    );
                                    foreach($bilno as $bilno) {
                                        $print .=$left.($bilno);
                                        }
            
            
                }}
        
        }
        else if($_REQUEST['pur_acc_type']=='sup_acc'){
                $final1=0;
             $print .= $left."\n";
            
              ///////supplier voucher///
        $sql_logincashier  =  $database->mysqlQuery("select sv_paid_amount,sv_from,sv_vendor_id,sv_date from tbl_supplier_voucher where  sv_paid_amount>'0' and $stringsu"); 


  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{  $bilno= array(
                            new payment('Supplier ','','','',$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                                $final1=$final1+$result_hourly_wise['sv_paid_amount'];
                               
          
          
                                              
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['sv_from']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            
                       $from_acc=$result_login88['tlm_ledger_name'];
                                       }} else{ 
                                            
                                            
                                         $from_acc='';
                                            
                                        }  
                                        
                                        
                                              
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['sv_vendor_id']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                           $to_acc=$result_login88['tlm_ledger_name'];
                                        }} else{ 
                                            
                                            
                                         $to_acc='';
                                            
                                       }  
    
     $bilno= array(
                       new payment($result_hourly_wise['sv_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['sv_paid_amount'],$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }
    
        }}
            
            
            
        }

           else if($_REQUEST['pur_acc_type']=='asset_acc'){
                $final2=0;
                $print .= $left."\n";
               ///////loan voucher///
           $sql_logincashier  =  $database->mysqlQuery("select tpd_vendor,tpd_paid_amount,tpd_date,tpd_from_acc,tpd_remarks from tbl_asset_purchase_invoice_detail  where  tpd_paid_amount>'0' and $stringasp"); 
   
   
     $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
      if($num_logincashier)
           { $bilno= array(
                               new payment('Asset Sup ','','','',$printer_style),
                               );
                               foreach($bilno as $bilno) {
                                   $print .=$left.($bilno);
                                   }
          while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
          {
              $p++;
             $final2=$final2+$result_hourly_wise['tpd_paid_amount'];
        
                                      $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tpd_from_acc']."'  "); 
           
                                             $num_login88   = $database->mysqlNumRows($sql_login88);
                                           if($num_login88){
                                              
                                           while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                           { 
                                               
                           $from_acc=$result_login88['tlm_ledger_name'];
                                           }}else{ 
                                               
                                               
                                            $from_acc='';
                                               
                                           }   
                                           
                                           
                                                 
                              $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['tpd_vendor']."'  "); 
           
                                             $num_login88   = $database->mysqlNumRows($sql_login88);
                                           if($num_login88){
                                              
                                           while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                           { 
                                              
                                               $to_acc=$result_login88['tlm_ledger_name'];
                                           }}  else{
                                               
                                               
                                           $to_acc='';
                                               
                                          } 
                           
       $bilno= array(
                          new payment($result_hourly_wise['tpd_date'],substr($to_acc,0,8),substr($from_acc,0,8),number_format($result_hourly_wise['tpd_paid_amount'],$_SESSION['be_decimal']),$printer_style),
                               );
                               foreach($bilno as $bilno) {
                                   $print .=$left.($bilno);
                                   }
       
           }}
               
           }
    
 $print .= $left.$vv."\n";
$bilno= array(
                            new payment('Total','','',number_format(($final1+$final2),$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }
                                
                                
$print .= $left.$vv."\n";
                            
 $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }


                $print .="\n\n\n\n\n";         
                        $print.=$cutpaper;              

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
        
        
        else if(($_REQUEST['type']=="consolidated_cancel_report"))
        {
                $string="";
                $stringta="";
                $mode="";
                $reporthead="";
                $mode=$_REQUEST['department'];
                if($mode==""){
                    $mode1="Consolidated";
                }
                else{
                    $mode1=$mode;
                }

                        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " ch_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tc_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead.= " From-".$from."- To-".$to." ";
                        }
                        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                        {
                                $from=$database->convert_date($_REQUEST['fromdt']);
                                $to=date("Y-m-d");
                                $string.= " ch_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tc_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead.= " From".$from."- To-".$to." ";
                        }
                        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                        {
                                $from=date("Y-m-d");
                                $to=$database->convert_date($_REQUEST['todt']);
                                $string.= " ch_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= " tc_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead.= " From".$from."- To-".$to." ";
                        }


                else
                {

                        $bydatz=$_REQUEST['bydate'];



                if($bydatz!="null" && $bydatz!="")
                {
                        //$search="";

                if($bydatz=="Last5days")
                {
                        $string.="ch_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        $stringta.="tc_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        //$reporthead="Last 5 days";
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                        
                        
                }elseif($bydatz=="Last10days")
                {
                        $string.="ch_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $stringta.="tc_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                       // $reporthead="Last 10 days";
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.="ch_dayclosedate = CURDATE() - INTERVAL 1 day ";
                    $stringta.="tc_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
                    //$reporthead="Yesterday";
                     $reporthead .= date("Y-m-d", strtotime("-1 day"));
                }
                elseif($bydatz=="Last15days")
                {
                        $string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $stringta.="tc_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $reporthead="Last 15 days";
                }
                else if($bydatz=="Last20days")
                {
                        $string.=" ch_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $stringta.="tc_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $reporthead="Last 20 days";
                }
                else if($bydatz=="Last25days")
                {
                        $string.="ch_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $stringta.="tc_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $reporthead="Last 25 days";
                }
                else if($bydatz=="Last30days")
                {
                        $string.="ch_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $stringta.="tc_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $reporthead="Last 30 days";
                }
                else if($bydatz=="Last1month")
                {
                    $string.="ch_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta.="tc_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                    $reporthead="Last 1 Month";
                }
                else if($bydatz=="Today")
                {
                        $string.="ch_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                        $stringta.="tc_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                      //  $reporthead="Today";
                         $reporthead .= date("Y-m-d");
                }
                else if($bydatz=="Last90days")
                {
                        $string.="ch_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                        $stringta.="tc_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $reporthead="Last 90 days";
                }
                else if($bydatz=="Last180days")
                {
                        $string.="ch_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $stringta.="tc_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                        $reporthead="Last 6 Months";
                }
                else if($bydatz=="Last365days")
                {
                        $string.="ch_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                        $stringta.="tc_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $reporthead="Last 1 Year";
                }

                }
                else
                {


                        $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= "ch_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= "tc_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead.= " On -".$from;
                }
                }
                 $print .= $center.$bold_on."Item Cancel Report ".$bold_off."\n";
                 if($mode==""){
                                        $print .= $center.$bold_on."Consolidated ".$bold_off."\n";
                                        $print.=$center.$reporthead."\n";
                                        }
                                        else{
                                            $print .= $center.$bold_on.$mode.$bold_off."\n";
                                              $print.=$center.$reporthead."\n";
                                        }

                                 if($printer_style=='1'){
                                            $vv=str_pad("-",  '42', "-");//46

                                            }
                                            else if($printer_style=='2'){
                                                 $vv=str_pad("-",  '42', "-");
                                            }
                                        $print .= $left.$vv."\n";
                                        $bilno= array(
                                                new itemcancel("KOT/Bill No"," ITEM","QTY",$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bold_on.$bilno.$bold_off);
                                        }
                                        $print .= $left.$vv."\n";//ojin


                ?>

                <?php
                $qtyall=0;


                $bill_order=array();
                $cancel_qty=array();
                $cancel_by  =array();     
                $cancel_time  =array();
                $cancel_reason=  array();
                $menu_all=  array();
                $cancel_kotno=array();
                  if($mode==''){
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
                      $sql_login1  =  $database->mysqlQuery("select ch_kot_cancel_id,ch_orderno,ch_cancelled_qty,ch_entrydate,mr_menuname,ser_firstname,cr_reason,ch_kotno from tbl_tableorder_changes tbo left join tbl_staffmaster ts on ts.ser_staffid=tbo.ch_cancelledby_careof left join tbl_cancellation_reasons tcr on tcr.cr_id=tbo.ch_cancelledreason left join tbl_tableorder to1 on to1.ter_orderno=tbo.ch_orderno and to1.ter_slno=tbo.ch_orderslno left join tbl_menumaster tm on tm.mr_menuid=to1.ter_menuid where $string and tbo.ch_combo_pack_cancelled_qty IS  NULL order by ch_entrydate asc "); 
             // echo "select *,mr_menuname,ser_firstname,cr_reason from tbl_tableorder_changes tbo left join tbl_staffmaster ts on ts.ser_staffid=tbo.ch_cancelledby_careof left join tbl_cancellation_reasons tcr on tcr.cr_id=tbo.ch_cancelledreason left join tbl_tableorder to1 on to1.ter_orderno=tbo.ch_orderno and to1.ter_slno=tbo.ch_orderslno left join tbl_menumaster tm on tm.mr_menuid=to1.ter_menuid where $string ";
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


                  $sql_loginta1  =  $database->mysqlQuery("select tc_cancel_id,tc_billno,tc_cancel_qty,mr_menuname,tc_cancel_kotno,tc_cancelled_time,ser_firstname,cr_reason from   tbl_takeaway_cancel_items tbc left join tbl_staffmaster ts on ts.ser_staffid=tbc.tc_cancelled_by left join tbl_cancellation_reasons tcr on tcr.cr_id=tbc.tc_reason left join tbl_takeaway_billdetails tbdw on tbdw.tab_billno=tbc.tc_billno and tbdw.tab_slno=tbc.tc_bill_slno left join tbl_menumaster tm on tm.mr_menuid=tbdw.tab_menuid where $stringta and  tbc.tc_combo_pack_cancelled_qty IS NULL order by tc_cancelled_time asc "); 

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
                          $cancel_by2=substr($result_loginta1['ser_firstname'],0,8);
                         $cancel_time2=substr($result_loginta1['tc_cancelled_time'],0,10);  

                         if($result_loginta1['tc_cancel_kotno']!=""){
                              $kotno1=$result_loginta1['tc_cancel_kotno'];
                         }else{
                              $kotno1=$result_loginta1['tc_billno'];
                         }

                        $bilno= array(
                            new itemcancel($kotno1,$menu1,$cancel_qty2,$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }
                             //   $print .= $left.$vv."\n";
                    }
                  }
                  }
                if($mode=='DI'){
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

                            $bill_order[]=$result_combo['ch_orderno'];
                            $cancel_qty[]=$result_combo['ch_combo_pack_cancelled_qty'];
                            $cancel_by[]=substr($result_combo['ser_firstname'],0,8);
                            $cancel_time[]=substr($result_combo['ch_entrydate'],0,10);
                            $cancel_reason[]=$result_combo['cr_reason'];
                            $menu_all[]=substr($result_combo['combo'],0,20);
                            $cancel_kotno[]=$result_combo['ch_kotno'];


                        }
                    }
                $sql_login  =  $database->mysqlQuery("select ch_orderno,ch_kotno,ch_entrydate,ch_cancelled_qty,ser_firstname,mr_menuname,cr_reason from tbl_tableorder_changes tbo left join tbl_staffmaster ts on ts.ser_staffid=tbo.ch_cancelledby_careof left join tbl_cancellation_reasons tcr on tcr.cr_id=tbo.ch_cancelledreason left join tbl_tableorder to1 on to1.ter_orderno=tbo.ch_orderno and to1.ter_slno=tbo.ch_orderslno left join tbl_menumaster tm on tm.mr_menuid=to1.ter_menuid where $string and tbo.ch_combo_pack_cancelled_qty IS  NULL order by ch_entrydate asc "); 


                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login)
                  {
                      while($result_login= $database->mysqlFetchArray($sql_login))
                      {
                        $bill_order[]=$result_login['ch_orderno'];
                        $cancel_qty[]=$result_login['ch_cancelled_qty'];
                        $cancel_reason[]=$result_login['cr_reason'];
                        $cancel_by[]=substr($result_login['ser_firstname'],0,8);
                        $cancel_time[]=substr($result_login['ch_entrydate'],0,10);   
                        $menu_all[]=substr($result_login['mr_menuname'],0,20);
                        $cancel_kotno[]=$result_login['ch_kotno'];        
                    }
                  }
                }
                if($mode=='TA'||$mode=='HD'||$mode=='CS'){
                    $sql_combo  =  $database->mysqlQuery("select CONCAT(cn.cn_name,' ',cp.cp_pack_name) as combo, ci.*,ts.ser_firstname,cr_reason,bm.tab_mode as mode
                                                        FROM tbl_combo_bill_details_ta cbd 
                                                        left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                        left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                        left join tbl_takeaway_billdetails tb on tb.tab_count_combo_ordering=cbd.cbd_count_combo_ordering
                                                        left join  tbl_takeaway_billmaster bm on bm.tab_billno = tb.tab_billno, tbl_takeaway_cancel_items ci 
                                                        left join tbl_staffmaster ts on ts.ser_staffid=ci.tc_cancelled_by
                                                        left join tbl_cancellation_reasons tcr on tcr.cr_id=ci.tc_reason
                                                        where bm.tab_mode='$mode' and  $stringta  and ci.tc_billno=tb.tab_billno and ci.tc_bill_slno=tb.tab_slno 
                                                        group by cbd.cbd_count_combo_ordering,cbd.cbd_billno, ci.tc_cancel_id order by CAST(ci.tc_cancel_id  AS UNSIGNED) asc"); 



                    $num_combo   = $database->mysqlNumRows($sql_combo);
                    if($num_combo){
                        while($result_combo= $database->mysqlFetchArray($sql_combo)){    


                            $bill_order[]=$result_combo['tc_billno'];
                            $cancel_qty[]=$result_combo['tc_combo_pack_cancelled_qty'];
                            $cancel_by[]=substr($result_combo['ser_firstname'],0,8);
                            $cancel_time[]=substr($result_combo['ch_entrydate'],0,10);
                            $cancel_reason[]=$result_combo['cr_reason'];
                            $menu_all[]=substr($result_combo['combo'],0,20);
                            if($result_combo['tc_cancel_kotno']!=""){
                                $cancel_kotno[]=$result_combo['tc_cancel_kotno'];
                            }else{
                                $cancel_kotno[]=$result_combo['tc_billno']; 
                            }
                        }
                    }
                   $sql_loginta  =   $database->mysqlQuery("select tc_billno,tc_cancel_qty,mr_menuname,ser_firstname,cr_reason,tc_cancelled_time,tc_cancel_kotno from   tbl_takeaway_cancel_items tbc left join tbl_staffmaster ts on ts.ser_staffid=tbc.tc_cancelled_by left join tbl_cancellation_reasons tcr on tcr.cr_id=tbc.tc_reason left join tbl_takeaway_billdetails tbdw on tbdw.tab_billno=tbc.tc_billno and tbdw.tab_slno=tbc.tc_bill_slno left join tbl_menumaster tm on tm.mr_menuid=tbdw.tab_menuid where tc_mode='$mode' and $stringta  and  tbc.tc_combo_pack_cancelled_qty IS NULL order by tc_cancelled_time asc "); 

                $num_loginta   = $database->mysqlNumRows($sql_loginta);
                if($num_loginta)
                  {
                      while($result_loginta= $database->mysqlFetchArray($sql_loginta))
                      {

                        $bill_order[]=$result_loginta['tc_billno'];
                        $cancel_qty[]=$result_loginta['tc_cancel_qty'];
                        $cancel_by[]=substr($result_loginta['ser_firstname'],0,8);
                        $cancel_time[]=substr($result_loginta['tc_cancelled_time'],0,10);
                        $cancel_reason[]=$result_loginta['cr_reason'];
                        $menu_all[]=substr($result_loginta['mr_menuname'],0,20);
                        if($result_loginta['tc_cancel_kotno']!=""){
                            $cancel_kotno[]=$result_loginta['tc_cancel_kotno'];
                        }else{
                            $cancel_kotno[]=$result_loginta['tc_billno']; 
                        }
                    }
                  }
                }

                for ($i=0;$i<count($bill_order);$i++){


                    $bilno= array(
                            new itemcancel($cancel_kotno[$i],$menu_all[$i],$cancel_qty[$i],$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                }


                }
                
                
                 $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                         $print .="\n\n\n\n\n";         
                        $print.=$cutpaper;              

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

        else if(($_REQUEST['type']=="most_revenue_generated_item_cr"))
        {
                 $print="";               
                $string="";
        $stringta="";
        $string_combo="";
        $stringta_combo="";
        $mode="";
        $mode=$_REQUEST['department'];
        if($mode==""){
            $mode1="Consolidated";
        }
        else{
            $mode1=$mode;
        }
	$string=" bm.bm_status='Closed' AND bm.bm_complimentary!='Y' and ";
        $string_combo=" bm.bm_status='Closed' AND bm.bm_complimentary!='Y' and ";
        
        if($mode=='TA'|| $mode=='HD'||$mode=='CS'){
          $stringta.= " tbm.tab_mode='".$mode."' and ";
          $stringta_combo.= " tbm.tab_mode='".$mode."' and ";
        }
	$stringta.=" tbm.tab_status='Closed' AND tbm.tab_complimentary!='Y' and ";
        $stringta_combo.=" tbm.tab_status='Closed' AND tbm.tab_complimentary!='Y' and ";
        $reporthead="";
	
	
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From-".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " cbd.cbd_dayclosedate '".$from."' and '".$to."' ";
                        $stringta_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= " cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
                
	
	else
	{
		
		$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                //$reporthead="Last 5 days";
                $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
                
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                //$reporthead="Last 10 days";
                
                $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $reporthead .= "From $fromDate To $toDate";
	}
	else if($bydatz=="Yesterday")
	{
            $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day ";
            $stringta.="tbm.tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
            $string_combo.="cbd.cbd_dayclosedate = CURDATE() - INTERVAL 1 day ";
            $stringta_combo.="cbd.cbd_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
            //$reporthead="Yesterday";
             $reporthead .= date("Y-m-d", strtotime("-1 day"));
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $string_combo.=" cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $reporthead="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $string_combo.=" cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $reporthead="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $reporthead="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $reporthead="Last 30 days";
	}
	else if($bydatz=="Last1month")
	{
            $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
            $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
            $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
            $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
            $reporthead="Last 1 Month";
	}
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
               // $reporthead="Today";
                 $reporthead .= date("Y-m-d");
	}
        else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $reporthead="Last 90 days";
	}
        else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $reporthead="Last 6 Months";
	}
        else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $reporthead="Last 1 Year";
	}

	}
        else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= "tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= "cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= "cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " On -".$from;
	}
        }


                $menu_qty=array();
                $menu_name=array();
                $menu_rate=array();
                if($mode==""||$mode=='DI'){
                 $sql_login_combo  =  $database->mysqlQuery("select  distinct(cbd.cbd_billno) as bill,sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $string_combo
                                                    group by cbd.cbd_combo_pack_id"); 
            
                $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
                if($num_login_combo)
                {$i=0;
                    while($result_login_combo= $database->mysqlFetchArray($sql_login_combo))
                    {$i++;
                          $menu_name[$result_login_combo['menuid']]=$result_login_combo['menu'];

                          if(array_key_exists($result_login_combo['menuid'],$menu_qty)){
                          $menu_qty[$result_login_combo['menuid']]=$menu_qty[$result_login_combo['menuid']]+$result_login_combo['qty'];
                          }
                          else{
                              $menu_qty[$result_login_combo['menuid']]=$result_login_combo['qty'];
                          }
                          if(array_key_exists($result_login_combo['menuid'],$menu_rate)){
                          $menu_rate[$result_login_combo['menuid']]=$menu_rate[$result_login_combo['menuid']]+$result_login_combo['total'];
                          }
                          else{
                             $menu_rate[$result_login_combo['menuid']]=$result_login_combo['total']; 
                          }
                    }
                }   
                $sql_login  =  $database->mysqlQuery("select distinct(bd.bd_menuid)as menuid,mr.mr_menuname as menu,sum(bd.bd_qty) as totqty,sum(bd.bd_amount) as totamt from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno left join tbl_menumaster mr on mr.mr_menuid=bd.bd_menuid where $string AND bd.bd_count_combo_ordering IS NULL group by bd.bd_menuid order by totamt  DESC "); 
             
                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login)
                  {$i=0;
                      while($result_login= $database->mysqlFetchArray($sql_login))
                      {$i++;
                          $menu_name[$result_login['menuid']]=$result_login['menu'];

                          if(array_key_exists($result_login['menuid'],$menu_qty)){
                          $menu_qty[$result_login['menuid']]=$menu_qty[$result_login['menuid']]+$result_login['totqty'];
                          }
                          else{
                              $menu_qty[$result_login['menuid']]=$result_login['totqty'];
                          }
                          if(array_key_exists($result_login['menuid'],$menu_rate)){
                          $menu_rate[$result_login['menuid']]=$menu_rate[$result_login['menuid']]+$result_login['totamt'];
                          }
                          else{
                             $menu_rate[$result_login['menuid']]=$result_login['totamt']; 
                          }
                    }
                  }
                }
                if($mode==""||$mode=='TA'||$mode=='HD'||$mode=='CS'){
                $sql_loginta_combo  =  $database->mysqlQuery("select  distinct(cbd.cbd_billno) as bill,sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $stringta_combo
                                                    group by cbd.cbd_combo_pack_id "); 
        
                $num_loginta_combo   = $database->mysqlNumRows($sql_loginta_combo);
                if($num_loginta_combo)
                {$j=0;
                    while($result_loginta_combo= $database->mysqlFetchArray($sql_loginta_combo))
                    {$j++;
                          $menu_name[$result_loginta_combo['menuid']]=$result_loginta_combo['menu'];

                          if(array_key_exists($result_loginta_combo['menuid'],$menu_qty)){
                          $menu_qty[$result_loginta_combo['menuid']]=$menu_qty[$result_loginta_combo['menuid']]+$result_loginta_combo['qty'];
                          }
                          else{
                              $menu_qty[$result_loginta_combo['menuid']]=$result_loginta_combo['qty'];
                          }
                          if(array_key_exists($result_loginta_combo['menuid'],$menu_rate)){
                          $menu_rate[$result_loginta_combo['menuid']]=$menu_rate[$result_loginta_combo['menuid']]+$result_loginta_combo['total'];
                          }
                          else{
                             $menu_rate[$result_loginta_combo['menuid']]=$result_loginta_combo['total']; 
                          }
                    }
                }     
                  $sql_loginta  =  $database->mysqlQuery("select distinct(tbd.tab_menuid)as menuid,mr.mr_menuname as menu,sum(tbd.tab_qty) as totqty,sum(tbd.tab_amount) as totamt from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mr on mr.mr_menuid=tbd.tab_menuid where $stringta AND tbd.tab_count_combo_ordering IS NULL group by tbd.tab_menuid order by totamt  DESC "); 
              
                $num_loginta   = $database->mysqlNumRows($sql_loginta);
                if($num_loginta)
                  {$j=0;
                      while($result_loginta= $database->mysqlFetchArray($sql_loginta))
                      {$j++;
                          $menu_name[$result_loginta['menuid']]=$result_loginta['menu'];

                          if(array_key_exists($result_loginta['menuid'],$menu_qty)){
                          $menu_qty[$result_loginta['menuid']]=$menu_qty[$result_loginta['menuid']]+$result_loginta['totqty'];
                          }
                          else{
                              $menu_qty[$result_loginta['menuid']]=$result_loginta['totqty'];
                          }
                          if(array_key_exists($result_loginta['menuid'],$menu_rate)){
                          $menu_rate[$result_loginta['menuid']]=$menu_rate[$result_loginta['menuid']]+$result_loginta['totamt'];
                          }
                          else{
                             $menu_rate[$result_loginta['menuid']]=$result_loginta['totamt']; 
                          }
                    }
                  }
                }
        //         $sorted_menu=array();
        //          $sorted_menu=arsort($menu_rate);  
                 // print_r($sorted_menu);
                  arsort($menu_rate);
                  $m=0;
                  $menurate_sum=0;
                  $menuquant_sum=0;
                  if(!empty($menu_rate)){
                                        if($mode==""){
                                        $print .= $center.$bold_on."Consolidated ".$bold_off."\n";
                                        }
                                        else{
                                            $print .= $center.$bold_on.$mode.$bold_off."\n";
                                        }
                                        $print .= $center.$bold_on."Most Revenue Generating Items ".$bold_off."\n";

                                        $print .= $center.$bold_on.$reporthead.$bold_off."\n";



                                        if($printer_style=='1'){
                                            $vv=str_pad("-",  '46', "-");//46

                                            }
                                            else if($printer_style=='2'){
                                                 $vv=str_pad("-",  '42', "-");
                                            }
                                        $print .= $left.$vv."\n";//ojin
                                        $bilno= array(
                                                new menulist2("Slno","        Menu","Qty","Amount",$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bold_on.$bilno.$bold_off);
                                        }
                                        $print .= $left.$vv."\n";//ojin

                  foreach($menu_rate as $key=>$val){
                      $m++;
                      if($m<=10)
                      { $menu_name1=$menu_name[$key];
                          if(strlen($menu_name1)>17){
                             $menu_name1=substr($menu_name1,0,17) ;
                          }

                          $menurate_sum=$menurate_sum+$menu_rate[$key];
                          $menuquant_sum=$menuquant_sum+$menu_qty[$key];
                          $bilno= array(
                            new menulist2($m,$menu_name1,$menu_qty[$key],number_format($menu_rate[$key],$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                $print .= $left."\n";//ojin
                            }

                  }}}
                  $print .= $left.$vv."\n";//ojin
                        $bilno= array(
                            new menulist2("Total","",$menuquant_sum,number_format($menurate_sum,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bold_on.$bilno.$bold_off);
                                }
                                $print .= $left.$vv."\n";//ojin
                                
                                
                                 $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                
                                $print .="\n\n\n\n\n";
                                $print.=$cutpaper;

                                        //And pr_floorid='".$florrid."'
                                if($menurate_sum>0){
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
        }   }    

        else if(($_REQUEST['type']=="hourlywise_report_cr"))
        {   $print=""; 
                $string="";
        $stringta="";
        $string_combo="";
        $stringta_combo="";
        $mode="";
        $days="";
        $days2="";
        $days1="";
        
        $fromtime=$_REQUEST['fromtime'];
        if($fromtime!=""){
        $newfromtime="'".date("H:i:s", strtotime($fromtime))."'";
        }
        else{
           $newfromtime="'00:00:00'"; 
        }
        
        $totime=$_REQUEST['totime'];
        if($totime!=""){
        $newtotime="'".date("H:i:s", strtotime($totime))."'";
        } 
        else{
          $newtotime  ="'23:59:59'";
        }
        $days=trim($_REQUEST['day'],",");
        if($days!=""){
         $days1=explode(',',$days);
        for($i=0;$i<count($days1);$i++){
        $days2.="'".$days1[$i]."',";    
        }
          $days2=trim($days2,",");
          
        if(($days2)!=""){
            $string .=" DAYNAME(bm.bm_billdate) IN ($days2) and  ";
            $stringta.="  DAYNAME(tbm.tab_date) IN ($days2) and ";
            $string_combo .=" DAYNAME(bm.bm_billdate) IN ($days2) and  ";
            $stringta_combo.="  DAYNAME(tbm.tab_date) IN ($days2) and ";
        }
       }
        
        $mode=$_REQUEST['department'];
        if($mode==""){
            $mode1="Consolidated";
        }
        else{
            $mode1=$mode;
        }
	$string.=" bm.bm_status='Closed'   ";
        $string_combo.=" bm.bm_status='Closed'   ";
        if($mode=='TA'|| $mode=='HD'||$mode=='CS'){
          $stringta.= " tbm.tab_mode='".$mode."' and ";
          $stringta_combo.= " tbm.tab_mode='".$mode."' and ";  
        }
	$stringta.=" tbm.tab_status='Closed'  ";
        $stringta_combo.=" tbm.tab_status='Closed'  ";
        $reporthead="";
	
	
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " and  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " and  cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= " and  cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From-".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " and  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " and  cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= " and  cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " and  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string_combo.= " and  cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta_combo.= " and  cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
                
	
	
        else
	{
		$from=date("Y-m-d");
                $to=date("Y-m-d");
                $string.= " and bm_dayclosedate between '".$from."' and '".$to."' ";
                $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                $string_combo.= " and cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                $stringta_combo.= " and cbd.cbd_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead.= " On -".$from;
	}




                $amount=array();
                $mode_name=array();
                $menu_qty=array();
                $menu_name=array();
                $menu_rate=array();

                if($mode=="" || $mode=='DI'){
                 $sql_login_combo  =  $database->mysqlQuery("select  distinct(cbd.cbd_billno) as billno,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as amount, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid,bm.bm_paymode as paymode,sum(bm.bm_finaltotal) as final,pm.pym_name as paymodename
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_paymentmode pm on pm.pym_id=bm.bm_paymode
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $string_combo and bm.bm_billtime between $newfromtime and $newtotime
                                                    group by cbd.cbd_combo_pack_id"); 
        
                $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
                if($num_login_combo)
                {$i=0; 
                    while($result_login_combo= $database->mysqlFetchArray($sql_login_combo))
                    {$i++;
                        $mode_name[$result_login_combo['paymode']]=$result_login_combo['paymodename'];

                          if(array_key_exists($result_login_combo['paymode'],$amount)){
                          $amount[$result_login_combo['paymode']]=$amount[$result_login_combo['paymode']]+$result_login_combo['final'];
                          }
                          else{
                              $amount[$result_login_combo['paymode']]=$result_login_combo['final'];
                          }

                          $menu_name[$result_login_combo['menuid']]=$result_login_combo['menu'];

                          if(array_key_exists($result_login_combo['menuid'],$menu_qty)){
                          $menu_qty[$result_login_combo['menuid']]=$menu_qty[$result_login_combo['menuid']]+$result_login_combo['qty'];
                          }
                          else{
                              $menu_qty[$result_login_combo['menuid']]=$result_login_combo['qty'];
                          }
                          if(array_key_exists($result_login_combo['menuid'],$menu_rate)){
                          $menu_rate[$result_login_combo['menuid']]=$menu_rate[$result_login_combo['menuid']]+$result_login_combo['amount'];
                          }
                          else{
                             $menu_rate[$result_login_combo['menuid']]=$result_login_combo['amount']; 
                          }
                    }
                }    
                $sql_login  =  $database->mysqlQuery("select bm_paymode,pm.pym_name,bm_finaltotal,bd.bd_menuid,mr.mr_menuname,mr_menuid,bd_qty,bd_amount from tbl_tablebillmaster bm left join tbl_paymentmode pm on pm.pym_id=bm.bm_paymode left join tbl_tablebilldetails bd on bd.bd_billno=bm.bm_billno left join tbl_menumaster mr on mr.mr_menuid=bd.bd_menuid where $string and bm.bm_billtime between $newfromtime and $newtotime and bd.bd_count_combo_ordering IS NULL  "); 
               
                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login)
                  {$i=0;
                      while($result_login= $database->mysqlFetchArray($sql_login))
                      {$i++;
                        if($result_login['bd_menuid']){
                          $mode_name[$result_login['bm_paymode']]=$result_login['pym_name'];

                          if(array_key_exists($result_login['bm_paymode'],$amount)){
                          $amount[$result_login['bm_paymode']]=$amount[$result_login['bm_paymode']]+$result_login['bm_finaltotal'];
                          }
                          else{
                              $amount[$result_login['bm_paymode']]=$result_login['bm_finaltotal'];
                          }

                          $menu_name[$result_login['mr_menuid']]=$result_login['mr_menuname'];

                          if(array_key_exists($result_login['mr_menuid'],$menu_qty)){
                          $menu_qty[$result_login['mr_menuid']]=$menu_qty[$result_login['mr_menuid']]+$result_login['bd_qty'];
                          }
                          else{
                              $menu_qty[$result_login['mr_menuid']]=$result_login['bd_qty'];
                          }
                          if(array_key_exists($result_login['mr_menuid'],$menu_rate)){
                          $menu_rate[$result_login['mr_menuid']]=$menu_rate[$result_login['mr_menuid']]+$result_login['bd_amount'];
                          }
                          else{
                             $menu_rate[$result_login['mr_menuid']]=$result_login['bd_amount']; 
                          }
                        }  
                    }
                  }
                }
                if($mode==""||$mode=='TA'||$mode=='HD'||$mode=='CS'){
                  $sql_loginta_combo  =  $database->mysqlQuery("select  distinct(cbd.cbd_billno) as billno,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as amount, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid,sum(tbm.tab_netamt) as final,tbm.tab_paymode as paymode,pm.pym_name as paymodename
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $stringta_combo and tbm.tab_time between $newfromtime and $newtotime
                                                    group by cbd.cbd_combo_pack_id "); 
        
                $num_loginta_combo   = $database->mysqlNumRows($sql_loginta_combo);
                if($num_loginta_combo)
                {$j=0;
                    while($result_loginta_combo= $database->mysqlFetchArray($sql_loginta_combo))
                    {$j++;
                          $mode_name[$result_loginta_combo['paymode']]=$result_loginta_combo['paymodename'];

                          if(array_key_exists($result_loginta_combo['paymode'],$amount)){
                          $amount[$result_loginta_combo['paymode']]=$amount[$result_loginta_combo['paymode']]+$result_loginta_combo['final'];
                          }
                          else{
                              $amount[$result_loginta_combo['paymode']]=$result_loginta_combo['final'];
                          }

                          $menu_name[$result_loginta_combo['menuid']]=$result_loginta_combo['menu'];

                          if(array_key_exists($result_loginta_combo['menuid'],$menu_qty)){
                          $menu_qty[$result_loginta_combo['menuid']]=$menu_qty[$result_loginta_combo['menuid']]+$result_loginta_combo['qty'];
                          }
                          else{
                              $menu_qty[$result_loginta_combo['menuid']]=$result_loginta_combo['qty'];
                          }
                          if(array_key_exists($result_loginta_combo['menuid'],$menu_rate)){
                          $menu_rate[$result_loginta_combo['menuid']]=$menu_rate[$result_loginta_combo['menuid']]+$result_loginta_combo['amount'];
                          }
                          else{
                             $menu_rate[$result_loginta_combo['menuid']]=$result_loginta_combo['amount']; 
                          }
                    }
                }  
                    
                    
                  $sql_loginta  =  $database->mysqlQuery("select tab_menuid,tab_paymode,pm.pym_name,tab_netamt,mr_menuid,mr_menuname,tab_qty,tab_amount from tbl_takeaway_billmaster tbm left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode left join tbl_takeaway_billdetails tbd on tbd.tab_billno=tbm.tab_billno left join tbl_menumaster mr on mr.mr_menuid=tbd.tab_menuid where $stringta and tbm.tab_time between $newfromtime and $newtotime and tbd.tab_count_combo_ordering IS NULL "); 
                $num_loginta   = $database->mysqlNumRows($sql_loginta);
                if($num_loginta)
                  {$j=0;
                      while($result_loginta= $database->mysqlFetchArray($sql_loginta))
                      {$j++;
                      if($result_loginta['tab_menuid']){
                          $mode_name[$result_loginta['tab_paymode']]=$result_loginta['pym_name'];

                          if(array_key_exists($result_loginta['tab_paymode'],$amount)){
                          $amount[$result_loginta['tab_paymode']]=$amount[$result_loginta['tab_paymode']]+$result_loginta['tab_netamt'];
                          }
                          else{
                              $amount[$result_loginta['tab_paymode']]=$result_loginta['tab_netamt'];
                          }

                          $menu_name[$result_loginta['mr_menuid']]=$result_loginta['mr_menuname'];

                          if(array_key_exists($result_loginta['mr_menuid'],$menu_qty)){
                          $menu_qty[$result_loginta['mr_menuid']]=$menu_qty[$result_loginta['mr_menuid']]+$result_loginta['tab_qty'];
                          }
                          else{
                              $menu_qty[$result_loginta['mr_menuid']]=$result_loginta['tab_qty'];
                          }
                          if(array_key_exists($result_loginta['mr_menuid'],$menu_rate)){
                          $menu_rate[$result_loginta['mr_menuid']]=$menu_rate[$result_loginta['mr_menuid']]+$result_loginta['tab_amount'];
                          }
                          else{
                             $menu_rate[$result_loginta['mr_menuid']]=$result_loginta['tab_amount']; 
                          }
                      }
                    }
                  }
                }
                $vv='';
                if(!empty($menu_rate)|| !empty($amount)){
                                        if($mode==""){
                                        $print .= $center.$bold_on."Consolidated ".$bold_off."\n";
                                        }
                                        else{
                                            $print .= $center.$bold_on.$mode.$bold_off."\n";
                                        }
                                        $print .= $center.$bold_on."Hourly Wise Report ".$bold_off."\n";

                                        $print .= $center.$bold_on.$reporthead.$bold_off."\n";
                                        $print .= $center.$bold_on."Between  ".trim($newfromtime,"'")."  and   ".trim($newtotime,"'").$bold_off."\n";



                                        if($printer_style=='1'){
                                            $vv=str_pad("-",  '46', "-");//46

                                            }
                                            else if($printer_style=='2'){
                                                 $vv=str_pad("-",  '42', "-");
                                            }
                                        $print .= $left.$vv."\n";//ojin
                }    
                    arsort($menu_rate);
                  $m=0;
                  $menurate_sum=0;
                  $menuquant_sum=0;
                  if(!empty($menu_rate)){

                                    $print .= $center.$bold_on."Item ordered Details ".$bold_off."\n";
                                    $print .= $left.$vv."\n";
                                    $bilno= array(
                                        new menulist2("Slno","    Menu","Qty","Amount",$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bold_on.$bilno.$bold_off);
                                        }
                                        $print .= $left.$vv."\n";//ojin

                        foreach($menu_rate as $key=>$val){
                      $m++;
                      $menu_name1=$menu_name[$key];
                          if(strlen($menu_name1)>15){
                             $menu_name1=substr($menu_name1,0,15) ;
                          }
                      $menurate_sum=$menurate_sum+$menu_rate[$key];
                      $menuquant_sum=$menuquant_sum+$menu_qty[$key];
                      $bilno= array(
                            new menulist2($m,$menu_name1,$menu_qty[$key],number_format($menu_rate[$key],$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                $print .= $left."\n";//ojin
                            }

            }
                        $print .= $left.$vv."\n";//ojin
                        $bilno= array(
                            new menulist2("Total","",$menuquant_sum,number_format($menurate_sum,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bold_on.$bilno.$bold_off);
                                }
                                $print .= $left.$vv."\n";//ojin

                  }

                  asort($mode_name);
                  $m=0;
                  $total_sum=0;
                   if(!empty($amount)){
                                        $print .= $center.$bold_on."Settlement Details ".$bold_off."\n";
                                        $print .= $left.$vv."\n";
                                        $bilno= array(
                                                new bilno("Mode of Settlement","Amount",$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bold_on.$bilno.$bold_off);
                                        }
                                        $print .= $left.$vv."\n";
                  foreach($mode_name as $key=>$val){
                      $m++;

                      $total_sum=$total_sum+$amount[$key];

                                    $bilno= array(
                                                new bilno($mode_name[$key],number_format($amount[$key],$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bilno);
                                        }

                            }
                            $print .= $left.$vv."\n";

                                        $bilno= array(
                                                new bilno("Total",number_format($total_sum,$_SESSION['be_decimal']),$printer_style),
                                        );
                                        foreach($bilno as $bilno) {
                                                $print .=$left.($bold_on.$bilno.$bold_off);
                                        }

                            }
                            $print .= $left.$vv."\n";
                            
                             $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                            
                            $print .="\n\n\n\n\n";
                            $print.=$cutpaper;
                         if($menurate_sum>0||$total_sum>0){
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
        else if(($_REQUEST['type']=="tips_collected_consolidated"))
            {       $print="";
                $reporthead='';
                $string="";
                $string=" bm_status='Closed' AND ";
                $stringta="";
                $stringta=" tab_status='Closed' AND tab_payment_settled='Y' AND ";
                $st= "";
                $view_mode='';
                $view_mode=$_REQUEST['modeofview'];
                        //echo $_REQUEST['fromdt'] ."--";
                        //echo $_REQUEST['todt'] ."<br>";
                if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                {
                        $from=$database->convert_date($_REQUEST['fromdt']);
                        $to=$database->convert_date($_REQUEST['todt']);
                        $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
                else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                {
                        $from=$database->convert_date($_REQUEST['fromdt']);
                        $to=date("Y-m-d");
                        $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                        $from=date("Y-m-d");
                        $to=$database->convert_date($_REQUEST['todt']);
                        $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
                else 
                {
                    $bydatz=$_REQUEST['bydate'];

                if($bydatz!="null" && $bydatz!="")
                {
                        //$search="";

                if($bydatz=="Last5days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                 // $st= " Last 5 days ";   
                  
                  $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-4 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                  
                }elseif($bydatz=="Last10days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                       // $st= " Last 10 days ";
                        
                        
                        $toDate = date("Y-m-d"); // today
                        $fromDate = date("Y-m-d", strtotime("-9 days")); // 10 days including today
                        $st .= "From $fromDate To $toDate";
                        
                }
                else if($bydatz=="Yesterday")
                                  {
                                          $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                            $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                            //$st= " YESTERDAY ";
                                             $st .= date("Y-m-d", strtotime("-1 day"));
                                  }
                elseif($bydatz=="Last15days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
        DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
        DAY AND CURDATE( )";
                        $st= " Last 15 days ";
                }
                else if($bydatz=="Last20days")
                {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
        DAY AND CURDATE( )";
                        $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
        DAY AND CURDATE( )";
                        $st= " Last 20 days ";
                }
                else if($bydatz=="Last25days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
        DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
        DAY AND CURDATE( )";
                        $st= " Last 25 days ";
                }
                else if($bydatz=="Last30days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
        DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
        DAY AND CURDATE( )";
                        $st= " Last 30 days ";
                }
                 else if($bydatz=="Last1month")
                                  {
                                          $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                           $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                           $st= " Last 1 Month ";
                                  }
                else if($bydatz=="Today")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                       // $st= " Today ";
                         $st .= date("Y-m-d");
                }
        else if($bydatz=="Last90days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                        $st= " Last 90 days ";
                }
        else if($bydatz=="Last180days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                        $st= " Last 180 days ";
                }
        else if($bydatz=="Last365days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                        $st= " Last 1 Year ";
                }
                $reporthead=$st;
                }
                else
                {


                        $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
                                $stringta.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead= " On ".$from;
                }


                }

                $tips_details=array();
                if($view_mode=='summary'){
                    $sql_tip  =  $database->mysqlQuery("select sum(tip) as tip,mode,date from(
                                                        select sum( bm_tips_given) as tip,bm_tips_mode as mode,bm_dayclosedate as date FROM tbl_tablebillmaster where $string group by bm_dayclosedate,bm_tips_mode   union all
                                                        select sum(tab_tips_given) as tip,tab_tips_mode as mode,tab_dayclosedate as date  FROM tbl_takeaway_billmaster  where $stringta group by tab_dayclosedate,tab_tips_mode
                                                        )x  group by mode,date order by date,mode");

                    $num_tip   = $database->mysqlNumRows($sql_tip);
                    if($num_tip)
                    {   
                        while($result_tip = $database->mysqlFetchArray($sql_tip)){

                            $tips_details[$result_tip['date']][$result_tip['mode']]=$result_tip['tip'];

                        }
                        $print .= $center.$bold_on."Consolidated ".$bold_off."\n";
                        $print .= $center.$bold_on."Tips Collected Report".$bold_off."\n";
                        $print .= $center.$bold_on.$reporthead.$bold_off."\n";
                        $print .= $left."\n";//ojin
                        
                        if($printer_style=='1'){
                            $vv=str_pad("-",  '46', "-");//46

                        }
                        else if($printer_style=='2'){
                             $vv=str_pad("-",  '42', "-");
                        }
                        
                        $bilno= array(
                             new tip("Slno","Cash","Card","Total",$printer_style),
                        );
                        foreach($bilno as $bilno) {
                            $print .=$left.($bold_on.$bilno.$bold_off);
                            $print .= $left.$vv."\n";//ojin
                        }
                        
                        $total_tip_cash=0;
                        $total_tip_card=0;
                        $total_tip=0;
                        foreach($tips_details as $key=>$val){
                            $total_tip_each_day=0;$i=0;
                            foreach($val as $key1=>$val1){
                                $total_tip_each_day=$total_tip_each_day+$val1;
                                $total_tip=$total_tip+$val1;
                                if($key1=='C'){
                                   $total_tip_cash=$total_tip_cash+$val1;
                                }else if($key1=='D'){
                                    $total_tip_card=$total_tip_card+$val1;
                                }
                            }
                          $i++;  
                            if(array_key_exists('C',$val)){
                                $cash_tip= number_format($val['C'],$_SESSION['be_decimal']);
                            }
                            else{ 
                                $cash_tip=number_format(0,$_SESSION['be_decimal']);

                            }
                            if(array_key_exists('D',$val)){
                                $card_tip= number_format($val['D'],$_SESSION['be_decimal']);
                            }
                            else{ 
                                $card_tip=number_format(0,$_SESSION['be_decimal']);

                            }
                            
                            

                            $bilno= array(
                            new tip("","Date:",$key,"",$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bold_on.$bilno.$bold_off);
                                $print .= $left.$vv."\n";//ojin
                            }

                            $bilno= array(
                            new tip($i,$cash_tip,$card_tip,number_format($total_tip_each_day,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bilno);
                                $print .= $left."\n";//ojin
                            }

                        }
                        $print .= $left.$vv."\n";


                        $bilno= array(
                            new tip("TOTAL",number_format($total_tip_cash,$_SESSION['be_decimal']),number_format($total_tip_card,$_SESSION['be_decimal']),number_format($total_tip,$_SESSION['be_decimal']),$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bold_on.$bilno.$bold_off);
                                $print .= $left."\n";//ojin
                            }
                       }  
                }
                else if($view_mode=='detailed'){
                    $sql_tip  =  $database->mysqlQuery("select bm_billno,bm_tips_given as tip,bm_tips_mode as mode,bm_dayclosedate as date FROM tbl_tablebillmaster where $string AND bm_tips_given>0 group by bm_dayclosedate,bm_tips_mode,bm_billno   union all
                                                        select tab_billno,tab_tips_given as tip,tab_tips_mode as mode,tab_dayclosedate as date  FROM tbl_takeaway_billmaster  where $stringta and tab_tips_given>0 group by tab_dayclosedate,tab_tips_mode,tab_billno");

                    $num_tip   = $database->mysqlNumRows($sql_tip);
                    if($num_tip)
                    {   
                        while($result_tip = $database->mysqlFetchArray($sql_tip)){

                            $tips_details[$result_tip['date']][$result_tip['bm_billno']][$result_tip['mode']]=$result_tip['tip'];

                        }
                        $print .= $center.$bold_on."Consolidated ".$bold_off."\n";
                        $print .= $center.$bold_on."Tips Collected Report".$bold_off."\n";
                        $print .= $center.$bold_on.$reporthead.$bold_off."\n";
                        $print .= $center.$bold_on."Between  ".trim($from,"'")."  and   ".trim($to,"'").$bold_off."\n";
                        $print .= $left."\n";//ojin
                        
                        if($printer_style=='1'){
                            $vv=str_pad("-",  '46', "-");//46

                        }
                        else if($printer_style=='2'){
                             $vv=str_pad("-",  '42', "-");
                        }
                        
                        $bilno= array(
                                 new tip("Billno","Cash","Card","Total",$printer_style),
                                 );
                                 foreach($bilno as $bilno) {
                                     $print .=$left.($bold_on.$bilno.$bold_off);
                                     $print .= $left.$vv."\n";//ojin
                                 }

                        $i=0;
                        $total_tip_cash=0;
                        $total_tip_card=0;
                        $total_tip=0;
                        foreach($tips_details as $key2=>$val2){ 
                            $bilno= array(
                            new tip("","Date:",$key2,"",$printer_style),
                            );
                            foreach($bilno as $bilno) {
                                $print .=$left.($bold_on.$bilno.$bold_off);
                                $print .= $left.$vv."\n";//ojin
                            }    
                            foreach($val2 as $key=>$val){
                                $total_tip_each_day=0;
                                foreach($val as $key1=>$val1){
                                    $total_tip_each_day=$total_tip_each_day+$val1;
                                    $total_tip=$total_tip+$val1;
                                    if($key1=='C'){
                                       $total_tip_cash=$total_tip_cash+$val1;
                                    }else if($key1=='D'){
                                        $total_tip_card=$total_tip_card+$val1;
                                    }
                                }
                                if(array_key_exists('C',$val)){
                                     $cash_tip= number_format($val['C'],$_SESSION['be_decimal']);
                                 }
                                 else{ 
                                     $cash_tip=number_format(0,$_SESSION['be_decimal']);

                                 }
                                 if(array_key_exists('D',$val)){
                                     $card_tip= number_format($val['D'],$_SESSION['be_decimal']);
                                 }
                                 else{ 
                                     $card_tip=number_format(0,$_SESSION['be_decimal']);

                                 }



                                 $bilno= array(
                                 new tip($key,$cash_tip,$card_tip,number_format($total_tip_each_day,$_SESSION['be_decimal']),$printer_style),
                                 );
                                 foreach($bilno as $bilno) {
                                     $print .=$left.($bilno);
                                     $print .= $left."\n";//ojin
                                 }

                            }
                            $print .= $left.$vv."\n";
                        }
                        $bilno= array(
                            new tip("TOTAL",number_format($total_tip_cash,$_SESSION['be_decimal']),number_format($total_tip_card,$_SESSION['be_decimal']),number_format($total_tip,$_SESSION['be_decimal']),$printer_style),
                            );
                        foreach($bilno as $bilno) {
                            $print .=$left.($bold_on.$bilno.$bold_off);
                            $print .= $left."\n";//ojin
                        }
                }

            }

                $print .= $left.$vv."\n";
                
                 $bilno= array(
                                    new bilno("Printed At:".date('Y-m-d H:i:s'),'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                                        
                                     $bilno= array(
                                    new bilno("Printed By:".$_SESSION['expodine_id'],'',$printer_style),
                                    );
                                    foreach($bilno as $bilno) {

                                        $print .=$left.$bold_on.($bilno).$bold_off;
                                    }
                
                $print .="\n\n\n\n\n";
                $print.=$cutpaper;

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
    else{
        echo "**failed**Report Printing Failed: " .$printer_kotname_bill[$key]."( ".$printer_kotip_bill[$key]." )";
    }
        
    }
    }
}
else{
    
        echo "**failed**Printer Status Is Off";
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
        $leftCols ="5";
	$leftCols1 ="12";
        $rightCols ="15";
	$rightCols1 ="14";
        }
        else if($this -> style=='2'){
           $leftCols ="5";
	$leftCols1 ="13";
        $rightCols ="13";
	$rightCols1 ="10"; 
        }
		/*$leftCols ="5";
		$leftCols1 ="12";
        $rightCols ="14";
		$rightCols1 ="12";*/
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_BOTH) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
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
        $leftCols ="5";
		$leftCols1 ="40";
        
		/*$leftCols ="5";
		$leftCols1 ="12";
        $rightCols ="14";
		$rightCols1 ="12";*/
		
		
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
     private $style;



    public function __construct($flr='',$itm ='', $qty = '', $tot = '',$style='') {
		$this ->flr=$flr;
       $this -> itm = $itm;
        $this -> qty = $qty;
       $this -> tot = $tot;
       $this -> style = $style;
    }

    public function __toString() {
		
	if( $this -> style =="1"){	
	$leftCols ="5";
	$leftCols1= "19";
	$leftCols2 ="6";
        $rightCols ="16";
        }
      else if( $this -> style =='2'){	
	$leftCols ="4";
	$leftCols1= "17";
	$leftCols2 ="6";
        $rightCols ="13";
        }
		
		/*$leftCols ="5";
		$leftCols1 ="12";
        $rightCols ="14";
		$rightCols1 ="12";*/
		   $left = str_pad($this -> flr, $leftCols,' ', STR_PAD_BOTH) ;
		
                $left1 = str_pad($this -> itm, $leftCols1,' ', STR_PAD_RIGHT) ;
		
		$left2 = str_pad($this -> qty, $leftCols2,' ', STR_PAD_LEFT) ;
		$right = str_pad($this -> tot, $rightCols,' ', STR_PAD_LEFT) ;
	
        return "$left$left1$left2$right\n";
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
            $leftCols = '33';//32-ojin    33-bbq
            $rightCols = '13';//10-ojin   13-bbq
            }
        if($this -> style =="2")
            {
            $leftCols = '27';//32-ojin    33-bbq
            $rightCols = '15';
            }
                
        $left = str_pad($this -> name, $leftCols) ;
		//$center = str_pad(":", $centerCols) ;
        $right = str_pad($this -> price, $rightCols,' ', STR_PAD_LEFT);
        return "$left$right\n";
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
        $leftCols ="4";
	$leftCols1 ="21";
        $rightCols ="8";
	$rightCols1 ="14";
        }
        else if($this -> style=='2'){
        $leftCols ="5";
	$leftCols1 ="16";
        $rightCols ="8";
	$rightCols1 ="12"; 
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
        $leftCols ="30";
	$leftCols1 ="5";
        $rightCols="12";
        }
        else if($this -> style =='2'){
         $leftCols ="25";
	$leftCols1 ="5";
        $rightCols="11";   
        }
		
		
                $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_LEFT) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		
        return "$left$left1$right\n";
    }
}
 class cashier {
   
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
        $leftCols0 ="3";
        $leftCols ="12";
	$leftCols1 ="10";
        $rightCols ="10";
	$rightCols1 ="10";
        }
        else if( $this -> style =='2'){
        $leftCols0 ="2";
        $leftCols ="10";
	$leftCols1 ="10";
        $rightCols ="10";
	$rightCols1 ="10";
        }
		
		
        $left = str_pad($this -> no, $leftCols0,' ', STR_PAD_BOTH) ;
        $left0 = str_pad($this -> staff, $leftCols,' ', STR_PAD_BOTH) ;
	$left1 = str_pad($this -> cash, $leftCols1,' ', STR_PAD_LEFT) ;
	$right = str_pad($this -> card, $rightCols,' ', STR_PAD_LEFT) ;
	$right1 = str_pad($this -> total, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left0$left1$right$right1\n";
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
        $leftCols0 ="10";
        $leftCols ="25";
	$leftCols1 ="7";
      
	
        }
        else if( $this -> style =='2'){
         $leftCols0 ="10";
        $leftCols ="25";
	$leftCols1 ="7";
       
	
        }
		
		
        $left = str_pad($this -> bill, $leftCols0,' ', STR_PAD_RIGHT) ;
        $left0 = str_pad($this -> qty, $leftCols,' ', STR_PAD_BOTH) ;
	$left1 = str_pad($this -> staff, $leftCols1,' ', STR_PAD_LEFT) ;
	
	
        return "$left$left0$left1\n";
    }
}
class discount {
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
        $leftCols ="5";
	$leftCols1 ="12";
        $rightCols ="15";
	$rightCols1 ="14";
        }
        else if($this -> style=='2'){
           $leftCols ="5";
	$leftCols1 ="13";
        $rightCols ="13";
	$rightCols1 ="10"; 
        }
		/*$leftCols ="5";
		$leftCols1 ="12";
        $rightCols ="14";
		$rightCols1 ="12";*/
		
		
        $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
    }
}

class payment {
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
        $leftCols ="12";
	$leftCols1 ="9";
        $rightCols ="13";
	$rightCols1 ="13";
        }
        else if($this -> style=='2'){
           $leftCols ="12";
	$leftCols1 ="9";
        $rightCols ="10";
	$rightCols1 ="10"; 
        }
		
		
              $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_LEFT) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
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
class tip {
    private $bill;
    private $cash;
    private $card;
    private $tot;
    private $style;



    public function __construct($bill='',$cash ='', $card = '', $tot = '',$style='') {
	$this ->bill=$bill;
        $this ->cash = $cash;
        $this ->card = $card;
        $this ->tot = $tot;
        $this ->style = $style;
    }

    public function __toString() {
		
	if( $this -> style =="1"){	
	$leftCols =9;
	$leftCols1= 11;
	$leftCols2 =11;
        $rightCols =14;
        }
      else if( $this -> style =='2'){	
	$leftCols =9;
	$leftCols1= 10;
	$leftCols2 =10;
        $rightCols =12;
        }
		
		
		$left = str_pad($this -> bill, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> cash, $leftCols1,' ', STR_PAD_LEFT) ;
		$left2 = str_pad($this -> card, $leftCols2,' ', STR_PAD_LEFT) ;
		$right = str_pad($this -> tot, $rightCols,' ', STR_PAD_LEFT) ;
	
        return "$left$left1$left2$right\n";
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
        $leftCols ="15";
	$leftCols1 ="15";
        $rightCols="15";
        }
        else if($this -> style =='2'){
         $leftCols ="13";
	$leftCols1 ="13";
        $rightCols="13";   
        }
		
		
                $left = str_pad($this -> product, $leftCols,' ', STR_PAD_BOTH) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		
        return "$left$left1$right\n";
    }
}
class stock {
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
        $leftCols ="6";
	$leftCols1 ="15";
        $rightCols ="9";
	$rightCols1 ="9";
        }
        else if($this -> style=='2'){
           $leftCols ="6";
	$leftCols1 ="15";
        $rightCols ="9";
	$rightCols1 ="9"; 
        }
		
		
              $left = str_pad($this -> product, $leftCols,' ', STR_PAD_RIGHT) ;
		$left1 = str_pad($this -> qty, $leftCols1,' ', STR_PAD_BOTH) ;
		$right = str_pad($this -> rate, $rightCols,' ', STR_PAD_LEFT) ;
		$right1 = str_pad($this -> amount, $rightCols1,' ', STR_PAD_LEFT) ;
        return "$left$left1$right$right1\n";
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


