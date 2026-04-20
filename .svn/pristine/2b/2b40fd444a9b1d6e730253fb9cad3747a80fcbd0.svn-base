<?php
include('includes/session.php');		
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
} 
error_reporting(0);
 function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
  
  
  
 if(($_REQUEST['type']=="banquet_sales_report"))
{
    
    	 $string="";
        
          if($_REQUEST['mode']!="all"){
            $string.=" ti.fi_paid_by_mode='".$_REQUEST['mode']."' and  ";
       }
        
         
         
       if($_REQUEST['fun_type']!=""){
            $string.=" tfd.fd_function_type='".$_REQUEST['fun_type']."' and  ";
       }
        
        if($_REQUEST['banquet_type']!=""){
        $string.=" tfd.fd_reg_type='".$_REQUEST['banquet_type']."' and  ";
        }
        
        if($_REQUEST['venue']!=""){
        $string.=" tfd.fd_venue='".$_REQUEST['venue']."' and  ";
        }
        
 
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " fd_date between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " fd_date between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " fd_date between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		
	
	else 
	{
            $bydatz=$_REQUEST['bydate'];
            $st='';
		
            if($bydatz!="null" && $bydatz !='' )
            {
		
	
                        if($bydatz=="Last5days")
                        {

                                $string.=" fd_date between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                $st= " Last 5 days ";
                                
                        }elseif($bydatz=="Last10days")
                        {
                                $string.=" fd_date between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                                $st= " Last 10 days ";
                        }
                        elseif($bydatz=="Last15days")
                        {
                                $string.=" fd_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                $st= " Last 15 days ";
                        }
                        else if($bydatz=="Last20days")
                        {
                                $string.=" fd_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                $st= " Last 20 days ";
                        }
                        else if($bydatz=="Last25days")
                        {
                                $string.=" fd_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                $st= " Last 25 days ";
                        }
                        else if($bydatz=="Last30days")
                        {
                                $string.=" fd_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                $st= " Last 30 days ";
                        }
                        else if($bydatz=="Today")
                        {
                                $string.=" fd_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                $st= " Today ";
                        }
                        else if($bydatz=="Yesterday")
                        {
                                $string.=" fd_date = CURDATE() - INTERVAL 1 DAY";
                                $st= " Yesterday ";
                        }
                        else if($bydatz=="Last1month")
                        {
                                $string.="  fd_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                                $st= " Last 1 month ";
                        }
                        else if($bydatz=="Last90days")
                        {
                                $string.=" fd_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                $st= " Last 3 months ";
                        }
                        else if($bydatz=="Last180days")
                        {
                                $string.=" fd_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                                $st= " Last 6 months "; 
                        }
                        else if($bydatz=="Last365days")
                        {
                                $string.=" fd_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                                $st= " Last 1 year "; 
                        }
                $reporthead=$st;
                        }
                        else
                        {


                                $from=date("Y-m-d");
                                        $to=date("Y-m-d");
                                        $string.= " fd_date between '".$from."' and '".$to."' ";
                                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                                               
                        }

                        }
	
 
    
    $data=array();
    $data1=array();
   
  	$fin_total=0;
          $sql_login  =  $database->mysqlQuery("select * from tbl_function_details tfd left join tbl_function_type tft on tft.ft_id=tfd.fd_function_type left join tbl_function_venue tfv on tfv.fv_id=tfd.fd_venue left join tbl_function_invoice ti on ti.fi_function_id=tfd.fd_id where $string and ti.fi_invoice_no!='' "); 
       
          $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {
              while($result_login= $database->mysqlFetchArray($sql_login))
              {
                  
                  
                $fin_total=$fin_total+$result_login['fi_total_final_rate'];
               
                
                       $data['Bill No'] =      $result_login['fi_invoice_no'];
                         $data['Function Id'] =    $result_login['fd_id'];
                         $data['Function Date'] =    $result_login['fd_date'];
                          $data['Registered Date'] =   $result_login['fd_reg_date'];
                           $data['Bq.Type'] =   $result_login['fd_reg_type'];
                             $data['Pay Mode'] =   $result_login['fi_paid_by_mode'];
                           $data['Customer Name'] =   $result_login['fd_customer'];
                            $data['Function Type'] =  $result_login['ft_name'];
                           $data['venue'] =   $result_login['fv_name'];
                          $data['Billing Type'] =    $result_login['fd_billing_type'];
                          $data['PAx Nos'] =    $result_login['fd_no_of_pax'];
                           $data['Subtotal'] =   number_format($result_login['fi_total_cost'],$_SESSION['be_decimal']);
                           $data['Discount'] =   number_format($result_login['fi_discount_amount'],$_SESSION['be_decimal']);
                           $data['Extra Cost'] =   number_format($result_login['fi_total_extra_cost'],$_SESSION['be_decimal']);
                           $data['Total Amount'] =   number_format($result_login['fi_total_final_rate'],$_SESSION['be_decimal']);
                          $data['Advance Paid'] =    number_format($result_login['fd_advance_given'],$_SESSION['be_decimal']);
                          $data['Balance'] =    number_format($result_login['fi_balance_amt'],$_SESSION['be_decimal']);
                
                
                
                array_push($data1,$data);
                unset($data);
          
          }
           
                         $data['Bill No'] =      "Total";
                         $data['Function Id'] =   "";
                         $data['Function Date'] =   "";
                          $data['Registered Date'] =  "";
                           $data['Bq.Type'] =   "";
                             $data['Pay Mode'] = "";
                           $data['Customer Name'] =  "";
                            $data['Function Type'] =  "";
                           $data['venue'] =   "";
                          $data['Billing Type'] =    "";
                          $data['PAx Nos'] =   "";
                           $data['Subtotal'] =   "";
                           $data['Discount'] =  "";
                           $data['Extra Cost'] =  "";
                           $data['Total Amount'] =   number_format($fin_total,$_SESSION['be_decimal']);
                          $data['Amount Paid'] =   "";
                          $data['Balance'] =    "";
                array_push($data1,$data);
                unset($data);
          }
  $filename = " Banquet sales Report-" . $reporthead . ".xls";
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
else if(($_REQUEST['type']=="banquet_extracost_report"))
        {
        $tax='';
        $string="";
        $tx1='';
        
        if($_REQUEST['banquet_type']!=""){
        $string.=" tfd.fd_reg_type='".$_REQUEST['banquet_type']."' and  ";
        }
       
       
       if(isset($_REQUEST['extra'])){
               
              $tax=$_REQUEST['extra'];
             // $tx1=implode(',',$tax) ;
              $string.= " tvi.fi_extra_id in($tax) and  ";
        }
       
 
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tfd.fd_date between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tfd.fd_date between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tfd.fd_date between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		
	
	else 
	{
            $bydatz=$_REQUEST['bydate'];
            $st='';
		
            if($bydatz!="null" && $bydatz !='' )
            {
		
	
                        if($bydatz=="Last5days")
                        {

                                $string.=" tfd.fd_date between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
                                $st= " Last 5 days ";
                                
                        }elseif($bydatz=="Last10days")
                        {
                                $string.=" tfd.fd_date between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
                                $st= " Last 10 days ";
                        }
                        elseif($bydatz=="Last15days")
                        {
                                $string.=" tfd.fd_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                                $st= " Last 15 days ";
                        }
                        else if($bydatz=="Last20days")
                        {
                                $string.=" tfd.fd_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                                $st= " Last 20 days ";
                        }
                        else if($bydatz=="Last25days")
                        {
                                $string.=" tfd.fd_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                                $st= " Last 25 days ";
                        }
                        else if($bydatz=="Last30days")
                        {
                                $string.=" tfd.fd_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                                $st= " Last 30 days ";
                        }
                        else if($bydatz=="Today")
                        {
                                $string.=" tfd.fd_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                                $st= " Today ";
                        }
                        else if($bydatz=="Yesterday")
                        {
                                $string.=" tfd.fd_date = CURDATE() - INTERVAL 1 DAY";
                                $st= " Yesterday ";
                        }
                        else if($bydatz=="Last1month")
                        {
                                $string.="  tfd.fd_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
                                $st= " Last 1 month ";
                        }
                        else if($bydatz=="Last90days")
                        {
                                $string.=" tfd.fd_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
                                $st= " Last 3 months ";
                        }
                        else if($bydatz=="Last180days")
                        {
                                $string.=" tfd.fd_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
                                $st= " Last 6 months "; 
                        }
                        else if($bydatz=="Last365days")
                        {
                                $string.=" tfd.fd_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
                                $st= " Last 1 year "; 
                        }
                $reporthead=$st;
                        }
                        else
                        {


                                $from=date("Y-m-d");
                                        $to=date("Y-m-d");
                                        $string.= " tfd.fd_date between '".$from."' and '".$to."' ";
                                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
                                               
                        }

                        }
                 
      $data=array();
      $data1=array();                   
            
                $tax_id=array();
                 $tax_id1=array();
                $sql_login  =  $database->mysqlQuery(" select distinct(fec_name) as taxid,fec_id  FROM tbl_function_extra_costs where fec_id in ($tax) "); 
                    //                            echo " select distinct(fec_name) as taxid  FROM tbl_function_extra_costs where fec_id in ($tx1) ";
                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login){ 
                    while($result_login=$database->mysqlFetchArray($sql_login)){
                   
                    $tax_id[]=$result_login['taxid'];
                     $tax_id1[]=$result_login['fec_id'];
                    
                    
                }}           
                        
          
	$fin_total=0;
        $fin_all=0;
        $tot_ext_all=0;
        $exin_sep=0;
        $extra_arry=  array();
        $extra_arry1=array();
        $sql_login  =  $database->mysqlQuery("select ti.fi_total_cost,tvi.fi_extra_id,tvi.fi_invoice_no ,tfd.fd_date,tfd.fd_total_rate,tvi.fi_extra_rate,tfd.fd_reg_date,ti.fi_total_final_rate from tbl_function_details tfd left join tbl_function_type tft on tft.ft_id=tfd.fd_function_type left join tbl_function_venue tfv on tfv.fv_id=tfd.fd_venue left join tbl_function_invoice ti on ti.fi_function_id=tfd.fd_id left join tbl_function_invoice_extras tvi on tvi.fi_invoice_no=ti.fi_invoice_no where $string and ti.fi_invoice_no!='' " ); 
       
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {
              while($result_login= $database->mysqlFetchArray($sql_login))
              {
                  
                  
                 
                  
                  
                  $extra_arry[$result_login['fi_invoice_no']][$result_login['fi_extra_id']]['rate']=$result_login['fi_extra_rate'];
                  $extra_arry[$result_login['fi_invoice_no']]['invoice']=$result_login['fi_invoice_no'];
                  $extra_arry[$result_login['fi_invoice_no']]['date']=$result_login['fd_date'];
                  $extra_arry[$result_login['fi_invoice_no']]['sale']=$result_login['fi_total_cost'];
                  $extra_arry[$result_login['fi_invoice_no']]['regdate']=$result_login['fd_reg_date'];
                  $extra_arry[$result_login['fi_invoice_no']]['finaltotal']=$result_login['fi_total_final_rate'];
                  $extra_arry1[$result_login['fi_extra_id']][]=$result_login['fi_extra_rate'];
                  
                 
                  
              }
              
              foreach($extra_arry as $key=>$value){
               
                    $ext_tot=0;
                    $data['Bill No'] =$extra_arry[$key]['invoice'];
                    $data['Function Date'] =$extra_arry[$key]['date'];
                    $data['Sale'] =$extra_arry[$key]['sale'];
                    $data['Registered Date'] =$extra_arry[$key]['regdate'];
                    
                    for($f=0;$f<count($tax_id1);$f++){
                        
                     if($extra_arry[$key][$tax_id1[$f]]['rate']){
                    $ext_tot=  $ext_tot+$extra_arry[$key][$tax_id1[$f]]['rate'];
                    
                    $data[$tax_id[$f]] =$extra_arry[$key][$tax_id1[$f]]['rate'];
                    }else{
                         $data[$tax_id[$f]] =0;
                    } }
                    
                    $data['Total Extras'] =$ext_tot;
                    $data['Total'] =$extra_arry[$key]['finaltotal'];
                    
                    
             $tot_ext_all=$tot_ext_all+$ext_tot;
             $fin_all=$fin_all+$extra_arry[$key]['finaltotal'];
                 
               array_push($data1,$data);
                unset($data);
      
                      }
           
                        $data['BillNo'] ="Total";
                         $data['Function Date'] ="";
                         $data['Sale'] ="";
                          $data['Registered Date'] ="";
                           for($ff=0;$ff<count($tax_id1);$ff++){
                           $data[$tax_id[$ff]] =array_sum($extra_arry1[$tax_id1[$ff]]);
                           
                           }
                             $data['Total Extras'] =$tot_ext_all;
                             
                              $data['Total'] =$fin_all;
                       array_push($data1,$data);
                unset($data);
          
  $filename = " Banquet sales Report-" . $reporthead . ".xls";
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
              echo '';
          }
          
          

}


?>
