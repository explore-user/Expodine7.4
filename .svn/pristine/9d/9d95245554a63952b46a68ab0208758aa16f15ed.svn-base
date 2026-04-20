

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
if(($_REQUEST['type']=="tot_sales_hd"))
{
    $string="";
    $string.=" tab_status='closed' AND tab_mode= 'HD' and tab_complimentary!='Y'  AND ";
    $reporthead="";
    $st="";
    if(isset($_REQUEST['staffsel'])){
    $staffsel = $_REQUEST['staffsel'];

    if($_REQUEST['staffsel']!='null')
    {
        $string.="tab_assignedto='".$staffsel."' AND ";
    }
    }
        if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
	{
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            
        }
        else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
	{
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=date("Y-m-d");
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            
        }
	else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
	{
            $from=date("Y-m-d");
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate ";
        
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
        }
        
	else 
	{
            $reporthead="";
            $st="";
            $bydatz=$_REQUEST['bydate'];
            if($bydatz!="null"&& $bydatz!="")
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
	
?>
   <table class="table table-bordered table-font user_shadow" >
			<thead>
                            <?php
                            $tax_name=array();
                            $tax_id=array();
                                  $sql_login  =  $database->mysqlQuery(" select  distinct(tketm.tbe_taxid) as taxid,tketm.tbe_label as taxname  FROM tbl_takeaway_bill_extra_tax_master tketm left join  tbl_extra_tax_master tm on tm.amc_id=tketm.tbe_taxid group by tm.amc_id order by tm.amc_id asc "); 
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
  $sql_login  =  $database->mysqlQuery("select tab_subtotal,tab_discountvalue,tab_netamt,tab_amountpaid,tab_amountbalace,
  tab_dayclosedate,tab_billno,tab_loginid from tbl_takeaway_billmaster where $string");
  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{  
            $i++;
            $subtotal=$subtotal + $result_login['tab_subtotal'];
            $dsc=$dsc + $result_login['tab_discountvalue'];
			$final=$final + $result_login['tab_netamt'];
			$paid=$paid +$result_login['tab_amountpaid'];
			$bal=$bal + $result_login['tab_amountbalace'];  ?>
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
                              <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['tab_amountpaid'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['tab_amountbalace'],$_SESSION['be_decimal'])?></td>
                        </tr>                                                            
                              <?php }  ?>                          
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <?php 
    for($i=0;$i<count(array_unique($tax_id));$i++){ 
        ?>
    <td></td>
    <?php } 
    ?>
    
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
    <td ><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
     <?php 
     
        for($i=0;$i<count(array_unique($tax_id));$i++){ 
            //print_r($tax_value);

    if (!empty($tax_value)) {
        ?>
        <td><strong><?=number_format(array_sum($tax_value[$tax_id[$i]]),$_SESSION['be_decimal'])?></strong></td>
        <?php  
         }
         else{ ?>
        <td><strong><?=number_format(0,$_SESSION['be_decimal'])?></strong></td>
         <?php }
     }
        for($o=1;$o<=(count(array_unique($tax_id))-$i);$o++){ ?>
   <td><strong><?=number_format(0,$_SESSION['be_decimal'])?></strong></td>
    <?php } ?>
    <td ><strong><?=number_format($dsc,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
  <?php } else { ?>
    <tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
    <?php } ?>
                           </tbody>
                            </table>
<?php
}
else if(($_REQUEST['type']=="categorywise_report_hd"))
{   $st="";
    $reporthead="";	
    $string="";
    $string.=" tbm.tab_status = 'Closed' and tbm.tab_mode='HD'";
    if(isset($_REQUEST['staffsel'])){
    $staffsel = $_REQUEST['staffsel'];
    if($_REQUEST['staffsel']!='null')
    {
        $string.="tbm.tab_assignedto='".$staffsel."' AND ";
    }
}
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
    else
    {
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
    if($num_login)
    {   $i=1;$t=0;
        while($result_login  = $database->mysqlFetchArray($sql_login)) 
	{   $t++;
            $total=$total+$result_login['Total'];                    
?>          
            <tr>
                <td><?=$i?></td>
                <td><?=$result_login['mmy_maincategoryname'];?></td>
                <td><?=$result_login['no of items'];?></td>
                <td><?=$result_login['qty'];?></td>
                <td><?=number_format($result_login['Total'],$_SESSION['be_decimal']);?></td>
            </tr> 
<?php
            $i++;
            
        }
     
?>      
            <tr></tr>
            <tr>
                <td colspan="1" style="text-align:center"><strong>Total</strong>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
          
            </tr>
<?php } else { ?>
    <tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
<?php } ?>
        </tbody>
    </table>
<?php
}
else if(($_REQUEST['type']=="total_summary_details_hd"))
{   
    $string="";
    $reporthead="";
    $strings=" tab_status='closed' AND  tab_mode = 'HD' AND ";
    //$staffsel = $_REQUEST['staffsel'];
    //if($_REQUEST['staffsel']!='null')
    //{
    //  $strings.="tab_assignedto='".$staffsel."' AND ";
    //}
    $string1_str=" (sum(tab_amountpaid) - sum(tab_amountbalace)) ";
    $string2_str=" sum(tab_transactionamount) ";
    $string3_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
    $string4_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
    $string5_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
    $string6_str=" (sum(tab_netamt)-(sum(tab_amountpaid)-sum(tab_amountbalace))) ";
    $string7_str=" sum(tab_netamt)";
    $string_pax="";
    $string_pax=" tab_status='Closed' AND ";
    //	$string1 =$strings. " tab_paymode='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
    $string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
    $string2 =$strings." pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
    $string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
    $string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
    $string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
    $string6=$strings. " pym_code='credit_person' AND ";
    $string7=$strings. " tab_complimentary='Y' AND pym_code='complimentary' AND ";
    
    if(isset($_REQUEST['set']))
    {
        //echo $_REQUEST['fromdt'] ."--";
	//echo $_REQUEST['todt'] ."<br>";
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
            //$search="";
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
    if($num_login)
    {
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
    $totalpax=0;
    $totalcreditordebit=0;
    $slno=0;
    $sql = $database->mysqlQuery("select distinct(tab_dayclosedate) from tbl_takeaway_billmaster where $string_pax");
    $num_row   = $database->mysqlNumRows($sql);
    if($num_row)
    {
       while($result = $database->mysqlFetchArray($sql)){
       $total=0;
       $slno++;
       if($result != "")
        {
            echo "<tr><td>".$slno."</td><td>".$result['tab_dayclosedate']."</td>";
            $dt = " tab_dayclosedate='".$result['tab_dayclosedate']."'";
        }
        $sql_login  =  $database->mysqlQuery("select $string1_str as tot 
        from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
        where $string1"."$dt order by tab_dayclosedate,tab_time ASC"); 
        //  echo"select $string1_str as tot 
        //from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id 
        //where $string1"."$dt order by tab_dayclosedate,tab_time ASC";
        $num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
        {
            $result_login  = $database->mysqlFetchArray($sql_login);
            if($result_login['tot'] != "")
            {
                $totalcash=$totalcash + $result_login['tot'];
                $total= $total + $result_login['tot'];            
		$subtotal =$subtotal + $result_login['tot'];
?>
                <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
<?php       
            }
            else
            {
                echo "<td>--</td>";
            }
        }
        else
        {
            echo "<td>--</td>";
        }
        $sql_login1  =  $database->mysqlQuery("select $string2_str as tot 
        from tbl_takeaway_billmaster tb left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  
        where  b.bm_id = tb.tab_transcbank and $strings"." $string2 "."$dt  order by tb.tab_dayclosedate,tb.tab_time ASC ");

	$num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1)
        {
            $result_login1  = $database->mysqlFetchArray($sql_login1); 
            $totalcreditordebit=$totalcreditordebit + $result_login1['tot'];  
            $total= $total + $result_login1['tot'];       
            $subtotal =$subtotal + $result_login1['tot'];
?>
            <td><?=number_format($result_login1['tot'],$_SESSION['be_decimal'])?></td>
<?php	
	}
        else
        {
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
                        $subtotal =$subtotal + $result_login3['tot'];
                         
			?>
         
              
          
          <td><?=number_format($result_login3['tot'],$_SESSION['be_decimal'])?></td>
         
            
            <?php }
            else{
              echo "<td>--</td>";
          }
            
                        }
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
          }
            
                        }
            else{
              echo "<td>--</td>";
          }
          
          
	$sql_login  =  $database->mysqlQuery("select $string7_str as tot 
        from tbl_takeaway_billmaster tb 
        left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id
        where $string7"." $dt order by tab_dayclosedate,tab_time ASC");

	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login)
        {
            $result_login6  = $database->mysqlFetchArray($sql_login); 
            if($result_login6['tot'] != "")
            {
                $totalcomplimentary= $totalcomplimentary + $result_login6['tot'];    
?>              
                <td><?=number_format($result_login6['tot'],$_SESSION['be_decimal'])?></td>
<?php       } 
            else
            {
                echo "<td>--</td>";
            }
        }
        else
        {
            echo "<td>--</td>";
        }
?>
        <td><strong><?=number_format($total,$_SESSION['be_decimal'])?></strong></td>
    </tr>
<?php
}
}
?>
            <tr>
                <td colspan="11"></td></tr>
            <tr> 
                <td><strong>TOTAL</strong></td>
                <td><strong><?=$reporthead?></strong></td>
                <td colspan=""><strong><?=number_format($totalcash,$_SESSION['be_decimal'])?></strong></td>
                <td colspan=""><strong><?=number_format($totalcreditordebit,$_SESSION['be_decimal'])?></strong></td>
                <td colspan=""><strong><?=number_format($totalcoupons,$_SESSION['be_decimal'])?></strong></td>
                <td colspan=""><strong><?=number_format($totalvoucher,$_SESSION['be_decimal'])?></strong></td>
                <td colspan=""><strong><?=number_format($totalcheque,$_SESSION['be_decimal'])?></strong></td>
                <td colspan=""><strong><?=number_format($totalcredits,$_SESSION['be_decimal'])?></strong></td>
                <td colspan=""><strong><?=number_format($totalcomplimentary,$_SESSION['be_decimal'])?></strong></td>
                <td colspan=""><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
            </tr>
        </tbody>
    </table>
<?php
}
else if(($_REQUEST['type']=="summary_hd"))
{
    $strings="";
    $string="";
    $reporthead="";
    $strings=" tab_status='closed' AND tab_mode!= 'CS' AND tab_mode = 'HD' AND ";

    $string1_str="(sum(tab_amountpaid) - sum(tab_amountbalace)) ";
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
    $string7=$strings. " tab_complimentary='Y' AND pym_code='complimentary' and ";
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
		//$search="";
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
	if($num_login)
        {
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
    if($num_login)
    {
        while($result_login  = $database->mysqlFetchArray($sql_login)) 
        { 
            if($result_login['tot'] != "")	
            {
                $subtotal =$subtotal + $result_login['tot'];
?>
                <tr >
                    <td>Cash</td>
                    <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
                </tr> 
<?php       }
        }
    }
    $sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(tab_transactionamount)) as tot 
    from tbl_takeaway_billmaster tb 
    left join tbl_paymentmode on tb.tab_paymode=tbl_paymentmode.pym_id , tbl_bankmaster b 
    where b.bm_id = tb.tab_transcbank and tb.tab_status='Closed' AND $string2 "."$string 
    order by tb.tab_dayclosedate,tb.tab_time ASC "); 
    $num_login1   = $database->mysqlNumRows($sql_login1);
    if($num_login1)
    {
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
                                                    where tbl_paymentmode.pym_code='credit' and bm.tab_mode='HD'
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
    $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login)
    {
        while($result_login  = $database->mysqlFetchArray($sql_login)) 
	{ 
            if($result_login['tot'] != "")
            {

?>
                <tr >
                    <td>Complimentary</td>
                    <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
                </tr> 
<?php       }
        }
    }
?>  <?php  if($subtotal!="") { ?>
            <tr>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
            </tr>
            <tr class="main">
                <td ><strong>TOTAL</strong></td>
                <td ><strong><?= number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
            </tr>     
        <?php } { ?>
<tr><td style="color:red;font-weight: bold;"></td></tr>
<?php  } ?>
        </tbody>
    </table>
<?php
}
else if(($_REQUEST['type']=="cancel_history_hd"))
{
    $string="";
    $reporthead="";
    $st="";
    $string .= " tb.tab_status='Cancelled' AND tb.tab_mode = 'HD' AND ";
    if(isset($_REQUEST['loginstaffsel'])){
    $loginstaffsel = $_REQUEST['loginstaffsel'];
    if($_REQUEST['loginstaffsel']!='null')
    {
        $string.="tb.tab_cancelledlogin='".$loginstaffsel."' AND ";
    }
    }
    if(isset($_REQUEST['set']))
    {

	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
	{
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= " tb.tab_dayclosedate between '".$from."' and '".$to."'";
        }
	else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
        {
            $from=$database->convert_date($_REQUEST['fromdt']);
            $to=date("Y-m-d");
            $string.= " tb.tab_dayclosedate between '".$from."' and '".$to."' ";
	}
	else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
        {
            $from=date("Y-m-d");
            $to=$database->convert_date($_REQUEST['todt']);
            $string.= " tb.tab_dayclosedate between '".$from."' and '".$to."' ";
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
		$string.="tb.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
                $st="Last 5 days";
            }
            elseif($bydatz=="Last10days")
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
    else
    {
        $cur=date("Y-m-d");
	$string.=" tb.tab_dayclosedate='".$cur."'";
	$reporthead="On ".$database->convert_date($cur);	
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
    
    $sql_login  =  $database->mysqlQuery("Select sum( bd.tab_qty) as qty,tb.tab_date, tb.tab_billno, tb.tab_kotno, tb.tab_time, tb.tab_netamt, 
        tb.tab_cancelledtime, tb.tab_loginid, bd.tab_cancelledlogin, bd.tab_cancelledby_careof, tb.tab_cancelledreason, sm.ser_firstname
    From tbl_takeaway_billmaster as tb 
    left join tbl_takeaway_billdetails bd on bd.tab_billno = tb.tab_billno 
    left join tbl_staffmaster sm on sm.ser_staffid = tb.tab_cancelledby_careof
    where $string group by tb.tab_billno"); 

    $num_login   = $database->mysqlNumRows($sql_login);
    if($num_login)
    {   $i=1;$cancelledreason='';
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
            
            
            $final=$final+$result_login['tab_netamt'];
            $qty = $qty + $result_login['qty'];
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
            $i++;
        }
     
?>
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
                <td ><strong><?= number_format($final,$_SESSION['be_decimal']) ?></strong></td>
            </tr>
            <?php } else {?>
                <tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
                <?php } ?>
        </tbody>
    </table>
<?php
}
else if(($_REQUEST['type']=="order_hd"))
{
    $string="";
    $string.=" tbm.tab_status='closed' AND  tbm.tab_mode = 'HD' AND ";

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
	if($bydatz!="null" && $bydatz!="")
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
    
?>
    <table class="table table-bordered table-font user_shadow" >
    <thead>
        <tr>
            <th colspan="7">Report - <?=$reporthead?></td>          
        </tr>
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
    $sql_item  =  $database->mysqlQuery("SELECT tbm.tab_billno, tbd.tab_menuid, mmc.mmy_maincategoryname, msc.msy_subcategoryname , mm.mr_menuname, sum(tbd.tab_qty)as qty, pm.pm_portionname, tbd.tab_rate, tbd.tab_amount,sum(tbd.tab_qty* tbd.tab_rate) as Total
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
    if($num_item)
    {   $i=1;
	while($result_item  = $database->mysqlFetchArray($sql_item)) 
	{
            $final=$final+$result_item['Total'];
            if($result_item['mmy_maincategoryname']==$old)
            {
                $catname ="";
            }
            else
            {
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
                    <td colspan="1" style="text-align:center"><?=number_format($result_item['tab_amount'],$_SESSION['be_decimal'])?></td>
                </tr>
<?php
        }
  
?>
                <tr>
                    <td colspan="1" style="text-align:center"></td>
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
                    <td colspan="1" style="text-align:center"><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
                </tr>
                <?php }  else {?>
                    <tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
                    <?php } ?>
            </tbody>
        </table>
<?php
}
else if($_REQUEST['type']=="billreport_hd")
{
    $string="";
	$string=" tbm.tab_status='Closed' AND tbm.tab_mode='HD'";
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
	  if($num_login){ $i=1;$k=1;$each=0;$dsc=0;
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
                      
  <?php } else { ?>
    <tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
<?php } ?>                        
                           </tbody>
                            </table>
                            
                            <?php
}	
else if($_REQUEST['type']=="delivery_report_hd")
{
        $string="";
	$string.=" tbm.tab_status !='Cancelled'   AND tbm.tab_mode='HD' ";
        
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
		//$search="";
	
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
                                  <th colspan="8">Delivery Report-<?=$reporthead;?></th>
                                  
                                  </tr>
                                  
					<tr>
                                    
					<th class="sortable">Bill No</th>
					<th class="sortable">Date-Time</th>
                                        <th class="sortable">Customer</th>
                                          <th class="sortable">Number</th>
                                        <th class="sortable">Address</th>
                                        <th class="sortable">Delivered By</th>
                                      <th class="sortable">Delivery Charge</th>
                                     <th class="sortable">Bill Amount</th>
                                     
					</tr>
					</thead>
					<tbody>
									
                                          <?php
 $del=0; $final=0; $ct=0;
 
$sql_login  =  $database->mysqlQuery("select tbm.tab_netamt,tbm.tab_date,tbm.tab_delivery_charge,tbm.tab_billno,tbm.tab_time,ts.ser_firstname,tac.tac_customername,tac.tac_address,tac.tac_contactno from tbl_takeaway_billmaster tbm left join tbl_staffmaster ts on ts.ser_staffid=tbm.tab_assignedto left join tbl_takeaway_customer tac on tac.tac_customerid=tbm.tab_hdcustomerid where $string and  tbm.tab_complimentary!='Y' "); 
$old='';$new='';	 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ $i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$ct=$i++;
                      
			$final=	$final+$result_login['tab_netamt'];
                        $del=	$del+$result_login['tab_delivery_charge'];
			
                
	 ?>

    			<tr >
                            
                             
                               
				<td><?=$result_login['tab_billno'];?></td>
                                
                               <td><?=$result_login['tab_date']."  ". $result_login['tab_time']?></td>
                               
                               <td><?=$result_login['tac_customername']?></td>
                                <td><?=$result_login['tac_contactno']?></td>
                               <td><?=$result_login['tac_address']?></td>
                               
                                <td><?=$result_login['ser_firstname']?></td>
                                <td><?=number_format($result_login['tab_delivery_charge'],$_SESSION['be_decimal'])?></td>
				
		               <td><?=number_format($result_login['tab_netamt'],$_SESSION['be_decimal'])?></td>
                            
                              </tr> 
                             
                             <?php
             
          } 
                             ?>
				  
				
					
                  
  <tr class="main">
    <td >Total (<?=$ct?>)</td>
    <td ></td>
    <td ></td>
    <td ></td>
    <td ></td>
      <td ></td>
    <td ><strong><?=number_format($del,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td></tr>
    <?php } else {?> 
        <tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
  <?php } ?>
                      
                             
                           </tbody>
                            </table>
                            
                            <?php
}	
?>