<?php
session_start();
include("database.class.php"); // DB Connection class
$database	= new Database();
$analytics_values=array();


 if(isset($_REQUEST['value']) && $_REQUEST['value']=='first_load'){
        if(isset($_SESSION['date'])){
            
        /*************************** CASH & PAX **************************/
            
        $sql_cash =  $database->mysqlQuery("select sum(cash) as cash, sum(pax) as pax from ( select sum(bm.bm_amountpaid)-sum(bm.bm_amountbalace) as cash,sum(bm.bm_totalpax) as pax FROM tbl_tablebillmaster bm where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' union all
                                            select sum(tbm.tab_amountpaid)-sum(tbm.tab_amountbalace) as cash, 0 as pax FROM tbl_takeaway_billmaster tbm where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."') x");
        //    echo "select sum(cash) as cash from ( select sum(bm.bm_amountpaid)-sum(bm.bm_amountbalace) as cash FROM tbl_tablebillmaster bm where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' union all
        //   select sum(tbm.tab_amountpaid)-sum(tbm.tab_amountbalace) as cash FROM tbl_takeaway_billmaster tbm where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."') x";
        $num_cash = $database->mysqlNumRows($sql_cash);
        if($num_cash){
            while($result_cash = $database->mysqlFetchArray($sql_cash)){
               $analytics_values['CASH'][]=  number_format($result_cash['cash'],$_SESSION['be_decimal']);
               $analytics_values['PAX'][]=  $result_cash['pax'];
            }
        }
        /*************************** CASH & PAX ****************************************/

        /*************************** CARD ****************************************/
        $sql_card =  $database->mysqlQuery("select sum(card) as card from( select sum(bm.bm_transactionamount) as card  FROM tbl_tablebillmaster bm 
                                            left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode
                                            where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' and pm.pym_code='credit' union all
                                            select  sum(tbm.tab_transactionamount) as card FROM tbl_takeaway_billmaster tbm 
                                            left join tbl_paymentmode pm ON pm.pym_id = tbm.tab_paymode
                                            where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and pm.pym_code='credit' )x");

    //    echo "select sum(card) as card from( select sum(bm.bm_transactionamount) as card  FROM tbl_tablebillmaster bm 
    //                                        left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode
    //                                        where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' and pm.pym_code='credit' union all
    //                                        select  sum(tbm.tab_transactionamount) as card FROM tbl_takeaway_billmaster tbm 
    //                                        left join tbl_paymentmode pm ON pm.pym_id = tbm.tab_paymode
    //                                        where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and pm.pym_code='credit' )x";
        $num_card = $database->mysqlNumRows($sql_card);
        if($num_card){
            while($result_card= $database->mysqlFetchArray($sql_card)){
               $analytics_values['CARD'][]=  number_format($result_card['card'],$_SESSION['be_decimal']);   
            }
        }
        /*************************** CARD *************************************************/

        /*************************** CREDIT PERSON ****************************************/
        $sql_credit_person =  $database->mysqlQuery("select sum(credit_person) as credit_person from ( 
                                                    select sum(bm.bm_finaltotal-(bm.bm_amountpaid-bm.bm_amountbalace)) as credit_person FROM tbl_tablebillmaster bm
                                                    left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode
                                                    where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."'  and pm.pym_code='credit_person' union all
                                                    select sum(tbm.tab_netamt-(tbm.tab_amountpaid-tbm.tab_amountbalace)) as credit_person FROM tbl_takeaway_billmaster tbm 
                                                    left join tbl_paymentmode pm ON pm.pym_id = tbm.tab_paymode
                                                    where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and pm.pym_code='credit_person' ) x");
    //echo "select sum(credit_person) as credit_person from ( 
    //                                                select sum(bm.bm_finaltotal-(bm.bm_amountpaid-bm.bm_amountbalace)) as credit_person FROM tbl_tablebillmaster bm
    //                                                left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode
    //                                                where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."'  and pm.pym_code='credit_person' union all
    //                                                select sum(tbm.tab_netamt-(tbm.tab_amountpaid-tbm.tab_amountbalace)) as credit_person FROM tbl_takeaway_billmaster tbm 
    //                                                left join tbl_paymentmode pm ON pm.pym_id = tbm.tab_paymode
    //                                                where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and pm.pym_code='credit_person' ) x";
        $num_credit_person = $database->mysqlNumRows($sql_credit_person);
        if($num_credit_person){
            while($result_credit_person = $database->mysqlFetchArray($sql_credit_person)){
               $analytics_values['CREDIT_PERSON'][]=  number_format($result_credit_person['credit_person'],$_SESSION['be_decimal']);   
            }
        }
        /*************************** CREDIT PERSON ****************************************/

        /*************************** COMPLIMENTARY ****************************************/
        $sql_complimentary =  $database->mysqlQuery("select sum(complimentary) as complimentary from ( 
                                            select sum(bm.bm_finaltotal) as complimentary FROM tbl_tablebillmaster bm left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' and pm.pym_code='complimentary' union all 
                                            select sum(tbm.tab_netamt) as complimentary FROM tbl_takeaway_billmaster tbm left join tbl_paymentmode pm ON pm.pym_id = tbm.tab_paymode where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and pm.pym_code='complimentary' ) x");
    //    echo "select sum(complimentary) as complimentary from ( 
    //         select sum(bm.bm_finaltotal) as complimentary FROM tbl_tablebillmaster bm left join tbl_paymentmode pm ON pm.pym_id = bm.bm_paymode where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' and pm.pym_code='complimentary' union all 
    //         select sum(tbm.tab_netamt) as complimentary FROM tbl_takeaway_billmaster tbm left join tbl_paymentmode pm ON pm.pym_id = tbm.tab_paymode where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and pm.pym_code='complimentary' ) x";
        $num_complimentary = $database->mysqlNumRows($sql_complimentary);
        if($num_complimentary){
            while($result_complimentary = $database->mysqlFetchArray($sql_complimentary)){
               $analytics_values['COMPLIMENTARY'][]=  number_format($result_complimentary['complimentary'],$_SESSION['be_decimal']);   
            }
        }
        /*************************** COMPLIMENTARY ****************************************/
        /*************************** BILLS CANCELLED ****************************************/
        $sql_bills_cancelled =  $database->mysqlQuery("select sum(bill_count) as bill_count from ( select  count(bm.bm_billno) as bill_count from tbl_tablebillmaster bm where bm.bm_status='cancelled' and bm.bm_dayclosedate='".$_SESSION['date']."' and bm.bm_billno NOT LIKE '%TEMP%' union all
                                                       select count(tbm.tab_billno) as bill_count FROM tbl_takeaway_billmaster tbm where tbm.tab_status='Cancelled' and tbm.tab_dayclosedate='".$_SESSION['date']."' and tbm.tab_billno NOT LIKE '%TEMP%') x");

    //    echo "select sum(bill_count) as bill_count from ( select  count(bm.bm_billno) as bill_count from tbl_tablebillmaster bm where bm.bm_status='cancelled' and bm.bm_dayclosedate='".$_SESSION['date']."' union all
    //    select count(tbm.tab_billno) as bill_count FROM tbl_takeaway_billmaster tbm where tbm.tab_status='Cancelled' and tbm.tab_dayclosedate='".$_SESSION['date']."') x";
        $num_bills_cancelled = $database->mysqlNumRows($sql_bills_cancelled);
        if($num_bills_cancelled){
            while($result_bills_cancelled = $database->mysqlFetchArray($sql_bills_cancelled)){
               $analytics_values['BILLS_CANCELLED'][]=  $result_bills_cancelled['bill_count'];

            }
        }
        /*************************** BILLS CANCELLED ****************************************/
        /*************************** ITEMS CANCELLED ****************************************/
        $sql_items_cancelled =  $database->mysqlQuery("SELECT SUM(cancelled_items) AS cancelled_items FROM (
                                                    SELECT sum(oc.ch_cancelled_qty) AS cancelled_items FROM tbl_tableorder_changes oc where oc.ch_dayclosedate='".$_SESSION['date']."' and oc.ch_combo_pack_cancelled_qty IS NULL union all
                                                    SELECT sum(oc.ch_cancelled_qty) AS cancelled_items FROM tbl_tableorder_changes oc where oc.ch_dayclosedate='".$_SESSION['date']."' and oc.ch_combo_pack_cancelled_qty IS NOT NULL union all
                                                    SELECT  sum(tc.tc_cancel_qty) as cancelled_items  FROM tbl_takeaway_cancel_items tc where tc.tc_dayclosedate ='".$_SESSION['date']."' and tc.tc_combo_pack_cancelled_qty IS NULL union all
                                                    SELECT  sum(tc.tc_combo_pack_cancelled_qty) as cancelled_items  FROM tbl_takeaway_cancel_items tc where tc.tc_dayclosedate ='".$_SESSION['date']."' and tc.tc_combo_pack_cancelled_qty IS NOT NULL )x");

    //    echo "SELECT SUM(cancelled_items) AS cancelled_items FROM (
    //    SELECT sum(oc.ch_cancelled_qty) AS cancelled_items FROM tbl_tableorder_changes oc where oc.ch_dayclosedate='".$_SESSION['date']."' and oc.ch_combo_pack_cancelled_qty IS NULL union all
    //    SELECT sum(oc.adc_cancelled_qty) as cancelled_items  FROM tbl_order_addon_changes oc where oc.adc_dayclosedate='".$_SESSION['date']."' union all
    //    SELECT sum(oc.ch_cancelled_qty) AS cancelled_items FROM tbl_tableorder_changes oc where oc.ch_dayclosedate='".$_SESSION['date']."' and oc.ch_combo_pack_cancelled_qty IS NOT NULL union all
    //    SELECT  sum(tc.tc_cancelled_by) as cancelled_items  FROM tbl_takeaway_cancel_items tc where tc.tc_dayclosedate ='".$_SESSION['date']."' and tc.tc_combo_pack_cancelled_qty IS NULL union all
    //    SELECT  sum(tc.tc_combo_pack_cancelled_qty) as cancelled_items  FROM tbl_takeaway_cancel_items tc where tc.tc_dayclosedate ='".$_SESSION['date']."' and tc.tc_combo_pack_cancelled_qty IS NOT NULL )x";
        $num_items_cancelled = $database->mysqlNumRows($sql_items_cancelled);
        if($num_items_cancelled){
            while($result_items_cancelled = $database->mysqlFetchArray($sql_items_cancelled)){
               $analytics_values['ITEMS_CANCELLED'][]=  $result_items_cancelled['cancelled_items'];

            }
        }
        /*************************** ITEMS CANCELLED ****************************************/
    }
    }
    /*************************** MODULE WISE SALES ****************************************/
    if(isset($_REQUEST['value']) && $_REQUEST['value']=='sales'){
        $total_sales=array();
        $total_bills=array();
        $total_sales_pending=array();
        if(isset($_SESSION['date'])){
        $sql_module_wise_sales =  $database->mysqlQuery("select 'DI' as mode, sum(bm.bm_finaltotal) as final,count(bm.bm_billno) as bills FROM tbl_tablebillmaster bm where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' and bm.bm_complimentary!='Y' AND bm.bm_paymode IS NOT NULL union all
                                                        select  tbm.tab_mode as mode, sum(tbm.tab_netamt) as final,count(tbm.tab_billno) as bills FROM tbl_takeaway_billmaster tbm where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."' and tbm.tab_complimentary!='Y' AND tbm.tab_paymode IS NOT NULL group by tbm.tab_mode");


        $num_module_wise_sales = $database->mysqlNumRows($sql_module_wise_sales);
        if($num_module_wise_sales){
            while($result_module_wise_sales = $database->mysqlFetchArray($sql_module_wise_sales)){
                
               $analytics_values[$result_module_wise_sales['mode']][]=  number_format($result_module_wise_sales['final'],$_SESSION['be_decimal']);
               $total_sales[]=$result_module_wise_sales['final'];
               $total_bills[]=$result_module_wise_sales['bills'];
            }
        }
       $analytics_values['TOTAL'][] =number_format(array_sum($total_sales),$_SESSION['be_decimal']);
       $analytics_values['BILLS'][] =array_sum($total_bills);
       if(array_sum($total_bills)>0){
            $analytics_values['AVG_COST'][] =number_format(array_sum($total_sales)/array_sum($total_bills),$_SESSION['be_decimal']);
       }else{
           $analytics_values['AVG_COST'][] =number_format(0,$_SESSION['be_decimal']);
       }
       
       ///pending pay////
        $sql_module_wise_sales1 =  $database->mysqlQuery("select  sum(bm.bm_finaltotal) as final FROM tbl_tablebillmaster bm where (bm.bm_status !='Closed' and  bm.bm_status !='Cancelled') and bm.bm_dayclosedate='".$_SESSION['date']."' and bm.bm_billno not like '%Temp%' union all
                                                          select  sum(tbm.tab_netamt) as final  FROM tbl_takeaway_billmaster tbm where (tbm.tab_status !='Closed' and  tbm.tab_status !='Cancelled') and tbm.tab_dayclosedate='".$_SESSION['date']."' and tbm.tab_billno not like '%Temp%' union all
                                                          select  sum(tb.ter_total_rate) as final  FROM tbl_tableorder tb where tb.ter_status ='Served'  and tb.ter_dayclosedate='".$_SESSION['date']."' and tb.ter_orderno not like '%Temp%'   " );


        $num_module_wise_sales1 = $database->mysqlNumRows($sql_module_wise_sales1);
        if($num_module_wise_sales1){
            while($result_module_wise_sales1 = $database->mysqlFetchArray($sql_module_wise_sales1)){
                
             
               $total_sales_pending[]=$result_module_wise_sales1['final'];
               
            }
        }
        
       $analytics_values['TOTAL_PENDING'][] =number_format(array_sum($total_sales_pending),$_SESSION['be_decimal']);
      
       
       
        $total_sales_pending_di='0'; $total_sales_pending_ta=0; $total_sales_pending_di_temp=0;
        
        $sql_module_wise_sales12 =  $database->mysqlQuery("select sum(bm.bm_finaltotal) as final1 FROM tbl_tablebillmaster bm where "
        . " (bm.bm_status !='Closed' and  bm.bm_status !='Cancelled') and bm.bm_dayclosedate='".$_SESSION['date']."' and "
        . " bm.bm_billno not like '%Temp%' ");
                                                          

        $num_module_wise_sales12 = $database->mysqlNumRows($sql_module_wise_sales12);
        if($num_module_wise_sales12){
            while($result_module_wise_sales12 = $database->mysqlFetchArray($sql_module_wise_sales12)){
                
               $total_sales_pending_di=$result_module_wise_sales12['final1'];
               
            }
        }
        
        if($total_sales_pending_di>0){
            $total_sales_pending_di=$total_sales_pending_di;
        }else{
            $total_sales_pending_di=' 0';
        }
        
        
         $sql_module_wise_sales12 =  $database->mysqlQuery("select  sum(tbm.tab_netamt) as final2  FROM tbl_takeaway_billmaster tbm where "
         . " (tbm.tab_status !='Closed' and  tbm.tab_status !='Cancelled') and tbm.tab_dayclosedate='".$_SESSION['date']."' and 
         tbm.tab_billno not like '%Temp%'");
                           
        $num_module_wise_sales12 = $database->mysqlNumRows($sql_module_wise_sales12);
        if($num_module_wise_sales12){
            while($result_module_wise_sales12 = $database->mysqlFetchArray($sql_module_wise_sales12)){
                
               $total_sales_pending_ta=$result_module_wise_sales12['final2'];
               
            }
        }
        
        if($total_sales_pending_ta>0){
            $total_sales_pending_ta=$total_sales_pending_ta;
        }else{
            $total_sales_pending_ta=' 0';
        }
        
        
        
         $sql_module_wise_sales12 =  $database->mysqlQuery("select  sum(tb.ter_total_rate) as final3  FROM tbl_tableorder tb where "
         . "tb.ter_status ='Served'  and tb.ter_dayclosedate='".$_SESSION['date']."' and tb.ter_orderno not like '%Temp%'   " );
        $num_module_wise_sales12 = $database->mysqlNumRows($sql_module_wise_sales12);
        if($num_module_wise_sales12){
            while($result_module_wise_sales12 = $database->mysqlFetchArray($sql_module_wise_sales12)){
                
               $total_sales_pending_di_temp=$result_module_wise_sales12['final3'];
               
            }
        }
        
         if($total_sales_pending_di_temp>0){
            $total_sales_pending_di_temp=$total_sales_pending_di_temp;
        }else{
            $total_sales_pending_di_temp=' 0';
        }
        
       $analytics_values['TOTAL_PENDING_bifur'][] ='DI Billed : '.$total_sales_pending_di.' |  TA_HD_CS Billed :'.$total_sales_pending_ta.' | DI KOT : '.$total_sales_pending_di_temp;
      
       
    }
    }
    /*************************** MODULE WISE SALES ****************************************/
    
    /*************************** MODULE WISE BILLS ****************************************/
    if(isset($_REQUEST['value']) && $_REQUEST['value']=='bills'){
        $total_bills=array();
        if(isset($_SESSION['date'])){
        $sql_module_wise_bills_count =  $database->mysqlQuery("select 'DI' as mode, count(bm.bm_billno) as bills_count FROM tbl_tablebillmaster bm where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."'  union all
                                                        select  tbm.tab_mode as mode, count(tbm.tab_billno) as bills_count FROM tbl_takeaway_billmaster tbm where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."'  group by tbm.tab_mode");
//        echo "select 'DI' as mode, count(bm.bm_billno) as bills_count FROM tbl_tablebillmaster bm where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."'  union all
//                                                        select  tbm.tab_mode as mode, count(tbm.tab_billno) as bills_count FROM tbl_takeaway_billmaster tbm where tbm.tab_status='Closed' and tbm.tab_dayclosedate='".$_SESSION['date']."'  group by tbm.tab_mode";

        $num_module_wise_bills_count = $database->mysqlNumRows($sql_module_wise_bills_count);
        if($num_module_wise_bills_count){
            while($result_module_wise_bills_count = $database->mysqlFetchArray($sql_module_wise_bills_count)){
                
               $analytics_values[$result_module_wise_bills_count['mode']][]=  $result_module_wise_bills_count['bills_count'];
               $total_bills[]=$result_module_wise_bills_count['bills_count'];
            }
        }
       $analytics_values['TOTAL_BILLS'][] =array_sum($total_bills);
    }
    }
    /*************************** MODULE WISE BILLS ****************************************/
   
    /*************************** STEWARD PERFORMANCE ****************************************/
    if(isset($_REQUEST['value']) && $_REQUEST['value']=='steward_performance'){
       if(isset($_SESSION['date'])){ 
        $sql_steward =  $database->mysqlQuery(" select sm.ser_staffid as stewardid ,UPPER(sm.ser_firstname) as steward, sum(bm.bm_subtotal_final) as final 
FROM tbl_tablebillmaster bm
left join tbl_staffmaster sm ON sm.ser_staffid = bm.bm_steward
where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."' 
group by bm.bm_steward  order by bm.bm_finaltotal asc   ");
                                                
        
        
        
        
//             echo "select   sm.ser_staffid as stewardid ,sm.ser_firstname as steward, sum(bm.bm_finaltotal) as final FROM tbl_tablebillmaster bm
//                                                left join tbl_staffmaster sm  ON sm.ser_staffid = bm.bm.bm_steward
//                                                where bm.bm_status='Closed' and bm.bm_dayclosedate='".$_SESSION['date']."'  group by bm.bm_steward  order by bm.bm_finaltotal asc LIMIT 0,5";


        $num_steward = $database->mysqlNumRows($sql_steward);
        if($num_steward){
            while($result_steward = $database->mysqlFetchArray($sql_steward)){
                $analytics_values1=array();
                $analytics_values1['steward']=$result_steward['steward'];
                $analytics_values1['total']=$result_steward['final'];
               //$analytics_values['steward1'][]= array($result_steward['steward'],$result_steward['final']);
               $analytics_values['STEWARD_PERFORMANCE'][]=$analytics_values1;
              
            }
        }
    }   
       
    }
    /*************************** STEWARD PERFORMANCE ****************************************/
    
    /*************************** BEST SELLING ITEMS ****************************************/
    if(isset($_REQUEST['value']) && $_REQUEST['value']=='best_selling'){
        if(isset($_SESSION['date'])){
        $sql_best_selling =  $database->mysqlQuery("select sum(x.qty) as qty, x.menu as menu, sum(x.total) as total   from( 
                                                    select bd.bd_billno as bill, sum(bd.bd_qty) as qty,sum(bd.bd_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionshortcode,''),COALESCE(REPLACE(bd.bd_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_tablebilldetails bd
                                                    LEFT  join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = bd.bd_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=bd.bd_portion
                                                    left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                                    where bd.bd_count_combo_ordering IS NULL and bm.bm_dayclosedate='".$_SESSION['date']."' and bm.bm_status='Closed'
                                                    group by bd.bd_menuid, bd.bd_portion, bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_dayclosedate='".$_SESSION['date']."' and bm.bm_status='Closed'
                                                    group by cbd.cbd_combo_pack_id,cbd.cbd_billno union all

                                                    select tbd.tab_billno as bill, sum(tbd.tab_qty) as qty,sum(tbd.tab_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionshortcode,''),COALESCE(REPLACE(tbd.tab_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_takeaway_billdetails tbd
                                                    LEFT  join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = tbd.tab_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=tbd.tab_portion
                                                    left join  tbl_unit_master um on um.u_id=tbd.tab_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
                                                    where tbd.tab_count_combo_ordering IS NULL and tbm.tab_dayclosedate='".$_SESSION['date']."' and tbm.tab_status='Closed'
                                                    group by tbd.tab_menuid, tbd.tab_portion, tbd.tab_unit_id, tbd.tab_base_unit_id,tbd.tab_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_dayclosedate='".$_SESSION['date']."' and tbm.tab_status='Closed'
                                                    group by cbd.cbd_combo_pack_id,cbd.cbd_billno )
                                                    x group by x.menuid order by qty desc LIMIT 0,5");
        $num_best_selling = $database->mysqlNumRows($sql_best_selling);
        if($num_best_selling){
            while($result_best_selling = $database->mysqlFetchArray($sql_best_selling)){
                $analytics_values1=array();
                $analytics_values1['MENU']=$result_best_selling['menu'];
                $analytics_values1['QTY']=$result_best_selling['qty'];
                $analytics_values1['TOTAL']= number_format($result_best_selling['total'],$_SESSION['be_decimal']);
               
                $analytics_values['BEST_SELLING'][]=$analytics_values1;
              
            }
        } 
    }
    }
    /*************************** BEST SELLING ITEMS ****************************************/
    
    /*************************** MOST REVENUE GENERATING ITEMS ****************************************/
    if(isset($_REQUEST['value']) && $_REQUEST['value']=='most_revenue'){
        if(isset($_SESSION['date'])){
        $sql_most_revenue =  $database->mysqlQuery("select sum(x.qty) as qty, x.menu as menu, sum(x.total) as total   from( 
                                                    select bd.bd_billno as bill, sum(bd.bd_qty) as qty,sum(bd.bd_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionshortcode,''),COALESCE(REPLACE(bd.bd_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_tablebilldetails bd
                                                    LEFT  join tbl_tablebillmaster bm on bm.bm_billno = bd.bd_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = bd.bd_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=bd.bd_portion
                                                    left join  tbl_unit_master um on um.u_id=bd.bd_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=bd.bd_base_unit_id
                                                    where bd.bd_count_combo_ordering IS NULL and bm.bm_dayclosedate='".$_SESSION['date']."' and bm.bm_status='Closed'
                                                    group by bd.bd_menuid, bd.bd_portion, bd.bd_unit_id, bd.bd_base_unit_id,bd.bd_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details cbd
                                                    left join tbl_tablebillmaster bm on bm.bm_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_dayclosedate='".$_SESSION['date']."' and bm.bm_status='Closed'
                                                    group by cbd.cbd_combo_pack_id,cbd.cbd_billno union all

                                                    select tbd.tab_billno as bill, sum(tbd.tab_qty) as qty,sum(tbd.tab_amount) as total, CONCAT(mm.mr_itemshortcode,'(',COALESCE(pm.pm_portionshortcode,''),COALESCE(REPLACE(tbd.tab_unit_weight,'0.000',''),''),COALESCE(um.u_name,''),COALESCE(bum.bu_name,''),')' ) as menu ,mm.mr_menuid as menuid
                                                    FROM tbl_takeaway_billdetails tbd
                                                    LEFT  join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
                                                    left join tbl_menumaster mm on mm.mr_menuid = tbd.tab_menuid
                                                    left join  tbl_portionmaster pm on pm.pm_id=tbd.tab_portion
                                                    left join  tbl_unit_master um on um.u_id=tbd.tab_unit_id
                                                    left join tbl_base_unit_master bum on bum.bu_id=tbd.tab_base_unit_id
                                                    where tbd.tab_count_combo_ordering IS NULL and tbm.tab_dayclosedate='".$_SESSION['date']."' and tbm.tab_status='Closed'
                                                    group by tbd.tab_menuid, tbd.tab_portion, tbd.tab_unit_id, tbd.tab_base_unit_id,tbd.tab_unit_weight union all

                                                    select  distinct(cbd.cbd_billno) as bill,cbd.cbd_combo_qty as qty, cbd.cbd_combo_total_rate as total, CONCAT(cn.cn_name,' ',cp.cp_pack_name) as menu,cbd.cbd_combo_pack_id as menuid
                                                    FROM tbl_combo_bill_details_ta cbd
                                                    left join tbl_takeaway_billmaster tbm on tbm.tab_billno = cbd.cbd_billno
                                                    left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                    left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                    where cbd.cbd_dayclosedate='".$_SESSION['date']."' and tbm.tab_status='Closed'
                                                    group by cbd.cbd_combo_pack_id,cbd.cbd_billno )
                                                    x group by x.menuid order by total desc LIMIT 0,5");
        $num_most_revenue = $database->mysqlNumRows($sql_most_revenue);
        if($num_most_revenue){
            while($result_most_revenue = $database->mysqlFetchArray($sql_most_revenue)){
                $analytics_values1=array();
                $analytics_values1['MENU']=$result_most_revenue['menu'];
                $analytics_values1['QTY']=$result_most_revenue['qty'];
                $analytics_values1['TOTAL']= number_format($result_most_revenue['total'],$_SESSION['be_decimal']);
              
               $analytics_values['MOST_REVENUE'][]=$analytics_values1;
              
            }
        } 
    }
    }
    /*************************** MOST REVENUE GENERATING ITEMS ****************************************/
    
    /*************************** HOURLY WISE ****************************************/
    if(isset($_REQUEST['value']) && $_REQUEST['value']=='hourly_wise'){
        $hour=array();
        
        $analytics_values1=array();
        if(isset($_SESSION['date'])){
        $sql_hourly_wise =  $database->mysqlQuery("select sum(x.total) as total, x.mode as mode, x.hour1 as hour1,x.date1 from( 
                                                    select  SUM(bm.bm_finaltotal) AS total,'DI' as mode, HOUR(bm.bm_billtime ) as hour1,bm.bm_billdate as date1 FROM tbl_tablebillmaster bm
                                                    where bm.bm_dayclosedate='".$_SESSION['date']."' and bm.bm_status='Closed' and bm.bm_complimentary!='Y' group by bm.bm_billdate,HOUR(bm.bm_billtime ) union all
                                                    SELECT  SUM(tbm.tab_netamt) as total, tbm.tab_mode as mode, HOUR(tbm.tab_time) as hour1,tbm.tab_date as date1  FROM tbl_takeaway_billmaster tbm
                                                    WHERE tbm.tab_dayclosedate='".$_SESSION['date']."' and tbm.tab_status='Closed' and tbm.tab_complimentary!='Y' group by tbm.tab_date,tab_mode,HOUR(tbm.tab_time)
                                                    )x group by x.date1,x.mode, x.hour1 order by x.date1,x.hour1 asc ");
        $num_hourly_wise = $database->mysqlNumRows($sql_hourly_wise);
        if($num_hourly_wise){
            while($result_hourly_wise = $database->mysqlFetchArray($sql_hourly_wise)){
                if (array_key_exists($result_hourly_wise['date1'],$hour)){
                    if(!in_array($result_hourly_wise['hour1'],$hour[$result_hourly_wise['date1']])){
                        $hour[$result_hourly_wise['date1']][]=$result_hourly_wise['hour1'];
                    }
                }else{
                   $hour[$result_hourly_wise['date1']][]=$result_hourly_wise['hour1'];
               }
                if (array_key_exists($result_hourly_wise['date1'],$analytics_values1)){
                    $analytics_values1[$result_hourly_wise['date1']][$result_hourly_wise['hour1']][$result_hourly_wise['mode']]= number_format($result_hourly_wise['total'],$_SESSION['be_decimal']);
                }else{
                    $analytics_values1[$result_hourly_wise['date1']][$result_hourly_wise['hour1']][$result_hourly_wise['mode']]= number_format($result_hourly_wise['total'],$_SESSION['be_decimal']);
                }    
                
            }
           
        }
        
        $analytics_values['HOURLY_WISE'][]=$analytics_values1;
        $analytics_values['HOUR']=$hour; 
    }    
    }
    
    
    if(isset($_REQUEST['value']) && $_REQUEST['value']=='foodcost'){
    
    
    $i=1;  $tot_sale=0;    $tot_cost=0; $tot_profit=0; 
    
        if($_REQUEST['to']!=''){
            
        $sql_kotlist12  =  $database->mysqlQuery("select  dayclose,sum(total) as sale,sum(cost) as cost_all
        from (select  
        sum(tbl_tablebilldetails.bd_amount) as total,sum(tbl_tablebilldetails.bd_cost) as cost, tbl_tablebillmaster.bm_dayclosedate as dayclose
        FROM tbl_tablebillmaster
        LEFT  join tbl_tablebilldetails  on tbl_tablebillmaster.bm_billno = tbl_tablebilldetails.bd_billno
        where tbl_tablebillmaster.bm_status = 'Closed' and tbl_tablebillmaster.bm_complimentary='N' and   
        tbl_tablebillmaster.bm_dayclosedate between '".$_REQUEST['from']."' and '".$_REQUEST['to']."'
        group by tbl_tablebillmaster.bm_dayclosedate
        union all 
        select sum(tbl_takeaway_billdetails.tab_amount) as total, sum(tbl_takeaway_billdetails.tab_cost) as cost, tbl_takeaway_billmaster.tab_dayclosedate as dayclose
        FROM tbl_takeaway_billmaster 
        left join tbl_takeaway_billdetails on tbl_takeaway_billdetails.tab_billno=tbl_takeaway_billmaster.tab_billno
        where tbl_takeaway_billmaster.tab_status = 'Closed' and tbl_takeaway_billmaster.tab_complimentary='N' 
        and tbl_takeaway_billmaster.tab_dayclosedate between '".$_REQUEST['from']."' and '".$_REQUEST['to']."'
        group by tbl_takeaway_billmaster.tab_dayclosedate
        )x group by dayclose ");
        
        
        $tot_wastage=0;
        $sql_was  =  $database->mysqlQuery("select sum(tw_total) as cost_wastage  from tbl_wastage where tw_date  between '".$_REQUEST['from']."' and '".$_REQUEST['to']."' ");
            
        $num_was  = $database->mysqlNumRows($sql_was);
	if($num_was){ 
		while($result_was  = $database->mysqlFetchArray($sql_was)) 
		{  
                    
                    $tot_wastage=$result_was['cost_wastage'];
                }
                }
        
        $tot_consumption=0;
        $sql_con  =  $database->mysqlQuery("select sum(tc_total) as cost_consumption  from  tbl_consumption where tc_date  between '".$_REQUEST['from']."' and '".$_REQUEST['to']."' ");
            
        $num_con = $database->mysqlNumRows($sql_con);
	if($num_con){ 
		while($result_con  = $database->mysqlFetchArray($sql_con)) 
		{  
                    
                    $tot_consumption=$result_con['cost_consumption'];
                }
                }
        
        }else{
            
        $sql_kotlist12  =  $database->mysqlQuery("select  dayclose,sum(total) as sale,sum(cost) as cost_all
        from (select  
        sum(tbl_tablebilldetails.bd_amount) as total,sum(tbl_tablebilldetails.bd_cost) as cost, tbl_tablebillmaster.bm_dayclosedate as dayclose
        FROM tbl_tablebillmaster
        LEFT  join tbl_tablebilldetails  on tbl_tablebillmaster.bm_billno = tbl_tablebilldetails.bd_billno
        where tbl_tablebillmaster.bm_status = 'Closed' and tbl_tablebillmaster.bm_complimentary='N' and   
        tbl_tablebillmaster.bm_dayclosedate between CURDATE( ) - INTERVAL 7 DAY AND CURDATE( )
        group by tbl_tablebillmaster.bm_dayclosedate
        union all 
        select sum(tbl_takeaway_billdetails.tab_amount) as total, sum(tbl_takeaway_billdetails.tab_cost) as cost, tbl_takeaway_billmaster.tab_dayclosedate as dayclose
        FROM tbl_takeaway_billmaster 
        left join tbl_takeaway_billdetails on tbl_takeaway_billdetails.tab_billno=tbl_takeaway_billmaster.tab_billno
        where tbl_takeaway_billmaster.tab_status = 'Closed' and tbl_takeaway_billmaster.tab_complimentary='N' 
        and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 7 DAY AND CURDATE( )
        group by tbl_takeaway_billmaster.tab_dayclosedate
        )x group by dayclose ");
        
        
        $tot_wastage=0;
        $sql_was  =  $database->mysqlQuery("select sum(tw_total) as cost_wastage  from tbl_wastage where tw_date between  CURDATE( ) - INTERVAL 7 DAY AND CURDATE( ) ");
            
        $num_was  = $database->mysqlNumRows($sql_was);
	if($num_was){ 
		while($result_was  = $database->mysqlFetchArray($sql_was)) 
		{  
                    
                    $tot_wastage=$result_was['cost_wastage'];
                }
                }
        
        
        $tot_consumption=0;
        $sql_con  =  $database->mysqlQuery("select sum(tc_total) as cost_consumption  from  tbl_consumption where tc_date  between CURDATE( ) - INTERVAL 7 DAY AND CURDATE( ) ");
            
        $num_con = $database->mysqlNumRows($sql_con);
	if($num_con){ 
		while($result_con  = $database->mysqlFetchArray($sql_con)) 
		{  
                    
                    $tot_consumption=$result_con['cost_consumption'];
                }
                }
                
                
                
        }
        
        
        
        
        $num_kotlist12  = $database->mysqlNumRows($sql_kotlist12);
	if($num_kotlist12){ 
		while($result_kotlist12  = $database->mysqlFetchArray($sql_kotlist12)) 
		{  
                    
                    $tot_sale= $result_kotlist12['sale'];
                    $tot_cost= $result_kotlist12['cost_all']+$tot_wastage+$tot_consumption;
                    $date=$result_kotlist12['dayclose'];
                    
           $analytics_values1=array();
           $analytics_values1['Date']=$date;  
           $analytics_values1['Sale']=$tot_sale;  
           $analytics_values1['Cost']=$tot_cost;  
           $analytics_values1['Profit']=($tot_sale-$tot_cost); 
           
                  $analytics_values['FOOD_COST'][]=$analytics_values1;      
                    
                 }
                } 
                  
           
        
    }
        
     if(isset($_REQUEST['value']) && $_REQUEST['value']=='sales_comparison'){
    
    
        $i=1;  $tot_sale=0;    $tot_cost=0; $tot_profit=0; 
    
        
        if($_REQUEST['to']!=''){
      
        $sql_kotlist12  =  $database->mysqlQuery("select  dayclose,sum(total) as sale
        from (select  
        sum(tbl_tablebillmaster.bm_finaltotal) as total, tbl_tablebillmaster.bm_dayclosedate as dayclose
        FROM tbl_tablebillmaster
       
        where tbl_tablebillmaster.bm_status = 'Closed' and tbl_tablebillmaster.bm_complimentary='N' and   
        tbl_tablebillmaster.bm_dayclosedate between '".$_REQUEST['from']."' and '".$_REQUEST['to']."'
        group by tbl_tablebillmaster.bm_dayclosedate
        union all 
        select sum(tbl_takeaway_billmaster.tab_netamt) as total,  tbl_takeaway_billmaster.tab_dayclosedate as dayclose
        FROM tbl_takeaway_billmaster 
       
        where tbl_takeaway_billmaster.tab_status = 'Closed' and tbl_takeaway_billmaster.tab_complimentary='N' 
        and tbl_takeaway_billmaster.tab_dayclosedate between '".$_REQUEST['from']."' and '".$_REQUEST['to']."'
        group by tbl_takeaway_billmaster.tab_dayclosedate
        )x group by dayclose ");
        
        
        
        }else{
            
            
        $sql_kotlist12  =  $database->mysqlQuery("select  dayclose,sum(total) as sale
        from (select  
        sum(tbl_tablebillmaster.bm_finaltotal) as total, tbl_tablebillmaster.bm_dayclosedate as dayclose
        FROM tbl_tablebillmaster
       
        where tbl_tablebillmaster.bm_status = 'Closed' and tbl_tablebillmaster.bm_complimentary='N' and   
        tbl_tablebillmaster.bm_dayclosedate between CURDATE( ) - INTERVAL 7 DAY AND CURDATE( )
        group by tbl_tablebillmaster.bm_dayclosedate
        union all 
        select sum(tbl_takeaway_billmaster.tab_netamt) as total,  tbl_takeaway_billmaster.tab_dayclosedate as dayclose
        FROM tbl_takeaway_billmaster 
       
        where tbl_takeaway_billmaster.tab_status = 'Closed' and tbl_takeaway_billmaster.tab_complimentary='N' 
        and tbl_takeaway_billmaster.tab_dayclosedate between CURDATE( ) - INTERVAL 7 DAY AND CURDATE( )
        group by tbl_takeaway_billmaster.tab_dayclosedate
        )x group by dayclose ");
        }
        
        
        $num_kotlist12  = $database->mysqlNumRows($sql_kotlist12);
	if($num_kotlist12){ 
		while($result_kotlist12  = $database->mysqlFetchArray($sql_kotlist12)) 
		{  
                    
                    $tot_sale= $result_kotlist12['sale'];
                    
                    $date=$result_kotlist12['dayclose'];
                    
           $analytics_values11=array();
           $analytics_values11['Date']=$date;  
           $analytics_values11['Sale']=$tot_sale;  
        
                  $analytics_values['FOOD_COST'][]=$analytics_values11;      
                    
                 }
                } 
            
        }   
    /*************************** HOURLY WISE ****************************************/
     echo json_encode($analytics_values);
?>