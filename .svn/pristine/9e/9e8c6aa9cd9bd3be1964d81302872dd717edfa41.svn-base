<?php

include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
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
$menu_floorid='';
$packet_or_loose='';
$addon_yes_no='';
$addon_menu_details=array();



if(isset($_REQUEST['type'])){
    
 $type_action=$_REQUEST['type'];

}
    if(isset($_REQUEST['pt'])){
   $prt1=$_REQUEST['pt'];
   
    }
    
   if(isset($_REQUEST['menuid'])){
      
     $menuid=$_REQUEST['menuid'];
     $menuid1=explode("_",$menuid);
     $menuid1[1];
   
     
     $slno=$_REQUEST['slno'];
     $slno1=explode("_",$slno);
     
    $slno_edit= $slno1[1];
    $sql_edit  =  $database->mysqlQuery("select ter_total_rate,ter_unit_id,ter_base_unit_id,ter_unit_weight,ter_branchid, ter_preferencetext,mm.mr_manualrateentry,mm.mr_menuname,tor.ter_menuid, tor.ter_portion,tor.ter_floorid,pr.pm_portionname,tor.ter_rate,tor.ter_qty FROM tbl_tableorder tor left join tbl_menumaster mm on mm.mr_menuid = tor.ter_menuid left join tbl_portionmaster pr on pr.pm_id=tor.ter_portion  where tor.ter_orderno='".$_SESSION['order_id']."' and tor.ter_slno='".$slno1[1]."' and tor.ter_menuid='".$menuid1[1]."'"); 
     //echo "select mm.mr_menuname, tor.ter_portion, tor.ter_rate, tor.ter_qty FROM tbl_tableorder tor left join tbl_menumaster mm on mm.mr_menuid = tor.ter_menuid where tor.ter_orderno='".$_SESSION['order_id']."' and tor.ter_slno='".$slno1[1]."' and tor.ter_menuid='".$menuid1[1]."'";
    $num_edit  = $database->mysqlNumRows($sql_edit);
	if($num_edit)
            {
            while($result_edit  = $database->mysqlFetchArray($sql_edit)) 
		{
                    $menu_name =$result_edit['mr_menuname'];
                   if($_SESSION['main_language']!='english'){
                       $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_edit['ter_menuid']."' and ls_language='".$_SESSION['main_language']."'");
                        //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                        $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                        $result_arabmenu=$database->mysqlFetchArray($sql_arabmenu);
                        $menu_name=$result_arabmenu['lm_menu_name'];
                                        // $catid['name'][] = $catname;
                                        //echo $catname;
                        }
                   $manualrateentry=$result_edit['mr_manualrateentry'];
                  
                   $ordered_menu_rate  =$result_edit['ter_rate'];
                   
                   $menu_portion  =$result_edit['ter_portion'];
                   $menu_qty=$result_edit['ter_qty'];
                   $menu_id=$result_edit['ter_menuid'];
                   $menu_floorid=$result_edit['ter_floorid'];
                   $portion_name=$result_edit['pm_portionname'];
                   $final1=$ordered_menu_rate*$menu_qty;
                   $branch_id=$result_edit['ter_branchid'];
                   $menu_unit_id=$result_edit['ter_unit_id'];
                   $menu_base_unit_id=$result_edit['ter_base_unit_id'];
                   $menu_base_unit_weight=$result_edit['ter_unit_weight'];
                   $menu_total_rate=$result_edit['ter_total_rate'];
                   //echo $branch_id;
                   $pref_text=$result_edit['ter_preferencetext'];
                   if($menu_portion!=''){
                   $string.=" and mmr_portion='".$menu_portion."'";
                   }
                   else if($menu_unit_id!=''){
                   $string.=" and mmr_unit_id='".$menu_unit_id."' and mmr_unit_weight='".$menu_base_unit_weight."' ";
                   }
                   else if($menu_base_unit_id!=''){
                   $string.=" and mmr_base_unit_id='".$menu_base_unit_id."'";
                   }
                   else{
                       $string.='';
                   }
                }
            
            }
    
    $sql_addon_edit  =  $database->mysqlQuery("select ter_slno,ter_menuid,ter_qty, ter_total_rate from tbl_tableorder where  ter_orderno='" . $_SESSION['order_id'] . "' and ter_addon_slno='".$slno1[1]."' order by ter_menuid ");
    $num_addon_edit  = $database->mysqlNumRows($sql_addon_edit);
	if($num_addon_edit){
            while($result_addon_edit  = $database->mysqlFetchArray($sql_addon_edit)){
                $addon_menu_details['menu_edit_id'][]=$result_addon_edit['ter_menuid'];
                $addon_menu_details['menu_edit_qty'][]=$result_addon_edit['ter_qty'];
                $addon_menu_details['menu_edit_rate'][]=$result_addon_edit['ter_total_rate'];
                $addon_menu_details['menu_edit_slno'][]=$result_addon_edit['ter_slno'];
            }
        }
    }
     
$a=  trim(json_encode($_SESSION['main_language']),'""');
if(isset($_REQUEST['menu'])){
$_SESSION['autoloadmenu']=$_REQUEST['menu'];
}
else{
    $_SESSION['autoloadmenu']=$menuid1[1];
}

?>
                                             <input type="hidden" name="hidtableordernentry_updated" id="hidtableordernentry_updated" value="<?=$_SESSION['procedures_proc_tableordernentry_updated']?>" />
                                             <input type="hidden" name="hidtableordernentry_success" id="hidtableordernentry_success" value="<?=$_SESSION['procedures_proc_tableordernentry_success']?>" />
                                             <input type="hidden" name="hidtableordernentry_rate" id="hidtableordernentry_rate" value="<?=$_SESSION['procedures_proc_tableordernentry_rate']?>" />
                                             <input type="hidden" name="hidtableordernentry_billed" id="hidtableordernentry_billed" value="<?=$_SESSION['procedures_proc_tableordernentry_billed']?>" />
                                             <input type="hidden" name="be_search_focus" id="be_search_focus" value="<?=$_SESSION['be_search_focus']?>" />
                                             
<script src="js/pop_menu.js" async> </script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<script type="text/javascript">

	
    $(document).keydown(function(ev)
    {
        
                   
   $(".manual_pref_qty").on("keyup", function(){
    var sum=0;
    $(".manual_pref_qty").each(function(){
        if($(this).val()>0)
          sum += parseInt($(this).val(), 10);   
    });

  var qty=$('.enter-qty-act').val();
  
  if(sum>qty){
                      $('.loaderrpop').show();
                             
                      $('.loaderrpop').text(' PREFERENCE QTY & ITEM QTY DOESNT MATCH');
                      $('.loaderrpop').delay(2000).fadeOut('slow');
     $(this).val('');
  }
  
  });
        
        
     $('.pref_key_entry').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9, /\b]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});   
        
        
      var keyCode = ev.keyCode || ev.which;   
        
      if (keyCode == 13) {
           
      if($('.submit_all').css('display') == 'block'){
          
      $('.submit_all').click();
         //   $(".focussed").text(''); 
         return false;
       }
     else if($('#popup_order_edit').css('display') == 'block'){
        
      $('#popup_order_edit').click();
      
       return false;
    }
    }
});
     $(document).keyup(function(evt){
            //alert('1');
            var decimal=$("#decimal").val();
             //alert(evt.keyCode);
      if($('#rate_value').hasClass('focussed')){       
             var rt=$('#rate_value').val();
             
             //alert(rt);
        if(evt.keyCode=="110" && rt=='.'){
            
           $('#rate_value').val('0.');
          }
           var quantity=$('.enter-qty-act').val();
           var total_rate=parseFloat(quantity)*parseFloat(rt);
           if(rt!=''&& rt!='0'){
           $('#load_portionrate').text((total_rate).toFixed(decimal));
           }
    }
    else if($('.weight-field').hasClass('focussed')){
        //alert($('.baseunitweight').attr('id'));
         var rt= $('.weight-field').html();
         //alert(rt);
//         if(evt.keyCode=="110"){
//            $('.weight-field').text('.');
//            //$('.weight-field').focus();
//   }
    }
    else if($('.enter-qty-act').hasClass("focussed")){
        
        var rt=$('.enter-qty-act').val();
        if(evt.keyCode=="110" || rt.includes(".")){
             if ($(".enter-qty-act").is(":focus")) {
           $('.enter-qty-act').val('');
       }
          }
         else if(rt==0){
             
             $('.enter-qty-act').val('');
         }
    }
    else if($('.addonqty').hasClass("focussed")){
        //alert(evt.keyCode);
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
    //alert(rt);
 if(rt.includes(".")){
   var b=rt.split('.');
var bw=b[1].length;
//alert(bw);
var dc=$('#decimal').val();
var dc1=dc-1;
//alert(dc1);
if(bw>dc1){
    //alert('ssss');
     return false;
   var keyCode = (evt.keyCode ? evt.keyCode : evt.which);
   //alert(keyCode);
    if (96<=keyCode<=105 || keyCode==110||48<=keyCode<=57) {
        //alert('sfadf');
        evt.preventDefault();
        return false;
   }
    alert('Max 3 digits after decimal point');
    $('#rate_value').val((rt).toFixed(dc));
}
 }
});



</script>
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
.popup-adon-cc{width:380px;height:472px;background-color: #1a1a1a;display: inline-block;overflow:auto;max-height:inherit;position: relative;left: -6px;border: solid 2px #ccc;}
.counter_menu_popup_head{border:0 !important}
.popup-adon-head{background-color:#000;width:100%;height: 55px;padding-top: 4px;}
.adon-popup-head1{width:45%;height:auto;float:left;color:#fff;padding-left:3%;font-size:15px;line-height:33px;text-align:left}
.adon-popup-head2{width:15%;height:auto;float:left;color:#fff;padding-left:2%;font-size:15px;line-height:33px;text-align:center}
.adon-popup-head3{width:18%;height:auto;float:left;color:#fff;padding-left:2%;font-size:15px;line-height:33px;text-align:center}
.adon-popup-head4{width:21%;height:auto;float:left;color:#fff;padding-left:2%;font-size:15px;line-height:33px;text-align:center}
.adon-popup-contant-cc{width:100%;height:350px;float:left;overflow:auto;}
.adon-popup-contant-row{width:100%;height:auto;float:left;margin-top:5px;padding-top:3px;min-height:30px;}
.adon-popup-contant1{width:45%;height:auto;float:left;color:#fff;padding-left:3%;font-size:14px;line-height:16px;text-align:left;padding-top: 10px;}
.adon-popup-contant2{width:15%;height:auto;float:left;color:#fff;padding-left:3%;font-size:14px;line-height:16px;text-align:left;padding-top: 10px;}
.adon-popup-contant3{width:18%;height:auto;float:left;color:#fff;padding-left:3%;}
.adon-popup-contant4{padding-top: 10px;width:21%;height:auto;float:left;color:#fff;padding-left:3%;}
.adon-popup-contant-pls-btn{width:30px;height:30px;float:left;background-color:#b90504;text-align:center;color:#fff;
border-radius:50%;font-size:20px;cursor:pointer;line-height: 26px;}
.adon-popup-contant-qty-box{width:50px;height:auto;float:left;border:0;border-bottom:1px #808080  solid;background-color:#505050;margin:3px 2%;text-align:center;outline:none !important;border-radius: 5px;}
.adon-popup-contant-qty-box:focus{outline:none !important}
.adon-popup-contant-cc::-webkit-scrollbar {width: 18px;height: 10px;}
.counter_pop_left_cc{width:100%}
.mynewpopupload {width: auto !important;background-color: transparent !important;text-align: center;border: 0 !important;}
.popup-adon-cc .counter_menu_popup_head_text {width:100%;height: 45px;float: left;line-height: 45px;text-align: center;color: #fff;font-size: 16px;font-family: 'CALIBRI_0';}
.counter_pop_left_portion strong{color: #fff}
.cls-mn-odr{background-color: transparent !important}
.pop_prference_cc .btn-group, .btn-group-vertical{width:100%}
.pop_prference_cc .btn-group-vertical>.btn, .btn-group>.btn{text-align:left;}
.pop_prference_cc .open>.dropdown-menu{width:100%}
.border_blink {
	border: 1px solid rgb(255, 0, 0);
	border: 3px solid rgba(255, 0, 0, 1);
	-webkit-background-clip: padding-box; /* for Safari */
	background-clip: padding-box; /* for IE9+, Firefox 4+, Opera, Chrome */
  -webkit-animation: underBlink 1s infinite;
  -moz-animation:    underBlink 1s infinite;
  -o-animation:      underBlink 1s infinite;
  animation:         underBlink 1s infinite;
}

@-webkit-keyframes underBlink {
  0%   { border: 3px solid rgba(255, 0, 0, .2); }
  100% { border: 3px solid rgba(255, 0, 0, .9); }
}
@-moz-keyframes underBlink {
  0%   { border: 3px solid rgba(255, 0, 0, .2); }
  100% { border: 3px solid rgba(255, 0, 0, .9); }
}

@keyframes underBlink {
  0%   { border: 3px solid rgba(255, 0, 0, .2); }
  100% { border: 3px solid rgba(255, 0, 0, .9); }
}
</style>
<div class="md-content" style="width:40%;left:30%;top:15%;z-index:99999;">

<?php

							$sql_menulist= "select * from tbl_menumaster as mr LEFT JOIN tbl_menumaincategory as mc ON mr.mr_maincatid=mc.mmy_maincategoryid   WHERE mc.mmy_active='Y'  and mr.mr_active='Y'  and mr.mr_menuid ='".$_SESSION['autoloadmenu']."' order by mr_subcatid ";
                                                        $sql_menus  =  $database->mysqlQuery($sql_menulist); 
							$num_menus  = $database->mysqlNumRows($sql_menus);
							if($num_menus){
								while($result_menus  = $database->mysqlFetchArray($sql_menus)) 
									{
                                                                    $menuname=$result_menus['mr_menuname'];
                                                                    $ordered_menuid=$result_menus['mr_menuid'];
                                                                    $addon_yes_no=$result_menus['mr_add_on'];
                                                                    $portion_or_unit=trim($result_menus['mr_rate_type']);
                                                                    //echo $portion_or_unit;
                                                                    if($portion_or_unit=='Unit')
                                                                    {   
                                                                        
                                                                        $sql_unit= "select mmr_rate_type,mmr_unit_type from tbl_menuratemaster WHERE mmr_rate_type='Unit' and mmr_menuid='".$ordered_menuid."'  ";
                                                                        //echo "select mmr_rate_type,mmr_unit_type from tbl_menuratemaster WHERE mmr_rate_type='Unit' and mmr_menuid='".$ordered_menuid."'  ";
                                                                        $sql_unit1  =  $database->mysqlQuery($sql_unit); 
                                                                        $num_unit  = $database->mysqlNumRows($sql_unit1);
                                                                        if($num_unit){
                                                                        while($result_unit  = $database->mysqlFetchArray($sql_unit1)) 
                                                                            {
                                                                                $packet_or_loose=$result_unit['mmr_unit_type'];
                                                                            }
                                                                        }
                                                                    }
                                                                        if($_SESSION['main_language']!='english'){

                                                                    $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_menus['mr_menuid']."' and ls_language='".$_SESSION['main_language']."'");

                                                                    //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                                                    $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                                                                    $result_arabmenu = $database->mysqlFetchArray($sql_arabmenu);
                                                                    $menuname=$result_arabmenu['lm_menu_name'];
                                                                    // $catid['name'][] = $catname;
                                                                    //echo $catname;
                                                                    }
                                                                    //echo $menuname;
                                                                   
				?>
				<input  type="hidden" id="decimal" value="<?=$_SESSION['be_decimal']?>">
				<input type="hidden" name="idofmenu" id="idofmenu"  value="<?=$result_menus['mr_menuid'] ?>" floorid="<?=$menu_floorid?>"/>
                                
                                <input type="hidden" name="portion-or-unit" id="portion-or-unit"  value="<?=$portion_or_unit ?>"/>
                                <input type="hidden" name="packet-or-loose" id="packet-or-loose"  value="<?=$packet_or_loose ?>"/>
                                <input type="hidden" name="menuqty" id="menuqty"  value="<?=$menu_qty ?>"/>
                                <input type="hidden" name="edit_serialno" id="edit_serialno"  value="<?=$slno_edit ?>"/>
                                <input type="hidden" name="type_action" id="type_action"  value="<?=$type_action ?>"/>
                                <input type="hidden" name="addon_menuid" id="addon_menuid"  value=""/>
                                <?php
                                $portion_id=array();
                                $base_unit_id=array();
                                $unit_id=array();
                                $menu_rate=array(); $menu_rate_dyn=array();
                                $menu_default_portion=array();
                                $menu_default_loose=array();
                                $menu_default_packet=array();
                                $menu_unit_weight=array();
                                $menunamelength=  strlen($menuname);
                                if($menunamelength>28){
                               $menunamenew= substr($menuname, 0,30)."...";
                                }else{
                                    $menunamenew=$menuname;
                                }
                              
                                ?>
                                
                                <h3><span><?= $menunamenew ?></span></h3>
                <a href="#"><button class="md-close cls-mn-odr"><img src="img/cancel_bill.png"></button></a>
				<div>
                                    <div class=" popup_validate" style="width: 100%;height: 15px;line-height: 20px;">
                                        <span class="loaderrpop" style="width: 100%;height: 15px;line-height: 20px;"></span>
                                    </div>
                    <div class="col-lg-12 col-md-12 no-padding">
                    	<div class="col-md-12 right_potion_mn pull-right no-padding">
       						<div class="take_mode_select_cc" style="display:none">
                                <div class="take_btn_cc take_btn_cc_act" id="1"><?=$_SESSION['menu_order_popup_dine_in']?></div>
                                <div class="take_btn_cc" id="1"><?=$_SESSION['menu_order_popup_take_away']?></div>
                            </div>
                           <div class="popup_potion_main"> 
                                <div class="popup_potion_cc">
                            <?php
                            
                            unset($_SESSION['preferenceselectvalue']); 
                            unset($_SESSION['preferencetextvalue']); 
                            unset($_SESSION['quantityvalue'] );
                            unset($_SESSION['portionvalue']);
                            $menuid=$result_menus['mr_menuid'] ;
                            
                            $_SESSION['menu_id']=$result_menus['mr_menuid'] ;
                            
                            
                            $sql_menuportion="select * from tbl_menuratemaster left join tbl_portionmaster on mmr_portion=pm_id where  mmr_menuid='".$menuid."' and  mmr_floorid='".$_SESSION['floorid']."' and mmr_rate_type='".$portion_or_unit."'   $string order by display_order asc";
                            //echo "select * from tbl_menuratemaster where  mmr_menuid='".$menuid."' and  mmr_floorid='".$_SESSION['floorid']."' and mmr_rate_type='".$portion_or_unit."'   $string ";
                            $sql_portions  =  $database->mysqlQuery($sql_menuportion); 
                            $num_portions  = $database->mysqlNumRows($sql_portions);
                            if($num_portions){
                                $ids=""; //$menu_default_portion=''; $menu_default_loose='';$menu_default_packet='';
                            while($result_portions  = $database->mysqlFetchArray($sql_portions)) 
                            {   $rate=0;
                                if($result_portions['mmr_rate_type']=='Portion'){
                                    
                                    $portion_id[]=$result_portions['mmr_portion'];
                                    $menu_rate[]=$result_portions['mmr_rate'];
                                    $menu_default_portion[]=$result_portions['mmr_default'];
                                }
                                else if($result_portions['mmr_rate_type']=='Unit'){
                                    
                                    if($result_portions['mmr_unit_type']=='Loose'){
                                        $base_unit_id[]=$result_portions['mmr_base_unit_id'];
                                        $menu_rate[]=$result_portions['mmr_rate'];
                                        $menu_default_loose=$result_portions['mmr_default'];
                                    }
                                   else if($result_portions['mmr_unit_type']=='Packet'){
                                        $unit_id[]=$result_portions['mmr_unit_id'];
                                        $menu_rate[]=$result_portions['mmr_rate'];
                                        $menu_unit_weight[]=$result_portions['mmr_unit_weight'];
                                        $menu_default_packet=$result_portions['mmr_default'];
                                    } 
                                }
                                
                                
                                if($_SESSION['incl_bill_format']=='Y'){
                                    
                                     $menu_rate_dyn[]=$result_portions['mmr_menu_final_amount'];
                                }
                                
                                
                                
                            //if(($portion==$result_portions['mmr_portion'])){  class="position_mn_cc_focus"<?php //} 
                            $rate_details=$database->show_portion_ful_details($result_portions['mmr_portion']);
                            //load_portionrate
                            $ordered_portionid=trim(json_encode($result_portions['mmr_portion']));
                                                                    
                             }} 
                             
                 
                             ?>                                                                       
                               
                                                                                            
                                                                    
                                
                                                                    
                             
                            
                           
                           
                                
                                
                                <div class="counter_pop_left_cc portion-div" style="display: none">
  
                                <div class="counter_pop_left_head">Portion:<span id="load_portionrate"></span></div>
                                                                        
                                <div class="counter_pop_left_portion">
                                 <?php
                                
                                //print_r($portion_id);
                                 for($p=0;$p<count($portion_id);$p++){
                                    
                                    $sql_menulistportion = "select tmn.mk_stock_number,pm.pm_id,pm.pm_portionname,pm.pm_portionshortcode from tbl_portionmaster pm  left join tbl_menustock tmn on tmn.mk_portion=pm.pm_id where pm.pm_id='".$portion_id[$p]."' and tmn.mk_menuid='$menuid' "; 
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
                                    
                                    
                                    <strong class="portionrate" id="portionrate_<?=$portion_id[$p]?>"><?=number_format($menu_rate[$p],3)?></strong>
                                </div>  
                                </div>
                                <?php
                               }
                              }} 
                                 ?>
             
                                 
                                </div><!--counter_pop_left_cc-->
                                
                            </div><!--counter_pop_left_cc-->
                            
                            
                            
                            <div class="counter_pop_left_cc packet-div" style="display:none">
                                <div class="counter_pop_left_head">PACKET:<span id="load_packetrate"></span></div>
                                <div class="counter_pop_left_portion">
                                    <?php
                                   // echo count($unit_id);
                                    //print_r($unit_id);
                                    //print_r($menu_unit_weight);
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
                                    <input type="text"  style="outline: none;width:100%;float:left;" class="counter_portion_view_btn enter-qty " onchange="return ratechange_gram();" onkeyup="return packetadd();" id="unitqty-<?=$q?>_<?=$unit_id[$q]?>" maxlength="3" autofocuss></div> 
                                    
                                    
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
                                 <div class="portion-contant-cc" style="width:27%;">
                                    <span class="portion-top-head">QTY</span>
                                    <input type="text"  contenteditable="true" style="outline: none;float:lef;width:100%" class="counter_portion_view_btn enter-qty " onkeyup="return looseadd();" id="baseunitqty_<?=$base_unit_id[$w]?>" maxlength="3" autofocuss>                    
                                   
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
                            
                                </div><!--popup_potion_cc-->
                                
                                <div class="popup_quarter_cc">
                                <?php 
                                
                                
                               
                                
                                
                                
                                 $sql_login124  =  $database->mysqlQuery("select mr_dailystock_in_number from tbl_menumaster where mr_menuid='".$result_menus['mr_menuid']."' "); 
				$num_login124   = $database->mysqlNumRows($sql_login124);
				if($num_login124){
					while($result_login124  = $database->mysqlFetchArray($sql_login124)) 
					  {
                                            
                                            $stockon=$result_login124['mr_dailystock_in_number'];
                                          }
                                        }
                                
                                
                                        
                                        
                                        
                                        
                                        
                                
                                
								//$clc="";if($result_portions['mmr_default']=='Y'){ $clc="1";}else{$clc="";}?>
                                    <input type="hidden" id="stockonoff" value="<?=$stockon?>"> 
                                <div   id="calc_value"  style="display:none">0</div>
                                <div class="popup_potion_head"><?=$_SESSION['menu_order_popup_qty']?><?php if($stockon=='Y'){ ?> &nbsp; <span>Left : </span> <span id="stockshow" style="color:black;background-color:#ffc877;border-radius:5px;    font-size: 17px;padding: 3px;">  </span>  <?php }?>   </div> 
                                    <div class="keys">
                                        <!-- operators and other keys -->
                                        <span class="caclulator_btn" title="cal_1">1</span>
                                        <span class="caclulator_btn" title="cal_2">2</span>
                                        <span class="caclulator_btn" title="cal_3">3</span>
                                        <span class="caclulator_btn" title="cal_4">4</span>
                                        <span class="caclulator_btn" title="cal_5">5</span>
                                        <span class="caclulator_btn" title="cal_6">6</span>
                                        <span class="caclulator_btn" title="cal_7">7</span>
                                        <span class="caclulator_btn" title="cal_8">8</span>
                                        <span class="caclulator_btn" title="cal_9">9</span>
                                        <span class="caclulator_btn" title="cal_0">0</span>
                                        <span class="caclulator_btn" title="cal_." >.</span>
                                        <span class="clear" id="clear_calc"><?=$_SESSION['menu_order_popup_quantity_clear']?></span>
                                    </div>
                                </div><!--popup_quarter_cc-->
                                <?php
			   $sql_login12  =  $database->mysqlQuery("select * from tbl_languages where ls_language='".$_SESSION['main_language']."'"); 
				$num_login12   = $database->mysqlNumRows($sql_login12);
				if($num_login12){
					while($result_login12  = $database->mysqlFetchArray($sql_login12)) 
					  {
                                            $ll=$result_login12['ls_id'] ;
                                             $_SESSION['language_id']=$result_login12['ls_id'] ;
                                          }
                                }
                                        
					  ?>
                                
                               
                                <div class="prefrence_drop_down_cc">
                                    
                                 <div class="col-md-12 nopadding">
                                  <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                  
                                  <div style="width:100%" class="listiing_select_cc">
                                      
                                      
                   <div class="pop_prference_cc" style="width: 98%;position:relative;">
                        
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
                               
                                $sql_menupref="select pmr_id,mpr_menuid,pmr_name,mpr_prefeernce from tbl_menuprefmaster tm left join tbl_preferencemaster tp on tp.pmr_id=tm.mpr_prefeernce where  mpr_menuid='".$result_menus['mr_menuid']."'";
                                
                                
                                $sql_pref  =  $database->mysqlQuery($sql_menupref); 
				 $num_pref  = $database->mysqlNumRows($sql_pref);
				 if($num_pref){
                                     ?>
                       
                                       <select  value="" id="insightList" multiple="multiple" class="counter_new_drop_1">
                                           
                                      <?php
                                      
                                        while ($result_menupref = $database->mysqlFetchArray($sql_pref)) {
                                            
                                           $pref_name = $result_menupref['pmr_name'];
                                           $pref_id = $result_menupref['pmr_id'];
                                           
                                           
                                                if($_SESSION['main_language']!='english'  || $otherlang=='Y'){
                                                            
                                                            
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
                            
                      ?>
                             <option value="<?=$pref_name?>"><?=$pref_name?></option> 
                             
                     <?php } ?>
                              
                      </select>
                                      
                                      
                                      
                        <?php	 } else { ?>
                       
                            <div style="line-height:30px;margin-top:8px"  class="counter_new_drop_1"><?=$_SESSION['menu_order_placeholder_nopreference']?></div>
                     
                        <?php } }else{ ?>
                 
                 
         <div id="load_manual_pref" style="width: 92%;position: absolute;top: -114px;left: 12px;background-color: #3c464c;
         padding: 10px;display: flex;flex-direction: column;align-items: flex-end;display: none;border-radius: 4px;overflow-y: auto;height: 112px;">
             
         </div>  
                 
                 
                 
                 <div onclick="view_muti_pef('<?=$menuid?>');" style="line-height:43px;border: solid 1px;cursor: pointer;font-size: 15px"  class="counter_new_drop_1">MULTIPLE QTY PREFERENCE</div>
                 
                 <?php }  ?>  
                           
                       </div>
                                    </div>
                                
                                   <div class="pop_custom_prference_cc">
                                  <textarea onkeyup="return manual_pref_check();" style="height:65px" placeholder="<?=$_SESSION['menu_order_placeholder_edit_manualpref']?>" class="pref_key_entry pref_text_area preftext<?=$result_menus['mr_menuid']?>" id="preftext"><?=$pref_text?></textarea>
				
				
                                   </div>

                                  </div>  
                                  <div class="listiing_select_cc">
                                                <div class="rate_typ_text_cc"><?php if($result_menus['mr_manualrateentry']=="Y"){ ?> Enter <?php } ?>    <?=$_SESSION['menu_order_popup_rate']?> :</div>
                                        <div class="rate_typ_textox_cc"><input type="text" class="rate_typ_textox rateentrydine <?php if($result_menus['mr_manualrateentry']=="Y"){ ?> border_blink  <?php } ?>" placeholder="<?=$_SESSION['menu_order_popup_rate']?>"  name="rate_value" id="rate_value" <?php if($result_menus['mr_manualrateentry']=="N"){  ?> disabled="disabled" <?php } else{?> style="background-color: " <?php } ?> manualrate="<?=$result_menus['mr_manualrateentry']?>" value="<?php if($result_menus['mr_manualrateentry']=="Y"){ echo $ordered_menu_rate ;}?>"  onkeypress="return dynamic(event,this.id);" onkeyup="return dynamic(event,this.id);"  /></div>
                                    </div>
                                     <?php
                                     if($type_action=='add'){?>
                                     <a  class="pref_right_btn submit_all" style="cursor:pointer;margin-top: 5px;" menusub="m_<?=$result_menus['mr_menuid'] ?>"><?=$_SESSION['menu_order_popup_submit_button']?></a>
                                     <?php } else if($type_action=='edit'){?>
                                     <a class="pref_right_btn submit_all123" style="cursor:pointer;margin-top: 5px;" id="popup_order_edit" menusub="m_<?=$menuid1[1] ?>"><?=$_SESSION['menu_order_popup_submit_button']?></a>
                                     <?php }?>
                                  </div>
                               </div>
       					  </div>
    				</div>
                    </div>
				</div>
                  <?php  }}  ?>  
                
		  </div>

	            <!------Add- on Starts--------->
                    
                    <?php 
                    
                    
                    $menu_addon_name=array();
                    $sql_menuaddon="select ma_addon_menuid,mr_menuid, mr_menuname, mmr_rate from tbl_menu_addons left join tbl_menumaster on mr_menuid=ma_addon_menuid left join tbl_menuratemaster  on mmr_menuid=ma_addon_menuid where  ma_menuid='".$_SESSION['autoloadmenu']."' and mmr_floorid='".$_SESSION['floorid']."' group by ma_addon_menuid order by ma_addon_menuid";
                   
                    $sql_menu_addon  =  $database->mysqlQuery($sql_menuaddon); 
                    $num_addon  = $database->mysqlNumRows($sql_menu_addon);
                    if($num_addon){$q=0;
                        
                    ?>
                    
                    <div class="popup-adon-cc" style="display:inline-block">
                        <div class="counter_menu_popup_head_text popup-adon-head">ADD ON</div>
                        <span style="width:100%;text-align: center;    height: 30px;line-height: 15px;float: left;margin-top: -10px;background-color: #000"></span>
                        <div class="counter_pop_left_head">
                            <div class="adon-popup-head1">MENU</div>
                            <div class="adon-popup-head2">RATE</div>
                            <div class="adon-popup-head3">QTY</div>
                            <div class="adon-popup-head4">TOTAL</div>
                        </div>
                        <div class="adon-popup-contant-cc">
                <?php 
                    while ($result_menu_addons = $database->mysqlFetchArray($sql_menu_addon)){
                        
                ?>  
                            
                        <div class="adon-popup-contant-row addo_each_menu_div">
                            <div class="adon-popup-contant1 addon-menu-name addonmenu" id="addonmenu_<?=$result_menu_addons['mr_menuid']?>" addon_slno="<?php if(isset($addon_menu_details['menu_edit_slno'][$q])){ echo $addon_menu_details['menu_edit_slno'][$q];}?>"><?=$result_menu_addons['mr_menuname']?></div>
                            <div class="adon-popup-contant2 addonrate" id="addonrate_<?=$result_menu_addons['mr_menuid']?>"><?=number_format($result_menu_addons['mmr_rate'],$_SESSION['be_decimal'])?></div>
                            <div class="adon-popup-contant3">
                                
                    <input type="text" class="adon-popup-contant-qty-box addonqty" id="addonqty_<?=$result_menu_addons['mr_menuid']?>" <?php if(isset($addon_menu_details['menu_edit_qty'][$q])){ if($addon_menu_details['menu_edit_id'][$q]==$result_menu_addons['mr_menuid']){ ?>  value="<?=$addon_menu_details['menu_edit_qty'][$q]?>" <?php }} ?> >
                                
                            </div>
                            
                    <div class="adon-popup-contant4 addontotal" id="addontotal_<?=$result_menu_addons['mr_menuid']?>"><?php if(isset($addon_menu_details['menu_edit_rate'][$q])){ if($addon_menu_details['menu_edit_id'][$q]==$result_menu_addons['mr_menuid']){  echo number_format($addon_menu_details['menu_edit_rate'][$q],$_SESSION['be_decimal']); $q++; } }?></div>
                    </div>
                    
                <?php } ?>
                            
                </div>
                </div>
                    
                <?php } ?>
                    
  <!-------------Add-on Ends----------->
                  
<script>
  $(document).ready(function(){
      
      var show_menu_rate_val_dyn=$('#show_menu_rate_val_dyn').val();
      
      var dyn=$('#show_menu_rate_val_dyn').attr('dyn');
      
     
      
      
      var show_menu_rate_val = $('#show_menu_rate_val').val();
     
      if($('#type_action').val()!='edit'){
      
            $('#rate_value').val(show_menu_rate_val);
      }
      
      if(dyn=='Y'){
          
           setTimeout(function () {
        
         $('#rate_value').val(show_menu_rate_val_dyn);
           }, 500);
          
      }
      
      
      
      
    $(".portion_view_btn").removeClass('focussed');
    $(".portion_view_btn:first").addClass('focussed');
    $(".portion_view_btn:first").focus();
   
	/*************************************** Multi select Dropdown select starts *************************************************  */
	  $('#insightList').multiselect({
           
		onChange: function(event) {
                    
			//alert($('#example-onDropdownHidden').val());
			$('#ta_portionhid').val('');
                         if($('#insightList').val()){
			$('#ta_portionhid').val($('#insightList').val());
			$('#preftext').val($('#insightList').val()+",");
                    }else{
                        $('#preftext').val('');
                    }
		}
		
	});
        /*************************************** Multi select Dropdown select  ends *************************************************  */
        
      
     
     var decimal=$("#decimal").val();
      if($('#portion-or-unit').val()=='Portion')
      { 
          $('.portion-div').css('display','block');
          $('.packet-div').css('display','none');
          $('.loose-div').css('display','none');
      }
      else if($('#portion-or-unit').val()=='Unit'){
        
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
      if($('#rate_value').val()!=''){
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
            $.post("load_div.php", {portionval:portion_id1,unitval:'',baseunit:'',set:'portionset'});
        
        }
        else if(portion_or_unit=='Unit'){
            
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
            $.post("load_div.php", {portionval:'',unitval:portion_id2[1],baseunit:'',set:'portionset'});         
            }    
            else if(packet_or_loose=='Loose'){
                    var rate=parseFloat($('.enter-qty:first').val())*parseFloat($('.baseunitrate').text());       
                    $('#load_looserate').text(' 1 '+$('.baseunitname').text()+'='+<?=$menu_rate[0]?>.toFixed(decimal));
                    
                    if(stockonoff=="Y")  {
                    var stock_num=$('#baseunit_stock_number_'+portion_id2[1]).attr('stock');
                    //alert(stock_num);
                    $('#stockshow').html(stock_num);
                    }
                $.post("load_div.php", {portionval:'',unitval:'',baseunit:portion_id2[1],set:'portionset'});
            }
        }
      
     }); 
     
    </script>
    <script>
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
  
  function manual_pref_check(){
        
         var str=$('.pref_key_entry').val();
   
     if(isNaN(str.charAt(0))==false){
         
          var all_str='.'+str;  
         
       $('.pref_key_entry').val(all_str);
         
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
    
   $('#rate_value').val(rt);
    }  
       
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
        
        
       function view_muti_pef(mid){
      
      if($('#load_manual_pref').css('display') == 'none')
       {
      
       $.post("load_index.php", {set:'load_manual_preference',menu:mid},
					function(data)
					{
                                         
					 data=$.trim(data);
                                       $('#load_manual_pref').show();
                                       $('#load_manual_pref').html(data);
                                       
                                       
               $.post("load_index.php", {set:'load_manual_preference_edit',menu:mid,mode:'DI'},
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
         function numonly(evt)
  {
       
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {

         return false;

        }
          
      return true;
  }
</script>
