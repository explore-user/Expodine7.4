<?php session_start();
//include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance



if($_REQUEST['value']=="load_ta_custhis_det"){
 /* ******************************************** list customer details ******************************************************* */
 $sql_bilhis='';
 $name='';
 $mob='';
 $address='';
 $landmark='';
 $area='';
 $per_add='';
 if($_REQUEST['mode']=='1')
 {
 $sql_bilhis="select * from tbl_takeaway_billmaster where (tab_customername<>'' OR tab_customermobile<>'') AND tab_customername='".$_REQUEST['name']."' AND tab_customermobile='".$_REQUEST['mob']."' order by tab_customername";
 }else if($_REQUEST['mode']=='2')
 {
	  $sql_bilhis="select *  from tbl_takeaway_customer where (tac_customername<>'' OR tac_contactno<>'')  AND tac_customername='".$_REQUEST['name']."' AND tac_contactno='".$_REQUEST['mob']."' order by tac_customername";
 }
 
  $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
  $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
  if($num_bilhistory)
  {
	  while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
		  {
			  if($_REQUEST['mode']=='1')
 				{
					$name=$result_bilhistory['tab_customername'];
					$mob=$result_bilhistory['tab_customermobile'];
				}else
				{////`tbl_takeaway_customer`(`tac_customerid`, `tac_customername`, `tac_contactno`, `tac_address`, `tac_landmark`, `tac_area`, `tac_branchid`, `tac_per_address`
					$name=$result_bilhistory['tac_customername'];
					$mob=$result_bilhistory['tac_contactno'];
					$address=$result_bilhistory['tac_address'];
					$landmark=$result_bilhistory['tac_landmark'];
					$area=$result_bilhistory['tac_area'];
					$per_add=$result_bilhistory['tac_per_address'];
				}
			  
		  }
  }
 ?>
 <table>
  <tr>
      <td><strong>Name :</strong></td>
      <td><?=$name?></td>
  </tr>
  <tr>
      <td><strong>Mobile :</strong></td>
      <td><?=$mob?></td>
  </tr>
  <?php if($_REQUEST['mode']=='2'){ ?>
   <tr>
      <td><strong>Address :</strong></td>
      <td><?=$address?></td>
  </tr>
   <tr>
      <td><strong>Land Mark :</strong></td>
      <td><?=$landmark?></td>
  </tr>
   <tr>
      <td><strong>Area :</strong></td>
      <td><?=$area?></td>
  </tr>
   <tr>
      <td><strong>Permanent Address :</strong></td>
      <td><?=$per_add?></td>
  </tr>
  
  <?php } ?>
</table>
 <?php
								
 
}else if($_REQUEST['value']=="load_ta_bill_det"){
 /* ******************************************** list bill details ******************************************************* */
 $sql_bilhis='';
 $tot=0;

 if($_REQUEST['mode']=='1')
 {
 $sql_bilhis="select * from tbl_takeaway_billmaster where (tab_customername<>'' OR tab_customermobile<>'') AND tab_customername='".$_REQUEST['name']."' AND tab_customermobile='".$_REQUEST['mob']."' order by tab_customername";
 }else if($_REQUEST['mode']=='2')
 {
	  $sql_bilhis="select *  from tbl_takeaway_customer as c LEFT JOIN tbl_takeaway_billmaster as b ON b.tab_hdcustomerid=c.tac_customerid where (c.tac_customername<>'' OR c.tac_contactno<>'')  AND c.tac_customername='".$_REQUEST['name']."' AND c.tac_contactno='".$_REQUEST['mob']."'  order by c.tac_customername";
 }?>
  <div class="bill_detail_table_data ">
 <table class="table_detail_new_table" width="100%" border="0">
 <?php
  $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
  $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
  if($num_bilhistory)
  {
	  while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
		  {
			  if(!is_null($result_bilhistory['tab_date'])){
			 $tot= $tot + $result_bilhistory['tab_netamt'];
				?>
                <tr class="eachbilno_click"  bilno='<?=$result_bilhistory['tab_billno'] ?>' ><!--class="bill_history_active"-->
                    <td width="50%"><?=($result_bilhistory['tab_billno']) ?></td>
                    <td width="25%"><?=$database->convert_date($result_bilhistory['tab_date']) ?></td>
                    <td width="25%"><?=($result_bilhistory['tab_netamt']) ?>/-</td>
                </tr>
                <?php
			  }
			  
		  }
  }
 ?>
 
      
     
  </table>
  </div>
  <div class="table_detail_new_total">
        <div class="table_detail_new_total_txt">Total Rate : <strong><?=$tot?>/-</strong></div>
  </div>
  <script src="js/takeaway_custht_eachbill.js"></script> 
 <?php
								
 
}else if($_REQUEST['value']=="load_ta_billeach"){
 /* ******************************************** list bill each ******************************************************* */
 $sql_bilhis='';
 $tot=0;
  $bills_org=$_REQUEST['bilno'];
 $bills=explode(",",$bills_org);
//print_r($bills);
 
 ?>
  <div class="bill_history_details_table ">
  <table width="100%">
 <?php
 foreach( $bills as $number => $value)
 {
 $sql_bilhis="SELECT * from tbl_takeaway_billdetails as bd LEFT JOIN tbl_menumaster as mn 	ON bd.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON bd.tab_portion=pm.pm_id WHERE bd.tab_billno='".$value."' order by bd.tab_slno ";
  $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
  $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
  if($num_bilhistory)
  {$i=1;?>
  <tr class="bill_detail_head">
      <td colspan="5" width="100%"><?=$value?></td>
 </tr> 
  <?php
	  while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
		  {
			$tot=$tot + ($result_bilhistory['tab_qty'] * $result_bilhistory['tab_rate']);
				?>
                
                <tr>
                      <td width="11.5%"><?=$i++?></td>
                      <td width="39.8%"><?=$result_bilhistory['mr_menuname'] ?></td>
                      <td width="15.6%"><?=$result_bilhistory['pm_portionname'] ?></td>
                      <td width="7.5%"><?=$result_bilhistory['tab_qty'] ?></td>
                      <td width="12%"><?=$result_bilhistory['tab_rate'] ?>/-</td>
                </tr>
                <?php
			  
		  }
  }
 }
 ?>
 
      
     
  </table>
  </div>
  <div class="table_detail_new_total">
      <div class="table_detail_new_total_txt">Total Rate : <strong><?=$tot?>/-</strong></div>
 </div><!--table_detail_new_total-->
 <?php
								
 
}