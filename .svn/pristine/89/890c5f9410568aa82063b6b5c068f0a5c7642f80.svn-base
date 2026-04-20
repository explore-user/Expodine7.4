<?php
//include('includes/session.php');		// Check session
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
//include('includes/master_settings.php');

if(isset($_REQUEST['date']))
{    
    
    
    $popuparray=array();

    if($_REQUEST['mode']=="ta")
    { 
        $sql_menulist1= " Select tp.pm_portionshortcode as por, NULL as combo_entry,tbl_takeaway_billdetails.tab_bill_addon_slno as addon_slno,"
                . " tbl_takeaway_billdetails.tab_qty as qty,mi.mes_imagethumb as image,tbl_takeaway_billdetails.tab_preferencetext as pref,"
                . " tbl_takeaway_billdetails.tab_slno as slno,tbl_menumaster.mr_menuname as menuname,tbl_menumaster.mr_menuid as menuid, "
                . " tbl_takeaway_billdetails.tab_status  as status  From tbl_menumaster left Join tbl_takeaway_billdetails On "
                . " tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid  LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tbl_menumaster.mr_menuid"
                . " left join tbl_portionmaster tp on tp.pm_id=tbl_takeaway_billdetails.tab_portion Where "
                . " tbl_takeaway_billdetails.tab_kotno_new = '".$_REQUEST['kotno']."' and  tbl_takeaway_billdetails.tab_billno = '".$_REQUEST['billno']."' "
                . " AND (tbl_takeaway_billdetails.tab_status='KOT_Generated' OR tbl_takeaway_billdetails.tab_status='Ready' OR "
                . " tbl_takeaway_billdetails.tab_status='Processing')  AND   tbl_menumaster.mr_kotcounter= '".$_REQUEST['kitchen']."' and "
                . " tbl_menumaster.mr_show_in_kod='Y' group by tbl_takeaway_billdetails.tab_menuid,tbl_takeaway_billdetails.tab_portion,"
                . " tbl_takeaway_billdetails.tab_unit_weight,tbl_takeaway_billdetails.tab_unit_id,tbl_takeaway_billdetails.tab_base_unit_id,"
                . " tbl_takeaway_billdetails.tab_bill_addon_slno  order by tab_slno ASC ";
       
        $sql_menus1  =  $database->mysqlQuery($sql_menulist1); 
        $num_menus1  = $database->mysqlNumRows($sql_menus1);
        if($num_menus1){$i=1;$pref='';
                while($result_menus1  = $database->mysqlFetchArray($sql_menus1)) 
                        {
                          $popuparray[] = $result_menus1;
                        }
                }
                
         echo json_encode($popuparray).'+'.$num_menus1.'+';       
         
    }
    else if($_REQUEST['mode']=="dine")
    {  
           $sql_menulist1="select  tp.pm_portionshortcode as por,mi.mes_imagethumb as image,tor.ter_addon_slno as addon_slno, tor.ter_count_combo_ordering,"
                . " tor.ter_combo_entry_id as combo_entry,tor.ter_orderno,tor.ter_slno as slno,tor.ter_qty as qty,tor.ter_preference as per1,"
                . " tor.ter_preferencetext as per2,tmr.mr_menuname as menuname,tmr.mr_menuid as menuid,tmr.mr_time_min as menutime,ter_status as status "
                . " from tbl_tableorder as tor LEFT JOIN tbl_menumaster as tmr ON tor.ter_menuid=tmr.mr_menuid LEFT JOIN tbl_menuimages mi on"
                . " mi.mes_menuid=tmr.mr_menuid left join tbl_portionmaster tp on tp.pm_id=tor.ter_portion  where  tor.ter_kotno='".$_REQUEST['kotno']."'"
                . " and tor.ter_dayclosedate='".$_REQUEST['date']."'  AND   tmr.mr_kotcounter= '".$_REQUEST['kitchen']."' and tmr.mr_show_in_kod='Y' and "
                . " tor.ter_qty <>0 order by ter_slno ASC ";
       
      $sql_menus1  =  $database->mysqlQuery($sql_menulist1); 
      $num_menus1  = $database->mysqlNumRows($sql_menus1);
      if($num_menus1){$i=1;$pref='';
              while($result_menus1  = $database->mysqlFetchArray($sql_menus1)) 
                      {
                           $popuparray[] = $result_menus1;
                      }
              } 
              
        echo json_encode($popuparray).'+'.$num_menus1.'+';      
    }
    else if($_REQUEST['mode']=="")
    {   
        $sql_menulist1= " Select tp.pm_portionshortcode as por, NULL as combo_entry,tbl_takeaway_billdetails.tab_bill_addon_slno as addon_slno,"
                . " tbl_takeaway_billdetails.tab_qty as qty,mi.mes_imagethumb as image,tbl_takeaway_billdetails.tab_preferencetext as pref,"
                . " tbl_takeaway_billdetails.tab_slno as slno,tbl_menumaster.mr_menuname as menuname,tbl_menumaster.mr_menuid as menuid, "
                . " tbl_takeaway_billdetails.tab_status  as status  From tbl_menumaster left Join tbl_takeaway_billdetails On "
                . " tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid  LEFT JOIN tbl_menuimages mi on mi.mes_menuid=tbl_menumaster.mr_menuid"
                . " left join tbl_portionmaster tp on tp.pm_id=tbl_takeaway_billdetails.tab_portion Where "
                . " tbl_takeaway_billdetails.tab_kotno_new = '".$_REQUEST['kotno']."' and tbl_takeaway_billdetails.tab_billno = '".$_REQUEST['billno']."'"
                . " AND (tbl_takeaway_billdetails.tab_status='KOT_Generated' OR tbl_takeaway_billdetails.tab_status='Ready' OR "
                . " tbl_takeaway_billdetails.tab_status='Processing')  AND   tbl_menumaster.mr_kotcounter= '".$_REQUEST['kitchen']."' and "
                . " tbl_menumaster.mr_show_in_kod='Y' group by tbl_takeaway_billdetails.tab_menuid,tbl_takeaway_billdetails.tab_portion,"
                . " tbl_takeaway_billdetails.tab_unit_weight,tbl_takeaway_billdetails.tab_unit_id,tbl_takeaway_billdetails.tab_base_unit_id,"
                . " tbl_takeaway_billdetails.tab_bill_addon_slno  order by tab_slno ASC ";
        
        $sql_menus1  =  $database->mysqlQuery($sql_menulist1); 
        $num_menus1  = $database->mysqlNumRows($sql_menus1);
        if($num_menus1){$i=1;$pref='';
            while($result_menus1  = $database->mysqlFetchArray($sql_menus1)) 
            {
                $popuparray[] = $result_menus1;
            }
        }
       
        $sql_menulist2="select tp.pm_portionshortcode as por,mi.mes_imagethumb as image,tor.ter_addon_slno as addon_slno,tor.ter_count_combo_ordering,"
                . " tor.ter_combo_entry_id as combo_entry,tor.ter_orderno,tor.ter_slno as slno,tor.ter_qty as qty,tor.ter_preference as per1,"
                . " tor.ter_preferencetext as per2,tmr.mr_menuname as menuname,tmr.mr_menuid as menuid,tmr.mr_time_min as menutime,ter_status as status "
                . " from tbl_tableorder as tor LEFT JOIN tbl_menumaster as tmr ON tor.ter_menuid=tmr.mr_menuid LEFT JOIN tbl_menuimages mi on"
                . " mi.mes_menuid=tmr.mr_menuid  left join tbl_portionmaster tp on tp.pm_id=tor.ter_portion where  tor.ter_kotno='".$_REQUEST['kotno']."'"
                . " and tor.ter_dayclosedate='".$_REQUEST['date']."'  AND   tmr.mr_kotcounter= '".$_REQUEST['kitchen']."' and tmr.mr_show_in_kod='Y'"
                . " and tor.ter_qty <>0 order by ter_slno ASC ";
        
        $sql_menus2  =  $database->mysqlQuery($sql_menulist2); 
        $num_menus2  = $database->mysqlNumRows($sql_menus2);
        if($num_menus2){$i=1;$pref='';
            while($result_menus2  = $database->mysqlFetchArray($sql_menus2)) 
            {
                    $popuparray[] = $result_menus2;
            }
                    
        }
        
        if($num_menus1==0){
            $num_menus1 =$num_menus2;
        }
        
        echo json_encode($popuparray).'+'.$num_menus1.'+';
    }    
    
}

if(isset($_REQUEST['kotnumber']))
{
 //echo 'ok';
    $kotnumber=$_REQUEST['kotnumber'];
    $billnumber=$_REQUEST['billno'];
    $menuid=$_REQUEST['menuid'];
    $menu1=explode(',',$menuid);
    $status=$_REQUEST['status1'];
    $status1=explode(',',$status);
    $slno=$_REQUEST['slno'];
    $slno1=explode(',',$slno);
    $combo_entry=explode(',',$_REQUEST['combo_entry']);
    //echo $status1;
    for($i=0;$i<=count($menu1);$i++)
    {
      if($billnumber=="" && $status1[$i]=="Opened"){
      $sql_menuspopupready  =  $database->mysqlQuery("update tbl_tableorder set ter_status='Ready' where ter_menuid='".$menu1[$i]."'  and ter_kotno='".$kotnumber."' and ter_slno='".$slno1[$i]."' and ter_dayclosedate='".$_SESSION['date']."' ");  
    //echo "update tbl_tableorder set ter_status='Ready' where ter_menuid='".$menu1[$i]."'  and ter_kotno='".$kotnumber."' and ter_slno='".$slno1[$i]."' and ter_dayclosedate='".$_SESSION['date']."' ";
      if($combo_entry[$i]){
          $sql_combo_menuspopupready  =  $database->mysqlQuery("UPDATE `tbl_combo_ordering_details` SET `cod_order_status`='Ready' where `cod_id`='".$combo_entry[$i]."'");
      }
      }
    else if($billnumber!=""&& $status1[$i]=="Processing"){
      $sql_menuspopuppacked  =  $database->mysqlQuery("update tbl_takeaway_billdetails set tab_status='Ready' where tab_menuid='".$menu1[$i]."' and tab_slno='".$slno1[$i]."'  and  tab_billno='".$billnumber."'"); 
      //echo "update tbl_takeaway_billdetails set tab_status='Packed' where tab_menuid='".$menu11[$i]."' and  tab_billno='".$billnumber1."'";
        $sql_menuspopuppacked  =  $database->mysqlQuery("update tbl_combo_bill_details_ta set cbd_order_status='Ready' where cbd_billno='".$billnumber."' and cbd_menu_id='".$menu1[$i]."' and 
                                                    cbd_count_combo_ordering =( select tbd.tab_count_combo_ordering  FROM tbl_takeaway_billdetails tbd where tbd.tab_billno='".$billnumber."' and tbd.tab_slno='".$slno1[$i]."' and  tbd.tab_menuid='".$menu1[$i]."') ");
//      echo "update tbl_combo_bill_details_ta set cbd_order_status='Ready' where cbd_billno='".$billnumber."' and cbd_menu_id='".$menu1[$i]."' and 
//                                                    cbd_count_combo_ordering =( select tbd.tab_count_combo_ordering  FROM tbl_takeaway_billdetails tbd where tbd.tab_billno='".$billnumber."' and tbd.tab_slno='".$slno1[$i]."' and  tbd.tab_menuid='".$menu1[$i]."')";
    }

}
}


if(isset($_REQUEST['kotnumber1']))
{
 //echo 'ok';
    $kotnumber1=$_REQUEST['kotnumber1'];
    $billnumber1=$_REQUEST['billno1'];
    $menuid1=$_REQUEST['menuid1'];
    $menu11=explode(',',$menuid1);
    $status=$_REQUEST['status'];
    $status1=explode(',',$status);
    $slno=$_REQUEST['slno'];
    $slno1=explode(',',$slno);
    $combo_entry=explode(',',$_REQUEST['combo_entry']);
    for($i=0;$i<=count($menu11);$i++)
    {
      if($billnumber1==""){
      $sql_menuspopupserved  =  $database->mysqlQuery("update tbl_tableorder set ter_status='Served' where ter_menuid='".$menu11[$i]."'  and ter_kotno='".$kotnumber1."' and ter_slno='".$slno1[$i]."' and ter_dayclosedate='".$_SESSION['date']."' ");  
      if($combo_entry[$i]){
          $sql_combo_menuspopupserved  =  $database->mysqlQuery("UPDATE `tbl_combo_ordering_details` SET `cod_order_status`='Served' where `cod_id`='".$combo_entry[$i]."'");
          //echo "UPDATE `tbl_combo_ordering_details` SET `cod_order_status`='Served' where `cod_id`='".$combo_entry[$i]."'";
          
      }
      
    }
    
    else if($billnumber1!=""){
      $sql_menuspopuppacked  =  $database->mysqlQuery("update tbl_takeaway_billdetails set tab_status='Packed' where tab_menuid='".$menu11[$i]."' and tab_slno='".$slno1[$i]."'  and  tab_billno='".$billnumber1."'"); 
      //echo "update tbl_takeaway_billdetails set tab_status='Packed' where tab_menuid='".$menu11[$i]."' and  tab_billno='".$billnumber1."'";
      $sql_menuspopuppacked  =  $database->mysqlQuery("update tbl_combo_bill_details_ta set cbd_order_status='Packed' where cbd_billno='".$billnumber1."' and cbd_menu_id='".$menu11[$i]."' and 
                                                    cbd_count_combo_ordering =( select tbd.tab_count_combo_ordering  FROM tbl_takeaway_billdetails tbd where tbd.tab_billno='".$billnumber1."' and tbd.tab_slno='".$slno1[$i]."' and  tbd.tab_menuid='".$menu11[$i]."') ");
                                                    
//        echo "update tbl_combo_bill_details_ta set cbd_order_status='Packed' where cbd_billno='".$billnumber1."' and cbd_menu_id='".$menu11[$i]."' and 
//               cbd_count_combo_ordering =( select tbd.tab_count_combo_ordering  FROM tbl_takeaway_billdetails tbd where tbd.tab_billno='".$billnumber1."' and tbd.tab_slno='".$slno1[$i]."' and  tbd.tab_menuid='".$menu11[$i]."')";
    }

}
}
   ?>

