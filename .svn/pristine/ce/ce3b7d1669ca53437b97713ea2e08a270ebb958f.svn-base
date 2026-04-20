<?php
include('includes/session.php');  // Check session
include("database.class.php"); // DB Connection class
$database = new Database();
include("api_multiplelanguage_link.php");
$a=  trim(json_encode($_SESSION['main_language']),'""');
?>

 <input type="hidden" id="otp_item_cancel" value="<?=$_SESSION['otp_item_cancel']?>">
 
 <input type="hidden" id="otp_login" value="<?=$_SESSION['expodine_id']?>">
 
 <input type="hidden" id="otp_bill" value="<?=$_SESSION['order_id']?>">


                	<div class="kot_cancel_popup_cc_head">KOT Cancel
                    </div>
                             <form method="Post" name="kotsubmit">
                	<div class="kot_cancel_popup_contant_cc">
                    	<table width="100%" border="0">
                        	<thead>
                                  <tr>
                                    <th width="30%" scope="col">Item Name</th>
                                    <th width="15%" scope="col">Unit</th>
                                    <th width="20%" scope="col">Qty</th>
                                    <th width="30%" scope="col">Reason</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $combo_entry_count=array();
                                  $allslno= '';
                                  $totval = '';
                                  $qty =0;
                                  $allqty=0;
                                  $addonallslno=array();
                                  $addonallmenus=array();
                                  $addon_kotno=array();
                                  $combo_qty=0;
                                
                                $sql_combo_list  =  $database->mysqlQuery("select distinct(cod.cod_count_combo_ordering) as cod_count_combo_ordering, cod.cod_combo_pack_rate, cod.cod_combo_total_rate,cod.cod_combo_qty,cod.cod_kot_no,cn.cn_name,cn.cn_stock_check, cp.cp_pack_name FROM tbl_combo_ordering_details cod 
                                                                        left join tbl_combo_name cn on cn.cn_id=cod.cod_combo_id
                                                                        left join tbl_combo_packs cp on cp.cp_id=cod.cod_combo_pack_id where cod.cod_orderno='".$_SESSION['order_id']."' and cod.cod_order_status!='Added' order by cod_count_combo_ordering asc "); 
				$num_combo_list  = $database->mysqlNumRows($sql_combo_list);
				if($num_combo_list){$slno='';
                                    while($result_combo_list  = $database->mysqlFetchArray($sql_combo_list)) 
                                    {     $combo_menu_array=array();
                                        if(!in_array($result_combo_list['cod_count_combo_ordering'],$combo_entry_count)){
                                            $combo_entry_count[]=$result_combo_list['cod_count_combo_ordering'];
                                            //$total=$total+$result_combo_list['cod_combo_total_rate'];
                                              $combo_qty=$combo_qty+$result_combo_list['cod_combo_qty'];                 
                                            $sql_combomenu_list  =  $database->mysqlQuery("select mm.mr_menuname  FROM tbl_combo_ordering_details cod
                                                               left join tbl_menumaster mm on mm.mr_menuid=cod.cod_menu_id
                                                               where cod.cod_count_combo_ordering='".$result_combo_list['cod_count_combo_ordering']."'");
                                                               $num_combomenu_list  = $database->mysqlNumRows($sql_combomenu_list);
                                                                if($num_combomenu_list){$slno='';
                                                                    while($result_combomenu_list  = $database->mysqlFetchArray($sql_combomenu_list)) 
                                                                        {
                                                                        $combo_menu_array[]=$result_combomenu_list['mr_menuname'];
                                                                        }
                                                                }
                                        ?>
                                        <tr class="tr_clone">
                                         <td><?=$result_combo_list['cn_name'].' '.$result_combo_list['cp_pack_name']?>
                                         <span class="combo_tbl_lst"><?=implode(',',array_unique($combo_menu_array));?></span>
                                         </td>
                                         <td>Combo</td>

                                         <td>
                                             <input type="hidden" id="kot_no"  value="<?=$result_combo_list['cod_count_combo_ordering']?>" >
                                             <div class="kot_cancel_value_btn" onclick="chg_comb_item_cnt_dcr('<?= $result_combo_list["cod_combo_qty"] ?>','<?= $result_combo_list["cod_count_combo_ordering"] ?>')">-</div>
                                             <input class="kot_cancel_qty_input tr_clone_add cnclqty combo_name" name="" value="<?= $result_combo_list['cod_combo_qty'] ?>" type="text" id="txt_combo_<?=$result_combo_list['cod_count_combo_ordering']?>" stock_check="<?=$result_combo_list['cn_stock_check']?>" readonly/>
                                             <div class="kot_cancel_value_btn" onclick="chg_combo_item_cnt_inc('<?= $result_combo_list["cod_combo_qty"] ?>','<?= $result_combo_list["cod_count_combo_ordering"] ?>')">+</div>
                                         </td>
                                         <td><!--<input class="kot_cancel_reason_input" id="reasontxt" name="" placeholder="Reason" type="text" value=" //$result_menus['ter_cancelledreason']?>"/>-->
                                             <select class="kot_cancel_reason_input mainmenu" id="reasontxt_<?=$result_combo_list['cod_count_combo_ordering']?>" name="reasontxt">
                                                
                                                <?php 
                                                $sql_rsn = "select cr_id, cr_reason FROM tbl_cancellation_reasons where cr_active = 'Y' ";
                                                $sql_rsns = $database->mysqlQuery($sql_rsn);
                                                $num_rsns = $database->mysqlNumRows($sql_rsns);
                                                if ($num_rsns) {
                                                    while ($result_rsns = $database->mysqlFetchArray($sql_rsns)) {
                                                        ?>
                                                 
                                                         <option value="<?= $result_rsns['cr_id']?>"><?= $result_rsns['cr_reason']?></option>
                                                   
                                                          <?php  }}?>
                                             </select>
                                         </td>
                                       </tr>
                                        <?php
                                            }
                                        }
                                    }
                                  
                                  
                                  
                                  
                                  
                                  
                                  
                                    $sql_menulist = "select tor.ter_addon_slno,um.u_name,bum.bu_name,tor.ter_unit_type,tor.ter_unit_weight,tor.ter_rate_type,tor.ter_orderno,tor.ter_portion,tor.ter_slno,tor.ter_menuid,tor.ter_kotno, mm.mr_menuname,mm.mr_menuid,tor.ter_qty, pm.pm_portionname,pm.pm_id, tor.ter_cancelledreason
                                    from tbl_tableorder tor
                                    left join tbl_menumaster mm on mm.mr_menuid = tor.ter_menuid
                                    left join tbl_portionmaster pm on tor.ter_portion = pm.pm_id left join tbl_unit_master um on um.u_id=tor.ter_unit_id left join tbl_base_unit_master bum on bum.bu_id=tor.ter_base_unit_id
                                    where tor.ter_orderno='" . $_SESSION['order_id'] . "'  and (tor.ter_status='Served' OR tor.ter_status='Opened' OR tor.ter_status='Ready') and ter_count_combo_ordering IS NULL order by tor.ter_slno asc ";
                                    $sql_menus = $database->mysqlQuery($sql_menulist);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) { 
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                                $kot_no_order='';
                                                $ordered_menu=$result_menus['mr_menuname'];
                                                $ordered_portion=$result_menus['pm_portionname'];
                                                if($result_menus['ter_rate_type']=='Portion'){
                                                $ordered_portion='Portion  :'.' '.$result_menus['pm_portionname'];
                                                }
                                                else if($result_menus['ter_rate_type']=='Unit'){
                                                    if($result_menus['ter_unit_type']=='Packet'){
                                                        $ordered_portion=$result_menus['ter_unit_type'].' : '.number_format($result_menus['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_menus['u_name'];
                                                }
                                                    else if($result_menus['ter_unit_type']=='Loose'){
                                                        $ordered_portion=$result_menus['ter_unit_type'].' : '.number_format($result_menus['ter_unit_weight'],$_SESSION['be_decimal']).' '.$result_menus['bu_name'];
                                                }
                                               
                                                }
                                                
                                                
                                                $kot_no_order=$result_menus['ter_kotno'];
                                                if($_SESSION['main_language']!='english'){
                
                                                $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

                                                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                                $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                $ordered_menu=$result_arabmenu['lm_menu_name'];
                                                // $catid['name'][] = $catname;
                                                //echo $catname;
                                               
                
                                                $sql_arabportion=$database->mysqlQuery("SELECT lm_portion_name FROM tbl_language_portion left join tbl_languages on ls_id=lm_language_id WHERE lm_portion_id='".$result_menus['pm_id']."' and ls_language='".$_SESSION['main_language']."'");

                                                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                                $num_arabportion = $database->mysqlNumRows($sql_arabportion);
                                                $result_arabportion = $database->mysqlFetchArray($sql_arabportion);
                                                $ordered_portion=$result_arabportion['lm_portion_name'];
                                                // $catid['name'][] = $catname;
                                                //echo $catname;
                
                                                }
                                            
                                            
                                         $slno =   $result_menus['ter_slno'];
                                         $qty =$result_menus['ter_qty'];
                                                                                        ?>
                                        <tr class="tr_clone" slno='<?= $slno ?>'>
                                            <td><span style="color:red"><?php if($result_menus['ter_addon_slno']!=''){ ?> (AD) <?php } ?></span><?= $ordered_menu ?></td>
                                         <td><?= $ordered_portion ?></td>

                                         <td>
                                             <input type="hidden" id="kot_no"  value="<?=$kot_no_order?>" >
                                             <div class="kot_cancel_value_btn" onclick="chg_item_cnt_dcr(<?=$slno?>,'','')">-</div>
                                             <input class="kot_cancel_qty_input tr_clone_add cnclqty" name="" value="<?= $qty ?>" type="text" id="txt_<?=$slno?>" readonly/>
                                             <div class="kot_cancel_value_btn" onclick="chg_item_cnt_inc(<?=$slno?>,'',<?=$qty?>,'')">+</div>
                                         </td>
                                         <td><!--<input class="kot_cancel_reason_input" id="reasontxt" name="" placeholder="Reason" type="text" value=" //$result_menus['ter_cancelledreason']?>"/>-->
                                             <select class="kot_cancel_reason_input mainmenu" id="reasontxt" name="reasontxt">
                                                
                                                <?php 
                                                $sql_rsn = "select cr_id, cr_reason FROM tbl_cancellation_reasons where cr_active = 'Y' ";
                                                $sql_rsns = $database->mysqlQuery($sql_rsn);
                                                $num_rsns = $database->mysqlNumRows($sql_rsns);
                                                if ($num_rsns) {
                                                    while ($result_rsns = $database->mysqlFetchArray($sql_rsns)) {
                                                        ?>
                                                 
                                                         <option value="<?= $result_rsns['cr_id']?>" <?= $result_rsns['cr_id']== $result_menus['ter_cancelledreason']? 'selected':'' ?>><?= $result_rsns['cr_reason']?></option>
                                                   
                                                          <?php  }}?>
                                             </select>
                                         </td>
                                       </tr>
                                       <?php

                                        
                                       
                                       
                                        $allslno .= $slno.',';
                                        $allqty = $allqty + $qty;
                                        //print_r(implode(',',$addonallslno));
                                        }
                                        }
                                        $allqty = $allqty +$combo_qty;
                                        
                                        ?>
                                   
                                      <input type="hidden" id="itemslno" value="<?=$allslno?>"/>
                                      <input type="hidden" id="totqty" value="<?=$allqty?>"/>
                                      <input type="hidden" id="addonitemslno" name="addonitemslno" value="<?=implode(',',$addonallslno)?>"/>
                                       <input type="hidden" id="addonallmenus" name="addonallmenus" value='<?=json_encode($addonallmenus,JSON_FORCE_OBJECT)?>'/>
                                       <input type="hidden"  id="addonkot_no" value="<?=implode(',',$addon_kotno)?>" >
                                      
                                       </tbody>
                            </table>
                            
                    </div>
                	<div class="kot_cancel_popup_botm_btn_cc">
                            <a id="kotcancel" class="kotcancel"><div class="kot_cancel_popup_botm_button kotcancel_btn">Cancel KOT</div></a>
                        <a id="kot_cancel_close" href="#"><div style="background-color:#fff;border:solid 1px #109216;color:#000" class="kot_cancel_popup_botm_button">Close</div></a>
                    </div>
                            </form>
<script type="text/javascript">
    $("#kot_cancel_close").click(function(){
			$(".kot_cancel_popup_cc").css("display","none");
			$(".olddiv").removeClass("new_overlay");
		});
                
                
    $('#go_item_cancel').click(function (event) {
         
           event.stopImmediatePropagation();
    
           var billno=  $('#otp_pop').attr('billno');
    
            var data1234="set=check_otp_item_cancel&billno="+billno;
            $.ajax({
            type: "POST",
            url: "load_index.php",
            data: data1234,
            success: function(data) {
                
             if($('#code_otp').val()==$.trim(data)){
                 
                $('#otp_pop').hide();
                $('#otp_pop').attr('billno',' ');

                $('#code_otp').val('');

                $('#code_otp').focus();
             
                         $('.alert_error_popup_all_in_one').show();
                         $('.alert_error_popup_all_in_one').text('ITEM CANCELLED');
                         $('.alert_error_popup_all_in_one').delay(2000).fadeOut('slow');
                         
                         
                         
                        $(".kotcancel_confirm").css("display","none");
			$(".olddiv").removeClass("new_overlay");
                        var itemslno = $('#itemslno').val();
                        var orderitem = $('.cnclqty');
                        var itemqty = '';
                        var combo_name=new Array();
                        var combo_qty='';
                        var quantity = new Array();
                        orderitem.each(function(){
                            if(!$(this).hasClass('combo_name')){
                                itemqty   =  $(this).val();
                                if(itemqty!='undefined' && itemqty!='' && itemqty!=null){
                                    quantity.push(itemqty);
                                }
                            }
                            else{
                                combo_qty=$(this).attr('id').split('txt_combo_');
                                
                                combo_name.push({
                                    combo_qty:$(this).val(),
                                    combo_count:combo_qty[1],
                                    reason:$('#reasontxt_'+combo_qty[1]).val()
                                });
                            }    
                          
                        });
                        
                        var combo_name_string=JSON.stringify(combo_name);
                        
                        var cnclrsn = $('.mainmenu');
                        var itemcnclrsn = '';
                        var reason = new Array();
                        cnclrsn.each(function(){
                              itemcnclrsn   =  $(this).val();
                              if(itemcnclrsn!='undefined'){
                                  reason.push(itemcnclrsn);
                              }
                        });
                //*********************** ADD On Cancellation values take starts *************************************// 
                        var addonitemslno=$('#addonitemslno').val();
                        var addonorderitem = $('.addoncnclqty');
                        var addonitemqty = '';
                        var addonquantity = new Array();
                        addonorderitem.each(function(){
                              addonitemqty   =  $(this).val();
                              if(addonitemqty!='undefined' && addonitemqty!='' && addonitemqty!=null){
                                  addonquantity.push(addonitemqty);
                              }
                        });
                        var addonmenuid = $('#addonallmenus').val();
                        var addoncnclrsn = $('.addoncancelreason');
                        var addonitemcnclrsn = '';
                        var addonreason = new Array();
                        addoncnclrsn.each(function(){
                              addonitemcnclrsn   =  $(this).val();
                              if(addonitemcnclrsn!='undefined'){
                                  addonreason.push(addonitemcnclrsn);
                              }
                        });
                        var addoncnclkotno = $('#addonkot_no').val();
                        
                //*********************** ADD On Cancellation values take Ends *************************************//      
                        
                        
                      var dataString = 'set=cancelitemqty&itemslno='+itemslno+'&itemqty='+quantity+'&reason='+reason+'&addonitemslno='+addonitemslno+
                      '&addonitemqty='+addonquantity+'&addonmenus='+addonmenuid+'&addonreason='+addonreason+"&addonkotno="+addoncnclkotno+
                      "&combo_name="+combo_name_string;
                      
                             $.ajax({
                             type: "POST",
                             url: "load_bill_history.php",
                             data: dataString,
                             success: function(data) {
                                 
                                
                             $('.ordelist_table').load('viewitems.php');
                                 
                             var kotidcanceled=$.trim(data);
                                                     
                             var kt=kotidcanceled.split("<br />");
                                                           
                             var kotnew=$.trim(kt);
                                                           
                             location.reload();
                                  
                      }
                      });
                      
                    }else{
                        
                     alert('INVALID OTP');
                     
                       $('#code_otp').val('');
       
                        $('#code_otp').focus();   
                        
                 }
                         
                         
                         
         }
        
        
        });
        
  });
                
                
                
                
                
                $(".kotcancel_btn").click(function(){
                    
                       var qty = $('.cnclqty');
                       var addonqtyfeild = $('.addoncnclqty');
                        var totqty = 0;
                        var addonqty = 0;
                        qty.each(function(){
                              totqty += Number($(this).val());
                        });
                        addonqtyfeild.each(function(){
                              addonqty += Number($(this).val());
                        });
                        totqty+=addonqty;
                        
                        var totqty2 = $('#totqty').val();
//                        alert(totqty);
//                        alert(totqty2);
                        
                        if(totqty==totqty2){
                            //alert("Quantity not changed!");
                            
                        $('.alert_error_popup_all_in_one').show();
                        $('.alert_error_popup_all_in_one').text('Quantity Not Changed');
                        $('.alert_error_popup_all_in_one').delay(1000).fadeOut('slow');
                        
                        }else{
                            
                            
                            if($('#otp_item_cancel').val()=='Y'){ 
                                 
                                 $('#otp_pop').show();
                               
                            $('#code_otp').val('');
                               
                            $('#code_otp').focus();
                               
                            var billno = $('#otp_bill').val();
                           var staff= $('#otp_login').val();
                           
                            $('#otp_pop').attr('billno',billno);
                            
                          $.post("load_index.php", {billno:billno,staff:staff,set:'otp_item_cancel'},
			  function(data)
			  {
                           
                          });
                               
                                 
                                 
                            }else{
                            
                            $(".kot_cancel_popup_cc").css("display","none");
                            $(".olddiv").removeClass("new_overlay");
                            
                            $(".cancelekot_confirm").click();
                            
                            }
                            
                            
                    }
		});
    </script>


