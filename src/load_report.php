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
$sql_branchtx1 =  mysqli_query($localhost,"select be_name_tax1,be_name_tax2,be_name_tax3 from tbl_branchmaster "); 
    $num_branchtx1  = mysqli_num_rows($sql_branchtx1);
        if($num_branchtx1){
            while($result_branchtx1  = mysqli_fetch_array($sql_branchtx1)){
				$taxname1                 =$result_branchtx1['be_name_tax1'];
                $taxname2                =$result_branchtx1['be_name_tax2'];
                $taxname3                 =$result_branchtx1['be_name_tax3'];
		}
            }
//-------------------- TOTAL SALES REPORT START-------------------------------------------------------//
if(($_REQUEST['type']=="tot_sales"))
{
		$floorz='';
		$string="";
		$string.=" bm_status='Closed' AND ";
		$reporthead="";
		$st="";
		if(isset($_REQUEST['floorz']))
		{
		$floorz=$_REQUEST['floorz'];
		if($floorz!="")
	      {
		$string.=" bm_floorid='".$floorz."' AND ";
	      }      
		}
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);                       
        }
		else 
		{
            $bydatz=$_REQUEST['bydate'];
			if($bydatz!="null" && $bydatz!="")
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
				}
				else if($bydatz=="Last30days")
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
				$string.=" bm_dayclosedate = CURDATE( ) - INTERVAL 1 day";
				$st="Yesterday";
				}
				else if($bydatz=="Last1month")
				{
				$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
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
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
			}
		}?>
    		<table class="table table-bordered table-font user_shadow">
				<thead>
                <?php
                $tax_name=array();
                $sql_login  =  $database->mysqlQuery("select distinct(betm.bem_taxid) as taxid,betm.bem_label as taxname  
													  FROM tbl_tablebill_extra_tax_master betm 
													  left join tbl_extra_tax_master tm on tm.amc_id=betm.bem_taxid 
													  group by  amc_id order by tm.amc_id asc "); 
                $num_login   = $database->mysqlNumRows($sql_login);
                if($num_login)
				{ 
                    while($result_login=$database->mysqlFetchArray($sql_login)){                                     
                        $tax_name[]=$result_login['taxname'];
                    }}  ?>                                  
                    <tr>
                    	<th colspan="<?=9+count(array_unique($tax_name))?>">Report - <?=$reporthead?></th>                                
                    </tr>
                    <tr>
                    	<th class="sortable">Slno</th>
                    	<th class="sortable">Date</th>
						<th class="sortable">Bill No</th>
                    	<th  style="min-width:180px;" class="sortable">Table</th>
                    	<th class="sortable">Sub Total</th>
                    <?php
                    for($i=0;$i<count(array_unique($tax_name));$i++){ ?>
                    <th class="sortable"><?=$tax_name[$i]?></th>
                    <?php } ?>
                    	<th class="sortable">Discount</th>
                    	<th class="sortable">Final</th>
                    	<th class="sortable">Paid</th>
                    	<th class="sortable">Balance Paid</th>
                    </tr>
				</thead>
                <tbody>									
	<?php
  	$final=0;
  	$paid=0;
  	$bal=0;
  	$dsc=0;
  	$tax_value=array();
  	$subtotal=0;
  	$sql_login  =  $database->mysqlQuery("select bm_paymode,bm_finaltotal,bm_amountpaid,bm_amountbalace,bm_discountvalue,
  										bm_subtotal,bm_dayclosedate,bm_billno,bm_tableno from tbl_tablebillmaster 
  										where $string order by bm_dayclosedate,bm_billtime ASC"); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login>0){
		$q=0;
		while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
            if($result_login['bm_paymode']!=7){
            $q++;
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			$dsc=$dsc + $result_login['bm_discountvalue'];
			$subtotal=$subtotal + $result_login['bm_subtotal']; ?>
                <tr >
                    <td><?=$q?></td>
                    <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                    <td><?=$result_login['bm_billno']?></td>
                    <td style="min-width:180px;word-break: break-word;" ><?=$result_login['bm_tableno']?></td>
                    <td><?=  number_format($result_login['bm_subtotal'],$_SESSION['be_decimal'])?></td>                      
                    <?php 
                    for($s=0;$s<count(array_unique($tax_name));$s++){
                        $sql_taxvalue  =  $database->mysqlQuery("select betm.bem_total_value,betm.bem_taxid,betm.bem_label  FROM tbl_tablebill_extra_tax_master betm where betm.bem_billno='".$result_login['bm_billno']."' and betm.bem_label='".$tax_name[$s]."'  order by betm.bem_label asc"); 
                        $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);                                
                        if($num_taxvalue){
                            while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                                {
								if($result_taxvalue['bem_total_value']==''){
                                    $result_taxvalue['bem_total_value']=0;
                                }
                                $tax_value[$result_taxvalue['bem_label']][]=$result_taxvalue['bem_total_value'];                                                                    
                                ?>
                    <td><?=number_format($result_taxvalue['bem_total_value'],$_SESSION['be_decimal'])?></td>
                            	<?php  
                                } } 
                        else{ 
                            $tax_value[$tax_name[$s]][]=0;?>
                    <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                        <?php } }?>                               
                    <td><?=number_format($result_login['bm_discountvalue'],$_SESSION['be_decimal'])?></td>                                                              
                    <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                    <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                    <td><?=number_format($result_login['bm_amountbalace'],$_SESSION['be_decimal'])?></td>
                </tr>                                                                                                                                                   
                <?php } }  ?>                                                         
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <?php 
    for($i=0;$i<count(array_unique($tax_name));$i++){  ?>
    <td></td>
    <?php } 
       for($o=1;$o<=(count(array_unique($tax_name))-$i);$o++){ ?>
            <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
    <?php } ?>
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
    for($i=0;$i<count(array_unique($tax_name));$i++){ 
        ?>
    <td><strong><?=number_format(array_sum($tax_value[$tax_name[$i]]),$_SESSION['be_decimal'])?></strong></td>
    <?php } 
        for($o=1;$o<=(count(array_unique($tax_name))-$i);$o++){ ?>
   <td><strong><?=number_format(0,$_SESSION['be_decimal'])?></strong></td>
    <?php } ?>
     <td ><strong><?=number_format($dsc,$_SESSION['be_decimal'])?></strong></td>
   
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>
  </tr>                                                     
             <?php }
			 else{ ?>
				<tr><td colspan="9" style="color:red;font-weight: bold;">No Records to Display</td></tr> 
			<?php } ?>              </tbody>
                            </table>                           
	<?php
}
//-------------------- TOTAL SALES REPORT END-------------------------------------------------------//
if(($_REQUEST['type']=="tax_detailed_cnb"))
{
	$string="";
        $string .=" bm_status='Closed' AND bm_complimentary !='Y' AND ";
	$reporthead="";
	$st="";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			 $string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);		
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	else 
	{
	$reporthead="";
	$st="";
	$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!="")
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
	}
	else if($bydatz=="Last30days")
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
				  $string.=" bm_dayclosedate = CURDATE( ) - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
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
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
	} ?>
                        <table class="table table-bordered table-font user_shadow">
                                    <thead>
                                        <?php
                                  $tax_name=array();
                                  $tax_id=array();
                                  $sql_login  =  $database->mysqlQuery(" select distinct(betm.bem_taxid) as taxid,betm.bem_label as taxname  FROM tbl_tablebill_extra_tax_master betm left join tbl_extra_tax_master tm on tm.amc_id=betm.bem_taxid order by tm.amc_id asc "); 
                                  $num_login   = $database->mysqlNumRows($sql_login);
                                     if($num_login){ 
                                        while($result_login=$database->mysqlFetchArray($sql_login)){                                     
                                       $tax_name[]=$result_login['taxname'];
                                       $tax_id[]=$result_login['taxid'];
                                     }} ?>                                   
                                  <tr>
                                  	<th colspan="<?=(7+count($tax_name))?>">Report - <?=$reporthead?></th>                                 
                                  </tr>
                                  <tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Date</th>
                                      <th class="sortable">Bill No</th>                                      
                                      <th class="sortable">Item</th>
                                      <th class="sortable">Qty</th>
                                       <th class="sortable">Subtotal</th>
                                      <?php
                                     for($i=0;$i<count($tax_name);$i++){
                                        ?>
                                        <th class="sortable"><?=$tax_name[$i]?></th>
                                     <?php } ?>
                                      <th class="sortable">Total</th>
                    </tr>
                                    </thead>
                                    <tbody>
<?php
 $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $total=0;
  $finaltotal=0;
  $ct=0;
  $complimentary=0;
  $totalqty = 0;
  $finalsubtotal=0;
  $subtotal=0;
  $taxid=array();
  $sql_login  =  $database->mysqlQuery("select tbd.bd_billno,tbm.bm_billdate,tbm.bm_complimentary,tbm.bm_total, tbd.bd_menuid, mm.mr_menuname, tbd.bd_qty, tetd.bet_tax_amount, tetd.bet_tax_id , etm.amc_name,tbd.bd_amount,tbd.bd_billslno 
    FROM tbl_tablebilldetails tbd
    left join tbl_tablebillmaster tbm on tbd.bd_billno = tbm.bm_billno
    left join tbl_menumaster mm on mm.mr_menuid = tbd.bd_menuid
    left join tbl_tablebill_extra_tax_details tetd on tbd.bd_billno = tetd.bet_billno and tbd.bd_billslno = tetd.bet_billslno
    left join tbl_extra_tax_master etm on etm.amc_id = tetd.bet_tax_id
    where $string group by tbd.bd_billno,tbd.bd_menuid,tetd.bet_tax_id
    order by tetd.bet_billno,tetd.bet_tax_id asc");
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{   $i++;                                             
                        $billlno=$result_login['bd_billno'];
                        $menuid=$result_login['bd_menuid'];                       
                         $taxamnt=array();                        
			$subtotal=$result_login['bd_amount'];                       
                        $totalqty = $totalqty + $result_login['bd_qty'];                       
                        if($result_login['bm_complimentary']=='Y')
                        {
                            $complimentary = $complimentary + $result_login['bm_total'];
                        }
                        else{
                            $complimentary = $complimentary;
                        }                                              
                        $taxid[]=$result_login['bet_tax_id'];                       
                        $taxamnt[$result_login['bet_tax_id']]=$result_login['bet_tax_amount'];
               ?>
                               <tr>
                               <td><?=$i?></td>
                               <td><?=$result_login['bm_billdate']?></td>
                               <td><?=$result_login['bd_billno']?></td>
                               <td><?=$result_login['mr_menuname']?></td>
                               <td><?=$result_login['bd_qty']?></td>                              
                               <td><?=number_format($subtotal,$_SESSION['be_decimal'])?></td>
                                <?php                                       
                                for($p=0;$p<count(array_unique($taxid));$p++){ ?>
                               <td> <?=number_format($taxamnt[$tax_id[$p]],$_SESSION['be_decimal'])?> </td>                              
                                    <?php
                                     } 
                            for($s=0;$s<(count($tax_id)-count(array_unique($taxid)));$s++){
                                      ?>
                                   <td>0.000</td>
                                     <?php } ?>
                              <td></td>
                              </tr> 
                              <?php
                               $finalsubtotal = $finalsubtotal + $result_login['bd_amount'];
                                }} ?>                         
    <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <td >&nbsp;</td>
    <td >&nbsp;</td>
    <?php
    for($p=0;$p<count($tax_id);$p++){
    ?>
        <td></td>
    <?php } ?>
    <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td><strong>TOTAL</strong></td>
    <td></td>
    <td></td>
    <td></td>
    <td><strong><?=$totalqty?></strong></td>
    <td><strong><?=number_format($finalsubtotal-$complimentary,$_SESSION['be_decimal'])?></strong></td>
    <?php
    for($p=0;$p<count($tax_id);$p++){
    ?>
        <td></td>
    <?php }  ?>
    <td><strong><?=number_format($finaltotal,$_SESSION['be_decimal'])?></strong></td>
    </tr>
    </tbody>
    </table>
<?php
}
else if(($_REQUEST['type']=="sales_summary_zam"))
{
	$string="";
       $strings="";
	$reporthead="";
	$string .=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_finaltotal) ";
	$string6_str=" sum(bm_finaltotal)";
		$string7_str=" sum(bm_finaltotal)";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
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
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) "; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
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
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
		$string_pax.= " bm_dayclosedate  between '".$cur."' and '".$cur."'";
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
                                 <tr><td><b>SALES SUMMARY</b></td></tr>									
                                          <?php
 $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
 $sql_login  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot FROM tbl_tablebillmaster where bm_floorid <> 'YMR-FL3' AND $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
				if($result_login['tot'] != "")	{
			$subtotal =$subtotal + $result_login['tot'];
			?>
          <tr >
          <td>Dine in</td>
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php } }}
		$sql_login1  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot FROM tbl_tablebillmaster where bm_floorid = 'YMR-FL3' AND $string"); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
				$subtotal =$subtotal + $result_login1['tot'];
			?>
            <tr>
            <td>Take Away</td>
            <td><?=number_format($result_login1['tot'],$_SESSION['be_decimal'])?></td>
            </tr>
		<?php	}
	  }
		 $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot FROM tbl_tablebillmaster where $string"); 
	$num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  $result_stw  = $database->mysqlFetchArray($sql_stw); 			
			?>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong><?=number_format($result_stw['tot'],$_SESSION['be_decimal'])?></strong></td>
                </tr><?php
	  } ?>                             
                <tr>
                    <td>&nbsp;</td>
                <td></td>
                </tr>              
  <tr><td><b>TAX SUMMARY</b></td></tr>
<?php
 $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $subtotal1=0;
$sql_login  =  $database->mysqlQuery("select sum(bm_finaltotal) as tot FROM tbl_tablebillmaster where bm_floorid <> 'YMR-FL3' AND $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
				if($result_login['tot'] != "")	{
			$subtotal =$subtotal + $result_login['tot'];
                        $salesinctax = $result_login['tot'];
			?>
          <tr >
          <td>SALES INC.TAX</td>
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>      
            </tr> 
            <?php } }}
	$sql_login1  =  $database->mysqlQuery("select sum( bm_servicetax) as tot FROM tbl_tablebillmaster where bm_floorid <> 'YMR-FL3' AND $string"); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
				$subtotal =$subtotal + $result_login1['tot'];
                $servctax = $result_login1['tot'];
	}
	  }
          $salsextax=$salesinctax - $servctax;
			?>
			 <tr>
            <td>SALES EX.TAX</td>
            <td><?=number_format($salsextax,$_SESSION['be_decimal'])?></td>
            </tr>
			 <tr>
            <td><?=$taxname1?></td>
            <td><?=number_format($servctax,$_SESSION['be_decimal'])?></td>
            </tr>                             
                        <tr>
                    <td>&nbsp;</td>
                <td></td>
                </tr>         
	</tbody>
                            </table>
                            
                            <?php
}

else if(($_REQUEST['type']=="sales_summary"))
{
	$string="";
        $strings='';
	$reporthead="";
        $string .=" bm_status='Closed' AND bm_complimentary !='Y' AND";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace) + sum(bm_roundoff_value)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
        $string4_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
	$string5_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string6_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string7_str=" sum(bm_finaltotal)";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
			$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
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
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) "; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
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
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
		$string_pax.= " bm_dayclosedate  between '".$cur."' and '".$cur."'";
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
 $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
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
	$sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
				$subtotal =$subtotal + $result_login1['tot'];
			?>
            <tr>
            <td><?="Credit / Debit card -".$result_login1['bank_name']?></td>
            <td><?=number_format($result_login1['tot'],$_SESSION['be_decimal'])?></td>
            </tr>
		<?php	}
	  }
		$sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 			
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
			$sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
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
			$sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
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
			$sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
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
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
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
			 $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax");    
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
			}?>
            <tr>
                <td>Total Pax</td>
                <td><?=$qtycount?></td>
                </tr><?php
	  } ?>                                                   
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
    </tbody>
    </table>
<?php
}
else if(($_REQUEST['type']=="tax_sales_summary"))
{
	$string="";
    $strings="";
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
		if($bydatz!="null" && $bydatz!="")
	{
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
                                   <tr ><td colspan="2"><b>CASH SUMMARY</b></td></tr>
<?php
$final=0;
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
  $discount=0;
  $total_tax=0;
    $sql_login_cash  =  $database->mysqlQuery(" select  $string1_str as cash,sum( bm_roundoff_value) as roundoff FROM tbl_tablebillmaster tbm
    left join tbl_paymentmode pm ON pm.pym_id = tbm.bm_paymode where $string1 $string"); 
	$num_login_cash   = $database->mysqlNumRows($sql_login_cash);
	  if($num_login_cash){
            $result_login_cash  = $database->mysqlFetchArray($sql_login_cash); 
            $cash = $result_login_cash['cash'];
            $roundoff=$roundoff+$result_login_cash['roundoff'];
            if($cash!=0){
        ?>
           <tr >
          <td>CASH</td>
          <td><?=number_format($cash,$_SESSION['be_decimal'])?></td>        
            </tr>                                                            
        <?php
        }
          }
$sql_login_card  =  $database->mysqlQuery(" select bm_name as bank_name, $string2_str as card,sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster tbm left join tbl_paymentmode on tbm.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tbm.bm_transcbank and tbm.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tbm.bm_dayclosedate,tbm.bm_billtime ASC "); 
  $num_login_card   = $database->mysqlNumRows($sql_login_card);
	  if($num_login_card){
            while($result_login_card  = $database->mysqlFetchArray($sql_login_card)){ 
            $card1 = $card1+$result_login_card['card'];
            $card = $result_login_card['card'];
            $roundoff=$roundoff+$result_login_card['roundoff'];
           if($card!=0){
            ?>
           <tr >
          <td>CARD-<?=$result_login_card['bank_name']?></td>
          <td><?=number_format($card,$_SESSION['be_decimal'])?></td>
            </tr>                                                            
        <?php
           }
          } }
    $sql_login_coupon  =  $database->mysqlQuery(" select $string3_str as coupon, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
  $num_login_coupon   = $database->mysqlNumRows($sql_login_coupon);
	  if($num_login_coupon){
            $result_login_coupon  = $database->mysqlFetchArray($sql_login_coupon); 
            $coupon = $result_login_coupon['coupon'];
            $roundoff=$roundoff+$result_login_coupon['roundoff'];
            if($coupon!=0){
            ?>
           <tr >
          <td>COUPON</td>
          <td><?=number_format($coupon,$_SESSION['be_decimal'])?></td>
          </tr>                                                            
        <?php
            }
          }
      $sql_login_voucher  =  $database->mysqlQuery(" select $string4_str as voucher, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
      $num_login_voucher   = $database->mysqlNumRows($sql_login_voucher);
	  if($num_login_voucher){
            $result_login_voucher  = $database->mysqlFetchArray($sql_login_voucher); 
           $voucher = $result_login_voucher['voucher'];
            $roundoff=$roundoff+$result_login_voucher['roundoff'];
            if($voucher!=0){
            ?>
           <tr >
          <td>VOUCHER</td>
          <td><?=number_format($voucher,$_SESSION['be_decimal'])?></td>
         </tr>                                                            
        <?php
            }
          }    
          $sql_login_cheque  =  $database->mysqlQuery(" select $string5_str as cheque, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
      $num_login_cheque   = $database->mysqlNumRows($sql_login_cheque);
	  if($num_login_cheque){
            $result_login_cheque  = $database->mysqlFetchArray($sql_login_cheque); 
           $cheque = $result_login_cheque['cheque'];
            $roundoff=$roundoff+$result_login_cheque['roundoff'];
            if($cheque!=0){
            ?>
           <tr >
          <td>CHEQUE</td>
          <td><?=number_format($cheque,$_SESSION['be_decimal'])?></td>
         </tr>                                                            
        <?php
            }
          } 
          $sql_login_creditperson  =  $database->mysqlQuery(" select $string6_str as creditperson, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
           $num_login_creditperson   = $database->mysqlNumRows($sql_login_creditperson);
	  if($num_login_creditperson){
            $result_login_creditperson  = $database->mysqlFetchArray($sql_login_creditperson); 
           
            $creditperson = $result_login_creditperson['creditperson'];
            $roundoff=$roundoff+$result_login_creditperson['roundoff'];
            if($creditperson!=0){
            ?>
           <tr >
          <td>CREDIT PERSON</td>
          <td><?=number_format($creditperson,$_SESSION['be_decimal'])?></td>
         </tr>                                                            
        <?php
            }
          }
          
       $sql_login_complimentary  =  $database->mysqlQuery(" select $string7_str as complimentary, sum( bm_roundoff_value) as roundoff from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where  $string7 $string_pax order by bm_dayclosedate,bm_billtime ASC"); 
        $num_login_complimentary   = $database->mysqlNumRows($sql_login_complimentary);
	  if($num_login_complimentary){
            $result_login_complimentary  = $database->mysqlFetchArray($sql_login_complimentary); 
           $complimentary = $result_login_complimentary['complimentary'];
            if($complimentary!=0){
            ?>
           <tr >
          <td>COMPLIMENTARY</td>
          <td><?=number_format($complimentary,$_SESSION['be_decimal'])?></td>
         </tr>                                                            
        <?php
            }
          }
          $total=$cash+$card1+$coupon+$voucher+$cheque+$creditperson;
          if($total!=0){ ?>
         <tr>
                <td><strong>Total Summary</strong></td>
                <td><strong><?=number_format(($total),$_SESSION['be_decimal'])?></strong></td>
                </tr>  
          <?php }
          $sql_login_totsales  =  $database->mysqlQuery("select sum(bm_subtotal) as exclusivetax ,sum(bm_discountvalue) as discount, sum(bm_finaltotal) as final, sum(bm_tax_exempt) as taxexempt,sum(bm_roundoff_value) as roundoff1 FROM tbl_tablebillmaster bm where $string"); 
            $num_login_totsales   = $database->mysqlNumRows($sql_login_totsales);
            if($num_login_totsales){
              $result_login_totsales  = $database->mysqlFetchArray($sql_login_totsales); 
              $final = $result_login_totsales['final']; 
              $final_exclusive_tax = $result_login_totsales['exclusivetax'];
              $tax_exempt=$result_login_totsales['taxexempt'];
              $roundoff1=$result_login_totsales['roundoff1'];
              $discount=$result_login_totsales['discount'];
              $final_exclusive_tax=$final_exclusive_tax-$discount;
            } ?>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                </tr>              
 <tr><td colspan="2"><b>TAX SALES SUMMARY</b></td></tr>
	<?php if($final_exclusive_tax!=0){ ?>
       <tr >
          <td>SALES EXCL.TAX</td>
          <td><?=number_format($final_exclusive_tax,$_SESSION['be_decimal'])?></td>
         </tr> 
          <?php }
          if($tax_exempt!=0){ ?>
            <tr >
                <td>SALES TAX EXEMPT</td>
                <td><?=number_format($tax_exempt,$_SESSION['be_decimal'])?></td>
            </tr> 
            <?php
            }
            $sql_login_tax  =  $database->mysqlQuery("select sum(etm.bem_total_value) as totax_single ,etm.bem_label  
                    FROM tbl_tablebillmaster tbm left join tbl_tablebill_extra_tax_master etm on etm.bem_billno = tbm.bm_billno 
                    where $string group by etm.bem_taxid"); 
	  $num_login_tax   = $database->mysqlNumRows($sql_login_tax);
	  if($num_login_tax){  
             while($result_login_tax  = $database->mysqlFetchArray($sql_login_tax)) 
			{   
              $total_tax_single = $result_login_tax['totax_single'];
              $label= $result_login_tax['bem_label'];
             if($total_tax_single!=0){
                 $total_tax=$total_tax+$total_tax_single;
                      ?>
                <tr>
                    <td><?= $label?></td>
                    <td><?= number_format($total_tax_single,$_SESSION['be_decimal']) ?></td>
                </tr>   
                <?php                     
             }   } }             
              if($roundoff1!=0){
              ?>
            <tr >
                <td>ROUND OFF</td>
                <td><?=number_format($roundoff1,$_SESSION['be_decimal'])?></td>
            </tr>            
            <?php
              }          
             if($final!=0){
              ?> 
            <tr>
                <td><strong>SALES INCL.TAX</strong></td>
                <td><strong><?=number_format(($final_exclusive_tax-$tax_exempt+$total_tax+$roundoff1),$_SESSION['be_decimal'])?></strong></td>
                </tr>
             <?php
             }
             ?>               
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>         
            </tbody>
            </table>
    <?php
}
else if(($_REQUEST['type']=="regenerate_bill_logs"))
{		
	$string="";
	$reporthead="";
	$st="";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			 $string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);				
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
	else 
	{
		$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!="")
	{
	if($bydatz=="Last5days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_billdate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($bydatz=="Yesterday")
			  {
				  $string.=" bm.bm_billdate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
$reporthead=$st;
	}
else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
	} ?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                                  	<th colspan="9">Report- <?=$reporthead;?></th>
                                  </tr>                                
									<tr>
                                    <th class="sortable">Sl No</th>
                                      <th class="sortable">Bill No</th>
                                     <th class="sortable">First Bill Amount</th>                                     
                                     <th class="sortable">New Bill Amount</th>
                                      <th class="sortable">Date</th>
                                     <th class="sortable">Staff Name</th>
                                    <th class="sortable">Reason</th>
                                    <th class="sortable">Loggined By</th>
                                     <th class="sortable">Order No</th>
									</tr>
								  </thead>
								  <tbody>
 <?php
$sql_login  =  $database->mysqlQuery("select bm.bm_billdate,bm.bm_finaltotal,bm.bm_billno,r.re_new_bill_no,r.re_billno,r.re_amount,
r.re_order_no,DATE(r.re_datetime) AS Date, s.ser_firstname,r.re_reason,r.re_loginid from tbl_regenrate_log r 
left join tbl_staffmaster s on r.re_staffid=s.ser_staffid left join tbl_tablebillmaster bm on bm.bm_billno=r.re_billno where $string
 order by r.re_billno  ASC ");
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1; $before_regen=0;$after_regen=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$before_regen=$before_regen+$result_login['re_amount'];
                                $after_regen=$after_regen+$result_login['bm_finaltotal'];
	 ?>
    						<tr >
                            <td><?=$i?></td>
                             <td><?=$result_login['re_billno'];?></td>
                             <td><?=number_format($result_login['re_amount'],$_SESSION['be_decimal']);?></td>                          
                             <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal']);?></td>
                               <td><?=$result_login['bm_billdate']?></td>
                               <td><?=$result_login['ser_firstname'];?></td>
				<td><?=$result_login['re_reason'];?></td>
                              <td><?=$result_login['re_loginid'];?></td>
                              <td><?=$result_login['re_order_no'];?></td>
                              </tr>                             
                              <?php $i++;}  ?>
                              <tr >
                                  <td><strong>Total</strong></td>
                                  <td></td>
                                  <td><strong><?=number_format($before_regen,$_SESSION['be_decimal']) ?></strong></td>
                                  <td></td>  
                                  <td><strong><?=number_format($after_regen,$_SESSION['be_decimal']) ?></td>                                 
                                    <td></td>                                 
				    <td></td>
                                    <td></td>
                                    <td></td>
                                    </tr> 
                              <tr >
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                              </tr> <?php } else { ?>
									<tr><td colspan="9" style="color:red;font-weight: bold;">No Records to Display</td></tr>
							  <?php   } ?>
                           </tbody>
                            </table>
<?php                                           
}
else if(($_REQUEST['type']=="no_sale_report"))
{	
	$string="";
	$reporthead="";
	$st="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " o.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "o.ter_dayclosedate between '".$from."' and '".$to."' ";		
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " o.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else
		{
		$cur=date("Y-m-d");
		$string.="o.ter_dayclosedate='".$cur."'";
		$reporthead="On ".$database->convert_date($cur);	
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
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
		$st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="o.ter_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";			  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  o.ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$st="Last 1 month";
	}
	else if($bydatz=="Last90days")
	{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
	else if($bydatz=="Last365days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
$reporthead=$st;
	}
else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " o.ter_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}	
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" o.ter_dayclosedate='".$cur."'";
		$reporthead="On ".$database->convert_date($cur);
	}  ?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                   <tr>
                                  	<th colspan="4">Report- <?=$reporthead;?></th>                              
                                  </tr>                                
									<tr>
                                    <th class="sortable">Sl No</th>
                                      <th class="sortable">Main Category Name</th>                                   
                                      <th class="sortable">Sub Category Name</th>
                                     <th class="sortable">Menu Name</th>                                   
									</tr>
								  </thead>
								  <tbody>
<?php
$sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,sc.msy_subcategoryname,m.mr_menuname 
FROM tbl_menumaster m 
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
                            } ?>
    						<tr >
                            <td><?=$i?></td>
                             <td><?=$category ?></td>
                               <td><?=$result_login['msy_subcategoryname'];?></td>
                               <td><?=$result_login['mr_menuname'];?></td>                             
                              </tr> 
                             <?php $i++;} } else { ?>
							<tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
							<?php } ?>
                            </tbody>
                            </table>
 <?php
}
else if($_REQUEST['type']=="tot_sales_timely")
{
if(isset ($_REQUEST['flr']))
	{
		$reporthead="";
		$st="";
		$floorvalue=$_REQUEST['floorvalue'];
		$string="";
		if($floorvalue!="")
	{
		$string.=" bm_status='Closed' AND ";
		$string.=" bm_floorid='".$floorvalue."' AND ";
	}
		else
		{
			$string="bm_status='Closed' AND " ;
		}
		 if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$bydate=$_REQUEST['bydate'];
			$from=($_REQUEST['from']);			
			$to=($_REQUEST['to']);		
			$string.= "bm_billtime  between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."'   ";
	}
	 else if ($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$bydate=$_REQUEST['bydate'];	
			$from=$_REQUEST['from'];
			 $to = date('H:i');			
			$string.= "bm_billtime  between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."' ";			
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$bydate=$_REQUEST['bydate'];	
			$from = date('H:i');
			$to=$_REQUEST['to'];
			$string.= "bm_billtime  between '".$from."' and '".$to."' and bm_billdate  = '".$bydate."' ";		
		}
		else
		{
			$bydate=$_REQUEST['bydate'];
			$from = date('H:i');
			$to = date('H:i');
			$string.= " bm_billtime  between '".$from."' and '".$to."'  and bm_billdate  = '".$bydate."' ";	
		}	
	}
	else if(isset($_REQUEST['set']))
	{
	$string="";
	$string.=" bm_status='Closed' AND ";
	$reporthead="";
	$st="";
		$floorz=$_REQUEST['floorz'];
		if($floorz!="")
	      {
		$string.=" bm_floorid='".$floorz."' AND ";
	      }
		else
		{
		}
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$bydate=$_REQUEST['bydate'];
			$from=($_REQUEST['fromdt']);
			$to=($_REQUEST['todt']);
			 $string.= " bm_billtime between '".$from."' and '".$to."'  and bm_billdate  = '".$bydate."'    ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$bydate=$_REQUEST['bydate'];
			$from=($_REQUEST['fromdt']);
		$to = date('H:i');
			$string.= " bm_billtime between '".$from."' and '".$to."'  and bm_billdate  = '".$bydate."'  ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$bydate=$_REQUEST['bydate'];
			$from = date('H:i');
			$to=($_REQUEST['todt']);
			$string.= " bm_billtime between '".$from."' and '".$to."'  and bm_billdate  = '".$bydate."'  ";
		}
	}
	
	else
	{
		$bydate=$_REQUEST['bydate'];
		$string=" bm_status='Closed' AND ";
		$cur = date('H:i');
		$string.=" bm_billtime='".$cur."'  and bm_billdate  = '".$bydate."' ";
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
                                    <th class="sortable">Slno</th>                              
									  <th class="sortable">Bill No</th>
                                          <th class="sortable">Bill Time</th>
                                      <th class="sortable">Table</th>
                                      <th class="sortable">Sub Total</th>
                                      <?php if($servicetax_stats=='Y'){ ?>
                                      <th class="sortable"><?=$taxname1?></th>
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
  $srvtx=0;
  $subtotal=0;
  $sql_login  =  $database->mysqlQuery("select bm_finaltotal,bm_amountpaid,bm_amountbalace,bm_discountvalue,bm_servicetax,bm_subtotal,
  bm_dayclosedate,bm_billno,bm_billtime,bm_tableno
   from tbl_tablebillmaster where $string order by bm_billdate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			$dsc=$dsc + $result_login['bm_discountvalue'];
			$srvtx=$srvtx + $result_login['bm_servicetax'];
			$subtotal=$subtotal + $result_login['bm_subtotal'];
	 ?>
    						<tr >
                            <td><?=$i?></td>
                            <!-- <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>-->
                               <td><?=$result_login['bm_billno']?></td>                             
                               <td><?=$result_login['bm_billtime']?></td>
                               <td><?=$result_login['bm_tableno']?></td>
                               <td><?=number_format($result_login['bm_subtotal'],$_SESSION['be_decimal'])?></td>
                                <?php if($servicetax_stats=='Y'){ ?>
                               <td><?=number_format($result_login['bm_servicetax'],$_SESSION['be_decimal'])?></td>
                               <?php }?>
                               <td><?=number_format($result_login['bm_discountvalue'],$_SESSION['be_decimal'])?></td>                             
                              <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['bm_amountbalace'],$_SESSION['be_decimal'])?></td>
                              </tr> 
                           <?php $i++;} } ?>                                            
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
     <?php if($servicetax_stats=='Y'){ ?>
    <td >&nbsp;</td>
    <?php } ?>
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
    <td ><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
     <?php if($servicetax_stats=='Y'){ ?>
     <td ><strong><?=number_format($srvtx,$_SESSION['be_decimal'])?></strong></td>
     <?php } ?>
    <td ><strong><?=number_format($dsc,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
     </tbody>
</table>
 <?php
}
else if($_REQUEST['type']=="summary_ham")
{
	$string="";
	$strin="";
	$reporthead="";
	$strngs=" ter_status='Closed' AND ";
	$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_finaltotal) ";
	$string6_str=" sum(bm_finaltotal)";
		$string7_str=" sum(bm_finaltotal)";
	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
		$string1 =$strings. " pym_code='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
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
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) "; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
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
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$string_pax.= "bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
		$st= " Last 15 days ";
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
			$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day";
		$string_pax.= "bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
		$strin.=" ter_dayclosedate = CURDATE() - INTERVAL 1 day";
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
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
				$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
				$string_pax.= "  bm_dayclosedate   between '".$from."' and '".$to."'";
	}
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
		$strin.=" ter_dayclosedate='".$cur."'";
		$string_pax.= " bm_dayclosedate  between '".$cur."' and '".$cur."'";
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
$sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
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
				$sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_login1   = $database->mysqlNumRows($sql_login1);
	  if($num_login1){
		  while($result_login1  = $database->mysqlFetchArray($sql_login1)) 
			{ 
				$subtotal =$subtotal + $result_login1['tot'];
			?>
            <tr>
            <td><?="Credit / Debit card -".$result_login1['bank_name']?></td>
            <td><?=number_format($result_login1['tot'],$_SESSION['be_decimal'])?></td>
            </tr>
		<?php	}
	  }
	$sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$cpn='';	
			if($result_login['tot'] != "")	{
				$subtotal =$subtotal + $result_login['tot'];
				$cpn=$result_login['tot'];
			}else
			{
				$cpn=0;
			} ?>
          <tr >
          <td>Coupons</td>
          <td><?=number_format($cpn,$_SESSION['be_decimal'])?></td>
            </tr> 
            <?php
			} }
			$sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			$vch='';
				if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
			$vch=$result_login['tot'];
			}else
			{
				$vch=0;
			}
			?>
          <tr >
          <td>Voucher</td>
          <td><?=number_format($vch,$_SESSION['be_decimal'])?></td>        
            </tr> 
            <?php  }}			
			$sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			$chq='';
			if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
			$chq=$result_login['tot'];
			}else
			{
				$chq=0;
			}
			?>
          <tr >
          <td>Cheque</td>
          <td><?=number_format($chq,$_SESSION['be_decimal'])?></td>        
            </tr> 
            <?php  }}
			$sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			$crdt=$result_login['tot'];
			if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
			$crdt=$result_login['tot'];
			}else
			{
				$crdt=0;
			}
			?>
          <tr >
          <td>Credits</td>
          <td><?=number_format($crdt,$_SESSION['be_decimal'])?></td>         
            </tr> 
            <?php  }}				
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			$cmp='';
			if($result_login['tot'] != "")
			{
			$subtotal =$subtotal + $result_login['tot'];
			$cmp=$result_login['tot'];
			}else
			{
				$cmp=0;
			}
			?>
          <tr >
          <td>Complimentary</td>
          <td><?=number_format($cmp,$_SESSION['be_decimal'])?></td>        
            </tr> 
            <?php  }}
$bev_tot=0;
	  	$sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) = 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) = 'COLD BEVERAGES')) ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['Total'] != "")
			{
				$bev_tot=$bev_tot+$result_login['Total'];
			?>
          <tr >
          <td>Beverage Sale</td>
          <td><?=number_format($result_login['Total'],$_SESSION['be_decimal'])?></td>         
            </tr> 
            <?php } }}
	  $food_tot=0;
	   	$sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), 1)))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) != 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) != 'COLD BEVERAGES')) ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['Total'] != "")
			{
				$food_tot=$food_tot+$result_login['Total'];
			?>
          <tr >
          <td>Food Sale</td>
          <td><?=number_format($result_login['Total'],$_SESSION['be_decimal'])?></td>        
            </tr> 
            <?php } }}			
			$tot_per=$food_tot+$bev_tot;
			$food_per=$food_tot/$tot_per*100;
			$bev_per=$bev_tot/$tot_per*100;
			?>
			  <tr >
          <td>Food Sale(%)</td>
          <td><?=number_format($food_per,$_SESSION['be_decimal'])?></td>
            </tr> 
             <tr >
          <td>Beverages Sale(%)</td>
          <td><?=number_format($bev_per,$_SESSION['be_decimal'])?></td>
            </tr> 
			<?php
			 $qtycount=0;
			$sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		$num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
			}?>
            <tr>
                <td>Total Pax</td>
                <td><?=$qtycount?></td>
                </tr><?php
	  }
			$bilcount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT count(bm_billno) as bills FROM `tbl_tablebillmaster` WHERE $string_pax"); 
		 $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$bilcount=$bilcount + $result_stw['bills'];
			}?>
            <tr>
                <td>No.Of Invoices</td>
                <td><?=$bilcount?></td>
                </tr><?php
	  }
	  $dsc=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_discountvalue) as tt  FROM tbl_tablebillmaster  WHERE $string_pax"); 
	$num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$dsc=$dsc + $result_stw['tt'];
			}?>
            <tr>
                <td>Total Discount</td>
                <td><?=number_format($dsc,$_SESSION['be_decimal'])?></td>
                </tr><?php
	  }?>
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
  </tbody>
  </table>
<?php	
}
else if(($_REQUEST['type']=="summary"))
{
	$string='';
	$print='';
	$from='';
	$to='';
	$typestring='';
	$string='';
        $reporthead="";
	$strings="bm_status='Closed' AND ";
	$string_pax="";
	$string_pax="bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
    $string4_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace))) ";
	$string5_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
	$string6_str=" (sum(bm_finaltotal) - (sum(bm_amountpaid)-sum(bm_amountbalace)))";
    $string7_str=" sum(bm_finaltotal)";
    $string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
	$string2 = " pym_code='credit'  AND ";//"credit"  bm_transactionamount <>''
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
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) "; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
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
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
		$string_pax.= " bm_dayclosedate  between '".$cur."' and '".$cur."'";
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
 $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
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
				$sql_login1  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from "
                                        . " tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b "
                                        . " where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name "
                                        . " order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
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
                              ?>
            <tr>
            <td>* <?=$result_logincredit['bnk']?></td>
            <td><?=number_format($result_logincredit['tot'],$_SESSION['be_decimal'])?></td>
            </tr>
		<?php
                              
                          }
                          }
          
          
	$sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
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
			$sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
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
			
			$sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
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
			$sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
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
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
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
			 $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax");    		   
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  
	  if($num_stw>0){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$qtycount=$qtycount + $result_stw['ct'];
			} 
			if($qtycount>0){?>
            <tr>
                <td>Total Pax</td>
                <td><?=$qtycount?></td>
                </tr><?php
	  } }
	if($subtotal>0) { ?>                                                       
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
  <?php } else {?>
	<tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
  <?php } ?>
                      </tbody>
                            </table>
<?php
}
else if(($_REQUEST['type']=="total_summary_details"))
{
	$string="";
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
		$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
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
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) "; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
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
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
		$string_pax.= " bm_dayclosedate  between '".$cur."' and '".$cur."'";
		$reporthead="On ".$database->convert_date($cur);	
	}
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  } ?>
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
                                    <th >Pax</th>
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
$sql = $database->mysqlQuery("select distinct(bm_dayclosedate) from tbl_tablebillmaster where $string_pax");
$num_row   = $database->mysqlNumRows($sql);
  if($num_row){
    while($result = $database->mysqlFetchArray($sql)){
       $total=0;
          $slno++;
        if($result != ""){
            echo "<tr><td>".$slno."</td><td>".$result['bm_dayclosedate']."</td>";
            $dt = " bm_dayclosedate='".$result['bm_dayclosedate']."'";
        } ?>
  <?php
  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$dt order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$result_login  = $database->mysqlFetchArray($sql_login);
		if($result_login['tot'] != "")	{                         
              $totalcash=$totalcash + $result_login['tot'];
              $total= $total + $result_login['tot'];            
			$subtotal =$subtotal + $result_login['tot']; ?>
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         <?php }else{
              echo "<td>--</td>";
          }}else{
              echo "<td>--</td>";
          }
$sql_login1  =  $database->mysqlQuery("select $string2_str as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$dt group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
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
$sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
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
      $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $dt order by bm_dayclosedate,bm_billtime ASC"); 	
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
	$sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
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
	$sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_credit_details tcd on tcd.cd_billno=tbl_tablebillmaster.bm_billno left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $strings $string6"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
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
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
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
          }}
            else{
              echo "<td>--</td>";
          }
			 $qtycount=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_totalpax) as ct FROM `tbl_tablebillmaster` WHERE $string_pax and $dt"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  $result_stw  = $database->mysqlFetchArray($sql_stw); 
                            $qtycount=$qtycount + $result_stw['ct'];
                            $totalpax = $totalpax + $result_stw['ct'];
			?>
           <td><?=$result_stw['ct']?></td>
                <?php
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
  <td colspan=""><strong><?=$totalpax?></strong></td>
  <td colspan=""><strong><?=number_format($subtotal,$_SESSION['be_decimal'])?></strong></td></tr>
  </tbody>
   </table>
<?php
}
else if(($_REQUEST['type']=="stewards_performance_report"))
{
        $stw = $_REQUEST['stwrd'];       
        if($tw!=''){
        $staff=" sm.ser_staffid='$stw' and ";
        }else{
           $staff=''; 
        }  
	$string="";
	$reporthead="";
	$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string_pax=" bm_status='Closed' AND ";
        $string1 = "";
	if(isset($_REQUEST['set']))
	{
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) "; 
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}	
		$bydatz=$_REQUEST['stewardbydate'];
		$st='';
	if($_REQUEST['stewardbydate']){	
	if($bydatz!="null")
	{
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
else
	{
		$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";
		$reporthead="On ".$database->convert_date($cur);	
	}
	?>
	<table class="table table-bordered table-font user_shadow" >							 
								  <thead>
                                  <tr>
                                 	<th colspan="4">Report - <?=$reporthead?></td>
                                  </tr>
									<tr>
                                 	<th >Sl No</th>
                                    <th >Date</th>
                                     <th >Bill Count</th>
                                      <th >Amount</th>
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
   $slno=0;
   $total_item = 0;
   $total_amount = 0;
echo "  "; 
$sql_login1  =  $database->mysqlQuery("select count(bm.bm_billno)as count,bm.bm_dayclosedate,sm.ser_staffid as stewardid ,UPPER(concat_ws('',sm.ser_firstname,' ',sm.ser_lastname)) as steward, sum(bm.bm_subtotal_final) as final 
FROM tbl_tablebillmaster bm left join tbl_staffmaster sm ON sm.ser_staffid = bm.bm_steward where sm.ser_staffid='$stw' and $strings $string 
group by bm.bm_steward, bm.bm_dayclosedate  order by bm.bm_finaltotal asc ");
                $num_login1   = $database->mysqlNumRows($sql_login1);
                if($num_login1>0){
                    $amnt = 0;
                    while($res = $database->mysqlFetchArray($sql_login1)){                       
                        $amnt = $amnt + $res['final'];
                        $slno++;                  
               $billcnt=$res['count'];                                
                    echo "<tr>";                        
                             echo "<td>".$slno."</td>";
                             echo "<td>".$res['bm_dayclosedate']."</td>";
                            echo "<td>".$billcnt."</td>";
                            echo "<td>".number_format($res['final'],$_SESSION['be_decimal'])."</td>";
                            $total_item = $total_item + $billcnt;
                            $total_amount = $total_amount + $res['final'];
                            echo "</tr>";
                   }                   
                ?>                        
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr class="main">
      <td colspan="2" ><strong>TOTAL</strong></td>
    <td ><strong><?=$total_item?></strong></td>
    <td ><strong><?=number_format($total_amount,$_SESSION['be_decimal'])?></strong></td>
  </tr><?php } else { ?>
		<tr><td colspan="4" style="color:red;font-weight: bold;">No Records to Display</td></tr>
	<?php } ?>

                           </tbody>
                            </table>
<?php
}
else if(($_REQUEST['type']=="discount_report"))
{
	$string="";
	$reporthead="";
	$st="";
	$string=" bm_status='Closed' AND bm_discountvalue<>'0.00' AND ";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";	
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
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
	}
	else if($bydatz=="Last30days")
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
				  $string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
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
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";			
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";	
	$reporthead="On ".$database->convert_date($cur);	
	} ?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                    	<th colspan="8">Report - <?=$reporthead?></th>                                                
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
  $discount=0;
  $sql_login  =  $database->mysqlQuery("select bm_finaltotal,bm_amountpaid,bm_amountbalace,bm_discountvalue,bm_dayclosedate,bm_billno,
  bm_subtotal from tbl_tablebillmaster where $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
           $discount=$discount+$result_login['bm_discountvalue'];
	 ?>
    						<tr >
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                               <td><?=$result_login['bm_billno']?></td>
                               <td><?=number_format($result_login['bm_subtotal'],$_SESSION['be_decimal'])?></td>
                               <td><?=number_format($result_login['bm_discountvalue'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['bm_amountbalace'],$_SESSION['be_decimal'])?></td>
                              </tr> 
<?php $i++;} } ?>                                                       
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
    <td ><strong>TOTAL</strong></td>
    <td ></td>
   <td ></td>
   <td ></td>
    <td ><strong><?=number_format($discount,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                           </tbody>
                            </table>
<?php
}
else if(($_REQUEST['type']=="bill_cancel"))
{
	$string="";
	$string="( b.bm_status= 'Cancelled' OR b.bm_status= 'Cancelled for Split')  AND ";
$reporthead="";
$st="";
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "b.bm_dayclosedate between '".$from."' and '".$to."' ";
        	 $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "b.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "b.bm_dayclosedate between '".$from."' and '".$to."' ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	else 
	{
		$bydatz=$_REQUEST['bydate'];
	if($bydatz!="null" && $bydatz!="")
	{
	if($bydatz=="Last5days")
	{
		$string.="b.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($bydatz=="Yesterday")
			  {
				  $string.=" b.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
				$st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  b.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" b.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
$reporthead=$st;
	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "b.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	} ?>
<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                               <th colspan="10">Report - <?=$reporthead?></th>   
                                </tr>
                                <tr>
                                    <th class="sortable" width="10px">Slno</th>
                                     <th class="sortable" width="100px" >Date</th>
					<th class="sortable" width="100px">Bill No</th>
                                        <th class="sortable" width="115px">Bill Generated Time</th>
                                        <th class="sortable" width="110px">Bill Cancelled Date&Time</th>
                                       <th class="sortable">Reason</th>
                                     <th class="sortable" width="100px">Final</th>
                                     <th class="sortable" width="20px">Paid</th>
                                       <th class="sortable" width="100px">Cancelled By</th>
                                        <th class="sortable" width="100px">Cancelled Login</th>
                                    </tr>
								  </thead>
								  <tbody>
<?php
 $final=0;
  $paid=0;
  $bal=0; 	
  $sql_login  =  $database->mysqlQuery("select DISTINCT b.bm_dayclosedate,b.bm_billno,b.ter_cancelledreason,b.bm_finaltotal,b.bm_billtime,b.bm_paymode,b.ter_cancelledlogin,b.bm_cancelled_date_time,s.ser_firstname,s.ser_lastname from tbl_tablebillmaster b left join tbl_staffmaster s on b.ter_cancelledby_careof=s.ser_staffid  where $string order by b.bm_dayclosedate"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login>0){$i=1; $cancelledreason="";
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
				$final=$final + $result_login['bm_finaltotal']; ?>
    						<tr >
                            <td ><?=$i?></td>
                             <td  ><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                               <td ><?=$result_login['bm_billno']?></td>
                                <td ><?=$result_login['bm_billtime']?></td>
                               <td ><?=$result_login['bm_cancelled_date_time']?></td>
                                 <td><?=$cancelledreason?></td>
                              <td ><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                             <!-- <td width="100px"><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                              <td width="100px"><?=number_format($result_login['bm_amountbalace'],$_SESSION['be_decimal'])?></td>-->
                              <td ><?=$paid?></td>
                              <td ><?=$result_login['ser_firstname'].' '.$result_login['ser_lastname']?></td>
                                <td ><?=$result_login['ter_cancelledlogin']?></td>                           
                              </tr> 
                          <?php $i++;}  ?>        
 <tr>
    <td >&nbsp;</td>
    <td>&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  <tr class="main">
    <td ></td>
   <td></td>
    <td ></td>
    <td ></td>
    <td ></td>
    <td ><strong>TOTAL</strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <!--<td ><strong><?=$paid?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>-->
    <td></td>
    <td></td>
    <td></td>
  </tr> <?php } else{?>
	<tr><td colspan="10" style="color:red;font-weight: bold;">No Records to Display</td></tr>
	<?php } ?>
 </tbody>
</table>
 <?php
}
else if(($_REQUEST['type']=="type_pay"))
{
$fields="";
	$reporthead="";
	$st="";
if(isset($_REQUEST['set']))
{
	if($_REQUEST['typepay']=="cash")
	{
			 $string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and b.bm_status='closed' and ((b.bm_amountpaid-b.bm_amountbalace) > 0) ";
			$fields="<th class='sortable'>Amount</th>";
	}else if($_REQUEST['typepay']=="credit")
	{
		$string = " pym_code='credit' and bm_transcbank <> '0' and bm_status='closed'   ";		
		$fields="<th class='sortable'>Bank</th>";
         $fields.="<th class='sortable'>Card Payment</th>";
	}else if($_REQUEST['typepay']=="coupons")
	{
		$string = " pym_code='coupon' and bm_status='closed' ";
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
		$string = " pym_code='voucher' and bm_status='closed'";
		$fields="<th class='sortable'>Voucher</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
		$string = " pym_code='cheque' and bm_status='closed'";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}
	//fromdt todt
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and bm_dayclosedate between '".$from."' and '".$to."' ";//order by bm_dayclosedate
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and bm_dayclosedate between '".$from."' and '".$to."' ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		
$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);		
}
	else if(isset($_REQUEST['abc']))
	{
		$paybydate=$_REQUEST['paybydate'];
			if($_REQUEST['typepay']=="cash")
	{
		 $string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and b.bm_status='closed' and ((b.bm_amountpaid-b.bm_amountbalace) > 0) ";
			$fields="<th class='sortable'>Amount</th>";
	}else if($_REQUEST['typepay']=="credit")
	{
		$string = " pym_code='credit' and bm_transcbank <>'0' and bm_status='closed'";
	        $fields="<th class='sortable'>Bank</th>";
                $fields.="<th class='sortable'>Card Payment</th>";	
	}else if($_REQUEST['typepay']=="coupons")
	{
		$string = " pym_code='coupon' and bm_status='closed'";
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
		$string = " pym_code='voucher' and bm_status='closed'";
		$fields="<th class='sortable'>Voucher</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
		$string = " pym_code='cheque' and bm_status='closed'";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}
			if($paybydate!="null")
	{
	if($paybydate=="Last5days")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";

$st="Last 5 days";
	}elseif($paybydate=="Last10days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($paybydate=="Last15days")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($paybydate=="Last20days")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($paybydate=="Last25days")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($paybydate=="Last30days")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($paybydate=="Today")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	else if($paybydate=="Yesterday")
			  {
				  $string.="and bm_dayclosedate = CURDATE() - INTERVAL 1 day";
				  	$st="Yesterday";
			  }
	else if($paybydate=="Last1month")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	$st="Last 1 month";
	}
else if($paybydate=="Last90days")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			$st="Last 3 months";
	}
else if($paybydate=="Last180days")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($paybydate=="Last365days")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
$reporthead=$st;
	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  and (bm_dayclosedate between '".$from."' and '".$to."' )  ";
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	}
	else if(isset($_REQUEST['pay']))
	{
	if($_REQUEST['typepay']=="cash")
	{
		$string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and b.bm_status='closed' and ((b.bm_amountpaid-b.bm_amountbalace) > 0) ";
		$fields="<th class='sortable'>Amount</th>";
	}else if($_REQUEST['typepay']=="credit")
	{
		$string = " pym_code='credit' and bm_transcbank <>'0' and bm_status='closed'";
		$fields="<th class='sortable'>Bank</th>";
       $fields.="<th class='sortable'>Card Payment</th>";	
	}else if($_REQUEST['typepay']=="coupons")
	{
		$string = " pym_code='coupon' and bm_status='closed'";
		$fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
			$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
		$string = " pym_code='voucher' and bm_status='closed'";
		$fields="<th class='sortable'>Voucher</th>";
			$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
		$string = " pym_code='cheque' and bm_status='closed'";
		$fields="<th class='sortable'>Cheque No</th>";
		$fields.="<th class='sortable'>Bank Name</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}
	$paybydate=$_REQUEST['paybydate'];
		if($paybydate!="null")
	{
		$st="";
	if($paybydate=="Last5days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($paybydate=="Last10days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($paybydate=="Last15days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($paybydate=="Last20days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($paybydate=="Last25days")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($paybydate=="Last30days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($paybydate=="Today")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
		else if($paybydate=="Yesterday")
			  {
				  $string.="and bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	else if($paybydate=="Last1month")
	{
		$string.="and bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
	
	else if($paybydate=="Last90days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) -  3 MONTH AND CURDATE( )";
 $st="Last 3 months";
	}
	else if($paybydate=="Last180days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
$st="Last 6 months";
	}
	else if($paybydate=="Last365days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
$st="Last 1 year";
	}
	$reporthead=$st;
	}
 
	}
	else
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string="bm_status='closed' ";
			$string.= " and (bm_dayclosedate between '".$from."' and '".$to."' )  ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
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
  $creditamount=0;
 $sql_login  =  $database->mysqlQuery("select bm_finaltotal,bm_amountpaid,bm_amountbalace,bm_transactionamount,bm_dayclosedate,
 bm_billno,bm_name,bm_couponamt,bm_couponcompany,bm_voucherid,bm_chequeno,bm_chequebankname from tbl_tablebillmaster b 
 LEFT JOIN tbl_bankmaster ON b.bm_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p 
 ON b.bm_paymode= p.pym_id where $string order by b.bm_billdate,b.bm_billtime asc");
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$paidcrdt=$paidcrdt + ($result_login['bm_amountpaid']-$result_login['bm_amountbalace']);
			$creditamount=$creditamount+$result_login['bm_transactionamount'];
	 ?>
     <tr >
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                               <td><?=$result_login['bm_billno']?></td>                       
                               <?php
								if($_REQUEST['typepay']=="cash")
								{ ?>
									   <td><?=number_format(($result_login['bm_amountpaid']-$result_login['bm_amountbalace']),$_SESSION['be_decimal'])?></td>
							<?php	
							}else if($_REQUEST['typepay']=="credit")
								{ ?>
                                    <td><?=$result_login['bm_name']?></td>
                                    <td><?=number_format($result_login['bm_transactionamount'],$_SESSION['be_decimal'])?></td>
                                  <?php								
								}else if($_REQUEST['typepay']=="coupons")
								{$coup=$coup + $result_login['bm_couponamt'];
									?>
                                    <td><?=$result_login['bm_couponcompany']?></td>
                                    <td><?=number_format($result_login['bm_couponamt'],$_SESSION['be_decimal'])?></td>
                                    <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                                    <?php
								}else if($_REQUEST['typepay']=="voucher")
								{
									?>
                                    <td><?=$result_login['bm_voucherid']?></td>
                                    <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                                    <?php
								}else if($_REQUEST['typepay']=="cheque")
								{
									?>
                                    <td><?=$result_login['bm_chequeno']?></td>
                                    <td><?=$result_login['bm_chequebankname']?></td>
                                    <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                                    <?php
								}
								?>                       
                               <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                              </tr> 
                              <?php $i++;} } ?>
   <tr>
    <td >&nbsp;</td>
    <?php
	if($_REQUEST['typepay']=="cash")
	  {  ?>
		  <td >&nbsp;</td>
                  <td >&nbsp;</td>
          <?php
	  }
	   else if($_REQUEST['typepay']=="credit")
	  { ?>
		  <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td>&nbsp;</td>
		  <?php
		  
	  }else if($_REQUEST['typepay']=="coupons")
	  { ?>
		  <td >&nbsp;</td>
		  <td >&nbsp;</td>
            <td >&nbsp;</td>
		  <?php
	  }else if($_REQUEST['typepay']=="voucher")
	  { ?>
		  <td >&nbsp;</td>
            <td >&nbsp;</td>
		  <?php
	  }else if($_REQUEST['typepay']=="cheque")
	  {  ?>
		  <td >&nbsp;</td>
		  <td >&nbsp;</td>
            <td >&nbsp;</td>
		  <?php
	  } ?>
    <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
    <td ></td>
     <?php
	 if($_REQUEST['typepay']=="cash")
	  { ?>
		  <td ><strong><?=number_format($paidcrdt,$_SESSION['be_decimal'])?></strong></td>
        <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></td>
          <?php
	  }
	   else if($_REQUEST['typepay']=="credit")
	  {  ?>
         <td></td>
		  <td ><?=number_format($creditamount,$_SESSION['be_decimal'])?></td>
                  <td><?=number_format($final,$_SESSION['be_decimal'])?></td>
		  <?php
	  }else if($_REQUEST['typepay']=="coupons")
	  { ?>
		  <td >&nbsp;</td>
		  <td><?=number_format($coup,$_SESSION['be_decimal'])?></td>
          <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
		  <?php
	  }else if($_REQUEST['typepay']=="voucher")
	  { ?>
		  <td >&nbsp;</td>
            <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
		  <?php
	  }else if($_REQUEST['typepay']=="cheque")
	  { ?>
		  <td >&nbsp;</td>
		  <td >&nbsp;</td>
           <td><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
		  <?php
	  } ?>    
  </tr>
   </tbody>
 </table>
 <?php
}
else if(($_REQUEST['type']=="item"))
{
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
           } ?>
    <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr>
      <th >Category</th>
       <th >Sub Category</th>
        <th>Items</th>
       <?php
        if( $floor=='' && $mode=='DI' ){
        $sql_login  =  $database->mysqlQuery("select fr_floorname from tbl_floormaster   "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){ $count_flr=0;
	while($result_login  = $database->mysqlFetchArray($sql_login)) 
	{
             $count_flr++;
        ?>
        <th >Floor - <?=$result_login['fr_floorname']?></th>
        <?php } } } else if($floor!='' && $mode=='DI' ){
            $sql_login  =  $database->mysqlQuery("select fr_floorname from tbl_floormaster where  fr_floorid='".$_REQUEST['floorvals']."' "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
	while($result_login  = $database->mysqlFetchArray($sql_login)) 
	{ ?>
     <th > Floor - <?=$result_login['fr_floorname']?></th>
        <?php }
        }} ?>
        <?php if($mode=='TA'){ ?>
       <th>Take Away</th>
         <?php } ?>      
         <?php if($mode=='CS'){ ?>
        <th >Counter Sale</th>
         <?php } ?>
      </tr>
    </thead>
     <tbody>
    <?php
	 $sql_cat  =  $database->mysqlQuery("select distinct(mr.mr_maincatid) as catid from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as my ON mr.mr_maincatid=my.mmy_maincategoryid where mr.mr_active='Y'  $string_condition  order by my.mmy_displayorder"); 
	$num_cat   = $database->mysqlNumRows($sql_cat);
	if($num_cat){$j=0;
		while($result_cat  = $database->mysqlFetchArray($sql_cat)) 
			{
				$j++;
				$menucat=$database->show_category_ful_details($result_cat['catid']);
				if($menucat['mmy_maincategoryname']!="")
				{
                   if($mode=='DI'){
                                    $col=$count_flr+2;
                                    }else{
                                        $col=$count_flr+3;
                                    }
					?>
					 <tr>
                                  	<td colspan="1" style="text-align:left; "><strong><?=$menucat['mmy_maincategoryname']?></strong></td>
                                  	<td <?php if($floor==''){ ?> colspan="<?=$col?>"  <?php } else{ ?>  colspan="3"   <?php } ?> style="text-align:left"></td>
                                  </tr>
                                  <?php
								  $sql_sub  =  $database->mysqlQuery("select distinct(mr_subcatid) as subid from tbl_menumaster where mr_active='Y'  and mr_maincatid='".$result_cat['catid']."' order by mr_maincatid"); 
				$num_sub  = $database->mysqlNumRows($sql_sub);
				if($num_sub){$k=0;
					while($result_sub  = $database->mysqlFetchArray($sql_sub)) 
						{$k++; 
							$menusub=$database->show_subcategory_ful_details($result_sub['subid']);
                                 if($mode=='DI'){
                                    $col1=$count_flr+1;
                                    }else{
                                        $col1=$count_flr+2;
                                    } ?> 
                                <tr>
                                  <td colspan="1" style="text-align:left"></td>
                                  <td colspan="1" style="text-align:left"><?=$menusub['msy_subcategoryname']?></td>
                                    <td  <?php if($floor==''){ ?> colspan="<?=$col1?>" <?php } else{ ?>  colspan="2"   <?php } ?>     style="text-align:left"> </td>
                                  </tr> 
                                  <?php
				$sql_menulist_dine= "select mr.mr_menuid,mr.mr_menuname from tbl_menumaster mr  WHERE  mr.mr_active='Y'   and  mr.mr_maincatid='".$result_cat['catid']."' and (mr.mr_subcatid='".$result_sub['subid']."' OR  mr.mr_subcatid IS NULL) $string_condition  order by mr.mr_subcatid ";
				$sql_menus  =  $database->mysqlQuery($sql_menulist_dine); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){$l=0;$old="";
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{$l++; 
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
                              $dinein=array();
                             $sql_menulist_din="SELECT mt.mmr_floorid,mt.mmr_rate,pm.pm_portionname,tun.u_name,tbun.bu_name FROM tbl_menuratemaster as mt LEFT JOIN tbl_portionmaster as pm ON pm.pm_id=mt.mmr_portion  left join tbl_unit_master tun on tun.u_id=mt.mmr_unit_id left join tbl_base_unit_master tbun on tbun.bu_id=mt.mmr_base_unit_id left join tbl_floormaster fm on fm.fr_floorid=mt.mmr_floorid    WHERE mt.mmr_menuid='".$result_menus['mr_menuid']."'  $floor ";//and mt.mta_portion='".$result_menus['pm_id']."'
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
							  $sql_menulist_tak="SELECT mt.mta_portion,mt.mta_rate,pm.pm_portionname,tun.u_name,tbun.bu_name FROM tbl_menuratetakeaway as mt LEFT JOIN tbl_portionmaster as pm ON pm.pm_id=mt.mta_portion  left join tbl_unit_master tun on tun.u_id=mt.mta_unit_id left join tbl_base_unit_master tbun on tbun.bu_id=mt.mta_base_unit_id   WHERE mt.mta_menuid='".$result_menus['mr_menuid']."' ";//and mt.mta_portion='".$result_menus['pm_id']."'
							  $sql_take=$database->mysqlQuery($sql_menulist_tak); 
							  $num_take  = $database->mysqlNumRows($sql_take);
								if($num_take)
								{
									$tak_portion="";$tak_rate="";
									while($result_take  = $database->mysqlFetchArray($sql_take)) 
									{
                                    $takeaway.=number_format($result_take['mta_rate'],$_SESSION['be_decimal'])."(".$result_take['pm_portionname']."".$result_take['u_name']."".$result_take['bu_name']."), ";
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
                                    $counter.=number_format($result_counter['mrc_rate'],$_SESSION['be_decimal'])."(".$result_counter['pm_portionname']."".$result_counter['u_name']."".$result_counter['bu_name']."), ";
									}
								} ?>
                            	  <tr>
                                  	<td colspan="1"></td>
                                  	<td colspan="1"></td>
                                        <td colspan="1" style="text-align:left"><?=$menuname?> </td>
                                    <?php if($mode=='DI' && $_REQUEST['floorvals']==''){
                                       for($i=1;$i<=$count_flr;$i++){ ?>
                                      <td colspan="1" style="text-align:left"><?= $dinein[$i]?></td>
                                       <?php } } ?>
                                    <?php if($mode=='DI' && $_REQUEST['floorvals']!='' ){
                                     for($p=0;$p<count($_REQUEST['floorvals']);$p++){ ?>
                                     <td colspan="1" style="text-align:left"><?=$dinein[$_REQUEST['floorvals']]?></td>
                                    <?php } }?>
                                   <?php if($mode=='TA'){ ?>
                                   <td colspan="1" style="text-align:left"><?=$takeaway?></td>
                                   <?php }  ?>
                                    <?php if($mode=='CS'){ ?>
                                  <td colspan="1" style="text-align:left"><?=$counter?></td>
                                  <?php } ?>
                                 </tr>
                                <?php } } ?>       
                <?php } } ?>
                 <?php			
		}
		}
	}else { ?>
<tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
	<?php }
	?>
         </tbody>
     </table>
    <?php
}
else if($_REQUEST['type']=="steward_timely")
{
	$stw=$_REQUEST['stwrd'];
	$string="";
	$reporthead="";
	$st="";
	 if(isset($_REQUEST['set']))
{
	$stewardbydate=$_REQUEST['stewardbydate'];
	if($_REQUEST['stwrd']!='')
	{
		$string.="tbl_tableorder.ter_staff =  '".$stw."' and   ";
	}
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$_REQUEST['fromdt'];
			$to=$_REQUEST['todt'];
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."'  ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$_REQUEST['fromdt'];
			 $to = date('H:i');
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."'  ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
				$from = date('H:i');
			$to=$_REQUEST['todt'];
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."'  )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
				$from = date('H:i');
			 $to = date('H:i');
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."'  and tbl_tableorder.ter_entrydate='".$stewardbydate."'  )  ";
		} 
$sql_stw  =  $database->mysqlQuery("Select sum(tbl_tableorder.ter_qty) as ct,tbl_menumaster.mr_menuname as menuname,tbl_tableorder.ter_entrytime From tbl_tableorder  left join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid left join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
}
else if(isset($_REQUEST['stwr']))
{
			$stewardbydate=$_REQUEST['stewardbydate'];
			if($_REQUEST['stwrd']!='')
	{
		$string.="tbl_tableorder.ter_staff =  '".$stw."'  and  ";
	}
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$_REQUEST['fromdt'];
			$to=$_REQUEST['todt'];
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."'  ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$_REQUEST['fromdt'];
			 $to = date('H:i');
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			 $from = date('H:i');
			$to=$_REQUEST['todt'];
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from = date('H:i');
			 $to = date('H:i');		
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' )  ";
		} 
	$sql_stw  =  $database->mysqlQuery("Select sum(tbl_tableorder.ter_qty) as ct,tbl_menumaster.mr_menuname as menuname,tbl_tableorder.ter_entrytime From tbl_tableorder  left join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid left join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
}else 
	{
	$stewardbydate=$_REQUEST['stewardbydate'];
			$from = date('H:i');
			 $to = date('H:i');
			$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and  tbl_tableorder.ter_entrydate='".$stewardbydate."'   )  ";
		$sql_stw  =  $database->mysqlQuery("Select sum(tbl_tableorder.ter_qty) as ct,tbl_tableorder.ter_entrytime,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  left join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid left join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	}	
	?>
<table class="table table-bordered table-font user_shadow" >
								  <thead>
                             <tr>
                                    <th class="sortable">Sl no</th>
                                     <th class="sortable">Item</th>
					<th class="sortable">Count</th>
                                        <th class="sortable">Entry Time</th>
									</tr>
								  </thead>
								  <tbody>
       <?php
	  $num_stw   = $database->mysqlNumRows($sql_stw);


	  if($num_stw>0){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				?>
                <tr>
                  <td colspan="1" style="text-align:left"><?=$i++?> </td>
                  <td colspan="1" style="text-align:left"><?=$result_stw['menuname']?></td>
                  <td colspan="1" style="text-align:left"><?=$result_stw['ct']?></td>
                 <td colspan="1" style="text-align:left"><?=$result_stw['ter_entrytime']?></td>
                </tr>
                <?php
			}
	  }
	  else{ ?>
		<tr>
            <td colspan="4" style="text-align:center;color:red;font-weight: bold;">No records to display</td>
	    </tr>
	 <?php }
	  ?>
      </tbody>
      </table>
      <?php	
}
else if(($_REQUEST['type']=="steward"))
{
	$stw=$_REQUEST['stwrd'];
	$string="";
	$reporthead="";
	$st="";
    $string1='';
      if($_REQUEST['stw_mode']=='Cancel'){
        $string .= "  bm.bm_status='Cancelled' ";
      }else{
        $string .= "  bm.bm_status='Closed' ";   
      }
	$stewardbydate=$_REQUEST['stewardbydate'];
	$string1.=" ch.ch_cancelledby_careof ='".$_REQUEST['stwrd']."' and ";                      
	if($stewardbydate!="null")
	{
	if($stewardbydate=="Last5days")
	{
        $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
		$string.=" and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
		$st="Last 5 days";
	}elseif($stewardbydate=="Last10days")
	{
        $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$string.=" and bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st="Last 10 days";
	}
	elseif($stewardbydate=="Last15days")
	{
        $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st="Last 15 days";
	}
	else if($stewardbydate=="Last20days")
	{
        $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st="Last 20 days";
	}
	else if($stewardbydate=="Last25days")
	{
        $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st="Last 25 days";
	}
	else if($stewardbydate=="Last30days")
	{
        $string1.= " ch.ch_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$string.="and bm.bm_dayclosedate   between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
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
		$string.=" and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
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
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ( bm.bm_dayclosedate  between '".$from."' and '".$to."' ) ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and ( bm.bm_dayclosedate between '".$from."' and '".$to."' ) ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ( bm.bm_dayclosedate  between '".$from."' and '".$to."' )  ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="" && ($stewardbydate=='' || $stewardbydate=='null' ))
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( bm.bm_dayclosedate between '".$from."' and '".$to."' )  ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
            $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		} 
	if($_REQUEST['steward_type']=='Detailed'){
    $sql_stw  =  $database->mysqlQuery("select m.mr_menuname  as menuname,sum(bd.bd_qty) as ct,sum((bd.bd_rate*bd.bd_qty)) as amnt
      FROM tbl_tablebilldetails bd
      left join tbl_tablebillmaster bm on bd.bd_billno = bm.bm_billno
      left join tbl_menumaster m on bd.bd_menuid = m.mr_menuid
      left join tbl_staffmaster sm ON sm.ser_staffid = bm.bm_steward
      where $string
      and  bm.bm_steward = '".$stw."'
      group by menuname  order by bm.bm_finaltotal asc");
    ?>
		<table class="table table-bordered table-font user_shadow" >
								  <thead>                                
                                  <tr>
                                	<th colspan="4">Report - <?=$reporthead?></th>  
                                  </tr>
                                  <tr>
                                    <th class="sortable">Sl No</th>
                                     <th class="sortable">Item</th>
                                     <th class="sortable">Count</th>
                                     <th class="sortable">Amount</th>                                     
									</tr>                                    
								  </thead>
								  <tbody>
       <?php
 	  $total_count = 0;
          $total_amount = 0;
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw>0){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
                      $total_count = $total_count + $result_stw['ct'];
                      $total_amount = $total_amount + $result_stw['amnt'];                    
				?>
                <tr>
                  <td colspan="1" style="text-align:center"><?=$i++?> </td>
                  <td colspan="1" style="text-align:center"><?=$result_stw['menuname']?></td>
                  <td colspan="1" style="text-align:center"><?=$result_stw['ct']?></td>
                  <td colspan="1" style="text-align:center"><?=number_format($result_stw['amnt'],$_SESSION['be_decimal'])?></td>
                </tr>
                <?php
			}
	  ?>
                <tr><td colspan="4"></td></tr>
                <tr>
                    <td colspan="2" style="text-align:center"><strong>TOTAL</strong></td>
                    <td colspan="1" style="text-align:center"><strong><?= $total_count ?></strong></td>
                    <td colspan="1" style="text-align:center"><strong><?= number_format($total_amount,$_SESSION['be_decimal']) ?></strong></td>
                 </tr>
<?php } else { ?>
	<tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
 <?php } ?>
      </tbody>
      </table>
      <?php  
}else{
    if($_REQUEST['stw_mode']=='Sale'){ ?>
    <table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                                	<th colspan="4">Report - <?=$reporthead?></th>  
                                  </tr>
                                  <tr>
                                    <th class="sortable">Sl no</th>
                                     <th class="sortable">Date</th> 
                                        <th class="sortable">Bills</th> 
                                      <th class="sortable"> Amount</th>                                 
									</tr>                                    
								  </thead>
								  <tbody>
      <?php    
	$sql_stw1  =  $database->mysqlQuery("select count(bm.bm_billno) as billcount,bm.bm_dayclosedate,sum(bm.bm_subtotal_final) as amt_new
        FROM   tbl_tablebillmaster bm where $string and  bm.bm_steward = '".$stw."' group by bm.bm_dayclosedate  ");
       $total_amount1 = 0; $total_amount12= 0;
	  $num_stw1   = $database->mysqlNumRows($sql_stw1);
	  if($num_stw1){$i=1;
		  while($result_stw1  = $database->mysqlFetchArray($sql_stw1)) 
			{
              $total_amount1 = $total_amount1 + $result_stw1['amt_new']; ?>
                <tr>
                  <td colspan="1" style="text-align:center"><?=$i++?> </td>
                  <td colspan="1" style="text-align:center"><?=$result_stw1['bm_dayclosedate']?></td>
                    <td colspan="1" style="text-align:center"><?=$result_stw1['billcount']?></td>
                      <td colspan="1" style="text-align:center"><?=number_format($result_stw1['amt_new'],$_SESSION['be_decimal'])?></td>
                 </tr>
                <?php
			}            
	  ?>
                <tr><td colspan="4"></td></tr>
                <tr>
                    
                    <td colspan="1" style="text-align:center"><strong>TOTAL</strong></td>
                    <td colspan="1" style="text-align:center"></td>
                      <td colspan="1" style="text-align:center"></td>
                          <td colspan="1" style="text-align:center"><strong><?= number_format($total_amount1,$_SESSION['be_decimal']) ?></strong></td>
                  </tr>
				  <?php } else { ?>
					<tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
				<?php } ?>
      </tbody>
      </table>
      <?php
}else if($_REQUEST['stw_mode']=='Cancel'){ ?>
    <table class="table table-bordered table-font user_shadow" >
								  <thead>                                 
                                  <tr>
                                	<th colspan="4">Report - <?=$reporthead?></th>  
                                  </tr>
                                 <tr>
                                    <th class="sortable">Sl no</th>
                                     <th class="sortable">Date</th> 
                                       <th class="sortable">Bills</th> 
                                      <th class="sortable"> Cancel Amount</th>                                    
									</tr>                                    
								  </thead>
								  <tbody>
      <?php    
	$sql_stw1  =  $database->mysqlQuery("select count(bm.bm_billno) as billcount,bm.bm_dayclosedate,sum(bm.bm_subtotal_final) as amt_new
        FROM   tbl_tablebillmaster bm  where $string and  bm.bm_steward = '".$stw."' group by bm.bm_dayclosedate  ");
       $total_amount1 = 0; $total_amount12= 0;
	  $num_stw1   = $database->mysqlNumRows($sql_stw1);
	  if($num_stw1){$i=1;
		  while($result_stw1  = $database->mysqlFetchArray($sql_stw1)) 
			{
             $total_amount1 = $total_amount1 + $result_stw1['amt_new'];
             ?>
                <tr>
                  <td colspan="1" style="text-align:center"><?=$i++?> </td>
                  <td colspan="1" style="text-align:center"><?=$result_stw1['bm_dayclosedate']?></td>
                    <td colspan="1" style="text-align:center"><?=$result_stw1['billcount']?></td>
                      <td colspan="1" style="text-align:center"><?=number_format($result_stw1['amt_new'],$_SESSION['be_decimal'])?></td>
                </tr>
                <?php
			}                
	  ?>
                <tr><td colspan="4"></td></tr>
                <tr>
                    <td colspan="1" style="text-align:center"><strong>TOTAL</strong></td>
                    <td colspan="1" style="text-align:center"></td>
                     <td colspan="1" style="text-align:center"></td>
                          <td colspan="1" style="text-align:center"><strong><?= number_format($total_amount1,$_SESSION['be_decimal']) ?></strong></td>
                </tr>
<?php }  else{ ?>
	<tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
	<?php } ?>
      </tbody>
      </table>
      <?php
}else{ ?>
    <table class="table table-bordered table-font user_shadow" >
								  <thead>                                
                                  <tr>
                                	<th colspan="4">Report - <?=$reporthead?></th>  
                                  </tr>
                                 <tr>
                                  <th class="sortable">Kot No</th> 
                                       <th class="sortable">Menu</th> 
                                      <th class="sortable"> Cancel Qty</th>
                                      <th class="sortable"> Amount</th>
									</tr>
                                  </thead>
								  <tbody>
     <?php     
     $tot1=0; $tot2=0;
     $sql_login  =  $database->mysqlQuery("Select t.ter_count_combo_ordering,cmb.cod_combo_pack_rate,t.ter_rate,ch.ch_dayclosedate,ch_kotno,ch.ch_entrydate,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,m.mr_menuname,t.ter_entrytime From tbl_tableorder_changes as ch  left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid left join tbl_combo_ordering_details cmb on cmb.cod_orderno=ch.ch_orderno   where  $string1 group by ch.ch_orderno,m.mr_menuname,t.ter_count_combo_ordering"); 
     $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ ?>
			<tr>
                  <td colspan="1" style="text-align:center"><?=$result_login['ch_kotno']?></td>
                    <td colspan="1" style="text-align:center"><?=$result_login['mr_menuname']?></td>
                      <td colspan="1" style="text-align:center"><?=$result_login['ch_cancelled_qty']?></td>                                           
                     <?php  if($result_login['ter_count_combo_ordering']=='' ){                       
                          $tot1=$tot1+($result_login['ch_cancelled_qty']*$result_login['ter_rate']);  
                         ?>
                      <td colspan="1" style="text-align:center"><?=  number_format(($result_login['ch_cancelled_qty']*$result_login['ter_rate']),$_SESSION['be_decimal'])?></td>  
                     <?php  }else{                        
                          $tot2=$tot2+($result_login['ch_cancelled_qty']*$result_login['cod_combo_pack_rate']);                           
                         ?>                      
                        <td colspan="1" style="text-align:center"><?=  number_format(($result_login['ch_cancelled_qty']*$result_login['cod_combo_pack_rate']),$_SESSION['be_decimal'])?></td>   
                 <?php  } ?>                
                </tr>  
<?php
   }

?>
<tr>                                
                                     <th class="">Total</th> 
                                       <th class=""></th> 
                                      <th class="">  </th>
                                      <th class=""><?=  number_format(($tot1+$tot2),$_SESSION['be_decimal'])?> </th>
									</tr>
<?php
}
else { ?>
<tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
<?php 
}}
}
}
	  else if($_REQUEST['type'] =="items_ordered_timely")
	  {
	$reporthead="";
	$st="";
	if(isset ($_REQUEST['flr']))
	{
		$floorval=$_REQUEST['floorval'];
		$string="";
		if($floorval!="")
	{
		$string="bm.bm_status='Closed' AND ";
		$string.="bm.bm_floorid='".$floorval."' ";
	}
		else
		{
			$string="bm.bm_status='Closed' " ;
		}
		 if($_REQUEST['time']!="" && $_REQUEST['time2']!="")
		{
			$from=$_REQUEST['time'];
			
			$to=$_REQUEST['time2'];
			if($string !="")
			{
			 $string.= " and bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";
			}
			else
			{
				$string.= "bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";
			}	
		}
	 else if ($_REQUEST['time']!="" && $_REQUEST['time2']=="")
		{	
			$from=$_REQUEST['time'];
			 $to = date('H:i');
				if($string !="")
			{
			$string.= "and bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."'  ";
			}
			else
			{
			$string.= "bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";
			}	
		}
		else if($_REQUEST['time']=="" && $_REQUEST['time2']!="")
		{
			$from = date('H:i');
			$to=$_REQUEST['time2'];
			if($string !="")
			{
			$string.= "and bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";
			}
			else
			{
			$string.= "bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";
			}	
		}
		else
		{			
		$from = date('H:i');
			 $to = date('H:i');
			if($string !="")
			{
			$string.= " and bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";
			}
			else
			{
				$string.= " bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['from']."' ";	
			}
		}
	}
	else if(isset($_REQUEST['set']))
	{
	$string="";
	
	$string="bm.bm_status='Closed' AND ";
if($_REQUEST['timeval']!="" && $_REQUEST['time_new']!="")
		{
			$from=$_REQUEST['timeval'];
			$to=$_REQUEST['time_new'];
			$string.= "  ( bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['entrydate']."' ) ";
		}
		else if($_REQUEST['timeval']!="" && $_REQUEST['time_new']=="")
		{
			$from=($_REQUEST['timeval']);
			 $to = date('H:i');
			$string.= "  ( bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['entrydate']."' ) ";
		}
		else if($_REQUEST['timeval']=="" && $_REQUEST['time_new']!="")
		{
			$from = date('H:i');		
			$to=($_REQUEST['time_new']);
		$string.= "  ( bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['entrydate']."' ) ";
		}else if($_REQUEST['timeval']=="" && $_REQUEST['time_new']=="")
		{
			 $from = date('H:i');
		 $to = date('H:i');
				$string.= "  ( bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['entrydate']."' ) ";
		}
			$floorval=$_REQUEST['floorval'];
			if($floorval !="")
			{
		if($string!="")
	{
		$string.=" and bm.bm_floorid='".$floorval."' ";
	}
		else
		{
			$string.="bm.bm_floorid='".$floorval."' ";
		}
			}
	}
	else
	{
	$string="";
	$string="bm.bm_status='Closed' AND ";
		 $from = date('H:i');
		 $to = date('H:i');
			$string.= "  ( bm.bm_billtime  between '".$from."' and '".$to."' and bm.bm_billdate='".$_REQUEST['entrydate']."' )  ";	
	}
	?>
		<table class="table table-bordered table-font user_shadow" >
								  <thead>                              
                                  <?php if($reporthead !="")
								  {?>
									  <tr>
                                  	<th colspan="8">Report - <?=$reporthead?></th>
                                  </tr>
								  <?php }?>
									<tr>
                                     <th class="sortable">Category</th>
					<th class="sortable">Sub category</th>
                                      <th class="sortable">Item</th>
                                            <th class="sortable">Entry Time</th>
                                      <th class="sortable">Portion</th>
                                      <th class="sortgable">Floor</th>
                                      <th class="sortable">Qty</th>
                                      <th class="sortable">Unit Price</th>
                                      <th class="sortable">Total</th>
									</tr>
								  </thead>
								  <tbody>
       <?php
 	  $sql_stw  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,bm.bm_billdate as entrydate,bm.bm_billtime as entrytime,m.mr_menuname,p.pm_portionname,f.fr_floorname,sum(bd.bd_qty) as qty,ROUND(avg(bd.bd_rate), 1) as Unit_Price, ((sum(bd.bd_qty))*(ROUND(avg(bd.bd_rate), 1))) as Total from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion  left join tbl_floormaster f on f.fr_floorid = bm.bm_floorid where $string group by m.mr_maincatid ,m.mr_subcatid,bd.bd_menuid,bd.bd_portion,bm.bm_floorid ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 
	$num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;$t=0;$old="";
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{$t++;
					 if($t==0)
							  {
								  $old=$result_stw['mmy_maincategoryname'];
								  $catname=$result_stw['mmy_maincategoryname'];
								  }else if($t>0)
							  {
								  if($result_stw['mmy_maincategoryname']==$old)
								  {
									  $catname="";								  
								  }else
								  {
									  $old=$result_stw['mmy_maincategoryname'];
									  $catname=$result_stw['mmy_maincategoryname'];
								  }
							  }	
				$final=$final + $result_stw['Total'];
				?>
                <tr>                
                  <td colspan="1" style="text-align:left"><strong><?=$catname?></strong></td>
                  <td colspan="1" style="text-align:left"><?=$result_stw['msy_subcategoryname']?></td>
                    <td colspan="1" style="text-align:left"><?=$result_stw['mr_menuname']?></td>
                   <!--   <td colspan="1" style="text-align:left"><?=$result_stw['entrydate']?></td>-->
                        <td colspan="1" style="text-align:left"><?=$result_stw['entrytime']?></td>
                    <td colspan="1" style="text-align:left"><?=$result_stw['pm_portionname']?></td>
                      <td colspan="1" style="text-align:left"><?=$result_stw['fr_floorname']?></td>                   
                      <td colspan="1" style="text-align:left"><?=$result_stw['qty']?></td>
                      <td colspan="1" style="text-align:left"><?=number_format($result_stw['Unit_Price'],$_SESSION['be_decimal'])?></td>                  
               <td colspan="1" style="text-align:left"><?=number_format($result_stw['Total'],$_SESSION['be_decimal'])?></td>
                    <!--<td colspan="1" style="text-align:left"><?=$result_stw['mmy_maincategoryname']?></td>
                      <td colspan="1" style="text-align:left"><?=$result_stw['msy_subcategoryname']?></td>-->
                </tr>
                <?php
			}?>
			<tr>
			  <td colspan="1" style="text-align:left"><strong>Total</strong>
         </td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td></td>
           <td><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
			</tr>
	 <?php }
	  ?>
      </tbody>
      </table>
      <?php
}
else if($_REQUEST['type']=="order")
{	
        $string="";
		$string.="bm.bm_status = 'Closed'";
        $string_addon="";
        $stringta_addon="";
    if($_REQUEST['addon']=='N')
	{
        $string_addon.=" and bd.bd_bill_addon_slno IS NULL "; 
    }
    else if($_REQUEST['addon']=='Y')
	{
        $string_addon.=" and bd.bd_bill_addon_slno IS NOT NULL";   
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
            }
            else
            {
			$from=date("Y-m-d");
	        $to=date("Y-m-d");
	        $string.= " and bm.bm_dayclosedate between '".$from."' and '".$to."' ";               
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);              
            }
                $reporthead=$st;
	} ?>
    	<table class="table table-bordered table-font user_shadow" id="myTable">
				<thead>                                
                    <?php if($reporthead !="")
					{?>
                        <tr>
                            <th colspan="8">Report - <?=$reporthead?></th>
                        </tr>
					<?php }?>
                        <tr>
                            <th class="sortable">Sl no</th>                                       
                            <th class="sortable">Category</th>
							<th class="sortable">Sub category</th>
                            <th class="sortable">Item</th>
                            <th class="sortable">Unit Type</th>
                            <th class="sortable">Portion/Weight</th>
                            <th class="sortable">Qty</th>
                            <th class="sortable">Total</th>
                    	</tr>
				</thead>
				<tbody>             
       <?php
        $final=0;
        $qty=0;
        $qty_final=0;
        $sql_stw  =  $database->mysqlQuery(" select mc.mmy_maincategoryname as maincategory, sc.msy_subcategoryname as subcategory,bd.bd_menuid as menuid,mm.mr_menuname as menuname, bd.bd_rate_type as rate_type,
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
                                        group by bd.bd_menuid,bd.bd_portion,bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight  order by maincategory,menuid");
        
		$num_stw   = $database->mysqlNumRows($sql_stw);
        if($num_stw){$i=0;$t=0;$old_cat=""; $old_menu='';$unit_type='';$p=0;
        $catname='';$subcatname=''; $menuname='';$total=0;$qty=0;
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
                            $qty=$result_stw['qty'];
                            $weight=$result_stw['weight'];                          
                            if($result_stw['portionid']!=''){
                              $weight='';
                              $unit=$result_stw['portionname'] ;
                              $unit_type=$result_stw['rate_type'] ;
                            }
                            else
							{
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
                                   $weight_loose=$weight_loose+ ($result_stw['weight']*$result_stw['qty']);                                 
                                   $t=$i-1;
                                   $final=$final-$loose_total;
                                   $loose_total=$loose_total+ $result_stw['total'];                                  
                                   echo '<script>                                                                        
                                        document.getElementById("'.$t.'").style.display="none";                                     
                                        </script>';
                                   $p=$p-1;                                  
                                }else{
                                    $old_menu=$result_stw['menuid'];
                                    $weight_loose=$result_stw['weight']*$result_stw['qty'];
                                    $loose_total=$result_stw['total'];
                                }                              
                                $weight=$weight_loose;
                                $total=$loose_total;
                                $qty='';                               
                            } ?>
                <tr id="<?=$i?>">
                    <td colspan="1" style="text-align:center"><?=$p?></td>
                    <td colspan="1" style="text-align:center"><strong><?=substr(strtoupper($catname),0,20)?></strong></td>
                    <td colspan="1" style="text-align:center"><?=strtoupper($subcatname)?></td>
                    <td colspan="1" style="text-align:center"><?=substr(strtoupper($menuname),0,25)?></td>
                     <td colspan="1" style="text-align:center"><?=$unit_type?></td>
                    <td colspan="1" style="text-align:center"><?php if($weight != ''){ echo number_format(str_replace(',','',$weight),$_SESSION['be_decimal']).'  '.$unit;} else { echo $unit; }?></td>
                    <td colspan="1" style="text-align:center"><?=$qty?></td>
                    <td colspan="1" style="text-align:center"><?=number_format(str_replace(',','',$total),$_SESSION['be_decimal'])?></td>
                </tr>                      
   <?php
       $final=$final+$total;
                    if($qty!=''){
                        $qty_final=$qty_final+$qty;
                    }
                                }?>
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
            <tr>
		<td colspan="1" style="text-align:center"><strong>Total</strong></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><strong><?=$qty_final?></strong></td>
                <td><strong><?= number_format(str_replace(',','',$final),$_SESSION['be_decimal'])?></strong></td>
            </tr> 
			<?php } else{ ?>
				<tr><td colspan="8" style="color:red;font-weight: bold;">No Records to Dispaly</td></tr> <?php }?>
      </tbody>
      </table>
      <?php
}
else if(($_REQUEST['type']=="kitchen_wise"))
{
	$reporthead="";
	$st="";
	if(isset ($_REQUEST['flr']))
	{
        $menuitem = "";
		$floorval=$_REQUEST['floorval'];
		$string="";
		if($floorval!="")
                {
		$string="o.ter_status='Closed' AND ";
		$string.=" m.mr_kotcounter='".$floorval."' ";
                $menuitem=$_REQUEST['item'];
		if($menuitem !=""){
                    $string.=" and o.ter_menuid ='".$menuitem."' ";
                }
                }
		else
		{
			$string="o.ter_status='Closed' " ;
		}
	if($_REQUEST['bydt']!="null" )	 
		 {
		 $bydatz=$_REQUEST['bydt'];
	if($bydatz=="Last5days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
		}
		else
		{
		$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";	
		}
}elseif($bydatz=="Last10days")
	{
		if($string!="")
		{
		$string.="and o.ter_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		}
		else
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		}
	}
	elseif($bydatz=="Last15days")
	{
		if($string !="")
		{
		$string.=" and o.ter_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		}
		else
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		}
	}
	else if($bydatz=="Last20days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		}
		else
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		}
	}
	else if($bydatz=="Last25days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		}
		else
		{
			$string.="o.ter_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		}
	}
	else if($bydatz=="Last30days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		}
		else
		{
		$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		}
	}
	else if($bydatz=="Today")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}
		else
		{
			$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}	
	}
else if($bydatz=="Yesterday")
			  {
				  if($string !="")
				  {
				  $string.="and  o.ter_dayclosedate = CURDATE() - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";
				  }
				  else
				  {
					    $string.=" o.ter_dayclosedate  =CURDATE() - INTERVAL 1 day";
				  }
				  
			  }
	else if($bydatz=="Last1month")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		}
		else
		{
	$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		}
	}
else if($bydatz=="Last90days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
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
		$string.="and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
	}
else if($bydatz=="Last365days")
	{
		if($string !="")
		{
		$string.="and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		}
		else
		{
		$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		}	
	}
	}
	else if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);			
			$to=$database->convert_date($_REQUEST['to']);
			if($string !="")
			{
			$string.= " and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= "o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
		}
	 else if ($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			if($string !="")
			{
			$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
			$string.= "o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
				
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			if($string !="")
			{
			$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
			$string.= "o.ter_dayclosedate  between '".$from."' and '".$to."' ";
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
		}
	}
	else if(isset($_REQUEST['set']))
	{
	$string="";
	$string="o.ter_status='Closed' AND ";
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( o.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  ( o.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( o.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( o.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
			$floorval=$_REQUEST['floorval'];
			if($floorval !="")
			{
		if($string!="")
	{
		$string.=" and m.mr_kotcounter='".$floorval."' ";
	}	
		else
		{
			$string.="m.mr_kotcounter='".$floorval."' ";
		}           
                $menuitem=$_REQUEST['item'];
		if($menuitem !=""){
                    $string.=" and o.ter_menuid ='".$menuitem."' ";
                }
			}
	}
	else if(isset($_REQUEST['abc']))
	{
	$string="";
	$string="o.ter_status='Closed' AND ";
	$orderbydate=$_REQUEST['orderbydate'];
    if($orderbydate!="null")	
	{
	if($orderbydate=="Last5days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($orderbydate=="Last10days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($orderbydate=="Last15days")
	{
		$string.="  o.ter_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($orderbydate=="Last20days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($orderbydate=="Last25days")
	{
		$string.=" o.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($orderbydate=="Last30days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($orderbydate=="Today")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($orderbydate=="Yesterday")
			  {
				  $string.=" o.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	else if($orderbydate=="Last1month")
	{
		$string.="  o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
	else if($orderbydate=="Last90days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
		else if($orderbydate=="Last180days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
		else if($orderbydate=="Last365days")
	{
		$string.="  o.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
	$reporthead=$st;
	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " o.ter_dayclosedate   between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		$floorval=$_REQUEST['floorval'];
			if($floorval !="")
			{
		if($string!="")
                {
		$string.=" and m.mr_kotcounter='".$floorval."' ";
                }
		else
		{
			$string.="m.mr_kotcounter='".$floorval."' ";
		}
                $menuitem=$_REQUEST['item'];
		if($menuitem !=""){
                    $string.=" and o.ter_menuid ='".$menuitem."' ";
                }
			}
	}
	else
	{
	$string="";
	$string="o.ter_status='Closed' AND ";
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( o.ter_dayclosedate  between '".$from."' and '".$to."' )  ";			
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
	?>
   <table class="table table-bordered table-font user_shadow" >
								  <thead>                               
                                  <?php if($reporthead !="")
								  {?>
									  <tr>
                                  	<th colspan="8">Report - <?=$reporthead?></th>
                                  </tr>
								  <?php }?>
									<tr>
                                     <th class="sortable">Sl no.</th>
									  <th class="sortable">Kitchen</th>
                                      <th class="sortable">Item</th>
                                      <th class="sortable">Quantity</th>
                                      <th class="sortgable">Total</th>
									</tr>
								  </thead>
								  <tbody>
       <?php
     $slno = 0;  
     $total = 0;
     $qty = 0;
$sql_ktc  =  $database->mysqlQuery("select distinct(m.mr_kotcounter),k.kr_kotname from tbl_tableorder o
inner join tbl_menumaster m on m.mr_menuid = o.ter_menuid
inner join tbl_kotcountermaster k on k.kr_kotcode = m.mr_kotcounter where $string"); 
$num_ktc   = $database->mysqlNumRows($sql_ktc);
if($num_ktc){
  while($result_ktc  = $database->mysqlFetchArray($sql_ktc)) {
      $slno++;
    echo "<tr>";
    echo "<td>".$slno."</td>";
    echo "<td>".$result_ktc['kr_kotname']."</td>";
    echo "<td></td><td></td><td></td>";
    echo "<tr>";
$sql_itm  =  $database->mysqlQuery("select m.mr_kotcounter,o.ter_menuid, m.mr_menuname,sum(o.ter_qty) as qty, o.ter_rate*sum(o.ter_qty) as tot from tbl_tableorder o
inner join tbl_menumaster m on m.mr_menuid = o.ter_menuid
where m.mr_kotcounter = '".$result_ktc['mr_kotcounter']."' and $string group by o.ter_menuid");
          $num_itm   = $database->mysqlNumRows($sql_itm);
          if($num_itm){
            while($result_ktc  = $database->mysqlFetchArray($sql_itm)) {
                 echo "<tr>";
                 echo "<td></td><td></td>";              
                echo "<td>".$result_ktc['mr_menuname']."</td>";
                echo "<td>".$result_ktc['qty']."</td>";
                 echo "<td><strong>".$result_ktc['tot']."</strong></td>";
                echo "</tr>";
                $qty = $qty + $result_ktc['qty'];
                $total = $total + $result_ktc['tot'];
          }
          }
  }
}
       ?>
        <tr><td colspan="5"></td></tr>
         <tr><td><strong>TOTAL</strong></td><td></td><td></td><td><strong><?= $qty ?></strong></td>
		 <td><strong><?= number_format($total ,$_SESSION['be_decimal'])?></strong></td></tr>
      </tbody>
      </table>
      <?php
}
else if(($_REQUEST['type']=="type_order"))
{
	$reporthead="";
	$st="";
	$string="";
	$ordtype=$_REQUEST['ordtype'];
	if(isset($_REQUEST['abc']))
	{
	$ordertypebydate=$_REQUEST['ordertypebydate'];
	if($ordertypebydate!="null")
	{
		if($ordertypebydate=="select")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0DAY AND CURDATE( )";
$st="Today";
	}
		
	if($ordertypebydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	else if($ordertypebydate=="Yesterday")
			  {
				  $string.=" tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.="  tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
	else if($ordertypebydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st="Last 3 months";
	}
	else if($ordertypebydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
$st="Last 6 months";
	}
	else if($ordertypebydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
$st="Last 1 year";
	}
	$reporthead=$st;
	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
	}
	else if(isset($_REQUEST['typeord']))
	{
		$ordtype=$_REQUEST['ordtype'];
	$string="";
		$ordertypebydate=$_REQUEST['ordertypebydate'];
	if($ordertypebydate!="null")
	{
	if($ordertypebydate=="Last5days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($ordertypebydate=="Today")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($ordertypebydate=="Yesterday")
			  {
				  $string.="and tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
  $st="Last 1 month";
	}
	else if($ordertypebydate=="Last90days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
		  $st="Last 3 months";
	}
else if($ordertypebydate=="Last180days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
		 $st="Last 6 months";
	}
else if($ordertypebydate=="Last365days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		  $st="Last 1 year";
	}
$reporthead=$st;
	}
	else
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
		$reporthead=$st;
	}
$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where  tbl_tableorder.ter_type =  '".$ordtype."' $string Group By tbl_menumaster.mr_menuname order by ct DESC");	
	}
else
{
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
		}
$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
}?>
		<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                                	<th colspan="3">Report - <?=$reporthead?></th>                                  
                                  </tr>
									<tr>
                                    <th class="sortable">Sl no</th>
                                     <th class="sortable">Item</th>
									  <th class="sortable">Count</th>
									</tr>
								  </thead>
								  <tbody>
       <?php
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{ ?>
                <tr>
                  <td colspan="1" style="text-align:left"><?=$i++?> </td>
                  <td colspan="1" style="text-align:left"><?=$result_stw['menuname']?></td>
                  <td colspan="1" style="text-align:left"><?=$result_stw['ct']?></td>
                </tr>
                <?php
			}
	  }
	  ?>
      </tbody>
      </table>
      <?php
}
else if(($_REQUEST['type']=="portion_order"))
{
	$string="";
	$reporthead="";
	$st="";
	if(isset($_REQUEST['set']))
	{
	$prtn=$_REQUEST['portn'];
	if($prtn !="null")
	{
		if($string!="")
		{
			$string.=" and  tbl_tableorder.ter_portion  LIKE  '%" . $prtn ."%'";
		}else
		{
			$string.=" tbl_tableorder.ter_portion  LIKE  '%" . $prtn ."%'";
		}
	}
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}			
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";			
			}
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);		
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);			
		} 
		$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_portionmaster On tbl_tableorder.ter_portion = tbl_portionmaster.pm_id   where $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname,tbl_portionmaster.pm_portionname order by ct DESC");
	}
		else if(isset($_REQUEST['abc']))
	{
		$prtn=$_REQUEST['portn'];
		$portionbydate=$_REQUEST['portionbydate'];
	if($portionbydate!="null")
	{
		if($prtn !="null")
		{
	if($portionbydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($portionbydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
$st="Today";
	}
else if($portionbydate=="Yesterday")
			  {
				  $string.= "tbl_tableorder.ter_dayclosedate   = CURDATE() - INTERVAL 1 day";				
$st="Yesterday";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.="tbl_tableorder.ter_dayclosedate    between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
		  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_portionmaster On tbl_tableorder.ter_portion = tbl_portionmaster.pm_id where tbl_tableorder.ter_portion='".$prtn."'  and $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
$reporthead=$st;
	}
	else
	{
	if($portionbydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";

$st="Last 5 days";

	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($portionbydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	
	else if($portionbydate=="Yesterday")
			  {
				  $string.= "tbl_tableorder.ter_dayclosedate   =  CURDATE() - INTERVAL 1 day";
				  $st="	Yesterday";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.="tbl_tableorder.ter_dayclosedate    between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH  AND CURDATE( )"; 
				$st="Last 6 months";
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
				$st="Last 1 year";
	}	
			
		else
		{
			$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$st="Today";
		}
		$reporthead=$st;
		
	$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_portionmaster On tbl_tableorder.ter_portion = tbl_portionmaster.pm_id where  $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
	}
	}
	else
	{
			$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			 $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_portionmaster On tbl_tableorder.ter_portion = tbl_portionmaster.pm_id where   $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
			 	$st="Today";
				$reporthead=$st;
	}
	}
	
	
	else if(isset($_REQUEST['port']))
	{
		$prtn=$_REQUEST['portn'];
		$portionbydate=$_REQUEST['portionbydate'];
	if($portionbydate!="null")
	{
		if($prtn !="null")
		{
	if($portionbydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($portionbydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	else if($portionbydate=="Yesterday")
			  {
				  $string.= "tbl_tableorder.ter_dayclosedate   =  CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.="tbl_tableorder.ter_dayclosedate    between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
$reporthead=$st;
	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_portionmaster On tbl_tableorder.ter_portion = tbl_portionmaster.pm_id where   $string and tbl_tableorder.ter_portion='".$prtn."' Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
		}
		else
		{
				if($portionbydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($portionbydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
		else if($portionbydate=="Yesterday")
			  {
				  $string.= "tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.="tbl_tableorder.ter_dayclosedate    between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($portionbydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
	$reporthead=$st;
	$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_portionmaster On tbl_tableorder.ter_portion = tbl_portionmaster.pm_id where  $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
		}
	}
	  else
	  {
		  	$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$st="Today";
			$reporthead=$st;
			$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_portionmaster On tbl_tableorder.ter_portion = tbl_portionmaster.pm_id where $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
	  }
}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			 $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id where  $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);		 
	}
?>
		<table class="table table-bordered table-font user_shadow" >
								  <thead>                                
                                  <tr>
                             <th colspan="4">Report - <?=$reporthead?></th>                                    
                                  </tr>                       
									<tr>
                                    <th class="sortable">Sl no</th>
                                     <th class="sortable">Item</th>
									  <th class="sortable">Count</th>
                                   <th class="sortable"><?=$_SESSION['s_portionname']?></th>
									</tr>
								  </thead>
								  <tbody>
       <?php
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{ ?>
                <tr>
                  <td colspan="1" style="text-align:left"><?=$i++?> </td>
                  <td colspan="1" style="text-align:left"><?=$result_stw['menuname']?></td>
                  <td colspan="1" style="text-align:left"><?=$result_stw['ct']?></td>
                  <td colspan="1" style="text-align:left"><?=$result_stw['pm_portionname']?></td>
                </tr>
                <?php
			}
	  }
	  ?>
      </tbody>
      </table>
      <?php	
}
else if(($_REQUEST['type']=="cancel_history"))
{
	$string="";
	$reporthead="";
	$st="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string= " ch.ch_dayclosedate between '".$from."' and '".$to."'";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string= " ch.ch_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string= " ch.ch_dayclosedate between '".$from."' and '".$to."' ";
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
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" ch.ch_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" ch.ch_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($bydatz=="Yesterday")
			  {
				  $string.=" ch.ch_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  ch.ch_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.="ch.ch_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}
	$reporthead=$st;
	}
	else
	{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= "ch.ch_dayclosedate between '".$from."' and '".$to."' ";
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);		
	}
	}
	else
	{
		$cur=date("Y-m-d");
		$string=" ch.ch_dayclosedate='".$cur."'";
		$reporthead="On ".$database->convert_date($cur);	
	}
	?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                        	<th colspan="11">Report - <?=$reporthead?></td>          
                                  </tr>
									<tr>
                                    <th class="sortable">Slno</th>
                                     <th class="sortable">Date</th>
									  
                                     <th class="sortable">Order NO</th>
                                      <th class="sortable">KOT No</th>
                                      <th class="sortable">Menu</th>
                                     <th class="sortable">Qty</th>
                                     <th class="sortable">Kot Order Time</th>
                                     <th class="sortable">Kot Cancel Date&Time</th>
                                       <th class="sortable">Cancelled By</th>
                                         <th class="sortable">Cancelled login</th>
                                     <th class="sortable">Reason for cancellation</th>
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
  $sql_login  =  $database->mysqlQuery("Select  cr_reason,ch.ch_dayclosedate,ch_kotno,ch.ch_entrydate,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,ld.ls_username,m.mr_menuname,t.ter_entrytime From tbl_tableorder_changes as ch LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_cancelledby_careof left join tbl_logindetails as ld on ld.ls_username=ch.ch_cancelledlogin left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid left join tbl_cancellation_reasons on cr_id=ch.ch_cancelledreason where  $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login >0){ $i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{		
	 ?>
						<tr >
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['ch_dayclosedate'])?></td>
                           
                              <td><?=$result_login['ch_orderno']?></td>
                                <td><?=$result_login['ch_kotno']?></td>
                               <td><?=$result_login['mr_menuname']?></td>
<!--                              <td><?=$fuldet['mr_menuname']?></td>-->                          
                              <td><?=$result_login['ch_cancelled_qty']?></td>
                                <td><?=$result_login['ter_entrytime']?></td>
                              <td><?=$result_login['ch_entrydate']?></td>
                                 <td><?=$result_login['ser_firstname']?></td>
                                     <td><?=$result_login['ls_username']?></td>
                              <td><?=$result_login['cr_reason']?></td>
                               </tr> 
                             <?php $i++;} } else{?>                                              
 <tr>
    <td colspan="11" style="color:red;font-weight: bold;">No Records to Display</td>
  </tr> <?php } ?>
  </tbody>
  </table>
<?php
}
else if(($_REQUEST['type']=="kot_report"))
{
	$string="";
	$string=" tor.ter_status='Closed' AND ";
	$reporthead="";
	$st="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
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
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tor.ter_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";

$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tor.ter_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($bydatz=="Yesterday")
			  {
				  $string.=" tor.ter_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.=" tor.ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.="tor.ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			$st="Last 1 year";
	}
$reporthead=$st;
	}
	else
	{
	$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tor.ter_dayclosedate between '".$from."' and '".$to."' ";
	$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
	}
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" tor.ter_dayclosedate='".$cur."'";
	$reporthead="On ".$database->convert_date($cur);		
	}
	?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>
                               <th colspan="7">Report - <?=$reporthead?></th>   
                                  </tr>
                                  <tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Date</th>
                                     <th class="sortable">KOT NO</th>
									  <th class="sortable">Items</th>
                                      <th class="sortable">Portion</th>
                                      <th class="sortable">Quantity</th>
                                      <th class="sortable">Rate</th>
                                     </tr>
								  </thead>
								  <tbody>
<?php
$final=0;$sql_login  =  $database->mysqlQuery("select tor.ter_kotno,tor.ter_dayclosedate,mm.mr_menuname,tor.ter_qty,(tor.ter_rate * tor.ter_qty) as rate,pm.pm_portionname from tbl_tableorder as tor LEFT JOIN tbl_portionmaster as pm ON tor.ter_portion=pm.pm_id LEFT JOIN tbl_menumaster as mm ON tor.ter_menuid=mm.mr_menuid where $string order by tor.ter_dayclosedate,tor.ter_entrytime ASC"); 
$old='';$new='';
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final + $result_login['rate'];
				if($i==1)
				{
					$each=$each + $result_login['rate'];
					$old=$result_login['ter_kotno'];
					$new=$result_login['ter_kotno'];
					?>
                     <tr>
                   <td><?=$k++?></td>
                   <td><?=$database->convert_date($result_login['ter_dayclosedate'])?></td>
                   <td><?=$result_login['ter_kotno']?></td>
                   <td><?=$result_login['mr_menuname']?></td>
                    <td><?=$result_login['pm_portionname']?></td>
                   <td><?=$result_login['ter_qty']?></td>
                   <td><?=number_format($result_login['rate'],$_SESSION['be_decimal'])?></td>
                  </tr> 
                  <?php				  
				}else
				{
					$old=$new;
					$new=$result_login['ter_kotno'];					
					if($new==$old)
					{$each=$each + $result_login['rate'];
						?>
                     <tr>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td><?=$result_login['mr_menuname']?></td>
                       <td><?=$result_login['pm_portionname']?></td>
                       <td><?=$result_login['ter_qty']?></td>
                       <td><?=number_format($result_login['rate'],$_SESSION['be_decimal'])?></td>
                      </tr> 
                      <?php
					}else
					{ ?>
                         <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td ><b>Total</b></td>
                   <td></td>
                   <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  <?php $each=0;
				  $each=$each + $result_login['rate'];
				   ?>
                     <tr>
                   <td><?=$k++?></td>
                    <td><?=$database->convert_date($result_login['ter_dayclosedate'])?></td>
                   <td><?=$result_login['ter_kotno']?></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?></td>
                   <td><?=$result_login['ter_qty']?></td>
                   <td><?=number_format($result_login['rate'],$_SESSION['be_decimal'])?></td>
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
                   <td ><b>Total</b></td>
                   <td></td>
                    <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  <?php
     } ?>                                              
 <tr>
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
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
  </tr>
 </tbody>
</table>
<?php
}
else if(($_REQUEST['type']=="bill_details"))
{
	$reporthead="";
	$st="";
	$string="";
	$string=" bm.bm_status='Closed' AND ";
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
	if($bydatz=="Last5days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
		$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
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
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
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
	?>
	<table class="table table-bordered table-font user_shadow" >
		<thead>                              
            <tr>
                <th colspan="8">Report - <?=$reporthead?></th>
            </tr>                                
			<tr>
                <th class="sortable">Slno</th>
                <th class="sortable">Date</th>
                <th class="sortable">Bill NO</th>
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
  	$sql_login  =  $database->mysqlQuery("SELECT td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname,bm.bm_discountvalue from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno  WHERE $string $sort_string1 "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ $i=1;$k=1;$each=0;$dsc=0;
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
					?>
                <tr>
                   <td><?=$k++?></td>
                   <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                   <td><?=$result_login['bd_billno']?></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?></td>
                   <td><?=$result_login['bd_qty']?></td>
                   <td><?=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
                   <td></td>
                </tr> 
                <?php				  
				}else
				{
					$old=$new;
					$new=$result_login['bd_billno'];					
					if($new==$old)
					{$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']); ?>
                <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?></td>
                   <td><?=$result_login['bd_qty']?></td>
                   <td><?=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
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
				  $each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
				  $dsc=$dsc + ($result_login['bm_discountvalue']);
				  $dscfinal=$dscfinal+($result_login['bm_discountvalue']);
				   ?>
                <tr>
                   <td><?=$k++?></td>
                   <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                   <td><?=$result_login['bd_billno']?></td>
                   <td><?=$result_login['mr_menuname']?></td>
                   <td><?=$result_login['pm_portionname']?></td>
                   <td><?=$result_login['bd_qty']?></td>
                   <td><?=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
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
  </tr>    <?php } else { ?>
<tr><td colspan=8 style="color:red;font-weight: bold;">No Records to Display</td></tr>
  <?php } ?>                           
                           </tbody>
                            </table>                           
                            <?php
}
else if($_REQUEST['type']=="complementary_report")
{
	$string="";
	$string=" bm_status='Closed' AND bm_complimentary='Y' AND ";
	$reporthead="";
	$st="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
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
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
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
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate=  CURDATE() - INTERVAL 1 day";
				  	$st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";

	}
else if($bydatz=="Last90days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			$st="Last 1 year";
	}
	$reporthead=$st;
	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm_dayclosedate='".$cur."'";
	$reporthead="On ".$database->convert_date($cur);		
	}
	?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <tr>                              
                         	<th colspan="5">Report - <?=$reporthead?></td>                                       
                                  <tr>                                
									<tr>
                                    <th class="sortable">Slno</th>
                                     <th class="sortable">Bill Date</th>
									  <th class="sortable">Bill No</th>
                                      <th class="sortable">Amount</th>
                                      <th class="sortable">Remarks</th>
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
  $sql_login  =  $database->mysqlQuery("select bm_finaltotal,bm_billdate,bm_billno,bm_complimentaryremark from tbl_tablebillmaster where $string order by bm_dayclosedate ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final + $result_login['bm_finaltotal'];
	 ?>
    						<tr >
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['bm_billdate'])?></td>
                               <td><?=$result_login['bm_billno']?></td>
                             <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                               <td><?=$result_login['bm_complimentaryremark']?></td>                      
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
else if($_REQUEST['type']=="credit_details")
{
	$string="";
	  $reporthead="";
	  $st="";
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
	else if($_REQUEST['hidbydate'])
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
            $string.=" (bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day or tbm.tab_dayclosedate = CURDATE() - INTERVAL 1 day )";
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
	else
	{
		$cur=date("Y-m-d");
		$string.=" bm.bm_dayclosedat='".$cur."' and tbm.tab_dayclosedate = '".$from."'  ";
	$reporthead="On ".$database->convert_date($cur);	
	}
	?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>                         
                                  <?php if($reporthead !="") { ?>
                                    <tr>
                                        <th colspan="7"> <strong>Consolidated Credit Details Report - <?=$reporthead?></strong></td>   
                             <tr>    
                            <?php }?>                          
									<tr>
                                    <th class="sortable">Sl No</th>
                                     <th class="sortable">Mode</th>
                                     <th class="sortable">Party Name</th>
                                     <th class="sortable">Category</th>
					<th class="sortable">Bill No</th>
                                      <th class="sortable">Credit Amount</th>
                                       <th class="sortable">Bill Amount</th>                                  
									</tr>
								  </thead>
								  <tbody>									
                                          <?php										  
										if ($string !="")
										{
$nettotal=0;											$string="where $string";
$finaltotal=0;										}
 $final=0;
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $sql_login  =  $database->mysqlQuery("select cd_amount,cd_modeofentry,cd_billno,ly_firstname,crd_guestid,crd_staffid,
  ser_firstname,crd_roomid,rm_roomno,crd_corporateid,ct_corporatename from tbl_credit_master as c left join tbl_credit_details 
  as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster 
  as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join 
  tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  left join 
  tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno  $string  order by cd.cd_dateofentry ASC"); 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){ $i=1;$nettotal=0; $finaltotal=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final + $result_login['cd_amount'];
                                $modeofentry=$result_login['cd_modeofentry'];                                
                                if($modeofentry=='DI'){
                                    $sql_finaltotal  =  $database->mysqlQuery("select bm_finaltotal from tbl_tablebillmaster  where  bm_billno='".$result_login['cd_billno']."' "); 
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
	 ?>
    						<tr >
                            <td><?=$i?></td>
                            <td><?=$modeofentry?></td>
                           <td><?=$party?></td>
                          <td><?=$cat?></td>
                            <td><?=$result_login['cd_billno']?></td>                                      
                             <td><?=number_format($result_login['cd_amount'],$_SESSION['be_decimal'])?></td>
                                <td><?=number_format($finaltotal,$_SESSION['be_decimal'])?></td>                           
                              </tr> 
                              <?php  $i++;}  ?>                                          
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  <td>&nbsp;</td> 
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
    <td ></td>
    <td></td>
    <td ></td>
     <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
     <td><?=number_format($nettotal,$_SESSION['be_decimal'])?></td>
  </tr>
  <?php } else { ?>
	<tr><td style="color:red;font-weight: bold;">No Records to Display</td></tr>
  <?php } ?>
                           </tbody>
                            </table>
<?php
}
else if($_REQUEST['type']=="daily_cost")
{
	$rr="";
	$final=0;
	$string="";
    $search="";
	$reporthead="";
	  $foodcs=0;
								$wcs=0;
								  $foodcost=0;
								$wcost=0;
								$disctl=0;		
	$st="";
 $mnth=$_REQUEST['monthval'];
	$year=$_REQUEST['yrval'];
	if(isset($_REQUEST['set']))
	{
	?>	
<table class="table table-bordered table-font user_shadow">
         <thead>
         <th class="sortable">Date</th>
                                     <th class="sortable">Gross sale</th>
                                     <th class="sortable">Tax @ 5.6%</th>
					<th class="sortable">Net Sale</th>
                                      <th class="sortable">No. of invoices</th>
                                   <th class="sortable">Food Cost</th>
					<th class="sortable">Wastage Cost</th>
                                 	 <th class="sortable">Discount</th>
								  </thead>
			<tbody>		
<?php $mnth=$_REQUEST['monthval']; 
						$taxtot=0;$cnttotl=0;$netval=0;
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
		$sql_report  =  $database->mysqlQuery("select bm_dayclosedate ,sum(bm_finaltotal) as tot ,count(bm_billno) as cnt,sum(bm_servicetax) as tax ,sum(bm_discountvalue) as disc from tbl_tablebillmaster where bm_dayclosedate='".$datenw."' GROUP BY bm_dayclosedate ORDER BY bm_dayclosedate ASC "); 
	  $num_report   = $database->mysqlNumRows($sql_report);
	   if($num_report){	  
		  while($result_report  = $database->mysqlFetchArray($sql_report)) 
			{
				$final=$final + $result_report['tot'];			
				$cnttotl=$cnttotl+$result_report['cnt'];				
			$disctl=$disctl+$result_report['disc'];			
			$txper=$result_report['tax']*5.6/100;
				$taxtot=$taxtot+ $txper;
				$net=$result_report['tot']-$txper;
				$netval=$netval+$net;
	  ?>
		<tr >
                            <td><?=$database->convert_date($result_report['bm_dayclosedate'])?></td>
                           <td><?=number_format($result_report['tot'],$_SESSION['be_decimal'])?></td>
                          <td><?=number_format($txper,$_SESSION['be_decimal'])?></td>
                               <td><?=number_format($net,$_SESSION['be_decimal'])?></td>
                             <td><?=$result_report['cnt']?></td>                      
                            <?php    
  $sql_report12  =  $database->mysqlQuery("select kndl_date ,sum(kndl_totalcost) as tot ,sum(kndl_totalwastage) as wst from inv_tbl_dailykitchen where kndl_date='".$datenw."' GROUP BY kndl_date ORDER BY kndl_date ASC "); 
	  $num_report12   = $database->mysqlNumRows($sql_report12);
	   if($num_report12){  
		  while($result_report12  = $database->mysqlFetchArray($sql_report12)) 
			{				
				$foodcs=$foodcs + $result_report12['tot'];			
				$wcs=$wcs+$result_report12['wst'];				 
             ?>         
             <td><?=number_format($result_report12['tot'],$_SESSION['be_decimal'])?></td>
                           <td><?=number_format($result_report12['wst'],$_SESSION['be_decimal'])?></td>     
                               <td><?=number_format($result_report['disc'],$_SESSION['be_decimal'])?></td>    
                                  </tr>        
          <?php                      
			}
	   }
	  else { 
	   ?>
       <td>0</td>
       <td>0</td>      
               <td><?=number_format($result_report['disc'],$_SESSION['be_decimal'])?></td>                 
                </tr>             
                <?php }
			}
	  }
	}
			}
?>				
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  <td>&nbsp;</td>
   <td >&nbsp;</td>
  <td>&nbsp;</td>
      <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>Total/Avg</strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($taxtot,$_SESSION['be_decimal'])?></strong></td>
    <td><strong><?=number_format($netval,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($cnttotl,$_SESSION['be_decimal'])?></strong></td>
      <td><strong><?=number_format($foodcs,$_SESSION['be_decimal'])?></strong></td>
     <td><strong><?=number_format($wcs,$_SESSION['be_decimal'])?></strong></td>
       <td><strong><?=number_format($disctl,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                           </tbody>
                            </table>                          
                            <?php
	}
	else if(isset($_REQUEST['setyr']))
	{	
	?>
		<table class="table table-bordered table-font user_shadow">
         <thead>
                                    <th class="sortable">Date</th>
                                     <th class="sortable">Gross sale</th>
                                     <th class="sortable">Tax @ 5.6%</th>
					<th class="sortable">Net Sale</th>
                                      <th class="sortable">No. of invoices</th>
                                   <th class="sortable">Food Cost</th>
								 <th class="sortable">Wastage Cost</th>
                                 	 <th class="sortable">Discount</th>
								  </thead>
			<tbody>					
						<?php $mnth=$_REQUEST['monthval']; 
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
	  
		  while($result_report  = $database->mysqlFetchArray($sql_report)) 
			{
				$final=$final + $result_report['tot'];
				$cnttotl=$cnttotl+$result_report['cnt'];
				$disctl=$disctl+$result_report['disc'];				
				$txper1=$result_report['tax']*5.6/100;
				$taxtot=$taxtot+ $txper1;
				$net=$result_report['tot']-$txper1;
				$netval=$netval+$net;
	  ?>
		<tr >
               <td><?=$database->convert_date($result_report['bm_dayclosedate'])?></td>
                           <td><?=number_format($result_report['tot'],$_SESSION['be_decimal'])?></td>
                          <td><?=number_format($txper1,$_SESSION['be_decimal'])?></td>
                               <td><?=number_format($net,$_SESSION['be_decimal'])?></td>
                             <td><?=$result_report['cnt']?></td>                      
                            <?php    
$sql_report12  =  $database->mysqlQuery("select kndl_date ,sum(kndl_totalcost) as tot ,sum(kndl_totalwastage) as wst from inv_tbl_dailykitchen where kndl_date='".$datenw."' GROUP BY kndl_date ORDER BY kndl_date ASC "); 
	  $num_report12   = $database->mysqlNumRows($sql_report12);
	   if($num_report12){
		  while($result_report12  = $database->mysqlFetchArray($sql_report12)) 
			{
				$foodcs=$foodcs + $result_report12['tot'];			
				$wcs=$wcs+$result_report12['wst'];
             ?>         
                           <td><?=number_format($result_report12['tot'],$_SESSION['be_decimal'])?></td>
                           <td><?=number_format($result_report12['wst'],$_SESSION['be_decimal'])?></td>   
                               <td><?=number_format($result_report['disc'],$_SESSION['be_decimal'])?></td>  
         </tr>                                                     
          <?php                      
			}
	   }
	else {   ?>
    <td>0</td>
    <td>0</td>
          <td><?=number_format($result_report['disc'],$_SESSION['be_decimal'])?></td>
                  </tr>
                <?php
	}}
	  }
	}
			}
?>				
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  <td>&nbsp;</td>
   <td >&nbsp;</td>
  <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>Total/Avg</strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($taxtot,$_SESSION['be_decimal'])?></strong></td>
    <td><strong><?=number_format($netval,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=$cnttotl?></strong></td>
      <td><strong><?=number_format($foodcs,$_SESSION['be_decimal'])?></strong></td>
     <td><strong><?=number_format($wcs,$_SESSION['be_decimal'])?></strong></td>
      <td><strong><?=number_format($disctl,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                           </tbody>
                            </table>                       
                            <?php	
	}
	else if(isset($_REQUEST['yr']))
	{ ?>	
	<table class="table table-bordered table-font user_shadow">
         <thead>
                                    <th class="sortable">Date</th>
                                     <th class="sortable">Gross sale</th>
                                     <th class="sortable">Tax @ 5.6%</th>
									  <th class="sortable">Net Sale</th>
                                      <th class="sortable">No. of invoices</th>
                                      <th class="sortable">Food Cost</th>
                                      <th class="sortable">Wastage Cost</th>
                                         <th class="sortable">Discount</th>
								  </thead>
			<tbody>					
						<?php $year_val=$_REQUEST['yrval'];  $monthval=$_REQUEST['monthval'];
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
	  
		  while($result_report  = $database->mysqlFetchArray($sql_report)) 
			{
				$final=$final + $result_report['tot'];	
				$cnttotl=$cnttotl+$result_report['cnt'];				
			$disctl=$disctl+$result_report['disc'];
			$txper2=$result_report['tax']*5.6/100;
				$taxtot=$taxtot+ $txper2;
					$net=$result_report['tot']-$txper2;
				$netval=$netval+$net;
	  ?>
		<tr >
                            <td><?=$database->convert_date($result_report['bm_dayclosedate'])?></td>
                           <td><?=number_format($result_report['tot'],$_SESSION['be_decimal'])?></td>
                          <td><?=number_format($txper2,$_SESSION['be_decimal'])?></td>
                               <td><?=number_format($net,$_SESSION['be_decimal'])?></td>
                             <td><?=$result_report['cnt']?></td>                          
                            <?php    
    $sql_report12  =  $database->mysqlQuery("select kndl_date ,sum(kndl_totalcost) as tot ,sum(kndl_totalwastage) as wst from inv_tbl_dailykitchen where kndl_date='".$datenw."' GROUP BY kndl_date ORDER BY kndl_date ASC "); 
	  $num_report12   = $database->mysqlNumRows($sql_report12);
	   if($num_report12){
		  while($result_report12  = $database->mysqlFetchArray($sql_report12)) 
			{
				$foodcost=$foodcost + $result_report12['tot'];			
				$wcost=$wcost+$result_report12['wst'];				 
             ?>                   
              <td><?=number_format($result_report12['tot'],$_SESSION['be_decimal'])?></td>
                           <td><?=number_format($result_report12['wst'],$_SESSION['be_decimal'])?></td>    
                              <td><?=number_format($result_report['disc'],$_SESSION['be_decimal'])?></td>
                              </tr>                         
          <?php                      
			}
	   } else {?>
       <td>0</td>
       <td>0</td>
          <td><?=number_format($result_report['disc'],$_SESSION['be_decimal'])?></td>
            </tr>                            
                <?php
	   }}
			?>
 <?php
	  }
		}
			} ?>															                            
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>Total/Avg</strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($taxtot,$_SESSION['be_decimal'])?></strong></td>
    <td><strong><?=number_format($netval,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=$cnttotl?></strong></td>
     <td><strong><?=number_format($foodcost,$_SESSION['be_decimal'])?></strong></td>
     <td><strong><?=number_format($wcost,$_SESSION['be_decimal'])?></strong></td>
     <td><strong><?=number_format($disctl,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                           </tbody>
                            </table>                         
                            <?php
	}
	else if(isset($_REQUEST['setmnth']))
	{ ?>
	<table class="table table-bordered table-font user_shadow">
         <thead>
                                    <th class="sortable">Date</th>
                                     <th class="sortable">Gross sale</th>
                                     <th class="sortable">Tax @ 5.6%</th>
									  <th class="sortable">Net Sale</th>
                                      <th class="sortable">No. of invoices</th>
                                      <th class="sortable">Food Cost</th>
                                      <th class="sortable">Wastage Cost</th>
                                      <th class="sortable">Discount</th>
								  </thead>
			<tbody>															
						<?php $year_val=$_REQUEST['yrval'];  $monthval=$_REQUEST['monthval'];
						$taxtot=0;$cnttotl=0;$netval=0;
$sql_report1  =  $database->mysqlQuery("select distinct bm_dayclosedate from tbl_tablebillmaster ORDER BY bm_dayclosedate ASC "); 	
 
	 while($result_report  = $database->mysqlFetchArray($sql_report1)) 
			{
		 	$datenw=$result_report['bm_dayclosedate'];
			$newdate= explode("-",$datenw);
	$year1		= $newdate[0];
	$month		= $newdate[1];
	 $dat		= $newdate[2];
	if($year_val ==$year1 && $monthval == $month )
	{
	$sql_report  =  $database->mysqlQuery("select bm_dayclosedate ,sum(bm_finaltotal) as tot ,count(bm_billno) as cnt,sum(bm_servicetax) as tax ,sum(bm_discountvalue) as disc from tbl_tablebillmaster where bm_dayclosedate='".$datenw."' GROUP BY bm_dayclosedate ORDER BY bm_dayclosedate ASC "); 
	  $num_report   = $database->mysqlNumRows($sql_report);
	   if($num_report){  
		  while($result_report  = $database->mysqlFetchArray($sql_report)) 
			{
				$final=$final + $result_report['tot'];		
				$cnttotl=$cnttotl+$result_report['cnt'];			
			$disctl=$disctl +$result_report['disc'];				
				$txper3=$result_report['tax']*5.6/100;
				$taxtot=$taxtot+ $txper3;				
				$net=$result_report['tot']-$txper3;
					$netval=$netval+$net;
	  ?>
		<tr >
                            <td><?=$database->convert_date($result_report['bm_dayclosedate'])?></td>
                           <td><?=number_format($result_report['tot'],$_SESSION['be_decimal'])?></td>
                          <td><?=number_format($txper3,$_SESSION['be_decimal'])?></td>
                               <td><?=number_format($net,$_SESSION['be_decimal'])?></td>
                             <td><?=$result_report['cnt']?></td>  
                            <?php    
   $sql_report12  =  $database->mysqlQuery("select kndl_date ,sum(kndl_totalcost) as tot ,sum(kndl_totalwastage) as wst from inv_tbl_dailykitchen where kndl_date='".$datenw."' GROUP BY kndl_date ORDER BY kndl_date ASC "); 
	  $num_report12   = $database->mysqlNumRows($sql_report12);
	   if($num_report12){	  
		  while($result_report12  = $database->mysqlFetchArray($sql_report12)) 
			{			
				$foodcost=$foodcost + $result_report12['tot'];			
				$wcost=$wcost+$result_report12['wst'];				 
             ?>                   
                           <td><?=number_format($result_report12['tot'],$_SESSION['be_decimal'])?></td>
                           <td><?=number_format($result_report12['wst'],$_SESSION['be_decimal'])?></td>   
                              <td><?=number_format($result_report['disc'],$_SESSION['be_decimal'])?></td>
                              </tr>
          <?php                      
			}
	   }
	    else {?>
                      <td>0</td>
                      <td>0</td>
                                 <td><?=number_format($result_report['disc'],$_SESSION['be_decimal'])?></td>
                              </tr> 
                <?php
		}} ?>
            <?php
	  }
		}
			}
	?>													                            
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>Total/Avg</strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($taxtot,$_SESSION['be_decimal'])?></strong></td>
    <td><strong><?=number_format($netval,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=$cnttotl?></strong></td>
     <td><strong><?=number_format($foodcost,$_SESSION['be_decimal'])?></strong></td>
     <td><strong><?=number_format($wcost,$_SESSION['be_decimal'])?></strong></td>
         <td><strong><?=number_format($disctl,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                           </tbody>
                            </table>
<?php
	}
}
else if($_REQUEST['type']=="kot_history")
{
	$string="";
	$reporthead="";
	$st="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" )
		{
			$from=$database->convert_date($_REQUEST['fromdt']);		
			$string.= " k.kr_date = '".$from."' and o.ter_dayclosedate = '".$from."'    ";
		}
	$reporthead="on ".$database->convert_date($from)." ";	
	}
	else if(isset($_REQUEST['abc']))
	{ }
	else
	{
		$cur=date("Y-m-d");
		$string.=" k.kr_date='".$cur."' and o.ter_dayclosedate = '".$from."'  ";
	$reporthead="On ".$database->convert_date($cur);	
	}
	?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                      <tr>
                                  	<th colspan="11">Report - <?=$reporthead?></th>                                 
                                  </tr>
									<tr>
                                    <th class="sortable">Slno</th>
                                     <th class="sortable">Date</th>
									  <th class="sortable">Bill No</th>
                                      <th class="sortable">Kot No</th>
                                      <th class="sortable">Print</th>                                
                                      <th class="sortable">Status</th>
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
  $paid=0;
  $bal=0;
  $dsc=0;
  $srvtx=0;
  $subtotal=0;
  $sql_login  =  $database->mysqlQuery("SELECT k.kr_date,k.kr_kotno as KOT ,k.kr_print as printed,o.ter_status as kot_status,mm.mr_menuname as menu ,pm.pm_portionname AS Portion,o.ter_qty as Qty,o.ter_rate as Unit_Rate, ROUND((o.ter_qty*o.ter_rate),2) as Total_Rate ,o.ter_billnumber FROM tbl_kotmaster K left join tbl_tableorder o on o.ter_kotno = k.kr_kotno LEFT JOIN tbl_menumaster mm ON o.ter_menuid=mm.mr_menuid LEFT JOIN tbl_portionmaster pm ON o.ter_portion=pm.pm_id where $string order by k.kr_time asc "); 
  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{			
			$final=$final + $result_login['Total_Rate']; ?>
    						<tr >
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['kr_date'])?></td>
                               <td><?=$result_login['ter_billnumber']?></td>
                               <td><?=$result_login['KOT']?></td>
                               <td><?=$result_login['printed']?></td>                             
                               <td><?=$result_login['kot_status']?></td>                             
                              <td><?=$result_login['menu']?></td>
                              <td><?=$result_login['Portion']?></td>
                              <td><?=$result_login['Qty']?></td>
                                <td><?=number_format($result_login['Unit_Rate'],$_SESSION['be_decimal'])?></td>
                                <td><?=number_format($result_login['Total_Rate'],$_SESSION['be_decimal'])?></td>
                              </tr>             
                              <?php $i++;} } ?>                                                        
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
    <td >&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
    <td ></td>
   <td ></td>
    <td ></td>
     <td ></td>
    <td ><strong></strong></td>
    <td ><strong></strong></td>
    <td ><strong></strong></td>
    <td ><strong></strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                           </tbody>
                            </table>                          
<?php	
}
else if($_REQUEST['type']=="loyality_customer")
{
	$string="";
	$reporthead="";
	$st="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " DATE(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "DATE(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " DATE(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
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
		$string.=" DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";

$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.=" DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.=" DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" DATE(lr.ly_entrydatetime) CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" DATE(lr.ly_entrydatetime) = CURDATE( ) - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";
				  $st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}	
	$reporthead=$st;
	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " lr.ly_entrydatetime between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" lr.ly_entrydatetime='".$cur."'";
	$reporthead="On ".$database->convert_date($cur);	
	}
	?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                      <tr>
                                  	<th colspan="9">Report - <?=$reporthead?></th>                                
                                  </tr>
									<tr>
                                    <th class="sortable">Slno</th>
                                     <th class="sortable">Name</th>
                                       <th class="sortable">Mobile</th>
                                                      <th class="sortable">Email</th>
                                         <th class="sortable">Birthday </th>
                                      <th class="sortable">Anniversary </th>
                                      <th class="sortable">Marital Status</th>
                                     <th class="sortable">Profession</th>
                                     <th class="sortable">Total visit</th>                                  
									</tr>
								  </thead>
								  <tbody>
                                          <?php
  $sql_login  =  $database->mysqlQuery("select ly_firstname,ly_lastname,ly_mobileno,ly_emailid,ly_birthdaydate,ly_anniversarydate,
  ly_maritalstatus,ly_profession,ly_totalvisit from tbl_loyalty_reg as lr where $string order by lr.ly_entrydatetime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ ?>
    						<tr >
                            <td><?=$i?></td>                         
                               <td><?=$result_login['ly_firstname'].$result_login['ly_lastname']?></td>
                                 <td><?=$result_login['ly_mobileno']?></td>
                                 <td style="min-width: 170;word-wrap: break-word "><?=$result_login['ly_emailid']?></td>
                                     <?php if($result_login['ly_birthdaydate'] != NULL) {?>
                             <td><?=$database->convert_date($result_login['ly_birthdaydate'])?></td>
                             <?PHP } else {?>
                                <td></td>
                             <?php }?>                           
                             <?php if($result_login['ly_anniversarydate'] != NULL) {?>
                              <td><?=$database->convert_date($result_login['ly_anniversarydate'])?></td>
                              <?php } else {?>
                              <td></td>
                              <?php }?>
                               <td><?=$result_login['ly_maritalstatus']?></td>
                               
                              <td><?=$result_login['ly_profession']?></td>
                             
                              <td><?=$result_login['ly_totalvisit']?></td>
                              </tr> 
                              <?php $i++;} } else { ?>
		<tr><td colspan="9" style="color:red;font-weight: bold;">No Records to Display</td></tr>
	<?php } ?>
                           </tbody>
                            </table>
                            <?php	
}
else if($_REQUEST['type']=="feedback_report")
{
	$string="";
	$string=" t.ter_feedbackenter='Y' AND ";
	$reporthead="";
	$st="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " t.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " t.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " t.ter_dayclosedate between '".$from."' and '".$to."' ";
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
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($bydatz=="Yesterday")
			  {
				  $string.=" t.ter_dayclosedate = CURDATE( ) - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";
				  $st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  t.ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}	
	$reporthead=$st;
	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " t.ter_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" t.ter_dayclosedate='".$cur."'";
	$reporthead="On ".$database->convert_date($cur);	
	}
	?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                      <tr>
                                  	<th colspan="7">Report - <?=$reporthead?></th>                                
                                  </tr>
									<tr>
                                    <th class="sortable">Slno</th>
                                        <th class="sortable">Date</th>
                                     <th class="sortable">Menu</th>
					<th class="sortable">Portion</th>
                                      <th class="sortable">* Rating</th>                                    
                                      <th class="sortable">Bill No</th>
                                     <th class="sortable">Remarks</th>
									</tr>
								  </thead>
								  <tbody>
                               <?php
$sql_login  =  $database->mysqlQuery("select ter_dayclosedate,mr_menuname,pm_portionname,ter_feedbackrating,ter_billnumber,ter_feedbackremarks from tbl_tableorder as t left join tbl_menumaster as m on t.ter_menuid=m. mr_menuid left join tbl_portionmaster as pm on t.ter_portion=pm.pm_id where $string order by t.ter_dayclosedate ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ ?>
    						<tr >
                            <td ><?=$i?></td>
                              <td ><?=$database->convert_date($result_login['ter_dayclosedate'])?></td>
                               <td ><?=$result_login['mr_menuname']?></td>
                                  <td ><?=$result_login['pm_portionname']?></td>
                                    <td ><?=$result_login['ter_feedbackrating']?></td>                        
                               <td ><?=$result_login['ter_billnumber']?></td>                              
                              <td><?=$result_login['ter_feedbackremarks']?></td>                            
                              </tr> 
                              <?php $i++;} } ?>                         
 <tr>
 <td colspan=7 style="color:red;font-weight: bold;">No Records to display</td>
  </tr>
                           </tbody>
                            </table>                           
                            <?php
}
else if($_REQUEST['type']=="general_feedback")
{
	$string="";
	$reporthead="";
	$st="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " date(f.fbr_entrytime) between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  date(f.fbr_entrytime) between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  date(f.fbr_entrytime) between '".$from."' and '".$to."' ";
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
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";

$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";

	}
	elseif($bydatz=="Last15days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";

	}
	else if($bydatz=="Last30days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
else if($bydatz=="Yesterday")
			  {
				  $string.=" date(f.fbr_entrytime) = CURDATE( ) - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";
				  $st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}	
	$reporthead=$st;
	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " date(f.fbr_entrytime) between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" date(f.fbr_entrytime)='".$cur."'";
		$reporthead="On ".$database->convert_date($cur);	
	}
	?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                      <tr>
                                  	<th colspan="7">Report - <?=$reporthead?></th>                                
                                  </tr>
									<tr>
                                    <th class="sortable">Slno</th>
                                     <th class="sortable">Questions</th>
			             <th class="sortable">Entry Time</th>
                                      <th class="sortable">Customer</th>
                                      <th class="sortable">Rating</th>
                                      <th class="sortable">Bill No</th>
                                         <th class="sortable">Remarks</th>
									</tr>
								  </thead>
								  <tbody>
                                          <?php
$remark='';$old_cat='';
$sql_login  =  $database->mysqlQuery("select tfr.tfb_remarks,tsf.ser_firstname,fm.fbm_question,fm.fbm_avgrating,f.fbr_entrytime,tm.tr_tableno,f.fbr_rate,t.bm_billno from tbl_feedbackmaster fm left join tbl_feedbackrating f on fm.fbm_id=f.fbr_fbm_id left join  tbl_tablebillmaster  as t on f.fbr_orderid =t.bm_billno left join tbl_tablemaster as tm on f.fbr_table=tm.tr_tableid left join tbl_feedback_remark_entry tfr on tfr.tfb_billno=f.fbr_orderid  left join tbl_staffmaster tsf on tsf.ser_staffid=t.bm_feedback_customer  where $string and t.bm_billno!='' order by date(f.fbr_entrytime),t.bm_billno"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
               if($result_login['tfb_remarks']!=$old_cat){
                                $old_cat=$result_login['tfb_remarks'];
                                $remark=$result_login['tfb_remarks'];
                            }
                            else{
                               $remark=""; 
							} ?>
    			<tr >
                           <td ><?=$i?></td>
                           <td ><?=$result_login['fbm_question']?></td>
                           <td ><?=$result_login['fbr_entrytime']?></td>
                           <td ><?=$result_login['ser_firstname']?></td>
                           <td><?=number_format($result_login['fbr_rate'],$_SESSION['be_decimal'])?></td>
                           <td><?=$result_login['bm_billno']?></td>
                            <td><?=$remark?></td>
                        </tr>                       
                              <?php $i++;} } else { ?>
		<tr><td colspan="7" style="color:red;font-weight: bold;">No Records to Display</td></tr>
	<?php } ?>                             
                           </tbody>
                            </table>                          
                            <?php
}
else if($_REQUEST['type']=="menu_rating")
{
	$string="";
	$reporthead="";
	$st="";
	$bydatz=$_REQUEST['bydate'];
	 if(isset($_REQUEST['abc']))
	{
			if($bydatz!="")
	{
	$string.=" m.mr_menuname LIKE  '%" . $bydatz ."%' and m.mr_rating > '0' ";
	}
	else
	{
			$string.= "m.mr_rating > '0'";
	}	
	}
	else
	{
		$string.= "m.mr_rating > '0'";
	}
	 	if($string !="")
	{
		$string="where $string";
	}
	?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
									<tr>
                                    <th class="sortable">Slno</th>
                                     <th class="sortable">Menu</th>
                                      <th class="sortable">Category</th>
					<th class="sortable">Subcategory</th>
                                      <th class="sortable">Rating</th>
									</tr>
								  </thead>
								  <tbody>
<?php
$sql_login  =  $database->mysqlQuery("select mr_menuname,mmy_maincategoryname,msy_subcategoryname,mr_rating from tbl_menumaster as m  left join tbl_menumaincategory as mc on m.mr_maincatid=mc.mmy_maincategoryid left join tbl_menusubcategory as msc on m.mr_subcatid=msc.msy_subcategoryid  $string order by m.mr_menuid"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ ?>
    						<tr >
                            <td width="5%"><?=$i?></td>
                         <td width="20%">  <?=$result_login['mr_menuname']?></td>      
                                  <td width="8%"><?=$result_login['mmy_maincategoryname']?></td>
                                    <td width="6%"><?=$result_login['msy_subcategoryname']?></td>
                               <td width="8%"><?=$result_login['mr_rating']?></td>                   
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
    <td ></td>
    <td ></td>
    <td ></td>
   <td ></td>
   <td ></td>
  </tr>
                           </tbody>
                            </table>                         
                            <?php
}
else if($_REQUEST['type']=="feedback_summary")
{ ?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>                                 
									<tr>
                                    <th class="sortable">Slno</th>
                                    <th class="sortable">Questions</th>
                                     <th class="sortable">Active</th>
                                     <th class="sortable">Avg Rating</th>								
									</tr>
								  </thead>
								  <tbody>								
<?php
$sql_login  =  $database->mysqlQuery("select m.fbm_question,m.fbm_avgrating,m.fbm_active from tbl_feedbackmaster as m  order by m.fbm_id"); 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$active='';
				if($result_login['fbm_active']=="Y")
				{
					$active="Yes";
				}
				else
				{
					$active='No';
				}		
	 ?>
    						<tr >
                            <td ><?=$i?></td>                        
                               <td ><?=$result_login['fbm_question']?></td>
                                <td ><?=$active?></td>
                                <td ><?=$result_login['fbm_avgrating']?></td>
                              </tr> 
                              <?php $i++;} } else { ?>
		<tr><td colspan="4" style="color:red;font-weight: bold;">No Records to Display</td></tr>
	<?php } ?>
                           </tbody>
                            </table>                           
<?php
}
else if($_REQUEST['type']=="food_costing")
{
	$string="";
	$reporthead="";
	$st="";
	$bydatz=$_REQUEST['bymenu'];
	 if(isset($_REQUEST['abc']))
	{
			if($bydatz!="")
	{
	$string.=" rd.fc_menuid='".$bydatz."' ";
	}
	else
	{	
	}
		
	}
	else
	{
	}
	?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
									<tr>
                                    <th class="sortable">Slno</th>
                                <!--     <th class="sortable">Menu</th>-->
                                      <th class="sortable">Product</th>
                                      <th class="sortable">Unit</th>
									  <th class="sortable">Unit Cost</th>
                                      <th class="sortable">Qty</th>
                                       <th class="sortable">Total Cost</th>
                                        <th class="sortable">Wastage %</th>
                                         <th class="sortable">Wastage Cost</th>
									</tr>
								  </thead>
								  <tbody>
									
                                          <?php
										   $tot_cost=0;
  $wastage_cost=0;
										  if($string !="")
	{
$sql_login  =  $database->mysqlQuery("select fc_totalcost,fc_wastage_cost,fc_slno,prm_productname,um_name,fc_ing_unitcost,fc_qty,fc_wastage_percentage from fc_recipe_details as rd left join tbl_menumaster as m  on rd.fc_menuid=m.mr_menuid left join inv_tbl_productmaster as pm on rd.fc_ingredientid=pm.prm_productid  left join inv_tbl_unitmaster as u on rd.fc_ing_unit=u.um_id where $string order by rd.fc_menuid"); 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$tot_cost=$tot_cost+$result_login['fc_totalcost'];
				$wastage_cost=$wastage_cost+$result_login['fc_wastage_cost'];
	?>
    						<tr >
                            <td width="5%"><?=$result_login['fc_slno']?></td>                                                   
                                    <td width="20%">  <?=$result_login['prm_productname']?></td>                                   
                                  <td width="8%"><?=$result_login['um_name']?></td>
                                    <td width="6%"><?=$result_login['fc_ing_unitcost']?></td>
                               <td width="8%"><?=$result_login['fc_qty']?></td>
                                  <td width="8%"><?=number_format($result_login['fc_totalcost'],$_SESSION['be_decimal'])?></td>
                                     <td width="8%"><?=$result_login['fc_wastage_percentage']?></td>
                                        <td width="8%"><?=number_format($result_login['fc_wastage_cost'],$_SESSION['be_decimal'])?></td>                                                     
                              </tr> 
                              <?php $i++;} } }?>                        
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
    <td ><strong>Total</strong></td>
    <td ></td>
   <td ></td>
   <td ></td>
      <td ></td>
    <td ><strong><?=number_format($tot_cost,$_SESSION['be_decimal'])?></strong></td>
   <td ></td>
   <td ><strong><?=number_format($wastage_cost,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                           </tbody>
                            </table>                           
                            <?php
}
else if($_REQUEST['type']=="table_turnover")
{
	$string="";
	$reporthead="";
	$st="";
	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tbl_tableturnover.tor_date between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tbl_tableturnover. tor_date between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  tbl_tableturnover.tor_date between '".$from."' and '".$to."' ";
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
		$string.=" tbl_tableturnover.tor_date between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.=" tbl_tableturnover.tor_date between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tbl_tableturnover.tor_date between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tbl_tableturnover.tor_date between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" tbl_tableturnover.tor_date between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" tbl_tableturnover.tor_date between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" tbl_tableturnover.tor_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}	
else if($bydatz=="Yesterday")
			  {
				  $string.=" tbl_tableturnover.tor_date = CURDATE( ) - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";
				  $st="Yesterday";
			  }
	else if($bydatz=="Last1month")
	{
		$string.=" tbl_tableturnover.tor_date between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" tbl_tableturnover.tor_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" tbl_tableturnover.tor_date between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" tbl_tableturnover.tor_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st="Last 1 year";
	}	
	$reporthead=$st;
	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tbl_tableturnover.tor_date between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
	}
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" tbl_tableturnover.tor_date='".$cur."'";
	$reporthead="On ".$database->convert_date($cur);	
	}
	?>
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                      <tr>
                                  	<th colspan="7">Report - <?=$reporthead?></th>                                
                                  </tr>                            
									<tr>
                                    <th class="sortable">Slno</th>
                                        <th class="sortable">Date</th>
                                        <th class="sortable">Table</th>
                                     <th class="sortable">Bill No </th>
									  <th class="sortable">Total Customer</th>
                                            <th class="sortable">Bill Amount</th>
									</tr>
								  </thead>
								  <tbody>
<?php
$sql_login  =  $database->mysqlQuery("select tor_billamount,tor_totalcustomer,tor_slno,tor_date,tr_tableno,tor_billno from tbl_tableturnover  left join tbl_tablemaster  on tbl_tableturnover.tor_tableid=tbl_tablemaster.tr_tableid  where $string order by tbl_tableturnover.tor_date ASC"); 
  $final=0;$tot_cust=0;
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final+$result_login['tor_billamount'];
				$tot_cust=$tot_cust+$result_login['tor_totalcustomer'];		
	 ?>
    						<tr >
                            <td width="5%"><?=$result_login['tor_slno']?></td>
                               <td width="8%" ><?=$result_login['tor_date']?></td>
                                    <td width="8%"><?=$result_login['tr_tableno']?></td>
                                  <td width="8%"><?=$result_login['tor_billno']?></td>
                                    <td width="6%"><?=$result_login['tor_totalcustomer']?></td>
                               <td width="8%"><?=number_format($result_login['tor_billamount'],$_SESSION['be_decimal'])?></td>
                              </tr> 
                              <?php $i++;} } ?>                                                     
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
   <td >&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="main">
    <td ><strong>Total</strong></td>
    <td ></td>
    <td ></td>
   <td ></td>
   <td ><strong><?=$tot_cust?></strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
  </tr>
</tbody>
 </table>
<?php
}
else if($_REQUEST['type']=="table_turnoversummary")
{
	$string="";
	$string.=" bm_status='Closed' and bm_complimentary!='Y' and ";
	$reporthead="";
	$st="";
	if(isset($_REQUEST['set']))
	{
            if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
                    $from=$database->convert_date($_REQUEST['fromdt']);
                    $to=$database->convert_date($_REQUEST['todt']);
                    $string.= " bm_dayclosedate  between '".$from."' and '".$to."' ";
                }
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
                    $from=$database->convert_date($_REQUEST['fromdt']);
                    $to=date("Y-m-d");
                    $string.= " bm_dayclosedate  between '".$from."' and '".$to."' ";
                }
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
                    $from=date("Y-m-d");
                    $to=$database->convert_date($_REQUEST['todt']);
                    $string.= " bm_dayclosedate  between '".$from."' and '".$to."' ";
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
			$string.=" bm_dayclosedate = CURDATE() - INTERVAL 1 day AND CURDATE( )";
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
        }
	else
	{
            $cur=date("Y-m-d");
            $string.=" bm_dayclosedate='".$cur."'";
            $reporthead="On ".$database->convert_date($cur);		
	}
	?>
	<table class="table table-bordered table-font user_shadow" >
	<thead>
            <tr>
                <th colspan="3">Table Turnover Summary  - <?=$reporthead?></th>   
            </tr>
            <tr>
                <th class="sortable">Slno</th>
               <th class="sortable">Table</th>                
                <th class="sortable">Amount</th>
            </tr>
        </thead>
	<tbody>
	<?php
 $final=0;
 $total_cust=0;
 $billamount2=array();
 $tablename2=array();
  $sql_login  =  $database->mysqlQuery("select bm_finaltotal as tot,bm_tableno from tbl_tablebillmaster where $string   order by bm_finaltotal DESC"); 
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
                       
                        $i=0;
                        foreach($billamount2 as $key=>$val){
                            $i++;
			?>
                        <tr>
                            <td ><?=$i?></td>
                            <td ><?=$key?></td>
                            <td ><?=number_format($val,$_SESSION['be_decimal'])?></td>
                        </tr>
                        <?php 
                            }
                         ?>
	<tr><td >&nbsp;</td><td >&nbsp;</td><td >&nbsp;</td></tr>					 
    <tr class="main">
        <td ><strong>TOTAL</strong></td>
        <td >&nbsp;</td>
        <td ><strong><?=number_format(array_sum($billamount2),$_SESSION['be_decimal'])?></strong></td>
    </tr>
	<?php } else { ?>
		<tr><td colspan="3" style="color:red;font-weight: bold;">No Records to Display</td></tr>
	<?php } ?>
    </tbody>
    </table>
<?php
 }

else if($_REQUEST['type'] == "categorywise_report")
{	$string="";
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
	else if($_REQUEST['bydate'])
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
	else
	{
		$cur=date("Y-m-d");
		$string.=" tbl_tableturnover.tor_date='".$cur."'";
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
            $sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,count(distinct(bd.bd_menuid))as 'no of items',sum(bd.bd_qty) as qty ,sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno left join tbl_menumaster on mr_menuid=bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = mr_maincatid where $string group by mr_maincatid ORDER BY mr_maincatid ASC");
     $num_login   = $database->mysqlNumRows($sql_login);
             if($num_login){$i=1;$t=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$t++;
                          $total=$total+$result_login['Total']; ?>                      
                             <tr>
                                <td><?=$i?></td>
                                <td><?=$result_login['mmy_maincategoryname'];?></td>
                                <td><?=$result_login['no of items'];?></td>
                                <td><?=$result_login['qty'];?></td>
                                <td><?=number_format($result_login['Total'],$_SESSION['be_decimal']);?></td>                               
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
	  </tr>                       
              <?php } else { ?>
				<tr colspan="5" style="color:red;font-weight: bold;"><td>No Records to Display</td></tr>
			 <?php } ?>
			             </tbody>
                            </table>                           
<?php } ?>                     
