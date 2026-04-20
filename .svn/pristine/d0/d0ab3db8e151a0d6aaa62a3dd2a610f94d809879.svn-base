<?php
error_reporting(0);
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
//session_start();

$database	= new Database(); 		// Create a new instance
$branchname='';
$address='';
$taxname1=0;
$taxname2=0;
$taxname3=0;
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

<style>.left_list_cc{height: 71vh;min-height: 498px !important}
.back-button-print{width: 100px;height: 30px;float: left;background: #1a1a1a;text-align: center;line-height:  30px;font-size: 14px;color: #fff !important}
</style>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="mn/js/modernizr.custom.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
</head>
<body style="background:none;overflow:scroll !important">
<!-- main header -->
<div style="width:1000px;margin:0 auto">

 <div class="section_content" id="div_list">
                      
  <div class="print_content">  
          <div class="estimate_cnt_wrapper_print">  
          		<div class="table_wrapper">

                <table border="0" cellpadding="1" cellspacing="3" width="100%"style="float:left">
      <tbody>
          <tr> 
          <td id="printbutton"> <input type="submit" value="Print" style="margin-right:55px;border: 0px" class="back-button-print print_button_main" onclick="return print_page()" />
              <a class="back-button-print" onclick="return close_page()"  >Close</a>
          </td>
          </tr>
          <tr> 
          <td>&nbsp;</td>
          </tr>
          
      </tbody>
  </table>
                
<?php if($_REQUEST['type']=="tot_sales")
    { 
 	$reporthead="";
 	$st="";
 	$floor_name='';
 	$servicetax_stats='N';
	$sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` 
										 WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
		 $servicetax_stats='Y';
	}
	$string="";
	$string.=" bm_status='Closed' AND ";
	$reporthead="";
	$st="";
	$floorz=$_REQUEST['floorz'];
		if($floorz!="")
	    {
		$string.=" bm_floorid='".$floorz."' AND ";
        $sql_floor  =  $database->mysqlQuery("select fr_floorname FROM tbl_floormaster where fr_floorid='".$floorz."'"); 
        $num_floor   = $database->mysqlNumRows($sql_floor);
            if($num_floor)
            {
                $result_floor  = mysqli_fetch_array($sql_floor);
                $floor_name=$result_floor['fr_floorname'];
            }  
	    }
	
		if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
            $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else 
		{
            $bydatz=$_REQUEST['hidbydate'];
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
			$string.=" bm_dayclosedate = CURDATE( ) - INTERVAL 1 day";//" bm_dayclosedate =CURDATE() - 1  ";
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
    <table class="table table-bordered table-font user_shadow" >
    <thead>
      	<tr >
      		<th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       		<img width="80px" src="img/report-logo/reportlogo.png" />
      		<strong><u><?=$branchname?></u></strong></th>
      	</tr>
        <tr >
      		<th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Total Sales <?php if($floor_name!='') { echo '-'.$floor_name; }?> </strong></th>
      	</tr>
    </thead>
    </table>
    <table class="table table-bordered table-font user_shadow">
		<thead>
            <?php
            $tax_name=array();
            $sql_login  =  $database->mysqlQuery("select distinct(betm.bem_taxid) as taxid,betm.bem_label as taxname  
												 FROM tbl_tablebill_extra_tax_master betm 
												 left join tbl_extra_tax_master tm on tm.amc_id=betm.bem_taxid 
												 group by  amc_id order by tm.amc_id asc "); 
            $num_login   = $database->mysqlNumRows($sql_login);
            if($num_login){ 
                while($result_login=$database->mysqlFetchArray($sql_login)){
                    $tax_name[]=$result_login['taxname'];
                }} ?>                                 
            <tr>
                <th colspan="<?=9+count(array_unique($tax_name))?>">Report - <?=$reporthead?></th>                               
            </tr>
            <tr>
                <th class="sortable">Slno</th>
                <th class="sortable">Date</th>
				<th class="sortable">Bill No</th>
                <th class="sortable">Table</th>
                <th class="sortable">Sub Total</th>
                <?php
                for($i=0;$i<count(array_unique($tax_name));$i++){?>
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
  $tax_value=array();
  $subtotal=0;
  $sql_login  =  $database->mysqlQuery("select bm_paymode,bm_finaltotal,bm_amountpaid,bm_amountbalace,bm_discountvalue,
  bm_subtotal,bm_dayclosedate,bm_billno,bm_tableno 
  from tbl_tablebillmaster where $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		$q=0;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ $q++;
            if($result_login['bm_paymode']!=7){
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
			$dsc=$dsc + $result_login['bm_discountvalue'];
			$subtotal=$subtotal + $result_login['bm_subtotal'];?>
            <tr>
                <td><?=$q?></td>
                <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                <td><?=$result_login['bm_billno']?></td>
                <td><?=$result_login['bm_tableno']?></td>
                <td><?=  number_format($result_login['bm_subtotal'],$_SESSION['be_decimal'])?></td>                                                                
				<?php 
                for($s=0;$s<count(array_unique($tax_name));$s++)
				{
                $sql_taxvalue  =  $database->mysqlQuery("select betm.bem_total_value,betm.bem_taxid,betm.bem_label  
														 FROM tbl_tablebill_extra_tax_master betm 
														 where betm.bem_billno='".$result_login['bm_billno']."' 
														 and betm.bem_label='".$tax_name[$s]."' 
														 order by betm.bem_label asc"); 
                $num_taxvalue   = $database->mysqlNumRows($sql_taxvalue);
                if($num_taxvalue)
				{
                while($result_taxvalue  = $database->mysqlFetchArray($sql_taxvalue)) 
                { 
						if($result_taxvalue['bem_total_value']==''){
                            $result_taxvalue['bem_total_value']=0;
                        }
                        $tax_value[$result_taxvalue['bem_label']][]=$result_taxvalue['bem_total_value'];?>
                <td><?=number_format($result_taxvalue['bem_total_value'],$_SESSION['be_decimal'])?></td>
                <?php } } 
                else { 
                    $tax_value[$tax_name[$s]][]=0;?>
                <td><?=number_format(0,$_SESSION['be_decimal'])?></td>
                <?php } }?>  
                    <td><?=number_format($result_login['bm_discountvalue'],$_SESSION['be_decimal'])?></td>
                    <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                    <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                    <td><?=number_format($result_login['bm_amountbalace'],$_SESSION['be_decimal'])?></td>
                    </tr> 
                <?php }} } ?>                                              
 <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <?php 
    for($i=0;$i<count(array_unique($tax_name));$i++){ 
        ?>
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
  </tbody>
  </table>
<?php }
if(($_REQUEST['type']=="tax_detailed_cnb"))
{
	 $date=date("Ymd");
	   $string=" bm_status='Closed' AND ";
if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
		}
	else
	{
		$bydatz=$_REQUEST['hidbydate'];
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
		$st="Last Today";
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
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
	$cur=date("Y-m-d");
	$servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	?>
                        <table class="table table-bordered table-font user_shadow">
								  <thead>                                 
                                    <?php if($servicetax_stats=='Y'){ ?>
                                  <tr>
                                  	<th colspan="10">Tax Detailed Report - <?=$reporthead?></th>                                
                                  </tr>                                 
                                  <?php } else
								  {?>
                                      <tr>
                                  	<th colspan="10">Tax Detailed Report - <?=$reporthead?></th>                                
                                  </tr>
                                  <?php }?>
                                  <tr>
                                    <th class="sortable">Slno</th>
                                     <th class="sortable">Date</th>
                                    <th class="sortable">Bill No</th>
                                    <th class="sortable">Item</th>
                                      <th class="sortable">Qty</th>
                                       <th class="sortable">Subtotal</th>
                                      <?php
                                      $sql_tax  =  $database->mysqlQuery("select amc_name from  tbl_extra_tax_master order by amc_id asc");
                                        $num_tax   = $database->mysqlNumRows($sql_tax);
                                        if($num_tax){
                                               while($result_tax  = $database->mysqlFetchArray($sql_tax)){
                                                   ?>
                                      <th class="sortable"><?=$result_tax['amc_name']?></th>
                                      <?php
                                               }
                                        }
                                      ?>
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
  $total=0;
  $finaltotal=0;
  $ct=0;
  $taxtotal1=0;
  $taxtotal2=0;
  $taxtotal3=0;
  $totalqty = 0;
  $finalsubtotal=0;
  $subtotal=0;
  $sql_login  =  $database->mysqlQuery("select tbd.bd_billno,tbm.bm_billdate, tbd.bd_menuid, mm.mr_menuname, tbd.bd_qty, tetd.bet_tax_amount, etm.amc_name,tbd.bd_amount,tbd.bd_billslno 
    FROM tbl_tablebilldetails tbd
    left join tbl_tablebillmaster tbm on tbd.bd_billno = tbm.bm_billno
    left join tbl_menumaster mm on mm.mr_menuid = tbd.bd_menuid
    left join tbl_tablebill_extra_tax_details tetd on tbd.bd_billno = tetd.bet_billno and tbd.bd_billslno = tetd.bet_billslno
    left join tbl_extra_tax_master etm on etm.amc_id = tetd.bet_tax_id
    where $string
    group by tbm.bm_billno, tbd.bd_menuid
    order by tbd.bd_billno desc"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$ct=0;
			$subtotal=$result_login['bd_amount'];
                        $totalqty = $totalqty + $result_login['bd_qty'];
	 ?>
							<tr >
                            <td><?=$i?></td>
                             <td><?=$result_login['bm_billdate']?></td>
                               <td><?=$result_login['bd_billno']?></td>
                               <td><?=$result_login['mr_menuname']?></td>
                               <td><?=$result_login['bd_qty']?></td>                             
                               <td><?=number_format($subtotal,$_SESSION['be_decimal'])?></td>
                                <?php
                               $taxtotal=0;
                                $sql_tax  =  $database->mysqlQuery("select amc_id, amc_name from  tbl_extra_tax_master order by amc_id asc ");
                                $num_tax   = $database->mysqlNumRows($sql_tax);
                                if($num_tax){
                                    while($result_tax  = $database->mysqlFetchArray($sql_tax)){
                                        $ct++;
                                         $taxamnt = '--';
                                        $sql_taxamnt  =  $database->mysqlQuery("select bet_tax_amount from  tbl_tablebill_extra_tax_details
                                        where bet_billno = '".$result_login['bd_billno']."' and bet_billslno = '".$result_login['bd_billslno']."' and bet_tax_id = '".$result_tax['amc_id']."'");
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
                                                }                                               
                                            }                                      
                                        } ?>
                               <td><?=number_format($taxamnt,$_SESSION['be_decimal'])?></td>
                               <?php
                                }
                                }
                                $total= $subtotal + $taxtotal;
                                $finaltotal = $finaltotal + $total;
                                $finalsubtotal = $finalsubtotal + $subtotal;
                                ?>
								<td><?=number_format($total,$_SESSION['be_decimal'])?></td>
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
  </tr>
  <tr class="main">
    <td ><strong>TOTAL</strong></td>
    <td ></td>
    <td ></td>
    <td ></td>
   <td ><strong><?=$totalqty?></strong></td>
    <td ><strong><?=number_format($finalsubtotal,$_SESSION['be_decimal'])?></strong></td>
    <?php if($taxtotal1!=0){ ?>
    <td ><strong><?=number_format($taxtotal1,$_SESSION['be_decimal'])?></strong></td>
    <?php }if($taxtotal2!=0){?>
    <td ><strong><?=number_format($taxtotal2,$_SESSION['be_decimal'])?></strong></td>
    <?php }if($taxtotal3!=0){?>
    <td ><strong><?=number_format($taxtotal3,$_SESSION['be_decimal'])?></strong></td>
    <?php } ?>
    <td ><strong><?=number_format($finaltotal,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                           </tbody>
                            </table>
                            <?php
}
else if($_REQUEST['type' ]=="tot_sales_timely")
{
 $reporthead="";
 $st="";
 $servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	  	  $string=" bm_status='Closed' AND ";		  
		  	 $floorvalue=$_REQUEST['floorz'];
	 if($_REQUEST['floorz']!=''){
			$string.=" bm_floorid='".$floorvalue."' AND ";
	 }
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$bydate=$_REQUEST['hidbydate'];
			$from=$_REQUEST['from'];
			$to=$_REQUEST['to'];
			$string.= " bm_billtime between '".$from."' and '".$to."'  and bm_billdate  = '".$bydate."' ";	
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$bydate=$_REQUEST['hidbydate'];
			$from=$_REQUEST['from'];
			 $to = date('H:i');
$string.= " bm_billtime between '".$from."' and '".$to."'  and bm_billdate  = '".$bydate."' ";
		}
		
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$bydate=$_REQUEST['hidbydate'];
			  $from = date('H:i');
			$to=$_REQUEST['to']                                                                               ;
			$string.= " bm_billtime between '".$from."' and '".$to."'  and bm_billdate  = '".$bydate."' ";
		}
	else
	{
		  $from = date('H:i');
				 $to = date('H:i');
			$string.= "bm_billtime between '".$from."' and '".$to."'  and bm_billdate  = '".$bydate."' ";
	}
 ?>  
 
     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>  
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Total Sales</strong></th>
      </tr>
    </thead>
    </table>

   <table class="table table-bordered table-font user_shadow" >
    <thead>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
      
        <th style="font-size:15px; "><strong>Bill No</strong></th>
          <th style="font-size:15px; "><strong>Bill Time</strong></th>
        <th style="font-size:15px; "><strong>Table</strong></th>
        <th style="font-size:15px"><strong>Sub Total</strong></th>
        <?php if($servicetax_stats=='Y'){ ?><th style="font-size:15px"><strong><?=$taxname1?></strong></th><?php } ?>
        <th style="font-size:15px"><strong>Discount</strong></th>
        <th style="font-size:15px"><strong>Final</strong></th>
        <th style="font-size:15px"><strong>Paid</strong></th>
        <th style="font-size:15px"><strong>Balance</strong></th>
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
	  bm_dayclosedate,bm_billno,bm_billtime,bm_tableno from tbl_tablebillmaster where $string order by bm_billdate,bm_billtime ASC"); 
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
                             <td><?=$result_login['bm_subtotal']?></td>
                             <?php if($servicetax_stats=='Y'){ ?><td><?=number_format($result_login['bm_servicetax'],$_SESSION['be_decimal'])?></td><?php } ?>
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
   <?php if($servicetax_stats=='Y'){ ?> <td >&nbsp;</td><?php } ?>
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
    <?php if($servicetax_stats=='Y'){ ?> <td ><strong><?=number_format($srvtx,$_SESSION['be_decimal'])?></strong></td><?php } ?>
    <td ><strong><?=number_format($dsc,$_SESSION['be_decimal'])?></strong></td>
   
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>
  </tr>                        
                           </tbody>
                            </table>
<?php 	
}
else  if($_REQUEST['type' ]=="summary") { 
 $servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
 ?>  
     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Summary Report</strong></th>
      </tr>
    </thead>
    </table>           		 
   <table class="table table-bordered table-font user_shadow" >
  <?php
	$string='';
    $reporthead="";
	$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - (sum(bm_amountbalace) + sum(bm_roundoff_value))) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_finaltotal) ";
	$string6_str=" sum(bm_finaltotal)";
	$string7_str=" sum(bm_finaltotal)";
	$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
		$string2 = " pym_code='credit'  AND ";//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
			$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
		}
	else
	{
		$bydatz=$_REQUEST['hidbydate'];
	if($bydatz!="null")
	{
	if($bydatz=="Last5days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
		$st= " Last 5 days ";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today "; 
	}
	else if($bydatz=="Yesterday")
			  {
				  $string.=" bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
				  $st= " Yesterday ";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  $st= " Last 1 month ";
			  }
else if($bydatz=="Last90days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st= " Last 3 months ";
	}
else if($bydatz=="Last180days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st= " Last 6 months ";
	}
else if($bydatz=="Last365days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st= " Last 1 Year ";
	}
$reporthead=$st;
	}
	else
	{
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ;
	}
	}
	?>
     
    <thead>
    <tr>
        <th style="font-size:20px; " colspan="2"><strong>Report - <?=$reporthead ?></strong></th>
      </tr>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Type</strong></th>
        <th style="font-size:15px; "><strong>Value</strong></th>
      </tr>
    </thead>
    <tbody>
      <?php
  $subtotal=0;
 	  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id  where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
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
          <?php } }  }
		  $sql_login  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['tot'] != "")
			{
				$subtotal =$subtotal + $result_login['tot'];			
	 ?>
        <tr >
        <td>Card</td>
         <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
       
          </tr> 
          <?php } } }
          
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
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['tot'] != "")
			{
				$subtotal =$subtotal + $result_login['tot'];
				
	 ?>
        <tr >
        <td>Coupons</td>
         <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
       
          </tr> 
          <?php } } }
		  
		  $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
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
          <?php } } }
		  
		  $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
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
          <?php } } }
		  
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
			//$subtotal =$subtotal + $result_login['tot'];
			?>
          <tr >
          <td>Complimentary</td>
          <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php } }}
		  ?>
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


<?php }

else if($_REQUEST['type']=="kot_report") { ?>  

    
      <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF;"  colspan="6"><strong>KOT Report</strong></th>
      </tr>

      
    </thead>
    </table>
    
    
    
    
                      		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
        <th style="font-size:15px; "><strong>Date</strong></th>
        <th style="font-size:15px; "><strong>KOT No</strong></th>
        <th style="font-size:15px"><strong>Items</strong></th>
        <th style="font-size:15px"><strong>Quantity</strong></th>
        <th style="font-size:15px"><strong>Rate</strong></th>
      
      </tr>
    </thead>
    <tbody>
                                          <?php
//`tbl_tablebillmaster`(`bm_billno`, `bm_dayclosedate`, `bm_billtime`, `bm_branchid`, `bm_subtotal`, `bm_paymode`, `bm_cancelamount`, `bm_discountid`, `bm_corporatecode`, `bm_discountvalue`, `bm_servicetax`, `bm_vat`, `bm_servicecharge`, `bm_credit`, `bm_creditroom`, `bm_creditstaff`, `bm_complimentary`, `bm_complimentaryremark`, `bm_finaltotal`, `bm_amountpaid`, `bm_amountbalace`, `bm_transactionid`, `bm_voucherid`, `bm_couponcompany`, `bm_couponamt`, `bm_chequeno`, `bm_chequebankname`)	
	  //$cur=date("Y-m-d");
	  $string=" tor.ter_status='Closed' AND ";
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " tor.ter_dayclosedate between '".$from."' and '".$to."' ";
		}
	else
	{
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
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
				  $string.="tor.ter_dayclosedate =  CURDATE() - INTERVAL 1 day";
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

	}
	 $final=0;$old='';$new='';
 	  $sql_login  =  $database->mysqlQuery("select tor.ter_kotno,tor.ter_dayclosedate,mm.mr_menuname,(tor.ter_rate * tor.ter_qty) as rate,tor.ter_qty from tbl_tableorder as tor LEFT JOIN tbl_menumaster as mm ON tor.ter_menuid=mm.mr_menuid where $string order by tor.ter_dayclosedate,tor.ter_entrytime ASC"); 
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
                       <td><?=$result_login['ter_qty']?></td>
                       <td><?=number_format($result_login['rate'],$_SESSION['be_decimal'])?></td>
                      </tr> 
                      <?php
					}else
					{
						?>
                         <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td ><b>Total</b></td>
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
                   <td><?=$result_login['ter_qty']?></td>
                   <td><?=number_format($result_login['rate'],$_SESSION['be_decimal'])?></td>
                  </tr> 
                  <?php
					}
				}
                               $i++;}?>
                         <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td ><b>Total</b></td>
                   <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  <?php } ?>
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
    <td ></td>
    <td ></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
  </tr>                         
                           </tbody>
                            </table>


<?php }
else if($_REQUEST['type']=="bill_details") { ?> 
   <!--<table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6"> <img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Bill Report</strong></th>
     
      </tr>
    </thead>
    </table> -->      
    
    
      <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF;" colspan="6"><strong>Bill Report</strong></th>
      </tr>

      
    </thead>
    </table>
    
    
    
                   		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
        <th style="font-size:15px; "><strong>Date</strong></th>
        <th style="font-size:15px; "><strong>Bill No</strong></th>
        <th style="font-size:15px"><strong>Items</strong></th>
        <th style="font-size:15px"><strong>Quantity</strong></th>
        <th style="font-size:15px"><strong>Rate</strong></th>
      <th style="font-size:15px"><strong>Discount</strong></th>
      </tr>
    </thead>
    <tbody>
                                          <?php
//`tbl_tablebillmaster`(`bm_billno`, `bm_dayclosedate`, `bm_billtime`, `bm_branchid`, `bm_subtotal`, `bm_paymode`, `bm_cancelamount`, `bm_discountid`, `bm_corporatecode`, `bm_discountvalue`, `bm_servicetax`, `bm_vat`, `bm_servicecharge`, `bm_credit`, `bm_creditroom`, `bm_creditstaff`, `bm_complimentary`, `bm_complimentaryremark`, `bm_finaltotal`, `bm_amountpaid`, `bm_amountbalace`, `bm_transactionid`, `bm_voucherid`, `bm_couponcompany`, `bm_couponamt`, `bm_chequeno`, `bm_chequebankname`)	
	  //$cur=date("Y-m-d");
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
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
	else
	{
	
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null" && $bydatz!="")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
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
				  $string.="bm.bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
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
	 $final=0;$old='';$new='';
	 $dsc=0;
 $dscfinal=0;
 	  $sql_login  =  $database->mysqlQuery("SELECT td.bd_billno,bm.bm_dayclosedate,mn.mr_menuname,td.bd_rate,td.bd_qty,pm.pm_portionname,bm.bm_discountvalue from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id LEFT JOIN tbl_tablebillmaster as bm ON bm.bm_billno=td.bd_billno  WHERE $string $sort_string1"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$k=1;$each=0;
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
					{$each=$each + ($result_login['bd_rate'] * $result_login['bd_qty']);
						?>
                     <tr>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td><?=$result_login['mr_menuname']?></td>
                       <td><?=$result_login['bd_qty']?></td>
                       <td><?=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
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
                   <td><?=$result_login['bd_qty']?></td>
                   <td><?=number_format(($result_login['bd_rate'] * $result_login['bd_qty']),$_SESSION['be_decimal'])?></td>
                   <td></td>
                  </tr> 
                  <?php
					}
				}
                               $i++;}?>
                         <tr>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td ><b>Total</b></td>
                   <td></td>
                   <td><b><?=number_format($each,$_SESSION['be_decimal'])?> /-</b></td>
                    <td><b><?=number_format($dsc,$_SESSION['be_decimal'])?> /-</b></td>
                  </tr>
                  <?php } ?>
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
    <td ></td>
     <td ></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
     <td ><strong><?=number_format($dscfinal,$_SESSION['be_decimal'])?></strong></td>
  </tr>  
  <tr class="main">
    <td ><strong>GRAND TOTAL</strong></td>
    <td ></td>
    <td ></td>
    <td ></td>
    <td ></td>
    <td ></td>
     <td ><strong><?=number_format(($final-$dsc),$_SESSION['be_decimal'])?></strong></td>
  </tr>                        
                           </tbody>
                            </table>


<?php }
else if($_REQUEST['type']=="discount_report") {
	
		  $string=" bm_status='Closed'  AND bm_discountvalue<>'0.00' AND ";
	  
	  $reporthead="";
	  $st="";
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."'";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	else
	{
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
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
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	
	}
	
	
	
	
	
	
	
	
	
	
	
	 ?>  
  <!-- <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6"> <img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Discount Report</strong></th>
     
      </tr>
    </thead>
    </table>   -->
    
      <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th 
style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Discount Report</strong></th>
      </tr>

      
    </thead>
    </table>
    
    
    
    
    
    
    
                       		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
     <tr>
      <th colspan="8">Report - <?=$reporthead?></th>               
     </tr>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
        <th style="font-size:15px; "><strong>Date</strong></th>
        <th style="font-size:15px; "><strong>Bill No</strong></th>
        <th style="font-size:15px"><strong>Sub Total</strong></th>
        <th style="font-size:15px"><strong>Discount</strong></th>
        <th style="font-size:15px"><strong>Final</strong></th>
        <th style="font-size:15px"><strong>Paid</strong></th>
        <th style="font-size:15px"><strong>Balance</strong></th>
      </tr>
    </thead>
    <tbody>
   <?php
  $final=0;
  $paid=0;
  $bal=0; 
 	  $sql_login  =  $database->mysqlQuery("select bm_finaltotal,bm_amountpaid,bm_amountbalace,bm_dayclosedate,bm_billno,bm_subtotal,bm_discountvalue from tbl_tablebillmaster where $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];
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
    <td ></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>
  </tr>                         
                           </tbody>
                            </table>


<?php }
else if($_REQUEST['type']=="bill_cancel") { ?>  
  <!-- <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6"><img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Bill cancel</strong></th>
     
      </tr>
    </thead>
    </table>-->
    
   
      <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="6"><strong>Bill cancel Report</strong></th>
      </tr>

      
    </thead>
    </table>
   <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:15px; "><strong>Sl No</strong></th>
     <th style="font-size:15px; "><strong>Date</strong></th>
        <th style="font-size:15px; "><strong>Bill No</strong></th>
        <th style="font-size:15px; "><strong>Bill Generated Time</strong></th>
        <th style="font-size:15px; "><strong>Bill Cancelled Date&Time</strong></th>
            <th style="font-size:15px; "><strong>Reason</strong></th> 
       <th style="font-size:15px"><strong>Final</strong></th>
       <th style="font-size:15px"><strong>Paid</strong></th>
      <!-- <th style="font-size:20px"><strong>Paid</strong></th>
       <th style="font-size:20px"><strong>Balance</strong></th>-->
         <th style="font-size:15px"><strong>Cancelled By</strong></th>
         <th style="font-size:15px"><strong>Cancelled Login</strong></th>
       
      </tr>
    </thead>
    <tbody>
                                          <?php
//`tbl_tablebillmaster`(`bm_billno`, `bm_dayclosedate`, `bm_billtime`, `bm_branchid`, `bm_subtotal`, `bm_paymode`, `bm_cancelamount`, `bm_discountid`, `bm_corporatecode`, `bm_discountvalue`, `bm_servicetax`, `bm_vat`, `bm_servicecharge`, `bm_credit`, `bm_creditroom`, `bm_creditstaff`, `bm_complimentary`, `bm_complimentaryremark`, `bm_finaltotal`, `bm_amountpaid`, `bm_amountbalace`, `bm_transactionid`, `bm_voucherid`, `bm_couponcompany`, `bm_couponamt`, `bm_chequeno`, `bm_chequebankname`)	
	  //$cur=date("Y-m-d");
	 $string="( b.bm_status= 'Cancelled' OR b.bm_status= 'Cancelled for Split')  AND ";
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " b.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " b.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " b.bm_dayclosedate between '".$from."' and '".$to."' ";
		}
	else
	{
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="b.bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.="b.bm_dayclosedate between CURDATE( ) - INTERVAL 10 
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
				  $string.=" b.bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
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
	 $final=0;
  $paid=0;
  $bal=0; 
 	  $sql_login  =  $database->mysqlQuery("select DISTINCT b.bm_dayclosedate,b.bm_billno,b.bm_billtime,b.bm_paymode,b.bm_cancelled_date_time,b.ter_cancelledreason,b.bm_finaltotal,b.ter_cancelledlogin,s.ser_firstname,s.ser_lastname from tbl_tablebillmaster b left join tbl_staffmaster s on b.ter_cancelledby_careof=s.ser_staffid where $string order by b.bm_dayclosedate"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1; $cancelledreason="";
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
		/*	$paid=$paid +$result_login['bm_amountpaid'];
			$bal=$bal + $result_login['bm_amountbalace'];*/
	 ?>
    						<tr >
                            <td><?=$i?></td>
                             <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
                             <td><?=$result_login['bm_billno']?></td>
                              <td width="100px"><?=$result_login['bm_billtime']?></td>
                              <td width="100px"><?=$result_login['bm_cancelled_date_time']?></td>
                                 <td><?=$cancelledreason?></td>
                              <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
                              <td width="20px"><?=$paid?></td>
                            <!--  <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                              <td><?=number_format($result_login['bm_amountbalace'],$_SESSION['be_decimal'])?></td>-->
                              <td><?=$result_login['ser_firstname'].' '.$result_login['ser_lastname']?></td>
                              <td width="100px"><?=$result_login['ter_cancelledlogin']?></td>
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
  
    <!-- <td >&nbsp;</td>
     <td>&nbsp;</td>-->
  </tr>
  <tr class="main">
<!--    <td ><strong>TOTAL</strong></td>-->
    <td ></td>
    <td ></td>
    <td></td>
    <td></td>
     <td></td>
     <td ><strong>TOTAL</strong></td>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
  <!--  <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
    <td ><strong><?=number_format($bal,$_SESSION['be_decimal'])?></strong></td>-->
    <td></td>
    <td></td>
    <td></td>
  </tr>                         
                           </tbody>
                            </table>


<?php }
else if(($_REQUEST['type']=="no_sale_report"))
{
			
		
	$string="";
	//$string.="tab_mode='CS' AND";
	$reporthead="";
	$st="";
	
	

		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		
		

		
		
		if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			 $string.= " o.ter_dayclosedate between '".$from."' and '".$to."' ";
			 $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " o.ter_dayclosedate between '".$from."' and '".$to."' ";
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " o.ter_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']=="")
		{

		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";

	}else if($bydatz=="Last10days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	else if($bydatz=="Last15days")
	{
		$string.=" tab_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	

else if($bydatz=="Yesterday")
			  {
				  $string.=" o.ter_dayclosedate = CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
				  
			  }
	else if($bydatz=="Last1month")
	{
		$string.="  o.ter_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";
	}
else if($bydatz=="Last90days")
	{
		$string.=" o.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
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
	else{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= " o.ter_dayclosedate between '".$from."' and '".$to."' order by o.ter_dayclosedate";
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
		}
		
					
		
	  
	  //$num_login   = $database->mysqlNumRows($sql_login);
	
	
	?>
     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>No Sale Report</strong></th>
      </tr>

      
    </thead>
    </table>
    
	<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  
                                 
                                  <tr>
                                  	<th colspan="10">Report- <?=$reporthead;?></th>
                                  
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
$sql_login  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,sc.msy_subcategoryname,m.mr_menuname FROM tbl_menumaster m 
LEFT JOIN tbl_menumaincategory mc ON MC.mmy_maincategoryid = m.mr_maincatid
LEFT JOIN tbl_menusubcategory sc ON SC.msy_subcategoryid = m.mr_subcatid
where m.mr_menuid NOT IN(SELECT o.ter_menuid from tbl_tableorder o where $string)
ORDER BY m.mr_maincatid,m.mr_subcatid  DESC");
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1; $old_category='';$category='';
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
	 ?>

    						<tr >
                            <td><?=$i?></td>
                             <td><?=$category?></td>
                               <td><?=$result_login['msy_subcategoryname'];?></td>
                               <td><?=$result_login['mr_menuname'];?></td>
                              
                              </tr> 
                             
                              
                              
                              
                              
                              <?php $i++;} } ?>
                              
                              
 
                      
                             
                           </tbody>
                            </table
                            
                            <?php
}	
else if(($_REQUEST['type']=="regenerate_bill_logs"))
{
			
		$string="";
	//$string.="tab_mode='CS' AND";
	$reporthead="";
	$st="";
	
	

		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		
		

		
		
		if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			 $string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
			 $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']=="")
		{

		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";

	}else if($bydatz=="Last10days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	else if($bydatz=="Last15days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" Dbm.bm_billdate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm.bm_billdate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
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
		$string.="  bm.bm_billdate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
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
	else{
		$from=date("Y-m-d");
		$to=date("Y-m-d");
		$string.= " bm.bm_billdate between '".$from."' and '".$to."' ";
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
		}
		
					
		
	  
	  //$num_login   = $database->mysqlNumRows($sql_login);
	
	
	?>
     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Regenerate Bill Logs</strong></th>
      </tr>

      
    </thead>
    </table>
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
									
                                          <?php $before_regen=0; $after_regen=0;
$sql_login  =  $database->mysqlQuery("select bm.bm_billdate,bm.bm_finaltotal,bm.bm_billno,r.re_new_bill_no,r.re_billno,r.re_amount,r.re_order_no,DATE(r.re_datetime) AS Date, s.ser_firstname,r.re_reason,r.re_loginid from tbl_regenrate_log r left join tbl_staffmaster s on r.re_staffid=s.ser_staffid left join tbl_tablebillmaster bm on bm.bm_billno=r.re_billno where $string
 order by r.re_billno  ASC");
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
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
                             
                              <?php $i++;} } ?>
                              
                              
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
                              </tr> 
                      
                             
                           </tbody>
                            </table>
	
                            
                            <?php
}	
else if($_REQUEST['type']=="type_pay") {  ?>
<!--
  <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6"><img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Type of Payment</strong></th>
     
      </tr>
    </thead>
    </table>-->
    
   
      <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="6"><strong>Payment Report</strong></th>
      </tr>

      
    </thead>
    </table>
      
    
    
    
    
    
    
    
    
    
    
<?php

$reporthead="";
$st="";
 /*  $string="bm_status='closed' ";*/
	
	$fields="";
	if($_REQUEST['types']=="cash")
	{
		//$string = " bm_transactionid ='' and bm_couponcompany ='' and bm_voucherid ='' and bm_chequeno ='' and bm_chequebankname=''";
		//$string = " (bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)";
	/*	$string = " ";*/
	
		//$string = " (bm_amountpaid-bm_amountbalace) >0 and bm_status='closed'  ";
		$string = " ((p.pym_code='cash') or (p.pym_code='credit') or (p.pym_code='coupon') or (p.pym_code='voucher') or (p.pym_code='cheque') or (p.pym_code='credit_person') or (p.pym_code='complimentary')) and b.bm_status='closed' and ((b.bm_amountpaid-b.bm_amountbalace) > 0) ";
	
	$fields="<th style='font-size:20px; '><strong>Cash</strong></th>";
	}else if($_REQUEST['types']=="credit")
	{
		//$string = " bm_transactionamount <>'' ";
		$string = " pym_code='credit' and bm_transcbank <> '0' and bm_status='closed'";
		
		$fields="<th style='font-size:20px; '><strong>Bank</strong></th>";
                $fields.="<th style='font-size:20px; '><strong>Card Payment</strong></th>";
		//$fields.="<th style='font-size:20px; '><strong>Cash</strong></th>";
		
	}else if($_REQUEST['types']=="coupons")
	{
		//$string = " bm_couponcompany <>''  and bm_couponamt <>'0.00'";
		$string = " pym_code='coupon' and bm_status='closed'";
		$fields="<th style='font-size:20px; '><strong>Coupon Company</strong></th>";
		$fields.="<th style='font-size:20px; '><strong>Coupon Amount</strong></th>";
			$fields.="<th style='font-size:20px; '><strong>Paid</strong></th>";
	}else if($_REQUEST['types']=="voucher")
	{
		//$string = " bm_voucherid <>''";
		$string = " pym_code='voucher' and bm_status='closed'";
		$fields="<th style='font-size:20px; '><strong>Voucher</th>";
			$fields.="<th style='font-size:20px; '><strong>Paid</strong></th>";
	}else if($_REQUEST['types']=="cheque")
	{
		//$string = " bm_chequeno <>'' and bm_chequebankname<>''";
		$string = " pym_code='cheque' and bm_status='closed'";
		$fields="<th style='font-size:20px; '><strong>Cheque No</strong></th>";
		$fields.="<th style='font-size:20px; '><strong>Bank Name</strong></th>";
			$fields.="<th style='font-size:20px; '><strong>Paid</strong></th>";
			
	}
	
	//fromdt todt
	
	if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " and bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
					$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " and bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
					$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " and bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}else if($_REQUEST['from']=="" && $_REQUEST['to']=="")
		{
			/*$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and bm_dayclosedate between '".$from."' and '".$to."' order by bm_dayclosedate";*/
			
			
			
			
			/*$cur=date("Y-m-d");
			$string.=" and  bm_dayclosedate='".$cur."'";*/
			
				$paybydate=$_REQUEST['hidpay'];
		if($paybydate!="null")
	{
		
		
	if($paybydate=="Last5days")
	{
		$string.="  and bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($paybydate=="Last10days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($paybydate=="Last15days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($paybydate=="Last20days")
	{
		$string.="  and bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($paybydate=="Last25days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($paybydate=="Last30days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($paybydate=="Today")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	
	else if($paybydate=="Yesterday")
			  {
				  $string.=" and bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
				  $st="Yesterday";
			  }
	else if($paybydate=="Last1month")
	{
		$string.="  and bm_dayclosedate between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
$st="Last 1 month";
	}
	
	
	else if($paybydate=="Last90days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 3
MONTH AND CURDATE( )";
$st="Last 3 months";
	}
	else if($paybydate=="Last180days")
	{
		$string.=" and bm_dayclosedate between CURDATE( ) - INTERVAL 6 
MONTH AND CURDATE( )";
$st="Last 6 months";
	}
	else if($paybydate=="Last365days")
	{
		$string.="  and bm_dayclosedate between CURDATE( ) - INTERVAL 1 
YEAR AND CURDATE( )";
$st="Last 1 year";
	}
	
$reporthead=$st;	
	
	}
	else
	{
			$cur=date("Y-m-d");
			$string.="  and  bm_dayclosedate='".$cur."'";
				$reporthead="From ".$database->convert_date($cur)."- To ".$database->convert_date($cur);
	}
		
		}

 ?>

	 <table class="table table-bordered table-font user_shadow" >
    <thead>
       <tr>
                                  	<th colspan="9">Report - <?=$reporthead?></th>
                                  </tr>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
        <th style="font-size:15px; "><strong>Date</strong></th>
        
     
        
        <th style="font-size:15px; "><strong>Bill No</strong></th>
           <?=$fields ?>
        <th style="font-size:15px"><strong>Final</strong></th>

      </tr>
    </thead>
    <tbody>
<?php
$final=0;
  $paid=0;
  $bal=0; 
  $coup=0;
  $paidcrdt=0;
  $paidcredit=0;
  
	  $sql_login  =  $database->mysqlQuery("select bm_finaltotal,bm_amountpaid,bm_transactionamount,bm_amountbalace,bm_dayclosedate,bm_billno,bm_name,
	  bm_couponamt,bm_couponcompany,bm_voucherid,bm_chequeno,bm_chequebankname from tbl_tablebillmaster b LEFT JOIN tbl_bankmaster ON b.bm_transcbank=tbl_bankmaster.bm_id LEFT JOIN tbl_paymentmode p ON b.bm_paymode= p.pym_id where $string"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
			$final=$final + $result_login['bm_finaltotal'];
			$paid=$paid +$result_login['bm_amountpaid'];
                        
                        $paidcredit=$paidcredit+$result_login['bm_transactionamount'];
			$paidcrdt=$paidcrdt + ($result_login['bm_amountpaid']-$result_login['bm_amountbalace']);
			
	 ?>
     <tr >
        <td><?=$i?></td>
         <td><?=$database->convert_date($result_login['bm_dayclosedate'])?></td>
           <td><?=$result_login['bm_billno']?></td>
           
           <?php
            if($_REQUEST['types']=="cash")
            {?>
            
                  <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
            <?php }else if($_REQUEST['types']=="credit")
            {
                ?>
                
                                     <td><?=$result_login['bm_name']?></td>
                                     <td><?=number_format($result_login['bm_transactionamount'],$_SESSION['be_decimal'])?></td>
<!--                                    <td><?=$result_login['bm_amountpaid']-$result_login['bm_amountbalace']?></td>-->
                <?php
                
            }else if($_REQUEST['types']=="coupons")
            {$coup=$coup + $result_login['bm_couponamt'];
                ?>
                <td><?=$result_login['bm_couponcompany']?></td>
                <td><?=number_format($result_login['bm_couponamt'],$_SESSION['be_decimal'])?></td>
                   <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                <?php
            }else if($_REQUEST['types']=="voucher")
            {
                ?>
                <td><?=$result_login['bm_voucherid']?></td>
                  <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                <?php
            }else if($_REQUEST['types']=="cheque")
            {
                ?>
                <td><?=$result_login['bm_chequeno']?></td>
                <td><?=$result_login['bm_chequebankname']?></td>
                   <td><?=number_format($result_login['bm_amountpaid'],$_SESSION['be_decimal'])?></td>
                <?php
            }
            ?>
          <td><?=number_format($result_login['bm_finaltotal'],$_SESSION['be_decimal'])?></td>
        <?php /*?>  <td><?=$result_login['bm_amountpaid']?></td>
          <td><?=$result_login['bm_amountbalace']?></td><?php */?>
          </tr> 
          <?php $i++;} } ?>
                              
  <tr>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <?php
	if($_REQUEST['types']=="cash")
	{?>
     <td >&nbsp;</td>
	<?php }
	 else if($_REQUEST['types']=="credit")
	  {
		  ?>
		  
           <td >&nbsp;</td>
            <td >&nbsp;</td>
		  <?php
		  
	  }else if($_REQUEST['types']=="coupons")
	  {
		  ?>
		  <td >&nbsp;</td>
		  <td >&nbsp;</td>
            <td >&nbsp;</td>
		  <?php
	  }else if($_REQUEST['types']=="voucher")
	  {
		  ?>
		  <td >&nbsp;</td>
            <td >&nbsp;</td>
		  <?php
	  }else if($_REQUEST['types']=="cheque")
	  {
		  ?>
		  <td >&nbsp;</td>
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
	 if($_REQUEST['types']=="cash")
	 {?>
		  <td ><strong><?=number_format($paidcrdt,$_SESSION['be_decimal'])?></strong></td>
	 <?php }
	  else if($_REQUEST['types']=="credit")
	  {
		  ?>
		  <td >&nbsp;</td>
           <td><strong><?=number_format($paidcredit,$_SESSION['be_decimal'])?></strong></td>
          
		  <?php
		  
	  }else if($_REQUEST['types']=="coupons")
	  {
		  ?>
		  <td >&nbsp;</td>
		  <td><?=number_format($coup,$_SESSION['be_decimal'])?></td>
           <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
		  <?php
	  }else if($_REQUEST['types']=="voucher")
	  {
		  ?>
		  <td >&nbsp;</td>
           <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
		  <?php
	  }else if($_REQUEST['types']=="cheque")
	  {
		  ?>
		  <td >&nbsp;</td>
		  <td >&nbsp;</td>
           <td ><strong><?=number_format($paid,$_SESSION['be_decimal'])?></strong></td>
		  <?php
	  }
	  ?>
    <td ><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
 <?php /*?>   <td ><strong><?=$paid?></strong></td>
    <td ><strong><?=$bal?></strong></td><?php */?>
  </tr>
                              
                             
                           </tbody>
                            </table>
                            
<?php }
else if($_REQUEST['type']=="item") {   ?>
  <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="6"><strong>Menu</strong></th>
      </tr>

      
    </thead>
    </table>
    <?php
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
        
        
        
	?>
    <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr>
      <th >Category</th>
       <th >Sub Category</th>
        <th>Items</th>
        
        
        <?php
        if( $floor=='' && $mode=='DI' ){
        $sql_login  =  $database->mysqlQuery("select fr_floorname from tbl_floormaster "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){ $count_flr=0;
	while($result_login  = $database->mysqlFetchArray($sql_login)) 
	{
             $count_flr++;
        ?>
        
         <th >Floor - <?=$result_login['fr_floorname']?></th>
        <?php } } }else if($floor!='' && $mode=='DI' ){
            $sql_login  =  $database->mysqlQuery("select fr_floorname from tbl_floormaster where  and fr_floorid='".$_REQUEST['floorvals']."' "); 
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
                                    }
                                                        
                                                        
						 ?> 
                                  
                                 <tr>
                                  <td colspan="1" style="text-align:left"></td>
                                  <td colspan="1" style="text-align:left"><?=$menusub['msy_subcategoryname']?></td>
                                  <td  <?php if($floor==''){ ?> colspan="<?=$col1?>" <?php } else{ ?>  colspan="2"   <?php } ?>     style="text-align:left"> </td>
                                  </tr> 
                                  
                                  <?php
								
				
				$sql_menulist_dine= "select tm.mr_menuid,tm.mr_menuname from tbl_menumaster tm  WHERE  tm.mr_active='Y'   and  tm.mr_maincatid='".$result_cat['catid']."' and (tm.mr_subcatid='".$result_sub['subid']."' OR  tm.mr_subcatid IS NULL)  order by tm.mr_subcatid ";
		
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
								}
                                   
				?>
                            	        <tr>
                                  	<td colspan="1"></td>
                                  	<td colspan="1"></td>
                                        <td colspan="1" style="text-align:left"><?=$menuname?> </td>
                                    
                                    
                                    <?php if($mode=='DI' && $_REQUEST['floorvals']==''){
                                        
                                        for($i=1;$i<=$count_flr;$i++){
                                        ?>
                                      
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
	}
	
	?>
         </tbody>
     </table>
   

<?php }
else if(($_REQUEST['type']=="steward"))
{
	$stw=$_REQUEST['stwr'];
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
              
                        
          $string1.=" ch.ch_cancelledby_careof ='".$_REQUEST['stwr']."' and ";   
          
                        
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
	if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " and ( bm.bm_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                         $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " and ( bm.bm_dayclosedate between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                         $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " and ( bm.bm_dayclosedate  between '".$from."' and '".$to."' )  ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                         $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		}else if($_REQUEST['from']=="" && $_REQUEST['to']=="" && ($stewardbydate=='' || $stewardbydate=='null' ))
		{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " and ( bm.bm_dayclosedate between '".$from."' and '".$to."' )  ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
                        
                        $string1.= " ch.ch_dayclosedate between '".$from."' and '".$to."'  ";
		} 
		?>


 <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid "colspan="6"><img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
              
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="6"><strong>Steward Report</strong></th>
      </tr>
    </thead>
    </table>
<?php                                           
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
	  if($num_stw){$i=1;
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
                        
	  }
	  ?>
                <tr><td colspan="4"></td></tr>
                <tr>
                    
                    <td colspan="2" style="text-align:center"><strong>TOTAL</strong></td>
                    <td colspan="1" style="text-align:center"><strong><?= $total_count ?></strong></td>
                    <td colspan="1" style="text-align:center"><strong><?= number_format($total_amount,$_SESSION['be_decimal']) ?></strong></td>
                  
                  
                </tr>
      </tbody>
      </table>
      <?php
      
}else{
    
  
    if($_REQUEST['stw_mode']=='Sale'){
    
    
    ?>
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
                        
	  }
	  ?>
                <tr><td colspan="4"></td></tr>
                <tr>
                    
                    <td colspan="1" style="text-align:center"><strong>TOTAL</strong></td>
                    <td colspan="1" style="text-align:center"></td>
                      <td colspan="1" style="text-align:center"></td>
                          <td colspan="1" style="text-align:center"><strong><?= number_format($total_amount1,$_SESSION['be_decimal']) ?></strong></td>
                  
                  
                </tr>
      </tbody>
      </table>
      <?php
      
}else if($_REQUEST['stw_mode']=='Cancel'){
    
    
      ?>
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
        FROM   tbl_tablebillmaster bm where $string and  bm.bm_steward = '".$stw."' group by bm.bm_dayclosedate  ");
       
	
 	 
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
                        
	  }
	  ?>
                <tr><td colspan="4"></td></tr>
                <tr>
                    
                    <td colspan="1" style="text-align:center"><strong>TOTAL</strong></td>
                    <td colspan="1" style="text-align:center"></td>
                     <td colspan="1" style="text-align:center"></td>
                          <td colspan="1" style="text-align:center"><strong><?= number_format($total_amount1,$_SESSION['be_decimal']) ?></strong></td>
                  
                  
                </tr>
      </tbody>
      </table>
      <?php
    
    
    
}else{
    
        
          
          ?>
          
          
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
			{
                 		
	           ?>

                             
                              
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

}



}
else if($_REQUEST['type']=="steward_timely")
 {
	   
//$reporthead="";
//$st="";
 $string="";
 $stewardbydate=$_REQUEST['hidstwdate'];
	if($_REQUEST['hidstw']!='')
		{
			$stw=$_REQUEST['hidstw'];
			
				$string.="tbl_tableorder.ter_staff =  '".$stw."'    ";
			
		}
	
	
	
	
	
	
	if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$_REQUEST['hidfr'];
			$to=$_REQUEST['hidto'];
			if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";
			}
			else
			{
					$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."'  )  ";
			}
				//$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$_REQUEST['hidfr'];
		 $to = date('H:i');
		 if($string !="")
		 {
			$string.= " and ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' ) ";
		 }
		 else
		 {
			 	$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."'  )  ";
		 }
			//	$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from = date('H:i');
			$to=$_REQUEST['hidto'];
			if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."' )  ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."'  )  ";
			}
			//	$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}else if($_REQUEST['hidfr']=="" && $_REQUEST['to']=="")
		{
			$from = date('H:i');
			 $to = date('H:i');
			 if($string !="")
			 {
			 	$string.= " and ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."'  )  ";
			 }
			 else
			 {$string.= "  ( tbl_tableorder.ter_entrytime  between '".$from."' and '".$to."' and tbl_tableorder.ter_entrydate='".$stewardbydate."'  )  ";
			 }
			} ?>
        
        
      <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid "colspan="6"><img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="6"><strong>Steward_Timely Report</strong></th>
      </tr>

      
    </thead>
    </table>
        
		<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  <!--  <tr>
                                  	<th colspan="3">Report - <?=$reporthead?></th>
                                  </tr>-->
									<tr>
                                    <th >Sl no</th>
                                     <th >Item</th>
									  <th >Count</th>
                                      <th>Entry Time</th>
									</tr>
								  </thead>
								  <tbody>
       <?php
 	  $sql_stw  =  $database->mysqlQuery("Select sum(tbl_tableorder.ter_qty) as ct,tbl_tableorder.ter_entrytime,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid Where   $string Group By tbl_menumaster.mr_menuname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				?>
                <tr>
                  <td  style="text-align:left"><?=$i++?> </td>
                  <td  style="text-align:left"><?=$result_stw['menuname']?></td>
                  <td  style="text-align:left"><?=$result_stw['ct']?></td>
                  <td style="text-align:left"><?=$result_stw['ter_entrytime']?></td>
                </tr>
                <?php
			}
	  }
	  ?>
      </tbody>
      </table>
      <?php
	


 
	 
	 
	 
 }
else if($_REQUEST['type']=="items_ordered_timely")
 {
   $string="o.ter_status='Closed'";
	$reporthead="";
	$st="";
										  
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$_REQUEST['hidfr'];
			$to=$_REQUEST['hidto'];
			
			if($string !="")
			{
				 $string.= " and o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			else
			{
		$string.= "o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
			//$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
						
			
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
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
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
		//	$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
						
			
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
				$string.= "o.ter_entrytime  between '".$from."' and '".$to."' and o.ter_entrydate='".$_REQUEST['entrydate']."' ";
			}
		//$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					
			
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
	else
	{
		
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
	
								 
										 
									
	
	
	
	
	?>
 
 
 
 
 
 
 
 
 
<!--  <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6"> <img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Item Ordered Report</strong></th>
     
      </tr>
    </thead>
    </table>-->  
          <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="6"><strong>Order Report</strong></th>
      </tr>

      
    </thead>
    </table>                    		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
    
     <?php if($reporthead !="")
								  {?>
									  <tr>
                                  	<th colspan="8">Report - <?=$reporthead?></th>
                                  </tr>
								  <?php }?>
    
    
      <tr bgcolor="#000000">
      <th style="font-size:15px; "><strong>Category</strong></th>
     <th style="font-size:15px; "><strong>Sub Category</strong></th>
        <th style="font-size:15px; "><strong>Item</strong></th>
            <th style="font-size:15px; "><strong>Entry Time</strong></th>
          <th style="font-size:15px; "><strong>Portion</strong></th>
            <th style="font-size:15px; "><strong>Floor</strong></th>
              <th style="font-size:15px; "><strong>Qty</strong></th>
                <th style="font-size:15px; "><strong>Unit Price</strong></th>
                  <th style="font-size:15px; "><strong>Total</strong></th>
      </tr>
    </thead>
    <tbody>
     
     <?php
	$final=0;


	
	
 	  $sql_stw  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,o.ter_entrytime as entrytime,p.pm_portionname,f.fr_floorname,sum(o.ter_qty) as qty,ROUND(avg(o.ter_rate),'".$_SESSION['be_decimal']."') as Unit_Price, ((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), '".$_SESSION['be_decimal']."'))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $string group by m.mr_maincatid ,m.mr_subcatid,o.ter_menuid,o.ter_portion,o.ter_floorid ORDER BY m.mr_maincatid,m.mr_subcatid  DESC"); 
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
              
                <?php
			
	  }
	  ?>
	
    </tbody>
    </table>
	<?php
 
 
	 
	 
	 
	 
	 
	 
	 
 }
 
else if($_REQUEST['type']=="order") { 
 
   $string="";
	$string="bm.bm_status = 'Closed'";
        $floor_name='';
        if(isset ($_REQUEST['floorz']))
	{
		
		$floorvalue=$_REQUEST['floorz'];
                if($floorvalue!="")
                {
		
		$string.="and bm.bm_floorid='".$floorvalue."'";
                $sql_floor  =  $database->mysqlQuery("select fr_floorname FROM tbl_floormaster where fr_floorid='".$floorvalue."'"); 
                            $num_floor   = $database->mysqlNumRows($sql_floor);
                            if($num_floor)
                            {
                              $result_floor  = mysqli_fetch_array($sql_floor);
                              $floor_name=$result_floor['fr_floorname'];
                            } 
                }
	}
            $string_addon="";
            if($_REQUEST['addon']=='N')
            {  
            $string_addon.=" and bd.bd_bill_addon_slno IS NULL ";
           
            }
            else if($_REQUEST['addon']=='Y')
            {   
            $string_addon.=" and bd.bd_bill_addon_slno IS NOT NULL";
           
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

	
	
	
	?>
 
 
 
 
 
 
 
 
 
<!--  <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6"> <img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Item Ordered Report</strong></th>
     
      </tr>
    </thead>
    </table>-->  
          <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="6"><strong>Item Order Report <?php if($floor_name!='') { echo '-'.$floor_name; }?></strong></th>
      </tr>

      
    </thead>
    </table>                    		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
    
     <?php if($reporthead !="")
								  {?>
									  <tr>
                                  	<th colspan="8">Report - <?=$reporthead?></th>
                                  </tr>
								  <?php }?>
    
    
      <tr bgcolor="#000000">
           <th style="font-size:15px; "><strong>Sl.No</strong></th>
      <th style="font-size:15px; "><strong>Category</strong></th>
     <th style="font-size:15px; "><strong>Sub Category</strong></th>
        <th style="font-size:15px; "><strong>Item</strong></th>
          <th style="font-size:15px; "><strong>Portion</strong></th>
            
              <th style="font-size:15px; "><strong>Qty</strong></th>
                <th style="font-size:15px; "><strong>Unit Price</strong></th>
                  <th style="font-size:15px; "><strong>Total</strong></th>
      </tr>
    </thead>
    <tbody>
     
     <?php
	$final=0;


	
	
 	  $sql_stw  =  $database->mysqlQuery("SELECT mc.mmy_maincategoryname,ms.msy_subcategoryname,m.mr_menuname,p.pm_portionname,sum(bd.bd_qty) as qty,ROUND(avg(bd.bd_rate), '".$_SESSION['be_decimal']."') as Unit_Price, sum(bd.bd_amount) as Total from tbl_tablebilldetails bd left join tbl_menumaster m on m.mr_menuid = bd.bd_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = bd.bd_portion left join tbl_tablebillmaster bm on bm.bm_billno=bd.bd_billno where $string $string_addon group by m.mr_maincatid ,m.mr_subcatid,bd.bd_menuid ORDER BY mc.mmy_maincategoryname,m.mr_menuname ASC"); 
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
                    <td colspan="1" style="text-align:center"><?=$i?></td>
          <td colspan="1" style="text-align:left"><strong><?=$catname?></strong></td>
                  <td colspan="1" style="text-align:left"><?=$result_stw['msy_subcategoryname']?></td>
                    <td colspan="1" style="text-align:left"><?=$result_stw['mr_menuname']?></td>
                    <td colspan="1" style="text-align:left"><?=$result_stw['pm_portionname']?></td>
                    
                      
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
           <td><strong><?=number_format($final,$_SESSION['be_decimal'])?></strong></td>
			</tr>
              
                <?php
			
	  }
	  ?>
	
    </tbody>
    </table>
	<?php
 
 }
 //------kitchen wise starts ----
else if($_REQUEST['type']=="kitchen_wise") { 
 
   $string="o.ter_status='Closed'";
                                   
									
										  $reporthead="";
										  $st="";
										  
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
		  
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			
			if($string !="")
			{
				$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
						
			$menuitem="";
			if($_REQUEST['byflr']!="")
                        {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
                $menuitem=$_REQUEST['item'];
                if($menuitem !=""){
                    $string.=" and o.ter_menuid ='".$menuitem."' ";
                }
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
			
	     }
			
			
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
		if($string !="")
			{
				$string.= "and o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			else
			{
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
						
			
								if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
                $menuitem=$_REQUEST['item'];
                 if($menuitem !=""){
                    $string.=" and o.ter_menuid ='".$menuitem."' ";
                }
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
			
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
				$string.= " o.ter_dayclosedate  between '".$from."' and '".$to."' ";
			}
		$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
					
			
								if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
                $menuitem=$_REQUEST['item'];
                 if($menuitem !=""){
                    $string.=" and o.ter_menuid ='".$menuitem."' ";
                }
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
			
	     }
		
		}
	else
	{
			$orderbydate=$_REQUEST['hidbydate'];
	
			if($orderbydate!="null")
	{
	if($orderbydate=="Last5days")
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
		
		
$st="Last 5 days";
	}elseif($orderbydate=="Last10days")
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
$st="Last 10 days";
	}
	elseif($orderbydate=="Last15days")
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
$st="Last 15 days";
	}
	else if($orderbydate=="Last20days")
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
$st="Last 20 days";
	}
	else if($orderbydate=="Last25days")
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
$st="Last 25 days";
	}
	else if($orderbydate=="Last30days")
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
$st="Last 30 days";
	}
	else if($orderbydate=="Today")
	{
	if($string !="")
		{
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		}
		else
		{
			$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 		
		}
		$st="Today";
	}

else if($orderbydate=="Yesterday")
			  {
				    if($string !="")
				  {
					    $string.=" and o.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  }
				  else
				  {
					    $string.=" o.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
				  }
				  $st="Yesterday";
			  }
	else if($orderbydate=="Last1month")
	{
			  if($string !="")
				  {
					    $string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
				  else
				  {
					    $string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  }
$st="Last 1 month";
	}

	else if($orderbydate=="Last90days")
	{
	if($string !="")
		{
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		}
		$st="Last 3 months";
	}
		else if($orderbydate=="Last180days")
	{
	if($string !="")
		{
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
		else
		{
			$string.=" o.ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		}
		$st="Last 6 months";
	}
		else if($orderbydate=="Last365days")
	{
		if($string !="")
		{	
		$string.=" and o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			
		}
		else
		{
			$string.="o.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		}
		$st="Last 1 year";
	}
	$reporthead=$st;
	
	
				if($_REQUEST['byflr']!="")
	    {
			   $bycat=$_REQUEST['byflr'];
			if($string !="")
			{
	 
		$string.=" and m.mr_kotcounter='".$bycat."' ";
                $menuitem=$_REQUEST['item'];
                 if($menuitem !=""){
                    $string.=" and o.ter_menuid ='".$menuitem."' ";
                }
			}
			else
			{
					 
		$string.="m.mr_kotcounter='".$bycat."' ";
			}
			
	     }
	
	
	
	
	
	}
	else
	{
			$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string !="")
			{
			
			$string.= " and o.ter_dayclosedate   between '".$from."' and '".$to."' ";
			}
			else
			{	
			$string.= " o.ter_dayclosedate   between '".$from."' and '".$to."' ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
			
		 $byflr=$_REQUEST['byflr'];

		if($byflr !="")
	{
		if($string!="")
		{
			$string.=" and  m.mr_kotcounter LIKE  '%" . $byflr ."%'";
		}else
		{
			$string.=" m.mr_kotcounter  LIKE  '%" . $byflr ."%'";
		}
                 if($menuitem !=""){
                    $string.=" and o.ter_menuid ='".$menuitem."' ";
                }
	}	 
		
	}
	}  
	
								 
										 
									
	
	
	
	
	?>
 
 
 
 
 
 
 
 
 
<!--  <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6"> <img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Item Ordered Report</strong></th>
     
      </tr>
    </thead>
    </table>-->  
          <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="6"><strong>Order Report</strong></th>
      </tr>

      
    </thead>
    </table>                    		 
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

///----------
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
    echo "<tr>";
    echo "<td>".$slno."</td>";
    echo "<td>".$result_ktc['kr_kotname']."</td>";
    echo "<td></td><td></td><td></td>";
    echo "<tr>";
                $sql_itm  =  $database->mysqlQuery("select m.mr_kotcounter,o.ter_menuid, m.mr_menuname,sum(o.ter_qty) as qty, o.ter_rate*sum(o.ter_qty) as tot from tbl_tableorder o
inner join tbl_menumaster m on m.mr_menuid = o.ter_menuid
where m.mr_kotcounter = '".$result_ktc['mr_kotcounter']."' and $string
group by o.ter_menuid");

          $num_itm   = $database->mysqlNumRows($sql_itm);
          if($num_itm){
            while($result_ktc  = $database->mysqlFetchArray($sql_itm)) {
                 echo "<tr>";
                 echo "<td></td><td></td>";
                
                echo "<td>".$result_ktc['mr_menuname']."</td>";
                echo "<td>".$result_ktc['qty']."</td>";
                 echo "<td><strong>".number_format($result_ktc['tot'],$_SESSION['be_decimal'])."</strong></td>";
                echo "</tr>";
                $qty = $qty + $result_ktc['qty'];
                $total = $total + $result_ktc['tot'];
          }
          }
  }
}

       //---------
       ?>
                                                                      <tr><td colspan="5"></td></tr>
          
                                                                      <tr>
                                                                          <td><strong>TOTAL</strong></td>
                                                                          <td></td>
                                                                          <td></td>
                                                                          <td><strong><?= $qty ?></strong></td>
                                                                          <td><strong><?= number_format($total,$_SESSION['be_decimal']) ?></strong></td>
                                                                      </tr>
			
	
      </tbody>
      </table>
	<?php
 
 }
 //---------kitchen wise end--------
 
else if($_REQUEST['type']=="portion_order") {  
    $portion=$_REQUEST['prtn'];
	$string="";
	$reporthead="";
	$st="";
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
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			else
			{
					$string.= " ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ) ";
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
		if($string !="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
					$string.= "( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
				
			}
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}else if($_REQUEST['from']=="" && $_REQUEST['to']=="")
		{
			/*$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "  ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}*/
			
			
			
			/*$from=date("Y-m-d");
			$to=date("Y-m-d");
			if($string!="")
			{
			$string.= " and ( tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
			}
			else
			{
				$string.= "(tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' )  ";
				
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
		
		$string.=" and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";


			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
			}
			
			$st="Last 5 days";
			
	}elseif($portionbydate=="Last10days")
	{
		
			if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
			}
				$st="Last 10 days";
	}
	elseif($portionbydate=="Last15days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
			}
			$st="Last 15 days";
	}
	else if($portionbydate=="Last20days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
			}
				$st="Last 20 days";
	}
	else if($portionbydate=="Last25days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
			
DAY AND CURDATE( )";
			}
				$st="Last 25 days";
	}
	else if($portionbydate=="Last30days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
			}
			$st="Last 30 days";
	}
	else if($portionbydate=="Today")
	{
			if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			}
				$st="Today";
	}
	
	else if($portionbydate=="Yesterday")
			  {
				  
				  
		if($string!="")
			{
		 $string.="and tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   =  CURDATE() - INTERVAL 1 day"; 
			}
			$st="Yesterday"; 
			  }
	else if($portionbydate=="Last1month")
	{
  if($string!="")
			{
		 $string.="and tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
			}
			$st="Last 1 month"; 
				 
	}
	
	
	
	
	else if($portionbydate=="Last90days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			}
			else
			{
					$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL  3 MONTH AND CURDATE( )"; 
			}
				$st="Last 3 months"; 
			
	}

else if($portionbydate=="Last180days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
			}
			$st="Last 6 months"; 
			
	}
else if($portionbydate=="Last365days")
	{
		if($string!="")
			{
		$string.="and tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
			else
			{
				$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			}
	$st="Last 1 year"; 		
	}
			
			
		$reporthead=$st;	
		}
		else
		{
			//$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			
			
			
		
			
				if($portionbydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";
	}elseif($portionbydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($portionbydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($portionbydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($portionbydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($portionbydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($portionbydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	
	else if($portionbydate=="Yesterday")
			  {
		 $string.=" tbl_tableorder.ter_dayclosedate  =  CURDATE() - INTERVAL 1 day";
		 $st="Yesterday";
			  }
	else if($portionbydate=="Last1month")
	{
		 $string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( ) ";
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
			
		}
			
			
	}
	else
	{
		
	}
			
		
			
			
			
			
			
			
			
		} ?>
        
        
              <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="6"><strong>Portion Report</strong></th>
      </tr>

      
    </thead>
    </table>
        
        
        
        
        
        
        
        
        
        
		
		<table class="table table-bordered table-font user_shadow" >
								  <thead>
                                  
                                    <tr>
                                  	<th colspan="4">Report - <?=$reporthead?></th>
                                  </tr>
                                  
                                  
                                  
                                  
									<tr>
                                    <th >Sl no</th>
                                     <th >Item</th>
									  <th >Count</th>
                                      <th><?=$_SESSION['s_portionname']?></th>
									</tr>
								  </thead>
								  <tbody>
       <?php
 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_portionmaster.pm_portionname,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid Inner Join tbl_staffmaster On tbl_tableorder.ter_staff = tbl_staffmaster.ser_staffid inner join tbl_portionmaster ON tbl_tableorder.ter_portion=tbl_portionmaster.pm_id where  $string Group By tbl_menumaster.mr_menuname,tbl_portionmaster.pm_portionname order by ct DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				?>
                <tr>
                  <td  style="text-align:left"><?=$i++?> </td>
                  <td  style="text-align:left"><?=$result_stw['menuname']?></td>
                  <td  style="text-align:left"><?=$result_stw['ct']?></td>
                      <td  style="text-align:left"><?=$result_stw['pm_portionname']?></td>
                </tr>
                <?php
			}
	  }
	  ?>
      </tbody>
      </table>
      <?php
	


 }
 
else if($_REQUEST['type']=="type_order") { ?>
<!--  <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6">   <img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Type of order Report</strong></th>
     
      </tr>
    </thead>
    </table>     -->   
    
          <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="6"><strong>Type of order Report </strong></th>
      </tr>
    </thead>
    </table>
                  		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:15px; "><strong>Sl No</strong></th>
     <th style="font-size:15px; "><strong>Item</strong></th>
        <th style="font-size:15px; "><strong>Count</strong></th>
      </tr>
    </thead>
    <tbody>
                                          <?php
		$string="";
		$ordertyp=$_REQUEST['ordertyp'];
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."'";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string= " tbl_tableorder.ter_dayclosedate  between '".$from."' and '".$to."' ";
		}
	else
	{
		/*$cur=date("Y-m-d");
		$string=" tbl_tableorder.ter_dayclosedate ='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" tbl_tableorder.ter_dayclosedate ='".$cur."'";*/
		
		
		
	$string="";
	
		$ordertypebydate=$_REQUEST['hidorderby'];
	if($ordertypebydate!="null")
	{
		//$search="";
	if($ordertypebydate=="Last5days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	
	else if($ordertypebydate=="Yesterday")
			  {
				  $string.="tbl_tableorder.ter_dayclosedate   =  CURDATE() - INTERVAL 1 day";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
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
		$string.=" tbl_tableorder.ter_dayclosedate   between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		
	
	}  
	?>
     <?php
	
 	  $sql_stw  =  $database->mysqlQuery("Select count(*)  as ct,tbl_menumaster.mr_menuname as menuname From tbl_tableorder  Inner Join tbl_menumaster On tbl_menumaster.mr_menuid = tbl_tableorder.ter_menuid WHERE  $string and tbl_tableorder.ter_type='".$ordertyp."' Group By tbl_menumaster.mr_menuname  DESC"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				?>
                <tr>
                  <td style="text-align:left"><?=$i++?> </td>
                  <td style="text-align:left"><?=$result_stw['menuname']?></td>
                  <td style="text-align:left"><?=$result_stw['ct']?></td>
                </tr>
                <?php
			}
	  }
	  ?>
	
    </tbody>
    </table>
	<?php
 
 }
  else if($_REQUEST['type']=="cancel_history") { ?>
 <!-- <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6"><img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Cancel History Report</strong></th>
     
      </tr>
    </thead>
    </table>  -->
        <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="6"><strong>	Item Cancel Log </strong></th>
      </tr>
    </thead>
    </table>
    
   <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      
      <th style="font-size:15px; "><strong>Slno</strong></th>
     <th style="font-size:15px; "><strong>Date</strong></th>
      <th style="font-size:15px; "><strong>Order NO</strong></th>
    
        <th style="font-size:15px; "><strong>KOT No</strong></th>
      <th style="font-size:15px; "><strong>Menu</strong></th>
     <th style="font-size:15px; "><strong>Qty</strong></th>
      <th style="font-size:15px; "><strong>Kot Order Time</strong></th>
       <th style="font-size:15px; "><strong>Kot Cancel Date&Time</strong></th>
       <th style="font-size:15px; "><strong>Cancelled By</strong></th>
     <th style="font-size:15px; "><strong>Cancelled login</strong></th>
           <th style="font-size:15px; "><strong>Reason for cancellation</strong></th>

     
      </tr>
    </thead>
    <tbody>
                                          <?php
		$string="";
		if(isset($_REQUEST['ordertyp']))
		$ordertyp=$_REQUEST['ordertyp'];
	 if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string= " ch.ch_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string= " ch.ch_dayclosedate between '".$from."' and '".$to."' ";
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string= " ch.ch_dayclosedate between '".$from."' and '".$to."' ";
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
	}elseif($ordertypebydate=="Last10days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
	}
	elseif($ordertypebydate=="Last15days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last20days")
	{
		$string.=" ch.ch_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last25days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Last30days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
	}
	else if($ordertypebydate=="Today")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
	else if($ordertypebydate=="Yesterday")
			  {
				  $string.="ch.ch_dayclosedate  =  CURDATE() - INTERVAL 1 day";
			  }
	else if($ordertypebydate=="Last1month")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 1 
MONTH AND CURDATE( )";
	}
	
	else if($ordertypebydate=="Last90days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
	}

else if($ordertypebydate=="Last180days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
	}
else if($ordertypebydate=="Last365days")
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
	}

	}
	
	else
	{
		$string.=" ch.ch_dayclosedate  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
	}
		
	} 
	?>
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
	
 	  $sql_stw  =  $database->mysqlQuery("Select  ch.ch_dayclosedate,ch.ch_entrydate,ch_kotno,sm.ser_firstname,ch.ch_orderno,ch.ch_orderslno,ch.ch_cancelled_qty,ch_cancelledreason,ld.ls_username,m.mr_menuname,t.ter_entrytime From tbl_tableorder_changes as ch LEFT JOIN tbl_staffmaster as sm ON sm.ser_staffid=ch.ch_cancelledby_careof left join tbl_logindetails as ld on ld.ls_username=ch.ch_cancelledlogin left join tbl_tableorder as t ON t.ter_orderno = ch.ch_orderno and t.ter_slno = ch_orderslno left join tbl_menumaster as m on m.mr_menuid = t.ter_menuid where  $string"); 
	  $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){$i=1;
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
                       $fuldet1=$fuldet1 + $result_stw['mr_menuname'];
                        $ord=$ord + $result_stw['ch_orderno'];
                      $kot=$kot + $result_stw['ch_kotno'];
			$cancel=$cancel +$result_stw['ch_cancelled_qty'];
			$ser=$ser + $result_stw['ser_firstname'];
                        $user=$user +$result_stw['ls_username'];
			$chr=$chr + $result_stw['ch_cancelledreason'];
				?>
                <tr>
                  
                  
                  <td style="text-align:left"><?=$i?></td>
                   <td  style="text-align:left"><?=$database->convert_date($result_stw['ch_dayclosedate'])?></td>
                  
                    <td style="text-align:left"><?=$result_stw['ch_orderno']?></td>
                       <td style="text-align:left"><?=$result_stw['ch_kotno']?></td>
                    <td style="text-align:left"><?=$result_stw['mr_menuname']?></td>
                    <td style="text-align:left"><?=$result_stw['ch_cancelled_qty']?></td>
                    <td style="text-align:left"><?=$result_stw['ter_entrytime']?></td>
                    <td style="text-align:left"><?=$result_stw['ch_entrydate']?></td>
                    <td style="text-align:left"><?=$result_stw['ser_firstname']?></td>
                    <td style="text-align:left"><?=$result_stw['ls_username']?></td>
                    <td style="text-align:left"><?=$result_stw['ch_cancelledreason']?></td>
                  
                  
                </tr>
                <?php $i++;
			}
	  }
	  ?>
	
    </tbody>
    </table>
	<?php
 
 }
 else if($_REQUEST['type']=="complementary_report")
 {
	 $reporthead="";
	 $st="";
	 	  $string=" bm_status='Closed' AND  bm_complimentary='Y' AND ";
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	else
	{
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	
	else if($bydatz=="Yesterday")
			  {
				  $string.="bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
				   	$st="Yesterday";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
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
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	
	}
	 
 ?>  
  <!-- <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6">   <img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Complementary Report</strong></th>
     
      </tr>
    </thead>
    </table>  -->
    
    
     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      
      </tr>
            <tr>
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="5"><strong>Complementary Report </strong></th>
      </tr>
    </thead>
    </table>
                        		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
    <tr>
        <th colspan="5">Report - <?=$reporthead?></th>         
    <tr>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
        <th style="font-size:15px; "><strong>Bill Date</strong></th>
        <th style="font-size:15px; "><strong>Bill No</strong></th>
        <th style="font-size:15px; "><strong>Amount</strong></th>
        <th style="font-size:15px"><strong>Remarks</strong></th>
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
	
	?>
        <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="7">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      
      </tr>
            <tr>
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="7"><strong>Credit Details Report </strong></th>
      </tr>
    </thead>
    </table>
    
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
  $sql_login  =  $database->mysqlQuery("select crd_staffid,cd_amount,cd_billno,ly_firstname,crd_guestid,ct_corporatename,crd_corporateid,
  rm_roomno,crd_roomid,ser_firstname,cd_modeofentry from tbl_credit_master as c left join tbl_credit_details as cd on c.crd_id=cd.cd_masterid left join tbl_staffmaster as s on c.crd_staffid=s.ser_staffid left join tbl_roommaster as r on c.crd_roomid=r.rm_roomid left join tbl_corporatemaster as cm on c.crd_corporateid=cm.ct_corporatecode left join tbl_loyalty_reg  as l on c.crd_guestid=l.ly_id left join tbl_tablebillmaster bm on bm.bm_billno=cd.cd_billno  left join tbl_takeaway_billmaster tbm on tbm.tab_billno=cd.cd_billno  $string  order by cd.cd_dateofentry ASC"); 
$num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;$nettotal=0; $finaltotal=0;
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
                             
                              
                              
                             
                              
                              <?php  $i++;} } ?>
                              
                              
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
                           </tbody>
                            </table>
                            
                            <?php
}
 else if($_REQUEST['type'] =="daily_cost")
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
	
	?>
	<table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Daily Cost Report </strong></th>
      </tr>
    </thead>
    </table>
    
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
    
    
    
    
    
    
        <?php       
	if(isset($_REQUEST['set']))
	{
	?>
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
      <?php

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
				/*$rr++;*/
			}
			?>
             
				
            <?php
	  }
	}
			}
			//$netsale=0;
			//$netsale=$netsale+$net;
			
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
     <td ><strong><?=$cnttotl?></strong></td>
      <td><strong><?=number_format($foodcs,$_SESSION['be_decimal'])?></strong></td>
     <td><strong><?=number_format($wcs,$_SESSION['be_decimal'])?></strong></td>
       <td><strong><?=number_format($disctl,$_SESSION['be_decimal'])?></strong></td>
  </tr>
                         
                            
                            <?php

	
	}
	
	else if(isset($_REQUEST['setyr']))
	{
	?>
                                          <?php
							?>			
							
										
										
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
      <?php
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
			?>
             
				
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
                       
                            <?php
	}
	else if(isset($_REQUEST['yr']))
	{
	?>
                                          <?php
										
							?>			
						
										
										
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
			
				//$taxtot=$taxtot+$result_report['tax'];
				$cnttotl=$cnttotl+$result_report['cnt'];
				
			$disctl=$disctl+$result_report['disc'];
			$txper2=$result_report['tax']*5.6/100;
				$taxtot=$taxtot+ $txper2;
					$net=$result_report['tot']-$txper2;
	  ?>
      <?php
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
				/*$rr++;*/
	   }}
			?>
             
				
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
                         
                            
                            <?php
		
	}
	?>
	
	
	  </tbody>
                            </table>
	<?php
	
	 
    
    
      }
	  
else if($_REQUEST['type']=="loyality_customer")
	  {
		  
		  
		  
		  
	 $reporthead="";
	 $st="";
	 	  $string="";
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " DATE(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " DATE(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " DATE(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	else
	{
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	
	else if($bydatz=="Yesterday")
			  {
				  $string.="DATE(lr.ly_entrydatetime) =  CURDATE() - INTERVAL 1 day";
				   	$st="Yesterday";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  $st="Last 1 month";
			  }
else if($bydatz=="Last90days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.="DATE(lr.ly_entrydatetime) between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			$st="Last 1 year";
	}
	$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "DATE(lr.ly_entrydatetime) between '".$from."' and '".$to."' ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	
	}
	 
 ?>  
  <!-- <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6">   <img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Complementary Report</strong></th>
     
      </tr>
    </thead>
    </table>  -->
    
    
     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="5"><strong>Loyality Customer Report </strong></th>
      </tr>
    </thead>
    </table>
                        		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
    <tr>
        <th colspan="9">Report - <?=$reporthead?></th>         
    <tr>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
        <th style="font-size:15px; "><strong>Name</strong></th>
        <th style="font-size:15px; "><strong>Mobile</strong></th>
        <th style="font-size:15px; "><strong>Email</strong></th>
        <th style="font-size:15px"><strong>Birthday</strong></th>
       <th style="font-size:15px"><strong>Anniversary</strong></th>
        <th style="font-size:15px"><strong>Marital Status</strong></th>
         <th style="font-size:15px"><strong>profession</strong></th>
         <th style="font-size:15px"><strong>No of visit</strong></th> 
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
                               <td><?=$result_login['ly_firstname']?>.<?=$result_login['ly_lastname']?></td>
                                 <td><?=$result_login['ly_mobileno']?></td>
                                     <td><?=$result_login['ly_emailid']?></td>
                                     
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
 
  </tr>
  <tr class="main">
    <td ></td>
    <td ></td>
    <td ></td>
     <td ></td>
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
	  
else if($_REQUEST['type']=="kot_history")
	  {  
	 $reporthead="";
	 $st="";
	 	  $string="";	  
		  if($_REQUEST['from']!="" )
		{
			$from=$database->convert_date($_REQUEST['from']);
			
			$string.= " k.kr_date = '".$from."' and o.ter_dayclosedate = '".$from."'   ";
			$reporthead="On ".$database->convert_date($from);
		}
		
		
	else
	{

		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "k.kr_date = '".$from."'  and o.ter_dayclosedate = '".$from."' ";
				$reporthead="On ".$database->convert_date($from);
	}

 ?>  


     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="5"><strong>KOT History Report </strong></th>
      </tr>
    </thead>
    </table>
                        		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
    <tr>
        <th colspan="11">Report - <?=$reporthead?></th>         
    <tr>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
        <th style="font-size:15px; "><strong>Date</strong></th>
        <th style="font-size:15px; "><strong>Bill No</strong></th>
        <th style="font-size:15px; "><strong>KOT No</strong></th>
        <th style="font-size:15px"><strong>Print</strong></th>
         <th style="font-size:15px"><strong>Status</strong></th>
          <th style="font-size:15px"><strong>Item</strong></th>
           <th style="font-size:15px"><strong>Portion</strong></th>
               <th style="font-size:15px"><strong>Qty</strong></th>
                   <th style="font-size:15px"><strong>Unit Price</strong></th>
                       <th style="font-size:15px"><strong>Total</strong></th>
                       
      </tr>
    </thead>
    <tbody>
                                          <?php


	 $final=0;

 	  $sql_login  =  $database->mysqlQuery("SELECT k.kr_date,k.kr_kotno as KOT ,k.kr_print as printed,o.ter_status as kot_status,mm.mr_menuname as menu ,pm.pm_portionname AS Portion,o.ter_qty as Qty,o.ter_rate as Unit_Rate, ROUND((o.ter_qty*o.ter_rate),'".$_SESSION['be_decimal']."') as Total_Rate ,o.ter_billnumber FROM tbl_kotmaster K left join tbl_tableorder o on o.ter_kotno = k.kr_kotno LEFT JOIN tbl_menumaster mm ON o.ter_menuid=mm.mr_menuid LEFT JOIN tbl_portionmaster pm ON o.ter_portion=pm.pm_id where $string order by k.kr_time asc"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$final=$final + $result_login['Total_Rate'];
		
	 ?>
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
else if($_REQUEST['type'] =="feedback_report")
	  {
		 $string="";
	     $string=" t.ter_feedbackenter='Y' AND ";
	     $reporthead="";
	     $st="";
	 	 
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " t.ter_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= "t.ter_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " t.ter_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	else
	{
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" t.ter_dayclosedate between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.="t.t.ter_dayclosedate between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" t.t.ter_dayclosedate between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" t.t.ter_dayclosedate between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.="t.t.ter_dayclosedate between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.="t.ter_dayclosedate between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.="t.ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	
	else if($bydatz=="Yesterday")
			  {
				  $string.="t.ter_dayclosedate =  CURDATE() - INTERVAL 1 day";
				   	$st="Yesterday";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.="t.ter_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  $st="Last 1 month";
			  }
else if($bydatz=="Last90days")
	{
		$string.="t.ter_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.="t.ter_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.="t.ter_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			$st="Last 1 year";
	}
	$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= "t.ter_dayclosedate between '".$from."' and '".$to."' ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	
	}
	 
 ?>  
  <!-- <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6">   <img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Complementary Report</strong></th>
     
      </tr>
    </thead>
    </table>  -->
    
    
     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="5"><strong>Feedback Report</strong></th>
      </tr>
    </thead>
    </table>
                        		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
    <tr>
        <th colspan="9">Report - <?=$reporthead?></th>         
    <tr>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
        <th style="font-size:15px; "><strong>Date</strong></th>
        <th style="font-size:15px; "><strong>Menu</strong></th>
        <th style="font-size:15px; "><strong>Portion</strong></th>
        <th style="font-size:15px"><strong>Rating</strong></th>
       <th style="font-size:15px"><strong>Bill No</strong></th>
        <th style="font-size:15px"><strong>Remarks</strong></th>
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
                            <td width="5%"><?=$i?></td>                          
                                 <td width="8%"><?=$database->convert_date($result_login['ter_dayclosedate'])?></td>
                                     <td width="20%"><?=$result_login['mr_menuname']?></td>
                              <td width="8%"><?=$result_login['pm_portionname']?></td>
                              <td width="6%"><?=$result_login['ter_feedbackrating']?></td>
                           <td width="8%"><?=$result_login['ter_billnumber']?></td>
                             <td><?=$result_login['ter_feedbackremarks']?></td>                          
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
  </tr>
  <tr class="main">
    <td ></td>
    <td ></td>
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
		  
else if($_REQUEST['type']=="menu_rating")
		{
		 $string="";
	   if($_REQUEST['hidbydate']!="")
          {
	$bydatz=$_REQUEST['hidbydate'];
	$string.=" m.mr_menuname LIKE  '%" . $bydatz ."%' and m.mr_rating > '0' ";
          }
	   else
     	{
		$string="m.mr_rating > '0'";
	    }
	if($string !="")
	{
		$string="where $string";
	}
	 	 
	 
 ?>  

     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="5"><strong>Menu Rating</strong></th>
      </tr>
    </thead>
    </table>
                        		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
   
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
        <th style="font-size:15px; "><strong>Menu</strong></th>
        <th style="font-size:15px; "><strong>Category</strong></th>
        <th style="font-size:15px; "><strong>Subcategory</strong></th>
        <th style="font-size:15px"><strong>Rating</strong></th>
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
                                     <td width="20%"><?=$result_login['mr_menuname']?></td>
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
		
else if($_REQUEST['type']=="general_feedback")
		{
		 $string="";
	    
	     $reporthead="";
	     $st="";
	 	 
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " date(f.fbr_entrytime)  between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " date(f.fbr_entrytime)  between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " date(f.fbr_entrytime)  between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	else
	{
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" date(f.fbr_entrytime)  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.=" date(f.fbr_entrytime)  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" date(f.fbr_entrytime)  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" date(f.fbr_entrytime)  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" date(f.fbr_entrytime)  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" date(f.fbr_entrytime)  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" date(f.fbr_entrytime)  between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	
	else if($bydatz=="Yesterday")
			  {
				  $string.=" date(f.fbr_entrytime)  =  CURDATE() - INTERVAL 1 day";
				   	$st="Yesterday";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.=" date(f.fbr_entrytime)  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  $st="Last 1 month";
			  }
else if($bydatz=="Last90days")
	{
		$string.=" date(f.fbr_entrytime) between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" date(f.fbr_entrytime)  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
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
			$string.= " date(f.fbr_entrytime)  between '".$from."' and '".$to."' ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	
	}
	 
 ?>  
  <!-- <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6">   <img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Complementary Report</strong></th>
     
      </tr>
    </thead>
    </table>  -->
    
    
     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="5"><strong>General Feedback Rating Report</strong></th>
      </tr>
    </thead>
    </table>
                        		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
    <tr>
        <th colspan="9">Report - <?=$reporthead?></th>         
    </tr>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
        <th style="font-size:15px; "><strong>Questions</strong></th>
<!--        <th style="font-size:15px; "><strong>Avg Rating</strong></th>-->
        <th style="font-size:15px; "><strong>Entry Time</strong></th>
        <th style="font-size:15px"><strong>Customer</strong></th>
       <th style="font-size:15px"><strong>Rating</strong></th>
        <th style="font-size:15px"><strong>Bill No</strong></th>
         <th style="font-size:15px"><strong>Remarks</strong></th>
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
                            }
		
		
	 ?>
    						<tr >
                            <td ><?=$i?></td>
                                     <td ><?=$result_login['fbm_question']?></td>
<!--                              <td ><?//=$result_login['fbm_avgrating']?></td>-->
                              <td ><?=$result_login['fbr_entrytime']?></td>
                           <td ><?=$result_login['ser_firstname']?></td>
                             <td ><?=$result_login['fbr_rate']?></td>
                                  <td  ><?=$result_login['bm_billno']?></td>
                              <td><?=$remark?></td>
                              </tr> 
                              <?php $i++;} } ?>
          
                           </tbody>
                            </table>


<?php 
		  }
                  
                  
                  else if($_REQUEST['type']=="feedback_summary")
{
	?>
    
     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="5"><strong>General Feedback Summary</strong></th>
      </tr>
    </thead>
    </table>
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
                             
                              
                              
                              
                              
                              <?php $i++;} } ?>
                              
                              
 
                              
                             
                           </tbody>
                            </table>
                            
                            <?php
}
                  
                  
else if($_REQUEST['type']=="food_costing")
		{
			
		
		 $string="";
	   if($_REQUEST['from']!="")
          {
	$bydatz=$_REQUEST['from'];
	$string.=" rd.fc_menuid ='".$bydatz."' ";
          }
	   else
     	{
		
	    }
	if($string !="")
	{
		$string="where $string";
	}
	 	 
	 
 ?>  

     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      
      </tr>
            <tr >
            <?php
			
			$sql_login=  $database->mysqlQuery("select mr_menuname from tbl_menumaster where mr_menuid='".$_REQUEST['from']."' ");
			 $num_login   = $database->mysqlNumRows($sql_login);
	  $tot_cost=0; $wastage_cost=0;$menu='';
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$menu=$result_login['mr_menuname'];
			}
	  }
			
			?>
            
            
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="5"><strong>Food Costing -<?=$menu?></strong></th>
      </tr>
    </thead>
    </table>
   <table class="table table-bordered table-font user_shadow" >
    <thead>
   
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
        <th style="font-size:15px; "><strong>Product</strong></th>
        <th style="font-size:15px; "><strong>Unit</strong></th>
        <th style="font-size:15px; "><strong>Unit Cost</strong></th>
        <th style="font-size:15px"><strong>Qty</strong></th>
           <th style="font-size:15px"><strong>Total Cost</strong></th>
              <th style="font-size:15px"><strong>Wastage %</strong></th>
                 <th style="font-size:15px"><strong>Wastage Cost</strong></th>
      </tr>
    </thead>
    <tbody>
     <?php
 	  $sql_login  =  $database->mysqlQuery("select fc_totalcost,fc_wastage_cost,mr_menuname,fc_slno,prm_productname,
	  um_name,fc_ing_unitcost,fc_qty,fc_wastage_percentage from fc_recipe_details as rd left join tbl_menumaster as m  on rd.fc_menuid=m.mr_menuid left join inv_tbl_productmaster as pm on rd.fc_ingredientid=pm.prm_productid  left join inv_tbl_unitmaster as u on rd.fc_ing_unit=u.um_id  $string order by rd.fc_menuid"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  $tot_cost=0; $wastage_cost=0;
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
		$tot_cost=$tot_cost+$result_login['fc_totalcost'];
				$wastage_cost=$wastage_cost+$result_login['fc_wastage_cost'];
				$menu=$result_login['mr_menuname'];
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
    <td ><strong>Total</strong></td>
    <td ></td>
    <td ></td>
     <td ></td>
   <td ></td>
    <td><strong><?=number_format($tot_cost,$_SESSION['be_decimal'])?></strong></td>
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
	 	 
	  if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']!="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tor_date between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['hidfr']!="" && $_REQUEST['hidto']=="")
		{
			$from=$database->convert_date($_REQUEST['hidfr']);
			$to=date("Y-m-d");
			$string.= " tor_date  between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['hidfr']=="" && $_REQUEST['hidto']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['hidto']);
			$string.= " tor_date  between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
	else
	{
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" tor_date  between CURDATE( ) - INTERVAL 5 
DAY AND CURDATE( )";
$st="Last 5 days";

	}elseif($bydatz=="Last10days")
	{
		$string.=" tor_date  between CURDATE( ) - INTERVAL 10 
DAY AND CURDATE( )";
$st="Last 10 days";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" tor_date  between CURDATE( ) - INTERVAL 15 
DAY AND CURDATE( )";
$st="Last 15 days";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" tor_date  between CURDATE( ) - INTERVAL 20 
DAY AND CURDATE( )";
$st="Last 20 days";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" tor_date  between CURDATE( ) - INTERVAL 25 
DAY AND CURDATE( )";
$st="Last 25 days";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" tor_date  between CURDATE( ) - INTERVAL 30 
DAY AND CURDATE( )";
$st="Last 30 days";
	}
	else if($bydatz=="Today")
	{
		$string.=" tor_date between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
		$st="Today";
	}
	
	else if($bydatz=="Yesterday")
			  {
				  $string.=" tor_date  =  CURDATE() - INTERVAL 1 day";
				   	$st="Yesterday";
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.=" tor_date  between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  $st="Last 1 month";
			  }
else if($bydatz=="Last90days")
	{
		$string.=" tor_date between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st="Last 3 months";
	}
else if($bydatz=="Last180days")
	{
		$string.=" tor_date  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st="Last 6 months";
	}
else if($bydatz=="Last365days")
	{
		$string.=" tor_date between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
			$st="Last 1 year";
	}
	$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " tor_date between '".$from."' and '".$to."' ";
				$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
	}
		
	
	
	
	
	
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
	
		
		
		
	
	}
	 
 ?>  
  <!-- <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr bgcolor="#000000">
      <th style="font-size:20px; " colspan="6">   <img width="80px" src="img/huamuglogo-x-500x400.png" /><strong>Complementary Report</strong></th>
     
      </tr>
    </thead>
    </table>  -->
    
    
     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
      
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; "  colspan="5"><strong>Table TurnOver Report</strong></th>
      </tr>
    </thead>
    </table>
                        		 
   <table class="table table-bordered table-font user_shadow" >
    <thead>
    <tr>
        <th colspan="6">Report - <?=$reporthead?></th>         
    <tr>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Sl No</strong></th>
        <th style="font-size:15px; "><strong>Date</strong></th>
        <th style="font-size:15px; "><strong>Table</strong></th>
        <th style="font-size:15px; "><strong>Bill No</strong></th>
        <th style="font-size:15px"><strong>Total Customer</strong></th>
       <th style="font-size:15px"><strong>Bill Amount</strong></th>
    
      </tr>
    </thead>
    <tbody>
                                          <?php
$final=0;$tot_cust=0;
 	  $sql_login  =  $database->mysqlQuery("select tor_billamount,tor_totalcustomer,tor_slno,tor_date,tr_tableno,tor_billno from tbl_tableturnover  left join tbl_tablemaster  on tbl_tableturnover.tor_tableid=tbl_tablemaster.tr_tableid  where $string order by tbl_tableturnover.tor_date ASC"); 
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
    <td >&nbsp;</td>
   
  
 
  </tr>
  <tr class="main">
    <td><strong>Total</strong></td>
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
        $from="";
        $to="";
        
            if((isset($_REQUEST['fromdt']))||(isset($_REQUEST['todt']))){
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
            }
        
	else if(isset($_REQUEST['bydate']) && $_REQUEST['bydate']!="null")
	{
            $bydatz=$_REQUEST['bydate'];
           
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
	else
	{
            $cur=date("Y-m-d");
            $string.=" bm_dayclosedate='".$cur."'";
            $reporthead="On ".$database->convert_date($cur);		
	}
	?>
    <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="3">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="3"><strong>Table Turnover Summary</strong></th>
      </tr>

      
    </thead>
    </table>
    
	<table class="table table-bordered table-font user_shadow" >
	<thead>
            <tr>
                <th colspan="6">Table Turnover Summary  - <?=$reporthead?></th>   
            </tr>
            <tr>
                <th class="sortable">Slno</th>
               <th class="sortable">Table</th>
                
                <th class="sortable">Bill Amount</th>
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
                        } 
//                        print_r($billamount2);
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
    <tr class="main">
        <td ><strong>TOTAL</strong></td>
        <td >&nbsp;</td>
        <td ><strong><?=number_format(array_sum($billamount2),$_SESSION['be_decimal'])?></strong></td>
    </tr>
     
    </tbody>
    </table>
<?php
 }
else if($_REQUEST['type']=="summary_ham")
		{
		 
 
 $servicetax_stats='N';
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
 ?>  

     <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Summary Report</strong></th>
      </tr>

      
    </thead>
    </table>
   <table class="table table-bordered table-font user_shadow" >
  
                                          <?php
	  //$cur=date("Y-m-d");
	  	$strin="";
	 $string='';
    $reporthead="";
		$strngs=" ter_status='Closed' AND ";
	$strings=" bm_status='Closed' AND ";
		$string_pax=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
	$string2_str=" sum(bm_transactionamount) ";
	$string3_str=" sum(bm_finaltotal) ";
	$string4_str=" sum(bm_finaltotal) ";
	$string5_str=" sum(bm_finaltotal) ";
	$string6_str=" sum(bm_finaltotal)";
		$string7_str=" sum(bm_finaltotal)";
	$string1 =$strings. " pym_code='cash'  AND  ";//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
		$string2 = " pym_code='credit'  AND ";//"credit"  bm_transactionamount <>''
		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
			$string6=$strings. " pym_code='credit_person' AND ";
	$string7=$strings. " pym_code='complimentary' AND";
	// $string=" bm_status='Closed' AND ";
	
	  if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
				$string_pax.= "(bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			$from=$database->convert_date($_REQUEST['from']);
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
			$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
           $string_pax.= "( bm_dayclosedate  between '".$from."' and '".$to."' ) "; 
		
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['to']);
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ; 
				$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
					$string_pax.= "  (bm_dayclosedate  between '".$from."' and '".$to."' ) ";
		}
	else
	{
	/*	$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		/*$cur=date("Y-m-d");
		$string=" bm_dayclosedate='".$cur."'";*/
		
		
	//$bydate=$_REQUEST['hidbydate'];
	
		$bydatz=$_REQUEST['hidbydate'];
		
		
		
			if($bydatz!="null")
	{
		//$search="";
	
	if($bydatz=="Last5days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 5 DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
			$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
		$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
			$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	 $strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
	 	$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 15  DAY AND CURDATE( )";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
		$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
			$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 20  DAY AND CURDATE( )";
		
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
		$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
			$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 25  DAY AND CURDATE( )";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
		$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
		$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 30  DAY AND CURDATE( )";
	}
	else if($bydatz=="Today")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today "; 
		$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";
		$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 0  DAY AND CURDATE( )";	
	}
	
	else if($bydatz=="Yesterday")
			  {
				  $string.=" bm_dayclosedate =  CURDATE() - INTERVAL 1 day";
				  $st= " Yesterday ";
				  $strin.=" ter_dayclosedate = CURDATE( ) - INTERVAL 1  DAY AND CURDATE( )";
				$string_pax.= " bm_dayclosedate = CURDATE( ) - INTERVAL 1  DAY AND CURDATE( )";	
			  }
			   else if($bydatz=="Last1month")
			  {
				  $string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
				  $st= " Last 1 month ";
				  	$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( )";	
				  
				  	$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 1  MONTH AND CURDATE( )";
			  }
else if($bydatz=="Last90days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
		$st= " Last 3 months ";
			$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 3  MONTH AND CURDATE( )";
			 	$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";	
		
	}
else if($bydatz=="Last180days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )"; 
		$st= " Last 6 months ";
				$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 6  MONTH AND CURDATE( )";
				 	$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";	
	}
else if($bydatz=="Last365days")
	{
		$string.=" bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )"; 
		$st= " Last 1 Year ";
		$strin.=" ter_dayclosedate between CURDATE( ) - INTERVAL 1  YEAR AND CURDATE( )";
		$string_pax.= " bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";	
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm_dayclosedate between '".$from."' and '".$to."' ";
			$strin.=" ter_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to) ;
				$string_pax.= " bm_dayclosedate between'".$from."' and '".$to."' ";
	}
		
	
	}
	?>
     
    <thead>
    <tr>
        <th style="font-size:20px; " colspan="2"><strong>Report - <?=$reporthead ?></strong></th>
      </tr>
        <tr bgcolor="#000000">
        <th style="font-size:15px; "><strong>Type</strong></th>
        <th style="font-size:15px; "><strong>Value</strong></th>
       
      </tr>
    </thead>
    <tbody>
      <?php
	 
  $subtotal=0;
  
 	  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id  where $string1"."$string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
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
          <?php } }  }
		  
		  
		  $sql_login  =  $database->mysqlQuery("select bm_name as bank_name, (sum(bm_transactionamount)) as tot from tbl_tablebillmaster tb left join tbl_paymentmode on tb.bm_paymode=tbl_paymentmode.pym_id  , tbl_bankmaster b  where  b.bm_id = tb.bm_transcbank and tb.bm_status='Closed' AND $string2 "."$string group by b.bm_name order by tb.bm_dayclosedate,tb.bm_billtime ASC "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				if($result_login['tot'] != "")
			{
				$subtotal =$subtotal + $result_login['tot'];
				
	 ?>
        <tr >
        <td><?="Credit / Debit card -".$result_login['bank_name']?></td>
         <td><?=number_format($result_login['tot'],$_SESSION['be_decimal'])?></td>
       
          </tr> 
          <?php } } }
		  
		  $sql_login  =  $database->mysqlQuery("select $string3_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string3"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
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
        <td>Coupons</td>
         <td><?=number_format($cmp,$_SESSION['be_decimal'])?></td>
       
          </tr> 
          <?php  } }
		  
		  $sql_login  =  $database->mysqlQuery("select $string4_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string4"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$cmp='';
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
        <td>Voucher</td>
         <td><?=number_format($cmp,$_SESSION['be_decimal'])?></td>
       
          </tr> 
          <?php  } }
		  
		  $sql_login  =  $database->mysqlQuery("select $string5_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string5"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){$i=1;
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{$cmp='';
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
        <td>Cheque</td>
         <td><?=number_format($cmp,$_SESSION['be_decimal'])?></td>
       
          </tr> 
          <?php  } }
		  
		  $sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string6"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ $cmp='';
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
          <td>Credits</td>
          <td><?=number_format($cmp,$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php  }}
				
			$sql_login  =  $database->mysqlQuery("select $string7_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string7"." $string order by bm_dayclosedate,bm_billtime ASC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ $cmp='';
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
	  	$sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), '".$_SESSION['be_decimal']."')))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) = 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) = 'COLD BEVERAGES')) ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['Total'] != "")
			{
					$bev_tot=$bev_tot+$result_login['Total'];
			//$subtotal =$subtotal + $result_login['Total'];
			?>
          <tr >
          <td>Beverages</td>
          <td><?=number_format($result_login['Total'],$_SESSION['be_decimal'])?></td>
         
            </tr> 
            <?php } }}
			
			$food_tot=0;
			  	$sql_login  =  $database->mysqlQuery("SELECT (((sum(o.ter_qty))*(ROUND(avg(o.ter_rate), '".$_SESSION['be_decimal']."')))) as Total from tbl_tableorder o left join tbl_menumaster m on m.mr_menuid = o.ter_menuid left join tbl_menumaincategory mc on mc.mmy_maincategoryid = m.mr_maincatid left join tbl_menusubcategory ms on ms.msy_subcategoryid = m.mr_subcatid left join tbl_portionmaster p on p.pm_id = o.ter_portion left join tbl_floormaster f on f.fr_floorid = o.ter_floorid where $strngs"." $strin  and ((TRIM(mc.mmy_maincategoryname) != 'HOT BEVERAGES') OR (TRIM(mc.mmy_maincategoryname) != 'COLD BEVERAGES')) ORDER BY m.mr_maincatid,m.mr_subcatid DESC"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
			if($result_login['Total'] != "")
			{
					$food_tot=$food_tot+$result_login['Total'];
			//$subtotal =$subtotal + $result_login['Total'];
			?>
          <tr >
          <td>Food</td>
          <td><?=$result_login['Total']?></td>
         
            </tr> 
            <?php } }}
		
			$tot_per=$food_tot+$bev_tot;
			$food_per=$food_tot/$tot_per*100;
			$bev_per=$bev_tot/$tot_per*100;
			

			?>
			  <tr >
          <td>Food Cost(%)</td>
          <td><?=$food_per?></td>
            </tr> 
            
            
              <tr >
          <td>Beverages Cost(%)</td>
          <td><?=bev_per?></td>
         
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
	  
	$disc=0;
		   $sql_stw  =  $database->mysqlQuery("SELECT sum(bm_discountvalue) as bills FROM `tbl_tablebillmaster` WHERE $string_pax"); 
	 $num_stw   = $database->mysqlNumRows($sql_stw);
	  if($num_stw){
		  while($result_stw  = $database->mysqlFetchArray($sql_stw)) 
			{
				$disc=$disc + $result_stw['bills'];
			}?>
            <tr>
                <td>Total Discount</td>
                <td><?=number_format($disc,$_SESSION['be_decimal'])?></td>
                </tr><?php
	  }		
			
			
			
			
			
	  
			
			
			
		  ?>
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
else if(($_REQUEST['type']=="total_summary_details"))
{
 ?>
         <table class="table table-bordered table-font user_shadow" >
    <thead>
      <tr >
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
      <strong><u><?=$branchname?></u></strong></th>
       
        
      </tr>
            <tr >
      <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Total Summary Details </strong></th>
      </tr>

      
    </thead>
    </table>


<?php
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
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
   								 
								  <thead>
                                  <tr>
                                 	<th colspan="11">Total Summary Details Report - <?=$reporthead?></th>
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
//`tbl_tablebillmaster`(`bm_billno`, `bm_billdate`, `bm_billtime`, `bm_branchid`, `bm_subtotal`, `bm_paymode`, `bm_cancelamount`, `bm_discountid`, `bm_corporatecode`, `bm_discountvalue`, `bm_servicetax`, `bm_vat`, `bm_servicecharge`, `bm_credit`, `bm_creditroom`, `bm_creditstaff`, `bm_complimentary`, `bm_complimentaryremark`, `bm_finaltotal`, `bm_amountpaid`, `bm_amountbalace`, `bm_transactionid`, `bm_voucherid`, `bm_couponcompany`, `bm_couponamt`, `bm_chequeno`, `bm_chequebankname`)	
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
        }
  $sql_login  =  $database->mysqlQuery("select $string1_str as tot from tbl_tablebillmaster left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id where $string1"."$dt order by bm_dayclosedate,bm_billtime ASC"); 
 
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
			
			
				
			$sql_login  =  $database->mysqlQuery("select $string6_str as tot from tbl_tablebillmaster l
			eft join tbl_credit_details tcd on tcd.cd_billno=tbl_tablebillmaster.bm_billno 
			left join tbl_paymentmode on tbl_tablebillmaster.bm_paymode=tbl_paymentmode.pym_id 
			where $strings $string6"." $dt order by bm_dayclosedate,bm_billtime ASC"); 
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
          }
                        }
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
          }
			
			
			
			 ?>
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
else if(($_REQUEST['type']=="sales_summary"))
{
?>
        <table class="table table-bordered table-font user_shadow" >
       <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
        <strong><u><?=$branchname?></u></strong></th>
       </tr>
       <tr>
       <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Sales Summary </strong></th>
       </tr>

      
    </thead>
    </table>





<?php 
        
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
	 $sql_login  =  $database->mysqlQuery("SELECT fr_floorid FROM `tbl_floormaster` WHERE `fr_status`='Active' AND `fr_servicetax`<>''"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 $servicetax_stats='Y';
	  }
	
	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
   								 
				<thead>
                                  <tr>
                                 	<th colspan="2">Sales Report - <?=$reporthead?></th>
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
	  }
			
			
			
			 ?>
                              
                              
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

else if(($_REQUEST['type']=="stewards_performance_report"))
{
?>
              <table class="table table-bordered table-font user_shadow">
       <thead>
      <tr>
      <th style="font-size:20px;color:#000;background-color:#FFF;border-bottom:1px #ccc solid " colspan="6">
       <img width="80px" src="img/report-logo/reportlogo.png" />
        <strong><u><?=$branchname?></u></strong></th>
       </tr>
       <tr>
       <th style="font-size:18px;color:#000;background-color:#FFF; " colspan="6"><strong>Steward Performance</strong></th>
       </tr>

      
    </thead>
    </table>

<?php
        $stw = $_REQUEST['stwrd'];
	$string="";
	$reporthead="";
	$strings=" bm_status='Closed' AND ";
	$string1_str=" (sum(bm_amountpaid) - sum(bm_amountbalace)) ";
//	$string2_str=" sum(bm_transactionamount) ";
//	$string3_str=" sum(bm_finaltotal) ";
//	$string4_str=" sum(bm_finaltotal) ";
//	$string5_str=" sum(bm_finaltotal) ";
//	$string6_str=" sum(bm_finaltotal)";
//		$string7_str=" sum(bm_finaltotal)";
//	$string_pax="";
	$string_pax=" bm_status='Closed' AND ";
        $string1 = "";
//	//	$string1 =$strings. " pym_code='cash'  AND ";//bm_paymode='cash' AND//"cash"//(bm_transactionamount ='' or bm_transactionamount IS NULL) and (bm_couponcompany ='' or bm_couponcompany IS NULL) and bm_voucherid IS NULL and bm_couponamt ='0.00' and  (bm_chequeno ='' or bm_chequeno IS NULL) and (bm_chequebankname='' or bm_chequebankname IS NULL)
//			$string1 =$strings. " ((pym_code='cash') or (pym_code='credit') or (pym_code='coupon') or (pym_code='voucher') or (pym_code='cheque') or (pym_code='credit_person') or (pym_code='complimentary')   ) AND ";
//		
//		
//		
//		$string2 =" pym_code='credit'  AND";//bm_paymode='credit' AND//"credit"  bm_transactionamount <>''
//		$string3 =$strings. " pym_code='coupon'  AND";//"coupons"  bm_couponcompany <>''  and bm_couponamt <>'0.00'
//		$string4 =$strings. " pym_code='voucher' AND";//"voucher" bm_voucherid <>''
//		$string5 =$strings. " pym_code='cheque' AND";//"cheque" bm_chequeno <>'' and bm_chequebankname<>''
//	$string6=$strings. " pym_code='credit_person' AND ";
//	$string7=$strings. " pym_code='complimentary' AND";

		//echo $_REQUEST['fromdt'] ."--";
		//echo $_REQUEST['todt'] ."<br>";
		if($_REQUEST['fromdt']!="" && $_REQUEST['todt']!="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "(ter_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']!="" && $_REQUEST['todt']=="")
		{
			$from=$database->convert_date($_REQUEST['fromdt']);
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "( ter_dayclosedate  between '".$from."' and '".$to."' ) ";
                        $reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);
		}
		else if($_REQUEST['fromdt']=="" && $_REQUEST['todt']!="")
		{
			$from=date("Y-m-d");
			$to=$database->convert_date($_REQUEST['todt']);
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$string_pax.= "  (ter_dayclosedate  between '".$from."' and '".$to."' ) ";
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
          
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
		$st= " Last 5 days ";
		$string_pax.= " ter_dayclosedate between CURDATE( ) - INTERVAL 5  DAY AND CURDATE( )";
	}elseif($bydatz=="Last10days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 10  DAY AND CURDATE( )";
			$string_pax.= "ter_dayclosedate  between CURDATE( ) - INTERVAL 10 DAY AND CURDATE( )";
		$st= " Last 10 days ";
	}
	elseif($bydatz=="Last15days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
			$string_pax.= "ter_dayclosedate  between CURDATE( ) - INTERVAL 15 DAY AND CURDATE( )";
		$st= " Last 15 days ";
	}
	else if($bydatz=="Last20days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
			$string_pax.= "ter_dayclosedate  between CURDATE( ) - INTERVAL 20 DAY AND CURDATE( )";
		$st= " Last 20 days ";
	}
	else if($bydatz=="Last25days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
				$string_pax.= "ter_dayclosedate between CURDATE( ) - INTERVAL 25 DAY AND CURDATE( )";
		$st= " Last 25 days ";
	}
	else if($bydatz=="Last30days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
			$string_pax.= "ter_dayclosedate between CURDATE( ) - INTERVAL 30 DAY AND CURDATE( )";
		$st= " Last 30 days ";
	}
	else if($bydatz=="Today")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )"; 
			$string_pax.= "ter_dayclosedate between CURDATE( ) - INTERVAL 0 DAY AND CURDATE( )";
		$st= " Today ";
	}
	else if($bydatz=="Yesterday")
	{
		$string.=" bm.bm_dayclosedate = CURDATE() - INTERVAL 1 day";
		$string_pax.= "ter_dayclosedate =  CURDATE() - INTERVAL 1 day";
		$st= " Yesterday ";
	}
	else if($bydatz=="Last1month")
	{
		$string.="  bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( )";
		$string_pax.= "ter_dayclosedate between  CURDATE( ) - INTERVAL 1 MONTH AND CURDATE( ) ";
		$st= " Last 1 month ";
	}
	else if($bydatz=="Last90days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )"; 
			$string_pax.= "ter_dayclosedate  between CURDATE( ) - INTERVAL 3 MONTH AND CURDATE( )";
		$st= " Last 3 months ";
	}
	else if($bydatz=="Last180days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
			$string_pax.= " ter_dayclosedate  between CURDATE( ) - INTERVAL 6 MONTH AND CURDATE( )";
		$st= " Last 6 months "; 
	}
	else if($bydatz=="Last365days")
	{
		$string.=" bm.bm_dayclosedate between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
			$string_pax.= "ter_dayclosedate  between CURDATE( ) - INTERVAL 1 YEAR AND CURDATE( )";
		$st= " Last 1 year "; 
		
		
		
	}
$reporthead=$st;
	}
	else
	{
		
		
		$from=date("Y-m-d");
			$to=date("Y-m-d");
			$string.= " bm.bm_dayclosedate between '".$from."' and '".$to."' ";
			$reporthead="From ".$database->convert_date($from)."- To ".$database->convert_date($to);	
				$string_pax.= "  ter_dayclosedate   between '".$from."' and '".$to."'";
	}
	
	}

	?>
    
    
	<table class="table table-bordered table-font user_shadow" >
   								 
								  <thead>
                                  <tr>
                                 	<th colspan="4">Steward Performance Report- <?=$reporthead?></th>
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
   $slno=1;
   $total_item = 0;
   $total_amount = 0;

  $sql_login1  =  $database->mysqlQuery("select count(bm.bm_billno)as count,bm.bm_dayclosedate,sm.ser_staffid as stewardid ,UPPER(concat_ws('',sm.ser_firstname,' ',sm.ser_lastname)) as steward, sum(bm.bm_subtotal_final) as final 
FROM tbl_tablebillmaster bm
left join tbl_staffmaster sm ON sm.ser_staffid = bm.bm_steward
where sm.ser_staffid='$stw' and $strings $string 
group by bm.bm_steward, bm.bm_dayclosedate  order by bm.bm_finaltotal asc ");
              
  
                $num_login1   = $database->mysqlNumRows($sql_login1);
                if($num_login1){
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
  </tr>
                              
                             
                           </tbody>
                            </table>
                            
                            <?php
}


?>
		
	</div>
	</div>
        <!-- Bottom TABLE -->
    </div>
  </div></div>
				
<!--[if !IE]>end section content bottom<![endif]-->
</body>
</html>

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
