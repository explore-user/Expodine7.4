<?php
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 
   if(isset($_REQUEST['mode']))
   {
       $mode=$_REQUEST['mode'];
       
   }
   if(isset($_REQUEST['processcount']))
   {
       $processcount=$_REQUEST['processcount'];
       
   } 
   if(isset($_REQUEST['kotcounters']))
   {
       $kotcounters=$_REQUEST['kotcounters'];
      
   }
 
   
   $counters2=explode(",",$kotcounters);
   //print_r($counters2);
   
          $tot_processcount=0;
          $process_count=0;
          $process_countta=0;
      
             if($_SESSION['s_kod_dinein']=='Y'&&($mode==""||$mode=="dine")){
             if($counters2[0]=='ALL') {   
           $sql_menu_processcount="select count(tos.ter_menuid) as processcount from tbl_tableorder as tos left join tbl_menumaster mn on tos.ter_menuid=mn.mr_menuid  WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Opened' and tos.ter_status<>'Closed' and tos.ter_qty<>0 and mn.mr_show_in_kod='Y'";
           //echo "select count(tos.ter_menuid) as processcount from tbl_tableorder as tos  WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Opened'  and tos.ter_status<>'Closed'"; 
           $sql_menuprocesscount1  =  $database->mysqlQuery($sql_menu_processcount); 
		$num_menuprocesscount  = $database->mysqlNumRows($sql_menuprocesscount1);
		if($num_menuprocesscount){
                    while($result_menuprocesscount  = $database->mysqlFetchArray($sql_menuprocesscount1)){ 
                   $process_count=$process_count + $result_menuprocesscount['processcount'];
                    } 
                }
                else {
                    $process_count=$process_count;
             } 
             }
             else
             { $process_count=0;
                 for($k=0;$k<count($counters2);$k++){
                     
                 $sql_menu_processcount11="select count(tos.ter_menuid) as processcount,mr_kotcounter from tbl_tableorder as tos left Join tbl_menumaster as mn on mn.mr_menuid=tos.ter_menuid  WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Opened'  and tos.ter_status<>'Closed' and tos.ter_qty<>0 and mn.mr_kotcounter='".$counters2[$k]."' and mn.mr_show_in_kod='Y'";
                //echo "select count(tos.ter_menuid) as processcount,mr_kotcounter from tbl_tableorder as tos left Join tbl_menumaster as mn on mn.mr_menuid=tos.ter_menuid  WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Opened'  and tos.ter_status<>'Closed' and tos.ter_qty<>0 and mn.mr_kotcounter='".$counters2[$k]."' and mn.mr_show_in_kod='Y'";
                 $sql_menuprocesscount12  =  $database->mysqlQuery($sql_menu_processcount11); 
		$num_menuprocesscount12  = $database->mysqlNumRows($sql_menuprocesscount12);
		if($num_menuprocesscount12){
                    while($result_menuprocesscount12  = $database->mysqlFetchArray($sql_menuprocesscount12)){ 
                   $process_count=$process_count + $result_menuprocesscount12['processcount'];
                    } 
                }
                else {
                    $process_count=$process_count;
             }
                     
                 }
             
              }
             }
                if(($_SESSION['s_kod_takeaway']=='Y')&&($mode==""||$mode=="ta")){
                    if($counters2[0]=='ALL'){
              $sql_menu_processcountta="select count(tbd.tab_menuid) as processcountta from tbl_takeaway_billdetails as tbd LEFT JOIN tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mn on tbd.tab_menuid=mn.mr_menuid   WHERE tbm.tab_dayclosedate='".$_SESSION['date']."' AND tbd.tab_status='Processing'  and tbm.tab_status<>'Closed' and mn.mr_show_in_kod='Y'";
                                    
           $sql_menuprocesscount1ta  =  $database->mysqlQuery($sql_menu_processcountta); 
		$num_menuprocesscountta  = $database->mysqlNumRows($sql_menuprocesscount1ta);
		if($num_menuprocesscountta){
                    while($result_menuprocesscountta  = $database->mysqlFetchArray($sql_menuprocesscount1ta)){ 
                        $process_countta=$process_countta + $result_menuprocesscountta['processcountta'];
                    } 
                }
                else {
                    $process_countta=$process_countta;
                } }
                else {
                    $process_countta=0;
                 for($a=0;$a<count($counters2);$a++){
                    $sql_menu_processcountta1="select count(tbd.tab_menuid) as processcountta from tbl_takeaway_billdetails as tbd LEFT JOIN tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mn on tbd.tab_menuid=mn.mr_menuid   WHERE tbm.tab_dayclosedate='".$_SESSION['date']."' AND tbd.tab_status='Processing'  and tbm.tab_status<>'Closed' and mn.mr_kotcounter='".$counters2[$a]."' and mn.mr_show_in_kod='Y' ";
                                    
           $sql_menuprocesscount1ta11 =  $database->mysqlQuery($sql_menu_processcountta1); 
		$num_menuprocesscountta1  = $database->mysqlNumRows($sql_menuprocesscount1ta11);
		if($num_menuprocesscountta1){
                    while($result_menuprocesscountta1  = $database->mysqlFetchArray($sql_menuprocesscount1ta11)){ 
                        $process_countta=$process_countta + $result_menuprocesscountta1['processcountta'];
                    } 
                }
                
                else {
                    $process_countta=$process_countta;
                } }
                }
                }
               $tot_processcount=$process_count+$process_countta;     
                
           ?>
           		<div class="kod_information_contain">
                            
                	<div class="information_ico"><img src="img/process-ico-1.png"></div>
                    <div class="information_text" id="process">Processing <span class="kod_item_pend_count"><?= $tot_processcount?></span></div>
                </div><!--kod_information_contain-->
                <input type="hidden" id="previouscount" value=<?=$processcount?>>
                <?php
          
            $cancelled_count=0;
            $cancelled_countta=0;
            $tot_cancelled=0;
 if($_SESSION['s_kod_dinein']=='Y'&&($mode==""||$mode=="dine")){
      if($counters2[0]=='ALL') {   
        $sql_menu_cancelledcountall="SELECT count(DISTINCT ch_orderno,ch_orderslno) as cancel_count FROM tbl_tableorder_changes OC ,tbl_tableorder O, tbl_menumaster M
                        WHERE OC.ch_orderno IN (SELECT `ts_orderno` FROM `tbl_tabledetails` WHERE `ts_status` IN('Ready','Opened')) 
                        AND OC.ch_orderno = O.ter_orderno AND OC.ch_orderslno = O.ter_slno AND O.ter_menuid = M.mr_menuid AND M.mr_show_in_kod = 'Y'";
//        echo "SELECT count(DISTINCT ch_orderno,ch_orderslno) as cancel_count FROM tbl_tableorder_changes OC ,tbl_tableorder O, tbl_menumaster M
//                        WHERE OC.ch_orderno IN (SELECT `ts_orderno` FROM `tbl_tabledetails` WHERE `ts_status` IN('Rady','Opened')) 
//                        AND OC.ch_orderno = O.ter_orderno AND OC.ch_orderslno = O.ter_slno AND O.ter_menuid = M.mr_menuid AND M.mr_show_in_kod = 'Y'";
        $sql_menucancelledcount1all  =  $database->mysqlQuery($sql_menu_cancelledcountall); 
	$num_menucancelledcountall  = $database->mysqlNumRows($sql_menucancelledcount1all);
	if($num_menucancelledcountall){
            $result_menucancelledcountall  = $database->mysqlFetchArray($sql_menucancelledcount1all) ;
       
            $cancelled_count= $result_menucancelledcountall['cancel_count'];
           
        } else {
            $cancelled_count=$cancelled_count;
        }
        }
        
        else {
                    $cancelled_count=0;
                 for($a=0;$a<count($counters2);$a++){
                   $sql_menu_cancelledcount="SELECT count(DISTINCT ch_orderno,ch_orderslno) as cancel_count,M.mr_kotcounter FROM tbl_tableorder_changes OC ,tbl_tableorder O, tbl_menumaster M
                        WHERE OC.ch_orderno IN (SELECT `ts_orderno` FROM `tbl_tabledetails` WHERE `ts_status` = 'Occupied') 
                        AND OC.ch_orderno = O.ter_orderno AND OC.ch_orderslno = O.ter_slno AND O.ter_menuid = M.mr_menuid AND  M.mr_kotcounter='".$counters2[$a]."' and M.mr_show_in_kod = 'Y'";
//        echo "SELECT count(DISTINCT ch_orderno,ch_orderslno) as cancel_count,M.mr_kotcounter FROM tbl_tableorder_changes OC ,tbl_tableorder O, tbl_menumaster M
//                        WHERE OC.ch_orderno IN (SELECT `ts_orderno` FROM `tbl_tabledetails` WHERE `ts_status` = 'Occupied') 
//                        AND OC.ch_orderno = O.ter_orderno AND OC.ch_orderslno = O.ter_slno AND O.ter_menuid = M.mr_menuid AND  M.mr_kotcounter='".$counters2[$a]."' and M.mr_show_in_kod = 'Y'";
                   $sql_menucancelledcount1  =  $database->mysqlQuery($sql_menu_cancelledcount); 
	$num_menucancelledcount  = $database->mysqlNumRows($sql_menucancelledcount1);
	if($num_menucancelledcount){
            $result_menucancelledcount  = $database->mysqlFetchArray($sql_menucancelledcount1) ;
       
            $cancelled_count= $cancelled_count+$result_menucancelledcount['cancel_count'];
           
        } else {
            $cancelled_count=$cancelled_count;
        } }
 }}
 if(($_SESSION['s_kod_takeaway']=='Y')&&($mode==""||$mode=="ta")){
      if($counters2[0]=='ALL') {   
        $sql_menu_cancelledcountallta="select count(DISTINCT CI.tc_billno,CI.tc_bill_slno) AS cancel_count  FROM tbl_takeaway_cancel_items CI
                        LEFT JOIN tbl_takeaway_billdetails TBD ON TBD.tab_billno = CI.tc_billno AND CI.tc_bill_slno = TBD.tab_slno
                        LEFT JOIN tbl_takeaway_billmaster TBM ON TBM.tab_billno = TBD.tab_billno
                        LEFT JOIN tbl_menumaster M ON M.mr_menuid = TBD.tab_menuid
                        where M.mr_show_in_kod='Y' AND TBM.tab_status ='Processing'";
        $sql_menucancelledcount1allta  =  $database->mysqlQuery($sql_menu_cancelledcountallta); 
	$num_menucancelledcountallta  = $database->mysqlNumRows($sql_menucancelledcount1allta);
	if($num_menucancelledcountallta){
            $result_menucancelledcountallta  = $database->mysqlFetchArray($sql_menucancelledcount1allta) ;
       
            $cancelled_countta= $result_menucancelledcountallta['cancel_count'];
           
        } else {
            $cancelled_countta=$cancelled_countta;
        }
        }
        
        else {
                    $cancelled_count=0;
            $cancelled_countta=0;
            $tot_cancelled=0;
                 for($a=0;$a<count($counters2);$a++){
                   $sql_menu_cancelledcountta="select count(DISTINCT CI.tc_billno,CI.tc_bill_slno) AS cancel_count  FROM tbl_takeaway_cancel_items CI
                        LEFT JOIN tbl_takeaway_billdetails TBD ON TBD.tab_billno = CI.tc_billno AND CI.tc_bill_slno = TBD.tab_slno
                        LEFT JOIN tbl_takeaway_billmaster TBM ON TBM.tab_billno = TBD.tab_billno
                        LEFT JOIN tbl_menumaster M ON M.mr_menuid = TBD.tab_menuid
                        where M.mr_show_in_kod='Y' AND TBM.tab_status ='Processing' AND  M.mr_kotcounter='".$counters2[$a]."' ";
        $sql_menucancelledcount1ta  =  $database->mysqlQuery($sql_menu_cancelledcountta); 
	$num_menucancelledcountta  = $database->mysqlNumRows($sql_menucancelledcount1ta);
	if($num_menucancelledcountta){
            $result_menucancelledcountta  = $database->mysqlFetchArray($sql_menucancelledcount1ta) ;
       
            $cancelled_count= $cancelled_countta+$result_menucancelledcountta['cancel_count'];
           
        } else {
            $cancelled_countta=$cancelled_countta;
        } }
 }}
           
            $tot_cancelled=$cancelled_count+$cancelled_countta;    
           ?>
           
                <div style="display:none" class="kod_information_contain">
                	<div class="information_ico"><img src="img/pending-icon-1.png"></div>
                    <div class="information_text" id="cancelled">Cancelled <span class="kod_item_pend_count"><?=$tot_cancelled?></span></div>
                </div><!--kod_information_contain-->
                
                
                
                
                <?php
           $tot_ready=0;
           $ready_count=0;
           $ready_countta=0;
           if($_SESSION['s_kod_dinein']=='Y'&&($mode==""||$mode=="dine")){
             if($counters2[0]=='ALL') {   
           $sql_menu_readycount="select count(tos.ter_menuid) as processcount from tbl_tableorder as tos left join tbl_menumaster mn on tos.ter_menuid=mn.mr_menuid  WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Ready' and tos.ter_status<>'Closed' and tos.ter_qty<>0 and mn.mr_show_in_kod='Y'";
           //echo "select count(tos.ter_menuid) as processcount from tbl_tableorder as tos  WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Opened'  and tos.ter_status<>'Closed'"; 
           $sql_menureadycount1  =  $database->mysqlQuery($sql_menu_readycount); 
		$num_menureadycount  = $database->mysqlNumRows($sql_menureadycount1);
		if($num_menureadycount){
                    while($result_menureadycount  = $database->mysqlFetchArray($sql_menureadycount1)){ 
                   $ready_countta=$ready_countta + $result_menureadycount['processcount'];
                    } 
                }
                else {
                    $ready_count=$ready_count;
             } 
             }
             else
             { $ready_count=0;
                 for($k=0;$k<count($counters2);$k++){
                     
                 $sql_menu_readycount11="select count(tos.ter_menuid) as readycount,mr_kotcounter from tbl_tableorder as tos left Join tbl_menumaster as mn on mn.mr_menuid=tos.ter_menuid  WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Ready'  and tos.ter_status<>'Closed' and tos.ter_qty<>0 and mn.mr_kotcounter='".$counters2[$k]."' and mn.mr_show_in_kod='Y'";
                //echo "select count(tos.ter_menuid) as processcount,mr_kotcounter from tbl_tableorder as tos left Join tbl_menumaster as mn on mn.mr_menuid=tos.ter_menuid  WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Opened'  and tos.ter_status<>'Closed' and tos.ter_qty<>0 and mn.mr_kotcounter='".$counters2[$k]."' and mn.mr_show_in_kod='Y'";
                 $sql_menureadycount12  =  $database->mysqlQuery($sql_menu_readycount11); 
		$num_menureadycount12  = $database->mysqlNumRows($sql_menureadycount12);
		if($num_menureadycount12){
                    while($result_menureadycount12  = $database->mysqlFetchArray($sql_menureadycount12)){ 
                   $ready_count=$ready_count + $result_menureadycount12['readycount'];
                    } 
                }
                else {
                    $ready_count=$ready_count;
             }
                     
                 }
             
              }
             }
                if(($_SESSION['s_kod_takeaway']=='Y')&&($mode==""||$mode=="ta")){
                    if($counters2[0]=='ALL'){
              $sql_menu_readycountta="select count(tbd.tab_menuid) as readycountta from tbl_takeaway_billdetails as tbd LEFT JOIN tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mn on tbd.tab_menuid=mn.mr_menuid   WHERE tbm.tab_dayclosedate='".$_SESSION['date']."' AND tbd.tab_status='Ready'  and tbm.tab_status<>'Closed' and mn.mr_show_in_kod='Y'";
                                    
           $sql_menureadycount1ta  =  $database->mysqlQuery($sql_menu_readycountta); 
		$num_menureadycountta  = $database->mysqlNumRows($sql_menureadycount1ta);
		if($num_menureadycountta){
                    while($result_menureadycountta  = $database->mysqlFetchArray($sql_menureadycount1ta)){ 
                        $ready_countta=$ready_countta + $result_menureadycountta['readycountta'];
                    } 
                }
                else {
                    $ready_countta=$ready_countta;
                } }
                else {
                    $process_countta=0;
                 for($a=0;$a<count($counters2);$a++){
                    $sql_menu_readycountta1="select count(tbd.tab_menuid) as readycountta from tbl_takeaway_billdetails as tbd LEFT JOIN tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mn on tbd.tab_menuid=mn.mr_menuid   WHERE tbm.tab_dayclosedate='".$_SESSION['date']."' AND tbd.tab_status='Ready'  and tbm.tab_status<>'Closed' and mn.mr_kotcounter='".$counters2[$a]."' and mn.mr_show_in_kod='Y' ";
                       // echo "select count(tbd.tab_menuid) as readycountta from tbl_takeaway_billdetails as tbd LEFT JOIN tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mn on tbd.tab_menuid=mn.mr_menuid   WHERE tbm.tab_dayclosedate='".$_SESSION['date']."' AND tbd.tab_status='Ready'  and tbm.tab_status<>'Closed' and mn.mr_kotcounter='".$counters2[$a]."' and mn.mr_show_in_kod='Y' ";            
           $sql_menureadycount1ta11 =  $database->mysqlQuery($sql_menu_readycountta1); 
		$num_menureadycountta1  = $database->mysqlNumRows($sql_menureadycount1ta11);
		if($num_menureadycountta1){
                    while($result_menureadycountta1  = $database->mysqlFetchArray($sql_menureadycount1ta11)){ 
                        $ready_countta=$ready_countta + $result_menureadycountta1['readycountta'];
                    } 
                }
                
                else {
                    $ready_countta=$ready_countta;
                } }
                }
                }
               $tot_ready= $ready_count+$ready_countta;
           ?>
           
           
                
                <div class="kod_information_contain">
                	<div class="information_ico" id="Ready"><img src="img/served-icon-1.png"></div>
                    <div class="information_text">Ready <span class="kod_item_pend_count"><?=$tot_ready?></span></div>
                </div><!--kod_information_contain-->
                