<script src="js/takeaway_popup.js"></script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    
    
               

    
    $('.pref_key_entry').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9, /\b]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});
    
    
   $('.add_popup_active_btn').find('.counter_portion_view_btn').focus();
   $('.counter_portion_view_btn:first').focus();
	/*************************************** Multi select Dropdown select starts *************************************************  */
	$('#insightList').multiselect({
		onChange: function(event) {
			//alert($('#example-onDropdownHidden').val());
			$('#ta_portionhid').val('');
                        if($('#insightList').val()){
			$('#ta_portionhid').val($('#insightList').val());
			$('.prefrtext').val($('#insightList').val()+",");
                    }else{
                        $('.prefrtext').val('');
                    }
			
		}
		
	});
	/*************************************** Multi select Dropdown select  ends *************************************************  */
     });
           document.onkeydown= function(ev){
               
             ev.stopImmediatePropagation();
           
                 if($('#ta_loadbottomcontent-1').css('display') == 'block'){
                     
                    var keyCode = ev.keyCode || ev.which;   
                   if (keyCode == 13) { 
                       
                     
                      if($('.enter-qty-act').val()>0){
                         
                            $('.tasale_addnew').click();
                            $('.enter-qty-act').val('0');
                            $('#ta_loadbottomcontent-1').css('display','none');
                            exit;
                            return false;
                    } 

                   }
    }
}
     
     
     
   $( ".focussed" ).keyup(function(e) {
 
     if($('.counter_portion_view_btn').hasClass("focussed")){
      var u=   $(this).html();
        
       
      if(u.length>3){
          
     var u1=u.substr(0,3);
     $(".focussed").text(u1); 
     $("#calc_value").text(u1); 
     $(".focussed").blur(); 
     $(".loaderrpop").css("display","block"); 
     $(".loaderrpop").addClass("popup_validate");
     $(".loaderrpop").text("Check Quantity ");
     $('.loaderrpop').delay(2000).fadeOut('slow');
            
     }else{
           $("#calc_value").text(u);  
         }
       } 
  });
  
  
  
  $( "#manlrate123" ).keyup(function(e) {
      if(e.which == 13){
           if($('.enter-qty-act').val()>0){
           $('.tasale_addnew').click();
           $('.enter-qty-act').val('0');
          exit;
          return false;
             } 
        }
   });
  
     


 function dynamic(evt,id){
   
                   try{
        var charCode = (evt.which) ? evt.which : event.keyCode;
  
        if(charCode==46){
            var txt=document.getElementById(id).value;
            if(!(txt.indexOf(".") > -1)){
	
                return true;
            }
        }
        if (charCode > 31 && (charCode < 48 || charCode > 57) )
            return false;

        return true;
	}catch(w){
		
	}
    }




</script>
<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
//$value		= $_REQUEST['value'];
//session_start();
include("api_multiplelanguage_link.php");
$menu_portion='';
$string='';
$menu_qty=0;
$type_action='add';
$pref_text='';
$slno_edit='';
$manualrateentry='';
$ordered_menu_rate='';
$menu_unit_id='';
$menu_base_unit_id='';
$menu_base_unit_weight=0;
$menu_total_rate='';
$addon_yes_no='';
$addon_menu_details=array();

if(isset($_REQUEST['actqty'])){
 $stkqty=$_REQUEST['actqty'];
}  else {
$stkqty="";    
}

if(isset($_REQUEST['barcode'])){
$bar=trim(json_encode($_REQUEST['barcode']),'""');
}else{
    $bar='';
}

$srl="";
$other_lang=  trim(json_encode($_SESSION['main_language']),'""');
$opendate=  trim(json_encode($_SESSION['date']),'""');
$listimage=  trim(json_encode($_SESSION['s_listimage']),'""');
//echo $listimage ;
$floorid=  "";

$ordermenu_id=trim(json_encode($_REQUEST['menu']),'""');
$_SESSION['autoloadmenu']=$_REQUEST['menu'];

$_SESSION['autoloadmenu_food']=$_REQUEST['food'];

if(isset($_REQUEST['serialno'])){
$srl=$_REQUEST['serialno'];
}


if($_REQUEST['typesub']=='Edit'){  
    $slno_edit= $srl;
    $type_action=$_REQUEST['typesub'];
$sql_edit  =  $database->mysqlQuery("select tab_unit_id,tab_base_unit_id,tab_unit_weight, tab_preferencetext,mm.mr_manualrateentry,mm.mr_menuname,td.tab_menuid, td.tab_portion,td.tab_rate,td.tab_qty FROM tbl_takeaway_billdetails td left join tbl_menumaster mm on mm.mr_menuid = td.tab_menuid   where tab_billno = '".$_SESSION['ta_order_id']."' and   td.tab_slno='".$slno_edit."' and td.tab_menuid='".$_SESSION['autoloadmenu']."' and tab_bill_addon_slno IS NULL"); 
     //echo " select tab_unit_id,tab_base_unit_id,tab_unit_weight, tab_preferencetext,mm.mr_manualrateentry,mm.mr_menuname,td.tab_menuid, td.tab_portion,td.tab_rate,td.tab_qty FROM tbl_takeaway_billdetails td left join tbl_menumaster mm on mm.mr_menuid = td.tab_menuid   where tab_billno = '".$_SESSION['ta_order_id']."'  td.tab_slno='".$slno_edit."' and td.tab_menuid='".$_SESSION['autoloadmenu']."' ";
     $num_edit  = $database->mysqlNumRows($sql_edit);
	if($num_edit)
            {
            while($result_edit  = $database->mysqlFetchArray($sql_edit)) 
		{
                    $menu_name  =$result_edit['mr_menuname'];
                   if($_SESSION['main_language']!='english'){
                       $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_edit['tab_menuid']."' and ls_language='".$_SESSION['main_language']."'");
                        //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                        $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                        $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                        $menu_name=$result_arabmenu['lm_menu_name'];
                                        // $catid['name'][] = $catname;
                                        //echo $catname;
                        }
                   $manualrateentry=$result_edit['mr_manualrateentry'];
                   $ordered_menu_rate  =$result_edit['tab_rate'];
                   $menu_portion  =$result_edit['tab_portion'];
                   $menu_qty=$result_edit['tab_qty'];
                   $menu_id=$result_edit['tab_menuid'];
                   //$portion_name=$result_edit['pm_portionname'];
                   $final1=$ordered_menu_rate*$menu_qty;
                   //$branch_id=$result_edit['tab_branchid'];
                   $menu_unit_id=$result_edit['tab_unit_id'];
                   $menu_base_unit_id=$result_edit['tab_base_unit_id'];
                   $menu_base_unit_weight=$result_edit['tab_unit_weight'];
                   //$menu_total_rate=$result_edit['tab_total_rate'];
                   //echo $branch_id;
                   $pref_text=$result_edit['tab_preferencetext'];
                   if($menu_portion!=''){
                   $string.=" and mta_portion='".$menu_portion."'";
                   }
                   else if($menu_unit_id!=''){
                   $string.=" and mta_unit_id='".$menu_unit_id."' and mta_unit_weight='".$menu_base_unit_weight."' ";
                   }
                   else if($menu_base_unit_id!=''){
                   $string.=" and mta_base_unit_id='".$menu_base_unit_id."'";
                   }
                   else{
                       $string.='';
                   }
                }
                
            //ORDERD ADDON MENUS SELECTION AND STORE INTO ARRAY 
            //MAIN MENU  'tab_slno'  and 'tab_bill_addon_slno'  IS THE SELECTION CONDITION   
            $sql_addon_edit  =  $database->mysqlQuery("select tbd.tab_slno,tbd.tab_menuid,tbd.tab_portion,tbd.tab_amount,tbd.tab_qty,tbd.tab_rate_type from tbl_takeaway_billdetails tbd where tbd.tab_billno ='". $_SESSION['ta_order_id']."'  and tab_bill_addon_slno='".$slno_edit."' ");
            $num_addon_edit  = $database->mysqlNumRows($sql_addon_edit);
            if($num_addon_edit){
                while($result_addon_edit  = $database->mysqlFetchArray($sql_addon_edit)){
                    $addon_menu_details['menu_edit_id'][]=$result_addon_edit['tab_menuid'];
                    $addon_menu_details['menu_edit_slno'][]=$result_addon_edit['tab_slno'];
                    $addon_menu_details['menu_edit_qty'][]=$result_addon_edit['tab_qty'];
                    $addon_menu_details['menu_edit_rate'][]=$result_addon_edit['tab_amount'];
                }
            }    
                
            
            }
     }
?>

<input type="hidden" name="serialno" id="serialno"  value="<?=$srl?>"/>
<input type="hidden" name="typesub" id="typesub"  value="<?=$_REQUEST['typesub'] ?>"/>
<input type="hidden" name="ta_portionhid" id="ta_portionhid"  />
<input type="hidden" name="be_search_focus" id="be_search_focus" value="<?=$_SESSION['be_search_focus']?>" />
<?php

//$fp_takeaway_menu=fopen($apilink."/src/takeaway_api.php?set=takeaway_menuname&menuid=$ordermenu_id&subid=&maincat=&mainlang=$other_lang&dateopen=&listimage=&floorid=","r");
//$response_takeaway_menu['messages'] = stream_get_contents($fp_takeaway_menu);
////var_dump($response_takeaway_menu['messages']);
//$resu_takeaway_menu= json_decode($response_takeaway_menu['messages'],true);
//$takeaway_menu_count=count($resu_takeaway_menu['menuid']);
////var_dump($takeaway_menu_count);
//
//if($takeaway_menu_count!=0){

                                    $sql_menulist = ("select * from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid   WHERE mc.mmy_active='Y'  and mr.mr_active='Y'  and mr.mr_menuid ='".$_SESSION['autoloadmenu']."' order by mr_subcatid ");
                                     //echo  "select * from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid   WHERE mc.mmy_active='Y'  and mr.mr_active='Y'  and mr.mr_menuid ='".$_SESSION['autoloadmenu']."' order by mr_subcatid  ";
                                    $sql_menus = $database->mysqlQuery($sql_menulist);
                                    $num_menus = $database->mysqlNumRows($sql_menus);
                                    if ($num_menus) { $portion_or_unit='';$packet_or_loose='';
                                        while ($result_menus = $database->mysqlFetchArray($sql_menus)) {
                                            
                                           $menu_nameta = $result_menus['mr_menuname'];
                                            $menu_idta = $result_menus['mr_menuid'];
                                            $addon_yes_no=$result_menus['mr_add_on'];
                                            $ordered_menuid=$result_menus['mr_menuid'];
                                            $portion_or_unit=$result_menus['mr_rate_type'];
                                            //echo $portion_or_unit;
                                            if($portion_or_unit=='Unit')
                                                {   
                                                    $sql_unit= "select mta_rate_type,mta_unit_type from tbl_menuratetakeaway WHERE mta_rate_type='Unit' and mta_menuid='".$ordered_menuid."'  ";
                                                    //echo "select mta_rate_type,mta_unit_type from tbl_menuratetakeaway WHERE mta_rate_type='Unit' and mta_menuid='".$ordered_menuid."' ";
                                                    $sql_unit1  =  $database->mysqlQuery($sql_unit); 
                                                    $num_unit  = $database->mysqlNumRows($sql_unit1);
                                                    if($num_unit){
                                                        while($result_unit  = $database->mysqlFetchArray($sql_unit1)) 
                                                        {
                                                            $packet_or_loose=$result_unit['mta_unit_type'];
                                                        }
                                                    }
                                                }
                                          
                                            //$menu_stock = $result_menus['mk_stock'];
                                          
                                            if($_SESSION['main_language']!='english'){

                                            $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

                                            //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                            $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                            $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                            $menu_nameta=$result_arabmenu['lm_menu_name'];
                                            // $catid['name'][] = $catname;
                                            //echo $catname;
                                            }
                                             //$takeaway_catid['menu_name'][]= $menu_name;      

                                        $portion_id=array();
                                        $base_unit_id=array();
                                        $unit_id=array();
                                        $menu_rate=array();
                                        $menu_default_portion=array();
                                        $menu_default_loose=array();
                                        $menu_default_packet=array();
                                        $menu_unit_weight=array();       
                                        $menu_rate_dyn=array();     
                                $menunamelength=  strlen($menu_nameta);
                                if($menunamelength>28){
                               $menunamenew= substr($menu_nameta, 0,30)."...";
                                }else{
                                    $menunamenew=$menu_nameta;
                                }
                              
                              
		
			?>
            <input  type="hidden" id="decimal" value="<?=$_SESSION['be_decimal']?>">
            <input type="hidden" name="idofmenu" id="idofmenu"  value="<?=$menu_idta ?>"/>
            <input type="hidden" name="portion-or-unit" id="portion-or-unit"  value="<?=$portion_or_unit ?>"/>
            <input type="hidden" name="packet-or-loose" id="packet-or-loose"  value="<?=$packet_or_loose ?>"/>
            <input type="hidden" name="menuqty" id="menuqty"  value="<?=$menu_qty ?>"/>
            <input type="hidden" name="type_action" id="type_action"  value="<?=$type_action ?>"/>
          
        <div class="md-content" style="width:40%;left:30%;top:15%;z-index:99999;background-color: #000">
            <div class="take_away_popup_head"><?=$menunamenew//$result_menus['mr_menuname']?> 
             <a class="td-close">
                 <div class="counter_menu_popup_head_close close_btn_takeaway_pop" style="top:0px"><img src="img/cancel_bill.png"></div></a>
            </div>
            <span style="width:100%;text-align: center;    height: 20px;line-height: 15px;float: left;margin-top: -10px;position: relative">
             <div class="loaderrpop" style="display:none;color: #F00;width:100%;text-align: center;height: 20px;line-height: 20px;float: left"></div>
            </span>
               
                <div class="take_away_popup_contant">
                <div class="take_away_popup_left_portion_cc" style="position: relative;">
                    <div class="popup_potion_cc">
                            <?php
                            
                          $barcode_in='';  
                          if($bar!=''){
                          $barcode_in=" and mta_barcode='".$bar."' ";
                          }
                            
                            
                            $menuid=$menu_idta ;
                            $_SESSION['menu_id']=$menu_idta ;
                            
                            
                          //  echo "select * from tbl_menuratetakeaway  left join tbl_portionmaster on mta_portion=pm_id  where  mta_menuid='".$menuid."' $barcode_in and mta_food_partner='".$_SESSION['autoloadmenu_food']."' and  mta_rate_type='".$portion_or_unit."'   $string order by display_order asc ";
                            $sql_menuportion="select * from tbl_menuratetakeaway  left join tbl_portionmaster on mta_portion=pm_id  where  mta_menuid='".$menuid."' $barcode_in and mta_food_partner='".$_SESSION['autoloadmenu_food']."' and  mta_rate_type='".$portion_or_unit."'   $string order by display_order asc ";
                            //echo "select * from tbl_menuratetakeaway where  mta_menuid='".$menuid."' and   mta_rate_type='".$portion_or_unit."'   $string ";
                            $sql_portions  =  $database->mysqlQuery($sql_menuportion);
                            
                            $num_portions  = $database->mysqlNumRows($sql_portions);
                            if($num_portions){ 
                                $ids=""; $menu_default_portion='';$menu_default_loose='';$menu_default_packet='';
                            while($result_portions  = $database->mysqlFetchArray($sql_portions)) 
                            {   $rate=0;
                                if($result_portions['mta_rate_type']=='Portion'){
                                    
                                    $portion_id[]=$result_portions['mta_portion'];
                                    $menu_rate[]=$result_portions['mta_rate'];
                                    //$menu_default_portion[]=$result_portions['mta_default'];
                                }
                                else if($result_portions['mta_rate_type']=='Unit'){
                                    
                                    if($result_portions['mta_unit_type']=='Loose'){
                                        $base_unit_id[]=$result_portions['mta_base_unit_id'];
                                        $menu_rate[]=$result_portions['mta_rate'];
                                        //$menu_default_loose=$result_portions['mta_default'];
                                    }
                                   else if($result_portions['mta_unit_type']=='Packet'){
                                        $unit_id[]=$result_portions['mta_unit_id'];
                                        $menu_rate[]=$result_portions['mta_rate'];
                                        $menu_unit_weight[]=$result_portions['mta_unit_weight'];
                                        //$menu_default_packet=$result_portions['mta_default'];
                                    } 
                                }
                                
                                 if($_SESSION['incl_bill_format']=='Y'){
                                    
                                     $menu_rate_dyn[]=$result_portions['mta_menu_final_amount'];
                                }
                                
                                
                            //if(($portion==$result_portions['mmr_portion'])){  class="position_mn_cc_focus"<?php //} 
                            //$rate_details=$database->show_portion_ful_details($result_portions['mmr_portion']);
                            //load_portionrate
                            //$ordered_portionid=trim(json_encode($result_portions['mmr_portion']));
                                                                    
                             }} 
                             
                            ?>
                                
                                
                                <div class="counter_pop_left_cc portion-div" style="display: none">
  
                                <div class="counter_pop_left_head">Portion:<span id="load_portionrate"></span></div>
                                                                        
                                <div class="counter_pop_left_portion">
                                 <?php
                                
                               
                                 for($p=0;$p<count($portion_id);$p++){
                                    
                                    $sql_menulistportion = "select tmn.mk_stock_number,pm.pm_id,pm.pm_portionname,pm.pm_portionshortcode from tbl_portionmaster pm  left join tbl_menustock tmn on tmn.mk_portion=pm.pm_id where pm.pm_id='".$portion_id[$p]."' and tmn.mk_menuid='$menuid'"; 
                                   //echo "select tmn.mk_stock_number,pm.pm_id,pm.pm_portionname,pm.pm_portionshortcode from tbl_portionmaster pm  left join tbl_menustock tmn on tmn.mk_portion=pm.pm_id where pm.pm_id='".$portion_id[$p]."' and tmn.mk_menuid='$menuid'";
                                    $sql_menulistportion = $database->mysqlQuery($sql_menulistportion);
                                   $num_menulistportion = $database->mysqlNumRows($sql_menulistportion);
                            if ($num_menulistportion) {
                            while ($result_menulistportion = $database->mysqlFetchArray($sql_menulistportion)) {
                                $portion_name = $result_menulistportion['pm_portionname'];
                                $portion_id_new = $result_menulistportion['pm_id'];
                                $portion_shortcode= $result_menulistportion['pm_portionshortcode'];
                                $stk=$result_menulistportion['mk_stock_number'];
                                
                                if($_SESSION['main_language']!='english'){
                                    $sql_arabportion=$database->mysqlQuery("SELECT lm_portion_name FROM tbl_language_portion left join tbl_languages on ls_id=lm_language_id WHERE lm_portion_id='".$result_menulistportion['pm_id']."' and ls_language='".$_SESSION['main_language']."'");
                                    //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                    $num_arabportion = $database->mysqlNumRows($sql_arabportion);
                                    $result_arabportion = $database->mysqlFetchArray($sql_arabportion);
                                    $portion_name=$result_arabportion['lm_portion_name'];
                                }
                            
                                
                                ?>
                                <div style="display:block; " title="1" rate="<?=$menu_rate[$p]?>" stock="<?=$stk?>" class="counter_pop_portion  
                                 counter_pop_portion_act " id="stock_number_<?=$portion_id[$p]?>">
                                 <div class="portion-contant-cc  " style="width:27%;">
                                    <span class="portion-top-head">QTY</span>
                                    <input type="text"   style="outline: none;float:left;width:100%" maxlength="3" class="counter_portion_view_btn enter-qty  "  id="portionqty_<?=$portion_id[$p]?>" onchange="ratecalculation('<?=$portion_id[$p]?>')" onkeyup="ratecalculation('<?=$portion_id[$p]?>')"  onclick='return rate_change_portion_wise("<?=number_format($menu_rate[$p],$_SESSION['be_decimal'])?>");' autofocus >                    
                                     
                                </div>
                                 <div class="portion-contant-cc">
                                    <div class="portion-top-head">Portion</div>
                                    <strong class="portionname" id="portionname_<?=$portion_id[$p]?>"><?=$portion_name?></strong>
                                  </div>
                                <div style="width:33%" class="portion_rate_view">
                                    <div class="portion-top-head">Rate</div>
                                    <input type="hidden" id="show_menu_rate_val" value="<?=number_format($menu_rate[$p],$_SESSION['be_decimal'])?>">  
                                    
                                    <input type="hidden" id="show_menu_rate_val_dyn" dyn="<?=$_SESSION['incl_bill_format']?>" value="<?=number_format($menu_rate_dyn[$p],$_SESSION['be_decimal'])?>">
                                    
                                    
                                    
                                    <strong class="portionrate" id="portionrate_<?=$portion_id[$p]?>"><?=number_format($menu_rate[$p],$_SESSION['be_decimal'])?></strong>
                                </div>  
                                </div>
                                <?php
                               }
                              }} 
                                 ?>
             
                                 
                                </div><!--counter_pop_left_cc-->
                                
                            </div><!--counter_pop_left_cc-->
                            
                            
                            
                                <div class="counter_pop_left_cc packet-div" style="display:block">
                                <div class="counter_pop_left_head">PACKET:<span id="load_packetrate"></span></div>
                                <div class="counter_pop_left_portion">
                                    <?php
                                   //echo count($unit_id);
                                    //print_r($unit_id);
                                   for($q=0;$q<count($unit_id);$q++){
                                    
//                                    
                                   //echo "select tmn.mk_stock_number,um.u_id,um.u_name from tbl_unit_master um left join tbl_menustock tmn on tmn.mk_unit_id=um.u_id where um.u_id='".$unit_id[$q]."' and tmn.mk_unit_weight='".$menu_unit_weight[$q]."' and tmn.mk_menuid='$menuid'";
                                    $sql_menulistunit1 = $database->mysqlQuery("select tmn.mk_stock_number,um.u_id,um.u_name from tbl_unit_master um left join tbl_menustock tmn on tmn.mk_unit_id=um.u_id where um.u_id='".$unit_id[$q]."' and tmn.mk_unit_weight='".$menu_unit_weight[$q]."' and tmn.mk_menuid='$menuid'");
                                   $num_menulistunit = $database->mysqlNumRows($sql_menulistunit1);
                            if ($num_menulistunit) { $unit_name='';$stk='';
                            while ($result_menulistunit = $database->mysqlFetchArray($sql_menulistunit1)) {
                                //echo "select tmn.mk_stock_number,um.u_id,um.u_name from tbl_unit_master um left join tbl_menustock tmn on tmn.mk_unit_id=um.u_id where um.u_id='".$unit_id[$q]."' and tmn.mk_menuid='$menuid'";
                                $unit_name = $result_menulistunit['u_name'];
                                $unit_id_new = $result_menulistunit['u_id'];
                                $stk=$result_menulistunit['mk_stock_number'];
                                
                                ?>  

                                
                                <div style="display:block; " title="6" rate="<?=$menu_rate[$q]?>" stock="<?=$stk?>" class="counter_pop_portion counter_pop_portion_act " id="unit_stock_number-<?=$q?>_<?=$unit_id[$q]?>" >
                                    
                                    <div class="portion-contant-cc " style="width:27%;">
                                        <span class="portion-top-head">QTY</span>
                                        <input type="text"  style="outline: none;width:100%;float:left;" class="counter_portion_view_btn enter-qty " onkeyup="return packetadd();" id="unitqty-<?=$q?>_<?=$unit_id[$q]?>" autofocuss></div> 
                                    
                                    
                                    <div class="portion-contant-cc">
                                    <div class="portion-top-head">Weight</div>
                                    <strong class="unitweight" id="unitweight-<?=$q?>_<?=$unit_id[$q]?>"><?=number_format($menu_unit_weight[$q],$_SESSION['be_decimal'])?></strong><span class="unit-kg-text"><strong class="unitname" id="unitname-<?=$q?>_<?=$unit_id[$q]?>"><?=$unit_name?></strong></span> 
                                    </div>
                                    
                                    <div style="width:33%" class="portion_rate_view">
                                    <div class="portion-top-head">Rate</div>
                                    <strong class="unitrate" id="unitrate-<?=$q?>_<?=$unit_id[$q]?>"><?=number_format($menu_rate[$q],$_SESSION['be_decimal'])?></strong></div>
                                    
                                 </div>
                                   <?php }}}?>
                                </div><!--counter_pop_left_cc-->
                                
                            </div><!--counter_pop_left_cc-->
                                     

                                <div class="counter_pop_left_cc loose-div" style="display:none">
                                <div class="counter_pop_left_head">LOOSE:<span id="load_looserate"></span></div>
                    
                                <div class="counter_pop_left_portion">
                                    <?php
                                    for($w=0;$w<count($base_unit_id);$w++){
                                    //echo "select tmn.mk_stock_number,bum.bu_id,bum.bu_name from tbl_base_unit_master bum left join tbl_menustock tmn on tmn.mk_base_unit_id=bum.bu_id where bum.bu_id='".$base_unit_id[$w]."' and tmn.mk_menuid='$menuid'";
                                    $sql_menulistunit1 = $database->mysqlQuery("select tmn.mk_stock_number,bum.bu_id,bum.bu_name from tbl_base_unit_master bum left join tbl_menustock tmn on tmn.mk_base_unit_id=bum.bu_id where bum.bu_id='".$base_unit_id[$w]."' and tmn.mk_menuid='$menuid'");
                                   $num_menulistunit = $database->mysqlNumRows($sql_menulistunit1);
                            if ($num_menulistunit) { $unit_name='';$stk='';
                            while ($result_menulistunit = $database->mysqlFetchArray($sql_menulistunit1)) {
                                //echo "select tmn.mk_stock_number,um.u_id,um.u_name from tbl_unit_master um left join tbl_menustock tmn on tmn.mk_unit_id=um.u_id where um.u_id='".$unit_id[$q]."' and tmn.mk_menuid='$menuid'";
                                $base_unit_name = $result_menulistunit['bu_name'];
                                $base_unit_id_new = $result_menulistunit['bu_id'];
                                $stk=$result_menulistunit['mk_stock_number'];
                                
                                ?>      
                                     
                                <div style="display:block; " rate="<?=$menu_rate[$w]?>" stock="<?=$stk?>" class="counter_pop_portion counter_pop_portion_act " id="baseunit_stock_number_<?=$base_unit_id[$w]?>">
                                 <div class="portion-contant-cc " style="width:27%;">
                                    <span class="portion-top-head">QTY</span>
                                     <input type="text"  contenteditable="true" style="outline: none;float:lef;width:100%" class="counter_portion_view_btn enter-qty " onkeyup="return looseadd();" id="baseunitqty_<?=$base_unit_id[$w]?>" autofocuss>                    
                                   
                                </div>
                                 <div class="portion-contant-cc enter-qty looseweight">
                                    <div class="portion-top-head">Weight</div>
                                    <span contenteditable="true" class="weight-field" onkeyup="return litre_kg_add('<?=$base_unit_id[$w]?>');" id="baseunitweight_<?=$base_unit_id[$w]?>"><?php if($menu_base_unit_weight!=0){ echo number_format($menu_base_unit_weight,$_SESSION['be_decimal']);}?></span><span class="unit-kg-text"><strong class="baseunitname" id="baseunitname_<?=$base_unit_id[$w]?>"><?=$base_unit_name?></strong></span> 
                                  </div>
                                <div style="width:33%" class="portion_rate_view">
                                    <div class="portion-top-head">Rate</div>
                                    <strong class="baseunitrate" rate="<?=$menu_total_rate?>" id="baseunitrate_<?=$base_unit_id[$w]?>"><?php if($menu_total_rate==''){ ?><?=number_format($menu_rate[$w],$_SESSION['be_decimal'])?><?php } else { ?><?=number_format($menu_total_rate,$_SESSION['be_decimal'])?><?php }?></strong></div>  
                                </div>
                                    <?php }}}?>
                                 
                                </div><!--counter_pop_left_cc-->
                                
                            </div><!--counter_pop_left_cc-->
                            </div>
                </div>
                    <!----------------->
<style>
.portion_rate_view{width: 27%;height: 38px;position: absolute;right: 0;top: 1px;text-align: center;font-size: 13px;color: #fff;border-left: 1px solid #000000;box-shadow: -2px 0px 8px #000000;}
.counter_portion_view_btn{position:relative;float:right;text-align: center;border:0; border-bottom: 1px #6f6f6f solid;height:38px;background-color:transparent;padding-top: 10px;}
.portion-top-head{width: 100%;height: 13px;float: left;position: absolute;top: -14px;font-size: 10px;color: rgba(255, 255, 255, 0.47);left:0px;text-align: center;}
.portion-contant-cc{width:40%;height:38px;float:left;position:relative;text-align: center;}
.counter_pop_portion{line-height:45px;padding-left:0;}
.unit-kg-text{font-size:12px;color:rgba(255,255,255,0.8);    padding-top: 2px;}
.counter_pop_portion  {background-color: rgba(255, 255, 255, 0.19) !important;}
.counter_pop_portion:hover .enter-qty{    background-color: rgba(245, 0, 0, 0.42);}
.enter-qty-act{background-color: rgba(245, 0, 0, 0.42);}
.weight-field{width: auto;height: 20px;position: relative;top: 0px;background-color: transparent;border: 0;outline: 0 !important;text-align:center;display:inline-block;max-width:72%;overflow: hidden;min-width: 10%;line-height: 19px;    position: relative;top:6px;border-bottom: 1px #6f6f6f solid;font-size: 13px;}
.weight-field:focus{outline: 0 !important;}
.unit-kg-text{display:inline-block;width:auto;margin-left:3px;}
.counter_menu_popup{width:auto !important;background-color:transparent !important;text-align:center;border:0 !important;}
.md-content{margin:auto;display:inline-block;border: solid 2px #ccc;width: 600px !important;}
.popup-adon-cc{width:380px;height:445px;background-color: #1a1a1a;display: inline-block;overflow:auto;max-height:inherit;position: relative;left: -6px;border: solid 2px #ccc;}
.counter_menu_popup_head{border:0 !important}
.popup-adon-head{background-color:#000;width:100%;height: 55px;padding-top: 4px;}
.adon-popup-head1{width:45%;height:auto;float:left;color:#fff;padding-left:3%;font-size:15px;line-height:33px;text-align:left}
.adon-popup-head2{width:15%;height:auto;float:left;color:#fff;padding-left:2%;font-size:15px;line-height:33px;text-align:left}
.adon-popup-head3{width:18%;height:auto;float:left;color:#fff;padding-left:2%;font-size:15px;line-height:33px;text-align:left}
.adon-popup-head4{width:21%;height:auto;float:left;color:#fff;padding-left:2%;font-size:15px;line-height:33px;text-align:center}
.adon-popup-contant-cc{width:100%;height:350px;float:left;overflow:auto;}
.adon-popup-contant-row{width:100%;height:auto;float:left;margin-top:5px;padding-top:3px;min-height:30px;}
.adon-popup-contant1{width:45%;height:auto;float:left;color:#fff;padding-left:3%;font-size:14px;line-height:16px;text-align:left;padding-top: 10px;}
.adon-popup-contant2{width:15%;height:auto;float:left;color:#fff;padding-left:3%;font-size:14px;line-height:16px;text-align:left;padding-top: 10px;}
.adon-popup-contant3{width:18%;height:auto;float:left;color:#fff;padding-left:3%;}
.adon-popup-contant-pls-btn{width:30px;height:30px;float:left;background-color:#b90504;text-align:center;color:#fff;
border-radius:50%;font-size:20px;cursor:pointer;line-height: 26px;}
.adon-popup-contant-qty-box{width:50px;height:auto;float:left;border:0;border-bottom:1px #808080  solid;background-color:#505050;margin:3px 2%;text-align:center;outline:none !important;border-radius: 5px;}
.adon-popup-contant-qty-box:focus{outline:none !important}
.adon-popup-contant-cc::-webkit-scrollbar {width: 18px;height: 10px;}
.counter_pop_left_cc{width:100%}
.mynewpopupload {width: auto !important;background-color: transparent !important;text-align: center;border: 0 !important;}
.popup-adon-cc .counter_menu_popup_head_text {width:100%;height: 45px;float: left;line-height: 45px;text-align: center;color: #fff;font-size: 16px;font-family: 'CALIBRI_0';}
.counter_pop_left_portion strong{color: #fff}
.take_away_popup_head{position: relative}
.counter_pop_left_portion strong{color: #fff;font: inherit !important;}
.take_away_popup_left_portion_head{height: 35px;background-color: rgb(185, 5, 4);line-height: 35px}
.keys span:hover{background-color: rgba(245, 0, 0, 0.42);}
.add_popup_active_btn{background-color: rgba(245, 0, 0, 0.42) !important;box-shadow: 0px 4px rgba(0, 0, 0, 0) !important;-moz-box-shadow: 0px 4px rgba(0, 0, 0, 0) !important;-webkit-box-shadow: 0px 4px rgba(0, 0, 0, 0) !important;}	
.adon-popup-contant4 { padding-top: 8px; width: 21%;height: auto;float: left;color: #fff;padding-left: 3%;}

</style>                    
                     <div class="take_away_popup_left_portion_cc" style="position: relative;display: none">
                      <div class="take_away_popup_left_portion_head"><?=$_SESSION['portionname_ta']?>: <span id="load_portionrate">0</span></div>
                      
                     <div class="keys">
                         
                         <?php
			$menuid=$menu_idta ;
            $_SESSION['menu_id']=$menu_idta ;
            
            $manualrateentry='';
		$sql_menulist1= "select mr_manualrateentry from tbl_menumaster as mr  WHERE  mr.mr_active='Y'  and mr.mr_menuid ='".$menuid."'  ";
	  $sql_menus1  =  $database->mysqlQuery($sql_menulist1); 
	  $num_menus1  = $database->mysqlNumRows($sql_menus1);
	  if($num_menus1){
		  while($result_menus1  = $database->mysqlFetchArray($sql_menus1)) 
			  {
				  $manualrateentry=$result_menus1['mr_manualrateentry'];
			  }}
            
                                    $sql_menuportion="select * from tbl_menuratetakeaway where  mta_menuid='".$menuid."' and  mta_branchid='".$_SESSION['branchofid']."'";
				   $sql_portions  =  $database->mysqlQuery($sql_menuportion); 
					$num_portions  = $database->mysqlNumRows($sql_portions);
					if($num_portions){$ids="";$v=1;
						while($result_portions  = $database->mysqlFetchArray($sql_portions)) 
							{$rate=0;
								
								$rate_details=$database->show_portion_ful_details($result_portions['mta_portion']);
								//load_portionrate
                                                                //$ordered_portionid=trim(json_encode($result_portions['mta_portion']));
                                                                $ordered_portionid=$result_portions['mta_portion'];
                                                                
                                                                //echo $ordered_portionid;
                                                            $sql_takeawayportions = "select tmn.mk_stock_number,pm.pm_id,pm.pm_portionname from tbl_portionmaster pm left join tbl_menustock tmn on tmn.mk_portion=pm.pm_id where pm.pm_id='".$ordered_portionid."' and tmn.mk_menuid='$menuid' ";
                                                           // echo "select tmn.mk_stock_number,pm.pm_id,pm.pm_portionname from tbl_portionmaster pm left join tbl_menustock tmn on tmn.mk_portion=pm.pm_id where pm.pm_id='".$ordered_portionid."' and tmn.mk_menuid='$menuid'";
                                                            //echo "select pm.pm_id,pm.pm_portionname from tbl_portionmaster pm where pm.pm_id='".$portionid."'";
                                                            $sql_takeawayportions1 = $database->mysqlQuery($sql_takeawayportions);
                                                            $num_takeawayportions = $database->mysqlNumRows($sql_takeawayportions1);
                                                            if ($num_takeawayportions) {
                                                            while ($result_takeawayportions = $database->mysqlFetchArray($sql_takeawayportions1)) {
                                                                   $stk=$result_takeawayportions['mk_stock_number'];
                                                               $portion_name = $result_takeawayportions['pm_portionname'];
                                                               $portion_id = $result_takeawayportions['pm_id'];
                                                              // echo $portion_name;
                                                                if($_SESSION['main_language']!='english'){

                                                                $sql_arabportion=$database->mysqlQuery("SELECT lm_portion_name FROM tbl_language_portion left join tbl_languages on ls_id=lm_language_id WHERE lm_portion_id='".$portion_id."' and ls_language='".$_SESSION['main_language']."'");

                                                                //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                                                $num_arabportion = $database->mysqlNumRows($sql_arabportion);
                                                                $result_arabportion = $database->mysqlFetchArray($sql_arabportion);
                                                                $portion_name=$result_arabportion['lm_portion_name'];
                                                                // $catid['name'][] = $catname;
                                                                //echo $catname;
                                                                }
                                                                 //$takeaway_catid['portion_name'][]= $portion_name;      

                                                            }
                                                            }              
                                                                
                                                                
//                                                                $fp_portion=fopen($apilink."/src/takeaway_api.php?set=takeawayorderedportion&ordered_portionid=$ordered_portionid&mainlang=$other_lang","r");
//                                                                $response_portion['messagesportion'] = stream_get_contents($fp_portion);
//                                                                //echo $response_portion['messagesportion'];
//                                                                $resu_portion= json_decode($response_portion['messagesportion'],true);
                                                                //var_dump($resu_portion);   
                                                                
                                                                $rate=$result_portions['mta_rate'];
								echo '<script type="text/javascript">';
								echo '$(document).ready(function(){';
								echo '$("#load_portionrate").html("'.$rate.'");';
								echo '});';
								echo '</script>';
								
								$weekid='';
								if($_SESSION['s_portion_autoday_update']=="Y")
								{
									  
									  $weekday = date('l', strtotime($_SESSION['date']));//
									  $week=strtoupper($weekday);
									  $sql_week="select * from tbl_portionmaster where pm_portionname='".$week."' ";
									  $sql_weekday  =  $database->mysqlQuery($sql_week);
									  $num_weekday  = $database->mysqlNumRows($sql_weekday);
									  if($num_weekday){
									  while($result_weekday  = $database->mysqlFetchArray($sql_weekday)) 
										  {
											 $weekid=$result_weekday['pm_id'];
										  }
									  }
									  if($_SESSION['s_specialday']=='Y')
									  {
										  $weekid=$_SESSION['specialportion'];
									  }
									
								}
								$ids="pm_".$result_portions['mta_portion'];

								
				?>
            
            	<div  style=" <?php if($_SESSION['s_portion_autoday_update']=="Y") {if($weekid==$resu_portion['mta_portion'] || $result_portions['mta_portion']==$_SESSION['seperateportion']){ ?> display:block; <?php } else { ?> display:none; <?php }} else { ?> display:block; <?php } ?>" title="<?=$result_portions['mta_portion']?>" rate="<?=number_format($rate,$_SESSION['be_decimal'])?>" stock="<?=$stk?>" class="take_away_popup_left_portion_contant  
				<?php if($_REQUEST['typesub']=="Edit") { if($result_portions['mta_portion']==$_REQUEST['portname']){?>add_popup_active_btn <?php }}else{ ?><?php if($v==1){ ?> add_popup_active_btn <?php }} ?>">
                
                
                
                
                
				<?php 
				if($_REQUEST['typesub']=="Edit" && ($result_portions['mta_portion']==$_REQUEST['portname']) )
				{
					$ids="pm_".$_REQUEST['portname'];
					echo $portion_name ;
				}else
				{
				echo $portion_name;
				}?> 
                
                
                <div  contenteditable="true"  style="outline: none" class="counter_portion_view_btn focussed"><?php 
                
                
            
				if($_REQUEST['typesub']=="Edit" && ($result_portions['mta_portion']==$_REQUEST['portname']) )
				{
					echo $_REQUEST['actqty'];
                                        
                                        //echo $_REQUEST['typesub'];
				}else
				{
				echo "";
                                // echo $_REQUEST['portname'];
				}?></div> </div>
               <!-- <div class="counter_pop_portion counter_pop_portion_act">Half <div class="counter_portion_view_btn">1</div> </div>
                <div class="counter_pop_portion">Quarter <div class="counter_portion_view_btn"></div> </div>
                <div class="counter_pop_portion">Single <div class="counter_portion_view_btn"></div> </div>-->
                <?php $v++;} }
                
                 $sql_login124  =  $database->mysqlQuery("select mr_dailystock_in_number from tbl_menumaster where mr_menuid='".$result_menus['mr_menuid']."' "); 
				$num_login124   = $database->mysqlNumRows($sql_login124);
				if($num_login124){
					while($result_login124  = $database->mysqlFetchArray($sql_login124)) 
					  {
                                            
                                            $stockon=$result_login124['mr_dailystock_in_number'];
                                          }
                                        }
                
                
                
                ?>
                         
                        <!--<div style="margin-top:0" class="take_away_popup_left_portion_contant">Single</div>
                        <div class="take_away_popup_left_portion_contant add_popup_active_btn">Full</div>
                        <div class="take_away_popup_left_portion_contant">Quarter</div>-->
                      </div>
                      
                    </div> 

                     <input type="hidden" id="editqtystock" value="<?=$stkqty?>"> 
                     <input type="hidden" id="stockonoff" value="<?=$stockon?>"> 
                    <div style="margin-left:1%;" class="take_away_popup_left_portion_cc">
                        
                     <div class="take_away_popup_left_portion_head"><?=$_SESSION['qtyname_ta']?> <?php if($stockon=='Y'){ ?> &nbsp; <span>Left : </span> <span id="stockshow" style="color:black;background-color:#ffc877;border-radius:5px;    font-size: 17px;padding: 3px;">  </span>  <?php }?> </div>
                     
                    	<div class="keys">
                            <span class="caclulator_btn " title="cal_1">1</span>
                            <span class="caclulator_btn"  title="cal_2">2</span>
                            <span class="caclulator_btn" title="cal_3">3</span>
                            <span class="caclulator_btn " title="cal_4">4</span>
                            <span class="caclulator_btn" title="cal_5">5</span>
                            <span class="caclulator_btn" title="cal_6">6</span>
                            <span class="caclulator_btn"title="cal_7">7</span>
                            <span class="caclulator_btn" title="cal_8">8</span>
                            <span class="caclulator_btn" title="cal_9">9</span>
                            <span class="caclulator_btn " title="cal_0">0</span>
                            <span class="caclulator_btn" title="cal_.">.</span>
                             <span class="clear" id="clear_calc"><?=$_SESSION['menu_order_popup_quantity_clear']?></span>
                        </div>
                      
                     
                    </div>
                    
                    <!----------------->
                    <div class="take_away_bottom_btn_rate_cc">
                    <div class="listiing_select_cc">
                        <div class="rate_typ_text_cc"> <?php if($manualrateentry=="Y"){ ?> Enter <?php } ?>    <?=$_SESSION['ratename_ta']?> :</div>
                         <div class="rate_typ_textox_cc">
                         <!--   <input type="text" class="rate_typ_textox" placeholder="Rate" >-->
                            
                             <input type="text" class="rate_typ_textox rateentry <?php if($manualrateentry=="Y"){ ?> border_blink  <?php } ?>" id="manlrate123" placeholder="Rate" <?php if($manualrateentry=="N"){  ?> disabled="disabled" <?php } else{?> style="background-color: "  <?php }?> manualrate="<?=$manualrateentry?>" onkeypress="return dynamic(event,this.id);" onkeyup="return dynamic(event,this.id);" value="<?php 
				if($manualrateentry=="Y"){
                                    if($_REQUEST['typesub']=="Edit" && isset($_REQUEST['manualrate']))
                                       {
                                               echo $_REQUEST['manualrate'];
                                       }
                                }?>">
                         </div>
                        
                            <input type="hidden" id="manualrate" value="<?=$manualrateentry?>" />
                         </div>
                         <div class="pop_custom_prference_cc">
                             <textarea onkeyup="return manual_pref_check();" placeholder="<?=$_SESSION['menu_order_placeholder_edit_manualpref']?>" class="counter_pref_text_area prefrtext pref_key_entry"><?php 
				if($_REQUEST['typesub']=="Edit" && isset($_REQUEST['prefname']))
				{
					echo $_REQUEST['prefname'];
				}?></textarea>
                            <!--<textarea placeholder="Manual Preference" class="counter_pref_text_area prefrtext"></textarea>-->
                        </div>
                    </div>
                    
                    
                    
                  <div class="pop_prference_cc" style="position:relative;">
                         
                  <?php 
                   
                   
                   if($_SESSION['manual_pref_item']=='N'){
                   
                                
                  $otherlang=''; 
		  $sql_branch =  mysqli_query($localhost,"Select bp_item_other_lang_kot from tbl_branch_settings_printer "); 
		  $num_branch  = mysqli_num_rows($sql_branch);
		  if($num_branch)
		  {
				while($result_branch  = mysqli_fetch_array($sql_branch)) 
					{
						 $otherlang=$result_branch['bp_item_other_lang_kot'];
                                                  
					}
		  }
                  
                  
                                $sql_menupref="select pmr_id,mpr_menuid,pmr_name,mpr_prefeernce from tbl_menuprefmaster tm left join tbl_preferencemaster tp on tp.pmr_id=tm.mpr_prefeernce where  mpr_menuid='".$menuid."'";
                               
                               
                                $sql_pref  =  $database->mysqlQuery($sql_menupref); 
				 $num_pref  = $database->mysqlNumRows($sql_pref);
				 if($num_pref){
                                     ?>
                                    <select id="insightList" multiple="multiple" class="counter_new_drop_1">
                                     <?php
                                        while ($result_menupref = $database->mysqlFetchArray($sql_pref)) {
                                            
                                           $pref_name = $result_menupref['pmr_name'];
                                           $pref_id = $result_menupref['pmr_id'];
                                           
                                    if($_SESSION['main_language']!='english' || $otherlang=='Y'){

                                        
                                       if($_SESSION['main_language']!='english'){   
                                    $sql_arabpref=$database->mysqlQuery("SELECT l_pref_name FROM tbl_language_preference left join tbl_languages on ls_id=l_lang_id WHERE l_pref_id='".$result_menupref['pmr_id']."' and ls_language='".$_SESSION['main_language']."'");

                                       }
                                       
                                       
                                     if($otherlang=='Y'){   
                                        $sql_arabpref=$database->mysqlQuery("SELECT l_pref_name FROM tbl_language_preference left join tbl_languages on ls_id=l_lang_id WHERE l_pref_id='".$result_menupref['pmr_id']."' and l_lang_id='2'");

                                       }   
                                       
                                    
                                    
                                    $num_arabpref = $database->mysqlNumRows($sql_arabpref);
                                     if($num_arabpref){
                                        while ($result_arabpref = $database->mysqlFetchArray($sql_arabpref)){
                                          $pref_name=$result_arabpref['l_pref_name'];
                                   
                                    }}}

                              
                                   $rate_details=$database->show_prefernce_ful_details($pref_name);
                               ?>
                               <option value="<?=$pref_name ?>" ><?=$pref_name ?></option>
                               <?php } ?>
                               </select>
                                        <?php } else { ?>
                            <div style="line-height:30px;"  class="counter_new_drop_1"><?=$_SESSION['nopref_ta']?></div>
                   <?php } }else{?>
                         
         <div id="load_manual_pref" style="width: 92%;position: absolute;top: -109px;left: 12px;background-color: #3c464c;
         padding: 10px;display: flex;flex-direction: column;align-items: flex-end;display: none;border-radius: 4px;overflow-y: auto;height: 112px;">
             
         </div>  
                 
                 
                 
                 <div onclick="view_muti_pef('<?=$menuid?>');" style="line-height:30px;"  class="counter_new_drop_1">MULTIPLE QTY PREFERENCE</div>
                            
                   <?php } ?>         

                  <a href="#" class="counter_pref_right_btn tasale_addnew"><?=$_SESSION['submitname_ta']?></a>
                        
                         	
                 </div>
                    
                </div>
                
         <?php } } ?>
                 
        </div>
            
            
           	    <!--------------Add- on Starts------>
                    <?php 
                    $menu_addon_name=array();
                    $sql_menuaddon="select mr.mr_menuid, mr.mr_menuname, ma.ma_menuid,mta.mta_rate FROM tbl_menu_addons ma, tbl_menuratetakeaway mta,tbl_menumaster mr  where ma.ma_menuid='".$_SESSION['autoloadmenu']."' and ma.ma_addon_menuid in (mta.mta_menuid) and mr.mr_menuid in (ma.ma_addon_menuid) and mta.mta_rate>0 group by ma.ma_addon_menuid";
                    
                    $sql_menu_addon  =  $database->mysqlQuery($sql_menuaddon); 
                    $num_addon  = $database->mysqlNumRows($sql_menu_addon);
                    if($num_addon){$q=0;
                        
                    ?>
                    <div class="popup-adon-cc" style="display:inline-block">
                        <div class="counter_menu_popup_head_text popup-adon-head">ADD ON</div>
                        <span style="width:100%;text-align: center;    height:15px;line-height: 15px;float: left;margin-top: -10px;background-color: #000"></span>
                        <div class="counter_pop_left_head">
                            <div class="adon-popup-head1">MENU</div>
                            <div class="adon-popup-head2">RATE</div>
                            <div class="adon-popup-head3">QTY</div>
                            <div class="adon-popup-head4">TOTAL</div>
                        </div>
                        <div class="adon-popup-contant-cc">
                 <?php 
                    while ($result_menu_addons = $database->mysqlFetchArray($sql_menu_addon)){
                        
                        //$menu_addon_name=$database->show_menu_ful_details($result_menu_addons['ma_addon_menuid']);
                    ?>    
                        <div class="adon-popup-contant-row addo_each_menu_div">
                            <div class="adon-popup-contant1 addon-menu-name addonmenu" id="addonmenu_<?=$result_menu_addons['mr_menuid']?>" addon_slo=<?php if(isset($addon_menu_details['menu_edit_slno'][$q])){ echo $addon_menu_details['menu_edit_slno'][$q]; }else{ echo NULL;} ?> ><?=$result_menu_addons['mr_menuname']?></div>
                            <div class="adon-popup-contant2 addonrate" id="addonrate_<?=$result_menu_addons['mr_menuid']?>"><?=number_format($result_menu_addons['mta_rate'],$_SESSION['be_decimal'])?></div>
                            <div class="adon-popup-contant3">
                                <!--<div class="adon-popup-contant-pls-btn">-</div>-->   
                    <input type="text" class="adon-popup-contant-qty-box addonqty" id="addonqty_<?=$result_menu_addons['mr_menuid']?>" <?php if(isset($addon_menu_details['menu_edit_qty'][$q])){ if($addon_menu_details['menu_edit_id'][$q]==$result_menu_addons['mr_menuid']){ ?>  value="<?=$addon_menu_details['menu_edit_qty'][$q]?>" <?php }} ?> >
                                <!--<div class="adon-popup-contant-pls-btn">+</div>-->
                            </div>
                            <div class="adon-popup-contant4 addontotal" id="addontotal_<?=$result_menu_addons['mr_menuid']?>"><?php if(isset($addon_menu_details['menu_edit_rate'][$q])){ if($addon_menu_details['menu_edit_id'][$q]==$result_menu_addons['mr_menuid']){  echo $addon_menu_details['menu_edit_rate'][$q]; $q++; } }?></div>
                        </div><!--adon-popup-contant-row-->
                    
                        <?php 
                        
                            } ?>
                        </div>
                    </div>
                <?php } ?>
        <!-----------------------Add-on Ends------------------------>
<script>
    
    $(document).keyup(function(evt){
        
        
          
    var decimal=$("#decimal").val();
             
    if($('#manlrate123').hasClass('focussed')){ 
        
        var rt=$('#manlrate123').val();
             
        if(evt.keyCode=="110" && rt=='.'){
            
           $('#manlrate123').val('0.');
        }
          
           var quantity=$('.enter-qty-act').val();
           var total_rate=parseFloat(quantity)*parseFloat(rt);
           if(rt!=''&& rt!='0'){
            $('#load_portionrate').text((total_rate).toFixed(decimal));
           }
    }
    else if($('.weight-field').hasClass('focussed')){
        
         var rt= $('.weight-field').html();
         // alert('2');
         //  if(evt.keyCode=="110"){
         //  $('.weight-field').text('.');
         //  //$('.weight-field').focus();
         //  }
    }
    else if($('.enter-qty-act').hasClass("focussed")){
       
        var rt=$('.enter-qty-act').val();
        if(evt.keyCode=="110" || rt.includes(".")){
            
            if ($(".enter-qty-act").is(":focus")) {
            //alert('t');       
            $('.enter-qty-act').val('');
       }
       }
       else if(rt==0){
             
             $('.enter-qty-act').val('');
      }
    }
    else if($('.addonqty').hasClass("focussed")){
        
        var addonmenu_id_keypress=$('.focussed').attr('id').split('_');
        if(evt.keyCode=="110" || $('.focussed').val().includes(".")){
            
           $('.focussed').val('');
           $('#addontotal_'+addonmenu_id_keypress[1]).text('');
        }
        else if($('.focussed').val()==0 || isNaN($('.focussed').val())){
          $('.focussed').val('');
          $('#addontotal_'+addonmenu_id_keypress[1]).text('');
        }
        else if(evt.keyCode=="8"){
            
            if($('.focussed').val()!=''){
                var addonmenu_rate_keypress=parseFloat($('#addonrate_'+addonmenu_id_keypress[1]).text().replace(',',''));
                $('#addontotal_'+addonmenu_id_keypress[1]).text(parseFloat(addonmenu_rate_keypress*$('.focussed').val()).toFixed(decimal));
            }
            else{
                $('#addontotal_'+addonmenu_id_keypress[1]).text('');
            }
        }
            
        else{
            if($('.focussed').val().length<=3){
                
                var addonmenu_rate_keypress=parseFloat($('#addonrate_'+addonmenu_id_keypress[1]).text().replace(',',''));
                $('#addontotal_'+addonmenu_id_keypress[1]).text(parseFloat(addonmenu_rate_keypress*$('.focussed').val()).toFixed(decimal));
            }
            else{

               $('.focussed').val($('.focussed').val().substring(0,3)); 
            }
        }
    }
   
   if(rt.includes(".")){
       
   var b=rt.split('.');
   var bw=b[1].length;
   
   var dc=$('#decimal').val();
   var dc1=dc-1;
  
   if(bw>dc1){
   
    return false;
    var keyCode = (evt.keyCode ? evt.keyCode : evt.which);
  
    if (96<=keyCode<=105 || keyCode==110||48<=keyCode<=57) {
       
        evt.preventDefault();
        return false;
   }
    alert('Max 3 digits after decimal point');
    $('#manlrate123').val((rt).toFixed(dc));
}
 }
 
});
</script>

<script>
  $(document).ready(function(){
      
      var show_menu_rate_val_dyn=$('#show_menu_rate_val_dyn').val();
      
      var dyn=$('#show_menu_rate_val_dyn').attr('dyn');
      
      var show_menu_rate_val = $('#show_menu_rate_val').val();
      
        if($('#type_action').val()!='Edit'){
              $('#manlrate123').val(show_menu_rate_val);//alert("dfgafd");
        }
        
        if(dyn=='Y'){
          
           setTimeout(function () {
        
         $('#manlrate123').val(show_menu_rate_val_dyn);
           }, 500);
          
      }
        
        
     var decimal=$("#decimal").val();
      if($('#portion-or-unit').val()=='Portion')
      { 
          $('.portion-div').css('display','block');
          $('.packet-div').css('display','none');
          $('.loose-div').css('display','none');
      }
      else if($('#portion-or-unit').val()=='Unit'){
        //alert($('#portion-or-unit').val());
        //alert($('#packet-or-loose').val());
         if($('#packet-or-loose').val()=='Packet'){
             
             $('.portion-div').css('display','none');
             $('.packet-div').css('display','block');
             $('.loose-div').css('display','none');
             
         }
         else {
             
             $('.portion-div').css('display','none');
             $('.packet-div').css('display','none');
             $('.loose-div').css('display','block');
         }
     }
     //alert($('#menuqty').val());
      var portion_or_unit=$('#portion-or-unit').val();
      var packet_or_loose=$('#packet-or-loose').val();
      $('.enter-qty:first').addClass('enter-qty-act');
      $('.enter-qty:first').val($('#menuqty').val());
      $('.enter-qty:first').addClass('focussed');
      $('.enter-qty:first').select();
      var id=$('.enter-qty:first').attr('id');
      
      if(portion_or_unit=='Portion'){
          
      var rate=parseFloat($('.enter-qty:first').val())*parseFloat($('.portionrate:first').text().replace(',',''));
      var manualrate_val=$('#rate_value').attr('manualrate');
    
      if(manualrate_val=='Y'){
      if($('#manlrate123').val()!=''){
            var rate=parseFloat($('.enter-qty:first').val())*parseFloat($('#rate_value').val());
        }
        else{
             var rate=0;
        }
        }
        $('#load_portionrate').text((rate).toFixed(decimal));
        
              var portion_id=id.split('_');
              var portion_id1=portion_id[1];
              var stockonoff=$('#stockonoff').val();
                if(stockonoff=="Y")  {  
          
                var stock_num=$('#stock_number_'+portion_id1).attr('stock');
                //alert(stock_num);
                if($('#type_action').val()=='add'){
                    var diff_stock=parseFloat(stock_num)-parseFloat($('.enter-qty:first').val());
                }
                else{
                    if(stock_num==0){
                        $('#stock_number_'+portion_id1).attr('stock',$('.enter-qty:first').val());
                    }
                    else{
                        $('#stock_number_'+portion_id1).attr('stock',parseFloat($('.enter-qty:first').val())+parseFloat(stock_num));
                    }
                    var diff_stock=stock_num;
                }
                $('#stockshow').html(diff_stock);
                
            }
            //$.post("load_div.php", {portionval:portion_id1,unitval:'',baseunit:'',set:'portionset'});
        
        }
        else if(portion_or_unit=='Unit'){
            //alert(portion_or_unit);
            var portion_id1=id.split('-');
              var portion_id11=portion_id1[1];
              var portion_id2=id.split('_');
              var stockonoff=$('#stockonoff').val();
                            
            if(packet_or_loose=='Packet'){
                var rate=parseFloat($('.enter-qty:first').val())*parseFloat($('.unitrate:first').text().replace(',','')); 
                $('#load_packetrate').text((rate).toFixed(decimal));
                if(stockonoff=="Y")  {  
          
                    var stock_num=$('#unit_stock_number-'+portion_id11).attr('stock');
                    //alert(stock_num);
                    if($('#type_action').val()=='add'){
                        var diff_stock=parseFloat(stock_num)-parseFloat($('.enter-qty:first').val());
                    }
                    else{
                        if(stock_num==0){
                            $('#unit_stock_number-'+portion_id11).attr('stock',$('.enter-qty:first').val());
                        }
                        else{
                            $('#unit_stock_number-'+portion_id11).attr('stock',parseFloat($('.enter-qty:first').val())+parseFloat(stock_num));
                        }
                        var diff_stock=stock_num;
                    }
                $('#stockshow').html(diff_stock);
                }
            //$.post("load_div.php", {portionval:'',unitval:portion_id2[1],baseunit:'',set:'portionset'});         
            }    
            else if(packet_or_loose=='Loose'){
                    var rate=parseFloat($('.enter-qty:first').val())*parseFloat($('.baseunitrate').text().replace(',',''));       
                    $('#load_looserate').text(' 1 '+$('.baseunitname').text()+'='+<?=$menu_rate[0]?>.toFixed(decimal));
                    
                    if(stockonoff=="Y")  {
                    var stock_num=$('#baseunit_stock_number_'+portion_id2[1]).attr('stock');
                    //alert(stock_num);
                    $('#stockshow').html(stock_num);
                    }
                //$.post("load_div.php", {portionval:'',unitval:'',baseunit:portion_id2[1],set:'portionset'});
            }
        }
      
     }); 
     
     
     
          
     function packetadd(){
     
      var decimal=$("#decimal").val();
      var portion_or_unit=$('#portion-or-unit').val();
        var packet_or_loose=$('#packet-or-loose').val();
         
         if(packet_or_loose=='Packet'){
                var strg=$(".enter-qty-act").val() + 1;
                var port_id=$(".enter-qty-act").attr('id');
                var port_id=$(".enter-qty-act").attr('id'); 
                var portion_id1=port_id.split('_');
                var portion_id1=portion_id1[1];
                var portion_id2=port_id.split('-');
                var port_id2=portion_id2[1];
                var rt       =  parseFloat($('#unitrate-'+port_id2).text());
                 var totl=parseFloat(rt) * parseFloat($(".enter-qty-act").val());
                 
                 if($(".enter-qty-act").val()!="" && $(".enter-qty-act").val()>0){
                $("#load_packetrate").html(totl.toFixed(decimal));
                 }else{
                     $("#load_packetrate").html((0).toFixed(decimal)); 
                 }
           
     }
 }
        function manual_pref_check(){
        
         var str=$('.pref_key_entry').val();
   
     if(isNaN(str.charAt(0))==false){
         
          var all_str='.'+str;  
         
       $('.pref_key_entry').val(all_str);
         
      }
        
    }
    
  function looseadd(){
      
      var decimal=$("#decimal").val();
      var portion_or_unit=$('#portion-or-unit').val();
      var packet_or_loose=$('#packet-or-loose').val();
         
       if(packet_or_loose=='Loose'){
                 
            var strg=$(".enter-qty-act").val() + 1;
            var port_id=$(".enter-qty-act").attr('id');
            var portion_id1=port_id.split('_');
            var port_id2=portion_id1[1];
           
            var qty=parseFloat($('#baseunitqty_'+port_id2).val());
            
            var looserate=$('#load_looserate').text().split('=');
            var rt =  parseFloat(looserate[1]);
            
            if($('#baseunitweight_'+port_id2).text()!=""){
                var looseqty=$('#baseunitweight_'+port_id2).text();
            }else{
                looseqty=1;    
            }
        
            var totl=parseFloat(rt) * parseFloat(qty) * parseFloat(looseqty) ;
           if((qty!=0 && qty>0) && looseqty!=""){
                 $(".baseunitrate").html(totl.toFixed(decimal));
            }else{
                $(".baseunitrate").html(rt.toFixed(decimal)); 
            }
          
       }
  }
  
  
 function litre_kg_add(p){
     
      var decimal=$("#decimal").val();
      var portion_or_unit=$('#portion-or-unit').val();
      var packet_or_loose=$('#packet-or-loose').val();
     
        if(packet_or_loose=='Loose')
        {       
            
        var looserate=$('#load_looserate').text().split('=');
        var rt =  parseFloat(looserate[1]);
       
        if($('#baseunitqty_'+p).val()!=""){
           var qty=parseFloat($('#baseunitqty_'+p).val());
        }else{
           qty=1;
        }
           
       var looseqty=$('#baseunitweight_'+p).text();
           
       var totl=parseFloat(rt) * parseFloat(qty) * parseFloat(looseqty);
         
         if((qty!=0 && qty>0) && looseqty!=""){
              $(".baseunitrate").html(totl.toFixed(decimal));
         }else{
              $(".baseunitrate").html(rt.toFixed(decimal)); 
         }
        
      }
      
 }
     
    
    
 function rate_change_portion_wise(rt){
   $('#manlrate123').val(rt);
    }  
    
    
    function view_muti_pef(mid){
      
      if($('#load_manual_pref').css('display') == 'none')
       {
      
       $.post("load_index.php", {set:'load_manual_preference',menu:mid},
					function(data)
					{
                                         
					 data=$.trim(data);
                                       $('#load_manual_pref').show();
                                       $('#load_manual_pref').html(data);
                                       
                                       
               $.post("load_index.php", {set:'load_manual_preference_edit',menu:mid,mode:'TA'},
					function(data)
					{   
                     
                     var a=JSON.parse($.trim(data));
                    
                    
                  if(a!=''){
                      
                       $.each(a, function(i, record) {
                           
                          $('#manual_pref_qty_'+record.tmp_pref_id).val(record.tmp_qty);
                        });
                  }
                                            
                                      }); 
                                       
	});
          
        }else{
           $('#load_manual_pref').hide();
           $('#load_manual_pref').html(''); 
        }
          
          
    }
    
    
    function pref_entry_multi(id){ 
        
        
    var sum=0;
    $(".manual_pref_qty").each(function(){
        //if($(this).val()>0)
        //  sum += parseInt($("#manual_pref_qty_"+id).val(), 10);   
        
        var vl = parseInt($(this).val(), 10);
        if (vl > 0) {
            sum += vl;
        }
       
        
    });

  var qty=$('.enter-qty-act').val();
  
  if(sum>qty){
                      $('.loaderrpop').show();
                      
                      $('.loaderrpop').text(' PREFERENCE QTY & ITEM QTY DOESNT MATCH');
                      $('.loaderrpop').delay(2000).fadeOut('slow');
    $("#manual_pref_qty_"+id).val('');
  }
  
  
        
    }
    
    
</script>