

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
//include('includes/session.php');		// Check session
session_start();
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
 
 if(($_REQUEST['type']=="totalsales_cs"))
{
		
	$string="";
	$string.=" tab_status='Closed' AND tab_mode= 'CS' and tab_complimentary!='Y' ";
        
    if($_REQUEST['log_user']!="null")
         $string.=" AND tab_loginid = '".$_REQUEST['log_user']."'";

	$reporthead="";
	$st="";
        $finalsubtotal=0;
        $finaltotal=0;
        $paidtotal=0;
        $baltotal=0;
	
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and tab_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and tab_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and tab_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
	else 
	{
		$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!="")
	{

	if($bydatz=="Last5days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.="and  tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" and tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  and tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}

$reporthead=$st;
	}
else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  and tab_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	} } ?>
      <table class="table table-bordered table-font user_shadow" >
				<thead>
                     <?php 
                         $tax_name=array();
                            $tax_id=array();
                                  $sql_login  =  $database->mysqlQuery(" select  distinct(tketm.tbe_taxid) as taxid,tketm.tbe_label as taxname  FROM tbl_takeaway_bill_extra_tax_master tketm left join  tbl_extra_tax_master tm on tm.amc_id=tketm.tbe_taxid group by  amc_id order by tm.amc_id asc "); 
                                     $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){                                     
                                       $tax_name[]=$result_login['taxname'];
                                       $tax_id[]=$result_login['taxid'];
                                     }}  ?>
                                  <tr>
                                  	<th colspan="<?=9+count(array_unique($tax_id))?>">Report- <?=$reporthead;?></th>                                 
                                  </tr>                                
				<tr>
               <th class="sortable">Slno</th>
				<th class="sortable">Bill No</th>                                                                      
				<th class="sortable">Date</th>
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
 $tax_value=array();
$sql_login  =  $database->mysqlQuery("select tab_amountbalace,tab_amountpaid,tab_netamt,tab_discountvalue,tab_billno,
tab_dayclosedate,tab_loginid,tab_subtotal from tbl_takeaway_billmaster where $string order by tab_billno ASC ");
$num_login   = $database->mysqlNumRows($sql_login);
		if($num_login){ $t=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  ?>
    						<tr >
                            <td><?=$t?></td>
                             <td><?=$result_login['tab_billno'];?></td>                           
                               <td><?=$database->convert_date($result_login['tab_dayclosedate']);?></td>                           
                               <td><?=$result_login['tab_loginid'];?></td>
                               <?php
                               if($result_login['tab_subtotal']!=""){
                                   $finalsubtotal=$finalsubtotal + $result_login['tab_subtotal'];
                                    ?>                            
                               <td><?=number_format($result_login['tab_subtotal'],$_SESSION['be_decimal'])?></td>
                               <?php 
                                }                              
                                for($s=0;$s<count(array_unique($tax_id));$s++){
                                $sql_taxvalue  =  $database->mysqlQuery("select  tketm.tbe_total_value,tketm.tbe_taxid, tketm.tbe_label FROM tbl_takeaway_bill_extra_tax_master tketm  where tketm.tbe_billno='".$result_login['tab_billno']."' and tketm.tbe_taxid ='".$tax_id[$s]."' order by tketm.tbe_taxid asc"); 
                                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);                               
                                if($num_taxvalue){$i=0;
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
                               	
                               <?php
                               if($result_login['tab_netamt'] != "")	{
				
				$finaltotal =$finaltotal + $result_login['tab_netamt']; ?>
                              <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                               <?php } ?>
                              <?php
                               if($result_login['tab_amountpaid'] != "")	{
				
				$paidtotal =$paidtotal + $result_login['tab_amountpaid'];
				 ?>
                              <td><?=number_format($result_login['tab_amountpaid'],$_SESSION['be_decimal'])?></td>
                               <?php
			}?>
                              <?php
                               if($result_login['tab_amountbalace'] != "")	{
				
				$baltotal =$baltotal + $result_login['tab_amountbalace']; ?>
                              <td><?=number_format($result_login['tab_amountbalace'],$_SESSION['be_decimal'])?></td>
                               <?php } ?>
                              </tr> 
                              <?php $t++;}  ?>                                     

  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td></td>
    <td ></td>
    <td >&nbsp;</td>
    <td ><strong><?=number_format($finalsubtotal,$_SESSION['be_decimal'])?></strong></td>
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
    <td ></td>
    <td ><strong><?=number_format($finaltotal,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($paidtotal,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($baltotal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
          <?php } else {?>  
			<tr><td colspan="9" style="color:red;font-weight: bold;">No Records to Display</td></tr>
		<?php } ?>               </tbody>
                            </table>                           
                            <?php
}	
/********************Summary cs start ************************************/
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
	$string6_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
	$string7_str=" sum(tab_netamt)";
	$string_pax="";
	$string_pax=" tab_status='Closed' AND ";
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";		
	$string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
	$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
	$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
	$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
	$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	
	if(isset($_REQUEST['set']))
	{		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "(tab_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "( tab_dayclosedate  between '".$from."' and '".$to."' ) "; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (tab_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	else if(isset($_REQUEST['abc']))
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
	else
	{
		$cur=date("Y-m-d");
		$string.=" tab_dayclosedate='".$cur."'";
		$string_pax.= " tab_dayclosedate  between '".$cur."' and '".$cur."'";
		$reporthead="On ".$database->convert_date($cur);	
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
            $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string1"."$string order by tab_dayclosedate,tab_time ASC"); 
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

$sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot from tbl_takeaway_billmaster "
        . " tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.tab_transcbank and"
        . " tb.tab_status='Closed' AND $string2 "."$string  order by tb.tab_dayclosedate,tb.tab_time ASC "); 
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
      
			
          <?php	} }
          
          
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
				
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string7"." $string order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['tot'] != "")
			{
			$subtotal1 =$subtotal1 + $result_login['tot'];
			?>
          <tr >
          <td>Complimentary</td>
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php } }}
if($subtotal>0)	{ ?>  
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
  <?php }  
  if($subtotal<=0 && $subtotal1<=0)
  { ?>
 <tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
 <?php }
?>
                             
                           </tbody>
                            </table>
                            
                            <?php
}
/********************Summary cs end ************************************/

/*****************Summary details cs start**************************/

else if(($_REQUEST['type']=="total_summary_details_cs"))
{
	$string="";
	$reporthead="";
	$strings=" tab_status='Closed' AND tab_mode='CS' AND";
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
	
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	else if(isset($_REQUEST['abc']))
	{
		$bydatz=$_REQUEST['bydate'];
		$st='';
if($bydatz!="null")
	{
	if($bydatz=="Last5days")
	{
          
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
	}elseif($bydatz=="Last10days")
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
	else
	{
		$cur=date("Y-m-d");
		$string.=" tab_dayclosedate='".$cur."'";
		$reporthead="On ".$database->convert_date($cur);	
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
                                 	<th colspan="11">Report - <?=$reporthead?></td>
                                  </tr>
                                         <tr>
                                         <th >SlNo</th>
                                         <th >Date</th>
                                         <th >Cash</th>
                                         <th >Credit/Debit</th>
                                         <th >Coupons</th>
                                         <th >Voucher</th>
                                        <th >Cheque</th>
                                        <th >Credits</th>
                                        <th >Complimentary</th>
                                        <th >Total</th>
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
  $totalcash=0;
  $totalcoupons=0;
  $totalvoucher=0;
  $totalcheque=0;
  $totalcredits=0;
  $totalcomplimentary=0;
  $totalcreditordebit=0;
  $slno=0;
$sql = $database->mysqlQuery("select distinct(tab_dayclosedate) from tbl_takeaway_billmaster where $string");
 $num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
    $total=0;
          $slno++;
        if($result != ""){
            echo "<tr><td>".$slno."</td><td>".$result['tab_dayclosedate']."</td>";
            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
        }
  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string1"."$dt order by tab_dayclosedate,tab_time ASC"); 
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
          }}else{
              echo "<td>--</td>";
          }
$sql_login1  =  $database->mysqlQuery("select $string2_str as tot from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.tab_transcbank and tb.tab_status='Closed' AND $string2 "."$dt order by tb.tab_dayclosedate,tb.tab_time ASC "); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
if($num_login1){
		  $result_login1  = $database->mysqlFetchArray($sql_login1); 
                  if($result_login['tot'] != "")	{
                      
                        $totalcreditordebit=$totalcreditordebit + $result_login1['tot'];  
			$total= $total + $result_login1['tot'];       
			$subtotal =$subtotal + $result_login1['tot']; ?>           
            <td><?=number_format($totalcreditordebit,$_SESSION['be_decimal'])?></td>	
		<?php	
          }else{
              echo "<td>--</td>";
          }}
          else{
              echo "<td>--</td>";
          }
			$sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string3"." $dt order by tab_dayclosedate,tab_time ASC"); 
	$num_login   = $database->mysqlNumRows($sql_login);
     if($num_login){
		  $result_login2  = $database->mysqlFetchArray($sql_login);
			if($result_login2['tot'] != "")	{
				$totalcoupons= $totalcoupons + $result_login2['tot'];
                                $total= $total + $result_login2['tot'];       
                                $subtotal =$subtotal + $result_login2['tot'];	                               
				 ?>
         <td><?=number_format($result_login2['tot'],$_SESSION['be_decimal'])?></td>
        <?php
			}
                         else{
              echo "<td>--</td>";
          }
                         }else{
              echo "<td>--</td>";
          }
     $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string4"." $dt order by tab_dayclosedate,tab_time ASC"); 
	$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login3  = $database->mysqlFetchArray($sql_login); 			 
				if($result_login3['tot'] != "")
			{
			$totalvoucher=$totalvoucher + $result_login3['tot'];
                        $total= $total + $result_login3['tot'];       
                        $subtotal =$subtotal + $result_login3['tot']; ?>
         <td><?=number_format($result_login3['tot'],$_SESSION['be_decimal'])?></td>
       <?php }
            else{
              echo "<td>--</td>";
          } }
            else{
              echo "<td>--</td>";
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
			?>
          <td><?=number_format($result_login4['tot'],$_SESSION['be_decimal'])?></td>
            <?php } 
            else{
              echo "<td>--</td>";
          }
               }
            else{
              echo "<td>--</td>";
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
			?>
          <td><?=number_format($result_login5['tot'],$_SESSION['be_decimal'])?></td>
            <?php }
            else{
              echo "<td>--</td>";
          }  }
            else{
              echo "<td>--</td>";
          }				
          $sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_takeaway_billmaster left join tbl_paymentmode on tbl_takeaway_billmaster.tab_paymode=tbl_paymentmode.pym_id where $string7"." $dt order by tab_dayclosedate,tab_time ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  $result_login6  = $database->mysqlFetchArray($sql_login); 
			 
			if($result_login6['tot'] != "")
			{
                        $totalcomplimentary= $totalcomplimentary + $result_login6['tot'];    
			?>
          
          <td><?=number_format($result_login6['tot'],$_SESSION['be_decimal'])?></td>     
                         <?php } 
                         else{
              echo "<td>--</td>";
          }
                        }
            else{
              echo "<td>--</td>";
          } ?>

    <td ><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
  </tr>
<?php
  }
  }
  ?>
  <tr><td colspan="11"></td></tr>
  <tr> <td><strong>TOTAL</strong></td>
  <td><strong><?=$reporthead?></strong></td>
  <td colspan=""><strong><?=number_format($totalcash,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcreditordebit,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcoupons,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalvoucher,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcheque,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcredits,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($totalcomplimentary,$_SESSION['be_decimal'])?></strong></td>
  <td colspan=""><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td></tr>
  </tbody>
   </table>
<?php
}

/********************Summary details cs End***********************/

else if(($_REQUEST['type']=="billcancel_cs"))
{
	$string="";
	$string.="tbm.tab_mode='CS' and tbm.tab_status='Cancelled'  ";
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
	  if($bydatz!="null" && $bydatz!="")
            {
	if($bydatz=="Last5days")
            {
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
		$st="Last 5 days";

	}elseif($bydatz=="Last10days")
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
	} }?>
    
    
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                                  <th colspan="10">Report- <?=$reporthead;?></th>                                  
                                  </tr>    
										<tr>
                                        <th class="sortable">Slno</th>
                                        <th class="sortable">Date</th>
                                        <th class="sortable">Bill No</th>
                                        <th class="sortable" width="115px">Bill Generated Time</th>
                                        <th class="sortable" width="110px">Bill Cancelled Date&Time</th>
                                        <th class="sortable">Reason</th>
                                        <th class="sortable">Final</th>
                                        <th class="sortable" >Paid</th>
                                        <th class="sortable">Cancelled By</th>                                   
                                      <th class="sortable">Cancelled Login</th>                             
                                        </tr>
									</thead>
					 				<tbody>								
                                          <?php
  $final=0;
  $paid=0;
  $bal=0; 
$sql_login  =  $database->mysqlQuery("select tbm.tab_billno,tbm.tab_dayclosedate,tbm.tab_time,tbm.tab_cancelledtime,tbm.tab_paymode,tbm.tab_cancelledreason,tbm.tab_cancelledlogin,tbm.tab_netamt,ld.ls_staffid,sm.ser_firstname,sm.ser_lastname 
from tbl_takeaway_billmaster tbm left join tbl_staffmaster sm on sm.ser_staffid=tbm.tab_cancelledby_careof left join
 tbl_logindetails ld on ld.ls_username=tbm.tab_cancelledlogin where $string order by tbm.tab_billno ASC");

            $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){ 
			$i=1;$cancelledreason='';
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
				$final=$final + $result_login['tab_netamt']; ?>

    						<tr >
                            <td><?=$i?></td>
                             <td><?=$result_login['tab_dayclosedate'];?></td>
                             <td><?=$result_login['tab_billno'];?></td>
                             <td><?=$result_login['tab_time']?></td>
                               <td><?=$result_login['tab_cancelledtime']?></td>
                                <td><?=$cancelledreason ?></td>
                               <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                               <td ><?=$paid?></td>
                              <td><?=$result_login['ser_firstname'].' '.$result_login['ser_lastname']?></td>
                              <td><?=$result_login['tab_cancelledlogin']?></td>                          
                              </tr> 
                              <?php $i++;}  ?>                  

  <tr class="main">
	<td ><strong>TOTAL</strong></td>
   <td></td>
    <td ></td>
    <td ></td>
    <td ></td>
    <td ></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
   <td></td>
    <td></td>
    <td></td>
  </tr>
  <?php } else { ?>
<tr><td colspan='10' style="color:red;font-weight: bold;">No Records to Display</td></tr>
	<?php } ?>
                           </tbody>
                            </table>                           
<?php
}
 if($_REQUEST['type']=="cancelhistory_cs")
{			
	$string="";
	$string.="tbm.tab_mode='CS'   ";
	$reporthead="";
	$st="";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ci.tc_dayclosedate between '".$from."' and '".$to."' ";
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
			$string.= "  and ci.tc_dayclosedate between '".$from."' and '".$to."' ";		
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
	else 
	{
		$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!="")
	{
	if($bydatz=="Last5days")
	{
		$string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
		$st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.=" and ci.tc_dayclosedate between  CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" and ci.tc_dayclosedate between  CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
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
		$string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" and ci.tc_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($bydatz=="Yesterday")
			  {
				  $string.=" and ci.tc_dayclosedate = CURDATE() - INTERVAL 1 day";
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
	}?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                                  	<th colspan="8">Report- <?=$reporthead;?></th>
                                  </tr>                              
				<tr>
                                    <th class="sortable">Slno</th>
				   <th class="sortable">Bill No</th>
				<th class="sortable">Date</th>
                                      <th class="sortable">Kot No</th>
                                      <th class="sortable">Menu</th>                                   
                                      <th class="sortable">Cancelled C/O</th>                                   
                                      <th class="sortable">Cancelled By</th>
					<th class="sortable">Reason</th>                                   
				</tr>
				</thead>
				 <tbody>
				<?php
$sql_login  =  $database->mysqlQuery("select tc_cancelled_login,tc_reason,tc_cancel_kotno,tc_dayclosedate,sm.ser_firstname, mm.mr_menuname,tbm.tab_billno  FROM tbl_takeaway_cancel_items ci
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
                        } ?>
                            <tr >
                            <td><?=$i?></td>
			    <td><?=$result_login['tab_billno'];?></td>
                            <td><?=$database->convert_date($result_login['tc_dayclosedate']);?></td>
                            <td><?=$result_login['tc_cancel_kotno'];?></td>
			     <td><?=$result_login['mr_menuname'];?></td>
                            <td><?=$result_login['ser_firstname'];?></td>
                            <td><?=$result_login['tc_cancelled_login'];?></td>
                            <td><?=$cancelledreason?></td>                            
                            </tr> 
                            <?php $i++;} } else {?>
								<tr><td colspan="8" style="color:red;font-weight: bold;">No Records to Display</td></tr>
								<?php } ?>
                            </tbody>
                            </table>
<?php
}
 if(($_REQUEST['type']=="discountreport_cs"))
{
	$string="";
	$string.=" tab_status='Closed' AND tab_mode= 'CS' AND tab_discountvalue<>'0.00' ";
	$reporthead="";
	if(isset($_REQUEST['set']))
				{				
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
					}
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
					
				}
			else if(isset($_REQUEST['abc']))
	{
		$bydatz=$_REQUEST['bydate'];
			if($bydatz!="null")
			{
	if($bydatz=="Last5days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	$st="Last5days";
	}elseif($bydatz=="Last10days")
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
		$string.=" and  tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
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
	else{
			$cur=date("Y-m-d");
				$string.=" and tab_dayclosedate='".$cur."'";		
			$reporthead="On ".$database->convert_date($cur);
				
	} ?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                   <tr>
                                  	<th colspan="8">Report-<?=$reporthead;?></th>                                 
                                  </tr>                                
                                    <tr>
                                    <th class="sortable">Slno</th>
					<th class="sortable">Date</th>
					<th class="sortable">Bill No</th>
                                      <th class="sortable">Sub Total</th>
                                    
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
  $disc=0;
$sql_login  =  $database->mysqlQuery("select tab_netamt,tab_amountpaid,tab_amountbalace,tab_discountvalue,tab_dayclosedate,
tab_billno,tab_subtotal from tbl_takeaway_billmaster where $string  ");
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                        $final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$bal=$bal + $result_login['tab_amountbalace'];
                        $disc=$disc+$result_login['tab_discountvalue'];?>
    						<tr >
                            <td><?=$i?></td>                            
                               <td><?=$database->convert_date($result_login['tab_dayclosedate']);?></td>
				<td><?=$result_login['tab_billno'];?></td>                              
                               <td><?=number_format($result_login['tab_subtotal'],$_SESSION['be_decimal'])?></td>                             
                               <td><?=number_format($result_login['tab_discountvalue'],$_SESSION['be_decimal'])?></td>                              
                              <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['tab_amountpaid'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['tab_amountbalace'],$_SESSION['be_decimal'])?></td>
                              </tr> 
                              <?php $i++;} } ?>                             
                              <tr>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                                  <td>&nbsp;</td>
                              </tr> 
                        <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
   <td ></td>
    <td ></td>
    <td ><strong><?=number_format($disc,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>
  </tr>                            
   </tbody>
     </table>
<?php
}	
 else if(($_REQUEST['type']=="itemordered_cs"))
{		$st="";
		$reporthead="";	
		$string="";
	$string.=" tbm.tab_status = 'Closed' and tbm.tab_mode='CS' ";
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
			if($bydatz!="null" && $bydatz!="")
			{
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
	} } ?>
<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                                  	<th colspan="7">Report-<?=$reporthead;?></th>                                
                                  </tr>
                                  <tr>
                                        <th class="sortable">Main Category Name</th>
					<th class="sortable">Sub Category Name</th>
                                      <th class="sortable">Menu Name</th>
                                      <th class="sortable">Portion Name</th>
				         <th class="sortable">Qty</th>	
						<th class="sortable"> Unit Price</th>
                                     <th class="sortable">Sub-Total</th>                                   
									</tr>
								  </thead>
								  <tbody>
<?php
$final=0;
$sub_total=0;
 	  $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,tbm.tab_netamt,sum(tbd.tab_qty) as qty,ROUND(avg(tbd.tab_rate), 1) as Unit_Price, ((sum(tbd.tab_qty))*(ROUND(avg(tbd.tab_rate), 1))) as Sub_Total from tbl_takeaway_billmaster tbm left join tbl_takeaway_billdetails tbd on tbd.tab_billno = tbm.tab_billno left join tbl_menumaster m on m.mr_menuid = tbd.tab_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = tbd.tab_portion where $string $stringta_addon group by m.mr_maincatid ,m.mr_subcatid,tbd.tab_menuid,tbd.tab_portion ORDER BY mc.mmy_maincategoryname,m.mr_menuname ASC");
  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login>0){$i=1;$t=0;$old="";
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
							  }   ?>
    						<tr >
<!--                            <td><?=$i?></td>-->
                             <td><?=$catname;?></td>
                               <td><?=$result_login['msy_subcategoryname'];?></td>
                               <td><?=$result_login['mr_menuname'];?></td>
                               <td><?=$result_login['pm_portionname'];?></td>                             
                               <td><?=$result_login['qty'];?></td>
<!--                              <td><?=$result_login['tab_dayclosedate'];?></td>-->
                               <td><?=number_format($result_login['Unit_Price'],$_SESSION['be_decimal'])?></td>                              
                              <td><?=number_format($result_login['Sub_Total'],$_SESSION['be_decimal'])?></td>                           
                              </tr> 
                              <?php $i++;} ?>                             
          <tr>
	<td colspan="1" style="text-align:center"><strong>Total</strong>
         </td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td><strong><?=number_format($sub_total,$_SESSION['be_decimal'])?></strong></td>
	  </tr>                             
           <?php   } else {?>
			<tr><td colspan="7" style="color:red;font-weight: bold;">No Records to Display</td></tr>
			<?php } ?>
           </tbody>
           </table>
   <?php
}	

 if(($_REQUEST['type']=="complimentary_cs"))
{
	$string="";
	$string.=" tab_status='Closed' AND tab_mode= 'CS' AND tab_complimentary='Y' ";
	$reporthead="";
	if(isset($_REQUEST['set']))
				{
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate ";
					}
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
					
				}
else if(isset($_REQUEST['abc']))	
{
		$bydatz=$_REQUEST['bydate'];

			if($bydatz!="null")
			{
	if($bydatz=="Last5days")
	{
		$string.=" and tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	$st="Last5days";
	}elseif($bydatz=="Last10days")
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
		$string.=" and  tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
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
	else{
			$cur=date("Y-m-d");
				$string.=" and tab_dayclosedate='".$cur."'";
			$reporthead="On ".$database->convert_date($cur);		
	} ?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                                  	<th colspan="5">Report-<?=$reporthead;?></th>
                                  </tr>
									<tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Date</th>
                                    <th class="sortable">Bill No</th>
                                     <th class="sortable">Amount</th>
                                     <th class="sortable">Remarks</th>
									</tr>
								  </thead>
								  <tbody>
									
                                          <?php
$final=0;
$sql_login  =  $database->mysqlQuery("select tab_netamt,tab_dayclosedate,tab_billno,tab_complimentaryremark from tbl_takeaway_billmaster where $string  ");
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      $final=$final+$result_login['tab_netamt']; ?>
    						<tr >
                            <td><?=$i?></td>
                             
                               <td><?=$database->convert_date($result_login['tab_dayclosedate']);?></td>
				<td><?=$result_login['tab_billno'];?></td>
                               <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                             <td><?=$result_login['tab_complimentaryremark'];?></td>
                              </tr> 
                             <?php $i++;} } ?>
                              
                              
 <tr>
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
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
   <td ></td>
   </tr>
                      
                             
                           </tbody>
                            </table>
                            
                            <?php
}	
	
if($_REQUEST['type']=="billreport_cs")
{
    $string="";
	$string=" tbm.tab_status='Closed' AND tbm.tab_mode='CS'";
    $sort_string='';
    $sort_string1='';
    $sort_string.=$_REQUEST['sortby'];
        
        if($sort_string=='bill_asc'){
           $sort_string1.= " order by tbm.tab_billno  asc ";
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
	  if($num_login){
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
					$new=$result_login['tab_billno']; ?>

    						<tr>
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
                     $each=$each + ($result_login['tab_rate'] * $result_login['tab_qty']);?>
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
					{ ?>
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
                      
  <?php }  else {?>   
	<tr><td colspan="8" style="color:red;font-weight: bold;">No Records to Display</td></tr>
	<?php } ?>   
        </tbody>
        </table>                           
<?php
}	
else if(($_REQUEST['type']=="paymenttype_cs"))
{

	$fields="";
	$reporthead="";
	$st="";
		
if(isset($_REQUEST['set']))
{
	if($_REQUEST['typepay']=="cash")
	{
			 $string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and tbm.tab_status='Closed' and tbm.tab_mode='CS' and ((tbm.tab_amountpaid-tbm.tab_amountbalace) > 0) ";
			$fields="<th class='sortable'>Cash</th>";
	}else if($_REQUEST['typepay']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string = " p.pym_code='credit' and (tbm.tab_transcbank <> '0') and tbm.tab_status='Closed' and tbm.tab_mode='CS'";
		$fields="<th class='sortable'>Bank</th>";
		$fields.="<th class='sortable'>Card Payment</th>";
		
		
	}else if($_REQUEST['typepay']=="coupons")
	{
		//$string = " bm_couponcompany <>''  and bm_couponamt <>'0.00'";
		$string = " pym_code='coupon' and bm_status='Closed'";
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
		//$string = " bm_voucherid <>''";
		$string = " pym_code='voucher' and bm_status='Closed'";
		$fields="<th class='sortable'>Voucher</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
		///$string = " bm_chequeno <>'' and bm_chequebankname<>''";
		$string = " pym_code='cheque' and bm_status='Closed'";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}
	/*else if($_REQUEST['typepay'] =="credits")
	{
		
		$string = " bm_paymode='credits'";
		$fields="<th class='sortable'></th>";
		$fields.="<th class='sortable'>Bank Name</th>";
		$fields.="<th class='sortable'>Paid</th>";
		
	}*/
	
	
	
	
	
	//fromdt todt
	
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";//order by bm_dayclosedate
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
		}
		
$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
		
		
		
}
	else if(isset($_REQUEST['abc']))
	{
		$paybydate=$_REQUEST['paybydate'];
			if($_REQUEST['typepay']=="cash")
	{
		//$string = " (bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)";
		 //$string = " (bm_amountpaid-bm_amountbalace) >0  and bm_status='closed' ";   //	$string = " bm_paymode='cheque'";
		 $string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and tbm.tab_status='Closed' and tbm.tab_mode='CS' and ((tbm.tab_amountpaid-tbm.tab_amountbalace) > 0) ";
			$fields="<th class='sortable'>Cash</th>";
	}else if($_REQUEST['typepay']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string = " p.pym_code='credit' and (tbm.tab_transcbank <>'0') and tbm.tab_status='Closed' and tbm.tab_mode='CS'";
		$fields="<th class='sortable'>Bank</th>";
		$fields.="<th class='sortable'>Card Payment</th>";
		
		
	}else if($_REQUEST['typepay']=="coupons")
	{
		//$string = " bm_couponcompany <>''  and bm_couponamt <>'0.00'";
		$string = " pym_code='coupon' and bm_status='Closed'";
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
		//$string = " bm_voucherid <>''";
		$string = " pym_code='voucher' and bm_status='Closed'";
		$fields="<th class='sortable'>Voucher</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
		//$string = " bm_chequeno <>'' and bm_chequebankname<>''";
		$string = " pym_code='cheque' and bm_status='Closed'";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}
		
		
			if($paybydate!="null")
	{
		//$search="";
	
	if($paybydate=="Last5days")
	{
		$string.= " and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";

$st="Last 5 days";
	}elseif($paybydate=="Last10days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($paybydate=="Last15days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($paybydate=="Last20days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($paybydate=="Last25days")
	{
		$string.= " and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($paybydate=="Last30days")
	{
		$string.= " and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($paybydate=="Today")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	else if($paybydate=="Yesterday")
			  {
				  $string.= " and tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day";
				  	$st="Yesterday";
			  }
	else if($paybydate=="Last1month")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	$st="Last 1 month";
	}

else if($paybydate=="Last90days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			$st="Last 3 months";
	}
else if($paybydate=="Last180days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($paybydate=="Last365days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
$reporthead=$st;
	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			
			$string= "   tbm.tab_dayclosedate between '".$from."' and '".$to."'  ";
			
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}


	}
	
	else if(isset($_REQUEST['pay']))
	{
	if($_REQUEST['typepay']=="cash")
	{
		//$string = " (bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)";
		$string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and tbm.tab_status='Closed' and tbm.tab_mode='CS' and ((tbm.tab_amountpaid-tbm.tab_amountbalace) > 0) ";
		//$string = " (bm_amountpaid-bm_amountbalace) >0 and bm_status='closed' ";
	/*	$fields="";*/
			$fields="<th class='sortable'>Cash</th>";
	}else if($_REQUEST['typepay']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string = " p.pym_code='credit' and (tbm.tab_transcbank <>'0') and tbm.tab_status='Closed' and tbm.tab_mode='CS'";
		/*$fields="<th class='sortable'>Transaction Amount</th>";*/
		
			$fields.="<th class='sortable'>Card Payment</th>";
                        $fields.="<th class='sortable'>Bank</th>";
		//$fields.="<th class='sortable'>Cash</th>";
			
		
	}else if($_REQUEST['typepay']=="coupons")
	{
		//$string = " bm_couponcompany <>''  and bm_couponamt <>'0.00'";
		$string = " pym_code='coupon' and bm_status='Closed'";
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
			$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
		//$string = " bm_voucherid <>''";
		$string = " pym_code='voucher' and bm_status='Closed'";
		$fields="<th class='sortable'>Voucher</th>";
			$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
		//$string = " bm_chequeno <>'' and bm_chequebankname<>''";
		$string = " pym_code='cheque' and bm_status='Closed'";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
			$fields.="<th class='sortable'>Paid</th>";
	}
	
	//fromdt todt
	
	$paybydate=$_REQUEST['paybydate'];
		if($paybydate!="null")
	{
		$st="";
		
	if($paybydate=="Last5days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($paybydate=="Last10days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($paybydate=="Last15days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($paybydate=="Last20days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($paybydate=="Last25days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($paybydate=="Last30days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($paybydate=="Today")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	
	
		else if($paybydate=="Yesterday")
			  {
				  $string.= " and tbm.tab_dayclosedate =  CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	else if($paybydate=="Last1month")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";
	}
	
	else if($paybydate=="Last90days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) -  3 MONTH 
 AND CURDATE( )";
 $st="Last 3 months";
	}
	else if($paybydate=="Last180days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 6 
MONTH AND CURDATE( )";
$st="Last 6 months";
	}
	else if($paybydate=="Last365days")
	{
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 1 
YEAR AND CURDATE( )";
$st="Last 1 year";
	}
	
	$reporthead=$st;
	}
 
	}
	
	
	
	
		else
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			//$string="tbm.tab_status='closed' and tbm.tab_mode='CS' ";
			$string= "  (tbm.tab_dayclosedate between '".$from."' and '".$to."' )  ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		/*    $fields="<th class='sortable'>Transcation Id</th>";
		  	$fields.="<th class='sortable'>Coupon Company</th>";
			$fields.="<th class='sortable'>Coupon Amount</th>";
			$fields.="<th class='sortable'>Voucher</th>";
			$fields.="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";*/
		  
		}
	
	?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <!--<tr>
                         	<th >Report - <?=$reporthead?></th>           
                                  
                                  </tr>-->
                                  
                                   <tr>
                                  	<th colspan="9">Report - <?=$reporthead?></th>
                                  
                                  </tr>
                                  
                                  
									<tr>
                                    <th class="sortable">Slno</th>
                                     <th class="sortable">Date</th>
					<th class="sortable">Bill No</th>
                                      <?=$fields?>
                                     
                                      <th class="sortable">Final</th>
									</tr>
								  </thead>
								  <tbody>
                                          <?php

	 $final=0;
  $paid=0;
  $bal=0; 
  $coup=0;
  $paidcrdt=0;
  $total_transaction=0;
$sql_login =  $database->mysqlQuery("select tbm.tab_netamt,tbm.tab_billno,tbm.tab_transactionamount,tbm.tab_dayclosedate,tbm.tab_amountpaid,b.bm_name,
tbm.tab_amountbalace from tbl_takeaway_billmaster tbm left join tbl_paymentmode p on tbm.tab_paymode=p.pym_id left join  tbl_bankmaster b on b.bm_id=tbm.tab_transcbank where $string order by tbm.tab_billno asc");

	  $num_login   = $database->mysqlNumRows($sql_login);
	 
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                         $final=$final+$result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$paidcrdt=$paidcrdt + ($result_login['tab_amountpaid']-$result_login['tab_amountbalace']);
			$total_transaction=$total_transaction+$result_login['tab_transactionamount'];
			
	 ?>
     <tr>
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['tab_dayclosedate'])?></td>
                               <td><?=$result_login['tab_billno']?></td>
							  
                               
                               <?php
								if($_REQUEST['typepay']=="cash")
								{
								
									?>
<!--										  <td><?=$result_login['tab_amountpaid']?></td>-->
									   <td><?=number_format(($result_login['tab_amountpaid']-$result_login['tab_amountbalace']),$_SESSION['be_decimal'])?></td>
							                          <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                                                                               <?php	
							
							
							
							
							  }else if($_REQUEST['typepay']=="credit")
								{
									?>
                                    
                                     <td><?=$result_login['bm_name']?></td>
                                     <td><?=number_format($result_login['tab_transactionamount'],$_SESSION['be_decimal'])?></td>
				  
                                   <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                                   
                                   
                                    <?php
									
								}
								?>
                             
                              
                            <?php /*?>  <td><?=$result_login['bm_amountbalace']?></td><?php */?>
                                
                              </tr> 
                              <?php $i++;} }
							  
							  
							   ?>
   <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>

    <?php
	if($_REQUEST['typepay']=="cash")
	  {
		  ?>
		  <td >&nbsp;</td>
          <?php
	  }
	   else if($_REQUEST['typepay']=="credit")
	  {
		  ?>
		  <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td>&nbsp;</td>
		  <?php
		  
	  } ?>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
    <td ></td>
<!--    <td ></td>
    <td ></td>-->
    
     <?php
	 if($_REQUEST['typepay']=="cash")
	  {
		  ?>
                  <td ><strong><?=number_format($paidcrdt,$_SESSION['be_decimal'])?></strong></td>
		  <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
		    

          <?php
	  }
	 else if($_REQUEST['typepay']=="credit")
	  {
		  ?>
                    
                    
                     <td ></td>
                  <td ><strong><?=number_format($total_transaction,$_SESSION['be_decimal'])?></strong></td>
		  <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
                  
          <?php
	  }
	  ?>
  
   
  <?php /*?>  <td ><strong><?=$bal?></strong></td><?php */?>
    
      
  </tr>
                             
                           </tbody>
                            </table>
                            
                            <?php
	  }

else if(($_REQUEST['type']=="categorywise_report_cs"))
{		
	$st="";
	$reporthead="";	
	$string="";
	$string.=" tbm.tab_status = 'Closed' and tbm.tab_mode='CS'";
	
	if(isset($_REQUEST['set']))
				{
					if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= "and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
						
					}
					else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
					{
						$from=$database->convert_date($_REQUEST['fromdt']);
						$to=date("Y-m-d");
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
					}
					else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
					{
						$from=date("Y-m-d");
						$to=$database->convert_date($_REQUEST['todt']);
						$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' ";
					}
					$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);						
				}
	else if(isset($_REQUEST['abc']))
	{
		$bydatz=$_REQUEST['bydate'];
		if($bydatz!="null")
		{
	
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
	else{
			$cur=date("Y-m-d");
			$string.="  and tbm.tab_dayclosedate='".$cur."'";
			$reporthead="On ".$database->convert_date($cur);	
		}
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
				<thead>
                <tr>
                <th colspan="5">Category Wise Report-<?=$reporthead;?></th>
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
             if($num_login){
				$i=1;$t=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$t++;
                          $total=$total+$result_login['Total']; ?>
                        
                             <tr>
                                <td><?=$i?></td>
                                <td><?=$result_login['mmy_maincategoryname'];?></td>
                                 <td><?=$result_login['no of items'];?></td>
                                <td><?=$result_login['qty'];?></td>
                                <td><?=number_format($result_login['Total'],$_SESSION['be_decimal'])?></td>
                                
                              </tr> 
             <?php $i++;} ?>
                              
                              <tr></tr>
                              <tr>
	 <td colspan="1" style="text-align:center"><strong>Total</strong>
         </td>
           <td></td>
           <td></td>
           <td></td>
           <td><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
          
	  </tr><?php }  else { ?>
		<tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
		<?php } ?>
                           
                           </tbody>
                            </table>
                            
<?php } ?>                     