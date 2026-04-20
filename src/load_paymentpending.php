<?php
include('includes/session.php');  // Check session
//session_start();
include("database.class.php"); // DB Connection class
$database = new Database();   // Create a new instance
//include('includes/menu_settings.php');
include("api_multiplelanguage_link.php");
error_reporting(0);
use Google\Client;

if (isset($_SESSION['floorid'])) {
    $floorid = trim(json_encode($_SESSION['floorid']), '""');
}
$other_lang = trim(json_encode($_SESSION['main_language']), '""');
$bilno = "";
/* require_once("includes/title_settings.php");
  include('includes/master_settings.php');
  include('includes/menu_settings.php');
 */
if (!isset($_SESSION['hidvv'])) {

    $_SESSION['hidvv'] = 0.00;
} else {


    if (isset($_REQUEST['setamt'])) {
        if ($_REQUEST['setamt'] == "amt") {
            $idd = trim($_REQUEST['totalamt']);
            $_SESSION['hidvv'] = $idd;
        }
    }
}
if (isset($_REQUEST['set']) && $_REQUEST['set'] == 'loadtablehead') {
    ?>
    <script type="text/javascript" src="js/bill_paymentscreen_sort.js"></script>

    <script>
        var len = $('script[src="js/bill_paymentscreen_sort.js"]').length;
        if (len === 0) {
            $.getScript('js/bill_paymentscreen_sort.js');
        }
    </script>
    <table class="billgenration_new_table" width="100%" border="0">
        <thead>
            <tr>
           <!-- <th width="10%" class="sortbybill" style="cursor:pointer">Bill No</th>
            <th width="20%">Table No</th>
    <?php //if($_SESSION['floorid']=='all'){ ?> <th width="20%">Floor</th> <?php //}  ?>
            <th width="25%">Time</th>
            <th width="15%">Amount</th>-->
                <th width="22%"><?= $_SESSION['payment_pending_tableno'] ?></th>
                <th width="10%" class="sortbybill" style="cursor:pointer"><?= $_SESSION['payment_pending_billno'] ?></th>
    <?php if ($_SESSION['floorid'] == 'all') { ?> <th width="20%"><?= $_SESSION['completed_order_floor_select'] ?></th> <?php } ?>
                <th width="25%"><?= $_SESSION['payment_pending_time'] ?></th>
                <th width="15%"><?= $_SESSION['payment_pending_table_amount'] ?></th>


            </tr>
        </thead>
    </table>
    <?php
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == 'loadbilldetails') {

    if ((isset($_REQUEST['floorid']))) {
        $_SESSION['floorid'] = $_REQUEST['floorid'];
        $_SESSION['florids'] = $_REQUEST['floorid'];
        $floorid = trim(json_encode($_SESSION['floorid']), '""');
    }
    $orderby = "";
    if ((isset($_REQUEST['order']))) {
        $orderby = " ORDER BY b.bm_billno " . $_REQUEST['order'];
    } else {
        $orderby = " order by b.bm_billtime";
    }
    ?>
    <script>
        var len = $('script[src="js/bill_paymentscreen_sort.js"]').length;
        if (len === 0) {
            $.getScript('js/bill_paymentscreen_sort.js');
        }
    </script>
    <script type="text/javascript" src="js/bill_paymentscreen_select.js"></script>  


    <table class="billgenration_new_table_content" width="100%" border="0">  
        <tbody>
    <?php
    if (isset($_SESSION['floorid'])) {
        if ($_SESSION['floorid'] == "all") {
            $sql_table_sel = $database->mysqlQuery("SELECT b.bm_billno,b.bm_finaltotal, b.bm_tableno,b.bm_billtime , f.fr_floorname,b.bm_can_regenerate,f.fr_floorid FROM tbl_tablebillmaster b left join tbl_floormaster f
on b.bm_floorid = f.fr_floorid WHERE ((b.bm_status='Billed') )  AND  b.bm_dayclosedate ='" . $_SESSION['date'] . "' AND b.bm_billno not like '%temp%'  $orderby ");
            //$sql_table_sel  =  $database->mysqlQuery("SELECT distinct(tm.tr_tableno),ts.ts_tableidprefix,b.bm_finaltotal,ts.ts_dineintime,ts.ts_orderno,fm.fr_floorname,ts.ts_tableid,ts.ts_billnumber,b.	bm_can_regenerate FROM tbl_tabledetails as ts LEFT JOIN tbl_tablebillmaster b ON b.bm_billno = ts.ts_billnumber       LEFT JOIN tbl_tablemaster as tm ON ts.ts_tableid=tm.tr_tableid LEFT JOIN tbl_tableorder as tor ON ts.ts_orderno=tor.ter_orderno LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=ts.ts_floorid WHERE tm.tr_status='Active'  AND  ((b.bm_status='Billed') AND (b.bm_status<>'Cancelled for Split')) AND  tor.ter_dayclosedate='".$_SESSION['date']."'  order by tm.tr_tableno"); 
        } else {
            //$sql_table_sel  =  $database->mysqlQuery("SELECT distinct(tm.tr_tableno),ts.ts_tableidprefix,b.bm_finaltotal,ts.ts_dineintime,ts.ts_orderno,fm.fr_floorname,ts.ts_tableid,ts.ts_billnumber,b.	bm_can_regenerate FROM tbl_tabledetails as ts LEFT JOIN tbl_tablebillmaster b ON b.bm_billno = ts.ts_billnumber LEFT JOIN tbl_tablemaster as tm ON ts.ts_tableid=tm.tr_tableid LEFT JOIN tbl_tableorder as tor ON ts.ts_orderno=tor.ter_orderno LEFT JOIN tbl_floormaster as fm ON fm.fr_floorid=ts.ts_floorid WHERE tm.tr_status='Active' AND ts.ts_floorid='".$_SESSION['floorid']."'  AND ((b.bm_status='Billed') AND (b.bm_status<>'Cancelled for Split')) AND  tor.ter_dayclosedate='".$_SESSION['date']."'  order by tm.tr_tableno"); 
            $sql_table_sel = $database->mysqlQuery("SELECT b.bm_billno,b.bm_finaltotal, b.bm_tableno,b.bm_billtime, f.fr_floorname,b.bm_can_regenerate,f.fr_floorid  FROM tbl_tablebillmaster b left join tbl_floormaster f
on b.bm_floorid = f.fr_floorid WHERE ((b.bm_status='Billed') )  AND  b.bm_dayclosedate ='" . $_SESSION['date'] . "' AND f.fr_floorid='" . $_SESSION['floorid'] . "' AND b.bm_billno not like '%temp%'   $orderby");
        }
        $num_table = $database->mysqlNumRows($sql_table_sel);
        if ($num_table) {
            while ($result_table_sel = $database->mysqlFetchArray($sql_table_sel)) {
                $floor_name = "";
                $floor_name = $result_table_sel['fr_floorname'];
//                                            $fpfloor=fopen($apilink."/src/main_menu_display.php?set=floors&dat=$other_lang","r");
//                                            //echo $apilink."/src/main_menu_display.php?set=floors&dat=$other_lang";
//                                            $response_floor['messages'] = stream_get_contents($fpfloor);
//                                            //echo  $response['messages'];
//                                            $resu_floor= json_decode($response_floor['messages'],true);
//                                            //var_dump($resu_floor);
//                                            //var_dump($result_table_sel['fr_floorid']);
//                                            $floor_count=count($resu_floor['floor_id']);
//                                            //echo $floor_count;
//                                            for($f=0;$f<$floor_count;$f++)
//                                            {
//                                                 if($result_table_sel['fr_floorid']==$resu_floor['floor_id'][$f]){
//                                                 $floor_name=$resu_floor['floor_name'][$f];
//                                                //echo $floor_name;
//                                                }  
//                                            }
//                                            
                $tabn = explode(",", $result_table_sel['bm_tableno']);
                $tablename = '';
                $tablename = $result_table_sel['bm_tableno'];
//                                                    foreach($tabn as $key=>$value)
//                                                    {
//							$splitbraces=explode("(",$value);
//							$tabid=$database->show_tableid_retieve($splitbraces[0]);
//							$tableid=$tabid['tr_tableid'];
//                                                        
//                                                        $fptable=fopen($apilink."/src/main_menu_display.php?set=table&floorid=&dat=$other_lang","r");
//                                                        $response_table['messages'] = stream_get_contents($fptable);
//                                                        //var_dump($response_table['messages']);
//                                                        $resu_table= json_decode($response_table['messages'],true);
//                                                        //var_dump($resu_table['table_id'][0]);
//                                                        $table_count=count($resu_table['table_id']);
//                                                        // echo $table_count;
//                                                        for($m=0;$m<$table_count;$m++){
//                                                            if($tableid==$resu_table['table_id'][$m]){
//                                                            $table_name=$resu_table['table_name'][$m]; 
//                                                            //echo $table_name;
//                                                            }
//                                                        }
//                                                        if($tablename=="")
//                                                        {
//                                                            $tablename=$table_name."(".$splitbraces[1];
//                                                        }else{
//                                                        $tablename=$tablename ." , ".$table_name."(".$splitbraces[1];
//                                                        }
//                                                    }
                ?>

                                                <tr class="clickeachrowpaymnt<?php if (isset($_REQUEST['bilno'])) {
                    if ($_REQUEST['bilno'] == $result_table_sel['bm_billno']) { ?> tr_bill_gen_active  <?php }
                } ?>" billno="<?= $result_table_sel['bm_billno'] ?>" final_total="<?= number_format($result_table_sel['bm_finaltotal'], $_SESSION['be_decimal']) ?>" regen="<?= $result_table_sel['bm_can_regenerate'] ?>" table_id="<?= $result_table_sel['bm_tableno'] ?>"  ><!--<tr class="tr_bill_gen_active">-->
                            <td width="20%"> <?= $tablename// $result_table_sel['bm_tableno']?></td>
                            <td width="10%"><strong><?= $result_table_sel['bm_billno'] ?></strong></td>
                        <?php if ($_SESSION['floorid'] == 'all') { ?> <td width="15%"><?= $floor_name//$result_table_sel['fr_floorname']?></td> <?php } ?>
                            <td width="25%"> <?= date("h:i:s", strtotime($result_table_sel['bm_billtime'])) ?></td>

                            <td width="15%"><?= number_format($result_table_sel['bm_finaltotal'], $_SESSION['be_decimal']) ?>/-</td>
                        </tr>

                    <?php }
                } else {
                    ?>
                    <tr>
                        <td style="color:#F00"><?= $_SESSION['credit_settlement_error_record_display'] ?></td>
                    </tr>
                    <?php }
            }
            ?>

        </tbody>
    </table>


    <?php
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == 'loadorderdetails') {
    $bilno = $_REQUEST['billno'];
    $exp_bilno = explode(",", $bilno);

    $table = $_REQUEST['table'];
    $exp_tableid = explode(",", $table);

    $prefix = $_REQUEST['prefix'];
    $exp_prefix = explode(",", $prefix);
    ?>
    <table  class="billgenration_new_table" width="100%" border="0" cellspacing="5">
        <thead>
            <tr>
                <th width="10%"><?= $_SESSION['payment_pending_slno'] ?></th>
                <th width="40%"><?= $_SESSION['payment_pending_menuitem'] ?></th>
                <th width="10%"><?= $_SESSION['payment_pending_qty'] ?></th>
                <th width="15%"><?= $_SESSION['payment_pending_rate'] ?></th>
                <th width="22%"><?= $_SESSION['payment_pending_order_amount'] ?></th>
            </tr>
        </thead>
        <tbody >
    <?php
    $rate = 0;
    foreach ($exp_tableid as $number => $value) {
        $tablename = $database->show_mastertable_details($value);
        ?>
                <tr>
                    <td class="table_dtail_multisel" colspan="5">Table <?= str_replace(' ', '', ($tablename['tr_tableno'] . $exp_prefix[$number])); ?></td>
                </tr>
        <?php
        $kots = array();
        $kots1 = array();
        $sql_table_sel1 = $database->mysqlQuery("SELECT distinct(ter_kotno) from tbl_tableorder as to1 LEFT JOIN tbl_tabledetails as td 	ON to1.ter_orderno=td.ts_orderno WHERE td.ts_tableid='" . $value . "' and  td.ts_tableidprefix='" . $exp_prefix[$number] . "' and to1.ter_dayclosedate='" . $_SESSION['date'] . "' ");
        $num_table1 = $database->mysqlNumRows($sql_table_sel1);
        if ($num_table1) {
            while ($result_table_sel1 = $database->mysqlFetchArray($sql_table_sel1)) {
                ?>
                        <tr>
                            <td class="table_dtail_multisel" colspan="5"><?= $result_table_sel1['ter_kotno'] ?></td>
                        </tr>
                        <?php
                        $amount = "";
                        $sql_table_sel1_2 = $database->mysqlQuery("SELECT * from tbl_tableorder as to1 LEFT JOIN tbl_menumaster as mn 	ON to1.ter_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON to1.ter_portion=pm.pm_id WHERE to1.ter_kotno='" . $result_table_sel1['ter_kotno'] . "' and to1.ter_dayclosedate='" . $_SESSION['date'] . "' ");
                        $num_table1_2 = $database->mysqlNumRows($sql_table_sel1_2);
                        if ($num_table1_2) {
                            while ($result_table_sel1_2 = $database->mysqlFetchArray($sql_table_sel1_2)) {
                                $rate = $rate + ($result_table_sel1_2['ter_qty'] * $result_table_sel1_2['ter_rate']);
                                $amount = $result_table_sel1_2['ter_qty'] * $result_table_sel1_2['ter_rate']
                                ?>
                                <tr>
                                    <td width="10%"><?= $result_table_sel1_2['ter_slno'] ?></td>
                                    <td width="40%"><?= $_SESSION[$result_table_sel1_2['ter_menuid']]['menu']//$result_table_sel1_2['mr_menuname'] ?></td>
                                    <td width="10%"><?= $result_table_sel1_2['ter_qty'] ?></td>
                                    <td width="15%"><?= number_format($result_table_sel1_2['ter_rate'], $_SESSION['be_decimal']) ?></td>
                                    <td width="22%"><?= number_format($amount, $_SESSION['be_decimal']) ?></td>
                                </tr>
                    <?php }
                } ?>
                    <?php }
                } ?>
            <?php } ?>      
        </tbody>
    </table>


    <script>
        //$(document).ready(function(){
        $('#loadtotalrate').html(<?= $rate ?>);
        //});
    </script>
    <?php
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == 'loadbilldetails_total') {
    $tip_amount = 0;
    if (isset($_REQUEST['billno'])) {
        $bilno = ($_REQUEST['billno']);
        $_SESSION['billno'] = $bilno;
    }
    ?>
    <table  class="billgenration_new_table" width="100%" border="0" cellspacing="5">
        <thead style="padding-right:0">
    <?php
    $kotlist = '';
    $sql_kot1 = $database->mysqlQuery("select * from tbl_tableorder tor  where tor.ter_billnumber = '$bilno' group by tor.ter_orderno");
    //echo "select * from tbl_tableorder tor  where tor.ter_billnumber = '$bilno' group by tor.ter_orderno";
    $num_kot1 = $database->mysqlNumRows($sql_kot1);
    if ($num_kot1) {
        while ($row_kot1 = $database->mysqlFetchArray($sql_kot1)) {

            $sql_kot = $database->mysqlQuery("select distinct(tor.ter_kotno) from tbl_tableorder tor left join  tbl_tablebillmaster tbm on tbm.bm_orderno=tor.ter_orderno  where tor.ter_orderno='" . $row_kot1['ter_orderno'] . "' and tor.ter_billnumber = '$bilno' group by tor.ter_kotno");
            //echo "select distinct(tor.ter_kotno) from tbl_tableorder tor left join  tbl_tablebillmaster tbm on tbm.bm_orderno=tor.ter_orderno  where tor.ter_orderno='".$row_kot1['ter_orderno']."' and tor.ter_billnumber = '$bilno' group by tor.ter_kotno";
            $num_kot = $database->mysqlNumRows($sql_kot);
            if ($num_kot) {
                while ($row_kot = $database->mysqlFetchArray($sql_kot)) {
                    $kotlist .=$row_kot['ter_kotno'] . ',';
                }
            }
            //$kotlist = rtrim($kotlist,', ');
        }
    }

    $kotlist1 = rtrim($kotlist, ', ');

    $tbllist = '';
    $print_by = '';
    $sql_tbl = $database->mysqlQuery("select tbm.bm_tableno,tbm.bm_bill_printed_by FROM tbl_tablebillmaster tbm where tbm.bm_billno='$bilno'");
    $num_tbl = $database->mysqlNumRows($sql_tbl);
    if ($num_tbl) {
        while ($row_tbl = $database->mysqlFetchArray($sql_tbl)) {
            $tbllist .=$row_tbl['bm_tableno'];
            $print_by = $row_tbl['bm_bill_printed_by'];
        }
        $tbllist = rtrim($tbllist, ',');
    }                   //echo $tbllist;
    ?>

            <tr>
                <td class="table_dtail_multisel" colspan="1"><?= $_SESSION['payment_pending_billno'] ?> - <?= $bilno ?></td>
                <td style="text-align:center !important" class="table_dtail_multisel" colspan="1" ><span class="settle_head_spa"><?= $tbllist ?></span></td>
                <td class="table_dtail_multisel" colspan="1" ><?= $kotlist1 ?></td>
            </tr>

            <tr>
                <th width="10%"><?= $_SESSION['payment_pending_slno'] ?></th>
                <th width="40%"><?= $_SESSION['payment_pending_menuitem'] ?></th>
                <th width="10%"><?= $_SESSION['payment_pending_qty'] ?></th>
                <th width="15%"><?= $_SESSION['payment_pending_rate'] ?></th>
                <th width="22%"><?= $_SESSION['payment_pending_order_amount'] ?></th>
            </tr>
        </thead>
        <tbody >


        <input type="hidden" id="bill" value="<?= $bilno ?>"/>
            <?php
            $combo_entry_count = array();
            $total = 0;
            $slno = 0;
            $combo_qty = 0;
            $sql_combo_list = $database->mysqlQuery("select distinct(cbd.cbd_count_combo_ordering) as cbd_count_combo_ordering, cbd.cbd_combo_pack_rate, cbd.cbd_combo_total_rate, cbd.cbd_combo_qty, cn.cn_name,cp.cp_pack_name   FROM tbl_combo_bill_details cbd
                                                            left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                            left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                            where cbd.cbd_billno='" . $bilno . "' order by cbd.cbd_count_combo_ordering asc ");
            $num_combo_list = $database->mysqlNumRows($sql_combo_list);
            if ($num_combo_list) {
                while ($result_combo_list = $database->mysqlFetchArray($sql_combo_list)) {
                    $slno++;
                    $combo_menu_array = array();
                    if (!in_array($result_combo_list['cbd_count_combo_ordering'], $combo_entry_count)) {
                        $total = $total + $result_combo_list['cbd_combo_total_rate'];
                        $combo_entry_count[] = $result_combo_list['cbd_count_combo_ordering'];
                        //$total=$total+$result_combo_list['cod_combo_total_rate'];
                        $combo_qty = $combo_qty + $result_combo_list['cbd_combo_qty'];
                        $sql_combomenu_list = $database->mysqlQuery("select mm.mr_menuname  FROM tbl_combo_bill_details cbd
                                                               left join tbl_menumaster mm on mm.mr_menuid=cbd.cbd_menu_id
                                                               where cbd.cbd_count_combo_ordering='" . $result_combo_list['cbd_count_combo_ordering'] . "' and cbd.cbd_billno='" . $bilno . "'");
                        $num_combomenu_list = $database->mysqlNumRows($sql_combomenu_list);
                        if ($num_combomenu_list) {
                            while ($result_combomenu_list = $database->mysqlFetchArray($sql_combomenu_list)) {
                                $combo_menu_array[] = $result_combomenu_list['mr_menuname'];
                            }
                        }
                        ?>
                    <tr>
                        <td width="10%"><?= $slno ?></td>
                        <td width="40%"><span style="color: #f00">(Combo) </span>
                    <?= $result_combo_list['cn_name'] . ' ' . $result_combo_list['cp_pack_name'] ?>
                            <span class="combo_tbl_lst"><?= implode(',', array_unique($combo_menu_array)); ?></span>
                        </td>
                        <td width="10%" class="text-center"><?= $result_combo_list['cbd_combo_qty'] ?></td>
                        <td width="15%" class="text-center"><?= number_format($result_combo_list['cbd_combo_pack_rate'], $_SESSION['be_decimal']) ?></td>
                        <td width="22%" class="text-right"><?= number_format($result_combo_list['cbd_combo_total_rate'], $_SESSION['be_decimal']) ?></td>
                    </tr>
                    <?php
                }
            }
        }


        $sql_listall = $database->mysqlQuery("SELECT td.*,mn.mr_menuname,mn.mr_menuid from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id WHERE td.bd_billno='" . $bilno . "' AND bd_cancelled='N' order by td.bd_billslno ");
        $num_listall = $database->mysqlNumRows($sql_listall);
        if ($num_listall) {
            while ($row_listall = $database->mysqlFetchArray($sql_listall)) {
                $slno++;
                $billsettle_menuid = trim(json_encode($row_listall['bd_menuid']), '""');
                $billsettle_menuname = $row_listall['mr_menuname'];

//                                                $fp=fopen($apilink."/src/main_menu_display.php?set=orderedmenu&ordered_menuid=$billsettle_menuid&dat=$other_lang","r");
//                                                $response['messages'] = stream_get_contents($fp);
//                                                //var_dump($response['messages']);
//                                                $resu= json_decode($response['messages'],true);

                $total = $total + $row_listall['bd_amount'];
                if ($_SESSION['main_language'] != 'english') {

                    $sql_arabmenu = $database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='" . $row_listall['mr_menuid'] . "' and ls_language='" . $_SESSION['main_language'] . "'");

                    //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                    $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                    $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                    $billsettle_menuname = $result_arabmenu['lm_menu_name'];
                    // $catid['name'][] = $catname;
                    //echo $catname;
                }
                ?>
                <tr>
                    <td width="10%"><?= $row_listall['bd_billslno'] ?></td>
                    <td width="40%"><span class="addon_txt"><?php if ($row_listall['bd_bill_addon_slno'] != '') { ?> (AD) <?php } else { ?> <?php } ?></span> <?= $billsettle_menuname//$row_listall['mr_menuname'] ?></td>
                    <td width="10%"><?= $row_listall['bd_qty'] ?></td>
                    <td width="15%"><?= number_format($row_listall['bd_rate'], $_SESSION['be_decimal']) ?></td>
                    <td width="22%"><?= number_format($row_listall['bd_amount'], $_SESSION['be_decimal']) ?></td>
                </tr>

            <?php }
        } ?>

    </tbody>
    </table>




        <?php
        if (isset($_REQUEST['billno'])) {
            $total_am = 0;
            $total_sub = 0;
            $total_disc = 0;
            $total_sv = 0;
            $total_va = 0;
            $total_extx = 0;
            $tax_name = '';
            $tax_value = '';

            $sql_taxdetails = $database->mysqlQuery("SELECT bem_total_value,bem_label   from tbl_tablebill_extra_tax_master  WHERE bem_billno='$bilno'");
            $num_taxdetails = $database->mysqlNumRows($sql_taxdetails);
            if ($num_taxdetails) {
                $p = 0;
                while ($row_taxdetails = $database->mysqlFetchArray($sql_taxdetails)) {
                    $p++;
                    if ($p == 1) {
                        $tax_name = $row_taxdetails['bem_label'];
                        $tax_value = $row_taxdetails['bem_total_value'];
                    } else {
                        $tax_name.='<>' . $row_taxdetails['bem_label'];
                        $tax_value.='<>' . $row_taxdetails['bem_total_value'];
                    }
                }
            }
            $sql_final = $database->mysqlQuery("SELECT bm_tips_given,`bm_subtotal`,bm_finaltotal,bm_discountvalue FROM `tbl_tablebillmaster` WHERE bm_billno='$bilno'");
            //echo "SELECT `bm_subtotal`,bm_finaltotal,bm_discountvalue FROM `tbl_tablebillmaster` WHERE bm_billno='$bilno'";
            $num_final = $database->mysqlNumRows($sql_final);
            if ($num_final) {
                while ($row_final = $database->mysqlFetchArray($sql_final)) {

                    $total_sub = $row_final['bm_subtotal'];
                    $total_am = $row_final['bm_finaltotal'];
                    $total_disc = $row_final['bm_discountvalue'];
                    $tip_amount = number_format(str_replace(',', '', $row_final['bm_tips_given']), $_SESSION['be_decimal']);
                }
            }
            ?>
        <input type="hidden" id="taxname" value="<?= $tax_name ?>">
        <input type="hidden" id="taxvalues" value="<?= $tax_value ?>">
        <input type="hidden" id="tot_subtotal" value="<?= $total_sub ?>">
        <input type="hidden" id="tot_netamount" value="<?= $total_am ?>">
        <input type="hidden" id="tot_discount" value="<?= $total_disc ?>">
        <input type="hidden" id="tips_given" value="<?= $tip_amount ?>">

        <script>
            //grandtotal_sec 
        // $(document).ready(function(){
            var decimal = $("#decimal").val();
            $("#taxdetails_div").empty();
            $('#grandtotal_sec_sub1').css('display', 'block');
            $('#grandtotal_sec_sub').text(parseFloat($('#tot_subtotal').val()).toFixed(decimal));
            $('#grandtotal_sec1').css('display', 'block');
            $('#grandtotal_sec').text(parseFloat($('#tot_netamount').val()).toFixed(decimal));
            $('#tip_amount').val($('#tips_given').val());

            var taxnames = $('#taxname').val().split('<>');
            var taxvalues = $('#taxvalues').val().split('<>');
            if (taxnames == '') {

                taxnames = 0;
            }

            for (var j = 0; j < taxnames.length; j++) {
                $("#taxdetails_div").append('<div style="width:100%; " class="lable_counter_paymnet_cc counter_right_lable" id=' + taxnames[j] + '>' + taxnames[j] + ':<span >' + parseFloat(taxvalues[j]).toFixed(decimal) + '</span></div>');
            }

            //alert($('#tot_subtotal').val());
            $('#totaldisc').text(parseFloat($('#tot_discount').val()).toFixed(decimal));
            $('#final').text(parseFloat($('#tot_subtotal').val()).toFixed(decimal));
            $('#grandtotal').text(parseFloat($('#tot_netamount').val()).toFixed(decimal));

            $('#printed_by_di').text('<?= $print_by ?>');
            // });
        </script>
    <?php
    } else {
        $total_am = 0;
        $total_sub = 0;
        $total_disc = 0;
        $total_sv = 0;
        $total_va = 0;
        ?>
        <script>
            //$(document).ready(function(){alert

            //});
        </script>
    <?php }
    ?>





    <?php
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == "billregenerate") {


    $reasontext = '';
    $secretkey = '';
    $stafflist = '';
    $bilno = $_REQUEST['bilno'];
    if (isset($_REQUEST['reasontext'])) {
        $reasontext = $_REQUEST['reasontext'];
        $secretkey = $_REQUEST['secretkey'];
        $stafflist = $_REQUEST['stafflist'];
    } else {
        $reasontext = '';
        $secretkey = '';
        $stafflist = '';
    }



    if ($stafflist != '') {

        $dateexp = date("Y-m-d H:i:s");
        /* $sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); */
        $sql_table_sel3 = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='" . $stafflist . "' AND  ser_employeestatus='Active'");
        $rrt = '';
        $num_table3 = $database->mysqlNumRows($sql_table_sel3);
        if ($num_table3) {
            while ($row = mysqli_fetch_array($sql_table_sel3)) {
                $rrt = $row['ser_cancelwithkey'];
            }
        }
        if ($rrt == "Y") {
            $result = "yes";
            //$_REQUEST['secretkey']
            $sql = $database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='" . $dateexp . "' WHERE (sr_key='" . $secretkey . "' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
        } else {
            $result = "no";
            //sr_password=md5($_REQUEST['secretkey'])
            $sql = $database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='" . $dateexp . "' WHERE (sr_password='" . md5($secretkey) . "')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
        }
    }


    try {
        $database->mysqlQuery("SET @secretkey = " . "'" . $secretkey . "'");
        $database->mysqlQuery("SET @staffid = " . "'" . $stafflist . "'");
        $database->mysqlQuery("SET @reason = " . "'" . $reasontext . "'");
        $database->mysqlQuery("SET @loginid = " . "'" . $_SESSION['expodine_id'] . "'");
        $database->mysqlQuery("SET @regen_billno = " . "'" . $bilno . "'");
        $message = '';
        $sqs = $database->mysqlQuery("CALL proc_bill_regenerate(@regen_billno,@secretkey,@staffid,@reason,@loginid,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));

        $rs = $database->mysqlQuery('SELECT @message AS message');
        while ($row = mysqli_fetch_array($rs)) {
            echo $row['message'];
        }


        ///point add remove////

        $sql_login_fire2 = $database->mysqlQuery("delete from tbl_loyalty_pointadd_bill where lob_billno='$bilno' ");

        ///loy end ///
        ///firebase////

        $dateexp5 = date("Y-m-d H:i:s");
        $login = $_SESSION['expodine_id'];
        $amt = $_REQUEST['grandtotal'];

        $sql_login_fire2 = $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Regenerate' ");
        $num_login_fire2 = $database->mysqlNumRows($sql_login_fire2);
        if ($num_login_fire2) {
            while ($result_login_fire2 = $database->mysqlFetchArray($sql_login_fire2)) {
                $firebase_report_status = $result_login_fire2['tf_active'];
            }
        }





        if ($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on'] == 'Y' && $firebase_report_status == "Y") {

            $staf_reg = '';
            $sql_login_fire21 = $database->mysqlQuery("select ser_firstname from tbl_staffmaster where ser_staffid='$stafflist' ");
            $num_login_fire21 = $database->mysqlNumRows($sql_login_fire21);
            if ($num_login_fire21) {
                while ($result_login_fire21 = $database->mysqlFetchArray($sql_login_fire21)) {
                    $staf_reg = $result_login_fire21['ser_firstname'];
                }
            }



            $a = "8.8.8.8";
            exec("ping -n 1 -w 1 " . $a, $output, $result);
            if ($result == 0) {
                ///pushing msg///
                $branch_id_fire = $_SESSION['firebase_id'];
                
                
    require 'vendor/autoload.php';
    
    $client = new Client();
    $client->setAuthConfig('service_google.json'); // Replace with your file path
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];
    $body = "Bill No: $bilno \nBill Regenerated By: $staf_reg \nLogin:$login \nReason:$reasontext \nBill Amount:$amt \nTime:$dateexp5 ";
              
   $url = "https://fcm.googleapis.com/v1/projects/ed-reports-b5f94/messages:send";

   $projectId = 'ed-reports-b5f94'; 
 
     $data = [
    'message' => [
       "topic"=> $branch_id_fire,
        'notification' => [
            'title' => $_SESSION['s_branchname'] . "  - DI BILL REGENERATED ",
            'body' => $body 
        ],
        'data' => [
            'key1' => 'value1',
            'key2' => 'value2'
        ],
         "android" =>[
      "ttl"=> "3600s" , // TTL in seconds (1 hour)
       "priority"=> "HIGH"     
    ],
        'apns' => [
        "headers"=>[
        "apns-expiration" => "2" ,// TTL for iOS
         "apns-priority"=> "10"         
      ],
            'payload' => [
                'aps' => [
                    'sound' => 'default', // Notification sound for iOS
                ],
            ],
        ],
    ]
   ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    if(curl_errno($ch)) {
       // echo 'Error:' . curl_error($ch);
    } else {
       // echo 'Response: ' . $response;
    }
    curl_close($ch);
   // echo $response;
                
                
                
//                $url = "https://fcm.googleapis.com/fcm/send";
//                //$token ='dFCy-onTEvQ:APA91bGXAQobatT-sbeLk3QTFdh-Zf10Z7dzmUIO99GHDjkrmwWwvzA7poh5dbAv55B7KrFKAQtpDwkJgo9lgwxFUC0W_RrnI1ohd7c-IJJfuCTeSSdhyKowMEKwOYZk5met5QhnCx0T';
//                $serverKey = 'AIzaSyD3zn_tP2RqeVSMsEFMJnrcZk5AuNGru-M';
//                $title = $_SESSION['s_branchname'] . "  - BILL REGENERATED ";
//
//                $body = "Bill No: $bilno \nBill Regenerated By: $staf_reg \nLogin:$login \nReason:$reasontext \nBill Amount:$amt \nTime:$dateexp5 ";
//                $notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1', 'click_action' => 'notification');
//                $arrayToSend = array('to' => "/topics/$branch_id_fire", 'notification' => $notification, 'priority' => 'high');
//                $json = json_encode($arrayToSend);
//                $headers = array();
//                $headers[] = 'Content-Type: application/json';
//                $headers[] = 'Authorization: key=' . $serverKey;
//                $ch = curl_init();
//                curl_setopt($ch, CURLOPT_URL, $url);
//                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
//                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//                //Send the request
//                $response = curl_exec($ch);
//                //Close request
//                if ($response === FALSE) {
//                    die('FCM Send Error: ' . curl_error($ch));
//                }
//                curl_close($ch);

                ///////to database storage of msg////

                $data_to_firebase = urlencode($body);
                $url = $_SESSION['firebase_url'] . "api/post_notification?branhcid=$branch_id_fire&notification=$data_to_firebase";
                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                curl_close($ch);
                //var_dump($result);
            }
        }


        exit();
        
    } catch (Exception $e) {
        $returnmsg_err = 'Caught exception: ' . $e;
        $file = 'log.txt';
        $content = date("l F  d-m-Y h:i:s A") . " " . $returnmsg_err . PHP_EOL;
        file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
        echo $returnmsg_err;
        exit();
    }
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == "setbillnotopay") {
    $billno = $_REQUEST['bilno'];
    $_SESSION['billno'] = $billno;
    
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == "loadcreditypes") {
    
    
    $credittype = $_REQUEST['credittype'];
    $xmltype = '';
    $pref = '';


    if ($credittype == '2' || $credittype == '1') {  ?>
        
        <span class="room_no_txt labelname"></span>
        <span class="room_text_box_cc">
            <select  style="margin-top: 7px;width: 103px;margin-left: -40px;" class="staff_menu_select" name="selectcreditdetails" id="selectcreditdetails">
            <option value=""><?= $_SESSION['payment_pending_select_roomname'] ?></option>
        <?php
       
        if ($credittype == "1") {
            
            $xmltype = 'roommaster';
            $pref = "rm_";

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $_SESSION['be_expolitelink'] . "/occupiedrooms",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $result = json_decode($response, true);
            }
            $room_numbers = implode(',', $result['data']);
           
            $sql_roomnumber = $database->mysqlQuery("update tbl_credit_master cm,tbl_roommaster rm  set cm.crd_active ='N'  where rm.rm_roomid=cm.crd_roomid   and cm.crd_type='1' ");
            
            $sql_roomnumber1 = $database->mysqlQuery("update tbl_credit_master cm,tbl_roommaster rm  set cm.crd_active ='Y'  where rm.rm_roomid=cm.crd_roomid  and rm.rm_roomno  IN ($room_numbers) and cm.crd_type='1' ");
           
             $sql_ds_nos = "select cm.crd_id as id,rm.rm_roomno as names,rm.rm_roomid as main_id from tbl_credit_master as cm LEFT JOIN tbl_roommaster as rm ON cm.crd_roomid=rm.rm_roomid where cm.crd_type='" . $credittype . "' AND cm.crd_branchid='" . $_SESSION['branchofid'] . "' AND cm.crd_active='Y' AND rm.rm_status='Y' ORDER BY rm_roomid ASC ";
          
            } else if ($credittype == "2") {
         
            $xmltype = 'staffmaster_first';
            $sql_ds_nos = "select cm.crd_id as id,sm.ser_firstname as names,sm.ser_staffid as main_id from tbl_credit_master as cm  LEFT JOIN tbl_staffmaster as sm ON cm.crd_staffid=sm.ser_staffid where cm.crd_type='" . $credittype . "' AND cm.crd_branchid='" . $_SESSION['branchofid'] . "' AND cm.crd_active='Y' AND  sm.ser_employeestatus='Active' ORDER BY cm.crd_id  DESC";
        }
				}
        $sql_ds = $database->mysqlQuery($sql_ds_nos);
        $num_ds = $database->mysqlNumRows($sql_ds);
        if ($num_ds) {
            while ($result_ds = $database->mysqlFetchArray($sql_ds)) {
                
                if ($credittype == "2") {

                    ?>    

                <option value="<?= $result_ds['id'] ?>" ><?php echo $result_ds['names']; ?></option>

                <?php }else { ?>
                            
                <option value="<?= $result_ds['id'] ?>" ><?php echo $result_ds['names']; ?></option>?>
                            
                <?php } } ?>   
                            
            </select>
            </span>
        
            <?php } else if ($credittype == "3" || $credittype == "4") { ?>  

            <?php if ($credittype == "4") { ?>
        
            <span style="width: 40%;" class="room_no_txt labelname">Name</span>
            <span class="room_text_box_cc" style="display: none">

                <input type="text" Placeholder="Enter Name"  class="staff_menu_select" name="selectcreditdetailsname" id="selectcreditdetailsname" onclick=" return name_search_click();"  onchange=" return name_search(this.value)" onkeyup=" return name_search(this.value)"  onkeydown="return suggession_select(event)"autocomplete="off">
                <div id="suggession_name" ></div>
            </span>

                <?php } ?>

                <?php if ($credittype == "3") { ?>

            <span style="width: 40%" class="room_no_txt labelname">Name</span>
            <span class="room_text_box_cc">

                <select style="margin-top: 7px;width: 103px;margin-left: -153px;" name="selectcreditdetailsname" id="selectcreditdetailsname"  class="staff_menu_select">
                    <?php
                    $sql_login = $database->mysqlQuery("select ct.ct_corporatename from tbl_corporatemaster ct left join tbl_credit_master cm on cm.crd_corporateid=ct.ct_corporatecode  where ct.ct_status='Y' and cm.crd_active='Y' ");
                    $num_login = $database->mysqlNumRows($sql_login);

                    if ($num_login) {
                        while ($result_login = $database->mysqlFetchArray($sql_login)) {
                            ?>
                            <option value="<?= $result_login['ct_corporatename'] ?>"><?= $result_login['ct_corporatename'] ?></option>
                        <?php } } ?>
                </select>
                <?php } ?>

            </span>
                <?php if ($credittype == "4") { ?>

            <span class="room_no_txt labelname1"></span>
            <span class="room_text_box_cc" style="    margin-top: -25px;">
                <input style="margin-top: -2px;margin-left: -158px;width: 103px;" type="text" Placeholder="Number-Name-ID"  class="staff_menu_select" name="selectcreditdetailsnumber" onkeypress="return numdot7(event);" id="selectcreditdetailsnumber"  onclick=" return number_search(this.value)" onchange=" return number_search(this.value)" onkeyup=" return number_search(this.value)" maxlength="12" autocomplete="off">
                <div id="suggession_number" style="display: none "></div>
            </span>


        <?php } } ?>
            
        <?php
        
            if (isset($_REQUEST['setamt12']) && ($_REQUEST['setamt'] == "amt")) {
                 echo $_REQUEST['totalamt'];
            }
       ?>

    <span class="room_no_txt "> <?= $_SESSION['payment_pending_creditamount'] ?> </span>
    <span class="room_text_box_cc">
            <?php
            $sq_lang45 = $database->mysqlQuery("select be_base_currency,be_show_currency from  tbl_branchmaster");
            $nm_lang45 = $database->mysqlNumRows($sq_lang45);
            if ($nm_lang45) {
                while ($result_lang45 = $database->mysqlFetchArray($sq_lang45)) {
                    $currency = $result_lang45['be_base_currency'];
                    $showcurrency1 = $result_lang45['be_show_currency'];
                }
            }
            
     if ($showcurrency1 == "Y") {
                ?>
            <input style="width: 40%;margin-top: 2px"  placeholder="Enter Credit Amount" class="tax_textbox transa_txt " id="amount_credit1" name="amount_credit1" value="<?= $_SESSION['hidvv'] ?>"  readonly="readonly">
            <?php } else { ?>
            <input  style="width: 40%;margin-top: 2px" placeholder="Enter Credit Amount" class="tax_textbox transa_txt " id="amount_credit" name="amount_credit" value=" "  readonly="readonly">

     <?php } ?>

    <?php if ($_SESSION['s_default_company'] == 'Z') { ?>
            <strong id="check_del_div" style="margin-left: 5px;margin-top: 5px;float:right; color: darkred;display:block;border: solid 1px;border-radius: 3px"> &nbsp; ONLINE ORDER &nbsp; </strong>
    <?php } ?> 
    </span>





    <?php
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == "bill_settle") {
    $tip_amount = 0;
    $tip_mode = '';
    $guest_number = '';
    $guest_name = '';
    $billno = $_REQUEST['billno'];
    $creditype = NULL;
    $typenam = $_REQUEST['typenam'];
    $typeid = $_REQUEST['typeid'];
    $credit = 'N'; //paid bal
    $amountpaid = 0;
    $bal = 0;
    $creditdeatils = NULL;
    $paidamount_credit = 0;
    $amount_credit = 0;
    $credit_remark = NULL;


    $transactionamount = 0;
    $card_bank = 0;
    $complmtry = 'N';
    $remark = NULL;
    $voucherid = NULL;
    $couponcompany = NULL;
    $couponamt = 0;
    $chequeno = NULL;
    $chequebankname = NULL;
    $chequeamount = 0;
    $staff = NULL;
    //$reasontext=NULL;
    $secretkey = NULL;
    $stafflist = NULL;
    $upi_amount = 0;
    $upi_txn_id = 0;
    if ($_REQUEST['type'] == "credit_person") {
        $guest_number = '';
        $guest_name = '';
        $creditype = '';
        $sq_lang459 = $database->mysqlQuery("select be_base_currency,be_show_currency from  tbl_branchmaster");
        $nm_lang459 = $database->mysqlNumRows($sq_lang459);
        if ($nm_lang459) {
            while ($result_lang459 = $database->mysqlFetchArray($sq_lang459)) {
                $currency123 = $result_lang459['be_base_currency'];
                $showcurrency123 = $result_lang459['be_show_currency'];
            }
        }

        $credit_remark = $_REQUEST['credit_remark'];
        $creditype = $_REQUEST['creditype'];
        $creditdeatils = $_REQUEST['creditdeatils'];
        $paidamount_credit = $_REQUEST['paidamount_credit'];
        $amountpaid = $_REQUEST['paidamount_credit'];
        $amountpaid = $_REQUEST['paidamount_credit'];

        if ($showcurrency123 == "Y") {
            $amount_credit = $_SESSION['hidvv'];
        } else {
            $amount_credit = $_REQUEST['amount_credit'];
        }
        $credit = 'Y';
        $bal = $_REQUEST['bal'];
        $guest_number = $_REQUEST['guestnumber'];
        $guest_name = $_REQUEST['guestname'];

        if ($creditype == '4' || $creditype == '3') {
            $creditdeatils = '';
            //echo $guest_name.'<br>'.$guest_number.'<br>'.$_SESSION['branchofid'].'<br>'.$creditype;
            $database->mysqlQuery("SET @guestname			= " . "'" . $guest_name . "'");
            $database->mysqlQuery("SET @guestphone			= " . "'" . $guest_number . "'");
            $database->mysqlQuery("SET @branchid			= " . "'" . $_SESSION['branchofid'] . "'");
            $database->mysqlQuery("SET @credittype			= " . "'" . $creditype . "'");
            $message = '';
            $guest = $database->mysqlQuery("CALL proc_credit_entry(@guestname,@guestphone,@branchid,@credittype,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
            $guest_id = '';
            $guest1 = $database->mysqlQuery('SELECT @message AS message');
            while ($row = mysqli_fetch_array($guest1)) {
                $guest_id = $row['message'];
            }
            $creditdeatils = $guest_id;


            $loy_upd = $database->mysqlQuery(" UPDATE tbl_loyalty_reg SET ly_loy_login='" . $_SESSION['login_staff_id_expodine'] . "',ly_loy_dayclose='" . $_SESSION['date'] . "' where ly_id=LAST_INSERT_ID() ");
        } else if ($creditype == '1') {
            $room = $_REQUEST['room'];
        }
        //echo $creditdeatils;
    } else if ($_REQUEST['type'] == "complimentary") {
        $remark = $_REQUEST['comp'];
        $complmtry = 'Y';
    } else if ($_REQUEST['type'] == "comp_management") {
        $remark = $_REQUEST['comp'];
        //$complmtry='Y';
        $staff = $_REQUEST['staff'];


        //$reasontext=$_REQUEST['reasontext'];
        if (isset($_REQUEST['secretkey'])) {

            $secretkey = $_REQUEST['secretkey'];
            $stafflist = $_REQUEST['stafflist'];
        } else {
            $secretkey = NULL;
            $stafflist = NULL;
        }
    } else if ($_REQUEST['type'] == "cash") {
        $amountpaid = $_REQUEST['paid'];
        $bal = $_REQUEST['bal'];
    } else if ($_REQUEST['type'] == "credit") {
        $transactionamount = $_REQUEST['trans'];
        $card_bank = $_REQUEST['bank'];
        $amountpaid = $_REQUEST['paid'];
        $bal = $_REQUEST['bal'];
    } else if ($_REQUEST['type'] == "coupon") {
        $couponcompany = $_REQUEST['coup'];
        $couponamt = $_REQUEST['coupamnt'];
        $amountpaid = $_REQUEST['paid'];
        $bal = $_REQUEST['bal'];
        echo $couponcompany . " " . $couponamt . " " . $amountpaid . " " . $bal;
    } else if ($_REQUEST['type'] == "voucher") {
        $voucherid = $_REQUEST['vouchid'];
        $amountpaid = $_REQUEST['paid'];
        $bal = $_REQUEST['bal'];
    } else if ($_REQUEST['type'] == "cheque") {
        $chequeno = $_REQUEST['cheqname'];
        $chequebankname = $_REQUEST['cheqbank'];
        $chequeamount = $_REQUEST['cheqamt'];
        $amountpaid = $_REQUEST['paid'];
        $bal = $_REQUEST['bal'];
    } else if ($_REQUEST['type'] == "upi") {
        $upi_amount = $_REQUEST['upi_amount'];
        $upi_txn_id = $_REQUEST['upi_txn_id'];
    }

    $tip_amount = $_REQUEST['tip_amount'];
    $tip_mode = $_REQUEST['tip_mode'];


    if ($couponamt > 0) {
        $date = date('Y-m-d H:i:s');
        $queryupdate = $database->mysqlQuery("update tbl_loyalty_group_details set tgp_code_active='N',tgp_billno='" . $billno . "',tgp_coupon_amount='" . $couponamt . "',tgp_bill_date_time='" . $date . "',tgp_bill_amount='" . $_REQUEST['bill_final_amount_new'] . "' where tgp_groupcode='" . $_REQUEST['coupon_code'] . "' ");
    }


    if ($credit == "Y" || $complmtry == "Y") {
        $date_py = date('Y-m-d H:i:s');
        $insertion['tp_datetime'] = mysqli_real_escape_string($database->DatabaseLink, trim($date_py));
        $insertion['tp_login'] = mysqli_real_escape_string($database->DatabaseLink, trim($_SESSION['expodine_id']));
        $insertion['tp_auth_staff'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['auth_staff']));

        if ($complmtry == "Y") {
            $insertion['tp_pay_type'] = mysqli_real_escape_string($database->DatabaseLink, trim("complimentary"));
        } else if ($credit == "Y") {
            $insertion['tp_pay_type'] = mysqli_real_escape_string($database->DatabaseLink, trim("credit_person"));
        }

        $insertion['tp_billno'] = mysqli_real_escape_string($database->DatabaseLink, trim($billno));
        $sql = $database->check_duplicate_entry('tbl_payment_auth_log', $insertion);
        if ($sql != 1) {
            $insertid = $database->insert('tbl_payment_auth_log', $insertion);
        }
    }






    $returnmsg = ''; //echo $tb;
//        echo    $billno .'<br>';
//	echo	$_SESSION['branchofid'] .'<br>';
//	echo	$typeid . "<br>";
//	echo	$amountpaid .'<br>';
//        echo        $upi_amount . "<br>";
//        echo        $upi_txn_id . "<br>";
//	echo	$transactionamount . "<br>";
//	echo	$card_bank . "<br>";
//	echo	$complmtry . "<br>";
//	echo	$remark . "<br>";
//	echo	$voucherid . "<br>";
//	echo	$couponcompany . "<br>";
//        echo        $couponamt . "<br>";
//	echo	$chequeno . "<br>";
//	echo	$chequebankname . "<br>";
//	echo	$chequeamount . "<br>";
//	echo	$credit . "<br>";
//	echo	$creditdeatils . "<br>";
//	echo	$amount_credit . "<br>";
//	echo	$bal . "<br>";
//	echo	$staff . "<br>";
//	echo	$secretkey . "<br>";
//	echo	$stafflist . "<br>";
//	echo	$_SESSION['expodine_id'] . "<br>";
//        echo        $_SESSION['expodine_id'] . "<br>";
//	echo	$credit_remark . "<br>";
//        echo        $guest_name . "<br>";
//        echo        $guest_number . "<br>";
    try {
//billno,branchid,paymodeid,amountpaid,transactionamount,card_bank,remark,voucherid,couponcompany,couponamt,chequeno,chequebankname ,chequeamount,credit,creditmasterid,creditamount,message		

        $database->mysqlQuery("SET @billno				= " . "'" . $billno . "'");
        $database->mysqlQuery("SET @branchid			= " . "'" . $_SESSION['branchofid'] . "'");
        $database->mysqlQuery("SET @paymodeid			= " . "'" . $typeid . "'");
        $database->mysqlQuery("SET @amountpaid			= " . "'" . $amountpaid . "'");
        $database->mysqlQuery("SET @upi_amount			= " . "'" . $upi_amount . "'");
        $database->mysqlQuery("SET @upi_txn_id			= " . "'" . $upi_txn_id . "'");
        $database->mysqlQuery("SET @transactionamount	= " . "'" . $transactionamount . "'");
        $database->mysqlQuery("SET @card_bank			= " . "'" . $card_bank . "'");
        $database->mysqlQuery("SET @complementary		= " . "'" . $complmtry . "'");
        $database->mysqlQuery("SET @remark				= " . "'" . $remark . "'");
        $database->mysqlQuery("SET @voucherid			= " . "'" . $voucherid . "'");
        $database->mysqlQuery("SET @couponcompany		= " . "'" . $couponcompany . "'");
        $database->mysqlQuery("SET @couponamt			= " . "'" . $couponamt . "'");
        $database->mysqlQuery("SET @chequeno			= " . "'" . $chequeno . "'");
        $database->mysqlQuery("SET @chequebankname 		= " . "'" . $chequebankname . "'");
        $database->mysqlQuery("SET @chequeamount		= " . "'" . $chequeamount . "'");
        $database->mysqlQuery("SET @credit				= " . "'" . $credit . "'");
        $database->mysqlQuery("SET @creditmasterid		= " . "'" . $creditdeatils . "'");
        $database->mysqlQuery("SET @creditamount		= " . "'" . $amount_credit . "'");
        $database->mysqlQuery("SET @balanceamt		= " . "'" . $bal . "'");

        $database->mysqlQuery("SET @complementary_staff		= " . "'" . $staff . "'");
        $database->mysqlQuery("SET @auth_secretkey		= " . "'" . $secretkey . "'");
        $database->mysqlQuery("SET @auth_staffid		= " . "'" . $stafflist . "'");
        $database->mysqlQuery("SET @auth_loginid		= " . "'" . $_SESSION['expodine_id'] . "'");
        $database->mysqlQuery("SET @payment_login		= " . "'" . $_SESSION['expodine_id'] . "'");
        $database->mysqlQuery("SET @credit_remark		= " . "'" . $credit_remark . "'");
        $database->mysqlQuery("SET @guest_name                  = " . "'" . $guest_name . "'");
        $database->mysqlQuery("SET @guest_number		= " . "'" . $guest_number . "'");


        $message = '';
        $sq = $database->mysqlQuery("CALL proc_billpayment(@billno,@branchid,@paymodeid,@amountpaid,@upi_amount,@upi_txn_id,@transactionamount,@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname ,@chequeamount,@credit,@creditmasterid,@creditamount,@balanceamt,@complementary_staff,@auth_secretkey,@auth_staffid,@auth_loginid,@payment_login,@credit_remark,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
        $rs = $database->mysqlQuery('SELECT @message AS message');
        while ($row = mysqli_fetch_array($rs)) {
            $s = $row['message'];
        }
        $returnmsg = $s;
        if ($returnmsg == 'Payment succesfully processed') {
            $tip = $database->mysqlQuery(" UPDATE `tbl_tablebillmaster` SET `bm_tips_given`='" . $tip_amount . "',`bm_tips_mode`='" . $tip_mode . "' WHERE bm_billno='" . $billno . "' ");
        }
        if ($_REQUEST['type'] == "credit_person" && $returnmsg == 'Payment succesfully processed' && $creditype == 1) {
            $queryupdate = $database->mysqlQuery("update tbl_credit_details set cd_settled='Y',cd_dateofsettle=now() where cd_billno='" . $billno . "' ");

            //echo "update tbl_credit_details set cd_settled='Y',cd_dateofsettle=now() where cd_billno='".$billno."'" ;

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $_SESSION['be_expolitelink'] . "/expodineroomservice",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\"room_no\": \"$room\",\"amount\":\"$amount_credit\" ,\"billno\": \"$billno\"}",
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }
        }
        echo $returnmsg;


        $qr_order = '';
        $sql_listall5 = $database->mysqlQuery("SELECT bm_qr_orderno from tbl_tablebillmaster  WHERE bm_dayclosedate='" . $_SESSION['date'] . "'  and bm_billno='$billno' limit 1   ");
        $num_listall5 = $database->mysqlNumRows($sql_listall5);
        if ($num_listall5) {
            $default_loy = 'Y';
            while ($row_listall5 = $database->mysqlFetchArray($sql_listall5)) {
                $qr_order = $row_listall5['bm_qr_orderno'];
            }
        }


        if ($qr_order != '') {

            $date = date('Y-m-d H:i:s');
            $localhost1 = mysqli_connect(HOST_NAME_CLOUD, USER_NAME_CLOUD, PASSWORD_CLOUD, DATABASE_NAME_QR);

            $sql_gen = mysqli_query($localhost1, "Update tbl_qr_order_details set tq_localy_delivered='Y' ,tq_deliverd_time='$date' "
                    . " where tq_branch='" . $_SESSION['firebase_id'] . "' and tq_order_no='$qr_order' ");
        }


        $sql_login_fire2 = $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Credit Settle' ");
        $num_login_fire2 = $database->mysqlNumRows($sql_login_fire2);
        if ($num_login_fire2) {
            while ($result_login_fire2 = $database->mysqlFetchArray($sql_login_fire2)) {
                $firebase_report_status_credit = $result_login_fire2['tf_active'];
            }
        }

        $sql_login_fire = $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Complimentary Settle' ");
        $num_login_fire = $database->mysqlNumRows($sql_login_fire);
        if ($num_login_fire) {
            while ($result_login_fire = $database->mysqlFetchArray($sql_login_fire)) {
                $firebase_report_status_comp = $result_login_fire['tf_active'];
            }
        }


        if ($_REQUEST['sms_bill_settle'] == 'Y') {

            $customer = '';
            $number = '';
            $loy_qry1 = $database->mysqlQuery("select lr.ly_firstname,lr.ly_mobileno from tbl_loyalty_pointadd_bill lb"
                    . " left join tbl_loyalty_reg lr on lr.ly_id=lb.lob_loyalty_customer where lb.lob_billno='" . $billno . "'");

            $num_loy = $database->mysqlNumRows($loy_qry1);
            if ($num_loy) {
                while ($loyalty_listing = $database->mysqlFetchArray($loy_qry1)) {
                    $customer = $loyalty_listing['ly_firstname'];
                    $number = $loyalty_listing['ly_mobileno'];
                }
            }


            ///encode///
            $secret_key = 'my_simple_secret_key';
            $secret_iv = 'my_simple_secret_iv';

            $conv1 = false;


            $encrypt_method = "AES-256-CBC";
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $secret_iv), 0, 16);

            $conv = $billno . ',' . $_SESSION['firebase_id'];

            $conv1 = base64_encode(openssl_encrypt($conv, $encrypt_method, $key, 0, $iv));
            ////encode_end////
            // $message= " * Here is your ebill of Rs.".$_REQUEST['bill_final_amount_new']."."
            //  . "Click: https://ebill.expodine.com/ebill.php?b_id=$conv1 ";


            $message = $customer . "*" . $_SESSION['s_branchname'];



            if ($number != '') {
                $print = $database->dynamic_sms_api($number, $message);
            }
        }



        if ($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on'] == 'Y' && ( ($credit == "Y" && $firebase_report_status_credit == 'Y') || ($complmtry == "Y" && $firebase_report_status_comp == 'Y') )) {

            $staff_pay = '';
            $sql_table_sel3 = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='" . $_REQUEST['auth_staff'] . "' ");
            $num_table3 = $database->mysqlNumRows($sql_table_sel3);
            if ($num_table3) {
                while ($row = mysqli_fetch_array($sql_table_sel3)) {

                    $staff_pay = $row['ser_firstname'];
                }
            }

            if ($staff_pay != '') {
                $staff_pay1 = $staff_pay;
            } else {
                $staff_pay1 = ' No Authorization ';
            }



            $date_nw_nw = date('Y-m-d H:i:s');
            $a = "8.8.8.8";
            exec("ping -n 1 -w 1 " . $a, $output, $result);
            if ($result == 0) {
                $amt_fire = $_REQUEST['bill_final_amount_new'];
                if ($credit == "Y") {

                    $title1 = $_SESSION['s_branchname'] . " : NOTIFICATION - CREDIT BILL ";

                    $data_body = " CREDIT BILL \nBill No: $billno  \nDate:$date_nw_nw \nCredit Amount :$amount_credit \nAuthorization Staff:$staff_pay1 \nBill Amount : $amt_fire  ";
                } else if ($complmtry == "Y") {
                    $title1 = $_SESSION['s_branchname'] . " : NOTIFICATION - COMPLIMENTARY BILL ";
                    $data_body = " COMPLIMENTARY BILL \nBill No: $billno  \nDate:$date_nw_nw \nAuthorization Staff:$staff_pay1 \nBill Amount : $amt_fire  ";
                }

                ///pushing msg///
                $branch_id_fire = $_SESSION['firebase_id'];
                
          
    $body = $data_body;     
    require 'vendor/autoload.php';
   
    $client = new Client();
    $client->setAuthConfig('service_google.json'); // Replace with your file path
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

   $url = "https://fcm.googleapis.com/v1/projects/ed-reports-b5f94/messages:send";

   $projectId = 'ed-reports-b5f94'; 
 
     $data = [
    'message' => [
       "topic"=> $branch_id_fire,
        'notification' => [
            'title' => $title1,
            'body' => $body
        ],
        'data' => [
            'key1' => 'value1',
            'key2' => 'value2'
        ],
         "android" =>[
      "ttl"=> "3600s" , // TTL in seconds (1 hour)
       "priority"=> "HIGH"     
    ],
        'apns' => [
        "headers"=>[
        "apns-expiration" => "2" ,// TTL for iOS
         "apns-priority"=> "10"         
      ],
            'payload' => [
                'aps' => [
                    'sound' => 'default', // Notification sound for iOS
                ],
            ],
        ],
    ]
   ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $accessToken,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    if(curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo 'Response: ' . $response;
    }
    curl_close($ch);
   // echo $response;
                
                
                
//                $url = "https://fcm.googleapis.com/fcm/send";
//                //$token ='dFCy-onTEvQ:APA91bGXAQobatT-sbeLk3QTFdh-Zf10Z7dzmUIO99GHDjkrmwWwvzA7poh5dbAv55B7KrFKAQtpDwkJgo9lgwxFUC0W_RrnI1ohd7c-IJJfuCTeSSdhyKowMEKwOYZk5met5QhnCx0T';
//                $serverKey = 'AIzaSyD3zn_tP2RqeVSMsEFMJnrcZk5AuNGru-M';
//                $title = $title1;
//
//                $body = $data_body;
//                $notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1', 'click_action' => 'notification');
//                $arrayToSend = array('to' => "/topics/$branch_id_fire", 'notification' => $notification, 'priority' => 'high');
//                $json = json_encode($arrayToSend);
//                $headers = array();
//                $headers[] = 'Content-Type: application/json';
//                $headers[] = 'Authorization: key=' . $serverKey;
//                $ch = curl_init();
//                curl_setopt($ch, CURLOPT_URL, $url);
//                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//                curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
//                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//                //Send the request
//                $response = curl_exec($ch);
//                //Close request
//                if ($response === FALSE) {
//                    die('FCM Send Error: ' . curl_error($ch));
//                }
//                curl_close($ch);

                //to database storage of msg//
                $data_to_firebase = urlencode($body);
                $url = $_SESSION['firebase_url'] . "api/post_notification?branhcid=$branch_id_fire&notification=$data_to_firebase";
                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch);
                curl_close($ch);
                //var_dump($result);
            }
        }
    } catch (Exception $e) {
        $returnmsg = 'Caught exception: ' . $e;
        $file = 'log.txt';
        $content = date("l F d-m-Y h:i:s A") . " " . $returnmsg . PHP_EOL;
        file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
        echo $returnmsg;
        exit();
    }
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == "billsplitassign") {
    $_SESSION['set_billnotosplit'] = $_REQUEST['bilno'];
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == "checkcashdrawersettings") {
    if ($_SESSION['s_cash_drawer_settle_btn'] == 'Y') {
        echo "Y";
    } else {
        echo "N";
    }
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == "upipayment_status") {
    $upi_request_id = '';
    $upi_status_api = '';
    $upi_hashsalt = '';
    $upi_client_id = '';
    $upi_auth_token = '';
    if (isset($_REQUEST['billno'])) {
        $upi_transcation_billno = $_REQUEST['billno'];
    }
    $upi_status_api_query = $database->mysqlQuery("select be_upi_auth_token,be_upi_status_api,be_client_hash_salt,be_client_id from tbl_generalsettings ");
    $num_upi = $database->mysqlNumRows($upi_status_api_query);
    if ($num_upi) {
        while ($result_upi = $database->mysqlFetchArray($upi_status_api_query)) {
            $upi_status_api = $result_upi['be_upi_status_api'];
            $upi_hashsalt = $result_upi['be_client_hash_salt'];
            $upi_client_id = $result_upi['be_client_id'];
            $upi_auth_token = $result_upi['be_upi_auth_token'];
        }
    }
    $upi_hash_salt = $database->mysqlQuery("select bm_upi_requestid from tbl_tablebillmaster  WHERE bm_billno='" . $upi_transcation_billno . "' ");
    $num_hash_salt = $database->mysqlNumRows($upi_hash_salt);
    if ($num_upi) {
        while ($result_hash_salt = $database->mysqlFetchArray($upi_hash_salt)) {
            $upi_request_id = $result_hash_salt['bm_upi_requestid'];
        }
    }


    //echo $upi_transcation_billno;
    //echo $upi_request_id;

    $curl = curl_init();

    $toHash = "$upi_transcation_billno|||$upi_hashsalt";
    $hash = hash('sha512', $toHash);

    curl_setopt_array($curl, array(
        CURLOPT_URL => $upi_status_api,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\n\"MERCH_ORDER_ID\":\"$upi_transcation_billno\",\n\"TXN_ID\":\"\",\n\"TXN_OTP\":\"\",\n\"REQUEST_ID\":\"\"}\n",
        // 6545465456|87GVHVG|3||||a0d3ad1c
        //MOB_NUMBER | PAN |EXT _MID |TERMINAL_ID| AUTH_VALUE|TRUPAY_CID| <your-salt-here>
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $upi_auth_token",
            "cache-control: no-cache",
            "content-type: application/json",
            //"postman-token: 040c830e-6e0c-a55f-a053-9656c807e7a5",
            "securehash: $hash|$upi_client_id"
        ),
    ));
    $loc = getcwd();
    //echo $loc;
    //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($curl, CURLOPT_CAINFO, getcwd() . "\cacert.pem");

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == "guest_search_credit") {
    $credit_type = '';
    if (isset($_REQUEST['credit_type'])) {
        $credit_type = $_REQUEST['credit_type'];
    }
    if ($credit_type == '4') {
        $string = '';
        $guest_number = '';
        $guest_number = $_REQUEST['number'];
        if ($guest_number != '') {
            $string.=" ly_mobileno LIKE '$guest_number%' ";
        }
        $guest_name = '';
        $guest_name = $_REQUEST['name'];
        if ($guest_name != '') {
            $string.=" ly_firstname LIKE '$guest_name%' ";
        }
        $guest_number1 = array();
        $guest_name1 = array();
        $guest_id1 = array();
        $sq_guest_number = $database->mysqlQuery("select ly_mobileno,ly_firstname,ly_lastname,ly_id from tbl_loyalty_reg where $string and ly_status='Active' ");
        //echo "select ly_mobileno,ly_firstname,ly_lastname from tbl_loyalty_reg where $string ";
        $nm_guest_number = $database->mysqlNumRows($sq_guest_number);
        if ($nm_guest_number) {
            while ($result_guest_number = $database->mysqlFetchArray($sq_guest_number)) {
                $guest_id1[] = $result_guest_number['ly_id'];
                $guest_number1[] = $result_guest_number['ly_mobileno'];
                $guest_name1[] = $result_guest_number['ly_firstname'] . ' ' . $result_guest_number['ly_lastname'];
            }
        }
        echo json_encode(['mobile' => $guest_number1, 'name' => $guest_name1, 'name_id' => $guest_id1]);
    }
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == "guestnumber_search") {
  
    $credit_type = '';
    if (isset($_REQUEST['credit_type'])) {
        $credit_type = $_REQUEST['credit_type'];
    }
    
    if ($credit_type == '4') {
        
        $string = '';
        $guest_number = '';
        $guest_number = $_REQUEST['number'];


        $string.=" ly_mobileno !='' ";

        if ($guest_number != '') {
            $string.=" and (ly_mobileno LIKE '%$guest_number%' or ly_firstname LIKE '%$guest_number%'  or ly_id LIKE '%$guest_number%') ";
        }


    $guest_name='';
    $guest_name=$_REQUEST['name'];
//    if($guest_name!=''){
//       $string.=" ly_firstname LIKE '$guest_name%' " ;   
//    }
//    
        
        
         if ($guest_name != '') {
            $string.=" and (ly_mobileno LIKE '%$guest_name%' or ly_firstname LIKE '%$guest_name%'  or ly_id LIKE '%$guest_name%') ";
        }

        $guest_number1 = array();
        $guest_name1 = array();
        $sq_guest_number = $database->mysqlQuery("select ly_mobileno,ly_firstname,ly_lastname,ly_id from tbl_loyalty_reg where $string and ly_status='Active' ");
        //echo "select ly_mobileno,ly_firstname,ly_lastname from tbl_loyalty_reg where $string ";
        $nm_guest_number = $database->mysqlNumRows($sq_guest_number);
        if ($nm_guest_number) {
            while ($result_guest_number = $database->mysqlFetchArray($sq_guest_number)) {
                $guest_number1[] = $result_guest_number['ly_mobileno'];
                $guest_name1[] = $result_guest_number['ly_firstname'] . ' -  ' . $result_guest_number['ly_id'];
            }
        }
        echo json_encode(['mobile' => $guest_number1, 'name' => $guest_name1]);
    } else if ($credit_type == '3') {

        $guest_name = '';
        $guest_name = $_REQUEST['name'];
        $guest_name1 = array();
        $sql_company_name = $database->mysqlQuery("select ct_corporatename  from  tbl_corporatemaster where ct_corporatename LIKE '$guest_name%' and ct_status='Y' ");
        //echo "select ct_corporatename  from  tbl_corporatemaster where ct_corporatename LIKE '$guest_name%'  ";
        $nm_company_name = $database->mysqlNumRows($sql_company_name);
        if ($nm_company_name) {
            while ($result_company_name = $database->mysqlFetchArray($sql_company_name)) {

                $guest_name1[] = $result_company_name['ct_corporatename'];
            }
        }
        echo json_encode(['name' => $guest_name1]);
    }
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == 'regen_split') {
    $sql_table_sel_split = $database->mysqlQuery("select bm_bill_is_split  from tbl_tablebillmaster where bm_billno='" . $_REQUEST['billno_regen'] . "'");
    $num_table1_split = $database->mysqlNumRows($sql_table_sel_split);
    if ($num_table1_split) {
        while ($result_table_sel1_split = $database->mysqlFetchArray($sql_table_sel_split)) {
            echo $result_table_sel1_split['bm_bill_is_split'];
        }
    }
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == "pincheck") {
    $pin = $_REQUEST['pin'];
    $str = '';
    if ($_REQUEST['type'] == "staffsel")
        $str .= "ser_authorisation_code = '$pin'";
    else if ($_REQUEST['type'] == "authpincheck")
        $str .= "ser_authorisation_code = '$pin'";

    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'kotcancel') {
        $sql_staff = "select sm.ser_credit_permission,sm.ser_comp_permission,sm.ser_discount_manual,sm.ser_discountpermission, sm.ser_bill_cancel_permission,sm.ser_order_split_permission,sm.ser_dayclose_permission,sm.ser_staffid,sm.ser_cancelpermission,sm.ser_bill_reprint_per,sm.ser_bill_settle_change_per,sm.ser_bill_regen_per, dm.dr_takeorder FROM tbl_staffmaster sm
    left join tbl_designationmaster dm on dm.dr_designationid = sm.ser_designation
    where $str and sm.ser_employeestatus = 'Active' and sm.ser_kot_cancel_permission='Y'";
    } else if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'billcancelpermission') {
        $sql_staff = "select sm.ser_credit_permission,sm.ser_comp_permission,sm.ser_discount_manual,sm.ser_discountpermission, sm.ser_order_split_permission,sm.ser_dayclose_permission,sm.ser_bill_cancel_permission,sm.ser_cancelpermission,sm.ser_staffid,sm.ser_bill_settle_change_per,sm.ser_bill_reprint_per,sm.ser_bill_regen_per FROM tbl_staffmaster sm where $str and sm.ser_employeestatus = 'Active' and sm.ser_bill_cancel_permission='Y'";
    } else {
        $sql_staff = "select sm.ser_credit_permission,sm.ser_comp_permission,sm.ser_discount_manual,sm.ser_discountpermission, sm.ser_bill_cancel_permission,sm.ser_order_split_permission,sm.ser_dayclose_permission,sm.ser_staffid,sm.ser_cancelpermission,sm.ser_bill_settle_change_per,sm.ser_bill_regen_per,sm.ser_bill_reprint_per, dm.dr_takeorder FROM tbl_staffmaster sm
    left join tbl_designationmaster dm on dm.dr_designationid = sm.ser_designation
    where $str and sm.ser_employeestatus = 'Active'";
    }
    $sql_staff = $database->mysqlQuery($sql_staff);
    $num_staff = $database->mysqlNumRows($sql_staff);
    if ($num_staff) {
        $row = mysqli_fetch_array($sql_staff);
        if ($_REQUEST['type'] == "staffsel") {
            if ($row['dr_takeorder'] == 'Y') {
                echo $row['ser_staffid'];
            } else {
                echo "NO PERMISSION";
            }
        } else {
            echo $row['ser_staffid'];
        }
        echo "*reprint:" . $row['ser_bill_reprint_per'] . "*regen:" . $row['ser_bill_regen_per'] . "*change:" . $row['ser_bill_settle_change_per'] . "*kotcancel:" . $row['ser_cancelpermission'] . "*billcancel:" . $row['ser_bill_cancel_permission'] . "*dayclose:" . $row['ser_dayclose_permission'] . "*ordersplit:" . $row['ser_order_split_permission'] . "*dis_auth:" . $row['ser_discountpermission'] . "*dis_manual:" . $row['ser_discount_manual'] . "*credit:" . $row['ser_credit_permission'] . "*comp:" . $row['ser_comp_permission'] . "*" . $row['ser_staffid'];
    } else {
        echo "NO";
    }
} else if (isset($_REQUEST['set_loyalty_add_redeem']) && $_REQUEST['set_loyalty_add_redeem'] == "loyalty_add_redeem") {

    $date = date('Y-m-d H:i:s');

    $insertion['lob_billno'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['billno']));


    if ($_REQUEST['point_add'] != '') {
        $insertion['lob_point_add'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['point_add']));
    }

    if ($_REQUEST['point_redeem'] != '') {
        $insertion['lob_point_redeem'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['point_redeem']));
    }

    if ($_REQUEST['redeemamount'] != '') {
        $insertion['lob_redeem_amount'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['redeemamount']));
    }

    $insertion['lob_bill_amount'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['billamount']));

    $insertion['lob_date'] = mysqli_real_escape_string($database->DatabaseLink, trim($date));


    $insertion['lob_loyalty_customer'] = mysqli_real_escape_string($database->DatabaseLink, trim($_REQUEST['id']));

    $mode = "DI";

    $insertion['lob_mode'] = mysqli_real_escape_string($database->DatabaseLink, trim($mode));

    // echo $_REQUEST['billno'].'-'.$_REQUEST['billamount'].'-'.$_REQUEST['point_add'].'-'.$_REQUEST['point_redeem'].'-'.$_REQUEST['redeemamount'].'-'.$date.'-'.$_REQUEST['id'];

    $sql = $database->check_duplicate_entry('tbl_loyalty_pointadd_bill', $insertion);
    if ($sql != 1) {
        $insertid = $database->insert('tbl_loyalty_pointadd_bill', $insertion);
    }


    if ($_REQUEST['point_redeem'] != '') {

        $sql_loy = $database->mysqlQuery("update tbl_loyalty_reg set ly_points=(ly_points-'" . $_REQUEST['point_redeem'] . "') where ly_id='" . $_REQUEST['id'] . "'");

        $sql_loy = $database->mysqlQuery("update  tbl_tablebillmaster set bm_redeem_amount='" . $_REQUEST['redeemamount'] . "',bm_finaltotal='" . $_REQUEST['new_bill_amt'] . "' where bm_billno='" . $_REQUEST['billno'] . "'");
    }

    if ($_REQUEST['point_add'] != '') {
        $sql_loy = $database->mysqlQuery("update tbl_loyalty_reg set ly_points=(ly_points+'" . $_REQUEST['point_add'] . "'),ly_totalvisit=ly_totalvisit+1  where ly_id='" . $_REQUEST['id'] . "'");
    }

    $a = "8.8.8.8";
    exec("ping -n 1 -w 1 " . $a, $output, $result);
    if ($result == 0) {
        if ($_REQUEST['point_redeem'] != '' || $_REQUEST['point_add'] != '') {

            $sms_number = '';
            $sms_text = "";
            $be_sms_username = "";
            $be_sms_apipassword = "";
            $be_sms_senderid = "";
            $be_sms_domainid = "";
            $be_sms_method = '';
            $be_sms_priority = '';
            $sql_general = $database->mysqlQuery("Select * from tbl_generalsettings ");
            $num_general = $database->mysqlNumRows($sql_general);
            if ($num_general) {
                while ($result_general = $database->mysqlFetchArray($sql_general)) {
                    $be_sms_username = $result_general['be_sms_username'];
                    $be_sms_apipassword = $result_general['be_sms_apipassword'];
                    $be_sms_senderid = $result_general['be_sms_senderid'];
                    $be_sms_domainid = $result_general['be_sms_domainid'];
                    $be_sms_priority = $result_general['be_sms_priority'];
                    $be_sms_priority = $result_general['be_sms_priority'];
                    $be_sms_method = $result_general['be_sms_method'];
                    $be_sms_method = $result_general['be_sms_method'];
                }
            }

            if ($_REQUEST['point_redeem'] != '' && $_REQUEST['point_redeem'] > 0) {
                $rd = "You have redeemed " . number_format($_REQUEST['point_redeem'], $_SESSION('be_decimal')) . " points.";
            }


            if ($_REQUEST['point_add'] != '' && $_REQUEST['point_add'] > 0) {
                $ad = "You have earned " . number_format($_REQUEST['point_add'], $_SESSION('be_decimal')) . " points.";
            }

            $common = " (DI)Visit Again . Thank You .\n" . $_SESSION['s_branchname'];

            $l_name = $_REQUEST['loy_name'];
            $sms_text = "Congratulations " . $l_name . ".\n" . $rd . "\n" . $ad . "\n" . $common;
            $date_sms = date('Y-m-d H:i:s');

            $sql_split_insert = $database->mysqlQuery("INSERT INTO tbl_loyalty_sms_source(ls_sms_data, ls_date_sendon,ls_login_name) VALUES ('" . $sms_text . "','" . $date_sms . "','" . $_SESSION['expodine_id'] . "')");

            $sms_number = $_REQUEST['loy_number'];
            $api_password = $be_sms_apipassword;
            $smstype = $be_sms_method;
            $username = urlencode($be_sms_username);
            $sender = urlencode($be_sms_senderid);
            $message = urlencode($sms_text);
            $domain = urlencode($be_sms_domainid);
            $route = urlencode($be_sms_priority);




            $parameters = "username=$username&api_password=$api_password&sender=$sender&to=$sms_number&priority=$route&message=$message";
            if ($method == "POST") {
                $opts = array(
                    'http' => array(
                        'method' => "$method",
                        'content' => "$parameters",
                        'header' => "Accept-language: en\r\n" .
                        "Cookie: foo=bar\r\n"
                    )
                );

                $context = stream_context_create($opts);
            } else {
                $fp = fopen("http://$domain/pushsms.php?$parameters", "r");
            }

            $response = stream_get_contents($fp);
            fpassthru($fp);
            fclose($fp);
        }
    }
} else if (isset($_REQUEST['set_loyalty_bill_change']) && $_REQUEST['set_loyalty_bill_change'] == "bill_amount_change") {
    $bill_no_l = $_REQUEST['billno'];
    $new_amount = $_REQUEST['new_amount'];
    $sql_loy_nw = $database->mysqlQuery("update  tbl_tablebillmaster set bm_finaltotal='" . $new_amount . "' where bm_billno='" . $bill_no_l . "'");
} else if (isset($_REQUEST['set_loyalty_bill_change_old']) && $_REQUEST['set_loyalty_bill_change_old'] == "bill_amount_change_old") {
    $bill_no_l_old = $_REQUEST['billno_old'];
    $new_amount_old = $_REQUEST['new_amount_old'];
    $sql_loy_nw = $database->mysqlQuery("update  tbl_tablebillmaster set bm_finaltotal='" . $new_amount_old . "' where bm_billno='" . $bill_no_l_old . "'");
} else if (isset($_REQUEST['set']) && $_REQUEST['set'] == "coupon_check") {





    $code_active = '';
    $code_value = '';
    $sql_company_name = $database->mysqlQuery("select gp.gp_value,tgp.tgp_code_active   from  tbl_loyalty_group_details tgp left join tbl_loyalty_campaign_group gp on gp.gp_id=tgp.tgp_groupid left join tbl_loyalty_campaign lc on lc.lc_id=tgp.tgp_campaign_id where gp.gp_status='Y' and CURRENT_DATE() between lc.lc_from and lc.lc_to  and tgp.tgp_groupcode='" . $_REQUEST['code'] . "' ");

    $nm_company_name = $database->mysqlNumRows($sql_company_name);
    if ($nm_company_name) {
        $dataok = "Y";
        while ($result_company_name = $database->mysqlFetchArray($sql_company_name)) {

            $code_value = $result_company_name['gp_value'];
            $code_active = $result_company_name['tgp_code_active'];
        }
    }
    echo $code_value . '*' . $code_active . '*' . $dataok;
} 