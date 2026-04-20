<?php
include('includes/session.php');		// Check session

include("database.class.php"); // DB Connection class
$database	= new Database(); 
include("api_multiplelanguage_link.php");
if(isset($_SESSION['floorid'])){
$floorid=  trim(json_encode($_SESSION['floorid']),'""');
}
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
error_reporting(0);


if($_REQUEST['value']=="searchkothistory")
{

	$string='';
	
	$string=" ter_dayclosedate='".$_REQUEST['dateval']."'";
        
	if(($_REQUEST['kotno']!="null"))
	{
		$string.=" AND  ter_kotno LIKE '%".$_REQUEST['kotno']."%'";
	}
	
	if(($_REQUEST['bilno']!="null"))
	{
		
			$string.=" AND  ter_billnumber LIKE '%".$_REQUEST['bilno']."%'";
		
	}
	if(($_REQUEST['bilsts']!="null") && ($_REQUEST['bilsts']!=""))
	{
		$string.=" AND  ter_status = '".$_REQUEST['bilsts']."'";
	}
	
	
	?>
    <script src="js/kot_history_select.js"></script>
      <span style="background-color: white;font-weight: bold;float: left;width: 100%;height: 30px">  DINE IN
         <?php
         
         
         
         $sql_bilhis="select distinct(ter_kotno),ter_status,ter_billnumber,ter_entrytime from tbl_tableorder WHERE $string AND ter_kotno<>'0' group by ter_kotno ORDER BY LPAD(lower(ter_kotno), 10,0) DESC";
                                                // echo "select distinct(ter_kotno),ter_status,ter_billnumber from tbl_tableorder WHERE $string AND ter_kotno<>'0' group by ter_kotno ORDER BY LPAD(lower(ter_kotno), 10,0) DESC";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						 $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{$c=0; 
                                                while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) { 
                                                    $c++;
                                                }} 
                                                ?>
          <strong style="float: right;margin-right: 5px;color: darkred"> KOT : <?=  $c?>      </strong>
          
         
      </span>   
    <table width="100%" class=" " border="0"> <!----bill_history_active--->
                       
                        <tbody>
                        <?php
                               // echo "select distinct(ter_kotno),ter_status,ter_billnumber,ter_entrytime from tbl_tableorder WHERE $string AND ter_kotno<>'0' group by ter_kotno ORDER BY LPAD(lower(ter_kotno), 10,0) DESC";
						 $sql_bilhis="select distinct(ter_kotno),ter_status,ter_billnumber,ter_entrytime,ter_kot_printed from tbl_tableorder"
                                                         . " WHERE $string AND ter_kotno<>'0' group by ter_kotno ORDER BY LPAD(lower(ter_kotno), 10,0)"
                                                         . "  DESC";
                                                // echo "select distinct(ter_kotno),ter_status,ter_billnumber from tbl_tableorder WHERE $string AND ter_kotno<>'0' group by ter_kotno ORDER BY LPAD(lower(ter_kotno), 10,0) DESC";
						$sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
						 $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
						if($num_bilhistory)
						{ $i=1; echo 'dinedata ok tested';
							while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
							 {
                                                            
                                                            $name=''; $status='';
									
                                                            if(is_null($result_bilhistory['ter_billnumber']))
									{
										$name="Not Generated";
									}else
									{
										$name=$result_bilhistory['ter_billnumber'];
									}
									$print=$database->show_kotmaster_list($result_bilhistory['ter_kotno']);
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
									if($result_bilhistory['ter_status']=="Closed")
									{  $status=$_SESSION['status_msg_closed'];
									}else 
									if($result_bilhistory['ter_status']=="Cancelled")
									{$status=$_SESSION['status_msg_cancelled'];
									}else 
									if($result_bilhistory['ter_status']=="Billed")
									{$status=$_SESSION['status_msg_billed'];
									}
									
                                                                        
                                                                         if($result_bilhistory['ter_kot_printed']=='Y')
									{
										$sts_l="Yes";
									}else
									{
										$sts_l='No';
									}
                                                                        
                                                                        
									if($_REQUEST['statuss']!="null" && $_REQUEST['statuss']!="")
									{
										if($_REQUEST['statuss']==$sts)
										{
									?>
                            
                          <tr class="kot_history_number kot_history_number_di <?php if($result_bilhistory['ter_status']=='N'){ ?> bill_history_cancel <?php } ?>" kotno="<?=$result_bilhistory['ter_kotno']?>"  style="cursor:pointer" status="<?=$result_bilhistory['ter_status']?>">
                            <td width="10%"><strong><?=$i++?></strong></td>
                            <td width="15%"><?=date("h:i:s",strtotime($result_bilhistory['ter_entrytime']))?></td>
                            <td width="15%"><strong><?=$result_bilhistory['ter_kotno']?></strong></td>
                            <td width="15%"><?=$name?></td>
                             <td width="10%"><?=$sts_l?></td>
                             <td width="10%"><?=$status//$result_bilhistory['ter_status']?></td>
                           </tr>
                           <?php 		}
						   			}else
						   			{?>
                           <tr class="kot_history_number kot_history_number_di <?php if($result_bilhistory['ter_status']=='N'){ ?> bill_history_cancel <?php } ?>" kotno="<?=$result_bilhistory['ter_kotno']?>" style="cursor:pointer" status="<?=$result_bilhistory['ter_status']?>">
                            <td width="10%"><strong><?=$i++?></strong></td>
                            <td width="15%"><?=date("h:i:s",strtotime($result_bilhistory['ter_entrytime']))?></td>
                            <td width="15%"><strong><?=$result_bilhistory['ter_kotno']?></strong></td>
                            <td width="15%"><?=$name?></td>
                             <td width="10%"><?=$sts_l?></td>
                             <td width="10%"><?=$status//$result_bilhistory['ter_status']?></td>
                           </tr>
                           		<?php }?>
                           <?php } }else{  echo 'dinedata notok tested'; } ?>
                           </tbody>
                         </table>
    <?php
	
}else if($_REQUEST['value']=="loadkotdetails")
{       
        $combo_entry_count=array();
        $i=0; $table_trim_order='';
	$sql_wholelist1  =  $database->mysqlQuery("SELECT tor.ter_floorid,tm.tr_tableno,tds.ts_tableidprefix,tds.ts_tableid,tor.ter_staff,sm.ser_firstname,sm.ser_lastname,tor.ter_status, tor.ter_kotno,tor.ter_orderno from tbl_tableorder tor left join tbl_tabledetails tds on tds.ts_orderno=tor.ter_orderno left join tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid left join tbl_staffmaster as sm  on sm.ser_staffid=tor.ter_staff  WHERE tor.ter_kotno='".$_REQUEST['kotno']."' and tor.ter_dayclosedate='".$_REQUEST['dateval']."' group by tor.ter_kotno "); 
	//echo "SELECT tm.tr_tableno,tds.ts_tableidprefix,tds.ts_tableid,tor.ter_staff, tor.ter_kotno from tbl_tableorder tor left join tbl_tabledetails tds on tds.ts_orderno=tor.ter_orderno left join tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid   WHERE tor.ter_kotno='".$_REQUEST['kotno']."' and tor.ter_dayclosedate='".$_REQUEST['dateval']."' group by tor.ter_kotno ";
        $num_wholelist1  = $database->mysqlNumRows($sql_wholelist1);
	if($num_wholelist1){$ii=1;
		$result_wholelist1  = $database->mysqlFetchArray($sql_wholelist1);
                $tableno=$result_wholelist1['tr_tableno']."(".$result_wholelist1['ts_tableidprefix'].")";
                if($result_wholelist1['ter_status']=='Closed')
                { 
                    $table_trim_order=  explode(',', $result_wholelist1['ter_orderno']);
                   
                    $sql_closedbill=$database->mysqlQuery("SELECT bm_tableno from tbl_tablebillmaster where bm_orderno like '%".$table_trim_order[0]."%'  and bm_dayclosedate='".$_REQUEST['dateval']."'");
                    //echo "SELECT bm_tableno from tbl_tablebillmaster where bm_orderno='".$result_wholelist1['ter_orderno']."'";
                    $num_closedbill  = $database->mysqlNumRows($sql_closedbill);
                    if($num_closedbill){ $ii=1;
		    $result_closedbill  = $database->mysqlFetchArray($sql_closedbill);
                     $tableno=$result_closedbill['bm_tableno'];
                    }
                    
                }
                $staff_name=$result_wholelist1['ser_firstname'].' '.$result_wholelist1['ser_lastname'];
                
                $floor='';
                 $sql_combo_list  =  $database->mysqlQuery("select fr_floorname from tbl_floormaster where fr_floorid='".$result_wholelist1['ter_floorid']."' "); 
                    $num_combo_list  = $database->mysqlNumRows($sql_combo_list);
                    if($num_combo_list){
                          while($result_combo_list5  = $database->mysqlFetchArray($sql_combo_list)) 
                                  { 
                $floor=$result_combo_list5['fr_floorname'];
                    }}
            ?>  
                    <div class="kot_his_head_tbl_detail">
                        
                                <div class="kot_his_head_tbl_detail_name">
                                	<span>Floor:</span> 
                                    <strong><?=$floor?></strong>
                                </div>
                        
                            	<div class="kot_his_head_tbl_detail_name">
                                	<span>Table No:</span> 
                                    <strong><?=$tableno?></strong>
                                </div>
                                <div class="kot_his_head_tbl_detail_name">
                                	<span>Steward Name:</span> 
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
    <table class="kot_history_right_table" style="width:99%" border="0">
			  
    <?php
        }
                    $sql_combo_list  =  $database->mysqlQuery("select distinct(cod.cod_count_combo_ordering) as cod_count_combo_ordering, cod.cod_combo_pack_rate, cod.cod_combo_total_rate,cod.cod_combo_qty,  cn.cn_name, cp.cp_pack_name FROM tbl_combo_ordering_details cod 
                                                                        left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                                        left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where cod.cod_dayclosedate='".$_REQUEST['dateval']."' and cod.cod_kot_no='".$_REQUEST['kotno']."'"); 
                    $num_combo_list  = $database->mysqlNumRows($sql_combo_list);
                    if($num_combo_list){
                          while($result_combo_list  = $database->mysqlFetchArray($sql_combo_list)) 
                                  {     $i++;
                                   
                                    $combo_menu_array=array();
                                  if(!in_array($result_combo_list['cod_count_combo_ordering'],$combo_entry_count)){
                                        $combo_entry_count[]=$result_combo_list['cod_count_combo_ordering'];
                                        $total=$total+$result_combo_list['cod_combo_total_rate'];

                                        $sql_combomenu_list  =  $database->mysqlQuery("select mm.mr_menuname  FROM tbl_combo_ordering_details cod
                                       left join tbl_menumaster mm on mm.mr_menuid=cod.cod_menu_id
                                       where cod.cod_count_combo_ordering='".$result_combo_list['cod_count_combo_ordering']."' and cod.cod_dayclosedate='".$_REQUEST['dateval']."' and cod.cod_kot_no='".$_REQUEST['kotno']."'");
                                       $num_combomenu_list  = $database->mysqlNumRows($sql_combomenu_list);
                                        if($num_combomenu_list){
                                            while($result_combomenu_list  = $database->mysqlFetchArray($sql_combomenu_list)) 
                                                {
                                                $combo_menu_array[]=$result_combomenu_list['mr_menuname'];
                                                }
                                        }

                                  ?>
                                
                               <tr>
                                <td width="11.5%"><?=$i?></td>
                                <td width="39.8%"><?=$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']?>
                                     <span class="combo_tbl_lst"><?=implode(',',array_unique($combo_menu_array));?></span>
                                </td>
                                <td width="15.6%">Combo</td>
                                <td width="7.5%"><?=$result_combo_list['cod_combo_qty']?></td>
                                <td width="12%"><?=number_format($result_combo_list['cod_combo_pack_rate'],$_SESSION['be_decimal'])?></td>
                              </tr>
                               
                        <?php
                                }
                            }}                                    
        
        
        
        $sql_wholelist  =  $database->mysqlQuery("SELECT to1.ter_orderno,to1.ter_menuid,to1.ter_addon_slno,um.u_name,bum.bu_name,to1.ter_unit_id,to1.ter_base_unit_id,"
                . "to1.ter_unit_type,to1.ter_unit_weight,to1.ter_rate_type,to1.ter_slno,to1.ter_staff,tds.ts_tableid,tbt.tr_tableno,tds.ts_tableidprefix,"
                . "ss.ser_firstname,mn.mr_menuname,pm.pm_portionname,to1.ter_qty,to1.ter_rate,(to1.ter_qty * to1.ter_rate) as total,"
                . "to1.ter_billnumber,to1.ter_menuid,to1.ter_cancel,pm.pm_id,to1.ter_preferencetext from tbl_tableorder as to1 "
                . "LEFT JOIN tbl_menumaster as mn 	ON to1.ter_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON to1.ter_portion=pm.pm_id "
                . "left join tbl_staffmaster ss on ss.ser_staffid=to1.ter_staff left join tbl_tabledetails tds on tds.ts_orderno=to1.ter_orderno "
                . "left join tbl_tablemaster tbt on tds.ts_tableid=tbt.tr_tableid left join tbl_unit_master um on um.u_id=to1.ter_unit_id "
                . "left join tbl_base_unit_master bum on bum.bu_id=to1.ter_base_unit_id   WHERE to1.ter_kotno='".$_REQUEST['kotno']."' and"
                . " to1.ter_dayclosedate='".$_REQUEST['dateval']."' and to1.ter_count_combo_ordering IS NULL  "); 
	$num_wholelist  = $database->mysqlNumRows($sql_wholelist);
	if($num_wholelist){
		  while($result_wholelist  = $database->mysqlFetchArray($sql_wholelist)) 
			  { $i++;
                            $ids="pm_".$result_wholelist['pm_id'];
                            
                            
                            //$kothis_menuid=trim(json_encode($result_wholelist['ter_menuid']),'""');
                            $kothis_menuid=$result_wholelist['ter_menuid'];
                            $kothis_menu=$result_wholelist['mr_menuname'];
                            
                            if($_SESSION['main_language']!='english'){
                
                            $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$kothis_menuid."' and ls_language='".$_SESSION['main_language']."'");
                            //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                            $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                            $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                            $kothis_menu=$result_arabmenu['lm_menu_name'];
                            // $catid['name'][] = $catname;
                            //echo $catname;
                            }
//                            $fp=fopen($apilink."/src/main_menu_display.php?set=orderedmenu&ordered_menuid=$kothis_menuid&dat=$other_lang","r");
//                            $response['messages'] = stream_get_contents($fp);
//                            //echo  $response['messages'];
//                            $resu= json_decode($response['messages'],true);
                            
                            //$kothis_portionid=trim(json_encode($result_wholelist['pm_id']),'""');
                            $kothis_portionid=$result_wholelist['pm_id'];
                            $kothis_portion='';
                            
                            if($result_wholelist['ter_rate_type']=='Portion'){
                                $kothis_portion='Portion  :'.' '.$result_wholelist['pm_portionname'];
                            }
                            else if($result_wholelist['ter_rate_type']=='Unit'){
                                if($result_wholelist['ter_unit_type']=='Packet'){
                                    $kothis_portion=$result_wholelist['ter_unit_type'].' : '.number_format($result_wholelist['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_wholelist['u_name'];
                                }
                                else if($result_wholelist['ter_unit_type']=='Loose'){
                                    $kothis_portion=$result_wholelist['ter_unit_type'].' : '.number_format($result_wholelist['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_wholelist['bu_name'];
                                }
                            }
                            if($_SESSION['main_language']!='english'){
                            $sql_arabportion=$database->mysqlQuery("SELECT lm_portion_name FROM tbl_language_portion left join tbl_languages on ls_id=lm_language_id WHERE lm_portion_id='".$kothis_portionid."' and ls_language='".$_SESSION['main_language']."'");
                            //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                            $num_arabportion = $database->mysqlNumRows($sql_arabportion);
                            $result_arabportion = $database->mysqlFetchArray($sql_arabportion);
                            $kothis_portion=$result_arabportion['lm_portion_name'];
                            // $catid['name'][] = $catname;
                            //echo $catname;
                            }
                            //trim(json_encode($_SESSION['floorid']),'""');
//                            $fp_portion=fopen($apilink."/src/main_menu_display.php?set=orderedportion&ordered_portionid=$kothis_portionid&dat=$other_lang","r");
//                            $response_portion['messagesportion'] = stream_get_contents($fp_portion);
//                            //echo $response_portion['messagesportion'];
//                            $resu_portion= json_decode($response_portion['messagesportion'],true);
                            

                            
	?>

   
    
     
        <tr>
          <td width="11.5%"><?=$i?></td>
          <td width="39.8%"><span style="color:red"><?php if($result_wholelist['ter_addon_slno']!=''){ ?> (AD) <?php } ?></span> <?=$kothis_menu//$result_wholelist['mr_menuname']?></td>
          <td width="15.6%"><?=$kothis_portion//$result_wholelist['pm_portionname']?></td>
          <td width="7.5%"><?=$result_wholelist['ter_qty']?></td>
          <td width="12%"><?=number_format($result_wholelist['ter_rate'],$_SESSION['be_decimal'])?></td>
     
          <?php if($result_wholelist['ter_preferencetext']!=''){ ?>
         <tr>
             <td>* Pref   </td>
              
              
               <td> <?=$result_wholelist['ter_preferencetext']?></td> </tr>
          <?php } ?>
          
         <?php
          $tax_in1 = $database->mysqlQuery("SELECT tmp_pref_name,tmp_qty FROM tbl_menu_preference_kot "
                  . "where tmp_menu='".$result_wholelist['ter_menuid']."' and tmp_orderno_bill= '".$result_wholelist['ter_orderno']."' ");
                                          $num_tx1 = $database->mysqlNumRows($tax_in1);
                                          if($num_tx1) {
                                           
                                    while ($tx_in11 = $database->mysqlFetchArray($tax_in1)) {  ?>
           <tr>
              <td width="11.5%">** Pref</td> 
               
          <td width="11.5%">** Pref</td>
          <td width="39.8%"><?=$tx_in11['tmp_pref_name'].' | QTY: '.$tx_in11['tmp_qty'] ?></td>
          <td width="15.6%"></td>
          <td width="7.5%"></td>
          <td width="12%"></td>
           </tr>
           
           
            <?php }} ?>
        
        
        </tr>
     
        
        
        
        
    <?php
	}
	}?>
       </table>      
<?php	
}
?>