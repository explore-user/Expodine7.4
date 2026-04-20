<?php
include('includes/session.php');		// Check session

include("database.class.php"); // DB Connection class
$database	= new Database(); 
include("api_multiplelanguage_link.php");
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
error_reporting(0);
if($_REQUEST['value']=="searchkothistory")
{

//echo "Hi";//dateval="+dateset+"&kotno="+kotno+"&bilno="+bilno+"&statuss="+statuss

	$string='';
	
	$string.=" tab_dayclosedate='".$_REQUEST['dateval']."'";
        if(($_REQUEST['mode']=="TA"))
	{
		$string.=" AND (tab_mode='HD' or tab_mode='TA')  ";
	}
        else{
        
            $string.=" AND tab_mode='CS' ";
        }
        
	if(($_REQUEST['kotno']!="null"))
	{
		$string.=" AND  tab_kotno LIKE '%".$_REQUEST['kotno']."%'";
	}
	
	if(($_REQUEST['bilno']!="null"))
	{
		
			$string.=" AND  tab_billno LIKE '%".$_REQUEST['bilno']."%'";
		
	}
//	if(($_REQUEST['bilsts']!="null") && ($_REQUEST['bilsts']!=""))
//	{
//		$string.=" AND  ter_status = '".$_REQUEST['bilsts']."'";
//	}
	
	
	?>
    <script src="js/kot_history_taselect.js"></script>
    <?php 
    if(($_REQUEST['mode']=="TA"))
	{
        
    ?>
     <span style="background-color: white;font-weight: bold;float: left;width: 100%;height: 30px">  TAKEAWAY - HOMEDELIVERY 
     
     <?php
   //  echo  "select distinct(tbl_takeaway_billdetails.tab_kotno_new),tbl_takeaway_billmaster.tab_status,tbl_takeaway_billmaster.tab_billno,tbl_takeaway_billmaster.tab_time from tbl_takeaway_billmaster left join tbl_takeaway_billdetails on tbl_takeaway_billdetails.tab_billno=tbl_takeaway_billmaster.tab_billno WHERE $string AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
						
						 $sql_bilhis="select distinct(tbl_takeaway_billdetails.tab_kotno_new),tbl_takeaway_billmaster.tab_status,tbl_takeaway_billmaster.tab_billno,tbl_takeaway_billmaster.tab_time from tbl_takeaway_billmaster left join tbl_takeaway_billdetails on tbl_takeaway_billdetails.tab_billno=tbl_takeaway_billmaster.tab_billno WHERE $string AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
						//echo "select distinct(tab_kotno),tab_status,tab_billno from tbl_takeaway_billmaster WHERE $string AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
                                                 $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						 $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$c=0;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{ $c++;
                                                            
                                                            
                                                        }
                                                        }
     ?>
     <strong style="float: right;margin-right: 5px;color: darkred"> KOT : <?=$c?>      </strong>
     </span>  
        <?php } 
    
      if(($_REQUEST['mode']=="CS"))
	{
        
    ?>
     <span style="background-color: white;font-weight: bold;float: left;width: 100%;height: 30px">  COUNTERSALE 
     
     
      <?php
						
						 $sql_bilhis="select distinct(tbl_takeaway_billdetails.tab_kotno_new),tbl_takeaway_billmaster.tab_status,tbl_takeaway_billmaster.tab_billno,tbl_takeaway_billmaster.tab_time from tbl_takeaway_billmaster left join tbl_takeaway_billdetails on tbl_takeaway_billdetails.tab_billno=tbl_takeaway_billmaster.tab_billno WHERE $string AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
						//echo "select distinct(tab_kotno),tab_status,tab_billno from tbl_takeaway_billmaster WHERE $string AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
                                                 $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						 $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$c1=0;
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{ $c1++;
                                                            
                                                            
                                                        }
                                                        }
     ?>
     <strong style="float: right;margin-right: 5px;color: darkred"> KOT : <?=$c1?>      </strong>
     </span>   
        <?php } ?>
     
     
     
    <table width="100%" class=" " border="0"> <!----bill_history_active--->
                       
                        <tbody>
                        <?php
						
						$sql_bilhis=" select distinct(tbl_takeaway_billdetails.tab_kotno_new),tbl_takeaway_billmaster.tab_status,"
                                                . " tbl_takeaway_billmaster.tab_billno,tbl_takeaway_billdetails.tab_kot_printed,tbl_takeaway_billmaster.tab_time from tbl_takeaway_billmaster left"
                                                . " join tbl_takeaway_billdetails on tbl_takeaway_billdetails.tab_billno=tbl_takeaway_billmaster.tab_billno"
                                                . " WHERE $string AND tab_kotno<>'0' ORDER BY LPAD(lower(tab_kotno), 10,0) DESC";
						
                                                $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						$num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$i=1;  echo 'dinedata ok tested';
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
								{
                                                            
                                                                $name='';$status='';
                                                                $status=$result_bilhistory['tab_status'];
                                                                
									if(is_null($result_bilhistory['tab_billno']))
									{
										$name="Not Generated";
									}else
									{
										$name=$result_bilhistory['tab_billno'];
									}
									$print=$database->show_kotmaster_list($result_bilhistory['tab_kotno_new']);
									$sts='';$sts_l='';
									if($print['kr_print']=='Y')
									{
										$sts="Yes";
									}else {
										$sts="No";
									}
                                                                        
									if($print['kr_print']=='Y')
									{
										$sts_l=$_SESSION['kot_history_print_yes'];
									}else {
										$sts_l=$_SESSION['kot_history_print_no'];
									}
//									
                                                                        if($result_bilhistory['tab_kot_printed']=='Y')
									{
										$sts_l="Yes";
									}else
									{
										$sts_l='No';
									}
									?>
                          <tr class="kot_history_number kot_history_number_ta_hd_cs <?php if($result_bilhistory['tab_status']=='N'){ ?> bill_history_cancel <?php } ?>" billno ="<?=$result_bilhistory['tab_billno']?>" kotno="<?=$result_bilhistory['tab_kotno_new']?>"  style="cursor:pointer" status="<?=$result_bilhistory['tab_status']?>">
                            <td width="10%"><strong><?=$i++?></strong></td>
                            <td width="15%"><?=date("h:i:s",strtotime($result_bilhistory['tab_time']))?></td>
                            <td width="15%"><strong><?=$result_bilhistory['tab_kotno_new']?></strong></td>
                            <td width="15%"><?=$name?></td>
                             <td width="10%"><?=$sts_l?></td>
                             <td width="10%"><?=$status//$result_bilhistory['ter_status']?></td>
                           </tr>
                           <?php 		
						   			
                           } }else{  echo 'dinedata notok tested'; } ?>
                           </tbody>
                         </table>
    <?php
	
}else if($_REQUEST['value']=="loadkotdetails")
{
        $i=0;
        $qty=0;
        $kot_no2='';
        $sql_wholelist1  =  $database->mysqlQuery("SELECT ld.ls_username,ld.ls_staffid,sm.ser_firstname,sm.ser_lastname,tbm.tab_loginid from tbl_takeaway_billmaster tbm left join tbl_logindetails ld on ld.ls_username=tbm.tab_loginid left join tbl_staffmaster as sm on sm.ser_staffid=ld.ls_staffid   WHERE tbm.tab_billno='".$_REQUEST['billno']."' "); 
	//echo "SELECT ld.ls_username,ld.ls_staffid,tbm.tab_loginid from tbl_takeaway_billmaster tbm left join tbl_logindetails ld on ld.ls_username=tbm.tab_loginid   WHERE tbm.tab_billno='".$_REQUEST['billno']."' ";
        $num_wholelist1  = $database->mysqlNumRows($sql_wholelist1);
	if($num_wholelist1){$ii=1;
		$result_wholelist1  = $database->mysqlFetchArray($sql_wholelist1);
                
                $staffid=trim(json_encode($result_wholelist1['ls_staffid']),'""');
                 $staff_name=$result_wholelist1['ser_firstname'].' '.$result_wholelist1['ser_lastname'];
//               
                
            ?>  
                        <div class="kot_his_head_tbl_detail">
                                <div class="kot_his_head_tbl_detail_name">
                                	<span>Staff Name:</span> 
                                    <strong><?=$staff_name?></strong>
                                </div>
                            
                            </div>
                                <div class="bill_his_order_detail_head">
                                <table style="width:99%" class=" " border="0">
                                  <tr>
                                    <td width="11.5%"><?=$_SESSION['kot_history_slno']?></td>
                                    <td width="39.8%"><?=$_SESSION['kot_history_item_name']?></td>
                                    <td width="15.6%">Unit</td>
                                    <td width="7.5%"><?=$_SESSION['kot_history_qty']?></td>
                                      <td width="12%"><?=$_SESSION['kot_history_rate']?></td>
                                     </tr>
                                </table> 
                            </div>
    
    <?php
        }
        
        $sql_combo=" select  cbd.cbd_id, cbd.cbd_count_combo_ordering, cbd.cbd_billno, cbd.cbd_combo_id, cbd.cbd_combo_pack_id, cbd.cbd_slno, cbd.cbd_combo_qty, cbd.cbd_combo_pack_rate, cbd.cbd_combo_total_rate, cbd.cbd_menu_id, cbd.cbd_menu_qty, cbd.cbd_combo_preference, cbd.cbd_entry_date, cbd.cbd_dayclosedate, cbd.cbd_order_status, cbd.cloud_sync, 
                cbd.cbd_kot_no, cbd.cbd_cancel, cn.cn_name ,cn.cn_stock_check, cp.cp_pack_name
                FROM tbl_combo_bill_details_ta cbd
                left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                where cbd.cbd_billno='".$_REQUEST['billno']."' group by cbd.cbd_count_combo_ordering order by cbd.cbd_count_combo_ordering asc";
        $sql_combo_sel = $database->mysqlQuery($sql_combo);
        $num_combo_rows  = $database->mysqlNumRows($sql_combo_sel);
        if($num_combo_rows){
            ?>
                <table class="kot_history_right_table" style="width:99%" border="0">
            <?php
            while($result_combo  = $database->mysqlFetchArray($sql_combo_sel)) 
            {$i++;
            $qty=$qty+$result_combo['cbd_combo_qty'];
            if($kot_no2==''){
                $kot_no2=$result_combo['cbd_kot_no'];
            }
            
            ?>
               
                
                <tr>
                  <td width="11.5%"><?=$i?></td>
                  <td width="39.8%"><?=strtoupper($result_combo['cn_name'].' '.$result_combo['cp_pack_name'])?></td>
                  <td width="15.6%">COMBO</td>
                  <td width="7.5%"><?=$result_combo['cbd_combo_qty']?></td>
                  <td width="12%"><?=number_format($result_combo['cbd_combo_total_rate'],$_SESSION['be_decimal'])?></td>
                </tr>
           
       
                
                
                
            <?php          
            }?>
            </table> 
        <?php
        }
        
      
        $sql_wholelist  =  $database->mysqlQuery("SELECT tbd.tab_preferencetext,tbd.tab_menuid,tbd.tab_bill_addon_slno,tbm.tab_status,bum.bu_name, "
                . "um.u_name,tbd.tab_kotno_new,tbd.tab_slno,sf.ser_firstname,tl.ls_staffid,tbm.tab_loginid,mn.mr_menuname,pm.pm_portionname,tbd.tab_qty,"
                . "tbd.tab_rate,(tbd.tab_qty * tbd.tab_rate) as total,tbd.tab_billno,tbd.tab_menuid,tbd.tab_cancelled,pm.pm_id,tbd.tab_portion,"
                . "tbd.tab_rate_type,tbd.tab_unit_type,tbd.tab_unit_weight,tbd.tab_unit_id,tbd.tab_base_unit_id from tbl_takeaway_billdetails as tbd"
                . " LEFT JOIN tbl_menumaster as mn ON tbd.tab_menuid=mn.mr_menuid  LEFT JOIN tbl_portionmaster as pm ON tbd.tab_portion=pm.pm_id left "
                . "join tbl_unit_master um on um.u_id=tbd.tab_unit_id left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id left join "
                . "tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join  tbl_logindetails tl on tl.ls_username=tbm.tab_loginid left"
                . " join tbl_staffmaster sf on sf.ser_staffid=tl.ls_staffid WHERE tbd.tab_billno='".$_REQUEST['billno']."' and "
                . "tbd.tab_kotno_new='".$_REQUEST['kot_new']."' and tab_count_combo_ordering IS NULL "); 
	
        $num_wholelist  = $database->mysqlNumRows($sql_wholelist);
	if($num_wholelist){
		  while($result_wholelist  = $database->mysqlFetchArray($sql_wholelist)) 
			  {$i++;
                            $kothis_portion_ta='';
                            $ids="pm_".$result_wholelist['pm_id'];
                            $qty=$qty+$result_wholelist['tab_qty'];
//                               
                                $kothistory_menuidta=$result_wholelist['tab_menuid'];
                                $kothistory_menuta=$result_wholelist['mr_menuname'];
                                $kot_no=$result_wholelist['tab_kotno'];
                                if($kot_no2==''){
                                    $kot_no2=$result_wholelist['tab_kotno_new'];
                                }
                                $bill_kot_reprint=$_REQUEST['billno'];
                                if($result_wholelist['tab_rate_type']=='Portion'){
                                                $kothis_portion_ta='Portion  :'.' '.$result_wholelist['pm_portionname'];
                                                }
                                                else if($result_wholelist['tab_rate_type']=='Unit'){
                                                    if($result_wholelist['tab_unit_type']=='Packet'){
                                                        $kothis_portion_ta=$result_wholelist['tab_unit_type'].' : '.number_format($result_wholelist['tab_unit_weight'],$_SESSION['be_decimal']).' '.$result_wholelist['u_name'];
                                                }
                                                    else if($result_wholelist['tab_unit_type']=='Loose'){
                                                        $kothis_portion_ta=$result_wholelist['tab_unit_type'].' : '.number_format($result_wholelist['tab_unit_weight'],$_SESSION['be_decimal']).' '.$result_wholelist['bu_name'];
                                                }
                                               
                                                }
                                
                                if($_SESSION['main_language']!='english'){
                                      
                                    $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$kothistory_menuidta."' and ls_language='".$_SESSION['main_language']."'");
                                    
                                    $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                    $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                    $kothistory_menuta=$result_arabmenu['lm_menu_name'];
                                    
                                }
                                

                                
                                $kothistory_portionidta=$result_wholelist['pm_id'];
                                $kothistory_portionta=$result_wholelist['pm_portionname'];
                                
                                if($_SESSION['main_language']!='english'){
                
                                $sql_arabportion=$database->mysqlQuery("SELECT lm_portion_name FROM tbl_language_portion left join tbl_languages on ls_id=lm_language_id WHERE lm_portion_id='".$kothistory_portionidta."' and ls_language='".$_SESSION['main_language']."'");

                                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                $num_arabportion = $database->mysqlNumRows($sql_arabportion);
                                $result_arabportion = $database->mysqlFetchArray($sql_arabportion);
                                $kothistory_portionta=$result_arabportion['lm_portion_name'];
                                
                                }


                                
	?>

                            
     <table class="kot_history_right_table" style="width:99%" border="0">
        <tr>
          <td width="11.5%"><?=$i?></td>
          <td width="39.8%"><?php if($result_wholelist['tab_bill_addon_slno']!=''){ ?> <span style="color: red">(AD)</span> <?php } ?><?=$kothistory_menuta//$result_wholelist['mr_menuname']?></td>
          <td width="15.6%"><?=$kothis_portion_ta//$result_wholelist['pm_portionname']?></td>
          <td width="7.5%"><?=$result_wholelist['tab_qty']?></td>
          <td width="12%"><?=number_format($result_wholelist['tab_rate'],$_SESSION['be_decimal'])?></td>
          
          <?php if($result_wholelist['tab_preferencetext']!=''){ ?>
         <tr>
             <td>* Pref   </td>
              
              
               <td> <?=$result_wholelist['tab_preferencetext']?></td> </tr>
          <?php } ?>
          
           </tr>
           
           <?php
          $tax_in1 = $database->mysqlQuery("SELECT tmp_pref_name,tmp_qty FROM tbl_menu_preference_kot "
                  . "where tmp_menu='".$result_wholelist['tab_menuid']."' and tmp_orderno_bill= '".$_REQUEST['billno']."' ");
                                          $num_tx1 = $database->mysqlNumRows($tax_in1);
                                          if($num_tx1) {
                                           
                                    while ($tx_in11 = $database->mysqlFetchArray($tax_in1)) {  ?>
           <tr>
          <td width="11.5%">**Pref</td>
          <td width="39.8%"><?=$tx_in11['tmp_pref_name'].' | QTY: '.$tx_in11['tmp_qty'] ?></td>
          <td width="15.6%"></td>
          <td width="7.5%"></td>
          <td width="12%"></td>
           </tr>
           
           
            <?php }} ?>
           
      </table> 
                                        
         <?php
                                        
            }
	}
        
        if($qty>0 && ($_SESSION['date']==date('Y-m-d')) ) { ?>){
        ?>
            <strong class="bill_his_back_btn"  style="background: #930;float: right;cursor: pointer;margin-top: 10px" onclick="return ta_reprint_kot('<?=$_REQUEST['billno']?>','<?=$kot_no2?>');">RE-PRINT</strong>
        <?php
        }
}
?>