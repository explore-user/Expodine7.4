
<script>

/*   sorting in order starts   */
$(document).ready(function () {

        //grab all header rows
        $('th').each(function (column) {
            $(this).addClass('sortable').click(function () {
			
                    var findSortKey = function ($cell) {
                        return $cell.find('.sort-key').text().toUpperCase()+ ' ' + $cell.text().toUpperCase();
                
                    };
                    var sortDirection = $(this).is('.sorted-asc') ? -1 : 1;
                    var $rows = $(this).parent().parent().parent().find('tbody tr').get();
                    var bob = 0;
                    //loop through all the rows and find
                    $.each($rows, function (index, row) {
                        row.sortKey = findSortKey($(row).children('td').eq(column));
                    });

                    //compare and sort the rows alphabetically or numerically
                    $rows.sort(function (a, b) {                       
                        if (a.sortKey.indexOf('-') == -1 && (!isNaN(a.sortKey) && !isNaN(a.sortKey))) {
                             //Rough Numeracy check                          
                                
                                if (parseInt(a.sortKey) < parseInt(b.sortKey)) {
                                    return -sortDirection;
                                }
                                if (parseInt(a.sortKey) > parseInt(b.sortKey)) {                                
                                    return sortDirection;
                                }

                        } else {
                            if (a.sortKey < b.sortKey) {
                                return -sortDirection;
                            }
                            if (a.sortKey > b.sortKey) {
                                return sortDirection;
                            }
                        }
                        return 0;
                    });

                    //add the rows in the correct order to the bottom of the table
                    $.each($rows, function (index, row) {
                        $('tbody').append(row);
                        row.sortKey = null;
                    });

                    //identify the collumn sort order
                    $('th').removeClass('sorted-asc sorted-desc');
                    var $sortHead = $('th').filter(':nth-child(' + (column + 1) + ')');
                    sortDirection == 1 ? $sortHead.addClass('sorted-asc') : $sortHead.addClass('sorted-desc');

                    //identify the collum to be sorted by
                    $('td').removeClass('sorted').filter(':nth-child(' + (column + 1) + ')').addClass('sorted');
                });
            });
        });
/*   sorting in order ends   */

</script>

<?php

include('includes/session.php');		// Check session
if($_SESSION["archive_enabled"]=='Y'){
    include("database.class.reports.php");  // DB Connection class
    $database	= new Database();
    
}
else if($_SESSION["archive_enabled"]=='N'){
    include("database.class.php");  // DB Connection class
    $database	= new Database();
    
}


$taxname1=0;
$taxname2=0;
$taxname3=0;

if($_REQUEST['type']=="tot_sales_ta")
{    
    error_reporting(0);
    $string="";
    $typesale=$_REQUEST['typesale'];
    $staffsel = '';
    $string.=" tab_status = 'Closed' and tab_mode='TA' and tab_complimentary!='Y' AND ";
    if(isset($_REQUEST['loginstaffsel'])){
        $staffsel = $_REQUEST['loginstaffsel'];
        if($staffsel!='null')
        {   
            $string.="tab_loginid='".$staffsel."' AND ";
        }
    }
    $reporthead="";
    $st="";
  
        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!=""){
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']==""){
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=date("Y-m-d");
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!=""){
            $from=date("Y-m-d");
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }
        
    
    else {
        $reporthead="";
	$st="";
	$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null"){
            if($bydatz=="Last5days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $st="Last 5 days";
            }elseif($bydatz=="Last10days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
                $st="Last 10 days";
            }elseif($bydatz=="Last15days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
                $st="Last 15 days";
            }else if($bydatz=="Last20days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
                $st="Last 20 days";
            }else if($bydatz=="Last25days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
                $st="Last 25 days";
            }else if($bydatz=="Last30days"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
                $st="Last 30 days";
            }else if($bydatz=="Today"){
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $st="Today";
            }else if($bydatz=="Yesterday"){
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
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
			<thead>
                            <?php
                            $tax_name=array();
                            $tax_id=array();
                                  $sql_login  =  $database->mysqlQuery("select  distinct(tketm.tbe_taxid) as taxid,tketm.tbe_label as taxname  FROM tbl_takeaway_bill_extra_tax_master tketm left join  tbl_extra_tax_master tm on tm.amc_id=tketm.tbe_taxid group by  amc_id order by tm.amc_id asc "); 
                                     $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){
                                       
                                       $tax_name[]=$result_login['taxname'];
                                       $tax_id[]=$result_login['taxid'];
                                     }}                                     
                                     ?>
                          <tr>
                                  	<th colspan="<?=9+count(array_unique($tax_id))?>">Report - <?=$reporthead?></th>
                                  
                                  </tr>
				<tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Date</th>
                                    <th class="sortable">Bill No</th>
                                    <th class="sortable">Taken By</th>
                                    <th class="sortable">Sub Total</th>
                                    <?php
                                     for($i=0;$i<count(array_unique($tax_name));$i++){
                                        ?>
                                        <th class="sortable"><?=$tax_name[$i]?></th>
                                     <?php } ?>
                                    <th class="sortable">Discount</th>
                                    <th class="sortable">Final</th>
                                    <th class="sortable">Paid</th>
                                    <th class="sortable">Balance</th>
				</tr>
			</thead>
		<tbody>						
<?php
  $final=0;
  $paid=0;
  $bal=0; 
  $dsc=0;
  $subtotal=0;
  $tax_value=array();
  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string");
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  
      $i++;
      $subtotal=$subtotal + $result_login['tab_subtotal'];
      $dsc=$dsc + $result_login['tab_discountvalue'];
			$final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$bal=$bal + $result_login['tab_amountbalace'];                    
	 ?>
    			                  <tr >
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['tab_dayclosedate'])?></td>
                               <td><?=$result_login['tab_billno']?></td>
                               <td><?=$result_login['tab_loginid']?></td>
                               <td><?=number_format($result_login['tab_subtotal'],$_SESSION['be_decimal'])?></td>
                                <?php 
                                for($s=0;$s<count(array_unique($tax_id));$s++){
                                $sql_taxvalue  =  $database->mysqlQuery("select  tketm.tbe_total_value,tketm.tbe_taxid, tketm.tbe_label FROM tbl_takeaway_bill_extra_tax_master tketm  where tketm.tbe_billno='".$result_login['tab_billno']."' and tketm.tbe_taxid ='".$tax_id[$s]."' order by tketm.tbe_taxid asc"); 
                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);                               
                                if($num_taxvalue){
                                    while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                    { if($result_taxvalue['tbe_total_value']==''){
                                        $result_taxvalue['tbe_total_value']=0;
                                    }
                                    $tax_value[$result_taxvalue['tbe_taxid']][]=$result_taxvalue['tbe_total_value'];                                                                   
                                ?>
                            <td><?=number_format($result_taxvalue['tbe_total_value'],$_SESSION['be_decimal'])?></td>
                            <?php  
                                } } 
                               else { 
                                   $tax_value[$tax_id[$s]][]=0;?>
                                <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                                <?php } }?>
                               <td><?=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['tab_amountpaid'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['tab_amountbalace'],$_SESSION['be_decimal'])?></td>
                        </tr> 
                              <?php } ?>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
   
    <td ></td>
    <td ></td>
    <td ><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
     <?php 
    for($i=0;$i<count(array_unique($tax_id));$i++){ 
        //print_r($tax_value);
        
        ?>
    <td><strong><?=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal'])?></strong></td>
    <?php  
     }
        for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){ ?>
   <td><strong><?=number_format(0,$_SESSION['be_decimal'])?></strong></td>
    <?php } ?>
    <td ><strong><?=number_format($dsc,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
    <?php }  else {?>
      <tr><td colspan="9" style="color:red;font-weight: bold;">No Records to Display</td></tr>                          
       <?php } ?>                      
                           </tbody>
                            </table>
                            
 <?php
          
 }
else if($_REQUEST['type']=="tot_sale_online")
{    
    
    $stringdi='';
    $string="";
    $typesale=$_REQUEST['typesale'];
    $staffsel = '';
    $string.=" tab_status = 'Closed' and  tab_complimentary!='Y' AND ";
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
            $string.= " tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
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
		$string.=" tab_dayclosedate = CURDATE() - INTERVAL 1 DAY " ;
                $stringdi.=" bm_dayclosedate = CURDATE( ) - INTERVAL 1 DAY  ";
                $st="Yesterday";
            }
	else if($bydatz=="Last1month") 
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
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
                         $stringdi.=" bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	}
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
			<thead>
                            
                          <tr>
                                 <th colspan="10">Report - <?=$reporthead?></th>
                                  
                                  </tr>
				<tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Date</th>
                                    <th class="sortable">Bill No</th>
                                     <th class="sortable">Online Partner</th>
                                      <th class="sortable"> Order No </th>
                                       <th class="sortable">Online Order No </th>
                                       <th class="sortable">Ref No </th>
                                     <th class="sortable">Bill Amount </th>
                                    <th class="sortable">Partner Discount</th>
                                    <th class="sortable">Partner Amount </th>
                                     
                                   
                                    
				</tr>
			</thead>
		<tbody>
<?php

      if($_REQUEST['partner_mode']!='DI' || $_REQUEST['partner_mode']==''){                                     
                                          
  $dsc=0; $total=0; $final_partner=0; $i=0;
  $sql_login  =  $database->mysqlQuery("select * from tbl_takeaway_billmaster where $string");
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
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
	 ?>

    			    <tr>
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['tab_dayclosedate'])?></td>
                               <td><?=$result_login['tab_billno']?></td>
                               <td><?=$partner?></td>
                               <?php if($_REQUEST['type_online']=='Local' || $_REQUEST['type_online']=='Online' ){ ?>
                               <td><?=$result_login['tab_urban_order_id']?></td>
                                <td><?=$result_login['tab_urban_partner_order_no']?></td>
                               <?php } else{ ?>
                               
                                <td><?=$result_login['tab_qr_order_id']?></td>
                                 <td></td>
                               <?php } ?>
                                <td><?=$result_login['tab_ref_no_new']?></td>
                                <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                               <td><?=number_format($result_login['tab_food_partner_discount'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['tab_food_partner_total'],$_SESSION['be_decimal'])?></td>
                             
                             
                             </tr> 
                             
                              
                              
                              
                              
          <?php } ?>
                                                          
 <tr>
     <td style="color: darkred;font-weight: bold " >&nbsp; HD Bill Count : <?=$i?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>  
      <td >&nbsp;</td>
    <td >&nbsp;</td>
  <td >&nbsp;</td>  
    <td >&nbsp;</td>
      <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
   
    <td ></td>
 <td ></td>
   <td ></td>
    <td ></td>
       <td >&nbsp;</td> 
    <td ><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($dsc,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($final_partner,$_SESSION['be_decimal'])?></strong></td>
    
  </tr>
  <?php } else{  ?>
   <tr><td style="color: red;font-weight: bold">No Records to Display</td>
 </td>  
  
  </tr>
  
      <?php } } 
                             
                              

     if($_REQUEST['partner_mode']=='DI' || $_REQUEST['partner_mode']==''){                                     
                                          
  $dsc=0; $total=0; $final_partner=0; $i=0;
  $sql_login  =  $database->mysqlQuery("select * from tbl_tablebillmaster where $stringdi");
  	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;
                        $total=$total + $result_login['bm_finaltotal'];
                      //  $dsc=$dsc + $result_login['tab_food_partner_discount'];
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
	 ?>

    			    <tr>
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                               <td><?=$result_login['bm_billno']?></td>
                               <td><?=$partner?></td>
                              
                                <td><?=$result_login['bm_qr_orderno']?></td>
                                 <td></td>
                             
                               
                                <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                               <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                             
                             
                             </tr> 
                             
                              
                              
                              
                              
          <?php } ?>
                                                          
 <tr>
     <td style="color: darkred;font-weight: bold " >&nbsp; DI Bill Count : <?=$i?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>  
      <td >&nbsp;</td>
    <td >&nbsp;</td>
  <td >&nbsp;</td>  
    <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
   
    <td ></td>
 <td ></td>
   <td ></td>
    <td ></td>
    <td ><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($dsc,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
      
  </tr>
  <?php } else{  ?>
   <tr><td style="color: red;font-weight: bold">No Records to Display</td>
 </td>  
  
  </tr>
  
      <?php } } ?>                          
                             
    </tbody>
    </table>
                            
 <?php
          
 }
 else if(($_REQUEST['type']=="qr_sale_timely"))
{
     
	$string="";
        $stringdi="";
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
          
            $stringta.="  DAYNAME(tbm.tab_dayclosedate) IN ($days2) and ";
              $stringdi.="  DAYNAME(tbm.bm_dayclosedate) IN ($days2) and ";
           
        }
       }
          
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
        
	

	?>
                    <table class="table table-bordered table-font user_shadow" >
			<thead>
                            <tr>
                                <th colspan="4">Time wise Qr Report  - <?=$reporthead?> between <?=$newfromtime?> and <?=$newtotime?> </th>
                            </tr>
                            
                        </thead>
                        <tbody>
        <?php
        
        
           ?>
                            
                            <tr>
                                <th colspan="4">Timely Sale</th>
                            </tr>
                            <tr>
                                <th class="sortable">SlNo</th>                                       
                                <th class="sortable">Bill No</th>
                                  <th class="sortable">Qr Order No</th>                         
                                <th class="sortable">Amount</th>
				
                                
                            </tr>
                        
                        
                      
<?php
        
                        
  $tot_sum1=0;
  $sql_login  =  $database->mysqlQuery("select tbm.tab_qr_order_id,tbm.tab_billno as billno, tbm.tab_netamt as final from tbl_takeaway_billmaster tbm  left join tbl_takeaway_billdetails tbd on tbd.tab_billno=tbm.tab_billno   where tbm.tab_qr_order_id!='' and  $stringta and tbm.tab_time between $newfromtime and $newtotime and tbd.tab_count_combo_ordering IS NULL group by tbm.tab_billno  "); 
       
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  { $j=0;
              while($result_login= $database->mysqlFetchArray($sql_login))
              {$j++;
              
              $tot_sum1=$tot_sum1+$result_login['final'];
              
                ?>   
                            <tr>
                                <td ><?=$j?></td>                                       
                                <td ><?=$result_login['billno']?></td>
				 <td ><?=$result_login['tab_qr_order_id']?></td>
                                <td ><?=number_format($result_login['final'],$_SESSION['be_decimal'])?></td>
                                
                            </tr>
    <?php 
    
	}
        
      ?>         
                            <tr>
                                <td ><strong>Total [HD] </strong></td>                                       
                               <td ></td>
				<td ></td>
                                <td ><strong><?=number_format($tot_sum1,$_SESSION['be_decimal'])?></strong></td>
                                
                            </tr>
  
         <?php } else {?>
          <tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
    <?php } 
    
   
   
   
   
                       
  $tot_sum=0;   
  $sql_login  =  $database->mysqlQuery("select tbm.bm_qr_orderno,tbm.bm_billno as billno, tbm.bm_finaltotal as final from tbl_tablebillmaster tbm  where tbm.bm_qr_orderno!=''  $stringdi and tbm.bm_billtime between $newfromtime and $newtotime  group by tbm.bm_billno  "); 
       
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
	  { $j=0;
              while($result_login= $database->mysqlFetchArray($sql_login))
              {$j++;
              
              $tot_sum=$tot_sum+$result_login['final'];
              
                ?>   
                            <tr>
                                <td ><?=$j?></td>                                       
                                <td ><?=$result_login['billno']?></td>
                                 <td ><?=$result_login['bm_qr_orderno']?></td>
				
                                <td ><?=number_format($result_login['final'],$_SESSION['be_decimal'])?></td>
                                
                            </tr>
   <?php                 
	  }
        
  ?>         
                            <tr>
                                <td ><strong>Total [DI]</strong></td>                                       
                               <td ></td>
				<td ></td>
                                <td ><strong><?=number_format($tot_sum,$_SESSION['be_decimal'])?></strong></td>
                                
                            </tr>
  
    <?php } else {?>
          <tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
    <?php } 
    
   
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
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
			<thead>
                            
                          <tr>
                                 <th colspan="8">Customer Bill Report - <?=$reporthead?></th>
                                  
                                  </tr>
				<tr>
                                    <th class="sortable">Sl</th>
                                    <th class="sortable">Customer</th>
                                      <th class="sortable">Phone</th>
                                     <th class="sortable">Address</th>
                                     <th class="sortable">Date</th>
                                    <th class="sortable">Bill No</th>
                                  
                                     <th class="sortable">Online Order No </th>
                                     <th class="sortable">Bill Amount </th>
                                 
                                    
                                   
                                    
				</tr>
			</thead>
		<tbody>
									
                                          <?php
 $dsc=0; $total=0; $final_partner=0; $i=0;
 $sql_login  =  $database->mysqlQuery("select tac_contactno,tab_netamt,tac_customername,tac_address,tab_dayclosedate,tab_billno,
 tab_qr_order_id from tbl_takeaway_billmaster tb left join tbl_takeaway_customer tc on tc.tac_customerid=tb.tab_hdcustomerid where tb.tab_qr_order_id!='' and  $string");
 $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $i++;                                      
			$final_partner=$final_partner + $result_login['tab_netamt'];    
	 ?>
    			       <tr>
                               <td><?=$i?></td>
                               <td><?=$result_login['tac_customername']?></td>
                               <td><?=$result_login['tac_contactno']?></td>
                               <td><?=$result_login['tac_address']?></td>
                               <td><?=$database->convert_date($result_login['tab_dayclosedate'])?></td>
                               <td><?=$result_login['tab_billno']?></td>
                             
                               <td><?=$result_login['tab_qr_order_id']?></td>
                                
                               <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
 
                             </tr> 
                              <?php } ?>
  <tr>
    <td style="color: darkred;font-weight: bold " >&nbsp; Bill Count [TA] : <?=$i?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>  
    <td >&nbsp;</td>
  </tr>
  
  <tr class="main">
   <td ><strong>TOTAL</strong></td>
   <td ></td>
   <td >&nbsp;</td>
   <td ></td>
   <td ></td>
   <td ></td>
   <td ></td>
  <td ><strong><?=number_format($final_partner,$_SESSION['be_decimal'])?></strong></td>
      
  </tr>
  
    <?php } else{  ?>
    <tr>
    <td style="color: red;font-weight: bold;">No Records to Display</td>
    </tr>
   <?php } ?>
  
<!--  ////////dine in ////-->
  
   <?php
 $final_partner1=0; $ic=0;
 $sql_login  =  $database->mysqlQuery("select bm_cnumber,bm_finaltotal,bm_cname,bm_dayclosedate,bm_billno,
 bm_qr_orderno from tbl_tablebillmaster tb  where tb.bm_qr_orderno!='' and  $stringdi");
 $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  $ic++;                                      
			$final_partner1=$final_partner1 + $result_login['bm_finaltotal'];    
	 ?>
    			               <tr>
                            <td><?=$ic?></td>
                              <td><?=$result_login['bm_cname']?></td>
                                <td><?=$result_login['bm_cnumber']?></td>
                                <td></td>
                             <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                               <td><?=$result_login['bm_billno']?></td>
                             
                                <td><?=$result_login['bm_qr_orderno']?></td>
                                
                                <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
 
                             </tr> 
                              <?php } ?>
   <tr>
    <td style="color: darkred;font-weight: bold " >&nbsp; Bill Count [DI] : <?=$ic?></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>  
    <td >&nbsp;</td>
  </tr>
  
  <tr class="main">
   <td ><strong>TOTAL</strong></td>
   <td ></td>
   <td >&nbsp;</td>
   <td ></td>
   <td ></td>
   <td ></td>
   <td ></td>
   <td ><strong><?=number_format($final_partner1,$_SESSION['be_decimal'])?></strong></td>
      
  </tr>
  
   <?php } else{  ?>
    <tr>
    <td style="color: red;font-weight: bold;">No Records to Display</td>
    </tr>
   <?php } ?>
  
  
    </tbody>
    </table>
                            
 <?php
          
 }
else if(($_REQUEST['type']=="summary_ta"))
{
	$strings="";
  $string="";
	$reporthead="";
	$strings.=" tab_status='closed' AND tab_mode = 'TA' AND ";
	$string1_str="(sum(tab_amountpaid) - sum(tab_amountbalace)) ";
	$string2_str=" sum(tab_transactionamount) ";
	$string3_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string4_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string5_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string6_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace)))";
	$string7_str=" sum(tab_netamt)";
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
		
	if($bydatz!="null" && $bydatz!="")
	{
	
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
	?>   
	<table class="table table-bordered table-font user_shadow" >
   								 
								  <thead>
                                  <tr>
                                 	<th colspan="2">Report - <?=$reporthead?></td>
                                  </tr>
									<tr>
                                 	<th >Type</th>
                                    <th >Value</th>
                                  </tr>
								  </thead>
								  <tbody>
<?php
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
			?>
          <tr >
          <td>Cash</td>
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php } }}

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
			?>
            <tr>
            <td>Card</td>
            <td><?=number_format($result_login1['tot'],$_SESSION['be_decimal'])?></td>
            </tr>
      
			
		<?php	}
                   
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
                              ?>
                              <tr>
            <td>*<?=$result_logincreditta['bnk']?></td>
            <td><?=number_format($result_logincreditta['tot'],$_SESSION['be_decimal'])?></td>
            </tr>
            <?php
                          }
                          }
          
          
	  $sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3"." $string order by tab_dayclosedate,tab_time ASC"); 
			
	  $num_login   = $database->mysqlNumRows($sql_login);

	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				
			if($result_login['tot'] != "")	{
				
				$subtotal =$subtotal + $result_login['tot'];
				 ?>
          <tr >
          <td>Coupons</td>
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php
			}} }
			
			$sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4"." $string order by tab_dayclosedate,tab_time ASC"); 
			
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
				if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
			?>
          <tr >
          <td>Voucher</td>
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php } }}
			
			$sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string5"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
			?>
          <tr >
          <td>Cheque</td>
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php } }}
			
			
				
			$sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string6"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
			?>
          <tr >
          <td>Credits</td>
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php } }}
	
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot 
                        from tbl_takeaway_billmaster tb
                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
                        where $string7"." $string order by tab_dayclosedate,tab_time ASC"); 
//                        echo "select $string7_str as tot 
//                        from tbl_takeaway_billmaster tb
//                        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
//                        where $string7"." $strings order by tab_dayclosedate,tab_time ASC";
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['tot'] != "")
			{
//			$subtotal1 =$subtotal1 + $result_login['tot'];
			?>
          <tr >
          <td>Complimentary</td>
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php } }}
		
			
			 ?>
                              
   <?php 		if($subtotal != ""){ ?>                           
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ><strong><?= number_format($subtotal,$_SESSION['be_decimal']) ?></strong></td>
  </tr>
          <?php } 
          else{ ?>
           <tr><td colspan="2" style="color:red;font-weight: bold;"></td></tr> 
        <?php  }   ?>                 
                             
                           </tbody>
                            </table>
                            
                            <?php
}
else if(($_REQUEST['type']=="cancel_history_ta"))
{
	$string="";
	$reporthead="";
	$st="";
        $string .= " tb.tab_status='Cancelled' AND tb.tab_mode = 'TA' AND ";
        $loginstaffsel = '';
        if(isset($_REQUEST['loginstaffsel'])){
            
         if($_REQUEST['loginstaffsel']!='null')
	{   $loginstaffsel = $_REQUEST['loginstaffsel'];
		$string.="tb.tab_cancelledlogin='".$loginstaffsel."' AND ";
		
	}
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

			if($bydatz!="null" && $bydatz!="")
	{

	if($bydatz=="Last5days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tb.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
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
		$string.="  tb.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
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
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                        	<th colspan="10">Report - <?=$reporthead?></td>          
                                  </tr>
				<tr>
                                    <th class="sortable">Slno</th>
                                     <th class="sortable">Date</th>
					<th class="sortable">Time</th>				  
                                     <th class="sortable">Bill NO</th>
                                      
                                     
                                     <th class="sortable">Qty</th>
                                     
                                     <th class="sortable">Bill Cancel Date&Time</th>
                                       <th class="sortable">Cancelled By</th>
                                         <th class="sortable">Cancelled login</th>
                                     <th class="sortable">Reason for cancellation</th>
                                     <th class="sortable">Amount</th>
									</tr>
								  </thead>
								  <tbody>
									
                                          <?php

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
 
  $sql_login  =  $database->mysqlQuery("Select sum( bd.tab_qty) as qty,tb.tab_date, tb.tab_billno, tb.tab_kotno, tb.tab_time, tb.tab_netamt, tb.tab_cancelledtime, tb.tab_loginid, tb.tab_cancelledlogin,  tb.tab_cancelledreason, sm.ser_firstname
    From tbl_takeaway_billmaster as tb 
    left join tbl_takeaway_billdetails bd on bd.tab_billno = tb.tab_billno 
    left join tbl_staffmaster sm on sm.ser_staffid = tb.tab_cancelledby_careof
    where $string group by tb.tab_billno"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ $i=1;$cancelledreason='';
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
				
	 ?>

    						<tr >
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['tab_date'])?></td>
                           <td><?=$result_login['tab_time']?></td>
                              <td><?=$result_login['tab_billno']?></td>
        
                              <td><?=$result_login['qty']?></td>
                                
                              <td><?=$result_login['tab_cancelledtime']?></td>
                                 <td><?=$result_login['ser_firstname']?></td>
                                     <td><?=$result_login['tab_cancelledlogin']?></td>
                              <td><?=$cancelledreason?></td>
                              <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                               
                              
                              </tr> 
                             
                              
                              
                              
                              
                              <?php 
                              $qty = $qty + $result_login['qty'];
                              $total = $total + $result_login['tab_netamt'];
                              $i++;} ?>
                              
                              
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    
  </tr>
  <tr>
    <td >&nbsp;</td>
    <td ><strong>Total</strong></td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td ><strong><?= $qty ?></strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td ><strong><?= number_format($total,$_SESSION['be_decimal'])?></strong></td>
    
  </tr>
 <?php } else { ?>
<tr><td colspan="10" style="color:red;font-weight: bold;">No Records to Display</td></tr>
 <?php } ?>
                              
                             
                           </tbody>
                            </table>
                            
                            <?php
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
	
	
	
	?>
		
		<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                        	<th colspan="10">Report - <?=$reporthead?></td>          
                                  </tr>
					<thead>
									<tr>
                                    <th class="sortable">Category</th>
                                    <th class="sortable">Sub Category</th>
                                     <th class="sortable">Item</th>
                                      <th class="sortable">Portion</th>
                                        <th class="sortable">Qty</th>
                                        <th class="sortable">Unit Price</th>
                                        <th class="sortable">Total</th>
									</tr>
								  </thead>
								  <tbody>
       <?php
       
       
       
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
                      
				?>
                <tr>
                 
                    <td colspan="1" style="text-align:center"><strong><?=$catname?></strong></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['msy_subcategoryname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['mr_menuname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['pm_portionname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['qty']?></td>
                  <td colspan="1" style="text-align:center"><?=number_format($result_item['tab_rate'],$_SESSION['be_decimal'])?></td>
                  <td colspan="1" style="text-align:center"><?=number_format($result_item['Total'],$_SESSION['be_decimal'])?></td>
                </tr>
                <?php
			}
	 
	  ?>
                <tr>
                 
                    <td colspan="1" style="text-align:center"><strong></strong></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                </tr>
                <tr>
                 
                    <td colspan="1" style="text-align:center"><strong>Total [TA]</strong></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"><strong><?=number_format($final,$_SESSION['be_decimal']);?></strong></td>
                </tr>
                
              <?php } else { ?>  
                <tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
                <?php } 
                
                
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
                      
				?>
                <tr>
                 
                    <td colspan="1" style="text-align:center"><strong><?=$catname?></strong></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['msy_subcategoryname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['mr_menuname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['pm_portionname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['qty']?></td>
                  <td colspan="1" style="text-align:center"><?=number_format($result_item['bd_rate'],$_SESSION['be_decimal'])?></td>
                  <td colspan="1" style="text-align:center"><?=number_format($result_item['Total'],$_SESSION['be_decimal'])?></td>
                </tr>
                <?php
			}
	 
	  ?>
                <tr>
                 
                    <td colspan="1" style="text-align:center"><strong></strong></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                </tr>
                <tr>
                 
                    <td colspan="1" style="text-align:center"><strong>Total [DI]</strong></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"><strong><?=number_format($final1,$_SESSION['be_decimal']);?></strong></td>
                </tr>
                
                <?php } else { ?>  
                <tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
                <?php } ?>     
                
      </tbody>
      </table>
      <?php
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
	?>
		
		<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                        	<th colspan="10">Report - <?=$reporthead?></td>          
                                  </tr>
					<thead>
									<tr>
                                    <th class="sortable">Category</th>
                                    <th class="sortable">Sub Category</th>
                                     <th class="sortable">Item</th>
                                      <th class="sortable">Portion</th>
                                        <th class="sortable">Qty</th>
                                        <th class="sortable">Unit Price</th>
                                        <th class="sortable">Total</th>
									</tr>
								  </thead>
								  <tbody>
       <?php
       
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
                      
				?>
                <tr>
                 
                    <td colspan="1" style="text-align:center"><strong><?=$catname?></strong></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['msy_subcategoryname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['mr_menuname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['pm_portionname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['qty']?></td>
                  <td colspan="1" style="text-align:center"><?=number_format($result_item['tab_rate'],$_SESSION['be_decimal'])?></td>
                  <td colspan="1" style="text-align:center"><?=number_format($result_item['Total'],$_SESSION['be_decimal'])?></td>
                </tr>
                <?php
			}
	 
	  ?>
                <tr>
                 
                    <td colspan="1" style="text-align:center"><strong></strong></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                </tr>
                <tr>
                 
                    <td colspan="1" style="text-align:center"><strong>Total</strong></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"><strong><?=number_format($final,$_SESSION['be_decimal']);?></strong></td>
                </tr>
                
           <?php  }  else {?> 
              <tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>  
           <?php } ?>     
      </tbody>
      </table>
      <?php
}
else if(($_REQUEST['type']=="order_ta"))
{
	      $string="";
        $string.="tbm.tab_status='Closed' AND tbm.tab_mode='TA' AND ";
        $reporthead="";
        $st='';
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
                
	else if($_REQUEST['bydate'])
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
  else
	{
		$cur=date("Y-m-d");
		$string.=" tab_dayclosedate='".$cur."'";
		$reporthead="On ".$database->convert_date($cur);	
	}?>
		
		<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                        	<th colspan="10">Report - <?=$reporthead?></td>          
                                  </tr>
					<thead>
									<tr>
                    <th class="sortable">Category</th>
                    <th class="sortable">Sub Category</th>
                    <th class="sortable">Item</th>
                    <th class="sortable">Portion</th>
                    <th class="sortable">Qty</th>
                    <th class="sortable">Unit Price</th>
                    <th class="sortable">Total</th>
									</tr>
							</thead>
					<tbody>
       <?php
       
       $final=0;
 	$sql_item  =  $database->mysqlQuery("SELECT tbm.tab_billno, tbd.tab_menuid, mmc.mmy_maincategoryname, msc.msy_subcategoryname , mm.mr_menuname, sum(tbd.tab_qty)as qty, pm.pm_portionname, tbd.tab_rate, tbd.tab_amount, sum(tab_qty * tab_rate) as Total
        from tbl_takeaway_billmaster tbm
        left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno
        left join tbl_menumaster mm on tbd.tab_menuid = mm.mr_menuid
        left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid = mm.mr_maincatid
        left join tbl_menusubcategory msc on mm.mr_subcatid = msc.msy_subcategoryid
        left join tbl_portionmaster pm on pm.pm_id = tbd.tab_portion
        where $string  $stringta_addon 
        group by tbd.tab_menuid 
        ORDER BY mmc.mmy_maincategoryname ASC"); 
     
        $old="";
        $catname ="";
	  $num_item   = $database->mysqlNumRows($sql_item);
	  if($num_item){ $i=1;
		  while($result_item  = $database->mysqlFetchArray($sql_item)) 
			{
                      $final=$final+$result_item['Total'];
                                           
                      if($result_item['mmy_maincategoryname']==$old){
                          $catname ="";
                          
                      }else{
                          $catname = $result_item['mmy_maincategoryname'];
                          $old = $result_item['mmy_maincategoryname'];
                      }
                      
				?>
                <tr>
                 
                  <td colspan="1" style="text-align:center"><strong><?=$catname?></strong></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['msy_subcategoryname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['mr_menuname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['pm_portionname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['qty']?></td>
                  <td colspan="1" style="text-align:center"><?=number_format($result_item['tab_rate'],$_SESSION['be_decimal'])?></td>
                  <td colspan="1" style="text-align:center"><?=number_format($result_item['Total'],$_SESSION['be_decimal'])?></td>
                </tr>
                <?php
			}
	  ?>
                <tr>                
                    <td colspan="1" style="text-align:center"><strong>Total</strong></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"></td>
                  <td colspan="1" style="text-align:center"><strong><?=number_format($final,$_SESSION['be_decimal']);?></strong></td>
                </tr>
          <?php } else { ?> 
            <tr><td colspan="7" style="color:red;font-weight: bold;">No Records to Display</td></tr>
            <?php } ?>                     
      </tbody>
      </table>
      <?php
}
 
else if(($_REQUEST['type']=="categorywise_report_ta"))
{

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
	elseif($_REQUEST['bydate'])
	{
            $reporthead="";
	$st="";
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
  else
	{
		$cur=date("Y-m-d");
		$string.=" tab_dayclosedate='".$cur."'";
	$reporthead=" On ".$database->convert_date($cur);	
	}
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
				<thead>
          <tr>
            <th colspan="5">Category Wise Report -<?=$reporthead;?></th>
           </tr>                                
				   <tr>
            <th class="sortable">Slno</th>
            <th class="sortable">Main Category Name</th>
            <th class="sortable">No of Items</th>
            <th class="sortable">Qty</th>	
            <th class="sortable">Total</th>                             
				</tr>
				</thead>
				<tbody>
									
            <?php
            $total=0;
            $final=0;
           
    $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,count(distinct(tbd.tab_menuid)) as 'no of items',sum(tbd.tab_qty) as qty ,sum(tbd.tab_qty* tbd.tab_rate) as Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster on mr_menuid =tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC ");
    $num_login   = $database->mysqlNumRows($sql_login);
      if($num_login){ $i=1;$t=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ $t++;
                        $total=$total+$result_login['Total'];
                        ?>                       
                             <tr>
                                <td><?=$i?></td>
                                <td><?=$result_login['mmy_maincategoryname'];?></td>
                                <td><?=$result_login['no of items'];?></td>
                                <td><?=$result_login['qty'];?></td>
                                <td><?=number_format($result_login['Total'],$_SESSION['be_decimal']);?></td>                                 
                              </tr> 
             <?php $i++;} ?>
                                                     
                              <tr>
	 <td colspan="1" style="text-align:center"><strong>Total</strong>
         </td>
           <td></td>
           <td></td>
           <td></td>
           <td><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
           
	  </tr> <?php } else { ?>
      <tr><td colspan="5" style="color:red;font-weight: bold;">No Records to Display</td></tr>
      <?php } ?>
                           
                           </tbody>
                            </table>
                            <?php
          
 }

else if($_REQUEST['type']=="billreport_ta")
{
    $string="";
	$string=" tbm.tab_status='Closed' AND tbm.tab_mode='TA'";
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
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	$st="Last5days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	$st="Last10days";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	elseif($bydatz=="Last15days")
	{
		$string.="  and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
 $st="Last15days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" and  tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last20days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last25days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
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
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  
                                 
                                  <tr>
                                  	<th colspan="8">Report-<?=$reporthead;?></th>
                                  
                                  </tr>
                                  
									<tr>
                                    <th class="sortable">Slno</th>
					<th class="sortable">Date</th>
					<th class="sortable">Bill No</th>
                                      <th class="sortable">Items</th>
                                     <th class="sortable">Portion</th>
                                     <th class="sortable">Quantity</th>
                                    
                                     <th class="sortable">Rate</th>
                                     <th class="sortable">Discount</th>
									</tr>
								  </thead>
								  <tbody>
									
                                          <?php
 $final=0; 
  $dsc=0;
 $dscfinal=0;
$sql_login  =  $database->mysqlQuery("select tbm.tab_netamt,tbm.tab_discountvalue,tbm.tab_billno,tbm.tab_dayclosedate,mm.mr_menuname,tbd.tab_qty,tbd.tab_rate,p.pm_portionname from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid left join tbl_portionmaster p on p.pm_id=tbd.tab_portion where $string $sort_string1 "); 
$old='';$new='';	 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;$dsc=0;
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
	 ?>

    						<tr >
                            <td><?=$i?></td>
                             
                               <td><?=$database->convert_date($result_login['tab_dayclosedate']);?></td>
				<td><?=$result_login['tab_billno'];?></td>
                               
                               <td><?=$result_login['mr_menuname'];?></td>
                               
                                <td><?=$result_login['pm_portionname'];?></td>
				<td><?=$result_login['tab_qty'];?></td>
		               <td><?=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal'])?></td>
                             <td></td>
                              </tr> 
                             
                              <?php
				  
				}else
				{
					$old=$new;
					$new=$result_login['tab_billno'];
					
					if($new==$old)
					{
                                            $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
					
						?>
                      <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?></td>
                   <td><?=$result_login['tab_qty']?></td>
                   <td><?=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal'])?></td>
                   <td></td>
                  </tr> 
                      <?php
					}else
					{
						
						?>
                         <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                    <td></td>
                   <td ><b>Total</b></td>
                   <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                   <td><b><?=number_format($dsc,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  <?php $each=0;$dsc=0;
				  $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);
				  $dsc=$dsc + ($result_login['tab_discountvalue']);
				  $dscfinal=$dscfinal+($result_login['tab_discountvalue']);
				   ?>
                      <tr>
                   <td><?=$k++?></td>
                   <td><?=$database->convert_date($result_login['tab_dayclosedate'])?></td>
                   <td><?=$result_login['tab_billno']?></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?></td>
                   <td><?=$result_login['tab_qty']?></td>
                   <td><?=number_format(($result_login['tab_rate'] * $result_login['tab_qty']),$_SESSION['be_decimal'])?></td>
                   <td></td>
                  </tr> 
                  <?php
			}
				}
				$i++;
	       ?>

               
     <?php 
	 } ?>
     
      <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                    <td></td>
                   <td ><b>Total</b></td>
                    <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                   <td><b><?=number_format($dsc,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                 
                              
                              
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ></td>
    <td ></td>
    <td ><strong>TOTAL</strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($dscfinal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
  
   <tr class="main">
    <td ></td>
    <td ></td>
    <td ><strong>GRAND TOTAL</strong></td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td colspan="2"><strong><?=number_format(($final-$dscfinal),$_SESSION['be_decimal'])?> /-</strong></td>
     
  </tr>
  <?php }  else { ?>
    <tr><td colspan="8" style="color:red;font-weight: bold;">No Records to Display</td></tr>
    <?php }?>
                      
                             
                           </tbody>
                            </table>
                            
                            <?php
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
	
	
	?>
		
		<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                        	<th colspan="10">Report - <?=$reporthead?></td>          
                                  </tr>
				  <thead>
									<tr>
                                                                             <th class="sortable">Sl</th>
                                    <th class="sortable">Name</th>
                                    <th class="sortable">Number </th>
                                     <th class="sortable">Address</th>
                                      <th class="sortable">Landmark</th>
                                        <th class="sortable">Area</th>
                                       
                                        <th class="sortable">Permanent Address</th>
                                        <th class="sortable">GST</th>
                                        
					</tr>
					</thead>
					<tbody>
       <?php
       
       $final=0;
 	$sql_item  =  $database->mysqlQuery("SELECT tac_customername,tac_contactno,tac_address,tac_landmark,
  tac_area,tac_per_address,tac_gst from tbl_takeaway_customer where $string ");  
        
	  $num_item   = $database->mysqlNumRows($sql_item);
	  if($num_item){$i=0;
		  while($result_item  = $database->mysqlFetchArray($sql_item)) 
			{
         $i++                    
				?>
                <tr>
                  <td colspan="1" style="text-align:center"><?=$i?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['tac_customername']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['tac_contactno']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['tac_address']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['tac_landmark']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['tac_area']?></td>                
                  <td colspan="1" style="text-align:center"><?=$result_item['tac_per_address']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_item['tac_gst']?></td>                
                </tr>
                <?php
			}
	  }
    else{?>
    <tr><td colspan="8" style="color:red;font-weight: bold;">No Records to Display</td></tr>
<?php 
    }
	  ?>       
      </tbody>
      </table>
      <?php
}
?>