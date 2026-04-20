



<?php
include('includes/session.php');		// Check session
include("database.class.php"); // DB Connection class
$database	= new Database(); 		// Create a new instance
//$value		= $_REQUEST['value'];
include("api_multiplelanguage_link.php");
$a=  trim(json_encode($_SESSION['main_language']),'""');


$type_action=$_REQUEST['type'];

    if(isset($_REQUEST['pt'])){
   $prt1=$_REQUEST['pt'];
   }
     $menuid=$_REQUEST['menuid'];
     $menuid1=explode("_",$menuid);
     $menuid1[1];
     //echo $menuid;
     //echo $menuid1[0];
     //echo $menuid1[1];
     $slno=$_REQUEST['slno'];
     $slno1=explode("_",$slno);
     $slno[1];
     $sql_edit  =  $database->mysqlQuery("select ter_branchid, ter_preferencetext,mm.mr_manualrateentry,mm.mr_menuname,tor.ter_menuid, tor.ter_portion,tor.ter_floorid,pr.pm_portionname,tor.ter_rate,tor.ter_qty FROM tbl_tableorder tor left join tbl_menumaster mm on mm.mr_menuid = tor.ter_menuid left join tbl_portionmaster pr on pr.pm_id=tor.ter_portion  where tor.ter_orderno='".$_SESSION['order_id']."' and tor.ter_slno='".$slno1[1]."' and tor.ter_menuid='".$menuid1[1]."'"); 
     //echo "select mm.mr_menuname, tor.ter_portion, tor.ter_rate, tor.ter_qty FROM tbl_tableorder tor left join tbl_menumaster mm on mm.mr_menuid = tor.ter_menuid where tor.ter_orderno='".$_SESSION['order_id']."' and tor.ter_slno='".$slno1[1]."' and tor.ter_menuid='".$menuid1[1]."'";
     $num_edit  = $database->mysqlNumRows($sql_edit);
	if($num_edit)
            {
            while($result_edit  = $database->mysqlFetchArray($sql_edit)) 
		{
                
//                    $ordered_menuid=trim(json_encode($result_edit['ter_menuid']));
//                    $fp=fopen($apilink."/src/main_menu_display.php?set=orderedmenu&ordered_menuid=$ordered_menuid&dat=$a","r");
//                    $response['messages'] = stream_get_contents($fp);
//                    //echo  $response['messages'];
//                    $resu= json_decode($response['messages'],true);
                
                
                   $menu_name  =$result_edit['mr_menuname'];
                   if($_SESSION['main_language']!='english'){
                       $sql_arabmenu=$database->mysqlQuery("SELECT lm_menu_name FROM tbl_language_menu_master left join tbl_languages on ls_id=lm_language_id WHERE lm_menu_id='".$result_edit['ter_menuid']."' and ls_language='".$_SESSION['main_language']."'");
                        //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                        $num_arabmenu = $database->mysqlNumRows($sql_arabmenu);
                        $menu_name=$result_arabmenu['lm_menu_name'];
                                        // $catid['name'][] = $catname;
                                        //echo $catname;
                        }
                   $manualrateentry=$result_edit['mr_manualrateentry'];
                   $menu_rate  =$result_edit['ter_rate'];
                   $menu_portion  =$result_edit['ter_portion'];
                   $menu_qty=$result_edit['ter_qty'];
                   $menu_id=$result_edit['ter_menuid'];
                   $menu_floorid=$result_edit['ter_floorid'];
                   $portion_name=$result_edit['pm_portionname'];
                   $final1=$menu_rate*$menu_qty;
                   $branch_id=$result_edit['ter_branchid'];
                   //echo $branch_id;
                   $pref_text=$result_edit['ter_preferencetext'];
                }
            
            }


     $_SESSION['autoloadmenu']=$result_edit['ter_menuid'];
  
//echo $menuid;
//echo $type;

?>
  <input type="hidden" name="hidtableordernentry_updated" id="hidtableordernentry_updated" value="<?=$_SESSION['procedures_proc_tableordernentry_updated']?>" />
                                             <input type="hidden" name="hidtableordernentry_success" id="hidtableordernentry_success" value="<?=$_SESSION['procedures_proc_tableordernentry_success']?>" />
                                             <input type="hidden" name="hidtableordernentry_rate" id="hidtableordernentry_rate" value="<?=$_SESSION['procedures_proc_tableordernentry_rate']?>" />
                                          <input type="hidden" name="hidtableordernentry_billed" id="hidtableordernentry_billed" value="<?=$_SESSION['procedures_proc_tableordernentry_billed']?>" />
                                           <input type="hidden" name="decimal" id="decimal" value="<?=$_SESSION['be_decimal']?>" />
                                        
<script src="js/pop_menu.js" async> </script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
$(document).ready(function() {
     $(".position_mn_cc_focus>.portion_view_btn").focus();
	/*************************************** Multi select Dropdown select starts *************************************************  */
	$('#new12').multiselect({
           
		onDropdownHidden: function(event) {
                    
			//alert($('#example-onDropdownHidden').val());
			$('#ta_portionhid').val('');
			$('#ta_portionhid').val($('#new12').val());
			$('.preftext').val($('#new12').val()+",");
			
		}
		
	});
	/*************************************** Multi select Dropdown select  ends *************************************************  */
     
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
        
        
        

        $(document).keypress(function(evt){
             var rt=$('#rate_value').val();
    
             //alert(rt);
 if(String.fromCharCode(evt.which)=="." && rt=="" ){
    $('#rate_value').val('0');
   }
 
 if(rt.includes("."))
   var b=rt.split('.');
var bw=b[1].length;
var dc=$('#decimal').val();
var dc1=dc-1;
if(bw>dc1){
   var keyCode = (evt.keyCode ? evt.keyCode : evt.which);
    if (keyCode > 47 && keyCode < 58) {
        evt.preventDefault();
    }
}
});

   
        document.onkeydown= function(ev){
var keyCode = ev.keyCode || ev.which;   
    if (keyCode == 13) { 
      $('#popup_order_edit').click();
        //   $(".focussed").text(''); 
       return false;
    }
} 
   
   
   
        $( ".focussed" ).keyup(function(e) {
    
     if($('.portion_view_btn').hasClass("focussed")){
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
   
   
     
});
</script>
<div class="md-content" style="position:fixed;width:40%;left:30%;top:15%;z-index:99999;">

    <input type="hidden" id="menuofid" value="<?=$menuid1[1]?>" >
                                <input type="hidden" name="idofmenu" id="idofmenu" branchid="<?php echo $branch_id;?>"  floorid="<?php echo $menu_floorid?>" value="<?php echo $menuid1[1]; ?>"/>
                               
                                 <?php
                                $menunamelength=  strlen($menu_name);
                                if($menunamelength>28){
                               $menunamenew= substr($menu_name, 0,30)."...";
                                }else{
                                    $menunamenew=$menu_name;
                                }
                              
                                ?>
                                
                                
                                
                                <h3><span><?=$menunamenew?></span>  </h3>
                                
                <a href="#"><button class="md-close">x</button></a>
				<div>
				<div class=" popup_validate" style="width: 100%;height: 15px;line-height: 20px;">
                                        <span class="loaderrpop" style="width: 100%;height: 15px;line-height: 20px;"></span>
                                    </div>
                    <div class="col-lg-12 col-md-12 no-padding">
                    	<div class="col-md-12 right_potion_mn pull-right no-padding">
       						<!--<div class="take_mode_select_cc">
                                <div class="take_btn_cc take_btn_cc_act" id="1"><?=$_SESSION['menu_order_popup_dine_in']?></div>
                                <div class="take_btn_cc" id="2"><?=$_SESSION['menu_order_popup_take_away']?></div>
                            </div>--><!--take_mode_select_cc-->
                            <input type="hidden" name="ratehid" id="ratehid" value="<?=  number_format($menu_rate,$_SESSION['be_decimal'])?>">
                           <div class="popup_potion_main"> 
                                <div class="popup_potion_cc">
                                <div  id="portion_value"  style="display:none"></div>
                                	<div class="popup_potion_head"><?=$_SESSION['s_portionname']?><?//$_SESSION['s_currency']?>: <span id="load_portionrate"><?=$final1?> </span></div>
                                     <div class="position_mn_cc">
                                                                <?php 
									  
									  $sql_week="select mmr_rate,mmr_default,pm_id,pm_portionname,mmr_portion from tbl_menuratemaster left join tbl_portionmaster on pm_id=mmr_portion  where mmr_menuid='".$menuid1[1]."' and pm_portionshortcode='".$prt1."' and mmr_floorid='".$menu_floorid."'";
									  
                                                                          //echo"select mmr_default,pm_id,pm_portionname,mmr_portion from tbl_menuratemaster left join tbl_portionmaster on pm_id=mmr_portion  where mmr_menuid='".$menuid1[1]."' and  pm_portionshortcode='".$prt1."' and mmr_floorid='".$menu_floorid."'";
                                                                          $sql_weekday  =  $database->mysqlQuery($sql_week);
									  $num_weekday  = $database->mysqlNumRows($sql_weekday);
									  if($num_weekday){
									  while($result_weekday  = $database->mysqlFetchArray($sql_weekday)) 
										  {
											 $weekid=$result_weekday['pm_id'];
                                                                                         $portionname=$result_weekday['pm_portionname'];
                                                                                         $final=$result_weekday['mmr_rate'];
                                                                                       
                                                                                         $ordered_portionid=trim(json_encode($result_weekday['pm_id']));
//                                                                                         $fp_portion=fopen($apilink."/src/main_menu_display.php?set=orderedportion&ordered_portionid=$ordered_portionid&dat=$a","r");
//                                                                                         $response_portion['messagesportion'] = stream_get_contents($fp_portion);
//                                                                                         //echo $response_portion['messagesportion'];
//                                                                                        $resu_portion= json_decode($response_portion['messagesportion'],true);
//                                                                                        //var_dump($resu_portion);   
                                                                                         $sql_menulistportion = "select tmn.mk_stock_number,pm.pm_id,pm.pm_portionname,pm.pm_portionshortcode from tbl_portionmaster pm  left join tbl_menustock tmn on tmn.mk_portion=pm.pm_id   where pm.pm_id='".$result_weekday['pm_id']."' and tmn.mk_menuid='$menuid1[1]'"; 
                                                                                        //echo "select pm.pm_id,pm.pm_portionname from tbl_portionmaster pm where pm.pm_id='".$portionid."'";
                                    
                                                              
                                                                                        $sql_menulistportion = $database->mysqlQuery($sql_menulistportion);
                                                                                        $num_menulistportion = $database->mysqlNumRows($sql_menulistportion);
                                                                                        if ($num_menulistportion) {
                                                                                            while ($result_menulistportion = $database->mysqlFetchArray($sql_menulistportion)) {
                                                                                                     $stk=$result_menulistportion['mk_stock_number'];
                                                                                               $portion_name = $result_menulistportion['pm_portionname'];
                                                                                               $portion_id = $result_menulistportion['pm_id'];
                                                                                               $portion_shortcode= $result_menulistportion['pm_portionshortcode'];
                                           
                                                                                            if($_SESSION['main_language']!='english'){

                                                                                            $sql_arabportion=$database->mysqlQuery("SELECT lm_portion_name FROM tbl_language_portion left join tbl_languages on ls_id=lm_language_id WHERE lm_portion_id='".$result_menulistportion['pm_id']."' and ls_language='".$_SESSION['main_language']."'");

                                                                                            //echo " SELECT mm_name FROM tbl_language_menu_sub left join tbl_languages on ls_id=mm_lang_id WHERE mm_sub_category_id='".$result_subcat['subid']."' and ls_language='".$dat."'";
                                                                                            $num_arabportion = $database->mysqlNumRows($sql_arabportion);
                                                                                            $result_arabportion = $database->mysqlFetchArray($sql_arabportion);
                                                                                            $portion_name=$result_arabportion['lm_portion_name'];
                                                                                            // $catid['name'][] = $catname;
                                                                                            //echo $catname;
                                                                                            }
                                                                                                    //$catid['portion_name'][]= $portion_name;      

                                                                                                }
                                                                                                } 
                                                                                         
                                                                                         
                                                                                         
                                                                                         
                                                                                    ?>
                                                                                  <li style="<?php if($portion_name==$portionname){ ?> display:block; <?php } else { ?> display:none;<?php }?>"><a title="portion_<?=$weekid?>"  portion="por_<?=$menu_portion ?>" id="portions1" qty="" slno="<?=$slno ?>" rate="rate_<?=$final?>" stock="<?=$stk?>"  <?php if($portion_name==$portionname){ ?> class="position_mn_cc_focus" <?php } ?>> <?=$portion_name?>
                                                         <span   contenteditable="true" style="outline: none"  class="portion_view_btn focussed" id="qty<?=$menuid1[1]?>"><?php if($portion_name==$portionname){echo $menu_qty;} else{ ?>0<?php }?></span></a></li>
                                                                          <?php }}  ?> 
                                                         
                                  </div><!--potion_mn_cc-->	
                                </div><!--popup_potion_cc-->
                                
                                
                                <div class="popup_quarter_cc">
                                <?php 
                                
                                
                                 $sql_login124  =  $database->mysqlQuery("select mr_dailystock_in_number from tbl_menumaster where mr_menuid='$menuid1[1]' "); 
				$num_login124   = $database->mysqlNumRows($sql_login124);
				if($num_login124){
					while($result_login124  = $database->mysqlFetchArray($sql_login124)) 
					  {
                                            
                                            $stockon1=$result_login124['mr_dailystock_in_number'];
                                          }
                                        }
                                
                                
                                
                                
								//$clc="";if($result_portions['mmr_default']=='Y'){ $clc="1";}else{$clc="";}?>
                                    <input type="hidden" id="editqtystock" value="<?=$menu_qty?>" >
                                <input type="hidden" id="stockonoff1" value="<?=$stockon1?>" > 
                                <div   id="calc_value"  style="display:none">0</div>
                                	<div class="popup_potion_head"><?=$_SESSION['menu_order_popup_qty']?> <?php if($stockon1=='Y'){ ?> &nbsp; <span>Left : </span> <span id="stockshow1" style="color:black;background-color:#ffc877;border-radius:5px;    font-size: 17px;padding: 3px;">  </span>  <?php }?> </div> 
                                    <div class="keys">
                                        <!-- operators and other keys -->
                                        <span class="caclulator_btn" title="cal_1">1<?//$_SESSION['menu_order_no_one']?></span>
                                        <span class="caclulator_btn" title="cal_2">2<?//$_SESSION['menu_order_no_two']?></span>
                                        <span class="caclulator_btn" title="cal_3">3<?//$_SESSION['menu_order_no_three']?></span>
                                        <span class="caclulator_btn" title="cal_4">4<?//$_SESSION['menu_order_no_four']?></span>
                                        <span class="caclulator_btn" title="cal_5">5<?//$_SESSION['menu_order_no_five']?></span>
                                        <span class="caclulator_btn" title="cal_6">6<?//$_SESSION['menu_order_no_six']?></span>
                                        <span class="caclulator_btn" title="cal_7">7<?//$_SESSION['menu_order_no_seven']?></span>
                                        <span class="caclulator_btn" title="cal_8">8<?//$_SESSION['menu_order_no_eight']?></span>
                                        <span class="caclulator_btn" title="cal_9">9<?//$_SESSION['menu_order_no_nine']?></span>
                                        <span class="caclulator_btn" title="cal_0">0<?//$_SESSION['menu_order_no_zero']?></span>
                                        <span class="caclulator_btn" title="cal_.">.</span>
                                        <span class="clear" id="clear_calc"><?=$_SESSION['menu_order_popup_quantity_clear']?></span>
                                    </div>
                                </div><!--popup_quarter_cc-->
                                <div class="prefrence_drop_down_cc">
                                 <div class="col-md-12 nopadding">
                                  <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                  
                                  <div style="width:100%" class="listiing_select_cc">
                                  <div class="pop_prference_cc">
                         <?php  
				 
                                //$ordered_menuid=trim(json_encode($result_menus['mr_menuid']));
//                                $fppreference=fopen($apilink."/src/main_menu_display.php?set=orderedmenupreference&ordered_menuid=$ordered_menuid&dat=$a","r");
//                                $response_preference['messages'] = stream_get_contents($fppreference);
//                                //echo  $response_preference['messages'];
//                                $resu_preference= json_decode($response_preference['messages'],true);
//                                //var_dump($resu_preference);
//                                $pref_count=count($resu_preference['pref_name']);
                                //echo $pref_count;
                         
				 //if($pref_count!=0){?>
        	
                    <!-- <option value="" >Select Preference</option>-->
                        <?php 
                                $sql_menupref="select pmr_id,mpr_menuid,pmr_name,mpr_prefeernce from tbl_menuprefmaster tm left join tbl_preferencemaster tp on tp.pmr_id=tm.mpr_prefeernce where  mpr_menuid='".$menuid1[1]."'";
                                 //echo "select pmr_id,mpr_menuid,pmr_name,mpr_prefeernce from tbl_menuprefmaster tm left join tbl_preferencemaster tp on tp.pmr_id=tm.mpr_prefeernce where  mpr_menuid='".$ordered_menuid."'";
                                
                                $sql_pref  =  $database->mysqlQuery($sql_menupref); 
				 $num_pref  = $database->mysqlNumRows($sql_pref);
				 if($num_pref){
                                     ?>
                                       <select id="new12" multiple="multiple" class="counter_new_drop_1 prefdp<?=$menuid1[1]?>">
                                      <?php
                                        while ($result_menupref = $database->mysqlFetchArray($sql_pref)) {
                                            
                                           $pref_name = $result_menupref['pmr_name'];
                                           $pref_id = $result_menupref['pmr_id'];
                                           
                                                        if($_SESSION['main_language']!='english'){

                                                        $sql_arabpref=$database->mysqlQuery("SELECT l_pref_name FROM tbl_language_preference left join tbl_languages on ls_id=l_lang_id WHERE l_pref_id='".$result_menupref['pmr_id']."' and ls_language='".$_SESSION['main_language']."'");

                                                        //echo " SELECT l_pref_name FROM tbl_language_preference left join tbl_languages on ls_id=l_lang_id WHERE l_pref_id='".$result_menupref['pmr_id']."' and ls_language='".$dat."'";
                                                        $num_arabpref = $database->mysqlNumRows($sql_arabpref);
                                                         if($num_arabpref){
                                                            while ($result_arabpref = $database->mysqlFetchArray($sql_arabpref)){
                                                        $pref_name=$result_arabpref['l_pref_name'];
                                                        // $catid['name'][] = $catname;
                                                        //echo $catname;
                                                        }}}
                                         ?>
                     <option value="<?=$pref_name?>"><?=$pref_name?></option>
                     <?php }?>
                     
                               </select>
                        <?php	 } else { ?>
                            <div style="line-height:30px;"  class="counter_new_drop_1"> No Preference</div>
                               <?php } ?>

                       
                        
                         	
                    </div>
                                    </div>
                                  <!--class="pref_text_area"-->
                                  
                                    <textarea style="height:65px" placeholder="<?=$_SESSION['menu_order_placeholder_edit_manualpref']?>"  name="preftext<?=$menuid?>" id="preftext" class="pref_text_area preftext<?=$menuid ?>"><?= $pref_text ?></textarea>
                                  </div>  
                                  <div class="listiing_select_cc">
                                 		<div class="rate_typ_text_cc"><?=$_SESSION['menu_order_popup_rate']?> -</div>
                                        <div class="rate_typ_textox_cc"><input type="text" class="rate_typ_textox rateentrydine" placeholder="<?=$_SESSION['menu_order_popup_rate']?>"  name="rate_value" id="rate_value" <?php if($manualrateentry=="N"){  ?> disabled="disabled" <?php } else {?> value="<?=$menu_rate?>"  style="background-color:gray "       <?php }?> manualrate="<?=$manualrateentry?>"  onkeypress="return dynamic(event,this.id);" onkeyup="return dynamic(event,this.id);" /></div>
                                    </div>
                                    <a class="pref_right_btn submit_all123" style="cursor:pointer;margin-top: 5px;" id="popup_order_edit" menusub="m_<?=$menuid1[1] ?>"><?=$_SESSION['menu_order_popup_submit_button']?></a>
                                  </div>
                               </div><!--prefrence_drop_down_cc id="submit_all"-->
       					  </div><!--popup_potion_main-->	
    				</div><!--right_potion_mn-->
                    </div>
				</div>
                
			</div>
<script type="text/javascript">$(document).ready(function(){ 
});
</script>    
			<!--<script src="js/fancySelect.js"></script>-->

