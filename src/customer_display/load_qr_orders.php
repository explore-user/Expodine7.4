 <?php 
 
 session_start();
 include("../database.class.php");
 $database	= new Database();
 //error_reporting(0);
 $qr_branch=''; $qr_db='';

    $sql_login_dc  =  $database->mysqlQuery("select tb.be_qrcode_db,tc.bsc_cloud_branchid from tbl_branchmaster tb left join"
    . "  tbl_branch_settings_cloud tc on tc.bsc_branchid=tb.be_branchid "); 
    $num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
    if($num_cat_s_dc){
     while($result_cat_s_tc  = $database->mysqlFetchArray($sql_login_dc)) 
              {

          $qr_branch=$result_cat_s_tc['bsc_cloud_branchid'];
          $qr_db=$result_cat_s_tc['be_qrcode_db'];
     }
 }


$localhost1=mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD,DATABASE_NAME_QR);

if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_qr_order_all'){

 $addr='';

 $running='N';

 $sql_gen =  mysqli_query($localhost1,"select * from tbl_qr_order_details td left join tbl_qr_user_detail tc on td.tq_user = tc.tu_number   where  td.tq_synced='Y'  and tq_localy_delivered!='Y'  and tq_cancelled!='Y' AND tq_branch='$qr_branch' order by td.tq_order_time desc"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                                    
                                    $addr=$result_cat_s_tc['tu_buliding_home_name'].' , '.$result_cat_s_tc['tu_lanmark'];
                                    
                                     $running=$result_cat_s_tc['tq_running'];
                                     
                                   if($result_cat_s_tc['tq_mode']=='DI'){
                                      
                                    $sql_tab = "select tr_tableno from tbl_tablemaster where tr_tableid='".$result_cat_s_tc['tq_table']."'  ";
                             $sql_menus = $database->mysqlQuery($sql_tab);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) {   
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                            
                                            $table_new=$result_menus['tr_tableno'];
                                        }
                                        }
                                        
                                         $sql_tab = "select fr_floorname from tbl_floormaster where fr_floorid='".$result_cat_s_tc['tq_floor']."'  ";
                             $sql_menus = $database->mysqlQuery($sql_tab);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) {   
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                            
                                            $floor_new=$result_menus['fr_floorname'];
                                        }
                                        }
                                      
                                      
                                     $mode= $floor_new.' &nbsp; | &nbsp; '.$table_new ;
                                  }else{
                                    $mode= 'Delivery';
                                  }    
                                    
                                    
if($result_cat_s_tc['tq_order_no']!=""){
    
    
 $date=date('Y-m-d H:i:s');
    
$timeFirst  = strtotime($date);
$timeSecond = strtotime($result_cat_s_tc['tq_order_time']);
$totalSecondsDiff = abs($timeFirst-$timeSecond); 
$totalMinutesDiff = $totalSecondsDiff/60;


$bill_ta=''; $kot_ta=''; $ord='';

if($result_cat_s_tc['tq_mode']=='TA'){
    
}
$sql_login_dc  =  $database->mysqlQuery("select tab_billno,tab_kotno from  tbl_takeaway_billmaster where tab_qr_order_id='".$result_cat_s_tc['tq_order_no']."' "); 
$num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
if($num_cat_s_dc){
 while($result_cat_s_tc3  = $database->mysqlFetchArray($sql_login_dc)) 
	  {
     
     $bill_ta=$result_cat_s_tc3['tab_billno'];
    $kot_ta=$result_cat_s_tc3['tab_kotno'];  
 }
}
else{
       
       $sql_login_dc  =  $database->mysqlQuery("select ter_billnumber,ter_kotno,ter_orderno from  tbl_tableorder where ter_qr_order='".$result_cat_s_tc['tq_order_no']."' group by ter_qr_order "); 
$num_cat_s_dc  = $database->mysqlNumRows($sql_login_dc);
if($num_cat_s_dc){
 while($result_cat_s_tc3  = $database->mysqlFetchArray($sql_login_dc)) 
	  {
     
     $bill_ta=$result_cat_s_tc3['ter_billnumber'];
      $kot_ta=$result_cat_s_tc3['ter_kotno']; 
      $ord=$result_cat_s_tc3['ter_orderno']; 
 }
}

   }


                            ?>
          
               <div class="take-away-quee-box " style="height:175px;">       
                            
                    <div   class="take-away-quee-box-head"> 
                        <strong <?php if($totalMinutesDiff>15){ ?> title="Order Delayed"  style="background-color: red;height: 32px;top-padding:5px;" <?php }else{ ?> style="background-color: #57cc99;height: 32px;top-padding:5px;"  <?php } ?> > 
                        
                         <span style="margin-left: -40px;color: white;font-size: 9px;margin-top: 3px">#<?=$result_cat_s_tc['tq_order_no']?>    </span> <br>
                                
                      <span title="FLOOR | TABLE" style="font-size: 9px;margin-top: 3px;margin-left: -20px;color: white;font-weight: bold"> * <?=$mode?>  </span> 
                        
                          <?php if($result_cat_s_tc['tq_bill_request']=="Y" && $result_cat_s_tc['tq_bill_printed']=="N"  &&  $kot_ta!='' && $bill_ta==''){   ?>
                          
                     <span title="BILL REQUESTED BY CUSTOMER" > <img onclick="bill_print_request('<?=$result_cat_s_tc['tq_order_no']?>','<?=$kot_ta?>','<?=$ord?>','<?=$result_cat_s_tc['tq_table']?>','<?=$result_cat_s_tc['tq_floor']?>');" style="margin-top: -28px;margin-left: 127px;" src="../img/bill-icon.png"></span>
                      
                      <?php }  ?>
                        
                        </strong>
                        
                        
                        </strong>
                      <div class="take-away-quee-box-time"><span><?=$result_cat_s_tc['tq_order_time']?> </span></div>
                      
                  
                    </div>
                
                
                   <div class="take-away-quee-box-time"><img src="img/cst.png" alt=""> : <span> <?=$result_cat_s_tc['tu_name']?></span></div>
                    <div class="take-away-quee-box-time"><img src="img/phn.png" alt=""> : <span> <?=$result_cat_s_tc['tu_number']?></span></div>
                     <div class="take-away-quee-box-time"><img src="img/loc.png" alt=""> : <span> <?=$result_cat_s_tc['tu_city']?></span></div>
                     
                      <div class="take-away-quee-box-time"><img src="img/amt.png" alt=""> : <span> <?=number_format($result_cat_s_tc['tq_final'],$_SESSION['be_decimal'])?></span></div>
                    
                    <?php if($result_cat_s_tc['tq_localy_confirmed']=="N" || $running=='Y' ){   ?>
                          
                     <div id="accept_btn" class="online_acpt_btn_new" onclick="confirm_order('<?=$result_cat_s_tc['tq_delivery_charge']?>','<?=$result_cat_s_tc['tq_order_time']?>','<?=$result_cat_s_tc['tq_order_no']?>','<?=$qr_branch?>','qr_code','<?=$result_cat_s_tc['tu_name']?>',' <?=$result_cat_s_tc['tu_number']?>','<?=$addr?>','<?=$result_cat_s_tc['tu_lanmark']?>','<?=$result_cat_s_tc['tu_area']?>','<?=$result_cat_s_tc['tu_pincode']?>','<?=$result_cat_s_tc['tq_mode']?>','<?=$result_cat_s_tc['tq_table']?>','<?=$result_cat_s_tc['tq_floor']?>','<?=$running?>');"  style="background-color: #659465 ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">
                         
                         
                        <?php if($running=="N"){   ?>       
                         
                           <span >Accept</span>  
                           
                        <?php }else{   ?>    
                         
                             <?php if($result_cat_s_tc['tq_localy_confirmed']=="N"){   ?>    
                           
                                  <span >Running</span> 
                                  
                             <?php }else{ ?>    
                         
                               <span >Running</span> 
                            
                              <?php }  ?> 
                         
                        <?php }  ?>   
                     
                     
                     </div> 
                   <?php  }  ?>
                     
                     
                       <?php if($result_cat_s_tc['tq_localy_confirmed']=="N"){   ?>
                     
                      <div  class="online_acpt_btn_new" id="cancel_btn" onclick="cancel_order_status('<?=$result_cat_s_tc['tq_order_no']?>','<?=$qr_branch?>','qr_code' );"  style="background-color: red ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">CANCEL</div>  
                     
                     
                     <?php  }  ?>
                      
                      
                      
                      <?php if($result_cat_s_tc['tq_localy_confirmed']=="Y" && $running=='N' &&  $result_cat_s_tc['tq_mode']=='TA' && $result_cat_s_tc['tq_localy_ready']=="N" ){   ?>
                            
                     <div  class="online_acpt_btn_new" id="confirm_btn" onclick="ready_order_urban('<?=$result_cat_s_tc['tq_order_no']?>','<?=$qr_branch?>' );"  style="width:100% !important;background-color: darkred ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">ASSIGN</div>  
                     
                        <?php  } if($result_cat_s_tc['tq_localy_confirmed']=="Y" && $running=='N'  && $result_cat_s_tc['tq_mode']=='DI' && $result_cat_s_tc['tq_localy_ready']=="N" ){   ?>
                     
                     <div  class="online_acpt_btn_new" id="confirm_btn"  style="width:100% !important;background-color: #75935f ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">CONFIRMED TO TABLE</div>  
                      
                       <?php } ?>
                     
                     
                    <?php if($result_cat_s_tc['tq_localy_confirmed']=="Y"  && $result_cat_s_tc['tq_mode']=='DI' && $result_cat_s_tc['tq_localy_ready']=="Y" ){   ?>
                            
                     <div  class="online_acpt_btn_new" id="confirm_btn"  style="width:100% !important;background-color: #03a4e2 ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">BILLED
                     
                        <img  title="PAYMENT SCREEN OF BILL : <?=$bill_ta?>" onclick="settlepopupcommondi();"  
                        style="position: fixed;border: solid 1px;width: 21px;margin-left: 33px;
                        margin-top: -2px;border-radius: 4px;padding: 1px" src="../img/rate.png">
                     
                     </div>  
                     
                    <?php } ?>
                     
                     
                     <?php if($result_cat_s_tc['tq_localy_confirmed']=="Y"  && $result_cat_s_tc['tq_mode']=='TA' && $result_cat_s_tc['tq_localy_ready']=="Y" ){   ?>
                            
                     <div  class="online_acpt_btn_new" id="confirm_btn"  style="width:100% !important;background-color: #2a9b61 ;padding: 5px;float: left;color: white;margin-top: 20px;float-right:50px;cursor: pointer ">PICKED 
                     
                         <img title="PAYMENT SCREEN OF BILL : <?=$bill_ta?>" onclick="settlepopupcommonta();" style="position: fixed;
                        border: solid 1px;
                        width: 21px;
                        margin-left: 33px;
                        margin-top: -2px;border-radius: 4px;padding: 1px" src="../img/rate.png">
                     </div>  
                     
                     <?php } ?>
                        
                  <div class="take-away-quee-box-head" > 
                       
                  <?php if($result_cat_s_tc['tq_localy_confirmed']=="Y"){   ?>
                      <span title="<?=$kot_ta?>" style="float:right;margin-right: 125px;background-color: #995656;width: 20% !important;border-radius: 2px;box-shadow: black;color: white " class="odr_item_view_btn " onclick="print_qr_kot('<?=$kot_ta?>','<?=$bill_ta?>','<?=$result_cat_s_tc['tq_mode']?>');">KOT</span>
                      <span title="<?=$bill_ta?>" style="float:right;margin-right: 65px;background-color: #995656;width: 20% !important;border-radius: 2px;box-shadow: black;color: white" class="odr_item_view_btn" onclick="print_qr_bill('<?=$bill_ta?>','<?=$result_cat_s_tc['tq_mode']?>');">BILL</span>
                   <?php } ?> 
                      
                  <span class="odr_item_view_btn" style="background-color: #995656;width: 20% !important;border-radius: 2px;box-shadow: black;color: white;margin-right: 5px;" onclick="load_urban_items('<?=$result_cat_s_tc['tq_order_no']?>','<?=$qr_branch?>');">INFO</span>
                   
                 </div>
                  
                 </div>
            
<?php


} } }else{
     ?>
    
    <span style="margin-left: 0%;padding-top: 30%;color: white;margin-top: 0px;" >NO QR ORDERS FOUND</span> 
    
    <?php
}

}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='list_qr_order'){ 
   
    $total=0;
      
       $sql_gen =  mysqli_query($localhost1,"select * from tbl_qr_order_item ti left join tbl_menumaster tm on tm.mr_menuid=ti.tqi_menuid left join"
               . " tbl_portionmaster tp on ti.tqi_portion=tp.pm_id where  ti.tqi_orderno='".$_REQUEST['order_id']."' and "
               . " ti.tqi_branch=".$_REQUEST['branch']." group by ti.tqi_menuid,ti.tqi_portion,ti.tqi_date "); 
      
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                                 $total=$total+  $result_cat_s_tc['tqi_total'];       
                        ?>
                                <tr>
				<td><?=$result_cat_s_tc['mr_menuname'].' ('.$result_cat_s_tc['pm_portionshortcode'].')'?></td>
				<td><?=$result_cat_s_tc['tqi_qty']?></td>
                                <td><?= number_format($result_cat_s_tc['tqi_rate'],$_SESSION['be_decimal'])?></td>
                                <td><?= number_format($result_cat_s_tc['tqi_total'],$_SESSION['be_decimal'])?></td>
				</tr> 
                                
                     <?php  } } ?>
                                
                           <tr>
			   <td>Total</td>
			   <td></td>
                           <td></td>
                           <td><?=number_format($total,$_SESSION['be_decimal'])?></td>
			   </tr> 
                            
                    <?php      
                    
                    $sql_gen =  mysqli_query($localhost1,"select * from  tbl_qr_order_details left join tbl_qr_user_detail on "
                    . " tbl_qr_user_detail.tu_number=tbl_qr_order_details.tq_user where  tq_order_no='".$_REQUEST['order_id']."' "); 
      
		    $num_gen  = mysqli_num_rows($sql_gen);
		    if($num_gen)
		    {
			while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                            
                        ?>   
                           
                                <tr>
                                <td>.  </td> 
                                <td>   </td> 
                                <td>   </td> 
                                <td>   </td> 
                                </tr>
                            
                            <tr>
                                <td> Order ID : <?php echo $_REQUEST['order_id']; ?>  </td> 
                               
                            </tr>
                            
                             <tr>
                                <td> Channel : <?php echo 'QR Code' ?>  </td> 
                               
                            </tr>
                            
                             <tr>
                                <td> Name : <?php echo $result_cat_s_tc['tu_name'] ?>  </td> 
                               
                            </tr>
                            
                            
                             <tr>
                                <td> Number : <?php echo $result_cat_s_tc['tu_number'] ?>  </td> 
                               
                            </tr>
                            
                            
                             <tr>
                                <td> Address : <?php echo $result_cat_s_tc['tu_buliding_home_name'].' '.$result_cat_s_tc['tu_lanmark'].' '.$result_cat_s_tc['tu_area'].' '.$result_cat_s_tc['tu_city'] ?>  </td> 
                               
                            </tr>
                            
                            
                            <?php if($result_cat_s_tc['tq_mode']=='DI'){ ?>
                            
                            <tr>
                                
                                <td> Floor Id : <?php echo $result_cat_s_tc['tq_floor']; ?>  </td> 
                               
                            </tr>
                            
                            <tr>
                              
                                <td> Table Id : <?php echo $result_cat_s_tc['tq_table']; ?>  </td> 
                            </tr>
                                     
                              <?php }  ?>
                            
                            
                             <tr>
                              
                                <td> Confirmed Time : <?php echo $result_cat_s_tc['tq_local_status_update_time']; ?>  </td> 
                            </tr>
                            
                            
                            <?php if($result_cat_s_tc['tq_mode']=='TA'){ ?>
                            <tr>
                                
                                <td> Food Ready Time : <?php echo $result_cat_s_tc['tq_food_ready_time']; ?>  </td> 
                               
                            </tr>
                            
                            <tr>
                              
                                <td> Delivered Time : <?php echo $result_cat_s_tc['tq_deliverd_time']; ?>  </td> 
                            </tr>
                                     
                            <?php
                            }  
                                     
                                     
                            }
                            }  
              
}    

if(isset($_REQUEST['set']) && $_REQUEST['set']=='table_di_menu_list'){ 
    
    $row2=array();       
    
    $string='';
    
    if($_REQUEST['run']=='Y'){
        
        $string.=" and tqi_running='Y' ";
    }else{
         $string.=' ';
    }
    
    $sql_gen =  mysqli_query($localhost1,"select tqi_menuid,tqi_rate,tqi_portion,tqi_qty  from tbl_qr_order_item "
           
    . " where tqi_branch='".$_REQUEST['store_qr']."' and tqi_orderno='".$_REQUEST['order_qr']."' $string group by tqi_menuid,tqi_portion,tqi_date "); 
      
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
		   while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
		  {
                      $row2[]=$result_cat_s_tc;          
                  }
              }
                        
               
   echo json_encode($row2);
     
   $date=date('Y-m-d H:i:s');     
 
   $sql_gen =  mysqli_query($localhost1,"Update tbl_qr_order_details set tq_localy_confirmed='Y' ,tq_running='N',tq_local_status_update_time='$date'  where tq_branch='".$_REQUEST['store_qr']."' and tq_order_no='".$_REQUEST['order_qr']."' ");  
   
   
   $sql_gen1 =  mysqli_query($localhost1,"Update tbl_qr_order_item set tqi_running='N' where tqi_branch='".$_REQUEST['store_qr']."' and tqi_orderno='".$_REQUEST['order_qr']."' ");  
   
     
 }
 
if(isset($_REQUEST['set']) && $_REQUEST['set']=='add_order_qr'){ 
    
                              $orderid="TEMP*".$database->getEpoch();
                              $_SESSION['ta_order_id']=$orderid;
                              $i=0; 
  
                              $menu_id=0;   
                              $portion=0;
                              $food=0;
                              $slno=0;  
                              $qty=0;
                              $rate=0;
                              $mode='';
                              $orderfrom='';
                              $ratetype='';
                              $unittype='';
                              $pref_text='';
                
                              $unit_id=0;
                              $base_unit_id=0;
                              $unit_weight=0; 
                              
        $sql_login_dc1  =  $database->mysqlQuery("select tol_id from tbl_online_order where tol_qr_order='Y'  "); 
        $num_cat_s_dc1  = $database->mysqlNumRows($sql_login_dc1);
        if($num_cat_s_dc1){
         while($result_cat_s_tc1  = $database->mysqlFetchArray($sql_login_dc1)) 
                 {

               $food=$result_cat_s_tc1['tol_id'];
         }
         }            
               
           
     

       $sql_gen =  mysqli_query($localhost1,"select * from tbl_qr_order_item where tqi_branch='".$_REQUEST['store_id']."' "
               . " and tqi_orderno='".$_REQUEST['order_id']."' group by tqi_menuid,tqi_portion  "); 
      
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
				while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                               
                          
                              $menu_id=$result_cat_s_tc['tqi_menuid'];   
                              $portion=$result_cat_s_tc['tqi_portion'];
                             
                              $slno=$i++;  
                              $qty=$result_cat_s_tc['tqi_qty'];
                              $rate=$result_cat_s_tc['tqi_rate'];
                              $mode='Add';
                              $orderfrom='TA';
                              $ratetype='Portion';
                              $unittype='';
                              $pref_text='OnlineOrder';
                
                              $unit_id=0;
                              $base_unit_id=0;
                              $unit_weight=0; 
                              
                           
	$database->mysqlQuery("SET @preferencetext 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$pref_text) . "'");
	$database->mysqlQuery("SET @temp_billno                 = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['ta_order_id']) . "'");
	$database->mysqlQuery("SET @menuid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$menu_id) . "'");
	$database->mysqlQuery("SET @portion 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$portion) . "'");
	$database->mysqlQuery("SET @qty 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$qty) . "'");
	
	$database->mysqlQuery("SET @rate 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$rate) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$database->mysqlQuery("SET @mode 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$mode) . "'");
	$database->mysqlQuery("SET @order_from 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$orderfrom) . "'");
	$database->mysqlQuery("SET @rate_type 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$ratetype) . "'");
        $database->mysqlQuery("SET @unit_type 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$unittype) . "'");
        $database->mysqlQuery("SET @unit_id 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$unit_id) . "'");
        $database->mysqlQuery("SET @base_unit_id 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$base_unit_id) . "'");
        $database->mysqlQuery("SET @unit_weight 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$unit_weight) . "'");
	$database->mysqlQuery("SET @serailno                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$slno) . "'");
        $database->mysqlQuery("SET @dish_type                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
        $database->mysqlQuery("SET @food                         = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$food) . "'");
        $sq=$database->mysqlQuery("CALL  proc_temptakeaway(@temp_billno,@menuid,@rate_type,@portion,@unit_type,@unit_weight,@unit_id,@base_unit_id,@qty,@preferencetext,@rate,@branchid,@mode,@order_from,@serailno,@dish_type,@food)");

        } }
      
       
   $sql_login_dc  =  $database->mysqlQuery(" update tbl_takeaway_billmaster set tab_qr_delivery_charge='".$_REQUEST['charge']."', tab_qr_order_time='".$_REQUEST['time']."', tab_qr_order_id='".$_REQUEST['order_id']."', tab_food_partner='".$food."'   where `tab_billno`='".$_SESSION['ta_order_id']."' and ( tab_status='Kot_Generated'  or tab_status='Generated' or tab_status='Processing'  )  ");
   
   $sql_login_dc  =  $database->mysqlQuery(" update tbl_takeaway_billdetails set  tab_dayclose_in='".$_SESSION['date']."', tab_qr_order_id='".$_REQUEST['order_id']."', tab_food_partner_id='".$food."' , tab_bill_addon_slno=NULL  where `tab_billno`='".$_SESSION['ta_order_id']."' and ( tab_status='Kot_Generated'  or tab_status='Generated' or tab_status='Processing' ) "); 
            
   $date=date('Y-m-d H:i:s');     
 
   $sql_gen =  mysqli_query($localhost1,"Update tbl_qr_order_details set tq_localy_confirmed='Y' ,tq_running='N',tq_local_status_update_time='$date'  where tq_branch='".$_REQUEST['store_id']."' and tq_order_no='".$_REQUEST['order_id']."' ");  
   
   $sql_gen2 =  mysqli_query($localhost1,"Update tbl_qr_order_item set tqi_running='N' where tqi_branch='".$_REQUEST['store_id']."' and tqi_orderno='".$_REQUEST['order_id']."' ");  
   
         
 }
 
 if(isset($_REQUEST['set']) && $_REQUEST['set']=='cancel_order_qr'){
    
    $date=date('Y-m-d H:i:s');
    
     $cancel_rsn=$_REQUEST['cancel_reason'];
    
    $sql_gen =  mysqli_query($localhost1,"Update tbl_qr_order_details set tq_cancelled='Y' ,tq_cancelled_reason='$cancel_rsn',tq_cancelled_time='$date' where tq_branch='".$_REQUEST['store_id']."' and tq_order_no='".$_REQUEST['order_id']."' ");  
      
    
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='ready_order_qr'){
    
    $date=date('Y-m-d H:i:s');
    $sql_gen =  mysqli_query($localhost1,"Update tbl_qr_order_details set tq_localy_ready='Y' ,td_local_ready_time='$date' where tq_branch='".$_REQUEST['store_id']."' and tq_order_no='".$_REQUEST['order_id']."' ");  
   
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_order_search'){
    
    
    
   $string='';
   
   if($_REQUEST['order_id']!=''){
      $string.=" and  tq_order_no like '%".$_REQUEST['order_id']."%' ";
   }else{
          $string.=" ";
   }
   
    if($_REQUEST['date']!=''){
        $string.=" and  date(tq_order_time)='".$_REQUEST['date']."' ";
   }else{
          $string.=" ";
   }
   
    if($_REQUEST['module']!=''){
        $string.=" and  tq_mode='".$_REQUEST['module']."' ";
   }else{
          $string.=" ";
   }
   
   
    if($_REQUEST['status']=='Pending'){
        $string.=" and  tq_localy_confirmed='N' " ;
   }else if($_REQUEST['status']=='Confirmed'){
     
  $string.=" and  tq_localy_confirmed='Y' and tq_localy_ready!='Y' ";
  
 }else if($_REQUEST['status']=='Ready'){
   
    $string.=" and  tq_localy_confirmed='Y' and tq_localy_ready='Y' ";
    }else if($_REQUEST['status']=='Cancelled'){
        
       $string.=" and  tq_cancelled='Y' " ;    
          
      }else if($_REQUEST['status']=='Picked'){   
          
           $string.=" and  tq_order_picked='Y' and tq_localy_delivered!='Y' ";  

       }                                                 
       else if($_REQUEST['status']=='Delivered'){   
          
           $string.=" and  tq_order_picked='Y' and tq_localy_delivered='Y' ";  

       }                                           
             
   
    $i=1;

 $sql_gen =  mysqli_query($localhost1,"select * from tbl_qr_order_details where tq_branch='".$_REQUEST['branch']."'   $string "); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  { 
			while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                             ?>
                                                <tr>
                                                <td style="width:5%"><?=$i++?></td>
                                            
                                                <td onclick="order_detail_view('<?=$result_cat_s_tc['tq_order_no']?>');"   style="width:10%;cursor: pointer;"><a style="font-weight: bold;color:darkred;border: solid 1px;padding: 3px"><?=$result_cat_s_tc['tq_order_no']?></a></td>
                                                
                                                <td style="width:10%">Qr : <?=$result_cat_s_tc['tq_mode']?> </td>
                                                
                                                 <?php if($result_cat_s_tc['tq_floor']!=''){  ?>
                                                 
                                                  <td style="width:10%"><?=$result_cat_s_tc['tq_table'].' - '.$result_cat_s_tc['tq_floor']?></td>
                                                  
                                                    <?php }else{  ?>
                                                  <td  style="width:10%">TA</td>
                                                 <?php } ?>
                                                  
                                                
                                                
                                                
                                                
                                                <td style="width:15%" ><?=$result_cat_s_tc['tq_order_time']?></td>
                                                
                                                
                                                <?php if($result_cat_s_tc['tq_localy_confirmed']=='Y' && $result_cat_s_tc['tq_localy_ready']!='Y' ){  ?>
                                                <td  style="width:15%">Confirmed</td>
                                                <?php }else if($result_cat_s_tc['tq_cancelled']=='Y' && $result_cat_s_tc['tq_localy_confirmed']=='N') {  ?>
                                                 <td  style="width:15%">Cancelled</td>
                                                <?php }else if($result_cat_s_tc['tq_localy_ready']=='Y' && $result_cat_s_tc['tq_localy_confirmed']=='Y') {   ?>
                                                 <td  style="width:15%">Food Ready & Picked</td>
                                                 
                                                 <?php }else{  ?>
                                                  <td  style="width:15%">Pending</td>
                                                 <?php } ?>
                                                 
                                                 
                                                  <?php  if($result_cat_s_tc['tq_order_picked']=='Y' &&  $result_cat_s_tc['tq_localy_delivered']!='Y' ) { ?>
                                                  <td  style="width:15%">Order Picked</td>
                                                  <?php }else if($result_cat_s_tc['tq_localy_delivered']=='Y' ) { ?>
                                                
                                                  <td  style="width:15%">Delivered</td>
                                                  <?php }else{ ?>
                                                
                                                  <td  style="width:15%">Pending</td>
                                                
                                                  <?php } ?>
                                                 
                                                 
                                                 
                                                 <?php if($result_cat_s_tc['tq_floor']=='' && $result_cat_s_tc['tq_localy_ready']=='Y' && $result_cat_s_tc['tq_localy_confirmed']=='Y') {   ?>
                                                 <td  style="width:10%"><a style="border: solid 1px darkred" href="../take_away_staff_assign.php?qr_order_id=<?=$result_cat_s_tc['tq_order_no']?>">DELIVERY BOY</a></td>
                                           
                                                 <?php }else{ ?>
                                                 <td  style="width:10%">Order Not Ready</td>
                                                <?php } ?>   
                                                 
                                                 
                                                 
                                                <?php  if($result_cat_s_tc['tq_localy_ready']=='Y' && $result_cat_s_tc['tq_localy_confirmed']=='Y' && $result_cat_s_tc['tq_localy_delivered'] !='Y'   ) { ?>
                                                 
                                                 <td onclick="delivery_manual('<?=$result_cat_s_tc['tq_order_no']?>');" style="width:10%;cursor: pointer"><img src="../img/qr_delivery.png"></td>
                                                     <?php }else{ ?>
                                                 <td  style="width:10%"><img src="../img/green_tick.png"></td>
                                               
                                                <?php } ?>  
                            
                            </tr>
                            
                            
                            <?php
                                    
                                }
                                
                                }else{
                                    
                            ?>
                                            
                                            <tr>
                                                <td style="width:5%"></td>
                                                <td style="width:10%"></td>
                                                <td style="width:10%"></td>
                                                <td style="width:10%"></td>
                                                <td style="width:15%;font-weight:bold;color: darkred" >NO DATA</td>
                                                <td  style="width:15%"></td>
                                                <td  style="width:15%" ></td>
                                                <td  style="width:10%" ></td>
                                                <td  style="width:10%" ></td>
                                            </tr>        
        <?php
        }
} 

if(isset($_REQUEST['set']) && $_REQUEST['set']=='store_action_set'){
    
      $sql_gen =  mysqli_query($localhost1,"select * from tbl_cloud_menu_detail where branchid='".$_REQUEST['storeid']."'  "); 
      
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
			
     $sql_gen =  mysqli_query($localhost1,"Update tbl_cloud_menu_detail set tcd_qr_enable='".$_REQUEST['sts']."' where branchid='".$_REQUEST['storeid']."'  ");  
      echo "Update tbl_cloud_menu_detail set tcd_qr_enable='".$_REQUEST['sts']."' where branchid='".$_REQUEST['storeid']."'  ";
                  }else{
                      
                   $sql_gen =  mysqli_query($localhost1,"insert into  tbl_cloud_menu_detail(branchid,tcd_qr_enable,tcd_menu_count,tcd_order_count) values ('".$_REQUEST['storeid']."','Y','1','1')  ");      
                      
                  }
    
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=='delivery_manual'){
    
     $date=date('Y-m-d H:i:s');
     
   $sql_gen =  mysqli_query($localhost1,"Update tbl_qr_order_details set tq_localy_delivered='Y' ,tq_deliverd_time='$date' where tq_branch='".$_REQUEST['branch']."' and tq_order_no='".$_REQUEST['ord']."' ");  
      
    
}
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_qr_auto_confirm'){
    
    $sql_gen =  mysqli_query($localhost1,"select * from tbl_qr_order_details td left join tbl_qr_user_detail tc on td.tq_user = tc.tu_number "
    . "  where  td.tq_synced='Y'  and tq_localy_delivered!='Y'  and tq_cancelled!='Y' AND "
            . " tq_branch='$qr_branch' and tq_order_no='".$_REQUEST['order_in']."' order by td.tq_order_time desc"); 
       
		  $num_gen  = mysqli_num_rows($sql_gen);
		  if($num_gen)
		  {
			while($result_cat_s_tc  = mysqli_fetch_array($sql_gen)) 
			{
                            
                            $addr=$result_cat_s_tc['tu_buliding_home_name'].' , '.$result_cat_s_tc['tu_lanmark'];
                                    
                            $running=$result_cat_s_tc['tq_running'];
                             
                             $table_new='';
                             $sql_tab = "select tr_tableno from tbl_tablemaster where tr_tableid='".$result_cat_s_tc['tq_table']."'  ";
                             $sql_menus = $database->mysqlQuery($sql_tab);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) {   
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                            
                                            $table_new=$result_menus['tr_tableno'];
                                        }
                                        }
                            
                            
                                
                        echo $result_cat_s_tc['tq_delivery_charge'].'*'.$result_cat_s_tc['tq_order_time'].'*'.$result_cat_s_tc['tq_order_no'].'*'.
                        $qr_branch.'*qr_code*'.$result_cat_s_tc['tu_name'].'*'.$result_cat_s_tc['tu_number'].'*'.$addr.'*'.
                        $result_cat_s_tc['tu_lanmark'].'*'.$result_cat_s_tc['tu_area'].'*'.$result_cat_s_tc['tu_pincode'].'*'.
                        $result_cat_s_tc['tq_mode'].'*'.$result_cat_s_tc['tq_table'].'*'.$result_cat_s_tc['tq_floor'].'*'.$running.'*'.
                        $_REQUEST['order_in'].'*'.$table_new;
                                    
                        }
                        }

}

?>

         
            
         