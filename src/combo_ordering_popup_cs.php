<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
include("api_multiplelanguage_link.php");
$combo_pack_id='';
$combo_pack_rate=0;
$cod_count_combo_ordering='';
$combo_pack_qty=0;
if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_combo_ordering_popup'){
    $combo_pack_id=$_REQUEST['combo_pack_id'];
}
else if(isset($_REQUEST['set']) && $_REQUEST['set']=='load_combo_ordering_popup_for_edit'){
    $combo_pack_id=$_REQUEST['combo_pack_id'];
    $combo_pack_qty=$_REQUEST['combo_pack_qty'];
}
    //echo "select * from tbl_combo_packs where  cp_id='".$combo_pack_id."'";
    $sql_combo_pack_details =  $database->mysqlQuery("select cp.*, cn.cn_id,cn.cn_type, cn.cn_name,cn.cn_stock_check,  cs.cs_stock_status, cs.cs_stock_number from tbl_combo_packs cp 
                                                        left join tbl_combo_name cn on cn.cn_id=cp.cp_combo 
                                                        left join tbl_combo_stock cs on cs.cs_pack_id=cp.cp_id
                                                        where   cp_id='".$combo_pack_id."' "); 
    $num_combo_pack_details = $database->mysqlNumRows($sql_combo_pack_details);
        if($num_combo_pack_details){$i=0;
            while ($result_combo_pack_details = $database->mysqlFetchArray($sql_combo_pack_details)) {
                $sql_combo_pack_rate =  $database->mysqlQuery("select cpr.cpr_rate  FROM tbl_combo_pack_rates cpr where cpr.cpr_combo_pack_id='".$combo_pack_id."' and  cpr.cpr_mode='CS' "); 
                //echo "select cpr.cpr_rate  FROM tbl_combo_pack_rates cpr where cpr.cpr_combo_pack_id='".$combo_pack_id."' and cpr.cpr_floor_id='".$_SESSION['floorid']."' and cpr.cpr_mode='DI'";
                $num_combo_pack_rate = $database->mysqlNumRows($sql_combo_pack_rate);
                    if($num_combo_pack_rate){$i=0;
                        $result_combo_pack_rate = $database->mysqlFetchArray($sql_combo_pack_rate);
                    
                        $combo_pack_rate=$result_combo_pack_rate['cpr_rate'];
                    }    
?>
<script src="js/combo_ordering_cs.js"></script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
 <script> 
     $('#combo_preference').multiselect({
         nonSelectedText: 'Select Preference',
        onChange: function(event) {
            
            if($('#combo_preference').val() && $('#combo_preference').val()!=''){
                
                   
                $('#manual_preference').val($('#combo_preference').val()+",");
            }else{
                $('#manual_preference').val("");
            }
	}
		
    });
    
function numonly(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && charCode > 43 && (charCode < 48 || charCode > 57)) {

            return false;

        }
        return true;
    }
</script>
<style>.focused{    border: solid 1px #f00 !important;}
.combo_qty_lft{color:black;background-color:#ffc877;border-radius:5px;    font-size: 17px;padding: 3px;}
</style>
<div class="combo-popup" style="height: 550px">
                        <div class="combo-popup-head">
                            <input type="hidden" id="combo_type" value="<?=$result_combo_pack_details['cn_type'] ?>">
                            <input type="hidden" id="combo_pack_max_qty" value="<?=$result_combo_pack_details['cp_pack_qty'] ?>">
                            <input type="hidden" id="combo_adding_id" value="<?=$result_combo_pack_details['cn_id'] ?>">
                            <input type="hidden" id="combo_pack_adding_id" value="<?=$result_combo_pack_details['cp_id'] ?>">
                            <input type="hidden" id="combo_pack_rate" value="<?=$combo_pack_rate?>">
                            <input type="hidden" id="combo_stock_check" value="<?=$result_combo_pack_details['cn_stock_check']?>">
                            <span><?=$result_combo_pack_details['cn_name']?>-<?=$result_combo_pack_details['cp_pack_name'] ?></span>
                            <div class="combo-pop-close" id="combo_pop_close"><img src="img/cancel_bill.png"></div>
                        </div>
     <div class="" style="width: 100%;height: 5px;line-height: 0px;float: left;position: relative;top: -5px">
                            <div class="popup_validate" style="width: 100%;height: 5px;line-height: 0px;display:none">
                                  <span class="popup_validate_alert" style="width: 100%; height: 5px; line-height: 11px; ">Select quantity</span>
                            </div></div>
                        <div class="combo-popup-left-qty-sec">
                        
                            
                            
                            <div class="popup_quarter_cc">
            <div class="popup_potion_head">Quantity  <?php if($result_combo_pack_details['cn_stock_check']=='Y') { ?> Left :<span class="combo_qty_lft" id="stock_show" ><?=$result_combo_pack_details['cs_stock_number']?></span><?php } ?>     </div> 
                                <div class="combo_add_popup_qty_box">
                                    <input onKeyPress="return numonly();" type="text" id="combo_qty_select"  placeholder="Enter Qty">
                                </div>
                                
                                    <div class="keys">
                                        <!-- operators and other keys -->
                                        <span class="combo_caclulator_btn" >1</span>
                                        <span class="combo_caclulator_btn" title="cal_2">2</span>
                                        <span class="combo_caclulator_btn" title="cal_3">3</span>
                                        <span class="combo_caclulator_btn" title="cal_4">4</span>
                                        <span class="combo_caclulator_btn" title="cal_5">5</span>
                                        <span class="combo_caclulator_btn" title="cal_6">6</span>
                                        <span class="combo_caclulator_btn" title="cal_7">7</span>
                                        <span class="combo_caclulator_btn" title="cal_8">8</span>
                                        <span class="combo_caclulator_btn" title="cal_9">9</span>
                                        <span class="combo_caclulator_btn" title="cal_0">0</span>
<!--                                        <span class="combo_caclulator_btn" title="cal_.">.</span>-->
                                        <span style="width: 66%;" class="clear" id="combo_clear_calc">Clear</span>
                                    </div>
                                </div>
                            
                        
                        </div><!--combo-popup-left-qty-sec-->
                        
                        
                        <div class="combo-popup-right-sec">
                            	<div id="combo_accordion">
                                 
                                    <div class="accordion-container">
                                    <section class="accordion">
                                        <?php
                                            $sql_combo_menu_details =  $database->mysqlQuery("select cpm.cpm_id, cpm.cpm_menu_id, cpm.cpm_combo_pack_id, cpm.cpm_combo_id, cpm.cpm_menu_sale_type, cpm.cpm_menu_type_label_id, cpm.cpm_menu_qty, cpm.cpm_menu_active,mm.mr_menuname,ml.cml_label     
                                                                                              from tbl_combo_pack_menus cpm left join tbl_menumaster mm on mm.mr_menuid=cpm.cpm_menu_id left join tbl_combo_menu_labels ml on ml.cml_id=cpm.cpm_menu_type_label_id where cpm.cpm_combo_pack_id='".$combo_pack_id."' and cpm_menu_active='Y' order by cpm_menu_sale_type,cpm_menu_type_label_id asc  "); 
//                                            echo "select cpm.cpm_id, cpm.cpm_menu_id, cpm.cpm_combo_pack_id, cpm.cpm_combo_id, cpm.cpm_menu_sale_type, cpm.cpm_menu_type_label_id, cpm.cpm_menu_qty, cpm.cpm_menu_active,mm.mr_menuname,ml.cml_label     
//                                                                                              from tbl_combo_pack_menus cpm left join tbl_menumaster mm on mm.mr_menuid=cpm.cpm_menu_id left join tbl_combo_menu_labels ml on ml.cml_id=cpm.cpm_menu_type_label_id where cpm.cpm_combo_pack_id='".$combo_pack_id."'";
                                            $num_combo_menu_details = $database->mysqlNumRows($sql_combo_menu_details);
                                                if($num_combo_menu_details){$i=0;$p=0;$q=0;$menu_label='';
                                                    while ($result_menu_details = $database->mysqlFetchArray($sql_combo_menu_details)) {
                                                        $i++;
                                                    if($result_menu_details['cpm_menu_sale_type']!='Option'){
                                                    $p++;
                                                   if($p==1){
                                                    ?>
                                                       <div class="accordion-header" id="header_mustselect">Must Select Items <span class="arrow active"></span></div>
                                                        
                                                      <?php
                                                       }
                                                    ?>    
                                                   <div class="accordion-body header_mustselect active">
                                                        <div class="qty_combo_item_select fixed_combo_menus">
                                                            <label class="combo_checkbox fixed_menu" id="fixed_menu_<?=$result_menu_details['cpm_menu_id']?>"><?=$result_menu_details['mr_menuname']?>
                                                              <input type="checkbox" class="menu_selection_check" id="menu_selection_check_<?=$p?>" value1="<?=$result_menu_details['cpm_menu_id']?>" >
                                                              <span class="checkmark checkmark_fixed_menu"></span>
                                                            </label>
                                                            <div class="combo_selection_mn_qty">
                                                                
                                                                <span class="combo_mnlist_select_qty_lpls_btn qty_minus_btn" id="qty_minus_btn" count="<?=$p?>" style="display:none">-</span>
                                                                <input type="text" class="combo_mnlist_select_qty menu_qty_display" placeholder="Qty" id="menu_qty_display_<?=$p?>" value1="<?=$result_menu_details['cpm_menu_id']?>" value="<?=$result_menu_details['cpm_menu_qty']?>">
                                                                <span style="float:right;display:none" class="combo_mnlist_select_qty_lpls_btn qty_plus_btn" id="qty_plus_btn" count="<?=$p?>" >+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                      
                                                <?php      
                                                }
                                                if($result_menu_details['cpm_menu_sale_type']=='Option') {
                                                   if($menu_label!=$result_menu_details['cpm_menu_type_label_id']) {
                                                      
                                                    $menu_label=$result_menu_details['cpm_menu_type_label_id'];
                                                  
                                                    ?>
                                               
                                                    <div class="accordion-header option_header" id="header_<?=$menu_label?>"><?=$result_menu_details['cml_label']?><span class="arrow"></span></div>
                                                   <?php }?>
                                                    <div class="accordion-body header_<?=$menu_label?>">
                                                      <div class="qty_combo_item_select option_combo_menus">
                                                            <label class="combo_checkbox option_menu"><?=$result_menu_details['mr_menuname']?>
                                                              <input type="checkbox" class="option_checkboxes option_<?=$result_menu_details['cml_label']?>" label_name="<?=$result_menu_details['cml_label']?>" value1="<?=$result_menu_details['cpm_menu_id']?>" >
                                                              <span class="checkmark"></span>
                                                            </label>
                                                            <div class="combo_selection_mn_qty">
                                                                
                                                                <span class="combo_mnlist_select_qty_lpls_btn qty_minus_btn" id="qty_minus_btn" count="<?=$p?>" style="display:none">-</span>
                                                                <input type="text" class="combo_mnlist_select_qty option_menu_qty_display" placeholder="Qty" id="option_menu_qty_display_<?=$p?>" value1="<?=$result_menu_details['cpm_menu_id']?>" value="<?=$result_menu_details['cpm_menu_qty']?>">
                                                                <span style="float:right;display:none" class="combo_mnlist_select_qty_lpls_btn qty_plus_btn" id="qty_plus_btn" count="<?=$p?>" >+</span>
                                                            </div>
                                                    </div>
                                                    </div>
                                                        
                                                 
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>   
                                            
                                    </section>
                                                                        
                                        
                                  </div>
                                    
                                    
                                </div>
                            
                            
                        </div>
                        
                         
                            
                        
                        <div class="combo_popup_sub_btn_cc">
                            
                            <div class="pop_prference_cc new_pop_prference_cc">
                                <textarea class="menu_preference_manual" id="manual_preference" placeholder="Manual Pref"></textarea>
                            </div>
                             <select id="combo_preference" multiple="multiple" class="menu_preference_combo">
                                   
                            <?php
                                    $sql_combo_preference =  $database->mysqlQuery("select mp.mpr_prefeernce,pm.pmr_name,pm.pmr_id FROM tbl_menuprefmaster mp
                                                                            left join tbl_preferencemaster pm on pm.pmr_id=mp.mpr_prefeernce
                                                                            left join tbl_combo_pack_menus cpm on cpm.cpm_menu_id=mp.mpr_menuid
                                                                            where  cpm.cpm_combo_pack_id='".$combo_pack_id."' group by pm.pmr_id ");
                                    $num_combo_preference = $database->mysqlNumRows($sql_combo_preference);
                                    if($num_combo_preference){$i=0;$p=0;$q=0;$menu_label='';
                                        while ($result_menu_preference = $database->mysqlFetchArray($sql_combo_preference)) {
                                    ?>
                                   <option id="select" value="<?=$result_menu_preference['pmr_name']?>"><?=$result_menu_preference['pmr_name']?></option>
                                    <?php
                                        }
                                    }
                                    ?>    
                                   </select>               
                                <a class="pref_right_btn submit_all" id="combo_add_btn" style="cursor:pointer;margin-top: 4px !important;">ADD</a>
                            </div>
                        
                    </div><!--combo-popup-->
                    <style>.combo_popup_sub_btn_cc .multiselect {margin-top: 2px !important;height: 36px !important;   width: 201px !important;}</style>
                    <!--<div class="combo-popup-right-select">
                        <div class="combo-popup-head"><span>Select Option</span></div>

                    </div>-->
<?php
      
        }
    }
    
?>