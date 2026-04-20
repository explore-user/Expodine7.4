<link href="loyalty/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

<script src="loyalty/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<style>.combo_tbl_lst{width: 100%; font-size: 11px;  color: #6d0a21;  line-height: 11px !important;
    display: inline-block;}</style>
<script>

    $(function() {
           
     $('#disountamount').keypress(function(event) {

        if(event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) 
          return true;

        else if((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
          event.preventDefault();

     });
           
           
           $( "#datepicker").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
           
           
	   $( "#datepicker1").datepicker({
               changeMonth: true,
               changeYear: true,
               format: 'yyyy-m-d',
               autoclose: true
           });
           
           
   });
   
</script>

<?php

session_start();
include("database.class.php"); // DB Connection class
$orderno1='';
$database = new Database();


if(isset($_REQUEST['set_add'])&&($_REQUEST['set_add']=="add_loyalty")){
    
    require_once('Mailer/PHPMailerAutoload.php');
    
             $branchid="1";
             $fname= $_REQUEST['fname'];
             $lname= $_REQUEST['lname'];
             $email=$_REQUEST['email'];
             $phone= $_REQUEST['phone'];
             $marital=$_REQUEST['marital'];
             $profssion= $_REQUEST['prof'];
             $chk_mail=$_REQUEST['chk_mail'];
             $chk_sms= $_REQUEST['chk_sms'];
             $ly_entry_from= "Loyalty";
             $sts="Active";
             $bday_add=$_REQUEST['bday'];
             $inv_add= $_REQUEST['anvy'];
             $gender= $_REQUEST['gender'];
             $voucher="1";
             $point="0";
             $visit="0"; 
             $entrytime= date('Y-m-d H:i:s');
             
            
        if($inv_add!=""){
        $insertion['ly_anniversarydate'] = mysqli_real_escape_string($database->DatabaseLink,trim($inv_add)); 
        }
        if($bday_add!=""){
        $insertion['ly_birthdaydate'] 	= mysqli_real_escape_string($database->DatabaseLink,trim($bday_add)); 
        }
        $insertion['ly_entry_from']=  mysqli_real_escape_string($database->DatabaseLink,trim($ly_entry_from)); 
        
        $insertion['ly_branchid']=  mysqli_real_escape_string($database->DatabaseLink,trim($branchid));
        if($fname!=""){
        $insertion['ly_firstname']=  mysqli_real_escape_string($database->DatabaseLink,trim($fname));
        }
        if($lname!=""){
        $insertion['ly_lastname']= mysqli_real_escape_string($database->DatabaseLink,trim($lname));
        }
        $insertion['ly_mobileno']= mysqli_real_escape_string($database->DatabaseLink,trim($phone));
        if($email!=""){
	$insertion['ly_emailid']= mysqli_real_escape_string($database->DatabaseLink,trim($email));
        }
        if($marital!=""){
        $insertion['ly_maritalstatus']= mysqli_real_escape_string($database->DatabaseLink,trim($marital));
        }
        if($profssion!=""){
            $insertion['ly_profession']= mysqli_real_escape_string($database->DatabaseLink,trim($profssion));
        }
        
	$insertion['ly_mailreceive']=  mysqli_real_escape_string($database->DatabaseLink,trim($chk_mail));
        $insertion['ly_smsreceive']= mysqli_real_escape_string($database->DatabaseLink,trim($chk_sms));
        $insertion['ly_status']= mysqli_real_escape_string($database->DatabaseLink,trim($sts));
        $insertion['ly_gender']= mysqli_real_escape_string($database->DatabaseLink,trim($gender));
        $insertion['ly_voucher_count']= mysqli_real_escape_string($database->DatabaseLink,trim($voucher));
        $insertion['ly_points']= mysqli_real_escape_string($database->DatabaseLink,trim($point));
        $insertion['ly_totalvisit']= mysqli_real_escape_string($database->DatabaseLink,trim($visit));
        
        $insertion['ly_loy_dayclose']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['date']));
        
        $insertion['ly_loy_login']= mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['login_staff_id_expodine']));
        
        if($entrytime!=""){
        $insertion['ly_entrydatetime']= mysqli_real_escape_string($database->DatabaseLink,trim($entrytime));
        }
        
	$insertid      =  $database->insert('tbl_loyalty_reg',$insertion); 
       
        if($insertion['ly_smsreceive']=='Y'){
            
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
		
		$sms_text=" Dear ".$fname.",\n\n".$_SESSION['be_loyality_reg_msg']."";
                $sms_number=$insertion['ly_mobileno'];
		
		$api_password=$be_sms_apipassword;
		$smstype = $be_sms_method; 
                $username=urlencode($be_sms_username);
		$sender=urlencode($be_sms_senderid);
		$message=urlencode($sms_text);
		$domain=urlencode($be_sms_domainid);
                $route=urlencode($be_sms_priority);
		
              
                
                
                 $parameters="username=$username&api_password=$api_password&sender=$sender&to=$sms_number&priority=$route&message=$message";
		if($method=="POST")
		{
			$opts = array(
			  'http'=>array(
				'method'=>"$method",
				'content' => "$parameters",
				'header'=>"Accept-language: en\r\n" .
						  "Cookie: foo=bar\r\n"
			  )
			);
	
			$context = stream_context_create($opts);
	
			
		}
		else
		{
			$fp = fopen("http://$domain/pushsms.php?$parameters", "r");
		}
	
		$response = stream_get_contents($fp);
		fpassthru($fp);
		fclose($fp);
           
     }
         
                 if($insertion['ly_mailreceive']=='Y'){
          
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
                  
		$emailto= $insertion['ly_emailid'];
		
		$string="Dear ".$fname.",\n\n".$_SESSION['be_loyality_reg_msg']."";
		
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

        $emls=explode(",",$emailto);
		  $ctem=count($emls);
		  if($ctem==0)
		  {
		  $mail->AddAddress($emailto);
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

if (isset($_REQUEST['set']) && $_REQUEST['set']=='proceedbill_summary'){


if (isset($_REQUEST['ordno'])) {
    
$orderno1=$_REQUEST['ordno'];
$orderno=explode(',',$orderno1);
}

?>
 <script src="js/load_tabl_sum.js"></script>
                <div class="print-bill-in-tableselection-popup" id="idnew">
    	
 	  
 		<div class="print-bill-in-tableselection-popup-contant" style="width:70%">
       

                            <?php    
				
				 $total=0;
				 $cancel=0;
                                 
				
				 $tablenos='';
				 $tablenos_full=array();
                                 $table_name="";
                                 $table_prefix="";
                                 
                                 ?>
                    	<table class="billgenration_new_table" width="100%" border="0" cellspacing="5">
              <thead>
                <tr>
                            <th width="5%">#</th>
                            <th width="35%">Menu Item</th>
                            <th width="20%">Unit</th>
                            <th width="10%">Qty</th>
                            <th width="15%">Rate</th>
                            <th width="12%">Amount</th>
                    </tr>
                    </thead>
                 <tbody>
                    <?php       
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
                     // } } ?>     
        
                
                     <tr>
                        <td colspan="6" class="table-num-prnt-pop-td">
                            <div class="table-num-prnt-pop"><?php for($p=0;$p<count(array_unique($table_name));$p++){ if($p>0){ echo  ',';} echo $table_name[$p] .'('.$table_prefix[$p].')';} ?></div>
                                <a href="#" class="deletetablefromlist"><div class="completed_odr_cncel_icon"></div></a>
                       
                           <span class="table-num-prnt-pop-td" onclick="detail_view('<?=$orderno1?>');" style="border-radius: 3px;float:right;margin-right: 3px;background-color: darkred;color: white;"> DETAIL  </span>
                                      
                        </td>
                     </tr>
                     
                     <?php 
                     
                     $combo_entry_count=array();
                     $sql_kotlist  =  $database->mysqlQuery("SELECT distinct(ter_kotno) from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as td ON to1.ter_orderno=td.ts_orderno WHERE td.ts_orderno='".$value."' and to1.ter_dayclosedate='".$_SESSION['date']."' and ter_cancel='N'"); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){ $kot_no=''; $kot_no1='';
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  { 
                                                                $addonrate=0;$slno=0;
                                                                $kot_no=$result_kotlist['ter_kotno'];
                                                                $kot_no1.=$result_kotlist['ter_kotno'].' ,';
                                                          }
	             ?>
                                        <tr>
                                           <td class="kot-num-prnt-pop-td" colspan="6"><?=substr($kot_no1,0,-1)?></td>
                                        </tr>
                       
                         
                             <?php
                             
                             ///combo menu/////
                             
                             $sql_combo_list  =  $database->mysqlQuery("select distinct(cod.cod_count_combo_ordering) as cod_count_combo_ordering, cod.cod_combo_pack_rate, cod.cod_combo_total_rate,cod.cod_combo_qty,  cn.cn_name, cp.cp_pack_name FROM tbl_combo_ordering_details cod 
                                                                        left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                                        left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where cod.cod_orderno='".$value."'  and cod.cod_cancel='N'"); 
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
                                                
                                                
                                /////normal menu/////               
                                $sql_wholelist  =  $database->mysqlQuery("SELECT  to1.ter_disc_before,to1.ter_new_rate_incl,to1.ter_orderno ,to1.ter_portion ,to1.ter_unit_id ,to1.ter_base_unit_id ,"
                                        . " to1.ter_status,to1.ter_rate_before_comp, to1.ter_addon_slno,to1.ter_kotno,to1.ter_unit_weight,to1.ter_rate_type,"
                                        . " to1.ter_unit_type,um.u_name,bum.bu_name,mn.mr_manualrateentry,to1.ter_slno,mn.mr_menuname,mn.mr_menuid,pm.pm_portionname,"
                                        . " sum(to1.ter_qty) as all_qty,to1.ter_rate,(sum(to1.ter_qty) * to1.ter_rate) as total,to1.ter_billnumber,to1.ter_menuid,to1.ter_cancel,pm.pm_id "
                                        . " from tbl_tableorder as to1 LEFT JOIN tbl_menumaster as mn 	ON to1.ter_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm"
                                        . " ON to1.ter_portion=pm.pm_id left join tbl_unit_master um on um.u_id=to1.ter_unit_id left join tbl_base_unit_master bum on"
                                        . " bum.bu_id=to1.ter_base_unit_id WHERE to1.ter_orderno='".$value."' and "
                                        . " to1.ter_dayclosedate='".$_SESSION['date']."' and  to1.ter_qty>0 and ter_count_combo_ordering IS NULL"
                                        . " group by to1.ter_menuid,to1.ter_portion ,to1.ter_unit_id ,to1.ter_base_unit_id,to1.ter_unit_weight order by to1.ter_slno asc  "); 
					$num_wholelist  = $database->mysqlNumRows($sql_wholelist);
					if($num_wholelist){
						  while($result_wholelist  = $database->mysqlFetchArray($sql_wholelist)) 
							  {    $slno++; 
                                                               $billgen_menuname=$result_wholelist['mr_menuname'];
                                                               
                                                if($_SESSION['main_language']!='english'){
                
                                                $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master "
                                                . "left join tbl_languages on ls_id=lm_language_id WHERE "
                                                . "lm_menu_id='".$result_wholelist['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

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
									  }else{
										   
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
                                                       <td width="5%"><?=$slno?></td>
                                                       <td width="35%" style="text-align:left"><?php if($result_wholelist['ter_addon_slno']!=''){ ?><span style="color:red"> (AD) </span><?php } ?> 
                                                  
                                                     <?php if($_SESSION['ser_item_discount_manual']=='Y'  && $result_wholelist['ter_disc_before']==0){ ?>
                                                           <span style="padding-right: 13px;float: right; " title="ITEM DISCOUNT" width="3%" ><span  style="cursor:pointer;" onclick="item_dis_bill('<?=$result_wholelist['ter_menuid']?>','<?=$result_wholelist['ter_orderno']?>','<?=$result_wholelist['ter_portion']?>','<?=$result_wholelist['ter_unit_id']?>','<?=$result_wholelist['ter_base_unit_id']?>','<?=$result_wholelist['ter_unit_weight']?>','<?=$result_wholelist['ter_slno']?>','<?=$result_wholelist['ter_rate']?>','<?=$result_wholelist['ter_new_rate_incl']?>','<?=$billgen_menuname?>' )" type="checkbox" class="item_dis_bill" id="item_dis_bill_<?=$result_wholelist['ter_menuid']."_".$result_wholelist['ter_slno']?>"> 
                                                                   <img src='img/discount_ico.png' style="width:25px" > 
                                                               </span>  
                                                           </span>                          
                                                     <?php } ?> 
                                                           
                                                      <?php if($_SESSION['ser_com_item']=='Y'){ ?>
                                                           <span style="padding-right: 13px;float: right; " title="SET AS COMPLIMENTARY ITEM ?" width="3%" ><input <?php if ( $result_wholelist['ter_status'] == "Billed" || $result_wholelist['ter_status'] == "Closed") { ?> disabled <?php } ?> <?php if($result_wholelist['ter_rate_before_comp']>0){ ?> checked <?php } ?> style="cursor:pointer;" onclick="comp_bill('<?=$result_wholelist['ter_menuid']?>','<?=$result_wholelist['ter_orderno']?>','<?=$result_wholelist['ter_portion']?>','<?=$result_wholelist['ter_unit_id']?>','<?=$result_wholelist['ter_base_unit_id']?>','<?=$result_wholelist['ter_unit_weight']?>','<?=$result_wholelist['ter_slno']?>')" type="checkbox" class="comp_bill" id="comp_bill_<?=$result_wholelist['ter_menuid']."_".$result_wholelist['ter_slno']?>">  </span>                          
                                                      <?php } ?> 
                                                           
                                                     <?=$billgen_menuname?></td>
                                                       
                                                       <td width="20%"><?php if($result_wholelist['ter_rate_type']=='Portion') { echo 'Portion : '. $result_wholelist['pm_portionname'];} else{ if($result_wholelist['ter_unit_type']=='Packet'){echo $result_wholelist['ter_unit_type'].' :  '.number_format($result_wholelist['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_wholelist['u_name'];  } else if($result_wholelist['ter_unit_type']=='Loose'){ echo $result_wholelist['ter_unit_type'].' :  '.number_format($result_wholelist['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_wholelist['bu_name']; } }?></td>
                                                       <td width="10%"><?=$result_wholelist['all_qty']?></td>
                                                        <?php if($result_wholelist['mr_manualrateentry']=='N'){
                                                           ?>
                                                       <td width="15%"><?=number_format($result_wholelist['ter_rate'],$_SESSION['be_decimal'])?></td>
                                                        <?php } else{ ?>
                                                       
                                                         <td width="15%" id="reftd">

                                                           <input style="margin-left:2px;width:65%; text-align:center;border-color:lightcoral;float: left;font-size: 10px" type="text" class="hiddenrate" name="hiddenrate" id="hiddenrate<?=$value?><?=$result_wholelist['ter_slno']?><?=$result_wholelist['ter_kotno']?>" value="<?=number_format($result_wholelist['ter_rate'],$_SESSION['be_decimal'])?>" >
                                                           <input type="hidden" name="submitrate" id="submitrate"  onclick="return subrate('<?=$result_wholelist["ter_menuid"]?>');" >
                                                           <span sty name="submitrate1" id="submitrate1"  onclick="return subrate1('<?=$result_wholelist['ter_slno']?>','<?=$value?>','<?=$result_wholelist['ter_kotno']?>');"><img style="width:22%" src="img/rate.png" /> </span>
                                                      
                                                         </td> 
                                                        
                                                       <?php } ?>
                                                       <td width="12%" ><span><?=number_format($result_wholelist['total'],$_SESSION['be_decimal'])?></span></td>
                                                     </tr>
                                                     <?php
                                                  
                                                }} 
                                 
                                    if($cancel!=0){
					$total=$total - $cancel;
                                    }else{
					$total=$total ;
                                    }
                                    
                                    
                                }else{ ?>
                                   
                                <tr>
                                  <td class="kot-num-prnt-pop-td" colspan="6" style="color:red;font-weight: bold;background-color: whitesmoke">NO KOT - PLEASE PRINT TO CLEAR TABLE</td>
                                 </tr>            
                  <?php
                  }
                                 
                   }
                                  
                $point_rule=1;
                $amount_rule=1;
                $sql_desg_nos119="select * from tbl_loyalty_redeem_rule";

				$sql_desg119  =  $database->mysqlQuery($sql_desg_nos119);
				$num_desg119  = $database->mysqlNumRows($sql_desg119);
			      
				if($num_desg119){
				while($result_desg119  = $database->mysqlFetchArray($sql_desg119)) 
					{
						$point_rule=$result_desg119['lyr_point'];					
						$amount_rule=$result_desg119['lyr_amount'];
                                              
					}
                                        
                                }
                                
                                $point_rule_add=1;
                                $amount_rule_add=1;
                                $sql_desg_nos1190="select * from tbl_loyalty_pointrule";

				$sql_desg1190  =  $database->mysqlQuery($sql_desg_nos1190);
				$num_desg1190  = $database->mysqlNumRows($sql_desg1190);
			      
				if($num_desg1190){
				while($result_desg1190  = $database->mysqlFetchArray($sql_desg1190)) 
					{
						$point_rule_add=$result_desg1190['lyp_point'];					
						$amount_rule_add=$result_desg1190['lyp_amount'];
                                              
					}
                                        
                                }                 
                                 $min_redeem=0;
                                 
                                  $sql_desg_nos11="select be_loyalty_settle,be_min_redeem_point from tbl_branchmaster";

				$sql_desg11  =  $database->mysqlQuery($sql_desg_nos11);
				$num_desg11  = $database->mysqlNumRows($sql_desg11);
			        $i=1;
                                $printpermission="";
                                $sms_lst="";
				if($num_desg11){
				while($result_desg11  = $database->mysqlFetchArray($sql_desg11)) 
					{
						$min_redeem=$result_desg11['be_min_redeem_point'];	
                                                $loy_sts=$result_desg11['be_loyalty_settle'];
						
					}
                                }
                                 ?> 
 <input type="hidden" id="point_rule_add" amt_add="<?=$amount_rule_add?>" value="<?=$point_rule_add?>" />
 <input type="hidden" id="point_rule" amt="<?=$amount_rule?>" value="<?=$point_rule?>" />
          <input type="hidden" id="min_redeem" value="<?=$min_redeem?>">                                            
           <input type="hidden"  class="print_bill_details_from_tablesel"  ordval="<?=$orderno1?>"    value="<?=$table_name_list?>">
           <input type="hidden"  id="billtotal"     value="<?=$total?>">
           <input type="hidden"  id="floor_id"     value="<?=$_SESSION['floorid']?>">
             <input type="hidden"  id="subtotal_loy_org"     value="<?=number_format($total,$_SESSION['be_decimal'])?>">
             <input type="hidden" id="decimal" value="<?=$_SESSION['be_decimal']?>" >
            </tbody>
                    </table>
<div class="print-bill-in-tableselection-popup-contant-bottom" >
                <div class="print-bill-in-tableselection-popup-contant-bottom-ttl" >Total Amount : (<?=$_SESSION['base_currency']?>) <span id="subtotal_loy"><?=number_format($total,$_SESSION['be_decimal'])?></span></div>
                <div id="point_show" style="width:50%;text-align: left;float: left;padding-left: 1%;display: none;height: 18px; margin-top: 5px;" class="lable_counter_paymnet_cc counter_right_lable"><strong >Redeem Amount (<span id="redeem_point_total"> 0 </span> Point) =<span id="redeem_amount_total"> 0</span></strong></div>  
                                <div id="point_amount_show" style="width:50%;text-align: right;float: right;padding-right: 0;height: 18px; margin-top: 5px;display: none" class="lable_counter_paymnet_cc counter_right_lable"><strong style="float:right"> Total Before Redeem = <span id="total_before_redeem"> 0 </span> </strong></div>                          
            </div>
            
<div class="print-bill-in-tableselection-popup-btm-gst-sec" style="display:none">
            	<div class="col-md-4" >
                     <input type="text" class="tbl-gst-name-textbox"  placeholder="Customer Name" id="billname">
                </div>
                <div class="col-md-4" style="padding-left:0">
                      <input type="text" class="tbl-gst-name-textbox" placeholder="Contact Number" id="billnum" onclick="return manualamount(this.id)">
                </div>
                <div class="col-md-4" style="padding-left:0">
                    <input type="text" class="tbl-gst-name-textbox" placeholder="GST Number" id="billgst" autocomplete="off" readonly  onfocus="this.removeAttribute('readonly');">
                </div>
            </div>
           

        
        </div>
                              
         <div class="print-bill-in-tableselection-popup-contant" style="width: 30%;background-color: #efefef;height: 100%;margin-top: 0px;position: relative">
                  
                   <div class="table_sel_loyalty_btn_area">
                           <a href="#" class="print-bill-popup-close"><div class="print-bill-in-tableselection-popup-cls"><img src="img/red_cross.png"></div></a>
                           	
                           <a style="display: none" href="#"><div class="register_loyalty_table_selection loyalty-btn">
                           		<img src="img/user-loyalty-icon.png" title="Register">
                                 Reg Loyalty 
                           </div></a>
                           
                           <a href="#"><div class="register_loyalty_table_selection settle-btn" style="display: none;    background-color: #8a400e;border-bottom: 4px #652d07 solid;">
                           		<img  src="img/bill-icon.png" title="Settle Bill">
                                Back
                           </div></a>
                       <?php if($loy_sts=='Y'){ ?>
                       <a href="#"><div class="register_loyalty_table_selection redeem_btn">
                           		<!--<img src="img/user-loyalty-icon.png" title="Redeem">-->
                                 Add/Redeem 
                           </div></a>
                       <?php  } ?>
                           
                            <a href="#"><div class="register_loyalty_table_selection settle-btn1" style="display: none;    background-color: #8a400e;border-bottom: 4px #652d07 solid;">
                           		<img  src="img/bill-icon.png" title="Settle Bill">
                                Back 
                           </div></a>
                           
                    </div>
                           
                       <div id="register-loyalty" class="table_bill_print_disc_contant" style="padding-top: 0;display: none">
                           		<div class="loyalty_reg_hd" style="">Register Loyalty</div>
						   		
						   		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">First Name</div>
										<div class="table_bill_print_disc_input_cc">
							<input type="text" onkeyup="validate_name(event);" class="table_bill_print_disc_input" id="firstname">
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Last Name</div>
										<div class="table_bill_print_disc_input_cc">
							<input onkeyup="validate_lname(event);" type="text" class="table_bill_print_disc_input" id="lastname" >
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Phone</div>
										<div class="table_bill_print_disc_input_cc">
											<input onkeypress="return numdot(event);" id="phone"  type="text" class="table_bill_print_disc_input">
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Email</div>
										<div class="table_bill_print_disc_input_cc">
											<input id="email" type="text" class="table_bill_print_disc_input">
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Bithday</div>
										<div class="table_bill_print_disc_input_cc">
											<input id="datepicker" type="text" class="table_bill_print_disc_input bday">
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Gender</div>
										<div class="table_bill_print_disc_input_cc">
											<select class="table_bill_print_disc_input" id="gender">
												<option value="M">Male</option>
                                                                                                <option value="F">Female</option>
											</select>
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">M Status</div>
										<div class="table_bill_print_disc_input_cc">
                                                                                    <select class="table_bill_print_disc_input" id="marital">
												<option value="single">Single</option>
												<option value="married">Married</option>
											</select>
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Anniversary</div>
										<div class="table_bill_print_disc_input_cc">
											<input id="datepicker1"  type="text" class="table_bill_print_disc_input anniversary">
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Proffession</div>
										<div class="table_bill_print_disc_input_cc">
				<select class="table_bill_print_disc_input" id="profession"> 
                                            
                            <?php
                            $loy_qry1 = $database->mysqlQuery("select * from tbl_profession_master  ");
                            $num_loy1 = $database->mysqlNumRows($loy_qry1);
                             if($num_loy1)
                             {
                                 while($loyalty_listing_edit = $database->mysqlFetchArray($loy_qry1))
                                 {

                                ?>

                            <option selected='selected' value='<?=$loyalty_listing_edit['pr_name']?>' ><?=$loyalty_listing_edit['pr_name']?></option>
                            <?php 

                                 }
                                 }
                                   ?>                                
                                    </select>
										</div>
                           		</div>
                           		<div class="checkbox table_bill_print_disc_contant_box " style="width: 50%;margin-top: 15px;"> 
                                          <input style="width: 100%;" id="checkbox_mail" type="checkbox">
                                          <label for="checkbox2">
                                              MAIL 
                                          </label>
                                      </div>
                                      <div class="checkbox table_bill_print_disc_contant_box" style="width: 50%;margin-top: 15px;">
                                          <input style="width: 100%;" id="checkbox_sms" type="checkbox">
                                          <label for="checkbox2">
                                              SMS 
                                          </label>
                                      </div>
                                      
                                      <a href="#" onclick="return submit_loyalty(event);"><div class="submit-form-btn">Register</div></a>
						     <strong id="error_show" style="width:100%;float:left;text-align: center;color: red;margin: 8px 20px 0 0"></strong>
			 			</div>
             
             <div id="redeem-loyalty" class="table_bill_print_disc_contant" style="padding-top: 0;display: none">
                           		<div class="loyalty_reg_hd" style="">
                                            <a style="float:left;margin-top: -5px" title="BILL DETAILS" href="#" onclick="return list_loyalty_bill();" class="action-btn"><img style="border:solid 1px " src="img/rate.png"></a>
                                            Add/Redeem Loyalty
                                        </div>
                 
                 <div id="loyaltydiv" class="loyalty_sec_cc loyalt_table_sel_print"  >
                       
                       
                           <div class="selecting_payment_one" style="position:relative">
                                        <div class="lable_counter_paymnet_cc counter_right_lable" >Loyalty ID</div>
                                        <input placeholder="Loyalty ID" class="tax_textbox transa_txt counter_text_box" onkeyup="return search_id(event);" onfocus="return search_id(event);"  onkeypress="return numdot(event);"  onclick="return search_id(event);"  id="ly_id"  autocomplete="off" autofocus >
                                         <div id="id_load" class="customer_list_autoload" style="display:none;">
                                             <ul >
                                                                                                <li onclick="return id_click();" style="cursor: pointer">
                                                                                                    
                                                                                                </li>
                                                                                            </ul>
                                                                                                </div>
                                    </div>
                                    
                           <div class="selecting_payment_one"  style="position:relative" >
                                        <div class="lable_counter_paymnet_cc counter_right_lable" >Name</div>
                                       
                                        <input placeholder="Customer Name" class="tax_textbox transa_txt counter_text_box" onclick="return search_name(event);" onfocus="return search_name(event);"  onkeyup="return search_name(event);" id="ly_name"  autocomplete="off">
                                   <div id="name_load" class="customer_list_autoload" style="display:none;">
                                                                                            <ul>
                                                                                                <li onclick="return name_click();" style="cursor: pointer">
                                                                                                    
                                                                                                </li>
                                                                                            </ul>
                                                                                                </div>
                                         
												
                                    
                                    </div>
                                    
                                    <div class="selecting_payment_one" style="position:relative">
                                        <div class="lable_counter_paymnet_cc counter_right_lable" >Mobile No</div>
                                        <input placeholder="Mobile No" class="tax_textbox transa_txt counter_text_box" onclick="return search_number(event);" onkeypress="return numdot(event);" onfocus="search_number(event);" onkeyup="search_number(event);" id="ly_number" autocomplete="off">
                                     <div id="number_load" class="customer_list_autoload" style="display:none;">
                                                                                            <ul>
                                                                                                <li onclick="return number_click();" style="cursor: pointer">
                                                                                                    
                                                                                                </li>
                                                                                            </ul>
                                                                                                </div>
												
                                    
                                    
                                    </div>
                           
                           <div class="selecting_payment_one" style="position:relative">
                                        <div class="lable_counter_paymnet_cc counter_right_lable" >Total Points</div>
                                        <input placeholder="Customer Points" class="tax_textbox transa_txt counter_text_box"  id="ly_points" autocomplete="off" readonly>
                                     
                                    </div>
                           
                           
                           
                                    
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable" > Redeem Point</div>
                                        <input placeholder="Points to Redeem" class="tax_textbox transa_txt counter_text_box" onkeypress="return numdot(event);" onclick="return redeem_point(event);" onchange="return redeem_point(event);"   id="redeem_point" onkeyup="return redeem_point();" autocomplete="off">
                                    </div>
                                    
						   			<div class="selecting_redeem_btn_cc">
						   				
						   				
						   				
                                            <div style="float:right;cursor: pointer;width:100%" class="selecting_redeem_btn_div">
                                                <div style="display: none " class="selecting_redeem_btn1" id="cont_click" >Continue</div>
						   					<div class="selecting_redeem_btn" id="redeem_btn_click" >Redeem</div>
                                            <div class="selecting_redeem_btn" id="clear_btn_click" style="display:none" >Clear All</div>
                                           </div>
                                          
						   			</div>
                      
                     <span style="width: 100%;height: 35px;float: left">
                     <strong id="loy_error" style="color:red;width:100% !important;line-height: 17px;float:left"> </strong>

                     <div class="selecting_redeem_value_show" style="width:100%">
                                                <span style="line-height: 18px;text-align: center;" class="redeeming_value_total"></span>
						   					    <span style="line-height: 18px;text-align: center;" class="redeeming_value_total_offer"></span>
						   				    </div>
                    </span>
                       
                     
                     
                     
                     <div class="keys settle_key" style="margin-top:0px;padding: 0 0 2% 2%;">
                                <span class="pay_settle_btn">1</span>
                                <span class="pay_settle_btn">2</span>
                                <span class="pay_settle_btn">3</span>
                                <span class="pay_settle_btn">4</span>
                                <span class="pay_settle_btn">5</span>
                                <span class="pay_settle_btn">6</span>
                                <span class="pay_settle_btn">7</span>
                                <span class="pay_settle_btn">8</span>
                                <span class="pay_settle_btn">9</span>
                                <span class="pay_settle_btn">0</span>
                                <span class="pay_settle_btn">.</span>
                                <span class="pay_settle_btn">Clear</span>
                                <!--<span class="calculator_settle">Enter</span>-->
                            </div>
                       
			    </div>
             
                            </div>
                          
                              <?php
                            
                            $loy_qry14 = $database->mysqlQuery("select be_printwithdiscount from tbl_branchmaster");
                            $num_loy14 = $database->mysqlNumRows($loy_qry14);
                             if($num_loy14)
                             {
                                 while($loyalty_listing_edit4 = $database->mysqlFetchArray($loy_qry14))
                                 {
                                    
                                     $dis_on_off=$loyalty_listing_edit4['be_printwithdiscount'];
                                     
                                }}
                                ?>
             
             
             
             
                           <div id="stlle-bill" class="table_bill_print_disc_contant" style="padding-top: 0;">
                             <div class="loyalty_discount_cc" style="min-height:288px;">
                                <?php  if($dis_on_off=='Y'){ ?>  
                                 <div class="auothorize_popup">
                                    <div class="auothorize_popup_head">Discount Authorization</div>
                                    <span style="text-align: center;width: 100%;float: left;color: red ;height:20px;"> <strong id="dis_error"></strong></span>
                                    <div class="discout_auth_contant">
                                        <div class="discout_auth_contant_textbox_name">Enter Your Pin</div>
                                        <input style="border-radius: 30px;outline: none !important " type="password" onkeypress=" return numdot(event);" onchange="return dis_pincheck()" onclick="return dis_pincheck()" onfocus="return dis_pincheck()" id="dis_pin" maxlength="4" class="discout_auth_contant_textbox" autocomplete="off" autofocus="">
                                    </div>

                                    <div class="auothorize_popup_footer_btn_cc">
                                        
                                        <div style="width: 35%;" class="btn_index_popup ">
                                             <a style="text-decoration:none" id="dis_auth_proceed" href="#" class="">Proceed</a>
                                         </div>
                                    </div>
                                </div>
                                   <?php }  ?>
                                 
                              <?php  if($dis_on_off=='Y'){ ?>
                           		<div class="table_print_bill_disc_head" style="position: relative">Enter Discount 
                           		 
                                        </div>
                                    <div class="table_bill_print_disc_contant_box">
                          		<div class="table_bill_print_disc_name">Type</div>
                           		<div class="table_bill_print_disc_input_cc">
                                        <select class="table_bill_print_disc_input" id="disountamount_drop" onchange="dischange();">
                                            <option value=""><?=$_SESSION['completed_order_popup_type_none']?></option>
                                            <?php
                                            $sql_listall_dsc  =  $database->mysqlQuery("SELECT * from tbl_discountmaster where ds_status='Active' "); 
                                            $num_listall_dsc  = $database->mysqlNumRows($sql_listall_dsc);
                                            if($num_listall_dsc){
                                                while($row_listall_dsc  = $database->mysqlFetchArray($sql_listall_dsc)) 
                                                    {
                                                    ?>
                                                <option mode_ds="<?=$row_listall_dsc['ds_mode']?>" val_ds="<?=$row_listall_dsc['ds_discountof']?>" value="<?=$row_listall_dsc['ds_discountid']?>" ><?= $row_listall_dsc['ds_discountname']//$row_listall_dsc['ds_discountname']?></option>
                                               <?php } } ?>
                           		</select>
                           		</div>
                           		</div>
                               
                                 <div class="table_bill_print_disc_contant_box manual_permission_on " style="display:none">
                           		<div class="table_bill_print_disc_name" >Manual </div>
                           		<div class="table_bill_print_disc_input_cc" style="width: 35%">
                                            <input class="table_bill_print_disc_input" type="text" id="disountamount" onclick="return manualamount(this.id)" onchange="return manualamount(this.id)" onfocus="return manualamount(this.id)">
                           		</div>
                           		<div class="table_bill_print_disc_input_cc" style="width: 33%;float: right">
                           			<select class="table_bill_print_disc_input" id="discountmode">
                           				<option value="P">%</option>
                           				<option value="V">Value</option>
                           			</select>
                           		</div>
                           	  </div>
                                 <div><p id="load_discount_data" style="text-align: center;"></p></div> 
                              <?php  } ?>
                                 
                                 <div class="alert_billprnt_pop" style="display:none"><strong id="alert_billprnt_pop"></strong></div>
<!--                           	  <div class="table_print_bill_disc_head" style="margin-top: 7px">Loyalty </div>
                           	  
                           	  <div class="table_bill_print_disc_contant_box">
                           		<div class="table_bill_print_disc_name">Mobile </div>
                           		<div class="table_bill_print_disc_input_cc">
                           			<input class="table_bill_print_disc_input" type="text">
                           		</div>
                           	  </div>
                           	  <div class="table_bill_print_disc_contant_box">
                           		<div class="table_bill_print_disc_name">Points </div>
                           		<div class="table_bill_print_disc_input_cc">
                           			<input class="table_bill_print_disc_input" value="355" readonly type="text">
                           		</div>
                           	  </div>
                           	   <div class="table_bill_print_disc_contant_box">
                           		<div class="table_bill_print_disc_name">Redeem </div>
                           		<div class="table_bill_print_disc_input_cc">
                           			<input class="table_bill_print_disc_input" type="text">
                           		</div>
                           	  </div>
                           	  <div class="table_bill_print_disc_contant_box">
                           		<div class="table_bill_print_disc_name">Balance </div>
                           		<div class="table_bill_print_disc_input_cc">
                           			<input class="table_bill_print_disc_input" value="255" readonly type="text">
                           		</div>
                           	  </div>-->
                           	 
                           	  </div><!--loyalty_discount_cc-->
                           	  
                           	  <div class="keys settle_key" style="margin-top:5px;padding: 0 0 2% 2%;">
                                <span class="pay_settle_btn">1</span>
                                <span class="pay_settle_btn">2</span>
                                <span class="pay_settle_btn">3</span>
                                <span class="pay_settle_btn">4</span>
                                <span class="pay_settle_btn">5</span>
                                <span class="pay_settle_btn">6</span>
                                <span class="pay_settle_btn">7</span>
                                <span class="pay_settle_btn">8</span>
                                <span class="pay_settle_btn">9</span>
                                <span class="pay_settle_btn">0</span>
                                <span class="pay_settle_btn">.</span>
                                <span class="pay_settle_btn">Clear</span>
                                <!--<span class="calculator_settle">Enter</span>-->
                            </div>
                          	  <?php  if(in_array("Completed Order", $_SESSION['menumodarray'])) { ?> 
                          	  <a href="#">
                                      
                                 <div style="width: 50%;padding-top: 11px;margin-left: 3px;" class="print-bill-in-tableselection-popup-btn" id="print_bill_from_tablesel">
				<img src="img/print_re.png">
				Print Bill 
                                </div>
                                  </a>     
                                      
                                <?php if($_SESSION['s_print_option']=='Y' ){ ?>      
                                  <a href="#">     
                                  <div style="width: 48%;padding-top: 11px;" class="print-bill-in-tableselection-popup-btn" id="">
				<img src="img/print_re.png">
				No Print 
                                </div>
                                       </a>
                                <?php } ?>
                                      
                                 
                           <?php }else{ ?>  

                              <a href="#">     
                                  <div style="width: 48%;padding-top: 11px;" class="print-bill-in-tableselection-popup-btn" id="">
				<img src="img/print_re.png">
				No Permission
                                </div>
                               </a>
                        <?php }  ?>  
                           	  
                           	  
                           </div>               
		</div>
                               
        
                    
							       
    </div><!--print-bill-in-tableselectio-popup-->
    
   <input type="hidden" name="focusedtext" id="focusedtext" />
    
    <div class="kotcancel_reason_popup_new" id="kotcancel_reason_popup_new" style="display:none;top:16%;left: 0;right: 0;">
       
      
        
         <input type="hidden" name="slno_dynamic_menu" id="slno_dynamic_menu" />
          <input type="hidden" name="order_dynamic_menu" id="order_dynamic_menu" />
          <input type="hidden" name="kot_dynamic_menu" id="kot_dynamic_menu" />
          
         
 <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head"><img class="auth_head_ico" src="img/alert.png" /> Authorisation</div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    

        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><span id="pin_error1" style="color:red;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin_new"  onkeypress="return numonly(event)" onclick="return addpin();" onchange="return addpin();"  maxlength="4" autocomplete="off" autofocus/>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_cancel_btnrate">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_proceed_btnrate">Proceed</div></a>
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle">1</span>
            <span class="calculator_settle">2</span>
            <span class="calculator_settle">3</span>
             <span class="calculator_settle_back">&nbsp;</span>
            <span class="calculator_settle">4</span>
            <span class="calculator_settle">5</span>
            <span class="calculator_settle">6</span>
             <span class="calculator_settle">Clear</span>
            <span class="calculator_settle">7</span>
            <span class="calculator_settle">8</span>
            <span class="calculator_settle">9</span>
            <span class="calculator_settle">0</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div>

    
    <div  class="confrmation_overlay_new" style="display:none;"></div>
    <div  class="confrmation_overlay_2nd" style="display:none;width: 100%;height: 100%;position: fixed;background-color: rgba(0,0,0,0.8); top: 0;z-index: 99999999999"></div>
    
<?php }
if (isset($_REQUEST['set']) && $_REQUEST['set']=='proceedbill'){


if (isset($_REQUEST['ordno'])) {
    
$orderno1=$_REQUEST['ordno'];
$orderno=explode(',',$orderno1);
}

?>
 <script src="js/load_tabl_sum.js"></script>
                <div class="print-bill-in-tableselection-popup" id="idnew">
    	
 	  
 		<div class="print-bill-in-tableselection-popup-contant" style="width:70%">
       

                            <?php    
				
				 $total=0;
				 $cancel=0;
                                 
				
				 $tablenos='';
				 $tablenos_full=array();
                                 $table_name="";
                                 $table_prefix="";
                                 
                                 ?>
                    	<table class="billgenration_new_table" width="100%" border="0" cellspacing="5">
              <thead>
                <tr>
                            <th width="5%">#</th>
                            <th width="35%">Menu Item</th>
                            <th width="20%">Unit</th>
                            <th width="10%">Qty</th>
                            <th width="15%">Rate</th>
                            <th width="12%">Amount</th>
                    </tr>
                    </thead>
                 <tbody>
                    <?php        
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
                     // } } ?>     
        
                
                     <tr>
                        <td colspan="6" class="table-num-prnt-pop-td">
                            <div class="table-num-prnt-pop"><?php for($p=0;$p<count(array_unique($table_name));$p++){ if($p>0){ echo  ',';} echo $table_name[$p] .'('.$table_prefix[$p].')';} ?></div>
                                <a href="#" class="deletetablefromlist"><div class="completed_odr_cncel_icon"></div></a>
                       
                                <span class="table-num-prnt-pop-td" onclick="summary_view('<?=$orderno1?>');" style="border-radius: 3px;float:right;margin-right: 3px;background-color: darkred;color: white;"> SUMMARY  </span>
                                    
                                    
                              
                        </td>
                     </tr>
                     <?php 
                     
                     $combo_entry_count=array();
                     $sql_kotlist  =  $database->mysqlQuery("SELECT distinct(ter_kotno) from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as td ON to1.ter_orderno=td.ts_orderno WHERE td.ts_orderno='".$value."' and to1.ter_dayclosedate='".$_SESSION['date']."' and ter_cancel='N'"); 
					$num_kotlist  = $database->mysqlNumRows($sql_kotlist);
					if($num_kotlist){$kot_no='';
						  while($result_kotlist  = $database->mysqlFetchArray($sql_kotlist)) 
							  { 
                                                                $addonrate=0;$slno=0;
                                                                $kot_no=$result_kotlist['ter_kotno'];
	            ?>
                                        <tr>
                                           <td class="kot-num-prnt-pop-td" colspan="6"><?=$kot_no?></td>
                                        </tr>
                       
                         
                             <?php
                             ///combo menu/////
                             
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
                                                
                                                
                                /////normal menu/////               
                                $sql_wholelist  =  $database->mysqlQuery("SELECT   to1.ter_disc_before,to1.ter_new_rate_incl,to1.ter_orderno ,to1.ter_portion ,to1.ter_unit_id ,to1.ter_base_unit_id ,"
                                        . " to1.ter_status,to1.ter_rate_before_comp, to1.ter_addon_slno,to1.ter_kotno,to1.ter_unit_weight,to1.ter_rate_type,"
                                        . " to1.ter_unit_type,um.u_name,bum.bu_name,mn.mr_manualrateentry,to1.ter_slno,mn.mr_menuname,mn.mr_menuid,pm.pm_portionname,"
                                        . " to1.ter_qty,to1.ter_rate,(to1.ter_qty * to1.ter_rate) as total,to1.ter_billnumber,to1.ter_menuid,to1.ter_cancel,pm.pm_id "
                                        . " from tbl_tableorder as to1 LEFT JOIN tbl_menumaster as mn 	ON to1.ter_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm"
                                        . " ON to1.ter_portion=pm.pm_id left join tbl_unit_master um on um.u_id=to1.ter_unit_id left join tbl_base_unit_master bum on"
                                        . " bum.bu_id=to1.ter_base_unit_id WHERE to1.ter_kotno='".$result_kotlist['ter_kotno']."' and "
                                        . " to1.ter_dayclosedate='".$_SESSION['date']."' and  to1.ter_qty>0 and ter_count_combo_ordering IS NULL order by ter_slno asc  "); 
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
									  }else{
										   
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
                                                       <td width="5%"><?=$slno?></td>
                                                       <td width="35%" style="text-align:left"><?php if($result_wholelist['ter_addon_slno']!=''){ ?><span style="color:red"> (AD) </span><?php } ?> 
                                                    
                                                     <?php if($_SESSION['ser_item_discount_manual']=='Y' && $result_wholelist['ter_disc_before']==0){ ?>
                                                           <span style="padding-right: 13px;float: right; " title="ITEM DISCOUNT" width="3%" >
                                                               <span  style="cursor:pointer;" onclick="item_dis_bill('<?=$result_wholelist['ter_menuid']?>','<?=$result_wholelist['ter_orderno']?>','<?=$result_wholelist['ter_portion']?>','<?=$result_wholelist['ter_unit_id']?>','<?=$result_wholelist['ter_base_unit_id']?>','<?=$result_wholelist['ter_unit_weight']?>','<?=$result_wholelist['ter_slno']?>','<?=$result_wholelist['ter_rate']?>','<?=$result_wholelist['ter_new_rate_incl']?>','<?=$billgen_menuname?>' )" type="checkbox" class="item_dis_bill" id="item_dis_bill_<?=$result_wholelist['ter_menuid']."_".$result_wholelist['ter_slno']?>"> 
                                                                   <img src='img/discount_ico.png' style="width:25px" > </span>
                                                           </span>                          
                                                     <?php } ?>
                                                           
                                                           
                                                       <?php if($_SESSION['ser_com_item']=='Y'){ ?>
                                                           <span style="padding-right: 13px;float: right; " title="SET AS COMPLIMENTARY ITEM ?" width="3%" ><input <?php if ( $result_wholelist['ter_status'] == "Billed" || $result_wholelist['ter_status'] == "Closed") { ?> disabled <?php } ?> <?php if($result_wholelist['ter_rate_before_comp']>0){ ?> checked <?php } ?> style="cursor:pointer;" onclick="comp_bill('<?=$result_wholelist['ter_menuid']?>','<?=$result_wholelist['ter_orderno']?>','<?=$result_wholelist['ter_portion']?>','<?=$result_wholelist['ter_unit_id']?>','<?=$result_wholelist['ter_base_unit_id']?>','<?=$result_wholelist['ter_unit_weight']?>','<?=$result_wholelist['ter_slno']?>')" type="checkbox" class="comp_bill" id="comp_bill_<?=$result_wholelist['ter_menuid']."_".$result_wholelist['ter_slno']?>">  </span>                          
                                                     <?php } ?> 
                                                           
                                                     <?=$billgen_menuname?></td>
                                                       
                                                       <td width="20%"><?php if($result_wholelist['ter_rate_type']=='Portion') { echo 'Portion : '. $result_wholelist['pm_portionname'];} else{ if($result_wholelist['ter_unit_type']=='Packet'){echo $result_wholelist['ter_unit_type'].' :  '.number_format($result_wholelist['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_wholelist['u_name'];  } else if($result_wholelist['ter_unit_type']=='Loose'){ echo $result_wholelist['ter_unit_type'].' :  '.number_format($result_wholelist['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_wholelist['bu_name']; } }?></td>
                                                       <td width="10%"><?=$result_wholelist['ter_qty']?></td>
                                                        <?php if($result_wholelist['mr_manualrateentry']=='N'){
                                                           ?>
                                                       <td width="15%"><?=number_format($result_wholelist['ter_rate'],$_SESSION['be_decimal'])?></td>
                                                        <?php } else{ ?>
                                                         <td width="15%" id="reftd">

                                                           <input style="margin-left:2px;width:65%; text-align:center;border-color:lightcoral;float: left;font-size: 10px" type="text" class="hiddenrate" name="hiddenrate" id="hiddenrate<?=$value?><?=$result_wholelist['ter_slno']?><?=$result_wholelist['ter_kotno']?>" value="<?=number_format($result_wholelist['ter_rate'],$_SESSION['be_decimal'])?>" >
                                                           <input type="hidden" name="submitrate" id="submitrate"  onclick="return subrate('<?=$result_wholelist["ter_menuid"]?>');" >
                                                           <span name="submitrate1" id="submitrate1"  onclick="return subrate1('<?=$result_wholelist['ter_slno']?>','<?=$value?>','<?=$result_wholelist['ter_kotno']?>');"><img style="width:22%" src="img/rate.png" /> </span>
                                                        </td> 
                                                       <?php } ?>
                                                       <td width="12%" ><span><?=number_format($result_wholelist['total'],$_SESSION['be_decimal'])?></span></td>
                                                     </tr>
                                                     <?php
                                                  
                                                }} 
                                 
                                    if($cancel!=0){
					$total=$total - $cancel;
                                    }else{
					$total=$total ;
                                    }
                                    
                                    
                                }}else{ ?>
                                   
                                <tr>
                                  <td class="kot-num-prnt-pop-td" colspan="6" style="color:red;font-weight: bold;background-color: whitesmoke">NO KOT - PLEASE PRINT TO CLEAR TABLE</td>
                                 </tr>            
                  <?php
                  }
                                 
                   }
                                  
                $point_rule=1;
                $amount_rule=1;
                $sql_desg_nos119="select * from tbl_loyalty_redeem_rule";

				$sql_desg119  =  $database->mysqlQuery($sql_desg_nos119);
				$num_desg119  = $database->mysqlNumRows($sql_desg119);
			      
				if($num_desg119){
				while($result_desg119  = $database->mysqlFetchArray($sql_desg119)) 
					{
						$point_rule=$result_desg119['lyr_point'];					
						$amount_rule=$result_desg119['lyr_amount'];
                                              
					}
                                        
                                }
                                
                                $point_rule_add=1;
                                $amount_rule_add=1;
                                $sql_desg_nos1190="select * from tbl_loyalty_pointrule";

				$sql_desg1190  =  $database->mysqlQuery($sql_desg_nos1190);
				$num_desg1190  = $database->mysqlNumRows($sql_desg1190);
			      
				if($num_desg1190){
				while($result_desg1190  = $database->mysqlFetchArray($sql_desg1190)) 
					{
						$point_rule_add=$result_desg1190['lyp_point'];					
						$amount_rule_add=$result_desg1190['lyp_amount'];
                                              
					}
                                        
                                }                 
                                 $min_redeem=0;
                                 
                                  $sql_desg_nos11="select be_loyalty_settle,be_min_redeem_point from tbl_branchmaster";

				$sql_desg11  =  $database->mysqlQuery($sql_desg_nos11);
				$num_desg11  = $database->mysqlNumRows($sql_desg11);
			        $i=1;
                                $printpermission="";
                                $sms_lst="";
				if($num_desg11){
				while($result_desg11  = $database->mysqlFetchArray($sql_desg11)) 
					{
						$min_redeem=$result_desg11['be_min_redeem_point'];	
                                                $loy_sts=$result_desg11['be_loyalty_settle'];
						
					}
                                }
                                 ?> 
 <input type="hidden" id="point_rule_add" amt_add="<?=$amount_rule_add?>" value="<?=$point_rule_add?>" />
 <input type="hidden" id="point_rule" amt="<?=$amount_rule?>" value="<?=$point_rule?>" />
          <input type="hidden" id="min_redeem" value="<?=$min_redeem?>">                                            
           <input type="hidden"  class="print_bill_details_from_tablesel"  ordval="<?=$orderno1?>"    value="<?=$table_name_list?>">
           <input type="hidden"  id="billtotal"     value="<?=$total?>">
           <input type="hidden"  id="floor_id"     value="<?=$_SESSION['floorid']?>">
             <input type="hidden"  id="subtotal_loy_org"     value="<?=number_format($total,$_SESSION['be_decimal'])?>">
             <input type="hidden" id="decimal" value="<?=$_SESSION['be_decimal']?>" >
            </tbody>
                    </table>
<div class="print-bill-in-tableselection-popup-contant-bottom" >
                <div class="print-bill-in-tableselection-popup-contant-bottom-ttl" >Total Amount : (<?=$_SESSION['base_currency']?>) <span id="subtotal_loy"><?=number_format($total,$_SESSION['be_decimal'])?></span></div>
                <div id="point_show" style="width:50%;text-align: left;float: left;padding-left: 1%;display: none;height: 18px; margin-top: 5px;" class="lable_counter_paymnet_cc counter_right_lable"><strong >Redeem Amount (<span id="redeem_point_total"> 0 </span> Point) =<span id="redeem_amount_total"> 0</span></strong></div>  
                                <div id="point_amount_show" style="width:50%;text-align: right;float: right;padding-right: 0;height: 18px; margin-top: 5px;display: none" class="lable_counter_paymnet_cc counter_right_lable"><strong style="float:right"> Total Before Redeem = <span id="total_before_redeem"> 0 </span> </strong></div>                          
            </div>
            
<div class="print-bill-in-tableselection-popup-btm-gst-sec" style="display:none">
            	<div class="col-md-4" >
                     <input type="text" class="tbl-gst-name-textbox"  placeholder="Customer Name" id="billname">
                </div>
                <div class="col-md-4" style="padding-left:0">
                      <input type="text" class="tbl-gst-name-textbox" placeholder="Contact Number" id="billnum" onclick="return manualamount(this.id)">
                </div>
                <div class="col-md-4" style="padding-left:0">
                    <input type="text" class="tbl-gst-name-textbox" placeholder="GST Number" id="billgst" autocomplete="off" readonly  onfocus="this.removeAttribute('readonly');">
                </div>
            </div>
           

        
        </div>
                              
         <div class="print-bill-in-tableselection-popup-contant" style="width: 30%;background-color: #efefef;height: 100%;margin-top: 0px;position: relative">
                  
                   <div class="table_sel_loyalty_btn_area">
                           <a href="#" class="print-bill-popup-close"><div class="print-bill-in-tableselection-popup-cls"><img src="img/red_cross.png"></div></a>
                           	
                           <a style="display: none" href="#"><div class="register_loyalty_table_selection loyalty-btn">
                           		<img src="img/user-loyalty-icon.png" title="Register">
                                 Reg Loyalty 
                           </div></a>
                           
                           <a href="#"><div class="register_loyalty_table_selection settle-btn" style="display: none;    background-color: #8a400e;border-bottom: 4px #652d07 solid;">
                           		<img  src="img/bill-icon.png" title="Settle Bill">
                                Back
                           </div></a>
                       <?php if($loy_sts=='Y'){ ?>
                       <a href="#"><div class="register_loyalty_table_selection redeem_btn">
                           		<!--<img src="img/user-loyalty-icon.png" title="Redeem">-->
                                 Add/Redeem 
                           </div></a>
                       <?php  } ?>
                           
                            <a href="#"><div class="register_loyalty_table_selection settle-btn1" style="display: none;    background-color: #8a400e;border-bottom: 4px #652d07 solid;">
                           		<img  src="img/bill-icon.png" title="Settle Bill">
                                Back 
                           </div></a>
                           
                    </div>
                           
                       <div id="register-loyalty" class="table_bill_print_disc_contant" style="padding-top: 0;display: none">
                           		<div class="loyalty_reg_hd" style="">Register Loyalty</div>
						   		
						   		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">First Name</div>
										<div class="table_bill_print_disc_input_cc">
							<input type="text" onkeyup="validate_name(event);" class="table_bill_print_disc_input" id="firstname">
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Last Name</div>
										<div class="table_bill_print_disc_input_cc">
							<input onkeyup="validate_lname(event);" type="text" class="table_bill_print_disc_input" id="lastname" >
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Phone</div>
										<div class="table_bill_print_disc_input_cc">
											<input onkeypress="return numdot(event);" id="phone"  type="text" class="table_bill_print_disc_input">
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Email</div>
										<div class="table_bill_print_disc_input_cc">
											<input id="email" type="text" class="table_bill_print_disc_input">
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Bithday</div>
										<div class="table_bill_print_disc_input_cc">
											<input id="datepicker" type="text" class="table_bill_print_disc_input bday">
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Gender</div>
										<div class="table_bill_print_disc_input_cc">
											<select class="table_bill_print_disc_input" id="gender">
												<option value="M">Male</option>
                                                                                                <option value="F">Female</option>
											</select>
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">M Status</div>
										<div class="table_bill_print_disc_input_cc">
                                                                                    <select class="table_bill_print_disc_input" id="marital">
												<option value="single">Single</option>
												<option value="married">Married</option>
											</select>
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Anniversary</div>
										<div class="table_bill_print_disc_input_cc">
											<input id="datepicker1"  type="text" class="table_bill_print_disc_input anniversary">
										</div>
                           		</div>
                           		<div class="table_bill_print_disc_contant_box">
									<div class="table_bill_print_disc_name">Proffession</div>
										<div class="table_bill_print_disc_input_cc">
				<select class="table_bill_print_disc_input" id="profession"> 
                                            
                            <?php
                            $loy_qry1 = $database->mysqlQuery("select * from tbl_profession_master  ");
                            $num_loy1 = $database->mysqlNumRows($loy_qry1);
                             if($num_loy1)
                             {
                                 while($loyalty_listing_edit = $database->mysqlFetchArray($loy_qry1))
                                 {

                                ?>

                            <option selected='selected' value='<?=$loyalty_listing_edit['pr_name']?>' ><?=$loyalty_listing_edit['pr_name']?></option>
                            <?php 

                                 }
                                 }
                                   ?>                                
                                    </select>
										</div>
                           		</div>
                           		<div class="checkbox table_bill_print_disc_contant_box " style="width: 50%;margin-top: 15px;"> 
                                          <input style="width: 100%;" id="checkbox_mail" type="checkbox">
                                          <label for="checkbox2">
                                              MAIL 
                                          </label>
                                      </div>
                                      <div class="checkbox table_bill_print_disc_contant_box" style="width: 50%;margin-top: 15px;">
                                          <input style="width: 100%;" id="checkbox_sms" type="checkbox">
                                          <label for="checkbox2">
                                              SMS 
                                          </label>
                                      </div>
                                      
                                      <a href="#" onclick="return submit_loyalty(event);"><div class="submit-form-btn">Register</div></a>
						     <strong id="error_show" style="width:100%;float:left;text-align: center;color: red;margin: 8px 20px 0 0"></strong>
			 			</div>
             
             <div id="redeem-loyalty" class="table_bill_print_disc_contant" style="padding-top: 0;display: none">
                           		<div class="loyalty_reg_hd" style="">
                                            <a style="float:left;margin-top: -5px" title="BILL DETAILS" href="#" onclick="return list_loyalty_bill();" class="action-btn"><img style="border:solid 1px " src="img/rate.png"></a>
                                            Add/Redeem Loyalty
                                        </div>
                 
                 <div id="loyaltydiv" class="loyalty_sec_cc loyalt_table_sel_print"  >
                       
                       
                           <div class="selecting_payment_one" style="position:relative">
                                        <div class="lable_counter_paymnet_cc counter_right_lable" >Loyalty ID</div>
                                        <input placeholder="Loyalty ID" class="tax_textbox transa_txt counter_text_box" onkeyup="return search_id(event);" onfocus="return search_id(event);"  onkeypress="return numdot(event);"  onclick="return search_id(event);"  id="ly_id"  autocomplete="off" autofocus >
                                         <div id="id_load" class="customer_list_autoload" style="display:none;">
                                             <ul >
                                                                                                <li onclick="return id_click();" style="cursor: pointer">
                                                                                                    
                                                                                                </li>
                                                                                            </ul>
                                                                                                </div>
                                    </div>
                                    
                           <div class="selecting_payment_one"  style="position:relative" >
                                        <div class="lable_counter_paymnet_cc counter_right_lable" >Name</div>
                                       
                                        <input placeholder="Customer Name" class="tax_textbox transa_txt counter_text_box" onclick="return search_name(event);" onfocus="return search_name(event);"  onkeyup="return search_name(event);" id="ly_name"  autocomplete="off">
                                   <div id="name_load" class="customer_list_autoload" style="display:none;">
                                                                                            <ul>
                                                                                                <li onclick="return name_click();" style="cursor: pointer">
                                                                                                    
                                                                                                </li>
                                                                                            </ul>
                                                                                                </div>
                                         
												
                                    
                                    </div>
                                    
                                    <div class="selecting_payment_one" style="position:relative">
                                        <div class="lable_counter_paymnet_cc counter_right_lable" >Mobile No</div>
                                        <input placeholder="Mobile No" class="tax_textbox transa_txt counter_text_box" onclick="return search_number(event);" onkeypress="return numdot(event);" onfocus="search_number(event);" onkeyup="search_number(event);" id="ly_number" autocomplete="off">
                                     <div id="number_load" class="customer_list_autoload" style="display:none;">
                                                                                            <ul>
                                                                                                <li onclick="return number_click();" style="cursor: pointer">
                                                                                                    
                                                                                                </li>
                                                                                            </ul>
                                                                                                </div>
												
                                    
                                    
                                    </div>
                           
                           <div class="selecting_payment_one" style="position:relative">
                                        <div class="lable_counter_paymnet_cc counter_right_lable" >Total Points</div>
                                        <input placeholder="Customer Points" class="tax_textbox transa_txt counter_text_box"  id="ly_points" autocomplete="off" readonly>
                                     
                                    </div>
                           
                           
                           
                                    
                                    <div class="selecting_payment_one">
                                        <div class="lable_counter_paymnet_cc counter_right_lable" > Redeem Point</div>
                                        <input placeholder="Points to Redeem" class="tax_textbox transa_txt counter_text_box" onkeypress="return numdot(event);" onclick="return redeem_point(event);" onchange="return redeem_point(event);"   id="redeem_point" onkeyup="return redeem_point();" autocomplete="off">
                                    </div>
                                    
						   			<div class="selecting_redeem_btn_cc">
						   				
						   				
						   				
                                            <div style="float:right;cursor: pointer;width:100%" class="selecting_redeem_btn_div">
                                                <div style="display: none " class="selecting_redeem_btn1" id="cont_click" >Continue</div>
						   					<div class="selecting_redeem_btn" id="redeem_btn_click" >Redeem</div>
                                            <div class="selecting_redeem_btn" id="clear_btn_click" style="display:none" >Clear All</div>
                                           </div>
                                          
						   			</div>
                      
                     <span style="width: 100%;height: 35px;float: left">
                     <strong id="loy_error" style="color:red;width:100% !important;line-height: 17px;float:left"> </strong>

                     <div class="selecting_redeem_value_show" style="width:100%">
                                                <span style="line-height: 18px;text-align: center;" class="redeeming_value_total"></span>
						   					    <span style="line-height: 18px;text-align: center;" class="redeeming_value_total_offer"></span>
						   				    </div>
                    </span>
                       
                     
                     
                     
                     <div class="keys settle_key" style="margin-top:0px;padding: 0 0 2% 2%;">
                                <span class="pay_settle_btn">1</span>
                                <span class="pay_settle_btn">2</span>
                                <span class="pay_settle_btn">3</span>
                                <span class="pay_settle_btn">4</span>
                                <span class="pay_settle_btn">5</span>
                                <span class="pay_settle_btn">6</span>
                                <span class="pay_settle_btn">7</span>
                                <span class="pay_settle_btn">8</span>
                                <span class="pay_settle_btn">9</span>
                                <span class="pay_settle_btn">0</span>
                                <span class="pay_settle_btn">.</span>
                                <span class="pay_settle_btn">Clear</span>
                                <!--<span class="calculator_settle">Enter</span>-->
                            </div>
                       
			    </div>
             
                            </div>
                          
                              <?php
                            
                            $loy_qry14 = $database->mysqlQuery("select be_printwithdiscount from tbl_branchmaster");
                            $num_loy14 = $database->mysqlNumRows($loy_qry14);
                             if($num_loy14)
                             {
                                 while($loyalty_listing_edit4 = $database->mysqlFetchArray($loy_qry14))
                                 {
                                    
                                     $dis_on_off=$loyalty_listing_edit4['be_printwithdiscount'];
                                     
                                }}
                                ?>
             
             
             
             
                           <div id="stlle-bill" class="table_bill_print_disc_contant" style="padding-top: 0;">
                             <div class="loyalty_discount_cc" style="min-height:288px;">
                                <?php  if($dis_on_off=='Y'){ ?>  
                                 <div class="auothorize_popup">
                                    <div class="auothorize_popup_head">Discount Authorization</div>
                                    <span style="text-align: center;width: 100%;float: left;color: red ;height:20px;"> <strong id="dis_error"></strong></span>
                                    <div class="discout_auth_contant">
                                        <div class="discout_auth_contant_textbox_name">Enter Your Pin</div>
                                        <input style="border-radius: 30px;outline: none !important " type="password" onkeypress=" return numdot(event);" onchange="return dis_pincheck()" onclick="return dis_pincheck()" onfocus="return dis_pincheck()" id="dis_pin" maxlength="4" class="discout_auth_contant_textbox" autocomplete="off" autofocus="">
                                    </div>

                                    <div class="auothorize_popup_footer_btn_cc">
                                        
                                        <div style="width: 35%;" class="btn_index_popup ">
                                             <a style="text-decoration:none" id="dis_auth_proceed" href="#" class="">Proceed</a>
                                         </div>
                                    </div>
                                </div>
                                   <?php }  ?>
                                 
                              <?php  if($dis_on_off=='Y'){ ?>
                           		<div class="table_print_bill_disc_head" style="position: relative">Enter Discount 
                           		 
                                        </div>
                                    <div class="table_bill_print_disc_contant_box">
                          		<div class="table_bill_print_disc_name">Type</div>
                           		<div class="table_bill_print_disc_input_cc">
                                        <select class="table_bill_print_disc_input" id="disountamount_drop" onchange="dischange();">
                                            <option value=""><?=$_SESSION['completed_order_popup_type_none']?></option>
                                            <?php
                                            $sql_listall_dsc  =  $database->mysqlQuery("SELECT * from tbl_discountmaster where ds_status='Active' "); 
                                            $num_listall_dsc  = $database->mysqlNumRows($sql_listall_dsc);
                                            if($num_listall_dsc){
                                                while($row_listall_dsc  = $database->mysqlFetchArray($sql_listall_dsc)) 
                                                    {
                                                    ?>
                                                <option mode_ds="<?=$row_listall_dsc['ds_mode']?>" val_ds="<?=$row_listall_dsc['ds_discountof']?>" value="<?=$row_listall_dsc['ds_discountid']?>" ><?= $row_listall_dsc['ds_discountname']//$row_listall_dsc['ds_discountname']?></option>
                                               <?php } } ?>
                           		</select>
                           		</div>
                           		</div>
                               
                                 <div class="table_bill_print_disc_contant_box manual_permission_on " style="display:none">
                           		<div class="table_bill_print_disc_name" >Manual </div>
                           		<div class="table_bill_print_disc_input_cc" style="width: 35%">
                                            <input class="table_bill_print_disc_input" type="text" id="disountamount" onclick="return manualamount(this.id)" onchange="return manualamount(this.id)" onfocus="return manualamount(this.id)">
                           		</div>
                           		<div class="table_bill_print_disc_input_cc" style="width: 33%;float: right">
                           			<select class="table_bill_print_disc_input" id="discountmode">
                           				<option value="P">%</option>
                           				<option value="V">Value</option>
                           			</select>
                           		</div>
                           	  </div>
                                 <div><p id="load_discount_data" style="text-align: center;"></p></div> 
                              <?php  } ?>
                                 
                                 <div class="alert_billprnt_pop" style="display:none"><strong id="alert_billprnt_pop"></strong></div>
<!--                           	  <div class="table_print_bill_disc_head" style="margin-top: 7px">Loyalty </div>
                           	  
                           	  <div class="table_bill_print_disc_contant_box">
                           		<div class="table_bill_print_disc_name">Mobile </div>
                           		<div class="table_bill_print_disc_input_cc">
                           			<input class="table_bill_print_disc_input" type="text">
                           		</div>
                           	  </div>
                           	  <div class="table_bill_print_disc_contant_box">
                           		<div class="table_bill_print_disc_name">Points </div>
                           		<div class="table_bill_print_disc_input_cc">
                           			<input class="table_bill_print_disc_input" value="355" readonly type="text">
                           		</div>
                           	  </div>
                           	   <div class="table_bill_print_disc_contant_box">
                           		<div class="table_bill_print_disc_name">Redeem </div>
                           		<div class="table_bill_print_disc_input_cc">
                           			<input class="table_bill_print_disc_input" type="text">
                           		</div>
                           	  </div>
                           	  <div class="table_bill_print_disc_contant_box">
                           		<div class="table_bill_print_disc_name">Balance </div>
                           		<div class="table_bill_print_disc_input_cc">
                           			<input class="table_bill_print_disc_input" value="255" readonly type="text">
                           		</div>
                           	  </div>-->
                           	 
                           	  </div><!--loyalty_discount_cc-->
                           	  
                           	  <div class="keys settle_key" style="margin-top:5px;padding: 0 0 2% 2%;">
                                <span class="pay_settle_btn">1</span>
                                <span class="pay_settle_btn">2</span>
                                <span class="pay_settle_btn">3</span>
                                <span class="pay_settle_btn">4</span>
                                <span class="pay_settle_btn">5</span>
                                <span class="pay_settle_btn">6</span>
                                <span class="pay_settle_btn">7</span>
                                <span class="pay_settle_btn">8</span>
                                <span class="pay_settle_btn">9</span>
                                <span class="pay_settle_btn">0</span>
                                <span class="pay_settle_btn">.</span>
                                <span class="pay_settle_btn">Clear</span>
                                <!--<span class="calculator_settle">Enter</span>-->
                            </div>
                          	  <?php  if(in_array("Completed Order", $_SESSION['menumodarray'])) { ?> 
                          	  <a href="#"><div style="width: 50%;padding-top: 11px;margin-left: 3px;" class="print-bill-in-tableselection-popup-btn" id="print_bill_from_tablesel">
									<img src="img/print_re.png">
									Print Bill 
                                    </div></a>
                                  
                                  
                                  <?php if($_SESSION['s_print_option']=='Y' ){ ?>
                                  <a href="#">     
                                  <div style="width: 48%;padding-top: 11px;background-color: red" class="print-bill-in-tableselection-popup-btn" id="no_print_di_new">
                                      <img src="img/close-icon.jpg">
				No Print 
                                </div>
                                      
                                  </a>
                                  <?php } ?> 
                                  

                             <?php }else{ ?>  

                              <a href="#">     
                                  <div style="width: 48%;padding-top: 11px;font-size: 12px;background-color: red" class="print-bill-in-tableselection-popup-btn" id="">
				
				No Permission
                                </div>
                               </a>
                        <?php }  ?>  
                           	  
                           	  
                           	  
                           </div>               
		</div>
                               
        
                    
							       
    </div><!--print-bill-in-tableselectio-popup-->
    
   <input type="hidden" name="focusedtext" id="focusedtext" />
    
    <div class="kotcancel_reason_popup_new" id="kotcancel_reason_popup_new" style="display:none;top:16%;left: 0;right: 0;">
       
      
        
         <input type="hidden" name="slno_dynamic_menu" id="slno_dynamic_menu" />
          <input type="hidden" name="order_dynamic_menu" id="order_dynamic_menu" />
          <input type="hidden" name="kot_dynamic_menu" id="kot_dynamic_menu" />
          
         
 <div class="kotcancel_reason_popup_new_left_cc">
    <div class="kotcancel_reason_popup_new_head"><img class="auth_head_ico" src="img/alert.png" /> Authorisation</div>
    <div class="kotcancel_reason_popup_new_textbox_contant">
    

        <div style="width: 100%;float: left;height: 20px;line-height: 10px;text-align: center"><span id="pin_error1" style="color:red;"></span></div>
        <div class="kotcancel_reason_popup_new_textbox_cc" style="margin-bottom:10px;">
            <input type="password" class="kotcancel_reason_popup_new_textbox_input" placeholder="CODE" id="pin_new"  onkeypress="return numonly(event)" onclick="return addpin();" onchange="return addpin();"  maxlength="4" autocomplete="off" autofocus/>
        </div>
    </div>
    <div class="kotcancel_reason_popup_new_textbox_btn_cc">
        <a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_cancel_btnrate">Cancel</div></a>
    	<a href="#"><div class="kotcancel_reason_popup_new_textbox_btn" id="kotcancel_reason_popup_new_proceed_btnrate">Proceed</div></a>
    </div>
  </div><!--kotcancel_reason_popup_new_left_cc-->
  <div class="kotcancel_reason_popup_new_right_cc">
      <div class="keys settle_key" style="margin-top:0">
            <span class="calculator_settle">1</span>
            <span class="calculator_settle">2</span>
            <span class="calculator_settle">3</span>
             <span class="calculator_settle_back">&nbsp;</span>
            <span class="calculator_settle">4</span>
            <span class="calculator_settle">5</span>
            <span class="calculator_settle">6</span>
             <span class="calculator_settle">Clear</span>
            <span class="calculator_settle">7</span>
            <span class="calculator_settle">8</span>
            <span class="calculator_settle">9</span>
            <span class="calculator_settle">0</span>
        </div>
  </div><!--kotcancel_reason_popup_new_right_cc-->
</div>

    
    <div  class="confrmation_overlay_new" style="display:none;"></div>
    <div  class="confrmation_overlay_2nd" style="display:none;width: 100%;height: 100%;position: fixed;background-color: rgba(0,0,0,0.8); top: 0;z-index: 99999999999"></div>
    
<?php } ?>
  <div style="display:none;height: auto;padding-bottom: 15px;top:40%;bottom: inherit;" class="index_popup_1 closeoneclass kotconfirmpopup">
        <span id="kotfailmsg" style="text-align: center;width: 100%;float: left ;padding-top: 7px;"></span>
 	<div class="index_popup_contant">Are you sure you want continue without Bill Print ?</div>
    <div class="index_popup_contant">
        <?php
         $sql_listall_dsc1  =  $database->mysqlQuery("SELECT * from tbl_branch_settings_printer "); 
			  $num_listall_dsc1  = $database->mysqlNumRows($sql_listall_dsc1);
			  if($num_listall_dsc1){
					while($row_listall_dsc1  = $database->mysqlFetchArray($sql_listall_dsc1)) 
						{
                         $billonoff=$row_listall_dsc1['bp_print_proceed_btn'];  
                         if($billonoff=='Y'){
        ?>
        
        
    	<div class="btn_index_popup"><a href="#" class="confirmbillok">Yes</a></div>
                         <?php } } }?>
        
        <div class="btn_index_popup"><a href="#" class="confirmbillclose">Cancel</a></div>
    </div>
 </div>  
    
    
    
    <style> .loyalty_cs_pop_overlay1{
    width:100%;
	height:100%;
	position:absolute;
	z-index:999;
	background-color: rgb(0 0 0 / 80%);
    top:0;
    display:flex;
    align-items:center;
    justify-content: center;
 }
 .loyalty_cs_pop_overlay1 img{width:150px}
    </style>
    <div class="loyalty_cs_pop_overlay1" style="display: none "><img src="img/ajax-loaders/pls_wait.gif"></div>
    
    

<script>
	$(".loyalty-btn").click(function(){
    	$("#stlle-bill").hide();
		$("#register-loyalty").show();
		$(".settle-btn").show();
		$(".loyalty-btn").hide();
                $(".settle-btn1").hide();
        $('#firstname').focus(); 
        $(".redeem_btn").show();
         $("#redeem-loyalty").hide();
        
	});
	$(".settle-btn").click(function(){
    	$("#stlle-bill").show();
		$("#register-loyalty").hide();
		$(".settle-btn").hide();
                $(".settle-btn1").hide();
		$(".loyalty-btn").show();
        $(".redeem_btn").show();
        $("#redeem-loyalty").hide();
	});
    
    $(".redeem_btn").click(function(){
    	          $("#stlle-bill").hide();
		$("#register-loyalty").hide();
		$(".settle-btn1").show();
                $(".settle-btn").hide();
		$(".redeem_btn").hide();
                 $(".loyalty-btn").show();
		$("#redeem-loyalty").show();
	});
        
        $(".settle-btn1").click(function(){
    	$("#stlle-bill").show();
		$("#register-loyalty").hide();
		$(".settle-btn1").hide();
                $(".settle-btn").hide();
		$(".redeem_btn").show();
                $(".loyalty-btn").show();
      
               $("#redeem-loyalty").hide();
	});
        
        
        
        $("#cont_click").click(function(){
    	$("#stlle-bill").show();
		$("#register-loyalty").hide();
		$(".settle-btn1").hide();
                $(".settle-btn").hide();
		$(".redeem_btn").show();
                $(".loyalty-btn").show();
      
               $("#redeem-loyalty").hide();
	});
</script>
    
    
<script>
    
    function validate_name(){
     var textInput = document.getElementById("firstname").value;
    textInput = textInput.replace(/[^A-Za-z0-9 ]/g, "");
    document.getElementById("firstname").value = textInput;
    
    
    
    }
    
      function validate_lname(){
     var textInput = document.getElementById("lastname").value;
    textInput = textInput.replace(/[^A-Za-z0-9 ]/g, "");
    document.getElementById("lastname").value = textInput;
    }
    
    
     function numdot(e) {     
   
            var charCode;
            if (e.keyCode > 0) {
                charCode = e.which || e.keyCode;
            }
            else if (typeof (e.charCode) != "undefined") {
                charCode = e.which || e.keyCode;
            }
            if (charCode == 43)
                return true
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                 
                return false;
            return true;
          
        } 
        
     function submit_loyalty(event){
         
                   var fname=$('#firstname').val();
                   var lname=$('#lastname').val();
                   var phone=$('#phone').val();
                   var bday=$('.bday').val();
                    var email=$('#email').val();
                   var marital=$('#marital').val();
                   var anvy=$('.anniversary').val();
                   var prof=$('#profession').val();
                   var gender=$('#gender').val();
             
                   var chk_mail;
                   if($("#checkbox_mail").is(':checked'))
		   {
                             chk_mail='Y';              
                   }else{
                             chk_mail='N';
                   }
                            
                   var chk_sms;
                   if($("#checkbox_sms").is(':checked'))
		   {
                   chk_sms='Y';              
                   }else{
                   chk_sms='N';
                   }
                   
                   
                   $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=mobileadd_loyalty&mid="+phone,
			success: function(msg)
			{
			msg=$.trim(msg);
				
				if(msg =="sorry")
					{
                                            
		$("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Number Already Exists');	
	       $("#error_show").delay(2000).fadeOut('slow');
		$('#phone').focus();	    
					}
					else
					{
               
                  $.ajax({
			type: "POST",
			url: "load_divcheckmenu.php",
			data: "value=mailadd_loyalty&mid="+email,
			success: function(msg1)
			{
			msg1=$.trim(msg1);
			
			if(msg1 =="sorry" && email!='')
			{
                                            
	       $("#error_show").show();
               var error_show=$('#error_show');
	       error_show.text('Mail Already Exists');	
	       $("#error_show").delay(2000).fadeOut('slow');
		$('#email').focus();	    
					}
					else
					{
                   
                  var len=$('#phone').val().length;
                  
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

   

                  if(phone!="" && len>='10' && fname!="") {   
                      
                     
         var data="set_add=add_loyalty&fname="+fname+"&lname="+lname+"&email="+email+"&bday="+bday+"&phone="+phone+"&marital="+marital+"&anvy="+anvy+"&prof="+prof+"&chk_mail="+chk_mail+"&chk_sms="+chk_sms+"&gender="+gender;
     
        $.ajax({
        type: "POST",
        url: "load_print_bill_view.php",
        data: data,
        success: function(data)
        {      $('#gender').val('M');
               $('#firstname').val('');
               $('#lastname').val('');
               $('#phone').val('');
               $('.bday').val('');
               $('#email').val('');
               $('#marital').val('single');
               $('.anniversary').val('');
               $('#profession').val('');
               $('#checkbox_mail').attr('checked', false);
               $('#checkbox_sms').attr('checked', false);
               
              
               $("#error_show").show();
               var success_show=$('#error_show');
	       success_show.text('Registration Successfull');	
	       $("#error_show").delay(2000).fadeOut('slow');
               
        }
    });
     setTimeout(function(){
                $("#stlle-bill").show();
		$("#register-loyalty").hide();
		$(".settle-btn").hide();
		$(".loyalty-btn").show();
                 }, 1500);
                 
                   
                 
    }else{
       
              
               $("#error_show").show();
               var error_show=$('#error_show'); 
             if($('#phone').val()==""){
                $('#phone').focus();
                 error_show.text('Enter Number');	
            }
            if($('#firstname').val()==""){
                $('#firstname').focus();
                 error_show.text('Enter Name');	
            }
            if($('#phone').val()!="" && len<10){
                $('#phone').focus(); 
                 error_show.text('Enter Valid Number');	
            }
            
	      
	       $("#error_show").delay(2000).fadeOut('slow');
    }
    
    
                                        } } });
                     } } });
    
    
    
    
    } 
    
    
     function dischange(){
     
     var ds=$('#disountamount_drop').val();
     
     if(ds!=''){
         $("#disountamount").val('');
          $("#disountamount").attr('disabled',true);
          $("#discountmode").attr("disabled",true);
          
          
      }else
      {
        $("#disountamount").attr('disabled',false); 
        $("#discountmode").removeAttr('disabled');
      }
    }
    
    
    
    $("#disountamount_drop").change(function(){
           
            var mode =  $('option:selected', this).attr('mode_ds');
             
             var mode_value=parseFloat($('option:selected', this).attr('val_ds')); 
            
             
             if(mode=='V' ){ 
                 
              
              
              $('#load_discount_data').show();
                 document.getElementById("load_discount_data").style.color = "black";
                $('#load_discount_data').text(' Value : '+mode_value);
                
              
             }
             
             if(mode=='P'){ 
               
                  $('#load_discount_data').show();
                 document.getElementById("load_discount_data").style.color = "black";
                $('#load_discount_data').text(' % : '+mode_value);
             }
             
             
            if(mode==undefined || mode=='undefined' ){ 
               
                 $('#load_discount_data').text('');
             }
             
             
        });
          
   
  $( "#disountamount" ).keyup(function() {
      var ds1= $("#disountamount").val();
     
    if(ds1!=''){
        $('#disountamount_drop').val(""); 
        $('#disountamount_drop').attr("disabled",true);
        
        if($("#discountmode").val()=='P' && parseFloat($("#disountamount").val())>=100){
            $( "#disountamount" ).val("");
            
            $('.alert_billprnt_pop').css('display','block');
            $('#alert_billprnt_pop').text("Discount should be less than 100%");
            $('.alert_billprnt_pop').delay(2000).fadeOut('slow');
        }
        else if($("#discountmode").val()=='V' && parseFloat($("#disountamount").val())>=parseFloat($('#billtotal').val())){
            $( "#disountamount" ).val("");
            $('.alert_billprnt_pop').css('display','block');
            $('#alert_billprnt_pop').text('Discount should be less than Total Amount');
            $('.alert_billprnt_pop').delay(2000).fadeOut('slow');
        }
    }else{
      $('#disountamount_drop').removeAttr('disabled');
      
   }
 
  });
  
    function manualamount(id){
       $('#focusedtext').val(id);
       var ds1= $("#disountamount").val();
        if(ds1!=''){
        $('#disountamount_drop').val(""); 
        $('#disountamount_drop').attr("disabled",true);
        
        if($("#discountmode").val()=='P' && parseFloat($("#disountamount").val())>=100){
            $( "#disountamount" ).val("");
            
            $('.alert_billprnt_pop').css('display','block');
            $('#alert_billprnt_pop').text("Discount should be less than 100%");
            $('.alert_billprnt_pop').delay(2000).fadeOut('slow');
        }
        else if($("#discountmode").val()=='V' && parseFloat($("#disountamount").val())>=parseFloat($('#billtotal').val())){
            $( "#disountamount" ).val("");
            $('.alert_billprnt_pop').css('display','block');
            $('#alert_billprnt_pop').text('Discount should be less than Total');
            $('.alert_billprnt_pop').delay(2000).fadeOut('slow');
        }
 }else{
      $('#disountamount_drop').removeAttr('disabled');
      
 }
      
   }
    function subrate1(slno,order,kot){
           
            
            $('#slno_dynamic_menu').val(slno);
            $('#order_dynamic_menu').val(order);
            $('#kot_dynamic_menu').val(kot);
            $('.confrmation_overlay_new').css('display','block');
            $('#kotcancel_reason_popup_new').css('display','block');
            document.getElementById('pin_new').focus();
    }  
    function numonly(evt)
        {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

             return false;

         }
         return true;
        }


 $('#pin_new').keypress(function(ev){
     
            if(ev.keyCode == 13){
                ev.stopImmediatePropagation();
                $('#kotcancel_reason_popup_new_proceed_btnrate').trigger('click');
            }
        });

    
    $(document).ready(function(){
        
        
       $("#disountamount_drop").change(function(){
           
            var mode =  $('option:selected', this).attr('mode_ds');
             var mode_value=parseFloat($('option:selected', this).attr('val_ds')); 
             var sub_ds=parseFloat($('#subtotal_loy').text().replace(',',''));
             
          
             if(mode=='V' && mode_value>=sub_ds){ 
                // alert('Discount Value Cant be greater than Subtotal');
                $('#disountamount_drop').val('');
                
                 $('#load_discount_data').show();
                 document.getElementById("load_discount_data").style.color = "red";
                $('#load_discount_data').text('Discount Value Cant be greater than Subtotal');
                
                 $('#load_discount_data').delay(500).fadeOut('slow');
                
             }
             
             if(mode=='P' && mode_value>99){ 
                // alert('Discount % Cant be greater than Subtotal');
                $('#disountamount_drop').val('');
                
                $('#load_discount_data').show();
                document.getElementById("load_discount_data").style.color = "red";
              $('#load_discount_data').text('Discount % Cant be greater than Subtotal');
                $('#load_discount_data').delay(500).fadeOut('slow');
                
             }
             
             
        }); 
        
        
        
        
        
        $('#dis_pin').focus();
        
        
        if($('.kotcancel_reason_popup_new').is(':visible')){
               
            }
        $('.hiddenrate').click(function(){
            $('#focusedtext').val($(this).attr('id'));
            
        });
    $('.pay_settle_btn').click( function(event) {
          
         
		event.stopImmediatePropagation();
               
		var focused=$('#focusedtext').val();
      
		var calval=($(this).text());//alert(focused);alert(calval);
		
		var org=$('#'+focused).val();
                
			if(calval>=0)
			{   
                            if(org.length < 6 ||(org.length < 13 && focused=='billnum')){
				if(org==0)
				{
					 $('#'+focused).val(calval);
				}else if(parseFloat(org)>0)
				{ 
					$('#'+focused).val(org+calval);
				  
				}else if(org<0)
				{
					$('#'+focused).val(org+calval);
				}
                                else if(org=='.' && focused=='disountamount')
				{
					$('#'+focused).val(org+calval);
				}
                            }
//                            
			}else if(calval=="Clear")
			{
				$('#'+focused).val("");
			}else if(calval=="." && focused=='disountamount')
			{
				$('#'+focused).val(org+".");
			}
			$('#'+focused).change();
		$('#'+focused).focus();
		
		
		
	}); 
        
    $('#kotcancel_reason_popup_new_cancel_btnrate').click(function(){
        $('.kotcancel_reason_popup_new').css('display','none');
        $('.confrmation_overlay_new').css('display','none');
    });   
    
    $('#kotcancel_reason_popup_new_proceed_btnrate').click(function(){
 
       
            var pin =  $('#pin_new').val();
              
            if(pin !=''){
              $.post("load_div.php", {pin:pin,type:'authpincheck',set:'pincheck'},
		function(data)
		{  //alert(data.trim());
                    if(data.trim()!="NO")
                    {
                        var data1=data.split('*');
                        data1=$.trim(data1[0]);
                        //alert(data1);
                        
                        var menu_slno=$('#slno_dynamic_menu').val();
                        var order_no=$('#order_dynamic_menu').val();
                         var kot_no=$('#kot_dynamic_menu').val();
                        
                        var rt=$('#hiddenrate'+order_no+menu_slno+kot_no).val();
                        var datastringnew="setrate=hiddenrate&mnrate="+rt+"&menu_slno="+menu_slno+"&order_no="+order_no+"&kot_no="+kot_no;
                        //alert(datastringnew);
       
                        $.ajax({
                            type: "POST",
                            url: "load_completedorder.php",
                            data: datastringnew,
                            success: function(data)
                            {
                                       
                                $('.kotcancel_reason_popup_new').css('display','none');
                                $('.confrmation_overlay_new').css('display','none');
                                $(".print-table-btn").click();
                            }
                        });  
                    }
                   
                    else{
                        
                        $("#pin_error1").css("display","block");
			$("#pin_error1").text("CODE NOT REGISTERED!");
			$("#pin_error1").delay(2000).fadeOut('slow');
                        $("#pin_new").val('');
                    }
                    
                });    
            }
        });
        
        $('.calculator_settle').click( function(event) {
            //alert('hi');
           
		event.stopImmediatePropagation();
               
		var calval1=($(this).text());
               
		
		var org1=$('#pin_new').val();
                //alert(org.length);
			if(calval1>=0)
			{   //alert('1');
                            if(org1.length < 6){
                                //alert('2');
				if(org1==0)
				{   //alert('3');
					 $('#pin_new').val(calval1);
                                         
				}else if(org1>0)
				{//alert('4');
					$('#pin_new').val(org1+calval1);
				  
				}else if(org1<0)
				{
					$('#pin_new').val(org1+calval1);
				}
                            }
//                            
			}else if(calval1=="Clear")
			{
				$('#pin_new').val("");
			}else if(calval1==".")
			{
				$('#pin_new').val(org1+".");
			}
//			//$('#pin').change();
		$('#pin_new').focus();
		
		
		
	});
    });
    
    
    
    function item_dis_bill(mn,ord,p,u,b,bw,sl,rate,incl,menu){
        
         $('#add_stock_pop').show();
         $('#item_dis_val').val('');
         $('#item_dis_val').focus();
         
           $('#add_stock_pop').attr('menu',mn); 
           $('#add_stock_pop').attr('order',ord); 
           $('#add_stock_pop').attr('sl',sl); 
            $('#add_stock_pop').attr('rate',rate); 
             $('#add_stock_pop').attr('portion',p); 
              $('#add_stock_pop').attr('base',b); 
               $('#add_stock_pop').attr('baseweight',bw); 
                $('#add_stock_pop').attr('unit',u); 
                $('#add_stock_pop').attr('incl_rate',incl);
                 $('#name_dis_new').text(menu+' : '+rate);
                
    }
    
    
       function go_dis(){
        
          var mn = $('#add_stock_pop').attr('menu'); 
          var ord =$('#add_stock_pop').attr('order'); 
          var sl    = $('#add_stock_pop').attr('sl'); 
          var rate  = parseFloat($('#add_stock_pop').attr('rate')); 
          var dis   = parseFloat($('#item_dis_val').val()); 
          var p=$('#add_stock_pop').attr('portion'); 
          var b=  $('#add_stock_pop').attr('base'); 
          var bw=  $('#add_stock_pop').attr('baseweight'); 
           var u=   $('#add_stock_pop').attr('unit'); 
           
           var item_dis_type= $('#item_dis_type').val();
            var item_dis_val= $('#item_dis_val').val();
            
          var  incl_rate =parseFloat($('#add_stock_pop').attr('incl_rate')); 
           
           
           
           if(((dis>rate) && item_dis_type=='v') || ( item_dis_type=='p' && dis>=100) ){
               
               alert('Discount Must be less than Item Rate');
               
           }else{
               
               var dataString2 = 'set=item_dis_bill&mode=DI&menuid='+mn+"&type=plus&order_id="+ord+"&portion="+p+"&unit="+u+"&base="+b+"&baseweight="+bw+"&sl_no="+sl+"&item_dis_type="+item_dis_type+"&item_dis_val="+item_dis_val+"&rate="+rate+'&incl_rate='+incl_rate;
		
                            $.ajax({
				type: "POST",
				url: "load_index.php",
				data: dataString2,
				success: function(data2) {
                                       $('#add_stock_pop').hide(); 
                                       $('#item_dis_val').val('');
                                       $('#item_dis_type').val('v');
                                       
                                       
                                     detail_view(ord);  
                                }
                            });
               
           }
           
    } 
    
    
    
    function comp_bill(mn,ord,p,u,b,bw,sl){
        
    var check = confirm("MARKED ITEM WILL BE COMPLIMENTARY . NO RATE WILL BE INCLUDED IN BILL ?");
	if(check==true)
	{
            
            $('.loyalty_cs_pop_overlay1').show();
    
       if($("#comp_bill_"+mn+'_'+sl).prop('checked') == true){
            var chk='yes';
            
        }else{
             var chk='no';
        }
        
      var matches =  $('.comp_bill:checkbox:not(":checked")').length;
      
      if(matches>0){
        
          var dataString2 = 'set=comp_item_setup&mode=DI&menuid='+mn+"&type=plus&order_id="+ord+"&portion="+p+"&unit="+u+"&base="+b+"&baseweight="+bw+"&sl_no="+sl+"&chk="+chk;
				
                            $.ajax({
				type: "POST",
				url: "load_index.php",
				data: dataString2,
				success: function(data2) {
                     
                    // location.reload();
                    var tb=$('.table-num-prnt-pop').text();
                 
                      view_one_click(ord,tb);   
                     
                      $('.loyalty_cs_pop_overlay1').hide();
                 }
    });
    
            }else{
              
                $("#comp_bill_"+mn+'_'+sl).attr('checked',false);
                 
                $('.loyalty_cs_pop_overlay1').hide(); 
                alert('ONE ITEM SHOULD BE THERE FOR BILL PRINT WITH RATE ')
            }
    
    
        }else{
            
                    var tb=$('.table-num-prnt-pop').text();
                 
                     view_one_click(ord,tb);   
                     
                      $('.loyalty_cs_pop_overlay1').hide();
           // $("#comp_bill_"+mn+'_'+sl).attr('checked',false);
            
        }
    
    } 
    
    
    function addpin(){
        var pin=$('#pin_new').val();
      
        
    }
    
    
    function search_name(e){
    
      $('#focusedtext').val('ly_name');
     var name=$('#ly_name').val();
 if (e.keyCode ==40) { 
      
         $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Click On Name To Select");
	$('#loy_error').delay(2000).fadeOut('slow');

    }
     var data="set=searchname&name="+name;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        { 
             $('#name_load').show();
         
           $('#name_load').html(data);
           
        }
    });      
       
       if(name==''){
            var decimal=$('#decimal').val();
          
         
        $('#redeem_point_total').text(0)
        $('#redeem_amount_total').text(0);
        $('#total_before_redeem').text(0);
        
      //  $('#ly_id').val('');
      //  $('#ly_number').val(''); 
        $('#ly_points').val('');   
         $('#redeem_point').val('');
    }
}
function  name_click(n,i,num){

     var data="set=point_loyalty&pointid="+i;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        {
           
          var point=$.trim(data);
           $('#ly_points').val(point);   
        }
    });      
         
       $('#ly_id').val(i);
       $('#ly_name').val(n);
   
    $('#ly_number').val(num);
     $('#redeem_point').val(0)
     $('#id_load').hide();
    $('#name_load').hide();
     $('#number_load').hide();
     
    $("#ly_name").attr("name_id", i);
   
}



function search_number(e){
     $('#focusedtext').val('ly_number');
     var number=$('#ly_number').val();
   
   
     if (e.keyCode ==40){ 
              
        $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Click On Number To Select");
	$('#loy_error').delay(2000).fadeOut('slow');

    }
   
   
     var data="set=searchnumber&number="+number;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        {
           $('#number_load').show();
         
           $('#number_load').html(data);
           
        }
    });      
       
       if(number==''){
           var decimal=$('#decimal').val();
          
          $('#redeem_point_total').text(0)
           $('#redeem_amount_total').text(0);
        $('#total_before_redeem').text(0);
        
       // $('#ly_name').val(''); 
        $('#ly_points').val('');  
       // $('#ly_id').val('');
         $('#redeem_point').val('');
    }
}

function  number_click(n,i,num){
  
  var data="set=point_loyalty&pointid="+i;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        {
           
          var point=$.trim(data);
           $('#ly_points').val(point);   
        }
    });      
         
         
   $('#ly_name').val(n);
   
   $('#ly_number').val(num);
      $('#redeem_point').val(0)
    $('#number_load').hide();
     $('#id_load').hide();
      $('#name_load').hide();
      
    $("#ly_name").attr("name_id", i);
    $('#ly_id').val(i);
}


function search_id(e){
  
    $('#focusedtext').val('ly_id');
    
    if (e.keyCode ==40) { 
      
         $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Click On ID To Select");
	$('#loy_error').delay(2000).fadeOut('slow');

    }
    
     var id=$('#ly_id').val();
   
     var data="set=search_loyal_id&id_loyalty="+id;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        {
           $('#id_load').show();
         
           $('#id_load').html(data);
           
           
        }
    });      
       
       if(id==''){
           var decimal=$('#decimal').val();
         
          $('#redeem_point_total').text(0)
           $('#redeem_amount_total').text(0);
        $('#total_before_redeem').text(0);
        
      //  $('#ly_name').val(''); 
        $('#ly_points').val('');  
         // $('#ly_number').val('');  
          $('#redeem_point').val('');
    }
    
    
    
}

function  id_click(n,i,num){
  
  var data="set=point_loyalty&pointid="+i;
        $.ajax({
        type: "POST",
        url: "load_div.php",
        data: data,
        success: function(data)
        {
           
          var point=$.trim(data);
           $('#ly_points').val(point);   
        }
    });      
         
         
   $('#ly_name').val(n);
   $('#redeem_point').val(0);
   $('#ly_number').val(num);
    
    $('#ly_id').val(i);
     $('#id_load').hide();
     $('#number_load').hide();
       $('#name_load').hide();
    $("#ly_name").attr("name_id", i);
    
}


function redeem_point(){
  
    $('#focusedtext').val('redeem_point');
    var redeem_point=parseFloat($('#redeem_point').val());
     var redeem_point1=$('#redeem_point').val();
    var tot_point=parseFloat($('#ly_points').val());
    var loyalty_id=$('#ly_id').val();
    var number=$('#ly_number').val();
    var min_redeem=parseFloat($('#min_redeem').val());
    
   if(redeem_point1.length==0) {
     $('#redeem_point_total').text(0)
      $('#redeem_amount_total').text(0);
           
           var decimal=$('#decimal').val();
         
        $('#total_before_redeem').text(0);
   }
    
    if(redeem_point>tot_point){
        $('#redeem_point').val('0');
          $('#redeem_point_total').text(0)
           $('#redeem_amount_total').text(0);
           
           var decimal=$('#decimal').val();
          
        $('#total_before_redeem').text(0);
           
       $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("You have only "+tot_point+" Points");
	$("#loy_error").delay(3000).fadeOut('slow');
    }else if(loyalty_id==""  || number==""){
         $('#redeem_point').val('');
           $('#redeem_point_total').text(0)
           $('#redeem_amount_total').text(0);
           
           var decimal=$('#decimal').val();
          
        $('#total_before_redeem').text(0);
        
         $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Enter Loyalty Details ");
	$("#loy_error").delay(3000).fadeOut('slow');
    }
    
    }


$('#redeem_btn_click').click(function(){
    
     var decimal=$('#decimal').val();
     var min_redeem=parseFloat($('#min_redeem').val());
     var redeem_point=parseFloat($('#redeem_point').val());
     var loyalty_id=$('#ly_id').val();
     var number=$('#ly_number').val();
    
    var pt=parseFloat($('#point_rule').val());
    var amt=parseFloat($('#point_rule').attr('amt'));
    
    var gt1=$('#subtotal_loy').text();
    var gt=gt1.replace(',','');
    var pt_values=parseFloat(redeem_point/pt);
    var tot_point_amount=parseFloat(pt_values*amt).toFixed(decimal);
 
      var rdp=$('#redeem_point_total').text();
      var rda=  $('#redeem_amount_total').text();

      if(loyalty_id==""  || number==""){
          $('#redeem_point').val('');
          $('#redeem_point_total').text(0)
          $('#redeem_amount_total').text(0);
           
         var decimal=$('#decimal').val();
        
         
        $('#total_before_redeem').text(0);
              
        $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Enter Loyalty Details ");
	$("#loy_error").delay(3000).fadeOut('slow');
        $('#ly_id').focus();
        
       exit; 
    }else if(redeem_point<=min_redeem || redeem_point==""){
         $('#redeem_point').val(0);
          $('#redeem_point_total').text(0)
          $('#redeem_amount_total').text(0);
          
           var decimal=$('#decimal').val();
         
         
        $('#total_before_redeem').text(0);
           
        $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Minimum Redeem Point should be greater than "+min_redeem);
	$("#loy_error").delay(3000).fadeOut('slow');
          $('#redeem_point').focus();
        exit;
    }else if(parseFloat(tot_point_amount)>=parseFloat(gt)){
          $('#redeem_point').val(0);
          $('#redeem_point_total').text(0)
          $('#redeem_amount_total').text(0);
          var decimal=$('#decimal').val();
         
         
        $('#total_before_redeem').text(0);
        $("#loy_error").css("display","block");
	$("#loy_error").addClass("popup_validate");
	$("#loy_error").text("Redeem Amount should not be greater than Total");
	$('#loy_error').delay(3000).fadeOut('slow');
          $('#redeem_point').focus();
        exit;
        }else{
        
        $(".payment_pend_right_cash_error").text("");
    }
  
  $('#point_show').css('display','block');
   $('#point_amount_show').css('display','block');
  
  
  $('#redeem_point_total').text(redeem_point);
  
   
   $('#redeem_amount_total').text(tot_point_amount);
  
   $('#total_before_redeem').text(gt);
   
   
      
   var gtt=parseFloat(gt-tot_point_amount);
   
     $('#subtotal_loy').text(gtt.toFixed(decimal));
     
     $('#redeem_point').attr('readonly', true);
      $('#redeem_btn_click').hide();
      
         $('.redeeming_value_total').text('Redeemed Already');
         $('#clear_btn_click').show();
         $('#ly_number').attr('readonly', true);
         $('#ly_name').attr('readonly', true);
         $('#ly_id').attr('readonly', true);
         $('#id_load').hide();
         $('#number_load').hide();
          $('#name_load').hide();
          
       $(".settle-btn1").click();   
    });
    
    
 $('#clear_btn_click').click(function(){
      
      $('#redeem_point').attr('readonly', false);
      $('#ly_number').attr('readonly', false);
      $('#ly_name').attr('readonly', false);
      $('#ly_id').attr('readonly', false);
      $('#redeem_btn_click').show();
      
      $('.redeeming_value_total').text('');
      $('#clear_btn_click').hide();
      $('#redeem_point_total').text('0');
  
      $('#redeem_amount_total').text('0');
  
      $('#total_before_redeem').text('0');
      
      $('#redeem_point').val(0);
      $('#ly_number').val('');
    
      $('#ly_id').val('');
     
        $('#ly_name').val('');
        $('#ly_number').val('');
        $('#ly_points').val('');
        
         var decimal=$('#decimal').val();
         var gtt=$('#subtotal_loy_org').val();
       
      $('#subtotal_loy').text(gtt);
       
      $('#id_load').hide();
     $('#number_load').hide();
       $('#name_load').hide();
       
        $('#point_show').hide();
         $('#point_amount_show').hide();
         $('#ly_id').focus();
     });
    
    
    $("#dis_pin").keyup(function(event) {
         
            if (event.keyCode == 13) {
                if($("#dis_pin").is(':focus')){
                   
               $('#dis_auth_proceed').click();
                $("#dis_pin").blur();
               
                }
              
            }
        });
        
        
        
        
         $('#dis_auth_proceed').click(function (event) {
       
          event.stopImmediatePropagation();
            
              var pin =  $('#dis_pin').val();
            
              
              if(pin !=''){
              $.post("load_div.php", {pin:pin,type:'authpincheck',set:'pincheck'},
		function(data)
		{ 
                   
                  data=$.trim(data);
                  var staff_sl=data.split('*');
                  var staff=staff_sl[0];
                 
                    if(data!="NO")
                    { 
                        if(staff_sl[8]=='dis_auth:Y'){
                            
                        $('.auothorize_popup').css('display','none');
                        $('#dis_pin').val('');
                        $('#disountamount').focus()
                      
                          if(staff_sl[9]=='dis_manual:Y'){
                              $('.manual_permission_on').show();
                          }
                        
                        }else{
                        $("#dis_error").css("display","block");
			$("#dis_error").text("NO PERMISSION TO APPLY DISCOUNT");
			$("#dis_error").delay(2000).fadeOut('slow');
                        $("#dis_pin").val('');
                        $("#dis_pin").off('blur');
                        $("#dis_pin").focus();
                       }		
                    }
                    else{
                        
                        $("#dis_error").css("display","block");
			$("#dis_error").text("ENTER A VALID PIN");
			$("#dis_error").delay(2500).fadeOut('slow');
                        $("#dis_pin").val('');
                        $("#dis_pin").off('blur');
                        $("#dis_pin").focus();
                    }
                });
            }
            else{     
                
                        $("#dis_error").css("display","block");
			$("#dis_error").text("ENTER YOUR PERSONAL PIN ");
			$("#dis_error").delay(2000).fadeOut('slow');
                       // documet.getElementById('dis_pin').focus();
                         $('#dis_pin').focus();
                         
            }
       
       
       
       
   });

function dis_pincheck(){
    $('#focusedtext').val('dis_pin');
}

        </script>