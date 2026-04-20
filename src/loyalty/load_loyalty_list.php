<?php

session_start();
include("..\database.class.php"); 
$database	= new Database();
error_reporting(0);
require_once('../Mailer/PHPMailerAutoload.php');

if(isset($_REQUEST['set_search'])&&($_REQUEST['set_search']=="search_loyalty")){
    $string1='';
    $string="";
    $name='';
    $email='';
    $phone='';
    $bday='';
    $anvy='';
    $visit='';
    $sts='';
    $amt_spend=0;
    
$pagination=0;
$recordcount="";
if(isset($_REQUEST['pagination']))
{
$pagination= $_REQUEST['pagination'];
$recordcount=$_REQUEST['recordcount'];

}


    if($recordcount!=""){
          $i=$recordcount;
       }else{
          $i=0;
       }
    
    
    
    if($_REQUEST['type_new']!="" || $_REQUEST['name']!="" || $_REQUEST['spend']!='' || $_REQUEST['from']!='' || $_REQUEST['to']!='' || $_REQUEST['email']!="" || $_REQUEST['phone']!="" || $_REQUEST['bday']!="" || $_REQUEST['anvy']!="" || $_REQUEST['status']!="" || $_REQUEST['visit']!=""){
      
           $string.=' where ';
           $string.=' tl.ly_firstname!="" ';
     }
           $email=  trim($_REQUEST['email']);
           $name=  trim($_REQUEST['name']);
           $phone=  trim($_REQUEST['phone']);
           $bday=  trim($_REQUEST['bday']);
           $anvy=  trim($_REQUEST['anvy']);
           $visit=  trim($_REQUEST['visit']);
           $sts=  trim($_REQUEST['status']);
             
          if($_REQUEST['name']!=""){
             if(strlen($_REQUEST['name'])>2){
          $string.=" and  (tl.ly_firstname LIKE '%".$name."%' or tl.ly_lastname LIKE '%".$name."%')  ";
          }
          }
          
        if($_REQUEST['email']!=""){
             if(strlen($_REQUEST['email'])>2){
         $string.=" and tl.ly_emailid LIKE '%".$email."%' ";
          }
        }
       if($_REQUEST['phone']!=""){
               if(strlen($_REQUEST['phone'])>2){
         $string.=" and tl.ly_mobileno LIKE '%".$phone."%' ";
          }
       }
      
          if($_REQUEST['bday']!=""){
               if(strlen($_REQUEST['bday'])>2){
         $string.=" and tl.ly_birthdaydate ='".$bday."' ";
          }
       }
       if($_REQUEST['anvy']!=""){
               if(strlen($_REQUEST['anvy'])>2){
         $string.=" and tl.ly_anniversarydate ='".$anvy."' ";
          }
       }
       if($_REQUEST['status']!=""){
               
         $string.=" and tl.ly_status ='".$sts."' ";
        
       }
       if($_REQUEST['visit']!="" && $_REQUEST['visit_range']==''){
               
         $string.=" and tl.ly_totalvisit ='".$visit."' ";
       
       }
        if($_REQUEST['visit']!="" && $_REQUEST['visit_range']=='<'){
       
             $string.=" and tl.ly_totalvisit < '".$visit."' ";
        }
        
        
        if($_REQUEST['visit']!="" && $_REQUEST['visit_range']=='>'){
           
             $string.=" and tl.ly_totalvisit > '".$visit."' ";
        }
          
        
        $order=" order by ly_entrydatetime desc";
         
        if($_REQUEST['spend_type']!="" ){
           $order='';
             if($_REQUEST['spend_type']=="asc" ){
             $order.=" order by  sum(tlp.lob_bill_amount)  desc ";
             }
             
              if($_REQUEST['spend_type']=="desc" ){
             $order.="  order by  sum(tlp.lob_bill_amount)  asc ";
             }
             
        }
        
        if($_REQUEST['visit_type']!="" ){
           $order='';
             if($_REQUEST['visit_type']=="asc" ){
             $order.=" order by  tl.ly_totalvisit  desc ";
             }
             
              if($_REQUEST['visit_type']=="desc" ){
             $order.="  order by  tl.ly_totalvisit  asc ";
             }
             
        }
        
        
         if($_REQUEST['type_new']=='Spend'){
             
               $string1.="  having sum(tlp.lob_bill_amount) >0 ";
             
       if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			
			
			$string.= " and DATE(tlp.lob_date) between '".$_REQUEST['from']."' and '".$_REQUEST['to']."' ";
                       
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			
			$to=date("Y-m-d");
			$string.= " and DATE(tlp.lob_date) between '".$_REQUEST['from']."' and '". $to."' ";
                        
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			
			$string.= " and DATE(tlp.lob_date) between '".$from."' and '".$_REQUEST['to']."' ";
			
		}
                
                
         }
         
         if($_REQUEST['type_new']=='New'){
             
       if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			
			
			$string.= " and DATE(tl.ly_entrydatetime) between '".$_REQUEST['from']."' and '".$_REQUEST['to']."' ";
                       
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			
			$to=date("Y-m-d");
			$string.= " and DATE(tl.ly_entrydatetime) between '".$_REQUEST['from']."' and '". $to."' ";
                        
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			
			$string.= " and DATE(tl.ly_entrydatetime) between '".$from."' and '".$_REQUEST['to']."' ";
			
		}
                
                
         }
         
          if($_REQUEST['type_new']=='No'){
              
           
            
            if($_REQUEST['from']!="" && $_REQUEST['to']!="")
		{
			
			
			$string.= " and DATE(tlp.lob_date) between '".$_REQUEST['from']."' and '".$_REQUEST['to']."' ";
                       
		}
		else if($_REQUEST['from']!="" && $_REQUEST['to']=="")
		{
			
			$to=date("Y-m-d");
			$string.= " and DATE(tlp.lob_date) between '".$_REQUEST['from']."' and '". $to."' ";
                        
		}
		else if($_REQUEST['from']=="" && $_REQUEST['to']!="")
		{
			$from=date("Y-m-d");
			
			$string.= " and DATE(tlp.lob_date) between '".$from."' and '".$_REQUEST['to']."' ";
			
		}
            
              $string.= " and (tl.ly_totalvisit='1' or tl.ly_totalvisit='0') ";  
            
          }
                
		
                if($_REQUEST['spend']>0 && $_REQUEST['spend_range']==''){
                    $string1.="  having sum(tlp.lob_bill_amount)  = '".$_REQUEST['spend']."' ";
                }
        
                if($_REQUEST['spend']>0 && $_REQUEST['spend_range']=='<'){
                    $string1.="  having sum(tlp.lob_bill_amount)  < '".$_REQUEST['spend']."' ";
                }
                
                if($_REQUEST['spend']>0 && $_REQUEST['spend_range']=='>'){
                    $string1.="  having sum(tlp.lob_bill_amount)  > '".$_REQUEST['spend']."' ";
                }
        
      
    
                
    $loy_qry1 = $database->mysqlQuery("select tss.ser_firstname, tl.ly_id,  tl.ly_firstname,  tl.ly_lastname,  tl.ly_gender,  tl.ly_mobileno,  tl.ly_emailid,  tl.ly_birthdaydate,"
            . " tl.ly_maritalstatus,  tl.ly_anniversarydate,  tl.ly_profession, "
            . " tl.ly_totalvisit,  tl.ly_mailreceive,  tl.ly_smsreceive,  date(tl.ly_entrydatetime) as date, "
            . " tl.ly_branchid,  tl.ly_status,  tl.ly_entry_from,  tl.ly_points,  tl.ly_voucher_count,sum(tlp.lob_bill_amount) as bill_amt from tbl_loyalty_reg tl left join tbl_loyalty_pointadd_bill tlp on tl.ly_id=tlp.lob_loyalty_customer  left join tbl_staffmaster tss on tss.ser_staffid=tl.ly_loy_login   $string group by tl.ly_id $string1 $order limit ". $pagination.",100");
   
    
   
    
    
    $num_loy1 = $database->mysqlNumRows($loy_qry1);
     if($num_loy1)
     {
         while($loyalty_listing1 = $database->mysqlFetchArray($loy_qry1))
         {$i++;
         
         
         if($loyalty_listing1['ly_birthdaydate']=="0000-00-00"){
             $bday="";
         }else{
             $bday=$loyalty_listing1['ly_birthdaydate'];
         }
         
         if($loyalty_listing1['ly_anniversarydate']=="0000-00-00"){
             $anvy="";
         }else{
             $anvy=$loyalty_listing1['ly_anniversarydate'];
         }
         
          if($loyalty_listing1['bill_amt']>0){
             $amt_spend=$loyalty_listing1['bill_amt'];
         }else{
             $amt_spend='';
         }
         
       if($loyalty_listing1['ly_totalvisit']>0){
             $tot_visit=$loyalty_listing1['ly_totalvisit'];
         }else{
             $tot_visit='1';
         }
         
         
?>
<tr>
                                    <td style="min-width:130px;">
                                         <input type="checkbox" class="check_customer camp_chk_sel_cus" id_customer="<?=$loyalty_listing1['ly_id']?>">
                                    	 <a href="registration.php?loyalty_id=<?=$loyalty_listing1['ly_id']?>" class="action-btn"><span class="ti-pencil"></span></a>
                                         <a style="display:none"  href="#"  style="pointer-events: none " onclick="return delete_loyalty('<?=$loyalty_listing1['ly_id']?>');" class="action-btn"><span class="ti-trash"></span></a>
                                         <a style="display:none"  href="#" onclick="return transfer_point('<?=$loyalty_listing1['ly_id']?>','<?=$loyalty_listing1['ly_points']?>','<?=$loyalty_listing1['ly_firstname']?>')" data-toggle="modal" data-target="#transfer-popup" class="action-btn"><span  class="fa fa-mail-forward"></span></a>
                                         <a href="#" onclick="return send_popup('<?=$loyalty_listing1['ly_mobileno']?>','<?=$loyalty_listing1['ly_emailid']?>');" data-toggle="modal" data-target="#send-mail-popup" class="action-btn"><span  class="fa fa-send"></span></a>
                                         <a style="display:none"  href="loyalty_voucher_generate.php?loyalty_id=<?=$loyalty_listing1['ly_id']?>&loyalty_count=<?=$loyalty_listing1['ly_voucher_count']?>"  class="action-btn"><span  class="fa fa-credit-card"></span></a>
                                         <a href="#" onclick="return list_loyalty_bill('<?=$loyalty_listing1['ly_id']?>','<?=$loyalty_listing1['ly_firstname']?>');" class="action-btn"><span class="fa fa-usd"></span></a>
                                    </td>
                                     
                                    <td  style="min-width:35px;"><?=$i?></td>
                                    <td  style="min-width:100px;"><?=$loyalty_listing1['ly_firstname']?> <?=$loyalty_listing1['ly_lastname']?></td>
                                    <td  style="min-width:100px;"><?=$loyalty_listing1['ly_mobileno']?></td>
                                    <td  style="min-width:100px;"><?=$loyalty_listing1['ly_emailid']?></td>
                                    <td  style="min-width:100px;"><?=$amt_spend?></td>
                                    
                                    
                                    <td  style="min-width:70px;"><?=$tot_visit?></td>
                                   
                                    <?php if($loyalty_listing1['ly_status']!='Active'){ ?>
                                    <td  style="min-width:70px;color: red;font-weight: bold"><?=$loyalty_listing1['ly_status']?></td>
                                    <?php }else{ ?>
                                    <td  style="min-width:70px;color: green;font-weight: bold"><?=$loyalty_listing1['ly_status']?></td>
                                    <?php } ?>
                                   
                                    
                                    <td  style="min-width:100px;"><?=$loyalty_listing1['date']?></td>
<!--                                 <td  style="min-width:80px;"><?//=//$bday?></td>
                                    <td  style="min-width:80px;"><?//=//$anvy?></td>-->
                                    <td  style="min-width:35px;"><?=$loyalty_listing1['ly_id']?></td>
                                         
</tr>


 <div class="inv-pagination" style="position: absolute;bottom: -17px;right: 43px;">
                                         
                                        <?php 
                                        
                                        $m=0;
                                      
                                        $p=floor(($i/100)+1);
                                        ?>
                                        <a href="#" class="inv-pagination-list" value="" id="pagi0" onClick="return pagination('<?=$m?>','1');" ><strong> <i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i> </strong></a>
                                        <?php
                                        
                                        for($j=1;$j<=$p;$j++){
                                            ?>
                                       <input type="hidden" class ="pagination pagination-large" id="recordcount" value="<?=$p?>"> 
                                        <a href="#"  class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>','<?=$j?>');" ><strong><?=$j?></strong></a>
                                        <?php $m=$m+100; } $m=$m-100;?>
                                       <a href="#" class="inv-pagination-list" value="<?=$m?>" id="pagi<?=$j?>" onClick="return pagination('<?=$m?>',<?=$p?>);" ><strong> <i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i> </strong></a>
     </div>      


<?php
         }
     }else{
         ?>
<tr>
     <td  style=" color:red;text-align:center">No Matching Records</td>
</tr>
<?php
     }
}else if($_REQUEST['set']=='searchname'){ 
     $name1='';
   $name=$_REQUEST['name'];
   
   if(strlen($_REQUEST['name'])>2){
    $sql_login  =  $database->mysqlQuery("select  ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where  (ly_firstname LIKE '%".$name."%' or ly_lastname LIKE '%".$name."%') "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $id= $result_login['ly_id'];
                              $name1= $result_login['ly_firstname'].' '.$result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                             ?>

                                                             <ul>
                                                                 <li id="load_name_ul" onclick="return name_click('<?=$name1?>','<?=$id?>','<?=$num?>');" style="cursor: pointer" >
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
   
   if(strlen($_REQUEST['number'])>2){
    $sql_login  =  $database->mysqlQuery("select  ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where ly_mobileno LIKE '%".$num."%'  "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                 $id= $result_login['ly_id'];
                                 $name1= $result_login['ly_firstname']. $result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                             ?>

                                                             <ul>
                                                                 <li id="load_number_ul" onclick="return number_click('<?=$name1?>','<?=$id?>','<?=$num?>');" style="cursor: pointer" >
                                                                                                <?=$num?>    
                                                                                                </li>
                                                                                            </ul>
<?php
				  
				 
				  
			
                      
                  }
                  }
   }
	
}else if($_REQUEST['set']=='tranfer_point'){ 
     
     
      $to=$_REQUEST['to'];
      $from=$_REQUEST['from'];
      $point=$_REQUEST['point'];
      $reason=$_REQUEST['reason'];
      $date=date("Y-m-d H:i:s");
      $key=0;
       $from_point= $_REQUEST['from_point'];
      
      
       if($to!="" && $from!="" && $point!=""){
            
        $insertion['lpt_from_id'] = mysqli_real_escape_string($database->DatabaseLink,trim($from)); 
        $insertion['lpt_to_id'] 	= mysqli_real_escape_string($database->DatabaseLink,trim($to)); 
        $insertion['lpt_points']=  mysqli_real_escape_string($database->DatabaseLink,trim($point)); 
        $insertion['lpt_reason']=  mysqli_real_escape_string($database->DatabaseLink,trim($reason));
        $insertion['lpt_secret_key']=  mysqli_real_escape_string($database->DatabaseLink,trim($key));
        
        $insertion['lpt_date']=  mysqli_real_escape_string($database->DatabaseLink,trim($date));
        
        $insertid      =  $database->insert('tbl_loyalty_point_transfers',$insertion); 
        
       
       
        $query3=$database->mysqlQuery("update tbl_loyalty_reg set ly_points=ly_points-'".$point."' where ly_id='$from'"); 
        
        $query31=$database->mysqlQuery("update tbl_loyalty_reg set ly_points=ly_points+'".$point."' where ly_id='$to'"); 
        
      }
        
}

else if(isset($_REQUEST['set_point'])&&($_REQUEST['set_point']=="point_search")){
    
    $string="";
    $from='';
    $to='';
    $fromdt="";
    $todt="";
     
    if($_REQUEST['from']!="" || $_REQUEST['to']!=""){
         $string.='where ';
           $string.=' lpt_id!=""';
    }
          $from=  trim($_REQUEST['from']);
          $to=  trim($_REQUEST['to']);
           
          
           if($_REQUEST['from']!="" ){
          if(strlen($_REQUEST['from'])>2){
          $string.=" and  tl.ly_firstname LIKE '%".$from."%'  ";
          }
          }
          
          if($_REQUEST['to']!="" ){
          if(strlen($_REQUEST['to'])>2){
          $string.=" and t2.ly_firstname LIKE '%".$to."%' ";
          }
          }
    
            $fromdt=$_REQUEST['from_dt'];
            $todt=$_REQUEST['to_dt'];
            
         if($_REQUEST['from_dt']!="" && $_REQUEST['to_dt']!="")
		{
             $string.= " and  DATE(lpt_date) between '".$fromdt."' and '".$todt."' ";
         } 
             
         if($_REQUEST['from_dt']!="" && $_REQUEST['to_dt']=="")
		{
             $todt=date("Y-m-d");
             $string.= " and  DATE(lpt_date) between '".$fromdt."' and '".$todt."' ";
         }
         if($_REQUEST['from_dt']=="" && $_REQUEST['to_dt']!="")
		{
             $fromdt=date("Y-m-d");
             $string.= " and  DATE(lpt_date) between '".$fromdt."' and '".$todt."' ";
         }
         
         
     $loy_qry_level = $database->mysqlQuery("select *,t2.ly_firstname as toname,tl.ly_firstname as fromname from tbl_loyalty_point_transfers tpf left join tbl_loyalty_reg tl on tl.ly_id=tpf.lpt_from_id left join tbl_loyalty_reg t2 on t2.ly_id=tpf.lpt_to_id  $string ");
     //echo "select *,t2.ly_firstname as toname,tl.ly_firstname as fromname from tbl_loyalty_point_transfers tpf left join tbl_loyalty_reg tl on tl.ly_id=tpf.lpt_from_id left join tbl_loyalty_reg t2 on t2.ly_id=tpf.lpt_to_id  $string ";
     $num_loy_level = $database->mysqlNumRows($loy_qry_level);
     if($num_loy_level)
     { $i=0;
         while($loyalty_listing_level = $database->mysqlFetchArray($loy_qry_level))
         {
         
                      $i++;
                                ?>
                                   <tr>
                                    <td><?=$i?></td>
                                    <td><?=$loyalty_listing_level['fromname']?></td>
                                    <td><?=$loyalty_listing_level['toname']?></td>
                                   
                                    <td><?=$loyalty_listing_level['lpt_points']?></td>
                                    <td><?=$loyalty_listing_level['lpt_reason']?></td>
                                    <td><?=$loyalty_listing_level['lpt_secret_key']?></td>
                                    <td><?=$loyalty_listing_level['lpt_date']?></td>
                                    
                                    
                                </tr>
                                <?php
                             } }  
}else if (isset($_REQUEST['set'])&&($_REQUEST['set']=="bill_view_all")){
    
    ?> 
             <div class="redeem-bll-popup">
             <div class="redeem-bll-popup-head"><Strong id="name_loyalty"></Strong> Bill Details - <?=$_REQUEST['billno_loyalty']?>
                 <span style="font-size: 15px;text-align: center;float:right;padding:8px;width: 100%">Date - <?=$_REQUEST['date_bill']?></span>
                 <div class="redeem-bll-popup-cls close_list" onclick="close_list();"><img src="assets/images/close.png"></div>
                 </div>
                 <div class="redeem-bll-popup-contant">
                     <div class="card-box table-responsive" style="height: 390px">
                        	<table  id="popup-table-nn" class="table table-striped table-bordered">
                                <thead style="position:sticky;top:-11px;">
                                <tr>
                                    <th style="width: 90px;padding-top:10px;">PRODUCT</th>
                                    <th style="width: 90px;padding-top:10px;">QTY</th>
                                    <th style="width: 90px;padding-top:10px;"> RATE</th>
                                     <th style="width: 85px;padding-top:10px;"> AMOUNT</th>
                                      
                                </tr>
                                </thead>

                                <tbody >
                                    <?php
     if($_REQUEST['billno_loyalty'][0]=="D"){
         
        $tot_comb=0;
           $loy_qry11 = $database->mysqlQuery(" select  distinct(cbd.cbd_billno) as bill,cbd.cbd_combo_pack_rate,cbd.cbd_combo_total_rate,cbd.cbd_combo_qty as qty, sum(cbd.cbd_combo_total_rate) as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_billno ='".$_REQUEST['billno_loyalty']."' and bm.bm_status='Closed'
                                                    group by cbd.cbd_combo_pack_id  ");
   
    $num_loy11 = $database->mysqlNumRows($loy_qry11);
     if($num_loy11)
     {  
         while($result_billhistory_billdetails_row1 = $database->mysqlFetchArray($loy_qry11))
         {
             
             $tot_comb=$tot_comb+$result_billhistory_billdetails_row1['cbd_combo_total_rate'];
       
         ?>
                                    <tr>
                                        <td style="width: 87px">
                                            <?=$result_billhistory_billdetails_row1['menu']?>
                                          <span style="color: #f00">  [Combo] </span>
                                                         
                                        </td>
                                         <td style="width: 86px"><?=$result_billhistory_billdetails_row1['qty']?></td>
                                        <td style="width: 86px"><?=number_format($result_billhistory_billdetails_row1['cbd_combo_pack_rate'],$_SESSION['be_decimal'])?></td>
                                        <td style="width: 80px"><?=number_format($result_billhistory_billdetails_row1['cbd_combo_total_rate'],$_SESSION['be_decimal'])?></td>
                                       
                                     </tr>
                                    <?php
           }
         }
         
         
                                    $unit='';
                                    $i=0;
                                    $amount_sum=0;
                                    
     $loy_qry1 = $database->mysqlQuery("select bd.bd_menuid,bd.bd_bill_addon_slno,bd.bd_rate_type,bd.bd_unit_type,bd.bd_portion,bd.bd_unit_weight,bd.bd_unit_id,bd.bd_base_unit_id,bd.bd_rate,bd.bd_qty,bd.bd_amount,bd.bd_bill_addon_slno,
          mm.mr_menuname,mm.mr_menuid,mm.mr_itemshortcode FROM tbl_tablebilldetails bd  left join tbl_menumaster mm on mm.mr_menuid=bd.bd_menuid  where bd.bd_billno='".$_REQUEST['billno_loyalty']."' and bd.bd_count_combo_ordering IS NULL ");
   
    $num_loy1 = $database->mysqlNumRows($loy_qry1);
     if($num_loy1)
     {  
         while($result_billhistory_billdetails_row = $database->mysqlFetchArray($loy_qry1))
         {
             $billhistory_menuid=$result_billhistory_billdetails_row['mr_menuid'];
             $billhistory_menuta=$result_billhistory_billdetails_row['mr_menuname'];
             
             if($result_billhistory_billdetails_row['bd_rate_type']=='Portion'){
                                            $sql_portion_billhistory= $database->mysqlQuery("select pm_portionshortcode FROM tbl_portionmaster where pm_id='".$result_billhistory_billdetails_row['bd_portion']."'");
                                            $num_portion_billhistory  = $database->mysqlNumRows($sql_portion_billhistory);
                                            $result_portion_billhistory  = $database->mysqlFetchArray($sql_portion_billhistory);
                                            $portion="[".$result_portion_billhistory['pm_portionshortcode']."]";
                                            $unit='';
                                        }
                                        else{
                                                if($result_billhistory_billdetails_row['bd_unit_type']=='Packet'){ 
                                                        $sql_unit_billhistory= $database->mysqlQuery(" select u_name FROM tbl_unit_master  where u_id='".$result_billhistory_billdetails_row['bd_unit_id']."' ");
                                                        $num_unit_billhistory  = $database->mysqlNumRows($sql_unit_billhistory);
                                                        $result_unit_billhistory  = $database->mysqlFetchArray($sql_unit_billhistory);
                                                        
                                                        $portion='';
                                                        $unit=number_format($result_billhistory_billdetails_row['bd_unit_weight'],$_SESSION['be_decimal']).' '.$result_unit_billhistory['u_name'];
                                                        
                                                }
                                                else{
                                                    $sql_baseunit_billhistory= $database->mysqlQuery("select bu_name FROM tbl_base_unit_master where bu_id='".$result_billhistory_billdetails_row['bd_base_unit_id']."'");
                                                    $num_baseunit_billhistory  = $database->mysqlNumRows($sql_baseunit_billhistory);
                                                    $result_baseunit_billhistory  = $database->mysqlFetchArray($sql_baseunit_billhistory);
                                                
                                                    $portion='';
                                                     $unit=number_format($result_billhistory_billdetails_row['bd_unit_weight'],$_SESSION['be_decimal']).' '.$result_baseunit_billhistory['bu_name'];
                                                }
                                        }
                                        
                                        
                                        if($_SESSION['main_language']!='english'){
                                      
                                    $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$billhistory_menuid."' and ls_language='".$_SESSION['main_language']."'");
                                    
                                                      
                                    $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                    $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                    $billhistory_menuta=$result_arabmenu['lm_menu_name'];
                                   
                                    }
                                        
                                        
                                        
                                        $amount_sum=$amount_sum+$result_billhistory_billdetails_row['bd_amount'];
             
                                    ?>
                                    
                                    <tr>
                                        <td style="width: 87px"><?php if($result_billhistory_billdetails_row['bd_bill_addon_slno']!='') { ?>
                                                        <span style="color: #f00"> [AD] </span>
                                                        <?php } ?>
                                                                <?=$billhistory_menuta. $portion?>
                                                        <span style="color: darkred" class="bill_histo_gram"><?=$unit?></span>
                                        </td>
                                         <td style="width: 86px"><?=$result_billhistory_billdetails_row['bd_qty']?></td>
                                        <td style="width: 86px"><?=number_format($result_billhistory_billdetails_row['bd_rate'],$_SESSION['be_decimal'])?></td>
                                        <td style="width: 80px"><?=number_format($result_billhistory_billdetails_row['bd_amount'],$_SESSION['be_decimal'])?></td>
                                       
                                     </tr>
                                     <?php }
                                }
                                
                                $tot_new_di=$amount_sum+$tot_comb;
                          ?>
     
                                               <tr>
                                         <td style="width: 87px;font-weight: bold">Total</td>
                                         <td style="width: 86px"></td>
                                        <td style="width: 100px;font-weight: bold"></td>
                                        <td style="width: 80px;font-weight: bold"><?=number_format(str_replace(',','',$tot_new_di),$_SESSION['be_decimal'])?></td>
                                        
                                     
                                     </tr>
                                                   <?php
                                        } else{ 
                                            
                                     $tot_comb_ta=0;      
                            $sql_listall3  =  $database->mysqlQuery("select  distinct(cbd.cbd_billno) as bill,cbd.cbd_combo_pack_rate,cbd.cbd_combo_total_rate,cbd.cbd_combo_qty as qty, sum(cbd.cbd_combo_total_rate) as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_billno ='".$_REQUEST['billno_loyalty']."' and tbm.tab_status='Closed'
                                                    group by cbd.cbd_combo_pack_id "); 
	$num_listall3  = $database->mysqlNumRows($sql_listall3);
	if($num_listall3){$i=1;
		  while($row_listall3  = $database->mysqlFetchArray($sql_listall3)) 
			  {        
                      $tot_comb_ta=$tot_comb_ta+$row_listall3['cbd_combo_total_rate'];
                            ?>     
                                     
                                <tr>
                                        <td style="width: 87px">
                                                       
                                                     
                                                                <?=$row_listall3['menu']?>
                                                        <span style="color: darkred" class="bill_histo_gram">[Combo]</span>
                                        </td>
                                         <td style="width: 86px"><?=$row_listall3['qty']?></td>
                                        <td style="width: 86px"><?=number_format($row_listall3['cbd_combo_pack_rate'],$_SESSION['be_decimal'])?></td>
                                        <td style="width: 80px"><?=number_format($row_listall3['cbd_combo_total_rate'],$_SESSION['be_decimal'])?></td>
                                       
                                     </tr>      
                                     
                                     
                              <?php              
                          }
        }
                                            
                                         
                                    $unit='';
                                    $i=0;
                                    $total=0;
    $sql_listall  =  $database->mysqlQuery("SELECT *,mn.mr_menuid,mr_menuname  from tbl_takeaway_billdetails as bd LEFT JOIN tbl_menumaster as mn 	ON bd.tab_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON bd.tab_portion=pm.pm_id left join tbl_unit_master um on um.u_id=bd.tab_unit_id left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id WHERE bd.tab_billno='".$_REQUEST['billno_loyalty']."' and bd.tab_count_combo_ordering IS NULL order by bd.tab_slno "); 
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){$i=1;
		  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
			  {  
                                $billhis_portion_ta='';
                                
                                  $billhistory_menuidta=$row_listall['mr_menuid'];
                                  $billhistory_menuta=$row_listall['mr_menuname'];
                                if($row_listall['tab_rate_type']=='Portion'){
                                                $billhis_portion_ta=substr($row_listall['pm_portionname'],0,1);
                                                }
                                else if($row_listall['tab_rate_type']=='Unit'){
                                    if($row_listall['tab_unit_type']=='Packet'){
                                        $billhis_portion_ta=$row_listall['tab_unit_type'].' : '.number_format($row_listall['tab_unit_weight'],$_SESSION['be_decimal']).' '.$row_listall['u_name'];
                                    }
                                    else if($row_listall['tab_unit_type']=='Loose'){
                                        $billhis_portion_ta=$row_listall['tab_unit_type'].' : '.number_format($row_listall['tab_unit_weight'],$_SESSION['be_decimal']).' '.$row_listall['bu_name'];
                                    }
                                }
                                  if($_SESSION['main_language']!='english'){
                                      
                                    $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$billhistory_menuidta."' and ls_language='".$_SESSION['main_language']."'");
                                    
                                                      
                                    $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                    $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                    $billhistory_menuta=$result_arabmenu['lm_menu_name'];
                                   
                                    }

				 $total=$total + $row_listall['tab_amount'];
				 ?>
                                    <tr>
                                        <td style="width: 87px;font-size: 10px;font-weight: bold">
                                                       
                                                     
                                        <?=$billhistory_menuta?>
                                        <span style="color: darkred" class="bill_histo_gram"><?="[".$billhis_portion_ta."]"?></span>
                                        </td>
                                         <td style="width: 86px"><?=$row_listall['tab_qty']?></td>
                                        <td style="width: 86px"><?=number_format($row_listall['tab_rate'],$_SESSION['be_decimal'])?></td>
                                        <td style="width: 80px"><?=number_format($row_listall['tab_amount'],$_SESSION['be_decimal'])?></td>
                                       
                                     </tr>
        <?php } }
        
        
        $tot_ta=$total+$tot_comb_ta;
                                     ?>
                                     
                        <tr>
                                         <td style="width: 87px;font-weight: bold">Total</td>
                                         <td style="width: 86px"></td>
                                        <td style="width: 100px;font-weight: bold"></td>
                                        <td style="width: 80px;font-weight: bold"><?=number_format(str_replace(',','',$tot_ta),$_SESSION['be_decimal'])?></td>
                                        
                                     
                                     </tr>
                          
                                         
                                   <?php   } ?>
                                </tbody>
                            </table>
                        
                        </div>
                     
                 </div>
                 
         </div>          
           <?php
}
else if (isset($_REQUEST['set_search_bill'])&&($_REQUEST['set_search_bill']=="search_billno")){
    
    $string="";
    $billno=$_REQUEST['billno'];
    $loyid=$_REQUEST['loyid'];
    
    $from=$_REQUEST['from'];
    $to=$_REQUEST['to'];
    
    $string.=" lob_loyalty_customer='".$loyid."'";
     
    if($billno!=""){
    $string.=" and lob_billno like '%".$billno."%' ";
     }
     
     if($from!="" && $to==""){
          $string.=" and date(lob_date) ='".$from."' ";
     }
     
     if($to!="" && $from==""){
           $string.=" and date(lob_date) ='".$to."' ";
     }
     
     if($to!="" && $from!=""){
           $string.=" and date(lob_date) between '".$from."' and '".$to."' ";
     }
     
      if($to=="" && $from==""){
          
           $string.="";
     }
     
     
      $tot_redeem="";
      $tot_red_amount="";
      $tot_add_point="";
      $loy_qry1 = $database->mysqlQuery("select * from tbl_loyalty_pointadd_bill where $string");
      
    $num_loy = $database->mysqlNumRows($loy_qry1);
     if($num_loy)
     {
         while($loyalty_listing = $database->mysqlFetchArray($loy_qry1))
         {
             $tot_redeem=$tot_redeem+$loyalty_listing['lob_point_redeem'];
             $tot_red_amount=$tot_red_amount+$loyalty_listing['lob_redeem_amount'];
             $tot_add_point=$tot_add_point+$loyalty_listing['lob_point_add'];
             $bill_amt=$bill_amt+str_replace(',','',$loyalty_listing['lob_bill_amount']);
             $after_redeem=str_replace(',','',$loyalty_listing['lob_bill_amount'])-str_replace(',','',$loyalty_listing['lob_redeem_amount']);
             $after_redeem_tot=$after_redeem_tot+$after_redeem;
             
              ?>
                                <tr>
                                    <td  style="width:100px;font-size: 11px"><?=$loyalty_listing['lob_date']?></td>
                                    <td  style="width:120px;"> <a style="border:solid 1px;cursor: pointer;padding: 3px;background-color: whitesmoke;font-size: 11px"  onclick="billview('<?=$loyalty_listing['lob_billno']?>','<?=$loyalty_listing['lob_date']?>');" > <?=$loyalty_listing['lob_billno']?> </a></td>
                                    <td  style="width:120px;font-size: 11px"><?=number_format($loyalty_listing['lob_bill_amount'],$_SESSION['be_decimal'])?> </td>
                                    <td  style="width:100px;font-size: 11px"><?=number_format($loyalty_listing['lob_point_redeem'],$_SESSION['be_decimal'])?></td>
                                    <td  style="width:100px;font-size: 11px"><?=number_format($loyalty_listing['lob_point_add'],$_SESSION['be_decimal'])?></td>
                                    <td  style="width:120px;font-size: 11px"><?=number_format($loyalty_listing['lob_redeem_amount'],$_SESSION['be_decimal'])?></td>
                                    <td  style="width:120px;font-size: 11px"><?=number_format($after_redeem,$_SESSION['be_decimal'])?></td>
                                   
                                   
                                </tr>
              <?php }
                                     ?>
                                     <tr>
                                         <td style="width: 120px;font-weight: bold;font-size: 11px">Total</td>
                                         <td style="width: 120px;font-size: 11px"><?=number_format($bill_amt,$_SESSION['be_decimal'])?></td>
                                        <td style="width: 100px;font-weight: bold;font-size: 11px"><?=$tot_redeem?> </td>
                                        <td style="width: 100px;font-weight: bold;font-size: 11px"><?=$tot_add_point?></td>
                                        <td style="width: 120px;font-weight: bold;font-size: 11px"><?=number_format($tot_red_amount,$_SESSION['be_decimal'])?></td>
                                        <td style="width: 120px;font-size: 11px"><?=number_format($after_redeem_tot,$_SESSION['be_decimal'])?></td>
                                         <td style="width: 100px;font-size: 11px"></td>
                                     
                                     </tr>
                                     
                                     
                                     <?php
                                     
                                     
                                     
         }else{ ?>
                                     <tr>
                                         <td style="width: 190px"></td>
                                         <td style="width: 65px"></td>
                                        <td style="width: 150px;color:red"> No Records</td>
                                        <td style="width: 100px"></td>
                                        <td style="width: 130px"></td>
                                        <td style="width: 120px"></td>
                                        <td style="width: 120px"></td>
                                     
                                     </tr>
                                     <?php } ?>
                                
                                
<?php }
else if (isset($_REQUEST['set_point_dashboard'])&&($_REQUEST['set_point_dashboard']=="dashboard_show")){

    $loy_qry121 = $database->mysqlQuery("select *   from tbl_loyalty_pointadd_bill tpl left join tbl_loyalty_reg tl on tl.ly_id=tpl.lob_loyalty_customer order by lob_date desc limit 5");
    $num_loy21 = $database->mysqlNumRows($loy_qry121);
     if($num_loy21)
     {
         while($loyalty_listing21 = $database->mysqlFetchArray($loy_qry121))
         { 
           $date_time=$loyalty_listing21['lob_date'];
           $name=$loyalty_listing21['ly_firstname'].' '.$loyalty_listing21['ly_lastname'];
           $points_redeem=$loyalty_listing21['lob_point_redeem']." points redeemed";
           $point_add=$loyalty_listing21['lob_point_add']." points added";
             $id=$loyalty_listing21['ly_id'];
             $redeem_amont_add=$loyalty_listing21['lob_redeem_amount']." redeemed amount";
?>
                                     
                     <div class="timeline-2">
                        <div class="time-item">
		         <div class="item-info">
		         <div class="text-muted"><small><?=$date_time?></small></div>
                         <p><strong><a onclick="return list_loyalty_bill('<?=$id?>');" href="#" class="text-info"><?=$name?></a></strong> </p>
                           <p><strong><a href="#" class="text-info"> </a></strong> <?php if($point_add>0) { echo $point_add ; } ?> </p>
                          <p><strong><a href="#" class="text-info"></a></strong> <?php if($points_redeem>0) { echo $points_redeem;  } ?> </p>
                           <p><strong><a href="#" class="text-info"> </a></strong> <?php if($redeem_amont_add>0) { echo $redeem_amont_add ; } ?> </p>
		           </div>
		            </div>
		            </div>
                                      <?php
         }
     }
           
     
     
                                      
  } else if (isset($_REQUEST['set_camp_msg'])&&($_REQUEST['set_camp_msg']=="msg_camp")){
             
          $string='';
          
          if($_REQUEST['name_camp']){
              $string.=" and ly_firstname like  '%".$_REQUEST['name_camp']."%'  ";
          }
             
             if($_REQUEST['number_camp']){
              $string.=" and ly_mobileno like  '%".$_REQUEST['number_camp']."%'  ";
          }
          
          if($_REQUEST['mail_camp']){
              $string.=" and ly_emailid like  '%".$_REQUEST['mail_camp']."%'  ";
          }
             
              $loy_qry_reward = $database->mysqlQuery("select  ly_id,ly_firstname,ly_mobileno,ly_lastname,ly_emailid from tbl_loyalty_reg where ly_status='Active' $string ");
    $num_loy_reward = $database->mysqlNumRows($loy_qry_reward);
     if($num_loy_reward)
     {
         while($loyalty_listing_reward = $database->mysqlFetchArray($loy_qry_reward))
          {
                                ?>
                                     
                                     <tr>
                                        <td style="min-width:150px;">
                                            <input id="check_one" onclick="singleclick()" class="camp_chk camp_chk_sel singlecheck" name="<?=$loyalty_listing_reward['ly_firstname']?>"  mobile="<?=$loyalty_listing_reward['ly_mobileno']?>" mail="<?=$loyalty_listing_reward['ly_emailid']?>" type="checkbox">
                                            <span><?=$loyalty_listing_reward['ly_firstname']?></span>
                                        </td>
                                        <td style="min-width:100px;"><?=$loyalty_listing_reward['ly_mobileno']?></td>
                                        <td style="min-width:150px;"><?=$loyalty_listing_reward['ly_emailid']?></td>
                                      </tr>
                                     
     <?php } }
             
               ?>
             <script src="loyalty_js/loy.js"></script>
               <?php
         }
         
 else if (isset($_REQUEST['set_reward_sms_mail_campaign'])&&($_REQUEST['set_reward_sms_mail_campaign']=="sms_mail_campaign")){
        
       
        $nameall=$_REQUEST['nameall'];
        $smson=$_REQUEST['smson'];
        $mailon=$_REQUEST['mailon'];
        
        $condent=$_REQUEST['condent'];
        
        $group=$_REQUEST['group'];
        
        $campaign_id=$_REQUEST['campaign_id'];
        
        $from_cp=$_REQUEST['from_date_coupon'];
        $to_cp=$_REQUEST['to_date_coupon'];
               
        
        
       
        if($group!=''){
            
     $all_ams1=  array();
     $all_mail1=  array();
     $all_code1=  array();
     $code_used=array();
    $loy_qry_reward = $database->mysqlQuery("select gp.tgp_code_active,gp.tgp_groupcode,ly.ly_mobileno,ly.ly_emailid from tbl_loyalty_reg ly left join tbl_loyalty_group_details gp on gp.tgp_customerid=ly.ly_id where gp.tgp_groupid='".$group."' ");
    $num_loy_reward = $database->mysqlNumRows($loy_qry_reward);
     if($num_loy_reward)
     {
         while($loyalty_listing_reward = $database->mysqlFetchArray($loy_qry_reward))
          {
        $all_ams1[]=$loyalty_listing_reward['ly_mobileno'];
        $all_mail1[]=$loyalty_listing_reward['ly_emailid'];
         $all_code1[]=$loyalty_listing_reward['tgp_groupcode'];
         $code_used[]=$loyalty_listing_reward['tgp_code_active'];
         }
         
        $all_ams=implode (",",$all_ams1);
        
        $all_mail=implode (",",$all_mail1); 
        
      
        //$all_code=implode (",",$all_code1); 
        
        
        for($o=0;$o<count($all_code1);$o++){
          
           if($smson=="Y" && $code_used[$o]=='Y'){
            
              
	
		
		$message=$condent." .Your Coupon code to Redeem Amount is ".$all_code1[$o].". Coupon Valid from ".$from_cp." to ".$to_cp.".";
                $number=$all_ams;
		
		
		
               
      $print=$database->dynamic_sms_api($number,$message);
              
        } 
          
        
        
        if($mailon=='Y' && $code_used[$o]=='Y'){
          
                  $sql_general =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
		  $num_general  = $database->mysqlNumRows($sql_general);
		  if($num_general)
		  {
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
						 $be_mail_server			=$result_general['be_mail_server'];
						 $be_mail_port				=$result_general['be_mail_port'];
						 $be_mail_emailid			=$result_general['be_mail_emailid'];
						 $be_mail_password			=$result_general['be_mail_password'];
						 $be_mail_secure			=$result_general['be_mail_secure'];
						 $be_mail_from			         =$result_general['be_mail_from'];
					}
		  }
                  
	       
		 
                
                
		$string=$condent." .Your Coupon Code to Redeeem Amount is ".$all_code1[$o].". Coupon Valid from ".$from_cp." to ".$to_cp.".";
		
		$mailtext_o = stripslashes($string);
		$mailtext = preg_replace("|\n|","<br>","$mailtext_o");
		
	$mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->SMTPSecure = $be_mail_secure;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );        
       
        $from_name="Expodine";      
        $mail->Host = $be_mail_server;
        $mail->SMTPAuth = true;
        $mail->Username = $be_mail_emailid;
        $mail->Password = $be_mail_password;
        $mail->Port = $be_mail_port;
        $mail->SetFrom($be_mail_from,$from_name);
        $mail->Subject = "EXPODINE";
        $mail->Body = $mailtext;
         
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $emls=explode(",",$all_mail1[$o]);
        
		  $ctem=count($emls);
                  
                
                
		  if($ctem==0)
		  {
		  $mail->AddAddress($all_mail[$o]);
		  }else
		  {
		  for($k=0;$k<$ctem;$k++)
		  {
                  $mail->AddAddress($emls[$k]);
		  }
		  }   
        
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent.';
          
        }
            
        }
           
           
        }
        
        
     }  
      $query3=$database->mysqlQuery("update tbl_loyalty_group_details set tgp_campaign_id='".$campaign_id."' where tgp_groupid='".$group."' "); 
        }else{
            
        $all_ams=$_REQUEST['all_sms'];
        $all_mail=$_REQUEST['all_mail'];
        
        if($smson=="Y"){
            
                $sms_number='';
		$sms_text="";
		$be_sms_username="";
		$be_sms_apipassword="";
		$be_sms_senderid="";
                $be_sms_domainid="";
                $be_sms_method='';
                $be_sms_priority='';
	        $sql_general =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
		$num_general  = $database->mysqlNumRows($sql_general);
		if($num_general)
		{
		 		while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
					     $be_sms_username			=$result_general['be_sms_username'];
					     $be_sms_apipassword		=$result_general['be_sms_apipassword'];
				             $be_sms_senderid			=$result_general['be_sms_senderid'];
		                             $be_sms_domainid			=$result_general['be_sms_domainid'];
                                             $be_sms_priority                   =$result_general['be_sms_priority'];                                                                                                           $be_sms_priority			=$result_general['be_sms_priority'];
                                             $be_sms_method                     =$result_general['be_sms_method'];                                                                                                              $be_sms_method			        =$result_general['be_sms_method'];
                                                 
                                        }
		}
		
		$sms_text=$condent;
                $sms_number=$all_ams;
		
		$api_password=$be_sms_apipassword;
		$smstype = $be_sms_method; 
                $username=urlencode($be_sms_username);
		$sender=urlencode($be_sms_senderid);
		$message=urlencode($sms_text);
		$domain=urlencode($be_sms_domainid);
                $route=urlencode($be_sms_priority);
		
                
                
                 $parameters="username=$username&api_password=$api_password&sender=$sender&to=$sms_number&priority=$route&message=$message";
                
                
              $fp = fopen("http://$domain/pushsms.php?$parameters", "r");
                
                
		$response = stream_get_contents($fp);
		fpassthru($fp);
		fclose($fp);
              
        } 
          
        
        
        if($mailon=='Y'){
          
                  $sql_general =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
		  $num_general  = $database->mysqlNumRows($sql_general);
		  if($num_general)
		  {
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
						 $be_mail_server			=$result_general['be_mail_server'];
						 $be_mail_port				=$result_general['be_mail_port'];
						 $be_mail_emailid			=$result_general['be_mail_emailid'];
						 $be_mail_password			=$result_general['be_mail_password'];
						 $be_mail_secure			=$result_general['be_mail_secure'];
						 $be_mail_from			         =$result_general['be_mail_from'];
					}
		  }
                  
	       
		 
                
                
		$string=$condent;
		
		$mailtext_o = stripslashes($string);
		$mailtext = preg_replace("|\n|","<br>","$mailtext_o");
		
	$mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->SMTPSecure = $be_mail_secure;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );        
       
        $from_name="Expodine";      
        $mail->Host = $be_mail_server;
        $mail->SMTPAuth = true;
        $mail->Username = $be_mail_emailid;
        $mail->Password = $be_mail_password;
        $mail->Port = $be_mail_port;
        $mail->SetFrom($be_mail_from,$from_name);
        $mail->Subject = "EXPODINE";
        $mail->Body = $mailtext;
         
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $emls=explode(",",$all_mail);
        
		  $ctem=count($emls);
                  
                
                
		  if($ctem==0)
		  {
		  $mail->AddAddress($all_mail);
		  }else
		  {
		  for($k=0;$k<$ctem;$k++)
		  {
                  $mail->AddAddress($emls[$k]);
		  }
		  }   
        
        if (!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent.';
          
        }
            
        }
        
        }
       
        
         
    }
    else if(isset($_REQUEST['set_group_customer_add'])&&($_REQUEST['set_group_customer_add']=="group_customer_add")){
        $groupid=$_REQUEST['groupid'];
        $customerid=explode(',',$_REQUEST['customer']);
        $date=date('Y-m-d H:i:s');
        //echo $date;
        
        
       $rand_start = rand(1000,10000);
        
        
       
        for($i=0;$i<count($customerid);$i++){
            
            $sql_general =  $database->mysqlQuery("Select * from tbl_loyalty_group_details where tgp_groupid='$groupid' and tgp_customerid='$customerid[$i]'  "); 
		$num_general  = $database->mysqlNumRows($sql_general);
		if($num_general<1)
		{
            echo 'ok';
             $rand_start1 = $rand_start.$customerid[$i];
            
        $insertion['tgp_groupid'] = mysqli_real_escape_string($database->DatabaseLink,trim($groupid)); 
        $insertion['tgp_customerid'] 	= mysqli_real_escape_string($database->DatabaseLink,trim($customerid[$i])); 
        $insertion['tgp_datetime']=  mysqli_real_escape_string($database->DatabaseLink,trim($date)); 
         $insertion['tgp_groupcode']=  mysqli_real_escape_string($database->DatabaseLink,trim($rand_start1)); 
         $insertion['tgp_campaign_id']=  mysqli_real_escape_string($database->DatabaseLink,trim('0')); 
        $insertid      =  $database->insert('tbl_loyalty_group_details',$insertion); 
         }
        }
               
        
    }
    
    
    
    else if(isset($_REQUEST['set_group_view'])&&($_REQUEST['set_group_view']=="group_view")){
        
        $grp='';
        
        $grp.=" tgd.tgp_groupid = '".$_REQUEST['groupid']."' ";
        
        if($_REQUEST['number_camp']!=''){
       $grp.=" and lg.ly_mobileno like '%".$_REQUEST['number_camp']."%' ";
        }
        
         if($_REQUEST['name_camp']!=''){
         $grp.=" and lg.ly_firstname like '%".$_REQUEST['name_camp']."%' ";
         }
         
          if($_REQUEST['mail_camp']!=''){
           $grp.=" and lg.ly_emailid like '%".$_REQUEST['mail_camp']."%' ";
          }
                  $i=0;             
    $loy_qry_reward = $database->mysqlQuery("select * from tbl_loyalty_group_details tgd left join tbl_loyalty_reg lg on lg.ly_id=tgd.tgp_customerid where  $grp and  lg.ly_id!='' ");
   
    
    $num_loy_reward = $database->mysqlNumRows($loy_qry_reward);
     if($num_loy_reward)
     {
         while($loyalty_listing_reward = $database->mysqlFetchArray($loy_qry_reward))
         {
             $i++;
            
                                ?>
                                     <tr>
                                         <td><?=$i?></td>
                                 	<td  style="min-width:100px;">
                                            
                                 	<?=$loyalty_listing_reward['ly_firstname']?>
                                            
                                 	</td>
					<td  style="min-width:150px;"><?=$loyalty_listing_reward['ly_mobileno']?></td>
                                	<td  style="min-width:150px;"><?=$loyalty_listing_reward['ly_emailid']?></td>
                                	
     <?php } }
     
     ?>
                          </tr> 
                          <tr><td> <strong>Total Customers : <?=$i?></strong> </td>
                          </tr>
                          <?php
    }
    
        else if(isset($_REQUEST['set_camp_view'])&&($_REQUEST['set_camp_view']=="camp_view")){
        
        $grp='';
        
        $grp.=" tgd.tgp_campaign_id = '".$_REQUEST['groupid']."' ";
        
        if($_REQUEST['number_camp']!=''){
       $grp.=" and lg.ly_mobileno like '%".$_REQUEST['number_camp']."%' ";
        }
        
         if($_REQUEST['name_camp']!=''){
         $grp.=" and lg.ly_firstname like '%".$_REQUEST['name_camp']."%' ";
         }
         
          if($_REQUEST['mail_camp']!=''){
           $grp.=" and lg.ly_emailid like '%".$_REQUEST['mail_camp']."%' ";
          }
          
         
          if($_REQUEST['coupon_status']=='Y'){
           $grp.=" and tgd.tgp_code_active = 'Y' ";
          }else{
              $grp.=" and tgd.tgp_code_active = 'N' ";
          }
          
     $i=0;     
    $loy_qry_reward = $database->mysqlQuery("select * from tbl_loyalty_group_details tgd left join tbl_loyalty_reg lg on lg.ly_id=tgd.tgp_customerid left join tbl_loyalty_campaign tl on tl.lc_id=tgd.tgp_campaign_id where  $grp ");
   
    
    $num_loy_reward = $database->mysqlNumRows($loy_qry_reward);
     if($num_loy_reward)
     {
         while($loyalty_listing_reward = $database->mysqlFetchArray($loy_qry_reward))
         {
            $i++;
            
                                ?>
                                     <tr>
                                        
                                 	<td  style="min-width:100px;">
                                            
                                 	<?=$loyalty_listing_reward['ly_firstname']?>
                                            
                                 	</td>
					<td  style="min-width:150px;"><?=$loyalty_listing_reward['ly_mobileno']?></td>
                                	<td  style="min-width:150px;"><?=$loyalty_listing_reward['ly_emailid']?></td>
                                        <?php if($loyalty_listing_reward['tgp_code_active']=='Y'){ ?>
                                          <td>Coupon Active</td>                                	
                                        <?php } else{ ?>
                                           <td>Coupon Inactive</td>    
                                              <?php }  ?>
                                           
                                           
     <?php } }
     
     ?>
                          </tr> 
                            <?php if($_REQUEST['coupon_status']=='Y'){ ?>
                          <tr><td> <strong> Active Coupons : <?=$i?></strong> </td>
                              <?php } else{ ?>
                              <tr><td> <strong>Inactive coupons: <?=$i?></strong> </td>
                                  <?php }  ?>
                          </tr>
                          <?php
    }
    else if(isset($_REQUEST['set_group_view1'])&&($_REQUEST['set_group_view1']=="group_view1")){
        
        $grp1='';
        
        $grp1.=" tgd.tgp_groupid = '".$_REQUEST['groupid1']."' ";
                      
    $loy_qry_reward = $database->mysqlQuery("select * from tbl_loyalty_group_details tgd left join tbl_loyalty_reg lg on lg.ly_id=tgd.tgp_customerid where  $grp1 ");
    //echo "select * from tbl_loyalty_group_details tgd left join tbl_loyalty_reg lg on lg.ly_id=tgd.tgp_customerid where  $grp1 ";
    $num_loy_reward = $database->mysqlNumRows($loy_qry_reward);
     if($num_loy_reward)
     {
         while($loyalty_listing_reward1 = $database->mysqlFetchArray($loy_qry_reward))
         {
           
                 ?>
                                    
                                        <tr>
                                        <td style="min-width:150px;">
                                            
                                        <span><?=$loyalty_listing_reward1['ly_firstname']?></span>
                                       
                                        </td>
                                        <td style="min-width:100px;"><?=$loyalty_listing_reward1['ly_mobileno']?></td>
                                        <td style="min-width:150px;"><?=$loyalty_listing_reward1['ly_emailid']?></td>
                                      </tr>
                         
     <?php } }
                       
                        
    }
    
   else if(isset($_REQUEST['value']) && $_REQUEST['value']=='camp_graph'){
    
       $id=$_REQUEST['camp_id'];
       
       
 $sql_steward =  $database->mysqlQuery(" select count(tgp_code_active) as inactive  from tbl_loyalty_group_details where tgp_campaign_id='".$id."' and  tgp_code_active='N' ");
  
        $num_steward = $database->mysqlNumRows($sql_steward);
        if($num_steward){
            while($result_steward = $database->mysqlFetchArray($sql_steward)){
               
               echo $result_steward['inactive'].'*';
               
            }
        }
   
       
        $sql_steward1 =  $database->mysqlQuery(" select count(tgp_code_active) as active  from tbl_loyalty_group_details where tgp_campaign_id='".$id."' and  tgp_code_active='Y' ");
  
        $num_steward1 = $database->mysqlNumRows($sql_steward1);
        if($num_steward1){
            while($result_steward1 = $database->mysqlFetchArray($sql_steward1)){
               
               echo $result_steward1['active'];
               
            }
        }
        
        
        
        
    }
    
    
    else if(isset($_REQUEST['value']) && $_REQUEST['value']=='camp_graph_bar'){
    
       $id=$_REQUEST['camp_id_bar'];
       $analyticsarr = array();
       $sales=array();
    
 $sql_steward =  $database->mysqlQuery(" select count(tgp_id) as visit ,DATE(tgp_bill_date_time) as date,sum(tgp_coupon_amount) as coupon_amt,sum(tgp_bill_amount) as bill_amt   from tbl_loyalty_group_details where tgp_campaign_id='".$id."' and  tgp_code_active='N' and tgp_coupon_amount >0 group by DATE(tgp_bill_date_time) asc limit 7  ");
 //echo "select count(tgp_id) as visit ,DATE(tgp_bill_date_time) as date,sum(tgp_coupon_amount) as coupon_amt,sum(tgp_bill_amount) as bill_amt   from tbl_loyalty_group_details where tgp_campaign_id='".$id."' and  tgp_code_active='N' and tgp_coupon_amount >0 group by tgp_bill_date_time limit 7";
        $num_steward = $database->mysqlNumRows($sql_steward);
       
        if($num_steward){
            while($result_steward1 = $database->mysqlFetchArray($sql_steward)){
              
                   

                    $analyticsarr['Date'] =$result_steward1['date'];
                    $analyticsarr['Spend']  = $result_steward1['bill_amt'];
                    $analyticsarr['Coupon'] =$result_steward1['coupon_amt'];
                    $analyticsarr['Visits']  = $result_steward1['visit'];


                    if(count($analyticsarr)>0)
                    {
                        $sales[] = (object)$analyticsarr;
                    }
                }
          
        }
        
      echo json_encode($sales); 
    }
     else if(isset($_REQUEST['value']) && $_REQUEST['value']=='loy_id_check_module'){
         $sql_steward =  $database->mysqlQuery(" select  ly_firstname from tbl_loyalty_reg where ly_id='".$_REQUEST['id_check']."' ");
  
        $num_steward = $database->mysqlNumRows($sql_steward);
        if($num_steward){
            echo 'Yes';
        }else{
            echo 'No';
        }
     }
     
  else if(isset($_REQUEST['value']) && $_REQUEST['value']=='loyalty_list_bill_general_data'){
      
    $loy_qry12 = $database->mysqlQuery("select tl.ly_firstname,tl.ly_lastname,tl.ly_emailid,tlp.lob_billno,tl.ly_entrydatetime,tl.ly_mobileno,tl.ly_totalvisit,tl.ly_points,sum(tlp.lob_bill_amount) as tot_bill_amount from tbl_loyalty_reg tl left join tbl_loyalty_pointadd_bill tlp on tlp.lob_loyalty_customer=tl.ly_id  where ly_id='".$_REQUEST['loy_id_list']."'");
    $num_loy2 = $database->mysqlNumRows($loy_qry12);
     if($num_loy2)
     {
         while($loyalty_listing2 = $database->mysqlFetchArray($loy_qry12))
         {
           $total_points=$loyalty_listing2['ly_points'];
           $tot_amount_tillnow=number_format($loyalty_listing2['tot_bill_amount'],$_SESSION['be_decimal']);
           $visit=$loyalty_listing2['ly_totalvisit'];
           $num=$loyalty_listing2['ly_mobileno'];
           $joined=$loyalty_listing2['ly_entrydatetime'];
           $mail=$loyalty_listing2['ly_emailid'];
           $name_all=$loyalty_listing2['ly_firstname'].' '.$loyalty_listing2['ly_lastname'];
         }
         }
         
         
         ?>
                                      <tr>
                            <td style="text-transform: uppercase;background-color: #c6e8c2;font-weight: bold" ><?=$name_all?></td>
                            <td><?=$num?></td>
                            <td><?=$mail?></td>
                            <td><?=$joined?></td>
                            <td><?=$visit?></td>
                            <td><?=$total_points?></td>
                            <td><?=$tot_amount_tillnow?></td>
                        </tr>
                        <?php
         
         
         
         
       }
       
       
     else if(isset($_REQUEST['value']) && $_REQUEST['value']=='loyalty_list_bill_fav_data'){
         
         $billnos=  array();                      
    $loy_qry112 = $database->mysqlQuery("select lob_billno from tbl_loyalty_pointadd_bill  where lob_loyalty_customer ='".$_REQUEST['loy_id_list']."' and lob_mode='DI' ");
    $num_loy12 = $database->mysqlNumRows($loy_qry112);
     if($num_loy12)
     {
         while($loyalty_listing21 = $database->mysqlFetchArray($loy_qry112))
         {
          
           $billnos[]="'".$loyalty_listing21['lob_billno']."'";
             
     }
     }   
     
    $allbill=implode(',',$billnos);
    if($allbill==""){
        $allbill='null';
    }
    
    $billnos1=  array();                      
    $loy_qry1121 = $database->mysqlQuery("select lob_billno from tbl_loyalty_pointadd_bill  where lob_loyalty_customer ='".$_REQUEST['loy_id_list']."' and lob_mode!='DI' ");
    $num_loy121 = $database->mysqlNumRows($loy_qry1121);
     if($num_loy121)
     {
         while($loyalty_listing211 = $database->mysqlFetchArray($loy_qry1121))
         {
          
           $billnos1[]="'".$loyalty_listing211['lob_billno']."'";
             
     }
     }   
     
     $allbill1=implode(',',$billnos1);
    if($allbill1==""){
        $allbill1='null';
    }
                
     $all_menu_combo=  array();  
    
    $loy_qry11223 = $database->mysqlQuery("select sum(x.qty) as qty, x.menu as menu, sum(x.total) as total   from( 
                                                    select bd.bd_billno as bill, sum(bd.bd_qty) as qty,sum(bd.bd_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionname,''),COALESCE(REPLACE(bd.bd_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_tablebilldetails bd
                                                    LEFT  join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = bd.bd_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=bd.bd_portion
                                                    left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                                    where bd.bd_count_combo_ordering IS NULL and bd.bd_billno in ($allbill) and bm.bm_status='Closed'
                                                    group by bd.bd_menuid, bd.bd_portion, bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_billno in ($allbill) and bm.bm_status='Closed'
                                                    group by cbd.cbd_combo_pack_id union all

                                                    select tbd.tab_billno as bill, sum(tbd.tab_qty) as qty,sum(tbd.tab_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionname,''),COALESCE(REPLACE(tbd.tab_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_takeaway_billdetails tbd
                                                    LEFT  join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = tbd.tab_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=tbd.tab_portion
                                                    left join  tbl_unit_master um on um.u_id=tbd.tab_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
                                                    where tbd.tab_count_combo_ordering IS NULL and tbm.tab_billno in ($allbill1) and tbm.tab_status='Closed'
                                                    group by tbd.tab_menuid, tbd.tab_portion, tbd.tab_unit_id, tbd.tab_base_unit_id,tbd.tab_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,sum(cbd.cbd_combo_qty) as qty, sum(cbd.cbd_combo_total_rate) as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_billno in ($allbill1) and tbm.tab_status='Closed'
                                                    group by cbd.cbd_combo_pack_id )
                                                    x group by x.menuid order by qty desc LIMIT 0,5");
    
    
    $num_loy12223 = $database->mysqlNumRows($loy_qry11223);
     if($num_loy12223)
     {
         while($loyalty_listing2123 = $database->mysqlFetchArray($loy_qry11223))
         {
          $all_menu_combo[]= $loyalty_listing2123['menu']." ";  
             
     }
      $all_menu_combo_show=implode(' *  * ',$all_menu_combo); 
     } 
     
     ?> 
                       <tr>
                            <td> 
                                <?=$all_menu_combo_show?>
                            </td>
                           
                        </tr>
                        <?php 
     }
     
     
     else if(isset($_REQUEST['value']) && $_REQUEST['value']=='loyalty_list_bill_bill_data'){
         
     
        //var data2="value=loyalty_list_bill_bill_data&loy_id_list="+id_bill+"&bill_loy="+billno_src+"&from_loy="+from_src+"&to_loy="+to_src;
        
        $string='';
        
        if(strlen($_REQUEST['bill_loy'])>2){
            
        $string.=" and lob_billno like '%".$_REQUEST['bill_loy']."%' ";
        }
        
        
       
        
        if($_REQUEST['from_loy']!="" && $_REQUEST['to_loy']!="")
		{
			
			$string.= " and DATE(lob_date) between '".$_REQUEST['from_loy']."' and '".$_REQUEST['to_loy']."' ";
                        
		}
		else if($_REQUEST['from_loy']!="" && $_REQUEST['to_loy']=="")
		{
			
			$to=date("Y-m-d");
			$string.= " and DATE(lob_date) between '".$_REQUEST['from_loy']."' and '".$to."' ";
                       
                               
		}
		else if($_REQUEST['from_loy']=="" && $_REQUEST['to_loy']!="")
		{
			$from=date("Y-m-d");
			
			$string.= " and DATE(lob_date) between '".$from."' and '".$_REQUEST['to_loy']."' ";
                        
		}
		
        
        
        
        
         
     $tot_redeem="";
     $tot_red_amount="";
     $tot_add_point="";
     $loy_qry1 = $database->mysqlQuery("select * from tbl_loyalty_pointadd_bill where lob_loyalty_customer='".$_REQUEST['loy_id_list']."' $string");
   //echo "select * from tbl_loyalty_pointadd_bill where lob_loyalty_customer='".$_REQUEST['loy_id_list']."' $string";
     $num_loy = $database->mysqlNumRows($loy_qry1);
     if($num_loy)
     {
         while($loyalty_listing = $database->mysqlFetchArray($loy_qry1))
         {
             $tot_redeem=$tot_redeem+$loyalty_listing['lob_point_redeem'];
             $tot_red_amount=$tot_red_amount+$loyalty_listing['lob_redeem_amount'];
             $tot_add_point=$tot_add_point+$loyalty_listing['lob_point_add'];
             $bill_amt=$bill_amt+str_replace(',','',$loyalty_listing['lob_bill_amount']);
             $after_redeem=str_replace(',','',$loyalty_listing['lob_bill_amount'])-str_replace(',','',$loyalty_listing['lob_redeem_amount']);
             $after_redeem_tot=$after_redeem_tot+$after_redeem;
             
                                ?>
                                <tr>
                                   
                                    <td  style="width:120px;"> <a style="border:solid 1px;cursor: pointer;padding: 3px;background-color: whitesmoke"  onclick="billview('<?=$loyalty_listing['lob_billno']?>','<?=$loyalty_listing['lob_date']?>');" > <?=$loyalty_listing['lob_billno']?> </a></td>
                                    <td  style="width:120px;"><?=number_format($loyalty_listing['lob_bill_amount'],$_SESSION['be_decimal'])?> </td>
                                    <td  style="width:100px;"><?=$loyalty_listing['lob_point_redeem']?></td>
                                    <td  style="width:100px;"><?=$loyalty_listing['lob_point_add']?></td>
                                    <td  style="width:120px;"><?=number_format($loyalty_listing['lob_redeem_amount'],$_SESSION['be_decimal'])?></td>
                                    <td  style="width:120px;"><?=number_format($after_redeem,$_SESSION['be_decimal'])?></td>
                                    <td  style="width:100px;"><?=$loyalty_listing['lob_date']?></td>
                                   
                                </tr>
                                     <?php
                                      }
                                     ?>
                                     <tr>
                                         <td style="width: 120px;font-weight: bold">Total</td>
                                         <td style="width: 120px"><?=number_format($bill_amt,$_SESSION['be_decimal'])?></td>
                                        <td style="width: 100px;font-weight: bold"><?=$tot_redeem?> </td>
                                        <td style="width: 100px;font-weight: bold"><?=$tot_add_point?></td>
                                        <td style="width: 120px;font-weight: bold"><?=number_format($tot_red_amount,$_SESSION['be_decimal'])?></td>
                                        <td style="width: 120px"><?=number_format($after_redeem_tot,$_SESSION['be_decimal'])?></td>
                                         <td style="width: 100px"></td>
                                     
                                     </tr>
                                     
                               <?php
                                        
                               }else{ 
                                 ?>
                                     
                                     <tr>
                                         <td style="width: 190px"></td>
                                         <td style="width: 65px"></td>
                                        <td style="width: 150px"> </td>
                                        <td style="width: 100px;color:red">No Records</td>
                                        <td style="width: 130px"></td>
                                        <td style="width: 120px"></td>
                                        <td style="width: 120px"></td>
                                     
                                     </tr>
                                     
                                     <?php }  ?>
       <?php    
     }else if(isset($_REQUEST['value']) && $_REQUEST['value']=='reset_loy_cutomer_load'){
         
     $loy_max_id=0;
     $loy_qry1 = $database->mysqlQuery("update tbl_loyalty_reg set ly_default='N', ly_module='', ly_customer_table='',ly_customer_floor=''  ");
         
         
    $loy_qry12 = $database->mysqlQuery("select max(ly_id) as maxid from tbl_loyalty_reg where ly_id !='' ");
    $num_loy2 = $database->mysqlNumRows($loy_qry12);
     if($num_loy2)
     {
         while($loyalty_listing2 = $database->mysqlFetchArray($loy_qry12))
         {
         $loy_max_id=($loyalty_listing2['maxid']+1);
     }}
         
        $loy_qry1 = $database->mysqlQuery("update  tbl_branchmaster set be_loyalityreg_count='$loy_max_id' ");
         
     }
    ?>