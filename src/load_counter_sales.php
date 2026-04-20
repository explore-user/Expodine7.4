
<?php

include('includes/session.php');   // Check session

include("database.class.php");     // DB Connection class
$database	= new Database(); //  Create a new instance

$con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
include("api_multiplelanguage_link.php");
error_reporting(0);
use Google\Client;
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
$opendate=  trim(json_encode($_SESSION['date']),'""');
$listimage=  trim(json_encode($_SESSION['s_listimage']),'""');

$floorid="";

if(isset($_REQUEST['value']) && $_REQUEST['value']=='subcatselection_old'){ 
    
    
	/***************Sub cat selection****************  */
    
 	 $categoryid=$_REQUEST['category'];
	 if(isset($_REQUEST['subcategory']))
	 {
		$_SESSION['sel_sub_id']=$_REQUEST['subcategory'];
	 }
         
	$sql_sub  =  $database->mysqlQuery("select distinct(mr_subcatid) as subid from tbl_menumaster where mr_active='Y' and mr_maincatid='".$categoryid."' and mr_subcatid IS NOT NULL order by mr_maincatid"); 
	$num_sub  = $database->mysqlNumRows($sql_sub);
	if($num_sub){ $k=0;$k++;
	?>
        <option value="all" <?php if($k==1 && !isset($_SESSION['sel_sub_id'])){ ?>  selected <?php } ?>>All</option>
        <?php
		while($result_sub  = $database->mysqlFetchArray($sql_sub)) 
			{ 
			if($result_sub['subid']!=""){
				$menusub=$database->show_subcategory_ful_details($result_sub['subid']);
				
	  ?>  
	<option value="<?=$menusub['msy_subcategoryid']?>" <?php if(isset($_SESSION['sel_sub_id'])){ if($_SESSION['sel_sub_id']==$result_sub['subid']) {?> selected="selected" <?php }} ?> ><?=$menusub['msy_subcategoryname']?></option>
	<?php } } } else { ?>
	<option value=""  selected >No Sub Category</option>
	<?php }

}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='subcatselection'){ 
    
     /*******Sub cat selection*******/
    
     ?>
        
    <script src="js/counter_sales.js"></script>
    <script>
        var len = $('script[src="js/counter_sales.js"]').length;
        if (len === 0) {
           $.getScript('js/counter_sales.js');
         }
  </script> 
  
  <style>.errorpaymentpop{position: absolute;left:0px;top: 0;color:#fff !important;padding:0 10px ;} </style>
    
    <?php
    
 	 $categoryid=$_REQUEST['category'];
	 if(isset($_REQUEST['subcategory']))
	 {
		 $_SESSION['sel_sub_id']=$_REQUEST['subcategory'];
	 }
                $sql_subcat = $database->mysqlQuery("select distinct(mr.mr_subcatid) as subid,msy_subcategoryid,msy_subcategoryname from "
                        . "tbl_menumaster as mr LEFT JOIN tbl_menusubcategory as ms ON mr.mr_subcatid=ms.msy_subcategoryid where (ms.msy_active='Y' "
                        . "OR mr_subcatid is NULL) and mr.mr_maincatid='" . $categoryid . "' order by ms.msy_sub_displayorder");
                                        
                                        $num_subcat = $database->mysqlNumRows($sql_subcat);
                                        if($num_subcat){
                                            $j = 0;
                                            $k=0;
                                            $k++;
                                ?>
                                        
							 
                              <div values="all" class="subcategory_items ta_subcatchange <?php if($k==1){ ?>  subctselected <?php } ?>"><?=$_SESSION['all_ta']?></div>
                              
                              <?php

                                                                  
                                            while ($result_subcat = $database->mysqlFetchArray($sql_subcat)) {
                                                 $k++;
                                                 
						$sub_catname=$result_subcat['msy_subcategoryname'];
                                                $sub_catid=$result_subcat['subid'];
                                           
                                                
                                                if($_SESSION['main_language']!='english'){

                                                    $sql_arabsubcat=$database->mysqlQuery("SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$_SESSION['main_language']."'");

                                                    $num_arabsubcat = $database->mysqlNumRows($sql_arabsubcat);
                                                    $result_arabsubcat = $database->mysqlFetchArray($sql_arabsubcat);
                                                    $sub_catname=$result_arabsubcat['mm_name'];
                                                   
                                                  
                                                     }
                                if($sub_catid!=""){
                                $menusub=$database->show_subcategory_ful_details($sub_catid);
                                if($sub_catname!=""){
?>  
                              
            <div values="<?=$sub_catid?>" class="subcategory_items ta_subcatchange"><?=$sub_catname?></div>
            
<?php }}  } } else {?>
            
            <div values="" class="subcategory_items ta_subcatchange"><?=$_SESSION['nosub_ta']?></div>
<?php } 


}else if(isset($_REQUEST['value']) && $_REQUEST['value']=='menuselection'){ 
    
  /************menu selection*************/
    
  $curdate=date("Y-m-d");$sql_menulist='';
  $categoryid=$_REQUEST['category'];
	
?>

<script src="js/counter_popup.js"></script>

<?php 
	if(isset($_REQUEST['subcategory'])){
            
        $sub_categoryid=$_REQUEST['subcategory'];
        $string=" and mr.mr_subcatid='" . $sub_categoryid . "' and ms.msy_active ='Y'";
        
        }else{
           $sub_categoryid="all"; 
           $string="";
        }
        
	        $sql_menulist = ("select mr.mr_stock_inventory, mr.mr_description,mr.mr_menuid,mr.mr_menuname,mr.mr_unit_type from tbl_menumaster as mr LEFT JOIN "
                . "tbl_menustock ON tbl_menustock.mk_menuid=mr.mr_menuid LEFT JOIN "
                . "tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid LEFT JOIN tbl_menusubcategory as ms ON "
                . "ms.msy_subcategoryid=mr.mr_subcatid  left join tbl_menurate_counter on mrc_menuid=mr.mr_menuid left join"
                . " tbl_menusubcategory as sb on sb.msy_subcategoryid=mr.mr_subcatid  WHERE mr.mr_stock_in_out='Y' and mc.mmy_active='Y' and ( (sb.msy_active='Y' &&"
                . " mr.mr_subcatid!='') ||  (mr.mr_subcatid is null) )  and mr.mr_active='Y' and  mr.mr_maincatid='" . $categoryid . "' $string and "
                . "tbl_menustock.mk_date='" . $_SESSION['date'] . "' and (mrc_rate >0 and mrc_rate IS NOT NULL)   "
                . "GROUP BY mr.mr_menuid order by mr_menuname ASC ");
        
        
       
                                    
                                    $sql_menus = $database->mysqlQuery($sql_menulist);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) { 
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                            
                                            $menu_name = $result_menus['mr_menuname'];
                                            $menu_id = $result_menus['mr_menuid'];
                                            $menu_desc=$result_menus['mr_description'];
                                            $menu_type_click= $result_menus['mr_unit_type'];
                                            $stock_in_no=$result_menus['mr_stock_inventory'];
                                          
       if($_SESSION['main_language']!='english'){

        $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join "
        . "tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

                                            $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                            $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                            $menu_name=$result_arabmenu['lm_menu_name'];
                                            
        }
                                             

        if($_SESSION['s_listimage'] == "Y") { 
                                                 
               $sql_img = "SELECT mes_imagethumb FROM tbl_menuimages where mes_menuid='" . $result_menus['mr_menuid'] . "' limit 0,1";
               $sql_imgs = $database->mysqlQuery($sql_img);
                $num_imgs = $database->mysqlNumRows($sql_imgs);
                if ($num_imgs) {
                while ($result_imgs = $database->mysqlFetchArray($sql_imgs)) {
                     $image = $result_imgs['mes_imagethumb'];
                  }
                  } else {
                     $image = "uploads/default_photo.jpg";
                  }
        }
                                            
                                          $portion="";
                                          $sql_menuportion = "select mrc_menuid from tbl_menurate_counter where mrc_menuid='".$result_menus['mr_menuid']."' and (mrc_rate >0 OR mrc_rate IS NOT NULL)";
                                         
                                          $sql_portions = $database->mysqlQuery($sql_menuportion);
                                            $num_portions = $database->mysqlNumRows($sql_portions);
                                            if ($num_portions) {
                                                
                                                $portion="Y";
                                           }
                     
                                            
                                            $portnstock = "N";
                                            $sql_menuportion1 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='$menu_id' AND mk_stock = 'Y'";
                                            $sql_portions1 = $database->mysqlQuery($sql_menuportion1);
                                            $num_portions1 = $database->mysqlNumRows($sql_portions1);
                                            if ($num_portions1) {
                                                $portnstock = "Y";
                                               
                                            }   
                                            
                                           $portn_click = "yes";
                                           $sql_menuportion12 = "SELECT mrc_portion from tbl_menurate_counter  where mrc_menuid='$menu_id' ";
                                            $sql_portions12 = $database->mysqlQuery($sql_menuportion12);
                                            $num_portions12 = $database->mysqlNumRows($sql_portions12);
                                            if ($num_portions12>1) {
                                                
                                                $portn_click = "no";
                                                 
                                            }    
                                            
                                           $dyno_rate = "";
                                           $sql_menuportion127 = "SELECT mr_manualrateentry from tbl_menumaster where mr_menuid='$menu_id' ";
                                            $sql_portions127 = $database->mysqlQuery($sql_menuportion127);
                                            $num_portions127 = $database->mysqlNumRows($sql_portions127);
                                            if ($num_portions127) {
                                                while ($result_imgs = $database->mysqlFetchArray($sql_portions127)) {
                                                       
                                                    if($result_imgs['mr_manualrateentry']=='Y'){
                                                    $dyno_rate = "yes";
                                                    }else{
                                                         $dyno_rate = 'no';
                                                    }
                                                    
                                            }
                                            } 
                                            
                                            
                                            
           $rtr=''; $rater=''; 
           $sql_menuportion127 = "SELECT * from tbl_menurate_counter mc left join tbl_portionmaster pm on pm.pm_id=mc.mrc_portion"
           . " left join tbl_base_unit_master tbu on tbu.bu_id=mc.mrc_base_unit_id left join tbl_unit_master tu on "
           . "tu.u_id=mc.mrc_unit_id where mc.mrc_menuid='$menu_id' ";
           
           $sql_portions127 = $database->mysqlQuery($sql_menuportion127);
           $num_portions127 = $database->mysqlNumRows($sql_portions127);
           if ($num_portions127) { 
                  while ($result_imgs = $database->mysqlFetchArray($sql_portions127)) {
                                                   
                   $rtr.= $result_imgs['u_name'].' '.$result_imgs['bu_name'].$result_imgs['pm_portionshortcode'].' : '.$result_imgs['mrc_rate'].'|'; 
                              
            } } 
                           
                           
     $rater= explode('|', $rtr) ;
     
      if ($_SESSION['s_listimage'] == "Y") { 
                                               $sql_img = "SELECT mes_imagethumb FROM tbl_menuimages where mes_menuid='$menu_id' limit 0,1";
                                              $sql_imgs = $database->mysqlQuery($sql_img);
                                                $num_imgs = $database->mysqlNumRows($sql_imgs);
                                               if ($num_imgs) {
                                                    while ($result_imgs = $database->mysqlFetchArray($sql_imgs)) {
                                                        $image = $result_imgs['mes_imagethumb'];
                                                        
                                                    }
                                                } else {
                                                     $image = "uploads/default_photo.jpg";
                                               }
                                            }     
     
     
     
                                             
     if(isset($_REQUEST['menuid'])){ ?>
<a title="<?=$menu_desc?>" typ_pop="<?=$menu_type_click?>" style="position: relative; "  <?php  if( $dyno_rate !='yes' && $_SESSION['be_single_click_add']=='Y'  && $menu_type_click !='Packet' && $menu_type_click !='Loose' && $portn_click=='yes') { ?> onclick="single_cart('<?=$menu_id?>','<?=$stock_in_no?>')" <?php } ?>  menuid="<?=$menu_id?>" class="ta_menuitem <?php if($menu_type_click =='Packet' || $_SESSION['be_single_click_add']=='N'  || $menu_type_click =='Loose' || $portn_click =='no' || $dyno_rate=='yes'){ ?> counter_popup_button <?php } if ($portnstock=="N") { ?> notinstock_cs <?php } ?>  <?php if ($portion == "N") { ?> noportionalert_cs <?php } ?>"  >
                    <div <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="width:185px;height:160px;padding:0;overflow:hidden;" <?php } ?> class="<?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> menu_sub_item <?php }else{ ?> menu_sub_item1 menu_1 <?php }  ?>  <?php if($_REQUEST['menuid']==$menu_id){ ?> take_item_active <?php } ?> "> 
                        
                        
                        <?php if ($_SESSION['s_listimage'] == "Y") { // image show permission  ?>
                         <div class="product_img" style="border-radius: 0px;height:110px;width:100%" ><img src="<?= $image ?>" /></div>
                        <?php } ?>

                        
                        
                        <?php if ($_SESSION['be_rate_on_button'] =='Y') { ?> 
                         <p style="height: 28px;margin-bottom: 0px;margin-top: -7px;line-height: 1.2;width:100%;<?php if($_SESSION['s_listimage'] == "N"){ ?> overflow: hidden;margin-top: -7px; <?php } ?>"> <?=$menu_name?></p> 
                             <?php } else{ ?>  <?=$menu_name?>  <?php } ?>    <span class="item_round"></span>
                    
                        
                        
                    <?php if ($portnstock=="Y" && $_SESSION['be_rate_on_button'] =='Y') { ?>  
                       
                       <span class="item_price"  style="<?php if($_SESSION['s_listimage']=="Y"){ ?> position:absolute;top:85px;padding:5px 0;background-color:#000000b8;left:0;color:#fff <?php }else{ ?> margin-top:-15px;  <?php } ?>" > <?=$rater[0].$rater[1]?> <?=$rater[2].$rater[3]?> </span>
           
            

                   <?php } ?>
                    
                    
                    
                    
                    
     </div></a>

     <?php } else { ?>

     	<a title="<?=$menu_desc?>" typ_pop="<?=$menu_type_click?>" style="position: relative; " <?php  if($dyno_rate !='yes' && $_SESSION['be_single_click_add']=='Y' &&  $menu_type_click !='Packet' && $menu_type_click !='Loose' && $portn_click=='yes') { ?> onclick="single_cart('<?=$menu_id?>','<?=$stock_in_no?>')" <?php } ?>  menuid="<?=$menu_id?>" class="ta_menuitem <?php if($menu_type_click =='Packet' || $_SESSION['be_single_click_add']=='N'  || $menu_type_click =='Loose' || $portn_click =='no' || $dyno_rate=='yes'){ ?> counter_popup_button <?php } if ($portnstock=="N") { ?> notinstock_cs <?php } ?>  <?php if ($portion == "N") { ?> noportionalert_cs <?php } ?>"  >
            <div <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="width:185px;height:160px;padding:0;overflow:hidden;" <?php } ?> class="<?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> menu_sub_item <?php }else{ ?> menu_sub_item1 menu_1 <?php }  ?> ">

       <?php if ($_SESSION['s_listimage'] == "Y") { // image show permission  ?>
            <div class="product_img" style="border-radius: 0px;height:110px;width:100% "><img src="<?= $image ?>" ></div>
       <?php } ?>



        <?php if ($_SESSION['be_rate_on_button'] =='Y') { ?>  <p style="height: 28px;margin-bottom: 0px;margin-top: -7px;line-height: 1.2;width:100%;<?php if($_SESSION['s_listimage'] == "N"){ ?> overflow: hidden;margin-top: -7px; <?php } ?>"> <?=$menu_name?></p> <?php } else{ ?>  <?=$menu_name?>  <?php } ?> <span class="item_round"></span>
            
             <?php if ($portnstock=="Y" && $_SESSION['be_rate_on_button'] =='Y') { ?>  
                       
              <span class="item_price"  style="<?php if($_SESSION['s_listimage']=="Y"){ ?> position:absolute;top:85px;padding:5px 0;background-color:#000000b8;left:0;color:#fff <?php }else{ ?> margin-top:-15px;  <?php } ?>" > <?=$rater[0].$rater[1]?> <?=$rater[2].$rater[3]?> </span>
           
            
        <?php } ?>
             
    </div></a>

    <?php } ?>

    <?php  }} else
    {
	echo "<span style='color: #F00E0E;margin-left: 43%;'> Nothing to display </span>";
    }
 }
 else  if(isset($_REQUEST['value']) && $_REQUEST['value']=='loaditemsorderd'){ 
     
 ?>

    <script src="js/counter_each.js"></script>
    <script src="js/counter_sales.js"></script>
 
    <!-------COMBO MENUS CART DISPLAY STARTS-------->  
    
    <?php
    if( $_SESSION['be_combo_enable']=="Y"){  
        
        
                                          $slno=0;
                                          $total=0;
                                          $sql_combo_name_list =  $database->mysqlQuery("select cbd.cbd_regen_status,tkb.tab_regen_status,cbd.cbd_count_combo_ordering,cbd.cbd_combo_pack_id,cbd.cbd_order_status,cbd.cbd_combo_total_rate,cbd.cbd_combo_qty,cbd.cbd_combo_preference , cn.cn_name,cn.cn_stock_check,cp.cp_pack_name FROM tbl_combo_bill_details_ta cbd
                                              left join tbl_takeaway_billmaster tkb on tkb.tab_billno = cbd.cbd_billno                                     
                                              left join tbl_combo_name cn on cn.cn_id = cbd.cbd_combo_id
                                              left join tbl_combo_packs cp on cp.cp_id = cbd.cbd_combo_pack_id
                                              where tkb.tab_dayclosedate='".$_SESSION['date']."' and  cbd.cbd_billno='".$_SESSION['cs_order_id']."' group by cbd_count_combo_ordering  order by cbd.cbd_entry_date asc limit 250");
                                              $num_combo_name_list = $database->mysqlNumRows($sql_combo_name_list);
                                              if($num_combo_name_list!=NULL){ $p=0;
                                              while ($result_combo_name_list = $database->mysqlFetchArray($sql_combo_name_list)) {
                                                 
                                                  if($result_combo_name_list['cbd_combo_qty']>=0){
                                                  $p++; $combo_preference=array();
                                                  $slno++;
                                                  $total+=$result_combo_name_list['cbd_combo_total_rate'];

                                                  
                                         $reg_sts_cb=$result_combo_name_list['tab_regen_status'];
                                         $reg_item_cb='N';  
                                         if($reg_sts_cb=='Y'){
                                            
                                         if($result_combo_name_list['cbd_regen_status']=='Y') {
                                              
                                          $reg_item_cb='Y';
                                               
                                        }
                                            
                                        }
                                                  
                                        ?>  
                
                                     <div class="preference_table combo_added_sec <?php if($reg_item_cb !='N'){ ?> disablegenerate <?php } ?> <?php if ($result_combo_name_list['cbd_order_status'] == "Generated" || $result_combo_name_list['cod_order_status'] == "Billed" || $result_combo_name_list['cbd_order_status'] == "Closed") { ?> odr_served <?php } ?> <?php if ($result_combo_name_list['cbd_order_status'] == "Opened") { ?> odr_confirmed <?php } ?> <?php if ($result_combo_name_list['cbd_order_status'] == "NotInStock") { ?> odr_notinstock <?php } ?>" id="<?=$p?>" style="cursor:pointer">
                                     <div class="menu_order_dishname_cc combo_menu_div" id="<?=$p?>" status="<?=$result_combo_name_list['cbd_order_status']?>" combo_pack_id="<?=$result_combo_name_list['cbd_combo_pack_id']?>" combo_pack_qty="<?=$result_combo_name_list['cbd_combo_qty']?>" cod_count_combo_ordering="<?=$result_combo_name_list['cbd_count_combo_ordering']?>">
                                          <div class="menu_order_dish_name"><span><?=$slno?>)</span> <?=$result_combo_name_list['cn_name']?> <?=$result_combo_name_list['cp_pack_name']?></div>
                                                <div class="menuodr_rate_cc">
                                                  <div class="dine_menu_rate">Rate : <?=$result_combo_name_list['cbd_combo_total_rate']?></div>
                                                  <div class="dine_menu_qty" id="combo_pack_qty_cart">Qty : <?=$result_combo_name_list['cbd_combo_qty']?></div>
                                              </div>
                                        </div>
                                              <?php if ($result_combo_name_list['cbd_order_status']== "Generated" || $result_combo_name_list['cbd_order_status']== "NotInStock") { ?>
                                              <a href="#" class="preferance_table_btn">
                                                      <span style="padding:3px;border-radius:3px;margin: 1px 6px 0 0;float: right;" class="hold_list_add" id="ta_delete_item" onclick=" return delete_cs_item('combo_count','<?=$result_combo_name_list['cbd_count_combo_ordering']?>');"><img src="img/close-icon.png"></span>
                                              </a>
                                              <?php } 
                                              ?>
                                              <div class="combo-preview-secion">
                                                  <span class="menu_eachpc_head">Menus In Each Pack:</span>
                                                      <?php
                                                      $sql_combo_cart_list =  $database->mysqlQuery("select cbd.cbd_billno, cbd.cbd_combo_id, cbd.cbd_combo_pack_id, cbd.cbd_slno,cbd.cbd_combo_qty, cbd.cbd_combo_total_rate, cbd.cbd_menu_id, sum(cbd.cbd_menu_qty) as cbd_menu_qty, 
                                                                                                  cbd.cbd_combo_preference, cbd.cbd_entry_date, cbd.cbd_dayclosedate, cbd.cbd_order_status,cn.cn_name,cp.cp_pack_name,  mm.mr_menuname,mm.mr_menuid,cpm.cpm_menu_sale_type
                                                                                                  FROM tbl_combo_bill_details_ta cbd
                                                                                                  left join tbl_combo_name cn on cn.cn_id = cbd.cbd_combo_id
                                                                                                  left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                                                                  left join tbl_combo_pack_menus cpm on cpm.cpm_menu_id=cbd.cbd_menu_id and cpm.cpm_combo_pack_id=cbd.cbd_combo_pack_id
                                                                                                  left join tbl_menumaster mm on mm.mr_menuid=cbd.cbd_menu_id
                                                                                                  where cbd.cbd_dayclosedate='".$_SESSION['date']."' and  cbd.cbd_billno='".$_SESSION['cs_order_id']."' and cbd.cbd_count_combo_ordering='".$result_combo_name_list['cbd_count_combo_ordering']."' group by cbd.cbd_menu_id,cbd.cbd_order_status limit 250 " ); 
              
                                                      $num_combo_cart_list = $database->mysqlNumRows($sql_combo_cart_list);
                                                      if($num_combo_cart_list){$i=0;
                                                       while ($result_combo_cart_list = $database->mysqlFetchArray($sql_combo_cart_list)) {                
                                                         $i++;
                                                           if($result_combo_cart_list['cbd_combo_preference']!=''){
                                                           $combo_preference[]=$result_combo_cart_list['cbd_combo_preference'];
                                                           }
                                                      ?>

                                              <div class="addon-mn-row">
                                                  <div class="addon-preview-secion-mn-1"><span><?=$i?>)</span><span class="cart_menu_list" menu_type="<?=$result_combo_cart_list['cpm_menu_sale_type']?>" id1="<?=$p?>" menuid="<?=$result_combo_cart_list['mr_menuid']?>" menuqty="<?=$result_combo_cart_list['cbd_menu_qty']?>"> <?=$result_combo_cart_list['mr_menuname']?></span></div> 
                                                  <div class="addon-preview-secion-qty">Qty:<span class="cart_menu_qty"><?=$result_combo_cart_list['cbd_menu_qty']?></span></div>
                                              </div>
                                                  <?php 
                                                      }}
                                                  ?>
                                              </div>

                                        <?php if(!empty($combo_preference)){ ?>
                                        <div class="menu_order_preference_text" >Pref: <span class="cart_menu_preference" id1="<?=$p?>"><?=implode(',',array_unique($combo_preference))?></span></div>
                                        <?php } ?>

                                      </div>
  <?php }}} } ?>

          <!----------COMBO MENUS DISPALY ENDS---------->
 
 
          <table width="100%" border="0">
                             
          <?php 
                                
          $localIP = getHostByName(getHostName());
          $total2=0;
	  $tot_incl_sub=0;
          $order_unit_weight='';
          $order_packet_or_loose='';
          $unit_weight_name='';
                                
	  $sql_menulist= "Select tbl_menumaster.mr_stock_inventory,tbl_takeaway_billdetails.tab_disc_before,tbl_takeaway_billdetails.tab_rate_before_comp,
          tbm.tab_regen_status, tbl_takeaway_billdetails.tab_regen_status_menu, tbl_menumaster.mr_menuid,tbl_menumaster.mr_menuname,
          tbl_portionmaster.pm_portionshortcode as portioncode,tbl_portionmaster.pm_id as porname,
          tbl_menumaster.mr_itemshortcode as menu,tbl_takeaway_billdetails.tab_qty as qty ,
          tbl_takeaway_billdetails.tab_menuid as menuid,tbl_takeaway_billdetails.tab_slno as slno,tbl_takeaway_billdetails.tab_amount,
          tbl_takeaway_billdetails.tab_preferencetext,tbl_takeaway_billdetails.tab_rate, 
          tbl_takeaway_billdetails.tab_new_rate_incl,tbl_takeaway_billdetails.tab_unit_id,tbl_takeaway_billdetails.tab_base_unit_id,
          tbl_takeaway_billdetails.tab_rate_type,tbl_takeaway_billdetails.tab_unit_weight,tbl_takeaway_billdetails.tab_unit_type,
          u.u_id,u.u_name,bu.bu_id,bu.bu_name
          From  tbl_takeaway_billmaster tbm
          left Join tbl_takeaway_billdetails On tbm.tab_billno = tbl_takeaway_billdetails.tab_billno
          left Join tbl_menumaster On tbl_takeaway_billdetails.tab_menuid = tbl_menumaster.mr_menuid 
          left Join tbl_portionmaster On tbl_takeaway_billdetails.tab_portion = tbl_portionmaster.pm_id 
          left join tbl_unit_master u on u.u_id=tbl_takeaway_billdetails.tab_unit_id
          left join tbl_base_unit_master bu on bu.bu_id=tbl_takeaway_billdetails.tab_base_unit_id
          Where tbl_takeaway_billdetails.tab_dayclose_in='".$_SESSION['date']."' and 
          tbm.tab_dayclosedate='".$_SESSION['date']."'  and tbl_takeaway_billdetails.tab_billno = '".$_SESSION['cs_order_id']."'
          AND tbm.tab_mode ='CS' and tab_count_combo_ordering IS NULL AND tbl_takeaway_billdetails.tab_bill_addon_slno  IS  NULL
          order by tbl_takeaway_billdetails.tab_entrytime desc limit 250";
                                
	  $sql_menus  =  $database->mysqlQuery($sql_menulist); 
	  $num_menus  = $database->mysqlNumRows($sql_menus);
	  if($num_menus){   $_SESSION['submitbutst']="1"; $i=1;
          while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
          { 
                                  
              
              
                                        $tot_incl_sub=$tot_incl_sub+($result_menus['qty']*$result_menus['tab_new_rate_incl']);
                                        
                                        $reg_sts=$result_menus['tab_regen_status'];
                                        $reg_item='N'; 
                                         
                                        if($reg_sts=='Y'){
                                            
                                          if($result_menus['tab_regen_status_menu']=='Y') {
                                               
                                            $reg_item='Y';
                                               
                                          }
                                            
                                        }
                                        
                                            $slno++;
                                            $portion_shortcode='';
                                            $unit_weight_name='';
                                            
                                            $ordermenu_idcs=$result_menus['mr_menuid'];
                                            $ordermenu_cs=$result_menus['mr_menuname'];
                                            
                                            $order_unit_weight=  $result_menus['tab_unit_weight'];
                                            $order_packet_or_loose=  $result_menus['tab_unit_type'];
                                       
                                      if($result_menus['tab_rate_type']=='Portion'){
                                            
                                        $portion_shortcode= '('.$result_menus['portioncode'].')';  
                                       }
                                       else if($result_menus['tab_rate_type']=='Unit'){
                                            
                                       if($result_menus['tab_unit_type']=='Packet'){
                                                
                                         $unit_weight_name= $order_packet_or_loose.': '.number_format($order_unit_weight,3).' '.$result_menus['u_name'];
                                       }
                                       else if($result_menus['tab_unit_type']=='Loose'){
                                                
                                         $unit_weight_name= $order_packet_or_loose.': '.number_format($order_unit_weight,3).' '.$result_menus['bu_name'];
                                       }
                                       
                                      }
                                      
                                    if($_SESSION['main_language']!='english'){

                                         $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages "
                                         . " on ls_id=lm_language_id WHERE lm_menu_id='".$ordermenu_idcs."' and "
                                         . " ls_language='".$_SESSION['main_language']."'");

                                            $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                            $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                            $ordermenu_cs=$result_arabmenu['lm_menu_name'];
                                          
                                      }
                                            
                                            
                                            $total+=$result_menus['tab_amount'];
                                            $discount_name=array();
                                            
                                            $discountname = $database->mysqlQuery("SELECT tbd_discount_remarks FROM tbl_takeaway_item_discount"
                                            . " where tbd_billno='".$_SESSION['cs_order_id']."' and tbd_slno='".$result_menus['slno']."'");
                                           
                                            $num_discountname = $database->mysqlNumRows($discountname);
                                            if ($num_discountname) {
                                             while ($rs_discountname = $database->mysqlFetchArray($discountname)) {
                                                 $discount_name[] = $rs_discountname['tbd_discount_remarks'];
                                             }
                                            }else {
                                                 $discount_name[] = "";
                                            }
                                            
                                             
                                              
                                            $tax_in1 = $database->mysqlQuery("SELECT amc_value,amc_unit FROM tbl_extra_tax_master te left "
                                            . " join tbl_menu_tax_master tem on tem.mtm_tax_id=te.amc_id where te.amc_active='Y' "
                                            . " and te.amc_enable_cs='Y' and te.amc_item_tax='Y' and tem.mtm_menuid='".$result_menus['menuid']."'  ");
                                            $num_tx1 = $database->mysqlNumRows($tax_in1);
                                            if ($num_tx1) {
                                                while ($tx_in1 = $database->mysqlFetchArray($tax_in1)) {
                                                    
                                                    $tax_value1=$tx_in1['amc_value'];
                                                    $tax_unit1=$tx_in1['amc_unit'];
                                                    
                                                    if($tax_unit1=="P"){
                                                       
                                                      $total2=  $total2+($result_menus['tab_amount']*$tax_value1/100);
                                                         
                                                    }else if($tax_unit1=="V"){
                                                       
                                                      $total2=  $total2+$tax_value1;;
                                                      
                                                    }
                                                    
                                                 }
                                                }
                                                  
			    ?>
                                   
                            <input type="hidden" id="checkid" >
                            <tr class="<?php if($reg_item !='N'){ ?> disablegenerate <?php } ?>" >
                              
                            <?php if($_SESSION['ser_com_item']=='Y' || $_SESSION['ser_item_discount_manual']=='Y'){ ?> 
                                   
                            <td style="padding-left: 1px " width="12%" >    
                                   
                            <?php if($_SESSION['ser_com_item']=='Y'){ ?>
                                <input title="COMPLIMENTARY ITEM" <?php if($result_menus['tab_rate_before_comp']>0){ ?> checked <?php } ?> style="cursor:pointer;" onclick="comp_bill('<?=$result_menus['menuid']?>','<?=$_SESSION['cs_order_id']?>','<?=$result_menus['porname']?>','<?=$result_menus['tab_unit_id']?>','<?=$result_menus['tab_base_unit_id']?>','<?=$result_menus['tab_unit_weight']?>','<?=$result_menus['slno']?>')" type="checkbox" class="comp_bill" id="comp_bill_<?=$result_menus['menuid']."_".$result_menus['slno']?>">  
                            <?php } ?>
                                
                                
                             <?php if($_SESSION['ser_item_discount_manual']=='Y'  && $result_menus['tab_disc_before']==0){ ?>
                                
                                     <span style="padding-right: 13px;float: right; " title="ITEM DISCOUNT" width="3%" >
                                     <span  style="cursor:pointer;" onclick="item_dis_bill('<?=$result_menus['menuid']?>','<?=$_SESSION['cs_order_id']?>','<?=$result_menus['porname']?>','<?=$result_menus['tab_unit_id']?>','<?=$result_menus['tab_base_unit_id']?>','<?=$result_menus['tab_unit_weight']?>','<?=$result_menus['slno']?>','<?=$result_menus['tab_rate']?>','<?=$result_menus['tab_new_rate_incl']?>','<?=$ordermenu_cs?>'  )" type="checkbox" class="item_dis_bill" id="item_dis_bill_<?=$result_menus['menuid']."_".$result_menus['slno']?>">
                                     <img src='img/discount_ico.png' style="width:25px" > </span>
                                     </span>        
                            
                            <?php } ?> 
                                
                            </td>
                                
                            <?php } ?>   
                                
                                
                                <td class="eachitem_counter <?php if($reg_item !='N'){ ?> disablegenerate <?php } ?>" menuid="<?=$result_menus['menuid']?>"sln="<?=$result_menus['slno']?>" actqty="<?=$result_menus['qty']?>" portionname="<?=$result_menus['porname']?>" pref="<?=$result_menus['tab_preferencetext']?> " rate="<?=$result_menus['tab_rate']?>"  style="text-align:left;padding-left: 3%;<?php if($result_menus['tab_rate_before_comp']>0){ ?> pointer-events:none <?php } ?>" width="40%"><?=$ordermenu_cs?><?php if($result_menus['portioncode']!='') { echo $portion_shortcode ;}?>
                                <?php  if($unit_weight_name!=''){ ?>
                                    <span class="counter_right_unit" colspan="4"><?= $unit_weight_name?> </p></span>
                                <?php } ?>
                                </td>
                               
                                <td width="20%">
                                <span class="qty_incr_btn_sec_cc">
                                       
                                <?php if( $_SESSION['be_single_click_add']=='Y' ) { ?>
                                <span onclick="minus_single('<?=$result_menus['menuid']?>','<?=$_SESSION['cs_order_id']?>','<?=$result_menus['qty']?>','<?=$result_menus['porname']?>','<?=$result_menus['tab_unit_id']?>','<?=$result_menus['tab_base_unit_id']?>','<?=$result_menus['tab_unit_weight']?>','<?=$result_menus['slno']?>');" class="qty_incr_btn minus_button_cs">-</span>
                                <?php } ?>
                                        
                                <input class="qty_incr_val" readonly type="text" value="<?=$result_menus['qty']?>">
                                        
                                <?php if( $_SESSION['be_single_click_add']=='Y' ) { ?>
                                        
                                <span onclick="plus_single('<?=$result_menus['menuid']?>','<?=$_SESSION['cs_order_id']?>','<?=$result_menus['porname']?>','<?=$result_menus['tab_unit_id']?>','<?=$result_menus['tab_base_unit_id']?>','<?=$result_menus['tab_unit_weight']?>','<?=$result_menus['slno']?>');" class="qty_incr_btn">+</span>
                                <?php } ?>
                                </span>
                                </td>
                                
                               <?php  if($_SESSION['incl_bill_format']=='N'){  ?>
                               <td  width="20%"><?=number_format($result_menus['tab_amount'],$_SESSION['be_decimal'])?></td>
                               <?php }else{ ?>   
                               <td  width="20%"><?=number_format($result_menus['tab_new_rate_incl']*$result_menus['qty'],$_SESSION['be_decimal'])?></td>
                               <?php }?>   

                               <td width="10%"><span style="padding: 6px 0;border-radius:3px" class="hold_list_add" id="cs_delete_item" onclick="return delete_cs_item('<?=$result_menus['menuid']?>','<?=$result_menus['slno']?>');"><img src="img/close-icon.png"></span></td>

                               <?php
                                  
                                   $tax_in1 = $database->mysqlQuery("SELECT tmp_pref_name,tmp_qty FROM tbl_menu_preference_kot where tmp_menu='".$result_menus['menuid']."' and tmp_orderno_bill= '".$_SESSION['cs_order_id']."' ");
                                          $num_tx1 = $database->mysqlNumRows($tax_in1);
                                          if($num_tx1) {
                                              
                                            ?>
                                  
                              <tr class="addon_section_head" style="text-align: left "><td style="padding-left: 20px;color: #6ABEDF ">PREFERENCE</td></tr>
                                    <?php
                                    while ($tx_in11 = $database->mysqlFetchArray($tax_in1)) {
                                  
                                     ?>
                                     <tr  class="addon_section">
                                     <td style='text-align:left;color:lightgray; height:auto;padding-left:6px;padding-bottom:7px; text-transform: uppercase;'>
                                     <div>
                                      
                                   
                                     <div style="padding-left: 14px;text-align: left ">
                                     <?=$tx_in11['tmp_pref_name'].' : '.$tx_in11['tmp_qty']?>
                                     </div> 
                                         
                                     </div>
                                     </td>
                                     </tr> 
                                      
                                    <?php }} ?>
                               
                               
                              </tr>
                              
                              <?php if(!empty($discount_name)) { ?>
                              <tr><td style='    font-size: 10px;text-align:left;font-weight:bold !important ;color:#fd5659; height:auto;padding-left:6px;padding-bottom:7px; text-transform: uppercase;' colspan='5'><?php for($s=0;$s<count($discount_name);$s++) {if($s>0){ echo ',';} echo $discount_name[$s]; }?></td></tr> 
                              <?php }?>  
                              
                              <tr style="background-color: transparent; border-bottom: 1px rgba(0, 0, 0, 0.15) solid;margin-bottom: 3px">
                                   
                              <td class="pref-td-take-away" colspan="5">
                                 <?php if(strlen(trim($result_menus['tab_preferencetext']))>1){   ?>
                                          
                                 <span class="counter_right_pref" style="margin-bottom: 10px;" colspan="4"><p style="font-size: 15px" >PREF : <?=str_replace(',,',',',$result_menus['tab_preferencetext'])?></p></span>
                                <?php } ?>
                              </td>
                                  
                                    <?php
                                    
                                   
                                    
                                        $sql_addon_menus  =  $database->mysqlQuery("select tbd.tab_slno, tbd.tab_qty, tbd.tab_amount,mm.mr_itemshortcode
                                        FROM tbl_takeaway_billdetails tbd left join tbl_menumaster mm on mm.mr_menuid=tbd.tab_menuid
                                        WHERE tbd.tab_bill_addon_slno  IS NOT NULL and tbd.tab_billno='".$_SESSION['cs_order_id']."' and "
                                        . " tbd.tab_bill_addon_slno='".$result_menus['slno']."' order by tbd.tab_slno asc limit 250"); 
                                        $num_addon_menus  = $database->mysqlNumRows($sql_addon_menus);
                                        if($num_addon_menus){ $addon_sl=0;
                                        
                                   ?>    
                                        
                                        <tr class="addon_section_head"><td  colspan="5">ADD ON</td></tr>
                                        <tr  class="addon_section">
                                            
                                            <td colspan="5">
                                                <?php
                                                while($result_addon_menus  = $database->mysqlFetchArray($sql_addon_menus)){
                                                    $addon_sl++;
                                                    $total+=$result_addon_menus['tab_amount'];
                                                ?>
                                                <div class="addon-mn-row-ad">
                                                    <div class="addon-preview-secion-mn-1"><span><?=$addon_sl?>)</span> <?=$result_addon_menus['mr_itemshortcode']?></div> 
                                                    <div class="addon-preview-secion-qty">Qty:<?=$result_addon_menus['tab_qty']?></div>
                                                    <div class="addon-preview-secion-rate">Rate: <?=number_format(str_replace(',','',$result_addon_menus['tab_amount']),$_SESSION['be_decimal'])?></div>
                                                </div>
                                                <?php } ?>
                                            </td>
                                         </tr>
                                    <?php } ?>  
                              </tr>
                              
                              
                         <?php  if($result_menus['mr_stock_inventory']=='Y') {
                             
                             $qty_weight=0;
         $sql_general1 =  $database->mysqlQuery("Select sum(ts_qty) as qty ,ts_rate_type, sum(ts_weight) as weight,ts_unit "
         . " from tbl_store_stock where ts_product='".$result_menus['mr_menuid']."' "); 
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
                              <tr><td style="color:#db6060;font-weight: bold;font-size: 10px;width: 23%"><?=$qty_weight?> IN STOCK  </td></tr>
                         <?php } ?>  
                       
    <?php  }  
				
    }else{  
        
        $_SESSION['submitbutst']="0";
    }
                
    if($_SESSION['uae_tax_enable']=='Y'){
        
        $total=$total/(1+($_SESSION['uae_tax_value']/100));
                          
    }
    
         $minus_tot=0;                                       
         $new_tot = $database->mysqlQuery("SELECT sum(tab_amount) as minus_tot FROM tbl_takeaway_billdetails left Join tbl_takeaway_billmaster 
         On tbl_takeaway_billmaster.tab_billno = tbl_takeaway_billdetails.tab_billno
         WHERE tbl_takeaway_billmaster.tab_billno = '".$_SESSION['cs_order_id']."' and  tab_dayclosedate='".$_SESSION['date']."' "
         . " AND tab_menuid IN(SELECT mr_menuid "
         . " FROM  tbl_menumaster WHERE mr_excempt_tax ='Y') limit 250");
           $num_1 = $database->mysqlNumRows($new_tot);
           if ($num_1) {
           while ($new_tot_amt = $database->mysqlFetchArray($new_tot)) {
               
             $minus_tot=$new_tot_amt['minus_tot'];
           }
           }          
                 
             $new_tot_all=($total-$minus_tot);
                
            $total1=0;
            $tax_in = $database->mysqlQuery("SELECT amc_value,amc_unit FROM tbl_extra_tax_master where amc_active='Y' and amc_enable_cs='Y' and amc_item_tax!='Y' ");
            $num_tx = $database->mysqlNumRows($tax_in);
            if ($num_tx) {
            while ($tx_in = $database->mysqlFetchArray($tax_in)) {
                
                   $tax_value=$tx_in['amc_value'];
                   $tax_unit=$tx_in['amc_unit'];

                   if($tax_unit=="P"){

                       $total1=  $total1+($new_tot_all*$tax_value/100);

                   }else if($tax_unit=="V"){

                       $total1=  $total1+$tax_value;

                   }

        } }
                                
                        $tax_in1_rf = $database->mysqlQuery("SELECT bsc_nearest_roundoff FROM tbl_branch_settings_counter ");
                        $num_tx1_rf = $database->mysqlNumRows($tax_in1_rf);
                         if ($num_tx1_rf) {
                         while ($tx_in1_rf = $database->mysqlFetchArray($tax_in1_rf)) {

                               $rof_ta=$tx_in1_rf['bsc_nearest_roundoff'];
                         } }
                         
                                      
                        if($rof_ta==0){
                            
                                   $tot_tax_in=($total1+$total2);
                                   $tot_new_in= ($total+$total1+$total2);	 
                        }else{
                                   $tot_tax_in=($total1+$total2);
                                  
                                   $tot_new_in= ($rof_ta*round(($total+$total1+$total2)/$rof_ta));	 
                        }
                               
        if($_SESSION['incl_bill_format']=='Y'){ 
            
                            echo '<script type="text/javascript">';
                            echo '$(document).ready(function(){';
                            echo '$(".tal_viewtotal").text(('.($tot_incl_sub).').toFixed('.$_SESSION["be_decimal"].'))';
                            echo '});';
                            echo '</script>';
                            
         }else{
                           
                       echo '<script type="text/javascript">';
                       echo '$(document).ready(function(){';
                       echo '$(".tal_viewtotal").text(('.($total).').toFixed('.$_SESSION["be_decimal"].'))';
                       echo '});';
                       echo '</script>';
                           
        }

                            echo '<script type="text/javascript">';
                            echo '$(document).ready(function(){';
                            echo '$(".total_itemcount2").text('.$slno.')';
                            echo '});';
                            echo '</script>';

                            echo '<script type="text/javascript">';
                            echo '$(document).ready(function(){';
                            echo '$(".final_show").text(('.($tot_new_in).').toFixed('.$_SESSION["be_decimal"].'))';
                            echo '});';
                            echo '</script>';

                            echo '<script type="text/javascript">';
                            echo '$(document).ready(function(){';
                            echo '$(".tax_show").text(('.($tot_tax_in).').toFixed('.$_SESSION["be_decimal"].'))';
                            echo '});';
                            echo '</script>';

                            echo '<script type="text/javascript">';
                            echo '$(document).ready(function(){';
                            echo '$("#tot_org").val(('.($total).').toFixed('.$_SESSION["be_decimal"].'))';
                            echo '});';
                            echo '</script>';
                
                
  ?>
                              
  </table>
              
  <?php
  
 
  }else  if(isset($_REQUEST['value']) && $_REQUEST['value']=='menudelete_clear'){ 
  
          ////////stockupdate//////
      
          $sql_qry111 = $database->mysqlQuery("select tab_qty,tab_menuid,tab_portion from tbl_takeaway_billdetails 
          where  tab_billno = '".$_SESSION['cs_order_id']."' ");
        
              $num_rows111 = $database->mysqlNumRows($sql_qry111);
              if($num_rows111){
              while($result_row111 = $database->mysqlFetchArray($sql_qry111)){
      
              $qty_update= $database->mysqlQuery( "UPDATE tbl_menustock SET "
              . " mk_stock_number=mk_stock_number+'".$result_row111['tab_qty']."' "
              . " where mk_menuid= '".$result_row111['tab_menuid']."' "
              . " and mk_portion= '".$result_row111['tab_portion']."' and mk_open_stock_date='".$_SESSION['date']."' and mk_opening_stock >0 ");
      
           }
        }
        
        
 ////stockend///////
        
        
 $database->mysqlQuery("delete from  tbl_takeaway_billmaster where tab_billno='".$_SESSION['cs_order_id']."' and tab_status='Generated' "); 
 
 $database->mysqlQuery("delete from  tbl_takeaway_billdetails where tab_billno='".$_SESSION['cs_order_id']."' and tab_status='Generated' ");
                
 $database->mysqlQuery("delete from  tbl_combo_bill_details_ta where cbd_billno='".$_SESSION['cs_order_id']."'"); 
                

 $database->mysqlQuery("delete from  tbl_menu_preference_kot where tmp_orderno_bill='".$_SESSION['cs_order_id']."'"); 
 
 
 
 //$database->mysqlQuery("delete from  tbl_takeaway_billmaster where tab_billno='' "); 
 
 //$database->mysqlQuery("delete from  tbl_takeaway_billdetails where tab_billno='' ");
 
 
     $orderid="TEMP*".$database->getEpoch();
    // $_SESSION['cs_order_id']=$orderid;
     
     $date1 = time();

	$date2 = mktime(0,0,0,12,31,1979);

	$dateDiff = $date1 - $date2;

        $localIP = getHostByName(getHostName()); 
        
        $ln=  strlen($localIP);
        
        
        $ips=  substr($localIP,($ln-3),3);
        
        
	 $_SESSION['cs_order_id']=  "TEMP*".substr($dateDiff,0,7).$ips;
 
 }
 else  if(isset($_REQUEST['value']) && $_REQUEST['value']=='menudelete'){ 
     
  if($_REQUEST['menuid']!='combo_count'){   
    $mn=explode(",",$_REQUEST['menuid']);
    $sl=explode(",",$_REQUEST['sln']);
    $rate=0;
    
	$ct=count($mn);
	for($i=0;$i<$ct;$i++)
	{       
          
        $qty=0;
        $qty_ordered= $database->mysqlQuery(" select tbd.tab_menuid,tbd.tab_portion,tbd.tab_amount,tbd.tab_qty,tbd.tab_rate_type,tbd.tab_unit_type,tbd.tab_unit_id,tbd.tab_base_unit_id,tbd.tab_unit_weight from tbl_takeaway_billdetails tbd where tbd.tab_billno ='". $_SESSION['cs_order_id']."' and tab_menuid='".$mn[$i]."' and tab_slno='".$sl[$i]."' LIMIT 1 "); 
        
        $num_qty_ordered  = $database->mysqlNumRows($qty_ordered);
        if($num_qty_ordered){
            $result_qty_ordered =  $database->mysqlFetchArray($qty_ordered);
            
            if($result_qty_ordered['tab_rate_type']=='Portion'){
                $qty_update= $database->mysqlQuery( "UPDATE `tbl_menustock` SET `mk_stock_number`=`mk_stock_number`+'".$result_qty_ordered['tab_qty']."' where `mk_menuid`= '".$result_qty_ordered['tab_menuid']."' and `mk_portion`='".$result_qty_ordered['tab_portion']."'");
             
                
            }
            else { 
                if($result_qty_ordered['tab_unit_type']=='Packet'){
                  $qty_update= $database->mysqlQuery( "UPDATE `tbl_menustock` SET `mk_stock_number`=`mk_stock_number`+'".$result_qty_ordered['tab_qty']."' where `mk_menuid`= '".$result_qty_ordered['tab_menuid']."' and `mk_unit_id`='".$result_qty_ordered['tab_unit_id']."' and `mk_unit_weight`='".$result_qty_ordered['tab_unit_weight']."'");   
                }
                else if ($result_qty_ordered['tab_unit_type']=='Loose'){
                 $qty_update= $database->mysqlQuery( "UPDATE `tbl_menustock` SET `mk_stock_number`=`mk_stock_number`+'".$result_qty_ordered['tab_qty']."' where `mk_menuid`= '".$result_qty_ordered['tab_menuid']."'and `mk_base_unit_id`='".$result_qty_ordered['tab_base_unit_id']."'");   
                }
            }
            
      
        $database->mysqlQuery("UPDATE tbl_takeaway_billmaster tbm SET tbm.tab_subtotal=(`tab_subtotal`-'".$result_qty_ordered['tab_amount']."') where  tab_billno='".$_SESSION['cs_order_id']."'");
        $database->mysqlQuery("delete from  tbl_takeaway_billdetails where tab_billno='".$_SESSION['cs_order_id']."' and tab_menuid='".$mn[$i]."'  and tab_slno='".$sl[$i]."' ");     
        
           }
        
        $qty_ordered_addon= $database->mysqlQuery(" select tbd.tab_slno,tbd.tab_menuid,tbd.tab_portion,tbd.tab_amount,tbd.tab_qty,tbd.tab_rate_type from tbl_takeaway_billdetails tbd where tbd.tab_billno ='". $_SESSION['cs_order_id']."'  and tab_bill_addon_slno='".$sl[$i]."'  "); 
       
        $num_qty_ordered_addon  = $database->mysqlNumRows($qty_ordered_addon);
        if($num_qty_ordered_addon){
            while($result_qty_ordered_addon =  $database->mysqlFetchArray($qty_ordered_addon)){
            
                $qty_update_addon= $database->mysqlQuery( "UPDATE `tbl_menustock` SET `mk_stock_number`=`mk_stock_number`+'".$result_qty_ordered_addon['tab_qty']."' where `mk_menuid`= '".$result_qty_ordered_addon['tab_menuid']."' and `mk_portion`='".$result_qty_ordered_addon['tab_portion']."'");
                
                $database->mysqlQuery("UPDATE tbl_takeaway_billmaster tbm SET tbm.tab_subtotal=(`tab_subtotal`-'".$result_qty_ordered_addon['tab_amount']."') where  tab_billno='".$_SESSION['cs_order_id']."'");
                $database->mysqlQuery("delete from  tbl_takeaway_billdetails where tab_billno='".$_SESSION['cs_order_id']."' and  tab_slno='".$result_qty_ordered_addon['tab_slno']."' and  tab_bill_addon_slno='".$sl[$i]."' ");
                }
        }    
            
        
         $database->mysqlQuery("delete from  tbl_menu_preference_kot where tmp_orderno_bill='".$_SESSION['cs_order_id']."' and tmp_menu='".$mn[$i]."' "); 
     
        
	}
   }else{
      
        $database->mysqlQuery(" Delete from  tbl_takeaway_billdetails where tab_billno='".$_SESSION['cs_order_id']."' and tab_count_combo_ordering='".$_REQUEST['sln']."' ");
        $database->mysqlQuery(" update tbl_takeaway_billmaster set tab_subtotal= tab_subtotal-( select cbd.cbd_combo_total_rate  FROM tbl_combo_bill_details_ta cbd where cbd.cbd_billno='".$_SESSION['cs_order_id']."' and cbd.cbd_count_combo_ordering='".$_REQUEST['sln']."' LIMIT 1) WHERE tab_billno='".$_SESSION['cs_order_id']."'");
        
       
        
        $sql_delete_qty  =  $database->mysqlQuery("select cbd.cbd_combo_qty, cbd.cbd_combo_pack_id  FROM tbl_combo_bill_details_ta cbd where cbd.cbd_billno='".$_SESSION['cs_order_id']."' and cbd.cbd_count_combo_ordering='".$_REQUEST['sln']."' LIMIT 1"); 
	
        $num_delete_qty  = $database->mysqlNumRows($sql_delete_qty);
	if($num_delete_qty){
            $result_delete_qty  = $database->mysqlFetchArray($sql_delete_qty);
			
            $database->mysqlQuery("update tbl_combo_stock set cs_stock_number = cs_stock_number +'".$result_delete_qty['cbd_combo_qty']."' where cs_pack_id='".$result_delete_qty['cbd_combo_pack_id']."'");
           
            
        }
        $database->mysqlQuery(" DELETE FROM `tbl_combo_bill_details_ta` WHERE `cbd_billno`='".$_SESSION['cs_order_id']."' and `cbd_count_combo_ordering`='".$_REQUEST['sln']."'");
    }    
	echo "ok";
        
        
        $sql_sub  =  $database->mysqlQuery("select tab_billno from  tbl_takeaway_billdetails where tab_billno='".$_SESSION['cs_order_id']."' "); 
	$num_sub  = $database->mysqlNumRows($sql_sub);
	if(!$num_sub){
            
         $database->mysqlQuery("delete from  tbl_takeaway_billmaster where tab_billno='".$_SESSION['cs_order_id']."'");    
        }
        
        
 
 }else  if(isset($_REQUEST['value']) && $_REQUEST['value']=='menusearch_counter'){ 
  $sql_sub  =  $database->mysqlQuery("select mr_menuid as menuid from tbl_menumaster where mr_active='Y' and mr_itemcode='".$_REQUEST['menuname']."' "); 
	$num_sub  = $database->mysqlNumRows($sql_sub);
	if($num_sub){
		while($result_sub  = $database->mysqlFetchArray($sql_sub)) 
			{ 
			echo $result_sub['menuid'];
			}
	}else
	{
		echo "sorry";
	}
        
 }else if(isset($_REQUEST['value']) && $_REQUEST['value']=='menusearch'){ 
  /* **************************************Search menu item****************************************************  */
  unset($_SESSION['sel_sub_id']);
  $menuname=$_REQUEST['menuname'];
  $curdate=date("Y-m-d");
  //$sql_login  =  $database->mysqlQuery("select mr.mr_menuid,mr.mr_maincatid,mr.mr_subcatid from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=mr.mr_menuid	WHERE mc.mmy_active='Y' and mr.mr_active='Y' and tbl_menustock.`mk_stock`='Y' and tbl_menustock.mk_date='".$curdate."' and mr.mr_menuname = '".$menuname."' "); 
  $sql_login  =  $database->mysqlQuery("select mr.mr_menuid,mr.mr_maincatid,mr.mr_subcatid from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid   WHERE mc.mmy_active='Y' and mr.mr_active='Y' and mr.mr_menuname = '".$menuname."' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$_SESSION['sr_menuid']=$result_login['mr_menuid'];
				$_SESSION['sr_catid']=$result_login['mr_maincatid'];
				$_SESSION['sr_subd']=$result_login['mr_subcatid'];
				echo $result_login['mr_menuid'].",".$result_login['mr_maincatid'].",".$result_login['mr_subcatid'];
			}
			
	  }else
	  {
		  echo "sorry";
	  }
  
  
}else if(isset($_REQUEST['value']) && $_REQUEST['value']=="loadcreditypes") 
{
	$credittype=$_REQUEST['credittype'];
	$xmltype='';
	$pref='';
        
	?>
          
             <?php if($credittype=='2'||$credittype=='1'){ ?><span style="float:left;display:block" class="room_no_txt  counter_right_lable"><?php if($credittype=='1') { ?> Room No <?php } else if($credittype=='2') { ?> Staff Name <?php } ?></span>
             <span class="room_text_box_cc" style="width:51%">
             <select  class="staff_menu_select counter_text_box tax_textbox" name="selectcreditdetails" id="selectcreditdetails" style="float: right;width: 97%;margin:3%;color:#000">
             <option value=""><?=$_SESSION['payment_pending_select_roomname']?></option>
				<?php
                    
		    if($credittype=="1")
		    {
                        
                    $xmltype='roommaster';$pref="rm_";
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => $_SESSION['be_expolitelink']."/occupiedrooms",
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
                    $result=json_decode($response,true);
                }
                $room_numbers=implode(',',$result['data']);
                $sql_roomnumber  =  $database->mysqlQuery("update tbl_credit_master cm,tbl_roommaster rm  set cm.crd_active ='N'  where rm.rm_roomid=cm.crd_roomid   and cm.crd_type='1' ");
              
                $sql_roomnumber1  =  $database->mysqlQuery("update tbl_credit_master cm,tbl_roommaster rm  set cm.crd_active ='Y'  where rm.rm_roomid=cm.crd_roomid  and rm.rm_roomno  IN ($room_numbers) and cm.crd_type='1' ");
               
                 $sql_ds_nos="select cm.crd_id as id,rm.rm_roomno as names,rm.rm_roomid as main_id from tbl_credit_master as cm LEFT JOIN tbl_roommaster as rm ON cm.crd_roomid=rm.rm_roomid where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$_SESSION['branchofid']."' AND cm.crd_active='Y' AND rm.rm_status='Y' ORDER BY rm_roomid ASC ";
		
                 
                }
                else if($credittype=="2")
		{
                    
                 $xmltype='staffmaster_first';
                 $sql_ds_nos="select cm.crd_id as id,sm.ser_firstname as names,sm.ser_staffid as main_id from tbl_credit_master as cm  LEFT JOIN tbl_staffmaster as sm ON cm.crd_staffid=sm.ser_staffid where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$_SESSION['branchofid']."' AND cm.crd_active='Y' AND  sm.ser_employeestatus='Active' ORDER BY cm.crd_id  DESC";
		}
//                else if($credittype=="3")
//		  {$xmltype='corporate';
//                 $sql_ds_nos="select cm.crd_id as id,cp.ct_corporatename as names,cp.ct_corporatecode as main_id  from tbl_credit_master as cm  LEFT JOIN tbl_corporatemaster as cp ON cm.crd_corporateid=cp.ct_corporatecode where cm.crd_type='".$credittype."' AND cm.crd_branchid='".$_SESSION['branchofid']."' AND cm.crd_active='Y' ORDER BY cm.crd_id  DESC";
//		  }
                $sql_ds  =  $database->mysqlQuery($sql_ds_nos); 
                $num_ds = $database->mysqlNumRows($sql_ds);
                if($num_ds){ 
                 while($result_ds = $database->mysqlFetchArray($sql_ds)) 
                  {
						
                  ?>    
          
             <option value="<?=$result_ds['id']?>" ><?php echo $result_ds['names']; ?></option>
         
             <?php } } ?>  
             
             </select>
                 
             </span>
              
             <?php }
             
               else if($credittype=="3" ||$credittype=="4") {?>  
 
                   
               <?php if($credittype=="3"){ ?>
                     
                   <span class="room_no_txt " style="margin-top:12px;">Company Name</span>
                  
                   <?php }else if($credittype=="4"){ ?>
        
                   <span class="room_no_txt " style="margin-top:12px;">Guest Name</span>
                 
        
                     <?php } ?>
        
                <?php if($credittype=="4"){ ?>
                 
                    <span class="room_text_box_cc" style="width: 49%;margin: 2%;margin-bottom:0;">
                      
                    <input style="float: right;width: 100%;" type="text" Placeholder="Enter Name"  class="staff_menu_select counter_text_box tax_textbox" name="selectcreditdetailsname" id="selectcreditdetailsname" onclick=" return name_search_click();" onchange=" return name_search(this.value)" onkeyup=" return name_search(this.value)" autocomplete="off">
                    <div id="suggession_name" style="display: none "></div>
                   
                   </span>
                 
               <?php } ?>
                    
               <?php if($credittype=="3"){?>
                 
                 <span class="room_text_box_cc" style="width: 49%;margin: 2%;margin-bottom:0;">
                 <select name="selectcreditdetailsname" id="selectcreditdetailsname"  class="staff_menu_select counter_text_box tax_textbox">
                     
                    <?php
                    $sql_login  =  $database->mysqlQuery("select ct.ct_corporatename from tbl_corporatemaster ct left join tbl_credit_master cm on cm.crd_corporateid=ct.ct_corporatecode  where ct.ct_status='Y' and cm.crd_active='Y' "); 
	            $num_login   = $database->mysqlNumRows($sql_login);
	            if($num_login){
		    while($result_login  = $database->mysqlFetchArray($sql_login)) 
		    {
                         ?>
                        
                    <option value="<?=$result_login['ct_corporatename']?>"><?=$result_login['ct_corporatename']?></option>
                        
                    <?php }}?>
                        
                    </select>
                    
                   <?php } ?>
                    
                   </span>
                    
                    
                <?php if($credittype=="4"){ ?>
                    
                <span class="room_no_txt " style="margin-top: 12px;font-size: 12px"> Number - Name -ID </span>
                <span class="room_text_box_cc" style="width:49%;margin: 2%;margin-bottom: 0;margin-top:0">
                <input style="float: right;width: 100%;    margin-top: 5px;" type="text" Placeholder="Enter Number Or Name Or ID "  class="staff_menu_select counter_text_box tax_textbox" name="selectcreditdetailsnumber" id="selectcreditdetailsnumber" onkeypress="return numdot77(event);" onclick=" return number_search(this.value)" onchange=" return number_search(this.value)" onkeyup=" return number_search(this.value)" maxlength="12" autocomplete="off">
                <div id="suggession_number" style="display:none"></div>
                </span>
                    
                <?php } } ?>
                
                
            <span style="float:left;margin-left: 0px;margin-top: 6px;" class="room_no_txt counter_right_lable crd_cls"><?=$_SESSION['payment_pending_creditamount']?></span>
            
            <span class="room_text_box_cc" style="width:51%">
             
            <input  placeholder="Enter Credit Amount" style="float: left;width:38%;margin-top: 2px;" class="tax_textbox transa_txt counter_text_box" id="amount_credit" name="amount_credit"  readonly="readonly">
           
            <?php if($_SESSION['s_default_company']=='Z'){ ?>
                <strong id="check_del_div" style="margin-right: 5px;margin-top: 5px;float:right; color: darkred;display:block;border: solid 1px;border-radius: 3px"> &nbsp; ONLINE ORDER &nbsp; </strong>
            <?php } ?> 
            
            </span>
            
            
   
<?php

}else if(isset($_REQUEST['value']) && $_REQUEST['value']=="gensettle_first") 
{   
    
    $table_name='';
    $pax='';
    $csname=$_REQUEST['csname'];
    $csphone=$_REQUEST['csphone'];
    $csgst=$_REQUEST['csgst'];
    
    if(isset($_REQUEST['table_cs'])){
         $table_name=$_REQUEST['table_cs'];
    }
    
    if(isset($_REQUEST['pax'])){
          $pax=   $_REQUEST['pax'];
    }
    
    $discountof=0;
    if($_REQUEST['discount_of']!=""){
          $discountof=$_REQUEST['discount_of'];
    }
      
    if($_REQUEST['redeemamount']!=""){
           $redeem_amt=$_REQUEST['redeemamount'];
    }else{
           $redeem_amt=0;
    }
       
   
    
	try {
             // echo  $_SESSION['cs_order_id'].'*'.$_SESSION['branchofid'].'*'.$_REQUEST['discount'].'*'.$discountof.'*'.$_REQUEST['discount_unit'].'*'.
             // $_SESSION['expodine_id'].'*'.$table_name.'*'.$pax.'*'.$redeem_amt.'*'.$_REQUEST['discountid'].'---';
             
	$database->mysqlQuery("SET @temp_billno	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['cs_order_id']) . "'");
	$database->mysqlQuery("SET @branchid	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$database->mysqlQuery("SET @discount	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['discount']) . "'");
	$database->mysqlQuery("SET @discount_of	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$discountof) . "'");
	$database->mysqlQuery("SET @discount_unit	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['discount_unit']) . "'");
        $database->mysqlQuery("SET @loginid 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']) . "'");	
        $database->mysqlQuery("SET @table 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$table_name ).  "'");	
        $database->mysqlQuery("SET @pax 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$pax) . "'");
        $database->mysqlQuery("SET @redeem 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$redeem_amt) . "'");
  
	 $message=''; $discountid='';  $new_billno='';
         
	 if($_REQUEST['discountid']=='none')
	 {
		$discountid=0;
	 }
	 else
	 {
               $discountid=$_REQUEST['discountid'];
	 }
         
	$database->mysqlQuery("SET @discountid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$discountid) . "'");
        
        
	$kotno="";
	$sq=$database->mysqlQuery("CALL  proc_gencounter_bill(@temp_billno,@branchid,@discount,@discount_of,@discount_unit,@discountid,@loginid,@table,@pax,@redeem,@new_billno,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
	$rs = $database->mysqlQuery( 'SELECT @new_billno AS billnumber,@message as message' );
	$billnos="";$kotnos="";
	while($row = mysqli_fetch_array($rs))
	{
	   $_SESSION['billno']= $row['billnumber'];
	   $msg= $row['message'];
        
	}
       //echo $msg;
        
        
        $sql_listall5  =  $database->mysqlQuery("update tbl_menu_preference_kot set tmp_orderno_bill='".$_SESSION['billno']."' where tmp_orderno_bill='".$_SESSION['cs_order_id']."' ");
        
       
      
       $sql_listall588  =  $database->mysqlQuery("update tbl_takeaway_billmaster set tab_netamt=tab_total  WHERE tab_dayclosedate ='".$_SESSION['date']."' and tab_billno='".$_SESSION['billno']."'  and  tab_netamt<(tab_total+tab_roundoff_value)  ");       
       
       
       if(substr($_SESSION['billno'], 0,2)=='C2'){
           
        $orderid="TEMP*".$database->getEpoch();
        // $_SESSION['cs_order_id']=$orderid;
            
        $date1 = time();

	$date2 = mktime(0,0,0,12,31,1979);

	$dateDiff = $date1 - $date2;

        $localIP = getHostByName(getHostName()); 
        
        $ln=  strlen($localIP);
        
        $ips=  substr($localIP,($ln-3),3);
        
	$_SESSION['cs_order_id']=  "TEMP*".substr($dateDiff,0,7).$ips;
            
       }
        
        
    $query326=$database->mysqlQuery(" update tbl_takeaway_billdetails set tab_amount='0',tab_rate='0',tab_org_rate='0'  where tab_dayclose_in='".$_SESSION['date']."' and tab_count_combo_ordering > '0' and  tab_billno='".$_SESSION['billno']."' ");        
      
    ///cs loy pop //
    
    if($_REQUEST['loy_name']!='' && $_REQUEST['loy_number']!='' && $_REQUEST['loy_number']!='undefined' ){   
           
     $sql_listall5  =  $database->mysqlQuery("SELECT ly_mobileno from tbl_loyalty_reg  WHERE ly_mobileno='".$_REQUEST['loy_number']."' "); 
     $num_listall5  = $database->mysqlNumRows($sql_listall5);
     if(!$num_listall5){ 
     $sql_taxdetails  =  $database->mysqlQuery("INSERT INTO `tbl_loyalty_reg`(`ly_firstname`,`ly_mobileno`,ly_branchid,ly_totalvisit,ly_loy_login,ly_module,ly_default) VALUES ('".$_REQUEST['loy_name']."','".$_REQUEST['loy_number']."','1','0','1','CS','Y')");
      
       $query328=$database->mysqlQuery("update  tbl_loyalty_reg set ly_default='N',ly_module=''  where ly_module='CS' and ly_mobileno!='".$_REQUEST['loy_number']."' ");
    } }
     
    
     $default_loy='';  $default_loy_id=''; $bill_amount=0; $rd_loy_pt=0;  $pt_add=0; $rd_loy_amt=0; $def_name='';
     
        $sql_listall  =  $database->mysqlQuery("SELECT ly_id,ly_firstname from tbl_loyalty_reg  WHERE ly_module='CS' and ly_default='Y' limit 1 "); 
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){  $default_loy='Y';
	while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
		{	
                    $default_loy_id=$row_listall['ly_id'];
                    $def_name=$row_listall['ly_firstname'];
                    
        $sql_listall5  =  $database->mysqlQuery("SELECT tab_netamt from tbl_takeaway_billmaster  WHERE tab_billno='".$_SESSION['billno']."' "); 
	$num_listall5  = $database->mysqlNumRows($sql_listall5);
	if($num_listall5){  $default_loy='Y';
	while($row_listall5  = $database->mysqlFetchArray($sql_listall5)) 
	{	
            
            $bill_amount=$row_listall5['tab_netamt'];
        }
        }     
                 
                                $amount_rule_add=1; $point_rule_add=1;
                                $sql_desg_nos1190="select lyp_point,lyp_amount from tbl_loyalty_pointrule";

				$sql_desg1190  =  $database->mysqlQuery($sql_desg_nos1190);
				$num_desg1190  = $database->mysqlNumRows($sql_desg1190);
			      
				if($num_desg1190){
				while($result_desg1190  = $database->mysqlFetchArray($sql_desg1190)) 
				{
						$point_rule_add=$result_desg1190['lyp_point'];					
						$amount_rule_add=$result_desg1190['lyp_amount'];
                                }}
                                 
       $pt_add= ($bill_amount/$amount_rule_add)*$point_rule_add;
       $date= date('Y-m-d H:i:s');
        
       $insertion['lob_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['billno']));
          
       if($pt_add>0){
        $insertion['lob_point_add']= mysqli_real_escape_string($database->DatabaseLink,trim($pt_add));
       }
      
       if($rd_loy_pt>0){
        $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim($rd_loy_pt));
       }
       
        if($rd_loy_amt>0){
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($rd_loy_amt));
        }
        
         if($_REQUEST['point_redeem']>0){
        $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['point_redeem']));
       }
       
        if($_REQUEST['redeemamount']>0){
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['redeemamount']));
        }
        
        $insertion['lob_bill_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($bill_amount));
         
        $insertion['lob_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
       
        $insertion['lob_loyalty_customer']= mysqli_real_escape_string($database->DatabaseLink,trim($default_loy_id));
      
        $insertion['lob_mode']= mysqli_real_escape_string($database->DatabaseLink,trim('CS'));
      
       $sql=$database->check_duplicate_entry('tbl_loyalty_pointadd_bill',$insertion);
       if($sql!=1)
	{
	$insertid      =  $database->insert('tbl_loyalty_pointadd_bill',$insertion);
        }
        
        if($rd_loy_pt>0){
           $sql_loy=$database->mysqlQuery("update tbl_loyalty_reg set ly_points=(ly_points-'".$rd_loy_pt."') where ly_id='".$default_loy_id."'");  
           
        }
        
        if($pt_add>0){ 
          $sql_loy=$database->mysqlQuery("update tbl_loyalty_reg set ly_points=(ly_points+'".$pt_add."'),ly_totalvisit=ly_totalvisit+1  where ly_id='".$default_loy_id."'");
       
        }
        
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            $sms_number='';  $sms_text="";
	   
                   if($rd_loy_pt>0){
                       $rd="You have redeemed ".number_format($rd_loy_pt,$_SESSION['be_decimal'])." points.";
                   }
                   
                   if($pt_add>0){
                       $ad="You have earned ".number_format($pt_add,$_SESSION['be_decimal'])." points.";
                   }
                   
                $common="(CS) Visit Again . Thank You .\n".$_SESSION['s_branchname']	;
		$l_name=$def_name;
		$sms_text="Congratulations ".$l_name.".\n".$rd."\n".$ad."\n".$common;
                $date_sms = date('Y-m-d H:i:s');
                 
                $sql_split_insert=$database->mysqlQuery("INSERT INTO tbl_loyalty_sms_source(ls_sms_data, ls_date_sendon,ls_login_name) VALUES ('".$sms_text."','".$date_sms."','".$_SESSION['expodine_id']."')");  
                $sms_number='';
		$message=urlencode($sms_text);
	
        } }
                 
        }else{
                      
         ///add redeeem ///
                        
        if($_REQUEST['point_redeem']>0 ||  $_REQUEST['point_add']>0 ){
        
          $date= date('Y-m-d H:i:s');
        
          $insertion['lob_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['billno']));
          
         if($_REQUEST['point_add']>0){
           $insertion['lob_point_add']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['point_add']));
         }
      
         if($_REQUEST['point_redeem']>0){
           $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['point_redeem']));
         }
       
        if($_REQUEST['redeemamount']>0){
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['redeemamount']));
        }
        
        $insertion['lob_bill_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['billamount']));
         
        $insertion['lob_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
       
        $insertion['lob_loyalty_customer']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['id_loy']));  
         
        $insertion['lob_mode']= mysqli_real_escape_string($database->DatabaseLink,trim('CS'));
      
       $sql=$database->check_duplicate_entry('tbl_loyalty_pointadd_bill',$insertion);
       if($sql!=1)
	{
	  $insertid     =  $database->insert('tbl_loyalty_pointadd_bill',$insertion);
        }
        
        if($_REQUEST['point_redeem']>0){
           $sql_loy=$database->mysqlQuery("update tbl_loyalty_reg set ly_points=(ly_points-'".$_REQUEST['point_redeem']."') where ly_id='".$_REQUEST['id_loy']."'");  
           
        }
        
        if($_REQUEST['point_add']>0){ 
          $sql_loy=$database->mysqlQuery("update tbl_loyalty_reg set ly_points=(ly_points+'".$_REQUEST['point_add']."'),ly_totalvisit=ly_totalvisit+1  where ly_id='".$_REQUEST['id_loy']."'");
       
        }
        
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            $sms_number='';  $sms_text="";
	   
                   if($_REQUEST['point_redeem']>0){
                       $rd="You have redeemed ".number_format($_REQUEST['point_redeem'],$_SESSION['be_decimal'])." points.";
                   }
                   
                    if($_REQUEST['point_add']>0){
                       $ad="You have earned ".number_format($_REQUEST['point_add'],$_SESSION['be_decimal'])." points.";
                   }
                   
                $common="(CS) Visit Again . Thank You .\n".$_SESSION['s_branchname']	;
		$l_name=$_REQUEST['loy_name'];
		$sms_text="Congratulations ".$l_name.".\n".$rd."\n".$ad."\n".$common;
                $date_sms = date('Y-m-d H:i:s');
                 
                $sql_split_insert=$database->mysqlQuery("INSERT INTO tbl_loyalty_sms_source(ls_sms_data, ls_date_sendon,ls_login_name) VALUES ('".$sms_text."','".$date_sms."','".$_SESSION['expodine_id']."')");  
                $sms_number=$_REQUEST['loy_number'];
		$message=urlencode($sms_text);
	
           }
          
          }
          
          
        }
                 
        $sql_menulist= "SELECT ly_id,ly_firstname,ly_mobileno,ly_gst FROM  tbl_loyalty_reg  WHERE ly_default='Y' "
        . " and ly_module='CS' order by ly_id desc limit 1 ";
	$sql_menus  =  $database->mysqlQuery($sql_menulist); 
	$num_menus  = $database->mysqlNumRows($sql_menus);
	if($num_menus){
	while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
	{
            $query325=$database->mysqlQuery(" update  tbl_takeaway_billmaster set tab_loy_id='".$result_menus['ly_id']."',"
            . " tab_name='".$result_menus['ly_firstname']."',tab_phone='".$result_menus['ly_mobileno']."',"
            . " tab_gst='".$result_menus['ly_gst']."' WHERE tab_dayclosedate ='".$_SESSION['date']."' and tab_billno='".$_SESSION['billno']."' ");
         
            $query328=$database->mysqlQuery("update  tbl_loyalty_reg set ly_default='N',ly_module=''  where ly_module='CS' ");
        
        }}
        
	$sql_listall  =  $database->mysqlQuery("SELECT tab_subtotal_final,tab_tips_given,tab_subtotal as subtot,tab_netamt as tot,tab_discountvalue  as disc from tbl_takeaway_billmaster   WHERE tab_billno='".$_SESSION['billno']."'  "); 
	$num_listall  = $database->mysqlNumRows($sql_listall);
	if($num_listall){
		  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
			   {
				if($_SESSION['uae_tax_enable']=='Y'){ 
                                  $subt=$row_listall['tab_subtotal_final'];  
                                }else{
				  $subt=$row_listall['subtot'];
                                }
                                
				$tot=$row_listall['tot'];
				$disc=$row_listall['disc'];
                                $tip_amount=number_format(str_replace(',', '', $row_listall['tab_tips_given']),$_SESSION['be_decimal']);
                            }
			}
                        
                        $tax_name='';
                        $tax_value='';
                        $sql_taxdetails  =  $database->mysqlQuery("SELECT tbe_total_value,tbe_label   from tbl_takeaway_bill_extra_tax_master  WHERE tbe_dayclose ='".$_SESSION['date']."' and tbe_billno='".$_SESSION['billno']."'"); 
                        $num_taxdetails  = $database->mysqlNumRows($sql_taxdetails);
                        if($num_taxdetails){$p=0;
                            while($row_taxdetails  = $database->mysqlFetchArray($sql_taxdetails)) {
                            $p++;
                            if($p==1){ $tax_name= $row_taxdetails['tbe_label'];
                                $tax_value=$row_taxdetails['tbe_total_value'];
                            }
                            else{ $tax_name.='<>'. $row_taxdetails['tbe_label'];
                                $tax_value.='<>'.$row_taxdetails['tbe_total_value'];
                            }
                        } }
                         
        $item_ds=0;                
        $sql_listall_ds  =  $database->mysqlQuery("SELECT sum(tab_discount)as disc,tab_qty from  tbl_takeaway_billdetails   WHERE tab_dayclose_in='".$_SESSION['date']."'  and tab_discount>0 and tab_billno='".$_SESSION['billno']."'  "); 
	$num_listall_ds  = $database->mysqlNumRows($sql_listall_ds);
	if($num_listall_ds){
		  while($row_listall_ds  = $database->mysqlFetchArray($sql_listall_ds)) 
			   {
                                $item_ds=number_format(str_replace(',', '', ($row_listall_ds['disc']*$row_listall_ds['tab_qty'])),$_SESSION['be_decimal']);
                            }
			}   
                         
	     echo $subt.",".$tot.",".$disc.",".$tax_name.",".$tax_value.",".$_SESSION['billno'].",".$tip_amount.",".$item_ds;
             
        
        
	  } catch (Exception $e) {
                  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }
	  
}else if(isset($_REQUEST['value']) && $_REQUEST['value']=='searchnameonly')
  {
 	/**************************Search menu name*************************/
  
 	$data = array();
	$name=($_REQUEST['term']);
	$date=date("Y-m-d");
        
        
	$sql_login  =  $database->mysqlQuery("select tlm.lm_menu_name,tbl_menumaster.mr_menuname,tbl_menumaster.mr_menuid from tbl_menumaster LEFT JOIN "
                 . " tbl_menurate_counter ON  tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid  LEFT JOIN tbl_menustock ON "
                 . " tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON "
                 . " tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid left join tbl_menusubcategory as sb on "
                 . " sb.msy_subcategoryid=tbl_menumaster.mr_subcatid left join tbl_language_menu_master tlm  on tlm.lm_menu_id=tbl_menumaster.mr_menuid"
                 . "  WHERE (tbl_menumaster.mr_menuname LIKE '".$name."%'  or "
                 . " tbl_menumaster.mr_itemcode = '".$name."' or tlm.lm_menu_name like '".$name."%')  and tbl_menustock.mk_date='".$_SESSION['date']."'  "
                 . " and tbl_menumaster.mr_stock_in_out='Y' and tbl_menumaster.mr_active='Y' and tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid "
                 . " and mc.mmy_active='Y' and  ( (sb.msy_active='Y' && tbl_menumaster.mr_subcatid!='') ||  (tbl_menumaster.mr_subcatid is null) )"
                 . " group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
	
         $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                       $portnstock1 = "N";
                                           $sql_menuportion11 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                            $sql_portions11 = $database->mysqlQuery($sql_menuportion11);
                                            $num_portions11 = $database->mysqlNumRows($sql_portions11);
                                            if ($num_portions11) {
                                                $portnstock1 = "Y";
                                                
                                            } 
                      
                      
				$sts='';
				if($portnstock1=="N") $sts="####";
				$data[] = array(
					  'label' => $sts.$result_login['mr_menuname'].' '.$result_login['lm_menu_name'],
					  'label2' => $result_login['mr_menuname'],
					  'value' => $result_login['mr_menuid'],
					   'id' => $result_login['mr_menuid']
			     );
			}
	  }
	  
	  $sql_login  =  $database->mysqlQuery("select tlm.lm_menu_name,tbl_menumaster.mr_menuname,tbl_menumaster.mr_menuid from tbl_menumaster LEFT JOIN "
                  . " tbl_menurate_counter ON  tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid  LEFT JOIN tbl_menustock ON "
                  . " tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON "
                  . " tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid  left join tbl_menusubcategory as sb on "
                  . " sb.msy_subcategoryid=tbl_menumaster.mr_subcatid  left join tbl_language_menu_master tlm  on tlm.lm_menu_id=tbl_menumaster.mr_menuid "
                  . " WHERE (tbl_menumaster.mr_menuname LIKE '%".$name."%'  AND  "
                  . " tbl_menumaster.mr_menuname NOT LIKE '%".$name."' or tbl_menumaster.mr_itemcode = '".$name."' and  tbl_menumaster.mr_itemcode "
                  . " not like '%".$name."' or tlm.lm_menu_name like '%".$name."%' and tlm.lm_menu_name not like '%".$name."')  and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' and tbl_menumaster.mr_stock_in_out='Y' and "
                  . " tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid and mc.mmy_active='Y' and  "
                  . " ( (sb.msy_active='Y' && tbl_menumaster.mr_subcatid!='') ||  (tbl_menumaster.mr_subcatid is null) ) "
                  . " group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      
                       $portnstock12 = "N";
                                           $sql_menuportion112 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                            $sql_portions112 = $database->mysqlQuery($sql_menuportion112);
                                            $num_portions112 = $database->mysqlNumRows($sql_portions112);
                                            if ($num_portions112) {
                                                $portnstock12 = "Y";
                                               
                                            }
				$sts='';
				if($portnstock12=="N") $sts="####";
				if(!in_array_r($sts.$result_login['mr_menuname'], $data))
				{
					  $data[] = array(
							'label' => $sts.$result_login['mr_menuname'].' '.$result_login['lm_menu_name'],
							'label2' => $result_login['mr_menuname'],
							'value' => $result_login['mr_menuid'],
							 'id' => $result_login['mr_menuid']
					   );
				}
			}
	  }
          
	  
	  $sql_login  =  $database->mysqlQuery("select tlm.lm_menu_name,tbl_menumaster.mr_menuname,tbl_menumaster.mr_menuid from tbl_menumaster LEFT JOIN "
          . " tbl_menurate_counter ON  tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid LEFT JOIN tbl_menustock ON "
          . " tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON "
          . " tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid left join tbl_menusubcategory as sb on "
          . " sb.msy_subcategoryid=tbl_menumaster.mr_subcatid left join tbl_language_menu_master tlm  on tlm.lm_menu_id=tbl_menumaster.mr_menuid"
          . "  WHERE (tbl_menumaster.mr_menuname LIKE '%".$name."' or "
          . " tbl_menumaster.mr_itemcode = '".$name."' or tlm.lm_menu_name like '%".$name."'  )  and tbl_menustock.mk_date='".$_SESSION['date']."'  and "
          . " tbl_menumaster.mr_active='Y'  and tbl_menumaster.mr_stock_in_out='Y' and tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid and mc.mmy_active='Y' and "
          . " ( (sb.msy_active='Y' && tbl_menumaster.mr_subcatid!='') ||  (tbl_menumaster.mr_subcatid is null) ) "
          . "group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                                           $portnstock122 = "N";
                                           $sql_menuportion1122 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                           $sql_portions1122 = $database->mysqlQuery($sql_menuportion1122);
                                           $num_portions1122 = $database->mysqlNumRows($sql_portions1122);
                                            if ($num_portions1122) {
                                                $portnstock122 = "Y";
                                               
                                            }
                      
				$sts='';
				if($portnstock122=="N") $sts="####";
				if(!in_array_r($sts.$result_login['mr_menuname'], $data))
				{
					  $data[] = array(
							'label'  => $sts.$result_login['mr_menuname'].' '.$result_login['lm_menu_name'],
							'label2' => $result_login['mr_menuname'],
							'value'  => $result_login['mr_menuid'],
							 'id'    => $result_login['mr_menuid']
					   );
				}
			}
	  }
	  
	
		echo json_encode($data);
	        flush();
 
    
  }

else if(isset($_REQUEST['value']) && $_REQUEST['value']=='searchnameonly5')
  {
	 
 
 		/* **************************************Search menu name****************************************************  */
  
 	$data = array();
	$name=($_REQUEST['term']);
	$date=date("Y-m-d");
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menurate_counter ON  tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid left join tbl_menusubcategory as sb on sb.msy_subcategoryid=tbl_menumaster.mr_subcatid WHERE (tbl_menumaster.mr_menuname	 LIKE '".$name."%'  or tbl_menumaster.mr_itemcode like '".$name."%')  and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' and tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid and mc.mmy_active='Y' and ( (sb.msy_active='Y' && tbl_menumaster.mr_subcatid!='') ||  (tbl_menumaster.mr_subcatid is null) ) group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
  
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      
                       $portnstock1 = "N";
                                           $sql_menuportion11 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                            $sql_portions11 = $database->mysqlQuery($sql_menuportion11);
                                            $num_portions11 = $database->mysqlNumRows($sql_portions11);
                                            if ($num_portions11) {
                                                $portnstock1 = "Y";
                                                
                                            }
                                            
				$sts='';
				if($portnstock1=="N") $sts="####";//"<span style='color:#F00'>*****</span>";
				$data[] = array(
					  'label' => $sts.$result_login['mr_menuname'],
					  'label2' => $result_login['mr_menuname'],
					  'value' => $result_login['mr_menuid'],
					   'id' => $result_login['mr_menuid']
			     );
			}
	  }
	  
	  $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menurate_counter ON  tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid left join tbl_menusubcategory as sb on sb.msy_subcategoryid=tbl_menumaster.mr_subcatid  WHERE (tbl_menumaster.mr_menuname LIKE '%".$name."%'  AND  tbl_menumaster.mr_menuname NOT LIKE '%".$name."'  or tbl_menumaster.mr_itemcode like '%".$name."%' and  tbl_menumaster.mr_itemcode not like '%".$name."' )  and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' and tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid and mc.mmy_active='Y' and ( (sb.msy_active='Y' && tbl_menumaster.mr_subcatid!='') ||  (tbl_menumaster.mr_subcatid is null) )  group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                                           $portnstock12 = "N";
                                           $sql_menuportion112 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                           $sql_portions112 = $database->mysqlQuery($sql_menuportion112);
                                           $num_portions112 = $database->mysqlNumRows($sql_portions112);
                                           if ($num_portions112) {
                                                $portnstock12 = "Y";
                                                
                                           } 
                      
                      
				$sts='';
				if($portnstock12=="N") $sts="####";
				if(!in_array_r($sts.$result_login['mr_menuname'], $data))
				{
					  $data[] = array(
							'label' => $sts.$result_login['mr_menuname'],
							'label2' => $result_login['mr_menuname'],
							'value' => $result_login['mr_menuid'],
							 'id' => $result_login['mr_menuid']
					   );
				}
			}
	  }
	  
	  $sql_login  =  $database->mysqlQuery("select * LEFT JOIN tbl_menurate_counter ON  tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid from tbl_menumaster  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid left join tbl_menusubcategory as sb on sb.msy_subcategoryid=tbl_menumaster.mr_subcatid  WHERE (tbl_menumaster.mr_menuname LIKE '%".$name."'  or tbl_menumaster.mr_itemcode like '%".$name."' )  and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' and tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid and mc.mmy_active='Y' and ( (sb.msy_active='Y' && tbl_menumaster.mr_subcatid!='') ||  (tbl_menumaster.mr_subcatid is null) )  group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                       $portnstock122 = "N";
                                           $sql_menuportion1122 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                            $sql_portions1122 = $database->mysqlQuery($sql_menuportion1122);
                                            $num_portions1122 = $database->mysqlNumRows($sql_portions1122);
                                            if ($num_portions1122) {
                                                $portnstock122 = "Y";
                                                
                                            }
                      
				$sts='';
				if($portnstock122=="N") $sts="####";//"<span style='color:#F00'>*****</span>";
				if(!in_array_r($sts.$result_login['mr_menuname'], $data))
				{
					  $data[] = array(
							'label'  => $sts.$result_login['mr_menuname'],
							'label2' => $result_login['mr_menuname'],
							'value'  => $result_login['mr_menuid'],
							 'id'    => $result_login['mr_menuid']
					   );
				}
			}
	  }
	  
	
		echo json_encode($data);
	flush();
 
    
  }
  
  else if(isset($_REQUEST['value']) && $_REQUEST['value']=='searchnameonly_barcode')
  {
	 
 
 		/* **************************************Search menu name****************************************************  */
  
 	$data = array();
	$name=($_REQUEST['term']);
	$date=date("Y-m-d");
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menurate_counter ON  tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid WHERE (tbl_menurate_counter.mrc_barcode	 = '".$name."'  )  and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' and tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid and mc.mmy_active='Y' group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                      
                       $portnstock1 = "N";
                                           $sql_menuportion11 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                            $sql_portions11 = $database->mysqlQuery($sql_menuportion11);
                                            $num_portions11 = $database->mysqlNumRows($sql_portions11);
                                            if ($num_portions11) {
                                                $portnstock1 = "Y";
                                               
                                            }
                                            
				$sts='';
				if($portnstock1=="N") $sts="####";
				$data[] = array(
					  'label' => $sts.$result_login['mr_menuname'],
					  'label2' => $result_login['mr_menuname'],
					  'value' => $result_login['mr_menuid'],
					   'id' => $result_login['mr_menuid']
			     );
			}
	  }
	  
	  $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menurate_counter ON  tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid WHERE (tbl_menurate_counter.mrc_barcode	 = '".$name."' )  and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' and tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid and mc.mmy_active='Y' group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                       $portnstock12 = "N";
                                           $sql_menuportion112 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                            $sql_portions112 = $database->mysqlQuery($sql_menuportion112);
                                            $num_portions112 = $database->mysqlNumRows($sql_portions112);
                                            if ($num_portions112) {
                                                $portnstock12 = "Y";
                                               
                                            } 
                      
                      
				$sts='';
				if($portnstock12=="N") $sts="####";//"<span style='color:#F00'>*****</span>";
				if(!in_array_r($sts.$result_login['mr_menuname'], $data))
				{
					  $data[] = array(
							'label' => $sts.$result_login['mr_menuname'],
							'label2' => $result_login['mr_menuname'],
							'value' => $result_login['mr_menuid'],
							 'id' => $result_login['mr_menuid']
					   );
				}
			}
	  }
	  
	  $sql_login  =  $database->mysqlQuery("select * LEFT JOIN tbl_menurate_counter ON  tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid from tbl_menumaster  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid WHERE (tbl_menurate_counter.mrc_barcode	 = '".$name."'  )  and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y' and tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid and mc.mmy_active='Y' group by tbl_menumaster.mr_menuid ORDER BY mr_menuname"); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
                      
                       $portnstock122 = "N";
                                           $sql_menuportion1122 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='".$result_login['mr_menuid']."' AND mk_stock = 'Y'";
                                            $sql_portions1122 = $database->mysqlQuery($sql_menuportion1122);
                                            $num_portions1122 = $database->mysqlNumRows($sql_portions1122);
                                            if ($num_portions1122) {
                                                $portnstock122 = "Y";
                                               
                                            }
                      
				$sts='';
				if($portnstock122=="N") $sts="####";//"<span style='color:#F00'>*****</span>";
				if(!in_array_r($sts.$result_login['mr_menuname'], $data))
				{
					  $data[] = array(
							'label'  => $sts.$result_login['mr_menuname'],
							'label2' => $result_login['mr_menuname'],
							'value'  => $result_login['mr_menuid'],
							 'id'    => $result_login['mr_menuid']
					   );
				}
			}
	  }
	  
	
		echo json_encode($data);
	flush();
 
    
  }
  
  
  
  else if(isset($_REQUEST['value']) && $_REQUEST['value']=='searchcode')
  {
	 
 
 		/* **************************************Search menu code****************************************************  */
  
 	$data = array();
	$name=($_REQUEST['term']);
	$date=date("Y-m-d");
	 $sql_login  =  $database->mysqlQuery("select * from tbl_menumaster LEFT JOIN tbl_menurate_counter ON  tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid  LEFT JOIN tbl_menustock ON tbl_menustock.mk_menuid=tbl_menumaster.mr_menuid LEFT JOIN tbl_menumaincategory as mc ON tbl_menumaster.mr_maincatid=mc.mmy_maincategoryid WHERE (tbl_menumaster.mr_itemcode like '%".$name."%'  )   and tbl_menustock.mk_date='".$_SESSION['date']."'  and tbl_menumaster.mr_active='Y'and tbl_menumaster.mr_menuid=tbl_menurate_counter.mrc_menuid and mc.mmy_active='Y' group by mr_itemcode ORDER BY mr_menuname"); 
                                         
         $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{
				$sts='';
				if($result_login['mk_stock']=="N") $sts="####";
				$data[] = array(
					  'label' => $sts.$result_login['mr_menuname'],
					  'label2' => $result_login['mr_menuname'],
					  'value' => $result_login['mr_menuid'],
					   'id' => $result_login['mr_menuid']
			     );
			}
	  }
	  echo json_encode($data);
	flush();
}
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='loadpaymentdetails')
  {
  $billno=$_REQUEST['billid'];
  ?>
  <table width="100%" border="0">
  <tbody>
  <?php  
  $total=0;
  $netamt=0;
  $slno = 0;
    $p=0;
    $allqty=0;
    $print_by='';
    $sql_net_amount="select tab_loginid,tab_netamt,tab_bill_printed_by from tbl_takeaway_billmaster where tab_dayclosedate ='".$_SESSION['date']."' and  tab_billno='".$billno."' ";
    $sql_net_amount = $database->mysqlQuery($sql_net_amount);
    $num_net_amount  = $database->mysqlNumRows($sql_net_amount);
    if($num_net_amount){
       $result_net_amount  = $database->mysqlFetchArray($sql_net_amount);
       $netamt=$result_net_amount['tab_netamt'];
       $print_by=$result_net_amount['tab_loginid'];
    }   
    
    $sql_combo=" select  cbd.cbd_id, cbd.cbd_count_combo_ordering, cbd.cbd_billno, cbd.cbd_combo_id, cbd.cbd_combo_pack_id, cbd.cbd_slno, cbd.cbd_combo_qty, cbd.cbd_combo_pack_rate, cbd.cbd_combo_total_rate, cbd.cbd_menu_id, cbd.cbd_menu_qty, cbd.cbd_combo_preference, cbd.cbd_entry_date, cbd.cbd_dayclosedate, cbd.cbd_order_status, cbd.cloud_sync, 
                cbd.cbd_kot_no, cbd.cbd_cancel, cn.cn_name ,cn.cn_stock_check, cp.cp_pack_name
                FROM tbl_combo_bill_details_ta cbd
                left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                where cbd.cbd_billno='".$billno."' group by cbd.cbd_count_combo_ordering order by cbd.cbd_count_combo_ordering asc";
    $sql_combo_sel = $database->mysqlQuery($sql_combo);
    $num_combo_rows  = $database->mysqlNumRows($sql_combo_sel);
    if($num_combo_rows){
        while($result_combo  = $database->mysqlFetchArray($sql_combo_sel)) 
	{$p++;
        $allqty=$allqty+$result_combo['cbd_combo_qty'];
        
        ?>
            <tr>
                <td><?=strtoupper($result_combo['cn_name'].' '.$result_combo['cp_pack_name'])?></td>
                
                <td width="35%">
                    <span class="kot_cancel_value_btn" onclick="minus_kot('<?=$result_combo['cbd_count_combo_ordering']?>','combo')" >-</span> 
                        <input type="text"  value="<?=$result_combo['cbd_combo_qty']?>" style="width:40px;height:35px;margin-top: 3px;text-align: center"  class="payment_pending_pop_quantity_txt_box cnclqty combo_menu" id="txt_combo_<?=$result_combo['cbd_count_combo_ordering']?>" stock_check="<?=$result_combo['cn_stock_check']?>" readonly>   
                    <span style="float:right " class="kot_cancel_value_btn" onclick="plus_kot(<?=$result_combo['cbd_count_combo_ordering'].','.$result_combo['cbd_combo_qty']?>,'combo')">+</span>  
                </td>
                <td width="20%" id="amnt_<?=$result_combo['cbd_count_combo_ordering']?>"><?=number_format($result_combo['cbd_combo_total_rate'],$_SESSION['be_decimal'])?></td>
            </tr> 
        <?php          
        }
    }
  
  
				 $sql_listall  =  $database->mysqlQuery("Select tbd.tab_bill_addon_slno,tbm.tab_netamt,tbd.tab_qty,tbd.tab_preferencetext,tbd.tab_slno,mm.mr_menuid,mm.mr_menuname,tbd.tab_rate_type, tbd.tab_unit_type,tbd.tab_unit_weight,
                                                                        pm.pm_portionshortcode,  um.u_name, bum.bu_name , tbd.tab_status,tbd.tab_amount,tbd.tab_rate 
                                                                        From  tbl_takeaway_billdetails tbd 
                                                                        left Join tbl_takeaway_billmaster tbm ON tbd.tab_billno=tbm.tab_billno
                                                                        left Join tbl_menumaster mm On tbd.tab_menuid = mm.mr_menuid 
                                                                        left Join tbl_portionmaster pm On pm.pm_id =tbd.tab_portion 
                                                                        left join tbl_unit_master um  on um.u_id= tbd.tab_unit_id
                                                                        left join tbl_base_unit_master bum  on bum.bu_id =tbd.tab_base_unit_id
                                                                        Where tbm.tab_dayclosedate ='".$_SESSION['date']."' and tbd.tab_billno = '".$billno."' AND (tbm.tab_payment_settled = 'N') and tbd.tab_count_combo_ordering IS NULL and tbd.tab_status!='Cancelled' order by tab_slno ASC");
                                 
                                 $num_listall  = $database->mysqlNumRows($sql_listall);
					if($num_listall){
						  while($row_listall  = $database->mysqlFetchArray($sql_listall)) 
							  {
							$ordermenu_id=trim(json_encode($row_listall['mr_menuid']),'""');
                                                        $settle_menuidcs=$row_listall['mr_menuid'];
                                                        $settle_menucs=$row_listall['mr_menuname'];
                                  
                                                        
                                                         $qty=$row_listall['tab_qty'];
                                                          $sl=$row_listall['tab_slno'];
                                                        
                                                        
                                                        
                                                        if($_SESSION['main_language']!='english'){

                                                          $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$settle_menuidcs."' and ls_language='".$_SESSION['main_language']."'");

                                                                              //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                                          $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                          $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                          $settle_menucs=$result_arabmenu['lm_menu_name'];
                                                          // $catid['name'][] = $catname;
                                                          //echo $catname;
                                                          }
//                                            	
                                                      $total=$total + $row_listall['tab_amount'];
                                                      
                                                   
								  ?>
                      <tr ><!--payment_btn_cancel_act_list-->
                        <td><?php if($row_listall['tab_bill_addon_slno']!=''){ ?> <span style="color: red">(AD)</span> <?php } ?><?=$settle_menucs?><?php if($row_listall['tab_rate_type']=='Portion') { echo '('.$row_listall['pm_portionshortcode'].')';} else{ if($row_listall['tab_unit_type']=='Packet'){ echo '('. number_format($row_listall['tab_unit_weight'],$_SESSION['be_decimal']).' '.$row_listall['u_name'] .')';  } else if($row_listall['tab_unit_type']=='Loose'){ echo '('. number_format($row_listall['tab_unit_weight'],$_SESSION['be_decimal']).' '.$row_listall['bu_name'].')'; } }?></td>
                        
                        
                        <td width="35%">
                            <div class="kot_cancel_value_btn" onclick="minus_kot('<?=$sl?>','')" >-</div>
                            <input type="text"  value="<?=$row_listall['tab_qty']?>" style="width:40px;height:35px;margin-top: 3px;text-align: center" class="payment_pending_pop_quantity_txt_box cnclqty" id="txt_<?=$sl?>" readonly>   
                           <div  style="float:right" class="kot_cancel_value_btn" onclick="plus_kot(<?=$sl.','.$qty?>,'')" >+</div>
                        </td>
                        
                        <td width="20%"> <?=(number_format($row_listall['tab_amount'],$_SESSION['be_decimal'])) ?></td>   
                      
                      </tr>
                      <?php 
                      
                       $slall.=$sl.",";
                         $allqty = $allqty + $qty;
                      
                                                        } }
					  
					  echo '<script type="text/javascript">';
		echo '$(document).ready(function(){';
                
               
		echo '$("#totalamoutpaymnt").text('.$netamt.'.toFixed('.$_SESSION["be_decimal"].'))';
		//echo '$("#grandtotal").text('.$total.')';
		echo '});';
		echo '</script>';
					   ?>
                  <input type="hidden" id="hiddenslno" value="<?=$slall?>" > 
                    <input type="hidden" id="totqty" value="<?=$allqty?>"/>   
                     <input type="hidden" id="hid_billno" value="<?=$billno?>" > 
    </tbody>
    <script>
                      
    $('#printed_by_cs').text('<?=$print_by?>');
    </script>
   </table>
            
            
  <?php
  
  }else if(isset($_REQUEST['value']) && $_REQUEST['value']=="counter_settlebill") 
  {
      
      $tip_amount=0;
      $tip_mode=0;
      $guest_number='';
      $guest_name='';
      $billno='';
      
	if(isset($_REQUEST['billno']))
	{
		$billno		=$_REQUEST['billno'];
	}else
	{
	        $billno		=$_SESSION['billno'];
	}
        
	$mode			=$_REQUEST['mode'];
	$creditype		=NULL;
	$typenam		=$_REQUEST['typenam'];
	$credit			='N';
	$amountpaid=0;
	$bal=0;
	$creditdeatils		=NULL;
	$paidamount_credit	=0;
	$amount_credit		=0;
        $credit_remark_cs	=NULL;
	
	$transactionamount	=0;
	$card_bank		=0;
	$complmtry		='N';
	$remark			=NULL;
	$voucherid		=NULL;
	$couponcompany		=NULL;
	$couponamt		=0;
	$chequeno		=NULL;
	$chequebankname		=NULL;
	$chequeamount		=0;
	$staff=NULL;
	$secretkey=NULL;
	$stafflist=NULL;
        $upi_amount=0;
        $upi_txn_id=0;
        
	if($_REQUEST['type']=="credit_person")
	{      
                $credit_remark_cs       =$_REQUEST['credit_remark_cs'];
		$creditype		=$_REQUEST['creditype'];
		$creditdeatils		=$_REQUEST['creditdeatils'];
		$paidamount_credit	=$_REQUEST['paidamount_credit'];
		$amountpaid             =$_REQUEST['paidamount_credit'];
		$amount_credit		=$_REQUEST['amount_credit'];
		$credit			='Y';
		$bal          		=$_REQUEST['bal'];
                
                $guest_number           =$_REQUEST['guestnumber'];
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
                
                $loy_upd = $database->mysqlQuery(" UPDATE tbl_loyalty_reg SET ly_loy_login='".$_SESSION['login_staff_id_expodine']."',"
                . " ly_loy_dayclose='".$_SESSION['date']."' where ly_id=LAST_INSERT_ID() ");
                
                }
                else if($creditype=='1'){
                   $room  =$_REQUEST['room'];   
                }
             
	}else if($_REQUEST['type']=="complimentary")
	{
		$remark=$_REQUEST['comp'];
		$complmtry='Y';
		
	}
        else if($_REQUEST['type']=="comp_management")
	{
		$remark=$_REQUEST['comp'];
		
		$staff=$_REQUEST['staff'];
		
		if(isset($_REQUEST['secretkey']))
		{
		
		      $secretkey=$_REQUEST['secretkey'];
		      $stafflist=$_REQUEST['stafflist'];
		}
		else
		{
			$secretkey=NULL;
			$stafflist=NULL;
		}
		
		
	}else if($_REQUEST['type']=="cash")
	{
		$amountpaid=$_REQUEST['paid'];
		$bal   =$_REQUEST['bal'];
		
	}else if($_REQUEST['type']=="credit")
	{
		$transactionamount =$_REQUEST['trans'];
		$card_bank =$_REQUEST['bank'];
                
		$amountpaid=$_REQUEST['paid'];
		$bal   =$_REQUEST['bal'];
							 
	}else if($_REQUEST['type']=="coupon")
	{
		$couponcompany=$_REQUEST['coup'];
		$couponamt=$_REQUEST['coupamnt'];
                
		$amountpaid=$_REQUEST['paid'];
		$bal  =$_REQUEST['bal'];
		
		
	}
	
        $tip_amount=$_REQUEST['tip_amount'];
        $tip_mode=$_REQUEST['tip_mode'];
        $returnmsg=''; 
        
    if($couponamt >0){
        
       $date= date('Y-m-d H:i:s');
       $queryupdate=$database->mysqlQuery("update tbl_loyalty_group_details set tgp_code_active='N',"
               . " tgp_billno='".$billno."',tgp_coupon_amount='".$couponamt."',tgp_bill_date_time='".$date."',"
               . " tgp_bill_amount='".$_REQUEST['bill_final_amount_new']."' where tgp_groupcode='".$_REQUEST['coupon_code']."' ");     
    }
        
        
       
       if($_REQUEST['auth_staff']!='' && $_REQUEST['auth_staff']!='undefined' ){
           
       $date_py= date('Y-m-d H:i:s');
       $insertion['tp_datetime'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($date_py));
       $insertion['tp_login'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_SESSION['expodine_id']));
       $insertion['tp_auth_staff'] 		=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['auth_staff']));
       
       
          $insertion['tp_pay_type'] 	=  mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['type']));
        
        
        $insertion['tp_billno'] 	=  mysqli_real_escape_string($database->DatabaseLink,trim($billno));
        
        $sql=$database->check_duplicate_entry('tbl_payment_auth_log',$insertion);
        if($sql!=1)
	{
	$insertid  =  $database->insert('tbl_payment_auth_log',$insertion);
        }
        
       $login_auth='';  
       $sql_login  =  $database->mysqlQuery("SELECT ser_firstname from tbl_staffmaster where ser_staffid='".$_REQUEST['auth_staff']."' "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
	while($result_login  = $database->mysqlFetchArray($sql_login)) 
        {
          
            $login_auth=$result_login['ser_firstname'];
           
        }
        }
        
        $query323=$database->mysqlQuery("update  tbl_takeaway_billmaster set tab_settlement_login='$login_auth' WHERE tab_billno='$billno' ");    
        
        
    }
        
        
        
        
 try {

		
		$database->mysqlQuery("SET @billno			= " . "'" . $billno . "'");
		$database->mysqlQuery("SET @branchid			= " . "'" . $_SESSION['branchofid'] . "'");
		$database->mysqlQuery("SET @paymodeid			= " .$typenam );
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
		$database->mysqlQuery("SET @balanceamt		= " . "'" .$bal . "'");
		
		$database->mysqlQuery("SET @complementary_staff		= " . "'" . $staff . "'");
		$database->mysqlQuery("SET @mode		= " . "'" . $mode . "'");
                $database->mysqlQuery("SET @payment_login		= " . "'" . $_SESSION['expodine_id'] . "'");
                $database->mysqlQuery("SET @credit_remark_cs		= " . "'" . $credit_remark_cs . "'");
                $database->mysqlQuery("SET @order_confirming_staff = " . "'".$_SESSION['login_dayopen_staffid']."'");
		
		
   //  echo $billno.$_SESSION['branchofid'].$typenam.$amountpaid.$upi_amount.$upi_txn_id.$transactionamount.$card_bank.$complmtry.$remark.$voucherid
  // .$couponcompany.$couponamt.$chequeno.$chequebankname.$chequeamount.$credit.$creditdeatils.$amount_credit.$bal.$staff.$mode.$_SESSION['expodine_id'].$credit_remark_cs;
		 
		$message='';
		$kotno='';
		$sq=$database->mysqlQuery("CALL proc_gencounter_billsettle_kot(@billno,@branchid,@paymodeid,@amountpaid,@upi_amount,@upi_txn_id,@transactionamount,@card_bank,@complementary,@remark,@voucherid,@couponcompany,@couponamt,@chequeno,@chequebankname ,@chequeamount,@credit,@creditmasterid,@creditamount,@balanceamt,@complementary_staff,@mode,@payment_login,@credit_remark_cs,@kotno,@order_confirming_staff,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
	
  
	        $s='';
		$rs = $database->mysqlQuery( 'SELECT @message AS message,@kotno AS kotno' );
		while($row = mysqli_fetch_array($rs))
		{
                    
		  $s= $row['message'];
		  echo $_SESSION['printkotno']=$row['kotno'];
                  
		}
                
		$returnmsg=$s;
                
		$_SESSION['printkotbillno']=$_SESSION['billno'];
		
		echo $returnmsg;
                  
        
         ///inv start///   
                 
        if($_SESSION['s_inventory_staff_add']=='Y'  && $_SESSION['be_inv_sales_stock_reduce']=='Y'){
            
        $sql_login_invstore  =  $database->mysqlQuery("update tbl_takeaway_billdetails set tab_staff_store='".$_SESSION['ser_store_inv']."'   where tab_dayclose_in='".$_SESSION['date']."' and tab_billno='$billno' ");    
            
        $weight='';
        $sql_login_inv  =  $database->mysqlQuery("select * from tbl_takeaway_billdetails  where tab_dayclose_in='".$_SESSION['date']."' and tab_billno='$billno' limit 100 "); 
	$num_login_inv   = $database->mysqlNumRows($sql_login_inv);
	if($num_login_inv){ 
	while($result_inv = $database->mysqlFetchArray($sql_login_inv)) 
        { 
          
          
       ////product wise//
       $sql_listall  =  $database->mysqlQuery("select tp_product from tbl_production where tp_product='".$result_inv['tab_menuid']."' and tp_store='".$_SESSION['ser_store_inv']."' "); 
       $num_listall  = $database->mysqlNumRows($sql_listall);
       if($num_listall){
            
        if($result_inv['tab_rate_type']=='Portion' || $result_inv['tab_base_unit_id']=='3' || $result_inv['tab_unit_id']=='5'){
                
             $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['tab_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
      
        }else{
                  
                  
        if($result_inv['tab_unit_type']=='Packet' && ($result_inv['tab_unit_id']=='3' || $result_inv['tab_unit_id']=='2')){      
                  
          $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['tab_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['tab_unit_weight']."' and  ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
        }else{
                 
        $weight=($result_inv['tab_qty']*$result_inv['tab_unit_weight']);     
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
        }
        
        
       }
          
          
       }else{
           
        ///recipe wise///
           
        if($result_inv['tab_portion']!=''){
            $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['tab_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."' and tmi_portion='".$result_inv['tab_portion']."' and tmi_cs='Y' "); 
         }else{
            $sql_login_f =  $database->mysqlQuery("select * from tbl_menu_ingredient_detail where tmi_menuid='".$result_inv['tab_menuid']."' and tmi_store='".$_SESSION['ser_store_inv']."'  and tmi_cs='Y' ");     
        }
           
        $num_login_f   = $database->mysqlNumRows($sql_login_f);
	if($num_login_f){ 
	while($result_login_f  = $database->mysqlFetchArray($sql_login_f)) 
        { 
        
            
            $qty_inv=$result_inv['tab_qty']*($result_login_f['tmi_ing_qty']/$result_login_f['tmi_yield']);
            
            $wgt_inv=$result_inv['tab_qty']*($result_login_f['tmi_weight']/$result_login_f['tmi_yield']);
             
            
       if($result_login_f['tmi_ing_unit']=='Single' || $result_login_f['tmi_ing_unit']=='Nos' ){
            
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$qty_inv."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
       
        }else{
                 
        if($result_login_f['tmi_rate_type']=='Packet' && ($result_login_f['tmi_ing_unit']=='KG' || $result_login_f['tmi_ing_unit']=='LTR')){ 
                 
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$qty_inv."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where   ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
       
        }else{
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$wgt_inv."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_login_f['tmi_ing_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");           
        
        }
        
       }
            
            
           
        }}else{
           
            ///normalwise///
           
        if($result_inv['tab_rate_type']=='Portion' || $result_inv['tab_base_unit_id']=='3' || $result_inv['tab_unit_id']=='5'){
                
    
             $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['tab_qty']."') , ts_total=(ts_unit_price*ts_qty),ts_average= (ts_total/ts_qty)  where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."'  ");
      
        }else{
                  
              
        if($result_inv['tab_unit_type']=='Packet' && ($result_inv['tab_unit_id']=='3' || $result_inv['tab_unit_id']=='2')){      
                 
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_qty=(ts_qty-'".$result_inv['tab_qty']."'),ts_total=(ts_unit_price*ts_qty) ,ts_average= (ts_total/ts_qty) where ts_weight='".$result_inv['tab_unit_weight']."' and  ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
        }else{
                 
        $weight=($result_inv['tab_qty']*$result_inv['tab_unit_weight']);     
                  
        $fnct_menu2 = $database->mysqlQuery("update tbl_store_stock set ts_weight=(ts_weight-'".$weight."'),ts_total=(ts_unit_price*ts_weight) ,ts_average= (ts_total/ts_weight) where ts_product='".$result_inv['tab_menuid']."' and ts_store='".$_SESSION['ser_store_inv']."' ");           
       
        
        } } }
        
        
        
       }
          
       
       
         ////foodcost entry///
       
        $food_cost_menu=0;
        $sql_login_cost  =  $database->mysqlQuery("select sum(tfc_total) as cost from tbl_food_cost where"
        . " tfc_menu='".$result_inv['tab_menuid']."' and tfc_cs='Y' group by tfc_menu,date(tfc_date) order by tfc_date asc  "); 
	$num_login_cost    = $database->mysqlNumRows($sql_login_cost );
	if($num_login_cost ){ 
	while($result_login_cost   = $database->mysqlFetchArray($sql_login_cost)) 
        { 
            
          $food_cost_menu=($result_inv['tab_qty']*$result_login_cost['cost']);
          
        }}
       
        
        
          $sql_login_inv_cost  =  $database->mysqlQuery("update tbl_takeaway_billdetails set tab_cost='$food_cost_menu' where"
          . " tab_dayclose_in='".$_SESSION['date']."' and tab_billno='$billno' and tab_menuid='".$result_inv['tab_menuid']."' "); 
       
         ////foodcost end///
        
       }}
        
       }  
       
       
        ///inv end///        
                   
        $sql_login_fire  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Complimentary Settle' "); 
	$num_login_fire   = $database->mysqlNumRows($sql_login_fire);
	if($num_login_fire){ 
	while($result_login_fire  = $database->mysqlFetchArray($sql_login_fire)) 
        { 
            $firebase_report_status_comp=$result_login_fire['tf_active'];
        }}
        
        
        $sql_login_fire2  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Credit Settle' "); 
	$num_login_fire2   = $database->mysqlNumRows($sql_login_fire2);
	if($num_login_fire2){ 
	while($result_login_fire2  = $database->mysqlFetchArray($sql_login_fire2)) 
        { 
            $firebase_report_status_credit=$result_login_fire2['tf_active'];
        }}
                  
        
          
  if($_REQUEST['num_sms_new']!='' && $_REQUEST['num_sms_new']!='undefined' && $_REQUEST['num_sms_new']!=undefined){
               
        $sql_login_fire22  =  $database->mysqlQuery("select ly_id from tbl_loyalty_reg where ly_mobileno='".$_REQUEST['num_sms_new']."' limit 1 "); 
	$num_login_fire22   = $database->mysqlNumRows($sql_login_fire22);
	if($num_login_fire22){ 
           while($result_login_fire22  = $database->mysqlFetchArray($sql_login_fire22)) 
           {   
               
        $date= date('Y-m-d H:i:s');   $mode="CS";  
        
        $insertion['lob_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($billno));
          
        $insertion['lob_point_add']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
      
        $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
       
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
        
        $insertion['lob_bill_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['bill_final_amount_new']));
      
        $insertion['lob_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
       
        $insertion['lob_loyalty_customer']= mysqli_real_escape_string($database->DatabaseLink,trim($result_login_fire22['ly_id']));
     
        $insertion['lob_mode']= mysqli_real_escape_string($database->DatabaseLink,trim($mode));
      
      $sql=$database->check_duplicate_entry('tbl_loyalty_pointadd_bill',$insertion);
      if($sql!=1)
	{
	   $insertid    =  $database->insert('tbl_loyalty_pointadd_bill',$insertion);
        } 
        
                  
                    
        } }else{
           
            
            
        $loy_qry14 = $database->mysqlQuery("INSERT INTO `tbl_loyalty_reg`(`ly_firstname`,`ly_mobileno`) VALUES ('".$_REQUEST['name_sms_new']."','".$_REQUEST['num_sms_new']."')");
             
        $sql_login_fire22  =  $database->mysqlQuery("select ly_id from tbl_loyalty_reg where ly_mobileno='".$_REQUEST['num_sms_new']."' limit 1 "); 
	$num_login_fire22   = $database->mysqlNumRows($sql_login_fire22);
	if($num_login_fire22){ 
           while($result_login_fire22  = $database->mysqlFetchArray($sql_login_fire22)) 
           { 
               
        $date= date('Y-m-d H:i:s');   $mode="CS";  
        
        $insertion['lob_billno']=  mysqli_real_escape_string($database->DatabaseLink,trim($billno));
          
        $insertion['lob_point_add']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
      
        $insertion['lob_point_redeem']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
       
        $insertion['lob_redeem_amount']= mysqli_real_escape_string($database->DatabaseLink,trim(0));
        
        $insertion['lob_bill_amount']= mysqli_real_escape_string($database->DatabaseLink,trim($_REQUEST['bill_final_amount_new']));
      
        $insertion['lob_date']= mysqli_real_escape_string($database->DatabaseLink,trim($date));
       
        $insertion['lob_loyalty_customer']= mysqli_real_escape_string($database->DatabaseLink,trim($result_login_fire22['ly_id']));
     
        $insertion['lob_mode']= mysqli_real_escape_string($database->DatabaseLink,trim($mode));
      
        $sql=$database->check_duplicate_entry('tbl_loyalty_pointadd_bill',$insertion);
        if($sql!=1)
	{
	  $insertid      =  $database->insert('tbl_loyalty_pointadd_bill',$insertion);
        } 
           
             
         }
        }
                 
      }
  }      
  
  
  if($_REQUEST['sms_bill_settle']=='Y'){
          
     $customer='';  $number='';    
     $loy_qry1 = $database->mysqlQuery("select lr.ly_firstname,lr.ly_mobileno from tbl_loyalty_pointadd_bill lb"
     . " left join tbl_loyalty_reg lr on lr.ly_id=lb.lob_loyalty_customer where lb.lob_billno='".$billno."'");
   
     $num_loy = $database->mysqlNumRows($loy_qry1);
     if($num_loy)
     {
         while($loyalty_listing = $database->mysqlFetchArray($loy_qry1))
         {
             $customer=$loyalty_listing['ly_firstname'];
             $number=$loyalty_listing['ly_mobileno'];
             
     }}
     
     
     
     ///encode///
    $secret_key = 'my_simple_secret_key';
    $secret_iv = 'my_simple_secret_iv';

    $conv1 = false;
    
    
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    $conv=$billno.','.$_SESSION['firebase_id'];
    
    $conv1 = base64_encode( openssl_encrypt( $conv, $encrypt_method, $key, 0, $iv ) );
    
     ////encode_end////
     
     $var2= "http://expodinereports.com/ebill/ebill.php?b_id=$conv1";
   
     //  $message= $customer."*".$_SESSION['s_branchname'];
     
     $message= $customer."*".$var2;
   
   $var1=$_SESSION['s_branchname'];
    
     if($number !=''){
          
     //$print=$database->dynamic_sms_api($number,$message);
      
        
     ///whatsapp bill///
     
         
         if($_SESSION['ebill_link']=='Y'){
             
     $data = file_get_contents("https://bhashsms.com/api/sendmsg.php?user=ExploreITBW&pass=123456&sender=BUZWAP&phone=$number"
     . "&text=bill_new2&priority=wa&"
     . "stype=normal&Params=$var1,$var2");
     
         }else{
             
     $data = file_get_contents("https://bhashsms.com/api/sendmsg.php?user=ExploreITBW&pass=123456&sender=BUZWAP&phone=$number"
     . "&text=bill_thankyou123&priority=wa&"
     . "stype=normal&Params=$var1"); 
         }
     
     
   
        if (strpos($data, 'S.') !== false){
           
          $msg5 = 'MESSAGE SENT';
        
        }else{
          
          $msg5 = 'ERROR';
          
        }
      
        
       
      }
      
       
     }
        
                  
  if($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on']=='Y' && (($credit=="Y" && $firebase_report_status_credit=='Y') || ($complmtry=="Y" && $firebase_report_status_comp=='Y'))){
         
    $staff_pay='';
    $sql_table_sel3  = $database->mysqlQuery("SELECT ser_firstname from tbl_staffmaster  WHERE  ser_staffid ='".$_REQUEST['auth_staff']."' "); 
    $num_table3  = $database->mysqlNumRows($sql_table_sel3);
    if($num_table3)
    {
	while($row = mysqli_fetch_array($sql_table_sel3))
	 {
		
           $staff_pay= $row['ser_firstname'];
	}
    }
         
      if($staff_pay!=''){
         $staff_pay1=$staff_pay;
       }else{
          $staff_pay1=' No Authorization ';
      }
           
           
         
        $date_nw_nw=date('Y-m-d H:i:s');
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {
            
          $amt_fire=$_REQUEST['bill_final_amount_new'];
            
          if($credit == "Y" ){
              
               $title1=$_SESSION['s_branchname']." :  CREDIT BILL ";
              
               $data_body=" CREDIT BILL \nBill No:  $billno  \nDate:$date_nw_nw \nCredit Amount :$amount_credit \nAuthorization Staff: $staff_pay1 \nBill Amount : $amt_fire  ";
              
          }else if($complmtry == "Y" ){   
              
               $title1=$_SESSION['s_branchname']." :  COMPLIMENTARY BILL ";
               $data_body=" COMPLIMENTARY BILL \nBill No:  $billno  \nDate:$date_nw_nw \nAuthorization Staff: $staff_pay1 \nBill Amount : $amt_fire  ";
          }
            
    ///pushing msg///
    $branch_id_fire=$_SESSION['firebase_id'];
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
                  
                  
    $queryupdate_cancel=$database->mysqlQuery("update tbl_takeaway_cancel_items set tc_cancel_kotno='".$_SESSION['printkotno']."' "
    . " where tc_billno='".$billno."' ");
                  
                  
                  $settlestatusnew=explode('&',$returnmsg);
                  
                  if(trim($settlestatusnew[1])=='PAYMENT SUCCESSFUL'){
                      
                    $tip = $database->mysqlQuery(" UPDATE `tbl_takeaway_billmaster` SET `tab_tips_given`='".$tip_amount."',`tab_tips_mode`='".$tip_mode."' WHERE tab_billno='".$billno."' "); 
                 
                    }
                  
                  if($_REQUEST['type']=="credit_person" && trim($settlestatusnew[1])=='PAYMENT SUCCESSFUL' && $creditype==1){
                      
                   $queryupdate=$database->mysqlQuery("update tbl_credit_details set cd_settled='Y',cd_dateofsettle=now() "
                   . "  where cd_billno='".$billno."' ");
               
                  
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => $_SESSION['be_expolitelink']."/expodineroomservice",
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
                  exit();
	          echo $returnmsg;
	  } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }
	
	

}else if(isset($_REQUEST['value']) && $_REQUEST['value']=="gencounter") 
{
    $csname=$_REQUEST['csname'];
    $csphone=$_REQUEST['csphone'];
    $csgst=$_REQUEST['csgst'];
    
      $discountof=0;
      if($_REQUEST['discount_of']!=""){
          $discountof=$_REQUEST['discount_of'];
     }
        
	 try {
            
	$database->mysqlQuery("SET @temp_billno	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['cs_order_id']) . "'");
	$database->mysqlQuery("SET @branchid	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$database->mysqlQuery("SET @discount	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['discount']) . "'");
	$database->mysqlQuery("SET @discount_of	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$discountof) . "'");
	$database->mysqlQuery("SET @discount_unit	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['discount_unit']) . "'");
        $database->mysqlQuery("SET @loginid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']) . "'"); 	
        //$database->mysqlQuery("SET @discountid	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['cs_order_id']) . "'");
	//$database->mysqlQuery("SET @discount 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['discount']) . "'");
	$new_billno='';
	$new_kotno='';
	$message='';
	$discountid="";
	if($_REQUEST['discountid']=='none')
	{
		$discountid=0;
	}
	else
	{
		$discountid=$_REQUEST['discountid'];
 
	}

        
        
	$sq=$database->mysqlQuery("CALL  proc_gencounter(@temp_billno,@branchid,@discount,@discount_of,@discount_unit,@discountid,@loginid,@new_billno,@new_kotno,@message)") or $database->throw_ex(mysqli_error($database->DatabaseLink));
	$rs = $database->mysqlQuery( 'SELECT @new_billno AS billnumber,@new_kotno AS kotno,@message as message' );
	$billnos="";$kotnos="";
	while($row = mysqli_fetch_array($rs))
	{ 
	$_SESSION['billno']= $row['billnumber'];
	$_SESSION['printkotno']= $row['kotno'];
	$_SESSION['printkotbillno']=$row['billnumber'];
	$msg= $row['message'];
	}
        $query323=$database->mysqlQuery("  update  tbl_takeaway_billmaster set tab_name='$csname',tab_phone='$csphone',tab_gst='$csgst' WHERE tab_billno='".$_SESSION['billno']."' ");    
	
	
	
	 } catch (Exception $e) {
		  $returnmsg= 'Caught exception: '.  $e;
		  $file = 'log.txt';
		  $content = date("l F d-m-Y h:i:s A")." ".$returnmsg.PHP_EOL;
		  file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
		  echo $returnmsg; exit();
	  }
	  
}else if(isset($_REQUEST['value']) && $_REQUEST['value']=='menusubmission'){ 
    
        /*********Add menu to cart********/
    
        $con=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
        
        $unit_weight=0;
        $addon=json_decode($_REQUEST['addon']);
        
        if($_REQUEST['unitweight']!=""){
             $unit_weight=$_REQUEST['unitweight'];
        }
        
        if($_REQUEST['baseunitweight']!=''){
            $unit_weight=$_REQUEST['baseunitweight'];
            
        }
        
	$unit_id='';
        $unit_id=$_REQUEST['unitid'];
        if($unit_id==''){
            $unit_id=0;
        }
        
        
        $base_unit_id='';
        $base_unit_id=$_REQUEST['baseunitid'];
        if($base_unit_id==''){
            $base_unit_id=0;
        }
        
        
        $portion=0;
        if($_REQUEST['portion']!=""){
            $portion=$_REQUEST['portion'];
        }
        
        
        $slno=0;
        if($_REQUEST['serialno']!=""){
          $slno= $_REQUEST['serialno'];
        }
        
        
//         echo $_SESSION['cs_order_id'].",";
//         echo $_REQUEST['menuid'].",";
//         echo $_REQUEST['ratetype'].",";
//         echo $portion.",";
//         echo $_REQUEST['unittype'].",";
//         echo $unit_weight.",";
//         echo $unit_id .",";
//         echo $base_unit_id .",";
//         echo $_REQUEST['qty'].",";
//         echo $_REQUEST['preferncetext'] .",";
//         echo $_REQUEST['rate'].",";
//         echo $_SESSION['branchofid'].",";
//         echo $_REQUEST['mode'].",";
//         echo $_REQUEST['order_from'].",";
//         echo $slno.",";
        
            $localIP = getHostByName(getHostName());

            if($_SESSION['cs_order_id']=='' || $_SESSION['cs_order_id']==NULL || $_SESSION['cs_order_id']=='undefined')
            {
                $orderid="TEMP*".$database->getEpoch();
               // $_SESSION['cs_order_id']=$orderid;
                
                $date1 = time();

	$date2 = mktime(0,0,0,12,31,1979);

	$dateDiff = $date1 - $date2;

        $localIP = getHostByName(getHostName()); 
        
        $ln=  strlen($localIP);
        
        
        $ips=  substr($localIP,($ln-3),3);
        
        
	 $_SESSION['cs_order_id']=  "TEMP*".substr($dateDiff,0,7).$ips;
         
            }
    
    
    
           $sql_chk="select tab_billno from tbl_takeaway_billmaster where tab_dayclosedate='".$_SESSION['date']."' "
           . " and tab_billno='".$_SESSION['cs_order_id']."' and tab_system_ip!='$localIP' ";
           $sql_menuaddon1  =  mysqli_query($con,$sql_chk); 
           $num_menuaddon  = mysqli_num_rows($sql_menuaddon1);
           if($num_menuaddon){
                
           $orderid="TEMP*".$database->getEpoch();
           // $_SESSION['cs_order_id']=$orderid;
               
        $date1 = time();

	$date2 = mktime(0,0,0,12,31,1979);

	$dateDiff = $date1 - $date2;

        $localIP = getHostByName(getHostName()); 
        
        $ln=  strlen($localIP);
        
        
        $ips=  substr($localIP,($ln-3),3);
        
        
	 $_SESSION['cs_order_id']=  "TEMP*".substr($dateDiff,0,7).$ips;
         
           }



           
           $rate_in=$_REQUEST['rate'];
           if($_REQUEST['manualrate_val']=='Y' && $_SESSION['incl_bill_format']=='Y'){
                     
                 $tax_vl=0;   
                 $sql_menuaddon4 = "select sum(amc_value) as tx from tbl_extra_tax_master "
                 . " WHERE  amc_active='Y' and amc_enable_cs='Y' and amc_item_tax='N' ";
             
            
                    $sql_menuaddon12  =  mysqli_query($con,$sql_menuaddon4); 
                    $num_menuaddon2  = mysqli_num_rows($sql_menuaddon12);
                    if($num_menuaddon2){
                        while($result_menus2  = mysqli_fetch_array($sql_menuaddon12)) 
			{
                            
                             $tax_vl=$result_menus2['tx'];    
                        }
                        }
                      
                    $tax_vl1=($tax_vl/100);
                    
                    $tax_vl2=($_REQUEST['rate']/(1+$tax_vl1));
        
                    $rate_in=$tax_vl2;
        
                 } 
           
           
        
	if($_REQUEST['preferncetext']=="")
	{
		$pref_text='';
		$database->mysqlQuery("SET @preferencetext 	= " . "" . mysqli_real_escape_string($database->DatabaseLink,$pref_text) . "");
	}else
	{
		$pref_text=$_REQUEST['preferncetext'];
		$database->mysqlQuery("SET @preferencetext 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$pref_text) . "'");
	}
	
	$database->mysqlQuery("SET @temp_billno                 = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['cs_order_id']) . "'");
	$database->mysqlQuery("SET @menuid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['menuid']) . "'");
	$database->mysqlQuery("SET @portion 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$portion) . "'");
	$database->mysqlQuery("SET @qty 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['qty']) . "'");
	//$database->mysqlQuery("SET @preferencetext              = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['preferncetext']) . "'");
	$database->mysqlQuery("SET @rate 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$rate_in) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$database->mysqlQuery("SET @mode 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['mode']) . "'");
	$database->mysqlQuery("SET @order_from 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['order_from']) . "'");
	$database->mysqlQuery("SET @rate_type 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['ratetype']) . "'");
        $database->mysqlQuery("SET @unit_type 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['unittype']) . "'");
        $database->mysqlQuery("SET @unit_id 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$unit_id) . "'");
        $database->mysqlQuery("SET @base_unit_id 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$base_unit_id) . "'");
        $database->mysqlQuery("SET @unit_weight 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$unit_weight) . "'");
	$database->mysqlQuery("SET @serailno                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$slno) . "'");
        $database->mysqlQuery("SET @dish_type                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,'') . "'");
        $database->mysqlQuery("SET @food                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,0) . "'");
        
        $sq=$database->mysqlQuery("CALL  proc_temptakeaway(@temp_billno,@menuid,@rate_type,@portion,@unit_type,@unit_weight,@unit_id,@base_unit_id,@qty,@preferencetext,@rate,@branchid,@mode,@order_from,@serailno,@dish_type,@food)");
	
        
        if($sq)
	{
	  echo 'ok';
	}
     
        
        
        //queries mandatory///
        
         
        $sql_update_subtotal1=mysqli_query($con," update tbl_takeaway_billmaster set tab_loginid='".$_SESSION['expodine_id']."', "
        . " tab_system_ip='$localIP' where tab_dayclosedate='".$_SESSION['date']."' and tab_billno='".$_SESSION['cs_order_id']."' ");
        
        $sql_delete_day=mysqli_query($con,"update tbl_takeaway_billdetails set tab_dayclose_in='".$_SESSION['date']."' "
        . " where tab_billno='".$_SESSION['cs_order_id']."' ");
       
        
        $sql_update_subtotal=mysqli_query($con," update tbl_takeaway_billmaster set tab_subtotal=tab_subtotal-(select sum(`tab_amount`) from "
        . " tbl_takeaway_billdetails where `tab_billno`='".$_SESSION['cs_order_id']."' and tab_status='Generated' and "
        . " tab_bill_addon_slno='".$slno."') where tab_dayclosedate='".$_SESSION['date']."' and `tab_billno`='".$_SESSION['cs_order_id']."'");
       
        $sql_delete_detl=mysqli_query($con,"Delete FROM tbl_takeaway_billmaster   where tab_dayclosedate='".$_SESSION['date']."' "
        . " and (tab_billno='' or tab_billno is NULL) ");
         
        $sql_delete_addon=mysqli_query($con,"Delete  FROM tbl_takeaway_billdetails   where tab_dayclose_in='".$_SESSION['date']."' "
        . " and  tab_billno='".$_SESSION['cs_order_id']."' and tab_status='Generated' and  tab_bill_addon_slno='".$slno."'");
       
        //quries end///
        
        
        if($_REQUEST['manualrate_val']=='Y'){
           
        $sql_update_dyn=mysqli_query($con,"update tbl_takeaway_billdetails set tab_dynamic_rate='Y' where tab_dayclose_in='".$_SESSION['date']."' and "
        . " tab_billno='".$_SESSION['cs_order_id']."' and  tab_menuid='".$_REQUEST['menuid']."' "); 
            
         }
        
       
        
        
         
        if($_SESSION['incl_bill_format']=='Y'){ 
             
        if($portion !=0){
                
              $sql_menuaddon="select mrc_menu_final_amount,mrc_rate FROM tbl_menurate_counter  where  "
              . " mrc_menuid='".$_REQUEST['menuid']."' and mrc_portion='$portion'  ";
              
        }else{
                
                if($unit_id!=0){
                    $sql_menuaddon="select mrc_menu_final_amount,mrc_rate FROM tbl_menurate_counter  "
                    . "where  mrc_menuid='".$_REQUEST['menuid']."' and  mrc_unit_id='$unit_id' and mrc_unit_weight='$unit_weight' ";
                }
                
                if($base_unit_id !=0){
                    
                    $sql_menuaddon="select mrc_menu_final_amount,mrc_rate FROM tbl_menurate_counter  where "
                    . " mrc_menuid='".$_REQUEST['menuid']."' and mrc_base_unit_id='$base_unit_id'  ";
                }
                
        }
           
            $new_rate=0;
            $sql_menuaddon1  =  mysqli_query($con,$sql_menuaddon); 
            $num_menuaddon  = mysqli_num_rows($sql_menuaddon1);
            if($num_menuaddon){
                while($result_format  = mysqli_fetch_array($sql_menuaddon1)) 
                {
                    if($result_format['mrc_menu_final_amount']>0 && $result_format['mrc_menu_final_amount'] !=''){
                        $new_rate=$result_format['mrc_menu_final_amount'];
                        
                    }else{
                         $new_rate=$result_format['mrc_rate'];
                     
                    }
                    
                     if($_REQUEST['manualrate_val']=='Y' && $_SESSION['incl_bill_format']=='Y'){
                     
                       $new_rate=$_REQUEST['rate'];
                    }
                    
                    
               if($portion !=0){
                
                  $sql_update_subtotal=mysqli_query($con," update tbl_takeaway_billdetails set tab_new_rate_incl='".$new_rate."' where "
                  . " `tab_billno`='".$_SESSION['cs_order_id']."' and tab_menuid='".$_REQUEST['menuid']."' and tab_portion='$portion'  ");     
          
           
               }else{
                
                if($unit_id!=0){
                
                  $sql_update_subtotal=mysqli_query($con," update tbl_takeaway_billdetails set tab_new_rate_incl='".$new_rate."' where "
                  . " `tab_billno`='".$_SESSION['cs_order_id']."' and tab_menuid='".$_REQUEST['menuid']."' and "
                  . " tab_unit_weight='$unit_weight' and tab_unit_id='$unit_id'  ");     
                }
                
                
                if($base_unit_id !=0){
                    
                   $sql_update_subtotal=mysqli_query($con," update tbl_takeaway_billdetails set tab_new_rate_incl='".($new_rate*$unit_weight)."'"
                   . " where `tab_billno`='".$_SESSION['cs_order_id']."' and tab_menuid='".$_REQUEST['menuid']."' and "
                   . " tab_unit_weight='$unit_weight' and tab_base_unit_id='$base_unit_id' ");     
                   
                }
                
                
              }
             
              } }
        
  }
        
     $pref_ids=json_decode($_REQUEST['pref_ids']);
     
  if(!empty($pref_ids)) {
     
      
      for($p1=0;$p1<count($pref_ids);$p1++){
          
           $pref_id=$pref_ids[$p1]->pref_id;
           
           $pref_qty=$pref_ids[$p1]->pref_qty;
           
           $pref_name=$pref_ids[$p1]->pref_name;
           
           $sql_chk="select tmp_menu from tbl_menu_preference_kot where tmp_orderno_bill='".$_SESSION['cs_order_id']."'"
                   . " and tmp_menu='".$_REQUEST['menuid']."' and  tmp_pref_id='$pref_id' ";
         
           $sql_menuaddon1  =  mysqli_query($con,$sql_chk); 
           $num_menuaddon  = mysqli_num_rows($sql_menuaddon1);
           if($num_menuaddon){
           
           $sql_qry111 = $database->mysqlQuery("update `tbl_menu_preference_kot`  set `tmp_qty`='$pref_qty' where"
                   . "  tmp_orderno_bill='".$_SESSION['cs_order_id']."' "
                   . " and tmp_menu='".$_REQUEST['menuid']."' and  tmp_pref_id='$pref_id'");
                  
             $sql_qry111 = $database->mysqlQuery("DELETE FROM tbl_menu_preference_kot WHERE (tmp_qty='' OR tmp_qty='0')  AND"
                     . "  tmp_orderno_bill='".$_SESSION['cs_order_id']."' "
                   . " and tmp_menu='".$_REQUEST['menuid']."' and  tmp_pref_id='$pref_id'");
           
           }else{
               
                $sql_qry111 = $database->mysqlQuery("INSERT INTO `tbl_menu_preference_kot`(`tmp_orderno_bill`, `tmp_qty`, `tmp_mode`,"
                   . "`tmp_menu`, `tmp_pref_id`, `tmp_pref_name`) "
                   . "VALUES ('".$_SESSION['cs_order_id']."','$pref_qty','CS','".$_REQUEST['menuid']."','$pref_id','$pref_name')");
                  
               
           }
          
      }
       
     
  }
  
  
         
  if(!empty($addon)) {
                    
            $sql_menuaddon="select tbd.tab_slno FROM tbl_takeaway_billdetails tbd where  tab_menuid='".$_REQUEST['menuid']."'and tab_billno='".$_SESSION['cs_order_id']."' and tab_status='Generated' AND tbd.tab_bill_addon_slno IS NULL ";
            $sql_menuaddon1  =  mysqli_query($con,$sql_menuaddon); 
            $num_menuaddon  = mysqli_num_rows($sql_menuaddon1);
            if($num_menuaddon){
                while($result_menuaddon  = mysqli_fetch_array($sql_menuaddon1)) 
                {
                    $add_slno=$result_menuaddon['tab_slno'];
                }
            }  
           
        for($p=0;$p<count($addon);$p++){
                
                $addon_menuid=$addon[$p]->menu_id;
                $addon_menu_slno=$addon[$p]->menu_slno;
                $addon_menurate=$addon[$p]->menu_rate;
                $addon_menuqty=$addon[$p]->menu_qty;
                
                $database->mysqlQuery("SET @menuid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$addon_menuid) . "'");
                $database->mysqlQuery("SET @portion 			= " .                                                                   1);
                $database->mysqlQuery("SET @qty 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$addon_menuqty) . "'");
                $database->mysqlQuery("SET @rate 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$addon_menurate) . "'");
                $database->mysqlQuery("SET @rate_type 			= " . "'Portion'");
                $database->mysqlQuery("SET @unit_type 			= " . NULL);
                $database->mysqlQuery("SET @unit_id 			= " . 0);
                $database->mysqlQuery("SET @base_unit_id 		= " . 0);
                $database->mysqlQuery("SET @unit_weight 		= " . 0);
                $database->mysqlQuery("SET @serailno                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$add_slno) . "'");
                $database->mysqlQuery("SET @food                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,0) . "'");
                
                $sq=$database->mysqlQuery("CALL  proc_temptakeaway(@temp_billno,@menuid,@rate_type,@portion,@unit_type,@unit_weight,@unit_id,@base_unit_id,@qty,@preferencetext,@rate,@branchid,@mode,@order_from,@serailno,@dish_type,@food)");

                
           
          
                
                
                
            }
        }
        
       
         
  }
  else if(isset($_REQUEST['value']) && $_REQUEST['value']=='listpaymentpending'){ ?>
            
     <script src="js/counter_sales.js"></script>
     <script>
     var len = $('script[src="js/counter_sales.js"]').length;
     if (len === 0) {
         $.getScript('js/counter_sales.js');
     }
    </script>
    
  <div style="padding-left: 69px;" class="top_head">
    <?php if(in_array("dinein", $_SESSION['menuarray'])) { ?>    <a  href="table_selection.php" style="margin-top:8px;background-color: white;color: black" class="pop-navigation">Dine in </a> <?php } ?> &nbsp;   <?php if(in_array("take_away_", $_SESSION['menuarray'])  && (in_array("payments_ta_cs", $_SESSION['menusubarray']))) { ?>       <a href="#" onclick="settlepopupcommonta()" style="background-color: white;margin-top:8px;color: black"  class="pop-navigation">Take Away</a>  <?php } ?>
      
    PENDING BILLS
    <span class="errorpaymentpop" style="color:red !important;background-color: white;border-radius: 5px; display:none"></span>
    <div style="margin-top:-4px;margin-right:5px;" class="counter_menu_popup_head_close closepaypop close_payment_hold_pop"><img src="img/cancel_bill.png"></div>
    </div>
	<div class="counter_sl_payment_hist_pop_contant">
            <div class="payment_hold_pop_left_cc" style="position: relative ">
        	<div class="payment_hold_pop_left_head">
            	 <table width="100%" border="0">
                    <thead>
                      <tr>
                        <th>Bill No</th>
                        <th width="25%"> Time</th>
                        <th width="25%">Amount</th>
                      </tr>
                    </thead>
                 </table>   
            </div>
            
            <div class="payment_hold_pop_left_contant_tbl">
            	<table width="100%" border="0">
                    <tbody>
                    <?php 
                    
                    $staff='';
                    if($_SESSION['ser_all_shift_closer']=='N'){
                    if($_SESSION['shift_permission']=='Y'){
                        
                        $sql_desg_nos13="select sd_open_staff from tbl_shift_details where sd_day='".$_SESSION['date']."' and sd_open_staff='".$_SESSION['login_dayopen_staffid']."' and sd_close IS NULL";
                        $sql_desg13  =  $database->mysqlQuery($sql_desg_nos13);
			$num_desg13  = $database->mysqlNumRows($sql_desg13);
			if($num_desg13){
			    $staff=" and tb.tab_loginid='".$_SESSION['expodine_id']."'  ";
                        }else{
                            $staff='';
                        }
                        
                    }
                    }
                        $ct=1;  $count=0; 
			$sql_table_sel_query= "Select distinct(tb.tab_billno),tb.tab_loy_id,tb.tab_subtotal_final,tb.tab_tips_given,tb.tab_time,tb.tab_hdcustomerid ,ts.tac_customername,"
                                . "ts.tac_contactno,tb.tab_status,tb.tab_kotno, tb.tab_mode,tb.tab_netamt,tb.tab_subtotal as subtot,"
                                . "tab_discountvalue  as disc,tb.tab_table_no,tb.tab_no_pax From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON "
                                . "ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' and "
                                . "tb.tab_payment_settled='N' And tb.tab_mode = 'CS' and tab_status!='Cancelled' and  "
                                . "tb.tab_billno NOT LIKE 'HOLD%' and tb.tab_billno NOT LIKE 'TEMP%' $staff order by tb.tab_time asc limit 250";
			$sql_table_sel = $database->mysqlQuery($sql_table_sel_query);
                        $num_table = $database->mysqlNumRows($sql_table_sel);
                        if ($num_table) {
                        while ($result_table_sel = $database->mysqlFetchArray($sql_table_sel)) {
			$tax_name='';     $count=$ct++;
                        $tax_value='';
                                        
                        if($_SESSION['uae_tax_enable']=='Y'){ 
                                  $subt=$result_table_sel['tab_subtotal_final'];  
                                }else{
				   $subt=$result_table_sel['subtot'];
                                }
                        
                        
                        $sql_taxdetails  =  $database->mysqlQuery("SELECT tbe_total_value,tbe_label   from tbl_takeaway_bill_extra_tax_master  WHERE tbe_billno='".$result_table_sel['tab_billno']."'"); 
                        $num_taxdetails  = $database->mysqlNumRows($sql_taxdetails);
                        if($num_taxdetails){$p=0;
                            while($row_taxdetails  = $database->mysqlFetchArray($sql_taxdetails)) {
                            $p++;
                            if($p==1){ $tax_name= $row_taxdetails['tbe_label'];
                                $tax_value=$row_taxdetails['tbe_total_value'];
                            }
                            else{ $tax_name.='<>'.$row_taxdetails['tbe_label'];
                                $tax_value.='<>'.$row_taxdetails['tbe_total_value'];
                            }
                        }
                        }
		?>
                      <tr <?php if($result_table_sel['tab_table_no']!='' || $result_table_sel['tab_no_pax']!=''){ ?>  title="<?=' Tbl/Rmk : '.$result_table_sel['tab_table_no'].' | Ref/Pax : '.$result_table_sel['tab_no_pax']?>" <?php } ?>    ondblclick="double_click_settle('<?=$result_table_sel["tab_billno"]?>')"  class="paymenteachnew bill_dbl_<?=$result_table_sel['tab_billno']?>" billno="<?= $result_table_sel['tab_billno'] ?>" tips="<?=$result_table_sel['tab_tips_given']?>" tax_name="<?=$tax_name?>" tax_value="<?= $tax_value ?>" kotno="<?=$result_table_sel['tab_kotno']?>" loy_id="<?= $result_table_sel['tab_loy_id'] ?>" amount="<?= $result_table_sel['tab_netamt'] ?>"   subt="<?=$subt?>"  disc="<?= $result_table_sel['disc'] ?>"><!--payment_hol_act-->
                          <td><i class="fa fa-info"></i> <?= $result_table_sel['tab_billno'] ?>  &nbsp; &nbsp; &nbsp; <span style="cursor:pointer;border: solid 1px;border-radius: 3px;padding: 3px;margin-left: 5px;display: none" onclick="regen_ta_cs('<?=$result_table_sel["tab_billno"]?>');"> Reg </span> </td>
                        <td width="25%"><?= date("h:i:s", strtotime($result_table_sel['tab_time'])) ?></td>
                        <td width="25%"><?= number_format($result_table_sel['tab_netamt'],$_SESSION['be_decimal'])?></td>
                      </tr>
                      
                 <?php   }   } ?>
                 
                 </tbody>
                 </table>  
                
          
            </div>
            
             <?php if($count>0){ ?>   
           <strong style="padding: 5px;padding-left: 40px;position: absolute;bottom: 0px;left: 0px;width: 100%;background-color: #a9a9a9;">BILLS : <?=$count?></strong> 
          <?php } ?>
           
        </div>
        
        <div class="payment_hold_pop_right_cc">
        	<div class="payment_hold_pop_left_head">
            	 <table width="100%" border="0">
                    <thead>
                      <tr>
                        <th>Item</th>
                        <th width="35%">Qty</th>
                        <th width="20%">Amount</th>
                      </tr>
                    </thead>
                 </table>   
            </div>
            
            <div style="height:355px;background-color: #D8D8D8;" class="payment_hold_pop_left_contant_tbl loadpaymetdetls"> <!--payment_btn_cancel_act_list-->
            	  
            </div>
           
            <div class="payment_pop_item_total"><span style="float:left">Printed By:<span id="printed_by_cs"></span></span> Total:<span id="totalamoutpaymnt"></span></div>
            <div class="payment_hold_pop_buton_cc">
            	
                <a href="#"><div style="background-color: darkred " class="payment_hold_btn paysubmitbut">SETTLE</div></a>
                <a href="#"><div style="width:95px" class="payment_hold_btn" id="kot_cancel_cs" style="display:none;margin-right: 50px">KOT CANCEL </div></a>
                
                <a  href="#"><div style="width:60px" class="payment_hold_btn" id="cs_reprint_new" style="display:none;margin-right: 22px">REPRINT</div>
                
                 <div style="width:80px" class="payment_hold_btn" id="reg_new_btn" style="display:block">RE-ORDER</div>
                
                </a>
            </div>
        </div>
        
        
    </div>
  <?php
  
  }else if(isset($_REQUEST['value']) && $_REQUEST['value']=='checkprinter'){
	  if($_SESSION['s_printst']=="Y") // printer ye or no
	  {
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	  
  }else if(isset($_REQUEST['value']) && $_REQUEST['value']=='addhold'){
	
	$database->mysqlQuery("SET @billno	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['cs_order_id']) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$hold_billno='';
	$hold_message='';
	$sq=$database->mysqlQuery("CALL  proc_hold_order(@billno,@branchid,@hold_billno,@hold_message)");
	if($sq)
	{
		echo "ok";
	}
	  
       
        $bills[]=array();
        
        $sql_qry111 = $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where tab_dayclosedate = '".$_SESSION['date']."' and tab_on_hold='Y' and tab_mode='CS' ");
        
            $num_rows111 = $database->mysqlNumRows($sql_qry111);
              if($num_rows111){
              while($result_row111 = $database->mysqlFetchArray($sql_qry111)){
                   $bills[]=$result_row111['tab_billno'];
	      
              }}
              
              for($m=1;$m<count($bills);$m++){
                  
                $sql_qry111 = $database->mysqlQuery("insert into tbl_hold_data(th_hold_id,th_date,th_mode)values('".$bills[$m]."','".$_SESSION['date']."','CS')");
                  
              }
              
              
               $sql_qry111 = $database->mysqlQuery("update tbl_loyalty_reg set ly_default='N' where ly_module='CS' ");  
        
  }
  else if(isset($_REQUEST['value']) && $_REQUEST['value']=='checkprinter'){
	  if($_SESSION['s_printst']=="Y") // printer ye or no
	  {
		  echo "ok";
	  }else
	  {
		  echo "sorry";
	  }
	  
  }
  else if(isset($_REQUEST['value']) && $_REQUEST['value']=='releasehold'){
	
	$database->mysqlQuery("SET @hold_no	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['bilno']) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$database->mysqlQuery("SET @temp_billno 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['cs_order_id']) . "'");
	$new_temp_bill_no='';
	$message='';
	$sq=$database->mysqlQuery("CALL  proc_hold_release(@hold_no,@branchid,@temp_billno,@new_temp_bill_no,@message)");
	
	
	$rs = $database->mysqlQuery( 'SELECT @new_temp_bill_no AS new_temp_bill_no,@message as message' );
	while($row = mysqli_fetch_array($rs))
	{
	$_SESSION['cs_order_id']= $row['new_temp_bill_no'];
	
	}
        //echo $_SESSION['cs_order_id'];
        
        
	$sql_qry111 = $database->mysqlQuery("delete from  tbl_hold_data where th_hold_id='".$_REQUEST['bilno']."' and th_mode='CS' ");  
        $bills[]=array();
        
        $sql_qry111 = $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where tab_dayclosedate = '".$_SESSION['date']."' and tab_on_hold='Y' and tab_mode='CS'  ");
        
            $num_rows111 = $database->mysqlNumRows($sql_qry111);
              if($num_rows111){
              while($result_row111 = $database->mysqlFetchArray($sql_qry111)){
                   $bills[]=$result_row111['tab_billno'];
	      
              }}
              
              for($m=1;$m<count($bills);$m++){
                  
                $sql_qry111 = $database->mysqlQuery("insert into tbl_hold_data(th_hold_id,th_date,th_mode)values('".$bills[$m]."','".$_SESSION['date']."','CS')");
                  
              }
        
  }
  else if(isset($_REQUEST['value']) && $_REQUEST['value']=='listallcountersale'){
	  
	   /* **************************************List all take aways/home in list****************************************************  */
	  $selval=$_REQUEST['selectval'];
	  ?>
  
  <script src="js/takeawaykot_each.js" ></script>
  <script src="js/counter_sale_print.js"></script>
  <?php
	  $curdate=date("Y-m-d");
			 //$sql_menulist= "distinct(tbl_takeaway_billmaster.tab_billno),tbl_takeaway_billmaster.tab_time,tbl_takeaway_billmaster.tab_customermobile,tbl_takeaway_billmaster.tab_customername,tbl_takeaway_billmaster.tab_hdcustomerid ,tbl_takeaway_billmaster.tab_status From tbl_takeaway_customer, tbl_takeaway_billmaster Inner Join tbl_takeaway_billdetails On tbl_takeaway_billmaster.tab_billno =tbl_takeaway_billdetails.tab_billno Where tbl_takeaway_billmaster.tab_date ='".$curdate."' And tbl_takeaway_billmaster.tab_kotno != ''  order by tab_time DESC  ";
			 // $sql_menulist= "Select distinct(tab_billno),tab_time,tab_customermobile,tab_customername,tab_hdcustomerid ,tab_status,tab_kotno,tab_mode From tbl_takeaway_billmaster  Where tab_dayclosedate ='".$_SESSION['date']."' And tab_kotno != '' And (tab_status='KOT_Generated' OR tab_status='Processing' OR tab_statu='Ready')   order by tab_status ASC ";
			 $sql_menulist= "Select tb.tab_billno,tb.tab_time,tb.tab_hdcustomerid ,ts.tac_customername,ts.tac_contactno,tb.tab_status,tb.tab_kotno, tb.tab_mode From tbl_takeaway_billmaster as tb LEFT JOIN tbl_takeaway_customer ts ON ts.tac_customerid=tb.tab_hdcustomerid Where tb.tab_dayclosedate ='".$_SESSION['date']."' And (tb.tab_status='KOT_Generated' OR tb.tab_status='Processing' OR tb.tab_status='Ready')  AND tb.tab_mode = 'CS' order by tb.tab_status ASC ";
				$sql_menus  =  $database->mysqlQuery($sql_menulist); 
				$num_menus  = $database->mysqlNumRows($sql_menus);
				if($num_menus){
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
						{//echo "fgfg".$selval."fgfg";
							?>
              <div class="take_kot_detail_cc">
            	<div class="take_away_list_cc  <?php if($selval==trim($result_menus['tab_billno'])){?>  take_active<?php } ?> <?php if(($result_menus['tab_mode'])=='HD'){ ?>home_dlvry <?php } if(($result_menus['tab_mode'])=="CS"){ ?> countersales <?php } ?> takeawaykoteachclick   " bilno="<?=$result_menus['tab_billno']?>" kotno="<?=$result_menus['tab_kotno']?>"><!--take_active-->
                   <!-- <div class="take_order_item_name"><img src="img/printer.png"></div>--><!--take_order_item_name-->
                	<div class="take_list_oder_num"><?=$result_menus['tab_billno']?></div>
                    <div class="take_oder_odred_name"><span>Customer</span> :<?=$result_menus['tac_customername']?></div>
                    <div class="take_oder_odred_name"><span>Mobile No</span> : <?=$result_menus['tac_contactno']?>l</div>
                     <div class="take_oder_odred_name"><span>Time</span> : <?=date("h:i:s a",strtotime($result_menus['tab_time'])) ?></div>
                     <div class="take_oder_odred_name"><span>Status</span> : <?=$result_menus['tab_status'] ?></div>
                </div><!--take_away_list_cc-->
                <a class="print_kot" > <div class="take_order_item_name cs_printkoteach" billno="<?=$result_menus['tab_billno']?>" kotno="<?=$result_menus['tab_kotno']?>"><img src="img/printer.png"></div></a>
                </div>
                <?php }}else
		 {
			 echo "<span style='color: #F00E0E;'> Nothing to display </span>";
		 }
	  
  }
  
  else if(isset($_REQUEST['value']) && $_REQUEST['value']=='deletehold'){
	  
          
          ////////stockupdate//////
         
          $sql_qry111 = $database->mysqlQuery("select tab_qty,tab_menuid,tab_portion from tbl_takeaway_billdetails 
          where tab_billno = '".$_REQUEST['bilno']."' ");
        
            $num_rows111 = $database->mysqlNumRows($sql_qry111);
              if($num_rows111){
              while($result_row111 = $database->mysqlFetchArray($sql_qry111)){
      
      
              $qty_update= $database->mysqlQuery( "UPDATE tbl_menustock SET "
              . " mk_stock_number=mk_stock_number+'".$result_row111['tab_qty']."' "
              . " where mk_menuid= '".$result_row111['tab_menuid']."' "
              . " and mk_portion= '".$result_row111['tab_portion']."' and mk_open_stock_date='".$_SESSION['date']."' and mk_opening_stock >0 ");
      
         
              
              
              }
             }
         ////stockend///////
          
           $database->mysqlQuery("DELETE FROM `tbl_takeaway_billmaster` WHERE `tab_billno` = '".$_REQUEST['bilno']."'");
	  
	$sql_qry111 = $database->mysqlQuery("delete from  tbl_hold_data where th_hold_id='".$_REQUEST['bilno']."' and th_mode='CS' ");  
        $bills[]=array();
        
        $sql_qry111 = $database->mysqlQuery("select tab_billno from tbl_takeaway_billmaster where tab_dayclosedate = '".$_SESSION['date']."' and tab_on_hold='Y' and tab_mode='CS'  ");
        
            $num_rows111 = $database->mysqlNumRows($sql_qry111);
              if($num_rows111){
              while($result_row111 = $database->mysqlFetchArray($sql_qry111)){
                   $bills[]=$result_row111['tab_billno'];
	      
              }}
              
              for($m=1;$m<count($bills);$m++){
                  
                $sql_qry111 = $database->mysqlQuery("insert into tbl_hold_data(th_hold_id,th_date,th_mode)values('".$bills[$m]."','".$_SESSION['date']."','CS')");
                  
              }
  } 
  else if(isset($_REQUEST['value']) && $_REQUEST['value']=='deletehold_all'){
	
	$holdno=($_REQUEST['bilno']); 
	foreach( $holdno as $number => $value)
				 {  
	  $database->mysqlQuery("DELETE FROM `tbl_takeaway_billmaster` WHERE `tab_billno` = '".$value."'");
				 }
                                 
                                 
        $sql_qry111 = $database->mysqlQuery("delete from  tbl_hold_data where  th_mode='CS' ");  
                                  
	  
	 // echo "DELETE FROM `tbl_takeaway_billmaster` WHERE `tab_billno` = '".$_REQUEST['bilno']."'";
  }
  else if(isset($_REQUEST['value']) && $_REQUEST['value']=='bilnoreturn'){
	  echo $_SESSION['billno'];
  }
  else if(isset($_REQUEST['value']) && $_REQUEST['value']=="guestnumber_search"){
    $credit_type='';
    if(isset($_REQUEST['credit_type'])){
    $credit_type=$_REQUEST['credit_type'];
    }
    if($credit_type=='4'){
    $string='';
    
    
    $guest_number='';
    $guest_number=$_REQUEST['number'];
    
    $string.=" ly_mobileno !='' " ;  
    
    if($guest_number!=''){
     $string.=" and (ly_mobileno LIKE '%$guest_number%' or ly_firstname LIKE '%$guest_number%'  or ly_id LIKE '%$guest_number%') " ;  
    }
    
    $guest_name='';
    $guest_name=$_REQUEST['name'];
//    if($guest_number!=''){
//       $string.=" and ly_firstname LIKE '%$guest_number%' " ;   
//    }
//    
//    if($guest_number!=''){
//       $string.=" and ly_id LIKE '%$guest_number%' " ;   
//    }
    
    
     if($guest_name!=''){
     $string.=" and (ly_mobileno LIKE '%$guest_name%' or ly_firstname LIKE '%$guest_name%'  or ly_id LIKE '%$guest_name%') " ;  
    }
    
    
    $guest_number1=array();
    $guest_name1=array();
    $sq_guest_number=$database->mysqlQuery("select ly_mobileno,ly_firstname,ly_lastname,ly_id from tbl_loyalty_reg where $string and ly_status='Active' ");
    //echo "select ly_mobileno,ly_firstname,ly_lastname from tbl_loyalty_reg where $string ";
    $nm_guest_number= $database->mysqlNumRows($sq_guest_number);
    if($nm_guest_number){
        while($result_guest_number  = $database->mysqlFetchArray($sq_guest_number)) 
            {
                      $guest_number1[]               =$result_guest_number['ly_mobileno'];
                      $guest_name1[]                 =$result_guest_number['ly_firstname'].' - '.$result_guest_number['ly_id'];
            }
        }
        echo json_encode(['mobile'=>$guest_number1,'name'=>$guest_name1]);
    }
    else if($credit_type=='3'){
        
        $guest_name='';
        $guest_name=$_REQUEST['name'];
        $guest_name11=array();
         $sql_company_name=$database->mysqlQuery("select ct_corporatename  from  tbl_corporatemaster where ct_corporatename LIKE '$guest_name%' and ct_status='Y' ");
         //echo "select ct_corporatename  from  tbl_corporatemaster where ct_corporatename LIKE '$guest_name%'  ";
         $nm_company_name= $database->mysqlNumRows($sql_company_name);
        if($nm_company_name){
        while($result_company_name  = $database->mysqlFetchArray($sql_company_name)) 
            {
                      
                      $guest_name11[]                 =$result_company_name['ct_corporatename'];
            }
        }
         echo json_encode(['name'=>$guest_name11]);
         }
        
    }
   else if($_REQUEST['set']=="pincheck"){
       
    $pin = $_REQUEST['pin'];
    $str = '';
    
    if(isset($_REQUEST['value']) && $_REQUEST['value']=="staffsel")
        $str .= "ser_authorisation_code = '$pin'";
    
    else if($_REQUEST['value']=="authpincheck")
        
        $str .= "ser_authorisation_code = '$pin'";
    
    if(isset($_REQUEST['action']) && $_REQUEST['action']=='kotcancel'){
        
    $sql_staff="select  sm.ser_bill_settle_permission,sm.ser_credit_permission,sm.ser_comp_permission,sm.ser_tip_edit_permission,
    sm.ser_discount_manual,sm.ser_discountpermission, sm.ser_bill_cancel_permission,sm.ser_staffid,sm.ser_cancelpermission,
    sm.ser_bill_reprint_per,sm.ser_bill_settle_change_per,sm.ser_bill_regen_per, dm.dr_takeorder FROM tbl_staffmaster sm
    left join tbl_designationmaster dm on dm.dr_designationid = sm.ser_designation
    where $str and sm.ser_employeestatus = 'Active' and sm.ser_kot_cancel_permission='Y'";
      
    }
    else if(isset($_REQUEST['action']) && $_REQUEST['action']=='billcancelpermission'){
        
        $sql_staff="select sm.ser_bill_settle_permission,sm.ser_credit_permission,sm.ser_comp_permission,sm.ser_tip_edit_permission,"
                . " sm.ser_discount_manual,sm.ser_discountpermission,sm.ser_bill_cancel_permission,sm.ser_cancelpermission,sm.ser_staffid,"
                . " sm.ser_bill_settle_change_per,sm.ser_bill_reprint_per,sm.ser_bill_regen_per FROM tbl_staffmaster sm where $str and "
                . " sm.ser_employeestatus = 'Active' and sm.ser_bill_cancel_permission='Y'";
      
    }
    else{
        
    $sql_staff="select  sm.ser_bill_settle_permission,sm.ser_credit_permission,sm.ser_comp_permission,sm.ser_tip_edit_permission,
    sm.ser_discount_manual,sm.ser_discountpermission,sm.ser_bill_cancel_permission,sm.ser_staffid,sm.ser_cancelpermission,
    sm.ser_bill_settle_change_per,sm.ser_bill_regen_per,sm.ser_bill_reprint_per, dm.dr_takeorder FROM tbl_staffmaster sm
    left join tbl_designationmaster dm on dm.dr_designationid = sm.ser_designation
    where $str and sm.ser_employeestatus = 'Active'";
  
    }
    $sql_staff  =  $database->mysqlQuery($sql_staff); 
    $num_staff  = $database->mysqlNumRows($sql_staff);
    if($num_staff){
        
        $row = mysqli_fetch_array($sql_staff);
        if(isset($_REQUEST['value']) && $_REQUEST['value']=="staffsel"){
            
            if($row['dr_takeorder']=='Y'){
                echo $row['ser_staffid']; 
            }else{
                echo "NO PERMISSION";
            }
        }else {
            echo $row['ser_staffid']; 
        }
        echo "*reprint:".$row['ser_bill_reprint_per']."*regen:".$row['ser_bill_regen_per']."*change:".$row['ser_bill_settle_change_per']."*kotcancel:".$row['ser_cancelpermission']."*billcancel:".$row['ser_bill_cancel_permission']."*dis_auth:".$row['ser_discountpermission']."*dis_manual:".$row['ser_discount_manual']."*tip_edit:".$row['ser_tip_edit_permission']."*credit:".$row['ser_credit_permission']."*comp:".$row['ser_comp_permission']."*bill_settle:".$row['ser_bill_settle_permission']."*".$row['ser_staffid'];
       
    }else{
        echo "NO";
    }

}



  else if(isset($_REQUEST['value']) && $_REQUEST['value']=="cancel_cs_itemqty"){
    
   
    $billno= $_REQUEST['billno'];
    
    $itemslno = $_REQUEST['itemslno'];
    $itemqty = $_REQUEST['itemqty'];
    //$reason = $_REQUEST['reason'];
    $slno = explode(',',$itemslno);
    $qty = explode(',',$itemqty);
    $reason=$_REQUEST['reason'];
    $staff=$_REQUEST['staff'];
    $login=$_SESSION['expodine_id'];
    $cancel_date_time=  date("Y-m-d H:i:s");
     if($_REQUEST['reason']!=""){
      $reason= $_REQUEST['reason'];
      
   }else{
      $reason=0; 
   }
    $combo_name=json_decode($_REQUEST['combo_name']);
     $mode="TA";
    $database->mysqlQuery("SET @branchid = " . "'" . $_SESSION['branchofid'] . "'");
    $database->mysqlQuery("SET @temp_id = " . "'" . $billno . "'");
    $database->mysqlQuery("SET @mode = " . "'" . $mode . "'");
    $sq=$database->mysqlQuery("CALL proc_kot_cancel(@branchid,@temp_id,@mode,@cancel_id)");
    $rs = $database->mysqlQuery("SELECT @cancel_id AS cancel_id");
    $row = $database->mysqlFetchArray($rs);
    $cancel_id= $row['cancel_id'];
    if(!empty($combo_name)){
        for($p=0;$p<count($combo_name);$p++){
            $combo_qty=$combo_name[$p]->combo_qty;
            $combo_count=$combo_name[$p]->combo_count;
            $combo_cancel_reason=$combo_name[$p]->reason;
            $stock_check=$combo_name[$p]->stock_check;
            $sql_combo_menu_qty_select=$database->mysqlQuery("select cbd_kot_no,cbd_combo_pack_id,cbd_combo_pack_rate,cbd_combo_qty,cbd_menu_qty,cbd_menu_id,cbd_menu_qty FROM tbl_combo_bill_details_ta where cbd_count_combo_ordering='".$combo_count."' and cbd_billno='".$billno."'");
            //echo "select cbd_kot_no,cbd_combo_pack_id,cbd_combo_pack_rate,cbd_combo_qty,cbd_menu_qty,cbd_menu_id,cbd_menu_qty FROM tbl_combo_bill_details_ta where cbd_count_combo_ordering='".$combo_count."' and cbd_billno='".$billno."'";
            $num_combo_menu_qty_select  = $database->mysqlNumRows($sql_combo_menu_qty_select);
            if($num_combo_menu_qty_select){$ii=0;
                while($result_combo_menu_qty_select  = $database->mysqlFetchArray($sql_combo_menu_qty_select)){
                    
                    $kot_no=$result_combo_menu_qty_select['cbd_kot_no'];
                    
                    if($combo_qty < $result_combo_menu_qty_select['cbd_combo_qty']){
                        $ii++;
                        $diff_combo_qty=$result_combo_menu_qty_select['cbd_combo_qty']-$combo_qty;
                        $new_total_menu_qty=$combo_qty*$result_combo_menu_qty_select['cbd_menu_qty'];
                        if($ii==1){
                            $sql_combo_update =  $database->mysqlQuery(" update tbl_takeaway_billmaster set tab_subtotal= tab_subtotal+( select '".($result_combo_menu_qty_select['cbd_combo_pack_rate']*$combo_qty)."'-cbd.cbd_combo_total_rate  FROM tbl_combo_bill_details_ta cbd where cbd.cbd_count_combo_ordering='".$combo_count."' and cbd.cbd_billno='".$billno."' LIMIT 1) WHERE tab_billno='".$billno."' ");
                           if($stock_check=='Y'){
                            $sql_combo_stock_update =  $database->mysqlQuery(" UPDATE `tbl_combo_stock` SET `cs_stock_number`=cs_stock_number+'".$diff_combo_qty."' ,`cs_last_updated`=NOW() WHERE `cs_pack_id`='".$result_combo_menu_qty_select['cbd_combo_pack_id']."' ");
                           } 
                        
                        }
                     
                        $sql_combo_menu_qty_update=$database->mysqlQuery("update tbl_combo_bill_details_ta set cbd_combo_qty= '".$combo_qty."',cbd_combo_total_rate= cbd_combo_pack_rate*'".$combo_qty."' where cbd_count_combo_ordering='".$combo_count."' and cbd_menu_id='".$result_combo_menu_qty_select['cbd_menu_id']."' and cbd_billno='".$billno."' ");
                        $sql_combo_billdetails_select=$database->mysqlQuery("select tab_slno,tab_qty FROM tbl_takeaway_billdetails where tab_billno='".$billno."' and tab_count_combo_ordering='".$combo_count."' and tab_menuid='".$result_combo_menu_qty_select['cbd_menu_id']."'");
                        //echo "select tab_slno,tab_qty FROM tbl_takeaway_billdetails where tab_billno='".$billno."' and tab_count_combo_ordering='".$combo_count."' and tab_menuid='".$result_combo_menu_qty_select['cbd_menu_id']."'";
                        $num_combo_billdetails_select  = $database->mysqlNumRows($sql_combo_billdetails_select);
                        
                        if($num_combo_billdetails_select){$i=1;
                            $result_combo_billdetails_select  = $database->mysqlFetchArray($sql_combo_billdetails_select);
                            
                            $new_combo_menu_qty_cancelled=$result_combo_billdetails_select['tab_qty']-$new_total_menu_qty;    
//                           
                            $combo_billdetails_update=$database->mysqlQuery("update tbl_takeaway_billdetails set tab_qty='".$new_total_menu_qty."',tab_cancelled = 'N'  where tab_billno='".$billno."' and tab_slno='".$result_combo_billdetails_select['tab_slno']."' ");
                             
                            if($new_total_menu_qty==0){
                                $sql_combo_menu_qty_update=$database->mysqlQuery("update tbl_combo_bill_details_ta set cbd_cancel= 'Y' where cbd_count_combo_ordering='".$combo_count."' and cbd_menu_id='".$result_combo_menu_qty_select['cbd_menu_id']."' and cbd_billno='".$billno."' ");
                                $combo_billdetails_update1=$database->mysqlQuery("update tbl_takeaway_billdetails set  tab_status='Cancelled',tab_cancelled = 'Y'  where tab_billno='".$billno."' and tab_slno='".$result_combo_billdetails_select['tab_slno']."' ");
                            }
                            
                            $insertion['tc_mode'] =$mode; 
                            $insertion['tc_dayclosedate'] =$_SESSION['date']; 
                            $insertion['tc_cancel_kotno'] =$kot_no;                   
                            $insertion['tc_cancel_id'] = $cancel_id;                
                            $insertion['tc_billno'] = $billno;
                            $insertion['tc_bill_slno'] = $result_combo_billdetails_select['tab_slno'];
                            $insertion['tc_cancel_qty'] = $new_combo_menu_qty_cancelled;
                            $insertion['tc_cancelled_by'] =$staff;
                            $insertion['tc_cancelled_login'] =$login;
                            $insertion['tc_cancelled_time'] =$cancel_date_time;
                            $insertion['tc_reason'] =$reason;
                            $insertion['tc_combo_pack_cancelled_qty']=$diff_combo_qty;
                            $insertid = $database->insert('tbl_takeaway_cancel_items', $insertion);  
                        }    
                    }
                }
            }    
        }
    }
    
    $sl_array=  array();
    for($i=0;$i<count($slno);$i++){
            if($qty[$i]!=""){
                
            $new_qty=0;    
         
            
            
             $sql_qry1 = $database->mysqlQuery("select tab_kotno from tbl_takeaway_billmaster 
where tab_billno = '".$billno."'");
        
$num_rows1 = $database->mysqlNumRows($sql_qry1);
if($num_rows1){
$result_row1 = $database->mysqlFetchArray($sql_qry1);

$kot_no=$result_row1['tab_kotno'];
}

            
            
 $sql_qry = $database->mysqlQuery("select * from tbl_takeaway_billdetails 
where tab_billno = '".$billno."' and tab_slno = $slno[$i] order by tab_slno asc");
        
        
$num_rows = $database->mysqlNumRows($sql_qry);
if($num_rows){
$result_row = $database->mysqlFetchArray($sql_qry);
if($result_row['tab_qty'] != $qty[$i]){
        
     $sl_array[]=$slno[$i];
  
         
     
                    $database->mysqlQuery("update tbl_takeaway_billdetails set tab_qty = $qty[$i],tab_amount = $qty[$i]*tab_rate
                    where tab_billno = '".$billno."' and tab_slno = $slno[$i] and tab_status!='Cancelled'");
                   
               
                  if( $qty[$i]==0){
                      
                $database->mysqlQuery("update tbl_takeaway_billdetails set tab_status='Cancelled',tab_cancelled='Y'
                    where tab_billno = '".$billno."' and tab_slno = '".$slno[$i]."'");
                
                $database->mysqlQuery("update tbl_takeaway_billdetails set tab_qty='0',tab_amount='0',tab_status='Cancelled',tab_cancelled='Y'
                    where tab_billno = '".$billno."' and tab_bill_addon_slno = '".$slno[$i]."'");

         }   
              
         
         
         
         
         
        
                    
     $new_qty=$result_row['tab_qty']- $qty[$i];   
     
     
     
     ////////stockupdate//////
          $sql_qry111 = $database->mysqlQuery("select tab_menuid,tab_portion from tbl_takeaway_billdetails 
          where tab_billno = '".$billno."' and  tab_slno = '".$slno[$i]."' ");
        
            $num_rows111 = $database->mysqlNumRows($sql_qry111);
              if($num_rows111){
              while($result_row111 = $database->mysqlFetchArray($sql_qry111)){
      
      
              $qty_update= $database->mysqlQuery( "UPDATE tbl_menustock SET "
              . " mk_stock_number=mk_stock_number+'".$new_qty."' "
              . " where mk_menuid= '".$result_row111['tab_menuid']."' "
              . " and mk_portion= '".$result_row111['tab_portion']."' and mk_open_stock_date='".$_SESSION['date']."' and mk_opening_stock >0 ");
      
           }
             }
         ////stockend///////
     
      if($billno[0]=="T"){
               $mode="TA"; 
          }else if($billno[0]=="H"){
            $mode="HD";    
          }else if($billno[0]=="C"){
              $mode="CS";
          }
     
    $insertion['tc_mode'] =$mode; 
    $insertion['tc_dayclosedate'] =$_SESSION['date']; 
    $insertion['tc_cancel_kotno'] =$kot_no;                   
    $insertion['tc_cancel_id'] = $cancel_id;                
    $insertion['tc_billno'] = $billno;
    $insertion['tc_bill_slno'] = $slno[$i];
    $insertion['tc_cancel_qty'] = $new_qty;
    $insertion['tc_cancelled_by'] =$staff;
    $insertion['tc_cancelled_login'] =$login;
    $insertion['tc_cancelled_time'] =$cancel_date_time;
    $insertion['tc_reason'] =$reason;
     
    $insertid = $database->insert('tbl_takeaway_cancel_items', $insertion);    
    
          
             }
                   
      
}
}
               
     }
    
     
     
          if($billno[0]=="T"){
               $homed="TA"; 
          }else if($billno[0]=="H"){
            $homed="HD";    
          }else if($billno[0]=="C"){
              $homed="CS";
          }
          
          
  	$database->mysqlQuery("SET @billno	 	      = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$billno) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$database->mysqlQuery("SET @bmode 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$homed) . "'");
	
	$kotno="";
	$sq=$database->mysqlQuery("CALL  proc_ta_kot_cancel(@billno,@branchid,@bmode,@MESSAGE)");
	
        
        $rp="";
        require_once("printer_functions.php");
        $printpage=new PrinterCommonSettings();
        
        
          
   $reg_status='';
   $sql_qry11 = $database->mysqlQuery("select tab_regen_status,tab_bill_print,tab_subtotal from tbl_takeaway_billmaster 
   where tab_billno = '".$billno."'");
        
  $num_rows11 = $database->mysqlNumRows($sql_qry11);
  if($num_rows11){
  while($result_row11 = $database->mysqlFetchArray($sql_qry11)){

      
      $reg_status=$result_row11['tab_regen_status'];
      
      $billprinted = $result_row11['tab_bill_print'];

      $net_amount=$result_row11['tab_subtotal'];
   }
  }
          
         // if($reg_status=='Y'){
           $printpage->print_kot_cancel_ta($cancel_id,$_SESSION['date'],"web",$_SESSION['branchofid'],$sl_array);
         
         //do not delete this 2 $printpage//
         
          $printpage->print_kot_cancel_ta_consolidated($cancel_id,$_SESSION['date'],"web",$_SESSION['branchofid']);
        //  }


         if($billprinted=='Y' && $net_amount>0){
                if($_SESSION['s_printst']=='Y'){
            $printpage->print_bill_ta($billno,$homed,$_SESSION['branchofid'],"web",$_SESSION['billip'],$_SESSION['hosttype'],$rp);
                }
         }
     
     
     
     
        $sql_login_fire  =  $database->mysqlQuery("select tf_active from tbl_firebase_notification_report where tf_report_head='Item Cancel' "); 
	$num_login_fire   = $database->mysqlNumRows($sql_login_fire);
	if($num_login_fire){ 
	while($result_login_fire  = $database->mysqlFetchArray($sql_login_fire)) 
        { 
            $firebase_report_status=$result_login_fire['tf_active'];
        }}
     
       if($_SESSION['cloud_enable_sync']=='Y' && $_SESSION['firebase_on']=='Y' && $firebase_report_status=="Y" ){
          
         $data_body='';
         $localhost=mysqli_connect(HOST_NAME, USER_NAME, PASSWORD,DATABASE_NAME);
        
      
            
                 $sql_items="select tcrr.cr_reason,toc.tc_cancel_kotno,kcm.kr_kotname, toc.tc_cancelled_by,um.u_name,bum.bu_name,tor.tab_bill_addon_slno,tor.tab_count_combo_ordering,tor.tab_unit_type,tor.tab_unit_weight,tor.tab_rate_type,tor.tab_unit_id,tor.tab_base_unit_id,tor.tab_menuid, mm.mr_menuname, mm.mr_menuid, toc.tc_cancel_qty, pm.pm_viewinkot, pm.pm_portionname,toc.tc_combo_pack_cancelled_qty
                                                                        FROM tbl_takeaway_cancel_items toc 
                                                                        left join tbl_cancellation_reasons tcrr on tcrr.cr_id=toc.tc_reason
                                                                        left join tbl_takeaway_billdetails tor on toc.tc_billno = tor.tab_billno and toc.tc_bill_slno = tor.tab_slno
                                                                        left join tbl_menumaster mm on tor.tab_menuid = mm.mr_menuid
                                                                        left join tbl_portionmaster pm on tor.tab_portion = pm.pm_id left join tbl_unit_master um on um.u_id=tor.tab_unit_id left join tbl_base_unit_master bum on bum.bu_id=tor.tab_base_unit_id
                                                                        left join tbl_kotcountermaster as kcm on mm.mr_kotcounter = kcm.kr_kotcode
                                                                        where toc.tc_cancel_id = '$cancel_id' and toc.tc_dayclosedate='".$_SESSION['date']."'   order by tab_count_combo_ordering asc  ";        
                                                                                
                                                                       

                                                                        $sql_items  =  mysqli_query($localhost,$sql_items); 
                                                                        $num_items  = mysqli_num_rows($sql_items);
                                                                        if($num_items){
                                                                            $old = '';
                                                                            $oldno = '';
                                                                            $combo_ordering_count=array();
                                                                            $combo_pack_rate=0;
                                                                            $combo_menu_qty=0;
                                                                            $combo_qty=0;
                                                                            while($result_items  = mysqli_fetch_array($sql_items)) 
                                                                            {
                                                                                
                                                                             
                                                                                
                                                                               $reason_staff='';
                                                                                 $sql_gen1 =  mysqli_query($localhost,"select ser_firstname from tbl_staffmaster where ser_staffid='". $result_items['tc_cancelled_by']."'"); 
                                                                                 $num_gen1  = mysqli_num_rows($sql_gen1);
                                                                                 if($num_gen1)
                                                                                 {
				                                                 while($result_invoice63  = mysqli_fetch_array($sql_gen1)) 
                                                                                 {
                                                                                $reason_staff=$result_invoice63['ser_firstname'];
                                                                                 }
                                                                                 } 
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                
                                                                                $addon_menu='';
                                                                                $menu='';
                                                                                if($result_items['tab_bill_addon_slno']!=''){

                                                                                    $addon_menu="**AD** " ;
                                                                                    $menu.=$addon_menu." ";
                                                                                }
                                                                                    if($result_items['tab_count_combo_ordering']){
                                        

                                                                                $sql_combo_heading  =  mysqli_query($localhost,"select  cn.cn_name,cp.cp_pack_name,cbd.cbd_combo_qty,cbd.cbd_menu_qty,cbd.cbd_combo_pack_rate FROM 
                                                                                                                                tbl_combo_bill_details_ta cbd 
                                                                                                                                left join tbl_combo_name cn on cn.cn_id=cbd.cbd_combo_id
                                                                                                                                left join tbl_combo_packs cp on cp.cp_id=cbd.cbd_combo_pack_id
                                                                                                                                where cbd.cbd_count_combo_ordering='".$result_items['tab_count_combo_ordering']."' and cbd.cbd_menu_id='".$result_items['mr_menuid']."'  and cbd.cbd_count_combo_ordering IS NOT  NULL"); 
                                                                                $num_combo_heading  = mysqli_num_rows($sql_combo_heading);
                                                                                if($num_combo_heading)
                                                                                    {
                                                                                        $result_combo_heading  = mysqli_fetch_array($sql_combo_heading);
                                                                                        $combo_pack_rate=$result_combo_heading['cbd_combo_pack_rate'];
                                                                                        $combo_menu_qty=$result_combo_heading['cbd_menu_qty'];
                                                                                        $combo_qty=$result_combo_heading['cbd_combo_qty'];
                                                                                        $combo_name = $result_combo_heading['cn_name'].'-'. $result_combo_heading['cp_pack_name'].'(Qty:'.$result_items['tc_combo_pack_cancelled_qty'].')- '.number_format(($combo_pack_rate*$result_items['tc_combo_pack_cancelled_qty']),$decimal);
                                                                                    }
                                                                            }
                                                                                    if($result_items['tab_count_combo_ordering'] && !in_array($result_items['tab_count_combo_ordering'],$combo_ordering_count)){
                                                                                            $combo_ordering_count[]=$result_items['tab_count_combo_ordering'];
                                                                                            $qtys=$combo_pack_rate*$combo_qty;
                                                                                           
                                                                                           
                                                                                           $data_body.=' \n';
                                                                                          $data_body.=$combo_name;
                                                                                           $data_body.=' \n'; 
                                                                                            
                                                                                    }
                                                                                    else{
                                                                                        $combo_name='';
                                                                                        $qtys=0;
                                                                                    }
                                                                                
                                                                                $ct++;
                                                                                $kotcounter = $result_items['kr_kotname'];

                                                                                if($kotcounter != $old){
                                                                                  
                                                                                    $oldno = '';
                                                                                    $old = $result_items['kr_kotname'];
                                                                                  
                                                                                    $kotname = '* '.$kotcounter;
                                                                                    $stln = strlen($kotname);
                                                                                    $a=0;
                                                                                    $spc = 46 - $stln;
                                                                                    for($a=0;$a<$spc;$a++){  
                                                                                       
                                                                                    }

                                                                                  
                                                                                  $data_body.=' '.$kotname.' \n';
                                                                                   
                                                                                }else{
                                                                                    $old = $result_items['kr_kotname'];
                                                                                }

                                                                                $kotno = $result_items['tc_cancel_kotno'];
                                                                                if($kotno != $oldno){
                                                                                    $oldno = $result_items['tc_cancel_kotno'];
                                                                                   
                                                                                    $kotnumber = ''.$kotno;
                                                                                    $stln = strlen($kotnumber);
                                                                                    $a=0;
                                                                                    $spc = 44 - $stln;
                                                                                    for($a=0;$a<$spc;$a++){  
                                                                                       
                                                                                    }

                                                                                  
                                                                                  $data_body.=' [ '.$kotnumber.' ] \n';
                                                                                 
                                                                                }else{
                                                                                    $oldno = $result_items['tc_cancel_kotno'];
                                                                                }
                                                                                
                                                                                
                                                                                if($result_items['pm_viewinkot']=="Y"){
                                                                                $pr='('.$result_items['pm_portionname'].')';
                                                                       }else
                                                                       {
                                                                           
                                                                         $pr="";
                                                                       }
                                                                             
                                                                              
                                                                                $menu_details='';
                                                                                $menu.= $result_items['tc_cancel_qty'].' - '.$result_items['mr_menuname'];
                                                                                
                                                                                 $rsn_cr='Reason : '.$result_items['cr_reason'];
                                                                                
                                                                                if($result_items['tab_unit_id']!="")
                                                                                    {
                                                                                    $menu_details="(".$result_items['tab_unit_type'].":".number_format($result_items['tab_unit_weight'],$decimal)." ".$result_items['u_name'].')'; 
                                                                                    }
                                                                                    else if($result_items['tab_base_unit_id']!=""){
                                                                                    $menu_details="(".$result_items['tab_unit_type'].":".number_format($result_items['tab_unit_weight'],$decimal)." ".$result_items['bu_name'].')';  
                                                                                    }
                                                                                $stln = strlen($menu);
                                                                                $a=0;
                                                                                $spc = 44 - $stln;
                                                                                 for($a=0;$a<$spc;$a++){  
                                                                                   
                                                                                   
                                                                                   }
                                                                              	   
                                                                             
                                                                                   $data_body.=$menu.' \n';  
                                                                                    if($pr!=''){
                                                                                 $data_body.=$pr.' \n';  
                                                                              }
                                                                              
                                                                               if($menu_details!=''){
                                                                              $data_body.=$menu_details.' \n';
                                                                               }
                                                                               
                                                                                if($rsn_cr!=''){
                                                                             
                                                                                $data_body.=''.$rsn_cr.' \n';
                                                                               }
                                                                               
                                                                                   
                                                                              
								               $data_body.=' \n';
                                                                               
//                                                                               
                                                                            }
                                                                            
                                                                          
                                                                       $date_new=date('Y-m-d h:i:s');
                                                                       $data_body.='KOT Cancelled By : '.$reason_staff.' \n'; 
                                                                       $data_body.='Cancelled Time : '.$date_new.' \n'; 
                                                                       
                                                                      
                                                                       $data_body.='Bill No : '.$billno.' \n'; 
                                                                       $data_body.='MODE - CS' ;    
                                                                        }
            
            
        $a="8.8.8.8";
        exec("ping -n 1 -w 1 ".$a, $output, $result);
        if($result==0)
        {      
            
    ///pushing msg///
    $branch_id_fire=$_SESSION['firebase_id'];
    
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
            'title' => $_SESSION['s_branchname']."  - CS ITEM CANCELLED",
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
    
    
//    $url = "https://fcm.googleapis.com/fcm/send";
//   //$token ='dFCy-onTEvQ:APA91bGXAQobatT-sbeLk3QTFdh-Zf10Z7dzmUIO99GHDjkrmwWwvzA7poh5dbAv55B7KrFKAQtpDwkJgo9lgwxFUC0W_RrnI1ohd7c-IJJfuCTeSSdhyKowMEKwOYZk5met5QhnCx0T';
//    $serverKey = 'AIzaSyD3zn_tP2RqeVSMsEFMJnrcZk5AuNGru-M';
//    $title = $_SESSION['s_branchname']."  - CS ITEM CANCELLED";
//    
//    $body = $data_body;
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
//    
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
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='point_loyalty'){ 
    
        $sql_login  =  $database->mysqlQuery("select ly_points from tbl_loyalty_reg where ly_id='".$_REQUEST['pointid']."' and ly_status='Active' "); 
	$num_login   = $database->mysqlNumRows($sql_login);
	if($num_login){
	while($result_login  = $database->mysqlFetchArray($sql_login)) 
	{
            
         echo $result_login['ly_points'];
                      
        }
        }
        
}else if(isset($_REQUEST['set']) && $_REQUEST['set']=='search_loyal_id'){ 
   $name1='';
   $id_loy=$_REQUEST['id_loyalty'];
   
    $sql_login  =  $database->mysqlQuery("select ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where ly_id='".$id_loy."' and ly_status='Active' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $id= $result_login['ly_id'];
                              $name1= $result_login['ly_firstname']. $result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                             ?>

                                                             <ul>
                                                                 <li class="nav" id="load_name_ul" onclick="return id_click('<?=$name1?>','<?=$id?>','<?=$num?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                                                                                                <?=$id?>    
                                                                                                </li>
                                                                                            </ul>
<?php
				  
				 
				  
			
                      
                  }
                  }
   
	
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchname'){ 
     $name1='';
   $name=$_REQUEST['name'];
   
   if(strlen($_REQUEST['name'])>2){
    $sql_login  =  $database->mysqlQuery("select ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where  (ly_firstname LIKE '%".$name."%' or ly_lastname LIKE '%".$name."%') and ly_status='Active' "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $id= $result_login['ly_id'];
                              $name1= $result_login['ly_firstname'].' '.$result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                             ?>

                                                             <ul>
                                                                 <li id="load_name_ul" onclick="return name_click('<?=$name1?>','<?=$id?>','<?=$num?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                                                                                                <?=$name1?>    
                                                                                                </li>
                                                                                            </ul>
<?php
				  
				 
				  
			
                      
                  }
                  }
   }
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchnum_new'){ 
      $num1='';
   $num=$_REQUEST['num'];
   
   if(strlen($num)>2){
    $sql_login  =  $database->mysqlQuery("select  ly_emailid,ly_gst,ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where  ly_mobileno LIKE '%".$num."%' and ly_status='Active' and (ly_default!='Y' or ly_default is NULL) "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $id= $result_login['ly_id'];
                              $name1= $result_login['ly_firstname'].' '.$result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                                 $mail= $result_login['ly_emailid'];
                                 
                                 
                                 $gst= $result_login['ly_gst'];
                             ?>

                                                             <ul>
                                                                 <li id="load_name_ul" onclick="return num_click_new('<?=$name1?>','<?=$id?>','<?=$num?>','<?=$mail?>','<?=$gst?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                                                                                                <?=$num?>    
                                                                                                </li>
                                                                                            </ul>
<?php
				  
				 
				  
			
                      
                  }
                  }
   }
	
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchname_new'){ 
     $name1='';
   $name=$_REQUEST['name'];
   
   if(strlen($_REQUEST['name'])>2){
    $sql_login  =  $database->mysqlQuery("select ly_id,ly_firstname,ly_mobileno,ly_gst,ly_emailid from tbl_loyalty_reg where  (ly_firstname LIKE '%".$name."%' or ly_lastname LIKE '%".$name."%') and ly_status='Active' and  (ly_default!='Y' or ly_default is NULL) "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                $id= $result_login['ly_id'];
                              $name1= $result_login['ly_firstname'];
				 $num= $result_login['ly_mobileno'];
                                 
                                 $mail= $result_login['ly_emailid'];
                                 
                                 
                                 $gst= $result_login['ly_gst'];
                                 
                             ?>

                                                             <ul>
                                                                 <li id="load_name_ul" onclick="return name_click_new('<?=$name1?>','<?=$id?>','<?=$num?>','<?=$mail?>','<?=$gst?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                                                                                                <?=$name1?>    
                                                                                                </li>
                                                                                            </ul>
<?php
				  
				 
				  
			
                      
                  }
                  }
   }

}else if(isset($_REQUEST['set']) && $_REQUEST['set']=='searchnumber'){ 
     $num1='';
   $num=$_REQUEST['number'];
   
   if(strlen($_REQUEST['number'])>2){
    $sql_login  =  $database->mysqlQuery("select ly_id,ly_firstname,ly_mobileno,ly_lastname from tbl_loyalty_reg where ly_mobileno LIKE '%".$num."%' and ly_status='Active'  "); 
	  $num_login   = $database->mysqlNumRows($sql_login);
	  if($num_login){
		  while($result_login  = $database->mysqlFetchArray($sql_login)) 
			{ 
                                 $id= $result_login['ly_id'];
                                 $name1= $result_login['ly_firstname']. $result_login['ly_lastname'];
				 $num= $result_login['ly_mobileno'];
                             ?>

                                                             <ul>
                                                                 <li id="load_number_ul" onclick="return number_click('<?=$name1?>','<?=$id?>','<?=$num?>');" style="cursor: pointer;font-weight: bold;color:darkred" >
                                                                                                <?=$num?>    
                                                                                                </li>
                                                                                            </ul>
<?php
				  
				 
				  
			
                      
                  }
                  }
   }
	
}else if($_REQUEST['set_loyalty_bill_change']=="bill_amount_change"){
    
     $bill_no_l=$_REQUEST['billno'];
     $new_amount= $_REQUEST['new_amount'];
     $sql_loy_nw=$database->mysqlQuery("update  tbl_takeaway_billmaster set tab_netamt='".$new_amount."' where tab_billno='".$bill_no_l."'");    
     
    }
    else if($_REQUEST['set_loyalty_bill_change_old']=="bill_amount_change_old"){
        
     $bill_no_l_old=$_REQUEST['billno_old'];
     $new_amount_old= $_REQUEST['new_amount_old'];
     $sql_loy_nw=$database->mysqlQuery("update  tbl_takeaway_billmaster set tab_netamt='".$new_amount_old."' where tab_billno='".$bill_no_l_old."'");    
     
     $_SESSION['cs_order_id']='';
     unset($_SESSION['cs_order_id']);
    
    
    }
    else if($_REQUEST['sethistory']=="delhistory"){
        
             $multibilldelhistory=     $_REQUEST['bilcardhistory'];
        
             $queryhistory=$database->mysqlQuery("  DELETE FROM tbl_bill_card_payments WHERE (mc_billno = 'temp_".$multibilldelhistory."' or mc_billno = '".$multibilldelhistory."')");  
           
   }  

/////*********** COUNTER SALES COMBOS**************////
else if(isset($_REQUEST['value']) &&$_REQUEST['value']=='load_combos'){
    
    ?>
 
    <script src="js/counter_sales.js"></script>
  
    <?php

    $sql_combo_list =  $database->mysqlQuery("  select cn.* from tbl_combo_name cn
                                                left join tbl_combo_pack_rates cpr on cpr.cpr_combo_id=cn.cn_id, tbl_combo_pack_menus cpm 
                                                where cn.cn_active='Y'  and cpr.cpr_mode='CS' and cpm.cpm_combo_id=cn.cn_id and cpm.cpm_combo_pack_id = cpr.cpr_combo_pack_id group by cn.cn_id 
                                                order by cn.cn_name asc "); 
    
    $num_combo_list = $database->mysqlNumRows($sql_combo_list);
    if($num_combo_list){$i=0;
          while ($result_combo_list = $database->mysqlFetchArray($sql_combo_list)) {
              $i++;
   ?>
            <a combo_name_id="<?=$result_combo_list['cn_id']?>" class="combo_name_selection_click">
            <div class="main_category_list <?php if($i==1){ ?> main_category_list_act <?php } ?>"><?=$result_combo_list['cn_name']?></div>
            </a>
  <?php
       }
    }
}

else if(isset($_REQUEST['value']) &&$_REQUEST['value']=='load_combo_menus'){
    
    $combo_name_id=$_REQUEST['combo_name_id'];
    
            

    $sql_combo_pack_list =  $database->mysqlQuery("select cp.* from tbl_combo_packs cp
                                                left join tbl_combo_pack_rates cpr on cpr.cpr_combo_pack_id =cp.cp_id
                                                where cp_pack_active='Y' and cpr.cpr_mode='CS'
                                                and cp_id IN(SELECT distinct(cpm_combo_pack_id) FROM tbl_combo_pack_menus ) and cp_combo='".$combo_name_id."' "); 

        $num_combo_pack_list = $database->mysqlNumRows($sql_combo_pack_list);
        if($num_combo_pack_list){$i=0;
        while ($result_combo_pack_list = $database->mysqlFetchArray($sql_combo_pack_list)) {
        $i++;$combo_menu_list=array();
     ?>

            <a class="combo_menu" onclick='return load_combo_ordering_popup(<?=$result_combo_pack_list['cp_id']?>)'>
                <div class="menu_sub_item">
                        <strong><?=$result_combo_pack_list['cp_pack_name']?></strong>
                                <?php
                                $sql_combo_pack_menu_list =  $database->mysqlQuery("SELECT `cpm_id`, `cpm_menu_id`, `cpm_combo_pack_id`, `cpm_combo_id`, `cpm_menu_sale_type`, `cpm_menu_type_label_id`, `cpm_menu_qty`, `cpm_menu_active`,mm.mr_menuid,mm.mr_menuname FROM `tbl_combo_pack_menus` left join 
                                tbl_menumaster mm on mm.mr_menuid=cpm_menu_id 
                                WHERE `cpm_combo_id`='".$combo_name_id."' and `cpm_combo_pack_id`='".$result_combo_pack_list['cp_id']."' and `cpm_menu_active`='Y'"); 
                               
                                $num_combo_pack_menu_list = $database->mysqlNumRows($sql_combo_pack_menu_list);
                                if($num_combo_pack_menu_list){$i=0;
                                      while ($result_combo_pack_menu_list = $database->mysqlFetchArray($sql_combo_pack_menu_list)) {
                                          $combo_menu_list[]=$result_combo_pack_menu_list['mr_menuname'];
                                      }
                                }
                                ?>
                   <p><?=implode(',',$combo_menu_list)?></p>
                   <span class="item_round"></span>          
                </div>
                 
            </a>
<?php
          }
    }
}

else if(isset($_REQUEST['value']) && $_REQUEST['value']=='combo_adding'){
    
    $combo_menu_details=json_decode($_REQUEST['combo_menu_details']);
    $cod_count_combo_ordering=$_REQUEST['cod_count_combo_ordering'];
    $combo_stock_check=$_REQUEST['combo_stock_check'];
    $stock_left=$_REQUEST['stock_left'];
    $combo_pack_adding_id=$combo_menu_details[0]->combo_pack_adding_id;
    $combo_qty=$combo_menu_details[0]->combo_qty;
    $combo_total_rate=$combo_qty*$combo_menu_details[0]->combo_pack_rate;
    $combo_pack_preference=$combo_menu_details[0]->combo_pack_preference;
    $last_id='';
    $slno='';
    $max_ordering_count=1;
    $sql_max_orering_count =  $database->mysqlQuery("select max(tab_count_combo_ordering) as count_combo_ordering FROM tbl_takeaway_billdetails ");
        $num_max_orering_count = $database->mysqlNumRows($sql_max_orering_count);
        if($num_max_orering_count){$i=0;
            $result_max_orering_count = $database->mysqlFetchArray($sql_max_orering_count);
            if($result_max_orering_count['count_combo_ordering']!=''){
                $max_ordering_count=$result_max_orering_count['count_combo_ordering']+1;
            }
        }
        
    if($combo_stock_check=='Y'){
        $sql_combo_stock_update =  $database->mysqlQuery(" UPDATE `tbl_combo_stock` SET `cs_stock_number`='".$stock_left."' ,`cs_last_updated`=NOW() WHERE `cs_pack_id`='".$combo_pack_adding_id."' ");
    }    
    if($cod_count_combo_ordering!=''){
        $sql_combo_update =  $database->mysqlQuery(" update tbl_takeaway_billmaster set tab_subtotal= tab_subtotal+( select '".$combo_total_rate."'-cbd.cbd_combo_total_rate  FROM tbl_combo_bill_details_ta cbd where cbd.cbd_count_combo_ordering='".$cod_count_combo_ordering."' and cbd.cbd_billno='".$_SESSION['cs_order_id']."' LIMIT 1) WHERE tab_billno='".$_SESSION['cs_order_id']."' ");
        $sql_combo_update =  $database->mysqlQuery("UPDATE `tbl_combo_bill_details_ta` SET `cbd_combo_qty`='".$combo_qty."',`cbd_combo_total_rate`='".$combo_total_rate."',cbd_combo_preference='".$combo_pack_preference."' where `cbd_billno`='".$_SESSION['cs_order_id']."' and `cbd_count_combo_ordering`='".$cod_count_combo_ordering."'");
        
      
    }
    for($p=0;$p<count($combo_menu_details);$p++){
        
        $combo_adding_id=$combo_menu_details[$p]->combo_adding_id;
        $combo_pack_adding_id=$combo_menu_details[$p]->combo_pack_adding_id;
        $combo_qty=$combo_menu_details[$p]->combo_qty;
        $combo_pack_rate=$combo_menu_details[$p]->combo_pack_rate;
        $combo_total_rate=$combo_qty*$combo_menu_details[$p]->combo_pack_rate;
        $combo_menu_id=$combo_menu_details[$p]->combo_menu_id;
        $combo_each_menu_qty=$combo_menu_details[$p]->combo_each_menu_qty;
        $combo_pack_preference=$combo_menu_details[$p]->combo_pack_preference;
        
        if($cod_count_combo_ordering==''){
        $mode='Add';
        

//        $sql_max_id =  $database->mysqlQuery("select max(cbd.cbd_id) as id FROM tbl_combo_bill_details_ta cbd");
//        $num_max_id = $database->mysqlNumRows($sql_max_id);
//        if($num_max_id){$i=0;
//        $result_max_id = $database->mysqlFetchArray($sql_max_id);
//        $last_id=$result_max_id['id'];
           
        $database->mysqlQuery("SET @preferencetext 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$pref_text) . "'");
	$database->mysqlQuery("SET @temp_billno                 = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['cs_order_id']) . "'");
	$database->mysqlQuery("SET @menuid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$combo_menu_id) . "'");
	$database->mysqlQuery("SET @portion 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,1) . "'");
	$database->mysqlQuery("SET @qty 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$combo_qty*$combo_each_menu_qty) . "'");
	$database->mysqlQuery("SET @preferencetext              = " . "'" . mysqli_real_escape_string($database->DatabaseLink,$combo_pack_preference) . "'");
        $database->mysqlQuery("SET @rate 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,0) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$database->mysqlQuery("SET @mode 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$mode) . "'");
	$database->mysqlQuery("SET @order_from 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'CS') . "'");
	$database->mysqlQuery("SET @rate_type 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,'Portion') . "'");
        $database->mysqlQuery("SET @unit_type 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,NULL) . "'");
        $database->mysqlQuery("SET @unit_id 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,0) . "'");
        $database->mysqlQuery("SET @base_unit_id 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,0) . "'");
        $database->mysqlQuery("SET @unit_weight 		= " . "'" . mysqli_real_escape_string($database->DatabaseLink,0) . "'");
	$database->mysqlQuery("SET @serailno                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,0) . "'");
        $database->mysqlQuery("SET @dish_type                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,'COMBO') . "'");                        
        $database->mysqlQuery("SET @food                    = " . "'" . mysqli_real_escape_string($database->DatabaseLink,0) . "'");
        
        $sq=$database->mysqlQuery("CALL  proc_temptakeaway(@temp_billno,@menuid,@rate_type,@portion,@unit_type,@unit_weight,@unit_id,@base_unit_id,@qty,@preferencetext,@rate,@branchid,@mode,@order_from,@serailno,@dish_type,@food)");        
        $sql_max_slno =  $database->mysqlQuery("select max(tab_slno) as slno from tbl_takeaway_billdetails where tab_billno='".$_SESSION['cs_order_id']."' ");
        $num_max_slno = $database->mysqlNumRows($sql_max_slno);
        if($num_max_slno){
          
               $result_max_slno = $database->mysqlFetchArray($sql_max_slno);
            
               $max_slno=$result_max_slno['slno'];
            
        }
        $sql_combo_count_update =  $database->mysqlQuery(" Update tbl_takeaway_billdetails set tab_count_combo_ordering='".$max_ordering_count."'  where tab_billno='".$_SESSION['cs_order_id']."' and tab_slno='".$max_slno."' and tab_count_combo_ordering IS NULL");
        
        $sql_combo_add =  $database->mysqlQuery("INSERT INTO `tbl_combo_bill_details_ta`(cbd_count_combo_ordering,`cbd_billno`, `cbd_combo_id`, `cbd_combo_pack_id`, `cbd_combo_qty`, `cbd_combo_pack_rate`,cbd_combo_total_rate, `cbd_menu_id`, `cbd_menu_qty`,`cbd_combo_preference`, `cbd_entry_date`, `cbd_dayclosedate`, `cbd_order_status`)
                                             VALUES ('".$max_ordering_count."','".$_SESSION['cs_order_id']."','".$combo_adding_id."','".$combo_pack_adding_id."','".$combo_qty."','".$combo_pack_rate."','".$combo_total_rate."','".$combo_menu_id."','".$combo_each_menu_qty."','".$combo_pack_preference."',NOW(),'".$_SESSION['date']."','Generated')"); 
        
        $sq=$database->mysqlQuery("CALL  proc_combo_ta_subtotal_calculation('".$_SESSION['cs_order_id']."','".$max_ordering_count."')");
    }else{
        $mode='Edit';
      
          $sql_ta_billdetails =  $database->mysqlQuery(" Update tbl_takeaway_billdetails set tab_qty='".$combo_qty*$combo_each_menu_qty."' where tab_count_combo_ordering='".$cod_count_combo_ordering."' and tab_menuid='".$combo_menu_id."' ");
        
    }    
    }
    
    
     $sql_delete_day=mysqli_query($con,"update tbl_takeaway_billdetails set tab_dayclose_in='".$_SESSION['date']."' "
     . " where tab_billno='".$_SESSION['cs_order_id']."' ");
    
    
}
else if(isset($_REQUEST['set']) &&  $_REQUEST['set']=="coupon_check"){
       
       $code_active='';
       $code_value='';
       $sql_company_name=$database->mysqlQuery("select gp.gp_value,tgp.tgp_code_active   from  tbl_loyalty_group_details tgp left join tbl_loyalty_campaign_group gp on gp.gp_id=tgp.tgp_groupid left join tbl_loyalty_campaign lc on lc.lc_id=tgp.tgp_campaign_id where gp.gp_status='Y' and CURRENT_DATE() between lc.lc_from and lc.lc_to  and tgp.tgp_groupcode='".$_REQUEST['code']."' ");
        
         $nm_company_name= $database->mysqlNumRows($sql_company_name);
        if($nm_company_name){
            $dataok="Y";
        while($result_company_name  = $database->mysqlFetchArray($sql_company_name)) 
            {
                      
                   $code_value=$result_company_name['gp_value'];
                   $code_active=$result_company_name['tgp_code_active'];
            }
        }
        echo $code_value.'*'.$code_active.'*'.$dataok;
 }
   
 else if(isset($_REQUEST['set']) &&  $_REQUEST['set']=="check_barcode"){
    
    $sql_cat_s  =  $database->mysqlQuery("select mrc_menuid from tbl_menurate_counter where mrc_barcode='".$_REQUEST['barcode']."' and mrc_menuid !='".$_REQUEST['menuid_barcode']."' "); 
            $num_cat_s  = $database->mysqlNumRows($sql_cat_s);
                if($num_cat_s){
                    echo 'sorry';
                }else{
                    echo 'ok';
                }
    
    
}else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='check_discount_after')){
 
 
    
  $dis=0;
  $sql_general =  $database->mysqlQuery("Select tab_discountvalue from tbl_takeaway_billmaster where tab_billno ='".$_REQUEST['billno']."' "); 
		$num_general  = $database->mysqlNumRows($sql_general);
		if($num_general)
		{
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
					     $dis	=$result_general['tab_discountvalue'];
					                                                                                                            
                                                 
                  }
                }
                
                $item_ds=0;                
        $sql_listall_ds  =  $database->mysqlQuery("SELECT sum(tab_discount)as disc,tab_qty from  tbl_takeaway_billdetails   WHERE tab_discount>0 and tab_billno='".$_REQUEST['billno']."'  "); 
	$num_listall_ds  = $database->mysqlNumRows($sql_listall_ds);
	if($num_listall_ds){
		  while($row_listall_ds  = $database->mysqlFetchArray($sql_listall_ds)) 
			   {
				
                                $item_ds=number_format(str_replace(',', '', ($row_listall_ds['disc']*$row_listall_ds['tab_qty'])),$_SESSION['be_decimal']);
                            }
			}  
                
           if($dis>0){
               echo 'yes*'.$item_ds;
           }else{
               echo 'no*'.$item_ds;
           }     
           
           
                
                
 }else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='proceed_after_dis')){
 
     
  $redeem=0;
  $sql_general =  $database->mysqlQuery("Select tab_redeem_amount from  tbl_takeaway_billmaster where tab_billno ='".$_REQUEST['billno']."' "); 
		$num_general  = $database->mysqlNumRows($sql_general);
		if($num_general)
		{
		   while($result_general  = $database->mysqlFetchArray($sql_general)) 
			{
			$redeem			=$result_general['tab_redeem_amount'];
			                           
                  }
                }
                
                
			  if($_REQUEST['type']=="drop")
			  {
				  $discount_of_or=0;
				  $discount_unit_or=0;
				  $discount_or="Y";
				  $discountid_or=$_REQUEST['discount'];
			  }else
			  {
				 $discount_of_or=$_REQUEST['discount'];
				  $discount_unit_or=$_REQUEST['disctype'];
				  $discount_or="Y";
				  $discountid_or=0; 
			  }
			  
		  
          
        $database->mysqlQuery("SET @temp_billno	 	= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_REQUEST['billno']) . "'");
	$database->mysqlQuery("SET @branchid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['branchofid']) . "'");
	$database->mysqlQuery("SET @discount_of 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$discount_of_or) . "'");
	$database->mysqlQuery("SET @discount_unit 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$discount_unit_or) . "'");
        $database->mysqlQuery("SET @loginid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$_SESSION['expodine_id']) . "'");	
	$database->mysqlQuery("SET @discountid 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$discountid_or) . "'");
        $database->mysqlQuery("SET @redeem 			= " . "'" . mysqli_real_escape_string($database->DatabaseLink,$redeem) . "'");
     
        $sq=$database->mysqlQuery("CALL  proc_ta_discount_after(@temp_billno,@branchid,@discount_of,@discount_unit,@discountid,@loginid,@redeem,@message)");
        $rs = $database->mysqlQuery( 'SELECT @message as message' );
	$msg='';
	while($row = mysqli_fetch_array($rs))
	{
	$msg= $row['message'];
	}
        
    
    echo $s;
   
 }else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='regen_ta_cs')){
        
         $sql_general =  $database->mysqlQuery("update  tbl_takeaway_billmaster set tab_regen_status='Y',tab_bill_reorder='".$_REQUEST['bill']."'  where tab_billno ='".$_REQUEST['bill']."' ");
         
         $sql_general =  $database->mysqlQuery("update  tbl_takeaway_billdetails set tab_regen_status_menu='Y' where tab_billno ='".$_REQUEST['bill']."' ");
         
         
         $sql_general =  $database->mysqlQuery("update  tbl_combo_bill_details_ta set cbd_regen_status='Y' where cbd_billno ='".$_REQUEST['bill']."' ");
        
         $_SESSION['cs_order_id']=$_REQUEST['bill'];
         
         ///point add remove////
            
         $sql_login_fire2  =  $database->mysqlQuery("delete from tbl_loyalty_pointadd_bill where lob_billno='".$_REQUEST['bill']."' ");         
                
        ///loy end /// 
         
       $sql_general =  $database->mysqlQuery("update  tbl_loyalty_reg set ly_default='Y',ly_module='CS' where ly_id ='".$_REQUEST['loy_id']."' "); 
       
}
else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='check_barcode_cs')){
        
        
         $sql_general =  $database->mysqlQuery("Select * from tbl_menumaster tm left join tbl_menurate_counter tc on tm.mr_menuid=tc.mrc_menuid  where tm.mr_menuid ='".$_REQUEST['menuid']."' "); 
		$num_general  = $database->mysqlNumRows($sql_general);
		if($num_general)
		{
		   while($result_general  = $database->mysqlFetchArray($sql_general)) 
		{
					    
	 echo 	$result_general['mr_rate_type'].'*'.$result_general['mr_unit_type'].'*'.$result_general['mr_base_unit']
        .'*'.$result_general['mrc_unit_weight'].'*'.$result_general['mrc_unit_id'].'*'.$result_general['mrc_base_unit_id'].'*'.$result_general['mrc_rate'].'*'.$result_general['mrc_portion'] ;	                                                                                                            
                                                 
                  }
                }
        
        
        
}
 else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='check_reorder_settle')){
        
        
         $sql_general =  $database->mysqlQuery("Select tab_billno from tbl_takeaway_billdetails   where tab_status ='Generated'  and  tab_billno='".$_REQUEST['bill_check']."' "); 
		$num_general  = $database->mysqlNumRows($sql_general);
		if($num_general)
		{
			echo 'yes';
                }else{
                    echo 'no';
                }
        
        
        
    }
   else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='check_barcode_plu')){
        
        
         $sql_general =  $database->mysqlQuery("Select mr_menuid from tbl_menumaster   where mr_plu='".$_REQUEST['plu']."' "); 
		$num_general  = $database->mysqlNumRows($sql_general);
		if($num_general)
		{
				while($result_general  = $database->mysqlFetchArray($sql_general)) 
					{
					    
			echo 	$result_general['mr_menuid'];
                  }
                }
        
        
        
 }
 else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='load_hold_new')){
       
         
					$count_hold='0';
					$subt=0; $subt1=0;	
					$sql_menulist= "SELECT `tab_billno`,tab_time,tab_subtotal,tab_mode FROM  tbl_takeaway_billmaster  WHERE tab_dayclosedate='".$_SESSION['date']."'  AND tab_on_hold='Y' AND tab_mode='CS' order by tab_time desc limit 10";
					$sql_menus  =  $database->mysqlQuery($sql_menulist); 
					$num_menus  = $database->mysqlNumRows($sql_menus);
					if($num_menus){
					while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
					{
						
                                           
                                            
                                        $sql_menulist5= "SELECT cbd_combo_total_rate FROM  tbl_combo_bill_details_ta  WHERE cbd_dayclosedate='".$_SESSION['date']."'  AND cbd_billno='".$result_menus['tab_billno']."'  group by cbd_combo_pack_id limit 50";
					$sql_menus5  =  $database->mysqlQuery($sql_menulist5); 
					$num_menus5  = $database->mysqlNumRows($sql_menus5);
					if($num_menus5){
					while($result_menus5  = $database->mysqlFetchArray($sql_menus5)) 
					{
                                            $subt=$subt+$result_menus5['cbd_combo_total_rate'];
                                            
                                        }
                                        } 
                                        
                                        
                                         $sql_menulist5= "SELECT sum(tab_amount) as tot FROM  tbl_takeaway_billdetails  WHERE tab_dayclose_in='".$_SESSION['date']."'  AND tab_billno='".$result_menus['tab_billno']."' and tab_count_combo_ordering is NULL limit 50 ";
					$sql_menus5  =  $database->mysqlQuery($sql_menulist5); 
					$num_menus5  = $database->mysqlNumRows($sql_menus5);
					if($num_menus5){
					while($result_menus5  = $database->mysqlFetchArray($sql_menus5)) 
					{
                                            $subt1=$subt1+$result_menus5['tot'];
                                            
                                        }
                                        } 
                                        
                                           
                                           
                                            
					?> 
  
                                  	<tr class="holdview_each_tr" bilno="<?=$result_menus['tab_billno']?>" mode="<?=$result_menus['tab_mode']?>">
                                        <td width="20%" ><?=$result_menus['tab_billno'] ?></td>
                                        <td><?=date("h:i:s",strtotime($result_menus['tab_time'])) ?></td>
                                        <td width="30%"><?=($subt+$subt1)?></td>
                                        <td width="10%"><div class="hold_list_pop holdview_each" bilno="<?=$result_menus['tab_billno']?>"></div></td>
                                      
                                        </tr>
                                        
                                       <script src="js/counter_holdview.js"></script>
                                      <?php }  } 
        
        
        
    }
     else if(isset($_REQUEST['set'])&& ($_REQUEST['set']=='load_hold_new_count')){
         
        
						$count_hold='0';
					 	$sql_menulist= "SELECT count(`th_hold_id`) as ct FROM  tbl_hold_data  WHERE th_date='".$_SESSION['date']."'  AND  th_mode='CS' limit 25";
						$sql_menus  =  $database->mysqlQuery($sql_menulist); 
						$num_menus  = $database->mysqlNumRows($sql_menus);
						if($num_menus){
							while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
								{
								   $count_hold=$result_menus['ct'];
								}
						}
		echo $count_hold;			
         
} 
else if(isset($_REQUEST['value']) && $_REQUEST['value']=='best_selling_cat'){ 
    
?>

 <script src="js/counter_popup.js"></script>

 <?php 
 
    $sql_best_selling =  $database->mysqlQuery("select tbd.tab_menuid FROM tbl_takeaway_billdetails tbd
    LEFT  join tbl_takeaway_billmaster tbm on tbm.tab_billno = tbd.tab_billno
    where tbd.tab_count_combo_ordering IS NULL and tbm.tab_dayclosedate between CURDATE( ) - INTERVAL 7  DAY AND CURDATE( ) and tbm.tab_status='Closed' and tbm.tab_mode='CS'
    group by tbd.tab_menuid, tbd.tab_portion, tbd.tab_unit_id, tbd.tab_base_unit_id,tbd.tab_unit_weight order by tbd.tab_qty desc LIMIT 0,15");
        $num_best_selling = $database->mysqlNumRows($sql_best_selling);
        if($num_best_selling){
            while($result_best_selling = $database->mysqlFetchArray($sql_best_selling)){
 
	        $sql_menulist =  "select mr_stock_inventory,mr_menuid,mr_menuname,mr_unit_type from tbl_menumaster  WHERE 
                 mr_active='Y'  and  mr_menuid='".$result_best_selling['tab_menuid']."' 
                 GROUP BY mr_menuid order by mr_menuname ASC ";
                                    
                                    $sql_menus = $database->mysqlQuery($sql_menulist);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) {
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                            
                                            $menu_name = $result_menus['mr_menuname'];
                                            $menu_id = $result_menus['mr_menuid'];
                                            $stock_in_no=$result_menus['mr_stock_inventory'];
                                            $menu_type_click= $result_menus['mr_unit_type'];
                                          
       if($_SESSION['main_language']!='english'){

        $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join "
        . " tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

             $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
             $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
             $menu_name=$result_arabmenu['lm_menu_name'];
                                            
        }
                                             

        if($_SESSION['s_listimage'] == "Y") { 
                                                 
                $sql_img = "SELECT mes_imagethumb FROM tbl_menuimages where mes_menuid='" . $result_menus['mr_menuid'] . "' limit 0,1";
                $sql_imgs = $database->mysqlQuery($sql_img);
                $num_imgs = $database->mysqlNumRows($sql_imgs);
                if ($num_imgs) {
                while ($result_imgs = $database->mysqlFetchArray($sql_imgs)) {
                     $image = $result_imgs['mes_imagethumb'];
                  }
                  } else {
                     $image = "uploads/default_photo.jpg";
                  }
        }
                                            
              $portion="";
              $sql_menuportion = "select mrc_menuid from tbl_menurate_counter where mrc_menuid='".$result_menus['mr_menuid']."' and (mrc_rate >0 OR mrc_rate IS NOT NULL)";
                                         
                                            $sql_portions = $database->mysqlQuery($sql_menuportion);
                                            $num_portions = $database->mysqlNumRows($sql_portions);
                                            if ($num_portions) {
                                                
                                                $portion="Y";
                                           }
                     
                                            
               $portnstock = "N";
               $sql_menuportion1 = "SELECT mk_menuid from tbl_menustock  where mk_menuid='$menu_id' AND mk_stock = 'Y'";
               $sql_portions1 = $database->mysqlQuery($sql_menuportion1);
               $num_portions1 = $database->mysqlNumRows($sql_portions1);
               if ($num_portions1) {
               $portnstock = "Y";
               }   
                         
               
               $portn_click = "yes";
               $sql_menuportion12 = "SELECT mrc_portion from tbl_menurate_counter  where mrc_menuid='$menu_id' ";
               $sql_portions12 = $database->mysqlQuery($sql_menuportion12);
               $num_portions12 = $database->mysqlNumRows($sql_portions12);
               if ($num_portions12>1) {
                $portn_click = "no";
               }    
                                            
                                           
               $dyno_rate = "";
               $sql_menuportion127 = "SELECT mr_manualrateentry from tbl_menumaster where mr_menuid='$menu_id' ";
               $sql_portions127 = $database->mysqlQuery($sql_menuportion127);
               $num_portions127 = $database->mysqlNumRows($sql_portions127);
               if ($num_portions127) {
               while ($result_imgs = $database->mysqlFetchArray($sql_portions127)) {
                if($result_imgs['mr_manualrateentry']=='Y'){
                  $dyno_rate = "yes";
                }else{
                 $dyno_rate = 'no';
                }
                
                }
                } 
                                            
                                            
                                            
           $rtr=''; $rater=''; 
           $sql_menuportion127 = "SELECT * from tbl_menurate_counter mc left join tbl_portionmaster pm on pm.pm_id=mc.mrc_portion"
           . " left join tbl_base_unit_master tbu on tbu.bu_id=mc.mrc_base_unit_id left join tbl_unit_master tu on "
           . "tu.u_id=mc.mrc_unit_id where mc.mrc_menuid='$menu_id' ";
           
           $sql_portions127 = $database->mysqlQuery($sql_menuportion127);
           $num_portions127 = $database->mysqlNumRows($sql_portions127);
           if ($num_portions127) { 
                  while ($result_imgs = $database->mysqlFetchArray($sql_portions127)) {
                                                   
                   $rtr.= $result_imgs['u_name'].$result_imgs['bu_name'].$result_imgs['pm_portionshortcode'].' : '.$result_imgs['mrc_rate'].'|'; 
                              
            } } 
                           
                           
     $rater= explode('|', $rtr) ;
                                             
     if(isset($_REQUEST['menuid'])){ ?>
 
		<a style="position: relative; " typ_pop="<?=$menu_type_click?>"  <?php  if( $dyno_rate !='yes' && $_SESSION['be_single_click_add']=='Y'  && $menu_type_click !='Packet' && $menu_type_click !='Loose' && $portn_click=='yes') { ?> onclick="single_cart('<?=$menu_id?>','<?=$stock_in_no?>')" <?php } ?>  menuid="<?=$menu_id?>" class="ta_menuitem <?php if($menu_type_click =='Packet' || $_SESSION['be_single_click_add']=='N'  || $menu_type_click =='Loose' || $portn_click =='no' || $dyno_rate=='yes'){ ?> counter_popup_button <?php } if ($portnstock=="N") { ?> notinstock_cs <?php } ?>  <?php if ($portion == "N") { ?> noportionalert_cs <?php } ?>"  >
                    <div <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="width:175px;height: 90px;" <?php } ?> class="<?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> menu_sub_item <?php }else{ ?> menu_sub_item1 menu_1 <?php }  ?>  <?php if($_REQUEST['menuid']==$menu_id){ ?> take_item_active <?php } ?> ">

  <?php if ($_SESSION['s_listimage'] == "Y") { // image show permission  ?>
      <div class="product_img" style="border-radius: 10px;height:60px;margin-left: 15px;width:140px "><img src="<?= $image ?>"  width="168" height="60" /></div>
    <?php } ?>



 <?php if ($_SESSION['be_rate_on_button'] =='Y') { ?>  <p style="height: 28px;margin-bottom: 0px;line-height: 1.2;<?php if($_SESSION['s_listimage'] == "N"){ ?> overflow: hidden;margin-top: -7px; <?php } ?> "> <?=$menu_name?></p> <?php } else{ ?>  <?=$menu_name?>  <?php } ?>    <span class="item_round"></span>
                    
     <?php if ($portnstock=="Y" && $_SESSION['be_rate_on_button'] =='Y') { ?>  
                       
                       <span style=" <?php if($_SESSION['s_listimage'] == "Y"){ ?> bottom:-7px; <?php }else{ ?> bottom: 3px; <?php } ?>  position: relative;left: 1px;color: #6a6a6a;display: inline-block;font-size: 9px;line-height: 1.2;"><?=$rater[0].str_repeat('&nbsp;', 5).$rater[1]?></span> 
                      
                       <span style="  <?php if($_SESSION['s_listimage'] == "Y"){ ?> bottom:-7px; <?php }else{ ?> bottom: 6px; <?php } ?> position: relative;left: 1px;color: #6a6a6a;display: inline-block;font-size: 9px;line-height: 1.2;"><?=$rater[2].str_repeat('&nbsp;', 5).$rater[3]?></span> 
               
      <?php } ?>
                    
                    
                    
                    
                    
     </div></a>

     <?php } else { ?>

     <a style="position: relative; " typ_pop="<?=$menu_type_click?>" <?php  if($dyno_rate !='yes' && $_SESSION['be_single_click_add']=='Y' &&  $menu_type_click !='Packet' && $menu_type_click !='Loose' && $portn_click=='yes') { ?> onclick="single_cart('<?=$menu_id?>','<?=$stock_in_no?>')" <?php } ?>  menuid="<?=$menu_id?>" class="ta_menuitem <?php if($menu_type_click =='Packet' || $_SESSION['be_single_click_add']=='N'  || $menu_type_click =='Loose' || $portn_click =='no' || $dyno_rate=='yes'){ ?> counter_popup_button <?php } if ($portnstock=="N") { ?> notinstock_cs <?php } ?>  <?php if ($portion == "N") { ?> noportionalert_cs <?php } ?>"  >
         <div <?php if($_SESSION['s_listimage'] == "Y"){ ?> style="width:175px;height: 90px;" <?php } ?> class="<?php if( $_SESSION['menu_theme']=='Theme_1'){ ?> menu_sub_item <?php }else{ ?> menu_sub_item1 menu_1 <?php }  ?> ">

  <?php if ($_SESSION['s_listimage'] == "Y") { // image show permission  ?>
                                                    <div class="product_img" style="border-radius: 10px;height:60px;margin-left: 15px;width:140px "><img src="<?= $image ?>"  width="168" height="60" /></div>
                                        <?php } ?>


     <?php if ($_SESSION['be_rate_on_button'] =='Y') { ?>  <p style="height: 28px;margin-bottom: 0px;line-height: 1.2;<?php if($_SESSION['s_listimage'] == "N"){ ?> overflow: hidden;margin-top: -7px; <?php } ?>"> <?=$menu_name?></p> <?php } else{ ?>  <?=$menu_name?>  <?php } ?> <span class="item_round"></span>
            
     <?php if ($portnstock=="Y" && $_SESSION['be_rate_on_button'] =='Y') { ?>  
                       
    <span style="<?php if($_SESSION['s_listimage'] == "Y"){ ?> bottom:-7px; <?php }else{ ?> bottom: 3px; <?php } ?>   position: relative;left: 1px;color: #6a6a6a;display: inline-block;font-size: 9px;line-height: 1.2;"><?=$rater[0].str_repeat('&nbsp;', 5).$rater[1]?></span> 
                      
    <span style=" <?php if($_SESSION['s_listimage'] == "Y"){ ?> bottom:-7px; <?php }else{ ?> bottom: 6px; <?php } ?>  position: relative;left: 1px;color: #6a6a6a;display: inline-block;font-size: 9px;line-height: 1.2;"><?=$rater[2].str_repeat('&nbsp;', 5).$rater[3]?></span> 
            
    <?php } ?>
             
    </div></a>

    <?php } ?>

     <?php }}  }} else
    {
         
	echo "<span style='color: #F00E0E;margin-left: 43%;'> Nothing to display </span>";
        
    }
 }
     
     
 
  
function in_array_r($item , $array){
    
    return preg_match('/"'.$item.'"/i' , json_encode($array));
}





?>