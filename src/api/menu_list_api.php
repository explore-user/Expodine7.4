
<?php
include("..\database.class.php"); // DB Connection class
$database = new Database();
session_start(); 

if(isset($_REQUEST['type']) && $_REQUEST['type']=='menulist' ){
    $menu_id=array();
    $menu_all=array();
    $kitchen=array();
    $baseunit='';
    $sql_menu_list = $database->mysqlQuery("select  mmy_maincategoryname,inv_kitchen,menu_barcode,menutype,kitchenid,kitchen,menuid,menuname,ratetype,portionid, portionname,unittype,unitweight,unitid,unitname,baseunitid,baseunitname from
                            ( select mmc.mmy_maincategoryname,mm.mr_inventory_kitchen as inv_kitchen,mrm.mmr_barcode as menu_barcode ,mm.mr_product_type as menutype,mm.mr_kotcounter as kitchenid,km.kr_kotname as kitchen,mm.mr_menuid as menuid, mm.mr_menuname as menuname,mrm.mmr_rate_type as ratetype,mrm.mmr_portion as portionid, 
                            pm.pm_portionname as portionname,mrm.mmr_unit_type as unittype,mrm.mmr_unit_weight as  unitweight,mrm.mmr_unit_id as unitid,
                            um.u_name as unitname, mrm.mmr_base_unit_id as baseunitid,bum.bu_name as baseunitname
                            FROM tbl_menumaster mm
                            left join tbl_menuratemaster mrm on mrm.mmr_menuid =mm.mr_menuid
                            left join tbl_portionmaster pm on pm.pm_id=mrm.mmr_portion
                            left join tbl_unit_master um on um.u_id = mrm.mmr_unit_id
                            left join tbl_kotcountermaster km on km.kr_kotcode = mm.mr_kotcounter
                            left join tbl_base_unit_master bum on bum.bu_id = mrm.mmr_base_unit_id 
							left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid=mm.mr_maincatid
                            
                            union all 

                            select mmc.mmy_maincategoryname,mm.mr_inventory_kitchen as inv_kitchen,mta.mta_barcode as menu_barcode ,mm.mr_product_type as menutype,mm.mr_kotcounter as kitchenid,km.kr_kotname as kitchen,mm.mr_menuid as menuid,mm.mr_menuname as menuname,mta.mta_rate_type as ratetype,mta.mta_portion as portionid,
                            pm.pm_portionname as portionname,mta.mta_unit_type as unittype,mta.mta_unit_weight as  unitweight,mta.mta_unit_id as unitid,
                            um.u_name as unitname, mta.mta_base_unit_id as baseunitid,bum.bu_name as baseunitname
                            FROM tbl_menumaster mm
                            left join 	tbl_menuratetakeaway mta on mta.mta_menuid =mm.mr_menuid
                            left join tbl_portionmaster pm on pm.pm_id=mta.mta_portion
                            left join tbl_unit_master um on um.u_id = mta.mta_unit_id
                            left join tbl_kotcountermaster km on km.kr_kotcode = mm.mr_kotcounter
                            left join tbl_base_unit_master bum on bum.bu_id = mta.mta_base_unit_id 
                            left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid=mm.mr_maincatid
							
                            union all

                            select mmc.mmy_maincategoryname,mm.mr_inventory_kitchen as inv_kitchen,mrc.mrc_barcode as menu_barcode ,mm.mr_product_type as menutype,mm.mr_kotcounter as kitchenid,km.kr_kotname as kitchen, mm.mr_menuid as menuid,mm.mr_menuname as menuname,mrc.mrc_rate_type as ratetype,mrc.mrc_portion as portionid, 
                            pm.pm_portionname as portionname,mrc.mrc_unit_type as unittype,mrc.mrc_unit_weight as  unitweight,mrc.mrc_unit_id as unitid,
                            um.u_name as unitname, mrc.mrc_base_unit_id as baseunitid,bum.bu_name as baseunitname
                            FROM tbl_menumaster mm
                            left join tbl_menurate_counter mrc on mrc.mrc_menuid =mm.mr_menuid
                            left join tbl_portionmaster pm on pm.pm_id=mrc.mrc_portion
                            left join tbl_unit_master um on um.u_id = mrc.mrc_unit_id
                            left join tbl_kotcountermaster km on km.kr_kotcode = mm.mr_kotcounter
                            left join tbl_base_unit_master bum on bum.bu_id = mrc.mrc_base_unit_id 
                            left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid=mm.mr_maincatid
							
                            )x group by menuid, portionid,unitid,baseunitid,unitweight   order by menuid");
    $num_menu_list = $database->mysqlNumRows($sql_menu_list);
    if($num_menu_list){ $j = 0;$unittype='';
        while ($result_menu_list = $database->mysqlFetchArray($sql_menu_list)) {
            $baseunit='';
            if($result_menu_list['ratetype']=='Portion'){
                    $unittype=$result_menu_list['ratetype'];
                }
                else{
                    $unittype=$result_menu_list['unittype'];
                }
            if (!in_array($result_menu_list['menuid'].'='.$result_menu_list['menuname'].'='.$unittype, $menu_id)) {
                $menu_id[]=$result_menu_list['menuid'].'='.$result_menu_list['menuname'].'='.$unittype.'='.$result_menu_list['menutype'].'='.$result_menu_list['inv_kitchen'].'='.$result_menu_list['mmy_maincategoryname'].'='.$result_menu_list['menu_barcode'];
            }
            
            if (!in_array($result_menu_list['kitchenid'].'='.$result_menu_list['kitchen'],$kitchen)) {
                $kitchen[]=$result_menu_list['kitchenid'].'='.$result_menu_list['kitchen'];
            }
            
            
            
            if($unittype=='Packet'){
            $sql_menu_baseunit = $database->mysqlQuery("select bu_name from tbl_base_unit_master um left join tbl_menumaster mm on mm.mr_base_unit=um.bu_id where mr_menuid='".$result_menu_list['menuid']."'");
            //echo "select bu_name from tbl_base_unit_master um left join tbl_menumaster mm on mm.mr_base_unit=um.bu_id where mr_menuid='".$result_menu_sales['menuid']."'";
            $num_menu_baseunit = $database->mysqlNumRows($sql_menu_baseunit);
                if($num_menu_baseunit){ 
                    while ($result_menu_baseunit = $database->mysqlFetchArray($sql_menu_baseunit)) {
                       $baseunit= $result_menu_baseunit['bu_name'];
                    }
                }
            }
            $menu_all[$result_menu_list['menuid']]['barcode'][]=$result_menu_list['menu_barcode'];
            $menu_all[$result_menu_list['menuid']]['portion'][]=$result_menu_list['portionname'];
            $menu_all[$result_menu_list['menuid']]['unitname'][]=$result_menu_list['unitname'];
            if($unittype=='Packet'){
                $menu_all[$result_menu_list['menuid']]['baseunitname'][]=$baseunit;
            }
            else{
                $menu_all[$result_menu_list['menuid']]['baseunitname'][]=$result_menu_list['baseunitname'];
            }
            $menu_all[$result_menu_list['menuid']]['unitweight'][]=$result_menu_list['unitweight'];
            $menu_all[$result_menu_list['menuid']]['kotcounter'][]=$result_menu_list['kitchenid'];
            $menu_all[$result_menu_list['menuid']]['inv_kitchen'][]=$result_menu_list['inv_kitchen'];

        }
    }


   $inv_kitchen=array();
    
    $sql_kitchen_flr = $database->mysqlQuery("select * from tbl_inv_kitchen where ti_status='Y' ");
    $num_kitchen_flr = $database->mysqlNumRows($sql_kitchen_flr);
    if($num_kitchen_flr){ 
        while ($result_kitchen_flr = $database->mysqlFetchArray($sql_kitchen_flr)) {
            
            $inv_kitchen[]   =$result_kitchen_flr['ti_id'].'='.$result_kitchen_flr['ti_name'];
           
           
            
        }
   }
  

    
    echo json_encode(['menu_id'=>$menu_id,'menudetails'=>$menu_all,'kitchen'=>$kitchen,'inv_kitchen'=>$inv_kitchen]) ;
    
            }
else if(isset($_REQUEST['type']) && $_REQUEST['type']=='menusales' ){
    $menu_id=array();
    $menu_all=array();
    $category=array();
    $year_string='';
    $year_stringta='';
    $string='';
    $baseunit='';
    if(isset($_REQUEST['fromyear'])&& $_REQUEST['fromyear']!=''){
        $string.=",x.year1 ";
       if(isset($_REQUEST['toyear']) && $_REQUEST['toyear']!=''){
            $year_string.= " where YEAR(bm.bm_dayclosedate) between '".$_REQUEST['fromyear']."' and '".$_REQUEST['toyear']."' ";
            $year_stringta.= " where YEAR(tbm.tab_dayclosedate) between '".$_REQUEST['fromyear']."' and '".$_REQUEST['toyear']."' "; 
        }
        else{
           $year_string.= " where YEAR(bm.bm_dayclosedate) = '".$_REQUEST['fromyear']."' ";
           $year_stringta.= " where YEAR(tbm.tab_dayclosedate) = '".$_REQUEST['fromyear']."' ";  
        }
        if(isset($_REQUEST['month']) && $_REQUEST['month']!=''){ 
             $string.=",x.month1 ";
           $year_string.= " and MONTH(bm.bm_dayclosedate) IN(".$_REQUEST['month'].")" ;
           $year_stringta.= " and MONTH(tbm.tab_dayclosedate) IN(". $_REQUEST['month'].")" ; 
        }
    }
    if(isset($_REQUEST['fromdate']) && $_REQUEST['fromdate']!=''){
        $string.=",x.date1 ";
        
        if(isset($_REQUEST['todate']) && $_REQUEST['todate']!=''){
            $year_string.= " where bm.bm_dayclosedate between '".$_REQUEST['fromdate']."' and '".$_REQUEST['todate']."' ";
            $year_stringta.= " where tbm.tab_dayclosedate between '".$_REQUEST['fromdate']."' and '".$_REQUEST['todate']."' "; 
        }
        else{
           $year_string.= " where bm.bm_dayclosedate = '".$_REQUEST['fromdate']."' ";
           $year_stringta.= " where tbm.tab_dayclosedate = '".$_REQUEST['fromdate']."' ";  
        }
    
    }    
    $sales=0;
    $sql_menu_sales = $database->mysqlQuery("select x.year1,x.month1,x.date1,x.menuid,x.menuname,x.catname,x.portion,x.unitname,x.baseunitname,sum(x.qty) as qty,sum(x.sales) as sales,x.ratetype,x.unittype,x.weight from (
                            select YEAR(bm.bm_dayclosedate) as year1, MONTH(bm.bm_dayclosedate) as month1,bm.bm_dayclosedate as date1,mm.mr_menuid as menuid,mm.mr_menuname as menuname,mmc.mmy_maincategoryname as catname, sum(bd.bd_qty) as qty,sum(bd.bd_rate*bd.bd_qty) as sales, bd.bd_rate_type as ratetype,bd.bd_unit_type as unittype,bd.bd_unit_weight as weight, pm.pm_portionname as portion,um.u_name as unitname,bum.bu_name as baseunitname
                            FROM tbl_menumaster mm
                            left join tbl_tablebilldetails bd on bd.bd_menuid = mm.mr_menuid
                            left join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno
                            left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid=mm.mr_maincatid
                            left join tbl_portionmaster pm on pm.pm_id = bd.bd_portion
                            left join tbl_unit_master um on um.u_id=bd.bd_unit_id
                            left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                            $year_string
                            group by pm.pm_id,um.u_id,bum.bu_id,mm.mr_menuid,weight

                            union all

                            select YEAR(tbm.tab_dayclosedate) as year1, MONTH(tbm.tab_dayclosedate) as month1,tbm.tab_dayclosedate as date1,mm.mr_menuid as menuid,mm.mr_menuname as menuname,mmc.mmy_maincategoryname as catname, sum(tbd.tab_qty) as qty,sum(tbd.tab_rate*tbd.tab_qty) as sales, tbd.tab_rate_type as ratetype,tbd.tab_unit_type as unittype,tbd.tab_unit_weight as weight, pm.pm_portionname as portion,um.u_name as unitname,bum.bu_name as baseunitname
                            FROM tbl_menumaster mm
                            left join tbl_takeaway_billdetails tbd on tbd.tab_menuid = mm.mr_menuid
                            left join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
                            left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid=mm.mr_maincatid
                            left join tbl_portionmaster pm on pm.pm_id = tbd.tab_portion
                            left join tbl_unit_master um on um.u_id=tbd.tab_unit_id
                            left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
                            $year_stringta
                            group by pm.pm_id,um.u_id,bum.bu_id,mm.mr_menuid,weight )x group by x.portion,x.unitname,x.baseunitname,x.menuid,x.weight $string order by x.menuid $string asc ");
    
//   echo "select x.year1,x.month1,x.date1,x.menuid,x.menuname,x.catname,x.portion,x.unitname,x.baseunitname,sum(x.qty) as qty,sum(x.sales) as sales,x.ratetype,x.unittype,x.weight from (
//                            select YEAR(bm.bm_dayclosedate) as year1, MONTH(bm.bm_dayclosedate) as month1,bm.bm_dayclosedate as date1,mm.mr_menuid as menuid,mm.mr_menuname as menuname,mmc.mmy_maincategoryname as catname, sum(bd.bd_qty) as qty,sum(bd.bd_rate*bd.bd_qty) as sales, bd.bd_rate_type as ratetype,bd.bd_unit_type as unittype,bd.bd_unit_weight as weight, pm.pm_portionname as portion,um.u_name as unitname,bum.bu_name as baseunitname
//                            FROM tbl_menumaster mm
//                            left join tbl_tablebilldetails bd on bd.bd_menuid = mm.mr_menuid
//                            left join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno
//                            left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid=mm.mr_maincatid
//                            left join tbl_portionmaster pm on pm.pm_id = bd.bd_portion
//                            left join tbl_unit_master um on um.u_id=bd.bd_unit_id
//                            left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
//                            $year_string
//                            group by pm.pm_id,um.u_id,bum.bu_id,mm.mr_menuid,weight
//
//                            union all
//
//                            select YEAR(tbm.tab_dayclosedate) as year1, MONTH(tbm.tab_dayclosedate) as month1,tbm.tab_dayclosedate as date1,mm.mr_menuid as menuid,mm.mr_menuname as menuname,mmc.mmy_maincategoryname as catname, sum(tbd.tab_qty) as qty,sum(tbd.tab_rate*tbd.tab_qty) as sales, tbd.tab_rate_type as ratetype,tbd.tab_unit_type as unittype,tbd.tab_unit_weight as weight, pm.pm_portionname as portion,um.u_name as unitname,bum.bu_name as baseunitname
//                            FROM tbl_menumaster mm
//                            left join tbl_takeaway_billdetails tbd on tbd.tab_menuid = mm.mr_menuid
//                            left join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
//                            left join tbl_menumaincategory mmc on mmc.mmy_maincategoryid=mm.mr_maincatid
//                            left join tbl_portionmaster pm on pm.pm_id = tbd.tab_portion
//                            left join tbl_unit_master um on um.u_id=tbd.tab_unit_id
//                            left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
//                            $year_stringta
//                            group by pm.pm_id,um.u_id,bum.bu_id,mm.mr_menuid,weight )x group by x.portion,x.unitname,x.baseunitname,x.menuid,x.weight $string order by x.menuid $string asc ";
    
    
    $num_menu_sales = $database->mysqlNumRows($sql_menu_sales);
    if($num_menu_sales){ 
        while ($result_menu_sales = $database->mysqlFetchArray($sql_menu_sales)) {
            $baseunit='';
            if($result_menu_sales['ratetype']=='Portion'){
                    $unittype=$result_menu_sales['ratetype'];
                }
                else{
                    $unittype=$result_menu_sales['unittype'];
                }
            if (!in_array($result_menu_sales['menuid'].'='.$result_menu_sales['menuname'].'='.$unittype, $menu_id)) {
                $menu_id[]=$result_menu_sales['menuid'].'='.$result_menu_sales['menuname'].'='.$unittype;
            }
            if($unittype=='Packet'){
            $sql_menu_baseunit = $database->mysqlQuery("select bu_name from tbl_base_unit_master um left join tbl_menumaster mm on mm.mr_base_unit=um.bu_id where mr_menuid='".$result_menu_sales['menuid']."'");
            //echo "select bu_name from tbl_base_unit_master um left join tbl_menumaster mm on mm.mr_base_unit=um.bu_id where mr_menuid='".$result_menu_sales['menuid']."'";
            $num_menu_baseunit = $database->mysqlNumRows($sql_menu_baseunit);
                if($num_menu_baseunit){ 
                    while ($result_menu_baseunit = $database->mysqlFetchArray($sql_menu_baseunit)) {
                       $baseunit= $result_menu_baseunit['bu_name'];
                    }
                }
            }
            
            $menu_all[$result_menu_sales['menuid']]['category'][]=$result_menu_sales['catname'];
            $menu_all[$result_menu_sales['menuid']]['portion'][]=$result_menu_sales['portion'];
            $menu_all[$result_menu_sales['menuid']]['unitname'][]=$result_menu_sales['unitname'];
            if($unittype=='Packet'){
                $menu_all[$result_menu_sales['menuid']]['baseunitname'][]=$baseunit;
            }
            else{
                $menu_all[$result_menu_sales['menuid']]['baseunitname'][]=$result_menu_sales['baseunitname'];
            }
            $menu_all[$result_menu_sales['menuid']]['qty'][]=$result_menu_sales['qty'];
            $menu_all[$result_menu_sales['menuid']]['sales'][]=$result_menu_sales['sales'];
            $menu_all[$result_menu_sales['menuid']]['weight'][]=$result_menu_sales['weight'];
           
            
        }
    }
    $sql_menu_categroy = $database->mysqlQuery("select mmc.mmy_maincategoryid,mmc.mmy_maincategoryname from tbl_menumaincategory mmc where mmc.mmy_active='Y'");
    $num_menu_categroy = $database->mysqlNumRows($sql_menu_categroy);
    if($num_menu_categroy){ 
        while ($result_menu_category = $database->mysqlFetchArray($sql_menu_categroy)) {
           $category[]= $result_menu_category['mmy_maincategoryid'].'='.$result_menu_category['mmy_maincategoryname'];
        }
    }
    echo json_encode(['category'=>$category,'menu_id'=>$menu_id,'menudetails'=>$menu_all]) ;
    
            }            

else if(isset($_REQUEST['type']) && $_REQUEST['type']=='sales'){
    
    $year_string='';
    $year_stringta='';
    $string='';
    
    
    if(isset($_REQUEST['fromyear'])&& $_REQUEST['fromyear']!=''){
        $string.=" x.year1 ";
       if(isset($_REQUEST['toyear']) && $_REQUEST['toyear']!=''){
            $year_string.= " where YEAR(bm.bm_dayclosedate) between '".$_REQUEST['fromyear']."' and '".$_REQUEST['toyear']."' ";
            $year_stringta.= " where YEAR(tbm.tab_dayclosedate) between '".$_REQUEST['fromyear']."' and '".$_REQUEST['toyear']."' "; 
        }
        else{
           $year_string.= " where YEAR(bm.bm_dayclosedate) = '".$_REQUEST['fromyear']."' ";
           $year_stringta.= " where YEAR(tbm.tab_dayclosedate) = '".$_REQUEST['fromyear']."' ";  
        }
        if(isset($_REQUEST['month']) && $_REQUEST['month']!=''){ 
             $string.=",x.month1 ";
            
           $year_string.= " and MONTH(bm.bm_dayclosedate) IN(".$_REQUEST['month'].")" ;
           $year_stringta.= " and MONTH(tbm.tab_dayclosedate) IN(". $_REQUEST['month'].")" ; 
        }
        
    }
    if(isset($_REQUEST['fromdate']) && $_REQUEST['fromdate']!=''){
        $string.=" x.date1 ";
        
        if(isset($_REQUEST['todate']) && $_REQUEST['todate']!=''){
            $year_string.= " where bm.bm_dayclosedate between '".$_REQUEST['fromdate']."' and '".$_REQUEST['todate']."' ";
            $year_stringta.= " where tbm.tab_dayclosedate between '".$_REQUEST['fromdate']."' and '".$_REQUEST['todate']."' "; 
        }
        else{
           $year_string.= " where bm.bm_dayclosedate = '".$_REQUEST['fromdate']."' ";
           $year_stringta.= " where tbm.tab_dayclosedate = '".$_REQUEST['fromdate']."' ";  
        }
    
    }    
    $sales=array();
    $sql_sales = $database->mysqlQuery("select $string,sum(x.sales) as sales,sum(x.tax) as tax from (
                            select YEAR(bm.bm_dayclosedate) as year1, MONTH(bm.bm_dayclosedate) as month1,bm.bm_dayclosedate as date1,sum(bm.bm_finaltotal) as sales,sum(etbm.bem_total_value) as tax
                            FROM tbl_tablebillmaster bm
                            left join tbl_tablebill_extra_tax_master etbm  on etbm.bem_billno = bm.bm_billno 
                            $year_string group by bm.bm_dayclosedate
                            
                            union all

                            select YEAR(tbm.tab_dayclosedate) as year1, MONTH(tbm.tab_dayclosedate) as month1,tbm.tab_dayclosedate as date1,sum(tbm.tab_netamt) as sales,sum(txtm.tbe_total_value) as tax
                            FROM tbl_takeaway_billmaster tbm
                            left join tbl_takeaway_bill_extra_tax_master txtm on txtm.tbe_billno = tbm.tab_billno
                            $year_stringta group by tbm.tab_dayclosedate
                            )x group by $string asc");
    
//echo "select $string,sum(x.sales) as sales,sum(x.tax) as tax from (
//                            select YEAR(bm.bm_dayclosedate) as year1, MONTH(bm.bm_dayclosedate) as month1,bm.bm_dayclosedate as date1,sum(bm.bm_finaltotal) as sales,sum(etbm.bem_total_value) as tax
//                            FROM tbl_tablebillmaster bm
//                            left join tbl_tablebill_extra_tax_master etbm  on etbm.bem_billno = bm.bm_billno 
//                            $year_string 
//                            
//                            union all
//
//                            select YEAR(tbm.tab_dayclosedate) as year1, MONTH(tbm.tab_dayclosedate) as month1,tbm.tab_dayclosedate as date1,sum(tbm.tab_netamt) as sales,sum(txtm.tbe_total_value) as tax
//                            FROM tbl_takeaway_billmaster tbm
//                            left join tbl_takeaway_bill_extra_tax_master txtm on txtm.tbe_billno = tbm.tab_billno
//                            $year_stringta
//                            )x group by $string asc";
    
    $num_sales = $database->mysqlNumRows($sql_sales);
    if($num_sales){ 
        while ($result_sales = $database->mysqlFetchArray($sql_sales)) {
            if($result_sales[0]!=null){
            $sales[]=$result_sales;
            }
            
        }
    }    
    echo json_encode($sales) ;
    
    }
if(isset($_REQUEST['type']) && $_REQUEST['type']=='kitchen_sales'){
    $kitchen=array();
    
    $sql_kitchen_sales = $database->mysqlQuery("select sum(total) as total,kitchen, kitchenid from (
                                                select sum(bd.bd_amount) as total, km.kr_kotname as kitchen,km.kr_kotcode as kitchenid  FROM tbl_tablebilldetails bd 
                                                left join tbl_tablebillmaster bm on bd.bd_billno = bm.bm_billno
                                                left join tbl_menumaster mm on mm.mr_menuid=bd.bd_menuid
                                                left join tbl_kotcountermaster km on km.kr_kotcode = mm.mr_kotcounter
                                                where bm.bm_dayclosedate=(SELECT dc.dc_day  FROM tbl_dayclose dc where dc.dc_dateclose IS NULL) and bm.bm_status='Closed' group by km.kr_kotcode union all

                                                select sum(tbd.tab_amount) as total,km.kr_kotname as kitchen,km.kr_kotcode as kitchenid FROM tbl_takeaway_billdetails tbd
                                                left join tbl_takeaway_billmaster tbm on tbm.tab_billno=tbd.tab_billno
                                                left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid
                                                left join tbl_kotcountermaster km on km.kr_kotcode = mm.mr_kotcounter
                                                where tbm.tab_dayclosedate=( SELECT dc.dc_day  FROM tbl_dayclose dc where dc.dc_dateclose IS NULL) and tbm.tab_status='Closed' group by km.kr_kotcode ) x group by x.kitchenid ");
    $num_kitchen_sales = $database->mysqlNumRows($sql_kitchen_sales);
    if($num_kitchen_sales){ 
        while ($result_kitchen_sales = $database->mysqlFetchArray($sql_kitchen_sales)) {
            
            $kitchen['KITCHEN'][]   =$result_kitchen_sales['kitchen'];
            $kitchen['KITCHEN_ID'][]=$result_kitchen_sales['kitchenid'];
            $kitchen['SALE'][]      =$result_kitchen_sales['total'];
            
        }
   }
   echo json_encode($kitchen) ;
   
}      
if(isset($_REQUEST['type']) && $_REQUEST['type']=='floor_detail'){
    $floor=array();
    
    $sql_kitchen_flr = $database->mysqlQuery("select fr_floorid,fr_floorname from tbl_floormaster where fr_status='Active' ");
    $num_kitchen_flr = $database->mysqlNumRows($sql_kitchen_flr);
    if($num_kitchen_flr){ 
        while ($result_kitchen_flr = $database->mysqlFetchArray($sql_kitchen_flr)) {
            
            $floor['FLOOR_ID'][]   =$result_kitchen_flr['fr_floorid'];
            $floor['FLOOR_NAME'][]=$result_kitchen_flr['fr_floorname'];
           
            
        }
   }
   echo json_encode($floor) ;
   
}       

if(isset($_REQUEST['type']) && $_REQUEST['type']=='menu_rate_all'){
    
    ////////Dine-sale rate///////////
    
    if(isset($_REQUEST['mode']) && $_REQUEST['mode']=='DI'){
        
    $floorid=$_REQUEST['floor_id'];
    $menurate_di=array();
    
    $sql_kitchen_ratedi = $database->mysqlQuery("select tm.mmr_rate,tm.mmr_menuid,tm.mmr_rate_type,tp.pm_portionname,tm.mmr_unit_weight,tu.u_name from tbl_menuratemaster tm left join tbl_unit_master tu on tu.u_id=tm.mmr_unit_id left join tbl_portionmaster tp on tp.pm_id=tm.mmr_portion where tm.mmr_floorid='".$floorid."' ");
    $num_kitchen_ratedi = $database->mysqlNumRows($sql_kitchen_ratedi);
    if($num_kitchen_ratedi){ 
        while ($result_kitchen_ratedi = $database->mysqlFetchArray($sql_kitchen_ratedi)) {
            
            $menurate_di['DI_MENUID'][]=$result_kitchen_ratedi['mmr_menuid'];
            $menurate_di['DI_TYPE'][]=$result_kitchen_ratedi['mmr_rate_type'];
            $menurate_di['DI_PORTION'][]=$result_kitchen_ratedi['pm_portionname'];
            $menurate_di['DI_WEIGHT'][]=$result_kitchen_ratedi['mmr_unit_weight'];
            $menurate_di['DI_UNIT'][]=$result_kitchen_ratedi['u_name'];
            $menurate_di['DI_RATE'][]=$result_kitchen_ratedi['mmr_rate'];
           
            
        }
   }
   echo json_encode($menurate_di) ;
    }
    
    ////////takeaway-sale rate///////////
    
    if(isset($_REQUEST['mode']) && $_REQUEST['mode']=='TA'){
        
    $menurate_ta=array();
    
    $sql_kitchen_rateta = $database->mysqlQuery("select tm.mta_rate,tm.mta_menuid,tm.mta_rate_type,tp.pm_portionname,tm.mta_unit_weight,tu.u_name from tbl_menuratetakeaway tm left join tbl_unit_master tu on tu.u_id=tm.mta_unit_id left join tbl_portionmaster tp on tp.pm_id=tm.mta_portion ");
    $num_kitchen_rateta = $database->mysqlNumRows($sql_kitchen_rateta);
    if($num_kitchen_rateta){ 
        while ($result_kitchen_rateta = $database->mysqlFetchArray($sql_kitchen_rateta)) {
            
            $menurate_ta['TA_MENUID'][]=$result_kitchen_rateta['mta_menuid'];
            $menurate_ta['TA_TYPE'][]=$result_kitchen_rateta['mta_rate_type'];
            $menurate_ta['TA_PORTION'][]=$result_kitchen_rateta['pm_portionname'];
            $menurate_ta['TA_WEIGHT'][]=$result_kitchen_rateta['mta_unit_weight'];
            $menurate_ta['TA_UNIT'][]=$result_kitchen_rateta['u_name'];
            $menurate_ta['TA_RATE'][]=$result_kitchen_rateta['mta_rate'];
           
            
        }
   }
   echo json_encode($menurate_ta) ;
    }
    
    
    ////////counter-sale rate///////////
    
    if(isset($_REQUEST['mode']) && $_REQUEST['mode']=='CS'){
        
    $menurate_cs=array();
    
    $sql_kitchen_ratecs = $database->mysqlQuery("select tm.mrc_rate,tm.mrc_menuid,tm.mrc_rate_type,tp.pm_portionname,tm.mrc_unit_weight,tu.u_name from tbl_menurate_counter tm left join tbl_unit_master tu on tu.u_id=tm.mrc_unit_id left join tbl_portionmaster tp on tp.pm_id=tm.mrc_portion ");
    $num_kitchen_ratecs = $database->mysqlNumRows($sql_kitchen_ratecs);
    if($num_kitchen_ratecs){ 
        while ($result_kitchen_ratecs = $database->mysqlFetchArray($sql_kitchen_ratecs)) {
            
            $menurate_cs['CS_MENUID'][]=$result_kitchen_ratecs['mrc_menuid'];
            $menurate_cs['CS_TYPE'][]=$result_kitchen_ratecs['mrc_rate_type'];
            $menurate_cs['CS_PORTION'][]=$result_kitchen_ratecs['pm_portionname'];
            $menurate_cs['CS_WEIGHT'][]=$result_kitchen_ratecs['mrc_unit_weight'];
            $menurate_cs['CS_UNIT'][]=$result_kitchen_ratecs['u_name'];
            $menurate_cs['CS_RATE'][]=$result_kitchen_ratecs['mrc_rate'];
           
            
        }
   }
   echo json_encode($menurate_cs) ;
    }
       
}            

?>
