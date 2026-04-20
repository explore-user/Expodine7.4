<?php
error_reporting(0);
include('includes/session.php');		// Check session
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
}
$branchname='';
$address='';
 
 $sql_branch =  $database->mysqlQuery("Select be_branchname,be_address,be_email,be_phone,be_others1,be_others2,be_others3,be_footer1,be_footer2,be_footer3,be_footer4 from tbl_branchmaster where be_branchid='".$_SESSION['branchofid']."'"); 
		  $num_branch  = $database->mysqlNumRows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = $database->mysqlFetchArray($sql_branch)) 
					{
						 $branchname=$result_branch['be_branchname'];
						 $address=$result_branch['be_address'];
                                                 
						
					}
		  }


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report</title>
<link href="css/menu_master_style.css" rel="stylesheet">
<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="css/app.css" rel="stylesheet" type="text/css">
<link href="bower_components/chosen/chosen.min.css" rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="mn/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="mn/css/demo.css" />
<link rel="stylesheet" type="text/css" href="mn/css/icons.css" />
<link rel="stylesheet" type="text/css" href="mn/css/component.css" />
<link rel="stylesheet" href="css/tabs_mn_master.css">
<link rel="stylesheet" type="text/css" href="css/turbotabs.css" />
<link rel="stylesheet" type="text/css" href="css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="css/report_styl.css" />

<style>.left_list_cc{height: 71vh;min-height: 498px !important}</style>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="mn/js/modernizr.custom.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<style>
    .table-font {
  
    font-size: 15px;
}
    .newconsl_table th, td{padding: 3px !important;}
    ::-webkit-scrollbar {
    width: 16px;
    height: auto;
}
.back-button-print{width: 100px;height: 30px;float: left;background: #1a1a1a;text-align: center;line-height:  30px;font-size: 14px;color: #fff !important}
.print_button_main{float: left;margin-right: 10px;height: 30px;width: 100px}
</style>
</head>
<body style="background:none;overflow:scroll !important">
<!-- main header -->
<div >

 <div class="section_content" id="div_list">
                      
  <div class="print_content">  
          <div class="estimate_cnt_wrapper_print">  
          		<div class="table_wrapper">
        <table border="0" cellpadding="1" cellspacing="3" width="100%"style="float:left">
        <tbody>
          <tr> 
              <td width="120px" id="printbutton"> <input type="submit" value="Print"  style="margin-right:55px;border: 0px" class="back-button-print print_button_main" onclick="return print_page()" />
          </td>
           <td>
           <a class="back-button-print" onclick="return close_page() ">Close</a>
          </td>
          </tr>
            
          <tr> 
          <td>&nbsp;</td>
          </tr>
          
        </tbody>
        </table>

 <?php 

 
 if($_REQUEST['type']=="banquet_sales_report")
  {
     ?>
       <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Banquet Sales Report</strong></th>
      </tr>

    </thead>
           
    </table> 
                             
<?php

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
                        
	?>
 <table class="table table-bordered table-font user_shadow" >
			<thead>
                            <tr>
                                <th colspan="17">Banquet Sales Report -  <?=$reporthead?></th>
                            </tr>
                            <tr>
                               <th class="sortable">Invoice No</th>
                                <th class="sortable">Function Id</th>
                               <th class="sortable">Function Date</th>
                                <th class="sortable">Registered Date</th>
                                <th class="sortable">Bq.Type</th>
                                 <th class="sortable">Pay Mode</th>
                                <th class="sortable">Customer Name</th>
                                  <th class="sortable">Functionn Type </th>
                                 <th class="sortable">Venue</th>
                                  <th class="sortable">Billing Type</th>
                                   <th class="sortable">Pax Nos</th>
                                    <th class="sortable">Subtotal</th>
                                     <th class="sortable">Discount</th>
                                     <th class="sortable">Extra cost</th>
                                      <th class="sortable">Total Amount</th>
                                       <th class="sortable">Advance paid</th>
                                        <th class="sortable">Balance</th>
                                         
                                  
                                
                            </tr>
                        </thead>
                        <tbody>
<?php 
	$fin_total=0;
          $sql_login  =  $database->mysqlQuery("select * from tbl_function_details tfd left join tbl_function_type tft on tft.ft_id=tfd.fd_function_type left join tbl_function_venue tfv on tfv.fv_id=tfd.fd_venue left join tbl_function_invoice ti on ti.fi_function_id=tfd.fd_id where $string and ti.fi_invoice_no!='' "); 
       
          $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {
              while($result_login= $database->mysqlFetchArray($sql_login))
              {
                  
                    $fin_total=$fin_total+$result_login['fi_total_final_rate'];
                 ?> 
                  
                  
                   <tr>
                                 <td ><?=$result_login['fi_invoice_no']?></td>
                                <td ><?=$result_login['fd_id']?></td>
                                <td ><?=$result_login['fd_date']?></td>
                                <td ><?=$result_login['fd_reg_date']?></td>
                                <td ><?=$result_login['fd_reg_type']?></td>
                                 <td ><?=$result_login['fi_paid_by_mode']?></td>
                                <td ><?=$result_login['fd_customer']?></td>
                                <td ><?=$result_login['ft_name']?></td>
                                <td ><?=$result_login['fv_name']?></td>
                                <td ><?=$result_login['fd_billing_type']?></td>
                                <td ><?=$result_login['fd_no_of_pax']?></td>
                                <td ><?=number_format($result_login['fi_total_cost'],$_SESSION['be_decimal'])?></td>
                                 <td ><?=number_format($result_login['fi_discount_amount'],$_SESSION['be_decimal'])?></td>
                                <td ><?=number_format($result_login['fi_total_extra_cost'],$_SESSION['be_decimal'])?></td>
                                <td ><?=number_format($result_login['fi_total_final_rate'],$_SESSION['be_decimal'])?></td>
                                <td ><?=number_format($result_login['fd_advance_given'],$_SESSION['be_decimal'])?></td>
                                <td ><?=number_format($result_login['fi_balance_amt'],$_SESSION['be_decimal'])?></td>
                                
                            </tr>      
                  
                  <?php
              }
              ?>
                            
                         <tr>
                                 <td >Total</td>
                                <td ></td>
                                 <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                 <td ></td>
                                <td ></td>
                                <td ><?=number_format($fin_total,$_SESSION['be_decimal'])?></td>
                                <td ></td>
                                <td ></td>
                                
                            </tr>           
                            
                             </tbody>
                    </table>
                            
                            
                            </div>
                       </div>
                      </div>
                     </div>
                    </div>
                            </body>
</html>
<?php
}

}
else if(($_REQUEST['type']=="banquet_extracost_report"))
        {
    ?>
 <table class="table table-bordered table-font user_shadow newconsl_table" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="17">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Banquet Extra Cost Report</strong></th>
      </tr>

    </thead>
           
    </table> 


<?php
        $tax='';
        $string="";
        $tx1='';
        
        if($_REQUEST['banquet_type']!=""){
        $string.=" tfd.fd_reg_type='".$_REQUEST['banquet_type']."' and  ";
        }
       
       
       if($_REQUEST['extra']){
            
              $tax=$_REQUEST['extra'];
            //  $tx1=implode(',',$tax) ;
            
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
                        
                    
                //  print_r($tax_id);      
                        
	?>
 <table class="table table-bordered table-font user_shadow" >
     
     <?php
     
      $sql_login  =  $database->mysqlQuery("select * from tbl_function_details tfd left join tbl_function_type tft on tft.ft_id=tfd.fd_function_type left join tbl_function_venue tfv on tfv.fv_id=tfd.fd_venue left join tbl_function_invoice ti on ti.fi_function_id=tfd.fd_id left join tbl_function_invoice_extras tvi on tvi.fi_invoice_no=ti.fi_invoice_no where $string and ti.fi_invoice_no!='' "); 
    //echo "select * from tbl_function_details tfd left join tbl_function_type tft on tft.ft_id=tfd.fd_function_type left join tbl_function_venue tfv on tfv.fv_id=tfd.fd_venue left join tbl_function_invoice ti on ti.fi_function_id=tfd.fd_id left join tbl_function_invoice_extras tvi on tvi.fi_invoice_no=ti.fi_invoice_no where $string and ti.fi_invoice_no!='' ";
          $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  {
          
            $c=6;
            ?>
        
     
     
			<thead>
                            <tr>
                                <th colspan="<?=count($tax_id)+$c?> ">Banquet Sales Report  <?=$reporthead?></th>
                            </tr>
                            <tr>
                               <th class="sortable">Bill No</th>
                                <th class="sortable">Function Date</th>
                               <th class="sortable">Sales</th>
                                <th class="sortable">Registered Date</th>
                                
                               <?php
                              // print_r($tax_id);
                                       for($i=0;$i<count($tax_id);$i++){
                                          
                                        ?>
                                        <th class="sortable"><?=$tax_id[$i]?></th>
                                     <?php } ?>
                                
                                
                                <th class="sortable">Total Extras </th>
                                  <th class="sortable"> Total </th>
                               
                                   
                            </tr>
                        </thead>
                        
          <?php }else{
              ?>
             <td id="record_div" width='80' style='text-align:center;color: red;font-weight: bold'>
    <?php echo 'No records to Display' ?>
           </td>
                <?php                    
          }
          ?> 
                        
                        
                        <tbody>
<?php 
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
                   
                  ?>
                  <tr>
                      <td><?=$extra_arry[$key]['invoice']?></td>
                       <td><?=$extra_arry[$key]['date']?></td>
                        <td><?=number_format($extra_arry[$key]['sale'],$_SESSION['be_decimal'])?></td>
                         <td><?=$extra_arry[$key]['regdate']?></td>
                         
                         <?php
                         for($f=0;$f<count($tax_id1);$f++){
                            if($extra_arry[$key][$tax_id1[$f]]['rate']){
                                  $ext_tot=  $ext_tot+$extra_arry[$key][$tax_id1[$f]]['rate'];
                         ?>
                         
                         <td><?=number_format($extra_arry[$key][$tax_id1[$f]]['rate'],$_SESSION['be_decimal'])?></td>
                         
                         <?php }else{ ?>
                         
                         <td>0</td>
                         <?php
                         
                          
                         } } ?>
                         
                          <td><?=number_format($ext_tot,$_SESSION['be_decimal'])?></td>
                           <td><?=number_format($extra_arry[$key]['finaltotal'],$_SESSION['be_decimal'])?></td>
                           
                  </tr>
             <?php
             $tot_ext_all=$tot_ext_all+$ext_tot;
             $fin_all=$fin_all+$extra_arry[$key]['finaltotal'];
            
                      }
              
                  
                 ?> 
                  <tr>
                      <td>Total</td>
                      <td></td>
                      <td></td>
                      <td></td>
                      
                     <?php
                         for($ff=0;$ff<count($tax_id1);$ff++){
                            
                         ?>
                         
                      <td>
                          <?=number_format(array_sum($extra_arry1[$tax_id1[$ff]]),$_SESSION['be_decimal'])?>
                      </td>
                         
                        
                         <?php }  ?>
                      
                      <td><?=number_format($tot_ext_all,$_SESSION['be_decimal'])?></td>
                      <td><?=number_format($fin_all,$_SESSION['be_decimal'])?></td>
                      
                  </tr>
                  
                  
                             </tbody>
                    </table>
                            <?php
              
          }else{
              echo '';
          }
          
          

}
?>


 <script type="text/javascript">
function print_page()
{
  document.getElementById("printbutton").style.display = "none";	
  window.print();
}
function close_page(){
   window.top.close();
}
</script>      