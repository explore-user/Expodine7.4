 <!--<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">-->
 <style>
/* body {
	font-family: 'Lato', Calibri, Arial, sans-serif !important;
	}*/
 .kot_number_list_menuorder{
	width:100%;
	/*max-height: 35px;*/
	height:43px;
	float:left;
	white-space:nowrap;
	overflow-y:auto;
	}
	
.kot_listing_num{
	width: auto;
    padding:1% 1%;
   margin: 3px 0.8%;
  /*  margin-top: 3px;*/
    /* height: 30px; */
   display: inline-block;
    /*line-height: 23px;*/
    border: solid 1px #E8ABAB;
	font-weight:bold;
	}	
.kot_listing_num:hover{text-decoration:none;}
.printedkot{color: #248435; border: solid 1px #24A22C;}	
</style>
<script src="js/menu_order.js"></script> 
<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 
include("api_multiplelanguage_link.php");
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
// Create a new instance
error_reporting(0);
                      $p=0;   $amt=0; $slnodine=1 ; 
                            
                            $sql_menulist="select distinct(ter_kotno) from tbl_tableorder where ter_dayclosedate='".$_SESSION['date']."' and   ter_orderno='".$_SESSION['order_id']."' and  ter_kotno<>'0'  order by ter_slno DESC";//ter_status Asc
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){ ?><div class="kot_number_list_menuorder"><?php
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{
							if($result_menus['ter_kotno']!="" || $result_menus['ter_kotno']!=0)
							{//echo $result_menus['ter_kotno'];
						  $kotm=$database->show_kotmaster($result_menus['ter_kotno']);
						   $status=$kotm['kr_print'];
							?><a href="#" kotid="<?=$result_menus['ter_kotno']?>" class="kotnolist kot_listing_num <?php if($status=='Y'){ ?> printedkot <?php } ?>"><?=$result_menus['ter_kotno']?></a><?php
					  }}
						?> </div><?php
				}
                            
                            $sql_combo_name_list =  $database->mysqlQuery("select cod.cod_count_combo_ordering,cod.cod_combo_pack_id,cod.cod_order_status,cod.cod_combo_total_rate,cod.cod_combo_qty,cod.cod_combo_preference , cn.cn_name,cn.cn_stock_check,cp.cp_pack_name FROM tbl_combo_ordering_details cod
                                                                            left join tbl_combo_name cn on cn.cn_id = cod.cod_combo_id
                                                                            left join tbl_combo_packs cp on cp.cp_id = cod.cod_combo_pack_id
                                                                            where cod.cod_dayclosedate='".$_SESSION['date']."' and cod.cod_orderno='".$_SESSION['order_id']."' group by cod_count_combo_ordering  order by cod.cod_entry_date desc ");
                            $num_combo_name_list = $database->mysqlNumRows($sql_combo_name_list);
                            if($num_combo_name_list){
                                while ($result_combo_name_list = $database->mysqlFetchArray($sql_combo_name_list)) {
                                      if($result_combo_name_list['cod_combo_qty']>=0){
                                    $p++; $combo_preference=array();
                                   $amt=$amt+$result_combo_name_list['cod_combo_total_rate'];
                            ?>                
                       <div class="preference_table <?php if ($result_combo_name_list['cod_order_status'] == "Added") { ?> combo_added_sec <?php } if ($result_combo_name_list['cod_order_status'] == "Served" || $result_combo_name_list['cod_order_status'] == "Billed" || $result_combo_name_list['cod_order_status'] == "Closed") { ?> odr_served <?php } ?> <?php if ($result_combo_name_list['cod_order_status'] == "Opened") { ?> odr_confirmed <?php } ?> <?php if ($result_combo_name_list['cod_order_status'] == "NotInStock") { ?> odr_notinstock <?php } ?>" id="<?=$p?>" style='cursor:pointer'>
                    	<div class="menu_order_dishname_cc combo_menu_div" status="<?=$result_combo_name_list['cod_order_status']?>" combo_pack_id="<?=$result_combo_name_list['cod_combo_pack_id']?>" combo_pack_qty="<?=$result_combo_name_list['cod_combo_qty']?>" cod_count_combo_ordering="<?=$result_combo_name_list['cod_count_combo_ordering']?>">
                            <div class="menu_order_dish_name"><span><?=$slnodine?></span>) <?=$result_combo_name_list['cn_name']?> <?=$result_combo_name_list['cp_pack_name']?></div>
                                  <div class="menuodr_rate_cc">
                                    <div class="dine_menu_rate" style="margin-left:5px"> <?= $_SESSION['base_currency']?> : <?=$result_combo_name_list['cod_combo_total_rate']?></div>
                                    <div class="dine_menu_qty" id="qtyview811">Qty : <?=$result_combo_name_list['cod_combo_qty']?></div>
                                </div>
                          </div><!--menu_order_dishname_cc position: relative;  left: -72px;  top: 6px;--> 
                                <?php if ($result_combo_name_list['cod_order_status']== "Added" || $result_combo_name_list['cod_order_status']== "NotInStock") { ?>
                                <div class="combo_order_delet_btn <?php if ($result_menus['ter_status'] == "NotInStock") { ?> menu_order_nostock <?php } ?>">
                                   <a href="#" class="preferance_table_btn" <?php if($result_combo_name_list['cod_order_status']=='Added'){ ?> onclick=" return combo_pack_delete_from_cart('<?=$result_combo_name_list["cod_count_combo_ordering"]?>','<?=$result_combo_name_list["cod_combo_qty"]?>','<?=$result_combo_name_list["cod_combo_pack_id"]?>','<?=$result_combo_name_list["cn_stock_check"]?>')"<?php } ?>><i class="glyphicon glyphicon-remove" style="margin-top: -2px;"></i></a>
                                </div>
                                <?php } 
                                else if ($result_combo_name_list['cod_order_status'] == "Opened") { ?>
                                        <div class="menu_order_confirm_btn">
                                            <a href="#" class="preferance_table_btn"><i class="glyphicon glyphicon-ok"></i></a>
                                        </div>
                                <?php }
                               else if ($result_combo_name_list['cod_order_status']== "Served") { ?>
                               
                                        <div class="menu_order_confirm_yellow_btn" style="margin: -6px 0px 0px -51px;">
                                            <a   href="#" class="preferance_table_btn"><i class="glyphicon glyphicon-ok" style="margin-top: -2px;"></i></a>
                                        </div>
                                <?php }?>
                                <div class="combo-preview-secion">
                                     <span class="menu_eachpc_head">Menus In Each Pack:</span>
                                        <?php
                                        $sql_combo_cart_list =  $database->mysqlQuery("select cod.cod_orderno, cod.cod_combo_id, cod.cod_combo_pack_id, cod.cod_slno,cod.cod_combo_qty, cod.cod_combo_total_rate, cod.cod_menu_id, sum(cod.cod_menu_qty) as cod_menu_qty , 
                                                                                    cod.cod_combo_preference, cod.cod_entry_date, cod.cod_dayclosedate, cod.cod_order_status,cn.cn_name,cp.cp_pack_name,  mm.mr_menuname,mr_menuid,cpm.cpm_menu_sale_type
                                                                                    FROM tbl_combo_ordering_details cod
                                                                                    left join tbl_combo_name cn on cn.cn_id = cod.cod_combo_id
                                                                                    left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id
                                                                                    left join tbl_combo_pack_menus cpm on cpm.cpm_menu_id=cod.cod_menu_id and cpm.cpm_combo_pack_id=cod.cod_combo_pack_id
                                                                                    left join tbl_menumaster mm on mm.mr_menuid=cod.cod_menu_id
                                                                                    where cod.cod_dayclosedate='".$_SESSION['date']."' and cod.cod_orderno='".$_SESSION['order_id']."' and cod.cod_count_combo_ordering='".$result_combo_name_list['cod_count_combo_ordering']."' group by cod.cod_menu_id,cod.cod_order_status " ); 
                                        $num_combo_cart_list = $database->mysqlNumRows($sql_combo_cart_list);
                                        if($num_combo_cart_list){$i=0;
                                            while ($result_combo_cart_list = $database->mysqlFetchArray($sql_combo_cart_list)) {                
                                             $i++;
                                               if($result_combo_cart_list['cod_combo_preference']!=''){
                                                    $combo_preference[]=$result_combo_cart_list['cod_combo_preference'];
                                                }
                                        ?>
                                <div class="addon-mn-row">
                                    <div class="addon-preview-secion-mn-1"><span><?=$i?>)</span><span class="cart_menu_list" menu_type="<?=$result_combo_cart_list['cpm_menu_sale_type']?>" id1="<?=$p?>" menuid="<?=$result_combo_cart_list['mr_menuid']?>" menuqty="<?=$result_combo_cart_list['cod_menu_qty']?>"> <?=$result_combo_cart_list['mr_menuname']?></span></div> 
                                    <div class="addon-preview-secion-qty">Qty:<span class="cart_menu_qty"><?=$result_combo_cart_list['cod_menu_qty']?></span></div>
                                </div>
                                    <?php 
                                        }}
                                    ?>
                                </div>
                                <?php if(!empty($combo_preference)){ ?>
                          <div class="menu_order_preference_text" >Pref: <span class="cart_menu_preference" id1="<?=$p?>"><?=implode(',',array_unique($combo_preference))?></span></div>
                                <?php } ?>
                          
                             
                    </div>
                            <?php $slnodine++;}}}

                                
                                 $icount=0;
                                 $order_unit_weight='';
                                 $order_packet_or_loose='';
                                 $unit_weight_name='';
                                 
              $kot_cancel_btn_check=0;                 
              $sql_menulist="SELECT ter_orderno from tbl_tableorder where ter_dayclosedate='".$_SESSION['date']."' and ter_status!='Added'  and ter_orderno='".$_SESSION['order_id']."' ";
                $sql_menus  =  $database->mysqlQuery($sql_menulist); 
		$num_menus  = $database->mysqlNumRows($sql_menus);
		if($num_menus){
			while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
                {  $kot_cancel_btn_check++; 
                
                }}
                            
                            
                                  
                                 
                                 
                                 
        $tot_incl_sub=0;  $sl_di_in=1;   $stock_inv='N';               
	$sql_menulist="SELECT ter_rate_before_comp,pmr_name,ter_orderno,ter_slno,ter_unit_id,ter_base_unit_id,ter_new_rate_incl,ter_rate_type,ter_unit_weight,"
                . "ter_unit_type,ter_branchid,ter_menuid,ter_portion,ter_rate,ter_qty,ter_status, ter_preference,ter_preferencetext,ter_orderfrom,ter_entrydate,"
                . "ter_entrytime,ter_entryuser, ter_esttime,ter_staff,ter_type,ter_kotno,ter_billnumber,ter_feedbackrating,ter_feedbackremarks, ter_feedbackenter,"
                . "ter_dayclosedate,ter_floorid,ter_cancel,ter_cancelledby_careof,ter_cancelledreason, ter_cancelledsecretkey,ter_cancelledlogin,ter_orderno_temp,"
                . "ter_waiter_id FROM tbl_tableorder left join tbl_preferencemaster on pmr_id=ter_preference where ter_dayclosedate='".$_SESSION['date']."'"
                . " and ter_orderno='".$_SESSION['order_id']."' and ter_addon_slno IS NULL  and ter_combo_entry_id IS NULL order by ter_slno DESC";
      
		$sql_menus  =  $database->mysqlQuery($sql_menulist); 
		$num_menus  = $database->mysqlNumRows($sql_menus);
		if($num_menus){$_SESSION['submitbutst']="0";$sumamnt=0;
			while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
				{ 
                            
                            $tot_incl_sub=$tot_incl_sub+($result_menus['ter_qty']*$result_menus['ter_new_rate_incl']); 
                            
                            $order_unit_weight=  $result_menus['ter_unit_weight'];
                            $order_packet_or_loose=  $result_menus['ter_unit_type'];
                                    
                            $ordered_menuid=trim(json_encode($result_menus['ter_menuid']));
                            
        $sql_menulist12 = "select mr.mr_stock_inventory,mr.mr_menuid,mr.mr_menuname from tbl_menumaster as mr WHERE mr.mr_menuid='".$result_menus['ter_menuid']."'";
                                       
                            $sql_menus12 = $database->mysqlQuery($sql_menulist12);
                                         $num_menus12 = $database->mysqlNumRows($sql_menus12);
                                        if ($num_menus12) {
                                        while ($result_menus12 = $database->mysqlFetchArray($sql_menus12)) {
                                            
                                                $menu_name12 = $result_menus12['mr_menuname'];
                                                
                                                $stock_inv=$result_menus12['mr_stock_inventory'];
                                           
                                                if($_SESSION['main_language']!='english'){

                                                $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus12['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

                                                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                                $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                $menu_name12=$result_arabmenu['lm_menu_name'];
                                              
                                                }  
                                            }
                                            }
                                            
                                            $menunewname=  substr($menu_name12, 0, 30);
                                            
                                          //portion start///
                                          $portion_shortcode='';
                                            $unit_weight_name='';
                                            if($result_menus['ter_rate_type']=='Portion'){
                                          $sql_menulist31 = "select pm.pm_id,pm.pm_portionname,pm.pm_portionshortcode from tbl_portionmaster pm where pm.pm_id='".$result_menus['ter_portion']."'"; 
                                        //echo "select pm.pm_id,pm.pm_portionname from tbl_portionmaster pm where pm.pm_id='".$portionid."'";
                                          $sql_menus31 = $database->mysqlQuery($sql_menulist31);
                                        $num_menus31 = $database->mysqlNumRows($sql_menus31);
                                        if ($num_menus31) {
                                        while ($result_menus31 = $database->mysqlFetchArray($sql_menus31)) {
                                            
                                           $portion_name = $result_menus31['pm_portionname'];
                                           $portion_id = $result_menus31['pm_id'];
                                           $portion_shortcode= '('.$result_menus31['pm_portionshortcode'].')';
                                           
                                            if($_SESSION['main_language']!='english'){

                                            $sql_arabportion=$database->mysqlQuery("SELECT lm_portion_name FROM tbl_language_portion left join tbl_languages on ls_id=lm_language_id WHERE lm_portion_id='".$result_menus31['pm_id']."' and ls_language='".$_SESSION['main_language']."'");

                                            //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                            $num_arabportion = $database->mysqlNumRows($sql_arabportion);
                                            $result_arabportion = $database->mysqlFetchArray($sql_arabportion);
                                            $portion_name=$result_arabportion['lm_portion_name'];
                                            
                                           
                                            }
                                         }}
                                            }
                                            else if($result_menus['ter_rate_type']=='Unit'){
                                                
                                                if($result_menus['ter_unit_type']=='Packet'){
                                                    
                                                    $sql_packet = "select u.u_id,u.u_name from tbl_unit_master u where u.u_id='".$result_menus['ter_unit_id']."'"; 
                                                    //echo "select u.u_id,u.u_name from tbl_unit_master u where u.u_id='".$result_menus['ter_unit_id']."'";
                                                    $sql_packet = $database->mysqlQuery($sql_packet);
                                                    $num_packet= $database->mysqlNumRows($sql_packet);
                                                    if ($num_packet) {
                                                    while ($result_packet = $database->mysqlFetchArray($sql_packet)) {

                                                       $unit_weight_name= $order_packet_or_loose.': '.number_format($order_unit_weight,3).' '.$result_packet['u_name'];
                                                       
                                                        }
                                                       }
                                                    }
                                            else if($result_menus['ter_unit_type']=='Loose'){
                                                    
                                                    $sql_loose = "select bu.bu_id,bu.bu_name from tbl_base_unit_master bu  where bu.bu_id='".$result_menus['ter_base_unit_id']."'"; 
                                                    //echo "select bu.bu_id,bu.bu_name from tbl_base_unit_master bu  where bu.bu_id='".$result_menus['ter_base_unit_id']."'";
                                                    $sql_loose = $database->mysqlQuery($sql_loose);
                                                    $num_loose= $database->mysqlNumRows($sql_loose);
                                                    if ($num_loose) {
                                                    while ($result_loose = $database->mysqlFetchArray($sql_loose)) {
                                                       
                                                      
                                                       $unit_weight_name= $order_packet_or_loose.': '.number_format($order_unit_weight,3).' '.$result_loose['bu_name'];

                                                        }
                                                       }                                                
                                                 }
                                            }
                            
					$rate=$result_menus['ter_rate'];
                                         $qty11=$result_menus['ter_qty'];
                                          $sumamnt=$rate*$qty11;
                                            $amt+=($rate*$qty11);
					$menu_name=$database->show_menu_ful_details($result_menus['ter_menuid']);
					if($result_menus['ter_preference'])
					{
						$pf=$database->show_prefernce_ful_details($result_menus['ter_preference']);
						$pref=$result_menus['pmr_name'];
					}else
					{
						$pref="";
					}
					if($result_menus['ter_preferencetext'])
					{
						if($pref!="")
						{
							$pf=$result_menus['ter_preferencetext'];
							$pref=$pref ."" .$result_menus['ter_preferencetext'];
						}else
						{
							$pref=$result_menus['ter_preferencetext'];
							$pf=$result_menus['ter_preferencetext'];
						}
					}else
					{
						$pf="";
					}
					$cqrycat	=	$database->mysqlQuery("SELECT * FROM tbl_portionmaster where pm_id='".$result_menus['ter_portion']."' ");
					$num_cat  = $database->mysqlNumRows($cqrycat);
					if($num_cat){
						while($rs=$database->mysqlFetchArray($cqrycat))
						{
							$name=$rs['pm_portionname'];
						}
					}else
					{
						$name="";
					}
					$ids="pm_".$result_menus['ter_portion'];
                                        $discount_name=array();
                                            $discountname = $database->mysqlQuery("SELECT d_discount_remarks FROM tbl_tableorder_discount where d_orderno='".$_SESSION['order_id']."' and d_slno='".$result_menus['ter_slno']."'");
                                            //echo "SELECT d_discount_remarks FROM tbl_tableorder_discount where d_orderno='".$_SESSION['order_id']."' and d_slno='".$result_menus['ter_slno']."'";
                                            $num_discountname = $database->mysqlNumRows($discountname);
                                            
                                            if ($num_discountname) {
                                                while ($rs_discountname = $database->mysqlFetchArray($discountname)) {
                                                    $discount_name[] = $rs_discountname['d_discount_remarks'];
                                                }
                                            } else {
                                                $discount_name[] = "";
                                            }
	
			?> 

			<div class="preference_table act <?php if($result_menus['ter_status']=="Served" || $result_menus['ter_status']=="Billed" || $result_menus['ter_status']=="Closed") { ?> odr_served <?php } ?> <?php if($result_menus['ter_status']=="Opened") { ?> odr_confirmed <?php } ?> <?php if($result_menus['ter_status']=="NotInStock") { ?> odr_notinstock <?php } ?>">
                    	
                            <div  >
                            
                            <?php if($_SESSION['ser_com_item']=='Y'){ ?>
                             <span style="padding-right: 13px;float: right; " title="SET AS COMPLIMENTARY ITEM ?" width="3%" ><input <?php if ($result_menus['ter_status'] == "Served" || $result_menus['ter_status'] == "Billed" || $result_menus['ter_status'] == "Closed") { ?> disabled <?php } ?> <?php if($result_menus['ter_rate_before_comp']>0){ ?> checked <?php } ?> style="cursor:pointer;" onclick="comp_bill('<?=$result_menus['ter_menuid']?>','<?=$_SESSION['order_id']?>','<?=$result_menus['ter_portion']?>','<?=$result_menus['ter_unit_id']?>','<?=$result_menus['ter_base_unit_id']?>','<?=$result_menus['ter_unit_weight']?>','<?=$result_menus['ter_slno']?>')" type="checkbox" class="comp_bill" id="comp_bill_<?=$result_menus['ter_menuid']."_".$result_menus['ter_slno']?>">  </span>                          
                             <?php } ?>
                            
                            <div style="cursor:pointer;<?php if($result_menus['ter_rate_before_comp']>0){ ?> pointer-events:none <?php } ?>" class="menu_order_dish_name menu_order_dishname_cc" status="<?= $result_menus['ter_status']?>" menu="menu_<?=$result_menus['ter_menuid']?>" portion123="<?=$portion_shortcode?>"  slno="slno_<?=$result_menus['ter_slno']?>"><span><?=$sl_di_in++;?></span><?=") ".$menunewname//$menu_name['mr_menuname']?></div>
                                <div class="portion_name"><?=$portion_shortcode?></div>
                                <?php if($unit_weight_name!=''){ ?>
                                <div class="unit_view_text" style="margin-left:5px" ><?=$unit_weight_name?></div>
                                <?php } ?>
                                <div class="menuodr_rate_cc">
                                    
                                    

                                   <?php  if($_SESSION['incl_bill_format']=='N'){  ?>
                               <div class="dine_menu_rate" style="margin-left:5px;"><?=$_SESSION['base_currency']?> : <?=number_format($sumamnt,$_SESSION['be_decimal'])?></div>
                                  <?php }else{ ?>   
                                <div class="dine_menu_rate" style="margin-left:5px;"><?=$_SESSION['base_currency']?> : <?=number_format(($result_menus['ter_qty']*$result_menus['ter_new_rate_incl']),$_SESSION['be_decimal'])?></div>
                                  <?php }?>   



 <!-- <div class="dine_menu_qty" id="qtyview<?= $result_menus['ter_menuid'] . $result_menus['ter_slno'] ?>">Qty : <?= $result_menus['ter_qty'] ?></div> -->
                                    <div class="dine_menu_qty" id="combo_pack_qty_cart">
                                    
                                        
                                         <?php if($result_menus['ter_status'] != "Served") { ?>        
                                        <span class="qty_incr_btn_sec_cc" style="cursor:pointer; margin-top:-5px;" >
                                       
                                           
                                             <?php if( $_SESSION['be_single_click_add']=='Y' ) { ?>
                                            <span  onclick="minus_single('<?=$result_menus['ter_menuid']?>','<?=$_SESSION['order_id']?>','<?=$result_menus['ter_qty']?>','<?=$result_menus['ter_portion']?>','<?=$result_menus['ter_unit_id']?>','<?=$result_menus['ter_base_unit_id']?>','<?=$result_menus['ter_unit_weight']?>','<?=$result_menus['ter_slno']?>');"  class="qty_incr_btn minus_button_di">-</span>
                                        <?php } ?>
                                            <input class="qty_incr_val" readonly type="text" value="<?=$result_menus['ter_qty']?>">
                                        
                                         <?php if( $_SESSION['be_single_click_add']=='Y' ) { ?>
                                        <span  onclick="plus_single('<?=$result_menus['ter_menuid']?>','<?=$_SESSION['order_id']?>','<?=$result_menus['ter_portion']?>','<?=$result_menus['ter_unit_id']?>','<?=$result_menus['ter_base_unit_id']?>','<?=$result_menus['ter_unit_weight']?>','<?=$result_menus['ter_slno']?>');"  class="qty_incr_btn">+</span>
                                  <?php } ?>
                                        
                                        </span>                     
                                        <?php } else{ ?>       
                                                <span class="qty_incr_btn_sec_cc" style="cursor:pointer; margin-top:-5px;">
                                        <span   class="qty_incr_btn">-</span>
                                        <input class="qty_incr_val" readonly type="text" value="<?=$result_menus['ter_qty']?>" >
                                        <span    class="qty_incr_btn">+</span>
                                    </span>                                  
                                                            
                                                            
                                         <?php } ?>              
                                        
                                    </div>
                                  
                                </div>
                                
<!--                                <div class="portion_txt"><?//= $resu_portion['portion_name'][0]//$name?></div>
                             <div class="quantity_txt" id="qtyview<?//=$result_menus['ter_menuid'].$result_menus['ter_slno']?>"><?//=$result_menus['ter_qty']?></div>-->
                          </div><!--menu_order_dishname_cc position: relative;  left: -72px;  top: 6px;--> 
                          <?php if($result_menus['ter_status']=="Added" || $result_menus['ter_status']=="NotInStock"){ ?>
                                 <div style="" class="menu_order_delet_btn <?php if($result_menus['ter_status']=="NotInStock") { ?> menu_order_nostock <?php } ?>"  mid="<?=$result_menus['ter_menuid']?>" id='myid<?=$result_menus['ter_orderno']?>' p='tab<?=$result_menus['ter_slno']?>'>
                                   <a href="#" class="preferance_table_btn" ><i class="glyphicon glyphicon-remove" style="margin-top: -2px;"></i></a>
                                   </div>
                            <?php }elseif($result_menus['ter_status']=="Opened") { ?>
                                  <div class="menu_order_confirm_btn">
                                   <a href="#" class="preferance_table_btn"><i class="glyphicon glyphicon-ok"></i></a>
                                   </div>
                            <?php }elseif($result_menus['ter_status']=="Served") { ?>
                                <div class="menu_order_confirm_yellow_btn" style="">
                                 <a    href="#" class="preferance_table_btn"><i class="glyphicon glyphicon-ok" style="margin-top: -2px;"></i></a>
                                 </div>
                            <?php } ?> 
                          <div style="font-size:10px;color: darkred" class="dine_discount_txt"><?php for($s=0;$s<count($discount_name);$s++) {if($s>0){ echo ',';} echo $discount_name[$s]; }?></div>
                             <?php if($pref){ ?> 
                             <div class="menu_order_preference_text  viewprefall" id="viewprefall<?=$result_menus['ter_menuid'].$result_menus['ter_slno'] ?>"><?=$pref?></div>
                             
                             <?php } ?>
                             <div class="editpref" style="display:none" id="editpref<?=$result_menus['ter_menuid'].$result_menus['ter_slno'] ?>" >
                             
                             <div style="width:17%" class="menu_edit_textbox_cc">
                              <span style="float:left; width:100%;line-height:20px;"><?= $_SESSION['menu_order_edit_qty'] ?> :</span>
                               <input type="text" value="<?=$result_menus['ter_qty']?>" style="display:none;  width:100%; text-align: center; "   class="qtytextedit pref_dopdown" id="qtytextedit<?=$result_menus['ter_menuid'].$result_menus['ter_slno']?>">
                               </div><!---menu_edit_textbox_cc-->
                               
                              <div style="width:43%" class="menu_edit_textbox_cc">
                               <span style="float:left; width:100%;line-height:20px;"><?= $_SESSION['menu_order_edit_pref'] ?> :</span>
                                    <select id="menu_<?=$result_menus['ter_menuid'].$result_menus['ter_slno'] ?>"  class="pref_dopdown prefdp" name="pref" style="  width:100%;  height: 35px;  float: left;  border: solid 1px #ccc;"  >	
                                    <option value="" ><?= $_SESSION['menu_order_edit_selectpref'] ?></option>								
                                 <?php  
				 $sql_menuportion="select * from tbl_menuprefmaster where  mpr_menuid='".$result_menus['ter_menuid']."'";
				   $sql_portions  =  $database->mysqlQuery($sql_menuportion); 
					$num_portions  = $database->mysqlNumRows($sql_portions);
					if($num_portions){
						while($result_portions  = $database->mysqlFetchArray($sql_portions)) 
							{//`tbl_menuprefmaster`(`mpr_menuid`, `mpr_prefeernce`)
								$rate_details=$database->show_prefernce_ful_details($result_portions['mpr_prefeernce']);
								?>
                                <option value="<?=$result_portions['mpr_prefeernce'] ?>" <?php if($result_menus['ter_preference']==$result_portions['mpr_prefeernce']){ ?>  selected<?php } ?>><?=$_SESSION["pmr_".$result_portions['mpr_prefeernce']]['preference']//$rate_details['pmr_name'] ?></option>
                                
                                <?php }} ?>
								
                                    </select>
                                     </div><!---menu_edit_textbox_cc--> 
                                      <?php
							 $rateentery='N';
							  $sql_menuportion="select mr_manualrateentry from tbl_menumaster where  mr_menuid='".$result_menus['ter_menuid']."'";
							 $sql_portions  =  $database->mysqlQuery($sql_menuportion); 
							  $num_portions  = $database->mysqlNumRows($sql_portions);
							  if($num_portions){
								  while($result_portions  = $database->mysqlFetchArray($sql_portions)) 
									  {
										  $rateentery=$result_portions['mr_manualrateentry'];
									  }
							  }
							 //echo $rateentery.$result_menus['ter_menuid'];
							 ?>
                                      <div style="width:20%" class="menu_edit_textbox_cc">
                            	 <span style="float:left; width:100%;line-height:20px;"><?= $_SESSION['menu_order_edit_rate'] ?> :</span>
                             	 	 <input type="text"  style="width: 100%; text-align: center; "  value="<?=$rate?>" name="rate_value_edit<?=$result_menus['ter_menuid'].$result_menus['ter_slno'] ?>" id="rate_value_edit<?=$result_menus['ter_menuid'].$result_menus['ter_slno'] ?>" class=" pref_dopdown"<?php if($rateentery=="N"){  ?> disabled="disabled" <?php } ?> >
                             </div><!---menu_edit_textbox_cc-->
                                    
                                     <a class="confirm_btn updatealledit" style="margin: 20px 5px 0 0;width: 15%;float: right;"  menusid="mn_<?=$result_menus['ter_menuid']?>" sl="sl_<?=$result_menus['ter_slno']?>"><?= $_SESSION['menu_order_edit_okbutton'] ?></a>
                                    
                                    
                                    
                             <textarea placeholder="<?= $_SESSION['menu_order_placeholder_edit_manualpref'] ?>" class="pref_text_area" name="preftext" id="preftext<?=$result_menus['ter_menuid'].$result_menus['ter_slno']?>" style="height:60px;  border-radius: 5px;
  padding: 3%;  font-size: 16px;  width:98%;  color: #201B1B !important;background: #FFF; border: solid 0px #666 !important;   margin: 5px 0 8px 5px;"><?=$pf?></textarea>
 
          
                             </div>
                             
                          
                               <?php
                                $addon_total=0;
                                    $sql_addon_menu = "select ter_menuid,ter_qty, ter_total_rate from tbl_tableorder where ter_dayclosedate='".$_SESSION['date']."' and ter_orderno='" . $_SESSION['order_id'] . "' and ter_addon_slno='".$result_menus['ter_slno']."' order by ter_menuid";
                                    //echo "select ad_addon_menu,ad_qty, ad_total_rate from tbl_order_addon where  ad_orderno='" . $_SESSION['order_id'] . "' and ad_order_slno='".$result_menus['ter_slno']."' order by ad_addon_menu";    
                                    $sql_addon_menu1 = $database->mysqlQuery($sql_addon_menu);
                                    $num_addon_menu1 = $database->mysqlNumRows($sql_addon_menu1);
                                    if ($num_addon_menu1) {$o=0;
                                        ?>
                                            <div class="addon-preview-secion">
                                            <div class="addon-preview-secion-head">Add on</div>
                                        <?php
                                        while ($result_addon_menu = $database->mysqlFetchArray($sql_addon_menu1)) {
                                            $o++;
                                            $menu_name=$database->show_menu_ful_details($result_addon_menu['ter_menuid']);
                                            $addon_total=$addon_total+$result_addon_menu['ter_total_rate'];
                                            ?>
                               <div class="addon-mn-row">
                                 <div class="addon-preview-secion-mn-1" ><span><?=$o?>)</span> <?=$menu_name['mr_menuname']?></div> 
                                 <div class="addon-preview-secion-qty" >Qty:<?=$result_addon_menu['ter_qty']?></div>
                                 <div class="addon-preview-secion-rate" >Rate: <?=number_format($result_addon_menu['ter_total_rate'],$_SESSION['be_decimal'])?></div>
                               </div>
                               <?php
                                    }
                                    ?>
                                    </div>
                               <?php             
                                } 
                               ?>
                          
                             
                             <?php
                                 
                                   $tax_in1 = $database->mysqlQuery("SELECT tmp_pref_name,tmp_qty FROM tbl_menu_preference_kot where "
                                           . "tmp_menu=$ordered_menuid and tmp_orderno_bill= '".$_SESSION['order_id']."' ");
                                          $num_tx1 = $database->mysqlNumRows($tax_in1);
                                          if($num_tx1) {
                                              
                                            ?>
                                   <div class="addon-preview-secion">
                                       <div class="addon-preview-secion-head" style="color:#6ABEDF">PREFERENCE</div>
                                  <?php
                                    while ($tx_in11 = $database->mysqlFetchArray($tax_in1)) {
                                  
                                     ?>
                                    
                              
                               <div class="addon-mn-row">
                                 <div class="addon-preview-secion-mn-1" ><span></span><?=$tx_in11['tmp_pref_name'].' : '.$tx_in11['tmp_qty']?></div> 
                                 <div class="addon-preview-secion-qty" ></div>
                                 <div class="addon-preview-secion-rate" ></div>
                               </div>
                               
                               <?php } ?>
                               
                                    </div>
                               
                            <?php   } ?>  
                             
                            
                             <?php  if($stock_inv=='Y') { 
                                  
                                  
                                  
         $qty_weight=0;
         $sql_general1 =  $database->mysqlQuery("Select sum(ts_qty) as qty ,ts_rate_type, sum(ts_weight) as weight,ts_unit "
         . " from tbl_store_stock where ts_product='".$result_menus['ter_menuid']."' "); 
	 $num_general1  = $database->mysqlNumRows($sql_general1);
		if($num_general1)
		{
                 while($result_kotlist  = $database->mysqlFetchArray($sql_general1)) 
		 {   
                    
                if($result_kotlist['ts_unit']=='Nos' || $result_kotlist['ts_unit']=='Single'){
                           
                            $qty_weight= $result_kotlist['qty'];   
                        
                }else{
                           
                 if($result_kotlist['ts_rate_type']=='Packet' && ($result_kotlist['ts_unit']=='KG' || $result_kotlist['ts_unit']=='LTR')){
                           
                            $qty_weight= $result_kotlist['qty'];
                          
                }else{
                               
                            $qty_weight= $result_kotlist['weight'];    
                            
                }
                            
                }
                
                     
            } }
                               
                                  
                                  ?>  
                         <div class="addon-mn-row" style="color:#db6060;font-weight: bold;font-size: 10px;width: 31%"><?=$qty_weight?> IN STOCK  </div>   
                         <?php } ?> 
                             
                         </div>    
                             
              
                    <?php
                   
                     $slnodine++;
                     $amt=$amt+$addon_total;
                                         }
				
				 }
                                 
                          if($_SESSION['uae_tax_enable']=='Y'){
                          
                         
                            $amt=$amt/(1+($_SESSION['uae_tax_value']/100));
                          
                         }      
                      
                 $sql_menulist="SELECT pmr_name,ter_orderno,ter_slno,ter_unit_id,ter_base_unit_id,ter_new_rate_incl,ter_rate_type,ter_unit_weight,ter_unit_type,ter_branchid,ter_menuid,ter_portion,ter_rate,ter_qty,ter_status, ter_preference,ter_preferencetext,ter_orderfrom,ter_entrydate,ter_entrytime,ter_entryuser, ter_esttime,ter_staff,ter_type,ter_kotno,ter_billnumber,ter_feedbackrating,ter_feedbackremarks, ter_feedbackenter,ter_dayclosedate,ter_floorid,ter_cancel,ter_cancelledby_careof,ter_cancelledreason, ter_cancelledsecretkey,ter_cancelledlogin,ter_orderno_temp,ter_waiter_id FROM tbl_tableorder left join tbl_preferencemaster on pmr_id=ter_preference where ter_dayclosedate='".$_SESSION['date']."' and ter_orderno='".$_SESSION['order_id']."' and ter_qty>0  and ter_addon_slno IS NULL  and ter_combo_entry_id IS NULL order by ter_slno DESC";
           
		$sql_menus  =  $database->mysqlQuery($sql_menulist); 
		$num_menus  = $database->mysqlNumRows($sql_menus);
		if($num_menus){$_SESSION['submitbutst']="0";$sumamnt=0;
			while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
				{
                            
                            $icount++ ;
                        }
                        } 
                      
                      
                                 
                                 $icount+=$p;
                                 
                           if($_SESSION['incl_bill_format']=='N'){ 
                                 
                        echo '<script type="text/javascript">';
                        echo '$(document).ready(function(){';
                        echo '$(".tal_viewtotal").text(('.$amt.').toFixed('.$_SESSION["be_decimal"].'))';
                        echo '});';
                        echo '</script>';
                         }else{
                                         
                                          echo '<script type="text/javascript">';
                                        echo '$(document).ready(function(){';
                                        echo '$(".tal_viewtotal").text(('.$tot_incl_sub.').toFixed('.$_SESSION["be_decimal"].'))';
                                        echo '});';
                                        echo '</script>'; 
                           }  
                    
			echo '<script type="text/javascript">';
                        echo '$(document).ready(function(){';
                        echo  'if('.$kot_cancel_btn_check.'>0){';
                        echo  '$("#kot_cancel_pop_btn").show();';
                        echo  '}else{ $("#kot_cancel_pop_btn").hide(); }'; 
                        
                        echo '$(".total_itemcount").text('.$icount.')';
                        echo '});';
                        echo '</script>';	
//clearstatcache();

?>					
	 <input type="hidden"  value="<?=$kot_cancel_btn_check?>"  id="check_kot_count" > 				 
                    
<script src="js/menu_order.js"></script>   


 

    
                 