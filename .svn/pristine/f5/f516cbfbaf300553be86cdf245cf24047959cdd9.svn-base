


<?php

//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
include("api_multiplelanguage_link.php");

if(isset($_SESSION['floorid'])){
$floorid=  trim(json_encode($_SESSION['floorid']),'""');
}
$noofkot=0;
if(isset($_REQUEST['numberofkot'])){
$noofkot= $_REQUEST['numberofkot'];
}


$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
//$value		= $_REQUEST['value'];

//error_reporting(0);

  $sql_menu_image="select be_kod_image from tbl_branchmaster";
            $sql_menuimage  =  $database->mysqlQuery($sql_menu_image); 
		$num_menuimage  = $database->mysqlNumRows($sql_menuimage);
		if($num_menuimage){
                    $result_menuimage  = $database->mysqlFetchArray($sql_menuimage); 
                   $imagepermission=$result_menuimage['be_kod_image'];
                    
                }




if($_REQUEST['value']=='loadkodscreen'){
	$counters=array(); 
if(isset($_REQUEST['counter']))
{
	 $_SESSION['kotcounterselected']=$_REQUEST['counter'];
	 $counters=explode(",",$_SESSION['kotcounterselected']);
	
}else
{
	array_push($counters, $_SESSION['kotcounterselected']);
        
        $_SESSION['kotcounterselected']="ALL";
        
}





$conditionstring_ta='';
$conditionstring_dn='';
if(isset($_REQUEST['pagename']))
{
$conditionstring_ta="( bm.tab_status='Ready' )";
$conditionstring_dn="(tos.ter_status='Ready'  )";
$conditionstring1_dn=" tor.ter_status='Ready' and";	
	
}else
{
$conditionstring_ta="(bm.tab_status='Generated' OR bm.tab_status='Ready' OR bm.tab_status='Processing')";
$conditionstring_dn="(tos.ter_status='Opened' or tos.ter_status='Ready' or tos.ter_status='Added')";	
$conditionstring1_dn="";
}

$combo_ordering_count_each='';
?>

<input type="hidden" name="countrseltd" id="countrseltd" value="<?=$_SESSION['kotcounterselected']?>">
 <?php
 foreach( $counters as $number => $value)
 {
    // echo $value;
     
			 $sql_menulist='';
			 if($_SESSION['s_kod_takeaway']=='Y'  && ($_REQUEST['set'])=='ta')
			 {
			     if($value=="ALL")
			 	{
                                     
			 $sql_menulist= "Select distinct(bd.tab_kotno_new) as kotno,km.kr_kotname,bm.tab_billno as blno,to1.tol_name,mn.mr_time_min as menutime,bm.tab_time as biltime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm left join tbl_online_order to1 on  to1.tol_id=bm.tab_food_partner LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And bm.tab_kotno != '' And $conditionstring_ta AND  (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') and mn.mr_show_in_kod='Y' group by bd.tab_kotno_new,kotcod order by bd.tab_kotno_new DESC ";
				
                         // echo "Select distinct(bm.tab_kotno) as kotno,bm.tab_billno as blno,mn.mr_time_min as menutime,bm.tab_time as biltime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And bm.tab_kotno != '' And $conditionstring_ta  order by bm.tab_time DESC";
                                }else
				{
                                    //echo "Select distinct(bd.tab_kotno_new) as kotno,km.kr_kotname,to1.tol_name,mn.mr_time_min as menutime,bm.tab_billno as blno,bm.tab_time as biltime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm left join tbl_online_order to1 on  to1.tol_id=bm.tab_food_partner LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And bm.tab_kotno != '' And $conditionstring_ta AND km.kr_kotcode='".$value."' and (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') and mn.mr_show_in_kod='Y' group by bd.tab_kotno_new,kotcod order by bd.tab_kotno_new DESC ";
					$sql_menulist= "Select distinct(bd.tab_kotno_new) as kotno,km.kr_kotname,to1.tol_name,mn.mr_time_min as menutime,bm.tab_billno as blno,bm.tab_time as biltime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm left join tbl_online_order to1 on  to1.tol_id=bm.tab_food_partner LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And bm.tab_kotno != '' And $conditionstring_ta AND km.kr_kotcode='".$value."' and (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') and mn.mr_show_in_kod='Y' group by bd.tab_kotno_new,kotcod order by bd.tab_kotno_new DESC ";
				//echo "Select distinct(bd.tab_kotno_new) as kotno,km.kr_kotname,to1.tol_name,mn.mr_time_min as menutime,bm.tab_billno as blno,bm.tab_time as biltime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm left join tbl_online_order to1 on  to1.tol_id=bm.tab_food_partner LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And bm.tab_kotno != '' And $conditionstring_ta AND km.kr_kotcode='".$value."' and (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') and mn.mr_show_in_kod='Y' group by bd.tab_kotno_new,kotcod order by bd.tab_kotno_new DESC ";
                                        
                                }
                                //echo "Select distinct(bm.tab_kotno) as kotno,mn.mr_time_min as menutime,bm.tab_billno as blno,bm.tab_time as biltime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And bm.tab_kotno != '' And $conditionstring_ta AND km.kr_kotcode='".$value."' and (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') group by bm.tab_kotno,kotcod order by bm.tab_kotno DESC ";
			 }else if($_SESSION['s_kod_dinein']=='Y' && ($_REQUEST['set'])=='dine')
			 {
				 if($value=="ALL")
			 	{
				        $sql_menulist="select distinct(tos.ter_kotno) as kotno,km.kr_kotname,sm.ser_firstname as staff,mn.mr_time_min as menutime,tm.tr_tableno as tbl,tds.ts_tableid,tds.ts_tableidprefix as prefix,tos.ter_billnumber as blno,tos.ter_entrytime as biltime,km.kr_kotcode as kotcod  from tbl_tableorder as tos  LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=tos.ter_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter LEFT JOIN tbl_tabledetails tds on tds.ts_orderno =tos.ter_orderno LEFT JOIN tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid LEFT JOIN tbl_staffmaster sm on sm.ser_staffid=tos.ter_staff WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND $conditionstring_dn  and tos.ter_status<>'Closed' AND tos.ter_kotno<>'0' and mn.mr_show_in_kod='Y' and tos.ter_qty>0 group by tos.ter_kotno,kotcod order by tos.ter_kot_canceltime DESC ";//ORDER BY LPAD(lower(tos.ter_kotno), 10,0) DESC
				}else
				{
					 $sql_menulist="select distinct(tos.ter_kotno) as kotno,km.kr_kotname,sm.ser_firstname as staff,mn.mr_time_min as menutime,tm.tr_tableno as tbl,tds.ts_tableid,tds.ts_tableidprefix as prefix,tos.ter_billnumber as blno,tos.ter_entrytime as biltime,km.kr_kotcode as kotcod  from tbl_tableorder as tos  LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=tos.ter_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter LEFT JOIN tbl_tabledetails tds on tds.ts_orderno =tos.ter_orderno LEFT JOIN tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid  LEFT JOIN tbl_staffmaster sm on sm.ser_staffid=tos.ter_staff WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND $conditionstring_dn  and tos.ter_status<>'Closed' AND tos.ter_kotno<>'0' AND km.kr_kotcode='".$value."' and mn.mr_show_in_kod='Y' and tos.ter_qty>0 group by tos.ter_kotno,kotcod order by tos.ter_kot_canceltime DESC";//ORDER BY LPAD(lower(tos.ter_kotno), 10,0) DESC
				//echo "select distinct(tos.ter_kotno) as kotno,sm.ser_firstname as staff,mn.mr_time_min as menutime,tm.tr_tableno as tbl,tds.ts_tableid,tds.ts_tableidprefix as prefix,tos.ter_billnumber as blno,tos.ter_entrytime as biltime,km.kr_kotcode as kotcod  from tbl_tableorder as tos  LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=tos.ter_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter LEFT JOIN tbl_tabledetails tds on tds.ts_orderno =tos.ter_orderno LEFT JOIN tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid  LEFT JOIN tbl_staffmaster sm on sm.ser_staffid=tos.ter_staff WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND $conditionstring_dn  and tos.ter_status<>'Closed' AND tos.ter_kotno<>'0' AND km.kr_kotcode='".$value."' and mn.mr_show_in_kod='Y' and tos.ter_qty>0 group by tos.ter_kotno,kotcod order by tos.ter_kot_canceltime DESC";
                                         
                                }
				//echo $sql_menulist;
			 }//echo  $sql_menulist;
                         
                         $tbl="";
                         $a="";
                         $arr_kot=  array();
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){
                                    $dishtime="";       
                                    $current_time="";
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{$a='a';
                                                  $arr_kot[]=$result_menus['kotno'];
                                                  
                                                    $menutime[]=$result_menus['menutime'];
                                                        $max_time=max($menutime);
                                                    $dishtime = date('Y-m-d h:i a',strtotime("+".$max_time." minutes", strtotime($result_menus['biltime'])));
                                                    $current_time=date('Y-m-d h:i a');
                                                    
                                                   if($_SESSION['s_kod_dinein']=='Y' && ($_REQUEST['set'])=='dine'){
                                                     $tbl=$result_menus['tbl'];
                                                     $staff=$result_menus['staff'];
                                                       if(strlen($staff)>12){
                                                           $staff=substr($staff,0,9);
                                                           }
                                                     
                                                   $sql_menulist2="SELECT ch_cancelled_qty from tbl_tableorder_changes WHERE  ch_kotno='".$result_menus['kotno']."'";
				// echo "SELECT (ch_cancelled_qty+'".$result_menus1['qty']."') as oldqty from tbl_tableorder_changes WHERE ch_orderno='".$result_menus1['ter_orderno']."'";
                                                    $sql_menus2  =  $database->mysqlQuery($sql_menulist2); 
                                                $num_menus2  = $database->mysqlNumRows($sql_menus2);
                                             if($num_menus2){
                                                 
                                                $a='b';
                                
                                                $result_menus2  = $database->mysqlFetchArray($sql_menus2);
                                                }
                                                     
                                                   }?>
<?php   if($value!="ALL" && count($counters)==1){ ?>

   <div class="kod_row_main">
       
<?php  } ?>
                <div class="pin" <?php if($dishtime<$current_time){ ?> style="background-color: #ff8181"<?php }else{  }?> onClick="return popupfunction('<?=$result_menus['kotno']?>','<?=$result_menus['blno']?>','<?=$_SESSION['date']?>','<?=$_SESSION['s_kod_takeaway']?>','<?=$_REQUEST['set']?>','<?=$_SESSION['s_kod_dinein']?>','<?=$result_menus['kotcod']?>')">
                  <div style="min-height: 30px;height:auto" class="kod_detail_number" <?php if($a=='b'){ ?> style="background-color:red"<?php }?>>
                      <div  class="kod_number_box"><?=$result_menus['kotno']?> - <?=date("h:i a",strtotime($result_menus['biltime'])) ?></div> 
                      <div class="time_kod_cc" style="max-width:200px;overflow: hidden;text-overflow:ellipsis"> <span> <?=$result_menus['kr_kotname']?></span> </div>
                    
                      <?php if($_REQUEST['set']=='ta' && $result_menus['tol_name'] !='' ){ ?>
                      <span style='color:white;text-transform: uppercase;width:100%;float:left'>[<?=$result_menus['tol_name']?>]</span>
                    <?php } ?>  
                  </div> 
                      
                    
                      
                   
                    
                 
                   <?php if($tbl==""){ ?><div class="kod_table_number_steward"><span></span>  <span></span></div>
                      <?php }else{?><div class="kod_table_number_steward"><?php if($result_menus['tbl']!=""){ ?><span>Table: <?=$result_menus['tbl']?>(<?=$result_menus['prefix']?>)</span> | <span>Steward: <?=$staff?></span><?php } ?></div><?php }?>
                      
                      
                      
                   <?php
				   $sql_menulist1='';
			if($_SESSION['s_kod_takeaway']=='Y'  && ($_REQUEST['set'])=='ta')
			 {
				
                            //echo "Select bd.tab_count_combo_ordering,bd.tab_unit_weight as unit_weight,bd.tab_rate_type,bd.tab_unit_type as unit_type,um.u_name,bum.bu_name,sum(bd.tab_qty) as qty,mi.mes_imagethumb as image,bd.tab_preferencetext as pref,bd.tab_slno,tbl_menumaster.mr_menuname as menuname,tbl_menumaster.mr_menuid,tbl_portionmaster.pm_portionshortcode as portion,bd.tab_status  as status  From tbl_menumaster left Join tbl_takeaway_billdetails as bd On bd.tab_menuid = tbl_menumaster.mr_menuid left Join tbl_portionmaster On tbl_portionmaster.pm_id =bd.tab_portion left join tbl_unit_master um on um.u_id=bd.tab_unit_id left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tbl_menumaster.mr_menuid Where bd.tab_kotno_new = '".$result_menus['kotno']."'  AND (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') AND   tbl_menumaster.mr_kotcounter= '".$result_menus['kotcod']."' and tbl_menumaster.mr_show_in_kod='Y' group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id,bd.tab_base_unit_id,bd.tab_unit_weight  order by bd.tab_slno ASC ";
                            $sql_menulist1= "Select bd.tab_count_combo_ordering,bd.tab_unit_weight as unit_weight,bd.tab_rate_type,bd.tab_unit_type as unit_type,um.u_name,bum.bu_name,sum(bd.tab_qty) as qty,mi.mes_imagethumb as image,bd.tab_preferencetext as pref,bd.tab_slno,tbl_menumaster.mr_menuname as menuname,tbl_menumaster.mr_menuid,tbl_portionmaster.pm_portionshortcode as portion,bd.tab_status  as status  From tbl_menumaster left Join tbl_takeaway_billdetails as bd On bd.tab_menuid = tbl_menumaster.mr_menuid left Join tbl_portionmaster On tbl_portionmaster.pm_id =bd.tab_portion left join tbl_unit_master um on um.u_id=bd.tab_unit_id left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_takeaway_billmaster  as bm ON bd.tab_billno=bm.tab_billno Where  bd.tab_kotno_new = '".$result_menus['kotno']."' And bm.tab_dayclosedate ='".$_SESSION['date']."'  AND (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') AND   tbl_menumaster.mr_kotcounter= '".$result_menus['kotcod']."' and tbl_menumaster.mr_show_in_kod='Y' group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id,bd.tab_base_unit_id,bd.tab_unit_weight  order by bd.tab_slno ASC ";
                                     //echo "Select bd.tab_qty as qty,mi.mes_imagethumb as image,bd.tab_preferencetext as pref,bd.tab_slno,tbl_menumaster.mr_menuname as menuname,tbl_menumaster.mr_menuid,tbl_portionmaster.pm_portionshortcode as portion,bd.tab_status  as status  From tbl_menumaster Inner Join tbl_takeaway_billdetails as bd On bd.tab_menuid = tbl_menumaster.mr_menuid Inner Join tbl_portionmaster On tbl_portionmaster.pm_id =bd.tab_portion LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tbl_menumaster.mr_menuid Where bd.tab_billno = '".$result_menus['blno']."' AND (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') AND   tbl_menumaster.mr_kotcounter= '".$result_menus['kotcod']."'  order by bd.tab_slno DESC ";
                            // echo "Select bd.tab_count_combo_ordering,bd.tab_unit_weight as unit_weight,bd.tab_rate_type,bd.tab_unit_type as unit_type,um.u_name,bum.bu_name,sum(bd.tab_qty) as qty,mi.mes_imagethumb as image,bd.tab_preferencetext as pref,bd.tab_slno,tbl_menumaster.mr_menuname as menuname,tbl_menumaster.mr_menuid,tbl_portionmaster.pm_portionshortcode as portion,bd.tab_status  as status  From tbl_menumaster left Join tbl_takeaway_billdetails as bd On bd.tab_menuid = tbl_menumaster.mr_menuid left Join tbl_portionmaster On tbl_portionmaster.pm_id =bd.tab_portion left join tbl_unit_master um on um.u_id=bd.tab_unit_id left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tbl_menumaster.mr_menuid Where bd.tab_kotno_new = '".$result_menus['kotno']."'  AND (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') AND   tbl_menumaster.mr_kotcounter= '".$result_menus['kotcod']."' and tbl_menumaster.mr_show_in_kod='Y' group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id,bd.tab_base_unit_id,bd.tab_unit_weight  order by bd.tab_slno ASC ";
                                     
                         }else if($_SESSION['s_kod_dinein']=='Y' && ($_REQUEST['set'])=='dine')
			 {
				  $sql_menulist1="select tor.ter_count_combo_ordering,tor.ter_unit_weight as unit_weight,tor.ter_rate_type,tor.ter_unit_type as unit_type,um.u_name,bum.bu_name,sum(tor.ter_qty) as qty,tor.ter_orderno,tor.ter_slno as slno,sum(tor.ter_qty) as qty,mi.mes_imagethumb as image,tor.ter_preference as per1,tor.ter_preferencetext as per2,tmr.mr_menuname as menuname,tmr.mr_menuid,tpr.pm_portionshortcode as portion,tor.ter_status as status from tbl_tableorder as tor LEFT JOIN tbl_menumaster as tmr ON tor.ter_menuid=tmr.mr_menuid LEFT JOIN  tbl_portionmaster as tpr ON tpr.pm_id=tor.ter_portion left join tbl_unit_master um on um.u_id=tor.ter_unit_id left join tbl_base_unit_master bum on bum.bu_id=tor.ter_base_unit_id LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tmr.mr_menuid  where $conditionstring1_dn   tor.ter_kotno='".$result_menus['kotno']."'  and tor.ter_dayclosedate='".$_SESSION['date']."' AND   tmr.mr_kotcounter= '".$result_menus['kotcod']."' and tmr.mr_show_in_kod='Y' group by ter_menuid,ter_portion,ter_unit_id,ter_base_unit_id,ter_unit_weight  order by ter_slno,ter_count_combo_ordering ASC ";
			 }
                         //echo $sql_menulist1;
	$sql_menus1  =  $database->mysqlQuery($sql_menulist1); 
	$num_menus1  = $database->mysqlNumRows($sql_menus1);
	if($num_menus1){$i=0;$pref='';$unit='';$combo_ordering_count=array();
                                $combo_pack_rate=0;
                                $combo_menu_qty=0;
                                $combo_qty=0;
		while($result_menus1  = $database->mysqlFetchArray($sql_menus1)) 
			{$a='a';
                         if($result_menus1['unit_type']=='Packet'){$unit= number_format($result_menus1['unit_weight'],$_SESSION['be_decimal']).' '.$result_menus1['u_name'];  } else if($result_menus1['unit_type']=='Loose'){ $unit= number_format($result_menus1['unit_weight'],$_SESSION['be_decimal']).' '.$result_menus1['bu_name']; }       
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
                        
                        
                        
				 if($_SESSION['s_kod_takeaway']=='Y'  && ($_REQUEST['set'])=='ta')
			 	{       
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
			   }else  if($_SESSION['s_kod_dinein']=='Y'  && ($_REQUEST['set'])=='dine')
			   {
                               
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
                               
                               
                               
                               $sql_menulist2="SELECT (sum(ch_cancelled_qty)+'".$result_menus1['qty']."') as oldqty,ch_combo_pack_cancelled_qty as combo_cancelled from tbl_tableorder_changes WHERE ch_orderno='".$result_menus1['ter_orderno']."' and ch_kotno='".$result_menus['kotno']."' and ch_orderslno='".$result_menus1['slno']."' group  by ch_orderno,ch_orderslno";
				//echo "SELECT (sum(ch_cancelled_qty)+'".$result_menus1['qty']."') as oldqty from tbl_tableorder_changes WHERE ch_orderno='".$result_menus1['ter_orderno']."' and ch_kotno='".$result_menus['kotno']."' and ch_orderslno='".$result_menus1['slno']."' group  by ch_orderno,ch_orderslno";
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
				
			   }
//                                                                
				
				
					
					?>
<!--                    <input type="hidden" id="cancelcolor<?=$i?>" value="<?=$a?>">-->
                    <div class="kod_list_item">
                        <?php if($imagepermission=='Y'){ ?>
                        <div class="kod_dish_image"><img src="<?=$result_menus1['image']?>"></div><?php } else { }
                        if($combo_ordering_count_each && !in_array($combo_ordering_count_each,$combo_ordering_count)){
                           $combo_ordering_count[]=$combo_ordering_count_each;
                        ?>
                        <p class="combo_sec_kod"><?=$combo_name?></p><br>
                        <?php }else{
                           $combo_name='';
                        }
                        ?>
                        <h1><?php if($a=='b'){?><strike style="color:red"><?php }?><span><?php if($combo_qty>0){ if($a=='a'){ echo $combo_qty.'*'; echo $combo_menu_qty;} else { echo $combo_qty+$result_menus2['combo_cancelled'].'*'; echo $combo_menu_qty;}} else{ if($a=='a'){ echo $result_menus1['qty'];} else { echo $result_menus2['oldqty'];} }?></span> <span><?php if($result_menus1['portion']!=''){ echo '('.$result_menus1['portion'].')';} else { echo '('.$unit.')'; }?></span> * <span><?=$menu_name?></span><?php if($a=='b'){ ?></strike><?php }?>
                     	<div class="kod_order_status">
                        <?php  if($_SESSION['s_kod_takeaway']=='Y'  && ($_REQUEST['set'])=='ta') { ?>
			<?php if($result_menus1['status']=='Ready'){ ?><img src="img/served-icon-1.png"> <?php } if($result_menus1['status']=='Generated'){ ?><img src="img/pending-icon.png"> <?php } if($result_menus1['status']=='Processing'){ ?><img src="img/process-ico.png"> <?php } ?>
                        <?php }else if($_SESSION['s_kod_dinein']=='Y'  && ($_REQUEST['set'])=='dine') { ?>
                        <?php if($result_menus1['status']=='Ready'){ ?><img src="img/served-icon-1.png"> <?php } if($result_menus1['status']=='Added'){ ?><img src="img/pending-icon.png"> <?php } if($result_menus1['status']=='Opened'&& $result_menus1['qty']!=0){ ?><img src="img/process-ico.png"> <?php } ?>
                        <?php } ?>
                        </div>
                          <?php if($combo_qty>0 && $a=='b'){ ?> <p style="font-size:20px;font-weight:bold;"><span><?=$combo_qty.'*'. $combo_menu_qty ?><?php if($result_menus1['portion']!=''){ echo '('.$result_menus1['portion'].')';}?></span>* <span><?=$menu_name?></span></p><?php } else if($a=='b' && $result_menus1['qty']!=0){?> <p style="font-size:20px;font-weight:bold;"><span><?=$result_menus1['qty']?></span> <span><?php if($result_menus1['portion']!=''){ echo '('.$result_menus1['portion'].')';} else {echo '('.$unit.')';}?></span> * <span><?=$menu_name?></span></p><?php }?>
                         <p style=""><?=$pref?></p>
                     </h1>
                      
                    </div>
                    
                    <?php
                    
                    
                    
                     } } 
                     ?>
                   
                      
                      
                      
                         </div>
                      
                      
                      
<!--                     //new change/////////// -->
                      
                      
                      
                      
                      
                      
                      
                      <?php
                      
                  
                   
                  // echo count($arr_kot);
                   $hi='';
                    
                    if($value!="ALL" && $hi=='rr' && count($counters)==1){
                        
                        
                       
                        
                           //echo $arr_kot[$zz]; 
                            
                            
                        if($_SESSION['s_kod_takeaway']=='Y'  && ($_REQUEST['set'])=='ta')
			 {
			$sql_menulist11= "Select distinct(bd.tab_kotno_new) as kotno,km.kr_kotname,mn.mr_time_min as menutime,bm.tab_billno as blno,bm.tab_time as biltime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And  bd.tab_kotno_new =  '".$result_menus['kotno']."' AND    mn.mr_kotcounter= '".$result_menus['kotcod']."' And $conditionstring_ta  and (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') and mn.mr_show_in_kod='Y' group by bd.tab_kotno_new,kotcod order by bd.tab_kotno_new DESC ";
			//echo "Select distinct(bm.tab_kotno) as kotno,mn.mr_time_min as menutime,bm.tab_billno as blno,bm.tab_time as biltime,km.kr_kotcode as kotcod From tbl_takeaway_billmaster as bm LEFT JOIN tbl_takeaway_billdetails as bd ON bd.tab_billno=bm.tab_billno LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=bd.tab_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter  Where bm.tab_dayclosedate ='".$_SESSION['date']."' And bm.tab_kotno =  '".$result_menus['kotno']."' And $conditionstring_ta  and (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') and mn.mr_show_in_kod='Y' group by bm.tab_kotno,kotcod order by bm.tab_kotno DESC ";	
			 }else  if($_SESSION['s_kod_dinein']=='Y' && ($_REQUEST['set'])=='dine')
			 {
				
			$sql_menulist11="select distinct(tos.ter_kotno) as kotno,km.kr_kotname,sm.ser_firstname as staff,mn.mr_time_min as menutime,tm.tr_tableno as tbl,tds.ts_tableid,tds.ts_tableidprefix as prefix,tos.ter_billnumber as blno,tos.ter_entrytime as biltime,km.kr_kotcode as kotcod  from tbl_tableorder as tos  LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=tos.ter_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter LEFT JOIN tbl_tabledetails tds on tds.ts_orderno =tos.ter_orderno LEFT JOIN tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid  LEFT JOIN tbl_staffmaster sm on sm.ser_staffid=tos.ter_staff WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND $conditionstring_dn  and tos.ter_status<>'Closed' AND tos.ter_kotno='".$result_menus['kotno']."'  AND km.kr_kotcode='".$value."' and mn.mr_show_in_kod='Y' and tos.ter_qty>0 group by tos.ter_kotno,kotcod order by tos.ter_kot_canceltime DESC";//ORDER BY LPAD(lower(tos.ter_kotno), 10,0) DESC
			//echo "select distinct(tos.ter_kotno) as kotno,sm.ser_firstname as staff,mn.mr_time_min as menutime,tm.tr_tableno as tbl,tds.ts_tableid,tds.ts_tableidprefix as prefix,tos.ter_billnumber as blno,tos.ter_entrytime as biltime,km.kr_kotcode as kotcod  from tbl_tableorder as tos  LEFT JOIN tbl_menumaster as mn ON  mn.mr_menuid=tos.ter_menuid LEFT JOIN tbl_kotcountermaster as km ON km.kr_kotcode=mn.mr_kotcounter LEFT JOIN tbl_tabledetails tds on tds.ts_orderno =tos.ter_orderno LEFT JOIN tbl_tablemaster tm on tm.tr_tableid=tds.ts_tableid  LEFT JOIN tbl_staffmaster sm on sm.ser_staffid=tos.ter_staff WHERE tos.ter_dayclosedate='".$_SESSION['date']."' AND $conditionstring_dn  and tos.ter_status<>'Closed' AND tos.ter_kotno='".$arr_kot[$zz]."' AND km.kr_kotcode!='".$value."'  and mn.mr_show_in_kod='Y' and tos.ter_qty>0 group by tos.ter_kotno,kotcod order by tos.ter_kot_canceltime DESC";	
                        
                         }
                         
                         
                          $tbl="";
                         $a="";
				$sql_menus11  =  $database->mysqlQuery($sql_menulist11); 
				$num_menus11  = $database->mysqlNumRows($sql_menus11);
				if($num_menus11){
                                    $dishtime="";
                                    $current_time="";
					while($result_menus11  = $database->mysqlFetchArray($sql_menus11)) 
						{$a='a';  
                                             
                                                    $menutime[]=$result_menus11['menutime'];
                                                        $max_time=max($menutime);
                                                    $dishtime = date('Y-m-d h:i a',strtotime("+".$max_time." minutes", strtotime($result_menus11['biltime'])));
                                                    $current_time=date('Y-m-d h:i a');
                                                    
                                                   if($_SESSION['s_kod_dinein']=='Y' && ($_REQUEST['set'])=='dine'){
                                                     $tbl=$result_menus11['tbl'];
                                                     $staff=$result_menus11['staff'];
                                                       if(strlen($staff)>12){
                                                           $staff=substr($staff,0,9);
                                                           }
                                                     
                                                   $sql_menulist2="SELECT ch_cancelled_qty from tbl_tableorder_changes WHERE  ch_kotno='".$result_menus11['kotno']."'";
				// echo "SELECT (ch_cancelled_qty+'".$result_menus1['qty']."') as oldqty from tbl_tableorder_changes WHERE ch_orderno='".$result_menus1['ter_orderno']."'";
                                                    $sql_menus2  =  $database->mysqlQuery($sql_menulist2); 
                                                $num_menus2  = $database->mysqlNumRows($sql_menus2);
                                             if($num_menus2){
                                                $a='b';
                                
                                                $result_menus2  = $database->mysqlFetchArray($sql_menus2);
                                                }
                                                     
                                                   }?>
                <div class="pin second_div_kod" <?php if($dishtime<$current_time){ ?> style="background-color: #ff8181"<?php }else{  }?> >
                  <div class="kod_detail_number" <?php if($a=='b'){ ?> style="background-color:red"<?php }?>>
                      <div style="display:block" class="kod_number_box"><?=$result_menus11['kotno']?></div>
                      <div  class="time_kod_cc"><span><?=$result_menus11['kr_kotname']?> </span></div>
                       
                   </div>
                   <?php if($tbl==""){ ?><div class="kod_table_number_steward"><span></span>  <span></span></div>
                      <?php }else{?><div style="display:none" class="kod_table_number_steward"><?php if($result_menus11['tbl']!=""){ ?><span>Table: <?=$result_menus11['tbl']?>(<?=$result_menus11['prefix']?>)</span> | <span>Steward: <?=$staff?></span><?php } ?></div><?php }?>
                      
                      
                      
                   <?php
                  
				   $sql_menulist1='';
			if($_SESSION['s_kod_takeaway']=='Y'  && ($_REQUEST['set'])=='ta')
			 {
				     $sql_menulist1= "Select bd.tab_count_combo_ordering,bd.tab_unit_weight as unit_weight,bd.tab_rate_type,bd.tab_unit_type as unit_type,um.u_name,bum.bu_name,sum(bd.tab_qty) as qty,mi.mes_imagethumb as image,bd.tab_preferencetext as pref,bd.tab_slno,tbl_menumaster.mr_menuname as menuname,tbl_menumaster.mr_menuid,tbl_portionmaster.pm_portionshortcode as portion,bd.tab_status  as status  From tbl_menumaster left Join tbl_takeaway_billdetails as bd On bd.tab_menuid = tbl_menumaster.mr_menuid left Join tbl_portionmaster On tbl_portionmaster.pm_id =bd.tab_portion left join tbl_unit_master um on um.u_id=bd.tab_unit_id left join tbl_base_unit_master bum on bum.bu_id=bd.tab_base_unit_id LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_takeaway_billmaster  as bm ON bd.tab_billno=bm.tab_billno Where bd.tab_kotno_new = '".$result_menus11['kotno']."' AND  bm.tab_dayclosedate  ='".$_SESSION['date']."' And (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') AND   tbl_menumaster.mr_kotcounter= '".$result_menus11['kotcod']."' and tbl_menumaster.mr_show_in_kod='Y' group by bd.tab_menuid,bd.tab_portion,bd.tab_unit_id,bd.tab_base_unit_id,bd.tab_unit_weight  order by bd.tab_slno ASC ";
                                     //echo "Select bd.tab_qty as qty,mi.mes_imagethumb as image,bd.tab_preferencetext as pref,bd.tab_slno,tbl_menumaster.mr_menuname as menuname,tbl_menumaster.mr_menuid,tbl_portionmaster.pm_portionshortcode as portion,bd.tab_status  as status  From tbl_menumaster Inner Join tbl_takeaway_billdetails as bd On bd.tab_menuid = tbl_menumaster.mr_menuid Inner Join tbl_portionmaster On tbl_portionmaster.pm_id =bd.tab_portion LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tbl_menumaster.mr_menuid Where bd.tab_billno = '".$result_menus['blno']."' AND (bd.tab_status='Generated' OR bd.tab_status='Ready' OR bd.tab_status='Processing') AND   tbl_menumaster.mr_kotcounter= '".$result_menus['kotcod']."'  order by bd.tab_slno DESC ";
                                     
                         }else if($_SESSION['s_kod_dinein']=='Y' && ($_REQUEST['set'])=='dine')
			 {
				  $sql_menulist1="select tor.ter_count_combo_ordering,tor.ter_unit_weight as unit_weight,tor.ter_rate_type,tor.ter_unit_type as unit_type,um.u_name,bum.bu_name,sum(tor.ter_qty) as qty,tor.ter_orderno,tor.ter_slno as slno,sum(tor.ter_qty) as qty,mi.mes_imagethumb as image,tor.ter_preference as per1,tor.ter_preferencetext as per2,tmr.mr_menuname as menuname,tmr.mr_menuid,tpr.pm_portionshortcode as portion,tor.ter_status as status from tbl_tableorder as tor LEFT JOIN tbl_menumaster as tmr ON tor.ter_menuid=tmr.mr_menuid LEFT JOIN  tbl_portionmaster as tpr ON tpr.pm_id=tor.ter_portion left join tbl_unit_master um on um.u_id=tor.ter_unit_id left join tbl_base_unit_master bum on bum.bu_id=tor.ter_base_unit_id LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tmr.mr_menuid  where $conditionstring1_dn   tor.ter_kotno='".$result_menus11['kotno']."'  and tor.ter_dayclosedate='".$_SESSION['date']."' AND   tmr.mr_kotcounter= '".$result_menus11['kotcod']."' and tmr.mr_show_in_kod='Y' group by ter_menuid,ter_portion,ter_unit_id,ter_base_unit_id,ter_unit_weight  order by ter_slno,ter_count_combo_ordering ASC ";
			 }
                         //echo $sql_menulist1;
	$sql_menus1  =  $database->mysqlQuery($sql_menulist1); 
	$num_menus1  = $database->mysqlNumRows($sql_menus1);
	if($num_menus1){$i=0;$pref='';$unit='';$combo_ordering_count=array();
                                $combo_pack_rate=0;
                                $combo_menu_qty=0;
                                $combo_qty=0;
		while($result_menus1  = $database->mysqlFetchArray($sql_menus1)) 
			{$a='a';
                         if($result_menus1['unit_type']=='Packet'){$unit= number_format($result_menus1['unit_weight'],$_SESSION['be_decimal']).' '.$result_menus1['u_name'];  } else if($result_menus1['unit_type']=='Loose'){ $unit= number_format($result_menus1['unit_weight'],$_SESSION['be_decimal']).' '.$result_menus1['bu_name']; }       
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
                        
                        
                        
				 if($_SESSION['s_kod_takeaway']=='Y'  && ($_REQUEST['set'])=='ta')
			 	{       
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
                                     
                                     
                                     $sql_menulist2="select (SUM(CI.tc_cancel_qty)+'".$result_menus1['qty']."') AS oldqty,tc_combo_pack_cancelled_qty as combo_cancelled  FROM tbl_takeaway_cancel_items CI where CI.tc_billno ='".$result_menus11['blno']."' and CI.tc_bill_slno='".$result_menus1['tab_slno']."'  GROUP BY CI.tc_billno, CI.tc_bill_slno";
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
			   }else  if($_SESSION['s_kod_dinein']=='Y'  && ($_REQUEST['set'])=='dine')
			   {
                               
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
                               
                               
                               
                               $sql_menulist2="SELECT (sum(ch_cancelled_qty)+'".$result_menus1['qty']."') as oldqty,ch_combo_pack_cancelled_qty as combo_cancelled from tbl_tableorder_changes WHERE ch_orderno='".$result_menus1['ter_orderno']."' and ch_kotno='".$result_menus11['kotno']."' and ch_orderslno='".$result_menus1['slno']."' group  by ch_orderno,ch_orderslno";
				//echo "SELECT (sum(ch_cancelled_qty)+'".$result_menus1['qty']."') as oldqty from tbl_tableorder_changes WHERE ch_orderno='".$result_menus1['ter_orderno']."' and ch_kotno='".$result_menus['kotno']."' and ch_orderslno='".$result_menus1['slno']."' group  by ch_orderno,ch_orderslno";
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
				
			   }
//                                                                
				
				
					
					?>
<!--                    <input type="hidden" id="cancelcolor<?=$i?>" value="<?=$a?>">-->
                    <div class="kod_list_item">
                        <?php if($imagepermission=='Y'){ ?>
                        <div class="kod_dish_image"><img src="<?=$result_menus1['image']?>"></div><?php } else { }
                        if($combo_ordering_count_each && !in_array($combo_ordering_count_each,$combo_ordering_count)){
                           $combo_ordering_count[]=$combo_ordering_count_each;
                        ?>
                        <p class="combo_sec_kod"><?=$combo_name?></p><br>
                        <?php }else{
                           $combo_name='';
                        }
                        ?>
                        <h1><?php if($a=='b'){?><strike style="color:red"><?php }?><span><?php if($combo_qty>0){ if($a=='a'){ echo $combo_qty.'*'; echo $combo_menu_qty;} else { echo $combo_qty+$result_menus2['combo_cancelled'].'*'; echo $combo_menu_qty;}} else{ if($a=='a'){ echo $result_menus1['qty'];} else { echo $result_menus2['oldqty'];} }?></span> <span><?php if($result_menus1['portion']!=''){ echo '('.$result_menus1['portion'].')';} else { echo '('.$unit.')'; }?></span> * <span><?=$menu_name?></span><?php if($a=='b'){ ?></strike><?php }?>
                     	<div class="kod_order_status">
                        <?php  if($_SESSION['s_kod_takeaway']=='Y'  && ($_REQUEST['set'])=='ta') { ?>
			<?php if($result_menus1['status']=='Ready'){ ?><img src="img/served-icon-1.png"> <?php } if($result_menus1['status']=='Generated'){ ?><img src="img/pending-icon.png"> <?php } if($result_menus1['status']=='Processing'){ ?><img src="img/process-ico.png"> <?php } ?>
                        <?php }else if($_SESSION['s_kod_dinein']=='Y'  && ($_REQUEST['set'])=='dine') { ?>
                        <?php if($result_menus1['status']=='Ready'){ ?><img src="img/served-icon-1.png"> <?php } if($result_menus1['status']=='Added'){ ?><img src="img/pending-icon.png"> <?php } if($result_menus1['status']=='Opened'&& $result_menus1['qty']!=0){ ?><img src="img/process-ico.png"> <?php } ?>
                        <?php } ?>
                        </div>
                          <?php if($combo_qty>0 && $a=='b'){ ?> <p style="font-size:20px;font-weight:bold;"><span><?=$combo_qty.'*'. $combo_menu_qty ?><?php if($result_menus1['portion']!=''){ echo '('.$result_menus1['portion'].')';}?></span>* <span><?=$menu_name?></span></p><?php } else if($a=='b' && $result_menus1['qty']!=0){?> <p style="font-size:20px;font-weight:bold;"><span><?=$result_menus1['qty']?></span> <span><?php if($result_menus1['portion']!=''){ echo '('.$result_menus1['portion'].')';} else {echo '('.$unit.')';}?></span> * <span><?=$menu_name?></span></p><?php }?>
                         <p style=""><?=$pref?></p>
                     </h1>
                      
                    </div>
                
                    <?php } }
                         
                         ?>
                       </div>   
                      <?php
                         
                         }}
                         ?>
                      



                      <?php
                    }
                      ?>
                      
                      
                  
                      
      <?php   if($value!="ALL" && count($counters)==1){ ?>
      </div>
    <?php } ?>             
                  
                    
             
               
<?php
 } }  
 
 
 
}  } ?>
 <?php
                $sql_kod_sound  =  $database->mysqlQuery("select be_kod_sound from tbl_branchmaster"); 
		$num_kod_sound  = $database->mysqlNumRows($sql_kod_sound);
		if($num_kod_sound){
                   while( $result_kod_sound  = $database->mysqlFetchArray($sql_kod_sound)){
                   $kod_sound=$result_kod_sound['be_kod_sound'];
                   } 
                }
               ?>
                <input type="hidden" id="kod_sound" value="<?=$kod_sound?>">
                <input type="hidden" id="noofkots" value="<?=$noofkot?>">
       
   <div>
  <audio id="chatAudio"><source src="notify12.ogg" type="audio/ogg"></audio>
  <!--<source src="../notify.mp3" type="audio/mpeg"><source src="../notify.wav" type="audio/wav">-->
 </div>  
                <script type="text/javascript">
        $(document).ready(function(){
	//alert("dlgjds");
        var previouscount=$('#noofkots').val();
        //alert(previouscount);
        var currentcount=$('.pin').length;
        //alert(currentcount);
        var kodsound=$('#kod_sound').val();
        //alert(kodsound);
        if(kodsound=='Y')
        {
        if(previouscount<currentcount)
        { 
           
         $('#chatAudio')[0].play();
        }
    }               
    });
                    </script>
<!--<script src="js/jquery-1.10.2.min.js"></script> 
<script src="js/kod_screen.js"></script>   -->