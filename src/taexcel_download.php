<?php
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

$taxname1=0;
$taxname2=0;
$taxname3=0;
if($_REQUEST['type']=="tot_sales_ta")
    {
        $reporthead="";
        $st="";
        $string="";
        $staffsel = $_REQUEST['staffsel'];
        $string.=" tab_status = 'Closed' and tab_mode='TA' and tab_complimentary!='Y' AND ";
        if($_REQUEST['staffsel']!='null')
	{
		$string.="tab_loginid='".$staffsel."' AND ";
		
	}
        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
            {
                $from=$database->convert_date($_REQUEST['fromdt']);
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }
        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
            {
                $from=$database->convert_date($_REQUEST['fromdt']);
                $to=date("Y-m-d");
		$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }
        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
            {
		$from=date("Y-m-d");
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }
      
        else
            {
                $bydatz=$_REQUEST['bydate'];
                if($bydatz!="null")
                    {   
                        if($bydatz=="Last5days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                                $st="Last 5 days";
                            }
                        elseif($bydatz=="Last10days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                                $st="Last 10 days";
                            }
                        elseif($bydatz=="Last15days")
                            {
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                $st="Last 15 days";
                            }
                        else if($bydatz=="Last20days")
                            {
                                
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                $st="Last 20 days";
                            }
                        else if($bydatz=="Last25days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                    $st="Last 25 days";
                            }
                        else if($bydatz=="Last30days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                $st="Last 30 days";
                            }
                        else if($bydatz=="Today")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                $st="Today";
                            }
                        else if($bydatz=="Yesterday")
                            {
                                $string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                                $st="Yesterday";
                            }
                        else if($bydatz=="Last1month")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                $st="Last 1 months";
                            }
                        else if($bydatz=="Last90days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                $st="Last 3 months";
                            }
                        else if($bydatz=="Last180days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                                $st="Last 6 months";
                            }
                        else if($bydatz=="Last365days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                                $st="Last 1 year";
                            }
                        $reporthead=$st;
                    }
                else
                    {
                        $from=date("Y-m-d");
                        $to=date("Y-m-d");
                        $string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }
            }
    $data=array();
    $data1=array();
    $final=0;
    $paid=0;
    $bal=0; 
    $dsc=0;
    $subtotal=0;
    $servtax=0;
    $vat=0;
    $servcharge=0;
                    $tax_name=array();
                    $tax_id=array();
                    $sql_login  =  $database->mysqlQuery(" select  distinct(tketm.tbe_taxid) as taxid,tketm.tbe_label as taxname  FROM tbl_takeaway_bill_extra_tax_master tketm left join  tbl_extra_tax_master tm on tm.amc_id=tketm.tbe_taxid group by  amc_id order by tm.amc_id asc "); 
                    $num_login   = $database->mysqlNumRows($sql_login);
                    if($num_login){ 
                        while($result_login=$database->mysqlFetchArray($sql_login)){
                            $tax_name[]=$result_login['taxname'];
                            $tax_id[]=$result_login['taxid'];
                        }} 
    
    $sql_login  =  $database->mysqlQuery("select tab_subtotal,tab_discountvalue,tab_netamt,tab_amountpaid,tab_amountbalace,
    tab_dayclosedate,tab_billno from tbl_takeaway_billmaster where $string");
    $num_login   = $database->mysqlNumRows($sql_login);

    if($num_login)
        {   $i=1;
            while($result_login  = $database->mysqlFetchArray($sql_login)) 
                {
                    $subtotal=$subtotal + $result_login['tab_subtotal'];
                    $dsc=$dsc + $result_login['tab_discountvalue'];
                    $final=$final + $result_login['tab_netamt'];
                    $paid=$paid +$result_login['tab_amountpaid'];
                    $bal=$bal + $result_login['tab_amountbalace'];
                    $data['Slno']=$i;
                    $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
                    $data['Billno']=$result_login['tab_billno'];
                    $data['Sub Total']=number_format($result_login['tab_subtotal'],$_SESSION['be_decimal']);
                        
                    for($s=0;$s<count(array_unique($tax_id));$s++){
                        $sql_taxvalue  =  $database->mysqlQuery("select  tketm.tbe_total_value,tketm.tbe_taxid, tketm.tbe_label FROM tbl_takeaway_bill_extra_tax_master tketm  where tketm.tbe_billno='".$result_login['tab_billno']."' and tketm.tbe_taxid ='".$tax_id[$s]."' order by tketm.tbe_taxid asc"); 
                        $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                
                        if($num_taxvalue){$i=0;
                            while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                            { if($result_taxvalue['tbe_total_value']==''){
                                $result_taxvalue['tbe_total_value']=0;
                            }
                            $tax_value[$result_taxvalue['tbe_taxid']][]=$result_taxvalue['tbe_total_value'];                           
                            $data[$result_taxvalue['tbe_label']]=number_format($result_taxvalue['tbe_total_value'],$_SESSION['be_decimal']);
                           
                                } } 
                               else { 
                                   $tax_value[$tax_id[$s]][]=0;
                                $data[$tax_name[$s]]=number_format(0,$_SESSION['be_decimal']);
                    } }
                    $data['Discount']=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
                    $data['Final']=number_format($result_login['tab_netamt'],$_SESSION['be_decimal']);
                    $data['Paid']=number_format($result_login['tab_amountpaid'],$_SESSION['be_decimal']);
                    $data['Balance']=number_format($result_login['tab_amountbalace'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);                       
                    $i++;
                } 
        } 

            $data['Slno']="";
            $data['Date']="";
            $data['Billno']="";
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
            $data['Slno']="TOTAL";
            $data['Date']="";
            $data['Billno']="";
            $data['Sub Total']=number_format($subtotal,$_SESSION['be_decimal']);
           
            for($i=0;$i<count(array_unique($tax_id));$i++){               
            $data[$tax_name[$i]]=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal']);
            }
            for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++)
            {
                $data[$tax_name[$o]]=number_format(0,$_SESSION['be_decimal']);
            } 
            $data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
            $data['Final']=number_format($final,$_SESSION['be_decimal']);
            $data['Paid']=number_format($paid,$_SESSION['be_decimal']);
            $data['Balance']=number_format($bal,$_SESSION['be_decimal']);
            array_push($data1,$data);
            unset($data);
        
        $filename = "Total Sales report_" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
 else if(($_REQUEST['type']=="qr_sale_timely"))
{
	$string="";
        $stringta="";
        $string_combo="";
        $stringta_combo="";
        $mode="";
        $days="";
        $days2="";
        $days1="";
        $stringdi='';
        
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
          
            $stringta.="  DAYNAME(tbm.tab_dayclosedate) IN ($days2) and ";
            $stringdi.="  DAYNAME(tbm.bm_dayclosedate) IN ($days2) and ";
        }
       }
        
        
       $data=array();
       $data1=array();
	
        
	$stringta.=" tbm.tab_status='Closed' and tab_complimentary!='Y' ";
        $stringdi.= " and tbm.bm_status='Closed' and bm_complimentary!='Y' "; 
        
       
        $reporthead="";
	
	
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			
                        $stringta.= " and  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringdi.= " and  tbm.bm_dayclosedate between '".$from."' and '".$to."' "; 
                        $reporthead.= " From-".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			
                        $stringta.= " and  tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                         $stringdi.= " and  tbm.bm_dayclosedate between '".$from."' and '".$to."' "; 
                        $reporthead.= " From".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			
                        $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                         $stringdi.= " and  tbm.bm_dayclosedate between '".$from."' and '".$to."' "; 
                        $reporthead.= " From".$from."- To-".$to." ";
		}
                
	
	
        else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			
                        $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                          $stringdi.= " and  tbm.bm_dayclosedate between '".$from."' and '".$to."' "; 
                        $reporthead.= " On -".$from;
	}
        
	
 $tot_sum=0;
   $sql_login  =  $database->mysqlQuery("select tbm.tab_qr_order_id,tbm.tab_billno as billno, tbm.tab_netamt as final from tbl_takeaway_billmaster tbm  left join tbl_takeaway_billdetails tbd on tbd.tab_billno=tbm.tab_billno   where tbm.tab_qr_order_id!='' and  $stringta and tbm.tab_time between $newfromtime and $newtotime and tbd.tab_count_combo_ordering IS NULL group by tbm.tab_billno  "); 
       
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {$j=0;
              while($result_login= $database->mysqlFetchArray($sql_login))
              {$j++;
              
              $tot_sum=$tot_sum+$result_login['final'];
              
              $data['Sl']=$j;
                     $data['Bill No']=$result_login['billno'];
                       $data['Qr Order No']=$result_login['tab_qr_order_id'];
                    $data['Amount']=number_format($result_login['final'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
               
	  }
        }

    
                    $data['Sl']="Total";
                    $data['Bill No']="";
                    $data['Amount']=number_format($tot_sum,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
       
   $tot_sum1=0;
   $sql_login  =  $database->mysqlQuery("select tbm.bm_qr_orderno,tbm.bm_billno as billno, tbm.bm_finaltotal as final from tbl_tablebillmaster tbm  where tbm.bm_qr_orderno!=''  $stringdi and tbm.bm_billtime between $newfromtime and $newtotime  group by tbm.bm_billno  "); 
       
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {$j=0;
              while($result_login= $database->mysqlFetchArray($sql_login))
              {$j++;
              
              $tot_sum1=$tot_sum1+$result_login['final'];
              
                    $data['Sl']=$j;
                     $data['Bill No']=$result_login['billno'];
                      $data['Qr Order No']=$result_login['bm_qr_orderno'];
                    $data['Amount']=number_format($result_login['final'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
               
	  }
        }

    
                    $data['Sl']="Total";
                    $data['Bill No']="";
                      $data['Qr Order No']='';
                    $data['Amount']=number_format($tot_sum,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    
   
        $filename = "QR Timely Report" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
    else if(($_REQUEST['type']=="online_item_report"))
{
	$string="";
        $string.="tbm.tab_status='Closed' AND ";
        $reporthead="";
        $st='';
       
           if($_REQUEST['partner']!=''){
            
           $string.= " tbm.tab_food_partner='".$_REQUEST['partner']."' and ";
        } 
	
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                     
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
                
	
	else 
	{
			$bydatz=$_REQUEST['bydate'];
	
	if($bydatz!="null")
	{
		
	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5
DAY AND CURDATE( )";
 $st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                 $st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
        $st="Last 15 days";

	}
	else if($bydatz=="Last20days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
    $st="Last 20 days";

	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                 $st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                 $st="Last 30 days";

	}
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
                                  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                $st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $st="Last 6 months";
                
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $st="Last 1 Year";
	}
              $reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	}
	
	
	 $data=array();
    $data1=array();	
	
       
       $final=0;
 	$sql_item  =  $database->mysqlQuery("SELECT tbm.tab_billno, tbd.tab_menuid, mmc.mmy_maincategoryname, msc.msy_subcategoryname , mm.mr_menuname, sum(tbd.tab_qty)as qty, pm.pm_portionname, tbd.tab_rate, tbd.tab_amount, sum(tab_qty * tab_rate) as Total
        from tbl_takeaway_billmaster tbm
        left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno
        left join tbl_menumaster mm on tbd.tab_menuid = mm.mr_menuid
        left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid = mm.mr_maincatid
        left join tbl_menusubcategory msc on mm.mr_subcatid = msc.msy_subcategoryid
        left join tbl_portionmaster pm on pm.pm_id = tbd.tab_portion
         left join tbl_online_order tod on tod.tol_id=tbm.tab_food_partner
        where tbm.tab_urban_order_id!='' and tod.tol_local_order='N' and  $string   
        group by tbd.tab_menuid ,tbd.tab_portion
        ORDER BY mmc.mmy_maincategoryname ASC"); 

        
        $old="";
        $catname ="";
	  $num_item   = $database->mysqlNumRows($sql_item);
	  if($num_item){$i=1;
		  while($result_item  = $database->mysqlFetchArray($sql_item)) 
			{
                      $final=$final+$result_item['Total'];
                      
                      
                      if($result_item['mmy_maincategoryname']==$old){
                          $catname ="";
                          
                      }else{
                          $catname = $result_item['mmy_maincategoryname'];
                          $old = $result_item['mmy_maincategoryname'];
                      }
                      
				
                
                
                    $data['Category']=$catname;
                    $data['Sub Category']=$result_item['msy_subcategoryname'];
                    $data['Item']=$result_item['mr_menuname'];
                    $data['Portion']=$result_item['pm_portionname'];
                    $data['Qty']=$result_item['qty'];
                    $data['Unit Price']=number_format($result_item['tab_rate'],$_SESSION['be_decimal']);
                    $data['Total']=number_format($result_item['Total'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                
               
			}
	  }
	
      
                    $data['Category']="Total";
                    $data['Sub Category']="";
                    $data['Item']="";
                    $data['Portion']="";
                    $data['Qty']="";
                    $data['Unit Price']="";
                    $data['Total']=number_format($final,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
   
    $filename = "Online Item Report" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
    else if(($_REQUEST['type']=="qr_item_report"))
{
        
        
	$stringdi="";
    $string="";
    
    $string.=" tb.tab_status = 'Closed' and  tb.tab_complimentary!='Y' AND ";
    $stringdi.=" tb.bm_status = 'Closed' and  tb.bm_complimentary!='Y' AND ";
    
    
  if($_REQUEST['name']!=""){
      
       $string.=" mm.mr_menuname like '%".$_REQUEST['name']."%' and  ";
       $stringdi.=" mm.mr_menuname like '%".$_REQUEST['name']."%' and  ";
  }else{
    $string.=" ";  
    $stringdi.='';
  }
    
  
    $reporthead="";
    $st="";
  
        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!=""){
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= " tb.tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
            $stringdi.= " tb.bm_dayclosedate between '".$from."' and '".$to."'order by tb.bm_dayclosedate";
             
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']==""){
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=date("Y-m-d");
            $string.= " tb.tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
            $stringdi.= " tb.bm_dayclosedate between '".$from."' and '".$to."'order by tb.bm_dayclosedate";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!=""){
            $from=date("Y-m-d");
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= " tb.tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate ";
            $stringdi.= " tb.bm_dayclosedate between '".$from."' and '".$to."'order by tb.bm_dayclosedate";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }
        
    
    else {
        $reporthead="";
	$st="";
	$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null"){
            if($bydatz=="Last5days"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ) ";
                $st="Last 5 days";
            }elseif($bydatz=="Last10days"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) ";
                $st="Last 10 days";
            }elseif($bydatz=="Last15days"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
                $st="Last 15 days";
            }else if($bydatz=="Last20days"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
                $st="Last 20 days";
            }else if($bydatz=="Last25days"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
                $st="Last 25 days";
            }else if($bydatz=="Last30days"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( ) ";
                $st="Last 30 days";
            }else if($bydatz=="Today"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) ";
                $st="Today";
            }else if($bydatz=="Yesterday"){
		$string.=" tb.tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
                 $stringdi.= " tb.bm_dayclosedate = CURDATE( ) - INTERVAL 1 DAY  ";
                $st="Yesterday";
            }
	else if($bydatz=="Last1month")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) ";
                $st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) ";
                $st="Last 6 months";
                
	}
else if($bydatz=="Last365days")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) ";
                $st="Last 1 Year";
	}
              $reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tb.tab_dayclosedate between '".$from."' and '".$to."' ";
                         $stringdi.= " tb.bm_dayclosedate between  '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	}
	
	
    $data=array();
    $data1=array();	
	
       
       $final=0;
 	$sql_item  =  $database->mysqlQuery("SELECT tb.tab_billno, tbd.tab_menuid, mmc.mmy_maincategoryname, msc.msy_subcategoryname , mm.mr_menuname, sum(tbd.tab_qty)as qty, pm.pm_portionname, tbd.tab_rate, tbd.tab_amount, sum(tab_qty * tab_rate) as Total
        from tbl_takeaway_billmaster tb
        left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tb.tab_billno
        left join tbl_menumaster mm on tbd.tab_menuid = mm.mr_menuid
        left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid = mm.mr_maincatid
        left join tbl_menusubcategory msc on mm.mr_subcatid = msc.msy_subcategoryid
        left join tbl_portionmaster pm on pm.pm_id = tbd.tab_portion
        where tb.tab_qr_order_id!='' and  $string   
        group by tbd.tab_menuid ,tbd.tab_portion
        ORDER BY mmc.mmy_maincategoryname ASC"); 

        
        $old="";
        $catname ="";
	  $num_item   = $database->mysqlNumRows($sql_item);
	  if($num_item){$i=1;
		  while($result_item  = $database->mysqlFetchArray($sql_item)) 
			{
                      $final=$final+$result_item['Total'];
                      
                      
                      if($result_item['mmy_maincategoryname']==$old){
                          $catname ="";
                          
                      }else{
                          $catname = $result_item['mmy_maincategoryname'];
                          $old = $result_item['mmy_maincategoryname'];
                      }
                      
				
                
                
                    $data['Category']=$catname;
                    $data['Sub Category']=$result_item['msy_subcategoryname'];
                    $data['Item']=$result_item['mr_menuname'];
                    $data['Portion']=$result_item['pm_portionname'];
                    $data['Qty']=$result_item['qty'];
                    $data['Unit Price']=number_format($result_item['tab_rate'],$_SESSION['be_decimal']);
                    $data['Total']=number_format($result_item['Total'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                
               
			}
	  }
	
      
                    $data['Category']="Total [TA]";
                    $data['Sub Category']="";
                    $data['Item']="";
                    $data['Portion']="";
                    $data['Qty']="";
                    $data['Unit Price']="";
                    $data['Total']=number_format($final,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
    ////dine in///////                
                    
                    
         $final1=0;
 	$sql_item  =  $database->mysqlQuery("SELECT tb.bm_billno, tbd.bd_menuid, mmc.mmy_maincategoryname, msc.msy_subcategoryname , mm.mr_menuname, sum(tbd.bd_qty)as qty, pm.pm_portionname, tbd.bd_rate, tbd.bd_amount, sum(bd_qty * bd_rate) as Total
        from tbl_tablebillmaster tb
        left join tbl_tablebilldetails tbd on tbd.bd_billno = tb.bm_billno
        left join tbl_menumaster mm on tbd.bd_menuid = mm.mr_menuid
        left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid = mm.mr_maincatid
        left join tbl_menusubcategory msc on mm.mr_subcatid = msc.msy_subcategoryid
        left join tbl_portionmaster pm on pm.pm_id = tbd.bd_portion
        where tb.bm_qr_orderno!='' and  $stringdi   
        group by tbd.bd_menuid ,tbd.bd_portion
        ORDER BY mmc.mmy_maincategoryname ASC"); 

        
        $old="";
        $catname ="";
	  $num_item   = $database->mysqlNumRows($sql_item);
	  if($num_item){$i=1;
		  while($result_item  = $database->mysqlFetchArray($sql_item)) 
			{
                      $final1=$final1+$result_item['Total'];
                      
                      
                      if($result_item['mmy_maincategoryname']==$old){
                          $catname ="";
                          
                      }else{
                          $catname = $result_item['mmy_maincategoryname'];
                          $old = $result_item['mmy_maincategoryname'];
                      }
                      
				
                
                
                    $data['Category']=$catname;
                    $data['Sub Category']=$result_item['msy_subcategoryname'];
                    $data['Item']=$result_item['mr_menuname'];
                    $data['Portion']=$result_item['pm_portionname'];
                    $data['Qty']=$result_item['qty'];
                    $data['Unit Price']=number_format($result_item['bd_rate'],$_SESSION['be_decimal']);
                    $data['Total']=number_format($result_item['Total'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                
               
			}
	  }
	
      
                    $data['Category']="Total [DI]";
                    $data['Sub Category']="";
                    $data['Item']="";
                    $data['Portion']="";
                    $data['Qty']="";
                    $data['Unit Price']="";
                    $data['Total']=number_format($final1,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                                 
                    
                    
                    
                    
                    
   
        $filename = "QR Item Report" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
    
    
else if($_REQUEST['type']=="qr_customer_report")
{    
    
      $stringdi="";
    $string="";
    
    $string.=" tb.tab_status = 'Closed' and  tb.tab_complimentary!='Y' AND ";
    $stringdi.=" tb.bm_status = 'Closed' and  tb.bm_complimentary!='Y' AND ";
    
    
  if($_REQUEST['name']!=""){
      
       $string.=" tc.tac_customername like '%".$_REQUEST['name']."%' and  ";
       $stringdi.=" tb.bm_cname like '%".$_REQUEST['name']."%' and  ";
  }else{
    $string.=" ";  
    $stringdi.='';
  }
    
    
  if($_REQUEST['cus_add']!=""){
      
       $string.="  tc.tac_contactno like '%".$_REQUEST['cus_add']."%' and  ";
       $string.=" tb.bm_cnumber like '%".$_REQUEST['cus_add']."%' and  ";
  }else{
    $string.=" "; 
    $stringdi.='';
  }
    
    $reporthead="";
    $st="";
  
        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!=""){
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= " tb.tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
            $stringdi.= " tb.bm_dayclosedate between '".$from."' and '".$to."'order by tb.bm_dayclosedate";
             
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']==""){
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=date("Y-m-d");
            $string.= " tb.tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
            $stringdi.= " tb.bm_dayclosedate between '".$from."' and '".$to."'order by tb.bm_dayclosedate";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!=""){
            $from=date("Y-m-d");
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= " tb.tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate ";
            $stringdi.= " tb.bm_dayclosedate between '".$from."' and '".$to."'order by tb.bm_dayclosedate";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }
        
    
    else {
        $reporthead="";
	$st="";
	$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null"){
            if($bydatz=="Last5days"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ) ";
                $st="Last 5 days";
            }elseif($bydatz=="Last10days"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) ";
                $st="Last 10 days";
            }elseif($bydatz=="Last15days"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
                $st="Last 15 days";
            }else if($bydatz=="Last20days"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
                $st="Last 20 days";
            }else if($bydatz=="Last25days"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
                $st="Last 25 days";
            }else if($bydatz=="Last30days"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( ) ";
                $st="Last 30 days";
            }else if($bydatz=="Today"){
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) ";
                $st="Today";
            }else if($bydatz=="Yesterday"){
		$string.=" tb.tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
                 $stringdi.= " tb.bm_dayclosedate = CURDATE( ) - INTERVAL 1 DAY  ";
                $st="Yesterday";
            }
	else if($bydatz=="Last1month")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) ";
                $st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) ";
                $st="Last 6 months";
                
	}
else if($bydatz=="Last365days")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                 $stringdi.= " tb.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) ";
                $st="Last 1 Year";
	}
              $reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tb.tab_dayclosedate between '".$from."' and '".$to."' ";
                         $stringdi.= " tb.bm_dayclosedate between  '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	}
	
	
    
    
	
    $data=array();
    $data1=array();							
                                      
  $dsc=0; $total=0; $final_partner=0; $i=0;
 
 $sql_login  =  $database->mysqlQuery("select tac_contactno ,tab_netamt,tac_customername,tac_address,tab_dayclosedate,tab_billno,tab_qr_order_id from tbl_takeaway_billmaster tb left join tbl_takeaway_customer tc on tc.tac_customerid=tb.tab_hdcustomerid where tb.tab_qr_order_id!='' and  $string");
 $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;   
                        
			$final_partner=$final_partner + $result_login['tab_netamt'];      
                        
                    $data['Sl']=$i;
                    $data['Customer']=$result_login['tac_customername'];
                    $data['Phone']=$result_login['tac_contactno'];
                    $data['Address']= $result_login['tac_address'];
                    $data['Date']=$result_login['tab_dayclosedate'];                  
                    $data['Bill No']=$result_login['tab_billno'];
                    $data['Ordr No']=$result_login['tab_qr_order_id'];
                    $data['Amount']=number_format($result_login['tab_netamt'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);                                                         
                      } } else{  
                    $data['Sl']="";
                    $data['Customer']="";
                    $data['Phone']='';
                    $data['Address']='';
                    $data['Date']="";                  
                    $data['Bill No']="";
                    $data['Ordr No']="";
                    $data['Amount']="";
                    array_push($data1,$data);
                    unset($data);
                    }
                             

                     $data['Sl']="Bill Count : $i";
                     $data['Customer']="";
                     $data['Phone']='';
                     $data['Address']='';
                     $data['Date']="";
                    
                    $data['Bill No']="";
                    $data['Ordr No']="";
                    $data['Amount']="";
                    array_push($data1,$data);
                    unset($data);
 
 
                    $data['Sl']="Total";
                    $data['Customer']="";
                    $data['Phone']='';
                    $data['Date']="";
                    $data['Address']='';
                    $data['Bill No']="";
                    $data['Ordr No']="";
                    $data['Amount']=number_format($final_partner,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    
     ////dine in//////////
                    
                    
  $final_partner1=0; $ic=0;
 $sql_login  =  $database->mysqlQuery("select bm_cnumber,bm_finaltotal,bm_cname,bm_dayclosedate,bm_billno,
 bm_qr_orderno from tbl_tablebillmaster tb  where tb.bm_qr_orderno!='' and  $stringdi");
 $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $ic++;   
                        
			$final_partner1=$final_partner1 + $result_login['bm_finaltotal'];      
                        
                    $data['Sl']=$ic;
                    $data['Customer']=$result_login['bm_cname'];
                    $data['Phone']=$result_login['bm_cnumber'];
                    $data['Address']= '';
                    $data['Date']=$result_login['bm_dayclosedate'];                  
                    $data['Bill No']=$result_login['bm_billno'];
                    $data['Ordr No']=$result_login['bm_qr_orderno'];
                    $data['Amount']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);                                                         
                      } } else{  
                    $data['Sl']="";
                    $data['Customer']="";
                    $data['Phone']='';
                    $data['Address']='';
                    $data['Date']="";                  
                    $data['Bill No']="";
                    $data['Ordr No']="";
                    $data['Amount']="";
                    array_push($data1,$data);
                    unset($data);
                    }
                             

                     $data['Sl']="Bill Count : $ic";
                     $data['Customer']="";
                     $data['Phone']='';
                     $data['Address']='';
                     $data['Date']="";
                    
                    $data['Bill No']="";
                    $data['Ordr No']="";
                    $data['Amount']="";
                    array_push($data1,$data);
                    unset($data);
 
 
                    $data['Sl']="Total";
                    $data['Customer']="";
                    $data['Phone']='';
                    $data['Date']="";
                    $data['Address']='';
                    $data['Bill No']="";
                    $data['Ordr No']="";
                    $data['Amount']=number_format($final_partner1,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);      
                    
                    
                    
        $filename = "QR Customer Bill Report" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
    else if($_REQUEST['type']=="tot_sale_online")
{    
    
    $stringdi='';
    $string="";
    //$typesale=$_REQUEST['typesale'];
    $staffsel = '';
    $string.=" tab_status = 'Closed' and tab_complimentary!='Y' AND ";
     $stringdi.="  bm_status = 'Closed' and  bm_complimentary!='Y' AND ";
    
    if($_REQUEST['partner']!=''){
        
        $string.=" tab_food_partner='".$_REQUEST['partner']."' and  ";
    }
    
    if($_REQUEST['partner_mode']!=''){
        
        $string.=' tab_mode="'.$_REQUEST['partner_mode'].'" and  ';
    }else{
         $string.=" (tab_mode= 'TA' || tab_mode= 'HD') and ";
    }
    
     if($_REQUEST['type_online']=='Local'){
        
        $string.=" tab_urban_order_id is NULL and tab_qr_order_id is NULL and  ";
          $stringdi.=" bm_qr_orderno ='hi' and ";
        
    }else if($_REQUEST['type_online']=='Online'){
        
         $string.=" tab_urban_order_id !='' and tab_qr_order_id is NULL and  ";
           $stringdi.=" bm_qr_orderno ='hi' and ";
         
    }else if($_REQUEST['type_online']=='Qr_code'){
        
         $string.=" tab_qr_order_id !='' and tab_urban_order_id is NULL and  ";
          $stringdi.=" bm_qr_orderno !='' and ";
    }
    
    $reporthead="";
    $st="";
  
        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!=""){
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
              $stringdi.=" bm_dayclosedate between '".$from."' and '".$to."'order by bm_dayclosedate";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']==""){
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=date("Y-m-d");
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
              $stringdi.=" bm_dayclosedate between '".$from."' and '".$to."'order by bm_dayclosedate";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!=""){
            $from=date("Y-m-d");
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate ";
              $stringdi.=" bm_dayclosedate between '".$from."' and '".$to."'order by bm_dayclosedate";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }
        
    
    else {
        $reporthead="";
	$st="";
	$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null"){
            if($bydatz=="Last5days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                  $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( ) ";
                $st="Last 5 days";
            }elseif($bydatz=="Last10days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                  $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( ) ";
                $st="Last 10 days";
            }elseif($bydatz=="Last15days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                  $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( ) ";
                $st="Last 15 days";
            }else if($bydatz=="Last20days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                  $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( ) ";
                $st="Last 20 days";
            }else if($bydatz=="Last25days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                  $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( ) ";
                $st="Last 25 days";
            }else if($bydatz=="Last30days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                  $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( ) ";
                $st="Last 30 days";
            }else if($bydatz=="Today"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                  $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( ) ";
                $st="Today";
            }else if($bydatz=="Yesterday"){
		$string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
                  $stringdi.=" bm_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
                $st="Yesterday";
            }
	else if($bydatz=="Last1month")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                  $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                 $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( ) ";
                $st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                 $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( ) ";
                $st="Last 6 months";
                
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                 $stringdi.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( ) ";
                $st="Last 1 Year";
	}
              $reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                         $stringdi.=" bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	}
        
      $data=array();
    $data1=array(); 
        
   if($_REQUEST['partner_mode']!='DI' || $_REQUEST['partner_mode']==''){    
      
  
    
  $dsc=0; $total=0; $final_partner=0;
  $sql_login  =  $database->mysqlQuery("select tab_ref_no_new,tab_netamt,tab_food_partner_discount,tab_food_partner_total,
  tab_food_partner,tab_dayclosedate,tab_billno,tab_urban_order_id,tab_urban_partner_order_no,tab_qr_order_id from tbl_takeaway_billmaster where $string");
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        $total=$total + $result_login['tab_netamt'];
                        $dsc=$dsc + $result_login['tab_food_partner_discount'];
			$final_partner=$final_partner + $result_login['tab_food_partner_total'];
                        
		$partner='';	
          $sql_login7  =  $database->mysqlQuery("select tol_name from tbl_online_order where tol_id='".$result_login['tab_food_partner']."' ");
  
  	  $num_login7   = $database->mysqlNumRows($sql_login7);
	  if($num_login7){
		  while($result_login7  = $database->mysqlFetchArray($sql_login7)) 
			{
                      $partner=$result_login7['tol_name'];
                      
                  }
                  }
                  
                  $data['Sl No']=$i;
                    $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
                    $data['Bill No']=$result_login['tab_billno'];
                    $data['Partner']=$partner;
                    
                   if($_REQUEST['type_online']=='Local' || $_REQUEST['type_online']=='Online' ){ 
                       
                              $data['Order No']=$result_login['tab_urban_order_id'];
                               $data['Online Order No']=$result_login['tab_urban_partner_order_no'];
                               
                          } else{
                               
                              $data['Order No']=$result_login['tab_qr_order_id'];   
                              $data['Online Order No']='';
                        } 
                    
                    
                     $data['Ref No']=$result_login['tab_ref_no_new'];   
                     
                    $data['Bill Amount']=number_format($result_login['tab_netamt'],$_SESSION['be_decimal']);
                    $data['Partner Discount']=number_format($result_login['tab_food_partner_discount'],$_SESSION['be_decimal']);
                    $data['Partner Amount']=number_format($result_login['tab_food_partner_total'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
	 
                              
                             } }
                             
                            
                    $data['Sl No']='HD Bill Count - '.$i;
                    $data['Date']='';
                    $data['Bill No']='';
                    $data['Partner']='';
                    $data['Order No']='';
                    $data['Online Order No']='';
                     $data['Ref No']='';
                    $data['Bill Amount']='';
                    $data['Partner Discount']='';
                    $data['Partner Amount']='';
                    array_push($data1,$data);
                    unset($data);     
                             
                    $data['Sl No']='Total';
                    $data['Date']='';
                    $data['Bill No']='';
                    
                    $data['Partner']='';
                    $data['Order No']='';
                    $data['Online Order No']='';
                    $data['Ref No']='';
                    $data['Bill Amount']=number_format($total,$_SESSION['be_decimal']);
                    $data['Partner Discount']=number_format($dsc,$_SESSION['be_decimal']);
                    $data['Partner Amount']=number_format($final_partner,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    
   }              
                    
    if($_REQUEST['partner_mode']=='DI' || $_REQUEST['partner_mode']==''){                    
    
    
  $dsc=0; $total=0; $final_partner=0;
  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $stringdi");
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        $total=$total + $result_login['bm_finaltotal'];
                       // $dsc=$dsc + $result_login['tab_food_partner_discount'];
			//$final_partner=$final_partner + $result_login['tab_food_partner_total'];
                        
		$partner='';	
          $sql_login7  =  $database->mysqlQuery("select fr_floorname from tbl_floormaster where fr_floorid='".$result_login['bm_floorid']."' ");
  
  	  $num_login7   = $database->mysqlNumRows($sql_login7);
	  if($num_login7){
		  while($result_login7  = $database->mysqlFetchArray($sql_login7)) 
			{
                      $partner=$result_login7['fr_floorname'];
                      
                  }
                  }
                  
                    $data['Sl No']=$i;
                    $data['Date']=$database->convert_date($result_login['bm_dayclosedate']);
                    $data['Bill No']=$result_login['bm_billno'];
                    $data['Partner']=$partner;
                      
                    $data['Order No']=$result_login['bm_qr_orderno'];   
                    $data['Online Order No']='';
                       
                    $data['Bill Amount']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
                    $data['Partner Discount']=number_format(0,$_SESSION['be_decimal']);
                    $data['Partner Amount']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
	 
                              
                             } }
                             
                            
                    $data['Sl No']='DI Bill Count - '.$i;
                    $data['Date']='';
                    $data['Bill No']='';
                    $data['Partner']='';
                    $data['Order No']='';
                    $data['Online Order No']='';
                    $data['Bill Amount']='';
                    $data['Partner Discount']='';
                    $data['Partner Amount']='';
                    array_push($data1,$data);
                    unset($data);     
                             
                    $data['Sl No']='Total';
                    $data['Date']='';
                    $data['Bill No']='';
                    
                    $data['Partner']='';
                    $data['Order No']='';
                    $data['Online Order No']='';
                    $data['Bill Amount']=number_format($total,$_SESSION['be_decimal']);
                    $data['Partner Discount']=number_format($dsc,$_SESSION['be_decimal']);
                    $data['Partner Amount']=number_format($total,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    
   }    
   
    $filename = "Online Sales Report" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
    else if(($_REQUEST['type']=="customers_ta"))
{
	$string="";
        
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "DATE(tac_entrydate) between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                     
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "DATE(tac_entrydate) between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "DATE(tac_entrydate) between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
               
	else 
	{
			$bydatz=$_REQUEST['bydate'];
	
	if($bydatz!="null")
	{
		
	
	if($bydatz=="Last5days")
	{
		$string.="DATE(tac_entrydate) between CURDATE( ) - INTERVAL 5
DAY AND CURDATE( )";
 $st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.="DATE(tac_entrydate) between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                 $st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.="DATE(tac_entrydate) between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
        $st="Last 15 days";

	}
	else if($bydatz=="Last20days")
	{
		$string.="DATE(tac_entrydate) between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
    $st="Last 20 days";

	}
	else if($bydatz=="Last25days")
	{
		$string.="DATE(tac_entrydate) between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                 $st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.="DATE(tac_entrydate) between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                 $st="Last 30 days";

	}
	else if($bydatz=="Today")
	{
		$string.="DATE(tac_entrydate) between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.="DATE(tac_entrydate) = CURDATE() - INTERVAL 1 DAY " ;
                                  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="DATE(tac_entrydate) between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                $st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="DATE(tac_entrydate) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="DATE(tac_entrydate) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $st="Last 6 months";
                
	}
else if($bydatz=="Last365days")
	{
		$string.="DATE(tac_entrydate) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $st="Last 1 Year";
	}
              $reporthead=$st;
	}
	else
	{
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "DATE(tac_entrydate) between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	}
	
    $data=array();
    $data1=array();
 	$sql_item  =  $database->mysqlQuery("SELECT tac_customername,tac_contactno,tac_address,tac_landmark,tac_area,
    tac_per_address,tac_gst from tbl_takeaway_customer where $string ");  
        
	$num_item   = $database->mysqlNumRows($sql_item);
	  if($num_item){ $i=0;
		  while($result_item  = $database->mysqlFetchArray($sql_item)) 
			{
                      $i++;
                    $data['Sl']=$i;  
	    	        $data['Name']=$result_item['tac_customername'];
                    $data['Number']=$result_item['tac_contactno'];
                    $data['Address']=$result_item['tac_address'];
                    $data['Landmark']=$result_item['tac_landmark'];
                    $data['Area']=$result_item['tac_area'];                 
                    $data['Permanent Address']=$result_item['tac_per_address'];
                    $data['Gst']=$result_item['tac_gst'];
                   
                    array_push($data1,$data);
                    unset($data);
                    
                      }}
                      
                      
                    $a='';
                    $filename = "Customer report". $a.'-'. date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
    
    
    
else if(($_REQUEST['type']=="order_ta"))
{
	$string="";
        $string.="tbm.tab_status='Closed' AND tbm.tab_mode='TA' AND ";
        $reporthead="";
        $addon_head='';
        $stringta_addon='';
            if($_REQUEST['addon']=='N')
            {
                
                $stringta_addon.=" and tbd.tab_bill_addon_slno IS NULL ";
            }
            else if($_REQUEST['addon']=='Y')
            {
                
                $stringta_addon.=" and tbd.tab_bill_addon_slno IS NOT NULL ";
                 $addon_head='-Addon ';
            }
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                     
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
                
	
	else 
	{
			$bydatz=$_REQUEST['bydate'];
	
	if($bydatz!="null")
	{
		
	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5
DAY AND CURDATE( )";
 $st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                 $st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
        $st="Last 15 days";

	}
	else if($bydatz=="Last20days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
    $st="Last 20 days";

	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                 $st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                 $st="Last 30 days";

	}
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
                                  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                $st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $st="Last 6 months";
                
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $st="Last 1 Year";
	}
              $reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	}
	
	
	
	
 	$sql_item  =  $database->mysqlQuery("SELECT tbm.tab_billno, tbd.tab_menuid, mmc.mmy_maincategoryname, msc.msy_subcategoryname , mm.mr_menuname, sum(tbd.tab_qty) as qty, pm.pm_portionname, tbd.tab_rate, tbd.tab_amount,sum(tbd.tab_qty* tbd.tab_rate) as Total
        from tbl_takeaway_billmaster tbm
        left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno
        left join tbl_menumaster mm on tbd.tab_menuid = mm.mr_menuid
        left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid = mm.mr_maincatid
        left join tbl_menusubcategory msc on mm.mr_subcatid = msc.msy_subcategoryid
        left join tbl_portionmaster pm on pm.pm_id = tbd.tab_portion
        where $string  $stringta_addon
        group by tbd.tab_menuid 
        ORDER BY mmc.mmy_maincategoryname ASC"); 

        $data=array();
        $data1=array();
        $old="";
        $catname ="";
        $final=0;
	  $num_item   = $database->mysqlNumRows($sql_item);
	  if($num_item){$i=1;
		  while($result_item  = $database->mysqlFetchArray($sql_item)) 
			{
                        $final=$final+$result_item['Total'];
                      
                      if($result_item['mmy_maincategoryname']==$old){
                          $catname ="";
                          
                      }else{
                          $catname = $result_item['mmy_maincategoryname'];
                          $old = $result_item['mmy_maincategoryname'];
                      }
                    $data['Category']=$catname;
                    $data['Sub Category']=$result_item['msy_subcategoryname'];
                    $data['Item']=$result_item['mr_menuname'];
                    $data['Portion']=$result_item['pm_portionname'];
                    $data['Qty']=$result_item['qty'];
                    $data['Unit Price']=number_format($result_item['tab_rate'],$_SESSION['be_decimal']);
                    $data['Total']=number_format($result_item['tab_amount'],$_SESSION['be_decimal']); 
                    array_push($data1,$data);
                    unset($data);
               
			}
	  }
	  
                
                    $data['Category']="";
                    $data['Sub Category']="";
                    $data['Item']="";
                    $data['Portion']="";
                    $data['Qty']="";
                    $data['Unit Price']="";
                    $data['Total']="";
                    array_push($data1,$data);
                    unset($data);
                    
                    $data['Category']="Total";
                    $data['Sub Category']="";
                    $data['Item']="";
                    $data['Portion']="";
                    $data['Qty']="";
                    $data['Unit Price']="";
                    $data['Total']=number_format($final,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    $filename = "Item Ordered report".$addon_head .'-'. date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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

 else if(($_REQUEST['type']=="categorywise_report_ta"))
{
//	$string="";
     $string=" tbm.tab_status = 'Closed' and tbm.tab_mode='TA' AND ";
        $reporthead="";
	$st="";
 	  
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                     
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
                
	
	
	else 
	{
            $reporthead="";
	$st="";
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		
	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5
DAY AND CURDATE( )";
 $st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                 $st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
        $st="Last 15 days";

	}
	else if($bydatz=="Last20days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
    $st="Last 20 days";

	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                 $st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                 $st="Last 30 days";

	}
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
                                  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                $st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $st="Last 6 months";
                
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $st="Last 1 Year";
	}
              $reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	}
            $data=array();
            $data1=array();
            $total=0;
            $final=0;
           
            $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,count(distinct(tbd.tab_menuid)) as 'no of items',sum(tbd.tab_qty) as qty ,sum(tbd.tab_qty* tbd.tab_rate) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster on mr_menuid =tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC ");
        $num_login   = $database->mysqlNumRows($sql_login);
             if($num_login){$i=1;$t=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$t++;
                          $total=$total+$result_login['Total'];                     
                        
                         
                                $data['Slno']=$i;
                                $data['Category']=$result_login['mmy_maincategoryname'];
                                $data['Item']=$result_login['no of items'];
                                $data['Qty']=$result_login['qty'];
                                $data['Total']=number_format($result_login['Total'],$_SESSION['be_decimal']);
                                array_push($data1,$data);
                                unset($data);
                                 
                               $i++;
                               
                        }} 
                               
                               
                                $data['Slno']="";
                                $data['Category']="";
                                $data['Item']="";
                                $data['Qty']="";
                                $data['Total']="";
                                array_push($data1,$data);
                                unset($data);
                              
                                $data['Slno']="Total";
                                $data['Category']="";
                                $data['Item']="";
                                $data['Qty']="";
                                $data['Total']=number_format($total,$_SESSION['be_decimal']);
                                array_push($data1,$data);
                                unset($data);
                                
                                
        $filename = "Category Wise report_" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
 else if(($_REQUEST['type']=="summary_ta"))
{
	$strings="";
	$reporthead="";
	$string="";
        $strings.=" tab_status='closed' AND tab_mode = 'TA' AND ";

	$string1_str="(sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(tab_transactionamount) ";
	$string3_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string4_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string5_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string6_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace)))";
	$string7_str=" sum(tab_total)";
	$string_pax="";
	$string_pax=" tab_status='Closed' AND ";
        
        $string1 =$strings." ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " tab_complimentary='Y' And pym_code='complimentary' AND";


		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "(tab_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "( tab_dayclosedate  between '".$from."' and '".$to."' ) "; 
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (tab_dayclosedate  between '".$from."' and '".$to."' ) ";
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
          
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$strings.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
				$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" tab_dayclosedate = CURDATE() - INTERVAL 1 day";
		$string_pax.= "tab_dayclosedate =  CURDATE() - INTERVAL 1 day";
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$string_pax.= "tab_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
			$string_pax.= " tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
				$string_pax.= "  tab_dayclosedate   between '".$from."' and '".$to."'";
	}
	
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	
	
  $data=array();
  $data1=array();
          
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
 $sql_login  =  $database->mysqlQuery("select $string1_str as tot 
    from tbl_takeaway_billmaster tb
    left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
    where $string1"."$string order by tab_dayclosedate,tab_time ASC"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
				if($result_login['tot'] != "")	{
			$subtotal =$subtotal + $result_login['tot'];
	
                    $data['Type']="Cash";
                    $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']); 
                    array_push($data1,$data);
                        unset($data);
           
      } }}

$sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id , tbl_bankmaster b 
        where b.bm_id = tb.tab_transcbank and tb.tab_status='Closed' AND $string2 "."$string 
        order by tb.tab_dayclosedate,tb.tab_time ASC "); 

	$num_login1   = $database->mysqlNumRows($sql_login1);
	  
	 
	
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
				$subtotal =$subtotal + $result_login1['tot'];
			
                                $data['Type']="Card";
                                $data['Value']=number_format($result_login1['tot'],$_SESSION['be_decimal']);  
                               array_push($data1,$data);
                                unset($data);
			
			}
	  }
          
          
           $sql_logincreditta  =  $database->mysqlQuery("select distinct (b.bm_name) as bnk, sum(bc.mc_cardamount) as tot  FROM 
                                                    tbl_takeaway_billmaster bm 
                                                    left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id 
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.tab_billno
                                                    left join tbl_bankmaster b  on  b.bm_id = bc.mc_to_bank 
                                                    where tbl_paymentmode.pym_code='credit' and bm.tab_mode='TA'
                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND $string group by bnk");
                      


                  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
                  if($num_logincreditta){
                          while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
                                {  
                                 $data['Type']=$result_logincreditta['bnk'];
                                $data['Value']=number_format($result_logincreditta['tot'],$_SESSION['be_decimal']);  
                               array_push($data1,$data);
                                unset($data);
                          }
                          }
          
          
		$sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3"." $string order by tab_dayclosedate,tab_time ASC"); 
			
	  $num_login   = $database->mysqlNumRows($sql_login);

	  if($num_login)
               {
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
                        {
                            if($result_login['tot'] != "")
                                {
                                    $subtotal =$subtotal + $result_login['tot'];	
                                            
                                    $data['Type']="Coupons";
                                    $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
                                }
                        } 
                }
			
	  $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
                {
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                            if($result_login['tot'] != "")
                                {
                                    $subtotal =$subtotal + $result_login['tot'];

                                    $data['Type']="Voucher";
                                    $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
      
                                }
                        }
                }
			
          $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
                {
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                            if($result_login['tot'] != "")
                                {
                                    $subtotal= $subtotal + $result_login['tot'];
                                    
                                    $data['Type']="Cheque";
                                    $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
         
                                }
                        }
                }
          
          $sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
               {
		    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                            if($result_login['tot'] != "")
                                {
                                    $subtotal =$subtotal + $result_login['tot'];
			
                                        $data['Type']="Credits";
                                        $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                        array_push($data1,$data);
                                         unset($data);
                                } 
                        }
                }	
	
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot 
                        from tbl_takeaway_billmaster tb
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
                        where $string7"." $string order by tab_dayclosedate,tab_time ASC"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['tot'] != "")
			{

			$data['Type']="Complimentary";
                        $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);  
                        array_push($data1,$data);
                        unset($data);    
                        
                        
                        } }}
		
			
			
                            
                          $data['Type']="";
                        $data['Value']="";  
                        array_push($data1,$data);
                        unset($data);
                        
                        $data['Type']="Total";
                        $data['Value']=number_format($subtotal,$_SESSION['be_decimal']);  
                        array_push($data1,$data);
                        unset($data);
                        
        $filename = "Summary report_" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
 else if(($_REQUEST['type']=="total_summary_details_ta"))
{
	$string="";
	$reporthead="";
	$strings=" tab_status='closed' AND tab_mode = 'TA' AND ";
        //$staffsel = $_REQUEST['staffsel'];
	$string1_str=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(tab_transactionamount) ";
	$string3_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string4_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string5_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string6_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace)))";
	$string7_str=" sum(tab_netamt)";
	$string_pax="";
	$string_pax=" tab_status='Closed' AND ";
	//	$string1 =$strings. " tab_paymode='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
	$string1 =$strings." ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " tab_complimentary='Y' And pym_code='complimentary' AND";
	

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "(tab_dayclosedate  between '".$from."' and '".$to."' ) ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "( tab_dayclosedate  between '".$from."' and '".$to."' ) ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (tab_dayclosedate  between '".$from."' and '".$to."' ) ";
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
          
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
				$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" tab_dayclosedate = CURDATE() - INTERVAL 1 day";
		$string_pax.= "tab_dayclosedate =  CURDATE() - INTERVAL 1 day";
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$string_pax.= "tab_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
			$string_pax.= " tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
				$string_pax.= "  tab_dayclosedate   between '".$from."' and '".$to."'";
	}
	
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	
  $data=array();
  $data1=array();
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
  $totalcash=0;
  $totalcoupons=0;
  $totalvoucher=0;
  $totalcheque=0;
  $totalcredits=0;
  $totalcomplimentary=0;
  $totalpax=0;
  $totalcreditordebit=0;
  
  $slno=0;
  $sql = $database->mysqlQuery("select distinct(tab_dayclosedate) from tbl_takeaway_billmaster where $string");
$num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
         
        $total=0;
          $slno++;
        if($result != ""){
            
            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
            $data['SlNo']=$slno;
            $data['Date']=$result['tab_dayclosedate'];
        }
  

  

  $sql_login  =  $database->mysqlQuery("select $string1_str as tot 
from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
where $string1"."$dt order by tab_dayclosedate,tab_time ASC"); 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_login  = $database->mysqlFetchArray($sql_login);
			
		if($result_login['tot'] != "")	{
                                    
                        $totalcash=$totalcash + $result_login['tot'];
                        $total= $total + $result_login['tot'];            
			$subtotal =$subtotal + $result_login['tot'];
                        
                        
			
          
              
          
          $data['Cash']=number_format($result_login['tot'],$_SESSION['be_decimal']);
          
         
             
           }else{
              $data['Cash']="--";
          }}else{
              $data['Cash']="--";
          }
          

	$sql_login1  =  $database->mysqlQuery("select $string2_str as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $strings "." $string2 "."$dt order by tb.tab_dayclosedate,tb.tab_time ASC ");
        $num_login1   = $database->mysqlNumRows($sql_login1);
	
	  if($num_login1){
		  $result_login1  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebit=$totalcreditordebit + $result_login1['tot'];  
			$total= $total + $result_login1['tot'];       
			$subtotal =$subtotal + $result_login1['tot'];
                      
			
            
            $data['Credit/Debit']=number_format($result_login1['tot'],$_SESSION['be_decimal']);
            
      
			
			
	  }else{
              $data['Credit/Debit']="--";
          }
		$sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3"." $dt order by tab_dayclosedate,tab_time ASC"); 
			
            $num_login   = $database->mysqlNumRows($sql_login);
          
            if($num_login){
		  $result_login2  = $database->mysqlFetchArray($sql_login);
			if($result_login2['tot'] != "")	{
				
				$totalcoupons= $totalcoupons + $result_login2['tot'];
                                $total= $total + $result_login2['tot'];       
                                $subtotal =$subtotal + $result_login2['tot'];	
      
                                $data['Coupons']=number_format($result_login2['tot'],$_SESSION['be_decimal']);
         
           
                            }
                        else{
                            $data['Coupons']="--";
                            }
                         }else{
                             $data['Coupons']="--";
                             }
                      
			
           $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4"." $dt order by tab_dayclosedate,tab_time ASC"); 
           $num_login   = $database->mysqlNumRows($sql_login);
           if($num_login){
		  $result_login3  = $database->mysqlFetchArray($sql_login); 
			 
                    if($result_login3['tot'] != "")
			{
			$totalvoucher=$totalvoucher + $result_login3['tot'];
                        $total=$total + $result_login3['tot'];       
                        $subtotal =$subtotal + $result_login3['tot'];
                         
                        $data['Voucher']=number_format($result_login3['tot'],$_SESSION['be_decimal']);        
            
                         }
                    else{
                        $data['Voucher']="--";
                        }
            
                        }
                    else{
                        $data['Voucher']="--";
                        }
			
          $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5"." $dt order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login4  = $database->mysqlFetchArray($sql_login); 
			
			if($result_login4['tot'] != "")
			{
			
                        $totalcheque=$totalcheque + $result_login4['tot'];
                        $total= $total + $result_login4['tot'];       
                        $subtotal =$subtotal + $result_login4['tot'];
                        
                        $data['Cheque']=number_format($result_login4['tot'],$_SESSION['be_decimal']);
         
            
                       } 
                        else{
                            $data['Cheque']="--";
                        }
                        }
                    else{
                            $data['Cheque']="--";
                        }
                        
           $sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6"." $dt order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login5  = $database->mysqlFetchArray($sql_login);
			
			if($result_login5['tot'] != "")
			{
			
                        $totalcredits=$totalcredits + $result_login5['tot'];
                        $total= $total + $result_login5['tot'];     
                        $subtotal =$subtotal + $result_login5['tot'];
                        
                            $data['Credits']=number_format($result_login5['tot'],$_SESSION['be_decimal']);
                         
                        }
                        else{
                            $data['Credits']="--";
                             }
            
                        }
                    else{
                    $data['Credits']="--";
                        } 	
			
	
				
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $string7"." $dt order by tab_dayclosedate,tab_time ASC");
                     
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login6  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_login6['tot'] != "")
			{
			
                        $totalcomplimentary= $totalcomplimentary + $result_login6['tot'];    
  
			
          
                        $data['Complimentary']=number_format($result_login6['tot'],$_SESSION['be_decimal']);
         
                         } 
                         else{
              $data['Complimentary']="--";
          }
                        }
            else{
              $data['Complimentary']="--";
          }
             $data['Total']=number_format($total,$_SESSION['be_decimal']);
               array_push($data1,$data);
               unset($data);
                             
                           
                            
                            
  }
  }
  
  
          $data['Slno']="";
                        $data['Date']="";
                        $data['Cash']="";
                        $data['Credit/Debit']="";
                        $data['Coupons']="";
                        $data['Voucher']="";
                        $data['Cheque']="";
                        $data['Credits']="";
                        $data['Complimentary']="";
                        $data['Total']="";
                        array_push($data1,$data);
                        unset($data);
                        
                        $data['Slno']="TOTAL";
                        $data['Date']=$reporthead;
                        $data['Cash']=number_format($totalcash,$_SESSION['be_decimal']);
                        $data['Credit/Debit']=number_format($totalcreditordebit,$_SESSION['be_decimal']);
                        $data['Coupons']=number_format($totalcoupons,$_SESSION['be_decimal']);
                        $data['Voucher']=number_format($totalvoucher,$_SESSION['be_decimal']);
                        $data['Cheque']=number_format($totalcheque,$_SESSION['be_decimal']);
                        $data['Credits']=number_format($totalcredits,$_SESSION['be_decimal']);
                        $data['Complimentary']=number_format($totalcomplimentary,$_SESSION['be_decimal']);
                        $data['Total']=number_format($subtotal,$_SESSION['be_decimal']);
                        array_push($data1,$data);
                        unset($data);
          
          $filename = "Sales Summary report_" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
else if(($_REQUEST['type']=="cancel_history_ta"))
{
	$string="";
	$reporthead="";
	$st="";
        $string .= " tb.tab_status='Cancelled' AND tb.tab_mode = 'TA' AND ";
        $loginstaffsel = $_REQUEST['staffsel'];
         if($_REQUEST['staffsel']!='null')
	{
		$string.="tb.tab_cancelledlogin='".$loginstaffsel."' AND ";
		
	}
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tb.tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tb.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tb.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		


	
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" tb.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  tb.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
	$reporthead=$st;

	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tb.tab_dayclosedate between '".$from."' and '".$to."' ";
	$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);		
	}
	}
	
 $data=array();
 $data1=array();
 $final=0;
  $paid=0;
  $bal=0; 
 $fuldet1=0;
 $ord=0;
 $kot=0;
 $cancel=0;
 $ser=0;
 $user=0;
 $chr=0;
 $otime=0;
 $qty=0;
 $total=0;
 
  $sql_login  =  $database->mysqlQuery("Select sum( bd.tab_qty) as qty,tb.tab_date, tb.tab_billno, tb.tab_kotno, tb.tab_time, tb.tab_netamt, tb.tab_cancelledtime, tb.tab_loginid, bd.tab_cancelledlogin, bd.tab_cancelledby_careof, tb.tab_cancelledreason, sm.ser_firstname
    From tbl_takeaway_billmaster as tb 
    left join tbl_takeaway_billdetails bd on bd.tab_billno = tb.tab_billno 
    left join tbl_staffmaster sm on sm.ser_staffid = tb.tab_cancelledby_careof
    where $string group by tb.tab_billno"); 
  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$cancelledreason='';
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   
                           $cancelledreason= $result_login['tab_cancelledreason'];
                              if(is_numeric($cancelledreason)){
                              $sql_loginreason  =  $database->mysqlQuery("select cr_id,cr_reason from tbl_cancellation_reasons where cr_id='".$cancelledreason."'");  
                              $num_loginreason=$database->mysqlNumRows($sql_loginreason);
                              if($num_loginreason){
                                   $result_loginreason  = $database->mysqlFetchArray($sql_loginreason);
                                   $cancelledreason=$result_loginreason['cr_reason'];
                              }
                        }
                             
                             $qty = $qty + $result_login['qty'];
                             $total = $total + $result_login['tab_netamt'];
  						
                             $data['Slno']=$i;
                             $data['Date']=$database->convert_date($result_login['tab_date']);
                             $data['Time']=$result_login['tab_time'];
                             $data['Bill no']=$result_login['tab_billno'];
                             $data['Qty']=$result_login['qty'];  
                             $data['Bill Cancel Date&Time']=$result_login['tab_cancelledtime'];
                             $data['Cancelled By']=$result_login['ser_firstname'];
                             $data['Cancelled Login']=$result_login['tab_cancelledlogin'];
                             $data['Reason For Cancellation']=$cancelledreason;
                             $data['Amount']=number_format($result_login['tab_netamt'],$_SESSION['be_decimal']); 
                             array_push($data1,$data);
                             unset($data);

                              $i++;} }
                              
                             $data['Slno']="";
                             $data['Date']="";
                             $data['Time']="";
                             $data['Bill no']=$result_login['tab_billno'];
                             $data['Qty']="";  
                             $data['Bill Cancel Date&Time']="";
                             $data['Cancelled By']="";
                             $data['Cancelled Login']="";
                             $data['Reason For Cancellation']="";
                             $data['Amount']=""; 
                             array_push($data1,$data);
                             unset($data);
                             
                             
                             
                             $data['Slno']="Total";
                             $data['Date']="";
                             $data['Time']="";
                             $data['Bill no']=$result_login['tab_billno'];
                             $data['Qty']=$qty;  
                             $data['Bill Cancel Date&Time']="";
                             $data['Cancelled By']="";
                             $data['Cancelled Login']="";
                             $data['Reason For Cancellation']="";
                             $data['Amount']=number_format($total,$_SESSION['be_decimal']); 
                             array_push($data1,$data);
                             unset($data);
                             
        $filename = "Cancelled History report_" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
else if($_REQUEST['type']=="billreport_ta")
    {
        $string="";
	$string=" tbm.tab_status='Closed' AND tbm.tab_mode='TA'";
	$reporthead="";
        $sort_string='';
        $sort_string1='';
        $sort_string.=$_REQUEST['sortby'];
        
        if($sort_string=='bill_asc'){
           $sort_string1.= " order by tbm.tab_billno asc";
        }
        else if($sort_string=='bill_desc'){
            $sort_string1.= " order by tbm.tab_billno desc";
        }
        else if($sort_string=='value_asc'){
           $sort_string1.= " order by tbm.tab_netamt asc";
        }
        else if($sort_string=='value_desc'){
            $sort_string1.=" order by tbm.tab_netamt desc";
        }
        
        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
            {
		$from=$database->convert_date($_REQUEST['fromdt']);
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
            {
		$from=$database->convert_date($_REQUEST['fromdt']);
		$to=date("Y-m-d");
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
            {
                $from=date("Y-m-d");
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	else
           {
		$bydatz=$_REQUEST['bydate'];
		if($bydatz!="null" && $bydatz!="")
                    {
                        if($bydatz=="Last5days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                                $st="Last5days";
                            }
                        elseif($bydatz=="Last10days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                                $st="Last10days";
                            }
                        else if($bydatz=="Yesterday")
                            {
				$string.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				$st="Yesterday";
                            }
                        elseif($bydatz=="Last15days")
                            {
                                $string.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                $st="Last15days";
                            }
                        else if($bydatz=="Last20days")
                            {
                                $string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                $st="Last20days";
                            }
                        else if($bydatz=="Last25days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                $st="Last25days";
                            }
                        else if($bydatz=="Last30days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                $st="Last30days";
                            }
                        else if($bydatz=="Last1month")
                            {
				$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				$st="Last1month";
                            }
                        else if($bydatz=="Today")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                $st="Today";
                            }
                        else if($bydatz=="Last90days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                $st="Last90days";
                            }
                        else if($bydatz=="Last180days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                                $st="Last180days";
                            }
                        else if($bydatz=="Last365days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                                $st="Last365days";
                            }
                        $reporthead=$st;
                    }
                else
                    {
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }
            }
    
    $data=array();
    $data1=array();
    $final=0; 
    $dsc=0;
    $dscfinal=0;

    $sql_login  =  $database->mysqlQuery("select tbm.tab_netamt,tbm.tab_discountvalue,tbm.tab_billno,tbm.tab_dayclosedate,mm.mr_menuname,tbd.tab_qty,tbd.tab_rate,p.pm_portionname from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid left join tbl_portionmaster p on p.pm_id=tbd.tab_portion where $string $sort_string1 "); 
    $old='';$new='';	 
    $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
            {
                $i=1;$k=1;$each=0;$dsc=0;
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
                    {
			$final=$final+($result_login['tab_rate'] * $result_login['tab_qty']);
                        if($i==1)
                            {
                                $dscfinal=$dscfinal+($result_login['tab_discountvalue']);
				$dsc=$dsc + ($result_login['tab_discountvalue']);
				$each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
                $old=$result_login['tab_billno'];
				$new=$result_login['tab_billno'];

                                $data['Slno']=$i;
                                $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
				$data['Bill no']=$result_login['tab_billno'];
                                $data['Items']=$result_login['mr_menuname'];
                                $data['Portions']=$result_login['pm_portionname'];
				$data['Quntity']=$result_login['tab_qty'];
		                $data['Rate']=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal']);
                                $data['Discount']=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
                                array_push($data1,$data);
                                unset($data);
        
                            }
                        else
                            {
				$old=$new;
				$new=$result_login['tab_billno'];
				if($new==$old)
                                    {
                                        $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
					
                                        $data['Slno']="";
                                        $data['Date']="";
                                        $data['Bill no']="";
                                        $data['Items']=$result_login['mr_menuname'];
                                        $data['Portions']=$result_login['pm_portionname'];
                                        $data['Quntity']=$result_login['tab_qty'];
                                        $data['Rate']=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal']);
                                        $data['Discount']=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
                                        array_push($data1,$data);
                                        unset($data);
                                    }
                                else
                                    {
					$data['Slno']="Total";
                                        $data['Date']="";
                                        $data['Bill no']="";
                                        $data['Items']="";
                                        $data['Portions']="";
                                        $data['Quntity']="";
                                        $data['Rate']=number_format($each,$_SESSION['be_decimal']);
                                        $data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
                                        array_push($data1,$data);
                                        unset($data);

                                        $each=0;$dsc=0;
                                        $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
                                        $dsc=$dsc + $result_login['tab_discountvalue'];
                                        $dscfinal=$dscfinal+$result_login['tab_discountvalue'];
		
                                        $data['Slno']=$k++;
                                        $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
                                        $data['Bill no']=$result_login['tab_billno'];
                                        $data['Items']=$result_login['mr_menuname'];
                                        $data['Portions']=$result_login['pm_portionname'];
                                        $data['Quntity']=$result_login['tab_qty'];           
                                        $data['Rate']=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal']);
                                        $data['Discount']=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
                                        array_push($data1,$data);
                                        unset($data);
                                    }
                            }
				$i++;

                    }
                    
                $data['Slno']="Total";
                $data['Date']="";
                $data['Bill no']="";
                $data['Items']="";
                $data['Portions']="";
                $data['Quntity']="";
                $data['Rate']=number_format($each,$_SESSION['be_decimal']);
                $data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
            } 
                              
        $data['Slno']="";
        $data['Date']="";
        $data['Bill no']="";
        $data['Items']="";
        $data['Portions']="";
        $data['Quntity']="";
        $data['Rate']="";
        $data['Discount']="";
        array_push($data1,$data);
        unset($data);
        
        $data['Slno']="Total";
        $data['Date']="";
        $data['Bill no']="";
        $data['Items']="";
        $data['Portions']="";
        $data['Quntity']="";
        $data['Rate']=number_format($final,$_SESSION['be_decimal']);
        $data['Discount']=number_format($dscfinal,$_SESSION['be_decimal']);
        array_push($data1,$data);
        unset($data);
        
        $data['Slno']="GRAND TOTAL";
        $data['Date']="";
        $data['Bill no']="";
        $data['Items']="";
        $data['Portions']="";
        $data['Quntity']="";
        $data['Discount']="";
        $data['Discount']=number_format(($final-$dscfinal),$_SESSION['be_decimal']);
        array_push($data1,$data);
        unset($data);
        
        $filename = "Bill report_ ta -" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        $flag = false;
        foreach($data1 as $row) 
            {
                if(!$flag) 
                    {
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

/*******************************Counter Sale*******************************************************/
if($_REQUEST['type']=="totalsales_cs")
    {
    $string="";
    $user='';
	 $date=date("Ymd");
        $string.=" tab_status='Closed' AND tab_mode= 'CS' and tab_complimentary!='Y' and ";
        if($_REQUEST['log_user']!="null"){
            $string.="  tab_loginid = '".$_REQUEST['log_user']."' and ";
            $user=$_REQUEST['log_user'];
        } 
	 
		if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tab_dayclosedate  between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
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
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate =  CURDATE() - INTERVAL 1 day ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
			  }
	
	
	
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_billdate='".$cur."'";*/
	}
$data=array();
$data1=array();
$xlsRow=1;  
$final=0;
$paid=0;
$bal=0; 
$dsc=0;
$subtotal=0;
$servtax=0;
$vat=0;
$servcharge=0;
	$cur=date("Y-m-d");
        
                            $tax_name=array();
                            $tax_id=array();
                                  $sql_login  =  $database->mysqlQuery(" select  distinct(tketm.tbe_taxid) as taxid,tketm.tbe_label as taxname  FROM tbl_takeaway_bill_extra_tax_master tketm left join  tbl_extra_tax_master tm on tm.amc_id=tketm.tbe_taxid group by  amc_id order by tm.amc_id asc "); 
                                  $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                       $tax_name[]=$result_login['taxname'];
                                       $tax_id[]=$result_login['taxid'];
                            }} 
                            
           $tax_value=array();                          
 	  $sql_login  =  $database->mysqlQuery("select tab_subtotal,tab_discountvalue,tab_netamt,tab_amountpaid,
       tab_amountbalace,tab_dayclosedate,tab_billno,tab_loginid from tbl_takeaway_billmaster where $string order by tab_billno ASC "); 
	 $num_login   = $database->mysqlNumRows($sql_login);
	 

	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
            $subtotal=$subtotal + $result_login['tab_subtotal'];
            $dsc=$dsc + $result_login['tab_discountvalue'];
            $final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$bal=$bal + $result_login['tab_amountbalace'];
			
			$data['Sl No']=$xlsRow;
			$data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
			$data['Bill No']=$result_login['tab_billno'];
            $data['Taken By']=$result_login['tab_loginid'];
            $data['Sub Total']=number_format($result_login['tab_subtotal'],$_SESSION['be_decimal']);
                        
                        for($s=0;$s<count(array_unique($tax_id));$s++){
                        $sql_taxvalue  =  $database->mysqlQuery("select  tketm.tbe_total_value,tketm.tbe_taxid, tketm.tbe_label FROM tbl_takeaway_bill_extra_tax_master tketm  where tketm.tbe_billno='".$result_login['tab_billno']."' and tketm.tbe_taxid ='".$tax_id[$s]."' order by tketm.tbe_taxid asc"); 
                        
                        $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                        if($num_taxvalue){$i=0;
                            while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                            { if($result_taxvalue['tbe_total_value']==''){
                                $result_taxvalue['tbe_total_value']=0;
                            }
                            $tax_value[$result_taxvalue['tbe_taxid']][]=$result_taxvalue['tbe_total_value'];
                       $data[$result_taxvalue['tbe_label']]=number_format($result_taxvalue['tbe_total_value'],$_SESSION['be_decimal']);
                      
                            } } 
                        else { 
                            $tax_value[$tax_id[$s]][]=0;
                            $data[$tax_name[$s]]=number_format(0,$_SESSION['be_decimal']);
                         } }
                        $data['Discount']=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
			$data['Final']=number_format($result_login['tab_netamt'],$_SESSION['be_decimal']);
			$data['Paid']=number_format($result_login['tab_amountpaid'],$_SESSION['be_decimal']);
			$data['Balance']=number_format($result_login['tab_amountbalace'],$_SESSION['be_decimal']);
			array_push($data1,$data);
			unset($data);
    $xlsRow++; 
    }} 
	$data['Sl No']="";
	$data['Date']="";
        $data['Bill No']="";
        $data['Taken By']="";
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
        $data['Taken By']="";
	$data['Sub Total']=number_format($subtotal,$_SESSION['be_decimal']);
         
        for($i=0;$i<count(array_unique($tax_id));$i++){ 
         
            $data[$tax_name[$i]]=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal']);
     
        }
        for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){;
            $data[$tax_name[$o]]=number_format(0,$_SESSION['be_decimal']);
        }
        $data['Discount']="";
	$data['Final']=number_format($final,$_SESSION['be_decimal']);
	$data['Paid']=number_format($paid,$_SESSION['be_decimal']);
	$data['Balance']=number_format($bal,$_SESSION['be_decimal']);
	array_push($data1,$data);
	
  $filename = "Total Sales report_ cs -".$user.'--' . date('Y-m-d') . ".xls";
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

 else if($_REQUEST['type']=="itemordered_cs")
    {		$st="";
		$reporthead="";	
		$string="";
                $string.=" tbm.tab_status = 'Closed' and tbm.tab_mode='CS'";
                $addon_head='';
        $stringta_addon='';
        if($_REQUEST['addon']=='N')
            {
                
                $stringta_addon.=" and tbd.tab_bill_addon_slno IS NULL ";
            }
        else if($_REQUEST['addon']=='Y')
            {
                
                $stringta_addon.=" and tbd.tab_bill_addon_slno IS NOT NULL ";
                 $addon_head='-Addon ';
            }
	if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
            {
		$from=$database->convert_date($_REQUEST['hidfr']);
		$to=$database->convert_date($_REQUEST['hidto']);
		$string.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
						
	    }
	else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
            {
		$from=$database->convert_date($_REQUEST['hidfr']);
		$to=date("Y-m-d");
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }				
	else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
            {
		$from=date("Y-m-d");
		$to=$database->convert_date($_REQUEST['hidto']);
                $string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }
 	else 
	{
            $bydatz=$_REQUEST['hidbydate'];
		
                if($bydatz!="null")
			{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $st="Last5days";
	}
        elseif($bydatz=="Last10days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $st="Last10days";
	}
	else if($bydatz=="Yesterday")
	{
		$string.="and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
		$st="Yesterday";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $st="Last15days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $st="Last20days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $st="Last25days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $st="Last30days";
	}
	else if($bydatz=="Last1month")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st="Last1month";
	}
	else if($bydatz=="Today")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
        else if($bydatz=="Last90days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last90days";
	}
        else if($bydatz=="Last180days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last180days";
	}
        else if($bydatz=="Last365days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last365days";
	}
	$reporthead=$st;
	}
        
        else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
	}
	}
	
$data=array();
$data1=array();
$final=0;
$sub_total=0;


 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,tbm.tab_netamt,sum(tbd.tab_qty) as qty,ROUND(avg(tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND(avg(tbd.tab_rate), 1))) as Sub_Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion where $string $stringta_addon group by m.mr_maincatid ,m.mr_subcatid,tbd.tab_menuid,tbd.tab_portion ORDER BY m.mr_maincatid,m.mr_subcatid  DESC");
      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$t=0;$old="";
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$t++;
                        $sub_total=$sub_total+$result_login['Sub_Total'];
                        $final=$final+$result_login['tab_netamt'];
                        
                        
                      			  if($t==0)
							  {
								  $old=$result_login['mmy_maincategoryname'];
								  $catname=$result_login['mmy_maincategoryname'];				
							  }else if($t>0)
							  {
								  if($result_login['mmy_maincategoryname']==$old)
								  {
									  $catname="";
									  
									 }else
								  {
									  $old=$result_login['mmy_maincategoryname'];
									  $catname=$result_login['mmy_maincategoryname'];
								  }
							  }  
                        
                        
                        
                        
                        
                        
			
	 

    						
                               $data['Slno']=$i;
                               $data['Main Category']=$catname;
                               $data['Sub Category']=$result_login['msy_subcategoryname'];
                               $data['Menu']=$result_login['mr_menuname'];
                               $data['Portion']=$result_login['pm_portionname'];
                               $data['Qty']=$result_login['qty'];
                               
                               $data['Unit Price']=number_format($result_login['Unit_Price'],$_SESSION['be_decimal']);
                               $data['Sub Total']=number_format($result_login['Sub_Total'],$_SESSION['be_decimal']);
                               array_push($data1,$data);
                               unset($data);
                               
          $i++;} }
                        
                        $data['Slno']="";
                        $data['Main Category']="";
                        
                        $data['Sub Category']="";
                        $data['Menu']=""; 
                        $data['Portion']="";
                        $data['Qty']="";
                        $data['Unit Price']="";
                        $data['Sub Total']=""; 
                         array_push($data1,$data);
                         unset($data);   
                        
                        $data['Slno']="Total";
                        $data['Main Category']="";
                        
                        $data['Sub Category']="";
                        $data['Menu']=""; 
                        $data['Portion']="";
                        $data['Qty']="";
                        $data['Unit Price']="";
                        $data['Sub Total']=number_format($sub_total,$_SESSION['be_decimal']); 
                         array_push($data1,$data);
                         unset($data); 
                        
                         
                         
                         $filename = "Item Ordered report_ cs "."$addon_head"."-" . date('Y-m-d') . ".xls";
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
   
   else if(($_REQUEST['type']=="categorywise_report_cs"))
    {		
                $st="";
		$reporthead="";	
		$string="";
                $string.=" tbm.tab_status = 'Closed' and tbm.tab_mode='CS'";
                
            if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
                    $from=$database->convert_date($_REQUEST['fromdt']);
                    $to=$database->convert_date($_REQUEST['todt']);
                    $string.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
						
		}
            else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                    {
                        $from=$database->convert_date($_REQUEST['fromdt']);
                        $to=date("Y-m-d");
                        $string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }
            else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                    {
                        $from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }
						
					
			
            else 
            {
		
                $bydatz=$_REQUEST['bydate'];
		if($bydatz!="null")
                {
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $st="Last5days";
	}elseif($bydatz=="Last10days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $st="Last10days";
	}
	else if($bydatz=="Yesterday")
	{
		$string.="and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
		$st="Yesterday";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $st="Last15days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $st="Last20days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $st="Last25days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $st="Last30days";
	}
	 else if($bydatz=="Last1month")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st="Last1month";
	}
	else if($bydatz=="Today")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
        else if($bydatz=="Last90days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
				$st="Last90days";
	}
        else if($bydatz=="Last180days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			$st="Last180days";
	}
        else if($bydatz=="Last365days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last365days";
	}
	$reporthead=$st;
	}
        else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
	}
        }	

            $data=array();
            $data1=array();
            $total=0;
            $final=0;
           
            $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,count(distinct(tbd.tab_menuid)) as 'no of items',sum(tbd.tab_qty) as qty ,sum(tbd.tab_qty* tbd.tab_rate) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster on mr_menuid =tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC ");
            $num_login   = $database->mysqlNumRows($sql_login);
             if($num_login){$i=1;$t=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$t++;
                          $total=$total+$result_login['Total'];
                        
                           
                                $data['Slno']=$i;
                                $data['Main category Name']=$result_login['mmy_maincategoryname'];
                                $data['No of Items']=$result_login['no of items'];
                                $data['Qty']=$result_login['qty'];
                                $data['Total']=number_format($result_login['Total'],$_SESSION['be_decimal']);
                                array_push($data1,$data);
                                unset($data); 
                                
                              
              $i++;}} 
                                $data['Slno']="";
                                $data['Main category Name']="";
                                $data['No of Items']="";
                                $data['Qty']="";
                                $data['Total']="";
                                array_push($data1,$data);
                                unset($data);
              
                                $data['Slno']="Total";
                                $data['Main category Name']="";
                                $data['No of Items']="";
                                $data['Qty']="";
                                $data['Total']=number_format($total,$_SESSION['be_decimal']);
                                array_push($data1,$data);
                                unset($data);
              

                            

                      
                         $filename = "Category Wise report_ cs -" . date('Y-m-d') . ".xls";
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
   else if($_REQUEST['type']=="billcancel_cs")
        {
			
            $string="";
            $string.="tbm.tab_mode='CS' and tbm.tab_status='Cancelled' ";
            //$string.="tab_mode='CS' AND";
            $reporthead="";
            $st="";
		
               if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                    {
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			 $string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                         $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
                    }
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                    {
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
                    }
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                    {
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tbm. tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }

                else 
                    {
                        $bydatz=$_REQUEST['bydate'];
                        if($bydatz!="null")
                            {
                        	if($bydatz=="Last5days")
                                    {
                                        $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                                        $st="Last 5 days";

                                    }
                                else if($bydatz=="Last10days")
                                    {
                                        $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                                        $st="Last 10 days";
                                    }
                                elseif($bydatz=="Last15days")
                                    {
                                        $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                        $st="Last 15 days";
                                    }
                                else if($bydatz=="Last20days")
                                    {
                                        $string.="and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                        $st="Last 20 days";
                                    }
                                else if($bydatz=="Last25days")
                                    {
                                        $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                        $st="Last 25 days";
                                    }
                                else if($bydatz=="Last30days")
                                    {
                                        $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                        $st="Last 30 days";
                                    }
                                else if($bydatz=="Today")
                                    {
                                        $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                        $st="Today";
                                    }
	

                                else if($bydatz=="Yesterday")
                                    {
                                        $string.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                        $st="Yesterday";
				  
                                    }
                                else if($bydatz=="Last1month")
                                    {
                                        $string.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                                        $st="Last 1 month";
                                    }
                                else if($bydatz=="Last90days")
                                    {
                                        $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                        $st="Last 3 months";
                                    }
                                else if($bydatz=="Last180days")
                                    {
                                        $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                                        $st="Last 6 months";
                                    }
                                else if($bydatz=="Last365days")
                                    {
                                        $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                                        $st="Last 1 year";
                                    }

                                    $reporthead=$st;
                            }
                            else
                                {
                                    $from=date("Y-m-d");
                                    $to=date("Y-m-d");
                                    $string.= "  and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
			
                                }
		
                    }
  $data=array();
  $data1=array();
  $final=0;
  $paid=0;
  $bal=0; 
            $sql_login  =  $database->mysqlQuery("select tbm.tab_billno,tbm.tab_dayclosedate,tbm.tab_time,tbm.tab_cancelledtime,tbm.tab_paymode,tbm.tab_cancelledreason,tbm.tab_cancelledlogin,tbm.tab_netamt,ld.ls_staffid,sm.ser_firstname,sm.ser_lastname 
            from tbl_takeaway_billmaster tbm left join tbl_staffmaster sm on sm.ser_staffid=tbm.tab_cancelledby_careof left join
            tbl_logindetails ld on ld.ls_username=tbm.tab_cancelledlogin where $string order by tbm.tab_billno ASC");
            $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login){$i=1;$cancelledreason='';
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                    $cancelledreason= $result_login['tab_cancelledreason'];
                              if(is_numeric($cancelledreason)){
                              $sql_loginreason  =  $database->mysqlQuery("select cr_id,cr_reason from tbl_cancellation_reasons where cr_id='".$cancelledreason."'");  
                              $num_loginreason=$database->mysqlNumRows($sql_loginreason);
                              if($num_loginreason){
                                   $result_loginreason  = $database->mysqlFetchArray($sql_loginreason);
                                   $cancelledreason=$result_loginreason['cr_reason'];
                              }
                        }
                        
                        if($result_login['tab_paymode']==NULL)
				{
				
					$paid="N";
				}
                                else 
				{
					$paid="Y";
				}
				$final=$final + $result_login['tab_netamt'];

                                $data['Slno']=$i;
                                $data['Date']=$result_login['tab_dayclosedate'];
                                $data['Bill No']=$result_login['tab_billno'];
                                $data['Bill Generated Time']=$result_login['tab_time'];
                                $data['Bill Cancelled Date&Time']=$result_login['tab_cancelledtime'];
                                $data['Reason']=$cancelledreason;
                                $data['Final']=number_format($result_login['tab_netamt'],$_SESSION['be_decimal']);                                
                                $data['Paid']=$paid;
                                $data['Cancelled By']=$result_login['ser_firstname'].' '.$result_login['ser_lastname'];
                                $data['Cancelled Login']=$result_login['tab_cancelledlogin'];
                                  array_push($data1,$data);
                                  unset($data);
                             
                              $i++;} } 
                              
                                $data['Slno']="";
                                $data['Date']="";
                                $data['Bill No']="";
                                $data['Bill Generated Time']="";
                                $data['Bill Cancelled Date&Time']="";
                                $data['Reason']="";
                                $data['Final']="";                                
                                $data['Paid']="";
                                $data['Cancelled By']="";
                                $data['Cancelled Login']="";
                                  array_push($data1,$data);
                                  unset($data);
                              
                               $data['Slno']="Total";
                                $data['Date']="";
                                $data['Bill No']="";
                                $data['Bill Generated Time']="";
                                $data['Bill Cancelled Date&Time']="";
                                $data['Reason']="";
                                $data['Final']=number_format($final,$_SESSION['be_decimal']);                                
                                $data['Paid']="";
                                $data['Cancelled By']="";
                                $data['Cancelled Login']="";
                                  array_push($data1,$data);
                                  unset($data);
                                  
                                  
                                  
                                  
                          $filename = "Cancelled Bill report_ cs -" . date('Y-m-d') . ".xls";
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
   
    else if($_REQUEST['type']=="cancelhistory_cs")
        {
			
            $string="";
            $string.="tbm.tab_mode='CS' ";
            //$string.="tab_mode='CS' AND";
            $reporthead="";
            $st="";
            
            if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
                    $from=$database->convert_date($_REQUEST['fromdt']);
                    $to=$database->convert_date($_REQUEST['todt']);
                    $string.= " and  ci.tc_dayclosedate between '".$from."' and '".$to."' ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
            else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                    $from=$database->convert_date($_REQUEST['fromdt']);
                    $to=date("Y-m-d");
                    $string.= " and ci.tc_dayclosedate between '".$from."' and '".$to."' ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
		}
            else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
                    $from=date("Y-m-d");
                    $to=$database->convert_date($_REQUEST['todt']);
                    $string.= " and ci.tc_dayclosedate between '".$from."' and '".$to."' ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	
            else 
                {
                    $bydatz=$_REQUEST['bydate'];
		
                    if($bydatz!="null")
                        {
	
                            if($bydatz=="Last5days")
                                {
                                    $string.=" and  ci.tc_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                                    $st="Last 5 days";

                                }
                            elseif($bydatz=="Last10days")
                                {
                                    $string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                                    $st="Last 10 days";
                                }
                            elseif($bydatz=="Last15days")
                                {
                                    $string.=" and and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                    $st="Last 15 days";
                                }
                            else if($bydatz=="Last20days")
                                {
                                    $string.="and  ci.tc_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                    $st="Last 20 days";
                                }
                            else if($bydatz=="Last25days")
                                {
                                    $string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                    $st="Last 25 days";
                                }
                            else if($bydatz=="Last30days")
                                {
                                    $string.=" and ci.tc_dayclosedate between  CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                    $st="Last 30 days";
                                }
                            else if($bydatz=="Today")
                                {
                                    $string.=" and  ci.tc_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                    $st="Today";
                                }
                            else if($bydatz=="Yesterday")
                                {
                                    $string.=" and ci.tc_dayclosedate  = CURDATE() - INTERVAL 1 day";
                                    $st="Yesterday";			  
                                }
                            else if($bydatz=="Last1month")
                                {
                                    $string.="  and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                                    $st="Last 1 month";
                                }
                            else if($bydatz=="Last90days")
                                {
                                    $string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                    $st="Last 3 months";
                                }
                            else if($bydatz=="Last180days")
                                {
                                    $string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                                    $st="Last 6 months";
                                }
                            else if($bydatz=="Last365days")
                                {
                                    $string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                                    $st="Last 1 year";
                                }
                                $reporthead=$st;
                        }
                        else
                            {	
                                $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= "  and ci.tc_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);						
                            }
		
                }
	
                $data=array();
                $data1=array();

            $sql_login  =  $database->mysqlQuery("select ci.*,sm.ser_firstname, mm.mr_menuname,tbm.tab_billno  FROM tbl_takeaway_cancel_items ci
                                        left join tbl_takeaway_billmaster tbm on tbm.tab_billno = ci.tc_billno
                                        left join tbl_takeaway_billdetails tbd on tbd.tab_billno = ci.tc_billno and ci.tc_bill_slno=tbd.tab_slno
                                        left join tbl_menumaster mm on  mm.mr_menuid = tbd.tab_menuid
                                        left join tbl_staffmaster sm ON sm.ser_staffid = ci.tc_cancelled_by                                        
                                        where $string order by tbm.tab_billno ASC");
	  

            $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){$i=1;$cancelledreason='';
                 while($result_login  = $database->mysqlFetchArray($sql_login)) 
                    {
                        
                        $cancelledreason= $result_login['tc_reason'];
                              if(is_numeric($cancelledreason)){
                              $sql_loginreason  =  $database->mysqlQuery("select cr_id,cr_reason from tbl_cancellation_reasons where cr_id='".$cancelledreason."'");  
                              $num_loginreason=$database->mysqlNumRows($sql_loginreason);
                              if($num_loginreason){
                                   $result_loginreason  = $database->mysqlFetchArray($sql_loginreason);
                                   $cancelledreason=$result_loginreason['cr_reason'];
                              }
                        }
                     
                        $data['Slno']=$i;
			            $data['Bill No']=$result_login['tab_billno'];
                        $data['Date']=$database->convert_date($result_login['tc_dayclosedate']);
                        $data['Kot No']=$result_login['tc_cancel_kotno'];
			            $data['Menu']=$result_login['mr_menuname'];
                        $data['Cancelled C/O']=$result_login['ser_firstname'];
                        $data['Cancelled BY']=$result_login['tc_cancelled_login'];
                        $data['Reason']=$cancelledreason;
                        array_push($data1,$data);
                        unset($data);
     
                        $i++; } } 
                        
                        $data['Slno']="";
			            $data['Bill No']="";
                        $data['Date']="";
                        $data['Kot NO']="";
			            $data['Menu']="";
                        $data['Cancelled C/O']="";
                        $data['Cancelled By']="";
                        $data['Reason']="";
                        array_push($data1,$data);
                        unset($data);
     
                            $filename = "Cancelled History report_ cs -" . date('Y-m-d') . ".xls";
                            header("Content-Disposition: attachment; filename=\"$filename\"");
                            header("Content-Type: application/vnd.ms-excel");
                           
                            $flag = false;
                            foreach($data1 as $row) 
                                {
                                    if(!$flag) 
                                        {
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
else if(($_REQUEST['type']=="total_summary_details_cs"))
    {
	$string="";
	$reporthead="";
	$strings=" tab_status='Closed' AND tab_mode= 'CS' AND";
	$string1_str=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(tab_transactionamount) ";
	$string3_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string4_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string5_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string6_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace)))";
	$string7_str=" sum(tab_netamt)";
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
		
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
            {
		$from=$database->convert_date($_REQUEST['fromdt']);
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

            }
	else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
            {
		$from=$database->convert_date($_REQUEST['fromdt']);
                $to=date("Y-m-d");
                $string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

            }
	else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
            {
		$from=date("Y-m-d");
        $to=$database->convert_date($_REQUEST['todt']);
		$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }
		
	else 
            {
		$bydatz=$_REQUEST['bydate'];
		$st='';
		
		if($bydatz!="null")
                    {
               
                        if($bydatz=="Last5days")
                            {        
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                $st= " Last 5 days ";
                            }
                        elseif($bydatz=="Last10days")
                            {
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                                $st= " Last 10 days ";
                            }
                        elseif($bydatz=="Last15days")
                            {
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                $st= " Last 15 days ";
                            }
                        else if($bydatz=="Last20days")
                            {
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                $st= " Last 20 days ";
                            }
                        else if($bydatz=="Last25days")
                            {
                                 $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                $st= " Last 25 days ";
                            }
                        else if($bydatz=="Last30days")
                            {
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                $st= " Last 30 days ";
                            }
                        else if($bydatz=="Today")
                            {
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                $st= " Today ";
                            }
                        else if($bydatz=="Yesterday")
                            {
                                $string.=" tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                $st= " Yesterday ";
                            }
                        else if($bydatz=="Last1month")
                            {
                                $string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                                $st= " Last 1 month ";
                            }
                        else if($bydatz=="Last90days")
                            {
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                $st= " Last 3 months ";
                            }
                        else if($bydatz=="Last180days")
                            {
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                                $st= " Last 6 months "; 
                            }
                        else if($bydatz=="Last365days")
                            {
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                                $st= " Last 1 year "; 
		
                            }
                        $reporthead=$st;
                    }
                else
                    {
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	
            }
	
            $servicetax_stats='N';
             $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
             $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){
		 $servicetax_stats='Y';
	  }

 $data=array();
 $data1=array();
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
  $totalcash=0;
  $totalcoupons=0;
  $totalvoucher=0;
  $totalcheque=0;
  $totalcredits=0;
  $totalcomplimentary=0;
//  $totalpax=0;
  $totalcreditordebit=0;
  
  $slno=0;
    $sql = $database->mysqlQuery("select distinct(tab_dayclosedate) from tbl_takeaway_billmaster where $string");
        $num_row   = $database->mysqlNumRows($sql);
            if($num_row){
                while($result = $database->mysqlFetchArray($sql)){
        
        
                    $total=0;
                    $slno++;
                    if($result != "")
                        {
                            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
                            $data['Slno']=$slno;
                            $data['Date']=$result['tab_dayclosedate'];
                            
                            
                        }
    $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string1"."$dt order by tab_dayclosedate,tab_time ASC"); 
	$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_login  = $database->mysqlFetchArray($sql_login);
			
		if($result_login['tot'] != "")	
                    {                                    
                        $totalcash=$totalcash + $result_login['tot'];
                        $total= $total + $result_login['tot'];            
			            $subtotal =$subtotal + $result_login['tot'];                                         
                        $data['Cash']=number_format($result_login['tot'],$_SESSION['be_decimal']);                     
                    }
                else{ 
                        $data['Cash']="--";             
                    }
                        
                    }
                    else{   
                            $data['Cash']="--";
                        }
          $sql_login1  =  $database->mysqlQuery("select $string2_str as tot from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.tab_transcbank and tb.tab_status='Closed' AND $string2 "."$dt order by tb.tab_dayclosedate,tb.tab_time ASC "); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  
	  if($num_login1){
		  $result_login1  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebit=$totalcreditordebit + $result_login1['tot'];  
			$total= $total + $result_login1['tot'];       
			$subtotal =$subtotal + $result_login1['tot'];
                      
			$data['Credit/Debit']=number_format($result_login1['tot'],$_SESSION['be_decimal']);
 	
                        }else{
                        $data['Credit/Debit']="--";
                             }
		 	
			
			
            $sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3"." $dt order by tab_dayclosedate,tab_time ASC"); 
			
            $num_login   = $database->mysqlNumRows($sql_login);
          
            if($num_login){
		  $result_login2  = $database->mysqlFetchArray($sql_login);
			if($result_login2['tot'] != "")	{
				
				$totalcoupons= $totalcoupons + $result_login2['tot'];
                                $total= $total + $result_login2['tot'];       
                                $subtotal =$subtotal + $result_login2['tot'];	
      
                                $data['Coupons']=number_format($result_login2['tot'],$_SESSION['be_decimal']);
         
           
                            }
                        else{
                            $data['Coupons']="--";
                            }
                         }else{
                             $data['Coupons']="--";
                             }
                      
			
           $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4"." $dt order by tab_dayclosedate,tab_time ASC"); 
           $num_login   = $database->mysqlNumRows($sql_login);
           if($num_login){
		  $result_login3  = $database->mysqlFetchArray($sql_login); 
			 
                    if($result_login3['tot'] != "")
			{
			$totalvoucher=$totalvoucher + $result_login3['tot'];
                        $total=$total + $result_login3['tot'];       
                        $subtotal =$subtotal + $result_login3['tot'];
                         
                        $data['Voucher']=number_format($result_login3['tot'],$_SESSION['be_decimal']);        
            
                         }
                    else{
                        $data['Voucher']="--";
                        }
            
                        }
                    else{
                        $data['Voucher']="--";
                        }
			
          $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5"." $dt order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login4  = $database->mysqlFetchArray($sql_login); 
			
			if($result_login4['tot'] != "")
			{
			
                        $totalcheque=$totalcheque + $result_login4['tot'];
                        $total= $total + $result_login4['tot'];       
                        $subtotal =$subtotal + $result_login4['tot'];
                        
                        $data['Cheque']=number_format($result_login4['tot'],$_SESSION['be_decimal']);
         
            
                       } 
                        else{
                            $data['Cheque']="--";
                        }
                        }
                    else{
                            $data['Cheque']="--";
                        }
                        
           $sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6"." $dt order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login5  = $database->mysqlFetchArray($sql_login);
			
			if($result_login5['tot'] != "")
			{
			
                        $totalcredits=$totalcredits + $result_login5['tot'];
                        $total= $total + $result_login5['tot'];     
                        $subtotal =$subtotal + $result_login5['tot'];
                        
                            $data['Credits']=number_format($result_login5['tot'],$_SESSION['be_decimal']);
                         
                        }
                        else{
                            $data['Credits']="--";
                             }
            
                        }
                    else{
                    $data['Credits']="--";
                        }
				
          $sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string7"." $dt order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login6  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_login6['tot'] != "")
			{
			
                        $totalcomplimentary= $totalcomplimentary + $result_login6['tot'];    
  
			
                         $data['Complimentary']=number_format($result_login6['tot'],$_SESSION['be_decimal']);
         
                        } 
                         else{
                         $data['Complimentary']="--";
                         }
                        }
                    else{
                            $data['Complimentary']="--";
                        }
                        
    
                        $data['Total']=number_format($total,$_SESSION['be_decimal']);
                        array_push($data1,$data);
                        unset($data);
  
  }
  }
  
                        $data['Slno']="";
                        $data['Date']="";
                        $data['Cash']="";
                        $data['Credit/Debit']="";
                        $data['Coupons']="";
                        $data['Voucher']="";
                        $data['Cheque']="";
                        $data['Credits']="";
                        $data['Complimentary']="";
                        $data['Total']="";
                        array_push($data1,$data);
                        unset($data);
                        
                        $data['Slno']="TOTAL";
                        $data['Date']=$reporthead;
                        $data['Cash']=number_format($totalcash,$_SESSION['be_decimal']);
                        $data['Credit/Debit']=number_format($totalcreditordebit,$_SESSION['be_decimal']);
                        $data['Coupons']=number_format($totalcoupons,$_SESSION['be_decimal']);
                        $data['Voucher']=number_format($totalvoucher,$_SESSION['be_decimal']);
                        $data['Cheque']=number_format($totalcheque,$_SESSION['be_decimal']);
                        $data['Credits']=number_format($totalcredits,$_SESSION['be_decimal']);
                        $data['Complimentary']=number_format($totalcomplimentary,$_SESSION['be_decimal']);
                        $data['Total']=number_format($subtotal,$_SESSION['be_decimal']);
                        array_push($data1,$data);
                        unset($data);
                        
                        
                            $filename = "Total sumamry Details report_ cs -" . date('Y-m-d') . ".xls";
                            header("Content-Disposition: attachment; filename=\"$filename\"");
                            header("Content-Type: application/vnd.ms-excel");
                           
                            $flag = false;
                            foreach($data1 as $row) 
                                {
                                    if(!$flag) 
                                        {
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





else if(($_REQUEST['type']=="summary_cs"))
    {
	$string="";
	$reporthead="";
	$strings=" tab_status='Closed' AND tab_mode= 'CS' AND";
	$string1_str=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(tab_transactionamount) ";
	$string3_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string4_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string5_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string6_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace)))";
	$string7_str=" sum(tab_netamt)";
	$string_pax="";
	$string_pax=" tab_status='Closed' AND ";
	//	$string1 =$strings. " pym_code='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
        $string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
        $string6=$strings. " pym_code='credit_person' AND ";
        $string7=$strings. " pym_code='complimentary' AND";
                
                if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
                    {
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "(tab_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
                    {
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "( tab_dayclosedate  between '".$from."' and '".$to."' ) "; 
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                    {
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (tab_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }
		
	
                else
                    {
                        $bydatz=$_REQUEST['bydate'];
                        $st='';
                        if($bydatz!="null")
                            {
	
                                if($bydatz=="Last5days")
                                    {
          
                                        $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                        $st= " Last 5 days ";
                                        $string_pax.= " tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                    }
                                elseif($bydatz=="Last10days")
                                    {
                                        $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                                        $string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                                        $st= " Last 10 days ";
                                    }
                                elseif($bydatz=="Last15days")
                                    {
                                        $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                        $string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                        $st= " Last 15 days ";
                                    }
                                else if($bydatz=="Last20days")
                                    {
                                        $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                                $string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                        $st= " Last 20 days ";
                                    }
                                else if($bydatz=="Last25days")
                                    {
                                        $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                        $string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                        $st= " Last 25 days ";
                                    }
                                else if($bydatz=="Last30days")
                                    {
                                        $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                                $string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                        $st= " Last 30 days ";
                                    }
                                else if($bydatz=="Today")
                                    {
                                        $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                                $string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                                        $st= " Today ";
                                    }
                                else if($bydatz=="Yesterday")
                                    {
                                        $string.=" tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                        $string_pax.= "tab_dayclosedate =  CURDATE() - INTERVAL 1 day";
                                        $st= " Yesterday ";
                                    }
                                else if($bydatz=="Last1month")
                                    {
                                        $string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                                        $string_pax.= "tab_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                        $st= " Last 1 month ";
                                    }
                                else if($bydatz=="Last90days")
                                    {
                                        $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                                $string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                                        $st= " Last 3 months ";
                                    }
                                else if($bydatz=="Last180days")
                                    {
                                        $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                                                $string_pax.= " tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                                        $st= " Last 6 months "; 
                                    }
                                else if($bydatz=="Last365days")
                                    {
                                        $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                                                $string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                                        $st= " Last 1 year "; 
                                    }
                                    $reporthead=$st;
                            }
                        else
                            {
                                $from=date("Y-m-d");
                                $to=date("Y-m-d");
                                $string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                                $string_pax.= "  tab_dayclosedate   between '".$from."' and '".$to."'";
                            }
                    }
	
	$servicetax_stats='N';
	$sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''");  
    $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }

  $data=array();
  $data1=array();
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;

    $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string1"."$string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
                            while($result_login  = $database->mysqlFetchArray($sql_login)) 
                                { 
                                    if($result_login['tot'] != "")
                                        {
                                            $subtotal =$subtotal + $result_login['tot'];
                                    
                                            $data['Type']="Cash";
                                            $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                            array_push($data1,$data);
                                            unset($data);
                                        } 
                        
                                }
                        }
$sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.tab_transcbank and tb.tab_status='Closed' AND $string2 "."$string  order by tb.tab_dayclosedate,tb.tab_time ASC "); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){
                            while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
                                { 
                                    $subtotal =$subtotal + $result_login1['tot'];
                                
                                    $data['Type']='Card';
                                    $data['Value']=number_format($result_login1['tot'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
		
                                }
                        }
                        
                  $sql_logincreditta  =  $database->mysqlQuery("select distinct (b.bm_name) as bnk, sum(bc.mc_cardamount) as tot  FROM 
                                                    tbl_takeaway_billmaster bm 
                                                    left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id 
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.tab_billno
                                                    left join tbl_bankmaster b  on  b.bm_id = bc.mc_to_bank 
                                                    where tbl_paymentmode.pym_code='credit' and bm.tab_mode='CS'
                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND $string group by bnk");
                      


                  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
                  if($num_logincreditta){
                          while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
                                {  
                             
                             
            
            
                                    $data['Type']=$result_logincreditta['bnk'];
                                    $data['Value']=number_format($result_logincreditta['tot'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
            
            
           
                          }
                          }      
                        
                        
		
	  $sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3"." $string order by tab_dayclosedate,tab_time ASC"); 
			
	  $num_login   = $database->mysqlNumRows($sql_login);

	  if($num_login)
               {
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
                        {
                            if($result_login['tot'] != "")
                                {
                                    $subtotal =$subtotal + $result_login['tot'];	
                                            
                                    $data['Type']="Coupons";
                                    $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
                                }
                        } 
                }
			
	  $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
                {
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                            if($result_login['tot'] != "")
                                {
                                    $subtotal =$subtotal + $result_login['tot'];

                                    $data['Type']="Voucher";
                                    $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
      
                                }
                        }
                }
			
          $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
                {
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                            if($result_login['tot'] != "")
                                {
                                    $subtotal= $subtotal + $result_login['tot'];
                                    
                                    $data['Type']="Cheque";
                                    $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
         
                                }
                        }
                }
          
          $sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
               {
		    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                            if($result_login['tot'] != "")
                                {
                                    $subtotal =$subtotal + $result_login['tot'];
			
                                        $data['Type']="Credits";
                                        $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                        array_push($data1,$data);
                                         unset($data);
                                } 
                        }
                }
				
	  $sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string7"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
               {
		    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			     if($result_login['tot'] != "")
                                {
                                    
                                    $data['Type']="Complimentary";
                                    $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
         
                                }
                        }
                        
                }
//		
            $data['Type']="";
            $data['Value']="";
            array_push($data1,$data);
            unset($data);
 
            $data['Type']="TOTAL";
            $data['Value']=number_format($subtotal,$_SESSION['be_decimal']);
            array_push($data1,$data);
            unset($data);
   
                            $filename = "sumamry report_ cs -" . $reporthead . ".xls";
                            header("Content-Disposition: attachment; filename=\"$filename\"");
                            header("Content-Type: application/vnd.ms-excel");
                           
                            $flag = false;
                            foreach($data1 as $row) 
                                {
                                    if(!$flag) 
                                        {
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

else if($_REQUEST['type']=="complimentary_cs")
    {
	$string="";
	$string.=" tab_status='Closed' AND tab_mode= 'CS' AND tab_complimentary='Y' ";
	$reporthead="";
	
        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
            {
		$from=$database->convert_date($_REQUEST['fromdt']);
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }
	else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
            {
		$from=$database->convert_date($_REQUEST['fromdt']);
		$to=date("Y-m-d");
            	$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }
	else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
            {
                $from=date("Y-m-d");
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }

        else 
            {
		$bydatz=$_REQUEST['bydate'];
		if($bydatz!="null")
                    {
                        if($bydatz=="Last5days")
                            {
                                $string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                                $st="Last5days";
                            }
                        elseif($bydatz=="Last10days")
                            {
                                $string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                                $st="Last10days";
                            }
                        else if($bydatz=="Yesterday")
                            { 
				$string.=" and tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                $st="Yesterday";
                            }
                        elseif($bydatz=="Last15days")
                            {
                                $string.="  and tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                $st="Last15days";
                            }
                        else if($bydatz=="Last20days")
                            {
                                $string.=" and  tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                                $st="Last20days";
                            }
                        else if($bydatz=="Last25days")
                            {
                                $string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                $st="Last25days";
                            }
                        else if($bydatz=="Last30days")
                            {
                                $string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                $st="Last30days";
                            }
                        else if($bydatz=="Last1month")
                            {
                                $string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                $st="Last1month";
                            }
                        else if($bydatz=="Today")
                            {
                                $string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                $st="Today";
                            }
                        else if($bydatz=="Last90days")
                            {
                                $string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                $st="Last90days";
                            }
                        else if($bydatz=="Last180days")
                            {
                                $string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                                $st="Last180days";
                            }
                        else if($bydatz=="Last365days")
                            {
                                $string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                                $st="Last365days";
                            }
                                $reporthead=$st;
                    }
                else
                    {
        		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }
            }
          $data= array();
          $data1=array();
          $final=0;
          $sql_login  =  $database->mysqlQuery("select tab_netamt,tab_dayclosedate,tab_billno,tab_subtotal,tab_complimentaryremark from tbl_takeaway_billmaster where $string  ");
	  $num_login   = $database->mysqlNumRows($sql_login);
	    if($num_login)
                {
                        $i=1;
                        while($result_login  = $database->mysqlFetchArray($sql_login)) 
                           {
                                $final=$final+$result_login['tab_netamt'];
                                $data['Slno']=$i;
                                $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
                                $data['Bill No']=$result_login['tab_billno'];
                                $data['Amount']=number_format($result_login['tab_subtotal'],$_SESSION['be_decimal']);
                                $data['Remarks']=$result_login['tab_complimentaryremark'];
                                array_push($data1,$data);
                                unset($data);                
                                $i++;
                            } 
                }
                $data['Slno']="";
                $data['Date']="";
                $data['Bill No']="";
                $data['Amount']="";
                $data['Remarks']="";
                array_push($data1,$data);
                unset($data);              
                $data['Slno']="Total";
                $data['Date']="";
                $data['Bill No']="";
                $data['Amount']=number_format($final,$_SESSION['be_decimal']);
                $data['Remarks']="";
                array_push($data1,$data);
                unset($data);
               
                $filename = "Complimentary report_ cs -" . date('Y-m-d') . ".xls";
                header("Content-Disposition: attachment; filename=\"$filename\"");
                header("Content-Type: application/vnd.ms-excel");
                $flag = false;
                foreach($data1 as $row) 
                    {
                       if(!$flag) 
                            {
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

else if($_REQUEST['type']=="billreport_cs")
    {
        $string="";
	$string=" tbm.tab_status='Closed' AND tbm.tab_mode='CS'";
	$reporthead="";
        $sort_string='';
        $sort_string1='';
        $sort_string.=$_REQUEST['sortby'];
        
        if($sort_string=='bill_asc'){
           $sort_string1.= " order by tbm.tab_billno asc";
        }
        else if($sort_string=='bill_desc'){
            $sort_string1.= " order by tbm.tab_billno desc";
        }
        else if($sort_string=='value_asc'){
           $sort_string1.= " order by tbm.tab_netamt asc";
        }
        else if($sort_string=='value_desc'){
            $sort_string1.=" order by tbm.tab_netamt desc";
        }
        
        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
            {
		$from=$database->convert_date($_REQUEST['fromdt']);
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
            {
		$from=$database->convert_date($_REQUEST['fromdt']);
		$to=date("Y-m-d");
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
            {
                $from=date("Y-m-d");
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	else
           {
		$bydatz=$_REQUEST['bydate'];
		if($bydatz!="null" && $bydatz!="")
                    {
                        if($bydatz=="Last5days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                                $st="Last5days";
                            }
                        elseif($bydatz=="Last10days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                                $st="Last10days";
                            }
                        else if($bydatz=="Yesterday")
                            {
				$string.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				$st="Yesterday";
                            }
                        elseif($bydatz=="Last15days")
                            {
                                $string.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                $st="Last15days";
                            }
                        else if($bydatz=="Last20days")
                            {
                                $string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                $st="Last20days";
                            }
                        else if($bydatz=="Last25days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                $st="Last25days";
                            }
                        else if($bydatz=="Last30days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                $st="Last30days";
                            }
                        else if($bydatz=="Last1month")
                            {
				$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				$st="Last1month";
                            }
                        else if($bydatz=="Today")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                $st="Today";
                            }
                        else if($bydatz=="Last90days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                $st="Last90days";
                            }
                        else if($bydatz=="Last180days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                                $st="Last180days";
                            }
                        else if($bydatz=="Last365days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                                $st="Last365days";
                            }
                        $reporthead=$st;
                    }
                else
                    {
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }
            }
    
    $data=array();
    $data1=array();
    $final=0; 
    $dsc=0;
    $dscfinal=0;

    $sql_login  =  $database->mysqlQuery("select tbm.tab_netamt,tbm.tab_discountvalue,tbm.tab_billno,tbm.tab_dayclosedate,mm.mr_menuname,tbd.tab_qty,tbd.tab_rate,p.pm_portionname from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid left join tbl_portionmaster p on p.pm_id=tbd.tab_portion where $string $sort_string1 "); 
    $old='';$new='';	 
    $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
            {
                $i=1;$k=1;$each=0;$dsc=0;
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
                    {
			$final=$final+($result_login['tab_rate'] * $result_login['tab_qty']);
                        if($i==1)
                            {
                                $dscfinal=$dscfinal+($result_login['tab_discountvalue']);
				$dsc=$dsc + ($result_login['tab_discountvalue']);
				$each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
//				$each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
				$old=$result_login['tab_billno'];
				$new=$result_login['tab_billno'];

                                $data['Slno']=$i;
                                $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
				$data['Bill no']=$result_login['tab_billno'];
                                $data['Items']=$result_login['mr_menuname'];
                                $data['Portions']=$result_login['pm_portionname'];
				$data['Quntity']=$result_login['tab_qty'];
		                $data['Rate']=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal']);
                                $data['Discount']=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
                                array_push($data1,$data);
                                unset($data);
        
                            }
                        else
                            {
				$old=$new;
				$new=$result_login['tab_billno'];
				if($new==$old)
                                    {
                                        $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
					
                                        $data['Slno']="";
                                        $data['Date']="";
                                        $data['Bill no']="";
                                        $data['Items']=$result_login['mr_menuname'];
                                        $data['Portions']=$result_login['pm_portionname'];
                                        $data['Quntity']=$result_login['tab_qty'];
                                        $data['Rate']=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal']);
                                        $data['Discount']=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
                                        array_push($data1,$data);
                                        unset($data);
                                    }
                                else
                                    {
					$data['Slno']="Total";
                                        $data['Date']="";
                                        $data['Bill no']="";
                                        $data['Items']="";
                                        $data['Portions']="";
                                        $data['Quntity']="";
                                        $data['Rate']=number_format($each,$_SESSION['be_decimal']);
                                        $data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
                                        array_push($data1,$data);
                                        unset($data);

                                        $each=0;$dsc=0;
                                        $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
                                        $dsc=$dsc + $result_login['tab_discountvalue'];
                                        $dscfinal=$dscfinal+$result_login['tab_discountvalue'];
		
                                        $data['Slno']=$k++;
                                        $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
                                        $data['Bill no']=$result_login['tab_billno'];
                                        $data['Items']=$result_login['mr_menuname'];
                                        $data['Portions']=$result_login['pm_portionname'];
                                        $data['Quntity']=$result_login['tab_qty'];           
                                        $data['Rate']=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal']);
                                        $data['Discount']=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
                                        array_push($data1,$data);
                                        unset($data);
                                    }
                            }
				$i++;

                    }
                    
                $data['Slno']="Total";
                $data['Date']="";
                $data['Bill no']="";
                $data['Items']="";
                $data['Portions']="";
                $data['Quntity']="";
                $data['Rate']=number_format($each,$_SESSION['be_decimal']);
                $data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
            } 
                              
        $data['Slno']="";
        $data['Date']="";
        $data['Bill no']="";
        $data['Items']="";
        $data['Portions']="";
        $data['Quntity']="";
        $data['Rate']="";
        $data['Discount']="";
        array_push($data1,$data);
        unset($data);
        
        $data['Slno']="Total";
        $data['Date']="";
        $data['Bill no']="";
        $data['Items']="";
        $data['Portions']="";
        $data['Quntity']="";
        $data['Rate']=number_format($final,$_SESSION['be_decimal']);
        $data['Discount']=number_format($dscfinal,$_SESSION['be_decimal']);
        array_push($data1,$data);
        unset($data);
        
        $data['Slno']="GRAND TOTAL";
        $data['Date']="";
        $data['Bill no']="";
        $data['Items']="";
        $data['Portions']="";
        $data['Quntity']="";
        $data['Discount']="";
        $data['Discount']=number_format(($final-$dscfinal),$_SESSION['be_decimal']);
        array_push($data1,$data);
        unset($data);
        
        $filename = "Bill report_ cs -" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        $flag = false;
        foreach($data1 as $row) 
            {
                if(!$flag) 
                    {
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
    
 else if($_REQUEST['type']=="paymenttype_cs")
    {  
        $reporthead="";
        $st="";
        $fields="";
	if($_REQUEST['types']=="cash")
            {
                $string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and tbm.tab_status='Closed' and tbm.tab_mode='CS' and ((tbm.tab_amountpaid-tbm.tab_amountbalace) > 0) ";
                $fields="<th>Cash</th>";
            }
        else if($_REQUEST['types']=="credit")
            {
		$string = " p.pym_code='credit' and (tbm.tab_transcbank <> '0') and tbm.tab_status='Closed' and tbm.tab_mode='CS'";
		$fields="<th>Bank</th>";
                $fields.="<th>Card Payment</th>";
            }
        else if($_REQUEST['types']=="coupons")
            {
		$string = " pym_code='coupon' and bm_status='Closed'";
		$fields="<th style='font-size:20px; '><strong>Coupon Company</strong></th>";
		$fields.="<th style='font-size:20px; '><strong>Coupon Amount</strong></th>";
		$fields.="<th style='font-size:20px; '><strong>Paid</strong></th>";
            }
        else if($_REQUEST['types']=="voucher")
            {
		$string = " pym_code='voucher' and bm_status='Closed'";
		$fields="<th style='font-size:20px; '><strong>Voucher</th>";
		$fields.="<th style='font-size:20px; '><strong>Paid</strong></th>";
            }
        else if($_REQUEST['types']=="cheque")
            {
		$string = " pym_code='cheque' and bm_status='Closed'";
		$fields="<th style='font-size:20px; '><strong>Cheque No</strong></th>";
		$fields.="<th style='font-size:20px; '><strong>Bank Name</strong></th>";
		$fields.="<th style='font-size:20px; '><strong>Paid</strong></th>";
            }
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
            {
		$from=$database->convert_date($_REQUEST['fromdt']);
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
            {
		$from=$database->convert_date($_REQUEST['fromdt']);
		$to=date("Y-m-d");
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
            {
                $from=date("Y-m-d");
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	else
           {
		$bydatz=$_REQUEST['bydate'];
		if($bydatz!="null")
                    {
                        if($bydatz=="Last5days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                                $st="Last5days";
                            }
                        elseif($bydatz=="Last10days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                                $st="Last10days";
                            }
                        else if($bydatz=="Yesterday")
                            {
				$string.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				$st="Yesterday";
                            }
                        elseif($bydatz=="Last15days")
                            {
                                $string.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                $st="Last15days";
                            }
                        else if($bydatz=="Last20days")
                            {
                                $string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                $st="Last20days";
                            }
                        else if($bydatz=="Last25days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                $st="Last25days";
                            }
                        else if($bydatz=="Last30days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                $st="Last30days";
                            }
                        else if($bydatz=="Last1month")
                            {
				$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				$st="Last1month";
                            }
                        else if($bydatz=="Today")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                $st="Today";
                            }
                        else if($bydatz=="Last90days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                $st="Last90days";
                            }
                        else if($bydatz=="Last180days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                                $st="Last180days";
                            }
                        else if($bydatz=="Last365days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                                $st="Last365days";
                            }
                        $reporthead=$st;
                    }
                else
                    {
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }
            }
    

  $data=array();
  $data1=array();
  $final=0;
  $paid=0;
  $bal=0; 
  $coup=0;
  $paidcrdt=0;
  $total_transaction=0;
$sql_login =  $database->mysqlQuery("select tbm.tab_netamt,tbm.tab_billno,tbm.tab_transactionamount,tbm.tab_dayclosedate,tbm.tab_amountpaid,b.bm_name,
tbm.tab_amountbalace from tbl_takeaway_billmaster tbm left join tbl_paymentmode p on tbm.tab_paymode=p.pym_id left join  tbl_bankmaster b on b.bm_id=tbm.tab_transcbank where $string");
	 $num_login   = $database->mysqlNumRows($sql_login);
	 
            if($num_login)
                {
                    $i=1;
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                            $final=number_format($final+$result_login['tab_netamt'],$_SESSION['be_decimal']);
                            $paid=number_format($paid +$result_login['tab_amountpaid'],$_SESSION['be_decimal']);
                            $paidcrdt=number_format($paidcrdt + ($result_login['tab_amountpaid']-$result_login['tab_amountbalace']),$_SESSION['be_decimal']);
                            $total_transaction=number_format($total_transaction+$result_login['tab_transactionamount'],$_SESSION['be_decimal']);
			
                            $data['Slno']=$i;
                            $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
                            $data['Bill NO']=$result_login['tab_billno'];
	
                            if($_REQUEST['types']=="cash")
				{
                                    $data['Cash']=number_format(($result_login['tab_amountpaid']-$result_login['tab_amountbalace']),$_SESSION['be_decimal']);
                                    $data['Final']=number_format($result_login['tab_netamt'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
                                    $i++;
                                }			
							
                            else if($_REQUEST['types']=="credit")
				{
                                    $data['Bank']=$result_login['bm_name'];
                                    $data['Card Payment']=number_format($result_login['tab_transactionamount'],$_SESSION['be_decimal']);
                                    $data['Final']=number_format($result_login['tab_netamt'],$_SESSION['be_decimal']); 
                                    array_push($data1,$data);
                                    unset($data);
                                    $i++;
                                } 
                        }
                }					  
            
            $data['Slno']="";
            $data['Date']="";
            $data['Bill NO']="";

            if($_REQUEST['types']=="cash")
                {
                    $data['Cash']="";
                    $data['Fianl']="";
                    array_push($data1,$data);
                    unset($data);
      
                }
            else if($_REQUEST['types']=="credit")
                {
		  
                    $data['Bank']="";
                    $data['Credit Payment']="";
                    $data['Final']="";
                    array_push($data1,$data);
                    unset($data);
 
                } 
            $data['Slno']="";
            $data['Date']="";
            $data['Bill No']="";

            if($_REQUEST['types']=="cash")
                {
		                   
                    $data['Cash']=number_format($paidcrdt,$_SESSION['be_decimal']);
                    $data['Fianl']=number_format($final,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                }

            else if($_REQUEST['types']=="credit")
                {
                    $data['Bank']="";
                    $data['Credit Payment']=number_format($total_transaction,$_SESSION['be_decimal']);      
                    $data['Final']=number_format($final,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                  
                }
        $filename = "Payment Mode report_ cs -" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        $flag = false;
        foreach($data1 as $row) 
            {
                if(!$flag) 
                    {
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
    
//********************************************Home DElivery excel**************************************************************//  

else if($_REQUEST['type']=="tot_sales_hd")
    {
        $reporthead="";
        $st="";
        $string="";
         $staffsel = $_REQUEST['staffsel'];
    $string.="tab_mode='HD' AND tab_status='Closed' and tab_complimentary!='Y' and ";
    if($_REQUEST['staffsel']!='null')
    {
        $string.="tab_assignedto='".$staffsel."' AND ";
    }
        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
            {
                $from=$database->convert_date($_REQUEST['fromdt']);
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }
        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
            {
                $from=$database->convert_date($_REQUEST['fromdt']);
                $to=date("Y-m-d");
		$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }
        else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
            {
		$from=date("Y-m-d");
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }
      
        else
            {
                $bydatz=$_REQUEST['bydate'];
                if($bydatz!="null")
                    {   
                        if($bydatz=="Last5days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                                $st="Last 5 days";
                            }
                        elseif($bydatz=="Last10days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                                $st="Last 10 days";
                            }
                        elseif($bydatz=="Last15days")
                            {
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                $st="Last 15 days";
                            }
                        else if($bydatz=="Last20days")
                            {
                                
                                $string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                $st="Last 20 days";
                            }
                        else if($bydatz=="Last25days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                    $st="Last 25 days";
                            }
                        else if($bydatz=="Last30days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                $st="Last 30 days";
                            }
                        else if($bydatz=="Today")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                $st="Today";
                            }
                        else if($bydatz=="Yesterday")
                            {
                                $string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                                $st="Yesterday";
                            }
                        else if($bydatz=="Last1month")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                $st="Last 1 months";
                            }
                        else if($bydatz=="Last90days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                $st="Last 3 months";
                            }
                        else if($bydatz=="Last180days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                                $st="Last 6 months";
                            }
                        else if($bydatz=="Last365days")
                            {
                                $string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                                $st="Last 1 year";
                            }
                        $reporthead=$st;
                    }
                else
                    {
                        $from=date("Y-m-d");
                        $to=date("Y-m-d");
                        $string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }
            }
    $data=array();
    $data1=array();
    $final=0;
    $paid=0;
    $bal=0; 
    $dsc=0;
    $subtotal=0;
                            $tax_name=array();
                            $tax_id=array();
                                  $sql_login  =  $database->mysqlQuery(" select  distinct(tketm.tbe_taxid) as taxid,tketm.tbe_label as taxname  FROM tbl_takeaway_bill_extra_tax_master tketm left join  tbl_extra_tax_master tm on tm.amc_id=tketm.tbe_taxid group by tm.amc_id order by tm.amc_id asc "); 
                                     $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                       $tax_name[]=$result_login['taxname'];
                                       $tax_id[]=$result_login['taxid'];
                                     }} 
    $sql_login  =  $database->mysqlQuery("select tab_subtotal,tab_discountvalue,tab_netamt,tab_amountpaid,
    tab_amountbalace,tab_dayclosedate,tab_billno from tbl_takeaway_billmaster where $string");
    $num_login   = $database->mysqlNumRows($sql_login);

    if($num_login)
        {   $i=1;$servtax=0;$vat=0; $servcharge=0;
            while($result_login  = $database->mysqlFetchArray($sql_login)) 
                {
                    $subtotal=$subtotal + $result_login['tab_subtotal'];
                    $dsc=$dsc + $result_login['tab_discountvalue'];
                    $final=$final + $result_login['tab_netamt'];
                    $paid=$paid +$result_login['tab_amountpaid'];
                    $bal=$bal + $result_login['tab_amountbalace'];
                    $data['Slno']=$i;
                    $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
                    $data['Billno']=$result_login['tab_billno'];
                    $data['Sub Total']=number_format($result_login['tab_subtotal'],$_SESSION['be_decimal']);
                    
                    for($s=0;$s<count(array_unique($tax_id));$s++){
                    $sql_taxvalue  =  $database->mysqlQuery("select  tketm.tbe_total_value,tketm.tbe_taxid, tketm.tbe_label FROM tbl_takeaway_bill_extra_tax_master tketm  where tketm.tbe_billno='".$result_login['tab_billno']."' and tketm.tbe_taxid ='".$tax_id[$s]."' order by tketm.tbe_taxid asc"); 
                    $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                    if($num_taxvalue){$i=0;
                        while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                        { if($result_taxvalue['tbe_total_value']==''){
                            $result_taxvalue['tbe_total_value']=0;
                        }
                        $tax_value[$result_taxvalue['tbe_taxid']][]=$result_taxvalue['tbe_total_value'];
                   
                        $data[$result_taxvalue['tbe_label']]=number_format($result_taxvalue['tbe_total_value'],$_SESSION['be_decimal']);
                    
                        } } 
                    else { 
                        $tax_value[$tax_id[$s]][]=0;
                    $data[$result_taxvalue['tbe_label']]=number_format(0,$_SESSION['be_decimal']);
                     } }

                    $data['Discount']=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
                    $data['Final']=number_format($result_login['tab_netamt'],$_SESSION['be_decimal']);
                    $data['Paid']=number_format($result_login['tab_amountpaid'],$_SESSION['be_decimal']);
                    $data['Balance']=number_format($result_login['tab_amountbalace'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                        
                    $i++;
                } 
        } 

            $data['Slno']="";
            $data['Date']="";
            $data['Billno']="";
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
    
        
        $data['Slno']="TOTAL";
        $data['Date']="";
        $data['Billno']="";
        $data['Sub Total']=number_format($subtotal,$_SESSION['be_decimal']);
        for($i=0;$i<count(array_unique($tax_id));$i++){ 
            $data[$tax_id[$i]]=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal']);
        }
        for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){ 
            $data[$tax_id[$o]]=number_format(0,$_SESSION['be_decimal']);
        } 
        $data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
        $data['Final']=number_format($final,$_SESSION['be_decimal']);
        $data['Paid']=number_format($paid,$_SESSION['be_decimal']);
        $data['Balance']=number_format($bal,$_SESSION['be_decimal']);
        array_push($data1,$data);
        unset($data);
        
        $filename = "Total Sales report_" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
    else if($_REQUEST['type']=="delivery_report_hd")
{
    $string="";
	$string.=" tbm.tab_status !='Cancelled'  AND tbm.tab_mode='HD' ";
        
        if(isset($_REQUEST['staffsel']) && ($_REQUEST['staffsel']!='' && $_REQUEST['staffsel']!='null')){
           $string.= " and  tbm.tab_assignedto='".$_REQUEST['staffsel']."'  " ;
        }
        
        if(isset($_REQUEST['del_typ']) && ($_REQUEST['del_typ']!='' && $_REQUEST['del_typ']!='null')){
           $string.= " and  tbm.tab_delivery_status='".$_REQUEST['del_typ']."'  " ;
        }
	$reporthead="";					
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}		
				
	else 
	{
		
		$bydatz=$_REQUEST['bydate'];
			if($bydatz!="null" && $bydatz!="")
			{
	if($bydatz=="Last5days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	$st="Last5days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	$st="Last10days";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
 $st="Last15days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last20days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last25days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last30days";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  $st="Last1month";
			  }
	else if($bydatz=="Today")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
    else if($bydatz=="Last90days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last90days";
	}
    else if($bydatz=="Last180days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last180days";
	}
    else if($bydatz=="Last365days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last365days";
	}
	$reporthead=$st;
    }
    else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	}
$del=0; $final=0;
 $data=array();
  $data1=array();
$sql_login  =  $database->mysqlQuery("select tbm.tab_netamt,tbm.tab_date,tbm.tab_delivery_charge,tbm.tab_billno,tbm.tab_time,ts.ser_firstname,tac.tac_customername,tac.tac_address,tac.tac_contactno from tbl_takeaway_billmaster tbm left join tbl_staffmaster ts on ts.ser_staffid=tbm.tab_assignedto left join tbl_takeaway_customer tac on tac.tac_customerid=tbm.tab_hdcustomerid where $string and  tbm.tab_complimentary!='Y'  "); 
$old='';$new='';	 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$i++;                    
			$final=	$final+$result_login['tab_netamt'];
                    $del=	$del+$result_login['tab_delivery_charge'];
  
                    $data['Bill No']=$result_login['tab_billno'];
                    $data['Date-Time']=$result_login['tab_date']." ".$result_login['tab_date'];                   
                    $data['Customer']=$result_login['tac_customername'];
                    $data['Number']=$result_login['tac_contactno'];
                    $data['Address']=$result_login['tac_address'];                   
                    $data['Delivered By']=$result_login['ser_firstname'];                   
                    $data['Delivery Charge']=number_format($result_login['tab_delivery_charge'],$_SESSION['be_decimal']);
                    $data['Bill Amount']=number_format($result_login['tab_netamt'],$_SESSION['be_decimal']);                   
                    array_push($data1,$data);
                    unset($data);
          } }

                    $data['Bill No']="Total";
                    $data['Date-Time']="";
                    $data['Customer']="";
                    $data['Number']="";
                    $data['Address']="";
                    $data['Delivered By']="";
                    $data['Delivery Charge']=number_format($del,$_SESSION['be_decimal']);
                    $data['Bill Amount']=number_format($final,$_SESSION['be_decimal']);
                    
                    array_push($data1,$data);
                    unset($data);
                $filename = "Delivery Report" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        $flag = false;
        foreach($data1 as $row) 
            {
                if(!$flag) 
                    {
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
    
 else if(($_REQUEST['type']=="order_hd"))
{
	$string="";  
        $reporthead="";
        $string.=" tbm.tab_status='closed' AND  tbm.tab_mode = 'HD' AND ";
	    $staffsel = $_REQUEST['staffsel'];
         
        if($_REQUEST['staffsel']!='null')
	{
		$string.="tbm.tab_assignedto='".$staffsel."' AND ";
	}
        $addon_head='';
        $stringta_addon='';
            if($_REQUEST['addon']=='N')
            {
                $stringta_addon.=" and tbd.tab_bill_addon_slno IS NULL ";
            }
            else if($_REQUEST['addon']=='Y')
            {               
                $stringta_addon.=" and tbd.tab_bill_addon_slno IS NOT NULL ";
                $addon_head='-Addon ';
            }
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);                    
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);                       
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);                       
		}
                
	
	else 
	{
			$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null")
	{	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5DAY AND CURDATE( )";
        $st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
        $st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
        $st="Last 15 days";

	}
	else if($bydatz=="Last20days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
        $st="Last 20 days";

	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
        $st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
        $st="Last 30 days";

	}
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
        $st="Today";
	}
else if($bydatz=="Yesterday")
	{
		$string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
        $st="Yesterday";
	}
	else if($bydatz=="Last1month")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
        $st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
        $st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
        $st="Last 6 months";              
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
        $st="Last 1 Year";
	}
              $reporthead=$st;
	}
	else
	{		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}		
	}

 	$sql_item  =  $database->mysqlQuery("SELECT tbm.tab_billno, tbd.tab_menuid, mmc.mmy_maincategoryname, msc.msy_subcategoryname , mm.mr_menuname, sum(tbd.tab_qty) as qty, pm.pm_portionname, tbd.tab_rate, tbd.tab_amount,sum(tbd.tab_qty* tbd.tab_rate) as Total
        from tbl_takeaway_billmaster tbm
        left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno
        left join tbl_menumaster mm on tbd.tab_menuid = mm.mr_menuid
        left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid = mm.mr_maincatid
        left join tbl_menusubcategory msc on mm.mr_subcatid = msc.msy_subcategoryid
        left join tbl_portionmaster pm on pm.pm_id = tbd.tab_portion
        where $string $stringta_addon 
        group by tbd.tab_menuid 
        ORDER BY mmc.mmy_maincategoryname ASC"); 

        $data=array();
        $data1=array();
        $old="";
        $catname ="";
        $final=0;
	  $num_item   = $database->mysqlNumRows($sql_item);
	  if($num_item){$i=1;
		  while($result_item  = $database->mysqlFetchArray($sql_item)) 
			{
                        $final=$final+$result_item['Total'];
                      
                      if($result_item['mmy_maincategoryname']==$old){
                          $catname ="";
                          
                      }else{
                          $catname = $result_item['mmy_maincategoryname'];
                          $old = $result_item['mmy_maincategoryname'];
                      }
                    $data['Category']=$catname;
                    $data['Sub Category']=$result_item['msy_subcategoryname'];
                    $data['Item']=$result_item['mr_menuname'];
                    $data['Portion']=$result_item['pm_portionname'];
                    $data['Qty']=$result_item['qty'];
                    $data['Unit Price']=number_format($result_item['tab_rate'],$_SESSION['be_decimal']);
                    $data['Total']=number_format($result_item['tab_amount'],$_SESSION['be_decimal']); 
                    array_push($data1,$data);
                    unset($data);
               
			}
	  }
	  
                
                    $data['Category']="";
                    $data['Sub Category']="";
                    $data['Item']="";
                    $data['Portion']="";
                    $data['Qty']="";
                    $data['Unit Price']="";
                    $data['Total']="";
                    array_push($data1,$data);
                    unset($data);
                    
                    $data['Category']="Total";
                    $data['Sub Category']="";
                    $data['Item']="";
                    $data['Portion']="";
                    $data['Qty']="";
                    $data['Unit Price']="";
                    $data['Total']=number_format($final,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    $filename = "Item Ordered report".$addon_head."-". date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
 else if(($_REQUEST['type']=="summary_hd"))
{
	$strings="";
        $string="";
	$reporthead="";
	$strings=" tb.tab_status='closed' AND tb.tab_mode!= 'CS' AND tb.tab_mode = 'HD' AND ";
//        $staffsel = $_REQUEST['staffsel'];
//         if($_REQUEST['staffsel']!='null')
//	{
//		$strings.="tab_assignedto='".$staffsel."' AND ";
//		
//	}
	$string1_str="(sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(tab_transactionamount) ";
	$string3_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string4_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string5_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string6_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace)))";
	$string7_str=" sum(tab_netamt) ";
        $string_pax="";
	$string_pax=" tab_status='Closed' AND ";
        
        $string1 =$strings." ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " tab_complimentary='Y' And pym_code='complimentary' AND";


		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "(tab_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "( tab_dayclosedate  between '".$from."' and '".$to."' ) "; 
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (tab_dayclosedate  between '".$from."' and '".$to."' ) ";
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
          
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
				$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" tab_dayclosedate = CURDATE() - INTERVAL 1 day";
		$string_pax.= "tab_dayclosedate =  CURDATE() - INTERVAL 1 day";
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$string_pax.= "tab_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
			$string_pax.= " tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
				$string_pax.= "  tab_dayclosedate   between '".$from."' and '".$to."'";
	}
	
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	
  $data=array();
  $data1=array();      
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
$sql_login  =  $database->mysqlQuery("select $string1_str as tot 
    from tbl_takeaway_billmaster tb
    left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
    where $string1"."$string order by tab_dayclosedate,tab_time ASC"); 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
				if($result_login['tot'] != "")	{
			$subtotal =$subtotal + $result_login['tot'];
	
                    $data['Type']="Cash";
                    $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']); 
                    array_push($data1,$data);
                        unset($data);
           
      } }}
$sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id , tbl_bankmaster b 
        where b.bm_id = tb.tab_transcbank and tb.tab_status='Closed' AND $string2 "."$string 
        order by tb.tab_dayclosedate,tb.tab_time ASC "); 
$num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
				$subtotal =$subtotal + $result_login1['tot'];
			
                                $data['Type']="Card";
                                $data['Value']=number_format($result_login1['tot'],$_SESSION['be_decimal']);  
                               array_push($data1,$data);
                                unset($data);			
			}
	  }
          
            $sql_logincreditta  =  $database->mysqlQuery("select distinct (b.bm_name) as bnk, sum(bc.mc_cardamount) as tot  FROM 
                                                    tbl_takeaway_billmaster bm 
                                                    left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id 
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.tab_billno
                                                    left join tbl_bankmaster b  on  b.bm_id = bc.mc_to_bank 
                                                    where tbl_paymentmode.pym_code='credit' and bm.tab_mode='HD'
                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND $string group by bnk");
                      


                  $num_logincreditta   = $database->mysqlNumRows($sql_logincreditta);
                  if($num_logincreditta){
                          while($result_logincreditta  = $database->mysqlFetchArray($sql_logincreditta)) 
                                {  
                              
                               $data['Type']=$result_logincreditta['bnk'];
                                $data['Value']=number_format($result_logincreditta['tot'],$_SESSION['be_decimal']);  
                               array_push($data1,$data);
                                unset($data);		
                          }
                          }
          
          
		$sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3"." $string order by tab_dayclosedate,tab_time ASC"); 
			
	  $num_login   = $database->mysqlNumRows($sql_login);

	  if($num_login)
               {
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
                        {
                            if($result_login['tot'] != "")
                                {
                                    $subtotal =$subtotal + $result_login['tot'];	
                                            
                                    $data['Type']="Coupons";
                                    $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
                                }
                        } 
                }
			
	  $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
                {
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                            if($result_login['tot'] != "")
                                {
                                    $subtotal =$subtotal + $result_login['tot'];

                                    $data['Type']="Voucher";
                                    $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
      
                                }
                        }
                }
			
          $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
                {
                    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                            if($result_login['tot'] != "")
                                {
                                    $subtotal= $subtotal + $result_login['tot'];
                                    
                                    $data['Type']="Cheque";
                                    $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                    array_push($data1,$data);
                                    unset($data);
         
                                }
                        }
                }
          
                
                
               
                
          $sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id where $string6"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login)
               {
		    while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                            if($result_login['tot'] != "")
                                {
                                    $subtotal =$subtotal + $result_login['tot'];
			
                                        $data['Type']="Credits";
                                        $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                                        array_push($data1,$data);
                                         unset($data);
                                } 
                        }
                }	
	
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot 
                        from tbl_takeaway_billmaster tb
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
                        where $string7"." $string order by tab_dayclosedate,tab_time ASC"); 
 $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['tot'] != "")
			{
        $data['Type']="Complimentary";
                        $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);  
                        array_push($data1,$data);
                        unset($data);    
                        
                        
                        } }}
		
			
			
                            
                          $data['Type']="";
                        $data['Value']="";  
                        array_push($data1,$data);
                        unset($data);
                        
                        $data['Type']="Total";
                        $data['Value']=number_format($subtotal,$_SESSION['be_decimal']);  
                        array_push($data1,$data);
                        unset($data);
                        
        $filename = "Summary report_" . $reporthead . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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

 else if(($_REQUEST['type']=="total_summary_details_hd"))
{
	$string="";
	$reporthead="";
	$strings=" tab_status='closed' AND tab_mode = 'HD' AND ";
        //$staffsel = $_REQUEST['staffsel'];
	$string1_str=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(tab_transactionamount) ";
	$string3_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string4_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string5_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string6_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace)))";
	$string7_str=" sum(tab_netamt)";
	$string_pax="";
	$string_pax=" tab_status='Closed' AND ";
	//	$string1 =$strings. " tab_paymode='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
	$string1 =$strings." ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " tab_complimentary='Y' And pym_code='complimentary' AND";
	

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "(tab_dayclosedate  between '".$from."' and '".$to."' ) ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "( tab_dayclosedate  between '".$from."' and '".$to."' ) ";
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (tab_dayclosedate  between '".$from."' and '".$to."' ) ";
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
          
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
				$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$string_pax.= "tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" tab_dayclosedate = CURDATE() - INTERVAL 1 day";
		$string_pax.= "tab_dayclosedate =  CURDATE() - INTERVAL 1 day";
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$string_pax.= "tab_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
			$string_pax.= " tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
			$string_pax.= "tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
				$string_pax.= "  tab_dayclosedate   between '".$from."' and '".$to."'";
	}
	
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	
  $data=array();
  $data1=array();
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
  $totalcash=0;
  $totalcoupons=0;
  $totalvoucher=0;
  $totalcheque=0;
  $totalcredits=0;
  $totalcomplimentary=0;
  $totalpax=0;
  $totalcreditordebit=0;
  
  $slno=0;
  $sql = $database->mysqlQuery("select distinct(tab_dayclosedate) from tbl_takeaway_billmaster where $string");
    $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
         
        $total=0;
          $slno++;
        if($result != ""){
            
            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
            $data['SlNo']=$slno;
            $data['Date']=$result['tab_dayclosedate'];
        }
  

  

  $sql_login  =  $database->mysqlQuery("select $string1_str as tot 
from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
where $string1"."$dt order by tab_dayclosedate,tab_time ASC"); 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_login  = $database->mysqlFetchArray($sql_login);
			
		if($result_login['tot'] != "")	{
                                    
                        $totalcash=$totalcash + $result_login['tot'];
                        $total= $total + $result_login['tot'];            
			$subtotal =$subtotal + $result_login['tot'];
                        
                        
			
          
              
          
          $data['Cash']=number_format($result_login['tot'],$_SESSION['be_decimal']);
          
         
             
           }else{
              $data['Cash']="--";
          }}else{
              $data['Cash']="--";
          }
          

	$sql_login1  =  $database->mysqlQuery("select $string2_str as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $strings "." $string2 "."$dt order by tb.tab_dayclosedate,tb.tab_time ASC ");
    $num_login1   = $database->mysqlNumRows($sql_login1);
	
	  if($num_login1){
		  $result_login1  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebit=$totalcreditordebit + $result_login1['tot'];  
			$total= $total + $result_login1['tot'];       
			$subtotal =$subtotal + $result_login1['tot'];
                      
			
            
            $data['Credit/Debit']=number_format($result_login1['tot'],$_SESSION['be_decimal']);
            
      
			
			
	  }else{
              $data['Credit/Debit']="--";
          }
		
$sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3"." $dt order by tab_dayclosedate,tab_time ASC"); 
			
            $num_login   = $database->mysqlNumRows($sql_login);
          
            if($num_login){
		  $result_login2  = $database->mysqlFetchArray($sql_login);
			if($result_login2['tot'] != "")	{
				
				$totalcoupons= $totalcoupons + $result_login2['tot'];
                                $total= $total + $result_login2['tot'];       
                                $subtotal =$subtotal + $result_login2['tot'];	
      
                                $data['Coupons']=number_format($result_login2['tot'],$_SESSION['be_decimal']);
         
           
                            }
                        else{
                            $data['Coupons']="--";
                            }
                         }else{
                             $data['Coupons']="--";
                             }
                      
			
           $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4"." $dt order by tab_dayclosedate,tab_time ASC"); 
           $num_login   = $database->mysqlNumRows($sql_login);
           if($num_login){
		  $result_login3  = $database->mysqlFetchArray($sql_login); 
			 
                    if($result_login3['tot'] != "")
			{
			$totalvoucher=$totalvoucher + $result_login3['tot'];
                        $total=$total + $result_login3['tot'];       
                        $subtotal =$subtotal + $result_login3['tot'];
                         
                        $data['Voucher']=number_format($result_login3['tot'],$_SESSION['be_decimal']);        
            
                         }
                    else{
                        $data['Voucher']="--";
                        }
            
                        }
                    else{
                        $data['Voucher']="--";
                        }
			
          $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5"." $dt order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login4  = $database->mysqlFetchArray($sql_login); 
			
			if($result_login4['tot'] != "")
			{
			
                        $totalcheque=$totalcheque + $result_login4['tot'];
                        $total= $total + $result_login4['tot'];       
                        $subtotal =$subtotal + $result_login4['tot'];
                        
                        $data['Cheque']=number_format($result_login4['tot'],$_SESSION['be_decimal']);
         
            
                       } 
                        else{
                            $data['Cheque']="--";
                        }
                        }
                    else{
                            $data['Cheque']="--";
                        }
                        
           $sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6"." $dt order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login5  = $database->mysqlFetchArray($sql_login);
			
			if($result_login5['tot'] != "")
			{
			
                        $totalcredits=$totalcredits + $result_login5['tot'];
                        $total= $total + $result_login5['tot'];     
                        $subtotal =$subtotal + $result_login5['tot'];
                        
                            $data['Credits']=number_format($result_login5['tot'],$_SESSION['be_decimal']);
                         
                        }
                        else{
                            $data['Credits']="--";
                             }
            
                        }
                    else{
                    $data['Credits']="--";
                        }          
			
	
				
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $string7"." $dt order by tab_dayclosedate,tab_time ASC");
                      
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login6  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_login6['tot'] != "")
			{
			
                        $totalcomplimentary= $totalcomplimentary + $result_login6['tot'];    
  
			
          
                        $data['Complimentary']=number_format($result_login6['tot'],$_SESSION['be_decimal']);
         
                         } 
                         else{
              $data['Complimentary']="--";
          }
                        }
            else{
              $data['Complimentary']="--";
          }
             $data['Total']=number_format($total,$_SESSION['be_decimal']);
               array_push($data1,$data);
               unset($data);
                             
                           
                            
                            
  }
  }
  
  
          $data['Slno']="";
                        $data['Date']="";
                        $data['Cash']="";
                        $data['Credit/Debit']="";
                        $data['Coupons']="";
                        $data['Voucher']="";
                        $data['Cheque']="";
                        $data['Credits']="";
                        $data['Complimentary']="";
                        $data['Total']="";
                        array_push($data1,$data);
                        unset($data);
                        
                        $data['Slno']="TOTAL";
                        $data['Date']=$reporthead;
                        $data['Cash']=number_format($totalcash,$_SESSION['be_decimal']);
                        $data['Credit/Debit']=number_format($totalcreditordebit,$_SESSION['be_decimal']);
                        $data['Coupons']=number_format($totalcoupons,$_SESSION['be_decimal']);
                        $data['Voucher']=number_format($totalvoucher,$_SESSION['be_decimal']);
                        $data['Cheque']=number_format($totalcheque,$_SESSION['be_decimal']);
                        $data['Credits']=number_format($totalcredits,$_SESSION['be_decimal']);
                        $data['Complimentary']=number_format($totalcomplimentary,$_SESSION['be_decimal']);
                        $data['Total']=number_format($subtotal,$_SESSION['be_decimal']);
                        array_push($data1,$data);
                        unset($data);
          
          $filename = "Sales Summary report_" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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

 else if(($_REQUEST['type']=="categorywise_report_hd"))
{
//	$string="";
     $string=" tbm.tab_status = 'Closed' and tbm.tab_mode='HD' AND ";
     $staffsel = $_REQUEST['staffsel'];
         
        if($_REQUEST['staffsel']!='null')
	{
		$string.="tbm.tab_assignedto='".$staffsel."' AND ";
		
	}
        $reporthead="";
	$st="";
 	  
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                     
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
		}
                
	
	
	else 
	{
            $reporthead="";
	$st="";
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		
	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5
DAY AND CURDATE( )";
 $st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                 $st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
        $st="Last 15 days";

	}
	else if($bydatz=="Last20days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
    $st="Last 20 days";

	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                 $st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                 $st="Last 30 days";

	}
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.="tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
                                  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                $st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $st="Last 6 months";
                
	}
else if($bydatz=="Last365days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $st="Last 1 Year";
	}
              $reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	}
            $data=array();
            $data1=array();
            $total=0;
            $final=0;
           
            $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,count(distinct(tbd.tab_menuid)) as 'no of items',sum(tbd.tab_qty) as qty ,sum(tbd.tab_qty* tbd.tab_rate) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster on mr_menuid =tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC ");
          $num_login   = $database->mysqlNumRows($sql_login);
             if($num_login){$i=1;$t=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$t++;
                          $total=$total+$result_login['Total'];
                                $data['Slno']=$i;
                                $data['Category']=$result_login['mmy_maincategoryname'];
                                $data['Item']=$result_login['no of items'];
                                $data['Qty']=$result_login['qty'];
                                $data['Total']=number_format($result_login['Total'],$_SESSION['be_decimal']);
                                array_push($data1,$data);
                                unset($data);
                                 
                               $i++;
                               
                        }} 
                               
                               
                                $data['Slno']="";
                                $data['Category']="";
                                $data['Item']="";
                                $data['Qty']="";
                                $data['Total']="";
                                array_push($data1,$data);
                                unset($data);
                              
                                $data['Slno']="Total";
                                $data['Category']="";
                                $data['Item']="";
                                $data['Qty']="";
                                $data['Total']=number_format($total,$_SESSION['be_decimal']);
                                array_push($data1,$data);
                                unset($data);
                                
                                
        $filename = "Category Wise report_" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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
 
 else if(($_REQUEST['type']=="cancel_history_hd"))
{
	$string="";
	$reporthead="";
	$st="";
        $string .= " tb.tab_status='Cancelled' AND tb.tab_mode = 'HD' AND ";
        $loginstaffsel = $_REQUEST['staffsel'];
         if($_REQUEST['staffsel']!='null')
	{
		$string.="tb.tab_cancelledlogin='".$loginstaffsel."' AND ";
		
	}
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tb.tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tb.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tb.tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		


	
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" tb.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  tb.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
	$reporthead=$st;

	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tb.tab_dayclosedate between '".$from."' and '".$to."' ";
	$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);		
	}
	}
	
 $data=array();
 $data1=array();
 $final=0;
  $paid=0;
  $bal=0; 
 $fuldet1=0;
 $ord=0;
 $kot=0;
 $cancel=0;
 $ser=0;
 $user=0;
 $chr=0;
 $otime=0;
 $qty=0;
 $total=0;
 
  $sql_login  =  $database->mysqlQuery("Select sum( bd.tab_qty) as qty,tb.tab_date, tb.tab_billno, tb.tab_kotno, tb.tab_time, tb.tab_netamt, tb.tab_cancelledtime, tb.tab_loginid, bd.tab_cancelledlogin, bd.tab_cancelledby_careof, tb.tab_cancelledreason, sm.ser_firstname
    From tbl_takeaway_billmaster as tb 
    left join tbl_takeaway_billdetails bd on bd.tab_billno = tb.tab_billno 
    left join tbl_staffmaster sm on sm.ser_staffid = tb.tab_cancelledby_careof
    where $string group by tb.tab_billno"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                             
                             $qty = $qty + $result_login['qty'];
                             $total =$total + $result_login['tab_netamt'];
  						
                             $data['Slno']=$i;
                             $data['Date']=$database->convert_date($result_login['tab_date']);
                             $data['Time']=$result_login['tab_time'];
                             $data['Bill no']=$result_login['tab_billno'];
                             $data['Qty']=$result_login['qty'];  
                             $data['Bill Cancel Date&Time']=$result_login['tab_cancelledtime'];
                             $data['Cancelled By']=$result_login['ser_firstname'];
                             $data['Cancelled Login']=$result_login['tab_cancelledlogin'];
                             $data['Reason For Cancellation']=$result_login['tab_cancelledreason'];
                             $data['Amount']=number_format($result_login['tab_netamt'],$_SESSION['be_decimal']); 
                             array_push($data1,$data);
                             unset($data);

                              $i++;} }
                              
                             $data['Slno']="";
                             $data['Date']="";
                             $data['Time']="";
                             $data['Bill no']=$result_login['tab_billno'];
                             $data['Qty']="";  
                             $data['Bill Cancel Date&Time']="";
                             $data['Cancelled By']="";
                             $data['Cancelled Login']="";
                             $data['Reason For Cancellation']="";
                             $data['Amount']=""; 
                             array_push($data1,$data);
                             unset($data);
                             
                             
                             
                             $data['Slno']="Total";
                             $data['Date']="";
                             $data['Time']="";
                             $data['Bill no']=$result_login['tab_billno'];
                             $data['Qty']=$qty;  
                             $data['Bill Cancel Date&Time']="";
                             $data['Cancelled By']="";
                             $data['Cancelled Login']="";
                             $data['Reason For Cancellation']="";
                             $data['Amount']=number_format($total,$_SESSION['be_decimal']); 
                             array_push($data1,$data);
                             unset($data);
                             
        $filename = "Cancelled History report_" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $flag = false;
        foreach($data1 as $row)
            {
                if(!$flag) 
                    {
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

else if($_REQUEST['type']=="billreport_hd")
    {
        $string="";
	$string=" tbm.tab_status='Closed' AND tbm.tab_mode='HD'";
	$reporthead="";
        $sort_string='';
        $sort_string1='';
        $sort_string.=$_REQUEST['sortby'];
        
        if($sort_string=='bill_asc'){
           $sort_string1.= " order by tbm.tab_billno asc";
        }
        else if($sort_string=='bill_desc'){
            $sort_string1.= " order by tbm.tab_billno desc";
        }
        else if($sort_string=='value_asc'){
           $sort_string1.= " order by tbm.tab_netamt asc";
        }
        else if($sort_string=='value_desc'){
            $sort_string1.=" order by tbm.tab_netamt desc";
        }
        
        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
            {
		$from=$database->convert_date($_REQUEST['fromdt']);
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
            {
		$from=$database->convert_date($_REQUEST['fromdt']);
		$to=date("Y-m-d");
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
            {
                $from=date("Y-m-d");
		$to=$database->convert_date($_REQUEST['todt']);
		$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
            }
	else
           {
		$bydatz=$_REQUEST['bydate'];
		if($bydatz!="null" && $bydatz!="")
                    {
                        if($bydatz=="Last5days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                                $st="Last5days";
                            }
                        elseif($bydatz=="Last10days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                                $st="Last10days";
                            }
                        else if($bydatz=="Yesterday")
                            {
				$string.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				$st="Yesterday";
                            }
                        elseif($bydatz=="Last15days")
                            {
                                $string.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                $st="Last15days";
                            }
                        else if($bydatz=="Last20days")
                            {
                                $string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                $st="Last20days";
                            }
                        else if($bydatz=="Last25days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                $st="Last25days";
                            }
                        else if($bydatz=="Last30days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                $st="Last30days";
                            }
                        else if($bydatz=="Last1month")
                            {
				$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				$st="Last1month";
                            }
                        else if($bydatz=="Today")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                $st="Today";
                            }
                        else if($bydatz=="Last90days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                $st="Last90days";
                            }
                        else if($bydatz=="Last180days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                                $st="Last180days";
                            }
                        else if($bydatz=="Last365days")
                            {
                                $string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                                $st="Last365days";
                            }
                        $reporthead=$st;
                    }
                else
                    {
                        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                    }
            }
    
    $data=array();
    $data1=array();
    $final=0; 
    $dsc=0;
    $dscfinal=0;

    $sql_login  =  $database->mysqlQuery("select tbm.tab_netamt,tbm.tab_discountvalue,tbm.tab_billno,tbm.tab_dayclosedate,mm.mr_menuname,tbd.tab_qty,tbd.tab_rate,p.pm_portionname from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid left join tbl_portionmaster p on p.pm_id=tbd.tab_portion where $string $sort_string1 "); 
    $old='';$new='';	 
    $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
            {
                $i=1;$k=1;$each=0;$dsc=0;
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
                    {
			$final=$final+($result_login['tab_rate'] * $result_login['tab_qty']);
                        if($i==1)
                            {
                                $dscfinal=$dscfinal+($result_login['tab_discountvalue']);
				$dsc=$dsc + ($result_login['tab_discountvalue']);
				$each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
//				$each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
				$old=$result_login['tab_billno'];
				$new=$result_login['tab_billno'];

                                $data['Slno']=$i;
                                $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
				$data['Bill no']=$result_login['tab_billno'];
                                $data['Items']=$result_login['mr_menuname'];
                                $data['Portions']=$result_login['pm_portionname'];
				$data['Quntity']=$result_login['tab_qty'];
		                $data['Rate']=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal']);
                                $data['Discount']=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
                                array_push($data1,$data);
                                unset($data);
        
                            }
                        else
                            {
				$old=$new;
				$new=$result_login['tab_billno'];
				if($new==$old)
                                    {
                                        $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
					
                                        $data['Slno']="";
                                        $data['Date']="";
                                        $data['Bill no']="";
                                        $data['Items']=$result_login['mr_menuname'];
                                        $data['Portions']=$result_login['pm_portionname'];
                                        $data['Quntity']=$result_login['tab_qty'];
                                        $data['Rate']=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal']);
                                        $data['Discount']=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
                                        array_push($data1,$data);
                                        unset($data);
                                    }
                                else
                                    {
					$data['Slno']="Total";
                                        $data['Date']="";
                                        $data['Bill no']="";
                                        $data['Items']="";
                                        $data['Portions']="";
                                        $data['Quntity']="";
                                        $data['Rate']=number_format($each,$_SESSION['be_decimal']);
                                        $data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
                                        array_push($data1,$data);
                                        unset($data);

                                        $each=0;$dsc=0;
                                        $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
                                        $dsc=$dsc + $result_login['tab_discountvalue'];
                                        $dscfinal=$dscfinal+$result_login['tab_discountvalue'];
		
                                        $data['Slno']=$k++;
                                        $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
                                        $data['Bill no']=$result_login['tab_billno'];
                                        $data['Items']=$result_login['mr_menuname'];
                                        $data['Portions']=$result_login['pm_portionname'];
                                        $data['Quntity']=$result_login['tab_qty'];           
                                        $data['Rate']=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal']);
                                        $data['Discount']=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
                                        array_push($data1,$data);
                                        unset($data);
                                    }
                            }
				$i++;

                    }
                    
                $data['Slno']="Total";
                $data['Date']="";
                $data['Bill no']="";
                $data['Items']="";
                $data['Portions']="";
                $data['Quntity']="";
                $data['Rate']=number_format($each,$_SESSION['be_decimal']);
                $data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
            } 
                              
        $data['Slno']="";
        $data['Date']="";
        $data['Bill no']="";
        $data['Items']="";
        $data['Portions']="";
        $data['Quntity']="";
        $data['Rate']="";
        $data['Discount']="";
        array_push($data1,$data);
        unset($data);
        
        $data['Slno']="Total";
        $data['Date']="";
        $data['Bill no']="";
        $data['Items']="";
        $data['Portions']="";
        $data['Quntity']="";
        $data['Rate']=number_format($final,$_SESSION['be_decimal']);
        $data['Discount']=number_format($dscfinal,$_SESSION['be_decimal']);
        array_push($data1,$data);
        unset($data);
        
        $data['Slno']="GRAND TOTAL";
        $data['Date']="";
        $data['Bill no']="";
        $data['Items']="";
        $data['Portions']="";
        $data['Quntity']="";
        $data['Discount']="";
        $data['Discount']=number_format(($final-$dscfinal),$_SESSION['be_decimal']);
        array_push($data1,$data);
        unset($data);
        
        $filename = "Bill report_ HD -" . date('Y-m-d') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        $flag = false;
        foreach($data1 as $row) 
            {
                if(!$flag) 
                    {
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
                              
        