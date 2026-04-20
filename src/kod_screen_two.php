<?php
include('includes/session.php');		// Check session
//session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
$localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
include('includes/master_settings.php');
include("api_multiplelanguage_link.php");
$floorid=  trim(json_encode($_SESSION['floorid']),'""');
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
//require_once("includes/title_settings.php");
//require_once("includes/menu_settings.php");
//header('Content-Type: text/html; charset=utf-8');
?>

<?php
if($_SESSION['s_kod_takeaway']=='Y' && $_SESSION['s_kod_dinein']=='Y') {
	
}else
{
	//header("location:index.php?msg=2");
	header("location:kod_screen.php");
}

$counters=array();
if(isset($_SESSION['kotcounterselected']) && $_SESSION['kotcounterselected']!='')
{
	if($_SESSION['kotcounterselected']=="ALL")
	{
		array_push($counters, $_SESSION['kotcounterselected']);
	}else
	{
		
	 $counters=explode(",",$_SESSION['kotcounterselected']);
	}
	
}else
{
	$_SESSION['kotcounterselected']="ALL";
	$_SESSION['kotcounterselected_name']="ALL";
	array_push($counters, $_SESSION['kotcounterselected']);
}
?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>KOD</title>
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/bootstrap-cerulean.min.css" rel="stylesheet" />
<link href="css/order_new.css" rel="stylesheet" type="text/css">
<link href="css/bill_history.css" rel="stylesheet" type="text/css">
<link href="css/kod_screen_1.css" rel="stylesheet" type="text/css">

<script src="js/jquery-1.10.2.min.js"></script> 
<script src="js/kod_screen.js"></script> 
<!-- <script>
$(document).ready(function() {
   var pageHeight = $("body").height();
   pageHeight -=100; // Whatever the height of your footer is. Make sure to subtract that out
   $(".left_bill_history_contain").css("min-height", pageHeight + "px");
});
</script>-->
<script>
$(document).ready(function(){
    //alert("g");
/***************************************  autorefresh starts ******************************************************************  */
	 setInterval(function() { 
             //alert("g");
	 var seltd=$('#countrseltd').val();
         var processcount=$('.kod_item_pend_count').html();
         //alert(processcount);
         var numItems = $('.pin').length;
        // alert(seltd);
 $('.load_colum_dinein').load('load_kod_screen.php?value=loadkodscreen&set=dine&counter='+seltd+'&numberofkot='+numItems);
 $('.load_colum_takeaway').load('load_kod_screen.php?value=loadkodscreen&set=ta&counter='+seltd+'&numberofkot='+numItems);
 $('#kod_top_notification').load('load_kod_notification_refresh.php?mode=&processcount='+processcount+'&kotcounters='+seltd);
	}, 1000); 
}); 
</script>
</head>

<body>
<div class="olddiv1 "></div>
<div class="container-fluid no-padding">
<input type="hidden" name="screentype" id="screentype" value="screen_multi" >
<input type="hidden" name="mode" id="mode" value="<?=$mode?>" >
     <?php /*?><?php include"includes/topbar.php"; ?><?php */?>
      <div class="middle_container">
      <div style="width:100%" class="top_site_map_cc ">
      	<a style="text-decoration:none;" href="index.php"><div class="sitemap_logo_cc"><img src="img/logo20.png"></div></a>
        <div class="table_floor_select_btn" title="dine"><a href="kod_screen.php?mode=dine" >Dine In</a></div>
        <div class="table_floor_select_btn" title="takeaway"><a href="kod_screen.php?mode=ta" >Take Away</a></div>
		  <?php include"includes/new_right_menu.php"; ?> 
          <?php include "includes/page_shortcuts.php"; ?>
           <!--<div class="bill_history_head">KOD Screen</div>-->
             <div class="kod_list_information" id="kod_top_notification">
               <?php
               
                 $sql_menu_image="select be_kod_image from tbl_branchmaster";
            $sql_menuimage  =  $database->mysqlQuery($sql_menu_image); 
		$num_menuimage  = $database->mysqlNumRows($sql_menuimage);
		if($num_menuimage){
                    $result_menuimage  = $database->mysqlFetchArray($sql_menuimage); 
                   $imagepermission=$result_menuimage['be_kod_image'];
                    
                }
               
               
               
                  $tot_processcount=0;
          $process_count=0;
          $process_countta=0;
      
             if($_SESSION['s_kod_dinein']=='Y'&&($mode==""||$mode=="dine")){
             if($counters[0]=='ALL') {   
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
                 for($k=0;$k<count($counters);$k++){
                     
                 $sql_menu_processcount11="select count(tos.ter_menuid) as processcount,mr_kotcounter from tbl_tableorder as tos left Join tbl_menumaster as mn on mn.mr_menuid=tos.ter_menuid  WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Opened'  and tos.ter_status<>'Closed' and tos.ter_qty<>0 and mn.mr_kotcounter='".$counters[$k]."' and mn.mr_show_in_kod='Y'";
                //echo "select count(tos.ter_menuid) as processcount,mr_kotcounter from tbl_tableorder as tos left Join tbl_menumaster as mn on mn.mr_menuid=tos.ter_menuid  WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Opened'  and tos.ter_status<>'Closed' and mn.mr_kotcounter='".$counters2[$k]."'";
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
                    if($counters[0]=='ALL'){
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
                    $process_count=0;
                 for($a=0;$a<count($counters);$a++){
                    $sql_menu_processcountta1="select count(tbd.tab_menuid) as processcountta from tbl_takeaway_billdetails as tbd LEFT JOIN tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mn on tbd.tab_menuid=mn.mr_menuid   WHERE tbm.tab_dayclosedate='".$_SESSION['date']."' AND tbd.tab_status='Processing'  and tbm.tab_status<>'Closed' and mn.mr_kotcounter='".$counters[$a]."' and mn.mr_show_in_kod='Y' ";
                                    
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
      if($counters[0]=='ALL') {   
        $sql_menu_cancelledcountall="SELECT count(DISTINCT ch_orderno,ch_orderslno) as cancel_count FROM tbl_tableorder_changes OC ,tbl_tableorder O, tbl_menumaster M
                        WHERE OC.ch_orderno IN (SELECT `ts_orderno` FROM `tbl_tabledetails` WHERE `ts_status` IN('Ready','Opened')) 
                        AND OC.ch_orderno = O.ter_orderno AND OC.ch_orderslno = O.ter_slno AND O.ter_menuid = M.mr_menuid AND M.mr_show_in_kod = 'Y'";
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
                 for($a=0;$a<count($counters);$a++){
                   $sql_menu_cancelledcount="SELECT count(DISTINCT ch_orderno,ch_orderslno) as cancel_count,M.mr_kotcounter FROM tbl_tableorder_changes OC ,tbl_tableorder O, tbl_menumaster M
                        WHERE OC.ch_orderno IN (SELECT `ts_orderno` FROM `tbl_tabledetails` WHERE `ts_status` IN('Ready','Opened'))
                        AND OC.ch_orderno = O.ter_orderno AND OC.ch_orderslno = O.ter_slno AND O.ter_menuid = M.mr_menuid AND  M.mr_kotcounter='".$counters[$a]."' and M.mr_show_in_kod = 'Y'";
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
      if($counters[0]=='ALL') {   
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
                 for($a=0;$a<count($counters);$a++){
                   $sql_menu_cancelledcountta="select count(DISTINCT CI.tc_billno,CI.tc_bill_slno) AS cancel_count  FROM tbl_takeaway_cancel_items CI
                        LEFT JOIN tbl_takeaway_billdetails TBD ON TBD.tab_billno = CI.tc_billno AND CI.tc_bill_slno = TBD.tab_slno
                        LEFT JOIN tbl_takeaway_billmaster TBM ON TBM.tab_billno = TBD.tab_billno
                        LEFT JOIN tbl_menumaster M ON M.mr_menuid = TBD.tab_menuid
                        where M.mr_show_in_kod='Y' AND TBM.tab_status ='Processing' AND  M.mr_kotcounter='".$counters[$a]."' ";
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
             if($counters[0]=='ALL') {   
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
                 for($k=0;$k<count($counters);$k++){
                     
                 $sql_menu_readycount11="select count(tos.ter_menuid) as readycount,mr_kotcounter from tbl_tableorder as tos left Join tbl_menumaster as mn on mn.mr_menuid=tos.ter_menuid  WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND tos.ter_status='Ready'  and tos.ter_status<>'Closed' and tos.ter_qty<>0 and mn.mr_kotcounter='".$counters[$k]."' and mn.mr_show_in_kod='Y'";
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
                    if($counters[0]=='ALL'){
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
                    $ready_countta=0;
                 for($a=0;$a<count($counters);$a++){
                    $sql_menu_readycountta1="select count(tbd.tab_menuid) as readycountta from tbl_takeaway_billdetails as tbd LEFT JOIN tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno left join tbl_menumaster mn on tbd.tab_menuid=mn.mr_menuid   WHERE tbm.tab_dayclosedate='".$_SESSION['date']."' AND tbd.tab_status='Ready'  and tbm.tab_status<>'Closed' and mn.mr_kotcounter='".$counters[$a]."' and mn.mr_show_in_kod='Y' ";
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
           </div>
      </div>
                      
      		<div style="width:100%" class="left_contant_container">
            
            <div class="top_counter_sel_contain">
            	<div class="kod_split_head take_away_txt_clr">
                	<div class="kod_top_counter_head_txt">Take Away
                    	<!--<span class="kod_sub_counter_list">( <?$_SESSION['kotcounterselected_name']?> )</span>-->
                    </div>
                    
                </div>
                <div class="counter_select_contain" style="width:78%;">
                	<div class="multi_selector_kod">
                        <div style="width:100%;" class="kod_multi_selectbox">
                        	
                             <div class="table_floor_select_btn swichkitchen table_floor_select_btn_act" title="ALL"><a href="#" >ALL</a></div>
                            
                            <?php   $sql_login  =  $database->mysqlQuery("select * from tbl_kotcountermaster LEFT JOIN tbl_branchmaster ON tbl_kotcountermaster.kr_branchid=tbl_branchmaster.be_branchid "); 
											  $num_login   = $database->mysqlNumRows($sql_login);
											  if($num_login){
												  while($result_login  = $database->mysqlFetchArray($sql_login)) 
													{ ?>
                            
                            
                           <div class="table_floor_select_btn swichkitchen " title="<?=$result_login['kr_kotcode']?>"><a href="#" ><?=$result_login['kr_kotname']?></a></div>
                           
                            <?php  } } ?>
                          
                        </div>
                        <!--<div class="kod_multisel_name"><a href="#" class="selectcounterseach">OK</a></div>-->
                    </div>
                </div><!--select-->
                
                <div style="float:right" class="kod_split_head take_away_txt_clr dine_in_txt_clr" >
                	<div style="float:right;" class="kod_top_counter_head_txt">Dine In</div>
                </div>
                
            </div><!--top_counter_sel_contain-->
            	
            <div class="left_bill_history_contain">
                	
		<div class="load_colum_takeaway" id="columns">
            <input type="hidden" name="countrseltd" id="countrseltd" value="<?=$_SESSION['kotcounterselected']?>">
                      <?php
			foreach( $counters as $number => $value)
 			{
			 $sql_menulist='';
			 if($value=="ALL")
			 {
				 $sql_menulist= "Select distinct(bd.tab_kotno_new) as kotno,bm.tab_billno as blno,mn.mr_time_min as menutime,bm.tab_time as biltime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And bm.tab_kotno != '' And (bm.tab_status='Generated' OR bm.tab_status='Ready' OR bm.tab_status='Processing') AND  (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') and mn.mr_show_in_kod='Y' group by bd.tab_kotno_new,kotcod    order by bd.tab_kotno_new DESC ";
			//echo "Select distinct(bm.tab_kotno) as kotno,bm.tab_billno as blno,mn.mr_time_min as menutime,bm.tab_time as biltime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And bm.tab_kotno != '' And (bm.tab_status='Generated' OR bm.tab_status='Ready' OR bm.tab_status='Processing')    order by bm.tab_time DESC ";
                                 }else
			 {
			 $sql_menulist= "Select distinct(bd.tab_kotno_new) as kotno,bm.tab_billno as blno,mn.mr_time_min as menutime,bm.tab_time as biltime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And bm.tab_kotno != '' And (bm.tab_status='Generated' OR bm.tab_status='Ready' OR bm.tab_status='Processing') AND km.kr_kotcode='".$value."'  AND  (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') and mn.mr_show_in_kod='Y' group by bd.tab_kotno_new,kotcod   order by bd.tab_kotno_new DESC ";
			 }
			//echo $sql_menulist ;
                        
			 	$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{// take_active
                                            $a='a';
                                            $menutime[]=$result_menus['menutime'];
                                                        $max_time=max($menutime);
                                                   $dishtime = date('Y-m-d h:i a',strtotime("+".$max_time." minutes", strtotime($result_menus['biltime'])));
                                                    $current_time=date('Y-m-d h:i a');
							?>
                <div class="pin" <?php if($dishtime<$current_time){ ?> style="background-color: #ff8181"<?php }else{  }?> onClick="return popupfunction('<?=$result_menus['kotno']?>','<?=$result_menus['blno']?>','<?=$_SESSION['date']?>','<?=$_SESSION['s_kod_takeaway']?>','<?=$mode?>','<?=$_SESSION['s_kod_dinein']?>','<?=$result_menus['kotcod']?>')">
                  <div class="kod_detail_number" >
                      <div class="kod_number_box"><?=$result_menus['kotno']?></div>
<!--                       <div class="kod_table_number_steward"><span></span><span></span></div>-->
                      <div class="time_kod_cc"><?=date("h:i a",strtotime($result_menus['biltime'])) ?></div>
                   </div>
                  
                   <?php
				   $sql_menulist1='';
				 
				   $sql_menulist1= "Select tb.tab_count_combo_ordering,tb.tab_unit_weight,tb.tab_rate_type,tb.tab_unit_type,um.u_name,bum.bu_name, sum(tb.tab_qty) as qty,mi.mes_imagethumb as image,tb.tab_preferencetext as pref,tb.tab_slno,mn.mr_menuname as menuname,mn.mr_menuid,po.pm_portionshortcode as portion,tb.tab_status  as status  From tbl_menumaster as mn left Join tbl_takeaway_billdetails as tb On tb.tab_menuid = mn.mr_menuid left Join tbl_portionmaster as po On po.pm_id =tb.tab_portion left join tbl_unit_master um on um.u_id=tb.tab_unit_id left join tbl_base_unit_master bum on bum.bu_id=tb.tab_base_unit_id LEFT JOIN tbl_menuimages mi on mi.mes_menuid=mn.mr_menuid Where tb.tab_kotno_new = '".$result_menus['kotno']."' AND (tb.tab_status='Generated' OR tb.tab_status='Ready' OR tb.tab_status='Processing')  AND   mn.mr_kotcounter= '".$result_menus['kotcod']."' and mn.mr_show_in_kod='Y' group by tb.tab_menuid,tb.tab_portion,tb.tab_unit_id,tb.tab_base_unit_id,tb.tab_unit_weight order by tab_slno ASC ";
			  //echo "Select tb.tab_count_combo_ordering,tb.tab_unit_weight,tb.tab_rate_type,tb.tab_unit_type,um.u_name,bum.bu_name, sum(tb.tab_qty) as qty,mi.mes_imagethumb as image,tb.tab_preferencetext as pref,tb.tab_slno,mn.mr_menuname as menuname,mn.mr_menuid,po.pm_portionshortcode as portion,tb.tab_status  as status  From tbl_menumaster as mn left Join tbl_takeaway_billdetails as tb On tb.tab_menuid = mn.mr_menuid left Join tbl_portionmaster as po On po.pm_id =tb.tab_portion left join tbl_unit_master um on um.u_id=tb.tab_unit_id left join tbl_base_unit_master bum on bum.bu_id=tb.tab_base_unit_id LEFT JOIN tbl_menuimages mi on mi.mes_menuid=mn.mr_menuid Where tb.tab_billno = '".$result_menus['blno']."' AND (tb.tab_status='Generated' OR tb.tab_status='Ready' OR tb.tab_status='Processing')  AND   mn.mr_kotcounter= '".$result_menus['kotcod']."' and mn.mr_show_in_kod='Y' group by tb.tab_menuid,tb.tab_portion,tb.tab_unit_id,tb.tab_base_unit_id,tb.tab_unit_weight order by tab_slno ASC ";
	$sql_menus1  =  $database->mysqlQuery($sql_menulist1); 
	$num_menus1  = $database->mysqlNumRows($sql_menus1);
	if($num_menus1){$i=1;$pref='';
                            $dishtime="";
                            $current_time="";
                            $combo_ordering_count=array();
                            $combo_pack_rate=0;
                            $combo_menu_qty=0;
                            $combo_qty=0;
		while($result_menus1  = $database->mysqlFetchArray($sql_menus1)) 
			{   $a='a';
                            $unit='';
                            //////////////////////  COMBO NAEMS///////////////////////////////
                                
                                        $combo_ordering_count_each=$result_menus1['tab_count_combo_ordering'];
                                        $sql_combo_heading  =  mysqli_query($localhost,"select  cn.cn_name,cp.cp_pack_name,cbd.cbd_combo_qty,cbd.cbd_menu_qty,cbd.cbd_combo_pack_rate FROM 
                                        tbl_combo_bill_details_ta cbd 
                                        left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                        left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                        where cbd.cbd_count_combo_ordering='".$result_menus1['tab_count_combo_ordering']."' and cbd.cbd_menu_id='".$result_menus1['mr_menuid']."'  and cbd.cbd_count_combo_ordering IS NOT  NULL"); 
                                        $num_combo_heading  = mysqli_num_rows($sql_combo_heading);
                                        if($num_combo_heading)
                                            {
                                                $result_combo_heading  = mysqli_fetch_array($sql_combo_heading);
                                                $combo_pack_rate=$result_combo_heading['cbd_combo_pack_rate'];
                                                $combo_menu_qty=$result_combo_heading['cbd_menu_qty'];
                                                $combo_qty=$result_combo_heading['cbd_combo_qty'];
                                                $combo_name = $result_combo_heading['cn_name'].' - '. $result_combo_heading['cp_pack_name'].' (Qty:'.$result_combo_heading['cbd_combo_qty'].') ';
                                            }
                               
                               
                            //////////////////// COMBO NAMES ///////////////////////////////////
                                            
                            if($result_menus1['tab_unit_type']=='Packet'){$unit= number_format($result_menus1['tab_unit_weight'],$_SESSION['be_decimal']).' '.$result_menus1['u_name'];  } else if($result_menus1['tab_unit_type']=='Loose'){ $unit= number_format($result_menus1['tab_unit_weight'],$_SESSION['be_decimal']).' '.$result_menus1['bu_name']; }
                        
                            $menu_name= $result_menus1['menuname'];
                        
                if($_SESSION['main_language']!='english'){
                
                $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus1['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");
                
                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                $menu_name=$result_arabmenu['lm_menu_name'];
                // $catid['name'][] = $catname;
                //echo $catname;
                }
                $sql_menulist2="select (SUM(CI.tc_cancel_qty)+'".$result_menus1['qty']."') AS oldqty,tc_combo_pack_cancelled_qty as combo_cancelled  FROM tbl_takeaway_cancel_items CI where CI.tc_billno ='".$result_menus['blno']."' and CI.tc_bill_slno='".$result_menus1['tab_slno']."'  GROUP BY CI.tc_billno, CI.tc_bill_slno";
			//echo "select (SUM(CI.tc_cancel_qty)+'".$result_menus1['qty']."') AS oldqty  FROM tbl_takeaway_cancel_items CI where CI.tc_billno ='".$result_menus['blno']."' and CI.tc_bill_slno='".$result_menus1['tab_slno']."'  GROUP BY CI.tc_billno, CI.tc_bill_slno";
                               $sql_menus2  =  $database->mysqlQuery($sql_menulist2); 
                                $num_menus2  = $database->mysqlNumRows($sql_menus2);
                                if($num_menus2){
                                    $a='b';
                                
                                    $result_menus2  = $database->mysqlFetchArray($sql_menus2);
                                }
                
					  if($result_menus1['pref']!="")
					  {
						  $pref="(".$result_menus1['pref'].")";
					  }else
					  {
						  $pref="";
					  }
                                          
					
					?>
                    <div class="kod_list_item">
                        <?php if($imagepermission=="Y"){ ?>
                        <div class="kod_dish_image"><img src="<?=$result_menus1['image']?>"></div><?php } else{ ?>
                        <?php } 
                        if($combo_ordering_count_each && !in_array($combo_ordering_count_each,$combo_ordering_count)){
                           $combo_ordering_count[]=$combo_ordering_count_each;
                        ?>
                       <p class="combo_sec_kod"><?=$combo_name?></p><br>
                       <?php }else{
                           $combo_name='';
                       }?>
                        
                        
                        <h1><?php if($a=='b'){?><strike style="color:red"><?php }?><span><?php if($combo_qty>0){ if($a=='a'){ echo $combo_qty.'*'; echo $combo_menu_qty;} else { echo $combo_qty+$result_menus2['combo_cancelled'].'*'; echo $combo_menu_qty;}} else{ if($a=='a'){ echo $result_menus1['qty'];} else { echo $result_menus2['oldqty'];} }?></span> <span><?php if($result_menus1['portion']!=''){ echo '('.$result_menus1['portion'].')';} else { echo '('.$unit.')'; }?></span> * <span><?=$menu_name?></span><?php if($a=='b'){?></strike><?php }?>
                     	<div class="kod_order_status">
                        <?php if($result_menus1['status']=='Ready'){ ?><img src="img/served-icon-1.png"> <?php } if($result_menus1['status']=='Generated'){ ?><img src="img/pending-icon.png"> <?php } if($result_menus1['status']=='Processing'){ ?><img src="img/process-ico.png"> <?php } ?>
                        
                        </div>
                       <?php if($combo_qty>0 && $a=='b'){ ?> <p style="font-size:20px;font-weight:bold;"><span><?=$combo_qty.'*'. $combo_menu_qty ?><?php if($result_menus1['portion']!=''){ echo '('.$result_menus1['portion'].')';}?></span>* <span><?=$menu_name?></span></p><?php } else if($a=='b' && $result_menus1['qty']!=0){?> <p style="font-size:20px;font-weight:bold;"><span><?=$result_menus1['qty']?></span> <span><?php if($result_menus1['portion']!=''){ echo '('.$result_menus1['portion'].')';} else {echo '('.$unit.')';}?></span> * <span><?=$menu_name?></span></p><?php }?>
                          <p style=""><?=$pref?></p>
                      </h1>
                    </div>
                    
                    <?php } } ?>
                   
                  
                    
                </div>
                <?php } }  ?>
  
                
                <?php } ?>
                
              
                 
                
        
        
	</div>


                </div><!--left_bill_history_contain-->
                
                
                
                
                 <div class="left_bill_history_contain">
                	
                    <div class="load_colum_dinein" id="columns">
                    		
            <?php
            $combo_ordering_count_each='';
			foreach( $counters as $number => $value)
 			{
			 $sql_menulist='';
                         $a="";
			 if($_SESSION['kotcounterselected']=="ALL")
			 {
				 $sql_menulist="select distinct(tos.ter_kotno) as kotno,sm.ser_firstname as staff,mn.mr_time_min as menutime,tm.tr_tableno as tbl,tds.ts_tableid,tds.ts_tableidprefix as prefix,tos.ter_billnumber as blno,tos.ter_entrytime as biltime,km.kr_kotcode as kotcod  from tbl_tableorder as tos  LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=tos.ter_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter LEFT JOIN tbl_tabledetails tds on tds.ts_orderno =tos.ter_orderno LEFT JOIN tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid LEFT JOIN tbl_staffmaster sm on sm.ser_staffid=tos.ter_staff WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND (tos.ter_status='Opened' or tos.ter_status='Ready' or tos.ter_status='Added')  and tos.ter_status<>'Closed' AND tos.ter_kotno<>'0' and mn.mr_show_in_kod='Y' and tos.ter_qty>0 group by tos.ter_kotno,kotcod order by tos.ter_kot_canceltime DESC ";//ORDER BY LPAD(lower(tos.ter_kotno), 10,0) DESC
                                // echo"select distinct(tos.ter_kotno) as kotno,sm.ser_firstname as staff,mn.mr_time_min as menutime,tm.tr_tableno as tbl,tds.ts_tableid,tds.ts_tableidprefix as prefix,tos.ter_billnumber as blno,tos.ter_entrytime as biltime,km.kr_kotcode as kotcod  from tbl_tableorder as tos  LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=tos.ter_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter LEFT JOIN tbl_tabledetails tds on tds.ts_orderno =tos.ter_orderno LEFT JOIN tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid LEFT JOIN tbl_staffmaster sm on sm.ser_staffid=tos.ter_staff WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND (tos.ter_status='Opened' or tos.ter_status='Ready' or tos.ter_status='Added')  and tos.ter_status<>'Closed' AND tos.ter_kotno<>'0' group by tos.ter_kotno order by tos.ter_kot_canceltime DESC ";
                                 
                         }else
			 {
				  $sql_menulist="select distinct(tos.ter_kotno) as kotno,sm.ser_firstname as staff,mn.mr_time_min as menutime,tm.tr_tableno as tbl,tds.ts_tableid,tds.ts_tableidprefix as prefix,tos.ter_billnumber as blno,tos.ter_entrytime as biltime,km.kr_kotcode as kotcod  from tbl_tableorder as tos  LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=tos.ter_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter LEFT JOIN tbl_tabledetails tds on tds.ts_orderno =tos.ter_orderno LEFT JOIN tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid LEFT JOIN tbl_staffmaster sm on sm.ser_staffid=tos.ter_staff WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND (tos.ter_status='Opened' or tos.ter_status='Ready' or tos.ter_status='Added')  and tos.ter_status<>'Closed' AND tos.ter_kotno<>'0' AND km.kr_kotcode='".$value."' and mn.mr_show_in_kod='Y' and tos.ter_qty>0 group by tos.ter_kotno,kotcod order by tos.ter_kot_canceltime DESC";//ORDER BY LPAD(lower(tos.ter_kotno), 10,0) DESC
			 //echo "select distinct(tos.ter_kotno) as kotno,sm.ser_firstname as staff,mn.mr_time_min as menutime,tm.tr_tableno as tbl,tds.ts_tableid,tds.ts_tableidprefix as prefix,tos.ter_billnumber as blno,tos.ter_entrytime as biltime,km.kr_kotcode as kotcod  from tbl_tableorder as tos  LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=tos.ter_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter LEFT JOIN tbl_tabledetails tds on tds.ts_orderno =tos.ter_orderno LEFT JOIN tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid LEFT JOIN tbl_staffmaster sm on sm.ser_staffid=tos.ter_staff WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND (tos.ter_status='Opened' or tos.ter_status='Ready' or tos.ter_status='Added')  and tos.ter_status<>'Closed' AND tos.ter_kotno<>'0' AND km.kr_kotcode='".$value."' group by tos.ter_kotno order by tos.ter_kot_canceltime DESC";
                                  
                         }
                        //echo $_SESSION['kotcounterselected']; 
			//echo $sql_menulist;
                        // echo "select distinct(tos.ter_kotno) as kotno,sm.ser_firstname as staff,mn.mr_time_min as menutime,tm.tr_tableno as tbl,tds.ts_tableid,tds.ts_tableidprefix as prefix,tos.ter_billnumber as blno,tos.ter_entrytime as biltime,km.kr_kotcode as kotcod  from tbl_tableorder as tos  LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=tos.ter_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter LEFT JOIN tbl_tabledetails tds on tds.ts_orderno =tos.ter_orderno LEFT JOIN tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid LEFT JOIN tbl_staffmaster sm on sm.ser_staffid=tos.ter_staff WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND (tos.ter_status='Opened' or tos.ter_status='Ready' or tos.ter_status='Added')  and tos.ter_status<>'Closed' AND tos.ter_kotno<>'0' group by tos.ter_kotno order by tos.ter_kot_canceltime DESC ";
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){ $dishtime="";
                                                $current_time="";
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{// take_active
                                                        $a='a';
                                                        
                                                        
                                                        $staff=$result_menus['staff'];
                                                       if(strlen($staff)>10){
                                                           $staff=substr($staff,0,8);
                                                           }
                                            $menutime[]=$result_menus['menutime'];
                                                        $max_time=max($menutime);
                                                   $dishtime = date('Y-m-d h:i a',strtotime("+".$max_time." minutes", strtotime($result_menus['biltime'])));
                                                    $current_time=date('Y-m-d h:i a');
                                                    
                                                    $sql_menulist2="SELECT ch_cancelled_qty from tbl_tableorder_changes WHERE  ch_kotno='".$result_menus['kotno']."'";
				 //echo "SELECT (ch_cancelled_qty+'".$result_menus1['qty']."') as oldqty from tbl_tableorder_changes WHERE ch_orderno='".$result_menus1['ter_orderno']."'";
                                                    $sql_menus2  =  $database->mysqlQuery($sql_menulist2); 
                                                $num_menus2  = $database->mysqlNumRows($sql_menus2);
                                             if($num_menus2){
                                                $a='b';
                                
                                                $result_menus2  = $database->mysqlFetchArray($sql_menus2);
                                                }
                                                    
                                                    
                                                    
							?>
                <div class="pin" <?php if($dishtime<$current_time){ ?> style="background-color: #ff8181"<?php }else{  }?> onClick="return popupfunction('<?=$result_menus['kotno']?>','<?=$result_menus['blno']?>','<?=$_SESSION['date']?>','<?=$_SESSION['s_kod_takeaway']?>','<?=$mode?>','<?=$_SESSION['s_kod_dinein']?>','<?=$result_menus['kotcod']?>')">
                  <div class="kod_detail_number"<?php if($a=='b'){ ?> style="background-color:red"<?php }?>>
                      <div class="kod_number_box"><?=$result_menus['kotno']?></div>
                      
                      <div class="time_kod_cc"><?=date("h:i a",strtotime($result_menus['biltime'])) ?></div>
                   </div>
                   <div class="kod_table_number_steward"><span>Table: <?=$result_menus['tbl']?>(<?=$result_menus['prefix']?>)</span> | <span>Steward: <?=$staff?></span></div>
                   <?php
				   $sql_menulist1='';
				 
		$sql_menulist11="select tor.ter_count_combo_ordering,tor.ter_unit_weight,tor.ter_rate_type,tor.ter_unit_type,um.u_name,bum.bu_name,sum(tor.ter_qty) as qty,tor.ter_orderno,tor.ter_slno as slno,mi.mes_imagethumb as image,tor.ter_preference as per1,tor.ter_preferencetext as per2,tmr.mr_menuname as menuname,tmr.mr_menuid,tpr.pm_portionshortcode as portion,tor.ter_status as status from tbl_tableorder as tor LEFT JOIN tbl_menumaster as tmr ON tor.ter_menuid=tmr.mr_menuid LEFT JOIN  tbl_portionmaster as tpr ON tpr.pm_id=tor.ter_portion left join tbl_unit_master um on um.u_id=tor.ter_unit_id left join tbl_base_unit_master bum on bum.bu_id=tor.ter_base_unit_id LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tmr.mr_menuid  where  tor.ter_kotno='".$result_menus['kotno']."' and tor.ter_dayclosedate='".$_SESSION['date']."'  AND   tmr.mr_kotcounter= '".$result_menus['kotcod']."' and tmr.mr_show_in_kod='Y' group by ter_menuid,ter_portion,ter_unit_id,ter_base_unit_id,ter_unit_weight  order by ter_slno,ter_count_combo_ordering ASC ";
		//echo "select tor.ter_unit_weight,tor.ter_rate_type,tor.ter_unit_type,um.u_name,bum.bu_name,tor.ter_qty as qty,tor.ter_orderno,tor.ter_slno as slno,mi.mes_imagethumb as image,tor.ter_preference as per1,tor.ter_preferencetext as per2,tmr.mr_menuname as menuname,tmr.mr_menuid,tpr.pm_portionshortcode as portion,tor.ter_status as status from tbl_tableorder as tor LEFT JOIN tbl_menumaster as tmr ON tor.ter_menuid=tmr.mr_menuid LEFT JOIN  tbl_portionmaster as tpr ON tpr.pm_id=tor.ter_portion left join tbl_unit_master um on um.u_id=tor.ter_unit_id left join tbl_base_unit_master bum on bum.bu_id=tor.ter_base_unit_id LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tmr.mr_menuid  where  tor.ter_kotno='".$result_menus['kotno']."' and tor.ter_dayclosedate='".$_SESSION['date']."'  AND   tmr.mr_kotcounter= '".$result_menus['kotcod']."' and tmr.mr_show_in_kod='Y'  order by ter_slno ASC ";
                $sql_menus1  = mysqli_query($localhost,$sql_menulist11); 
                
                $num_menus1  = mysqli_num_rows($sql_menus1);
                if($num_menus1){$i=1;$pref='';
                                $combo_ordering_count=array();
                                $combo_pack_rate=0;
                                $combo_menu_qty=0;
                                $combo_qty=0;
		while($result_menus1  = mysqli_fetch_array($sql_menus1)) 
			{ $a='a';
                            $unit='';
                            
                            //////////////////////  COMBO NAEMS///////////////////////////////
                                
                                $combo_ordering_count_each=$result_menus1['ter_count_combo_ordering'];
                                $sql_combo_heading  =  mysqli_query($localhost,"select  cn.cn_name,cp.cp_pack_name,cod.cod_combo_qty,cod.cod_menu_qty,cod.cod_combo_pack_rate FROM 
                                tbl_combo_ordering_details cod 
                                left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id
                                where cod.cod_count_combo_ordering='".$result_menus1['ter_count_combo_ordering']."' and cod.cod_menu_id='".$result_menus1['mr_menuid']."'  and cod.cod_count_combo_ordering IS NOT  NULL"); 
                                $num_combo_heading  = mysqli_num_rows($sql_combo_heading);
                                if($num_combo_heading)
                                    {
                                        $result_combo_heading  = mysqli_fetch_array($sql_combo_heading);
                                        $combo_pack_rate=$result_combo_heading['cod_combo_pack_rate'];
                                        $combo_menu_qty=$result_combo_heading['cod_menu_qty'];
                                        $combo_qty=$result_combo_heading['cod_combo_qty'];
                                        $combo_name = $result_combo_heading['cn_name'].' - '. $result_combo_heading['cp_pack_name'].' (Qty:'.$result_combo_heading['cod_combo_qty'].') ';
                                    }
                               
                               
                              //////////////////// COMBO NAMES ///////////////////////////////////
                            
                            
                            if($result_menus1['ter_unit_type']=='Packet'){$unit= number_format($result_menus1['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_menus1['u_name'];  } else if($result_menus1['ter_unit_type']=='Loose'){ $unit= number_format($result_menus1['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_menus1['bu_name']; }
                            
                            $menu_name= $result_menus1['menuname'];
                        
                if($_SESSION['main_language']!='english'){
                
                $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus1['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");
                
                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                $menu_name=$result_arabmenu['lm_menu_name'];
                // $catid['name'][] = $catname;
                //echo $catname;
                }
                    
                        
                                  $sql_menulist2="SELECT (sum(ch_cancelled_qty)+'".$result_menus1['qty']."') as oldqty,ch_combo_pack_cancelled_qty as combo_cancelled from tbl_tableorder_changes WHERE ch_orderno='".$result_menus1['ter_orderno']."' and ch_kotno='".$result_menus['kotno']."' and ch_orderslno='".$result_menus1['slno']."' group  by ch_orderno,ch_orderslno";
			//echo "SELECT (sum(ch_cancelled_qty)+'".$result_menus1['qty']."') as oldqty from tbl_tableorder_changes WHERE ch_orderno='".$result_menus1['ter_orderno']."' and ch_kotno='".$result_menus['kotno']."' and ch_orderslno='".$result_menus1['slno']."' group by ch_orderno,ch_orderslno";
                               $sql_menus2  =  $database->mysqlQuery($sql_menulist2); 
                                $num_menus2  = $database->mysqlNumRows($sql_menus2);
                                if($num_menus2){
                                    $a='b';
                                
                                    $result_menus2  = $database->mysqlFetchArray($sql_menus2);
                                }
                               
				
				 if($result_menus1['per1'])
							{
								$pf=$database->show_prefernce_ful_details($result_menus1['per1']);
								$pref=$pf['pmr_name'];
							}else
							{
								$pref="";
							}
							if($result_menus1['per2'])
							{
								if($pref!="")
								{
									$pref=$pref ." , " .$result_menus1['per2'];
								}else
								{
									$pref=$result_menus1['per2'];
								}
							}else
							{
								
							}
				
//                                                        $kod_menuid= trim(json_encode($result_menus1['mr_menuid']),'""');
//                                                        $fp=fopen($apilink."/src/main_menu_display.php?set=orderedmenu&ordered_menuid=$kod_menuid&dat=$other_lang","r");
//                                                        $response['messages'] = stream_get_contents($fp);
//                                                        //echo  $response['messages'];
//                                                        $resu= json_decode($response['messages'],true);
				
				
					
					?>
                    <div class="kod_list_item">
                    <?php   if( $imagepermission=='Y'){ ?> 
                    <div class="kod_dish_image"><img src="<?=$result_menus1['image']?>"></div><?php } else{ }
                        if($combo_ordering_count_each && !in_array($combo_ordering_count_each,$combo_ordering_count)){
                           $combo_ordering_count[]=$combo_ordering_count_each;
                        ?>
                       <p class="combo_sec_kod"><?=$combo_name?></p><br>
                       <?php }else{
                           $combo_name='';
                       }?>
                     <h1><?php if($a=='b'){?><strike style="color:red"><?php }?><span><?php if($combo_qty>0){ if($a=='a'){ echo $combo_qty.'*'; echo $combo_menu_qty;} else { echo $combo_qty+$result_menus2['combo_cancelled'].'*'; echo $combo_menu_qty;}} else{ if($a=='a'){ echo $result_menus1['qty'];} else { echo $result_menus2['oldqty'];} }?></span> <span><?php if($result_menus1['portion']!=''){ echo '('.$result_menus1['portion'].')';} else { echo '('.$unit.')'; }?></span> * <span><?=$menu_name?></span><?php if($a=='b'){?></strike><?php }?>
                     	<div class="kod_order_status">
                        
                        <?php if($result_menus1['status']=='Ready'){ ?><img src="img/served-icon-1.png"> <?php } if($result_menus1['status']=='Added'){ ?><img src="img/pending-icon.png"> <?php } if($result_menus1['status']=='Opened' && $result_menus1['qty']!=0){ ?><img src="img/process-ico.png"> <?php } ?>
                       
                        </div>
                         <?php if($combo_qty>0 && $a=='b'){ ?> <p style="font-size:20px;font-weight:bold;"><span><?=$combo_qty.'*'. $combo_menu_qty ?><?php if($result_menus1['portion']!=''){ echo '('.$result_menus1['portion'].')';}?></span>* <span><?=$menu_name?></span></p><?php } else if($a=='b' && $result_menus1['qty']!=0){?> <p style="font-size:20px;font-weight:bold;"><span><?=$result_menus1['qty']?></span> <span><?php if($result_menus1['portion']!=''){ echo '('.$result_menus1['portion'].')';} else {echo '('.$unit.')';}?></span> * <span><?=$menu_name?></span></p><?php }?>
                          <p style=""><?=$pref?></p>
                     </h1>
                     
                    </div>
                    
                    <?php } } ?>
                   
                   
                   <!--<div class="kod_list_item">
                     <h1><span>4</span> <span>(F)</span> * <span>SUGAR FREE PASTRY</span>
                     	<div class="kod_order_status"><img src="img/pending-icon.png"></div>
                     </h1>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <div class="kod_list_item">
                     <h1><span>4</span> <span>(F)</span> * <span>SUGAR FREE PASTRY</span>
                     	<div class="kod_order_status"><img src="img/served-icon.png"></div>
                     </h1>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                    <div class="kod_list_item">
                     <h1><span>4</span> <span>(F)</span> * <span>SUGAR FREE PASTRY</span>
                     	<div class="kod_order_status"><img src="img/process-ico.png"></div>
                     </h1>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>-->
                    
                </div>
                <?php } }  } ?>
                    </div> <!--load_colum-->       
                
             </div><!--left_bill_history_contain-->    
                
            
           
            </div><!--left_contant_container-->
          
      </div><!--middle_container-->          
</div><!--container_fluide-->



 <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- library for cookie management -->
 <script src="js/jquery.cookie.js"></script> 
<script>
$(".dropdown dt a").on('click', function() {
  $(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function() {
  $(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
});

$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();
  } else {
    $('span[title="' + title + '"]').remove();
    var ret = $(".hida");
    $('.dropdown dt a').append(ret);

  }
});
</script>

<div class="kod_item_details_popup">
 <div class="kod_item_details_popup_contant">
 	<div class="kod_item_details_popup_contant_head">
   	KOD ORDER DETAILS 
       <div class="kod_item_details_popup_close"><img width="40px" src="img/cancel-icon.png"></div>
   </div>
   <div class="kod_item_details_popup_cntnt_cc">
       <input type="hidden" id="popkotno" >
           <input type="hidden" id="popbillno" >

   <span class="kod_popup_table_head">
       	<table width="100%" border="0" cellspacing="0">
                 <tbody><tr>
                   <th width="10%">Sl No</th>
                   <th width="61%">Dish Name <input class="chekbx" type="checkbox" id="chekbx"></th>
                   <th width="15%">Qty</th>
                 </tr>
            </tbody></table> 
         	</span> 
<span class="kod_popup_table">
                    <table width="100%" border="0" cellspacing="0">
                       <tbody id="popupmenulists">
                         
                          
                        </tbody>
                      </table>
                    </span>
                <div class="kod_pop_bottom_btn_cc">
                    <a href="#"><div class="kod_pop_bottom_srv_btn served"></div></a>
                <a href="#"><div class="kod_pop_bottom_srv_btn ready">Ready</div></a>
                </div><!--kod_pop_bottom_btn_cc-->
               
   </div>
   
 </div>	
 <div class="kod_item_details_popup_overlay"></div>  
</div><!--kod_item_details_popup-->



</body>

</html>