<?php
error_reporting(0);
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
 function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
 

 $taxname1=''; 
 $taxname2=''; 
 $taxname3='';
if($_REQUEST['type']=="tot_sales")
{
	 $date=date("Ymd");
	 $string=" bm_status='Closed' AND ";
	 
	 $floorvalue=$_REQUEST['floorz'];
	 if($_REQUEST['floorz']!=''){
			$string.=" bm_floorid='".$floorvalue."' AND ";
	 }
	 
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."'";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."'";
		}
	
	else
	{
	$bydatz=$_REQUEST['hidbydate'];
	if($bydatz!="null" && $bydatz!="")
	{
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
	{
		$string.="bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
	}
	else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
	else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
	else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
	}	
	}
		$tax_name=array();
        $tax_id=array();
        $sql_login  =  $database->mysqlQuery("select distinct(betm.bem_taxid) as taxid,betm.bem_label as taxname  
											FROM tbl_tablebill_extra_tax_master betm 
											left join tbl_extra_tax_master tm on tm.amc_id=betm.bem_taxid 
											group by  amc_id order by tm.amc_id asc "); 
        $num_login   = $database->mysqlNumRows($sql_login);
        if($num_login){ 
                while($result_login=$database->mysqlFetchArray($sql_login)){
                    $tax_name[]=$result_login['taxname'];
                     $tax_id[]=$result_login['taxid'];
                }}
                
		$servicetax_stats='N';
		$sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` 
											 WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  	$num_login   = $database->mysqlNumRows($sql_login);
	  	if($num_login){
			 $servicetax_stats='Y';
	  	}       
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$paid=0;
$bal=0; 
$dsc=0;
$srvtx=0;
$subtotal=0;
$vat=0;
$servcharge=0;
	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select bm_paymode,bm_finaltotal,bm_amountpaid,bm_amountbalace,bm_discountvalue,
	   									bm_subtotal,bm_dayclosedate,bm_billno,bm_tableno
	   									from tbl_tablebillmaster where $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
            if($result_login['bm_paymode']!=7)
			{
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			$dsc=$dsc + $result_login['bm_discountvalue'];
			$subtotal=$subtotal + $result_login['bm_subtotal'];
			$data['Sl No']=$xlsRow;
			$data['Date']=$database->convert_date($result_login['bm_dayclosedate']);
			$data['Bill No']=$result_login['bm_billno'];
			$data['Table']=$result_login['bm_tableno'];
			$data['Sub Total']=number_format($result_login['bm_subtotal'],$_SESSION['be_decimal']);
			
            for($s=0;$s<count(array_unique($tax_id));$s++)
			{
            $sql_taxvalue  =  $database->mysqlQuery("select betm.bem_total_value,betm.bem_taxid,betm.bem_label  
													FROM tbl_tablebill_extra_tax_master betm 
													where betm.bem_billno='".$result_login['bm_billno']."' 
													and betm.bem_taxid='".$tax_id[$s]."'  order by betm.bem_taxid asc"); 
            $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
            if($num_taxvalue){
				$i=0;
                while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                    { 
						if($result_taxvalue['bem_total_value']==''){
                                $result_taxvalue['bem_total_value']=0;
                            }
                            $tax_value[$result_taxvalue['bem_taxid']][]=$result_taxvalue['bem_total_value'];                        
                            $data[$result_taxvalue['bem_label']]=number_format($result_taxvalue['bem_total_value'],$_SESSION['be_decimal']);
                    } 
				} 
                else { 
                        $tax_value[$tax_id[$s]][]=0;
                        $data[$tax_name[$s]]=number_format(0,$_SESSION['be_decimal']);
                    } 
			}         
            $data['Discount']=number_format($result_login['bm_discountvalue'],$_SESSION['be_decimal']);
			$data['Final']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
			$data['Paid']=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
			$data['Balance']=number_format($result_login['bm_amountbalace'],$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);          
    		$xlsRow++; 
          }}}
          
	$data['Sl No']="";
	$data['Date']="";
	$data['Bill No']="";
	$data['Table']="";
	$data['Sub Total']="";
	for($i=0;$i<count(array_unique($tax_id));$i++){ 
        
            $data[$tax_name[$i]]="";
        } 
       
	$data['Discount']="";
        $data['Final']="";
        $data['Paid']="";
	$data['Balance']="";
	
	array_push($data1,$data);
	unset($data);
       
	$data['Sl No']="Total";
	$data['Date']="";
	$data['Bill No']="";
	$data['Table']="";
        $data['Sub Total']=number_format($subtotal,$_SESSION['be_decimal']);         
        for($i=0;$i<count(array_unique($tax_id));$i++){ 
            $data[$tax_name[$i]]=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal']);
            }
            for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){
                $data[$tax_name[$o]]=number_format(0,$_SESSION['be_decimal']);
            }      
	$data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
	$data['Final']=number_format($final,$_SESSION['be_decimal']);
	$data['Paid']=number_format($paid,$_SESSION['be_decimal']);
	$data['Balance']=number_format($bal,$_SESSION['be_decimal']);
	array_push($data1,$data);
	
  $filename = "Sales_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {

    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
}

else if($_REQUEST['type']=="tot_sales_timely")
{
	
	 $date=date("Ymd");
	 $string=" bm_status='Closed' AND ";
	 
	 $floorvalue=$_REQUEST['floorz'];
	 if($_REQUEST['floorz']!=''){
	   		$string.=" bm_floorid='".$floorvalue."' AND ";
	 }
	 
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$bydate=$_REQUEST['hidbydate'];
			$from=$_REQUEST['hidfr'];
			$to=$_REQUEST['hidto'];
			$string.= " bm_billtime between '".$from."' and '".$to."'  and bm_billdate  = '".$bydate."'   ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$bydate=$_REQUEST['hidbydate'];
			$from=$_REQUEST['hidfr'];
			$to=date("Y-m-d");
			$string.= " bm_billtime between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$bydate=$_REQUEST['hidbydate'];
			$from=date("Y-m-d");
			$to=$_REQUEST['hidto'];
			$string.= " bm_billtime between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."' ";
		}
	
	
		
		
		
		
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_billtime between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."'";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	  
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$paid=0;
$bal=0; 
$dsc=0;
$srvtx=0;
  $subtotal=0;
	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string order by bm_billdate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 /* if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }*/

	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			$dsc=$dsc + $result_login['bm_discountvalue'];
			$srvtx=$srvtx + $result_login['bm_servicetax'];
			$subtotal=$subtotal + $result_login['bm_subtotal'];
			
			$data['Sl No']=$xlsRow;
		/*	$data['Date']=$database->convert_date($result_login['bm_dayclosedate']);*/
			$data['Bill No']=$result_login['bm_billno'];
			$data['Bill Time']=$result_login['bm_billtime'];
                        $data['Table']=$result_login['bm_tableno'];
			$data['Sub Total']=number_format($result_login['bm_subtotal'],$_SESSION['be_decimal']);
			if($servicetax_stats=='Y'){$data[$taxname1]=number_format($result_login['bm_servicetax'],$_SESSION['be_decimal']);}
			$data['Discount']=number_format($result_login['bm_discountvalue'],$_SESSION['be_decimal']);
			$data['Final']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
			$data['Paid']=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
			$data['Balance']=number_format($result_login['bm_amountbalace'],$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	
	if($servicetax_stats=='Y'){$data[]="";}
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	array_push($data1,$data);
	unset($data);
	$data[]="Total";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]=number_format($subtotal,$_SESSION['be_decimal']);
	if($servicetax_stats=='Y'){$data[]=number_format($srvtx,$_SESSION['be_decimal']);}
	$data[]=number_format($dsc,$_SESSION['be_decimal']);
	$data[]=number_format($final,$_SESSION['be_decimal']);
	$data[]=number_format($paid,$_SESSION['be_decimal']);
	$data[]=number_format($bal,$_SESSION['be_decimal']);
	array_push($data1,$data);
	
  $filename = "Sales_report_timely" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	

}

else if($_REQUEST['type']=="tax_sales_summary")
{
$string='';
		$print='';
		$from='';
		$to='';
		$typestring='';
		  $string='';
                   $strings='';
        $reporthead="";

        $string .=" bm_status='Closed' AND bm_complimentary !='Y' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
        $string4_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
	$string5_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string6_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
        $string7_str=" sum(bm_finaltotal)";
        
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')  ) AND ";
	$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7= " bm_complimentary ='Y' AND pym_code='complimentary' AND";
	
			if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
			else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
			{
				$from=$database->convert_date($_REQUEST['hidfr']);
				$to=date("Y-m-d");
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "  (bm_dayclosedate between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
			else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
			{
				$from=date("Y-m-d");
				$to=$database->convert_date($_REQUEST['hidto']);
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				
				$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			}
		
		else
		{
			$bydatz=$_REQUEST['hidbydate'];
			
			if($bydatz!="null" && $bydatz!="")
			{
			
		
		if($bydatz=="Last5days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$typestring="Last 5 days";
		}elseif($bydatz=="Last10days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
			$typestring="Last 10 days";
		}
		elseif($bydatz=="Last15days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$typestring="Last 15 days";
		}
		else if($bydatz=="Last20days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$typestring="Last 20 days";
		}
		else if($bydatz=="Last25days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
			$typestring="Last 25 days";
		}
		else if($bydatz=="Last30days")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$typestring="Last 30 days";
		}
		else if($bydatz=="Today")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
			$typestring="Today";
		}
		else if($bydatz=="Yesterday")
		{
			$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day";
			$string_pax.= "bm_dayclosedate = CURDATE() - INTERVAL 1 day";
			$typestring="Yesterday";
		}
		 else if($bydatz=="Last1month")
		{
			$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			$typestring="Last 1 month";
		}
		else if($bydatz=="Last90days")
			{
				$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
				$typestring="Last 90 days"; 
			}
		else if($bydatz=="Last180days")
			{
				$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
				$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
				$typestring="Last 180 days";
			}
		else if($bydatz=="Last365days")
			{
				$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
				$typestring="Last 365 days";
			}
		}
		else
		{
			$from=date("Y-m-d");
				$to=date("Y-m-d");
				$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= " bm_dayclosedate   between '".$from."' and '".$to."'";
                                $typestring="on-".$from;
                                
                }
                $reporthead=$typestring;
		}
                
                
                $flg=0;
           

             
                $footer4 = "";
                $branchname="";
                $branchaddress="";
                $branchemail="";
                $branchphone = "";
                $sql_branch  =  $database->mysqlQuery("Select * from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
               
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
						 
//						
					}
		  }

                     

   $extax = 0;
  $total=0;
  $cash = 0;
  $card = 0;
  $card1=0;
  $cheque=0;
  $coupon=0;
  $voucher=0;
  $creditperson=0;
  $complimentary=0;
  $totaltax = 0;
  $roundoff = 0;
  $roundoff1=0;
  $final_exclusive_tax=0;
  $tax_exempt=0;
  $total_tax=0;
  $discount=0;
  $data=array();
  $data1=array();
  
    $sql_login_cash  =  $database->mysqlQuery(" select  $string1_str as cash,sum( bm_roundoff_value) as roundoff FROM tbl_tablebillmaster tbm
    left join tbl_paymentmode pm ON pm.pym_id = tbm.bm_paymode where $string1 $string"); 
//  echo "select  $string1_str as cash FROM tbl_tablebillmaster tbm
//    left join tbl_paymentmode pm ON pm.pym_id = tbm.bm_paymode where $string1 $string";

	  $num_login_cash   = $database->mysqlNumRows($sql_login_cash);
	  if($num_login_cash){
            $result_login_cash  = $database->mysqlFetchArray($sql_login_cash); 
            //$roundoff = $result_login1['roundof'];
            $cash = $result_login_cash['cash'];
            $roundoff=$roundoff+$result_login_cash['roundoff'];
            if($cash!=0){
                $data['Type']="Cash";
                $data['Value']=number_format($cash,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
                    
            }
          }
    $sql_login_card  =  $database->mysqlQuery(" select bm_name as bank_name, $string2_str as card,sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster tbm left join tbl_paymentmode on tbm.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.bm_transcbank and tbm.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tbm.bm_dayclosedate,tbm.bm_billtime ASC "); 
  //echo "select bm_name as bank_name, $string2_str as card from tbl_tablebillmaster tbm left join tbl_paymentmode on tbm.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.bm_transcbank and tbm.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tbm.bm_dayclosedate,tbm.bm_billtime ASC ";

	  $num_login_card   = $database->mysqlNumRows($sql_login_card);
	  if($num_login_card){
            while($result_login_card  = $database->mysqlFetchArray($sql_login_card)){ 
            $card1 = $card1+$result_login_card['card'];
            $card = $result_login_card['card'];
            $roundoff=$roundoff+$result_login_card['roundoff'];
           if($card!=0){
               
                $data['Type']="Card -".$result_login_card['bank_name'];
                $data['Value']=number_format($card,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
            }
        } }
    $sql_login_coupon  =  $database->mysqlQuery(" select $string3_str as coupon, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
  //echo "select $string3_str as coupon from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC ";

	  $num_login_coupon   = $database->mysqlNumRows($sql_login_coupon);
	  if($num_login_coupon){
            $result_login_coupon  = $database->mysqlFetchArray($sql_login_coupon); 
           
            $coupon = $result_login_coupon['coupon'];
            $roundoff=$roundoff+$result_login_coupon['roundoff'];
            if($coupon!=0){
                $data['Type']="Coupon";
                $data['Value']=number_format($coupon,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
            
            }
          }
          
      $sql_login_voucher  =  $database->mysqlQuery(" select $string4_str as voucher, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
        //echo "select $string4_str as voucher from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC ";

	  $num_login_voucher   = $database->mysqlNumRows($sql_login_voucher);
	  if($num_login_voucher){
            $result_login_voucher  = $database->mysqlFetchArray($sql_login_voucher); 
           
            $voucher = $result_login_voucher['voucher'];
            $roundoff=$roundoff+$result_login_voucher['roundoff'];
            if($voucher!=0){
                $data['Type']="Voucher";
                $data['Value']=number_format($voucher,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
            
            }
          }    
          $sql_login_cheque  =  $database->mysqlQuery(" select $string5_str as cheque, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
       // echo "select $string5_str as cheque from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC ";

	  $num_login_cheque   = $database->mysqlNumRows($sql_login_cheque);
	  if($num_login_cheque){
            $result_login_cheque  = $database->mysqlFetchArray($sql_login_cheque); 
           
            $cheque = $result_login_cheque['cheque'];
            $roundoff=$roundoff+$result_login_cheque['roundoff'];
            if($cheque!=0){
                $data['Type']="Cheque";
                $data['Value']=number_format($cheque,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
            
            }
          } 
          $sql_login_creditperson  =  $database->mysqlQuery(" select $string6_str as creditperson, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
          //echo "select $string6_str as creditperson from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC ";
          $num_login_creditperson   = $database->mysqlNumRows($sql_login_creditperson);
	  if($num_login_creditperson){
            $result_login_creditperson  = $database->mysqlFetchArray($sql_login_creditperson); 
           
            $creditperson = $result_login_creditperson['creditperson'];
            $roundoff=$roundoff+$result_login_creditperson['roundoff'];
            if($creditperson!=0){
                $data['Type']="Credit Person";
                $data['Value']=number_format($creditperson,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
            
            }
          }
          
       $sql_login_complimentary  =  $database->mysqlQuery(" select $string7_str as complimentary, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where  $string7 $string_pax order by bm_dayclosedate,bm_billtime ASC"); 
         // echo "select $string7_str as complimentary from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7 $string_pax order by bm_dayclosedate,bm_billtime ASC ";
          $num_login_complimentary   = $database->mysqlNumRows($sql_login_complimentary);
	  if($num_login_complimentary){
            $result_login_complimentary  = $database->mysqlFetchArray($sql_login_complimentary); 
           
            $complimentary = $result_login_complimentary['complimentary'];
            if($complimentary!=0){
                $data['Type']="Complimentary";
                $data['Value']=number_format($complimentary,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
            }
          }
          
          $total=$cash+$card1+$coupon+$voucher+$cheque+$creditperson;
            $data['Type']="";
            $data['Value']="";
            array_push($data1,$data);
            unset($data);
          
          if($total!=0){
              $data['Type']="Total Summary";
            $data['Value']=number_format($total,$_SESSION['be_decimal']);
            array_push($data1,$data);
            unset($data);
              }
            $data['Type']="";
            $data['Value']="";
            array_push($data1,$data);
            unset($data);
            
            $data['Type']="";
            $data['Value']="";
            array_push($data1,$data);
            unset($data);
            
            $data['Type']="TAX SUMMARY";
            $data['Value']="";
            array_push($data1,$data);
            unset($data);
                            
                            
            $sql_login_totsales  =  $database->mysqlQuery("select sum(bm_subtotal) as exclusivetax ,sum(bm_discountvalue) as discount, sum(bm_finaltotal) as final, sum(bm_tax_exempt) as taxexempt,sum(bm_roundoff_value) as roundoff1 FROM tbl_tablebillmaster bm where $string"); 
            //echo "select sum(bm_subtotal) as exclusivetax , sum(bm_finaltotal) as final, sum(bm_tax_exempt) as taxexempt,sum(bm_roundoff_value) as roundoff1 FROM tbl_tablebillmaster bm where $string";
            $num_login_totsales   = $database->mysqlNumRows($sql_login_totsales);
            if($num_login_totsales){
              $result_login_totsales  = $database->mysqlFetchArray($sql_login_totsales); 
              $final = $result_login_totsales['final']; 
              $final_exclusive_tax = $result_login_totsales['exclusivetax'];
              $tax_exempt=$result_login_totsales['taxexempt'];
              $roundoff1=$result_login_totsales['roundoff1'];
              $discount=$result_login_totsales['discount'];
              $final_exclusive_tax=$final_exclusive_tax-$discount;
            }

             if($final_exclusive_tax!=0){
                $data['Type']="SALES EXCL.TAX";
                $data['Value']=number_format($final_exclusive_tax,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
            }
          
           if($tax_exempt!=0){
                $data['Type']="SALES TAX EXEMPT";
                $data['Value']=number_format($tax_exempt,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
              
            }
              
             
                $sql_login_tax  =  $database->mysqlQuery("select sum(etm.bem_total_value) as totax_single ,etm.bem_label  
                    FROM tbl_tablebillmaster tbm
                    left join tbl_tablebill_extra_tax_master etm on etm.bem_billno = tbm.bm_billno 
                    where $string group by etm.bem_taxid"); 
//                echo "select sum(etm.bem_total_value) as totax_single ,etm.bem_label  
//                    FROM tbl_tablebillmaster tbm
//                    left join tbl_tablebill_extra_tax_master etm on etm.bem_billno = tbm.bm_billno 
//                    where $string group by etm.bem_taxid";
	  $num_login_tax   = $database->mysqlNumRows($sql_login_tax);
	  if($num_login_tax){
              
             while($result_login_tax  = $database->mysqlFetchArray($sql_login_tax)) 
			{   
             
              $total_tax_single = $result_login_tax['totax_single'];
              $label= $result_login_tax['bem_label'];
             if($total_tax_single!=0){
                 $total_tax=$total_tax+$total_tax_single;
                    $data['Type']=$label;
                    $data['Value']=number_format($total_tax_single,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                     
             }   } }
             
              if($roundoff1!=0){
                    $data['Type']="ROUND OFF";
                    $data['Value']=number_format($roundoff1,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                }
                $data['Type']="";
                $data['Value']="";
                array_push($data1,$data);
                unset($data);
                
             if($final!=0){
                    $data['Type']="SALES INCL.TAX";
                    $data['Value']=number_format(($final_exclusive_tax-$tax_exempt+$total_tax+$roundoff1),$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                }

  $filename = "Tax_sales_" .$reporthead. ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	
}
else if(($_REQUEST['type']=="categorywise_report"))
{
    	$string="";
        $reporthead="";
	$string="bm.bm_status = 'Closed'";
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
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);			
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);			
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);			
                }
		
					
            
	else 
	{
                $bydatz=$_REQUEST['bydate'];
                
                if($bydatz!="null")
		{
	
                if($bydatz=="Last5days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $st="Last 5 days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $st="Last 10 days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $st="Yesterday";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $st="Last 15 days";
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" and  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $st="Last 20 days";
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $st="Last 25 days";
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $st="Last 30 days";
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $st="Last 1 Month";
                }
                else if($bydatz=="Today")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $st="Today";
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $st="Last 90 days";
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $st="Last 180 days";
                }
                else if($bydatz=="Last365days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $st="Last 365 days";
                }
                }
                else
                {
		$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                
                }
                $reporthead=$st;
	}
       
	
	
	
    
    
				
              $data=array();
$data1=array();
            $total=0;
            $final=0;
           
            $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,count(distinct(bd.bd_menuid))as 'no of items',sum(bd.bd_qty) as qty ,sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno left join tbl_menumaster on mr_menuid=bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC");
     //echo"SELECT mc.mmy_maincategoryname,count(distinct(bd.bd_menuid))as 'no of items',sum(bd.bd_qty) as qty ,sum(bm.bm_finaltotal) as Final,sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno left join tbl_menumaster on mr_menuid=bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC";
      $num_login   = $database->mysqlNumRows($sql_login);
             if($num_login){$i=1;$t=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$t++;
                          $total=$total+$result_login['Total'];
                          //$final=$final+$result_login['Final'];                     
                          
                            
                                $data['Slno']=$i;
                                  $data['Main Category Name']=$result_login['mmy_maincategoryname'];
                                  $data['No of items']=$result_login['no of items'];
                             $data['Qty']=$result_login['qty'];
                                $data['Total']=number_format($result_login['Total'],$_SESSION['be_decimal']);
                                array_push($data1,$data);
			unset($data);	
                      
             $i++;}} 
                              
                                $data['slno']="Total";
	                                                                             
                                $data['Main Category Name']="";
                                $data['No of items']="";
                                $data['Qty']="";
	                        $data['Total']= number_format($total,$_SESSION['be_decimal']);
                                array_push($data1,$data);
			
		$filename = "Category_wise_" . $reporthead. ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;	
                        } 
	
                        
                        
                        
else if(($_REQUEST['type']=="sales_summary"))
{
	$string="";
        $strings='';
	$reporthead="";
        $string .=" bm_status='Closed' AND bm_complimentary !='Y' AND";
//	$string.=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace) + sum(bm_roundoff_value)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
        $string4_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
	$string5_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string6_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
		$string7_str=" sum(bm_finaltotal)";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	//	$string1 =$strings. " pym_code='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
			$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
		
		
		
		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	
	
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) "; 
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		$st='';
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
          
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
				$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day";
		$string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
			$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
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
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
				$string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
	}
	
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	
	

        $data=array();
$data1=array();
$xlsRow=1;                                    
 $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;




  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                      
				if($result_login['tot'] != "")	{
			$subtotal =$subtotal + $result_login['tot'];
		$data['Type ']="Cash";
                $data['Value ']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);	
                        
                      } }}
 
//echo "select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb , tbl_bankmaster b  left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "; 	
				$sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  
	 
	
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
				$subtotal =$subtotal + $result_login1['tot'];
		$data['Type ']="Credit / Debit card -".$result_login1['bank_name'];
                      $data['Value ']=number_format($result_login1['tot'],$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);	
                         	}
	  }
			
			
			
			$sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
			
	  $num_login   = $database->mysqlNumRows($sql_login);

	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				
			if($result_login['tot'] != "")	{
				
				$subtotal =$subtotal + $result_login['tot'];
                                $data['Type ']="Coupons";
                                $data['Value ']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);
				
			}} }
			
			$sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
			
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
				if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
                            $data['Type ']="Voucher";
                            $data['Value ']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);
			 } }}
			
			$sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
                             $data['Type ']="Cheque";
                              $data['Value ']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);
			 } }}
			
			
				
			$sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
                         $data['Type ']="Credits";
                         $data['Value ']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);
			 } }}
				
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['tot'] != "")
			{
			$subtotal1 =$subtotal1 + $result_login['tot'];
                          $data['Type ']="Complimentary";
                          $data['Value ']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);
			} }}
			 $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		   
		//Select sum(ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid  Where   $string_pax Group By tbl_menumaster.mr_menuname order by ct DESC  
		   
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
			}
                           $data['Type ']="Total Pax";
                           $data['Value ']=$qtycount;
			array_push($data1,$data);
			unset($data);
                    
	  }
			
		 $data['Type ']="";
                  $data['Value ']="";
			array_push($data1,$data);
			unset($data);	
			
                         $data['Type ']="TOTAL";
                         $data['Value ']=number_format($subtotal,$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);	
		$filename = "Sales_summary_" . $reporthead . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;	
			 
}
                        
else if($_REQUEST['type']=="tax_detailed_cnb")
{
 
	 $date=date("Ymd");
	$string="";
        $reporthead="";
           $string .=" bm_status='Closed' AND bm_complimentary !='Y' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " DATE(bm_dayclosedate) between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " DATE(bm_dayclosedate) between '".$from."' and '".$to."'";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " DATE(bm_dayclosedate) between '".$from."' and '".$to."'";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
	if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" DATE(bm_dayclosedate) between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
                     $st="Last5days";
                
	}elseif($bydatz=="Last10days")
	{
		$string.=" DATE(bm_dayclosedate) between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                     $st="Last10days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" DATE(bm_dayclosedate) between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                     $st="Last15days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" DATE(bm_dayclosedate) between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                     $st="Last20days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" DATE(bm_dayclosedate) between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                     $st="Last25days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" DATE(bm_dayclosedate) between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                        $st="Last30days";
	}
	else if($bydatz=="Today")
	{
		$string.="DATE(bm_dayclosedate) between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                          $st="Today";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" DATE(bm_dayclosedate) =  CURDATE() - INTERVAL 1 day ";
                                       $st="Yesterday";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.=" DATE(bm_dayclosedate) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  $st="Last1month";
			  }
	
	
	
else if($bydatz=="Last90days")
	{
		$string.=" DATE(bm_dayclosedate) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $st="Last90days";
	}
else if($bydatz=="Last180days")
	{
		$string.=" DATE(bm_dayclosedate) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $st="Last180days";
	}
else if($bydatz=="Last365days")
	{
		$string.=" DATE(bm_dayclosedate) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $st="Last365days";
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " DATE(bm_dayclosedate) between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	    $reporthead=$st;
	
	
		
		
		
	}
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$paid=0;
$bal=0; 
$taxtotal=0;

  $dsc=0;
  $srvtx=0;
  $total=0;
  $finaltotal=0;
$complimentary=0;
  $taxtotal1=0;
  $taxtotal2=0;
  $taxtotal3=0;
  $totalqty = 0;
  $finalsubtotal=0;
  $subtotal=0;
               $ct=0;                   
               $taxamnt=0;
               $txname="";

	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select tbd.bd_billno,tbm.bm_billdate,tbm.bm_dayclosedate,tbm.bm_complimentary,tbm.bm_total,tbd.bd_menuid, mm.mr_menuname, tbd.bd_qty, tetd.bet_tax_amount, etm.amc_name,tbd.bd_amount,tbd.bd_billslno 
    FROM tbl_tablebilldetails tbd
    left join tbl_tablebillmaster tbm on tbd.bd_billno = tbm.bm_billno
    left join tbl_menumaster mm on mm.mr_menuid = tbd.bd_menuid
    left join tbl_tablebill_extra_tax_details tetd on tbd.bd_billno = tetd.bet_billno and tbd.bd_billslno = tetd.bet_billslno
    left join tbl_extra_tax_master etm on etm.amc_id = tetd.bet_tax_id
    where $string
    group by tbm.bm_billno, tbd.bd_menuid
    order by tbd.bd_billno desc"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      $ct=0;
                      $subtotal=$result_login['bd_amount'];
                              $totalqty = $totalqty + $result_login['bd_qty'];
                               if($result_login['bm_complimentary']=='Y')
                        {
                            $complimentary = $complimentary + $result_login['bm_total'];
                        }
                        else{
                            $complimentary = $complimentary;
                        }
                        $data['Sl No']=$xlsRow;
                        $data['Date']=$result_login ["bm_billdate"];
			$data['Bill No']=$result_login ["bd_billno"];
			$data['Item']=$result_login ["mr_menuname"];
			$data['Qty']=$result_login['bd_qty'];
			$data['Subtotal ']=number_format($subtotal,$_SESSION['be_decimal']);
                       
                                    $taxtotal=0;
                             $sql_tax  =  $database->mysqlQuery("select amc_id, amc_name from  tbl_extra_tax_master order by amc_id asc ");
                                $num_tax   = $database->mysqlNumRows($sql_tax);
                                if($num_tax){
                                    while($result_tax  = $database->mysqlFetchArray($sql_tax)){
                                        $ct++;
                                         $taxamnt = 0;
                                        $sql_taxamnt  =  $database->mysqlQuery("select bet_tax_amount from  tbl_tablebill_extra_tax_details bxt left join tbl_tablebillmaster tbm on tbm.bm_billno=bxt.bet_billno
                                        where bet_billno = '".$result_login['bd_billno']."' and bet_billslno = '".$result_login['bd_billslno']."' and bet_tax_id = '".$result_tax['amc_id']."' and tbm.bm_complimentary<>'Y'");
                                        $num_taxamnt   = $database->mysqlNumRows($sql_taxamnt);
                                        if($num_taxamnt){
                                            $result_taxamnt  = $database->mysqlFetchArray($sql_taxamnt);
                                            if($result_taxamnt){
                                                $taxamnt = $result_taxamnt['bet_tax_amount'];
                                                $taxtotal = $taxtotal + $taxamnt;
                                                if($ct==1){
                                                    $taxtotal1 = $taxtotal1 + $taxamnt;
                                                }elseif($ct==2){
                                                    $taxtotal2 = $taxtotal2 + $taxamnt;
                                                }elseif($ct==3){
                                                    $taxtotal3 = $taxtotal3 + $taxamnt;
                                        }}}
                                        $txname=$result_tax['amc_name'];
                                        $data[$result_tax['amc_name']]=number_format($taxamnt,$_SESSION['be_decimal']);
                                                   
                        
                                          }
                                }                                 
                                        
                                      
                           
                                $total= $subtotal + $taxtotal;
                                $finaltotal = $finaltotal + $total;
                                $finalsubtotal = $finalsubtotal + $subtotal;
                            
			
                               
                                $data['Total ']=number_format($total,$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);
                        
                    
                        
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
        $data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	
		
	array_push($data1,$data);
	unset($data);
	
	$data[]="Total";
	$data[]="";
	$data[]="";
	$data[]="";
	
	$data[]=round($totalqty,2);
        
                                $data[]=number_format(($finalsubtotal-$complimentary),$_SESSION['be_decimal']);
                                if($txname){
                                $data[]="";
	$data[]="";
           $data[]="";
                                }
              $data[]=number_format($finaltotal,$_SESSION['be_decimal']);
	array_push($data1,$data);
	
  $filename = "Tax_detailed_" .$reporthead . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	
}
  
else if($_REQUEST['type']=="summary")
{
	 $date=date("Ymd");
	  $string='';
    $reporthead="";
	$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
        $string4_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
	$string5_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string6_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
		$string7_str=" sum(bm_finaltotal)";
	
	
	
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	
	//$string1 =$strings." pym_code='cash'  AND  ";//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
		$string2 = " pym_code='credit'  AND ";//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
			$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	// $string=" bm_status='Closed' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			$string_pax.= " (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."'";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			$string_pax.= " (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."'";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			$string_pax.= " (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		$st='';
		
		
	if($bydatz!="null")
	{
		//$search="";
	
				  if($bydatz=="Last5days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
					  $st= " Last 5 days ";
					  	$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
				  }elseif($bydatz=="Last10days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
					  $st= " Last 10 days ";
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
				  }
				  elseif($bydatz=="Last15days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
					  $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
					  $st= " Last 15 days ";
				  }
				  else if($bydatz=="Last20days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
					  $st= " Last 20 days ";
				  }
				  else if($bydatz=="Last25days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
					  	$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
					  $st= " Last 25 days ";
				  }
				  else if($bydatz=="Last30days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
					  	$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
					  $st= " Last 30 days ";
				  }
				  else if($bydatz=="Today")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
					  $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
					  $st= " Today ";
				  }
				  else if($bydatz=="Yesterday")
				  {
					  $string.=" bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
					  $string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
					  $st= " Yesterday ";
				  }
				   else if($bydatz=="Last1month")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  $string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  $st= " Last 1 month ";
				  }
				  else if($bydatz=="Last90days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
					  $st= " Last 3 months ";
				  }
				  else if($bydatz=="Last180days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
					  		$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
					  $st= " Last 6 months ";
				  }
				  else if($bydatz=="Last365days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
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
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
				$string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
	}
		
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	  
$data=array();
$data1=array();
$xlsRow=1;  
  $subtotal=0;
	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id  where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
			$data['Type']='Cash';
			$data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		}
			} 
	  }
			
			
		/*	 $sql_login  =  $database->mysqlQuery("select $string2_str as tot from tbl_tablebillmaster where $string2"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
			$data['Type']='Credit';
			$data['Value']=round($result_login['tot']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		}
			} */
			
			
			
			$sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC  "); 
	      
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  
	 
	
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
			if($result_login1['tot'] !="")
				{
                            
			$subtotal =$subtotal + $result_login1['tot'];
			$data['Type']='Card';
			$data['Value']=number_format($result_login1['tot'],$_SESSION['be_decimal']);
		         array_push($data1,$data);
			unset($data);
    		//$xlsRow++; 
           
		}
	  }	
	  }
          
          $sql_logincredit  =  $database->mysqlQuery(" select  distinct (b.bm_name) as bnk,sum(bc.mc_cardamount) as tot
                FROM tbl_tablebillmaster bm
                left join tbl_paymentmode on bm.bm_paymode=tbl_paymentmode.pym_id  
                left join tbl_bill_card_payments bc on bc.mc_billno=bm.bm_billno
                left join tbl_bankmaster b on  b.bm_id = bc.mc_to_bank 
                where  tbl_paymentmode.pym_code='credit' and  bm.bm_status='Closed' 
                AND bm.bm_complimentary!='Y' AND  $string group by bnk ") ;                          

                  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
                  if($num_logincredit){
                          while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
                                {   
                            
                        
			$data['Type']=$result_logincredit['bnk'];
			$data['Value']=number_format($result_logincredit['tot'],$_SESSION['be_decimal']);
		         array_push($data1,$data);
			unset($data);
                
                
                          }
                          }
          
          
          
          
          
			
			 $sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
			$data['Type']='Coupons';
			$data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		}
			}
	  }
			
			 $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
			$data['Type']='Voucher';
			$data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		}
			} 
	  }
			
			 $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
			$data['Type']='Cheque';
			$data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		}
			} 
	  }
			
			
					 $sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
			$data['Type']='Credits';
			$data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		}
			} 
	  }
			
			
					 $sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal ;
			$data['Type']='Complimentary';
			$data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		}
			} 
	  }
			
			
						
			
			 $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		   
		//Select sum(ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid  Where   $string_pax Group By tbl_menumaster.mr_menuname order by ct DESC  
		   
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
				//$subtotal =$subtotal + $qtycount;
				
				
				$data['Type']='Total Pax';
			$data['Value']=$qtycount;
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
			
			}}
	$data['Type']="";
	$data['Value']="";
	array_push($data1,$data);
	unset($data);
	$data['Type']="Total";
	$data['Value']=number_format($subtotal,$_SESSION['be_decimal']);
	
	array_push($data1,$data);
	
  $filename = "Summary_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	
}

else if($_REQUEST['type']=="total_summary_details")
{
	 $date=date("Ymd");
	  $string='';
    $reporthead="";
	$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_chequebankamount) ";
		$string6_str=" sum(cd_amount)";
		$string7_str=" sum(bm_finaltotal)";
	
	
	
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	
	//$string1 =$strings." pym_code='cash'  AND  ";//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
		$string2 = " pym_code='credit'  AND ";//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
			$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	// $string=" bm_status='Closed' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			$string_pax.= " (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."'";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			$string_pax.= " (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."'";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			$string_pax.= " (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		$st='';
		
		
	if($bydatz!="null")
	{
		//$search="";
	
				  if($bydatz=="Last5days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
					  $st= " Last 5 days ";
					  	$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
				  }elseif($bydatz=="Last10days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
					  $st= " Last 10 days ";
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
				  }
				  elseif($bydatz=="Last15days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
					  $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
					  $st= " Last 15 days ";
				  }
				  else if($bydatz=="Last20days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
					  $st= " Last 20 days ";
				  }
				  else if($bydatz=="Last25days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
					  	$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
					  $st= " Last 25 days ";
				  }
				  else if($bydatz=="Last30days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
					  	$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
					  $st= " Last 30 days ";
				  }
				  else if($bydatz=="Today")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
					  $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
					  $st= " Today ";
				  }
				  else if($bydatz=="Yesterday")
				  {
					  $string.=" bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
					  $string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
					  $st= " Yesterday ";
				  }
				   else if($bydatz=="Last1month")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  $string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  $st= " Last 1 month ";
				  }
				  else if($bydatz=="Last90days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
					  $st= " Last 3 months ";
				  }
				  else if($bydatz=="Last180days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
					  		$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
					  $st= " Last 6 months ";
				  }
				  else if($bydatz=="Last365days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
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
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
				$string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
	}
		
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT * FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	  
$data=array();
$data1=array();
$xlsRow=1;  
  $subtotal=0;
  $totacash=0;
  $totalcard=0;
  $totalcoupon=0;
  $totalvoucher=0;
  $totalcheque=0;
  $totalcredits=0;
  $totalcomplimetary=0;
  $totalpax=0;
	$cur=date("Y-m-d");
        
    $sql = $database->mysqlQuery("select distinct(bm_dayclosedate) from tbl_tablebillmaster where $string");
    $num_row   = $database->mysqlNumRows($sql);
    if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
        
          $total=0;
          $data['Date']="";
          $data['Cash']="";
          $data['Card']="";
          $data['Coupon']="";
          $data['Voucher']="";
          $data['Cheque']="";
          $data['Credits'] ="";
          $data['Complimentary']="";
          $data['Pax']="";
          //$slno++;
        if($result != ""){
            
            $data['Date']=$result['bm_dayclosedate'];
            //$data['Value']=$result_login['tot'];
            //array_push($data1,$data);
            //unset($data);
            $dt = " bm_dayclosedate='".$result['bm_dayclosedate']."'";
        }
        
 	  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id  where $string1"."$dt order by bm_dayclosedate,bm_billtime ASC"); 
          //echo "select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id  where $string1"."$dt order by bm_dayclosedate,bm_billtime ASC";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login  = $database->mysqlFetchArray($sql_login);
			
                    if($result_login['tot'] !="")
                    {
			$subtotal =$subtotal + $result_login['tot'];
                        $total = $total + $result_login['tot'];
                        $totacash = $totacash + $result_login['tot'];
			$data['Cash']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			
			
			//unset($data);
                    //$xlsRow++; 
                    }
			
            }
            
          $sql_login  =  $database->mysqlQuery("select $string2_str as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$dt group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){
		  $result_login  = $database->mysqlFetchArray($sql_login);
			
                    if($result_login['tot'] !="")
                    {
			$subtotal =$subtotal + $result_login['tot'];
                        $total = $total + $result_login['tot'];
                        $totalcard = $totalcard + $result_login['tot'];
			$data['Card']=$result_login['tot'];
			
			
			
			//unset($data);
                    //$xlsRow++; 
                    }
			
            }
            $sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $dt order by bm_dayclosedate,bm_billtime ASC "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){
		  $result_login  = $database->mysqlFetchArray($sql_login);
			
                    if($result_login['tot'] !="")
                    {
			$subtotal =$subtotal + $result_login['tot'];
                        $total = $total + $result_login['tot'];
                        $totalcoupon = $totalcoupon + $result_login['tot'];
			$data['Coupon']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			
			
			//unset($data);
                    //$xlsRow++; 
                    }
			
            }
                 $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){
		  $result_login  = $database->mysqlFetchArray($sql_login);
			
                    if($result_login['tot'] !="")
                    {
			$subtotal =$subtotal + $result_login['tot'];
                        $total = $total + $result_login['tot'];
                        $totalvoucher = $totalvoucher + $result_login['tot'];
			$data['Voucher']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			
			
			//unset($data);
                    //$xlsRow++; 
                    }
			
            }
            
             $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){
		  $result_login  = $database->mysqlFetchArray($sql_login);
			
                    if($result_login['tot'] !="")
                    {
			$subtotal =$subtotal + $result_login['tot'];
                        $total = $total + $result_login['tot'];
                        $totalcheque = $totalcheque + $result_login['tot'];
			$data['Cheque']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			
			
			//unset($data);
                    //$xlsRow++; 
                    }
			
            }
            $sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_credit_details tcd on tcd.cd_billno=tbl_tablebillmaster.bm_billno left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string6"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){
		  $result_login  = $database->mysqlFetchArray($sql_login);
			
                    if($result_login['tot'] !="")
                    {
			$subtotal =$subtotal + $result_login['tot'];
                        $total = $total + $result_login['tot'];
                        $totalcredits = $totalcredits + $result_login['tot'];
			$data['Credits']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			
			
			//unset($data);
                    //$xlsRow++; 
                    }
			
            }
            
             $sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){
		  $result_login  = $database->mysqlFetchArray($sql_login);
			
                    if($result_login['tot'] !="")
                    {
			
                        $totalcomplimetary =$totalcomplimetary +$result_login['tot'];
			$data['Complimentary']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			
			
			//unset($data);
                    //$xlsRow++; 
                    }
			
            }
             $sql_login  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax and $dt"); 
	  //echo "SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax and $dt";
             $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){
		  $result_login  = $database->mysqlFetchArray($sql_login);
			
                   
			
                        $totalpax = $totalpax + $result_login['ct'];
			$data['Pax']=$result_login['ct'];
			
		
            }
            
            
            $data['Total']=number_format($total,$_SESSION['be_decimal']);
            array_push($data1,$data);
        
	
}

        $data['Date']="";    
	$data['Cash']="";
        $data['Card']="";
        $data['Coupon']="";
        $data['Voucher']="";
        $data['Cheque']="";
        $data['Credits'] ="";
        $data['Complimentary']="";
        $data['Pax']="";
	$data['Total']="";
        array_push($data1,$data);
        
        $data['Date']="Total";    
	$data['Cash']=number_format($totacash,$_SESSION['be_decimal']);
        $data['Card']=number_format($totalcard,$_SESSION['be_decimal']);
        $data['Coupon']=number_format($totalcoupon,$_SESSION['be_decimal']);
        $data['Voucher']=number_format($totalvoucher,$_SESSION['be_decimal']);
        $data['Cheque']=numbr_format($totalcheque,$_SESSION['be_decimal']);
        $data['Credits'] =number_format($totalcredits,$_SESSION['be_decimal']);
        $data['Complimentary']=number_format($totalcomplimetary,$_SESSION['be_decimal']);
        $data['Pax']=$totalpax;
	$data['Total']=number_format($subtotal,$_SESSION['be_decimal']);
}


    array_push($data1,$data);
    unset($data);
	
  $filename = "Summary_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;


    }


else if($_REQUEST['type']=="discount_report")
{
	 $date=date("Ymd");
	 $string=" bm_status='Closed' AND bm_discountvalue<>'0.00' AND  ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
	
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	}
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$paid=0;
$bal=0; 

	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 /* if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }*/

	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			
			$data['Sl No']=$xlsRow;
			$data['Date']=$database->convert_date($result_login['bm_dayclosedate']);
			$data['Bill No']=$result_login['bm_billno'];
			$data['Sub Total']=number_format($result_login['bm_subtotal'],$_SESSION['be_decimal']);
			$data['Discount']=number_format($result_login['bm_discountvalue'],$_SESSION['be_decimal']);
			$data['Final']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
			$data['Paid']=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
			$data['Balance']=number_format($result_login['bm_amountbalace'],$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	array_push($data1,$data);
	unset($data);
	$data[]="Total";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]=number_format($final,$_SESSION['be_decimal']);
	$data[]=number_format($paid,$_SESSION['be_decimal']);
	$data[]=number_format($bal,$_SESSION['be_decimal']);
	array_push($data1,$data);
	
  $filename = "Discount_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	
}else if($_REQUEST['type']=="kot_report")
{
	 $date=date("Ymd");
	 $string="  tor.ter_status='Closed' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tor.ter_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tor.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tor.ter_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
	
else if($bydatz=="Last90days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tor.ter_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	}
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;

	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select tor.ter_kotno,tor.ter_dayclosedate,mm.mr_menuname,(tor.ter_rate * tor.ter_qty) as rate,tor.ter_qty from tbl_tableorder as tor LEFT JOIN tbl_menumaster as mm ON tor.ter_menuid=mm.mr_menuid where $string order by tor.ter_dayclosedate,tor.ter_entrytime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 /* if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }*/

	  if($num_login){$old='';$new='';$i=1;$k=1;$each=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final + $result_login['rate'];
			if($i==1)
				{
					$old=$result_login['ter_kotno'];
					$new=$result_login['ter_kotno'];
					$each=$each + $result_login['rate'];
					$data['Sl No']=$k++;
					$data['Date']=$database->convert_date($result_login['ter_dayclosedate']);
					$data['KOT NO']=$result_login['ter_kotno'];
					$data['Items']=$result_login['mr_menuname'];
					$data['Quantity']=$result_login['ter_qty'];
					$data['Rate']=number_format($result_login['rate'],$_SESSION['be_decimal']);
				}else
				{
					$old=$new;
					$new=$result_login['ter_kotno'];
					if($new==$old)
					{$each=$each + $result_login['rate'];
						$data['Sl No']='';
						$data['Date']='';
						$data['KOT NO']='';
						$data['Items']=$result_login['mr_menuname'];
						$data['Quantity']=$result_login['ter_qty'];
						$data['Rate']=number_format($result_login['rate'],$_SESSION['be_decimal']);
					}else
					{
						$data['Sl No']='';
						$data['Date']='';
						$data['KOT NO']='';
						$data['Items']="Total";
						$data['Quantity']="";
						$data['Rate']=$each;
						 $each=0;
				        $each=$each + $result_login['rate'];
						array_push($data1,$data);
						unset($data);
			
						$data['Sl No']=$k++;
						$data['Date']=$database->convert_date($result_login['ter_dayclosedate']);
						$data['KOT NO']=$result_login['ter_kotno'];
						$data['Items']=$result_login['mr_menuname'];
						$data['Quantity']=$result_login['ter_qty'];
						$data['Rate']=number_format($result_login['rate'],$_SESSION['be_decimal']);
					}
				}
			
			
			$i++;
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }
	$data['Sl No']='';
	$data['Date']='';
	$data['KOT NO']='';
	$data['Items']="Total";
	$data['Quantity']="";
	$data['Rate']=number_format($each,$_SESSION['be_decimal']);
	} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	
	array_push($data1,$data);
	unset($data);
	$data[]="Total";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]=number_format($final,$_SESSION['be_decimal']);
	array_push($data1,$data);
	
  $filename = "KOT_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	
}else if($_REQUEST['type']=="bill_details")
{
	 $date=date("Ymd");
	 $string="   bm.bm_status='Closed' AND  ";
         $sort_string='';
        $sort_string1='';
        $sort_string.=$_REQUEST['sortby'];
        
        if($sort_string=='bill_asc'){
           $sort_string1.= " order by bm.bm_billno asc";
        }
        else if($sort_string=='bill_desc'){
            $sort_string1.= " order by bm.bm_billno desc";
        }
        else if($sort_string=='value_asc'){
           $sort_string1.= " order by bm.bm_finaltotal asc";
        }
        else if($sort_string=='value_desc'){
            $sort_string1.=" order by bm.bm_finaltotal desc";
        }
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm.bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
	
else if($bydatz=="Last90days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm.bm_dayclosedate between '".$from."' and '".$to."' ";
	}
	
	}
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$dsc=0;
 $dscfinal=0;
	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("SELECT td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname,bm.bm_discountvalue from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno  WHERE $string $sort_string1 "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 

	  if($num_login){$old='';$new='';$i=1;$k=1;$each=0;$dsc=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final + ($result_login['bd_rate'] * $result_login['bd_qty']);
			if($i==1)
				{
					$dscfinal=$dscfinal+($result_login['bm_discountvalue']);
					$dsc=$dsc + ($result_login['bm_discountvalue']);
					$old=$result_login['bd_billno'];
					$new=$result_login['bd_billno'];
					$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
					$data['Sl No']=$k++;
					$data['Date']=$database->convert_date($result_login['bm_dayclosedate']);
					$data['KOT NO']=$result_login['bd_billno'];
					$data['Items']=$result_login['mr_menuname'];
					$data['Portion']=$result_login['pm_portionname'];
					$data['Quantity']=$result_login['bd_qty'];
					$data['Rate']=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal']);
					$data['Discount']='';
				}else
				{
					$old=$new;
					$new=$result_login['bd_billno'];
					if($new==$old)
					{$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
						$data['Sl No']='';
						$data['Date']='';
						$data['KOT NO']='';
						$data['Items']=$result_login['mr_menuname'];
						$data['Portion']=$result_login['pm_portionname'];
						$data['Quantity']=$result_login['bd_qty'];
					    $data['Rate']=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal']);
						$data['Discount']='';
					}else
					{
						$data['Sl No']='';
						$data['Date']='';
						$data['KOT NO']='';
						$data['Items']="Total";
						$data['Portion']="";
						$data['Quantity']="";
						$data['Rate']=$each;
						$data['Discount']=$dsc;
						 $each=0;
				        $each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
						$dsc=$dsc + ($result_login['bm_discountvalue']);
				  		$dscfinal=$dscfinal+($result_login['bm_discountvalue']);
						array_push($data1,$data);
						unset($data);
			
						$data['Sl No']=$k++;
						$data['Date']=$database->convert_date($result_login['bm_dayclosedate']);
						$data['KOT NO']=$result_login['bd_billno'];
						$data['Items']=$result_login['mr_menuname'];
						$data['Portion']=$result_login['pm_portionname'];
						$data['Quantity']=$result_login['bd_qty'];
					    $data['Rate']=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal']);
						$data['Discount']='';
					}
				}
			
			
			$i++;
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }
	
	$data['Sl No']='';
	$data['Date']='';
	$data['KOT NO']='';
	$data['Items']="Total";
	$data['Portion']="";
	$data['Quantity']="";
	$data['Rate']=number_format($each,$_SESSION['be_decimal']);
	$data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
	} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	
	array_push($data1,$data);
	unset($data);
	$data[]="Total";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]=number_format($final,$_SESSION['be_decimal']);
	
	
	$data[]=number_format($dscfinal,$_SESSION['be_decimal']);
	array_push($data1,$data);
	
	
	unset($data);
	$data[]="Grand Total";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]=number_format(($final-$dscfinal),$_SESSION['be_decimal']);
	array_push($data1,$data);
	
  $filename = "Bill_details_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	
}
else if($_REQUEST['type']=="bill_cancel")
{
	 $date=date("Ymd");
	 $string="( b.bm_status= 'Cancelled' OR b.bm_status= 'Cancelled for Split')  AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " b.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " b.bm_dayclosedate between '".$from."' and '".$to."'";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " b.bm_dayclosedate between '".$from."' and '".$to."'";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" b.bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
else if($bydatz=="Last90days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " b.bm_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	}
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$paid=0;
$bal=0; 

	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select DISTINCT b.bm_dayclosedate,b.bm_billno,b.bm_billtime,b.bm_paymode,b.ter_cancelledreason,b.bm_cancelled_date_time,b.bm_finaltotal,b.ter_cancelledlogin,s.ser_firstname,s.ser_lastname from tbl_tablebillmaster b left join tbl_staffmaster s on b.ter_cancelledby_careof=s.ser_staffid where $string order by b.bm_dayclosedate"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 echo "select DISTINCT b.bm_dayclosedate,b.bm_billno,b.bm_billtime,b.bm_paymode,b.ter_cancelledreason,b.bm_cancelled_date_time,b.bm_finaltotal,b.ter_cancelledlogin,s.ser_firstname,s.ser_lastname from tbl_tablebillmaster b left join tbl_staffmaster s on b.ter_cancelledby_careof=s.ser_staffid where $string order by b.bm_dayclosedate";

	  if($num_login){ $cancelledreason="";
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
                       if($result_login['bm_paymode']==NULL)
				{
				
					$paid="N";
				}
                                else 
				{
					$paid="Y";
				}
				$final=$final + $result_login['bm_finaltotal'];
			/*$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];*/
			
			$data['Sl No']=$xlsRow;
			$data['Date']=$database->convert_date($result_login['bm_dayclosedate']);
			$data['Bill No']=$result_login['bm_billno'];
                        $data['Bill Generated Time']=$result_login['bm_billtime'];
                        $data['Bill Cancelled Date&Time']=$result_login['bm_cancelled_date_time'];
	                $data['Reason']=$cancelledreason;
			$data['Final']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
                        $data['Paid']=$paid;
		/*	$data['Paid']=$result_login['bm_amountpaid'];
			$data['Balance']=$result_login['bm_amountbalace'];*/
			$data['Cancelled By']=$result_login['ser_firstname'].' '.$result_login['ser_lastname'];
                       $data['Cancelled Login']=$result_login['ter_cancelledlogin'];
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
        $data[]="";
	$data[]="";
	$data[]="";

		/*$data[]="";
		$data[]="";*/
	array_push($data1,$data);
	unset($data);
//	$data[]="Total";
	$data[]="";
	$data[]="";
	$data[]="";
        $data[]="";
	$data[]="";
$data[]="Total";
	$data[]=number_format($final,$_SESSION['be_decimal']);
	/*$data[]=$paid;
	$data[]=$bal;*/
	$data[]="";
	array_push($data1,$data);
	
  $filename = "Bill_Cancel_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	
}

else if($_REQUEST['type']=="regenerate_bill_logs")
{
	 $date=date("Ymd");
	$string="";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm.bm_billdate between '".$from."' and '".$to."'";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm.bm_billdate between '".$from."' and '".$to."'";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" bm.bm_billdate =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
	
else if($bydatz=="Last90days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	}
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$paid=0;
$bal=0; 

	$cur=date("Y-m-d"); $before_regen=0; $after_regen=0;
 	  $sql_login  =  $database->mysqlQuery("select bm.bm_billdate,bm.bm_finaltotal,bm.bm_billno,r.re_new_bill_no,r.re_billno,r.re_amount,r.re_order_no,DATE(r.re_datetime) AS Date, s.ser_firstname,r.re_reason,r.re_loginid from tbl_regenrate_log r left join tbl_staffmaster s on r.re_staffid=s.ser_staffid left join tbl_tablebillmaster bm on bm.bm_billno=r.re_billno where $string
 order by r.re_billno  ASC "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 /* if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }*/

	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				
				$before_regen=$before_regen+$result_login['re_amount'];
                                $after_regen=$after_regen+$result_login['bm_finaltotal'];
				
				
				//$final=$final + $result_login['bm_finaltotal'];
			/*$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];*/
			
			$data['Sl No']=$xlsRow;
			$data['Bill No']=$result_login['re_billno'];
                        $data['First Bill Amount']=number_format($result_login['re_amount'],$_SESSION['be_decimal']);
                        
                        $data['New Bill Amount']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
			$data['Date']=$result_login['bm_billdate'];
                        $data['Staff Name']=$result_login['ser_firstname'];
			$data['Reason']=$result_login['re_reason'];
			$data['Loggined By']=$result_login['re_loginid'];
                        $data['Order No']=$result_login['re_order_no'];
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
    $data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
    $data[]="";
	$data[]="";
	array_push($data1,$data);
	unset($data);
	
	$data[]="";
    $data[]="";
	$data[]=number_format($before_regen,$_SESSION['be_decimal']);
	$data[]="";
	$data[]=number_format($after_regen,$_SESSION['be_decimal']);
	$data[]="";
	$data[]="";
    $data[]="";
	$data[]="";
	array_push($data1,$data);
	
  $filename = "Regenerate_Bill_logs" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	
}

else if($_REQUEST['type']=="no_sale_report")
{
	 $date=date("Ymd");
	$string="";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " o.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " o.ter_dayclosedate between '".$from."' and '".$to."'";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " o.ter_dayclosedate between '".$from."' and '".$to."'";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" o.ter_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
	
else if($bydatz=="Last90days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " o.ter_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	}
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$paid=0;
$bal=0; 

	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,sc.msy_subcategoryname,m.mr_menuname FROM tbl_menumaster m 
LEFT JOIN tbl_menumaincategory mc ON MC.mmy_maincategoryid = m.mr_maincatid
LEFT JOIN tbl_menusubcategory sc ON SC.msy_subcategoryid = m.mr_subcatid
where m.mr_menuid NOT IN(SELECT o.ter_menuid from tbl_tableorder o where $string)
ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	

	  if($num_login){
              $i=1; $old_category='';$category='';
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                            if($result_login['mmy_maincategoryname']==$old_category){
                                $old_category=$result_login['mmy_maincategoryname'];
                                $category='';
                            }
                            else{
                                $old_category=$result_login['mmy_maincategoryname'];
                               $category=$result_login['mmy_maincategoryname']; 
                            }
			
			$data['Sl No']=$xlsRow;
			$data['Main Category Name']=$category;
			$data['Sub Category Name']=$result_login['msy_subcategoryname'];
	        $data['Menu Name']=$result_login['mr_menuname'];
			
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
		/*$data[]="";
		$data[]="";*/
	array_push($data1,$data);
	unset($data);
	
	$data[]="";
	$data[]="";
	$data[]="";
	//$data[]=$final;
	/*$data[]=$paid;
	$data[]=$bal;*/
	$data[]="";
	array_push($data1,$data);
	
  $filename = "No_Sale_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	
}

else if($_REQUEST['type']=="type_pay")
{
	 $date=date("Ymd");
$data=array();
$data1=array();
$xlsRow=1;  
 $data['Sl No']="";
 $data['Date']="";
 $data['Bill no']="";
//$string="bm_status='closed' ";
	
if($_REQUEST['hidpaytyp']=="cash")
	{
		//$string = " (bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)";
		/*$string = " pym_code='cash'";*/
	/*	 xlsWriteLabel(0,3,"Final");
 		 xlsWriteLabel(0,4,"Paid");
 		 xlsWriteLabel(0,5,"Balance");*/
			//$string ="(bm_amountpaid-bm_amountbalace) >0 and bm_status='closed' ";
			$string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and b.bm_status='closed' and ((b.bm_amountpaid-b.bm_amountbalace) > 0) ";
		 $data['Cash']="";
		  $data['Final']="";
		/* $data['Balance']="";*/
		 
	}else if($_REQUEST['hidpaytyp']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string = " pym_code='credit' and bm_transcbank <> '0' and bm_status='closed'";
			 
		 	 $data['Bank']="";
                         $data['Card Payment']="";
		     //$data['Cash']="";
			  $data['Final']="";
		/*     $data['Balance']="";*/
	}else if($_REQUEST['hidpaytyp']=="coupons")
	{
		//$string = " bm_couponcompany <>''  and bm_couponamt <>'0.00'";
		$string = " pym_code='coupon' and bm_status='closed' ";
			 $data['Coupon Company']="";
		 $data['Coupon Amount']="";
		
		  $data['Paid']="";
		   $data['Final']="";
		  // $data['Balance']="";
	}else if($_REQUEST['hidpaytyp']=="voucher")
	{
		//$string = " bm_voucherid <>''";
		$string = " pym_code='voucher' and bm_status='closed'";
		 $data['Voucher']="";
		
		   $data['Paid']="";
		    //$data['Balance']="";
		  $data['Final']="";
	}else if($_REQUEST['hidpaytyp']=="cheque")
	{
		//$string = " bm_chequeno <>'' and bm_chequebankname<>''";
		$string = " pym_code='cheque' and bm_status='closed'";
		  $data['Cheque No']="";
	      $data['Bank Name']="";
	
	     $data['Paid']="";
		      $data['Final']="";
		// $data['Balance']="";
	}
	array_push($data1,$data);
			unset($data);

	if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and  bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		}else
		{
			/*$cur=date("Y-m-d");
			$string.=" and  bm_dayclosedate='".$cur."'";*/
			
				$paybydate=$_REQUEST['hidpay'];
		if($paybydate!="null")
	{
		
		
	if($paybydate=="Last5days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($paybydate=="Last10days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($paybydate=="Last15days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last20days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last25days")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Last30days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($paybydate=="Today")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	else if($paybydate=="Yesterday")
			  {
				  $string.="and bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($paybydate=="Last1month")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	
	
	else if($paybydate=="Last90days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 3 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last180days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 6 
MONTH AND CURDATE( )";
	}
	else if($paybydate=="Last365days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 1 
YEAR AND CURDATE( )";
	}
	
	
	
	}
	else
	{
			$cur=date("Y-m-d");
			$string.=" and  bm_dayclosedate='".$cur."'";
	}
			
			
			
			
			
			
			
			
			
			
		}
                $paidcash=0;
	 $creditsum=0;
	 $xlsRow = 1;
	 $final=0;
  $paid=0;
  $bal=0; 
  $coup=0;
  	$paidcrdt=0;
	$sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster b LEFT JOIN tbl_bankmaster ON b.bm_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON b.bm_paymode= p.pym_id where $string"); 
	//$sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster LEFT JOIN tbl_bankmaster ON tbl_tablebillmaster.bm_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode ON  tbl_tablebillmaster.bm_paymode= tbl_paymentmode.pym_id   where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$creditsum=$creditsum+$result_login['bm_transactionamount'];
				$final=$final + $result_login['bm_finaltotal'];
                                $paidcash=$paidcash+$result_login['bm_amountpaid']-$result_login['bm_amountbalace'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
				//$paidcrdt=$paidcrdt + ($result_login['bm_amountpaid']-$result_login['bm_amountbalace']);
				$paidcrdt=$paid-$bal;
			
          $data['Sl No']=$xlsRow;
          $data['Date']=$database->convert_date($result_login['bm_dayclosedate']);
           $data['Bill no']=$result_login['bm_billno'];
			
				/*xlsWriteLabel($xlsRow,0,$xlsRow);

			  xlsWriteLabel($xlsRow,1,$database->convert_date($result_login['bm_dayclosedate']));
			  
			  xlsWriteLabel($xlsRow,2,$result_login['bm_billno']);*/
			  
			  if($_REQUEST['hidpaytyp']=="cash")
				{
				
			$data['Cash']=number_format(($result_login['bm_amountpaid']-$result_login['bm_amountbalace']),$_SESSION['be_decimal']);
			$data['Final']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
			//$data['Balance']=$result_login['bm_amountbalace'];
					
				} else if($_REQUEST['hidpaytyp']=="credit")
				{
						
						$data['Bank']=$result_login['bm_name'];
                                                $data['Card Payment']=number_format($result_login['bm_transactionamount'],$_SESSION['be_decimal']);
						//$data['Cash']=$result_login['bm_amountpaid']-$result_login['bm_amountbalace'];
						$data['Final']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
			         	//$data['Balance']=$result_login['bm_amountbalace'];
				}else if($_REQUEST['hidpaytyp']=="coupons")
				{
					$coup=$coup + $result_login['bm_couponamt'];
					$data['Coupon Company']=$result_login['bm_couponcompany'];
					$data['Coupon Amount']=number_format($result_login['bm_couponamt'],$_SESSION['be_decimal']);
	             
					 $data['Paid']=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
					   $data['Final']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
					//  $data['Balance']=$result_login['bm_amountbalace'];
			
				}else if($_REQUEST['hidpaytyp']=="voucher")
				{
					  $data['Voucher']=$result_login['bm_voucherid'];
			
					$data['Paid']=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
					$data['Final']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
			  	//$data['Balance']=$result_login['bm_amountbalace'];
			  	//	xlsWriteLabel($xlsRow,6,$result_login['bm_amountbalace']);
					
				}else if($_REQUEST['hidpaytyp']=="cheque")
				{
					
					  $data['Cheque No']=$result_login['bm_chequeno'];
					    $data['Bank Name']=$result_login['bm_chequebankname'];
				
					    $data['Paid']=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
                                            $data['Final']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
						// $data['Balance']=$result_login['bm_amountbalace'];
					/*xlsWriteLabel($xlsRow,5,$result_login['bm_finaltotal']);
			  
			  		xlsWriteLabel($xlsRow,6,$result_login['bm_amountpaid']);
			  
			  		xlsWriteLabel($xlsRow,7,$result_login['bm_amountbalace']);*/
				}
    array_push($data1,$data);
			unset($data);
    $xlsRow++; 
			}
	  }
$data[]="";
$data[]="";
$data[]="";
if($_REQUEST['hidpaytyp']=="cash")
	{
		$data[]="";
		$data[]="";
		$data[]="";
		
	}else if($_REQUEST['hidpaytyp']=="credit")
	{
		
		$fdata[]="";
		$data[]="";
		$data[]="";
			$data[]="";
		
	/*	xlsWriteLabel($xlsRow,3,"");
		
		xlsWriteLabel($xlsRow,4,"");
  
		xlsWriteLabel($xlsRow,5,"");
  
		xlsWriteLabel($xlsRow,6,"");*/
		
	}else if($_REQUEST['hidpaytyp']=="coupons")
	{
		
		$data[]="";
		$data[]="";
		$data[]="";
                $data[]="";
		$data[]="";

		
	}else if($_REQUEST['hidpaytyp']=="voucher")
	{
			$data[]="";
			$data[]="";
			$data[]="";
			$data[]="";
		
		
	}else if($_REQUEST['hidpaytyp']=="cheque")
	{
		
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	}
$xlsRow++; 
unset($data);
		
$data[]="Total";
$data[]="";
$data[]="";

if($_REQUEST['hidpaytyp']=="cash")
	{
	
		$data['Cash']=number_format($paidcash,$_SESSION['be_decimal']);
			$data['Final']=number_format($final,$_SESSION['be_decimal']);
		//$data['Balance']=$bal;
		
	}else if($_REQUEST['hidpaytyp']=="credit")
	{
	$data[]="";
	$data['Card Payment']=number_format($creditsum,$_SESSION['be_decimal']);
	
	//$data['Balance']=$bal;
	$data['Final']=number_format($final,$_SESSION['be_decimal']);
		
	}else if($_REQUEST['hidpaytyp']=="coupons")
	{
		//$data['Coupon Company']="";
		$data[]="";
		$data['Coupon Amount']=number_format($coup,$_SESSION['be_decimal']);

	$data['Paid']=number_format($paid,$_SESSION['be_decimal']);
	//$data['Balance']=$bal;
		$data['Final']=number_format($final,$_SESSION['be_decimal']);
	}else if($_REQUEST['hidpaytyp']=="voucher")
	{
		$data[]="";
		
		$data['Paid']=number_format($paid,$_SESSION['be_decimal']);
		//$data['Balance']=$bal;
	$data['Final']=number_format($final,$_SESSION['be_decimal']);
		
	}else if($_REQUEST['hidpaytyp']=="cheque")
	{
		$data[]="";
		$data[]="";
	
		$data['Paid']=number_format($paid,$_SESSION['be_decimal']);
		$data['Final']=number_format($final,$_SESSION['be_decimal']);
	//	$data['Balance']=$bal;
	}
	array_push($data1,$data);
	unset($data);
		
  $filename = "Payment_type_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;

	
}else if($_REQUEST['type']=="item")
{
	/**********************************************ITEM *****************************************************************/
	 $date=date("Ymd");
	 if($_REQUEST['floorvals']!=''){
	$floor= " and mt.mmr_floorid='".$_REQUEST['floorvals']."' ";
    }
    else{
        $floor='';
    }
        $string_condition='';
        
	$mode=$_REQUEST['mode'];
        
        
        if($_REQUEST['condition']=='dynamic'){
        $string_condition=" and mr.mr_manualrateentry='Y' ";
        }
        
         if($_REQUEST['condition']=='tax_excempt'){
        $string_condition=" and mr.mr_excempt_tax='Y' ";
         }
         
          if($_REQUEST['condition']=='addon'){
        $string_condition=" and mr.mr_add_on='Y' ";
          }
           if($_REQUEST['condition']=='no_print'){
        $string_condition=" and mr.mr_show_in_kot_print='N' ";
           }
           
	$data=array();
$data1=array();
$xlsRow=1;  


	 $sql_cat  =  $database->mysqlQuery("select distinct(mr.mr_maincatid) as catid from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as my ON mr.mr_maincatid=my.mmy_maincategoryid where mr.mr_active='Y'  order by my.mmy_displayorder"); 
	$num_cat   = $database->mysqlNumRows($sql_cat);
	if($num_cat){
		
		
		while($result_cat  = $database->mysqlFetchArray($sql_cat)) 
			{
				$menucat=$database->show_category_ful_details($result_cat['catid']);
				if($menucat['mmy_maincategoryname']!="")
				{
					$data['Category']=$menucat['mmy_maincategoryname'];
					$data['SubCategory']="";
					$data['Items']="";
                                        
                                        
                                        
                                      if( $floor=='' && $mode=='DI' ){
        $sql_login  =  $database->mysqlQuery("select * from tbl_floormaster where fr_status='Active' "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){ $count_flr=0;
	while($result_login  = $database->mysqlFetchArray($sql_login)) 
	{
             $count_flr++;
       $data[' Floor -'. $result_login['fr_floorname']]="";
        
        
        } } }else if($floor!='' && $mode=='DI' ){
            $sql_login  =  $database->mysqlQuery("select * from tbl_floormaster where fr_status='Active' and fr_floorid='".$_REQUEST['floorvals']."' "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
	while($result_login  = $database->mysqlFetchArray($sql_login)) 
	{
           
           $data['Floor -'.$result_login['fr_floorname']]="";
         
          
         }
        }}  
                                        
                                      
					if($mode=='TA'){
				        	$data['Take Away']='';
                                                }
                                                if($mode=='CS'){
                                                  $data['Countersale']='';
                                                } 
					array_push($data1,$data);
			unset($data);
    $xlsRow++; 
					 
								  $sql_sub  =  $database->mysqlQuery("select distinct(mr_subcatid) as subid from tbl_menumaster where mr_active='Y' and mr_maincatid='".$result_cat['catid']."' order by mr_maincatid"); 
				$num_sub  = $database->mysqlNumRows($sql_sub);
				if($num_sub){
					while($result_sub  = $database->mysqlFetchArray($sql_sub)) 
						{
							$menusub=$database->show_subcategory_ful_details($result_sub['subid']);
							
							$data['Category']="";
							$data['SubCategory']=$menusub['msy_subcategoryname'];
		                                   $data['Items']="";
                                                   
                                                   
					       if( $floor=='' && $mode=='DI' ){
        $sql_login  =  $database->mysqlQuery("select * from tbl_floormaster where fr_status='Active' "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){ $count_flr=0;
	while($result_login  = $database->mysqlFetchArray($sql_login)) 
	{
             $count_flr++;
       $data['Floor -'.$result_login['fr_floorname']]="";
        
        
        } } }else if($floor!='' && $mode=='DI' ){
            $sql_login  =  $database->mysqlQuery("select * from tbl_floormaster where fr_status='Active' and fr_floorid='".$_REQUEST['floorvals']."' "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
	while($result_login  = $database->mysqlFetchArray($sql_login)) 
	{
           
           $data['Floor -'.$result_login['fr_floorname']]="";
         
          
         }
        }}  
                                        
                                                
                                                
				        	if($mode=='TA'){
				        	$data['Take Away']='';
                                                }
                                                if($mode=='CS'){
                                                  $data['Countersale']='';
                                                } 
				        	array_push($data1,$data);
			                unset($data);
                            $xlsRow++; 
				$sql_menulist_dine= "select mr_menuid,mr_menuname  from tbl_menumaster  WHERE  mr_active='Y' and  mr_maincatid='".$result_cat['catid']."' and (mr_subcatid='".$result_sub['subid']."' OR  mr_subcatid IS NULL)   order by mr_subcatid ";
		
				$sql_menus  =  $database->mysqlQuery($sql_menulist_dine); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){$l=0;$old="";
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{$l++; 
							//menuname
							  if($l==0)
							  {
								  $old=$result_menus['mr_menuname'];
								  $menuname=$result_menus['mr_menuname'];
							  }else if($l>0)
							  {
								  if($result_menus['mr_menuname']==$old)
								  {
									  $menuname="";
								  }else
								  {
									  $old=$result_menus['mr_menuname'];
									  $menuname=$result_menus['mr_menuname'];
								  }
							  }
						      //Dine 
							  $dinein=array();
                                                        
                                                          $sql_menulist_din="SELECT mt.mmr_floorid,mt.mmr_rate,pm.pm_portionname,tun.u_name,tbun.bu_name FROM tbl_menuratemaster as mt LEFT JOIN tbl_portionmaster as pm ON pm.pm_id=mt.mmr_portion  left join tbl_unit_master tun on tun.u_id=mt.mmr_unit_id left join tbl_base_unit_master tbun on tbun.bu_id=mt.mmr_base_unit_id left join tbl_floormaster fm on fm.fr_floorid=mt.mmr_floorid    WHERE mt.mmr_menuid='".$result_menus['mr_menuid']."' and fm.fr_status='Active' $floor ";//and mt.mta_portion='".$result_menus['pm_id']."'
							  $sql_dn=$database->mysqlQuery($sql_menulist_din); 
							  $num_dn  = $database->mysqlNumRows($sql_dn);
								if($num_dn)
								{
									
									while($result_dn  = $database->mysqlFetchArray($sql_dn)) 
									{
										
                                                                                 
									$dinein[$result_dn['mmr_floorid']].=number_format($result_dn['mmr_rate'],$_SESSION['be_decimal'])."(".$result_dn['pm_portionname']."".$result_dn['u_name']."".$result_dn['bu_name']."), ";
                                                                         
										
									}
								}
							  
							  
							  
							  $takeaway='';
							  $sql_menulist_tak="SELECT mt.mta_rate,pm.pm_portionname,tun.u_name,tbun.bu_name FROM tbl_menuratetakeaway as mt LEFT JOIN tbl_portionmaster as pm ON pm.pm_id=mt.mta_portion  left join tbl_unit_master tun on tun.u_id=mt.mta_unit_id left join tbl_base_unit_master tbun on tbun.bu_id=mt.mta_base_unit_id   WHERE mt.mta_menuid='".$result_menus['mr_menuid']."' ";//and mt.mta_portion='".$result_menus['pm_id']."'
							  $sql_take=$database->mysqlQuery($sql_menulist_tak); 
							  $num_take  = $database->mysqlNumRows($sql_take);
								if($num_take)
								{
									$tak_portion="";$tak_rate="";
									while($result_take  = $database->mysqlFetchArray($sql_take)) 
									{
                                                                            $takeaway1=number_format($result_take['mta_rate'],$_SESSION['be_decimal']);
									$takeaway.=$takeaway1."(".$result_take['pm_portionname']."".$result_take['u_name']."".$result_take['bu_name']."), ";

									}
								}
								 
                                                           $counter='';     
                                                          $sql_menulist_con="SELECT mtc.mrc_rate,pm.pm_portionname,tun.u_name,tbun.bu_name FROM tbl_menurate_counter as mtc LEFT JOIN tbl_portionmaster as pm ON pm.pm_id=mtc.mrc_portion  left join tbl_unit_master tun on tun.u_id=mtc.mrc_unit_id left join tbl_base_unit_master tbun on tbun.bu_id=mtc.mrc_base_unit_id   WHERE mtc.mrc_menuid='".$result_menus['mr_menuid']."' ";//and mt.mta_portion='".$result_menus['pm_id']."'
							  $sql_take1=$database->mysqlQuery($sql_menulist_con); 
							  $num_take1  = $database->mysqlNumRows($sql_take1);
								if($num_take1)
								{
									
									while($result_counter  = $database->mysqlFetchArray($sql_take1)) 
									{
                                                                            $counter1=number_format($result_counter['mrc_rate'],$_SESSION['be_decimal']);
									$counter.=$counter1."(".$result_counter['pm_portionname']."".$result_counter['u_name']."".$result_counter['bu_name']."), ";
									
                                                                        
                                                                        }
								}
								
							
								
							$data['Category']="";
							$data['SubCategory']="";
		                              $data['Items']=$menuname;
                                              
                                       
	
                  
             
               if($mode=='DI' && $_REQUEST['floorvals']==''){
                                       if(count($dinein)>0){
                                           
                                       
                                        $data[ 'Floor -1']=$dinein[1];
                                         $data[ 'Floor -2']=$dinein[2];
                                          $data[ 'Floor -3']=$dinein[3];
                                         
                                           $data[ 'Floor -4']=$dinein[4];
                                           $data[ 'Floor -5']=$dinein[5];
                                            $data[ 'Floor -6']=$dinein[6];
                                             
                                              $data[ 'Floor -7']=$dinein[7];
                                               $data[ 'Floor -8']=$dinein[8];
                                                $data[ 'Floor -9']=$dinein[9];
                                                 $data[ 'Floor -10']=$dinein[10];
                                                  $data[ 'Floor -11']=$dinein[11];
                                      } else{ 
                                        $data[ 'Floor -'. $result_login['fr_floorname']]='';
                                    } }
             
             
             
                  
        if($mode=='DI' && $_REQUEST['floorvals']!='' ){
           for($p=0;$p<count($_REQUEST['floorvals']);$p++){
               
       $data['Floor -'.$result_login['fr_floorname']]=$dinein[$_REQUEST['floorvals']];
           
            }
              }
                                        
                                                if($mode=='TA'){
				        	$data['Take Away']=$takeaway;
                                                }
                                                if($mode=='CS'){
                                                  $data['Countersale']=$counter;
                                                } 
				        	array_push($data1,$data);
			                unset($data);
                            $xlsRow++; 
						
								
						 } }    
                           
                 } } 
                                 
					
				}
			}
		}
	
		$data[]="";
		$data[]="";
		$data[]="";
		$data[]="";
		$data[]="";
		array_push($data1,$data);
	unset($data);	
						
						$filename = "Menu_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;								

	
} else if(($_REQUEST['type']=="steward"))
{
    
    
    $data=array();
$data1=array();
$xlsRow=0;


	$stw=$_REQUEST['hidstw'];
	$string="";
	$reporthead="";
	$st="";
        $string1='';
      if($_REQUEST['stw_mode']=='Cancel'){
        $string .= "  bm.bm_status='Cancelled' ";
      }else{
        $string .= "  bm.bm_status='Closed' ";   
      }
	
			$stewardbydate=$_REQUEST['hidstwdate'];
	//echo $stewardbydate;
              
                        
          $string1.=" ch.ch_cancelledby_careof ='".$_REQUEST['hidstw']."' and ";   
          
                        
	if($stewardbydate!="null")
	{
		//$search="";
	
	if($stewardbydate=="Last5days")
	{
            
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
		$string.=" and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";

$st="Last 5 days";
	}elseif($stewardbydate=="Last10days")
	{
            
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$string.=" and bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";

$st="Last 10 days";
	}
	elseif($stewardbydate=="Last15days")
	{
            
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($stewardbydate=="Last20days")
	{
            
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($stewardbydate=="Last25days")
	{
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($stewardbydate=="Last30days")
	{
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($stewardbydate=="Today")
	{
            $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	else if($stewardbydate=="Yesterday")
			  {
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 1 day";
				  $string.="and bm.bm_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	else if($stewardbydate=="Last1month")
	{
             $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL  1 MONTH AND CURDATE( )";
		$string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";
	}
	
	else if($stewardbydate=="Last90days")
	{
             $string1.= " ch_dayclosedate between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )";
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
	$st="Last 3 months";
	}

else if($stewardbydate=="Last180days")
	{
      $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )";
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
			$st="Last 6 months";
	}
else if($stewardbydate=="Last365days")
	{
		  $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$string.="and bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			$st="Last 1 year";
	}
	$reporthead=$st;

        }
	if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and ( bm.bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                         $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " and ( bm.bm_dayclosedate between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                         $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and ( bm.bm_dayclosedate  between '".$from."' and '".$to."' )  ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                         $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		}else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']=="" && ($stewardbydate=='' || $stewardbydate=='null' ))
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( bm.bm_dayclosedate between '".$from."' and '".$to."' )  ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
                        $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		} 
		//echo "Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_staff =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC";
		
		
//$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

                
      if($_REQUEST['steward_type']=='Detailed'){
                        
                
	$sql_stw  =  $database->mysqlQuery("select m.mr_menuname  as menuname,sum(bd.bd_qty) as ct,sum((bd.bd_rate*bd.bd_qty)) as amnt
      FROM tbl_tablebilldetails bd
      left join tbl_tablebillmaster bm on bd.bd_billno = bm.bm_billno
      left join tbl_menumaster m on bd.bd_menuid = m.mr_menuid
      left join tbl_staffmaster sm ON sm.ser_staffid = bm.bm_steward
      where $string
      and  bm.bm_steward = '".$stw."'
      group by menuname  order by bm.bm_finaltotal asc");
               
		
	
 	  $total_count = 0;
          $total_amount = 0;
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
                      //print_r($result_stw);die();
                      $total_count = $total_count + $result_stw['ct'];
                      $total_amount = $total_amount + $result_stw['amnt'];
                      
                      
                      
                                $data['Sl No']=$i++;
				$data['Item']=$result_stw['menuname'];
				$data['Count ']=$result_stw['ct'];
                                $data['Amount']=number_format($result_stw['amnt'],$_SESSION['be_decimal']);
                                
                                $total_count = $total_count + $billcnt;
                                $total_amount = $total_amount + $res['final'];
				array_push($data1,$data);
			          unset($data);
                      
                      
			}
                        
	  }
          
          
          
          
                                $data['Sl No']='Total';
				$data['Item']='';
				$data['Count ']='';
                                $data['Amount']=number_format($total_amount,$_SESSION['be_decimal']);
                                
                                
				array_push($data1,$data);
			          unset($data);
	 
      
}else{
    
  
    if($_REQUEST['stw_mode']=='Sale'){
    
    
    
	$sql_stw1  =  $database->mysqlQuery("select count(bm.bm_billno) as billcount,bm.bm_dayclosedate,sum(bm.bm_subtotal_final) as amt_new
        FROM   tbl_tablebillmaster bm 
     
        where $string
        and  bm.bm_steward = '".$stw."'
        group by bm.bm_dayclosedate  ");
       
	
 	 
          $total_amount1 = 0; $total_amount12= 0;
	  $num_stw1   = $database->mysqlNumRows($sql_stw1);
	  if($num_stw1){$i=1;
		  while($result_stw1  = $database->mysqlFetchArray($sql_stw1)) 
			{
                     
                    
                      $total_amount1 = $total_amount1 + $result_stw1['amt_new'];
                      
                      
                                $data['Sl no']=$i++;
				$data['Date']=$result_stw1['bm_dayclosedate'];
				$data['Bills ']=$result_stw1['billcount'];
                                $data['Amount']=number_format($result_stw1['amt_new'],$_SESSION['be_decimal']);
                                
                                
				array_push($data1,$data);
			          unset($data);
                      
                     	
			}
                        
	  }
          
          
          
                               $data['Sl no']='Total';
				$data['Date']='';
				$data['Bills ']='';
                                $data['Amount']=number_format($total_amount1,$_SESSION['be_decimal']);
                                
                                
				array_push($data1,$data);
			          unset($data);
	  
      
}else if($_REQUEST['stw_mode']=='Cancel'){
    
    
      
    
	$sql_stw1  =  $database->mysqlQuery("select count(bm.bm_billno) as billcount,bm.bm_dayclosedate,sum(bm.bm_subtotal_final) as amt_new
        FROM   tbl_tablebillmaster bm 
     
        where $string
        and  bm.bm_steward = '".$stw."'
        group by bm.bm_dayclosedate  ");
       
	
 	 
          $total_amount1 = 0; $total_amount12= 0;
	  $num_stw1   = $database->mysqlNumRows($sql_stw1);
	  if($num_stw1){$i=1;
		  while($result_stw1  = $database->mysqlFetchArray($sql_stw1)) 
			{
                     
                    
                      $total_amount1 = $total_amount1 + $result_stw1['amt_new'];
                      
                      
                      
                      
                                $data['Sl no']=$i++;
				$data['Date']=$result_stw1['bm_dayclosedate'];
				$data['Bills ']=$result_stw1['billcount'];
                                $data['Amount']=number_format($result_stw1['amt_new'],$_SESSION['be_decimal']);
                                
                                
				array_push($data1,$data);
			          unset($data);
                     	
			}
                    
                        
	  }
          
                          $data['Sl no']='Total';
				$data['Date']='';
				$data['Bills ']='';
                                $data['Amount']=number_format($total_amount1,$_SESSION['be_decimal']);
                                
                                
				array_push($data1,$data);
			          unset($data);
          
          
	  
    
    
    
}else{
    
        
          
         
     $tot1=0; $tot2=0;
     $sql_login  =  $database->mysqlQuery("Select t.ter_count_combo_ordering,cmb.cod_combo_pack_rate,t.ter_rate,ch.ch_dayclosedate,ch_kotno,ch.ch_entrydate,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,m.mr_menuname,t.ter_entrytime From tbl_tableorder_changes as ch  left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid left join tbl_combo_ordering_details cmb on cmb.cod_orderno=ch.ch_orderno   where  $string1 group by ch.ch_orderno,m.mr_menuname,t.ter_count_combo_ordering"); 

     //echo "Select t.ter_count_combo_ordering,cmb.cod_combo_pack_rate,t.ter_rate,cr_reason,ch.ch_dayclosedate,ch_kotno,ch.ch_entrydate,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,m.mr_menuname,t.ter_entrytime From tbl_tableorder_changes as ch  left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid left join tbl_combo_ordering_details cmb on cmb.cod_orderno=ch.ch_orderno   where  $string1";
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                 	
                      
                      
                                $data['Kot No']=$result_login['ch_kotno'];
				$data['Date']=$result_login['mr_menuname'];
				$data['Bills ']=$result_stw1['billcount'];
                                $data['Amount']=number_format($result_login['ch_cancelled_qty'],$_SESSION['be_decimal']);
                                
                                
				array_push($data1,$data);
			          unset($data);
	          
                             
                          if($result_login['ter_count_combo_ordering']=='' ){
                         
                          $tot1=$tot1+($result_login['ch_cancelled_qty']*$result_login['ter_rate']);  
                         
                         
                         }else{
                         
                          $tot2=$tot2+($result_login['ch_cancelled_qty']*$result_login['cod_combo_pack_rate']);   
                         
                         }
            
 
  
   }
}


                                 $data['Kot No']='Total';
				$data['Date']='';
				$data['Bills ']='';
                                $data['Amount']=number_format($tot2+$tot1,$_SESSION['be_decimal']);
                                
                                
				array_push($data1,$data);
			          unset($data);
                                  
                                  

}

}

$filename = "Steward_report" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;

}

else if($_REQUEST['type']=="stewards_performance_report")
{/***********************************************steward***************************************************/
 $date=date("Ymd");

		$stw=$_REQUEST['hidstw'];
		$string="";
                $strings=" bm_status='Closed' ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and ( bm.bm_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " and ( bm.bm_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " and ( bm.bm_dayclosedate between '".$from."' and '".$to."' )  ";
		}/*else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
		}*/
		else
		{
			
				$stewardbydate=$_REQUEST['hidstwdate'];
	if($stewardbydate!="null")
	{
		//$search="";
	if($stewardbydate=="Last5days")
	{
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and bm.bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	
	else if($stewardbydate=="Last90days")
	{
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}


	}
	
	else
	{
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
			
			
		}
		
		
$data=array();
$data1=array();
$xlsRow=0;  
$total_count = 0;
$total_amount = 0;
/*$final=0;
$paid=0;
$bal=0; */
	  

	
                      
                      //---------------
             $billcnt = 0;
                  
             $sql_login1  =  $database->mysqlQuery("select count(bm.bm_billno)as count,bm.bm_dayclosedate,sm.ser_staffid as stewardid ,UPPER(concat_ws('',sm.ser_firstname,' ',sm.ser_lastname)) as steward, sum(bm.bm_subtotal_final) as final 
FROM tbl_tablebillmaster bm
left join tbl_staffmaster sm ON sm.ser_staffid = bm.bm_steward
where sm.ser_staffid='$stw' and $strings $string 
group by bm.bm_steward, bm.bm_dayclosedate  order by bm.bm_finaltotal asc ");
                    //echo "select sum(ter_qty) as qty, sum(ter_rate * ter_qty) as amnt,ter_dayclosedate as dt from tbl_tableorder where ter_staff = '$stw' and $strings $string group by ter_dayclosedate order by ter_dayclosedate,ter_entrytime ASC";
                $num_login1   = $database->mysqlNumRows($sql_login1);
                if($num_login1){
                    while($res = $database->mysqlFetchArray($sql_login1)){
                          $billcnt=$res['count'];
                    $xlsRow++; 
                      //--------------
				$data['Sl No']=$xlsRow;
				$data['Date']=$res['bm_dayclosedate'];
				$data['Bill Count']=$billcnt;
                                $data['Amount']=number_format($res['final'],$_SESSION['be_decimal']);
                                $total_count = $total_count + $billcnt;
                                $total_amount = $total_amount + $res['final'];
				array_push($data1,$data);
			    unset($data);
                            
               
                
                 }
                    
                }
                
                
			
	$data[]="";
	$data[]="";
	$data[]="";
        $data[]="";
        array_push($data1,$data);
        unset($data);
        
        $data[]="";
        $data['Item']="Total";
        $data['Count']=$total_count;
        $data['Amount']=number_format($total_amount,$_SESSION['be_decimal']); 
        array_push($data1,$data);   
	
        
        
		
		
		
		  $filename = "Steward_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
}



else if($_REQUEST['type']=="steward_timely")
{
	/***********************************************steward***************************************************/
 $date=date("Ymd");

	$string="";
		
		if($_REQUEST['hidstw']!='')
		{
			$stw=$_REQUEST['hidstw'];
			
				$string.="tbl_tableorder.ter_staff =  '".$stw."'    ";
			
		}
	$stewardbydate=$_REQUEST['hidstwdate'];
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$_REQUEST['hidfr'];
			$to=$_REQUEST['hidto'];
			if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";
			}
			else
			{		$string.= "  ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";
				
			}
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$_REQUEST['hidfr'];
			 $to = date('H:i');
			 if($string !="")
			 {
			$string.= " and ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";
			 }
			else
			{		$string.= "  ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";
				
			}
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from = date('H:i');
			$to=$_REQUEST['hidto'];
			if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' )  ";
			}
			else
			{
			$string.= "  ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";		
			}
		}/*else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
		}*/
		else
		{
			$from = date('H:i');
			$to=$_REQUEST['hidto'];
			if($string !="")
			{
			$string.= " and ( bl_tableorder.ter_entrytime between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."'  )  ";
			}
			else
			{
		$string.= "  ( tbl_tableorder.ter_entrytime between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";				
			}
			
			}
		
		
$data=array();
$data1=array();
$xlsRow=1;  
/*$final=0;
$paid=0;
$bal=0; */
/*echo	"Select sum(tbl_tableorder.ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where   $string Group By tbl_menumaster.mr_menuname order by ct DESC";
die();*/

	  
	    $sql_stw  =  $database->mysqlQuery("Select sum(tbl_tableorder.ter_qty) as ct,tbl_tableorder.ter_entrytime,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$data['Sl No']=$xlsRow;
				$data['Item']=$result_stw['menuname'];
				$data['Count']=$result_stw['ct'];
					$data['Entry Time']=$result_stw['ter_entrytime'];
				array_push($data1,$data);
			    unset($data);
                $xlsRow++; 
			}
	  }
	$data[]="";
	$data[]="";
	$data[]="";
		array_push($data1,$data);
		
		
		
		  $filename = "Steward_timely_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;

}



else if($_REQUEST['type']=="items_ordered_timely")
{
	/***********************************************Ordered*************************************************************************/
 $date=date("Ymd");
//$string="";

	$string ="o.ter_status='Closed'";		 
										  
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
		  
		$from=$_REQUEST['hidfr'];
			
			$to=$_REQUEST['hidto'];
			
			
			
								if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and o.ter_floorid='".$bycat."' ";
			}
			else
			{
					 
		$string.="o.ter_floorid='".$bycat."' ";
			}
			
	     }
			
			
			
			
			
			
			if($string !="")
			{
			 $string.= " and o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			else
			{
			$string.= "o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			// $string ="o.ter_status='Closed'";
			$from=$_REQUEST['hidfr'];
			 $to = date('H:i');
		
		if($string !="")
			{
				$string.= "and o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."'  ";
			}
			else
			{
				$string.= "o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			
						
								if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and o.ter_floorid='".$bycat."' ";
			}
			else
			{
					 
		$string.="o.ter_floorid='".$bycat."' ";
			}
			
	     }
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
		 $from = date('H:i');
		$to=$_REQUEST['hidto'];
			if($string !="")
			{
		$string.= "and o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			else
			{
					$string.= "o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['from']."' ";
			}
			
						
									if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and o.ter_floorid='".$bycat."' ";
			}
			else
			{
					 
		$string.="o.ter_floorid='".$bycat."' ";
			}
			
	     }
		}
		
		else{
				 $from = date('H:i');
			 $to = date('H:i');
		//	$to=$_REQUEST['time2'];
			if($string !="")
			{
			$string.= " and o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			else
			{
				$string.= " o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";	
			}
			
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
									if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and o.ter_floorid='".$bycat."' ";
			}
			else
			{
					 
		$string.="o.ter_floorid='".$bycat."' ";
			}
			
	     }
		
	
	
	
		}
		
	
$data=array();
$data1=array();
$xlsRow=1; 
$final=0; 
	$sql_stw  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,o.ter_entrytime as entrytime,p.pm_portionname,f.fr_floorname,sum(o.ter_qty) as qty,ROUND(avg(o.ter_rate), 1) as Unit_Price, ((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $string group by m.mr_maincatid ,m.mr_subcatid,o.ter_menuid,o.ter_portion,o.ter_floorid ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;$t=0;$old="";
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{$t++;
										  if($t==0)
							  {
								  $old=$result_stw['mmy_maincategoryname'];
								  $catname=$result_stw['mmy_maincategoryname'];
								  //$sub=$result_stw['msy_subcategoryname'];
								  //$subname=$result_stw['msy_subcategoryname'];
							  }else if($t>0)
							  {
								  if($result_stw['mmy_maincategoryname']==$old)
								  {
									  $catname="";
									  
									 /* if($result_stw['msy_subcategoryname']==$sub)
									  {
										 $subname="" ;
										  
									  }*/
									/*  else
									  {
									
										if( $result_stw['msy_subcategoryname'] !="")
										  {
										   $subname=$result_stw['msy_subcategoryname'] ;
										    $sub =$result_stw['msy_subcategoryname'];
										  }
										  else
										  {
											  $subname="";
											   $sub ="";
										  }   
									  }*/
									  
									  
									  
								  }else
								  {
									  $old=$result_stw['mmy_maincategoryname'];
									  $catname=$result_stw['mmy_maincategoryname'];
								  }
							  }	
					$final=$final + $result_stw['Total'];
					$data['Category']=$catname;
						$data['Sub Category']=$result_stw['msy_subcategoryname'];
				$data['Item']=$result_stw['mr_menuname'];
						$data['Entry Time']=$result_stw['entrytime'];
				$data['Portion']=$result_stw['pm_portionname'];
				$data['Floor']=$result_stw['fr_floorname'];
				$data['Qty']=$result_stw['qty'];
				$data['Unit Price']=number_format($result_stw['Unit_Price'],$_SESSION['be_decimal']);
				$data['Total']=number_format($result_stw['Total'],$_SESSION['be_decimal']);
				array_push($data1,$data);
			unset($data);
    $xlsRow++; 
				
			}
	  }
	  $data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	array_push($data1,$data);
	unset($data);
	$data[]="Total";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]=number_format($final,$_SESSION['be_decimal']);

	
	array_push($data1,$data);
	  $filename = "Item_order_timely_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;


	
	
	
	
	
}






else if($_REQUEST['type']=="order")
{	$string="";
       
	$string="bm.bm_status = 'Closed'";
       
        //$from="";
        //$to="";
        $addon_head='';
        $string_addon="";
        
        if($_REQUEST['addon']=='N')
	{
            $string_addon.=" and bd.bd_bill_addon_slno IS NULL ";
           
        }
        else if($_REQUEST['addon']=='Y')
	{
            $string_addon.=" and bd.bd_bill_addon_slno IS NOT NULL";
           
            $addon_head='-Addon ';
        }
        
        $st="";
         
        
        
        
        
        
        
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
                    
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                     
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                    
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
                    
                    $st="Last 5 days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    
                    $st="Last 10 days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    
                    $st="Yesterday";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    
                    $st="Last 15 days";
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" and  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    
                    $st="Last 20 days";
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    
                    $st="Last 25 days";
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    
                    $st="Last 30 days";
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    
                    $st="Last 1 Month";
                }
                else if($bydatz=="Today")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    
                    $st="Today";
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    
                    $st="Last 90 days";
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    
                    $st="Last 180 days";
                }
                else if($bydatz=="Last365days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    
                    $st="Last 365 days";
                }
                $reporthead=$st;
                
                
                }
                else
                {
		$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                
                $reporthead="From ".$database->convert_date($from)."To".$database->convert_date($to);
                
                }
                
	}
        
	
	
        
            $data=array();
            $data1=array();
            $xlsRow=1;
        
        
      $final=0;
        $qty=0;
        $qty_final=0;
          $sql_stw  =  $database->mysqlQuery("
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
                                        where $string $string_addon
                                        group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight
                                       order by maincategory, menuid ");
          
                $num_stw   = $database->mysqlNumRows($sql_stw);
                if($num_stw){$i=0;$t=0;$old_cat=""; $old_menu='';$unit_type='';$p=0;
                $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;
                $weight=0;$unit='';$weight_loose=0;$loose_total=0;
                
		while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
                    {  $i++;$p++;
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
                            $qty=$result_stw['qty'];
                            $weight=$result_stw['weight'];
                            
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
                                   
                                    unset($data1[$t-1]);
                                   

                                   $weight_loose=$weight_loose+($result_stw['weight']*$result_stw['qty']);
                                   
                                  
                                   $final=$final-$loose_total;
                                   $loose_total=$loose_total+ $result_stw['total'];
                                   
                                   
                                   $p=$p-1;
                                }else{
                                    $old_menu=$result_stw['menuid'];
                                    $weight_loose=$result_stw['weight']*$result_stw['qty'];
                                    $loose_total=$result_stw['total'];
                                }
                                $weight=$weight_loose;
                                $total=$loose_total;
                                $qty='';
                                $catname=$result_stw['maincategory'];
                                 
                            }
                        $t++;
                        
                            $data['Sl No']=$p;
                            $data['Main Category']=substr(strtoupper($catname),0,20);
                            $data['Sub Categroy']=strtoupper($subcatname);
                            $data['Item']=substr(strtoupper($menuname),0,25);
                            $data['Unit Type']=$unit_type;
                            if($weight != ''){ 
                              $data['Portion/Weight']= number_format(str_replace(',','',$weight),$_SESSION['be_decimal']).'  '.$unit;
                            } 
                            else { 
                                $data['Portion/Weight']= $unit; 
                            }
                            $data['Qty']=$qty;
                            $data['Total']=number_format(str_replace(',','',$total),$_SESSION['be_decimal']);
                            array_push($data1,$data);
                            unset($data);
                          
                          
                          $xlsRow++;                           
                         $final=$final+$total;
                    if($qty!=''){
                        $qty_final=$qty_final+$qty;
                    }                                 
                       }}                                   
            
        $data['Sl No']="";
	$data['Main Category']="";
	$data['Sub Categroy']="";
	$data['Item']="";
	$data['Unit Type']="";
        $data['Portion/Weight']="";
	$data['Qty']="";
	$data['Total']="";
	
        array_push($data1,$data);
        unset($data);
         
        $data['Sl No']="Total";
	$data['Main Category']="";
	$data['Sub Categroy']="";
	$data['Item']="";
	$data['Unit Type']="";
        $data['Portion/Weight']="";
	$data['Qty']=$qty_final;
	$data['Total']=number_format(str_replace(',','',$final),$_SESSION['be_decimal']);
        array_push($data1,$data);
        unset($data);
       
            $filename = " Itemordered $addon_head Report-" . $reporthead . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);     
              
	
     
   //$sqldrop  =  $database->mysqlQuery ("DROP VIEW item"); 
   exit;

}
//------------------------------------------kitchenwise starts--------------------
else if($_REQUEST['type']=="kitchen_wise")
{
    
 $date=date("Ymd");
//$string="";

	$string ="o.ter_status='Closed'";		 
										  
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
		  
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			
			
			
								if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
                        $menuitem=$_REQUEST['item'];
		if($menuitem !=""){
                    $string.=" and o.ter_menuid ='".$menuitem."' ";
                }
			
	     }
		
			if($string !="")
			{
				$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			// $string ="o.ter_status='Closed'";
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
		if($string !="")
			{
				$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			
						
								if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
			
	     }
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			if($string !="")
			{
				$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			
						
									if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
                        $menuitem=$_REQUEST['item'];
		if($menuitem !=""){
                    $string.=" and o.ter_menuid ='".$menuitem."' ";
                }
			
	     }
		}
		
		else{
	
		$bydatz=$_REQUEST['hidbydate'];
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		if($string !="")
		{
		
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
		}
		else
		{
				$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
		}
	}elseif($bydatz=="Last10days")
	{

if($string !="")
{
	
		$string.=" and  o.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
}
else
{
		$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
}
	}
	elseif($bydatz=="Last15days")
	{
		if($string !="")
		{
			$string.="  and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
		}
		else
		{
		$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
		}
	}
	else if($bydatz=="Last20days")
	{
		if($string !="")
		{
				$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
		}
		else
		{
		$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
		}
	}
	else if($bydatz=="Last25days")
	{
		if($string !="")
		{
			$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
		}
		else{
		$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
		}
	}
	else if($bydatz=="Last30days")
	{
		if($string !="")
		{
				$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
		}
		else
		{
		$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
		}
	}
	else if($bydatz=="Today")
	{
		if($string !="")
		{
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}
		else
		{
			$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 		
		}
	}
	
	else if($bydatz=="Yesterday")
			  {
				  if($string !="")
				  {
					    $string.=" and o.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  }
				  else
				  {
					    $string.=" o.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  }
				
			  }
			   else if($bydatz=="Last1month")
			  {
				
				  
				  if($string !="")
				  {
					    $string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
				  else
				  {
					    $string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
				 
				  
			  }
else if($bydatz=="Last90days")
	{
		if($string !="")
		{
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		}
	}
else if($bydatz=="Last180days")
	{
		if($string !="")
		{
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
	
	}
else if($bydatz=="Last365days")
	{
	
		if($string !="")
		{	
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			
		}
		else
		{
			$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		}
	}
	
	
			if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
                        $menuitem=$_REQUEST['item'];
		if($menuitem !=""){
                    $string.=" and o.ter_menuid ='".$menuitem."' ";
                }
			
	     }

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string !="")
			{
			$string.= " and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
			$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			
		
					if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
                        $menuitem=$_REQUEST['item'];
		if($menuitem !=""){
                    $string.=" and o.ter_menuid ='".$menuitem."' ";
                }
			
	     }
	}
	
	
		}

                
//-------------------
     $slno = 0;  
     $total = 0;
     $qty = 0;
$sql_ktc  =  $database->mysqlQuery("select distinct(m.mr_kotcounter),k.kr_kotname from tbl_tableorder o
inner join tbl_menumaster m on m.mr_menuid = o.ter_menuid
inner join tbl_kotcountermaster k on k.kr_kotcode = m.mr_kotcounter where $string
"); 

$num_ktc   = $database->mysqlNumRows($sql_ktc);
if($num_ktc){
  while($result_ktc  = $database->mysqlFetchArray($sql_ktc)) {
      //print_r($result_ktc);exit();
      $slno++;
//---------------------                
$data=array();
$data1=array();
$xlsRow=1; 
$final=0; 
	$sql_stw  =  $database->mysqlQuery("select m.mr_kotcounter,o.ter_menuid, m.mr_menuname,sum(o.ter_qty) as qty, o.ter_rate*sum(o.ter_qty) as tot from tbl_tableorder o
inner join tbl_menumaster m on m.mr_menuid = o.ter_menuid
where m.mr_kotcounter = '".$result_ktc['mr_kotcounter']."' and $string
group by o.ter_menuid"); 

	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;$t=0;$old="";$oldslno="";$newslno="";
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{$t++;
										  if($t==0)
							  {
								  $old=$result_ktc['mr_kotcounter'];
								  $ktcid=$result_ktc['mr_kotcounter'];
                                                                  $ktcname = $result_ktc['kr_kotname'];
                                                                  $oldslno = $slno;
                                                                  $newslno = $slno;
								  
							  }else if($t>0)
							  {
								  if($result_ktc['mr_kotcounter']==$old)
								  {
									  $ktcid="";
                                                                          $ktcname="";
								
								  }else
								  {
									  $old=$result_ktc['mr_kotcounter'];
									  $ktcid=$result_ktc['mr_kotcounter'];
                                                                          $ktcname = $result_ktc['kr_kotname'];
								  }
                                                                  if($slno == $oldslno){
                                                                      $newslno="";
                                                                  }else{
                                                                      $oldslno = $slno;
                                                                      $newslno = $slno;
                                                                  }
                                                                  
							  }	
					$final=$final + $result_stw['tot'];
                                        $data['Sl No']=$newslno;
					$data['Kitchen']=$ktcname;
						
				$data['Item']=$result_stw['mr_menuname'];	
				$data['Qty']=$result_stw['qty'];
				$data['Total']=number_format($result_stw['tot'],$_SESSION['be_decimal']);
				array_push($data1,$data);
			unset($data);
    $xlsRow++; 
				
			}
	  }
  }
}
	  $data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	
	array_push($data1,$data);
	unset($data);
	$data[]="Total";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]=number_format($final,$_SESSION['be_decimal']);

	
	array_push($data1,$data);
	  $filename = "Item_order_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;

} 
//------------------------------------------kitchenwise end--------------------
else if($_REQUEST['type']=="portion_order")
{/***********************************************steward***************************************************/
 $date=date("Ymd");

		$portion=$_REQUEST['prtn'];
		$string="";
		if($portion !="null")
	{
		if($string!="")
		{
			$string.=" and  tbl_tableorder.ter_portion  LIKE  '%" . $portion ."%'";
		}else
		{
			$string.=" tbl_tableorder.ter_portion  LIKE  '%" . $portion ."%'";
		}
	}
		if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ) ";
			}
			else
			{
					$string.= "(tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ) ";
			}
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ) ";
			}
			else
			{
					$string.= "(tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ) ";
			}
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "(tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
			}
		}else 
		{
			/*$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "(tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' )  ";
				
			}*/
			$prtn=$_REQUEST['prtn'];
			$portionbydate=$_REQUEST['hidportn'];
	
	if($portionbydate!="null")
	{
		if($prtn !="null")
		{
	if($portionbydate=="Last5days")
	
	{
			if($string!="")
			{
		
		$string.=" and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";


			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
			}
	}elseif($portionbydate=="Last10days")
	{
		
			if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
	}
	elseif($portionbydate=="Last15days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last20days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last25days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Last30days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
			}
	}
	else if($portionbydate=="Today")
	{
			if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
	}
	
	else if($portionbydate=="Yesterday")
			  {
				  
				  
				  if($string!="")
			{
		 $string.="and tbl_tableorder.ter_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day"; 
			}
				 
			  }
	else if($portionbydate=="Last1month")
	{
  if($string!="")
			{
		 $string.="and tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
			}
				 
	}

	
	
	
	
	else if($portionbydate=="Last90days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			}
			
	}

else if($portionbydate=="Last180days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			}
			
	}
else if($portionbydate=="Last365days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
	}
			
			
			
		}
		else
		{
			//$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			
			
			
		
			
				if($portionbydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	else if($portionbydate=="Yesterday")
			  {
		 $string.=" tbl_tableorder.ter_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($portionbydate=="Last1month")
	{
		 $string.=" tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
	}
	
	
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
			
			
		}
			
			
	}
	else
	{
		
	}
			
		}
		
		
$data=array();
$data1=array();
$xlsRow=1;  
/*$final=0;
$paid=0;
$bal=0; */
	  

	  
	    $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid inner join tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id where  $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$data['Sl No']=$xlsRow;
				$data['Item']=$result_stw['menuname'];
				$data['Count']=$result_stw['ct'];
				$data[$_SESSION['s_portionname']]=$result_stw['pm_portionname'];
				
				array_push($data1,$data);
			    unset($data);
                $xlsRow++; 
			}
	  }
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
		array_push($data1,$data);
		
		
		
		  $filename = $_SESSION['s_portionname']."Order_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
}


else if($_REQUEST['type']=="type_order")
{/***********************************************Type of item**********************************************************/
 $date=date("Ymd");
$string="";
$ordtype=$_REQUEST['ordertyp'];
if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string= " tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string= " tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string= " tbl_tableorder.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" tbl_tableorder.ter_dayclosedate='".$cur."'";*/
		
		
		
	$string="";
	
		$ordertypebydate=$_REQUEST['hidorderby'];
	if($ordertypebydate!="null")
	{
		//$search="";
	if($ordertypebydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($ordertypebydate=="Yesterday")
			  {
				  $string.="tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day ";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($ordertypebydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($ordertypebydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($ordertypebydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	
	else
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		
	}
	
	
$data=array();
$data1=array();
$xlsRow=1;  

    
	$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$data['Sl No']=$xlsRow;
				$data['Item']=$result_stw['menuname'];
			$data['Count']=$result_stw['ct'];
	  			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
				
			}
	  }
$data[]="";
	$data[]="";
	$data[]="";
	array_push($data1,$data);
	unset($data);
	 $filename = "Order_type_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	

}else if($_REQUEST['type']=="cancel_history")
{/***********************************************Type of item**********************************************************/
 $date=date("Ymd");
$string="";
      $reporthead="";
if(isset($_REQUEST['ordertyp']))
$ordtype=$_REQUEST['ordertyp'];
if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string= " ch.ch_dayclosedate between '".$from."' and '".$to."' ";
                               $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string= " ch.ch_dayclosedate between '".$from."' and '".$to."' ";
                               $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string= " ch.ch_dayclosedate between '".$from."' and '".$to."' ";
                               $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	
	else
	{
		/*$cur=date("Y-m-d");
		$string=" ch.ch_date='".$cur."'";*/
		
		
		
	$string="";
	
		$ordertypebydate=$_REQUEST['ordertyp'];//$_REQUEST['hidorderby'];
	if($ordertypebydate!="null")
	{
		//$search="";
	if($ordertypebydate=="Last5days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
                                  $st="Last5days";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                                  $st="Last10days";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                                  $st="Last15days";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" ch.ch_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                                  $st="Last20days";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                                  $st="Last25days";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                    $st="Last30days";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                      $st="Today";
	}
	else if($ordertypebydate=="Yesterday")
			  {
				  $string.="ch.ch_dayclosedate  =  CURDATE() - INTERVAL 1 day ";
                                        $st="Yesterday";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                      $st="Last1month";
	}
	
	else if($ordertypebydate=="Last90days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                      $st="Last90days";
	}

else if($ordertypebydate=="Last180days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                      $st="Last180days";
	}
else if($ordertypebydate=="Last365days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $st="Last365days";
	}

	}
	
	else
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                       $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	$reporthead=$st;	
	}
	
	
$data=array();
$data1=array();
$xlsRow=1;  
 $fuldet1=0;
 $ord=0;
 $kot=0;
 $cancel=0;
 $ser=0;
 $user=0;
 $chr=0;
                             
    
	$sql_stw  =  $database->mysqlQuery("Select  cr_reason,ch.ch_dayclosedate,ch.ch_entrydate,ch_kotno,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,ld.ls_username,m.mr_menuname,t.ter_entrytime From tbl_tableorder_changes as ch LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_cancelledby_careof left join tbl_logindetails as ld on ld.ls_username=ch.ch_cancelledlogin left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid left join tbl_cancellation_reasons on cr_id=ch.ch_cancelledreason where  $string"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
//				$fuldet=$database->show_tableorder_ful_details($result_stw['ch_orderno']);
                      $fuldet1=$fuldet1 + $result_stw['mr_menuname'];
                        $ord=$ord + $result_stw['ch_orderno'];
                      $kot=$kot + $result_stw['ch_kotno'];
			$cancel=$cancel +$result_stw['ch_cancelled_qty'];
			$ser=$ser + $result_stw['ser_firstname'];
                        $user=$user +$result_stw['ls_username'];
			$chr=$chr + $result_stw['ch_cancelledreason'];
				
				$data['Sl No']=$xlsRow;
				$data['Date']=$database->convert_date($result_stw['ch_dayclosedate']);
				
				$data['Order NO']=$result_stw['ch_orderno'];
						$data['KOT NO']=$result_stw['ch_kotno'];
//				$data['Menu']=$fuldet['mr_menuname'];
                                 $data['Menu']=$result_stw['mr_menuname'];
				$data['Qty']=$result_stw['ch_cancelled_qty'];
                                $data['Kot Order Time']=$result_stw['ter_entrytime'];
                                $data['Kot Cancel Date&Time']=$result_stw['ch_entrydate'];
				$data['Cancelled By']=$result_stw['ser_firstname'];
				$data['Cancelled login']=$result_stw['ls_username'];
					$data['Reason for cancellation']=$result_stw['cr_reason'];
					
				array_push($data1,$data);
				unset($data);
				$xlsRow++; 
				
			}
	  }
    $data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
        $data[]="";
	$data[]="";
	array_push($data1,$data);
	unset($data);
	 $filename = "Item_cancel_log_" . $reporthead. ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	

}


else if($_REQUEST['type']=="complementary_report")
{
	
	 $date=date("Ymd");
	 $string="bm_status='Closed' AND bm_complimentary='Y' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."'";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."'";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
	
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	}
	
	
	  
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;


	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $string order by bm_dayclosedate ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 /* if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }*/

	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final + $result_login['bm_finaltotal'];
		
			
			$data['Sl No']=$xlsRow;
			$data['Bill Date']=$database->convert_date($result_login['bm_billdate']);
			$data['Bill No']=$result_login['bm_billno'];
			
			$data['Amount']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
			$data['Remarks']=$result_login['bm_complimentaryremark'];
			
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	
	
	array_push($data1,$data);
	unset($data);
	$data[]="Total";
	$data[]="";
	$data[]="";
		$data[]=number_format($final,$_SESSION['be_decimal']);
	$data[]="";
	

	
	array_push($data1,$data);
	
  $filename = "Complementary_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	

}
else if($_REQUEST['type']=="credit_details")
{
	  $string="";
	  	  if($_REQUEST['catgry']!="")
	    {
		$bycat=$_REQUEST['catgry'];
		$string.=" c.crd_type='".$bycat."' and  ";
            }
	  	if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " (bm.bm_dayclosedate between '".$from."' and '".$to."'  or tbm.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }		
	
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " (bm.bm_dayclosedate between '".$from."' and '".$to."'  or tbm.tab_dayclosedate between '".$from."' and '".$to."' )  ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }			
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= "  (bm.bm_dayclosedate between '".$from."' and '".$to."'  or tbm.tab_dayclosedate between '".$from."' and '".$to."' ) ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }	
					
	else
	{
	
            $bydatz=$_REQUEST['hidbydate'];
	if($bydatz!="null" )	 
	{
	if($bydatz=="Last5days")
	{
            $string.="(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ))";
            $st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ))";
            $st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ))";
            $st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ))";
            $st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{   
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ))";
            $st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( ))";
            $st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ))"; 
            $st="Today";
	}
	else if($bydatz=="Yesterday")
	{
            $string.=" (bm.bm_dayclosedate = CURDATE( ) - INTERVAL 1 DAY  or tbm.tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY )";
            $st="Yesterday";
	}
	else if($bydatz=="Last1month")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ))";
            $st="Last 1 month";
        }
        else if($bydatz=="Last90days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ))"; 
            $st="Last 3 months";
	}
        else if($bydatz=="Last180days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ))"; 
            $st="Last 6 months";
	}
        else if($bydatz=="Last365days")
	{
            $string.=" (bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) or tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ))"; 
            $st="Last 1 year";
	}
	$reporthead=$st;
        }
	else
	{
            $from=date("Y-m-d");
            $to=date("Y-m-d");
            $string.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'  or tbm.tab_dayclosedate between '".$from."' and '".$to."' ) ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }		
	}
	
	
		  
$data=array();
$data1=array();
$xlsRow=1;  
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno where  $string  order by cd.cd_dateofentry ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  
	  $final=0;$nettotal=0;$finaltotal=0;
	  	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final + $result_login['cd_amount'];
                                $modeofentry=$result_login['cd_modeofentry'];
                                
                                if($modeofentry=='DI'){
                                    $sql_finaltotal  =  $database->mysqlQuery("select bm_finaltotal from tbl_tablebillmaster  where  bm_billno='".$result_login['cd_billno']."' "); 
                                    //echo "select bm_finaltotal from tbl_tablebillmaster  where  bm_billno='".$result_login['cd_billno']."'"; 
                                    $num_finaltotal   = $database->mysqlNumRows($sql_finaltotal);
                                    if($num_finaltotal){
                                    while($result_finaltotal  = $database->mysqlFetchArray($sql_finaltotal)) 
                                        {
                                            $finaltotal=$result_finaltotal['bm_finaltotal'];
                                            $nettotal=$nettotal+$result_finaltotal['bm_finaltotal'];
                                        }
                                    }
                                }
                                else
                                {
                                    $sql_finaltotalta  =  $database->mysqlQuery("select tab_netamt from tbl_takeaway_billmaster  where  tab_billno='".$result_login['cd_billno']."'"); 
                                    //echo "select tab_netamt from tbl_takeawaybillmaster  where  tab_billno='".$result_login['cd_billno']."'";
                                    $num_finaltotalta   = $database->mysqlNumRows($sql_finaltotalta);
                                    if($num_finaltotalta){
                                    while($result_finaltotalta  = $database->mysqlFetchArray($sql_finaltotalta)) 
                                        {
                                            $finaltotal=$result_finaltotalta['tab_netamt'];
                                            $nettotal=$nettotal+$result_finaltotalta['tab_netamt'];
                                        }
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
		
			
			$data['Sl No']=$xlsRow;
			$data['Party Name']=$party;
			$data['Category']=$cat;
			
			$data['Bill No']=$result_login['cd_billno'];
			$data['Credit Amount']=number_format($result_login['cd_amount'],$_SESSION['be_decimal']);
			$data['Bill Amount']=number_format($finaltotal,$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
        $data[]="";
	
	
	array_push($data1,$data);
	unset($data);
	$data[]="Total";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]=number_format($final,$_SESSION['be_decimal']);
        $data[]=number_format($nettotal,$_SESSION['be_decimal']);
	
	

	
	array_push($data1,$data);
	
  $filename = "Credit_details_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
}
else if($_REQUEST['type']=="daily_cost")
{
	
	//unset($data_1);unset($data1_2);
	 $mnth=$_REQUEST['monthval'];
	$year=$_REQUEST['yrval'];


	
	if(isset($_REQUEST['set']))
	{
		
		$final =0;
$disctl=0;
$foodcs=0;
$wcs=0;	

						 $mnth=$_REQUEST['monthval']; 
						$taxtot=0;$cnttotl=0;$netval=0;
						
							$data_1=array();
$data1_2=array();
$xlsRow=1; 
$sql_report1  =  $database->mysqlQuery("select distinct bm_dayclosedate from tbl_tablebillmaster ORDER BY bm_dayclosedate ASC "); 	

	 while($result_report  = $database->mysqlFetchArray($sql_report1)) 
			{
		 	$datenw=$result_report['bm_dayclosedate'];
		
			
			$newdate= explode("-",$datenw);
	$date		= $newdate[0];
	$month1		= $newdate[1];
	$year		= $newdate[2];
	if($mnth ==$month1 )
	{

		$sql_report  =  $database->mysqlQuery("select bm_dayclosedate ,sum(bm_finaltotal) as tot ,count(bm_billno) as cnt,sum(bm_servicetax) as tax ,sum(bm_discountvalue) as disc from tbl_tablebillmaster where bm_dayclosedate='".$datenw."' GROUP BY bm_dayclosedate ORDER BY bm_dayclosedate ASC  "); 
		
	  $num_report   = $database->mysqlNumRows($sql_report);
	   if($num_report){
	  
		  while($result_report1  = $database->mysqlFetchArray($sql_report)) 
			{
				$final=$final + $result_report1['tot'];
		
			
				$cnttotl=$cnttotl+$result_report1['cnt'];
				
			$disctl=$disctl+$result_report1['disc'];
			
			$txper=$result_report1['tax']*5.6/100;
				$taxtot=$taxtot+ $txper;
				$net=$result_report1['tot']-$txper;
				$netval=$netval+$net;
 //   echo $a=   $database->convert_date($result_report['bm_dayclosedate']);
	
        $data_1['Date']=$database->convert_date($result_report1['bm_dayclosedate']);
		$data_1['Gross Sale']=number_format($result_report1['tot'],$_SESSION['be_decimal']);
		$data_1['Tax @5.6%']=number_format($txper,$_SESSION['be_decimal']);
		$data_1['Net Sale']=number_format($net,$_SESSION['be_decimal']);
		$data_1['No.Of Invoices']=$result_report1['cnt'];
		
        
                           $sql_report12  =  $database->mysqlQuery("select kndl_date ,sum(kndl_totalcost) as tot ,sum(kndl_totalwastage) as wst from inv_tbl_dailykitchen where kndl_date='".$datenw."' GROUP BY kndl_date ORDER BY kndl_date ASC "); 
	  $num_report12   = $database->mysqlNumRows($sql_report12);
	
	   if($num_report12){
	  
		  while($result_report12  = $database->mysqlFetchArray($sql_report12)) 
			{
				$foodcs=$foodcs + $result_report12['tot'];
				$wcs=$wcs+$result_report12['wst'];
				$data_1['Food Cost']=number_format($result_report12['tot'],$_SESSION['be_decimal']);
				$data_1['Wastage Cost']=number_format($result_report12['wst'],$_SESSION['be_decimal']);
				$data_1['Discount']=number_format($result_report1['disc'],$_SESSION['be_decimal']);
                                
			}
	   } 
	  else { 
	   
      
       $data_1['Food Cost']=0;
				$data_1['Wastage Cost']=0;
				$data_1['Discount']=number_format($result_report1['disc'],$_SESSION['be_decimal']);
	  }
					/*array_push($data1,$data);
			unset($data);;*/
			 //$xlsRow++;
                   
            /* }*/
			 array_push($data1_2,$data_1);
			unset($data_1);
			 $xlsRow++;
				/*$rr++;*/
			}
	  }
	}
	
	

	
	
	
	
	
	
	
	
			}
			//$netsale=0;
			//$netsale=$netsale+$net;
			
			        
            $data_1[]="";
            $data_1[]="";
            $data_1[]="";
            $data_1[]="";
            $data_1[]="";
            $data_1[]="";
            $data_1[]="";
            $data_1[]="";
			array_push($data1_2,$data_1);
			unset($data_1);
				$data_1[]="Total/Avg";
				$data_1[]=number_format($final,$_SESSION['be_decimal']);
				$data_1[]=number_format($taxtot,$_SESSION['be_decimal']);
				$data_1[]=number_format($netval,$_SESSION['be_decimal']);
				$data_1[]=number_format($cnttotl,$_SESSION['be_decimal']);
				$data_1[]=number_format($foodcs,$_SESSION['be_decimal']);
				$data_1[]=number_format($wcs,$_SESSION['be_decimal']);
				$data_1[]=number_format($disctl,$_SESSION['be_decimal']);
			
				 array_push($data1_2,$data_1);
			
				$filename = "Daily_cost_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1_2 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data_1);
  unset($data1_2);
  exit;
	
			
			
				?>				

                            
                            <?php
	
	}
	
	else if(isset($_REQUEST['setyr']))
	{
		
		
		unset($data);unset($data1);
		$final =0;
$disctl=0;
$foodcs=0;
$wcs=0;	
	$data=array();
$data1=array();
$xlsRow=1; 
						 $mnth=$_REQUEST['monthval']; 
						$yrvl=$_REQUEST['yrval'];
						$taxtot=0;$cnttotl=0;$netval=0;
$sql_report1  =  $database->mysqlQuery("select distinct bm_dayclosedate from tbl_tablebillmaster ORDER BY bm_dayclosedate ASC "); 	
	 while($result_report  = $database->mysqlFetchArray($sql_report1)) 
			{
		 	$datenw=$result_report['bm_dayclosedate'];
		
			
			$newdate= explode("-",$datenw);
	$date		= $newdate[0];
	$month1		= $newdate[1];
	$year		= $newdate[2];
	if($mnth ==$month1 && $yrvl == $date)
	{
		$sql_report  =  $database->mysqlQuery("select bm_dayclosedate ,sum(bm_finaltotal) as tot ,count(bm_billno) as cnt,sum(bm_servicetax) as tax,sum(bm_discountvalue) as disc from tbl_tablebillmaster where bm_dayclosedate='".$datenw."' GROUP BY bm_dayclosedate ORDER BY bm_dayclosedate ASC "); 
	  $num_report   = $database->mysqlNumRows($sql_report);
	   if($num_report){
	  
		  while($result_report12  = $database->mysqlFetchArray($sql_report)) 
			{
				$final=$final + $result_report12['tot'];
				$cnttotl=$cnttotl+$result_report12['cnt'];
				$disctl=$disctl+$result_report12['disc'];
				$txper1=$result_report12['tax']*5.6/100;
				$taxtot=$taxtot+ $txper1;
				$net=$result_report12['tot']-$txper1;
					$netval=$netval+$net;
					
					 $data['Date']=$database->convert_date($result_report12['bm_dayclosedate']);
		$data['Gross Sale']=number_format($result_report12['tot'],$_SESSION['be_decimal']);
		$data['Tax @5.6%']=number_format($txper1,$_SESSION['be_decimal']);
		$data['Net Sale']=number_format($net,$_SESSION['be_decimal']);
		$data['No.Of Invoices']=$result_report12['cnt'];
					
					
	
                                
								
								
                           $sql_report123  =  $database->mysqlQuery("select kndl_date ,sum(kndl_totalcost) as tot ,sum(kndl_totalwastage) as wst from inv_tbl_dailykitchen where kndl_date='".$datenw."' GROUP BY kndl_date ORDER BY kndl_date ASC "); 
	  $num_report123   = $database->mysqlNumRows($sql_report123);
	
	   if($num_report123){
	  
		  while($result_report123  = $database->mysqlFetchArray($sql_report123)) 
			{
				
				$foodcs=$foodcs + $result_report123['tot'];
			
				$wcs=$wcs+$result_report123['wst'];
				
				$data['Food Cost']=number_format($result_report123['tot'],$_SESSION['be_decimal']);
                                $data['Wastage Cost']=number_format($result_report123['wst'],$_SESSION['be_decimal']);
					
				$data['Discount']=number_format($result_report12['disc'],$_SESSION['be_decimal']);
				/*
					array_push($data1,$data);
			unset($data);;
			 $xlsRow++;
				*/
				
				 
                
             
                      
                                 
                         
			}
	   }
	   
	 
	else {   
    $data['Food Cost']=0;
		$data['Wastage Cost']=0;
	
   $data['Discount']=number_format($result_report12['disc'],$_SESSION['be_decimal']);
      
                 
                 
				
             
	}
	
	 
                  	array_push($data1,$data);
			unset($data);;
			 $xlsRow++;
	
	}
		
             
				
           
	  }
	}
			}
			
			
				
			
			
				$data[]="";
				$data[]="";
				$data[]="";
				$data[]="";
				$data[]="";
				$data[]="";
				$data[]="";
				$data[]="";
			array_push($data1,$data);
			unset($data);
				$data[]="Total/Avg";
				$data[]=number_format($final,$_SESSION['be_decimal']);
				$data[]=number_format($taxtot,$_SESSION['be_decimal']);
				$data[]=number_format($netval,$_SESSION['be_decimal']);
				$data[]=$cnttotl;
				$data[]=number_format($foodcs,$_SESSION['be_decimal']);
				$data[]=number_format($wcs,$_SESSION['be_decimal']);
				$data[]=number_format($disctl,$_SESSION['be_decimal']);
			
			
			array_push($data1,$data);
			
			
			
			
			$filename = "Daily_cost_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
			
		
		
		}
	else if(isset($_REQUEST['yr']))
	{
		
		$final =0;
		$cnttotl=0;
		
$disctl=0;
$foodcost=0;
$wcost=0;	
$netval=0;
	$data=array();
$data1=array();
$xlsRow=1; 
$taxtot=0;
					 $year_val=$_REQUEST['yrval'];  $monthval=$_REQUEST['monthval'];
						$taxtot=0;$cnttotl=0;$netval=0;
$sql_report1  =  $database->mysqlQuery("select distinct bm_dayclosedate from tbl_tablebillmaster ORDER BY bm_dayclosedate ASC "); 	
 
	 while($result_report  = $database->mysqlFetchArray($sql_report1)) 
			{
		 	$datenw=$result_report['bm_dayclosedate'];
		
			
			$newdate= explode("-",$datenw);
	$year1		= $newdate[0];
	$month		= $newdate[1];
	 $dat		= $newdate[2];
	
	if($year_val ==$year1    )
	{
		$sql_report  =  $database->mysqlQuery("select bm_dayclosedate ,sum(bm_finaltotal) as tot ,count(bm_billno) as cnt,sum(bm_servicetax) as tax,sum(bm_discountvalue) as disc from tbl_tablebillmaster where bm_dayclosedate='".$datenw."' GROUP BY bm_dayclosedate ORDER BY bm_dayclosedate ASC "); 
	  $num_report   = $database->mysqlNumRows($sql_report);
	   if($num_report){
	  
		  while($result_report3  = $database->mysqlFetchArray($sql_report)) 
			{
				$final=$final + $result_report3['tot'];
			
				//$taxtot=$taxtot+$result_report['tax'];
				$cnttotl=$cnttotl+$result_report3['cnt'];
				
			$disctl=$disctl+$result_report3['disc'];
			$txper2=$result_report3['tax']*5.6/100;
				$taxtot=$taxtot+ $txper2;
					$net=$result_report3['tot']-$txper2;
					
					$netval=$netval+$net;
				
				
				 $data['Date']=$database->convert_date($result_report3['bm_dayclosedate']);
		$data['Gross Sale']=$result_report3['tot'];
		$data['Tax @5.6%']=$txper2;
		$data['Net Sale']=$net;
		$data['No.Of Invoices']=$result_report3['cnt'];
						
                           $sql_report12  =  $database->mysqlQuery("select kndl_date ,sum(kndl_totalcost) as tot ,sum(kndl_totalwastage) as wst from inv_tbl_dailykitchen where kndl_date='".$datenw."' GROUP BY kndl_date ORDER BY kndl_date ASC "); 
	  $num_report12   = $database->mysqlNumRows($sql_report12);
	
	   if($num_report12){
	  
		  while($result_report12  = $database->mysqlFetchArray($sql_report12)) 
			{
				
				$foodcost=$foodcost + $result_report12['tot'];
			
				$wcost=$wcost+$result_report12['wst'];
				
					$data['Food Cost']=number_format($result_report12['tot'],$_SESSION['be_decimal']);
                                        $data['Wastage Cost']=number_format($result_report12['wst'],$_SESSION['be_decimal']);
					
				$data['Discount']=number_format($result_report3['disc'],$_SESSION['be_decimal']);
				
					array_push($data1,$data);
			unset($data);;
			 $xlsRow++;
				
				 
                             
			}
	   } else {
       
     $data['Food Cost']=0;
		$data['Wastage Cost']=0;
	
   $data['Discount']=number_format($result_report3['disc'],$_SESSION['be_decimal']);
                  	array_push($data1,$data);
			unset($data);;
			 $xlsRow++;
                             
            
				/*$rr++;*/
	   }}
	  }
	
	
	
		}
			}
			
					
                
                
            $data[]="";
            $data[]="";
            $data[]="";
            $data[]="";
            $data[]="";
            $data[]="";
            $data[]="";
            $data[]="";
			array_push($data1,$data);
			unset($data);
				$data[]="Total/Avg";
				$data[]=number_format($final,$_SESSION['be_decimal']);
				$data[]=number_format($taxtot,$_SESSION['be_decimal']);
				$data[]=number_format($netval,$_SESSION['be_decimal']);
				$data[]=$cnttotl;
				$data[]=number_format($foodcost,$_SESSION['be_decimal']);
				$data[]=number_format($wcost,$_SESSION['be_decimal']);
				$data[]=number_format($disctl,$_SESSION['be_decimal']);
			array_push($data1,$data);
			$filename = "Daily_cost_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;      
		}
		}
		
	else if($_REQUEST['type']=="kot_history")
	{
		
	
	 $date=date("Ymd");
	$string="";
		if($_REQUEST['hidfr']!="" )
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
		
			$string.= "k.kr_date = '".$from."' and o.ter_dayclosedate = '".$from."'    ";
		}
	/*	else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " kr_date between '".$from."' and '".$to."'";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " kr_date between '".$from."' and '".$to."'";
		}*/
	
	else
	{
			
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "k.kr_date = '".$from."' and o.ter_dayclosedate = '".$from."'   ";
	}
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
	//	$bydatz=$_REQUEST['hidbydate'];
		
		
		
			//if($bydatz!="null")
//	{
	/*
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" kr_date between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" kr_date between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="kr_date =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="kr_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
	
else if($bydatz=="Last90days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="kr_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	*/
	//}
	
		
	
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/

	
	
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$paid=0;
$bal=0; 
$dsc=0;
$srvtx=0;
  $subtotal=0;
	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("SELECT k.kr_date,k.kr_kotno as KOT ,k.kr_print as printed,o.ter_status as kot_status,mm.mr_menuname as menu ,pm.pm_portionname AS Portion,o.ter_qty as Qty,o.ter_rate as Unit_Rate, ROUND((o.ter_qty*o.ter_rate),2) as Total_Rate ,o.ter_billnumber FROM tbl_kotmaster K left join tbl_tableorder o on o.ter_kotno = k.kr_kotno LEFT JOIN tbl_menumaster mm ON o.ter_menuid=mm.mr_menuid LEFT JOIN tbl_portionmaster pm ON o.ter_portion=pm.pm_id where $string order by k.kr_time asc"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 /* if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }*/

	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			
			$final=$final+$result_login['Total_Rate'];
			$data['Sl No']=$xlsRow;
			$data['Date']=$database->convert_date($result_login['kr_date']);
			$data['Bill No']=$result_login['ter_billnumber'];
			$data['Kot No']=$result_login['KOT'];
			$data['Print']=$result_login['printed'];
	
			$data['Status']=$result_login['kot_status'];
			$data['Item']=$result_login['menu'];
			$data['Portion']=$result_login['Portion'];
			$data['Qty']=$result_login['Qty'];
		
			$data['Unit Price']=number_format($result_login['Unit_Rate'],$_SESSION['be_decimal']);
			$data['Total']=number_format($result_login['Total_Rate'],$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";	

	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	array_push($data1,$data);
	unset($data);
	$data[]="Total";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]=number_format($final,$_SESSION['be_decimal']);
	array_push($data1,$data);
	
  $filename = "Kot_history_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	
	
		
		
		
		
	}
	
	
	else if($_REQUEST['type']=="loyality_customer")
	{
		


		
	
	 $date=date("Ymd");
	$string="";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " DATE(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " DATE(lr.ly_entrydatetime) between '".$from."' and '".$to."'";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " DATE(lr.ly_entrydatetime) between '".$from."' and '".$to."'";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="DATE(lr.ly_entrydatetime) =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
	
else if($bydatz=="Last90days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "DATE(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	}
	
	
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$paid=0;
$bal=0; 
$dsc=0;
$srvtx=0;
  $subtotal=0;
	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_loyalty_reg as lr  where $string order by ly_entrydatetime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 /* if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }*/

	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			
			
			$data['Sl No']=$xlsRow;
			$data['Name']=$result_login['ly_firstname'].$result_login['ly_lastname'];
			$data['Mobile']=$result_login['ly_mobileno'];
			$data['Email']=$result_login['ly_emailid'];
			
			if($result_login['ly_birthdaydate'] != NULL)
			{
			$data['Birthday']=$database->convert_date($result_login['ly_birthdaydate']);
			}
			else
			{
				$data['Birthday']=NULL;
			}
		if($result_login['ly_anniversarydate'] != NULL)
		{
	
			$data['Anniversary']=$database->convert_date($result_login['ly_anniversarydate']);
		}
		else
		{
			$data['Anniversary']=NULL;
		}
			$data['Marital Status']=$result_login['ly_maritalstatus'];
			$data['Profession']=$result_login['ly_profession'];
			$data['No.of visit']=$result_login['ly_totalvisit'];
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	

	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	array_push($data1,$data);
	unset($data);
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	array_push($data1,$data);
	
  $filename = "Loyality_customer_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
	}
	
	else if($_REQUEST['type']=="loyality_emailphone")
	{
		
	 $date=date("Ymd");
	$string="";

	
	
	
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$paid=0;
$bal=0; 
$dsc=0;
$srvtx=0;
  $subtotal=0;
	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select ly_firstname,ly_lastname,ly_emailid,ly_mobileno,ly_status from tbl_loyalty_reg   order by ly_status ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 /* if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }*/

	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			
			
			$data['Sl No']=$xlsRow;
			$data['Name']=$result_login['ly_firstname'].$result_login['ly_lastname'];
			$data['Mobile']=$result_login['ly_mobileno'];
			$data['Email']=$result_login['ly_emailid'];
			$data['Status']=$result_login['ly_status'];
			
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	array_push($data1,$data);
	unset($data);
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	array_push($data1,$data);
	
  $filename = "Loyality_customer_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
	
		
	}
	
	
	
	
	else if($_REQUEST['type']=="feedback_report")
	{
		$data=array();
$data1=array();
$xlsRow=1;  
$string="";
	$string=" t.ter_feedbackenter='Y' AND ";

		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " t.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " t.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " t.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	
	else 
	{
		
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="t.ter_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" t.ter_dayclosedate = CURDATE( ) - INTERVAL 1 DAY"; 
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	else if($bydatz=="Today")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
else if($bydatz=="Last90days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " t.ter_dayclosedate between '".$from."' and '".$to."' ";
	}
	}
	

  $sql_login  =  $database->mysqlQuery("select * from tbl_tableorder as t left join tbl_menumaster as m on t.ter_menuid=m. mr_menuid left join tbl_portionmaster as pm on t.ter_portion=pm.pm_id where $string order by t.ter_dayclosedate ASC"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
		  
		  while($result_feedback = $database->mysqlFetchArray($sql_login))
		  {
			  
			  	$data['Sl No']=$xlsRow;
			$data['Date']=$database->convert_date($result_feedback['ter_dayclosedate']);
			$data['Menu']=$result_feedback['mr_menuname'];
			$data['Portion']=$result_feedback['pm_portionname'];
			$data['Rating']=$result_feedback['ter_feedbackrating'];
	
			$data['Bill No']=$result_feedback['ter_billnumber'];
			$data['Remarks']=$result_feedback['ter_feedbackremarks'];
			
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";	

	
	array_push($data1,$data);
	unset($data);
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
		$data[]="";
	$data[]="";
	
	
	array_push($data1,$data);
	
  $filename = "Feedback_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
	
	}
	
	else if($_REQUEST['type']=="menu_rating")
	{
		
		
	
		$data=array();
$data1=array();
$xlsRow=1;  
$string="";

if($_REQUEST['hidbymenu']!="")
{
	
	$bydatz=$_REQUEST['hidbymenu'];
$string.=" m.mr_menuname LIKE  '%" . $bydatz ."%' and m.mr_rating > '0' ";
}
	else
	{
		$string="m.mr_rating > '0'";
	}

	

		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		
	
	
	if($string !="")
	{
		$string="where $string";
	}
	
	

  $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster as m  left join tbl_menumaincategory as mc on m.mr_maincatid=mc.mmy_maincategoryid left join tbl_menusubcategory as msc on m.mr_subcatid=msc.msy_subcategoryid   $string order by m.mr_menuid"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	
	  if($num_login)
	  {
		  
		  while($result_feedback = $database->mysqlFetchArray($sql_login))
		  {
			  
			  	$data['Sl No']=$xlsRow;
		
			$data['Menu']=$result_feedback['mr_menuname'];
			$data['Category']=$result_feedback['mmy_maincategoryname'];
			$data['Subcategory']=$result_feedback['msy_subcategoryname'];
			$data['Rating']=$result_feedback['mr_rating'];
			
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	

	
	array_push($data1,$data);
	unset($data);
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
		
	
	
	array_push($data1,$data);
	
  $filename = "Menu_rating_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
	}
	
	else if($_REQUEST['type']=="table_turnover")
	{
		
	 $date=date("Ymd");
	$string="";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tor_date between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " tor_date between '".$from."' and '".$to."'";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tor_date between '".$from."' and '".$to."'";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tor_date between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tor_date between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tor_date between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tor_date between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tor_date between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tor_date between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="tor_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tor_date =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="tor_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
	
else if($bydatz=="Last90days")
	{
		$string.="tor_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tor_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tor_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tor_date between '".$from."' and '".$to."' ";
	}
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	}
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$tot_cust=0;

	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select * from tbl_tableturnover  left join tbl_tablemaster  on tbl_tableturnover.tor_tableid=tbl_tablemaster.tr_tableid  where $string order by tbl_tableturnover.tor_date ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	 /* if($num_login)
	  {
			echo "ok";
	  }else
	  {
		  echo "sorry";
	  }*/

	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$final=$final+$result_login['tor_billamount'];
			$tot_cust=$tot_cust+$result_login['tor_totalcustomer'];
			
			$data['Sl No']=$result_login['tor_slno'];
			$data['Date']=$result_login['tor_date'];
			$data['Table']=$result_login['tr_tableno'];
			$data['Bill No']=$result_login['tor_billno'];
			$data['Total Customer']=$result_login['tor_totalcustomer'];
			$data['Bill Amount']=number_format($result_login['tor_billamount'],$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]="";
	array_push($data1,$data);
	unset($data);
	$data['Total']="";
	$data[]="";
	$data[]="";
	$data[]="";
	$data[]=$tot_cust;
	$data[]=$final;
	array_push($data1,$data);
	
  $filename = "Table_Turnover_Report" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
		
		
		
		
		
		
		
	}
	
else if($_REQUEST['type']=="table_turnoversummary")
    {
    
        $string="";
	$string.=" bm_status='Closed' and bm_complimentary!='Y' and ";
	$reporthead="";
	$st="";
        $print="";
	$from="";
        $to="";
        
            if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
                    $from=$database->convert_date($_REQUEST['fromdt']);
                    $to=$database->convert_date($_REQUEST['todt']);
                    $string.= " bm_dayclosedate  between '".$from."' and '".$to."' ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                    $from=$database->convert_date($_REQUEST['fromdt']);
                    $to=date("Y-m-d");
                    $string.= " bm_dayclosedate  between '".$from."' and '".$to."' ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
                    $from=date("Y-m-d");
                    $to=$database->convert_date($_REQUEST['todt']);
                    $string.= " bm_dayclosedate  between '".$from."' and '".$to."' ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
		
        
	else 
	{
            $bydatz=$_REQUEST['bydate'];
            if($bydatz!="null")
            {
		if($bydatz=="Last5days")
                    {       
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                        $st="Last 5 days";
                    }elseif($bydatz=="Last10days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                        $st="Last 10 days";
                    }
                    elseif($bydatz=="Last15days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                        $st="Last 15 days";
                    }
                    else if($bydatz=="Last20days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                        $st="Last 20 days";
                    }
                    else if($bydatz=="Last25days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                        $st="Last 25 days";
                    }else if($bydatz=="Last30days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                        $st="Last 30 days";
                    }
                    else if($bydatz=="Today")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                        $st="Today";
                    }
                    else if($bydatz=="Yesterday")
                    {
			$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day ";
			$st="Yesterday";
                    }
                    else if($bydatz=="Last1month")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                        $st="Last 1 month";
                    }
                    else if($bydatz=="Last90days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                        $st="Last 3 months";
                    }
                    else if($bydatz=="Last180days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                        $st="Last 6 months";
                    }
                    else if($bydatz=="Last365days")
                    {
                        $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			$st="Last 1 year";
                    }
                    $reporthead=$st;
            }
            else
	{
            $cur=date("Y-m-d");
            $string.=" bm_dayclosedate='".$cur."'";
            $reporthead="On ".$database->convert_date($cur);		
	}
        }
	
$data=array();
$data1=array();
 $final=0;
 $total_cust=0;
 $billamount2=array();
 $tablename2=array();
  $sql_login  =  $database->mysqlQuery("select bm_finaltotal as tot,bm_tableno from tbl_tablebillmaster where $string   order by bm_finaltotal DESC"); 
//echo "select bm_finaltotal as tot,bm_tableno from tbl_tablebillmaster where $string   order by bm_finaltotal DESC";
  $old='';$new='';
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
                            while($result_login  = $database->mysqlFetchArray($sql_login)) 
                            {
				
				$billamount=$result_login['tot'];
                                $tablename=$result_login['bm_tableno'];
                                
                                $tablename1=explode(",",$tablename);
                                
                                for($j=0;$j<count($tablename1);$j++){
                                    $tablename11=explode("(",$tablename1[$j]);
                                    
                                    $tablename2[]=$tablename11[0];
                                    if(array_key_exists($tablename11[0],$billamount2)){
                                    $billamount2[$tablename11[0]]=$billamount2[$tablename11[0]]+$billamount/count($tablename1);
                                    }
                                    else{
                                       $billamount2[$tablename11[0]]=$billamount/count($tablename1); 
                                    }
                                    }
                                
                        }
                        } 
//                        print_r($billamount2);
                        $i=0;
                        foreach($billamount2 as $key=>$val){
                            $i++;
                                
                            $data["Slno"]=$i;
                            $data["TABLE NO"]=$key;
                            $data["AMOUNT"]=number_format($val,$_SESSION['be_decimal']);
                            array_push($data1,$data);
                            unset($data);
                            }
                            $data["Slno"]="TOTAL";
                            $data["TABLE NO"]="";
                            $data["AMOUNT"]=number_format(array_sum($billamount2),$_SESSION['be_decimal']);
                            array_push($data1,$data);
	
  $filename = "Table Turnover Summary" . $reporthead . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;                
                            
   }
else if($_REQUEST['type']=="summary_ham")
{
	
	$date=date("Ymd");
	$string='';
    $reporthead="";
	$strings=" bm_status='Closed' AND ";
	$strngs=" ter_status='Closed' AND ";
	$strin="";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_finaltotal) ";
		$string6_str=" sum(bm_finaltotal)";
		$string7_str=" sum(bm_finaltotal)";
	
	
	
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	
	$string1 =$strings." pym_code='cash'  AND  ";//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string2 = " pym_code='credit'  AND ";//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
			$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	// $string=" bm_status='Closed' AND ";
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			$string_pax.= " (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
			
				$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."'";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			$string_pax.= " (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
				$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."'";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			$string_pax.= " (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
				$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
		}
	
	else
	{
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		$st='';
		
		
	if($bydatz!="null")
	{
		//$search="";
	
				  if($bydatz=="Last5days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
					  $st= " Last 5 days ";
					  	$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
							$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
				  }elseif($bydatz=="Last10days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
					  $st= " Last 10 days ";
					  $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
					$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
				  }
				  elseif($bydatz=="Last15days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
					  $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
					  $st= " Last 15 days ";
					  $strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
				  }
				  else if($bydatz=="Last20days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
						$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
					  $st= " Last 20 days ";
				  }
				  else if($bydatz=="Last25days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
					  $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
					  $strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
					  $st= " Last 25 days ";
				  }
				  else if($bydatz=="Last30days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
					  $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
					$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
					  $st= " Last 30 days ";
					  
				  }
				  else if($bydatz=="Today")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
					  $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
					  $st= " Today ";
					  $strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
				  }
				  else if($bydatz=="Yesterday")
				  {
					  $string.=" bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
					  $string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
					  $st= " Yesterday ";
					  $strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 1  DAY AND CURDATE( )";
				  }
				   else if($bydatz=="Last1month")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  $string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
					  		$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( )";
					  $st= " Last 1 month ";
				  }
				  else if($bydatz=="Last90days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
					  $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
					$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH AND CURDATE( )";	
					  $st= " Last 3 months ";
				  }
				  else if($bydatz=="Last180days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
					  		$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
								$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH AND CURDATE( )";
					  $st= " Last 6 months ";
				  }
				  else if($bydatz=="Last365days")
				  {
					  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
					  	$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
								$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 1  YEAR AND CURDATE( )";
					  $st= " Last 1 year ";
				  }
				  $reporthead=$st; 

	}
	else
	{
		
		
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
		$string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
		$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	}
	
	
	  
$data=array();
$data1=array();
$xlsRow=1;  
  $subtotal=0;
	$cur=date("Y-m-d");
 	  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id  where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
			$data['Type']='Cash';
			$data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		}
			} 
	  }
			
			
		/*	 $sql_login  =  $database->mysqlQuery("select $string2_str as tot from tbl_tablebillmaster where $string2"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$subtotal =$subtotal + $result_login['tot'];
			$data['Type']='Credit';
			$data['Value']=round($result_login['tot']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		}
			} */
			
			
			
			$sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC  "); 
	      
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  
	 
	
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
			if($result_login1['tot'] !="")
				{
			$subtotal =$subtotal + $result_login1['tot'];
			$data['Type']='Credit / Debit card-'.$result_login1['bank_name'];
			$data['Value']=number_format($result_login1['tot'],$_SESSION['be_decimal']);
		array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
           
		}
	  }	
	  }
			
			 $sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$cpn='';
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
				$cpn=$result_login['tot'];
				}else
				{
					$cpn=0;
				}
			$data['Type']='Coupons';
			$data['Value']=number_format($cpn,$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		
			}
	  }
			
			 $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$cpn='';
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
				$cpn=$result_login['tot'];
				}else
				{
					$cpn=0;
				}
			$data['Type']='Voucher';
			$data['Value']=number_format($cpn,$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		
			} 
	  }
			
			 $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$cpn='';
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
				$cpn=$result_login['tot'];
				}else
				{
					$cpn=0;
				}
			$data['Type']='Cheque';
			$data['Value']=number_format($cpn,$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		
			} 
	  }
			
			
					 $sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$cpn='';
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
				$cpn=$result_login['tot'];
				}else
				{
					$cpn=0;
				}
			$data['Type']='Credits';
			$data['Value']=number_format($cpn,$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		
			} 
	  }
			
			
					 $sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$cpn='';
				if($result_login['tot'] !="")
				{
				$subtotal =$subtotal + $result_login['tot'];
				$cpn=$result_login['tot'];
				}else
				{
					$cpn=0;
				}
			$data['Type']='Complimentary';
			$data['Value']=number_format($cpn,$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		
			} 
	  }
			
				  $bev_tot=0;
	  
			
					 $sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) = 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) = 'COLD BEVERAGES')) ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['Total'] !="")
				{
					
						$bev_tot=$bev_tot+$result_login['Total'];
				//$subtotal =$subtotal + $result_login['Total'];
			$data['Type']='Beverages';
			$data['Value']=number_format($result_login['Total'],$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		}
			} 
	  }
	  
	  
	  $food_tot=0;
	  		 $sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) != 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) != 'COLD BEVERAGES')) ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['Total'] !="")
				{
					$food_tot=$food_tot+$result_login['Total'];
				//$subtotal =$subtotal + $result_login['Total'];
			$data['Type']='Food';
			$data['Value']=number_format($result_login['Total'],$_SESSION['be_decimal']);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
    		}
			} 
	  }
	  
	  

	        $tot_per=$food_tot+$bev_tot;
			$food_per=$food_tot/$tot_per*100;
			$bev_per=$bev_tot/$tot_per*100;
            
            $data['Type']='Food Cost(%)';
			$data['Value']=round($food_per,2);
			array_push($data1,$data);
			unset($data);
			$xlsRow++; 
			 $data['Type']='Beverages Cost(%)';
			$data['Value']=round($bev_per,2);
			
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
			
		 $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		   
		//Select sum(ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid  Where   $string_pax Group By tbl_menumaster.mr_menuname order by ct DESC  
		   
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
				//$subtotal =$subtotal + $qtycount;
				
				
				$data['Type']='Total Pax';
			$data['Value']=$qtycount;
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
			
			}}
			
			
						 $bilcount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT count(bm_billno) as bills FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		   
		//Select sum(ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid  Where   $string_pax Group By tbl_menumaster.mr_menuname order by ct DESC  
		   
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$bilcount=$bilcount + $result_stw['bills'];
				//$subtotal =$subtotal + $qtycount;
				
				
				$data['Type']='No.Of Invoices';
			$data['Value']=$bilcount;
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
			
			}}	
			
						 $disct=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_discountvalue) as tt FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		   
		//Select sum(ter_qty) as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid  Where   $string_pax Group By tbl_menumaster.mr_menuname order by ct DESC  
		   
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$disct=$disct + $result_stw['tt'];
				//$subtotal =$subtotal + $qtycount;
				
				
				$data['Type']='Total Discount';
			$data['Value']=number_format($disct,$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);
    		$xlsRow++; 
			
			}}	
		
		
			
	$data['Type']="";
	$data['Value']="";
	array_push($data1,$data);
	unset($data);
	$data['Type']="Total";
	$data['Value']=number_format($subtotal,$_SESSION['be_decimal']);
	
	array_push($data1,$data);
	
  $filename = "Summary_report_" . date('Y-m-d') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag) {
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, 'cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }
  unset($data);
  unset($data1);
  exit;
  
	

	
	
	
	
	
	
}
	
	
	
	
	?>
	
	

	
	
	
	
 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
	
	
	
	
	
	
	
	
  
  
	

	





