<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance


?>
<?php

 if($_REQUEST['set']=='loadtables')
 { 
 //**************************************************************Load details completed ************************************************* 
 		$curdt=date("Y-m-d");
		 if((isset($_REQUEST['floorid'])))
			{
				$_SESSION['floorid']=$_REQUEST['floorid'];
				$_SESSION['florids']=$_REQUEST['floorid'];
			}
		if((isset($_SESSION['ajaxtablesel'])))
		{
			$count=count($_SESSION['ajaxtablesel']);
			 $table=$_SESSION['ajaxtablesel'];
			 $pref=$_SESSION['ajaxprefsel'];
		}else
		{
			$table="";
			$pref="";
		
		}
		if(isset($_SESSION['floorid']))
		{
			$sql_table_sel  =  $database->mysqlQuery("select * from tbl_tablemaster where tr_floorid='".$_SESSION['floorid']."' and tr_status='Active'  order by tr_tableno"); 
		  $num_table  = $database->mysqlNumRows($sql_table_sel);
		  if($num_table){
				while($result_table_sel  = $database->mysqlFetchArray($sql_table_sel)) 
					{ 
				
					$sql_table_sel1  =  $database->mysqlQuery("select distinct(td.ts_tableid),td.ts_tableidprefix,td.ts_dineintime,ter_orderno from tbl_tabledetails as td LEFT JOIN tbl_tableorder as to1 ON td.ts_orderno=to1.ter_orderno where td.ts_tableid='". $result_table_sel['tr_tableid']."' and (to1.ter_status='Served' OR to1.ter_status='KOT_Cancel') and to1.ter_dayclosedate='".$_SESSION['date']."' "); 
		  $num_table1  = $database->mysqlNumRows($sql_table_sel1);
		  if($num_table1){$k=0;$l=0;$val=0;$g=0;
				while($result_table_sel1  = $database->mysqlFetchArray($sql_table_sel1)) 
					{
							$sql_table_sel12  =  $database->mysqlQuery("select * from tbl_tabledetails as td LEFT JOIN tbl_tableorder as to1 ON td.ts_orderno=to1.ter_orderno where td.ts_tableid='". $result_table_sel['tr_tableid']."' and td.ts_tableidprefix='".$result_table_sel1['ts_tableidprefix']."' and to1.ter_dayclosedate='".$_SESSION['date']."' "); 
		$num_table12  = $database->mysqlNumRows($sql_table_sel12);
		$sql_table_sel13  =  $database->mysqlQuery("select * from tbl_tabledetails as td LEFT JOIN tbl_tableorder as to1 ON td.ts_orderno=to1.ter_orderno where td.ts_tableid='". $result_table_sel['tr_tableid']."' and td.ts_tableidprefix='".$result_table_sel1['ts_tableidprefix']."' and (to1.ter_status='Served' OR to1.ter_status='KOT_Cancel') and to1.ter_dayclosedate='".$_SESSION['date']."' "); 
		 $num_table13  = $database->mysqlNumRows($sql_table_sel13);
		if($num_table12==$num_table13)
		{
						$k=0;$l=0;$val=0;
						if(isset($_SESSION['ajaxtablesel']))
						{
						if(in_array($result_table_sel1['ts_tableid'],$table))
						{
							$g=array_search($result_table_sel1['ts_tableid'], $table);
								$k=0;$l=0;$val=0;
								if($table[$g]==$result_table_sel1['ts_tableid'])
								{
									$k=1;
								}
								if($pref[$g]==$result_table_sel1['ts_tableidprefix'])
								{
									$l=1;
								}
								if($k==1 && $l==1)
								{
									$val=1;
									unset($table[$g]);
								unset($pref[$g]);
								}else
								{
									$val=0;
								}
						}else
						{
							$val=0;
						}
						}else
						{
							$val=0;
						}
					?>
                    <p>
                        <a class="a_demo_three <?php if($val==1) { ?>a_demo_active <?php } ?>" href="#" name="nam_<?= $result_table_sel1['ts_tableid'] ?>" pref="pref_<?= $result_table_sel1['ts_tableidprefix'] ?>" ordno="or_<?= $result_table_sel1['ter_orderno'] ?>" total_name="<?=$result_table_sel['tr_tableno']."(".$result_table_sel1['ts_tableidprefix'].")"?>">
                          <span class="a_kot_odrnum"> Table <span><?= $result_table_sel['tr_tableno']." (".$result_table_sel1['ts_tableidprefix'].")" ?></span> </span>
                           <span class="area_table">Dine in- <?= date("h:i:s",strtotime($result_table_sel1['ts_dineintime'])) ?></span>
                        </a>
                    </p>
                    <?php }}} ?>
                  <?php }} ?>
                  <?php } ?>
  <script src="js/load_billgen.js"></script>
                  <?php
 }else  if($_REQUEST['set']=='loadtables_pend')
 {  
  //**************************************************************Load details Pending ******************************************************* 

 		$curdt=date("Y-m-d");
 
	   if((isset($_REQUEST['floorid'])))
		  {
			  $_SESSION['floorid']=$_REQUEST['floorid'];
			  $_SESSION['florids']=$_REQUEST['floorid'];
		  }
	  if((isset($_SESSION['ajaxtablesel'])))
	  {
		  $count=count($_SESSION['ajaxtablesel']);
		   $table=$_SESSION['ajaxtablesel'];
		   $pref=$_SESSION['ajaxprefsel'];
	  }else
	  {
		  $table="";
		  $pref="";
	  
	  }
	 if(isset($_SESSION['floorid']))
		{
			$sql_table_sel  =  $database->mysqlQuery("select * from tbl_tablemaster where tr_floorid='".$_SESSION['floorid']."' and tr_status='Active'  order by tr_tableno"); 
		  $num_table  = $database->mysqlNumRows($sql_table_sel);
		  if($num_table){
				while($result_table_sel  = $database->mysqlFetchArray($sql_table_sel)) 
					{ 
				//echo "select distinct(td.ts_tableid),td.ts_tableidprefix,td.ts_dineintime,ter_orderno,ter_billnumber from tbl_tabledetails as td LEFT JOIN tbl_tableorder as to1 ON td.ts_orderno=to1.ter_orderno where td.ts_tableid='". $result_table_sel['tr_tableid']."' and to1.ter_status='Billed' and to1.ter_entrydate='".$curdt."' ";
					$sql_table_sel1  =  $database->mysqlQuery("select distinct(td.ts_tableid),td.ts_tableidprefix,td.ts_dineintime,ter_orderno,ter_billnumber,ts_totalamount from tbl_tabledetails as td LEFT JOIN tbl_tableorder as to1 ON td.ts_orderno=to1.ter_orderno where td.ts_tableid='". $result_table_sel['tr_tableid']."' and to1.ter_status='Billed' and to1.ter_dayclosedate='".$_SESSION['date']."' "); 
		  $num_table1  = $database->mysqlNumRows($sql_table_sel1);
		  if($num_table1){$k=0;$l=0;$val=0;$g=0;
				while($result_table_sel1  = $database->mysqlFetchArray($sql_table_sel1)) 
					{
							$sql_table_sel12  =  $database->mysqlQuery("select * from tbl_tabledetails as td LEFT JOIN tbl_tableorder as to1 ON td.ts_orderno=to1.ter_orderno where td.ts_tableid='". $result_table_sel['tr_tableid']."' and td.ts_tableidprefix='".$result_table_sel1['ts_tableidprefix']."' and to1.ter_dayclosedate='".$_SESSION['date']."' "); 
		$num_table12  = $database->mysqlNumRows($sql_table_sel12);
		
		$sql_table_sel13  =  $database->mysqlQuery("select * from tbl_tabledetails as td LEFT JOIN tbl_tableorder as to1 ON td.ts_orderno=to1.ter_orderno where td.ts_tableid='". $result_table_sel['tr_tableid']."' and td.ts_tableidprefix='".$result_table_sel1['ts_tableidprefix']."' and to1.ter_status='Billed' and to1.ter_dayclosedate='".$_SESSION['date']."' "); 
		 $num_table13  = $database->mysqlNumRows($sql_table_sel13);
		if($num_table12==$num_table13)
		{
			$tim='';$amount='';
			$sql_table_sel1s  =  $database->mysqlQuery("select * from tbl_tablebillmaster   where bm_billno='".$result_table_sel1['ter_billnumber']."' and bm_lastprintime IS NOT NULL"); 
		  $num_table1s  = $database->mysqlNumRows($sql_table_sel1s);
		  if($num_table1s){
				while($result_table_sel1s  = $database->mysqlFetchArray($sql_table_sel1s)) 
					{
						$tims=explode(" ",$result_table_sel1s['bm_lastprintime']);
						$tim=$tims[1];
						//$amount=$result_table_sel1s['bm_finaltotal'];
					}
		  }
		   $sql_table_sel1s  =  $database->mysqlQuery("select * from tbl_tablebillmaster  where bm_billno='".$result_table_sel1['ter_billnumber']."'  "); 
		  $num_table1s  = $database->mysqlNumRows($sql_table_sel1s);
		  if($num_table1s){
				while($result_table_sel1s  = $database->mysqlFetchArray($sql_table_sel1s)) 
					{
						
						$amount=$result_table_sel1s['bm_finaltotal'];
					}
		  }
		  
						$k=0;$l=0;$val=0;
						//$amount=$result_table_sel1['ts_totalamount'];
						if(isset($_SESSION['ajaxtablesel']))
						{
						if(in_array($result_table_sel1['ts_tableid'],$table))
						{
							$g=array_search($result_table_sel1['ts_tableid'], $table);
								$k=0;$l=0;$val=0;
								if($table[$g]==$result_table_sel1['ts_tableid'])
								{
								
									$k=1;
								}
								if($pref[$g]==$result_table_sel1['ts_tableidprefix'])
								{
									$l=1;
								}
								if($k==1 && $l==1)
								{
									$val=1;
									unset($table[$g]);
								unset($pref[$g]);
								}else
								{
									$val=0;
								}
						}else
						{
							$val=0;
						}
						}else
						{
							$val=0;
						}
						
						
					?>
                    <p>
                        <a class="a_demo_three <?php if($val==1) { ?>a_demo_active <?php } ?>" href="#" name="nam_<?= $result_table_sel1['ts_tableid'] ?>" pref="pref_<?= $result_table_sel1['ts_tableidprefix'] ?>" ordno="or_<?= $result_table_sel1['ter_orderno'] ?>" bilno="bl_<?= $result_table_sel1['ter_billnumber'] ?>">
                          <span class="a_kot_odrnum">Table <span><?= $result_table_sel['tr_tableno']." (".$result_table_sel1['ts_tableidprefix'].")" ?></span> </span>
                           <span class="area_table bill_gen_table" style="color:#000">
                           <span><?php if($tim){echo date("h:i A",strtotime($tim));}else {echo "Not Printed";}?></span>
                           <strong><?= $result_table_sel1['ter_billnumber'] ?></strong>
                           <span><?=$amount?>/-</span>
                           </span>
                           <span class="<?php if($val==1) { ?>notify_bill_1 <?php } else { ?>notify_bill<?php } ?>"></span>
                        </a>
                    </p>
                    <?php }}} ?>
                  <?php }} ?>
                   <?php } ?>
                  <script src="js/load_billgen.js"></script>
  
                  <?php
 }else  if($_REQUEST['set']=='loadtables_pendSearch')
 {  
   //****************************************************Load details Pending Search ********************************************* 

		 $curdt=date("Y-m-d");
 
	   if((isset($_REQUEST['floorid'])))
		  {
			  $_SESSION['floorid']=$_REQUEST['floorid'];
			  $_SESSION['florids']=$_REQUEST['floorid'];
		  }
	  if((isset($_SESSION['ajaxtablesel'])))
	  {
		  $count=count($_SESSION['ajaxtablesel']);
		   $table=$_SESSION['ajaxtablesel'];
		   $pref=$_SESSION['ajaxprefsel'];
	  }else
	  {
		  $table="";
		  $pref="";
	  
	  }//tbl_tabledetails tbl_tablemaster tbl_tableorder
			$sql_table_sel  =  $database->mysqlQuery("select * from tbl_tablemaster where tr_floorid='".$_SESSION['floorid']."' and tr_status='Active'  order by tr_tableno"); 
		  $num_table  = $database->mysqlNumRows($sql_table_sel);
		  if($num_table){
				while($result_table_sel  = $database->mysqlFetchArray($sql_table_sel)) 
					{ 
				
					$sql_table_sel1  =  $database->mysqlQuery("select distinct(td.ts_tableid),td.ts_tableidprefix,td.ts_dineintime,ter_orderno,ter_billnumber from tbl_tabledetails as td LEFT JOIN tbl_tableorder as to1 ON td.ts_orderno=to1.ter_orderno where td.ts_tableid='". $result_table_sel['tr_tableid']."' and to1.ter_status='Billed' and to1.ter_dayclosedate='".$_SESSION['date']."' "); 
		  $num_table1  = $database->mysqlNumRows($sql_table_sel1);
		  if($num_table1){
				while($result_table_sel1  = $database->mysqlFetchArray($sql_table_sel1)) 
					{
							$sql_table_sel12  =  $database->mysqlQuery("select * from tbl_tabledetails as td LEFT JOIN tbl_tableorder as to1 ON td.ts_orderno=to1.ter_orderno where td.ts_tableid='". $result_table_sel['tr_tableid']."' and td.ts_tableidprefix='".$result_table_sel1['ts_tableidprefix']."' and to1.ter_dayclosedate='".$_SESSION['date']."'"); 
		$num_table12  = $database->mysqlNumRows($sql_table_sel12);
		
		$sql_table_sel13  =  $database->mysqlQuery("select * from tbl_tabledetails as td LEFT JOIN tbl_tableorder as to1 ON td.ts_orderno=to1.ter_orderno where td.ts_tableid='". $result_table_sel['tr_tableid']."' and td.ts_tableidprefix='".$result_table_sel1['ts_tableidprefix']."' and to1.ter_status='Billed' and to1.ter_dayclosedate='".$_SESSION['date']."' and to1.ter_billnumber LIKE '%".$_REQUEST['sr']."%'"); 
		 $num_table13  = $database->mysqlNumRows($sql_table_sel13);
		if($num_table12==$num_table13)
		{
			$tim='';
			$sql_table_sel1s  =  $database->mysqlQuery("select * from tbl_tablebillmaster  where bm_billno='".$result_table_sel1['ter_billnumber']."'  and bm_lastprintime IS NOT NULL"); 
		  $num_table1s  = $database->mysqlNumRows($sql_table_sel1s);
		  if($num_table1s){
				while($result_table_sel1s  = $database->mysqlFetchArray($sql_table_sel1s)) 
					{
						$tims=explode(" ",$result_table_sel1s['bm_lastprintime']);
						$tim=$tims[1];
						
					}
		  }
		  $sql_table_sel1s  =  $database->mysqlQuery("select * from tbl_tablebillmaster  where bm_billno='".$result_table_sel1['ter_billnumber']."'  "); 
		  $num_table1s  = $database->mysqlNumRows($sql_table_sel1s);
		  if($num_table1s){
				while($result_table_sel1s  = $database->mysqlFetchArray($sql_table_sel1s)) 
					{
						
						$amount=$result_table_sel1s['bm_finaltotal'];
					}
		  }
		  $k=0;$l=0;$val=0;//$amount=0;
			//$amount=$result_table_sel1['ts_totalamount'];
			if(isset($_SESSION['ajaxtablesel']))
			{
			if(in_array($result_table_sel1['ts_tableid'],$table))
			{
				$g=array_search($result_table_sel1['ts_tableid'], $table);
					$k=0;$l=0;$val=0;
					if($table[$g]==$result_table_sel1['ts_tableid'])
					{
						$k=1;
					}
					if($pref[$g]==$result_table_sel1['ts_tableidprefix'])
					{
						$l=1;
					}
					if($k==1 && $l==1)
					{
						$val=1;
						unset($table[$g]);
					unset($pref[$g]);
					}else
					{
						$val=0;
					}
			}else
			{
				$val=0;
			}
			}else
			{
				$val=0;
			}
					?>
                    <p>
                        <a class="a_demo_three <?php if($val==1) { ?>a_demo_active <?php } ?>" href="#" name="nam_<?= $result_table_sel1['ts_tableid'] ?>" pref="pref_<?= $result_table_sel1['ts_tableidprefix'] ?>" ordno="or_<?= $result_table_sel1['ter_orderno'] ?>" bilno="bl_<?= $result_table_sel1['ter_billnumber'] ?>" total_name="<?=$result_table_sel['tr_tableno']."(".$result_table_sel1['ts_tableidprefix'].")"?>">
                          <span class="a_kot_odrnum">Table <span><?= $result_table_sel['tr_tableno']." (".$result_table_sel1['ts_tableidprefix'].")" ?></span> </span>
                           <span class="area_table bill_gen_table" style="color:#000">
                           		<span><?php if($tim){echo date("h:i A",strtotime($tim));}else {echo "Not Printed";}?></span>
                           		<strong><?= $result_table_sel1['ter_billnumber'] ?></strong>
                                <span><?=$amount?>/-</span>
                           </span>
                           <span class="<?php if($val==1) { ?>notify_bill_1 <?php } else { ?>notify_bill<?php } ?>"></span>
                        </a>
                    </p>
                    <?php }}} ?>
                  <?php }} ?>
  <script src="js/load_billgen.js"></script>
                  <?php
 }
 else if($_REQUEST['set']=="tableselectionauto")
 {
	unset($_SESSION['ajaxtablesel']);
	unset($_SESSION['ajaxprefsel']);
	$_SESSION['ajaxtablesel']=$_REQUEST['tableid'];
	$_SESSION['ajaxprefsel']=$_REQUEST['prefx'];
	 
 }
  else if($_REQUEST['set']=="tableselectionauto_clear")
 {
	 unset($_SESSION['ajaxtablesel']);
	 unset($_SESSION['ajaxprefsel']);
 }
 else if($_REQUEST['set']=="tableselectiontonextpage")
 {
	 $_SESSION['nextpagetable']=$_REQUEST['tableid'];
	 $_SESSION['nextpagepref']=$_REQUEST['prefx'];
 }else if($_REQUEST['set']=="nextpagescreen3")
 {
	 /*$_SESSION['thirdtableid']=$_REQUEST['table'];
	 $_SESSION['thirdprefxid']=$_REQUEST['prefx'];*/
 }
 else if($_REQUEST['set']=="proceedbilling")
 {
	$ord   =  $_REQUEST['finalorder'];
	$brch  =  $_SESSION['branchofid'];
	$tabno =  $_REQUEST['tabno'];
	$pref  =  $_REQUEST['pref'];
	$totname  =  $_REQUEST['totname'];
	$tablecount=count($totname);
	$tb='';
   for($i=0;$i<$tablecount;$i++)
	  {
		 if($i==0)
		 {
			$tb= $totname[$i];
		 }else
		 {
			 $tb=$tb.",". $totname[$i];
		 }
	  }
	$k=0; 
	foreach( $ord as $number => $value){ 
	if($k==0)
	{
		$order=$value;
	}else
	{
		$order=$order .",". $value;
	}
	$k++;
	}
	 $returnmsg=''; //echo $tb;
	  try {
		 $discount_of_or="";
		  $discount_unit_or="";
		  $discount_or="N";
		  $discountid_or=""; 
		 $loyalityid=0;   
		$database->mysqlQuery("SET @orderno = " . "'" . $order . "'");
		$database->mysqlQuery("SET @branchid = " . "'" . $brch . "'");
		$database->mysqlQuery("SET @cancelamt = " . "'0'");//$_REQUEST['cancelamt']
		$database->mysqlQuery("SET @discount_of = " . "'" . $discount_of_or . "'");
		$database->mysqlQuery("SET @discount_unit = " . "'" . $discount_unit_or . "'");
		$database->mysqlQuery("SET @discount = " . "'" . $discount_or . "'");
		$database->mysqlQuery("SET @discountid = " . "'" . $discountid_or . "'");//,@discount_of,@discount_unit,@discount
		$database->mysqlQuery("SET @tableno = " . "'" . $tb . "'");
		 $database->mysqlQuery("SET @loyalty_id = " . "'" . $loyalityid . "'");
		$billnumber='';
		$Message='';
		$sq=$database->mysqlQuery("CALL proc_billgenerate(@orderno,@branchid,@billnumber,@cancelamt,@discount_of,@discount_unit,@discount,@discountid,@tableno,@loyalty_id,@Message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
		$rs = $database->mysqlQuery( 'SELECT @billnumber AS billnumber,@Message as Message' );
		while($row = mysqli_fetch_array($rs))
		{
		$s= $row['billnumber'];
		$returnmsg=$row['Message'];
		}
		$_SESSION['billno']=$s;
		//$returnmsg='';echo "";
		echo $returnmsg;
	  } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }
	 
	?>
  
                                
                                <?php
	
 }else if($_REQUEST['set']=="creditinsert")
 {
	 if($_REQUEST['type']=="room")
	 {
		  if(isset($_REQUEST['discountid']))
		 {
			 if(isset($_REQUEST['discount_corp']))
			 {
				  $sqls= $database->mysqlQuery("UPDATE  tbl_corporatemaster set ct_status='N' where ct_corporatecode='".$_REQUEST['discount_corp']."'");
					$sql= $database->mysqlQuery("UPDATE  tbl_tablebillmaster set bm_subtotal='".$_REQUEST['final']."',bm_cancelamount='".$_REQUEST['cancel']."' ,bm_discountid='".$_REQUEST['discountid']."',bm_corporatecode='".$_REQUEST['discount_corp']."' ,bm_discountvalue='".$_REQUEST['discount']."' ,bm_servicetax='".$_REQUEST['servicetx']."' ,bm_vat='".$_REQUEST['vat']."' ,bm_servicecharge='".$_REQUEST['servicechrg']."' ,bm_credit='Y',bm_creditroom='".$_REQUEST['typeva']."',bm_complimentary='N', bm_complimentaryremark='',bm_finaltotal='".$_REQUEST['grandtotal']."'  , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'");
			 }else
			 {
				 $sql= $database->mysqlQuery("UPDATE  tbl_tablebillmaster set bm_subtotal='".$_REQUEST['final']."',bm_cancelamount='".$_REQUEST['cancel']."' ,bm_discountid='".$_REQUEST['discountid']."',bm_discountvalue='".$_REQUEST['discount']."' ,bm_servicetax='".$_REQUEST['servicetx']."' ,bm_vat='".$_REQUEST['vat']."' ,bm_servicecharge='".$_REQUEST['servicechrg']."' ,bm_credit='Y',bm_creditroom='".$_REQUEST['typeva']."',bm_complimentary='N', bm_complimentaryremark='',bm_finaltotal='".$_REQUEST['grandtotal']."'   , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'");
			 }
		 }else
		 {
			 $sql= $database->mysqlQuery("UPDATE  tbl_tablebillmaster set bm_subtotal='".$_REQUEST['final']."',bm_cancelamount='".$_REQUEST['cancel']."'  ,bm_servicetax='".$_REQUEST['servicetx']."' ,bm_vat='".$_REQUEST['vat']."' ,bm_servicecharge='".$_REQUEST['servicechrg']."' ,bm_credit='Y',bm_creditroom='".$_REQUEST['typeva']."',bm_complimentary='N', bm_complimentaryremark='',bm_finaltotal='".$_REQUEST['grandtotal']."'   , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'");
			 
		 }
		 
		 $sql1=  $database->mysqlQuery("update tbl_tableorder set ter_status='Closed' WHERE ter_billnumber='".$_SESSION['billno']."'");
		 $_SESSION['bill_close']="no";
	 }else  if($_REQUEST['type']=="staff")
	 {
		  if(isset($_REQUEST['discountid']))
		 {
			 if(isset($_REQUEST['discount_corp']))
			 {
				  $sqls= $database->mysqlQuery("UPDATE  tbl_corporatemaster set ct_status='N' where ct_corporatecode='".$_REQUEST['discount_corp']."'");
		 			$sql=$database->mysqlQuery("UPDATE  tbl_tablebillmaster set bm_subtotal='".$_REQUEST['final']."',bm_cancelamount='".$_REQUEST['cancel']."' ,bm_discountid='".$_REQUEST['discountid']."',bm_corporatecode='".$_REQUEST['discount_corp']."'  ,bm_discountvalue='".$_REQUEST['discount']."' ,bm_servicetax='".$_REQUEST['servicetx']."' ,bm_vat='".$_REQUEST['vat']."' ,bm_servicecharge='".$_REQUEST['servicechrg']."' ,bm_credit='Y',bm_creditstaff='".$_REQUEST['typeva']."' ,bm_complimentary='N', bm_complimentaryremark='',bm_finaltotal='".$_REQUEST['grandtotal']."'   , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'");
			 }else
			 {
				  $sql=$database->mysqlQuery("UPDATE  tbl_tablebillmaster set bm_subtotal='".$_REQUEST['final']."',bm_cancelamount='".$_REQUEST['cancel']."' ,bm_discountid='".$_REQUEST['discountid']."' ,bm_discountvalue='".$_REQUEST['discount']."' ,bm_servicetax='".$_REQUEST['servicetx']."' ,bm_vat='".$_REQUEST['vat']."' ,bm_servicecharge='".$_REQUEST['servicechrg']."' ,bm_credit='Y',bm_creditstaff='".$_REQUEST['typeva']."' ,bm_complimentary='N', bm_complimentaryremark='',bm_finaltotal='".$_REQUEST['grandtotal']."'   , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'");
			 }
		 }else
		 {
			  $sql=$database->mysqlQuery("UPDATE  tbl_tablebillmaster set bm_subtotal='".$_REQUEST['final']."',bm_cancelamount='".$_REQUEST['cancel']."' ,bm_servicetax='".$_REQUEST['servicetx']."' ,bm_vat='".$_REQUEST['vat']."' ,bm_servicecharge='".$_REQUEST['servicechrg']."' ,bm_credit='Y',bm_creditstaff='".$_REQUEST['typeva']."' ,bm_complimentary='N', bm_complimentaryremark='',bm_finaltotal='".$_REQUEST['grandtotal']."'   , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'");
		 }
		 $sql1=  $database->mysqlQuery("update tbl_tableorder set ter_status='Closed' WHERE ter_billnumber='".$_SESSION['billno']."'");
		 $_SESSION['bill_close']="no";
	 }else  if($_REQUEST['type']=="none")
	 {
		 if(isset($_REQUEST['discountid']))
		 {
			 if(isset($_REQUEST['discount_corp']))
			 {
				//`tbl_corporatediscount`(`ct_corporatecode`, `ct_corporatename`, `ct_corporatediscount`, `ct_branchid`, `ct_status`)
				 $sqls= $database->mysqlQuery("UPDATE  tbl_corporatemaster set ct_status='N' where ct_corporatecode='".$_REQUEST['discount_corp']."'");
				 
			$sql= $database->mysqlQuery("UPDATE  tbl_tablebillmaster set bm_subtotal='".$_REQUEST['final']."',bm_cancelamount='".$_REQUEST['cancel']."' ,bm_discountid='".$_REQUEST['discountid']."',bm_corporatecode='".$_REQUEST['discount_corp']."' ,bm_discountvalue='".$_REQUEST['discount']."' ,bm_servicetax='".$_REQUEST['servicetx']."' ,bm_vat='".$_REQUEST['vat']."' ,bm_servicecharge='".$_REQUEST['servicechrg']."' ,bm_credit='N',bm_creditstaff=NULL ,bm_complimentary='N', bm_complimentaryremark=NULL,bm_finaltotal='".$_REQUEST['grandtotal']."'   , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'");
			
			
			 }else
			 {
				 $sql= $database->mysqlQuery("UPDATE  tbl_tablebillmaster set bm_subtotal='".$_REQUEST['final']."',bm_cancelamount='".$_REQUEST['cancel']."' ,bm_discountid='".$_REQUEST['discountid']."',bm_discountvalue='".$_REQUEST['discount']."' ,bm_servicetax='".$_REQUEST['servicetx']."' ,bm_vat='".$_REQUEST['vat']."' ,bm_servicecharge='".$_REQUEST['servicechrg']."' ,bm_credit='N',bm_creditstaff=NULL ,bm_complimentary='N', bm_complimentaryremark=NULL,bm_finaltotal='".$_REQUEST['grandtotal']."'   , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'");
			 }
		 }else
		 {
			 $sql= $database->mysqlQuery("UPDATE  tbl_tablebillmaster set bm_subtotal='".$_REQUEST['final']."',bm_cancelamount='".$_REQUEST['cancel']."'  ,bm_servicetax='".$_REQUEST['servicetx']."' ,bm_vat='".$_REQUEST['vat']."' ,bm_servicecharge='".$_REQUEST['servicechrg']."' ,bm_credit='N',bm_creditstaff=NULL ,bm_complimentary='N', bm_complimentaryremark=NULL,bm_finaltotal='".$_REQUEST['grandtotal']."'   , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'");
		 }
		 
		 
	 }
	 if($sql)
	 {
		echo "ok";
	}else
	{
		echo "sorry";
	}
	 
 }else if($_REQUEST['set']=="complemtyinsert")
 {//cmpval:comp,grandtotal:tot,cancel:ccl,discountid:dscid,discount:dsc,servicetx:srvt,vat:vat,servicechrg:srvc,set:'complemtyinsert'	 
	 if(isset($_REQUEST['discountid']))
		 {
			 if(isset($_REQUEST['discount_corp']))
			 {
				  $sqls= $database->mysqlQuery("UPDATE  tbl_corporatemaster set ct_status='N' where ct_corporatecode='".$_REQUEST['discount_corp']."'");
				$sql= $database->mysqlQuery("UPDATE  tbl_tablebillmaster set bm_subtotal='".$_REQUEST['final']."',bm_cancelamount='".$_REQUEST['cancel']."' ,bm_discountid='".$_REQUEST['discountid']."',bm_corporatecode='".$_REQUEST['discount_corp']."' ,bm_discountvalue='".$_REQUEST['discount']."' ,bm_servicetax='".$_REQUEST['servicetx']."' ,bm_vat='".$_REQUEST['vat']."' ,bm_servicecharge='".$_REQUEST['servicechrg']."' ,bm_credit='N',bm_creditroom='',bm_complimentary='Y', bm_complimentaryremark='".$_REQUEST['cmpval']."',bm_finaltotal='".$_REQUEST['grandtotal']."'   , bm_paymode='complimentary' where bm_billno='".$_SESSION['billno']."'");
			 }else
			 {
				 $sql= $database->mysqlQuery("UPDATE  tbl_tablebillmaster set bm_subtotal='".$_REQUEST['final']."',bm_cancelamount='".$_REQUEST['cancel']."' ,bm_discountid='".$_REQUEST['discountid']."' ,bm_discountvalue='".$_REQUEST['discount']."' ,bm_servicetax='".$_REQUEST['servicetx']."' ,bm_vat='".$_REQUEST['vat']."' ,bm_servicecharge='".$_REQUEST['servicechrg']."' ,bm_credit='N',bm_creditroom='',bm_complimentary='Y', bm_complimentaryremark='".$_REQUEST['cmpval']."',bm_finaltotal='".$_REQUEST['grandtotal']."' , bm_paymode='complimentary' where bm_billno='".$_SESSION['billno']."'");
			 }
		 }else
		 {
			 $sql= $database->mysqlQuery("UPDATE  tbl_tablebillmaster set bm_subtotal='".$_REQUEST['final']."',bm_cancelamount='".$_REQUEST['cancel']."' ,bm_servicetax='".$_REQUEST['servicetx']."' ,bm_vat='".$_REQUEST['vat']."' ,bm_servicecharge='".$_REQUEST['servicechrg']."' ,bm_credit='N',bm_creditroom='',bm_complimentary='Y', bm_complimentaryremark='".$_REQUEST['cmpval']."',bm_finaltotal='".$_REQUEST['grandtotal']."' , bm_paymode='complimentary' where bm_billno='".$_SESSION['billno']."'");
		 }
	if($sql)
	{
		echo "ok";
	}else
	{
		echo "sorry";
	}
	 $sql1=  $database->mysqlQuery("update tbl_tableorder set ter_status='Closed' WHERE ter_billnumber='".$_SESSION['billno']."'");
	 $sql2=  $database->mysqlQuery("update tbl_tablebillmaster set bm_status='Closed' WHERE bm_billno='".$_SESSION['billno']."'");
		 $_SESSION['bill_close']="no";
 }else if($_REQUEST['set']=="voucherchek")
 {
	 $sql_table_sel1_2  =  $database->mysqlQuery("SELECT * from tbl_vouchermaster  WHERE vr_voucherid='".$_REQUEST['vcid']."' and  vr_voucherfrom <= '".$_SESSION['date']."' and `vr_voucherexpiry` >= '".$_SESSION['date']."' and vr_active='Yes'"); 
		$num_table1_2  = $database->mysqlNumRows($sql_table_sel1_2);
		if($num_table1_2)
			{
			  while($result_table_sel1_2  = $database->mysqlFetchArray($sql_table_sel1_2)) 
				  {
					  echo $result_table_sel1_2['vr_vouchercost'];
					  $database->mysqlQuery("UPDATE  tbl_vouchermaster set vr_active='No' where vr_voucherid='".$_REQUEST['vcid']."'");
					  
				  }
			}else
			{
				echo "sorry";
			}
			
	 
 }else if($_REQUEST['set']=="bill")
 {
	 if($_REQUEST['type']=="cash")
	 {
		  $sq="UPDATE  tbl_tablebillmaster set `bm_transactionamount`='',`bm_amountpaid`='".$_REQUEST['paid']."',`bm_amountbalace`='".$_REQUEST['bal']."',`bm_voucherid`=NULL, `bm_couponcompany`='', `bm_couponamt`='0.00', `bm_chequeno`='', `bm_chequebankname`=''  , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'";
		$sql= $database->mysqlQuery($sq);
	 }else if($_REQUEST['type']=="credit")
	 {
		 $sq="UPDATE  tbl_tablebillmaster set `bm_transactionamount`='".$_REQUEST['trans']."',bm_transcbank='".$_REQUEST['bank']."',`bm_amountpaid`='".$_REQUEST['paid']."',`bm_amountbalace`='".$_REQUEST['bal']."',`bm_voucherid`=NULL, `bm_couponcompany`='', `bm_couponamt`='0.00', `bm_chequeno`='', `bm_chequebankname`=''  , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'";
		$sql= $database->mysqlQuery($sq);
	 }else if($_REQUEST['type']=="coupon")
	 { 
	 $sq="UPDATE  tbl_tablebillmaster set bm_transactionamount=NULL,bm_amountpaid='".$_REQUEST['paid']."',bm_amountbalace='".$_REQUEST['bal']."',`bm_voucherid`=NULL, `bm_couponcompany`='".$_REQUEST['coup']."', `bm_couponamt`='".$_REQUEST['coupamnt']."', `bm_chequeno`='', `bm_chequebankname`=''  , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'";
		$sql=  $database->mysqlQuery($sq);
		 
	 }
	 else if($_REQUEST['type']=="voucher")
	 { 
	 $sq="UPDATE  tbl_tablebillmaster set bm_transactionamount=NULL,bm_amountpaid='".$_REQUEST['paid']."',bm_amountbalace='".$_REQUEST['bal']."',`bm_voucherid`='".$_REQUEST['vouchid']."', `bm_couponcompany`='', `bm_couponamt`='0.00', `bm_chequeno`='', `bm_chequebankname`=''  , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'";
		 $sql= $database->mysqlQuery($sq);
		
	 }
	 else if($_REQUEST['type']=="cheque")
	 {  
	 	$sq="UPDATE  tbl_tablebillmaster set bm_transactionamount=NULL,bm_amountpaid='".$_REQUEST['paid']."',bm_amountbalace='".$_REQUEST['bal']."',`bm_voucherid`=NULL, `bm_couponcompany`='', `bm_couponamt`='0.00', `bm_chequeno`='".$_REQUEST['cheqname']."', `bm_chequebankname`='".$_REQUEST['cheqbank']."', `bm_chequebankamount`='".$_REQUEST['cheqamt']."'  , bm_paymode='".$_REQUEST['type']."' where bm_billno='".$_SESSION['billno']."'";
		$sql=  $database->mysqlQuery($sq);
		
	 }
	  if($sql)
		{
			$tableids=$_SESSION['nextpagetable'];
			$prefxids=$_SESSION['nextpagepref'];
			 $tablecount=count($tableids);
			 for($i=0;$i<$tablecount;$i++)
					{
						//$sql2=  $database->mysqlQuery("DELETE FROM `tbl_tabledetails` WHERE ts_tableid='".$tableids[$i]."' and ts_tableidprefix='".$prefxids[$i]."'");
						
					}
					$sql1=  $database->mysqlQuery("update tbl_tableorder set ter_status='Closed' WHERE ter_billnumber='".$_SESSION['billno']."'");
					$sql1=  $database->mysqlQuery("update tbl_tablebillmaster set bm_status='Closed' WHERE bm_billno='".$_SESSION['billno']."'");
					$_SESSION['bill_close']="no";
					
						echo "ok";
					
		}else
		{
			echo "sorry";
		}
		//echo $sq;
	 
 }else  if($_REQUEST['set']=="cleartablefully")
 {
	 $tableids=$_SESSION['nextpagetable'];
  $prefxids=$_SESSION['nextpagepref'];
   $tablecount=count($tableids);
   for($i=0;$i<$tablecount;$i++)
		  {
			  $sql2=  $database->mysqlQuery("DELETE FROM `tbl_tabledetails` WHERE ts_tableid='".$tableids[$i]."' and ts_tableidprefix='".$prefxids[$i]."'");
			  
		  }
		  $sql1=  $database->mysqlQuery("update tbl_tableorder set ter_status='Closed' WHERE ter_billnumber='".$_SESSION['billno']."'");
		  $_SESSION['bill_close']="no";
 }
 else  if($_REQUEST['set']=="loadwholelist")
 {
	 ?>
 <script src="js/bill_gen_2.js"></script>
<!-- <script src="js/basicTabs-min.js"></script>
	<link rel="stylesheet" href="btn/tabs_cont_2.css">-->
   <div class="tab_menu_cc">
     <ul id="table_menu" class="tabs">
     
   <?php  
  $table= $_SESSION['nextpagetable'];
	 $pref=$_SESSION['nextpagepref']; 
	 $i=0;$old=""; $j=0;
	 $vv=array();
	 if($table){
	  foreach( $table as $number => $value){
		  $tablename=$database->show_mastertable_details($value);
		  $_SESSION['florids']=$tablename['tr_floorid'];
		  $flrid=$tablename['tr_floorid'];
		  $flrname=$database->show_floor_ful_details($flrid);
		  $ord=$database->show_tabledetails_ful($tablename['tr_tableid'],$pref[$number]);
		 $orno= $ord['ts_orderno'];
		  
		 if($old==$orno && ($i==1 || $i==0))
		 {
			 $i=0;
		 }
		 if($j!=0)
		 {
		   if($vv[0]==$orno)
		   {
			   $i=0;
		   }
		 }
		  $old=$orno;
		   $vv[]=$orno;
		  
	 ?>     
          <li class="tab <?php if($i==0){ ?> current active <?php } ?>" data-target="#<?=str_replace(' ', '', ($tablename['tr_tableno'].$pref[$number]));?>" ord="or_<?=$orno?>" name="nam_<?= $tablename['tr_tableid'] ?>" pref="pref_<?=$pref[$number]?>" total_name="<?=$tablename['tr_tableno']."(".$pref[$number].")"?>"> <span><?=$tablename['tr_tableno']."(".$pref[$number].")"?> /  <?=$flrname['fr_floorname']?></span>
             <?php if(!isset($_SESSION['billno'])) {  ?>
            <button type="button" class="close">×</button>
            <?php } ?>
          </li>
          <?php $i++;}}?>
    
	</ul>
    <!--<div class="order_button_right"><a href="#">Take Order</a></div>-->
  </div><!--tab_menu_cc-->  
<div class="tab-content">
<!--<div class="kot_right_table_bottomfixed">
	<a href="#" class="a-btn prcdbillbtn">
						<span class="a-btn-symbol"><img src="img/gnarate_bill.png"></span>
						<span class="a-btn-text" id="proceedtobill">Proceed To Bill</span> 
						<span class="a-btn-slide-icon"></span>
	</a>
</div>-->

<?php
$j=0;$totalcancel=0;
if($table){
 foreach( $table as $number => $value){ 
  $tablename=$database->show_mastertable_details($value);
 
 ?>

  <div class="tab-pane <?php if($j==0) { ?>active <?php } ?>" id="<?=str_replace(' ', '', ($tablename['tr_tableno'].$pref[$number]));?>" nam="nam_<?=$value?>">
   <div class="kot_bill_tab_table_cc">
  		<span class="kot_right_table_head">
        		<table width="100%" border="0" cellspacing="0">
                  <tr>
                    <th width="10%">Sl.No</th>
                    <th width="20%">Dish Name</td>
                    <th width="10%"><?=$_SESSION['s_portionname']?></th>
                    <th width="7%">Qty</th>
                    <th width="5%">Rate</th>
                    <th width="5%">Total</th>
                    <!--<th width="12%">Cancel</th>-->
                   
                  </tr>
             	</table> 
          	 </span> 
				<span id="table_list1" class="kot_right_table">
        			<table width="100%" border="0" cellspacing="0">
                    <tbody id="table_list1s" class="loadtables">
                    <?php
					$kots=array();
					$kots1=array();
					$sql_table_sel1  =  $database->mysqlQuery("SELECT distinct(ter_kotno) from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as td 	ON to1.ter_orderno=td.ts_orderno WHERE td.ts_tableid='".$value."' and  td.ts_tableidprefix='".$pref[$number]."' and to1.ter_dayclosedate='".$_SESSION['date']."'"); 
					$num_table1  = $database->mysqlNumRows($sql_table_sel1);
					if($num_table1){
						  while($result_table_sel1  = $database->mysqlFetchArray($sql_table_sel1)) 
							  {
                    ?>
                   <tr>
                   <td colspan="5"><div class="billgenaration_kot_order_number"><?=$result_table_sel1['ter_kotno'] ?></div></td>
                   </tr>
                <?php   
				$sql_table_sel1_2  =  $database->mysqlQuery("SELECT * from tbl_tableorder as to1 LEFT JOIN tbl_menumaster as mn 	ON to1.ter_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON to1.ter_portion=pm.pm_id WHERE to1.ter_kotno='".$result_table_sel1['ter_kotno']."' and to1.ter_dayclosedate='".$_SESSION['date']."' "); 
					$num_table1_2  = $database->mysqlNumRows($sql_table_sel1_2);
					if($num_table1_2){
						  while($result_table_sel1_2  = $database->mysqlFetchArray($sql_table_sel1_2)) 
							  {
								 
								  ?>
                                  <input type="hidden"  value="<?=$result_table_sel1_2['ter_qty'] ?>" qtyval="<?=$result_table_sel1_2['ter_qty'] ?>" portionval="<?=$result_table_sel1_2['pm_id'] ?>" menuval="<?=$result_table_sel1_2['mr_menuid'] ?>"  kotval="<?=$result_table_sel1_2['ter_kotno'] ?>" ordval="<?=$result_table_sel1_2['ter_orderno'] ?>" id="<?=$result_table_sel1_2['mr_menuid'].$result_table_sel1_2['pm_id'].$result_table_sel1_2['ter_kotno'].$result_table_sel1_2['ter_orderno'] ?>" rateval="<?=$result_table_sel1_2['ter_rate'] ?>">
                   <tr class="<?php if($result_table_sel1_2['ter_cancel']=="Y"){ ?>cancel_clr <?php } ?> tr_clone"  qtyval="<?=$result_table_sel1_2['ter_qty'] ?>" portionval="<?=$result_table_sel1_2['pm_id'] ?>" menuval="<?=$result_table_sel1_2['mr_menuid'] ?>"  kotval="<?=$result_table_sel1_2['ter_kotno'] ?>" ordval="<?=$result_table_sel1_2['ter_orderno'] ?>" rateval="<?=$result_table_sel1_2['ter_rate'] ?>">
                    <input type="hidden" value="<?=$result_table_sel1_2['ter_qty'] ?>" class="tr_clone_add1">
                  	<td width="10%"><?=$result_table_sel1_2['ter_slno'] ?></td>
                    <td width="20%"><?=$result_table_sel1_2['mr_menuname'] ?></td>
                    <td width="10%"><?=$result_table_sel1_2['pm_portionname'] ?></td>
                    <td width="7%" >
                    <?php if(!isset($_SESSION['billno'])  && $result_table_sel1_2['ter_qty']>0) { ?>
                    <input type="text" value="<?=$result_table_sel1_2['ter_qty'] ?>" style="width: 38px;text-align: center;" class="tr_clone_add" <?php if($result_table_sel1_2['ter_cancel']=="Y"){ ?> readonly="readonly" <?php } ?>>
                    <?php }else { echo $result_table_sel1_2['ter_qty']; }?>
                    <!--<?$result_table_sel1_2['ter_qty'] ?>--></td>
                    <td width="5%"><?=$result_table_sel1_2['ter_rate'] ?></td>
                    <!--<td width="12%">
                                       
                     <?php 
					 $temval="N"; 
					if($result_table_sel1_2['ter_billnumber']!='' )
					{
						$temp = strpos($result_table_sel1_2['ter_billnumber'], "TEMP");
						if ($temp !== false) {
							   //echo "The string '$findme' was found in the string '$mystring'";
								$temval="Y";  
						  } else {
							   //echo "The string '$findme' was not found in the string '$mystring'";
							   $temval="Y";
						  }
					}
					 
					 if($result_table_sel1_2['ter_billnumber']=="" || $temval=="Y"){ ?>
                    <a class="a_demo_four <?php if($result_table_sel1_2['ter_cancel']=="Y"){ ?>a_demo_four_active <?php } ?> " href="#" kot="kt_<?=$result_table_sel1_2['ter_kotno'] ?>" slno="sl_<?=$result_table_sel1_2['ter_slno'] ?>" menu="mn_<?=$result_table_sel1_2['mr_menuid'] ?>"  rate="rt_<?=$result_table_sel1_2['ter_rate'] ?>" qty="qt_<?=$result_table_sel1_2['ter_qty'] ?>" ord="or_<?=$result_table_sel1_2['ter_orderno'] ?>" >Cancel</a>
                    <?php }else{ ?>
                    <a class=" <?php if($result_table_sel1_2['ter_cancel']=="Y"){ ?>a_demo_four_active <?php } ?> " href="#" kot="kt_<?=$result_table_sel1_2['ter_kotno'] ?>" slno="sl_<?=$result_table_sel1_2['ter_slno'] ?>" menu="mn_<?=$result_table_sel1_2['mr_menuid'] ?>"  rate="rt_<?=$result_table_sel1_2['ter_rate'] ?>" qty="qt_<?=$result_table_sel1_2['ter_qty'] ?>" ord="or_<?=$result_table_sel1_2['ter_orderno'] ?>" ></a>
                    <?php } ?>
                    
                    </td>-->
                    <td width="5%"><?=($result_table_sel1_2['ter_qty'] * $result_table_sel1_2['ter_rate'])?></td>
                  </tr>
                  <?php } } ?>
                  <?php } } ?>
                
                  </tbody>
            </table>
        </span>
  	</div><!--kot_bill_tab_table_cc-->
  </div><!--page_1-->
  
  <?php  $j++;}} ?>
  
               </div><!--tabcontant-->

    <script src="js/jquery.nicescroll.min.js"></script>
        <script>
  $(document).ready(function() {

	var nice = $("html").niceScroll();  // The document page (body)
	
	$("#div1").html($("#div1").html()+' '+nice.version);
	 $("#kot_scroll1").niceScroll({touchbehavior:true});
	 $("#table_list").niceScroll({touchbehavior:true});
	 $("#table_list1").niceScroll({touchbehavior:true});
	  $("#table_menu").niceScroll({touchbehavior:true,}); // Scroll Y Axis 
	   $("#bill_scr").niceScroll({touchbehavior:true,});
	   
	nice = $("#table_menu").niceScroll();
    var _super = nice.getContentSize;
    nice.getContentSize = function() {      
      var page = _super.call(nice);
      page.h = nice.win.height();
      return page;
    }
	

	   });
 
</script>
<script>
	$(document).ready(function(){
			// $(window).bind('load', function(){
				//$('#bill_scr').empty();
		/* cancel each item by qty starts */			
	  $(".tr_clone_add").bind('change',function() {
		  
		   if($(this).val()!=0)
		  {//mnv qty
			  var $tr    = $(this).closest('.tr_clone');
			  var $clone = $tr.clone();
			  var valtotext_org   = $tr.attr('qtyval');
			  var canceldtext=($clone.find(':text').val());
			  var final=parseInt(valtotext_org) +  parseInt(canceldtext);
			 //alert(final)
			  
			   	// && final<valtotext_org 
			  if(final>=0) 
			  {
				  
				  var portchange=($tr.attr("portionval"))
				  var menuchange=($tr.attr("menuval"))
				  var kotchange=($tr.attr("kotval"))
				  var ordchange=($tr.attr("ordval"))
				  var rate=($tr.attr("rateval"))
				   var uq=(menuchange+portchange+kotchange+ordchange)
				  var orgval=($("input[id='" + uq + "']").val());
				  if(final<=orgval)
				  {
						$tr.removeAttr('qtyval');
						$tr.attr('qtyval',final);
						$tr.after($clone);
						$clone.find(':text').val($(this).val());
						$clone.find('td:first').text('');
						$clone.css('background','#FEC7B4');
						$clone.addClass('cancel_clr');
						$clone.find('a').addClass('a_demo_four_active');
						$clone.find(':text').prop('disabled', true);
						var qtychange=($(this).val())
						var qtyc	  =	 qtychange.split("-");
						$(this).val(final);
						//alert(final)
						var totc=parseFloat(rate) *  parseFloat(qtyc[1]);
						if($('#totalcancelrate').val()!="" || $('#totalcancelrate').val()!="0")
						{
						var fn=parseFloat($('#totalcancelrate').val()) + parseFloat(totc);
						}else
						{
							var fn= parseFloat(totc);
						}
						 $('#totalcancelrate').val(fn);
						 
					    $.post("load_bill.php", {menuchange:menuchange,portchange:portchange,kotchange:kotchange,ordchange:ordchange,qtychange:final,set:'cancelupdationbill'},
						function(data)
						{
						data=$.trim(data);
						//alert(data);
						$('#dfr').html(data);
						});
				  }else
				  {
					  $tr.find(':text').val(valtotext_org);
				  }
			  }
			  else
			  {
				  $tr.find(':text').val(valtotext_org);
			  }
		  }
		
	  });
	  /* cancel each item by qty  ends*/			

				
				
				
			
		}); 
	</script>
               <?php 
}else if($_REQUEST['set']=="cancelstatussingle") 
{
  
  $menu=$_REQUEST['menu'];
  $sln=$_REQUEST['sln'];
  $kot=$_REQUEST['kot'];
  $qty=$_REQUEST['qty'];
  
	   if(($_REQUEST['st']=="cancel"))
	  {
		   $sql_table_sel1_sel1  =  $database->mysqlQuery("UPDATE  tbl_tableorder set ter_cancel='Y' where ter_kotno='".$kot."' and ter_menuid='".$menu."' and ter_slno='".$sln."' and ter_qty='".$qty."'");
	  }else if(($_REQUEST['st']=="enable"))
	  {
		  $sql_table_sel1_sel1  =  $database->mysqlQuery("UPDATE  tbl_tableorder set ter_cancel='N' where ter_kotno='".$kot."' and ter_menuid='".$menu."' and ter_slno='".$sln."' and ter_qty='".$qty."'");
	  }


}else if($_REQUEST['set']=="billingtotalrate") 
{$total=0;
	   $sql_listall  =  $database->mysqlQuery("SELECT * from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn 	ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id WHERE td.bd_billno='".$_SESSION['billno']."' order by td.bd_billslno "); 
  $num_listall  = $database->mysqlNumRows($sql_listall);
  if($num_listall){
		while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
			{
			   $total=$total + $row_listall['bd_amount'];
			   
			}
  }
  echo $total;

}
else if($_REQUEST['set']=="tableselectiontonextpage_first") 
{
	 $_SESSION['nextpagetable']=$_REQUEST['tableid'];
	 $_SESSION['nextpagepref']=$_REQUEST['prefx'];
	 $table= $_SESSION['nextpagetable'];
	 $pref=  $_SESSION['nextpagepref']; 
	 $totname  =  $_REQUEST['totname'];
	 if(isset($_REQUEST['loyalityid']))
	 {
	 	$loyalityid=$_REQUEST['loyalityid'];
	 }else
	 {
		$loyalityid=0; 
	 }
	$tablecount=count($totname);
	$tb='';
   for($i=0;$i<$tablecount;$i++)
	  {
		 if($i==0)
		 {
			$tb= $totname[$i];
		 }else
		 {
			 $tb=$tb.",". $totname[$i];
		 }
	  }
	 $j=0;$totalcancel=0;
	 $orderarray= array();
	 $orderarray=array_unique($_REQUEST['ord']);
	 $ct=count($orderarray);
	 $final="";
	 for($i=0;$i<$ct;$i++)
	 {
		 if($i==0)
		 {
			 $final=$orderarray[$i];
		 }else
		 {
			 $final=$final .",". $orderarray[$i];
		 }
	 }
	  $orderfinal=$final;
	 $branch=$_SESSION['branchofid'];
	  $cancel="";
	  $returnmsg='';
	  try {
		  $discount_of_or='';
		  $discount_unit_or='';
		  $discount_or='';
		  $discountid_or='';
		  if(isset($_REQUEST['type']))
		  {
			  if($_REQUEST['type']=="drop")
			  {
				  $discount_of_or="";
				  $discount_unit_or="";
				  $discount_or="Y";
				  $discountid_or=$_REQUEST['discount'];
			  }else if($_REQUEST['type']=="text")
			  {
				 $discount_of_or=$_REQUEST['discount'];
				  $discount_unit_or=$_REQUEST['disctype'];
				  $discount_or="Y";
				  $discountid_or=""; 
			  }else
			  {
				  $discount_of_or="";
				  $discount_unit_or="";
				  $discount_or="N";
				  $discountid_or=""; 
			  }
		  }else
		  {
			  $discount_of_or="";
			  $discount_unit_or="";
			  $discount_or="N";
			  $discountid_or=""; 
		  }
		 
		  
		  $database->mysqlQuery("SET @orderno = " . "'" . $orderfinal . "'");
		  $database->mysqlQuery("SET @branchid = " . "'" . $branch . "'");
		  $database->mysqlQuery("SET @cancelamt = " . "'" . $cancel . "'");
		  $database->mysqlQuery("SET @discount_of = " . "'" . $discount_of_or . "'");
		  $database->mysqlQuery("SET @discount_unit = " . "'" . $discount_unit_or . "'");
		  $database->mysqlQuery("SET @discount = " . "'" . $discount_or . "'");
		  $database->mysqlQuery("SET @discountid = " . "'" . $discountid_or . "'");//,@discount_of,@discount_unit,@discount
		  $database->mysqlQuery("SET @tableno = " . "'" . $tb . "'");
		  $database->mysqlQuery("SET @loyalty_id = " . "'" . $loyalityid . "'");
		  $billnumber='';
		  $Message='';
		  $sq=$database->mysqlQuery("CALL proc_billgenerate(@orderno,@branchid,@billnumber,@cancelamt,@discount_of,@discount_unit,@discount,@discountid,@tableno,@loyalty_id,@Message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
		  $rs = $database->mysqlQuery( 'SELECT @billnumber AS billnumber,@Message as Message' );
		  while($row = mysqli_fetch_array($rs))
		  {
		  $s= $row['billnumber'];
		  $returnmsg=$row['Message'];
		  }
		   $_SESSION['billno']=$s;echo "";
         // echo $returnmsg;
	  } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }

	 
	 
	// $returnmsg="sorry";
	/*if(isset($_REQUEST['discount']))
	{
		$fintot=0;
		$discount=0;
		$sql_table_sel1  =  $database->mysqlQuery("SELECT bm_subtotal from tbl_tablebillmaster   WHERE bm_billno='".$_SESSION['billno']."'"); 
		while($result_table_sel1  = $database->mysqlFetchArray($sql_table_sel1)) 
			{
				$fintot=$result_table_sel1['bm_subtotal'];
			}
			$fr_servicetax=0;
			$fr_vat=0;
			$fr_servicecharge=0;
		$sql_table_sel1  =  $database->mysqlQuery("SELECT f.fr_servicetax,f.fr_vat,f.fr_servicecharge,f.fr_floorid  FROM tbl_tabledetails td LEFT JOIN tbl_floormaster f ON f.fr_floorid = td.ts_floorid WHERE td.ts_orderno ='".$orderfinal."'"); 
		while($result_table_sel1  = $database->mysqlFetchArray($sql_table_sel1)) 
			{
				$fr_servicetax=$result_table_sel1['fr_servicetax'];
				$fr_vat=$result_table_sel1['fr_vat'];
				$fr_servicecharge=$result_table_sel1['fr_servicecharge'];
			}	
			 
			
			
		if($_REQUEST['type']=="drop")
		{
			$dsc=0;
			$sql_table_ds  = $database->mysqlQuery("SELECT ds_percent from tbl_discountmaster   WHERE ds_discountid='".$_REQUEST['discount']."'"); 
			while($result_table_ds  = $database->mysqlFetchArray($sql_table_ds)) 
				{
					$dsc=$result_table_ds['ds_percent'];
				}
				if (strpos($dsc,'%') !== false) // type percent
				{
					$spl=explode("%",$dsc);
					$discount=$fintot * ($spl[0] / 100);
				}else
				{
					$discount=$dsc;
				}
				$tot=	$fintot - $discount;
				/*$subtotal=$tot;
				$_SESSION['s_servicetaxunit'];
				$_SESSION['s_servicechargeunit'];
				$_SESSION['s_vatunit'];
				
				 $finaltotal = 0;
					$afterservicecharge = 0;
  					  $finaltotal = 0;
					  $inservicecharge=0;
					  if($_SESSION['s_servicechargeunit'] == '%')
					  {
						$inservicecharge = (($subtotal * $fr_servicecharge)/100);
						$afterservicecharge = $subtotal + $inservicecharge;
						$finaltotal = $afterservicecharge;
					  }
					  else if ($_SESSION['s_servicechargeunit'] == 'Value') 
					  {
						$inservicecharge = $fr_servicecharge;
						$afterservicecharge = $subtotal + $inservicecharge;
						$finaltotal = $afterservicecharge;
					  }
					  
						
					  $afterservicetax = 0;
					  if($_SESSION['s_servicetaxunit'] == '%')
					  {
						$afterservicetax = (($afterservicecharge * $fr_servicetax)/100);
						$finaltotal = $finaltotal + $afterservicetax;
					  }   
					  elseif ($_SESSION['s_servicetaxunit'] == 'Value') 
					  {
						$afterservicetax = $fr_servicetax;
						$finaltotal =  $finaltotal + $fr_servicetax;
					  }
					  
					  $aftervat = 0;
					  if($_SESSION['s_vatunit'] == '%')
					  {
						$aftervat = (($afterservicecharge * $fr_vat)/100);
						$finaltotal = $finaltotal + $aftervat;
					  }
					  elseif ($_SESSION['s_vatunit'] == 'Value')
					  {
						$aftervat  = $fr_vat;
						$finaltotal = $finaltotal +$fr_vat;
					  }*/
					  
					  
					 // $finaltotal = $finaltotal - $bm_cancelamount;
				
				
				
			/*	$sq=$database->mysqlQuery("UPDATE tbl_tablebillmaster set bm_discountvalue='".$discount."',bm_finaltotal='".$tot."',bm_discountid='".$_REQUEST['discount']."' where bm_billno='".$_SESSION['billno']."'");
		
		}else if($_REQUEST['type']=="text")
		{
			$discount=$_REQUEST['discount'];
			$tot=	$fintot - $discount;
			$sq=$database->mysqlQuery("UPDATE tbl_tablebillmaster set bm_discountvalue='".$discount."',bm_finaltotal='".$tot."' where bm_billno='".$_SESSION['billno']."'");
		}
		
	}*/
	 
	 echo $returnmsg;
	 
	 
}
else if($_REQUEST['set']=="closedirectfuncion") 
{
	$returnmsg='';
	$returnmsg_err='';$modes='';
	if($_SESSION['s_ta_directclosefirst']=='Y') 
	 {$s='';
	 $database->mysqlQuery("SET @billno = " . "'" . $_SESSION['billno'] . "'");
	 $message='';
	 if(isset($_REQUEST['setmode']))
	 {
		 $modes=$_REQUEST['setmode'];
	 }else
	 {
	 $modes='BC';
	 }
	 $database->mysqlQuery("SET @mode = " . "'" . $modes . "'");
	 
	  try {
		 $sqs=$database->mysqlQuery("CALL proc_billclose(@billno,@message,@mode)")  or $database->throw_ex(mysqli_error($database->DatabaseLink));
		 $rss = $database->mysqlQuery( 'SELECT @message AS message' );
		  while($rows = mysqli_fetch_array($rss))
		  {
		  $s= $rows['message'];
		  }
		  $returnmsg=$s;
		   $returnmsg_err="";
		   
	  } catch (Exception $e) {
		  $returnmsg_err= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		   $content = date("l F  d-m-Y h:i:s A")." ".$returnmsg_err.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo  $returnmsg_err;exit();
	  }
	 
	 }else 
	 {
		 if(isset($_REQUEST['setmode']))
		 {
				 $_SESSION['billno']=$_REQUEST['bilno'];
				$s='';
			 $database->mysqlQuery("SET @billno = " . "'" . $_SESSION['billno'] . "'");
			 $message='';
			 $database->mysqlQuery("SET @mode = " . "'" . $_REQUEST['setmode'] . "'");
			 // if(isset($_REQUEST['setmode']))
			 //{
				// $mode=$_REQUEST['setmode'];
			 //}else
			 //{
			//	 $mode='BC';
			 //}
			 
			 
			  try {
				 $sqs=$database->mysqlQuery("CALL proc_billclose(@billno,@message,@mode)")  or $database->throw_ex(mysqli_error($database->DatabaseLink));
				 $rss = $database->mysqlQuery( 'SELECT @message AS message' );
				  while($rows = mysqli_fetch_array($rss))
				  {
				  $s= $rows['message'];
				  }
				  $returnmsg=$s;
				   $returnmsg_err="";
				   
			  } catch (Exception $e) {
				  $returnmsg_err= 'Caught exception: '.  $e;
				  $file = 'log.txt';
				   $content = date("l F  d-m-Y h:i:s A")." ".$returnmsg_err.PHP_EOL;
				  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
				  echo  $returnmsg_err;exit();
			  }
	 
		 }
	 }
	 echo $returnmsg;
}

else if($_REQUEST['set']=="setnoncorporate") 
{ 
//`tbl_discountmaster`(`ds_discountid`, `ds_discountname`, `ds_branchid`, `ds_status`, `ds_percent`) 
	$tot=$_REQUEST['total'];
$sql_table_sel1  =  $database->mysqlQuery("SELECT * from tbl_discountmaster   WHERE ds_discountid='".$_REQUEST['type']."' and  ds_branchid='".$_SESSION['branchofid']."' and  ds_status='Active'"); 
		$num_table1  = $database->mysqlNumRows($sql_table_sel1);
		if($num_table1)
		{
			  while($result_table_sel1  = $database->mysqlFetchArray($sql_table_sel1)) 
				  {
					  $per=$result_table_sel1['ds_percent'];
				  }
				  $final= (($tot *  $per) / 100);
		}else
		{
			$per=0;
			$final= ($tot);
		}
		
		echo $final;
		
		



}else if($_REQUEST['set']=="setcorporate") 
{
	$tot=$_REQUEST['total'];
	//`tbl_corporatediscount`(`ct_corporatecode`, `ct_corporatename`, `ct_corporatediscount`, `ct_branchid`)
$sql_table_sel1  =  $database->mysqlQuery("SELECT * from tbl_corporatemaster   WHERE ct_corporatecode='".$_REQUEST['type']."' and  ct_branchid='".$_SESSION['branchofid']."' "); 
		$num_table1  = $database->mysqlNumRows($sql_table_sel1);
		if($num_table1)
		{
			  while($result_table_sel1  = $database->mysqlFetchArray($sql_table_sel1)) 
				  {
					  $per=$result_table_sel1['ct_corporatediscount'];
				  }
				  $final= (($tot *  $per) / 100);
		}else
		{
			$per=0;
			$final= ($tot);
		}
		
		echo $final;

}else if($_REQUEST['set']=="pendbillsessionset") 
{
	//`tbl_tablebilldetails`(`bd_billno`, `bd_billslno`, `bd_menuid`, `bd_portion`, `bd_rate`, `bd_qty`, `bd_amount`, `bd_type`, `bd_printbill`)
	$sql_table_sel1  =  $database->mysqlQuery("SELECT * from tbl_tablebilldetails   WHERE bd_billno='".$_REQUEST['bilno']."'"); 
		$num_table1  = $database->mysqlNumRows($sql_table_sel1);
		if($num_table1)
		{
			  while($result_table_sel1  = $database->mysqlFetchArray($sql_table_sel1)) 
				  {
					  if($result_table_sel1['bd_printbill']=="Y")
					  {
							$_SESSION['bill_printed']="yes";
					  }else
					  {
						  $_SESSION['bill_printed']="no";
					  }
				  }
		}else
		{
			$_SESSION['bill_printed']="no";
		}
	$_SESSION['bill_close']="yes";
	$_SESSION['billno']=$_REQUEST['bilno'];
	
}else if($_REQUEST['set']=="cancelupdationbill") 
{
	$sql_table_sel1  =  $database->mysqlQuery("SELECT * from tbl_tableorder   WHERE ter_orderno='".$_REQUEST['ordchange']."' And ter_menuid='".$_REQUEST['menuchange']."' And ter_kotno='".$_REQUEST['kotchange']."' And ter_portion='".$_REQUEST['portchange']."' And ter_branchid='".$_SESSION['branchofid']."'"); 
	$num_table1  = $database->mysqlNumRows($sql_table_sel1);
	if($num_table1)
	{
		  while($rs  = $database->mysqlFetchArray($sql_table_sel1)) 
			  {
				  $tercanel="N";
				  if($_REQUEST['qtychange']==0)
				  {
					   $tercanel="Y";
				  }
				  $database->mysqlQuery("UPDATE tbl_tableorder SET ter_qty='".$_REQUEST['qtychange']."',ter_cancel='$tercanel' WHERE ter_orderno='".$_REQUEST['ordchange']."' And ter_menuid='".$_REQUEST['menuchange']."' And ter_kotno='".$_REQUEST['kotchange']."' And ter_portion='".$_REQUEST['portchange']."' And ter_branchid='".$_SESSION['branchofid']."'");
				  
				  
			  }
	}
	
	
	
}else if($_REQUEST['set']=="checkloyalitydetailsbill") 
{
	if(isset($_REQUEST['phone']))
	{
		$sql_loy_s_m  =  $database->mysqlQuery("select ly_id from tbl_loyalty_reg where ly_mobileno LIKE '%".$_REQUEST['phone']."'");
		$num_loy_s_m  = $database->mysqlNumRows($sql_loy_s_m);
		if($num_loy_s_m)
		{
			while($result_loy_s_m  = $database->mysqlFetchArray($sql_loy_s_m)) 
				{
					echo $result_loy_s_m['ly_id'];
				}
			//echo "ok";
			
		}else
		{
			echo "sorry";
		}
	}else if(isset($_REQUEST['name']))
	{
		$sql_loy_s_m  =  $database->mysqlQuery("select ly_id from tbl_loyalty_reg where ly_firstname LIKE '%".$_REQUEST['name']."'");
		$num_loy_s_m  = $database->mysqlNumRows($sql_loy_s_m);
		if($num_loy_s_m)
		{
			while($result_loy_s_m  = $database->mysqlFetchArray($sql_loy_s_m)) 
				{
					echo $result_loy_s_m['ly_id'];
				}
			
		}else
		{
			echo "sorry";
		}
	}
}else if($_REQUEST['set']=="billregenerate") 
{
	$bilno=$_REQUEST['bilno'];
	try {
		$database->mysqlQuery("SET @regen_billno = " . "'" . $bilno . "'");
		$sqs=$database->mysqlQuery("CALL proc_bill_regenerate(@regen_billno)")  or $database->throw_ex(mysqli_error($database->DatabaseLink));
		 if($sqs)
		 {
			 echo "Bill Re-Generated";
		 }
		 exit();
		   
	  } catch (Exception $e) {
		  $returnmsg_err= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		   $content = date("l F  d-m-Y h:i:s A")." ".$returnmsg_err.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo  $returnmsg_err;exit();
	  }

}

?>
 