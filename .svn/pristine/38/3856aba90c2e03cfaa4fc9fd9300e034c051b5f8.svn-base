<?php
include('includes/session.php');   // Check session
include("database.class.php");     // DB Connection class
$database	= new Database();  // Create a new instance
//$value	= $_REQUEST['value'];
include("api_multiplelanguage_link.php");
$localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
error_reporting(0); 
$floorid=  trim(json_encode($_SESSION['floorid']),'""');

$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
use Google\Client;

if($_REQUEST['set']=='portionset'){
    
        if($_REQUEST['portionval']!=''){
	$_SESSION['portionvalue']=$_REQUEST['portionval'];
        }
        else{
            $_SESSION['portionvalue']='';
        }
        if($_REQUEST['unitval']!=''){
        $_SESSION['unit_id']=$_REQUEST['unitval'];
        }
        else{
            $_SESSION['unit_id']=0;
        }
        if($_REQUEST['baseunit']!=''){
            $_SESSION['baseunit_id']=$_REQUEST['baseunit'];
        }
        else{
            $_SESSION['baseunit_id']=0;
        }
        
	//$_SESSION['preferenceselectvalue']=0;
	//$_SESSION['preferencetextvalue']=0;
}
else if($_REQUEST['set']=='set_all_in_single'){ 
    
     $_SESSION['preferencetextvalue']='';
    
     $_SESSION['quantityvalue']=$_REQUEST['qtyval'];
     
    if(isset($_REQUEST['qtyval1'])){
        $_SESSION['quantityvalue1']=$_REQUEST['qtyval1'];
    }else{
        $_SESSION['quantityvalue1']=$_SESSION['quantityvalue'];
    }
    
    
    $_SESSION['ratevalue']=$_REQUEST['rateval'];
    
    $_SESSION['menu_id']=$_REQUEST['menu'];
    
 
        if($_REQUEST['portionval']!=''){
	    $_SESSION['portionvalue']=$_REQUEST['portionval'];
        }
        else{
            $_SESSION['portionvalue']='';
        }
        
        if($_REQUEST['unitval']!=''){
            $_SESSION['unit_id']=$_REQUEST['unitval'];
        }
        else{
            $_SESSION['unit_id']=0;
        }
        
        if($_REQUEST['baseunit']!=''){
            $_SESSION['baseunit_id']=$_REQUEST['baseunit'];
        }
        else{
            $_SESSION['baseunit_id']=0;
        }

}
else if($_REQUEST['set']=='quantityset'){ 
    
   
    $_SESSION['quantityvalue']=$_REQUEST['qtyval'];
    
    if(isset($_REQUEST['qtyval1'])){
     $_SESSION['quantityvalue1']=$_REQUEST['qtyval1'];
    }else{
        $_SESSION['quantityvalue1']=$_SESSION['quantityvalue'];
    }
    
	
}
else if($_REQUEST['set']=='rateset'){ 
    
    $_SESSION['ratevalue']=$_REQUEST['rateval'];
	
}
else if($_REQUEST['set']=='preferenceset'){ 
 	 
            
	 $_SESSION['preferencetextvalue']=  $_REQUEST['all'];
         $_SESSION['preferencetextvalue'] =str_replace("undefined,","",$_SESSION['preferencetextvalue']);
         $_SESSION['preferencetextvalue'] =str_replace("undefined","",$_SESSION['preferencetextvalue']);
	 echo $_SESSION['preferencetextvalue'];
         
}
else if($_REQUEST['set']=='settype'){ 
 	$_SESSION['typevalue']=$_REQUEST['type'];
        
}else if($_REQUEST['set']=='setmenuids'){ 
 	$_SESSION['menu_id']=$_REQUEST['menu'];
        
}else if($_REQUEST['set']=="backto"){
    
	  $order=$_SESSION['order_id'];
	  $sql_menulist="select * from tbl_tableorder where ter_orderno='".$_SESSION['order_id']."' ";
	  $sql_menus  =  $database->mysqlQuery($sql_menulist); 
	  $num_menus  = $database->mysqlNumRows($sql_menus);
	  if($num_menus)
	  {  
              $sq=$database->mysqlQuery("UPDATE tbl_tabledetails SET  ts_in_access='N' WHERE ts_orderno='".$_SESSION['order_id']."' ");
	  
              
          }
}
else if($_REQUEST['set']=="chekenablestatus"){
	
  $sq=$database->mysqlQuery("UPDATE tbl_tabledetails SET ts_in_access='N' WHERE ts_orderno='".$_SESSION['order_id']."' ");
  
}

else if($_REQUEST['set']=="cancelreservation"){
    
	  $order=$_REQUEST['tableid'];
	  $sql_menulist="select * from tbl_tableorder where ter_orderno='".$order."' ";
	  $sql_menus  =  $database->mysqlQuery($sql_menulist); 
	  $num_menus  = $database->mysqlNumRows($sql_menus);
	  if(!$num_menus)
	  { $sql='';
	  
		  $sql=$database->mysqlQuery("delete from  tbl_tabledetails where ts_orderno='".$order."' ");  
		  
		  if($sql)
		  {
			  echo "ok";
		  }else
		  {
			  echo "sorry";
		  }
	  }
				
}else if($_REQUEST['set']=="chkresrvd"){
    
	  $order=$_SESSION['order_id'];
	  if($_SESSION['backchecking']=="N")
	  {
		$sql_menulist="select tor.ter_orderno ,td.ts_status  from  tbl_tabledetails td
                left join tbl_tableorder tor on td.ts_orderno = tor.ter_orderno
                where td.ts_orderno = '$order'";
		  $sql_menus  =  $database->mysqlQuery($sql_menulist); 
		  $num_menus  = $database->mysqlNumRows($sql_menus);
                  if($num_menus){
                      $result_rows =  $database->mysqlFetchArray($sql_menus);
                      if($result_rows['ter_orderno']=='' or $result_rows['ter_orderno'] == null){
                          if($result_rows['ts_status'] != 'Reserved'){
                            $database->mysqlQuery("delete from  tbl_tabledetails where ts_orderno='".$order."' AND ts_interface='W'"); 
                          }
                      }else{
                          $sq=$database->mysqlQuery("UPDATE tbl_tabledetails SET  ts_in_access='N' WHERE ts_orderno='$order' ");
                      }
                  }

	  }
				
}else if($_REQUEST['set']=="takeorder"){
    
	$k=$_REQUEST['tableid'];
	$returnmsg='';
	$m=implode(",",$k);
        $localIP = getHostByName(getHostName());
        
        $person=$_REQUEST['persons'];
        
        if($_REQUEST['persons']=='qr'){
            
         $sql_login  =  $database->mysqlQuery("select tr_vaccantcount from tbl_tablemaster where tr_tableid='".$_REQUEST['table']."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      $person=$result_login['tr_vaccantcount'];
                  }
                  }
        }
        
      
        
        
	try {
			
			$database->mysqlQuery("SET @tableid = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$m) . "'");
			$database->mysqlQuery("SET @guestcount = " . "'" . mysqli_real_escape_string($database->DatabaseLink, $person) . "'");
			if($_SESSION['s_persct']=="Y")
			$database->mysqlQuery("SET @category = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type']) . "'");
			else
			$database->mysqlQuery("SET @category = " . "'Group'");
			
			$database->mysqlQuery("SET @Reserve = " . "'N'");
			$database->mysqlQuery("SET @staffid = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['steward']) . "'");
			$database->mysqlQuery("SET @reservertime = " . "''");
                        $database->mysqlQuery("SET @machine_id = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$localIP) . "'");
			$orderid='';
			$sq=$database->mysqlQuery("CALL proc_tabledetailentry(@orderid,@tableid,@guestcount,@category,@Reserve,@staffid,@reservertime,'W',@machine_id)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
			$rs = $database->mysqlQuery( 'SELECT @orderid AS orderid' );
		while($row = mysqli_fetch_array($rs))
		{
		   $_SESSION['order_id']=$row['orderid'];
		}
		
                
               // echo $_SESSION['order_id'];
                
		$sq4=$database->mysqlQuery("UPDATE tbl_tabledetails SET ts_username='".$_SESSION['expodine_id']."' , "
                . " ts_in_access='Y' WHERE ts_orderno='".$_SESSION['order_id']."' ");
                
		$returnmsg="";
                
                
	}catch (Exception $e) {
            
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F  d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo  $returnmsg; exit();
	}
        
	if($sq)
	{
	   echo $s=0;
		 
	}else
	{
	   echo $s=1;
           
           
	}
       
}
else if($_REQUEST['set']=="pincheck"){
    
    
    $pin = $_REQUEST['pin'];
    $str = '';
    if($_REQUEST['type']=="staffsel")
        $str .= "ser_authorisation_code = '$pin'";
    else if($_REQUEST['type']=="authpincheck")
        $str .= "ser_authorisation_code = '$pin'";
    
    if(isset($_REQUEST['action']) && $_REQUEST['action']=='kotcancel'){
        $sql_staff="select sm.ser_kot_reprint_per,sm.ser_change_table_permission,sm.ser_bill_settle_permission,sm.ser_bill_print_permission,sm.ser_discount_manual,sm.ser_discountpermission, sm.ser_bill_cancel_permission,sm.ser_order_split_permission,sm.ser_dayclose_permission,sm.ser_staffid,sm.ser_cancelpermission,sm.ser_bill_reprint_per,sm.ser_bill_settle_change_per,sm.ser_bill_regen_per, dm.dr_takeorder FROM tbl_staffmaster sm
    left join tbl_designationmaster dm on dm.dr_designationid = sm.ser_designation
    where $str and sm.ser_employeestatus = 'Active' and sm.ser_kot_cancel_permission='Y'";
      
    }
    else if(isset($_REQUEST['action']) && $_REQUEST['action']=='billcancelpermission'){
        $sql_staff="select sm.ser_kot_reprint_per,sm.ser_change_table_permission,sm.ser_bill_settle_permission,sm.ser_bill_print_permission,sm.ser_discount_manual,sm.ser_discountpermission, sm.ser_order_split_permission,sm.ser_dayclose_permission,sm.ser_bill_cancel_permission,sm.ser_cancelpermission,sm.ser_staffid,sm.ser_bill_settle_change_per,sm.ser_bill_reprint_per,sm.ser_bill_regen_per FROM tbl_staffmaster sm where $str and sm.ser_employeestatus = 'Active' and sm.ser_bill_cancel_permission='Y'";
      
    }
    else{
    $sql_staff="select sm.ser_kot_reprint_per,sm.ser_change_table_permission,sm.ser_bill_settle_permission,sm.ser_bill_print_permission,sm.ser_discount_manual,sm.ser_discountpermission, sm.ser_bill_cancel_permission,sm.ser_order_split_permission,sm.ser_dayclose_permission,sm.ser_staffid,sm.ser_cancelpermission,sm.ser_bill_settle_change_per,sm.ser_bill_regen_per,sm.ser_bill_reprint_per, dm.dr_takeorder FROM tbl_staffmaster sm
    left join tbl_designationmaster dm on dm.dr_designationid = sm.ser_designation
    where $str and sm.ser_employeestatus = 'Active'";
   
    
    }
    $sql_staff  =  $database->mysqlQuery($sql_staff); 
    $num_staff  = $database->mysqlNumRows($sql_staff);
    if($num_staff){
        $row = mysqli_fetch_array($sql_staff);
        if($_REQUEST['type']=="staffsel"){
            if($row['dr_takeorder']=='Y'){
                echo $row['ser_staffid']; 
            }else{
                echo "NO PERMISSION";
            }
        }else {
            echo $row['ser_staffid']; 
        }
        echo "*reprint:".$row['ser_bill_reprint_per']."*regen:".$row['ser_bill_regen_per']."*change:".$row['ser_bill_settle_change_per']."*kotcancel:".$row['ser_cancelpermission']."*billcancel:".$row['ser_bill_cancel_permission']."*dayclose:".$row['ser_dayclose_permission']."*ordersplit:".$row['ser_order_split_permission']."*dis_auth:".$row['ser_discountpermission']."*dis_manual:".$row['ser_discount_manual']."*billprint:".$row['ser_bill_print_permission']."*billsettle:".$row['ser_bill_settle_permission']."*change_table:".$row['ser_change_table_permission']."*staff_log:".$row['ser_staffid']."*kot_reprint:".$row['ser_kot_reprint_per'];
       
    }else{
        echo "NO";
    }

}else if($_REQUEST['set']=="reserve"){
    
    
	$k=$_REQUEST['tableid'];
	$returnmsg='';
	$m=implode(",",$k);
        $localIP = getHostByName(getHostName());
	try {
			//$database->mysqlQuery("SET @orderid = " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_SESSION['order_id']) . "'");
			
			$database->mysqlQuery("SET @tableid = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$m) . "'");
			$database->mysqlQuery("SET @guestcount = " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['persons']) . "'");
			//$database->mysqlQuery("SET @category = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type']) . "'");
			if($_SESSION['s_persct']=="Y")
			$database->mysqlQuery("SET @category = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type']) . "'");
			else
			$database->mysqlQuery("SET @category = " . "'Group'");
			$database->mysqlQuery("SET @Reserve = " . "'Y'");
			$database->mysqlQuery("SET @staffid = " . "''");
                        $database->mysqlQuery("SET @machine_id = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$localIP) . "'");
			$orderid='';
			$database->mysqlQuery("SET @reservertime = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['resrvtim']) . "'");
			$sq=$database->mysqlQuery("CALL proc_tabledetailentry(@orderid,@tableid,@guestcount,@category,@Reserve,@staffid,@reservertime,'W',@machine_id)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
			
			
			$rs = $database->mysqlQuery( 'SELECT @orderid AS orderid' );
		while($row = mysqli_fetch_array($rs))
		{
		//$s= $row['billnumber'];
		$_SESSION['order_id']=$row['orderid'];
		}
			
			$returnmsg="";
		   
	  } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		   $content = date("l F  d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo  $returnmsg;exit();
	  }
	if($sq)
	{
		echo $s=0;
		
	}else
	{
		echo $s=1;
	}
}else if($_REQUEST['set']=='unsetonfloorselection')
{
	unset($_SESSION['ajaxtableid']);
        unset($_SESSION['ajaxtablename']);
        
}

else if($_REQUEST['set']=='point_loyalty'){ 
    
    
     $sql_login  =  $database->mysqlQuery("select ly_points from tbl_loyalty_reg where  ly_id='".$_REQUEST['pointid']."' and ly_status='Active' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      echo $result_login['ly_points'];
                      
                  }
                  }
}else if($_REQUEST['set']=='search_loyal_id'){ 
    
    
   $name1='';
   $id_loy=$_REQUEST['id_loyalty'];
   
  $ct=$_REQUEST['count'];
    $sql_login  =  $database->mysqlQuery("select  ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where ly_id='".$id_loy."' and ly_status='Active' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $id= $result_login['ly_id'];
                              $name1= $result_login['ly_firstname']. $result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                             ?>

                                                             <ul>
                                                                 <li class="nav" id="load_name_ul" onclick="return id_click('<?=$name1?>','<?=$id?>','<?=$num?>','<?=$ct?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                                                                                                <?=$id?>    
                                                                                                </li>
                                                                                            </ul>
<?php
				  
				 
				  
			
                      
                  }
                  }
   
	
}
else if($_REQUEST['set']=='searchname'){ 
    
    
   $name1='';
   $name=$_REQUEST['name'];
   $ct=$_REQUEST['count'];
   if(strlen($_REQUEST['name'])>2){
    $sql_login  =  $database->mysqlQuery("select  ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where  (ly_firstname LIKE '%".$name."%' or ly_lastname LIKE '%".$name."%') and ly_status='Active' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $id= $result_login['ly_id'];
                              $name1= $result_login['ly_firstname'].' '.$result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                             ?>

                                                             <ul>
                                                                 <li id="load_name_ul" onclick="return name_click('<?=$name1?>','<?=$id?>','<?=$num?>','<?=$ct?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                                                                                                <?=$name1?>    
                                                                                                </li>
                                                                                            </ul>
<?php
				  
				 
				  
			
                      
                  }
                  }
   }
	
}else if($_REQUEST['set']=='searchnumber'){ 
    
    
   $num1='';
   $num=$_REQUEST['number'];
   $ct=$_REQUEST['count'];
   if(strlen($_REQUEST['number'])>2){
    $sql_login  =  $database->mysqlQuery("select  ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where ly_mobileno LIKE '%".$num."%' and ly_status='Active'  "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                 $id= $result_login['ly_id'];
                                 $name1= $result_login['ly_firstname']. $result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                             ?>

                                                             <ul>
                                                                 <li id="load_number_ul" onclick="return number_click('<?=$name1?>','<?=$id?>','<?=$num?>','<?=$ct?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                                                                                                <?=$num?>    
                                                                                                </li>
                                                                                            </ul>
<?php
				  
				 
				  
			
                      
                  }
                  }
   }
	
}
else if($_REQUEST['set']=='load_order_count'){ 
    
    
    if(isset($_REQUEST['floor_id']) && $_REQUEST['floor_id']!=''){
        
      $floor_chk=$_REQUEST['floor_id'];
    }else{
      $floor_chk=$_SESSION['floorid'];  
    }
    
    
    $total_table=0; $total_table_new=0;
     $sql_table_sel14 = mysqli_query($localhost,"SELECT count(tr_tableid) as tbl_ct from tbl_tablemaster where tr_floorid='".$floor_chk."' and tr_status='Active'  ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                                while ($result_table_sel143= $database->mysqlFetchArray($sql_table_sel14)) {
                                    
                                    $total_table=$result_table_sel143['tbl_ct'];
                                }
                                }
    
              $served_count=0;
                $added_count=0; $open_count=0; $billed_count=0;
                $sql_table_sel14 = mysqli_query($localhost,"SELECT count(ts_status) as ct_sts ,ts_status  from tbl_tabledetails where ts_floorid='".$floor_chk."' group by ts_status  ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                                while ($result_table_sel14 = $database->mysqlFetchArray($sql_table_sel14)) {
                                    
                                    
                                    if($result_table_sel14['ts_status']=='Served'){
                                     $served_count=$result_table_sel14['ct_sts'];
                                    }
                                    if($result_table_sel14['ts_status']=='Added'){
                                     $added_count=$result_table_sel14['ct_sts'];
                                    }
                                    
                                    if($result_table_sel14['ts_status']=='Opened'){
                                     $open_count=$result_table_sel14['ct_sts'];
                                    } 
                                    if($result_table_sel14['ts_status']=='Billed'){
                                     $billed_count=$result_table_sel14['ct_sts'];
                                    } 
                                    
                                    
                  } }  
                  
                  
                  
                  $sum_table=$billed_count+$open_count+$added_count+$served_count;
                  
                  $total_table_new=($total_table-$sum_table);
                    
                ?>
                        
                        
                        <div style="width: 18%;" class="vacant"><div class="vacant_color" style="text-align: center"><?=$added_count?></div> <?= $_SESSION['table_selection_ordered'] ?>  </div><!--vacant-->
                        <div style="width: 22%;" class="vacant"><div class="occu_color" style="text-align: center"><?=$open_count?></div> Pending  </div><!--vacant-->.
                        <div class="vacant"><div class="complt_color" style="text-align: center"><?=$served_count?></div> <?= $_SESSION['table_selection_completed'] ?>  </div>
                         <div style="width: 15%;" class="vacant"><div style="background:#03a4e2;text-align: center" class="complt_color"><?=$billed_count?></div><?=$_SESSION['table_selection_billed']?></div>
                         <div style="width: 15%;" class="vacant"><div style="background:lightcyan;text-align: center;color:black" class="complt_color"><?=$total_table_new?></div>VACCANT</div>
                        <!--<div style="width: 18%;" class="vacant"><div style="background:rgb(255, 161, 24)" class="complt_color"></div><?= $_SESSION['table_selection_reserved'] ?>  </div>-->
  <?php  
}

else if($_REQUEST['set']=='summary'){ 
    
 ?>

 <script src="js/load_tabl_sum.js"></script>

<?php

                            $sql_table_sel1 = $database->mysqlQuery("select be_count_on from tbl_branchmaster");
                            $num_table1 = $database->mysqlNumRows($sql_table_sel1);
                            if ($num_table1) {
                                while ($result_table_sel1 = $database->mysqlFetchArray($sql_table_sel1)) {
                                   $counton= $result_table_sel1['be_count_on'];
                                    
                                }
                            }


	if(($_REQUEST['tab']!=""))
	{
	   $_SESSION['floorid']=$_REQUEST['tab'];
	}                       
                            $stfname = "";
                            $database->mysqlQuery("SET @floor='".$_SESSION['floorid']."'");
                            
                            $sql_table_sel=$database->mysqlQuery("CALL proc_table_list(@floor)") or $database->throw_ex(mysqli_error($database->DatabaseLink)); 
                            $num_table = $database->mysqlNumRows($sql_table_sel);
                            if ($num_table) {
                                    while ($result_table_sel = $database->mysqlFetchArray($sql_table_sel)) {
                                          
                                        
                                        $table_vacantcount=0;
                                              
                                            $table_name = '';
                                            $table_id = '';
                                            $table_vacantcount ='';
                                            $table_nextprefix = '';
                                            $total_amount =  0;
                                            $persons_count = 0;
                                            $table_prefix= 0;
                                            $status='';
                                            $stfname1 ='';
                                            $stfname2='';
                                             
                                            $in_access=''; 
                                            $bill_number='';   
                                            $dinetime='';
                                           
                                                
                                            $reserved = 0;
                                            $billed = 0;
                                            $pending = 0;
                                            $opened = 0;
                                            $added = 0;
                                            
 if ($status[0] == "Reserved") {
     
                                                $reserved++;
                                                $stfname = "";
                                                $reserve_time = $result_table_sel['reservetime'];
                                               
                                                ?>
                                                <li class="buttons <?php if ($in_access[0] == 'Y') { ?> clickdiableinuse <?php } ?>">
                                                    <a class='buttons_tab_active_3 none_shadow selectstafforedit  <?php if ($in_access[0] == 'Y') { ?> notifydisable <?php } ?> <?php if(in_array($table_id,$_SESSION['ajaxtableid'])){ ?> table_select  <?php } ?>'  ordrd="my_<?= $result_table_sel['orderno'] ?>"  title='Title 2' stvid="stf_<?= $stfname ?>">
                                                        <div class="table_chair_count new_table_chair"><?= $persons_count ?></div>	
                                                       
                                                        <input name="" class="table_edt_change table_edt_change_active" value="<?=$_SESSION['table_selection_button_add']?>" type="submit">
                                                        <div class="table_order_main">
                                                            <strong class="table_name_active"><?= $table_name . " (" . $result_table_sel['table_prefix'] . ")"?></strong>
                                                            <!--<span class="font_order time_reserved"><?//date("h:i:s",strtotime($result_table_sel1['ts_dineintime'])) //$kotid?></span-->
                                                            <span class="reserved_new"><?= $stfname ?> <?=$_SESSION['table_selection_reserved']?></span>
                                                            <div class="reserved_time "><?= date("h:i A", strtotime($reserve_time)) //$kotid ?></div><!--reserved_over-->

                                                        </div>
                    <?php if ($in_access[0] == 'Y') { ?>
                                                            <span class="notify_inuse "></span>
                                                           
                    <?php } ?>
                                                </a>
                                                    <div class="reserved_close cancelreservation" ordrd="my_<?= $result_table_sel['orderno'] ?>"><img src="img/cancel-icon.png"></div>
                                                </li>
                    <?php } 
                                            
                                          
                   if($result_table_sel['orderno']!='') {
                  
                                            $table_vacantcount=0;
                                            $persons_count1=0;  
                                            $order_from= explode(',',$result_table_sel[20]);
                                            $addon_total=0;
                                            if($order_from[0]=="W"){
                                                  $orderby="P";
                                            }else if($order_from[0]=="A"){
                                                 $orderby="S" ;
                                            }else if($order_from[0]=="E"){
                                                 $orderby="E";   
                                            }
                                                  
                                            
                                            $table_name = explode(',',$result_table_sel[1]);
                                            $table_id = explode(',',$result_table_sel[0]);
                                            $table_vacantcount =explode(',', $result_table_sel[7]);
                                            $table_nextprefix = $result_table_sel[4];
                                            $total_amount =  explode(',',$result_table_sel[14]);
                                            $persons_count = explode(',',$result_table_sel[15]);
                                            $table_prefix= explode(',',$result_table_sel[2]);
                                            $status=explode(',',$result_table_sel[3]);
                                            $stfname1 =explode(',',$result_table_sel[10]);
                                            $stfname2=explode(',',$result_table_sel[11]);
                                            //$pp=$pp.",".$result_table_sel['orderno'];
                                            $in_access=explode(',',$result_table_sel[16]); 
                                            $bill_number=explode(',',$result_table_sel[17]);    
                                            $dinetime=explode(',',$result_table_sel[18]);
                                            for($v=0;$v<count($persons_count);$v++){
                                               $persons_count1= ($persons_count1+$persons_count[$v]/count($table_id));
                                            }
                                            
                                            $total_amount[0]=$total_amount[0];
       
                                        
if($status[0] == "Billed") {
      
                    $billed++; $qr_in='';
                                        
                    $sql_billed = mysqli_query($localhost,"SELECT  bm_qr_orderno,bm_billno,bm_billtime, bm_finaltotal FROM tbl_tablebillmaster bm
                    left join tbl_tabledetails td on td.ts_billnumber = bm.bm_billno
                    WHERE bm.bm_dayclosedate='".$_SESSION['date']."' and td.ts_orderno = '" . $result_table_sel['orderno'] . "' ");

                    $result_billed = $database->mysqlFetchArray($sql_billed);
                   
                    if($result_billed['bm_qr_orderno']!=""){
                       $qr_in='[QR]';
                    }
                    
                    
                     if($result_billed['bm_finaltotal']!=""){
                        $tot_bill=number_format($result_billed['bm_finaltotal'],$_SESSION['be_decimal']);
                        
                    }else{
                        
                        $tot_bill="Splitted";
                        $spited_billnos=array();
                        $sql_get_spited_billnos = mysqli_query($localhost,"select distinct(bm.bm_billno) as splited_billnos  FROM tbl_tablebillmaster bm where bm.bm_dayclosedate='".$_SESSION['date']."' and bm.bm_orderno LIKE '%".$result_table_sel['orderno']."%' and bm_status='Billed'");
                        $num_spited_billnos     = mysqli_num_rows($sql_get_spited_billnos);
                        if($num_spited_billnos){
                            while($result_get_spited_billnos = $database->mysqlFetchArray($sql_get_spited_billnos)){
                                $spited_billnos[]=$result_get_spited_billnos['splited_billnos'];
                            }
                        }
                    }
                    
                    ?>
                                                <li class="buttons <?php if ($in_access[0] == 'Y') { ?> testingd <?php } if(count($table_id)>1){?> combine_active <?php } ?>">
                                                    <a id="loader_disable<?=$result_billed['bm_billno']?>" class='buttons_tab_active_4 none_shadow  billedclic  <?php if ($in_access[0] == 'Y') { ?> notifydisable <?php } ?>' billedno="<?php if($tot_bill!='Splitted') { echo $bill_number[0];} else{ echo implode(',',$spited_billnos);} ?>" tot_new="<?=$tot_bill?>" ordrd="my_<?= $result_table_sel['orderno'] ?>"  title='Title 2' stvid="stf_<?= $stfname1[0].' '. $stfname2[0] ?>">
                                                       <div class="loader_to_bill" id="loader_to_bill_id<?=$result_billed['bm_billno']?>" style="display:none">  </div>     
                                                        <div class="table_chair_count new_table_chair"><?= $persons_count1  ?></div>
                                                        <input name="" class="table_edt_change table_edt_change_active" value="<?= $status[0] ?>" type="submit">
                                                        <div class="table_order_main">
                                                            <strong class="table_name_active"> <?php for($z=0;$z<count($table_name);$z++){  if($z>0) { echo '+' ;} echo $table_name[$z]. " (" . $table_prefix[$z] . ")"; } ?></strong>
                                                            <span class=""><?= date("h:i:s", strtotime($result_billed['bm_billtime'])) //$kotid ?></span>
                                                              <span class="new_size_changer"><span class="order-dev"><?=$orderby?></span><?=$stfname1[0].' '.$stfname2[0] ?> <?=$qr_in?></span>
                                                            <div class="table_rate_new"><?= $tot_bill ?></div>
                                                            <div class="billed_in_table"><?= $status[0] ?></div>
                                                        </div>
                    <?php if ($in_access[0] == 'Y') { ?>
                                                            <span class="notify_inuse "></span>
                                                          <!--  <span class="notifydisable"></span>-->
                    <?php } ?>
                                                    </a>
                                                </li>
<?php }
 else if ($status[0] == "Added" ||$status[0]  =="Occupied") { 
     
     
                                            
                            $added++;
                                                             
                            $sql_table_sel13 = mysqli_query($localhost,"select tr_timealloted from tbl_tablemaster where tr_tableid='".$table_id[0]."' ");
                            $num_table13 = $database->mysqlNumRows($sql_table_sel13);
                            if ($num_table13) {
                                while ($result_table_sel13 = $database->mysqlFetchArray($sql_table_sel13)) {
                                   $max_time= $result_table_sel13['tr_timealloted'];
                                    
                                    
                            }
                            }
                                  $i=date("h:i:s");
                                                               $a=date("h:i:s",  strtotime($i));
                                                               $b=date("h:i:s", strtotime($dinetime[0]));
                                                               
                                                                 $tabletime123 = date('h:i:s',strtotime("+".$max_time." minutes", strtotime($dinetime[0])));
                                                                 $dteStart = new DateTime($a); 
                                                                    $dteEnd   = new DateTime($b); 
                                                                $f=$dteStart->diff($dteEnd); 
                                                                 
                                                                      ?>
                                                
                                                
                                                 <?php if($a>$tabletime123 && $counton=="Y"){ $rt="table_time_out"; }  else{$rt="";} ?>
                                                
                                                
                                                <li class="buttons <?php if ($in_access[0] == 'Y') { ?> testingd clickdiableinuse <?php } if(count($table_id)>1){?> combine_active <?php } ?>">
                                                    <a class=' <?=$rt?> buttons_tab_active dbl_click none_shadow selectstafforedit  <?php if ($in_access[0] == 'Y') { ?> notifydisable <?php } ?> <?php if(in_array($table_name[0]. $table_prefix[0],$_SESSION['ajaxtablename'])){ ?> table_select allready <?php } ?> ' ordrd="my_<?= $result_table_sel['orderno'] ?>"  title='Title 2' stvid="stf_<?= $stfname1[0].' '.$stfname2[0] ?>" tableno="<?php  for($z=0;$z<count($table_name);$z++){ echo $table_name[$z]. $table_prefix[$z].',';} ?>">
                                                        <div class="table_chair_count new_table_chair"><?= $persons_count1  ?></div>
                                                    
                                                        <input name="" class="table_edt_change table_edt_change_active" value="<?=$_SESSION['table_selection_button_add']?>" type="submit">
                                                        <div class="table_order_main">
                                                            <strong class="table_name_active"><?php for($z=0;$z<count($table_name);$z++){ if($z>0) { echo '+' ;} echo $table_name[$z]. " (" . $table_prefix[$z] . ")"; } $in_access[0]?></strong>
                                                           
                                                            <span class=""><?php if($counton=="N"){ echo $b; }  else{ print $f->format("%H:%I:%S");}?></span>
                                                            <span class="new_size_changer"><span class="order-dev"><?=$orderby?></span><?=$stfname1[0].' '.$stfname2[0] ?></span>
                                                            <div class="table_rate_new"><?= number_format($total_amount[0],$_SESSION['be_decimal']) ?></div>
                                                        </div>
                    <?php if ($in_access[0] == 'Y') { ?>
                                                            <span class="notify_inuse "></span>
                                                          <!--  <span class="notifydisable"></span>-->
                    <?php } ?>
                                                    </a>
                                                </li>
 <?php } 
 
 else if ($status[0] == "Served") {
     
     
                    $qr_in4='';
                                        
                    $sql_billed4 = mysqli_query($localhost,"SELECT  ter_qr_order FROM tbl_tableorder 
                   
                    WHERE ter_dayclosedate='".$_SESSION['date']."' and ter_orderno = '" . $result_table_sel['orderno'] . "' ");

                    $result_billed4 = $database->mysqlFetchArray($sql_billed4);
                   
                    if($result_billed4['ter_qr_order']!=""){
                       $qr_in4='[QR]';
                    }
                    
                  
                           $serverd++;
                           $new_table_bill='';                 
                            
                            $sql_table_sel12 = mysqli_query($localhost,"select tr_timealloted from tbl_tablemaster where tr_tableid='".$table_id[0]."' ");
                            $num_table12 = $database->mysqlNumRows($sql_table_sel12);
                            if ($num_table12) {
                                while ($result_table_sel12 = $database->mysqlFetchArray($sql_table_sel12)) {
                                   $max_time= $result_table_sel12['tr_timealloted'];
                                    
                                    
                            }
                            }
                                                               $i=date("h:i:s");
                                                               $a=date("h:i:s",  strtotime($i));
                                                               $b=date("h:i:s", strtotime($dinetime[0]));
                                                               
                                                                 $tabletime123 = date('h:i:s',strtotime("+".$max_time." minutes", strtotime($dinetime[0])));
                                                                 $dteStart = new DateTime($a); 
                                                                 $dteEnd   = new DateTime($b); 
                                                                 $f=$dteStart->diff($dteEnd); 
                                                               
                                                                      ?>               
                                                 
                                                <?php if($a>$tabletime123 && $counton=="Y"){ $rt="table_time_out"; }  else{$rt="";} ?>
                                                
                                                
                                                <li class=" buttons <?php if ($in_access[0] == 'Y') { ?> testingd clickdiableinuse <?php } if(count($table_id)>1){?> combine_active <?php } ?>">
                                                   
                                                    <a class=' <?=$rt?> buttons_tab_active_2 dbl_click none_shadow selectstafforedit print_bill_from_table    <?php if ($in_access[0] == 'Y') { ?> notifydisable <?php } ?> <?php  if(in_array($table_name[0]. $table_prefix[0],$_SESSION['ajaxtablename'])){ ?> table_select allready <?php }  ?>'  ordrd="my_<?= $result_table_sel['orderno'] ?>" title='Title_<?php for($z=0;$z<count($table_id);$z++){ echo $table_id[$z]."'"; } ?>' stvid="stf_<?= $stfname1[0].' '.$stfname2[0] ?>" floor="<?=$_SESSION['floorid']?>" tableno="<?php  for($z=0;$z<count($table_name);$z++){ echo $table_name[$z]. $table_prefix[$z].',';} ?>"  >
                                                      
                                                        <div style="right:35px"   class="table_chair_count new_table_chair"><?= $persons_count1  ?></div>
                                                      
                                                        <input style="display:none" name="" class="table_edt_change table_edt_change_active" value="<?=$_SESSION['table_selection_button_add']?>" type="submit">
                                                       
                                                        
                                                       <?php for($z=0;$z<count($table_name);$z++){ if($z>0) { $new_table_bill.= ',' ;} $new_table_bill.= $table_name[$z]. "(" . $table_prefix[$z] . "),"; } 
                                                       
                                                       $new_order_bill=$result_table_sel['orderno'].',';
                                                       
                                                       ?>
                                                        
                                                       <span  onclick="print_one_click('<?=str_replace(',,',',',$new_order_bill)?>','<?=str_replace(',,',',',$new_table_bill)?>');" style="display:block; <?php if ($qr_in4!='') { ?> opacity: 0.8;pointer-events:auto <?php } ?>" name="" class="table_edt_change4 table_edt_change_active"></span>
                                                       
                                                       <span onclick="view_one_click('<?=str_replace(',,',',',$new_order_bill)?>','<?=str_replace(',,',',',$new_table_bill)?>');" style="display:block; <?php if ($qr_in4!='') { ?> opacity: 0.8;pointer-events:auto <?php } ?>" name="" class="table_edt_change5 table_edt_change_active"></span>
                                                       
                                                        
                                                        <div class="table_order_main">
                                                            
                                                            <strong class="table_name_active"><?php for($z=0;$z<count($table_name);$z++){if($z>0) { echo '+' ;} echo $table_name[$z]. " (" . $table_prefix[$z] . ")"; } ?></strong>
                                                         
                                                              
                                                            <span class=""><?php if($counton=="N"){ echo $b; }  else{ print $f->format("%H:%I:%S");}?></span>
                                                       
                                                            <span class="new_size_changer" ><span class="order-dev"><?=$orderby?></span><?=substr($stfname1[0].' '.$stfname2[0],0,13 )?> <?=$qr_in4?></span>
                                                            
                                                             <?php $combine_check='N'; for($z=0;$z<count($table_name);$z++){if($z>0) { $combine_check='Y'; ?>
                                                                
                                                             <?php } }
                                                              
                                                              if($combine_check=='Y'){
                                                              
                                                              ?>  
                                                            
                                                               <span style="float:right;width:20%;height: 10px;margin-top: 2px;margin-right: 23%"><img  style="width:20px" src="img/combine_add.png"></span>
                                                              
                                                             <?php }  ?>  
                                                            
                                                            
                                                               
                                                               
                                                               
                                                               
                                           <?php
                                           
                                           $total_di=$total_amount[0];
                                                   
                                           
                                           if($_SESSION['uae_tax_enable']=='Y'){
                          
                         
                                               $total_di=$total_di/(1+($_SESSION['uae_tax_value']/100));
                                            }   
                     $total2=0;                      

                      $sql_table_sel13 = mysqli_query($localhost,"SELECT  ter_menuid,ter_total_rate FROM tbl_tableorder 
                       WHERE ter_dayclosedate='".$_SESSION['date']."' and ter_orderno = '".$result_table_sel['orderno']."' limit 100 ");
                            $num_table13 = $database->mysqlNumRows($sql_table_sel13);
                            if ($num_table13) {
                                while ($new_tot_amt1 = $database->mysqlFetchArray($sql_table_sel13)) {
                                      
              $tax_in1 = mysqli_query($localhost,"SELECT amc_value,amc_unit FROM tbl_extra_tax_master te left join tbl_menu_tax_master "
              . " tem on tem.mtm_tax_id=te.amc_id where te.amc_active='Y'  and te.amc_item_tax='Y' "
              . " and tem.mtm_menuid='".$new_tot_amt1['ter_menuid']."'  ");
              
                                          $num_tx1 = $database->mysqlNumRows($tax_in1);
                                          if($num_tx1) {
                                             while ($tx_in1 = $database->mysqlFetchArray($tax_in1)) {
                                                    
                                                    $tax_value1=$tx_in1['amc_value'];
                                                    $tax_unit1=$tx_in1['amc_unit'];
                                                      
                                                    if($tax_unit1=="P"){
                                                       
                                                        $total2=  $total2+($new_tot_amt1['ter_total_rate']*$tax_value1/100);
                                                            
                                                    }else if($tax_unit1=="V"){
                                                      
                                                        $total2=  $total2+$tax_value1;
                                                       
                                                    } 
                                                    
                                          }}
          }}                              
                                            
                                           
      $minus_tot=0;      
    
      $new_tot = mysqli_query($localhost,"SELECT sum(ter_total_rate) as minus_tot FROM tbl_tableorder 
      WHERE ter_dayclosedate='".$_SESSION['date']."' and ter_orderno = '".$result_table_sel['orderno']."'"
    . "  AND ter_menuid IN(SELECT mr_menuid  FROM  tbl_menumaster WHERE mr_excempt_tax ='Y') limit 100 ");
                                          $num_1 = $database->mysqlNumRows($new_tot);
                                           if ($num_1) {
                                            while ($new_tot_amt = $database->mysqlFetchArray($new_tot)) {
                                                    
                                                $minus_tot=$new_tot_amt['minus_tot'];
                                             }
                                           }           
                                            
                                            
                           $new_tot_all=($total_di-$minus_tot);                           
                                           
                 
                            $total1=0;   
                            $tax_in88 = mysqli_query($localhost,"SELECT amc_value,amc_unit FROM tbl_extra_tax_master left join tbl_floor_tax on "
                            . " tbl_floor_tax.ft_tax_id=tbl_extra_tax_master.amc_id where amc_active='Y' "
                            . " and amc_item_tax!='Y'  and ft_floorid='".$_SESSION['floorid']."' ");
                            
                          
                            $num_tx88 = $database->mysqlNumRows($tax_in88);
                            if($num_tx88) {
                                while ($tx_in = $database->mysqlFetchArray($tax_in88)) {
                                    
                                    $tax_value=$tx_in['amc_value'];
                                    $tax_unit=$tx_in['amc_unit'];

                                   
                                    if($tax_unit=="P"){

                                          $total1=  $total1+($new_tot_all*$tax_value/100);

                                    }else if($tax_unit=="V"){
                                        $total1=  $total1+$tax_value;
                                    }


                                 }
                                }
                   
                               
                               
                                
                                            $tax_in1_rf = mysqli_query($localhost,"SELECT be_nearest_roundoff_value FROM tbl_branchmaster ");
                                            $num_tx1_rf = $database->mysqlNumRows($tax_in1_rf);
                                            if ($num_tx1_rf) {
                                                while ($tx_in1_rf = $database->mysqlFetchArray($tax_in1_rf)) {
                                                    
                                                      $rof_ta=$tx_in1_rf['be_nearest_roundoff_value'];
                                                }
                                                }
                                                
                                           
                                                if($rof_ta==0){
                                                    
                                                     $tot_tax_in=($total1+$total2);
                                                     $tot_new_in= ($total_di+$total1+$total2);	
                                                   
                                                }else{
                                                    
                                                    $tot_tax_in=($total1+$total2);
                                                    
                                                    $tot_new_in= ($rof_ta*round(($total_di+$total1+$total2)/$rof_ta));	
                                                    
                                                }
                   
                                                
                                                
                                             if($_SESSION['incl_bill_format']=='Y'){
                                                 
                                                $tot_new_in=$total_amount[0]; 
                                             }
                                                
                                                
                                           ?>
                                                         
                                        <div class="table_rate_new"><?=  number_format($tot_new_in,$_SESSION['be_decimal'])?></div>
                                                            
                                                            
                                        </div>
                                                       
                                        <?php if ($in_access[0] == 'Y') { ?>
                                        <span class="notify_inuse "></span>

                                        <?php } ?>
                                        </a>
                                                 
                         </li>
                         
<?php } 

else if ($status[0] == "Opened" || $status[0] == "Ready") {
    
                          $opened++;
                                                            
                          $sql_table_sel14 = mysqli_query($localhost,"select tr_timealloted from tbl_tablemaster where tr_tableid='".$tableid[0]."' ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                                while ($result_table_sel14 = $database->mysqlFetchArray($sql_table_sel14)) {
                                   $max_time= $result_table_sel14['tr_timealloted'];
                                    
                                    
                                }
                            }
                                  $i=date("h:i:s");
                                                               $a=date("h:i:s",  strtotime($i));
                                                               $b=date("h:i:s", strtotime($dinetime[0]));
                                                               
                                                                 $tabletime123 = date('h:i:s',strtotime("+".$max_time." minutes", strtotime($dinetime[0])));
                                                                 $dteStart = new DateTime($a); 
                                                                 $dteEnd   = new DateTime($b); 
                                                                 $f=$dteStart->diff($dteEnd); 
                                                                 
                                                                      ?> 
                                                
                                                 <?php if($a>$tabletime123 && $counton=="Y"){ $rt="table_time_out"; }  else{$rt="";} ?>
                                                
                                                <li class="buttons <?php if ($in_access[0] == 'Y') { ?> testingd  clickdiableinuse <?php } if(count($table_id)>1){?> combine_active <?php }  ?>">
                                                    <a class=' <?=$rt?> buttons_tab_active_1 none_shadow selectstafforedit  <?php if ($in_access[0] == 'Y') { ?> notifydisable <?php } ?> <?php if(in_array($table_name[0]. $table_prefix[0],$_SESSION['ajaxtablename'])){ ?> table_select allready <?php } ?>' ordrd="my_<?= $result_table_sel['orderno'] ?>" title='Title 2' stvid="stf_<?= $stfname1[0].' '.$stfname2[0] ?>" tableno="<?php  for($z=0;$z<count($table_name);$z++){ echo $table_name[$z]. $table_prefix[$z].',';} ?>">
                                                        <div class="table_chair_count new_table_chair"><?=  $persons_count1 ?></div>
                                                        <input name="" class="table_edt_change table_edt_change_active" value="<?=$_SESSION['table_selection_button_add']?>" type="submit">
                                                        <div class="table_order_main">
                                                            <strong class="table_name_active"><?php for($z=0;$z<count($table_name);$z++){ if($z>0) { echo '+' ;} echo $table_name[$z]. " (" . $table_prefix[$z] . ")"; } ?></strong>
                                                            
                                                            <span class=""><?php if($counton=="N"){ echo $b; }  else{ print $f->format("%H:%I:%S");}?></span>
                                                            <span class="new_size_changer"><span class="order-dev"><?=$orderby?></span><?=$stfname1[0].' '.$stfname2[0] ?></span>
                                                            <div class="table_rate_new"><?= number_format($total_amount[0],$_SESSION['be_decimal'])?></div>
                                                        </div>
               <?php if ($in_access[0] == 'Y') { ?>
                                                        
                   <span class="notify_inuse "></span>
                 
               <?php } ?>
                   
                </a>
                </li>
                       
                <?php } 
                    
                }
                                                        
                                   
                if ($result_table_sel['orderno']=='') {
                                        
                                           $table_name = explode(',',$result_table_sel[1]);
                                           $table_id = explode(',',$result_table_sel[0]);
                                           $table_vacantcount = explode(',',$result_table_sel[6]);
                                           $table_nextprefix = explode(',',$result_table_sel[4]);
                                           $total_amount = explode(',',$result_table_sel[14]);
                                           $persons_count = explode(',',$result_table_sel[15]);
                                           $table_prefix= explode(',',$result_table_sel[2]);
                                           
                                           for($i=0;$i<count($table_id);$i++){
                                              
              ?>
                
             <li class="buttons">
                 
                 <a <?php if($table_name[$i]=='PARCEL') { ?>  style="font-weight: bold ;" <?php } ?>  class="dbl_click line_higt_table_summ <?php if(in_array($table_name[$i]. $table_prefix[$i],$_SESSION['ajaxtablename'])){ ?> table_select  <?php } ?> "  person_dbl="<?=$table_vacantcount[$i]?>"  title='Title_<?= $table_id[$i] ?>' asval="as_<?= chr($table_nextprefix[$i]) ?>" vcct="vc_<?= $table_vacantcount[$i] ?>" tabnam="tb_<?= $table_name[$i] . " (" . chr($table_nextprefix[$i]) . ")" ?>" tableno="<?=$table_name[$i]. $table_prefix[$i]?>"><div class="table_chair_count" ><?= $table_vacantcount[$i];  ?></div>
           
            <?= $table_name[$i] . " (" .$table_prefix[$i]. ")" ?>
                
            </a>
            </li>
            
            <?php } } } } ?>
                        
<!--    //////table selection ends/////////-->


<?php }else if($_REQUEST['set']=='category'){ ?>


        <script src="js/load_subcat_menu.js"></script>

        <?php
        
 	$_SESSION['sel_cat_id']=$_REQUEST['catid'];
        
	$sql_sub =  $database->mysqlQuery("select distinct(mr_subcatid) as subid,msy_subcategoryname from tbl_menumaster"
                 . " left join tbl_menusubcategory msc on msc.msy_subcategoryid=mr_subcatid  where ( (msc.msy_active='Y' && "
                 . " tbl_menumaster.mr_subcatid!='') ||  (tbl_menumaster.mr_subcatid is null))  and mr_maincatid='".$_SESSION['sel_cat_id']."'"
                 . " order by msc.msy_sub_displayorder");
      
        
	$num_sub  = $database->mysqlNumRows($sql_sub);
     
        
        ?>
            
        <?php 
        
	if($num_sub){$k=0; $k++; ?>

<li class="category-menu category-menu-active"  id="allsubcat_new_all" title="subid_all">
    <a <?php if($k==1){ ?> style="border-radius: 0px;padding-left: 5px;padding-right: 5px " class=""   <?php } ?> ><?= $_SESSION['menu_order_all_menulist'] ?></a></li>

 <?php
		
            while($result_subcat  = $database->mysqlFetchArray($sql_sub)) 
			{  
                   
                 
                     $sub_catname=$result_subcat['msy_subcategoryname'];
                     $sub_catid=$result_subcat['subid'];
                                    
                    if($_SESSION['main_language']!='english'){

                                                $sql_arabsubcat=$database->mysqlQuery("SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$_SESSION['main_language']."'");

                                               
                                                $num_arabsubcat = $database->mysqlNumRows($sql_arabsubcat);
                                                $result_arabsubcat = $database->mysqlFetchArray($sql_arabsubcat);
                                                $sub_catname=$result_arabsubcat['mm_name'];
                                                
                                               
                                                }
 if($sub_catid!=""){
				
		$menusub=$database->show_subcategory_ful_details($sub_catid);
		if ($sub_catid != "") {
				
                ?>  
         <li class="category-menu " id="subcat_new_<?=$sub_catid?>" title="subid_<?=$sub_catid?>"><a style="" ><?=$sub_catname?></a></li>
                
  <?php } } } } ?>
                
                
<?php }else if($_REQUEST['set']=='subcategory'){ 
    
    
    
if(($_REQUEST['subid'])!="")
{
	$_SESSION['sel_sub_id']=$_REQUEST['subid'];
}else
{
	$_SESSION['sel_sub_id']="all";
	

}
$curdate=date("Y-m-d");
if($_SESSION['sel_sub_id']=="")
			{
				  
			$sql_menulist= "select * from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid "
                        . " left join tbl_menusubcategory msc on msc.msy_subcategoryid=mr.mr_subcatid  LEFT JOIN tbl_menustock ON "
                        . " tbl_menustock.mk_menuid=mr.mr_menuid WHERE mr.mr_stock_in_out='Y' and mc.mmy_active='Y' and mr.mr_active='Y'  and ( (msc.msy_active='Y' &&"
                        . " mr.mr_subcatid!='') ||  (mr.mr_subcatid is null) ) and  mr.mr_maincatid='".$_SESSION['sel_cat_id']."' and "
                        . " tbl_menustock.`mk_stock`='Y' and tbl_menustock.mk_date='".$_SESSION['date']."' and mr.mr_subcatid IS NULL "
                        . " GROUP BY mr.mr_menuid order by mr_menuname ASC ";
				   
			}else
			{
				 
				  if($_SESSION['sel_sub_id']=="all")
					  { 
                                
                                        $sql_menulist= " select * from tbl_menumaster as mr 
                                        LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid 
                                        left join tbl_menusubcategory msc on msc.msy_subcategoryid=mr.mr_subcatid 
                                        LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=mr.mr_menuid	WHERE mr.mr_stock_in_out='Y' and mc.mmy_active='Y' and mr.mr_active='Y' 
                                        and ( (msc.msy_active='Y' && mr.mr_subcatid!='') ||  (mr.mr_subcatid is null) ) and
                                        mr.mr_maincatid='".$_SESSION['sel_cat_id']."'  and tbl_menustock.mk_date='".$_SESSION['date']."'"
                                        . " GROUP BY mr.mr_menuid  order by mr_menuname ASC  ";//and tbl_menustock.`mk_stock`='Y'
					
                                          }else 
					  {
						
                                              $sql_menulist= "select * from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON "
                                                      . " mr.mr_maincatid=mc.mmy_maincategoryid left join tbl_menusubcategory msc on "
                                                      . " msc.msy_subcategoryid=mr.mr_subcatid LEFT JOIN tbl_menustock ON "
                                                      . " tbl_menustock.mk_menuid=mr.mr_menuid WHERE mr.mr_stock_in_out='Y' and mc.mmy_active='Y' and mr.mr_active='Y' "
                                                      . " and (msc.msy_active='Y' OR mr_subcatid is NULL) and  "
                                                      . " mr.mr_maincatid='".$_SESSION['sel_cat_id']."' and mr.mr_subcatid='".$_SESSION['sel_sub_id']."' "
                                                      . " and tbl_menustock.mk_date='".$_SESSION['date']."' GROUP BY mr.mr_menuid "
                                                      . " order by mr_menuname ASC ";//and tbl_menustock.`mk_stock`='Y'
					  
                                              
                                          }
			}
			
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{
                                           $menu_name = $result_menus['mr_menuname'];
                                           $menu_id = $result_menus['mr_menuid'];
                                           //$menu_stock = $result_menus['mk_stock'];
                                           $menu_type_click= $result_menus['mr_unit_type']; 
                                           $menu_desc=$result_menus['mr_description'];
                                            $stock_in_no=$result_menus['mr_stock_inventory']; 
                                           
					if($_SESSION['main_language']!='english'){

                                        $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

                                        //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                        $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                        $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                        $menu_name=$result_arabmenu['lm_menu_name'];
                                        // $catid['name'][] = $catname;
                                        //echo $catname;
                                        }		
                                            
                                            
                                                        
                                                if($_SESSION['s_listimage']=="Y") // image show permission
							{
								$sql_img="SELECT * FROM tbl_menuimages where mes_menuid='".$result_menus['mr_menuid']."' limit 0,1"; 
								$sql_imgs  =  $database->mysqlQuery($sql_img); 
								$num_imgs  = $database->mysqlNumRows($sql_imgs);
								if($num_imgs){
									while($result_imgs  = $database->mysqlFetchArray($sql_imgs)) 
										{
											$img=$result_imgs['mes_imagethumb'];
										}
								}else
								{
									$img="uploads/default_photo.jpg";
								}
							}
				$portn="N";			
				$sql_menuportion="select * from tbl_menuratemaster where  mmr_menuid='".$result_menus['mr_menuid']."' and  mmr_floorid='".$_SESSION['floorid']."' AND (mmr_rate<>'0' OR mmr_rate IS NOT NULL)";
				 $sql_portions  =  $database->mysqlQuery($sql_menuportion); 
				  $num_portions  = $database->mysqlNumRows($sql_portions);
				  if($num_portions){
					$portn="Y";  
				  }
                                  
                                  
                                            $portnstock = "N";
                                            $sql_menuportion1 = "SELECT * from tbl_menustock  where mk_menuid='$menu_id' AND mk_stock = 'Y'";
                                            $sql_portions1 = $database->mysqlQuery($sql_menuportion1);
                                            $num_portions1 = $database->mysqlNumRows($sql_portions1);
                                            if ($num_portions1) {
                                                $portnstock = "Y";
                                                //$catid['portion']='Y';
                                            } 
                                  
                                  
                                           $portn_click = "yes";
                                           $sql_menuportion12 = "SELECT mmr_portion from tbl_menuratemaster  where mmr_menuid='$menu_id' and mmr_floorid='".$_SESSION['floorid_ser']."' ";
                                            $sql_portions12 = $database->mysqlQuery($sql_menuportion12);
                                            $num_portions12 = $database->mysqlNumRows($sql_portions12);
                                            if ($num_portions12>1) {
                                                
                                                $portn_click = "no";
                                                
                                            }    
                                            
                                      
                                           $dyno_rate = "";
                                           $sql_menuportion127 = "SELECT mr_manualrateentry from tbl_menumaster where mr_menuid='$menu_id' ";
                                            $sql_portions127 = $database->mysqlQuery($sql_menuportion127);
                                            $num_portions127 = $database->mysqlNumRows($sql_portions127);
                                            if ($num_portions127) {
                                                while ($result_imgs = $database->mysqlFetchArray($sql_portions127)) {
                                                       
                                                    if($result_imgs['mr_manualrateentry']=='Y'){
                                                    $dyno_rate = "yes";
                                                    }else{
                                                         $dyno_rate = 'no';
                                                    }
                                                    
                                            }
                                            }          
                                            
                                  
	if($portn=="Y"){  
	?>
				
                <a typ_pop="<?=$menu_type_click?>" style="position: relative; <?php if($_SESSION['s_listimage'] == "Y"){ ?> height: auto; <?php } ?> " <?php if($dyno_rate !='yes' && $_SESSION['be_single_click_add']=='Y'  &&  $menu_type_click !='Packet' && $menu_type_click !='Loose' && $portn_click=='yes') { ?> onclick="single_cart('<?=$menu_id?>','<?=$_SESSION['floorid_ser']?>','<?=$stock_in_no?>')" <?php } ?> data-modal="menuname_<?=$menu_id ?>" class="tab_edt_btn <?php if($menu_type_click =='Packet' || $_SESSION['be_single_click_add']=='N'  || $menu_type_click =='Loose' || $portn_click =='no' || $dyno_rate =='yes'){ ?> md-trigger1 <?php } if($portnstock=="N"){ ?> notinstock <?php } ?> <?php if($_SESSION['s_listimage']=="N"){ ?> <?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> noimagename <?php }else{ ?> menu_sub_item1  clear_color_<?=$menu_id?> <?php } ?> <?php } ?> <?php if($portn=="N"){ ?> noportionalert <?php } ?>" href="#" title="menu_<?=$menu_id?>" <?php if($_SESSION['s_listimage']=="N"){ ?> style="height:auto !important;" <?php } ?> >
               
                    <div title="<?=$menu_desc?>"  class="<?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> product_item <?php }else{ ?>  <?php } ?> product_img" <?php if($_SESSION['s_listimage']=="N"){ ?> style="height:100% !important;" <?php } ?> >
               	
                
                <div class="product_text" <?php if( $_SESSION['menu_theme']=='Theme_2'){ ?> style="width:auto" <?php } ?> >
                    
             	<div class="perspective" <?php if( $_SESSION['menu_theme']=='Theme_2'){ ?> style="width:auto" <?php } ?> >
                                    
                       <?php if($_SESSION['s_listimage']=="Y"){  ?>
                    
              <div class="product_img"><img src="<?= $img ?>"  /></div>
              
                 <?php } ?>           
                    
                    
                    
			<?php if($_SESSION['s_listimage']=="N"){ ?>
                    
			    <button <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="height: auto !important;" <?php } ?> <?php if( $_SESSION['menu_theme']=='Theme_2'){ ?>   style="" <?php } ?> class="<?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> btn btn-8 btn-8g <?php }else{ ?> menu_sub_item1 menu_1 clear_color_<?=$menu_id?> <?php } ?>"> <?php if ($_SESSION['be_rate_on_button'] =='Y') { ?> <p style="height: 24px;margin-bottom: 0px;overflow: hidden;margin-top: 0px;line-height: 1.2;"> <?=$menu_name?> </p> <?php } else{ ?> <p <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="margin-top: 52px" <?php } ?> ><?=$menu_name?> </p>  <?php } ?>
                                
                                 <?php if ($portnstock == "N") { ?>    
                                 </br> <span  style="color:red" >NO STOCK</span>
                                 <?php } ?>
                                
                            <!--</button>-->
                    
                            <?php }else { ?>
                    
                            <button <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="height: auto !important;" <?php } ?> <?php if( $_SESSION['menu_theme']=='Theme_2'){ ?>   style="" <?php } ?> class="<?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> btn btn-8 btn-8g <?php }else{ ?> menu_sub_item1 menu_1 clear_color_<?=$menu_id?> <?php } ?>"> <?php if ($_SESSION['be_rate_on_button'] =='Y') { ?> <p style="height: auto;margin-bottom: 0px;overflow: hidden;line-height: 1.2;"> <?=$menu_name?></p> <?php } else{ ?>  <p <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="margin-top: 0px" <?php } ?> ><?=$menu_name?> </p> <?php } ?>
                            
                               <?php if ($portnstock == "N") { ?>    
                               </br> <span  style="color:red" >NO STOCK</span>
                               <?php } ?>
                            
                            </button>
                    
                            <?php } ?>
                                    
                    
               
              
                
                           <?php  $rtr=''; $rater=''; 
                           $sql_menuportion127 = "SELECT * from tbl_menuratemaster mc left join tbl_portionmaster pm on pm.pm_id=mc.mmr_portion left join tbl_base_unit_master tbu on tbu.bu_id=mc.mmr_base_unit_id left join tbl_unit_master tu on tu.u_id=mc.mmr_unit_id where mc.mmr_menuid='$menu_id' and mc.mmr_floorid='".$_SESSION['floorid']."' ";
                                            $sql_portions127 = $database->mysqlQuery($sql_menuportion127);
                                            $num_portions127 = $database->mysqlNumRows($sql_portions127);
                                            if ($num_portions127) { 
                                                while ($result_imgs = $database->mysqlFetchArray($sql_portions127)) {
                                                   
                                             $rtr.= $result_imgs['u_name'].' '.$result_imgs['bu_name'].$result_imgs['pm_portionshortcode'].' : '.$result_imgs['mmr_rate'].'|'; 
                                  
                           } } 
                           
                           
                     $rater= explode('|', $rtr) ;
                           
                        
                      ?>  
                           
                               
                      <?php if ($portnstock=="Y" && $_SESSION['be_rate_on_button'] =='Y') { ?>  
              
                     <span class="item_price" style="<?php if($_SESSION['s_listimage']=="Y"){ ?>position:absolute;top:130px;padding:5px 0;background-color:#000000b8;left:0;color:#fff;min-height: 32px;<?php }else{ ?> margin-top:0px;  <?php } ?>"> <?=$rater[0].$rater[1]?> <?=$rater[2].$rater[3]?></span>
           
                    <?php } ?>          
                                    
			</div>
                                                 
                     </div>   
             </div></a>
              
   <?php  }}} ?>  
<script src="js/load_popup_fns.js"></script>

<?php } 

 else if($_REQUEST['set']=='setmykot'){ 
     
     
 	$_SESSION['mykot']=$_REQUEST['kot'];
	if(isset($_REQUEST['sln']))
	{
		if($_REQUEST['sln']!="")
		{
			$sl=explode(",",$_REQUEST['sln']);
			$cc=count($sl);
		}else
		{
			$sl="";
			$cc=0;
		}
	}
	else
	{
		$sl="";
		$cc=0;
	}
	if((!isset($_REQUEST['nosl']) || $_REQUEST['nosl']=='0') && $_REQUEST['kot']!="") 
	{
	 $sql_menuportion="select * from tbl_tableorder as tor LEFT JOIN tbl_menumaster as tmr ON tor.ter_menuid=tmr.mr_menuid LEFT JOIN  tbl_portionmaster as tpr ON tpr.pm_id=tor.ter_portion  where  tor.ter_kotno='".$_REQUEST['kot']."' and tor.ter_dayclosedate='".$_SESSION['date']."'  order by ter_slno";
	 $sql_portions  =  $database->mysqlQuery($sql_menuportion); 
	 $num_portions  = $database->mysqlNumRows($sql_portions);
	?>
    <span class="kot_right_table_head">
        		<table width="100%" border="0" cellspacing="0">
                
                  <tr>
                    <th width="10%"><?= $_SESSION['kot_slno'] ?></th>
                    <th width="40%"><?= $_SESSION['kot_dish_name'] ?></th>
                    <th width="20%">Unit</th>
                    <th width="15%"><?= $_SESSION['kot_qty'] ?></th>
                    <th width="20%">
                    <?php if($cc>0) { ?>
                    <input title="Select All" id="selecctall" class="chekbx" type="checkbox"  <?php if($cc==$num_portions ){ ?> checked="checked" <?php } ?> >
                    <?php } else { ?>
                    <input title="Select All" id="selecctall" class="chekbx" type="checkbox"  >
                    
                    <?php } ?>
                    
                    </th>
                  </tr>
             	</table> 
          	 </span> 
     <span id="boxscrol_right" class="kot_right_table">
     <table width="100%" border="0" cellspacing="0">
         
        <?php 
	$sql_menuserc="select * from tbl_tableorder as tor LEFT JOIN tbl_menumaster as tmr ON tor.ter_menuid=tmr.mr_menuid "
                . "LEFT JOIN  tbl_portionmaster as tpr ON tpr.pm_id=tor.ter_portion  where  tor.ter_kotno='".$_REQUEST['kot']."'"
                . " and tor.ter_dayclosedate='".$_SESSION['date']."' and (tor.ter_status='Opened' or tor.ter_status='Ready')  order by ter_slno";
	 $sql_serc  =  $database->mysqlQuery($sql_menuserc); 
	 $num_serc  = $database->mysqlNumRows($sql_serc);
	  if($num_serc)
	  {
	
	
	 $sql_menuportion="select *,tpr.pm_portionname,tmr.mr_menuname from tbl_tableorder as tor LEFT JOIN tbl_menumaster as tmr ON tor.ter_menuid=tmr.mr_menuid LEFT JOIN  tbl_portionmaster as tpr ON tpr.pm_id=tor.ter_portion left join tbl_unit_master um on um.u_id=tor.ter_unit_id left join tbl_base_unit_master bum on bum.bu_id=tor.ter_base_unit_id  where  tor.ter_kotno='".$_REQUEST['kot']."' and tor.ter_dayclosedate='".$_SESSION['date']."'  order by ter_slno ";
	 $sql_portions  =  $database->mysqlQuery($sql_menuportion); 
	  $num_portions  = $database->mysqlNumRows($sql_portions);
	  if($num_portions){
		  while($result_portions  = $database->mysqlFetchArray($sql_portions)) 
			  { 
			    $kot_portion1=$result_portions['pm_portionname'];
                            $kot_menuid= $result_portions['ter_menuid'];
                            $kot_menu= $result_portions['mr_menuname'];
                             if($result_portions['ter_rate_type']=='Portion'){
                                $kot_portion1='Portion  :'.' '.$result_portions['pm_portionname'];
                            }
                            else if($result_portions['ter_rate_type']=='Unit'){
                                if($result_portions['ter_unit_type']=='Packet'){
                                    $kot_portion1=$result_portions['ter_unit_type'].' : '.number_format($result_portions['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_portions['u_name'];
                                }
                                else if($result_portions['ter_unit_type']=='Loose'){
                                    $kot_portion1=$result_portions['ter_unit_type'].' : '.number_format($result_portions['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_portions['bu_name'];
                                }
                            }
                            if($_SESSION['main_language']!='english'){
                
                            $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$kot_menuid."' and ls_language='".$_SESSION['main_language']."'");

                            //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                            $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                            $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                            $kot_menu=$result_arabmenu['lm_menu_name'];
                            // $catid['name'][] = $catname;
                            //echo $catname;
                            }
                            
                                if($result_portions['ter_preference'])
							{
								$pf=$database->show_prefernce_ful_details($result_portions['ter_preference']);
								$pref=$_SESSION["pmr_".$result_portions['ter_preference']]['preference'];//$pf['pmr_name'];
							}else
							{
								$pref="";
							}
							if($result_portions['ter_preferencetext'])
							{
								if($pref!="")
								{
									$pref=$pref ." , " .$result_portions['ter_preferencetext'];
								}else
								{
									$pref=$result_portions['ter_preferencetext'];
								}
							}else
							{
								
							}

			  ?>
                  <tr class="toserve  <?php if(in_array($result_portions['ter_slno'],$sl)){ ?> tr_color_3 <?php } ?><?php if($result_portions['ter_status']=='Served'){ ?>tr_color_2 <?php } ?><?php if($result_portions['ter_status']=='Ready'){ ?>tr_color_4 <?php } ?>" kot="kot_<?=$_REQUEST['kot']?>" slno="sln_<?=$result_portions['ter_slno']?>" combo_entry="<?=$result_portions['ter_combo_entry_id']?>">
                    <td width="10%"><?=$result_portions['ter_slno'] ?></td>
                    <td width="40%"><?=$kot_menu//$result_portions['mr_menuname'] ?><?php if($pref){ ?>(<?=$pref?>) <?php } ?></td>
                    <td width="20%"><?=$kot_portion1//$result_portions['pm_portionname'] ?></td>
                    <td width="15%"><?=$result_portions['ter_qty'] ?></td>
                    <?php if($result_portions['ter_status']=='Served'){ ?>
                    <td width="20%"></td>
                    <?php } else { ?>
                    <td width="20%"><input class="chekbx checkbox1 sl<?=$result_portions['ter_slno']?>" type="checkbox" <?php if(in_array($result_portions['ter_slno'],$sl)){ ?> checked="checked" <?php } ?> ></td>
                    <?php } ?>
                  </tr>
			  <?php }
	  } }?>
	 </table>
     </span>
     <?php }else { ?>
     <span class="kot_right_table_head">
        		<table width="100%" border="0" cellspacing="0">
                
                  <tr>
                    <th width="10%"><?=$_SESSION['kot_slno']?></th>
                    <th width="40%"><?=$_SESSION['kot_dish_name']?></td>
                    <th width="20%">Unit</th>
                    <th width="15%"><?=$_SESSION['kot_qty']?></th>
                    <th width="20%"><input title="Select All" id="selecctall" class="chekbx" type="checkbox"  ></th>
                  </tr>
             	</table> 
          	 </span>
     
     <?php } ?>
     
     <script src="js/load_kot_auto.js"></script>

	<?php

}

else if($_REQUEST['set']=='setkotserved'){ 
    
	$kt=$_REQUEST['slno'];
        $combo_entry=$_REQUEST['combo_entry'];
	$ct=count($kt);
	for($i=0;$i<$ct;$i++)
	{
		$database->mysqlQuery("update tbl_tableorder set ter_status='Served' where ter_slno='".$kt[$i]."' and  ter_kotno='".$_REQUEST['kot']."'"); 
                $database->mysqlQuery("UPDATE `tbl_combo_ordering_details` SET `cod_order_status`='Served' where `cod_id`='".$combo_entry[$i]."'");
                
        }
}
else if($_REQUEST['set']=='setkotready'){ 
    
	$kt=$_REQUEST['slno'];
        $combo_entry=$_REQUEST['combo_entry'];
	$ct=count($kt);
	for($i=0;$i<$ct;$i++)
	{
		$sql_menulist="select * from tbl_tableorder where ter_slno='".$kt[$i]."' and  ter_kotno='".$_REQUEST['kot']."' and ter_status='Opened' ";
		$sql_menus  =  $database->mysqlQuery($sql_menulist); 
		$num_menus  = $database->mysqlNumRows($sql_menus);
		if($num_menus)
		{
			$database->mysqlQuery("update tbl_tableorder set ter_status='Ready' where ter_slno='".$kt[$i]."' and  ter_kotno='".$_REQUEST['kot']."'"); 
                        $database->mysqlQuery("UPDATE `tbl_combo_ordering_details` SET `cod_order_status`='Ready' where `cod_id`='".$combo_entry[$i]."'");
                        echo "UPDATE `tbl_combo_ordering_details` SET `cod_order_status`='Ready' where `cod_id`='".$combo_entry[$i]."'";
                }
	}
}

else if($_REQUEST['set']=='tableselectionauto')
{
	$_SESSION['ajaxtableid']=$_REQUEST['tableid'];
        $_SESSION['ajaxtablename']=$_REQUEST['tablename'];
        
        print_r($_SESSION['ajaxtablename']);
        
        
     
      
      $date=date("Y-m-d H:i:s");
      
      if($_REQUEST['qr_ord']!=''  &&  $_SESSION['staff_online_order_permission']=='Y'){
          
           $localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);
          
         $sql_gen =  mysqli_query($localhost1,"update tbl_qr_order_details set tq_bill_printed='Y' ,tq_print_time='$date' , "
         . " tq_printed_by='".$_SESSION['expodine_id']."' where tq_order_no='".$_REQUEST['qr_ord']."' ");
       
      }
        
}else if($_REQUEST['set']=='chekserved')
{ 
    
$sql_menulist="select * from tbl_tableorder as tr LEFT JOIN tbl_menumaster as mr ON tr.ter_menuid=mr.mr_menuid	LEFT JOIN tbl_preferencemaster as pr ON tr.ter_preference=pr.pmr_id	LEFT JOIN tbl_portionmaster as pm ON tr.ter_portion=pm.pm_id  where tr.ter_kotno='".$_REQUEST['kot']."'  and tr.ter_status='Opened' order by ter_slno desc";
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus)
				{
					echo "ok";
				}else
				{
					echo "sorry";
				}

}else if($_REQUEST['set']=='staffatt')
{ 
	
                if($_SESSION['be_staff_sel_mode']=='Drop_Down') { ?> <?= $_SESSION['table_selection_staff'] ?> 
    
<!--                <select style="float:right;width: 86%;padding-left:2%" id="stewardsel" name="stewardsel" class="table_selection_drop">-->
                    
                <?php
                               
			     $sql_staff_sel = $database->mysqlQuery("SELECT dr_designationid,ser_staffid,ser_firstname,ser_lastname"
                             . "  FROM tbl_staffmaster left Join tbl_designationmaster on dr_designationid=ser_designation where"
                             . " ser_employeestatus ='Active' and dr_takeorder='Y' order by ser_firstname asc ");
                            
                            $num_staff = $database->mysqlNumRows($sql_staff_sel);
                            if ($num_staff) {
                            while ($result_staff_sel = $database->mysqlFetchArray($sql_staff_sel)) {
                                            
                                           $staff_name = $result_staff_sel['ser_firstname']."  ".$result_staff_sel['ser_lastname'];
                                           $staff_id = $result_staff_sel['ser_staffid'];
                                           $staff_designation = $result_staff_sel['dr_designationid'];
                                          
                if($_SESSION['main_language']!='english'){
                
                $sql_arabstaff=$database->mysqlQuery("SELECT s_staff_first_name,s_staff_last_name FROM tbl_language_staff left join"
                . " tbl_languages on ls_id=s_lang_id WHERE s_staff_id='".$result_staff_sel['ser_staffid']."' and"
                . " ls_language='".$_SESSION['main_language']."'");
                 $num_arabstaff = $database->mysqlNumRows($sql_arabstaff);
                 if($num_arabstaff){
                    while ($result_arabstaff = $database->mysqlFetchArray($sql_arabstaff)){
                     $staff_name=$result_arabstaff['s_staff_first_name']."  ".$result_arabstaff['s_staff_last_name'];
              
                }}
                
                }
        
		?>
                
		<option  value="<?=$staff_id?>" <?php if($_REQUEST['stafid']==$staff_id){ ?> selected="selected" <?php } ?> ><?=$staff_name?></option>
		
                <?php } } ?>
                
<!--                </select>-->
     
            <?php
            
            }else{ 
                
                echo $_SESSION['be_staff_sel_mode']." Mode";
                
            } 
                       
	
}else if($_REQUEST['set']=='searchname'){ 
 
 	/* *************Search menu name***************  */
  
 	$data = array();
	$name=substr($_REQUEST['term'], 0, 2);
	$ratesplit=explode("-",$_REQUEST['term']);
	$rate=substr($ratesplit[0], 2, 5);
	$st="";
	$qty=$ratesplit[1];
	$pos = strpos($ratesplit[1], ".");
	if ($pos === false) 
	{
		
	}else
	{
		$qtys=explode(".",$ratesplit[1]);
		$qty=$qtys[0];
	}
	
	if($rate)
	{
		$st=" and tbl_menuratemaster.mmr_rate LIKE  '".$rate."%'";
	}
	$date=date("Y-m-d");
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menuratemaster ON  tbl_menumaster.mr_menuid=tbl_menuratemaster.mmr_menuid  LEFT JOIN tbl_portionmaster ON tbl_portionmaster.pm_id=tbl_menuratemaster.mmr_portion  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid WHERE (tbl_menumaster.mr_menuname	 LIKE '".$name."%'  $st) and tbl_menuratemaster.mmr_floorid='".$_SESSION['floorid_ser']."' and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' "); 
	//echo "select * from tbl_menumaster LEFT JOIN tbl_menuratemaster ON  tbl_menumaster.mr_menuid=tbl_menuratemaster.mmr_menuid  LEFT JOIN tbl_portionmaster ON tbl_portionmaster.pm_id=tbl_menuratemaster.mmr_portion  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid WHERE (tbl_menumaster.mr_menuname	 LIKE '".$name."%'  $st) and tbl_menuratemaster.mmr_floorid='".$_SESSION['floorid_ser']."' and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' "; 
         $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$sts='';
				if($result_login['mk_stock']=="N") $sts="####";//"<span style='color:#F00'>*****</span>";
			$data[] = array(
				  'label' => $sts.$result_login['mr_menuname']."-".$result_login['pm_portionname']."-".$result_login['mmr_rate']."*".$qty,
				  'label2' => $result_login['mr_menuname']."-".$result_login['pm_portionname']."-".$result_login['mmr_rate']."*".$qty,
				  'value' => $result_login['mr_menuid'],
				   'id' => $result_login['mr_menuid'],
				   'portion' => $result_login['mmr_portion'],
				   'qty' => $qty
				 
				  
			  );
			}
	  }
	
	echo json_encode($data);
	flush();
 
  }else if($_REQUEST['set']=='stockmenu'){ 
 
 		/* *****************Stock Check menu name******************  */
	  $date=date("Y-m-d");
	  $sql_login  =  $database->mysqlQuery("select * FROM  tbl_menustock Where  mk_menuid='".$_REQUEST['menuname']."' and mk_date='".$_SESSION['date']."' and mk_stock='Y'  "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }

  }else if($_REQUEST['set']=='searchnameonly')
  {
	 
 
 	/* *****************Search menu name*******************  */
  
 	$data = array();
	$name=($_REQUEST['term']);
	$date=date("Y-m-d");
     
	 $sql_login  =  $database->mysqlQuery("select tlm.lm_menu_name,tbl_menumaster.mr_menuname,tbl_menumaster.mr_menuid from tbl_menumaster LEFT JOIN "
                 . "tbl_menuratemaster ON  tbl_menumaster.mr_menuid=tbl_menuratemaster.mmr_menuid  LEFT JOIN tbl_menustock ON "
                 . "tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON "
                 . "tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid left join tbl_menusubcategory as sb on "
                 . "sb.msy_subcategoryid=tbl_menumaster.mr_subcatid left join tbl_language_menu_master tlm  on tlm.lm_menu_id=tbl_menumaster.mr_menuid"
                 . " WHERE (tbl_menumaster.mr_menuname LIKE '".$name."%' or "
                 . "tbl_menumaster.mr_itemcode = '".$name."' or tlm.lm_menu_name like '".$name."%') and tbl_menuratemaster.mmr_floorid='".$_SESSION['floorid']."'  and "
                 . "tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' and tbl_menumaster.mr_stock_in_out='Y' and mc.mmy_active='Y' and "
                 . "( (sb.msy_active='Y' && tbl_menumaster.mr_subcatid!='') ||  (tbl_menumaster.mr_subcatid is null) ) "
                 . " group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
	
         $num_login   = $database->mysqlNumRows($sql_login);
        
	  if($num_login){  
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      
                       $portnstock1 = "N";
                                           $sql_menuportion11 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                            $sql_portions11 = $database->mysqlQuery($sql_menuportion11);
                                            $num_portions11 = $database->mysqlNumRows($sql_portions11);
                                            if ($num_portions11) {
                                                $portnstock1 = "Y";
                                                
                                            } 
                                   
				$sts='';
				if($portnstock1=="N") $sts="####";
				$data[] = array(
					  'label' => $sts.$result_login['mr_menuname'].' '.$result_login['lm_menu_name'],
					  'label2' => $result_login['mr_menuname'],
					  'value' => $result_login['mr_menuid'],
					   'id' => $result_login['mr_menuid']
			     );
			}
	  }
	  
          
	  $sql_login  =  $database->mysqlQuery("select tlm.lm_menu_name,tbl_menumaster.mr_menuname,tbl_menumaster.mr_menuid from tbl_menumaster LEFT JOIN"
                  . " tbl_menuratemaster ON  tbl_menumaster.mr_menuid=tbl_menuratemaster.mmr_menuid  LEFT JOIN tbl_menustock ON "
                  . "tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON "
                  . "tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid left join tbl_menusubcategory as sb on "
                  . "sb.msy_subcategoryid=tbl_menumaster.mr_subcatid  left join tbl_language_menu_master tlm  on tlm.lm_menu_id=tbl_menumaster.mr_menuid"
                  . " WHERE (tbl_menumaster.mr_menuname	 LIKE '%".$name."%'  AND  "
                  . "tbl_menumaster.mr_menuname NOT LIKE '%".$name."' or tbl_menumaster.mr_itemcode = '".$name."' and "
                  . "tbl_menumaster.mr_itemcode not like '%".$name."' or tlm.lm_menu_name like '%".$name."%' and tlm.lm_menu_name not like '%".$name."')"
                  . " and tbl_menuratemaster.mmr_floorid='".$_SESSION['floorid']."'  "
                  . "and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' and tbl_menumaster.mr_stock_in_out='Y' and mc.mmy_active='Y' and "
                  . "( (sb.msy_active='Y' && tbl_menumaster.mr_subcatid!='') ||  (tbl_menumaster.mr_subcatid is null) )  "
                  . "group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                                           $portnstock12 = "N";
                                           $sql_menuportion112 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                            $sql_portions112 = $database->mysqlQuery($sql_menuportion112);
                                            $num_portions112 = $database->mysqlNumRows($sql_portions112);
                                            if ($num_portions112) {
                                                $portnstock12 = "Y";
                                               
                                            } 
                      
                      
				$sts='';
				if($portnstock12=="N") $sts="####";
				if(!in_array_r($sts.$result_login['mr_menuname'], $data))
				{
					  $data[] = array(
							'label' => $sts.$result_login['mr_menuname'].' '.$result_login['lm_menu_name'],
							'label2' => $result_login['mr_menuname'],
							'value' => $result_login['mr_menuid'],
							 'id' => $result_login['mr_menuid']
					   );
				}
			}
	  }
	  
	  $sql_login  =  $database->mysqlQuery("select tlm.lm_menu_name,tbl_menumaster.mr_menuname,tbl_menumaster.mr_menuid from tbl_menumaster LEFT JOIN "
                  . "tbl_menuratemaster ON  tbl_menumaster.mr_menuid=tbl_menuratemaster.mmr_menuid  LEFT JOIN tbl_menustock ON "
                  . "tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON "
                  . "tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid left join tbl_menusubcategory as sb on "
                  . "sb.msy_subcategoryid=tbl_menumaster.mr_subcatid left join tbl_language_menu_master tlm  on tlm.lm_menu_id=tbl_menumaster.mr_menuid "
                  . " WHERE (tbl_menumaster.mr_menuname	 LIKE '%".$name."' or "
                  . "tbl_menumaster.mr_itemcode = '".$name."' or tlm.lm_menu_name like '%".$name."') and tbl_menuratemaster.mmr_floorid='".$_SESSION['floorid']."' "
                  . " and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' and tbl_menumaster.mr_stock_in_out='Y' and mc.mmy_active='Y' and "
                  . "( (sb.msy_active='Y' && tbl_menumaster.mr_subcatid!='') ||  (tbl_menumaster.mr_subcatid is null) ) "
                  . "group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                       $portnstock122 = "N";
                                           $sql_menuportion1122 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                            $sql_portions1122 = $database->mysqlQuery($sql_menuportion1122);
                                            $num_portions1122 = $database->mysqlNumRows($sql_portions1122);
                                            if ($num_portions1122) {
                                                $portnstock122 = "Y";
                                                //$catid['portion']='Y';
                                            }
				$sts='';
				if($portnstock122=="N") $sts="####";//"<span style='color:#F00'>*****</span>";
				if(!in_array_r($sts.$result_login['mr_menuname'], $data))
				{
					  $data[] = array(
							'label'  => $sts.$result_login['mr_menuname'].' '.$result_login['lm_menu_name'],
							'label2' => $result_login['mr_menuname'],
							'value'  => $result_login['mr_menuid'],
							 'id'    => $result_login['mr_menuid']
					   );
				}
			}
	  }
	  
	
	echo json_encode($data);
	flush();
 
    
  }else if($_REQUEST['set']=='searchcode')
  {
	 
 
 	/* *********Search menu code**********************  */
  
 	$data = array();
	$name=($_REQUEST['term']);
	$date=date("Y-m-d");
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menuratemaster ON  tbl_menumaster.mr_menuid=tbl_menuratemaster.mmr_menuid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid WHERE (tbl_menumaster.mr_itemcode	 like '%".$name."%'  ) and tbl_menuratemaster.mmr_floorid='".$_SESSION['floorid']."'  and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' and mc.mmy_active='Y' group by mr_itemcode ORDER BY mr_menuname"); 
	 //echo "select * from tbl_menumaster  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid WHERE (tbl_menumaster.mr_itemcode	 = '".$name."'  )  and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' ORDER BY mr_menuname"; 
         $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$sts='';
				if($result_login['mk_stock']=="N") $sts="####";
				$data[] = array(
					  'label' => $sts.$result_login['mr_menuname'],
					  'label2' => $result_login['mr_menuname'],
					  'value' => $result_login['mr_menuid'],
					   'id' => $result_login['mr_menuid']
			     );
			}
	  }
          
	echo json_encode($data);
	flush();
        
}else if($_REQUEST['set']=='changetable')
  {
	            try {
			$database->mysqlQuery("SET @prev_tableid = " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['fromtable_id']) . "'");
			$database->mysqlQuery("SET @prev_prefix = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['fromtable_pfx']) . "'");
			$database->mysqlQuery("SET @new_tableid = " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['totable_id']) . "'");
			$database->mysqlQuery("SET @new_prefix  = " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['totable_pfx']) . "'");
                        $database->mysqlQuery("SET @new_floor_id  = " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['floor']) . "'");
			$database->mysqlQuery("SET @message = " . "''");
			
			$sq=$database->mysqlQuery("CALL proc_tablechange(@prev_tableid,@prev_prefix,@new_tableid,@new_prefix,@new_floor_id,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
			$rs = $database->mysqlQuery( 'SELECT @message AS message' );
			while($row = mysqli_fetch_array($rs))
			{
			echo $srt= $row['message'];
			}
                        
                        
             $detail="  Change from Id : ".$_REQUEST['fromtable_id']." to Id : ".$_REQUEST['totable_id']."  by ".$_SESSION['expodine_id']." . To Floor: ".$_REQUEST['floor']." ";      
             $c_date=date('Y-m-d');         
             $sql_login  =  $database->mysqlQuery("INSERT INTO `tbl_common_logs_all`(`tcl_date`, `tcl_data`, `tcl_type`) VALUES ('$c_date','$detail','Table_Change')");            
                        
                  
                            
		   
	  }catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		   $content = date("l F  d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo  $returnmsg;exit();
	 }
	  
	  
  }else if($_REQUEST['set']=='fromtable'){ 
 
 	/* *************from table change***********************  */
	?>
        <select class="chnage_table_select" name="fromtable" id="fromtable">
                            	<option>Select</option>
                                
                            <?php
		            $stfname="";
                            $sql_table_sel21 = $database->mysqlQuery("select * from tbl_tablemaster where tr_floorid='" . $_SESSION['floorid'] . "' and  tr_status='Active'  order by tr_displayorder");
                            //echo "select * from tbl_tablemaster where tr_floorid='" . $_SESSION['floorid'] . "' and  tr_status='Active'  order by tr_displayorder";
                           $num_table21 = $database->mysqlNumRows($sql_table_sel21);
                            if ($num_table21) {
                                while ($result_table_sel21 = $database->mysqlFetchArray($sql_table_sel21)) {
                                            
                                           $table_name21 = $result_table_sel21['tr_tableno'];
                                           //echo $table_name21.'<br>';
                                           $table_id21 = $result_table_sel21['tr_tableid'];
                                           $table_vacantcount = $result_table_sel21['tr_vaccantcount'];
                                           $table_nextprefix = $result_table_sel21['tr_nextprefix_ascii'];
                                           
                                           
                if($_SESSION['main_language']!='english'){
                
                $sql_arabtable=$database->mysqlQuery("SELECT t_table_name FROM tbl_language_table_master left join tbl_languages on ls_id=t_lang_id WHERE t_table_id='".$table_id."' and ls_language='".$_SESSION['main_language']."'");
                
                //echo " SELECT l_pref_name FROM tbl_language_preference left join tbl_languages on ls_id=l_lang_id WHERE l_pref_id='".$result_menupref['pmr_id']."' and ls_language='".$dat."'";
                $num_arabtable = $database->mysqlNumRows($sql_arabtable);
                 if($num_arabtable){
                    while ($result_arabtable = $database->mysqlFetchArray($sql_arabtable)){
                $table_name21=$result_arabtable['t_table_name'];
                // $catid['name'][] = $catname;
                //echo $catname;
                }}}
                            $sql_table_sel1 = $database->mysqlQuery("select * from tbl_tabledetails where ts_tableid='" . $table_id21 . "' and ts_status<>'Billed'");
                             //echo "select * from tbl_tabledetails where ts_tableid='" . $resu_table['table_id'][$m] . "' and ts_status<>'Billed'";
                             $num_table1 = $database->mysqlNumRows($sql_table_sel1);
                             if ($num_table1) {
                             while ($result_table_sel1 = $database->mysqlFetchArray($sql_table_sel1)) {
                             //echo $result_table_sel1['ts_tableid'];
                             ?>
                             <option tabid="<?= $table_id21 ?>" prefx="<?= $result_table_sel1['ts_tableidprefix'] ?>"><?=$table_name21 . " (" . $result_table_sel1['ts_tableidprefix'] . ")" ?></option>
                             <?php
                             // }
                             }
                             }
                             }
                             }    ?>
                            </select>
  <?php

  }else if($_REQUEST['set']=='totable'){ 
 
 	/* ************to table change*******************  */
		?>
        <select class="chnage_table_select"  name="totable" id="totable">
                            <option>Select</option>
                            <?php
                            $stfname="";
		             $sql_table_sel21 = $database->mysqlQuery("select * from tbl_tablemaster where tr_floorid='" . $_SESSION['floorid'] . "' and  tr_status='Active'  order by tr_displayorder");
                            //echo "select * from tbl_tablemaster where tr_floorid='" . $_SESSION['floorid'] . "' and  tr_status='Active'  order by tr_displayorder";
                               $num_table21 = $database->mysqlNumRows($sql_table_sel21);
                            if ($num_table21) {
                                while ($result_table_sel21 = $database->mysqlFetchArray($sql_table_sel21)) {
                                            
                                           $table_name21 = $result_table_sel21['tr_tableno'];
                                           $table_status21 = $result_table_sel21['tr_status'];
                                           //echo $table_name21.'<br>';
                                           $table_id21 = $result_table_sel21['tr_tableid'];
                                           $table_vacantcount = $result_table_sel21['tr_vaccantcount'];
                                           $table_nextprefix = $result_table_sel21['tr_nextprefix_ascii'];
                                           
                                           
                if($_SESSION['main_language']!='english'){
                
                $sql_arabtable=$database->mysqlQuery("SELECT t_table_name FROM tbl_language_table_master left join tbl_languages on ls_id=t_lang_id WHERE t_table_id='".$table_id."' and ls_language='".$_SESSION['main_language']."'");
                
                //echo " SELECT l_pref_name FROM tbl_language_preference left join tbl_languages on ls_id=l_lang_id WHERE l_pref_id='".$result_menupref['pmr_id']."' and ls_language='".$dat."'";
                $num_arabtable = $database->mysqlNumRows($sql_arabtable);
                 if($num_arabtable){
                    while ($result_arabtable = $database->mysqlFetchArray($sql_arabtable)){
                $table_name21=$result_arabtable['t_table_name'];
                // $catid['name'][] = $catname;
                //echo $catname;
                }}}
                               
     if($table_vacantcount>0 && $table_status21=='Active'){
      ?>
        <option tabid="<?= $table_id21 ?>" prefx="<?= chr($table_nextprefix) ?>"><?=$table_name21 . " (" . chr($table_nextprefix) . ")" ?></option>
        
    <?php }
}} ?>
        </select>
     
   <?php

  }
  
  else if($_REQUEST['set']=='clearallasigned'){ 
 
 		/* ***********clear Assigned************************  */
	$database->mysqlQuery("update tbl_tabledetails set ts_in_access='N' "); 	

  }
  
 else if(isset($_REQUEST['set_qty'])&& $_REQUEST['set_qty']=="order_qty"){
    
         $qty_sum=0;
         $pax_sum=0;
         $addonqty=0;
         $combo_qty=0;
         $orderno=explode(',',$_REQUEST['all_order_no']);       
                                
                                $orderno11=array();
                                $orderno11=array_unique($orderno);
                                 foreach($orderno11 as $key => $value){
                                  
                                 if($value!=""){
    
                                     
                   $sql_combo_list  =  $database->mysqlQuery("select distinct(cod.cod_count_combo_ordering) as cod_count_combo_ordering, cod.cod_combo_pack_rate, cod.cod_combo_total_rate,cod.cod_combo_qty,  cn.cn_name, cp.cp_pack_name FROM tbl_combo_ordering_details cod 
                                                                        left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                                        left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where cod.cod_orderno='".$value."'  and cod.cod_cancel='N'"); 
		
                   $num_combo_list  = $database->mysqlNumRows($sql_combo_list);
					if($num_combo_list){
						  while($result_combo_list  = $database->mysqlFetchArray($sql_combo_list)) 
							  {   
                                                      $combo_qty=$combo_qty+$result_combo_list['cod_combo_qty'];
                                                      
                                                  }
                                                  }                     
                                     
                  $sql_combo_list1  =  $database->mysqlQuery("select ts_noofpersons from tbl_tabledetails where ts_orderno='".$value."' "); 
              
                   $num_combo_list1  = $database->mysqlNumRows($sql_combo_list1);
					if($num_combo_list1){
						  while($result_combo_list1  = $database->mysqlFetchArray($sql_combo_list1)) 
							  {   
                                                      $pax_sum=$pax_sum+$result_combo_list1['ts_noofpersons'];
                                                      
                                                  }
                                                  }                                              
                                     
     $sql_table = $database->mysqlQuery("select sum(tb.ter_qty) as qty,tbd.ts_noofpersons as person,tb.ter_slno  from  tbl_tableorder tb left join tbl_tabledetails tbd on tbd.ts_orderno=tb.ter_orderno where tb.ter_orderno='".$value."' and tb.ter_qty>0 and tb.ter_count_combo_ordering is NULL group by tb.ter_menuid");
  //  echo "select sum(tb.ter_qty) as qty,tbd.ts_noofpersons as person,tb.ter_slno  from  tbl_tableorder tb left join tbl_tabledetails tbd on tbd.ts_orderno=tb.ter_orderno where tb.ter_orderno='".$value."' and tb.ter_qty>0 and tb.ter_count_combo_ordering is NULL group by tb.ter_menuid";
     
     $num_table1 = $database->mysqlNumRows($sql_table);
                            if ($num_table1) {
                                while ($result_table = $database->mysqlFetchArray($sql_table)) {
                                 
                                    $qty_sum=$qty_sum+$result_table['qty'];
                                    
                                    $slno=$result_table['ter_slno'];
                                    
                                               
                                    
                                      $qty_sum_all=  $qty_sum+$addonqty;
                                  
                                }
                                
                            
                                
                            }
                            
    $qty_sum_all+=$combo_qty;    
                            
                            
                            
     }
     }
     
   echo $qty_sum_all.'*'.$pax_sum;
}
/************** DINE IN COMBOS***************/

else if(isset($_REQUEST['set']) &&$_REQUEST['set']=='load_combos'){
    
 $floor_id=$_REQUEST['floor_id'];
 ?>
   <script src="js/menu_order.js"></script>
   <?php
    $sql_combo_list =  $database->mysqlQuery("  select cn.* from tbl_combo_name cn
                                                left join tbl_combo_pack_rates cpr on cpr.cpr_combo_id=cn.cn_id, tbl_combo_pack_menus cpm 
                                                where cn.cn_active='Y'  and cpr.cpr_mode='DI' and cpr.cpr_floor_id='".$floor_id."'  and cpm.cpm_combo_id=cn.cn_id and cpm.cpm_combo_pack_id = cpr.cpr_combo_pack_id  group by cn.cn_id 
                                                order by cn.cn_name asc "); 
   
    $num_combo_list = $database->mysqlNumRows($sql_combo_list);
    if($num_combo_list){$i=0;
          while ($result_combo_list = $database->mysqlFetchArray($sql_combo_list)) {
              $i++;
?>

     <li ><a combo_name_id="<?=$result_combo_list['cn_id']?>" class="combo_name_selection_click category-menu <?php if($i==1){ ?> /*left_mn_menu_odr_focus */ category-menu-active <?php } ?>" ><?=$result_combo_list['cn_name']?></a></li>
<?php
          }
    }
}
else if(isset($_REQUEST['set']) &&$_REQUEST['set']=='load_combo_menus'){
    
    $combo_name_id=$_REQUEST['combo_name_id'];
    $floor_id=$_REQUEST['floor_id'];
            
?>
<!--      <script src="js/menu_order.js"></script>-->
<?php
   $sql_combo_pack_list =  $database->mysqlQuery("select cp.* from tbl_combo_packs cp
   left join tbl_combo_pack_rates cpr on cpr.cpr_combo_pack_id =cp.cp_id
   where cp_pack_active='Y' and cpr.cpr_mode='DI' and cpr.cpr_floor_id='".$floor_id."'
   and cp_id IN(SELECT distinct(cpm_combo_pack_id) FROM tbl_combo_pack_menus ) and cp_combo='".$combo_name_id."' "); 
    
    $num_combo_pack_list = $database->mysqlNumRows($sql_combo_pack_list);
    if($num_combo_pack_list){$i=0;
          while ($result_combo_pack_list = $database->mysqlFetchArray($sql_combo_pack_list)) {
              $i++;$combo_menu_list=array();
?>

            <a typ_pop="<?=$menu_type_click?>" class="tab_edt_btn md-trigger1 combo_mn_btn" onclick='return load_combo_ordering_popup(<?=$result_combo_pack_list['cp_id']?>)' href="#" style="height:auto !important;">
                <div class="product_item combo_mn" style="height:auto !important;">
                    <div class="product_text">
                        <div class="perspective">
                            <button class="btn btn-8 btn-8g">
                                <?=$result_combo_pack_list['cp_pack_name']?>
                                <?php
                                $sql_combo_pack_menu_list =  $database->mysqlQuery("SELECT `cpm_id`, `cpm_menu_id`, `cpm_combo_pack_id`, `cpm_combo_id`, `cpm_menu_sale_type`, `cpm_menu_type_label_id`, `cpm_menu_qty`, `cpm_menu_active`,mm.mr_menuid,mm.mr_menuname FROM `tbl_combo_pack_menus` left join 
                                tbl_menumaster mm on mm.mr_menuid=cpm_menu_id 
                                 WHERE `cpm_combo_id`='".$combo_name_id."' and `cpm_combo_pack_id`='".$result_combo_pack_list['cp_id']."' and `cpm_menu_active`='Y'"); 
                                //echo "select * from tbl_combo_name where cn_active='Y'";
                                $num_combo_pack_menu_list = $database->mysqlNumRows($sql_combo_pack_menu_list);
                                if($num_combo_pack_menu_list){$i=0;
                                      while ($result_combo_pack_menu_list = $database->mysqlFetchArray($sql_combo_pack_menu_list)) {
                                          $combo_menu_list[]=$result_combo_pack_menu_list['mr_menuname'];
                                      }
                                }
                                ?>
                                <p><?=implode(',',$combo_menu_list)?></p>
                            </button>
                        </div>
                    </div>
                </div>
            </a>
<?php
          }
    }
}

else if(isset($_REQUEST['set']) &&$_REQUEST['set']=='combo_adding'){
    
    $combo_menu_details=json_decode($_REQUEST['combo_menu_details']);
    $cod_count_combo_ordering=$_REQUEST['cod_count_combo_ordering'];
    $combo_stock_check=$_REQUEST['combo_stock_check'];
    $stock_left=$_REQUEST['stock_left'];
    $combo_pack_adding_id=$combo_menu_details[0]->combo_pack_adding_id;
    $combo_qty=$combo_menu_details[0]->combo_qty;
    $combo_total_rate=$combo_qty*$combo_menu_details[0]->combo_pack_rate;
    $combo_pack_preference=$combo_menu_details[0]->combo_pack_preference;
    $last_id='';
    $max_ordering_count=1;
        $sql_max_orering_count =  $database->mysqlQuery("select max(cod_count_combo_ordering) as max_orddering_count FROM tbl_combo_ordering_details");
        $num_max_orering_count = $database->mysqlNumRows($sql_max_orering_count);
        if($num_max_orering_count){$i=0;
            $result_max_orering_count = $database->mysqlFetchArray($sql_max_orering_count);
            if($result_max_orering_count['max_orddering_count']!=''){
                $max_ordering_count=$result_max_orering_count['max_orddering_count']+1;
            }
        }
    if($combo_stock_check=='Y'){
        $sql_combo_stock_update =  $database->mysqlQuery(" UPDATE `tbl_combo_stock` SET `cs_stock_number`='".$stock_left."' ,`cs_last_updated`=NOW() WHERE `cs_pack_id`='".$combo_pack_adding_id."' ");
    }    
    if($cod_count_combo_ordering!=''){
        $sql_combo_update =  $database->mysqlQuery("UPDATE `tbl_combo_ordering_details` SET `cod_combo_qty`='".$combo_qty."',`cod_combo_total_rate`='".$combo_total_rate."',cod_combo_preference='".$combo_pack_preference."' where `cod_count_combo_ordering`='".$cod_count_combo_ordering."'");
    }
    for($p=0;$p<count($combo_menu_details);$p++){
        
        $combo_adding_id=$combo_menu_details[$p]->combo_adding_id;
        $combo_pack_adding_id=$combo_menu_details[$p]->combo_pack_adding_id;
        $combo_qty=$combo_menu_details[$p]->combo_qty;
        $combo_pack_rate=$combo_menu_details[$p]->combo_pack_rate;
        $combo_total_rate=$combo_qty*$combo_menu_details[$p]->combo_pack_rate;
        $combo_menu_id=$combo_menu_details[$p]->combo_menu_id;
        $combo_each_menu_qty=$combo_menu_details[$p]->combo_each_menu_qty;
        $combo_pack_preference=$combo_menu_details[$p]->combo_pack_preference;
        $steward=$combo_menu_details[$p]->steward;
        $floor_id=$combo_menu_details[$p]->floor_id;
        if($cod_count_combo_ordering==''){
        
        $sql_combo_add =  $database->mysqlQuery("INSERT INTO `tbl_combo_ordering_details`(cod_count_combo_ordering,`cod_orderno`, `cod_combo_id`, `cod_combo_pack_id`, `cod_combo_qty`, `cod_combo_pack_rate`,cod_combo_total_rate, `cod_menu_id`, `cod_menu_qty`,`cod_combo_preference`, `cod_entry_date`, `cod_dayclosedate`, `cod_order_status`)
                                             VALUES ('".$max_ordering_count."','".$_SESSION['order_id']."','".$combo_adding_id."','".$combo_pack_adding_id."','".$combo_qty."','".$combo_pack_rate."','".$combo_total_rate."','".$combo_menu_id."','".$combo_each_menu_qty."','".$combo_pack_preference."',NOW(),'".$_SESSION['date']."','Added')"); 
    
//        echo "INSERT INTO `tbl_combo_ordering_details`(`cod_orderno`, `cod_combo_id`, `cod_combo_pack_id`, `cod_combo_qty`, `cod_combo_pack_rate`, `cod_menu_id`, `cod_menu_qty`, `cod_entry_date`, `cod_dayclosedate`, `cod_order_status`)
//                                             VALUES ('".$_SESSION['order_id']."','".$combo_adding_id."','".$combo_pack_adding_id."','".$combo_qty."','".$combo_pack_rate."','".$combo_menu_id."','".$combo_each_menu_qty."',NOW(),'".$_SESSION['date']."','Added')";
        $sql_max_id =  $database->mysqlQuery("select max(cod.cod_id) as id FROM tbl_combo_ordering_details cod");
        $num_max_id = $database->mysqlNumRows($sql_max_id);
        if($num_max_id){$i=0;
            $result_max_id = $database->mysqlFetchArray($sql_max_id);
            $last_id=$result_max_id['id'];
             $sql_max_id =  $database->mysqlQuery(" Insert into tbl_tableorder (ter_orderno,ter_branchid,ter_menuid,ter_portion,ter_qty,ter_orderfrom,ter_entryuser,ter_staff,ter_type,ter_floorid,ter_status,ter_combo_entry_id,ter_preferencetext,ter_count_combo_ordering)
                      values('".$_SESSION['order_id']."','1','".$combo_menu_id."','1','".$combo_qty*$combo_each_menu_qty."','Web_Interface','".$_SESSION['expodine_id']."','".$steward."','Dinein','".$floor_id."','Added','".$last_id."','".$combo_pack_preference."','".$max_ordering_count."')");
        
             
//               echo "Insert into tbl_tableorder (ter_orderno,ter_branchid,ter_menuid,ter_portion,ter_qty,ter_orderfrom,ter_entryuser,ter_staff,ter_type,ter_status,ter_combo_entry_id)
//                      values('".$_SESSION['order_id']."','1','".$combo_menu_id."','1','".$combo_each_menu_qty."','Web_Interface','".$_SESSION['expodine_id']."','".$steward."','Dinein','Added','".$last_id."')";       
        }
    }else{
        $update_table_order=$database->mysqlQuery(" update tbl_tableorder set ter_qty='".$combo_qty*$combo_each_menu_qty."',ter_preferencetext='".$combo_pack_preference."' where ter_count_combo_ordering='".$cod_count_combo_ordering."' and ter_menuid='".$combo_menu_id."' ");
        //echo "update tbl_tableorder set ter_qty='".$combo_qty*$combo_each_menu_qty."' where ter_count_combo_ordering='".$cod_count_combo_ordering."' and ter_menuid='".$combo_menu_id."'";
    }    
    }
    
}
else if(isset($_REQUEST['set']) &&$_REQUEST['set']=='combo_pack_delete_from_cart'){
    
    $cod_count_combo_ordering=$_REQUEST['cod_count_combo_ordering'];
    $combo_qty=$_REQUEST['combo_qty'];
    $combo_pack_id=$_REQUEST['combo_pack_id'];
    $combo_stock_check=$_REQUEST['combo_stock_check'];
    if($combo_stock_check=='Y'){
        $sql_combo_stock_update =  $database->mysqlQuery(" UPDATE `tbl_combo_stock` SET `cs_stock_number`=cs_stock_number+'".$combo_qty."' ,`cs_last_updated`=NOW() WHERE `cs_pack_id`='".$combo_pack_id."' ");
    } 
    $sql_combo_delete_from_cart =  $database->mysqlQuery("DELETE FROM `tbl_combo_ordering_details` WHERE `cod_count_combo_ordering`='".$cod_count_combo_ordering."' ");
    $sql_menu_delete_from_table_order =  $database->mysqlQuery("DELETE FROM `tbl_tableorder` WHERE `ter_count_combo_ordering`='".$cod_count_combo_ordering."'");
    
    
}
  
 else if(isset($_REQUEST['camount']) && $_REQUEST['camount']!=''){
     
            $row2=array();
            $opt=array();  $opt2=array();
            
            $multibill=     'temp_'.$_REQUEST['billno'];
            $multicardnum= $_REQUEST['cnumber'];
            $multicardtype=$_REQUEST['ctype'];
            $multicardamount=$_REQUEST['camount'];
    
        $insertion['mc_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($multibill));
        
         $insertion['mc_to_bank']=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['btype']));
        
        if($multicardtype!=''){
        $insertion['mc_cardtype']= mysqli_real_escape_string($database->DatabaseLink,trim($multicardtype));
        }
        
        $insertion['mc_cardamount']= mysqli_real_escape_string($database->DatabaseLink,trim($multicardamount));
        
	if($multicardnum!=''){
        $insertion['mc_carnumber']= mysqli_real_escape_string($database->DatabaseLink,trim($multicardnum));
        }
	
       $sql=$database->check_duplicate_entry('tbl_bill_card_payments',$insertion);
       if($sql!=1)
	{
	   $insertid              			=  $database->insert('tbl_bill_card_payments',$insertion);   
        
        $fnct_menu = $database->mysqlQuery("select * from tbl_bill_card_payments where mc_billno='".$multibill."'");
        $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
              }
        }
        
                                           $option="";
                                           $sql_rsn1 = "select * from tbl_cardmaster where crd_active = 'Y'";
                                                $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                                                $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                                                if ($num_rsns1) {
                                                while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                                                   
                                $option .=      " <option value='".$result_rsns1['crd_id']."'> ".$result_rsns1['crd_name']." </option>";
                              
                                }}
                                
                                $opt[]=$option;
                                
                                
                    $option2="";
                    $sql_rsn1 = "select * from tbl_bankmaster ";
                    $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                    $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                    if ($num_rsns1) {
                     while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                    
                         $option2 .=      " <option value='".$result_rsns1['bm_id']."'> ".$result_rsns1['bm_name']." </option>";
                     }}
                     
                    $opt2[]=$option2;     
                 
                }
 
          echo json_encode($row2).'+'.json_encode($opt).'+'.json_encode($opt2).'+';
   }

    else if(isset($_REQUEST['billnoview']) && $_REQUEST['billnoview']!=''){
     
            $row2=array();  $opt2=array();
            $opt=array();
            $multibill=     'temp_'.$_REQUEST['billnoview'];
             
	
         $fnct_menu = $database->mysqlQuery("select * from tbl_bill_card_payments where mc_billno='".$multibill."'");
       
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
                                           $option="";
                                           $sql_rsn1 = "select * from tbl_cardmaster where crd_active = 'Y'";
                                                $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                                                $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                                                if ($num_rsns1) {
                                             while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                                                      
                                                 
                                $option .=      " <option value='".$result_rsns1['crd_id']."'> ".$result_rsns1['crd_name']." </option>";
                                                       }}
                                $opt[]=$option;
                                
                                
                                 $option2="";
                    $sql_rsn1 = "select * from tbl_bankmaster ";
                    $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                    $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                    if ($num_rsns1) {
                     while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                    
                         $option2 .=      " <option value='".$result_rsns1['bm_id']."'> ".$result_rsns1['bm_name']." </option>";
                     }}
                     
                    $opt2[]=$option2;     
   
                 
  if($row2!="" && $opt!=""){
      
          echo json_encode($row2).'+'.json_encode($opt).'+'.json_encode($opt2).'+';
          
  }
  }

else if(isset($_REQUEST['billnoview_history'])){
     
            $row2=array();
            $opt=array();   $opt2=array();
             $multibill=  $_REQUEST['billnoview_history'];
             
    
      
	//  echo "select * from tbl_bill_card_payments where mc_billno='".$multibill."'";
         $fnct_menu = $database->mysqlQuery("select * from tbl_bill_card_payments where mc_billno='".$multibill."' or mc_billno='temp_".$multibill."' ");
       
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
                                      $option="";
                                           $sql_rsn1 = "select * from tbl_cardmaster where crd_active = 'Y'";
                                                $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                                                $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                                                if ($num_rsns1) {
                                             while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                                                      
                                                 
                                $option .=      " <option value='".$result_rsns1['crd_id']."'> ".$result_rsns1['crd_name']." </option>";
                                                       }}
                                $opt[]=$option;
                                
                                
                    $option2="";
                    $sql_rsn1 = "select * from tbl_bankmaster ";
                    $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                    $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                    if ($num_rsns1) {
                     while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                    
                         $option2 .=      " <option value='".$result_rsns1['bm_id']."'> ".$result_rsns1['bm_name']." </option>";
                     }}
                     
                    $opt2[]=$option2;             
                                
   
                 
  if($row2!="" && $opt!=""){
          echo json_encode($row2).'+'.json_encode($opt).'+'.json_encode($opt2).'+';
  }
}
  
 if(isset($_REQUEST['camount_his'])){
     
            $row2=array();
            $opt=array();
            $multibill=     'temp_'.$_REQUEST['billno'];
            $multicardnum= $_REQUEST['cnumber'];
            $multicardtype=$_REQUEST['ctype'];
            $multicardamount=$_REQUEST['camount_his'];
    
        $insertion['mc_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($multibill));
             if($multicardtype!=""){
        $insertion['mc_cardtype']= mysqli_real_escape_string($database->DatabaseLink,trim($multicardtype));
             }
        $insertion['mc_cardamount']= mysqli_real_escape_string($database->DatabaseLink,trim($multicardamount));
        if($multicardnum!=""){
	$insertion['mc_carnumber']= mysqli_real_escape_string($database->DatabaseLink,trim($multicardnum));
        }
	
    $sql=$database->check_duplicate_entry('tbl_bill_card_payments',$insertion);
    if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_bill_card_payments',$insertion);   
         $fnct_menu = $database->mysqlQuery("select * from tbl_bill_card_payments where mc_billno='".$multibill."'");
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl > 0) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                      $row2[]=$result_fnctvenue;
                  }
        }
        
                                           $option="";
                                           $sql_rsn1 = "select * from tbl_cardmaster where crd_active = 'Y'";
                                                $sql_rsns1 = $database->mysqlQuery($sql_rsn1);
                                                $num_rsns1 = $database->mysqlNumRows($sql_rsns1);
                                                if ($num_rsns1) {
                                             while ($result_rsns1 = $database->mysqlFetchArray($sql_rsns1)) {
                                                      
                                                 
                                $option .=      " <option value='".$result_rsns1['crd_id']."'> ".$result_rsns1['crd_name']." </option>";
                                                       }}
                                $opt[]=$option;
   
               }
 
     echo json_encode($row2).'+'.json_encode($opt).'+';
     
  }  
  if(isset($_REQUEST['set'])&&($_REQUEST['set']=="pincheck_trb")){
      
    $pin = $_REQUEST['pin'];
    $str = '';
    
    $str .= " ser_authorisation_code = '$pin'";
    
    $sql_staff="select sm.ser_inv_permission,sm.ser_reset_accounts,sm.ser_bill_reset, sm.ser_dayclose_revert_permission,sm.ser_firstname FROM tbl_staffmaster sm
    left join tbl_designationmaster dm on dm.dr_designationid = sm.ser_designation
    where $str and sm.ser_employeestatus = 'Active'";
  
    
    $sql_staff  =  $database->mysqlQuery($sql_staff); 
    $num_staff  = $database->mysqlNumRows($sql_staff);
    if($num_staff){
        $row = mysqli_fetch_array($sql_staff);
        
        echo $row['ser_dayclose_revert_permission'].'*'.$row['ser_firstname'].'*'.$row['ser_bill_reset'].'*'.$row['ser_reset_accounts'].'*'.$row['ser_inv_permission'];       
    }else{
        echo "NO";
    }

}
   

if(isset($_REQUEST['value'])&&($_REQUEST['value']=='salary_add'))
{
    
       if($_REQUEST['salary_amount']>0){
	$insertion['ts_staff_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['s_id']);
	
        $date=  date("Y-m-d H:i:s");
        
	$insertion['ts_date_time'] 		= mysqli_real_escape_string($database->DatabaseLink,$date);
         
        $insertion['ts_amount'] 		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['salary_amount']);
         
        $insertion['ts_type'] 		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type']);
	
    $sql=$database->check_duplicate_entry('tbl_staff_salary_detail',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_staff_salary_detail',$insertion);
	
        }
   }
   
   
   if($_REQUEST['sal1']>0){
       
	$insertion['ts_staff_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['s_id']);
	
        $date=  date("Y-m-d H:i:s");
        
	$insertion['ts_date_time'] 		= mysqli_real_escape_string($database->DatabaseLink,$date);
         
        $insertion['ts_amount'] 		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['sal1']);
         
        $insertion['ts_type'] 		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type1']);
	
    $sql=$database->check_duplicate_entry('tbl_staff_salary_detail',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_staff_salary_detail',$insertion);
	
        }
   }
   
   
   if($_REQUEST['sal2']>0){
       
	$insertion['ts_staff_id'] 		=  mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['s_id']);
	
        $date=  date("Y-m-d H:i:s");
        
	 $insertion['ts_date_time'] 		= mysqli_real_escape_string($database->DatabaseLink,$date);
         
         $insertion['ts_amount'] 		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['sal2']);
         
         $insertion['ts_type'] 		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type2']);
	
    $sql=$database->check_duplicate_entry('tbl_staff_salary_detail',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_staff_salary_detail',$insertion);
	
        }
   }
	
}
if(isset($_REQUEST['value'])&&($_REQUEST['value']=='salary_check')){
    
    
      $from=$_REQUEST['from'];
      $to=$_REQUEST['to'];
      $id=$_REQUEST['id'];
      
    $sql_staff="select sum(ts_amount) as tot_salary from tbl_staff_salary_detail where ts_staff_id='".$id."' and DATE(ts_date_time) between '".$from."' and '".$to."' and ts_type='Salary' ";
 
    $sql_staff  =  $database->mysqlQuery($sql_staff); 
    $num_staff  = $database->mysqlNumRows($sql_staff);
    if($num_staff){
        $row = mysqli_fetch_array($sql_staff);
        
        echo $row['tot_salary']; 
    } 
    
}
if(isset($_REQUEST['value'])&&($_REQUEST['value']=='pin_log')){
    
          $date=  date("Y-m-d H:i:s");
        
	 $insertion['tpn_type'] 		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type']);
         
         $insertion['tpn_staff'] 		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['staff']);
         
         $insertion['tpn_date_time'] 		= mysqli_real_escape_string($database->DatabaseLink,$date);
	
    $sql=$database->check_duplicate_entry('tbl_pinmode_log',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_pinmode_log',$insertion);
	
        }
    
    
}

if(isset($_REQUEST['value'])&&($_REQUEST['value']=='check_company')){
    
    $sql_staff="select tf.fr_floorname from tbl_tablebillmaster bm left join tbl_floormaster tf on tf.fr_floorid=bm.bm_floorid where bm.bm_billno='".$_REQUEST['bill_check']."'  ";
 
    $sql_staff  =  $database->mysqlQuery($sql_staff); 
    $num_staff  = $database->mysqlNumRows($sql_staff);
    if($num_staff){
        $row = mysqli_fetch_array($sql_staff);
        
        echo $row['fr_floorname']; 
    } else{
        echo 'no';
    }
    
    
}

if(isset($_REQUEST['value'])&&($_REQUEST['value']=='load_change_table_data')){
    
    ?>
     
       <div class="popo_table_change_drop_cc">
                        <div class="change_table_drop_down_text"><?= $_SESSION['table_selection_popup_totable'] ?></div>
                        <div class="chnage_table_drop" id="loadtotable">
                            <select class="chnage_table_select"  name="totable" id="totable">
                                <option><?= $_SESSION['table_selection_popup_selecttable'] ?></option>
                                <?php
                                $stfname = "";
//                                       $fptable=fopen($apilink."/src/main_menu_display.php?set=table&floorid=$floorid&dat=$other_lang","r");
//                            $response_table['messages'] = stream_get_contents($fptable);
//                        //var_dump($response_table['messages']);
//                            $resu_table= json_decode($response_table['messages'],true);
//                             //var_dump($resu_table['table_id'][0]);
//                            $table_count=count($resu_table['table_id']);
//                           // echo $table_count;
//                            for($m=0;$m<$table_count;$m++){
                                $sql_table_sel21 = mysqli_query($localhost,"select * from tbl_tablemaster where tr_floorid='" . $_REQUEST['flor_id_change'] . "' and  tr_status='Active'  order by tr_displayorder");
                            //echo "select * from tbl_tablemaster where tr_floorid='" . $_SESSION['floorid'] . "' and  tr_status='Active'  order by tr_displayorder";
                               $num_table21 = mysqli_num_rows($sql_table_sel21);
                            if ($num_table21) {
                                while ($result_table_sel21 = mysqli_fetch_array($sql_table_sel21)) {
                                            
                                           $table_name21 = $result_table_sel21['tr_tableno'];
                                           $table_status21 = $result_table_sel21['tr_status'];
                                           //echo $table_name21.'<br>';
                                           $table_id21 = $result_table_sel21['tr_tableid'];
                                           $table_vacantcount = $result_table_sel21['tr_vaccantcount'];
                                           $table_nextprefix = $result_table_sel21['tr_nextprefix_ascii'];
                                           
                                           
                if($_SESSION['main_language']!='english'){
                
                $sql_arabtable=$database->mysqlQuery("SELECT t_table_name FROM tbl_language_table_master left join tbl_languages on ls_id=t_lang_id WHERE t_table_id='".$table_id."' and ls_language='".$_SESSION['main_language']."'");
                
                //echo " SELECT l_pref_name FROM tbl_language_preference left join tbl_languages on ls_id=l_lang_id WHERE l_pref_id='".$result_menupref['pmr_id']."' and ls_language='".$dat."'";
                $num_arabtable = $database->mysqlNumRows($sql_arabtable);
                 if($num_arabtable){
                    while ($result_arabtable = $database->mysqlFetchArray($sql_arabtable)){
                $table_name21=$result_arabtable['t_table_name'];
                // $catid['name'][] = $catname;
                //echo $catname;
                }}}
                               
                            if($table_vacantcount>0 && $table_status21=='Active'){
                                        ?>
                                        <option tabid="<?= $table_id21 ?>" prefx="<?= chr($table_nextprefix) ?>"><?=$table_name21 . " (" . chr($table_nextprefix) . ")" ?></option>
    <?php }
}}
?>
                            </select>
                        </div>
                    </div><!---popo_table_change_drop_cc-->
     <?php
}


if(isset($_REQUEST['value'])&&($_REQUEST['value']=='update_feedback')){
    
    
    $sq=$database->mysqlQuery("UPDATE tbl_feedbackmaster SET  fbm_question='".$_REQUEST['question']."' WHERE fbm_id='".$_REQUEST['id']."' ");
    
}

if(isset($_REQUEST['value'])&&($_REQUEST['value']=='kot_cancel_staff')){
   
   
     $fnct_menu = $database->mysqlQuery("select distinct(ter_staff) from tbl_tableorder where ter_orderno='".$_REQUEST['order_id']."' limit 1 ");
       
         $num_fdtl = $database->mysqlNumRows($fnct_menu);
        if ($num_fdtl) {
              while ($result_fnctvenue = $database->mysqlFetchArray($fnct_menu))
              {
                 
             echo  $result_fnctvenue['ter_staff'];
               
               
              }
              }
   
}
if(isset($_REQUEST['set'])&&($_REQUEST['set']=='add_inv_kitchen')){
   
   
     
         
         $insertion['ti_name'] 		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['name']);
         
         $insertion['ti_status'] 		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['status']);
         
         $insertion['ti_type'] 		= mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['type']);
	
    $sql=$database->check_duplicate_entry('tbl_inv_kitchen',$insertion);
	 if($sql!=1)
	{
	$insertid              			=  $database->insert('tbl_inv_kitchen',$insertion);
	
        }
    
   
}

if(isset($_REQUEST['set'])&&($_REQUEST['set']=='update_inv_kitchen_mmenu')){
    
    
    $sq=$database->mysqlQuery("UPDATE tbl_menumaster SET  mr_inventory_kitchen='1' ");
    
     
    
}

if(isset($_REQUEST['set'])&&($_REQUEST['set']=='update_inv_kitchen')){
    
    
    $sq=$database->mysqlQuery("UPDATE tbl_inv_kitchen SET  ti_name='".$_REQUEST['name']."' ,ti_status='".$_REQUEST['status']."',ti_type='".$_REQUEST['type']."'   WHERE ti_id='".$_REQUEST['id']."' ");
    
}

if(isset($_REQUEST['set'])&&($_REQUEST['set']=='search_table_loy')){
   
   
     $sql_table_sel14 = mysqli_query($localhost,"SELECT ly_id,ly_firstname,ly_mobileno,ly_emailid,ly_gst FROM  tbl_loyalty_reg  WHERE ly_default='Y' and ly_module='DI' and ly_customer_table='".$_REQUEST['tableid']."' and ly_customer_floor ='".$_REQUEST['floor_loy']."' order by ly_mobileno desc limit 1 ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                                while ($result_menus = $database->mysqlFetchArray($sql_table_sel14)) {
                     ?>
                    
                    
                     <div id="customer_set_data4" class="" style="line-height: 34px;display: inline-block">
                                <a  href="#" onclick="return clear_loy_pop('<?=$result_menus['ly_mobileno']?>');" style=""> <img style="margin-top: -20px;" src="img/close-icon.png"> </a>
                        </div>
                    
                    
                     <div style="cursor: pointer;display: inline-block;margin-left: 7px" onclick="edit_loy_data('<?=$result_menus['ly_id']?>','<?=$result_menus['ly_firstname']?>','<?=$result_menus['ly_mobileno']?>','<?=$result_menus['ly_gst']?>','<?=$result_menus['ly_emailid']?>');" >
                         <strong id="name_loaded"><?=$result_menus['ly_firstname']?></strong>
                         <span id="num_loaded"><?=$result_menus['ly_mobileno']?></span>
                     </div>
                    
                    <?php } }else{  ?>
                    <strong>CUSTOMER NAME</strong>
                    <span>NUMBER</span>
                     
                       <?php
                       
                       
                    }  
                    
   
}

if(isset($_REQUEST['set'])&&($_REQUEST['set']=='check_table_loy')){
   
   $tb='';
    
    $sql_table_sel14 = mysqli_query($localhost,"SELECT ts_noofpersons FROM  tbl_tabledetails  WHERE  ts_tableid='".$_REQUEST['tableid']."' and ts_floorid ='".$_REQUEST['floor_loy']."' ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                                while ($result_menus = $database->mysqlFetchArray($sql_table_sel14)) {
                                    
                                  $tb= $result_menus['ts_noofpersons'];
                                }
                                }
    
    echo $tb.'*';
    
     $sql_table_sel14 = mysqli_query($localhost,"SELECT ly_id,ly_firstname,ly_mobileno,ly_emailid,ly_gst FROM  tbl_loyalty_reg  WHERE ly_default='Y' and ly_module='DI' and ly_customer_table='".$_REQUEST['tableid']."' and ly_customer_floor ='".$_REQUEST['floor_loy']."' order by ly_id desc limit 1 ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                              
                   
                       echo 'yes';
                       
                    }else{
                        
                        echo 'no';
                    }  
                    
   
}

if(isset($_REQUEST['set'])&&($_REQUEST['set']=='delete_table_loy')){
   
    $tb='';
    $sql_table_sel14 = mysqli_query($localhost,"SELECT tr_tableid FROM  tbl_tablemaster  WHERE  tr_tableno='".$_REQUEST['tableid']."' and tr_floorid ='".$_REQUEST['floor_loy']."' ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                                while ($result_menus = $database->mysqlFetchArray($sql_table_sel14)) {
                                    
                                    $tb=$result_menus['tr_tableid'];
                                }
                                }
                                
    $sql_table_sel14 = mysqli_query($localhost,"SELECT ly_id,ly_firstname,ly_mobileno,ly_emailid,ly_gst FROM  tbl_loyalty_reg  WHERE  ly_module='DI' and ly_customer_table='".$tb."' and ly_customer_floor ='".$_REQUEST['floor_loy']."' ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                                while ($result_menus5 = $database->mysqlFetchArray($sql_table_sel14)) {
                                    
                                    
                                    echo $result_menus5['ly_firstname'].'*'.$result_menus5['ly_mobileno'].'*'.$result_menus5['ly_gst'];
                                    
                                }
                                }
    
   
    // $sql_table_sel14 = mysqli_query($localhost,"update  tbl_loyalty_reg  set ly_default='N',ly_module='' ,ly_customer_table=null,ly_customer_floor=null  WHERE  ly_module='DI'  and ly_customer_table='".$tb."' and ly_customer_floor ='".$_REQUEST['floor_loy']."' ");
          
                     
   
}
  if(isset($_REQUEST['set'])&&($_REQUEST['set']=='check_pax_add')){
   
   $tb='';
    
    $sql_table_sel14 = mysqli_query($localhost,"SELECT ts_noofpersons FROM  tbl_tabledetails  WHERE  ts_orderno='".$_REQUEST['order']."'  ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                                while ($result_menus = $database->mysqlFetchArray($sql_table_sel14)) {
                                    
                                  $tb= $result_menus['ts_noofpersons'];
                                }
                                }
    
    echo $tb;
  }      
  
  
  if(isset($_REQUEST['set'])&&($_REQUEST['set']=='search_table_red')){
   
   $tb='';
    
    $sql_table_sel14 = mysqli_query($localhost,"SELECT ts_noofpersons FROM  tbl_tabledetails  WHERE  ts_orderno='".$_REQUEST['order']."'  ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                                while ($result_menus = $database->mysqlFetchArray($sql_table_sel14)) {
                                    
                                  $tb= $result_menus['ts_noofpersons'];
                                }
                                }
    
    echo $tb;
  }     
  
  
if (isset($_REQUEST['set']) && $_REQUEST['set']=='single_click_load'){


if (isset($_REQUEST['ordno'])) {
    
$orderno1=$_REQUEST['ordno'];
$orderno=explode(',',$orderno1);
}

   
				
				 $total=0;
				 $cancel=0;
                                 
				
				 $tablenos='';
				 $tablenos_full=array();
                                 $table_name="";
                                 $table_prefix="";
                        
                               $table_name_list='';
                                $orderno11=array();
                                $orderno11=array_unique($orderno);
                                
                                 foreach($orderno11 as $key => $value){
                                  
                                    
                                 if($value!=""){
                                     
				 $sql_kotlist  =  $database->mysqlQuery("SELECT tm.tr_tableno,ts.ts_tableidprefix,tm.tr_tableid from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as ts ON ts.ts_orderno=to1.ter_orderno LEFT JOIN tbl_tablemaster as tm ON tm.tr_tableid=ts.ts_tableid WHERE to1.ter_orderno='".$value."' and to1.ter_dayclosedate='".$_SESSION['date']."'"); 
				
                                 $num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){$i=0; $table_name=array();$table_prefix=array(); 
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  {    
                                                                $table_prefix[]=$result_kotlist['ts_tableidprefix'];   
                                                                $table_id=$result_kotlist['tr_tableid'];
                                                                $table_name[]=$result_kotlist['tr_tableno'];
                                                                $table_name_list.=$result_kotlist['tr_tableno'].'('.$result_kotlist['ts_tableidprefix'].')'.',';
                                                            
                                                                
                                                          } }  }
                                                          $table_name_list = implode(',',array_unique(explode(',', $table_name_list)));
                     ?>     
        
                
                     <tr>
                        <td  style="background-color: #ecd2b0;"  colspan="6" class="table-num-prnt-pop-td">
                            <div class="table-num-prnt-pop"><?php for($p=0;$p<count(array_unique($table_name));$p++){ if($p>0){ echo  ',';} echo $table_name[$p] .'('.$table_prefix[$p].')';} ?></div>
                                <a href="#" class="deletetablefromlist"><div class="completed_odr_cncel_icon"></div></a>
                         </td>
                     </tr>
                     <?php 
                      $combo_entry_count=array();
                     $sql_kotlist  =  $database->mysqlQuery("SELECT distinct(ter_kotno) from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as td ON to1.ter_orderno=td.ts_orderno WHERE td.ts_orderno='".$value."' and to1.ter_dayclosedate='".$_SESSION['date']."' and ter_cancel='N'"); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){$kot_no='';
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  { $addonrate=0;$slno=0;
                                                      $kot_no=$result_kotlist['ter_kotno'];
								  ?>
                     <tr> 
                        <td class="kot-num-prnt-pop-td" colspan="6"><?=$kot_no?></td>
                     </tr>
                       
                             <?php
                             $sql_combo_list  =  $database->mysqlQuery("select distinct(cod.cod_count_combo_ordering) as cod_count_combo_ordering, cod.cod_combo_pack_rate, cod.cod_combo_total_rate,cod.cod_combo_qty,  cn.cn_name, cp.cp_pack_name FROM tbl_combo_ordering_details cod 
                                                                        left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                                        left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where cod.cod_orderno='".$value."' and cod.cod_kot_no='".$kot_no."' and cod.cod_cancel='N'"); 
					$num_combo_list  = $database->mysqlNumRows($sql_combo_list);
					if($num_combo_list){
						  while($result_combo_list  = $database->mysqlFetchArray($sql_combo_list)) 
							  {     
                                                            $slno++; 
                                                            $combo_menu_array=array();
                                                          if(!in_array($result_combo_list['cod_count_combo_ordering'],$combo_entry_count)){
                                                                $combo_entry_count[]=$result_combo_list['cod_count_combo_ordering'];
                                                                $total=$total+$result_combo_list['cod_combo_total_rate'];
                                                               
                                                                $sql_combomenu_list  =  $database->mysqlQuery("select mm.mr_menuname  FROM tbl_combo_ordering_details cod
                                                               left join tbl_menumaster mm on mm.mr_menuid=cod.cod_menu_id
                                                               where cod.cod_count_combo_ordering='".$result_combo_list['cod_count_combo_ordering']."'");
                                                               $num_combomenu_list  = $database->mysqlNumRows($sql_combomenu_list);
                                                                if($num_combomenu_list){
                                                                    while($result_combomenu_list  = $database->mysqlFetchArray($sql_combomenu_list)) 
                                                                        {
                                                                        $combo_menu_array[]=$result_combomenu_list['mr_menuname'];
                                                                        }
                                                                }
                                                                
                                                          ?>
                             
                                                    <tr>
                                                       <td width="5%"><?=$slno?></td>
                                                       <td width="35%" style="text-align:left"><?=$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']?><br>
                                                           <span class="combo_tbl_lst"><?=implode(',',array_unique($combo_menu_array));?></span>
                                                       </td>
                                                       <td width="20%">Combo</td>
                                                       <td width="10%"><?=$result_combo_list['cod_combo_qty']?></td>
                                                       <td width="15%"><?=number_format($result_combo_list['cod_combo_pack_rate'],$_SESSION['be_decimal'])?></td>
                                                        
                                                       <td width="12%" ><span><?=number_format($result_combo_list['cod_combo_total_rate'],$_SESSION['be_decimal'])?></span></td>
                                                     </tr>
                                                <?php
                                                          }
                                                }}
                                $sql_wholelist  =  $database->mysqlQuery("SELECT to1.ter_addon_slno,to1.ter_kotno,to1.ter_unit_weight,to1.ter_rate_type,to1.ter_unit_type,um.u_name,bum.bu_name,mn.mr_manualrateentry,to1.ter_slno,mn.mr_menuname,mn.mr_menuid,pm.pm_portionname,to1.ter_qty,to1.ter_rate,(to1.ter_qty * to1.ter_rate) as total,to1.ter_billnumber,to1.ter_menuid,to1.ter_cancel,pm.pm_id from tbl_tableorder as to1 LEFT JOIN tbl_menumaster as mn 	ON to1.ter_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON to1.ter_portion=pm.pm_id left join tbl_unit_master um on um.u_id=to1.ter_unit_id left join tbl_base_unit_master bum on bum.bu_id=to1.ter_base_unit_id WHERE to1.ter_kotno='".$result_kotlist['ter_kotno']."' and to1.ter_dayclosedate='".$_SESSION['date']."' and  to1.ter_qty>0 and ter_count_combo_ordering IS NULL order by ter_slno asc  "); 
					$num_wholelist  = $database->mysqlNumRows($sql_wholelist);
					if($num_wholelist){
						  while($result_wholelist  = $database->mysqlFetchArray($sql_wholelist)) 
							  {    $slno++; 
                                                               $billgen_menuname=$result_wholelist['mr_menuname'];
                                                              
                                                                if($_SESSION['main_language']!='english'){
                
                                                                                    $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_wholelist['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

                                                                                    
                                                                                    $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                                                    $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                                                    $billgen_menuname=$result_arabmenu['lm_menu_name'];
                                                                                  
                                                                                   
                                                                                    }
								
								$temval="N"; 
								if($result_wholelist['ter_billnumber']!='')
								{
									$temp = strpos($result_wholelist['ter_billnumber'], "TEMP");
									if ($temp !== false) {
										
											$temval="Y";  
									  } else {
										 
										   $temval="Y";
									  }
								}
								if($result_wholelist['ter_cancel']=="Y"){
								$cancel=$cancel + $result_wholelist['total'];
                                                                
                                                                }
								$total=$total + $result_wholelist['total'] ;
                                                               
								$ids="pm_".$result_wholelist['pm_id'];
                                                               
                                                          ?>
                             
                                                    <tr>
                                                       <td width="5%" style="text-align:center"><?=$slno?></td>
                                                       <td width="35%" style="text-align:center"><?php if($result_wholelist['ter_addon_slno']!=''){ ?><span style="color:red"> (AD) </span><?php } ?> <?=$billgen_menuname?></td>
                                                       <td width="20%" style="text-align:center"><?php if($result_wholelist['ter_rate_type']=='Portion') { echo  $result_wholelist['pm_portionname'];} else{ if($result_wholelist['ter_unit_type']=='Packet'){echo number_format($result_wholelist['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_wholelist['u_name'];  } else if($result_wholelist['ter_unit_type']=='Loose'){ echo number_format($result_wholelist['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_wholelist['bu_name']; } }?></td>
                                                       <td width="10%" style="text-align:center"><?=$result_wholelist['ter_qty']?></td>
                                                        <?php if($result_wholelist['mr_manualrateentry']=='N'){
                                                           ?>
                                                       <td width="15%" style="text-align:right"><?=number_format($result_wholelist['ter_rate'],$_SESSION['be_decimal'])?></td>
                                                        <?php } else{ ?>
                                                         <td width="15%" id="reftd">

                                                           <input style="width:50%; text-align:right; border-color:lightcoral;float: left" type="text" class="hiddenrate" name="hiddenrate" id="hiddenrate<?=$value?><?=$result_wholelist['ter_slno']?><?=$result_wholelist['ter_kotno']?>" value="<?=number_format($result_wholelist['ter_rate'],$_SESSION['be_decimal'])?>" >
                                                           <input type="hidden" name="submitrate" id="submitrate"  onclick="return subrate('<?=$result_wholelist["ter_menuid"]?>');" >
                                                           <span style="display:none" name="submitrate1" id="submitrate1"  onclick="return subrate1('<?=$result_wholelist['ter_slno']?>','<?=$value?>','<?=$result_wholelist['ter_kotno']?>');"><img src="img/rate.png" /> </span>
                                                        </td> 
                                                       <?php } ?>
                                                       <td width="12%" ><span><?=number_format($result_wholelist['total'],$_SESSION['be_decimal'])?></span></td>
                                                     </tr>
                                                     <?php
                                                  
                                                }
                                               
                                                        } 
                                 
                                    if($cancel!=0){
					$total=$total - $cancel;
                                    }else{
					$total=$total ;
                                    }
                                  
                                ?>                                                     
                         
                   
                                 <?php }
                                 
                                  ?>
                                                     <tr style="background-color: lightgrey; position: sticky; bottom: 0px; z-index: 1; vertical-align: initial;">
                                                       <td width="5%">Total</td>
                                                       <td width="35%" ></td>
                                                       <td width="20%"></td>
                                                       <td width="10%"></td>
                                                        
                                                       <td width="15%"></td>
                                                        
                                                       <td width="12%" ><span><?=number_format($total,$_SESSION['be_decimal'])?></span></td>
                                                     </tr>
                                                <?php
                                 
                                 
                                 
                                    }else{
                                     ?>
                                         <tr>
                                             <td class="kot-num-prnt-pop-td" colspan="6" style="color:red;font-weight: bold;background-color: whitesmoke">NO KOT - PLEASE PRINT TO CLEAR TABLE</td>
                                        </tr>            
                                                     <?php
                                 }
                                 
                                 
                                 
                                 
                                    }
   	
    
}
if(isset($_REQUEST['set'])&&($_REQUEST['set']=='check_pax_add_dbl_click')){
   
   $tb='';
    
   
    $sql_table_sel14 = mysqli_query($localhost,"SELECT tr_maxchaircount FROM  tbl_tablemaster  WHERE  tr_tableid='".$_REQUEST['tableid'][0]."'  ");
                            $num_table14 = $database->mysqlNumRows($sql_table_sel14);
                            if ($num_table14) {
                                while ($result_menus = $database->mysqlFetchArray($sql_table_sel14)) {
                                    
                                  $tb= $result_menus['tr_maxchaircount'];
                                }
                                }
    
    echo $tb;
  }      
  if(isset($_REQUEST['set'])&&($_REQUEST['set']=='check_customer_di')){
   
    $sql_table_sel14 = mysqli_query($localhost,"SELECT lob_loyalty_customer FROM tbl_loyalty_pointadd_bill  WHERE lob_billno='".$_REQUEST['billno']."'   limit 1 ");
     $num_table14 = $database->mysqlNumRows($sql_table_sel14);
     if ($num_table14) {
     while ($result_menus = $database->mysqlFetchArray($sql_table_sel14)) {
                                   
     $sql_table_sel141 = mysqli_query($localhost,"SELECT ly_firstname,ly_mobileno FROM  tbl_loyalty_reg  WHERE ly_id='".$result_menus['lob_loyalty_customer']."'  limit 1 ");
                            $num_table141 = $database->mysqlNumRows($sql_table_sel141);
                            if ($num_table141) {
                                while ($result_menus1 = $database->mysqlFetchArray($sql_table_sel141)) {
                                    
                                    echo $result_menus1['ly_firstname'].'*'.$result_menus1['ly_mobileno'];
                                }
                                }
                                
                                
       } }
  }
  else if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchnum_new'){ 
      $num1='';
      $num=$_REQUEST['num'];
   
   if(strlen($num)>2){
    $sql_login  =  $database->mysqlQuery("select  ly_emailid,ly_gst,ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where  ly_mobileno LIKE '%".$num."%' and ly_status='Active' and (ly_default!='Y' or ly_default is NULL) "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                 $id= $result_login['ly_id'];
                                 $name1= $result_login['ly_firstname'].' '.$result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                                 $mail= $result_login['ly_emailid'];
                                 
                                 $gst= $result_login['ly_gst'];
                                 
                             ?>

                                                             <ul>
                                                                 <li id="load_name_ul" onclick="return num_click_new('<?=$name1?>','<?=$id?>','<?=$num?>','<?=$mail?>','<?=$gst?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                                                                                                <?=$num?>    
                                                                                                </li>
                                                                                            </ul>
<?php
				  
				 
				  
			
                      
                  }
                  }
   }
	
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchname_new'){ 
     $name1='';
   $name=$_REQUEST['name'];
   
   if(strlen($_REQUEST['name'])>2){
       
    $sql_login  =  $database->mysqlQuery("select ly_id,ly_firstname,ly_mobileno,ly_gst,ly_emailid from tbl_loyalty_reg where  (ly_firstname LIKE '%".$name."%' or ly_lastname LIKE '%".$name."%') and ly_status='Active'  and (ly_default!='Y' or ly_default is NULL) "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $id= $result_login['ly_id'];
                              $name1= $result_login['ly_firstname'];
				 $num= $result_login['ly_mobileno'];
                                 
                                 $mail= $result_login['ly_emailid'];
                                 
                                 
                                 $gst= $result_login['ly_gst'];
                                 
                             ?>

                                                             <ul>
                                                                 <li id="load_name_ul" onclick="return name_click_new('<?=$name1?>','<?=$id?>','<?=$num?>','<?=$mail?>','<?=$gst?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                                                                                                <?=$name1?>    
                                                                                                </li>
                                                                                            </ul>
<?php
				  
				 
				  
			
                      
                  }
                  }
   }

}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='check_sift'){ 
    
    if($_SESSION['ser_all_shift_closer']=='N'){
        
    if($_SESSION['shift_permission']=='Y'){
    
    $sql_staff="select ter_entryuser from  tbl_tableorder where ter_dayclosedate='".$_SESSION['date']."' and "
    . " ter_entryuser='".$_SESSION['expodine_id']."' "
    . " and  ter_billnumber='".$_REQUEST['billno']."' limit 1 ";
 
    $sql_staff  =  $database->mysqlQuery($sql_staff); 
    $num_staff  = $database->mysqlNumRows($sql_staff);
    if($num_staff){
        
         echo 'yes';
    }else{
         echo 'no';
    }
    
     }else{
       echo 'yes'  ;
    }
    
    
    
    }else{
       echo 'yes'  ;
    }
    
    
}else if(isset($_REQUEST['set']) && $_REQUEST['set']=="cancelitemqty"){
    
    $cancel_id = '';
    $secretkey = '';
    $combo_qty=0;
    $combo_count=0;
    $diff_combo_qty=0;
    $new_total_menu_qty=0;
    $new_combo_menu_qty_cancelled=0;
    $combo_cancel_reason='';
    $combo_name = json_decode($_REQUEST['combo_name']);
    $itemslno = $_REQUEST['itemslno'];
    $itemqty = $_REQUEST['itemqty'];
    $reason = $_REQUEST['reason'];
    $slno = explode(',',$itemslno);
    $qty = explode(',',$itemqty);
    $rsn = explode(',',$reason);
    if(isset($_REQUEST['addonitemslno'])){
    $addonitemslno = explode(',',$_REQUEST['addonitemslno']);
     }
    if(isset($_REQUEST['addonitemqty'])){
    $addonitemqty = explode(',',$_REQUEST['addonitemqty']);
     }
    if(isset($_REQUEST['addonreason'])){
    $addonreason = explode(',',$_REQUEST['addonreason']);
     }
    if(isset($_REQUEST['addonmenus'])){
    $addonmenus = json_decode($_REQUEST['addonmenus']);
    }
    //$result->{'Liste_des_produits1'};
    
    
    if(isset($_REQUEST['addonkotno'])){
    $addonkotno = explode(',',$_REQUEST['addonkotno']);
    }
    
    if(isset($_REQUEST['stafflist'])){
        $careof = $_REQUEST['stafflist'];
    }else{
        $careof = $_SESSION['loginempid_id'];
    }
    if(isset($_REQUEST['secretkey'])){
        if(isset($_REQUEST['cancelkey'])&&$_REQUEST['cancelkey']=='Y')
            $secretkey = $_REQUEST['secretkey'];
        else
            $secretkey = md5($_REQUEST['secretkey']);
    }
    
    $mode="DI";
    
    $database->mysqlQuery("SET @branchid = " . "'" . $_SESSION['branchofid'] . "'");
    $database->mysqlQuery("SET @temp_id = " . "'" . $_SESSION['order_id'] . "'");
     $database->mysqlQuery("SET @mode = " . "'" . $mode . "'");
    $sq=$database->mysqlQuery("CALL proc_kot_cancel(@branchid,@temp_id,@mode,@cancel_id)");
    $rs = $database->mysqlQuery("SELECT @cancel_id AS cancel_id");
    $row = $database->mysqlFetchArray($rs);
    $cancel_id= $row['cancel_id'];
    echo $cancel_id;
    $dateexp=date("Y-m-d H:i:s");
    
    if(!empty($combo_name)){
        for($p=0;$p<count($combo_name);$p++){
            $combo_qty=$combo_name[$p]->combo_qty;
            $combo_count=$combo_name[$p]->combo_count;
            $combo_cancel_reason=$combo_name[$p]->reason;
            $stock_check=$combo_name[$p]->stock_check;
            $sql_combo_menu_qty_select=$database->mysqlQuery("select cod_combo_pack_id,cod_combo_pack_rate,cod_combo_qty,cod_menu_qty,cod_menu_id,cod_menu_qty FROM tbl_combo_ordering_details where cod_count_combo_ordering='".$combo_count."' and cod_orderno='".$_SESSION['order_id']."'");
            //echo "select cod_combo_pack_rate,cod_combo_qty,cod_menu_qty,cod_menu_id,cod_menu_qty FROM tbl_combo_ordering_details where cod_count_combo_ordering='".$combo_count."' and cod_orderno='".$_SESSION['order_id']."'";
            $num_combo_menu_qty_select  = $database->mysqlNumRows($sql_combo_menu_qty_select);
            if($num_combo_menu_qty_select){$ii=0;
                while($result_combo_menu_qty_select  = $database->mysqlFetchArray($sql_combo_menu_qty_select)){
                    if($combo_qty < $result_combo_menu_qty_select['cod_combo_qty']){
                        $ii++;
                        $diff_combo_qty=$result_combo_menu_qty_select['cod_combo_qty']-$combo_qty;
                        if($ii==1 && $stock_check=='Y'){
                            $sql_combo_stock_update =  $database->mysqlQuery(" UPDATE `tbl_combo_stock` SET `cs_stock_number`=cs_stock_number+'".$diff_combo_qty."' ,`cs_last_updated`=NOW() WHERE `cs_pack_id`='".$result_combo_menu_qty_select['cod_combo_pack_id']."' ");
                        }
                        $new_total_menu_qty=$combo_qty*$result_combo_menu_qty_select['cod_menu_qty'];
                        //echo "update tbl_combo_ordering_details set cod_combo_qty= '".$combo_qty."',cod_combo_total_rate= cod_combo_pack_rate*'".$combo_qty."' where cod_count_combo_ordering='".$combo_count."' and cod_menu_id='".$result_combo_menu_qty_select['cod_menu_id']."' and cod_orderno='".$_SESSION['order_id']."'";
                       
                        $sql_combo_menu_qty_update=$database->mysqlQuery("update tbl_combo_ordering_details set cod_combo_qty= '".$combo_qty."',cod_combo_total_rate= cod_combo_pack_rate*'".$combo_qty."' where cod_count_combo_ordering='".$combo_count."' and cod_menu_id='".$result_combo_menu_qty_select['cod_menu_id']."' and cod_orderno='".$_SESSION['order_id']."' ");
//                        
                        $sql_combo_table_order_select=$database->mysqlQuery("select ter_dayclosedate,ter_slno, ter_qty,ter_entrydate,ter_kotno FROM tbl_tableorder where ter_orderno='".$_SESSION['order_id']."' and ter_count_combo_ordering='".$combo_count."' and ter_menuid='".$result_combo_menu_qty_select['cod_menu_id']."'");
                        
                        $num_combo_table_order_select  = $database->mysqlNumRows($sql_combo_table_order_select);
                        
                        if($num_combo_table_order_select){$i=1;
                            $result_combo_table_order_select  = $database->mysqlFetchArray($sql_combo_table_order_select);
                            
                            $new_combo_menu_qty_cancelled=$result_combo_table_order_select['ter_qty']-$new_total_menu_qty;    
//                           
                            $combo_table_order_update=$database->mysqlQuery("update tbl_tableorder set ter_qty='".$new_total_menu_qty."',ter_cancel = 'N'  where ter_orderno='".$_SESSION['order_id']."' and ter_slno='".$result_combo_table_order_select['ter_slno']."' ");
                             
                            if($new_total_menu_qty==0){
                                $sql_combo_menu_qty_update=$database->mysqlQuery("update tbl_combo_ordering_details set cod_cancel= 'Y' where cod_count_combo_ordering='".$combo_count."' and cod_menu_id='".$result_combo_menu_qty_select['cod_menu_id']."' and cod_orderno='".$_SESSION['order_id']."' ");
                                $combo_table_order_update1=$database->mysqlQuery("update tbl_tableorder set  ter_cancel = 'Y'  where ter_orderno='".$_SESSION['order_id']."' and ter_slno='".$result_combo_table_order_select['ter_slno']."' ");
                            }
                            $combo_table_order_change_insert=$database->mysqlQuery("INSERT INTO `tbl_tableorder_changes` (`ch_kot_cancel_id`, `ch_orderno`, `ch_orderslno`, `ch_slno`, `ch_cancelled_qty`, `ch_cancelledby_careof`, `ch_entrydate`, `ch_kotno`, `ch_cancelledreason`, `ch_cancelledsecret`, `ch_cancelledlogin`, `ch_dayclosedate`,ch_combo_pack_cancelled_qty) 
                                VALUES ('$cancel_id', '".$_SESSION['order_id']."', '".$result_combo_table_order_select['ter_slno']."', '".$result_combo_table_order_select['ter_slno']."', '".$new_combo_menu_qty_cancelled."', '$careof', '".$result_combo_table_order_select['ter_entrydate']."', '".$result_combo_table_order_select['ter_kotno']."', '$combo_cancel_reason', '$secretkey', '".$_SESSION['expodine_id']."', '".$result_combo_table_order_select['ter_dayclosedate']."','".$diff_combo_qty."')");
                        }    
                    }
                }
            }    
        }
    }
    for($i=0;$i<count($slno);$i++){
        
   
        $eachqty = 0;
        $totalrate=0;
        $cncl = "N";
        $sql_qry = $database->mysqlQuery("select * from tbl_tableorder 
        where ter_orderno = '".$_SESSION['order_id']."' and ter_slno = $slno[$i] and ter_cancel ='N' order by ter_slno asc");
        $num_rows  = $database->mysqlNumRows($sql_qry);
        if($num_rows){
            $result_row  = $database->mysqlFetchArray($sql_qry);
            if($result_row['ter_qty'] != $qty[$i]){
                
                $eachqty = $result_row['ter_qty'] - $qty[$i];
                
                
                
                
                ////////stockupdate//////
          $sql_qry111 = $database->mysqlQuery("select ter_menuid,ter_portion from tbl_tableorder 
        where ter_orderno = '".$_SESSION['order_id']."' and ter_slno = $slno[$i] and ter_cancel ='N' order by ter_slno asc");
        
            $num_rows111 = $database->mysqlNumRows($sql_qry111);
              if($num_rows111){
              while($result_row111 = $database->mysqlFetchArray($sql_qry111)){
      
      
              $qty_update= $database->mysqlQuery( "UPDATE tbl_menustock SET "
              . " mk_stock_number=mk_stock_number+'".$eachqty."' "
              . " where mk_menuid= '".$result_row111['ter_menuid']."' "
              . " and mk_portion= '".$result_row111['ter_portion']."' and mk_open_stock_date='".$_SESSION['date']."' and mk_opening_stock >0 ");
      
           }
             }
         ////stockend///////
                
                
                
                
                
                
                
                
                
                
                
                
                if($qty[$i]==0){
                    
                    $cncl = "Y";
                    $database->mysqlQuery("update tbl_tableorder set ter_status = 'Cancelled',ter_qty='0',ter_total_rate='0',ter_cancel = '$cncl', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledreason = '$rsn[$i]', ter_cancelledby_careof = '$careof', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledsecretkey = '$secretkey',ter_kot_canceltime='".$dateexp."'
                    where ter_orderno = '".$_SESSION['order_id']."' and ter_addon_slno = $slno[$i]");
//                     echo "update tbl_tableorder set ter_status = 'Cancelled',ter_qty='0',ter_total_rate='0',ter_cancel = '$cncl', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledreason = '$rsn[$i]', ter_cancelledby_careof = '$careof', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledsecretkey = '$secretkey',ter_kot_canceltime='".$dateexp."'
//                    where ter_orderno = '".$_SESSION['order_id']."' and ter_addon_slno = $slno[$i]";
                    
                     
                }
                $totalrate=$qty[$i]*$result_row['ter_rate'];
                if($rsn[$i]!=0){
                    $database->mysqlQuery("update tbl_tableorder set ter_qty = $qty[$i],ter_total_rate= $totalrate, ter_cancel = '$cncl', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledreason = '$rsn[$i]', ter_cancelledby_careof = '$careof', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledsecretkey = '$secretkey',ter_kot_canceltime='".$dateexp."'
                    where ter_orderno = '".$_SESSION['order_id']."' and ter_slno = $slno[$i]");
                    
                    $database->mysqlQuery("INSERT INTO `tbl_tableorder_changes` (`ch_kot_cancel_id`, `ch_orderno`, `ch_orderslno`, `ch_slno`, `ch_cancelled_qty`, `ch_cancelledby_careof`, `ch_entrydate`, `ch_kotno`, `ch_cancelledreason`, `ch_cancelledsecret`, `ch_cancelledlogin`, `ch_dayclosedate`) 
                    VALUES ('$cancel_id', '".$_SESSION['order_id']."', '$slno[$i]', '$slno[$i]', '$eachqty', '$careof', '".$result_row['ter_entrydate']."', '".$result_row['ter_kotno']."', '$rsn[$i]', '$secretkey', '".$_SESSION['expodine_id']."', '".$result_row['ter_dayclosedate']."')");
                }  else {
                    $database->mysqlQuery("update tbl_tableorder set ter_qty = $qty[$i],ter_total_rate = $totalrate, ter_cancel = '$cncl', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledby_careof = '$careof', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledsecretkey = '$secretkey',ter_kot_canceltime='".$dateexp."'
                    where ter_orderno = '".$_SESSION['order_id']."' and ter_slno = $slno[$i]");
                    
                    $database->mysqlQuery("INSERT INTO `tbl_tableorder_changes` (`ch_kot_cancel_id`, `ch_orderno`, `ch_orderslno`, `ch_slno`, `ch_cancelled_qty`, `ch_cancelledby_careof`, `ch_entrydate`, `ch_kotno`, `ch_cancelledsecret`, `ch_cancelledlogin`, `ch_dayclosedate`) 
                    VALUES ('$cancel_id', '".$_SESSION['order_id']."', '$slno[$i]', '$slno[$i]', '$eachqty', '$careof', '".$result_row['ter_entrydate']."', '".$result_row['ter_kotno']."', '$secretkey', '".$_SESSION['expodine_id']."', '".$result_row['ter_dayclosedate']."')");
                }
            }
        }
    
        
                }
    
     
   
    if($_SESSION['be_kot_cancellation_print']=='Y'){
        
        require_once("printer_functions.php");
        $printpage=new PrinterCommonSettings();
        $a=$printpage->print_kot_cancel($cancel_id,$_SESSION['date'],"web","1");
        $printpage->print_kot_cancel_consolidated($cancel_id,$_SESSION['date'],"web","1");
    }
    
    
    
    $sql_login_fire  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Item Cancel' "); 
	$num_login_fire   = $database->mysqlNumRows($sql_login_fire);
	if($num_login_fire){ 
	while($result_login_fire  = $database->mysqlFetchArray($sql_login_fire)) 
        { 
          $firebase_report_status=$result_login_fire['tf_active'];
        }}
    
            
       if($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on']=='Y' && $firebase_report_status=="Y" ){
           
           $data_arr='';
           $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
           
                     $sql_items="select tcrr.cr_reason,toc.ch_cancelledreason,toc.ch_cancelledby_careof,tor.ter_count_combo_ordering,um.u_name,bum.bu_name,tor.ter_unit_type,tor.ter_unit_weight,tor.ter_rate_type,tor.ter_unit_id,tor.ter_base_unit_id,mm.mr_menuname, toc.ch_cancelled_qty, pm.pm_viewinkot, pm.pm_portionname, mm.mr_menuid, kcm.kr_kotname,toc.ch_orderslno, toc.ch_kotno,toc.ch_combo_pack_cancelled_qty 
                                                                        FROM tbl_tableorder_changes toc 
                                                                        left join tbl_cancellation_reasons tcrr on tcrr.cr_id=toc.ch_cancelledreason
                                                                        left join tbl_tableorder tor on toc.ch_orderno = tor.ter_orderno and toc.ch_orderslno = tor.ter_slno
                                                                        left join tbl_menumaster mm on tor.ter_menuid = mm.mr_menuid
                                                                        left join tbl_portionmaster pm on tor.ter_portion = pm.pm_id left join tbl_unit_master um on um.u_id=tor.ter_unit_id left join tbl_base_unit_master bum on bum.bu_id=tor.ter_base_unit_id
                                                                        left join tbl_kotcountermaster as kcm on mm.mr_kotcounter = kcm.kr_kotcode
                                                                        where toc.ch_kot_cancel_id = '$cancel_id' and toc.ch_dayclosedate = '".$_SESSION['date']."' 
                                                                        order by kcm.kr_kotname,toc.ch_kotno,tor.ter_count_combo_ordering asc";

                                                                        $sql_items  =  mysqli_query($localhost,$sql_items); 
                                                                        $num_items  = mysqli_num_rows($sql_items);
                                                                        if($num_items){
                                                                            $old = '';
                                                                            $oldno = '';
                                                                            $consol_print_count=0;
                                                                            $canelmenu_slno='';
                                                                            $combo_ordering_count='';
                                                                            while($result_items  = mysqli_fetch_array($sql_items)) 
                                                                            {
                                                                                
                                                                                
                                                                                 $reason_staff='';
                                                                                 $sql_gen1 =  mysqli_query($localhost,"select ser_firstname from tbl_staffmaster where ser_staffid='".$result_items['ch_cancelledby_careof']."'"); 
                                                                                 $num_gen1  = mysqli_num_rows($sql_gen1);
                                                                                 if($num_gen1)
                                                                                 {
				                                                 while($result_invoice63  = mysqli_fetch_array($sql_gen1)) 
                                                                                 {
                                                                                $reason_staff=$result_invoice63['ser_firstname'];
                                                                                 }
                                                                                 }
                                                                                 
                                                                                $canelmenu_slno=$result_items['ch_orderslno'];
                                                                                $ct++;
                                                                                $kotcounter = $result_items['kr_kotname'];

                                                                                if($kotcounter != $old){
                                                                                    $combo_name='';
                                                                                    $oldno = '';
                                                                                    $old = $result_items['kr_kotname'];
                                                                                   
                                                                                    $kotname = '* '.$kotcounter.'  ';
                                                                                    $stln = strlen($kotname);
                                                                                    $a=0;
                                                                                    $spc = 46 - $stln;
                                                                                    for($a=0;$a<$spc;$a++){  
                                                                                        
                                                                                    }
                                                                                      $data_arr.=''.$kotname;
                                                                                    
                                                                                }else{
                                                                                    $old = $result_items['kr_kotname'];
                                                                                }

                                                                                $kotno = $result_items['ch_kotno'];
                                                                                if($kotno != $oldno){
                                                                                    $oldno = $result_items['ch_kotno'];
                                                                                   
                                                                                    $kotnumber = ' [ '.$kotno.' ] ';
                                                                                    $stln = strlen($kotnumber);
                                                                                    $a=0;
                                                                                    $spc = 44 - $stln;
                                                                                    for($a=0;$a<$spc;$a++){  
                                                                                       
                                                                                    }

                                                                                   $data_arr.='    '.$kotnumber.' \n';
                                                                                    
                                                                                }else{
                                                                                    $oldno = $result_items['ch_kotno'];
                                                                                }
                                                                                
                                                                                
                                                                                if($result_items['pm_viewinkot']=="Y"){
                                                                                $pr='('.$result_items['pm_portionname'].')';
                                                                       }else
                                                                       {
                                                                           
                                                                         $pr="";
                                                                       }
                                                                                
                                                                            if($result_items['ter_count_combo_ordering'] && $combo_ordering_count!=$result_items['ter_count_combo_ordering']){

                                                                                $combo_ordering_count=$result_items['ter_count_combo_ordering'];
                                                                                $sql_combo_heading  =  mysqli_query($localhost,"select  distinct(ter.ter_count_combo_ordering) as ter_count_combo_ordering,cn.cn_name,cp.cp_pack_name,cod.cod_combo_qty FROM tbl_tableorder ter
                                                                                                                                left join tbl_combo_ordering_details cod on cod.cod_count_combo_ordering=ter.ter_count_combo_ordering
                                                                                                                                left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                                                                                                left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id
                                                                                                                                where cod.cod_count_combo_ordering='".$combo_ordering_count."' and ter.ter_count_combo_ordering IS NOT  NULL"); 
                                                                                $num_combo_heading  = mysqli_num_rows($sql_combo_heading);
                                                                                if($num_combo_heading)
                                                                                    {
                                                                                        $result_combo_heading  = mysqli_fetch_array($sql_combo_heading);
                                                                                         $combo_name = $result_combo_heading['cn_name'].' - '. $result_combo_heading['cp_pack_name'].' (Qty:'.$result_items['ch_combo_pack_cancelled_qty'].')';

                                                                                            $data_arr.=$combo_name.' \n';
                                                                                    }

                                                                                }else{
                                                                                    $combo_name='';
                                                                                }
                                                                                
                                                                                $menu_details='';
                                                                                $menu = $result_items['ch_cancelled_qty'].' - '.$result_items['mr_menuname'];
                                                                                
                                                                                $rsn_cr='Reason : '.$result_items['cr_reason'];
                                                                                
                                                                                
                                                                                if($result_items['ter_unit_id']!="")
                                                                                    {
                                                                                    $menu_details="(".$result_items['ter_unit_type'].":".number_format($result_items['ter_unit_weight'],$decimal)." ".$result_items['u_name'].')'; 
                                                                                    }
                                                                                    else if($result_items['ter_base_unit_id']!=""){
                                                                                    $menu_details="(".$result_items['ter_unit_type'].":".number_format($result_items['ter_unit_weight'],$decimal)." ".$result_items['bu_name'].')';  
                                                                                    }
                                                                                $stln = strlen($menu);
                                                                                $a=0;
                                                                                $spc = 44 - $stln;
                                                                                 for($a=0;$a<$spc;$a++){  
                                                                                    
                                                                                   }
                                                                              	   
//                                                                             if($menu)
//										{
                                                                                   
                                                                                   
                                                                               $data_arr.=''.$menu.' \n';
                                                                               
                                                                               
                                                                               if($pr!=''){
                                                                                     $data_arr.=''.$pr.' \n';
                                                                               }
                                                                               
								             
                                                                               if($menu_details!=''){
                                                                             
                                                                                $data_arr.=''.$menu_details.' \n';
                                                                               }
                                                                               
                                                                                if($rsn_cr!=''){
                                                                             
                                                                                $data_arr.=''.$rsn_cr.' \n';
                                                                               }
                                                                                $data_arr.=' \n';
                                                                               
                                                                               
                                                                                
                                                                              $sql_addon_cancel_items="select * from tbl_order_addon_changes adc left join tbl_menumaster mm on mm.mr_menuid=adc.adc_cancel_menu where adc.adc_cancel_id='".$cancel_id."' and adc_cancel_order_slno='".$canelmenu_slno."' and adc.adc_kotno='".$result_items['ch_kotno']."' and adc.adc_dayclosedate='".$_SESSION['date']."'  group by adc.adc_kotno,adc_cancel_menu";
                                                                $sql_addon_cancel_items  =  mysqli_query($localhost,$sql_addon_cancel_items); 
                                                                        $num_addon_cancel_items  = mysqli_num_rows($sql_addon_cancel_items);
                                                                        
                                                                        if($num_addon_cancel_items){
                                                                            $consol_print_count++;
                                                                            
                                                                             $data_arr.='*****  Add-ons  *****';
                                                                          
                                                                             $kotno='';
                                                                            $stln = strlen($kot);
                                                                            $a=0;
                                                                            $spc = 46 - $stln;
                                                                            for($a=0;$a<$spc;$a++){  
                                                                                
                                                                            }

                                                                            while($result_addon_cancel_items  = mysqli_fetch_array($sql_addon_cancel_items)) 
                                                                            {
                                                                                
                                                                                $ct++;
                                                                              
                                                                                $menu_details='';
                                                                                $menu = $result_addon_cancel_items['adc_cancelled_qty'].' - '.$result_addon_cancel_items['mr_menuname'].$pr;
                                                                                
                                                                                $stln = strlen($menu);
                                                                                $a=0;
                                                                                $spc = 46 - $stln;
                                                                                 for($a=0;$a<$spc;$a++){  
                                                                                    
                                                                                         }

                                                                               if($result_addon_cancel_items['adc_kotno']!=$kotno){
                                                                                    $kotno=$result_addon_cancel_items['adc_kotno'];
                                                                                    
                                                                                   
                                                                                     $data_arr.='     '.$kotno;
                                                                                }
                                                                             if($menu)
										{
							          
								      
                                                                          $data_arr.='     '.$menu_details;
                                                                        if($menu_details!=''){
                                                                       
                                                                       
                                                                        $data_arr.='     '.$menu_details;
                                                                        }
                                                                         
										}	
                                                                            }
                                                                            
                                                                        }
                                                                                }
                                                                        
                                                                         $date_new=date('Y-m-d h:i:s');
                                                                     
                                                                       $data_arr.='KOT Cancelled By : '.$reason_staff.' \n'; 
                                                                         $data_arr.='Cancelled Time : '.$date_new.' \n'; 
                                                                         $data_arr.='MODE - DINE IN' ;         
                                                                        }
           
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
    ///pushing msg///
    $branch_id_fire=$_SESSION['firebase_id'];
    $body = $data_arr;
    
    require 'vendor/autoload.php';
   
    $client = new Client();
    $client->setAuthConfig('service_google.json'); // Replace with your file path
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

   $url = "https://fcm.googleapis.com/v1/projects/ed-reports-b5f94/messages:send";

   $projectId = 'ed-reports-b5f94'; 
 
     $data = [
    'message' => [
       "topic"=> $branch_id_fire,
        'notification' => [
            'title' => $_SESSION['s_branchname']."  - DI ITEM CANCELLED ",
            'body' => $body
        ],
        'data' => [
            'key1' => 'value1',
            'key2' => 'value2'
        ],
         "android" =>[
      "ttl"=> "3600s" , // TTL in seconds (1 hour)
       "priority"=> "HIGH"     
    ],
        'apns' => [
        "headers"=>[
        "apns-expiration" => "2" ,// TTL for iOS
         "apns-priority"=> "10"         
      ],
            'payload' => [
                'aps' => [
                    'sound' => 'default', // Notification sound for iOS
                ],
            ],
        ],
    ]
   ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    if(curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo 'Response: ' . $response;
    }
    curl_close($ch);
   // echo $response;
    
    
//    $url = "https://fcm.googleapis.com/fcm/send";
//   //$token ='dFCy-onTEvQ:APA91bGXAQobatT-sbeLk3QTFdh-Zf10Z7dzmUIO99GHDjkrmwWwvzA7poh5dbAv55B7KrFKAQtpDwkJgo9lgwxFUC0W_RrnI1ohd7c-IJJfuCTeSSdhyKowMEKwOYZk5met5QhnCx0T';
//    $serverKey = 'AIzaSyD3zn_tP2RqeVSMsEFMJnrcZk5AuNGru-M';
//    $title = $_SESSION['s_branchname']."  - DI ITEM CANCELLED ";
//    
//    $body = $data_arr;
//    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1', 'click_action' =>'notification');
//    $arrayToSend = array('to' => "/topics/$branch_id_fire" , 'notification' => $notification,'priority'=>'high');
//    $json = json_encode($arrayToSend);
//    $headers = array();
//    $headers[] = 'Content-Type: application/json';
//    $headers[] = 'Authorization: key='. $serverKey;
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
//    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
//    //Send the request
//    $response = curl_exec($ch);
//    //Close request
//    if ($response === FALSE) {
//    die('FCM Send Error: ' . curl_error($ch));
//    }
//    curl_close($ch);
    
    //to database storage of msg//
    $data_to_firebase=urlencode($body);
    $url = $_SESSION['firebase_url']."api/post_notification?branhcid=$branch_id_fire&notification=$data_to_firebase";
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    //var_dump($result);

        }
}
    
    
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=="table_setting_di"){
    
$_SESSION['orderby'] = "KOT";
$_SESSION['orderbyvalue'] = "kot";
$_SESSION['backchecking']="N";

$_SESSION['typevalue'] = "Dinein";

        $orderid = $_SESSION['order_id'];
        $table_ids = $_REQUEST['tableid'];
        $tablelist = explode(",", $_REQUEST['tableid']);
        $asciilist = explode(",", $_REQUEST['asciival']);
        $tablecount = count($tablelist);
        $table_names = "";
        for ($i = 0; $i < $tablecount; $i++) {
            

             $sql_table = "select tr_tableno from tbl_tablemaster where tr_tableid='" . $tablelist[$i] . "' ";
            
             $sql_table1 = $database->mysqlQuery($sql_table);
             $num_table = $database->mysqlNumRows($sql_table1);
                if ($num_table) {
                $result_table = $database->mysqlFetchArray($sql_table1);
                $table_names.=$result_table['tr_tableno'] . " (" . $asciilist[$i] . ") " . ",";
            }
           $tabel_details = $database->show_mastertable_details($tablelist[$i]);
           if ($i == 0) {
                $floor_id = $tabel_details['tr_floorid'];
            }
        }
        
        $_SESSION['floorid_ser'] = $floor_id;
       
    echo $orderid;
    
}
else if($_REQUEST['set']=="check_table_vaccancy"){
    
    
        $orderno=''; $sts='';
        $sql_qry111 = $database->mysqlQuery("select ts_status,ts_orderno from tbl_tabledetails 
         where ts_tableid = '".$_REQUEST['table']."' ");
        
            $num_rows111 = $database->mysqlNumRows($sql_qry111);
              if($num_rows111){
              while($result_row111 = $database->mysqlFetchArray($sql_qry111)){
                  
                  $orderno=$result_row111['ts_orderno'];
                   $sts=$result_row111['ts_status'];
                  
              }
              }
    
         $sql_login  =  $database->mysqlQuery("select tr_vaccantcount from tbl_tablemaster where tr_tableid='".$_REQUEST['table']."' and tr_vaccantcount>0 "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		 
             echo 'yes*'.$orderno.'*'.$sts;     
        }else{
            echo 'no*'.$orderno.'*'.$sts;
        }
        
       
}
else if($_REQUEST['set']=="hide_menu"){
    
 $sql_login  =  $database->mysqlQuery("update tbl_menumaster set mr_menuname=CONCAT('#',mr_menuname), mr_delete_mode='Y',mr_active='N' where mr_menuid='".$_REQUEST['mid']."'  "); 
	 
          $date_log_in=date('Y-m-d H:i:s');
        $query3=$database->mysqlQuery("INSERT INTO `tbl_menu_log`(`tml_date`, `tml_menu`, `tml_data`, `tml_staff`,tml_type,tml_mode)
            VALUES ('$date_log_in','".$_REQUEST['mid']."','(Rate:0) (P:0) ','".$_SESSION['expodine_id']."','MENU HIDED','All Module')");   
 
}

else if($_REQUEST['set']=="update_inv_stock"){
    
 $sql_login  =  $database->mysqlQuery("update tbl_store_stock set ts_weight='0' , ts_qty='0'   "); 
	
}
else if($_REQUEST['set']=='best_selling_cat'){ 
    
    
       $sql_best_selling =  $database->mysqlQuery(" select  bd.bd_menuid FROM tbl_tablebilldetails bd LEFT join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno
       where bd.bd_count_combo_ordering IS NULL and bm.bm_dayclosedate between CURDATE( ) - INTERVAL 7  DAY AND CURDATE( ) and bm.bm_status='Closed'
       group by bd.bd_menuid, bd.bd_portion, bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight order by bd.bd_qty desc LIMIT 0,10");
        $num_best_selling = $database->mysqlNumRows($sql_best_selling);
        if($num_best_selling){
            while($result_best_selling = $database->mysqlFetchArray($sql_best_selling)){
 
	        $sql_menulist =  "select mr_stock_inventory,mr_menuid,mr_menuname,mr_unit_type from tbl_menumaster  WHERE 
                 mr_active='Y'  and  mr_menuid='".$result_best_selling['bd_menuid']."' 
                 GROUP BY mr_menuid order by mr_menuname ASC ";
			
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{
                                           $menu_name = $result_menus['mr_menuname'];
                                           $menu_id = $result_menus['mr_menuid'];
                                           $stock_in_no=$result_menus['mr_stock_inventory']; 
                                           $menu_type_click= $result_menus['mr_unit_type']; 
                                           
					if($_SESSION['main_language']!='english'){

                                        $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

                                       $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                        $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                        $menu_name=$result_arabmenu['lm_menu_name'];
                                       
                                        }		
                                            
                                            
                                                        
                                                if($_SESSION['s_listimage']=="Y")
							{
								$sql_img="SELECT * FROM tbl_menuimages where mes_menuid='".$result_menus['mr_menuid']."' limit 0,1"; 
								$sql_imgs  =  $database->mysqlQuery($sql_img); 
								$num_imgs  = $database->mysqlNumRows($sql_imgs);
								if($num_imgs){
									while($result_imgs  = $database->mysqlFetchArray($sql_imgs)) 
										{
											$img=$result_imgs['mes_imagethumb'];
										}
								}else
								{
									$img="uploads/default_photo.jpg";
								}
							}
				$portn="N";			
				$sql_menuportion="select * from tbl_menuratemaster where  mmr_menuid='".$result_menus['mr_menuid']."' and  mmr_floorid='".$_SESSION['floorid']."' AND (mmr_rate<>'0' OR mmr_rate IS NOT NULL)";
				 $sql_portions  =  $database->mysqlQuery($sql_menuportion); 
				  $num_portions  = $database->mysqlNumRows($sql_portions);
				  if($num_portions){
					$portn="Y";  
				  }
                                  
                                  
                                            $portnstock = "N";
                                            $sql_menuportion1 = "SELECT * from tbl_menustock  where mk_menuid='$menu_id' AND mk_stock = 'Y'";
                                            $sql_portions1 = $database->mysqlQuery($sql_menuportion1);
                                            $num_portions1 = $database->mysqlNumRows($sql_portions1);
                                            if ($num_portions1) {
                                                $portnstock = "Y";
                                                //$catid['portion']='Y';
                                            } 
                                  
                                  
                                           $portn_click = "yes";
                                           $sql_menuportion12 = "SELECT mmr_portion from tbl_menuratemaster  where mmr_menuid='$menu_id' and mmr_floorid='".$_SESSION['floorid_ser']."' ";
                                            $sql_portions12 = $database->mysqlQuery($sql_menuportion12);
                                            $num_portions12 = $database->mysqlNumRows($sql_portions12);
                                            if ($num_portions12>1) {
                                                
                                                $portn_click = "no";
                                                
                                            }    
                                            
                                      
                                           $dyno_rate = "";
                                           $sql_menuportion127 = "SELECT mr_manualrateentry from tbl_menumaster where mr_menuid='$menu_id' ";
                                            $sql_portions127 = $database->mysqlQuery($sql_menuportion127);
                                            $num_portions127 = $database->mysqlNumRows($sql_portions127);
                                            if ($num_portions127) {
                                                while ($result_imgs = $database->mysqlFetchArray($sql_portions127)) {
                                                       
                                                    if($result_imgs['mr_manualrateentry']=='Y'){
                                                    $dyno_rate = "yes";
                                                    }else{
                                                         $dyno_rate = 'no';
                                                    }
                                                    
                                            }
                                            }          
                                            
                                  
	if($portn=="Y"){  
            
	?>
				
                <a typ_pop="<?=$menu_type_click?>" style="position: relative; <?php if($_SESSION['s_listimage'] == "Y"){ ?> height: 130px; <?php } ?> " <?php if($dyno_rate !='yes' && $_SESSION['be_single_click_add']=='Y'  &&  $menu_type_click !='Packet' && $menu_type_click !='Loose' && $portn_click=='yes') { ?> onclick="single_cart('<?=$menu_id?>','<?=$_SESSION['floorid_ser']?>','<?=$stock_in_no?>')" <?php } ?> data-modal="menuname_<?=$menu_id ?>" class="tab_edt_btn <?php if($menu_type_click =='Packet' || $_SESSION['be_single_click_add']=='N'  || $menu_type_click =='Loose' || $portn_click =='no' || $dyno_rate =='yes'){ ?> md-trigger1 <?php } if($portnstock=="N"){ ?> notinstock <?php } ?> <?php if($_SESSION['s_listimage']=="N"){ ?> <?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> noimagename <?php }else{ ?> menu_sub_item1  clear_color_<?=$menu_id?> <?php } ?> <?php } ?> <?php if($portn=="N"){ ?> noportionalert <?php } ?>" href="#" title="menu_<?=$menu_id?>" <?php if($_SESSION['s_listimage']=="N"){ ?> style="height:auto !important;" <?php } ?> >
                <div class="<?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> product_item <?php }else{ ?>  <?php } ?> " <?php if($_SESSION['s_listimage']=="N"){ ?> style="height:auto !important;" <?php } ?> >
               
	
                
                <div class="product_text" <?php if( $_SESSION['menu_theme']=='Theme_2'){ ?> style="width:auto" <?php } ?> >
             			<div class="perspective" <?php if( $_SESSION['menu_theme']=='Theme_2'){ ?> style="width:auto" <?php } ?> >
                                    
				<?php if($_SESSION['s_listimage']=="N"){ ?>
				<button <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="height: 100px !important;" <?php } ?> <?php if( $_SESSION['menu_theme']=='Theme_2'){ ?>   style="" <?php } ?> class="<?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> btn btn-8 btn-8g <?php }else{ ?> menu_sub_item1 menu_1 clear_color_<?=$menu_id?> <?php } ?>"> <?php if ($_SESSION['be_rate_on_button'] =='Y') { ?> <p style="height: 43px;margin-bottom: 0px;overflow: hidden;margin-top: 1px;line-height: 1.2;"> <?=$menu_name?> </p> <?php } else{ ?> <p <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="margin-top: 52px" <?php } ?> ><?=$menu_name?> </p> <?php } ?>
                                
                            <?php if ($portnstock == "N") { ?>    
                             </br> <span  style="color:red" >NO STOCK</span>
                            <?php } ?>
                                
                            </button>
                            <?php }else { ?>
                            <button <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="height: 100px !important;" <?php } ?> <?php if( $_SESSION['menu_theme']=='Theme_2'){ ?>   style="" <?php } ?> class="<?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> btn btn-8 btn-8g <?php }else{ ?> menu_sub_item1 menu_1 clear_color_<?=$menu_id?> <?php } ?>"> <?php if ($_SESSION['be_rate_on_button'] =='Y') { ?> <p style="height: 43px;margin-bottom: 0px;overflow: hidden;margin-top: 1px;line-height: 1.2;"> <?=$menu_name?></p> <?php } else{ ?> <p <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="margin-top: 52px" <?php } ?> ><?=$menu_name?> </p>  <?php } ?>
                            
                           <?php if ($portnstock == "N") { ?>    
                               </br> <span  style="color:red" >NO STOCK</span>
                               <?php } ?>
                            
                            </button>
                            <?php } ?>
                                 
                <?php if($_SESSION['s_listimage']=="Y"){ // image show permission ?>
                <div class="product_img" style="border-radius: 10px;height:60px;margin-left: 15px;width:155px;margin-top: -95px;position: relative;"><img src="<?= $img ?>"  width="168" height="60" /></div>
                <?php } ?>             
                                    
                                     
                           <?php  $rtr=''; $rater=''; 
                           $sql_menuportion127 = "SELECT * from tbl_menuratemaster mc left join tbl_portionmaster pm on pm.pm_id=mc.mmr_portion left join tbl_base_unit_master tbu on tbu.bu_id=mc.mmr_base_unit_id left join tbl_unit_master tu on tu.u_id=mc.mmr_unit_id where mc.mmr_menuid='$menu_id' and mc.mmr_floorid='".$_SESSION['floorid']."' ";
                                            $sql_portions127 = $database->mysqlQuery($sql_menuportion127);
                                            $num_portions127 = $database->mysqlNumRows($sql_portions127);
                                            if ($num_portions127) { 
                                                while ($result_imgs = $database->mysqlFetchArray($sql_portions127)) {
                                                   
                                             $rtr.= $result_imgs['u_name'].' '.$result_imgs['bu_name'].$result_imgs['pm_portionshortcode'].' : '.$result_imgs['mmr_rate'].'|'; 
                                  
                           } } 
                           
                           
                     $rater= explode('|', $rtr) ;
                           
                        
                      ?>  
                           
                               
                      <?php if ($portnstock=="Y" && $_SESSION['be_rate_on_button'] =='Y') { ?>  
                       
                       <span style="  position: relative;bottom: 22px;left: 1px;color: #6a6a6a;display: inline-block;font-size: 9px;line-height: 1.2;"><?=$rater[0].str_repeat('&nbsp;', 5).$rater[1]?></span> 
                      
                       <span style="  position: relative;bottom: 22px;left: 1px;color: #6a6a6a;display: inline-block;font-size: 9px;line-height: 1.2;"><?=$rater[2].str_repeat('&nbsp;', 5).$rater[3]?></span> 
                      <?php } ?>          
                                    
			</div>
                                                 
                     </div>   
             </div></a>
              
                                <?php  } }}   }} ?>  
                                        
<script src="js/load_popup_fns.js"></script>

<?php } 


/********************************* DINE IN COMBOS*********************************************/
 
function in_array_r($item , $array){
    return preg_match('/"'.$item.'"/i' , json_encode($array));
}
 ?>