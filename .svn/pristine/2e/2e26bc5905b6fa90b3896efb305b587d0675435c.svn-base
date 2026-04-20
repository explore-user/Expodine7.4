

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

if(($_REQUEST['type']=="tot_sales_ta"))
{
//	$string="";
     $string=" tab_status='closed' AND tab_mode!= 'CS' and tab_complimentary!='Y' AND ";
        $reporthead="";
	$st="";
            $typesale=$_REQUEST['typesale'];
	
	if($_REQUEST['typesale']!='')
	{
		$string.="tab_mode='".$typesale."' AND ";
		
	}

           
            
            
	if(isset($_REQUEST['set']))
	{
//            
//            $string="";
//            
//            $typesale=$_REQUEST['typesale'];
//	
//	if($_REQUEST['typesale']!='')
//	{
//		$string.="tab_mode='".$typesale."' AND ";
//		
//	}
           
		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
       
            
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
                     
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate ";
                        
		}
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	
	else if(isset($_REQUEST['abc']))
	{
            $reporthead="";
	$st="";
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
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
				  $string.="tab_dayclosedate =CURDATE() - 1  ";
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
	else
	{
		$cur=date("Y-m-d");
		$string="tab_dayclosedate='".$cur."'";
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
  $dsc=0;
  $subtotal=0;
  $sql_login  =  $database->mysqlQuery("select tab_subtotal,tab_discountvalue,tab_netamt,tab_amountpaid,tab_amountbalace,tab_dayclosedate,
  tab_billno from tbl_takeaway_billmaster where $string"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
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
                               <td><?=$result_login['tab_subtotal']?></td>
                               <td><?=$result_login['tab_discountvalue']?></td>
                              <td><?=$result_login['tab_netamt']?></td>
                              <td><?=$result_login['tab_amountpaid']?></td>
                              <td><?=$result_login['tab_amountbalace']?></td>
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
    <td ><strong><?=$subtotal?></strong></td>
    <td ><strong><?=$dsc?></strong></td>
    <td ><strong><?=$final?></strong></td>
    <td ><strong><?=$paid?></strong></td>
    <td ><strong><?=$bal?></strong></td>
  </tr>

                           </tbody>
                            </table>
                            
                            <?php
          
 }
 
else if(($_REQUEST['type']=="discount_ta"))
{
	$string=" tab_status='closed' AND tab_mode!='CS' AND tab_discountvalue!='0.00' AND ";
        $reporthead="";
	$st="";
$typedisc=$_REQUEST['typedisc'];
	
	if($_REQUEST['typedisc']!='')
	{
	
		$string.="tab_mode='".$typedisc."' AND ";
	}
        
	if(isset($_REQUEST['set']))
	{
            
//            $typedisc=$_REQUEST['typedisc'];
//	
//	if($_REQUEST['typedisc']!='')
//	{
//	
//		$string.="tab_mode='".$typedisc."' AND ";
//	}

		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
       
            
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
                     
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate";
                        
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'order by tab_dayclosedate ";
                        
		}
                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	
	else if(isset($_REQUEST['abc']))
	{
            $reporthead="";
	$st="";
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
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
				  $string.="tab_dayclosedate =CURDATE() - 1  ";
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
	else
	{
		$cur=date("Y-m-d");
		$string.="tab_dayclosedate='".$cur."'";
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
  $dsc=0;
  $subtotal=0;
  $sql_login  =  $database->mysqlQuery("select tab_subtotal,tab_discountvalue,tab_netamt,tab_amountpaid,tab_amountbalace,tab_dayclosedate,tab_billno from tbl_takeaway_billmaster where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
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
                               <td><?=$result_login['tab_subtotal']?></td>
                               <td><?=$result_login['tab_discountvalue']?></td>
                              <td><?=$result_login['tab_netamt']?></td>
                              <td><?=$result_login['tab_amountpaid']?></td>
                              <td><?=$result_login['tab_amountbalace']?></td>
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
    <td ><strong><?=$subtotal?></strong></td>
    <td ><strong><?=$dsc?></strong></td>
    <td ><strong><?=$final?></strong></td>
    <td ><strong><?=$paid?></strong></td>
    <td ><strong><?=$bal?></strong></td>
  </tr>
                              
                             
                           </tbody>
                            </table>
                            
                            <?php
          
 }
else if($_REQUEST['type']=="type_sale")
{
	
	$string="";
	
		if($_REQUEST['typesale']!='null')
	{
		
		$string.=" tab_mode='".$_REQUEST['typesale']."' AND ";

	}

	if(isset($_REQUEST['set']))
	{
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
                 $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
	
	else if(isset($_REQUEST['abc']))
	{
            $reporthead="";
	$st="";
		$bydatz=$_REQUEST['bydate'];
		
		
		
			if($bydatz!="null")
	{
	
	if($bydatz=="Last5days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last25days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.="tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" tab_dayclosedate =CURDATE() - 1  ";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
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
                $st="Last 1 year";
	}
                $reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "tab_dayclosedate between '".$from."' and '".$to."'";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	}
	else
	{
		$cur=date("Y-m-d");
		$string.=" tab_dayclosedate='".$cur."'";
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
  $dsc=0;
  $subtotal=0;
 $sql_login  =  $database->mysqlQuery("select tab_subtotal,tab_discountvalue,tab_netamt,tab_amountpaid,tab_amountbalace,tab_dayclosedate,tab_billno from tbl_takeaway_billmaster where $string"); 

	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
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
                               <td><?=$result_login['tab_subtotal']?></td>
                               <td><?=$result_login['tab_discountvalue']?></td>
                               <td><?=$result_login['tab_netamt']?></td>
                              <td><?=$result_login['tab_amountpaid']?></td>
                              <td><?=$result_login['tab_amountbalace']?></td>
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
    <td ><strong><?=$subtotal?></strong></td>
    <td ><strong><?=$dsc?></strong></td>
    <td ><strong><?=$final?></strong></td>
    <td ><strong><?=$paid?></strong></td>
    <td ><strong><?=$bal?></strong></td>
  </tr>
                              
                             
                           </tbody>
                            </table>
                            
                            <?php

}



else if(($_REQUEST['type']=="type_pay_ta"))
{
	//typepay //cash credit coupons voucher cheque
	
$string="tbm.tab_status='closed' AND ";
	
	$fields="";
	$reporthead="";
	$st="";
         $typepaysale=$_REQUEST['typepaysale'];
	
	if($_REQUEST['typepaysale']!='')
	{
	
		$string.="tbm.tab_mode='".$typepaysale."' AND ";
	}
		//$type=$_REQUEST['typepay'];
if(isset($_REQUEST['set']))
{


	if($_REQUEST['typepay']=="cash")
	{
		//$string = " bm_transactionid ='' and bm_couponcompany ='' and bm_voucherid ='' and bm_chequeno ='' and bm_chequebankname=''";
/*		$string = " (tab_transactionamount ='' or tab_transactionamount IS NULL) and (tab_couponcompany ='' or tab_couponcompany IS NULL) and tab_voucherid IS NULL and tab_couponamt ='0.00' and  (tab_chequeno ='' or tab_chequeno IS NULL) and (tab_chequebankname='' or tab_chequebankname IS NULL)";
*/		
//		$string=" (tbl_takeaway_billmaster.tab_amountpaid-tbl_takeaway_billmaster.tab_amountbalace) >0 and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and tbm.tab_mode!='CS' and ((tbm.tab_amountpaid-tbm.tab_amountbalace) > 0) ";
                $fields="<th class='sortable'>Cash</th>";
	}else if($_REQUEST['typepay']=="credit")
	{
	/*	$string = " tab_transactionamount <>'' ";*/
	
		$string = " p.pym_code='credit' and (tbm.tab_transcbank <>'0') and tbm.tab_mode!='CS'";
//		$string = " tbl_paymentmode.pym_code='credit' and tbl_takeaway_billmaster.tab_transcbank <> '0' and tbl_takeaway_billmaster.tab_status='Delivered'  ";
//		$string = " pym_code='credit' and (tab_transcbank <> '0') ";
//		$fields="<th class='sortable'>Transaction Amount</th>";
                $fields="<th class='sortable'>Card Payment</th>";
		$fields.="<th class='sortable'>Bank</th>";
		$fields.="<th class='sortable'>Cash</th>";
		
	}else if($_REQUEST['typepay']=="coupons")
	{
		/*$string = " tab_couponcompany <>''  and tab_couponamt <>'0.00'";*/
//		$string = " tbl_paymentmode.pym_code='coupon' and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$string = " pym_code='coupon'";
//		$fields="<th class='sortable'>Coupon Company</th>";
//		$fields.="<th class='sortable'>Coupon Amount</th>";
                $fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
		/*$string = " tab_voucherid <>''";*/
//		$string = " tbl_paymentmode.pym_code='voucher' and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$string = " pym_code='voucher'";
//		$fields="<th class='sortable'>Voucher</th>";
                $fields="<th class='sortable'>Voucher</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
	/*	$string = " tab_chequeno <>'' and tab_chequebankname<>''";*/
//			$string = " tbl_paymentmode.pym_code='cheque' and tbl_takeaway_billmaster.tab_status='Delivered' ";
                  $string = " pym_code='cheque'";			
//		$fields="<th class='sortable'>Cheque No</th>";
//		$fields.="<th class='sortable'>Bank Name</th>";
                    $fields="<th class='sortable'>Cheque No</th>";
		    $fields.="<th class='sortable'>Bank Name</th>";
		    $fields.="<th class='sortable'>Paid</th>";
	}
	//fromdt todt
	
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.="and tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.="and tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.="and tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and tbm.tab_dayclosedate between '".$from."' and '".$to."' order by tab_dayclosedate";
		}

                $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                }
                
                
                
	else if(isset($_REQUEST['abc']))
	{
		$paybydate=$_REQUEST['paybydate'];
			if($_REQUEST['typepay']=="cash")
	{
		/*$string = " (tab_transactionamount ='' or tab_transactionamount IS NULL) and (tab_couponcompany ='' or tab_couponcompany IS NULL) and tab_voucherid IS NULL and tab_couponamt ='0.00' and  (tab_chequeno ='' or tab_chequeno IS NULL) and (tab_chequebankname='' or tab_chequebankname IS NULL)";*/
//		$string=" (tbl_takeaway_billmaster.tab_amountpaid-tbl_takeaway_billmaster.tab_amountbalace) >0 and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and tbm.tab_mode!='CS' and ((tbm.tab_amountpaid-tbm.tab_amountbalace) > 0) ";
                $fields="<th class='sortable'>Cash</th>";
	}else if($_REQUEST['typepay']=="credit")
	{
	//	$string = " tab_transactionamount <>'' ";
//	$string = " tbl_paymentmode.pym_code='credit' and tbl_takeaway_billmaster.tab_transcbank <> '0' and tbl_takeaway_billmaster.tab_status='Delivered'  ";
//		$fields="<th class='sortable'>Transcation Amount</th>";
            $string = " p.pym_code='credit' and (tbm.tab_transcbank <>'0') and tbm.tab_mode!='CS'";    
            $fields="<th class='sortable'>Card Payment</th>";
		$fields.="<th class='sortable'>Bank</th>";
		$fields.="<th class='sortable'>Cash</th>";
		
	}else if($_REQUEST['typepay']=="coupons")
	{
//		$string = " tbl_paymentmode.pym_code='coupon' and tbl_takeaway_billmaster.tab_status='Delivered' ";
		//$string = " tab_couponcompany <>''  and tab_couponamt <>'0.00'";
//		$fields="<th class='sortable'>Coupon Company</th>";
//		$fields.="<th class='sortable'>Coupon Amount</th>";
            $string = " pym_code='coupon' and tab_status='closed'";   
            $fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
		/*$string = " tab_voucherid <>''";*/
//		$string = " tbl_paymentmode.pym_code='voucher' and tbl_takeaway_billmaster.tab_status='Delivered' ";
		$string = " pym_code='voucher' and tab_status='closed'";
//		$fields="<th class='sortable'>Voucher</th>";
                $fields="<th class='sortable'>Voucher</th>";
		$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
		/*$string = " tab_chequeno <>'' and tab_chequebankname<>''";*/
//			$string = " tbl_paymentmode.pym_code='cheque' and tbl_takeaway_billmaster.tab_status='Delivered' ";
//		$fields="<th class='sortable'>Cheque No</th>";
//		$fields.="<th class='sortable'>Bank Name</th>";
            $string = " pym_code='cheque' and tab_status='closed'";          
            $fields="<th class='sortable'>Cheque No</th>";
		        $fields.="<th class='sortable'>Bank Name</th>";
		        $fields.="<th class='sortable'>Paid</th>";
	}
		
		
			if($paybydate!="null")
	{
		//$search="";
	
	if($paybydate=="Last5days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 5 
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
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
                $st="Last 15 days";
	}
	else if($paybydate=="Last20days")
	{
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 20 
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
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 30 
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
				  $string.="and tbm.tab_dayclosedate =CURDATE() - 1 ";
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
		$string.="and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
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
			
			$string.= "(tbm.tab_dayclosedate between '".$from."' and '".$to."' )  ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
	}


	}
	
	else if(isset($_REQUEST['pay']))
	{
	if($_REQUEST['typepay']=="cash")
	{
		/*$string = " (tab_transactionamount ='' or tab_transactionamount IS NULL) and (tab_couponcompany ='' or tab_couponcompany IS NULL) and tab_voucherid IS NULL and tab_couponamt ='0.00' and  (tab_chequeno ='' or tab_chequeno IS NULL) and (tab_chequebankname='' or tab_chequebankname IS NULL)";*/
//		$string=" (tbl_takeaway_billmaster.tab_amountpaid-tbl_takeaway_billmaster.tab_amountbalace) >0 and tbl_takeaway_billmaster.tab_status='Delivered' ";
            $string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary'))and tbm.tab_mode!='CS' and ((tbm.tab_amountpaid-tbm.tab_amountbalace) > 0) ";
		$fields="<th class='sortable'>Cash</th>";
	}else if($_REQUEST['typepay']=="credit")
	{
		/*$string = " tab_transactionamount <>'' ";*/
//		$string = " tbl_paymentmode.pym_code='credit' and tbl_takeaway_billmaster.tab_transcbank <> '0' and tbl_takeaway_billmaster.tab_status='Delivered'  ";
//		$fields="<th class='sortable'>Transcation Amount</th>";
            $string = " p.pym_code='credit' and (tbm.tab_transcbank <>'0') and tbm.tab_mode!='CS'";   
            $fields="<th class='sortable'>Card Payment</th>";
			$fields.="<th class='sortable'>Bank</th>";
		$fields.="<th class='sortable'>Cash</th>";
		
	}else if($_REQUEST['typepay']=="coupons")
	{
//		$string = " tbl_paymentmode.pym_code='coupon' and tbl_takeaway_billmaster.tab_status='Delivered' ";
            $string = " pym_code='coupon' and tab_status='closed'";
	/*	$string = " tab_couponcompany <>''  and tab_couponamt <>'0.00'";*/
//		$fields="<th class='sortable'>Coupon Company</th>";
//		$fields.="<th class='sortable'>Coupon Amount</th>";
                $fields="<th class='sortable'>Coupon Company</th>";
		$fields.="<th class='sortable'>Coupon Amount</th>";
			$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="voucher")
	{
	/*	$string = " tab_voucherid <>''";*/
//		$string = " tbl_paymentmode.pym_code='voucher' and tbl_takeaway_billmaster.tab_status='Delivered' ";
//		$fields="<th class='sortable'>Voucher</th>";
            $string = " pym_code='voucher' and tab_status='closed'";    
            $fields="<th class='sortable'>Voucher</th>";
			$fields.="<th class='sortable'>Paid</th>";
	}else if($_REQUEST['typepay']=="cheque")
	{
		/*$string = " tab_chequeno <>'' and tab_chequebankname<>''";*/
//			$string = " tbl_paymentmode.pym_code='cheque' and tbl_takeaway_billmaster.tab_status='Delivered' ";
//		$fields="<th class='sortable'>Cheque No</th>";
//		$fields.="<th class='sortable'>Bank Name</th>";
            $string = " pym_code='cheque' and tab_status='closed'";          
            $fields="<th class='sortable'>Cheque No</th>";
		        $fields.="<th class='sortable'>Bank Name</th>";
			$fields.="<th class='sortable'>Paid</th>";
	}
	
	//fromdt todt
	
	$paybydate=$_REQUEST['paybydate'];
		if($paybydate!="null")
	{
		
		
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
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 25 
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
		$string.=" and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
                $st="Today";
	}
	
	
		else if($paybydate=="Yesterday")
			  {
				  $string.=" and tbm.tab_dayclosedate = CURDATE() - 1 ";
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
			
			$string.= " and (tbm.tab_dayclosedate between '".$from."' and '".$to."' )  ";
                        
                        
//		   $fields.="<th class='sortable'>Transcation Id</th>";
//		  	$fields.="<th class='sortable'>Coupon Company</th>";
//			$fields.="<th class='sortable'>Coupon Amount</th>";
//			$fields.="<th class='sortable'>Voucher</th>";
//			$fields.="<th class='sortable'>Cheque No</th>";
//		$fields.="<th class='sortable'>Bank Name</th>";
		  
		}
	
	?>




	<table class="table table-bordered table-font user_shadow" >
				<thead>
                                <tr>
                                  	<th colspan="9">Report - <?=$reporthead?></th>
                                  
                                </tr>
				<tr>
                                    <th class="sortable">Slno</th>
                                     <th class="sortable">Date</th>
					<th class="sortable">Bill No</th>
                                      <?=$fields ?>
                                      
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
  $sql_login =  $database->mysqlQuery("select tbm.tab_billno,tbm.tab_transactionamount,tbm.tab_dayclosedate,tbm.tab_amountpaid,b.bm_name,
tbm.tab_amountbalace from tbl_takeaway_billmaster tbm left join tbl_paymentmode p on tbm.tab_paymode=p.pym_id left join tbl_bankmaster b on b.bm_id=tbm.tab_transcbank where $string order by tbm.tab_billno asc");
 $num_login   = $database->mysqlNumRows($sql_login);
	 
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{

                $paid=$paid +$result_login['tab_amountpaid'];
			$paidcrdt=$paidcrdt + ($result_login['tab_amountpaid']-$result_login['tab_amountbalace']);
			$total_transaction=$total_transaction+$result_login['tab_transactionamount'];		
	 ?>
     <tr >
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['tab_dayclosedate'])?></td>
                               <td><?=$result_login['tab_billno']?></td>
                               
                               <?php
								if($_REQUEST['typepay']=="cash")
								{
								?>
										  <td><?=$result_login['tab_amountpaid']?></td>
									   <td><?=($result_login['tab_amountpaid']-$result_login['tab_amountbalace'])?></td>
							<?php		
								}
                                                                else if($_REQUEST['typepay']=="credit")
								{
									?>
                                    <td><?=$result_login['tab_transactionamount']?></td>
                                     <td><?=$result_login['bm_name']?></td>
									  <td><?=$result_login['tab_amountpaid']?></td>
                                    <td><?=$result_login['tab_amountpaid']-$result_login['tab_amountbalace']?></td>
                                    <?php
									
								}else if($_REQUEST['typepay']=="coupons")
								{$coup=$coup + $result_login['tab_couponamt'];
									?>
                                    <td><?=$result_login['tab_couponcompany']?></td>
                                    <td><?=$result_login['tab_couponamt']?></td>
                                    <?php
								}else if($_REQUEST['typepay']=="voucher")
								{
									?>
                                    <td><?=$result_login['tab_voucherid']?></td>
                                    <?php
								}else if($_REQUEST['typepay']=="cheque")
								{
									?>
                                    <td><?=$result_login['tab_chequeno']?></td>
                                    <td><?=$result_login['tab_chequebankname']?></td>
                                    <?php
								}
								?>
<!--                              <td><?=$result_login['tab_netamt']?></td>-->
<!--                              <td><?=$result_login['tab_amountpaid']?></td>
                              <td><?=$result_login['tab_amountbalace']?></td>-->
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
	 ?>
    
    <?php
	   if($_REQUEST['typepay']=="credit")
	  {
		  ?>
		  <td >&nbsp;</td>
                   <td >&nbsp;</td>
                    <td >&nbsp;</td>
		  <?php
		  
	  }else if($_REQUEST['typepay']=="coupons")
	  {
		  ?>
		  <td >&nbsp;</td>
		  <td >&nbsp;</td>
		  <?php
	  }else if($_REQUEST['typepay']=="voucher")
	  {
		  ?>
		  <td >&nbsp;</td>
		  <?php
	  }else if($_REQUEST['typepay']=="cheque")
	  {
		  ?>
		  <td >&nbsp;</td>
		  <td >&nbsp;</td>
		  <?php
	  }
	  ?>
    <td >&nbsp;</td>

  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
    <td ></td>
    
    
    <?php
	 if($_REQUEST['typepay']=="cash")
	  {
		  ?>
    
		  <td ><strong><?=$paid?></strong></td>
		    <td ><strong><?=$paidcrdt?></strong></td>
<!--                    <td ><strong><?=$final?></strong></td>-->
                    


          <?php
	  }
  
	else if($_REQUEST['typepay']=="credit")
	  {
		  ?>
		  <td >&nbsp;</td>
                  <td >&nbsp;</td>
		  <td >&nbsp;</td>
		  <?php
		  
	  }else if($_REQUEST['typepay']=="coupons")
	  {
		  ?>
		  <td >&nbsp;</td>
		  <td><?=$coup?></td>
		  <?php
	  }else if($_REQUEST['typepay']=="voucher")
	  {
		  ?>
		  <td >&nbsp;</td>
		  <?php
	  }else if($_REQUEST['typepay']=="cheque")
	  {
		  ?>
		  <td >&nbsp;</td>
		  <td >&nbsp;</td>
		  <?php
	  }
	  ?>
<!--    <td ><strong><?=$final?></strong></td>-->
<!--    <td ><strong><?=$paid?></strong></td>
    <td ><strong><?=$bal?></strong></td>-->
  </tr>
                             
                           </tbody>
                            </table>
                            
                            <?php
}


else if(($_REQUEST['type']=="item"))
{
	$floor=$_REQUEST['floorvals'];
	
	?>
    <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr>
      <th >Category</th>
       <th >Sub Category</th>
        <th>Items</th>
         <th >Dine In</th>
       <th >Take Away</th>
      </tr>
     
    </thead>
    <?php
	 $sql_cat  =  $database->mysqlQuery("select distinct(mr.mr_maincatid) as catid from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as my ON mr.mr_maincatid=my.mmy_maincategoryid where mr.mr_active='Y'  order by my.mmy_displayorder"); 
	$num_cat   = $database->mysqlNumRows($sql_cat);
	if($num_cat){$j=0;
		while($result_cat  = $database->mysqlFetchArray($sql_cat)) 
			{
				$j++;
				
				$menucat=$database->show_category_ful_details($result_cat['catid']);
				if($menucat['mmy_maincategoryname']!="")
				{
					?>
								  <tbody>
                                  <tr>
                                  	<td colspan="1" style="text-align:left; "><strong><?=$menucat['mmy_maincategoryname']?></strong></td>
                                  	<td colspan="4" style="text-align:left"></td>
                                  </tr>
                                  <?php
								  $sql_sub  =  $database->mysqlQuery("select distinct(mr_subcatid) as subid from tbl_menumaster where mr_active='Y' and mr_maincatid='".$result_cat['catid']."' order by mr_maincatid"); 
				$num_sub  = $database->mysqlNumRows($sql_sub);
				if($num_sub){$k=0;
					while($result_sub  = $database->mysqlFetchArray($sql_sub)) 
						{$k++; 
							$menusub=$database->show_subcategory_ful_details($result_sub['subid']);
						 ?> 
                                 <tr>
                                  	<td colspan="1" style="text-align:left"></td>
                                  	<td colspan="1" style="text-align:left"><?=$menusub['msy_subcategoryname']?></td>
                                    <td colspan="3" style="text-align:left"> </td>
                                  </tr> 
                                  
                                  <?php
								
								$sql_menulist_dine= "select mr_menuid,mr_menuname  from tbl_menumaster  WHERE  mr_active='Y' and  mr_maincatid='".$result_cat['catid']."' and mr_subcatid='".$result_sub['subid']."'  order by mr_subcatid ";
		
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
						      //Dine Away
							  $dinein="";
							   $sql_menulist_din="SELECT mt.mmr_rate,pm.pm_portionname FROM tbl_menuratemaster as mt LEFT JOIN tbl_portionmaster as pm ON pm.pm_id=mt.mmr_portion WHERE mt.mmr_menuid='".$result_menus['mr_menuid']."'  and mt.mmr_floorid='".$floor."'";//and mt.mta_portion='".$result_menus['pm_id']."'
							  $sql_dn=$database->mysqlQuery($sql_menulist_din); 
							  $num_dn  = $database->mysqlNumRows($sql_dn);$f=0;
								if($num_dn)
								{
									
									while($result_dn  = $database->mysqlFetchArray($sql_dn)) 
									{
										if($f==0)
										{
										$dinein=$result_dn['mmr_rate']."(".$result_dn['pm_portionname'].")";
										}else
										{
											$dinein=$dinein." , ". $result_dn['mmr_rate']."(".$result_dn['pm_portionname'].")";
										}
										$f++;
									}
								}else
								{
									$dinein="";
								}
							  
							  
							  //take away
							  
							  $sql_menulist_tak="SELECT mt.mta_rate,pm.pm_portionname FROM tbl_menuratetakeaway as mt LEFT JOIN tbl_portionmaster as pm ON pm.pm_id=mt.mta_portion WHERE mt.mta_menuid='".$result_menus['mr_menuid']."' ";//and mt.mta_portion='".$result_menus['pm_id']."'
							  $sql_take=$database->mysqlQuery($sql_menulist_tak); 
							  $num_take  = $database->mysqlNumRows($sql_take);
								if($num_take)
								{
									$tak_portion="";$tak_rate="";
									while($result_take  = $database->mysqlFetchArray($sql_take)) 
									{
									$takeaway=$result_take['mta_rate']."(".$result_take['pm_portionname'].")";
									}
								}else
								{
									$takeaway="N/A";
								}
								 //$result_menus['mmr_rate']."(".$result_menus['pm_portionname'].")"
								 if($dinein!=""){
						 ?>
                            	<tr>
                                  	<td colspan="1"></td>
                                  	<td colspan="1"></td>
                                    <td colspan="1" style="text-align:left"><?=$menuname?> </td>
                                  	<td colspan="1" style="text-align:left"><?=$dinein?></td>
                                    <td colspan="1" style="text-align:left"><?=$takeaway?></td>
                                  </tr>
                                  <?php } ?>
                           
                         <?php } } ?>    
                           
                <?php } } ?>
                                  </tbody>
                                 
                                  <?php
					
				}
			}
		}
	
	?>
     </table>
    <?php
}else if(($_REQUEST['type']=="steward"))
{
	$stw=$_REQUEST['stwrd'];
	$string="";
	
	if(isset($_REQUEST['abc']))
	{
			$stewardbydate=$_REQUEST['stewardbydate'];
	
			if($stewardbydate!="null")
	{
		//$search="";
	
	if($stewardbydate=="Last5days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_takeaway_billmaster.tab_dayclosedate  = CURDATE() - 1 ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC");

	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "and  ( tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
		$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
		
	}

	}

	else if(isset($_REQUEST['set']))
{
	$stw=$_REQUEST['stwrd'];
	$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "and  ( tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
		$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC");
	
}

else if(isset($_REQUEST['stwr']))
{
	
			$stewardbydate=$_REQUEST['stewardbydate'];
	
			if($stewardbydate!="null")
	{
		//$search="";
	
	if($stewardbydate=="Last5days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="andtbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_takeaway_billmaster.tab_dayclosedate  = CURDATE() - 1 ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC");

	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "and  ( tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
		$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
		
	}
	
}

else 
	{
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
		} 
		$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster  Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails.tab_billno INNER JOIN  tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto  =  '".$stw."' $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	}	
	
	?>
		
		<table class="table table-bordered table-font user_shadow" >
								  <thead>
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
			{
				?>
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

else if($_REQUEST['type']=="delivery_amt")
{
	
	
	$stw=$_REQUEST['stwrd'];
	$string="";
	
	if(isset($_REQUEST['abc']))
	{
			$stewardbydate=$_REQUEST['stewardbydate'];
	
			if($stewardbydate!="null")
	{
		//$search="";
	
	if($stewardbydate=="Last5days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_takeaway_billmaster.tab_dayclosedate  = CURDATE() - 1 ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

$sql_stw  =  $database->mysqlQuery("Select sum(tbl_takeaway_billmaster.tab_netamt) as amt,tbl_takeaway_billmaster.tab_dayclosedate as tabdate From tbl_takeaway_billmaster Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto ='".$stw."' $string Group By tbl_takeaway_billmaster.tab_dayclosedate");

	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "and  ( tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
		$sql_stw  =  $database->mysqlQuery("Select sum(tbl_takeaway_billmaster.tab_netamt) as amt,tbl_takeaway_billmaster.tab_dayclosedate as tabdate From tbl_takeaway_billmaster Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto ='".$stw."' $string Group By tbl_takeaway_billmaster.tab_dayclosedate"); 
		
	}

	}

	else if(isset($_REQUEST['set']))
{
	$stw=$_REQUEST['stwrd'];
	$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "and  ( tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
		$sql_stw  =  $database->mysqlQuery("Select sum(tbl_takeaway_billmaster.tab_netamt) as amt,tbl_takeaway_billmaster.tab_dayclosedate as tabdate From tbl_takeaway_billmaster Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto ='".$stw."' $string Group By tbl_takeaway_billmaster.tab_dayclosedate");
	
}

else if(isset($_REQUEST['stwr']))
{
	
			$stewardbydate=$_REQUEST['stewardbydate'];
	
			if($stewardbydate!="null")
	{
	
	if($stewardbydate=="Last5days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($stewardbydate=="Last10days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	elseif($stewardbydate=="Last15days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last20days")
	{
		$string.="andtbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last25days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Last30days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	else if($stewardbydate=="Today")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($stewardbydate=="Yesterday")
			  {
				  $string.="and tbl_takeaway_billmaster.tab_dayclosedate  = CURDATE() - 1 ";
			  }
	else if($stewardbydate=="Last1month")
	{
		$string.=" and tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}
	
	else if($stewardbydate=="Last90days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
	}

else if($stewardbydate=="Last180days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
	}
else if($stewardbydate=="Last365days")
	{
		$string.="and tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

$sql_stw  =  $database->hd_("Select sum(tbl_takeaway_billmaster.tab_netamt) as amt,tbl_takeaway_billmaster.tab_dayclosedate as tabdate From tbl_takeaway_billmaster Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto ='".$stw."' $string Group By tbl_takeaway_billmaster.tab_dayclosedate");

	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "and  ( tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
		$sql_stw  =  $database->mysqlQuery("Select sum(tbl_takeaway_billmaster.tab_netamt) as amt,tbl_takeaway_billmaster.tab_dayclosedate as tabdate From tbl_takeaway_billmaster Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto ='".$stw."' $string Group By tbl_takeaway_billmaster.tab_dayclosedate"); 
		
	}
	
}




else 
	{
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' )  ";
		} 
		$sql_stw  =  $database->mysqlQuery("Select sum(tbl_takeaway_billmaster.tab_netamt) as amt,tbl_takeaway_billmaster.tab_dayclosedate as tabdate From tbl_takeaway_billmaster Inner Join tbl_staffmaster On tbl_takeaway_billmaster.tab_assignedto = tbl_staffmaster.ser_staffid Where tbl_takeaway_billmaster.tab_assignedto ='".$stw."' $string Group By tbl_takeaway_billmaster.tab_dayclosedate"); 
	}	
	
	?>
		
		<table class="table table-bordered table-font user_shadow" >
								  <thead>
									<tr>
                                    <th class="sortable">Sl no</th>
                                     <th class="sortable">Date</th>
									  <th class="sortable">Total Amount</th>
									</tr>
								  </thead>
								  <tbody>
       <?php
 	  
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				?>
                <tr>
                  <td colspan="1" style="text-align:left"><?=$i++?> </td>
                  <td colspan="1" style="text-align:left"><?=$database->convert_date($result_stw['tabdate'])?></td>
                  <td colspan="1" style="text-align:left"><?=$result_stw['amt']?></td>
                </tr>
                <?php
			}
	  }
	  ?>
      </tbody>
      </table>
      <?php	
}
else if(($_REQUEST['type']=="order"))
{
	$string="";
	if(isset($_REQUEST['set']))
	{
	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  (tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
		}
	}
	else if(isset($_REQUEST['abc']))
	{
			$orderbydate=$_REQUEST['orderbydate'];
	
			if($orderbydate!="null")
	{
	
	if($orderbydate=="Last5days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($orderbydate=="Last10days")
	{
		$string.="tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	elseif($orderbydate=="Last15days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last20days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last25days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($orderbydate=="Last30days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	else if($orderbydate=="Today")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}


else if($orderbydate=="Yesterday")
			  {
				  $string.=" tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - 1 ";
			  }
	else if($orderbydate=="Last1month")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}
	else if($orderbydate=="Last90days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
	}
		else if($orderbydate=="Last180days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
	}
		else if($orderbydate=="Last365days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' ";
	}	
	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  (tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
	}
	?>
		
		<table class="table table-bordered table-font user_shadow" >
								  <thead>
									<tr>
                                    <th class="sortable">Sl no</th>
                                     <th class="sortable">Item</th>
									  <th class="sortable">Count</th>
									</tr>
								  </thead>
								  <tbody>
       <?php
 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno=tbl_takeaway_billdetails. tab_billno Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid  Where   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				?>
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
}else if(($_REQUEST['type']=="type_order"))
{
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
	}
		
	if($ordertypebydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	else if($ordertypebydate=="Yesterday")
			  {
				  $string.=" tbl_tableorder.ter_dayclosedate  = CURDATE() - 1 ";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.="  tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}
	
	else if($ordertypebydate=="Last90days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
	}
	else if($ordertypebydate=="Last180days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
	}
	else if($ordertypebydate=="Last365days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
	}
	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
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
	}elseif($ordertypebydate=="Last10days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	

else if($ordertypebydate=="Yesterday")
			  {
				  $string.="and tbl_tableorder.ter_dayclosedate  = CURDATE() - 1";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}
	
	
	else if($ordertypebydate=="Last90days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
	}

else if($ordertypebydate=="Last180days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
	}
else if($ordertypebydate=="Last365days")
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	}
	else
	{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
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
		 $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordtype."' Group By tbl_menumaster.mr_menuname  DESC"); 
}?>	
		<table class="table table-bordered table-font user_shadow" >
								  <thead>
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
			{
				?>
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
	if(isset($_REQUEST['set']))
	{
		$prtn=$_REQUEST['portn'];
	if($prtn !="null")
	{

	if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
	
				$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' and tbl_takeaway_billdetails.tab_portion  LIKE  '%" . $prtn ."%'  ) ";
		
			
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
	
				$string.= "  ( tbl_takeaway_billmaster.tab_date between '".$from."' and '".$to."' and tbl_takeaway_billdetails.tab_portion  LIKE  '%" . $prtn ."%'  ) ";
		
			
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
		
				$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' and tbl_takeaway_billdetails.tab_portion  LIKE  '%" . $prtn ."%'  ) ";
		
			
		
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
		
				$string.= "  (  tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."' and tbl_takeaway_billdetails.tab_portion  LIKE  '%" . $prtn ."%'   ) ";

		} 
		
		
		$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC");
	
	}
	else
	{
		
		
		
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
				$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."'   ) ";
			
			
			
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			
				$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."'  ) ";
		
			
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
				$string.= "  ( tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."'   ) ";
			
			
		
		}else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']=="")
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
				$string.= "  (  tbl_takeaway_billmaster.tab_dayclosedate  between '".$from."' and '".$to."'   ) ";
			
		} 
		$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC");
	}
		
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
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	

else if($portionbydate=="Yesterday")
			  {
				  $string.= " tbl_takeaway_billmaster.tab_dayclosedate  =CURDATE() - 1";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}
	
	
	else if($portionbydate=="Last90days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL  6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
		  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where tbl_takeaway_billdetails.tab_portion='".$prtn."'  and $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 

	}
	else
	{

			
		if($portionbydate=="Last5days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	else if($portionbydate=="Yesterday")
			  {
				  $string.= " tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - 1 ";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}
	else if($portionbydate=="Last90days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH  AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.="  tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}	
			
		else
		{
			$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}
	$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where  $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 

	}
	
	
	
	}
	
	
	
	else
	{
			$string.="  tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			 $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where   $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 

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
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.="tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.="tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($portionbydate=="Yesterday")
			  {
				  $string.= "tbl_takeaway_billmaster.tab_dayclosedate  = CURDATE() - 1 ";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.="tbl_takeaway_billmaster.tab_dayclosedate   between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where  $string and tbl_takeaway_billdetails.tab_portion='".$prtn."' Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 

	
		}
		
		else
		{
			
				if($portionbydate=="Last5days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
	}elseif($portionbydate=="Last10days")
	{
		$string.="tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last20days")
	{
		$string.="tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
	}
	else if($portionbydate=="Today")
	{
		$string.="tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		else if($portionbydate=="Yesterday")
			  {
				  $string.= "tbl_takeaway_billmaster.tab_dayclosedate = CURDATE() - 1 ";
			  }
	else if($portionbydate=="Last1month")
	{
		$string.="tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
	}
	else if($portionbydate=="Last90days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($portionbydate=="Last180days")
	{
		$string.="tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($portionbydate=="Last365days")
	{
		$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}
			  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where  $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
		}
	}
	  else
	  {
		  	$string.=" tbl_takeaway_billmaster.tab_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
	  }
		}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "  (  tbl_takeaway_billmaster.tab_dayclosedate between '".$from."' and '".$to."' )  ";
			 $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails ON tbl_takeaway_billmaster.tab_billno= tbl_takeaway_billdetails.tab_billno  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_takeaway_billdetails.tab_menuid Inner Join  tbl_portionmaster ON tbl_takeaway_billdetails.tab_portion=tbl_portionmaster.pm_id  where   $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC");
	}
?>
		
		<table class="table table-bordered table-font user_shadow" >
								  <thead>
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
			{
				?>
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

?>