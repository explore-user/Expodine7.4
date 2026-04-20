<?php
include('includes/session.php');
use Google\Client;
//if($_SESSION['db_type']=='' || !isset($_REQUEST['db_type'])){
//    
//   $_SESSION['db_type']='normal';
//    
//}

error_reporting(0);

if(isset($_REQUEST['set_year'] ) && $_REQUEST['set_year']=="set_normal" ){
   $_SESSION['db_type']='normal';
   
}

if(isset($_REQUEST['set_year'] ) && $_REQUEST['set_year']=="set_archive" ){
  $_SESSION['db_type']='archive';
}
   




if($_SESSION["archive_enabled"]=='Y'){ 
    
if($_SESSION['db_type']=='archive'){
        
     include("database.class.reports.php");
    $database	= new Database();  
}else{
     include("database.class.php"); 
     $database	= new Database();  
}
}else{
    include("database.class.php"); 
     $database	= new Database();  
}


include("api_multiplelanguage_link.php");

if(isset($_REQUEST['set'] ) && ($_REQUEST['set']=="customerdetail" )){
       
       
       $sql_ds_nos12 = "select bm_cname,bm_cnumber,bm_gst from tbl_tablebillmaster where bm_billno='".$_REQUEST['cusbillno']."'";
						$sql_ds12 = $database->mysqlQuery($sql_ds_nos12);
						$num_ds12 = $database->mysqlNumRows($sql_ds12);
						if ($num_ds12) {
							
							while ($result_ds1 = $database->mysqlFetchArray($sql_ds12)) {
                                                            
                                                            $cnm=$result_ds1['bm_cname'];
                                                             $cph=$result_ds1['bm_cnumber'];
                                                              $cgt=$result_ds1['bm_gst'];
                                                            
                                                        }
                                                        
                                                        }
                                                       if(($cnm!=$_REQUEST['csname']) || ($cph!=$_REQUEST['csphone']) || ($cgt!=$_REQUEST['csgst']) ){
       $query321=$database->mysqlQuery("  update  tbl_tablebillmaster set bm_cname='".$_REQUEST['csname']."' ,bm_cnumber='".$_REQUEST['csphone']."',bm_gst='".$_REQUEST['csgst']."' where bm_billno='".$_REQUEST['cusbillno']."' ");    
       echo 'ok';        
       }  else {
           echo 'sorry';    
       }
             
       
       }
                  
                  
if(isset($_SESSION['floorid'])){
    
$floorid=  trim(json_encode($_SESSION['floorid']),'""');

}

$other_lang=  trim(json_encode($_SESSION['main_language']),'""');

$billno="";

if(isset($_REQUEST['value'])){
    
    
if($_REQUEST['value']=="searchbill")
{
    
    $string='';
    
    if($_REQUEST['billno']!='' && $_REQUEST['billno']!='null'){
        
	$string="bm_billno like '%".$_REQUEST['billno']."%' AND ";
        
    }
    
    
    if($_REQUEST['paymode']!='' && $_REQUEST['paymode']!='null'){
        
	$string=" bm_paymode = '".$_REQUEST['paymode']."' AND " ;
        
    }
    
	
    ?>

    <table width="100%" class=" " border="0"> 
    <?php
    $sql_bilhis="select bm_paymode,bm_billno,bm_status,bm_dayclosedate  from tbl_tablebillmaster WHERE bm_billno!='' and  $string bm_dayclosedate='".$_REQUEST['date']."' and   bm_status != 'Regenerating'  ORDER BY bm_billdate,bm_billtime DESC";
   
    $sql_bilhistory  =  $database->mysqlQuery($sql_bilhis); 
    $num_bilhistory  = $database->mysqlNumRows($sql_bilhistory);
    if($num_bilhistory)
    {   $i=1;
        while($result_bilhistory  = $database->mysqlFetchArray($sql_bilhistory)) 
            { 
                $cur_date= $_SESSION['date'];
                
             ?>
        
        <tr class="bill_history_number <?php if($result_bilhistory['bm_billno']==$billno){ ?> bill_history_active <?php } ?> <?php if($result_bilhistory['bm_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?> " cur_date="<?=$cur_date?>" billdate="<?= $result_bilhistory['bm_dayclosedate'] ?>" user="<?= $_SESSION['designtnname']?>"     billno="<?=$result_bilhistory['bm_billno']?>"  cancelkey="<?= $result_bilhistory['bm_status'] ?>">
      
        <td width="15%"><strong><?=$i++?></strong></td>
        <td width="40%"><?=$result_bilhistory['bm_billno']?></td>
        <td width="25%"><?= $result_bilhistory['bm_status'] ?></td>
        
         <?php
       $paymode='';
        $sql_listall  =  $database->mysqlQuery("SELECT pym_id,pym_name from  tbl_paymentmode where pym_id='". $result_bilhistory['bm_paymode']."'  "); 
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){ $i=1;
	 while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
	 {
            
             if($row_listall['pym_name']=='Credit / Debit'){
           $paymode='Card';
             }else if($row_listall['pym_name']=='Complimentary'){
               $paymode='Complimentary';   
             }else if($row_listall['pym_name']=='Credit Types'){
               $paymode='Credit';     
             }else{
                $paymode=$row_listall['pym_name']; 
             }
             
             
             
          } } ?>
                                                
       <td width="25%"><?=$paymode?></td>
       </tr>
       
       <?php } 
       
       
        } else{ ?>
       
        <tr >
        <td width="10%"></td>
        <td style="color: darkred;font-weight: bold" width="41%">No Records</td>
        </tr>
       
      <?php } ?>
       
       
     </table> 
     <script src="js/bill_history.js"></script>
     
<?php
}
}

if(isset($_REQUEST['set']) && $_REQUEST['set']=="billwholeload")
{  
    if(isset($_REQUEST['billno'])){
	$billno=$_REQUEST['billno'];
    }
	if(isset($_REQUEST['datefield']))
	$datefield=$_REQUEST['datefield'];
	else
	$datefield=$_SESSION['date'];
	?>
     
	<table width="100%" class=" " border="0"> <!----bill_history_active--->
            
    <?php
        
    $sql_bilhis1="select bm_paymode,bm_billno,bm_status,bm_dayclosedate ,bm_bill_is_split from tbl_tablebillmaster WHERE"
    . " bm_dayclosedate='".$datefield."' AND bm_status != 'Regenerating'  ORDER BY bm_billdate,bm_billtime DESC";
    $sql_bilhistory1  =  $database->mysqlQuery($sql_bilhis1); 
    $num_bilhistory1  = $database->mysqlNumRows($sql_bilhistory1);
    if($num_bilhistory1)
    {   
        $i=1;
        while($result_bilhistory1  = $database->mysqlFetchArray($sql_bilhistory1)) 
        { 
            
            $cur_date= $_SESSION['date'];
        ?>
            
      <tr class="bill_history_number <?php if($result_bilhistory1['bm_billno']==$billno){ ?> bill_history_active <?php } ?> <?php if($result_bilhistory1['bm_status']=='Cancelled'){ ?> bill_history_cancel <?php } ?> "  cur_date="<?=$cur_date?>" billdate="<?= $result_bilhistory1['bm_dayclosedate'] ?>" user="<?= $_SESSION['designtnname']?>"   billno="<?=$result_bilhistory1['bm_billno']?>" split_check="<?=$result_bilhistory1['bm_bill_is_split']?>"   cancelkey="<?= $result_bilhistory1['bm_status'] ?>">
        <td width="15%"><strong><?=$i++?></strong></td>
        <td width="40%"><?=$result_bilhistory1['bm_billno']?></td>
        
                                             <?php if($result_bilhistory1['bm_status']=='Closed'){ ?>
                                                <td style="padding:2px"  width="25%">
                                                    <span class="closed_1">
                                                    <?=$result_bilhistory1['bm_status']?>
                                                    </span>      
                                                        
                                                </td>
                                                <?php }else{ ?>
                                                  <td width="25%"><?= $result_bilhistory1['bm_status'] ?></td>
                                                <?php } ?>
        
         <?php
         $paymode='';
        $sql_listall  =  $database->mysqlQuery("SELECT pym_id,pym_name from  tbl_paymentmode where pym_id='". $result_bilhistory1['bm_paymode']."'  "); 
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){ $i=1;
	 while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
	 {
            
            if($row_listall['pym_name']=='Credit / Debit'){
           $paymode='Card';
             }else if($row_listall['pym_name']=='Complimentary'){
               $paymode='Complimentary';   
             }else if($row_listall['pym_name']=='Credit Types'){
               $paymode='Credit';     
             }else{
                $paymode=$row_listall['pym_name']; 
             }
           
       
          } } ?>
                                                
       <td width="25%"><?=$paymode?></td>
        
       </tr>
       <?php } } ?>
       
     </table> 
     <script src="js/bill_history.js"></script>
     <?php
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=="cancelitemqty"){
    
    $cancel_id = '';
    $secretkey = '';
    $combo_qty=0;
    $combo_count=0;
    $diff_combo_qty=0;
    $new_total_menu_qty=0;
    $new_combo_menu_qty_cancelled=0;
    $combo_cancel_reason='';
    $combo_name = json_decode($_REQUEST['combo_name']);
    $itemslno = $_REQUEST['itemslno'];
    $itemqty = $_REQUEST['itemqty'];
    $reason = $_REQUEST['reason'];
    $slno = explode(',',$itemslno);
    $qty = explode(',',$itemqty);
    $rsn = explode(',',$reason);
    if(isset($_REQUEST['addonitemslno'])){
    $addonitemslno = explode(',',$_REQUEST['addonitemslno']);
     }
    if(isset($_REQUEST['addonitemqty'])){
    $addonitemqty = explode(',',$_REQUEST['addonitemqty']);
     }
    if(isset($_REQUEST['addonreason'])){
    $addonreason = explode(',',$_REQUEST['addonreason']);
     }
    if(isset($_REQUEST['addonmenus'])){
    $addonmenus = json_decode($_REQUEST['addonmenus']);
    }
    //$result->{'Liste_des_produits1'};
    
    
    if(isset($_REQUEST['addonkotno'])){
    $addonkotno = explode(',',$_REQUEST['addonkotno']);
    }
    
    if(isset($_REQUEST['stafflist'])){
        $careof = $_REQUEST['stafflist'];
    }else{
        $careof = $_SESSION['loginempid_id'];
    }
    if(isset($_REQUEST['secretkey'])){
        if(isset($_REQUEST['cancelkey'])&&$_REQUEST['cancelkey']=='Y')
            $secretkey = $_REQUEST['secretkey'];
        else
            $secretkey = md5($_REQUEST['secretkey']);
    }
    
    $mode="DI";
    
    $database->mysqlQuery("SET @branchid = " . "'" . $_SESSION['branchofid'] . "'");
    $database->mysqlQuery("SET @temp_id = " . "'" . $_SESSION['order_id'] . "'");
     $database->mysqlQuery("SET @mode = " . "'" . $mode . "'");
    $sq=$database->mysqlQuery("CALL proc_kot_cancel(@branchid,@temp_id,@mode,@cancel_id)");
    $rs = $database->mysqlQuery("SELECT @cancel_id AS cancel_id");
    $row = $database->mysqlFetchArray($rs);
    $cancel_id= $row['cancel_id'];
    echo $cancel_id;
    $dateexp=date("Y-m-d H:i:s");
    
    if(!empty($combo_name)){
        for($p=0;$p<count($combo_name);$p++){
            $combo_qty=$combo_name[$p]->combo_qty;
            $combo_count=$combo_name[$p]->combo_count;
            $combo_cancel_reason=$combo_name[$p]->reason;
            $stock_check=$combo_name[$p]->stock_check;
            $sql_combo_menu_qty_select=$database->mysqlQuery("select cod_combo_pack_id,cod_combo_pack_rate,cod_combo_qty,cod_menu_qty,cod_menu_id,cod_menu_qty FROM tbl_combo_ordering_details where cod_count_combo_ordering='".$combo_count."' and cod_orderno='".$_SESSION['order_id']."'");
            //echo "select cod_combo_pack_rate,cod_combo_qty,cod_menu_qty,cod_menu_id,cod_menu_qty FROM tbl_combo_ordering_details where cod_count_combo_ordering='".$combo_count."' and cod_orderno='".$_SESSION['order_id']."'";
            $num_combo_menu_qty_select  = $database->mysqlNumRows($sql_combo_menu_qty_select);
            if($num_combo_menu_qty_select){$ii=0;
                while($result_combo_menu_qty_select  = $database->mysqlFetchArray($sql_combo_menu_qty_select)){
                    if($combo_qty < $result_combo_menu_qty_select['cod_combo_qty']){
                        $ii++;
                        $diff_combo_qty=$result_combo_menu_qty_select['cod_combo_qty']-$combo_qty;
                        if($ii==1 && $stock_check=='Y'){
                            $sql_combo_stock_update =  $database->mysqlQuery(" UPDATE `tbl_combo_stock` SET `cs_stock_number`=cs_stock_number+'".$diff_combo_qty."' ,`cs_last_updated`=NOW() WHERE `cs_pack_id`='".$result_combo_menu_qty_select['cod_combo_pack_id']."' ");
                        }
                        $new_total_menu_qty=$combo_qty*$result_combo_menu_qty_select['cod_menu_qty'];
                        //echo "update tbl_combo_ordering_details set cod_combo_qty= '".$combo_qty."',cod_combo_total_rate= cod_combo_pack_rate*'".$combo_qty."' where cod_count_combo_ordering='".$combo_count."' and cod_menu_id='".$result_combo_menu_qty_select['cod_menu_id']."' and cod_orderno='".$_SESSION['order_id']."'";
                       
                        $sql_combo_menu_qty_update=$database->mysqlQuery("update tbl_combo_ordering_details set cod_combo_qty= '".$combo_qty."',cod_combo_total_rate= cod_combo_pack_rate*'".$combo_qty."' where cod_count_combo_ordering='".$combo_count."' and cod_menu_id='".$result_combo_menu_qty_select['cod_menu_id']."' and cod_orderno='".$_SESSION['order_id']."' ");
//                        
                        $sql_combo_table_order_select=$database->mysqlQuery("select ter_dayclosedate,ter_slno, ter_qty,ter_entrydate,ter_kotno FROM tbl_tableorder where ter_orderno='".$_SESSION['order_id']."' and ter_count_combo_ordering='".$combo_count."' and ter_menuid='".$result_combo_menu_qty_select['cod_menu_id']."'");
                        
                        $num_combo_table_order_select  = $database->mysqlNumRows($sql_combo_table_order_select);
                        
                        if($num_combo_table_order_select){$i=1;
                            $result_combo_table_order_select  = $database->mysqlFetchArray($sql_combo_table_order_select);
                            
                            $new_combo_menu_qty_cancelled=$result_combo_table_order_select['ter_qty']-$new_total_menu_qty;    
//                           
                            $combo_table_order_update=$database->mysqlQuery("update tbl_tableorder set ter_qty='".$new_total_menu_qty."',ter_cancel = 'N'  where ter_orderno='".$_SESSION['order_id']."' and ter_slno='".$result_combo_table_order_select['ter_slno']."' ");
                             
                            if($new_total_menu_qty==0){
                                $sql_combo_menu_qty_update=$database->mysqlQuery("update tbl_combo_ordering_details set cod_cancel= 'Y' where cod_count_combo_ordering='".$combo_count."' and cod_menu_id='".$result_combo_menu_qty_select['cod_menu_id']."' and cod_orderno='".$_SESSION['order_id']."' ");
                                $combo_table_order_update1=$database->mysqlQuery("update tbl_tableorder set  ter_cancel = 'Y'  where ter_orderno='".$_SESSION['order_id']."' and ter_slno='".$result_combo_table_order_select['ter_slno']."' ");
                            }
                            $combo_table_order_change_insert=$database->mysqlQuery("INSERT INTO `tbl_tableorder_changes` (`ch_kot_cancel_id`, `ch_orderno`, `ch_orderslno`, `ch_slno`, `ch_cancelled_qty`, `ch_cancelledby_careof`, `ch_entrydate`, `ch_kotno`, `ch_cancelledreason`, `ch_cancelledsecret`, `ch_cancelledlogin`, `ch_dayclosedate`,ch_combo_pack_cancelled_qty) 
                                VALUES ('$cancel_id', '".$_SESSION['order_id']."', '".$result_combo_table_order_select['ter_slno']."', '".$result_combo_table_order_select['ter_slno']."', '".$new_combo_menu_qty_cancelled."', '$careof', '".$result_combo_table_order_select['ter_entrydate']."', '".$result_combo_table_order_select['ter_kotno']."', '$combo_cancel_reason', '$secretkey', '".$_SESSION['expodine_id']."', '".$result_combo_table_order_select['ter_dayclosedate']."','".$diff_combo_qty."')");
                        }    
                    }
                }
            }    
        }
    }
    for($i=0;$i<count($slno);$i++){
        
   
        $eachqty = 0;
        $totalrate=0;
        $cncl = "N";
        $sql_qry = $database->mysqlQuery("select * from tbl_tableorder 
        where ter_orderno = '".$_SESSION['order_id']."' and ter_slno = $slno[$i] and ter_cancel ='N' order by ter_slno asc");
        $num_rows  = $database->mysqlNumRows($sql_qry);
        if($num_rows){
            $result_row  = $database->mysqlFetchArray($sql_qry);
            if($result_row['ter_qty'] != $qty[$i]){
                
                $eachqty = $result_row['ter_qty'] - $qty[$i];
                
                
                
                
                ////////stockupdate//////
          $sql_qry111 = $database->mysqlQuery("select ter_menuid,ter_portion from tbl_tableorder 
        where ter_orderno = '".$_SESSION['order_id']."' and ter_slno = $slno[$i] and ter_cancel ='N' order by ter_slno asc");
        
            $num_rows111 = $database->mysqlNumRows($sql_qry111);
              if($num_rows111){
              while($result_row111 = $database->mysqlFetchArray($sql_qry111)){
      
      
              $qty_update= $database->mysqlQuery( "UPDATE tbl_menustock SET "
              . " mk_stock_number=mk_stock_number+'".$eachqty."' "
              . " where mk_menuid= '".$result_row111['ter_menuid']."' "
              . " and mk_portion= '".$result_row111['ter_portion']."' and mk_open_stock_date='".$_SESSION['date']."' and mk_opening_stock >0 ");
      
           }
             }
         ////stockend///////
                
                
                
                
                
                
                
                
                
                
                
                
                if($qty[$i]==0){
                    
                    $cncl = "Y";
                    $database->mysqlQuery("update tbl_tableorder set ter_status = 'Cancelled',ter_qty='0',ter_total_rate='0',ter_cancel = '$cncl', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledreason = '$rsn[$i]', ter_cancelledby_careof = '$careof', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledsecretkey = '$secretkey',ter_kot_canceltime='".$dateexp."'
                    where ter_orderno = '".$_SESSION['order_id']."' and ter_addon_slno = $slno[$i]");
//                     echo "update tbl_tableorder set ter_status = 'Cancelled',ter_qty='0',ter_total_rate='0',ter_cancel = '$cncl', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledreason = '$rsn[$i]', ter_cancelledby_careof = '$careof', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledsecretkey = '$secretkey',ter_kot_canceltime='".$dateexp."'
//                    where ter_orderno = '".$_SESSION['order_id']."' and ter_addon_slno = $slno[$i]";
                    
                     
                }
                $totalrate=$qty[$i]*$result_row['ter_rate'];
                if($rsn[$i]!=0){
                    $database->mysqlQuery("update tbl_tableorder set ter_qty = $qty[$i],ter_total_rate= $totalrate, ter_cancel = '$cncl', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledreason = '$rsn[$i]', ter_cancelledby_careof = '$careof', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledsecretkey = '$secretkey',ter_kot_canceltime='".$dateexp."'
                    where ter_orderno = '".$_SESSION['order_id']."' and ter_slno = $slno[$i]");
                    
                    $database->mysqlQuery("INSERT INTO `tbl_tableorder_changes` (`ch_kot_cancel_id`, `ch_orderno`, `ch_orderslno`, `ch_slno`, `ch_cancelled_qty`, `ch_cancelledby_careof`, `ch_entrydate`, `ch_kotno`, `ch_cancelledreason`, `ch_cancelledsecret`, `ch_cancelledlogin`, `ch_dayclosedate`) 
                    VALUES ('$cancel_id', '".$_SESSION['order_id']."', '$slno[$i]', '$slno[$i]', '$eachqty', '$careof', '".$result_row['ter_entrydate']."', '".$result_row['ter_kotno']."', '$rsn[$i]', '$secretkey', '".$_SESSION['expodine_id']."', '".$result_row['ter_dayclosedate']."')");
                }  else {
                    $database->mysqlQuery("update tbl_tableorder set ter_qty = $qty[$i],ter_total_rate = $totalrate, ter_cancel = '$cncl', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledby_careof = '$careof', ter_cancelledlogin = '".$_SESSION['expodine_id']."', ter_cancelledsecretkey = '$secretkey',ter_kot_canceltime='".$dateexp."'
                    where ter_orderno = '".$_SESSION['order_id']."' and ter_slno = $slno[$i]");
                    
                    $database->mysqlQuery("INSERT INTO `tbl_tableorder_changes` (`ch_kot_cancel_id`, `ch_orderno`, `ch_orderslno`, `ch_slno`, `ch_cancelled_qty`, `ch_cancelledby_careof`, `ch_entrydate`, `ch_kotno`, `ch_cancelledsecret`, `ch_cancelledlogin`, `ch_dayclosedate`) 
                    VALUES ('$cancel_id', '".$_SESSION['order_id']."', '$slno[$i]', '$slno[$i]', '$eachqty', '$careof', '".$result_row['ter_entrydate']."', '".$result_row['ter_kotno']."', '$secretkey', '".$_SESSION['expodine_id']."', '".$result_row['ter_dayclosedate']."')");
                }
            }
        }
    
        
                }
    
     
   
    if($_SESSION['be_kot_cancellation_print']=='Y'){
        
        require_once("printer_functions.php");
        $printpage=new PrinterCommonSettings();
        $a=$printpage->print_kot_cancel($cancel_id,$_SESSION['date'],"web","1");
        $printpage->print_kot_cancel_consolidated($cancel_id,$_SESSION['date'],"web","1");
    }
    
    
    
    $sql_login_fire  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Item Cancel' "); 
	$num_login_fire   = $database->mysqlNumRows($sql_login_fire);
	if($num_login_fire){ 
	while($result_login_fire  = $database->mysqlFetchArray($sql_login_fire)) 
        { 
          $firebase_report_status=$result_login_fire['tf_active'];
        }}
    
            
       if($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on']=='Y' && $firebase_report_status=="Y" ){
           
           $data_arr='';
           $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
           
                     $sql_items="select tcrr.cr_reason,toc.ch_cancelledreason,toc.ch_cancelledby_careof,tor.ter_count_combo_ordering,um.u_name,bum.bu_name,tor.ter_unit_type,tor.ter_unit_weight,tor.ter_rate_type,tor.ter_unit_id,tor.ter_base_unit_id,mm.mr_menuname, toc.ch_cancelled_qty, pm.pm_viewinkot, pm.pm_portionname, mm.mr_menuid, kcm.kr_kotname,toc.ch_orderslno, toc.ch_kotno,toc.ch_combo_pack_cancelled_qty 
                                                                        FROM tbl_tableorder_changes toc 
                                                                        left join tbl_cancellation_reasons tcrr on tcrr.cr_id=toc.ch_cancelledreason
                                                                        left join tbl_tableorder tor on toc.ch_orderno = tor.ter_orderno and toc.ch_orderslno = tor.ter_slno
                                                                        left join tbl_menumaster mm on tor.ter_menuid = mm.mr_menuid
                                                                        left join tbl_portionmaster pm on tor.ter_portion = pm.pm_id left join tbl_unit_master um on um.u_id=tor.ter_unit_id left join tbl_base_unit_master bum on bum.bu_id=tor.ter_base_unit_id
                                                                        left join tbl_kotcountermaster as kcm on mm.mr_kotcounter = kcm.kr_kotcode
                                                                        where toc.ch_kot_cancel_id = '$cancel_id' and toc.ch_dayclosedate = '".$_SESSION['date']."' 
                                                                        order by kcm.kr_kotname,toc.ch_kotno,tor.ter_count_combo_ordering asc";

                                                                        $sql_items  =  mysqli_query($localhost,$sql_items); 
                                                                        $num_items  = mysqli_num_rows($sql_items);
                                                                        if($num_items){
                                                                            $old = '';
                                                                            $oldno = '';
                                                                            $consol_print_count=0;
                                                                            $canelmenu_slno='';
                                                                            $combo_ordering_count='';
                                                                            while($result_items  = mysqli_fetch_array($sql_items)) 
                                                                            {
                                                                                
                                                                                
                                                                                 $reason_staff='';
                                                                                 $sql_gen1 =  mysqli_query($localhost,"select ser_firstname from tbl_staffmaster where ser_staffid='".$result_items['ch_cancelledby_careof']."'"); 
                                                                                 $num_gen1  = mysqli_num_rows($sql_gen1);
                                                                                 if($num_gen1)
                                                                                 {
				                                                 while($result_invoice63  = mysqli_fetch_array($sql_gen1)) 
                                                                                 {
                                                                                $reason_staff=$result_invoice63['ser_firstname'];
                                                                                 }
                                                                                 }
                                                                                 
                                                                                $canelmenu_slno=$result_items['ch_orderslno'];
                                                                                $ct++;
                                                                                $kotcounter = $result_items['kr_kotname'];

                                                                                if($kotcounter != $old){
                                                                                    $combo_name='';
                                                                                    $oldno = '';
                                                                                    $old = $result_items['kr_kotname'];
                                                                                   
                                                                                    $kotname = '* '.$kotcounter.'  ';
                                                                                    $stln = strlen($kotname);
                                                                                    $a=0;
                                                                                    $spc = 46 - $stln;
                                                                                    for($a=0;$a<$spc;$a++){  
                                                                                        
                                                                                    }
                                                                                      $data_arr.=''.$kotname;
                                                                                    
                                                                                }else{
                                                                                    $old = $result_items['kr_kotname'];
                                                                                }

                                                                                $kotno = $result_items['ch_kotno'];
                                                                                if($kotno != $oldno){
                                                                                    $oldno = $result_items['ch_kotno'];
                                                                                   
                                                                                    $kotnumber = ' [ '.$kotno.' ] ';
                                                                                    $stln = strlen($kotnumber);
                                                                                    $a=0;
                                                                                    $spc = 44 - $stln;
                                                                                    for($a=0;$a<$spc;$a++){  
                                                                                       
                                                                                    }

                                                                                   $data_arr.='    '.$kotnumber.' \n';
                                                                                    
                                                                                }else{
                                                                                    $oldno = $result_items['ch_kotno'];
                                                                                }
                                                                                
                                                                                
                                                                                if($result_items['pm_viewinkot']=="Y"){
                                                                                $pr='('.$result_items['pm_portionname'].')';
                                                                       }else
                                                                       {
                                                                           
                                                                         $pr="";
                                                                       }
                                                                                
                                                                            if($result_items['ter_count_combo_ordering'] && $combo_ordering_count!=$result_items['ter_count_combo_ordering']){

                                                                                $combo_ordering_count=$result_items['ter_count_combo_ordering'];
                                                                                $sql_combo_heading  =  mysqli_query($localhost,"select  distinct(ter.ter_count_combo_ordering) as ter_count_combo_ordering,cn.cn_name,cp.cp_pack_name,cod.cod_combo_qty FROM tbl_tableorder ter
                                                                                                                                left join tbl_combo_ordering_details cod on cod.cod_count_combo_ordering=ter.ter_count_combo_ordering
                                                                                                                                left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                                                                                                left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id
                                                                                                                                where cod.cod_count_combo_ordering='".$combo_ordering_count."' and ter.ter_count_combo_ordering IS NOT  NULL"); 
                                                                                $num_combo_heading  = mysqli_num_rows($sql_combo_heading);
                                                                                if($num_combo_heading)
                                                                                    {
                                                                                        $result_combo_heading  = mysqli_fetch_array($sql_combo_heading);
                                                                                         $combo_name = $result_combo_heading['cn_name'].' - '. $result_combo_heading['cp_pack_name'].' (Qty:'.$result_items['ch_combo_pack_cancelled_qty'].')';

                                                                                            $data_arr.=$combo_name.' \n';
                                                                                    }

                                                                                }else{
                                                                                    $combo_name='';
                                                                                }
                                                                                
                                                                                $menu_details='';
                                                                                $menu = $result_items['ch_cancelled_qty'].' - '.$result_items['mr_menuname'];
                                                                                
                                                                                $rsn_cr='Reason : '.$result_items['cr_reason'];
                                                                                
                                                                                
                                                                                if($result_items['ter_unit_id']!="")
                                                                                    {
                                                                                    $menu_details="(".$result_items['ter_unit_type'].":".number_format($result_items['ter_unit_weight'],$decimal)." ".$result_items['u_name'].')'; 
                                                                                    }
                                                                                    else if($result_items['ter_base_unit_id']!=""){
                                                                                    $menu_details="(".$result_items['ter_unit_type'].":".number_format($result_items['ter_unit_weight'],$decimal)." ".$result_items['bu_name'].')';  
                                                                                    }
                                                                                $stln = strlen($menu);
                                                                                $a=0;
                                                                                $spc = 44 - $stln;
                                                                                 for($a=0;$a<$spc;$a++){  
                                                                                    
                                                                                   }
                                                                              	   
//                                                                             if($menu)
//										{
                                                                                   
                                                                                   
                                                                               $data_arr.=''.$menu.' \n';
                                                                               
                                                                               
                                                                               if($pr!=''){
                                                                                     $data_arr.=''.$pr.' \n';
                                                                               }
                                                                               
								             
                                                                               if($menu_details!=''){
                                                                             
                                                                                $data_arr.=''.$menu_details.' \n';
                                                                               }
                                                                               
                                                                                if($rsn_cr!=''){
                                                                             
                                                                                $data_arr.=''.$rsn_cr.' \n';
                                                                               }
                                                                                $data_arr.=' \n';
                                                                               
                                                                               
                                                                                
                                                                              $sql_addon_cancel_items="select * from tbl_order_addon_changes adc left join tbl_menumaster mm on mm.mr_menuid=adc.adc_cancel_menu where adc.adc_cancel_id='".$cancel_id."' and adc_cancel_order_slno='".$canelmenu_slno."' and adc.adc_kotno='".$result_items['ch_kotno']."' and adc.adc_dayclosedate='".$_SESSION['date']."'  group by adc.adc_kotno,adc_cancel_menu";
                                                                $sql_addon_cancel_items  =  mysqli_query($localhost,$sql_addon_cancel_items); 
                                                                        $num_addon_cancel_items  = mysqli_num_rows($sql_addon_cancel_items);
                                                                        
                                                                        if($num_addon_cancel_items){
                                                                            $consol_print_count++;
                                                                            
                                                                             $data_arr.='*****  Add-ons  *****';
                                                                          
                                                                             $kotno='';
                                                                            $stln = strlen($kot);
                                                                            $a=0;
                                                                            $spc = 46 - $stln;
                                                                            for($a=0;$a<$spc;$a++){  
                                                                                
                                                                            }

                                                                            while($result_addon_cancel_items  = mysqli_fetch_array($sql_addon_cancel_items)) 
                                                                            {
                                                                                
                                                                                $ct++;
                                                                              
                                                                                $menu_details='';
                                                                                $menu = $result_addon_cancel_items['adc_cancelled_qty'].' - '.$result_addon_cancel_items['mr_menuname'].$pr;
                                                                                
                                                                                $stln = strlen($menu);
                                                                                $a=0;
                                                                                $spc = 46 - $stln;
                                                                                 for($a=0;$a<$spc;$a++){  
                                                                                    
                                                                                         }

                                                                               if($result_addon_cancel_items['adc_kotno']!=$kotno){
                                                                                    $kotno=$result_addon_cancel_items['adc_kotno'];
                                                                                    
                                                                                   
                                                                                     $data_arr.='     '.$kotno;
                                                                                }
                                                                             if($menu)
										{
							          
								      
                                                                          $data_arr.='     '.$menu_details;
                                                                        if($menu_details!=''){
                                                                       
                                                                       
                                                                        $data_arr.='     '.$menu_details;
                                                                        }
                                                                         
										}	
                                                                            }
                                                                            
                                                                        }
                                                                                }
                                                                        
                                                                         $date_new=date('Y-m-d h:i:s');
                                                                     
                                                                       $data_arr.='KOT Cancelled By : '.$reason_staff.' \n'; 
                                                                         $data_arr.='Cancelled Time : '.$date_new.' \n'; 
                                                                         $data_arr.='MODE - DINE IN' ;         
                                                                        }
           
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
    ///pushing msg///
    $branch_id_fire=$_SESSION['firebase_id'];
    
    require 'vendor/autoload.php';
    //putenv('GOOGLE_APPLICATION_CREDENTIALS=C:\Apache24\htdocs\expodine\src\service_google.json');
    $client = new Client();
    $client->setAuthConfig('service_google.json'); // Replace with your file path
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $accessToken = $client->fetchAccessTokenWithAssertion()['access_token'];

   $url = "https://fcm.googleapis.com/v1/projects/ed-reports-b5f94/messages:send";
   $body = $data_arr;
   $projectId = 'ed-reports-b5f94'; 
 
     $data = [
    'message' => [
       "topic"=> $branch_id_fire,
        'notification' => [
            'title' => 'DI Item Cancel',
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
    
    
    
    
    
//    $url = "https://fcm.googleapis.com/fcm/send";
//   //$token ='dFCy-onTEvQ:APA91bGXAQobatT-sbeLk3QTFdh-Zf10Z7dzmUIO99GHDjkrmwWwvzA7poh5dbAv55B7KrFKAQtpDwkJgo9lgwxFUC0W_RrnI1ohd7c-IJJfuCTeSSdhyKowMEKwOYZk5met5QhnCx0T';
//    $serverKey = 'AIzaSyD3zn_tP2RqeVSMsEFMJnrcZk5AuNGru-M';
//    $title = $_SESSION['s_branchname']."  - DI ITEM CANCELLED ";
//    
//    $body = $data_arr;
//    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1', 'click_action' =>'notification');
//    $arrayToSend = array('to' => "/topics/$branch_id_fire" , 'notification' => $notification,'priority'=>'high');
//    $json = json_encode($arrayToSend);
//    $headers = array();
//    $headers[] = 'Content-Type: application/json';
//    $headers[] = 'Authorization: key='. $serverKey;
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
//    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
//    //Send the request
//    $response = curl_exec($ch);
//    //Close request
//    if ($response === FALSE) {
//    die('FCM Send Error: ' . curl_error($ch));
//    }
//    curl_close($ch);
    
    //to database storage of msg//
    $data_to_firebase=urlencode($body);
    $url = $_SESSION['firebase_url']."api/post_notification?branhcid=$branch_id_fire&notification=$data_to_firebase";
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    //var_dump($result);

        }
}
    
    
}

else if(isset($_REQUEST['set']) && $_REQUEST['set']=="billdetailsset1")
{
    
   
    $billhistory_billno=$_REQUEST['billno'];
    $kot_nos=array();
    $combo_entry_count=array();
    $combo_qty=0;
    $slno=0; $dis_bill=0;$dis_bill_per=0;
     $i=0;  $bill_gen=''; $bank_id=''; $bm_lukado_response='';
      $amount_sum=0;
                    $sql_billhistory_qry = $database->mysqlQuery("select bm_lukado_response, bm_floorid,bm_transcbank,bm_dayclosedate,
                        bm_tips_given,bm_orderno,bm_customer_display_status,bm_discountvalue,bm_discountlabel,
                        sm.ser_firstname as steward,sm1.ser_firstname as cancelledcareoff,bm_paymode,bm_lastprintime,bm_cname,
                        bm_cnumber,bm_gst,bm_tableno,bm_bill_ref,bm_billdate,bm_billtime,bm_status,bm_finaltotal,bm_amountpaid,
                        bm_amountbalace,bm_transactionamount,ter_cancelledreason,ter_cancelledlogin,ter_cancelledby_careof,
                        bm_bill_printed_by,bm_billprinted from tbl_tablebillmaster 
                                                    left join tbl_staffmaster sm on sm.ser_staffid =bm_steward
                                                    left join tbl_staffmaster sm1 on sm1.ser_staffid =ter_cancelledby_careof
                                                    where bm_billno = '".$billhistory_billno."' ");
                        
                    
                  
                    
                   $num_billhistory_rows  = $database->mysqlNumRows($sql_billhistory_qry);
                   if($num_billhistory_rows){
                       $result_billhistory_row  = $database->mysqlFetchArray($sql_billhistory_qry);
                      
                               $billhistory_paymode_selcted =$result_billhistory_row['bm_paymode'];
                               $bill_cus_sts=$result_billhistory_row['bm_customer_display_status'];
                               $billhistory_bill_tableno =$result_billhistory_row['bm_tableno'];
                               $billhistory_bill_ref =$result_billhistory_row['bm_bill_ref'];
                               $billhistory_bill_date =$result_billhistory_row['bm_billdate'].' '.$result_billhistory_row['bm_billtime'];
                               $billhistory_bill_status =$result_billhistory_row['bm_status'];
                                $billhistory_bill_dayclosedate =$result_billhistory_row['bm_dayclosedate'];
                               $billhistroy_bill_finaltotal=number_format(str_replace(',','',$result_billhistory_row['bm_finaltotal']),$_SESSION['be_decimal']);
                               $billhistroy_bill_amountpaid=number_format(str_replace(',','',$result_billhistory_row['bm_amountpaid']),$_SESSION['be_decimal']);
                               $billhistroy_bill_amountbalance=number_format(str_replace(',','',$result_billhistory_row['bm_amountbalace']),$_SESSION['be_decimal']);
                               $billhistroy_bill_amountcard=number_format(str_replace(',','',$result_billhistory_row['bm_transactionamount']),$_SESSION['be_decimal']);
                               $cancel_reason=$result_billhistory_row['ter_cancelledreason'];
                               $orderno=$result_billhistory_row['bm_orderno'];
                               $cancelled_login=$result_billhistory_row['ter_cancelledlogin'];
                               $cancel_careof=$result_billhistory_row['cancelledcareoff'];
                               $bill_first_printed=$result_billhistory_row['bm_bill_printed_by'];
                               $bm_lukado_response=$result_billhistory_row['bm_lukado_response'];
                               $bank_id=$result_billhistory_row['bm_transcbank'];
                               $tip_amount=number_format(str_replace(',','',$result_billhistory_row['bm_tips_given']),$_SESSION['be_decimal']);
                               if($result_billhistory_row['bm_billprinted']=='Y'){
                               $bill_printed='Yes';
                               }else{
                                 $bill_printed='No';  
                               }
                               
                               $dis_bill=$result_billhistory_row['bm_discountvalue'];
                               $dis_bill_per=$result_billhistory_row['bm_discountlabel']; 
                               
                               
   $sql_branch =  mysqli_query($localhost,"Select ter_entryuser from tbl_tableorder where ter_billnumber='$billhistory_billno'"); 
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $bill_gen=$result_branch['ter_entryuser'];
					}
		  }
             
                  
                $bankname='';    
           
                $sql_branch1 =  mysqli_query($localhost,"Select bm.bm_name from tbl_bankmaster bm left join tbl_bill_card_payments "
                . " bc on bc.mc_to_bank=bm.bm_id  where  mc_billno='$billhistory_billno' group by bc.mc_to_bank "); 
		  $num_branch1  = mysqli_num_rows($sql_branch1);
		  if($num_branch1)
		  {
				while($result_branch1  = mysqli_fetch_array($sql_branch1)) 
					{
						 $bankname.= $result_branch1['bm_name'].',';
					}
		  }    
                  
                  
                   $sql_branch12 =  mysqli_query($localhost,"Select fr_floorname from tbl_floormaster where fr_floorid='".$result_billhistory_row['bm_floorid']."' "); 
		  $num_branch12  = mysqli_num_rows($sql_branch12);
		  if($num_branch12)
		  {
				while($result_branch12  = mysqli_fetch_array($sql_branch12)) 
					{
						 $floor_di_bill=$result_branch12['fr_floorname'];
					}
		  }    
                  
                  
                  
                  
                  
                  
   ?>


                        
     <div class="container">
    <div class="row">
        <div class="col-xs-12">
    		
    		
    		<div class="row" style="    padding-top: 5px;">
    		<div class="col-xs-6">
    				<address style="text-align: left">
    				<strong>Steward :<?=$result_billhistory_row['steward']?></strong><br>
    				<strong>Dine In</strong><br>
    				<strong>Bill :<span><?=$billhistory_billno?></span></strong><br>
    				<strong>Table :<span><?=$billhistory_bill_tableno?></span> &  Floor : <?=$floor_di_bill?>	</strong><br>
                                <strong>Bill Printed By: <span><?=$bill_first_printed?></span></strong><br>
                                <strong>Customer Status: <span><?=$bill_cus_sts?></span></strong><br>
                                <?php if($bm_lukado_response!='' && $bm_lukado_response!='NULL'){ 
                                    
                                 if (strpos($bm_lukado_response,'success') !== false) { 
                                 ?>
                                
                                 <strong>Lukado: <span>Success</strong>
                                
                                 <?php }else{ ?>
                                
                                 <strong>Lukado : <span>Error</strong>
                                
                                 <?php } } ?>
                                
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address style="text-align: right">
        			<strong>REF NO :<span><?=$billhistory_bill_ref?></span></strong><br>
    				<strong>Time :<span><?=$billhistory_bill_date?></span></strong>	<br>
    				<strong>Last Print :<span><?=$result_billhistory_row['bm_lastprintime']?></span></strong>	<br>
                                <strong style="font-size: 17px;color: #f00">Status :<span><?=$billhistory_bill_status?></span></strong>	<br>
    				<strong>Bill Printed: <span><?=$bill_printed?></span></strong><br>
                                <strong>Bill Generated By: <span><?=$bill_gen?></span></strong>
                                </address>
    			</div>
    			
    		</div>
    		
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			
    			<div class="panel-body">
    				<div class="table-responsive">
                                    
                                <?php 
                                
                                
                                $otherlang='';
		  $sql_branch =  mysqli_query($localhost,"Select * from tbl_branch_settings_printer where bp_branchid='1'"); 
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $otherlang=$result_branch['bp_item_other_lang'];
					}
		  }
                    ?>            
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <td width="40%"><strong>PRODUCT</strong></td>
                                                    <td width="10%" class="text-center"><strong>QTY</strong></td>
                                                    <td width="15%" class="text-center"><strong>RATE</strong></td>
                                                    <td width="20%" class="text-right"><strong>AMOUNT</strong></td>
                                                   
                                                     <td width="15%" class="text-right"><strong>EDIT</strong></td>
                                                </tr>
                                            </thead>
					</table>
                                        <div class="item_table_scr">
                                            <table class="table table-condensed">
                                            <tbody class="bill_scroll_tbl">
                  
                 <?php 
                  $sql_combo_list  =  $database->mysqlQuery("select distinct(cbd.cbd_count_combo_ordering) as cbd_count_combo_ordering,cbd.cbd_combo_id, cbd.cbd_combo_pack_rate, cbd.cbd_combo_total_rate, cbd.cbd_combo_qty, cn.cn_name,cp.cp_pack_name   FROM tbl_combo_bill_details cbd
                                                            left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                            left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                            where cbd.cbd_billno='".$billhistory_billno."' order by cbd.cbd_count_combo_ordering asc "); 
				$num_combo_list  = $database->mysqlNumRows($sql_combo_list);
				if($num_combo_list){
                                    while($result_combo_list  = $database->mysqlFetchArray($sql_combo_list)) 
                                    {   $slno++;  
                                        $combo_menu_array=array();
                                        if(!in_array($result_combo_list['cbd_count_combo_ordering'],$combo_entry_count)){
                                            $combo_entry_count[]=$result_combo_list['cbd_count_combo_ordering'];
                                            $amount_sum=$amount_sum+$result_combo_list['cbd_combo_total_rate'];
                                              $combo_qty=$combo_qty+$result_combo_list['cbd_combo_qty'];                 
                                            $sql_combomenu_list  =  $database->mysqlQuery("select mm.mr_menuname  FROM tbl_combo_bill_details cbd
                                                               left join tbl_menumaster mm on mm.mr_menuid=cbd.cbd_menu_id
                                                               where cbd.cbd_count_combo_ordering='".$result_combo_list['cbd_count_combo_ordering']."' and cbd.cbd_billno='".$billhistory_billno."'");
                                                               $num_combomenu_list  = $database->mysqlNumRows($sql_combomenu_list);
                                                                if($num_combomenu_list){
                                                                    while($result_combomenu_list  = $database->mysqlFetchArray($sql_combomenu_list)) 
                                                                        {
                                                                        $combo_menu_array[]=$result_combomenu_list['mr_menuname'];
                                                                        }
                                                                }
                                        ?>
                                        <tr>
                                            
                                            <td width="40%"><span style="color: #f00">(Combo) </span>
                                                <?=$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']?>
                                                <span class="combo_tbl_lst"><?=implode(',',array_unique($combo_menu_array));?></span>
                                            </td>
                                            <td width="10%" class="text-center"><?= $result_combo_list['cbd_combo_qty'] ?></td>
                                            <td width="15%" class="text-center"><?=number_format($result_combo_list['cbd_combo_pack_rate'],$_SESSION['be_decimal'])?></td>
                                            <td width="20%" class="text-right"><?=number_format($result_combo_list['cbd_combo_total_rate'],$_SESSION['be_decimal'])?></td>
                                          
                                            <td style="text-align:right"  width="15%"><a href="#" style="margin:2px 0 0 2px" class="tab_edt_btn"></a>.</td>
                                            
                                        </tr>
                                        
                                        
                                        
                                        <?php
                                                  $sql_b= $database->mysqlQuery("select cod_combo_preference  FROM  tbl_combo_ordering_details where  cod_count_combo_ordering='".$result_combo_list['cbd_count_combo_ordering']."' and cod_combo_id='".$result_combo_list['cbd_combo_id']."' ");    
                                                        $num_b  = $database->mysqlNumRows($sql_b);
                                                       $result_b  = $database->mysqlFetchArray($sql_b);
                                                 
                                                 
                                                 if($result_b['cod_combo_preference']!=''){
                                                   ?>
                                                   <tr>
                                                     <td colspan="5" style="text-transform: lowercase">
                                                   Pref :  <?=$result_b['cod_combo_preference']?> 
                                                     </td>
                                                   </tr>
                                                 <?php } ?>
                                        
                                        
                                        
                                        
                                        
                                        <?php
                                            }
                                        }
                                    }
                                    
                  $sql_rep = $database->mysqlQuery("select bd.bd_billslno,bd.bd_menuid,bd.bd_bill_addon_slno,bd.bd_rate_type,bd.bd_unit_type,
                      bd.bd_portion,bd.bd_unit_weight,bd.bd_unit_id,bd.bd_base_unit_id,bd.bd_rate,sum(bd.bd_qty) as bd_qty,sum(bd.bd_amount) as bd_amount,
                      bd.bd_bill_addon_slno,
                  mm.mr_menuname,mm.mr_itemshortcode FROM tbl_tablebilldetails bd  left join tbl_menumaster mm on mm.mr_menuid=bd.bd_menuid  
                  where bd.bd_billno='".$billhistory_billno."' group by bd.bd_menuid,bd.bd_rate ");

                                    $num_rep  = $database->mysqlNumRows($sql_rep);
                                    if($num_rep){ $item_count_replace=0;
                                    
                                    while($result_rep  = $database->mysqlFetchArray($sql_rep)){
                                        $item_count_replace++;
                                    }
                                    }
                                    
                  
                  $sql_billhistory_billdetails_qry = $database->mysqlQuery("select bd.bd_billslno,bd.bd_menuid,bd.bd_bill_addon_slno,bd.bd_rate_type,
                      bd.bd_unit_type,
                      bd.bd_portion,bd.bd_unit_weight,bd.bd_unit_id,bd.bd_base_unit_id,bd.bd_rate,sum(bd.bd_qty) as bd_qty,sum(bd.bd_amount) as bd_amount,
                      bd.bd_bill_addon_slno,
                      mm.mr_menuname,mm.mr_itemshortcode FROM tbl_tablebilldetails bd  left join tbl_menumaster mm on mm.mr_menuid=bd.bd_menuid
                      where bd.bd_billno='".$billhistory_billno."' group by bd.bd_menuid,bd.bd_rate ");

                                    $num_billhistory_billdetails_rows  = $database->mysqlNumRows($sql_billhistory_billdetails_qry);
                                    if($num_billhistory_billdetails_rows){
                                        
                                
                                    $portion='';
                                    $unit='';
                                   
                                   
                                    while($result_billhistory_billdetails_row  = $database->mysqlFetchArray($sql_billhistory_billdetails_qry)){
                                        $i++;
                                        
                                         $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
                                         $itemotherlangname='';
                                        if($otherlang=="Y"){
									  mysqli_query($localhost,"SET NAMES 'utf8'");
									  mysqli_query($localhost,'SET CHARACTER SET utf8');
									  $sql_othlamg  =  mysqli_query($localhost,"Select lm_menu_print from tbl_language_menu_master  Where lm_menu_id='".$result_billhistory_billdetails_row['bd_menuid']."' AND lm_language_id='2'");
									  $num_othlamg  = mysqli_num_rows($sql_othlamg);
									  if($num_othlamg)
									  {
											  while($result_othlamg  = mysqli_fetch_array($sql_othlamg)) 
											  {
												$itemotherlangname=($result_othlamg['lm_menu_print']);
											  }
									  }
                            	                                     
                                        }
                                        
                                        
                                        
                                        if($result_billhistory_billdetails_row['bd_rate_type']=='Portion'){
                                            $sql_portion_billhistory= $database->mysqlQuery("select pm_portionshortcode FROM tbl_portionmaster where pm_id='".$result_billhistory_billdetails_row['bd_portion']."'");
                                            $num_portion_billhistory  = $database->mysqlNumRows($sql_portion_billhistory);
                                            $result_portion_billhistory  = $database->mysqlFetchArray($sql_portion_billhistory);
                                            $portion="(".$result_portion_billhistory['pm_portionshortcode'].")";
                                            $unit='';
                                        }
                                        else{
                                                if($result_billhistory_billdetails_row['bd_unit_type']=='Packet'){ 
                                                        $sql_unit_billhistory= $database->mysqlQuery(" select u_name FROM tbl_unit_master  where u_id='".$result_billhistory_billdetails_row['bd_unit_id']."' ");
                                                        $num_unit_billhistory  = $database->mysqlNumRows($sql_unit_billhistory);
                                                        $result_unit_billhistory  = $database->mysqlFetchArray($sql_unit_billhistory);
                                                        
                                                        $portion='';
                                                        $unit=number_format($result_billhistory_billdetails_row['bd_unit_weight'],$_SESSION['be_decimal']).' '.$result_unit_billhistory['u_name'];
                                                        
                                                }
                                                else{
                                                    $sql_baseunit_billhistory= $database->mysqlQuery("select bu_name FROM tbl_base_unit_master where bu_id='".$result_billhistory_billdetails_row['bd_base_unit_id']."'");
                                                    $num_baseunit_billhistory  = $database->mysqlNumRows($sql_baseunit_billhistory);
                                                    $result_baseunit_billhistory  = $database->mysqlFetchArray($sql_baseunit_billhistory);
                                                
                                                    $portion='';
                                                     $unit=number_format($result_billhistory_billdetails_row['bd_unit_weight'],$_SESSION['be_decimal']).' '.$result_baseunit_billhistory['bu_name'];
                                                }
                                        }
                                        
                                       $amount_sum=$amount_sum+$result_billhistory_billdetails_row['bd_amount'];
                                        
                                       $dyn='';
                                       $sql_combomenu_list  =  $database->mysqlQuery("select ter_dynamic_rate from tbl_tableorder where "
        .                              " ter_billnumber='".$billhistory_billno."' and ter_menuid='".$result_billhistory_billdetails_row['bd_menuid']."' ");
                                       $num_combomenu_list  = $database->mysqlNumRows($sql_combomenu_list);
                                       if($num_combomenu_list){
                                        while($result_combomenu_list  = $database->mysqlFetchArray($sql_combomenu_list)) 
                                        {   
                                          if($result_combomenu_list['ter_dynamic_rate']=='Y'){
                                               $dyn=' [Dyn]';
                                          }
                                        }
                                       }
                                       ?>
                                                
                                                <tr>
                                                    <td width="40%">
                                                        <?php if($result_billhistory_billdetails_row['bd_bill_addon_slno']!='') { ?>
                                                        <span style="color: #f00">(AD) </span>
                                                        <?php } ?>
                                                                <?=$result_billhistory_billdetails_row['mr_itemshortcode'].$portion.$dyn?>
                                                        <span class="bill_histo_gram"><?=$unit?></span><br>
                                                         <span><?=$itemotherlangname?></span>
                                                    </td>
                                                   
                                                    <td width="10%" class="text-center"><?=$result_billhistory_billdetails_row['bd_qty']?></td>
                                                    <td width="15%" class="text-center"><?=number_format($result_billhistory_billdetails_row['bd_rate'],$_SESSION['be_decimal'])?></td>
                                                    <td width="20%" class="text-right"><?=number_format($result_billhistory_billdetails_row['bd_amount'],$_SESSION['be_decimal'])?></td>
                                                  
                                                <?php if($_SESSION['bill_edit']=='Y'){ ?>
                                                    
                                                    <td width="15%" style="text-align:right" >
                                                <a onclick="return delete_bill_item_normal('<?=$billhistory_billno?>','<?=$result_billhistory_billdetails_row['bd_billslno'] ?>','<?=$billhistory_bill_status?>');" href="#" style="margin:2px 0 0 2px" class="tab_edt_btn"><img src="img/red_cross.png" width="25px" height="25px"></a>
                                               
                                                 <?php if($item_count_replace==1){ ?>
                                                 <a onclick="return replace_bill_item('<?=$billhistory_billno?>','<?=$result_billhistory_billdetails_row['bd_billslno'] ?>','<?=$billhistory_bill_status?>');" href="#" style="margin:2px 0 0 2px" class="tab_edt_btn"><img src="img/refresh.png" width="25px" height="25px"></a>
                                                  <?php }   ?>
                                                 </td>
                                                    
                                                 <?php }  ?>
                                                 
                                                 </tr>
                                                
                                                
                                                
                                                    
                                                <?php
                                                  $sql_b= $database->mysqlQuery("select ter_preferencetext  FROM  tbl_tableorder where  ter_billnumber='".$billhistory_billno."' and ter_menuid='".$result_billhistory_billdetails_row['bd_menuid']."' ");    
                                                        $num_b  = $database->mysqlNumRows($sql_b);
                                                       $result_b  = $database->mysqlFetchArray($sql_b);
                                                 
                                                 
                                                 if($result_b['ter_preferencetext']!=''){
                                                   ?>
                                                   <tr>
                                                     <td colspan="5" style="">
                                                   * Pref :  <?=$result_b['ter_preferencetext']?> 
                                                     </td>
                                                   </tr>
                                                 <?php } ?>
                                                 
                                               
                                                 
                                                 
                                                
                                    <?php }} ?>
						</table>
						</div>
                                    <input type="hidden" name="bill_paymode" id="bill_paymode" value="<?=$result_billhistory_row['bm_paymode']?>">
                                                    <table class="table table-condensed">
    							
    							<tbody>
    							<tr>
    								<td  class="thick-line">Total Item - <?=$i+$slno?> </td>
    								<td  class="thick-line"></td>
    								<td  class="thick-line text-right">Total</td>
    								<td  class="thick-line text-right"><?=number_format(str_replace(',','',$amount_sum),$_SESSION['be_decimal'])?></td>
    							</tr>
                                                       <?php if($dis_bill>0){ ?>  
                                                        <tr>
    								<td  class="thick-line">Discount &nbsp;  <?=$dis_bill_per?>  </td>
    								<td  class="thick-line"></td>
    								<td  class="thick-line text-right"></td>
                                                                <td  class="thick-line text-right">    <?=number_format(str_replace(',','',$dis_bill),$_SESSION['be_decimal'])?></td>
    							</tr>
                                                       <?php } ?>
                                                        
                                                        <?php
                                                        $sql_billhistory_billtax = $database->mysqlQuery("select   bem_label, bem_total_value FROM  tbl_tablebill_extra_tax_master where  bem_billno='".$billhistory_billno."'");    
                                                        $num_billhistory_billtax  = $database->mysqlNumRows($sql_billhistory_billtax);
                                                            if($num_billhistory_billtax){
                                                                while($result_billhistory_billtax  = $database->mysqlFetchArray($sql_billhistory_billtax)){
                                                        ?>
    							<tr>
    								<td  class="thick-line"><?=$result_billhistory_billtax['bem_label']?></td>
    								<td  class="thick-line"></td>
    								<td  class="thick-line text-right"></td>
    								<td  class="thick-line text-right"><?=number_format(str_replace(',','',$result_billhistory_billtax['bem_total_value']),$_SESSION['be_decimal'])?></td>
    							</tr>
                                                        <?php 
                                                                }
                                                            }
                                                        ?>
    							
    							<tr>
    								<td class="thick-line"><strong>TOTAL PAYABLE</strong></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"></td>
    								<td class="thick-line text-right"><strong id="grand_total"><?=$billhistroy_bill_finaltotal?></strong></td>
    							</tr>
                                                        <?php if($billhistroy_bill_amountpaid>0){ ?>
    							<tr>
    								<td class="no-line"><strong>PAID CASH</strong></td>
    								<td class="no-line"></div> </td>
    								<td class="no-line text-center"></td>
    								<td class="no-line text-right"><strong><?=$billhistroy_bill_amountpaid?></strong></td>
    							</tr>
                                                        <?php }
                                                        
                                                       
                                                        if($billhistroy_bill_amountcard>0){
                                                            ?>
                                                        
                                                        <tr>
                                                            <td class="no-line"><strong>PAID CARD [ <?=substr($bankname,0,-1)?> ]</strong></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"></td>
    								<td class="no-line text-right"><strong><?=$billhistroy_bill_amountcard?></strong></td>
    							</tr>
                                                        <?php }
                                                        if($billhistroy_bill_amountpaid>0 || $billhistroy_bill_amountcard>0){
                                                            ?>
                                                        
    							<tr>
    								<td class="no-line"><strong>BALANCE</strong></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"></td>
    								<td class="no-line text-right"><strong><?=$billhistroy_bill_amountbalance?></strong></td>
    							</tr>
                                                        <?php }
                                                        ?>
                                                        
                                                        
                                                       <?php if($billhistory_paymode_selcted=='6'){  ?>
                                                        <tr>
                                                            <td class="no-line"><strong style="color:#b55a5a">[CREDIT BILL]</strong></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"></td>
    								<td class="no-line text-right"><strong><?=($billhistroy_bill_finaltotal-$billhistroy_bill_amountpaid)?></strong></td>
    							</tr>
                                                        <?php }  ?>
                                                       
                                                        
                                                        <?php  if($billhistory_paymode_selcted=='7'){  ?>
                                                        <tr>
    								<td class="no-line"><strong style="color:#b55a5a">[COMPLIMENTARY BILL]</strong></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"></td>
    								<td class="no-line text-right"><strong></strong></td>
    							</tr>
                                                        <?php }  ?>
                                                        
                                                        
                                                        <tr>
                                                            <td class="no-line"><strong>**TIP</strong></td>
                                                            <td class="no-line"></td>
                                                           
                                                            <td colspan="2" class="no-line text-right">
                                                                <a href="#"  class="<?php if(($billhistory_bill_status!='Cancelled') && ($billhistory_bill_dayclosedate==$_SESSION['date']) ) { ?> tip_add_button <?php } ?> input_tip_btn"><span class="history-sub-btn">ADD TIP </span></a>
                                                                <input class="input_tip_textbox" type="text" onkeypress="return charlimit(event,this.value)" value="<?=$tip_amount?>" id="tip_feild" <?php if( ($billhistory_bill_status=='Cancelled') || ($billhistory_bill_dayclosedate !=$_SESSION['date'])) { ?> readonly <?php } ?> style="width: 28%;float: right">
                                                                <select class="tax_textbox transa_txt counter_text_box" id="tip_pay_mode" style="width: 22%;float: right;margin-right: 5px">
                                                                    <option value="C">CASH</option>
                                                                    <option value="D">CARD</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
    				</div>
    				
    				
    			</div>
    			
    		</div>
    		
    	</div>
    </div>
    <div class="bill_his_order_btm_detail">
        
        <?php 
        $sql_billhistory_kot = $database->mysqlQuery("select  distinct(ter_kotno) as kot FROM tbl_tableorder left join tbl_tablebillmaster "
        . "  on tbl_tableorder.ter_orderno  in($orderno) where bm_billno = '".$billhistory_billno."' ");
                   
                   $num_billhistory_kot  = $database->mysqlNumRows($sql_billhistory_kot);
                   if($num_billhistory_kot){$kotno='';
                       while( $result_billhistory_kot  = $database->mysqlFetchArray($sql_billhistory_kot)){
    	              $kot_nos[]=$result_billhistory_kot['kot'];
                    }
                   }
                   $kotno=implode(',',$kot_nos);
        ?>                      
                       <div class="col-xs-12" style="padding-left: 5px;font-size: 12px">
    			<address style="text-align: left">
    			<strong>KOT : <span><?=implode(',',$kot_nos) .' | ORD NO : '.$orderno?></span>	</strong>
    			</address>
		</div>
        
		  <?php 
                
                  $cancelreason=array();
                
                  $sql_billhistory_cancelreason = $database->mysqlQuery("select distinct(cr_reason) as reason,ser_firstname,ter_cancelledlogin FROM
                  tbl_cancellation_reasons
                  left join tbl_tablebillmaster  on ter_cancelledreason= cr_id left join tbl_staffmaster on ser_staffid =ter_cancelledby_careof
                  WHERE cr_id in('".$cancel_reason."')");
                    
                   $num_billhistory_cancelreason  = $database->mysqlNumRows($sql_billhistory_cancelreason);
                   if($num_billhistory_cancelreason){
                      while( $result_billhistory_cancelreason  = $database->mysqlFetchArray($sql_billhistory_cancelreason)){
                          
    	              $cancelreason[]=$result_billhistory_cancelreason['reason'];
                      
                    }
                   }
                   
           if($cancelreason){ 
               
           ?>        
        
    	   <div class="bill_his_order_btm_detail" style="padding-left: 5px">
    		<span style="padding-left: 0;top: -4px" class="bill_story_center_top_txt">Bill Cancel Reason :</span>
    		<span style="width: auto;height:auto;padding-left: 0;color: #D15151" class="bill_story_center_txt"><?=implode(',',array_unique($cancelreason))?></span>
		</div>
           <?php } 
        
        if($billhistory_bill_status=='Cancelled'){     
            
        ?>   
        
    	<div class="bill_his_order_btm_detail" style="padding-left: 5px">
    		<span style="padding-left: 0;top: -4px" class="bill_story_center_top_txt"> Cancelled Login :</span>
    		<span style="width: auto;height:auto;padding-left: 0;color: #D15151" class="bill_story_center_txt"><?=$cancelled_login?></span>
	</div>
        
        <div class="bill_his_order_btm_detail" style="padding-left: 5px">
    		<span style="padding-left: 0;top: -4px" class="bill_story_center_top_txt">Cancelled Careof:</span>
    		<span style="width: auto;height:auto;padding-left: 0;color: #D15151" class="bill_story_center_txt"><?=$cancel_careof?></span>
	</div>
        
        
        <?php } ?>
        
        
        <div class="bill_history_tax_btm_cc">
        
		<div class="col-xs-11 no-padding">
			<div class="col-xs-4" style="padding-left: 0">
				<span class="bill_story_center_top_txt">Customer Name:</span>
				 <input type="hidden" id="bilcus" value="<?=$billhistory_billno?>" >
				 <input type="text" class="bill_story_center_txt bill_his_textbox" id="csname" value="<?=$result_billhistory_row['bm_cname']?>">
			</div>
			<div class="col-xs-4" style="padding-left: 0">
				<span class="bill_story_center_top_txt">Number:</span>
				<input type="text" class="bill_story_center_txt bill_his_textbox" id="csphone" onkeypress="return numonly();" value="<?=$result_billhistory_row['bm_cnumber']?>">
			</div>
			<div class="col-xs-4" style="padding-left: 0">
				<span class="bill_story_center_top_txt">GST/TRN/VAT</span>
				<input type="text" class="bill_story_center_txt bill_his_textbox" id="csgst" value="<?=$result_billhistory_row['bm_gst']?>">
			</div>
		</div>
		<div class="col-xs-1 no-padding">
			<a href="#" onclick="return submitcustomer();"><span class="history-sub-btn"><img src="img/attendence_mn_ico.png"></span></a>
		</div>
       </div>
	</div>
     
     
    <script>
         
    $('.tip_add_button').click(function (){
         
            $('.kotcancel_reason_popup_new').css('display','block');
            $('.confrmation_overlay').css('display','block');
            $('#authcodersn').css('display','none');
            $('#kotcancel_reason_popup_new_proceed_btn').addClass('tip_click');
            $('#pin').focus();
            $('#rprntmode').val('');
             
    });
     
    </script>
     
    <?php  
    
    }
	
}else if(isset($_REQUEST['set']) && $_REQUEST['set']=="billdetailsset2")
{
	 if(isset($_REQUEST['billno'])){
            $billno=$_REQUEST['billno'];
         }
         
	 $total=0;
	 $sql_listall  =  $database->mysqlQuery("SELECT *,mn.mr_menuname,pm.pm_portionname from tbl_tablebilldetails as td LEFT JOIN tbl_menumaster "
         . " as mn ON td.bd_menuid=mn.mr_menuid LEFT JOIN tbl_portionmaster as pm ON td.bd_portion=pm.pm_id left join tbl_unit_master um on "
         . " um.u_id=td.bd_unit_id left join tbl_base_unit_master bum on bum.bu_id=td.bd_base_unit_id WHERE td.bd_billno='".$billno."' order by "
         . " td.bd_billslno "); 
	 $num_listall  = $database->mysqlNumRows($sql_listall);
	 if($num_listall){ $i=1;
		  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
			  {
				 $total=$total + $row_listall['bd_amount'];
				 $ids="pm_".$row_listall['bd_portion'];
                                 
                                    $billhis_menuid=$row_listall['bd_menuid'];
                                    $billhis_menu=$row_listall['mr_menuname'];
                                    if($_SESSION['main_language']!='english'){
                
                                    $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$billhis_menuid."' and ls_language='".$_SESSION['main_language']."'");

                                    //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                    $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                    $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                    $billhis_menu=$result_arabmenu['lm_menu_name'];
                                    // $catid['name'][] = $catname;
                                    //echo $catname;
                                    }
                                    
                                    $billhis_portionid=$row_listall['bd_portion'];
                                    $billhis_portion=$row_listall['pm_portionname'];
                                      if($row_listall['bd_rate_type']=='Portion'){
                                                $billhis_portion='Portion  :'.' '.$row_listall['pm_portionname'];
                                                }
                                                else if($row_listall['bd_rate_type']=='Unit'){
                                                    if($row_listall['bd_unit_type']=='Packet'){
                                                        $billhis_portion=$row_listall['bd_unit_type'].' : '.number_format($row_listall['bd_unit_weight'],$_SESSION['be_decimal']).' '.$row_listall['u_name'];
                                                }
                                                    else if($row_listall['bd_unit_type']=='Loose'){
                                                        $billhis_portion=$row_listall['bd_unit_type'].' : '.number_format($row_listall['bd_unit_weight'],$_SESSION['be_decimal']).' '.$row_listall['bu_name'];
                                                }
                                               
                                                }
                                    
                                    if($_SESSION['main_language']!='english'){
                
                                    $sql_arabportion=$database->mysqlQuery("SELECT lm_portion_name FROM tbl_language_portion left join tbl_languages on ls_id=lm_language_id WHERE lm_portion_id='".$billhis_portionid."' and ls_language='".$_SESSION['main_language']."'");

                                    //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                    $num_arabportion = $database->mysqlNumRows($sql_arabportion);
                                    $result_arabportion = $database->mysqlFetchArray($sql_arabportion);
                                    $billhis_portion=$result_arabportion['lm_portion_name'];
                                    // $catid['name'][] = $catname;
                                    //echo $catname;
                                    }
                                    
//                                    $fp=fopen($apilink."/src/main_menu_display.php?set=orderedmenu&ordered_menuid=$billhis_menuid&dat=$other_lang","r");
//                                    $response['messages'] = stream_get_contents($fp);
//                                    //echo  $response['messages'];
//                                    $resu= json_decode($response['messages'],true);
                                 
//                                    $fp_portion=fopen($apilink."/src/main_menu_display.php?set=orderedportion&ordered_portionid=$billhis_portionid&dat=$other_lang","r");
//                                    $response_portion['messagesportion'] = stream_get_contents($fp_portion);
//                                    //echo $response_portion['messagesportion'];
//                                    $resu_portion= json_decode($response_portion['messagesportion'],true);
                            ?>
                 
                 <div class="right_bill_history_detail tr_clone" qtyval="<?=$row_listall['bd_qty'] ?>" slno="<?=$row_listall['bd_billslno'] ?>" name="tr_clone">
                 <input type="hidden" value="<?=$row_listall['bd_qty'] ?>" class="tr_clone_add1<?=$row_listall['bd_billslno'] ?>">
                    <div  class="bil_his_sl_no slmyno">
                    	<?php if($row_listall['bd_cancelled']=='N' && $_SESSION['s_canceleachinhistory']=="Y"){ ?>
                    		<a class="canceleachitem bill_history_close_btn" billno="<?=$billno ?>" slno="<?=$row_listall['bd_billslno'] ?>" style="cursor:pointer">X</a>
                        <?php } ?>
						<?=$i++;?>
                    </div>
                    <div class="bil_his_dish_name"><?=$billhis_menu//$row_listall['mr_menuname']?></div>
                    <div style="width: 18.5%;font-size: 12px;" class="bil_his_sl_no"><?=$billhis_portion//$row_listall['pm_portionname'] ?></div>
                    <div style="width: 8%;" class="bil_his_sl_no">
                    	<?php //if($row_listall['bd_cancelled']=='N'){ ?>
						
                       <!-- <input type="text" value="<?=$row_listall['bd_qty'] ?>" style="width: 38px;text-align: center; color:#000;    height: 23px;" class="tr_clone_add" >-->
                        <?php //}else{ 
                        echo $row_listall['bd_qty']; 
                         //} ?>
                    </div>
                    <div class="bil_his_sl_no"><?=number_format($row_listall['bd_rate'],$_SESSION['be_decimal']) ?> 
						<span style="color:#F00"> <?php if($row_listall['bd_cancelled']=='Y')echo "*"; ?></span>
                    </div>
                    
                </div><!--right_bill_history_detail-->
                <div class="locate<?=$row_listall['bd_billslno'] ?>"></div>
                
                 <?php
			  }
	}
	
	?>
     <script src="js/bill_historycanceleach.js"></script>
   
    
    <?php
}else if(isset($_REQUEST['set']) && $_REQUEST['set']=="set_cancel")
{  
    
	$billno=$_REQUEST['billno'];
        $credit_amount= 0;
        $credit_id= '';
	$sql_listall  =  $database->mysqlQuery("Update tbl_tablebillmaster set bm_status='Cancelled' Where bm_billno='".$billno."'"); 
	$sql_listall  =  $database->mysqlQuery("Update tbl_tableorder set ter_status='Cancelled' Where ter_billnumber='".$billno."'");
	$sql_listall  =  $database->mysqlQuery("Update tbl_tablebilldetails set bd_cancelled='Y' Where bd_billno='".$billno."'");
	$sql_listall  =  $database->mysqlQuery("Update tbl_tablebillmaster set 	ter_cancelledreason='".$_REQUEST['reasontext']."' Where bm_billno='".$billno."'");
        $sql_listall  =  $database->mysqlQuery("Update tbl_tablebillmaster set 	ter_cancelledby_careof='".$_REQUEST['stafflist']."' Where bm_billno='".$billno."'");
        //$sql_listall  =  $database->mysqlQuery("Update tbl_tablebillmaster set ter_cancelledsecretkey='".$_REQUEST['secretkey']."' Where bm_billno='".$billno."'");
        $sql_listall  =  $database->mysqlQuery("Update tbl_tablebillmaster set ter_cancelledlogin='".$_SESSION['expodine_id']."' Where bm_billno='".$billno."'");
        $sql_listall  = $database->mysqlQuery("SELECT  cd_amount, cd_masterid FROM tbl_credit_details WHERE  cd_billno='".$billno."'"); 
        $num_listall  = $database->mysqlNumRows($sql_listall);
        if($num_listall)
        {
                while($row = mysqli_fetch_array($sql_listall))
                      {
                      $credit_amount= $row['cd_amount'];
                      $credit_id= $row['cd_masterid'];
                      }
            $sql_listall  = $database->mysqlQuery("update tbl_credit_master set crd_totalamount= crd_totalamount-$credit_amount where crd_id='".$credit_id."' ");         
        }
        
        $sql_listall  =  $database->mysqlQuery("delete from tbl_credit_details  where  cd_billno='".$billno."' ");

	$dateexp=date("Y-m-d H:i:s");
	$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); $rrt='';
        $num_table3  = $database->mysqlNumRows($sql_table_sel3);
        if($num_table3)
        {
                while($row = mysqli_fetch_array($sql_table_sel3))
                      {
                      $rrt= $row['ser_cancelwithkey'];
                      }
        }
      if($rrt=="Y")
              {  
                      $result= "yes";
                      $sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_key='".$_REQUEST['secretkey']."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
        }else
        {
                      $result= "no";
                      $sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_password='".md5($_REQUEST['secretkey'])."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
        }

        
	$sql=$database->mysqlQuery("UPDATE tbl_tablebilldetails SET bd_cancelled='Y',`bd_cancelledby_careof`='".$_REQUEST['stafflist']."', "
                . " `bd_cancelledreason`='".$reasontext."', `bd_cancelledtime`='".$dateexp."', `bd_cancelledsecret`='".$_REQUEST['secretkey']."',"
                . " `bd_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE bd_billno='".$_REQUEST['billno']."' ");
	
        
        $sql_table_sel31  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' ");

        $num_table31  = $database->mysqlNumRows($sql_table_sel31);
        if($num_table31)
        {
                while($row1 = mysqli_fetch_array($sql_table_sel31))
                      {
                      $rrt= $row1['ser_firstname'];
                      }
        }
        
        $sql_table_sel311  = $database->mysqlQuery("SELECT * from tbl_tablebillmaster  WHERE  bm_billno ='".$_REQUEST['billno']."' ");

        $num_table311  = $database->mysqlNumRows($sql_table_sel311);
        if($num_table311)
        {
                while($row11 = mysqli_fetch_array($sql_table_sel311))
                      {
                      $rrt1= $row11['bm_finaltotal'];
                      }
        }    
       
        
        ///stockupdate//
        $sql_table_sel3112  = $database->mysqlQuery("SELECT * from tbl_tablebilldetails  WHERE  bd_billno ='".$_REQUEST['billno']."' ");

        $num_table3112  = $database->mysqlNumRows($sql_table_sel3112);
        if($num_table3112)
        {
            while($row112 = mysqli_fetch_array($sql_table_sel3112))
             {
		
              $qty_update= $database->mysqlQuery( "UPDATE tbl_menustock SET "
              . " mk_stock_number=mk_stock_number+'".$row112['bd_qty']."' "
              . " where mk_menuid= '".$row112['bd_menuid']."' "
              . " and mk_portion= '".$row112['bd_portion']."' and mk_open_stock_date='".$_SESSION['date']."' and mk_opening_stock >0 ");
              
              
              
	}
  }    
  
  
  
    ///inv start///   
    if($_SESSION['s_inventory_staff_add']=='Y' && $_SESSION['be_inv_sales_stock_reduce']=='Y'){
        
        $weight='';
        $sql_login_inv  =  $database->mysqlQuery("select * from tbl_tablebilldetails td  left join tbl_tablebillmaster tb on "
        . " tb.bm_billno=td.bd_billno where td.bd_billno='".$_REQUEST['billno']."' and  tb.bm_status='Cancelled' "); 
	$num_login_inv   = $database->mysqlNumRows($sql_login_inv);
	if($num_login_inv){ 
	 while($result_inv = $database->mysqlFetchArray($sql_login_inv)) 
         { 
          
             
        ///production wise///
        $sql_listall  =  $database->mysqlQuery("select * from tbl_production where tp_product='".$result_inv['bd_menuid']."' and "
                . " tp_store='".$_SESSION['ser_store_inv']."' "); 
        $num_listall  = $database->mysqlNumRows($sql_listall);
        if($num_listall){
            
            if($result_inv['bd_rate_type']=='Portion' || $result_inv['bd_base_unit_id']=='3' || $result_inv['bd_unit_id']=='5'){
                
            $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_inv['bd_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['bd_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
    
            }else{
                  
                  
             if($result_inv['bd_unit_type']=='Packet' && ($result_inv['bd_unit_id']=='3' || $result_inv['bd_unit_id']=='2')){ 
                 
             $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_inv['bd_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['bd_unit_weight']."' and  ts_product='".$result_inv['bd_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
     
          
           }else{    
                  
           $weight=($result_inv['bd_qty']*$result_inv['bd_unit_weight']);     
                  
           $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['bd_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
      
        
             }
        
            }
            
            
         }else{
             
             
        ///recipe wise///
             
        if($result_inv['bd_portion']!=''){    
            
        $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['bd_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."' and tmi_portion='".$result_inv['bd_portion']."' and tmi_di='Y' "); 
      
        }else{
       
            $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['bd_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."' and tmi_di='Y' ");       
        
        }
        
        $num_login_f   = $database->mysqlNumRows($sql_login_f);
	if($num_login_f){ 
	while($result_login_f  = $database->mysqlFetchArray($sql_login_f)) 
        { 
            
            $qty_inv=$result_inv['bd_qty']*($result_login_f['tmi_ing_qty']/$result_login_f['tmi_yield']);
            
            $wgt_inv=$result_inv['bd_qty']*($result_login_f['tmi_weight']/$result_login_f['tmi_yield']);
             
            
             if($result_login_f['tmi_ing_unit']=='Single' || $result_login_f['tmi_ing_unit']=='Nos' ){
            
             $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$qty_inv."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
       
        }else{
                 
        if($result_login_f['tmi_rate_type']=='Packet' && ($result_login_f['tmi_ing_unit']=='KG' || $result_login_f['tmi_ing_unit']=='LTR')){ 
                 
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$qty_inv."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where   ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
       
        }else{
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$wgt_inv."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
        
        }
        
        }
            
          
        }}else{
            
            ///normal wise///
            
            if($result_inv['bd_rate_type']=='Portion' || $result_inv['bd_base_unit_id']=='3' || $result_inv['bd_unit_id']=='5'){
                
            $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_inv['bd_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['bd_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
    
            }else{
                  
                  
             if($result_inv['bd_unit_type']=='Packet' && ($result_inv['bd_unit_id']=='3' || $result_inv['bd_unit_id']=='2')){ 
                 
             $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty+'".$result_inv['bd_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['bd_unit_weight']."' and  ts_product='".$result_inv['bd_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
     
          
          }else{    
                  
           $weight=($result_inv['bd_qty']*$result_inv['bd_unit_weight']);     
                  
           $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight+'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['bd_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
      
        
          } } }
             
             
         }
             
        }}
 } 
 
 ///inv end///      
        
  
  
        
        $dt= date("Y-m-d h:i:s");
        $nm=$_REQUEST['stafflist'];
        $rs=$_REQUEST['reasontext'];
      
        $sql_sms121 =  $database->mysqlQuery("Select * from tbl_cancellation_reasons where  cr_id=$rs"); 
		  $num_sms121  = $database->mysqlNumRows($sql_sms121);
		  if($num_sms121)
		  {
		         while($result_sms121  = $database->mysqlFetchArray($sql_sms121)) 
					{
                                          $dd                                =$result_sms121['cr_reason'];
                                      } }
                                      
                            if(count($rs)>1){
                                $text_rsn=$rs;
                            }else{
                              $text_rsn  =$dd;
                            }          
        
        
        $dt1=date("Y-m-d");
        $detail=" Bill no:$billno \n Cancelled by: $rrt  \n Cancelled time:$dt  \n Cancelled reason:$dd  \n  Bill amount:$rrt1 ";
        
       $date_nw_nw=date('Y-m-d H:i:s');
        
     $sql12=$database->mysqlQuery("INSERT INTO tbl_billcancel_log(bc_billno,bc_date, bc_details, bc_datetime, bc_sms_time, bc_email_time) VALUES ('$billno','$dt1','$detail','$dt','$date_nw_nw','$date_nw_nw')"); 

    // echo "INSERT INTO tbl_billcancel_log(bc_billno,bc_date, bc_details, bc_datetime, bc_sms_time, bc_email_time) VALUES ('$billno','$dt1','$detail','$dt','','')";
     
     
     $sql_login_fire1  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Bill Cancel' "); 
	$num_login_fire1   = $database->mysqlNumRows($sql_login_fire1);
	if($num_login_fire1){ 
	while($result_login_fire1  = $database->mysqlFetchArray($sql_login_fire1)) 
        { 
          $firebase_report_status_bill=$result_login_fire1['tf_active'];
        }}
     
     
     if($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on']=='Y' && $firebase_report_status_bill=="Y" ){
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
    ///pushing msg///
    $branch_id_fire=$_SESSION['firebase_id'];
     $body = " Bill No: $billno  \nBill Cancelled By: $rrt  \nCancelled Time:$dt  \nCancelled Reason:$text_rsn  \nBill Amount:$rrt1";
      require 'vendor/autoload.php';
    //putenv('GOOGLE_APPLICATION_CREDENTIALS=C:\Apache24\htdocs\expodine\src\service_google.json');
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
            'title' =>  $_SESSION['s_branchname']."  - BILL CANCELLED ",
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
    
    
    
    
//    $url = "https://fcm.googleapis.com/fcm/send";
//   //$token ='dFCy-onTEvQ:APA91bGXAQobatT-sbeLk3QTFdh-Zf10Z7dzmUIO99GHDjkrmwWwvzA7poh5dbAv55B7KrFKAQtpDwkJgo9lgwxFUC0W_RrnI1ohd7c-IJJfuCTeSSdhyKowMEKwOYZk5met5QhnCx0T';
//    $serverKey = 'AIzaSyD3zn_tP2RqeVSMsEFMJnrcZk5AuNGru-M';
//    $title = $_SESSION['s_branchname']."  - BILL CANCELLED ";
//    
//    $body = " Bill No: $billno  \nBill Cancelled By: $rrt  \nCancelled Time:$dt  \nCancelled Reason:$text_rsn  \nBill Amount:$rrt1";
//    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1', 'click_action' =>'notification');
//    $arrayToSend = array('to' => "/topics/$branch_id_fire" , 'notification' => $notification,'priority'=>'high');
//    $json = json_encode($arrayToSend);
//    $headers = array();
//    $headers[] = 'Content-Type: application/json';
//    $headers[] = 'Authorization: key='. $serverKey;
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
//    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
//    //Send the request
//    $response = curl_exec($ch);
//    //Close request
//    if ($response === FALSE) {
//    die('FCM Send Error: ' . curl_error($ch));
//    }
//    curl_close($ch);
    
    //to database storage of msg//
    $data_to_firebase=urlencode($body);
    //echo $_SESSION['firebase_url'];
    $url = $_SESSION['firebase_url']."api/post_notification?branhcid=$branch_id_fire&notification=$data_to_firebase";
   
    //echo $url;
    
    
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    //var_dump($result);

        }
}
     
     
     
     
    $customer="";
    $point_add=0;
    $point_redeem=0;
     $sql_sms1211 =  $database->mysqlQuery("Select * from tbl_loyalty_pointadd_bill where  lob_billno='".$billno."'"); 
		  $num_sms1211  = $database->mysqlNumRows($sql_sms1211);
		  if($num_sms1211)
		  {
		      while($result_sms1211  = $database->mysqlFetchArray($sql_sms1211)) 
			{
                              $customer =$result_sms1211['lob_loyalty_customer'];
                               $point_add =$result_sms1211['lob_point_add'];
                                $point_redeem =$result_sms1211['lob_point_redeem'];
                              
                                      } }
              if($point_redeem>0 || $point_add>0){                        
     $sql_loy=$database->mysqlQuery("UPDATE tbl_loyalty_reg SET ly_points=(ly_points+'".$point_redeem."')-'".$point_add."' ,ly_totalvisit=ly_totalvisit-1 WHERE ly_id='".$customer."' ");
      $sql_loy1=$database->mysqlQuery("UPDATE tbl_tablebillmaster  SET bm_redeem_amount='0' where bm_billno='".$billno."' ");
     $sql_loy_del=$database->mysqlQuery("Delete from tbl_loyalty_pointadd_bill where lob_billno ='".$billno."' ");       
   
              }
     
}

else if(isset($_REQUEST['set']) && $_REQUEST['set']=="secretkeycheck") 
{
	//echo 'hi';
//`tbl_secretkeymaster`(`sr_id`, `sr_staffid`, `sr_key`, `sr_password`, `sr_generatedtime`, `sr_expiredtime`, `sr_defaultkey`)
$result="";
$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); $rrt='';
//echo "SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'";die();
  $num_table3  = $database->mysqlNumRows($sql_table_sel3);
  if($num_table3)
  {
	  while($row = mysqli_fetch_array($sql_table_sel3))
		{
		$rrt= $row['ser_cancelwithkey'];
		}
  }
	if($rrt=="Y")
	{  
		$result= "yes";
  }else
  {
	  	$result= "no";
  }

if($result== "yes")
{
	if($_REQUEST['secretkey']!='')
	{ //echo "SELECT * from tbl_secretkeymaster  WHERE sr_staffid='".$_REQUEST['stafflist']."' and sr_key='".$_REQUEST['secretkey']."' AND  sr_expiredtime ='0000-00-00 00:00:00' AND sr_defaultkey='Y'";
	   $sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_secretkeymaster  WHERE sr_staffid='".$_REQUEST['stafflist']."' and sr_key='".$_REQUEST['secretkey']."' AND  (sr_expiredtime ='0000-00-00 00:00:00' OR  sr_expiredtime IS NULL) AND sr_defaultkey='Y'"); 
		$num_table3  = $database->mysqlNumRows($sql_table_sel3);
		if($num_table3)
		{
			  echo "ok";
		}else
		{
			  echo "sorry";
		}
	}else
	{
		 echo "sorry";
	}
}else
{
	if($_REQUEST['secretkey']!='')
	{//echo "SELECT * from tbl_secretkeymaster  WHERE sr_staffid='".$_REQUEST['stafflist']."' and sr_password='".$_REQUEST['secretkey']."' AND  sr_expiredtime ='0000-00-00 00:00:00' AND sr_defaultkey='N'";
	   $sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_logindetails  WHERE ls_staffid='".$_REQUEST['stafflist']."' and ls_password='".md5($_REQUEST['secretkey'])."'");
		$num_table3  = $database->mysqlNumRows($sql_table_sel3);
		if($num_table3)
		{
			  echo "ok";
		}else
		{
			  echo "sorry";
		}
	}else
	{
		echo "sorry";
	}
}
 
}

else if(isset($_REQUEST['set']) && $_REQUEST['set']=="cancelbilleditem") 
{	$num_generals='';
	$reasontext=mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['reasontext']));
	$dateexp=date("Y-m-d H:i:s");
	$sql=$database->mysqlQuery("UPDATE tbl_tablebilldetails SET bd_cancelled='Y',`bd_cancelledby_careof`='".$_REQUEST['stafflist']."', `bd_cancelledreason`='".$reasontext."', `bd_cancelledtime`='".$dateexp."', `bd_cancelledsecret`='".$_REQUEST['secretkey']."', `bd_cancelledlogin`='".$_SESSION['expodine_id']."' WHERE bd_billno='".$_REQUEST['billno']."' And bd_billslno='".$_REQUEST['slno']."' ");
	

$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); $rrt='';
  $num_table3  = $database->mysqlNumRows($sql_table_sel3);
  if($num_table3)
  {
	  while($row = mysqli_fetch_array($sql_table_sel3))
		{
		$rrt= $row['ser_cancelwithkey'];
		}
  }
if($rrt=="Y")
	{  
		$result= "yes";
		$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_key='".$_REQUEST['secretkey']."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
  }else
  {
	  	$result= "no";
		$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_password='".md5($_REQUEST['secretkey'])."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
  }
	
	
	
	$sql_general =  $database->mysqlQuery("Select * from tbl_tablebilldetails   WHERE bd_billno='".$_REQUEST['billno']."' AND bd_cancelled='N'"); 
	$num_generals  = $database->mysqlNumRows($sql_general);
	if(!$num_generals)
	{
		$sql=$database->mysqlQuery("UPDATE tbl_tablebillmaster SET bm_status='Cancelled' WHERE bm_billno='".$_REQUEST['billno']."'");
	
	}
	

	if($sql)
	{
		$sql_table_sel1  =  $database->mysqlQuery("SELECT * from tbl_tablebilldetails   WHERE bd_billno='".$_REQUEST['billno']."' And bd_billslno='".$_REQUEST['slno']."' "); 
		 $num_table1  = $database->mysqlNumRows($sql_table_sel1);
		if($num_table1)
		{
			  while($rs  = $database->mysqlFetchArray($sql_table_sel1)) 
				  {
					  $amount				=$rs['bd_amount'];
					  $be_servicetaxunit	=0;
					  $be_servicechargeunit	=0;
					  $be_vatunit			=0;
					  $bm_subtotal			=0;
					  
					  $bm_servicecharge		=0;
					  $bm_servicetax		=0;
					  $bm_vat				=0;
					  $bm_finaltotal		=0;
					  $bm_discountid		=0;
					  $bm_discountvalue		=0;
					  $bm_floorid			=0;
					  $fr_servicetax		=0;
					  $fr_vat				=0;
					  $fr_servicecharge 	=0;
					  $dclbl=0;
					  $sql_table_sel2  = $database->mysqlQuery("SELECT * from tbl_tablebillmaster   WHERE bm_billno='".$_REQUEST['billno']."' "); 
					  $num_table2  = $database->mysqlNumRows($sql_table_sel2);
					  if($num_table2)
					  {
							while($rs2  = $database->mysqlFetchArray($sql_table_sel2)) 
								{
									$bm_subtotal		=$rs2['bm_subtotal'];
									
									$bm_servicecharge	=$rs2['bm_servicecharge'];
									$bm_servicetax		=$rs2['bm_servicetax'];
									$bm_vat				=$rs2['bm_vat'];
									$bm_finaltotal		=$rs2['bm_finaltotal'];
									$bm_discountid		=$rs2['bm_discountid'];
									$bm_discountvalue	=$rs2['bm_discountvalue'];
									$bm_floorid			=$rs2['bm_floorid'];
									$dclbl				=$rs2['bm_discountlabel'];
								}
					  }
					  $sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_floormaster   WHERE fr_floorid='".$bm_floorid."' "); 
					  $num_table3  = $database->mysqlNumRows($sql_table_sel3);
					  if($num_table3)
					  {
							while($rs3  = $database->mysqlFetchArray($sql_table_sel3)) 
								{
									$fr_servicetax		=$rs3['fr_servicetax'];
									$fr_vat				=$rs3['fr_vat'];
									$fr_servicecharge	=$rs3['fr_servicecharge'];
									
								}
					  }
					  
					  $sql_table_nos="select * from tbl_branchmaster ";
					  $sql_table  =  $database->mysqlQuery($sql_table_nos); 
					  $num_table  = $database->mysqlNumRows($sql_table);
					  if($num_table){
						  while($result_table  = $database->mysqlFetchArray($sql_table)) 
							  {
								  $be_servicetaxunit=$result_table['be_servicetaxunit'];
								  $be_servicechargeunit=$result_table['be_servicechargeunit'];
								  $be_vatunit=$result_table['be_vatunit'];
								  
							  }
					  }
					  
					  $subtotal		    =$bm_subtotal -  $amount;// subtotal - canceleed amount 
					  if($num_generals)
					  {
						  $afterservicecharge = 0;
						  $finaltotal = 0;
						  $inservicecharge=0;
						  if($be_servicechargeunit == '%')
						  {
							$inservicecharge = (($subtotal * $fr_servicecharge)/100);
							$afterservicecharge = $subtotal + $inservicecharge;
							$finaltotal = $afterservicecharge;
						  }
						  else if ($be_servicechargeunit == 'Value') 
						  {
							$inservicecharge = $fr_servicecharge;
							$afterservicecharge = $subtotal + $inservicecharge;
							$finaltotal = $afterservicecharge;
						  }
						  
							
						  $afterservicetax = 0;
						  if($be_servicetaxunit == '%')
						  {
							$afterservicetax = (($afterservicecharge *$fr_servicetax)/100);
							$finaltotal = $finaltotal + $afterservicetax;
						  }   
						  elseif ($be_servicetaxunit == 'Value') 
						  {
							$afterservicetax = $fr_servicetax;
							$finaltotal =  $finaltotal + $fr_servicetax;
						  }
						  
						  $aftervat = 0;
						  if($be_vatunit == '%')
						  {
							$aftervat = (($afterservicecharge *$fr_vat)/100);
							$finaltotal = $finaltotal + $aftervat;
						  }
						  elseif ($be_vatunit == 'Value')
						  {
							$aftervat  = $fr_vat;
							$finaltotal = $finaltotal +$fr_vat;
						  }
						  
						  
						  $finaltotal = $finaltotal;
						 
						  $discountfinal=0;
						  $discounttotal=0;
						  if(!is_null($bm_discountid))
						  {
							  $dsc=0;
							  $did=explode("(",$dclbl);
							  $did1=explode(")",$did[1]);
							  $dsc=$did1[0];
							  /*$sql_table_ds  = $database->mysqlQuery("SELECT ds_percent from tbl_discountmaster   WHERE ds_discountid='".$bm_discountid."'"); 
							  while($result_table_ds  = $database->mysqlFetchArray($sql_table_ds)) 
								  {
									  $dsc=$result_table_ds['ds_percent'];
								  }*/
								  if (strpos($dsc,'%') !== false) // type percent
								  {
									  $spl=explode("%",$dsc);
									  $discountfinal=$finaltotal * ($spl[0] / 100);
								  }else
								  {
									  $discountfinal=$dsc;
								  }
								 
								
						  }else
						  {
							 $discountfinal=$bm_discountvalue;
							 //$tot=	$finaltotal - $discount;
				
						  }
						   $discounttotal=	$finaltotal - $discountfinal;
						 $updt=$database->mysqlQuery("UPDATE tbl_tablebillmaster SET bm_servicetax = '".$afterservicetax."',bm_vat = '".$aftervat."', bm_servicecharge = '".$inservicecharge."',bm_finaltotal = '".$finaltotal."',bm_discountvalue='".$discountfinal."'  WHERE  bm_billno='".$_REQUEST['billno']."'");
						 if($updt)
						 {
							 echo "ok";
							 exit();
						 }else
						 {
							 echo "sorry";
							 exit();
						 }
					  }else
					  {
						  $updt=$database->mysqlQuery("UPDATE tbl_tablebillmaster SET bm_servicetax = '0.00',bm_vat = '0.00', bm_servicecharge = '0.00',bm_finaltotal = '0.00',bm_discountvalue='0.00',bm_cancelamount='0.00'  WHERE  bm_billno='".$_REQUEST['billno']."'");
						 if($updt)
						 {
							 echo "ok";
							 exit();
						 }else
						 {
							 echo "sorry";
							 exit();
						 } 
					  }
					//echo "UPDATE tbl_tablebillmaster SET bm_servicetax = '$afterservicetax',bm_vat = '$aftervat', bm_servicecharge = '$inservicecharge',bm_finaltotal = '$finaltotal',bm_discountvalue='$discountfinal'  WHERE  bm_billno='".$_REQUEST['billno']."'";
					  //UPDATE tbl_tablebillmaster SET bm_billno = billnumber,bm_servicetax = afterservicetax,bm_vat = aftervat, bm_servicecharge = inservicecharge,bm_finaltotal = finaltotal, bm_floorid = floorid WHERE bm_billno = TEMP_billnumber; 
				  }
		}
	}
	
	
	
}else if(isset($_REQUEST['set']) && $_REQUEST['set']=="sendotp") 
{
		$result="";
//$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_secretkeymaster  WHERE  (sr_expiredtime ='0000-00-00 00:00:00' OR  sr_expiredtime IS NULL)"); $rrt='';
//echo "SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."'";





$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); $rrt='';
   $num_table3  = $database->mysqlNumRows($sql_table_sel3);
  if($num_table3)
  {
	  while($row = $database->mysqlFetchArray($sql_table_sel3))
		{
		$rrt= trim($row['ser_cancelwithkey']);
		}
  }
	if($rrt=="Y")
	{  
		$result= "yes";
		//$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_key='".$_REQUEST['secretkey']."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
  }else
  {
	  	$result= "no";
		//$sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE (sr_password='".md5($_REQUEST['secretkey'])."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");
  }$srt='';
	try {
		
		if($rrt== "Y")
		{
			$database->mysqlQuery("SET @staffid = " . "'" . $_REQUEST['stafflist'] . "'");
			$secretkey='';
			$sq=$database->mysqlQuery("CALL proc_gensecretkey(@staffid,@secretkey)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
			$rs = $database->mysqlQuery( 'SELECT @secretkey AS secretkey' );
			while($row = mysqli_fetch_array($rs))
			{
			 $srt= $row['secretkey'];
	
			}
			
			
			
			
			
		// $srt;
		
		//echo $srt."==";
		
		//sms sending starts
		$mobileno='';
		$sql_stff  =  $database->mysqlQuery("SELECT * FROM tbl_staffmaster WHERE ser_staffid='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); 
		while($result_stff  = $database->mysqlFetchArray($sql_stff)) 
		{
			$mobileno=$result_stff['ser_mobileno'];
		}
		
		
		$phonelist= $mobileno;
		//$smstext= "Please note your OTP - ".$srt; 
		$smstext="OTP for Bill Alteration request is  ".$srt.". Please enter this to verify the identity.";
		$be_sms_username		="";
		$be_sms_apipassword	="";
		$be_sms_senderid		="";
		  $sql_general =  $database->mysqlQuery("Select * from tbl_generalsettings "); 
		  $num_general  = $database->mysqlNumRows($sql_general);
		  if($num_general)
		  {//`tbl_generalsettings`(`be_id`, `be_mail_server`, `be_mail_port`, `be_mail_emailid`, `be_mail_password`, `be_mail_secure`, `be_sms_username`, `be_sms_apipassword`, `be_sms_senderid`)
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
						
						 $be_sms_username			=$result_general['be_sms_username'];
						 $be_sms_apipassword		=$result_general['be_sms_apipassword'];
						 $be_sms_senderid			=$result_general['be_sms_senderid'];
					         $be_sms_domainid			=$result_general['be_sms_domainid'];
                                                 $be_sms_priority			=$result_general['be_sms_priority'];
                                                 $be_sms_method			        =$result_general['be_sms_method'];
                                                 
                                        }
		  }
		
		
		//http://www.webqua.net/pushsms.php?username=exploreit&api_password=f8386edkhhzkcsaqt&sender=websms&to=9895366444&message=thank%20you%20for%20contacting%20us&priority=11
		$username=$be_sms_username;
		$api_password=$be_sms_apipassword;
		$sender=$be_sms_senderid;
		$domain=$be_sms_domainid;
                $priority=$be_sms_priority;
                $smstype = $be_sms_method; 

		$username=urlencode($username);
		$sender=urlencode($sender);
		$message=urlencode($smstext);
		$domain=urlencode($domain);
                $route=urlencode($priority);                                                                                                                                                                                                                                                                                                                                                                                           
		
                
                $parameters="username=$username&api_password=$api_password&sender=$sender&to=$phonelist&priority=$route&message=$message";
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
	
		
	
		
		//sms sending ends
		}else
		{
			$sqq=substr(floor( 1000 + ( rand( ) *8999 )),0,4);
			$sql_i=$database->mysqlQuery("INSERT INTO `tbl_secretkeymaster`( `sr_staffid`, `sr_password`,sr_key, `sr_generatedtime`, `sr_defaultkey`) VALUES ('".$_REQUEST['stafflist']."','".md5($_REQUEST['secretkey'])."','".$sqq."','".date("Y-m-d H:i:s")."','N')");
		}
		
		//echo $rrt."dd".$srt;
		 } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }
}else  if(isset($_REQUEST['set']) && $_REQUEST['set']=="billsettlement") 
{ 
$paymode='';
$bm_amountpaid=0;
$bm_amountbalace=0;
$bm_transactionamount=0;
$bm_name='';
$payid='';
$total=0;
	 $sql_billhis="select *  from tbl_tablebillmaster as bm LEFT JOIN  tbl_paymentmode as pm ON bm.bm_paymode=pm.pym_id LEFT JOIN tbl_bankmaster as bk ON bk.bm_id=bm.bm_transcbank WHERE bm.bm_billno='".$_REQUEST['billno']."'";
	$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
	$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
	if($num_billhistory)
	{
		while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
			{
				$paymode=$result_billhistory['pym_name'];
				$payid=$result_billhistory['bm_paymode'];
				if( $paymode=="Cash")
				{
				$bm_amountpaid=$result_billhistory['bm_amountpaid'];
				$bm_amountbalace=$result_billhistory['bm_amountbalace'];
				}else if( $paymode=="Credit / Debit")
				{
					$bm_amountpaid=$result_billhistory['bm_amountpaid'];
					$bm_amountbalace=$result_billhistory['bm_amountbalace'];
					$bm_transactionamount=$result_billhistory['bm_transactionamount'];
					$bm_name=$result_billhistory['bm_name'];
					
				}
				$total=$result_billhistory['bm_finaltotal'];
				//$paymode=$_SESSION[$result_billhistory['pym_id']]['paymentmode'];
				
			}
	}
?>
 					<table width="100%" class="none_border_table" style="border-bottom:1px #ccc solid;">
                         <tr>
                            <td width="18%"><strong><?=$_SESSION['bill_history_paymentmode']?></strong></td>
                            <td width="35%" class="paymentids" payid="<?=$payid ?>"><?=$paymode?></td>
                         </tr> 
                        
                         </table>
                         <table width="100%" class="none_border_table" style="border-bottom:1px #ccc solid;">
                         
                          <tr>
                            <td width="18%"><strong><?=$_SESSION['bill_history_amount']?></strong></td>
                            <td width="35%" class="totalamt" amttot="<?= $total?>"><?=number_format($total,$_SESSION['be_decimal'])?></td>
                         </tr> 
                         </table>
                      <div class="settle_ment_detail_paid_cc">     
                         <table width="100%" class="none_border_table" border="0">
                        <tr>
                            <td width="33%"><span class="bill_story_center_top_txt"><?=$_SESSION['bill_history_amountpaid']?>:</span>
                            <span class="bill_story_center_txt"><?=number_format($bm_amountpaid,$_SESSION['be_decimal'])?>/-</span>
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt"><?=$_SESSION['bill_history_balance']?>:</span>
                            <span class="bill_story_center_txt"><?=number_format($bm_amountbalace,$_SESSION['be_decimal'])?>/-</span>
                            </td>
                          </tr>
                         <?php if( $paymode=="Credit / Debit")
							{ ?> 
                          <tr>
                            <td width="33%"><span class="bill_story_center_top_txt">Transaction Amount:</span>
                            <span class="bill_story_center_txt"><?=number_format($bm_transactionamount,$_SESSION['be_decimal'])?>/-</span>
                            </td>
                             <td width="33%"><span class="bill_story_center_top_txt">Transaction Bank:</span>
                            <span class="bill_story_center_txt"><?=$bm_name?></span>                            
                            </td>
                            
                            
                            
                          </tr>
                     <?php } ?>     
                        </table>  
            		</div>
<?php
}
else  if(isset($_REQUEST['set']) && $_REQUEST['set']=="paymentchangesettle") 
{  
    
	 $returnmsg='';
     
	 $coupon=0;
         $cheq=0;
         $creditamt=0;
         
         if( $_REQUEST['trans']!=""){
             $tran= $_REQUEST['trans'];
         }else{
             $tran=0;
         }
         
        if($_REQUEST['bank']!=""){

        $bank=$_REQUEST['bank'];

          $sql_table_sel3= $database->mysqlQuery("update tbl_tablebillmaster set bm_transcbank='".$_REQUEST['bank']."' "
          . " WHERE bm_billno='".$_REQUEST['billno']."' ");   

        }else{

                $bank=0; 
        }

        
        $guest_number='';
        $guest_name='';
        
        $creditype		=NULL;
	$typenam		=$_REQUEST['typenam'];
        
	$credit			='N';
	$amountpaid=0;
	$bal=0;
	$creditdeatils		=NULL;
	$paidamount_credit	=0;
	$amount_credit		=0;
        $credit_remark	       =NULL;
	
	$staff=NULL;
	
       
        if($_REQUEST['comp_remarks']!=""){ 
         $compy='Y';
         
        }else{
          $compy='N';   
        }
         
        
         if($_REQUEST['comp_remarks']!=""){ 
             
                $compy='Y';
         
        }else{
                $compy='N';   
        }
        
        $amountpaid =$_REQUEST['paid'];
        
        $exist='N'; $bill_tot=0;$crd_id_del='';
        $sql_table_sel3  = $database->mysqlQuery("SELECT cd_amount,cd_masterid from tbl_credit_details  WHERE cd_billno='".$_REQUEST['billno']."'  "); 
        $num_table3  = $database->mysqlNumRows($sql_table_sel3);
        if($num_table3)
        {
            while($row1 = mysqli_fetch_array($sql_table_sel3))
            {
                
                $bill_tot=$row1['cd_amount'];
                $crd_id_del=$row1['cd_masterid'];
           
           }
        
         $sql_table_sel30  = $database->mysqlQuery("delete from  tbl_credit_details where cd_billno='".$_REQUEST['billno']."'  ");  
         $exist='Yes';
         
        }
        
        if($_REQUEST['type']=="6")
	{ 
            
            
                $credit_remark          =$_REQUEST['credit_remarks'];
		$creditype		=$_REQUEST['creditype'];
		$creditdeatils		=$_REQUEST['creditdeatils'];
		$paidamount_credit	=$_REQUEST['paidamount_credit'];
		$amountpaid             =$_REQUEST['paidamount_credit'];
		$amount_credit		=$_REQUEST['amount_credit'];
		
                $credit			='Y';
		$bal          		=$_REQUEST['bal'];
                $guest_number          	=$_REQUEST['guestnumber'];
                $guest_name          	=$_REQUEST['guestname'];
                
                if($creditype=='4' ||$creditype=='3'){
                    
                $creditdeatils='';
                   
                $database->mysqlQuery("SET @guestname			= " . "'" . $guest_name . "'");
		$database->mysqlQuery("SET @guestphone			= " . "'" . $guest_number . "'");
                $database->mysqlQuery("SET @branchid			= " . "'" . $_SESSION['branchofid'] . "'");
		 $database->mysqlQuery("SET @credittype			= " . "'" . $creditype . "'");
                $message='';
		$guest=$database->mysqlQuery("CALL proc_credit_entry(@guestname,@guestphone,@branchid,@credittype,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
		$guest_id='';
                $guest1 = $database->mysqlQuery( 'SELECT @message AS message' );
		while($row = mysqli_fetch_array($guest1))
		{
		   $guest_id= $row['message'];
		}
                  $creditdeatils=$guest_id;
                
                $loy_upd = $database->mysqlQuery(" UPDATE tbl_loyalty_reg SET ly_loy_login='".$_SESSION['login_staff_id_expodine']."',ly_loy_dayclose='".$_SESSION['date']."' where ly_id=LAST_INSERT_ID() ");
                
                }
                else if($creditype=='1'){
                  $room  =$_REQUEST['room'];   
                }
		
	}
        
        
    if($exist=='Yes'){
            
           
    $sql_table_sel83  = $database->mysqlQuery("update tbl_credit_master set crd_totalamount=(crd_totalamount-$bill_tot) where crd_id='$crd_id_del' ");     
        
       
    }
        
        
         
	try {
		$database->mysqlQuery("SET @billno= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['billno']) . "'");
		$database->mysqlQuery("SET @branchid= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_SESSION['branchofid']) . "'");
		$database->mysqlQuery("SET @paymodeid= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['type']) . "'");
		$database->mysqlQuery("SET @amountpaid= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $amountpaid) . "'");
		
		$database->mysqlQuery("SET @transactionamount= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $tran) . "'");
		
		$database->mysqlQuery("SET @card_bank= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $bank) . "'");
		
                
                $database->mysqlQuery("SET @couponamt= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $coupon) . "'");
                $database->mysqlQuery("SET @chequeamount= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $cheq) . "'");
                
                $database->mysqlQuery("SET @creditamount= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $amount_credit) . "'");
                
		$database->mysqlQuery("SET @complementary= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $compy) . "'");
                
                 if($_REQUEST['comp_remarks']!=""){ 
		$database->mysqlQuery("SET @remark=" . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['comp_remarks']) . "'");
                 }else{
                $database->mysqlQuery("SET @remark= " . "''");     
                 }
                
		$database->mysqlQuery("SET @voucherid= " . "''");
		$database->mysqlQuery("SET @couponcompany= " . "''");
		
		$database->mysqlQuery("SET @chequeno= " . "''");
		$database->mysqlQuery("SET @chequebankname= " . "''");
		
		$database->mysqlQuery("SET @credit=" . "'" . mysqli_real_escape_string($database->DatabaseLink, $credit) . "'");
		$database->mysqlQuery("SET @creditmasterid= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $creditdeatils) . "'");
		
		$database->mysqlQuery("SET @balanceamt= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['bal']) . "'");
		$database->mysqlQuery("SET @complementary_staff= " . "''");
                
		if(isset($_REQUEST['check_chn']))
		{
		$database->mysqlQuery("SET @auth_secretkey= " . "''");
		$database->mysqlQuery("SET @auth_staffid= " . "''");
		$database->mysqlQuery("SET @auth_loginid= " . "''");
		$database->mysqlQuery("SET @changereason= " . "''");

		}else
		{
		$database->mysqlQuery("SET @auth_secretkey= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['secret']) . "'");
		$database->mysqlQuery("SET @auth_staffid= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['stafflist']) . "'");
		$database->mysqlQuery("SET @auth_loginid= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_SESSION['expodine_id']) . "'");
		$database->mysqlQuery("SET @changereason= " . "'" . mysqli_real_escape_string($database->DatabaseLink, $_REQUEST['reasontext']) . "'");
		}
                
		$database->mysqlQuery("SET @message	= " . "''");		

		$sq=$database->mysqlQuery("CALL proc_billpayment_change(@billno,@branchid,@paymodeid,@amountpaid,@transactionamount,@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname,@chequeamount,@credit,@creditmasterid,@creditamount,@balanceamt,@complementary_staff,@auth_secretkey,@auth_staffid,@auth_loginid,@changereason,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
		$rs = $database->mysqlQuery( 'SELECT @message AS message' );
		while($row = mysqli_fetch_array($rs))
		{
		   $returnmsg= $row['message'];
		}
                
                
	$dateexp=date("Y-m-d H:i:s");	
	$rrt='';	
	$sql_table_sel3  = $database->mysqlQuery("SELECT * from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['stafflist']."' AND  ser_employeestatus='Active'"); 
        $num_table3  = $database->mysqlNumRows($sql_table_sel3);
        if($num_table3)
        {
                while($row = mysqli_fetch_array($sql_table_sel3))
                      {
                           $rrt= $row['ser_cancelwithkey'];
                      }
        }
  
        $s='';
        if($rrt=="Y")
        {  
                      $result= "yes";
                      $sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE "
                      . " (sr_key='".$_REQUEST['secret']."' )  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");

        }else
        {
                      $result= "no";
                      $sql=$database->mysqlQuery("UPDATE tbl_secretkeymaster SET `sr_expiredtime`='".$dateexp."' WHERE "
                      . " (sr_password='".md5($_REQUEST['secret'])."')  AND (`sr_expiredtime`='0000-00-00 00:00:00' OR sr_expiredtime IS NULL)");

        }
  
	   
  } catch (Exception $e) {
      
	   $returnmsg= 'Caught exception: '.  $e;
	   $file = 'log.txt';
	   $content = date("l F  d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
	   file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
	   echo  $returnmsg;exit();
  }
}
else if($_REQUEST['set']=="pincheck"){
    
    
    $pin = $_REQUEST['pin'];
    $str = '';
    if($_REQUEST['type']=="staffsel")
        $str .= "ser_authorisation_code = '$pin'";
    else if($_REQUEST['type']=="authpincheck")
        $str .= "ser_authorisation_code = '$pin'";
    
    if(isset($_REQUEST['action']) && $_REQUEST['action']=='kotcancel'){
    $sql_staff="select ser_tip_edit_permission,sm.ser_discount_manual,sm.ser_discountpermission, sm.ser_bill_cancel_permission,sm.ser_order_split_permission,sm.ser_dayclose_permission,sm.ser_staffid,sm.ser_cancelpermission,sm.ser_bill_reprint_per,sm.ser_bill_settle_change_per,sm.ser_bill_regen_per, dm.dr_takeorder FROM tbl_staffmaster sm
    left join tbl_designationmaster dm on dm.dr_designationid = sm.ser_designation
    where $str and sm.ser_employeestatus = 'Active' and sm.ser_kot_cancel_permission='Y'";
      
    }
    else if(isset($_REQUEST['action']) && $_REQUEST['action']=='billcancelpermission'){
        $sql_staff="select ser_tip_edit_permission,sm.ser_discount_manual,sm.ser_discountpermission, sm.ser_order_split_permission,sm.ser_dayclose_permission,sm.ser_bill_cancel_permission,sm.ser_cancelpermission,sm.ser_staffid,sm.ser_bill_settle_change_per,sm.ser_bill_reprint_per,sm.ser_bill_regen_per FROM tbl_staffmaster sm where $str and sm.ser_employeestatus = 'Active' and sm.ser_bill_cancel_permission='Y'";
      
    }
    else{
        
    $sql_staff="select ser_tip_edit_permission,sm.ser_discount_manual,sm.ser_discountpermission, sm.ser_bill_cancel_permission,sm.ser_order_split_permission,sm.ser_dayclose_permission,sm.ser_staffid,sm.ser_cancelpermission,sm.ser_bill_settle_change_per,sm.ser_bill_regen_per,sm.ser_bill_reprint_per, dm.dr_takeorder FROM tbl_staffmaster sm
    left join tbl_designationmaster dm on dm.dr_designationid = sm.ser_designation
    where $str and sm.ser_employeestatus = 'Active'";
    }
    $sql_staff  =  $database->mysqlQuery($sql_staff); 
    $num_staff  = $database->mysqlNumRows($sql_staff);
    if($num_staff){
        $row = mysqli_fetch_array($sql_staff);
        if($_REQUEST['type']=="staffsel"){
            if($row['dr_takeorder']=='Y'){
                echo $row['ser_staffid']; 
            }else{
                echo "NO PERMISSION";
            }
        }else {
            echo $row['ser_staffid']; 
        }
        echo "*reprint:".$row['ser_bill_reprint_per']."*regen:".$row['ser_bill_regen_per']."*change:".$row['ser_bill_settle_change_per']."*kotcancel:".$row['ser_cancelpermission']."*billcancel:".$row['ser_bill_cancel_permission']."*dayclose:".$row['ser_dayclose_permission']."*ordersplit:".$row['ser_order_split_permission']."*dis_auth:".$row['ser_discountpermission']."*dis_manual:".$row['ser_discount_manual']."*tip_edit:".$row['ser_tip_edit_permission'];
       
    }else{
        echo "NO";
    }

}

else if($_REQUEST['set']=="add_tip"){
    
    $tip_amount=0;
    $tip = $database->mysqlQuery(" UPDATE `tbl_tablebillmaster` SET `bm_tips_given`='".$_REQUEST['tip_amount']."',`bm_tips_mode`='".$_REQUEST['tip_mode']."' WHERE bm_billno='".$_REQUEST['billno']."' "); 
    $sql_tipamount  = $database->mysqlQuery("SELECT bm_tips_given from tbl_tablebillmaster  WHERE bm_billno='".$_REQUEST['billno']."'"); 
    $num_tipamount  = $database->mysqlNumRows($sql_tipamount);
    if($num_tipamount)
    {
        $row_tipamount = mysqli_fetch_array($sql_tipamount);
        $tip_amount= number_format(str_replace(',', '',$row_tipamount['bm_tips_given']),$_SESSION['be_decimal']);
    }
    echo $tip_amount;
}


else  if(isset($_REQUEST['set']) && $_REQUEST['set']=="check_day_close") {
    
   $dayclose_bil='';
   $sql_billhis="select bm_dayclosedate  from tbl_tablebillmaster WHERE bm_billno='".$_REQUEST['billno']."'";
	$sql_billhistory  =  $database->mysqlQuery($sql_billhis); 
	$num_billhistory  = $database->mysqlNumRows($sql_billhistory);
	if($num_billhistory)
	{
		while($result_billhistory  = $database->mysqlFetchArray($sql_billhistory)) 
			{
                    
                    $dayclose_bil=$result_billhistory['bm_dayclosedate'];
                }
                }  
    
                
                
        $sql_billhis1="select dc_dateclose  from tbl_dayclose WHERE dc_day='".$dayclose_bil."'";
	$sql_billhistory1  =  $database->mysqlQuery($sql_billhis1); 
	$num_billhistory1  = $database->mysqlNumRows($sql_billhistory1);
	if($num_billhistory1)
	{
		while($result_billhistory1  = $database->mysqlFetchArray($sql_billhistory1)) 
			{
                    
                    if($result_billhistory1['dc_dateclose']!=''){
                        echo 'Yes';
                    }else{
                        echo 'No';
                    }
                  
                    
                }
                }
    
}

else  if(isset($_REQUEST['set']) && $_REQUEST['set']=="delete_item_bill") {
    
    $del = $database->mysqlQuery(" Delete from  tbl_tablebilldetails  WHERE bd_billno='".$_REQUEST['billno']."' and bd_billslno='".$_REQUEST['slno']."' "); 
    
    $database->mysqlQuery("SET @TEMP_billnumber = " . "'" .$_REQUEST['billno']. "'");
       
    $sq = $database->mysqlQuery("CALL  proc_bill_r(@TEMP_billnumber,@Message)");
    $rs = $database->mysqlQuery("SELECT @Message AS message");
    while($row = mysqli_fetch_array($rs))
    {
        $s= $row['message'];
       
    }
     
     
}

else  if(isset($_REQUEST['set']) && $_REQUEST['set']=="check_item_number") {
    
    
    $count=0;
     $sql_billhis1="select count(bd_menuid) as itemcount  from tbl_tablebilldetails WHERE bd_billno='".$_REQUEST['billno']."'";
	$sql_billhistory1  =  $database->mysqlQuery($sql_billhis1); 
	$num_billhistory1  = $database->mysqlNumRows($sql_billhistory1);
	if($num_billhistory1)
	{
		while($result_billhistory1  = $database->mysqlFetchArray($sql_billhistory1)) 
			{
                    
                    $count=$result_billhistory1['itemcount'];
                    
                    if($count>1){
                        echo 'Yes';
                    }else{
                         echo 'No';
                    }
                    
                    
                }
                }
    
    
    
    
}

else  if(isset($_REQUEST['set']) && $_REQUEST['set']=="check_paymode") {
    
     $mode='';
     $sql_billhis1="select bm_paymode  from tbl_tablebillmaster WHERE bm_billno='".$_REQUEST['billno']."'";
	$sql_billhistory1  =  $database->mysqlQuery($sql_billhis1); 
	$num_billhistory1  = $database->mysqlNumRows($sql_billhistory1);
	if($num_billhistory1)
	{
		while($result_billhistory1  = $database->mysqlFetchArray($sql_billhistory1)) 
			{
                    
                    $mode=$result_billhistory1['bm_paymode'];
                    
                    if($mode=='1'){
                        echo 'Yes';
                    }else{
                         echo 'No';
                    }
                    
                    
                }
                }
    
    
    
    
}
else  if(isset($_REQUEST['set']) && $_REQUEST['set']=="replace_item_bill") {
    
     
     $sql_billhis1="select mr_menuid,mmr_rate  from tbl_menumaster left join tbl_menuratemaster on mmr_menuid=mr_menuid WHERE mr_replacer='Y' limit 0,1 ";
	$sql_billhistory1  =  $database->mysqlQuery($sql_billhis1); 
	$num_billhistory1  = $database->mysqlNumRows($sql_billhistory1);
	if($num_billhistory1)
	{
		while($result_billhistory1  = $database->mysqlFetchArray($sql_billhistory1)) 
			{
                    
                    $menuid=$result_billhistory1['mr_menuid'];
                    $menu_rate=$result_billhistory1['mmr_rate'];
                    
                }
                }
    
    $del = $database->mysqlQuery(" update tbl_tablebilldetails set bd_menuid='".$menuid."',bd_rate_type='Portion',bd_portion='1',bd_org_rate='".$menu_rate."',bd_discount='0',bd_rate='".$menu_rate."' ,bd_qty='1',bd_amount='".$menu_rate."'  WHERE bd_billno='".$_REQUEST['billno']."' and bd_billslno='".$_REQUEST['slno']."' "); 
   
    $del1 = $database->mysqlQuery(" update tbl_tablebillmaster set bm_roundoff_value='0',bm_discountid=NULL ,bm_discountvalue='0',bm_discountlabel=NULL  WHERE bm_billno='".$_REQUEST['billno']."'  "); 
    
    $del = $database->mysqlQuery(" update tbl_tableorder set ter_menuid='".$menuid."',ter_rate_type='Portion',ter_portion='1',ter_org_rate='".$menu_rate."',ter_discount='0',ter_rate='".$menu_rate."' ,ter_qty='1',ter_total_rate='".$menu_rate."'  WHERE ter_billnumber='".$_REQUEST['billno']."' and ter_slno='".$_REQUEST['slno']."' "); 
    
    
    $database->mysqlQuery("SET @TEMP_billnumber = " . "'" .$_REQUEST['billno']. "'");
       
    $sq = $database->mysqlQuery("CALL  proc_bill_r(@TEMP_billnumber,@Message)");
    $rs = $database->mysqlQuery("SELECT @Message AS message");
    while($row = mysqli_fetch_array($rs))
    {
        $s= $row['message'];
       
    }
   
    
    
    
    
}


?>
