<?php

include('includes/session.php');
//session_start();
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  
    $database	= new Database();
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");
    $database	= new Database();
} 


// Create a new instance
 function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
  
  error_reporting(0);
  
   if($_REQUEST['type'] == "categorywise_report_cr")
    {	
        $string="";
	$string="bm.bm_status = 'Closed'";
        $stringta="";
	$stringta="tbm.tab_status = 'Closed'";
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
                    $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
                    $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                     $from=$database->convert_date($_REQUEST['fromdt']);
		     $to=date("Y-m-d");
		     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                     $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
                     $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
                else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
                {
                     $from=date("Y-m-d");
                     $to=$database->convert_date($_REQUEST['todt']);
                     $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."'  ";
                     $stringta.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
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
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $st="Last 5 days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $st="Last 10 days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $st="Yesterday";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="  and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $stringta.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $st="Last 15 days";
                }
                else if($bydatz=="Last20days")
                {
                    $string.=" and  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $stringta.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $st="Last 20 days";
                }
                else if($bydatz=="Last25days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $st="Last 25 days";
                }
                else if($bydatz=="Last30days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $st="Last 30 days";
                }
                else if($bydatz=="Last1month")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $st="Last 1 Month";
                }
                else if($bydatz=="Today")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                    $st="Today";
                }
                else if($bydatz=="Last90days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $st="Last 90 days";
                }
                else if($bydatz=="Last180days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $stringta.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                    $st="Last 180 days";
                }
                else if($bydatz=="Last365days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
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
                $reporthead="From ".$database->convert_date($from)."To".$database->convert_date($to);
                
                }
                
	}
       
	
	
            $data=array();
            $data1=array();
            $xlsRow=1;
            $total=0;
            $totalta=0;
            $final=0;
            $i=1;
           $sql_login_combo  =  $database->mysqlQuery(" select sum(items) as noofitems,category,sum(qty) as qty, sum(amount) as amount from (
                                                        select  distinct( count(cbd.cbd_combo_pack_id)) as items,'COMBO MENUS'as category, sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as amount  FROM tbl_combo_bill_details cbd left join  tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno where $string group by cbd.cbd_billno union all
                                                        select  distinct(count(cbd.cbd_combo_pack_id)) as items,'COMBO MENUS'as category, sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as amount  FROM tbl_combo_bill_details_ta cbd left join  tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno where $stringta group by cbd.cbd_billno)x group by x.category");

            $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
             if($num_login_combo){$t=0;
		  while($result_login_combo  = $database->mysqlFetchArray($sql_login_combo)) 
			{$t++;
                           $final=$final+$result_login_combo['amount'];
                          //$final=$final+$result_login['Final'];
                          $data['Sl No']=$xlsRow;
                          $data['Maincategory']="**".$result_login_combo['category'];
                          $data['No Of Items']=$result_login_combo['noofitems'];
                          $data['Quantity']=$result_login_combo['qty'];
                          $data['Total']=number_format($result_login_combo['amount'],$_SESSION['be_decimal']);
                          
                          array_push($data1,$data);
                          unset($data);
                          
                          $xlsRow++;
                         $i++;
                         
                        }}
           $sql_login  =  $database->mysqlQuery(" SELECT mmy_maincategoryname,count(distinct(mr_menuid)) as noofitems,sum(qty + qty1) as qty,sum(Total) as Total From ( SELECT m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,sum(0) as qty1,bd.bd_rate as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where bd.bd_count_combo_ordering is NULL and $string group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname union all 
                     SELECT m.mr_menuid ,mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(0) as qty,sum(tbd.tab_qty) as qty1 ,tbd.tab_rate as Unit_Price ,sum(tbd.tab_amount) as Total from tbl_takeaway_billdetails tbd left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno where tbd.tab_count_combo_ordering is NULL and $stringta group by m.mr_menuid,mc.mmy_maincategoryname,ms.msy_subcategoryname) x group by mmy_maincategoryname ORDER BY mmy_maincategoryname ASC ");

     $num_login   = $database->mysqlNumRows($sql_login);
             if($num_login){$t=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$t++;
                          $final=$final+$result_login['Total'];
                          //$final=$final+$result_login['Final']; 
                          
                          $data['Sl No']=$xlsRow;
                          $data['Maincategory']=$result_login['mmy_maincategoryname'];
                          $data['No Of Items']=$result_login['noofitems'];
                          $data['Quantity']=$result_login['qty'];
                          $data['Total']=number_format($result_login['Total'],$_SESSION['be_decimal']);
                          
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
	$data[]="";
	$data[]=number_format($final,$_SESSION['be_decimal']);
        array_push($data1,$data);
        
        $filename = " Consolidated Categorywise Report-" . $reporthead . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
else if($_REQUEST['type']=="bill_wise_lukado")
{	
        ////////lukado lookodu////
    
        $type =  $_REQUEST['type']; 
        $string="";
        $stringta="";
        $string_combo='';
        $mode=$_REQUEST['department'];
        $string.=" bm.bm_status = 'Closed'  ";
        $stringta.=" bm.tab_status = 'Closed'  ";
        
        
        if($_REQUEST['phone_order']=='P'){
            
             $stringta.=" and  bm.tab_phone_order = 'Y'  ";  
            
             $string.=" and bm.bm_status = '1Closed'  ";
            
        }
        
        
        if($_REQUEST['loginstaffsel']!='' && $_REQUEST['loginstaffsel']!='null' && $mode!='HD')
        {   
            $stringta.=" and bm.tab_loginid='".$_REQUEST['loginstaffsel']."' ";
        }
        
        if(isset ($_REQUEST['floorz']))
	{
		$floorvalue=$_REQUEST['floorz'];
                if($floorvalue!="")
                {
		$string.="and bm.bm_floorid='".$floorvalue."'";
                }
	}
       if($_REQUEST['staff_hd']!='' && $_REQUEST['staff_hd']!='null' && $mode=='HD'){
           
             $hdstring= " left join tbl_staffmaster ts on ts.ser_staffid=bm.tab_assignedto ";
             $stringta.=" and bm.tab_assignedto='".$_REQUEST['staff_hd']."' ";
         }else {
             $hdstring= " left join tbl_staffmaster ts on ts.ser_staffid=bm.tab_assignedto ";
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
                    $st="Last 5 days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                     $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $st="Last 10 days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.=" and bm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $string_combo.= " cbd.cbd_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $st="Yesterday";
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
                    $st="Today";
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
                $st="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            }
                $reporthead=$st;
	    }
            
                        
            
            
            
            
   
    
       $data=array();
       $data1=array();
                               
       $f=0;  
       $final=0;
 
        $sql_login = $database->mysqlQuery("select tm,billno,final,dayclose,remarks,name,number,tax,sub,taxempt,login,pay,paid from 
        (select  bm_billtime as tm,bm_dayclosedate as dayclose,bm_billno as billno,bm_finaltotal as final, bm_subtotal_final as sub,
        (bm_finaltotal-bm_subtotal_final) as tax,bm_tax_exempt as taxempt,
         bm_cname as name, bm_cnumber as  number, bm_gst as remarks  ,bm_settlement_login as login,bm_paymode as pay,
        bm_amountpaid as paid from tbl_tablebillmaster bm  
        where  $string   
            
        union all
        
        select tab_time as tm, tab_dayclosedate as dayclose ,  tab_billno as billno, 
        tab_netamt as final, tab_subtotal_final as sub, (tab_netamt-tab_subtotal_final) as tax,tab_tax_exempt as taxempt,
        tab_name as name,tab_phone as number,tab_gst as remarks ,tab_settlement_login as login,tab_paymode as pay,
        tab_amountpaid as paid from tbl_takeaway_billmaster bm where  $stringta  )s  order by dayclose ,tm ASC ");   
  
    
        
        
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
           while($result_login  = $database->mysqlFetchArray($sql_login)) 
	   {
              $f++;
              $final=$final + $result_login['final'];
	   
              if($result_login['pay']=='1') {
                  
                  $mode='Cash';
                  
              }else if($result_login['pay']=='2') {
                  
               if($result_login['paid']>0) {   
                  
                $mode='Card & Cash';  
                
               }else{
                   
                    $mode='Card';  
               }
                
                  
              }else if($result_login['pay']=='6') {
                  
                $mode='Credit';  
                  
              }else if($result_login['pay']=='7') {
                  
                $mode='Compl';  
                  
              }
              
                          $data['Sl']=$f;
                          $data['Date']=$database->convert_date($result_login['dayclose']);
                          $data['Bill No']=$result_login['billno'];
                          $data['Subtotal']=number_format($result_login['sub'],$_SESSION['be_decimal']);
                          $data['Excempt']=number_format($result_login['taxempt'],$_SESSION['be_decimal']);
                          $data['Tax']=number_format($result_login['tax'],$_SESSION['be_decimal']);
                          $data['Bill Amount']=number_format($result_login['final'],$_SESSION['be_decimal']);
                          $data['Paymode']=$mode;
                          $data['Name']=$result_login['name'];
                          $data['Number']=$result_login['number'];
                          $data['Remarks']=$result_login['remarks'];
                          $data['Staff']=$result_login['login'];
                          
                          
//                           if($result_login['lukado']!='') { 
//                               
//                            $data['Lukdao']=$result_login['qty'];
//                            if (strpos($result_login['lukado'], 'success') !== false) { 
//                              $data['Lookodu']='Success';
//                            }else{
//                               
//                               $data['Lookodu']='Error';  
//                           }
//                           }else{
//                               
//                               $data['Lukado']='';  
//                           }
                           
                          array_push($data1,$data);
                          unset($data);
                          
	 
                        
 } }  
 
        $data[]="Total";
	$data[]="";
	$data[]="";
	$data[]="";
        $data[]="";
	$data[]="";
	
	$data[]=number_format($final,$_SESSION['be_decimal']);
        $data[]="";
         $data[]="";
         $data[]="";
        $data[]="";
        $data[]="";
       
        array_push($data1,$data);
        
  $filename = " Billwise Report-" . $reporthead . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data1 as $row) {
    if(!$flag){
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
 else if(($_REQUEST['type']=="counter_shift_cr"))
{
	$string="";
        $cashcounter='';
        $loginstaff='';
        if($_REQUEST['shiftlogin']!="all"){
        
        $string=" sd.sd_open_staff='".$_REQUEST['shiftlogin']."' AND ";
        $loginstaff.=" and sd.sd_open_staff='".$_REQUEST['shiftlogin']."' ";
      
        }
        
        $modeofview=$_REQUEST['modeofview'];
        if($_REQUEST['cashcounter']!=''){
        $cashcounter.=" and sd.sd_open_machineid= '".$_REQUEST['cashcounter']."' ";
        }
         
	$reporthead="";
	$st="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			 $string.= " sd.sd_day between '".$from."' and '".$to."' ";
                          
                         $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " sd.sd_day between '".$from."' and '".$to."' ";
                       
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " sd.sd_day between '".$from."' and '".$to."' ";
                        
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	
	else 
	{

	$reporthead="";
	$st="";
        
	$bydatz=$_REQUEST['bydate'];
	
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";


$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                
$st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
              
$st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
               
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
               
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" sd.sd_day = CURDATE( ) - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";
                                  
				  $st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  sd.sd_day between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                

$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
               
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
               
			$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" sd.sd_day between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
              
		$st="Last 1 year";
	}	
	$reporthead=$st;

	}
	else
	{
		        $from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " sd.sd_day between '".$from."' and '".$to."' ";
                       
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
        }
		
       }
       
         
        $data=array();
            $data1=array();
                          
                          
                 $shift_open_bal_new=0;
                 $shiftclosing_balance=0;
	     
                        $sql_shiftdates  =  $database->mysqlQuery("select ld.ls_username,sd.sd_total_value,sd.sd_total_value_close,  sd.sd_day, sd.sd_open_staff,sd.sd_open_machineid,em.cm_ip_remarks,sm.ser_firstname,em.cm_ip_address FROM tbl_shift_details sd 
                                                                       left join tbl_logindetails ld on ld.ls_staffid= sd.sd_open_staff  LEFT JOIN  tbl_expodine_machines em on em.cm_ip_address=sd.sd_open_machineid
                                                                        left join tbl_staffmaster sm on sm.ser_staffid=sd.sd_open_staff where  $string $cashcounter group by sd.sd_day, sd.sd_open_staff  order by sd.sd_day,sd.sd_open_machineid");
                          
                       
                        $num_shiftdates   = $database->mysqlNumRows($sql_shiftdates);
                            if($num_shiftdates){ 
                                
                                $previous_date='';$previous_ip='';
                            
                           
                            while($result_shiftdates  = $database->mysqlFetchArray($sql_shiftdates)) 
                                {
                                
                                 $shift_open_bal_new= number_format($result_shiftdates['sd_total_value'],2); 
                                 $shiftclosing_balance=  number_format($result_shiftdates['sd_total_value_close'],2); 
                //     echo $shift_open_bal_new.'---'   ;       
                
          $shiftuserid=$result_shiftdates['ls_username'];
                  
          $total_shift_expense_all_cash=0;
                
          $expense_voucher_cash=0;
           $sql_login_shift_ex_cash="select sum(ev_amount) as expense FROM tbl_expense_voucher left join tbl_ledger_master on tbl_ledger_master.tlm_id=tbl_expense_voucher.ev_from_acc where tlm_type='Cash_account' and  ev_login='$shiftuserid'  ";
               
		$sql_login_shift_ex1_cash  =  mysqli_query($localhost,$sql_login_shift_ex_cash); 
		$num_login_shift_ex1_cash  = mysqli_num_rows($sql_login_shift_ex1_cash);
		if($num_login_shift_ex1_cash){	
		while($result_login_shift_ex_cash = mysqli_fetch_array($sql_login_shift_ex1_cash)) 
				{
					 
                                        $expense_voucher_cash=  $result_login_shift_ex_cash['expense'];    
				}
		}
                 
          $supplier_voucher_cash=0;
          $sql_login_shift_ex_cash="select sum(sv_paid_amount) as expense1 FROM tbl_supplier_voucher left join tbl_ledger_master on tbl_ledger_master.tlm_id=tbl_supplier_voucher.sv_from where tlm_type='Cash_account' and sv_login='$shiftuserid' ";
              $sql_login_shift_ex1_cash  =  mysqli_query($localhost,$sql_login_shift_ex_cash); 
		$num_login_shift_ex1_cash  = mysqli_num_rows($sql_login_shift_ex1);
		if($num_login_shift_ex1_cash){	
		while($result_login_shift_ex_cash = mysqli_fetch_array($sql_login_shift_ex1_cash)) 
				{
					 
                                        $supplier_voucher_cash=  $result_login_shift_ex_cash['expense1'];    
				}
		}    
                
          $employee_voucher_cash=0;
          $sql_login_shift_ex_cash="select sum(ev_amount) as expense2 FROM tbl_employee_voucher left join tbl_ledger_master on tbl_ledger_master.tlm_id=tbl_employee_voucher.ev_from where tlm_type='Cash_account' and ev_login='$shiftuserid' ";
               
		$sql_login_shift_ex1_cash  =  mysqli_query($localhost,$sql_login_shift_ex_cash); 
		$num_login_shift_ex1_cash  = mysqli_num_rows($sql_login_shift_ex1_cash);
		if($num_login_shift_ex1_cash){	
		while($result_login_shift_ex_cash = mysqli_fetch_array($sql_login_shift_ex1_cash)) 
				{
					 
                                        $employee_voucher_cash=  $result_login_shift_ex_cash['expense2'];    
				}
		}
                
           $total_shift_expense_all_cash=($employee_voucher_cash+$supplier_voucher_cash+$expense_voucher_cash); 
          
                                
                                if($previous_date!=$result_shiftdates['sd_day']){
                                       $previous_ip='';
                                        $previous_date=$result_shiftdates['sd_day'];
                        
                                }
                                
                                if($previous_ip!=$result_shiftdates['sd_open_machineid']){
                                       
                                        $previous_ip=$result_shiftdates['sd_open_machineid'];
                               
                                  
                                        
                                        
    $tax_id      =array();                              
   $tax_name      =array();
    $values_sum    =array();
    
                $sql_login  =  $database->mysqlQuery(" select amc_id as taxid,amc_label as taxname  FROM tbl_extra_tax_master where  amc_active='Y' and amc_item_tax='N' "); 
      $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login){ 
                    while($result_login=$database->mysqlFetchArray($sql_login)){
                    $tax_name[]=$result_login['taxname'];
                    $tax_id[]=$result_login['taxid'];
                    
                }} 
                        
                                        
                          
                              
                              
                                  
                                    
                                    $final_di=0;
                                    
                                    $final_ta=0;$final_cs=0;$final_hd=0;
                                    
                                    $cash_di=0;$card_payments_di=0;$card_payments_di=0;$credit_payments_di=0;$coupon_payments_di=0;$complimentary_payments_di=0;$cheque_payments_di=0;$upi_payments_di=0;$round_of=0;$discount=0;
                                    $sql_cash_di  =  $database->mysqlQuery("select sum(bm.bm_finaltotal) as total,sum(bm.bm_amountpaid-bm.bm_amountbalace) cash , sum(bm.bm_transactionamount) as card, sum(bm.bm_chequebankamount) as cheque,sum(bm.bm_upi_amount) as upi, sum(bm.bm_couponamt) as coupon, sum(bm.bm_discountvalue) as discount, sum(bm.bm_roundoff_value) as roundoff, bm.bm_paymode  FROM tbl_tablebillmaster bm 
                                                                            left join tbl_logindetails ld on ld.ls_username= bm.bm_settlement_login 
                                                                            left join tbl_shift_details sd on sd.sd_open_staff=ld.ls_staffid where sd.sd_day='".$previous_date."' and  bm.bm_dayclosedate='".$previous_date."' and bm.bm_status='Closed' and sd.sd_open_machineid='".$previous_ip."'  group by bm.bm_paymode");
                                    $num_cash_di  = $database->mysqlNumRows($sql_cash_di);
                                    if($num_cash_di){ 
                                        while($result_cash_di  = $database->mysqlFetchArray($sql_cash_di)) 
                                            {   
                                                if($result_cash_di['bm_paymode']=='1'){
                                                    $cash_di      =$cash_di+$result_cash_di['cash'];
                                                }
                                                else if($result_cash_di['bm_paymode']=='2'){
                                                    $card_payments_di=$card_payments_di+$result_cash_di['card'];
                                                }
                                               
                                                else if($result_cash_di['bm_paymode']=='6'){
                                                    $credit_payments_di=$credit_payments_di+($result_cash_di['total']-$result_cash_di['cash']);
                                                }
                                                else if($result_cash_di['bm_paymode']=='7'){
                                                    $complimentary_payments_di=$complimentary_payments_di+$result_cash_di['total'];
                                                }
                                                 
                                            }
                                    }
                                    
                                     
                                    $sql_cash_ta  =  $database->mysqlQuery("select sum(tbm.tab_netamt) as total, tbm.tab_mode ,sum(tbm.tab_amountpaid-tbm.tab_amountbalace) as cash , sum(tbm.tab_transactionamount) as card ,sum(tbm.tab_chequebankamount) as cheque,sum(tbm.tab_upi_amount) as upi, sum(tbm.tab_couponamt) as coupon,sum(tbm.tab_discountvalue) as discount, sum(tbm.tab_roundoff_value) as roundoff,tbm.tab_paymode FROM tbl_takeaway_billmaster tbm 
                                                                        left join tbl_logindetails ld on ld.ls_username= tbm.tab_settlement_login 
                                                                        left join tbl_shift_details sd on sd.sd_open_staff=ld.ls_staffid where sd.sd_day='".$previous_date."' and tbm.tab_dayclosedate='".$previous_date."' and tbm.tab_status='Closed' and sd.sd_open_machineid='".$previous_ip."'  group  by tbm.tab_paymode");
                                    $num_cash_ta  = $database->mysqlNumRows($sql_cash_ta);
                                    if($num_cash_ta){ 
                                        while($result_cash_ta  = $database->mysqlFetchArray($sql_cash_ta)) 
                                            {   
                                                if($result_cash_ta['tab_paymode']=='1'){
                                                    $cash_di      =$cash_di+$result_cash_ta['cash'];
                                                }
                                                else if($result_cash_ta['tab_paymode']=='2'){
                                                    $card_payments_di=$card_payments_di+$result_cash_ta['card'];
                                                }
                                                else if($result_cash_ta['tab_paymode']=='6'){
                                                    $credit_payments_di=$credit_payments_di+($result_cash_ta['total']-$result_cash_ta['cash']);
                                                }
                                                else if($result_cash_ta['tab_paymode']=='7'){
                                                    $complimentary_payments_di=$complimentary_payments_di+$result_cash_ta['total'];
                                                }
                                               
                                               
                                                
                                            }
                                    }
                    
                                    
                                 $sql_shift_user  =  $database->mysqlQuery("select distinct(sd_open_staff), ld.ls_username FROM tbl_shift_details sd LEFT JOIN tbl_logindetails  ld on ld.ls_staffid= sd.sd_open_staff where sd.sd_day='".$previous_date."' and sd.sd_open_machineid='".$previous_ip."' $loginstaff order by sd_open ASC");
                                  $num_shift_user  = $database->mysqlNumRows($sql_shift_user);
                                    if($num_shift_user){ $i=0;
                                        while($result_shift_user  = $database->mysqlFetchArray($sql_shift_user)) 
                                            {
                                            
                                           
                                                  $sql_shift_view  = $database->mysqlQuery(" CREATE VIEW shiftcounter AS

                                                                        SELECT bm.bm_billno,ts.sd_open_machineid,ts.sd_day,ts.sd_open,ts.sd_open_balance,ts.sd_open_petty,ts.sd_close,ts.sd_close_balance,ts.sd_close_petty,
                                                                        st.ser_firstname,em.cm_ip_remarks as countername,bm_finaltotal as final,'DI' AS mode,
                                                                        (bm_amountpaid-bm_amountbalace) as cash, bm_transactionamount as card, bm.bm_paymode as payment_mode 
                                                                        FROM tbl_shift_details ts 
                                                                        left join tbl_staffmaster st on st.ser_staffid=ts.sd_open_staff 
                                                                        left join tbl_logindetails lg on lg.ls_staffid = st.ser_staffid
                                                                        left join tbl_expodine_machines em on em.cm_ip_address=ts.sd_open_machineid
                                                                        left join tbl_voucherpayment vp on vp.vp_system_ip=ts.sd_open_machineid
                                                                        left join tbl_tablebillmaster bm on bm.bm_settlement_login=lg.ls_username
                                                                        where ts.sd_day = '".$previous_date."' and bm.bm_dayclosedate = '".$previous_date."' and bm_finaltotal>0 and bm.bm_settlement_login='".$result_shift_user['ls_username']."' group by bm.bm_dayclosedate, bm.bm_settlement_login,bm.bm_billno 

                                                                        union all

                                                                        SELECT tbm.tab_billno,ts.sd_open_machineid,ts.sd_day,ts.sd_open,ts.sd_open_balance,ts.sd_open_petty,ts.sd_close,ts.sd_close_balance,ts.sd_close_petty,
                                                                        st.ser_firstname,em.cm_ip_remarks as countername,tab_netamt as final,tbm.tab_mode as mode, 
                                                                        (tab_amountpaid-tab_amountbalace) as cash, tab_transactionamount as card,tbm.tab_paymode as payment_mode
                                                                        FROM tbl_shift_details ts 
                                                                        left join tbl_staffmaster st on st.ser_staffid=ts.sd_open_staff 
                                                                        left join tbl_logindetails lg on lg.ls_staffid = st.ser_staffid
                                                                        left join tbl_expodine_machines em on em.cm_ip_address=ts.sd_open_machineid
                                                                        left join tbl_voucherpayment vp1 on vp1.vp_system_ip=ts.sd_open_machineid
                                                                        left join tbl_takeaway_billmaster tbm on tbm.tab_settlement_login=lg.ls_username
                                                                        where ts.sd_day = '".$previous_date."' and  tbm.tab_dayclosedate = '".$previous_date."'  and tab_netamt> 0 and tbm.tab_settlement_login='".$result_shift_user['ls_username']."' group by tbm.tab_dayclosedate, tbm.tab_settlement_login, tbm.tab_billno ");
                                    
                                                   
                                     $viewcash_di=0;$viewcard_payments_di=0;$viewcredit_payments_di=0;$viewcomplimentary_payments_di=0; 
                                     $viewcash_ta=0;$viewcard_payments_ta=0;$viewcredit_payments_ta=0;$viewcomplimentary_payments_ta=0;
                                     $viewcash_cs=0;$viewcard_payments_cs=0;$viewcredit_payments_cs=0;$viewcomplimentary_payments_cs=0;
                                     $viewcash_hd=0;$viewcard_payments_hd=0;$viewcredit_payments_hd=0;$viewcomplimentary_payments_hd=0;
                                     $final_di1=0;$final_ta1=0;$final_cs1=0;$final_hd1=0;
                                     
                                     
                                    $sql_shift_details  =  $database->mysqlQuery("select * from shiftcounter order by mode");                          
                                    $num_shift_details  = $database->mysqlNumRows($sql_shift_details);
                                    if($num_shift_details){
                                        
                                    $i=0;$user=''; $date_user='';
                                        
                                    $closetime='';$close_bal='';$close_pet='';
                                        while($result_shift_details  = $database->mysqlFetchArray($sql_shift_details)) 
                                            {   $i++;
                                            if($i=='1'){
                                                $user=$result_shift_details['ser_firstname'];
                                                
                                                $date_user=$result_shift_details['sd_day'];
                                             }
                                            else{
                                            $date_user=$date_user;
                                            $user=$user;
                                            
                                            }
                                                
                                                
                                                 if($result_shift_details['mode']=='DI'){
                                                     
                                                    $final_di1      =$final_di1+$result_shift_details['final'];
                                                    if($result_shift_details['payment_mode']=='1'){
                                                    $viewcash_di      =$viewcash_di+$result_shift_details['cash'];
                                                }
                                                else if($result_shift_details['payment_mode']=='2'){
                                                    $viewcard_payments_di=$viewcard_payments_di+$result_shift_details['card'];
                                                }
                                                
                                                else if($result_shift_details['payment_mode']=='6'){
                                                    $viewcredit_payments_di=$viewcredit_payments_di+($result_shift_details['final']-$result_shift_details['cash']);
                                                }
                                                else if($result_shift_details['payment_mode']=='7'){
                                                    $viewcomplimentary_payments_di=$viewcomplimentary_payments_di+$result_shift_details['final'];
                                                }
                                                
                                                    
                                                }
                                                 else if($result_shift_details['mode']=='TA'){
                                                     
                                                     $final_ta1      =$final_ta1+$result_shift_details['final'];
                                                if($result_shift_details['payment_mode']=='1'){
                                                    $viewcash_ta      =$viewcash_ta+$result_shift_details['cash'];
                                                }
                                                else if($result_shift_details['payment_mode']=='2'){
                                                    $viewcard_payments_ta=$viewcard_payments_ta+$result_shift_details['card'];
                                                }
                                               
                                                else if($result_shift_details['payment_mode']=='6'){
                                                    $viewcredit_payments_ta=$viewcredit_payments_ta+($result_shift_details['final']-$result_shift_details['cash']);
                                                }
                                                else if($result_shift_details['payment_mode']=='7'){
                                                    $viewcomplimentary_payments_ta=$viewcomplimentary_payments_ta+$result_shift_details['final'];
                                                }
                                                
                                                
                                                }
                                                 else if($result_shift_details['mode']=='HD'){
                                                     
                                                     $final_hd1      =$final_hd1+$result_shift_details['final'];
                                                if($result_shift_details['payment_mode']=='1'){
                                                    $viewcash_hd      =$viewcash_hd+$result_shift_details['cash'];
                                                }
                                                else if($result_shift_details['payment_mode']=='2'){
                                                    $viewcard_payments_hd=$viewcard_payments_hd+$result_shift_details['card'];
                                                }
                                                
                                                else if($result_shift_details['payment_mode']=='6'){
                                                    $viewcredit_payments_hd=$viewcredit_payments_hd+($result_shift_details['final']-$result_shift_details['cash']);
                                                }
                                                else if($result_shift_details['payment_mode']=='7'){
                                                    $viewcomplimentary_payments_hd=$viewcomplimentary_payments_hd+$result_shift_details['final'];
                                                }
                                               
                                                     
                                                     
                                                } 
                                                else if($result_shift_details['mode']=='CS'){
                                                     $final_cs1      =$final_cs1+$result_shift_details['final'];
                                                     if($result_shift_details['payment_mode']=='1'){
                                                    $viewcash_cs      =$viewcash_cs+$result_shift_details['cash'];
                                                }
                                                else if($result_shift_details['payment_mode']=='2'){
                                                    $viewcard_payments_cs=$viewcard_payments_cs+$result_shift_details['card'];
                                                }
                                               
                                                else if($result_shift_details['payment_mode']=='6'){
                                                    $viewcredit_payments_cs=$viewcredit_payments_cs+($result_shift_details['final']-$result_shift_details['cash']);
                                                }
                                                else if($result_shift_details['payment_mode']=='7'){
                                                    $viewcomplimentary_payments_cs=$viewcomplimentary_payments_cs+$result_shift_details['final'];
                                                }
                                                
                                               
                                                  
                                                     
                                                }
                                                
                                            
                                             } 
                                             
                     $totalcash_shift=str_replace(",","",($viewcash_di+$viewcash_ta+$viewcash_cs+$viewcash_hd));
                     $netcash1=(str_replace(",","",$shift_open_bal_new)+str_replace(",","",$totalcash_shift))-str_replace(",","",$total_shift_expense_all_cash);   
                     
                    $netcash=str_replace(",","",$netcash1);
                     
                // echo  $shiftclosing_balance.'-'.$netcash;         
                     
                  $tot_all_at_diff=str_replace(",","",$shiftclosing_balance)-$netcash;
            
                  $new_diff=str_replace(",","",number_format($tot_all_at_diff,$decimal));
                  
                  
                  if($new_diff<0){
                      $short=$new_diff;
                      $excess=0;
                  }else{
                     $excess=$new_diff; 
                     $short=0;
                  } 
                  
                $cash_all=0;  $card_all=0; $credit_all=0;
                $cash_all= ($viewcash_di+$viewcash_ta+$viewcash_cs+$viewcash_hd);
                
                $card_all=($viewcard_payments_di+$viewcard_payments_ta+$viewcard_payments_cs+$viewcard_payments_hd);
                
                $credit_all=($viewcredit_payments_di+$viewcredit_payments_ta+$viewcredit_payments_cs+$viewcredit_payments_hd);
                
                $comp_all= ($viewcomplimentary_payments_di+$viewcomplimentary_payments_ta+$viewcomplimentary_payments_cs+$viewcomplimentary_payments_hd);
               
                $income=$cash_all+$card_all+$credit_all+$comp_all;
                  
              
               
                          $data['Date']=$date_user;
                          $data['Shift Name']=$user;
                          $data['Cash ']=number_format(($viewcash_di+$viewcash_ta+$viewcash_cs+$viewcash_hd),$_SESSION['be_decimal']);
                          $data['Card']=number_format(($viewcard_payments_di+$viewcard_payments_ta+$viewcard_payments_cs+$viewcard_payments_hd),$_SESSION['be_decimal']);
                          $data['Credits']=number_format(($viewcredit_payments_di+$viewcredit_payments_ta+$viewcredit_payments_cs+$viewcredit_payments_hd),$_SESSION['be_decimal']);
                          $data["Complimentary"]=number_format(($viewcomplimentary_payments_di+$viewcomplimentary_payments_ta+$viewcomplimentary_payments_cs+$viewcomplimentary_payments_hd),$_SESSION['be_decimal']);         
                          $data["Excess Cash"]=number_format(($excess),$_SESSION['be_decimal']);   
                          $data["Short Cash"]=number_format(($short),$_SESSION['be_decimal']);   
                          $data["Income"]=number_format($income,$_SESSION['be_decimal']);   
                               
                 
                                for($s=0;$s<count(array_unique($tax_id));$s++){
                                $sql_taxvalue  =  $database->mysqlQuery("select dayclose,login, sum(taxtotal1) as taxtotal,taxid,label from
                        (select bm.bm_dayclosedate as dayclose, bm.bm_settlement_login as login, betm.bem_total_value as taxtotal1,betm.bem_taxid as taxid,betm.bem_label as label 
                        FROM tbl_tablebill_extra_tax_master betm left join tbl_tablebillmaster bm on  betm.bem_billno=bm.bm_billno where
                        bm.bm_dayclosedate = '".$previous_date."' and bm_finaltotal>0 and 
                         bm.bm_settlement_login='".$result_shift_user['ls_username']."' and betm.bem_taxid='".$tax_id[$s]."'           
                        union all
                        select tbm.tab_dayclosedate as dayclose ,tbm.tab_settlement_login as login, tketm.tbe_total_value  as taxtotal1,tketm.tbe_taxid as taxid, tketm.tbe_label as label
                        FROM tbl_takeaway_bill_extra_tax_master tketm   left join tbl_takeaway_billmaster tbm on  tketm.tbe_billno=tbm.tab_billno
                        where  tbm.tab_dayclosedate = '".$previous_date."'  and tbm.tab_netamt> 0 and 
                        tbm.tab_settlement_login='".$result_shift_user['ls_username']."' and tketm.tbe_taxid ='".$tax_id[$s]."')s  
                        group  by s.login,s.dayclose order by s.label asc");
                                
                         

                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    { if($result_taxvalue['taxtotal']==''){
                                        $result_taxvalue['taxtotal']=0;
                                    }
                                    $tax_value[$result_taxvalue['taxid']][]=$result_taxvalue['taxtotal'];
                                    
                                $data[$result_taxvalue['label']]= number_format($result_taxvalue['taxtotal'],$_SESSION['be_decimal']);    
                                    
                                } } 
                               else{ 
                                    $tax_value[$tax_id[$s]][]=0;
                                   $data[$result_taxvalue['label']]=0;
                                } }
                                
                                 array_push($data1,$data);
                                 unset($data);
                                
                                
                                       
                                 }
                                           $sqldrop  =  $database->mysqlQuery ("DROP VIEW shiftcounter");
                               }
                         }
                                   
                                
                   }
               }
     
                            
      }
    
                
     $filename = "Counter_Shift_Report" . $reporthead . ".xls";
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
 else if($_REQUEST['type']=="totalsales_consolidate_report_cr")
{	
      
     ///adsr////
     
      $string_combo='';
      
      $string="";
      $stringta="";
        
        
       $mode=$_REQUEST['department'];
               
	$string.=" bm.bm_status = 'Closed' and bm.bm_complimentary!='Y' ";
        
        $stringta.=" bm.tab_status = 'Closed' and bm.tab_complimentary!='Y' ";
      
        
        if($_REQUEST['loginstaffsel']!='' && $_REQUEST['loginstaffsel']!='null' && $mode!='HD')
        {   
            $stringta.=" and bm.tab_loginid='".$_REQUEST['loginstaffsel']."' ";
        }
    
        
        
        if(isset ($_REQUEST['floorz']))
	{
		
		$floorvalue=$_REQUEST['floorz'];
                if($floorvalue!="")
                {
		
		$string.="and bm.bm_floorid='".$floorvalue."'";
                }
	}
       
	
       if($_REQUEST['staff_hd']!='' && $_REQUEST['staff_hd']!='null' && $mode=='HD'){
           
           $hdstring= " left join tbl_staffmaster ts on ts.ser_staffid=bm.tab_assignedto ";
           
             $stringta.=" and bm.tab_assignedto='".$_REQUEST['staff_hd']."' ";
         }else {
             $hdstring= " left join tbl_staffmaster ts on ts.ser_staffid=bm.tab_assignedto ";
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
                    $st="Last 5 days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                     $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $st="Last 10 days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.=" and bm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $string_combo.= " cbd.cbd_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $st="Yesterday";
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
                    $st="Today";
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
        
	
            $data=array();
            $data1=array();
          
if($mode=="DI"){
            
            
             
	
                                    $tax_name=array();  $tax_new_id=array();
                                  $sql_login  =  $database->mysqlQuery("SELECT amc_name,amc_id FROM `tbl_extra_tax_master` where amc_active='Y' "); 
                                 //echo  " select distinct(betm.bem_taxid) as taxid,betm.bem_label as taxname  FROM tbl_tablebill_extra_tax_master betm left join tbl_extra_tax_master tm on tm.amc_id=betm.bem_taxid group by  amc_id order by tm.amc_id asc ";
                                  $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                       $tax_name[]=$result_login['amc_name'];
                                       
                                         $tax_new_id[]=$result_login['amc_id'];
                                     }} 
        
  $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $tax_value=array();
  $subtotal=0;
  $crd=0; $sum_non_tax2=0; $roundoff=0; $exempt=0;
  $sql_login  =  $database->mysqlQuery("select *,(bm.bm_amountpaid-bm.bm_amountbalace) as cash , (bm.bm_finaltotal-(bm.bm_amountpaid-bm.bm_amountbalace)) as credit from tbl_tablebillmaster bm  where $string order by bm.bm_billno ASC"); 
                              //    echo "select * from tbl_tablebillmaster bm  where $string order by bm.bm_dayclosedate,bm.bm_billtime ASC";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$q=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ $q++;
                       if($result_login['bm_paymode']!=7){
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['cash'];
                        
                        if($result_login['bm_paymode']=='6'){
                            
			$bal=$bal + $result_login['credit'];
                        
                        }
                        $crd=$crd + $result_login['bm_transactionamount'];
			$dsc=$dsc + $result_login['bm_discountvalue'];
			$subtotal=$subtotal + $result_login['bm_subtotal'];
                       
                        
                         $exempt=$exempt + $result_login['bm_tax_exempt'];
                        
			$roundoff=$roundoff + $result_login['bm_roundoff_value'];
                        
                          $data['Sl No']=$q;
                          $data['Date']=$database->convert_date($result_login['bm_dayclosedate']);
                          $data['Bill No ']=$result_login['bm_billno'];
                          $data['Table']=$result_login['bm_tableno'];
                          $data['Sub Total']=number_format($result_login['bm_subtotal'],$_SESSION['be_decimal']);
                          $data['Exempt']=number_format($result_login['bm_tax_exempt'],$_SESSION['be_decimal']);
                            
                            $sum_non_tax=0;    $sum_non_tax1=0;  $menu_chk='';
                        for($s=0;$s<count(array_unique($tax_new_id));$s++){
                           
                        $sql_taxvalue5  =  $database->mysqlQuery("select betm.bet_menuid  "
                                . "FROM tbl_tablebill_extra_tax_details betm where betm.bet_billno='".$result_login['bm_billno']."' "
                                . " and betm.bet_tax_id='".$tax_new_id[$s]."'  order by betm.bet_tax_id asc"); 
                        
                         $num_taxvalue5   = $database->mysqlNumRows($sql_taxvalue5);
                            if($num_taxvalue5){
                                    while($result_taxvalue5  = $database->mysqlFetchArray($sql_taxvalue5)) 
                                    { 
                                        
                                     
                                 $menu_chk.="'".$result_taxvalue5['bet_menuid']."',";
                                        
                                    $menu_chk1=substr($menu_chk, 0,-1) ; 
                                        
                         $sql_taxvalue6  =  $database->mysqlQuery("select sum(bd_amount) as tot  
                        FROM tbl_tablebilldetails betm where
                        betm.bd_billno='".$result_login['bm_billno']."' and betm.bd_menuid not in ($menu_chk1)  ");
                         
                         $num_taxvalue6   = $database->mysqlNumRows($sql_taxvalue6);
                            if($num_taxvalue6){
                                    while($result_taxvalue6  = $database->mysqlFetchArray($sql_taxvalue6)) 
                                    { 
                                        
                                          $sum_non_tax=$result_taxvalue6['tot'];
                                          
                                          $sum_non_tax1=$result_taxvalue6['tot'];
                                         
                                    }
                                    }   
                                          
                                }
                                    }  
                               
                       }
                      
                         $sum_non_tax2=$sum_non_tax2+$sum_non_tax1;
                         
                        
                         
                          if($sum_non_tax==0){ 
                               $data["Non Taxable"]=number_format($result_login['bm_subtotal'],$_SESSION['be_decimal']);   
                              }else{ 
                                $data["Non Taxable"]=number_format($sum_non_tax,$_SESSION['be_decimal']);   
                                } 
                              
                          
                                for($s=0;$s<count(array_unique($tax_new_id));$s++){
                                    
                                $sql_taxvalue  =  $database->mysqlQuery("select betm.bem_total_value,betm.bem_taxid,betm.bem_label  FROM tbl_tablebill_extra_tax_master betm where betm.bem_billno='".$result_login['bm_billno']."' and betm.bem_taxid='".$tax_new_id[$s]."'  order by betm.bem_label asc"); 
                            
                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    {
                                        
                                        if($result_taxvalue['bem_total_value']==''){
                                        $result_taxvalue['bem_total_value']=0;
                                          }
                                         
                                     for($i=0;$i<count(array_unique($tax_new_id));$i++){ 
       
                              $data[$tax_name[$i]]=number_format($result_taxvalue['bem_total_value'],$_SESSION['be_decimal']); 
                                      }       
                                          
                                    $tax_value[$result_taxvalue['bem_taxid']][]=$result_taxvalue['bem_total_value'];
             
                                } } 
                               else { 
                                  
                                 $data[$tax_name[$s]]=0;
                                 
                                } }   
                                     
                                   
                          $data["Discount"]=number_format($result_login['bm_discountvalue'],$_SESSION['be_decimal']);
                          $data['Roundoff']=number_format($result_login['bm_roundoff_value'],$_SESSION['be_decimal']);
                          $data["Final"]=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
                          $data["Card"]=number_format($result_login['bm_transactionamount'],$_SESSION['be_decimal']);
                          $data["Cash"]=number_format($result_login['cash'],$_SESSION['be_decimal']);
                           
                          if($result_login['bm_transactionamount']==0){
                            $data["Credit"]=number_format($result_login['credit'],$_SESSION['be_decimal']);  
                            
                            }else{ 
                                   
                                $data["Credit"]=0;
                            } 
                          
                          array_push($data1,$data);
                          unset($data);
                         
                             
                       }} }
                              

                          $data['Sl No']='';
                          $data['Date']='';
                          $data['Bill No ']='';
                          $data['Table']='';
                          $data['Sub Total']="";
                           $data['Exempt']="";
                           $data["Non Taxable"]="";    
                           for($o=1;$o<=(count(array_unique($tax_new_id))-$i);$o++){ 
                                      $data[$tax_new_id[$o]]="";
                               } 
                          $data["Discount"]="";
                          $data["Discount"]="";
                           $data['Roundoff']="";
                          $data["Final"]="";
                          $data["Card"]="";
                          $data["Cash"]="";
                          $data["Credit"]="";
                          array_push($data1,$data);
                          unset($data);
                         
   
            
            
                           
                           
                           
                          $data['Sl No']='Total';
                          $data['Date']='';
                          $data['Bill No']='';
                          $data['Table']='';
                          $data['Sub Total']=number_format($subtotal,$_SESSION['be_decimal']);
                          $data['Exempt']=number_format($exempt,$_SESSION['be_decimal']);
                           $data["Non Taxable"]=number_format($sum_non_tax2,$_SESSION['be_decimal']);    
                           
     for($i=0;$i<count(array_unique($tax_new_id));$i++){ 
       
          $data[$tax_name[$i]]=number_format(array_sum($tax_value[$tax_new_id[$i]]),$_SESSION['be_decimal']);
   } 
        for($o=1;$o<=(count(array_unique($tax_new_id))-$i);$o++){ 
  
        $data[$tax_new_id[$o]]=0;
    } 
   
                         $data["Discount"]=number_format($result_login['bm_discountvalue'],$_SESSION['be_decimal']);
                                   
                          $data["Discount"]=number_format($dsc,$_SESSION['be_decimal']);
                               $data['Roundoff']=number_format($roundoff,$_SESSION['be_decimal']);
                          $data["Final"]=number_format($final,$_SESSION['be_decimal']);
                          $data["Card"]=number_format($crd,$_SESSION['be_decimal']);
                          $data["Cash"]=number_format($paid,$_SESSION['be_decimal']);
                           
                          $data["Credit"]=number_format($bal,$_SESSION['be_decimal']);
                               
                          array_push($data1,$data);
                          unset($data);
                         
                           
     $filename = "Consolidated Report DI-" . $reporthead . ".xls";
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
  
 else if($mode=="TA" || $mode=="CS" || $mode=="HD"){
    
                            $tax_name=array();
                            $tax_id=array();
                                  $sql_login  =  $database->mysqlQuery("SELECT amc_name,amc_id FROM `tbl_extra_tax_master` where amc_active='Y'"); 
                               // echo " select  distinct(tketm.tbe_taxid) as taxid,tketm.tbe_label as taxname  FROM tbl_takeaway_bill_extra_tax_master tketm left join  tbl_extra_tax_master tm on tm.amc_id=tketm.tbe_taxid group by  amc_id order by tm.amc_id asc ";
                                  $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                       $tax_name[]=$result_login['amc_name'];
                                       $tax_id[]=$result_login['amc_id'];
                                     }} 
                                   
                                  

 $final=0;
  $paid=0;
  $bal=0; 
  $dsc=0;
  $subtotal=0;
  $tax_value=array(); $crd=0; $sum_non_tax2=0; $exempt=0;  $roundoff=0;
  $sql_login  =  $database->mysqlQuery("select *,(bm.tab_amountpaid-bm.tab_amountbalace) as cash , (bm.tab_netamt-(bm.tab_amountpaid-bm.tab_amountbalace)) as credit from tbl_takeaway_billmaster bm $hdstring  where $stringta and tab_mode='$mode' order by bm.tab_billno ASC ");
                                //  echo "select * from tbl_takeaway_billmaster bm $hdstring  where $stringta and tab_mode='$mode'  ";
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        $subtotal=$subtotal + $result_login['tab_subtotal'];
                        $dsc=$dsc + $result_login['tab_discountvalue'];
			$final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['cash'];
                        
                        if($result_login['tab_paymode']=='6'){
                            
			$bal=$bal + $result_login['credit'];
                        
                        }
                        $crd=$crd + $result_login['tab_transactionamount'];
                      
                         $exempt=$exempt + $result_login['tab_tax_exempt'];
                        
			$roundoff=$roundoff + $result_login['tab_roundoff_value'];  
                        
                        
                        $data['Sl No']=$q;
                          $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
                          $data['Bill No ']=$result_login['tab_billno'];
                          
                         
                          
                          if($mode!='HD'){ 
                                 $data['Taken']= $result_login['tab_loginid'];
                                  } else{
                            $data['Taken']= $result_login['ser_firstname'];
                               } 
                               
                               
                          $data['Sub Total']=number_format($result_login['tab_subtotal'],$_SESSION['be_decimal']);
                          $data['Exempt']=number_format($result_login['tab_tax_exempt'],$_SESSION['be_decimal']);   
                           
                          
                          
                              $sum_non_tax=0;    $sum_non_tax1=0;      $menu_chk='';
                        for($s=0;$s<count(array_unique($tax_id));$s++){
                           
                                 
                                
                                
                        $sql_taxvalue5  =  $database->mysqlQuery("select betm.tbet_menuid  "
                                . "FROM tbl_takeaway_bill_extra_tax_details betm where betm.tbet_billno='".$result_login['tab_billno']."' "
                                . " and betm.tbet_tax_id='".$tax_id[$s]."'  order by betm.tbet_tax_id asc"); 
                        
                         $num_taxvalue5   = $database->mysqlNumRows($sql_taxvalue5);
                            if($num_taxvalue5){
                                    while($result_taxvalue5  = $database->mysqlFetchArray($sql_taxvalue5)) 
                                    { 
                                        
                                    $menu_chk.="'".$result_taxvalue5['tbet_menuid']."',";
                                        
                                    $menu_chk1=substr($menu_chk, 0,-1) ;   
                                
                                        
                         $sql_taxvalue6  =  $database->mysqlQuery("select sum(tab_amount) as tot  
                        FROM tbl_takeaway_billdetails betm where
                        betm.tab_billno='".$result_login['tab_billno']."' and betm.tab_menuid not in ($menu_chk1)  ");
                         
                         $num_taxvalue6   = $database->mysqlNumRows($sql_taxvalue6);
                            if($num_taxvalue6){
                                    while($result_taxvalue6  = $database->mysqlFetchArray($sql_taxvalue6)) 
                                    { 
                                        
                                          $sum_non_tax=$result_taxvalue6['tot'];
                                          
                                          $sum_non_tax1=$result_taxvalue6['tot'];
                                         
                                    }
                                    }   
                                          
                                }
                                    }  
                               
                       }
                      
                         $sum_non_tax2=$sum_non_tax2+$sum_non_tax1;
                       
                         
                        if($sum_non_tax==0){ 
                               $data["Non Taxable"]=number_format($result_login['bm_subtotal'],$_SESSION['be_decimal']);   
                              }else{ 
                                $data["Non Taxable"]=number_format($sum_non_tax,$_SESSION['be_decimal']);   
                                } 
                              
                              
                          
                          for($s=0;$s<count(array_unique($tax_id));$s++){
                                $sql_taxvalue  =  $database->mysqlQuery("select  tketm.tbe_total_value,tketm.tbe_taxid, tketm.tbe_label FROM tbl_takeaway_bill_extra_tax_master tketm  where tketm.tbe_billno='".$result_login['tab_billno']."' and tketm.tbe_taxid ='".$tax_id[$s]."' order by tketm.tbe_taxid asc"); 
                              
                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    { 
                                        
                                        
                                        
                                        if($result_taxvalue['tbe_total_value']==''){
                                          $result_taxvalue['tbe_total_value']=0;
                                        }
                                    
                                    
                                 //for($i=0;$i<count(array_unique($tax_id));$i++){ 
       
                              $data[$tax_name[$s]]=number_format($result_taxvalue['tbe_total_value'],$_SESSION['be_decimal']); 
                                    
                                    //  }     
                                      
                              $tax_value[$result_taxvalue['tbe_taxid']][]=$result_taxvalue['tbe_total_value'];
                                } } 
                               else { 
                                    $data[$tax_name[$s]]=0;
                                    $tax_value[$tax_id[$s]][]=0;
                                    
                                } }
                            
                                   
                          $data["Discount"]=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal']);
                           $data['Roundoff']=number_format($result_login['tab_roundoff_value'],$_SESSION['be_decimal']);  
                          $data["Final"]=number_format($result_login['tab_netamt'],$_SESSION['be_decimal']);
                          $data["Card"]=number_format($result_login['tab_transactionamount'],$_SESSION['be_decimal']);
                           $data["Cash"]=number_format($result_login['cash'],$_SESSION['be_decimal']);
                           
                          if($result_login['tab_transactionamount']==0){
                            $data["Credit"]=number_format($result_login['credit'],$_SESSION['be_decimal']);    
                               }else{ 
                               
                                $data["Credit"]=0;
                               
                              } 
                          
                          array_push($data1,$data);
                          unset($data);
                        
                        
                        
	                        }
                       
                              
                             } 
                              
                           $data['Sl No']='';
                          $data['Date']='';
                          $data['Bill No ']='';
                          $data['Taken']='';
                          $data['Sub Total']="";
                           $data['Exempt']="";  
                           $data['Non Taxable']="";  
                           for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){ 
                                      $data[$tax_id[$o]]="";
                               } 
                          $data["Discount"]="";
                          $data["Discount"]="";
                           $data['Roundoff']="";
                          $data["Final"]="";
                          $data["Card"]="";
                          $data["Cash"]="";
                          $data["Credit"]="";
                          array_push($data1,$data);
                          unset($data);
                          
                          
                          
                          
                          
                           
                          $data['Sl No']='Total';
                          $data['Date']='';
                          $data['Bill No']='';
                          $data['Table']='';
                          $data['Sub Total']=number_format($subtotal,$_SESSION['be_decimal']);
                           $data['Exempt']=number_format($exempt,$_SESSION['be_decimal']);  
                          $data['Non Taxable']=number_format($sum_non_tax2,$_SESSION['be_decimal']);   
                           
     for($i=0;$i<count(array_unique($tax_id));$i++){ 
       
          $data[$tax_id[$i]]=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal']);
    } 
        for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){ 
  
        $data[$tax_id[$o]]=0;
    } 
   
                         
                                   
                          $data["Discount"]=number_format($dsc,$_SESSION['be_decimal']);
                           $data['Roundoff']=number_format($roundoff,$_SESSION['be_decimal']);  
                          $data["Final"]=number_format($final,$_SESSION['be_decimal']);
                          $data["Card"]=number_format($crd,$_SESSION['be_decimal']);
                          $data["Cash"]=number_format($paid,$_SESSION['be_decimal']);
                           
                          $data["Credit"]=number_format($bal,$_SESSION['be_decimal']);
                               
                          array_push($data1,$data);
                          unset($data);
                         
                           
     $filename = "Consolidated Report TA HD CS-" . $reporthead . ".xls";
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
                                  
                        
                          
  }else{
           
           
    if($_REQUEST['modeofview']=='summary'){
        
        /////adsr summary/////
   
                               $tax_name=array();
                               $tax_id=array();
                                $sql_login  =  $database->mysqlQuery(" SELECT amc_name,amc_id FROM `tbl_extra_tax_master` where amc_active='Y'  "); 
                                     $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                       $tax_name[]=$result_login['amc_name'];
                                       $tax_id[]=$result_login['amc_id'];
                                     }} 
                                     
                                    

  $final=0;
  $paid=0;
  $bal=0; 
  $dsc=0;
  $subtotal=0;
  $tax_value=array(); $crd=0;  $sum_non_tax2=0; $tax_new=0; $tot_exempt=0; $tot_roff=0;
  
  $sql_login  =  $database->mysqlQuery("select tm,paymode,card,cash,credit,billno, taxamt,uae_subtotal,exempt,rounoff,
         subtotal,discount,final ,paid, balance,dayclosedate from 
        (select bm_roundoff_value as rounoff,bm_tax_exempt as exempt,bm_paymode as paymode,bm_billtime as tm,bm_transactionamount as card,(bm_amountpaid-bm_amountbalace) as cash ,
        (bm_finaltotal-(bm_amountpaid-bm_amountbalace)) as credit  ,bm_dayclosedate as dayclose,bm_billno as billno, 
         bm_subtotal as  subtotal,  bm_discountvalue as discount,bm_finaltotal as final, (bm_total - bm_subtotal_final ) as taxamt ,
        bm_amountpaid as paid,   bm_amountbalace as balance ,bm.bm_dayclosedate as dayclosedate,bm_taxable_amount as uae_subtotal
        from tbl_tablebillmaster bm  
        where  $string  
        union all
        select tab_roundoff_value as rounoff,tab_tax_exempt as exempt,tab_paymode as paymode,tab_time as tm,tab_transactionamount as card ,(tab_amountpaid-tab_amountbalace) as cash , 
        (tab_netamt-(tab_amountpaid-tab_amountbalace)) as credit ,tab_dayclosedate as dayclose ,  tab_billno as billno, 
         tab_subtotal as subtotal,tab_discountvalue as discount,tab_netamt as final,  (tab_total - tab_subtotal_final) as taxamt ,
         tab_amountpaid as paid,   tab_amountbalace as  balance,bm.tab_dayclosedate as dayclosedate ,tab_taxable_amount as uae_subtotal
        from tbl_takeaway_billmaster
        bm where  $stringta  )s
       group by billno,dayclosedate order by dayclosedate ,tm ASC ");
                               
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        
                        
                         if($_SESSION['uae_tax_enable']=='Y'){ 
                              $subtotal=$subtotal + $result_login['uae_subtotal'];
                         }else{
                             $subtotal=$subtotal + $result_login['subtotal'];
                         }
                        
              $tot_exempt=$tot_exempt+$result_login['exempt'];   
              $tot_roff=$tot_roff+$result_login['rounoff'];   
              
              
                        $dsc=$dsc + $result_login['discount'];
			$final=$final + $result_login['final'];
			$paid=$paid +$result_login['cash'];
                        
                        if($result_login['paymode']=='6'){
			$bal=$bal + $result_login['credit'];
                        }
                        
                        $crd=$crd + $result_login['card'];
                     
                        $tax_new=$tax_new+$result_login['taxamt'];
                        
                          $data['Sl No']=$i;
                          $data['Date']=$result_login['dayclosedate'];
                          $data['Time']=$result_login['tm']; 
                          $data['Bill No ']=$result_login['billno'];
                         
                          if($_SESSION['uae_tax_enable']=='Y'){ 
                             $data['Sub Total']=number_format($result_login['uae_subtotal'],$_SESSION['be_decimal']);  
                          }else{
                          $data['Sub Total']=number_format($result_login['subtotal'],$_SESSION['be_decimal']);
                          }
                          
                           $data['Exempt']=number_format($result_login['exempt'],$_SESSION['be_decimal']);
                          
                          
                           if($_REQUEST['non_tax']=='true'){
                               
                       $sum_non_tax=0;    $sum_non_tax1=0;    $menu_chk='';  
                       for($s=0;$s<count(array_unique($tax_id));$s++){
                           
                                  
                        $sql_taxvalue5  =  $database->mysqlQuery("select menuid from
                        (select betm.bet_menuid as menuid
                        FROM tbl_tablebill_extra_tax_details betm where
                        betm.bet_billno='".$result_login['billno']."' and betm.bet_tax_id='".$tax_id[$s]."'           
                        union all
                        select tketm.tbet_menuid as menuid
                        FROM tbl_takeaway_bill_extra_tax_details tketm  
                        where  tketm.tbet_billno='".$result_login['billno']."' and tketm.tbet_tax_id ='".$tax_id[$s]."')s "); 
                        
                         $num_taxvalue5   = $database->mysqlNumRows($sql_taxvalue5);
                            if($num_taxvalue5){
                                    while($result_taxvalue5  = $database->mysqlFetchArray($sql_taxvalue5)) 
                                    { 
                                        
                                         $menu_chk.="'".$result_taxvalue5['menuid']."',";
                                        
                                    $menu_chk1=substr($menu_chk, 0,-1) ;   
                                
                                  }
                                    }  
                               
                       }
                       
                         $sql_taxvalue6  =  $database->mysqlQuery("select tot from 
                        (select sum(bd_amount) as tot  
                        FROM tbl_tablebilldetails betm where
                        betm.bd_billno='".$result_login['billno']."' and betm.bd_menuid not in ($menu_chk1)          
                        union all
                        select sum(tab_amount) as tot 
                        FROM tbl_takeaway_billdetails tketm  
                        where  tketm.tab_billno='".$result_login['billno']."' and tketm.tab_menuid not in($menu_chk1) )s ");
                         
                         $num_taxvalue6   = $database->mysqlNumRows($sql_taxvalue6);
                            if($num_taxvalue6){
                                    while($result_taxvalue6  = $database->mysqlFetchArray($sql_taxvalue6)) 
                                    { 
                                         if($result_taxvalue6['tot']>0 && $result_taxvalue6['tot']!=''){
                                          $sum_non_tax=$result_taxvalue6['tot'];
                                          
                                          $sum_non_tax1=$result_taxvalue6['tot'];
                                         }
                                    }
                                    }   
                                          
                                
                      
                         $sum_non_tax2=$sum_non_tax2+$sum_non_tax1;
                         
                        if($sum_non_tax==0){ 
                               $data["Non Taxable"]=number_format(0,$_SESSION['be_decimal']);   
                              }else{ 
                                $data["Non Taxable"]=number_format($sum_non_tax,$_SESSION['be_decimal']);   
                                } 
                              
                           } 
                          
                           
                            if($_REQUEST['tax_adsr']=='true'){
                                for($s=0;$s<count(array_unique($tax_id));$s++){
                                $sql_taxvalue  =  $database->mysqlQuery("select taxtotal,taxid,label from
                        (select betm.bem_total_value as taxtotal,betm.bem_taxid as taxid,betm.bem_label as label 
                        FROM tbl_tablebill_extra_tax_master betm where
                        betm.bem_billno='".$result_login['billno']."' and betm.bem_taxid='".$tax_id[$s]."'           
                        union all
                        select tketm.tbe_total_value  as taxtotal,tketm.tbe_taxid as taxid, tketm.tbe_label as label
                        FROM tbl_takeaway_bill_extra_tax_master tketm  
                        where  tketm.tbe_billno='".$result_login['billno']."' and tketm.tbe_taxid ='".$tax_id[$s]."')s  
                        order by s.label asc"); 
                              
                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    { if($result_taxvalue['taxtotal']==''){
                                        $result_taxvalue['taxtotal']=0;
                                    }
                                    $tax_value[$result_taxvalue['taxid']][]=$result_taxvalue['taxtotal'];
                               
                            $data[$tax_name[$s]]=number_format($result_taxvalue['taxtotal'],$_SESSION['be_decimal']);
                          
                                } } 
                               else { 
                                   $tax_value[$tax_id[$s]][]=0;
                            
                                 $data[$tax_name[$s]]=0;
                               
                               } }
                            }else{
                                 $data["Tax"]=number_format($result_login['taxamt'],$_SESSION['be_decimal']);
                            }
                            
                            
                          $data["Discount"]=number_format($result_login['discount'],$_SESSION['be_decimal']);
                          $data['Roundoff']=number_format($result_login['rounoff'],$_SESSION['be_decimal']);
                          $data["Final"]=number_format($result_login['final'],$_SESSION['be_decimal']);
                          $data["Card"]=number_format($result_login['card'],$_SESSION['be_decimal']);
                          $data["Cash"]=number_format($result_login['cash'],$_SESSION['be_decimal']);
                          
                            if($result_login['card']==0){
                               $data["Credit"] =number_format($result_login['credit'],$_SESSION['be_decimal']);
                               }else{ 
                               
                             $data["Credit"]=0;
                               
                                } 
                          
                         
                          array_push($data1,$data);
                          unset($data);
                             
                              
                               } }
                              
                               
                               
                               
                          $data['Sl No']='';
                          $data['Date']='';
                          $data['Time']='';
                          $data['Bill No']='';
                          
                           $data['Sub Total']="";
                           $data['Exempt']="";
                           if($_REQUEST['non_tax']=='true'){
                           $data['Non Taxable']=""; 
                           }
                           
                            if($_REQUEST['tax_adsr']=='true'){
                           for($o=1;$o<=(count(array_unique($tax_id)));$o++){ 
                                      $data[$tax_id[$o]]="";
                               } 
                            }else{
                                  $data["Tax"]="";
                            }
                            
                          $data["Discount"]="";
                          $data["Discount"]="";
                          $data['Roundoff']="";
                          $data["Final"]="";
                          $data["Card"]="";
                          $data["Cash"]="";
                          $data["Credit"]="";
                          array_push($data1,$data);
                          unset($data);
                          
                          
                          
                          
                          
                          
                           $data['Sl No']='Total';
                           $data['Date']='';
                            $data['Time']='';
                           $data['Bill No']='';
                         
                           $data['Sub Total']=$subtotal;
                           $data['Exempt']=$tot_exempt;
                           if($_REQUEST['non_tax']=='true'){
                            $data['Non Taxable']=number_format($sum_non_tax2,$_SESSION['be_decimal']); 
                           }
                           
    if($_REQUEST['tax_adsr']=='true'){
        
        for($i=0;$i<count(array_unique($tax_id));$i++){ 
         $data[$tax_id[$i]]=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal']);
  
       }
       
        for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){
            $data[$tax_id[$o]]=0;
        } 
    
   }else{
           $data["Tax"]=number_format($tax_new,$_SESSION['be_decimal']); 
   }
   
                          
                                   
                          $data["Discount"]=number_format($dsc,$_SESSION['be_decimal']);
                          $data["Roundoff"]=number_format($tot_roff,$_SESSION['be_decimal']);
                          
                          $data["Final"]=number_format($final,$_SESSION['be_decimal']);
                          $data["Card"]=number_format($crd,$_SESSION['be_decimal']);
                          $data["Cash"]=number_format($paid,$_SESSION['be_decimal']);
                           
                          $data["Credit"]=number_format($bal,$_SESSION['be_decimal']);
                               
                          array_push($data1,$data);
                          unset($data);
                          
                          
                          
                          
                          
     $filename = "Adsr_Consolidated_Report_".$reporthead.".xls";
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
         
             }else if($_REQUEST['modeofview']=='detailed'){
                           
                       ?>
 
                              
                              <?php
                            $bm_name=array();
                            $bm_id=array();
                                  $sql_login  =  $database->mysqlQuery(" select bm_id,bm_name from tbl_bankmaster order by bm_id asc   "); 
                                     $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                       $bm_name[]=$result_login['bm_name'];
                                       $bm_id[]=$result_login['bm_id'];
                                     }} 
                                    
                                    

  $final=0;
  $paid=0;
  $bal=0; 
  $dsc=0;
  $subtotal=0;
  $tax_value=array();$crd=0;
  $sql_login  =  $database->mysqlQuery(" select sum(s.card) as card1,sum(s.cash) as cash1,sum(s.credit) as credit1, sum(s.final) as final1,s.dayclose from 
        (select sum(bm_transactionamount) as card, sum((bm_amountpaid-bm_amountbalace)) as cash , 
        sum((bm_finaltotal-(bm_amountpaid-bm_amountbalace))) as credit ,bm_dayclosedate as dayclose, 
        sum(bm_finaltotal) as final from tbl_tablebillmaster bm where $string
        group by bm_dayclosedate union all select sum(tab_transactionamount) as card , 
        sum((tab_amountpaid-tab_amountbalace)) as cash , sum((tab_netamt-(tab_amountpaid-tab_amountbalace))) as credit ,
        tab_dayclosedate as dayclose , sum(tab_netamt) as final from tbl_takeaway_billmaster bm where $stringta group by tab_dayclosedate )s group by s.dayclose
 ");
   

  
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        
                      
			$final=$final + $result_login['final1'];
			$paid=$paid +$result_login['cash1'];
                        
                        
			$bal=$bal + $result_login['credit1'];
                        
                        
                        $crd=$crd + $result_login['card1'];
                        
                        
                        
                       
                          $data['Date']=$result_login['dayclose'];
                          $data['Card']=number_format($result_login['card1'],$_SESSION['be_decimal']);
                          
                          
                                for($sw=0;$sw<count(array_unique($bm_id));$sw++){
                                    
//                                $sql_taxvalue  =  $database->mysqlQuery("select  x.bid,x.bnk,sum(x.tot) as tot1,x.day from ( 
//                                                    select   bm.bm_transcbank as bid, bm.bm_dayclosedate as day,b.bm_name as bnk,sum(bm.bm_transactionamount) as tot  
//                                                    FROM tbl_tablebillmaster bm left join tbl_paymentmode on bm.bm_paymode=tbl_paymentmode.pym_id 
//                                                    left join tbl_bankmaster b on  b.bm_id = bm.bm_transcbank  where  tbl_paymentmode.pym_code='credit'
//                                                    and  bm.bm_status='Closed' AND bm.bm_complimentary!='Y' AND bm.bm_transcbank='".$bm_id[$sw]."' and 
//                                                    bm.bm_dayclosedate ='".$result_login['dayclose']."'  group by bm.bm_dayclosedate  union all
//                                                    select bm.tab_transcbank as bid,   bm.tab_dayclosedate as day,b.bm_name as bnk, sum(bm.tab_transactionamount)
//                                                    as tot  FROM tbl_takeaway_billmaster bm left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id 
//                                                    left join tbl_bankmaster b  on  b.bm_id = bm.tab_transcbank where tbl_paymentmode.pym_code='credit' 
//                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND bm.tab_transcbank='".$bm_id[$sw]."'
//                                                    and bm.tab_dayclosedate ='".$result_login['dayclose']."' group by bm.tab_dayclosedate
//                                                    )x  group by x.day"); 
                              
//                             
                             $sql_taxvalue  =  $database->mysqlQuery("select x.bid,x.bnk,sum(x.tot) as tot1,x.day from ( 
                                                    select  bc.mc_to_bank as bid, bm.bm_dayclosedate as day,b.bm_name as bnk,sum(bc.mc_cardamount) as tot  FROM tbl_tablebillmaster bm
                                                    left join tbl_paymentmode on bm.bm_paymode=tbl_paymentmode.pym_id  
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.bm_billno
                                                    left join tbl_bankmaster b on  b.bm_id = bc.mc_to_bank 
                                                    where  tbl_paymentmode.pym_code='credit' and  bm.bm_status='Closed' and bm.bm_dayclosedate ='".$result_login['dayclose']."'
                                                    AND bm.bm_complimentary!='Y' AND  bc.mc_to_bank ='".$bm_id[$sw]."' group by bm.bm_dayclosedate,bc.mc_to_bank
                                                    union all
                                                    select bc.mc_to_bank as bid, bm.tab_dayclosedate as day,b.bm_name as bnk, sum(bc.mc_cardamount) as tot  FROM 
                                                    tbl_takeaway_billmaster bm 
                                                    left join tbl_paymentmode on bm.tab_paymode=tbl_paymentmode.pym_id 
                                                    left join tbl_bill_card_payments bc on bc.mc_billno=bm.tab_billno
                                                    left join tbl_bankmaster b  on  b.bm_id = bc.mc_to_bank 
                                                    where tbl_paymentmode.pym_code='credit'  and bm.tab_dayclosedate ='".$result_login['dayclose']."'
                                                    and bm.tab_status='Closed' AND bm.tab_complimentary!='Y' AND  bc.mc_to_bank='".$bm_id[$sw]."' group by bm.tab_dayclosedate,bc.mc_to_bank
                                                    )x where x.bnk !=''  group by x.day,x.bid "); 
                                
                                
                                
                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    { 
                                    $tax_value[$result_taxvalue['bid']][]=$result_taxvalue['tot1'];
                                    
                                    if($result_taxvalue['tot1']>0){
                               
                                      $data[$bm_name[$sw]]=number_format($result_taxvalue['tot1'],$_SESSION['be_decimal']);

                                   } 
                                } } 
                               else { 
                                    $data[$bm_name[$sw]]=0;
                                   $tax_value[$bm_id[$sw]][]=0;
                                
                               } } 
                               
                               $data["Cash"]=number_format($result_login['cash1'],$_SESSION['be_decimal']);
                          $data["Credit"]=number_format($result_login['credit1']-$result_login['card1'],$_SESSION['be_decimal']);
                          $data["Final"]=number_format($result_login['final1'],$_SESSION['be_decimal']);
                          array_push($data1,$data);
                          unset($data);
                              
                              
                              } }
                              
                              
                              
                            
                          $data['Date']='Total';
                          $data['Card ']=number_format($crd,$_SESSION['be_decimal']);
                        
   for($i=0;$i<count(array_unique($bm_id));$i++){ 
         $data[$bm_id[$i]]=number_format(array_sum($tax_value[$bm_id[$i]]),$_SESSION['be_decimal']);
  
     }
                         
                          $data["Final"]=number_format($paid,$_SESSION['be_decimal']);
                          $data["Card"]=number_format($bal-$crd,$_SESSION['be_decimal']);
                          $data["Cash"]=number_format($final,$_SESSION['be_decimal']);
                           
                          array_push($data1,$data);
                          unset($data);
                          
                          
                          
                          
                          
               $filename = "Consolidated Report-" . $reporthead . ".xls";
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
          
          
   }else{
                 
       if($_REQUEST['hsn_code']=='false'){
                 
                            $tax_name=array();
                            $tax_id=array();
                                  $sql_login  =  $database->mysqlQuery(" SELECT amc_name,amc_id FROM `tbl_extra_tax_master` "
                                          . " where amc_active='Y'  and amc_item_tax='Y'    "); 
                                     $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                       $tax_name[]=$result_login['amc_name'];
                                       $tax_id[]=$result_login['amc_id'];
                                     }} 
                                  
                                    

  $final=0;
  $subtotal=0;
  $tax_value=array();$crd=0;$weight='';
  
  $sql_login  =  $database->mysqlQuery(" select item_price,mr_menuid,mr_menuname,tm,paymode,card,cash,credit,billno, subtotal,final,paid,
      balance,dayclosedate,daytime ,sum(item_price) as sub from 
(select bd_amount as item_price, mr_menuid,mr_menuname, bm_paymode as paymode,bm_billtime as tm,bm_transactionamount as card,
(bm_amountpaid-bm_amountbalace) as cash , (bm_finaltotal-(bm_amountpaid-bm_amountbalace)) as credit  ,bm_dayclosedate as dayclose,
bm_billno as billno,  bm_subtotal as  subtotal, bm_finaltotal as final, bm_amountpaid as paid,   bm_amountbalace as balance ,
bm.bm_dayclosedate as dayclosedate,bm.bm_billtime as daytime 
from tbl_tablebillmaster bm  left join tbl_tablebilldetails tbd on tbd.bd_billno=bm.bm_billno left join tbl_menumaster tm on
tm.mr_menuid=tbd.bd_menuid
where  $string 
union all
select tab_amount as item_price, mr_menuid,mr_menuname,tab_paymode as paymode,tab_time as tm,tab_transactionamount as card ,
(tab_amountpaid-tab_amountbalace) as cash , (tab_netamt-(tab_amountpaid-tab_amountbalace)) as credit ,tab_dayclosedate as dayclose ,
tbd.tab_billno as billno,  tab_subtotal as subtotal,tab_netamt as final,    tab_amountpaid as paid,   tab_amountbalace as  balance,
bm.tab_dayclosedate as dayclosedate,bm.tab_time as daytime 
from tbl_takeaway_billmaster
bm  left join tbl_takeaway_billdetails tbd on tbd.tab_billno=bm.tab_billno left join tbl_menumaster tm on tm.mr_menuid=tbd.tab_menuid
where  $stringta )s
group by billno,dayclosedate,mr_menuname order by dayclosedate,tm ASC ");
                               
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  
                      
                         $i++;
                        
                   if($result_login['weight']>0){
                    $weight=  '['.$result_login['weight'].']'; 
                    }else{
                     $weight='';   
                    }
                         
                         
                         
                        $subtotal=$subtotal + $result_login['sub'];
                             
                         $data["Date"]=$database->convert_date($result_login['dayclosedate']);
                         $data["Bill No"]=$result_login['billno'];
                         $data["Item"]=$result_login['mr_menuname'].$weight;
                         $data["Subtotal"]=number_format($result_login['sub'],$_SESSION['be_decimal']);
                              
                                $final1=0;
                                for($s=0;$s<count(array_unique($tax_id));$s++){
                                    
                        $sql_taxvalue  =  $database->mysqlQuery("select taxtotal,taxid,sum(taxtotal) as tot,mid from
                        (select betm.bet_tax_amount as taxtotal,betm.bet_tax_id as taxid,betm.bet_menuid as mid
                        FROM tbl_tablebill_extra_tax_details betm where
                        betm.bet_billno='".$result_login['billno']."' and betm.bet_menuid='".$result_login['mr_menuid']."' "
                                . "and betm.bet_tax_id='".$tax_id[$s]."'           
                        union all
                        select tketm.tbet_tax_amount  as taxtotal,tketm.tbet_tax_id as taxid,tketm.tbet_menuid as mid
                        FROM tbl_takeaway_bill_extra_tax_details tketm  
                        where  tketm.tbet_billno='".$result_login['billno']."' and tketm.tbet_menuid='".$result_login['mr_menuid']."' "
                        . "and tketm.tbet_tax_id ='".$tax_id[$s]."')s  
                          group by mid order by s.taxid asc"); 
                              
                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    { if($result_taxvalue['tot']==''){
                                        $result_taxvalue['tot']=0;
                                    }
                                    $tax_value[$result_taxvalue['taxid']][]=$result_taxvalue['tot'];
                                 
                                    
                           $data[$tax_name[$s]]=$result_taxvalue['tot'];

                                    $final1=$final1+$result_taxvalue['tot'];
                            
                                } } 
                               else { 
                                   $tax_value[$tax_id[$s]][]=0;
                               
                                 $data[$tax_name[$s]]=0;
                                
                               } }
                               
                                $data['Total']=number_format($result_login['sub']+$final1,$_SESSION['be_decimal']);
                                
                               array_push($data1,$data);
                               unset($data);
                               
                                } } 
                                
                         
                                
                                
         $data['Date']='Total';                        
         $data['Bill No']='';                         
         $data['Item']='';                         
                               
    $data['Subotal']=number_format($subtotal,$_SESSION['be_decimal']);
   
    for($i=0;$i<count(array_unique($tax_id));$i++){ 
        
      $data[$tax_id[$i]]=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal']);
      
   $final=$final+array_sum($tax_value[$tax_id[$i]]);
   
     }
     
     
        for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){ 
  
          $data[$tax_id[$o]]=number_format(0,$_SESSION['be_decimal']);
        } 

      $data["TOTAL"]=number_format($subtotal+$final,$_SESSION['be_decimal']);
                               
                          array_push($data1,$data);
                          unset($data);
                          
                          
                          
                          
                          
               $filename = "Consolidated Report Item Tax Wise-" . $reporthead . ".xls";
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
   
       }else{
           
         ////hsn///  
                      $hsn='';
                            
                            if($_REQUEST['hsn_code_search']!=''){
                                
                                
                                $hsn.=" and tm.mr_hsn like '%".$_REQUEST['hsn_code_search']."%' ";
                                
                            }
                            
                            $tax_name=array(); $tax_val_sum1=0;
                            $tax_id=array();
                            
                            
                                  $sql_login  =  $database->mysqlQuery(" SELECT amc_name,amc_id,amc_value FROM `tbl_extra_tax_master` "
                                    . "where amc_active='Y'  and amc_item_tax='Y'  "); 
                                     $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                        $tax_val_sum=  $tax_val_sum+$result_login['amc_value'];
                                        $tax_name[]=$result_login['amc_name'];
                                        $tax_id[]=$result_login['amc_id'];
                                     }} 
                                  
                                    

  $final=0;
  $subtotal=0;$tot_tax1=0;
  $tax_value=array();$crd=0;
  
  if($_REQUEST['hsn_billwise'] =='false'){
  
  $sql_login  =  $database->mysqlQuery(" select sum(qty) as qty1,unit,sum(item_price) as sub1,mid,mr_menuname,mr_hsn,mr_description,
   dayclosedate,weight,sum(weight) as weight1,portionid,portionname,unitid,unitname,baseunitid,baseunitname,bill from 
      
   (select tbd.bd_qty as qty,tm.mr_unit_type as unit, tbd.bd_amount as item_price, tm.mr_menuid as mid,
   tm.mr_menuname,tm.mr_hsn,tm.mr_description,bm.bm_dayclosedate as dayclosedate,tbd.bd_unit_weight as weight,
   tbd.bd_portion as portionid,pm.pm_portionname as portionname,tbd.bd_unit_id as unitid,um.u_name as unitname,
   tbd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname,bm.bm_billno as bill
   
   from tbl_tablebillmaster bm  left join tbl_tablebilldetails tbd on tbd.bd_billno=bm.bm_billno
   left join tbl_menumaster tm on  tm.mr_menuid=tbd.bd_menuid 
   left join tbl_portionmaster pm ON pm.pm_id = tbd.bd_portion
   left join  tbl_unit_master um on um.u_id=tbd.bd_unit_id
   left join tbl_base_unit_master bum on bum.bu_id=tbd.bd_base_unit_id
   where $string $hsn
      
   union all
  
  select tbd.tab_qty as qty,tm.mr_unit_type as unit,tbd.tab_amount as item_price, tm.mr_menuid as mid,
  tm.mr_menuname,tm.mr_hsn, tm.mr_description,bm.tab_dayclosedate as dayclosedate,tbd.tab_unit_weight as weight,
  tbd.tab_portion as portionid,pm.pm_portionname as portionname,tbd.tab_unit_id as unitid,um.u_name as unitname,
  tbd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname,bm.tab_billno as bill
  
  from tbl_takeaway_billmaster
  bm  left join tbl_takeaway_billdetails tbd on tbd.tab_billno=bm.tab_billno
  left join tbl_menumaster tm on tm.mr_menuid=tbd.tab_menuid  
  left join tbl_portionmaster pm ON pm.pm_id = tbd.tab_portion
  left join  tbl_unit_master um on um.u_id=tbd.tab_unit_id
  left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
  where  $stringta $hsn)s
      
  where qty>0  group by mr_menuname order by mr_hsn ASC ");
                         
  
  }else{
      
      
       
       $sql_login  =  $database->mysqlQuery(" select sum(qty) as qty1,unit,sum(item_price) as sub1,mid,mr_menuname,mr_hsn,mr_description,
   dayclosedate,sum(weight) as weight1,portionid,portionname,unitid,unitname,baseunitid,baseunitname,bill,tot_all from 
      
   (select tbd.bd_qty as qty,tm.mr_unit_type as unit, tbd.bd_amount as item_price, tm.mr_menuid as mid,
   tm.mr_menuname,tm.mr_hsn,tm.mr_description,bm.bm_dayclosedate as dayclosedate,tbd.bd_unit_weight as weight,
   tbd.bd_portion as portionid,pm.pm_portionname as portionname,tbd.bd_unit_id as unitid,um.u_name as unitname,
   tbd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname,bm.bm_billno as bill,bm.bm_finaltotal as tot_all
   
   from tbl_tablebillmaster bm  left join tbl_tablebilldetails tbd on tbd.bd_billno=bm.bm_billno
   left join tbl_menumaster tm on  tm.mr_menuid=tbd.bd_menuid 
   left join tbl_portionmaster pm ON pm.pm_id = tbd.bd_portion
   left join  tbl_unit_master um on um.u_id=tbd.bd_unit_id
   left join tbl_base_unit_master bum on bum.bu_id=tbd.bd_base_unit_id
   where $string $hsn
      
   union all
  
  select tbd.tab_qty as qty,tm.mr_unit_type as unit,tbd.tab_amount as item_price, tm.mr_menuid as mid,
  tm.mr_menuname,tm.mr_hsn, tm.mr_description,bm.tab_dayclosedate as dayclosedate,tbd.tab_unit_weight as weight,
  tbd.tab_portion as portionid,pm.pm_portionname as portionname,tbd.tab_unit_id as unitid,um.u_name as unitname,
  tbd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname,bm.tab_billno as bill,bm.tab_netamt as tot_all
  
  from tbl_takeaway_billmaster
  bm  left join tbl_takeaway_billdetails tbd on tbd.tab_billno=bm.tab_billno
  left join tbl_menumaster tm on tm.mr_menuid=tbd.tab_menuid  
  left join tbl_portionmaster pm ON pm.pm_id = tbd.tab_portion
  left join  tbl_unit_master um on um.u_id=tbd.tab_unit_id
  left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
  where  $stringta $hsn )s
      
  where qty>0  group by  dayclosedate,bill,mid order by dayclosedate,bill,mr_hsn ASC ");  
      
      
      
  }
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        
                        if($result_login['portionid']!=''){
                              $weight='';
                              
                              $unit=$result_login['portionname'] ;
                             
                      }else{
                                
                                  
                                if($result_login['unitid']!=''){
                                    
                                    $unit=$result_login['unitname'] ;
                                }
                                else{
                                    
                                    $unit=$result_login['baseunitname'] ;
                                }
                      }
                      
                      
                      
                                $i++;
                                $subtotal=$subtotal + $result_login['sub1'];        
                             
	if($_REQUEST['hsn_billwise']=='true'){
            
              $data["Date"]=$result_login['dayclosedate']; 
            
              $data["Bill No"]=$result_login['bill'];
            
        }

                         $data["Description"]=substr($result_login['mr_menuname'],0,30);
                         $data["HSN"]=$result_login['mr_hsn'];
                         
                         $data["Unit"]=$unit;
                             
                             if($result_login['unit']!=''){ 
                           $data["Qty"]=$result_login['weight1'];
                                 }else{ 
                         $data["Qty"]=$result_login['qty1'];
                                 }
                         
                     
                        $tax_val_sum1=0;
                        for($s=0;$s<count(array_unique($tax_id));$s++){
                             
                        }
                           
                         $data["Total Taxable Value"]=number_format($result_login['sub1'],$_SESSION['be_decimal']);
                              
                        $final1=0;$tot_tax=0;
                        for($s=0;$s<count(array_unique($tax_id));$s++){
                                    
                                    
                        if($_REQUEST['hsn_billwise'] =='false'){        
                                    
                        $sql_taxvalue  =  $database->mysqlQuery("select taxtotal,taxid,sum(taxtotal) as tx1,v1 from
                        (select betm.bet_tax_amount as taxtotal,betm.bet_tax_id as taxid,betm.bet_tax_value as v1
                        FROM tbl_tablebill_extra_tax_details betm where
                        betm.bet_menuid='".$result_login['mid']."' and betm.bet_tax_id='".$tax_id[$s]."' $stringtx_di          
                        union all
                        select tketm.tbet_tax_amount  as taxtotal,tketm.tbet_tax_id as taxid,tketm.tbet_tax_value as v1
                        FROM tbl_takeaway_bill_extra_tax_details tketm  
                        where  tketm.tbet_menuid='".$result_login['mid']."' and tketm.tbet_tax_id ='".$tax_id[$s]."' $stringtx_ta)s  
                        order by s.taxid asc"); 
                        
                        }else{
                                
                        $sql_taxvalue  =  $database->mysqlQuery("select taxtotal,sum(taxtotal) as tx1,taxid,mid,b1,v1 from
                        (select betm.bet_tax_amount as taxtotal,betm.bet_tax_id as taxid , betm.bet_menuid as mid, betm.bet_billno as b1,betm.bet_tax_value as v1
                        FROM tbl_tablebill_extra_tax_details betm  left join tbl_tablebillmaster bm on bm.bm_billno=betm.bet_billno where 
                         betm.bet_menuid='".$result_login['mid']."' and betm.bet_tax_id='".$tax_id[$s]."' and betm.bet_billno='".$result_login['bill']."'       
                         and $string 
                            
                        union all
                            
                        select tketm.tbet_tax_amount  as taxtotal,tketm.tbet_tax_id as taxid, tketm.tbet_menuid as mid, tketm.tbet_billno as b1,tketm.tbet_tax_value as v1
                        FROM tbl_takeaway_bill_extra_tax_details tketm   left join tbl_takeaway_billmaster bm on bm.tab_billno=tketm.tbet_billno
                        where  tketm.tbet_menuid='".$result_login['mid']."' and  tketm.tbet_billno='".$result_login['bill']."' 
                        and tketm.tbet_tax_id ='".$tax_id[$s]."' and $stringta )s  
                      
                         group by taxid,mid,b1 order by s.taxid asc"); 
                                
                            }
                              
                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    {
                                        if($result_taxvalue['taxtotal']==''){
                                            
                                          $result_taxvalue['taxtotal']=0;
                                        }
                                    
                                    
                                    $tax_value[$result_taxvalue['taxid']][]=$result_taxvalue['tx1'];
                                 
                                    $tax_val_sum1=  $tax_val_sum1+$result_taxvalue['v1'];
                                    
                                    $data[$tax_name[$s]]=$result_taxvalue['tx1'];

                                    $tot_tax=$tot_tax+$result_taxvalue['tx1'];
                                    
                                    $tot_tax1=$tot_tax1+$result_taxvalue['tx1'];
                            
                                } } 
                               else {
                                   
                                   $tax_value[$tax_id[$s]][]=0;
                               
                                   $data[$tax_name[$s]]=0;
                                
                               } }
                               
                               
            $data["Tax %"]=$tax_val_sum1;              
                               
             if($_REQUEST['hsn_billwise']=='true'){
            
              $data["Total"]=($result_login['sub1']+$tot_tax); 
            
              $data["Item Disc"]='0.00';
            
              }
                               
                               
            array_push($data1,$data);
            unset($data);
                               
            } } 
                                
       
          if($_REQUEST['hsn_billwise']=='true'){
              
             $data['Date']='';       
             $data['Bill No']='';      
          }                       
                                
         $data['Description']='Total';                        
         $data['HSN']='';                         
         $data['Unit']='';                         
         $data['Quantity']='';   
         
           
         $data['Total Taxable Value']=number_format($subtotal,$_SESSION['be_decimal']);
      
     for($i=0;$i<count(array_unique($tax_id));$i++){ 
        
       $data[$tax_id[$i]]=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal']);
      
       $final=$final+array_sum($tax_value[$tax_id[$i]]);
   
     }
     
     
        for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){ 
  
            $data[$tax_id[$o]]=number_format(0,$_SESSION['be_decimal']);
        } 
         $data['Tax %']='';  
        
        if($_REQUEST['hsn_billwise']=='true'){
              
             $data['Total']=$tot_tax1+$subtotal;       
              $data['Item Disc No']='0.00';      
          }  
        
        
                          
        array_push($data1,$data);
        unset($data);
                           
                          
     $filename = "HSN CODE Tax Wise-" . $reporthead . ".xls";
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
             
    }    
}

  else if(($_REQUEST['type']=="consolidated_shift_report"))
{
    

                          
      $string="";
        
        if($_REQUEST['shiftlogin']!="all"){
        
        
         $string="sd_open_staff='".$_REQUEST['shiftlogin']."' AND ";
        }
        
	$reporthead="";
	$st="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			 $string.= " sd_day between '".$from."' and '".$to."' ";
                          
                         $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " sd_day between '".$from."' and '".$to."' ";
                       
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " sd_day between '".$from."' and '".$to."' ";
                        
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	
	else 
	{

	$reporthead="";
	$st="";
        
	$bydatz=$_REQUEST['bydate'];
	
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";


$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                
$st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
              
$st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
               
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
               
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" sd_day = CURDATE( ) - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";
                                  
				  $st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  sd_day between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                

$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
               
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
               
			$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" sd_day between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
              
		$st="Last 1 year";
	}	
	$reporthead=$st;

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " sd_day between '".$from."' and '".$to."' ";
                       
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
		
	}
	
       
                        
        $data=array();
            $data1=array();
            $xlsRow=1;                                         
                                          
     $sh_open_bal1=0;                                   
          $sh_close_bal1=0;          
                      $sql_loginall_shift  =  $database->mysqlQuery("SELECT sd_open,sd_close,sd_total_value,sd_day,sd_total_value_close
                      st.ser_firstname FROM tbl_shift_details ts left join tbl_staffmaster st on st.ser_staffid=ts.sd_open_staff  where $string order by sd_day,sd_open ASC  ");       
                    
	  $num_loginall_shift   = $database->mysqlNumRows($sql_loginall_shift);
	  if($num_loginall_shift){
                $i=1;         
		while($result_loginall_shift  = $database->mysqlFetchArray($sql_loginall_shift)) 
	        {
                   $sh_login=$result_loginall_shift['ser_firstname'];  
                   $sh_open=$result_loginall_shift['sd_open'];  
                   $sh_close=$result_loginall_shift['sd_close'];                     
                   $sh_time_doff1= strtotime($sh_close) - strtotime($sh_open);
                   $sh_time_doff= gmdate("H:i:s", $sh_time_doff1);
                   $sh_open_bal=$result_loginall_shift['sd_total_value'];  
                   $sh_open_bal1=$sh_open_bal1+$result_loginall_shift['sd_total_value'];  
                   $sh_close_bal=$result_loginall_shift['sd_total_value_close']; 
                   $sh_close_bal1=$sh_close_bal1+$result_loginall_shift['sd_total_value_close'];  
                  
                        $data['Sl No']=$i;
                        $data['Date']=$database->convert_date($result_loginall_shift['sd_day']);
                        $data['Shift Login']=$sh_login;
                        $data['Shift open Time']=$sh_open;
                        $data['Shift Close Time']=$sh_close;
                        $data["Login Hours"]=$sh_time_doff."- hrs";
                        $data["Shift Opening Balance"]=number_format($sh_open_bal,$_SESSION['be_decimal']);
                        $data["Shift Closing Balance"]=number_format($sh_close_bal,$_SESSION['be_decimal']);
                          
                        array_push($data1,$data);
                        unset($data);
                        $i++;
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
          $data[]="";
	$data[]=number_format($sh_open_bal1,$_SESSION['be_decimal']);
	$data[]=number_format($sh_close_bal1,$_SESSION['be_decimal']);
       
        array_push($data1,$data);
       
            $filename = "Consolidated Shift Login Report-" . $reporthead . ".xls";
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
              
	
     
   $sqldrop  =  $database->mysqlQuery ("DROP VIEW item"); 
   exit;     
                              
 
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
        
        

//		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
//		{
//			$from=$database->convert_date($_REQUEST['fromdt']);
//			$to=$database->convert_date($_REQUEST['todt']);
//			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
//                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
//                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
//		}
//		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
//		{
//			$from=$database->convert_date($_REQUEST['fromdt']);
//			$to=date("Y-m-d");
//			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
//                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."'";
//                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
//		}
//		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
//		{
//			$from=date("Y-m-d");
//			$to=$database->convert_date($_REQUEST['todt']);
//			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
//                        $stringta.= " tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
//                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
//		}
                
                  
	
//	else 
//	{
//		
//		$bydatz=$_REQUEST['bydate'];
//                if($bydatz!="" && $bydatz!="null")
//                {
//	
//	if($bydatz=="Last5days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
//DAY AND CURDATE( )";
//                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
//DAY AND CURDATE( )";
//                $st="Last 5 days";
//	}elseif($bydatz=="Last10days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
//DAY AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
//DAY AND CURDATE( )";
//                $st="Last 10 days";
//	}
//	else if($bydatz=="Yesterday")
//			  {
//				  $string.="bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
//                                  $stringta.=" tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
//                                  $st="Yesterday";
//			  }
//	elseif($bydatz=="Last15days")
//	{
//		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
//DAY AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
//DAY AND CURDATE( )";
//                $st="Last 15 days";
//	}
//	else if($bydatz=="Last20days")
//	{
//		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
//DAY AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
//DAY AND CURDATE( )";
//                $st="Last 20 days";
//	}
//	else if($bydatz=="Last25days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
//DAY AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
//DAY AND CURDATE( )";
//                $st="Last 25 days";
//	}
//	else if($bydatz=="Last30days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
//DAY AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
//DAY AND CURDATE( )";
//                $st="Last 30 days";
//	}
//	 else if($bydatz=="Last1month")
//			  {
//				  $string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
//                                  $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
//                                  $st="Last 1 MONTH";
//			  }
//	else if($bydatz=="Today")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
//                $st="TODAY";
//	}
//else if($bydatz=="Last90days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
//                $st="Last 90 days";
//	}
//else if($bydatz=="Last180days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
//                $st="Last 180 days";
//	}
//else if($bydatz=="Last365days")
//	{
//		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
//                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
//                $st="Last  1 Year";
//	}
//
//       
//	
//        $reporthead=$st;
//        }
//        else
//	{
//		
//		
//		$from=date("Y-m-d");
//			$to=date("Y-m-d");
//			$string.= " bm.bm_dayclosedate ='".$from."'";
//                        $stringta.= " tbm.tab_dayclosedate='".$from."'";
//                        $reporthead="On ".$database->convert_date($from);
//	}
//	
//        }
	
	
	
	
	
                        
								
	

$final=0;
$data=  array();
$data1=  array();
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
          
           
                    
                    
                    
        $data['Sl No']=$p;
	$data['Hour Between']=$time1.'-'.$time2;
	$data['Final']=number_format($result_hourly_wise['total'],$_SESSION['be_decimal']);
	
	
        array_push($data1,$data);
        unset($data);
           
     
        }}
       $data['Sl No']="Total";
	$data['Hour Between']='';
	$data['Final']=number_format($final,$_SESSION['be_decimal']);
	
	
        array_push($data1,$data);
        unset($data);
                      $filename = "Hourly Report-".$reporthead . ".xls";
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




else if(($_REQUEST['type']=="tax_report"))
{
    $tax="";
    $string1='';
    $stringta1='';
    $data=array();
    $data1=array();
    
    if(isset($_REQUEST['department'])){
            $dept=$_REQUEST['department'];
            
        }else{
            $dept="";
        }
    
   if(isset($_REQUEST['tax'])){
            $tax=$_REQUEST['tax'];
            
              $tx1=$tax;
        }else{
            $tax="";
        }
	
        $string="";
        $stringta="";
        
        $string.=" tbm.bm_status='Closed' AND etm.bem_taxid in ($tx1)  and  tbm.bm_complimentary!='Y' AND  ";
        $string1.=" tbm.bm_status='Closed' and  tbm.bm_complimentary!='Y' AND  ";
        
        if($dept=="TA" || $dept=="CS" || $dept=="HD"){
        $stringta.=" tkm.tab_status='Closed' and tkm.tab_payment_settled='Y' AND etm.tbe_taxid in ($tx1)  AND tkm.tab_mode='$dept'   and  tkm.tab_complimentary!='Y' AND ";
        $stringta1.=" tkm.tab_status='Closed' and tkm.tab_payment_settled='Y' AND tkm.tab_mode='$dept'   and  tkm.tab_complimentary!='Y'  AND ";
        
        }
        else {
            $stringta.=" tkm.tab_status='Closed' and tkm.tab_payment_settled='Y'  AND etm.tbe_taxid in ($tx1)  and  tkm.tab_complimentary!='Y' AND  ";
            $stringta1.=" tkm.tab_status='Closed' and tkm.tab_payment_settled='Y'  and  tkm.tab_complimentary!='Y' AND  ";
        }
        
	$reporthead="";
	$st="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			 $string.= " tbm.bm_dayclosedate between '".$from."' and '".$to."' ";
                          $stringta.= " tkm.tab_dayclosedate between '".$from."' and '".$to."' ";
                          
                         $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tbm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tkm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tbm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tkm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		
		
		
	
	else 
	{
		

	$reporthead="";
	$st="";
        
	$bydatz=$_REQUEST['bydate'];
		
		
		
	if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";


$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                
$st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                
                
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
                
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                
$st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		
                $st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" tbm.bm_dayclosedate = CURDATE( ) - INTERVAL 1 day ";//" bm_dayclosedate =CURDATE() - 1  ";
                                   $stringta.=" tkm.tab_dayclosedate = CURDATE( ) - INTERVAL 1 day ";
                                   
				  $st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                $stringta.="  tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
                
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		
                $st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		
                $st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" tbm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringta.=" tkm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		
                $st="Last 1 year";
	}	
	$reporthead=$st;

	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tbm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tkm.tab_dayclosedate between '".$from."' and '".$to."' ";
                        
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
		
	}
    $taxid         =array();
    $tax_values    =array();
    $bill_values   =array();
    $tax_name      =array();
    $values_sum    =array();
    
                $sql_login  =  $database->mysqlQuery(" select distinct(taxid) as taxid,taxname from ( select distinct(betm.bem_taxid) as taxid,betm.bem_label as taxname  FROM tbl_tablebill_extra_tax_master betm left join tbl_extra_tax_master tm on tm.amc_id=betm.bem_taxid where amc_id in ($tx1) group by amc_id  union all 
                                                        select distinct(betm.tbe_taxid) as taxid,betm.tbe_label as taxname  FROM tbl_takeaway_bill_extra_tax_master betm left join tbl_extra_tax_master tm on tm.amc_id=betm.tbe_taxid where amc_id in ($tx1) group by amc_id  ) x order by x.taxid asc"); 
//                echo "select distinct(taxid) as taxid,taxname from ( select distinct(betm.bem_taxid) as taxid,betm.bem_label as taxname  FROM tbl_tablebill_extra_tax_master betm left join tbl_extra_tax_master tm on tm.amc_id=betm.bem_taxid where amc_id in ($tx1) group by amc_id  union all 
//                                                        select distinct(betm.tbe_taxid) as taxid,betm.tbe_label as taxname  FROM tbl_takeaway_bill_extra_tax_master betm left join tbl_extra_tax_master tm on tm.amc_id=betm.tbe_taxid where amc_id in ($tx1) group by amc_id  ) x order by x.taxid asc";
                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login){ 
                    while($result_login=$database->mysqlFetchArray($sql_login)){
                    $tax_name[]=$result_login['taxname'];
                    $tax_id[]=$result_login['taxid'];
                    
                }}
                //**TAX DETAILS FETCHING**
                if($dept=="DI"){
                    $sql_tax_details  =  $database->mysqlQuery("SELECT tbm.bm_dayclosedate,sum(etm.bem_total_value) as tax, etm.bem_taxid as taxid   FROM tbl_tablebill_extra_tax_master etm left join tbl_tablebillmaster tbm on tbm.bm_billno= etm.bem_billno where $string  group by etm.bem_taxid,tbm.bm_dayclosedate"); 
                    $num_tax_details   = $database->mysqlNumRows($sql_tax_details);
                    if($num_tax_details){ 
                        while($result_tax_details=$database->mysqlFetchArray($sql_tax_details)){
                        $tax_values[$result_tax_details['bm_dayclosedate']][$result_tax_details['taxid']][]=$result_tax_details['tax'];

                    }}
                    
                }
                else if($dept=="TA" || $dept=="CS" || $dept=="HD"){
                    $sql_tax_details  =  $database->mysqlQuery("SELECT tkm.tab_dayclosedate,sum(etm.tbe_total_value) as tax, etm.tbe_taxid as taxid  FROM tbl_takeaway_bill_extra_tax_master etm left join tbl_takeaway_billmaster tkm on tkm.tab_billno = etm.tbe_billno where $stringta group by etm.tbe_taxid,tkm.tab_dayclosedate");
                    //echo "SELECT tkm.tab_dayclosedate,sum(etm.tbe_total_value) as tax, etm.tbe_taxid as taxid  FROM tbl_takeaway_bill_extra_tax_master etm left join tbl_takeaway_billmaster tkm on tkm.tab_billno = etm.tbe_billno where $stringta group by etm.tbe_taxid,tkm.tab_dayclosedate";
                    $num_tax_details   = $database->mysqlNumRows($sql_tax_details);
                    if($num_tax_details){ 
                        while($result_tax_details=$database->mysqlFetchArray($sql_tax_details)){
                        $tax_values[$result_tax_details['tab_dayclosedate']][$result_tax_details['taxid']][]=$result_tax_details['tax'];
                    }}
                }
                else{
                    $sql_tax_details  =  $database->mysqlQuery("select date, sum(tax) as tax,taxid from (
                            SELECT tbm.bm_dayclosedate as date,etm.bem_total_value as tax, etm.bem_taxid as taxid   FROM tbl_tablebill_extra_tax_master etm left join tbl_tablebillmaster tbm on tbm.bm_billno= etm.bem_billno where $string  union all
                            SELECT tkm.tab_dayclosedate as date,etm.tbe_total_value as tax, etm.tbe_taxid as taxid  FROM tbl_takeaway_bill_extra_tax_master etm left join tbl_takeaway_billmaster tkm on tkm.tab_billno = etm.tbe_billno where $stringta 
                            )x group by x.date,x.taxid");
                    $num_tax_details   = $database->mysqlNumRows($sql_tax_details);
                    if($num_tax_details){ 
                        while($result_tax_details=$database->mysqlFetchArray($sql_tax_details)){
                        $tax_values[$result_tax_details['date']][$result_tax_details['taxid']][]=$result_tax_details['tax'];

                    }}
                }
                //print_r($bill_values);
                
               //**TAX DETAILS FETCHING**
            if($tax_values){    
            
                foreach($tax_values as $key=>$val){
                    $summ_tax =  array();
                    $min_bill='';
                    $max_bill='';
                    $bill=array();
                    //**BILL DETAILS FETCHING** 
                    if($dept=="DI"){
                        $sql_bill_details  =  $database->mysqlQuery("select min( SUBSTRING_INDEX(tbm.bm_billno, '-', -1) ) as min_bill,max(SUBSTRING_INDEX(tbm.bm_billno, '-', -1)) as max_bill,tbm.bm_dayclosedate,sum(tbm.bm_subtotal_final) as subtotal, sum(tbm.bm_finaltotal) as final,sum(tbm.bm_discountvalue) as discount, sum(tbm.bm_roundoff_value) as roundof,sum(tbm.bm_tax_exempt) as tax_exempt
                                                                    FROM tbl_tablebillmaster tbm WHERE $string1 tbm.bm_dayclosedate='$key' group by tbm.bm_dayclosedate order by tbm.bm_billtime,tbm.bm_billdate asc");
                        $num_bill_details   = $database->mysqlNumRows($sql_bill_details);
                        if($num_bill_details){ 
                            while($result_bill_details=$database->mysqlFetchArray($sql_bill_details)){
                            $bill_values[$result_bill_details['bm_dayclosedate']]['SUB']=$result_bill_details['subtotal'];
                            $bill_values[$result_bill_details['bm_dayclosedate']]['FINAL']=$result_bill_details['final'];
                            $bill_values[$result_bill_details['bm_dayclosedate']]['DISC']=$result_bill_details['discount'];
                            $bill_values[$result_bill_details['bm_dayclosedate']]['ROUND']=$result_bill_details['roundof'];
                            $bill_values[$result_bill_details['bm_dayclosedate']]['TAX_EXEM']=$result_bill_details['tax_exempt'];
                            $min_bill=$result_bill_details['min_bill'];
                            $max_bill=$result_bill_details['max_bill'];
                            $bill[]=$min_bill;
                            $bill[]=$max_bill;
                            
                        }}
                    }
                    else if($dept=="TA" || $dept=="CS" || $dept=="HD"){
                        $sql_bill_details  =  $database->mysqlQuery("select min( SUBSTRING_INDEX(tkm.tab_billno, '-', -1) ) as min_bill,max(SUBSTRING_INDEX(tkm.tab_billno, '-', -1)) as max_bill,tkm.tab_dayclosedate,sum(tkm.tab_subtotal_final) as subtotal, sum(tkm.tab_netamt) as final, sum(tkm.tab_discountvalue) as discount, sum(tkm.tab_roundoff_value) as roundof ,sum(tkm.tab_tax_exempt) as tax_exempt 
                                                                    FROM tbl_takeaway_billmaster tkm WHERE $stringta1 tkm.tab_dayclosedate ='$key' group by tkm.tab_dayclosedate order by tkm.tab_time,tkm.tab_date asc ");
//                        echo "select  min(tkm.tab_billno) as min_bill,max(tkm.tab_billno) as max_bill,tkm.tab_dayclosedate,tkm.tab_subtotal_final as subtotal, tkm.tab_netamt as final, tkm.tab_discountvalue as discount, tkm.tab_roundoff_value as roundof ,tkm.tab_tax_exempt as bm_tax_exempt 
//                                                                    FROM tbl_takeaway_billmaster tkm WHERE $stringta1 tkm.tab_dayclosedate ='$key' group by tkm.tab_dayclosedate order by tkm.tab_time,tkm.tab_date asc";
                        $num_bill_details   = $database->mysqlNumRows($sql_bill_details);
                        if($num_bill_details){ 
                            while($result_bill_details=$database->mysqlFetchArray($sql_bill_details)){
                            $bill_values[$result_bill_details['tab_dayclosedate']]['SUB']=$result_bill_details['subtotal'];
                            $bill_values[$result_bill_details['tab_dayclosedate']]['FINAL']=$result_bill_details['final'];
                            $bill_values[$result_bill_details['tab_dayclosedate']]['DISC']=$result_bill_details['discount'];
                            $bill_values[$result_bill_details['tab_dayclosedate']]['ROUND']=$result_bill_details['roundof'];
                            $bill_values[$result_bill_details['tab_dayclosedate']]['TAX_EXEM']=$result_bill_details['tax_exempt'];
                        
                            $min_bill=$result_bill_details['min_bill'];
                            $max_bill=$result_bill_details['max_bill'];
                            $bill[]=$min_bill;
                            $bill[]=$max_bill;
                        }}
                        
                    }
                   else{
                        $sql_bill_details  =  $database->mysqlQuery("select min( SUBSTRING_INDEX(bill, '-', -1) ) as min_bill, max(SUBSTRING_INDEX(bill, '-', -1)) as max_bill,billdate,billtime,dayclosedate,sum(subtotal) as subtotal ,sum(final) as final ,sum(discount) as discount,sum(roundof) as roundof,sum(tax_exempt) as tax_exempt from(
                                                                    select tbm.bm_billno as bill,tbm.bm_billdate as billdate,tbm.bm_billtime as billtime,tbm.bm_dayclosedate as dayclosedate,tbm.bm_subtotal_final as subtotal, tbm.bm_finaltotal as final,tbm.bm_discountvalue as discount, tbm.bm_roundoff_value as roundof,tbm.bm_tax_exempt as tax_exempt
                                                                    FROM tbl_tablebillmaster tbm WHERE $string1 tbm.bm_dayclosedate='$key' union all
                                                                    select  tkm.tab_billno as bill,tkm.tab_date as billdate,tkm.tab_time as billtime,tkm.tab_dayclosedate as dayclosedate,tkm.tab_subtotal_final as subtotal, tkm.tab_netamt as final, tkm.tab_discountvalue as discount, tkm.tab_roundoff_value as roundof ,tkm.tab_tax_exempt as bm_tax_exempt 
                                                                    FROM tbl_takeaway_billmaster tkm WHERE $stringta1 tkm.tab_dayclosedate ='$key')y group by y.dayclosedate order by billdate,billtime asc ");
                        
                        $num_bill_details   = $database->mysqlNumRows($sql_bill_details);
                        if($num_bill_details){ 
                            while($result_bill_details=$database->mysqlFetchArray($sql_bill_details)){
                            $bill_values[$result_bill_details['dayclosedate']]['SUB']=$result_bill_details['subtotal'];
                            $bill_values[$result_bill_details['dayclosedate']]['FINAL']=$result_bill_details['final'];
                            $bill_values[$result_bill_details['dayclosedate']]['DISC']=$result_bill_details['discount'];
                            $bill_values[$result_bill_details['dayclosedate']]['ROUND']=$result_bill_details['roundof'];
                            $bill_values[$result_bill_details['dayclosedate']]['TAX_EXEM']=$result_bill_details['tax_exempt'];
                            $min_bill=$result_bill_details['min_bill'];
                            $max_bill=$result_bill_details['max_bill'];
                            $bill[]=$min_bill;
                            $bill[]=$max_bill;
                            
                        }}
                    }
                    //**BILL DETAILS FETCHING** 
                    $values_sum['SALES_TOTAL'][]        =$bill_values[$key]['SUB'];
                    $values_sum['TAX_EXEMPT_TOTAL'][]   =$bill_values[$key]['TAX_EXEM'];
                    $values_sum['ROUNDOFF_TOTAL'][]     =$bill_values[$key]['ROUND'];
                    $values_sum['FINAL_TOTAL'][]        =$bill_values[$key]['FINAL'];
                    natsort($bill);
                    
                    
                    $data['Date']=$key;
                    $ii=0;
                    foreach($bill as $key1=>$val1){ 
                        $ii++;
                        if($ii==1){
                            $from_string= 'From';
                        }
                        else if($ii==2){
                            $from_string= 'To';
                        }
                        $data['Bill No '.$from_string]=$val1;
                    } 
                    $data['Sales']=number_format($bill_values[$key]['SUB'],$_SESSION['be_decimal']);
                    $data['Date']=$key;
                    for($i=0;$i<count($tax_name);$i++){
                        if(array_key_exists($tax_id[$i],$tax_values[$key])){
                            $summ_tax[]=array_sum($tax_values[$key][$tax_id[$i]]);
                            $values_sum['EACH_TAX_TOTAL'][$tax_id[$i]][]=array_sum($tax_values[$key][$tax_id[$i]]);
                            $data[$tax_name[$i]]=number_format(array_sum($tax_values[$key][$tax_id[$i]]),$_SESSION['be_decimal']);
                        }
                        else{
                            $data[$tax_name[$i]]=number_format(0,$_SESSION['be_decimal']);
                            
                        }
                    }
                    $values_sum['TOTAL_TAX_AMOUNT'][]=array_sum($summ_tax);
                    $data['Total Tax Amount']=number_format(array_sum($summ_tax),$_SESSION['be_decimal']);
                    $data['Tax Exempt Amount']=number_format($bill_values[$key]['TAX_EXEM'],$_SESSION['be_decimal']);
                    $data['Round Off']=number_format($bill_values[$key]['ROUND'],$_SESSION['be_decimal']);
                    $data['Total']=number_format($bill_values[$key]['FINAL'],$_SESSION['be_decimal']);
                    
                    array_push($data1,$data);
                    unset($data);
                }    
                $data['Date']='';
                $data['Bill No From']='';
                $data['Bill No To']='';
                $data['Sales']='';
                for($i=0;$i<count($tax_name);$i++){
                    $data[$tax_name[$i]]='';
                }
                $data['Total Tax Amount']='';
                $data['Tax Exempt Amount']='';
                $data['Round Off']='';
                $data['Total']='';
                array_push($data1,$data);
                unset($data);
                
                $data['Date']='TOTAL';
                $data['Bill No From']='';
                $data['Bill No To']='';
                $data['Sales']=number_format(array_sum($values_sum['SALES_TOTAL']),$_SESSION['be_decimal']);
                for($i=0;$i<count($tax_name);$i++){
                    if(array_key_exists($tax_id[$i],$values_sum['EACH_TAX_TOTAL'])){
                        $data[$tax_name[$i]]=number_format(array_sum($values_sum['EACH_TAX_TOTAL'][$tax_id[$i]]),$_SESSION['be_decimal']);
                    }
                    else{
                        $data[$tax_name[$i]]=number_format(0,$_SESSION['be_decimal']);
                    }
                }
                $data['Total Tax Amount']=number_format(array_sum($values_sum['TOTAL_TAX_AMOUNT']),$_SESSION['be_decimal']);
                $data['Tax Exempt Amount']=number_format(array_sum($values_sum['TAX_EXEMPT_TOTAL']),$_SESSION['be_decimal']);
                $data['Round Off']=number_format(array_sum($values_sum['ROUNDOFF_TOTAL']),$_SESSION['be_decimal']);
                $data['Total']=number_format(array_sum($values_sum['FINAL_TOTAL']),$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
                
        }
    
    
            $filename = "Tax Report-".$dept."-".$reporthead . ".xls";
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
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 5 
                    
DAY AND CURDATE( )";
              $reporthead="Last 5 days"; 
                
	}elseif($bydatz=="Last10days")
	{
		$string.=" and ts_dayclose between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
           $reporthead="Last 10 days";     
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" and ts_dayclose = CURDATE() - INTERVAL 1 day";
                              $reporthead="Yesterday";          
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
                $reporthead="Today";     
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
                       $reporthead="Today";     
	}
		
	
	}
	
	
	if(isset($_REQUEST['menu_search']) && $_REQUEST['menu_search']!="" ){
            
            $string.= " and mr_menuname LIKE '%".$_REQUEST['menu_search']."%'";
            
        }
        
        $data=array();
            $data1=array();
            $xlsRow=1;
            
                    
	
	?>
        
   <?php $clr=''; $open=0;$added=0;$balance=0;$sold=0;
  $sql_login  =  $database->mysqlQuery("select * from tbl_daily_stock_detail left join tbl_menumaster on mr_menuid=ts_menuid left join tbl_portionmaster on pm_id=ts_portion   $string order by ts_dayclose desc "); 
                          
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
              
              
              
                     $data['Sl']=$i++;
                    $data['Date']=$result_login['ts_dayclose'];
                    $data['Menu']=$result_login['mr_menuname'];
                    $data['Portion']=$result_login['pm_portionname'] ;
                    $data['Opening Stock']=$result_login['ts_open_stock'];
                    $data['Added Stock']=$result_login['ts_added_stock'];
                     $data['Balance Stock']=$result_login['ts_balance_stock'];
                    $data['Sold Stock']=(($result_login['ts_open_stock']+$result_login['ts_added_stock'])-$result_login['ts_balance_stock'] );
                    array_push($data1,$data);
                    unset($data);
          }}
          
          
          
                     $data['Sl']='Total';
                    $data['Date']='';
                    $data['Menu']='';
                    $data['Portion']='' ;
                    $data['Opening Stock']=$open;
                    $data['Added Stock']=$added;
                     $data['Balance Stock']=$balance;
                    $data['Sold Stock']=$sold;
                    array_push($data1,$data);
                    unset($data);
          
          
                  $filename = "Stock Report-" . $reporthead . ".xls";
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
        $st='';
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
        
       
         if(isset($_REQUEST['staff']) && $_REQUEST['staff']!="" ){
              
            $string.= " and bm.bm_settlement_login = '".$_REQUEST['staff']."' ";
            $stringta.= " and bm.tab_settlement_login = '".$_REQUEST['staff']."' ";
           
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
                    $st="Last 5 days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.=" and bm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                     $string_combo.= " cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $st="Last 10 days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.=" and bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.=" and bm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $string_combo.= " cbd.cbd_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $st="Yesterday";
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
                    $st="Today";
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
        
////detialed/////////	
if($_REQUEST['modeofview']!='summary'){	
        
            $data=array();
            $data1=array();
            $xlsRow=1;
        
        
        $final=0;
        $qty=0;
        $qty_final=0;
        $qty_final_ta=0;
        $qty_final_cs=0;
        $p=0;$i=0;
        if(($_REQUEST['addon']=='' ||$_REQUEST['addon']=='combo') &&($_REQUEST['category_menu']=="")){
            $sql_combo  =  $database->mysqlQuery("select combo,comboid,combopackid, sum(qty_di) as qty_di,sum(qty_ta) as qty_ta,sum(qty_cs) as qty_cs, rate as rate, sum(total) as total,dayclose as dateofsale
from (select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_dayclosedate  as dayclose,cbd.cbd_combo_id as comboid, cbd.cbd_combo_pack_id combopackid, cbd.cbd_combo_qty as qty_di,0 as qty_ta ,0 as qty_cs,
cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
FROM tbl_combo_bill_details cbd 
left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id 
left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id 
LEFT JOIN tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno 
where $string_combo  and bm.bm_status='Closed' 
group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno 
union all 
select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_dayclosedate  as dayclose,cbd.cbd_combo_id, cbd.cbd_combo_pack_id, 0 as qty_di, cbd.cbd_combo_qty as qty_ta, 0 as qty_cs,
cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
FROM tbl_combo_bill_details_ta cbd 
left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id 
left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id 
LEFT JOIN tbl_takeaway_billmaster bm on bm.tab_billno = cbd.cbd_billno 
where $string_combo  and bm.tab_status='Closed'   and bm.tab_mode IN ('TA','HD')
group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno
union all 


select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_dayclosedate  as dayclose,cbd.cbd_combo_id, cbd.cbd_combo_pack_id, 0 as qty_di, 0 as qty_ta, cbd.cbd_combo_qty as qty_cs, 
cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
FROM tbl_combo_bill_details_ta cbd 
left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id 
left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id 
LEFT JOIN tbl_takeaway_billmaster bm on bm.tab_billno = cbd.cbd_billno 
where $string_combo  and bm.tab_status='Closed' and bm.tab_mode = 'CS'

group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno) x 
group by x.comboid, x.combopackid,dateofsale order by dateofsale  ");
            $num_combo   = $database->mysqlNumRows($sql_combo);
            if($num_combo){
               $total=0;$qty=0;
                while($result_combo  = $database->mysqlFetchArray($sql_combo)){ 
                    $i++;$p++;
                    $final=$final+$result_combo['total'];
                    $qty_final=$qty_final+$result_combo['qty_di'];
                    
                    $qty_final_ta=$qty_final_ta+$result_combo['qty_ta'];
                    $qty_final_cs=$qty_final_cs+$result_combo['qty_cs'];
                    
                    $data['Sl No']=$p;
                     $data['Date']=$result_combo['dateofsale'];
                    if($i==1) {
                    $data['Main Category']='** COMBO MENU';
                    }else{
                        $data['Main Category']='';
                    }
                    $data['Sub Categroy']='';
                    $data['Item']=substr(strtoupper($result_combo['combo']),0,25);
                    $data['Unit Type']='';
                    $data['Portion/Weight']= '';
                    $data['Qty Di']=$result_combo['qty_di'];
                    $data['TA/HD']=$result_combo['qty_ta'];
                    $data['CS']=$result_combo['qty_cs'];
                    
                    $data['Total']=number_format(str_replace(',','',$result_combo['total']),$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                   
                }
            } }
            
            
    if($_REQUEST['addon']=='' || $_REQUEST['addon']=='N'|| $_REQUEST['addon']=='Y'){
                
          $sql_stw  =  $database->mysqlQuery("select maincategory,subcategory,menuid,menuname, rate_type,unit_type,portionid,portionname,weight,unitid,unitname,baseunitid,baseunitname,sum(qty_di)as qty_di,sum(qty_ta)as qty_ta,sum(qty_cs)as qty_cs,sum(total)as total , dayclose
          from (select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.bd_menuid as menuid,mm.mr_menuname as menuname, bd.bd_rate_type as rate_type,
                                        bd.bd_unit_type as unit_type, bd.bd_portion as portionid,pm.pm_portionname as portionname,
                                        bd.bd_unit_weight as weight, bd.bd_unit_id as unitid,um.u_name as unitname,
                                        bd.bd_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.bd_rate, sum(bd.bd_qty) as qty_di ,0 as qty_ta,0 as qty_cs, sum(bd.bd_rate* bd.bd_qty) as total, bm.bm_dayclosedate as dayclose
                                        FROM tbl_tablebilldetails bd
                                        left join tbl_tablebillmaster bm ON bm.bm_billno = bd.bd_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.bd_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.bd_portion
                                        left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                        where  bd.bd_count_combo_ordering is NULL and $string $string_addon 
                                        group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight,bm.bm_dayclosedate
                                            
                                        union all 
                                        
                                        select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                                        bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                                        bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                                        bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate, 0  as qty_di, sum(bd.tab_qty) as qty_ta ,0 as qty_cs,  sum(bd.tab_rate* bd.tab_qty) as total , bm.tab_dayclosedate as dayclose
                                        FROM tbl_takeaway_billdetails bd
                                        left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                        left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                        where bd.tab_count_combo_ordering is NULL  and bm.tab_mode IN ('TA','HD')   and $stringta $stringta_addon
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, bd.tab_unit_weight ,bm.tab_dayclosedate
                                        
                                        union all 
                                        
                                        select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.tab_menuid as menuid,mm.mr_menuname as menuname, bd.tab_rate_type as rate_type,
                                        bd.tab_unit_type as unit_type, bd.tab_portion as portionid,pm.pm_portionname as portionname,
                                        bd.tab_unit_weight as weight, bd.tab_unit_id as unitid,um.u_name as unitname,
                                        bd.tab_base_unit_id as baseunitid,bum.bu_name as baseunitname, bd.tab_rate,  0  as qty_di, 0 as qty_ta ,sum(bd.tab_qty) as qty_cs , sum(bd.tab_rate* bd.tab_qty) as total, bm.tab_dayclosedate as dayclose
                                        FROM tbl_takeaway_billdetails bd
                                        left join tbl_takeaway_billmaster bm ON bm.tab_billno = bd.tab_billno
                                        left join tbl_menumaster mm ON mm.mr_menuid = bd.tab_menuid
                                        left join tbl_menumaincategory mc ON mc.mmy_maincategoryid = mm.mr_maincatid
                                        left join tbl_menusubcategory sc ON sc.msy_subcategoryid = mm.mr_subcatid
                                        left join tbl_portionmaster pm ON pm.pm_id = bd.tab_portion
                                        left join  tbl_unit_master um on um.u_id=bd.tab_unit_id
                                        left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id
                                        where bd.tab_count_combo_ordering is NULL  and bm.tab_mode IN ('CS') and $stringta $stringta_addon  
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id, bd.tab_unit_weight, bm.tab_dayclosedate  
                                        
                                        )x group by menuid,portionid,unitid,baseunitid,weight,dayclose order by dayclose,maincategory,menuid     ");
          
                $num_stw   = $database->mysqlNumRows($sql_stw);
                if($num_stw){$t=0;$old_cat=""; $old_menu='';$unit_type=''; $old_menu2=''; $old_menu1=''; $tot_weight_all=0; $weight_in=0;  $wgt1=0;
                $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;$qty_ta=0;$qty_cs=0; $tot_wgt=0; $tot_wgt1=0;
                $weight=0;$unit='';$weight_loose=0;$loose_total=0;
                
		while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
                    {
                    
                    $weight_in= $weight_in+ (($qty+$qty_ta+$qty_cs)*$weight);  
                    
                     if($unit_type=='Loose' || $unit_type=='Packet' ){ 
                        $tot_wgt=  $tot_wgt+ $total;      
                      }
                    
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
                           $qty=$result_stw['qty_di'];
                             $qty_ta=$result_stw['qty_ta'];
                              $qty_cs=$result_stw['qty_cs'];
                            $qty_all=$qty+$qty_ta+$qty_cs;
                            
                            
                            
                            
                            $weight=$result_stw['weight'];
                            
                            
                             if($weight>0 && $result_stw['unit_type']=='Loose'){
                              $qty=$result_stw['qty_di'];
                             $qty_ta=$result_stw['qty_ta'];
                              $qty_cs=$result_stw['qty_cs'];
                            }else{
                                
                              
                               $qty=$result_stw['qty_di'];
                             $qty_ta=$result_stw['qty_ta'];
                              $qty_cs=$result_stw['qty_cs'];
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
                            
                            
                            $loose_total=0;
                            if($unit_type=='Loose'){
                                
                                $catname=$result_stw['maincategory'];  
                                if($result_stw['menuid']==$old_menu){
                                   
                                   $weight_loose=($result_stw['weight']);
                                  
                                   $final=$final-$loose_total;
                                   $loose_total=$loose_total+ $result_stw['total'];
                                   
                                     $catname='';
                                }else{
                                    
                                    $old_menu=$result_stw['menuid'];
                                 
                                    $weight_loose=$result_stw['weight'];
                                    $loose_total=$result_stw['total'];
                                }
                                $weight=$weight_loose;
                                $total=$loose_total;
                                $qty='0';
                                $catname=$result_stw['maincategory'];
                                 
                            }
                            
                        $t++;
                        
                        $old_menu2=$result_stw['menuid'];          
                        
                        if($old_menu2!=$old_menu1 && $p>1 && $weight_in>0){ 
                            
        $data['Sl No']="";
        $data['Date']="";
	$data['Main Category']="";
	$data['Sub Categroy']="";
	$data['Item']="";
	$data['Unit Type']="";
        $data['Portion/Weight']="";
	$data['Qty']="";
        $data['Qty TA/HD']='';
        $data['Qty CS']='';
        $data['Total Qty']='';
                       
        $data['Total Weight']='Total Wgt:'.$weight_in;
	$data['Total']=$tot_wgt;
	
        array_push($data1,$data);
        unset($data);
                            
                       $weight_in=0; 
                       $tot_wgt=0;
                       
                        }
                       
                       $old_menu1=$old_menu2; 
                       
                        
                            $data['Sl No']=$p;
                            $data['Date']=$result_stw['dayclose'];
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
                            $data['Qty DI']=$qty;
                            $data['TA/HD']=$qty_ta;
                            $data['CS']=$qty_cs;
                            
                           $data['Total Qty']=($qty+$qty_ta+$qty_cs);
                       
                    
                    if($unit_type=='Loose' || $unit_type=='Packet' ){ 
                        
                     $data['Total Weight']=($qty+$qty_ta+$qty_cs)*$weight;
                        
                     }else{
                          
                       $data['Total Weight']=0;  
                    }
                            
                            
                            
                  $data['Total']=number_format(str_replace(',','',$total),$_SESSION['be_decimal']);
                  
                  
                  
                            
                            array_push($data1,$data);
                            unset($data);
                          
                          
                          $xlsRow++;                           
                         $final=$final+$total;
                    
                        $qty_final=$qty_final+$qty;
                    
                  
                        $qty_final_ta=$qty_final_ta+$qty_ta;
                    
                   
                        $qty_final_cs=$qty_final_cs+$qty_cs;
                        
                        
              $tt_qty=0;         
              $tt_qty=$qty_final+$qty_final_ta+$qty_final_cs;   
                         
                $wgt1= $wgt1+ (($qty+$qty_ta+$qty_cs)*$weight);                
                   
                 if($unit_type=='Loose' || $unit_type=='Packet' ){ 
                        $tot_wgt1=  $tot_wgt1+ $total;      
                      }
                
                
            }} 
            
            
                     }        
            
          if( ( ($wgt1-($wgt1-$weight_in))+(($qty+$qty_ta+$qty_cs)*$weight) )  >0) {    
        $data['Sl No']="";
        $data['Date']="";
	$data['Main Category']="";
	$data['Sub Categroy']="";
	$data['Item']="";
	$data['Unit Type']="";
        $data['Portion/Weight']="";
	$data['Qty']="";
        $data['Qty TA/HD']='';
        $data['Qty CS']='';
        $data['Total Qty']='';
                       
        $data['Total Weight']='Total Wgt:'.(($wgt1-($wgt1-$weight_in))+(($qty+$qty_ta+$qty_cs)*$weight));
	$data['Total']=( ($tot_wgt1-($tot_wgt1-$tot_wgt))+$total );
	
        array_push($data1,$data);
        unset($data);
            
          }       
            
        $data['Sl No']="";
        $data['Date']="";
	$data['Main Category']="";
	$data['Sub Categroy']="";
	$data['Item']="";
	$data['Unit Type']="";
        $data['Portion/Weight']="";
	$data['Qty']="";
        $data['Qty TA/HD']='';
        $data['Qty CS']='';
        $data['Total Qty']='';
                       
        $data['Total Weight']='';
	$data['Total']="";
	
        array_push($data1,$data);
        unset($data);
         
        $data['Sl No']="Total";
        $data['Date']="";
	$data['Main Category']="";
	$data['Sub Categroy']="";
	$data['Item']="";
	$data['Unit Type']="";
        $data['Portion/Weight']="";
	$data['Qty']='';
        $data['Qty TA/HD']='';
        $data['Qty CS']='';
        $data['Total Qty']=$tt_qty;
                       
        $data['Total Weight']='';
        
	$data['Total']=number_format(str_replace(',','',$final),$_SESSION['be_decimal']);
        array_push($data1,$data);
        unset($data);
        
        
        
}else{
    
    ///////////summary////////
    
            $data=array();
            $data1=array();
            $xlsRow=1;
        
        
        $final=0;
        $qty=0;
        $qty_final=0;
        $qty_final_ta=0;
        $qty_final_cs=0;
        $p=0;$i=0;
        if(($_REQUEST['addon']=='' ||$_REQUEST['addon']=='combo') &&($_REQUEST['category_menu']=="")){
            
            $sql_combo  =  $database->mysqlQuery("select combo,comboid,combopackid, sum(qty_all) as qty_all, rate as rate, sum(total) as total,dayclose as dateofsale
from (select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_dayclosedate  as dayclose,cbd.cbd_combo_id as comboid, cbd.cbd_combo_pack_id combopackid, cbd.cbd_combo_qty as qty_all,
cbd.cbd_combo_pack_rate as rate, cbd.cbd_combo_total_rate as total 
FROM tbl_combo_bill_details cbd 
left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id 
left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id 
LEFT JOIN tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno 
where $string_combo  and bm.bm_status='Closed' 
group by cbd.cbd_combo_id, cbd.cbd_combo_pack_id,cbd.cbd_billno 
union all 
select CONCAT(cn.cn_name,' ',cp.cp_pack_name ) AS combo,cbd.cbd_dayclosedate  as dayclose,cbd.cbd_combo_id, cbd.cbd_combo_pack_id, cbd.cbd_combo_qty as qty_all,
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
                    $final=$final+$result_combo['total'];
                    $qty_final=$qty_final+$result_combo['qty_all'];
                    
                    
                    
                    $data['Sl No']=$p;
                   //  $data['Date']=$result_combo['dateofsale'];
                    if($i==1) {
                    $data['Main Category']='** COMBO MENU';
                    }else{
                        $data['Main Category']='';
                    }
                    $data['Sub Categroy']='';
                    $data['Item']=substr(strtoupper($result_combo['combo']),0,25);
                    $data['Unit Type']='';
                    $data['Portion/Weight']= '';
                    $data['Qty']=$result_combo['qty_all'];
                       
                    $data['Total']=number_format(str_replace(',','',$result_combo['total']),$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                   
                }
            } }
            
            
  if($_REQUEST['addon']=='' || $_REQUEST['addon']=='N'|| $_REQUEST['addon']=='Y'){
                
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
                                        where bd.tab_count_combo_ordering is NULL  and bm.tab_mode IN ('TA','HD','CS')   and $stringta $stringta_addon
                                        group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id, bd.tab_base_unit_id,weight
                                        
                                        )x group by menuid,portionid,unitid,baseunitid,weight order by maincategory,menuid     ");
          
                $num_stw   = $database->mysqlNumRows($sql_stw);
                if($num_stw){$t=0;$old_cat=""; $old_menu='';$unit_type='';
                $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;$qty_ta=0;$qty_cs=0;
                $weight=0;$unit='';$weight_loose=0;$loose_total=0;
                
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
                                  
                                }else{
                                    $unit=$result_stw['baseunitname'] ;
                                }
                            }
                            
                            if($unit_type=='Loose'){
                                
                                $catname=$result_stw['maincategory'];  
                                if($result_stw['menuid']==$old_menu){
                                $t=$i-1;
                                   
                                   unset($data1[$t-1]);
                                   

                                  // $weight_loose=$weight_loose+ $result_stw['weight'];
                                   $weight_loose=$weight_loose+ ($result_stw['weight']*$qty_all);
                                  
                                   $final=$final-$loose_total;
                                   $loose_total=$loose_total+ $result_stw['total'];
                                   
                                   
                                   $p=$p-1;
                                }else{
                                    $old_menu=$result_stw['menuid'];
                                  //  $weight_loose=$result_stw['weight'];
                                     $weight_loose=$result_stw['weight']*$qty_all;
                                    $loose_total=$result_stw['total'];
                                }
                                $weight=$weight_loose;
                                $total=$loose_total;
                                $qty='';
                                $catname=$result_stw['maincategory'];
                                 
                            }
                        $t++;
                        
                            $data['Sl No']=$p;
                            // $data['Date']=$result_stw['dayclose'];
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
                            
                             if($unit_type=='Loose'){ 
                                $data['Rate']= ($total/$weight);
                             }else{  
                                $data['Rate']= $result_stw['rt'];
                             } 
                    
                            $data['Total']=number_format(str_replace(',','',$total),$_SESSION['be_decimal']);
                            array_push($data1,$data);
                            unset($data);
                          
                          
                            
                            
                     $xlsRow++;                           
                     $final=$final+$total;
                    
                     $qty_final=$qty_final+$qty;
                    
                     $qty_final_ta=$qty_final_ta+$qty_ta;
                    
                     $qty_final_cs=$qty_final_cs+$qty_cs;
                        
                     $tt_qty=0;        
                     
                     $tt_qty=$qty_final+$qty_final_ta+$qty_final_cs;   
                         
            }}   }                                
            
        $data['Sl No']="";
        //$data['Date']="";
	$data['Main Category']="";
	$data['Sub Categroy']="";
	$data['Item']="";
	$data['Unit Type']="";
        $data['Portion/Weight']="";
	$data['Qty']="";
        $data['Rate']="";
	$data['Total']="";
	
        array_push($data1,$data);
        unset($data);
         
        $data['Sl No']="Total";
         // $data['Date']="";
	$data['Main Category']="";
	$data['Sub Categroy']="";
	$data['Item']="";
	$data['Unit Type']="";
        $data['Portion/Weight']="";
	$data['Qty']="";
        $data['Rate']="";
	$data['Total']=number_format(str_replace(',','',$final),$_SESSION['be_decimal']);
        array_push($data1,$data);
        unset($data);
        
    
    
}
  $filename = "Consolidated Itemordered $addon_head Report-" . $reporthead . ".xls";
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
    
    
  else if(($_REQUEST['type']=="sales_summary_report_cr"))
    {
	//$from="";
        //$to="";
        
        $string="";
        $stringtax='';
        $stringstat=" tab_complimentary!='Y'  AND ";
        $stringstatdi=" bm_complimentary!='Y' AND ";
        $stringta="";
        $stringcs="";
        $stringhd="";
        $stringtacshd='';
        //$strings="";
	$reporthead="";
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
                        $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringtacshd.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
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
                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
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
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
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
		$st= " Last 5 days ";
		$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
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
                
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
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
                
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
               $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
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
		$st= " Today ";
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
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringtacshd.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                
                $string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringtax.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringcs.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringhd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
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
		$st= " Last 6 months "; 
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
                        $stringtax.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringcs.=" tab_dayclosedate between '".$from."' and '".$to."' ";
                        $stringhd.=" tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			$string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
                
                
	}
        }
        
        
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_status FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
	     $servicetax_stats='Y';
	  }
	
   $data=array();
   $data1=array();
   $final=0;
   $srvtx=0;
   $subtotal=0;
   $subtotalta=0;
   $subtotalcs=0;
   $subtotalhd=0;
   $salesinctaxtacshd=0;
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

   $uae_subtotal=0; 
   $uae_subtotal_ta=0;
   $uae_subtotal_hd=0; 
   $uae_subtotal_cs=0;

$sql_login  =  $database->mysqlQuery("select sum(bm_taxable_amount) as uae_subtotal,sum(bm_finaltotal) as tot, (sum(bm_subtotal)-(sum(bm_discountvalue)+sum(bm_redeem_amount))) as totexcl,sum(bm_roundoff_value) as totroundof,sum(bm_tax_exempt) as taxexempt FROM tbl_tablebillmaster bm left join tbl_floormaster tf on tf.fr_floorid=bm.bm_floorid where  $stringstatdi $string "); 
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
          } } }
          
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
          } } } 
          
              $sql_logincs  =  $database->mysqlQuery("select sum(tab_taxable_amount) as uae_subtotal,sum(tab_netamt) as tot,sum(tab_tax_exempt) as taxexempt, (sum(tab_subtotal)-(sum(tab_discountvalue)+sum(tab_redeem_amount))) as totexcl FROM tbl_takeaway_billmaster where $stringstat  $stringcs"); 
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
			} } }
                         
            $sql_logintacshd  =  $database->mysqlQuery("select sum(tab_netamt) as tot,sum(tab_roundoff_value) as totroundof FROM tbl_takeaway_billmaster where  $stringstat $stringtacshd"); 
          $num_logintacshd   = $database->mysqlNumRows($sql_logintacshd);
	  if($num_logintacshd){
		  while($result_logintacshd  = $database->mysqlFetchArray($sql_logintacshd)) 
			{ 
                            if($result_logintacshd['tot'] != "")	{
                            
                            
                            $roundoftacshd=$roundoftacshd+ $result_logintacshd['totroundof'];
          }}}
          
          
          
          $totroundofff=$roundoftacshd+$roundof;
         
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
             
                           }
           //takeaway taxes end//
           
          
                   $data['Type']="SALES SUMMARY [Incl Tax]";
                    $data['Value']="";
                    array_push($data1,$data);
                    unset($data);
 
          if($subtotal!=0)
          {
                $data['Type']="Dine in";
                $data['Value']=number_format($subtotal,$_SESSION['be_decimal']);
                          
                array_push($data1,$data);
                unset($data);
            
          }
  
          
          if($subtotalta!=0)
          {
              
                 $data['Type']="Take Away";
                 $data['Value']=number_format($subtotalta,$_SESSION['be_decimal']);
                 array_push($data1,$data);
                 unset($data);
              
             }
            
        
          if($subtotalcs!=0)
          {
                $data['Type']="Counter Sale";
                $data['Value']=number_format($subtotalcs,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);   
         
          
          }  
            
           
            if($subtotalhd!=0)
            {
                $data['Type']="Home Delivery";
                $data['Value']=number_format($subtotalhd,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data); 
               
            }
                
                $data['Type']="";
                $data['Value']="";
                array_push($data1,$data);
                unset($data); 
                
		$total=$subtotal + $subtotalta+$subtotalcs+$subtotalhd;
                
		$data['Type']="Total Summary";
                $data['Value']=number_format($total,$_SESSION['be_decimal']);
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
   
                 $data['Type']="";
                $data['Value']="";
                array_push($data1,$data);
                unset($data); 
                
            if($salesexcltaxdi!=0)
                {
                
                  $data['Type']="Dine-In Sales Excl. Tax";
                  
            if($_SESSION['uae_tax_enable']=='Y'){
                  
                    $data['Value']=number_format($uae_subtotal,$_SESSION['be_decimal']);
            }else{
                $data['Value']=number_format($salesexcltaxdi,$_SESSION['be_decimal']);
            }    
                    
                    
                    array_push($data1,$data);
                    unset($data);
            
            
            
               }
               if($taxexemptdi!=0)
                {
            
                    $data['Type']="Tax Exempted Amount-DI";
                    $data['Value']=number_format($taxexemptdi,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
               }
            
            $roundof1="";
            
            $roundof12="";
            $tax_value=array();
            $ta_tax_valueta=0;
            $ta_tax_valuecs=0;
            $ta_tax_valuehd=0;
            $sql_login5  =  $database->mysqlQuery("select tetm.bem_taxid,sum(tetm.bem_total_value) as tax_sum,tetm.bem_label  FROM tbl_tablebill_extra_tax_master tetm 
                                                   left join tbl_tablebillmaster bm on bm.bm_billno=tetm.bem_billno
                                                   where  $stringstatdi $string group by tetm.bem_taxid "); 
           $di_tax_sum=0;
            $num_login5   = $database->mysqlNumRows($sql_login5);
            if($num_login5){
                while($result_login5  = $database->mysqlFetchArray($sql_login5)) 
                    {   
			$di_tax_sum=$di_tax_sum+$result_login5['tax_sum'];
                        
                    $data['Type']="Dine-In ".$result_login5['bem_label'];
                    $data['Value']=number_format($result_login5['tax_sum'],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                }
            }
             
                $data['Type']="";
                $data['Value']="";
                array_push($data1,$data);
                unset($data); 
                
            if($salesexcltaxta!=0)
            {
                   $data['Type']="Take Away Sales Excl. Tax";
                    if($_SESSION['uae_tax_enable']=='Y'){
                  
                    $data['Value']=number_format($uae_subtotal_ta,$_SESSION['be_decimal']);
            }else{
                   $data['Value']=number_format($salesexcltaxta,$_SESSION['be_decimal']);
            }
                   array_push($data1,$data);
                   unset($data);
              
            }
            if($taxexemptta!=0)
                {
            
                    $data['Type']="Tax Exempted Amount-TA";
                    $data['Value']=number_format($taxexemptta,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
               }
               
               if(array_key_exists('TA', $ta_tax_value)){
            for($s=0;$s<count($ta_tax_value['TA']['label']);$s++){
            $ta_tax_valueta=$ta_tax_valueta+$ta_tax_value['TA']['value'][$s];
                $data['Type']="Take Away ".$ta_tax_value['TA']['label'][$s];
                    $data['Value']=number_format($ta_tax_value['TA']['value'][$s],$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
              
            }
               }
               
                $data['Type']="";
                $data['Value']="";
                array_push($data1,$data);
                unset($data); 
               
         if($salesexcltaxcs!=0)
            {
                    $data['Type']="Counter Sale Sales Excl. Tax";
                     if($_SESSION['uae_tax_enable']=='Y'){
                  
                    $data['Value']=number_format($uae_subtotal_cs,$_SESSION['be_decimal']);
            }else{
                    $data['Value']=number_format($salesexcltaxcs,$_SESSION['be_decimal']);
            }
                    array_push($data1,$data);
                    unset($data);
             
            } 
          if($taxexemptcs!=0)
                {
            
                    $data['Type']="Tax Exempted Amount-CS";
                    $data['Value']=number_format($taxexemptcs,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
               }
         
  if(array_key_exists('CS', $ta_tax_value)){
            for($s=0;$s<count($ta_tax_value['CS']['label']);$s++){
            $ta_tax_valuecs=$ta_tax_valuecs+$ta_tax_value['CS']['value'][$s];
            
                $data['Type']="Counter Sale ".$ta_tax_value['CS']['label'][$s];
                $data['Value']=number_format($ta_tax_value['CS']['value'][$s],$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
            }
  }
            
   $data['Type']="";
                $data['Value']="";
                array_push($data1,$data);
                unset($data); 
  
          if($salesexcltaxhd!=0)
            {
              
                    $data['Type']="Home Delivery Sales Excl. Tax";
                     if($_SESSION['uae_tax_enable']=='Y'){
                  
                    $data['Value']=number_format($uae_subtotal_hd,$_SESSION['be_decimal']);
            }else{
                    $data['Value']=number_format($salesexcltaxhd,$_SESSION['be_decimal']);
            }
                    array_push($data1,$data);
                    unset($data);
         
            }             
           if($taxexempthd!=0)
                {
            
                    $data['Type']="Tax Exempted Amount-HD";
                    $data['Value']=number_format($taxexempthd,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
               }
   if(array_key_exists('HD', $ta_tax_value)){
            for($s=0;$s<count($ta_tax_value['HD']['label']);$s++){
            $ta_tax_valuehd=$ta_tax_valuehd+$ta_tax_value['HD']['value'][$s];
            
              $data['Type']="Home Delivery ".$ta_tax_value['HD']['label'][$s];
              $data['Value']=number_format($ta_tax_value['HD']['value'][$s],$_SESSION['be_decimal']);
              array_push($data1,$data);
              unset($data);
            }
   }

    $data['Type']="";
                $data['Value']="";
                array_push($data1,$data);
                unset($data); 
   
   
             if($totroundofff!=0)
            {
                 $data['Type']="Round Off  (Total)";
                    $data['Value']=number_format($totroundofff,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
             } 
             
                    $data['Type']="";
                    $data['Value']="";
                    array_push($data1,$data);
                    unset($data);
             
                    
                   
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
                  
               $data['Type']="Home Delivery Charge";
                    $data['Value']=number_format($del,$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                     
                    
                    $data['Type']="";
                    $data['Value']="";
                    array_push($data1,$data);
                    unset($data);
                    
      } 
                    
                    
                    
                    
                   $data['Type']="Sales Inc.Tax";
                    if($_SESSION['uae_tax_enable']=='Y'){
                  
                    $data['Value']=number_format($total,$_SESSION['be_decimal']);
            }else{
                    $data['Value']=number_format(str_replace(',','',$salesexcltaxdi+$salesexcltaxta+$salesexcltaxcs+$salesexcltaxhd+$ta_tax_valueta+$ta_tax_valuecs+$ta_tax_valuehd+$di_tax_sum+$totroundofff+$del),$_SESSION['be_decimal']);
            }
                    array_push($data1,$data);
                    
                    
                    
                    $filename = " Consolidated Sales Summary Report-" . $reporthead . ".xls";
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
 


  else if(($_REQUEST['type']=="summary_report_cr"))
{       
        //$from="";
        //$to="";
       $stringbnk_dt_di='';
        $stringbnk_dt_ta='';
	$stringvp='';
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
                         $stringcrd.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'  or  tbm.tab_dayclosedate between '".$from."' and '".$to."' ) ";
                          
                          $stringbnk_dt_di.= " bm_dayclosedate between '".$from."' and '".$to."' ";  
          
                           $stringbnk_dt_ta.= " tab_dayclosedate between '".$from."' and '".$to."' "; 
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
                           $stringcrd.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'  or  tbm.tab_dayclosedate between '".$from."' and '".$to."' ) "; 
                           
                           $stringbnk_dt_di.= " bm_dayclosedate between '".$from."' and '".$to."' ";  
          
                           $stringbnk_dt_ta.= " tab_dayclosedate between '".$from."' and '".$to."' "; 
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
		$st= " Last 5 days ";
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
		$st= " Last 10 days ";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                   $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  10  DAY AND CURDATE( )";
                   $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( ) ) ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
                   $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  15  DAY AND CURDATE( )";
                    $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( ) ) ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
                   $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  20 DAY AND CURDATE( )";
                   $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( ) ) ";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
                   $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  25  DAY AND CURDATE( )";
		$st= " Last 25 days ";
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ";
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( ) ) ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
                   $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  30  DAY AND CURDATE( )";
		$st= " Last 30 days ";
                 $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ";  
           $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) ) ";
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( ) "; 
	}
	else if($bydatz=="Today")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
                   $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL  0  DAY AND CURDATE( )";
		$st= " Today ";
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) "; 
                 $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )  or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) ) ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day ";
                $stringtacshd.=" tab_dayclosedate = CURDATE() - INTERVAL 1 day ";
		$string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
                $string_credit_settle.="cdp_dayclosedate = CURDATE( ) - INTERVAL 1  DAY ";
                  $stringvp.= " vp_dayclose_date = CURDATE( ) - INTERVAL  1  DAY ";
		$st= " Yesterday ";
                $stringbnk_dt_di.= " bm_dayclosedate = CURDATE() - INTERVAL 1 DAY ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                 $stringcrd.= "(bm.bm_dayclosedate = CURDATE( ) - INTERVAL 1    or  tbm.tab_dayclosedate = CURDATE( ) - INTERVAL 1  DAY ) ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$stringtacshd.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                  $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$st= " Last 1 month ";
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH   AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH   AND CURDATE( ) ";
                 
                  $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH   AND CURDATE( )   or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  1 MONTH   AND CURDATE( ) ) ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                  $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH   AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH   AND CURDATE( ) ";
                  $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH   AND CURDATE( )   or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  3 MONTH   AND CURDATE( ) ) ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH   AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH   AND CURDATE( ) ";
                  $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH   AND CURDATE( )   or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  6 MONTH   AND CURDATE( ) ) ";
	}
	else if($bydatz=="Last365days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$stringtacshd.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $string_credit_settle.="cdp_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringvp.= " vp_dayclose_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$st= " Last 1 year "; 
                $stringbnk_dt_di.= " bm_dayclosedate between CURDATE( ) - INTERVAL 1  YEAR   AND CURDATE( ) ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between CURDATE( ) - INTERVAL 1  YEAR   AND CURDATE( ) ";
                  $stringcrd.= "(bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR   AND CURDATE( )   or  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  1 YEAR   AND CURDATE( ) ) ";
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
			$string_credit_settle.="cdp_dayclosedate between '".$from."' and '".$to."'";
                        $string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
                        $stringvp.= " vp_dayclose_date between '".$from."' and '".$to."'";
                        $stringbnk_dt_di.= " bm_dayclosedate between '".$from."' and '".$to."' ";  
          
                 $stringbnk_dt_ta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                  $stringcrd.= "(bm.bm_dayclosedate between '".$from."' and '".$to."'   or  tbm.tab_dayclosedate between '".$from."' and '".$to."'  ) ";
	}
	
	}

	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_status FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
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
//echo "select $string1_str from tbl_tablebillmaster where $string1"."$string order by bm_dayclosedate,bm_billtime ASC";



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
   $num_logincashta   = $database->mysqlNumRows($sql_logincashta);
	  if($num_logincashta){
		  while($result_logincashta  = $database->mysqlFetchArray($sql_logincashta)) 
			{ 
				if($result_logincashta['tot'] != "")	{
			$subtotalcashta =$subtotalcashta + $result_logincashta['tot'];
                        $roundofta=$roundofta+$result_logincashta['roundofta'];
          }}} 
          $totalcash=$subtotalcash+$subtotalcashta+$roundofdi+$roundofta;
          
          
        $data['Type']="";
	$data['Value']="";
        array_push($data1,$data);
        unset($data);
          
        if($totalcash!=0)
            {   
                $data['Type']="CASH SALE";
                $data['Value']=number_format($totalcash,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
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
                $data['Type']="CARD SALE ";
                $data['Value']=number_format($totalcredit,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
                
                
                
                
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
                                                    )x where x.bnk !=''  group by x.bnk"); 
	  $num_logincredit   = $database->mysqlNumRows($sql_logincredit);
	  if($num_logincredit){
		  while($result_logincredit  = $database->mysqlFetchArray($sql_logincredit)) 
			{
                      
                    $data['Type']='* '.$result_logincredit['bnk'];
                $data['Value']=number_format($result_logincredit['total'],$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
        
            }}
          
                       
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
                $data['Type']="COUPONS SALE";
                $data['Value']=number_format($totalcoupon,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);

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
                  $data['Type']="VOUCHER SALE";
                  $data['Value']=number_format($totalvoucher,$_SESSION['be_decimal']);
                  array_push($data1,$data);
                  unset($data);
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
                  $data['Type']="CHEQUE";
                  $data['Value']=number_format($totalcheque,$_SESSION['be_decimal']);
                  array_push($data1,$data);
                  unset($data);

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
                  $data['Type']="CREDITS SALE";
                  $data['Value']=number_format($totalcp,$_SESSION['be_decimal']);
                  array_push($data1,$data);
                  unset($data);
                  
                  
                  
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
				
                                    
            
          
                      $data['Type']='* '.$party;
                  $data['Value']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                  array_push($data1,$data);
                  unset($data);          
                        
                                            
                              	
					$i++;
                         }}         
                        
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
                     
                       $data['Type']="COMPLIMENTARY";
                       $data['Value']=number_format($totalcomp,$_SESSION['be_decimal']);
                       array_push($data1,$data);
                       unset($data);
 
                    }	
                $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		   
	$num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
                                
                                $data['Type']="";
                                $data['Value']="";
                                array_push($data1,$data);
                                unset($data);
                        }} 
                  $finaltotal=$totalcash+$totalcredit+$totalcoupon+$totalvoucher+$totalcheque+$totalcp;
                  
                  
                  
                  ///taxcalc///////
                                         
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
                      
                      
                        $data['Type']="TOTAL (exclusive tax)";
                                $data['Value']=number_format($finaltotal_excl,$_SESSION['be_decimal']);
                                array_push($data1,$data);
                                unset($data);
                                
                                $data['Type']="Tax Amount(".$tax_name_val."%)";
                                $data['Value']=number_format($all_tax_show,$_SESSION['be_decimal']);
                                array_push($data1,$data);
                                unset($data);
                     
   
                            
                                $data['Type']="";
                                $data['Value']="";
                                array_push($data1,$data);
                                unset($data);
                                
                                $data['Type']="TOTAL(inclusive tax)";
                                $data['Value']=number_format($finaltotal,$_SESSION['be_decimal']);
                                array_push($data1,$data);
                                unset($data);
                                
                                $data['Type']="";
                                $data['Value']='';
                                array_push($data1,$data);
                                unset($data);
                                
                                $creditcash_settle=0;
        $creditcard_settle=0;
	$sql_creditsettlemt  =  $database->mysqlQuery("select sum(cdp_paid_cash - cdp_balance) as settled_cash, sum(cdp_transaction_amount) as settled_card FROM tbl_credit_details_payment
                                                        where $string_credit_settle "); 

	$num_creditsettlemt   = $database->mysqlNumRows($sql_creditsettlemt);
	  if($num_creditsettlemt){
                
                    $data['Type']="Credit Settlement Income";
                    $data['Value']='';
                    array_push($data1,$data);
                    unset($data);
              
		  while($result_creditsettlemt  = $database->mysqlFetchArray($sql_creditsettlemt)) 
			{
				$creditcash_settle=$result_creditsettlemt['settled_cash'];
                                $creditcard_settle=$result_creditsettlemt['settled_card'];
                        }}
                if($creditcash_settle>0){
                    $data['Type']="Cash Settle";
                    $data['Value']=number_format(str_replace(',','',$creditcash_settle),$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                     
                    }
                    if($creditcard_settle>0){
                        $data['Type']="Card Settle";
                    $data['Value']=number_format(str_replace(',','',$creditcard_settle),$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    }
                    
                    $data['Type']="";
                    $data['Value']='';
                    array_push($data1,$data);
                    unset($data);
                    
                    $data['Type']="SETTLEMENT TOTAL";
                    $data['Value']=number_format(str_replace(',','',($creditcard_settle+$creditcash_settle)),$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);
                    
                    $sql_login_loy12  =  $database->mysqlQuery("select sum(vp_amount) as expense FROM tbl_voucherpayment where vp_status='Approved' and $stringvp "); 
       
	  $num_login_loy12   = $database->mysqlNumRows($sql_login_loy12);
	  if($num_login_loy12){ 
         
		  while($result_login_loy12 = $database->mysqlFetchArray($sql_login_loy12)) 
			{   
			 
                     $voucher_expense=  $result_login_loy12['expense'];
                    
                      
          }
          }   
                    if($voucher_expense>0){
                 $data['Type']=" TOTAL EXPENSE";
                    $data['Value']=number_format(str_replace(',','',($voucher_expense)),$_SESSION['be_decimal']);
                    array_push($data1,$data);
                    unset($data);   
                    }
                    
                    
                    
     $filename = " Consolidated Sumamry Report-" . $reporthead . ".xls";
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
     
else if(($_REQUEST['type']=="total_summary_details_cr"))
        {
            $from="";
            $to="";
	$string="";
        $stringta="";
	$reporthead="";
	$strings=" bm_status='Closed' AND ";
        $stringsta=" tab_status='Closed' AND tab_mode!='CS' AND  ";
        $stringscs=" tab_status='Closed' AND tab_mode='CS' AND";
        //$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
        $string1_strta=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
        $string2_strta=" sum(tab_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
        $string3_strta=" sum(tab_netamt) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_chequebankamount) ";
	$string6_str=" sum(cd_amount)";
	$string7_str=" sum(bm_finaltotal)";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
        $view_mode='';
	$view_mode=$_REQUEST['modeofview'];
	//	$string1 =$strings. " pym_code='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string1 =" ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
		$string3 =" pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =" pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =" pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
                $string6=" pym_code='credit_person' AND ";
                $string7=" pym_code='complimentary' AND";
	

		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        
			$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
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
          
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day AND CURDATE( )";
                $stringta.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY  AND CURDATE( )";
		$string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day AND CURDATE( )";
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH AND CURDATE( )";
		$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
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
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			$string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
	}
	
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_status FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	

   
          
$data=array();
$data1=array();
if($view_mode=='detailed'){
 $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotalta=0;
  $subtotalcs=0;
  $subtotal1=0;
  $totalcash=0;
  $totalcashta=0;
  $totalcashcs=0;
  $totalcouponsta=0;
  $totalcoupons=0;
  $totalvoucher=0;
  $totalvoucherta=0;
  $totalcheque=0;
   $totalchequeta=0;
  $totalcredits=0;
  $totalcreditsta=0;
  $totalcomplimentary=0;
  $totalcomplimentaryta=0;
  $totalpax=0;
  $totalcreditordebit=0;
  $totalcreditordebitta=0;
  $slno=0;
  $slnota=0;
  $totalta="";
  
  $totalvouchercs=0;
  $totalchequecs=0;
  //$totalcredits=0;
  $totalcreditscs=0;
  $totalcouponscs=0;
  //$totalcomplimentary=0;
  $totalcomplimentarycs=0;
  $totalpax=0;
  //$totalcreditordebit=0;
  $totalcreditordebitcs=0;
  
  $slnocs=0;
  $totalcs="";
            $data['Slno']="";
            $data['Date']="";
            $data['Cash']="";
            $data['Credit/Debit']="";
            $data['Coupons']="";
            $data['Voucher']="Dine In";
            $data['Cheque']="";
            $data['Credits']="";
            $data['Complimentary']="";
            $data['Pax']="";
            $data['Total']="";
            array_push($data1,$data);
            unset($data);
  
  $sql = $database->mysqlQuery("select distinct(bm_dayclosedate) from tbl_tablebillmaster where $string_pax");
  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
        
        
        $total=0;
          $slno++;
        if($result != ""){
           
            
            $data['Slno']=$slno;
            $data['Date']=$result['bm_dayclosedate'];
                                
            $dt = " bm_dayclosedate='".$result['bm_dayclosedate']."'";
        }
  

  

  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string1"."$dt order by bm_dayclosedate,bm_billtime ASC"); 
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
$sql_login1  =  $database->mysqlQuery("select $string2_str as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $strings $string2 "."$dt order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
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
		 					
	$sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string3"." $dt order by bm_dayclosedate,bm_billtime ASC"); 			
	$num_login   = $database->mysqlNumRows($sql_login);
          
	  if($num_login){
		  $result_login2  = $database->mysqlFetchArray($sql_login);
			                     				
			if($result_login2['tot'] != "")	{				
				$totalcoupons= $totalcoupons + $result_login2['tot'];
                                $total= $total + $result_login2['tot'];       
                                $subtotal =$subtotal + $result_login2['tot'];	

                                $data['Coupons']==number_format($result_login2['tot'],$_SESSION['be_decimal']);

			}
                         else{
              $data['Coupons']="--";
          }
                         }else{
              $data['Coupons']="--";
          }
                      
			
$sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string4"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
			
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login3  = $database->mysqlFetchArray($sql_login); 
			 
				if($result_login3['tot'] != "")
			{
			$totalvoucher=$totalvoucher + $result_login3['tot'];
                        $total= $total + $result_login3['tot'];       
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
			
	$sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string5"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
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
			
			
				
	$sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_credit_details tcd on tcd.cd_billno=tbl_tablebillmaster.bm_billno left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string6"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
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
				
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string7"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login6  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_login6['tot'] != "")
			{
			
                        $totalcomplimentary= $totalcomplimentary + $result_login6['tot'];    
                        //$total= $total + $result_login6['tot'];     
                        //$subtotal =$subtotal + $result_login6['tot'];
			
          
        $data['Complimentary']=number_format($result_login6['tot'],$_SESSION['be_decimal']);
         
                      } 
                         else{
              $data['Complimentary']="--";
          }
                        }
            else{
              $data['Complimentary']="--";
          }
			 $qtycount=0;
	$sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax and $dt"); 
	$num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  $result_stw  = $database->mysqlFetchArray($sql_stw); 
			
                            
                            $qtycount=$qtycount + $result_stw['ct'];
                            $totalpax = $totalpax + $result_stw['ct'];
			
           
                
                
                $data['Pax']=$result_stw['ct'];
              
	  }
          else{
             $data['Pax']="--";
          }
 
        $data['Total']=$total;
                    array_push($data1,$data);
                    unset($data);
  }
  }
  $data['Slno']="TOTAL - DI";
  $data['Date']=$reporthead;
  $data['Cash']=$totalcash;
  $data['Credit/Debit']=$totalcreditordebit;
  $data['Coupons']=$totalcoupons;
  $data['Voucher']=$totalvoucher;
  $data['Cheque']=$totalcheque;
  $data['Credits']=$totalcredits;
  $data['Complimentary']=$totalcomplimentary;
  $data['Pax']=$totalpax;
  $data['Total']=$subtotal;
  array_push($data1,$data);
   unset($data);

            $data['Slno']="";
            $data['Date']="";
            $data['Cash']="";
            $data['Credit/Debit']="";
            $data['Coupons']="";
            $data['Voucher']="Take Away/Home Delivery";
            $data['Cheque']="";
            $data['Credits']="";
            $data['Complimentary']="";
            $data['Pax']="";
            $data['Total']="";
           array_push($data1,$data);
            unset($data);
      
      

    $sql = $database->mysqlQuery("select distinct(tab_dayclosedate) from tbl_takeaway_billmaster where $stringta");
$num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
         
        $totalta=0;
          $slnota++;
        if($result != ""){
           
            $data['Slno']=$slnota;
            $data['Date']=$result['tab_dayclosedate'];
            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
        }

  

  $sql_login  =  $database->mysqlQuery("select $string1_strta  as tot 
from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
where $stringsta $string1 $dt order by tab_dayclosedate,tab_time ASC"); 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_logincashta  = $database->mysqlFetchArray($sql_login);
			
		if($result_logincashta['tot'] != "")	{
                                    
                        $totalcashta=$totalcashta + $result_logincashta['tot'];
                        $totalta= $totalta + $result_logincashta['tot'];            
			$subtotalta =$subtotalta + $result_logincashta['tot'];
 
                        
         $data['Cash']=number_format($result_logincashta['tot'],$_SESSION['be_decimal']);
          
         
             
            }else{
              $data['Cash']="--";
          }}else{
              $data['Cash']="--";
          }
          

	$sql_login1  =  $database->mysqlQuery("select $string2_strta as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $stringsta "." $string2 "."$dt  order by tb.tab_dayclosedate,tb.tab_time ASC ");
$num_login1   = $database->mysqlNumRows($sql_login1);
	
	  if($num_login1){
		  $result_logincreditta  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebitta=$totalcreditordebitta + $result_logincreditta['tot'];  
			$totalta= $totalta + $result_logincreditta['tot'];       
			$subtotalta =$subtotalta + $result_logincreditta['tot'];
                      
		
            
            $data['Credit/Debit']=number_format($result_logincreditta['tot'],$_SESSION['be_decimal']);
 	  }else{
             $data['Credit/Debit']="--";
          }
          
          $sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string3"." $dt order by tab_dayclosedate,tab_time ASC");
      
          
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincouponta  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_logincouponta['tot'] != "")
			{
			$totalta= $totalta + $result_logincouponta['tot'];
                        $totalcouponsta= $totalcouponsta + $result_logincouponta['tot'];    
                        $subtotalta =$subtotalta + $result_logincouponta['tot'];
			
          
       $data['Coupons']=number_format($result_logincouponta['tot'],$_SESSION['be_decimal']);
         
                } 
                         else{
              $data['Coupons']="--";
          }
                        }
            else{
              $data['Coupons']="--";
          }
          
          
          
          
          $sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string4"." $dt order by tab_dayclosedate,tab_time ASC");
           
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_loginvoucherta  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_loginvoucherta['tot'] != "")
			{
			$totalta= $totalta + $result_loginvoucherta['tot'];
                        $totalvoucherta= $totalvoucherta + $result_loginvoucherta['tot'];    
                        $subtotalta =$subtotalta + $result_loginvoucherta['tot'];
		
          
           $data['Voucher']=number_format($result_loginvoucherta['tot'],$_SESSION['be_decimal']);
         
                 } 
                  else{
               $data['Voucher']="--";
                    }
                    }
            else{
               $data['Voucher']="--";
                }
             
          $sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string5"." $dt order by tab_dayclosedate,tab_time ASC");
          
          
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_loginchequeta  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_loginchequeta['tot'] != "")
			{
			$totalta= $totalta + $result_loginchequeta['tot'];
                        $totalchequeta= $totalchequeta + $result_loginchequeta['tot'];    
                        $subtotalta =$subtotalta + $result_loginchequeta['tot'];
		
          
           $data['Cheque']=number_format($result_loginchequeta['tot'],$_SESSION['be_decimal']);         
                     } 
                     else{
              $data['Cheque']="--";
          }
                        }
            else{
             $data['Cheque']="--";
          }
          
          
          
          
          $sql_login  =  $database->mysqlQuery("select $string6_str as tot 
                        from tbl_takeaway_billmaster tb left join tbl_credit_details tcd on tcd.cd_billno=tb.tab_billno
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string6"." $dt order by tab_dayclosedate,tab_time ASC");
                         
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincreditpersonta  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_logincreditpersonta['tot'] != "")
			{
			$totalta= $totalta + $result_logincreditpersonta['tot'];
                        $totalcreditsta= $totalcreditsta + $result_logincreditpersonta['tot'];    
                        $subtotalta =$subtotalta + $result_logincreditpersonta['tot'];
			
          
          $data['Credits']=number_format($result_logincreditpersonta['tot'],$_SESSION['be_decimal']);
         
                        } 
               else{
             $data['Credits']="--";
             }
              }
            else{
              $data['Credits']="--";
          }
		 	
			
	
				
			$sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string7"." $dt order by tab_dayclosedate,tab_time ASC");
                  
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincompta  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_logincompta['tot'] != "")
			{
			//$totalta= $totalta + $result_logincompta['tot'];
                        $totalcomplimentaryta= $totalcomplimentaryta + $result_logincompta['tot'];    
                        //$subtotalta =$subtotalta + $result_logincompta['tot'];
		
          
          $data['Complimentary']=number_format($result_logincompta['tot'],$_SESSION['be_decimal']);
         
        } 
            else{
             $data['Complimentary']="--";
             }
             }
    else{
              $data['Complimentary']="--";
        }

          $data['Pax']="--";                
 
          $data['Total']=$totalta;
                             
          array_push($data1,$data);
            unset($data);                   
                            
  }
  }
    $data['Slno']="TOTAL - TA/HD";
    $data['Date']=$reporthead;
    $data['Cash']=$totalcashta;
    $data['Credit/Debit']=$totalcreditordebitta;
    $data['Coupons']=$totalcouponsta;
    $data['Voucher']=$totalvoucherta;
    $data['Cheque']=$totalchequeta;
    $data['Credits']=$totalcreditsta;
    $data['Complimentary']=$totalcomplimentaryta;
    $data['Pax']="--";
    $data['Total']=number_format($subtotalta,$_SESSION['be_decimal']);
    
    array_push($data1,$data);
    unset($data);
 
            $data['Slno']="";
            $data['Date']="";
            $data['Cash']="";
            $data['Credit/Debit']="";
            $data['Coupons']="";
            $data['Voucher']="Counter Sale";
            $data['Cheque']="";
            $data['Credits']="";
            $data['Complimentary']="";
            $data['Pax']="";
            $data['Total']="";
            array_push($data1,$data);
            unset($data);
      $sql = $database->mysqlQuery("select distinct(tab_dayclosedate) from tbl_takeaway_billmaster where $stringta");
  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
         
        $totalta=0;
          $slnocs++;
        if($result != ""){
           
            $data['Slno']=$slnocs;
            $data['Date']=$result['tab_dayclosedate'];
            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
        }

  

  $sql_login  =  $database->mysqlQuery("select $string1_strta  as tot 
from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
where $stringscs $string1 $dt order by tab_dayclosedate,tab_time ASC"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_logincashcs  = $database->mysqlFetchArray($sql_login);
			
		if($result_logincashcs['tot'] != "")	{
                                    
                        $totalcashcs=$totalcashcs + $result_logincashcs['tot'];
                        $totalcs= $totalcs + $result_logincashcs['tot'];            
			$subtotalcs =$subtotalcs + $result_logincashcs['tot'];
                        
                        
		$data['Cash']=number_format($result_logincashcs['tot'],$_SESSION['be_decimal']);
              
             }else{
              $data['Cash']="--";
          }}else{
              $data['Cash']="--";
          }
          

	$sql_login1  =  $database->mysqlQuery("select $string2_strta as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $stringscs "." $string2 "."$dt  order by tb.tab_dayclosedate,tb.tab_time ASC ");
$num_login1   = $database->mysqlNumRows($sql_login1);
	
	  if($num_login1){
		  $result_logincreditcs  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebitcs=$totalcreditordebitcs + $result_logincreditcs['tot'];  
			$totalcs= $totalcs + $result_logincreditcs['tot'];       
			$subtotalcs =$subtotalcs + $result_logincreditcs['tot'];
                      
		
            
           $data['Credit/Debit']=number_format($result_logincreditcs['tot'],$_SESSION['be_decimal']);
            
      
			
			
	  }else{
              $data['Credit/Debit']="--";
          }
          
          $sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string3"." $dt order by tab_dayclosedate,tab_time ASC");
       
          
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincouponcs  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_logincouponcs['tot'] != "")
			{
			$totalcs= $totalcs + $result_logincouponcs['tot'];
                        $totalcouponscs= $totalcouponscs + $result_logincouponcs['tot'];    
                        $subtotalcs =$subtotalcs + $result_logincouponcs['tot'];
			
          
          $data['Coupons']=number_format($result_logincouponcs['tot'],$_SESSION['be_decimal']);         
                        } 
                         else{
              $data['Coupons']="--";
          }
                        }
            else{
              $data['Coupons']="--";
          }
          
          
          
          
          $sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string4"." $dt order by tab_dayclosedate,tab_time ASC");
          
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_loginvouchercs  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_loginvouchercs['tot'] != "")
			{
			$totalcs= $totalcs + $result_loginvouchercs['tot'];
                        $totalvouchercs= $totalvouchercs + $result_loginvouchercs['tot'];    
                        $subtotalcs =$subtotalcs + $result_loginvouchercs['tot'];
			
          
         $data['Voucher']=number_format($result_loginvouchercs['tot'],$_SESSION['be_decimal']);
         
                          } 
                         else{
              $data['Voucher']="--";
          }
                        }
            else{
              $data['Voucher']="--";
          }
           $sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string5"." $dt order by tab_dayclosedate,tab_time ASC");
         
          
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_loginchequecs  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_loginchequecs['tot'] != "")
			{
			$totalcs= $totalcs + $result_loginchequecs['tot'];
                        $totalchequecs= $totalchequecs + $result_loginchequecs['tot'];    
                        $subtotalcs =$subtotalcs + $result_loginchequecs['tot'];
			
          
          $data['Cheque']=number_format($result_loginchequecs['tot'],$_SESSION['be_decimal']);
         
                          } 
                         else{
              $data['Cheque']="--";
          }
                        }
            else{
              $data['Cheque']="--";
          }
          
          
          
          
          $sql_login  =  $database->mysqlQuery("select $string6_str as tot 
                        from tbl_takeaway_billmaster tb left join tbl_credit_details tcd on tcd.cd_billno=tb.tab_billno
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string6"." $dt order by tab_dayclosedate,tab_time ASC");
                    
          
          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincreditpersoncs  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_logincreditpersoncs['tot'] != "")
			{
			$totalcs= $totalcs + $result_logincreditpersoncs['tot'];
                        $totalcreditscs= $totalcreditscs + $result_logincreditpersoncs['tot'];    
                        $subtotalcs =$subtotalcs + $result_logincreditpersoncs['tot'];
			
          
          $data['Credits']=number_format($result_logincreditpersoncs['tot'],$_SESSION['be_decimal']);
         
                         } 
                         else{
              $data['Credits']="--";
          }
                        }
            else{
              $data['Credits']="--";
          }
		 	
			
	
				
			$sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string7"." $dt order by tab_dayclosedate,tab_time ASC");
                   
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincompcs  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_logincompcs['tot'] != "")
			{
			//$totalcs= $totalcs + $result_logincompcs['tot'];
                        $totalcomplimentarycs= $totalcomplimentarycs + $result_logincompcs['tot'];    
                        //$subtotalta =$subtotalta + $result_logincompcs['tot'];
			
          
          $data['Complimentary']=number_format($result_logincompcs['tot'],$_SESSION['be_decimal']);
         
                        } 
                         else{
              $data['Complimentary']="--";
          }
                        }
            else{
              $data['Complimentary']="--";
          }

	 
          $data['Pax']="--";                    
       
    $data['Total']=number_format($totalcs,$_SESSION['be_decimal']);
    
            array_push($data1,$data);
            unset($data);
                     
  }
  }
    
  $data['Slno']="TOTAL - CS";
  $data['Date']=$reporthead;
  $data['Cash']=number_format($totalcashcs,$_SESSION['be_decimal']);
  $data['Credit/Debit']=number_format($totalcreditordebitcs,$_SESSION['be_decimal']);
  $data['Coupons']=number_format($totalcouponscs,$_SESSION['be_decimal']);
  $data['Voucher']=number_format($totalvouchercs,$_SESSION['be_decimal']);
  $data['Cheque']=number_format($totalchequecs,$_SESSION['be_decimal']);
  $data['Credits']=number_format($totalcreditscs,$_SESSION['be_decimal']);
  $data['Complimentary']=number_format($totalcomplimentarycs,$_SESSION['be_decimal']);
  $data['Pax']="--";
  
  $data['Total']=number_format($subtotalcs,$_SESSION['be_decimal']);

            array_push($data1,$data);
            unset($data);

  
            $data['Slno']="";
            $data['Date']="";
            $data['Cash']="";
            $data['Credit/Debit']="";
            $data['Coupons']="";
            $data['Voucher']="Final Totals";
            $data['Cheque']="";
            $data['Credits']="";
            $data['Complimentary']="";
            $data['Pax']="";
            $data['Total']="";
            array_push($data1,$data);
            unset($data);

  $data['Slno']="FINAL TOTAL";
  $data['Date']=$reporthead;
  $data['Cash']=number_format(($totalcash+$totalcashta+$totalcashcs),$_SESSION['be_decimal']);
  $data['Credit/Debit']=number_format(($totalcreditordebit+$totalcreditordebitta+$totalcreditordebitcs),$_SESSION['be_decimal']);
  $data['Coupons']=number_format(($totalcoupons+$totalcouponsta+$totalcouponscs),$_SESSION['be_decimal']);
  $data['Voucher']=number_format(($totalvoucher+$totalvoucherta+$totalvouchercs),$_SESSION['be_decimal']);
  $data['Cheque']=number_format(($totalcheque+$totalchequeta+$totalchequecs),$_SESSION['be_decimal']);
  $data['Credits']=number_format(($totalcredits+$totalcreditsta+$totalcreditscs),$_SESSION['be_decimal']);
  $data['Complimentary']=number_format(($totalcomplimentary+$totalcomplimentaryta+$totalcomplimentarycs),$_SESSION['be_decimal']);
  $data['Pax']=$totalpax;
  
  $data['Total']=number_format(($subtotal+$subtotalta+$subtotalcs),$_SESSION['be_decimal']);
   
   array_push($data1,$data);
}
if($view_mode=='summary'){
	
            $payment_consolidated=array();
            $consolidated_final=0;
            
            $each_module_sum=array();
            $sql_summary  =  $database->mysqlQuery("select x.mode,sum(x.total) as total, x.dayclosedate from ( 
                                                    select 'DI' AS mode,bm.bm_finaltotal as total, bm.bm_dayclosedate as dayclosedate  FROM tbl_tablebillmaster bm  where bm.bm_status='Closed' and bm.bm_complimentary!='Y' and $string  union all
                                                    select bm.tab_mode as mode, bm.tab_netamt as total,bm.tab_dayclosedate as dayclosedate FROM tbl_takeaway_billmaster bm where bm.tab_status='Closed' and bm.tab_complimentary!='Y' and bm.tab_payment_settled='Y' and $stringta
                                                    )x group by x.mode, x.dayclosedate order by x.dayclosedate asc "); 
            $num_summary  = $database->mysqlNumRows($sql_summary);
            if($num_summary){
                while($result_summary  = $database->mysqlFetchArray($sql_summary)){
                    $payment_consolidated[$result_summary['dayclosedate']][$result_summary['mode']]=$result_summary['total'];
                }
                foreach($payment_consolidated as $key=>$val){
                    $each_day_final=0;
                    $data['DATE']=$key;
                    if(array_key_exists("DI",$val)){
                        $each_day_final=$each_day_final+$val['DI'];
                        $each_module_sum['DI'][]=$val['DI'];
                        $data['DI']=number_format($val['DI'],$_SESSION['be_decimal']);
                    }
                    else{ 
                        $each_module_sum['DI'][]=0;
                        $data['DI']=number_format(0,$_SESSION['be_decimal']) ;
                    }
                    if(array_key_exists("TA",$val)){
                        $each_day_final=$each_day_final+$val['TA'];
                        $each_module_sum['TA'][]=$val['TA'];
                        $data['TA']=number_format($val['TA'],$_SESSION['be_decimal']);
                    }
                    else{
                        $each_module_sum['TA'][]=0;
                        $data['TA']=number_format(0,$_SESSION['be_decimal']) ;
                    }
                    if(array_key_exists("CS",$val)){
                        $each_day_final=$each_day_final+$val['CS'];
                        $each_module_sum['CS'][]=$val['CS'];
                        $data['CS']=number_format($val['CS'],$_SESSION['be_decimal']);
                    }
                    else{
                        $each_module_sum['CS'][]=0;
                        $data['CS']=number_format(0,$_SESSION['be_decimal']) ;
                    }
                    if(array_key_exists("HD",$val)){
                        $each_day_final=$each_day_final+$val['HD'];
                        $each_module_sum['HD'][]=$val['HD'];
                        $data['HD']=number_format($val['HD'],$_SESSION['be_decimal']);
                    }
                    else{
                        $each_module_sum['HD'][]=0;
                        $data['HD']=number_format(0,$_SESSION['be_decimal']) ;
                    }
                    $consolidated_final=$consolidated_final+$each_day_final;
                    $data['DATE-TOTAL']=number_format($each_day_final,$_SESSION['be_decimal']);
                    
                    array_push($data1,$data);
                    unset($data);
                }
                $data['DATE']='TOTAL';
                $data['DI']         =number_format(array_sum($each_module_sum['DI']),$_SESSION['be_decimal']);
                $data['TA']         =number_format(array_sum($each_module_sum['TA']),$_SESSION['be_decimal']);
                $data['CS']         =number_format(array_sum($each_module_sum['CS']),$_SESSION['be_decimal']);
                $data['HD']         =number_format(array_sum($each_module_sum['HD']),$_SESSION['be_decimal']);
                $data['DATE-TOTAL'] =number_format($consolidated_final,$_SESSION['be_decimal']);
                
                array_push($data1,$data);
                unset($data);
            }
            
    }
 $filename = " Consolidated  Total Sumamry Report-" . $reporthead . ".xls";
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

 else if(($_REQUEST['type']=="voucher_expense"))
        {
        //$from="";
        //$to='';
        $string='';
        $voucher=$_REQUEST['voucher'];
         $vouch_login=$_REQUEST['voucher_login'];
        if($voucher!="")
        {
        
            $vouchername="vh_vouchername='".$voucher."' AND";
        }
        else
        {
          $vouchername="";  
        }
        $voucher1=$_REQUEST['voucher1'];
         if($voucher1!="")
        {
        
            $vouchertype="vp_type='".$voucher1."' AND ";
        } 
        else
        {
          $vouchertype="";  
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
                
		$st= " Last 5 days ";
		
	}elseif($bydatz=="Last10days")
	{
		$string.=" vp_dayclose_date between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                
		
		$st= " Last 10 days ";
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
		
                
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" vp_dayclose_date = CURDATE() - INTERVAL 1 day";
               
		
		$st= " Yesterday ";
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
        $data=array();
        $data1=array();
        $i=0;
        $amt='';
    		   $sql_login  =  $database->mysqlQuery("select vp_id,vp_date,vh_vouchername,vp_type,vp_status,vp_paymentmode,
                       vp_amount,vp_paidto,vp_receivedby,vp_chequebank,vp_chequebranch,vp_chequeleafno,ser_firstname,vp_approveddate,
                       vp_add_remark,be_branchname from tbl_voucherpayment left join tbl_voucherhead on vh_id=vp_vhid left join tbl_branchmaster on be_branchid=vp_branchid left join tbl_staffmaster on ser_staffid=vp_approvedby where vp_status='Approved' and $vouchername $vouchertype $vp_approve  $string");
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
                            $amount=number_format($result_login['vp_amount'],$_SESSION['be_decimal']);
                            $paidto=$result_login['vp_paidto'];
                            $receivedby=$result_login['vp_receivedby'];
                            $chequebankname=$result_login['vp_chequebank'];
                            $chequebranchname=$result_login['vp_chequebranch'];
                            $chequeleafnumber=$result_login['vp_chequeleafno'];
                            $approvedby=$result_login['ser_firstname'];
                            $approveddatetime=$result_login['vp_approveddate'];
                            $approvedremark=$result_login['vp_add_remark'];
                            $branchname=$result_login['be_branchname'];
                            
                            $date=date("d-m-Y",strtotime($datetime));
                            $time=date("H:i:s",strtotime($datetime));
                            $approveddate=date("d-m-Y",strtotime($approveddatetime));
                            $approvedtime=date("H:i:s",strtotime($approveddatetime));

          $amt=$amt+number_format($result_login['vp_amount'],$_SESSION['be_decimal']);
       
                        $data['Slno']=$i;
                        $data['Voucher Id']=$voucherid;
                        $data['Date']=$date;
                        $data['Time']=$time;
                        $data['Voucher Head']=$vouchername;
                        $data['Type']=$type;
                        $data['Status']=$status;
                        $data['Mode Of Payments']=$modeofpayment;
                       
                        $data['Paid To']=$paidto;
                        $data['Received']=$receivedby;
                       
                        $data['Approved By']=$approvedby;
                        $data['Approved Date']=$approveddate;
                        $data['Approved Time']=$approvedtime;
                        $data['Add Remark']=$approvedremark;
                        $data['Amount']=number_format(str_replace(',','',$amount),$_SESSION['be_decimal']);
                        array_push($data1,$data);
                        unset($data);
                                   
        } } 
       
                        $data['Slno']="Total";
                        $data[' Id']='';
                        $data['Date']='';
                        $data['Time']='';
                        $data['Voucher Head']='';
                        $data['Type']='';
                        $data['Status']='';
                        $data['Mode Of Payments']='';
                     
                        $data['Paid To']='';
                        $data['Received']='';
                                                                  
                        $data['Approved By']='';
                        $data['Approved Date']='';
                        $data['Approved Time']='';
                        $data['Approved Remark']='';
                       
                           $data['Amount']=$amt;
                        array_push($data1,$data);
                        unset($data);
        
            
 $filename = " Voucher Expence Report-" . $reporthead . ".xls";
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
else if(($_REQUEST['type']=="expense_acc_report"))
{       
    
    	
	$string="";
        $stringev="";
        $stringsu="";
        $stringln="";
        $stringasp="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " ev_date between '".$from."' and '".$to."' ";
                        $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
                        $stringln.= "tla_date between '".$from."' and '".$to."' ";
                        $stringev.= " ev_date between '".$from."' and '".$to."' ";
                        $stringsu.= " sv_date between '".$from."' and '".$to."' ";
                        $reporthead.= $from.' - '.$to;
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " ev_date between '".$from."' and '".$to."' ";
                        $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
                        $stringln.= "tla_date between '".$from."' and '".$to."' ";
                        $stringev.= " ev_date between '".$from."' and '".$to."' ";
                        $stringsu.= " sv_date between '".$from."' and '".$to."' ";
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
	
	if($bydatz=="Last5days")
	{
		$string.=" ev_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";               
                $stringev.=" ev_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";                
                $stringsu.=" sv_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringln.= "tla_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )"; 
                $reporthead.= "Last 5 days";
                
	}elseif($bydatz=="Last10days")
	{
		$string.=" ev_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";                
                $stringev.=" ev_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringsu.=" ev_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringln.= "tla_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $reporthead.= "Last 10 days";      
	}
	else if($bydatz=="Yesterday")
	{
	        $string.=" ev_date = CURDATE() - INTERVAL 1 day";
                $stringev.=" ev_date = CURDATE() - INTERVAL 1 day";
                $stringsu.=" sv_date = CURDATE() - INTERVAL 1 day";
                $stringasp.=" tpd_date = CURDATE() - INTERVAL 1 day";
                $stringln.=" tla_date = CURDATE() - INTERVAL 1 day";
                $reporthead.= "Yesterday";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" ev_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringev.=" ev_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringsu.=" sv_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringln.= "tla_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )"; 
                $reporthead.= "Last 15 days"; 
	}
	else if($bydatz=="Last20days")
	{
		$string.=" ev_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";              
                $stringev.=" ev_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";               
                $stringsu.=" sv_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )"; 
                $stringln.= "tla_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )"; 
                $reporthead.= "Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringev.="ev_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringasp.="tpd_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )"; 
                $stringln.= "tla_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )"; 
                $reporthead.= "Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringev.="ev_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringasp.="tpd_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )"; 
                $stringln.= "tla_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )"; 
                $reporthead.= "Last 30 days";
	}
	 else if($bydatz=="Last1month")
        {
	        $string.="ev_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $stringev.="ev_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $stringsu.=" sv_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                $stringln.= "tla_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )"; 
                $reporthead.= "Last 1 month"; 
	}
	else if($bydatz=="Today")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringev.="ev_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringasp.="tpd_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringln.= "tla_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";                
                $reporthead.= "Today";                 
	}
else if($bydatz=="Last90days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringev.="ev_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringasp.="tpd_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";  
                $stringln.= "tla_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $reporthead.= "Last 3 month"; 
	}
else if($bydatz=="Last180days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringev.="ev_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringasp.="tpd_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $stringln.= "tla_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                $reporthead.= "Last 6 month"; 
	}
else if($bydatz=="Last365days")
	{
		$string.="ev_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringev.="ev_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringsu.="sv_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $stringasp.="tpd_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";  
                $stringln.= "tla_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
                $reporthead.= "Last 1 Year"; 
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
	
	$data=array();
        $data1=array();
        
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
            $stringasp.=     " and tpd_vendor = '".$_REQUEST['to_vendor']."'   " ;
            $stringev.=     " and ev_employee_id = '".$_REQUEST['to_staff']."'   " ;
            $stringln.=   " and tla_to = '".$_REQUEST['to_ledger']."'   " ; 
        }

        $final=0; $final1=0 ; $final2=0; $final3=0; $final4=0;    
        
        if($_REQUEST['acc_type']==''){
   /////////expense voucher////
$sql_logincashier  =  $database->mysqlQuery("select ev_entry_time,ev_id,ev_to_acc,ev_amount,ev_date,ev_remarks,ev_from_acc from tbl_expense_voucher  where $string"); 
$num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       { 
        $final=$final+$result_hourly_wise['ev_amount'];

        $data['DATE']=$result_hourly_wise['ev_entry_time'];
        $data['INVOICE NO ']=$result_hourly_wise['ev_id'];
        
        
                             
        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_from_acc']."'  "); 
	$num_login88   = $database->mysqlNumRows($sql_login88);
	if($num_login88){
              while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
		{ 
                     $data['FROM ACC']=$result_login88['tlm_ledger_name'];
                }}
        else{ 
                $data['FROM ACC']='';             
        }   
                                        
        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_to_acc']."'  "); 
	$num_login88   = $database->mysqlNumRows($sql_login88);
	if($num_login88){
              while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
		{ 
                   $data['TO ACC']=$result_login88['tlm_ledger_name'];
                }}
        else{ 
              $data['TO ACC']='';             
            }  
        $data['PARTICULARS']=$result_hourly_wise['ev_remarks'];                                        
        $data['AMOUNT']=number_format($result_hourly_wise['ev_amount'],$_SESSION['be_decimal']);
        $data['TYPE']="Expense Voucher";
        
        array_push($data1,$data);
        unset($data);                
        }}
        
        
        $final1=0;
        ///////supplier voucher///
        $sql_logincashier  =  $database->mysqlQuery("select sv_entry_time,sv_id,sv_paid_amount,sv_date,sv_remarks,sv_invoice_no,sv_from,sv_vendor_id from tbl_supplier_voucher where sv_paid_amount>'0' and $stringsu"); 
        $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
        if($num_logincashier)
	{
        while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
        {
           $p++;
                        $final1=$final1+$result_hourly_wise['sv_paid_amount']; 

                        $data['DATE']=$result_hourly_wise['sv_entry_time'];
                        $data['INVOICE NO ']=$result_hourly_wise['sv_id'];
           
                        
                             
                        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['sv_from']."'  "); 
                        $num_login88   = $database->mysqlNumRows($sql_login88);
			if($num_login88){                                         
			        while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
				{ 
                                $data['FROM ACC']=$result_login88['tlm_ledger_name'];                                          
                                }} else{                                           
                                $data['FROM ACC']='';             
                                }   
               
                        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['sv_vendor_id']."'  "); 
                        $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{                                             
                                             $data['TO ACC']=$result_login88['tlm_ledger_name'];
                                        }}else{ 
                                            
                               $data['TO ACC']='';             
                                                                                      
                                        }  

                       $data['PARTICULARS']=$result_hourly_wise['sv_remarks'];                                                         
                       $data['AMOUNT']=number_format($result_hourly_wise['sv_paid_amount'],$_SESSION['be_decimal']);
                       $data['TYPE']="Supplier Voucher";
                       
                        array_push($data1,$data);
                        unset($data);                     
        }}
        $final2=0;
    ///////employee voucher///
$sql_logincashier  =  $database->mysqlQuery("select ev_entry_time,ev_id,ev_amount,ev_date,ev_remarks,ev_from,ev_employee_id from tbl_employee_voucher where $stringev"); 

  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                                $final2=$final2+$result_hourly_wise['ev_amount'];
                               
                        $data['DATE']=$result_hourly_wise['ev_entry_time'];
                        $data['INVOICE NO ']=$result_hourly_wise['ev_id'];
                        
                        
                               
                        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_from']."'  "); 
                        $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                             $data['FROM ACC']=$result_login88['tlm_ledger_name'];                                          
                          }} else{ 
                                            
                               $data['FROM ACC']='';             
                                                                                      
                                        }   
                                                        
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_staff_id='".$result_hourly_wise['ev_employee_id']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{                                            
                                             $data['TO ACC']=$result_login88['tlm_ledger_name'];
                                        }}else{ 
                                            
                               $data['TO ACC']='';             
  
                                        }  
                       $data['PARTICULARS']=$result_hourly_wise['ev_remarks'];                                                                                              
                       $data['AMOUNT']=number_format($result_hourly_wise['ev_amount'],$_SESSION['be_decimal']);
                       $data['TYPE']="Employee Voucher";
                        
                        array_push($data1,$data);
                        unset($data);        
                                        
        }}
   
           /////////loan voucher////
$sql_logincashier  =  $database->mysqlQuery("SELECT tla_id,tla_date,tla_from,tla_to,tla_amount,tla_particulars  FROM `tbl_loan_advance` where tla_amount!='' and $stringln"); 
$num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
          
        $final3=$final3+$result_hourly_wise['tla_amount'];
        $data['DATE']=$result_hourly_wise['tla_date'];
        $data['INVOICE NO ']=$result_hourly_wise['tla_id'];

        
                             
        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tla_from']."'  "); 
	$num_login88   = $database->mysqlNumRows($sql_login88);
	if($num_login88){
              while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
		{ 
                     $data['FROM ACC']=$result_login88['tlm_ledger_name'];
                }}
        else{ 
                $data['FROM ACC']='';             
        }   
                                        
        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tla_to']."'  "); 
	$num_login88   = $database->mysqlNumRows($sql_login88);
	if($num_login88){
              while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
		{ 
                   $data['TO ACC']=$result_login88['tlm_ledger_name'];
                }}
        else{ 
              $data['TO ACC']='';             
            } 
        
        $data['PARTICULARS']=$result_hourly_wise['tla_particulars'];                                         
        $data['AMOUNT']=number_format($result_hourly_wise['tla_amount'],$_SESSION['be_decimal']);
        $data['TYPE']="Loan Voucher";
        
        array_push($data1,$data);
        unset($data);                
        }}

                   /////////asset purchase  voucher////
$sql_logincashier  =  $database->mysqlQuery("select tpd_id,tpd_vendor,tpd_paid_amount,tpd_date,tpd_from_acc,tpd_remarks from tbl_asset_purchase_invoice_detail  where  tpd_paid_amount>'0' and $stringasp"); 
$num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
          
        $final4=$final4+$result_hourly_wise['tpd_paid_amount'];
        $data['DATE']=$result_hourly_wise['tpd_date'];
        $data['INVOICE NO ']=$result_hourly_wise['tpd_id'];

        
                             
        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tpd_from_acc']."'  "); 
	$num_login88   = $database->mysqlNumRows($sql_login88);
	if($num_login88){
              while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
		{ 
                     $data['FROM ACC']=$result_login88['tlm_ledger_name'];
                }}
        else{ 
                $data['FROM ACC']='';             
        }   
                                        
        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['tpd_vendor']."'  "); 
	$num_login88   = $database->mysqlNumRows($sql_login88);
	if($num_login88){
              while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
		{ 
                   $data['TO ACC']=$result_login88['tlm_ledger_name'];
                }}
        else{ 
              $data['TO ACC']='';             
            }  
        
        $data['PARTICULARS']=$result_hourly_wise['tpd_remarks'];                                        
        $data['AMOUNT']=number_format($result_hourly_wise['tpd_paid_amount'],$_SESSION['be_decimal']);
        $data['TYPE']="Asset Supplier Voucher";
        
        array_push($data1,$data);
        unset($data);                
        }}
        
         }
         else if($_REQUEST['acc_type']=='exp_acc'){
              /////////expense voucher////
$sql_logincashier  =  $database->mysqlQuery("select ev_entry_time,ev_id,ev_to_acc,ev_amount,ev_date,ev_remarks,ev_from_acc from tbl_expense_voucher  where $string"); 
  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
          
                $final=$final+$result_hourly_wise['ev_amount'];
                 $data['DATE']=$result_hourly_wise['ev_entry_time'];
                 $data['INVOICE NO ']=$result_hourly_wise['ev_id'];

                        
                             
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_from_acc']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                             $data['FROM ACC']=$result_login88['tlm_ledger_name'];
                                           
                          }} else{ 
                                            
                               $data['FROM ACC']='';             
                                          
                                            
                                        }   
                                        
                                        
                                              
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_to_acc']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            
                                             $data['TO ACC']=$result_login88['tlm_ledger_name'];
                                        }}else{ 
                                            
                               $data['TO ACC']='';             
                                          
                                            
                                        }  
                                        
                       $data['PARTICULARS']=$result_hourly_wise['ev_remarks'];                
                       $data['AMOUNT']=number_format($result_hourly_wise['ev_amount'],$_SESSION['be_decimal']);
                       $data['TYPE']="Expense Voucher";
                       
                        array_push($data1,$data);
                        unset($data);                

        }}
             
         }
         else if($_REQUEST['acc_type']=='sup_acc'){
             ///////supplier voucher///
        $sql_logincashier  =  $database->mysqlQuery("select sv_entry_time,sv_id,sv_paid_amount,sv_vendor_id,sv_date,sv_remarks,sv_invoice_no,sv_from from tbl_supplier_voucher where sv_paid_amount>'0' and $stringsu"); 
  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                                $final1=$final1+$result_hourly_wise['sv_paid_amount'];
                    
                                
                        $data['DATE']=$result_hourly_wise['sv_entry_time'];
                        $data['INVOICE NO ']=$result_hourly_wise['sv_id'];
                       
                       
                             
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['sv_from']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                             $data['FROM ACC']=$result_login88['tlm_ledger_name'];
                                           
                          }} else{ 
                                            
                               $data['FROM ACC']='';             
                                          
                                            
                                        }   
                                        
                                        
                                              
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['sv_vendor_id']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            
                                             $data['TO ACC']=$result_login88['tlm_ledger_name'];
                                        }}else{ 
                                            
                               $data['TO ACC']='';             
                                          
                                            
                                        }  
                                        
                        $data['PARTICULARS']=$result_hourly_wise['sv_remarks'];                
                       $data['AMOUNT']=number_format($result_hourly_wise['sv_paid_amount'],$_SESSION['be_decimal']);
                       $data['TYPE']="Supplier Voucher";
                       
                        array_push($data1,$data);
                        unset($data); 
          
          
        }}
             
         } else if($_REQUEST['acc_type']=='emp_acc'){
             
              ///////employee voucher///
        $sql_logincashier  =  $database->mysqlQuery("select ev_entry_time,ev_id,ev_amount,ev_date,ev_remarks,ev_from,ev_employee_id from tbl_employee_voucher where $stringev"); 


  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                        $final2=$final2+$result_hourly_wise['ev_amount'];
                               
                        $data['DATE']=$result_hourly_wise['ev_entry_time'];
                        $data['INVOICE NO ']=$result_hourly_wise['ev_id'];
                       
                       
                                  
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['ev_from']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                             $data['FROM ACC']=$result_login88['tlm_ledger_name'];                                          
                          }}else{ 
                                            
                               $data['FROM ACC']='';             
                               }    
              
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_staff_id='".$result_hourly_wise['ev_employee_id']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            
                                             $data['TO ACC']=$result_login88['tlm_ledger_name'];
                                        }}else{ 
                                            
                               $data['TO ACC']='';             
                                          
                                            
                                        }  
                                        
                        $data['PARTICULARS']=$result_hourly_wise['ev_remarks'];                 
                       $data['AMOUNT']=number_format($result_hourly_wise['ev_amount'],$_SESSION['be_decimal']);
                       $data['TYPE']="Employee Voucher";
                      
                        array_push($data1,$data);
                        unset($data);        
                                        
        }}
             
         }
         else if($_REQUEST['acc_type']=='loan_acc'){
                /////////loan voucher////
  $sql_logincashier  =  $database->mysqlQuery("SELECT tla_id,tla_date,tla_from,tla_to,tla_amount,tla_particulars  FROM `tbl_loan_advance` where tla_amount!='' and $stringln"); 
    $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
     if($num_logincashier)
          {
         while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
         {
            
                  $final3=$final3+$result_hourly_wise['tla_amount'];
                   $data['DATE']=$result_hourly_wise['tla_date'];
                   $data['INVOICE NO ']= $result_hourly_wise['tla_id'];
                     
                          
                               
                                     $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tla_from']."'  "); 
          
                                            $num_login88   = $database->mysqlNumRows($sql_login88);
                                          if($num_login88){
                                             
                                          while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                          { 
                                               $data['FROM ACC']=$result_login88['tlm_ledger_name'];
                                             
                            }} else{ 
                                              
                                 $data['FROM ACC']='';             
                                            
                                              
                                          }   
                                          
                                          
                                                
                             $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tla_to']."'  "); 
          
                                            $num_login88   = $database->mysqlNumRows($sql_login88);
                                          if($num_login88){
                                             
                                          while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                          { 
                                              
                                               $data['TO ACC']=$result_login88['tlm_ledger_name'];
                                          }}else{ 
                                              
                                 $data['TO ACC']='';             
                                            
                                              
                                          }  
                                          
                                          $data['PARTICULARS']=$result_hourly_wise['tla_particulars'];                 
                         $data['AMOUNT']=number_format($result_hourly_wise['tla_amount'],$_SESSION['be_decimal']);
                         $data['TYPE']="Loan Voucher";
                         
                          array_push($data1,$data);
                          unset($data);                
  
          }}
               
           }

           else if($_REQUEST['acc_type']=='asset_acc'){
                /////////expense voucher////
  $sql_logincashier  =  $database->mysqlQuery("select tpd_id,tpd_vendor,tpd_paid_amount,tpd_date,tpd_from_acc,tpd_remarks from tbl_asset_purchase_invoice_detail  where  tpd_paid_amount>'0' and $stringasp"); 
    $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
     if($num_logincashier)
          {
         while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
         {
            
                  $final4=$final4+$result_hourly_wise['tpd_paid_amount'];
                   $data['DATE']=$result_hourly_wise['tpd_date'];
                   $data['INVOICE NO ']=$result_hourly_wise['tpd_id'];
                         
                          
                               
                                     $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tpd_from_acc']."'  "); 
          
                                            $num_login88   = $database->mysqlNumRows($sql_login88);
                                          if($num_login88){
                                             
                                          while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                          { 
                                               $data['FROM ACC']=$result_login88['tlm_ledger_name'];
                                             
                            }} else{ 
                                              
                                 $data['FROM ACC']='';             
                                            
                                              
                                          }   
                                          
                                          
                                                
                             $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['tpd_vendor']."'  "); 
          
                                            $num_login88   = $database->mysqlNumRows($sql_login88);
                                          if($num_login88){
                                             
                                          while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                          { 
                                              
                                               $data['TO ACC']=$result_login88['tlm_ledger_name'];
                                          }}else{ 
                                              
                                 $data['TO ACC']='';             
                                            
                                              
                                          }  
                                          
                         $data['PARTICULARS']=$result_hourly_wise['tpd_remarks'];                
                         $data['AMOUNT']=number_format($result_hourly_wise['tpd_paid_amount'],$_SESSION['be_decimal']);
                         $data['TYPE']="Asset Supplier Voucher";
                       
                          array_push($data1,$data);
                          unset($data);                
  
          }}
               
           }
        
                        $data['DATE']="TOTAL";
                        $data['INVOICE NO ']="";
                        $data['FROM ACC']="";
                        $data['TO ACC']="";
                        $data['PARTICULARS']="";
                        $data['AMOUNT']=number_format(($final+$final1+$final2+$final3+$final4),$_SESSION['be_decimal']);
                        $data['TYPE']="";
                        
                        array_push($data1,$data);
                        unset($data);
        
                
$filename = " ACCOUNT EXPENSE REPORT-" . $reporthead . ".xls";
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

else if(($_REQUEST['type']=="purchase_acc_report"))
{       

        $stringsu="";
        $stringasp="";

		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
                        $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
                        $stringsu.= " sv_date between '".$from."' and '".$to."' ";
                        $reporthead.= $from.' - '.$to;
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
                        $stringasp.= " tpd_date between '".$from."' and '".$to."' ";
                        $stringsu.= " sv_date between '".$from."' and '".$to."' ";
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
	
	if($bydatz=="Last5days")
	{              
                $stringsu.=" sv_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $reporthead.= "Last 5 days";
                
	}elseif($bydatz=="Last10days")
	{
                $stringsu.=" ev_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringasp.=" tpd_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $reporthead.= "Last 10 days";      
	}
	else if($bydatz=="Yesterday")
	{
                $stringsu.=" sv_date = CURDATE() - INTERVAL 1 day";
                $stringasp.=" tpd_date = CURDATE() - INTERVAL 1 day";
                $reporthead.= "Yesterday";
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
                $reporthead.= "Today";                 
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
	
	$data=array();
        $data1=array();
        
        if($_REQUEST['from_ledger']!=''){
            
            $stringsu.=     " and sv_from = '".$_REQUEST['from_ledger']."'   " ;
            $stringasp.=     " and tpd_from_acc = '".$_REQUEST['from_ledger']."'   " ;     
        }
        
        if($_REQUEST['to_ledger']!=''){
            
            $stringsu.=     " and sv_vendor_id = '".$_REQUEST['to_vendor']."'   " ;
            $stringasp.=     " and tpd_vendor = '".$_REQUEST['to_vendor']."'   " ;
        }

        $final=0; $final1=0 ; $final2=0;    
        
        if($_REQUEST['pur_acc_type']==''){

        $final1=0;
        ///////supplier voucher///
        $sql_logincashier  =  $database->mysqlQuery("select sv_vendor_id,sv_paid_amount,sv_date,sv_invoice_amount,sv_credit_amount,sv_from  from tbl_supplier_voucher where sv_paid_amount>'0' and $stringsu"); 
        $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
        if($num_logincashier)
	{
        while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
        {
           $p++;
                        $final1=$final1+$result_hourly_wise['sv_paid_amount']; 

                        $data['DATE']=$result_hourly_wise['sv_date'];                     
  
                        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['sv_from']."'  "); 
                        $num_login88   = $database->mysqlNumRows($sql_login88);
			if($num_login88){                                         
			        while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
				{ 
                                $data['FROM ACC']=$result_login88['tlm_ledger_name'];                                          
                                }} else{                                           
                                $data['FROM ACC']='';             
                                }   
               
                        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['sv_vendor_id']."'  "); 
                        $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{                                             
                                             $data['TO ACC']=$result_login88['tlm_ledger_name'];
                                        }}else{ 
                                            
                               $data['TO ACC']='';             
                                                                                      
                                        }  
                        $data['TYPE']="Supplier Voucher";
                        $data['INV_AMOUNT']=number_format($result_hourly_wise['sv_invoice_amount'],$_SESSION['be_decimal']);                                                        
                        $data['PAID_AMOUNT']=number_format($result_hourly_wise['sv_paid_amount'],$_SESSION['be_decimal']);
                        $data['CRE_AMOUNT']=number_format($result_hourly_wise['sv_credit_amount'],$_SESSION['be_decimal']);
                        $data['TYPE']="Supplier Voucher";
                       
                        array_push($data1,$data);
                        unset($data);                     
        }}


                   /////////asset purchase  voucher////
$sql_logincashier  =  $database->mysqlQuery("select tpd_netamount,tpd_vendor,tpd_paid_amount,tpd_date,tpd_from_acc,tpd_credit_amount from tbl_asset_purchase_invoice_detail  where  tpd_paid_amount>'0' and $stringasp"); 
$num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
          
        $final2=$final2+$result_hourly_wise['tpd_paid_amount'];
        $data['DATE']=$result_hourly_wise['tpd_date'];
                  
        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tpd_from_acc']."'  "); 
	$num_login88   = $database->mysqlNumRows($sql_login88);
	if($num_login88){
              while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
		{ 
                     $data['FROM ACC']=$result_login88['tlm_ledger_name'];
                }}
        else{ 
                $data['FROM ACC']='';             
        }   
                                        
        $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['tpd_vendor']."'  "); 
	$num_login88   = $database->mysqlNumRows($sql_login88);
	if($num_login88){
              while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
		{ 
                   $data['TO ACC']=$result_login88['tlm_ledger_name'];
                }}
        else{ 
              $data['TO ACC']='';             
            }  
        
        $data['TYPE']="Asset Supplier Voucher";
        $data['INV_AMOUNT']=number_format($result_hourly_wise['tpd_netamount'],$_SESSION['be_decimal']);                                        
        $data['PAID_AMOUNT']=number_format($result_hourly_wise['tpd_paid_amount'],$_SESSION['be_decimal']);
        $data['CRE_AMOUNT']=number_format($result_hourly_wise['tpd_credit_amount'],$_SESSION['be_decimal']);
        
        
        array_push($data1,$data);
        unset($data);                
        }}
        
         }

         else if($_REQUEST['pur_acc_type']=='sup_acc'){
             ///////supplier voucher///
        $sql_logincashier  =  $database->mysqlQuery("select sv_vendor_id,sv_paid_amount,sv_date,sv_invoice_amount,sv_credit_amount,sv_from from tbl_supplier_voucher where sv_paid_amount>'0' and $stringsu"); 
  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
       {
           $p++;
                                $final1=$final1+$result_hourly_wise['sv_paid_amount'];
                    
                                
                        $data['DATE']=$result_hourly_wise['sv_date'];

                       
                       
                             
                                   $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['sv_from']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                             $data['FROM ACC']=$result_login88['tlm_ledger_name'];
                                           
                          }} else{ 
                                            
                               $data['FROM ACC']='';             
                                          
                                            
                                        }   
                                        
                                        
                                              
                           $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['sv_vendor_id']."'  "); 
	
                                          $num_login88   = $database->mysqlNumRows($sql_login88);
					if($num_login88){
                                           
					while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
					{ 
                                            
                                             $data['TO ACC']=$result_login88['tlm_ledger_name'];
                                        }}else{ 
                                            
                               $data['TO ACC']='';             
                                          
                                            
                                        }  
                        $data['TYPE']="Supplier Voucher";               
                        $data['INV_AMOUNT']=number_format($result_hourly_wise['sv_invoice_amount'],$_SESSION['be_decimal']);               
                        $data['PAID_AMOUNT']=number_format($result_hourly_wise['sv_paid_amount'],$_SESSION['be_decimal']);
                        $data['CRE_AMOUNT']=number_format($result_hourly_wise['sv_credit_amount'],$_SESSION['be_decimal']);
                       
                        array_push($data1,$data);
                        unset($data); 
          
          
        }}
             
         } 
 

           else if($_REQUEST['pur_acc_type']=='asset_acc'){
                /////////expense voucher////
                $final2=0;
  $sql_logincashier  =  $database->mysqlQuery("select tpd_netamount,tpd_vendor,tpd_paid_amount,tpd_date,tpd_from_acc,tpd_credit_amount from tbl_asset_purchase_invoice_detail  where  tpd_paid_amount>'0' and $stringasp"); 
    $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
     if($num_logincashier)
          {
         while($result_hourly_wise  = $database->mysqlFetchArray($sql_logincashier))
         {
            
                  $final2=$final2+$result_hourly_wise['tpd_paid_amount'];
                   $data['DATE']=$result_hourly_wise['tpd_date'];
       
                         
                          
                               
                                     $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_id='".$result_hourly_wise['tpd_from_acc']."'  "); 
          
                                            $num_login88   = $database->mysqlNumRows($sql_login88);
                                          if($num_login88){
                                             
                                          while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                          { 
                                               $data['FROM ACC']=$result_login88['tlm_ledger_name'];
                                             
                            }} else{ 
                                              
                                 $data['FROM ACC']='';             
                                            
                                              
                                          }   
                                          
                                          
                                                
                             $sql_login88  =  $database->mysqlQuery("select tlm_ledger_name from tbl_ledger_master  where tlm_vendor_id='".$result_hourly_wise['tpd_vendor']."'  "); 
          
                                            $num_login88   = $database->mysqlNumRows($sql_login88);
                                          if($num_login88){
                                             
                                          while($result_login88  = $database->mysqlFetchArray($sql_login88)) 
                                          { 
                                              
                                               $data['TO ACC']=$result_login88['tlm_ledger_name'];
                                          }}else{ 
                                              
                                 $data['TO ACC']='';             
                                            
                                              
                                          }  
                          
                         $data['TYPE']="Asset Supplier Voucher";
                         $data['INV_AMOUNT']=number_format($result_hourly_wise['tpd_netamount'],$_SESSION['be_decimal']);               
                         $data['PAID_AMOUNT']=number_format($result_hourly_wise['tpd_paid_amount'],$_SESSION['be_decimal']);
                         $data['CRE_AMOUNT']=number_format($result_hourly_wise['tpd_credit_amount'],$_SESSION['be_decimal']);
                       
                          array_push($data1,$data);
                          unset($data);                
  
          }}
               
           }
        
                        $data['DATE']="TOTAL";
                        $data['FROM ACC']="";
                        $data['TO ACC']="";
                        $data['TYPE']="";
                        $data['INV_AMOUNT']="";
                        $data['PAID_AMOUNT']=number_format(($final1+$final2),$_SESSION['be_decimal']);
                        $data['CRE_AMOUNT']="";
                        
                        array_push($data1,$data);
                        unset($data);
        
                
$filename = " ACCOUNT PURCHASE REPORT-" . $reporthead . ".xls";
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



else if(($_REQUEST['type']=="cash_settling_report_cr"))
        {
            $from="";
            $to="";
	$string="";
        $stringta="";
	$reporthead="";
	$strings=" bm_status='Closed' AND ";
        $stringsta=" tab_status='Closed' AND tab_mode!='CS' and tab_payment_settled='Y'  AND  ";
        $stringscs=" tab_status='Closed' AND tab_mode='CS' and tab_payment_settled='Y' AND";
        
          $stringsall_tacs=" tab_status='Closed'  and tab_payment_settled='Y' AND";
        //$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
        $string1_strta=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
        $string2_strta=" sum(tab_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
        $string3_strta=" sum(tab_netamt) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_chequebankamount) ";
	$string6_str=" sum(cd_amount)";
	$string7_str=" sum(bm_finaltotal)";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	//	$string1 =$strings. " pym_code='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string1 =" ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
		$string3 =" pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =" pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =" pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
                $string6=" pym_code='credit_person' AND ";
                $string7=" pym_code='complimentary' AND";
	$view_mode='';
	
	
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        
			$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
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
          
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( ) ";
		$string_pax.= "bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day ";
                $stringta.=" tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY  ";
		$string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day ";
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( )";
		$string_pax.= "bm_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH AND CURDATE( )";
		$string_pax.= " bm_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
                $stringta.=" tab_dayclosedate='".$cur."'";
		$string_pax.= " bm_dayclosedate  between '".$cur."' and '".$cur."'";
		$reporthead="On ".$database->convert_date($cur);	
	}
	
	}
	
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_status FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	
        
          
          
          
          
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
   								 
								  <thead>
                                  <tr>
                                 	<th colspan="7">Report - <?=$reporthead?></td>
                                  </tr>
									<tr>
                                        
                                         <th >Date</th>
                                          <th >Staff</th>
                                         <th >Cash</th>
                                         <th >Card</th>
                                        
                                        <th >Credit</th>
                                        <th >Complimentary</th>
                                   
                                    <th >Total</th>
                                  </tr>
								  </thead>
								  <tbody>
                                                                      
        
									
                                          <?php
//`tbl_tablebillmaster`(`bm_billno`, `bm_billdate`, `bm_billtime`, `bm_branchid`, `bm_subtotal`, `bm_paymode`, `bm_cancelamount`, `bm_discountid`, `bm_corporatecode`, `bm_discountvalue`, `bm_servicetax`, `bm_vat`, `bm_servicecharge`, `bm_credit`, `bm_creditroom`, `bm_creditstaff`, `bm_complimentary`, `bm_complimentaryremark`, `bm_finaltotal`, `bm_amountpaid`, `bm_amountbalace`, `bm_transactionid`, `bm_voucherid`, `bm_couponcompany`, `bm_couponamt`, `bm_chequeno`, `bm_chequebankname`)	
 $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotalta=0;
  $subtotalcs=0;
  $subtotal1=0;
  $totalcash=0;
  $totalcashta=0;
  $totalcashcs=0;
  $totalcouponsta=0;
  $totalcoupons=0;
  $totalvoucher=0;
  $totalvoucherta=0;
  $totalcheque=0;
   $totalchequeta=0;
  $totalcredits=0;
  $totalcreditsta=0;
  $totalcomplimentary=0;
  $totalcomplimentaryta=0;
  $totalpax=0;
  $totalcreditordebit=0;
  $totalcreditordebitta=0;
  $slno=0;
  $slnota=0;
  $totalta="";
  
  $totalvouchercs=0;
  $totalchequecs=0;
  //$totalcredits=0;
  $totalcreditscs=0;
  $totalcouponscs=0;
  //$totalcomplimentary=0;
  $totalcomplimentarycs=0;
  $totalpax=0;
  //$totalcreditordebit=0;
  $totalcreditordebitcs=0;
  
  $slnocs=0;
  $totalcs="";
  if($_REQUEST['department']=='DI'){
  ?>
 
 
  <?php

  if($_REQUEST['staff']!="")
        {
           
           $sql = $database->mysqlQuery("select distinct bm_dayclosedate,bm_settlement_login from tbl_tablebillmaster where $string_pax and bm_settlement_login='".$_REQUEST['staff']."' ");
        }else{
           $sql = $database->mysqlQuery("select distinct bm_dayclosedate,bm_settlement_login from tbl_tablebillmaster where $string_pax");
        }
  
 
  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
        
        
        $total=0;
          $slno++;
        if($result != ""){
            echo "<tr><td>".$result['bm_dayclosedate']."</td>";
            echo "<td>".$result['bm_settlement_login']."</td>";
            $dt = " bm_dayclosedate='".$result['bm_dayclosedate']."'";
            
              $dt1= " and bm_settlement_login='".$result['bm_settlement_login']."'";
        }

  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string1"."$dt $dt1 order by bm_dayclosedate,bm_billtime ASC"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_login  = $database->mysqlFetchArray($sql_login);
			
		if($result_login['tot'] != "")	{
                                    
                        $totalcash=$totalcash + $result_login['tot'];
                        $total= $total + $result_login['tot'];            
			$subtotal =$subtotal + $result_login['tot'];
                        
                        
			?>
          
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
             
            <?php }else{
              echo "<td>--</td>";
          }
          
//
	$sql_login1  =  $database->mysqlQuery("select $string2_str as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $strings $string2 "."$dt $dt1 order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	 
	  if($num_login1){
		  $result_login1  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebit=$totalcreditordebit + $result_login1['tot'];  
			$total= $total + $result_login1['tot'];       
			$subtotal =$subtotal + $result_login1['tot'];
                      
			?>
            
            <td><?=number_format($result_login1['tot'],$_SESSION['be_decimal'])?></td>
            
      
			
		<?php	
	  }else{
              echo "<td>--</td>";
          }
		 	
				
			$sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_credit_details tcd on tcd.cd_billno=tbl_tablebillmaster.bm_billno left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string6"." $dt $dt1 order by bm_dayclosedate,bm_billtime ASC"); 
                     
                      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login5  = $database->mysqlFetchArray($sql_login);
			
			
			
                        $totalcredits=$totalcredits + $result_login5['tot'];
                        $total= $total + $result_login5['tot'];     
                        $subtotal =$subtotal + $result_login5['tot'];
                          
			?>
         
              
          
          <td><?=number_format($result_login5['tot'],$_SESSION['be_decimal'])?></td>
         
           
            <?php 
            
                        
                        }else{
              echo "<td>--</td>";
          }
				
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string7"." $dt $dt1 order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login6  = $database->mysqlFetchArray($sql_login); 
			
                        $totalcomplimentary= $totalcomplimentary + $result_login6['tot'];    
                        
			?>
          
          <td><?=number_format($result_login6['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            
			 $qtycount=0;
		  
			 ?>
                        
    <td ><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                        
                            <?php
  }
  }
  
  
 
  ?>
    
  <tr><td colspan="8"></td></tr>
  <tr> <td><strong>TOTAL(excl.compl)</strong></td>
  <td><strong><?=$reporthead?></strong></td>
   
  <td colspan=""><strong><?=number_format($totalcash,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebit,$_SESSION['be_decimal'])?></strong></td>
  
  <td colspan=""><strong><?=number_format($totalcredits,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentary,$_SESSION['be_decimal'])?></strong></td>
 
  <td colspan=""><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td></tr>

  
    <?php }  if($_REQUEST['department']=='TA' || $_REQUEST['department']=='HD' ){ ?>
  

  
    
      
      <?php
      
      if($_REQUEST['staff']!=''){
         $sql = $database->mysqlQuery("select distinct tab_settlement_login,tab_dayclosedate from tbl_takeaway_billmaster where $stringta and tab_settlement_login='".$_REQUEST['staff']."' ");  
      }else{
      
    $sql = $database->mysqlQuery("select distinct tab_settlement_login,tab_dayclosedate from tbl_takeaway_billmaster where $stringta");
      }
//echo "select distinct(tab_dayclosedate) from tbl_takeaway_billmaster where $stringta";
  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
         
        $totalta=0;
          $slnota++;
        if($result != ""){
            echo "<tr><td>".$result['tab_dayclosedate']."</td>";
             echo "<td>".$result['tab_settlement_login']."</td>";
            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
             $dt1 = "  and  tab_settlement_login='".$result['tab_settlement_login']."'";
        }
  
  
?>
   
  
  <?php
  

  $sql_login  =  $database->mysqlQuery("select $string1_strta  as tot 
from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
where $stringsta $string1 $dt $dt1 order by tab_dayclosedate,tab_time ASC"); 
;
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_logincashta  = $database->mysqlFetchArray($sql_login);
			        
                        $totalcashta=$totalcashta + $result_logincashta['tot'];
                        $totalta= $totalta + $result_logincashta['tot'];            
			$subtotalta =$subtotalta + $result_logincashta['tot'];
                        
                        
			?>
          
          <td><?=number_format($result_logincashta['tot'],$_SESSION['be_decimal'])?></td>
          
         
             
            <?php }else{
              echo "<td>--</td>";
          }
          

	$sql_login1  =  $database->mysqlQuery("select $string2_strta as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $stringsta "." $string2 "."$dt $dt1 order by tb.tab_dayclosedate,tb.tab_time ASC ");

	  $num_login1   = $database->mysqlNumRows($sql_login1);
	
	  if($num_login1){
		  $result_logincreditta  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebitta=$totalcreditordebitta + $result_logincreditta['tot'];  
			$totalta= $totalta + $result_logincreditta['tot'];       
			$subtotalta =$subtotalta + $result_logincreditta['tot'];
                      
			?>
            
            <td><?=number_format($result_logincreditta['tot'],$_SESSION['be_decimal'])?></td>
            	
		<?php	
	  }else{
              echo "<td>--</td>";
          }
          
          $sql_login  =  $database->mysqlQuery("select $string6_str as tot 
                        from tbl_takeaway_billmaster tb left join tbl_credit_details tcd on tcd.cd_billno=tb.tab_billno 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string6"." $dt $dt1 order by tab_dayclosedate,tab_time ASC");

          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincreditpersonta  = $database->mysqlFetchArray($sql_login); 
			 
			
			$totalta= $totalta + $result_logincreditpersonta['tot'];
                        $totalcreditsta= $totalcreditsta + $result_logincreditpersonta['tot'];    
                        $subtotalta =$subtotalta + $result_logincreditpersonta['tot'];
			?>
          
          <td><?=number_format($result_logincreditpersonta['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php 
                        
                        }
            else{
              echo "<td>--</td>";
          }
		 		
			$sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsta $string7"." $dt $dt1 order by tab_dayclosedate,tab_time ASC");
                   
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincompta  = $database->mysqlFetchArray($sql_login); 
			 
			
			
                        $totalcomplimentaryta= $totalcomplimentaryta + $result_logincompta['tot'];    
                        
			?>
          
          <td><?=number_format($result_logincompta['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                       

			 ?>
          
    <td ><strong><?=number_format($totalta,$_SESSION['be_decimal'])?></strong></td>
                           
                            <?php
  }
  }
  
  ?>
  <tr><td colspan="8"></td></tr>
  <tr> <td><strong>TOTAL(excl.compl)</strong></td>
            <td><strong><?=$reporthead?></strong></td>
          
                
  <td colspan=""><strong><?=number_format($totalcashta,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebitta,$_SESSION['be_decimal'])?></strong></td>
 
  <td colspan=""><strong><?=number_format($totalcreditsta,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentaryta,$_SESSION['be_decimal'])?></strong></td>

  <td colspan=""><strong><?=number_format($subtotalta,$_SESSION['be_decimal'])?></strong></td></tr>
  
   <?php }  if($_REQUEST['department']=='CS'){ ?>
  
  
<?php
 if($_REQUEST['staff']!=''){
         $sql = $database->mysqlQuery("select distinct tab_settlement_login,tab_dayclosedate from tbl_takeaway_billmaster where $stringta and tab_settlement_login='".$_REQUEST['staff']."' ");  
      }else{
      $sql = $database->mysqlQuery("select distinct tab_settlement_login,tab_dayclosedate from tbl_takeaway_billmaster where $stringta");
      }
  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
         
        $totalta=0;
          $slnocs++;
        if($result != ""){
            echo "<tr><td>".$result['tab_dayclosedate']."</td>";
            echo "<td>".$result['tab_settlement_login']."</td>";
            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
             $dt1 = "  and  tab_settlement_login='".$result['tab_settlement_login']."'";
            
        }
  
  
?>
   
  <?php
  

  $sql_login  =  $database->mysqlQuery("select $string1_strta  as tot 
from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
where $stringscs $string1 $dt $dt1 order by tab_dayclosedate,tab_time ASC"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_logincashcs  = $database->mysqlFetchArray($sql_login);
			         
                        $totalcashcs=$totalcashcs + $result_logincashcs['tot'];
                        $totalcs= $totalcs + $result_logincashcs['tot'];            
			$subtotalcs =$subtotalcs + $result_logincashcs['tot'];
                        
                        
			?>
          
          <td><?=number_format($result_logincashcs['tot'],$_SESSION['be_decimal'])?></td>
          
         
             
            <?php }else{
              echo "<td>--</td>";
          }
          

	$sql_login1  =  $database->mysqlQuery("select $string2_strta as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $stringscs "." $string2 "."$dt $dt1 order by tb.tab_dayclosedate,tb.tab_time ASC ");

	  $num_login1   = $database->mysqlNumRows($sql_login1);
	
	  if($num_login1){
		  $result_logincreditcs  = $database->mysqlFetchArray($sql_login1); 
			
                      
                        $totalcreditordebitcs=$totalcreditordebitcs + $result_logincreditcs['tot'];  
			$totalcs= $totalcs + $result_logincreditcs['tot'];       
			$subtotalcs =$subtotalcs + $result_logincreditcs['tot'];
                      
			?>
            
            <td><?=number_format($result_logincreditcs['tot'],$_SESSION['be_decimal'])?></td>
            
		<?php	
	  }else{
              echo "<td>--</td>";
          }
          
          $sql_login  =  $database->mysqlQuery("select $string6_str as tot 
                        from tbl_takeaway_billmaster tb left join tbl_credit_details tcd on tcd.cd_billno=tb.tab_billno
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string6"." $dt $dt1 order by tab_dayclosedate,tab_time ASC");

          $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincreditpersoncs  = $database->mysqlFetchArray($sql_login); 
			 
			
			$totalcs= $totalcs + $result_logincreditpersoncs['tot'];
                        $totalcreditscs= $totalcreditscs + $result_logincreditpersoncs['tot'];    
                        $subtotalcs =$subtotalcs + $result_logincreditpersoncs['tot'];
			?>
          
          <td><?=number_format($result_logincreditpersoncs['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                     	
			$sql_login  =  $database->mysqlQuery("select $string3_strta as tot 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringscs $string7"." $dt $dt1 order by tab_dayclosedate,tab_time ASC");
                   
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_logincompcs  = $database->mysqlFetchArray($sql_login); 
			 
                        $totalcomplimentarycs= $totalcomplimentarycs + $result_logincompcs['tot'];    
                       
			?>
          
          <td><?=number_format($result_logincompcs['tot'],$_SESSION['be_decimal'])?></td>
         
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        
			 ?>
          
    <td ><strong><?=number_format($totalcs,$_SESSION['be_decimal'])?></strong></td>
                             
                            <?php
  }
  }
  
  
  ?>
  <tr><td colspan="8"></td></tr>
  <tr> <td><strong>TOTAL(excl.compl)</strong></td>
  <td><strong><?=$reporthead?></strong></td>
  
  <td colspan=""><strong><?=number_format($totalcashcs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebitcs,$_SESSION['be_decimal'])?></strong></td>
 
  <td colspan=""><strong><?=number_format($totalcreditscs,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentarycs,$_SESSION['be_decimal'])?></strong></td>

  
  <td colspan=""><strong><?=number_format($subtotalcs,$_SESSION['be_decimal'])?></strong></td></tr>

  
 
 <?php } if($_REQUEST['department']==''){ 
     
     
     ///di//////

     if($_REQUEST['staff']!=''){
         
  $sql = $database->mysqlQuery("select dayclose,login from (select  bm_dayclosedate as dayclose ,bm_settlement_login as login from tbl_tablebillmaster where $string_pax and bm_settlement_login='".$_REQUEST['staff']."' union all"
          . " select distinct tab_dayclosedate as dayclose,tab_settlement_login as login from tbl_takeaway_billmaster where $stringta and tab_settlement_login='".$_REQUEST['staff']."' )x group by dayclose, login ");
     }else{
         $sql = $database->mysqlQuery("select dayclose,login from (select  bm_dayclosedate as dayclose ,bm_settlement_login as login from tbl_tablebillmaster where $string_pax union all"
          . " select distinct tab_dayclosedate as dayclose,tab_settlement_login as login from tbl_takeaway_billmaster where $stringta)x group by  login ");
         
     }
  
  $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
        
        $total1=0;$total2=0;$total3=0;
        //$total=0;
          $slno++;
          if($result['login']!='' ){ 
          
        if($result != ""){
           
            
            echo "<tr>";
            
            
             if($_REQUEST['staff']!=''){
                 $stringta='';
                 $string_pax='';
            echo "<td>".$result['dayclose']."</td>";
             }else{
                 echo "<td></td>"; 
             }
            
            
            echo "<td>".$result['login']."</td>";
            
             if($_REQUEST['staff']!=''){
             //$dt = " bm_dayclosedate='".$result['bm_dayclosedate']."'";    
            $dt = " bm_dayclosedate='".$result['dayclose']."'";
             $dt1 = "  and  bm_settlement_login='".$result['login']."'";
             
             $dt2 = " tab_dayclosedate='".$result['dayclose']."'";
             $dt3 = "  and  tab_settlement_login='".$result['login']."'";
             }
        }

  $sql_login  =  $database->mysqlQuery("select sum(tot) as all_cash,dayclose,login from (select $string1_str as tot ,bm_dayclosedate as dayclose, bm_settlement_login as login from tbl_tablebillmaster left join tbl_paymentmode on "
          . "tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string1"."$dt $dt1 $string_pax  and bm_settlement_login='".$result['login']."'   union all "
          . "select $string1_strta  as tot ,tab_dayclosedate as dayclose, tab_settlement_login as login
        from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
          where $stringsall_tacs $string1 $dt2 $dt3 $stringta and tab_settlement_login='".$result['login']."')x where   tot>0 group by  login"); 
  
 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		while($result_login  = $database->mysqlFetchArray($sql_login)){
			 
		if($result_login['all_cash'] >0 )	{
                                    
                        $totalcash1=$totalcash1 + $result_login['all_cash'];
                        $total1= $total1 + $result_login['all_cash'];            
			$subtotal1 =$subtotal1 + $result_login['all_cash'];
                        
                         echo "<td>".$result_login['all_cash']."</td>";
                        
          }else{
               echo "<td>0</td>";
          }
          
          }
    }else{
               echo "<td>0</td>";
          }
          

 $sql_login1  =  $database->mysqlQuery("select sum(tot) as allcard,login,dayclose from (select $string2_str as tot,bm_dayclosedate as dayclose, bm_settlement_login as login "
         . "from tbl_tablebillmaster tb left join tbl_paymentmode"
                . " on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank  "
                . "AND $strings $string2 "."$dt $dt1 $string_pax and bm_settlement_login='".$result['login']."' union all select $string2_strta as tot ,tab_dayclosedate as dayclose, tab_settlement_login as login
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $stringsall_tacs "." $string2 "."$dt2 $dt3  $stringta and tab_settlement_login='".$result['login']."')x  where login='".$result['login']."' and tot>0 group by login "); 
 
 
 
 
 
 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	 
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)){ 
			
                      
                      if($result_login1['allcard'] >0 ){
                         
                      
                      
                      
                        $totalcreditordebit1=$totalcreditordebit1 + $result_login1['allcard'];  
			$total2= $total2 + $result_login1['allcard'];       
			$subtotal2 =$subtotal2 + $result_login1['allcard'];
                        
                        echo "<td>".$result_login1['allcard']."</td>";
                        
                      }else{
                          echo "<td>0</td>";
                      }
			
          }
          } else{
               echo "<td>0</td>";
          }	
				
			$sql_login  =  $database->mysqlQuery(" select sum(tot) as allcredit ,login,dayclose from (select $string6_str as tot,bm_dayclosedate as dayclose,"
                                . " bm_settlement_login as login from tbl_tablebillmaster"
                                . " left join tbl_credit_details tcd"
                                . " on tcd.cd_billno=tbl_tablebillmaster.bm_billno left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id"
                                . " where $strings $string6"." $dt $dt1 $string_pax and bm_settlement_login='".$result['login']."' union all select $string6_str as tot ,tab_dayclosedate as dayclose, tab_settlement_login as login
                        from tbl_takeaway_billmaster tb left join tbl_credit_details tcd on tcd.cd_billno=tb.tab_billno 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsall_tacs $string6"." $dt2 $dt3 $stringta and tab_settlement_login='".$result['login']."')x  where login='".$result['login']."' and tot>0 group by login "); 
                        
                        
                        
                        
                        
                     
                      $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login5  = $database->mysqlFetchArray($sql_login)){
			
			
			if($result_login5['allcredit']>0){
                            
                        $totalcredits1=$totalcredits1 + $result_login5['allcredit'];
                        $total3= $total3 + $result_login5['allcredit'];     
                        $subtotal3 =$subtotal3 + $result_login5['allcredit'];
                        
                         echo "<td>".$result_login5['allcredit']."</td>";
                         
                        }else{
                             echo "<td>0</td>";
                        }
			
                        
          } }else{
               echo "<td>0</td>";
          }
				
			$sql_login  =  $database->mysqlQuery("select sum(tot) as allcomp ,login,dayclose from (select $string7_str as tot,bm_dayclosedate as dayclose, "
                                . "bm_settlement_login as login from tbl_tablebillmaster left join tbl_paymentmode on"
                         . " tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string7"." $dt $dt1 $string_pax and bm_settlement_login='".$result['login']."' union all select $string3_strta as tot,tab_dayclosedate as dayclose,
                              tab_settlement_login as login 
                        from tbl_takeaway_billmaster tb 
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
                        where $stringsall_tacs $string7"." $dt2 $dt3 $stringta and tab_settlement_login='".$result['login']."')x   where  login='".$result['login']."' and tot>0 group by login "); 
                        
                        
                        
                        
                        
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login6  = $database->mysqlFetchArray($sql_login) ){
			
                  
                  if($result_login6['allcomp']>0){
                      
                  
                        $totalcomplimentary1= $totalcomplimentary1 + $result_login6['allcomp'];  
                        
                         echo "<td>".$result_login6['allcomp']."</td>";
                         
			} else{
                             echo "<td>0</td>";
                        }
                         
			
    }}else{
               echo "<td>0</td>";
          }
	
    
    
     echo "<td>".number_format(($total1+$total2+$total3),$_SESSION['be_decimal'])."</td>";
                         
    }
  
    }}
  
  
  
  
  
  
  
 
  ?>
    
 
    

 
  
  <tr> <td><strong>  TOTAL(excl.compl)</strong></td>
  <td><strong><?=$reporthead?></strong></td>
   
  <td colspan=""><strong><?=number_format($totalcash1,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebit1,$_SESSION['be_decimal'])?></strong></td>
  
  <td colspan=""><strong><?=number_format($totalcredits1,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentary1,$_SESSION['be_decimal'])?></strong></td>
 
  <td colspan=""><strong><?=number_format($subtotal1+$subtotal2+$subtotal3,$_SESSION['be_decimal'])?></strong></td></tr>

  </tbody>
   </table>

  <?php
  
  $filename = "Staff Settlement Report-" . $reporthead . ".xls";
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
else if(($_REQUEST['type']=="cash_settling_report_cr1"))
{
     	$staff=$_REQUEST['staff'];
        $department=$_REQUEST['department'];
	$string="";
        $stringta="";
	$string.=" bm_status='Closed' AND ";
        $stringta.=" tab_status='Closed' AND ";
        $reporthead="";
        $st="";
        $from="";
        $stringmodeta="";
         if($staff!="")
        {
           $string.="bm_settlement_login='".$staff."' AND ";
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
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
                $st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
                $st="Last 10 days";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $stringta.=" tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $st="Yesterday";
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
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
                $st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
                $st="Last 30 days";
	}
	 else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                                  $st="Last 1 MONTH";
			  }
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $st="TODAY";
	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                $st="Last 90 days";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                $st="Last 180 days";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
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
	
$data=array();
$data1=array();
$final=0;

if($department=="" && $staff==""){
  $sql_logincashier  =  $database->mysqlQuery("select dayclose,login, sum(sum_1)as tot,sum(cash)as cash ,sum(card)as card from ( select bm_settlement_login as login ,bm_dayclosedate as dayclose,sum((bm_amountpaid)-(bm_amountbalace)) as cash,sum(bm_transactionamount) as card,sum(bm_finaltotal) as sum_1 from tbl_tablebillmaster where $string and bm_complimentary='N' and bm_settlement_login!='' group by bm_settlement_login,bm_dayclosedate union all
select tab_settlement_login as login,tab_dayclosedate as dayclose,sum((tab_amountpaid)-(tab_amountbalace)) as cash,sum(tab_transactionamount) as card,sum(tab_netamt) as sum_1 from tbl_takeaway_billmaster where $stringta and tab_complimentary='N' and tab_settlement_login!='' group by tab_settlement_login,tab_dayclosedate)x group by login,dayclose order by dayclose"); 
}
else if($department=="" && $staff!=""){
  $sql_logincashier  =  $database->mysqlQuery("select login,dayclose,billno,date,sum(sum_1)as tot,sum(cash)as cash ,sum(card)as card,comp from ( select distinct(bm_settlement_login) as login ,bm_dayclosedate as dayclose,bm_billdate as date, sum((bm_amountpaid)-(bm_amountbalace)) as cash,bm_complimentary as comp,bm_billno as billno,sum(bm_transactionamount) as card,sum(bm_finaltotal) as sum_1 from tbl_tablebillmaster where $string group by bm_settlement_login,bm_dayclosedate union all
select distinct(tab_settlement_login)as login,  tab_dayclosedate as dayclose,tab_date as date,sum((tab_amountpaid)-(tab_amountbalace)) as cash,tab_complimentary as comp,tab_billno as billno,sum(tab_transactionamount) as card,sum(tab_netamt) as sum_1 from tbl_takeaway_billmaster where $stringta group by tab_settlement_login,tab_dayclosedate)x group by login,dayclose "); 
}


else if($department!="" && $department=='DI' ){
    $sql_logincashier  =  $database->mysqlQuery("select distinct(bm_settlement_login) as login ,bm_dayclosedate as dayclose,bm_complimentary as comp,bm_billdate as date,bm_billno as billno,sum((bm_amountpaid)-(bm_amountbalace)) as cash,sum(bm_transactionamount) as card,sum(bm_finaltotal) as tot from tbl_tablebillmaster where $string group by bm_billno"); 
}


else if($department!="" && $department!='DI'){
    $sql_logincashier  =  $database->mysqlQuery("select distinct(tab_settlement_login)as login,tab_dayclosedate as dayclose,tab_complimentary as comp,tab_date as date,tab_billno as billno,sum((tab_amountpaid)-(tab_amountbalace)) as cash,sum(tab_transactionamount) as card,sum(tab_netamt) as tot from tbl_takeaway_billmaster where  $stringta  group by tab_billno"); 
}

  $num_logincashier   = $database->mysqlNumRows($sql_logincashier);
   if($num_logincashier)
	{
       while($result_logincashier  = $database->mysqlFetchArray($sql_logincashier))
       {
           $final= $final + $result_logincashier['tot'];
          if($staff=="" && $department=="" ){ 
              
              
              
              
                        $data['DATE']=$result_logincashier['dayclose'];
                        $data['STAFF']=$result_logincashier['login'];
                        $data['CASH']=number_format($result_logincashier['cash'],$_SESSION['be_decimal']);
                        $data['CARD']=number_format($result_logincashier['card'],$_SESSION['be_decimal']);
                         $data['CREDIT']=number_format(0,$_SESSION['be_decimal']);
                          $data['COMPLIMENTARY']=number_format(0,$_SESSION['be_decimal']);
                        $data['TOTAL']=number_format($result_logincashier['tot'],$_SESSION['be_decimal']);
                        array_push($data1,$data);
                        unset($data);
                        
                                 
          
       }
       
       else{
           
                    
                        $data['DATE']=$result_logincashier['dayclose'];
                        $data['STAFF']=$result_logincashier['login'];
                        $data['CASH']=number_format($result_logincashier['cash'],$_SESSION['be_decimal']);
                        $data['CARD']=number_format($result_logincashier['card'],$_SESSION['be_decimal']);
                         $data['CREDIT']=number_format(0,$_SESSION['be_decimal']);
                       
                        if($result_logincashier['comp']=='Y'){ 
                            $data['COMPLIMENTARY']=number_format($result_logincashier['tot'],$_SESSION['be_decimal']);
                            
                        } else{
                            $data['COMPLIMENTARY']= "0.000";
                        
                        }
                        $data['TOTAL']=number_format($result_logincashier['tot'],$_SESSION['be_decimal']);
                        array_push($data1,$data);
                        unset($data);
                          
           
       }
        }}
                if($staff=="" && $department=="" ){ 
               $data['DATE']="TOTAL";
                        $data['STAFF']="";
                        $data['CASH']="";
                        $data['CARD']="";
                         $data['CREDIT']=number_format(0,$_SESSION['be_decimal']);
                          $data['COMPLIMENTARY']=number_format(0,$_SESSION['be_decimal']);
                        $data['TOTAL']=number_format($final,$_SESSION['be_decimal']);
                        array_push($data1,$data);
                        unset($data);
                }else{       
        
                        $data['DATE']="TOTAL";
                        $data['BILL NO']="";
                        $data['CASH']="";
                        $data['CARD']="";
                       $data['CREDIT']=number_format(0,$_SESSION['be_decimal']);
                       $data['COMPLIMENTARY']=number_format(0,$_SESSION['be_decimal']);
                        $data['TOTAL']=number_format($final,$_SESSION['be_decimal']);
                        array_push($data1,$data);
                        unset($data);
        
                }
        $filename = " Settlement Report-" . $reporthead . ".xls";
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
else if(($_REQUEST['type']=="kitchen_wise_report_cr"))
{
     	
	$string="";
        $stringta="";
        $reporthead="";
        $kitchen='';
        $kitchen=$_REQUEST['kitchen'];
	$string.=" bm.bm_status='Closed' AND ";
        $stringta.=" tbm.tab_status='Closed' AND ";
        if($kitchen!=''){
            $string.=" km.kr_kotcode='".$kitchen."' AND ";
            $stringta.=" km.kr_kotcode='".$kitchen."' AND ";
        }
         
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
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.=" tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
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
                
                
                
        $i=0;
        $final=0;
        $quantity=0;
        $data=array();
        $data1=array();
        $oldcat='';
        $oldkitchen='';
    $sql_login  =  $database->mysqlQuery("select kitchen,sum(qty) as qty,menu,category,sum(amount) as tot from( SELECT mc.mmy_maincategoryname as category,km.kr_kotname as kitchen,mm.mr_menuname menu,mm.mr_kotcounter,bd.bd_menuid as menuid,sum(bd_qty)as qty,sum(bd_rate*bd_qty)as amount from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno LEFT JOIN tbl_menumaster mm on mm.mr_menuid= bd.bd_menuid
                                          LEFT JOIN tbl_kotcountermaster km on km.kr_kotcode=mm.mr_kotcounter left join tbl_menumaincategory mc on mc.mmy_maincategoryid=mm.mr_maincatid where bd.bd_count_combo_ordering is NULL and $string group by bd_menuid union all SELECT mc.mmy_maincategoryname as category,km.kr_kotname as kitchen,mm.mr_menuname menu,mm.mr_kotcounter,tbd.tab_menuid as menuid,sum(tab_qty)as qty,sum(tab_rate*tab_qty)as amount from tbl_takeaway_billdetails tbd 
                                           left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno LEFT JOIN tbl_menumaster mm on mm.mr_menuid= tbd.tab_menuid LEFT JOIN tbl_kotcountermaster km on km.kr_kotcode=mm.mr_kotcounter left join tbl_menumaincategory mc on mc.mmy_maincategoryid=mm.mr_maincatid where tbd.tab_count_combo_ordering is NULL and $stringta  group by tbd.tab_menuid)x group by kitchen,menu,category order by kitchen, category"); 

   $num_login   = $database->mysqlNumRows($sql_login);
  
	
	  if($num_login)
	  {
              while($result_login  = $database->mysqlFetchArray($sql_login))
                {
                    $final= $final + $result_login['tot'];
                    $quantity= $quantity + $result_login['qty'];
                    if($oldkitchen!=$result_login['kitchen']){
                        $oldkitchen=$result_login['kitchen'];
                        
                        $data['Slno']='';
                        $data['Item']=$oldkitchen.'   Kitchen';
                        $data['Quantity']='';
                        $data['Total']='';
                        array_push($data1,$data);
                        unset($data);
                     }
                    $i++;
                          
                        if($oldcat!=$result_login['category']){
                        $oldcat=$result_login['category'];
                        
                        $data['Slno']="Category  : ".$oldcat;
                        $data['Item']='';
                        $data['Quantity']='';
                        $data['Total']='';
                        array_push($data1,$data);
                        unset($data);
                          
                   }
                          
                              $data['Slno']=$i;
                              $data['Item']=$result_login['menu'];
                              $data['Quantity']=$result_login['qty'];
                              $data['Total']=number_format($result_login['tot'],$_SESSION['be_decimal']);
                              array_push($data1,$data);
                              unset($data);
                         
                    
			
                } 
          }
          
                              $data['Slno']="TOTAL";
                              $data['Kitchen']="";
                              $data['Quantity']=$quantity;
                              $data['Total']=number_format($final,$_SESSION['be_decimal']);
                              array_push($data1,$data);
                                unset($data);
                              $filename = " Kitchen Wise  Report-" . $reporthead . ".xls";
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
 else if(($_REQUEST['type']=="discount_report_cr"))
{
   
    	
	$string="";
        $stringta="";
        $mode=$_REQUEST['department'];
        
         if($_REQUEST['item_disc']!='true'){  
        
    $string=" bm.bm_status='Closed' AND bm.bm_discountvalue>0 and  ";
    $stringta=" tbm.tab_status='Closed' AND  tbm.tab_discountvalue>0 and ";
    }else{
        
         $string=" bm.bm_status='Closed' and  ";
         $stringta=" tbm.tab_status='Closed'  and ";
    }
    
	$reporthead="";
	
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
                $reporthead="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $reporthead="Last 10 days";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $reporthead="Yester Day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $reporthead="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $reporthead="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $reporthead="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
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
                $reporthead="Today";
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
	
    $discount=0;
    $total=0;
    
    $data=array();
    $data1=array();
    
 if($_REQUEST['item_disc']!='true'){  
    
    
    if($mode==''){
            $sql_login  =  $database->mysqlQuery("select * from ( select bm.bm_login as login,bm.bm_dayclosedate as dayclose,bm.bm_discountlabel as disc_per,
            bm.bm_billno as bill,bm.bm_discountvalue as discount, 
            bm.bm_finaltotal as amount,'DI' AS mode FROM tbl_tablebillmaster bm where $string union all
            select tbm.tab_loginid as login,tbm.tab_dayclosedate as dayclose,tbm.tab_discount_label as disc_per,
            tbm.tab_billno as bill, tbm.tab_discountvalue as discount, tbm.tab_netamt as amount, tbm.tab_mode as mode FROM tbl_takeaway_billmaster tbm
            where $stringta ) x order by   mode"); 
            }
            else if($mode=='DI'){
            $sql_login  =  $database->mysqlQuery(" select bm.bm_login as login,bm.bm_dayclosedate as dayclose,bm.bm_discountlabel as disc_per,
            bm.bm_billno as bill,bm.bm_discountvalue as discount, bm.bm_finaltotal as amount,'DI' AS mode FROM tbl_tablebillmaster bm where $string "); 
            }
            else if($mode=='TA'||$mode=='CS'||$mode=='HD'){
                
            $sql_login  =  $database->mysqlQuery("select tbm.tab_loginid as login,tbm.tab_dayclosedate as dayclose,tbm.tab_discount_label as disc_per,
            tbm.tab_billno as bill, tbm.tab_discountvalue as discount, tbm.tab_netamt as amount, tbm.tab_mode as mode FROM tbl_takeaway_billmaster tbm
            where $stringta and tab_mode='".$mode."' order by  tbm.tab_mode"); 
            }
	
	  $num_login   = $database->mysqlNumRows($sql_login);
	  $i=0;
	  if($num_login)
	  {
		while($result_login  = $database->mysqlFetchArray($sql_login)){
                    $i++;
                    $total=$total+$result_login['amount'];
                    $discount=$discount+$result_login['discount'];
                    
                    $data['Sl']=$i;
                    $data['Date']=$result_login['dayclose'];
                    $data['Bill']=$result_login['bill'];
                    $data['Login']=$result_login['login'];
                    $data['Mode']=$result_login['mode'];
                    $data['Bill Total']=number_format($result_login['amount'],$_SESSION['be_decimal']);
                    $data['Discount']=number_format($result_login['discount'],$_SESSION['be_decimal']).' '.$result_login['disc_per'];
                    array_push($data1,$data);
                    unset($data);
                 
                  ?>
                                                                    
                <?php     
                   
                }
	  
            $data['SlNo']="";
              $data['Date']="";
            $data['Bill']="";
            $data['Login']="";
            $data['Mode']="";
            
            $data['Bill Total']="";
            $data['Discount']="";
            array_push($data1,$data);
            unset($data);
            
            $data['SlNo']="TOTAL";
              $data['Date']="";
            $data['Bill']="";
              $data['Login']="";
            $data['Mode']="";
            $data['Bill Total']=number_format($total,$_SESSION['be_decimal']);
            $data['Discount']=number_format($discount,$_SESSION['be_decimal']);
            array_push($data1,$data);
            unset($data);
            
          }   
          
          
          
    }else{
              
            
           if($_REQUEST['item_disc_type']!=''){  
        
             $string.="  and tds.bd_discount_id='".$_REQUEST['item_disc_type']."'   ";
             $stringta.="  and tks.tbd_discount_id='".$_REQUEST['item_disc_type']."'  ";

            }else{

                 $string.="    ";
                 $stringta.="    ";

            }
     
     
     
     ///////////item wise offer/////
 
  if($mode==''){
      
    
      
    $sql_login  =  $database->mysqlQuery("select * from ( select tbld.bd_org_rate as org,tbld.bd_rate as rate,tbld.bd_qty as qty,
                 tds.bd_discount as disc,tm.mr_menuname as menu,
                 tds.bd_discount_remarks as discname, bm.bm_billno as bill,bm.bm_discountvalue as discount, bm.bm_finaltotal as amount,
                 'DI' AS mode FROM tbl_tablebillmaster bm
                left join tbl_tablebill_item_discount tds on tds.bd_billno=bm.bm_billno left join tbl_menumaster tm on
                tm.mr_menuid=tds.bd_menuid left join tbl_tablebilldetails tbld on tbld.bd_billno=bm.bm_billno
                where tds.bd_discount>0 and  $string  group by bill,menu,discname union all
                    
                select tkld.tab_org_rate as org,tkld.tab_rate as rate,tkld.tab_qty as qty,tks.tbd_discount as disc,ttm.mr_menuname as menu,
                tks.tbd_discount_remarks as discname,tbm.tab_billno as bill,
                tbm.tab_discountvalue as discount, tbm.tab_netamt as amount, tbm.tab_mode as mode FROM tbl_takeaway_billmaster tbm
                left join tbl_takeaway_item_discount tks on tks.tbd_billno=tbm.tab_billno left join tbl_menumaster ttm on
                ttm.mr_menuid=tks.tbd_menuid left join tbl_takeaway_billdetails tkld on tkld.tab_billno=tbm.tab_billno
                where tks.tbd_discount>0 and $stringta group by bill,menu,discname ) x order by bill,menu,discname "); 
            }
    else if($mode=='DI'){
        $sql_login  =  $database->mysqlQuery("select tbld.bd_org_rate as org,tbld.bd_rate as rate,tbld.bd_qty as qty,
                 tds.bd_discount as disc,tm.mr_menuname as menu,
                 tds.bd_discount_remarks as discname, bm.bm_billno as bill,bm.bm_discountvalue as discount, bm.bm_finaltotal as amount,
                 'DI' AS mode FROM tbl_tablebillmaster bm
                left join tbl_tablebill_item_discount tds on tds.bd_billno=bm.bm_billno left join tbl_menumaster tm on
                tm.mr_menuid=tds.bd_menuid left join tbl_tablebilldetails tbld on tbld.bd_billno=bm.bm_billno
                where tds.bd_discount>0 and  $string  group by bill,menu,discname "); 
            }
    else if($mode=='TA'||$mode=='CS'||$mode=='HD'){
        $sql_login  =  $database->mysqlQuery(" select tkld.tab_org_rate as org,tkld.tab_rate as rate,tkld.tab_qty as qty,tks.tbd_discount as disc,ttm.mr_menuname as menu,
                tks.tbd_discount_remarks as discname,tbm.tab_billno as bill,
                tbm.tab_discountvalue as discount, tbm.tab_netamt as amount, tbm.tab_mode as mode FROM tbl_takeaway_billmaster tbm
                left join tbl_takeaway_item_discount tks on tks.tbd_billno=tbm.tab_billno left join tbl_menumaster ttm on
                ttm.mr_menuid=tks.tbd_menuid left join tbl_takeaway_billdetails tkld on tkld.tab_billno=tbm.tab_billno
                where tks.tbd_discount>0 and $stringta and tab_mode='".$mode."' group by bill,menu,discname"); 
            }
	  $num_login   = $database->mysqlNumRows($sql_login);
          
	  $i=0;
	  if($num_login)
	  {
	 	while($result_login  = $database->mysqlFetchArray($sql_login)){
                    $i++;
                   
                    $total=$total+$result_login['amount'];
                    $discount=$discount+($result_login['disc']*$result_login['qty']);
                    
                  
                   
                      $data['Sl No']=$i;
                    $data['Bill No']=$result_login['bill'];
                    $data['Discount Name']=$result_login['discname'];
                    $data['Menu Name']=$result_login['menu'];
                     $data['Qty']=$result_login['qty'];
                      $data['Rate Before']=$result_login['org'];
                      $data['Item Discount']=$result_login['disc'];
                     $data['Rate After ']=$result_login['rate'];
                     $data['Total']=$result_login['org']*$result_login['qty'];
                        
                      $data['total Discount']=$result_login['disc']*$result_login['qty'];
                        
                      $data['Final Total']=$result_login['rate']*$result_login['qty'];
                    
                    array_push($data1,$data);
                    unset($data);
                 
                  ?>
                                                                    
                <?php     
                   
                }
	  
            
                    $data['Sl No']='Total';
                    $data['Bill No']='';
                    $data['Discount Name']='';
                    $data['Menu Name']='';
                     $data['Qty']='';
                      $data['Rate Before']='';
                      $data['Item Discount']='';
                     $data['Rate After ']='';
                     $data['Total']='';
                        
                      $data['total Discount']=number_format($discount,$_SESSION['be_decimal']);
                        
                      $data['Final Total']='';
           
                
            array_push($data1,$data);
            unset($data);
              
              
          }  
               
  }
            
          
  $filename = " Consolidated Discount  Report-" . $reporthead . ".xls";
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
else if(($_REQUEST['type']=="complimentary_cr"))
{
     //echo "haiii";
    	
	$string="";
        $stringta="";
	$mode=$_REQUEST['department'];
        
	$string.=" bm.bm_status='Closed' AND bm.bm_complimentary='Y' and   ";
        $stringta.=" tbm.tab_status='Closed' AND tbm.tab_complimentary='Y' and  ";
	$reporthead="";
	
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
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $reporthead="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $reporthead="Last 10 days";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                  $reporthead="Yester Day";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $reporthead="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $stringta.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $reporthead="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $reporthead="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
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
                $reporthead="Today";
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
	?>
                                                  
                                                                     
	

<?php
    $amount=0;
    
    $data=array();
    $data1=array();
    $i=0;
    if($mode==''){
        $sql_login  =  $database->mysqlQuery("select * from (select tbm.tab_loginid as login,tbm.tab_dayclosedate as dayclose,tbm.tab_complimentaryremark as remarks,tbm.tab_billno as bill ,tbm.tab_date as billdate,tbm.tab_mode as mode,tbm.tab_netamt as amount FROM tbl_takeaway_billmaster tbm where $stringta union all
                                        select bm.bm_login as login,bm.bm_dayclosedate as dayclose,  bm.bm_complimentaryremark as remarks,bm.bm_billno as bill,bm.bm_billdate as billdate,'DI' AS mode,bm.bm_finaltotal as amount FROM tbl_tablebillmaster bm where $string )x order by x.mode asc "); 

        }
        else if($mode=='DI'){
            $sql_login  =  $database->mysqlQuery(" select bm.bm_login as login,bm.bm_dayclosedate as dayclose, bm.bm_complimentaryremark as remarks,bm.bm_billno as bill,bm.bm_billdate as billdate,'DI' AS mode,bm.bm_finaltotal as amount FROM tbl_tablebillmaster bm where $string "); 
        }
        else if($mode=='TA'||$mode=='CS'||$mode=='HD'){
          $sql_login  =  $database->mysqlQuery(" select tbm.tab_loginid as login,tbm.tab_dayclosedate as dayclose,tbm.tab_complimentaryremark as remarks,tbm.tab_billno as bill ,tbm.tab_date as billdate,tbm.tab_mode as mode,tbm.tab_netamt as amount FROM tbl_takeaway_billmaster tbm where $stringta and tbm.tab_mode='".$mode."' ");   
        }
	$num_login   = $database->mysqlNumRows($sql_login);
          
           if($num_login)
	  {
              while($result_login  = $database->mysqlFetchArray($sql_login)){
                  $i++;
                 $amount=$amount+$result_login['amount'];
                  
                $data['Sl No']=$i;
                $data['Date']=$result_login['dayclose'];
                $data['Bill No']=$result_login['bill'];
                $data['Login']=$result_login['login'];
                $data['Mode']=$result_login['mode'];
                $data['Remarks']=$result_login['remarks'];
                $data['Amount']=number_format($result_login['amount'],$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
          
                
                
               if($_REQUEST['comp_item_wise']=='true' && ($mode=='DI' || $mode=='')){
           
           $ct=1;  
           $sql_login1  =  $database->mysqlQuery("select bd.bd_billno as bill, sum(bd.bd_qty) as qty,sum(bd.bd_amount) as total,bd_rate as rate,
               CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionname,''),COALESCE(REPLACE(bd.bd_unit_weight,'0.000',''),''),
               COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_tablebilldetails bd
                                                    LEFT  join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = bd.bd_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=bd.bd_portion
                                                    left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                                    where bd.bd_count_combo_ordering IS NULL and bm.bm_billno='".$result_login['bill']."' 
                                                    group by bd.bd_menuid, bd.bd_portion, bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight  ");   
           
          
            $num_login1   = $database->mysqlNumRows($sql_login1); 
             if($num_login1)
            {
            while($result_login1= $database->mysqlFetchArray($sql_login1)){
                
                
                $data['Sl No']=$ct++;
                 $data['Date']='';
                $data['Bill No']="*".$result_login1['menu'];
                 $data['Login']='';
                $data['Mode']='Qty:'.$result_login1['qty'];
                $data['Remarks']='Rate :'.number_format($result_login1['rate'],$_SESSION['be_decimal']);
                $data['Amount']=number_format($result_login1['total'],$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
                
                
            }
            
            $data['Sl No']="";
             $data['Date']='';
                $data['Bill No']="";
                 $data['Login']='';
                $data['Mode']="";
                  $data['Remarks']="";
                $data['Amount']="";
                array_push($data1,$data);
                unset($data);
            
            
            }
            
            }
                
           if($_REQUEST['comp_item_wise']=='true' && ( ($mode=='TA'|| $mode=='CS'|| $mode=='HD') || $mode=='')){
           
           $ct=1;  
           
           
           $sql_login1  =  $database->mysqlQuery("select tbd.tab_billno as bill, sum(tbd.tab_qty) as qty,sum(tbd.tab_amount) as total, 
               CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionname,''),COALESCE(REPLACE(tbd.tab_unit_weight,'0.000',''),''),
               COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid,tbd.tab_rate as rate
                                                    FROM tbl_takeaway_billdetails tbd
                                                    LEFT  join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = tbd.tab_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=tbd.tab_portion
                                                    left join  tbl_unit_master um on um.u_id=tbd.tab_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
                                                    where tbd.tab_count_combo_ordering IS NULL and tbm.tab_billno='".$result_login['bill']."' 
                                                    group by tbd.tab_menuid, tbd.tab_portion, tbd.tab_unit_id, tbd.tab_base_unit_id,tbd.tab_unit_weight ");
   
           
          
            $num_login1   = $database->mysqlNumRows($sql_login1); 
             if($num_login1)
            {
            while($result_login1= $database->mysqlFetchArray($sql_login1)){
               
            $data['Sl No']=$ct++;
             $data['Date']='';
                $data['Bill No']="*".$result_login1['menu'];
                $data['Mode']='Qty:'.$result_login1['qty'];
                $data['Remarks']='Rate :'.number_format($result_login1['rate'],$_SESSION['be_decimal']);
                $data['Amount']=number_format($result_login1['total'],$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
                
            
            }
            
                $data['Sl No']="";
                $data['Date']='';
                $data['Bill No']="";
                 $data['Login']='';
                $data['Mode']="";
                $data['Remarks']="";
                $data['Amount']="";
                array_push($data1,$data);
                unset($data);
            
            }
                
                }
            
            
          }}
           
                $data['Sl No']="";
                 $data['Date']='';
                $data['Bill No']="";
                 $data['Login']='';
                $data['Mode']="";
                  $data['Remarks']="";
                $data['Amount']="";
                array_push($data1,$data);
                unset($data);
                
                
            
                $data['Sl No']='Total';
                 $data['Date']='';
                $data['Bill No']="";
                 $data['Login']='';
                $data['Mode']="";
                  $data['Remarks']="";
                $data['Amount']=number_format($amount,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
                
                
  $filename = " Consolidated Complimentary  Report-" . $reporthead . ".xls";
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

else if(($_REQUEST['type']=="consolidated_payment_cr"))
{
    
        $string1="";
        $stringta1="";
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
                $stringta = " pym_code='credit'  and tab_status='closed' and   ";
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
                $stringta = "  tab_status='closed' and ";
                 $fields="<th class='sortable'>Cash Amount</th>";
                  $fields.="<th class='sortable'>Card Amount</th>";
                 
                  $fields.="<th class='sortable'>Cheque</th>";
                  $fields.="<th class='sortable'>Coupon Amount</th>";
                  $fields.="<th class='sortable'>Credit Amount</th>";
                  $fields.="<th class='sortable'>Complimentary Amount </th>";
		$fields.="<th class='sortable'>Upi Amount</th>";
                $fields_dummy="<td></td>";
       
	
	}
                     
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                        $string1.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta1.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                        $reporthead.= " From-".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                        $string1.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta1.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                        $reporthead.= " From".$from."- To-".$to." ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
                        $string1.= "  bm_dayclosedate between '".$from."' and '".$to."'  ";
                        $stringta1.= "  tab_dayclosedate between '".$from."' and '".$to."'  ";
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
                     $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                    $reporthead.="Last5days";
                }
                elseif($bydatz=="Last10days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                     $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                    $reporthead.="Last10days";
                }
                else if($bydatz=="Yesterday")
                {
                    $string.="  bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta.="  tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                     $string1.="  bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                    $stringta1.="  tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                     $reporthead.="Yesterday";
                }
                elseif($bydatz=="Last15days")
                {
                    $string.="   bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $stringta.="   tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                     $string1.="   bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                    $stringta1.="   tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                     $reporthead.="Last15days";
                }
                else if($bydatz=="Last20days")
                {
                    $string.="   bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $stringta.="   tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $string1.="   bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $stringta1.="   tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                    $reporthead.="Last20days";
                }   
                else if($bydatz=="Last25days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                      $reporthead.="Last25days";
                }
                else if($bydatz=="Last30days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                     $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                      $reporthead.="Last30days";
                }
                else if($bydatz=="Last1month")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
                     $reporthead.="Last1month";
                }
                else if($bydatz=="Today")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                     $reporthead.="Today";
                }
                else if($bydatz=="Last90days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                    $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                     $reporthead.="Last90days";
                }
                else if($bydatz=="Last180days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                    $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
                    $reporthead.="Last180days";
                }
                else if($bydatz=="Last365days")
                {
                    $string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $stringta.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $string1.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $stringta1.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                    $reporthead.="Last365days";
                }
                }
        else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $string1.= " bm_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta1.= " tab_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " On -".$from;
	}
        }

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
                $data=array();
                $data1=array();

          if($mode==''){
              
              $sql_login1  =  $database->mysqlQuery("select * from tbl_tablebillmaster b LEFT JOIN tbl_bankmaster ON b.bm_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON b.bm_paymode= p.pym_id where $string order by b.bm_billdate,b.bm_billtime asc "); 
              $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1)
	  { 
              while($result_login= $database->mysqlFetchArray($sql_login1))
              {                                                 
                $data['Bill  No']=$result_login['bm_billno'];
                $data['Bill Date']=$database->convert_date($result_login['bm_billdate']);
                             
                            
				if($_REQUEST['payment']=="1")
				{
				
				 $data['Cash Amount']=number_format(($result_login['bm_amountpaid']-$result_login['bm_amountbalace']),$_SESSION['be_decimal']);
				
				}else if($_REQUEST['payment']=="2")
				{
				
                                $data['Bank']=$result_login['bm_name'];
                                $data['Card Amount']=number_format($result_login['bm_transactionamount'],$_SESSION['be_decimal']);
                               
				}else if($_REQUEST['payment']=="3")
				{
				
                               $data['Coupon Company']=$result_login['bm_couponcompany'];
                               $data['Coupon Amount']=number_format($result_login['bm_couponamt'],$_SESSION['be_decimal']);
                               $data['Paid']=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
                             
				}else if($_REQUEST['payment']=="4")
				{
                              $data['Voucher']=$result_login['bm_voucherid'];
                                $data['Voucher Amount']=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
                               
				}else if($_REQUEST['payment']=="5")
				{
				
                                $data['Cheque no']=$result_login['bm_chequeno'];
                                $data['Bank']=$result_login['bm_chequebankname'];
                                $data['Cheque Amount']=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal']);
                               
				}
				
                                else if($_REQUEST['payment']=="6")
				{
				
                              
                                $data['Credit Amount']=number_format(($result_login['bm_finaltotal']-($result_login['bm_amountpaid']-$result_login['bm_amountbalace'])),$_SESSION['be_decimal']);
                               
				}else if($_REQUEST['payment']=="7")
				{
				
                              
                                $data['Complimentary Amount']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
                               
				}else if($_REQUEST['payment']=="8")
				{
				
                              
                                $data['Upi Amount']=number_format($result_login['bm_upi_amount'],$_SESSION['be_decimal']);
                                
				}
				
                                else if($_REQUEST['payment']=="all")
				{
				 if(($result_login['bm_amountpaid']-$result_login['bm_amountbalace'])>0){ 

                              $data['Cash']=number_format(($result_login['bm_amountpaid']-$result_login['bm_amountbalace']),$_SESSION['be_decimal']);

                               } else{ 
                              $data['Cash']=number_format(0,$_SESSION['be_decimal']);
                              } 
                              
                                if($result_login['bm_paymode']=='2'){ 
                              $data['Card']=number_format($result_login['bm_transactionamount'],$_SESSION['be_decimal']);
                               } else{ 
                              $data['Card']=number_format(0,$_SESSION['be_decimal']);
                                } 
                              
                              if($result_login['bm_paymode']=='3'){
                             $data['Coupon'] =number_format($result_login['bm_couponamt'],$_SESSION['be_decimal']);
                              } else{
                             $data['Coupon']=number_format(0,$_SESSION['be_decimal']);
                           } 
                              
                              
                               if($result_login['bm_paymode']=='5'){ 
                           $data['Cheque']=number_format($result_login['bm_chequebankamount'],$_SESSION['be_decimal']);
                               }else{
                             $data['Cheque']=number_format(0,$_SESSION['be_decimal']);
                         } 
                              
                              
                               if($result_login['bm_paymode']=='6'){ 
                              $data['Credit']=number_format(($result_login['bm_finaltotal']-($result_login['bm_amountpaid']-$result_login['bm_amountbalace'])),$_SESSION['be_decimal']);
                         } else{ 
                           $data['Credit']=number_format(0,$_SESSION['be_decimal']);
                           } 
                              
                               if($result_login['bm_paymode']=='7'){ 
                         $data['Complimentary'] =number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
                           } else{ 
                            $data['Complimentary']=number_format(0,$_SESSION['be_decimal']);
                             } 
                              
                              
                                if($result_login['bm_paymode']=='8'){ 
                           $data['Upi'] =number_format($result_login['bm_upi_amount'],$_SESSION['be_decimal']);
                                } else{ 
                             $data['Upi']=number_format(0,$_SESSION['be_decimal']);
                         } 
                              
                               
                              
				}
                                
                                
                                
                              $data['Total']=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
                                  
                             array_push($data1,$data);
                            unset($data);   
                    
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
        
        $sql_loginta1  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster t LEFT JOIN tbl_bankmaster ON t.tab_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON t.tab_paymode= p.pym_id where $stringta order by t.tab_date,t.tab_time asc "); 
         $num_loginta1   = $database->mysqlNumRows($sql_loginta1);
	if($num_loginta1)
	  {
              while($result_loginta1= $database->mysqlFetchArray($sql_loginta1))
              {
                   
                  $data['Bill No']=$result_loginta1['tab_billno'];
                $data['Bill Date']=$database->convert_date($result_loginta1['tab_date']);
                             
                            
				if($_REQUEST['payment']=="1")
				{
				
				 $data['Cash Amount']=number_format(($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace']),$_SESSION['be_decimal']);
				
				}else if($_REQUEST['payment']=="2")
				{
				
                                $data['Bank']=$result_loginta1['bm_name'];
                                $data['Card Amount']=number_format($result_loginta1['tab_transactionamount'],$_SESSION['be_decimal']);
                               
				}else if($_REQUEST['payment']=="3")
				{
				
                               $data['Coupon Company']=$result_loginta1['tab_couponcompany'];
                               $data['Coupon Amount']=number_format($result_loginta1['tab_couponamt'],$_SESSION['be_decimal']);
                               $data['Paid']=number_format($result_loginta1['tab_amountpaid'],$_SESSION['be_decimal']);
                             
				}else if($_REQUEST['payment']=="4")
				{
                              $data['Voucher']=$result_loginta1['tab_voucherid'];
                                $data['Voucher Amount']=number_format($result_loginta1['tab_amountpaid'],$_SESSION['be_decimal']);
                               
				}else if($_REQUEST['payment']=="5")
				{
				
                                $data['Cheque no']=$result_loginta1['tab_chequeno'];
                                $data['Bank']=$result_loginta1['tab_chequebankname'];
                                $data['Cheque Amount']=number_format($result_loginta1['tab_amountpaid'],$_SESSION['be_decimal']);
                               
				}
				
                                else if($_REQUEST['payment']=="6")
				{
				
                              
                                $data['Credit Amount']=number_format(($result_loginta1['tab_netamt']-($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace'])),$_SESSION['be_decimal']);
                               
				}else if($_REQUEST['payment']=="7")
				{
				
                              
                                $data['Complimentary Amount']=number_format($result_loginta1['tab_netamt'],$_SESSION['be_decimal']);
                               
				}else if($_REQUEST['payment']=="8")
				{
				
                              
                                $data['Upi Amount']=number_format($result_loginta1['tab_upi_amount'],$_SESSION['be_decimal']);
                                
				}
				else if($_REQUEST['payment']=="all")
				{
                                    
                                    
                               if(($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace'])>0){  
				
                                
				$data['Cash']=number_format(($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace']),$_SESSION['be_decimal']);
				
				}else{ 
                               $data['Cash']=number_format(0,$_SESSION['be_decimal']);
                                } 
                               
                                
                                if($result_loginta1['tab_paymode']=='2'){  
				
                                
			  $data['Card']=number_format($result_loginta1['tab_transactionamount'],$_SESSION['be_decimal']);
				
				}else{
                                 $data['Card']=number_format(0,$_SESSION['be_decimal']);
                                }
                                
                                 if($result_loginta1['tab_paymode']=='3'){
                            $data['Coupon']=number_format($result_loginta1['tab_couponamt'],$_SESSION['be_decimal']);
                              } else{ 
                             $data['Coupon']=number_format(0,$_SESSION['be_decimal']);
                              }
                              
                              
                             if($result_loginta1['tab_paymode']=='5'){ 
                             $data['Cheque']=number_format($result_loginta1['tab_chequebankamount'],$_SESSION['be_decimal']);
                                } else{ 
                             $data['Cheque']=number_format(0,$_SESSION['be_decimal']);
                                } 
                              
                              
                           if($result_loginta1['tab_paymode']=='6'){ 
                            $data['Credit']=number_format(($result_loginta1['tab_netamt']-($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace'])),$_SESSION['be_decimal']);
                            } else{
                             $data['Credit']=number_format(0,$_SESSION['be_decimal']);
                              } 
                              
                               if($result_loginta1['tab_paymode']=='7'){ 
                             $data['Complimentary']=number_format($result_loginta1['tab_netamt'],$_SESSION['be_decimal']);
                                } else{ 
                                $data['Complimentary']=number_format(0,$_SESSION['be_decimal']);
                                } 
                              
                              
                              if($result_loginta1['tab_paymode']=='8'){ 
                               $data['Upi']=number_format($result_loginta1['tab_upi_amount'],$_SESSION['be_decimal']);
                              } else{ 
                             $data['Upi']=number_format(0,$_SESSION['be_decimal']);
                               } 
                                 
                                 
                              
                                
                                
				}
                                
                                
                                
                                
                              $data['Total']=number_format($result_loginta1['tab_netamt'],$_SESSION['be_decimal']);
                                  
                             array_push($data1,$data);
                              unset($data);   
                    
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
   
   
   if($_REQUEST['payment']=="1")
		{
       
         $data['Bill No']="Total";
         $data['Bill Date']="";
         $data['Cash Amount']=number_format($cash_sum,$_SESSION['be_decimal']);
         $data['Total']=number_format($alltotal_sum,$_SESSION['be_decimal']);
         array_push($data1,$data);
          unset($data);
      
  }else if($_REQUEST['payment']=="2")
	{
      
         $data['Bill No']="Total";
         $data['Bill Date']="";
           $data['Bank']="";
             
         $data['Card Amount']=number_format($card_sum,$_SESSION['be_decimal']);
         $data['Total']=number_format($alltotal_sum,$_SESSION['be_decimal']);
      array_push($data1,$data);
    unset($data);
  } else if($_REQUEST['payment']=="3")
	{ 
         $data['Bill No']="Total";
         $data['Bill Date']="";
          $data['Coupon Company']="";
          $data['Coupon Amount']=number_format($coupon_sum,$_SESSION['be_decimal']);
          $data['Paid']="";
         $data['Total']=number_format($alltotal_sum,$_SESSION['be_decimal']);
        array_push($data1,$data);
    unset($data);
      
  } else if($_REQUEST['payment']=="4")
	{
       $data['Bill No']="Total";
         $data['Bill Date']="";
         $data['Voucher']="";
         $data['Voucher Amount']=number_format($voucher_sum,$_SESSION['be_decimal']);
         $data['Total']=number_format($alltotal_sum,$_SESSION['be_decimal']);
        array_push($data1,$data);
    unset($data);
  } else if($_REQUEST['payment']=="5")
	{
       $data['Bill No']="Total";
         $data['Bill Date']="";
         $data['Cheque No']="";
         $data['Cheque Amount']=number_format($cheq_sum,$_SESSION['be_decimal']);
         $data['Total']=number_format($alltotal_sum,$_SESSION['be_decimal']);
        array_push($data1,$data);
    unset($data);
  } else if($_REQUEST['payment']=="6")
	{
      $data['Bill No']="Total";
         $data['Bill Date']="";
        
         $data['Credit Amount']=number_format($creditsum,$_SESSION['be_decimal']);
         $data['Total']=number_format($alltotal_sum,$_SESSION['be_decimal']);
       array_push($data1,$data);
    unset($data);
  }
  else if($_REQUEST['payment']=="7")
	{
      $data['Bill No']="Total";
         $data['Bill Date']="";
        
         $data['Complimentary Amount']=number_format($compli_sum,$_SESSION['be_decimal']);
         $data['Total']=number_format($alltotal_sum,$_SESSION['be_decimal']);
       array_push($data1,$data);
    unset($data);
  }else if($_REQUEST['payment']=="8")
	{
       $data['Bill No']="Total";
       
         $data['Bill Date']="";
         $data['Upi Amount']=number_format($upi_sum,$_SESSION['be_decimal']);
         $data['Total']=number_format($alltotal_sum,$_SESSION['be_decimal']);
        array_push($data1,$data);
        unset($data);
  }else if($_REQUEST['payment']=="all")
	{
      $c1=0;
      $c2=0;
      $sql_loginta12  =  $database->mysqlQuery("select tab_netamt from tbl_takeaway_billmaster  where tab_paymode='7' and tab_status='Closed' and $stringta1 "); 
       
        $num_loginta12   = $database->mysqlNumRows($sql_loginta12);
	if($num_loginta12)
	  {
              while($result_loginta12= $database->mysqlFetchArray($sql_loginta12))
              {
                 $c1= $c1+$result_loginta12['tab_netamt'];
                  
              }
              }
      
      $sql_loginta13  =  $database->mysqlQuery("select bm_finaltotal from tbl_tablebillmaster  where bm_paymode='7' and bm_status='Closed' and  $string1 "); 
       
        $num_loginta13   = $database->mysqlNumRows($sql_loginta13);
	if($num_loginta13)
	  {
              while($result_loginta13= $database->mysqlFetchArray($sql_loginta13))
              {
                  $c2= $c2+$result_loginta13['bm_finaltotal'];
                  
              }
              }
      $co_all=$c1+$c2;
       
      
      $cr1=0;
      $cr2=0;
      $sql_loginta121  =  $database->mysqlQuery("select tab_netamt,tab_amountpaid,tab_amountbalace from tbl_takeaway_billmaster  where tab_paymode='6' and tab_status='Closed' and $stringta1 "); 
       
        $num_loginta121   = $database->mysqlNumRows($sql_loginta121);
	if($num_loginta121)
	  {
              while($result_loginta121= $database->mysqlFetchArray($sql_loginta121))
              {
                 $cr1= $cr1+($result_loginta121['tab_netamt']-($result_loginta121['tab_amountpaid']-$result_loginta121['tab_amountbalace']));
                  
              }
              }
      
      $sql_loginta131  =  $database->mysqlQuery("select bm_finaltotal,bm_amountpaid,bm_amountbalace from tbl_tablebillmaster  where bm_paymode='6' and bm_status='Closed' and $string1  "); 
       
        $num_loginta131   = $database->mysqlNumRows($sql_loginta131);
	if($num_loginta131)
	  {
              while($result_loginta131= $database->mysqlFetchArray($sql_loginta131))
              {
                  $cr2= $cr2+($result_loginta131['bm_finaltotal']-($result_loginta131['bm_amountpaid']-$result_loginta131['bm_amountbalace']));
                  
              }
              }
      $cr_all=$cr1+$cr2;
      
      
      $data['Bill No']="Total";
        $data['Bill Date']="";
         $data['Cash']=number_format($cash_sum,$_SESSION['be_decimal']);
          $data['Card']=number_format($card_sum,$_SESSION['be_decimal']);
           $data['Cheque']="0";
            $data['Coupon']="0";
             $data['Credit']=number_format($cr_all,$_SESSION['be_decimal']);
              $data['Complimentary']=number_format($co_all,$_SESSION['be_decimal']);
         $data['Upi Amount']=number_format($upi_sum,$_SESSION['be_decimal']);
         $data['Total']=number_format($alltotal_sum,$_SESSION['be_decimal']);
        array_push($data1,$data);
        unset($data);
       
      
    
  }
  
  
          }
  
   $mode_pay=array();  
          
        if($mode=='DI'){
	$sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster b LEFT JOIN tbl_bankmaster ON b.bm_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON b.bm_paymode= p.pym_id where $string order by b.bm_billdate,b.bm_billtime asc"); 
     
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {
              while($result_login= $database->mysqlFetchArray($sql_login))
              {
                  $mode_pay[]=  $result_login['bm_paymode'];
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
             $sql_loginta  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster t LEFT JOIN tbl_bankmaster ON t.tab_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON t.tab_paymode= p.pym_id where tab_mode='$mode' and $stringta order by t.tab_date,t.tab_time asc "); 
       
             $num_loginta   = $database->mysqlNumRows($sql_loginta);
	     if($num_loginta)
	      {
              while($result_loginta= $database->mysqlFetchArray($sql_loginta))
              {
                   $mode_pay[]=  $result_loginta['tab_paymode']; 
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
                


          $data['Bill No']= $billno[$i];
         $data['Date']=$database->convert_date($day[$i]);
        
                 
				if($_REQUEST['payment']=="1")
				{
				
				 $data['Cash Amount']= $cash[$i];
				
				}else if($_REQUEST['payment']=="2")
				{
				
                               $data[' Bank']= $bank[$i];
                               $data['Card Amount']= $card[$i];
                              
				}else if($_REQUEST['payment']=="3")
				{
				
                                $data['Company']=$coupon_company[$i];
                               $data['Coupon Amount']= $coupon[$i];
                                $data['Paid Amount']=$coupon_paid[$i];
                               
				}else if($_REQUEST['payment']=="4")
				{
				
                                $data['Voucher']= $voucherid[$i];
                              $data['Voucher Amount']=$voucher[$i];
                               
				}else if($_REQUEST['payment']=="5")
				{
				
                               $data['Cheque no']=$cheqno[$i];
                               $data['Bank']=$cheq_bank[$i];
                                $data['Cheque Amount']=$cheqamount[$i];
                               
				} else if($_REQUEST['payment']=="6")
				{
				
                              
                               $data['Credit Amount']= $credit_person[$i];
                               
				}else if($_REQUEST['payment']=="7")
				{
				
                              
                                $data['Complimentary Amount']=$complimentary[$i];
                               
				}else if($_REQUEST['payment']=="8")
				{
				
                              
                               $data['Upi Amount']=$upi[$i];
                               
				}
				 else if($_REQUEST['payment']=="all")
				{
                                    
				 if(str_replace(",","",$cash[$i])>0){
                             $data['Cash']=number_format(str_replace(",","",$cash[$i]),$_SESSION['be_decimal']);
                              } else{ 
                               $data['Cash']=number_format(0,$_SESSION['be_decimal']);
                              } 
                                
                                
                                 if($mode_pay[$i]=='2'){ 
                              $data['Card']=number_format(str_replace(",","",$card[$i]),$_SESSION['be_decimal']);
                           } else{ 
                              $data['Card']=number_format(0,$_SESSION['be_decimal']);
                               }
                                
                               if($mode_pay[$i]=='3'){ 
                              $data['Coupon']=number_format($coupon_paid[$i],$_SESSION['be_decimal']);
                                } else{ 
                              $data['Coupon']=number_format(0,$_SESSION['be_decimal']);
                               }
                                
                                
                              if($mode_pay[$i]=='5'){ 
                              $data['Cheque']=number_format($cheqamount[$i],$_SESSION['be_decimal']);
                                } else{ 
                               $data['Cheque']=number_format(0,$_SESSION['be_decimal']);
                               } 
                                
                                if($mode_pay[$i]=='6'){ 
                             $data['Credit']=number_format(str_replace(",","",$credit_person[$i]),$_SESSION['be_decimal']);
                                 } else{ 
                            $data['Credit']=number_format(0,$_SESSION['be_decimal']);
                                }
                                
                               if($mode_pay[$i]=='7'){ 
                             $data['Complimentary']=number_format(str_replace(",","",$complimentary[$i]),$_SESSION['be_decimal']);
                             } else{ 
                              $data['Complimentary']=number_format(0,$_SESSION['be_decimal']);
                               } 
                                
                                
                             if($mode_pay[$i]=='8'){ 
                              $data['Upi']=number_format($upi[$i],$_SESSION['be_decimal']);
                                } else{ 
                             $data['Upi']=number_format(0,$_SESSION['be_decimal']);
                                 } 
                                
                                
                                
                                
				}
                                
                                
                                
                               $data['Total']=$final[$i];
                                         
                    array_push($data1,$data);
    unset($data);
                           
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
                  
                  
        
                  if($_REQUEST['payment']=="1")
				{
                      
                                $data['Bill No']="Total";
                                $data['Bill Date']="";
                                $data['Cash Amount']=number_format(array_sum($cash_final),$_SESSION['be_decimal']);
                                $data['Total']=number_format(array_sum($total_final),$_SESSION['be_decimal']);
         array_push($data1,$data);
              unset($data);
  }else if($_REQUEST['payment']=="2")
	{
                           $data['Bill No']="Total";
                                $data['Bill Date']="";
                                 $data['Bank']="";
                                $data['Card Amount']=number_format(array_sum($card_final),$_SESSION['be_decimal']);
                                $data['Total']=number_format(array_sum($total_final),$_SESSION['be_decimal']);
       array_push($data1,$data);
    unset($data);
  } else if($_REQUEST['payment']=="3")
	{
                                $data['Bill No']="Total";
                                $data['Bill Date']="";
                                 $data['Coupon Company']="";
                                $data['Coupon Amount']=number_format(array_sum($coupon_final),$_SESSION['be_decimal']);
                                 $data['Paid Amount']="";
                                $data['Total']=number_format(array_sum($total_final),$_SESSION['be_decimal']);
       array_push($data1,$data);
    unset($data);
  } else if($_REQUEST['payment']=="4")
	{
                                 $data['Bill No']="Total";
                                $data['Bill Date']="";
                                 $data['Voucher']="";
                                $data['Voucher Amount']=number_format(array_sum($voucher_final),$_SESSION['be_decimal']);
                                $data['Total']=number_format(array_sum($total_final),$_SESSION['be_decimal']);
       array_push($data1,$data);
    unset($data);
     
  } else if($_REQUEST['payment']=="5")
	 {
                               $data['Bill No']="Total";
                                $data['Bill Date']="";
                                 $data['Cheque No']="";
                                $data['Cheque Amount ']=number_format(array_sum($cheq_final),$_SESSION['be_decimal']);
                                $data['Total']=number_format(array_sum($total_final),$_SESSION['be_decimal']);
        array_push($data1,$data);
    unset($data);
  } else if($_REQUEST['payment']=="6")
	{
                           $data['Bill No']="Total";
                                $data['Bill Date']="";
                                
                                $data['Credit Amount']=number_format(array_sum($credit_final),$_SESSION['be_decimal']);
                                $data['Total']=number_format(array_sum($total_final),$_SESSION['be_decimal']);
        array_push($data1,$data);
    unset($data);
  }
  else if($_REQUEST['payment']=="7")
	{
                              $data['Bill No']="Total";
                               
                                 $data['Bill Date']="";
                                $data['Complimentary Amount']=number_format(array_sum($compli_final),$_SESSION['be_decimal']);
                                $data['Total']=number_format(array_sum($total_final),$_SESSION['be_decimal']);
       array_push($data1,$data);
      unset($data);
  }else if($_REQUEST['payment']=="8")
	{
                                $data['Bill No']="Total";
                                
                                 $data['Bill Date']="";
                                $data['Upi Amount']=number_format(array_sum($upi_final),$_SESSION['be_decimal']);
                                $data['Total']=number_format(array_sum($total_final),$_SESSION['be_decimal']);
                array_push($data1,$data);
    unset($data);
        }
         else if($_REQUEST['payment']=="all")
	{
            
            $compl= array();
            $credi=  array();
            if($mode=='TA'||$mode=='HD'||$mode=='CS'){
             $sql_loginta  =  $database->mysqlQuery("select tab_netamt from tbl_takeaway_billmaster  where tab_mode='$mode' and $stringta1 and tab_status='Closed' and tab_paymode='7' "); 
       
             $num_loginta   = $database->mysqlNumRows($sql_loginta);
	     if($num_loginta)
	      {
              while($result_loginta= $database->mysqlFetchArray($sql_loginta))
              {
                 $compl[]= number_format($result_loginta['tab_netamt'],$_SESSION['be_decimal']);
                  
              }
              }
              
              
              
              $sql_loginta1  =  $database->mysqlQuery("select tab_netamt,tab_amountpaid,tab_amountbalace from tbl_takeaway_billmaster  where tab_mode='$mode' and $stringta1 and tab_status='Closed' and tab_paymode='6' "); 
       
             $num_loginta1   = $database->mysqlNumRows($sql_loginta1);
	     if($num_loginta1)
	      {
              while($result_loginta1= $database->mysqlFetchArray($sql_loginta1))
              {
                 $credi[]=number_format(($result_loginta1['tab_netamt']-($result_loginta1['tab_amountpaid']-$result_loginta1['tab_amountbalace'])),$_SESSION['be_decimal']);
                  
              }
              }
              
              
            }
            
            if($mode=="DI"){
               $sql_login  =  $database->mysqlQuery("select bm_finaltotal from tbl_tablebillmaster  where $string1 and bm_status='Closed' and bm_paymode='7' "); 
     
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {
              while($result_login= $database->mysqlFetchArray($sql_login))
              {
                   $compl[]= number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);
                  
              }
              } 
              
              
              $sql_login1  =  $database->mysqlQuery("select bm_finaltotal,bm_amountpaid,bm_amountbalace from tbl_tablebillmaster  where $string1 and bm_status='Closed' and bm_paymode='6' "); 
     
        $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1)
	  {
              while($result_login1= $database->mysqlFetchArray($sql_login1))
              {
                   $credi[]= number_format(($result_login1['bm_finaltotal']-($result_login1['bm_amountpaid']-$result_login1['bm_amountbalace'])),$_SESSION['be_decimal']);
                  
              }
              } 
              
              
            }
            
            
            if($mode!=''){
             $compli_final_new= str_replace(",","",$compl);
                $credit_final_new= str_replace(",","",$credi);
            }
                            $data['Bill No']="Total";
                                
                                  $data['Bill Date']="";
                                  $data['Cash']=number_format(array_sum($cash_final),$_SESSION['be_decimal']);
                                  $data['Card']=number_format(array_sum($card_final),$_SESSION['be_decimal']);
                                  $data['Cheque']=number_format(0,$_SESSION['be_decimal']);
                                    
                                 $data['Coupon']=number_format(0,$_SESSION['be_decimal']);
                                 $data['Credit']=number_format(array_sum($credit_final_new),$_SESSION['be_decimal']);
                                 $data['Complimentary']=number_format(array_sum($compli_final_new),$_SESSION['be_decimal']); 
                                      
                                      
                                $data['Upi Amount']=number_format(0,$_SESSION['be_decimal']);
                                $data['Total']=number_format(array_sum($total_final),$_SESSION['be_decimal']);
                array_push($data1,$data);
               unset($data);
                       
        }
        
        
        
        }
             
   $filename = " Payment Report-".$mode."-" . $reporthead . ".xls";
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
                $reporthead="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="ch_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.="tc_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $reporthead="Last 10 days";
	}
	else if($bydatz=="Yesterday")
	{
            $string.="ch_dayclosedate = CURDATE() - INTERVAL 1 day ";
            $stringta.="tc_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
            $reporthead="Yesterday";
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
                $reporthead="Today";
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
			$string.= " ch_dayclosedate between '".$from."' and '".$to."' ";
                        $stringta.= " tc_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead.= " On -".$from;
	}
        }
	
	
       $rate=0;   $rate1=0; $tot_rt=0; $tot_rt1=0;
        $qtyall=0; $tot_rt_all=array();
      
        $bill_order=array();
        $cancel_qty=array();
         $cancel_by  =array();     
          $cancel_time  =array();
          $cancel_reason=  array();
           $menu_all=  array();
         $cancel_kotno=array();
            $log_by_all=  array();
           $data=array();
        $data1=array();
        
        
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
                    $cancel_by1=$result_combo['ser_firstname'];
                    $cancel_time1=$result_combo['ch_entrydate'];
                    $cancel_reason1=$result_combo['cr_reason'];
                    $menu=$result_combo['combo'];
                    $kotno=$result_combo['ch_kotno'];
                    $log_by=$result_combo['ch_cancelledlogin'];        
                               
                    $data['Bill/Order No']=$bill_order1;
                    $data['Kot/Bill No']=$kotno;
                    $data['Menu']=$menu;
                    $data['Qty']=$cancel_qty1;
                    $data['Staff']=$cancel_by1;
                    $data['Login']=$log_by;
                    $data['Time']=$cancel_time1;
                    $data['Reason']=$cancel_reason1;
                  
                    array_push($data1,$data);
                    unset($data);
                    
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
                    $cancel_by1=$result_combo['ser_firstname'];
                    $cancel_time1=$result_combo['tc_cancelled_time'];
                    $cancel_reason1=$result_combo['cr_reason'];
                    $menu=$result_combo['combo'];
                    if($result_combo['tc_cancel_kotno']!=""){
                        $kotno=$result_combo['tc_cancel_kotno'];
                    }else{
                        $kotno=$result_combo['tc_billno']; 
                    }
                    $log_by=$result_combo['tc_cancelled_login'];        
                               
                    $data['Bill/Order No']=$bill_order1;
                    $data['Kot/Bill No']=$kotno;
                    $data['Menu']=$menu;
                    $data['Qty']=$cancel_qty1;
                    $data['Staff']=$cancel_by1;
                    $data['Login']=$log_by;
                    $data['Time']=$cancel_time1;
                    $data['Reason']=$cancel_reason1;
                  
                    array_push($data1,$data);
                    unset($data);
                    
                }
            }
              
        $sql_login1  =   $database->mysqlQuery("select ch_cancelledlogin,ch_kotno,ch_kot_cancel_id,ch_orderno,ch_entrydate,ch_cancelled_qty,"
                . " mr_menuname,ser_firstname,cr_reason,ter_rate from tbl_tableorder_changes tbo left join tbl_staffmaster ts on "
                . " ts.ser_staffid=tbo.ch_cancelledby_careof left join tbl_cancellation_reasons tcr on tcr.cr_id=tbo.ch_cancelledreason left join"
                . " tbl_tableorder to1 on to1.ter_orderno=tbo.ch_orderno and to1.ter_slno=tbo.ch_orderslno left join tbl_menumaster tm on "
                . " tm.mr_menuid=to1.ter_menuid where $string and tbo.ch_combo_pack_cancelled_qty IS  NULL order by ch_entrydate asc");            
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
                 $menu=$result_login1['mr_menuname'];
                 $kotno=$result_login1['ch_kotno'];
                 $log_by=$result_login1['ch_cancelledlogin'];        
                 $rate=$result_login1['ter_rate'];
                 
                 $tot_rt=$tot_rt+($rate*$cancel_qty1);              
                           
                   $data['Bill/Order No']=$bill_order1;
                   $data['Kot/Bill No']=$kotno;
                   $data['Menu']=$menu;
                   
                  $data['Qty']=$cancel_qty1;
                  $data['Rate']=$rate;
                  $data['Total']=$tot_rt;
                  
                  $data['Staff']=$cancel_by1;
                  $data['Login']=$log_by;
                  $data['Time']=$cancel_time1;
                  $data['Reason']=$cancel_reason1;
                  
                  array_push($data1,$data);
                    unset($data);   
                            
                            
                            
                           
               
            }
	  }
        
        
          $sql_loginta1  =  $database->mysqlQuery("select tc_cancel_kotno,tc_cancelled_login,tc_cancelled_time,tc_cancel_qty,tc_billno,tc_cancel_id,"
                  . " mr_menuname,ser_firstname,cr_reason,tab_rate from   tbl_takeaway_cancel_items tbc left join tbl_staffmaster ts on "
                  . " ts.ser_staffid=tbc.tc_cancelled_by left join tbl_cancellation_reasons tcr on tcr.cr_id=tbc.tc_reason left join "
                  . " tbl_takeaway_billdetails tbdw on tbdw.tab_billno=tbc.tc_billno and tbdw.tab_slno=tbc.tc_bill_slno left join tbl_menumaster "
                  . " tm on tm.mr_menuid=tbdw.tab_menuid where $stringta and  tbc.tc_combo_pack_cancelled_qty IS NULL order by tc_cancelled_time asc "); 
        
        $num_loginta1   = $database->mysqlNumRows($sql_loginta1);
	if($num_loginta1)
	  {
              while($result_loginta1= $database->mysqlFetchArray($sql_loginta1))
              {
                  $cancelid2=$result_loginta1['tc_cancel_id'];
                 $bill_order2=$result_loginta1['tc_billno'];
                 $cancel_qty2=$result_loginta1['tc_cancel_qty'];
                 $cancel_by2=$result_loginta1['ser_firstname'];
                 $cancel_time2=$result_loginta1['tc_cancelled_time'];
                  $cancel_reason2=$result_loginta1['cr_reason'];
                   $menu1=$result_loginta1['mr_menuname'];
                  $log_by1=$result_loginta1['tc_cancelled_login'];
                   
                   
                   if($result_loginta1['tc_cancel_kotno']!=""){
                      $kotno1=$result_loginta1['tc_cancel_kotno'];
                 }else{
                      $kotno1=$result_loginta1['tc_billno'];
                 }
                 
                 $rate1=$result_loginta1['tab_rate'];
                 
                 $tot_rt1=$tot_rt1+($rate1*$cancel_qty2);  
                  
                  $data['Bill/Order No']=$bill_order2;
                  $data['Kot/Bill No']=$kotno1;
                   $data['Menu']=$menu1;
                  $data['Qty']=$cancel_qty2;
                   $data['Rate']=$rate1;
                  $data['Total']=$tot_rt1;
                  $data['Staff']=$cancel_by2;
                   $data['Login']=$log_by1;
                  $data['Time']=$cancel_time2;
                  $data['Reason']=$cancel_reason2;
                  
                            
                         array_push($data1,$data);
                    unset($data);    
               
            }
	  }
          
          
                  $data['Bill/Order No']='Total';
                  $data['Kot/Bill No']='';
                   $data['Menu']='';
                  $data['Qty']='';
                   $data['Rate']='';
                  $data['Total']=$tot_rt+$tot_rt1;
                  $data['Staff']='';
                   $data['Login']='';
                  $data['Time']='';
                  $data['Reason']='';
                  
                            
                    array_push($data1,$data);
                    unset($data);    
          
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
                    $cancelid1=$result_combo['ch_kot_cancel_id'];
                    $bill_order1=$result_combo['ch_orderno'];
                    $cancel_qty1=$result_combo['ch_combo_pack_cancelled_qty'];
                    $cancel_by1=$result_combo['ser_firstname'];
                    $cancel_time1=$result_combo['ch_entrydate'];
                    $cancel_reason1=$result_combo['cr_reason'];
                    $menu=$result_combo['combo'];
                    $kotno=$result_combo['ch_kotno'];
                    $log_by=$result_combo['ch_cancelledlogin'];        
                               
                    $data['Bill/Order No']=$bill_order1;
                    $data['Kot/Bill No']=$kotno;
                    $data['Menu']=$menu;
                    $data['Qty']=$cancel_qty1;
                    
                    $data['Staff']=$cancel_by1;
                    $data['Login']=$log_by;
                    $data['Time']=$cancel_time1;
                    $data['Reason']=$cancel_reason1;
                  
                    array_push($data1,$data);
                    unset($data);
                    
                }
            }
            
	$sql_login  =  $database->mysqlQuery("select ch_cancelledlogin,ch_kotno,ch_orderno,ch_cancelled_qty,ch_entrydate,ser_firstname,"
                . " mr_menuname,cr_reason,ter_rate from tbl_tableorder_changes tbo left join tbl_staffmaster ts on ts.ser_staffid=tbo.ch_cancelledby_careof left"
                . " join tbl_cancellation_reasons tcr on tcr.cr_id=tbo.ch_cancelledreason left join tbl_tableorder to1 on to1.ter_orderno=tbo.ch_orderno"
                . " and to1.ter_slno=tbo.ch_orderslno left join tbl_menumaster tm on tm.mr_menuid=to1.ter_menuid where $string and "
                . " tbo.ch_combo_pack_cancelled_qty IS  NULL order by ch_entrydate asc "); 
      
        
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {
              while($result_login= $database->mysqlFetchArray($sql_login))
              {
               
             
               $bill_order[]=$result_login['ch_orderno'];
                $cancel_qty[]=$result_login['ch_cancelled_qty'];
                 $cancel_by[]=$result_login['ser_firstname'];
                 $cancel_time[]=$result_login['ch_entrydate'];
                $menu_all[]=$result_login['mr_menuname'];
                  $cancel_reason[]=$result_login['cr_reason'];
                   $cancel_kotno[]=$result_login['ch_kotno'];
                  $log_by_all[]=$result_login['ch_cancelledlogin'];
                   $rate11[]=$result_login['ter_rate'];
                 ?>
                            
                      
                           
                            <?php
               
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
                                                where  bm.tab_mode='$mode' and $stringta  and ci.tc_billno=tb.tab_billno and ci.tc_bill_slno=tb.tab_slno 
                                                group by cbd.cbd_count_combo_ordering,cbd.cbd_billno, ci.tc_cancel_id order by CAST(ci.tc_cancel_id  AS UNSIGNED) asc"); 
            
            
            
            $num_combo   = $database->mysqlNumRows($sql_combo);
            if($num_combo){
                while($result_combo= $database->mysqlFetchArray($sql_combo)){    
                    
                    $cancelid1=$result_combo['tc_cancel_id'];
                    $bill_order1=$result_combo['tc_billno'];
                    $cancel_qty1=$result_combo['tc_combo_pack_cancelled_qty'];
                    $cancel_by1=$result_combo['ser_firstname'];
                    $cancel_time1=$result_combo['tc_cancelled_time'];
                    $cancel_reason1=$result_combo['cr_reason'];
                    $menu=$result_combo['combo'];
                    if($result_combo['tc_cancel_kotno']!=""){
                        $kotno=$result_combo['tc_cancel_kotno'];
                    }else{
                        $kotno=$result_combo['tc_billno']; 
                    }
                    $log_by=$result_combo['tc_cancelled_login'];        
                               
                    $data['Bill/Order No']=$bill_order1;
                    $data['Kot/Bill No']=$kotno;
                    $data['Menu']=$menu;
                    $data['Qty']=$cancel_qty1;
                    $data['Staff']=$cancel_by1;
                    $data['Login']=$log_by;
                    $data['Time']=$cancel_time1;
                    $data['Reason']=$cancel_reason1;
                  
                    array_push($data1,$data);
                    unset($data);
                    
                }
            }
            
            
            
          $sql_loginta  = $database->mysqlQuery("select tc_cancel_kotno,tc_cancelled_login,tc_billno,tc_cancel_qty,tc_cancelled_time,mr_menuname,"
                  . "ser_firstname,cr_reason,tab_rate from   tbl_takeaway_cancel_items tbc left join tbl_staffmaster ts on "
                  . "ts.ser_staffid=tbc.tc_cancelled_by left join tbl_cancellation_reasons tcr on tcr.cr_id=tbc.tc_reason left join"
                  . " tbl_takeaway_billdetails tbdw on tbdw.tab_billno=tbc.tc_billno and tbdw.tab_slno=tbc.tc_bill_slno left join tbl_menumaster"
                  . " tm on tm.mr_menuid=tbdw.tab_menuid where tc_mode='$mode' and $stringta and  tbc.tc_combo_pack_cancelled_qty IS NULL order "
                  . " by tc_cancelled_time asc "); 
        
        $num_loginta   = $database->mysqlNumRows($sql_loginta);
	if($num_loginta)
	  {
              while($result_loginta= $database->mysqlFetchArray($sql_loginta))
              {
                  
                 $bill_order[]=$result_loginta['tc_billno'];
                 $cancel_qty[]=$result_loginta['tc_cancel_qty'];
                 $cancel_by[]=$result_loginta['ser_firstname'];
                 $cancel_time[]=$result_loginta['tc_cancelled_time'];
                 $menu_all[]=$result_loginta['mr_menuname'];
                 $cancel_reason[]=$result_loginta['cr_reason'];
                 $log_by_all[]=$result_loginta['tc_cancelled_login']; 
                  $rate11[]=$result_loginta['tab_rate']; 
                  
                    if($result_loginta['tc_cancel_kotno']!=""){
                 $cancel_kotno[]=$result_loginta['tc_cancel_kotno'];
            }else{
                $cancel_kotno[]=$result_loginta['tc_billno']; 
            }
                                          
            }
	  }
        }
        
        for ($i=0;$i<count($bill_order);$i++){
         
             $tot_rt_all[]=($rate11[$i]*$cancel_qty[$i]); 
                            
                  $data['Bill/Order No']=$bill_order[$i];
                  
                  $data['Kot/Bill No']=$cancel_kotno[$i];
                  $data['Menu']=$menu_all[$i];
                  $data['Qty']=$cancel_qty[$i];
                  $data['Rate']=$rate11[$i];
                  $data['Total']=$rate11[$i]*$cancel_qty[$i];
                  $data['Staff']=$cancel_by[$i];
                  $data['Login']=$log_by_all[$i];
                  $data['Time']=$cancel_time[$i];
                  $data['Reason']=$cancel_reason[$i];
                  array_push($data1,$data);
                    unset($data);   
        }
        
        
        
                  $data['Bill/Order No']='Total';
                  $data['Kot/Bill No']='';
                   $data['Menu']='';
                  $data['Qty']='';
                   $data['Rate']='';
                  $data['Total']=array_sum($tot_rt_all);
                  $data['Staff']='';
                   $data['Login']='';
                  $data['Time']='';
                  $data['Reason']='';
                  
                            
                    array_push($data1,$data);
                    unset($data);    
                           
            $filename = " Item   Cancel Report-".$mode."-" . $reporthead . ".xls";
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
                $reporthead="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta.="tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $string_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $stringta_combo.="cbd.cbd_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $reporthead="Last 10 days";
	}
	else if($bydatz=="Yesterday")
	{
            $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day ";
            $stringta.="tbm.tab_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
            $string_combo.="cbd.cbd_dayclosedate = CURDATE() - INTERVAL 1 day ";
            $stringta_combo.="cbd.cbd_dayclosedate = CURDATE( ) - INTERVAL 1 DAY ";
            $reporthead="Yesterday";
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
                $reporthead="Today";
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
	
        
        
        if($_REQUEST['most_revenue']=="Y"){

	$menu_qty=array();
        $menu_name=array();
        $menu_rate=array();
        $data=array();
        $data1=array();
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
                                
          foreach($menu_rate as $key=>$val){
              $m++;
              if($m<=10)
              { 
                  $menurate_sum=$menurate_sum+$menu_rate[$key];
                  $menuquant_sum=$menuquant_sum+$menu_qty[$key];
                  $data['SlNo']=$m;
                  $data['Items']=$menu_name[$key];
                  $data['Quantity']=$menu_qty[$key];
                  $data['Amount']=number_format($menu_rate[$key],$_SESSION['be_decimal']);
                  array_push($data1,$data);
                    unset($data);
                  
                               
          }}}
            $data['SlNo']="Total";
            $data['Items']="";
            $data['Quantity']=$menuquant_sum;
            $data['Amount']=number_format($menurate_sum,$_SESSION['be_decimal']);
            array_push($data1,$data);
            unset($data);
        }
        
        
        if($_REQUEST['best_selling']=='Y'){
            
            
        $menu_qty=array();
        $menu_name=array();
        $menu_rate=array();
        $data=array();
        $data1=array();
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
            
	$sql_login  =  $database->mysqlQuery("select distinct(bd.bd_menuid)as menuid,mr.mr_menuname as menu,sum(bd.bd_qty) as totqty,"
                . " sum(bd.bd_amount) as totamt from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno "
                . " left join tbl_menumaster mr on mr.mr_menuid=bd.bd_menuid where $string AND bd.bd_count_combo_ordering IS NULL "
                . " group by bd.bd_menuid order by totqty  DESC "); 
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
          $sql_loginta  =  $database->mysqlQuery("select distinct(tbd.tab_menuid)as menuid,mr.mr_menuname as menu,sum(tbd.tab_qty) as totqty,"
                  . " sum(tbd.tab_amount) as totamt from tbl_takeaway_billdetails tbd left join tbl_takeaway_billmaster tbm on "
                  . " tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mr on mr.mr_menuid=tbd.tab_menuid where $stringta AND "
                  . " tbd.tab_count_combo_ordering IS NULL group by tbd.tab_menuid order by totqty  DESC "); 
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
          arsort($menu_qty);
          $m=0;
          $menurate_sum=0;
          $menuquant_sum=0;
          if(!empty($menu_rate)){
                                
          foreach($menu_qty as $key=>$val){
              $m++;
              if($m<=10)
              { 
                  $menurate_sum=$menurate_sum+$menu_rate[$key];
                  $menuquant_sum=$menuquant_sum+$menu_qty[$key];
                  $data['SlNo']=$m;
                  $data['Items']=$menu_name[$key];
                  $data['Quantity']=$menu_qty[$key];
                  $data['Amount']=number_format($menu_rate[$key],$_SESSION['be_decimal']);
                  array_push($data1,$data);
                    unset($data);
                  
                               
          }}}
            $data['SlNo']="Total";
            $data['Items']="";
            $data['Quantity']=$menuquant_sum;
            $data['Amount']=number_format($menurate_sum,$_SESSION['be_decimal']);
            array_push($data1,$data);
            unset($data);
            
            
        }
        
        
    if($_REQUEST['most_revenue']=='Y'){           
  $filename = " Most Revenue Generating Items-".$mode."-" . $reporthead . ".xls";
    }
    
     if($_REQUEST['best_selling']=='Y'){
         
         $filename = " Best Selling Items-".$mode."-" . $reporthead . ".xls";
     }
  
  
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
 else if(($_REQUEST['type']=="hourlywise_report_cr"))
{
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
        $data=array();
        $data1=array();
        $billno=array();
        if($mode=='DI'){
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
                if(!array_key_exists($result_login_combo['paymode'],$mode_name)){
                    $mode_name[$result_login_combo['paymode']]=$result_login_combo['paymodename'];
                    }
                    if(!in_array($result_login_combo['billno'], $billno)){
                        $billno[]=$result_login_combo['billno'];
                        $amount[$result_login_combo['paymode']][]=$result_login_combo['final'];
                    }
                    if(!array_key_exists($result_login_combo['menuid'],$menu_name)){
                    $menu_id[]=$result_login_combo['menuid'];
                  $menu_name[$result_login_combo['menuid']]=$result_login_combo['menu'];
                    }
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
	$sql_login  =  $database->mysqlQuery("select bm.bm_billno as billno,sum(bm.bm_finaltotal) as final,sum(bd.bd_qty) as qty,sum(bd.bd_amount) as amount,pm.pym_name as paymodename,bm.bm_paymode as paymode,bd.bd_menuid as menuid,mr.mr_menuname as menu from tbl_tablebillmaster bm left join tbl_paymentmode pm on pm.pym_id=bm.bm_paymode left join tbl_tablebilldetails bd on bd.bd_billno=bm.bm_billno left join tbl_menumaster mr on mr.mr_menuid=bd.bd_menuid where $string and bm.bm_billtime between $newfromtime and $newtotime and bd.bd_count_combo_ordering IS NULL group by bd_menuid,bm_paymode,bm_billno order by mr_menuname asc "); 
      $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {$i=0;
              while($result_login= $database->mysqlFetchArray($sql_login))
              {$i++;
                  if($result_login['menuid']){
                  if(!array_key_exists($result_login['paymode'],$mode_name)){
                    $mode_name[$result_login['paymode']]=$result_login['paymodename'];
                    }
                    if(!in_array($result_login['billno'], $billno)){
                        $billno[]=$result_login['billno'];
                        $amount[$result_login['paymode']][]=$result_login['final'];
                    }
                    if(!array_key_exists($result_login['menuid'],$menu_name)){
                    $menu_id[]=$result_login['menuid'];
                  $menu_name[$result_login['menuid']]=$result_login['menu'];
                    }
                  if(array_key_exists($result_login['menuid'],$menu_qty)){
                  $menu_qty[$result_login['menuid']]=$menu_qty[$result_login['menuid']]+$result_login['qty'];
                  }
                  else{
                      $menu_qty[$result_login['menuid']]=$result_login['qty'];
                  }
                  if(array_key_exists($result_login['menuid'],$menu_rate)){
                  $menu_rate[$result_login['menuid']]=$menu_rate[$result_login['menuid']]+$result_login['amount'];
                  }
                  else{
                     $menu_rate[$result_login['menuid']]=$result_login['amount']; 
                  }
                }  
            }
	  }
        }
        else if($mode=='TA'||$mode=='HD'||$mode=='CS'){
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
                  if(!array_key_exists($result_loginta_combo['paymode'],$mode_name)){
                    $mode_name[$result_loginta_combo['paymode']]=$result_loginta_combo['paymodename'];
                    }
                  
                  if(!in_array($result_loginta_combo['billno'], $billno)){
                        $billno[]=$result_loginta_combo['billno'];
                        $amount[$result_loginta_combo['paymode']][]=$result_loginta_combo['final'];
                    }
                    
                    if(!array_key_exists($result_loginta_combo['menuid'],$menu_name)){
                    $menu_id[]=$result_loginta_combo['menuid'];
                  $menu_name[$result_loginta_combo['menuid']]=$result_loginta_combo['menu'];
                    }
                   
                   if(array_key_exists($result_loginta_combo['menuid'],$menu_qty)){
                  $menu_qty[$result_loginta_combo['menuid']]=$menu_qty[$result_loginta_combo['menuid']]+$result_loginta_combo['qty'];
                  }
                  else{
                      $menu_qty[$result_loginta_combo['menuid']]=$result_loginta_combo['qty'];
                  }
                   if(array_key_exists($result_loginta_combo['menuid'],$menu_rate)){
                  $menu_rate[$result_loginta_combo['menuid']]=$menu_rate[$result_loginta_combo['menuid']]+$result_login['amount'];
                  }
                  else{
                     $menu_rate[$result_loginta_combo['menuid']]=$result_loginta_combo['amount']; 
                  }
            }
	}  
            
          $sql_login  =  $database->mysqlQuery("select tbm.tab_billno as billno, sum(tbm.tab_netamt) as final,sum(tbd.tab_qty) as qty,sum(tbd.tab_amount) as amount,pm.pym_name as paymodename,tbm.tab_paymode as paymode,tbd.tab_menuid as menuid,mr.mr_menuname as menu from tbl_takeaway_billmaster tbm left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode left join tbl_takeaway_billdetails tbd on tbd.tab_billno=tbm.tab_billno left join tbl_menumaster mr on mr.mr_menuid=tbd.tab_menuid   where $stringta and tbm.tab_time between $newfromtime and $newtotime and tbd.tab_count_combo_ordering IS NULL group by tbd.tab_menuid,tbm.tab_paymode,tbm.tab_billno order by mr_menuname asc  "); 
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {$j=0;
              while($result_login= $database->mysqlFetchArray($sql_login))
              {$j++;
                    if($result_login['menuid']){
                    if(!array_key_exists($result_login['paymode'],$mode_name)){
                    $mode_name[$result_login['paymode']]=$result_login['paymodename'];
                    }
                  
                  if(!in_array($result_login['billno'], $billno)){
                        $billno[]=$result_login['billno'];
                        $amount[$result_login['paymode']][]=$result_login['final'];
                    }
                    
                    if(!array_key_exists($result_login['menuid'],$menu_name)){
                    $menu_id[]=$result_login['menuid'];
                  $menu_name[$result_login['menuid']]=$result_login['menu'];
                    }
                   
                   if(array_key_exists($result_login['menuid'],$menu_qty)){
                  $menu_qty[$result_login['menuid']]=$menu_qty[$result_login['menuid']]+$result_login['qty'];
                  }
                  else{
                      $menu_qty[$result_login['menuid']]=$result_login['qty'];
                  }
                   if(array_key_exists($result_login['menuid'],$menu_rate)){
                  $menu_rate[$result_login['menuid']]=$menu_rate[$result_login['menuid']]+$result_login['amount'];
                  }
                  else{
                     $menu_rate[$result_login['menuid']]=$result_login['amount']; 
                  }
                      
                } 
            }
	  }
        }
        else{
            
         $sql_login_combo  =  $database->mysqlQuery("select billno,sum(final) as final,sum(qty) as qty, sum(amount) as amount,paymodename,paymode,menuid,menu from (
                                                    select  distinct(cbd.cbd_billno) as billno,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as amount, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid,bm.bm_paymode as paymode,sum(bm.bm_finaltotal) as final,pm.pym_name as paymodename
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_paymentmode pm on pm.pym_id=bm.bm_paymode
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $string_combo and bm.bm_billtime between $newfromtime and $newtotime
                                                    group by cbd.cbd_combo_pack_id 
                                                    union all
                                                    select  distinct(cbd.cbd_billno) as billno,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as amount, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid,sum(tbm.tab_netamt) as final,tbm.tab_paymode as paymode,pm.pym_name as paymodename
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where $stringta_combo and tbm.tab_time between $newfromtime and $newtotime
                                                    group by cbd.cbd_combo_pack_id ) x group by menuid,paymode,billno order  by menu asc "); 
        
        $num_login_combo   = $database->mysqlNumRows($sql_login_combo);
	if($num_login_combo)
	{$i=0; 
            while($result_login_combo= $database->mysqlFetchArray($sql_login_combo))
            {$i++;
                if(!array_key_exists($result_login_combo['paymode'],$mode_name)){
                    $mode_name[$result_login_combo['paymode']]=$result_login_combo['paymodename'];
                    }
                    if(!in_array($result_login_combo['billno'], $billno)){
                        $billno[]=$result_login_combo['billno'];
                        $amount[$result_login_combo['paymode']][]=$result_login_combo['final'];
                    }
                    if(!array_key_exists($result_login_combo['menuid'],$menu_name)){
                    $menu_id[]=$result_login_combo['menuid'];
                  $menu_name[$result_login_combo['menuid']]=$result_login_combo['menu'];
                    }
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
            
            
        $sql_login  =  $database->mysqlQuery(" select billno,sum(final) as final,sum(qty) as qty, sum(amount) as amount,paymodename,paymode,menuid,menu from ( select bm.bm_billno as billno,bm.bm_finaltotal as final,bd.bd_qty as qty,bd.bd_amount as amount,pm.pym_name as paymodename,bm.bm_paymode as paymode,bd.bd_menuid as menuid,mr.mr_menuname as menu from tbl_tablebillmaster bm left join tbl_paymentmode pm on pm.pym_id=bm.bm_paymode left join tbl_tablebilldetails bd on bd.bd_billno=bm.bm_billno left join tbl_menumaster mr on mr.mr_menuid=bd.bd_menuid where $string and bm.bm_billtime between $newfromtime and $newtotime  and bd.bd_count_combo_ordering IS NULL union all
                                               select tbm.tab_billno as billno, tbm.tab_netamt as final,tbd.tab_qty as qty,tbd.tab_amount as amount,pm.pym_name as paymodename,tbm.tab_paymode as paymode,tbd.tab_menuid as menuid,mr.mr_menuname as menuname from tbl_takeaway_billmaster tbm left join tbl_paymentmode pm on pm.pym_id=tbm.tab_paymode left join tbl_takeaway_billdetails tbd on tbd.tab_billno=tbm.tab_billno left join tbl_menumaster mr on mr.mr_menuid=tbd.tab_menuid   where $stringta and tbm.tab_time between $newfromtime and $newtotime and tbd.tab_count_combo_ordering IS NULL ) x group by menuid,paymode,billno order  by menu asc "); 
$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {$i=0;
              while($result_login= $database->mysqlFetchArray($sql_login))
              {$i++;
                    if($result_login['menuid']){
                    if(!array_key_exists($result_login['paymode'],$mode_name)){
                    $mode_name[$result_login['paymode']]=$result_login['paymodename'];
                    }
                    if(!in_array($result_login['billno'], $billno)){
                        $billno[]=$result_login['billno'];
                        $amount[$result_login['paymode']][]=$result_login['final'];
                    }
                    
                    if(!array_key_exists($result_login['menuid'],$menu_name)){
                    $menu_id[]=$result_login['menuid'];
                  $menu_name[$result_login['menuid']]=$result_login['menu'];
                    }
                    
                     
                   if(array_key_exists($result_login['menuid'],$menu_qty)){
                  $menu_qty[$result_login['menuid']]=$menu_qty[$result_login['menuid']]+$result_login['qty'];
                  }
                  else{
                      $menu_qty[$result_login['menuid']]=$result_login['qty'];
                  }
                  if(array_key_exists($result_login['menuid'],$menu_rate)){
                  $menu_rate[$result_login['menuid']]=$menu_rate[$result_login['menuid']]+$result_login['amount'];
                  }
                  else{
                     $menu_rate[$result_login['menuid']]=$result_login['amount']; 
                  }
                }  
            }
	  }
        }
                $data['SlNo']="Item Ordered Details";
                $data['Menu']="";
                $data['Quantity']="";
                $data['Amount']="";
                array_push($data1,$data);
                unset($data);
          arsort($menu_rate);
          $m=0;
          $menurate_sum=0;
          $menuquant_sum=0;
          foreach($menu_rate as $key=>$val){
              $m++;
              $menurate_sum=$menurate_sum+$menu_rate[$key];
              $menuquant_sum=$menuquant_sum+$menu_qty[$key];
              
                $data['SlNo']=$m;
                $data['Menu']=$menu_name[$key];
                $data['Quantity']=$menu_qty[$key];
                $data['Amount']=number_format($menu_rate[$key],$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
                  
    }
                $data['SlNo']="Total";
                $data['Menu']="";
                $data['Quantity']=$menuquant_sum;
                $data['Amount']=number_format($menurate_sum,$_SESSION['be_decimal']);
                array_push($data1,$data);
                unset($data);
                

                
          asort($mode_name);
          $m=0;
          $total_sum=0;
            
            $data['SlNo']="Settlement Details";
            $data['Menu']="";
            $data['Quantity']="";
            $data['Amount']="";
            array_push($data1,$data);
            unset($data);
            
            $data['SlNo']="Settlement Mode";
            $data['Menu']="Amount";
            $data['Quantity']="";
            $data['Amount']="";
            array_push($data1,$data);
            unset($data);
            
            $total=0;
         
         if($mode=='DI'){
            $sql_login  =  $database->mysqlQuery(" select bm.bm_paymode as paymode,sum(bm.bm_finaltotal) as final,sum(bm.bm_amountpaid-bm.bm_amountbalace) as cash, 
                sum(bm.bm_transactionamount) as card,sum(bm.bm_finaltotal-(bm.bm_amountpaid-bm.bm_amountbalace)-bm.bm_transactionamount) as credit,
                sum(bm.bm_chequebankamount) as cheque
                FROM tbl_tablebillmaster bm where $string and bm.bm_billtime between $newfromtime and $newtotime group by bm.bm_paymode ");

         }
         else if($mode=='TA'||$mode=='HD'||$mode=='CS'){
             $sql_login  =  $database->mysqlQuery(" select tbm.tab_paymode as paymode,sum(tbm.tab_netamt) as final,sum(tbm.tab_amountpaid-tbm.tab_amountbalace) as cash, 
                sum(tbm.tab_transactionamount) as card,sum(tbm.tab_netamt-(tbm.tab_amountpaid-tbm.tab_amountbalace)-tbm.tab_transactionamount) as credit,
                sum(tbm.tab_chequebankamount) as cheque
                FROM tbl_takeaway_billmaster tbm where $stringta AND tbm.tab_mode='".$mode."' and tbm.tab_time between $newfromtime and $newtotime group by tbm.tab_paymode");
            }
         else{
             $sql_login  =  $database->mysqlQuery("  select  paymode,sum(final) as final, sum(cash) as cash, sum(card) as card, sum(credit) as credit , sum(cheque) as  cheque  from ( 
                select bm.bm_paymode as paymode,sum(bm.bm_finaltotal) as final,sum(bm.bm_amountpaid-bm.bm_amountbalace) as cash, 
                sum(bm.bm_transactionamount) as card,sum(bm.bm_finaltotal-(bm.bm_amountpaid-bm.bm_amountbalace)-bm.bm_transactionamount) as credit,
                sum(bm.bm_chequebankamount) as cheque
                FROM tbl_tablebillmaster bm where $string and bm.bm_billtime between $newfromtime and $newtotime group by bm.bm_paymode

                union all

                select tbm.tab_paymode as paymode,sum(tbm.tab_netamt) as final,sum(tbm.tab_amountpaid-tbm.tab_amountbalace) as cash, 
                sum(tbm.tab_transactionamount) as card,sum(tbm.tab_netamt-(tbm.tab_amountpaid-tbm.tab_amountbalace)-tbm.tab_transactionamount) as credit,
                sum(tbm.tab_chequebankamount) as cheque
                FROM tbl_takeaway_billmaster tbm where $stringta and tbm.tab_time between $newfromtime and $newtotime group by tbm.tab_paymode )x group by x.paymode");
             
         }
            $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
            { $i=0;$total=0;
              while($result_login= $database->mysqlFetchArray($sql_login)){
                  $total=$total+$result_login['final'];
              if($result_login['paymode']==1 && $result_login['cash']>0){
                  
              
            $data['SlNo']="Cash";
            $data['Menu']=number_format($result_login['cash'],$_SESSION['be_decimal']);
            $data['Quantity']="";
            $data['Amount']="";
            array_push($data1,$data);
            unset($data);
            
              }
            if($result_login['paymode']==2 && $result_login['card']>0){
            $data['SlNo']="Card";
            $data['Menu']=number_format($result_login['card'],$_SESSION['be_decimal']);
            $data['Quantity']="";
            $data['Amount']="";
            array_push($data1,$data);
            unset($data);
                
            
            }
            if($result_login['paymode']==6 && $result_login['credit']>0){
            
            $data['SlNo']="Credit";
            $data['Menu']=number_format($result_login['credit'],$_SESSION['be_decimal']);
            $data['Quantity']="";
            $data['Amount']="";
            array_push($data1,$data);
            unset($data); 
            
            }
            if($result_login['paymode']==5 && $result_login['cheque']>0){
                
            $data['SlNo']="Cheque";
            $data['Menu']=number_format($result_login['cheque'],$_SESSION['be_decimal']);
            $data['Quantity']="";
            $data['Amount']="";
            array_push($data1,$data);
            unset($data);
           
            }
            if($result_login['paymode']==7 && $result_login['cheque']>0){
                
            $data['SlNo']="Complimentary";
            $data['Menu']=number_format($result_login['final'],$_SESSION['be_decimal']);
            $data['Quantity']="";
            $data['Amount']="";
            array_push($data1,$data);
            unset($data);
           
            }
        }  
            $data['SlNo']="Total";
            $data['Menu']=number_format($total,$_SESSION['be_decimal']);
            $data['Quantity']="";
            $data['Amount']="";
            array_push($data1,$data);
            unset($data);
          
        }    
              
                
            $filename = " Hourly Wise Report-".$mode."-" . $reporthead ."Between -".$newfromtime." and ". $newtotime .".xls";
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
                
		$st= " Last 5 days ";
		
	}elseif($bydatz=="Last10days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
               
		$st= " Last 10 days ";
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
                
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" cd.cd_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                
		$st= " Yesterday ";
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
         $data=array();
         $data1=array();
        
                           
        
        
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
          
            
            
                           $data['Sl No']=$i;
                        
                           
                          $data['Type']=$result_login['ct_credit_type'];
                          $data['Party Name']=$creditperson;
                          
                          $data['Number']=$result_login['ly_mobileno'];
                         
                          $data['Credit Amount']= number_format($credit_amount,$_SESSION['be_decimal']);
                          
                          
                          array_push($data1,$data);
                          unset($data);
                         
        
        
                          
        }
        
                         $data['Sl No']='Total';
                        
                           
                          $data['Type']='';
                          $data['Party Name']='';
                          
                          $data['Number']='';
                         
                          $data['Credit Amount']= number_format($crd_all,$_SESSION['be_decimal']);
                         
                          
                          array_push($data1,$data);
                          unset($data);
        
        
        
    }

$filename = " Credit Report-" . $reporthead . ".xls";
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
else if($_REQUEST['type'] == "consolidated_credit_summury")
    {	
    
    
    
        $string="";
       
	$creditsataff='';
		$creditstaff=$_REQUEST['creditstaff'];
            if($creditstaff!=''){
               $string.= " cm.crd_type='$creditstaff' and ";
               
               if($_REQUEST['credit_staff_company']!=''){
                   
                    if($creditstaff=='2'){
                      $string.= " ser_staffid='".$_REQUEST['credit_staff_company']."' and "; 
                    }
                    else if($creditstaff=='3'){
                     $string.= " ct_corporatecode='".$_REQUEST['credit_staff_company']."' and ";  
                    }
                    else if($creditstaff=='4'){
                      $string.= " ly_id='".$_REQUEST['credit_staff_company']."' and "; 
                    }
                }
            }
        $checked_status='';
        if($_REQUEST['checkedstatus']=="true"){
            $checked_status=" and cd.cd_settled='N' ";
        }
	
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
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
                
		$st= " Last 5 days ";
		
	}elseif($bydatz=="Last10days")
	{
		$string.=" cd.cd_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
               
		$st= " Last 10 days ";
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
                
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" cd.cd_dayclosedate = CURDATE() - INTERVAL 1 DAY ";
                
		$st= " Yesterday ";
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
        
        
        if($_REQUEST['credit_partial_pay']=="N"){
        
        
            $data=array();
            $data1=array();
            
            
           
         $sql_login  =  $database->mysqlQuery("select tbm.tab_status as ta_sts, tb.bm_status as di_sts, cd.cd_dateofsettle,tb.bm_creditremark as di_remarks,tbm.tab_creditremark as ta_remarks,cd.cd_dayclosedate,cd.cd_billno,ct.ct_credit_type,sm.ser_firstname as staff,lr.ly_mobileno,lr.ly_firstname as guest,c.ct_corporatename as company,tb.bm_finaltotal as dine_bill_total, tbm.tab_netamt as ta_bill_total,cd.cd_amount,cd.cd_settled from tbl_credit_details cd
         left join tbl_credit_master cm on cd_masterid =crd_id 
         left join tbl_staffmaster sm on ser_staffid=crd_staffid 
         left join tbl_corporatemaster c on ct_corporatecode=crd_corporateid 
         left join tbl_loyalty_reg lr on ly_id=crd_guestid 
         left join tbl_credit_types ct  on ct.ct_creditid=cm.crd_type 
         left join tbl_tablebillmaster tb on bm_billno =cd_billno 
         left join tbl_takeaway_billmaster tbm on tab_billno=cd_billno 
         where  $string $checked_status " ); 
     
        $num_login   = $database->mysqlNumRows($sql_login);
        if($num_login){$i=0;		  
        while($result_login=$database->mysqlFetchArray($sql_login))
        { 
           if($result_login['ta_sts']!='Cancelled' && $result_login['di_sts']!='Cancelled'){
               
            $i++;
            $settled_status=$result_login['cd_settled'];
            if($settled_status=='N'){
            $credit_amount=$result_login['cd_amount'];
            $received_amount=0;
            $credit_amount1=$credit_amount1+$credit_amount;
            }
            else if($settled_status=='Y'){
            $received_amount=$result_login['cd_amount'];
            $credit_amount=0;
             $received_amount1=$received_amount1+$received_amount;
            }
            if($result_login['staff']!=''){
             $creditperson=$result_login['staff'];   
            }
            else if($result_login['company']!=''){
             $creditperson=$result_login['company'];   
            }
            else if($result_login['guest']!=''){
             $creditperson=$result_login['guest'].' - '.$result_login['ly_mobileno'] ; 
            }
            if($result_login['dine_bill_total']!=''){
             $billamount=$result_login['dine_bill_total'];   
            }
            else if($result_login['ta_bill_total']!=''){
             $billamount=$result_login['ta_bill_total'];   
            }
            $balance=round($credit_amount,2)-round($received_amount,2);
            if($balance<1){
                $balance=0;
            }
            
             if($result_login['di_remarks']!=''){
             $remark=$result_login['di_remarks'];   
            }
            else if($result_login['ta_remarks']!=''){
             $remark=$result_login['ta_remarks'];   
            }
            
            $balance1=$balance1+$balance;
            
                          $data['Sl No']=$i;
                          
                          $data['Date']=$result_login['cd_dayclosedate'];
                          $data['Category']=$result_login['ct_credit_type'];
                          $data['Party Name']=$creditperson;
                           $data['Remarks']=$remark;
                          $data['Bill No']=$result_login['cd_billno'];
                          $data['Bill Amount']=round($billamount,2);
                          $data['Credit Amount']=round($credit_amount,2);
                          $data['Received Amount']=round($received_amount,2);
                          $data['Balance Amount']=$balance;
                           $data['Credit Settle Date']=$result_login['cd_dateofsettle'];
                          array_push($data1,$data);
                          unset($data);
                          
                          
    } } }
                        
                          $data['Sl No']='';
                          $data['Date']='';
                          $data['Category']='';
                          $data['Party Name']='';
                            $data['Remarks']='';
                          $data['Bill No']='';
                          $data['Bill Amount']='';
                          $data['Credit Amount']='';
                          $data['Received Amount']='';
                          $data['Balance Amount']='';
                           $data['Credit Settle Date']='';
                          array_push($data1,$data);
                          unset($data);
                        
       
                          $data['Sl No']='Total';
                          $data['Date']='';
                          $data['Category']='';
                          $data['Party Name']='';
                            $data['Remarks']='';
                          $data['Bill No']='';
                          $data['Bill Amount']='';
                          $data['Credit Amount']=round($credit_amount1,2);
                          $data['Received Amount']=round($received_amount1,2);
                          $data['Balance Amount']=round($balance1,2);
                           $data['Credit Settle Date']='';
                          
                          array_push($data1,$data);
        
        $filename = " Credit Summary Report-" . $reporthead . ".xls";
        
        }
        
        
        
         
        if($_REQUEST['credit_partial_pay']=="Y"){
        
        
            $data=array();
            $data1=array();
            
         $crd_partial=0;  $billamount1=0;
           
         $sql_login  =  $database->mysqlQuery("select tbm.tab_status as ta_sts, tb.bm_status as di_sts,
         tcp.tcp_mode,tcp.tcp_date,tcp.tcp_login,tcp.tcp_amount,
         cd.cd_dateofsettle,tb.bm_creditremark as di_remarks,tbm.tab_creditremark as ta_remarks,cd.cd_dayclosedate,
         cd.cd_billno,ct.ct_credit_type,sm.ser_firstname as staff,lr.ly_mobileno,lr.ly_firstname as guest,c.ct_corporatename as company,
         tb.bm_finaltotal as dine_bill_total, tbm.tab_netamt as ta_bill_total,cd.cd_amount,cd.cd_settled from tbl_credit_details cd
         left join tbl_credit_master cm on cd_masterid =crd_id 
         left join tbl_staffmaster sm on ser_staffid=crd_staffid 
         left join tbl_credit_partial_bill tcp on tcp_billno=cd_billno
         left join tbl_corporatemaster c on ct_corporatecode=crd_corporateid 
         left join tbl_loyalty_reg lr on ly_id=crd_guestid 
         left join tbl_credit_types ct  on ct.ct_creditid=cm.crd_type 
         left join tbl_tablebillmaster tb on bm_billno =cd_billno 
         left join tbl_takeaway_billmaster tbm on tab_billno=cd_billno 
         where  $string and  tcp_billno!=''  " ); 
     
        $num_login   = $database->mysqlNumRows($sql_login);
        if($num_login){$i=0;		  
        while($result_login=$database->mysqlFetchArray($sql_login))
        { 
           if($result_login['ta_sts']!='Cancelled' && $result_login['di_sts']!='Cancelled'){
               
            $i++;
            $settled_status=$result_login['cd_settled'];
            if($settled_status=='N'){
            $credit_amount=$result_login['cd_amount'];
            $received_amount=0;
            $credit_amount1=$credit_amount1+$credit_amount;
            }
            else if($settled_status=='Y'){
            $received_amount=$result_login['cd_amount'];
            $credit_amount=0;
             $received_amount1=$received_amount1+$received_amount;
            }
            if($result_login['staff']!=''){
             $creditperson=$result_login['staff'];   
            }
            else if($result_login['company']!=''){
             $creditperson=$result_login['company'];   
            }
            else if($result_login['guest']!=''){
             $creditperson=$result_login['guest'].' - '.$result_login['ly_mobileno'] ; 
            }
            if($result_login['dine_bill_total']!=''){
             $billamount=$result_login['dine_bill_total'];   
            }
            else if($result_login['ta_bill_total']!=''){
             $billamount=$result_login['ta_bill_total'];   
            }
            $balance=round($credit_amount,2)-round($received_amount,2);
            if($balance<1){
                $balance=0;
            }
            
             if($result_login['di_remarks']!=''){
             $remark=$result_login['di_remarks'];   
            }
            else if($result_login['ta_remarks']!=''){
             $remark=$result_login['ta_remarks'];   
            }
            
             $crd_partial=$crd_partial+$result_login['tcp_amount'];
            $balance1=$balance1+$balance;
            
            $billamount1=$billamount1+$billamount;
            
                          $data['Sl No']=$i;
                          
                          $data['Bill Date']=$result_login['cd_dayclosedate'];
                          $data['Category']=$result_login['ct_credit_type'];
                          $data['Party Name']=$creditperson;
                         
                          $data['Bill No']=$result_login['cd_billno'];
                          $data['Bill Amount']=round($billamount,2);
                          $data['Paid Amount']=$result_login['tcp_amount'];
                          $data['Login ']=$result_login['tcp_login'];
                          
                         if($result_login['tcp_mode']=='1'){  
                          $data['Pay Type']='Cash';
                         }else{
                            $data['Pay Type']='Card'; 
                         }
                          
                           $data['Paid Date']=$result_login['tcp_date'];
                          array_push($data1,$data);
                          unset($data);
                          
                          
    } } }
                        
                          
                        
       
                          $data['Sl No']='Total';
                          $data['Bill Date']='';
                          $data['Category']='';
                          $data['Party Name']='';
                       
                          $data['Bill No']='';
                          $data['Bill Amount']=round($billamount1,2);
                          $data['Paid Amount']=round($crd_partial,2);
                          $data['Login']='';
                          $data['Pay Type']='';
                          $data['Paid Date']='';
                          
                          array_push($data1,$data);
        
        $filename = " Credit Partial Pay Report-" . $reporthead . ".xls";
        
        } 
        
        
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
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 

        DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 

        DAY AND CURDATE( )";
                  $st= " Last 5 days ";      
                }elseif($bydatz=="Last10days")
                {
                        $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
        DAY AND CURDATE( )";
                        $stringta.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 
        DAY AND CURDATE( )";
                        $st= " Last 10 days ";
                }
                else if($bydatz=="Yesterday")
                                  {
                                          $string.="bm_dayclosedate = CURDATE() - INTERVAL 1 day";
                                            $stringta.="tab_dayclosedate = CURDATE() - INTERVAL 1 day";
                                            $st= " YESTER DAY ";
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
                        $st= " Today ";
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
                $data=array();
                $data1=array();
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
                            $data['SlNo']='';
                            $data['Cash']="Date:".$key;
                            $data['Card']='';
                            $data['Total']='';
                            array_push($data1,$data);
                            
                            $data['SlNo']=$i;
                            $data['Cash']=$cash_tip;
                            $data['Card']=$card_tip;
                            $data['Total']=number_format($total_tip_each_day,$_SESSION['be_decimal']);
                            array_push($data1,$data);
                        }
                       
                        
                        $data['SlNo']="TOTAL";
                        $data['Cash']=number_format($total_tip_cash,$_SESSION['be_decimal']);
                        $data['Card']=number_format($total_tip_card,$_SESSION['be_decimal']);
                        $data['Total']=number_format($total_tip,$_SESSION['be_decimal']);
                        array_push($data1,$data);

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
                        

                        $i=0;
                        $total_tip_cash=0;
                        $total_tip_card=0;
                        $total_tip=0;
                        foreach($tips_details as $key2=>$val2){ 
                            $data['BillNo']='';
                            $data['Cash']="Date:".$key2;
                            $data['Card']='';
                            $data['Total']='';
                            array_push($data1,$data);
                            
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

                                $data['BillNo']=$key;
                                $data['Cash']=$cash_tip;
                                $data['Card']=$card_tip;
                                $data['Total']=number_format($total_tip_each_day,$_SESSION['be_decimal']);
                                array_push($data1,$data);
                            }
                            
                        }
                        $data['BillNo']="TOTAL";
                        $data['Cash']=number_format($total_tip_cash,$_SESSION['be_decimal']);
                        $data['Card']=number_format($total_tip_card,$_SESSION['be_decimal']);
                        $data['Total']=number_format($total_tip,$_SESSION['be_decimal']);
                        array_push($data1,$data);
                        
                }

            }
        $filename = " Tips Collected Report-" . $reporthead . ".xls";
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

else if(($_REQUEST['type']=="billwise_item_cr"))
{
$reporthead="";
$st="";

	$string="";
	$string=" bm.bm_status='Closed' AND ";
	$sort_string='';
        $sort_string1='';
        
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead=$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		
	
	
	else 
	{
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";

	}
else if($bydatz=="Last90days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);

	}
    }
	 $data=array();
         $data1=array();
                
                
                

 $final=0;
 $dsc=0;
 $dscfinal=0;
  $sql_login  =  $database->mysqlQuery("SELECT td.bd_unit_weight,td.bd_unit_type,bm.bm_billtime,td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname,bm.bm_discountvalue from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno  WHERE $string $sort_string1 "); 
 $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;$dsc=0;
          
          
                            $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']='DI';
                            $data['Portion']='';
                            $data['Qty']='';
                            $data['Rate']='';
                            $data['Discount']='';
                            array_push($data1,$data);
          
          
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final + ($result_login['bd_rate'] * $result_login['bd_qty']);
				
				if($i==1)
				{
					
					$dscfinal=$dscfinal+($result_login['bm_discountvalue']);
					$dsc=$dsc + ($result_login['bm_discountvalue']);
					
					$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
					$old=$result_login['bd_billno'];
					$new=$result_login['bd_billno'];
					
                            $data['SlNo']=$k++;
                            $data['Date']=$database->convert_date($result_login['bm_dayclosedate']);
                            $data['Time']=$result_login['bm_billtime'];
                            $data['Bill No']=$result_login['bd_billno'];
                            $data['Items']=$result_login['mr_menuname'];
                            $data['Portion']=$result_login['pm_portionname'].' '.$result_login['bd_unit_type'].'['.$result_login['bd_unit_weight'].']';
                            $data['Qty']=$result_login['bd_qty'];
                            $data['Rate']=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal']);
                            $data['Discount']='';
                            array_push($data1,$data);
				  
				}else
				{
					$old=$new;
					$new=$result_login['bd_billno'];
					
					if($new==$old)
					{$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
					
						
                      
                             $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']=$result_login['mr_menuname'];
                            $data['Portion']=$result_login['pm_portionname'].' '.$result_login['bd_unit_type'].'['.$result_login['bd_unit_weight'].']';
                            $data['Qty']=$result_login['bd_qty'];
                            $data['Rate']=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal']);
                            $data['Discount']='';
                            array_push($data1,$data);
                      
					}else
					{
						
						
                  
                  
                             $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']='';
                            $data['Portion']='Total';
                            $data['Qty']='';
                            $data['Rate']=number_format($each,$_SESSION['be_decimal']);
                            $data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
                            array_push($data1,$data);
                  
                   $each=0;$dsc=0;
				  $each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
				  $dsc=$dsc + ($result_login['bm_discountvalue']);
				  $dscfinal=$dscfinal+($result_login['bm_discountvalue']);
				  
                  
                  $data['SlNo']=$k++;
                            $data['Date']=$database->convert_date($result_login['bm_dayclosedate']);
                            $data['Time']=$result_login['bm_billtime'];
                            $data['Bill No']=$result_login['bd_billno'];
                            $data['Items']=$result_login['mr_menuname'];
                            $data['Portion']=$result_login['pm_portionname'].' '.$result_login['bd_unit_type'].'['.$result_login['bd_unit_weight'].']';
                            $data['Qty']=$result_login['bd_qty'];
                            $data['Rate']=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal']);
                            $data['Discount']='';
                            array_push($data1,$data);
                  
					}
				}
				$i++;
	       
	 } 
     
                            $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']='';
                            $data['Portion']='Total';
                            $data['Qty']='';
                            $data['Rate']=number_format($each,$_SESSION['be_decimal']);
                            $data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
                            array_push($data1,$data);
                   } 
                              
                              
 $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']='';
                            $data['Portion']='';
                            $data['Qty']='';
                            $data['Rate']='';
                            $data['Discount']='';
                            array_push($data1,$data);
                            
                            
                            
                            $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']='';
                            $data['Portion']='Total';
                            $data['Qty']='';
                            $data['Rate']=number_format($final,$_SESSION['be_decimal']);
                            $data['Discount']=number_format($dscfinal,$_SESSION['be_decimal']);
                            array_push($data1,$data);
 
  $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']='GRAND TOTAL';
                            $data['Portion']='';
                            $data['Qty']='';
                            $data['Rate']='';
                            $data['Discount']=number_format(($final-$dscfinal),$_SESSION['be_decimal']);
                            array_push($data1,$data);
                            
                                
                            
        $stringt="";
	$stringt=" tbm.tab_status='Closed' ";
        $sort_string='';
        $sort_string1='';
       
	$reporthead="";
	
				
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
                                                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."'";
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
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	$st="Last5days";
	}elseif($bydatz=="Last10days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	$st="Last10days";
	}
	else if($bydatz=="Yesterday")
			  {
				  $stringt.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	elseif($bydatz=="Last15days")
	{
		$stringt.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
 $st="Last15days";
	}
	else if($bydatz=="Last20days")
	{
		$stringt.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last20days";
	}
	else if($bydatz=="Last25days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last25days";
	}
	else if($bydatz=="Last30days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last30days";
	}
	 else if($bydatz=="Last1month")
			  {
				  $stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  $st="Last1month";
			  }
	else if($bydatz=="Today")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($bydatz=="Last90days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last90days";
	}
else if($bydatz=="Last180days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last180days";
	}
else if($bydatz=="Last365days")
	{
		$stringt.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last365days";
	}
	$reporthead=$st;
}
else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$stringt.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	}
	
	?>
    
    
	
									
                                          <?php
 $final1=0; 
  $dsc=0;
 $dscfinal1=0;
$sql_login  =  $database->mysqlQuery("select tbd.tab_unit_type,tbd.tab_unit_weight,tbm.tab_time,tbm.tab_netamt,tbm.tab_discountvalue,tbm.tab_billno,tbm.tab_dayclosedate,mm.mr_menuname,tbd.tab_qty,tbd.tab_rate,p.pm_portionname from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid left join tbl_portionmaster p on p.pm_id=tbd.tab_portion where $stringt $sort_string1 "); 
$old='';$new='';	 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;$dsc=0;
          
                             $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']='TA-HD-CS';
                            $data['Portion']='';
                            $data['Qty']='';
                            $data['Rate']='';
                            $data['Discount']='';
                            array_push($data1,$data);
    
          
          
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$final1=$final1+($result_login['tab_rate'] * $result_login['tab_qty']);
                        
                        if($i==1)
				{
					
					$dscfinal1=$dscfinal1+($result_login['tab_discountvalue']);
					$dsc=$dsc + ($result_login['tab_discountvalue']);
					$each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
//					$each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
					$old=$result_login['tab_billno'];
					$new=$result_login['tab_billno'];
	 

    						
                              
                              $data['SlNo']=$k++;
                            $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
                            $data['Time']=$result_login['tab_time'];
                            $data['Bill No']=$result_login['tab_billno'];
                            $data['Items']=$result_login['mr_menuname'];
                            $data['Portion']=$result_login['pm_portionname'].' '.$result_login['tab_unit_type'].' ['.$result_login['tab_unit_weight'].']';
                            $data['Qty']=$result_login['tab_qty'];
                            $data['Rate']=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal']);
                            $data['Discount']='';
                            array_push($data1,$data);
                              
				  
				}else
				{
					$old=$new;
					$new=$result_login['tab_billno'];
					
					if($new==$old)
					{
                                            $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
					
			
                      
                             $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']=$result_login['mr_menuname'];
                            $data['Portion']=$result_login['pm_portionname'].' '.$result_login['tab_unit_type'].' ['.$result_login['tab_unit_weight'].']';
                            $data['Qty']=$result_login['tab_qty'];
                            $data['Rate']=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal']);
                            $data['Discount']='';
                            array_push($data1,$data);
                      
                      
					}else
					{
						
			
                  
                   $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']='';
                            $data['Portion']='Total';
                            $data['Qty']='';
                            $data['Rate']=number_format($each,$_SESSION['be_decimal']);
                            $data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
                            array_push($data1,$data);
                  
                  
                  $each=0;$dsc=0;
				  $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
				  $dsc=$dsc + ($result_login['tab_discountvalue']);
				  $dscfinal1=$dscfinal1+($result_login['tab_discountvalue']);
				  
                  
                  $data['SlNo']=$k++;
                            $data['Date']=$database->convert_date($result_login['tab_dayclosedate']);
                            $data['Time']=$result_login['tab_time'];
                            $data['Bill No']=$result_login['tab_billno'];
                            $data['Items']=$result_login['mr_menuname'];
                            $data['Portion']=$result_login['pm_portionname'].' '.$result_login['tab_unit_type'].' ['.$result_login['tab_unit_weight'].']';
                            $data['Qty']=$result_login['tab_qty'];
                            $data['Rate']=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal']);
                            $data['Discount']='';
                            array_push($data1,$data);
                  
                  
			}
				}
				$i++;
	      

               
   
	 } 
     
      
                  
                   $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']='';
                            $data['Portion']='Total';
                            $data['Qty']='';
                            $data['Rate']=number_format($each,$_SESSION['be_decimal']);
                            $data['Discount']=number_format($dsc,$_SESSION['be_decimal']);
                            array_push($data1,$data);
                  
                  
                  
                  } 
                              
                              
 
     
      $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']='';
                            $data['Portion']='';
                            $data['Qty']='';
                            $data['Rate']='';
                            $data['Discount']='';
                            array_push($data1,$data);
     
     
                            $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='Total';
                            $data['Items']='';
                            $data['Portion']='';
                            $data['Qty']='';
                            $data['Rate']=number_format($final1,$_SESSION['be_decimal']);
                            $data['Discount']=number_format($dscfinal1,$_SESSION['be_decimal']);
                            array_push($data1,$data);
     
  
  
  
  
                            $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='Grand Total';
                            $data['Items']='';
                            $data['Portion']='';
                            $data['Qty']='';
                            $data['Rate']='';
                            $data['Discount']=number_format(($final1-$dscfinal1),$_SESSION['be_decimal']);
                            array_push($data1,$data);
  
  
   
            $data['SlNo']='';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']='';
                            $data['Portion']='';
                            $data['Qty']='';
                            $data['Rate']='';
                            $data['Discount']='';
                            array_push($data1,$data);
  

  $all_fin=0;
  $di_fin=0;
  $tch_fin=0;
  $di_fin=$final-$dscfinal;
  $tch_fin=$final1-$dscfinal1;
  
  
  $all_fin=$di_fin+$tch_fin;
 
                  $data['SlNo']=' Sub Total (All Modules) :';
                            $data['Date']='';
                            $data['Time']='';
                            $data['Bill No']='';
                            $data['Items']='';
                            $data['Portion']='';
                            $data['Qty']='';
                            $data['Rate']='';
                            $data['Discount']=number_format($all_fin,$_SESSION['be_decimal']);
                            array_push($data1,$data);           
                            
                            
                            
                            
                            
                            
                                           
 $filename = " Consolidated Bill Detail Report" . $reporthead . ".xls";
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

