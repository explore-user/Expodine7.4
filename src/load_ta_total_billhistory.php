<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 
error_reporting(0);

if($_REQUEST['value']=="searchtahistory_cs")
{
	//billno="+billno+"&name="+name+"&nos="+nos+"&statuss="+statuss,

	$string='';
	
	
	if(($_REQUEST['billno']!="null"))
	{
		$string.=" AND  tb.tab_billno LIKE '%".$_REQUEST['billno']."%'";
	}
	if(($_REQUEST['name']!="null"))
	{
		$string.=" AND  ts.tac_customername LIKE '%".$_REQUEST['name']."%'";
	}
	if(($_REQUEST['nos']!="null"))
	{
		$string.=" AND  ts.tac_contactno LIKE '%".$_REQUEST['nos']."%'";
	}
	if(($_REQUEST['statuss']!="null"))
	{
		$string.=" AND  tb.tab_status LIKE '%".$_REQUEST['statuss']."%'";
	}
	?>
    <script src="js/takeaway_hist.js"></script>
   <table class="new_fnt" width="100%"  border="0"> <!----bill_history_active--->
	<?php
 $sql_bilhis= "Select tb.tab_billno, ts.tac_customername,ts.tac_contactno,tb.tab_status, tb.tab_mode From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' and tb.tab_mode='CS' $string order by tb.tab_date,tb.tab_time DESC ";
   // $sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE 	tab_dayclosedate='".$_SESSION['date']."' $string  and tab_mode='CS' ORDER BY 	tab_date,tab_time DESC";
    $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
    $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
    if($num_bilhistory)
    {$i=1;
        while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
            {
                ?><!--bill_history_number-->
      <tr class="bill_history_number <?php if($result_bilhistory['tab_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?>" billno="<?=$result_bilhistory['tab_billno']?>">
        <td width="8%"><strong><?=$i++?></strong></td>
        <td width="27%"><a href="ta_bill_history.php?bilno=<?=$result_bilhistory['tab_billno']?>"><?=$database->highlightkeyword($result_bilhistory['tab_billno'],$_REQUEST['billno'])?></a></td>
         <td width="31%"><?=$database->highlightkeyword($result_bilhistory['tac_customername'],$_REQUEST['name'])?></td>
         <td width="20%"><?=$database->highlightkeyword($result_bilhistory['tac_contactno'],$_REQUEST['nos'])?></td>
         <td width="14%"   ><span  class=""><?=$database->highlightkeyword($result_bilhistory['tab_status'],$_REQUEST['statuss'])?></span></td>
       </tr>
       <?php } }else { ?>
       <td colspan="4" style="font-weight:bold">No records to display</td>
       <?php } ?>
       
     </table> 
    <?php
	

}else if($_REQUEST['value']=="searchtahistory_ta")
{
	//billno="+billno+"&name="+name+"&nos="+nos+"&statuss="+statuss,

	$string='';
	
	
	if(($_REQUEST['billno']!="null"))
	{
		$string.=" AND  tb.tab_billno LIKE '%".$_REQUEST['billno']."%'";
	}
	if(($_REQUEST['name']!="null"))
	{
		$string.=" AND  ts.tac_customername LIKE '%".$_REQUEST['name']."%'";
	}
	if(($_REQUEST['nos']!="null"))
	{
		$string.=" AND  ts.tac_contactno LIKE '%".$_REQUEST['nos']."%'";
	}
	if(($_REQUEST['statuss']!="null"))
	{
		$string.=" AND  tb.tab_status LIKE '%".$_REQUEST['statuss']."%'";
	}
	?>
    <script src="js/takeaway_hist.js"></script>
   <table class="new_fnt" width="100%"  border="0"> <!----bill_history_active--->
	<?php
 $sql_bilhis= "Select tb.tab_billno, ts.tac_customername,ts.tac_contactno,tb.tab_status, tb.tab_mode From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' and tb.tab_mode='TA' $string order by tb.tab_date,tb.tab_time DESC ";

    //$sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE 	tab_dayclosedate='".$_SESSION['date']."' $string  and tab_mode='TA' ORDER BY 	tab_date,tab_time DESC";
    $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
    $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
    if($num_bilhistory)
    {$i=1;
        while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
            {
                ?><!--bill_history_number-->
      <tr class="bill_history_number <?php if($result_bilhistory['tab_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?>" billno="<?=$result_bilhistory['tab_billno']?>">
        <td width="8%"><strong><?=$i++?></strong></td>
        <td width="27%"><a href="ta_bill_history.php?bilno=<?=$result_bilhistory['tab_billno']?>"><?=$database->highlightkeyword($result_bilhistory['tab_billno'],$_REQUEST['billno'])?></a></td>
         <td width="31%"><?=$database->highlightkeyword($result_bilhistory['tac_customername'],$_REQUEST['name'])?></td>
         <td width="20%"><?=$database->highlightkeyword($result_bilhistory['tac_contactno'],$_REQUEST['nos'])?></td>
         <td width="14%"   ><span  class=""><?=$database->highlightkeyword($result_bilhistory['tab_status'],$_REQUEST['statuss'])?></span></td>
       </tr>
       <?php } }else { ?>
       <td colspan="4" style="font-weight:bold">No records to display</td>
       <?php } ?>
       
     </table> 
    <?php
	

}else if($_REQUEST['value']=="searchtahistory_ho")
{
	//billno="+billno+"&name="+name+"&nos="+nos+"&statuss="+statuss,

	$string='';
	
	
	if(($_REQUEST['billno']!="null"))
	{
		$string.=" AND  tb.tab_billno LIKE '%".$_REQUEST['billno']."%'";
	}
	if(($_REQUEST['name']!="null"))
	{
		$string.=" AND  ts.tac_customername LIKE '%".$_REQUEST['name']."%'";
	}
	if(($_REQUEST['nos']!="null"))
	{
		$string.=" AND  ts.tac_contactno LIKE '%".$_REQUEST['nos']."%'";
	}
	if(($_REQUEST['statuss']!="null"))
	{
		$string.=" AND  tb.tab_status LIKE '%".$_REQUEST['statuss']."%'";
	}
	?>
    <script src="js/takeaway_hist.js"></script>
   <table class="new_fnt" width="100%"  border="0"> <!----bill_history_active--->
	<?php
 $sql_bilhis= "Select tb.tab_billno, ts.tac_customername,ts.tac_contactno,tb.tab_status, tb.tab_mode From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' and tb.tab_mode='HD' $string order by tb.tab_date,tb.tab_time DESC ";

   // $sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE 	tab_dayclosedate='".$_SESSION['date']."' $string  and tab_mode='HD' ORDER BY 	tab_date,tab_time DESC";
    $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
    $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
    if($num_bilhistory)
    {$i=1;
        while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
            {
                ?><!--bill_history_number-->
      <tr class="bill_history_number <?php if($result_bilhistory['tab_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?>" billno="<?=$result_bilhistory['tab_billno']?>">
        <td width="8%"><strong><?=$i++?></strong></td>
        <td width="27%"><a href="ta_bill_history.php?bilno=<?=$result_bilhistory['tab_billno']?>"><?=$database->highlightkeyword($result_bilhistory['tab_billno'],$_REQUEST['billno'])?></a></td>
         <td width="31%"><?=$database->highlightkeyword($result_bilhistory['tac_customername'],$_REQUEST['name'])?></td>
         <td width="20%"><?=$database->highlightkeyword($result_bilhistory['tac_contactno'],$_REQUEST['nos'])?></td>
         <td width="14%"   ><span  class=""><?=$database->highlightkeyword($result_bilhistory['tab_status'],$_REQUEST['statuss'])?></span></td>
       </tr>
       <?php } }else { ?>
       <td colspan="4" style="font-weight:bold">No records to display</td>
       <?php } ?>
       
     </table> 
    <?php
	

}else if($_REQUEST['value']=="loadtahistory_date_ta")
{
	
	//billno="+billno+"&name="+name+"&nos="+nos+"&statuss="+statuss,

	//$string_typ='';
	$string.=" AND  tb.tab_dayclosedate='".$_REQUEST['datefield']."'";
	/*if($_REQUEST['type']=="TA")
	{
		$string_typ='TA';
	}else if($_REQUEST['type']=="HO")
	{
		$string_typ='HO';
	}else if($_REQUEST['type']=="CS")
	{
		$string_typ='';
	}*/
	?>
    <script src="js/takeaway_hist.js"></script>
   <table class="new_fnt" width="100%"  border="0"> <!----bill_history_active--->
	<?php
  $sql_bilhis= "Select tb.tab_billno, ts.tac_customername,ts.tac_contactno,tb.tab_status, tb.tab_mode From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_REQUEST['datefield']."'  $string  and tb.tab_mode='".$_REQUEST['type']."' AND tb.tab_billno not like 'Temp%' AND tb.tab_billno not like 'HOLD%' order by tb.tab_date,tb.tab_time DESC ";

    //$sql_bilhis="select tab_billno,	tab_customername,tab_status,tab_customermobile,tab_status  from tbl_takeaway_billmaster WHERE $string	  and tab_mode='".$_REQUEST['type']."' ORDER BY 	tab_date,tab_time DESC";
    $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
    $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
    if($num_bilhistory)
    {$i=1;
        while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
            {
                ?><!--bill_history_number-->
      <tr class="bill_history_number <?php if($result_bilhistory['tab_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?>" billno="<?=$result_bilhistory['tab_billno']?>">
        <td width="8%"><strong><?=$i++?></strong></td>
        <td width="27%"><a href="ta_bill_history.php?bilno=<?=$result_bilhistory['tab_billno']?>"><?=$database->highlightkeyword($result_bilhistory['tab_billno'],$_REQUEST['billno'])?></a></td>
         <td width="31%"><?=$database->highlightkeyword($result_bilhistory['tac_customername'],$_REQUEST['name'])?></td>
         <td width="20%"><?=$database->highlightkeyword($result_bilhistory['tac_contactno'],$_REQUEST['nos'])?></td>
         <td width="14%"   ><span  class=""><?=$database->highlightkeyword($result_bilhistory['tab_status'],$_REQUEST['statuss'])?></span></td>
       </tr>
       <?php } }else { ?>
       <td colspan="4" style="font-weight:bold">No records to display</td>
       <?php } ?>
       
     </table> 
    <?php
	


	
}
